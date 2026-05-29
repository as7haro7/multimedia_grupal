<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciologin.php");
    exit();
}

include "conexion.php";

$flojo = $_POST["flojo"];
$proceso = $_POST["proceso"];
$id_tramite = $_POST["id_tramite"];

$flujoproceso = leer_json("flujoproceso");
$flujocondicion = leer_json("flujocondicion");
$seguimiento = leer_json("seguimiento");

// Actualizar cualquier dato enviado desde los formularios (ej. P4 Interaccion)
// Guardaremos el estado en la sesión para simular persistencia temporal durante el flujo
if (isset($_POST['materias_adicionar'])) {
    $_SESSION['tramite_'.$id_tramite]['materias_adicionar'] = $_POST['materias_adicionar'];
}
if (isset($_POST['materias_retirar'])) {
    $_SESSION['tramite_'.$id_tramite]['materias_retirar'] = $_POST['materias_retirar'];
}

$procesosiguiente = "";

if (isset($_POST["Siguiente"]) || isset($_POST["opcion_evaluada"])) {
    
    if (isset($_POST["opcion_evaluada"])) {
        // Es un proceso Q evaluado automáticamente
        $opcion = $_POST["opcion_evaluada"]; // "Si" o "No"
        foreach ($flujocondicion as $fc) {
            if ($fc['flujo'] == $flojo && $fc['proceso'] == $proceso && $fc['opcion'] == $opcion) {
                $procesosiguiente = $fc['procesosiguiente'];
                break;
            }
        }
    } else {
        // Proceso P normal
        foreach ($flujoproceso as $fp) {
            if ($fp['flujo'] == $flojo && $fp['proceso'] == $proceso) {
                $procesosiguiente = $fp['procesosiguiente'];
                break;
            }
        }
    }

} elseif (isset($_POST["Si"]) || isset($_POST["No"])) {
    // Proceso Q manual
    $opcion = isset($_POST["Si"]) ? 'Si' : 'No';
    foreach ($flujocondicion as $fc) {
        if ($fc['flujo'] == $flojo && $fc['proceso'] == $proceso && $fc['opcion'] == $opcion) {
            $procesosiguiente = $fc['procesosiguiente'];
            break;
        }
    }
} elseif (isset($_POST["Anterior"])) {
    // Buscar quien tiene como procesosiguiente al actual
    // Nota: Esto es simplificado y no soporta historial de Q's fácilmente, pero cumple el requerimiento.
    foreach ($flujoproceso as $fp) {
        if ($fp['flujo'] == $flojo && $fp['procesosiguiente'] == $proceso) {
            $procesosiguiente = $fp['proceso'];
            break;
        }
    }
    // Si no se encuentra en flujoproceso, buscar en flujocondicion (simplificado)
    if (empty($procesosiguiente)) {
        foreach ($flujocondicion as $fc) {
            if ($fc['flujo'] == $flojo && $fc['procesosiguiente'] == $proceso) {
                $procesosiguiente = $fc['proceso'];
                break;
            }
        }
    }
}

if (empty($procesosiguiente)) {
    die("Error: No se pudo determinar el siguiente proceso.");
}

// Actualizar seguimiento
foreach ($seguimiento as &$tramite) {
    if ($tramite['id'] == $id_tramite) {
        $tramite['proceso'] = $procesosiguiente;
        
        // Si el siguiente proceso es de tipo F (Fin), marcamos fechafin
        $es_fin = false;
        foreach ($flujoproceso as $fp) {
            if ($fp['proceso'] == $procesosiguiente && $fp['tipo'] == 'F') {
                $es_fin = true;
                break;
            }
        }
        if ($es_fin) {
            $tramite['fechafin'] = date("Y-m-d H:i:s");
        }
        break;
    }
}
escribir_json("seguimiento", $seguimiento);

header("Location: index.php?flojo=" . $flojo . "&proceso=" . $procesosiguiente . "&id_tramite=" . $id_tramite);
exit();
?>

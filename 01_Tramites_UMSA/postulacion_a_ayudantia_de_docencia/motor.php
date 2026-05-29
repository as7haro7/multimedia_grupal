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

// Guardar datos enviados por POST temporal o permanentemente en el JSON
$actualizado = false;
foreach ($seguimiento as &$tramite) {
    if ($tramite['id'] == $id_tramite) {
        if (!isset($tramite['datos'])) $tramite['datos'] = [];
        
        // P3: Guardar materia postulada y nombre PDF
        if (isset($_POST['materia_postulada'])) {
            $tramite['datos']['materia'] = $_POST['materia_postulada'];
            $tramite['datos']['pdf'] = $_POST['archivo_pdf'];
        }
        
        // P6: Guardar nota examen tribunal
        if (isset($_POST['nota_examen'])) {
            $tramite['datos']['nota_examen'] = (float)$_POST['nota_examen'];
        }

        // P7: Guardar nota final calculada
        if (isset($_POST['nota_final'])) {
            $tramite['datos']['nota_final'] = (float)$_POST['nota_final'];
        }

        $actualizado = true;
        break;
    }
}
if ($actualizado) escribir_json("seguimiento", $seguimiento);

$procesosiguiente = "";
$opcion = null;

if (isset($_POST["opcion_evaluada"])) {
    $opcion = $_POST["opcion_evaluada"]; 
} elseif (isset($_POST["opcion_manual"])) {
    $opcion = $_POST["opcion_manual"]; 
} elseif (isset($_POST["Si"])) {
    $opcion = "Si";
} elseif (isset($_POST["No"])) {
    $opcion = "No";
}

if ($opcion !== null) {
    // Proceso Q
    foreach ($flujocondicion as $fc) {
        if ($fc['flujo'] == $flojo && $fc['proceso'] == $proceso && $fc['opcion'] == $opcion) {
            $procesosiguiente = $fc['procesosiguiente'];
            break;
        }
    }
} elseif (isset($_POST["Siguiente"]) || isset($_POST["Siguiente_auto"])) {
    // Proceso P normal
    foreach ($flujoproceso as $fp) {
        if ($fp['flujo'] == $flojo && $fp['proceso'] == $proceso) {
            $procesosiguiente = $fp['procesosiguiente'];
            break;
        }
    }
}

if (empty($procesosiguiente)) {
    die("Error: No se pudo determinar el siguiente proceso (Opción: $opcion).");
}

// Actualizar seguimiento
$seguimiento = leer_json("seguimiento"); // recargar por si acaso
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

// Si soy rol tribunal y envié el proceso a un rol diferente (ej. P9 que es Consejo),
// entonces debería volver a MI bandejae, no seguir la ruta, porque yo no tengo permiso para P9.
// Para hacerlo fácil, redirigimos siempre a la bandeja, a menos que el siguiente rol sea el mío.
$rol_siguiente = null;
foreach ($flujoproceso as $fp) {
    if ($fp['proceso'] == $procesosiguiente) {
        $rol_siguiente = $fp['rol'];
        break;
    }
}

if ($rol_siguiente == $_SESSION['rol']) {
    header("Location: index.php?flojo=" . $flojo . "&proceso=" . $procesosiguiente . "&id_tramite=" . $id_tramite);
} else {
    // El trámite pasó a la bandeja de otro actor (o se finalizó y no soy el dueño).
    header("Location: bandejae.php?msg=tramite_enviado");
}
exit();
?>

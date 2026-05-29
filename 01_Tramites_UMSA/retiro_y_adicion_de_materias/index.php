<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciologin.php");
    exit();
}

$flojo = isset($_GET["flojo"]) ? $_GET["flojo"] : "";
$proceso = isset($_GET["proceso"]) ? $_GET["proceso"] : "";
$id_tramite = isset($_GET["id_tramite"]) ? $_GET["id_tramite"] : "";

if (empty($flojo) || empty($proceso) || empty($id_tramite)) {
    header("Location: bandejae.php");
    exit();
}

include "conexion.php";
$flujoproceso = leer_json("flujoproceso");

// Buscar el proceso actual
$proceso_actual = null;
foreach ($flujoproceso as $fp) {
    if ($fp['flujo'] == $flojo && $fp['proceso'] == $proceso) {
        $proceso_actual = $fp;
        break;
    }
}

if (!$proceso_actual) {
    die("Error: Proceso no encontrado.");
}

$pantalla = $proceso_actual["pantalla"];
$tipo = $proceso_actual["tipo"];

// Cargar datos extra si es necesario
$estudiantes = leer_json("estudiantes");
$estudiante = null;
foreach ($estudiantes as $e) {
    if ($e['usuario'] == $_SESSION['usuario']) {
        $estudiante = $e;
        break;
    }
}

$materias = leer_json("materias");
$cronograma = leer_json("cronograma");
?>
<html>
<head>
    <title>Trámite - <?php echo $proceso; ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header { border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; color: white; font-size: 14px; margin-right: 10px; }
        .btn-primary { background-color: #007bff; }
        .btn-secondary { background-color: #6c757d; }
        .btn-success { background-color: #28a745; }
        .btn-danger { background-color: #dc3545; }
        .btn:hover { opacity: 0.9; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-info { color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Paso actual: <?php echo $proceso; ?></h2>
            <a href="bandejae.php" style="float: right; margin-top: -35px; color: #666;">Volver a Bandeja</a>
        </div>
        
        <form method="POST" action="motor.php">
            <input type="hidden" name="flojo" value="<?php echo $flojo;?>"/>
            <input type="hidden" name="proceso" value="<?php echo $proceso;?>"/>
            <input type="hidden" name="id_tramite" value="<?php echo $id_tramite;?>"/>
            
            <?php
            // Incluir la vista del proceso específico
            if (file_exists($pantalla . ".inc.php")) {
                include $pantalla . ".inc.php";
            } else {
                echo "<div class='alert alert-danger'>No se encontró la vista para: $pantalla</div>";
            }
            ?>
            
            <hr style="margin-top: 30px; margin-bottom: 20px; border: 0; border-top: 1px solid #eee;">
            
            <?php if ($tipo == 'Q') { ?>
                <!-- Para procesos Q, el .inc.php definirá los botones Si/No ocultos o visibles, o el motor esperará 'opcion_evaluada' -->
                <?php if (!isset($ocultar_botones_q) || !$ocultar_botones_q) { ?>
                    <input type="submit" name="Si" value="Aprobar (Sí)" class="btn btn-success"/>
                    <input type="submit" name="No" value="Rechazar (No)" class="btn btn-danger"/>
                <?php } ?>
            <?php } elseif ($tipo == 'F') { ?>
                <!-- Fin del flujo -->
                <a href="bandejae.php" class="btn btn-primary">Ir a Bandeja</a>
            <?php } else { ?>
                <!-- Botones normales -->
                <input type="submit" name="Siguiente" value="Siguiente" class="btn btn-primary"/>
                <input type="submit" name="Anterior" value="Anterior" class="btn btn-secondary"/>
            <?php } ?>
        </form>
    </div>
</body>
</html>

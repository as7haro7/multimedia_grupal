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
$rol_requerido = $proceso_actual["rol"];

// Validar que el usuario tenga el rol correcto para ver este proceso
// Excepción: Los roles tipo 'F' (Fin) o ver resultados pueden ser un poco más flexibles,
// pero por seguridad bloqueamos si no es el rol, excepto si es Fin y soy el creador.
$soy_creador = false;
$seguimiento = leer_json("seguimiento");
$tramite_actual = null;
foreach ($seguimiento as $tramite) {
    if ($tramite['id'] == $id_tramite) {
        $tramite_actual = $tramite;
        if ($tramite['usuario'] == $_SESSION['usuario']) {
            $soy_creador = true;
        }
        break;
    }
}

if ($_SESSION['rol'] != $rol_requerido) {
    if (!($tipo == 'F' && $soy_creador)) {
        die("<div style='color:red; font-family:sans-serif; padding:20px;'>Error: No tienes permiso para ver esta pantalla. Se requiere rol: $rol_requerido</div>");
    }
}

// Cargar datos extra si es necesario
$perfiles = leer_json("perfiles");
$perfil = null;
foreach ($perfiles as $p) {
    if ($p['usuario'] == $tramite_actual['usuario']) { // el dueño del trámite
        $perfil = $p;
        break;
    }
}
$convocatorias = leer_json("convocatorias");
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
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn:hover { opacity: 0.9; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-info { color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb; }
        .alert-warning { color: #856404; background-color: #fff3cd; border-color: #ffeeba; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Paso actual: <?php echo $proceso; ?> (Rol: <?php echo $rol_requerido; ?>)</h2>
            <a href="bandejae.php" style="float: right; margin-top: -35px; color: #666;">Volver a Bandeja</a>
            <p style="font-size: 12px; color: #888;">Trámite de: <?php echo $tramite_actual['usuario']; ?></p>
        </div>
        
        <form method="POST" action="motor.php">
            <input type="hidden" name="flojo" value="<?php echo $flojo;?>"/>
            <input type="hidden" name="proceso" value="<?php echo $proceso;?>"/>
            <input type="hidden" name="id_tramite" value="<?php echo $id_tramite;?>"/>
            
            <?php
            if (file_exists($pantalla . ".inc.php")) {
                include $pantalla . ".inc.php";
            } else {
                echo "<div class='alert alert-danger'>No se encontró la vista para: $pantalla</div>";
            }
            ?>
            
            <hr style="margin-top: 30px; margin-bottom: 20px; border: 0; border-top: 1px solid #eee;">
            
            <?php if ($tipo == 'Q') { ?>
                <?php if (!isset($ocultar_botones_q) || !$ocultar_botones_q) { ?>
                    <!-- Si la vista no define ocultar los botones, los mostramos -->
                    <input type="submit" name="Si" value="Aprobar (Sí)" class="btn btn-success"/>
                    <input type="submit" name="No" value="Rechazar (No)" class="btn btn-danger"/>
                <?php } ?>
            <?php } elseif ($tipo == 'F') { ?>
                <!-- Fin del flujo -->
                <a href="bandejae.php" class="btn btn-primary">Volver a Bandeja</a>
            <?php } else { ?>
                <!-- Botones normales -->
                <input type="submit" name="Siguiente" value="Siguiente" class="btn btn-primary"/>
            <?php } ?>
        </form>
    </div>
</body>
</html>

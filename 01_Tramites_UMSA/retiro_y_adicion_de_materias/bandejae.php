<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciologin.php");
    exit();
}

include "conexion.php";
$seguimiento = leer_json("seguimiento");

// Filtrar por el usuario actual activos
$tramites_usuario = array_filter($seguimiento, function($tramite) {
    return $tramite['usuario'] == $_SESSION['usuario'] && $tramite['fechafin'] == null;
});

// Filtrar historial
$historial_usuario = array_filter($seguimiento, function($tramite) {
    return $tramite['usuario'] == $_SESSION['usuario'] && $tramite['fechafin'] != null;
});
?>
<html>
<head>
    <title>Bandeja de Entrada</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        a { text-decoration: none; color: #007bff; font-weight: bold; }
        a:hover { color: #0056b3; text-decoration: underline; }
        .btn-nuevo { display: inline-block; padding: 10px 15px; background-color: #28a745; color: white; border-radius: 4px; margin-bottom: 20px; }
        .btn-nuevo:hover { background-color: #218838; text-decoration: none; }
        .logout { float: right; color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" class="logout">Cerrar Sesión</a>
        <h2>Bandeja de Entrada - <?php echo $_SESSION['usuario']; ?></h2>
        
        <?php if(empty($tramites_usuario)): ?>
            <p>No tienes trámites en curso.</p>
            <form method="POST" action="nuevo_tramite.php">
                <input type="submit" class="btn-nuevo" style="border:none; cursor:pointer;" value="Iniciar Trámite de Retiro/Adición" />
            </form>
        <?php else: ?>
            <table>
                <tr>
                    <th>ID Trámite</th>
                    <th>Flujo</th>
                    <th>Proceso Actual</th>
                    <th>Fecha Inicio</th>
                    <th>Acción</th>
                </tr>
                <?php foreach ($tramites_usuario as $tramite): ?>
                <tr>
                    <td><?php echo $tramite['id']; ?></td>
                    <td><?php echo $tramite['flujo']; ?></td>
                    <td><?php echo $tramite['proceso']; ?></td>
                    <td><?php echo $tramite['fechaini']; ?></td>
                    <td><a href="index.php?flojo=<?php echo $tramite['flujo']; ?>&proceso=<?php echo $tramite['proceso']; ?>&id_tramite=<?php echo $tramite['id']; ?>">Ir al trámite</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <?php if(!empty($historial_usuario)): ?>
            <h3 style="margin-top: 40px;">Historial de Trámites Finalizados</h3>
            <table>
                <tr>
                    <th>ID Trámite</th>
                    <th>Proceso Final</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Ver Boleta/Estado</th>
                </tr>
                <?php foreach ($historial_usuario as $tramite): ?>
                <tr>
                    <td><?php echo $tramite['id']; ?></td>
                    <td><?php echo $tramite['proceso']; ?></td>
                    <td><?php echo $tramite['fechaini']; ?></td>
                    <td><?php echo $tramite['fechafin']; ?></td>
                    <td><a href="index.php?flojo=<?php echo $tramite['flujo']; ?>&proceso=<?php echo $tramite['proceso']; ?>&id_tramite=<?php echo $tramite['id']; ?>">Ver Resultado</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

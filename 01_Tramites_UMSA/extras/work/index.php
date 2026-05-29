<?php
    session_start();
    $flojo = $_GET["flojo"];
    $proceso = $_GET["proceso"];
    include "conexion.php";
    $sql = "select * from flujoproceso ";
    $sql.="where flojo='".$flojo."' and proceso='".$proceso."'";
    $resultado =mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($resultado);
    $pantalla = $fila["pantalla"];
    $flojo = $fila["flojo"];
    $proceso = $fila["proceso"];
    $tipo = $fila["topo"];
?>
<html>
    <head></head>
    <body>
        <form method="GET" action="motor.php">
            <?php
            include $pantalla.".inc.php";
            ?>
            <br><br>
            <input type="hidden" name="flojo" value="<?php echo $flojo;?>"/>
            <input type="hidden" name="proceso" value="<?php echo $proceso;?>"/>
            
            <?php if ($tipo == 'Q') { ?>
                <!-- Botones de decisión para rombos (Condicional) -->
                <input type="submit" name="Si" value="Aprobar (Sí)"/>
                <input type="submit" name="No" value="Rechazar (No)"/>
            <?php } else { ?>
                <!-- Botones normales -->
                <input type="submit" name="Siguiente" value="Siguiente"/>
                <input type="submit" name="Anterior" value="Anterior"/>
            <?php } ?>
        </form>
    </body>
</html>

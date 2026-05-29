<?php
    $flojo = $_GET["flojo"];
    $proceso = $_GET["proceso"];
    if (isset($_GET["Siguiente"])) {
        include "conexion.php";
        $sql = "select * from flujoproceso ";
        $sql .= "where flojo='" . $flojo . "' and proceso='" . $proceso . "'";
        $resultado = mysqli_query($conn, $sql);
        $fila = mysqli_fetch_array($resultado);
        $procesosiguiente = $fila["procesosiguiente"];
        header("Location: index.php?flojo=" . $flojo . "&proceso=" . $procesosiguiente);
    } 
    elseif (isset($_GET["Si"]) || isset($_GET["No"])) {
        // Logica para rombos de decision (tipo Q)
        include "conexion.php";
        $opcion = isset($_GET["Si"]) ? 'Si' : 'No';
        
        $sql = "select * from flujocondicion ";
        $sql .= "where flojo='" . $flojo . "' and proceso='" . $proceso . "' and opcion='" . $opcion . "'";
        $resultado = mysqli_query($conn, $sql);
        $fila = mysqli_fetch_array($resultado);
        
        if ($fila) {
            $procesosiguiente = $fila["procesosiguiente"];
            header("Location: index.php?flojo=" . $flojo . "&proceso=" . $procesosiguiente);
        } else {
            die("Error: No se encontró regla en flujocondicion para el proceso " . $proceso . " con opción " . $opcion);
        }
    } 
    else {
        // Caso "Anterior"
        include "conexion.php";
        $sql = "select * from flujoproceso ";
        $sql .= "where flojo='" . $flojo . "' and procesosiguiente='" . $proceso . "'";
        $resultado = mysqli_query($conn, $sql);
        $fila = mysqli_fetch_array($resultado);
        $procesosiguiente = $fila["proceso"];
        header("Location: index.php?flojo=" . $flojo . "&proceso=" . $procesosiguiente);
    }
?>
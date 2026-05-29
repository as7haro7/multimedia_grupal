<?php
    $usuario = $_GET["usuario"];
    $clave = $_GET["clave"];
    include "conexion.php";
    $sql = "select count(*) as contador from bd.alumno ";
    $sql.="where usuario='".$usuario."' and clave='".$clave."'";
    $resultado =mysqli_query($conn, $sql);
    if (!$resultado) {
        die("Error en la consulta SQL: " . mysqli_error($conn) . "<br>La consulta fue: " . $sql);
    }
    $fila = mysqli_fetch_array($resultado);
    
    if ($fila['contador']>=1)
        {
        session_start();
        $_SESSION["usuario"]=$usuario;
        header("Location: bandejae.php");
        }
    else 
        {
        die("<div style='padding:20px; border:2px solid red; font-size:20px;'>
             <b>Error de Login</b><br><br>
             El sistema se conectó perfectamente a la base de datos, pero no encontró este usuario.<br>
             Usuario que escribiste: <b>'$usuario'</b><br>
             Clave que escribiste: <b>'$clave'</b><br>
             Resultado de la base de datos: <b>" . $fila['contador'] . "</b> coincidencias.<br><br>
             Posibles causas:<br>
             1. Escribiste mal el usuario (recuerda usar <b>m1</b> y no root).<br>
             2. Tu base de datos 'bd' sí existe, pero la tabla 'alumno' está vacía y no tiene alumnos guardados.
             </div>");
        }
?>
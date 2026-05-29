<?php
    // Archivo central de conexión a la base de datos
    $db_servidor = "localhost";
    $db_usuario = "root";
    $db_clave = "123456";
    $db_nombre = "workflow";

    // Intentar conectar
    $conn = mysqli_connect($db_servidor, $db_usuario, $db_clave, $db_nombre);

    // Verificar conexión
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
?>

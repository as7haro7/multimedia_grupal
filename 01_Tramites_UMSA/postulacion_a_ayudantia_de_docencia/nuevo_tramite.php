<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'postulante') {
    header("Location: iniciologin.php");
    exit();
}

include "conexion.php";
$seguimiento = leer_json("seguimiento");

// Crear nuevo trámite
$nuevo_id = count($seguimiento) > 0 ? end($seguimiento)['id'] + 1 : 1;
$nuevo_tramite = [
    "id" => $nuevo_id,
    "flujo" => "F2",
    "proceso" => "P1",
    "usuario" => $_SESSION['usuario'],
    "fechaini" => date("Y-m-d"),
    "fechafin" => null,
    "datos" => []
];

$seguimiento[] = $nuevo_tramite;
escribir_json("seguimiento", $seguimiento);

header("Location: bandejae.php");
exit();
?>

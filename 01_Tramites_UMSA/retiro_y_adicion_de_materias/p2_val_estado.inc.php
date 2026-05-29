<?php
// p2_val_estado.inc.php
$ocultar_botones_q = true; // Ocultamos los botones Si/No manuales

$valido = true;
if ($estudiante['deudas_biblioteca'] || $estudiante['multas_electorales']) {
    $valido = false;
    echo "<div class='alert alert-danger'>Usted tiene deudas pendientes en biblioteca o multas electorales.</div>";
}
if (!$estudiante['estudiante_regular']) {
    $valido = false;
    echo "<div class='alert alert-danger'>Usted no figura como estudiante regular matriculado en la gestión actual.</div>";
}

if ($valido) {
    echo "<div class='alert alert-success'>Validación de Estado Institucional exitosa. No tiene bloqueos.</div>";
}

$opcion = $valido ? "Si" : "No";
?>
<input type="hidden" name="opcion_evaluada" value="<?php echo $opcion; ?>"/>
<p>Presione "Siguiente" para continuar.</p>
<input type="submit" name="Siguiente_auto" value="Siguiente" class="btn btn-primary"/>

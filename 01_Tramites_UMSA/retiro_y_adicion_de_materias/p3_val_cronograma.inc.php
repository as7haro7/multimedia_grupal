<?php
// p3_val_cronograma.inc.php
$ocultar_botones_q = true;

$abierto = $cronograma['sistema_abierto'];

if ($abierto) {
    echo "<div class='alert alert-success'>El sistema se encuentra abierto según el cronograma.</div>";
} else {
    echo "<div class='alert alert-danger'>El sistema se encuentra cerrado para retiros y adiciones en este momento.</div>";
}

$opcion = $abierto ? "Si" : "No";
?>
<input type="hidden" name="opcion_evaluada" value="<?php echo $opcion; ?>"/>
<p>Presione "Siguiente" para continuar.</p>
<input type="submit" name="Siguiente_auto" value="Siguiente" class="btn btn-primary"/>

<?php
// p5_val_retiros.inc.php
$ocultar_botones_q = true;

$materias_retirar = isset($_SESSION['tramite_'.$id_tramite]['materias_retirar']) ? $_SESSION['tramite_'.$id_tramite]['materias_retirar'] : [];
$total_inscritas = count($estudiante['materias_inscritas']);
$total_retiradas = count($materias_retirar);

$queda_en_cero = false;
if ($total_inscritas > 0 && ($total_inscritas - $total_retiradas) <= 0 && count(isset($_SESSION['tramite_'.$id_tramite]['materias_adicionar']) ? $_SESSION['tramite_'.$id_tramite]['materias_adicionar'] : []) == 0) {
    $queda_en_cero = true;
}

if ($queda_en_cero) {
    echo "<div class='alert alert-warning'>Alerta: El retiro lo deja con 0 materias inscritas.</div>";
} else {
    echo "<div class='alert alert-success'>Validación de límite de retiros correcta. No queda con 0 materias.</div>";
}

$opcion = $queda_en_cero ? "Si" : "No";
?>
<input type="hidden" name="opcion_evaluada" value="<?php echo $opcion; ?>"/>
<p>Presione "Siguiente" para continuar.</p>
<input type="submit" name="Siguiente_auto" value="Siguiente" class="btn btn-primary"/>

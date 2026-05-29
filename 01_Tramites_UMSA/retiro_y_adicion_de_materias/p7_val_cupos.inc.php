<?php
// p7_val_cupos.inc.php
$ocultar_botones_q = true;

$materias_adicionar = isset($_SESSION['tramite_'.$id_tramite]['materias_adicionar']) ? $_SESSION['tramite_'.$id_tramite]['materias_adicionar'] : [];

$hay_cupos = true;
$errores = [];

foreach ($materias_adicionar as $sigla_add) {
    foreach ($materias as $m) {
        if ($m['sigla'] == $sigla_add) {
            if ($m['cupos'] <= 0) {
                $hay_cupos = false;
                $errores[] = "Cupos agotados para la materia $sigla_add. Sugerencia: Inscríbase en Lista de Espera.";
            }
        }
    }
}

if ($hay_cupos) {
    echo "<div class='alert alert-success'>Validación de Concurrencia superada. Hay cupos disponibles.</div>";
} else {
    echo "<div class='alert alert-danger'>No hay cupos suficientes:<br>" . implode("<br>", $errores) . "</div>";
    echo "<p>Debe volver a la pantalla de selección.</p>";
}

$opcion = $hay_cupos ? "Si" : "No";
?>
<input type="hidden" name="opcion_evaluada" value="<?php echo $opcion; ?>"/>
<p>Presione "Siguiente" para continuar.</p>
<input type="submit" name="Siguiente_auto" value="Siguiente" class="btn btn-primary"/>

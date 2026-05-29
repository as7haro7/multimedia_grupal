<?php
// p6_val_academica.inc.php
$ocultar_botones_q = true;

$materias_adicionar = isset($_SESSION['tramite_'.$id_tramite]['materias_adicionar']) ? $_SESSION['tramite_'.$id_tramite]['materias_adicionar'] : [];
$materias_aprobadas = $estudiante['materias_aprobadas'];

$valido = true;
$errores = [];

foreach ($materias_adicionar as $sigla_add) {
    // Buscar info de la materia
    foreach ($materias as $m) {
        if ($m['sigla'] == $sigla_add) {
            if (!empty($m['prerrequisito']) && !in_array($m['prerrequisito'], $materias_aprobadas)) {
                $valido = false;
                $errores[] = "No cumple prerrequisito para $sigla_add (Requiere: {$m['prerrequisito']})";
            }
        }
    }
}

// Simulacion de limite de creditos
if (count($materias_adicionar) + count($estudiante['materias_inscritas']) - count(isset($_SESSION['tramite_'.$id_tramite]['materias_retirar'])?$_SESSION['tramite_'.$id_tramite]['materias_retirar']:[]) > 7) {
    $valido = false;
    $errores[] = "Supera el límite de materias permitidas (máx 7).";
}

if ($valido) {
    echo "<div class='alert alert-success'>Validación Académica superada (Prerrequisitos, Límites).</div>";
} else {
    echo "<div class='alert alert-danger'>Problemas detectados:<br>" . implode("<br>", $errores) . "</div>";
    echo "<p>Debe volver a la pantalla de selección.</p>";
}

$opcion = $valido ? "Si" : "No";
?>
<input type="hidden" name="opcion_evaluada" value="<?php echo $opcion; ?>"/>
<p>Presione "Siguiente" para procesar validación.</p>
<input type="submit" name="Siguiente_auto" value="Siguiente" class="btn btn-primary"/>

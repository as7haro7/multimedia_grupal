<?php
$ocultar_botones_q = true;

// Reglas: Cualquier materia aprobada >= 51 (esto asume que si postula, necesita al menos alguna materia. O mejor, si no tiene nada aprobado = false). 
// Además, limite ayudantías < 2.
$tiene_materias_aprobadas = false;
foreach ($perfil['notas'] as $sigla => $nota) {
    if ($nota >= 51) $tiene_materias_aprobadas = true;
}
$limite_ayudantias = $perfil['ayudantias_activas'] < 2;

$valido = true;
if (!$tiene_materias_aprobadas) {
    echo "<div class='alert alert-danger'>Usted no tiene materias aprobadas habilitadas para ser auxiliar.</div>";
    $valido = false;
}
if (!$limite_ayudantias) {
    echo "<div class='alert alert-danger'>Límite de carga horaria excedido: Ya cuenta con 2 ayudantías activas.</div>";
    $valido = false;
}

if ($valido) {
    echo "<div class='alert alert-success'>Filtro superado: Cumple los requisitos mínimos.</div>";
}

$opcion = $valido ? "Si" : "No";
?>
<input type="hidden" name="opcion_evaluada" value="<?php echo $opcion; ?>"/>
<p>Presione "Siguiente" para continuar.</p>
<input type="submit" name="Siguiente_auto" value="Siguiente" class="btn btn-primary"/>

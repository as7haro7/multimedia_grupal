<?php
$ocultar_botones_q = true;
$materia = $tramite_actual['datos']['materia'];
$plazas = 1;
foreach ($convocatorias as $c) {
    if ($c['sigla'] == $materia) $plazas = $c['plazas'];
}

// Simulamos la competencia evaluando al azar si alcanza, no alcanza o empata (para propósito demostrativo)
// En un sistema real esto compararía con los otros trámites finalizados.
$estado_plaza = "Titular";
$opcion = "Si"; // Por defecto, pasa a P9 (Consejo)

// Vamos a dar la opción manual al tribunal para simular el caso de empate
?>
<h3>Validación de Plazas y Desempates</h3>
<div class="alert alert-info">
    <p>Para la materia <strong><?php echo $materia; ?></strong> existen <strong><?php echo $plazas; ?></strong> plazas disponibles.</p>
    <p>Nota final del postulante: <strong><?php echo $tramite_actual['datos']['nota_final']; ?></strong></p>
</div>

<h4>Asigne el resultado final:</h4>
<div style="display: flex; gap: 10px;">
    <!-- Si es Titular o Suplente, pasa a Consejo para homologar (ambos van a Si -> P9) -->
    <button type="submit" name="opcion_manual" value="Si" class="btn btn-success">Alcanza Plaza (Titular)</button>
    <button type="submit" name="opcion_manual" value="Si" class="btn btn-primary">No alcanza plaza (Invitado/Suplente)</button>
    
    <!-- Si hay empate exacto en la última plaza, el tribunal aplica la regla -->
    <button type="submit" name="opcion_manual" value="Empate" class="btn btn-warning">Empate exacto en la última plaza</button>
</div>

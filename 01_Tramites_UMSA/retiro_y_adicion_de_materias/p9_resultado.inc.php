<?php
// p9_resultado.inc.php

// Obtener info actualizada del estudiante
$estudiantes = leer_json("estudiantes");
$estudiante_actualizado = null;
foreach ($estudiantes as $e) {
    if ($e['usuario'] == $_SESSION['usuario']) {
        $estudiante_actualizado = $e;
        break;
    }
}
?>
<div class="alert alert-info">
    <h4>Boleta de Inscripción Actualizada</h4>
    <p><strong>Estudiante:</strong> <?php echo $estudiante_actualizado['nombre']; ?></p>
    <p><strong>Materias Inscritas Actualmente:</strong></p>
    <ul>
        <?php foreach($estudiante_actualizado['materias_inscritas'] as $mat): ?>
            <li><?php echo $mat; ?></li>
        <?php endforeach; ?>
    </ul>
    <p>El trámite ha finalizado correctamente.</p>
</div>

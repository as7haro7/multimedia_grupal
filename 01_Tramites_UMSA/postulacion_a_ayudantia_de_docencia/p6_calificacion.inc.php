<?php $ocultar_botones_q = true; ?>
<h3>Calificación del Tribunal</h3>
<p>Ingrese la nota obtenida por el postulante en el examen de competencia (0 - 100).</p>

<div style="margin-bottom: 15px;">
    <label><strong>Nota del Examen:</strong></label><br>
    <input type="number" name="nota_examen" min="0" max="100" style="padding: 5px; width: 150px;" />
</div>

<h4>Decisión:</h4>
<div style="display: flex; gap: 10px;">
    <!-- Como enviamos la nota, motor.php guardará la nota, y esta opción define el camino -->
    <button type="submit" name="opcion_manual" value="Si" class="btn btn-success" onclick="if(!document.getElementsByName('nota_examen')[0].value) { alert('Ingrese la nota'); return false; }">Aprobado (>= 51)</button>
    <button type="submit" name="opcion_manual" value="No" class="btn btn-danger" onclick="if(!document.getElementsByName('nota_examen')[0].value) { alert('Ingrese la nota'); return false; }">Reprobado (< 51)</button>
    <button type="submit" name="opcion_manual" value="NSP" class="btn btn-secondary">NSP (No se presentó)</button>
</div>

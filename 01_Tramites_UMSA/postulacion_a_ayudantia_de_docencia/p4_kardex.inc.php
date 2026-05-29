<?php $ocultar_botones_q = true; ?>
<h3>Revisión de Kárdex</h3>
<p>Verifique los documentos presentados por el postulante <strong><?php echo $tramite_actual['usuario']; ?></strong> para la materia <strong><?php echo $tramite_actual['datos']['materia']; ?></strong>.</p>

<div class="alert alert-info">
    <strong>Archivo adjunto:</strong> <a href="#"><?php echo $tramite_actual['datos']['pdf']; ?></a>
</div>

<h4>Decisión Kárdex:</h4>
<div style="display: flex; gap: 10px;">
    <button type="submit" name="opcion_manual" value="Aprobado" class="btn btn-success">Aprobar (Habilitar para Examen)</button>
    <button type="submit" name="opcion_manual" value="Observado" class="btn btn-warning">Observar (Devolver a Estudiante)</button>
    <button type="submit" name="opcion_manual" value="Rechazado" class="btn btn-danger">Rechazar (Fraude/Falso)</button>
    <!-- Abandono si pasó el tiempo -->
    <button type="submit" name="opcion_manual" value="Abandono" class="btn btn-secondary">Declarar Abandono (Tiempo expirado)</button>
</div>

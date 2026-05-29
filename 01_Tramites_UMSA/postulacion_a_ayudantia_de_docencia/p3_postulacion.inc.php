<h3>Formulario de Postulación</h3>
<p>Seleccione la materia a la que desea postular y suba su historial académico.</p>

<div style="margin-bottom: 15px;">
    <label><strong>Materia a postular:</strong></label><br>
    <select name="materia_postulada" required style="padding: 5px; width: 100%; max-width: 300px;">
        <?php foreach ($convocatorias as $c): ?>
            <option value="<?php echo $c['sigla']; ?>"><?php echo $c['sigla'] . ' - ' . $c['nombre']; ?> (Plazas: <?php echo $c['plazas']; ?>)</option>
        <?php endforeach; ?>
    </select>
</div>

<div style="margin-bottom: 15px;">
    <label><strong>Historial Académico (PDF simulado):</strong></label><br>
    <input type="text" name="archivo_pdf" placeholder="URL o nombre del archivo" required style="padding: 5px; width: 100%; max-width: 300px;" value="historial_<?php echo $_SESSION['usuario']; ?>.pdf" />
</div>

<p>Estado actual: <em>Postulado (Borrador)</em></p>

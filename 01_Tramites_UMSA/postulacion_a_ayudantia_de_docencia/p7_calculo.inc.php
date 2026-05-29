<h3>Cálculo Ponderado Automático</h3>
<?php
$nota_examen = $tramite_actual['datos']['nota_examen'];
$materia = $tramite_actual['datos']['materia'];
$nota_historial = isset($perfil['notas'][$materia]) ? $perfil['notas'][$materia] : 51; // Por si acaso

// 60% examen, 40% méritos
$ponderado = ($nota_examen * 0.6) + ($nota_historial * 0.4);
?>
<p><strong>Nota de Examen (60%):</strong> <?php echo $nota_examen; ?> -> <?php echo $nota_examen * 0.6; ?></p>
<p><strong>Nota de Méritos (40%):</strong> <?php echo $nota_historial; ?> -> <?php echo $nota_historial * 0.4; ?></p>
<p style="font-size: 18px;"><strong>Nota Final Ponderada:</strong> <?php echo number_format($ponderado, 2); ?></p>

<input type="hidden" name="nota_final" value="<?php echo number_format($ponderado, 2); ?>" />
<p>Presione "Siguiente" para guardar la calificación y validar las plazas.</p>

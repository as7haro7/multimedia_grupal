<h3>Selección de Materias</h3>
<p>Seleccione las materias que desea retirar y las que desea adicionar.</p>

<div style="display: flex; gap: 20px;">
    <div style="flex: 1; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">
        <h4>Materias Actuales (Para Retirar)</h4>
        <?php if(empty($estudiante['materias_inscritas'])): ?>
            <p>No tiene materias inscritas para retirar.</p>
        <?php else: ?>
            <?php foreach ($estudiante['materias_inscritas'] as $mat): ?>
                <label style="display: block; margin-bottom: 8px;">
                    <input type="checkbox" name="materias_retirar[]" value="<?php echo $mat; ?>"> <?php echo $mat; ?>
                </label>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div style="flex: 1; padding: 15px; border: 1px solid #ddd; border-radius: 4px;">
        <h4>Materias Disponibles (Para Adicionar)</h4>
        <?php foreach ($materias as $mat): ?>
            <?php if (!in_array($mat['sigla'], $estudiante['materias_inscritas'])): ?>
                <label style="display: block; margin-bottom: 8px;">
                    <input type="checkbox" name="materias_adicionar[]" value="<?php echo $mat['sigla']; ?>"> <?php echo $mat['sigla'] . " - " . $mat['nombre'] . " (Cupos: " . $mat['cupos'] . ")"; ?>
                </label>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

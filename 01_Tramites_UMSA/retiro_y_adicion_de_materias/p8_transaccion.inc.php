<?php
// p8_transaccion.inc.php
$materias_adicionar = isset($_SESSION['tramite_'.$id_tramite]['materias_adicionar']) ? $_SESSION['tramite_'.$id_tramite]['materias_adicionar'] : [];
$materias_retirar = isset($_SESSION['tramite_'.$id_tramite]['materias_retirar']) ? $_SESSION['tramite_'.$id_tramite]['materias_retirar'] : [];

// Actualizar en caliente los JSON
// 1. Descontar cupos en materias.json
$mat_json = leer_json("materias");
$cupos_descontados = false;
foreach ($mat_json as &$m) {
    if (in_array($m['sigla'], $materias_adicionar)) {
        if ($m['cupos'] > 0) {
            $m['cupos'] -= 1;
            $cupos_descontados = true;
        }
    }
}
if ($cupos_descontados) {
    escribir_json("materias", $mat_json);
}

// 2. Actualizar estudiante en estudiantes.json
$est_json = leer_json("estudiantes");
$est_actualizado = false;
foreach ($est_json as &$e) {
    if ($e['usuario'] == $_SESSION['usuario']) {
        // Eliminar retiradas
        $e['materias_inscritas'] = array_diff($e['materias_inscritas'], $materias_retirar);
        // Añadir nuevas
        $e['materias_inscritas'] = array_merge($e['materias_inscritas'], $materias_adicionar);
        // Quitar duplicados por si acaso y reindexar
        $e['materias_inscritas'] = array_values(array_unique($e['materias_inscritas']));
        $est_actualizado = true;
        break;
    }
}
if ($est_actualizado) {
    escribir_json("estudiantes", $est_json);
}

// Limpiar variables de sesion
unset($_SESSION['tramite_'.$id_tramite]['materias_adicionar']);
unset($_SESSION['tramite_'.$id_tramite]['materias_retirar']);
?>
<div class="alert alert-success">
    <h4>Transacción Segura Completada</h4>
    <p>Se ha realizado la reserva de cupos y actualización del kárdex exitosamente.</p>
</div>
<p>Presione "Siguiente" para generar la boleta de inscripción.</p>

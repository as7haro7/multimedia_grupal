<?php
// conexion.php: Funciones para manejar la base de datos JSON
function leer_json($archivo) {
    $ruta = __DIR__ . "/db/" . $archivo . ".json";
    if (file_exists($ruta)) {
        $contenido = file_get_contents($ruta);
        return json_decode($contenido, true);
    }
    return null;
}

function escribir_json($archivo, $datos) {
    $ruta = __DIR__ . "/db/" . $archivo . ".json";
    // Bloqueo de concurrencia simulado con flock
    $fp = fopen($ruta, 'c+');
    if (flock($fp, LOCK_EX)) {
        ftruncate($fp, 0); // Vaciamos el archivo
        fwrite($fp, json_encode($datos, JSON_PRETTY_PRINT));
        fflush($fp);            // flush antes de liberar el bloqueo
        flock($fp, LOCK_UN);    // Libera el bloqueo
    }
    fclose($fp);
}
?>

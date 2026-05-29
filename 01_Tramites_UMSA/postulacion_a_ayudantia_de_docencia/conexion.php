<?php
// conexion.php
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
    $fp = fopen($ruta, 'c+');
    if (flock($fp, LOCK_EX)) {
        ftruncate($fp, 0); 
        fwrite($fp, json_encode($datos, JSON_PRETTY_PRINT));
        fflush($fp);
        flock($fp, LOCK_UN);
    }
    fclose($fp);
}
?>

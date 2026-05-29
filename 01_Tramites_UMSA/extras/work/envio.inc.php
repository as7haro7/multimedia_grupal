<?php
    include "conexion.php";
    $sql = "select * from bd.alumno ";
    $sql.="where usuario='".$_SESSION["usuario"]."' " ;
    $resultado =mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($resultado);
    $nombre = $fila['nombre'];
    $paterno = $fila['paterno'];
    $materno = $fila['materno'];
?>
<h2>Paso 3: Revisión de Envíos</h2>
<p style="font-size:16px;">
    <b>Área de Kardex</b><br>
    A continuación se muestran los datos del estudiante que solicitó el trámite:
</p>
<p>
    <label>Nombre:</label><br>
    <input type='text' name='nombre' value="<?php echo $nombre; ?>" readonly/>
</p>
<p>
    <label>Apellido Paterno:</label><br>
    <input type='text' name='paterno' value="<?php echo $paterno; ?>" readonly/>
</p>
<p>
    <label>Apellido Materno:</label><br>
    <input type='text' name='materno' value="<?php echo $materno; ?>" readonly/>
</p>
<hr>
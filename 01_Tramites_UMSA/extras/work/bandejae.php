<?php
session_start();


    include "conexion.php";
    $sql = "select * from seguimiento ";
    $sql.="where fechafin is null and usuario='$_SESSION[usuario]'" ;
    $resultado =mysqli_query($conn, $sql);
    
    
?>
<html>
    <head></head>
    <body>
        <table>
            <tr>
                <td>
                    flujo
                </td>
                <td>
                    proceso
                </td>
                <td>
                    fecha inicio
                </td>
                <td>
                    ir a flujo
                </td>
            </tr>
            <?php
            while ($fila = mysqli_fetch_array($resultado)) {
                echo"<tr>";
                echo"<td>";
                echo"    $fila[flojo]";
                echo"</td>";
                echo"<td>";
                echo"    $fila[proceso]";
                echo"</td>";
                echo"<td>";
                echo"    $fila[fechaini]";
                echo"</td>";
                echo"<td>";
                echo"<a href='index.php?flojo=$fila[flojo]&proceso=$fila[proceso]'  ";
                echo ">Ir";
                echo "</a>";
                echo"</td>";
            echo"</tr>";
            }
            ?>       
        </table>
    </body>
</html>

<?php
$placas = $_GET['placas'];

$enlace = mysqli_connect("127.0.0.1", "homestead", "secret", "hacienda");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

/* recuperar todas las filas del carro especificado */
$consulta = "SELECT * FROM carros WHERE placas = '$placas' ";

if ($resultado = mysqli_query($enlace, $consulta)) {
    echo "<ul>";
    while ($fila = mysqli_fetch_row($resultado)) {
?>
        <form action="borrar2.php" method="post"><br>
            <input type="hidden" name="placas" value="<?php echo $fila[0] ?>"><br>
            ESTA SEGURO DE QUE DESEA ELIMINAR EL CARRO CON DESCRIPPION: <?php echo $fila[2] ?><br>
            <input type="submit" value="BORRAR">
        </form>
<?php
    }
    echo "</ul>";
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
}

mysqli_close($enlace);
?>
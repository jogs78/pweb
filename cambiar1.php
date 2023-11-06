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
        <form action="cambiar2.php" method="post"><br>
            PLACAS: <input type="text" name="placas" value="<?php echo $fila[0] ?>"><br>
            PRECIO: <input type="text" name="precio" value="<?php echo $fila[1] ?>"><br>
            DESCRIPCCION: <input type="text" name="descripcion" value="<?php echo $fila[2] ?>"><br>
            <input type="submit" value="CAMBIAR">
        </form>
<?php
    }
    echo "</ul>";
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
}

mysqli_close($enlace);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTADO DE CARROS</title>
</head>
<body>
    


<?php
$enlace = mysqli_connect("127.0.0.1", "homestead", "secret", "hacienda");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos hacienda es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;

//mysqli_close($enlace);
?>

<HR>

<?php
/* recuperar todas las filas de carros */
$consulta = "SELECT * FROM carros";

if ($resultado = mysqli_query($enlace, $consulta)) {
    echo "<ul>";

    while ($fila = mysqli_fetch_row($resultado)) {
        echo "<li>";
        printf("%s (%f,%s)  - ", $fila[0], $fila[1], $fila[2]);
        echo '<a href="cambiar1.php?placas=' . $fila[0] . '">EDITAR  -</a>';
        echo '<a href="borrar1.php?placas=' . $fila[0] . '">BORRAR</a>';
        echo "</li>";
    }
    echo "</ul>";
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
}

mysqli_close($enlace);
?>
<HR>
SI QUIERES INSERTAR UN NUEVO CARRO DEBES IR <a href="insertar1.php">AQUI</a> 


</body>
</html>
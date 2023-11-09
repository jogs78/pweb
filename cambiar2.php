<?php

$placas = $_POST['placas'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

$enlace = mysqli_connect("127.0.0.1", "homestead", "secret", "hacienda");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/* Preparar una sentencia UPDATE */
$consulta = "UPDATE carros SET precio=?, descripcion=? WHERE placas=?";
$sentencia = mysqli_prepare($enlace, $consulta);

mysqli_stmt_bind_param($sentencia, "dss", $precio, $descripcion, $placas);

/* Ejecutar la sentencia */
$resultado = mysqli_stmt_execute($sentencia);

if($resultado){
    header('Location: listar.php');
    //echo "se guardo correctamente.... ";
}else{
    echo "no se guardo correctamente....";
}
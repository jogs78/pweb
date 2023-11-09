<?php
require 'Carro.php';
$objeto = new Carro();
if(  isset( $_POST['accion']  )    ){
    $objeto->insertar(  $_POST['placas']  , $_POST['precio']     , $_POST['descripcion']  );

}

$objeto->todos();
?>
<form action="" method="post">
    PLACAS: <input type="text" name="placas"><br>
    PRECIO: <input type="text" name="precio"><br>
    DESCRIPCCION: <input type="text" name="descripcion"><br>
    <input type="hidden" name="accion" value="alta">
    <input type="submit" name="boton" value="DAR DE ALTA">
    </form>
</form>
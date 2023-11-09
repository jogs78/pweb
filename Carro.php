<?php
class carro {
    private $servidor = "127.0.0.1";
    private $db_name  = "hacienda";
    private $db_user  = "homestead";
    private $db_pass  = "secret";
    private $enlace = null;

    public function __construct(){
        $this->enlace = mysqli_connect($this->servidor, $this->db_user, $this->db_pass, $this->db_name);
    }

    public function todos(){
        $consulta = "SELECT * FROM carros";
        if ($resultado = mysqli_query($this->enlace, $consulta)) {
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
    }
    public function insertar($placas, $precio, $descripcion){
        /* Preparar una sentencia INSERT */
        $consulta = "INSERT INTO carros (placas, precio, descripcion) VALUES (?,?,?)";
        $sentencia = mysqli_prepare($this->enlace, $consulta);

        mysqli_stmt_bind_param($sentencia, "sds", $placas, $precio, $descripcion);
        /* Ejecutar la sentencia */
        $resultado = mysqli_stmt_execute($sentencia);
    }
    
    public function actualizar($placas, $precio, $descripcion){
        /* Preparar una sentencia UPDATE */
        $consulta = "UPDATE carros SET precio=?, descripcion=? WHERE placas=?";
        $sentencia = mysqli_prepare($this->enlace, $consulta);
        mysqli_stmt_bind_param($sentencia, "dss", $precio, $descripcion, $placas);
        /* Ejecutar la sentencia */
        $resultado = mysqli_stmt_execute($sentencia);
    }

    public function borrar($placas){
        /* Preparar una sentencia DELETE */
        $consulta = "DELETE FROM carros WHERE placas=?";
        $sentencia = mysqli_prepare($this->enlace, $consulta);
        mysqli_stmt_bind_param($sentencia, "s", $placas);
        /* Ejecutar la sentencia */
        $resultado = mysqli_stmt_execute($sentencia);
    }
}
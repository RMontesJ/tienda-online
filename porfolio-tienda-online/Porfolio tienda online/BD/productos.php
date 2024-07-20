<?php

class Productos{

    private $dbhost = 'localhost';
    private $dbuser = 'Rafa';
    private $dbpasswd = "1234";
    private $dbname = "app";

    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli($this->dbhost, $this->dbuser, $this->dbpasswd, $this->dbname);
        $this->conexion->select_db($this->dbname);
        $this->conexion->query("SET NAMES 'utf8'");
        if (!$this->conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }

    }

    public function crearProducto($nombre, $descripción, $categoria, $precio, $foto, $id){

        $query = mysqli_query($this->conexion, "INSERT INTO productos (nombre, descripción, categoria, precio, foto) VALUES ('$nombre','$descripción','$categoria','$precio', '$foto')");
        header("Location: indexRegistradoAdmin.php?id_user=$id");
        
    }

    public function editarProducto($id_usuario, $id_producto, $nombreNuevo, $descripcionNueva, $categoriaNueva, $precioNuevo) {
        $query = mysqli_query($this->conexion, "UPDATE productos SET nombre = '$nombreNuevo', descripción = '$descripcionNueva', categoria = '$categoriaNueva', precio = $precioNuevo WHERE id = $id_producto");
        
    }

}


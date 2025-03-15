<?php

class Productos{

    private $dbhost = 'localhost';
    private $dbuser = 'Rafa';
    private $dbpasswd = "1234";
    private $dbname = "tienda_online";

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

        $query = mysqli_query($this->conexion, "INSERT INTO productos (nombre, descripcion, categoria, precio, foto) VALUES ('$nombre','$descripción','$categoria','$precio', '$foto')");
        header("Location: indexRegistradoAdmin.php?id_user=$id");
        
    }

    public function editarProducto($id_usuario, $id_producto, $nombreNuevo, $descripcionNueva, $categoriaNueva, $precioNuevo) {
        $query = mysqli_query($this->conexion, "UPDATE productos SET nombre = '$nombreNuevo', descripción = '$descripcionNueva', categoria = '$categoriaNueva', precio = $precioNuevo WHERE id = $id_producto");
        header("Location: ../paginas/verProducto.php?id_user=$id_usuario&id_producto=$id_producto");
    }

    public function editarFoto($usuario, $id_producto, $foto){
        $query = mysqli_query($this->conexion, "UPDATE productos SET foto = '$foto' WHERE id = $id_producto");
        header("Location: ../paginas/verProducto.php?id_user=$usuario&id_producto=$id_producto");
    }

    public function cogerNombreProducto($id_producto){
        $query = mysqli_query($this->conexion, "SELECT * FROM productos where id = '$id_producto'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del nombre
            $nombre = $row['nombre'];
            return $nombre;
        } else {
            return "No se encontró nada";
        }
    }

    public function cogerDescripcionProducto($id_producto){
        $query = mysqli_query($this->conexion, "SELECT * FROM productos where id = '$id_producto'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor de la descripcion
            $descripcion = $row['descripción'];
            return $descripcion;
        } else {
            return "No se encontró nada";
        }
    }

    public function cogerCategoriaProducto($id_producto){
        $query = mysqli_query($this->conexion, "SELECT * FROM productos where id = '$id_producto'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del categoria
            $categoria = $row['categoria'];
            return $categoria;
        } else {
            return "No se encontró nada";
        }
    }

    public function cogerPrecioProducto($id_producto){
        $query = mysqli_query($this->conexion, "SELECT * FROM productos where id = '$id_producto'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del precio
            $precio = $row['precio'];
            return $precio;
        } else {
            return "No se encontró nada";
        }
    }

   

    public function cogerFotoProducto($id_producto){
        $query = mysqli_query($this->conexion, "SELECT * FROM productos where id = '$id_producto'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del precio
            $foto = $row['foto'];
            return $foto;
        } else {
            return "No se encontró nada";
        }
    }

}


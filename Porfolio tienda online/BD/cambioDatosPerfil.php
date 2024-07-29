<?php 

class cambioDatosPerfil{
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

    public function actualizarPerfil($nombre, $contrasena, $correo, $direccion, $id){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET nombre='$nombre', contrasena='$contrasena', correo='$correo', dirección='$direccion' WHERE id='$id'");

        if(strpos($correo, "@admin.com")){
            header("Location: ../paginas/perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../paginas/perfil.php?id_user=$id");
        }
    }

    public function cambiarFoto($id, $fotoNueva, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET foto='$fotoNueva' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../paginas/perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../paginas/perfil.php?id_user=$id");
        }
    }

}
?>
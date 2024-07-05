<?php 

class cambioDatosPerfil{
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

    public function cambiarNombre($id, $nombreNuevo, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET nombre='$nombreNuevo' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../perfil.php?id_user=$id");
        }

    }

    public function cambiarContrasena($id, $contrasenaNueva, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET contrasena='$contrasenaNueva' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../perfil.php?id_user=$id");
        }
    }

    public function cambiarCorreo($id, $correoNuevo, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET correo='$correoNuevo' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../perfil.php?id_user=$id");
        }
    }

    public function cambiarDireccion($id, $direccionNueva, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET dirección='$direccionNueva' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../perfil.php?id_user=$id");
        }
    }

}
?>
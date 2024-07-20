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
// metodo que cambia el nombre
    public function cambiarNombre($id, $nombreNuevo, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET nombre='$nombreNuevo' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../paginas/perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../paginas/perfil.php?id_user=$id");
        }

    }
// metodo que cambia la contraseña
    public function cambiarContrasena($id, $contrasenaNueva, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET contrasena='$contrasenaNueva' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../paginas/perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../paginas/perfil.php?id_user=$id");
        }
    }
// metodo que cambia el correo
    public function cambiarCorreo($id, $correoNuevo, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET correo='$correoNuevo' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
            header("Location: ../paginas/perfilAdmin.php?id_user=$id");
        }
        else{
            header("Location: ../paginas/perfil.php?id_user=$id");
        }
    }
// metodo que cambia la dirección
    public function cambiarDireccion($id, $direccionNueva, $verificarCorreo){
        $query = mysqli_query($this->conexion, "UPDATE usuarios SET dirección='$direccionNueva' WHERE id = '$id'");

        if(strpos($verificarCorreo, "@admin.com")){
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
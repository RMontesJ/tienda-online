<?php 

$usuario = $_GET['id_user'];

require_once "../BD/cambioDatosPerfil.php";
require_once "../BD/Datos.php";

$datosUsuario = new Datos();

$verificarCorreo = $datosUsuario->cogerCorreo($usuario);

$contrasenaNueva = $_POST['contrasenaNueva'];

$clase = new cambioDatosPerfil();

if(isset($contrasenaNueva)){

    $cambioContrasena = $clase->cambiarContrasena($usuario, $contrasenaNueva, $verificarCorreo);
    
}

?>
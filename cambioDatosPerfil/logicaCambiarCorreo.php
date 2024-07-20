<?php 

$usuario = $_GET['id_user'];

require_once "../BD/cambioDatosPerfil.php";
require_once "../BD/Datos.php";

$datosUsuario = new Datos();

$verificarCorreo = $datosUsuario->cogerCorreo($usuario);

$correoNuevo = $_POST['correoNuevo'];

$clase = new cambioDatosPerfil();

if(isset($correoNuevo)){

    $cambioCorreo = $clase->cambiarCorreo($usuario, $correoNuevo, $verificarCorreo);
    
}

?>
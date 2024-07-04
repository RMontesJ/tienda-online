<?php 

$usuario = $_GET['id_user'];

require_once "../BD/cambioDatosPerfil.php";
require_once "../BD/Datos.php";

$datosUsuario = new Datos();

$verificarCorreo = $datosUsuario->cogerCorreo($usuario);

$direccionNueva = $_POST['direccionNueva'];

$clase = new cambioDatosPerfil();

if(isset($direccionNueva)){

    $cambioDireccion = $clase->cambiarDireccion($usuario, $direccionNueva, $verificarCorreo);
    
}

?>
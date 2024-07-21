<?php 

$usuario = $_GET['id_user'];

require_once "../BD/cambioDatosPerfil.php";
require_once "../BD/Datos.php";

$datosUsuario = new Datos();

$verificarCorreo = $datosUsuario->cogerCorreo($usuario);

$nombreNuevo = $_POST['nombreNuevo'];

$clase = new cambioDatosPerfil();

// si se rellena el campo, actualiza el nombre
if(isset($nombreNuevo)){

    $cambioNombre = $clase->cambiarNombre($usuario, $nombreNuevo, $verificarCorreo);

}

?>
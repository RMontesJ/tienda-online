<?php

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";

if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
}

$datosUsuario = new Datos();
$correo = $datosUsuario->cogerCorreo($usuario);

$destinatario = $_POST['destinatario'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$cabeceras = 'From: ' . $correo . "\r\n" .
    'Reply-To: ' . $correo . "\r\n";

if(isset($destinatario) && isset($mensaje)){

    mail($destinatario, $asunto, $mensaje, $cabeceras);

}


?>
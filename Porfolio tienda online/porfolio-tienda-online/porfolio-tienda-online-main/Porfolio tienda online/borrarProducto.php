<?php 

require_once "BD/Datos.php";

$clase = new Datos();

$usuario = $_GET['id_user'];
$producto = $_GET['id_producto'];

$clase->borrarProducto($producto);

$correo = $clase->cogerCorreo($usuario);


if(!isset($usuario) || $usuario == ""){
    header("Location: inicio_sesion.php");
    }

if (strpos($correo, "@admin.com") === false) {
    header("Location: indexRegistrado.php?id_user=$usuario");
        exit();
    }

header("Location: indexRegistradoAdmin.php?id_user=$usuario");

?>
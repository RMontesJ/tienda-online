<?php 

require_once "../BD/Datos.php";

$clase = new Datos();

$usuario = $_GET['id_user'];
// id del producto
$producto = $_GET['id_producto'];

// metodo que borra el producto, pasandole su id como argumento para borrarlo

$clase->borrarProducto($producto);

$correo = $clase->cogerCorreo($usuario);


if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
    }

if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
        exit();
    }

header("Location: ../paginas/indexRegistradoAdmin.php?id_user=$usuario");

?>
<?php 

require_once "../BD/Datos.php";

$datos = new Datos();

$usuario = $_GET['id_user'];
$id_producto = $_GET['id_producto'];
$cantidad = $_POST['cantidad'];

$datos->meterEnCarrito($usuario, $id_producto, $cantidad);

header("Location: ../paginas/infoProducto.php?id_user=$usuario&id_producto=$id_producto");

?>
<?php 

$usuario = $_GET['id_user'];
$id_producto = $_GET['id_producto'];

$datos = new Datos();

$cantidad = $_POST['cantidad'];

$datos->meterEnCarrito($usuario, $id_producto, $cantidad);



?>
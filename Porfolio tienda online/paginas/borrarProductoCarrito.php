<?php 

require_once "../BD/Datos.php";

$clase = new Datos();

$usuario = $_GET['id_user'];
// id del producto
$producto = $_GET['id_producto'];

// metodo que borra el producto, pasandole su id como argumento para borrarlo

$clase->borrarProductoCarrito($usuario, $producto);


header("Location: ../paginas/carrito.php?id_user=$usuario");

?>
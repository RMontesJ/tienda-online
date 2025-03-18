<?php
require_once('../fpdf186/fpdf.php'); // Asegúrate de que la ruta es correcta
require_once "../BD/Datos.php";

$usuario = $_GET['id_user'];
$clase = new Datos;

// Verificar si el usuario está vacío
if (!isset($usuario) || $usuario == "") {
    header("Location: ../paginas/inicio_sesion.php");
    exit();
}

// Obtener los datos
$correo = $clase->cogerCorreo($usuario);
$idProductosCarrito = $clase->cogerIdProductosCarrito($usuario);
$productos = $clase->obtenerProductosPorId($usuario);

$clase->crearPDFCompra($correo, $productos);

$clase->crearPedido($usuario);
$clase->vaciarCarrito($usuario);

header("Location: ../paginas/carrito.php?id_user=$usuario");

?>

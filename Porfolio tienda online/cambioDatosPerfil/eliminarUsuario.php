<?php 

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$clase = new Datos;

$clase->borrar($usuario);

header("Location: ../paginas/cerrarSesion.php");

?>
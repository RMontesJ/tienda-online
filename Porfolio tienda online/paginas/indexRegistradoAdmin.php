<?php

error_reporting(0);

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";

$clase = new Datos;

if(!isset($usuario) || $usuario == ""){
    header("Location: inicio_sesion.php");
    }

$correo = $clase->cogerCorreo($usuario);

// si no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}

$nombre = $clase->cogerNombre($usuario);

// verifica el valor del campo de texto del include busquedaProductos.php,
// guardando su valor en una variable

if(isset($_POST['enviar'])){
    $valor = $_POST['busqueda'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>
<div class="container-fluid">
    <div class="pagina text-center">
        <!-- Navbar para el administrador -->
        <?php include "../includes/navAdmin.php"; ?>

        <h1 class="mt-4"><?php echo "Hola, " . $nombre; ?></h1>

        <?php 
        // Campo de búsqueda y botón de buscar
        include "../includes/busquedaProductos.php"; 
        ?>

        <!-- Fila de productos -->
        <div id="productos" class="row mt-4">
            <?php 
            // Ejecuta una sentencia a la base de datos que busca productos con el valor del campo del include
            $productos = $clase->buscarProductosAdmin($valor, $usuario);
            ?>
        </div>
    </div>
</div>


</body>
</html>
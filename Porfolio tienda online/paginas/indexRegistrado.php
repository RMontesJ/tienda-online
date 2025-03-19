<?php

error_reporting(0);

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$clase = new Datos;

$nombre = $clase->cogerNombre($usuario);
$correo = $clase->cogerCorreo($usuario);


if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
    }

    // si es admin
    if (strpos($correo, "@admin.com") === true) {
        header("Location: ../paginas/indexRegistradoAdmin.php?id_user=$usuario");
        exit();
    }
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
        <?php include "../includes/nav.php" ?>
        <h1 class="mt-4"><?php echo "Hola, ". $nombre ?></h1>

        <?php 
        // campo de búsqueda y botón de buscar
        include "../includes/busquedaProductos.php"
        ?>

        <div id="productos" class="row mt-4">
            <?php 
            // Ejecuta una consulta en la base de datos para buscar productos
            $productos = $clase->buscarProductos($valor, $usuario);
            ?>
        </div>
    </div></div>

</body>
</html>
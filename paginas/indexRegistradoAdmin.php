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
    header("Location: indexRegistrado.php?id_user=$usuario");
    exit();
}

$nombre = $clase->cogerNombre($usuario);

// verifica el valor del campo de texto del include busquedaProductos.php

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
    <link rel="stylesheet" href="../css/indexRegistrado.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
</head>
<body>
    
<div class="pagina">
<?php include "../includes/navAdmin.php" ?>
    <h1><?php echo "Hola, ". $nombre ?></h1>
    <?php 
    // campo de busqueda y boton de buscar
    include "../includes/busquedaProductos.php"
    
    ?>
    <div id="productos">
    <?php 
    // ejecuta una sentencia a la base de datos que busca productos con el valor del campo del include
    // busquedaProductos.php
    $productos = $clase->buscarProductosAdmin($valor, $usuario);
    
    ?>
    </div>
</div>

</body>
</html>
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
<?php include "../includes/nav.php" ?>
    <h1><?php echo "Hola, ". $nombre ?></h1>
    <?php include "../includes/busquedaProductos.php" ?>
    <div id="productos">

    <?php 
    
    $productos = $clase->buscarProductos($valor);
    
    ?>

    </div>
</div>

</body>
</html>
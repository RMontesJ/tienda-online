<?php 

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

<div class="container-fluid">
    <?php include "../includes/nav.php" ?>

    <!-- Sección de notificaciones -->
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="notificaciones p-3 p-sm-4 border rounded shadow-sm">
                <?php $clase->pintarNotificaciones($usuario); ?>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>
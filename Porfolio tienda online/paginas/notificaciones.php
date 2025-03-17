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
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="pagina">

<?php include "../includes/nav.php" ?>


<div class="notificaciones">
    <?php $clase->pintarNotificaciones($usuario); ?>
</div>

</div>
    
</body>
</html>
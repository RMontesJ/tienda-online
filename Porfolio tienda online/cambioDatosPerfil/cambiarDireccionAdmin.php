
<?php 

$usuario = $_GET['id_user']; 

require_once "../BD/Datos.php";

$clase = new Datos;

if(!isset($usuario) || $usuario == ""){
    header("Location: inicio_sesion.php");
    }

$correo = $clase->cogerCorreo($usuario);

// si el correo no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit(); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar nombre</title>
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/cambiarDireccion.css?v=<?php echo time(); ?>">
    <script src="../validaciones/cambiar_direccion.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>

<div class="pagina">

<?php include "../includes/navAdmin.php" ?>

<div class="formulario">

<form action="logicaCambiarDireccion.php?id_user=<?php echo $usuario ?>" method="post" id="form">
<h2>Cambiar direccion</h2>

<div class="input-group">
<label for="name">Direccion nueva</label>
<input type="text" name="direccionNueva" id="direccionNueva" placeholder="Dirección nueva">
<p id="correccionDireccion"></p>

<div class="form-txt">
<a href="../paginas/perfilAdmin.php?id_user=<?php echo $usuario; ?>">Volver a mi perfil</a>

</div>
<input class="btn" type="submit" value="Enviar">
</div>
</form>

</div>

</div>
    
</body>
</html>
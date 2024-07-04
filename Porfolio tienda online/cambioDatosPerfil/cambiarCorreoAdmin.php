
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
    header("Location: ../indexRegistrado.php?id_user=$usuario");
    exit(); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar nombre</title>
    <link rel="stylesheet" href="../css/formulario.css">
    <script src="../validaciones/cambiar_correo_admin.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>

<form action="logicaCambiarCorreo.php?id_user=<?php echo $usuario ?>" method="post" id="form">
<h2>Cambiar correo</h2>

<div class="input-group">
<label for="name">Correo nuevo</label>
<input type="text" name="correoNuevo" id="correoNuevo" placeholder="Correo nuevo">
<p id="correccionCorreo"></p>

<div class="form-txt">
<a href="../perfilAdmin.php?id_user=<?php echo $usuario; ?>">Volver a mi perfil</a>

</div>
<input class="btn" type="submit" value="Enviar">
</div>
</form>
    
</body>
</html>
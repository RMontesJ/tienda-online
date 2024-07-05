
<?php 

$usuario = $_GET['id_user']; 

if(!isset($usuario) || $usuario == ""){
    header("Location: inicio_sesion.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar nombre</title>
    <link rel="stylesheet" href="../css/formulario.css">
    <script src="../validaciones/cambiar_contrasena.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>

<form action="logicaCambiarContrasena.php?id_user=<?php echo $usuario ?>" method="post" id="form">
<h2>Cambiar contraseña</h2>

<div class="input-group">
<label for="name">Contraseña nueva</label>
<input type="text" name="contrasenaNueva" id="contrasenaNueva" placeholder="Contraseña nueva">
<p id="correccionContrasena"></p>
<div class="form-txt">
<a href="../perfil.php?id_user=<?php echo $usuario; ?>">Volver a mi perfil</a>

</div>
<input class="btn" type="submit" value="Enviar">
</div>
</form>
    
</body>
</html>
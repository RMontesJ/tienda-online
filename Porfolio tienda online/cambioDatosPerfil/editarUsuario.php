<?php 

error_reporting(0);

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
require_once "../BD/cambioDatosPerfil.php";
$datosUsuario = new Datos();
$actualizar = new cambioDatosPerfil();

// funciones que recuperan los datos del usuario y los muestra
$nombrePerfil = $datosUsuario->cogerNombre($usuario);
$contrasenaPerfil = $datosUsuario->cogerContrasena($usuario);
$correoPerfil = $datosUsuario->cogerCorreo($usuario);
$direcciónPerfil = $datosUsuario->cogerDirección($usuario);

$id = $_POST['id_user'];
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];

if(isset($nombre) || isset($contrasena) || isset($correo) || isset($direccion)){

    $actualizar->actualizarPerfil($nombre, $contrasena, $correo, $direccion, $id);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar perfil</title>
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/actualizarUsuario.css?v=<?php echo time(); ?>">
    <script src="../validaciones/actualizarPerfil.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
    
<div class="pagina">

<?php include "../includes/navAdmin.php" ?>

<div class="formulario">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form">
<h2>Actualizar perfil</h2>

<div class="input-group">
<input type="hidden" name="id_user" value="<?php echo $usuario; ?>">
<label for="name">Nombre</label>
<input type="text" name="nombre" id="nombre" value="<?php echo $nombrePerfil ?>" placeholder="Nombre">
<p id="corregirNombre"></p>
<label for="contrasena">Contraseña</label>
<input type="password" name="contrasena" id="contrasena" value="<?php echo $contrasenaPerfil ?>" placeholder="Contraseña">
<p id="corregirContrasena"></p>
<label for="correo">Correo</label>
<input type="text" name="correo" id="correo" value="<?php echo $correoPerfil ?>" placeholder="Correo">
<p id="corregirCorreo"></p>
<label for="dirección">Dirección</label>
<input type="text" name="direccion" id="direccion" value="<?php echo $direcciónPerfil ?>" placeholder="Dirección">
<p id="corregirDireccion"></p>

<div class="form-txt">
<a href="../paginas/perfilAdmin.php?id_user=<?php echo $usuario ?>">Volver a mi perfil</a>
</div>
<input class="btn" id="boton" type="submit" value="Enviar">
</div>
</form>

</div>

</div>

</body>
</html>

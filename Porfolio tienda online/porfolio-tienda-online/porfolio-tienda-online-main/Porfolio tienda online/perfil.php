<?php 

$usuario = $_GET['id_user'];

require_once "BD/Datos.php";
$datosUsuario = new Datos();

if(!isset($usuario) || $usuario == ""){
header("Location: inicio_sesion.php");
}

$correo = $datosUsuario->cogerCorreo($usuario);

// si el correo es admin
if (strpos($correo, "@admin.com") === true) {
    header("Location: perfilAdmin.php?id_user=$usuario");
    exit();
}


$nombrePerfil = $datosUsuario->cogerNombre($usuario);
$contrasenaPerfil = $datosUsuario->cogerContrasena($usuario);
$correoPerfil = $datosUsuario->cogerCorreo($usuario);
$direcciónPerfil = $datosUsuario->cogerDirección($usuario);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link rel="stylesheet" href="css/perfil.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/nav.css?v=<?php echo time(); ?>">
    <script src=""></script>
</head>
<body>

<div class="page">

<?php include "includes/nav.php" ?>

<h1>Mi perfil</h1>

<div class="datos">
<div class="nombre">
<p>Nombre: <?php echo $nombrePerfil ?></p>
<a href="cambioDatosPerfil/cambiarNombre.php?id_user=<?php echo $usuario;?>"><img src="img/iconoLapiz.svg" alt="Cambiar nombre"></img></a>
</div>

<div class="contrasena">
<p>Contraseña: <?php echo $contrasenaPerfil ?></p>
<a href="cambioDatosPerfil/cambiarContrasena.php?id_user=<?php echo $usuario;?>"><img src="img/iconoLapiz.svg" alt="Cambiar contraseña"></img></a>
</div>

<div class="correo">
<p>Correo: <?php echo $correoPerfil ?></p>
<a href="cambioDatosPerfil/cambiarCorreo.php?id_user=<?php echo $usuario;?>"><img src="img/iconoLapiz.svg" alt="Cambiar correo"></img></a>
</div>

<div class="direccion">
<p>Dirección: <?php echo $direcciónPerfil ?></p>
<a href="cambioDatosPerfil/cambiarDireccion.php?id_user=<?php echo $usuario;?>"><img src="img/iconoLapiz.svg" alt="Cambiar dirección"></img></a>
</div>

<div class="borrar">
    <p>Eliminar usuario</p>
    <a href="cambioDatosPerfil/eliminarUsuario.php?id_user=<?php echo $usuario;?>"><img src="img/iconoPapelera.svg" alt="Eliminar usuario"></a>
</div>

</div>

</div>
    
</body>
</html>
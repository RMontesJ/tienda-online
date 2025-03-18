<?php 

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$datosUsuario = new Datos();

$correo = $datosUsuario->cogerCorreo($usuario);

// si la sesion no esta iniciada
if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
    }

    // si no es admin
    if (strpos($correo, "@admin.com") === false) {
        header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
        exit();
    }

// funciones que recuperan los datos del usuario y los muestra
$nombrePerfil = $datosUsuario->cogerNombre($usuario);
$contrasenaPerfil = $datosUsuario->cogerContrasena($usuario);
$correoPerfil = $datosUsuario->cogerCorreo($usuario);
$direcciónPerfil = $datosUsuario->cogerDirección($usuario);
$fotoPerfil = $datosUsuario->cogerFoto($usuario);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link rel="stylesheet" href="../css/perfil.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

<div class="page">

<?php include "../includes/navAdmin.php" ?>

<h1>Mi perfil</h1>

<div class="datos">
<div class="foto">
<img src="../fotosUsuarios/<?php echo $fotoPerfil; ?>" alt="Foto usuario" style="width:400px;height:300px;"><br>
<a href="../cambioDatosPerfil/cambiarFotoAdmin.php?id_user=<?php echo $usuario;?>"><img src="../img/iconoLapiz.svg" alt="Cambiar foto"></img></a>
</div>
<div class="nombre">
<p>Nombre: <?php echo $nombrePerfil ?></p>

</div>

<div class="contrasena">
<p>Contraseña: <?php echo $contrasenaPerfil ?></p>

</div>

<div class="correo">
<p>Correo: <?php echo $correoPerfil ?></p>

</div>

<div class="direccion">
<p>Dirección: <?php echo $direcciónPerfil ?></p>

</div>

<div class="config">
    <a href="../cambioDatosPerfil/editarUsuarioAdmin.php?id_user=<?php echo $usuario;?>"><img src="../img/iconoLapiz.svg" alt="Cambiar nombre"></img></a>
    <a href="../cambioDatosPerfil/eliminarUsuario.php?id_user=<?php echo $usuario;?>"><img src="../img/iconoPapelera.svg" alt="Eliminar usuario"></a>
</div>

</div>

</div>
    
</body>
</html>
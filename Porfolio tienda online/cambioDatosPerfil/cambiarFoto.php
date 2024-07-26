
<?php 

$usuario = $_GET['id_user']; 

require_once "../BD/Datos.php";
require_once "../BD/cambioDatosPerfil.php";

$clase = new Datos;
$cambio = new cambioDatosPerfil();

if(!isset($usuario) || $usuario == ""){
    header("Location: inicio_sesion.php");
    }

$correo = $clase->cogerCorreo($usuario);

// si el correo es admin
if (strpos($correo, "@admin.com") === true) {
    header("Location: ../paginas/indexRegistradoAdmin.php?id_user=$usuario");
    exit();
}

if (isset($_FILES['fotoNueva'])) {
    // Ruta donde se guardará la foto
    $ruta_destino = '../fotosUsuarios/';

    // Nombre del archivo original
    $nombre_archivo = $_FILES['fotoNueva']['name'];

    // Mover el archivo desde el directorio temporal al directorio destino
    if (move_uploaded_file($_FILES['fotoNueva']['tmp_name'], $ruta_destino . $nombre_archivo)) {
        // Aquí puedes guardar $nombre_archivo en la base de datos o realizar otras operaciones
        $foto = $nombre_archivo;
        $cambioFoto = $cambio->cambiarFoto($usuario, $foto, $correo);
    }
    // si no has puesto foto, te pone la foto predeterminada
    else if ($_FILES['fotoNueva']['name'] == ""){
        $fotoPredeterminada = '../fotosUsuarios/user-photo-default.webp';
        $cambioFoto = $cambio->cambiarFoto($usuario, $fotoPredeterminada, $correo);
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar nombre</title>
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/cambiarContrasena.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="pagina">

<?php include "../includes/nav.php" ?>

<div class="formulario">

<form action="cambiarFoto.php?id_user=<?php echo $usuario ?>" method="post" id="form" enctype="multipart/form-data">
<h2>Foto</h2>

<div class="input-group">
<label for="name">Foto nueva</label>
<input type="file" name="fotoNueva" id="fotoNueva">

<div class="form-txt">
<a href="../paginas/perfil.php?id_user=<?php echo $usuario; ?>">Volver a mi perfil</a>

</div>
<input class="btn" type="submit" value="Enviar">
</div>
</form>

</div>
    
</div>

</body>
</html>

<?php 

error_reporting(0);

$usuario = $_GET['id_user']; 

require_once "../BD/Datos.php";
require_once "../BD/cambioDatosPerfil.php";

$clase = new Datos;
$cambio = new cambioDatosPerfil();

if(!isset($usuario) || $usuario == ""){
    header("Location: inicio_sesion.php");
    }

$correo = $clase->cogerCorreo($usuario);

$extension = $_FILES['fotoNueva']['type'];

// si el correo no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}

if (isset($_FILES['fotoNueva'])) {

    if(strpos($extension, 'png') || strpos($extension, 'jpeg') || strpos($extension, 'jpg') || strpos($extension, 'webp')){
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

}

    // si no has puesto foto, te pone la foto predeterminada
    else if ($_FILES['fotoNueva']['name'] == ""){
        $fotoPredeterminada = '../fotosUsuarios/user-photo-default.webp';
        $cambioFoto = $cambio->cambiarFoto($usuario, $fotoPredeterminada, $correo);
    }

    else{
        header("Location: ../paginas/perfilAdmin.php?id_user=$usuario");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Foto</title>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

<div class="pagina">
        <?php include "../includes/navAdmin.php" ?>
        <div class="container-fluid">
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="formulario p-4 shadow-lg rounded">
                        <form action="cambiarFotoAdmin.php?id_user=<?php echo $usuario ?>" method="post" id="form" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="fotoNueva" class="form-label">Foto (extensión .png, .jpeg, .jpg, .webp)</label>
                                <input type="file" name="fotoNueva" id="fotoNueva" class="form-control">
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="../paginas/perfil.php?id_user=<?php echo $usuario; ?>" class="text-decoration-none">Volver a mi perfil</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
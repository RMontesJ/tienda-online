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

<div class="pagina">
        <?php include "../includes/navAdmin.php" ?>
        <div class="container-fluid">
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="perfil p-4 shadow-lg rounded text-center">
                        <h1 class="mb-4">Mi perfil</h1>
                        <div class="foto mb-3">
                            <img src="../fotosUsuarios/<?php echo $fotoPerfil; ?>" alt="Foto usuario" class="img-fluid rounded" style="max-width: 400px; height: auto;">
                            <br>
                            <a href="../cambioDatosPerfil/cambiarFotoAdmin.php?id_user=<?php echo $usuario; ?>"><img src="../img/iconoLapiz.svg" alt="Cambiar foto"></a>
                        </div>
                        <div class="datos text-start">
                            <p><strong>Nombre:</strong> <?php echo $nombrePerfil; ?></p>
                            <p><strong>Contraseña:</strong> <?php echo $contrasenaPerfil; ?></p>
                            <p><strong>Correo:</strong> <?php echo $correoPerfil; ?></p>
                            <p><strong>Dirección:</strong> <?php echo $direcciónPerfil; ?></p>
                        </div>
                        <div class="config d-flex justify-content-center gap-3 mt-3">
                            <a href="../cambioDatosPerfil/editarUsuarioAdmin.php?id_user=<?php echo $usuario; ?>"><img src="../img/iconoLapiz.svg" alt="Editar"></a>
                            <a href="../cambioDatosPerfil/eliminarUsuario.php?id_user=<?php echo $usuario; ?>"><img src="../img/iconoPapelera.svg" alt="Eliminar"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></body>
</html>
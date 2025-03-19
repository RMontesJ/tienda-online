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
    <script src="../validaciones/actualizarPerfil.js?v=<?php echo time(); ?>" defer></script>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>
    
<div class="pagina">

    <?php include "../includes/nav.php" ?>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <!-- Ajuste para pantallas más pequeñas -->
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Actualizar Perfil</h3>
                        <form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="id_user" value="<?php echo $usuario; ?>">

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombrePerfil ?>" placeholder="Nombre">
                                <p id="corregirNombre" class="text-danger small"></p>
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" name="contrasena" id="contrasena" class="form-control" value="<?php echo $contrasenaPerfil ?>" placeholder="Contraseña">
                                <p id="corregirContrasena" class="text-danger small"></p>
                            </div>

                            <!-- Correo -->
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correoPerfil ?>" placeholder="Correo">
                                <p id="corregirCorreo" class="text-danger small"></p>
                            </div>

                            <!-- Dirección -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direcciónPerfil ?>" placeholder="Dirección">
                                <p id="corregirDireccion" class="text-danger small"></p>
                            </div>

                            <!-- Volver al perfil -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="../paginas/perfilAdmin.php?id_user=<?php echo $usuario ?>" class="text-decoration-none">Volver a mi perfil</a>
                            </div>

                            <!-- Botón Enviar -->
                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>

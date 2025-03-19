<?php 

error_reporting(0);

require_once "../BD/Datos.php";

$clase = new Datos();

$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
// ponemos una foto predeterminada en caso de que el usuario no ponga una
$fotoPredeterminada = '../fotosUsuarios/user-photo-default.webp';
$foto = $fotoPredeterminada;

if (isset($_FILES['foto'])) {
    // Ruta donde se guardará la foto (puedes ajustarla según tu estructura de archivos)
    $ruta_destino = '../fotosUsuarios/';

    // Nombre del archivo original
    $nombre_archivo = $_FILES['foto']['name'];

    // Mover el archivo desde el directorio temporal al directorio destino
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino . $nombre_archivo)) {
        // Aquí puedes guardar $nombre_archivo en la base de datos o realizar otras operaciones
        $foto = $nombre_archivo;
    }

}

// comprueba que todos los campos no esten vacios

if(isset($nombre) && isset($contrasena) && isset($correo) && isset($direccion)){

    $crear = $clase->crear($nombre, $contrasena, $correo, $direccion, $foto);
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <script src="../validaciones/registro.js?v=<?php echo time(); ?>" defer></script>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

    
<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-6 col-lg-4 p-4 shadow-lg rounded bg-white">
            <form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="text-center">
                <h1 class="mb-4">Registro</h1>
                <div class="mb-3 text-start">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                    <p id="corregirNombre" class="text-danger small"></p>
                </div>
                <div class="mb-3 text-start">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contraseña">
                    <p id="corregirContrasena" class="text-danger small"></p>
                </div>
                <div class="mb-3 text-start">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo">
                    <p id="corregirCorreo" class="text-danger small"></p>
                </div>
                <div class="mb-3 text-start">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección">
                    <p id="corregirDireccion" class="text-danger small"></p>
                </div>
                <div class="mb-3 text-start">
                    <label for="foto" class="form-label">Foto (opcional)</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="inicio_sesion.php" class="text-decoration-none">Iniciar sesión</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>

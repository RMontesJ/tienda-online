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
    <link rel="stylesheet" href="../css/formulario.css?v=<?php echo time(); ?>">
    <script src="../validaciones/registro.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form" enctype="multipart/form-data">
<h2>Registrarse</h2>

<div class="input-group">
<label for="name">Nombre</label>
<input type="text" name="nombre" id="nombre" placeholder="Nombre">
<p id="corregirNombre"></p>
<label for="contrasena">Contraseña</label>
<input type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
<p id="corregirContrasena"></p>
<label for="correo">Correo</label>
<input type="text" name="correo" id="correo" placeholder="Correo">
<p id="corregirCorreo"></p>
<label for="dirección">Dirección</label>
<input type="text" name="direccion" id="direccion" placeholder="Dirección">
<p id="corregirDireccion"></p>
<label for="foto">Foto (opcional)</label>
<input type="file" name="foto" id="foto">

<div class="form-txt">
<a href="inicio_sesion.php">Iniciar sesion</a>
</div>
<input class="btn" id="boton" type="submit" value="Enviar">
</div>
</form>

</body>
</html>

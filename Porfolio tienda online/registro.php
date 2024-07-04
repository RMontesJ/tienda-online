<?php 
error_reporting(0);
require_once "BD/Datos.php";

$clase = new Datos();

$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];

if(isset($nombre) && isset($contrasena) && isset($correo) && isset($direccion)){
// crea una archivo aparte para cada usuario creado
    $nombre_archivo = "datosUsuarios/DatosUsuario";

$usuario = array("nombre" => $nombre, "contrasena" => $contrasena, "correo" => $correo, "direccion" => $direccion);
$json = json_encode($usuario,JSON_PRETTY_PRINT);
$ruta_json = $nombre_archivo.date('YmdHis') . '.json';
file_put_contents($ruta_json, $json, FILE_APPEND);

// los va metiendo todos en el mismo archivo para poder hacerle fetch

$file = 'infoUsuarios/usuarios.json';
    // lee los datos del archivo json
    $current_data = file_get_contents($file);
    // convierte el json en php
    $data_array = json_decode($current_data, true);
    // array con datos del usuario
    $new_object = array(

        "nombre" => $nombre, 
        "contrasena" => $contrasena, 
        "correo" => $correo, 
        "direccion" => $direccion

    );
    // lo mete en una variable
    $data_array[] = $new_object;
    // lo pasa a json
    $new_data_json = json_encode($data_array, JSON_PRETTY_PRINT);
    // mete el contenido en un archivo
    file_put_contents($file, $new_data_json);
    $crear = $clase->crear($nombre, $contrasena, $correo, $direccion);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="css/formulario.css?v=<?php echo time(); ?>">
    <script src="validaciones/registro.js?v=<?php echo time(); ?>" defer></script>
    <script src="logica/fetchUsuarios.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
    
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form">
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

<div class="form-txt">
<a href="inicio_sesion.php">Iniciar sesion</a>
</div>
<input class="btn" id="boton" type="submit" value="Enviar">
</div>
</form>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="css/formulario.css?v=<?php echo time(); ?>">
    <script src="validaciones/inicio_sesion.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>

<form action="logica_inicio_sesion.php" method="post" id="form">
<h2>Inicio de sesion</h2>

<div class="input-group">
<label for="name">Nombre</label>
<input type="text" name="nombre" id="nombre" placeholder="Nombre">
<p id="corregirNombre"></p>
<label for="phone">Contraseña</label>
<input type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
<p id="corregirContrasena"></p>

<div class="form-txt">
<a href="registro.php">Registrarse</a>

</div>
<input class="btn" type="submit" value="Iniciar sesion">
</div>
</form>
    
</body>
</html>
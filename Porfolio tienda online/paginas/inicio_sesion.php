<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="../css/formulario.css?v=<?php echo time(); ?>">
    <script src="../validaciones/inicio_sesion.js?v=<?php echo time(); ?>" defer></script>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>


<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-6 col-lg-4 p-4 shadow-lg rounded bg-white">
            <form id="form" action="../paginas/logica_inicio_sesion.php" method="post" class="text-center">
                <h1 class="mb-4">Inicio de Sesión</h1>
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="../paginas/registro.php" class="text-decoration-none">Registrarse</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>
        </div>
    </div>                   
</body>
</html>
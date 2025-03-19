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


<form id="form" action="../paginas/logica_inicio_sesion.php" method="post">
<h1>Inicio de sesion</h1>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                            <p id="corregirNombre"></p>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contraseña">
                            <p id="corregirContrasena"></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="../paginas/registro.php" class="text-decoration-none">Registrarse</a>
                        </div>
                        <input class="btn" type="submit" value="Iniciar sesion">                    
                    </form>
                   
</body>
</html>
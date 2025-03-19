<?php

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";

$clase = new Datos;
$correo = $clase->cogerCorreo($usuario);

if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
}

// si no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda</title>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

<div class="container-fluid">
  <?php include "../includes/navAdmin.php" ?>

  <div class="texto">
    <h1 class="text-center mb-4">¿Dónde puedo ver mis datos?</h1>
    <p class="lead">
      Pincha en la página "Mi perfil" en la parte superior, donde podrás consultar toda la información de
      tu perfil, así como modificar tus datos y borrar tu cuenta.
    </p>

    <h1 class="text-center mb-4">¿Cómo navego en la sección de productos?</h1>
    <p class="lead">
      En la página "inicio" tendrás todos los productos registrados de la tienda. Tendrás un buscador en el que si
      pones cualquier dato, te aparecerán cualquier búsqueda relacionada con lo que escribiste.
    </p>

    <h1 class="text-center mb-4">¿Cómo navego en la sección de usuarios?</h1>
    <p class="lead">
      En la página "usuarios" tendrás todos los usuarios registrados de la tienda. Tendrás un buscador en el que si
      pones cualquier dato, te aparecerán cualquier búsqueda relacionada con lo que escribiste.
    </p>
  </div>
</div>
    
</body>
</html>

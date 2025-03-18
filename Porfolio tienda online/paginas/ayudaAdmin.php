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
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/ayuda.css?v=<?php echo time(); ?>">
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

<div class="pagina">

<?php include "../includes/navAdmin.php" ?>

<div class="texto">

<h1>¿Donde puedo ver mis datos?</h1>

<p>Pincha en la pagina "Mi perfil" en la parte superior, donde podras consultar toda la informacion de 
    tu perfil, asi como modificar tus datos y borrar tu cuenta.
</p>

<h1>¿Como navego en la seccion de productos?</h1>

<p>En la pagina "inicio" tendras todos los productos registrados de la tienda. Tendras un buscador en el que si 
    pones cualquer dato, te apareceran cualquier busqueda relacionada con lo que escribiste
</p>

<h1>¿Como navego en la seccion de usuarios?</h1>

<p>En la pagina "usuarios" tendras todos los usuarios registrados de la tienda. Tendras un buscador en el que si 
pones cualquer dato, te apareceran cualquier busqueda relacionada con lo que escribiste.</p>


</div>

</div>
    
</body>
</html>

<?php

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$datosUsuario = new Datos();

// si la sesion no esta puesta o esta vacia
if(!isset($usuario) || $usuario == ""){
header("Location: ../paginas/inicio_sesion.php");
}
// coge el correo
$correo = $datosUsuario->cogerCorreo($usuario);
$idPoductosPedido = $datosUsuario->cogerIdProductosPedido($usuario);

 // si es admin
 if (strpos($correo, "@admin.com") === true) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}

// si se le da al boton de buscar, coge el valor de la busqueda del include busquedaUsuarios.php
// y lo pasa como argumento al metodo buscarUsuarios
if(isset($_POST['enviar'])){
    $valor = $_POST['busqueda'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <?php include "../includes/bootstrapLinks.php" ?>

</head>
<body>

<div class="container-fluid text-center">

    <?php include "../includes/nav.php"; // Incluye la barra de navegación del usuario ?>

    <h1>Mis Pedidos</h1>

    <?php 
    // Incluye el campo de texto y botón de búsqueda (si lo necesitas, puedes adaptarlo para buscar pedidos)
    include "../includes/busquedaPedidos.php"; 
    ?>

    <div id="pedidos" class="row mt-4">
        <?php 
        // Supongo que tienes una función en el modelo que te devuelve los pedidos de un usuario.
        // Se buscarán los pedidos de un usuario específico.

        // Usamos el valor de búsqueda, que puede ser un campo o filtro que el usuario ingresa
        $imprimirPedidos = $datosUsuario->verMisPedidos($idPoductosPedido, $usuario);

        ?>
    </div>

</div>

    
</body>
</html>
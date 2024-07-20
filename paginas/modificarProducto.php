<?php

error_reporting(0);

$usuario = $_GET['id_user'];

require_once "../BD/productos.php";
require_once "../BD/Datos.php";

$clase = new Datos;

$productos = new Productos();

$correo = $clase->cogerCorreo($usuario);

if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
}

    // si no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}



if (isset($_GET['id_user']) && isset($_GET['id_producto']) && isset($_GET['nombre']) && isset($_GET['descripcion']) && isset($_GET['categoria']) && isset($_GET['precio'])) {
    $usuario = $_GET['id_user'];
    $id_producto = $_GET['id_producto'];
    $nombre = urldecode($_GET['nombre']);
    $descripcion = urldecode($_GET['descripcion']);
    $categoria = urldecode($_GET['categoria']);
    $precio = urldecode($_GET['precio']);
}

$nombreNuevo = $_POST['nombreNuevo'];
$descripcionNueva = $_POST['descripcionNueva'];
$categoriaNueva = $_POST['categoriaNueva'];
$precioNuevo = $_POST['precioNuevo'];

if (isset($nombreNuevo) || isset($descripcionNueva) || isset($categoriaNueva) || isset($precioNuevo)) {
    $usuario = $_POST['usuario'];
    $id_producto = $_POST['id_producto'];
    
    $productos->editarProducto($usuario, $id_producto, $nombreNuevo, $descripcionNueva, $categoriaNueva, $precioNuevo);
    header("Location: ../paginas/indexRegistradoAdmin.php?id_user=$usuario");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/crearProducto.css?v=<?php echo time(); ?>">
    <script src="../validaciones/subida_producto.js?v=<?php echo time(); ?>" defer></script>
</head>

<body>

<?php include "../includes/navAdmin.php" ?>

    <div class="formulario">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id_user=<?php echo $usuario; ?>" method="post" id="form">
            <h2>Editar producto</h2>

            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">

            <div class="input-group">
                <label for="name">Nombre</label>
                <input type="text" name="nombreNuevo" value="<?php echo $nombre ?>" id="nombre" placeholder="Nombre">
                <p id="corregirNombre"></p>
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcionNueva" value="<?php echo $descripcion ?>" id="descripcion"
                    placeholder="Descripción">
                <p id="corregirDescripcion"></p>
                <label for="categoria">Categoria</label>
                <select name="categoriaNueva" value="<?php echo $categoria ?>" id="categoria">
                    <option value=""></option>
                    <option value="deportes">Deportes</option>
                    <option value="hogar">Hogar</option>
                    <option value="electronica">Electronica</option>
                    <option value="mascotas">Mascotas</option>
                    <option value="libros">Libros</option>
                    <option value="juguetes">Juguetes</option>
                    <option value="ropa">Ropa</option>
                </select>
                <p id="corregirCategoria"></p>
                <label for="precio">Precio</label>
                <input type="number" name="precioNuevo" value="<?php echo $precio ?>" min="0" step="0.01" id="precio"
                    placeholder="Precio">
                <p id="corregirPrecio"></p>

                <div class="form-txt">
                    <a href="#"></a>
                </div>
                <input class="btn" id="boton" name="Enviar" type="submit" value="Enviar">
            </div>
        </form>
    </div>

</body>

</html>
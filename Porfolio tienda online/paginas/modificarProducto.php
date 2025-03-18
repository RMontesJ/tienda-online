<?php

error_reporting(0);

$usuario = $_GET['id_user'];
$id_producto = $_GET['id_producto'];

require_once "../BD/productos.php";
require_once "../BD/Datos.php";

$clase = new Datos;
$productos = new Productos();

$nombreProducto = $productos->cogerNombreProducto($id_producto);
$descripcionProducto = $productos->cogerDescripcionProducto($id_producto);
$categoriaProducto = $productos->cogerCategoriaProducto($id_producto);
$precioProducto = $productos->cogerPrecioProducto($id_producto);


$correo = $clase->cogerCorreo($usuario);

if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
}

    // si no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}

$nombreNuevo = $_POST['nombreNuevo'];
$descripcionNueva = $_POST['descripcionNueva'];
$categoriaNueva = $_POST['categoriaNueva'];
$precioNuevo = $_POST['precioNuevo'];

if(isset($nombreNuevo) && isset($descripcionNueva) && isset($categoriaNueva) && isset($precioNuevo)){

$productos->editarProducto($usuario, $id_producto, $nombreNuevo, $descripcionNueva, $categoriaNueva, $precioNuevo);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/modificarProducto.css?v=<?php echo time(); ?>">
    <script src="../validaciones/actualizar_producto.js?v=<?php echo time(); ?>" defer></script>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>

<body>

<?php include "../includes/navAdmin.php" ?>

    <div class="formulario">
    <form id="form" action="../paginas/modificarProducto.php?id_user=<?php echo $usuario; ?>&id_producto=<?php echo $id_producto; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombreNuevo" value="<?php echo $nombreProducto ?>" id="nombre" class="form-control" placeholder="Nombre">
                            <p id="corregirNombre" class="text-danger small"></p>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="descripcionNueva" value="<?php echo $descripcionProducto ?>" id="descripcion" class="form-control" placeholder="Descripción">
                            <p id="corregirDescripcion" class="text-danger small"></p>
                        </div>

                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select name="categoriaNueva" id="categoria" class="form-select">
                                <option value="">Selecciona una categoría</option>
                                <option value="deportes">Deportes</option>
                                <option value="hogar">Hogar</option>
                                <option value="electronica">Electrónica</option>
                                <option value="mascotas">Mascotas</option>
                                <option value="libros">Libros</option>
                                <option value="juguetes">Juguetes</option>
                                <option value="ropa">Ropa</option>
                            </select>
                            <p id="corregirCategoria" class="text-danger small"></p>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" name="precioNuevo" value="<?php echo $precioProducto ?>" min="0" step="0.01" id="precio" class="form-control" placeholder="Precio">
                            <p id="corregirPrecio" class="text-danger small"></p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="../paginas/verProducto.php?id_user=<?php echo $usuario ?>&id_producto=<?php echo $id_producto ?>" class="text-decoration-none">Ver producto</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Enviar</button>
                    </form>
    </div>

</body>

</html>
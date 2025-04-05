<?php

error_reporting(0);

$usuario = $_GET['id_user'];
$id_producto = $_GET['id_producto'];

require_once "../BD/productos.php";
require_once "../BD/Datos.php";

$productos = new Productos();
$datos = new Datos();

$nombreProducto = $productos->cogerNombreProducto($id_producto);
$descripcionProducto = $productos->cogerDescripcionProducto($id_producto);
$categoriaProducto = $productos->cogerCategoriaProducto($id_producto);
$precioProducto = $productos->cogerPrecioProducto($id_producto);
$fotoProducto = $productos->cogerFotoProducto($id_producto);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver producto</title>
    <link rel="stylesheet" href="../css/verProducto.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <?php include "../includes/bootstrapLinks.php" ?>

</head>
<body>
    
<div class="container-fluid text-center">
    <?php include "../includes/navAdmin.php" ?>

    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="mb-4">Información del Producto</h1>

            <div class="card shadow p-4">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="../fotosProductos/<?php echo $fotoProducto; ?>" 
                             alt="Foto del producto" 
                             class="img-fluid rounded">
                    </div>
                    <div class="col-md-6 text-start">
                        <p><strong>Nombre:</strong> <?php echo $nombreProducto; ?></p>
                        <p><strong>Descripción:</strong> <?php echo $descripcionProducto; ?></p>
                        <p><strong>Categoría:</strong> <?php echo $categoriaProducto; ?></p>
                        <p><strong>Precio:</strong> <?php echo $precioProducto; ?>€</p>

                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
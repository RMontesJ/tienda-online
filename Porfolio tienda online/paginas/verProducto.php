<?php

error_reporting(0);


$usuario = $_GET['id_user'];
$id_producto = $_GET['id_producto'];

require_once "../BD/productos.php";
require_once "../BD/Datos.php";

$productos = new Productos();

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
    
<div class="page">

    <?php include "../includes/navAdmin.php" ?>

    <h1 class="text-center mt-4">Información del producto</h1>

    <div class="container-fluid mt-4">
        <div class="row justify-content-center">

            <!-- Foto del producto -->
            <div class="col-12 col-md-4 mb-4 text-center d-flex flex-column justify-content-center align-items-center">
    <img src="../fotosProductos/<?php echo $fotoProducto; ?>" alt="Foto usuario" class="img-fluid" style="max-height: 300px; object-fit: cover;">
    <br>
    <a href="../paginas/modificarFotoProducto.php?id_user=<?php echo $usuario;?>&id_producto=<?php echo $id_producto;?>" class="btn btn-warning d-block mt-2 w-auto" style="padding: 8px; text-align: center;">
        <img src="../img/iconoLapiz.svg" alt="Cambiar foto" class="img-fluid" style="max-width: 30px;">
        Modificar foto
    </a>
</div>


            <!-- Detalles del producto -->
            <div class="col-12 col-md-8">
                <div class="mb-3">
                    <p><strong>Nombre:</strong> <?php echo $nombreProducto ?></p>
                </div>

                <div class="mb-3">
                    <p><strong>Descripción:</strong> <?php echo $descripcionProducto ?></p>
                </div>

                <div class="mb-3">
                    <p><strong>Categoría:</strong> <?php echo $categoriaProducto ?></p>
                </div>

                <div class="mb-3">
                    <p><strong>Precio:</strong> <?php echo $precioProducto ?></p>
                </div>

                <div class="text-center mt-3">
                    <a href="../paginas/modificarProducto.php?id_user=<?php echo $usuario;?>&id_producto=<?php echo $id_producto;?>" class="btn btn-warning">
                        <img src="../img/iconoLapiz.svg" alt="Cambiar nombre" style="max-width: 20px;"> Modificar Producto
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
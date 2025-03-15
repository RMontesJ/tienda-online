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
</head>
<body>
    
<div class="page">

<?php include "../includes/nav.php" ?>

<h1>Informacion del producto</h1>

<div class="datos">
<div class="foto">
<img src="../fotosProductos/<?php echo $fotoProducto; ?>" alt="Foto usuario" style="width:400px;height:300px;"><br>
</div>
<div class="nombre">
<p>Nombre: <?php echo $nombreProducto ?></p>

</div>

<div class="descripcion">
<p>Descripción: <?php echo $descripcionProducto ?></p>

</div>

<div class="categoria">
<p>Categoria: <?php echo $categoriaProducto ?></p>

</div>

<div class="precio">
<p>Precio: <?php echo $precioProducto ?></p>

</div>

<form action="../paginas/meterEnCarrito.php?id_user=<?php echo $usuario; ?>&id_producto=<?php echo $id_producto; ?>" method="post" class="config">
<input name="cantidad" type="number" min="1">
<button>Añadir al carrito</button>

</div>

</div>

</body>
</html>
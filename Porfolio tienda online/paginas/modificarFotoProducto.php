<?php

error_reporting(0);

$usuario = $_GET['id_user'];
$id_producto = $_GET['id_producto'];

require_once "../BD/productos.php";
$productos = new Productos();

$fotoPredeterminada = '../fotosProductos/image-product-default.png';
$foto = $fotoPredeterminada;

$extension = $_FILES['fotoNueva']['type'];


    if (isset($_FILES['fotoNueva'])) {

        if(strpos($extension, 'png') || strpos($extension, 'jpeg') || strpos($extension, 'jpg') || strpos($extension, 'webp')){
        
    
        // Ruta donde se guardará la foto
        $ruta_destino = '../fotosProductos/';
    
        // Nombre del archivo original
        $nombre_archivo = $_FILES['fotoNueva']['name'];
    
        // Mover el archivo desde el directorio temporal al directorio destino
        if (move_uploaded_file($_FILES['fotoNueva']['tmp_name'], $ruta_destino . $nombre_archivo)) {
            // Aquí puedes guardar $nombre_archivo en la base de datos o realizar otras operaciones
            $foto = $nombre_archivo;
        }
        $productos->editarFoto($usuario, $id_producto, $foto);
    }
    
    else if($_FILES['fotoNueva']['name'] == ""){
        $fotoPredeterminada = '../fotosProductos/image-product-default.png';
        $foto = $fotoPredeterminada;
        $productos->editarFoto($usuario, $id_producto, $foto);
    }
    
    else{
        header("Location: ../paginas/modificarFotoProducto.php?id_user=$usuario&id_producto=$id_producto");
    }
    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar foto producto</title>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

<div class="pagina">

    <?php include "../includes/navAdmin.php" ?>

    <div class="container-fluid">
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="formulario">
                    <form action="../paginas/modificarFotoProducto.php?id_user=<?php echo $usuario ?>&id_producto=<?php echo $id_producto; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="fotoNueva" class="form-label">Foto (extensión .png, .jpeg, .jpg, .webp)</label>
                            <input type="file" name="fotoNueva" id="fotoNueva" class="form-control">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="../paginas/verProducto.php?id_user=<?php echo $usuario ?>&id_producto=<?php echo $id_producto ?>" class="text-decoration-none">Ver producto</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Actualizar Foto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
    
</body>
</html>
<?php

error_reporting(0);


$usuario = $_GET['id_user'];

require_once "../BD/productos.php";
require_once "../BD/Datos.php";

$datosUsuario = new Datos();
$clase = new Productos();

// funcion que coge el correo del usuario usando su id como argumento
$correo = $datosUsuario->cogerCorreo($usuario);

if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
    }

    // si no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];
// pone la foto de producto predeterminada si no se pone


$extension = $_FILES['foto']['type'];

if (isset($_FILES['foto'])) {

    if(strpos($extension, 'png') || strpos($extension, 'jpeg') || strpos($extension, 'jpg') || strpos($extension, 'webp')){

    // Ruta donde se guardará la foto (puedes ajustarla según tu estructura de archivos)
    $ruta_destino = '../fotosProductos/';

    // Nombre del archivo original
    $nombre_archivo = $_FILES['foto']['name'];

    // Mover el archivo desde el directorio temporal al directorio destino
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino . $nombre_archivo)) {
        // Aquí puedes guardar $nombre_archivo en la base de datos o realizar otras operaciones
        $foto = $nombre_archivo;
    }
    $altaProducto = $clase->crearProducto($nombre, $descripcion, $categoria, $precio, $foto, $usuario);
}

else if($_FILES['foto']['name'] == ""){
    $fotoPredeterminada = '../fotosProductos/image-product-default.png';
    $foto = $fotoPredeterminada;
    $altaProducto = $clase->crearProducto($nombre, $descripcion, $categoria, $precio, $foto, $usuario);
}

else{
    header("Location: ../paginas/crearProducto.php?id_user=$usuario");
}



}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear producto</title>
    <script src="../validaciones/subida_producto.js?v=<?php echo time(); ?>" defer></script>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>

<body>

<div class="container-fluid">

    <?php include "../includes/navAdmin.php" ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Crear y subir producto</h2>

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id_user=<?php echo $usuario; ?>" method="post" id="form" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" value="<?php echo $usuario; ?>">

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                                <p id="corregirNombre" class="text-danger small"></p>
                            </div>

                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción">
                                <p id="corregirDescripcion" class="text-danger small"></p>
                            </div>

                            <!-- Categoria -->
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select name="categoria" id="categoria" class="form-select">
                                    <option value=""></option>
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

                            <!-- Precio -->
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio">
                                <p id="corregirPrecio" class="text-danger small"></p>
                            </div>

                            <!-- Foto -->
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto (extensión .png .jpeg .jpg .webp)</label>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <!-- Botón Enviar -->
                            <div class="text-center">
                                <input class="btn btn-primary w-100 w-sm-auto" id="boton" type="submit" value="Enviar">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>

</html>
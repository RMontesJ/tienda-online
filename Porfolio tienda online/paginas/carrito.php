<?php


$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$clase = new Datos;

$correo = $clase->cogerCorreo($usuario);
// coje el id de los productos que coincide con el id del usuario
$idPoductosCarrito = $clase->cogerIdProductosCarrito($usuario);


if(!isset($usuario) || $usuario == ""){
    header("Location: ../paginas/inicio_sesion.php");
    }

    // si es admin
    if (strpos($correo, "@admin.com") === true) {
        header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
        exit();
    }
// verifica el valor del campo de texto del include busquedaProductos.php,
// guardando su valor en una variable

    if(isset($_POST['enviar'])){
        $valor = $_POST['busqueda'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../css/carrito.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">

</head>
<body>

<div class="pagina">

<?php include "../includes/nav.php" ?>


<div class="carrito">
<?php echo $pintarCarrito = $clase->pintarCarrito($idPoductosCarrito);?>
</div>

<a href="../paginas/descargarPedidoPDF.php?id_user=<?php echo $usuario; ?>" target="_blank">
    <button>Descargar PDF</button>
</a>

</div>
    
</body>
</html>
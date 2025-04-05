<?php 

error_reporting(0);

$usuario = $_GET['id_user'];
$destinatario = $_GET['id_receiver'];

require_once "../BD/Datos.php";
$datosUsuario = new Datos();

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha = date("d-m-Y H:i:s");


// Procesar el formulario cuando se envía
    if(isset($titulo) && isset($descripcion)){
        $datosUsuario->enviarNotificacion($destinatario, $titulo, $descripcion, $fecha, $usuario);

    }

// Obtener el correo del usuario
$correo = $datosUsuario->cogerCorreo($usuario);



    // si es admin
    if (strpos($correo, "@admin.com") === false) {
        header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Notificación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="../validaciones/enviarNotificacion.js?v=<?php echo time(); ?>" defer></script>
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>


<div class="container-fluid">

    <?php include "../includes/navAdmin.php" ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-12 col-md-6 col-lg-4 p-4 shadow-lg rounded bg-white">
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id_user=' . urlencode($usuario) . '&id_receiver=' . urlencode($destinatario); ?>" id="form" method="POST" class="text-center">
    <h1 class="mb-4">Enviar Notificación</h1>
            
            <div class="mb-3 text-start">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título de la notificación">
                <p id="corregirTitulo" class="text-danger small"></p> <!-- Mensaje de error para el título -->
            </div>
            
            <div class="mb-3 text-start">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción de la notificación"></textarea>
                <p id="corregirDescripcion" class="text-danger small"></p> <!-- Mensaje de error para la descripción -->
            </div>

            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>
</div>

</body>
</html>

<?php

$usuario = $_GET['id_user'];

if (!isset($usuario) || $usuario == "") {
    header("Location: ../paginas/inicio_sesion.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar email</title>
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/crearProducto.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="pagina">

    <?php include "../includes/nav.php" ?>

    <div class="formulario">
    
    <form action="logicaEnviarEmail.php?id_user=<?php echo $usuario ?>" method="post" id="form">
            <h2>Enviar email</h2>

            <div class="input-group">
                <label for="destinatario">Destinatario</label>
                <input type="text" name="destinatario" id="destinatario" placeholder="Destinatario">
                <p id="corregirDestinatario"></p>

                <label for="asunto">asunto</label>
                <input type="text" name="asunto" id="asunto" placeholder="Asunto">
                <p id="corregirAsunto"></p>

                <label for="mensaje">Mensaje</label>
                <textarea type="text" name="mensaje" id="mensaje" placeholder="Mensaje"></textarea>
                <p id="corregirMensaje"></p>

                <div class="form-txt">
                    <a href="#">Volver</a>
                </div>
                <input class="btn" id="boton" type="submit" value="Enviar">
            </div>
        </form>
        </div>
    </div>
    
</body>
</html>
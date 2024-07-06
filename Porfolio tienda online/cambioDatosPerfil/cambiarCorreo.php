
<?php 

$usuario = $_GET['id_user']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar nombre</title>
    <link rel="stylesheet" href="../css/formulario.css">
    <script src="../validaciones/cambiar_correo.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>

<form action="logicaCambiarCorreo.php?id_user=<?php echo $usuario ?>" method="post" id="form">
<h2>Cambiar correo</h2>

<div class="input-group">
<label for="name">Correo nuevo</label>
<input type="text" name="correoNuevo" id="correoNuevo" placeholder="Correo nuevo">
<p id="correccionCorreo"></p>

<div class="form-txt">
<a href="../paginas/perfil.php?id_user=<?php echo $usuario; ?>">Volver a mi perfil</a>

</div>
<input class="btn" type="submit" value="Enviar">
</div>
</form>
    
</body>
</html>
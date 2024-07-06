
<?php 

$usuario = $_GET['id_user']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar nombre</title>
    <link rel="stylesheet" href="../css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/crearProducto.css?v=<?php echo time(); ?>">
    <script src="../validaciones/cambiar_nombre.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>

<div class="pagina">

<?php include "../includes/nav.php" ?>

<div class="formulario">

<form action="logicaCambiarNombre.php?id_user=<?php echo $usuario ?>" method="post" id="form">
<h2>Cambiar nombre</h2>

<div class="input-group">
<label for="name">Nombre nuevo</label>
<input type="text" name="nombreNuevo" id="nombreNuevo" placeholder="Nombre nuevo">
<p id="correccionNombre"></p>

<div class="form-txt">
<a href="../paginas/perfil.php?id_user=<?php echo $usuario; ?>">Volver a mi perfil</a>

</div>
<input class="btn" type="submit" value="Enviar">
</div>
</form>

</div>

</div>
    
</body>
</html>

<?php 

error_reporting(0);

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$datosUsuario = new Datos();

// si la sesion no esta puesta o esta vacia
if(!isset($usuario) || $usuario == ""){
header("Location: ../paginas/inicio_sesion.php");
}
// coge el correo
$correo = $datosUsuario->cogerCorreo($usuario);

// si no es admin
if (strpos($correo, "@admin.com") === false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}
// si se le da al boton de buscar, coge el valor de la busqueda del include busquedaUsuarios.php
// y lo pasa como argumento al metodo buscarUsuarios
if(isset($_POST['enviar'])){
    $valor = $_POST['busqueda'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../css/usuarios.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/nav.css">
    <?php include "../includes/bootstrapLinks.php" ?>
</head>
<body>

<div class="pagina">

<?php include "../includes/navAdmin.php" ?>

<h1>Usuarios</h1>

<?php 
// include con el campo de texto y boton de busqueda
include "../includes/busquedaUsuarios.php"

?>

<div id="perfiles">
<?php 

 // ejecuta una sentencia a la base de datos que busca usuarios con el valor del campo del include
 //busquedaUsuarios.php
$imprimirUsuarios = $datosUsuario->buscarUsuarios($valor);


?>
</div>

</div>
    
</body>
</html>


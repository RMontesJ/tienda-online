<?php 

require_once "../BD/Datos.php";
$clase = new Datos;

$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

// coge el id del usuario y lo guarda en una variable
$inicioSesion = $clase->inicioSesion($nombre, $contrasena);

// coge el correo del usuario que se esta iniciando sesion
$tipoCorreo = $clase->cogerCorreo($inicioSesion);

// Comprueba el correo, si tiene @admin le lleva a la pagina del administrador, y si no te lleva a tu perfil

if(isset($nombre) && isset($contrasena) && strpos($tipoCorreo, "@admin.com") && isset($inicioSesion)){
    session_start();
    $_SESSION['usuario'] = $inicioSesion;
    $clase->comprobarSiCarritoExiste($inicioSesion);
    header("Location: ../paginas/indexRegistradoAdmin.php?id_user=".$inicioSesion);
}
else if(isset($nombre) && isset($contrasena) && !strpos($tipoCorreo, "@admin.com") && isset($inicioSesion)){
    session_start();
    $_SESSION['usuario'] = $inicioSesion;
    $clase->comprobarSiCarritoExiste($inicioSesion);
    header("Location: ../paginas/indexRegistrado.php?id_user=".$inicioSesion);
}

?>
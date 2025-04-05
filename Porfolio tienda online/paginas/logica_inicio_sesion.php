<?php 

// importamos la clase que ofrece los metodos y conexion con la base de datos, creando una instancia
require_once "../BD/Datos.php";
$clase = new Datos;

// recogemos el valor del nombre y la contraseña utilizando $_GET
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

//guardamos la fecha actual gracias a un metodo que aporta PHP
$fecha = date("Y-m-d H:i:s");

// coge el id del usuario y lo guarda en una variable
$inicioSesion = $clase->inicioSesion($nombre, $contrasena);

// coge el correo del usuario que se esta iniciando sesion
$tipoCorreo = $clase->cogerCorreo($inicioSesion);

// Comprueba el correo, si tiene @admin le lleva a la pagina del administrador, y si no te lleva a la pagina del cliente

if(isset($nombre) && isset($contrasena) && strpos($tipoCorreo, "@admin.com") && isset($inicioSesion)){
    session_start();
    $_SESSION['usuario'] = $inicioSesion;
    // creamos una notificacion de bienvenida la primera vez que inicia sesion
    $clase->verificarNotificacionBienvenida($inicioSesion, $tipoCorreo, $fecha);
    // redireccionamos al usuario
    header("Location: ../paginas/indexRegistradoAdmin.php?id_user=".$inicioSesion);
}
else if(isset($nombre) && isset($contrasena) && !strpos($tipoCorreo, "@admin.com") && isset($inicioSesion)){
    session_start();
    $_SESSION['usuario'] = $inicioSesion;
        // creamos una notificacion de bienvenida la primera vez que inicia sesion
    $clase->verificarNotificacionBienvenida($inicioSesion, $tipoCorreo, $fecha);
        // redireccionamos al usuario
    header("Location: ../paginas/indexRegistrado.php?id_user=".$inicioSesion);
}

?>
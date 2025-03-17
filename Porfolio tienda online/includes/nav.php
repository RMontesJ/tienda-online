<?php 

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$datosUsuario = new Datos();
$fotoPerfil = $datosUsuario->cogerFoto($usuario);

?>

<header>
    <img src="../img/logUnimatchIA.jpg" alt="">
    <nav>
        <ul>
            <li><a href="../paginas/indexRegistrado.php?id_user=<?php echo $usuario; ?>">Inicio</a></li>
            <li><a href="../paginas/ayuda.php?id_user=<?php echo $usuario; ?>">Ayuda</a></li>
        </ul>
    </nav>
    <div class="profile-logout-box">
    <a href="../paginas/notificaciones.php?id_user=<?php echo $usuario; ?>"><img src="../img/MaterialSymbolsNotifications.svg" alt="Carrito" style="width:40px;height:40px;"></a>
    <a href="../paginas/carrito.php?id_user=<?php echo $usuario; ?>"><img src="../img/MdiCart.svg" alt="Carrito" style="width:40px;height:40px;"></a>
    <a href="../paginas/perfil.php?id_user=<?php echo $usuario; ?>"><img src="../fotosUsuarios/<?php echo $fotoPerfil; ?>" alt="Foto usuario" style="width:40px;height:40px;"></a>
    <a href="../paginas/cerrarSesion.php"><img src="../img/logout_icon.svg" alt="Logout" style="width:40px;height:40px;"></a>
    </div>
</header>
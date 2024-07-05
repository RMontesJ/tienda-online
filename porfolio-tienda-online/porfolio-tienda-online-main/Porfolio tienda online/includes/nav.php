<?php 

$usuario = $_GET['id_user'];

?>

<header>
    <img src="img/logUnimatchIA.jpg" alt="">
    <nav>
        <ul>
            <li><a href="indexRegistrado.php?id_user=<?php echo $usuario; ?>">Inicio</a></li>
            <li><a href="ayuda.php?id_user=<?php echo $usuario; ?>">Ayuda</a></li>
            <li><a href="perfil.php?id_user=<?php echo $usuario; ?>">Perfil</a></li>
        </ul>
    </nav>
    <button class="cerrarSesion"><a href="cerrarSesion.php">Cerrar sesion</a></button>
</header>
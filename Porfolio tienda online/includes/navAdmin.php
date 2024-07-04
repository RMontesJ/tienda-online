<?php 

$usuario = $_GET['id_user'];

?>

<header>
    <img src="img/logUnimatchIA.jpg" alt="">
    <nav>
        <ul>
            <li><a href="indexRegistradoAdmin.php?id_user=<?php echo $usuario; ?>">Inicio</a></li>
            <li><a href="crearProducto.php?id_user=<?php echo $usuario; ?>">Subir producto</a></li>
            <li><a href="usuarios.php?id_user=<?php echo $usuario; ?>">Usuarios</a></li>
            <li><a href="#">Ayuda</a></li>
            <li><a href="perfilAdmin.php?id_user=<?php echo $usuario; ?>">Perfil</a></li>
        </ul>
    </nav>
    <button class="cerrarSesion"><a href="cerrarSesion.php">Cerrar sesion</a></button>
</header>
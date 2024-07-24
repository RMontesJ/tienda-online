<?php 

$usuario = $_GET['id_user'];

?>

<header>
    <img src="../img/logUnimatchIA.jpg" alt="">
    <nav>
        <ul>
            <li><a href="../paginas/indexRegistradoAdmin.php?id_user=<?php echo $usuario; ?>">Inicio</a></li>
            <li><a href="../paginas/crearProducto.php?id_user=<?php echo $usuario; ?>">Subir producto</a></li>
            <li><a href="../paginas/usuarios.php?id_user=<?php echo $usuario; ?>">Usuarios</a></li>
            <li><a href="../paginas/ayudaAdmin.php?id_user=<?php echo $usuario; ?>">Ayuda</a></li>
            <li><a href="../paginas/perfilAdmin.php?id_user=<?php echo $usuario; ?>">Mi perfil</a></li>
        </ul>
    </nav>
    <button class="cerrarSesion"><a href="cerrarSesion.php">Cerrar sesion</a></button>
</header>
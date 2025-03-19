<?php 

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$datosUsuario = new Datos();
$fotoPerfil = $datosUsuario->cogerFoto($usuario);

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../img/logUnimatchIA.jpg" alt="Logo" style="height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="../paginas/indexRegistrado.php?id_user=<?php echo $usuario; ?>" class="nav-link">Inicio</a></li>
                <li class="nav-item"><a href="../paginas/ayuda.php?id_user=<?php echo $usuario; ?>" class="nav-link">Ayuda</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="../paginas/notificaciones.php?id_user=<?php echo $usuario; ?>" class="me-3">
                    <img src="../img/MaterialSymbolsNotifications.svg" alt="Notificaciones" style="width:40px;height:40px;">
                </a>
                <a href="../paginas/carrito.php?id_user=<?php echo $usuario; ?>" class="me-3">
                    <img src="../img/MdiCart.svg" alt="Carrito" style="width:40px;height:40px;">
                </a>
                <a href="../paginas/perfil.php?id_user=<?php echo $usuario; ?>" class="me-3">
                    <img src="../fotosUsuarios/<?php echo $fotoPerfil; ?>" alt="Foto usuario" class="rounded-circle" style="width:40px;height:40px;">
                </a>
                <a href="../paginas/cerrarSesion.php">
                    <img src="../img/logout_icon.svg" alt="Logout" style="width:40px;height:40px;">
                </a>
            </div>
        </div>
    </div>
</nav>

<?php 

$usuario = $_GET['id_user'];

require_once "../BD/Datos.php";
$datosUsuario = new Datos();
$fotoPerfil = $datosUsuario->cogerFoto($usuario);

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="../img/logUnimatchIA.jpg" alt="Logo" style="height: 50px;">
            </a>

            <!-- Botón para menú responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenido del menú -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a href="../paginas/indexRegistradoAdmin.php?id_user=<?php echo $usuario; ?>" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="../paginas/crearProducto.php?id_user=<?php echo $usuario; ?>" class="nav-link">Subir producto</a></li>
                    <li class="nav-item"><a href="../paginas/usuarios.php?id_user=<?php echo $usuario; ?>" class="nav-link">Usuarios</a></li>
                    <li class="nav-item"><a href="../paginas/ayudaAdmin.php?id_user=<?php echo $usuario; ?>" class="nav-link">Ayuda</a></li>
                </ul>
                <!-- Iconos de perfil y logout -->
                <div class="d-flex align-items-center">

                <a href="../paginas/pedidos.php?id_user=<?php echo $usuario; ?>" class="me-3">
                        <img src="../img/MaterialSymbolsDeliveryTruckSpeed.svg" alt="Notificaciones" style="width:40px;height:40px;">
                    </a>
                    <a href="../paginas/notificaciones.php?id_user=<?php echo $usuario; ?>" class="me-3">
                        <img src="../img/MaterialSymbolsNotifications.svg" alt="Notificaciones" style="width:40px;height:40px;">
                    </a>
                    <a href="../paginas/perfilAdmin.php?id_user=<?php echo $usuario; ?>" class="me-3">
                        <img src="../fotosUsuarios/<?php echo $fotoPerfil; ?>" alt="Foto usuario" class="rounded-circle" style="width:40px;height:40px;">
                    </a>
                    <a href="../paginas/cerrarSesion.php">
                        <img src="../img/logout_icon.svg" alt="Logout" style="width:40px;height:40px;">
                    </a>
                </div>
            </div>
        </div>
    </nav>
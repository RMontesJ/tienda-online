<?php

class Datos
{
    private $dbhost = 'localhost';
    private $dbuser = 'Rafa';
    private $dbpasswd = "1234";
    private $dbname = "tienda_online";

    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli($this->dbhost, $this->dbuser, $this->dbpasswd, $this->dbname);
        $this->conexion->select_db($this->dbname);
        $this->conexion->query("SET NAMES 'utf8'");
        if (!$this->conexion) {
            die("Error de conexion: " . mysqli_connect_error());
        }

    }


    public function buscarUsuarios($busqueda, $id_propio)
    {
        $consulta = $this->conexion->query("SELECT * FROM usuarios WHERE id LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR contrasena LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%'");

        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            echo "<div class='col-md-4 mb-4'>"; // Cada tarjeta ocupa 4 columnas en pantallas medianas o más grandes
        echo "<div class='card h-100 shadow-sm'>"; // Tarjeta con sombra y altura uniforme
        
        // Imagen de perfil
        echo "<img src='../fotosUsuarios/" . $row['foto'] . "' class='card-img-top' alt='Foto usuario' style='height: 300px; object-fit: cover;'>"; // Imagen ajustada y responsiva

        // Cuerpo de la tarjeta
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>ID: " . $row['id'] . "</h5>";
        echo "<p class='card-text'><strong>Nombre:</strong> " . $row['nombre'] . "</p>";
        echo "<p class='card-text'><strong>Contraseña:</strong> " . $row['contrasena'] . "</p>";
        echo "<p class='card-text'><strong>Correo:</strong> " . $row['correo'] . "</p>";
        echo "<p class='card-text'><strong>Dirección:</strong> " . $row['direccion'] . "</p>";
        echo "</div>"; // Fin card-body
        echo "<a href='enviarMensaje.php?id_user=$id_propio&id_receiver=" . $row['id'] . "'><img src='../img/messageIcon.svg' alt='Enviar mensaje' style='width: 30px; height: 30px;'></a>";

        // Cierre de la tarjeta
        echo "</div>"; // Fin card
       
        echo "</a>";
        echo "</div>"; // Fin col-md-4
            
    
        }
    }

    public function enviarNotificacion($id_destinatario, $titulo, $descripcion, $fecha, $usuario){

        $query = mysqli_query($this->conexion, "INSERT INTO notificaciones (id_usuario, titulo, descripcion, fecha) VALUES ($id_destinatario, '$titulo', '$descripcion', '$fecha')");

        header("Location: ../paginas/indexRegistradoAdmin.php?id_user=$usuario");
    }

    public function buscarMisPedidos($productos, $id_usuario, $valor) {
        if (empty($productos)) {
            echo "No has realizado pedidos aún.";
            return;
        }
    
        // Extraemos solo los IDs de los productos para hacer la consulta
        $productos_ids = array_column($productos, 'producto_id');
        $productos_list = implode(",", array_map("intval", $productos_ids));
    
        // Consultamos los detalles de los productos en la tabla `productos`, `pedidos` y `usuarios`
        $consulta = $this->conexion->query("
            SELECT p.id, p.nombre AS producto_nombre, p.descripcion, p.categoria, p.precio, p.foto, 
                   pe.cantidad, pe.fecha, u.direccion, u.nombre AS nombre_usuario, pe.usuario_id
            FROM pedidos pe
            INNER JOIN productos p ON pe.producto_id = p.id 
            INNER JOIN usuarios u ON pe.usuario_id = u.id
            WHERE pe.usuario_id = $id_usuario 
            AND (p.nombre LIKE '%$valor%' 
                 OR u.nombre LIKE '%$valor%' 
                 OR pe.fecha LIKE '%$valor%' 
                 OR pe.id = '$valor')"
        );
    
        $total_pedidos = 0;
    
        if ($consulta->num_rows == 0) {
            echo "No se encontraron pedidos que coincidan con tu búsqueda.";
            return;
        }
    
        // Inicio de tabla
        echo "<table border='1' style='width:100%; text-align:left; border-collapse: collapse; font-family: Arial, sans-serif;'>";
        echo "<tr style='background-color: #f2f2f2;'>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Dirección</th>
                <th>Usuario</th>
              </tr>";
    
        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $total_producto = $cantidad * $precio;
            $total_pedidos += $total_producto;
    
            echo "<tr>";
            echo "<td><img src='../fotosProductos/" . htmlspecialchars($row['foto']) . "' alt='Foto del producto' style='width:100px;height:100px;'></td>";
            echo "<td>" . htmlspecialchars($row['producto_nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
            echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
            echo "<td>" . htmlspecialchars($row['precio']) . "€</td>";
            echo "<td>" . htmlspecialchars($cantidad) . "</td>";
            echo "<td>" . number_format($total_producto, 2) . "€</td>";
            echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
            echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nombre_usuario']) . "</td>";
            echo "</tr>";
        }
    
        // Fila total
        echo "<tr>
                <td colspan='7' style='text-align:right; font-weight:bold;'>Total de pedidos:</td>
                <td style='font-weight:bold;'>" . number_format($total_pedidos, 2) . "€</td>
                <td colspan='3'></td>
              </tr>";
    
        echo "</table>";
    }
    
    
    public function buscarPedidos($usuario, $busqueda) {
        // Consulta de pedidos con filtrado por nombre de producto, nombre de usuario y fecha
        $consulta = $this->conexion->query("SELECT p.id, p.nombre AS producto_nombre, p.descripcion, p.categoria, p.precio, p.foto, 
                                                   pe.cantidad, pe.fecha, u.direccion, u.nombre AS nombre_usuario, pe.usuario_id
                                            FROM pedidos pe
                                            INNER JOIN productos p ON pe.producto_id = p.id
                                            INNER JOIN usuarios u ON pe.usuario_id = u.id
                                            WHERE p.nombre LIKE '%$busqueda%' 
                                            OR u.nombre LIKE '%$busqueda%' 
                                            OR pe.fecha LIKE '%$busqueda%'");
    
        if ($consulta->num_rows == 0) {
            echo "No se encontraron pedidos que coincidan con tu búsqueda.";
            return;
        }
    
        // Mostrar los resultados de los pedidos encontrados
        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            $cantidad = $row['cantidad'];
            $precio = $row['precio'];
            $total_producto = $cantidad * $precio;
    
            echo "<div class='col-md-4 mb-4'>"; // Cada tarjeta ocupa 4 columnas en pantallas medianas o más grandes
            echo "<div class='card h-100 shadow-sm'>"; // Tarjeta con sombra y altura uniforme
            echo "<img src='../fotosProductos/" . htmlspecialchars($row['foto']) . "' alt='Foto del producto' class='card-img-top' style='height: 300px;'></a>"; // Imagen responsiva y ajustada
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($row['producto_nombre']) . "</h5>";
            echo "<p class='card-text'>" . htmlspecialchars($row['descripcion']) . "</p>";
            echo "<p class='text-muted'><strong>Categoría:</strong> " . htmlspecialchars($row['categoria']) . "</p>";
            echo "<p class='fw-bold text-primary'>Precio: " . htmlspecialchars($row['precio']) . "€</p>";
            echo "<p class='fw-bold text-primary'>Cantidad: " . htmlspecialchars($row['cantidad']) . "</p>";
            echo "<p class='fw-bold text-primary'>Total del Producto: " . number_format($total_producto, 2) . "€</p>";
            echo "<p><strong>Fecha de compra:</strong> " . htmlspecialchars($row['fecha']) . "</p>";
            echo "<p><strong>Dirección de envío:</strong> " . htmlspecialchars($row['direccion']) . "</p>";
            echo "<p><strong>Nombre del Usuario:</strong> " . htmlspecialchars($row['nombre_usuario']) . "</p>";
            echo "</div>"; // Fin card-body
            echo "</div>"; // Fin card
            echo "</div>"; // Fin col-md-4
        }
    }
    

    public function buscarProductos($busqueda, $usuario)
    {
        $consulta = $this->conexion->query("SELECT * FROM productos WHERE id LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR precio LIKE '%$busqueda%'");

        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            echo "<div class='col-md-4 mb-4'>"; // Cada tarjeta ocupa 4 columnas en pantallas medianas o más grandes
            echo "<div class='card h-100 shadow-sm'>"; // Tarjeta con sombra y altura uniforme
            echo "<a href='../paginas/infoProducto.php?id_user=$usuario&id_producto=" . $row['id'] . "'>";
            echo "<img src='../fotosProductos/" . $row['foto'] . "' alt='Foto del producto' class='card-img-top' style='height: 300px;'></a>"; // Imagen responsiva y ajustada
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row['nombre'] . "</h5>";
            echo "<p class='card-text'>" . $row['descripcion'] . "</p>";
            echo "<p class='text-muted'><strong>Categoría:</strong> " . $row['categoria'] . "</p>";
            echo "<p class='fw-bold text-primary'>Precio: " . $row['precio'] . "€</p>";
            echo "</div>"; // Fin card-body
            echo "</div>"; // Fin card
            echo "</div>"; // Fin col-md-4
            
        }
    }


    public function buscarProductosAdmin($busqueda, $usuario)
    {
        $consulta = $this->conexion->query("SELECT * FROM productos WHERE id LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR precio LIKE '%$busqueda%'");

        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            echo "<div class='col-md-4 mb-4'>"; // Cada tarjeta ocupa 4 columnas en pantallas medianas o más grandes
echo "<div class='card h-100 shadow-sm'>"; // Tarjeta con sombra y altura uniforme
echo "<a href='../paginas/infoProductoAdmin.php?id_user=$usuario&id_producto=" . $row['id'] . "'>";
echo "<img src='../fotosProductos/" . $row['foto'] . "' alt='Foto del producto' class='card-img-top' style='height: 300px;'></a>"; // Imagen responsiva y ajustada
echo "<div class='card-body'>";
echo "<h5 class='card-title'>" . $row['nombre'] . "</h5>";
echo "<p class='card-text'>" . $row['descripcion'] . "</p>";
echo "<p class='text-muted'><strong>Categoría:</strong> " . $row['categoria'] . "</p>";
echo "<p class='fw-bold text-primary'>Precio: " . $row['precio'] . "€</p>";
echo "<div class='botones'>";
echo "<a href='../paginas/verProducto.php?id_user=$usuario&id_producto=" . $row['id'] . "' class='btn btn-outline-primary btn-sm'><img src='../img/iconoLapiz.svg' alt='Editar'></a>";
echo "<a href='../paginas/borrarProducto.php?id_user=$usuario&id_producto=" . $row['id'] . "' class='btn btn-outline-danger btn-sm'><img src='../img/iconoPapelera.svg' alt='Eliminar'></a>";
echo "</div>";
echo "</div>"; // Fin card-body
echo "</div>"; // Fin card
echo "</div>"; // Fin col-md-4

        }
    }

    public function pintarNotificaciones($id_usuario){

        $consulta = $this->conexion->query("SELECT * FROM notificaciones WHERE id_usuario = $id_usuario");

    while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
    echo "<div class='tarjeta'>";
    echo "<h3>" . $row['titulo'] . "</h3>";
    echo "<p>" . $row['descripcion'] . "</p>";
    echo "<small>Fecha: " . $row['fecha'] . "</small><br>";
    echo "</div>";
}

    }



    public function borrarProducto($id){
        $query = mysqli_query($this->conexion, "DELETE FROM productos WHERE id = '$id'");
    }

    public function borrarProductoCarrito($usuario, $producto_id){
        $query = mysqli_query($this->conexion, "DELETE FROM carrito WHERE usuario_id = $usuario and producto_id= $producto_id");
    }

    public function borrar($id)
    {
        $query = mysqli_query($this->conexion, "DELETE FROM usuarios WHERE id = '$id'");

    }
// metodo que permita crear un usuario
    public function crear($nombre, $contrasena, $correo, $direccion, $foto)
    {
        $query = mysqli_query($this->conexion, "INSERT INTO usuarios (nombre, contrasena, correo, direccion, foto) VALUES ('$nombre','$contrasena','$correo','$direccion','$foto')");
        $query = mysqli_query($this->conexion, "SELECT * FROM usuarios where nombre = '$nombre' and contrasena = '$contrasena'");
        $num = mysqli_num_rows($query);
        if ($num == 1) {
            header("Location: inicio_sesion.php");
        }
    }

    public function crearCarrito($usuario_id, $producto_id, $cantidad){
        $query = mysqli_query($this->conexion, "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($usuario_id, $producto_id, $cantidad)");
    }

    public function meterEnCarrito($usuario, $producto_id, $cantidad){
        $query = mysqli_query($this->conexion, "UPDATE carrito SET cantidad = $cantidad, producto_id = $producto_id WHERE usuario_id = $usuario");        
    }

    public function crearPedido($id_usuario) {
        $fecha = date("d-m-Y H:i:s");  // Fecha y hora actual
        $query = mysqli_query($this->conexion, "INSERT INTO pedidos (usuario_id, producto_id, cantidad, fecha)
            SELECT usuario_id, producto_id, cantidad, '$fecha' FROM carrito WHERE usuario_id = $id_usuario");
    }
    

    public function crearPDFCompra($correo, $productos){
        
// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Factura de Compra', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, "Usuario: $correo", 0, 1);
$pdf->Ln(5);

// Encabezado de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 10, 'Producto', 1);
$pdf->Cell(50, 10, 'Precio', 1);
$pdf->Cell(50, 10, 'Cantidad', 1);
$pdf->Ln();

// Datos de los productos
$pdf->SetFont('Arial', '', 12);
$total = 0;

foreach ($productos as $producto) {
    $pdf->Cell(90, 10, $producto['nombre'], 1);
    $pdf->Cell(50, 10, "$" . $producto['precio'], 1);
    $pdf->Cell(50, 10, $producto['cantidad'], 1);
    $pdf->Ln();
    $total += $producto['precio'] * $producto['cantidad'];
}

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'Total:', 1);
$pdf->Cell(50, 10, "$" . $total, 1);
$pdf->Ln();

// Descargar el PDF
$pdf->Output('D', 'factura.pdf');
    }

    public function vaciarCarrito($id_usuario){
        $query = mysqli_query($this->conexion, "DELETE FROM carrito WHERE usuario_id = '$id_usuario'");
    }

    public function cogerIdProductosCarrito($id_usuario) {
        // Aseguramos que $id_usuario es un número entero válido
        $id_usuario = intval($id_usuario);
    
        $query = mysqli_query($this->conexion, "SELECT producto_id, cantidad FROM carrito WHERE usuario_id = $id_usuario");
    
        $productos = [];
        while ($row = mysqli_fetch_assoc($query)) {
            // Guardamos cada producto con su cantidad en un array asociativo
            $productos[] = [
                'producto_id' => $row['producto_id'],
                'cantidad' => $row['cantidad']
            ];
        }
    
        return $productos; // Devuelve un array con los IDs de los productos y sus cantidades
    }

    public function cogerIdProductosPedido($id_usuario) {
        // Aseguramos que $id_usuario es un número entero válido
        $id_usuario = intval($id_usuario);
    
        $query = mysqli_query($this->conexion, "SELECT producto_id, cantidad FROM pedidos WHERE usuario_id = $id_usuario");
    
        $productos = [];
        while ($row = mysqli_fetch_assoc($query)) {
            // Guardamos cada producto con su cantidad en un array asociativo
            $productos[] = [
                'producto_id' => $row['producto_id'],
                'cantidad' => $row['cantidad']
            ];
        }
    
        return $productos; // Devuelve un array con los IDs de los productos y sus cantidades
    }

    public function obtenerProductosPorId($usuario) {
        $sql = "SELECT p.nombre, p.precio, c.cantidad 
        FROM carrito c
        JOIN productos p ON c.producto_id = p.id
        WHERE c.usuario_id = ?";

    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        $productos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
    
        return $productos;
    }
    
    
    
    public function pintarCarrito($productos, $usuario) {
        if (empty($productos)) {
            echo "El carrito está vacío.";
            return;
        }
    
        // Extraemos solo los IDs de los productos para hacer la consulta
        $productos_ids = array_column($productos, 'producto_id');
        $productos_list = implode(",", array_map("intval", $productos_ids));
    
        // Consultamos los detalles de los productos en la tabla `productos` y las cantidades en la tabla `carrito`
        $consulta = $this->conexion->query("SELECT p.id, p.nombre, p.descripcion, p.categoria, p.precio, p.foto, c.cantidad 
                                            FROM productos p
                                            INNER JOIN carrito c ON p.id = c.producto_id
                                            WHERE c.producto_id IN ($productos_list)");
    
        $total_carrito = 0; // Variable para almacenar el total del carrito
    
        // Iniciamos la tabla con la nueva columna "Total"
        echo "<table border='1' style='width:60%; text-align:left; border-collapse: collapse;'>";
        echo "<tr>
                <th>Imagen</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th> 
                <th>Total</th>
                <th>Acción</th> <!-- Nueva columna para eliminar -->
              </tr>";
    
    // Recorremos los productos y los mostramos en la tabla
    while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
        $producto_id = $row['id']; // ID del producto
        $cantidad = $row['cantidad']; // Cantidad del producto en el carrito
        $precio = $row['precio']; // Precio del producto
        $total_producto = $cantidad * $precio; // Total por producto
        $total_carrito += $total_producto; // Sumar al total del carrito
    
        echo "<tr>";
        echo "<td><img src='../fotosProductos/" . htmlspecialchars($row['foto']) . "' alt='Foto del producto' style='width:100px;height:100px;'></td>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
        echo "<td>" . htmlspecialchars($row['precio']) . "€</td>";
        echo "<td>" . htmlspecialchars($cantidad) . "</td>"; // Muestra la cantidad
        echo "<td>" . number_format($total_producto, 2) . "€</td>"; // Muestra el total del producto (cantidad * precio)
        echo "<td><a href='../paginas/borrarProductoCarrito.php?id_user=$usuario&id_producto=" . $row['id'] . "'><img src='../img/iconoPapelera.svg' alt='Eliminar'></a></td>";
        echo "</tr>";
    
    }
    
    // Agregar la fila del total del carrito
    echo "<tr>
            <td colspan='7' style='text-align:right; font-weight:bold;'>Total Carrito:</td>
            <td style='font-weight:bold;'>" . number_format($total_carrito, 2) . "€</td>
            <td></td> <!-- Celda vacía para mantener alineación -->
          </tr>";
    
    // Cerramos la tabla
    echo "</table>";
    
    }

    public function verificarNotificacionBienvenida($id_usuario, $correo, $fecha) {
        // Ejecutar la consulta correctamente
        $query = "SELECT * FROM notificaciones WHERE id_usuario = $id_usuario AND titulo = 'Bienvenido'";
        $result = mysqli_query($this->conexion, $query); // Ejecutar la consulta
        $num = mysqli_num_rows($result); // Contar filas correctamente
    
        if ($num == 0) {
            if (strpos($correo, "@admin.com")) {
                $this->crearNotificacionBienvenidaAdmin($id_usuario, $fecha);
            } else {
                $this->crearNotificacionBienvenida($id_usuario, $fecha);
            }
        }
    }
    

    public function crearNotificacionBienvenidaAdmin($id_usuario, $fecha){

        $query = mysqli_query($this->conexion, "INSERT INTO notificaciones (id_usuario, titulo, descripcion, fecha) VALUES ($id_usuario, 'Bienvenido', 'Esta es tu cuenta de administrador. Podras crear y editar productos y ver los usuarios registrados en la app, asi como consultar y editar tu información personal', '$fecha')");

    }

    public function crearNotificacionBienvenida($id_usuario, $fecha){

        $query = mysqli_query($this->conexion, "INSERT INTO notificaciones (id_usuario, titulo, descripcion, fecha) VALUES ($id_usuario, 'Bienvenido', 'Gracias por registrarte en nuestra tienda. Podras revisar nuestros productos, realizar pedidos y editar tu información personal', '$fecha')");

    }

    public function crearNotificacionCompra($id_usuario, $fecha, $productos){
        $descripcion = "Gracias por tu compra. Has adquirido: ";
        $total = 0;
        
        foreach ($productos as $producto) {
            $subtotal = $producto['cantidad'] * $producto['precio'];
            $total += $subtotal;
            $descripcion .= "{$producto['nombre']} (Cantidad: {$producto['cantidad']}, Subtotal: \${$subtotal}), ";
        }
        
        $descripcion = rtrim($descripcion, ', ') . ". Total pagado: \${$total}. Puedes revisar tu pedido en la sección de historial de compras.";
        
        $query = mysqli_query($this->conexion, "INSERT INTO notificaciones (id_usuario, titulo, descripcion, fecha) VALUES ($id_usuario, 'Información de compra', '$descripcion', '$fecha')");
    }
    

// coge el id del usuario si esta registrado. Si no lo esta, se le reedirige al inicio de sesion
    public function inicioSesion($nombre, $contrasena)
    {
        $query = mysqli_query($this->conexion, "SELECT * FROM usuarios where nombre = '$nombre' and contrasena = '$contrasena'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del id
            $id = $row['id'];
            return $id;
        } else {
            header("Location: inicio_sesion.php");
        }

    }
    // metodo que coge el nombre
    public function cogerNombre($id)
    {
        $query = mysqli_query($this->conexion, "SELECT * FROM usuarios where id = '$id'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del nombre
            $nombre = $row['nombre'];
            return $nombre;
        } else {
            return "No se encontró nada";
        }
    }
// metodo que coge la contraseña
    public function cogerContrasena($id)
    {
        $query = mysqli_query($this->conexion, "SELECT * FROM usuarios where id = '$id'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del nombre
            $contrasena = $row['contrasena'];
            return $contrasena;
        } else {
            return "No se encontró nada";
        }
    }
// metodo que coge el correo
    public function cogerCorreo($id)
    {
        $query = mysqli_query($this->conexion, "SELECT * FROM usuarios where id = '$id'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del nombre
            $correo = $row['correo'];
            return $correo;
        } else {
            return "No se encontró nada";
        }
    }
// metodo que coge la dirección
    public function cogerDirección($id)
    {
        $query = mysqli_query($this->conexion, "SELECT * FROM usuarios where id = '$id'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del nombre
            $dirección = $row['direccion'];
            return $dirección;
        } else {
            return "No se encontró nada";
        }
    }

    public function cogerFoto($id){
        $query = mysqli_query($this->conexion, "SELECT * FROM usuarios where id = '$id'");
        $num = mysqli_num_rows($query);

        if ($num == 1) {
            $row = mysqli_fetch_assoc($query);
            // coge el valor del nombre
            $foto = $row['foto'];
            return $foto;
        } else {
            return "No se encontró nada";
        }
    }

    

}
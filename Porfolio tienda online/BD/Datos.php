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


    public function buscarUsuarios($busqueda)
    {
        $consulta = $this->conexion->query("SELECT * FROM usuarios WHERE id LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR contrasena LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%'");

        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            echo "<div class= 'tarjeta'>";
            echo "<img src='../fotosUsuarios/" . $row['foto'] . "' alt='Foto usuario' style='width:100%;height:300px;'><br>";
            echo "ID: " . $row['id'] . "<br>";
            echo "Nombre: " . $row['nombre'] . "<br>";
            echo "Contraseña: " . $row['contrasena'] . "<br>";
            echo "Correo: " . $row['correo'] . "<br>";
            echo "Dirección: " . $row['direccion'] . "<br>";
            echo "</div>";
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
echo "<a href='../paginas/infoProducto.php?id_user=$usuario&id_producto=" . $row['id'] . "'>";
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

    public function crearPedido($id_usuario){
        $query = mysqli_query($this->conexion, "INSERT INTO pedidos (usuario_id, producto_id, cantidad)
        SELECT usuario_id, producto_id, cantidad FROM carrito WHERE usuario_id = $id_usuario");        

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
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

    public function imprimirPerfiles()
    {
        $query = "SELECT * FROM usuarios";

        if ($result = $this->conexion->query($query)) {

            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $nombre = $row["nombre"];
                $contrasena = $row["contrasena"];
                $correo = $row["correo"];
                $direccion = $row["dirección"];

                echo "
    <div class='tarjeta'> 
    <p>Id: $id</p>
    <p>Nombre: $nombre</p>
    <p>Contraseña: $contrasena</p>
    <p>Correo: $correo</p>
    <p>Dirección: $direccion</p>
    </div>";
            }


            $result->free();
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
            echo "Dirección: " . $row['dirección'] . "<br>";
            echo "</div>";
        }
    }

    public function buscarProductos($busqueda, $usuario)
    {
        $consulta = $this->conexion->query("SELECT * FROM productos WHERE id LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR precio LIKE '%$busqueda%'");

        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            echo "<div class= 'tarjeta'>";
            echo "<a href='../paginas/infoProducto.php?id_user=$usuario&id_producto=". $row['id'] . "'><img src='../fotosProductos/" . $row['foto'] . "' alt='Foto del producto' style='width:100%;height:300px;'><br></a>";
            echo "ID: " . $row['id'] . "<br>";
            echo "Nombre: " . $row['nombre'] . "<br>";
            echo "Descripción: " . $row['descripción'] . "<br>";
            echo "Categoria: " . $row['categoria'] . "<br>";
            echo "Precio: " . $row['precio'] . "€" . "<br>";
            echo "</div>";
        }
    }


    public function buscarProductosAdmin($busqueda, $usuario)
    {
        $consulta = $this->conexion->query("SELECT * FROM productos WHERE id LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR precio LIKE '%$busqueda%'");

        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            echo "<div class= 'tarjeta'>";
            echo "<a href='../paginas/infoProducto.php?id_user=$usuario&id_producto=". $row['id'] . "'><img src='../fotosProductos/" . $row['foto'] . "' alt='Foto del producto' style='width:100%;height:300px;'><br></a>";
            echo "ID: " . $row['id'] . "<br>";
            echo "Nombre: " . $row['nombre'] . "<br>";
            echo "Descripción: " . $row['descripción'] . "<br>";
            echo "Categoria: " . $row['categoria'] . "<br>";
            echo "Precio: " . $row['precio'] . "€" . "<br>";
            echo "<div class= 'botones'>";
            echo "<a href='../paginas/verProducto.php?id_user=$usuario&id_producto=" . $row['id'] . "'><img src='../img/iconoLapiz.svg' alt=''></a>";
            echo "<a href='../paginas/borrarProducto.php?id_user=$usuario&id_producto=". $row['id'] . "'><img src='../img/iconoPapelera.svg' alt=''></a>";
            echo "</div>";
            echo "</div>";
        }
    }

    public function borrarProducto($id){
        $query = mysqli_query($this->conexion, "DELETE FROM productos WHERE id = '$id'");
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
    
    public function pintarCarrito($productos) {
        if (empty($productos)) {
            echo "El carrito está vacío.";
            return;
        }
    
        // Extraemos solo los IDs de los productos para hacer la consulta
        $productos_ids = array_column($productos, 'producto_id');
        $productos_list = implode(",", array_map("intval", $productos_ids));
    
        // Consultamos los detalles de los productos en la tabla `productos`
        $consulta = $this->conexion->query("SELECT * FROM productos WHERE id IN ($productos_list)");
    
        // Asociamos las cantidades a los productos consultados
        $cantidades = [];
        foreach ($productos as $producto) {
            $cantidades[$producto['producto_id']] = $producto['cantidad'];
        }
    
        // Iniciamos la tabla con la nueva columna "Cantidad"
        echo "<table border='1' style='width:50%; text-align:left; border-collapse: collapse;'>";
        echo "<tr>
                <th>Imagen</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th> 
              </tr>";
    
        // Recorremos los productos y los mostramos en la tabla
        while ($row = $consulta->fetch_array(MYSQLI_ASSOC)) {
            $producto_id = $row['id']; // ID del producto
    
            echo "<tr>";
            echo "<td><img src='../fotosProductos/" . htmlspecialchars($row['foto']) . "' alt='Foto del producto' style='width:100px;height:100px;'></td>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
            echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
            echo "<td>" . htmlspecialchars($row['precio']) . "€</td>";
            echo "<td>" . htmlspecialchars($cantidades[$producto_id]) . "</td>"; // Muestra la cantidad
            echo "</tr>";
        }
    
        // Cerramos la tabla
        echo "</table>";
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
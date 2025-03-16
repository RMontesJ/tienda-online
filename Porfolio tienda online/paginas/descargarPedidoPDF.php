<?php
require_once('../fpdf186/fpdf.php'); // Asegúrate de que la ruta es correcta
require_once "../BD/Datos.php";

$usuario = $_GET['id_user'];
$clase = new Datos;

// Obtener los datos
$correo = $clase->cogerCorreo($usuario);
$idProductosCarrito = $clase->cogerIdProductosCarrito($usuario);
$productos = $clase->obtenerProductosPorId($idProductosCarrito, $usuario);

// Verificar si el usuario está vacío
if (!isset($usuario) || $usuario == "") {
    header("Location: ../paginas/inicio_sesion.php");
    exit();
}

// Verificar si es admin
if (strpos($correo, "@admin.com") !== false) {
    header("Location: ../paginas/indexRegistrado.php?id_user=$usuario");
    exit();
}

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
?>

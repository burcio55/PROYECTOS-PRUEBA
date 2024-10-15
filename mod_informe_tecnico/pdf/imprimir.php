<?

include('based.php');

$id_imp = $_SESSION["id_imp"];

/* echo $id_imp; */

require 'pdf/fpdf/fpdf.php';

$cap = utf8_decode("ACTIVIDADES DE CAPACITACIÓN");
$pdf->Cell(95, 7, $cap, 0, 1, 'l');
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetX(15);
$pdf->Cell(95, 7, 'Nombre de la Actividad', 0, 1, 'l');

$pdf = new PDF();
$pdf->AddPage();

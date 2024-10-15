<?
include("bd.php");
$query = " SELECT personal.id_personal,
                                personal.primer_apellido as apellido1,
                                personal.segundo_apellido as apellido2,
                                personal.primer_nombre as nombre1,
                                personal.segundo_nombre as nombre2, 
                                personal.nacionalidad,
                                personal.cedula as cedula, 
                                 trabajador.codigo_nomina as cod_nom,
                                cargo.descripcion_cargo,
                                dependencia.nombre as nombre_dep
                                FROM trabajador
                                INNER JOIN personal on personal.id_personal = trabajador.id_personal
                                inner join cargo on trabajador.id_cargo = cargo.id_cargo
                                inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
                                WHERE personal.cedula='".$_SESSION['id_usuario']."' and estatus='A'
                                ";
$busqueda = pg_query($conn,$query);
while($row = pg_fetch_assoc($busqueda)){
    $nombres = $row['nombre1'] . " " . $row['nombre2'] . " " . $row['apellido1']. " " . $row['apellido2'];
    $identificacion = number_format($row['cedula'], 0, '', '.');
    $ubicacion_adm = $row['nombre_dep'];
    $ubicacion_fisica_actual = $row['ubicacion_fisica_actual'];
    $name = $row['nombre1'] . " " . $row['apellido1'];
/*     $cargo = $row['descripcion_cargo']; */
    $nomina = $row['cod_nom'];
    $scargo_actual_ejerce = $row['cargo_actual_ejerce'];
}

require('fpdf/fpdf.php');

class PDF extends FPDF {
    // Puedes agregar métodos personalizados aquí si es necesario
function Header(){
    /* // Logo
    $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20); */
    }
// Page footer
function Footer(){
   /*  $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,utf8_decode("Página ").$this->PageNo().'/{nb}',0,0,'C'); */
    }
}


$pdf = new PDF();
$pdf->AddPage();

$pdf->SetMargins(13, 10, 10); // Márgenes izquierdo, superior, derecho en milímetros

// Configurar tamaño de página
$pdf->SetAutoPageBreak(true, 10);

$anoter = 'img/cintillo-final3.jpg'; 
$pdf->Image($anoter, -25, 10, 225, 10);    

$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 10, utf8_decode('SOLICITUD DE PERMISO'), 1, 0, 'C');

$fechaActual = date('d/m/Y');
$pdf->SetFont('Arial', '', 8);

// Posicionar a la derecha
$pdf->SetX(-60); // Ajusta este valor según sea necesario

// Crear el cuadro
$pdf->Cell(50, 10, utf8_decode('Fecha de Elaboración: '.$fechaActual), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 7, utf8_decode('DATOS DEL FUNCIONARIO'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(132, 7, utf8_decode('Nombres y Apellidos:  '.$nombres), 1, 0, 'L');
$pdf->Cell(55, 7, utf8_decode('Cédula de Identidad: '.$identificacion), 1, 1, 'L');
$pdf->Cell(132, 7, utf8_decode('Cargo: '.$_REQUEST["cargo_titular"]), 1, 0, 'L');
$pdf->Cell(55, 7, utf8_decode('Cód. de Nómina: '.$nomina), 1, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
// Guardar la posición inicial $_REQUEST["adscrito"]
$x = $pdf->GetX();
$y = $pdf->GetY();

// Crear la primera celda
$pdf->Cell(0, 7, utf8_decode('Unidad Administrativa '), 1, 1, 'L');

// Guardar la posición después de la primera celda
$y_after_first_cell = $pdf->GetY();

// Crear el primer MultiCell
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 7, utf8_decode($ubicacion_adm), 1, 'L');

// Obtener la nueva posición después del primer MultiCell
$x = $pdf->GetX();
$y = $pdf->GetY();

// Crear la celda "Adscrito a" debajo del primer MultiCell
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 7, utf8_decode('Adscrito a '), 1, 1, 'L');

// Mover la posición para agregar el nuevo MultiCell debajo de la celda "Adscrito a:"
$pdf->SetXY($x, $y + 7); // Ajustar la posición Y

// Crear el nuevo MultiCell
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 7, utf8_decode(strtoupper($_REQUEST["adscrito"])), 1, 'L');





// Agregar el elemento adicional
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 7, utf8_decode('ESPECIFICACIONES DEL PERMISO'), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(127, 7, utf8_decode('Motivo '), 1, 0, 'L');
$pdf->Cell(40, 7, utf8_decode('Fecha Solicitada'), 1, 0, 'C');
$pdf->Cell(20, 7, utf8_decode('Duración'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);

// Guardar la posición actual
$x = $pdf->GetX();
$y = $pdf->GetY();

// Primera celda
$pdf->MultiCell(127, 7, utf8_decode(strtoupper($_REQUEST["motivo"])), 1, 'L');

// Obtener la altura del primer MultiCell
$multiCellHeight = $pdf->GetY() - $y;

// Volver a la posición inicial y mover a la derecha
$pdf->SetXY($x + 127, $y);

$fecha_recibida = $_REQUEST['fecha_inicio'];
$fecha_formateada1 = date('d/m/Y', strtotime($fecha_recibida));
$fecha_recibida2 = $_REQUEST['fecha_final'];
$fecha_formateada2 = date('d/m/Y', strtotime($fecha_recibida2));

// Celda "Desde"
$pdf->Cell(20, 3, utf8_decode('Desde'), 1, 0, 'C');
$pdf->SetXY($x + 127, $y + 3);
$pdf->MultiCell(20, $multiCellHeight - 3, utf8_decode($fecha_formateada1), 1, 'C');

// Volver a la posición inicial y mover a la derecha
$pdf->SetXY($x + 147, $y);

// Celda "Hasta"
$pdf->Cell(20, 3, utf8_decode('Hasta'), 1, 0, 'C');
$pdf->SetXY($x + 147, $y + 3);
$pdf->MultiCell(20, $multiCellHeight - 3, utf8_decode($fecha_formateada2), 1, 'C');

// Volver a la posición inicial y mover a la derecha
$pdf->SetXY($x + 167, $y);
$pdf->MultiCell(20, $multiCellHeight, utf8_decode($_REQUEST["duracion"]), 1, 'C');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 7, utf8_decode('Soporte Legal'), 1, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 8, utf8_decode(strtoupper($_REQUEST["soporte_legal"])), 1, 'L');

// Guardar la posición inicial
$posXInicial = $pdf->GetX();
$posYInicial = $pdf->GetY();

$maxHeight = 11; // Ajusta este valor según sea necesario

// Imprimir el primer MultiCell
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(60, $maxHeight, utf8_decode("Solicitado"), 1, 'C');

// Volver a la posición inicial y ajustar la posición Y
$pdf->SetXY($posXInicial, $posYInicial + $maxHeight); // Ajustar el valor según sea necesario

// Imprimir el segundo MultiCell
$pdf->SetFont('Arial', '', 8); // Volver a la fuente normal
$pdf->MultiCell(60, $maxHeight, utf8_decode("\n\n". $name ."\nFuncionario"), 1, 'C');

// Establecer la posición para el segundo MultiCell
$pdf->SetXY($posXInicial + 60, $posYInicial);

// Imprimir el segundo MultiCell
$pdf->SetFont('Arial', 'B', 8); // Cambiar a negrita
$pdf->MultiCell(65, $maxHeight, utf8_decode("Autorizado"), 1, 'C');

// Volver a la posición inicial y ajustar la posición Y
$pdf->SetXY($posXInicial + 60, $posYInicial + $maxHeight); // Ajustar el valor según sea necesario

// Imprimir el texto del segundo MultiCell
$pdf->SetFont('Arial', '', 8); // Volver a la fuente normal
$pdf->MultiCell(65, $maxHeight, utf8_decode("\n\n". $_REQUEST["jefe_inmediato"]. "\nJefe(a) Inmediato"), 1, 'C');

// Establecer la posición para el tercer MultiCell
$pdf->SetXY($posXInicial + 125, $posYInicial);

// Imprimir el tercer MultiCell
$pdf->SetFont('Arial', 'B', 8); // Cambiar a negrita
$pdf->MultiCell(62, $maxHeight, utf8_decode("Conformado"), 1, 'C');

// Volver a la posición inicial y ajustar la posición Y
$pdf->SetXY($posXInicial + 125, $posYInicial + $maxHeight); // Ajustar el valor según sea necesario

// Imprimir el texto del tercer MultiCell
$pdf->SetFont('Arial', '', 8); // Volver a la fuente normal
$pdf->MultiCell(62, $maxHeight, utf8_decode("\n\n". $_REQUEST["director"]. "\nDirector(a)"), 1, 'C');
 

$pdf->Output();

?>
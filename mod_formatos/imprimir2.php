<?
include("bd.php");

$resy = " SELECT personal.id_personal,
                                personal.primer_apellido as apellido1,
                                personal.segundo_apellido as apellido2,
                                personal.primer_nombre as nombre1,
                                personal.segundo_nombre as nombre2, 
                                personal.nacionalidad,
                                personal.sexo,
                                personal.cedula as cedula, 
                                trabajador.fecha_ingreso,
                                trabajador.codigo_nomina as cod_nom,
                                cargo.descripcion_cargo,
                                dependencia.nombre as nombre_dep
                                FROM trabajador
                                INNER JOIN personal on personal.id_personal = trabajador.id_personal
                                inner join cargo on trabajador.id_cargo = cargo.id_cargo
                                inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
                                WHERE personal.cedula='".$_SESSION['id_usuario']."' and estatus='A' 
                    ";
$SQL = pg_query($conn, $resy);

if ($row = pg_fetch_array($SQL, NULL, PGSQL_ASSOC)) {
        
        $nombres = $row['apellido1'] . " " . $row['apellido2'] . " " . $row['nombre1']. " " . $row['nombre2'];

        $names = $row['apellido1'] . " " .  $row['nombre1'];

        $identificacion = number_format($row['cedula'], 0, '', '.');

        $ubicacion_adm = $row['nombre_dep'];

        $ubicacion_fisica_actual = $row['ubicacion_fisica_actual'];

        $cargo = $row['descripcion_cargo'];

        $nomina = $row['cod_nom'];
        
        $fecha = $row['fecha_ingreso'];
        $fecha_formateada = date('d/m/Y', strtotime($fecha));

        $fechaActual = date('Y');

        $fecha2 = str_split($fecha, 4);
        $fecha3 = $fecha2[0];

        $diferencia =  $fechaActual - $fecha3;
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
        /* $this->SetY(-15); */
        // Arial italic 8
       /*  $this->SetFont('Arial','I',8); */
        // Page number
       /*  $this->Cell(0,10,utf8_decode("Página ").$this->PageNo().'/{nb}',0,0,'C'); */
        }
    }

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetMargins(12, 10, 10); // Márgenes izquierdo, superior, derecho en milímetros

// Configurar tamaño de página
$pdf->SetAutoPageBreak(true, 10);

$anoter = 'img/cintillo-final3.jpg'; 
    
$pdf->Image($anoter, -25, 10, 225, 10);  
$pdf->Ln(17);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 8, utf8_decode('SOLICITUD DE VACACIONES'), 1, 0, 'C');

$fechaActual = date('d/m/Y');
$pdf->SetFont('Arial', '', 9);

// Posicionar a la derecha
$pdf->SetX(-55); // Ajusta este valor según sea necesario

// Crear el cuadro
$pdf->Cell(45, 8, utf8_decode('Fecha de Solicitud: '.$fechaActual), 1, 1, 'C');

$posX = $pdf->GetX();
$posY = $pdf->GetY();
$pdf->MultiCell(138, 7, utf8_decode('Apellidos y Nombres del trabajador (a): '.$nombres), 1, 'L');
$altura_multi_cell = $pdf->GetY() - $posY;

// Volver a la posición original X
$pdf->SetXY($posX + 138, $posY);

$pdf->Cell(50, $altura_multi_cell, utf8_decode('Cédula de Identidad: '.$identificacion), 1, 1, 'L');

$posX = $pdf->GetX();
$posY = $pdf->GetY();

// Crear la MultiCell
$pdf->MultiCell(138, 5, utf8_decode('Denominación del Cargo o puesto del trabajo: '.$_REQUEST['cargo_titular']), 1, 'L');

// Guardar la nueva posición Y
$altura_multi_cell = $pdf->GetY() - $posY;

// Volver a la posición original X
$pdf->SetXY($posX + 138, $posY);

// Crear la celda con la misma altura
$pdf->Cell(50, $altura_multi_cell, utf8_decode('Código de Nómina: '.$nomina), 1, 1, 'L');
$pdf->MultiCell(0, 8, utf8_decode('Correo electrónico del trabajador (a): '.strtoupper($_REQUEST['gmail'])), 1, 'L');

$pdf->SetFont('Arial', '', 9);

$x = $pdf->GetX();
$y = $pdf->GetY();

// Crear la primera celda
$pdf->SetFont('Arial', '', 9);

$x = $pdf->GetX();
$y = $pdf->GetY();

// Primera celda
$pdf->Cell(69, 7, utf8_decode('Unidad Administrativa en la que presta servicio'), 1, 0, 'L');

// Guardar la posición después de la primera celda
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();

// Segunda celda con MultiCell
$pdf->SetXY($x2, $y2);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(119, 7, utf8_decode($ubicacion_adm), 1, 'L');

// Calcular la altura máxima entre ambas celdas
$height = max($pdf->GetY() - $y, 7);

// Volver a la posición original y dibujar la primera celda con la altura máxima
$pdf->SetXY($x, $y);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(69, $height, utf8_decode('Unidad Administrativa en la que presta servicio'), 1, 0, 'L');

// Dibujar la segunda celda con la altura máxima
$pdf->SetXY($x2, $y2);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(119, $height, utf8_decode($ubicacion_adm), 1, 'L');

// Mover a la siguiente línea
$pdf->SetXY($x, $y + $height);

// Guardar la posición después de la primera celda
$y_after_first_cell = $pdf->GetY();

// Crear el primer MultiCell
$pdf->SetFont('Arial', '', 9);
/* $pdf->MultiCell(0, 7, utf8_decode($ubicacion_adm), 1, 'L'); */


$posYInicial = $pdf->GetY();

$pdf->MultiCell(31, 5, utf8_decode('Fecha de Ingreso al Ministerio'), 1, 'C');
$pdf->SetXY($pdf->GetX() + 31, $posYInicial);
$pdf->MultiCell(27, 5, utf8_decode('Años de servicio en el Ministerio'), 1, 'C');
$pdf->SetXY($pdf->GetX() + 58, $posYInicial);
$pdf->MultiCell(34, 5, utf8_decode('Años de Servicio en la APN'), 1, 'C');
$pdf->SetXY($pdf->GetX() + 92, $posYInicial);
$pdf->SetFont('Arial', '', 8.3);
$pdf->MultiCell(30, 5, utf8_decode('Total Años en la APN (Ministerio + APN)'), 1, 'C');
$pdf->SetXY($pdf->GetX() + 122, $posYInicial);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(33, 5, utf8_decode('Periodo(s) Vacacional solicitado'), 1, 'C');
$pdf->SetXY($pdf->GetX() + 155, $posYInicial);
$pdf->MultiCell(33, 5, utf8_decode('Fecha efectiva de salida para el disfrute'), 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(31, 16, utf8_decode($fecha_formateada), 1, 0, 'C');
$pdf->Cell(27, 16, utf8_decode($diferencia." años"), 1, 0, 'C');
$pdf->Cell(34, 16, utf8_decode($_REQUEST['antiguedad_apn']." años"), 1, 0, 'C');
$pdf->Cell(30, 16, utf8_decode($_REQUEST['antiguedad_apn_final']." años"), 1, 0, 'C');

$fechas = array_map('trim', explode(',', $_REQUEST['lapso_vacacional']));

// Eliminar los guiones y separar las fechas
$fechas_procesadas = [];
foreach ($fechas as $fecha) {
    if (empty($fecha) || $fecha == '2012') {
        // Si la fecha está vacía o es "2012", agregar un marcador de posición
        $fechas_procesadas[] = ' ';
    } else {
        $partes = explode('-', $fecha);
        foreach ($partes as $parte) {
            $fechas_procesadas[] = trim($parte);
        }
    }
}

// Coordenadas iniciales
$x = $pdf->GetX();
$y = $pdf->GetY();

// Contador para controlar la posición
$contador = 0;

// Asegurarse de que siempre haya al menos 4 elementos
while (count($fechas_procesadas) < 4) {
    $fechas_procesadas[] = ' ';
}

foreach ($fechas_procesadas as $fecha) {
    // Imprimir la fecha en la celda correspondiente
    $pdf->Cell(16.5, 8, utf8_decode($fecha), 1, 0, 'C');

    // Mover a la siguiente celda en la fila
    $contador++;
    if ($contador % 2 == 0) {
        // Mover hacia abajo para la siguiente fila
        $y += 8;
        $pdf->SetXY($x, $y);
    } else {
        // Mover a la siguiente celda en la misma fila
        $pdf->SetX($x + 16.5);
    }
}

// Restablecer la posición X para la siguiente fila
$pdf->SetX($x);

// Ajustar la posición para la celda al lado derecho
$fecha_recibida = $_REQUEST['fecha_deseada'];
$fecha_formateada2 = date('d/m/Y', strtotime($fecha_recibida));

// Calcular la posición correcta para la celda al lado derecho
$y_final = $y - 8 * (int)(($contador + 1) / 2);
$pdf->SetXY($x + 33, $y_final);
$pdf->Cell(33, 16, utf8_decode($fecha_formateada2), 1, 1, 'C');

 $pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, utf8_decode('FIRMAS'), 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);

$x = $pdf->GetX();
$y = $pdf->GetY(); 

$maxHeight = 11;

// Dibujar la primera celda con MultiCell
$pdf->MultiCell(44, $maxHeight, utf8_decode("\n\n\n". $names), 1, 'C');

// Dibujar la línea debajo de $names
$pdf->Line($x, $pdf->GetY(), $x + 42, $pdf->GetY());

// Añadir el texto "Trabajador (a)" debajo de la línea
$pdf->SetXY($x, $pdf->GetY());
$pdf->MultiCell(44, $maxHeight, utf8_decode("Trabajador (a)"), 1, 'C');

// Volver a la posición inicial y mover a la derecha
$pdf->SetXY($x + 44, $y);

// Dibujar la segunda celda
$pdf->MultiCell(57, $maxHeight, utf8_decode("\n\n\n". $_REQUEST['jefe_inmediato']), 1, 'C');

// Dibujar la línea debajo de $_REQUEST['jefe_inmediato']
$pdf->Line($x + 44, $pdf->GetY(), $x + 101, $pdf->GetY());

// Añadir el texto "Jefe (a) Inmediato" debajo de la línea
$pdf->SetXY($x + 44, $pdf->GetY());
$pdf->MultiCell(57, $maxHeight, utf8_decode("Jefe(a) Inmediato"), 1, 'C');

// Dibujar la tercera celda
$pdf->SetXY($x + 101, $y);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(55, $maxHeight, utf8_decode("\n\n\n". $_REQUEST['director']."\n"), 1, 'C');

// Dibujar la línea debajo de $_REQUEST['director']
$pdf->Line($x + 101, $pdf->GetY(), $x + 156, $pdf->GetY());

// Añadir el texto "Director(a) Gral./ Director(a) Estadal" debajo de la línea
$pdf->SetXY($x + 101, $pdf->GetY());
$pdf->MultiCell(55, $maxHeight, utf8_decode("Director(a) Gral. /Director(a) Estadal"), 1, 'C');

// Dibujar la cuarta celda
$pdf->SetXY($x + 156, $y);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(32, 5, utf8_decode("\n\n\n\n\n". "Sello de la Dirección General o Estadal" ."\n\n\n\n\n"), 1, 'C');

 $pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 7, utf8_decode('PARA USO DE LA OFICINA DE GESTIÓN HUMANA'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20, 7, utf8_decode('Periodo'), 1, 0, 'C'); // El último parámetro debe ser 0 para que no haya salto de línea
$pdf->SetXY($pdf->GetX(), $pdf->GetY()); // Ajusta la posición X e Y
$pdf->MultiCell(37, 7, utf8_decode('Fecha efectiva de salida'), 1, 'C');
$pdf->SetXY($pdf->GetX() + 57, $pdf->GetY() - 7);

$pdf->Cell(45, 7, utf8_decode('Fecha efectiva de culminación'), 1, 0, 'C');
$pdf->Cell(40, 7, utf8_decode('Fecha efectiva de regreso'), 1, 0, 'C');
$pdf->Cell(46, 7, utf8_decode('Total días hábiles a disfrutar'), 1, 1, 'C');

$pdf->Cell(20, 6, utf8_decode('1)'), 1, 0, 'C');
$pdf->Cell(37, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(40, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(46, 6, utf8_decode(''), 1, 1, 'C');

$pdf->Cell(20, 6, utf8_decode('2)'), 1, 0, 'C');
$pdf->Cell(37, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(40, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(46, 6, utf8_decode(''), 1, 1, 'C');

$pdf->Cell(20, 6, utf8_decode('3)'), 1, 0, 'C');
$pdf->Cell(37, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(40, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(46, 6, utf8_decode(''), 1, 1, 'C');


$pdf->Cell(20, 6, utf8_decode('4)'), 1, 0, 'C');
$pdf->Cell(37, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(40, 6, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(46, 6, utf8_decode(''), 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 5, utf8_decode("Observaciones:\n\n\n"), 1, 'L');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 8, utf8_decode('Realizado y verificado por el analista en la Oficina de Gestión Humana'), 1, 1, 'C');

// Primera fila de datos
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 5, utf8_decode('Nombres y Apellidos:'), 1, 0, 'L');
$pdf->Cell(45, 5, utf8_decode('Fecha:'), 1, 0, 'L');
$pdf->Cell(47, 5, utf8_decode('Firma:'), 1, 1, 'L');
$pdf->Cell(50, 5, utf8_decode(''), 1, 0, 'L');
$pdf->Cell(45, 5, utf8_decode(''), 1, 0, 'L');
$pdf->Cell(47, 5, utf8_decode(''), 1, 1, 'L');

// Segunda fila de datos
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(142, 6, utf8_decode('Conformado por el Jefe(a) de la División de Registro y Control'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(51, 5, utf8_decode('Nombres y Apellidos:'), 1, 0, 'L');
$pdf->Cell(45, 5, utf8_decode('Fecha:'), 1, 0, 'L');
$pdf->Cell(46, 5, utf8_decode('Firma:'), 1, 1, 'L');
$pdf->Cell(51, 5, utf8_decode(''), 1, 0, 'L');
$pdf->Cell(45, 5, utf8_decode(''), 1, 0, 'L');
$pdf->Cell(46, 5, utf8_decode(''), 1, 1, 'L');

// Tercera fila de datos
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(142, 6, utf8_decode('Conformado por el Director(a) General de la Oficina de Gestión Humana'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(51, 5, utf8_decode('Nombres y Apellidos:'), 1, 0, 'L');
$pdf->Cell(45, 5, utf8_decode('Fecha:'), 1, 0, 'L');
$pdf->Cell(46, 5, utf8_decode('Firma:'), 1, 1, 'L');
$pdf->Cell(51, 5, utf8_decode(''), 1, 0, 'L');
$pdf->Cell(45, 5, utf8_decode(''), 1, 0, 'L');
$pdf->Cell(46, 5, utf8_decode(''), 1, 0, 'L');

// Ajuste de posición y creación de MultiCell
$y = $pdf->GetY();
$pdf->SetXY($pdf->GetX(), $y - 37);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(46, 4.2, utf8_decode("\n\n\n\n\n". 'Sello de la Oficina de Gestión Humana'."\n\n\n\n"), 1, 'C');

// Nota final
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 4.1, utf8_decode('Nota: '. "\n". '- En caso de existir cambio del Jefe Inmediato, la fecha de salida de vacaciones deberá ser autorizada por el nuevo Jefe(a) inmediato.'."\n". '- Para la solicitud de vacaciones debe remitir dos (2) copias de este formulario a la Oficina de Gestión Humana, con mínimo un mes antes del inicio de las mismas.'), 1, 'L'); 
  
 
$pdf->Output();

?>
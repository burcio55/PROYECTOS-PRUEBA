<?
    require 'fpdf/fpdf.php';

    class PDF extends FPDF{
        function Header()
        {
            $this -> Image('../imagenes/fondo_snirlpd.png', 0, 0, 300, 400);
            $this -> Image('../imagenes/cintillo-a-medida.png', 15, 15, 200, 15);
            

            $this -> Ln(55);
        }
    } 

    $pdf = new PDF();
    $pdf -> AddPage();

    
    $pdf -> SetFont('Arial', 'B', '11');
    $titulo = utf8_decode("CERTIFICADO DE REGISTRO");
    $pdf -> MultiCell(190, 6, $titulo, 0, 'C', 0);
    $titulo2 = utf8_decode("SISTEMA NACIONAL DE INSERCIÓN Y REINSERCIÓN LABORAL DE PERSONAS CON DISCAPACIDAD
(SNIRLPCD)");
    $pdf -> SetFont('Arial', 'B', '10');
    $pdf -> MultiCell(190, 6, $titulo2, 0, 'C', 0);
    $pdf -> Ln(10);
    $t1 = utf8_decode("nómina");
    $t2 = utf8_decode("DECLARO");
    $t3 = utf8_decode("__________________");
    $pdf -> SetFont('Arial', '', '10');
    $pdf -> SetX(15);
    $texto = utf8_decode("El Ministerio del Poder Popular para el Proceso Social de Trabajo, conforme a lo establecido en el artículo 28 de la Ley para Personas con Discapacidad así como, el artículo 290 de las atribuciones consagradas en la Ley Orgánica del Trabajo, las Trabajadoras y los Trabajadores (LOTTT),  donde quedó establecido que todo patrono esta obligado a incorporar por lo menos el cinco por ciento (5%) de su ".$t1." total a trabajadores y trabajadoras con Discapacidad, en labores consonas con sus destrezas y habilidades, previa constatación de que ha cumplido con el requisito, ".$pdf->SetFont('Arial', 'B', 10).$t2.$pdf->SetFont('Arial', '', 10)." legalmente que el (la) ciudadano (a) ".$pdf->SetFont('Arial', 'B', 10).$t3.$pdf->SetFont('Arial', '', 10).", titular de la  cédula de identidad Nro.".$pdf->SetFont('Arial', 'B', 10).$t3.$pdf->SetFont('Arial', '', 10).", de Ocupación ".$pdf->SetFont('Arial', 'B', 10).$t3.$pdf->SetFont('Arial', '', 10).", con residencia ubicada en el estado ".$pdf->SetFont('Arial', 'B', 10).$t3.$pdf->SetFont('Arial', '', 10)." municipio ".$pdf->SetFont('Arial', 'B', 10).$t3.$pdf->SetFont('Arial', '', 10)." de la parroquia ".$pdf->SetFont('Arial', 'B', 10).$t3.$pdf->SetFont('Arial', '', 10)." se encuentra registrado (a) en el Sistema Nacional de Inserción y Reinserción Laboral para Personas con Discapacidad (SNIRLPCD).");
    $pdf -> MultiCell(180,5,$texto);
    $pdf -> SetFont('Arial', 'B', '10');
    $pdf -> Ln(10);
    $pdf -> MultiCell(190, 6, $texto2, 0, 'C');
    $pdf -> Image('../imagenes/QR.png', 150, 15, 38, 38); // Imagen del Código QR
    /* $pdf -> Cell(95, 10, 'Otras Actividades de Capacitacion', 0, 1, 'l');
    $pdf -> SetFont('Arial', '', '14');
    $pdf -> Cell(95, 10, 'Titulo Obtenido', 0, 0, 'l');
    $pdf -> Cell(95, 10, 'Nombre del Curso', 0, 1, 'l');
    $pdf -> Cell(95, 10, 'Nombre de la Institucion', 0, 0, 'l');
    $pdf -> Cell(95, 10, 'Nombre de la Institucion', 0, 1, 'l');
    $pdf -> Cell(95, 10, 'Anio de Graduado', 0, 0, 'l');
    $pdf -> Cell(95, 10, 'Duracion', 0, 1, 'l');
    
    $pdf -> Ln(10);

    $pdf -> SetFont('Arial', 'B', '14');
    $pdf -> Cell(95, 10, 'Experiencia Laboral', 0, 0, 'l');
    $pdf -> Cell(95, 10, 'Otros Conocimientos', 0, 1, 'l');
    $pdf -> SetFont('Arial', '', '14');
    $pdf -> Cell(95, 10, 'Nombre de la Empresa', 0, 0, 'l');
    $pdf -> Cell(95, 10, 'Herramientas de Computacion + Nivel', 0, 1, 'l');
    $pdf -> Cell(95, 10, 'Sector al que Pertenece', 0, 0, 'l');
    $pdf -> Cell(95, 10, 'Manejo de otro Idioma + Nivel', 0, 1, 'l');
    $pdf -> Cell(95, 10, 'Si es Propia o Ajena', 0, 1, 'l');
    $pdf -> Cell(95, 10, 'Fecha Ingreso', 0, 1, 'l');
    $pdf -> Cell(95, 10, 'Fecha Egreso', 0, 1, 'l');
    $pdf -> Cell(95, 10, 'Ocupacion', 0, 1, 'l');

    $pdf -> Ln(10);

    $pdf -> SetFont('Arial', 'B', '14');
    $pdf -> Cell(180, 10, 'Habilidades y Destrezas', 0, 1, 'l');
    $pdf -> SetFont('Arial', '', '14');
    $pdf -> Cell(180, 10, 'Habilidades y Destrezas que manifiesta el usuario en su registro anterios', 0, 0, 'l'); */

    //$pdf->Output('Certificado_Registro.pdf', 'D');
    $pdf->Output('Certificado_Registro.pdf', 'I');
?>
<?

// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();
include('../include/BD.php');
$conn2 = Conexion::ConexionBD();
/* 
require_once("minpptrassi/js/phpqecode/phpqrcode.php"); */

//CONEXION CON SNIRLPCD

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $cedula = substr($_SESSION["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);


    $persona_id = $persona["id"];

    $sexo = $persona["ssexo"];

    $name = strtoupper($persona["sprimer_nombre"]);
    $name .= " ";
    $name .= strtoupper($persona["ssegundo_nombre"]);
    $name .= " ";
    $name .= strtoupper($persona["sprimer_apellido"]);
    $name .= " ";
    $name .= strtoupper($persona["ssegundo_apellido"]);
    $ncedula = number_format($persona["ncedula"], 0, ",", ".");

    $sql = "SELECT";
    $sql .= " persona.ncedula as cedula,";
    $sql .= " persona.snacionalidad as nacionalidad,";
    $sql .= " persona.sprimer_apellido as apellido1,";
    $sql .= " persona.ssegundo_apellido as apellido2,";
    $sql .= " persona.sprimer_nombre as nombre1,";
    $sql .= " persona.ssegundo_nombre as nombre2,";
    $sql .= " public.entidad.scapital as ciudad_descripcion,";
    $sql .= " public.municipio.sdescripcion as municipio_descripcion,";
    $sql .= " public.parroquia.sdescripcion as parroquia_descripcion";
    $sql .= " FROM snirlpcd.persona";
    $sql .= " LEFT JOIN public.entidad ON entidad.nentidad=persona.nentidad_residencia_id";
    $sql .= " LEFT JOIN public.municipio ON municipio.nmunicipio=persona.nmunicipio_residencia_id";
    $sql .= " LEFT JOIN public.parroquia ON parroquia.nparroquia=persona.nparroquia_residencia_id";
    $sql .= " where persona.id ='$persona_id'";

    $row = pg_query($conn, $sql);
    $persona2 = pg_fetch_assoc($row);

    $nacionalidad = strtoupper($persona2["nacionalidad"]);
    $ciudad_descripcion = strtoupper($persona2["ciudad_descripcion"]);
    $municipio_descripcion = strtoupper($persona2["municipio_descripcion"]);
    $parroquia_descripcion = strtoupper($persona2["parroquia_descripcion"]);

    /* $nombre_arc = $persona["id"];
    $nombre_arc .= $persona["sprimer_nombre"];
    $nombre_arc .= $persona["sprimer_apellido"];
    $nombre_arc .= $cedula;
    $nombre_arc .= rand(1, 10000000);

    $nombre_arc_new = str_replace(" ", "_", $nombre_arc); */
    $dia = date('d');
    $mes = date('m');
    $ayo = date('Y');

    // Validar mes
    if ($mes == 1) {
        $mes = "enero";
    } else
    if ($mes == 2) {
        $mes = "febrero";
    } else
    if ($mes == 3) {
        $mes = "marzo";
    } else
    if ($mes == 4) {
        $mes = "abril";
    } else
    if ($mes == 5) {
        $mes = "mayo";
    } else
    if ($mes == 6) {
        $mes = "junio";
    } else
    if ($mes == 7) {
        $mes = "julio";
    } else
    if ($mes == 8) {
        $mes = "agosto";
    } else
    if ($mes == 9) {
        $mes = "septiembre";
    } else
    if ($mes == 10) {
        $mes = "octubre";
    } else
    if ($mes == 11) {
        $mes = "noviembre";
    } else {
        $mes = "diciembre";
    }
}

require 'fpdf/fpdf.php';
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../imagenes/fondo_snirlpd.png', 0, 0, 300, 400);
        $this->Image('../imagenes/cintillo-a-medida.png', 15, 15, 200, 15);

        $this->Ln(55);
    }
}

$pdf = new PDF();
$pdf->AddPage();

$tbl = '
<html>
<head>
    <title> CERTIFICADO DE REGISTRO </title>
</head>
<body>
    <center>
        <h1>
            <b> CERTIFICADO DE REGISTRO </b>
        </h1>
    </center>
</body>
</html>
';

$pdf->SetFont('Arial', 'B', '11');
$titulo = utf8_decode("CERTIFICADO DE REGISTRO");
$pdf->writeHTML('CERTIFICADO DE REGISTRO', true, false, false, false, '');
/* $pdf->MultiCell(190, 6, $tbl, 0, 'C', 0); */
$titulo2 = utf8_decode("SISTEMA NACIONAL DE INSERCIÓN Y REINSERCIÓN LABORAL DE PERSONAS CON DISCAPACIDAD
(SNIRLPCD)");
$pdf->SetFont('Arial', 'B', '10');
$pdf->MultiCell(190, 6, $titulo2, 0, 'C', 0);
$pdf->Ln(18);
$t1 = utf8_decode("nómina");
$t2 = utf8_decode("DECLARO");
$t3 = utf8_decode("__________________");
$pdf->SetFont('Arial', '', '10');
$pdf->SetX(15);
if ($sexo == '1') {
    $texto = utf8_decode("El Ministerio del Poder Popular para el Proceso Social de Trabajo, conforme a lo establecido en el artículo 28 de la Ley para Personas con Discapacidad así como, el artículo 290 de las atribuciones consagradas en la Ley Orgánica del Trabajo, las Trabajadoras y los Trabajadores (LOTTT), donde quedó establecido que todo patrono esta obligado a incorporar por lo menos el cinco porciento (5%) de su nómina total a trabajadores y trabajadoras con discapacidad, en labores consonas con sus destrezas y habilidades, previa constatación de que ha cumplido con el requisito, " . $pdf->SetFont('Arial', 'B', 10) . $t2 . $pdf->SetFont('Arial', '', 10) . " legalmente que el (la) ciudadano (a) " . $name . ", titular de la  cédula de identidad." . $nacionalidad . ".-" . $ncedula . ", con residencia ubicada en el estado " . $ciudad_descripcion . " municipio " . $municipio_descripcion . " de la parroquia " . $parroquia_descripcion . " se encuentra registrado (a) en el Sistema Nacional de Inserción y Reinserción Laboral para Personas con Discapacidad (SNIRLPCD).");
} else {
    $texto = utf8_decode("El Ministerio del Poder Popular para el Proceso Social de Trabajo, conforme a lo establecido en el artículo 28 de la Ley para Personas con Discapacidad así como, el artículo 290 de las atribuciones consagradas en la Ley Orgánica del Trabajo, las Trabajadoras y los Trabajadores (LOTTT), donde quedó establecido que todo patrono esta obligado a incorporar por lo menos el cinco porciento (5%) de su nómina total a trabajadores y trabajadoras con discapacidad, en labores consonas con sus destrezas y habilidades, previa constatación de que ha cumplido con el requisito, " . $pdf->SetFont('Arial', 'B', 10) . $t2 . $pdf->SetFont('Arial', '', 10) . " legalmente que el (la) ciudadano (a) " . $name . ", titular de la  cédula de identidad." . $nacionalidad . ".-" . $ncedula . ", con residencia ubicada en el estado " . $ciudad_descripcion . " municipio " . $municipio_descripcion . " de la parroquia " . $parroquia_descripcion . " se encuentra registrado (a) en el Sistema Nacional de Inserción y Reinserción Laboral para Personas con Discapacidad (SNIRLPCD).");
}
$pdf->MultiCell(180, 5, $texto);
$pdf->Ln(10);
$pdf->SetFont('Arial', '', '11');
if ($día == 1) {
    $texto2 = utf8_decode("Constancia que se expide en Caracas el primer día de " . $mes . " del " . $ayo);
} else {
    $texto2 = utf8_decode("Constancia que se expide en Caracas a los " . $dia . " días del mes de " . $mes . " del " . $ayo);
}
$pdf->MultiCell(180, 5, $texto2, 0, 'C', 0);

$url = "http://172.17.1.3/snirlpcd/";
/* $qr = QRcode::png($url, "ImagenQR"); */

$pdf->Image('../imagenes/QR.png', 150, 15, 38, 38); // Imagen del Código QR
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
    $pdf -> Cell(95, 10, 'ocupacion', 0, 1, 'l');

    $pdf -> Ln(10);

    $pdf -> SetFont('Arial', 'B', '14');
    $pdf -> Cell(180, 10, 'Habilidades y Destrezas', 0, 1, 'l');
    $pdf -> SetFont('Arial', '', '14');
    $pdf -> Cell(180, 10, 'Habilidades y Destrezas que manifiesta el usuario en su registro anterios', 0, 0, 'l'); */

//$pdf->Output('Certificado_Registro.pdf', 'D');
$pdf->Output('Certificado_Registro.pdf', 'I');

<?php

require('based.php');


$tecnico = $_SESSION['id_usuario'];



if (isset($_GET['reporte'])) {
    $_SESSION['snro_reporte'] = htmlspecialchars($_GET['reporte']);
    $snro_reporte = $_SESSION['snro_reporte'];
    /* echo "La variable de sesión 'snro_reporte' se ha establecido con el valor: " . $snro_reporte; */
} else {
    echo "No se ha recibido ningún número de reporte.";
    die();
}

$diferrent = " SELECT
reporte_tecnico.reportes_fallas.id AS id_reporte,
personales_id,
dispositivos_id,
snombre_dispositivo,
sdisco_duro,
smemoria_ram,
dispositivos.sdescripcion AS tipo_disp,
nnumero_requer_glpi,
ubicacion_administrativa_scodigo,
public.ubicacion_administrativa.scodigo as codigo,
ubicacion_administrativa.sdescripcion as descripcion,
marca_id,
marca.sdescripcion As marca,
smodelo,
nbien_publico,
reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,
sobservaciones_tecnico,
srecomendaciones_tecnico as recomendaciones,
sserial,
estatus_id,
estatus.sdescripcion As estatus,
estatus_final,
reporte_tecnico.reportes_fallas.nusuario_creacion,
motivo_desincorporacion,
reporte_tecnico.reportes_fallas.snro_reporte,
simagen,
reporte_tecnico.reportes_fallas.dfecha_creacion
FROM
reporte_tecnico.reportes_fallas
inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id
inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id
inner Join public.ubicacion_administrativa on  ubicacion_administrativa.scodigo = reportes_fallas.ubicacion_administrativa_scodigo

inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id
where reportes_fallas.benabled='TRUE'  AND reportes_fallas.snro_reporte = '$snro_reporte' 
AND
reportes_fallas.snro_reporte is not null
AND
reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'
AND
cod_estatus = '1'; 
 ";


$resalt = " SELECT distinct 
reporte_tecnico.reportes_fallas.id AS id_reporte,
personales_id,
dispositivos_id,
snombre_dispositivo,
sdisco_duro,
smemoria_ram,
dispositivos.sdescripcion AS tipo_disp,
nnumero_requer_glpi,
ubicacion_administrativa_scodigo,
public.ubicacion_administrativa.scodigo as codigo,
ubicacion_administrativa.sdescripcion as descripcion,
marca_id,
marca.sdescripcion As marca,
smodelo,
nbien_publico,
reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,
sobservaciones_tecnico,
srecomendaciones_tecnico as recomendaciones,
sserial,
estatus_id,
estatus.sdescripcion As estatus,
estatus_final,
reporte_tecnico.reportes_fallas.nusuario_creacion,
motivo_desincorporacion,
reporte_tecnico.reportes_fallas.snro_reporte,
simagen,
reporte_tecnico.reportes_fallas.dfecha_creacion
FROM
reporte_tecnico.reportes_fallas
inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id
inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id
inner Join public.ubicacion_administrativa on  ubicacion_administrativa.scodigo = reportes_fallas.ubicacion_administrativa_scodigo

inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id
where reportes_fallas.benabled='TRUE'  AND reportes_fallas.snro_reporte = '$snro_reporte'
AND
reportes_fallas.snro_reporte is not null
AND
reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'
AND
cod_estatus = '1'
order by dispositivos_id;
 ";

$demo = " SELECT distinct 
reporte_tecnico.reportes_fallas.id AS id_reporte,
personales_id,
dispositivos_id,
snombre_dispositivo,
sdisco_duro,
smemoria_ram,
dispositivos.sdescripcion AS tipo_disp,
nnumero_requer_glpi,
ubicacion_administrativa_scodigo,
public.ubicacion_administrativa.scodigo as codigo,
ubicacion_administrativa.sdescripcion as descripcion,
marca_id,
marca.sdescripcion As marca,
smodelo,
nbien_publico,
reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,
sobservaciones_tecnico,
srecomendaciones_tecnico as recomendaciones,
sserial,
estatus_id,
estatus.sdescripcion As estatus,
estatus_final,
reporte_tecnico.reportes_fallas.nusuario_creacion,
motivo_desincorporacion,
reporte_tecnico.reportes_fallas.snro_reporte,
simagen,
reporte_tecnico.reportes_fallas.dfecha_creacion
FROM
reporte_tecnico.reportes_fallas
inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id
inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id
inner Join public.ubicacion_administrativa on  ubicacion_administrativa.scodigo = reportes_fallas.ubicacion_administrativa_scodigo

inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id
where reportes_fallas.benabled='TRUE'  AND reportes_fallas.snro_reporte = '$snro_reporte' AND reportes_fallas.sserial = '$num_informe' AND  reportes_fallas.nbien_publico = '$num_bpublico' 
AND
reportes_fallas.snro_reporte is not null
AND
reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'
AND
cod_estatus = '1'
order by dispositivos_id;

 ";

$limit = pg_query($conn, $demo);
while($frech = pg_fetch_assoc($limit)){

    $ubicacion = $persona['descripcion'];
    $tipo_dispositivo = $persona['tipo_disp'];
    $marca_dispo = $persona['marca'];
    $modelo_dispo = $persona['smodelo'];
    $bien_publico_dispo = $persona['nbien_publico'] ;
    $serial_dispo = $persona['sserial'];
    $estatus_dispo = $persona['estatus']; 
    $recom_dispo = $persona['recomendaciones'];
    $name_dispo = $persona['snombre_dispositivo'];
    $observaciones_dispo = $persona['sobservaciones_tecnico'];
    $imagenPath_dispo = $persona['simagen'];
    $ram_dispo = $persona['smemoria_ram'];
    $disco_dispo = $persona['sdisco_duro']; 

}
$row = pg_query($conn, $resalt);

$row2 = pg_query($conn, $diferrent);
while($jugo = pg_fetch_assoc($row2)){

    $ubicacion = $jugo["descripcion"];
} 

$query = "SELECT personales.cedula as cedula,
personales.id as id,
personales.primer_apellido as apellido1,
personales.segundo_apellido as apellido2,
personales.primer_nombre as nombre1,
personales.segundo_nombre as nombre2,
personales.subicacion_fisica as ubicacion_fisica_actual,
personales.scargo_actual_ejerce as cargo_actual_ejerce,
public.cargos.sdescripcion as cargo,
reportes_fallas.snro_reporte  as reporte,
public.ubicacion_administrativa.sdescripcion as ubicacion_adm
FROM public.personales
LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula
LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id
LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo
LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
LEFT JOIN reporte_tecnico.reportes_fallas ON reportes_fallas.personales_id = personales.id
WHERE reportes_fallas.snro_reporte = '$snro_reporte' LIMIT 1";

$row3 = pg_query($conn,$query);
while($odium = pg_fetch_assoc($row3)){
    $nombre2 = $odium['nombre1']." ".$odium['apellido1'];
    $cedula = number_format($odium['cedula'], 0, '', '.');
    $cargo = $odium['cargo'];
    $ubi1 = $odium['ubicacion_adm'];

}

$adjunto = " SELECT personales.cedula as cedula,
personales.id as id,
personales.primer_apellido as apellido1,
personales.segundo_apellido as apellido2,
personales.primer_nombre as nombre1,
personales.segundo_nombre as nombre2,
personales.subicacion_fisica as ubicacion_fisica_actual,
personales.scargo_actual_ejerce as cargo_actual_ejerce,
public.cargos.sdescripcion as cargo,
reportes_fallas.snro_reporte  as reporte,
public.ubicacion_administrativa.sdescripcion as ubicacion_adm
FROM public.personales
LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula
LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id
LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo
LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo
LEFT JOIN reporte_tecnico.reportes_fallas ON reportes_fallas.personales_id = personales.id
WHERE personales.cedula = '$tecnico' LIMIT 1";

$row4 = pg_query($conn, $adjunto);
while($repo = pg_fetch_assoc($row4)){
    $nombre = $repo['nombre1']." ".$repo['apellido1'];
    $identificacion = number_format($repo['cedula'], 0, '', '.');
    $rango = $repo['cargo'];
}


require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
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
function Footer()
{
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,utf8_decode("Página ").$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$anoter = 'img/cintillo-final3.jpg'; 

$pdf->Image($anoter, 5, 10, 175, 10); 

$pdf->Ln(6);
$pdf->SetX(17);
$pdf->Ln(11);
$pdf->SetFont('Arial', 'B', '14');
$tit = utf8_decode("INFORME TÉCNICO");
$pdf->Cell(0, 7, $tit, 0, 1, 'C');

$pdf->Ln(1.5);
$pdf->SetFont('Arial', '', '8');
$pdf->SetX(17);
$pdf->Cell(0, 4, utf8_decode('OFICINA DE TECNOLOGÍAS DE LA INFORMACIÓN Y LA COMUNICACIÓN'), 0, 1, 'C');
$pdf->Cell(0, 4, utf8_decode('DEPARTAMENTO DE SOPORTE TÉCNICO'), 0, 1, 'C');

$pdf->Ln(1);

$pdf->SetX(17);
$pdf->SetFont('Arial', 'B', '10');
$fechaActual = date('d/m/Y');
$pdf->Cell(0, 7, utf8_decode("N°: "). $snro_reporte."                   "."                   "."                   "."                   "."            "."  ".utf8_decode("Fecha de Impresión: ").$fechaActual, 0, 1, 'l');

$pdf->SetX(17);

$pdf->Ln(2.9);
$pdf->SetX(17);
$pdf->SetFont('Arial', 'B', '10');
$text1 = utf8_decode("DEPENDENCIA DE ADSCRIPCIÓN");
$pdf->Cell(170, 7, $text1, 1, 1, 'l');
$pdf->SetX(17);
$pdf->SetFont('Arial', '', '9');

$pdf->MultiCell(170, 7, $ubicacion, 1, 'l');

$pdf->SetFont('Arial', 'B', '10');

$pdf->Ln(4);

$contador = 1;

while($persona = pg_fetch_assoc($row)){

    $ubi = $persona['descripcion'];
    $dispo = $persona['tipo_disp'];
    $marca = $persona['marca'];
    $modelo = $persona['smodelo'];
    $bien_publico = $persona['nbien_publico'] ;
    $serial = $persona['sserial'];
    $estatus = $persona['estatus']; 
    $recom = $persona['recomendaciones'];
    $name = $persona['snombre_dispositivo'];
    $observaciones = $persona['sobservaciones_tecnico'];
    $imagenPath = $persona['simagen'];
    $ram = $persona['smemoria_ram'];
    $disco = $persona['sdisco_duro']; 
    $nombreImagen = basename($imagenPath);

    $pdf->SetX(17);
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->MultiCell(170, 8, utf8_decode('ESPECIFICACIONES DEL EQUIPO'), 1, 'L');
    
    $pdf->SetX(17);
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->Cell(5, 8, utf8_decode('N°'), 1, 0, 'C');
    $pdf->Cell(74, 8, 'Tipo de Dispositivo', 1, 0, 'C');
    $pdf->Cell(41, 8, 'Nombre del Dispositivo', 1, 0, 'C');
    $pdf->Cell(28, 8, 'Ram Instalada', 1, 0, 'C');
    $pdf->Cell(22, 8, 'Disco Duro', 1, 1, 'C');
    $pdf->SetX(17);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(5, 8, $contador, 1, 0, 'C');
    $pdf->Cell(74, 8, $dispo, 1, 0, 'C');
    $pdf->Cell(41, 8, $name, 1, 0, 'C');
    $pdf->Cell(28, 8, $ram, 1, 0, 'C');
    $pdf->Cell(22, 8, $disco, 1, 1, 'C');
    $pdf->SetX(17);

    $pdf->SetFont('Arial', 'B', '10');
    $pdf->Cell(30, 8, 'Marca', 1, 0, 'C');
    $pdf->Cell(30, 8, 'Modelo', 1, 0, 'C');
    $pdf->Cell(35, 8, 'Serial', 1, 0, 'C');
    $pdf->Cell(35, 8, utf8_decode('Bien Público'), 0, 0, 'C');
    $pdf->Cell(40, 8, 'Estado', 1, 1, 'C');
    $pdf->SetX(17);
    $pdf->SetFont('Arial', '', 9);
    
    $pdf->Cell(30, 8, $marca, 1, 0, 'C');
    $pdf->Cell(30, 8, $modelo, 1, 0, 'C');
    $pdf->Cell(35, 8, $serial, 1, 0, 'C');
    $pdf->Cell(35, 8, $bien_publico, 1, 0, 'C');
    $pdf->Cell(40, 8, $estatus, 1, 1, 'C');

$pdf->Ln(2);
$pdf->SetX(17);
$resumen = utf8_decode('RESUMEN:');
$resto = utf8_decode('Se procedió a la revisión del/los siguientes dispositivos:');
    // Establecer fuente en negrita para "Resumen"
$pdf->SetFont('Arial', 'B', 10);
    // Celda para "Resumen" en negrita
    $pdf->Cell(30, 7, $resumen, 0, 0, 'L'); // Ajustar ancho según sea necesario

    // Desactivar negrita
    $pdf->SetFont('Arial', '', 10);

    // Ajustar SetX para el "resto del texto"
    $pdf->SetX(38); // Cambia este valor según tus necesidades
    $pdf->Cell(20, 7, $resto, 0, 1.9, 'L');
    $pdf->Ln(1.5);
    
    $pdf->SetX(17);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(170, 8, utf8_decode("Observación(es): ").utf8_decode($observaciones), 1, 'L'); 

    $pdf->Ln(1.5);

    $pdf->SetX(17);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(170, 8, utf8_decode('Recomendación(es): ').utf8_decode($recom), 1,'L');

    $pdf->Ln(2);
    $pdf->SetX(17);
    $pdf->SetFont('Arial', 'B', '9');
    $pdf->Cell(170, 8, 'Imagen Referencial: '.utf8_decode($nombreImagen), 0, 0.5, 'C');


    if (file_exists($imagenPath)) {
        // Create a cell with specific width and height to accommodate the image
        $pdf->Cell(75, 75, '', 0, 0);  // Adjust width and height as needed
      
        // Place the image inside the cell
        $pdf->Image($imagenPath, $pdf->GetX(), $pdf->GetY(), 30, 30);  // Adjust position within the cell

        $pdf->Ln(15);

      } else {
        // Handle the case where image is not found (e.g., display a placeholder)
        $pdf->SetX(17);
        $pdf->Cell(170, 5, utf8_decode('Por favor ingresar imagen en el informe tecnico'), 0, 1, 'C'); 
    }

    $pdf->Ln(18);

    
    $pdf->Ln(3);

    $contador++; 
    
};
$pdf->Ln(2.5);

$pdf->SetX(17);

$pdf->SetFont('Arial', 'B', '10');
$tit = utf8_decode("DATOS DEL SOLICITANTE");
$pdf->Cell(170, 7, $tit, 1, 1, 'L');

$pdf->SetX(17);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 7, 'Nombre y Apellido', 1, 0, 'C');
$pdf->Cell(20, 7, 'C.I', 1, 0, 'C');
$pdf->Cell(85, 7, 'Cargo', 1, 0, 'C');
$pdf->Cell(25, 7, 'Firma', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$pdf->SetX(17);

$pdf->Cell(40, 7, $nombre2, 1, 0, 'C');
$pdf->Cell(20, 7, $cedula, 1, 0, 'C');
$pdf->Cell(85, 7, $cargo, 1, 0, 'C');
$pdf->Cell(25, 7, '', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', '10');

$pdf->SetX(17);
$titm = utf8_decode("DATOS DEL TÉCNICO");
$pdf->Cell(170, 7, $titm, 1, 1, 'L');

$pdf->SetX(17);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 7, 'Nombre y Apellido', 1, 0, 'C');
$pdf->Cell(20, 7, 'C.I', 1, 0, 'C');
$pdf->Cell(85, 7, 'Cargo', 1, 0, 'C');
$pdf->Cell(25, 7, 'Firma', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$pdf->SetX(17);

$pdf->Cell(40, 7, $nombre, 1, 0, 'C');
$pdf->Cell(20, 7, $identificacion, 1, 0, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(85, 7, $rango, 1, 0, 'C');
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetX(17);

$pdf->SetFont('Arial', 'B', '10');
$titu = utf8_decode("APROBADO POR");
$pdf->Cell(170, 7, $titu, 1, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetX(17);

$pdf->Cell(40, 7, 'Nombre y Apellido', 1, 0, 'C');
$pdf->Cell(20, 7, 'C.I', 1, 0, 'C');
$pdf->Cell(85, 7, 'Cargo', 1, 0, 'C');
$pdf->Cell(25, 7, 'Firma', 1, 1, 'C');

$pdf->SetX(17);
$pdf->SetFont('Arial', '', '9');
$pdf->Cell(40, 7, 'DANIEL PINO', 1, 0, 'C');
$pdf->Cell(20, 7, '13.864.622', 1, 0, 'C');
$pdf->Cell(85, 7, 'JEFE DE DIVISION', 1, 0, 'C');
$pdf->Cell(25, 7, '', 1, 1, 'C');


$pdf->Output();

?>
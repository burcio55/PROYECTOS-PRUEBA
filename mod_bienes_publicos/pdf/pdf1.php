<?
include "../conexion.php";

    $ci=$_REQUEST['id_c3'];
    
   
 require 'fpdf/fpdf.php';




class PDF extends FPDF
{
    function Header()
{
    // Position at 1.5 cm from bottom
    /* $this->SetY(20);
    $this->SetX(260); */
    $this->SetXY(-30, 15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,utf8_decode("Página ").$this->PageNo().'/{nb}',0,0,'C');
}
// Cargar los datos
function LoadData($file)
{
    // Leer las líneas del fichero
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Tabla simple
function BasicTable($header, $data)
{
    // Cabecera
    foreach($header as $col)
        $this->Cell(25,8,$col,1);
    $this->Ln();
    // Datos
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,8,$col,2);
            $this->Cell(40,8,$col,2);
            $this->Cell(40,8,$col,2);
            $this->Cell(40,8,$col,2);
            $this->Cell(40,8,$col,2);
            $this->Cell(40,8,$col,2);
        $this->Ln();
    }
}

// Una tabla más completa

function MostrarInformacion($texto) {
                $this->SetFont('Arial', '', 12);
                $this->Cell(0, 10, utf8_decode($texto), 0, 1, 'L');
            }
}
/* function Header() {
    // Inserta una imagen en la parte superior izquierda
    $this->Image('cintillo_institucional.jpg', 10, 10, 50); // Cambia la ruta y las coordenadas según tus necesidades
} */
/* function Footer() {
    // Pie de página
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
} */

$pdf = new PDF('L', 'mm', 'letter'); 


/* $pdf = new FPDF('L', 'mm', 'A4'); */


$sql2=("SELECT id, bienes_publicos_id, personales_id, dfecha_asignacion, resp_patrimonial_id, resp_dependencia_id FROM bienes_publicos.bienes_publicos_personas WHERE resp_patrimonial_id='".$ci."' AND benabled='TRUE'");
             /* echo $sql2;
            die();  */
            
      
        
        $data = $pdf->LoadData('paises.txt');
        $pdf->SetFont('Arial','',6);
        $pdf->AddPage();
        $pdf->SetX(15);
        $pdf->Image('cintillo_institucional.jpg', 15, 10, 100, 'JPG');



        $fecha_actual = date("d-m-Y H:i:s");
     $pdf->SetXY(-45, 10); // Ajusta la posición según necesites
$pdf->Cell(30, 10, $fecha_actual, 0, 0, 'R');

$sql="SELECT personales.cedula as cedula,
personales.id as id,
personales.nacionalidad as nacionalidad, 
personales.primer_apellido as apellido1, 
personales.segundo_apellido as apellido2, 
personales.primer_nombre as nombre1, 
personales.segundo_nombre as nombre2, 
personales.subicacion_fisica as ubicacion_fisica_actual,
personales.scargo_actual_ejerce as cargo_actual_ejerce,    
public.cargos.sdescripcion as cargo, 
public.ubicacion_administrativa.sdescripcion as ubicacion_adm                    
FROM public.personales
LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula
LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 

LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo 
                    where personales.id ='".$ci."'  LIMIT 1";
     

        
     $pdf->Ln();$pdf->AliasNbPages();
     $pdf->Ln();
     $pdf->SetFillColor(233, 229, 235); $pdf->SetX(15);
    $pdf->cell(15,5,utf8_decode('Código'),1,0,C,1);$pdf->SetX(30);
   
    $pdf->cell(80,5,utf8_decode('Ubicación Administrativa'),1,0,C,1);$pdf->SetX(110);  
    $pdf->cell(60,5,utf8_decode('Nombre del Responsable'),1,0,C,1); $pdf->SetX(170);
     $pdf->cell(25,5,utf8_decode('Nro de Cédula'),1,0,C,1); $pdf->SetX(195); 
     $pdf->cell(70,5,utf8_decode('Cargo de Trabajo'),1,0,C,1);
  
   
  
    $pdf->Ln();
    
    $ro = pg_query($conn, $sql);
    while($r=pg_fetch_assoc($ro)){ 

       $nom=$r['nombre1'];
        $ape=$r['apellido1'];
        $cdu=$r['cedula'];
        
        $ubi_ad=$r['ubicacion_adm'];
        $carg_tra=$r['cargo'];
        $carg_ejer=$r['cargo_actual_ejerce'];  
        $pdf->SetX(15);
    $pdf->cell(15,5,utf8_decode($ci),1,0,C); 
    $pdf->SetX(30);
    $pdf->cell(80,5,utf8_decode($ubi_ad),1,0,C);
    $pdf->SetX(110);
      $pdf->cell(60,5,utf8_decode($nom.' '.$ape),1,0,C);$pdf->SetX(170); 
     $pdf->cell(25,5,utf8_decode($cdu),1,0,C); $pdf->SetX(195); 
     $pdf->cell(70,5,utf8_decode($carg_tra),1,0,C);
   
  
    
     $pdf->Ln();
     $pdf->Ln();
 
    }
    $pdf->SetX(15);
    $pdf->SetFont('Arial','',12); $pdf->SetX(15);
    $pdf->Cell(90, 10, 'Responsable Patrimonial', 0, 0); 
 
 $pdf->Ln(); $pdf->SetX(15);
    $pdf->Cell(90, 10,utf8_decode('Nombre: '.$nom.' '.$ape), 0, 0);$pdf->Cell(90, 10,utf8_decode( 'Cargo: '.$carg_tra), 0, 0);$pdf->Cell(90, 10, 'Firma: ', 0, 0);
    $pdf->SetX(12);
    $pdf->Line(15, 65, 250, 65);
    $pdf->Ln();$pdf->Ln();
     
    $pdf->SetFont('Arial','',6);
       /*  $pdf->MostrarInformacion($ci); */
       $x1 = 15; // Coordenada X para la primera celda
       $y1 = 70; // Coordenada Y para la primera celda
       $width1 = 12; // Ancho de la primera celda
       $height1 = 5; // Alto de la primera celda
       
       $x2 = $x1 + $width1 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y2 = $y1; // Coordenada Y para la segunda celda (misma línea vertical)
       $width2 = 73; // Ancho de la segunda celda
       $height2 = 5; // Alto de la segunda celda

       $x3 = $x2 + $width2 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y3 = $y2; // Coordenada Y para la segunda celda (misma línea vertical)
       $width3 = 15; // Ancho de la segunda celda
       $height3 = 5; // Alto de la segunda celda

       $x4 = $x3 + $width3 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y4 = $y3; // Coordenada Y para la segunda celda (misma línea vertical)
       $width4 = 25; // Ancho de la segunda celda
       $height4 = 5; // Alto de la segunda celda

       $x5 = $x4 + $width4 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y5 = $y4; // Coordenada Y para la segunda celda (misma línea vertical)
       $width5 = 40; // Ancho de la segunda celda
       $height5 = 5; // Alto de la segunda celda

       $x6 = $x5 + $width5 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y6 = $y5; // Coordenada Y para la segunda celda (misma línea vertical)
       $width6 = 35; // Ancho de la segunda celda
       $height6 = 5; // Alto de la segunda celda

       $x7 = $x6 + $width6 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y7 = $y6; // Coordenada Y para la segunda celda (misma línea vertical)
       $width7 = 30; // Ancho de la segunda celda
       $height7 = 5; // Alto de la segunda celda

       $x8 = $x7 + $width7 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y8 = $y7; // Coordenada Y para la segunda celda (misma línea vertical)
       $width8 = 30; // Ancho de la segunda celda
       $height8 = 5; // Alto de la segunda celda

       $x9 = $x8 + $width8 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y9 = $y8; // Coordenada Y para la segunda celda (misma línea vertical)
       $width9 = 20; // Ancho de la segunda celda
       $height9 = 5; // Alto de la segunda celda

       $x10 = $x9 + $width9 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y10 = $y9; // Coordenada Y para la segunda celda (misma línea vertical)
       $width10 = 15; // Ancho de la segunda celda
       $height10 = 5; // Alto de la segunda celda

       $x11 = $x10 + $width10 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y11 = $y10; // Coordenada Y para la segunda celda (misma línea vertical)
       $width11 = 15; // Ancho de la segunda celda
       $height11 = 5; // Alto de la segunda celda

       $x12 = $x11 + $width11 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y12 = $y11; // Coordenada Y para la segunda celda (misma línea vertical)
       $width12 = 20; // Ancho de la segunda celda
       $height12 = 5; // Alto de la segunda celda

       $x13 = $x12 + $width12 + 0; // Coordenada X para la segunda celda (con un espacio de 5 unidades)
       $y13 = $y12; // Coordenada Y para la segunda celda (misma línea vertical)
       $width13 = 25; // Ancho de la segunda celda
       $height13 = 5; // Alto de la segunda celda

       $pdf->Ln(); $pdf->Ln();
       $pdf->SetFillColor(201, 201, 201); // Color de fondo

             $pdf->SetXY($x1, $y1);
                $pdf->MultiCell($width1,$height1,('Nro'),1,C,true);
                $pdf->SetXY($x2, $y2);
                $pdf->MultiCell($width2,$height2,utf8_decode('Descripción del Bien'),1,L,true);
                $pdf->SetXY($x3, $y3);
                $pdf->MultiCell($width3,$height3,('Fecha'),1,L,true);
                $pdf->SetXY($x4, $y4);
                $pdf->MultiCell($width4,$height4,('Marca'),1,L,true);
                $pdf->SetXY($x5, $y5);
                $pdf->MultiCell($width5,$height5,('Modelo'),1,L,true);
                $pdf->SetXY($x6, $y6);
                $pdf->MultiCell($width6,$height6,('Serial'),1,L,true);
                $pdf->SetXY($x7, $y7);
                $pdf->MultiCell($width7,$height7,('Color'),1,L,true);
               
                $pdf->SetXY($x8, $y8);
                $pdf->MultiCell($width9,$height9,('Estado'),1,L,true);
              
              
                $pdf->Ln();

             $row2 = pg_query($conn, $sql2);
            /*  $or1 = pg_fetch_all($row2); */
             while ($or1 = pg_fetch_assoc($row2)) { 
             
             $resultado=$or1['bienes_publicos_id'];
          
               
                 $SQL="SELECT bienes_publicos.bienes_publicos. id , nnro_bien_publico,
                 productos.sdescripcion as producto,
                 productos.id as producto_id,
                 origen.sdescripcion as origen, 
                 origen.id as origen_id, 
                 marca.sdescripcion as marca,
                 marca.id as marca_id,
                 smodelo,sserial,
                 color.sdescripcion as color,
                 color.id as color_id,
                 condicion_fisica.sdescripcion as condicion_fisica,
                 condicion_fisica.id as condicion_fisica_id,
                 estado.sdescripcion as estado,
                 estado.id as estado_id,
                 nvalor,nnro_valor_compra,dfecha_orden_compra,
                 cuenta_contable.sdescripcion as cuenta_contable,
                 cuenta_contable.id as cuenta_contable_id,
                 sobservaciones
               
                FROM bienes_publicos.bienes_publicos 
                inner join bienes_publicos.color on color.id = bienes_publicos.color_id 
                inner join bienes_publicos.marca on marca.id = bienes_publicos.marca_id 
                inner join bienes_publicos.origen on origen.id = bienes_publicos.origen_id 
                inner join bienes_publicos.estado on estado.id = bienes_publicos.estado_id 
                inner join bienes_publicos.productos on productos.id = bienes_publicos.productos_id 
                inner join bienes_publicos.condicion_fisica on condicion_fisica.id = bienes_publicos.condicion_fisica_id 
                inner join bienes_publicos.cuenta_contable on cuenta_contable.id = bienes_publicos.cuenta_contable_id 
                where bienes_publicos.benabled='TRUE' AND bienes_publicos.bienes_publicos. id='".$resultado."'"; 

               

                $row=pg_query($conn,$SQL);
                $or=pg_fetch_all($row);
                while($or=pg_fetch_assoc($row)){   
                $nro=$or['nnro_bien_publico'];
                $producto=$or['producto'];
                $origen=$or['origen'];
                $marca=$or['marca'];
                $modelo=$or['smodelo'];
                $serial=$or['sserial'];
                $color=$or['color'];
                $condicion_fisica=$or['condicion_fisica'];
                $estado=$or['estado'];
                $valor=$or['nvalor'];
                $orde_compra=$or['nnro_valor_compra'];
                $fecha_orden=$or['dfecha_orden_compra'];
                $cuenta_contable=$or['cuenta_contable'];

                $y1=$y1+$height1;
                $y2=$y2+$height1;
                $y3=$y3+$height1;
                $y4=$y4+$height1;
                $y5=$y5+$height1;
                $y6=$y6+$height1;
                $y7=$y7+$height1;
                $y8=$y8+$height1;
                $y9=$y9+$height1;
                $y10=$y10+$height1;
                $y11=$y11+$height1;
                $y12=$y12+$height1;
                $y13=$y13+$height1;
                
                $pdf->SetXY($x1, $y1);
                $pdf->MultiCell($width1,$height1,utf8_decode($nro),1,C);
               
                $pdf->SetXY($x2, $y2);
                $pdf->MultiCell($width2,$height1,utf8_decode($producto),1,L);
                
                $pdf->SetXY($x3, $y3);
                $pdf->MultiCell($width3,$height1,utf8_decode("10-01-2024"),1,L);
                
                $pdf->SetXY($x4, $y4);
                $pdf->MultiCell($width4,$height1,utf8_decode($marca),1,L);
                
                $pdf->SetXY($x5, $y5);
                $pdf->MultiCell($width5,$height1,utf8_decode($modelo),1,L);
                
                $pdf->SetXY($x6, $y6);
                $pdf->MultiCell($width6,$height1,utf8_decode($serial),1,L);
                
                $pdf->SetXY($x7, $y7);
                $pdf->MultiCell($width7,$height1,utf8_decode($color),1,L);
                
                $pdf->SetXY($x8, $y8);
               
                
               
                $pdf->MultiCell($width9,$height1,utf8_decode($estado),1,L);
                
                
                $pdf->Ln('10');
               
                
               }
            } 
            
        



 



/* $pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data); */


// Títulos de las columnas

$pdf->Output();

?>
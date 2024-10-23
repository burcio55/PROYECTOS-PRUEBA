<?php
//include('../include/adodb/adodb.inc.php');
//include('../include/settings.php');

session_start();

//$conn = &ADONewConnection($target);
//$conn->PConnect($hostname,$username,$password,$db_settings[0]);

require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');

/*
$SQL="select proveedores.id as idprov, proveedores.nombre_empresa, proveedores.descripcionactividad, proveedores.rif, proveedores.finscripcion_proveedor, proveedores.fvencimiento_proveedor, proveedores.fvencimiento_rnc, proveedores.fvencimiento_solvencia, proveedores.islr_hasta, proveedores.status, estado.nombre
			from proveedores 
			INNER JOIN estado ON proveedores.estado_id=estado.id
			where proveedores.id <>0 " ;   
		    $rs = $conn->Execute($SQL);

//$CONTENIDO ='';
	if ($rs->RecordCount()>0){	
		while(!$rs->EOF){		
	  $CONTENIDO = "<tr>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	  <td class='labelListColumn'>".$rs->fields['nombre_empresa']."</td>
	</tr>";
		 $rs->MoveNext();
	//	 $CONTENIDO  .= $CONTENIDO;
			}			
	   }
*/

$str_conexao="host='10.46.1.91' dbname='siglaProveeduria' port='5432' user='areadesarrollo' password='areadesarrollopasswd'";
$conexao=pg_connect($str_conexao) or die('Conexión Fallida!');
$consulta=pg_exec($conexao,"select proveedores.id as idprov, proveedores.nombre_empresa, proveedores.descripcionactividad, proveedores.rif, proveedores.finscripcion_proveedor, proveedores.fvencimiento_proveedor, proveedores.fvencimiento_rnc, proveedores.fvencimiento_solvencia, proveedores.islr_hasta, proveedores.status, estado.nombre
			from proveedores 
			INNER JOIN estado ON proveedores.estado_id=estado.id
			where proveedores.id <>0 ");
$numregs=pg_numrows($consulta);

//Build table
$i=0;
while($i<$numregs)
{

  $CONTENIDO = "<tr>
  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	  <td class='labelListColumn'>".pg_result($consulta,$i,'idprov')."</td>
	</tr>";
	//	 $CONTENIDO  .= $CONTENIDO;

    $i++;
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Reporte de Proveedores', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);


// -----------------------------------------------------------------------------


// NON-BREAKING TABLE (nobr="true.")
$tbl = <<<EOD
<table border="1" cellpadding="2" cellspacing="2" nobr="true">
 <tr>
              <td width="4%" class="labelListColumn Estilo14">Nro. $a</td>
              <td width="14%" class="labelListColumn Estilo14">Empresa</td>
              <td width="35%" class="labelListColumn Estilo14">Descripci&oacute;n Actividad </td>
              <td width="7%" class="labelListColumn Estilo14">Estado</td>
              <td width="8%" class="labelListColumn Estilo14">Rif</td>
              <td width="7%" class="labelListColumn">Insc. Prov.</td>
              <td width="7%" class="labelListColumn Estilo14">Venc. Prov.</td>
              <td width="7%" class="labelListColumn Estilo14">Venc. RNC </td>
              <td width="7%" class="labelListColumn Estilo14">Venc. Solv.</td>
              <td width="4%" class="labelListColumn Estilo14">St</td>
            </tr>		
			$CONTENIDO
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------


//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+

<?php
$lenguage = 'es_VE.UTF-8'; //permite mostrar la fecha en letras
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage, "esp");
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');
ini_set("max_execution_time","28800");
session_start();

				$DATOS='';
     //   $usuario=$_SESSION['usuario'];	
		     $cedula=$_SESSION['ced_afiliado'];
        $fechahoy=strftime("%e de %B de %Y");
				
			//	var_dump($_SESSION['aTabla4']);
				if($_SESSION['aTabla4']==NULL){
				   $aTabla4='';
					 $_SESSION['aTabla4']='';
				   }
				else{
					 $aTabla4=$_SESSION['aTabla4'];					
					}
				
				if($_SESSION['aTabla5']==NULL){
				   $aTabla5='';
					 $_SESSION['aTabla5']='';
				   }
				else{
					 $aTabla5=$_SESSION['aTabla5'];					
					}
				
				if($_SESSION['aTabla6']==NULL){
				   $aTabla6='';
					 $_SESSION['aTabla6']='';
				   }
				else{
					 $aTabla6=$_SESSION['aTabla6'];					
					}
							
				if($_SESSION['aTabla8']==NULL){
				   $aTabla8='';
					 $_SESSION['aTabla8']='';
				   }
				else{
					 $aTabla8=$_SESSION['aTabla8'];					
					}
				
    
	$aTabla1=$_SESSION['aTabla1'];
							
							$nombres=$aTabla1['nombres'];
							$apellidos=$aTabla1['apellidos'];
		          $nacionalidad=$aTabla1['nacionalidad'];	 
							if($nacionalidad==1) $nacionalidad='Venezolana';
							if($nacionalidad==2) $nacionalidad='Extranjera';		
					$sexo=$aTabla1['sexo'];	 
							if($sexo==1) $sexo='Femenino';
							if($sexo==2) $sexo='Masculino';
					list($a,$m,$d)=explode("-", $aTabla1['f_nacimiento']);
				 		$a_nac= $a;
						$a_act= date('Y');
					$edad= $a_act-$a_nac;
					$f_nacimiento=strftime('%d-%m-%Y', strtotime($aTabla1['f_nacimiento']));	 
					$pais_nac=$aTabla1['pais_nac'];
					$estado_nac=$aTabla1['estado_nac'];
					$municipio_nac=$aTabla1['municipio_nac'];
					$parroquia_nac=$aTabla1['parroquia_nac'];
					$sector=$aTabla1['sector'];
					$direccion=$aTabla1['direccion'];
					$telefono=$aTabla1['telefono'];
					$otro_telefono=$aTabla1['otro_telefono'];
					$correo=$aTabla1['correo'];
					$estado_civil=$aTabla1['estado_civil'];
					$vehiculo=$aTabla1['vehiculo'];
	
	$aTabla2=$_SESSION['aTabla2'];				
					$trabajar_fuera=$aTabla2['trabajar_fuera'];	 
							if($trabajar_fuera==1) $trabajar_fuera='Si';
							if($trabajar_fuera==0) $trabajar_fuera='No';
					$experiencia1=$aTabla2['experiencia1'];	 
							if($experiencia1==1) $experiencia1='Con Experiencia';
							if($experiencia1==0) $experiencia1='Sin Experiencia';
				 	$situacion=$aTabla2['situacion'];
					$jornada=$aTabla2['jornada'];
					$fsituacion=strftime('%d-%m-%Y', strtotime($aTabla2['fsituacion'])); 
					$pref_salario=$aTabla2['pref_salario'];
					$ocupacion1=$aTabla2['ocupacion1'];
		
					$pais_residencia=$_GET['pr'];
					$estado_residencia=$_GET['er'];
					$ocupacion2=$_GET['o2'];
					$experiencia2=$_GET['ex'];
							if($experiencia2=='Si') $experiencia2='Con Experiencia';
							if($experiencia2=='No') $experiencia2='Sin Experiencia';	 
					$foto=$_GET['ft'];
					
					if ($foto!=''){
						$imagen='<img src="imagenes/'.$foto.'" width="70" height="90" border="0"/>';
						
						}
					else{		
					    $imagen='FOTO';
					}	
			
			$DATOS.=' 
			<table style="border-left-color:#BDBDBD; border-right-color:#BDBDBD; border-top-color:#BDBDBD; border-bottom-color:#BDBDBD;" >
			<tr>
			<td colspan="5">
			</td>
			</tr>			
			
			<tr>
			<td colspan="4" style="color:#1060C8; border-bottom-color:#1060C8;" ><b><FONT FACE="arial" SIZE="14" COLOR="#1060C8"> '.htmlspecialchars($nombres, ENT_QUOTES).' '.htmlspecialchars($apellidos, ENT_QUOTES).' '.$cedula.'</font></b></td>
			<td align="center"  rowspan="5" > '.$imagen.'</td>
			</tr>
			
			<tr>
			<td colspan="5">
			</td>
			</tr>
			
			<tr>
			<td colspan="4" align="center" style="color:#1060C8;"><b> 
			'.htmlspecialchars($pais_residencia, ENT_QUOTES).' Estado: '.htmlspecialchars($estado_residencia, ENT_QUOTES).'
			Municipio: '.htmlspecialchars($municipio_nac, ENT_QUOTES).' 
			Parroquia: '.htmlspecialchars($parroquia_nac, ENT_QUOTES).'<br>
			Direcci&oacute;n: '.htmlspecialchars($direccion, ENT_QUOTES).' 
			Sector: '.htmlspecialchars($sector, ENT_QUOTES).'
			Tel&eacute;fono(s): '.$telefono.' - '.$otro_telefono.'<br>
			Correo: '.htmlspecialchars($correo, ENT_QUOTES).'<br><br>
			</b>
			</td>
			</tr>
			</table>
			<tr>
			<td colspan="5"></td>
			</tr>
			
			<tr>
			<td colspan="5" style="color:#1060C8; border-bottom-color:#1060C8;" ><div align="left"><b> DATOS PERSONALES:</b></div></td>
			</tr>
			<tr>
			<td width="20%" align="right"><b>Sexo:  </b></td>
			<td width="30%" align="left"> '.$sexo.'</td>
			<td width="20%" align="right"><b>Edad: </b></td>
			<td width="30%" align="left" colspan="3"> '.$edad.'</td>
			</tr>
			<tr>
			<td width="20%" align="right"><b>Fecha de Nacimiento:  </b></td>
			<td width="30%" align="left"> '.$f_nacimiento.'</td>
			<td width="20%" align="right"><b>Lugar de nacimiento:  </b></td>
			<td width="30%" align="left" colspan="3"> '.htmlspecialchars($estado_nac, ENT_QUOTES).' - '.htmlspecialchars($pais_nac, ENT_QUOTES).'</td>
			</tr>
			<tr>
			<td width="20%" align="right"><b>Estado Civil:  </b></td>
			<td width="30%" align="left"> '.$estado_civil.' </td>
			<td width="20%" align="right"></td>
			<td width="30%" align="left"  colspan="3"></td>
			</tr>
			<tr>
			<td colspan="5"></td>
			</tr>
			<tr>
			<td width="100%" style="color:#1060C8; border-bottom-color:#1060C8;" ><div align="left"><b> SITUACI&Oacute;N LABORAL: </b></div></td>
			</tr>
			<tr>
			<td width="20%" align="right"><b>Situaci&oacute;n ocupacional:  </b></td>
			<td width="30%" align="left" > '.htmlspecialchars($situacion, ENT_QUOTES).'</td>
			<td width="20%" align="right"><b>Fecha de esta situaci&oacute;n:  </b></td>
			<td width="30%" align="left"  colspan="3"> '.$fsituacion.'</td>
			</tr>
			<tr>
			<td align="right"><b>Primera opci&oacute;n ocupacional:  </b></td>
			<td align="left" > '.htmlspecialchars($ocupacion1, ENT_QUOTES).'  '.$experiencia1.' </td>
			<td align="right"><b>Segunda opci&oacute;n ocupacional:</b></td>
			<td align="left"  colspan="3"> '.htmlspecialchars($ocupacion2, ENT_QUOTES).'  '.$experiencia2.'</td>
			</tr>
			<tr>
			<td colspan="5"></td>
			</tr>';
			
		if($aTabla4==''){	
			$DATOS.= '		
			<tr>
			<td colspan="5"></td>
			</tr>';		
     }
			else{
			$DATOS.= '		
			<tr>
			<td width="100%" style="color:#1060C8; border-bottom-color:#1060C8;" colspan="5"><div align="left"><b>EDUCACI&Oacute;N: </b></div></td>
			</tr>';
			for($i=0; $i<count($aTabla4); $i++){					
					$graduado=$aTabla4[$i]['graduado'];	 
					if($graduado==1) $graduado='Si';
					if($graduado==0) $graduado='No';	 
					$graduado=$aTabla4[$i]['graduado'];	
					$titulo=$aTabla4[$i]['titulo'];
					$ultimo_periodo=$aTabla4[$i]['ultimo_periodo'];
					$total_periodo=$aTabla4[$i]['total_periodo'];				
					$f_aprobacion=$aTabla4[$i]['f_aprobacion'];
					$instituto_uni=$aTabla4[$i]['instituto_uni'];
					$observaciones_estudio=$aTabla4[$i]['observaciones_estudio'];
					$nivel=$aTabla4[$i]['nivel'];
					$carrera=$aTabla4[$i]['carrera'];
					$regimen=$aTabla4[$i]['regimen'];
					
	$DATOS.= '<tr>
     	    <td width="20%" align="right"><b>Nivel educativo:  </b></td>
      		<td width="30%" align="left" >  '.$nivel.'</td>
					<td width="20%" align="right"><b>Area o menci&oacute;n:  </b></td>
      		<td width="30%" align="left"  colspan="3">  '.htmlspecialchars($carrera, ENT_QUOTES).'  Graduado:  '.$graduado.'</td>
    		   </tr>
			    <tr>
     	    <td align="right" style="border-top-color:#FFFFFF;"><b>Instituto/Universidad:  </b></td>
      		<td align="left" >  '.htmlspecialchars($instituto_uni, ENT_QUOTES).'</td>
     	    <td align="right" style="border-top-color:#FFFFFF; "><b>T&iacute;tulo obtenido:  </b></td>
      		<td align="left"  colspan="3">  '.htmlspecialchars($titulo, ENT_QUOTES).' -  '.$f_aprobacion.'</td>
			    </tr>
					<tr>
			    <td width="100%" style="color:#1060C8; border-bottom-color:#DDDDDD;" colspan="5"></td>
			    </tr>
		   ';
	}
}
if($aTabla5==''){	
			$DATOS.= '		
			<tr>
			<td colspan="5"></td>
			</tr>';		
     }
		else{

  $DATOS.= '<tr>
     		<td width="100%" style="color:#1060C8; border-bottom-color:#1060C8;" ><div align="left"><b> CAPACITACI&Oacute;N </b></div></td>
    		</tr>';
			
			$aTabla5=$_SESSION['aTabla5'];
			for($i=0; $i<count($aTabla5); $i++){					
					$relacion=$aTabla5[$i]['relacion'];	 
					if($relacion==1) $relacion='Si';
					if($relacion==0) $relacion='No'; 
					$instituto=$aTabla5[$i]['instituto'];
					$f_realizacion=$aTabla5[$i]['f_realizacion']; 
					$duracion=$aTabla5[$i]['duracion'];
					$curso=$aTabla5[$i]['curso'];
					
	$DATOS.= '<tr>
     	    <td width="20%" align="right"><b>Actividad de capacitaci&oacute;n:  </b></td>
      		<td width="30%" align="left" >  '.$curso.'</td>
					<td width="20%" align="right"><b>Instituci&oacute;n/Empresa:  </b></td>
      		<td width="30%" align="left"  colspan="3">  '.htmlspecialchars($instituto, ENT_QUOTES).'</td>
    		   </tr>
			    <tr>
     	    <td align="right" style="border-top-color:#FFFFFF;"><b>Duraci&oacute;n: </b></td>
      		<td align="left" >  '.$duracion.' horas</td>
     	    <td align="right" style="border-top-color:#FFFFFF; "><b>Fecha de culminaci&oacute;n:  </b></td>
      		<td align="left"  colspan="3">  '.$f_realizacion.'</td>
			    </tr>
					<tr>
			    <td width="100%" style="color:#1060C8; border-bottom-color:#DDDDDD;" colspan="5"></td>
			    </tr>
		   ';
		}
}
if($aTabla6==''){	
			$DATOS.= '		
			<tr>
			<td colspan="5"></td>
			</tr>';		
     }
			else{
  $DATOS.= '<tr>
						<td width="100%" style="color:#1060C8; border-bottom-color:#1060C8;" ><div align="left"><b> OTROS CONOCIMIENTOS: </b></div></td>
						</tr>
						';
			
					$aTabla6=$_SESSION['aTabla6'];
					for($i=0; $i<count($aTabla6); $i++){					
					$nivel=$aTabla6[$i]['nivel'];
					if($nivel==1) $nivel='Bien';
					if($nivel==2) $nivel='Regular';	
					if($nivel==3) $nivel='Excelente';	 
					$computacion=$aTabla6[$i]['computacion'];
					
	$DATOS.= '<tr>
     	    <td width="20%" align="right"><b>Herramienta de Computaci&oacute;n: </b></td>
      		<td width="30%" align="left" >  '.htmlspecialchars($computacion, ENT_QUOTES).'</td>
     	    <td width="20%" align="right"><b>Nivel:  </b></td>
      		<td width="30%" align="left"  colspan="3">  '.$nivel.'</td>
			    </tr>
					<tr>
			    <td width="100%" style="color:#1060C8; border-bottom-color:#DDDDDD;" colspan="5"></td>
			    </tr>
		   ';
		}	
}

if($aTabla8==''){	
			$DATOS.= '		
			<tr>
			<td colspan="5"></td>
			</tr>';		
     }
			else{	
  $DATOS.= '<tr>
     		<td width="100%" style="color:#1060C8; border-bottom-color:#1060C8;" ><div align="left"><b> EXPERIENCIA LABORAL: </b></div>		
			</td>
    		</tr>
			';
			$aTabla8=$_SESSION['aTabla8'];
			for($i=0; $i<count($aTabla8); $i++){										
						$ocupacione=$aTabla8[$i]['ocupacione'];
						$patrono=$aTabla8[$i]['patrono'];
						$f_ingreso=$aTabla8[$i]['f_ingreso'];	
						$f_egreso=$aTabla8[$i]['f_egreso'];				
  $DATOS.= '<tr>
     	    <td width="20%" align="right"><b>Empresa u organismo: </b></td>
      		<td width="30%" align="left" > '.htmlspecialchars($patrono, ENT_QUOTES).'</td>
					<td width="20%" align="right"><b>Ocupaci&oacute;n: </b></td>
      		<td width="30%" align="left"  colspan="3"> '.htmlspecialchars($ocupacione, ENT_QUOTES).'</td>
    		   </tr>
			    <tr>
     	    <td align="right" style="border-top-color:#FFFFFF;"><b>Desde: </b></td>
      		<td align="left" > '.$f_ingreso.'</td>
     	    <td align="right" style="border-top-color:#FFFFFF; "><b>Hasta: </b></td>
      		<td align="left"  colspan="3"> '.$f_egreso.'</td>
			    </tr>
					<tr>
			    <td width="100%" style="color:#1060C8; border-bottom-color:#DDDDDD;" colspan="5"></td>
			    </tr>
	        ';
			}
	}
	$DATOS.= '<tr>
      		<td width="100%">
		  	</td>
		    </tr>	
			<tr>
      		<td width="100%">
		  	</td>
		    </tr>
			<tr>
			<td width="100%" align="center" style="color:#1060C8;"><b><FONT SIZE="8">Nota: Todos los servicios ofrecidos por el Servicio P&uacute;blico de Empleo son absolutamente gratuitos, tanto para los trabajadores y trabajadoras como para las entidades de trabajo. </font></b></td>
   		   </tr>';
		//  echo 'TABLAAAA '.$DATOS; 
/*class MYPDF extends TCPDF {
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-20);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Nota: Todos los servicios ofrecidos por el Servicio Publico de Empleo son absolutamente gratuitos,', 0, false, 'C', 0, '0', 0, false, 'T', 'M');
		$this->Cell(0, 15, 'tanto para los trabajadores y trabajadoras como para las empresas.', 0, false, 'C', 0, '0', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);*/
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MINPPTRASS');
$pdf->SetTitle('Formato Curriculum');
$pdf->SetSubject('Formato Curriculum');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);

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
  $pdf->SetFont('helvetica', '', 8);
  
  // add a page
  $pdf->AddPage();
    
  // -----------------------------------------------------------------------------
  
  // NON-BREAKING TABLE (nobr="true")  
$tbl = <<<EOD
<table width="95%" border="0"  align="center">	
	$DATOS
</table>	
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------


//Close and output PDF document
$pdf->Output('Formato Curriculum', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+

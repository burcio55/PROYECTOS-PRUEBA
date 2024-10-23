<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

doAction($conn);
debug();

/*funcion pricipal que va a contener todas las acciones que tenga la pagina*/
function doAction($conn){
    if (isset($_POST['action'])){
		switch($_POST['action']){
	    //{evento} se substituye por btnAceptar o btnModificar o btnBuscar (mismo nombre que se colocar en el buton)
	     case 'limpiar': 					
			unset($_SESSION['aDefaults_']);
			unset($_SESSION['aDefaults']);
			unset($_SESSION['condicion']);
			unset($_SESSION['where']);
			unset($_SESSION['criterio']);			
			LoadData($conn,false);
		break;
			
		case 'Aceptar': 		   
			$_SESSION['where']='';		
			$_SESSION['criterio']='';		
			$bValidateSuccess = true;
		
			if ($_POST['ncedula']!=''){						
				$_SESSION['where'].= " miembros.ncedula = ".$_POST['ncedula']." ";
				$_SESSION['criterio']= 'cedula- ';				
			} else{				
				if ($_POST['srif']!=''){						
					$_SESSION['where'].= " empresa.srif = '".$_POST['srif']."' ";
					$_SESSION['criterio']= 'R.I.F.- ';				
				} else{
					$bValidateSuccess=false;
					$GLOBALS['aPageErrors'][]= "- El R.I.F es requerida.";
					
					$GLOBALS['aPageErrors'][]= "- La Cédula es requerida.";
				}
			}
	
		
								
			if ($_SESSION['where']==''){
				$bValidateSuccess=false;	
		    }
			
			if ($bValidateSuccess){					
					buscar($conn);
			
			}
				LoadData($conn, true);			
		break;	
		}
	}  
	else{
		//$aTabla = $GLOBALS['aTabla'];
		unset($_SESSION['aDefaults_']);
		unset($_SESSION['aDefaults']);		
		unset($_SESSION['condicion']);
		unset($_SESSION['where']);
		 LoadData($conn, false);
		 buscar($conn);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function buscar($conn){

$fecha_hoy=date('Y-m-d');	


$SQL_fv= " SELECT rncpt.empresa.id, rncpt.miembros_empresa.dfecha_vencimiento FROM rncpt.empresa inner join rncpt.miembros_empresa on miembros_empresa.empresa_id=empresa.id WHERE miembros_empresa.nenabled='1' and '".$fecha_hoy."'  >= miembros_empresa.dfecha_vencimiento 
 group by rncpt.empresa.id, rncpt.miembros_empresa.dfecha_vencimiento
 order by rncpt.empresa.id; ";
$rs = $conn->Execute($SQL_fv);

	if ($rs->RecordCount()>0){	
	while(!$rs->EOF){
			$SQL= "SELECT
			rncpt.empresa. srif, 
			rncpt.empresa.srazon_social,
			rncpt.empresa.sdenominacion_comercial,
			rncpt.empresa.sucursales,
			rncpt.empresa.id,
			rncpt.motor.sdescripcion	as motor,
			rncpt.empresa.tipo_registro,
			rncpt.empresa.sdireccion_fiscal,
			rncpt.empresa.nro_boleta as boleta,
			rncpt.empresa.sdireccion_fiscal as direccion
			FROM rncpt.empresa
			inner join rncpt.empresa_motor on empresa.id=empresa_motor.empresa_id
			inner join rncpt.motor on empresa_motor.motor_id=motor.id
			WHERE  empresa.nenabled='1' and   empresa.id='".$rs->fields['id']."' ;";
			$rs1 = $conn->Execute($SQL);
			
				$c=0;
				if ($rs1->RecordCount()>0){
					while(!$rs1->EOF){
						$aTabla1[]=array();
						$c = count($aTabla1)-1;
				
						$aTabla1[$c]['id']=$rs1->fields['id'];				
						$aTabla1[$c]['razon_empresa']= $rs1->fields['srazon_social'];
						$aTabla1[$c]['sdenominacion_comercial']= $rs1->fields['sdenominacion_comercial'];
						$aTabla1[$c]['srif']= $rs1->fields['srif'];
						$aTabla1[$c]['sucursales']= $rs1->fields['sucursales'];	
						$aTabla1[$c]['direccion']= $rs1->fields['sdireccion_fiscal'];	
						$aTabla1[$c]['motor']= $rs1->fields['motor'];
						if($rs1->fields['tipo_registro']==1)$sector='Privado';	
						if($rs1->fields['tipo_registro']==2)$sector='P&uacute;blico';
						if($rs1->fields['tipo_registro']==3)$sector='Mixto';
						$aTabla1[$c]['sector']= $sector;
							
						$aTabla1[$c]['boleta']= $rs1->fields['boleta'];	
						$aTabla1[$c]['dfecha_vencimiento']= $rs->fields['dfecha_vencimiento'];	
						$aTabla1[$c]['dfecha_const_comite']= $rs->fields['dfecha_const_comite'];
						$rs1->MoveNext();
					}
				$_SESSION['aDefaults_']=$aTabla1;
				
				}
		$rs->MoveNext();		 
	}
}
}
//------------------------------------------------------------------------------------------------------------------------------
//LoadCombo permite cargar un combo con informacion de la base de datos
function LoadData($conn, $bPostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
		if(!$bPostBack){
			unset($_SESSION['aDefaults_']);
			unset($_SESSION['aDefaults']);
			unset($_SESSION['condicion']);
			unset($_SESSION['where']);
			unset($_SESSION['criterio']);
		}else{	
		     
				//$_SESSION['condicion']='';		
							
		}
	}
}
function edad_($fecha){
	$fechanac_=date("Y-m-d",strtotime($fecha));
	
	list($Y,$m,$d) = explode("-",$fechanac_);
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	
}
?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>

	<form action="" method="post" enctype="multipart/form-data" name="form" id="form"> 
<script>


function send(saction){
	if((document.getElementById('srif').value!='' && saction=='Aceptar') || (document.getElementById('ncedula').value!='' && saction=='Aceptar')){
		var form = document.form;
		form.action.value=saction;
		document.getElementById("srif").style.border = "";
		document.getElementById("ncedula").style.border = "";
		form.submit();
	}else{
		if(saction=='limpiar'){
			var form = document.form;
			form.action.value=saction;
			document.getElementById("srif").style.border = "";
			document.getElementById("ncedula").style.border = "";
			form.submit();
		}else{
			document.getElementById("srif").style.border =  "1px solid red";	
			document.getElementById("ncedula").style.border = "1px solid red";	
			
			alert("Debe seleccionar una de las opciones de consulta.");
		}
	}	
 }
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>
<input name="action" type="hidden" value=""> 
  	<table width="98%"  align="center" class="formulario" border="0" bordercolor="#CCCCCC">
         <tr>
        <th colspan="4"  class="sub_titulo"><div align="left">CONSULTAS  --> Períodos Vencidos</div></th>
      </tr>
          <tr>
          <td colspan="4" align="left"><span class="requerido"><b>NOTA:</b> Est&aacute; consulta s&oacute;lo genera informaci&oacute;n de CPTT Vencidos a la fecha de consulta. </td>
      </tr>
 

    </table>
    
   

<!--Aqui empieza la tabla que trae datos de la BBDD -->
  	<?

	$pdf_imprimir1='';
	$pdf_imprimir1='
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >  
	
		<tr  bgcolor="#999999" color="#FFFFFF" >
       		<th  colspan="8" class="sub_titulo_2"><div align="left"><b>Datos B&aacute;sicos de la Entidad de Trabajo</b></div></th>
        </tr>	
		<tr bgcolor="#D0E0F4" color="#1060C8">
	   <th width="10%" class="sub_titulo" ><div align="center"> R.I.F					</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Nro. de Boleta			</div></th>
       <th width="10%" class="sub_titulo" ><div align="center"> Raz&oacute;n Social			</div></th>
       <th width="10%" class="sub_titulo" ><div align="center"> Denominaci&oacute;n Comercial	</div></th>
       <th width="30%" class="sub_titulo" ><div align="center"> Direcci&oacute;n Fiscal		</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Sector					</div></th>	
	   <th width="10%" class="sub_titulo" ><div align="center"> Motor					</div></th>	
	   <th width="10%" class="sub_titulo" ><div align="center"> Fecha de Vencimiento	</div></th>	
	   </tr>	';
	 
   
	$aTabla_=$_SESSION['aDefaults_'];
	//var_dum=p ($aTabla);
	$i=0;
	// $i=0;
	$pdf_imprimir2='';
	
	for( $i=0; $i<count($aTabla_); $i++){
		
		if (($i%2) == 0) {
			$class_name = "dataListColumn2";
			$class_name1='bgcolor="#F7F7F7"';
		}else
		{ $class_name = "dataListColumn";
		  $class_name1='bgcolor="#E2E2E2"';
		}
		$pdf_imprimir2.='
     <tr  '.$class_name1.' class="'.$class_name.'"  style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-weight: normal;	color: #000000;">	 
       <td class="texto-normal"><div align="center">'.' '.$aTabla_[$i]['srif'].'	</div></td> 
		 <td class="texto-normal"><div align="center">'.$aTabla_[$i]["boleta"].'</div></td>
		  <td class="texto-normal"><div align="center">'.' '.$aTabla_[$i]['razon_empresa'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[$i]['sdenominacion_comercial'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[$i]['direccion'].'</div></td> 
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[$i]['sector'].'</div></td>  	     
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[$i]['motor'].'</div></td>  	
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[$i]['dfecha_vencimiento'].'</div></td>  
     </tr>';
	 
	   
	 	} //cierra for 
		
		
		
  		$pdf_imprimir3='';
		$pdf_imprimir3='
		
   </table>
   
</br>
 
<table width="100%" class="formulario"  align="center" border="0"  cellPadding="5" cellSpacing="1" >   
		<tr color="#1060C8">
				<th colspan="3" class="titulo1"><div align="right">Total de CPTT Vencidos   </div> </th>
	<th colspan="2" ><div align="left"><strong><font color="#666666">  '.$i.'  </font></strong> </div> </th>

     </tr>  

	</table>';
   

	 
	
	echo  $_SESSION['aDefaults']['cadena']=$pdf_imprimir1 . $pdf_imprimir2 . $pdf_imprimir3;
	//  echo html_entity_decode($_SESSION['aDefaults']['cadena']);
	 
	 ?>
<table width="98%" border="0" align="center">
<tr>
    <td colspan="3">&nbsp;</td>
</tr>
<tr>
    <td colspan="3" align="right"><div align="center">
     <button type="submit" name="imprimir" class="button_personal btn_imprimir"  formaction="pdf_consulta_vencidos.php" formtarget="_blank" > Reporte</button>
 </td>		
</tr> 	
<tr>
    <td heigth="20">&nbsp;</td>
</tr> 
</table>
  
</form>
    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../../footer.php"); ?>
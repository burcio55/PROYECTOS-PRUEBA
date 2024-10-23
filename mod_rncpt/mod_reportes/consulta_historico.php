<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();
session_start();
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
		   
			
		
			$bValidateSuccess = false;			
			if ($_POST['nro_boleta']==''){	
				$bValidateSuccess=false;
				$GLOBALS['aPageErrors'][]= "- El Nro. de Boleta es requerida.";				
			}else{
				if ($_POST['nro_boleta']!=''){						
					$_SESSION['where']= " rncpt.empresa.nro_boleta = '".$_POST['nro_boleta']."' ";
					$_SESSION['criterio']= 'cedula- ';
					$bValidateSuccess=true;
				} 
				if (!isset($_SESSION['where'])){
					$bValidateSuccess=false;	
				}
			}
						
			
			
			if ($bValidateSuccess){					
				buscar($conn);
			}
			//LoadData($conn, true);			
		break;	
		}
	}  
	else{
		unset($_SESSION['aDefaults_']);
		unset($_SESSION['aDefaults']);
		unset($_SESSION['condicion']);
		unset($_SESSION['where']);
		unset($_SESSION['criterio']);
		LoadData($conn, false);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function buscar($conn){
	//FELIX MEDINA 1
$SQL= "SELECT
rncpt.empresa. srif, 
rncpt.empresa.srazon_social,
rncpt.empresa.sdenominacion_comercial,
rncpt.empresa.sucursales,
rncpt.empresa.id,
rncpt.motor.sdescripcion	as motor,
rncpt.empresa.tipo_registro,
rncpt.miembros_empresa.dfecha_vencimiento,
rncpt.empresa.sdireccion_fiscal,
rncpt.empresa.nro_boleta as boleta,
rncpt.empresa.sdireccion_fiscal as direccion
FROM rncpt.miembros_empresa
inner join rncpt.empresa on miembros_empresa.empresa_id=empresa.id
inner join rncpt.empresa_motor on empresa.id=empresa_motor.empresa_id
inner join rncpt.motor on empresa_motor.motor_id=motor.id
INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
WHERE ".$_SESSION['where']." ;";
$rs1 = $conn->Execute($SQL);
if ($rs1->RecordCount()>0){
	$c=0;
	$aTabla1[]=array();
	$aTabla1[$c]['id']=$rs1->fields['id'];				
	$aTabla1[$c]['razon_empresa']= $rs1->fields['srazon_social'];
	$aTabla1[$c]['sdenominacion_comercial']= $rs1->fields['sdenominacion_comercial'];
	$aTabla1[$c]['srif']= $rs1->fields['srif'];
	$aTabla1[$c]['sucursales']= $rs1->fields['sucursales'];	
	$aTabla1[$c]['direccion']= $rs1->fields['sdireccion_fiscal'];	
	$aTabla1[$c]['motor']= $rs1->fields['motor'];
	if($rs1->fields['tipo_registro']==1)$sector='PRIVADO';	
	if($rs1->fields['tipo_registro']==2)$sector='PÙBLICO';
	if($rs1->fields['tipo_registro']==3)$sector='MIXTO';
	$aTabla1[$c]['sector']= $sector;
	$aTabla1[$c]['dfecha_vencimiento']= $rs1->fields['dfecha_vencimiento'];
		
	$aTabla1[$c]['boleta']= $rs1->fields['boleta'];

	$SQL = "SELECT miembros_empresa.id, 
	miembros_empresa.nenabled,
	miembros_empresa.dfecha_actualizacion,
	miembros.ncedula,
	miembros.sprimer_nombre,
	miembros.ssegundo_nombre,
	miembros.sprimer_apellido,
	miembros.ssegundo_apellido,
	miembros.stelefono1,
	miembros.stelefono2,
	miembros.nsexo,
	miembros.semail,
	miembros.fecha_nacimiento,
	condicion_act.sdescripcion as condicion_act,
	condicion_laboral.sdescripcion as condicion_lab,
	cargos.descripcion_cargo as cargos			
	FROM rncpt.miembros_empresa
	INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
	inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
	inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
	inner join rncpt.condicion_laboral on miembros_empresa.condicion_laboral_id=condicion_laboral.id
	inner join rncpt.empresa on miembros_empresa.empresa_id=empresa.id
	inner join rncpt.empresa_motor on empresa.id=empresa_motor.empresa_id
	inner join rncpt.motor on empresa_motor.motor_id =motor.id
	WHERE ".$_SESSION['where']." and miembros_empresa.empresa_id=". $aTabla1[$c]['id']." ORDER BY miembros.ncedula;";
	$rs = $conn->Execute($SQL);
	$c=0;
	if ($rs->RecordCount()>0){
		while(!$rs->EOF){
			$aTabla[]=array();
			$c = count($aTabla)-1;
			$apellidonombre = ucwords(strtolower($rs->fields['sprimer_nombre']." ".$rs->fields['ssegundo_nombre'].' '.$rs->fields['sprimer_apellido']." ".$rs->fields['ssegundo_apellido']));			
			$aTabla[$c]['sdescripcion']=$rs->fields['condicion_act'];
			$aTabla[$c]['ncedula']=$rs->fields['ncedula'];
			$aTabla[$c]['apellidonombre']=$apellidonombre;
			$aTabla[$c]['apellidonombre_']=$apellidonombre_;
			$aTabla[$c]['stelefono1']=$rs->fields['stelefono1'];
			$aTabla[$c]['stelefono2']=$rs->fields['stelefono2'];
			$aTabla[$c]['semail']=$rs->fields['semail'];
			$sexo=$rs->fields['nsexo'];
			if($sexo=='1') $aTabla[$c]['sexo']='Masculino';
			if($sexo=='2') $aTabla[$c]['sexo']='Femenino';
			$aTabla[$c]['condicion_act']=$rs->fields['condicion_act'];
			$aTabla[$c]['condicion_lab']=$rs->fields['condicion_lab'];
			$aTabla[$c]['id']=$rs->fields['id'];						
			$aTabla[$c]['fecha_nacimiento']=$rs->fields['fecha_nacimiento'];	
			$aTabla[$c]['edad']=edad_($aTabla[$c]['fecha_nacimiento'])	;					
			$aTabla[$c]['cargos']=$rs->fields['cargos'];			
	        $aTabla[$c]['dfecha_actualizacion']=$rs->fields['dfecha_actualizacion'];			

		$rs->MoveNext();
		}
		$_SESSION['aDefaults']=$aTabla;
		$_SESSION['aDefaults_']=$aTabla1;
	}else{
			unset($_SESSION['aDefaults_']);
			unset($_SESSION['aDefaults']);
			unset($_SESSION['condicion']);
			unset($_SESSION['where']);
			unset($_SESSION['criterio']);	
			unset($_SESSION['aDefaults']['cadena']);		
		?><script>alert("No existe registro asociados a la consulta..");</script><?
	}	 
}else{
		unset($_SESSION['aDefaults_']);
			unset($_SESSION['aDefaults']);
			unset($_SESSION['condicion']);
			unset($_SESSION['where']);
			unset($_SESSION['criterio']);			
			unset($_SESSION['aDefaults']['cadena']);		
		?><script>alert("No existe registro asociados a la consulta..");</script><?
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
				
				/*if($_SESSION['where']!='' and $_SESSION['criterio']!='nro_boleta- ') $_SESSION['condicion']=' Desde  '.$_SESSION['desde'].' Hasta  '.$_SESSION['hasta'].'';		*/	
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

	<form action="<? //= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="form" id="form"> 
<script>
function send(saction){
	if(document.getElementById('nro_boleta').value!='' && saction=='Aceptar'){
		var form = document.form;
		form.action.value=saction;
			document.getElementById("nro_boleta").style.border = "";
		form.submit();
	}else{
		if(saction=='limpiar'){
			var form = document.form;
			form.action.value=saction;
			document.getElementById("nro_boleta").style.border = "";
			form.submit();
		}else{
			document.getElementById("nro_boleta").style.border = "1px solid red";	
			alert("El Nro. de Boleta es requerido");
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
        <th colspan="4"  class="sub_titulo"><div align="left">CONSULTAS  --> Hist&oacute;rico</div></th>
      </tr>
      
                <tr>
          <td colspan="4" align="left"><span class="requerido"><b>NOTA:</b> Est&aacute; consulta muestra el movimiento de los voceros que han registrado en un Consejo Productivo de Trabajoras y Trabajadores en el RNCPTT </td>
      </tr>

      <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
      
      <tr>
         <th colspan="4">&nbsp;</th>		
      </tr>
    </table>
    
    <table width="40%"  align="center" class="formulario" border="0" bordercolor="#CCCCCC">
      <tr>
         <th colspan="1"  class="sub_titulo"><div align="center"> Nro. de Boleta del CPTT</div></th>        
     
        </tr>
        
<tr>      
        <td colspan="1" align="center"><input name="nro_boleta" type="text" class="textbox" id="nro_boleta" value=""size="13" maxlength="20"  title="Indique el N&uacute;mero de Boleta del CPTT)"  placeholder="Ej. 2021-01-00001"/>
        <span>*</span></td>
        
        
</tr>       
	    <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2"> </th>
        </tr>
      <tr>
         <th colspan="4">&nbsp;</th>		
      </tr>      
      <tr>                        
        <td colspan="4" align="center">
         <button type="button" name="Aceptar" class="button_personal btn_buscar" <?=$_POST['boton']?> onClick="send('Aceptar')"  >Aceptar</button>
      
           <button type="button" name="Limpiar" class="button_personal btn_limpiar" <?=$_POST['boton']?> onClick="send('limpiar')"  >Limpiar</button>
        
        </td>
      </tr>
      
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      
      <tr>
         <th colspan="4">&nbsp;</th>		
      </tr>
    </table>
    
  
<!--Aqui empieza la tabla que trae datos de la BBDD -->
  	<?
	$aTabla_=$_SESSION['aDefaults_'];
	
	
	$pdf_imprimir1='';
	$pdf_imprimir1='
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >  
	
		<tr  bgcolor="#999999" color="#FFFFFF" >
       		<th  colspan="8" class="sub_titulo_2"><div align="left"><b>Datos B&aacute;sicos de la Entidad de Trabajo</b></div></th>
        </tr>	
		<tr bgcolor="#D0E0F4" color="#1060C8">
	   <th width="10%" class="sub_titulo" ><div align="center"> R.I.F					</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Nro. de Boleta			</div></th>
       <th width="15%" class="sub_titulo" ><div align="center"> Raz&oacute;n Social			</div></th>
       <th width="15%" class="sub_titulo" ><div align="center"> Denominaci&oacute;n Comercial	</div></th>
       <th width="25%" class="sub_titulo" ><div align="center"> Direcci&oacute;n Fiscal		</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Sector					</div></th>	
	   <th width="10%" class="sub_titulo" ><div align="center"> Motor					</div></th>	
	   <th width="5%" class="sub_titulo" ><div align="center"> Fecha de Vcto.					</div></th>	
	   </tr>	
	   <tr bgcolor="#F0F0F0">
	     <td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['srif'].'	</div></td> 
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['boleta'].'	</div></td> 	     
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['razon_empresa'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['sdenominacion_comercial'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['direccion'].'</div></td> 
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['sector'].'</div></td>  	     
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['motor'].'</div></td>  	
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['dfecha_vencimiento'].'</div></td>  
        </tr>
  </table>  
	<br>
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >   
		 <tr  bgcolor="#999999" color="#FFFFFF">
       		 <th  colspan="8" class="sub_titulo_2"><div align="left"><b>Datos de los Voceros del CPTT</b></div></th>
        </tr>		
		<tr bgcolor="#D0E0F4" color="#1060C8">
			<th width="10%" class="sub_titulo" ><div align="center"> C.I.</div></th>
			<th width="25%" class="sub_titulo" ><div align="center"> Nombre(s) y Apellido(s)</div></th>
			<th width="5%" class="sub_titulo" ><div align="center"> Sexo</div></th>
		    <th width="5%" class="sub_titulo" ><div align="center"> Edad</div></th>
		    <th width="20%" class="sub_titulo" ><div align="center"> Condici&oacute;n Actual</div></th>
		    <th width="25%" class="sub_titulo" ><div align="center"> Condici&oacute;n Laboral </div></th>
		    <th width="10%" class="sub_titulo" ><div align="center"> Fecha de Actualizaci&oacute;n</div></th>
		 </tr>
 ';
	 
   
	$aTabla1=$_SESSION['aDefaults'];
	//var_dum=p ($aTabla);
	$i=$dias=0;
	// $i=0;
	$pdf_imprimir2='';
	
	for( $i=0; $i<count($aTabla1); $i++){
		$cedula= number_format($aTabla1[$i]['ncedula'], 0, '', '.');
		if (($i%2) == 0) {
			$class_name = "dataListColumn2";
			$class_name1='bgcolor="#F7F7F7"';
		}else
		{ $class_name = "dataListColumn";
		  $class_name1='bgcolor="#E2E2E2"';
		}
		$pdf_imprimir2.='
     <tr  '.$class_name1.' class="'.$class_name.'"  style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-weight: normal;	color: #000000;">	 
         <td class="texto-normal"><div align="center">'.' '.$cedula.'</div></td> 
	     <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['apellidonombre'].'</div></td> 	
		 <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['sexo'].'</div></td> 	
		 <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['edad'].'</div></td> 	
		 <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['condicion_act'].'</div></td>       
      	 <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['condicion_lab'].'</div></td> 
		 <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['dfecha_actualizacion'] .'</div></td> 
     </tr>';
	 
	   
	 	} //cierra for 
		
		$pdf_imprimir3='';
		$pdf_imprimir3='
		
   </table>
</br>  
<table width="95%" class="formulario"  align="center" border="0"  cellPadding="5" cellSpacing="1" >   		
<tr color="#1060C8"> 
	<th colspan="7" class="titulo1"><div align="right">Total de Movimientos de los Voceros del CPTT  </div> </th>
	<th><div align="center"><strong><font color="#666666">  '.$i.'  </font></strong> </div> </th>
</tr> 
</table>';
	 echo $_SESSION['aDefaults']['cadena']=$pdf_imprimir1 . $pdf_imprimir2 . $pdf_imprimir3;
	 
	 ?>
    <table width="98%" border="0" align="center">
        <tr>
        	<td colspan="3">&nbsp;</td>
        </tr>
        <tr>
        	<td colspan="3" align="right"><div align="center">
             <button type="submit" name="imprimir" class="button_personal btn_imprimir"  formaction="pdf_consulta_historico.php" formtarget="_blank" >Reporte</button>
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
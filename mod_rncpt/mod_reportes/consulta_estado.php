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
				$_SESSION['where'].= " miembros.ncedula = ".trim($_POST['ncedula'])." ";
				$_SESSION['criterio']= 'cedula- ';
				
			} else{
				
				if ($_POST['srif']!=''){						
				$_SESSION['where'].= " empresa.srif = '".trim($_POST['srif'])."' ";
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
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function buscar($conn){
	$sql_entidad="
	select entidad_id, rol.id
	from personales_rol
	inner join  rol on  personales_rol.rol_id= rol.id
	inner join  rolopcion on rolopcion.rol_id = personales_rol.rol_id
	inner join opcion on rolopcion.opcion_id = opcion.id
	where personales_rol.nenabled='1' and opcion.nmodulo='".$_SESSION['id_modulo']."' and personales_cedula='".$_SESSION['id_usuario']."' 
	group by entidad_id, rol.id	
	";
	$rs1 = $conn->Execute($sql_entidad);
		$entidad='';
	if ($rs1->RecordCount()>0){
		if($rs1->fields['entidad_id']==''){
			$entidad='';
		}else{
		$entidad="and rncpt.empresa.entidad_nentidad='".$rs1->fields['entidad_id']."'";
		}
		
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
	FROM rncpt.miembros_empresa
	inner join rncpt.empresa on miembros_empresa.empresa_id=empresa.id
	inner join rncpt.empresa_motor on empresa.id=empresa_motor.empresa_id
	inner join rncpt.motor on empresa_motor.motor_id=motor.id
	INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
	WHERE ".$_SESSION['where']." and  miembros_empresa.nenabled='1' ".$entidad."  ;";
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
		if($rs1->fields['tipo_registro']==2)$sector='PUBLICO';
		if($rs1->fields['tipo_registro']==3)$sector='MIXTO';
		$aTabla1[$c]['sector']= $sector;
			
		$aTabla1[$c]['boleta']= $rs1->fields['boleta'];
	
		$SQL = "SELECT miembros_empresa.id, 
		miembros_empresa.nenabled,
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
		WHERE ".$_SESSION['where']." and miembros_empresa.empresa_id=". $aTabla1[$c]['id']." and  miembros_empresa.nenabled='1'
		ORDER BY miembros.ncedula ;";
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
				$aTabla[$c]['edad']=edad_($aTabla[$c]['fecha_nacimiento']);					
				$aTabla[$c]['cargos']=$rs->fields['cargos'];			
	
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
        <th colspan="4"  class="sub_titulo"><div align="left">CONSULTAS  --> R.I.F / C.I. del Vocero</div></th>
      </tr>
          <tr>
          <td colspan="4" align="left"><span class="requerido"><b>NOTA:</b> Est&aacute; consulta s&oacute;lo genera informaci&oacute;n de CPTT activos, y podr&aacute; solicitarlo haciendo uso de una de las siguientes opciones: <b>1.- </b> Número del Registro de Información Fiscal (R.I.F)<b>. 2.- </b>C.I del Vocero. <b>3.- </b> Número del Registro de Información Fiscal (R.I.F) y C.I del Vocero. </td>
      </tr>
      
      <tr>
         <th colspan="4">&nbsp;</th>		
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
         <th colspan="1"  class="sub_titulo"><div align="center"> R.I.F</div></th>
         
         <th colspan="1"  class="sub_titulo"><div align="center"> C.I. del Vocero</div></th>
        </tr>
        
<tr>      
        <td colspan="1" align="center"><input name="srif" type="text" class="textbox" id="srif" value=""size="13" maxlength="20" o  title="Coloque el N&uacute;mero de Informaciòn Fiscal (R.I.F)" onkeyup="mayusculas(this);"  placeholder="Ej. J123456789"/>
        <span>*</span></td>
        
        <td colspan="1" align="center"><input name="ncedula" type="text" class="textbox" id="ncedula" value=""size="13" maxlength="20" onkeypress="return isNumberKey(event);" title="Coloque el N&uacute;mero de la Cédula de Identidad  del Funcionario" />
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
       
      </tr>

    </table>
  

<!--Aqui empieza la tabla que trae datos de la BBDD -->
  	<?
	$aTabla_=$_SESSION['aDefaults_'];
	$pdf_imprimir1='';
	$pdf_imprimir1='
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >  
	
		<tr  bgcolor="#999999" color="#FFFFFF" >
       		<th  colspan="7" class="sub_titulo_2"><div align="left"><b>Datos B&aacute;sicos de la Entidad de Trabajo</b></div></th>
        </tr>	
		<tr bgcolor="#D0E0F4" color="#1060C8">
	   <th width="10%" class="sub_titulo" ><div align="center"> R.I.F					</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Nro. de Boleta			</div></th>
       <th width="15%" class="sub_titulo" ><div align="center"> Raz&oacute;n Social			</div></th>
       <th width="15%" class="sub_titulo" ><div align="center"> Denominaci&oacute;n Comercial	</div></th>
       <th width="25%" class="sub_titulo" ><div align="center"> Direcci&oacute;n Fiscal		</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Sector					</div></th>	
	   <th width="15%" class="sub_titulo" ><div align="center"> Motor					</div></th>	
	   </tr>	
	   <tr bgcolor="#F0F0F0">
	     <td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['srif'].'</div></td> 
		 <td class="texto-normal"><div align="center"><a href="../mod_registro/boleta_QR.php?boleta='.$aTabla_[0]["boleta"].'" target="_blank" >'.$aTabla_[0]["boleta"]. '</a><img src="../imagenes/pdf.png" width="12" height="12" title="Descargar Boleta - Haga clic para descargar la boleta del CPTT"/></a></div></td>
		  <td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['razon_empresa'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['sdenominacion_comercial'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['direccion'].'</div></td> 
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['sector'].'</div></td>  	     
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['motor'].'</div></td>  	
        </tr>
  </table>  
	<br>
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >   
		 <tr  bgcolor="#999999" color="#FFFFFF">
       		 <th  colspan="7" class="sub_titulo_2"><div align="left"><b>Datos de los Voceros del CPTT</b></div></th>
        </tr>		
		<tr bgcolor="#D0E0F4" color="#1060C8">
			<th width="10%" class="sub_titulo" ><div align="center"> C.I.</div></th>
			<th width="30%" class="sub_titulo" ><div align="center"> Nombre(s) y Apellido(s)</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> Sexo</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> Edad</div></th>
			<th width="20%" class="sub_titulo" ><div align="center"> Condici&oacute;n Actual</div></th>
			<th width="20%" class="sub_titulo" ><div align="center"> Condici&oacute;n Laboral </div></th>
		</tr>
			

 ';
	$pdf_imprimir1_pdf='
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >  
	
		<tr  bgcolor="#999999" color="#FFFFFF" >
       		<th  colspan="7" class="sub_titulo_2"><div align="left"><b>Datos B&aacute;sicos de la Entidad de Trabajo</b></div></th>
        </tr>	
		<tr bgcolor="#D0E0F4" color="#1060C8">
	   <th width="10%" class="sub_titulo" ><div align="center"> R.I.F					</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Nro. de Boleta			</div></th>
       <th width="15%" class="sub_titulo" ><div align="center"> Raz&oacute;n Social			</div></th>
       <th width="15%" class="sub_titulo" ><div align="center"> Denominaci&oacute;n Comercial	</div></th>
       <th width="25%" class="sub_titulo" ><div align="center"> Direcci&oacute;n Fiscal		</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> Sector					</div></th>	
	   <th width="15%" class="sub_titulo" ><div align="center"> Motor					</div></th>	
	   </tr>	
	   <tr bgcolor="#F0F0F0">
	     <td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['srif'].'</div></td> 
		 <td class="texto-normal"><div align="center">'.' '.$aTabla_[0]["boleta"]. '</div></td>
		  <td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['razon_empresa'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['sdenominacion_comercial'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['direccion'].'</div></td> 
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['sector'].'</div></td>  	     
		<td class="texto-normal"><div align="center">'.' '.$aTabla_[0]['motor'].'</div></td>  	
        </tr>
  </table>  
	<br>
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >   
		 <tr  bgcolor="#999999" color="#FFFFFF">
       		 <th  colspan="7" class="sub_titulo_2"><div align="left"><b>Datos de los Voceros del CPTT</b></div></th>
        </tr>		
		<tr bgcolor="#D0E0F4" color="#1060C8">
			<th width="10%" class="sub_titulo" ><div align="center"> C.I.</div></th>
			<th width="30%" class="sub_titulo" ><div align="center"> Nombre(s) y Apellido(s)</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> Sexo</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> Edad</div></th>
			<th width="20%" class="sub_titulo" ><div align="center"> Condici&oacute;n Actual</div></th>
			<th width="20%" class="sub_titulo" ><div align="center"> Condici&oacute;n Laboral </div></th>
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
     </tr>';
	 
	   
	 	} //cierra for 
		
		$pdf_imprimir3='';
		$pdf_imprimir3='
		
   </table>
   
</br>
 
<table width="100%" class="formulario"  align="center" border="0"  cellPadding="5" cellSpacing="1" >   
	<tr color="#1060C8">
		  <th colspan="5" class="titulo1"><div align="right">Total Voceros del CPTT   </div> </th>
	      <th><div align="center"><strong><font color="#666666">  '.$i.'  </font></strong> </div> </th>
     </tr>  
	</table>';
	 
	
	echo  $_SESSION['aDefaults']['cadena']=$pdf_imprimir1 . $pdf_imprimir2 . $pdf_imprimir3;
	  $_SESSION['aDefaults']['cadena_pdf']=$pdf_imprimir1_pdf . $pdf_imprimir2 . $pdf_imprimir3;

	 
	 ?>
<table width="98%" border="0" align="center">
<tr>
    <td colspan="3">&nbsp;</td>
</tr>

<tr> 
    <td colspan="3" align="right"><div align="center">
     <button type="submit" name="imprimir" class="button_personal btn_imprimir"  formaction="pdf_consulta_estado.php" formtarget="_blank" > Reporte</button>
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
<?php 
include("../../header.php");


$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
$aDefaultForm = array();
//$aPageErrors = array();
$ids_elementos_validar= array();

include("../../mod_recp_const/mod_recibos_pagos/general_LoadCombo.php"); 

doAction($conn);
debug();

/*funcion pricipal que va a contener todas las acciones que tenga la pagina*/
function doAction($conn){
    if (isset($_POST['action'])){
		switch($_POST['action']){
	    //{evento} se substituye por btnAceptar o btnModificar o btnBuscar (mismo nombre que se colocar en el buton)
	     case 'limpiar': 
					
			//unset($_SESSION['aDefaults_']);
			unset($_SESSION['aDefaults']);
			//unset($_SESSION['condicion']);
			//unset($_SESSION['where']);
			//unset($_SESSION['criterio']);			
			LoadData($conn,false);
		break;
			
		case 'Aceptar': 
		   
			//$_SESSION['where']='';		
			//$_SESSION['criterio']='';
		
			$bValidateSuccess = true;
		
			if ($_POST['cbo_entidad'] ==''){						
				//$_SESSION['where'].= " miembros.ncedula = ".trim($_POST['ncedula'])." ";
				//$_SESSION['criterio']= 'cedula- ';
				$bValidateSuccess=false;
					$GLOBALS['aPageErrors'][]= "- El estado es requerido.";
					
					//$GLOBALS['aPageErrors'][]= "- La Cédula es requerida.";
				
			} //else{
				
				/*if ($_POST['srif']!=''){						
				$_SESSION['where'].= " empresa.srif = '".trim($_POST['srif'])."' ";
				$_SESSION['criterio']= 'R.I.F.- ';
				
				} else{
					
				}*/
			//}
	
		
								
			/*if ($_SESSION['where']==''){
				$bValidateSuccess=false;	
		    }*/
			
			if ($bValidateSuccess){					
					buscar($conn,$_POST['cbo_entidad']);
					
			
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
function buscar($conn,$entidad){
	
	$sql_entidad="
	select entidad_id,entidad.sdescripcion, rol.id
	from personales_rol
	inner join  rol on  personales_rol.rol_id= rol.id
	inner join  rolopcion on rolopcion.rol_id = personales_rol.rol_id
	inner join opcion on rolopcion.opcion_id = opcion.id
	inner join entidad  on entidad.nentidad =entidad_id
	where personales_rol.nenabled='1' and opcion.nmodulo='".$_SESSION['id_modulo']."' 
	and entidad_id= ".$entidad."
	group by entidad_id, rol.id, entidad.sdescripcion
	";
	
	//and personales_cedula='".$_SESSION['id_usuario']."' 
	//group by entidad_id, rol.id	
	//";
	$rs1 = $conn->Execute($sql_entidad);
		$entidad='';
		echo "ENTIDADDE ESTADO".$nombre_entidad = $rs1->fields['sdescripcion'];
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
	rncpt.empresa.entidad_nentidad,
	public.entidad.sdescripcion,
	rncpt.empresa.sdireccion_fiscal,
	rncpt.empresa.nro_boleta as boleta,
	rncpt.empresa.sdireccion_fiscal as direccion
	FROM rncpt.miembros_empresa
	inner join rncpt.empresa on miembros_empresa.empresa_id=empresa.id
	inner join rncpt.empresa_motor on empresa.id=empresa_motor.empresa_id
	inner join rncpt.motor on empresa_motor.motor_id=motor.id
	inner join public.entidad  on entidad.nentidad=rncpt.empresa.entidad_nentidad
	INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
	WHERE  rncpt.miembros_empresa.nestatus_vocero = '1' and  rncpt.miembros_empresa. nestatus_cptt = '1'   and rncpt.empresa.nestatus = '1'   ".$entidad." 
	GROUP BY rncpt.empresa. srif, rncpt.empresa.srazon_social, rncpt.empresa.sdenominacion_comercial, 
	rncpt.empresa.sucursales, rncpt.empresa.id, rncpt.motor.sdescripcion, rncpt.empresa.tipo_registro, 
	rncpt.empresa.entidad_nentidad, public.entidad.sdescripcion, rncpt.empresa.sdireccion_fiscal, 
	rncpt.empresa.nro_boleta, rncpt.empresa.sdireccion_fiscal  
	order by rncpt.empresa.srif";
	//WHERE ".$_SESSION['where']." and  miembros_empresa.nenabled='1' ".$entidad."  ;";
	$rs1 = $conn->Execute($SQL);

	if ($rs1->RecordCount()>0){

		$id_empresas = "";
		$c=0;

		while(!$rs1->EOF){
				$aTabla1[]=array();
				$c = count($aTabla1)-1;
				$aTabla1[$c]['id']=$rs1->fields['id'];				
				$aTabla1[$c]['razon_empresa']= $rs1->fields['srazon_social'];
				$aTabla1[$c]['sdenominacion_comercial']= $rs1->fields['sdenominacion_comercial'];
				$aTabla1[$c]['srif']= $rs1->fields['srif'];
				//$aTabla1[$c]['estado']= $rs1->fields['sdescripcion'];
				$aTabla1[$c]['sucursales']= $rs1->fields['sucursales'];	
				$aTabla1[$c]['direccion']= $rs1->fields['sdireccion_fiscal'];	
				$aTabla1[$c]['motor']= $rs1->fields['motor'];
				if($rs1->fields['tipo_registro']==1)$sector='PRIVADO';	
				if($rs1->fields['tipo_registro']==2)$sector='PUBLICO';
				if($rs1->fields['tipo_registro']==3)$sector='MIXTO';
				$aTabla1[$c]['sector']= $sector;
				$aTabla1[$c]['boleta']= $rs1->fields['boleta'];

			$rs1->MoveNext();

			if($id_empresas == ""){

				$id_empresas = $aTabla1[$c]['id'];				

			}else{

				$id_empresas = $id_empresas.','.$aTabla1[$c]['id'];
				
			}
			
		}

		$SQL = "SELECT 
		rncpt.empresa.srif, rncpt.empresa.srazon_social, rncpt.empresa.sdenominacion_comercial,
		miembros_empresa.id, 
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
		cargos.descripcion_cargo as cargos,
		miembros_empresa.dfecha_vencimiento,
		miembros_empresa.nestatus_vocero,
		miembros_empresa. nestatus_cptt		
		FROM rncpt.miembros_empresa
		INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
		inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
		inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
		inner join rncpt.condicion_laboral on miembros_empresa.condicion_laboral_id=condicion_laboral.id
		inner join rncpt.empresa on miembros_empresa.empresa_id=empresa.id
		inner join rncpt.empresa_motor on empresa.id=empresa_motor.empresa_id
		inner join rncpt.motor on empresa_motor.motor_id =motor.id
		WHERE miembros_empresa.empresa_id in(".$id_empresas.") and  miembros_empresa.nenabled='1'
		and miembros_empresa.nestatus_vocero = '1' and miembros_empresa. nestatus_cptt = '1'
		ORDER BY empresa.srif,miembros.ncedula ;";
		//WHERE ".$_SESSION['where']." and miembros_empresa.empresa_id=". $aTabla1[$c]['id']." and  miembros_empresa.nenabled='1'
		//ORDER BY miembros.ncedula ;";
		$rs = $conn->Execute($SQL);
		$c=0;
		if ($rs->RecordCount()>0){
			while(!$rs->EOF){
				$aTabla[]=array();
				$c = count($aTabla)-1;
				$apellidonombre = ucwords(strtolower($rs->fields['sprimer_nombre']." ".$rs->fields['ssegundo_nombre'].' '.$rs->fields['sprimer_apellido']." ".$rs->fields['ssegundo_apellido']));			
				$aTabla[$c]['srif']=$rs->fields['srif'];
				$aTabla[$c]['srazon_social']=$rs->fields['srazon_social'];
				$aTabla[$c]['sdenominacion_comercial']=$rs->fields['sdenominacion_comercial'];
				$aTabla[$c]['dfecha_vencimiento']=$rs->fields['dfecha_vencimiento'];
				$aTabla[$c]['sdescripcion']=$rs->fields['condicion_act'];
				$aTabla[$c]['ncedula']=$rs->fields['ncedula'];
				$aTabla[$c]['apellidonombre']=$apellidonombre;
				//$aTabla[$c]['apellidonombre_']=$apellidonombre_;
				$aTabla[$c]['stelefono1']=$rs->fields['stelefono1'];
				$aTabla[$c]['estado']= $nombre_entidad;
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
			
		}else{

			unset($_SESSION['aDefaults']);
				
			?><script>alert("No existe registro asociados a la consulta..");</script><?
			
		}	 
	}else{
			unset($_SESSION['aDefaults']);
				
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
			
			unset($_SESSION['aDefaults']);
			
		}else{	
		     							
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
	if(saction=='Aceptar') {
		var form = document.form;
		form.action.value=saction;
		//document.getElementById("srif").style.border = "";
		//document.getElementById("ncedula").style.border = "";
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
			<th colspan="4"  class="sub_titulo"><div align="left">CONSULTAS  --> CPTT Activos</div></th>
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
			<th colspan="2"  class="sub_titulo"><div align="center"> ESTADO</div></th>
		</tr>
        
		<tr>      
			<td colspan="1" align="center"><font color="#666666">
				
				<select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_entidad" name="cbo_entidad" onChange="">
				<option value="">Seleccione</option>
				<? LoadEstadoAdscripcion ($conn) ; print $GLOBALS['sHtml_cb_Estado_trab']; ?>
				</select><span class="requerido"> * </span>       
				</font>
			</td>
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
	<br>
    <table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >   
		 <tr  bgcolor="#999999" color="#FFFFFF">
		 	<th  colspan="5" class="sub_titulo_2"><div align="center"><b>Entidad de Trabajo</b></div></th>
       		<th  colspan="4" class="sub_titulo_2"><div align="center"><b>Voceros del CPTT</b></div></th>
        </tr>		
		<tr bgcolor="#D0E0F4" color="#1060C8">
			<th width="3%" class="sub_titulo" ><div align="center"> N°</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> RIF</div></th>
			<th width="17%" class="sub_titulo" ><div align="center"> NOMBRE O RAZON SOCIAL</div></th>
			<th width="15%" class="sub_titulo" ><div align="center"> DENOMINACION COMERCIAL</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> ESTADO</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> FECHA DE VENCIMIENTO</div></th>
			<th width="15%" class="sub_titulo" ><div align="center"> C.I</div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> NOMBRES Y APELLIDOS </div></th>
			<th width="10%" class="sub_titulo" ><div align="center"> CONDICIóN </div></th>
		</tr>
			

 ';
   
	$aTabla1=$_SESSION['aDefaults'];
	
	$i=$dias=0;
	
	$pdf_imprimir2='';
	$n= 1;
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
	 	<td class="texto-normal"><div align="center">'.' '.$n.'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['srif'].'</div></td> 
		<td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['srazon_social'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['sdenominacion_comercial'].'</div></td>
		<td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['estado'].'</div></td>
       	<td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['dfecha_vencimiento'].'</div></td>
	    <td class="texto-normal"><div align="center">'.' '.$cedula.'</div></td> 	
		 <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['apellidonombre'].'</div></td>       
      	 <td class="texto-normal"><div align="center">'.' '.$aTabla1[$i]['condicion_lab'].'</div></td>    
     </tr>';
	 
	 	$n++;
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
	echo $_SESSION['aDefaults'] = $pdf_imprimir1 . $pdf_imprimir2 . $pdf_imprimir3;
	 
	 ?>
<table width="98%" border="0" align="center">
<tr>
    <td colspan="3">&nbsp;</td>
</tr>

<tr> 
    <td colspan="3" align="right"><div align="center">
     <button type="submit" name="imprimir" class="button_personal btn_imprimir"  formaction="consulta_activo_cptt_excell.php" formtarget="_blank" > Reporte</button>
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
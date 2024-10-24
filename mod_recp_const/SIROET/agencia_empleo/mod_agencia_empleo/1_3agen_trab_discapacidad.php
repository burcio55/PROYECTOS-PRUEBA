<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug']=false);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		    case 'Agregar': 
			$bValidateSuccess=true;	
			
			if ($_POST['cbTipo_discapacidad']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Tipo de discapacidad: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbDiscapacidad_nivel']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Grado de discapacidad: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbDiscapacidad_origen']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Origen de la discapacidad: es requerido.";
					$bValidateSuccess=false;
					 }
				
			if ($_POST['cbDiscapacidad_origen']=="3"){
					if ($_POST['cbAdquirida']=="-1"){
						$GLOBALS['aPageErrors'][]= "- Tipo de discapacidad adquirida: es requerida.";
						$bValidateSuccess=false;
						 }
			}	else{
				$_POST['cbAdquirida']='-1';
				}
			
			if ($_POST['cbDiscapacidad_certificado']=="1"){
					if ($_POST['cbCertificado']=="-1"){
						$GLOBALS['aPageErrors'][]= "- Quien certifica: es requerido.";
						$bValidateSuccess=false;
						 }
			}  
		 
		 if ($_POST['cbDiscapacidad_ayuda']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Requiere ayuda técnica: es requerido.";
					$bValidateSuccess=false;
					 }
		 if ($_POST['cbDiscapacidad_ayuda']=="1"){  
				if ($_POST['cbTipo_Ayuda_discapacidad']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El tipo de ayuda técnica: es requerido.";
					$bValidateSuccess=false;
					 }
			     }else{
				$_POST['cbTipo_Ayuda_discapacidad']='-1';
				}
				
		 if ($_POST['cbDiscapacidad_ayuda']=="1"){  
				if ($_POST['cbDiscapacidad_nivel_depen']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Grado de autonomía: es requerido.";
					$bValidateSuccess=false;
					 }
			     }else{
				$_POST['cbDiscapacidad_nivel_depen']='-1';
				}
				
				
			 if ($_POST['cbDiscapacidad_calificacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Posee calificación de discapacidad: es requerido.";
					$bValidateSuccess=false;
					 } 
		 			
			
			if ($_POST['cbControl_medico']=="-1"){ 
					$GLOBALS['aPageErrors'][]= "- Asiste a control médico: es requerido.";
					$bValidateSuccess=false;
					 }	
			
			if ($_POST['cbControl_medico']=="1"){  
				if ($_POST['cbFrecuencia']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Frecuencia con que asiste: es requerido.";
					$bValidateSuccess=false;
					 }
			     }else{
				$_POST['cbFrecuencia']='-1';
				}	  
			
			if ($_POST['cbMedicado']=="-1"){ 
					$GLOBALS['aPageErrors'][]= "- Está medicado: es requerido.";
					$bValidateSuccess=false;
					 }	
			
			if ($_POST['cbMedicado']=="1"){  
				if ($_POST['medicamento']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Escifíque medicamentos: es requerido.";
					$bValidateSuccess=false;
					 }
			     }else{
				$_POST['medicamento']='';
				}
				
	/*	if ($_POST['cbReferido']=="-1"){ 
					$GLOBALS['aPageErrors'][]= "- Referido a otra institución: es requerido.";
					$bValidateSuccess=false;
					 }	  	
					 
		if ($_POST['cbReferido_dps']=="-1"){ 
					$GLOBALS['aPageErrors'][]= "- Referido a servicios de la DPS: es requerido.";
					$bValidateSuccess=false;
					 }	
			
			if ($_POST['cbReferido_dps']=="1"){   
				if ($_POST['cbServicio_dps']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Servicios de la DPSs: es requerido.";
					$bValidateSuccess=false;
					 }
			     }else{
				$_POST['cbServicio_dps']='-1';
				}*/
				
			
			if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;	

			case 'Cancelar':
					?><script> 
				    document.location='?menu=13'</script><?
				  /*unset($_POST['id_po']);
				  unset($_POST['accion']);
				  LoadData($conn,false);*/	
			break;
		
		   	case 'Continuar': 			
			?><script>document.location='index.php?menu=12'</script><?
			break;
	        }
		}		
		else{
		LoadData($conn,false);
		}
}		
//------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	//datos discapacidad
				$_POST['edit']='';
				$aDefaultForm['cbDiscapacidad_afiliado']='-1';
				$aDefaultForm['cbTipo_discapacidad']='-1';
				$aDefaultForm['cbDiscapacidad_nivel']='-1';
				$aDefaultForm['cbDiscapacidad_origen']='-1';
				$aDefaultForm['cbAdquirida']='-1';
				$aDefaultForm['cbDiscapacidad_calificacion']='-1';   
				$aDefaultForm['cbControl_medico']='-1';  
				$aDefaultForm['cbFrecuencia']='-1';
				$aDefaultForm['cbDiscapacidad_certificado']='-1'; 
				$aDefaultForm['cbCertificado']='-1';
				$aDefaultForm['Nro_historia_certificado']='';
				$aDefaultForm['cbDiscapacidad_ayuda']='-1';
				$aDefaultForm['cbTipo_Ayuda_discapacidad']='-1';
				$aDefaultForm['cbDiscapacidad_nivel_depen']='-1';   
				$aDefaultForm['cbMedicado']='-1'; 
				$aDefaultForm['medicamento']='';  
			//	$aDefaultForm['cbReferido']='-1';    
			//	$aDefaultForm['cbReferido_dps']='-1';
				$aDefaultForm['cbReferido_discapacidad']='-1';
				$aDefaultForm['Observaciones_discapacidad']='';	
				unset($_SESSION['aTabla']);
			//	unset($_POST['id_po']);
			//	unset($_POST['accion']);
						        
		if (!$bPostBack){	
				
				if ($_GET['accion']!='') $_POST['accion']=$_GET['accion'];	
				if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];
			
				if ($_POST['accion']=='1'){	
						$_POST['edit']='1';
				$SQL2="select  personas.discapacidad as disc, discapacidad_certificado.id as certificado, persona_discapacidad.*
							from persona_discapacidad
							INNER JOIN personas ON personas.id=persona_discapacidad.persona_id 
							INNER JOIN discapacidad ON discapacidad.id=persona_discapacidad.discapacidad_id 
							left JOIN discapacidad_ayuda ON discapacidad_ayuda.id=persona_discapacidad.discapacidad_ayuda_id 
							INNER JOIN nivel_discapacidad ON nivel_discapacidad.id=persona_discapacidad.nivel_discapacidad 
							left JOIN discapacidad_certificado ON discapacidad_certificado.id=persona_discapacidad.discapacidad_certificado_id 
							where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' and 
							persona_discapacidad.id ='".$_POST['id_po']."'";
							$rs = $conn->Execute($SQL2);
							if ($rs->RecordCount()>0){	
							$aDefaultForm['cbDiscapacidad_afiliado']=$rs->fields['disc'];
							$aDefaultForm['cbTipo_discapacidad']=$rs->fields['discapacidad_id'];
							$aDefaultForm['cbDiscapacidad_nivel']=$rs->fields['nivel_discapacidad'];
							$aDefaultForm['cbDiscapacidad_origen']=$rs->fields['origen_id'];
							$aDefaultForm['cbDiscapacidad_calificacion']=$rs->fields['calificacion']; 
							$aDefaultForm['cbDiscapacidad_certificado']=$rs->fields['certificacion']; 
							$aDefaultForm['cbCertificado']=$rs->fields['certificado']; 
							$aDefaultForm['cbDiscapacidad_ayuda']=$rs->fields['ayuda_tec']; 
							$aDefaultForm['cbTipo_Ayuda_discapacidad']=$rs->fields['discapacidad_ayuda_id'];
							$aDefaultForm['cbDiscapacidad_nivel_depen']=$rs->fields['nivel_dep'];
							$aDefaultForm['Observaciones_discapacidad']=$rs->fields['observaciones_discapacidad']; 
							$aDefaultForm['cbControl_medico']=$rs->fields['control_medico']; 
							$aDefaultForm['cbFrecuencia']=$rs->fields['frecuencia_control'];  
							$aDefaultForm['cbMedicado']=$rs->fields['medicado'];
							$aDefaultForm['medicamento']=$rs->fields['medicamento']; 
						//	$aDefaultForm['cbReferido']=$rs->fields['referido'];  
						//	$aDefaultForm['cbReferido_dps']=$rs->fields['referido_dps'];
							$aDefaultForm['cbReferido_discapacidad']=$rs->fields['referido_servicio_discapacidad_id'];
							?>	
							<script language="javascript" src="../js/jquery.js"></script>
							<script>
							$(document).ready(function(){
							elegido="<?php echo $rs->fields['origen_id']; ?>";
							combo="Discapacidad_origen";
							$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['discapacidad_adquirida_id']; ?>" }, 
							function(data){ $("#cbAdquirida").html(data);
							
								 });            
							});
							</script>
						<?php
					}
			}	
			
			if ($_POST['accion']=='2'){
				  
			$sql="delete  from persona_discapacidad 
					where id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs= $conn->Execute($sql);	
					$_POST['id_po']='';
					$_POST['accion']='';	
					//Trazas------------------------------------------------------------------------------------------------------
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='3';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
				?><script>alert("- Se elimino el registro correctamente"); 
				document.location='?menu=13'</script><?
				
		    	
//-------------------------------------------------------------------------------------------------------
			}
		}
		  else{   
		//datos discapacidad
		$aDefaultForm['cbDiscapacidad_afiliado']=$_POST['cbDiscapacidad_afiliado'];
		$aDefaultForm['cbTipo_discapacidad']=$_POST['cbTipo_discapacidad'];
		$aDefaultForm['cbDiscapacidad_nivel']=$_POST['cbDiscapacidad_nivel'];
		$aDefaultForm['cbDiscapacidad_origen']=$_POST['cbDiscapacidad_origen'];
		$aDefaultForm['cbAdquirida']=$_POST['cbAdquirida'];
		$aDefaultForm['cbDiscapacidad_calificacion']=$_POST['cbDiscapacidad_calificacion'];  
		$aDefaultForm['cbControl_medico']=$_POST['cbControl_medico']; 
		$aDefaultForm['cbFrecuencia']=$_POST['cbFrecuencia'];
		$aDefaultForm['cbDiscapacidad_certificado']=$_POST['cbDiscapacidad_certificado'];  
		$aDefaultForm['cbCertificado']=$_POST['cbCertificado'];
		$aDefaultForm['Nro_historia_certificado']=$_POST['Nro_historia_certificado'];
		$aDefaultForm['cbDiscapacidad_ayuda']=$_POST['cbDiscapacidad_ayuda'];
		$aDefaultForm['cbTipo_Ayuda_discapacidad']=$_POST['cbTipo_Ayuda_discapacidad'];
		$aDefaultForm['cbDiscapacidad_nivel_depen']=$_POST['cbDiscapacidad_nivel_depen'];
		$aDefaultForm['Observaciones_discapacidad']=$_POST['Observaciones_discapacidad'];   
		$aDefaultForm['cbMedicado']=$_POST['cbMedicado']; 
		$aDefaultForm['medicamento']=$_POST['medicamento'];  
	//	$aDefaultForm['cbReferido']=$_POST['cbReferido'];  
	//	$aDefaultForm['cbReferido_dps']=$_POST['cbReferido_dps'];
		$aDefaultForm['cbReferido_discapacidad']=$_POST['cbReferido_discapacidad'];
		}
		
		$SQL1="select  persona_discapacidad.id, personas.discapacidad, discapacidad.nombre as discapacidad, 
							discapacidad_ayuda.nombre as ayuda,
							discapacidad_origen.nombre as origen, nivel_dep, ayuda_tec,
							nivel_discapacidad.nombre as nivel,observaciones_discapacidad
							from persona_discapacidad
							INNER JOIN personas ON personas.id=persona_discapacidad.persona_id 
							INNER JOIN discapacidad ON discapacidad.id=persona_discapacidad.discapacidad_id 
							left JOIN discapacidad_ayuda ON discapacidad_ayuda.id=persona_discapacidad.discapacidad_ayuda_id 
							INNER JOIN nivel_discapacidad ON nivel_discapacidad.id=persona_discapacidad.nivel_discapacidad 
							INNER JOIN discapacidad_origen ON discapacidad_origen.id=persona_discapacidad.origen_id 
							where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' 
							order by persona_discapacidad.id";
							$rs1 = $conn->Execute($SQL1);
					if ($rs1->RecordCount()>0){	
							$aTabla=array();
						while(!$rs1->EOF){
							$c = count($aTabla); 
							$niveldep=$rs1->fields['nivel_dep'];	 
							if($niveldep==1) $_POST['niveldep']='Apoyo intermitente'; 
							if($niveldep==2) $_POST['niveldep']='Apoyo extenso';
							if($niveldep==3) $_POST['niveldep']='Apoyo generalizado';
							if($niveldep==4) $_POST['niveldep']='Sin apoyo';
							$aTabla[$c]['id']=$rs1->fields['id'];
							$aTabla[$c]['discapacidad']=$rs1->fields['discapacidad']; 
							$aTabla[$c]['nivel']=$rs1->fields['nivel'];			
							$aTabla[$c]['ayuda']=$rs1->fields['ayuda'];
							$aTabla[$c]['origen']=$rs1->fields['origen'];
							$aTabla[$c]['niveldep']=$_POST['niveldep'];
							$aTabla[$c]['observaciones_discapacidad']=$rs1->fields['observaciones_discapacidad'];
							$rs1->MoveNext();
		           			 }
			   	$_SESSION['aTabla'] = $aTabla;	
	 		}	
     } 
}

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	
$existe='';
//----------------------------------------------verifica si existe-----------------------------
	if ($_POST['cbTipo_discapacidad']!=''){
	
	$SQL2="SELECT id from persona_discapacidad
			  where persona_id  ='".$_SESSION['id_afiliado']."'
		    and discapacidad_id ='".$_POST['cbTipo_discapacidad']."'";
		   	   
			$rs = $conn->Execute($SQL2);
			if ($rs->RecordCount()>0){	
					$existe='1';
					?><script>alert("- Ya existe un registro con este Tipo de discapacidad");</script><?	
			}
		}

//-----------------------------------------------prepara valores------------------------------------	
if($existe==''){												
				//-----------------------------------------------------actualizar------------------------------------------	
	if ($_POST['edit']=='1'){				
			
			$sql="update persona_discapacidad set 
						origen_id='".$_POST['cbDiscapacidad_origen']."',
						discapacidad_adquirida_id='".$_POST['cbAdquirida']."', 
						nivel_discapacidad='".$_POST['cbDiscapacidad_nivel']."',			 
						discapacidad_ayuda_id='".$_POST['cbTipo_Ayuda_discapacidad']."',
						calificacion='".$_POST['cbDiscapacidad_calificacion']."',  
						control_medico='".$_POST['cbControl_medico']."',  
						frecuencia_control='".$_POST['cbFrecuencia']."',
						certificacion='".$_POST['cbDiscapacidad_certificado']."',
						discapacidad_certificado_id='".$_POST['cbCertificado']."',
						ayuda_tec='".$_POST['cbDiscapacidad_ayuda']."',		
						nivel_dep='".$_POST['cbDiscapacidad_nivel_depen']."',  
						medicado='".$_POST['cbMedicado']."',
						medicamento='".$_POST['medicamento']."',
						referido_servicio_discapacidad_id='".$_POST['cbReferido_discapacidad']."', 						
						observaciones_discapacidad='".$_POST['Observaciones_discapacidad']."',
			  	  updated_at='".$sfecha."',
			   	  status='A',
			   	  id_update='".$_SESSION['sUsuario']."'
				  WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' "; 	
			  	  $conn->Execute($sql);	
				    $_POST['id_po']='';
					$_POST['accion']='';	
					?><script>alert("- Se actualizo el registro correctamente"); 
				    document.location='?menu=13'</script><?
				  }	
				
				
//-------------------------------------------------------------------agregar---------------------------------------								
	else{			 		
			 $sql="insert into public.persona_discapacidad
		 		( persona_id, discapacidad_id, origen_id, discapacidad_adquirida_id, nivel_discapacidad, discapacidad_ayuda_id, calificacion,
				  certificacion, discapacidad_certificado_id, ayuda_tec, nivel_dep, control_medico, frecuencia_control,  medicado, medicamento, referido_servicio_discapacidad_id, observaciones_discapacidad, 
				  created_at, status, id_update) values
			  	('".$_SESSION['id_afiliado']."',
				 '".$_POST['cbTipo_discapacidad']."',
				 '".$_POST['cbDiscapacidad_origen']."',
				 '".$_POST['cbAdquirida']."',
				 '".$_POST['cbDiscapacidad_nivel']."',			 
				 '".$_POST['cbTipo_Ayuda_discapacidad']."', 
				 '".$_POST['cbDiscapacidad_calificacion']."',
				 '".$_POST['cbDiscapacidad_certificado']."',
				 '".$_POST['cbCertificado']."', 
				 '".$_POST['cbDiscapacidad_ayuda']."',
				 '".$_POST['cbDiscapacidad_nivel_depen']."',
				 '".$_POST['cbControl_medico']."', 
				 '".$_POST['cbFrecuencia']."',
				 '".$_POST['cbMedicado']."',
				 '".$_POST['medicamento']."', 
				 '".$_POST['cbReferido_discapacidad']."',
				 '".$_POST['Observaciones_discapacidad']."',
			  	 '$sfecha',
			   	 'A',
			   	 '".$_SESSION['sUsuario']."')";
			$conn->Execute($sql);	
					$_POST['id_po']='';
					$_POST['accion']='';	
					?><script>alert("- Se agrego el registro correctamente"); 
				    document.location='?menu=13'</script><?
			}
					//Trazas-----------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='3';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);			

	
				  unset($_POST['id_po']);
				  unset($_POST['accion']);
    			  LoadData($conn,false);
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
include('menu_trabajador.php'); 
 ?>

<div class="container">
 <? }//-----------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){//action="<?= $_SERVER['PHP_SELF'] ?>" 


<form name="frm_discapacidad" method="post" action="" >
<script>
	function send(saction){
	       if(saction=='Agregar' || saction=='Actualizar'){
		   			if(validar_frm_discapacidad()==true){
					var form = document.frm_discapacidad;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_discapacidad;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>
<script language="javascript"> 
$(document).ready(function(){
   $("#cbDiscapacidad_origen").change(function () {
           $("#cbDiscapacidad_origen option:selected").each(function () {
            elegido=$(this).val();
			combo='Discapacidad_origen';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbAdquirida").html(data);
            });            
        });
   })
});   

</script>

    <input name="action" type="hidden" value=""/>
    <input name="edit" type="hidden" value="<?=$_POST['edit']?>" /> 
    <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
    <input name="accion" type="hidden" value="<?=$_POST['accion']?>" />  
    <input name="cbTipo_discapacidad" type="hidden" value="<?=$_POST['cbTipo_discapacidad']?>" />
   
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
      	  <tr>
       	<td height="25"></td>
      </tr>
      <tr>
        <th colspan="3" class="titulo">SITUACI&Oacute;N DE DISCAPACIDAD </th>
      </tr>
      <tr>
      	<th colspan="3" height="25" class="sub_titulo" align="left">Datos de la situación de discapacidad: </th>
      </tr>
      <tr>
        <td width="46%" align="right" >Tipo de discapacidad: </td>
        <td colspan="2">
          <select name="cbTipo_discapacidad" class="tablaborde_shadow" id="cbTipo_discapacidad" title="Tipo de discapacidad - Seleccione solo una opcion del listado" <? if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;?>>
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadTipo_discapacidad($conn); print $GLOBALS['sHtml_cb_Tipo_discapacidad'];?>
          </select>
          <span class="requerido">* </span></td>
      </tr>
      <tr>
        <td align="right" ><div>Origen de la discapacidad :</div></td>
        <td colspan="2">
        <select name="cbDiscapacidad_origen" class="tablaborde_shadow" id="cbDiscapacidad_origen" title="Origen de la discapacidad - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadDiscapacidad_origen($conn); print $GLOBALS['sHtml_cb_Discapacidad_origen'];?>
          </select>
            <span class="requerido"> * </span></td>
      </tr>
      
      <tr id="div_adquirida">
        <td align="right" >Causa de discapacidad adquirida:</td>
        <td colspan="2"><select name="cbAdquirida" id="cbAdquirida" class="tablaborde_shadow" title="Origen de la discapacidad adquirida - Seleccione solo una opcion del listado">
            <option value="-1">Seleccionar</option>
          </select><span class="requerido"> * </span>   </td>
      </tr>
      <tr>
        <td align="right" >¿Posee calificaci&oacute;n de discapacidad?:</td>
        <td colspan="2"><select name="cbDiscapacidad_calificacion" class="" id="cbDiscapacidad_calificacion" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbDiscapacidad_calificacion'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbDiscapacidad_calificacion'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
      </tr>
      <tr>
        <td align="right" >¿Posee certificaci&oacute;n de discapacidad?: </td>
        <td colspan="2"><select name="cbDiscapacidad_certificado" class="" id="cbDiscapacidad_certificado" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbDiscapacidad_certificado'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbDiscapacidad_certificado'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
        </tr>
        <tr id="td_certificado">  
        <td align="right" >¿Qui&eacute;n certifica?: </td>
        <td>
        <select name="cbCertificado" class="tablaborde_shadow" id="cbCertificado" title="Quien certifica - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadcbCertificado($conn); print $GLOBALS['sHtml_cb_Certificado'];?>
          </select><span class="requerido"> * </span>
          
          </td>
      </tr>
      <tr>
        <td align="right">Grado de discapacidad: </td>
        <td colspan="2">
          <select name="cbDiscapacidad_nivel" class="tablaborde_shadow" id="cbDiscapacidad_nivel" title="Grado de discapacidad - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadDiscapacidad_nivel($conn); print $GLOBALS['sHtml_cb_Discapacidad_nivel'];?>
          </select>
          <span class="requerido">* </span></td>
      </tr>
      <tr>
        <td align="right" >¿Requiere ayuda t&eacute;cnica?: </td>
        <td colspan="2"><select name="cbDiscapacidad_ayuda" class="" id="cbDiscapacidad_ayuda" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbDiscapacidad_ayuda'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbDiscapacidad_ayuda'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
      </tr>
      <tr id="tr_Tipo_Ayuda_discapacidad">
        <td align="right" >¿Tipo de  ayuda técnica: </td>
        <td colspan="2">
          <select name="cbTipo_Ayuda_discapacidad" class="tablaborde_shadow" id="cbTipo_Ayuda_discapacidad" title="Tipo de ayuda tecnica - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadTipo_Ayuda_discapacidad($conn); print $GLOBALS['sHtml_cb_Tipo_Ayuda_discapacidad'];?>
          </select></td>
      </tr>
      <tr id="tr_Nivel_autonomia">
        <td align="right" >Grado de autonom&iacute;a: </td>
        <td colspan="3">
          <select name="cbDiscapacidad_nivel_depen" class="tablaborde_shadow" id="cbDiscapacidad_nivel_depen" title="Grado de autonomia - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbDiscapacidad_nivel_depen'])=='1') print 'selected="selected"';?>>Independiente</option>
            <option value="2" <? if (($aDefaultForm['cbDiscapacidad_nivel_depen'])=='2') print 'selected="selected"';?>>Dependiente</option>
            <option value="3" <? if (($aDefaultForm['cbDiscapacidad_nivel_depen'])=='3') print 'selected="selected"';?>>Semi dependiente</option>
          </select>
        <span class="requerido">  *</span></td>
      </tr>
      <tr>
        <td align="right" >¿Asiste a control m&eacute;dico?:</td>
        <td colspan="2"><select name="cbControl_medico" class="" id="cbControl_medico" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbControl_medico'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbControl_medico'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
      </tr>
      <tr id="tr_frecuencia">
        <td align="right" >Frecuencia con que asiste: </td>
        <td colspan="3">
          <select name="cbFrecuencia" class="tablaborde_shadow" id="cbFrecuencia" title="Frecuencia con que asiste - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbFrecuencia'])=='1') print 'selected="selected"';?>>Mensual</option>
            <option value="2" <? if (($aDefaultForm['cbFrecuencia'])=='2') print 'selected="selected"';?>>Trimestral</option>
            <option value="3" <? if (($aDefaultForm['cbFrecuencia'])=='3') print 'selected="selected"';?>>Semestral </option>
            <option value="4" <? if (($aDefaultForm['cbFrecuencia'])=='4') print 'selected="selected"';?>>Anual </option>
          </select>
        <span class="requerido">  *</span></td>
      </tr>
       <tr>
        <td align="right" >¿Est&aacute; medicado?:</td>
        <td colspan="2"><select name="cbMedicado" class="" id="cbMedicado" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbMedicado'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbMedicado'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
      </tr>
      <tr id="tr_medicamento">
        <td align="right" >Especif&iacute;que los medicamentos: </td>
        <td colspan="2"><input name="medicamento" type="text" class="tablaborde_shadow" id="medicamento" value="<?=$aDefaultForm['medicamento']?>" size="50" maxlength="100" title="Especif&iacute;que medicamentos - Ingrese letras y/o numeros"></td>
      </tr>
      
      <tr>  
        <td align="right" >Referido a: </td>
        <td>
        <select name="cbReferido_discapacidad" class="tablaborde_shadow" id="cbReferido_discapacidad" title="Referido a otro servicios - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadReferido_discapacidad($conn); print $GLOBALS['sHtml_cb_Referido_discapacidad'];?>
          </select>
          
        </td>
        </tr>
      <tr>
        <td align="right" >Observaciones generales: </td>
        <td colspan="2"><input name="Observaciones_discapacidad" type="text" class="tablaborde_shadow" id="Observaciones_discapacidad" value="<?=$aDefaultForm['Observaciones_discapacidad']?>
    " size="50" maxlength="100" onkeyup="mayusculas(this);" title="Observaciones del funcionario que ingresa la informacion - Ingrese letras y/o numeros">      </td>
      </tr>
      <tr>
        <td colspan="3" align="center"><span class="requerido">
            <? if($_POST['edit']==""){ ?>
            <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Agregar</button>
              <? }
             else{ ?>
            <button type="button" name="Actualizar"  id="Actualizar" class="button"  onClick="javascript:send('Agregar');">Actualizar</button>
          </span>
            <? }?>
            <span class="requerido">
            <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
            </span></td>
      </tr>
      </table>
          <table  border="0" align="center"  class="listado formulario" id="tblDetalle" style="width:99%; ">
            <tr align="center">
              <th width="34%" class="labelListColumn">Tipo Discapacidad </th>
              <th width="37%" class="labelListColumn">Grado Discapacidad </th>
              <th width="22%" class="labelListColumn">Origen</th>
              <th width="7%" class="labelListColumn">Acciones</th>
            </tr>
            <?
	$aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $i=0; $i<count($aTabla); $i++){
		if (($i%2) == 0) $class_name = "dataListColumn2";
		else $class_name = "dataListColumn";
		?>
            <tr class="<?=$class_name?>">
              <td class="texto-normal"><div align="left"><?=$aTabla[$i]['discapacidad']?></div></td>
              <td class="texto-normal"><div align="left"><?=$aTabla[$i]['nivel']?></div></td>
              <td class="texto-normal"><div align="left"><?=$aTabla[$i]['origen']?></div></td>
              <td class="texto-normal"><a href="?menu=13&id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="imagenes/pencil_16.png"  border="0" title="Editar" /></a>             
              
             <a href="?menu=13&id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="imagenes/delete_16.png"  border="0" title="Eliminar" /></a> </td>        
            </tr>
            <? } ?>
  </table>
        
  <table width="99%" border="0" align="center">
      <tr>
        <td >&nbsp;</td>
      </tr>
      <tr>
      <td  align="center">
		
    <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
    
    </td>
        
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>
</p>
</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php //include('../footer.php'); ?>
<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
unset($_SESSION['aTabla']); 
$conn->debug = false;
doAction($conn);
debug($settings['debug']=false);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();
//--------------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION['sesiones']);
	}
}
//----------------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
//----------------------------------------------Agregar curso en el combo dependiente de categoria---------------------------					
		case 'Actividad':
			   $_POST['Nuevo_actividad']='1';
		     LoadData($conn,true);
			break;		
		
		case 'btCurso':
			$bValidateSuccess= true;			
			if ($_POST['cbCurso_categoria']!='-1'){	
					if ($_POST['otro_curso']!=''){	
			     				
						$sSQL = "select *  from curso 
						where nombre ='".(ucwords(strtolower($_POST["otro_curso"])))."' and categoria_curso_id='".$_POST['cbCurso_categoria']."' "; 
						$rs = $conn->Execute($sSQL);
						if ($rs->RecordCount()>0){ 
						$_POST['Nuevo_actividad']='';					
						$GLOBALS['aPageErrors'][]= "El curso: ".$_POST['otro_curso']." ya existe.";
						$bValidateSuccess=false;
						}
						else{				
							$sql="insert into public.curso
							  (nombre, categoria_curso_id, status) values
							  ('".(ucwords(strtolower($_POST["otro_curso"])))."',
							   '".$_POST['cbCurso_categoria']."',
							   'A')";
							   $conn->Execute($sql);
								 $_POST['Nuevo_actividad']='';
							}
					}
					else{
							$GLOBALS['aPageErrors'][]="- Especifique el nombre de la nueva actividad de capacitacion";
							$bValidateSuccess=false;
						}
						}
				else{
						$GLOBALS['aPageErrors'][]="- Especifique la categoria de la actividad de capacitacion";
						$bValidateSuccess=false;
				}
			LoadData($conn,true);
			break;
//-----------------------------------------Agregar cursos al trabajador--------------------------------------------					    
			case 'Agregar': 
			$bValidateSuccess=true;	
						
			if ($_POST['cbCapacitacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Ha realizado actividades de capacitación?: es requerido.";
					$bValidateSuccess=false;
					 }
					 
			if ($_POST['cbCapacitacion']=="1"){
					 				 
			if ($_POST['cbCurso_categoria']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Nombre de la categoría de actividad de capacitación: es requerida.";
					$bValidateSuccess=false;
					 } 
			if ($_POST['cbCurso']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Nombre de la actividad de capacitación: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['Instituto_curso']==""){
					$GLOBALS['aPageErrors'][]= "- El Institución o empresa: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['Duracion_curso']==""){
					$GLOBALS['aPageErrors'][]= "- La Duración: es requerida.";
					$bValidateSuccess=false;
					 }
		       else{
			        $sfecha=date('Y-m-d');	
					if ($_POST['f_Duracion_curso']>=$sfecha){
					$GLOBALS['aPageErrors'][]= "- La Fecha de realización: es incorrecta.";
					$bValidateSuccess=false;
					}
			    }
					  
			if ($_POST['cbRelacion_curso']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Relacionado con su oficio principal?: es requerido.";
					$bValidateSuccess=false;
					 }
		
			if ($_POST['cbCentro_capacitacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Categoría de la Entidad Capacitadora: es requerido.";
					$bValidateSuccess=false;
					 }
				/*if ($_POST['cbPrograma_curso']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Curso realizado por programa Social?: es requerido.";
					$bValidateSuccess=false;
					 }*/			
			}				 
				if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;
//----------------------------------------------------------------cancelar----------------------------------			
			case 'Cancelar': 
			?><script> 
				    document.location='?menu=16'</script><?
				/*unset($_POST['id_po']);
				unset($_POST['accion']);
				$_POST['Nuevo_actividad']='';
				LoadData($conn,false);	*/
			break;
		
//----------------------------------------------------------------------continuar-----------------------------------			
			case 'Continuar': 
			if ($_POST['cbCapacitacion']=='0'){
				 	
					$sfecha=date('Y-m-d');
					$sql="delete  from persona_curso_formacion 
					where persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs= $conn->Execute($sql);
				//Trazas------------------------------------------------------------------------------------------------------------			
					$id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='6';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);	
					
				//update personas----------------------------------------------------------------------------------------------------	
					$sql="update personas set
					capacitacion = '".$_POST['cbCapacitacion']."',
					status = 'A',
					updated_at = '".$sfecha."',
					id_update = '".$_SESSION['sUsuario']."'
					WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
					$conn->Execute($sql);	
				}
				
				//sesiones curriculum
					$nNumSeccion = 4;
					$sSQL = "SELECT sesiones FROM personas where id = ".$_SESSION['id_afiliado'];
					$rs = $conn->Execute($sSQL);
					
					if ($rs){
					if ($rs->RecordCount() > 0){
					$rs->fields['sesiones'][$nNumSeccion-1] = 1;
					$sSQL = "update personas set sesiones = '".$rs->fields['sesiones']."' where id = ".$_SESSION['id_afiliado'];
					$rs = $conn->Execute($sSQL);			
						}
					}
				  unset($_POST['id_po']);
				  unset($_POST['accion']);
						
			?><script>document.location='?menu=17'</script><?
			break;

	        }
		}		
		else{
		LoadData($conn,false);
		}
}
//------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm']; 
    
		$_POST['edit']='';
		$aDefaultForm['cbCurso_categoria']='-1';
		$aDefaultForm['cbCurso']='-1';
		$aDefaultForm['curso']='';
		$aDefaultForm['otro_curso']='';
		$aDefaultForm['Instituto_curso']='';
		$aDefaultForm['Duracion_curso']='';
		$aDefaultForm['cbDuracion']='-1';
		$aDefaultForm['f_Duracion_curso']='';
		$aDefaultForm['cbRelacion_curso']='-1';
		$aDefaultForm['cbCentro_capacitacion']='-1';
		/*$aDefaultForm['cbPrograma_curso']='-1';
		$aDefaultForm['Nombre_programa']='';*/
		$aDefaultForm['Observaciones_curso']='';
		$aDefaultForm['cbCapacitacion']='-1';
		unset($_SESSION['aTabla']); 
		
		if (!$bPostBack){
			if ($_GET['accion']!='') $_POST['accion']=$_GET['accion'];	
			if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];	
//---------------Accion editar recarga la pag con los valores del curso seleccionado--------------------------------------------			
			
			if ($_POST['accion']=='1'){	
					$_POST['edit']='1';	
					$_POST['Nuevo_actividad']='';	
				$SQL2="SELECT persona_curso_formacion.*, personas.sesiones
						from persona_curso_formacion 
						INNER JOIN personas ON personas.id=persona_curso_formacion.persona_id 
						INNER JOIN categoria_curso ON categoria_curso.id=persona_curso_formacion.curso_categoria_id 
						INNER JOIN curso ON curso.id=persona_curso_formacion.curso_formacion_id 
						INNER JOIN centro_capacitacion ON centro_capacitacion.id=persona_curso_formacion.centro_capacitacion_id
						where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' and persona_curso_formacion.id ='".$_POST['id_po']."'";
				$rs = $conn->Execute($SQL2);
				if ($rs->RecordCount()>0){	
				$aDefaultForm['cbCurso_categoria']=$rs->fields['curso_categoria_id'];
				$aDefaultForm['cbCurso']=$rs->fields['curso_formacion_id'];
				?>	
				<script language="javascript" src="../js/jquery.js"></script>
				<script>
				$(document).ready(function(){
				elegido="<?php echo $rs->fields['curso_categoria_id']; ?>";
				combo="Curso";
				$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:'<?php echo $aDefaultForm['cbCurso']; ?>' },
				function(data){ $("#cbCurso").html(data);
				 });            
				});
				</script>
				<?php
				$aDefaultForm['Instituto_curso']=$rs->fields['instituto'];
				$aDefaultForm['Duracion_curso']=$rs->fields['duracion'];
				$aDefaultForm['f_Duracion_curso']=$rs->fields['f_realizacion'];
				$aDefaultForm['cbRelacion_curso']=$rs->fields['relacion_oficio'];
				$aDefaultForm['cbCentro_capacitacion']=$rs->fields['centro_capacitacion_id'];
				/*$aDefaultForm['cbPrograma_curso']=$rs->fields['prog_social'];
				$aDefaultForm['Nombre_programa']=$rs->fields['nombre_prog'];*/
				$aDefaultForm['Observaciones_curso']=$rs->fields['observaciones'];
				$_SESSION['sesiones']=$rs1->fields['sesiones'];
				}
			}	
//--------------------------------------Accion eliminar curso del trabajador----------------------			
			if ($_POST['accion']=='2'){
			$sql="delete  from persona_curso_formacion 
					where id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs= $conn->Execute($sql);	
					$_POST['id_po']='';
					$_POST['accion']='';
					//Trazas----------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='6';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
				LoadData($conn,false);
					
				?><script>alert("- Se elimino el registro correctamente"); 
				document.location='?menu=16'</script><?
			
			}
			
						
	 //---------------Select general muestra los valores de la tabla, cursos ya agregados----------------------------------------
		$SQL="select personas.capacitacion
					from personas where id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
		 $rs = $conn->Execute($SQL);
		 if ($rs->RecordCount()>0){	
		 		 $aDefaultForm['cbCapacitacion']=$rs->fields['capacitacion'];
				  
				 if($aDefaultForm['cbCapacitacion']=='1'){

						$SQL1="select persona_curso_formacion.id, instituto, f_realizacion, duracion,  relacion_oficio, prog_social, 
									nombre_prog, curso.nombre as curso, centro_capacitacion.nombre as centro, personas.capacitacion
									from persona_curso_formacion 
									LEFT JOIN personas ON personas.id=persona_curso_formacion.persona_id 
									LEFT JOIN curso ON curso.id=persona_curso_formacion.curso_formacion_id 
									LEFT JOIN centro_capacitacion ON centro_capacitacion.id=persona_curso_formacion.centro_capacitacion_id 
									where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' 
									order by f_realizacion desc";
								$rs1 = $conn->Execute($SQL1);
				
								if ($rs1->RecordCount()>0){	
									
									$aTabla=array();
									while(!$rs1->EOF){
										$c = count($aTabla);  
										$relacion=$rs1->fields['relacion_oficio'];	 
										if($relacion==1) $_POST['relacion']='Si';
										if($relacion==0) $_POST['relacion']='No';	
										/*$programa=$rs1->fields['prog_social'];	 
										if($programa==1) $_POST['programa']='Si';
										if($programa==0) $_POST['programa']='No';*/	
										$aTabla[$c]['id']=$rs1->fields['id']; 
										$aTabla[$c]['instituto']=$rs1->fields['instituto'];
										$aTabla[$c]['f_realizacion']=$rs1->fields['f_realizacion'];
										$aTabla[$c]['duracion']=$rs1->fields['duracion'];	
										$aTabla[$c]['relacion']=$_POST['relacion'];
										/*$aTabla[$c]['programa']=$_POST['programa'];
										$aTabla[$c]['nombre_prog']=$rs1->fields['nombre_prog'];*/
										$aTabla[$c]['curso']=$rs1->fields['curso'];
										$aTabla[$c]['centro']=$rs1->fields['centro'];	
										$rs1->MoveNext();
										 }
			$_SESSION['aTabla'] = $aTabla;	
								}
			 }
		}
			
			
		}
else{   
		$aDefaultForm['cbCurso_categoria']=$_POST['cbCurso_categoria'];
		$aDefaultForm['Instituto_curso']=$_POST['Instituto_curso'];
		$aDefaultForm['Duracion_curso']=$_POST['Duracion_curso'];
		$aDefaultForm['cbDuracion']=$_POST['cbDuracion']; 
		$aDefaultForm['f_Duracion_curso']=$_POST['f_Duracion_curso'];
		$aDefaultForm['cbRelacion_curso']=$_POST['cbRelacion_curso'];
		$aDefaultForm['cbCentro_capacitacion']=$_POST['cbCentro_capacitacion']; 
		/*$aDefaultForm['cbPrograma_curso']=$_POST['cbPrograma_curso']; 
		$aDefaultForm['Nombre_programa']=$_POST['Nombre_programa'];*/
		$aDefaultForm['Observaciones_curso']=$_POST['Observaciones_curso'];
		$aDefaultForm['cbCapacitacion']=$_POST['cbCapacitacion'];
		?>	
		<script language="javascript" src="../js/jquery.js"></script>
		<script>
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbCurso_categoria']; ?>";
		combo="Curso";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:'<?php echo $_POST['cbCurso']; ?>' },
		function(data){ $("#cbCurso").html(data);
		});            
		});
		</script>
		<?php

		}

	}
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
	//-----------------------------------------------------verifica si existe-----------------------------

	$sfecha=date('Y-m-d');
	if($_POST['f_Duracion_curso']=='') $_POST['f_Duracion_curso']='0000-00-00';
	
	//------------------------------------------------actualizar------------------------------------------	
	if ($_POST['edit']=='1'){	
		$sql="update persona_curso_formacion set 
				  curso_categoria_id='".$_POST['cbCurso_categoria']."',
				  curso_formacion_id='".$_POST['cbCurso']."',
				  instituto='".$_POST['Instituto_curso']."', 
				  duracion='".$_POST['Duracion_curso']."',
				  f_realizacion='".$_POST['f_Duracion_curso']."',
				  relacion_oficio='".$_POST['cbRelacion_curso']."',			
				  centro_capacitacion_id='".$_POST['cbCentro_capacitacion']."',
				  observaciones='".$_POST['Observaciones_curso']."',
			  	updated_at='".$sfecha."',
			   	status='A',
			   	id_update='".$_SESSION['sUsuario']."'
				  WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' "; 	
			  	  $conn->Execute($sql);
				  	$_POST['id_po']='';
					$_POST['accion']='';	
					?><script>alert("- Se actualizo el registro correctamente"); 
				    document.location='?menu=16'</script><?
	 }
//---------------------------------------------------------agregar---------------------------------------
	else{					
			$sql="insert into public.persona_curso_formacion
		 		( persona_id, curso_categoria_id, curso_formacion_id, instituto, duracion, f_realizacion, relacion_oficio, centro_capacitacion_id, observaciones, created_at, status, id_update) values
			  	('".$_SESSION['id_afiliado']."',  
				 '".$_POST['cbCurso_categoria']."',
				 '".$_POST['cbCurso']."',
				 '".$_POST['Instituto_curso']."', 
				 '".$_POST['Duracion_curso']."', 
				 '".$_POST['f_Duracion_curso']."', 
				 '".$_POST['cbRelacion_curso']."',				
				 '".$_POST['cbCentro_capacitacion']."',
				 '".$_POST['Observaciones_curso']."',
				 '$sfecha',
				 'A',
				 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql);	
				 	$_POST['id_po']='';
					$_POST['accion']='';	
					?><script>alert("- Se agrego el registro correctamente"); 
				    document.location='?menu=16'</script><?
	}
	

//Trazas----------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='6';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
//-----------------------------------------------------------------------------------------------------------------
							 
			$sql="update personas set
				  capacitacion = '".$_POST['cbCapacitacion']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update = '".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
			  	  $conn->Execute($sql);	
			

		unset($_POST['id_po']);
		unset($_POST['accion']); 
    LoadData($conn,false);	
}
//------------------------------------------------------------------------------------------------------------------------------

function showHeader(){
include('menu_trabajador.php'); 
 ?>

<div class="container">
 <? }

//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){//<?= $_SERVER['PHP_SELF'] ?>

<form name="frm_capacitacion" method="post" action="" >
<script language="javascript"> 
//Categoria capacitacion
$(document).ready(function(){
   $("#cbCurso_categoria").change(function () {
           $("#cbCurso_categoria option:selected").each(function () {
            elegido=$(this).val();
			combo='Curso';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbCurso").html(data);
            });            
        });
   })
});
</script>

<script>
	function send(saction){
	       if(saction=='Agregar'){
		   			if(validar_frm_capacitacion()==true){
					var form = document.frm_capacitacion;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_capacitacion;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>
    <input name="action" type="hidden" value=""/>
    <input name="Nuevo_actividad" type="hidden" value="<?=$_POST['Nuevo_actividad']?>" />
    <input name="cbCurso_categoria" type="hidden" value="<?=$aDefaultForm['cbCurso_categoria']?>" />
    <input name="cbCurso" type="hidden" value="<?=$aDefaultForm['cbCurso']?>" />
    <input name="edit" type="hidden" value="<?=$_POST['edit']?>" /> 
    <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
    <input name="accion" type="hidden" value="<?=$_POST['accion']?>" />

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        	   <tr>
       	<td></td>
       </tr>
		 <tr>
       	<td></td>
       </tr>
	 <tr>
       	<td></td>
       </tr>
	 <tr>
       	<td></td>
       </tr>
        <tr>
          <th colspan="3" class="titulo">CAPACITACI&Oacute;N RECIBIDA</th>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <th colspan="3" class="sub_titulo" align="left">Actividades de capacitaci&oacute;n: </th>
        </tr>
        <tr>
          <td width="44%"><div align="right" class="Estilo13">Ha realizado actividades de capacitación?: </div></td>
          <td width="56%" colspan="2"><select name="cbCapacitacion" class="tablaborde_shadow" id="cbCapacitacion" title="Ha realizado actividad de capacitacion - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccionar</option>
              <option value="1" <? if (($aDefaultForm['cbCapacitacion'])=='1') print 'selected="selected"';?>>Si</option>
              <option value="0" <? if (($aDefaultForm['cbCapacitacion'])=='0') print 'selected="selected"';?>>No</option>
            </select>
          <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_capacitacion1">
          <td height="24"><div align="right" class="Estilo13">Categoria de la actividad capacitación: </div></td>
          <td colspan="2"><span class="links-menu-izq">
            <select name="cbCurso_categoria" id="cbCurso_categoria" class="tablaborde_shadow" title="Categoria de la actividad de capacitacion - Seleccione solo una opcion del listado" <? if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;?>>
              <option value="-1" selected="selected">Seleccionar</option>
              <? LoadCurso_categoria ($conn) ; print $GLOBALS['sHtml_cb_Curso_categoria']; ?>
            </select>
            <span class="requerido">*</span></span></td>
        </tr>
        <tr id="tr_capacitacion2">
          <td height="24"><div align="right" class="Estilo13">Nombre de la actividad de capacitaci&oacute;n:</div></td>
          <td colspan="2" class="links-menu-izq"><span class="requerido">
<select name="cbCurso" id="cbCurso" class="tablaborde_shadow" title="Nombre de la actividad de capacitacion - Seleccione solo una opcion del listado" <? if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;?>>
  <option value="-1">Seleccionar</option>
</select>
*</span></td>
        </tr>
				<? if ($_POST['Nuevo_actividad']=='' and $_POST['edit']!="1"){ ?>
        <tr id="tr_capacitacion">
          <td>&nbsp;</td>
          <td colspan="2"> <button type="button" name="Nuevo_actividad"  id="Nuevo_actividad" class="button" onClick="javascript:send('Actividad');" title="Agregar actividad de capacitacion">Nueva Actividad</button> </td>
        </tr>
				<? }?>
        
        <? if ($_POST['Nuevo_actividad']=='1'){ ?>
        <tr id="tr_capacitacion3">
          <td><div align="right"><span class="links-menu-izq"><i>Nombre de la nueva actividad de capacitación:</i></span></div></td>
          <td colspan="2"><span class="links-menu-izq"><span class="requerido"> </span><span class="requerido">
          <input name="otro_curso" type="text" class="tablaborde_shadow" id="otro_curso" value="<?=$aDefaultForm['otro_curso']?>"size="30" maxlength="100" title="Nombre de la nueva actividad de capacitacion, luego presione el boton + y podra visualizarla en el listado de actividad de capacitacion - Ingrese solo letras y/o numeros"/>
          <input name="btCurso" type="submit" class="link-info" onClick="javascript:send('btCurso')" value="+"/>
          </span></span></td>
        </tr>
        <? } ?>
        <tr id="tr_capacitacion4">
          <td ><div align="right" class="Estilo13">Entidad capacitadora: </div></td>
          <td colspan="2"><input name="Instituto_curso" id="Instituto_curso" type="text" class="tablaborde_shadow" value="<?=$aDefaultForm['Instituto_curso']?>" size="30" maxlength="50" title="Entidad capacitadora - Ingrese solo letras y/o numeros"/>
          <span class="requerido">* </span></td>
        </tr>
        <tr id="tr_capacitacion8">
          <td><div align="right" class="Estilo13">Categoría de la entidad capacitadora: </div></td>
          <td colspan="2"><span class="links-menu-izq">
            <select name="cbCentro_capacitacion" id="cbCentro_capacitacion" class="tablaborde_shadow" title="Categoria de la entidad capacitadora - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadCentro_capacitacion($conn); print $GLOBALS['sHtml_cb_Centro_capacitacion'];?>
            </select>
          <span class="requerido">* </span></span></td>
        </tr>
        <tr id="tr_capacitacion5">
          <td><div align="right" class="Estilo13">Duraci&oacute;n:</div></td>
          <td colspan="2"><input name="Duracion_curso" type="text" class="tablaborde_shadow" id="Duracion_curso" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['Duracion_curso']?>" size="10" maxlength="4" title="Duracion - Ingrese solo numeros"/>            
          Horas <span class="requerido">* </span></td>
        </tr>
        <tr id="tr_capacitacion6">
          <td height="28"><div align="right" class="Estilo13">Fecha
          de realizaci&oacute;n:</div></td>
          <td colspan="2">
		  <input name="f_Duracion_curso" type="text" class="tablaborde_shadow" id="f_Duracion_curso" value="<?=$aDefaultForm['f_Duracion_curso']?>" size="10" readonly/>
                <a href="#" id="f_rangeStart_trigger"><img src="imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                <script type="text/javascript">//<![CDATA[
                             Calendar.setup({
                               inputField : "f_Duracion_curso",
                               trigger    : "f_rangeStart_trigger",
                               onSelect   : function() { this.hide() },
                               showTime   : false,
                               dateFormat : "%Y-%m-%d"
                             });
                           </script>				    </td>
        </tr>
        <tr id="tr_capacitacion7">
          <td><div align="right" class="Estilo13">Relacionada  con su ocupación principal?:</div></td>
          <td colspan="2"><select name="cbRelacion_curso" id="cbRelacion_curso" class="tablaborde_shadow" title="Relacionada con su ocupacion principal - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbRelacion_curso'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbRelacion_curso'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">* </span></td>
        </tr>
        <!--<tr id="tr_capacitacion9">
          <td><div align="right" class="Estilo13">Actividad  realizada en programa social?:</div></td>
          <td colspan="2"><select name="cbPrograma_curso" id="cbPrograma_curso" class="tablaborde_shadow" title="Actividad realizada en programa social - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbPrograma_curso'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbPrograma_curso'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">* </span></td>
        </tr>
        <tr id="tr_capacitacion10">
          <td><div align="right" class="Estilo13">Nombre del programa social: </div></td>
          <td colspan="2"><input name="Nombre_programa" type="text" class="tablaborde_shadow" id="Nombre_programa" value="<?=$aDefaultForm['Nombre_programa']?>" size="30" maxlength="30" title="Nombre del programa social - Ingrese solo letras y/o numeros"/></td>
        </tr>-->
        <tr id="tr_capacitacion11">
          <td height="25"><div align="right" class="Estilo13">Observaciones generales: </div></td>
          <td colspan="2"><input name="Observaciones_curso" type="text" class="tablaborde_shadow" id="Observaciones_curso" value="<?=$aDefaultForm['Observaciones_curso']?>" size="50" maxlength="100" title="Observaciones del funcionario que ingresa la informacion - Ingrese letras y/o numeros" />
          
          </td>
        </tr>
        <tr id="tr_capacitacion12">
          <td height="21">&nbsp;</td>
          <td colspan="2">
		  <span class="requerido">
            <? if($_POST['edit']==""){ ?>
            <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Agregar</button>
              <? }
             else{ ?>
            <button type="button" name="Actualizar"  id="Actualizar" class="button"  onClick="javascript:send('Agregar');">Actualizar</button>
          </span>
            <? }?>
            <span class="requerido">
            <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
            </span>
		  </td>
        </tr>
        <tr id="tr_capacitacion13">
          <td colspan="3">
          		<table  border="0"  align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
              <tr>
                <th class="labelListColumn">Nombre de la Actividad </th>
                <th class="labelListColumn">Instituci&oacute;n o Empresa</th>
                <th class="labelListColumn">Fecha                </th>
                <th class="labelListColumn">Duraci&oacute;n</th>
                <th class="labelListColumn">Relacionado</th>
                <th class="labelListColumn">Centro Capacitación </th>
                <th class="labelListColumn">Acciones</th>
              </tr>
              <?
	$aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $i=0; $i<count($aTabla); $i++){
		if (($i%2) == 0) $class_name = "dataListColumn2";
		else $class_name = "dataListColumn";
		?>
              <tr class="<?=$class_name?>">
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['curso']?>
                </div></td>
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['instituto']?>
                </div></td>
                <td class="texto-normal"><div align="left">
				<? if ($aTabla[$i]['f_realizacion']=='0000-00-00'){ print '0000-00-00';}
				  else { print strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_realizacion']));}
				 ?>
                </div></td>
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['duracion']?>
                </div></td>
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['relacion']?>
                </div></td>
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['centro']?>
                </div></td>
                <td class="texto-normal"><a href="?menu=16.php&id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="imagenes/pencil_16.png"  border="0" title="Editar" /></a> <a href="?menu=16&id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="imagenes/delete_16.png"  border="0" title="Eliminar" /></a></td>
              </tr>
              <? } ?>
            </table>
            <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="center">
              <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>

          </td>
        </tr>
      </table>

</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";


$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
}
?> 

<?php //include('../footer.php'); ?>

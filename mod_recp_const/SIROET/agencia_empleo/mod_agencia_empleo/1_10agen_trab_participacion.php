<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
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
		var_dump($_SESSION['bloq']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
		   		
			case 'cbEstado_org_changed':
			    LoadData($conn,true);
			break;  
					
			case 'cbObjeto_org_changed':
			    LoadData($conn,true);
			break; 
			
			case 'Herramienta':
			   $_POST['Nuevo_herramienta']='1';
		     LoadData($conn,true);
			break;	
			
			case 'btTipo':
			$bValidateSuccess= true;
			
			if ($_POST['otro_tipo']!='' ){		
					$sSQL = "select *  from tipo_organizacion 
					where nombre ='".(ucwords(strtolower($_POST["otro_tipo"])))."'"; 
					$rs = $conn->Execute($sSQL);
				  if ($rs->RecordCount()>0){ 					
					$_POST['Nuevo_herramienta']='';
					$GLOBALS['aPageErrors'][]= "El tipo de organización: ".$_POST['otro_tipo']." ya existe.";
					$bValidateSuccess=false;
					}
     				else{				
						$sql="insert into public.tipo_organizacion
						  (nombre, status) values
						  ('".(ucwords(strtolower($_POST["otro_tipo"])))."',
						   'A')";
						   $conn->Execute($sql);
							 $_POST['Nuevo_herramienta']='';
						  }
						}
					else{
					$GLOBALS['aPageErrors'][]="- Especifique la descripción del tipo de organización";
					 $bValidateSuccess=false;
					}
			LoadData($conn,true);
			break;
			
			case 'cbNo_tiene_changed':
				 $sfecha=date('Y-m-d');
				 
		         $sql="update personas set 
					  consejo_com = '".$_POST['cbParticipacion']."',
					  status = 'A',
					  updated_at = '".$sfecha."',
					  id_update ='".$_SESSION['sUsuario']."'
					  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
					  $conn->Execute($sql);
			//Trazas-------------------------------------------------------------------------------------------------------------------------------				
					$id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='10';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);
//--------------------------------------------------------------------------------------------------------------------------------------
				  if($_SESSION['tipo_usuario']==1){
						if ($_POST['cbParticipacion']=="0"){
						?><script>document.location='1_12agen_trab_foto.php'</script><?
						}
					}
					if($_SESSION['tipo_usuario']==2){
						if ($_POST['cbParticipacion']=="0"){
						?><script>document.location='1_11agen_trab_pdpie.php'</script><?
						}
					}
				  LoadData($conn,true);			  
			break; 
			
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['cbParticipacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Participa usted en algún Consejo Comunal u Organización Comunitaria?: es requerido.";
					$bValidateSuccess=false;
					 }
			
			if ($_POST['cbParticipacion']=="1"){
					 
			if ($_POST['nombre_org']==""){
					$GLOBALS['aPageErrors'][]= "- Nombre: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbObjeto_org']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Tipo de organizacion: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbEstado_org']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Estado: es requerido.";
					$bValidateSuccess=false;
					 }		
			if ($_POST['cbMunicipio_org']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Municipio: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbParroquia_org']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Parroquia: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['sector_org']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Sector: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['direccion_org']==""){  
					$GLOBALS['aPageErrors'][]= "- Dirección: es requerida.";
					$bValidateSuccess=false;
					 }
				}
				
		
			if ($bValidateSuccess){				
				ProcessForm($conn,$conn1);
				}
			
			LoadData($conn,$conn1,true);	
			break;
			
			case 'Cancelar': 
			  unset($_POST['id_po']);
				unset($_POST['accion']);
				$_POST['Nuevo_herramienta']='';
				LoadData($conn,$conn1,false);	
			break;
						
			case 'Continuar': 
			 if($_SESSION['tipo_usuario']==1){
						?><script>document.location='1_12agen_trab_foto.php'</script><?
					}
					if($_SESSION['tipo_usuario']==2){
						?><script>document.location='1_11agen_trab_pdpie.php'</script><?
					}
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
		$aDefaultForm['cbParticipacion']='-1';
		$aDefaultForm['nombre_org']='';
		$aDefaultForm['cbObjeto_org']='-1';
		$aDefaultForm['cbEstado_org']='-1';
		$aDefaultForm['cbMunicipio_org']='-1';
		$aDefaultForm['cbParroquia_org']='-1';
		$aDefaultForm['sector_org']='';
		$aDefaultForm['direccion_org']='';
		$aDefaultForm['telef_org']='';
		$aDefaultForm['observaciones_participacion']='';
		unset($_SESSION['aTabla']);
		
		if (!$bPostBack){
		
			if ($_GET['accion']!='') $_POST['accion']=$_GET['accion'];	
			if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];			
		
		if ($_POST['accion']=='1'){	
				$_POST['edit']='1';	
				$_POST['Nuevo_herramienta']='';
					
				$SQL2="SELECT persona_consejos_comunal.*, personas.consejo_com
						from persona_consejos_comunal 
						INNER JOIN personas ON personas.id=persona_consejos_comunal.persona_id   
						INNER JOIN estado ON estado.id=persona_consejos_comunal.estado_id 
						INNER JOIN municipio ON municipio.id=persona_consejos_comunal.municipio_id 
						INNER JOIN parroquia ON parroquia.id=persona_consejos_comunal.parroquia_id 
						where persona_id ='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."' 
						and persona_consejos_comunal.id ='".$_POST['id_po']."'";
						$rs = $conn->Execute($SQL2);
						if ($rs->RecordCount()>0){	
						$aDefaultForm['cbParticipacion']=$rs->fields['consejo_com'];
						$aDefaultForm['nombre_org']=$rs->fields['nombre_consejo'];
						$aDefaultForm['cbObjeto_org']=$rs->fields['objeto_cc'];
						$aDefaultForm['cbEstado_org']=$rs->fields['estado_id'];
			?>	
			<script language="javascript" src="../js/jquery.js"></script>
			<script>		
		    $(document).ready(function(){
				elegido="<?php echo $rs->fields['estado_id']; ?>";
				combo="Municipio";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['municipio_id']; ?>" }, 
				function(data){ $("#cbMunicipio_org").html(data);
			   });            
			});
				$(document).ready(function(){
				elegido="<?php echo $rs->fields['municipio_id']; ?>";
				combo="Parroquia";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['parroquia_id']; ?>" },
				function(data){  $("#cbParroquia_org").html(data);
			   });            
			});
			</script>
			<?php
						$aDefaultForm['sector_org']=$rs->fields['sector_cc'];
						$aDefaultForm['direccion_org']=$rs->fields['direccion_cc'];
						$aDefaultForm['telef_org']=$rs->fields['telefono_cc'];
						$aDefaultForm['observaciones_participacion']=$rs->fields['observaciones'];
						
					}
			}	
			
			if ($_POST['accion']=='2'){
				$sql="delete  from persona_consejos_comunal 
						WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."'"; 	
						$rs= $conn->Execute($sql);	
						//Trazas-------------------------------------------------------------------------------------------------------------------------------				
					$id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='10';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);
//--------------------------------------------------------------------------------------------------------------------------------------
				}
		}		
else{   
    $aDefaultForm['cbParticipacion']=$_POST['cbParticipacion'];
		$aDefaultForm['nombre_org']=$_POST['nombre_org'];
		$aDefaultForm['cbObjeto_org']=$_POST['cbObjeto_org'];
		$aDefaultForm['cbEstado_org']=$_POST['cbEstado_org'];
		$aDefaultForm['cbMunicipio_org']=$_POST['cbMunicipio_org']; 
		$aDefaultForm['cbParroquia_org']=$_POST['cbParroquia_org'];
		$aDefaultForm['sector_org']=$_POST['sector_org'];
		$aDefaultForm['direccion_org']=$_POST['direccion_org']; 
		$aDefaultForm['telef_org']=$_POST['telef_org']; 
		$aDefaultForm['observaciones_participacion']=$_POST['observaciones_participacion'];
		}
		
		$SQL3="SELECT personas.consejo_com from personas 
				where id ='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."'";
				$rs3 = $conn->Execute($SQL3);
				if ($rs3->RecordCount()>0){	
				$aDefaultForm['cbParticipacion']=$rs3->fields['consejo_com'];
				}
						
		$SQL1="SELECT persona_consejos_comunal.id, nombre_consejo,tipo_organizacion.nombre as objeto_cc, 
		        direccion_cc, personas.consejo_com
				from persona_consejos_comunal 
				INNER JOIN personas ON personas.id=persona_consejos_comunal.persona_id 
				INNER JOIN tipo_organizacion ON tipo_organizacion.id=persona_consejos_comunal.objeto_cc   
				INNER JOIN estado ON estado.id=persona_consejos_comunal.estado_id 
				INNER JOIN municipio ON municipio.id=persona_consejos_comunal.municipio_id 
				INNER JOIN parroquia ON parroquia.id=persona_consejos_comunal.parroquia_id 
			where persona_id ='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				if ($rs1->RecordCount()>0){	
					$aTabla=array();
					while(!$rs1->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['id']=$rs1->fields['id']; 
						$aTabla[$c]['nombre_consejo']=$rs1->fields['nombre_consejo'];
						$aTabla[$c]['objeto_cc']=$rs1->fields['objeto_cc'];	
						$aTabla[$c]['direccion_cc']=$rs1->fields['direccion_cc'];
						$rs1->MoveNext();
						 }
						 						 
			$_SESSION['aTabla'] = $aTabla;								
			}	
	}
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
		$sfecha=date('Y-m-d');
if($_POST['cbParticipacion']=='1'){
//--------------------------------------------------------------------------actualizar------------------------------------------	
if ($_POST['edit']=='1'){					 
		$sql="update persona_consejos_comunal set 
				  nombre_consejo='".$_POST['nombre_org']."',
				  objeto_cc='".$_POST['cbObjeto_org']."', 
				  estado_id='".$_POST['cbEstado_org']."',
				  municipio_id='".$_POST['cbMunicipio_org']."',
				  parroquia_id='".$_POST['cbParroquia_org']."',				 
				  sector_cc='".$_POST['sector_org']."',
				  direccion_cc='".$_POST['direccion_org']."',
				  telefono_cc='".$_POST['telef_org']."',
				  observaciones='".$_POST['observaciones_participacion']."',
					updated_at='".$sfecha."',
					status='A',
					id_update='".$_SESSION['sUsuario']."'
					WHERE id='".$_POST['id_po']."'"; 	
					$conn->Execute($sql);
					unset($_POST['id_po']);
					unset($_POST['accion']);
	}
			
//--------------------------------------------------agregar---------------------------------------				
	else{

//----------------------------------------------verifica si existe-----------------------------	
	$SQL2="SELECT id from persona_consejos_comunal
			where persona_id  ='".$_SESSION['id_afiliado']."'
		  and nombre_consejo ='".$_POST['nombre_org']."' and objeto_cc='".$_POST['cbObjeto_org']."'";
			$rs = $conn->Execute($SQL2);
			if ($rs->RecordCount()>0){	
					$existe='1';
					?><script>alert("- Ya existe un tipo de organizacion con este nombre");</script><?	
			}
		  else{
		
				$sql="insert into public.persona_consejos_comunal
		 		( persona_id, nombre_consejo,objeto_cc, estado_id, municipio_id, parroquia_id, sector_cc, direccion_cc,
				 telefono_cc, observaciones, created_at, status, id_update) values
			  	('".$_SESSION['id_afiliado']."',
				 '".$_POST['nombre_org']."', 
				 '".$_POST['cbObjeto_org']."', 
				 '".$_POST['cbEstado_org']."', 
				 '".$_POST['cbMunicipio_org']."',
				 '".$_POST['cbParroquia_org']."',	
				 '".$_POST['sector_org']."',
				 '".$_POST['direccion_org']."',
				 '".$_POST['telef_org']."',
				 '".$_POST['observaciones_participacion']."',
			  	 '$sfecha',
			   	 'A',
			   	 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql);
			}
			
	}
				//Trazas------------------------------------------------------------------------------------------------------------------			
				    $id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='10';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);
//------------------------------------------------------------------------------------------------------------------------
						
			$sql1="update personas set
				  consejo_com = '".$_POST['cbParticipacion']."', 
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
			  	$conn->Execute($sql1);	
					
					
				unset($_POST['id_po']);
				unset($_POST['accion']); 
				LoadData($conn,false);	
}
else{
		 ?><script>alert("- Debe indicar que SI participa en alguna organizacion comunitaria");</script><?
	
	}



	}
	
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<style type="text/css">
<!--
.Estilo12 {color: #030303}
-->
</style>
<form name="frm_participacion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
  <script>
	//Municipio---Parroquia org
$(document).ready(function(){
   $("#cbEstado_org").change(function () {
           $("#cbEstado_org option:selected").each(function () {
            elegido=$(this).val();
			combo='Municipio';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbMunicipio_org").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbMunicipio_org").change(function () {
           $("#cbMunicipio_org option:selected").each(function () {
            elegido=$(this).val();
			combo='Parroquia';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbParroquia_org").html(data);
            });            
        });
   })
});

	function send(saction){
	       if(saction=='Agregar'){
		   			if(validar_frm_participacion()==true){
					var form = document.frm_participacion;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_participacion;
					form.action.value=saction;
					form.submit();				
			}		
	}
  </script>
    <input name="action" type="hidden" value=""/>
    <input name="Nuevo_herramienta" type="hidden" value="<?=$_POST['Nuevo_herramienta']?>" />
    <input name="nombre_org" type="hidden" value="<?=$aDefaultForm['nombre_org']?>" />
    <input name="cbObjeto_org" type="hidden" value="<?=$aDefaultForm['cbObjeto_org']?>" />
    <input name="edit" type="hidden" value="<?=$_POST['edit']?>" /> 
    <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
    <input name="accion" type="hidden" value="<?=$_POST['accion']?>" />  

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
	    <tr>
          <th colspan="2" class="titulo">Participaci&oacute;n Social y Comunitaria </th>
        </tr>
        <tr>
          <th colspan="2" class="sub_titulo" align="left">Consejos Comunales u Organización Comunitaria: </th>
        </tr>
        <tr>
          <td width="41%"><div align="right"> Participa usted en alg&uacute;n organización del Poder Popular?: </div></td>
          <td width="59%"><select name="cbParticipacion" class="tablaborde_shadow" onChange="javascript:send('cbNo_tiene_changed');" id="cbParticipacion" title="Participaci&oacute;n social y comunitaria - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if ($aDefaultForm['cbParticipacion']=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if ($aDefaultForm['cbParticipacion']=='0') print 'selected="selected"';?>>No</option>
          </select>
		  <span class="requerido"> *</span> </td>
        </tr>
        <tr id="tr_participacion1">
          <td><div align="right"> Nombre:  </div></td>
          <td><input name="nombre_org" type="text" class="tablaborde_shadow" id="nombre_org" value="<?=$aDefaultForm['nombre_org']?>" size="30" maxlength="30" <? if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;?>  title="Nombre - Ingrese solo letras y/o numeros"/>
          <span class="links-menu-izq"> </span><span class="requerido"> *</span></td>
        </tr>
        <tr id="tr_participacion2">
          <td><div align="right"> Tipo de organizaci&oacute;n:  </div></td>
          <td>
		  <select name="cbObjeto_org" class="tablaborde_shadow" id="cbObjeto_org" <? if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;?>  title="Tipo de organizaci&oacute;n - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadObjeto_org($conn); print $GLOBALS['sHtml_cb_Objeto_org'];?>
            </select>

          <span class="links-menu-izq"> </span><span class="requerido"> *</span></td>
        </tr>
        <tr>
        <td></td>
        <td><? if ($_POST['Nuevo_herramienta']=='' and $_POST['edit']!="1"){ ?><button type="button" name="Nuevo_herramienta"  id="Nuevo_herramienta" class="button" onClick="javascript:send('Herramienta');" title="Agregar un nuevo tipo de organizaci&oacute;n">Nueva organizaci&oacute;n</button><? }?> </td>
        </tr>
        <? if ($_POST['Nuevo_herramienta']=='1'){ ?>
        <tr id="tr_participacion3">
          <td><div align="right"><span class="links-menu-izq"><i>Agregar otro tipo de organización:</i></span></div></td>
          <td><span class="requerido">
            <input name="otro_tipo" type="text" class="tablaborde_shadow" id="otro_tipo" value="<?=$aDefaultForm['otro_tipo']?>"size="30" maxlength="100" />
            <input name="btTipo" type="submit" class="link-info" onClick="javascript:send('btTipo')" value="+"/>
          </span></td>
        </tr>
        <? } ?>
        <tr id="tr_participacion4">
          <td><div align="right"> Estado: </div></td>
          <td><span class="links-menu-izq">
            <select name="cbEstado_org" id="cbEstado_org" class="tablaborde_shadow" title="Estado - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccionar</option>
              <? LoadEstado_org ($conn) ; print $GLOBALS['sHtml_cb_Estado_org']; ?>
            </select>
          </span><span class="requerido"> *</span></td>
        </tr>
        <tr id="tr_participacion5">
          <td><div align="right"> Municipio: </div></td>
          <td><span class="links-menu-izq">
            <select name="cbMunicipio_org" id="cbMunicipio_org" class="tablaborde_shadow" title="Municipio - Seleccione solo una opcion del listado">
              <option value="-1">Seleccionar</option>
            </select>
          </span><span class="requerido"> *</span></td>
        </tr>
        <tr id="tr_participacion6">
          <td><div align="right"> Parroquia: </div></td>
          <td><span class="links-menu-izq">
            <select name="cbParroquia_org" id="cbParroquia_org" class="tablaborde_shadow" title="Parroquia - Seleccione solo una opcion del listado">
              <option value="-1">Seleccionar</option>
            </select>
          </span><span class="requerido"> *</span></td>
        </tr>
        <tr id="tr_participacion7">
          <td><div align="right"> Sector: </div></td>
          <td><input name="sector_org" type="text" class="tablaborde_shadow" id="sector_org" value="<?=$aDefaultForm['sector_org']?>" size="30" maxlength="30" title="Sector - Ingrese solo letras y/o numeros" />
          <span class="links-menu-izq"> </span><span class="requerido"> *</span></td>
        </tr>
        <tr id="tr_participacion8">
          <td><div align="right"> Direcci&oacute;n: </div></td>
          <td><input name="direccion_org" type="text" class="tablaborde_shadow" id="direccion_org" value="<?=$aDefaultForm['direccion_org']?>" size="30" maxlength="30" title="Direcci&oacute;n - Ingrese solo letras y/o numeros"/>
          <span class="links-menu-izq"> </span><span class="requerido"> *</span></td>
        </tr>
        <tr id="tr_participacion9">
          <td><div align="right"> Tel&eacute;fono: </div></td>
          <td><input name="telef_org" type="text" class="tablaborde_shadow" id="telef_org" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['telef_org']?>" size="30" maxlength="11" title="Telefono - Ingrese solo numeros"/></td>
        </tr>
        <tr id="tr_participacion10">
          <td><div align="right"> Observaciones generales:  </div></td>
          <td><textarea name="observaciones_participacion" cols="28" class="tablaborde_shadow" id="observaciones_participacion" title="Observaciones - Ingrese solo letras y/o numeros"><?=$aDefaultForm['observaciones_participacion']?></textarea></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr id="tr_participacion11">
        <td colspan="2" align="center"><span class="requerido">
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
        <tr id="tr_participacion12">
          <td colspan="2">
          
           <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
              <tr>
                <th width="30%" class="labelListColumn">Nombre</th>
                <th width="31%" class="labelListColumn">Tipo de Organización </th>
                <th width="32%" class="labelListColumn">Dirección</th>
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
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['nombre_consejo']?>
                </div></td>
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['objeto_cc']?>
                </div></td>
                <td class="texto-normal"><div align="left">
                  <?=$aTabla[$i]['direccion_cc']?>
                </div></td>
                <td class="texto-normal"><a href="1_10agen_trab_participacion.php?id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="../imagenes/pencil_16.png" border="0" title="Editar" /></a> <a href="1_10agen_trab_participacion.php?id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="../imagenes/delete_16.png" border="0" title="Eliminar" /></a> </td>
              </tr>
              <? } ?>
            </table>
            <p>&nbsp;</p></td>
        </tr>
        <tr id="tr_participacion13">
          <td>&nbsp;</td>
          <td><div align="right"><span class="requerido"></span></div></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
               <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>

          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
      <p></div>
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

<?php include('../footer.php'); ?>

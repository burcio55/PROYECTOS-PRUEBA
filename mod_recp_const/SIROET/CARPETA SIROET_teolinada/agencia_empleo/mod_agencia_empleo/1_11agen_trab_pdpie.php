<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname_recibos,$username_recibos,$password_recibos,$db4);
$conn1->debug = false;

$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug =false;
$conn1->debug =false;


doAction($conn,$conn1);
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
		var_dump($_SESSION['sesiones']);
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
function doAction($conn,$conn1){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
			case 'btRif':
			$bValidateSuccess= true;	
			
				if ($_POST['rif_pdpie']!="" and !ereg ("([J?V?G?E]{1}[0-9]{9})", $_POST['rif_pdpie'])) { 
				$GLOBALS['aPageErrors'][]= "- El Rif: debe ser Comenzar con J, V, G, E seguido de Nueve digitos numericos.";
				$bValidateSuccess=false;
				}
				else{
					$SQL = "SELECT sdenominacion_comercial, srazon_social, snil, ntelefono_local, sdireccion_fiscal, semail
					FROM rnee.rnee_empresa 
					WHERE srif ='".$_POST['rif_pdpie']."'";				
					$rs3 = $conn1->Execute($SQL);										
					if ($rs3->RecordCount()>0){ 
					//	$_POST['rif']=$rs3->fields['srif'];
					$_POST['empresa_pdpie']=htmlspecialchars($rs3->fields['srazon_social'], ENT_QUOTES);	
					$_POST['snil']=$rs3->fields['snil'];	
					$_POST['ntelefono_local']=$rs3->fields['ntelefono_local'];	
					$_POST['sdireccion_fiscal']=$rs3->fields['sdireccion_fiscal'];	
					$_POST['semail']=$rs3->fields['semail'];	
					}
					else{				
					$GLOBALS['aPageErrors'][]= "Esta empresa no se encuentra inscrita en el Registro Nacional de Empresas y Establecimientos.";
					$bValidateSuccess=false;
					}
			}
			
			LoadData($conn,$conn1,true);
			break;
			
			case 'Cancelar':
				unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn,false);	
				break;
		
		   	case 'Continuar': 			
				?><script>document.location='1_15agen_trab_prevision_social.php'</script><?
				break;
		    
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['rif_pdpie']==""){
					$GLOBALS['aPageErrors'][]= "- Rif: es requerido.";
					$bValidateSuccess=false;
					 }
		/*	else{
			   if ($_POST['rif_pdpie']!="" and !ereg ("([J?V?G?E]{1}[-]{1}[0-9]{8}[-]{1}[0-9]{1})", $_POST['rif_pdpie'])) { 
			   $GLOBALS['aPageErrors'][]= "- El Rif: debe ser Comenzar con J, V, G, E - ocho digitos numericos - un digito numericos.";
			   $bValidateSuccess=false;
			   }
			  }*/
			if ($_POST['empresa_pdpie']==""){
					$GLOBALS['aPageErrors'][]= "- Nombre de la Empresa: es requerido.";
					$bValidateSuccess=false;
					 } 
			if ($_POST['cbSector_empleo']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Sector empleador: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['ivss_pdpie']==""){
					$GLOBALS['aPageErrors'][]= "- Nro. afiliación IVSS: es requerido.";
					$bValidateSuccess=false;
					 }		

			if ($_POST['cargo_pdpie']==""){  
					$GLOBALS['aPageErrors'][]= "- El cargo: es requerido.";
					$bValidateSuccess=false; 
					 }
			if ($_POST['salario_pdpie']==""){  
					$GLOBALS['aPageErrors'][]= "- Salario: es requerida.";
					$bValidateSuccess=false; 
					 }
			if ($_POST['cbMotivo_retiro_pdpie']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Causales de terminación de la relación de trabajo: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['f_culminacion_pdpie']==""){  
					$GLOBALS['aPageErrors'][]= "- Fecha de terminación de relación de trabajo: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['f_solicitud_pdpie']=="1"){
					$GLOBALS['aPageErrors'][]= "- Fecha de solicitud de trámite: es requerida.";
					$bValidateSuccess=false;
					} 
				
	/*	validacion fecha de culminacion y fecha tramite	
	
	      if($_POST['f_culminacion_pdpie']!='' and $_POST['f_solicitud_pdpie']!=''){
				$dias	= (strtotime($_POST['f_culminacion_pdpie'])-strtotime($_POST['f_solicitud_pdpie']))/86400;
				$dias 	= abs($dias); $dias = floor($dias);		
				echo $dias;
				
				if($dias>=60){
				
				  $GLOBALS['aPageErrors'][]= "- La Fecha de terminacion de trabajo se encuentra extemporaneo con la fecha del tramite: han transcurrido $dias dias.";
					$bValidateSuccess=false;
				  }
				}	*/


			if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;
				
	     }
		}		
		else{
		LoadData($conn,false);
		}
}	

//------------------------------------------------------------------------------
function LoadData($conn,$conn1,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
    
		$_POST['edit']='';
		$aDefaultForm['f_solicitud_pdpie']='';
		$aDefaultForm['empresa_pdpie']=''; 
		$aDefaultForm['snil'];	
		$aDefaultForm['ntelefono_local'];	
		$aDefaultForm['sdireccion_fiscal'];	
		$aDefaultForm['semail'];	
		$aDefaultForm['cbSector_empleo']='-1';
		$aDefaultForm['rif_pdpie']='';
		$aDefaultForm['ivss_pdpie']='';
		$aDefaultForm['cargo_pdpie']='';
		$aDefaultForm['salario_pdpie']='';
		$aDefaultForm['cbMotivo_retiro_pdpie']='-1';
		$aDefaultForm['f_culminacion_pdpie']='';
		$aDefaultForm['observaciones_pdpie']='';
		$aDefaultForm['cbReferido']='-1';
		$aDefaultForm['cbMotivo_referido']='-1';
		unset($_SESSION['aTabla']);
		
		if (!$bPostBack){
		
			if ($_GET['accion']!='') $_POST['accion']=$_GET['accion'];	
				if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];
			
				if ($_POST['accion']=='1'){	
						$_POST['edit']='1';		
				$SQL2="SELECT persona_pdpie.*
						from persona_pdpie 
						INNER JOIN personas ON personas.id=persona_pdpie.persona_id 
						INNER JOIN motivo_retiro ON motivo_retiro.id=persona_pdpie.motivo_retiro_id 
						INNER JOIN sector_empleo ON sector_empleo.id=persona_pdpie.sector_empleo_id 
				where persona_id ='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."' and persona_pdpie.id ='".$_POST['id_po']."'";
						$rs = $conn->Execute($SQL2);
						if ($rs->RecordCount()>0){	
						$aDefaultForm['f_solicitud_pdpie']=$rs->fields['f_tramitacion'];
						$aDefaultForm['empresa_pdpie']=$rs->fields['empresa'];
						$aDefaultForm['snil']=$rs->fields['snil'];	
						$aDefaultForm['ntelefono_local']=$rs->fields['ntelefono_local'];	
						$aDefaultForm['sdireccion_fiscal']=$rs->fields['sdireccion_fiscal'];	
						$aDefaultForm['semail']=$rs->fields['semail'];
						$aDefaultForm['cbSector_empleo']=$rs->fields['sector_empleo_id'];
						$aDefaultForm['rif_pdpie']=$rs->fields['rif'];
						$aDefaultForm['ivss_pdpie']=$rs->fields['ivss'];
						$aDefaultForm['cargo_pdpie']=$rs->fields['cargo'];
						$aDefaultForm['salario_pdpie']=$rs->fields['salario'];
						$aDefaultForm['f_culminacion_pdpie']=$rs->fields['f_culminacion'];
						$aDefaultForm['observaciones_pdpie']=$rs->fields['observaciones'];  
						$aDefaultForm['cbReferido']=$rs->fields['referido_ppie_id'];
						$aDefaultForm['cbMotivo_referido']=$rs->fields['motivo_referido_ppie_id'];
						
						?>	
							<script language="javascript" src="../js/jquery.js"></script>
							<script>
							$(document).ready(function(){
							elegido="<?php echo $rs->fields['sector_empleo_id']; ?>";
							combo="Motivo_retiro";
							$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['motivo_retiro_id']; ?>" }, 
							function(data){ $("#cbMotivo_retiro_pdpie").html(data);
							
								 });            
							});
							</script>
						<?php
						
					}
			}	
			
			if ($_POST['accion']=='2'){
				$_SESSION['id_po']=$_GET['id_po'];
				$sql="delete  from persona_pdpie 
						WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."'"; 	
						$rs= $conn->Execute($sql);						
						unset($_POST['id_po']);			
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				    $id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='11';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);
//-------------------------------------------------------------------------------------------------------------------------------------
			}
		}		
else{   
    $aDefaultForm['f_solicitud_pdpie']=$_POST['f_solicitud_pdpie'];
		$aDefaultForm['empresa_pdpie']=$_POST['empresa_pdpie']; 
		$aDefaultForm['snil']=$_POST['snil']; 
		$aDefaultForm['ntelefono_local']=$_POST['ntelefono_local']; 
		$aDefaultForm['sdireccion_fiscal']=$_POST['sdireccion_fiscal']; 
		$aDefaultForm['semail']=$_POST['semail']; 	
		$aDefaultForm['cbSector_empleo']=$_POST['cbSector_empleo'];
		$aDefaultForm['rif_pdpie']=$_POST['rif_pdpie'];
		$aDefaultForm['ivss_pdpie']=$_POST['ivss_pdpie'];
		$aDefaultForm['cargo_pdpie']=$_POST['cargo_pdpie']; 
		$aDefaultForm['salario_pdpie']=$_POST['salario_pdpie']; 
		$aDefaultForm['cbMotivo_retiro_pdpie']=$_POST['cbMotivo_retiro_pdpie']; 
		$aDefaultForm['f_culminacion_pdpie']=$_POST['f_culminacion_pdpie'];
		$aDefaultForm['observaciones_pdpie']=$_POST['observaciones_pdpie']; 
		$aDefaultForm['cbReferido']=$_POST['cbReferido']; 
		$aDefaultForm['cbMotivo_referido']=$_POST['cbMotivo_referido']; 
		
		}
			
		$SQL1="SELECT persona_pdpie.*, 
				motivo_retiro.nombre as motivo
				from persona_pdpie 
				INNER JOIN personas ON personas.id=persona_pdpie.persona_id 
				INNER JOIN motivo_retiro ON motivo_retiro.id=persona_pdpie.motivo_retiro_id 
				where persona_pdpie.persona_id='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				if ($rs1->RecordCount()>0){	
					$aTabla=array();
					while(!$rs1->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['id']=$rs1->fields['id']; 
						$aTabla[$c]['f_tramitacion']=$rs1->fields['f_tramitacion'];
						$aTabla[$c]['empresa']=$rs1->fields['empresa'];
						$aTabla[$c]['rif']=$rs1->fields['rif'];	
						$aTabla[$c]['cargo_pdpie']=$rs1->fields['cargo'];
						$aTabla[$c]['motivo']=$rs1->fields['motivo'];
						$aTabla[$c]['f_culminacion']=$rs1->fields['f_culminacion'];
						$aTabla[$c]['cbReferido']=$rs1->fields['referido_ppie_id'];
						$rs1->MoveNext();
						 }
						 
			$_SESSION['aTabla'] = $aTabla;								
			}	
	}
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	
if($_POST['snil']=='')$_POST['snil']=0;	
if($_POST['ntelefono_local']=='')$_POST['ntelefono_local']=0;	

				//-----------------------------------------------------actualizar------------------------------------------	
	if ($_POST['edit']=='1'){	
			$sql="update persona_pdpie set 
						cargo='".$_POST['cargo_pdpie']."',
						salario='".$_POST['salario_pdpie']."',
						f_tramitacion='".$_POST['f_solicitud_pdpie']."',
						motivo_retiro_id='".$_POST['cbMotivo_retiro_pdpie']."',
						f_culminacion='".$_POST['f_culminacion_pdpie']."',				 
						observaciones='".$_POST['observaciones_pdpie']."',
						empresa='".$_POST['empresa_pdpie']."', 
						snil='".$_POST['snil']."',	
						ntelefono_local='".$_POST['ntelefono_local']."',  
						sdireccion_fiscal='".$_POST['sdireccion_fiscal']."',   
						semail='".$_POST['semail']."',   
						rif='".$_POST['rif_pdpie']."',
						ivss='".$_POST['ivss_pdpie']."', 
						sector_empleo_id='".$_POST['cbSector_empleo']."',  
						referido_ppie_id='".$_POST['cbReferido']."', 
						motivo_referido_ppie_id='".$_POST['cbMotivo_referido']."', 
						updated_at='".$sfecha."',
						status='A',
						id_update='".$_SESSION['sUsuario']."'
						WHERE id='".$_POST['id_po']."'"; 	  
						$conn->Execute($sql);	
	}
	//-------------------------------------------------------------------agregar---------------------------------------								
	else{
		   $sql="insert into public.persona_pdpie
		 		( persona_id, cargo, salario, f_tramitacion,
				 motivo_retiro_id, f_culminacion, 
				 observaciones, empresa, rif, ivss, snil,	ntelefono_local, sdireccion_fiscal, semail, sector_empleo_id, referido_ppie_id, motivo_referido_ppie_id, created_at, status, id_update) values
			  	('".$_SESSION['id_afiliado']."',
				 '".$_POST['cargo_pdpie']."',
				 '".$_POST['salario_pdpie']."', 
				 '".$_POST['f_solicitud_pdpie']."',
				 '".$_POST['cbMotivo_retiro_pdpie']."',
				 '".$_POST['f_culminacion_pdpie']."',
				 '".$_POST['observaciones_pdpie']."',
				 '".$_POST['empresa_pdpie']."',
				 '".$_POST['rif_pdpie']."', 
				 '".$_POST['ivss_pdpie']."', 
				 '".$_POST['snil']."',
				 '".$_POST['ntelefono_local']."',
				 '".$_POST['sdireccion_fiscal']."',
				 '".$_POST['semail']."',
				 '".$_POST['cbSector_empleo']."', 
				 '".$_POST['cbReferido']."', 
				 '".$_POST['cbMotivo_referido']."',
			  	 '$sfecha',
			   	 'A',
			   	 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql);	
		}
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
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
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="frm_ppie" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
	function send(saction){
	       if(saction=='Agregar' || saction=='Actualizar'){
		   			if(validar_frm_ppie()==true){
					var form = document.frm_ppie;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_ppie;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>
<script language="javascript"> 
$(document).ready(function(){
   $("#cbSector_empleo").change(function () {
           $("#cbSector_empleo option:selected").each(function () {
            elegido=$(this).val();
			combo='Motivo_retiro';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbMotivo_retiro_pdpie").html(data);
            });            
        });
   })
});   

</script>
    <input name="action" type="hidden" value=""/>
    <input name="edit" type="hidden" value="<?=$_POST['edit']?>" /> 
    <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
    <input name="accion" type="hidden" value="<?=$_POST['accion']?>" /> 

        <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th colspan="3" class="titulo">Prestaci&oacute;n por p&eacute;rdida involuntaria del empleo</th>
        </tr>
	      <tr>
        <th colspan="3" class="sub_titulo" align="left">Datos de la entidad de Trabajo:</th>
        </tr>
        <tr>
        <td><div align="right">RIF:</div></td>
        <td><input name="rif_pdpie" type="text" class="tablaborde_shadow" id="rif_pdpie" value="<?=$aDefaultForm['rif_pdpie']?>" size="20" maxlength="10" title="RIF - Ingrese J, V, G, E en mayuscula seguido de nueve digitos numericos, Ejm: J123456789, V123456789, E123456789, G123456789 "/>
        <span class="requerido">
        <button type="submit" name="btRif"  id="btRif" class="button"  onclick="javascript:send('btRif');" title="Buscar en el Registro Nacional de Entidades de Trabajo">Buscar en Rnee</button>

        </span></td>
        </tr>
        <tr>
        <td width="40%"><div align="right">Patrono(a) &oacute; entidad de trabajo:</div></td>
        <td width="60%"><input name="empresa_pdpie" type="text" class="tablaborde_shadow" id="empresa_pdpie" value="<?=$aDefaultForm['empresa_pdpie']?>" size="50" maxlength="100"  title="Nombre del (de la) patrono(a) o entidad de trabajo - Ingrese solo letras y/o numeros" />
        <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right">NIL:</div></td>
          <td><input name="snil" type="text" class="tablaborde_shadow" id="snil" value="<?=$aDefaultForm['snil']?>" size="20" maxlength="20"  title="Nil - Ingrese solo numeros" /></td>
        </tr>
        <tr>
          <td><div align="right">Direcci&oacute;n:</div></td>
          <td><input name="sdireccion_fiscal" type="text" class="tablaborde_shadow" id="sdireccion_fiscal" value="<?=$aDefaultForm['sdireccion_fiscal']?>" size="50" maxlength="100"  title="Direccion - Ingrese letras y/o numeros" /></td>
        </tr>
        <tr>
          <td><div align="right">Tel&eacute;fono:</div></td>
          <td><input name="ntelefono_local" type="text" class="tablaborde_shadow" id="ntelefono_local" value="<?=$aDefaultForm['ntelefono_local']?>" size="20" maxlength="20"  title="Direccion - Ingrese solo numeros" /></td>
        </tr>
        <tr>
          <td><div align="right">Correo:</div></td>
          <td><input name="semail" type="text" class="tablaborde_shadow" id="semail" value="<?=$aDefaultForm['semail']?>" size="50" maxlength="100"  title="Correo - Ingrese letras y/o numeros" /></td>
        </tr>
        <tr id="tr_experiencia4">
        <td><div align="right">Sector empleador: </div></td>
        <td><span class="links-menu-izq">
        <select name="cbSector_empleo" class="tablaborde_shadow" id="cbSector_empleo" title="Sector empleador - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo'];?>
        </select>
        <span class="requerido"> *</span></span></td>
        </tr>
         <tr>
          <td><div align="right">Nro. de Empleador: </div></td>
          <td colspan="2"><input name="ivss_pdpie" type="text" class="tablaborde_shadow" id="ivss_pdpie" value="<?=$aDefaultForm['ivss_pdpie']?>" size="30" maxlength="20" />
          <span class="requerido">*</span></td>
        </tr>
        
        
        
        <tr>
          <th colspan="3" class="sub_titulo" align="left">PPIE:</th>
        </tr>
        <tr>
          <td><div align="right">Causales de terminaci&oacute;n de la relaci&oacute;n de trabajo:</div></td>
          <td colspan="2"><select name="cbMotivo_retiro_pdpie" id="cbMotivo_retiro_pdpie" class="tablaborde_shadow" title="Causales de la terminacion de la relacion de trabajo - Seleccione solo una opcion del listado">
            <option value="-1">Seleccionar</option>
          </select><span class="requerido"> * </span>
            </td>
        </tr>
        <tr>
          <td><div align="right">Fecha de terminaci&oacute;n de relaci&oacute;n de trabajo: </div></td>
          <td colspan="2">
          <input name="f_culminacion_pdpie" type="text" class="tablaborde_shadow" id="f_culminacion_pdpie" value="<?=$aDefaultForm['f_culminacion_pdpie']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_culminacion_pdpie",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>	<span class="requerido">*</span>  
        </td>
        </tr>
        <tr>
          <td><div align="right">Fecha de solicitud de trámite:</div></td>
          <td colspan="2">
          <input name="f_solicitud_pdpie" type="text" class="tablaborde_shadow" id="f_solicitud_pdpie" value="<?=$aDefaultForm['f_solicitud_pdpie']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger_1"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_solicitud_pdpie",
        trigger    : "f_rangeStart_trigger_1",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>	<span class="requerido"> * </span>	 
        </td>
        </tr>
        <tr>
          <td><div align="right">Cargo:</div></td>
          <td><input name="cargo_pdpie" type="text" class="tablaborde_shadow" id="cargo_pdpie" value="<?=$aDefaultForm['cargo_pdpie']?>
          " size="30" maxlength="100"><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right">Salario mensual (BsF):</div></td>
          <td colspan="2"><input name="salario_pdpie" type="text" class="tablaborde_shadow" id="salario_pdpie" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['salario_pdpie']?>" size="10" maxlength="6" />
          <span class="requerido">*</span></td>
        </tr>
        
        <tr>
          <th colspan="3" class="sub_titulo" align="left">Servicio de Orientaci&oacute;n:</th>
        </tr>
			<tr>
      <td align="right">Referido a:</td>
      <td colspan="2"><select name="cbReferido" class="tablaborde_shadow" id="cbReferido" title="Referido a: - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadReferido($conn); print $GLOBALS['sHtml_cb_Referido'];?>
        </select></td>
      </tr> 
      <tr>
      <td align="right">Motivo de referencia:</td>
      <td colspan="2"><select name="cbMotivo_referido" class="tablaborde_shadow" id="cbMotivo_referido" title="Motivo de referencia - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadMotivo_referido($conn); print $GLOBALS['sHtml_cb_Motivo_referido'];?>
        </select></td>
      </tr>
               <tr>
        <td align="right" >Observaciones generales: </td>
        <td colspan="2"><input name="observaciones_pdpie" type="text" class="tablaborde_shadow" id="observaciones_pdpie" value="<?=$aDefaultForm['observaciones_pdpie']?>
    " size="50" maxlength="100" title="Observaciones del funcionario que ingresa la informacion - Ingrese letras y/o numeros">      </td>
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
                <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
                <tr>
                <th width="9%" class="labelListColumn">Rif</th>
                <th width="23%" class="labelListColumn">Empresa</th>
                <th width="27%" class="labelListColumn">Motivo de retiro </th>
                <th width="13%" class="labelListColumn">Fecha Solicitud </th>
                <th width="14%" class="labelListColumn">Fecha Culminaci&oacute;n </th>
                <th width="14%" class="labelListColumn">Acciones</th>
                </tr>
              <?
	$aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $i=0; $i<count($aTabla); $i++){
		if (($i%2) == 0) $class_name = "dataListColumn2";
		else $class_name = "dataListColumn";
		?>
              <tr class="<?=$class_name?>">
              	<td class="texto-normal"><div align="left"><?=$aTabla[$i]['rif']?></div></td>
                <td class="texto-normal"><div align="left"><?=$aTabla[$i]['empresa']?></div></td>
                <td class="texto-normal"><div align="left"><?=$aTabla[$i]['motivo']?></div></td>
                <td class="texto-normal"><div align="left"><?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_tramitacion']))?>
                </div></td>
                <td class="texto-normal"><div align="left"><?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_culminacion']))?>
                </div></td>
                <td class="texto-normal">
                <a href="1_11agen_trab_pdpie.php?id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="../imagenes/pencil_16.png"  border="0" title="Editar" /></a>             
              
             		<a href="1_11agen_trab_pdpie.php?id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="../imagenes/delete_16.png"  border="0" title="Eliminar" /></a> 
                
                <a href="1agen_formato_pdpie.php?id_po=<?=$aTabla[$i]['id']?>"><img src="../imagenes/blue-document-text.png" width="19" height="21" title="Constancia de Inscripci&oacute;n"  border="0" /></a> 
                
                <? if($aTabla[$i]['cbReferido']!='-1'){?><a href="1agen_formato_referido_pdpie.php?id_po=<?=$aTabla[$i]['id']?>"><img src="../imagenes/letter_16.png" width="17" height="18" title="Constancia de Referencia"  border="0" /></a><? }?>
                                
                </td>
		    </tr>
              <? } ?>
            </table>	
            
      <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">
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
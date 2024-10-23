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
		print $_SESSION['rif'];
		var_dump( $_SESSION);
		var_dump($_SESSION['id_empresa']);

	}
}
//------------------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){		
			
			case 'Cancelar':
				$_POST['accionC']=""; 
				LoadData($conn,false);	
			break;
				
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['cbEstado_empresa']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El estado: es requerida.";
					$bValidateSuccess=false;
					 }					 
			if ($_POST['cbMunicipio_empresa']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Municipio: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbParroquia_empresa']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Parroquia: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['sector_empresa']==""){
					$GLOBALS['aPageErrors'][]= "- El Sector: es requerido.";
					$bValidateSuccess=false;
					 }		
			if ($_POST['direccion_empresa']==""){
					$GLOBALS['aPageErrors'][]= "- La Dirección: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['telefono_empresa']==""){  
					$GLOBALS['aPageErrors'][]= "- El número de teléfono: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['email_empresa']==""){  
				$GLOBALS['aPageErrors'][]= "- El correo electrónico de la empresa: es requerido.";
				$bValidateSuccess=false;
			}

			if ($_POST['email_empresa_alternativo']==""){
				$GLOBALS['aPageErrors'][]= "- El correo electrónico alternativo: es requerido.";
				$bValidateSuccess=false;
			}

			if ($_POST['contacto_empresa']==""){  
					$GLOBALS['aPageErrors'][]= "- La persona de contacto: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cargo_contacto_empresa']==""){  
					$GLOBALS['aPageErrors'][]= "- El cargo de la persona de contacto: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['telefono_persona_contacto']==""){  
					$GLOBALS['aPageErrors'][]= "- El número de teléfono de la persona de contacto: es requerido.";
					$bValidateSuccess=false;
			}		 

			if ($_POST['email_empresa']!=""){
		    if(!ereg("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$_POST['email_empresa'])){
				$GLOBALS['aPageErrors'][]= "- El formato del correo electrónico : es incorrecto.";
				$bValidateSuccess=false;
			    }
			}
			if ($_POST['email_empresa_alternativo']!=""){
		    if(!ereg("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$_POST['email_empresa_alternativo'])){
				$GLOBALS['aPageErrors'][]= "- El formato del correo electrónico alternativo: es incorrecto.";
				$bValidateSuccess=false;
			    }
			}

			if ($_POST['cbredes_sociales']=='0' and $_SESSION['existe_redes']=='1'){  
				$GLOBALS['aPageErrors'][]= "- Usted a indicado que no posee Redes Sociales debe eliminar las ya agregadas o indicar que si posee.";
				$bValidateSuccess=false;
			}

			if ($_POST['cbredes_sociales']=='1' and $_SESSION['existe_redes']=='2'){  
				$GLOBALS['aPageErrors'][]= "- Usted a indicado que si posee Redes Sociales debe agregarlas o indicar que no posee.";
				$bValidateSuccess=false;
			}
			
			if ($bValidateSuccess){		
				$_POST['accionI']='4';			
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;
	        
			//::::::::::::::::
			case 'Agrega_red': 
			$bValidateSuccess=true;	
										 
			if ($_POST['cbred_social']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Red social: es requerida.";
					$GLOBALS['ids_elementos_validar'][]='cbred_social';
					$bValidateSuccess=false;
					 }
			else{
			    if ($_POST['redes_sociales']==''){
					$GLOBALS['aPageErrors'][]= "- La direccion de la Red Social: es requerido.";
					$GLOBALS['ids_elementos_validar'][]='redes_sociales';
					$bValidateSuccess=false;
					LoadData($conn,true);
				   }
				  }
				   
		    if ($bValidateSuccess){	
			//var_dump($_POST['accionC']);
				if($_POST['accionC']=='') $_POST['accionC']='3';		
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
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];

					$aDefaultForm['cbEstado_empresa']='-1';
					$aDefaultForm['cbMunicipio_empresa']='-1';
					$aDefaultForm['cbParroquia_empresa']='-1';
					$aDefaultForm['sector_empresa']='';
					$aDefaultForm['direccion_empresa']='';
					$aDefaultForm['telefono_empresa']='';
					$aDefaultForm['otro_telefono_empresa']=''; 
					$aDefaultForm['email_empresa']='';
					$aDefaultForm['email_empresa_alternativo']='';					
					$aDefaultForm['pag_empresa']='';
					$aDefaultForm['contacto_empresa']='';
					$aDefaultForm['cargo_contacto_empresa']='';
					$aDefaultForm['telefono_persona_contacto']='';
					$aDefaultForm['redes_sociales']='';
					$aDefaultForm['cbredes_sociales']='';
										        
	if (!$bPostBack){

	/*========================================================================================
									CONSULTA REDES SOCIALES
	==========================================================================================*/

	if ($_GET['accionC']!='') $_POST['accionC']=$_GET['accionC'];
	if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];
		if ($_POST['accionC']=='1'){	
				
			$SQL="SELECT empresa_instituto_redes_sociales.id,empresa_instituto_redes_sociales.redes_sociales_id,empresa_instituto_redes_sociales.nombre
			from empresa_instituto_redes_sociales 
			INNER JOIN empresa_instituto ON empresa_instituto.id=empresa_instituto_redes_sociales.empresa_instituto_id 
			INNER JOIN redes_sociales ON redes_sociales.id=empresa_instituto_redes_sociales.redes_sociales_id 
			where empresa_instituto_redes_sociales.empresa_instituto_id ='".$_SESSION['id_empresa']."' and empresa_instituto.rif='".$_SESSION['rif']."' and empresa_instituto_redes_sociales.id ='".$_POST['id_po']."'";
			$rs = $conn->Execute($SQL);

				
			if ($rs->RecordCount()>0){	
				$aDefaultForm['cbred_social']=$rs->fields['redes_sociales_id'];
				$aDefaultForm['redes_sociales']=$rs->fields['nombre'];
			}
		}		
	/*========================================================================================
									FIN DE CONSULTA REDES SOCIALES
	==========================================================================================*/



	/*========================================================================================
									ELIMINAR REDES SOCIALES
	==========================================================================================*/
		if ($_POST['accionC']=='2'){
			$sql="delete  from empresa_instituto_redes_sociales 
			where id='".$_POST['id_po']."' and empresa_instituto_id='".$_SESSION['id_empresa']."' ";  
			$rs= $conn->Execute($sql);	
			unset($_POST['id_po']);	 
			unset($_POST['accionC']);
			
		 //Trazas-------------------------------------------
			$id=$_SESSION['id_afiliado'];
			$identi=$_SESSION['ced_afiliado'];
			$us=$_SESSION['sUsuario'];
			$mod='7';			    
			$auditoria= new Trazas; 
			$auditoria->auditor($id,$identi,$sql,$us,$mod);
		}
	/*========================================================================================
								FIN DE ELIMINAR REDES SOCIALES
	==========================================================================================*/


	/*========================================================================================
								CONSULTAR DATOS DE LA EMPRESA REGISTRADA
	==========================================================================================*/
		    $SQL="select * From public.empresa_instituto where id ='".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 				
					$aDefaultForm['cbEstado_empresa']=$rs1->fields['estado_id'];
					$aDefaultForm['sector_empresa']=$rs1->fields['sector'];
					$aDefaultForm['direccion_empresa']=$rs1->fields['direccion'];
					$aDefaultForm['telefono_empresa']=$rs1->fields['telefono'];
					$aDefaultForm['otro_telefono_empresa']=$rs1->fields['otro_telefono'];
					$aDefaultForm['email_empresa']=$rs1->fields['correo'];
					$aDefaultForm['email_empresa_alternativo']=$rs1->fields['correo_alternativo'];
					$aDefaultForm['pag_empresa']=$rs1->fields['pag_web'];
					$aDefaultForm['contacto_empresa']=$rs1->fields['persona_contacto'];
					$aDefaultForm['cargo_contacto_empresa']=$rs1->fields['cargo_persona'];
					$aDefaultForm['cbredes_sociales']=$rs1->fields['redes_sociales'];
					$aDefaultForm['telefono_persona_contacto']=$rs1->fields['telefono_persona_contacto'];
					?>	
					<script language="javascript" src="../js/jquery.js"></script>
					<script>
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['estado_id']; ?>";
					combo="Municipio";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['municipio_id']; ?>" }, 
					function(data){  $("#cbMunicipio_empresa").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['municipio_id']; ?>";
					combo="Parroquia";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['parroquia_id']; ?>" },
					function(data){  $("#cbParroquia_empresa").html(data);
					});            
					});
					
					</script> 
					<?php

	/*========================================================================================
								CONSULTAR TABLA REDES SOCIALES EMPRESA
	==========================================================================================*/
					unset($_SESSION['aTabla']);
					$SQL1="select empresa_instituto_redes_sociales.id,redes_sociales.nombre, empresa_instituto_redes_sociales.nombre as direccion, empresa_instituto.rif
					from empresa_instituto_redes_sociales 
					INNER JOIN empresa_instituto ON empresa_instituto.id=empresa_instituto_redes_sociales.empresa_instituto_id 
					INNER JOIN redes_sociales ON redes_sociales.id=empresa_instituto_redes_sociales.redes_sociales_id 
					where empresa_instituto_redes_sociales.empresa_instituto_id= '".$_SESSION['id_empresa']."' and empresa_instituto.rif='".$_SESSION['rif']."' ";
					$rs1 = $conn->Execute($SQL1);
				
					if ($rs1->RecordCount()>0){	
						$aTabla=array();
						while(!$rs1->EOF){
							$c = count($aTabla);
							$aTabla[$c]['id']=$rs1->fields['id']; 
							$aTabla[$c]['red_social']=$rs1->fields['nombre'];	
							$aTabla[$c]['direccion']=$rs1->fields['direccion'];
							$rs1->MoveNext();
						}
						$_SESSION['aTabla'] = $aTabla;
						$_SESSION['existe_redes']= 1;								
					}else{
						$_SESSION['existe_redes']= 2;
					}

					//::::::::::::::::::
					}
				}	
		else{   
					$aDefaultForm['cbEstado_empresa']=$_POST['cbEstado_empresa'];
					$aDefaultForm['cbMunicipio_empresa']=$_POST['cbMunicipio_empresa'];
					$aDefaultForm['cbParroquia_empresa']=$_POST['cbParroquia_empresa'];
					$aDefaultForm['sector_empresa']=$_POST['sector_empresa']; 
					$aDefaultForm['direccion_empresa']=$_POST['direccion_empresa'];
					$aDefaultForm['telefono_empresa']=$_POST['telefono_empresa'];
					$aDefaultForm['otro_telefono_empresa']=$_POST['otro_telefono_empresa']; 
					$aDefaultForm['email_empresa']=$_POST['email_empresa']; 
					$aDefaultForm['email_empresa_alternativo']=$_POST['email_empresa_alternativo']; 					
					$aDefaultForm['pag_empresa']=$_POST['pag_empresa'];
					$aDefaultForm['contacto_empresa']=$_POST['contacto_empresa'];
					$aDefaultForm['cargo_contacto_empresa']=$_POST['cargo_contacto_empresa'];
					$aDefaultForm['cbredes_sociales']=$_POST['cbredes_sociales'];
					$aDefaultForm['redes_sociales']=$_POST['redes_sociales'];
					$aDefaultForm['telefono_persona_contacto']=$_POST['telefono_persona_contacto'];
					}
			}
} 
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	

/*========================================================================================
								ACTUALIZAR RED SOCIAL
==========================================================================================*/
		if ($_POST['accionC']=='1'){		
			$sql="update empresa_instituto_redes_sociales set 
			redes_sociales_id='".$_POST['cbred_social']."',
			nombre='".$_POST['redes_sociales']."', 
			updated_at='".$sfecha."',
			status='A',
			id_update='".$_SESSION['sUsuario']."'
			WHERE id='".$_POST['id_po']."' and empresa_instituto_id= '".$_SESSION['id_empresa']."' ";
			$conn->Execute($sql);


			//Actualiza y muestra la tabla de las redes sociales
			unset($_SESSION['aTabla']);
			$SQL1="select empresa_instituto_redes_sociales.id,redes_sociales.nombre, empresa_instituto_redes_sociales.nombre as direccion, empresa_instituto.rif
			from empresa_instituto_redes_sociales 
			INNER JOIN empresa_instituto ON empresa_instituto.id=empresa_instituto_redes_sociales.empresa_instituto_id 
			INNER JOIN redes_sociales ON redes_sociales.id=empresa_instituto_redes_sociales.redes_sociales_id 
			where empresa_instituto_redes_sociales.empresa_instituto_id= '".$_SESSION['id_empresa']."' and empresa_instituto.rif='".$_SESSION['rif']."' ";
			$rs1 = $conn->Execute($SQL1);
		
			if ($rs1->RecordCount()>0){	
				$aTabla=array();
				while(!$rs1->EOF){
					$c = count($aTabla);  
					$aTabla[$c]['id']=$rs1->fields['id']; 
					$aTabla[$c]['red_social']=$rs1->fields['nombre'];	
					$aTabla[$c]['direccion']=$rs1->fields['direccion'];
					$rs1->MoveNext();
				}
				$_SESSION['aTabla'] = $aTabla;	
				$_SESSION['existe_redes']= 1;							
			}else{
				$_SESSION['existe_redes']= 2;
			}
		}



/*========================================================================================
								    AGREGAR RED SOCIAL
==========================================================================================*/
	if ($_POST['accionC']=='3'){	
	 //----------------------------------------------verifica si existe-----------------------------
	 $SQL2="
	 SELECT id, empresa_instituto_id, redes_sociales_id,
	  nombre
	  FROM empresa_instituto_redes_sociales
	  where empresa_instituto_id  ='".$_SESSION['id_empresa']."'
	  and redes_sociales_id = '".$_POST['cbred_social']."'";
	$rs = $conn->Execute($SQL2);
			if ($rs->RecordCount()>0){	
					$existe='1';
					?><script>alert("- Ya existe un registro con esta Red Social");</script><?	
			}else{					
				$sql="insert into public.empresa_instituto_redes_sociales
				( empresa_instituto_id, redes_sociales_id, nombre, created_at, status, id_update) values
				('".$_SESSION['id_empresa']."',
				 '".$_POST['cbred_social']."',
				 '".$_POST['redes_sociales']."', 
				 '$sfecha',
				 'A',
				 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql);

				 //muestra listado actualizado
				 unset($_SESSION['aTabla']);
					$SQL1="select empresa_instituto_redes_sociales.id,redes_sociales.nombre, empresa_instituto_redes_sociales.nombre as direccion, empresa_instituto.rif
					from empresa_instituto_redes_sociales 
					INNER JOIN empresa_instituto ON empresa_instituto.id=empresa_instituto_redes_sociales.empresa_instituto_id 
					INNER JOIN redes_sociales ON redes_sociales.id=empresa_instituto_redes_sociales.redes_sociales_id 
					where empresa_instituto_redes_sociales.empresa_instituto_id= '".$_SESSION['id_empresa']."' and empresa_instituto.rif='".$_SESSION['rif']."' ";
					$rs1 = $conn->Execute($SQL1);
				
					if ($rs1->RecordCount()>0){	
						$aTabla=array();
						while(!$rs1->EOF){
							$c = count($aTabla);  
							$aTabla[$c]['id']=$rs1->fields['id']; 
							$aTabla[$c]['red_social']=$rs1->fields['nombre'];	
							$aTabla[$c]['direccion']=$rs1->fields['direccion'];
							$rs1->MoveNext();
						}
						$_SESSION['aTabla'] = $aTabla;	
						$_SESSION['existe_redes']= 1;							
					}else{
						$_SESSION['existe_redes']= 2;
					}

			}
	}

/*========================================================================================
								ACTUALIZA DATOS DE LA EMPRESA
==========================================================================================*/
		//$_POST['accionI']='4';		
		if ($_POST['accionI']=='4'){
			$sql="update empresa_instituto set 
				  estado_id = '".$_POST['cbEstado_empresa']."',
				  municipio_id = '".$_POST['cbMunicipio_empresa']."',
				  parroquia_id = '".$_POST['cbParroquia_empresa']."',
				  sector = '".$_POST['sector_empresa']."',
				  direccion = '".$_POST['direccion_empresa']."',
				  telefono = '".$_POST['telefono_empresa']."',
				  otro_telefono = '".$_POST['otro_telefono_empresa']."',
				  correo = '".$_POST['email_empresa']."',	
				  pag_web = '".$_POST['pag_empresa']."',
				  persona_contacto = '".$_POST['contacto_empresa']."',
				  cargo_persona = '".$_POST['cargo_contacto_empresa']."',
				  redes_sociales= '".$_POST['cbredes_sociales']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."',
				  telefono_persona_contacto= '".$_POST['telefono_persona_contacto']."',
				  correo_alternativo = '".$_POST['email_empresa_alternativo']."'
				  WHERE id= '".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'";	
			  	  $conn->Execute($sql);
			  	  
				  //redes_sociales= '".$_POST['redes_sociales']."',
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_empresa'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='14';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
			  ?><script>document.location='2_3agen_otrosdatos_empresa.php'</script><? 
	}

}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
include('menu_trabajador.php'); 
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
?>
<form name="form_empresa" method="post" action="" >
  <p>
    <script>
function send(saction){

	if(saction=='Agregar'){
   		if(validar_frm_empresa("<?php echo $_SESSION['existe_redes']; ?>")==true){
			var form = document.form_empresa;
			form.action.value=saction;
			form.submit();
		}		   				
	}

	if(saction=='Agrega_red'){
   		if(validar_frm_empresa_redes()==true){
			var form = document.form_empresa;
			form.action.value=saction;
			form.submit();
		}		   				
	}

	if(saction=='Cancelar'){
		var form = document.form_empresa;
			form.action.value=saction;
			form.submit();
	}
}

//Municipio---Parroquia residencia
$(document).ready(function(){
   $("#cbEstado_empresa").change(function () {
           $("#cbEstado_empresa option:selected").each(function () {
            elegido=$(this).val();
			combo='Municipio';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbMunicipio_empresa").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbMunicipio_empresa").change(function () {
           $("#cbMunicipio_empresa option:selected").each(function () {
            elegido=$(this).val();
			combo='Parroquia';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbParroquia_empresa").html(data);
            });            
        });
   })
});
          </script>


    <input name="action" type="hidden" value=""/>
    <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
    <input name="accionC" type="hidden" value="<?=$_POST['accionC']?>" />

      <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
          <tr>
          	<th colspan="2" class="sub_titulo" align="left">Ubicaci&oacute;n: </th>
          </tr>
        <tr>
	      <td width="41%" height="25"><div align="right" class="">Estado:</div></td>
	      <td width="59%">
        <select name="cbEstado_empresa" id="cbEstado_empresa" class="tablaborde_shadow" title="Estado - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadEstado_empresa($conn) ; print $GLOBALS['sHtml_cb_Estado_empresa']; ?> 
        </select><span class="requerido">*</span></td>
	      </tr>
	    <tr>
	      <td width="41%" height="25"><div align="right" class="">Municipio:</div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbMunicipio_empresa" id="cbMunicipio_empresa" class="" title="Municipio - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
	          </select>
	        </span><span class="requerido"> *</span></td>
	      </tr>
	    <tr>
	      <td width="41%" height="25"><div align="right" class="">Parroquia:</div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbParroquia_empresa" id="cbParroquia_empresa" class="" title="Parroquia - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
	          </select>
	        </span><span class="requerido"> *</span></td>
	      </tr>
        <tr>
          <td><div align="right"> Sector: </div></td>
          <td><textarea name="sector_empresa" cols="28" class="tablaborde_shadow" id="sector_empresa"><?=$aDefaultForm['sector_empresa']?>   </textarea><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Direcci&oacute;n:  </div></td>
          <td><textarea name="direccion_empresa" cols="28" class="tablaborde_shadow" id="direccion_empresa"><?=$aDefaultForm['direccion_empresa']?></textarea><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> N&uacute;mero de tel&eacute;fono:: </div></td>
          <td><input name="telefono_empresa" type="text" class="tablaborde_shadow" id="telefono_empresa" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_empresa']?>" size="30" maxlength="11" autocomplete="off" placeholder="Ej. 02121234567"/>
              <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Otro n&uacute;mero de tel&eacute;fono:: </div></td>
          <td><input name="otro_telefono_empresa" type="text" class="tablaborde_shadow" id="otro_telefono_empresa" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_empresa']?>" size="30" maxlength="11" autocomplete="off" placeholder="Ej. 02121234567"/></td>
        </tr>
        <tr>
          <td><div align="right"> Correo electr&oacute;nico 1: </div></td>
          <td><input name="email_empresa" type="text" class="tablaborde_shadow" id="email_empresa" value="<?=$aDefaultForm['email_empresa']?>" size="30" maxlength="30" autocomplete="off"  placeholder="Ej. juancito@gmail.com"/><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Correo electr&oacute;nico alternativo: </div></td>
          <td><input name="email_empresa_alternativo" type="text" class="tablaborde_shadow" id="email_empresa_alternativo" value="<?=$aDefaultForm['email_empresa_alternativo']?>"  size="30" maxlength="30" autocomplete="off" placeholder="Ej. juancito@gmail.com"/><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> P&aacute;gina web: </div></td>
          <td><input name="pag_empresa" type="text" class="tablaborde_shadow" id="pag_empresa" value="<?=$aDefaultForm['pag_empresa']?>" size="30" maxlength="30" /></td>
        </tr>
        <tr>
          <td><div align="right"> Persona de contacto (Representante Legal): </div></td>
          <td><input name="contacto_empresa" type="text" class="tablaborde_shadow" id="contacto_empresa" onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['contacto_empresa']?>" size="30" maxlength="30" />
              <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Cargo de la persona de contacto: </div></td>
          <td><input name="cargo_contacto_empresa" type="text" class="tablaborde_shadow" id="cargo_contacto_empresa" onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['cargo_contacto_empresa']?>" size="30" maxlength="30" />
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> N&uacute;mero de telefono de la persona contacto: </div></td>
          <td><input name="telefono_persona_contacto" type="text" class="tablaborde_shadow" id="telefono_persona_contacto" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_persona_contacto']?>" size="30" maxlength="11" autocomplete="off" placeholder="Ej. 02121234567"/>
              <span class="requerido"> *</span></td>
        </tr>

       	<tr>
	      <td width="45%" height="25"><div align="right" class="">¿Posee Redes Sociales:?</div></td>
	      <td><select name="cbredes_sociales" class="" id="cbredes_sociales" title="Tiene Redes Sociales - Ejemplo:  Facebook, Instagram, Twitter, Snapchat, Tumblr, Flickr, Meetic, Spotify, YouTube, Telegram">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbredes_sociales'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbredes_sociales'])=='0') print 'selected="selected"';?>>No</option>
	        </select></td>
        </tr>

        <tr id="tr_redes_sociales">
            <td ><div align="right" >Redes Sociales:</div></td>
           	
           	<td>
		        <select name="cbred_social" class="tablaborde_shadow" id="cbred_social" title="Redes Sociales - Seleccione solo una opcion del listado e indique el nombre de la red Social">
		            <option value="-1" selected="selected">Seleccione</option>
		            <? LoadRedes_Sociales($conn); print $GLOBALS['sHtml_cbred_social'];?>
		        </select>
		        

          		<input name="redes_sociales" type="text" class="" id="redes_sociales" value="<?=$aDefaultForm['redes_sociales']?>" size="30" maxlength="30" title="Redes Sociales - Indique el nombre de la red social seleccionada"/>
      		</td>

           	<tr id="tr_redes_sociales1">
           		<td>&nbsp;</td>
	          	<td colspan="2">
	          		<span class="requerido">
			        	<? if($_POST['accionC']=="1"){ ?>
			          		<button type="button" name="Actualizar"  id="Actualizar" class="button"  onClick="javascript:send('Agrega_red');">Actualizar</button>
			          	<? }else{ ?>

			          		<button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agrega_red');">Agregar</button>
		          	</span>
		          		<? }?>

			          <span class="requerido">
			          		<button type="button" name="Cancelar2"  id="Cancelar2" class="button"  onclick="javascript:send('Cancelar');">Cancelar</button>
			          </span>
	          	</td>
          	</tr> 
         
          	<tr> 
          		<td colspan="3">
                
	                <table  border="1" align="center" class="listado formulario" id="tblDetalle" style="width:50%; ">
	                <tr>
		                <th width="31%" class="labelListColumn">Red Social</th>
		                <th width="31%" class="labelListColumn">Dirección</th>
		                <th colspan="2" class="labelListColumn">Acciones</th>
	                </tr>
	                
	                <?
	                $aTabla=$_SESSION['aTabla'];
	                $aDefaultForm = $GLOBALS['aDefaultForm'];
	                for( $i=0; $i<count($aTabla); $i++){
	                if (($i%2) == 0) $class_name = "dataListColumn2";
	                else $class_name = "dataListColumn";
	                ?>
	                <tr class="<?=$class_name?>" border="0">
		                <td class="texto-normal">
		                	<div align="left">
		                		<?=$aTabla[$i]['red_social']?>
		                	</div>
		            	</td>
		                <td class="texto-normal">
		                	<div align="left">
			                	<?=$aTabla[$i]['direccion']?>
			                </div>
		            	</td>
		                <td width="19%" class="texto-normal" align="center" border="0">
		                	<a href="?menu=11&id_po=<?=$aTabla[$i]['id']?>&accionC=1"><img src="../imagenes/pencil_16.png"  border="0" title="Editar <?=$aTabla[$i]['direccion']?>" /></a>  
		                </td>
		                <td width="19%" class="texto-normal" align="center" border="0">
                        	<a href="?menu=11&id_po=<?=$aTabla[$i]['id']?>&accionC=2"><img src="../imagenes/delete_16.png"  border="0" title="Eliminar <?=$aTabla[$i]['direccion']?>" /></a> 
                        </td>
	                </tr>
	                
	                <? } ?>
	                </table>    
      			</td> 
      	</tr>

        <!--::::::::::::::::::::::::::::::::::::::::::::::::::-->
        <tr>
          <td colspan="4" class="requerido"></td>
        </tr>

        <tr>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      </tr>
	    <tr>

        <tr>
          <td colspan="4" class="link-clave-ruee"><div align="center"><span class="requerido">
           <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button> 
          </span></div></td>
        </tr>
        
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3" class="link-clave-ruee">&nbsp;</td>
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

<?php //include('../footer.php'); ?>
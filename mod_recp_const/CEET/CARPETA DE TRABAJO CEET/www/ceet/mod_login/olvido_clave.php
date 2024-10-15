<?php
//version 1.2
//SE QUITO LA VALIDACION DEL CORREO EN ESTA PANTALLA

ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include('../LoadCombos.php');
//include('funcion_declaracion.php');
$conn = getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$ids_elementos_validar= array();
$conn->debug = $settings['debug']; 
debug($settings['debug']); 
doAction($conn);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();

include("../evita_injection.php");
//include("../verificar_session_url.php");

function debug(){
	 if($settings['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function trace($msg){
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}

function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
				case 'guardar':
						$bValidateSuccess=true;
						//---------------VALIDA RIF---------------------------------------------------------------------------------------------
						if ($_POST['rif']=="" or !preg_match("/^[[:digit:]]{9}$/", trim($_POST['rif']))){
						$GLOBALS['aPageErrors'][]= "- El campo Rif: Debe contener 9 digitos.";
						$GLOBALS['ids_elementos_validar'][]='rif';
						$bValidateSuccess=false;
						}
						//---------------VALIDA USUARIO----------------------------------------------------------------------------------------
						if ($_POST['nacionalidad']=="1"){
							if (!ereg("^[0-9]{6,8}$", $_POST['usuario'])){ 
							$GLOBALS['aPageErrors'][]= "- La Cedula del usuario: debe tener de seis a ocho digitos numericos.";
							$GLOBALS['ids_elementos_validar'][]='usuario';
							$bValidateSuccess=false;
							}	
				  		}
						if ($_POST['nacionalidad']=="2"){
							if (!ereg("^[0-9]{8}$", $_POST['usuario'])){ 
							$GLOBALS['aPageErrors'][]= "- La Cedula del usuario: debe tener ocho digitos numericos.";
							$GLOBALS['ids_elementos_validar'][]='usuario';
							$bValidateSuccess=false;
							}	
						}
				  		
						//---------------VALIDA CORREO-----------------------------------------------------------------------------------------			
						if($_POST['correo']==""){
							$GLOBALS['aPageErrors'][]= "- El campo Correo Electr&oacute;nico: No puede estar vacio.";
							$GLOBALS['ids_elementos_validar'][]='correo';
							$bValidateSuccess=false;
					  }else{
							if($_POST['correo2']!=$_POST['correo']){
								$GLOBALS['aPageErrors'][]= "- El campo Confirmacion Correo Electronico: No coincide.";
								$GLOBALS['ids_elementos_validar'][]='correo2';
								$bValidateSuccess=false;						
	     				}
						}
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
//-----------------------------------------------------------------------------//
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];	
	
		$aDefaultForm['cbo_rif']=''; 
		$aDefaultForm['rif']='';
		$aDefaultForm['nacionalidad']='';
		$aDefaultForm['usuario']='';
		$aDefaultForm['correo']='';
		$aDefaultForm['correo2']='';

		if (!$bPostBack){}
		else{
					$aDefaultForm['cbo_rif'] =$_POST["cbo_rif"];
					$aDefaultForm['rif'] =$_POST["rif"];
					$aDefaultForm['nacionalidad'] =$_POST["nacionalidad"];
					$aDefaultForm['usuario'] =$_POST["usuario"];
					$aDefaultForm['correo'] =$_POST["correo"];
					$aDefaultForm['correo2'] =$_POST["correo2"];
		}
	}
}
//-----------------------------------------------------------------------------//
function ProcessForm($conn){
global $host_smtp_pear;
global $port_smtp_pear;
global $username_smtp_pear;
global $password_smtp_pear;

	
  $rif=$_POST['cbo_rif'].$_POST['rif'];
  
  $SQL="SELECT 
  	sesion.id,
		sesion.ntipo,
		usuario.id as id_usuario,
		usuario.sprimer_nombre as nombre,
		usuario.sprimer_apellido as apellido,
		rnee_empresa.id as empresa_id,
		rnee_empresa.srazon_social as empresa_razon_social
		FROM rnee.sesion 
		INNER JOIN rnee.rnee_empresa on sesion.rnee_empresa_id=rnee_empresa.id
		INNER JOIN rnee.rnee_estatus_movimiento ON rnee_estatus_movimiento.id_rnee_empresa=sesion.rnee_empresa_id
		INNER JOIN rnee.rnee_condicion_actividad_movimiento on rnee_condicion_actividad_movimiento.rnee_empresa_id=sesion.rnee_empresa_id
		INNER JOIN rnee.usuario ON usuario.id=sesion.usuario_id
		WHERE usuario.nusuario='".$_POST['usuario']."'
		AND usuario.snacionalidad='".$_POST['nacionalidad']."'  
		AND rnee_empresa.srif='".$rif."'
		AND sesion.semail ilike '".$_POST['correo']."'
		AND usuario.nenabled=1 
		AND sesion.nenabled=1 
		AND rnee_estatus_movimiento.nenabled=1
		AND rnee_condicion_actividad_movimiento.nenabled=1
		LIMIT 1 ";
    $rs=$conn->Execute($SQL);
	
	if($rs->RecordCount()>0){
	$_POST['id_sesion']=$rs->fields['id'];
	$_POST['id_usuario']=$rs->fields['id_usuario'];
	$_POST['ntipo']=$rs->fields['ntipo'];
	$_POST['nombre']=$rs->fields['nombre'];
	$_POST['apellido']=$rs->fields['apellido'];
	$_POST['empresa_id']=$rs->fields['empresa_id'];
	$_POST['empresa_razon_social']=$rs->fields['empresa_razon_social'];
	$_POST['empresa_id']=$rs->fields['empresa_id'];
	

	
	//GENERAR CLAVE USUARIOS
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
			for($i=0;$i<8;$i++) {
			//$cad .= substr($str,rand(0,62),1);
			$cad .= substr($str,rand(0,62),1);
			}	
		$clave= strtoupper($cad);
		$clave1=md5($clave);
		$sfecha=date('Y-m-d H:i:s');
		
	$SQL="UPDATE rnee.sesion SET 
		  nenabled=1,
		  clave='".$clave1."',
		  dfecha_actualizacion='".$sfecha."',
		  usuario_idactualizacion='".$_POST['id_usuario']."'
		  WHERE sesion.id='".$_POST['id_sesion']."' 
		  and usuario_id='".$_POST['id_usuario']."' 
		  and rnee_empresa_id='".$_POST['empresa_id']."' ";
	$rs= $conn->Execute($SQL);
						
    if($_POST['cbo_cedulalegal']==1) $nacionalidad="V";
	if($_POST['cbo_cedulalegal']==2) $nacionalidad="E"; 
	if($_POST['ntipo']==1) $ntipo='Presidente';
	if($_POST['ntipo']==2) $ntipo='Representante Legal';
	if($_POST['ntipo']==3) $ntipo='Autorizado';
		$address = $_POST["correo"]; 
		$subject = 'Registro Nacional de Entidades de Trabajo'; 
		$message = "Sr(a). ".$_POST["apellido"]." ".$_POST["nombre"]."\n en su carácter de ".$ntipo." de la Entidad de Trabajo ".$_POST['empresa_razon_social']." RIF: ".$rif.". Le informamos que el cambio de su contraseña se ha hecho efectivo \n 
		USUARIO: ".$nacionalidad.$_POST['usuario']." y su CONTRASEÑA: ".$clave." \n 
		Por favor ingrese nuevamente a nuestro sistema.";
		//---------------------------------------------------- 
 
 require_once "Mail.php";
 $from = "Ministerio del Poder Popular para el Proceso Social de Trabajo <rnet@mpppst.gob.ve>";
 $headers = array ('From' => $from,
   'To' => $address,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host_smtp_pear,
     'auth' => true,
     'username' => $username_smtp_pear,
     'password' => $password_smtp_pear));
$mail = $smtp->send($address, $headers, $message);
 if (PEAR::isError($mail)) {
  $enviado = false;
 } else {
    $enviado = true;
 }

 

		//mail($address, $subject, $message, "From: rnet@mintra.gov.ve\r\nReply-to: rnet@mintra.gov.ve\r\n"); 
		
		
		
		?><script>if (confirm("- La nueva contrasena ha sido enviada a su correo electronico, es posible que haya llegado a su bandeja SPAM"))
		document.location="index.php?";</script><? 
	
	}
	
	else{

	$GLOBALS['aPageErrors'][]= "- Datos incorrectos.";

	}
}
//-----------------------------------------------------------------------------//
function doReport($conn){	
}
function showHeader(){
 include('../header.php'); 
}
//-----------------------------------------------------------------------------//
function showForm($conn,&$aDefaultForm){
?>	
<form name="frm_contrasena" id="frm_contrasena"method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script type="text/javascript" src="../js/validacion_general.js"></script>
<script type="text/javascript" src="validar_olvido_clave.js"></script>
<script>
	function send(saction){
	       if(saction=='guardar'){
		   			if(validar_frm_contrasena()==true){
					var form = document.frm_contrasena;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_contrasena;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>

  <input name="action" type="hidden" value=""/>

  <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
    <th align="left" colspan="4" height="40" class="titulo">OLVIDO CONTRASE&Ntilde;A </th>
  </tr>
 <tr>
  <th colspan="4" class="sub_titulo">INDIQUE LOS DATOS DE ACCESO AL SISTEMA</th>
 </tr>
  <tr>
    <td align="right" class="formulario">Usuario:</td>
    <td class="formulario"><select name="nacionalidad" class="cbo_em" id="nacionalidad">
                 <option value="1" <? if (($aDefaultForm['nacionalidad'])=='1') print 'selected="selected"';?>>V</option>
                 <option value="2" <? if (($aDefaultForm['nacionalidad'])=='2') print 'selected="selected"';?>>E</option>
               </select>
        <input type="text" name="usuario" id="usuario" value="<?=$aDefaultForm['usuario']?>" class="input_em" maxlength="10" onkeypress="return permite(event, 'num')" /></td>
    </tr>
  <tr>
    <td align="center" bordercolor="cccccc" class="formulario"><div align="right">Correo Electr&oacute;nico:</div></td>
    <td bordercolor="cccccc" class="identificacion_seccion"><input name="correo" type="text" id="correo" value="<?=$aDefaultForm['correo']?>" size="26"/></td>
    </tr>
  <tr>
    <td align="center" bordercolor="cccccc" class="formulario"><div align="right">Confirme su Correo Electr&oacute;nico:</div></td>
    <td bordercolor="cccccc" class="identificacion_seccion"><input name="correo2" type="text" id="correo2" value="<?=$aDefaultForm['correo2']?>" size="26"/></td>
    </tr>
  <tr>
  	<th colspan="2" height="40" align="center">  
	   <input name="guardar" type="button" class="button" id="guardar" onClick="javascript:send('guardar')" value="Aceptar"/>	  </th>
  </tr>
  <tr>
  	<td colspan="2" height="50"></td>
  </tr>
  </table>
</form>
<?php
}
function showFooter(){
include('../footer.php'); 
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.borderColor= 'Red'; </script>";
}
 
$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>alert('".join('\n',$aPageErrors)."')</script>":""; 
}
?>
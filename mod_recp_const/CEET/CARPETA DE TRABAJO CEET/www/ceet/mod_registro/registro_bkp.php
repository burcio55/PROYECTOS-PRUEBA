<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../include/header.php');
include("../LoadCombos.php");
include('1_Validador.php');
$conn= getConnDB($db1);
$conn->debug = FALSE;
//-------------------------------------------------------------



$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

include("../evita_injection.php");
//include("../verificar_session_url_inicio_registro.php");
include("verificar_correo.php");
/*
session_start();
if(!isset($_SESSION)){
header("location:rnet_login.php");
} else {
session_unset();
session_destroy();
//header("location:rnet_login.php");
}
*/

doAction($conn);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();



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

function trace($msg){//para hacer traza y no estar escribiendo echo o print cada vez
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}

function doAction($conn){

	if (isset($_POST['action'])){
		switch($_POST['action']){
		   
			
			case 'Continuar': 
			$bValidateSuccess=true;	
					
		if ($_POST['cbCed_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La cédula: es requerido.";
				$bValidateSuccess=false;
		 }
		 
		if ($_POST['ced_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La cédula: es requerido.";
				$bValidateSuccess=false;
		 }	   
					
		if ($_POST['nombre_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Nombre: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("([a-z, A-Z])", trim($_POST['nombre_afiliado']))){
				$GLOBALS['aPageErrors'][]= "- El Nombre: es incorrecto.";
				$bValidateSuccess=false;
			    }
			 } 
				 
		if ($_POST['apellido_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Apellido: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("([a-z, A-Z])", trim($_POST['apellido_afiliado']))){
				$GLOBALS['aPageErrors'][]= "- El Apellido: es incorrecto.";
				$bValidateSuccess=false;
			    }
			 }
			  
		if ($_POST['cbSexo_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El Sexo: es requerido.";
				$bValidateSuccess=false;
				 }

		if ($_POST['fnacimiento_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La Fecha de naciemiento: es requerida.";
				$bValidateSuccess=false;
				 }
		if  ($_POST['fnacimiento_afiliado']!=''){								 
						$dia=date(j); $mes=date(n); $ano=date(Y);
						//fecha de nacimiento	y edad
						list($anonaz,$mesnaz,$dianaz)=explode("-", $_POST['fnacimiento_afiliado']);				
						if (($mesnaz == $mes) && ($dianaz > $dia)) {
						$ano=($ano-1); 
						}
						if ($mesnaz > $mes) {
						$ano=($ano-1);
						}
						echo $_POST['edad']=($ano-$anonaz);	
						 if($_POST['edad']<=14){
							  $GLOBALS['aPageErrors'][]= "- La edad del trabajador es menor o igual a 14 a\u00f1os.";
				        $bValidateSuccess=false;
							 
							 } 							 
					  }	
			   				 		
		if ($_POST['telefono_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Teléfono: es requerido.";
				$bValidateSuccess=false;
				 }	   
		if ($_POST['email_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Correo Electrónico: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$_POST['email_afiliado'])){
				$GLOBALS['aPageErrors'][]= "- El formato de Correo electrónico : es incorrecto.";
				$bValidateSuccess=false;
			    }
			 }
			 
		if($_POST['email_afiliado']!=""){
			if($_POST['email_afiliado']!=$_POST['email_afiliado2']){
				$GLOBALS['aPageErrors'][]= "- El campo Confirmacion Correo Electronico: No coincide.";
				$GLOBALS['ids_elementos_validar'][]='email_afiliado2';
				$bValidateSuccess=false;						
			}
		}
			 
		if($_POST['cbCed_afiliado']!="" and $_POST['ced_afiliado']!=""){
			$cedula=$_POST['cbCed_afiliado'].$_POST['ced_afiliado'];
			
					$SQL = "select * from personas  
					where cedula ='".$cedula."'"; 
					$rs = $conn->Execute($SQL);
			if ($rs->RecordCount()>0){
				$GLOBALS['aPageErrors'][]= "- El(La) trabajador(a) Ya se encuentra registrado(a).";
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
 
 
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
//datos personales
					$aDefaultForm['cbCed_afiliado']='';
					$aDefaultForm['ced_afiliado']='';
					$aDefaultForm['nombre_afiliado']='';
					$aDefaultForm['apellido_afiliado']='';
					$aDefaultForm['cbSexo_afiliado']='-1';
					$aDefaultForm['fnacimiento_afiliado']='';
					$aDefaultForm['telefono_afiliado']='';
					$aDefaultForm['email_afiliado']='';
					
				
        
	if (!$bPostBack){
		/*AQUI SI TRAE DE BASE DE DATOS*/
		}else{   
					$aDefaultForm['cbCed_afiliado']=$_POST['cbCed_afiliado'];
					$aDefaultForm['ced_afiliado']=$_POST['ced_afiliado'];
					$aDefaultForm['nombre_afiliado']=$_POST['nombre_afiliado'];
					$aDefaultForm['apellido_afiliado']=$_POST['apellido_afiliado'];
					$aDefaultForm['cbSexo_afiliado']=$_POST['cbSexo_afiliado'];
					$aDefaultForm['fnacimiento_afiliado']=$_POST['fnacimiento_afiliado']; 
					$aDefaultForm['telefono_afiliado']=$_POST['telefono_afiliado'];
					$aDefaultForm['email_afiliado']=$_POST['email_afiliado'];
					
					
		}
	}
} 


function ProcessForm($conn){
global $host_smtp_pear;
global $port_smtp_pear;
global $username_smtp_pear;
global $password_smtp_pear;

function generar_clave(){
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$cad = "";
	for($i=0;$i<8;$i++) {
	$cad .= substr($str,rand(0,62),1);
	}	
return  strtoupper($cad);
}

$cedula=$_POST['cbCed_afiliado'].$_POST['ced_afiliado'];
//$clave=generar_clave();
$clave=$_POST['ced_afiliado'];
$clave_md5=md5($clave);
$sfecha=date('Y-m-d');

if($_POST['cbCed_afiliado']=='V'){
	 $nacionalidad='1';
	 }
else {
	   $nacionalidad='2';
		 }

				$SQL= "INSERT INTO personas(
            cedula, 
            nombres, 
            apellidos, 
            sexo, 
            f_nacimiento,  
            telefono, 
            correo, 
            clave, 
            tipo_usuario,
						status,
						created_at,
						id_created_at,
						sunidadsustantiva,
						nacionalidad
						)
    				VALUES (
							'".$cedula."',
							'".$_POST['nombre_afiliado']."',
							'".$_POST['apellido_afiliado']."',
							'".$_POST['cbSexo_afiliado']."',
							'".$_POST['fnacimiento_afiliado']."',
							'".$_POST['telefono_afiliado']."',
							'".$_POST['email_afiliado']."',
							'".$clave_md5."',
							'1',
							'A',
							'".$sfecha."',
							'".$_POST['ced_afiliado']."',
							'0',
							'".$nacionalidad."'
							);
";  
if($rs= $conn->Execute($SQL)){
   ?><script>alert('Ha sido registrado exitosamente, usuario: <? echo $_POST['ced_afiliado']?> clave: <? echo $clave?>')</script><?

}
				
	/*			if($rs= $conn->Execute($SQL)){
				//SI GUARDA MANDA CORREO
				
			
				//ENVIANDO CORREO
					$from = "Ministerio del Poder Popular para el Proceso Social de Trabajo <sire@mpppst.gob.ve>";
					$address2 = $_POST["email_afiliado"]; 
					$subject2 = 'Divisiones de Previsión Social'; 					
					$message2 = "Sr(a). ".$_POST["nombre_afiliado"]." ".$_POST["apellido_afiliado"]."\n";
					$message2.="Le informamos que ha sido exitosamente registrado(a) en el Sistema de Informacion y Registro  de Prevision Social  \n\n";
					$message2.="Para ingresar al sistema, emplee la siguiente información:\n";	
					$message2.="Cedula: '".$cedula."'\n";
					$message2.="Contraseña: ".$clave."\n\n";
					$message2.="Nota: de no estar de acuerdo o desconocer el contenido de este correo, por favor reportarlo al correo al teléfono 0800(TRABAJO) 0800 872-22-56.	";
					//----------------------------------------------------


					require_once "Mail.php";
					$headers = array ('From' => $from,
					'To' => $address2,
					'Subject' => $subject2);
					$smtp = Mail::factory('smtp',
					array ('host' => $host_smtp_pear,
					'auth' => true,
					'username' => $username_smtp_pear,
					'password' => $password_smtp_pear));
					$mail = $smtp->send($address2, $headers, $message2);
					 if (PEAR::isError($mail)) {
						 //ERROR ENVIO
							header('Location:notificacion_error_correo.php');
						} else {
							//ENVIO CORRECTO
							header('Location:notificacion_bien_correo.php');
						}
					
				//	header('Location:notificacion_bien_correo.php');
				}else{
					header('Location:notificacion_error_correo.php');
			
				}
				
			*/	
}


//funcion que dibuja el encabezado de la pagina 
function showHeader(){
 include('../header.php'); 
}


function showForm($conn,$aDefaultForm){
?>
<form name="frm_trabajador" id="frm_trabajador" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
    <input id="action" name="action" type="hidden" value=""/>

    <input name="nombre_afiliado" type="hidden" value="<?=$aDefaultForm['nombre_afiliado']?>"/>
    <input name="apellido_afiliado" type="hidden" value="<?=$aDefaultForm['apellido_afiliado']?>"/>
    <input name="cbSexo_afiliado" type="hidden" value="<?=$aDefaultForm['cbSexo_afiliado']?>"/>
    <input name="fnacimiento_afiliado" type="hidden" value="<?=$aDefaultForm['fnacimiento_afiliado']?>"/>

    <input name="ced_afiliado2" type="hidden" value="<?=$aDefaultForm['ced_afiliado2']?>"/>

<script type="text/javascript" src="validar_trabajador_registro.js"></script>
<script type="text/javascript" src="funciones_registro.js"></script>
<script>
/*
	function send(saction){
				if(validar_formulario()==true){
				//	if (confirm("Por favor, antes de aceptar verifique minuciosamente los datos ingresados, ya que no podrán ser modificados posteriormente.")){
						if (confirm("¿REALMENTE ESTA SEGURO DE REALIZAR ESTA OPERACION? - SI ESTA SEGURO PRESIONE ACEPTAR ")){
							var form = document.frm_rnet_plantilla;
							form.action.value=saction;
							form.submit();	
						}
				//	}
				}
	}
*/	
	
	function send(saction){
	       if(saction=='Continuar'){
		   			if(validar_frm_trabajador()==true){
					var form = document.frm_trabajador;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_trabajador;
					form.action.value=saction;
					form.submit();				
			}		
	}
	
</script>
<table width="50%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
 <tr class="identificacion_seccion">
           <th  colspan="4"  class="titulo" align="center">REGISTRARSE</th>
        </tr>
        
        <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2" align="left">DATOS PERSONALES</th>
        </tr>	
  
        <tr>
          <td width="25%" align="right">C&eacute;dula de Identidad:</td>
          <td width="25s%">
                    <select name="cbCed_afiliado"  id="cbCed_afiliado">
                        <option value="V" <? if (($aDefaultForm['cbCed_afiliado'])=='V') print 'selected="selected"';?>>V</option>
                        <option value="E" <? if (($aDefaultForm['cbCed_afiliado'])=='E') print 'selected="selected"';?>>E</option>
                    </select>
         <input name="ced_afiliado" type="text" id="ced_afiliado"  onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['ced_afiliado']?>" size="20" maxlength="20" onBlur="consultar_saime(cbCed_afiliado.value+ced_afiliado.value);" />
         						<span class="requerido"> *</span>
          </td>
        </tr>
        <tr>
          <td align="right">Nombres:</td>
          <td><input name="nombre_afiliado" type="text"  id="nombre_afiliado"  onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['nombre_afiliado']?>" size="30" maxlength="30" disabled />
          <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td align="right">Apellidos:</td>
          <td><input name="apellido_afiliado" type="text" id="apellido_afiliado" onKeyPress="return permite(event, 'car')" value="<?=$aDefaultForm['apellido_afiliado']?>" size="30" maxlength="30" disabled />
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right" class="Estilo26">Sexo:</div></td>
          <td><select name="cbSexo_afiliado" id="cbSexo_afiliado" disabled>
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbSexo_afiliado'])=='1') print "selected=\"selected\"";?>>Femenino</option>
            <option value="2" <? if (($aDefaultForm['cbSexo_afiliado'])=='2') print "selected=\"selected\"";?>>Masculino</option>
          </select>
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right" class="Estilo26">Fecha nacimiento:</div></td>
          <td>
		  			<input name="fnacimiento_afiliado" type="text" class="tablaborde_shadow" id="fnacimiento_afiliado" value="<?=$aDefaultForm['fnacimiento_afiliado']?>" size="10" disabled/>
						<a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                <script type="text/javascript">//<![CDATA[
                             Calendar.setup({
                               inputField : "fnacimiento_afiliado",
                               trigger    : "f_rangeStart_trigger",
                               onSelect   : function() { this.hide() },
                               showTime   : false,
                               dateFormat : "%Y-%m-%d"
                             });
                           </script>
                <span class="requerido">*</span>      
      
      		</td>
        </tr>
	  <tr>
      <td align="right">Telefono:</td>
                <td><input name="telefono_afiliado" type="text" id="telefono_afiliado"  onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_afiliado']?>" size="30" maxlength="11"/>
                <span class="requerido"> *</span></td>    
    </tr>
	  <tr>
      <td align="right">Correo:</td>
                <td><input name="email_afiliado" type="text" id="email_afiliado"   value="<?=$aDefaultForm['email_afiliado']?>" size="30" maxlength="30" />
                <span class="requerido"> *</span></td>    
    </tr>	 
<tr>
      <td align="right">Confirmar Correo:</td>
                <td><input name="email_afiliado2" type="text" id="email_afiliado2"   value="<?=$aDefaultForm['email_afiliado2']?>" size="30" maxlength="30" />
                <span class="requerido"> *</span></td>    
    </tr>    <tr>
			<th colspan="2" align="center">
            <button type="button" name="Agregar" class="button_personal btn_agregar" onClick="send('Agregar')"  title=" Registrar Datos -  Haga Click para Registrar la Informaci&oacute;n" >Guardar</button>
				
								
          
          </th>
	</tr>
</table>

</form>
<?php
}
//funcion que imprime con alert todos los errores
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

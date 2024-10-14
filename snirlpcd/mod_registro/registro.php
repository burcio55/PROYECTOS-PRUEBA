<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../include/header.php');
/*include("general_LoadCombo.php"); 
include("../LoadCombos.php");
include('1_Validador.php');*/
$conn= getConnDB($db1);
$conn->debug = false;
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
		   
			
			case 'Guardar': 
			$bValidateSuccess=true;	
					
		if ($_POST['ced_afiliad']==""){ 
				$GLOBALS['aPageErrors'][]= "- La cédula: es requerido.";
				$bValidateSuccess=false;
		 }
		 
		if ($_POST['nacionalidad_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La nacionalidad es requerida.";
				$bValidateSuccess=false;
		 }	   
					
		if ($_POST['nombre_afiliado1']==""){
				$GLOBALS['aPageErrors'][]= "- El Primer Nombre: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("([a-z, A-Z])", trim($_POST['nombre_afiliado1']))){
				$GLOBALS['aPageErrors'][]= "- El Primer Nombre: es incorrecto.";
				$bValidateSuccess=false;
			    }
			 }

				 
		if ($_POST['apellido_afiliado1']==""){
				$GLOBALS['aPageErrors'][]= "- El Primer Apellido: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("([a-z, A-Z])", trim($_POST['apellido_afiliado1']))){
				$GLOBALS['aPageErrors'][]= "- El Primer Apellido: es incorrecto.";
				$bValidateSuccess=false;
			    }
			 }


		if ($_POST['fnacimiento_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La Fecha de naciemiento: es requerida.";
				$bValidateSuccess=false;
				 }

			  
		if ($_POST['cbSexo_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El Sexo: es requerido.";
				$bValidateSuccess=false;
				 }

			   				 		
		if ($_POST['codigo1']==""){
				$GLOBALS['aPageErrors'][]= "- El Código del Teléfono Personal: es requerido.";
				$bValidateSuccess=false;
				 }
			   				 		
		if ($_POST['telefono1']==""){
				$GLOBALS['aPageErrors'][]= "- El Teléfono Personal: es requerido.";
				$bValidateSuccess=false;
				 }

		if ($_POST['codigo2']==""){
				$GLOBALS['aPageErrors'][]= "- El Código del Teléfono Habitación: es requerido.";
				$bValidateSuccess=false;
				 }
			   				 		
		if ($_POST['telefono2']==""){
				$GLOBALS['aPageErrors'][]= "- El Teléfono Habitación: es requerido.";
				$bValidateSuccess=false;
				 }


		if ($_POST['email_afiliado1']==""){
			$GLOBALS['aPageErrors'][]= "- El Nombre del Correo Electrónico: es requerido.";
			$bValidateSuccess=false;
		}

		if ($_POST['email_afiliado']==""){
			$GLOBALS['aPageErrors'][]= "- El Nombre de Dominio del Correo Electrónico: es requerido.";
			$bValidateSuccess=false;
		}

		if ($_POST['email_afiliado2']==""){
			$GLOBALS['aPageErrors'][]= "- El Nombre del Correo Electrónico de confirmación: es requerido.";
			$bValidateSuccess=false;
		}

		if ($_POST['email_afiliado21']==""){
			$GLOBALS['aPageErrors'][]= "- El Nombre de Dominio del Correo Electrónico de Confirmacion: es requerido.";
			$bValidateSuccess=false;
		}


		if ($_POST['email_afiliado1']!="" and $_POST['email_afiliado']!=""){
					//mi correo @ mi dominio(gmail.com)
			$correo= $_POST['email_afiliado1'].'@'.$_POST['email_afiliado'];
				if(!ereg("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$correo)){
				$GLOBALS['aPageErrors'][]= "- El formato de Correo electrónico : es incorrecto.";
				$bValidateSuccess=false;
			    }
		}
		
			 
		if($_POST['email_afiliado1']!="" and $_POST['email_afiliado']!="" and $_POST['email_afiliado2']!="" and $_POST['email_afiliado21']!=""){
			if($_POST['email_afiliado1']!=$_POST['email_afiliado2'] or $_POST['email_afiliado']!=$_POST['email_afiliado21']){
				$GLOBALS['aPageErrors'][]= "- El campo del Correo Electronico y la Confirmacion: No coincide.";
				//$GLOBALS['ids_elementos_validar'][]='email_afiliado2';
				$bValidateSuccess=false;						
			}
		}
			 
		if($_POST['cbCed_afiliado']!="" and $_POST['ced_afiliado']!=""){
			$cedula=$_POST['cbCed_afiliado'].$_POST['ced_afiliado'];
			
					$SQL = "select * from personas  
					where cedula ='".$cedula."'"; 
					$rs = $conn->Execute($SQL);
			if ($rs->RecordCount()>0){
				//$GLOBALS['aPageErrors'][]= "- El(La) trabajador(a) Ya se encuentra registrado(a).";
				 ?><script>if (confirm("-  El(La) trabajador(a) ya se encuentra registrado."))
                    document.location="registro.php?";</script><?
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
    				$aDefaultForm['ced_afiliad']='';
					$aDefaultForm['nacionalidad_afiliado']='';
					$aDefaultForm['nombre_afiliado1']='';
					$aDefaultForm['nombre_afiliado2']='';
					$aDefaultForm['apellido_afiliado1']='';
					$aDefaultForm['apellido_afiliado2']='';
					$aDefaultForm['cbCed_afiliado']='';
					$aDefaultForm['ced_afiliado']='';
					$aDefaultForm['cbSexo_afiliado']='-1';
					$aDefaultForm['fnacimiento_afiliado']='';
					$aDefaultForm['codigo1']='';
					$aDefaultForm['telefono1']='';
					$aDefaultForm['codigo2']='';
					$aDefaultForm['telefono2']='';
					$aDefaultForm['email_afiliado1']='';
					$aDefaultForm['email_afiliado']='';
					$aDefaultForm['email_afiliado2']='';
					$aDefaultForm['email_afiliado21']='';
					
				
        
	if (!$bPostBack){
		/*AQUI SI TRAE DE BASE DE DATOS*/
		}else{
					$aDefaultForm['ced_afiliad']=$_POST['ced_afiliad'];
					$aDefaultForm['nacionalidad_afiliado']=$_POST['nacionalidad_afiliado'];
					$aDefaultForm['nombre_afiliado1']=$_POST['nombre_afiliado1'];
					$aDefaultForm['nombre_afiliado2']=$_POST['nombre_afiliado2'];
					$aDefaultForm['apellido_afiliado1']=$_POST['apellido_afiliado1'];
					$aDefaultForm['apellido_afiliado2']=$_POST['apellido_afiliado2'];
					$aDefaultForm['cbCed_afiliado']=$_POST['cbCed_afiliado'];
					$aDefaultForm['ced_afiliado']=$_POST['ced_afiliado'];
					$aDefaultForm['cbSexo_afiliado']=$_POST['cbSexo_afiliado'];
					$aDefaultForm['fnacimiento_afiliado']=$_POST['fnacimiento_afiliado']; 
					$aDefaultForm['codigo1']=$_POST['codigo1'];
					$aDefaultForm['telefono1']=$_POST['telefono1'];
					$aDefaultForm['codigo2']=$_POST['codigo2'];
					$aDefaultForm['telefono2']=$_POST['telefono2'];
					$aDefaultForm['email_afiliado1']=$_POST['telefono_afiliado1'];
					$aDefaultForm['email_afiliado']=$_POST['telefono_afiliado'];
					$aDefaultForm['email_afiliado2']=$_POST['telefono_afiliado2'];
					$aDefaultForm['email_afiliado21']=$_POST['telefono_afiliado21'];
					
					
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
}else{
	$nacionalidad='2';
}
$correo= $_POST['email_afiliado1'].'@'.$_POST['email_afiliado'];


           $SQL1= "INSERT INTO usuarios(
            cedula,
            nombres,
            apellidos,
            nacionalidad,
            sexo,
            f_nacimiento,
            telefono,
            correo,
            clave,
            tipo_usuario,
            status
                        )
                    VALUES (
                            '".$cedula."',
                            '".$_POST['nombre_afiliado1'].' '.$_POST['nombre_afiliado2']."',
                            '".$_POST['apellido_afiliado1'].' '.$_POST['apellido_afiliado2']."',
                            '".$nacionalidad."',
                            '".$_POST['cbSexo_afiliado']."',
                            '".$_POST['fnacimiento_afiliado']."',
                            '".$_POST['telefono1']."',
                            '".$correo."',
                            '".$clave_md5."',
                            '2',
                            'A'
                            )";

                     $conn->Execute($SQL1);
            //_________________________________________

			$SQL= "INSERT INTO personas(
            cedula, 
            nombres, 
            apellidos, 
            sexo, 
            f_nacimiento,  
            telefono,
            otro_telefono, 
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
							'".$_POST['nombre_afiliado1'].' '.$_POST['nombre_afiliado2']."',
							'".$_POST['apellido_afiliado1'].' '.$_POST['apellido_afiliado2']."',
							'".$_POST['cbSexo_afiliado']."',
							'".$_POST['fnacimiento_afiliado']."',
							'".$_POST['codigo1'].$_POST['telefono1']."',
							'".$_POST['codigo2'].$_POST['telefono2']."',
							'".$correo."',
							'".$clave_md5."',
							'2',
							'A',
							'".$sfecha."',
							'".$_POST['ced_afiliado']."',
							'0',
							'".$nacionalidad."'
							);
";  
if($rs= $conn->Execute($SQL)){
   ?><script> alert('Ha sido registrado exitosamente, usuario: <? echo $_POST['ced_afiliado']?> clave: <? echo $clave?>')
                    document.location="registro.php?";</script><?
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

    <input class="fa fa-at" name="nombre_afiliado1" type="hidden" value="<?=$aDefaultForm['nombre_afiliado1']?>"/>
    <input class="fa fa-at" name="nombre_afiliado2" type="hidden" value="<?=$aDefaultForm['nombre_afiliado2']?>"/>
    <input class="fa fa-at" name="apellido_afiliado1" type="hidden" value="<?=$aDefaultForm['apellido_afiliado1']?>"/>
    <input class="fa fa-at" name="apellido_afiliado2" type="hidden" value="<?=$aDefaultForm['apellido_afiliado2']?>"/>
    <input class="fa fa-address-card" name="ced_afiliad" type="hidden" value="<?=$aDefaultForm['ced_afiliad']?>"/>
    <input class="" name="nacionalidad_afiliado" type="hidden" value="<?=$aDefaultForm['nacionalidad_afiliado']?>"/>
    <input class="" name="cbSexo_afiliado" type="hidden" value="<?=$aDefaultForm['cbSexo_afiliado']?>"/>
    <input class="fa fa-calendar" name="fnacimiento_afiliado" type="hidden" value="<?=$aDefaultForm['fnacimiento_afiliado']?>"/>
	<input class="fas fa-phone-alt" name="codigo1" type="hidden" value="<?=$aDefaultForm['codigo1']?>"/>
	<input class="" name="codigo2" type="hidden" value="<?=$aDefaultForm['codigo2']?>"/>
	<input class="fas fa-phone-alt" name="telefono1" type="hidden" value="<?=$aDefaultForm['telefono1']?>"/>
	<input class="" name="telefono2" type="hidden" value="<?=$aDefaultForm['telefono2']?>"/>
	<input class="fas fa-envelope" name="email_afiliado1" type="hidden" value="<?=$aDefaultForm['email_afiliado1']?>"/>
	<input class="" name="email_afiliado" type="hidden" value="<?=$aDefaultForm['email_afiliado']?>"/>
	<input class="fas fa-envelope" name="email_afiliado2" type="hidden" value="<?=$aDefaultForm['email_afiliado2']?>"/>
	<input class="" name="email_afiliado21" type="hidden" value="<?=$aDefaultForm['email_afiliado21']?>"/>


    <input name="ced_afiliado2" type="hidden" value="<?=$aDefaultForm['ced_afiliado2']?>"/>
	<table width="95%" border="0" align="center" class="formulario">
        <tr>
           <th colspan="4" class="titulo" align="center">REGISTRARSE</th>
           </tr>
           <tr>
          <th colspan="2" style="background-color:#F0F0F0; color:#666" class="icon-address-card"><div align="right" >C&eacute;dula de Identidad: <i class="icon-address-card"></i></div></th>
          
          <td colspan="2">
         <select name="cbCed_afiliado"  id="cbCed_afiliado">
         <option value="V" <? if (($aDefaultForm['cbCed_afiliado'])=='V') print 'selected="selected"';?>>V</option>
         <option value="E" <? if (($aDefaultForm['cbCed_afiliado'])=='E') print 'selected="selected"';?>>E</option>
         </select>
         <input name="ced_afiliado" type="text" id="ced_afiliado"  onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['ced_afiliado']?>" size="20" maxlength="8" onBlur="consultar_saime(cbCed_afiliado.value+'|'+ced_afiliado.value);" />
         						<span class="requerido"><i style="color: Black" class="icon-address-card"></i> *</span>
          </td>
        </tr>
	</table>	
	<div class="container">
	    <div class="app">
			<div>
	            <div class="row">
	                <div class="col-md-10">
					     <div class="card">
		                     <div class="card-header text-left alert-primary">
        		                <h3 class="card-title" style="color: #FFFFFF">DATOS PERSONALES</h3>
                		     </div>						 
						 </div>
					</div>
				</div>
	            <div class="row">
					<div class="col-md-3">
						<div>
							 <label for="nacionalidad" class="text-secondary">Nacionalidad</label>
						</div>
					</div>
					 <div class="col-md-2">
						<div class="icheck-gray d-inline">
							<input type="radio" id="radioPrimary01" name="r01" checked="">
							<label for="radioPrimary01" class="text-secondary">Venezolano
							</label>
						</div>
						<div class="icheck-gray d-inline">
							<input type="radio" id="radioPrimary02" name="r01">
							<label for="radioPrimary02" class="text-secondary">Extranjero
							</label>
						</div>
		
					</div>

					<div class="col-md-2">
						<!-- text input -->
						<label class="text-secondary">Cédula de Identidad</label>
						<!--<input type="text" class="form-control" placeholder="Cédula" disabled>-->
					</div>
					<div class="col-md-3">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-address-card"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="Cédula de Identidad" value="<?=$aDefaultForm['ced_afiliad']?>" disabled>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	

<script type="text/javascript" src="validar_trabajador_registro.js"></script>
<script type="text/javascript" src="funciones_registro.js"></script>
<script>	
	
	function send(saction){
        if(saction=='Guardar'){
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

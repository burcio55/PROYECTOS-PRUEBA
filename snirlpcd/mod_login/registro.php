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

    <input name="nombre_afiliado1" type="hidden" value="<?=$aDefaultForm['nombre_afiliado1']?>"/>
    <input name="nombre_afiliado2" type="hidden" value="<?=$aDefaultForm['nombre_afiliado2']?>"/>
    <input name="apellido_afiliado1" type="hidden" value="<?=$aDefaultForm['apellido_afiliado1']?>"/>
    <input name="apellido_afiliado2" type="hidden" value="<?=$aDefaultForm['apellido_afiliado2']?>"/>
    <input name="ced_afiliad" type="hidden" value="<?=$aDefaultForm['ced_afiliad']?>"/>
    <input name="nacionalidad_afiliado" type="hidden" value="<?=$aDefaultForm['nacionalidad_afiliado']?>"/>
    <input name="cbSexo_afiliado" type="hidden" value="<?=$aDefaultForm['cbSexo_afiliado']?>"/>
    <input name="fnacimiento_afiliado" type="hidden" value="<?=$aDefaultForm['fnacimiento_afiliado']?>"/>
	<input name="codigo1" type="hidden" value="<?=$aDefaultForm['codigo1']?>"/>
	<input name="codigo2" type="hidden" value="<?=$aDefaultForm['codigo2']?>"/>
	<input name="telefono1" type="hidden" value="<?=$aDefaultForm['telefono1']?>"/>
	<input name="telefono2" type="hidden" value="<?=$aDefaultForm['telefono2']?>"/>
	<input name="email_afiliado1" type="hidden" value="<?=$aDefaultForm['email_afiliado1']?>"/>
	<input name="email_afiliado" type="hidden" value="<?=$aDefaultForm['email_afiliado']?>"/>
	<input name="email_afiliado2" type="hidden" value="<?=$aDefaultForm['email_afiliado2']?>"/>
	<input name="email_afiliado21" type="hidden" value="<?=$aDefaultForm['email_afiliado21']?>"/>


    <input name="ced_afiliado2" type="hidden" value="<?=$aDefaultForm['ced_afiliado2']?>"/>

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




<table width="95%" border="0" align="center" class="formulario">
        <tr>
           <th colspan="4" class="titulo" align="center">REGISTRARSE</th>
           </tr>
           <tr>
          <th colspan="2" style="background-color:#F0F0F0; color:#666"  ><div align="right" >C&eacute;dula de Identidad:</div></th>
          
          <td colspan="2">
         <select name="cbCed_afiliado"  id="cbCed_afiliado">
         <option value="V" <? if (($aDefaultForm['cbCed_afiliado'])=='V') print 'selected="selected"';?>>V</option>
         <option value="E" <? if (($aDefaultForm['cbCed_afiliado'])=='E') print 'selected="selected"';?>>E</option>
         </select>
         <input name="ced_afiliado" type="text" id="ced_afiliado"  onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['ced_afiliado']?>" size="20" maxlength="8" onBlur="consultar_saime(cbCed_afiliado.value+'|'+ced_afiliado.value);" />
         						<span class="requerido"> *</span>
          </td>
        </tr>
       	<tr>
          	<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      	</tr>
        
        <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2" align="left">DATOS PERSONALES</th>
        </tr>	
            <tr>
            <td style="background-color:#F0F0F0; color:#666" align="center"><strong>C&eacute;dula de Identidad</strong></td>
            
            <td style="background-color:#F0F0F0;" align="center"><input name="ced_afiliad" type="text" id="ced_afiliad" value="<?=$aDefaultForm['ced_afiliad']?>" disabled="true" style="width: 95%" /></td>
            
            <td style="background-color:#F0F0F0; color:#666" align="center"><strong>Nacionalidad </strong></td>
            
            <td style="background-color:#F0F0F0;" align="center"><input name="nacionalidad_afiliado" type="text" id="nacionalidad_afiliado" value="<?=$aDefaultForm['nacionalidad_afiliado']?>" disabled="true" style="width: 95%" /></td>
        </tr>
    
        <tr>
            <th width="25%" class="sub_titulo" align="center">Primer Apellido</th>		
            <th width="25%" class="sub_titulo" align="center">Segundo Apellido</th>
            <th width="25%" class="sub_titulo" align="center">Primer Nombre</th>
            <th width="25%" class="sub_titulo" align="center">Segundo Nombre</th>  
        </tr>
        
     	<tr>
      		<td style="background-color:#F0F0F0;" align="center"><input name="apellido_afiliado1" type="text" id="apellido_afiliado1" value="<?=$aDefaultForm['apellido_afiliado1']?>" disabled="true" style="width: 95%" /></td>
            
            
    <!--
                <td width="31%">
                  <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>                                            
                    <input
                    type="text"
                    class="form-control"
                    id="apellido_afiliado1"
                    name="apellido_afiliado1"
                    maxlength="10"
                    size="28"      
                    value="<?=$aDefaultForm['apellido_afiliado1']?>"                  
                    readonly             
                  />
                  </div>             
                </td>-->
            
            
            
            
            
            
            
            
            
            
            
      		<td style="background-color:#F0F0F0;" align="center"><input name="apellido_afiliado2" type="text" id="apellido_afiliado2" value="<?=$aDefaultForm['apellido_afiliado2']?>" disabled="true" style="width: 95%" /></td>
      		<td style="background-color:#F0F0F0;" align="center"><input name="nombre_afiliado1" type="text" id="nombre_afiliado1" value="<?=$aDefaultForm['nombre_afiliado1']?>" disabled="true" style="width: 95%" /></td>
      		<td style="background-color:#F0F0F0;" align="center"><input name="nombre_afiliado2" type="text" id="nombre_afiliado2" value="<?=$aDefaultForm['nombre_afiliado2']?>" disabled="true" style="width: 95%" /></td>
        </tr>

        
        <tr>  
            <th width="25%" class="sub_titulo" align="center">Fecha de Nacimiento</th>
            <th width="25%" class="sub_titulo" align="center">Sexo</th> 
            <th width="25%" class="sub_titulo" align="center">Tel&eacute;fono Personal</th>
            <th width="25%" class="sub_titulo" align="center">Tel&eacute;fono Habitaci&oacute;n</th>
        </tr>            
                
             <tr>
	    	<td style="background-color:#F0F0F0;" align="center"><input name="fnacimiento_afiliado" type="text" id="fnacimiento_afiliado" value="" disabled="true" style="width: 95%" /></td>
		   <td style="background-color:#F0F0F0;" align="center">
		    	<select id="cbSexo_afiliado" name="cbSexo_afiliado" style="width: 90%" disabled="true">
                    <option value="-1" selected="selected">Seleccione</option>
                <option value="1" <? if (($aDefaultForm['cbSexo_afiliado'])=='1') print "selected=\"selected\"";?>>FEMENINO</option>
                <option value="2" <? if (($aDefaultForm['cbSexo_afiliado'])=='2') print "selected=\"selected\"";?>>MASCULINO</option>
                </select>
		    </td>
            
            
       
                    <td style="background-color:#F0F0F0;" align="center">
                    	<select name="codigo1" id="codigo1" title="Código de Telefonía - Seleccione solo una opción del listado" >
                        	<option value="">----</option>
							<option value="0416">0416</option>
							<option value="0426">0426</option>
							<option value="0414">0414</option>
							<option value="0424">0424</option>
							<option value="0412">0412</option>       
						</select>
						 -  
						<input name="telefono1" type="text" id="telefono1" onkeypress="return isNumberKey(event);" title="Tel&eacute;fono Personal - Ingrese s&oacute;lo N&uacute;meros. Acepta 7 d&iacute;gitos. Ejemplo: 1234567"  placeholder="N° teléfono" size="8" maxlength="7" value="" autocomplete="off" style="width: 45%" /> 
					  <span>*</span>
                    </td>
                    <td style="background-color:#F0F0F0;" align="center" >
                    <input name="codigo2" type="text" id="codigo2" onkeypress="return isNumberKey(event);" title="C&oacute;digo de &Aacute;rea - Ingrese s&oacute;lo N&uacute;meros. Acepta 4 d&iacute;gitos. Ejemplo: 0212"placeholder="Cód." size="4" maxlength="4" value="" autocomplete="off" />
						 -  
						<input name="telefono2" type="text" id="telefono2" onkeypress="return isNumberKey(event);" title="Tel&eacute;fono Habitaci&oacute;n - Ingrese s&oacute;lo N&uacute;meros. Acepta 7 d&iacute;gitos. Ejemplo: 1234567" placeholder="N° teléfono" size="8" maxlength="7" value="" autocomplete="off" style="width: 50%" />
                        <span> * </span>
                    </td>
       </tr> 

        <tr>
            <th colspan="2" class="sub_titulo" align="center">Correo Electr&oacute;nico Personal</th>		
            <th colspan="2" class="sub_titulo" align="center">Confirmar Correo Electr&oacute;nico Personal</th>
        </tr>

	  <tr >
                <td style="background-color:#F0F0F0;" align="center" colspan="2"><input name="email_afiliado1"  type="text" id="email_afiliado1" title="Correo electronico -  Ejemplo: micorreo,jperez,inv123.ca, otros"  value="<?=$aDefaultForm['email_afiliado']?>" size="10" maxlength="10" placeholder="micorreo"  />@
                
                <input name="email_afiliado"  type="text" id="email_afiliado"   value="<?=$aDefaultForm['email_afiliado1']?>" title="Correo electronico -  Ejemplo: gmail.com,hotmail.com,otros"  placeholder="dominio.com" size="10" maxlength="10" />
                <span class="requerido"> *</span></td>    

                <td style="background-color:#F0F0F0;" align="center" colspan="2"><input name="email_afiliado2" type="text" id="email_afiliado2" title="Confirmar Correo electronico -  Ejemplo: micorreo,jperez,inv123.ca, otros" placeholder="micorreo" value="<?=$aDefaultForm['email_afiliado2']?>" size="10" maxlength="10" />@<input name="email_afiliado21"  type="text" id="email_afiliado21"  title="Confirmar Correo electronico -  Ejemplo: gmail.com,hotmail.com,otros" value="<?=$aDefaultForm['email_afiliado21']?>" size="10" maxlength="10" placeholder="dominio.com" />
                <span class="requerido"> *</span></td>    
    </tr>    
    
        <tr>
            <th colspan="4">&nbsp;</th>		
        </tr>  
<!--    <tr>
			<th colspan="4" align="center">
            <button type="button" name="Agregar" class="button_personal btn_agregar" onClick="send('Agregar')"  title=" Registrar Datos -  Haga Click para Registrar la Informaci&oacute;n" >Guardar</button>
				
								
          
          </th>
	</tr>-->
    
    
         <tr>
         <td colspan="4" align="center">
       <button type="button" class="button_personal btn_guardar" onclick="javascript:send('Guardar');" title="Guardar Registro -  Haga Click para Guardar la Informaci&oacute;n">Guardar</button>
        <button type="button" name="regresar"  id="regresar" class="button_personal btn_regresar"  onclick="window.location.href = '../mod_login/login.php'" target="_self">Ir a P&aacute;gina Principal</button>
          </td>
     </tr>
     
             <tr>
            <th colspan="4">&nbsp;</th>		
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

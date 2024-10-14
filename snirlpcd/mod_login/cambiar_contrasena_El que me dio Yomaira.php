<?php 
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../header.php');
include('../include/header.php');

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];//include("funciones_cambiar_contrasena.php"); 

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

$_SESSION['id_usuario']=13885175;

//debug();
doAction();


function doAction(){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'guardar':
						$bValidateSuccess=true;
						
						if (!valid_password($_POST['pswd'], 1)) //el 1 indica input contraseña
						{
							$GLOBALS['ids_elementos_validar'][]='pswd';
							$bValidateSuccess=false;
						}
						
						if (!valid_password($_POST['pswd2'], 2)) //el 2 indica input confirmar contraseña
						{
							$GLOBALS['ids_elementos_validar'][]='pswd2';
							$bValidateSuccess=false;
						}

						if($bValidateSuccess){
							ProcessForm($_POST['pswd2']);
							LoadData(true);
						}
				break;
				
				case'regresar':
				print "<script>document.location='/ceet/mod_login/login.php';</script>";
		    	break;
			}
		}else{
		LoadData(false);
	}
 }
 
 
 
function valid_password($val,$i)
{ 
	$bValidateSuccess=true;
	$msj[1] = "- El campo Nueva ContraseÃ±a: ";
	$msj[2] = "- El campo Confirmar Nueva ContraseÃ±a: ";
	if($val=='')
	{
		$GLOBALS['aPageErrors'][]= "$msj[$i] no puede estar vac\u00EDo";
		$bValidateSuccess=false;
	}
	else{
		if(strlen($val) < 8)
		{
			$GLOBALS['aPageErrors'][]= "$msj[$i] es demasiado corto";
			$bValidateSuccess=false;
		}
		else if(strlen($val) > 15)
		{
			$GLOBALS['aPageErrors'][]= "$msj[$i] es demasiado largo";
			$bValidateSuccess=false;
		}
		else if ($_POST['pswd']==$_POST['pswd2']) //el 2 indica input confirmar contraseña
		{
			if(!preg_match('/(?=[@#%&]|-|_)/', $val))
			{
				$GLOBALS['aPageErrors'][]= "$msj[$i] debe contener al menos uno de los siguientes simbolos: @#%&-_";
				$bValidateSuccess=false;
			}
			if(!preg_match('/(?=\d)/', $val)) 
			{
				$GLOBALS['aPageErrors'][]= "$msj[$i] debe contener al menos un digito";
				$bValidateSuccess=false;
			}
			if(!preg_match('/(?=[a-z])/', $val)) 
			{
				$GLOBALS['aPageErrors'][]= "$msj[$i] debe contener al menos una minuscula";
				$bValidateSuccess=false;
			}
			if(!preg_match('/(?=[A-Z])/', $val)) 
			{
				$GLOBALS['aPageErrors'][]= "$msj[$i] debe contener al menos una mayuscula";
				$bValidateSuccess=false;
			}
		}
		else{
			$GLOBALS['aPageErrors'][]= "- Las ContraseÃ±as no coinciden.";
			$bValidateSuccess=false;
		}
	}
	return $bValidateSuccess;
}
//-----------------------------------------------------------------------------//
function LoadData($bPostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];

		if (!$bPostBack){
		
				
		}else{
					
		}
	}
}

function ProcessForm($clave){
	global $conn;
	$SQL= "UPDATE public.usuarios 
	 SET clave='".trim(md5($clave))."'
	
	WHERE cedula='".$_SESSION['id_usuario']."'
	";
	
	/* AND nenabled='1'
	--,
	--dfecha_actualizacion='".date('Y-m-d H:i:s')."',
	--nusuario_actualizacion='".$_SESSION['id_usuario']."'*/
	$rs = $conn->Execute($SQL);
	if($rs){
	?>
	<script>
		alert("La contraseÃ±a fue generada de manera exitosa."); 
		//window.location="/minpptrassi/vista.php";
	</script>
	<?php
	}
}
?>
<link rel="stylesheet" type="text/css" media="all" href="../css/styles_cambiaclave.css" />
<script src="funciones_cambiar_contrasena.js"></script>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody><tr valign="top">
	<td>

	<h1>Establecer Una Contrase&ntilde;a Nueva</h1>
		<p>&nbsp;</p>
		<table width="60	%" border="0" align="center">
		  <tr>
			<td width="50%"><form name="form" id="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
			<input name="action" type="hidden" value="" />
				<ul>
					<li>
						<label for="pswd">Nueva contrase&ntilde;a:</label>
						<span><input class="form-control" id="pswd" type="password" name="pswd" onkeyup="muestra_seguridad_clave(this.value, this.form)" /></span>
					</li>
					<li>
						<label for="pswd2">Confirmar nueva contrase&ntilde;a:</label>
						<span><input class="form-control" id="pswd2" type="password" name="pswd2" /></span>
					</li>
					<li>
						<button type="button" class="button_personal btn_guardar" onclick="javascript:aceptar('guardar');" title="Haga Click para guardar la contraseña">Guardar</button>  
						
						<!--<button type="button" class="button_personal btn_regresar" onclick="javascript:regresar('regresar');" title="Haga Click para Regresar al Men&uacute; Principal">Regresar</button>--> 
						
						<button type="button" class="button_personal btn_limpiar" onclick="javascript:limpiar();" title="Haga Click para Limpiar">Limpiar</button>
					</li>
				</ul>	
			</form></td>
			<td width="50%"><div id="pswd_info">
			  <h4>Defina una contrase&ntilde;a que cumpla las siguientes Caracteristicas:</h4>
				<h4 id="seguridad">Nivel de Seguridad: 0%</h4>
				<ul>
					<li id="letter" class="invalid">Al Menos <strong>Una Letra Min&uacute;scula</strong></li>
					<li id="capital" class="invalid">Al Menos <strong>Una Letra May&uacute;scula</strong></li>
					<li id="number" class="invalid">Al Menos <strong>Un N&uacute;mero</strong></li>
					<li id="character" class="invalid">Al Menos <strong>Un Caracter  @ # % & </li>
					<li id="length" class="invalid">Debe Contener mas de <strong>8 Caracteres</strong></li>
					<li id="letter2" class="invalid">La Contrase&ntilde;a <strong>No Coinciden</strong></li>
				</ul>
			</div></td>
		  </tr>
		</table>
    		
	</td>
	</tr>
	</tbody></table>

<div id="loader" class="loaders" style="display: none;"></div>
	
<?php include("../footer.php"); ?>
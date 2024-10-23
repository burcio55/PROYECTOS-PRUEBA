<?php
function doAction(){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'guardar':
						$bValidateSuccess=true;
						
						if (!valid_password($_POST['pswd'], 1)) //el 1 indica input contrase�a
						{
							$GLOBALS['ids_elementos_validar'][]='pswd';
							$bValidateSuccess=false;
						}
						
						if (!valid_password($_POST['pswd2'], 2)) //el 2 indica input confirmar contrase�a
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
				print "<script>document.location='/minpptrassi/vista.php';</script>";
		    	break;
			}
		}else{
		LoadData(false);
	}
 }
 
 
 
function valid_password($val,$i)
{ 
	$bValidateSuccess=true;
	$msj[1] = "- El campo Nueva Contraseña: ";
	$msj[2] = "- El campo Confirmar Nueva Contraseña: ";
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
		else if ($_POST['pswd']==$_POST['pswd2']) //el 2 indica input confirmar contrase�a
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
			$GLOBALS['aPageErrors'][]= "- Las Contraseñas no coinciden.";
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
	$SQL= "UPDATE public.sesion 
	 SET clave='".trim(md5($clave))."',
	dfecha_actualizacion='".date('Y-m-d H:i:s')."',
	nusuario_actualizacion='".$_SESSION['id_usuario']."'
	WHERE personales_cedula='".$_SESSION['id_usuario']."'
	AND nenabled='1'";
	$rs = $conn->Execute($SQL);
	?>
	<script>
		alert("La contraseña fue generada de manera exitosa."); 
		window.location="/minpptrassi/vista.php";
	</script>
	<?php
}
?>
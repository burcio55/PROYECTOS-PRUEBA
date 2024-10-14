<?php
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
				session_unset();
				session_destroy();
				print "<script>document.location='/silpd/mod_login/login.php';</script>";
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
	
	WHERE cedula='".$_SESSION['nusuario']."'
	";
	
/*	dfecha_actualizacion='".date('Y-m-d H:i:s')."',
	nusuario_actualizacion='".$_SESSION['id_usuario']."'
	AND nenabled='1'*/
	$rs = $conn->Execute($SQL);
	
	if($rs){
		/*$id=$_SESSION['id_usuario'];
		$identi=$_SESSION['id_usuario'];
		$us=$_SESSION['id_usuario'];
		$mod='23';			    
		$auditoria= new Trazas; 
		$auditoria->auditor($id,$identi,$SQL,$us,$mod);*/
		/*session_unset();
		session_destroy();*/
		$_SESSION['vista'] = 2;
	?>
    
	<script>
		alert("La contraseña fue generada de manera exitosa."); 
		//window.location="/ceet/mod_login/login.php";	
		
		window.location="/silpd/mod_registro/inicio.php";
		
	</script>
    
	<?php
	}
}
?>
<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);
	//inicio de sesion
	  session_start();



	


require_once('usuario.php');
require_once('crud_usuario.php');

	

require_once('conexion.php'); 
//echo "BASES DE DATOS ".$db1." ".$db2;


$conn= getConnDB($db1,$db2);
$conn->debug = false;
  
//echo "ENTRANDOOOOOOOOOOOOOOOOOOOO";
//var_dump($_POST);
//var_dump($_SESSION);

//	$usuario=new Usuario();
	
	/*verifica si la variable registrarse está definida
	se da que está definicda cuando el usuario se loguea, ya que la envía en la petición*/
	/*if (isset($_POST['registrarse'])) {
		$usuario->setNac($_POST['nac']);
		$usuario->setClave($_POST['clave']);
		$usuario->setClave($_POST['doc']);
		if ($crud->buscarUsuario($_POST['nac'], $_POST['doc'], $_POST['clave'])) {
			//$crud->insertar($usuario);
			header('Location: index.php');
		}else{
			header('Location: error.php?mensaje=El nombre de usuario ya existe');
		}		
		
	}elseif*/ 
	if (isset($_POST['nac']) and isset($_POST['doc']) and isset($_POST['clave'])) { //verifica si la variable entrar está definida
		
	
		$usuario=new CrudUsuario();
		$arreglo_user=$usuario->obtenerUsuario($_POST['nac'],$_POST['doc'], $_POST['clave']);
		//$crud->obtenerUsuario($_POST['nac'],$_POST['doc'], $_POST['clave']);
	//echo "ENTRANDO";		
		
		// si el id del objeto retornado no es null, quiere decir que encontro un registro en la base
		//var_dump($arreglo_user);
		
		
		
		if ($arreglo_user['id']!=NULL) {
           $nommbre_sesion= $arreglo_user['nombres'];
           $apellido_sesion=$arreglo_user['apellidos'];
         //  echo "Bienvenida (o): ".$nommbre_sesion. " ".$apellido_sesion;
        //$_SESSION['usuario']=$usuario;
       // print_r($_SESSION['usuario']);
			
			$_SESSION['usuario']=$arreglo_user['id'];
			//si el usuario se encuentra, crea la sesión de usuario
			//header('Location:index-vista.php'); //envia a la página que simula la cuenta
			header('Content-type: application/json; charset=utf-8');
			echo json_encode(array('datos' => 'ENTRO'));
		}else{
			header('Content-type: application/json; charset=utf-8');
			echo json_encode(array('datos' => 'ERROR'));
			//header('Location: pagina-error404.html?mensaje=Tus nombre de usuario o clave son incorrectos'); // cuando los datos son incorrectos envia a la página de error
		}
	}elseif(isset($_POST['salir'])){ // cuando presiona el botòn salir
		header('Location: pagina-inicio-sesion.php');
		unset($_SESSION['usuario']); //destruye la sesión
	}
?>
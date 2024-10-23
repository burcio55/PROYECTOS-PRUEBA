
<?php 
session_start();
    //unset($_SESSION['usuario']);

    ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

//if(isset($_POST['salir'])){ // cuando presiona el botòn salir
       unset($_SESSION['usuario']); //destruye la sesión
		header('Location: pagina-inicio-sesion.php');
		//unset($_SESSION['usuario']); //destruye la sesión
	//}
		?>
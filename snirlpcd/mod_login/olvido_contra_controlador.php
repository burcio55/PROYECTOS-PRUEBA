<?php
	session_start();

	//VARIABLES PARA LA CONEXION CON SNIRLPCD

	$host = "10.46.1.93";
	$dbname = "minpptrasse";
	$user = "postgres";
	$pass = "postgres";

	//CONEXIÓN CON LA BD

	try {
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
    }
    catch(PDOException $error){
        $conn = $error;
        echo ("Error al conectar en la Base de Datos ".$error);
    } 

	//ESTRAER DATOS DEL USUARIO

	if (isset($_SESSION['ncedula'])) {

        $cedula = $_SESSION["ncedula"];

        $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
        $row = pg_query($conn, $consulta);
        $persona = pg_fetch_assoc($row);

        $id = $persona["id"];
    }

	//RECIBIR VARIABLE

	$clave = $_REQUEST['clave'];

	//VALIDACIONES

	/* $mayus = 0;
	$minus = 0;
	$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@_-/*$";
	for ($i=0; $i<strlen ($clave); $i++){
		if (!ereg("^[a-zA-Z0-9\-*_$@/]{10,}$", $clave)){
		   echo "1 / ".$clave . " no es válido";
		   die();
		}else
		if($clave[$i] == strtoupper($clave[$i])){
			$mayus = 1;
		}else
		if($clave[$i] == strtolower($clave[$i])){
			$minus = 1;
		}
		$valor = $i;
	}
	if(is_numeric($clave)){
		echo "1 / La contraseña debe contar con al menos un número";
		die();
	}else
	if(strlen($clave)<10){
		echo "1 / La contraseña no puede ser menor a 10 caracteres";
		die();
	} */

	if (!ereg("[a-z]",$clave)){
		echo "1 / Debe poseer letras minúsculas";
		die();
	}
	if (!ereg("[A-Z]",$clave)){
		echo "1 / Debe poseer letras mayúsculas";
		die();
	}
	if (!ereg("[0-9]",$clave)){
		echo "1 / Debe poseer al menos un Número";
		die();
	}
	if (strlen($clave)<10){
		echo "1 / No puede ser menor a 10 caracteres";
		die();
	}

	//ENCRIPTAR CONTRASEÑA

	$clave = password_hash($clave,PASSWORD_DEFAULT);

	//MODIFICAR CLAVE

	$PG = "UPDATE";
	$PG .= " snirlpcd.persona";
	$PG .= " SET";
	$PG .= " clave ='$clave'";
	$PG .= " WHERE";
	$PG .= " id='$id';";

	if($row = pg_query($conn,$PG)){
		echo "2 / Se actualizó sus datos exitosamente";
	}else{
		echo "1 / Se presentó un error por favor intente más tarde $PG";
	}
	
?>
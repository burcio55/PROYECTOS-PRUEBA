<?php

session_start();
include('../include/header.php');

// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

$host2 = "10.46.1.93";
$dbname2 = "entes";
$user2 = "postgres";
$pass2 = "postgres";

//CONECTAR CON LA BASE DE DATOS

try {
	$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
	$conn = $error;
	echo ("1 / Error al conectar en la Base de Datos " . $error);
}

try {
	$conex = pg_connect("host=$host2 port=5432 dbname=$dbname2 user=$user2 password=$pass2");
} catch (PDOException $error) {
	$conex = $error;
	echo ("1 / Error al conectar en la Base de Datos " . $error);
}

//VALIDAR QUE ACCIÓN O VALIDACION VA HACER

$accion = $_REQUEST['accion'];

if ($accion == '1') {

	//TRAER LOS DATOS DEL AJAX

	$nacionalidad = $_REQUEST['nacionalidad'];
	$cedula = $_REQUEST['cedula'];

	//VALIDACIONES

	if ($nacionalidad == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($cedula == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}

	//CONSULATAR SI HAY REGISTRO DEL USUARIO EN SAIME

	$sql = " SELECT ";
	$sql .= " * ";
	$sql .= " FROM ";
	$sql .= " public.saime ";
	$sql .= " WHERE ";
	$sql .= " numcedula = ";
	$sql .= " '$cedula' ";
	$sql .= " AND ";
	$sql .= " letra = ";
	$sql .= " '$nacionalidad' ";
	$row = pg_query($conex, $sql);
	$valor = pg_fetch_assoc($row);

	//VALIDACIONES

	if ($valor == '') {
		echo "1 / Usted no se encuentra registrado en nuestra data SAIME, por lo que se le agradece enviar su Cédula de Identidad en formato pdf al siguiente Correo Electrónico: snirlpd@mpppst.gob.ve";
		die();
	} else {

		//VERIFICAR QUE EL USUARIO ESTÁ REGISTRADO EN EL SISTEMA

		$sql2 = " SELECT ";
		$sql2 .= " * ";
		$sql2 .= " FROM ";
		$sql2 .= " snirlpcd.persona ";
		$sql2 .= " WHERE ";
		$sql2 .= " ncedula = ";
		$sql2 .= " '$cedula' ";
		$sql2 .= " AND ";
		$sql2 .= " benabled = ";
		$sql2 .= " 'true' ";
		$row2 = pg_query($conn, $sql2);
		$valor2 = pg_fetch_assoc($row2);

		//VALIDACIONES

		if ($valor2 == '') {
			if (RTRIM($valor['sexo']) == 'M') {
				$valor['sexo'] = '2';
			} else {
				$valor['sexo'] = '1';
			}
			echo  "2 / " . RTRIM($valor['primer_nombre']) . " / " . RTRIM($valor['segundo_nombre']) . " / " . RTRIM($valor['primer_apellido']) . " / " . RTRIM($valor['segundo_apellido']) . " / " . $valor['sexo'];
		} else {
			echo "3 / Usuario ya registrado en el sistema";
			die();
		}
	}
} else if ($accion == '2') {

	//TRAER LOS DATOS DEL AJAX

	$nacionalidad = $_REQUEST['nacionalidad'];
	$cedula = $_REQUEST['cedula'];
	$nombre1 = strtoupper($_REQUEST['nombre1']);
	$nombre2 = strtoupper($_REQUEST['nombre2']);
	$apellido1 = strtoupper($_REQUEST['apellido1']);
	$apellido2 = strtoupper($_REQUEST['apellido2']);
	$sexo = $_REQUEST['sexo'];
	$fnacimiento = $_REQUEST['fnacimiento'];
	$telefono = $_REQUEST['telefono'];
	$telefono2 = $_REQUEST['telefono2'];
	$email = $_REQUEST['email'];
	$email2 = $_REQUEST['email2'];

	//VALIDAR CAMPOS VACIOS 

	/* if ($nacionalidad == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($cedula == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($nombre1 == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($apellido1 == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($sexo == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	} else { */
		if ($sexo == 'Femenino') {
			$sexo = '1';
		} else {
			$sexo = '2';
		}
	/*}
	 if ($fnacimiento == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	} else { */
		$nacimiento = new DateTime($fnacimiento);
		$ahora = new DateTime(date("Y-m-d"));
		$year = $ahora->diff($nacimiento);
		$edad = $year->format("%y");
		if ($nacimiento > $ahora) {
			echo "1 / la fecha no puede ser superior al actual";
			die();
		}
		if ($edad < '18') {
			echo "1 / Para poder registrarse a este sistema requiere tener la mayoría de edad";
			die();
		}
	/* }
	if ($telefono == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	} else */
		if ($telefono < '1000000000' || $telefono > '9999999999') {
		echo "1 / Debe completar los campos requeridos formato/ ";
		die();
	}
	/* if ($telefono2 != '') { */
		if ($telefono2 < '1000000000' || $telefono2 > '9999999999') {
			echo "1 / Debe completar los campos requeridos formato/ ";
			die();
		}
	/* } */
	/* if($telefono2 != ''){
			echo "1 / Debe completar los campos requeridos";
			die();
		} */
	$sql2 = " SELECT ";
	$sql2 .= " * ";
	$sql2 .= " FROM ";
	$sql2 .= " snirlpcd.persona ";
	$sql2 .= " WHERE ";
	$sql2 .= " semail = ";
	$sql2 .= " '$email' ";
	$row = pg_query($conn, $sql2);
	$valor2 = pg_fetch_assoc($row);

	/* if ($email == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($email2 == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	} */
	if ($email != $email2) {
		echo "1 / Los correos tienen que ser iguales";
		die();
	}
	if ($valor2 != '') {
		echo "1 / Este correo ya está registrado por favor intente con uno diferente";
		die();
	}

	//ENCRIPTAR CONTRASEÑA

	$clave = password_hash($cedula, PASSWORD_DEFAULT);

	//VERIFICAR CONTRASEÑA

	//password_verify($variable_a_verificar,$variable_BD['nombre_en_BD'])//funciona mejor en condiciones o if

	//INSERTAR DATOS EN LA TABLA

	$PG = "INSERT INTO snirlpcd.persona";
	$PG .= "(";
	$PG .= " snacionalidad";
	$PG .= ", ncedula";
	$PG .= ", sprimer_nombre";
	$PG .= ", ssegundo_nombre";
	$PG .= ", sprimer_apellido";
	$PG .= ", ssegundo_apellido";
	$PG .= ", ssexo";
	$PG .= ", dfecha_nacimiento";
	$PG .= ", stelefono_personal";
	$PG .= ", stelefono_habitacion	";
	$PG .= ", semail";
	$PG .= ", clave";
	$PG .= ")";
	$PG .= " VALUES ";
	$PG .= "(";
	$PG .= " '$nacionalidad'";
	$PG .= ", '$cedula'";
	$PG .= ", '$nombre1'";
	$PG .= ", '$nombre2'";
	$PG .= ", '$apellido1'";
	$PG .= ", '$apellido2'";
	$PG .= ", '$sexo'";
	$PG .= ", '$fnacimiento'";
	$PG .= ", '$telefono'";
	$PG .= ", '$telefono2'";
	$PG .= ", '$email'";
	$PG .= ", '$clave'";
	$PG .= ")";

	$valor = pg_query($conn, $PG);

	//VALIDAR LA INSERCION DE DATOS

	$sql = " SELECT ";
	$sql .= " * ";
	$sql .= " FROM ";
	$sql .= " snirlpcd.persona ";
	$sql .= " WHERE ";
	$sql .= " ncedula = ";
	$sql .= " '$cedula' ";
	$row = pg_query($conn, $sql);
	$valor = pg_fetch_assoc($row);

	if ($valor == '') {
		echo "1 / Se presentó un error, favor intertar más tarde";
		die();
	} else {
		$_SESSION['cedula'] = $valor['snacionalidad'] . $valor['ncedula'];
		$_SESSION['ncedula'] = $valor['ncedula'];
		$_SESSION['sUsuario'] = $valor['ncedula'];
		$_SESSION['status'] = 'A';
		$_SESSION['sesiones'] = '0000000';
		$_SESSION['id_afiliado'] = $valor['id'];
		$_SESSION['ced_afiliado'] = $valor['ncedula'];
		$_SESSION['nombre_afiliado'] = $valor['sprimer_nombre'] . $valor['ssegundo_nombre'];
		$_SESSION['apellido_afiliado'] = $valor['sprimer_apellido'] . $valor['ssegundo_apellido'];
		$_SESSION['usuario'] = ($_SESSION['nombre_afiliado'] . ' ' . $_SESSION['apellido_afiliado'] . ' ' . 'CI: ' . $_SESSION['ced_afiliado']);

		echo "2 / Registro exitoso su contraseña es: $cedula";
		die();
	}
} else if ($accion == '3') {

	//RECIBIR DATOS

	$nacionalidad = $_REQUEST['nacionalidad'];
	$cedula = $_REQUEST['cedula'];
	$clave = $_REQUEST['clave'];

	if ($nacionalidad == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($cedula == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}
	if ($clave == '') {
		echo "1 / Debe completar los campos requeridos";
		die();
	}

	$sql = " SELECT ";
	$sql .= " * ";
	$sql .= " FROM ";
	$sql .= " snirlpcd.persona ";
	$sql .= " WHERE ";
	$sql .= " ncedula = ";
	$sql .= " '$cedula' ";
	$sql .= " AND ";
	$sql .= " benabled = ";
	$sql .= " 'true' ";
	$sql .= " LIMIT 1";
	$row = pg_query($conn, $sql);
	$valor = pg_fetch_assoc($row);

	if ($valor == '') {
		echo "1 / Debe registrarse en el sistema para poder ingresar";
		die();
	} else {
		if (password_verify($clave, $valor['clave'])) {
			$_SESSION['cedula'] = $nacionalidad . $cedula;
			$_SESSION['ncedula'] = $cedula;
			$_SESSION['sUsuario'] = $cedula;
			$_SESSION['status'] = 'A';
			$_SESSION['sesiones'] = '0000000';
			$_SESSION['id_afiliado'] = $valor['id'];
			$_SESSION['ced_afiliado'] = $valor['ncedula'];
			$_SESSION['nombre_afiliado'] = $valor['sprimer_nombre'] . $valor['ssegundo_nombre'];
			$_SESSION['apellido_afiliado'] = $valor['sprimer_apellido'] . $valor['ssegundo_apellido'];
			$_SESSION['usuario'] = ($_SESSION['nombre_afiliado'] . ' ' . $_SESSION['apellido_afiliado'] . ' ' . 'CI: ' . $_SESSION['ced_afiliado']);
			if ($cedula == $clave) {
				echo "3 / ";
				die();
			} else {
				echo "2 / ";
				die();
			}
		} else {
			echo "1 / Clave erronea intente nuevamente";
			die();
		}
	}
} else if ($accion == '4') {

	//RECIBIR DATOS

	$nacionalidad = $_REQUEST['nacionalidad'];
	$cedula = $_REQUEST['cedula'];

	$_SESSION['cedula'] = $cedula;

	$sql = " SELECT ";
	$sql .= " * ";
	$sql .= " FROM ";
	$sql .= " snirlpcd.persona ";
	$sql .= " WHERE ";
	$sql .= " ncedula = ";
	$sql .= " '$cedula' ";
	$sql .= " AND ";
	$sql .= " benabled = ";
	$sql .= " 'true' ";
	$sql .= " LIMIT 1";
	$row = pg_query($conn, $sql);
	$valor = pg_fetch_assoc($row);

	if ($valor == '') {
		echo "1 / No se ha encontrado un registro existente con sus datos, favor de registrarse en el sistema";
	} else {
		echo "2 / $nacionalidad $cedula";
	}
} else if ($accion == '5') {
	//RECIBIR DATOS

	$cedula = $_SESSION['cedula'];

	//CONSULTA DE DATOS REALES

	$sql = " SELECT ";
	$sql .= " * ";
	$sql .= " FROM ";
	$sql .= " snirlpcd.persona ";
	$sql .= " WHERE ";
	$sql .= " ncedula = ";
	$sql .= " '$cedula' ";
	$sql .= " AND ";
	$sql .= " benabled = ";
	$sql .= " 'true' ";
	$row = pg_query($conn, $sql);
	$valor = pg_fetch_assoc($row);

	//POSIBLES VARIABLES

	$alt1 = mt_rand(1, 4);
	if ($alt1 == 1) {
		$dia = mt_rand(1, 30);
		$dia2 = mt_rand(1, 28);
		$mes = mt_rand(1, 12);
		$ano = mt_rand(1960, date("Y"));
		if ($mes == 2) {
			//$nacimiento = $dia2."-".$mes."-".$ano;
			$nacimiento = $ano . "-" . $mes . "-" . $dia2;
		} else {
			$nacimiento = $ano . "-" . $mes . "-" . $dia;
		}
		$dijito = mt_rand(1, 6);
		$dijitos = mt_rand(10000000, 99999999);
		if ($dijito == 1) {
			$telefono = "0212" . $dijitos;
		} else
			if ($dijito == 2) {
			$telefono = "0412" . $dijitos;
		} else
			if ($dijito == 3) {
			$telefono = "0414" . $dijitos;
		} else
			if ($dijito == 4) {
			$telefono = "0424" . $dijitos;
		} else
			if ($dijito == 5) {
			$telefono = "0416" . $dijitos;
		} else
			if ($dijito == 6) {
			$telefono = "0426" . $dijitos;
		}
	} else
		if ($alt1 == 2) {
		$nacimiento = $valor['dfecha_nacimiento'];
		$dijito = mt_rand(1, 6);
		$dijitos = mt_rand(10000000, 99999999);
		if ($dijito == 1) {
			$telefono = "0212" . $dijitos;
		} else
			if ($dijito == 2) {
			$telefono = "0412" . $dijitos;
		} else
			if ($dijito == 3) {
			$telefono = "0414" . $dijitos;
		} else
			if ($dijito == 4) {
			$telefono = "0424" . $dijitos;
		} else
			if ($dijito == 5) {
			$telefono = "0416" . $dijitos;
		} else
			if ($dijito == 6) {
			$telefono = "0426" . $dijitos;
		}
	} else
		if ($alt1 == 3) {
		$dia = mt_rand(1, 30);
		$dia2 = mt_rand(1, 28);
		$mes = mt_rand(1, 12);
		$ano = mt_rand(1960, date("Y"));
		if ($mes == 2) {
			//$nacimiento = $dia2."-".$mes."-".$ano;
			$nacimiento = $ano . "-" . $mes . "-" . $dia2;
		} else {
			$nacimiento = $ano . "-" . $mes . "-" . $dia;
		}
		$telefono = $valor['stelefono_personal'];
	} else
		if ($alt1 == 4) {
		$nacimiento = $valor['dfecha_nacimiento'];
		$telefono = $valor['stelefono_personal'];
	}
	echo "¿Esté es su número de teléfono personal? " . $telefono . " / ¿Está es su fecha de nacimiento? " . $nacimiento . " / " . $telefono . " / " . $nacimiento;
} else if ($accion == '6') {
	//RECIBIR DATOS

	$nacimiento = $_REQUEST['nacimiento'];
	$telefono = $_REQUEST['telefono'];
	$validar1 = $_REQUEST['validar1']; // 1=Si && 2=No
	$validar2 = $_REQUEST['validar2']; // 1=Si && 2=No

	$cedula = $_SESSION['cedula'];

	//CONSULTA DE DATOS REALES

	$sql = " SELECT ";
	$sql .= " * ";
	$sql .= " FROM ";
	$sql .= " snirlpcd.persona ";
	$sql .= " WHERE ";
	$sql .= " ncedula = ";
	$sql .= " '$cedula' ";
	$sql .= " AND ";
	$sql .= " benabled = ";
	$sql .= " 'true' ";
	$row = pg_query($conn, $sql);
	$valor = pg_fetch_assoc($row);

	if ($validar1 == 1) {
		if ($validar2 == 1) {
			if ($telefono == $valor['stelefono_personal'] && $nacimiento == $valor['dfecha_nacimiento']) {
				$val = 1;
			} else {
				$val = 2;
			}
		} else
			if ($validar2 == 2) {
			if ($telefono == $valor['stelefono_personal'] && $nacimiento != $valor['dfecha_nacimiento']) {
				$val = 1;
			} else {
				$val = 2;
			}
		}
	} else
		if ($validar1 == 2) {
		if ($validar2 == 1) {
			if ($telefono != $valor['stelefono_personal'] && $nacimiento == $valor['dfecha_nacimiento']) {
				$val = 1;
			} else {
				$val = 2;
			}
		} else
			if ($validar2 == 2) {
			if ($telefono != $valor['stelefono_personal'] && $nacimiento != $valor['dfecha_nacimiento']) {
				$val = 1;
			} else {
				$val = 2;
			}
		}
	}
	if ($val == 1) {

		//ENCRIPTAR CEDULA O NUEVA CLAVE
		$clave = password_hash($cedula, PASSWORD_DEFAULT);

		$PG = "UPDATE";
		$PG .= " snirlpcd.persona";
		$PG .= " SET";
		$PG .= " clave ='$clave'";
		$PG .= " WHERE";
		$PG .= " ncedula='$cedula'";
		$PG .= " AND";
		$PG .= " benabled='true'";
		$valor = pg_query($conn, $PG);

		echo "1 / Su nueva contraseña es: " . $cedula;
	} else
		if ($val == 2) {
		echo "2 / Datos erroneos intentelo nuevamente";
	}
}

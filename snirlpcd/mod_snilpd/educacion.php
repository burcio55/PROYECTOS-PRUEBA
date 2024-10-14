<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
$aPageErrors = array();
$aDefaultForm = array();
//$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug'] = false);
showHeader();
showForm($conn, $aDefaultForm);
showFooter();
// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();
include('../include/BD.php');
$conn2 = Conexion::ConexionBD();

//CONEXION CON SNIRLPCD

try {
	$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
	$conn = $error;
	echo ("Error al conectar en la Base de Datos " . $error);
}

$cedula = substr($_SESSION["cedula"], 1);

$consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "' and benabled = 'true';");
$row = pg_query($conn, $consulta);
$persona = pg_fetch_assoc($row);

$persona_id = $persona["id"];
$ncertificado = $persona["ncertificado"];

// Consulta con la tabla "persona_discapacidad"

$discp = ("SELECT * FROM snirlpcd.persona_discapacidad WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
$row7 = pg_query($conn, $discp);
$persona7 = pg_fetch_assoc($row7);

// Validaciones de la tabla "persona_discapacidad"

$id_discapacidad = $persona7["id"];

if ($id_discapacidad == '') {
	echo '
		<script>
			alert ("Usted no ha llenado el formulario de Discapacidad");
			window.location="discapacidad.php";
		</script>
	';
	die();
}/*  else {
	if ($ncertificado == "f") {
		echo '
			<script>
				alert ("Usted no está Certificado por el CONAPDIS");
				window.location="discapacidad.php";
			</script>
		';
		die();
	}
} */
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION['sesiones']);
		var_dump($_SESSION['sesiones']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*
	function trace($msg)
	{
		if ($GLOBALS['settings']['debug']) {
			print "<br>***** TRACE *****<br>";
			print $msg;
		}
	}
*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn)
{
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {


			case 'Agregar':
				$bValidateSuccess = true;
				if ($_POST['cbNivel_academico'] != '-1') {

					//------------------------------------------------analfabeta - lee y escribe-----------------------------------------------			
					if ($_POST['cbNivel_academico'] == '1' or $_POST['cbNivel_academico'] == '2') {
						$_POST['cbGraduado'] = '0';
						$_POST['titulo'] = '';
						$_POST['cbRegimen'] = '4';
						$_POST['cbPasantias'] = '0';
						$_POST['cbUltimo_aprobado'] = '1';
						$_POST['cbTotal'] = '1';
						$_POST['f_finalizacion'] = '0';
						$_POST['instituto'] = '';
					}
					//------------------------------------------------educacion inicial - educacion especial-----------------------------------				 
					if ($_POST['cbNivel_academico'] == '9' or $_POST['cbNivel_academico'] == '10') {
						if ($_POST['instituto'] == "") {
							$GLOBALS['aPageErrors'][] = "- Instituto/universidad/mision: es requerido.";
							$bValidateSuccess = false;
						} else {
							$_POST['cbGraduado'] = '0';
							$_POST['titulo'] = '';
							$_POST['cbRegimen'] = '4';
							$_POST['cbPasantias'] = '0';
							$_POST['cbUltimo_aprobado'] = '1';
							$_POST['cbTotal'] = '1';
							$_POST['f_finalizacion'] = '0';
						}
					}
					//------------------------------------------------educacion primaria-------------------------------------------------------				 
					if ($_POST['cbNivel_academico'] == '3') {
						$valida3 = '';

						if ($_POST['cbGraduado'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- Graduado?: es requerido.";
							$bValidateSuccess = false;
							$valida3 = 1;
						}

						if ($_POST['cbGraduado'] == "1") {
							if ($_POST['f_finalizacion'] == "") {
								$GLOBALS['aPageErrors'][] = "- Año de finalización: es requerido.";
								$bValidateSuccess = false;
								$valida3 = 1;
							} else {
								$a_act = date('Y');
								$a_ant = '1900';
								if ($_POST['f_finalizacion'] != '0') {
									if ($_POST['f_finalizacion'] > $a_act or $_POST['f_finalizacion'] < $a_ant) {
										$GLOBALS['aPageErrors'][] = "- Año de finalización: es incorrecto.";
										$bValidateSuccess = false;
										$valida3 = 1;
									}
								}
							}
						}

						if ($_POST['cbRegimen'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- El régimen de estudio: es requerido.";
							$bValidateSuccess = false;
							$valida3 = 1;
						}

						if ($_POST['cbUltimo_aprobado'] == "0") {
							$GLOBALS['aPageErrors'][] = "- Último periodo aprobado: es requerido.";
							$bValidateSuccess = false;
							$valida3 = 1;
						}
						if ($_POST['cbTotal'] == "0") {
							$GLOBALS['aPageErrors'][] = "- De un total de: es requerido.";
							$bValidateSuccess = false;
							$valida3 = 1;
						}
						if ($_POST['cbUltimo_aprobado'] > $_POST['cbTotal']) {
							$GLOBALS['aPageErrors'][] = "- Último periodo aprobado: es incorrecto.";
							$bValidateSuccess = false;
							$valida3 = 1;
						}

						if ($_POST['instituto'] == "") {
							$GLOBALS['aPageErrors'][] = "- Instituto o Universidad: es requerido.";
							$bValidateSuccess = false;
							$valida3 = 1;
						}

						if ($valida3 == '') {
							$_POST['cbCarrera'] = '-1';
							$_POST['cbCarrera1'] = '-1';
							$_POST['cbCarrera2'] = '-1';
							$_POST['cbCarrera3'] = '-1';
							$_POST['titulo'] = '';
							$_POST['cbPasantias'] = '0';
						}
					}
					//------------------------------------------------educacion secundaria - secundaria tecnica---------------------------------				 
					if ($_POST['cbNivel_academico'] == '4' || $_POST['cbNivel_academico'] == '5') {
						$valida4 = '';

						if ($_POST['cbCarrera'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- La carrera o especialidad general: es requerida.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}

						if ($_POST['cbCarrera1'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- La carrera o especialidad específica: es requerida.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}

						if ($_POST['cbGraduado'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- Graduado?: es requerido.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}

						if ($_POST['cbGraduado'] == "1") {

							if ($_POST['titulo'] == "") {
								$GLOBALS['aPageErrors'][] = "- Titulo obtenido: es requerido.";
								$bValidateSuccess = false;
								$valida4 = 1;
							}

							if ($_POST['f_finalizacion'] == "") {
								$GLOBALS['aPageErrors'][] = "- Año de finalización: es requerido.";
								$bValidateSuccess = false;
								$valida4 = 1;
							} else {
								$a_act = date('Y');
								$a_ant = '1900';
								if ($_POST['f_finalizacion'] != '0') {
									if ($_POST['f_finalizacion'] > $a_act or $_POST['f_finalizacion'] < $a_ant) {
										$GLOBALS['aPageErrors'][] = "- Año de finalización: es incorrecto.";
										$bValidateSuccess = false;
										$valida4 = 1;
									}
								}
							}
						}

						if ($_POST['cbRegimen'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- El régimen de estudio: es requerido.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}

						if ($_POST['cbUltimo_aprobado'] == "0") {
							$GLOBALS['aPageErrors'][] = "- Último periodo aprobado: es requerido.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}
						if ($_POST['cbTotal'] == "0") {
							$GLOBALS['aPageErrors'][] = "- De un total de: es requerido.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}
						if ($_POST['cbUltimo_aprobado'] > $_POST['cbTotal']) {
							$GLOBALS['aPageErrors'][] = "- Último periodo aprobado: es incorrecto.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}

						if ($_POST['instituto'] == "") {
							$GLOBALS['aPageErrors'][] = "- Instituto o Universidad: es requerido.";
							$bValidateSuccess = false;
							$valida4 = 1;
						}

						if ($$valida4 == '') {
							$_POST['cbCarrera2'] = '-1';
							$_POST['cbCarrera3'] = '-1';
							$_POST['cbPasantias'] = '0';
						}
					}

					//------------------------------------educacion tsu universitaria postgrado---------------------------------				 
					if ($_POST['cbNivel_academico'] == '6' || $_POST['cbNivel_academico'] == '7' || $_POST['cbNivel_academico'] == '8') {
						$valida5 = '';

						if ($_POST['cbCarrera'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- La carrera o especialidad general: es requerida.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}

						if ($_POST['cbCarrera1'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- La carrera o especialidad específica: es requerida.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}

						if ($_POST['cbGraduado'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- Graduado?: es requerido.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}

						if ($_POST['cbGraduado'] == "1") {

							if ($_POST['titulo'] == "") {
								$GLOBALS['aPageErrors'][] = "- Titulo obtenido: es requerido.";
								$bValidateSuccess = false;
								$valida5 = 1;
							}

							if ($_POST['f_finalizacion'] == "") {
								$GLOBALS['aPageErrors'][] = "- Año de finalización: es requerido.";
								$bValidateSuccess = false;
								$valida5 = 1;
							} else {
								$a_act = date('Y');
								$a_ant = '1900';
								if ($_POST['f_finalizacion'] != '0') {
									if ($_POST['f_finalizacion'] > $a_act or $_POST['f_finalizacion'] < $a_ant) {
										$GLOBALS['aPageErrors'][] = "- Año de finalización: es incorrecto.";
										$bValidateSuccess = false;
										$valida5 = 1;
									}
								}
							}
						}

						if ($_POST['cbRegimen'] == "-1") {
							$GLOBALS['aPageErrors'][] = "- El régimen de estudio: es requerido.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}

						if ($_POST['cbUltimo_aprobado'] == "0") {
							$GLOBALS['aPageErrors'][] = "- Último periodo aprobado: es requerido.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}
						if ($_POST['cbTotal'] == "0") {
							$GLOBALS['aPageErrors'][] = "- De un total de: es requerido.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}
						if ($_POST['cbUltimo_aprobado'] > $_POST['cbTotal']) {
							$GLOBALS['aPageErrors'][] = "- Último periodo aprobado: es incorrecto.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}

						if ($_POST['instituto'] == "") {
							$GLOBALS['aPageErrors'][] = "- Instituto o Universidad: es requerido.";
							$bValidateSuccess = false;
							$valida5 = 1;
						}

						if ($_POST['cbNivel_academico'] == '6' || $_POST['cbNivel_academico'] == '7') {
							if ($_POST['cbPasantias'] == "-1") {
								$GLOBALS['aPageErrors'][] = "- Requiere pasantías: es requerido.";
								$bValidateSuccess = false;
								$valida5 = 1;
							}
						}
					}
				} else {
					$GLOBALS['aPageErrors'][] = "- Nivel educativo: es requerido.";
					$bValidateSuccess = false;
				}


				if ($bValidateSuccess) {
					ProcessForm($conn);
				}

				LoadData($conn, true);
				break;


			case 'Cancelar':
				unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn, false);
				break;

			case 'Continuar':
				//sesiones curriculum
				$nNumSeccion = 3;
				$sSQL = "SELECT sesiones FROM personas where id = " . $_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);
				if ($rs) {
					if ($rs->RecordCount() > 0) {
						$rs->fields['sesiones'][$nNumSeccion - 1] = 1;
						$sSQL = "update personas set sesiones = '" . $rs->fields['sesiones'] . "' where id = " . $_SESSION['id_afiliado'];
						$rs = $conn->Execute($sSQL);
					}
				}
				unset($_POST['id_po']);
				unset($_POST['accion']);


				break;
		}
	} else {
		LoadData($conn, false);
	}
}
//------------------------------------------------------------------------------
function LoadData($conn, $bPostBack)
{
	if (count($GLOBALS['aDefaultForm']) == 0) {
		$aDefaultForm = &$GLOBALS['aDefaultForm'];

		$_POST['edit'] = '';
		$aDefaultForm['cbNivel_academico'] = '-1';
		$aDefaultForm['cbCarrera'] = '-1';
		$aDefaultForm['cbCarrera1'] = '-1';
		$aDefaultForm['cbCarrera2'] = '-1';
		$aDefaultForm['cbCarrera3'] = '-1';
		$aDefaultForm['cbGraduado'] = '-1';
		$aDefaultForm['titulo'] = '';
		$aDefaultForm['cbRegimen'] = '4';
		$aDefaultForm['cbPasantias'] = '-1';
		$aDefaultForm['cbUltimo_aprobado'] = '0';
		$aDefaultForm['cbTotal'] = '0';
		$aDefaultForm['f_finalizacion'] = '';
		$aDefaultForm['instituto'] = '';
		$aDefaultForm['Observaciones_educacion'] = '';
		unset($_SESSION['aTabla']);

		if (!$bPostBack) {
			if ($_GET['accion'] != '') $_POST['accion'] = $_GET['accion'];
			if ($_GET['id_po'] != '') $_POST['id_po'] = $_GET['id_po'];

			if ($_POST['accion'] == '1') {
				$_POST['edit'] = '1';
				$SQL2 = "SELECT persona_nivel_instruccion.*, personas.sesiones, personas.mision_educacion_beneficio, personas.mision_educacion_id
				from persona_nivel_instruccion
				INNER JOIN personas ON personas.id=persona_nivel_instruccion.persona_id 
				INNER JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id 
				left JOIN area_mencion ON area_mencion.cod=persona_nivel_instruccion.area_mencion_id 
				INNER JOIN regimen_estudio ON regimen_estudio.id=persona_nivel_instruccion.regimen_id 
				where persona_id ='" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "' 
				and persona_nivel_instruccion.id ='" . $_POST['id_po'] . "'";
				$rs = $conn->Execute($SQL2);
				if ($rs->RecordCount() > 0) {
					$aDefaultForm['cbNivel_academico'] = $rs->fields['nivel_instruccion_id'];
					$aDefaultForm['cbRegimen'] = $rs->fields['regimen_id'];
?>
					<script language="javascript" src="../js/jquery.js"></script>
					<script>
						$(document).ready(function() {
							elegido = '<?php echo $rs->fields['nivel_instruccion_id'] ?>';
							combo = "Carrera";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: '<?php echo $rs->fields['area_mencion_id']; ?>',
									seleccionado2: <?php echo $rs->fields['regimen_id']; ?>
								},
								function(data) {

									cadenaTexto = data;
									parte_ = cadenaTexto.split('|');
									$("#cbCarrera").html(parte_[0]);
									$("#cbRegimen").html(parte_[1]);
								});
						});

						$(document).ready(function() {
							elegido = '<?php echo $rs->fields['area_mencion_id'] ?>';
							combo = "Carrera1";
							$.post("modelo.php", {
									elegido: elegido,
									combo: combo,
									seleccionado: '<?php echo $rs->fields['carrera1']; ?>'
								},
								function(data) {
									$("#cbCarrera1").html(data);
								});
						});
					</script>
					<?php
					if ($rs->fields['carrera2'] != '-1') {
					?>
						<script>
							$(document).ready(function() {
								elegido = '<?php echo $rs->fields['carrera1'] ?>';
								combo = "Carrera2";
								$.post("modelo.php", {
										elegido: elegido,
										combo: combo,
										seleccionado: '<?php echo $rs->fields['carrera2']; ?>'
									},
									function(data) {
										$("#cbCarrera2").html(data);
									});
							});

							$(document).ready(function() {
								elegido = '<?php echo $rs->fields['carrera2'] ?>';
								combo = "Carrera3";
								$.post("modelo.php", {
										elegido: elegido,
										combo: combo,
										seleccionado: '<?php echo $rs->fields['carrera3']; ?>'
									},
									function(data) {
										$("#cbCarrera3").html(data);
									});
							});
						</script>
				<?php
					}
					$aDefaultForm['cbRegimen'] = $rs->fields['regimen_id'];
					$aDefaultForm['cbPasantias'] = $rs->fields['pasantias'];
					$aDefaultForm['cbGraduado'] = $rs->fields['graduado'];
					$aDefaultForm['titulo'] = $rs->fields['titulo'];
					$aDefaultForm['cbUltimo_aprobado'] = $rs->fields['ultimo_periodo'];
					$aDefaultForm['cbTotal'] = $rs->fields['total_periodo'];
					$aDefaultForm['f_finalizacion'] = $rs->fields['f_aprobacion'];
					$aDefaultForm['instituto'] = $rs->fields['instituto_uni'];
					$aDefaultForm['Observaciones_educacion'] = $rs->fields['observaciones'];

					$_SESSION['sesiones'] = $rs1->fields['sesiones'];
				}
			}

			if ($_POST['accion'] == '2') {
				$sql = "delete  from persona_nivel_instruccion 
					where id='" . $_POST['id_po'] . "' and persona_id= '" . $_SESSION['id_afiliado'] . "' ";
				$rs = $conn->Execute($sql);
				unset($_POST['id_po']);
				//Trazas--------------------------------------------------------------------------------------------------------------------------				
				$id = $_SESSION['id_afiliado'];
				$identi = $_SESSION['ced_afiliado'];
				$us = $_SESSION['sUsuario'];
				$mod = '5';
				$auditoria = new Trazas;
				$auditoria->auditor($id, $identi, $sql, $us, $mod);
				//--------------------------------------------------------------------------------------------------------------------------------------
			}
		} else {
			$aDefaultForm['cbNivel_academico'] = $_POST['cbNivel_academico'];
			$aDefaultForm['cbGraduado'] = $_POST['cbGraduado'];
			$aDefaultForm['titulo'] = $_POST['titulo'];
			$aDefaultForm['cbUltimo_aprobado'] = $_POST['cbUltimo_aprobado'];
			$aDefaultForm['cbTotal'] = $_POST['cbTotal'];
			$aDefaultForm['f_finalizacion'] = $_POST['f_finalizacion'];
			$aDefaultForm['instituto'] = $_POST['instituto'];
			$aDefaultForm['Observaciones_educacion'] = $_POST['Observaciones_educacion'];
		}
		$SQL1 = "select persona_nivel_instruccion.id, area_mencion_id as carrera, carrera1, carrera2, carrera3, graduado, titulo, 
					ultimo_periodo,total_periodo, f_aprobacion,instituto_uni, persona_nivel_instruccion.observaciones, 
					nivel_instruccion.nombre as nivel,  regimen_estudio.nombre as regimen
					from persona_nivel_instruccion 
					INNER JOIN personas ON personas.id=persona_nivel_instruccion.persona_id 
					INNER JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id 
					INNER JOIN regimen_estudio ON regimen_estudio.id=persona_nivel_instruccion.regimen_id 
					where persona_id ='" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "' 
					order by nivel_instruccion.orden desc";
		$rs1 = $conn->Execute($SQL1);
		if ($rs1->RecordCount() > 0) {
			$aTabla = array();
			while (!$rs1->EOF) {
				$c = count($aTabla);

				$carrera = $rs1->fields['carrera'];
				$carrera1 = $rs1->fields['carrera1'];
				$carrera2 = $rs1->fields['carrera2'];
				$carrera3 = $rs1->fields['carrera3'];
				$nombre_carrera = '';
				$SQL3 = "select nombre from area_mencion 
							where cod in ('" . $carrera . "','" . $carrera1 . "','" . $carrera2 . "','" . $carrera3 . "') and status='A'";
				$rs3 = $conn->Execute($SQL3);
				if ($rs3->RecordCount() > 0) {
					while (!$rs3->EOF) {
						$nombre_carrera = $nombre_carrera . '<br>' . ' - ' . $rs3->fields['nombre'];
						$rs3->MoveNext();
					}
				}
				$aTabla[$c]['carrera'] = $nombre_carrera;
				$graduado = $rs1->fields['graduado'];
				if ($graduado == 1) $_POST['graduado'] = 'Si';
				if ($graduado == 0) $_POST['graduado'] = 'No';
				if ($graduado == 2) $_POST['graduado'] = 'No Aplica';
				$aTabla[$c]['id'] = $rs1->fields['id'];
				$aTabla[$c]['graduado'] = $_POST['graduado'];
				$aTabla[$c]['titulo'] = $rs1->fields['titulo'];
				$aTabla[$c]['ultimo_periodo'] = $rs1->fields['ultimo_periodo'];
				$aTabla[$c]['total_periodo'] = $rs1->fields['total_periodo'];
				$aTabla[$c]['f_aprobacion'] = $rs1->fields['f_aprobacion'];
				$aTabla[$c]['instituto_uni'] = $rs1->fields['instituto_uni'];
				$aTabla[$c]['observaciones'] = $rs1->fields['observaciones'];
				$aTabla[$c]['nivel'] = $rs1->fields['nivel'];
				//	$aTabla[$c]['carrera']=$rs1->fields['carrera'];
				$aTabla[$c]['regimen'] = $rs1->fields['regimen'];
				$rs1->MoveNext();
			}
			$_SESSION['aTabla'] = $aTabla;
		}
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn)
{
	$sfecha = date('Y-m-d');

	//--------------------------------------------------------------------------actualizar------------------------------------------	
	if ($_POST['edit'] == '1') {
		$sql = "update persona_nivel_instruccion set 
				  nivel_instruccion_id=	'" . $_POST['cbNivel_academico'] . "',
				  area_mencion_id='" . $_POST['cbCarrera'] . "',
				  carrera1='" . $_POST['cbCarrera1'] . "',
				  carrera2='" . $_POST['cbCarrera2'] . "',
				  carrera3='" . $_POST['cbCarrera3'] . "',
				  pasantias='" . $_POST['cbPasantias'] . "', 
					regimen_id='" . $_POST['cbRegimen'] . "',
				  graduado='" . $_POST['cbGraduado'] . "', 
				  titulo='" . $_POST['titulo'] . "',				 
				  ultimo_periodo='" . $_POST['cbUltimo_aprobado'] . "',
				  total_periodo='" . $_POST['cbTotal'] . "',
				  f_aprobacion='" . $_POST['f_finalizacion'] . "',
				  instituto_uni='" . $_POST['instituto'] . "',
				  observaciones='" . $_POST['Observaciones_educacion'] . "',
			  	  updated_at='" . $sfecha . "',
			   	  status='A',
			   	  id_update='" . $_SESSION['sUsuario'] . "'
				  WHERE id='" . $_POST['id_po'] . "' and persona_id= '" . $_SESSION['id_afiliado'] . "' ";
		$conn->Execute($sql);
	}

	//--------------------------------------------------agregar---------------------------------------				
	else {

		$existe = '';

		if ($_POST['cbNivel_academico'] == '1' or $_POST['cbNivel_academico'] == '2' or $_POST['cbNivel_academico'] == '9' or $_POST['cbNivel_academico'] == '10') {
			//----------------------------------------------verifica si existe-----------------------------			
			$SQL2 = "SELECT id from persona_nivel_instruccion
						where persona_id  ='" . $_SESSION['id_afiliado'] . "'
							and nivel_instruccion_id ='" . $_POST['cbNivel_academico'] . "'";

			$rs = $conn->Execute($SQL2);
			if ($rs->RecordCount() > 0) {
				$existe = '1';
				?><script>
					alert("- Ya existe un registro con este Nivel Educativo");
				</script><?
						} else {
							$existe = '';
						}
					}

					if ($existe == '') {
						$sql = "insert into public.persona_nivel_instruccion
		 		( persona_id, nivel_instruccion_id, area_mencion_id, carrera1, carrera2, carrera3, regimen_id, pasantias, graduado, titulo, 
				 ultimo_periodo, total_periodo, f_aprobacion, instituto_uni, observaciones, created_at, status, id_update) 
				 values
			  	('" . $_SESSION['id_afiliado'] . "',
				 '" . $_POST['cbNivel_academico'] . "',
				 '" . $_POST['cbCarrera'] . "',
				 '" . $_POST['cbCarrera1'] . "',
				 '" . $_POST['cbCarrera2'] . "',
				 '" . $_POST['cbCarrera3'] . "',
				 '" . $_POST['cbRegimen'] . "', 
				 '" . $_POST['cbPasantias'] . "', 
				 '" . $_POST['cbGraduado'] . "', 
				 '" . $_POST['titulo'] . "',				 
				 '" . $_POST['cbUltimo_aprobado'] . "',
				 '" . $_POST['cbTotal'] . "',
				 '" . $_POST['f_finalizacion'] . "',
				 '" . $_POST['instituto'] . "',
				 '" . $_POST['Observaciones_educacion'] . "',
			  	 '$sfecha',
			   	 'A',
			   	 '" . $_SESSION['sUsuario'] . "')";
						$conn->Execute($sql);

							?><script>
				document.location = 'capacitación.php'
			</script><?
					}
				}
				//Trazas--------------------------------------------------------------------------------------------------------------------------				
				if ($sql != '') {
					$id = $_SESSION['id_afiliado'];
					$identi = $_SESSION['ced_afiliado'];
					$us = $_SESSION['sUsuario'];
					$mod = '5';
					$auditoria = new Trazas;
					$auditoria->auditor($id, $identi, $sql, $us, $mod);
				}
				//----------------------------------------------------------------------------------------------------------------------
				$sql = "update personas set 
				  status = 'A',
				  updated_at = '" . $sfecha . "',
				  id_update = '" . $_SESSION['sUsuario'] . "'
				  WHERE id= '" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "'";
				$conn->Execute($sql);

				unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn, false);
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function showHeader()
			{
				include('header.php');
				echo '<br>';
				include('menu_trabajador.php');
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function showForm($conn, &$aDefaultForm)
			{
						?>
	<!--form name="frm_educacion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" -->
	<script language="javascript">
		$(document).ready(function() {
			$("#cbNivel_academico").change(function() {
				$("#cbNivel_academico option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Carrera';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						cadenaTexto = data;
						parte_ = cadenaTexto.split('|');
						$("#cbCarrera").html(parte_[0]);
						$("#cbRegimen").html(parte_[1]);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbCarrera").change(function() {
				$("#cbCarrera option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Carrera1';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbCarrera1").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbCarrera1").change(function() {
				$("#cbCarrera1 option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Carrera2';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbCarrera2").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#cbCarrera2").change(function() {
				$("#cbCarrera2 option:selected").each(function() {
					elegido = $(this).val();
					combo = 'Carrera3';
					$.post("modelo.php", {
						elegido: elegido,
						combo: combo
					}, function(data) {
						$("#cbCarrera3").html(data);
					});
				});
			})
		});
	</script>
	<script>
		function send(saction) {
			if (saction == 'Agregar' || saction == 'Actualizar') {
				if (validar_frm_educacion() == true) {
					var form = document.frm_educacion;
					form.action.value = saction;
					form.submit();
				}

			} else {
				var form = document.frm_educacion;
				form.action.value = saction;
				form.submit();
			}
		}
	</script>
	<!--input name="action" type="hidden" value=""/>
    <input name="edit" type="hidden" value="<?= $_POST['edit'] ?>" /> 
    <input name="id_po" type="hidden" value="<?= $_POST['id_po'] ?>" /> 
    <input name="accion" type="hidden" value="<?= $_POST['accion'] ?>" />  
    <input name="cbNivel_academico" type="hidden" value="<?= $aDefaultForm['cbNivel_academico'] ?>" /-->

	<body class="hold-transition sidebar-mini">
		<div class="content-video2 video">
			<video src="../videos/video_educacion.mp4" class="video" controls>
				<!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
			</video>
		</div>
		<div class="wrapper">
			<section class="content">
				<div class="container-fluid">
					<div class="card card-primary" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px;">
							<h3 tabindex="7" aria-label="Educación" class="card-title">Educación</h3>
						</div>
					</div>
					<div class="card card-info" style="border-radius: 30px;">
						<div class="card-header" style="border-radius: 30px 30px 0 0;">
							<h3 tabindex="8" aria-label="Estudios Realizados" class="card-title">Estudios Realizados</h3>
						</div>
						<div style="padding: 10px; text-align: right; margin-bottom: -25px">
							<h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
						</div>
						<form class="form-horizontal">
							<div class="card-body">
								<div class="form-group row">
									<div class="col-sm-6">
										<div style="display: none;"><input type="text" id="usuario"></div>
										<label style="color: #312E33">Nivel Educativo</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/birrete.png"></samp>
											</div>
										</div>
										<select tabindex="9" aria-label="Es obligatorio indicar cual es su nivel educativo" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray;" onchange="javascript:validar();" name="cbNivel_academico" id="cbNivel_academico" class="form-control-sm select2" <? if ($_POST['edit'] == "1") {
																																																																																								$disabled = 'disabled';
																																																																																							}
																																																																																							echo $disabled; ?>>
											<option value="-1" selected="selected">Seleccione</option>
											<? LoadNivel_academico($conn);
											print $GLOBALS['sHtml_cb_Nivel_academico']; ?>
										</select>
									</div>
									<script>
										function validar() {
											//1 Analfabet
											//2 lee y escribe
											//3 Educación Primaria
											//4 Educación Secundaria
											//5 Educación Secundaria (Tecnica)
											//6 Educación Superio (TSU)
											//7 Educación Superior (Universitario)
											//8 Postgrado
											//9 Educación Especial
											//10 Educación Inicial
											var padre = document.getElementById("cbNivel_academico").value;
											let tab = document.getElementById("cbNivel_academico").tabIndex;
											let tab1 = tab + 1;
											let tab2 = tab + 2;
											if (padre == 1 || padre == 2 || padre == -1) {
												document.getElementById("Graduado").style.display = 'none';
												document.getElementById("tr_titulo").style.display = 'none';
												document.getElementById("tr_anio").style.display = 'none';
												document.getElementById("tr_instituto").style.display = 'none';
												document.getElementById("ult_anio").style.display = 'none';
												document.getElementById("tr_status").style.display = 'none';
												document.getElementById("Esp").style.display = 'none';
												document.getElementById("Observaciones_educacion").tabIndex = tab1;
												document.getElementById("btn").tabIndex = tab2;
												document.getElementById("btn2").tabIndex = tab2;
											} else {
												document.getElementById("Graduado").style.display = 'block';
												document.getElementById("cbGraduado").value = '-1';
												document.getElementById("cbGraduado").tabIndex = tab1;
												document.getElementById("tr_titulo").style.display = 'none';
												document.getElementById("tr_anio").style.display = 'none';
												document.getElementById("tr_instituto").style.display = 'none';
												document.getElementById("ult_anio").style.display = 'none';
												document.getElementById("tr_status").style.display = 'none';
												document.getElementById("Esp").style.display = 'none';
											}
										}
									</script>
									<div class="col-sm-6" id="Graduado" style="display: none;">
										<label style="color: #312E33; margin-top: 10px;"> ¿Está Graduado?</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
											</div>
										</div>
										<select name="cbGraduado" aria-label="es obligatorio indicar si está graduado" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
											<option value="-1" selected="selected">Seleccione</option>
											<option value="1" <? if (($aDefaultForm['cbGraduado']) == '1') print 'selected="selected"'; ?>>Si</option>
											<option value="2" <? if (($aDefaultForm['cbGraduado']) == '0') print 'selected="selected"'; ?>>No</option>
										</select>
									</div>
									<script>
										function set() {
											var selec = document.getElementById("cbGraduado").value;
											let valor = document.getElementById("cbGraduado").tabIndex;
											let valor1 = valor + 1;
											let valor2 = valor + 2;
											let valor3 = valor + 3;
											let valor4 = valor + 4;
											let valor5 = valor + 5;
											if (selec == 1) {
												document.getElementById("tr_titulo").style.display = 'block';
												document.getElementById("tr_titulo").tabIndex = valor1;
												document.getElementById("titulo").tabIndex = valor1;
												document.getElementById("tr_anio").style.display = 'block';
												document.getElementById("tr_anio").tabIndex = valor2;
												document.getElementById("anio_graduacion").tabIndex = valor2;
												document.getElementById("tr_instituto").style.display = 'block';
												document.getElementById("tr_instituto").tabIndex = valor3;
												document.getElementById("instituto").tabIndex = valor3;
												document.getElementById("obe").tabIndex = valor4;
												document.getElementById("Observaciones_educacion").tabIndex = valor4;
												document.getElementById("ult_anio").style.display = 'none';
												document.getElementById("tr_status").style.display = 'none';
												document.getElementById("btn").tabIndex = valor5;
												document.getElementById("btn2").tabIndex = valor5;
											} else if (selec == 2) {
												document.getElementById("tr_titulo").style.display = 'none';
												document.getElementById("tr_anio").style.display = 'none';
												document.getElementById("tr_instituto").style.display = 'block';
												document.getElementById("tr_instituto").tabIndex = valor1;
												document.getElementById("instituto").tabIndex = valor1;
												document.getElementById("ult_anio").style.display = 'block';
												document.getElementById("ult_anio").tabIndex = valor3;
												document.getElementById("ultimo_anio").tabIndex = valor3;
												document.getElementById("obe").tabIndex = valor4;
												document.getElementById("Observaciones_educacion").tabIndex = valor4;
												document.getElementById("tr_status").style.display = 'block';
												document.getElementById("tr_status").tabIndex = valor2;
												document.getElementById("Estatus_academico").tabIndex = valor2;
												document.getElementById("btn").tabIndex = valor5;
												document.getElementById("btn2").tabIndex = valor5;
											} else {
												document.getElementById("tr_titulo").style.display = 'none';
												document.getElementById("tr_anio").style.display = 'none';
												document.getElementById("obe").tabIndex = valor1;
												document.getElementById("Observaciones_educacion").tabIndex = valor1;
												document.getElementById("btn").tabIndex = valor2;
												document.getElementById("btn2").tabIndex = valor2;
												document.getElementById("tr_instituto").style.display = 'none';
												document.getElementById("ult_anio").style.display = 'none';
												document.getElementById("tr_status").style.display = 'none';
											}
										}
									</script>
									<div class="col-sm-6" id="tr_titulo" style="display: none;">
										<label style="color: #312E33; margin-top: 10px;"> Título Obtenido</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
											</div>
										</div>
										<input name="titulo" aria-label="es obligatorio escribir el nombre de su título obtenido" type="text" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm select2" id="titulo" value="<?= $aDefaultForm['titulo'] ?>" size="50" maxlength="100" onkeyup="mayus(this);">
									</div>
									<div class="col-sm-6" id="tr_anio" style="display: none;">
										<label style="color: #312E33; margin-top: 10px;"> Año de Graduación </label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
											</div>
										</div>
										<input name="anio_graduacion" aria-label="es obligatorio escribir el año de su Graduación" id="anio_graduacion" type="text" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm select2" onkeypress="return numbers(event);" maxlength="4">
										<script src="numbers.js"></script>
									</div>
									<div class="col-sm-6" id="tr_instituto" style="display: none;">
										<label style="color: #312E33; margin-top: 10px;"> Nombre de la Institución Educativa</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/colegio.png"></samp>
											</div>
										</div>
										<input name="instituto" aria-label="es obligatorio escribir el Nombre de la Institución Educativa" type="text" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm select2" id="instituto" value="<?= $aDefaultForm['instituto'] ?>" size="50" maxlength="100" onkeyup="mayus(this);">
									</div>
									<div class="col-sm-6" id="tr_status" style="display: none;">
										<label style="color: #312E33; margin-top: 10px;"> Estatus académico actual</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
											</div>
										</div>
										<select name="Estatus_academico" id="Estatus_academico" aria-label="es obligatorio seleccionar su Estatus académico actual" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class=" form-control-sm select2">
											<option value="0" selected="selected"> Seleccione </option>
											<option value="1"> Cursando </option>
											<option value="2"> Suspendido </option>
										</select>
									</div>
									<!-- <script>
										function suspendido() {
											let selec2 = document.getElementById("cbSuspendido").value;
											if (selec2 == 2) {
												document.getElementById("Esp").style.display = 'block';
											} else {
												document.getElementById("Esp").style.display = 'none';
											}
										}
									</script> -->
									<div class="col-sm-6" id="ult_anio" style="display: none;">
										<label style="color: #312E33; margin-top: 10px;"> Último año cursado </label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
											</div>
										</div>
										<input name="ultimo_anio" id="ultimo_anio" aria-label="es obligatorio escribir el último año cursado" type="text" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm select2" onkeypress="return numbers(event);" maxlength="4">
									</div>
									<div class="col-sm-6" id="obe" tabindex="10">
										<label style="color: #312E33; margin-top: 10px;"> Observaciones Generales</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea tabindex="10" aria-label="puede agregar una observacion" class="form-control" name="Observaciones_educacion" type="text" id="Observaciones_educacion" value="<?= $aDefaultForm['Observaciones_educacion'] ?>" size="50" maxlength="100" style="border-radius: 30px" onkeyup="mayus(this);"></textarea>
									</div>
									<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Régimen de Estudio </label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbRegimen" id="cbRegimen" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
     										</select>
										</div-->


								</div>
								<div class="col-sm-7">
									<input tabindex="11" type="button" id="btn2" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;display:none" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" aria-label="Actualizar Datos" value="Actualizar" onclick="agregar_estudios(cbNivel_academico.value,cbGraduado.value,titulo.value,anio_graduacion.value,instituto.value,Estatus_academico.value,ultimo_anio.value,Observaciones_educacion.value,usuario.value);">
									<input tabindex="11" type="button" id="btn" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" aria-label="Agregar los datos a la tabla" value="Agregar Estudios" onclick="agregar_estudios(cbNivel_academico.value,cbGraduado.value,titulo.value,anio_graduacion.value,instituto.value,Estatus_academico.value,ultimo_anio.value,Observaciones_educacion.value,usuario.value);">
								</div>
							</div>
							<table class="table table-bordered table-striped table-sm" style="background-color: white; text-align: left">
								<thead>
									<tr style="color: #312E33">
										<th class="text-center">Nivel Académico</th>
										<th class="text-center">Nombre de la Institución Educativa</th>
										<th class="text-center" style="width: 155px;">Acciones</th>
									</tr>
								</thead>
								<tbody id="estudios"></tbody>
							</table>
							<div class="col-sm-7">
								<div aria-label="continuar" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onclick="continuar()" onkeypress="continuar()" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" id="continuar" type="submit">Continuar</div>
								<a href="discapacidad.php">
									<div aria-label="Regresar" style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" id="regresar" type="submit">Regresar</div>
								</a>
							</div>
							<br><br>
						</form>
					</div>
				</div>
			</section>
		</div>
	</body>
	</div>
	</div>
	<script src="tabla.js"></script>
	<script src="modificar.js"></script>
	<!-- RAFA GOMEZ ult. 14/02/2023
<script>
	document.getElementById("cmbSecc").innerHTML = Array.from(document.getElementsByClassName("sub_titulo_2")).map(
		x => `<option><a href="#${x.id}">${x.textContent}</a></option>`
	).join("");
</script>
-->
	<!-- <script src='/src/rogLib/rogLib.js'></script>
<script src='/src/rogLib/rogCSS.js'></script>
<script src='/src/rogLib/rogMnuFlotante.js'></script>
<script type="module" src='/minpptrassi/Auxiliares/Estudios/preparaEstudios.js'></script>

<script>
	const cedula = <?= substr($_SESSION["cedula"], 1) ?>;
</script>

<style>
		svg {
			height: 1.5em;
		}

		.auxiliar tr {
			line-height: 2em;
			border-bottom: 1px solid currentColor;
		}
		
		.titulos th {
			color: #666;
		}

		.col_graduado {
			text-align: center;
		}

		.col_eliminar {
			color: red !important;
			text-align: center;
		}

		.btnEspecial {
			color: #464646;
			margin: .2em;
		}

		.btnEspecial svg {
			height: 1.35em;
		}

		.btnEspecial:hover {
			color: olive;
		}

		.trEscogida {
			background-color: pink;
			color: red;
		}
		
		.invalid {
			border: 2px solid red !important;
		}
	</style> -->


	<!--table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
	<tr>
			<th colspan="2" class="titulo">EDUCACI&Oacute;N</th>
	</tr>
	<tr>
			<th colspan="2" class="sub_titulo" align="left">Estudios realizados: </th>
	</tr>
	<tr>
      <td width="48%" height="25"><div align="right" class="Estilo13">Nivel educativo:</div></td>
      <td width="52%"><select name="cbNivel_academico" id="cbNivel_academico" class="tablaborde_shadow" title="Nivel educativo - Seleccione solo una opcion del listado" <? if ($_POST['edit'] == "1") {
																																												$disabled = 'disabled';
																																											}
																																											echo $disabled; ?>>
      <option value="-1" selected="selected">Seleccione...</option>
      <? /*LoadNivel_academico($conn) ; print $GLOBALS['sHtml_cb_Nivel_academico']; ?>
      </select>
      <span class="requerido">*</span></td>
	</tr>
	<tr id="tr_Carrera1">
      <td height="25"><div align="right" class="Estilo13">Carrera o especialidad general: </div></td>
      <td><select name="cbCarrera" id="cbCarrera" class="tablaborde_shadow" title="Carrera o especialidad general - Seleccione solo una opcion del listado">
      <option value="-1">Seleccionar</option>
      </select></td>
	</tr>
      <tr id="tr_Carrera2">
      <td height="25"><div align="right" class="Estilo13">Carrera o especialidad específica: </div></td>
      <td><select name="cbCarrera1" id="cbCarrera1" class="tablaborde_shadow" title="Carrera o especialidad especifica - Seleccione solo una opcion del listado">
      <option value="-1">Seleccionar</option>
      </select></td>
	</tr>
	<tr id="tr_Carrera3">
      <td height="25"><div align="right" class="Estilo13">Carrera o especialidad sub específica: </div></td>
      <td><select name="cbCarrera2" id="cbCarrera2" class="tablaborde_shadow" title="Carrera o especialidad sub especifica - Seleccione solo una opcion del listado">
      <option value="-1">Seleccionar</option>
      </select></td>
	</tr>
  <tr id="tr_Carrera4">
      <td height="25"><div align="right" class="Estilo13">Carrera o especialidad detalle: </div></td>
      <td><select name="cbCarrera3" id="cbCarrera3" class="tablaborde_shadow" title="Carrera o especialidad detalle - Seleccione solo una opcion del listado">    
      <option value="-1">Seleccionar</option>
      </select></td>
  </tr>
  <tr id="tr_graduado">
      <td height="25"><div align="right" class="Estilo13">¿Est&aacute; graduado?:</div></td>
      <td><select name="cbGraduado" class="tablaborde_shadow" id="cbGraduado" title="Graduado - Seleccione solo una opcion del listado">
      <option value="-1" selected="selected">Seleccione</option>
      <option value="1" <? if (($aDefaultForm['cbGraduado'])=='1') print 'selected="selected"';?>>Si</option>
      <option value="0" <? if (($aDefaultForm['cbGraduado'])=='0') print 'selected="selected"';?>>No</option>
      </select></td>
  </tr>
  <tr id="tr_titulo">
      <td height="25"><div align="right" class="Estilo13">T&iacute;tulo obtenido:</div></td>
      <td><input name="titulo" type="text" class="tablaborde_shadow" id="titulo" onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['titulo']?>" size="50" maxlength="100" title="Titulo obtenido - Ingrese solo letras"/></td>
  </tr>
  <tr id="tr_regimen">
      <td height="25"><div align="right" class="Estilo13">R&eacute;gimen de estudio:</div></td>
      <td><select name="cbRegimen" id="cbRegimen" class="tablaborde_shadow" title="Regimen de estudio - Seleccione solo una opcion del listado"><option value="-1">Seleccionar</option>
      </select></td>
  </tr>
  <tr id="tr_periodo">
      <td height="25"><div align="right" class="Estilo13">Ultimo per&iacute;odo aprobado:</div></td>
      <td><select name="cbUltimo_aprobado" class="tablaborde_shadow" id="cbUltimo_aprobado" title="Ultimo periodo aprobado - Seleccione solo una opcion del listado">
      <option value="0" selected="selected">Seleccione</option>
      <option value="1" <? if (($aDefaultForm['cbUltimo_aprobado'])=='1') print 'selected="selected"';?>>1</option>
      <option value="2" <? if (($aDefaultForm['cbUltimo_aprobado'])=='2') print 'selected="selected"';?>>2</option>
      <option value="3" <? if (($aDefaultForm['cbUltimo_aprobado'])=='3') print 'selected="selected"';?>>3</option>
      <option value="4" <? if (($aDefaultForm['cbUltimo_aprobado'])=='4') print 'selected="selected"';?>>4</option>
      <option value="5" <? if (($aDefaultForm['cbUltimo_aprobado'])=='5') print 'selected="selected"';?>>5</option>
      <option value="6" <? if (($aDefaultForm['cbUltimo_aprobado'])=='6') print 'selected="selected"';?>>6</option>
      <option value="7" <? if (($aDefaultForm['cbUltimo_aprobado'])=='7') print 'selected="selected"';?>>7</option>
      <option value="8" <? if (($aDefaultForm['cbUltimo_aprobado'])=='8') print 'selected="selected"';?>>8</option>
      <option value="9" <? if (($aDefaultForm['cbUltimo_aprobado'])=='9') print 'selected="selected"';?>>9</option>
      <option value="10" <? if (($aDefaultForm['cbUltimo_aprobado'])=='10') print 'selected="selected"';?>>10</option>
      <option value="11" <? if (($aDefaultForm['cbUltimo_aprobado'])=='11') print 'selected="selected"';?>>11</option>
      <option value="12" <? if (($aDefaultForm['cbUltimo_aprobado'])=='12') print 'selected="selected"';?>>12</option>
      <option value="13" <? if (($aDefaultForm['cbUltimo_aprobado'])=='13') print 'selected="selected"';?>>13</option>
      <option value="14" <? if (($aDefaultForm['cbUltimo_aprobado'])=='14') print 'selected="selected"';?>>14</option>
      <option value="15" <? if (($aDefaultForm['cbUltimo_aprobado'])=='15') print 'selected="selected"';?>>15</option>
      </select>
      De un total de:           
      <select name="cbTotal" class="tablaborde_shadow" id="cbTotal" title="De un total de periodos - Seleccione solo una opcion del listado">
      <option value="0" selected="selected">Seleccione</option>
      <option value="1" <? if (($aDefaultForm['cbTotal'])=='1') print 'selected="selected"';?>>1</option>
      <option value="2" <? if (($aDefaultForm['cbTotal'])=='2') print 'selected="selected"';?>>2</option>
      <option value="3" <? if (($aDefaultForm['cbTotal'])=='3') print 'selected="selected"';?>>3</option>
      <option value="4" <? if (($aDefaultForm['cbTotal'])=='4') print 'selected="selected"';?>>4</option>
      <option value="5" <? if (($aDefaultForm['cbTotal'])=='5') print 'selected="selected"';?>>5</option>
      <option value="6" <? if (($aDefaultForm['cbTotal'])=='6') print 'selected="selected"';?>>6</option>
      <option value="7" <? if (($aDefaultForm['cbTotal'])=='7') print 'selected="selected"';?>>7</option>
      <option value="8" <? if (($aDefaultForm['cbTotal'])=='8') print 'selected="selected"';?>>8</option>
      <option value="9" <? if (($aDefaultForm['cbTotal'])=='9') print 'selected="selected"';?>>9</option>
      <option value="10" <? if (($aDefaultForm['cbTotal'])=='10') print 'selected="selected"';?>>10</option>
      <option value="11" <? if (($aDefaultForm['cbTotal'])=='11') print 'selected="selected"';?>>11</option>
      <option value="12" <? if (($aDefaultForm['cbTotal'])=='12') print 'selected="selected"';?>>12</option>
      <option value="13" <? if (($aDefaultForm['cbTotal'])=='13') print 'selected="selected"';?>>13</option>
      <option value="14" <? if (($aDefaultForm['cbTotal'])=='14') print 'selected="selected"';?>>14</option>
      <option value="15" <? if (($aDefaultForm['cbTotal'])=='15') print 'selected="selected"';?>>15</option>
      </select></td>
  </tr>
  <tr id="tr_anio">
      <td height="25"><div align="right" class="Estilo13">A&ntilde;o de finalizaci&oacute;n:</div></td>
      <td><input name="f_finalizacion" type="text" class="tablaborde_shadow" id="f_finalizacion" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['f_finalizacion']?>" size="5" maxlength="4" title="Año de finalizacion - Ingrese solo numeros"/></td>
  </tr>
  <tr id="tr_instituto">
      <td height="25"><div align="right" class="Estilo13">Instituto/universidad/misi&oacute;n:</div></td>
      <td><input name="instituto" type="text" class="tablaborde_shadow" id="instituto" value="<?=$aDefaultForm['instituto']?>" size="50" maxlength="100" title="Instituto o universidad - Ingrese solo letras y/o numeros" /></td>
  </tr>
    <tr id="tr_pasantias">
    <td height="25"><div align="right" class="Estilo13">¿Requiere pasant&iacute;as?:</div></td>
    <td><select name="cbPasantias" class="tablaborde_shadow" id="cbPasantias" title="Requiere pasantias - Seleccione solo una opcion del listado">
      <option value="-1" selected="selected">Seleccione</option>
      <option value="1" <? if (($aDefaultForm['cbPasantias'])=='1') print 'selected="selected"';?>>Si</option>
      <option value="0" <? if (($aDefaultForm['cbPasantias'])=='0') print 'selected="selected"';?>>No</option>
    </select></td>
  </tr>
  <tr>
      <td height="25"><div align="right" class="Estilo13">Observaciones generales: </div></td>
      <td><input name="Observaciones_educacion" type="text" class="tablaborde_shadow" id="Observaciones_educacion" value="<?=$aDefaultForm['Observaciones_educacion']?>" size="50" maxlength="100" title="Observaciones del funcionario que ingresa la informacion - Ingrese letras y/o numeros" /></td>
  </tr>
  <tr>
      <td colspan="2" align="center"><span class="requerido">
            <? if($_POST['edit']==""){ ?>
            <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Agregar</button>
              <? }
             else{ ?>
            <button type="button" name="Actualizar"  id="Actualizar" class="button"  onClick="javascript:send('Agregar');">Actualizar</button>
          </span>
            <? }?>
            <span class="requerido">
            <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
            </span></td>
  </tr>
  <tr>
  		<td height="50" colspan="2">
  				<table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
          <tr>
          <th class="labelListColumn">Nivel acad&eacute;mico</th>
          <th class="labelListColumn">Carrera o Especialidad</th>
          <th class="labelListColumn">Instituto o Universidad</th>
          <th class="labelListColumn">Graduado?</th>
          <th class="labelListColumn">A&ntilde;o de finalizaci&oacute;n</th>
          <th class="labelListColumn">T&iacute;tulo Obtenido </th>
          <th class="labelListColumn">Acciones</th>
          </tr>
          <?
          $aTabla=$_SESSION['aTabla'];
          $aDefaultForm = $GLOBALS['aDefaultForm'];
          for( $i=0; $i<count($aTabla); $i++){
          if (($i%2) == 0) $class_name = "dataListColumn2";
          else $class_name = "dataListColumn";
          ?>
          <tr class="<?=$class_name?>">
          <td class="texto-normal"><div align="left"><?=$aTabla[$i]['nivel']?></div></td>
          <td class="texto-normal"><div align="left"><?=$aTabla[$i]['carrera']?></div></td>
          <td class="texto-normal"><div align="left"><?=$aTabla[$i]['instituto_uni']?></div></td>
          <td class="texto-normal"><div align="left"><?=$aTabla[$i]['graduado']?></div></td>
          <td class="texto-normal"><div align="left"><?=$aTabla[$i]['f_aprobacion']?></div></td>
          <td class="texto-normal"><div align="left"><?=$aTabla[$i]['titulo']?></div></td>
          <td class="texto-normal"><a href="1_5agen_trab_educacion.php?id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="../imagenes/pencil_16.png"  border="0" title="Editar" /></a>  
          <a href="1_5agen_trab_educacion.php?id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="../imagenes/delete_16.png"  border="0" title="Eliminar" /></a></td>
          </tr>
          <? } ?>
          </table>
  
  <p>&nbsp;</p>
  
  </td>
  </tr>
	<tr>
		<td colspan="2" align="center">
		
    <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
    
    </td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table-->

</form>
<?*/
			}
			//------------------------------------------------------------------------------------------------------------------------------
			function showFooter()
			{
				$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
				//var_dump($ids_elementos_validar);

				for ($i = 0; $i < count($ids_elementos_validar); $i++) {
					echo "<script> document.getElementById('" . $ids_elementos_validar[$i] . "').style.border='1px solid Red'; </script>";
				}

				$aPageErrors = $GLOBALS['aPageErrors'];
				print (isset($aPageErrors) && count($aPageErrors) > 0) ? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '" . '\n' . join('\n', $aPageErrors) . "')</script>" : "";
			}
		?> 

<?php include('footer.php'); ?>
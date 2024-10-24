<?
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
$aTabla = array();
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
		var_dump($_SESSION['migra_bloq']);
		var_dump($_SESSION['disc_bloq']);
		var_dump($_SESSION['sesiones']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn)
{
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {


			case 'Cancelar':
				LoadData($conn, false);
				break;

			case 'Continuar':
				$bValidateSuccess = true;
				if ($_POST['cbSituacion_afiliado'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Situación ocupacional: es requerido.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbTipo_situacion_afiliado'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- El Tipo de situación ocupacional: es requerido.";
					$bValidateSuccess = false;
				}

				if ($_POST['cbSituacion_afiliado'] == "1") {
					if ($_POST['f_situacion'] == "") {
						$GLOBALS['aPageErrors'][] = "- La fecha de situación ocupacional: es requerida.";
						$bValidateSuccess = false;
					}
					if ($_POST['f_situacion'] != '') {
						$fecha1 = $_POST['f_situacion'];
						if (preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/", $fecha1))
							list($año1, $mes1, $dia1) = split("-", $fecha1);
						$fecha2 = date('Y-m-d');
						preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/", $fecha2);
						list($año2, $mes2, $dia2) = split("-", $fecha2);
						if ($fecha1 > $fecha2) {
							$GLOBALS['aPageErrors'][] = "- La fecha de situación ocupacional: es incorrecta.";
							$bValidateSuccess = false;
						}
					}
				}
				if ($_POST['cbOcupacion5_interes_1'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación Detalle primera opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacion4_interes_1'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación Sub Específica primera opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacion3_interes_1'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación Específica primera opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacionE_interes_1'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación General primera opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacionG_interes_1'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación primera opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbExperiencia_1'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- La experiencia de la primera opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacion5_interes2'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación Detalle segunda opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacion4_interes2'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación Sub Específica segunda opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacion3_interes2'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación Específica segunda opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacionE_interes2'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación General segunda opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbOcupacionG_interes2'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Ocupación segunda opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbExperiencia_2'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- La experiencia de la segunda opción: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['cbJornada_interes'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- La jornada: es requerida.";
					$bValidateSuccess = false;
				}

				if ($_POST['cbTipo_situacion_afiliado'] == "14") {
					if ($_POST['cbLugar_trabajo'] == "0") {
						$GLOBALS['aPageErrors'][] = "- El lugar de trabajo donde realiza su actividad: es requerido.";
						$bValidateSuccess = false;
					}
					if ($_POST['cbFrecuencia_actividad'] == "0") {
						$GLOBALS['aPageErrors'][] = "- La frecuencia de la actividad: es requerida.";
						$bValidateSuccess = false;
					}
				} else {
					$_POST['cbLugar_trabajo'] = "0";
					$_POST['cbFrecuencia_actividad'] = "0";
				}

				if ($_POST['cbTrabajar_fuera'] == "-1") {
					$GLOBALS['aPageErrors'][] = "- Trabajaría fuera de la ciudad: es requerida.";
					$bValidateSuccess = false;
				}
				if ($_POST['salario_interes'] == "0" or $_POST['salario_interes'] == "") {
					$GLOBALS['aPageErrors'][] = "- Salario mínimo mensual que aspira: es requerido.";
					$bValidateSuccess = false;
				}

				if ($bValidateSuccess) {
					ProcessForm($conn);
				}

				LoadData($conn, true);
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

		$aDefaultForm['cbSituacion_afiliado'] = '-1';
		$aDefaultForm['cbTipo_situacion_afiliado'] = '-1';
		$aDefaultForm['f_situacion'] = '';
		$aDefaultForm['cbOcupacion5_interes_1'] = '-1';
		$aDefaultForm['cbOcupacion4_interes_1'] = '-1';
		$aDefaultForm['cbOcupacion3_interes_1'] = '-1';
		$aDefaultForm['cbOcupacionE_interes_1'] = '-1';
		$aDefaultForm['cbOcupacionG_interes_1'] = '-1';
		$aDefaultForm['cbExperiencia_1'] = '-1';
		$aDefaultForm['cbOcupacion5_interes2'] = '-1';
		$aDefaultForm['cbOcupacion4_interes2'] = '-1';
		$aDefaultForm['cbOcupacion3_interes2'] = '-1';
		$aDefaultForm['cbOcupacionE_interes2'] = '-1';
		$aDefaultForm['cbOcupacionG_interes2'] = '-1';
		$aDefaultForm['cbExperiencia_2'] = '-1';
		$aDefaultForm['cbJornada_interes'] = '-1';
		$aDefaultForm['cbTrabajar_fuera'] = '-1';
		$aDefaultForm['cbFrecuencia_actividad'] = '-1';
		$aDefaultForm['cbLugar_trabajo'] = '-1';
		$aDefaultForm['salario_interes'] = '';
		$aDefaultForm['observaciones_ocupacion'] = '';

		if (!$bPostBack) {

			$SQL = "select persona_pref_ocupacion.id as persona_ocupacion_id, persona_pref_ocupacion.*,
					      personas.id, personas.sesiones, ocupacion.nombre as prfe_ocup1
						  from persona_pref_ocupacion 
						  INNER JOIN personas ON personas.id=persona_pref_ocupacion.persona_id 
						  INNER JOIN ocupacion ON persona_pref_ocupacion.ocupacione1=ocupacion.cod 
						  where personas.id ='" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "'";
			$rs1 = $conn->Execute($SQL);
			$_SESSION['EOF'] = $rs1->RecordCount();
			if ($rs1->RecordCount() > 0) {
				$aDefaultForm['f_situacion'] = $rs1->fields['fsituacion'];
				$aDefaultForm['cbSituacion_afiliado'] = $rs1->fields['situacion_actual'];
				$aDefaultForm['cbOcupacion5_interes_1'] = $rs1->fields['ocupacion5_1'];
				$aDefaultForm['cbOcupacion5_interes2'] = $rs1->fields['ocupacion5_2'];
?>
				<script language="javascript" src="../js/jquery.js"></script>
				<script>
					$(document).ready(function() {
						elegido = <?php echo $rs1->fields['situacion_actual'] ?>;
						combo = "condicion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: <?php echo $rs1->fields['tipo_situacion_actual']; ?>
							},
							function(data) {
								$("#cbTipo_situacion_afiliado").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacion5_1'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupacion4_1']; ?>"
							},
							function(data) {
								$("#cbOcupacion4_interes_1").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacion4_1'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupacion3_1']; ?>"
							},
							function(data) {
								$("#cbOcupacion3_interes_1").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacion3_1'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupacione1']; ?>"
							},
							function(data) {
								$("#cbOcupacionE_interes_1").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacione1'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupaciong1']; ?>"
							},
							function(data) {
								$("#cbOcupacionG_interes_1").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacion5_2'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupacion4_2']; ?>"
							},
							function(data) {
								$("#cbOcupacion4_interes2").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacion4_2'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupacion3_2']; ?>"
							},
							function(data) {
								$("#cbOcupacion3_interes2").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacion3_2'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupacione2']; ?>"
							},
							function(data) {
								$("#cbOcupacionE_interes2").html(data);
							});
					});

					$(document).ready(function() {
						elegido = "<?php echo $rs1->fields['ocupacione2'] ?>";
						combo = "Ocupacion";
						$.post("modelo.php", {
								elegido: elegido,
								combo: combo,
								seleccionado: "<?php echo $rs1->fields['ocupaciong2']; ?>"
							},
							function(data) {
								$("#cbOcupacionG_interes2").html(data);
							});
					});
				</script>
			<?php

				$aDefaultForm['cbExperiencia_1'] = $rs1->fields['experiencia1'];
				$aDefaultForm['cbExperiencia_2'] = $rs1->fields['experiencia2'];
				$aDefaultForm['cbJornada_interes'] = $rs1->fields['turno_jornada_id'];
				$aDefaultForm['cbTrabajar_fuera'] = $rs1->fields['trabajar_fuera'];
				$aDefaultForm['cbFrecuencia_actividad'] = $rs1->fields['frecuencia_trabajo_cuenta_propia'];
				$aDefaultForm['cbLugar_trabajo'] = $rs1->fields['lugar_trabajo_cuenta_propia'];
				$aDefaultForm['salario_interes'] = $rs1->fields['pref_salario'];
				$aDefaultForm['observaciones_ocupacion'] = $rs1->fields['observaciones_ocupacion'];
				$_SESSION['sesiones'] = $rs1->fields['sesiones'];
			}
		} else {

			$aDefaultForm['cbSituacion_afiliado'] = $_POST['cbSituacion_afiliado'];
			$aDefaultForm['f_situacion'] = $_POST['f_situacion'];
			$aDefaultForm['cbOcupacion5_interes_1'] = $_POST['cbOcupacion5_interes_1'];
			$aDefaultForm['cbExperiencia_1'] = $_POST['cbExperiencia_1'];
			$aDefaultForm['cbOcupacion5_interes2'] = $_POST['cbOcupacion5_interes2'];
			$aDefaultForm['cbExperiencia_2'] = $_POST['cbExperiencia_2'];
			$aDefaultForm['cbJornada_interes'] = $_POST['cbJornada_interes'];
			$aDefaultForm['cbTrabajar_fuera'] = $_POST['cbTrabajar_fuera'];
			$aDefaultForm['cbFrecuencia_actividad'] = $_POST['cbFrecuencia_actividad'];
			$aDefaultForm['cbLugar_trabajo'] = $_POST['cbLugar_trabajo'];
			$aDefaultForm['salario_interes'] = $_POST['salario_interes'];
			$aDefaultForm['observaciones_ocupacion'] = $_POST['observaciones_ocupacion'];

			?>
			<script language="javascript" src="../js/jquery.js"></script>>
			<script>
				$(document).ready(function() {
					elegido = <?php echo $_POST['cbSituacion_afiliado'] ?>;
					combo = "condicion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: <?php echo $_POST['cbTipo_situacion_afiliado']; ?>
						},
						function(data) {
							$("#cbTipo_situacion_afiliado").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion5_interes_1'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacion4_interes_1']; ?>"
						},
						function(data) {
							$("#cbOcupacion4_interes_1").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion4_interes_1'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacion3_interes_1']; ?>"
						},
						function(data) {
							$("#cbOcupacion3_interes_1").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion3_interes_1'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacionE_interes_1']; ?>"
						},
						function(data) {
							$("#cbOcupacionE_interes_1").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacionE_interes_1'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacionG_interes_1']; ?>"
						},
						function(data) {
							$("#cbOcupacionG_interes_1").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion5_interes2'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacion4_interes2']; ?>"
						},
						function(data) {
							$("#cbOcupacion4_interes2").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion4_interes2'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacion3_interes2']; ?>"
						},
						function(data) {
							$("#cbOcupacion3_interes2").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacion3_interes2'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacionE_interes2']; ?>"
						},
						function(data) {
							$("#cbOcupacionE_interes2").html(data);
						});
				});

				$(document).ready(function() {
					elegido = "<?php echo $_POST['cbOcupacionE_interes2'] ?>";
					combo = "Ocupacion";
					$.post("modelo.php", {
							elegido: elegido,
							combo: combo,
							seleccionado: "<?php echo $_POST['cbOcupacionG_interes2']; ?>"
						},
						function(data) {
							$("#cbOcupacionG_interes2").html(data);
						});
				});
			</script>
	<?php

		}
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn)
{
	$sfecha = date('Y-m-d');
	//update personas
	$sql = "update personas set 
				  status = 'A',
				  updated_at = '" . $sfecha . "',
				  id_update = '" . $_SESSION['sUsuario'] . "'
				  WHERE id= '" . $_SESSION['id_afiliado'] . "' and cedula='" . $_SESSION['ced_afiliado'] . "'";
	$conn->Execute($sql);

	//sesiones curriculum
	$nNumSeccion = 2;
	$sSQL = "SELECT sesiones FROM personas where id = " . $_SESSION['id_afiliado'];
	$rs = $conn->Execute($sSQL);

	if ($rs) {
		if ($rs->RecordCount() > 0) {
			$rs->fields['sesiones'][$nNumSeccion - 1] = 1;
			$sSQL = "update personas set sesiones = '" . $rs->fields['sesiones'] . "' where id = " . $_SESSION['id_afiliado'];
			$rs = $conn->Execute($sSQL);
		}
	}

	//update insert persona_ocupacion                           				  
	if ((isset($_SESSION['EOF']))) {
		$SQL = "select persona_pref_ocupacion.id as persona_ocupacion_id, personas.id from persona_pref_ocupacion 
						  INNER JOIN personas ON personas.id=persona_pref_ocupacion.persona_id 
						  where personas.id ='" . $_SESSION['id_afiliado'] . "'";
		$rs1 = $conn->Execute($SQL);
		if ($rs1->RecordCount() > 0) {
			$aDefaultForm['persona_ocupacion_id'] = $rs1->fields['persona_ocupacion_id'];
			$aDefaultForm['id_persona'] = $rs1->fields['id'];
			//  print $aDefaultForm['persona_ocupacion_id'];	


			$sql = "update persona_pref_ocupacion set 
				  		  situacion_actual = '" . $_POST['cbSituacion_afiliado'] . "',
						  tipo_situacion_actual = '" . $_POST['cbTipo_situacion_afiliado'] . "',
						  fsituacion = '" . $_POST['f_situacion'] . "',
						  ocupaciong1 = '" . $_POST['cbOcupacionG_interes_1'] . "',
						  ocupacione1 = '" . $_POST['cbOcupacionE_interes_1'] . "',
						  ocupacion3_1 = '" . $_POST['cbOcupacion3_interes_1'] . "',
						  ocupacion4_1 = '" . $_POST['cbOcupacion4_interes_1'] . "',
						  ocupacion5_1 = '" . $_POST['cbOcupacion5_interes_1'] . "',						  
						  experiencia1 = '" . $_POST['cbExperiencia_1'] . "',
						  ocupaciong2 = '" . $_POST['cbOcupacionG_interes2'] . "',
						  ocupacione2 = '" . $_POST['cbOcupacionE_interes2'] . "',
						  ocupacion3_2 = '" . $_POST['cbOcupacion3_interes2'] . "',
						  ocupacion4_2 = '" . $_POST['cbOcupacion4_interes2'] . "',
						  ocupacion5_2 = '" . $_POST['cbOcupacion5_interes2'] . "',
						  experiencia2 = '" . $_POST['cbExperiencia_2'] . "',
						  turno_jornada_id = '" . $_POST['cbJornada_interes'] . "',
						  trabajar_fuera = '" . $_POST['cbTrabajar_fuera'] . "',   
							frecuencia_trabajo_cuenta_propia = '" . $_POST['cbFrecuencia_actividad'] . "', 
							lugar_trabajo_cuenta_propia = '" . $_POST['cbLugar_trabajo'] . "',  
						  pref_salario = '" . $_POST['salario_interes'] . "',
						  observaciones_ocupacion = '" . $_POST['observaciones_ocupacion'] . "',
						  updated_at = '$sfecha',
						  status = 'A',
						  id_update = '" . $_SESSION['sUsuario'] . "'
						  WHERE id = '" . $aDefaultForm['persona_ocupacion_id'] . "' and persona_id= '" . $_SESSION['id_afiliado'] . "'";
			$conn->Execute($sql);
		} else {
			$sql = "insert into public.persona_pref_ocupacion
						(persona_id, situacion_actual, tipo_situacion_actual, fsituacion, ocupaciong1, ocupacione1,ocupacion3_1,
						ocupacion4_1, ocupacion5_1, experiencia1, ocupaciong2, ocupacione2, ocupacion3_2, ocupacion4_2, 
						ocupacion5_2, experiencia2, turno_jornada_id, trabajar_fuera, frecuencia_trabajo_cuenta_propia, 
						lugar_trabajo_cuenta_propia, pref_salario, observaciones_ocupacion, 
						created_at, status,
						id_update) values
						('" . $_SESSION['id_afiliado'] . "',
						 '" . $_POST['cbSituacion_afiliado'] . "',
						 '" . $_POST['cbTipo_situacion_afiliado'] . "',
						 '" . $_POST['f_situacion'] . "',
						 '" . $_POST['cbOcupacionG_interes_1'] . "',
						 '" . $_POST['cbOcupacionE_interes_1'] . "',
						 '" . $_POST['cbOcupacion3_interes_1'] . "',
						 '" . $_POST['cbOcupacion4_interes_1'] . "',
						 '" . $_POST['cbOcupacion5_interes_1'] . "',
						 '" . $_POST['cbExperiencia_1'] . "',
						 '" . $_POST['cbOcupacionG_interes2'] . "',
						 '" . $_POST['cbOcupacionE_interes2'] . "',
						 '" . $_POST['cbOcupacion3_interes2'] . "',
						 '" . $_POST['cbOcupacion4_interes2'] . "',
						 '" . $_POST['cbOcupacion5_interes2'] . "',
						 '" . $_POST['cbExperiencia_2'] . "',
						 '" . $_POST['cbJornada_interes'] . "',
						 '" . $_POST['cbTrabajar_fuera'] . "',
						 '" . $_POST['cbFrecuencia_actividad'] . "', 
						 '" . $_POST['cbLugar_trabajo'] . "',
						 '" . $_POST['salario_interes'] . "',
						 '" . $_POST['observaciones_ocupacion'] . "',
						 '$sfecha',
						 'A',
						 '" . $_SESSION['sUsuario'] . "')";
			$conn->Execute($sql);
		}			   //Trazas-------------------------------------------------------------------------------------------------------------------------------				
		$id = $_SESSION['id_afiliado'];
		$identi = $_SESSION['ced_afiliado'];
		$us = $_SESSION['sUsuario'];
		$mod = '4';
		$auditoria = new Trazas;
		$auditoria->auditor($id, $identi, $sql, $us, $mod);
		//--------------------------------------------------------------------------------------------------------------------------------------				
	}
	?><script>
		document.location = '1_5agen_trab_educacion.php'
	</script><?
			}
			//--------------------------------------------------------------------------------------------------------------------------------------
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
	<style type="text/css">
		.Estilo12 {
			color: #030303
		}
	</style>
	<div class="content-video2 video">
		<video src="../videos/video_situacion_ocupacional.mp4" class="video" controls>
			<!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
		</video>
	</div>
	<form name="frm_ocupacion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
		<script language="javascript">
			//condicion
			$(document).ready(function() {
				$("#cbSituacion_afiliado").change(function() {
					$("#cbSituacion_afiliado option:selected").each(function() {
						elegido = $(this).val();
						combo = 'condicion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							//alert(data);
							$("#cbTipo_situacion_afiliado").html(data);
						});
					});
				})
			});
			//Ocupacion 1
			$(document).ready(function() {
				$("#cbOcupacion5_interes_1").change(function() {
					$("#cbOcupacion5_interes_1 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							//alert(data);
							$("#cbOcupacion4_interes_1").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbOcupacion4_interes_1").change(function() {
					$("#cbOcupacion4_interes_1 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							$("#cbOcupacion3_interes_1").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbOcupacion3_interes_1").change(function() {
					$("#cbOcupacion3_interes_1 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							$("#cbOcupacionE_interes_1").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbOcupacionE_interes_1").change(function() {
					$("#cbOcupacionE_interes_1 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							$("#cbOcupacionG_interes_1").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbOcupacion5_interes2").change(function() {
					$("#cbOcupacion5_interes2 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							//alert(data);
							$("#cbOcupacion4_interes2").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbOcupacion4_interes2").change(function() {
					$("#cbOcupacion4_interes2 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							$("#cbOcupacion3_interes2").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbOcupacion3_interes2").change(function() {
					$("#cbOcupacion3_interes2 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							$("#cbOcupacionE_interes2").html(data);
						});
					});
				})
			});

			$(document).ready(function() {
				$("#cbOcupacionE_interes2").change(function() {
					$("#cbOcupacionE_interes2 option:selected").each(function() {
						elegido = $(this).val();
						combo = 'Ocupacion';
						$.post("modelo.php", {
							elegido: elegido,
							combo: combo
						}, function(data) {
							$("#cbOcupacionG_interes2").html(data);
						});
					});
				})
			});
		</script>

		<script>
			function send(saction) {
				if (saction == 'Continuar') {
					if (validar_frm_ocupacion() == true) {
						var form = document.frm_ocupacion;
						form.action.value = saction;
						form.submit();
					}

				} else {
					var form = document.frm_ocupacion;
					form.action.value = saction;
					form.submit();
				}
			}
		</script>
		<!-- Código Body Bootstrap 4 -->
		<section class="content">
			<div class="container-fluid">
				<div class="card card-primary" style="border-radius: 30px;">
					<div class="card-header" style="border-radius: 30px;">
						<h3 tabindex="7" aria-label="Situación Ocupacional" class="card-title"> Situación Ocupacional </h3>
					</div>
				</div>
				<div class="card card-info" style="border-radius: 30px;">
					<div class="card-header" style="border-radius: 30px 30px 0 0;">
						<h3 tabindex="8" aria-label="SITUACIÓN Actual" class="card-title"> Situación Actual </h3>
					</div>
					<div style="padding: 10px; text-align: right; margin-bottom: -25px">
						<h4 style="color: #BF1F13; font-size: 15px;">Campos obligatorios (*)</h4>
					</div>
					<form class="form-horizontal">
						<div class="card-body">
							<div class="form-group row">

								<!-- Columna 1 Izquierda -->

								<div class="col-sm-6 ">
									<div class="col-sm-12">
										<label style="color: #312E33">Situación Ocupacional</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 14px; height: auto;" src="../imagenes/ocupacion.png"></samp>
											</div>
										</div>
										<select tabindex="9" aria-label="Es obligatorio seleccionar la situación ocupacional" name="cbSituacion_afiliado" id="cbSituacion_afiliado" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control-sm select2">
											<option value="-1" selected="selected">Seleccione</option>
											<option value="1" <? if (($aDefaultForm['cbSituacion_afiliado']) == '1') print 'selected="selected"'; ?>>Buscando empleo por primera vez</option>
											<option value="2" <? if (($aDefaultForm['cbSituacion_afiliado']) == '2') print 'selected="selected"'; ?>>Ocupado buscando mejor empleo</option>
											<option value="3" <? if (($aDefaultForm['cbSituacion_afiliado']) == '3') print 'selected="selected"'; ?>>Desocupado buscando empleo (cesante)</option>
										</select>
									</div>
									<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Nombre de la Actividad *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-book-open"></samp>
												</div>
												<select name="cbCurso" id="cbCurso" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" <? if ($_POST['edit'] == "1") {
																																											$disabled = 'disabled';
																																										}
																																										echo $disabled; ?>>
													<option value="-1">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Duración *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-clock"></samp>
												</div>
												<input name="Duracion_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="Duracion_curso" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['Duracion_curso'] ?>" size="10" maxlength="4">
											</div>
										</div-->
								</div>

								<!-- Columna 2 Derecha -->

								<div class="col-sm-6">
									<div class="col-sm-12" tabindex="10">
										<label style="color: #312E33"> ¿Desde cuando está en esa situación? </label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 14px; height: auto;" src="../imagenes/calendario_2.png"></samp>
											</div>
											<input tabindex="10" aria-label="es opcional indicar desde que fecha se encuentra en esa situación" name="f_situacion" type="date" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%;" class=" form-control form-control-sm select2" id="f_situacion" value="<?= $aDefaultForm['f_situacion'] ?>" size="10">
										</div>
									</div>
									<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Entidad Capacitadora *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-school"></samp>
												</div>
												<input name="Instituto_curso" id="Instituto_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" value="<?= $aDefaultForm['Instituto_curso'] ?>" size="30" maxlength="50">
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Fecha de Realización</label>
											<div class="input-group" >
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-calendar-alt"></samp>
												</div>
												<input name="f_Duracion_curso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_Duracion_curso" value="<?= $aDefaultForm['f_Duracion_curso'] ?>" size="10">
											</div>
										</div-->
								</div>
								<!--div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;"> Observaciones Generales</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea class="form-control" id="Observaciones_curso" value="<?= $aDefaultForm['Observaciones_curso'] ?>" type="text" value="<?= $aDefaultForm['Observaciones_educacion'] ?>" size="50" maxlength="100"></textarea>
									</div>
									div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px">Código del Carnet de la Patria</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp class="fas fa-barcode"></samp>
											</div>
										<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div-->
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="card card-info" style="border-radius: 30px;">
					<div class="card-header" style="border-radius: 30px;">
						<h3 tabindex="11" aria-label="Clasificación de Ocupación u Oficio donde desea Trabajar" class="card-title"> Ocupación u Oficio donde desea Trabajar </h3>
					</div>
				</div>
				<div class="card card-secondary" style="border-radius: 30px;">
					<form class="form-horizontal">
						<div class="card-body">
							<div class="form-group row">

								<!-- Columna 1 Izquierda -->

								<div class="col-sm-6 ">
									<div class="col-sm-12" tabindex="13">
										<label style="color: #312E33">Primera Opción</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 14px; height: auto;" src="../imagenes/ocupacion.png"></samp>
											</div>
										</div>
										<input tabindex="13" aria-label="es obligatorio escribir el detalle de su ocupación" name="cbOcupacion5_interes_1" type="text" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control form-control-sm select2" id="cbOcupacion5_interes_1" size="10" onkeyup="mayus(this);">
										<!-- <select name="cbOcupacion5_interes_1" id="cbOcupacion5_interes_1" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class=" form-control-sm select2">
											<option value="-1" selected="selected">Seleccione</option>
											<? LoadOcupacion5_interes_1($conn, $param);
											print $GLOBALS['sHtml_cb_Ocupacion5_interes_1']; ?>
										</select> -->
									</div>
									<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Nombre de la Actividad *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-book-open"></samp>
												</div>
												<select name="cbCurso" id="cbCurso" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" <?/* if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;*/ ?>>
													<option value="-1">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Duración *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-clock"></samp>
												</div>
												<input name="Duracion_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="Duracion_curso" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['Duracion_curso'] ?>" size="10" maxlength="4">
											</div>
										</div-->
								</div>

								<!-- Columna 2 Derecha -->

								<div class="col-sm-6">
									<div class="col-sm-12">
										<label style="color: #312E33"> ¿Tiene Experiencia Laboral?</label><span style="color: red;"> *</span>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 14px; height: auto;" src="../imagenes/experiencia.png"></samp>
											</div>
											<select tabindex="14" aria-label="es obligatorio seleccionar si posee experiencia en laboral en su ocupación" name="cbExperiencia_1" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control-sm select2" id="cbExperiencia_1">
												<option value="" selected="selected">Seleccione</option>
												<option value="1" <? if (($aDefaultForm['cbExperiencia_1']) == '1') print $aDefaultForm['cbExperiencia_1'] = "selected"; ?>>Con Experiencia</option>
												<option value="2" <? if (($aDefaultForm['cbExperiencia_1']) == '0') print $aDefaultForm['cbExperiencia_1'] = "selected"; ?>>Sin Experiencia</option>
											</select>
										</div>
									</div>
									<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Entidad Capacitadora *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-school"></samp>
												</div>
												<input name="Instituto_curso" id="Instituto_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" value="<?= $aDefaultForm['Instituto_curso'] ?>" size="30" maxlength="50">
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Fecha de Realización</label>
											<div class="input-group" >
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-calendar-alt"></samp>
												</div>
												<input name="f_Duracion_curso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_Duracion_curso" value="<?= $aDefaultForm['f_Duracion_curso'] ?>" size="10">
											</div>
										</div-->
								</div>
								<!--div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;"> Observaciones Generales</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea class="form-control" id="Observaciones_curso" value="<?= $aDefaultForm['Observaciones_curso'] ?>" type="text" value="<?= $aDefaultForm['Observaciones_educacion'] ?>" size="50" maxlength="100"></textarea>
									</div>
									div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px">Código del Carnet de la Patria</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp class="fas fa-barcode"></samp>
											</div>
										<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div-->
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid">
				<div class="card card-secondary" style="border-radius: 30px;">
					<form class="form-horizontal">
						<div class="card-body">
							<div class="form-group row">

								<!-- Columna 1 Izquierda -->

								<div class="col-sm-6 ">
									<div class="col-sm-12" tabindex="16">
										<label style="color: #312E33">Segunda Opción </label>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 14px; height: auto;" src="../imagenes/ocupacion.png"></samp>
											</div>
										</div>
										<input tabindex="16" aria-label="es opcional escribir el detalle de su ocupación" name="cbOcupacion5_interes2" type="text" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control form-control-sm select2" id="cbOcupacion5_interes2" size="10" onkeyup="mayus(this);">
										<!-- <select name="cbOcupacion5_interes2" id="cbOcupacion5_interes2" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control-sm select2">
											<option value="-1" selected="selected">Seleccione</option>
											<? LoadOcupacion5_interes2($conn, $param);
											print $GLOBALS['sHtml_cb_Ocupacion5_interes2']; ?>
										</select> -->
									</div>
									<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Nombre de la Actividad *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-book-open"></samp>
												</div>
												<select name="cbCurso" id="cbCurso" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" <? /*if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;*/ ?>>
													<option value="-1">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Duración *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-clock"></samp>
												</div>
												<input name="Duracion_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="Duracion_curso" onKeyPress="return permite(event, 'num')" value="<?= $aDefaultForm['Duracion_curso'] ?>" size="10" maxlength="4">
											</div>
										</div-->
								</div>

								<!-- Columna 2 Derecha -->

								<div class="col-sm-6">
									<div class="col-sm-12">
										<label style="color: #312E33"> ¿Tiene Experiencia Laboral? </label>
										<div>
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp><img style="width: 14px; height: auto;" src="../imagenes/experiencia.png"></samp>
											</div>
											<select tabindex="17" aria-label="es obligatorio seleccionar si posee experiencia en laboral en su ocupación" name="cbExperiencia_2" style="border-radius: 0 15px 15px 0; margin: -31px 0 0 29px; width: 94%; border: 1px solid #ccc; color: gray" class="form-control-sm select2" id="cbExperiencia_2">
												<option value="" selected="selected">Seleccione</option>
												<option value="1" <? if (($aDefaultForm['cbExperiencia_2']) == '1') print $aDefaultForm['cbExperiencia_2'] = "selected"; ?>>Con Experiencia</option>
												<option value="2" <? if (($aDefaultForm['cbExperiencia_2']) == '0') print $aDefaultForm['cbExperiencia_2'] = "selected"; ?>>Sin Experiencia</option>
											</select>
										</div>
									</div>
									<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Entidad Capacitadora *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-school"></samp>
												</div>
												<input name="Instituto_curso" id="Instituto_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" value="<?= $aDefaultForm['Instituto_curso'] ?>" size="30" maxlength="50">
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Fecha de Realización</label>
											<div class="input-group" >
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-calendar-alt"></samp>
												</div>
												<input name="f_Duracion_curso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_Duracion_curso" value="<?= $aDefaultForm['f_Duracion_curso'] ?>" size="10">
											</div>
										</div-->
								</div>
								<div class="col-sm-12">
									<div class="col-sm-8" style="margin-top: 20px;">
										<input tabindex="19" aria-label="Guardar y continuar" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" value="Guardar y Continuar" onclick="agregar_ocupacion(cbSituacion_afiliado.value,f_situacion.value,cbOcupacion5_interes_1.value,cbExperiencia_1.value,cbOcupacion5_interes2.value,cbExperiencia_2.value);">
										<a href="capacitacion.php"><input tabindex="18" aria-label="Regresar" type="button" id="btn" style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px;margin:5px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" value="Regresar"></a>
									</div>
								</div>
								<!--div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;"> Observaciones Generales</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea class="form-control" id="Observaciones_curso" value="<?= $aDefaultForm['Observaciones_curso'] ?>" type="text" value="<?= $aDefaultForm['Observaciones_educacion'] ?>" size="50" maxlength="100"></textarea>
									</div>
									div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px">Código del Carnet de la Patria</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp class="fas fa-barcode"></samp>
											</div>
										<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div-->
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
		</div>
		</div>
		</div>
		</div>
		</div>
		<script src="ocupacion.js"></script>

		<!-- Código Viejo -->

		<!--table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th colspan="2" class="titulo">SITUACI&Oacute;N OCUPACIONAL ACTUAL </th>
        </tr>
        <tr>
          <th colspan="2" height="25" class="sub_titulo" align="left">Situaci&oacute;n actual: </th>
        </tr>
        <tr>
          <td width="34%" height="25"><div align="right" class="Estilo15">Situaci&oacute;n ocupacional: </div></td>
          <td width="66%"><select name="cbSituacion_afiliado" id="cbSituacion_afiliado" class="tablaborde_shadow" title="Situacion ocupacional - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? /*if (($aDefaultForm['cbSituacion_afiliado'])=='1') print 'selected="selected"';?>>Buscando trabajo</option>
            <option value="2" <? if (($aDefaultForm['cbSituacion_afiliado'])=='2') print 'selected="selected"';?>>No busca trabajo</option>
          </select>
            <span class="requerido"> *
         
		  <select name="cbTipo_situacion_afiliado" id="cbTipo_situacion_afiliado" class="tablaborde_shadow" title="Situacion ocupacional detallada - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
          </select>
          *</span></td>
        </tr>
        <tr>
          <td width="34%" height="25"><div align="right" class="Estilo15">Fecha desde la cual está en dicha situaci&oacute;n: </div></td>
          <td>
		  <input name="f_situacion" type="text" class="tablaborde_shadow" id="f_situacion" value="<?=$aDefaultForm['f_situacion']?>" size="10" readonly/>
                <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                <script type="text/javascript">//<![CDATA[
                             Calendar.setup({
                               inputField : "f_situacion",
                               trigger    : "f_rangeStart_trigger",
                               onSelect   : function() { this.hide() },
                               showTime   : false,
                               dateFormat : "%Y-%m-%d"
                             });
                           </script>		</td>
        </tr>
        <tr>
          <th colspan="2" height="25" class="sub_titulo" align="left">Clasificación ocupacional primera opci&oacute;n:</th>
        </tr>
        <tr>
          <td width="34%" height="25"><div align="right" class="Estilo15">Ocupación detalle:</div></td>
          <td width="66%"><select name="cbOcupacion5_interes_1" id="cbOcupacion5_interes_1" class="tablaborde_shadow" title="Ocupacion detalle - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadOcupacion5_interes_1($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_interes_1']; ?>
            </select>
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td width="34%" height="25"><div align="right" class="Estilo15">Ocupaci&oacute;n sub especifica: </div></td>
          <td><select name="cbOcupacion4_interes_1" id="cbOcupacion4_interes_1" class="tablaborde_shadow" title="Ocupacion sub especifica - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td width="34%" height="25"><div align="right" class="Estilo15">Ocupaci&oacute;n específica: </div></td>
          <td><select name="cbOcupacion3_interes_1" id="cbOcupacion3_interes_1" class="tablaborde_shadow" title="Ocupacion especifica - Seleccione solo una opcion del listado">
             <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Ocupaci&oacute;n general: </div></td>
          <td><select name="cbOcupacionE_interes_1" id="cbOcupacionE_interes_1" class="tablaborde_shadow" title="Ocupacion general - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Ocupación:</div></td>
          <td><select name="cbOcupacionG_interes_1" id="cbOcupacionG_interes_1" class="tablaborde_shadow" title="Ocupacion - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Experiencia:</div></td>
          <td><select name="cbExperiencia_1" class="tablaborde_shadow" id="cbExperiencia_1" title="Experiencia - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbExperiencia_1'])=='1') print $aDefaultForm['cbExperiencia_1']="selected";?>>Con Experiencia</option>
            <option value="0" <? if (($aDefaultForm['cbExperiencia_1'])=='0') print $aDefaultForm['cbExperiencia_1']="selected";?>>Sin Experiencia</option>
          </select>
          <span class="requerido">* </span></td>
        </tr>
        <tr>
          <th colspan="2" height="25" class="sub_titulo"><div align="left">Clasificación ocupacional  segunda opci&oacute;n: </div></th>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Ocupación detalle:</div></td>
          <td width="66%"><select name="cbOcupacion5_interes2" id="cbOcupacion5_interes2" class="tablaborde_shadow" title="Ocupacion detalle - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadOcupacion5_interes2($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_interes2']; ?>
          </select>
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Ocupaci&oacute;n sub especifica: </div></td>
          <td><select name="cbOcupacion4_interes2" id="cbOcupacion4_interes2" class="tablaborde_shadow" title="Ocupacion sub especifica - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Ocupaci&oacute;n específica: </div></td>
          <td><select name="cbOcupacion3_interes2" id="cbOcupacion3_interes2" class="tablaborde_shadow" title="Ocupacion especifica - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Ocupaci&oacute;n general: </div></td>
          <td><select name="cbOcupacionE_interes2" id="cbOcupacionE_interes2" class="tablaborde_shadow" title="Ocupacion general - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Ocupación:</div></td>
          <td><select name="cbOcupacionG_interes2" id="cbOcupacionG_interes2" class="tablaborde_shadow" title="Ocupacion - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Experiencia:</div></td>
          <td><select name="cbExperiencia_2" class="tablaborde_shadow" id="cbExperiencia_2" title="Experiencia - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbExperiencia_2'])=='1') print $aDefaultForm['cbExperiencia_2']="selected";?>>Con Experiencia</option>
            <option value="0" <? if (($aDefaultForm['cbExperiencia_2'])=='0') print $aDefaultForm['cbExperiencia_2']="selected";?>>Sin Experiencia</option>
          </select>
          <span class="requerido">*</span></td>
        </tr>
        <tr id="tr_cuenta_propia1">
          <td height="25"><div align="right" class="Estilo15">Lugar de trabajo donde realiza su actividad: </div></td>
          <td><select name="cbLugar_trabajo" id="cbLugar_trabajo" class="tablaborde_shadow" title="Lugar de trabajo donde realiza su actividad - Seleccione solo una opcion del listado">
            <option value="0" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbLugar_trabajo'])=='1') print 'selected="selected"';?>>Lugar fijo </option>
            <option value="2" <? if (($aDefaultForm['cbLugar_trabajo'])=='2') print 'selected="selected"';?>>Sin Lugar fijo </option>
          </select></td>
        </tr>
        <tr>
          <th colspan="2" height="25" class="sub_titulo" align="left">Otra informaci&oacute;n:</th>
        </tr>
        <tr id="tr_cuenta_propia2">
          <td height="25"><div align="right" class="Estilo15">Frecuencia de la actividad: </div></td>
          <td><select name="cbFrecuencia_actividad" id="cbFrecuencia_actividad" class="tablaborde_shadow" title="Frecuencia de las actividad - Seleccione solo una opcion del listado">
            <option value="0" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbFrecuencia_actividad'])=='1') print 'selected="selected"';?>>Estacional </option>
            <option value="2" <? if (($aDefaultForm['cbFrecuencia_actividad'])=='2') print 'selected="selected"';?>>Ocasional  </option>
            <option value="3" <? if (($aDefaultForm['cbFrecuencia_actividad'])=='3') print 'selected="selected"';?>>Permanente  </option>
          </select></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Jornada en la que le gustar&iacute;a trabajar: </div></td>
          <td><span class="requerido">
            <select name="cbJornada_interes" class="tablaborde_shadow" id="cbJornada_interes" title="Jornadaen la que le gustaria trabajar - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? if (isset($GLOBALS['aDefaultForm']['cbJornada_interes'])){
			LoadJornada_interes($conn); print $GLOBALS['sHtml_cb_Jornada_interes']; }?>
            </select>
          </span><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Trabajar&iacute;a fuera de la ciudad?: </div></td>
          <td><select name="cbTrabajar_fuera" class="tablaborde_shadow" id="cbTrabajar_fuera" title="Le gustaria trabajar fuera de la ciudad - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <option value="0" <? if (($aDefaultForm['cbTrabajar_fuera'])=='0') print $aDefaultForm['cbTrabajar_fuera']="selected";?>>No</option>
            <option value="1" <? if (($aDefaultForm['cbTrabajar_fuera'])=='1') print $aDefaultForm['cbTrabajar_fuera']="selected";?>>Si</option>
          </select>
          <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Salario  Mensual que aspira (en Bs.): </div></td>
          <td><input name="salario_interes" type="text" class="tablaborde_shadow" id="salario_interes" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['salario_interes']?>" size="30" maxlength="8" title="Salario mensual que aspira - Ingrese solo una numeros"/>
              <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td height="25"><div align="right" class="Estilo15">Observaciones generales: </div></td>
          <td><input name="observaciones_ocupacion" type="text" class="tablaborde_shadow" id="observaciones_ocupacion" value="<?=$aDefaultForm['observaciones_ocupacion']?>" size="50" maxlength="100" title="Observaciones del funcionario que ingresa la informacion - Ingrese letras y/o numeros" />
                  </td>
        </tr>
        <tr>
          <td colspan="2">
		   <div align="center"><span class="requerido">
		   <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
		   <button type="button" name="Cancelar"  id="Cancelar" class="button"  onclick="javascript:send('Cancelar');">Cancelar</button>
	      </span></div></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
      </div>
</form-->
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

<? include('footer.php'); ?>
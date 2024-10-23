<?php
//***version 1.2 fecha:07-04-2020

ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
//ini_set("memory_limit","128M");
ini_set("max_execution_time", "9500000000");
include("../../include/header.php");
include("../../include/grabaPDF.php");

session_start();

$conn = getConnDB($db1);
$conn->debug = false;
$url = $_SERVER['REQUEST_URI'];

date_default_timezone_set('America/Caracas');
$lenguage = 'es_VE.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage, "esp");

unset($_SESSION['aDefaults']);
unset($_SESSION['aDefaults1']);

$boleta = $_POST['boleta'];
$sql_emp = "Select srif, 
	srazon_social,
	sdenominacion_comercial,
	sucursales,
	id
	from rncpt.empresa where empresa.nro_boleta = '" . $boleta . "' and empresa.nestatus='1' ";
$rs1 = $conn->Execute($sql_emp);
if ($rs1->Recordcount() > 0) {
	$_SESSION['aDefaults1']['razon_empresa'] = $rs1->fields['srazon_social'];
	$_SESSION['aDefaults1']['sdenominacion_comercial'] = $rs1->fields['sdenominacion_comercial'];
	$_SESSION['aDefaults1']['srif'] = $rs1->fields['srif'];
	$_SESSION['aDefaults1']['sucursales'] = $rs1->fields['sucursales'];
	$empresa_id = $rs1->fields['id'];

	$SQL = "SELECT miembros_empresa.id, 
		miembros_empresa.nenabled,
		miembros_empresa.dfecha_const_comite,
		miembros_empresa.dfecha_nueva_eleccion,
		miembros.ncedula,
		miembros.sprimer_nombre,
		miembros.ssegundo_nombre,
		miembros.sprimer_apellido,
		miembros.ssegundo_apellido,
		miembros.stelefono1,
		miembros.stelefono2,
		miembros.nsexo,
		miembros.semail,
		miembros.fecha_nacimiento,
		condicion_act.sdescripcion as condicion_act,
		cargos.descripcion_cargo as cargos
		FROM rncpt.miembros_empresa
		INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
		inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
		inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
		WHERE miembros_empresa.empresa_id = '" . $empresa_id . "' 
		AND miembros_empresa.condicion_laboral_id=1
		AND miembros_empresa.nenabled = '1';";
	$rs = $conn->Execute($SQL);
	if ($rs->RecordCount() > 0) {
		while (!$rs->EOF) {
			$aTabla[] = array();
			$c = count($aTabla) - 1;
			$apellidonombre = ucwords(strtolower($rs->fields['sprimer_apellido'] . " " . $rs->fields['ssegundo_apellido'] . " " . $rs->fields['sprimer_nombre'] . " " . $rs->fields['ssegundo_nombre']));
			$apellidonombre_ = ucwords(strtolower($rs->fields['sprimer_apellido'] . " " . $rs->fields['sprimer_nombre']));
			$aTabla[$c]['sdescripcion'] = $rs->fields['condicion_act'];
			$aTabla[$c]['ncedula'] = $rs->fields['ncedula'];
			$aTabla[$c]['apellidonombre'] = $apellidonombre;
			$aTabla[$c]['apellidonombre_'] = $apellidonombre_;
			$aTabla[$c]['stelefono1'] = $rs->fields['stelefono1'];
			$aTabla[$c]['stelefono2'] = $rs->fields['stelefono2'];
			$aTabla[$c]['dfecha_const_comite'] = $rs->fields['dfecha_const_comite'];
			$aTabla[$c]['dfecha_nueva_eleccion'] = $rs->fields['dfecha_nueva_eleccion'];
			$aTabla[$c]['semail'] = $rs->fields['semail'];
			$sexo = $rs->fields['nsexo'];
			if ($sexo == '1') $aTabla[$c]['sexo'] = 'M';
			if ($sexo == '2') $aTabla[$c]['sexo'] = 'F';
			$aTabla[$c]['condicion_act'] = $rs->fields['condicion_act'];

			$aTabla[$c]['id'] = $rs->fields['id'];

			$aTabla[$c]['fecha_nacimiento'] = $rs->fields['fecha_nacimiento'];

			$aTabla[$c]['cargos'] = $rs->fields['cargos'];

			$rs->MoveNext();
		}

		$_SESSION['aDefaults'] = $aTabla;
	} else {
?><script>
			alert("LA EMPRESA NO TIENE VOCEROS REGISTRADOS");
		</script><?
				}
			} else {
					?><script>
		alert("EL NRO. DE BOLETA NO EXISTE");
	</script><?
			}

			if (!isset($_SESSION['aDefaults']) or !isset($_SESSION['aDefaults1'])) {
				?>
	<script>
		alert("Se jue");
		parent.document.location = '../../mod_login/login.php';
	</script>
<?
			} else {

				$index = 0;

				$i = 0;

				$empresa = htmlentities($_SESSION['aDefaults1']['razon_empresa'], ENT_QUOTES);
				$srif = $_SESSION['aDefaults1']['srif'];
				$sucursal = htmlentities($_SESSION['aDefaults1']['sucursales'], ENT_QUOTES);
				$cedula = '';
				$nombre_completo = '';
				$fecha_constitucion .= date("d-m-Y", strtotime($_SESSION['aDefaults'][$i]['dfecha_const_comite'] . ", "));
				$fecha_nueva_eleccion .= date("d-m-Y", strtotime($_SESSION['aDefaults'][$i]['dfecha_nueva_eleccion'] . ", "));
				for ($i = 0; $i < count($_SESSION['aDefaults']); $i++) {
					$cedula .= "V-" . number_format($_SESSION['aDefaults'][$i]['ncedula'], 0, '', '.') . ", ";
					$nombre_completo .= strtoupper($_SESSION['aDefaults'][$i]['apellidonombre_'] . ", ");
				}
				/*var_dump($_SESSION['aDefaults']);
var_dump($_SESSION['aDefaults1']);*/
				$tbl = <<<EOD
<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td align="center"><b><h2>BOLETA DE REGISTRO N° $boleta </h2></b></td>
</tr>

<tr>
	<td align="justify" style="font-size:90%">Quien suscribe, <b>GERM&Aacute;N EDUARDO PI&Ntilde;ATE RODR&Iacute;GUEZ</b>, Ministro del Poder Popular para el Proceso Social de Trabajo, conforme a las atribuciones establecidas en el Decreto con Rango, Valor y Fuerza de Ley Orgánica del Trabajo, los Trabajadores y las Trabajadoras (LOTTT) conjuntamente con la Ley Constitucional de los Consejos Productivos de Trabajadoras y Trabajadores, constituyendo y organizando la participación protagónica de la clase obrera en la gestión de la actividad productiva y distribución de bienes y servicios, a fin de garantizar el desarrollo productivo de la nación. Previa verificación que se han cumplido los requisitos legales que deben concurrir al efecto, <b>DECLARO PRIMERO</b>: Que existe Consejo Productivo de Trabajadores y Trabajadoras (CPTT), legalmente constituido en fecha <b>$fecha_constitucion</b>. SEGUNDO: Que en fecha <b>$fecha_nueva_eleccion</b> se realiz&oacute; una nueva elección quedando electos los ciudadanos:<b> $nombre_completo</b> titulares de la cédula de identidad Nº <b> $cedula </b>respectivamente, como voceras y voceros del CPTT de la entidad de trabajo <b>$empresa ($sucursal)</b>, por un período de dos (02) años, contados a partir de la fecha de su elección. Por consiguiente los mismos, est&aacute;n investidos de inamovilidad laboral, razón por la cual no podrán ser despedidos, trasladados o desmejorados de su puesto de trabajo, sin justa causa previamente calificada por el Inspector o Inspectora del Trabajo. En tal sentido, se <b>ORDENA</b> el Registro correspondiente, conforme a lo dispuesto en la norma <i>ut supra</i> señalada.</td>	
</tr>
</table>
EOD;

				$tbl2 = <<<EOD
<table width="100%" border="0" cellpadding="2" cellspacing="2">
	<tr>
		<td height="20"></td>
	</tr>

	<tr>
		<td height="20"></td>
	</tr>

	<tr>
		<td height="20"></td>
	</tr>
<tr>
   <td align="center"><style="font-size:100%"><img src="../img_firmas/firma_eduardo.jpg" height="100"><br/><b>GERM&Aacute;N EDUARDO PI&Ntilde;ATE RODR&Iacute;GUEZ </b><br/><b>Ministro del Poder Popular para el Proceso Social de Trabajo</b><br/>Decreto Presidencial N° 5.001 de fecha 11 de Septiembre de 2024<br/>Gaceta Oficial Extraordinario Nro. 6.840 de fecha 11 de Septiembre de 2024</td>
</tr>

</table>
EOD;

				$tbl3 = <<<EOD
<div>
	<tr>
		<td height="80"></td>
	</tr>
	<tr>
		<td height="80"></td>
	</tr>
	<tr>
		<td height="20"></td>
	</tr>
	<tr>
		<td><label align="right" style="font-size:70%">www.mpppst.gob.ve </label></td>
	</tr>	
</div>
EOD;
				/*echo $tbl;
echo $tbl2;
echo $tbl3;*/
				grabaPDF(array(
					nombre => "",
					texto => $tbl . $tbl2,
					qr => true,
					fondo => "fondo.jpg",
					opciones => array(
						SetAuthor =>  'MPPPST',
						SetTitle  =>  'Boleta de Registro RNCPTT',
						SetSubject => 'Boleta de Registro RNCPTT',
						SetLeftMargin => 22,
						SetTopMargin  => 23,
						SetRightMargin => 22,
						SetFooterMargin => false,
						setPrintFooter  => false

					)
				));

				//============================================================+
				// END OF FILE                                                
				//============================================================+ </p>
			}

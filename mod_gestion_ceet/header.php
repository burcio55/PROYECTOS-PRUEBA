<?php
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
$lenguage = 'es_VE.UTF-8';
putenv("LANG=$lenguage");
setlocale(LC_ALL, $lenguage, "esp");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<?php if (!isset($login)) { ?>
		<link rel="stylesheet" type="text/css" href="/minpptrassi/css/styles_general.css" />
		<link rel="stylesheet" type="text/css" href="/minpptrassi/css/styles_menu.css" />
		<link rel="stylesheet" type="text/css" href="/minpptrassi/css/styles_loader.css" />
		<link rel="stylesheet" type="text/css" href="/minpptrassi/css/styles_datalist.css" />
		<link rel="stylesheet" type="text/css" href="/minpptrassi/css/formularios.css" />
		<title>MPPPST</title>
	<?php } else { ?>
		<link rel="stylesheet" type="text/css" href="/minpptrassi/css/styles_login.css" />
		<title>Iniciar sesi&oacute;n</title>
	<?php } ?>

	<link rel="stylesheet" type="text/css" href="/minpptrassi/bootstrap/3.3.7/css/bootstrap.css">
	<script type="text/javascript" language="JavaScript" src="/minpptrassi/js/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" language="JavaScript" src="/minpptrassi/bootstrap/3.3.7/js/bootstrap.js"></script>

	<script type="text/javascript" language="JavaScript" src="/minpptrassi/menu/jquery.js"></script>
	<script type="text/javascript" language="JavaScript" src="/minpptrassi/menu/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="/minpptrassi/menu/jquery-ui.css" />

	<link rel="stylesheet" type="text/css" href="/minpptrassi/menu/ddsmoothmenu.css" />
	<link rel="stylesheet" type="text/css" href="/minpptrassi/datatables/1.10.15/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="/minpptrassi/botones/css/botones_IZ.css" />
	<link rel="stylesheet" type="text/css" href="/minpptrassi/css/msdropdown/dd.css" />

	<script type="text/javascript" language="JavaScript" src="/minpptrassi/js/datefunctions.js"></script>
	<script type="text/javascript" language="JavaScript" src="/minpptrassi/feriados/js/feriados.js"></script>
	<script type="text/javascript" language="JavaScript" src="/minpptrassi/js/funciones_generales.js"></script>
	<script type="text/javascript" language="JavaScript" src="/minpptrassi/js/msdropdown/jquery.dd.js"></script>

	<script src="/minpptrassi/calendario/js/jscal2.js"></script>
	<script src="/minpptrassi/calendario/js/lang/es.js"></script>
	<link rel="stylesheet" type="text/css" href="/minpptrassi/calendario/css/jscal2.css" />

	<link rel="stylesheet" type="text/css" href="/minpptrassi/calendario/css/border-radius.css" />
	<link rel="stylesheet" type="text/css" href="/minpptrassi/calendario/css/win2k/win2k.css" />
	<link type="text/css" rel="stylesheet" href="/minpptrassi/calendario/css/reduce-spacing.css" />
	<?php if (!isset($login)) { ?>
		<?php
		$imagen_n1 = 'menu/imagenes/down.gif';
		if (file_exists($imagen_n1)) { //echo "Nivel 0";
		?>
			<script type="text/javascript" language="JavaScript" src="/minpptrassi/menu/ddsmoothmenu_n0.js" charset="UTF-8"></script>
			<?php
		} else {
			$imagen_n2 = '../../menu/imagenes/down.gif';
			if (file_exists($imagen_n2)) { //echo "Nivel 2";
			?>
				<script type="text/javascript" language="JavaScript" src="/minpptrassi/menu/ddsmoothmenu_n2.js" charset="UTF-8"></script>
				<?php
			} else {
				$imagen_n3 = '../../../menu/imagenes/down.gif';
				if (file_exists($imagen_n3)) { //echo "Nivel 3";
				?>
					<script type="text/javascript" language="JavaScript" src="/minpptrassi/menu/ddsmoothmenu_n3.js" charset="UTF-8"></script>
				<?php
				} else { //echo "Nivel 1";
				?>
					<script type="text/javascript" language="JavaScript" src="/minpptrassi/menu/ddsmoothmenu_n1.js" charset="UTF-8"></script>
		<?php
				}
			}
		}
		?>

		<script type="text/javascript">
			ddsmoothmenu.init({
				mainmenuid: "smoothmenu1",
				orientation: 'h',
				classname: 'ddsmoothmenu',
				contentsource: "markup"
			})
		</script>

		<script type="text/javascript" language="JavaScript" src="/minpptrassi/js/jquery/jquery.maskedinput.js"></script>
		<script type="text/javascript" language="JavaScript" src="/minpptrassi/datatables/1.10.15/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="JavaScript" src="/minpptrassi/datatables/funcion_paginador.js"></script>
		<script type="text/javascript" language="JavaScript" src="/minpptrassi/js/funciones_combos.js"></script>
		<script type="text/javascript" language="JavaScript" src="/minpptrassi/js/funciones_generales.js"></script>
		<script>
			jQuery(function($) {
				$("#cedula").mask("99.999.999");
				$("#fechanac").mask("99/99/9999");
				$("#telefono").mask("(9999)-9999999");
				$("#celular").mask("(9999)-9999999");
			});
		</script>

		<title>Sistema</title>
</head>

<body>


	<?php include("include/header.php"); ?>
	<?php
		$settings['debug'] = false;
		$conn = getConnDB($db1);
		$conn->debug = $settings['debug'];
	?>
	<?php include("include/bitacora.php"); ?>
	<?php include("include/seguridad.php"); ?>

	<?php
		if (!isset($registro_personal)) {
			if (!isset($olvido_contrasena)) { //echo "validar_sesion";
				validar_sesion();
			} else {
				//echo "olvido_contrasena";
			}
		} else {
			//echo "registro_personal";
		}
	?>

	<div id="contenedor" align="center">
		<div id="Cinta">
		</div>
		<div id="Encabezado">

			<?php
			@$diasemena = date('w');
			if ($diasemena == 0) {
				$dialetra = "Domingo";
			}
			if ($diasemena == 1) {
				$dialetra = "Lunes";
			}
			if ($diasemena == 2) {
				$dialetra = "Martes";
			}
			if ($diasemena == 3) {
				$dialetra = "Mi&eacute;rcoles";
			}
			if ($diasemena == 4) {
				$dialetra = "Jueves";
			}
			if ($diasemena == 5) {
				$dialetra = "Viernes";
			}
			if ($diasemena == 6) {
				$dialetra = "S&aacute;bado";
			}
			@$diames = date('j');
			@$mes = date('m');
			if ($mes == '01') {
				$mesletra = "Enero";
			}
			if ($mes == '02') {
				$mesletra = "Febrero";
			}
			if ($mes == '03') {
				$mesletra = "Marzo";
			}
			if ($mes == '04') {
				$mesletra = "Abril";
			}
			if ($mes == '05') {
				$mesletra = "Mayo";
			}
			if ($mes == '06') {
				$mesletra = "Junio";
			}
			if ($mes == '07') {
				$mesletra = "Julio";
			}
			if ($mes == '08') {
				$mesletra = "Agosto";
			}
			if ($mes == '09') {
				$mesletra = "Septiembre";
			}
			if ($mes == '10') {
				$mesletra = "Octubre";
			}
			if ($mes == '11') {
				$mesletra = "Noviembre";
			}
			if ($mes == '12') {
				$mesletra = "Diciembre";
			}
			@$ano = date('Y');
			@$tiempo = date('h:i:s A');
			?>

			<table width="100%" border="0">
				<tr>
					<th colspan="3" height="4"></th>
				</tr>

				<tr>
					<!--    <th > <font color="#1a5276" size="2"> <div align="left">Sistema de Informaci&oacute;n de Gesti&oacute;n Laboral (SIGLA)</div></font></th>-->
					<th colspan="3">
						<div align="right">
							<font color="#1a5276" size="-4"><?php echo $_SESSION['apellido1'] . " " . $_SESSION['nombre1']; ?></font>
						</div>
					</th>
				</tr>

				<tr>
					<th colspan="3" height="2"></th>
				</tr>

				<tr> </tr>
				<?php if (isset($_SESSION['sistema'])) { ?>
					<tr>
						<th colspan="2">
							<font color="#1a5276" size="2">
								<div align="left"><?php echo $_SESSION['sistema']; ?></div>
							</font>
						</th>
						<td align="right">
							<font color="#1a5276" size="-4">
								<?= $dialetra . ", " . $diames . " de " . $mesletra . " del " . $ano; ?>
							</font>
						</td>
						<?php
						$idmodulosistema = "SELECT id, sdescripcion FROM modulo WHERE opcion_id = " . $_SESSION['id_modulo'] . " and senabled='1';";
						$rsidmodulosistema = $conn->Execute($idmodulosistema);
						$_SESSION['moduloid'] = $rsidmodulosistema->fields['id'];
						$_SESSION['modulodescriocion'] = $rsidmodulosistema->fields['sdescripcion'];
						?>
					</tr>
				<?php } else { ?>
					<?php if (!isset($registro_personal)) { ?>
						<?php if (!isset($olvido_contrasena)) { ?>
							<tr>
								<th colspan="2">
									<font color="#1a5276" size="2">
										<div align="left">M&Oacute;DULOS</div>
									</font>
								</th>
								<td align="right">
									<font color="#1a5276" size="-4"><?= $dialetra . ", " . $diames . " de " . $mesletra . " del " . $ano; ?></font>
								</td>
							</tr>
						<?php } else { ?>
							<tr>
								<th colspan="2"><strong>
										<div align="center">OLVIDO CONTRASEÑA</div>
									</strong></th>
							</tr>
						<?php } ?>
					<?php } else { ?>
						<tr>
							<th colspan="2"><strong>
									<div align="center">DATOS DEL TRABAJADOR</div>
								</strong></th>
						</tr>
					<?php } ?>

				<?php } ?>
			</table>
		</div>
		<?php include("menu.php"); ?>
	<?php } else { ?>
		<div id="contenedor" align="center">
		<?php } ?>
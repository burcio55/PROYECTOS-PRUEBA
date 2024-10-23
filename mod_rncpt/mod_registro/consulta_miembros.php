<?php
//-----------------------------------------------------
ini_set('display_errors', 0);
error_reporting(E_ALL | E_STRICT | E_DEPRECATED);
include("../../include/header.php");
$conn = getConnDB($db1);
$conn->debug = false;
//var_dump($_GET);
//var_dump($conn);
//-----------------------------------------------------
switch ($_GET['accion']) {
	case '1':

		if ($_GET['id'] != NULL) {

			// aqui debo hacer el select para caragar los datos
			$SQL = "SELECT miembros_empresa.id as id_miembro_empresa, 
						miembros_empresa.nenabled,
						miembros_empresa.total_trabajadores,
						miembros_empresa.dfecha_const_comite,
						miembros_empresa.dfecha_vencimiento,
						miembros_empresa.dfecha_nueva_eleccion,
						miembros_empresa.condicion_act_id,
						miembros_empresa.condicion_laboral_id,
						miembros_empresa.cargos_id,				
						miembros_empresa.nro_votos,
						miembros_empresa.comentarios,
						miembros.ncedula,
						miembros.id,
						miembros.sprimer_nombre,
						miembros.ssegundo_nombre,
						miembros.sprimer_apellido,
						miembros.ssegundo_apellido,
						miembros.stelefono1,
						miembros.stelefono2,
						miembros.nsexo,
						miembros.semail,
						miembros.sdireccion_habitacion,
						miembros.fecha_nacimiento,
						miembros_empresa.condicion_act_id,
						miembros_empresa.condicion_laboral_id,
						cargos.descripcion_cargo	as cargos,
						miembros_empresa.cargos_id,
						miembros_empresa.nestatus_cptt					
				FROM rncpt.miembros_empresa
				INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
				inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
				inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
				inner join rncpt.condicion_laboral on miembros_empresa.condicion_laboral_id=condicion_laboral.id
				WHERE miembros_empresa.empresa_id = '" . $_SESSION["empresa_id"] . "' and miembros.id= '" . $_GET["id"] . "' 
				AND miembros_empresa.nenabled = '1';";

			$rs = $conn->Execute($SQL);
			if ($rs->RecordCount() > 0) {
				$nestatus_cptt = $rs->fields['nestatus_cptt'];

				//echo "quiiiii";
				$cedulaconsulta = $rs->fields['ncedula'];
				$apellidonombre = ucwords(strtolower($rs->fields['sprimer_apellido'] . " " . $rs->fields['ssegundo_apellido'] . " " . $rs->fields['sprimer_nombre'] . " " . $rs->fields['ssegundo_nombre']));


				$fechanac = $rs->fields['fecha_nacimiento'];

				$fechanac_ = date("Y-m-d", strtotime($fechanac));
				$edad = edad_($fechanac_);

				$sexo            = trim($rs->fields['nsexo']);
				if ($sexo == '1') $sexo = 'M';
				if ($sexo == '2') $sexo = 'F';

				$email = $rs->fields['semail'];
				if ($rs->fields['stelefono2'] == '') {
					$codigo2 = '';
					$telefono2 = '';
				} else {
					$codigo2 = substr($rs->fields['stelefono2'], 0, 4);
					$telefono2 = substr($rs->fields['stelefono2'], 4);
				}
				if ($rs->fields['stelefono1'] == '') {
					$codigo1 = '';
					$telefono1 = '';
				} else {
					$codigo1 = substr($rs->fields['stelefono1'], 0, 4);
					$telefono1 = substr($rs->fields['stelefono1'], 4);
				}
				$total_trabajadores = $rs->fields['total_trabajadores'];
				$fechaconst = $rs->fields['dfecha_const_comite'];
				$fechavencimiento = $rs->fields['dfecha_vencimiento'];
				$txt_comentarios = $rs->fields['comentarios'];
				$cbo_cargos = $rs->fields['cargos_id'];
				$sdireccion_habitacion = $rs->fields['sdireccion_habitacion'];
				$fechanueva_eleccion = $rs->fields['dfecha_nueva_eleccion'];
				$nro_votos = $rs->fields['nro_votos'];
				$condicion_laboral_id = $rs->fields['condicion_laboral_id'];
				$condicion_act_id = $rs->fields['condicion_act_id'];
				$id = $rs->fields['id'];
				$id_miembro_empresa = $rs->fields['id_miembro_empresa'];
				$success = 1;
			}

			if ($success == 1) {
				$datos = array(
					"response" => "success",
					"id_miembro_empresa" => $id_miembro_empresa,
					"id" => $id,
					"cedulaconsulta" => $cedulaconsulta,
					"apellidonombre" => $apellidonombre,
					"fechanac" => $fechanac,
					"edad" => $edad,
					"sexo2" => $sexo,
					"email" => $email,
					"codigo1" => $codigo1,
					"telefono1" => $telefono1,
					"codigo2" => $codigo2,
					"telefono2" => $telefono2,
					"total_trabajadores" => $total_trabajadores,
					"fechaconst" => $fechaconst,
					"fechavencimiento" => $fechavencimiento,
					"txt_comentarios" => $txt_comentarios,
					"cbo_cargos" => $cbo_cargos,
					"sdireccion_habitacion" => $sdireccion_habitacion,
					"condicion_laboral" => $condicion_laboral_id,
					"condicion" => $condicion_act_id,
					"total_trabajadores" => $total_trabajadores,
					"fechanueva_eleccion" => $fechanueva_eleccion,
					"fechaconst" => $fechaconst,
					"nro_votos" => $nro_votos,
					"nestatus_cptt" => $nestatus_cptt
				);
			} else {
				$datos = array("response" => "nosuccess");
			}

			//var_dump($datos);
			echo json_encode($datos);
		}

		break;
}

function edad_($fecha)
{

	list($Y, $m, $d) = explode("-", $fecha);
	return (date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y);
}

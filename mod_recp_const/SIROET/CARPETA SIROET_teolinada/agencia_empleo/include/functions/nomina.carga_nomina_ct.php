<?php
/**
 * obtiene los trabajadores de una nómina de carga trimestral (ct)(declaracion trimestral)
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param integer $establecimiento	código del establecimiento de la empresa
 * @param integer $empresa	código de la empresa 
 * @param integer $rif		rif de la empresa  
 * @param integer $trimestre	trimestre de la declaración
 * @param integer $anio		año del declaración 
 * @return array $nomina 	conjunto de trabajadores, cada elemento es un trabajador
			 	con las siguientes campos: 
				nEstablecimiento_nomina, cedula, nombre,
				apellido, sexo, fecha_nacimiento, cargo,
				tipo_trabajador, fecha_ingreso, salario,
				nacionalidad, estado_trabajador
 * @depends  			adodb
 */
function carga_nomina_ct($establecimiento,$empresa,$rif,$trimestre,$anio)
{
	global $conn;

	$nomina = array();
	$sql = "select * from trimestral.establecimiento_nomina 
	where nEstablecimiento = $establecimiento 
	and nEmpresa = $empresa 
	and sRif = '$rif'
	and nTrimestreDeclaracion = $trimestre 
	and sAnoDeclaracion = '$anio'";
	
	$rs = $conn->Execute( $sql );
	while( !$rs->EOF )
	{
		$trabajador = array();
		$trabajador['nEstablecimiento_nomina'] = $rs->fields['nEstablecimiento_nomina'];
		$trabajador['cedula'] = $rs->fields['sUsuario'];
		$trabajador['nombre'] = $rs->fields['sNombre'];
		$trabajador['apellido'] = $rs->fields['sApellido'];
		$trabajador['sexo'] = $rs->fields['nSexo'];
		$trabajador['fecha_nacimiento'] = $rs->fields['dFechaNacimiento'];	
		$trabajador['cargo'] = $rs->fields['sCargo'];
		$trabajador['tipo_trabajador'] = $rs->fields['nTipoTrabajador'];
		$trabajador['fecha_ingreso'] = $rs->fields['dFechaIngreso'];
		$trabajador['salario'] = $rs->fields['nSalario'];
		$trabajador['nacionalidad'] = $rs->fields['nNacionalidad'];
		$trabajador['estado_trabajador'] = $rs->fields['nEstadoTrabajador'];
		$nomina[] = $trabajador;
		$rs->MoveNext();
	}
	return $nomina;
}
?>

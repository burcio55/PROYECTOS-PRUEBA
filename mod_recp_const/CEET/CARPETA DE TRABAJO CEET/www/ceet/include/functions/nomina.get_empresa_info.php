<?php
/**
 * obtiene el registro(tabla relestabempresa) de la empresa
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param string $establecimiento	código del establecimiento de la empresa
 * @return array $fields arreglo que contiene los datos de la empresa
 * @depends  			adodb
 */
function get_empresa_info($establecimiento)
{
	global $conn;
	$sql = "select nEstablecimiento,nEmpresa,sRif,sNil,sInce,sIvss,nCantEstab,sEnabled,sNit,sPreCarga 
	from relestabempresa where nEstablecimiento = ".$establecimiento;
	$rs = $conn->Execute($sql);
	if ( $rs->RecordCount() > 0 )
	{
		return $rs->fields;
	}
}
?>
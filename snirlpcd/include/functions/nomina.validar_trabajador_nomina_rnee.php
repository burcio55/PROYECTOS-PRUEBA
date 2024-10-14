<?php
/**
 * valida el trabajador de la nómina para el modulo de rnee
 * usa el objeto de conexion global definido en la pagina que incluye y 
 * usa las variables de sesion para buscar en la base de datos
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param array $identificador	identificador o cedula del trabajador
 * @param boolean $bValidateSuccess indica si el trabajador es válido o no
 */
function validar_trabajador_nomina_ct( $identificador )
{
	global $conn;
	$bValidateSuccess = true;
	
	$sql = "select * from trimestral.establecimiento_nomina 
	where nEstablecimiento = ".$_SESSION['nEstablecimiento']." 
	and nEmpresa = ".$_SESSION['nEmpresa']." 
	and sRif='".$_SESSION['sRif']."' 
	and sUsuario = '".$identificador."' 
	and nTrimestreDeclaracion = ".$_SESSION["CT"]["nTrimestre"]." 
	and sAnoDeclaracion = '".$_SESSION["CT"]["nAno"]."'";

	$rs = &$conn->Execute( $sql );
	if ( $rs->RecordCount()!= 0 )
	{
		$bValidateSuccess = false;						
	}	
	
	return $bValidateSuccess;
}

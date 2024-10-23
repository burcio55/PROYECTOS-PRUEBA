<?php
/**
 * valida el trabajador de la n�mina para el modulo de carga trimestral(ct)(declaracion trimestral)
 * usa el objeto de conexion global definido en la pagina que incluye y
 * usa las variables de sesion para buscar en la base de datos
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param array $identificador	identificador o cedula del trabajador
 * @param boolean $bValidateSuccess indica si el trabajador existe o no
 * @depends  				adodb
 */

function existe_trabajador_ct( $ncedula )
{
	global $conn;
//        $conn->debug = true;
	$sql = "select id from trimestral.trabajador where ncedula = '".$ncedula."'";
	$rs = $conn->Execute( $sql );
	return ($rs->RecordCount()>0) ? $rs->fields['id'] : false;
}

function existe_nomina_ct( $identificador )
{
	global $conn;
	$id = existe_trabajador_ct( $identificador );
	if ($id){
            $sql = "SELECT id
            FROM trimestral.nomina
            WHERE
            trabajador_id = ".$id." AND
            rnee_empresa_id='".$_SESSION['empresa_id']."' AND
            nano_trimestre='".$_SESSION['nano_trimestre']."' AND
            ntrimestre='".$_SESSION['ntrimestre']."'";
            $rs = $conn->Execute( $sql );
            return ($rs->RecordCount()>0) ? $id : false;
        }
        else false;
}

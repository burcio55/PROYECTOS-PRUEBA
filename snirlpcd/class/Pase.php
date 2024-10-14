<?php

/*CREATE TABLE Pase (
  nPase BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  sUsuario VARCHAR(20) NOT NULL,
  sRegistrador VARCHAR(45) NOT NULL,
  sPase VARCHAR(45) NOT NULL,
  nServicio INT(10) UNSIGNED NOT NULL DEFAULT 0,
  sUnidadSustantiva VARCHAR(6) NOT NULL,
  nPaseRef BIGINT(20) UNSIGNED NULL,
  dLlegada DATETIME NULL,
  dSalida DATETIME NULL,
  dInicioAtender DATETIME NULL,
  dFinalAtender DATETIME NULL,
  nStatus INT(10) NOT NULL DEFAULT 0,
  nLlamar TINYINT(4) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(nPase)
);
*/

class Pase
{
	var $nPase;
	var $sUsuario;
	var $sRegistrador;
	var $sPase;
	var $nServicio;
	var $sUnidadSustantiva;
	var $nPaseRef;
	var $dLlegada;
	var $dSalida;
	var $dInicioAtender;
	var $dFinalAtender;
	var $nStatus;
	var $nLlamar;
	
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET	
	
	function IsExist($sPase, &$DB)
	{
		$self->sSQL = "select COUNT(*) from pase where sPase = '".$sPase."'";
		
		$value = $DB->resultScalar($self->sSQL);
		
		if($value !=0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function IsEnabled($sPase, &$DB, $sUnidadSustantiva)
	{
		$self->sSQL = "select COUNT(*) from pase where sPase = '".$sPase.
		"' AND dSalida = 0 AND sUnidadSustantiva='".$sUnidadSustantiva."'";
		
		$value = $DB->resultScalar($self->sSQL);
		
		if($value !=0)
		{
			return true;
		}else{
			return false;
		}
	}
	
}

?>
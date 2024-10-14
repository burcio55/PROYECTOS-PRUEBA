<?php
include_once('Opcion.php');

class Opciones
{
	var $Opciones = null;
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET
		
	function Opciones($nOpciones, &$DB)
	{
		$this->Opciones = array();
		$this->Gestion = $DB;
		$this->Find($nOpciones);
	}
	function Find($nOpciones)
	{
		$this->sSQL  = "";
		$this->sSQL  = "select nOpcion,sDenominacion,sUrl,
							   sParams,nOpcionRef,sMenu,
							   dOpcion,nOrden,COALESCE(sUrlHelp,'') AS sUrlHelp,
							   sToolTip,sTarget,COALESCE(sOnClick,'') AS sOnClick ";
		$this->sSQL .= "from opcion ";
		$this->sSQL .= "where nOpcion IN (".join(",",$nOpciones).") and sEnabled = '1' order by nOpcionRef,nOrden";
		
		$this->rs = $this->Gestion->result($this->sSQL);
		
		while ($row = mysql_fetch_array($this->rs))
		{   
			$this->Opciones[] = new Opcion($row['sDenominacion'],$row['sUrl'],$row['sParams'],
										   $row['nOpcionRef'],$row['sMenu'],$row['dOpcion'],
										   $row['nOrden'],$row['sUrlHelp'],$row['sToolTip'],
										   $row['sTarget'],$row['sOnClick'],$row['nOpcion']);
		}
	}
	function &getOpcion($nIndex)
	{
		return $this->Opciones[$nIndex];
	}
	function getSize()
	{
		return count($this->Opciones);
	}
}

?>
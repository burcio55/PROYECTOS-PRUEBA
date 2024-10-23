<?php
include_once('Opcion.php');

class Opciones
{
	var $aOpciones = null;
	var $conn; 	      //DATABASE-CONNECTION-REFERENCE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		  //RESULSET
		
	function Opciones($nOpciones, &$conn)
	{
		$this->aOpciones = array();
		$this->conn = $conn;
		$this->Find($nOpciones);
	}
	
	function Find($nOpciones)
	{
		$sSQL  = "";
		$sSQL  = "SELECT nOpcion,sDenominacion,sUrl,
						 sParams,nOpcionRef,sMenu,
						 dOpcion,nOrden,ifnull(sUrlHelp,'') AS sUrlHelp,
						 sToolTip,sTarget,ifnull(sOnClick,'') AS sOnClick ";
		$sSQL .= "FROM opcion ";
		$sSQL .= "WHERE nOpcion IN (".join(",",$nOpciones).") AND sEnabled = '1' ORDER BY nOpcionRef, nOrden";
		
		$rs = &$this->conn->Execute($sSQL);
		
		include_once('class/Opcion.php');
		
		while(!$rs->EOF)
		{   
			$this->aOpciones[] = new Opcion($rs->fields['sDenominacion'],$rs->fields['sUrl'],$rs->fields['sParams'],
										    $rs->fields['nOpcionRef'],$rs->fields['sMenu'],$rs->fields['dOpcion'],
										    $rs->fields['nOrden'],$rs->fields['sUrlHelp'],$rs->fields['sToolTip'],
										    $rs->fields['sTarget'],$rs->fields['sOnClick'],$rs->fields['nOpcion']);
			$rs->MoveNext();
		}
	}
	
	function &getOpcion($nIndex)
	{
		return $this->aOpciones[$nIndex];
	}
	
	function getSize()
	{
		return count($this->aOpciones);
	}
}

?>
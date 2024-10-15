<?php
/*
CREATE TABLE Auditoria (
  nAuditoria INT NOT NULL AUTO_INCREMENT,
  sTabla VARCHAR(30) NOT NULL,
  sColumnName VARCHAR(30) NOT NULL,
  nValue INT NOT NULL,
  sLog VARCHAR(255) NOT NULL,
  sObservacion VARCHAR(255) NULL,
  sUsuario VARCHAR(20) NOT NULL,
  dAuditoria DATETIME NOT NULL,
  PRIMARY KEY(nAuditoria)
);*/
class Auditoria{
	var $nAuditoria;
	var $sTabla;
	var $sColumnName;
	var $nValue;
	var $sLog;
	var $sObservacion;
	var $sUsuario;
	var $dAuditoria;
	//DATABASE-MANAGMENT
	var $db; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
		
	function Auditoria(&$db,$sTabla,$sColumnName,$nValue,$sLog,$sObservacion,$sUsuario)
	{
		$this->db 			= $db;
		$this->sTabla 		= $sTabla;
		$this->sColumnName 	= $sColumnName;
		$this->nValue 		= $nValue;
		$this->sLog 		= $sLog;
		$this->sObservacion = $sObservacion;
		$this->sUsuario 	= $sUsuario;
		$this->dAuditoria 	= date("Y-m-d H:i:s");;
		$this->Add();
	}
	function Add()
	{
		//$nAuditoria = IsExist($this->sTabla,$this->sColumnName,$this->nValue);
		$this->sSQL = '';
		//if ($nAuditoria == 0)
		//{
		$this->sSQL = "insert into auditoria(sTabla,sColumnName,nValue,sLog,sObservacion,sUsuario,dAuditoria) 
					 values ('".$this->sTabla."','".$this->sColumnName."',".$this->nValue.",'.- ".$this->sLog."','.- ".$this->sObservacion."','".$this->sUsuario."','".$this->dAuditoria."')";	
		//}else{
		//	$sSQL = "update auditoria set sLog = '".$this->getLog($sTabla,$sColumnName,$nValue)."|.- ".$this->sLog."',sObservacion = '".$this->getObservacion($sTabla,$sColumnName,$nValue)."' 
		//					where nAuditoria = ".$nAuditoria;
		//}
		//if ($sSQL != '')
		//{
		$this->Query();
		//}
	}
	function IsExist($sTabla, $sColumnName, $nValue, &$db=null)
	{
		$nAuditoria = 0;
		$self->sSQL = "select nAuditoria from auditoria "
					 ."where sTabla = '".$sTabla."' AND sColumnName = '".$sColumnName."' AND nValue = ".$nValue;
		if ($db==null) {
			$nAuditoria = $this->db->resultScalar($self->sSQL);
		}else{
			$nAuditoria = $db->resultScalar($self->sSQL);
		}
		return $nAuditoria;
	}
	function getLog($sTabla, $sColumnName, $nValue, $bWithDelimiter=false, &$db=null)
	{
		$sLog = '';
		$self->sSQL = "select sLog from auditoria "
					 ."where sTabla = '".$sTabla."' AND sColumnName = '".$sColumnName."' AND nValue = ".$nValue;
		if ($db==null) {
			$sLog = $this->db->resultScalar($self->sSQL);
		}else{
			$sLog = $db->resultScalar($self->sSQL);
		}
		if (!$bWithDelimiter){
			$sLog = str_replace("|","\n",$sLog);
		}
		return $sLog;
	}
	function getObservacion($sTabla, $sColumnName, $nValue, &$db=null)
	{
		$sObservacion = '';
		$self->sSQL = "select sObservacion from auditoria "
					 ."where sTabla = '".$sTabla."' AND sColumnName = '".$sColumnName."' AND nValue = ".$nValue;
		if ($db==null) {
			$sObservacion = $this->db->resultScalar($self->sSQL);
		}else{
			$sObservacion = $db->resultScalar($self->sSQL);
		}
		return $sObservacion;
	}	
	function Query()
	{
		$this->rowAffected = $this->db->query($this->sSQL);
		if ($this->rowAffected != 0) {
			return true;
		}else{
			return false;
		}			
	}		
}
?>
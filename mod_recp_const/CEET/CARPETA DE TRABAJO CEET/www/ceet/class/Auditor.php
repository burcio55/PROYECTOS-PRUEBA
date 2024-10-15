<?php

class Auditor{
	function FindLastRow(&$DB, $sTableName)
	{
		$nRow		= 0;
		$this->sSQL = "select nRegistro from ".$sTableName." order by nRegistro DESC LIMIT 1";
		$nRow 		= $DB->resultScalar($this->sSQL);
		return $nRow+1;
	}
	
	function DisplaySql($sSQL)
	{
		print '<br>'.$sSQL.'</br>';
	}
}

/*
* CREATE TABLE control (
  nControl INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  sUnidadSustantiva VARCHAR(6) NULL,
  sColumnName VARCHAR(30) NOT NULL,
  sAno VARCHAR(4) NULL,
  nValue INTEGER UNSIGNED NULL,
  sEnabled CHAR(1) NULL,
  PRIMARY KEY(nControl)
);
*/

class control{
	var $sColumnName;
	var $sUnidadSustantiva;
	var $sAno = '';
	var $nValue;
	var $sEnabled = 0;
	var $nTimeLimit = 1000;
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	
	function control(&$DB,$sColumnName,$sUnidadSustantiva,$nValue,$sAno =''){
		$this->sColumnName 	= $sColumnName;
		$this->sUnidadSustantiva = $sUnidadSustantiva;
		$this->nValue		= $nValue;
		$this->sAno			= $sAno;
		$this->sEnabled		= '1';
		$this->Gestion		= $DB;
	}
	
	function Add(){
		$this->sSQL	= "insert into control(sColumnName, sUnidadSustantiva, nValue, sAno, sEnabled) values ("
					  ."'".$this->sColumnName."','".$this->sUnidadSustantiva."',".$this->nValue.",'"
					  .$this->sAno."','".$this->sEnabled."')";
		$this->Query();
	}
	
	function IsExist($sUnidadSustantiva, $sColumnName, $sAno = '',&$DB = null){
		$nControl = 0;
		$self->sSQL = "select nControl from control "
					 ."where sColumnName = '".$sColumnName."' AND sUnidadSustantiva = '".$sUnidadSustantiva."'";
		if ($sAno != '') {
			$self->sSQL .= " AND sAno = '".$sAno."'";
		}
		if ($DB==null) {
			$nControl = $this->Gestion->resultScalar($self->sSQL);
		}else{
			$nControl = $DB->resultScalar($self->sSQL);
		}
		return $nControl;
	}
	
	function getEnabled($nControl,&$DB = null){
		$sEnabled = '0';
		$self->sSQL = "select sEnabled from control "
					 ."where nControl = ".$nControl;
		if ($DB==null) {
			$sEnabled = $this->Gestion->resultScalar($self->sSQL);
		}else{
			$sEnabled = $DB->resultScalar($self->sSQL);
		}
		if ($sEnabled != '0') {
			return true;
		}else{
			return false;
		}
	}
	
	function setEnabled($sEnabled='1', $nControl,&$DB = null){
		$self->sSQL = "update control set sEnabled = '".$sEnabled."' where nControl = ".$nControl;
		if ($DB==null) {
			return $this->Query($self->sSQL);
		}else{
			return $DB->Query($self->sSQL);
		}
	}
	
	function setValue($nValue, $nControl,&$DB = null){
		$self->sSQL = "update control set nValue = '".$nValue."' where nControl = ".$nControl;
		if ($DB==null) {
			return $this->Query($self->sSQL);
		}else{
			return $DB->Query($self->sSQL);
		}
	}
	
	function getValue($nControl,&$DB = null){
		$nValue = 0;
		$self->sSQL = "select nValue from control "
					 ."where nControl = ".$nControl;
		if ($DB==null) {
			$nValue = $this->Gestion->resultScalar($self->sSQL);
		}else{
			$nValue = $DB->resultScalar($self->sSQL);
		}
		return $nValue;		
	}
	function getTimeLimit()
	{
		return $self->ntimeLimit;
	}
	function getControlByYear($sColumnName,$sUnidadSustantiva,&$DB)
	{
		$dFecha = getdate(date('U'));
		$nControlValue = 0;
		$nControl = control::IsExist($sUnidadSustantiva,$sColumnName,$dFecha['year'],$DB);

		if ($nControl == 0) {
			$oControl = new control($DB,$sColumnName,$sUnidadSustantiva,1,$dFecha['year']);
			$oControl->Add();
			$nControlValue = 1;
		}else{
			if (Control::getEnabled($nControl,$DB)) {
				Control::setEnabled('0',$nControl,$DB);
				$nControlValue = control::getValue($nControl,$DB)+1;
				Control::setValue($nControlValue,$nControl,$DB);
				Control::setEnabled('1',$nControl,$DB);
			}else{
				$nTime = control::getTimeLimit();
				$nTimePassed = 0;
				while($nTimePassed <= $nTime){
					if (Control::getEnabled($nControl,$DB)) {
						Control::setEnabled('0',$nControl,$DB);
						$nControlValue = control::getValue($nControl,$DB)+1;
						Control::setValue($nControlValue,$nControl,$DB);
						Control::setEnabled('1',$nControl,$DB);
					}
					$nTimePassed++;
				} 
			}
		}
		return $nControlValue;
	}
	function Query()
	{
		$this->rowAffected = $this->Gestion->Query($this->sSQL);
		if ($this->rowAffected != 0) {
			return true;
		}else{
			return false;
		}			
	}	
}
?>
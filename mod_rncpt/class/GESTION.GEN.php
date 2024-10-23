<?php
include_once('Auditor.php');
/*
CREATE TABLE fuero (
  nFuero TINYINT(3) UNSIGNED NOT NULL,
  sDenominacion VARCHAR(150) NOT NULL,
  sLimits VARCHAR(255) NULL,
  PRIMARY KEY(nFuero)
);
*/
class Fuero
{
	//TABLE-FIELDS
	var $nFuero;
	var $sDenominacion;
	var $sLimits;
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET
	
	function getName($nFuero, &$DB=null){
		$sName = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sDenominacion ";
		$self->sSQL .= "from fuero ";
		$self->sSQL .= "where nFuero = '".$nFuero."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sName = $row[0];
		}
		return $sName;
	}
	function InLimits($nFuero, $nValue, &$DB=null){
		$Limits = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sLimits ";
		$self->sSQL .= "from fuero ";
		$self->sSQL .= "where nFuero = '".$nFuero."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$self->sLimits = $row[0];
			if ($self->sLimits != '0') {
			    $Limits = split(',',$self->sLimits);
				for ($i=0;$i<count($Limits);$i++)
				{
					if ($Limits[$i] == $nValue) {
						return true;
					}
				}
			}else{
				return true;
			}
		}
		return false;	
	}
	function getLimits($nFuero, &$DB=null){
		$self->sSQL  = "";
		$self->sSQL  = "select sLimits ";
		$self->sSQL .= "from fuero ";
		$self->sSQL .= "where nFuero = '".$nFuero."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$self->sLimits = $row[0];
			return $self->sLimits;
		}
	}
}

/*
CREATE TABLE `tiporemuneracion` (
  `nTipoRemuneracion` tinyint(3) unsigned NOT NULL auto_increment,
  `sDenominacion` varchar(150) NOT NULL default '',
  PRIMARY KEY  (`nTipoRemuneracion`)
)
*/
class Tiporemuneracion
{
	//TABLE-FIELDS
	var $nTiporemuneracion;
	var $sDenominacion;

	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET
	
	function getName($nTiporemuneracion, &$DB=null){
		$sName = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sDenominacion ";
		$self->sSQL .= "from tiporemuneracion ";
		$self->sSQL .= "where nTiporemuneracion = '".$nTiporemuneracion."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sName = $row[0];
		}
		return $sName;
	}
}

/*
CREATE TABLE unidadsustantiva (
  sUnidadSustantiva VARCHAR(6) NOT NULL,
  nTipoUnidadSustantiva TINYINT(3) UNSIGNED NOT NULL,
  sDenominacion VARCHAR(150) NOT NULL,
  nUnidadSustantiva INTEGER UNSIGNED NULL,
  PRIMARY KEY(sUnidadSustantiva)
);
*/
class UnidadSustantiva
{
	//TABLE-FIELDS
	var $sUnidadSustantiva;
	var $sDenominacion;
	var $nUnidadSustantiva;
	var $nTipoUnidadSustantiva;

	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET	
	
	
	/* Devuelve el código externo de la unidad sustantiva */
	function getUnidadSustantiva($sUnidadSustantiva,&$DB = null){
		$nUnidadSustantiva = '';
		$self->sSQL  = "";
		$self->sSQL  = "select nUnidadSustantiva ";
		$self->sSQL .= "from unidadsustantiva ";
		$self->sSQL .= "where sUnidadSustantiva = '".$sUnidadSustantiva."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$nUnidadSustantiva = $row[0];
		}
		return str_pad($nUnidadSustantiva,3,'0',STR_PAD_LEFT);		
	}
	
	function getDenominacion($sUnidadSustantiva,&$DB = null){
		$sDenominacion = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sDenominacion ";
		$self->sSQL .= "from unidadsustantiva ";
		$self->sSQL .= "where sUnidadSustantiva = '".$sUnidadSustantiva."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sDenominacion = $row[0];
		}
		return $sDenominacion;		
	}	

	function getEnteDenominacion($sUnidadSustantiva,&$DB = null){
		$sDenominacion = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sContratante ";
		$self->sSQL .= "from solvencia_contratante_solicitud ";
		$self->sSQL .= "where nContratante = '".$sUnidadSustantiva."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sDenominacion = $row[0];
		}
		return $sDenominacion;		
	}	
}

/*
CREATE TABLE faseservicio (
  nFase TINYINT(3) UNSIGNED NOT NULL,
  nServicio TINYINT(3) UNSIGNED NOT NULL,
  nOrden TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY(nFase, nServicio)
);
*/
class FaseServicio
{
	//TABLE-FIELDS
	var $nFase;
	var $nServicio;
	var $nUnidadSustantiva;
	var $nOrden;

	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET		
	
	/* Devuelve las fases por servicio */
	function getFases($nServicio, &$DB = null){
		$rows = array();
		$self->sSQL  = "";
		$self->sSQL  = "select fase.nFase, 
							   fase.sDenominacion 
						from faseservicio 
						inner join fase on 
						faseservicio.nFase = fase.nFase 
						where faseservicio.nServicio = ".$nServicio." 
						AND faseservicio.nOrden != 0";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$rows[$row[0]] = $row[1];
		}
		return $rows;	
	}
	
	/* Devuelve la siguiente fase de un servicio dado una fase */
	function getNextFase($nServicio,$nFase,&$DB = null){
		$nNextFase = '';
		$self->sSQL  = "";
		$self->sSQL  = "select nFase 
						from faseservicio 
						where nServicio = ".$nServicio." 
						AND nFase > ".$nFase." 
						AND nOrden != 0 
						order by nOrden LIMIT 1";
			
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$nNextFase = $row[0];
		}
		return $nNextFase;		
	}
	
	/* Devuelve un rango de fases especifico de un servicio*/
	function getRangeFases($nServicio,$nFases,&$DB=null){
		$rows = array();
		$self->sSQL  = "";
		$self->sSQL  = "select fase.nFase, 
							   fase.sDenominacion 
						from faseservicio 
						inner join fase on 
						faseservicio.nFase = fase.nFase 
						where faseservicio.nServicio = ".$nServicio." 
						AND faseservicio.nFase IN (".join(",",$nFases).")";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$rows[$row[0]] = $row[1];
		}
		return $rows;	
	}
}

class Fase
{
	function getDenominacion($nFase,&$DB=null)
	{
		$sDenominacion = "";
		$sSQL = "select sDenominacion from fase where nFase=".$nFase;
		$rs = $DB->result($sSQL);
		$row = mysql_fetch_array($rs);
		$sDenominacion = $row['sDenominacion'];
		return $sDenominacion;
	}
}
?>
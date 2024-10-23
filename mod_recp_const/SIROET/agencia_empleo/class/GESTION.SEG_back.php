<?php
/*
CREATE TABLE sesion (
  sUsuario VARCHAR(20) NOT NULL,
  sUnidadSustantiva VARCHAR(6) NOT NULL,
  sClave VARCHAR(20) NOT NULL,
  nRegistro INTEGER(10) UNSIGNED NOT NULL,
  nStatus INTEGER(10) UNSIGNED NOT NULL,
  PRIMARY KEY(nRol, sUsuario)
);
*/

//TABLE-CLASS: Sesion
class Sesion
{
	//TABLE-FIELDS
	var $sUsuario;
	var $sClave;
	var $sUnidadSustantiva;
	var $sEnabled;
	var $nRegistro;

	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED	
		
	function IsExist($sUsuario,$sClave,&$DB=null){
		$rows = 0;
		$self->sSQL  = "";
		$self->sSQL  = "select COUNT(*) ";
		$self->sSQL .= "from sesion ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."'"
					   ." AND sClave = '".crypt($sClave,$sUsuario)."'";
		
		if ($DB==null) {
			$rows = $this->Gestion->resultScalar($self->sSQL);
		}else{
			$rows = $DB->resultScalar($self->sSQL);
		}
		
		if ($rows!=0) {
			return true;
		}else{
			return false;
		}	
	}
	
	function getUnidadSustantiva($sUsuario,$sClave,&$DB=null){
		$sUnidadSustantiva = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sUnidadSustantiva ";
		$self->sSQL .= "from sesion ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."'"
					   ." AND sClave = '".$sClave."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sUnidadSustantiva = $row[0];
		}
		return $sUnidadSustantiva;		
	}
	function IsExistUsuario($sUsuario,&$DB=null){
		$rows = 0;
		$self->sSQL  = "";
		$self->sSQL  = "select COUNT(*) ";
		$self->sSQL .= "from sesion ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."'";		
		if ($DB==null) {
			$rows = $this->Gestion->resultScalar($self->sSQL);
		}else{
			$rows = $DB->resultScalar($self->sSQL);
		}		
		if ($rows!=0) {
			return true;
		}else{
			return false;
		}	
	}
	function GetPassword($sUsuario,&$DB=null){
		$sClave = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sClave ";
		$self->sSQL .= "from sesion ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."'";		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sClave = $row[0];
		}
		return $sClave;		

	}
	function IsEnabled($sUsuario,$sClave,&$DB=null){
		$nEnabled = 2;
		$sSQL = "select * from sesion where sUsuario = '".$sUsuario."' and sClave = '".crypt($sClave,$sUsuario)."'";
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($sSQL);
		}
		if (mysql_num_rows($self->rs) > 0){
			$row = mysql_fetch_array($self->rs);
			if ($row['sEnabled'] == '1'){
				$nEnabled = 1;
			}else{
				$nEnabled = 0;
			}
		}
		
		return $nEnabled;
	}
	
}


/*CREATE TABLE usuario (
  sUsuario VARCHAR(20) NOT NULL,
  sNombre VARCHAR(255) NOT NULL,
  sApellido VARCHAR(255) NOT NULL,
  sTelefono VARCHAR(50) NULL,
  sLateralidad CHAR(1) NULL DEFAULT 'D',
  nTipoDocumento INTEGER UNSIGNED NOT NULL,
  nNacionalidad INTEGER UNSIGNED NOT NULL,
  nSexo TINYINT(3) UNSIGNED NOT NULL,
  nRegistro INTEGER(11) NOT NULL,
  PRIMARY KEY(sUsuario)
);
*/
//TABLE-CLASS: Sesion
class Usuario
{
	//TABLE-FIELDS
	var $sUsuario;
	var $sNombre;
	var $sApellido;
	var $sTelefono;
	var $sLateralidad;
	var $nTipoDocumento;
	var $nNacionalidad;
	var $nSexo;
	var $nRegistro;

	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET
	
	function getName($sUsuario, &$DB=null){
		$sName = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sNombre, sApellido ";
		$self->sSQL .= "from usuario ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sName = $row[1].', '.$row[0];
		}
		return $sName;
	}
	
	function getRoles($sUsuario, &$DB=null)
	{
		$nRoles = array();
		$self->sSQL  = "";
		$self->sSQL  = "select nRol ";
		$self->sSQL .= "from usuariorol ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."' and sEnabled = '1'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$nRoles[] = $row[0];
		}
		return $nRoles;
	}
	
	function getOpciones($sUsuario, &$DB=null)
	{
		$nOpciones = array();
		$self->sSQL  = "";
		$self->sSQL  = "select nOpcion ";
		$self->sSQL .= "from usuarioopcion ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."' and sEnabled = '1'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$nOpciones[] = $row[0];
		}
		return $nOpciones;	
	}
	function IsExistCedula($sUsuario,&$DB=null){
		$rows = 0;
		$self->sSQL  = "";
		$self->sSQL  = "select count(sUsuario) ";
		$self->sSQL .= "from usuario ";
		$self->sSQL .= "where sUsuario = '".$sUsuario."'";					   
		
		if ($DB==null) {
			$rows = $this->Gestion->resultScalar($self->sSQL);
		}else{
			$rows = $DB->resultScalar($self->sSQL);
		}
		
		if ($rows!=0) {
			return true;
		}else{
			return false;
		}	
	}	
}

/*CREATE TABLE rol (
  nRol TINYINT(3) UNSIGNED NOT NULL,
  sDenominacion VARCHAR(250) NOT NULL,
  PRIMARY KEY(nRol)
);
*/
class Rol
{
	var $nRol;
	var $sDenominacion;
  
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET
  
	function getNombreRol($nRoles, &$DB=null)
	{
		$sDenominaciones = array();
		$self->sSQL  = "";
		$self->sSQL  = "select sDenominacion ";
		$self->sSQL .= "from rol ";
		$self->sSQL .= "where nRol IN (".join(",",$nRoles).")";

		if (!$DB==null)	$rs = $DB->Execute($self->sSQL);
		
		while(!$rs->EOF)		
		{
			$sDenominaciones[] = $rs->fields['sDenominacion'];
			$rs->MoveNext();
		}

		return $sDenominaciones;	
	}
	
	function getDenominacion($nRoles, &$DB=null)
	{
		$sDenominaciones = array();
		$self->sSQL  = "";
		$self->sSQL  = "select sDenominacion ";
		$self->sSQL .= "from rol ";
		$self->sSQL .= "where nRol IN (".join(",",$nRoles).")";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sDenominaciones[] = $row[0];
		}
		return $sDenominaciones;	
	}
	
	function getOpciones($nRoles, &$DB=null)
	{
		$nOpciones = array();
		$self->sSQL  = "";
		$self->sSQL  = "select nOpcion ";
		$self->sSQL .= "from rolopcion ";
		$self->sSQL .= "where nRol IN (".join(",",$nRoles).") and sEnabled = '1'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		while ($row = mysql_fetch_array($self->rs))
		{   
			$nOpciones[] = $row[0];
		}
		return $nOpciones;	
	}
}


?>
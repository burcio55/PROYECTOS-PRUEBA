<?php
include_once('Auditor.php');
/*
CREATE TABLE preempresa (
  nEmpresa INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nTipoPersona TINYINT UNSIGNED NOT NULL,
  sRif CHAR(11) NULL,
  sNit CHAR(12) NULL,
  sCorporacion VARCHAR(150) NULL,
  dFundacion DATE NULL,
  nCapitalPagado DOUBLE(15,3) NULL,
  nRegistro INTEGER(10) UNSIGNED NULL,
  PRIMARY KEY(nEmpresa)
);
*/

class PreEmpresa
{
	//TABLE-FIELDS
	var $nEmpresa;
	var $nTipoPersona;
	var $sRif;
	var $sNit;
	var $sCorporacion;
	var $dFundacion;
	var $nCapitalPagado;
	var $nRegistro;
	var $sEnabled = '0';
	var $PreEstablecimientos = array();
	var $nCurrentItem = -1;
	
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET
	
	function PreEmpresa(&$DB,$nTipoPersona,$Rif='0',$sNit='0',
						$sCorporacion='',$dFundacion='',$nCapitalPagado = 0){
						
		$this->nTipoPersona 	= $nTipoPersona;
		$this->sRif 			= strtoupper(trim($Rif));
		$this->sNit				= strtoupper(trim($sNit));
		$this->sCorporacion		= strtoupper(trim($sCorporacion));
		$this->dFundacion		= $dFundacion;
		$this->nCapitalPagado	= $nCapitalPagado;
		$this->Gestion 			= $DB;
	}
	
	function Add()
	{
		$this->nRegistro = Auditor::FindLastRow($this->Gestion,'preempresa');
		
		$this->sSQL  = "";
		$this->sSQL  = "insert into preempresa ";
		$this->sSQL .= "(nTipoPersona, sRif, sNit, sCorporacion, dFundacion, nCapitalPagado, sEnabled, nRegistro) ";
		$this->sSQL .= "values(";
		$this->sSQL .= $this->nTipoPersona.",'".$this->sRif."','".$this->sNit."','"
					  .$this->sCorporacion."','".$this->dFundacion."',".$this->nCapitalPagado.",'"
					  .$this->sEnabled."',".$this->nRegistro.")";
		
		$bQuery = $this->Query();		
		
		$this->nEmpresa = $this->FindLastEmpresa();
		
		return $bQuery;
	}
	
	function Edit()
	{
		$this->sSQL  = "";
		$this->sSQL  = "update preempresa ";
		$this->sSQL .= "SET nTipoPersona = '".$this->nTipoPersona."',sRif = '".$this->sRif."',sNit = '".$this->sNit;
		$this->sSQL .= "',sCorporacion = '".$this->sCorporacion."',dFundacion = '".$this->dFundacion;
		$this->sSQL .= "',nCapitalPagado = ".$this->nCapitalPagado;
		$this->sSQL .= " where nEmpresa = " .$this->nEmpresa;
		
		return $this->Query();
	}
	
	/* Agrega un objeto 'PreEstablecimiento' a la coleccion */
	/* Devuelve la referencia del nuevo objeto agregado */
	function AddEstablecimiento($dInicioActividad = '',$sIvss = '',
								$sTelefono = '',$sFax = '',$sEmail = '',$dInscripcion = '',
								$sObservacion = '',$sDireccion = '',$sSiglas = '',
								$nMontoFacturacion = 0,$sDenominacionActEcon = '',$nPersonalActivo = 0,
								$sDenominacion = '')
	{
		/* Crea el objeto y lo agrega a la coleccion */
		$this->PreEstablecimientos[] = new PreEstablecimiento($this->Gestion, $this->nEmpresa, $dInicioActividad, strtoupper(trim($sIvss)),
															  strtoupper(trim($sTelefono)), strtoupper(trim($sFax)), strtoupper(trim($sEmail)),
															  $dInscripcion, strtoupper(trim($sObservacion)), strtoupper(trim($sDireccion)),
															  strtoupper(trim($sSiglas)), $nMontoFacturacion, strtoupper(trim($sDenominacionActEcon)),
															  $nPersonalActivo, strtoupper(trim($sDenominacion)));
		/* Agrega los datos del nuevo objeto en la base de datos */
		$this->PreEstablecimientos[$this->GetCount()-1]->Add();

		/* Establece el nuevo objeto como elemento a actual de trabajo*/
		$this->SetCurrentItem($this->GetCount()-1);
		
		/* Devuelve la referencia del nuevo objeto creado */
		return $this->PreEstablecimientos[$this->GetCount()-1];
	}
	function getEmpresa()
	{
		return $this->nEmpresa;
	}	
	function getDenominacion()
	{
		return $this->PreEstablecimientos[0]->sDenominacion;
	}
	function &getEstablecimiento($nEstablecimiento)
	{
		if ($nEstablecimiento < count($this->PreEstablecimientos)) {
			return $this->PreEstablecimientos[$nEstablecimiento];
		}else{
			return null;
		}
	}
	/* Habilita los datos de la clase en la base de datos */
	function setEnabled()
	{	
		/* Habilita el solicitud en la clase */
		$this->sEnabled = '1';
		/* Habilita el solicitud en la base de datos */
		$this->sSQL  = "";
		$this->sSQL  = "update preempresa ";
		$this->sSQL .= "SET sEnabled = '".$this->sEnabled."'";
		$this->sSQL .= "where nEmpresa = " .$this->nEmpresa;
					  
		$this->Query();
	}
	
	function FindLastEmpresa()
	{
		$nRow		= 0;
		$this->sSQL  = "";
		$this->sSQL = "select nEmpresa from preempresa order by nEmpresa DESC LIMIT 1";
		$nRow 		= $this->Gestion->resultScalar($this->sSQL);
		return $nRow;
	}

	/* Devuelve la posicion actual dentro de la coleccion */
	function GetCurrentItem()
	{
		return $this->nCurrentItem;
	}
	/* Asigna la posicion actual dentro de la coleccion */
	function SetCurrentItem($nCurrentItem)
	{
		$this->nCurrentItem = $nCurrentItem;
	}
	/* Devuelve la logitud de la coleccion */
	function GetCount()
	{
		return count($this->PreEstablecimientos);	
	}
	/* Devuelve un arreglo con las empresas que coincidieron con la palabra a buscar*/
	function getEmpresas($sFirstLetter,&$db)
	{
		$aEmpresa = array();
		if ($sFirstLetter != ''){
			$sSQL = "select preempresa.nEmpresa, preempresa.sRif, preestablecimiento.sDireccion, preestablecimiento.sDenominacion from preestablecimiento inner join preempresa on preestablecimiento.nEmpresa = preempresa.nEmpresa where sDenominacion like '".strtoupper($sFirstLetter)."%' and nEstablecimiento = 0 order by sDenominacion";
		}else{
			$sSQL = "select preempresa.nEmpresa, preempresa.sRif, preestablecimiento.sDireccion, preestablecimiento.sDenominacion from preestablecimiento inner join preempresa on preestablecimiento.nEmpresa = preempresa.nEmpresa where nEstablecimiento = 0 order by sDenominacion";
		}
		$rs = $db->result($sSQL);
		while ($row = mysql_fetch_array($rs))
		{   
			$aEmpresa[] = array();
			$aEmpresa[count($aEmpresa)-1]['nEmpresa'] = htmlentities($row['nEmpresa']);			
			$aEmpresa[count($aEmpresa)-1]['sRif'] = htmlentities($row['sRif']);
			$sDireccion = str_replace(chr(10),' ',$row['sDireccion']);
			$sDireccion = str_replace(chr(13),' ',$sDireccion);
			$sDireccion = str_replace("\"",' ',$sDireccion);
			$aEmpresa[count($aEmpresa)-1]['sDireccion'] = $sDireccion;
			$sDenominacion = str_replace(chr(10),' ',$row['sDenominacion']);
			$sDenominacion = str_replace(chr(13),' ',$sDenominacion);
			$sDenominacion = str_replace("\"",' ',$sDenominacion);			
			$aEmpresa[count($aEmpresa)-1]['sDenominacion'] = $sDenominacion;
		}	
		return $aEmpresa;
	}
	
	/* Devuelve el codigo de la empresa si existe en la base de datos sino devuelve cero */
	function IsExist($sEmpresa,$sDireccion='',&$db)
	{
		$nEmpresa = 0;
		$sSQL = "select nEmpresa from preestablecimiento where nEstablecimiento = 0 and sDenominacion like '".strtoupper(trim($sEmpresa))."'";
		if ($sDireccion){
			$sSQL .= " and sDireccion = '".strtoupper(trim($sDireccion))."'";	
		}
		$rs = $db->result($sSQL);
		if (mysql_num_rows($rs) > 0){
			$row = mysql_fetch_array($rs);
			$nEmpresa = $row['nEmpresa'];
		}
		return $nEmpresa;
	}
	function find($nEmpresa,&$db){
		$oEmpresa = null;
		$sSQL = "select preempresa.nEmpresa as id, preempresa.nTipoPersona, preestablecimiento.* from preestablecimiento inner join preempresa where preestablecimiento.nEmpresa = ".$nEmpresa." and nEstablecimiento = 0";
		$rs = $db->result($sSQL);
		if (mysql_num_rows($rs) > 0){
			$row = mysql_fetch_array($rs);
			$oEmpresa = $row;
		}	
		return $oEmpresa;	
	}
	function Query()
	{
		$this->rowAffected = $this->Gestion->query($this->sSQL);
		if ($this->rowAffected != 0) {
			return true;
		}else{
			return false;
		}			
	}
}

/*
CREATE TABLE preestablecimiento (
  nEstablecimiento SMALLINT UNSIGNED NOT NULL,
  nEmpresa INTEGER UNSIGNED NOT NULL,
  dInicioActividad DATE NULL,
  sIvss VARCHAR(20) NULL,
  sTelefono VARCHAR(20) NULL,
  sFax VARCHAR(20) NULL,
  sEmail VARCHAR(35) NULL,
  dInscripcion DATE NULL,
  sObservacion VARCHAR(255) NULL,
  sDireccion VARCHAR(255) NULL,
  sSiglas VARCHAR(50) NULL,
  nMontoFacturacion DOUBLE(15,3) NULL,
  sDenominacionActEcon VARCHAR(255) NULL,
  nPersonalActivo INTEGER UNSIGNED NULL,
  sDenominacion VARCHAR(255) NULL,
  nRegistro INTEGER UNSIGNED NULL,
  PRIMARY KEY(nEstablecimiento, nEmpresa)
); 
*/

class PreEstablecimiento
{
	//TABLE-FIELDS
	var $nEmpresa;
	var $nEstablecimiento = 0;
	var $dInicioActividad;
	var $sIvss;
	var $sTelefono;
	var $sFax;
	var $sEmail;
	var $dInscripcion;
	var $sObservacion;
	var $sDireccion;	
	var $sSiglas;	
	var $nMontoFacturacion;
	var $sDenominacionActEcon;
	var $nPersonalActivo;
	var $sDenominacion;		
	var $nRegistro;

	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	var $rs;		//RESULSET
	
	
	function PreEstablecimiento(&$DB,$nEmpresa, $dInicioActividad = '',$sIvss = '',
								$sTelefono = '',$sFax = '',$sEmail = '',$dInscripcion = '',
								$sObservacion = '',$sDireccion = '',$sSiglas = '',
								$nMontoFacturacion = 0,$sDenominacionActEcon = '',$nPersonalActivo = 0,
								$sDenominacion = '')
	{
		$this->nEmpresa 		= $nEmpresa;
		$this->dInicioActividad = $dInicioActividad;
		$this->sIvss			= $sIvss;
		$this->sTelefono 		= $sTelefono;
		$this->sFax 			= $sFax;
		$this->sEmail 			= $sEmail;
		$this->dInscripcion 	= $dInscripcion;
		$this->sObservacion 	= $sObservacion;
		$this->sDireccion 		= $sDireccion;	
		$this->sSiglas 			= $sSiglas;	
		$this->nMontoFacturacion = $nMontoFacturacion;
		$this->sDenominacionActEcon = $sDenominacionActEcon;
		$this->nPersonalActivo 	= $nPersonalActivo;
		$this->sDenominacion 	= $sDenominacion;
		$this->nRegistro 		= Auditor::FindLastRow($DB,'preestablecimiento');
		$this->Gestion			= $DB;
	}

	function Add()
	{
		$this->sSQL  = "";
		$this->sSQL  = "insert into preestablecimiento ";
		$this->sSQL .= "(nEmpresa, nEstablecimiento, dInicioActividad, sIvss, sTelefono, sFax";
		$this->sSQL .= ", sEmail, dInscripcion, sObservacion, sDireccion, sSiglas, nMontoFacturacion";
		$this->sSQL .= ", sDenominacionActEcon, nPersonalActivo, sDenominacion, nRegistro) ";
		$this->sSQL .= "values(";
		$this->sSQL .= $this->nEmpresa.",".$this->nEstablecimiento.",'".$this->dInicioActividad."','"
					  .$this->sIvss."','".$this->sTelefono."','".$this->sFax."','"
					  .$this->sEmail."','".$this->dInscripcion."','".$this->sObservacion."','"
					  .$this->sDireccion."','".$this->sSiglas."',".$this->nMontoFacturacion.",'"
					  .$this->sDenominacionActEcon."',".$this->nPersonalActivo.",'".$this->sDenominacion."',"
					  .$this->nRegistro.")";
		
		$bQuery = $this->Query();		
		
		return $bQuery;
	}	
	
	function Edit()
	{
		$this->sSQL  = "";
		$this->sSQL  = "update preestablecimiento ";
		$this->sSQL .= "SET dInicioActividad = '".$this->dInicioActividad."', sIvss = '".$this->sIvss."', sTelefono = '".$this->sTelefono."'";
		$this->sSQL .= ",sFax = '".$this->sFax."', sEmail = '".$this->sEmail."', dInscripcion = '".$this->dInscripcion."'";
		$this->sSQL .= ",sObservacion ='".$this->sObservacion."', sDireccion = '".$this->sDireccion."', sSiglas = '".$this->sSiglas."'";
		$this->sSQL .= ",nMontoFacturacion = ".$this->nMontoFacturacion.", sDenominacionActEcon = '".$this->sDenominacionActEcon."', nPersonalActivo = ".$this->nPersonalActivo;
		$this->sSQL .= ",sDenominacion = '".$this->sDenominacion."' ";
		$this->sSQL .= "where nEmpresa = ".$this->nEmpresa." AND nEstablecimiento = ".$this->nEstablecimiento;
		
		Auditor::DisplaySql($this->sSQL);
		
		return $this->Query();		
	}
	
	function Set_Establecimiento($nEstablecimiento)
	{
		if ($nEstablecimiento != 0) {
			$this->sSQL  = "";
			$this->sSQL = "select nEstablecimiento from preestablecimiento where nEmpresa=".$this->nEmpresa." order by nEstablecimiento DESC LIMIT 1";
			$this->nEstablecimiento	= $this->Gestion->resultScalar($this->sSQL);
		}
	}
	
	function Query()
	{
		$this->rowAffected = $this->Gestion->query($this->sSQL);
		if ($this->rowAffected != 0) {
			return true;
		}else{
			return false;
		}			
	}	
}
?>
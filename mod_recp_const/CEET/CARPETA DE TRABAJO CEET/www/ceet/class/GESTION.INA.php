<?php
include_once('Auditor.php');
include_once('GESTION.GEN.php');
/*
* CREATE TABLE solicitudinamovilidad (
  nSolicitudInamovilidad INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  sSolicitudInamovilidad VARCHAR(16) NULL,
  nSolicitud TINYINT(3) UNSIGNED NULL,
  nEmpresa INTEGER UNSIGNED NOT NULL,
  sUnidadSustantiva VARCHAR(6) NULL,
  dSolicitud DATETIME NOT NULL,
  sEnabled CHAR(1) NULL DEFAULT '0',
  sRegistrador VARCHAR(20) NULL,
  sAdmitido CHAR(1) NULL 
  DEFAULT 0,
  nRegistro INTEGER(10) UNSIGNED NOT NULL,
  nStatus TINYINT(3) UNSIGNED NULL,
  PRIMARY KEY(nSolicitudInamovilidad)
);
*/

class SolicitudInamovilidad
{
	var $nSolicitudInamovilidad; 
	var $sSolicitudInamovilidad;
	var $nSolicitud;
	var $nEmpresa = 0;
	var $sUnidadSustantiva;
	var $dSolicitud;
	var $sEnabled;
	var $sRegistrador;
	var $sAdmitido;
	var $nRegistro;
	var $nStatus;
	var $Trabajadores = '';
	var $DB;
	var $rowAffected;
	var $sSQL;
	
	function SolicitudInamovilidad( &$DB,$nSolicitud,$sUnidadSustantiva,
									$sRegistrador)
	{
		$this->DB 					= $DB;
		$this->nSolicitud 			= $nSolicitud;
		$this->sUnidadSustantiva 	= $sUnidadSustantiva;
		$this->dSolicitud			= date("Y-m-d H:i:s");
		$this->sRegistrador			= $sRegistrador;
		$this->sEnabled				= '1';
		$this->Trabajadores			= array();
		//$this->nRegistro			= Auditor::FindLastRow($DB,'solicitudinamovilidad');
	}
	function getEmpresa(){
		return $this->nEmpresa;
	}
	function setEmpresa($nEmpresa)
	{
		$this->nEmpresa	= $nEmpresa;
	}
	function getSolicitud()
	{
		return $this->nSolicitudInamovilidad;
	}
	function getExtSolicitud()
	{
		return $this->sSolicitudInamovilidad;
	}
	function Add()
	{	
		$dFecha = getdate(date('U'));
		$nControlValue = control::getControlByYear('sSolicitudInamovilidad',$this->sUnidadSustantiva,$this->DB);
		if ($nControlValue != 0) {
			$nSolicitudInamovilidad = str_pad($nControlValue,5,'0',STR_PAD_LEFT);
			$sAño = $dFecha['year'];
			$this->sSolicitudInamovilidad = $sAño."-".$nSolicitudInamovilidad;
			
			$this->nRegistro = Auditor::FindLastRow($this->DB,'solicitudinamovilidad');
			
			$this->sSQL  = "";
			$this->sSQL  = "insert into solicitudinamovilidad";
			$this->sSQL .= "(sSolicitudInamovilidad, nSolicitud, dSolicitud, sEnabled, sRegistrador, nRegistro, nEmpresa, sUnidadSustantiva) ";
			$this->sSQL .= "values(";
			$this->sSQL .= "'".$this->sSolicitudInamovilidad."',".$this->nSolicitud.",'".$this->dSolicitud."','"
						  .$this->sEnabled."','".$this->sRegistrador."',".$this->nRegistro.","
						  .$this->nEmpresa.",'".$this->sUnidadSustantiva."')";
			 
			if ($this->Query()) {
			    $this->nSolicitudInamovilidad = mysql_insert_id();
				return true;
			}else{
				return false;
			}
		}
		
		return false;
	}
	function &addTrabajador($sUsuario, $nTipoRemuneracion, $nMontoRemuneracion, 
						   $sTelefono, $dIngreso, $dEgreso,
                           $sOcupacion)
	{
		$oTrabajadorExpInamovilidad = new TrabajadorExpInamovilidad($this->DB, $sUsuario, $nTipoRemuneracion, 
																	$nMontoRemuneracion, $sTelefono, $dIngreso,
                                                                    $dEgreso, $sOcupacion);
		$this->Trabajadores[]		= $oTrabajadorExpInamovilidad;

		return $this->Trabajadores[$this->getTrabajadoresSize()-1];
	}
	function getTrabajadoresSize()
	{
		return count($this->Trabajadores);
	}
	function IsExistTrabajador($sUsuario)
	{
		if ($this->getTrabajadoresSize()>0) {
			for ($i=0;$i<$this->getTrabajadoresSize();$i++)
			{
				if ($this->Trabajadores[$i]->sUsuario == $sUsuario) {
				    return $i;
				}
			}
			return -1;
		}
		return -1;
	}
	function &getTrabajador($nIndex)
	{
		if ($nIndex < $this->getTrabajadoresSize()) {
		    return $this->Trabajadores[$nIndex];
		}else{
			return null;
		}
	}
	function &getTrabajadores()
	{
		return $this->Trabajadores;
	}
	function IsExistUser($sUsuario,$bAdmitido,&$DB = null)
	{
		$rows = 0;
		$self->sSQL = "";
		$self->sSQL = "SELECT COUNT(*) "
					 ."FROM solicitudinamovilidad INNER JOIN trabajadorexpinamovilidad "
					 ."ON solicitudinamovilidad.nSolicitudInamovilidad = trabajadorexpinamovilidad.nSolicitudInamovilidad "
					 ."WHERE trabajadorexpinamovilidad.sUsuario = '".$sUsuario."'";
		if($bAdmitido) {
			$self->sSQL .= " AND solicitudinamovilidad.nAdmision = 1";
		}else{
			$self->sSQL .= " AND solicitudinamovilidad.nAdmision = 0";
		}
		
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
	/* Admite una solicitud dada y genera un expediente */
	function Admitir($nSolicitudInamovilidad,$nAdmision,$sUnidadSustantiva, &$DB=null){
		$rows = 0;
		//verifica si ya existe un expediente para esta solicitud
		$bExpinamovilidadNoCulminado = Expinamovilidad::IsExist($nSolicitudInamovilidad,'',false,$DB);
		$bExpinamovilidadCulminado = Expinamovilidad::IsExist($nSolicitudInamovilidad,'',true,$DB);
		if (!$bExpinamovilidadNoCulminado && !$bExpinamovilidadCulminado) {
			//actualiza el tipo de admision que se le dio a la solicitud al generar el expediente
			$self->sSQL = "";
			$self->sSQL = "update solicitudinamovilidad
						   set nAdmision = '".$nAdmision."'
						   where nSolicitudInamovilidad = ".$nSolicitudInamovilidad." AND sEnabled = '1'";
			$rows = $DB->query($self->sSQL);
			
			if ($rows !=0) {
				//genera el expediente
				$oExpinamovilidad = new Expinamovilidad($DB,$nSolicitudInamovilidad);
				$bExpInamovilidad = $oExpinamovilidad->Add($sUnidadSustantiva);
				if ($bExpInamovilidad) {
					$nExpInamovilidad = ExpInamovilidad::getExpInamovilidad($nSolicitudInamovilidad, $DB, false);
					//obtener fecha de la solicitud
					$self->sSQL = "select dSolicitud from solicitudinamovilidad where nsolicitudinamovilidad = ".$nSolicitudInamovilidad;
					$rs = $DB->result($self->sSQL);
					$row = mysql_fetch_array($rs);
					$dSolicitud = $row['dSolicitud'];
					//grabar la fase de 'Solicitud(13)' 
					$oFaseExpInamovilidad = new FaseExpInamovilidad($nExpInamovilidad,13,$nSolicitudInamovilidad,$sUnidadSustantiva,1,$DB,$dSolicitud);
					$bFaseExpInamovilidad = $oFaseExpInamovilidad->Add();
					//grabar la fase seleccionada ya sea 'Admision(1)','Inadmisible(10)','Subsanacion(11)','Declinatoria de Competencia(12)'
					$oFaseExpInamovilidad = new FaseExpInamovilidad($nExpInamovilidad,$nAdmision,$nSolicitudInamovilidad,$sUnidadSustantiva,1,$DB);
					if ($bFaseExpInamovilidad){
						$bFaseExpInamovilidad = $oFaseExpInamovilidad->Add();
					}
					//culmina el expediente para los tipos de admision 'Inadmisible(10)','Declinatoria de Competencia(12)'
					switch($nAdmision)
					{
						case 10:
							$bCulminar = ExpInamovilidad::Culminar($nExpInamovilidad,10,0,$DB);			
						break;
						case 12:
							$bCulminar = ExpInamovilidad::Culminar($nExpInamovilidad,12,0,$DB);
						break;				
					}					
				}				
				return true; 
			}else{
				return false;
			}
		}else{
			/*
			  Si existe un expediente generado a partir de una solicitud con tipo de 
			  admision 'Subsanacion(11)', la solicitud puede ser admitida con otro 
			  tipo de admision ya sea 'Admision(1)','Inadmisible(10)','Declinatoria de Competencia(12)' 
			  y no se genera un expediente nuevamente. En el caso de que se haya generado a partir de una 
			  solicitud con tipo de admision 'En Supervisión(14)', la solicitud puede ser admitida con 
			  cualquier otro tipo de admision sin generar nuevamente un expediente.
			*/
			//verifica si la solicitud fue admitida con el tipo de admisión 'Subsanacion(11)' ó 'En Supervisión(14)'
			$nAdimisionSolDB = SolicitudInamovilidad::getAdmision($nSolicitudInamovilidad,$DB);
			$bUpdate = false;
			if ($nAdimisionSolDB == 11 && $nAdmision != 11){
				$bUpdate = true;
			}
			if ($nAdimisionSolDB == 14 && $nAdmision != 14){
				$bUpdate = true;
			}
			if ($bUpdate)
			{
				//actualiza nuevamente el tipo de admision de la solicitud
				$self->sSQL = "";
				$self->sSQL = "update solicitudinamovilidad
							   set nAdmision = '".$nAdmision."'
							   where nSolicitudInamovilidad = ".$nSolicitudInamovilidad." AND sEnabled = '1'";
				$rows = $DB->query($self->sSQL);
				//grabar la fase seleccionada ya sea 'Admision(1)','Inadmisible(10)','Declinatoria de Competencia(12)'
				$nExpInamovilidad = ExpInamovilidad::getExpInamovilidad($nSolicitudInamovilidad, $DB, false);
				$oFaseExpInamovilidad = new FaseExpInamovilidad($nExpInamovilidad,$nAdmision,$nSolicitudInamovilidad,$sUnidadSustantiva,1,$DB);
				$bFaseExpInamovilidad = $oFaseExpInamovilidad->Add();
				//culmina el expediente para los tipos de admision 'Inadmisible(10)','Declinatoria de Competencia(12)'
				switch($nAdmision)
				{
					case 10:
						$bCulminar = ExpInamovilidad::Culminar($nExpInamovilidad,10,0,$DB);			
					break;
					case 12:
						$bCulminar = ExpInamovilidad::Culminar($nExpInamovilidad,12,0,$DB);
					break;				
				}
				return true;			
			}
			return false;
		}
	}
	/* Devuelve el tipo de admision de la solicitud*/
	function getAdmision($nSolicitudInamovilidad, &$DB=null){
		$nAdmision = 0;
		$self->sSQL  = "";
		$self->sSQL  = "select nAdmision ";
		$self->sSQL .= "from solicitudinamovilidad ";
		$self->sSQL .= "where nSolicitudInamovilidad = ".$nSolicitudInamovilidad;

		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$nAdmision = $row[0];
		}
		return $nAdmision;		
	}
	/* Devuelve la cedula del primer trabajador de la solicitud*/
	function getPrimerTrabajador($nSolicitudInamovilidad, &$DB=null)
	{
		$sUsuario = '';
		$self->sSQL  = "";
		$self->sSQL  = "select sUsuario 
						from trabajadorexpinamovilidad 
						where nsolicitudinamovilidad = ".$nSolicitudInamovilidad." LIMIT 1";
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$sUsuario = $row[0];
		}
		return $sUsuario;			
	}
	/* Devuelve la cantidad de trabajadores que posee la solicitud*/
	function getCntTrabajador($nSolicitudInamovilidad,&$DB=null)
	{
		$nCantidad = 0;
		$sSQL = "select COUNT(sUsuario) 
		  		 from trabajadorexpinamovilidad 
				 where nsolicitudinamovilidad = ".$nSolicitudInamovilidad." and trabajadorexpinamovilidad.sEnabled = '1'";
		$nCantidad = $DB->resultScalar($sSQL);
		return $nCantidad;
	}
	/* Devuelve el estado de una solicitud ya sea habilitada o no */
	function getEnabled($nSolicitudInamovilidad, &$DB=null){
		if ($DB==null) {
			return $this->sEnabled;
		}else{
			$rows = 0;
			$sEnabled = '0';
			$self->sSQL  = "";
			$self->sSQL  = "select sEnabled ";
			$self->sSQL .= "from solicitudinamovilidad ";
			$self->sSQL .= "where nSolicitudInamovilidad = ".$nSolicitudInamovilidad;
			
			//Auditor::DisplaySql($self->sSQL);
			
			if ($DB==null) {
				$this->rs = $this->Gestion->result($this->sSQL);
			}else{
				$self->rs = $DB->result($self->sSQL);
			}
			
			while ($row = mysql_fetch_array($self->rs))
			{   
				$sEnabled = $row[0];
			}
			return $sEnabled;
		}
	}
	function getIntSolicitud($sSolicitudInamovilidad, $sUnidadSustantiva, &$DB = null)
	{
		$nSolicitudInamovilidad = '';
		$self->sSQL  = "";
		$self->sSQL  = "select nSolicitudInamovilidad ";
		$self->sSQL .= "from solicitudinamovilidad ";
		$self->sSQL .= "where sSolicitudInamovilidad = '".$sSolicitudInamovilidad."' and sUnidadSustantiva = '".$sUnidadSustantiva."'";
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}

		while ($row = mysql_fetch_array($self->rs))
		{   
			$nSolicitudInamovilidad = $row[0];
		}
		return $nSolicitudInamovilidad;		
	}
	function Query()
	{
		$this->rowAffected = $this->DB->query($this->sSQL);
		if ($this->rowAffected != 0) {
			return true;
		}else{
			return false;
		}			
	}
}

/*
* CREATE TABLE trabajadorexpinamovilidad (
  sUsuario VARCHAR(20) NOT NULL,
  nSolicitudInamovilidad INT(9) UNSIGNED NOT NULL,
  nMontoRemuneracion DOUBLE(9,3) NOT NULL DEFAULT 0.000,
  sTelefono VARCHAR(20) NOT NULL,
  nTipoRemuneracion TINYINT(3) UNSIGNED NOT NULL,
  dIngreso DATE NOT NULL,
  dEgreso DATE NULL,
  sOcupacion VARCHAR(20) NULL,
  sEnabled CHAR(1) NULL DEFAULT '0',
  nRegistro INTEGER(10) UNSIGNED NOT NULL,
  nStatus INTEGER(10) UNSIGNED NOT NULL,
  PRIMARY KEY(sUsuario, nSolicitudInamovilidad)
);
*/

class TrabajadorExpInamovilidad
{
	var $sUsuario;
	var $nSolicitudInamovilidad;
	var $nMontoRemuneracion;
	var $sTelefono;
	var $nTipoRemuneracion;
	var $dIngreso;
	var $dEgreso;
	var $sOcupacion;
	var $sEnabled;
	var $nRegistro;
	var $nStatus;
	var $Fueros = '';
	var $DB;
	var $rowAffected;
	var $sSQL;
	
	function TrabajadorExpInamovilidad(&$DB, $sUsuario, $nTipoRemuneracion, 
									   $nMontoRemuneracion, $sTelefono, $dIngreso,
                                       $dEgreso, $sOcupacion)
	{
		$this->DB					= $DB;
		$this->sUsuario				= $sUsuario;
		$this->nSolicitudInamovilidad = 0;
		$this->nTipoRemuneracion 	= $nTipoRemuneracion;
		$this->nMontoRemuneracion 	= $nMontoRemuneracion;
		$this->sTelefono 			= $sTelefono;
		$this->dIngreso				= $dIngreso;
		$this->dEgreso              = $dEgreso;
		$this->sOcupacion           = $sOcupacion;
		$this->sEnabled				= "1";
		$this->Fueros				= array();
	}
	function setSolicitud($value)
	{
		$this->nSolicitudInamovilidad = $value;
	}
	function setTipoRemuneracion($value)
	{
		$this->nTipoRemuneracion = $value;
	}
	function setRemuneracion($value)
	{
		$this->nMontoRemuneracion = $value;
	}
	function setTelefono($value)
	{
		$this->sTelefono = $value;
	}
	function setIngreso($value)
	{
		$this->dIngreso = $value;
	}
	function setEgreso($value)
    {
        $this->dEgreso = $value;
    }
    function setOcupacion($value)
    {
        $this->sOcupacion = $value;
    }
	function getCedula()
	{
		return $this->sUsuario;
	}
	function add()
	{
		if ($this->nSolicitudInamovilidad != 0) {
			$this->nRegistro = Auditor::FindLastRow($this->DB,'trabajadorexpinamovilidad');
			
		    $this->sSQL = "";
			$this->sSQL = "insert into trabajadorexpinamovilidad "
						 ."(sUsuario,nSolicitudInamovilidad,nTipoRemuneracion,
                            nMontoRemuneracion,sTelefono,dIngreso,
                            dEgreso,sOcupacion,sEnabled,
                            nRegistro) "
						 ."values("
						 ."'".$this->sUsuario."',".$this->nSolicitudInamovilidad.",".$this->nTipoRemuneracion.","
						 .$this->nMontoRemuneracion.",'".$this->sTelefono."','".$this->dIngreso."','"
                         .$this->dEgreso."','".$this->sOcupacion."','".$this->sEnabled."',"
                         .$this->nRegistro.")";
						 
			return $this->Query();
		}
		return false;
	}
	function edit()
	{
		if ($this->nSolicitudInamovilidad != 0) {			
		    $this->sSQL = "";
			$this->sSQL = "update trabajadorexpinamovilidad set "
						 ."nTipoRemuneracion = ".$this->nTipoRemuneracion.",
                           nMontoRemuneracion = ".$this->nMontoRemuneracion.",
						   sTelefono = '".$this->sTelefono."',
						   dIngreso = '".$this->dIngreso."',
                           dEgreso = '".$this->dEgreso."',
						   sOcupacion = '".$this->sOcupacion."' where sUsuario = '".$this->sUsuario."' 
						   and nSolicitudInamovilidad = ".$this->nSolicitudInamovilidad;
						 
			return $this->Query();
		}
		return false;		
	}
	function IsExistDB($nSolicitudInamovilidad, $sUsuario, &$DB)
	{
		$sSQL = "select * from trabajadorexpinamovilidad where nSolicitudInamovilidad = ".$nSolicitudInamovilidad." and sUsuario = ".$sUsuario;
		$rs = $DB->result($sSQL);
		if (mysql_num_rows($rs) > 0){
			return true;
		}else{
			return false;
		}
	}
	function &addFuero($sUsuario, $nFuero)
	{
		$oFuero 		= new FueroExpInamovilidad($this->DB, $sUsuario, $nFuero);
		$this->Fueros[] = $oFuero;
		return $this->Fueros[$this->getFueroSize()-1];
	}
	function getFueroSize()
	{
		return count($this->Fueros);
	}
	function IsExistFuero($nFuero)
	{
		for ($i=0;$i<$this->getFueroSize();$i++)
		{
			if ($this->Fueros[$i]->nFuero == $nFuero) {
			    return $i;
			}
		}
		return -1;
	}
	function &getFuero($nIndex)
	{
		if ($nIndex < $this->getFueroSize()) {
		    return $this->Fueros[$nIndex];
		}else{
			return null;
		}
	}
	function getFueros()
	{
		return $this->Fueros;
	}
	function Query()
	{
		$this->rowAffected = $this->DB->query($this->sSQL);
		if ($this->rowAffected != 0) {
			return true;
		}else{
			return false;
		}			
	}	
}

/*
* CREATE TABLE fueroexpinamovilidad (
  nFuero TINYINT(3) UNSIGNED NOT NULL,
  nSolicitudInamovilidad INT(9) NOT NULL,
  sUsuario VARCHAR(20) NOT NULL,
  sDecretos VARCHAR(100) NULL,
  sEnabled CHAR(1) NULL DEFAULT '0',
  nRegistro INTEGER(10) UNSIGNED NOT NULL,
  nStatus TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY(nFuero, nSolicitudInamovilidad, sUsuario)
);
*/

class FueroExpInamovilidad
{
	var $nFuero;
	var $nSolicitudInamovilidad;
	var $sUsuario;
	var $sDecretos;
	var $sEnabled;
	var $nRegistro;
	var $nStatus;
	var $Decretos = '';
	var $DB;
	var $rowAffected;
	var $sSQL;
	
	function FueroExpInamovilidad(&$DB, $sUsuario, $nFuero)
	{
		$this->DB		= $DB;
		$this->nSolicitudInamovilidad = 0;
		$this->sUsuario	= $sUsuario;
		$this->nFuero	= $nFuero;
		$this->sEnabled	= '1';
		$this->Decretos	= array();
	}
	function getFuero()
	{
		return $this->nFuero;
	}
	function add()
	{
		if ($this->nSolicitudInamovilidad != 0) {
			$this->nRegistro = Auditor::FindLastRow($this->DB,'fueroexpinamovilidad');
		    $this->sSQL = "";
			$this->sSQL = "insert into fueroexpinamovilidad "
						 ."(nFuero,nSolicitudInamovilidad,sUsuario,sDecretos,sEnabled,nRegistro) "
						 ."values(".$this->nFuero.",".$this->nSolicitudInamovilidad.",'".$this->sUsuario."',"
						 ."'".join(',',$this->Decretos)."','".$this->sEnabled."',".$this->nRegistro.")";
		 
			return $this->Query();
		}
		return false;
	}
	function edit()
	{
		if ($this->nSolicitudInamovilidad != 0) {
			$this->sSQL = "";
			$this->sSQL = "update fueroexpinamovilidad set 
						   sDecretos = ".join(',',$this->Decretos)." 
						   where nFuero = ".$this->nFuero." and nSolicitudInamovilidad = ".$this->nSolicitudInamovilidad." and sUsuario = '".$sUsuario."'";
			return $this->Query();
		}
		return false;									   
	}
	function addDecreto($nDecreto)
	{
		$this->Decretos[] = $nDecreto;
	}
	
	function IsExistDecreto($nDecreto)
	{
		for ($i=0;$i<count($this->Decretos);$i++)
		{
			if ($this->Decretos[$i]==$nDecreto) {
			    return $i;
			}
		}
		return -1;
	}
	function getDecretos()
	{
		return $this->Decretos;
	}
	function setSolicitud($value)
	{
		$this->nSolicitudInamovilidad = $value;
	}
	function IsExistDB($nFuero,$nSolicitudInamovilidad,$sUsuario,&$DB)
	{
		$sSQL = "select * from fueroexpinamovilidad where nSolicitudInamovilidad = ".$nSolicitudInamovilidad." and nFuero = ".$nFuero." and sUsuario = '".$sUsuario."'";
		$rs = $DB->result($sSQL);
		if (mysql_num_rows($rs) > 0){
			return true;	
		}else{
			return false;
		}
	}	
	function Query()
	{
		$this->rowAffected = $this->DB->query($this->sSQL);
		if ($this->rowAffected != 0) {
			return true;
		}else{
			return false;
		}			
	}	
}
/*
CREATE TABLE expinamovilidad (
  nExpInamovilidad INT(9) NOT NULL AUTO_INCREMENT,
  nSolicitudInamovilidad INT(9) NOT NULL,
  sExpInamovilidad VARCHAR(16) NULL,
  sExpInamovilidadRef VARCHAR(16) NULL,
  dExpInamovilidadRef DATE NULL,
  nCulminacion TINYINT(3) UNSIGNED NULL DEFAULT 0,
  nDecision TINYINT(3) UNSIGNED NOT NULL,
  nRegistro INTEGER(10) UNSIGNED NOT NULL,
  nStatus TINYINT(3) UNSIGNED NOT NULL,
  dCulminacion DATE NULL,
  PRIMARY KEY(nExpInamovilidad, nSolicitudInamovilidad)
);
*/
//TABLE-CLASS: expinamovilidad
class Expinamovilidad
{
	//TABLE-FIELDS
	var $nExpInamovilidad;
	var $nSolicitudInamovilidad;
	var $sExpInamovilidad;
	var $sExpInamovilidadRef;
	var $dExpInamovilidadRef;
	var $nCulminacion;
	var $dCulminacion;
	var $nDecision;
	var $nRegistro;
	
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED
	
	function Expinamovilidad(&$DB, $nSolicitudInamovilidad){
		$this->nSolicitudInamovilidad = $nSolicitudInamovilidad;
		$this->Gestion 				  = $DB;
	}
	
	function Add($sUnidadSustantiva){
		$nControlValue = control::getControlByYear('sExpInamovilidad',$sUnidadSustantiva,$this->Gestion);
		if ($nControlValue != 0) {
			$this->nRegistro = Auditor::FindLastRow($this->Gestion,'expinamovilidad');
		
			$this->sSQL  = "";
			$this->sSQL .= "insert into expinamovilidad";
			$this->sSQL .= "(nSolicitudInamovilidad,nRegistro) ";
			$this->sSQL .= "values(";
			$this->sSQL .= $this->nSolicitudInamovilidad.",".$this->nRegistro.")";
			
			if ($this->Query() != 0) {
				$nUnidadSustantiva = UnidadSustantiva::getUnidadSustantiva($sUnidadSustantiva,$this->Gestion);
				$sExpInamovilidad = str_pad($nControlValue,5,'0',STR_PAD_LEFT);
				$dFecha = getdate(date('U'));
				$sAño = substr($dFecha['year'],2);
				$sExpInamovilidad = $nUnidadSustantiva."-".$sAño."-01-".$sExpInamovilidad;
				
				$this->sSQL = "";
				$this->sSQL = "update expinamovilidad set sExpInamovilidad = '".$sExpInamovilidad."' where nExpInamovilidad = ".mysql_insert_id();
				
				return $this->Query();
			}
		}
	}
	function Culminar($nExpInamovilidad,$nCulminacion,$nDecision = 0,&$DB=null){
		$self->sSQL = "update expinamovilidad 
					   set nCulminacion = ".$nCulminacion.", dCulminacion = '".date("Y-m-d H:i:s")."' ";
		if ($nDecision != 0) {
			$self->sSQL .= ",nDecision = ".$nDecision." ";
		}
		$self->sSQL .= "where nExpInamovilidad = ".$nExpInamovilidad;
		
		if ($DB==null) {
			$self->rowAffected = $this->Gestion->query($this->sSQL);
		}else{
			$self->rowAffected = $DB->query($self->sSQL);
		}
		if ($self->rowAffected != 0) {
		    return true;
		}else{
			return false;
		}
	}
	/* Devuelve el numero de expediente para una solicitud dada */
	function getExpInamovilidad($nSolicitudInamovilidad,$DB=null,$bExterno=true){
		($bExterno) ? $sFieldName = 'sExpInamovilidad': $sFieldName = 'nExpInamovilidad';
		$sExpInamovilidad = '';
		$self->sSQL  = "";
		$self->sSQL  = "select ".$sFieldName." ";
		$self->sSQL .= "from expinamovilidad ";
		$self->sSQL .= "where nSolicitudInamovilidad = ".$nSolicitudInamovilidad;
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}

		while ($row = mysql_fetch_array($self->rs))
		{   
			$sExpInamovilidad = $row[0];
		}
		return $sExpInamovilidad;
	}
	function getSolicitud($nExpInamovilidad,&$DB = null)
	{
		$nSolicitudInamovilidad = 0;
		$self->sSQL  = "";
		$self->sSQL  = "select nSolicitudInamovilidad ";
		$self->sSQL .= "from expinamovilidad ";
		$self->sSQL .= "where nExpInamovilidad = ".$nExpInamovilidad;
		
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}

		while ($row = mysql_fetch_array($self->rs))
		{   
			$nSolicitudInamovilidad = $row[0];
		}
		return $nSolicitudInamovilidad;	
	}
	function IsExist($nSolicitudInamovilidad, $sExpInamovilidad = '', $bCulminado, 
					 &$DB = null){
		$rows = 0;
		$self->sSQL  = "";
		$self->sSQL  = "select COUNT(*) ";
		$self->sSQL .= "from expinamovilidad ";
		$self->sSQL .= "where nSolicitudInamovilidad = ".$nSolicitudInamovilidad;
		
		if ($sExpInamovilidad != '') $self->sSQL .= " AND sExpInamovilidad = '".$sExpInamovilidad."'";
		
		if($bCulminado) {
			$self->sSQL .= " AND nCulminacion != 0 ";
		}else{
			$self->sSQL .= " AND nCulminacion = 0 ";
		}
		
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
	function IsExistUser($sUsuario,$bCulminado,&$DB = null)
	{
		$rows = 0;
		$self->sSQL = "select COUNT(*) 
					   from expinamovilidad 
					   inner join solicitudinamovilidad ON expinamovilidad.nSolicitudInamovilidad = solicitudinamovilidad.nSolicitudInamovilidad 
					   inner join trabajadorexpinamovilidad on solicitudinamovilidad.nSolicitudInamovilidad = trabajadorexpinamovilidad.nSolicitudInamovilidad 
					   where trabajadorexpinamovilidad.sUsuario = '".$sUsuario."'";
					   
		if($bCulminado) {
			$self->sSQL .= " AND expinamovilidad.nCulminacion != 0 ";
		}else{
			$self->sSQL .= " AND expinamovilidad.nCulminacion = 0 ";
		}

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
	/* Ejecuta una consulta especifica en la base de datos */
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
* CREATE TABLE faseexpinamovilidad (
  nFase TINYINT(3) UNSIGNED NOT NULL,
  nExpInamovilidad INT(9) NOT NULL,
  nSolicitudInamovilidad INT(9) UNSIGNED NOT NULL,
  sUnidadSustantiva VARCHAR(6) NULL,
  nServicio TINYINT(3) UNSIGNED NOT NULL,
  dFase DATETIME NULL,
  nRegistro INTEGER(10) UNSIGNED NOT NULL,
  nStatus INTEGER(10) UNSIGNED NOT NULL,
  PRIMARY KEY(nFase, nExpInamovilidad, nSolicitudInamovilidad)
);
*/
//TABLE-CLASS: faseexpinamovilidad
class FaseExpInamovilidad
{
	//TABLE-FIELDS
	var $nFase;
	var $nExpInamovilidad;
	var $nSolicitudInamovilidad;
	var $sUnidadSustantiva;
	var $nServicio;
	var $dFase;
	var $sRespuesta;
	var $nRegistro;
	
	//DATABASE-MANAGMENT
	var $Gestion; 	//DATABASE-CONNECTION-REFERENCE
	var $sSQL;		//QUERY-STORAGE
	var $rowAffected; //ROW-AFFECTED	
	
	function FaseExpInamovilidad($nExpInamovilidad, $nFase, $nSolicitudInamovilidad, $sUnidadSustantiva, $nServicio, &$DB=null, $dFase='', $sRespuesta = '0'){
		$this->nExpInamovilidad = $nExpInamovilidad;
		$this->nFase			= $nFase;
		$this->nSolicitudInamovilidad = $nSolicitudInamovilidad;
		$this->sUnidadSustantiva = $sUnidadSustantiva; 
		$this->nServicio		= $nServicio;
		$this->sRespuesta 		= $sRespuesta;
		($dFase == '') ? $this->dFase = date("Y-m-d H:i:s") : $this->dFase = $dFase;
		$this->Gestion 			= $DB;
	}
	
	/* Agrega una fase a un expediente en especifico en la base de datos */
	function Add(){
		$this->nRegistro = Auditor::FindLastRow($this->Gestion, 'faseexpinamovilidad');
		
		$this->sSQL	= "";
		$this->sSQL	= "insert into faseexpinamovilidad 
					   (nFase, nExpInamovilidad, nSolicitudInamovilidad, 
					   sUnidadSustantiva, nServicio, dFase, 
					   sRespuesta, nRegistro) 
					   values(".$this->nFase.",".$this->nExpInamovilidad.",".$this->nSolicitudInamovilidad.",'"
					   .$this->sUnidadSustantiva."',".$this->nServicio.",'".$this->dFase."','"
					   .$this->sRespuesta."',".$this->nRegistro.")";
					   
		return $this->Query();
	}
	
	/* Devuelve la ultima fase registrada para un expediente en especifico */
	function getLastFase($nExpInamovilidad, &$DB = null){
		$nFase = '';
		$self->sSQL  = "";
		$self->sSQL  = "select nFase 
						from faseexpinamovilidad 
						where nExpInamovilidad = ".$nExpInamovilidad."
						order by dFase DESC LIMIT 1";
			
		if ($DB==null) {
			$this->rs = $this->Gestion->result($this->sSQL);
		}else{
			$self->rs = $DB->result($self->sSQL);
		}
		
		while ($row = mysql_fetch_array($self->rs))
		{   
			$nFase = $row[0];
		}
		return $nFase;
	}
	function IsExist($nExpInamovilidad,$nFase,&$DB = null)
	{
		$rows = 0;
		$self->sSQL = "";
		$self->sSQL = "select COUNT(*) from faseexpinamovilidad 
					   where nExpInamovilidad = ".$nExpInamovilidad." AND nFase = ".$nFase;
		
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
	/* Obtiene la respuesta para una fase determinada */
	function getRespuesta($nExpInamovilidad,$nFase,&$DB)
	{
		$sRespuesta = '0';
		$sSQL = "select sRespuesta from faseexpinamovilidad where nExpInamovilidad = ".$nExpInamovilidad." AND nFase = ".$nFase;
		$rs = $DB->result($sSQL);
		$row = mysql_fetch_array($rs);
		$sRespuesta = $row['sRespuesta'];
		return $sRespuesta;
	}
	/* Ejecuta una consulta especifica en la base de datos */
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

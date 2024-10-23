<?php

/*CREATE TABLE Opcion (
  nOpcion SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  sDenominacion VARCHAR(255) NOT NULL,
  sUrl VARCHAR(255) NOT NULL,
  sParams VARCHAR(255) NULL,
  nOpcionRef SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  sMenu CHAR(1) NOT NULL DEFAULT 1,
  dOpcion DATE NOT NULL,
  sEnabled CHAR(1) NOT NULL DEFAULT 1,
  nOrden SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  sUrlHelp VARCHAR(255) NOT NULL,
  sToolTip VARCHAR(255) NOT NULL,
  sTarget VARCHAR(20) NOT NULL DEFAULT vista,
  sOnclick TEXT NULL,
  PRIMARY KEY(nOpcion)
)
*/
class Opcion
{
  var $nOpcion;
  var $sDenominacion;
  var $sUrl;
  var $sParams;
  var $nOpcionRef;
  var $sMenu;
  var $dOpcion;
  var $sEnabled;
  var $nOrden;
  var $sUrlHelp;
  var $sToolTip;
  var $sTarget;
  var $sOnclick;
  
  function Opcion($sDenominacion,$sUrl,$sParams='',
  				  $nOpcionRef,$sMenu,$dOpcion,
				  $nOrden,$sUrlHelp='',$sToolTip,
				  $sTarget,$sOnClick='',$nOpcion)
  {
  	$this->sDenominacion = $sDenominacion;
	$this->sUrl = $sUrl;
	$this->sParams = $sParams;
	$this->nOpcionRef = $nOpcionRef;
	$this->sMenu = $sMenu;
	$this->dOpcion = $dOpcion;
	$thia->nOrden = $nOrden;
	$this->sUrlHelp = $sUrlHelp;
	$this->sToolTip = $sToolTip;
	$this->sTarget = $sTarget;
	$this->sOnclick = $sOnClick;
	$this->nOpcion = $nOpcion;
  } 
}

?>
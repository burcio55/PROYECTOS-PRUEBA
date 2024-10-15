<?php 
function cambiarMayusculas($cadena){
	$cadena = str_ireplace(	'&aacute;','Á',$cadena);
	$cadena = str_ireplace(	'&eacute;','É',$cadena);
	$cadena = str_ireplace(	'&iacute;','Í',$cadena);
	$cadena = str_ireplace(	'&oacute;','Ó',$cadena);
	$cadena = str_ireplace(	'&uacute;','Ú',$cadena);
	$cadena = str_ireplace(	'&ntilde;','Ñ',$cadena);
	$cadena = strtoupper($cadena);
	return $cadena;
}
?>
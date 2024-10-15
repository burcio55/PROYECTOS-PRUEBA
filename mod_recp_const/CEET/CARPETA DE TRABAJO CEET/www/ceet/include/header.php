<?php
if (!defined("header.php"))
{
	define("header.php","1",true);
	include_once('adodb/adodb.inc.php');
	include_once("settings.php");
	include_once('import.php');
	
	function FUNC_brouserUsr(){ 
	if ((ereg("Nav", $_SERVER["HTTP_USER_AGENT"])) || 
		(ereg("Gold",  $_SERVER["HTTP_USER_AGENT"])) || 
		(ereg("X11",  $_SERVER["HTTP_USER_AGENT"])) || 
		(ereg("Mozilla",  $_SERVER["HTTP_USER_AGENT"])) || 
		(ereg("Netscape",  $_SERVER["HTTP_USER_AGENT"])) AND 
		(!ereg("MSIE",  $_SERVER["HTTP_USER_AGENT"]) AND
		(!ereg("Konqueror",  $_SERVER["HTTP_USER_AGENT"])))) 
		$browser = "Netscape";           
		elseif(ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) $browser = "MSIE";          
		elseif(ereg("Lynx", $_SERVER["HTTP_USER_AGENT"])) $browser = "Lynx";          
		elseif(ereg("Opera", $_SERVER["HTTP_USER_AGENT"])) $browser = "Opera";          
		elseif(ereg("Netscape", $_SERVER["HTTP_USER_AGENT"])) $browser = "Netscape";          
		elseif(ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) $browser = "Konqueror";          
		elseif((eregi("bot", $_SERVER["HTTP_USER_AGENT"])) ||  
				(ereg("Google", $_SERVER["HTTP_USER_AGENT"])) || 
				(ereg("Slurp",  $_SERVER["HTTP_USER_AGENT"])) || 
				(ereg("Scooter",  $_SERVER["HTTP_USER_AGENT"])) || 
				(eregi("Spider",  $_SERVER["HTTP_USER_AGENT"])) || 
				(eregi("Infoseek",  $_SERVER["HTTP_USER_AGENT"]))) 
				$browser = "Bot";  else $browser = "Other"; return $browser; 
	}  
	$header['browser'] = FUNC_brouserUsr(); 
	
	//por defecto se conecta a esta base de datos pero puede ser sobreescrito en otro momento
	datasource($db1);
	
	function getConnDB(){
		$conn = &ADONewConnection($GLOBALS['settings']['target']);
		$conn->PConnect($GLOBALS['settings']['hostname'],$GLOBALS['settings']['username'],$GLOBALS['settings']['password'],$GLOBALS['settings']['db']);
		$conn->debug = $GLOBALS['settings']['debug'];

		return $conn;
	}
	
	session_start();
}
?>
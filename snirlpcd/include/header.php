<?php
if (!defined("header.php")) {
	define("header.php", "1", true);
	include_once('adodb/adodb.inc.php');
	include_once("settings.php");
	include_once('import.php');

	function FUNC_brouserUsr()
	{
		if ((mb_ereg("Nav", $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_ereg("Gold",  $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_ereg("X11",  $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_ereg("Mozilla",  $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_ereg("Netscape",  $_SERVER["HTTP_USER_AGENT"])) and
			(!mb_ereg("MSIE",  $_SERVER["HTTP_USER_AGENT"]) and
				(!mb_ereg("Konqueror",  $_SERVER["HTTP_USER_AGENT"])))
		)
			$browser = "Netscape";
		elseif (mb_ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) $browser = "MSIE";
		elseif (mb_ereg("Lynx", $_SERVER["HTTP_USER_AGENT"])) $browser = "Lynx";
		elseif (mb_ereg("Opera", $_SERVER["HTTP_USER_AGENT"])) $browser = "Opera";
		elseif (mb_ereg("Netscape", $_SERVER["HTTP_USER_AGENT"])) $browser = "Netscape";
		elseif (mb_ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) $browser = "Konqueror";
		elseif ((mb_eregi("bot", $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_ereg("Google", $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_ereg("Slurp",  $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_ereg("Scooter",  $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_eregi("Spider",  $_SERVER["HTTP_USER_AGENT"])) ||
			(mb_eregi("Infoseek",  $_SERVER["HTTP_USER_AGENT"]))
		)
			$browser = "Bot";
		else $browser = "Other";
		return $browser;
	}
	$header['browser'] = FUNC_brouserUsr();

	//por defecto se conecta a esta base de datos pero puede ser sobreescrito en otro momento
	datasource($db1);

	function getConnDB()
	{
		/* 
		var_dump(array(
			"Setting:" => $GLOBALS['settings']['target'],
			"Ado Connexion" => ADONewConnection($GLOBALS['settings']['target']),
			"PConnect" => $GLOBALS['settings']['hostname'], $GLOBALS['settings']['username'], $GLOBALS['settings']['password'], $GLOBALS['settings']['db'],
			"Debug" => $GLOBALS['settings']['debug']
		));
		echo "<hr>";
 */
		$conn = &ADONewConnection($GLOBALS['settings']['target']);
		$conn->PConnect($GLOBALS['settings']['hostname'], $GLOBALS['settings']['username'], $GLOBALS['settings']['password'], $GLOBALS['settings']['db']);
		$conn->debug = $GLOBALS['settings']['debug'];
		return $conn;
	}

	session_start();
}

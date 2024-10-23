<?php

class Context
{
	function Init()
	{
		$_SESSION = array();
	}
	function Set($sVarName, &$var)
	{
		$_SESSION[$sVarName] = $var;
	}
	function &Get($sVarName)
	{
		if (empty($_SESSION[$sVarName]) == False) {
			//print 'Context:EXISTE';
		    return $_SESSION[$sVarName];
		}else{
			//print 'Context:NO EXISTE';
			return null;
		}
	}
	function Destroy($sVarName)
	{
		unset($_SESSION[$sVarName]);
	}
}

?>
<?php

class PageMessage
{
	var $nType;
	var $sMessage;
	function PageMessage($nType,$sMessage)
	{
		$this->nType = $nType;
		$this->sMessage = $sMessage;
	}
	function getType()
	{
		return $this->nType;
	}
	function getMessage()
	{
		return  $this->sMessage;
	}
}

?>
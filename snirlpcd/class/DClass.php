<?php

/* clase dinamica 
* esta clase permite añadir propiedades dinamicamente
*/
class DClass
{
	var $Properties = array();
	
	function setProperty($name, $property){
		$this->Properties[$name] = $property;
	}
	
	function &getProperty($name){
		if (isset($this->Properties[$name])) {
		    return $this->Properties[$name];
		}else{
			return null;
		}
	}
}

?>
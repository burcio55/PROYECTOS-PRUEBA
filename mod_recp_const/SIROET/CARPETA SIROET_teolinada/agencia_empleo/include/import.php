<?php
/**
 * incluye todas funciones de las carpetas functions y html.
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param string $package	nombre del paquete al que estan asociados las funciones.
 							ej. package.function_name.php
 */
function import($package)
{
	$directory = array();
	$directory[] = "include/functions";
	$directory[] = "include/html";		
	
	for ( $i=0;$i<count($directory);$i++ )
	{
		$dh = dir($directory[$i]);
		while ($entry = $dh->read()) 
		{
			if (($entry != ".") && ($entry != "..")){
				if (strpos($entry, "."))
				{
					include($directory[$i]."/".$entry);
				}
			}
		}	
	}
	
}
?>
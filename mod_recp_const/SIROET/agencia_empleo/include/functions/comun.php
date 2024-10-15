<?php
/**
 * elimina los subfijos colocados en los campos de los formularios
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param array $_array	contiene los campos de un form. 
 */
function limpiar_subfijo( &$_array )
{
	foreach ($_array as $key => $value) 
	{
		$key = str_replace("_txt","",$key);
		$key = str_replace("_cb","",$key);
		$_array[$key] = $value;
	}
}
?>
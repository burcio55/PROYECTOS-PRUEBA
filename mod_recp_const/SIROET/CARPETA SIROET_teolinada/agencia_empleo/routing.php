<?php 
	/**
	* Archivo que redirecciona al contenido que se va incrustar dentro de la header y el footer
	* Autor: Elivar Largo
	* Sitio Web: wwww.ecodeup.com
	**/
	var_dump($_GET);
	if ($_GET['menu']==11) {		
		require_once('mod_agencia_empleo/1_1agen_trab_datos.php');
	}
	if ($_GET['menu']=='21') {
		require_once('mod_agencia_empleo/2_1agen_empresa.php');
	} 
 ?>
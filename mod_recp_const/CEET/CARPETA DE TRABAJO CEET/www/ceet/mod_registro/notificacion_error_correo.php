<?php
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug = false;



showHeader();

function debug(){
	 if($settings['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function trace($msg){//para hacer traza y no estar escribiendo echo o print cada vez
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
function showHeader(){
 include('../header_registro.php'); 
}
?>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />

<table class="formulario" width="70%" align="center">
<tr>
	<td height="60"></td>
</tr>
<tr>
<td align="center" class="alerta_roja titulo "><img src="../imagenes/warning_16.png"  /> ERROR INTENTE DE NUEVO ESTA OPERACION MAS TARDE</td>
</tr>
<tr>
  <td align="center" class="">Se recomienda que intente esta operacion mas adelante, actualmente presentamos problemas tecnicos.</td>
</tr>
<tr>
<th align="center">
<a href="../mod_login/cerrar_sesion.php">SALIR</a>
</th>
</tr>
<tr>
<td height="10"></td>
</tr>
<tr>
<td height="90"></td>
</tr>

</table>

<?php
 include('../footer.php'); 
 ?>
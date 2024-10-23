<?php
function validar_sesion(){
	if(!isset($_SESSION['id_usuario'])){
		print "<script>alert('La Sesion ha Expirado...!')</script>";
		print "<script>document.location='/minpptrassi/mod_login/login.php'</script>";
	}	
}

function debug(){
	if($GLOBALS['settings']['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function showFooter(){
$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?>
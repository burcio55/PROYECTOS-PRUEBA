<?
/*
 * Este script es una extensión de el módulo de seguridad que permite:
 * 1) Impedir el uso del sistema a uno o a varios usuarios que esten trabajando en el mismo, 
 * en un momento determinado, sin necesidad de que ellos se salgan del sistema. 
 * Dicha extensión debe ser incluida en cada una de las páginas que conforman el sistema.
 */
include_once('include/settings.php');
session_start();

$sUsuario = $_SESSION['sUsuario'];

$cn = mysql_connect($hostname,$username,$password);
mysql_select_db($db_settings[0],$cn);

/* 
 * verifica si la sesion o cuenta del usuario esta habilitada, 
 * en caso de no estar habilitada, este finaliza la ejecución del script,
 * envia un mensaje al usuario y lo redirecciona a la pagina inicial del sistema
 */
$sSQL = "select * from sesion where sUsuario = '".$sUsuario."' and sEnabled = '1';";
$rs = mysql_query($sSQL,$cn) or die("seguridad:".mysql_error());
if (mysql_num_rows($rs) == 0){
	$sMsg  = "<script>";
	//$sMsg .= "alert('-.Su cuenta ha sido deshabilitada.-');";
	$sMsg .= "alert('-.Por favor intente logearse nuevamente.-');";
	$sMsg .= "parent.document.location='login.php';";	
	$sMsg .= "</script>";
	die($sMsg);
}

mysql_close($cn);
?>
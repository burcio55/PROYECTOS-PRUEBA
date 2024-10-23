<?php
session_start();
//	var_dump($_SESSION);
if(!isset($_SESSION['usuario'])){
header ("Location:../mod_login/login.php");
}
?>
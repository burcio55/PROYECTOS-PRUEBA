<?php
//if((!isset($_SESSION['sUsuario']))or (!isset($_SESSION['id_afiliado'])) or (!isset($_SESSION['ced_afiliado']))  ){
if((!isset($_SESSION['usuario_id']))or (!isset($_SESSION['nacionalidad'])) or (!isset($_SESSION['nusuario'])) or (!isset($_SESSION['nombre'])) or (!isset($_SESSION['apellido']))or (!isset($_SESSION['id_clave']))){
	?>
<script>alert('Su sesión a expirado...')</script>
<? header ("Location:../mod_login/login.php");
}
?>

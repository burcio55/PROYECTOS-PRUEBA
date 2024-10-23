<?php
session_start();
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB('sire');
$conn->debug = true;

$SQL=" SELECT 
id,cedula,nombres,apellidos,nacionalidad,tipo_usuario
FROM personas
WHERE cedula='".$nacionalidad.$usuario."'
AND clave='".md5($clave)."' 
AND status='A'
LIMIT 1 ";

$rs=$conn->Execute($SQL);
$numero_registros=$rs->RecordCount();
			
if($numero_registros>0){	
	$_SESSION['id_afiliado'] =$rs->fields['id'];
	$_SESSION['ced_afiliado'] = $rs->fields['cedula'];
	$_SESSION['nombre_afiliado'] = $rs->fields['nombres'];
	$_SESSION['apellido_afiliado'] = $rs->fields['apellidos'];
	$_SESSION['tipo_usuario'] = $rs->fields['tipo_usuario'];
	$_SESSION['usuario']=($_SESSION['nombre_afiliado'].' '.$_SESSION['apellido_afiliado'].' '.'CI: '.$_SESSION['ced_afiliado']);
	$_SESSION['sUnidadSustantiva']='0';
	$_SESSION['tipo_persona']=$_REQUEST['nacionalidad']; 
	$_SESSION['sUsuario']=$usuario;
}

include_once('../../mod_menu/header.php');

?>
<div style="height:72%">
<form name="form1" id="form1" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value=""/>
<input name="url" type="hidden" value="" />
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
	<tr>
    	<th align="center" class="titulo"></th>
    </tr>
</table>
</form>
</div>
<?
include_once('../../footer.php');
?>

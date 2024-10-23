<?php
include('../include/header.php');

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
//var_dump($_SESSION);
//function cambiar(){
//	echo "ID=".$_POST['id'];
//	unset($_SESSION['aTabla']);	
	
$sql="UPDATE scpt.empresa
SET nenabled=0     
WHERE id='".$_POST['id']."';";

	
$sql2="UPDATE scpt.miembros_empresa
SET 
nenabled=0, usuario_idactualizacion='".$_SESSION['usuario_id']."', 
dfecha_actualizacion= now()
WHERE empresa_id='".$_POST['id']."';";

$rs=$conn->Execute($sql);	
$rs4=$conn->Execute($sql2);

$sql_con="SELECT id, empresa_id, nenabled
  FROM scpt.empresa_motor 
  where empresa_id='".$_POST['id']."';";
  $rs_con=$conn->Execute($sql_con);
  
 if($rs_con->RecordCount()>0){
	 $empresa_motor_id=$rs_con->fields['id'];
	 
	$sql1="UPDATE scpt.empresa_motor
	SET nenabled=0,usuario_idactualizacion='".$_SESSION['usuario_id']."', 
	dfecha_actualizacion= now()
	WHERE empresa_id='".$_POST['id']."';";

	
	$sql3="UPDATE scpt.produccion
	SET usuario_idactualizacion='".$_SESSION['usuario_id']."', 
	dfecha_actualizacion= now(), nenabled=0
	WHERE empresa_motor_id='".$empresa_motor_id."';";
	
	$rs4=$conn->Execute($sql1);
	$rs4=$conn->Execute($sql3);
 } 
 
return  1;
//}
?>
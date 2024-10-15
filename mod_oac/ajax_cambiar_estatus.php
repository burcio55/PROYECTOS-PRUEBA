<?php
include("../header.php"); 

$settings['debug'] = true;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

//function cambiar(){
//	echo "ID=".$_POST['id'];
	unset($_SESSION['aTabla']);	
	$sq="UPDATE oac.detalle_oac
	SET id_status='1'
	WHERE id_detalle_atencion='".$_POST['id']."' and id_status=2";
	$rs4=$conn->Execute($sq);
	
	return true;
//}
?>
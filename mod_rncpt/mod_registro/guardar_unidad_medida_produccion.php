<?php
//-------------------------------------------
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug=false;
//-------------------------------------------
$SQL1= "SELECT id FROM medida WHERE sdescripcion='".ucwords($_POST['nueva_medida'])."' AND nenabled='1'";
						$rs1= $conn->Execute($SQL1);
if($rs1->RecordCount()>0){
	$valor="existe"; 
}else{


$SQL2= "INSERT INTO public.medida(sdescripcion, usuario_idcreacion, dfecha_creacion, nenabled)
		VALUES ( '".ucwords($_POST['nueva_medida'])."','".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."','1')";
	
								
				$rs2=$conn->Execute($SQL2);
				
							if($rs2){
								$valor="guardar"; 
							}else{
								$valor="error_guardar"; 
							}					
			
}
echo $valor;
?>
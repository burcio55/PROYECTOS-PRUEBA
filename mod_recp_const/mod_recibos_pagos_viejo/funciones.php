<?php
//-------------------------------
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db4);
$conn->debug = false;

//-------------------------------

switch($_POST['opcion']){
			case '1': //inhabilitar registro
						$SQL="UPDATE public.cargos
   							  SET nenabled='0', nusuario_actualizacion ='".$_SESSION['id_usuario']."', dfecha_actualizacion  ='".date('Y-m-d H:i:s')."'
 							  WHERE nenabled='1' and scodigo= '".$_REQUEST["codigo"]."'";
				    $rs= $conn->Execute($SQL);
						
						 if($rs){
								 $valor="actualizado";
							}else{
							  $valor="error_guardar";
						 }
 			break;
			case '2': //editar registro
						$SQL="SELECT sdescripcion, scodigo, ngrado, ntipo        
  							  FROM public.cargos
 									WHERE nenabled='1' and scodigo= '".$_REQUEST["codigo"]."'";
				    $rs= $conn->Execute($SQL);
						
								if ($rs->RecordCount()>0){
								 $valor=$rs->fields['sdescripcion']."|".
									$rs->fields['scodigo']."|".
									$rs->fields['ngrado']."|".
									$rs->fields['ntipo'];                                                                                                      
								}
 			break;
			case '3': //inhabilitar registro
						$SQL="UPDATE public.cargos
   							  SET nenabled='1',
							  nusuario_actualizacion   ='".$_SESSION['id_usuario']."',
      						  dfecha_actualizacion     ='".date('Y-m-d H:i:s')."'
 							  WHERE nenabled='0' and scodigo= '".$_REQUEST["codigo"]."'";
				    $rs= $conn->Execute($SQL);
						
						 if($rs){
								 $valor="actualizado";
							}else{
							  $valor="error_guardar";
						 }
 			break;	
}
echo $valor;
?>

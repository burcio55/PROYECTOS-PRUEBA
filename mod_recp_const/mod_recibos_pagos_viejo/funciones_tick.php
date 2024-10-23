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
										
				$SQL="	UPDATE recibos_pagos_constancias.tickets_alimentacion
   						SET dfecha_actualizacion='".date('Y-m-d H:i:s')."', 
						nusuario_actualizacion='".$_SESSION['id_usuario']."',
       					nenabled='0'
						WHERE nenabled='1' and ncodigo= '".$_REQUEST["codigo"]."'";

				    $rs= $conn->Execute($SQL);
						
						 if($rs){
								 $valor="actualizado";
							}else{
							  $valor="error_guardar";
						 }
 			break;
			case '2': //editar registro
			
			$SQL="SELECT ncodigo,nunidad_tributaria, nmonto, nporcentaje, smes
				  FROM recibos_pagos_constancias.tickets_alimentacion
				  WHERE nenabled='1' and ncodigo= '".$_REQUEST["codigo"]."'";	

				    $rs= $conn->Execute($SQL);
						
								if ($rs->RecordCount()>0){
								    $valor=$rs->fields['nunidad_tributaria']."|".
									$rs->fields['nmonto']."|".
									$rs->fields['nporcentaje']."|".
									$rs->fields['smes']."|".  
									$rs->fields['ncodigo'];                                                                                                    
								}
 			break;
			case '3': //inhabilitar registro
						$SQL="UPDATE recibos_pagos_constancias.tickets_alimentacion
   							  SET nenabled='1',
							  nusuario_actualizacion   ='".$_SESSION['id_usuario']."',
      						  dfecha_actualizacion     ='".date('Y-m-d H:i:s')."'
 							  WHERE nenabled='0' and ncodigo= '".$_REQUEST["codigo"]."'";
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

<?php
//-------------------------------------------
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug=false;
//-------------------------------------------

switch($_POST['opcion']){
			case '1': //Guardar
			if($_REQUEST['valor']==5){
				$SQL2="INSERT INTO ".$_POST['nombre']." (
								descripcion_cargo,
								usuario_idcreacion,
								dfecha_creacion, 
								nenabled)
		 VALUES('".strtoupper($_POST['txt_descripcion'])."',
						'".$_SESSION['usuario_id']."',
						'".date('Y-m-d H:i:s')."',
						'1')"; ;								
				$rs2=$conn->Execute($SQL2);
				
							if($rs2){
								$valor="guardar"; 
							}else{
								$valor="error_guardar"; 
							}	
				}else{
			
				$SQL2="INSERT INTO ".$_POST['nombre']." (
								sdescripcion,
								usuario_idcreacion,
								dfecha_creacion, 
								nenabled)
		 VALUES('".strtoupper($_POST['txt_descripcion'])."',
						'".$_SESSION['usuario_id']."',
						'".date('Y-m-d H:i:s')."',
						'1')"; ;								
				$rs2=$conn->Execute($SQL2);
				
							if($rs2){
								$valor="guardar"; 
							}else{
								$valor="error_guardar"; 
							}	
			}
			break;	
			case '2': //Editar
				if($_REQUEST['valor']==5){
					$SQL2="UPDATE ".$_POST['nombre']." SET 
						descripcion_cargo='".strtoupper($_POST['txt_descripcion'])."', 
						usuario_idactualizacion='".$_SESSION['usuario_id']."', 
						dfecha_actualizacion='".date('Y-m-d H:i:s')."'
						WHERE id='".$_POST['id']."' AND nenabled='1'" ;								
				$rs2=$conn->Execute($SQL2);
					}else{
				$SQL2="UPDATE ".$_POST['nombre']." SET 
						sdescripcion='".strtoupper($_POST['txt_descripcion'])."', 
						usuario_idactualizacion='".$_SESSION['usuario_id']."', 
						dfecha_actualizacion='".date('Y-m-d H:i:s')."'
						WHERE id='".$_POST['id']."' AND nenabled='1'" ;								
				$rs2=$conn->Execute($SQL2);
				}
							if($rs2){
								$valor="modificado"; 
							}else{
								$valor="error_guardar"; 
							}					
			break;			
			case '3': //ACTIVO-INACTIVO
			
					if($_REQUEST['valor']=='1') $nombre='scpt.motor';					
					if($_REQUEST['valor']=='2') $nombre='public.productos';
					if($_REQUEST['valor']=='3') $nombre='scpt.sector';
					if($_REQUEST['valor']=='4') $nombre='public.medida';
					if($_REQUEST['valor']=='5') $nombre='scpt.cargos';
				$SQL2="UPDATE ".$nombre." SET 
						nenabled='".$_POST['estatus']."', 
						usuario_idactualizacion='".$_SESSION['usuario_id']."', 
						dfecha_actualizacion='".date('Y-m-d H:i:s')."'
						WHERE id='".$_POST['id']."' " ;								
				$rs2=$conn->Execute($SQL2);
				
							if($rs2){
								$valor="exito"; 
							}else{
								$valor="error_guardar"; 
							}					
			break;	
}
		
echo $valor;
?>
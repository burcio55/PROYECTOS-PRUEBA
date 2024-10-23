<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
$conn->debug =true;

					  $sfecha=date('Y-m-d');
					  $sql="insert into empresa_instituto (rif, nombre, nil, ivss, rnee, inces, created_at, status, id_update,
					       sunidadsustantiva) values
					  ('".$_SESSION['rif']."',
					   '".$_SESSION['nombre_empresa']."',
					   '".$_GET['nil']."',
					   '".$_GET['ivs']."',
					   '".$_GET['rnee']."',
						 '".$_GET['inc']."',
					   '$sfecha',
					   'A',
					   '".$_SESSION['sUsuario']."',
					   '1')";
					   $conn->Execute($sql);
					   
						$SQL="select id, nombre From empresa_instituto where rif='".$_SESSION['rif']."'";
					  $rs1 = $conn->Execute($SQL);
					  if ($rs1->RecordCount()>0){ 				
						 $_SESSION['id_empresa']=$rs1->fields['id'];
						 $_SESSION['nombre_empresa']=$rs1->fields['nombre'];
					  
//Trazas-------------------------------------------------------------------------------------------------------------------			
				$id=$_SESSION['id_empresa'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='13';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
				unset($_SESSION['rnee']);
				
				header('location: 2_1agen_empresa.php');
				}		   	   

        

?>
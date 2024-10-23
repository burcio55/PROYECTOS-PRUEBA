<?php
session_start();
include("../include/header.php");
include("../include/bitacora.php");
$conn= getConnDB($db1);
$conn->debug=false;

debug();

if(isset($_GET['proceso'])){
	if($_GET['proceso'] == 1){
	$cbo_sistema=$_GET['cbo_sistema'];
	$cbo_roles=$_GET['cbo_roles'];
	
		$SQL1="SELECT modulo.id AS modulo_id, 
					   opcion.nmodulo AS opcion_modulo,
					   modulo.sdescripcion AS modulo,
					   opcion.nnivel AS nivel,
					   opcion.norden_salida AS orden,
					   opcion.nsalida AS salida,
					   opcion.id AS opciones_id, 
					   opcion.sdescripcion AS opciones,
					   opcion.surl AS url,
					   modulo.senabled AS modulo_enable    
				FROM opcion
				INNER JOIN modulo ON opcion.nmodulo = modulo.opcion_id
				WHERE opcion.nenabled = 1 
				AND modulo.senabled = 1
				AND opcion.norden_salida >= '0'
				AND modulo.id = '".$cbo_sistema."';";	
		$rs1 = $conn->Execute($SQL1);
		
			if ($rs1->RecordCount()>0){
				while(!$rs1->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;
					
					$aTabla[$c]['modulo_id']=trim($rs1->fields['modulo_id']);
					$aTabla[$c]['opcion_modulo']=trim($rs1->fields['opcion_modulo']);
					$aTabla[$c]['modulo']=trim($rs1->fields['modulo']);
					$aTabla[$c]['salida']=trim($rs1->fields['salida']);
					
					$aTabla[$c]['id']=trim($rs1->fields['opciones_id']);
					$aTabla[$c]['opciones']=trim($rs1->fields['opciones']);
					$aTabla[$c]['url']=trim($rs1->fields['url']);
					$aTabla[$c]['nivel']=trim($rs1->fields['nivel']);
					$aTabla[$c]['orden']=trim($rs1->fields['orden']);	
					
					$id_opcion=$rs1->fields['opciones_id'];

					$SQL2="SELECT id, nenabled FROM rolopcion WHERE opcion_id = '".$id_opcion."' AND rol_id = '".$cbo_roles."';";	
					$rs2 = $conn->Execute($SQL2);
					
					
					$enable = $rs2->fields['nenabled'];
					
					if ($rs2->RecordCount()>0 and $enable==1){
						$aTabla[$c]['checkbox']="checked";
						$aTabla[$c]['id_opcion']=trim($rs2->fields['id']);
					}else{
						$aTabla[$c]['checkbox']="";
						$aTabla[$c]['id_opcion']=0;
					}

					$rs1->MoveNext();
				}
			}
			
			echo json_encode($aTabla);	
	}

	if($_GET['proceso']==2){
	
		$rolopcion = $_GET['rolopcion'];
	
		$SQL3="UPDATE rolopcion SET nenabled=0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id= '".$rolopcion."';";	
		$rs3 = $conn->Execute($SQL3);
		
			$tabla = "public.rolopcion";
			$query = $SQL3;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
		
	}
	
	if($_GET['proceso']==3){
	
		$opcion = $_GET['opcion'];
		$id_rol = $_GET['rol'];
		$rolopcion = $_GET['rolopcion'];
	
		$SQL4="SELECT * FROM rolopcion WHERE opcion_id = '".$opcion."' AND rol_id = '".$id_rol."';";	
		$rs4 = $conn->Execute($SQL4);
		
		if ($rs4->RecordCount()>0){
			
			$rolopcion = $rs4->fields['id'];
	
			$SQL5="UPDATE rolopcion SET nenabled=1, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id= '".$rolopcion."';";	
			$rs5 = $conn->Execute($SQL5);

			$tabla = "public.rolopcion";
			$query = $SQL5;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
			
		}else{
			$SQL6="INSERT INTO rolopcion(opcion_id, rol_id, nenabled, dfecha_creacion, nusuario_creacion) VALUES ('".$opcion."', '".$id_rol."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
			$rs6 = $conn->Execute($SQL6);
			
			$tabla = "public.rolopcion";
			$query = $SQL6;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
		}
		
	}
	
	if($_GET['proceso']==4){
	
		$sistema = $_GET['sistema'];
		$rol = $_GET['rol'];
		
		$SQL7="SELECT modulo.id AS modulo_id, 
					   opcion.nmodulo AS opcion_modulo,
					   modulo.sdescripcion AS modulo,
					   opcion.nnivel AS nivel,
					   opcion.norden_salida AS orden,
					   opcion.nsalida AS salida,
					   opcion.id AS opciones_id, 
					   opcion.sdescripcion AS opciones,
					   opcion.surl AS url,
					   modulo.senabled AS modulo_enable    
				FROM opcion
				INNER JOIN modulo ON opcion.nmodulo = modulo.opcion_id
				WHERE opcion.nenabled = 1 
				AND modulo.senabled = 1
				AND opcion.norden_salida != '0'
				AND modulo.id = '".$sistema."';";	
		$rs7 = $conn->Execute($SQL7);
		
		if ($rs7->RecordCount()>0){
			while(!$rs7->EOF){
			
			$opciones_id = $rs7->fields['opciones_id'];

			$SQL8="SELECT * FROM rolopcion WHERE opcion_id = '".$opciones_id."' AND rol_id = '".$rol."';";	
			$rs8 = $conn->Execute($SQL8);
			
				if ($rs8->RecordCount()>0){
				
				$nenabled = $rs8->fields['nenabled'];
				
					if($nenabled == 0){
					
						$rolopcion = $rs8->fields['id'];
				
						$SQL9="UPDATE rolopcion SET nenabled=1, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id= '".$rolopcion."';";	
						$rs9 = $conn->Execute($SQL9);
			
						$tabla = "public.rolopcion";
						$query = $SQL9;                                        
						$esquema = "public";
						bitacora($tabla,$query,$conn,$esquema);
					
					}
					
				}else{
				
					$SQL10="INSERT INTO rolopcion(opcion_id, rol_id, nenabled, dfecha_creacion, nusuario_creacion) VALUES ('".$opciones_id."', '".$rol."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
					$rs10 = $conn->Execute($SQL10);
					
					$tabla = "public.rolopcion";
					$query = $SQL10;                                       
					$esquema = "public";
					bitacora($tabla,$query,$conn,$esquema);	
					
				}

			$rs7->MoveNext();
			}
		}
	
		
	}

	if($_GET['proceso']==5){
	
		$sistema = $_GET['sistema'];
		$rol = $_GET['rol'];
			
			$SQL11="SELECT modulo.id AS modulo_id, 
						   opcion.nmodulo AS opcion_modulo,
						   modulo.sdescripcion AS modulo,
						   opcion.nnivel AS nivel,
						   opcion.norden_salida AS orden,
						   opcion.nsalida AS salida,
						   opcion.id AS opciones_id, 
						   opcion.sdescripcion AS opciones,
						   opcion.surl AS url,
						   modulo.senabled AS modulo_enable    
					FROM opcion
					INNER JOIN modulo ON opcion.nmodulo = modulo.opcion_id
					WHERE opcion.nenabled = 1 
					AND modulo.senabled = 1
					AND opcion.norden_salida = '0'
					AND modulo.id = '".$sistema."';";	
			$rs11 = $conn->Execute($SQL11);
			
			$rolopcion = $rs11->fields['opciones_id'];
	
			echo $SQL12="UPDATE rolopcion SET nenabled=0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE rol_id= '".$rol."' AND opcion_id != '".$rolopcion."' ;";	
			$rs12 = $conn->Execute($SQL12);
		
			$tabla = "public.personales_rol";
			$query = $SQL12;
            $esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
		
	}
	
}
?>
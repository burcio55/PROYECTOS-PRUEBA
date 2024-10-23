<?php
session_start();
include("../include/header.php");
include("../include/bitacora.php");
include("../include/seguridad.php");
$conn= getConnDB($db1);
$conn-> debug=false;

debug();
if(isset($_GET['proceso'])){
//--------------------------------------------------------------------------------------------------------------------------
	if($_GET['proceso'] == 1){
	$modulo = $_GET['modulo'];
	
		$SQL1="SELECT modulo.id AS modulo_id, 
					   opcion.nmodulo AS opcion_modulo,
					   modulo.sdescripcion AS modulo,
					   opcion.nnivel AS nivel,
					   opcion.norden_salida AS orden,
					   opcion.nsalida AS salida,
					   opcion.id AS opciones_id, 
					   opcion.sdescripcion AS opciones,
					   opcion.surl AS url,
					   opcion.nenabled AS opcion_enable    
				FROM opcion
				INNER JOIN modulo ON opcion.nmodulo = modulo.opcion_id
				WHERE opcion.norden_salida != '0'
				AND modulo.id = '".$modulo."';";	
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
					$aTabla[$c]['nivelpinta']=trim($rs1->fields['nivel']);
					
					$niveltabla=trim($rs1->fields['nivel']);
						
						if($niveltabla == 0){$aTabla[$c]['nivel']=0;}//
						if($niveltabla == 1){$aTabla[$c]['nivel']=1;}//
						if($niveltabla == 2){$aTabla[$c]['nivel']=2;}//
						if($niveltabla == 3){$aTabla[$c]['nivel']=3;}//
					
					$aTabla[$c]['orden']=trim($rs1->fields['orden']);	
					$enable=trim($rs1->fields['opcion_enable']);
					
					if ($enable==1){
						$aTabla[$c]['checkbox']="checked";
					}else{
						$aTabla[$c]['checkbox']="";
					}					
											
					$rs1->MoveNext();
				}
			}
			
			echo json_encode($aTabla);	
	} 
//--------------------------------------------------------------------------------------------------------------------------
	if($_GET['proceso'] == 2){
		
		$opcion = $_GET['opcion'];
	
		$SQL2="SELECT * FROM opcion WHERE nmodulo = '".$opcion."' AND surl ='#';";	
		$rs2 = $conn->Execute($SQL2);
		$registro = $rs2->RecordCount();
		
		if($registro > 0){
		
			$datos = array("response"=>"success");  
			echo json_encode($datos);
		
		}else{
			$datos = array("response"=>"nosuccess", "mensaje"=>"ANTES DE CREAR UN OPCION DEBE CREAR AL MENOS UNA OPCION MENU");  
			echo json_encode($datos);
		}

	}
//--------------------------------------------------------------------------------------------------------------------------	
	if($_GET['proceso'] == 3){
		
		$opcion = $_GET['opt'];
	
		$SQL3="UPDATE opcion SET nenabled=0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id='".$opcion."';";	
		$rs3 = $conn->Execute($SQL3);
		
		$tabla = "public.opcion";
		$query = $SQL3;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);
	
	}
//--------------------------------------------------------------------------------------------------------------------------	
	if($_GET['proceso'] == 4){
	
		$opcion = $_GET['opt'];
	
		$SQL4="UPDATE opcion SET nenabled=1, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id='".$opcion."';";	
		$rs4 = $conn->Execute($SQL4);
		
		$tabla = "public.opcion";
		$query = $SQL4;                                       
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);			
	
	}
//--------------------------------------------------------------------------------------------------------------------------	
	if($_GET['proceso'] == 5){
	
		$opcion = $_GET['id'];
		
		$SQL5="SELECT id,
			   sdescripcion, 
			   surl, 
			   nnivel, 
			   nsalida, 
			   norden_salida
		FROM opcion
		WHERE id = '".$opcion."';";	
		$rs5 = $conn->Execute($SQL5);
		
		$id = $rs5->fields['id'];
		$sdescripcion = $rs5->fields['sdescripcion'];
		$surl = $rs5->fields['surl'];
		$nnivel = $rs5->fields['nnivel'];
		$nnivelmuestra = $rs5->fields['nnivel'];
		$nsalida = $rs5->fields['nsalida'];
		$norden_salida = $rs5->fields['norden_salida'];
		
		
		$datos = array("response"=>"success", "id"=>$id, "sdescripcion"=>$sdescripcion, "surl"=>$surl, "nnivel"=>$nnivel, "nnivelmuestra"=>$nnivelmuestra, "nsalida"=>$nsalida, "norden_salida"=>$norden_salida);  
		echo json_encode($datos);
	
	}
//--------------------------------------------------------------------------------------------------------------------------	
	if($_GET['proceso'] == 6){
	
		$opcion = $_GET['opcion'];
	
		$SQL6="SELECT * FROM opcion WHERE id = '".$opcion."' AND surl ='#';";	
		$rs6 = $conn->Execute($SQL6);
		
		$nnivel = $rs6->fields['nnivel']+1;
		
		$datos = array("response"=>"success", "nnivel"=>$nnivel);  
		echo json_encode($datos);
	
	}
//--------------------------------------------------------------------------------------------------------------------------	
	if($_GET['proceso'] == 7){
	
		$id_opcion_menu = $_GET['id_opcion_menu'];
		$Orden = $_GET['Orden'];
		$descripcion_opcion =strtoupper( $_GET['descripcion_opcion']);
		$nivel = $_GET['nivel'];
					
		if($_GET['tipooption'] == 1){
			$cbo_menu = 0;
		}else{
			$cbo_menu = $_GET['cbo_menu'];
		}
		
		$SQL7="UPDATE opcion SET sdescripcion='".$descripcion_opcion."', 
								 surl='#', 
								 nnivel='".$nivel."', 
								 nsalida='".$cbo_menu."', 
								 norden_salida='".$Orden."', 
								 dfecha_actualizacion='".date('Y-m-d H:i:s')."', 
								 nusuario_actualizacion='".$_SESSION['id_usuario']."' 
			   WHERE id='".$id_opcion_menu."';";	
		$rs7 = $conn->Execute($SQL7);
		
		$tabla = "public.opcion";
		$query = $SQL7;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);
		
	}
//--------------------------------------------------------------------------------------------------------------------------
	if($_GET['proceso'] == 8){
	
		$id_opcion_menu = $_GET['id_opcion_menu'];
		$cbo_menu = $_GET['cbo_menu'];
		$Orden = $_GET['Orden'];
		$descripcion_opcion = ucwords($_GET['descripcion_opcion']);
		$url = $_GET['url'];
		$nivel = $_GET['nivel'];
		
		$SQL8="UPDATE opcion SET sdescripcion='".$descripcion_opcion."', 
								 surl='".$url."', 
								 nnivel='".$nivel."', 
								 nsalida='".$cbo_menu."', 
								 norden_salida='".$Orden."', 
								 dfecha_actualizacion='".date('Y-m-d H:i:s')."', 
								 nusuario_actualizacion='".$_SESSION['id_usuario']."' 
				WHERE id='".$id_opcion_menu."';";	
		$rs8 = $conn->Execute($SQL8);
		
		$tabla = "public.opcion";
		$query = $SQL8;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);
		
	}
//--------------------------------------------------------------------------------------------------------------------------
	if($_GET['proceso'] == 9){
	
		$opcion = $_GET['opcion'];
		$Orden = $_GET['Orden'];
		$descripcion_opcion = strtoupper($_GET['descripcion_opcion']);
		$nivel = $_GET['nivel'];
		
		if($_GET['tipooption'] == 1){
			$cbo_menu = 0;
		}else{
			$cbo_menu = $_GET['cbo_menu'];
		}
		
		$SQL9="INSERT INTO opcion(sdescripcion, surl, nnivel, nsalida, norden_salida, nmodulo, nenabled, dfecha_creacion, nusuario_creacion)
   			   VALUES ('".$descripcion_opcion."', '#', '".$nivel."', '".$cbo_menu."', '".$Orden."', '".$opcion."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
		$rs9 = $conn->Execute($SQL9);
		
		$tabla = "public.opcion";
		$query = $SQL9 ;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);	
	
	}
//--------------------------------------------------------------------------------------------------------------------------
	if($_GET['proceso'] == 10){
		
		$opcion = $_GET['opcion'];
		$tipooption = $_GET['tipooption'];
		$Orden = $_GET['Orden'];
		$descripcion_opcion = ucwords($_GET['descripcion_opcion']);
		$url = $_GET['url'];
		$cbo_menu = $_GET['cbo_menu'];
		$nivel = $_GET['nivel'];
		
		$SQL10="INSERT INTO opcion(sdescripcion, surl, nnivel, nsalida, norden_salida, nmodulo, nenabled, dfecha_creacion, nusuario_creacion)
   			   VALUES ('".$descripcion_opcion."', '".$url."', '".$nivel."', '".$cbo_menu."', '".$Orden."', '".$opcion."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
		$rs10 = $conn->Execute($SQL10);
		
		$tabla = "public.opcion";
		$query = $SQL10;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);	
	
	}
//--------------------------------------------------------------------------------------------------------------------------
	if($_GET['proceso'] == 11){
		
		$id = $_GET['id'];
		
		$SQL11="SELECT * FROM opcion WHERE surl = '#' AND id = '".$id."';";	
		$rs11 = $conn->Execute($SQL11);
		$registro1 = $rs11->RecordCount();
		
		$SQL12="SELECT * FROM opcion WHERE surl != '#' AND nsalida = '".$id."';";	
		$rs12 = $conn->Execute($SQL12);
		$registro2 = $rs12->RecordCount();
		
		if($registro1 > 0 && $registro2 > 0){
			$datos = array("response"=>"nosuccess", "mensaje"=>"IMPOSIBLE ELIMINAR LA OPCION YA QUE EN UN MENU PADRE");  
				echo json_encode($datos);
		}else{

			$SQL13="SELECT * FROM rolopcion WHERE opcion_id = '".$id."';";	
			$rs13 = $conn->Execute($SQL13);
			$registro3 = $rs13->RecordCount();
			
			if($registro3 > 0){
				$datos = array("response"=>"nosuccess", "mensaje"=>"IMPOSIBLE ELIMINAR LA OPCION YA QUE SE ENCUENTRA ASOCIADO A UN ROL");  
				echo json_encode($datos);
			}else{
				$SQL14="DELETE FROM opcion WHERE id = '".$id."';";	
				$rs14 = $conn->Execute($SQL14);
				
					$tabla = "public.opcion";
					$query = $SQL14;                                        
					$esquema = "public";
					bitacora($tabla,$query,$conn,$esquema);
					
				$datos = array("response"=>"success");  
				echo json_encode($datos);
			}
			
		}
	
	}
//--------------------------------------------------------------------------------------------------------------------------
}
?>
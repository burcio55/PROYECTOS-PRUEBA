<?php
if(isset($_GET['proceso'])){
	if($_GET['proceso'] == 1){
?>
<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
	<?php } ?>
<?php } ?>

<?php
session_start();
include("../include/header.php");
include("../include/bitacora.php");
include("../include/seguridad.php");
$conn= getConnDB($db1);
$conn->debug=false;

debug();
if(isset($_GET['proceso'])){
	if($_GET['proceso'] == 1){
		$SQL1="SELECT modulo.id AS modulo_id, 
					   modulo.sdescripcion AS modulo,
					   opcion.nmodulo AS opcion_id, 
					   opcion.sdescripcion AS opcion,
					   opcion.nnivel AS menu_nivel, 
					   opcion.nsalida AS menu_grupo, 
					   opcion.norden_salida AS orden_grupo,
					   opcion.surl AS url,
					   modulo.slogo AS logo_1,
					   modulo.slogo2 AS logo_2,
					   modulo.senabled AS modulo_enable,
					   opcion.nenabled AS opcion_enable
				FROM modulo
				INNER JOIN opcion ON modulo.opcion_id = opcion.id ORDER BY modulo.sdescripcion ASC;";	
		$rs1 = $conn->Execute($SQL1);
		
		unset($_SESSION['aTabla_contenido']);	
			$_SESSION['EOF']=$rs1->RecordCount();
				if ($rs1->RecordCount()>0){
					while(!$rs1->EOF){
						$aTabla[]=array();
						$c = count($aTabla)-1;
						
						$aTabla[$c]['modulo']=$rs1->fields['modulo_id'];
						$aTabla[$c]['opciones']=$rs1->fields['opcion_id'];
						$aTabla[$c]['descripcion']=$rs1->fields['modulo'];
						$aTabla[$c]['url']=$rs1->fields['url'];
						$enable=$rs1->fields['modulo_enable'];
						
						if ($enable==1){
							$aTabla[$c]['checkbox']="checked";
						}else{
							$aTabla[$c]['checkbox']="";
						}
	
						$rs1->MoveNext();
					}
					$_SESSION['aTabla_contenido'] = $aTabla;
				}else{
					unset($_SESSION['aTabla_contenido']);
				}
	
	?> 
	
	<div>
		<table class="display" border="0" align="center" id="tblDetalle" width="100%">
			<thead>
				<tr>
					<th width="40%" align="left" class="sub_titulo"><div align="center">DESCRIPCION</div></th>
					<th width="10%" align="left" class="sub_titulo"><div align="center">ACCCESO</div></th>
					<th width="60%" align="left" class="sub_titulo"><div align="center">ACCIONES</div></th>
					
	
				</tr>
				<tbody>
				   <?
					$aTabla=$_SESSION['aTabla_contenido'];
					$aDefaultForm = $GLOBALS['aDefaultForm'];
					for( $c=0; $c<count($aTabla); $c++){		
					?>
					
					<tr>
						<td width="40%" class="texto-normal" align="left"><? echo $aTabla[$c]['descripcion']?></td>
						<td width="10%" class="texto-normal" align="center"><input id="mod<? echo $aTabla[$c]['modulo']?>" name="mod<? echo $aTabla[$c]['modulo']?>" type="checkbox" value="<? echo $aTabla[$c]['modulo']?>" <? echo $aTabla[$c]['checkbox']?> onclick="javascript:procesaroption('<? echo $aTabla[$c]['modulo']; ?>', '<? echo $aTabla[$c]['opciones']; ?>')"/></td>
						<td width="60%" class="texto-normal" align="center">
						<button type="button" class="button_personal btn_editar" onclick="javascript:editar('<? echo $aTabla[$c]['modulo']; ?>', '<? echo $aTabla[$c]['opciones']; ?>');" title="Haga Click para Editar">Editar</button> 
						<button type="button" class="button_personal btn_agregar" onclick="javascript:roles('<? echo encrypt($aTabla[$c]['modulo']); ?>', '<? echo encrypt($aTabla[$c]['opciones']); ?>');" title="Haga Click para Agregrar Roles">Rol</button> 
						<button type="button" class="button_personal btn_agregar" onclick="javascript:opciones('<? echo encrypt($aTabla[$c]['modulo']); ?>', '<? echo encrypt($aTabla[$c]['opciones']); ?>');" title="Haga Click para Agregrar Opciones">Opcion</button> 
						<button type="button" class="button_personal btn_eliminar" onclick="javascript:eliminar('<? echo $aTabla[$c]['opciones']; ?>');" title="Haga Click para Eliminar">Eliminar</button></td>
					</tr>
					<? 
					} 
					?>	
				</tbody>
			</thead>
		</table>
	</div>
	
	<?php } ?>
	<?php
	if($_GET['proceso'] == 2){
	$opciones = $_GET['opciones'];
		$SQL2="SELECT modulo.id AS modulo_id, 
					   modulo.sdescripcion AS modulo,
					   opcion.nmodulo AS opcion_id, 
					   opcion.sdescripcion AS opcion,
					   opcion.nnivel AS menu_nivel, 
					   opcion.nsalida AS menu_grupo, 
					   opcion.norden_salida AS orden_grupo,
					   opcion.surl AS url,
					   modulo.slogo AS logo_1,
					   modulo.slogo2 AS logo_2,
					   modulo.senabled AS modulo_enable,
					   opcion.nenabled AS opcion_enable
				FROM modulo
				INNER JOIN opcion ON modulo.opcion_id = opcion.id 
				WHERE opcion_id = '".$opciones."' ORDER BY modulo.sdescripcion ASC;";	
		$rs2 = $conn->Execute($SQL2);
		
		$modulo_id = $rs2->fields['modulo_id'];
		$descripcion = $rs2->fields['modulo'];
		$opcion_id = $rs2->fields['opcion_id'];
		$direccionurl = $rs2->fields['url'];
		$logo1 = $rs2->fields['logo_1'];
		$logo2 = $rs2->fields['logo_2'];
		
		$datos = array("response"=>"success", "descripcion"=>$descripcion, "direccionurl"=>$direccionurl, "logo1"=>$logo1, "logo2"=>$logo2, "modulo_id"=>$modulo_id, "opcion_id"=>$opcion_id);  
		
		echo json_encode($datos);

	}
	
	if($_GET['proceso'] == 3){
		
		$modulo = $_GET['modulo'];
		$opciones = $_GET['opciones'];
	
		$SQL3="UPDATE modulo SET senabled = 0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$modulo."';";	
		$rs3 = $conn->Execute($SQL3);
		
			$tabla = "public.modulo";
			$query = $SQL3;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
		
		$SQL4="UPDATE opcion SET nenabled = 0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$opciones."';";	
		$rs4 = $conn->Execute($SQL4);
		
			$tabla = "public.opcion";
			$query = $SQL4;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
	
	}
	
	if($_GET['proceso'] == 4){
	
		$modulo = $_GET['modulo'];
		$opciones = $_GET['opciones'];
	
		$SQL5="UPDATE modulo SET senabled = 1, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$modulo."';";	
		$rs5 = $conn->Execute($SQL5);
		
			$tabla = "public.modulo";
			$query = $SQL5;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);
		
		$SQL6="UPDATE opcion SET nenabled = 1, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$opciones."';";	
		$rs6 = $conn->Execute($SQL6);

			$tabla = "public.opcion";
			$query = $SQL6;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);		
	
	}
	
	if($_GET['proceso'] == 5){
	
		$modulo = $_GET['modulo'];
		$opciones = $_GET['opciones'];
		$descripcion = strtoupper($_GET['descripcion']);
		$url = $_GET['url'];
		$imagen1 = $_GET['imagen1'];
		$imagen2 = $_GET['imagen2'];
	
		$SQL6="UPDATE modulo SET sdescripcion='".$descripcion."', slogo='".$imagen1."', slogo2='".$imagen2."', dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$modulo."';";	
		$rs6 = $conn->Execute($SQL6);
		
			$tabla = "public.modulo";
			$query = $SQL6;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);
		
		$SQL7="UPDATE opcion SET surl='".$url."', dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$opciones."';";	
		$rs7 = $conn->Execute($SQL7);

			$tabla = "public.opcion";
			$query = $SQL7;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);		
	
	}
	
	if($_GET['proceso'] == 6){
	
		$descripcion = strtoupper($_GET['descripcion']);
		$url = $_GET['url'];
		$imagen1 = $_GET['imagen1'];
		$imagen2 = $_GET['imagen2'];
		
		$SQL8="SELECT * FROM modulo WHERE sdescripcion = '".$descripcion."';";	
		$rs8 = $conn->Execute($SQL8);
		$registro = $rs8->RecordCount();
		
		if($registro > 0){
			$datos = array("response"=>"nosuccess", "mensaje"=>"IMPOSIBLE AGREGAR EL MODULO YA QUE SE ENCUENTRA REGISTRADO");  
			echo json_encode($datos);
		}else{

		$SQL9="SELECT last_value +1 AS id from opcion_id_seq;";	
		$rs9 = $conn->Execute($SQL9);
		$id_max = $rs9->fields['id'];
		
		$SQL10="INSERT INTO opcion(sdescripcion, surl, nnivel, nsalida, norden_salida, nmodulo, nenabled, dfecha_creacion, nusuario_creacion) VALUES ('MENU PRINCIPAL', '".$url."', 0, 0, 0, '".$id_max."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
		$rs10 = $conn->Execute($SQL10);
		
			$tabla = "public.opcion";
			$query = $SQL10;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);
		
		$SQL11="INSERT INTO modulo(sdescripcion, slogo, opcion_id, slogo2, dfecha_creacion, nusuario_creacion, senabled) VALUES ('".$descripcion."', '".$imagen1."', '".$id_max."', '".$imagen2."', '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."', 1);";	
		$rs11 = $conn->Execute($SQL11);
		
			$tabla = "public.modulo";
			$query = $SQL11;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);
			
			$datos = array("response"=>"success");  
			echo json_encode($datos);
		}
	
	}
	
	if($_GET['proceso'] == 7){
		
		$opcion = $_GET['opcion'];
		
		$SQL12="SELECT * FROM opcion WHERE nmodulo = '".$opcion."' AND surl ='#';";	
		$rs12 = $conn->Execute($SQL12);
		$registro1 = $rs12->RecordCount();
		
		$SQL13="SELECT * FROM rolopcion WHERE opcion_id = '".$opcion."';";	
		$rs13 = $conn->Execute($SQL13);
		$registro2 = $rs13->RecordCount();
		
		if($registro1 > 0 || $registro2 > 0 || $opcion == 76){
			$datos = array("response"=>"nosuccess", "mensaje"=>"IMPOSIBLE ELIMINAR EL MODULO YA QUE TIENE OPCIONES O ROLES ASOCIADOS");  
			echo json_encode($datos);
		}else{
			$SQL14="DELETE FROM modulo WHERE opcion_id = '".$opcion."';";	
			$rs14 = $conn->Execute($SQL14);
			
				$tabla = "public.modulo";
				$query = $SQL14;                                        
				$esquema = "public";
				bitacora($tabla,$query,$conn,$esquema);
				
			$SQL15="DELETE FROM opcion WHERE id = '".$opcion."';";	
			$rs15 = $conn->Execute($SQL15);
			
				$tabla = "public.rol";
				$query = $SQL15;                                        
				$esquema = "public";
				bitacora($tabla,$query,$conn,$esquema);
				
			$datos = array("response"=>"success");  
			echo json_encode($datos);
		}
	}
	?>

<?php } ?>
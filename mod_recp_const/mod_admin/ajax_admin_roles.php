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
	
	$modulo = $_GET['modulo'];
	
		$SQL1="SELECT id, sdescripcion, modulo_id, nadministrador, nenabled FROM rol WHERE modulo_id = '".$modulo."' ORDER BY sdescripcion ASC;";	
		$rs1 = $conn->Execute($SQL1);
		
		unset($_SESSION['aTabla_contenido']);	
			$_SESSION['EOF']=$rs1->RecordCount();
				if ($rs1->RecordCount()>0){
					while(!$rs1->EOF){
						$aTabla[]=array();
						$c = count($aTabla)-1;
						
						$aTabla[$c]['id']=$rs1->fields['id'];
						$aTabla[$c]['sdescripcion']=$rs1->fields['sdescripcion'];
						$aTabla[$c]['modulo_id']=$rs1->fields['modulo_id'];
						$nadministrador=$rs1->fields['nadministrador'];
						$enable=$rs1->fields['nenabled'];
						
						if ($enable==1){
							$aTabla[$c]['checkbox']="checked";
						}else{
							$aTabla[$c]['checkbox']="";
						}
						
						if ($nadministrador==1){
							$aTabla[$c]['nadministrador']="PROGRAMADOR";
						}
						if ($nadministrador==0){
							$aTabla[$c]['nadministrador']="USUARIO";
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
					<th width="45%" align="left" class="sub_titulo"><div align="center">DESCRIPCION</div></th>
					<th width="10%" align="left" class="sub_titulo"><div align="center">ACCCESO</div></th>
					<th width="15%" align="left" class="sub_titulo"><div align="center">VISTO</div></th>
					<th width="30%" align="left" class="sub_titulo"><div align="center">ACCIONES</div></th>
					
	
				</tr>
				<tbody>
				   <?
					$aTabla=$_SESSION['aTabla_contenido'];
					$aDefaultForm = $GLOBALS['aDefaultForm'];
					for( $c=0; $c<count($aTabla); $c++){		
					?>
					
					<tr>
						<td width="45%" class="texto-normal" align="left"><? echo strtoupper($aTabla[$c]['sdescripcion'])?></td>
						<td width="10%" class="texto-normal" align="center"><input id="rol<? echo $aTabla[$c]['id']?>" name="mod<? echo $aTabla[$c]['id']?>" type="checkbox" value="<? echo $aTabla[$c]['id']?>" <? echo $aTabla[$c]['checkbox']?> onclick="javascript:procesaroption('<? echo $aTabla[$c]['id']; ?>', '<? echo $aTabla[$c]['modulo_id']; ?>')"/></td>
						<td width="15%" class="texto-normal" align="center"><?=$aTabla[$c]['nadministrador']?> </td>
						<td width="40%" class="texto-normal" align="center">
						<button type="button" class="button_personal btn_editar" onclick="javascript:editar('<? echo $aTabla[$c]['id']; ?>', '<? echo $aTabla[$c]['modulo_id']; ?>');" title="Haga Click para Editar">Editar</button> 
						<button type="button" class="button_personal btn_eliminar" onclick="javascript:eliminar('<? echo $aTabla[$c]['id']; ?>');" title="Haga Click para Eliminar">Eliminar</button></td>
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
		
		$rol = $_GET['rol'];
	
		$SQL2="SELECT id, sdescripcion, nadministrador FROM rol WHERE id = '".$rol."';";	
		$rs2 = $conn->Execute($SQL2);
		
		$rol_id = $rs2->fields['id'];
		$descripcion = $rs2->fields['sdescripcion'];
		$nadministrador = $rs2->fields['nadministrador'];

		
		$datos = array("response"=>"success", "descripcion"=>$descripcion, "rol_id"=>$rol_id, "nadministrador"=>$nadministrador);  
		
		echo json_encode($datos);

	}
	
	if($_GET['proceso'] == 3){
		
		$rol = $_GET['rol'];
	
		$SQL3="UPDATE rol SET nenabled = 0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$rol."';";	
		$rs3 = $conn->Execute($SQL3);
		
			$tabla = "public.rol";
			$query = $SQL3;                                       
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
		
	}
	
	if($_GET['proceso'] == 4){
	
		$rol = $_GET['rol'];
	
		$SQL4="UPDATE rol SET nenabled = 1, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id = '".$rol."';";	
		$rs4 = $conn->Execute($SQL4);
		
			$tabla = "public.rol";
			$query = $SQL4;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
			
	
	}
	
	if($_GET['proceso'] == 5){
	
		$rol_id = $_GET['rol_id'];
		$descripcionrol = strtoupper($_GET['descripcionrol']);
		$cbo_administrador = $_GET['cbo_administrador'];
	
		echo $SQL5="UPDATE rol SET sdescripcion='".$descripcionrol."', dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."', nadministrador= '".$cbo_administrador."' WHERE id = '".$rol_id."';";	
		$rs5 = $conn->Execute($SQL5);
		
			$tabla = "public.rol";
			$query = $SQL5;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);
			
	
	}
	
	if($_GET['proceso'] == 6){ // FALTA AGREGAR EL ROL A LA OPCIONES QUE SE CREARON PREVIAMENTE DE MENU PRINCIPAL
		
		$modulo = $_GET['modulo'];
		$descripcionrol = strtoupper($_GET['descripcionrol']);
		$opcion_id = $_GET['opcion_id'];
		$cbo_administrador = $_GET['cbo_administrador'];
	
		$SQL6="INSERT INTO rol(sdescripcion, nenabled, dfecha_creacion, nusuario_creacion, modulo_id, nadministrador) VALUES ('".$descripcionrol."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."', '".$modulo."', '".$cbo_administrador."');";	
		$rs6 = $conn->Execute($SQL6);
		
			$tabla = "public.rol";
			$query = $SQL6;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);
			
		$SQL7="SELECT * FROM rol WHERE sdescripcion = '".$descripcionrol."' AND  modulo_id = '".$modulo."';";	
		$rs7 = $conn->Execute($SQL7);
		$id_rol = $rs7->fields['id'];
		
		/*$SQL8="INSERT INTO rolopcion(opcion_id, rol_id, nenabled, dfecha_creacion, nusuario_creacion) VALUES ('".$opcion_id."', '".$id_rol."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
			$rs8 = $conn->Execute($SQL8);
			
			$tabla = "public.rolopcion";
			$query = $SQL8;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);*/	
	
	}
	
	if($_GET['proceso'] == 7){
		
		$rol = $_GET['rol'];
		
		$SQL9="SELECT * FROM rolopcion WHERE rol_id = '".$rol."';";	
		$rs9 = $conn->Execute($SQL9);
		$registro = $rs9->RecordCount();
		
		if($registro > 0){
			$datos = array("response"=>"nosuccess", "mensaje"=>"IMPOSIBLE ELIMINAR EL ROL YA QUE SE ENCUENTRA ASOCIADO CON UNA OPCION");  
			echo json_encode($datos);
		}else{
			$SQL10="DELETE FROM rol WHERE id = '".$rol."';";	
			$rs10 = $conn->Execute($SQL10);
			
				$tabla = "public.rol";
				$query = $SQL10;                                        
				$esquema = "public";
				bitacora($tabla,$query,$conn,$esquema);
				
			$datos = array("response"=>"success");  
			echo json_encode($datos);
		}
	}
	?>

<?php } ?>
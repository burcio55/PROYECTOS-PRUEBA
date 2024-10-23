<?php
if(isset($_GET['proceso'])){
	if($_GET['proceso'] == 1){
?>
<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
	<?php } ?>
<?php } ?>

<?php
session_start();
include("../../include/header.php");
include("../../include/bitacora.php");
$conn= getConnDB($db1);
$conn->debug=false;

debug();

if(isset($_GET['proceso'])){
	if($_GET['proceso'] == 1){
	
		$rolopcion = $_GET['cbo_roles'];
	
		$SQL1="SELECT id, 
       			      cedula, 
					  (primer_apellido||' '||segundo_apellido||' '||primer_nombre||' '||segundo_nombre) AS descripcion 
			   FROM personales 
			   WHERE nenabled = 1 
			   ORDER BY primer_apellido ;";	
		$rs1 = $conn->Execute($SQL1);
		
		unset($_SESSION['aTabla_contenido']);	
			$_SESSION['EOF']=$rs1->RecordCount();
			if ($rs1->RecordCount()>0){
				while(!$rs1->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;
					
					$aTabla[$c]['id_usuario']=trim($rs1->fields['id']);
					//$aTabla[$c]['cedula_formato']=number_format(trim($rs1->fields['cedula']),0,',','.');
					$aTabla[$c]['cedula']=trim($rs1->fields['cedula']);
					$aTabla[$c]['descripcion']=strtoupper(trim($rs1->fields['descripcion']));
					$aTabla[$c]['salida']=trim($rs1->fields['salida']);	
					
					$cedula=$rs1->fields['cedula'];
					
					$SQL2 ="SELECT id, personales_cedula, rol_id, nenabled FROM personales_rol WHERE personales_cedula = '".$cedula."' AND rol_id = '".$rolopcion."';";
					$rs2 = $conn->Execute($SQL2);
					
					$aTabla[$c]['id_rol']=trim($rs2->fields['id']);
					$enable = $rs2->fields['nenabled'];
					
					if ($rs2->RecordCount()>0 and $enable==1){
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
					<th width="20%" class="sub_titulo"><div align="center">C&eacute;dula de Identidad</div></th>
					<th width="70%" class="sub_titulo"><div align="left">Nombres y Apellidos</div></th>
					<th width="10%" class="sub_titulo"><div align="center">Acceso</div></th>
	
				</tr>
				<tbody>
				   <?
					$aTabla=$_SESSION['aTabla_contenido'];
					$aDefaultForm = $GLOBALS['aDefaultForm'];
					for( $c=0; $c<count($aTabla); $c++){
					
					?>
					
					<tr style="<? echo $style?>">
						<td width="20%" class="texto-normal" align="center"><? echo $aTabla[$c]['cedula']?></td>
						<td width="70%" class="texto-normal" align="left"><? echo $aTabla[$c]['descripcion']?></td>
						<td width="10%" class="texto-normal" align="center"><input id="user<? echo $aTabla[$c]['cedula']?>" name="user<? echo $aTabla[$c]['cedula']?>" type="checkbox" value="<? echo $aTabla[$c]['cedula']?>" <? echo $aTabla[$c]['checkbox']?> onclick="javascript:procesaroption('<? echo $aTabla[$c]['cedula']; ?>', '<? echo $aTabla[$c]['id_rol']; ?>')"/></td>
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
	if($_GET['proceso']==2){
	
		$rolopcion = $_GET['rolopcion'];
	
		$SQL3="UPDATE personales_rol SET nenabled=0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id= '".$rolopcion."';";	
		$rs3 = $conn->Execute($SQL3);
		
			$tabla = "public.personales_rol";
			$query = $SQL3;                                        
			$esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
		
	}
	
	if($_GET['proceso']==3){
	
		$cedula = $_GET['cedula'];
		$id_rol = $_GET['rol'];
		$id_sistema = $_GET['sistema'];
		$estado=$_GET['estado'];
		
		/*echo " 1 ".*/ $SQL4="SELECT id FROM rol WHERE modulo_id = '".$id_sistema."';";	
		$rs4 = $conn->Execute($SQL4);

		if ($rs4->RecordCount()>0){ // Trae todos los roles del sistema 
			while(!$rs4->EOF){
				
				$id.= $rs4->fields['id'].',';
			
			$rs4->MoveNext();
			}
			
			$gurpo_id = substr ($id, 0, strlen($id) - 1);	
			
			echo "<br> 2 ". $SQL5="SELECT * FROM personales_rol WHERE nenabled=1 AND personales_cedula = '".$cedula."' AND rol_id IN (".$gurpo_id.") and entidad_id=".$estado.";";	
			$rs5 = $conn->Execute($SQL5);
			
			if ($rs5->RecordCount()>0){ //echo $cedula." ENCONTRO ROL ACTIVO <br>";// Si encuentra un registro le hace nenable=0 y a su vez busca si el rol a crear esta agregado con valor  nenable=0
			
				$rol_asignado = $rs5->fields['id'];
				echo "<br> 3 ". $SQL6="UPDATE personales_rol SET nenabled=0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id= '".$rol_asignado."';";	
				$rs6 = $conn->Execute($SQL6);
	
				$tabla = "public.personales_rol";
				$query = $SQL6;                                        
				$esquema = "public";
				bitacora($tabla,$query,$conn,$esquema);	
				
				echo "<br> 4 ". $SQL7="SELECT * FROM personales_rol WHERE personales_cedula = '".$cedula."' AND rol_id = '".$id_rol."' AND nenabled = 0;";	
				$rs7 = $conn->Execute($SQL7);
				
				if ($rs7->RecordCount()>0){ //echo $cedula." ENCONTRO REGISTROS INABILITADO <br>";// Si encuentr el registro del rol con nenable=0 actualiza a nenable=1
				
					$rolopcion = $rs7->fields['id'];
					echo "<br> 5 ". $SQL8="UPDATE personales_rol SET nenabled=1,entidad_id=".$estado.", dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id= '".$rolopcion."';";	
					$rs8 = $conn->Execute($SQL8);
		
					$tabla = "public.personales_rol";
					$query = $SQL8;                                        
					$esquema = "public";
					bitacora($tabla,$query,$conn,$esquema);
				}else{  //echo $cedula." NO ENCONTRO REGISTROS <br>";// si no encuentra Inserta
				
					echo "<br> 6 ". $SQL9="INSERT INTO personales_rol(personales_cedula, rol_id,entidad_id, nenabled, dfecha_creacion, nusuario_creacion) VALUES ('".$cedula."', '".$id_rol."',".$estado.", 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
					$rs9 = $conn->Execute($SQL9);
					
					$tabla = "public.personales_rol";
					$query = $SQL9;                                        
					$esquema = "public";
					bitacora($tabla,$query,$conn,$esquema);
									
				}
			}else{  //echo $cedula." NO ENCONTRO REGISTROS <br>";// si no encuentra Inserta

				echo "<br> 7 ". $SQL10="INSERT INTO personales_rol(personales_cedula, rol_id, entidad_id,nenabled, dfecha_creacion, nusuario_creacion) VALUES ('".$cedula."', '".$id_rol."',".$estado.", 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
				$rs10 = $conn->Execute($SQL10);
				
				$tabla = "public.personales_rol";
				$query = $SQL10;                                        
				$esquema = "public";
				bitacora($tabla,$query,$conn,$esquema);
			}	
		}
	}
	
	if($_GET['proceso']==4){
	
		$sistema = $_GET['sistema'];
		$rol = $_GET['rol'];
		$estado = $_GET['estado'];
		$SQL4="SELECT id FROM rol WHERE modulo_id = '".$sistema."';";	
		$rs4 = $conn->Execute($SQL4);

		if ($rs4->RecordCount()>0){ // Trae todos los roles del sistema 
			while(!$rs4->EOF){
				
				$id.= $rs4->fields['id'].',';
			
			$rs4->MoveNext();
			}
			$gurpo_id = substr ($id, 0, strlen($id) - 1);
		}

		$SQL5="SELECT id, 
       			      cedula, 
					  (primer_apellido||' '||segundo_apellido||' '||primer_nombre||' '||segundo_nombre) AS descripcion 
			   FROM personales 
			   WHERE nenabled = 1 
			   ORDER BY primer_apellido;";	
		$rs5 = $conn->Execute($SQL5);
		
		if ($rs5->RecordCount()>0){
			$rol_activo = 0;
			$rol_actualizado = 0;
			$rol_creado = 0;
			while(!$rs5->EOF){
				
				$cedula = trim($rs5->fields['cedula']);
				
				
					$SQL6="SELECT * FROM personales_rol WHERE nenabled = 1 AND personales_cedula = '".$cedula."' AND rol_id IN (".$gurpo_id.") and entidad_id=".$estado.";";	
					$rs6 = $conn->Execute($SQL6);
					
					if ($rs6->RecordCount()>0){ //echo $cedula." ENCONTRO ROL ACTIVO <br>";// Si encuentra roles activos no hace nada...!
						$rol_activo++;
					}else{
									
						$SQL8="SELECT * FROM personales_rol WHERE personales_cedula = '".$cedula."' AND rol_id = '".$rol."' AND nenabled = 0;";	
						$rs8 = $conn->Execute($SQL8);
						
						if ($rs8->RecordCount()>0){ //echo $cedula." ENCONTRO REGISTROS INABILITADO <br>";// Si encuentr el registro del rol con nenable=0 actualiza a nenable=1
							$rol_actualizado++;
							
							$rolopcion = $rs8->fields['id'];
							$SQL9="UPDATE personales_rol SET nenabled=1, entidad_id=".$estado."'dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE id= '".$rolopcion."';";	
							$rs9 = $conn->Execute($SQL9);
				
							$tabla = "public.personales_rol";
							$query = $SQL9;                                        
							$esquema = "public";
							bitacora($tabla,$query,$conn,$esquema);
						}else{ //echo $cedula." NO ENCONTRO REGISTROS <br>";// si no encuentra Inserta
							$rol_creado++;
							
							$SQL10="INSERT INTO personales_rol(personales_cedula, rol_id,entidad_id, nenabled, dfecha_creacion, nusuario_creacion) VALUES ('".$cedula."', '".$rol."', '".$estado."', 1, '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."');";	
							$rs10 = $conn->Execute($SQL10);
							
							$tabla = "public.personales_rol";
							$query = $SQL10;                                        
							$esquema = "public";
							bitacora($tabla,$query,$conn,$esquema);				
						}
					}				

				$rs5->MoveNext();
			}	//echo "Roles Activos: ".$rol_activo." Roles Actualizados: ".$rol_actualizado." Roles Creados: ".$rol_creado;		
		}		
	}
	
	if($_GET['proceso']==5){
	
		$sistema = $_GET['sistema'];
		$rol = $_GET['rol'];
	
			$SQL11="UPDATE personales_rol SET nenabled=0, dfecha_actualizacion='".date('Y-m-d H:i:s')."', nusuario_actualizacion='".$_SESSION['id_usuario']."' WHERE rol_id= '".$rol."' and entidad_id=".$estado." ;";	
			$rs11 = $conn->Execute($SQL11);
		
			$tabla = "public.personales_rol";
			$query = $SQL11;
            $esquema = "public";
			bitacora($tabla,$query,$conn,$esquema);	
		
	}
}
?>
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
$conn= getConnDB($db1);
$conn->debug=false;

debug();

if(isset($_GET['proceso'])){
	if($_GET['proceso'] == 1){
	
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
					<th width="20%" align="left" class="sub_titulo"><div align="center">CEDULAS</div></th>
					<th width="70%" align="left" class="sub_titulo"><div align="center">NOMBRES Y APELLIDOS</div></th>
					<th width="10%" align="left" class="sub_titulo"><div align="center">REINICIAR</div></th>
	
				</tr>
				<tbody>
				   <?
					$aTabla=$_SESSION['aTabla_contenido'];
					$aDefaultForm = $GLOBALS['aDefaultForm'];
					for( $c=0; $c<count($aTabla); $c++){
					
					?>
					
					<tr style="<? echo $style?>">
						<td width="20%" class="texto-normal" align="left"><? echo $aTabla[$c]['cedula']?></td>
						<td width="70%" class="texto-normal" align="left"><? echo $aTabla[$c]['descripcion']?></td>
						<td width="10%" class="texto-normal" align="center"><a align="center" onclick="javascript:reiniciar('<? echo $aTabla[$c]['cedula']; ?>');" ><img src="../imagenes/refrescar.png" width="16" height="16" title="RESTAURAR CLAVE"/></a></td>
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
	
		$cedula = $_GET['cedula'];
		
		$SQL4= "DELETE FROM public.personales WHERE cedula = ".$cedula."";
		$rs4= $conn->Execute($SQL4);
		$tabla = "public.personales";
		$query = $SQL4;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);
		
		$SQL5= "DELETE FROM public.personales_rol WHERE personales_cedula = ".$cedula." AND rol_id = 11 OR rol_id = 28;";
		$rs5= $conn->Execute($SQL5);
		$tabla = "public.personales_rol";
		$query = $SQL5;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);
				
		$SQL6= "DELETE FROM public.sesion WHERE personales_cedula = ".$cedula."";
		$rs6= $conn->Execute($SQL6);
		$tabla = "public.sesion";
		$query = $SQL6;                                        
		$esquema = "public";
		bitacora($tabla,$query,$conn,$esquema);		

	}
}
?>
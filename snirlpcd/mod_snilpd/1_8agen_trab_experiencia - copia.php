<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB($db1);

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname_recibos,$username_recibos,$password_recibos,$db4);

//CONEXION CON LA TABLA ENTES
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db5);


$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug =false;
$conn1->debug =false;
$conn2->debug = false;


doAction($conn,$conn1,$conn2);
debug($settings['debug']=false);
showHeader();
showForm($conn,$conn1,$conn2,$aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION['sesiones']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn,$conn1,$conn2){
	if (isset($_POST['action'])){
		switch($_POST['action']){		
		   case 'cbNo_tiene_changed':
		         if ($_POST['cbExperiencia']=='0'){
				 $_POST['cbExperiencia']='0';
				 $_POST['cbOcupacionG_experiencia']='-1';
				 $_POST['cbOcupacionE_experiencia']='-1';
				 $_POST['cbOcupacion3_experiencia']='-1';
				 $_POST['cbOcupacion4_experiencia']='-1';
				 $_POST['cbOcupacion5_experiencia']='-1';
				 $_POST['cbMotivo_retiro']='-1';
				 $_POST['cbAct_economica1']='-1';
				 $_POST['cbAct_economica2']='-1';
				 $_POST['cbAct_economica3']='-1';
				 $_POST['cbAct_economica4']='-1';
				 $_POST['patrono']='No aplica';
				 $_POST['rif']='0';
				 $_POST['Telf_patrono']='0';
				 $_POST['f_ingreso']='';
				 $_POST['f_egreso']='';
				 $_POST['sueldo']='0';
				 $_POST['cbRelacion_trabajo']='1';
				 $_POST['cbPersonal_supervisado']='1';
				 $_POST['herramienta_trabajo']='No Aplica';
				 $_POST['observaciones_experiencia']='No Aplica';
				 $_POST['cbSector_empleo']='-1';				 
				 }
				 LoadData($conn,$conn1,$conn2,true);
			break;
			
			case 'btRif':
			$bValidateSuccess= true;	
					
			if ($_POST['rif']!="" and !ereg ("([J?V?G?E]{1}[0-9]{9})", $_POST['rif'])) { 
			    $GLOBALS['aPageErrors'][]= "- El Rif: debe ser Comenzar con J, V, G, E seguido de Nueve digitos numericos.";
			    $bValidateSuccess=false;
			}else{
				  	$SQL = "SELECT sdenominacion_comercial, srazon_social
				  	FROM seniat
				  	WHERE srif ='".$_POST['rif']."'";				
				    
				    $rs3 = $conn2->Execute($SQL);										
				    if ($rs3->RecordCount()>0){ 
						$_POST['patrono']=htmlspecialchars($rs3->fields['srazon_social'], ENT_QUOTES);	
					}else{				
						$GLOBALS['aPageErrors'][]= "Esta empresa no se encuentra inscrita en el Servicio Nacional Integrado de Administración Aduanera y Tributaria.";
						$bValidateSuccess=false;
					}
			}
					
			LoadData($conn,$conn1,$conn2,true);
			break;
					
			case 'cbOcupacion5_experiencia_changed':
			    LoadData($conn,$conn1,true);
				LoadOcupacion5_experiencia($conn, $param);
			break;
						
			case 'cbAct_economica4_changed':
			    LoadData($conn,$conn1,$conn2,true);
				LoadAct_economica4($conn);
			break;			
			
			case 'Cancelar': 
			  unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn,$conn1,$conn2,false);	
			break;
			
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['cbExperiencia']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Tiene Experiencia Laboral: es requerido.";
				$bValidateSuccess=false;
			}
			if ($_POST['cbExperiencia']=="1"){
					 
			if ($_POST['patrono']==""){
				$GLOBALS['aPageErrors'][]= "- Patrono/empleador: es requerido.";
				$bValidateSuccess=false;
			}
			if ($_POST['cbAct_economica4']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Actividad Económica: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbSector_empleo']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Sector empleador: es requerido.";
					$bValidateSuccess=false;
					 }
		
			if ($_POST['f_ingreso']==""){
					$GLOBALS['aPageErrors'][]= "- Fecha de ingreso: es requerida.";
					$bValidateSuccess=false;
					 }			
					 
		    if($_POST['f_ingreso']!='' and $_POST['f_egreso']!=''){							 
				if ($_POST['f_ingreso'] > $_POST['f_egreso']){
					$GLOBALS['aPageErrors'][]= "- Fecha de ingreso y egreso: son incorrectas.";
					$bValidateSuccess=false;
				}
			 }
			 
			if ($_POST['cbOcupacionG_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación que ha desempeñado: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacionE_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación General: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacion3_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación Específica: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacion4_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación Sub Específica: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbOcupacion5_experiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Ocupación Detalle: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbRelacion_trabajo']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Tipo de relación de trabajo: es requerida.";
					$bValidateSuccess=false;  
					 }
					 
			if ($_POST['sueldo']==""){  
					$GLOBALS['aPageErrors'][]= "- Sueldo mensual final ó actual (Bsf.): es requerido.";
					$bValidateSuccess=false;
					 }  
			if ($_POST['cbPersonal_supervisado']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Personal supervisado: es requerido.";
					$bValidateSuccess=false;
					 }
				}
				
			if ($bValidateSuccess){				
				ProcessForm($conn,$conn1,$conn2);
				}
			
			LoadData($conn,$conn1,$conn2,true);	
			break;	
			

						
			case 'Continuar': 
			$bValidateSuccess=true;
					 
			 	if ($_POST['cbExperiencia']=="0"){
				  $sql="delete  from persona_experiencia_laboral 
					where persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs= $conn->Execute($sql);					
				}
			
			
			//sesiones curriculum
				$nNumSeccion = 6;
				$sSQL = "SELECT sesiones FROM personas where id = ".$_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);
				
				if ($rs){
					if ($rs->RecordCount() > 0){
						$rs->fields['sesiones'][$nNumSeccion-1] = 1;
						$sSQL = "update personas set sesiones = '".$rs->fields['sesiones']."' where id = ".$_SESSION['id_afiliado'];
						$rs = $conn->Execute($sSQL);			
					}
				}
				unset($_POST['id_po']);
				unset($_POST['accion']); 
				?><script>document.location='1_8agen_trab_experiencia.php'</script><?
				/* ?><script>document.location='1_10agen_trab_participacion.php'</script><? */	
			break;
	        }
		}		
		else{
		LoadData($conn,$conn1,$conn2,false);
		}
}
//------------------------------------------------------------------------------
function LoadData($conn,$conn1,$conn2,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	  
		$_POST['edit']='';
		$aDefaultForm['rif']='';
		$aDefaultForm['patrono']='';
		$_POST['cbAct_economica4']='-1';
		$_POST['cbAct_economica3']='-1';
		$_POST['cbAct_economica2']='-1';
		$_POST['cbAct_economica1']='-1';
		$aDefaultForm['cbSector_empleo']='-1';
		$aDefaultForm['Telf_patrono']='';
		$aDefaultForm['f_ingreso']='';
		$aDefaultForm['f_egreso']='';
		$aDefaultForm['cbOcupacion5_experiencia']='-1';
		$aDefaultForm['cbOcupacion4_experiencia']='-1';
		$aDefaultForm['cbOcupacion3_experiencia']='-1';
		$aDefaultForm['cbOcupacionE_experiencia']='-1';
		$aDefaultForm['cbOcupacionG_experiencia']='-1';
		$aDefaultForm['cbRelacion_trabajo']='-1';
		$aDefaultForm['cbMotivo_retiro']='-1';
		$aDefaultForm['sueldo']='';
		$aDefaultForm['cbPersonal_supervisado']='-1';
		$aDefaultForm['herramienta_trabajo']='';
		$aDefaultForm['observaciones_experiencia']=''; 
		$aDefaultForm['act_eco']=''; 
		$aDefaultForm['ocupacion']=''; 
		$aDefaultForm['cbExperiencia']='-1';
		unset($_SESSION['aTabla']);
				
		if (!$bPostBack){
			if ($_GET['accion']!='') $_POST['accion']=$_GET['accion'];	
			if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];			
		
		if ($_POST['accion']=='1'){	
				$_POST['edit']='1';		
				$SQL2="SELECT persona_experiencia_laboral.*,personas.sesiones
						from persona_experiencia_laboral 
						INNER JOIN personas ON personas.id=persona_experiencia_laboral.persona_id 
						INNER JOIN motivo_retiro ON motivo_retiro.id=persona_experiencia_laboral.motivo_retiro_id 
						INNER JOIN sector_empleo ON sector_empleo.id=persona_experiencia_laboral.sector_empleo_id 
where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' and persona_experiencia_laboral.id ='".$_POST['id_po']."'";
						$rs = $conn->Execute($SQL2);
						if ($rs->RecordCount()>0){
						$aDefaultForm['rif']=$rs->fields['rif'];
						$aDefaultForm['patrono']=$rs->fields['patrono'];
						$aDefaultForm['cbSector_empleo']=$rs->fields['sector_empleo_id'];
						$aDefaultForm['Telf_patrono']=$rs->fields['telefono'];
						if($rs->fields['f_ingreso']=='0000-00-00'){ $aDefaultForm['f_ingreso']=''; }
						else { $aDefaultForm['f_ingreso']=$rs->fields['f_ingreso']; }
						if($rs->fields['f_egreso']=='0000-00-00'){ $aDefaultForm['f_egreso']=''; }
						else { $aDefaultForm['f_egreso']=$rs->fields['f_egreso']; }
											
						$aDefaultForm['cbAct_economica4']=$rs->fields['act_economica4'];
						$aDefaultForm['cbOcupacion5_experiencia']=$rs->fields['ocupacion5'];
						
					?>	
					<script language="javascript" src="../js/jquery.js"></script>
					<script>
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['act_economica4']; ?>";
					combo="Actividad";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['act_economica3']; ?>" }, 
					function(data){  $("#cbAct_economica3").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['act_economica3']; ?>";
					combo="Actividad";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['act_economica2']; ?>" },
					function(data){  $("#cbAct_economica2").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['act_economica2']; ?>";
					combo="Actividad";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['act_economica1']; ?>" },                    function(data){  $("#cbAct_economica1").html(data);
					});            
					});
					
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacion5']; ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupacion4']; ?>" }, 
					function(data){  $("#cbOcupacion4_experiencia").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacion4']; ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupacion3']; ?>" }, 
					function(data){  $("#cbOcupacion3_experiencia").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacion3']; ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupacione_id']; ?>" }, 
					function(data){  $("#cbOcupacionE_experiencia").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacione_id'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupaciong_id']; ?>"}, 
					function(data){  $("#cbOcupacionG_experiencia").html(data);
					});            
					});
					</script>
					<?php
			
						$aDefaultForm['cbRelacion_trabajo']=$rs->fields['relacion_trabajo'];
						$aDefaultForm['cbMotivo_retiro']=$rs->fields['motivo_retiro_id'];
						$aDefaultForm['sueldo']=$rs->fields['sueldo_final'];
						$aDefaultForm['cbPersonal_supervisado']=$rs->fields['personal_supervisado'];
						$aDefaultForm['herramienta_trabajo']=$rs->fields['equipos_herramientas'];
						$aDefaultForm['observaciones_experiencia']=$rs->fields['descripcion_empleo'];
						$_SESSION['sesiones']=$rs1->fields['sesiones'];
				}
			}	
			
			if ($_POST['accion']=='2'){
			$sql="delete  from persona_experiencia_laboral 
					where id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs= $conn->Execute($sql);	
					unset($_POST['id_po']);//Trazas--------------------------------------------------------------------------------------------------------------------------
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='8';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
			}
		
		}		
else{   
		$aDefaultForm['rif']=$_POST['rif'];
		$aDefaultForm['patrono']=$_POST['patrono'];		
		$aDefaultForm['cbSector_empleo']=$_POST['cbSector_empleo'];
		$aDefaultForm['Telf_patrono']=$_POST['Telf_patrono']; 
		$aDefaultForm['f_ingreso']=$_POST['f_ingreso'];
		$aDefaultForm['f_egreso']=$_POST['f_egreso']; 
		$aDefaultForm['cbRelacion_trabajo']=$_POST['cbRelacion_trabajo']; 
		$aDefaultForm['cbMotivo_retiro']=$_POST['cbMotivo_retiro'];
		$aDefaultForm['sueldo']=$_POST['sueldo'];
		$aDefaultForm['cbPersonal_supervisado']=$_POST['cbPersonal_supervisado'];
		$aDefaultForm['herramienta_trabajo']=$_POST['herramienta_trabajo'];
		$aDefaultForm['observaciones_experiencia']=$_POST['observaciones_experiencia'];
		$aDefaultForm['act_eco']=$_POST['act_eco']; 
		$aDefaultForm['ocupacion']=$_POST['ocupacion']; 
		$aDefaultForm['cbExperiencia']=$_POST['cbExperiencia'];
		$aDefaultForm['cbAct_economica4']=$_POST['cbAct_economica4'];
		$aDefaultForm['cbOcupacion5_experiencia']=$_POST['cbOcupacion5_experiencia'];
		?>	
		<script language="javascript" src="../js/jquery.js"></script>
		<script>
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbAct_economica4']; ?>";
		combo="Actividad";
		$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbAct_economica3']; ?>" }, 
		function(data){  $("#cbAct_economica3").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbAct_economica3']; ?>";
		combo="Actividad";
		$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbAct_economica2']; ?>" },
		function(data){  $("#cbAct_economica2").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbAct_economica2']; ?>";
		combo="Actividad";
		$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbAct_economica1']; ?>" },        function(data){  $("#cbAct_economica1").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacion5_experiencia']; ?>";
		combo="Ocupacion";
		$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion4_experiencia']; ?>" }, 
		function(data){  $("#cbOcupacion4_experiencia").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacion4_experiencia']; ?>";
		combo="Ocupacion";
		$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion3_experiencia']; ?>" }, 
		function(data){  $("#cbOcupacion3_experiencia").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacion3_experiencia']; ?>";
		combo="Ocupacion";
		$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionE_experiencia']; ?>" }, 
		function(data){  $("#cbOcupacionE_experiencia").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacionE_experiencia'] ?>";
		combo="Ocupacion";
		$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionG_experiencia']; ?>"}, 
		function(data){  $("#cbOcupacionG_experiencia").html(data);
		});            
		});
		</script>
		<?php
		
		}
		
			$SQL1="select persona_experiencia_laboral.id, persona_experiencia_laboral.patrono, persona_experiencia_laboral.f_ingreso,
					persona_experiencia_laboral.f_egreso, ocupacion.nombre as ocupacione, personas.experiencia_laboral, rif			
					from persona_experiencia_laboral  
					left JOIN personas ON personas.id=persona_experiencia_laboral.persona_id 
					left JOIN ocupacion ON ocupacion.cod=persona_experiencia_laboral.ocupacion5 
					INNER JOIN motivo_retiro ON motivo_retiro.id=persona_experiencia_laboral.motivo_retiro_id 
					INNER JOIN sector_empleo ON sector_empleo.id=persona_experiencia_laboral.sector_empleo_id 
					where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'
					order by persona_experiencia_laboral.f_egreso desc";
				$rs1 = $conn->Execute($SQL1);
				$ocupacione_id=$rs1->fields['ocupacione_id'];
			
				if ($rs1->RecordCount()>0){	
					$aDefaultForm['cbExperiencia']=$rs1->fields['experiencia_laboral'];
					$aTabla=array();
					while(!$rs1->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['id']=$rs1->fields['id']; 
						$aTabla[$c]['ocupacione']=$rs1->fields['ocupacione'];
						$aTabla[$c]['patrono']=$rs1->fields['patrono'];
						$aTabla[$c]['rif']=$rs1->fields['rif'];
						$aTabla[$c]['f_ingreso']=$rs1->fields['f_ingreso'];	
						$rs1->MoveNext();
						 }
			$_SESSION['aTabla'] = $aTabla;	
			}	
	  }
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn,$conn1,$conn2){
		$sfecha=date('Y-m-d');
		if($_POST['f_ingreso']=='') $_POST['f_ingreso']='0000-00-00';
		if($_POST['f_egreso']=='') $_POST['f_egreso']='0000-00-00';	

//--------------------------------------------------------------------------actualizar------------------------------------------	
if ($_POST['edit']=='1'){	
		
			  if($_POST['f_ingreso']=='') $_POST['f_ingreso']='0000-00-00';
				if($_POST['f_egreso']=='') $_POST['f_egreso']='0000-00-00';			 
				$sql="update persona_experiencia_laboral set 
				  rif='".$_POST['rif']."',
				  patrono='".$_POST['patrono']."',				 
				  sector_empleo_id='".$_POST['cbSector_empleo']."',
				  act_economica4='".$_POST['cbAct_economica4']."',
				  act_economica3='".$_POST['cbAct_economica3']."',
				  act_economica2='".$_POST['cbAct_economica2']."',
				  act_economica1='".$_POST['cbAct_economica1']."',
				  telefono='".$_POST['Telf_patrono']."',
				  f_ingreso='".$_POST['f_ingreso']."',
				  f_egreso='".$_POST['f_egreso']."',
				  ocupacion5='".$_POST['cbOcupacion5_experiencia']."',
				  ocupacion4='".$_POST['cbOcupacion4_experiencia']."',
				  ocupacion3='".$_POST['cbOcupacion3_experiencia']."',
				  ocupacione_id='".$_POST['cbOcupacionE_experiencia']."', 
				  ocupaciong_id='".$_POST['cbOcupacionG_experiencia']."',
				  relacion_trabajo='".$_POST['cbRelacion_trabajo']."',
				  motivo_retiro_id='".$_POST['cbMotivo_retiro']."',				
				  sueldo_final='".$_POST['sueldo']."',
				  personal_supervisado='".$_POST['cbPersonal_supervisado']."',
				  equipos_herramientas='".$_POST['herramienta_trabajo']."',
				  descripcion_empleo='".$_POST['observaciones_experiencia']."',
					updated_at='".$sfecha."',
					status='A',
					id_update='".$_SESSION['sUsuario']."'
					WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' "; 	
					$conn->Execute($sql);	
	}
			
//--------------------------------------------------agregar---------------------------------------				
	else{
	
	$existe='';		
			//----------------------------------------------verifica si existe-----------------------------			
				$SQL2="SELECT id from persona_experiencia_laboral
						where persona_id  ='".$_SESSION['id_afiliado']."'
							and rif ='".$_POST['rif']."'";
								 
						$rs = $conn->Execute($SQL2);
						if ($rs->RecordCount()>0){	
								$existe='1';
								?><script>alert("- Ya existe un registro de experiencia laboral con este rif");</script><?	
						}
						else{
							$existe='';
							}

if($existe==''){	
		
			$sql="insert into public.persona_experiencia_laboral
		 		( persona_id, rif, patrono, sector_empleo_id, act_economica4, act_economica3, act_economica2, act_economica1,telefono,
				  f_ingreso, f_egreso,ocupacion5,ocupacion4,ocupacion3,ocupacione_id,ocupaciong_id,relacion_trabajo,motivo_retiro_id,
				  sueldo_final, personal_supervisado,equipos_herramientas, descripcion_empleo,created_at, status, id_update) 
				  values
			  	('".$_SESSION['id_afiliado']."',
				 '".$_POST['rif']."',
				 '".$_POST['patrono']."',
				 '".$_POST['cbSector_empleo']."',
				 '".$_POST['cbAct_economica4']."', 
				 '".$_POST['cbAct_economica3']."', 
				 '".$_POST['cbAct_economica2']."',  
				 '".$_POST['cbAct_economica1']."',
				 '".$_POST['Telf_patrono']."',
				 '".$_POST['f_ingreso']."',
				 '".$_POST['f_egreso']."',
				 '".$_POST['cbOcupacion5_experiencia']."', 
				 '".$_POST['cbOcupacion4_experiencia']."', 
				 '".$_POST['cbOcupacion3_experiencia']."', 
				 '".$_POST['cbOcupacionE_experiencia']."', 
				 '".$_POST['cbOcupacionG_experiencia']."',
				 '".$_POST['cbRelacion_trabajo']."',
				 '".$_POST['cbMotivo_retiro']."', 
				 '".$_POST['sueldo']."',				
				 '".$_POST['cbPersonal_supervisado']."',	
				 '".$_POST['herramienta_trabajo']."',
				 '".$_POST['observaciones_experiencia']."', 			 
			  	 '$sfecha',
			   	 'A',
			   	 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql);			 	
	    }
  }
//Trazas------------------------------------------------------------------------------------------------------------------------
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='8';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
//-----------------------------------------------------------------------------------------------------------------------------
			$sql="update personas set 
				  experiencia_laboral = '".$_POST['cbExperiencia']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
			  	  $conn->Execute($sql);	
				  
				unset($_POST['id_po']);
				unset($_POST['accion']); 
				LoadData($conn,false);
						
		}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$conn1,$conn2,&$aDefaultForm){
?>
<style type="text/css">
<!--
.Estilo12 {color: #030303}
-->
</style>
<form name="frm_experiencia" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script language="javascript">
//Actividad economica 
$(document).ready(function(){
   $("#cbAct_economica4").change(function () {
           $("#cbAct_economica4 option:selected").each(function () {
            elegido=$(this).val();
			combo='Actividad';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbAct_economica3").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbAct_economica3").change(function () {
           $("#cbAct_economica3 option:selected").each(function () {
            elegido=$(this).val();
			combo='Actividad';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbAct_economica2").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbAct_economica2").change(function () {
           $("#cbAct_economica2 option:selected").each(function () {
            elegido=$(this).val();
			combo='Actividad';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbAct_economica1").html(data);
            });            
        });
   })
});


$(document).ready(function(){
   $("#cbOcupacion5_experiencia").change(function () {
           $("#cbOcupacion5_experiencia option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbOcupacion4_experiencia").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion4_experiencia").change(function () {
           $("#cbOcupacion4_experiencia option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacion3_experiencia").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion3_experiencia").change(function () {
           $("#cbOcupacion3_experiencia option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionE_experiencia").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacionE_experiencia").change(function () {
           $("#cbOcupacionE_experiencia option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionG_experiencia").html(data);
            });            
        });
   })
});

</script>

<script>
	function send(saction){


			if(saction=='Agregar' || saction=='Actualizar'){
	   			if(validar_frm_experiencia()==true){
					var form = document.frm_experiencia;
					form.action.value=saction;
					form.submit();	
				}	
	
		  	}else{

		  		if(saction=='btRif'){

		  			if(validar_frm_campo_busqueda()==true){
						var form = document.frm_experiencia;
						form.action.value=saction;
						form.submit();	
					}	

				}else{

					var form = document.frm_experiencia;
					form.action.value=saction;
					form.submit();

				}
									
			}

	       /*if(saction=='Agregar' || saction=='Actualizar'){
		   			if(validar_frm_experiencia()==true){
						var form = document.frm_experiencia;
						form.action.value=saction;
						form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_experiencia;
					form.action.value=saction;
					form.submit();				
			}*/		
	}
</script>

      <input name="action" type="hidden" value=""/>
      <input name="edit" type="hidden" value="<?=$_POST['edit']?>" /> 
      <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
      <input name="accion" type="hidden" value="<?=$_POST['accion']?>" />  

	<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th colspan="4" class="sub_titulo"  >EXPERIENCIA LABORAL</th>
        </tr>
       <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
        <tr>
        <th colspan="4" class="sub_titulo_2" align="left">Informaci&oacute;n de Experiencia Laboral</th>
        </tr>

        <tr>
        	<th colspan="4" align="center" class="sub_titulo">Tiene experiencia laboral?</th>		
		</tr>

        <tr align="center">
	    	<td colspan="4" style="background-color:#F0F0F0;">
	    		<select id="cbExperiencia" name="cbExperiencia" class="tablaborde_shadow"  title="Experiencia Laboral - Seleccione solo una opcion del listado">
			        <option value="-1" selected="selected">Seleccionar</option>
			        <option value="1" <? if (($aDefaultForm['cbExperiencia'])=='1') print 'selected="selected"';?>>Si</option>
			        <option value="0" <? if (($aDefaultForm['cbExperiencia'])=='0') print 'selected="selected"';?>>No</option>
        		</select>
            <span class="requerido">*</span></td>
	    </tr>

        <tr id="tr_experiencia">
        <th colspan="4" class="sub_titulo_2" align="left">Datos de (la) Patrono(a) &oacute; Entidad de Trabajo</th>
        </tr>        
        <tr id="tr_experiencia1" style="background-color:#F0F0F0; color:#666" align="right">
         <td colspan="2" style="background-color:#F0F0F0; color:#666" >  <strong>N° Registro de Información Fiscal:</strong>
           <input name="rif" type="text" class="tablaborde_shadow" id="rif" value="<?=$aDefaultForm['rif']?>" size="20" maxlength="10" title="RIF - Ingrese J, V, G, E en mayuscula seguido de nueve digitos numericos, Ejm: J123456789, V123456789, E123456789, G123456789 " placeholder="RIF"/>
           <span class="requerido">*  </span>         </td>
        <!--<td  colspan="2"style="background-color:#F0F0F0; color:#666" align="left" > <button type="submit" name="btRif"  id="btRif" class="button_personal"  onclick="javascript:send('btRif');" title="Buscar en el Registro Nacional de Entidades de Trabajo">Buscar en SENIAT</button>
          </td>-->
          <td  colspan="2"style="background-color:#F0F0F0; color:#666" align="left" > 
          	<button type="button" name="btRif"  id="btRif" class="button_personal"  onclick="javascript:send('btRif');" title="Buscar en el Servicio Nacional Integrado de Administración Aduanera y Tributaria">Buscar en SENIAT</button>
          </td>
        </tr>        
<!--::::::::::::::::::::::::::::::::::::-->
	
		<tr id="tr_experiencia3">
            <th width="25%" class="sub_titulo" align="center">Patrono(a) &oacute; Entidad de Trabajo</th>		
			<th width="26%" class="sub_titulo" align="center">Sector Empleador</th>		
			<th width="25%" class="sub_titulo" align="center">Actividad Econ&oacute;mica Sub Específica</th>	
			<th width="24%" class="sub_titulo" align="center">Actividad Econ&oacute;mica Específica</th>
        </tr>

        <tr align="center" id="tr_experiencia4">
	    	
	    	<td style="background-color:#F0F0F0;" ><input style="width: 90%" name="patrono" type="text" class="tablaborde_shadow" id="patrono"  placeholder="Patrono(a) &oacute; Entidad de Trabajo" value="<?=$aDefaultForm['patrono']?>" size="25" maxlength="100"  title="Nombre del (de la) patrono(a) o entidad de trabajo - Ingrese solo letras y/o numeros" />
        	<span class="requerido"> *</span></td>
        	
	  
	    	<!-- sector empleador-->
	      	<td style="background-color:#F0F0F0;"><span class="links-menu-izq">
	        	<select  name="cbSector_empleo" class="tablaborde_shadow"  style="width: 95%"id="cbSector_empleo" title="Sector empleador - Seleccione solo una opcion del listado">
        		<option value="-1" selected="selected">Seleccionar</option>
        		<? LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo'];?>
        		</select>
	        	</span><span class="requerido"> *</span>
	        </td>
	  		<!-- actividad economica sub espesifica-->
	      	<td style="background-color:#F0F0F0;"><span class="links-menu-izq">
	        	<select name="cbAct_economica4" id="cbAct_economica4" style="width: 95%" class="tablaborde_shadow" title="Actividad economica Sub Especifica - Seleccione solo una opcion del listado">
		        <option value="-1" selected="selected">Seleccionar</option>
		        <? LoadAct_economica4($conn) ; print $GLOBALS['sHtml_cb_Act_economica4']; ?> 
		        </select>
	        	</span><span class="requerido"> *</span>
	        </td>
	        <!-- actividad economica especifica-->
	        <td style="background-color:#F0F0F0;"><span class="links-menu-izq">
	        	<select name="cbAct_economica3" id="cbAct_economica3" style="width: 95%" class="tablaborde_shadow" title="Actividad economica Especifica - Seleccione solo una opcion del listado">
        			<option value="">Seleccionar</option>
        		</select></span><span class="requerido"> *</span>
	        </td>
	    </tr>

	    <tr id="tr_experiencia5">
			<th width="25%" class="sub_titulo" align="center">Actividad Econ&oacute;mica General</th>
			<th width="26%" class="sub_titulo" align="center">Actividad Econ&oacute;mica</th>
			<th colspan="2" class="sub_titulo" align="center">Tel&eacute;fono</th>
        </tr>

		<tr align="center" id="tr_experiencia6">
			<!-- actividad economica general-->
        	<td style="background-color:#F0F0F0;"><span class="links-menu-izq">
	        	<select name="cbAct_economica2" id="cbAct_economica2" style="width: 95%" class="tablaborde_shadow" title="Actividad economica General - Seleccione solo una opcion del listado">
        			<option value="-1">Seleccionar</option>
        		</select></span><span class="requerido"> *</span>
	        </td>
	        <!-- actividad economica-->
	        <td style="background-color:#F0F0F0;"><span class="links-menu-izq">
	        	<select name="cbAct_economica1" id="cbAct_economica1" style="width: 95%" class="tablaborde_shadow" title="Actividad economica - Seleccione solo una opcion del listado">
        			<option value="-1">Seleccionar</option>
        		</select></span><span class="requerido"> *</span>
	        </td>
	        <!-- Telefono-->
	        <td  colspan="2" style="background-color:#F0F0F0;">  <input name="codigo2" type="text" id="codigo2" onkeypress="return isNumberKey(event);" title="C&oacute;digo de &Aacute;rea - Ingrese s&oacute;lo N&uacute;meros. Acepta 4 d&iacute;gitos. Ejemplo: 0212"placeholder="Cód." size="4" maxlength="4" value="" autocomplete="off" />-
	        	<input name="Telf_patrono" type="text"  style="width: 25%" class="tablaborde_shadow" id="Telf_patrono" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['Telf_patrono']?>"  title="Tel&eacute;fono  del Patrono o Entidad de Trabajo - Ingrese s&oacute;lo N&uacute;meros. Acepta 7 d&iacute;gitos. Ejemplo: 1234567"  placeholder="N° teléfono" size="15" maxlength="11" />
        		<span class="requerido"> *</span>
        	</td>
	    </tr>
        <tr id="tr_experiencia0">
        <th colspan="4" class="sub_titulo_2" align="left">Datos del Empleo</th>
        </tr>        
            <tr id="tr_experiencia7">
	            <th width="25%" class="sub_titulo" align="center">Fecha de Ingreso</th>		
	            <th width="26%" class="sub_titulo" align="center">Fecha de Egreso</th>
	            <th width="25%" class="sub_titulo" align="center">Ocupación Detalle</th>
	            <th width="24%" class="sub_titulo" align="center">Ocupaci&oacute;n Sub Especifica</th>  
        	</tr>
        
        	<tr id="tr_experiencia8">
            
            	<td style="background-color:#F0F0F0;" align="center">
                	<input style="width: 50%" name="f_ingreso" type="text" class="tablaborde_shadow" id="f_ingreso" value="<?=$aDefaultForm['f_ingreso']?>" size="10"  placeholder="00-00-0000" title="Fecha de Ingreso - seleccione del calendario la fecha" readonly/>
                    <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                    <script type="text/javascript">//<![CDATA[
                    Calendar.setup({
                    inputField : "f_ingreso",
                    trigger    : "f_rangeStart_trigger",
                            
                    onSelect   : function() { this.hide() },
                    showTime   : false,
                    dateFormat : "%Y-%m-%d"
                    });
                    </script>	<span class="requerido">*</span> 
              </td>   
            
     			<td style="background-color:#F0F0F0;" align="center">
                	 <input name="f_egreso" style="width: 50%" type="text" class="tablaborde_shadow" id="f_egreso" value="<?=$aDefaultForm['f_egreso']?>" size="10" placeholder="00-00-0000" title="Fecha de Egreso - seleccione del calendario la fecha" readonly/>
                    <a href="#" id="f_rangeStart_trigger_1"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                    <script type="text/javascript">//<![CDATA[
                    Calendar.setup({
                    inputField : "f_egreso",
                    trigger    : "f_rangeStart_trigger_1",
                    onSelect   : function() { this.hide() },
                    showTime   : false,
                    dateFormat : "%Y-%m-%d"
                    });
                    </script> <span class="requerido">*</span>
                </td>   
                <!-- Ocupacion Detalle-->
          		<td style="background-color:#F0F0F0;" align="center"><select name="cbOcupacion5_experiencia2" id="cbOcupacion5_experiencia2" class="tablaborde_shadow" style="width: 95%" title="Ocupacion detalle - Seleccione solo una opcion del listado">
          		  <option value="-1" selected="selected">Seleccionar</option>
          		  <? LoadOcupacion5_experiencia ($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_experiencia']; ?>
        		  </select>
                <span class="requerido">*</span></td>   
                
                <!-- Ocupacion sub especifica-->
         		<td style="background-color:#F0F0F0;" align="center"><select style="width: 95%" name="cbOcupacion4_experiencia2" id="cbOcupacion4_experiencia2" class="tablaborde_shadow" title="Ocupacion sub especifica - Seleccione solo una opcion del listado">
         		  <option value="-1">Seleccionar</option>
       		  </select>
                <span class="requerido">*</span></td>   
        	</tr>
            
            <tr id="tr_experiencia9">
	            <th width="25%" class="sub_titulo" align="center">Ocupación Especifica</th>		
	            <th width="26%" class="sub_titulo" align="center">Ocupación General</th>
	            <th width="25%" class="sub_titulo" align="center">Ocupación</th>
	            <th width="24%" class="sub_titulo" align="center">Tipo de Relación de Trabajo</th>  
        	</tr>
        
        	<tr id="tr_experiencia10">
            
            	<td style="background-color:#F0F0F0;" align="center"><select name="cbOcupacion3_experiencia" id="cbOcupacion3_experiencia" class="tablaborde_shadow" style="width: 95%" title="Ocupacion especifica - Seleccione solo una opcion del listado">
            	  <option value="-1">Seleccionar</option>
          	  </select>
                <span class="requerido">*</span></td>   
            
     			<td style="background-color:#F0F0F0;" align="center"><select name="cbOcupacionE_experiencia" id="cbOcupacionE_experiencia" class="tablaborde_shadow" style="width: 95%" title="Ocupacion general - Seleccione solo una opcion del listado">
     			  <option value="-1">Seleccionar</option>
   			  </select>
                <span class="requerido">*</span></td>   
                
          		<td style="background-color:#F0F0F0;" align="center"><select name="cbOcupacionG_experiencia" id="cbOcupacionG_experiencia" class="tablaborde_shadow"style="width: 95%"  title="Ocupacion - Seleccione solo una opcion del listado">
          		  <option value="-1">Seleccionar</option>
        		  </select>
                <span class="requerido">*</span></td>   
                
         		<td style="background-color:#F0F0F0;" align="center"><select name="cbRelacion_trabajo" class="tablaborde_shadow" id="cbRelacion_trabajo" style="width: 95%" title="Tipo de relacion de trabajo - Seleccione solo una opcion del listado">
         		  <option value="-1" selected="selected">Seleccionar</option>
         		  <option value="2" <? if (($aDefaultForm['cbRelacion_trabajo'])=='2') print 'selected="selected"';?>>Cuenta propia</option>
         		  <option value="3" <? if (($aDefaultForm['cbRelacion_trabajo'])=='3') print 'selected="selected"';?>>Cuenta ajena</option>
       		  </select>
                <span class="requerido"> *</span></td>   
        	</tr>
            
            
            
            <tr id="tr_experiencia11">
	            <th width="25%" class="sub_titulo" align="center">Causales de Terminación de la Relación de Trabajo</th>		
	            <th width="26%" class="sub_titulo" align="center">Personal Supervisado</th>
	            <th  colspan="2" class="sub_titulo" align="center">Equipos/Herramientas que Manejó en este Empleo</th> 
	           
        	</tr>
        
        	<tr id="tr_experiencia12">
            
            	<td style="background-color:#F0F0F0;" ><span class="links-menu-izq">
            	  <select name="cbMotivo_retiro2" id="cbMotivo_retiro2" style="width: 95%" class="tablaborde_shadow" title="Causales de terminación de la relación de trabajo - Seleccione solo una opcion del listado">
            	    <option value="-1" selected="selected">Seleccionar</option>
            	    <? LoadMotivo_retiro($conn); print $GLOBALS['sHtml_cb_Motivo_retiro'];?>
          	    </select>
            	<span class="requerido">*</span></td>
            
                
          		<td style="background-color:#F0F0F0;" align="center"><select name="cbPersonal_supervisado" class="tablaborde_shadow" id="cbPersonal_supervisado"  style="width: 95%" title="Personal supervisado - Seleccione solo una opcion del listado">
          		  <option value="-1" selected="selected">Seleccionar</option>
          		  <option value="1" <? if (($aDefaultForm['cbPersonal_supervisado'])=='1') print 'selected="selected"';?>>0</option>
          		  <option value="2" <? if (($aDefaultForm['cbPersonal_supervisado'])=='2') print 'selected="selected"';?>>1 a 5</option>
          		  <option value="3" <? if (($aDefaultForm['cbPersonal_supervisado'])=='3') print 'selected="selected"';?>>6 a 10</option>
          		  <option value="4" <? if (($aDefaultForm['cbPersonal_supervisado'])=='4') print 'selected="selected"';?>>Más de 10</option>
        		  </select>
                <span class="requerido">*</span></td>
                
         		<td colspan="2" style="background-color:#F0F0F0;" align="center"><input name="herramienta_trabajo" cols="10" class="tablaborde_shadow" style="width:95%" id="herramienta_trabajo" placeholder="Equipos/herramientas que manejó en este empleo" title="Equipos/herramientas que manejó en este empleo - Ingrese solo letras y/o numeros" value="<?=$aDefaultForm['herramienta_trabajo']?>"   		
         		/></td>

         		 <td width="0%" style="background-color:#F0F0F0;"></td>
        	</tr>
            
             <tr id="tr_experiencia13">
	            <th colspan="4" align="center" class="sub_titulo">Breve Descripci&oacute;n del Trabajo Desempe&ntilde;ado</th>		
	            </tr>
        
        	<tr id="tr_experiencia14">
            
            	<td colspan="4" align="center" style="background-color:#F0F0F0;"><input name="observaciones_experiencia2" cols="20"  style="width:95%" class="tablaborde_shadow" id="observaciones_experiencia2" title="Breve descripción del trabajo desempeñado - Ingrese solo letras y/o numeros"  placeholder="Breve descripción del trabajo desempeñado" value="<?=$aDefaultForm['observaciones_experiencia']?>"
                 /></td>   
     			</tr>
        

        <tr id="tr_experiencia23">
          <td>&nbsp;</td>
          <td colspan="2" align="center"><span class="requerido">
            <? if($_POST['edit']==""){ ?>
            <button type="button" name="Agregar"  id="Agregar" class="button_personal"  onClick="javascript:send('Agregar');">Agregar</button>
            <? }
             else{ ?>
            <button type="button" name="Actualizar"  id="Actualizar" class="button_personal"  onClick="javascript:send('Agregar');">Actualizar</button>
          </span>
            <? }?>
            <span class="requerido">
            <button type="button" name="Cancelar"  id="Cancelar" class="button_personal"  onClick="javascript:send('Cancelar');">Cancelar</button>
         </span></td>
        </tr>
        
        <tr id="tr_experiencia25">
         <td height="50" colspan="5">  
         <tr class="identificacion_seccion">
        <th colspan="5" class="sub_titulo_2" align="left">Detalle de Datos de (la) Patrono(a) &oacute; Entidad de Trabajo</th>
        </tr>
            <td colspan="5">
              <table class="display" border="0" align="center" id="tblDetalle" width="258%">
            <!--  <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:95%; ">-->
              <thead> 
                <tr>
              <th class="sub_titulo">Ocupación</th>
              <th  class="sub_titulo">Patrono/Empleador</th>
              <th  class="sub_titulo">Rif</th>
              <th  class="sub_titulo">Fecha de Ingreso</th>
              <th  class="sub_titulo">Acciones</th>
             </tr>
               	<tbody>
               
              <?
			  unset($_SESSION['aTabla']);
              $aTabla=$_SESSION['aTabla'];
              $aDefaultForm = $GLOBALS['aDefaultForm'];
              for( $i=0; $i<count($aTabla); $i++){
              if (($i%2) == 0) $class_name = "dataListColumn2";
              else $class_name = "dataListColumn";
              ?>
              <tr class="<?=$class_name?>">
              <td ><div align="left">
              <?=$aTabla[$i]['ocupacione']?>
              </div></td>
              <td ><div align="left">
              <?=$aTabla[$i]['patrono']?>
              </div></td>
              <td ><div align="left">
              <?=$aTabla[$i]['rif']?>
              </div></td>
              <td ><div align="left">
              <? if ($aTabla[$i]['f_ingreso']=='0000-00-00'){ print '0000-00-00';}
              else { print strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_ingreso']));}
              ?>
              </div></td>
              <td ><a href="1_8agen_trab_experiencia.php?id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="../imagenes/pencil_16.png"  border="0" title="Editar" /></a> <a href="1_8agen_trab_experiencia.php?id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="../imagenes/delete_16.png"  border="0" title="Eliminar" /></a> </td>
              </tr>
              <? } ?>
              </tbody>
                </thead> 
  			</table>
		  </td>
      </td>
      </tr>
     
      <tr id="tr_experiencia26">
      <td colspan="4" align="center">
      <button type="button" name="Continuar"  id="Continuar" class="button_personal"  onclick="javascript:send('Continuar');">Continuar</button>
      </td>
      </tr>
     
      
      </table>
      <p></div>
</p>
</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php include('../footer.php'); ?>

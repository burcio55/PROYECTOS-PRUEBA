<?/*
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname_recibos,$username_recibos,$password_recibos,$db4);
$conn1->debug = false;

$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug =false;
$conn1->debug =false;


doAction($conn,$conn1);
debug($settings['debug']=false);
showHeader();
showForm($conn,$aDefaultForm);
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
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn,$conn1){
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
				 LoadData($conn,$conn1,true);
			break;
			
			case 'btRif':
			$bValidateSuccess= true;	
					
			if ($_POST['rif']!="" and !ereg ("([J?V?G?E]{1}[0-9]{9})", $_POST['rif'])) { 
			   $GLOBALS['aPageErrors'][]= "- El Rif: debe ser Comenzar con J, V, G, E seguido de Nueve digitos numericos.";
			   $bValidateSuccess=false;
			   }
			   else{
					$SQL = "SELECT sdenominacion_comercial, srazon_social, snil
						  FROM rnee.rnee_empresa 
						  WHERE srif ='".$_POST['rif']."'";				
				    $rs3 = $conn1->Execute($SQL);										
				    if ($rs3->RecordCount()>0){ 
					//	$_POST['rif']=$rs3->fields['srif'];
						$_POST['patrono']=htmlspecialchars($rs3->fields['srazon_social'], ENT_QUOTES);	
					  }
     				else{				
					$GLOBALS['aPageErrors'][]= "Esta empresa no se encuentra inscrita en el Registro Nacional de Empresas y Establecimientos.";
					$bValidateSuccess=false;
					}
						}
					
			LoadData($conn,$conn1,true);
			break;
					
			case 'cbOcupacion5_experiencia_changed':
			    LoadData($conn,$conn1,true);
				LoadOcupacion5_experiencia($conn, $param);
			break;
						
			case 'cbAct_economica4_changed':
			    LoadData($conn,$conn1,true);
				LoadAct_economica4($conn);
			break;			
			
			case 'Cancelar': 
			  unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn,$conn1,false);	
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
				ProcessForm($conn,$conn1);
				}
			
			LoadData($conn,$conn1,true);	
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
				?><script>document.location='1_10agen_trab_participacion.php'</script><?	
			break;
	        }
		}		
		else{
		LoadData($conn,$conn1,false);
		}
}
//------------------------------------------------------------------------------
function LoadData($conn,$conn1,$bPostBack){
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
function ProcessForm($conn){
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
 include('header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){*/
?>
<!--style type="text/css">
.Estilo12 {color: #030303}
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
					var form = document.frm_experiencia;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script-->

<? include("header.php"); ?>

	<input name="action" type="hidden" value=""/>
	<input name="edit" type="hidden" value="<?=$_POST['edit']?>" /> 
	<input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
	<input name="accion" type="hidden" value="<?=$_POST['accion']?>" /> 

	<!-- Body nuevo Bootstrap 4 -->

	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<section class="content">
				<div class="container-fluid">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title"> Información de Experiencia Laboral </h3>
						</div>
						<form class="form-horizontal">
							<div class="card-body">
								<div class="form-group row" >
									<div class="col-sm-12 ">
										<center>
											<div class="col-sm-6">
												<label class="text-secondary">¿Tiene Experiencia Laboral? *</label>
												<div class="input-group">
													<div class="input-group-addon">
														<samp></samp>
													</div>
												</div>
												<select id="cbExperiencia" name="cbExperiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2" onChange="javascript:send('cbNo_tiene_changed');">
													<option value="0" selected="selected">Seleccionar</option>
													<option onchange="" onchange="abrir()" value="1" <? if (($aDefaultForm['cbExperiencia'])=='1') print 'selected="selected"';?>>Si</option>
													<option value="0" <? if (($aDefaultForm['cbExperiencia'])=='0') print 'selected="selected"';?>>No</option>
												</select>
											</div>
										</center>
									</div>
									<div class="col-sm-12">
										<br>
										<center>
											<button type="button" name="Continuar" id="tr_esperiencia" class="btn btn-outline-primary"  onclick="javascript:send('Continuar');">Continuar</button>
										</center>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<section class="content" id="tr_experiencia1">
				<div class="container-fluid">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"> Entidad de Trabajo </h3>
						</div>
						<form class="form-horizontal">
							<div class="card-body">
								<div class="form-group row" >									
									<div class="col-sm-6">
										<div class="col-sm-12">
											<label class="text-secondary">RIF *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<input name="rif" type="text" style="border-radius: 15px; text-align: left;" class=" form-control form-control-sm select2" id="rif" value="<?=$aDefaultForm['rif']?>" size="20" maxlength="10"><br>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="col-sm-12">
											<label class="text-secondary">Patrono o Entidad de Trabajo *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-book-open"></samp>
												</div>
												<input name="patrono" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="patrono" value="<?=$aDefaultForm['patrono']?>" size="50" maxlength="100">
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<center>
											<button type="submit" name="btRif"  id="btRif" class="btn btn-outline-primary"  onclick="javascript:send('btRif');">Buscar</button>
										</center>
									</div>

									<!-- Columna 1 Izquierda -->

									<div class="col-sm-6 ">
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Teléfono de Contacto</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-phone"></samp>
												</div>
												<input name="Telf_patrono" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="Telf_patrono" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['Telf_patrono']?>" size="15" maxlength="11">
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Actividad Económica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbAct_economica4" id="cbAct_economica4" style="border-radius: 15px;" class=" form-control form-control-sm select2">
													<option value="-1" selected="selected">Seleccionar</option>
													<? /*LoadAct_economica4($conn) ; print $GLOBALS['sHtml_cb_Act_economica4'];*/ ?> 
												</select>
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Actividad Económica Específica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbAct_economica3" id="cbAct_economica3" style="border-radius: 15px;" class=" form-control form-control-sm select2">
													<option value="">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Actividad Económica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbAct_economica1" id="cbAct_economica1" style="border-radius: 15px;" class=" form-control form-control-sm select2" title="Actividad economica - Seleccione solo una opcion del listado">
													<option value="-1">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Duración *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-clock"></samp>
												</div>
												<input name="Duracion_curso" type="text" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="Duracion_curso" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['Duracion_curso']?>" size="10" maxlength="4">
											</div>
										</div-->
									</div>

									<!-- Columna 2 Derecha -->

									<div class="col-sm-6">
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Sector Empleador </label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbSector_empleo" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="cbSector_empleo">
													<option value="-1" selected="selected">Seleccionar</option>
													<? /*LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo']*/;?>
												</select>
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Actividad Económica General *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<select name="cbAct_economica2" id="cbAct_economica2" style="border-radius: 15px;" class=" form-control form-control-sm select2" title="Actividad economica General - Seleccione solo una opcion del listado">
													<option value="-1">Seleccionar</option>
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Teléfono</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
												<input name="Telf_patrono" type="text" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="Telf_patrono" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['Telf_patrono']?>" size="15" maxlength="11">
											</div>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;"> Fecha de Realización</label>
											<div class="input-group" >
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 5px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="far fa-calendar-alt"></samp>
												</div>
												<input name="f_Duracion_curso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_Duracion_curso" value="<?=$aDefaultForm['f_Duracion_curso']?>" size="10">
											</div>
										</div-->
									</div>
									<!--div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;"> Observaciones Generales</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea class="form-control" id="Observaciones_curso" value="<?=$aDefaultForm['Observaciones_curso']?>" type="text" value="<?=$aDefaultForm['Observaciones_educacion']?>" size="50" maxlength="100"></textarea>
									</div>
									<div class="col-sm-12">
										<br>
										<center>
											<button type="button" name="Continuar"  id="Continuar" class="btn btn-outline-primary"  onclick="javascript:send('Continuar');">Continuar</button>
										</center>
									</div-->
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<section class="content" id="tr_experiencia2">
				<div class="container-fluid">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"> Datos del Empleo </h3>
						</div>
						<form class="form-horizontal">
							<div class="card-body">
								<div class="form-group row" >

									<!-- Columna 1 Izquierda -->

									<div class="col-sm-6 ">
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación Detalle *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacion5_experiencia" id="cbOcupacion5_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1" selected="selected">Seleccionar</option>
												<?/* LoadOcupacion5_experiencia ($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_experiencia'];*/ ?>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Fecha de Ingreso *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-calendar-alt"></samp>
												</div>
												<input name="f_ingreso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_ingreso" value="<?=$aDefaultForm['f_ingreso']?>" size="10">
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación Específica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacion3_experiencia" id="cbOcupacion3_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacionG_experiencia" id="cbOcupacionG_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Tipo de Terminación de Trabajo *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbMotivo_retiro" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1" selected="selected">Seleccionar</option>
												<? /*LoadMotivo_retiro($conn); print $GLOBALS['sHtml_cb_Motivo_retiro'];*/?>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Personal Supervisado *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbPersonal_supervisado" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="cbPersonal_supervisado">
												<option value="-1" selected="selected">Seleccionar</option>
												<option value="1" <? if (($aDefaultForm['cbPersonal_supervisado'])=='1') print 'selected="selected"';?>>0</option>
												<option value="2" <? if (($aDefaultForm['cbPersonal_supervisado'])=='2') print 'selected="selected"';?>>1 a 5</option>
												<option value="3" <? if (($aDefaultForm['cbPersonal_supervisado'])=='3') print 'selected="selected"';?>>6 a 10</option>
												<option value="4" <? if (($aDefaultForm['cbPersonal_supervisado'])=='4') print 'selected="selected"';?>>Más de 10</option>
											</select>
										</div-->
									</div>

									<!-- Columna 2 Derecha -->

									<div class="col-sm-6 ">
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación Específica *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacion4_experiencia" id="cbOcupacion4_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Ocupación General *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbOcupacionE_experiencia" id="cbOcupacionE_experiencia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
												<option value="-1">Seleccionar</option>
											</select>
										</div-->
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Tipo de Relación de Trabajo *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<select name="cbRelacion_trabajo" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="cbRelacion_trabajo">
												<option value="-1" selected="selected">Seleccionar</option>
												<option value="2" <? if (($aDefaultForm['cbRelacion_trabajo'])=='2') print 'selected="selected"';?>>Cuenta propia</option>
												<option value="3" <? if (($aDefaultForm['cbRelacion_trabajo'])=='3') print 'selected="selected"';?>>Cuenta ajena</option>
											</select>
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Fecha de Egreso *</label>
											<div class="input-group">
												<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 7px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
													<samp class="fas fa-calendar-alt"></samp>
												</div>
												<input name="f_egreso" type="date" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" id="f_egreso" value="<?=$aDefaultForm['f_egreso']?>" size="10">
											</div>
										</div>
										<!--div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Salario Mensual (Bs.) *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<input name="sueldo" type="number" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="sueldo" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['sueldo']?>" size="10" maxlength="6">
										</div>
										<div class="col-sm-12">
											<label class="text-secondary" style="margin-top: 10px;">Equipos o Herramientas que Maneja *</label>
											<div class="input-group">
												<div class="input-group-addon">
													<samp></samp>
												</div>
											</div>
											<textarea name="herramienta_trabajo" cols="28" class="form-control" id="herramienta_trabajo"><?=$aDefaultForm['herramienta_trabajo']?></textarea>
										</div-->
									</div>
									<div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;"> Otras Habilidades y Destrezas</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<textarea name="Otra_habilidad" cols="60" class="form-control" id="Otra_habilidad"><?=$aDefaultForm['Otra_habilidad']?></textarea>
									</div>
									<div class="col-sm-12">
										<br>
										<center>
											<button type="button" name="Agregar"  id="Agregar" class="btn btn-outline-primary"  onClick="javascript:send('Agregar');">Agregar</button>
										</center>
									</div>
									
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<section class="content" id="tr_experiencia3">
				<div class="container-fluid">
					<table class="table table-hover table-bordered table-striped table-sm">
						<thead>
							<tr class="text-secondary">
								<th class="text-center" >Ocupación</th>
								<th class="text-center" >Patrono / Empleador</th>
								<th class="text-center">N° R.I.F</th>
								<th class="text-center">Fecha de Ingreso</th>
								<th class="text-center" >Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?
								$aTabla=$_SESSION['aTabla'];
								$aDefaultForm = $GLOBALS['aDefaultForm'];
								for( $i=0; $i<count($aTabla); $i++){
									if (($i%2) == 0) 
										$class_name = "dataListColumn2";
									else 
										$class_name = "dataListColumn";
							?>
							<tr class="<?=$class_name?>">
								<td class="texto-normal"><p style="font-size: 14px;"><?=$aTabla[$i]['ocupacione']?></p></td>
								<td class="texto-normal"><p style="font-size: 14px;"><?=$aTabla[$i]['patrono']?></p></td>
								<td class="texto-normal"><p style="font-size: 14px;"><?=$aTabla[$i]['rif']?></p></td>
								<td class="texto-normal"><p style="font-size: 14px;">
									<? if ($aTabla[$i]['f_ingreso']=='0000-00-00')
											{ print '0000-00-00';}
										else 
										{ print strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_ingreso']));}
									?></p>
								</td>
								<td>
									<div style="margin: 0 0 -20px 0;"> 
										<a href="1_5agen_trab_educacion.php?id_po=<?=$aTabla[$i]['id']?>&accion=1"><input type="button" value="Editar" class="btn btn-outline-primary "></a>
										<a href="1_5agen_trab_educacion.php?id_po=<?=$aTabla[$i]['id']?>&accion=2"><input type="button" value="Eliminar" class="btn btn-outline-danger "></a>
									</div>
								</td>
							</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-12">
					<br>
					<center>
						<a href="1_12agen_trab_foto.php"><button type="button" name="Continuar"  id="tr_experiencia4" class="btn btn-outline-primary"  onclick="javascript:send('Continuar');">Continuar</button></a>
						<a href="1_6agen_trab_ocupacion.php"><button type="button" name="cancelar"  id="tr_experiencia4" class="btn btn-outline-danger"  onclick="javascript:send('cancelar');">Regresar</button></a>
					</center>
				</div>
			</section>
		</div>
		</div>
		</div>
	</body>

	<script>
		function abrir(){
			document.getElementById('tr_esperiencia').style.display="none";
			document.getElementById('tr_esperiencia1').style.display="block";
			document.getElementById('tr_esperiencia2').style.display="block";
			document.getElementById('tr_esperiencia3').style.display="block";
			document.getElementById('tr_esperiencia4').style.display="block";
		}

		function cerrar(){
			document.getElementById('tr_esperiencia').style.display="block";
			document.getElementById('tr_esperiencia1').style.display="none";
			document.getElementById('tr_esperiencia2').style.display="none";
			document.getElementById('tr_esperiencia3').style.display="none";
			document.getElementById('tr_esperiencia4').style.display="none";
		}
	</script>
	  
	<!-- Código Viejo -->

				<!--table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th colspan="2" class="titulo">Experiencia Laboral</th>
        </tr>
        <tr>
        <th colspan="2" class="sub_titulo" align="left">Informaci&oacute;n de experiencia laboral:</th>
        </tr>
        <tr>
        <td><div align="right">Tiene experiencia laboral?: </div></td>
        <td><select id="cbExperiencia" name="cbExperiencia" class="tablaborde_shadow" onChange="javascript:send('cbNo_tiene_changed');" title="Experiencia Laboral - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <option value="1" <? if (($aDefaultForm['cbExperiencia'])=='1') print 'selected="selected"';?>>Si</option>
        <option value="0" <? if (($aDefaultForm['cbExperiencia'])=='0') print 'selected="selected"';?>>No</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        <tr id="tr_experiencia">
        <th colspan="2" class="sub_titulo" align="left">Datos de (la) patrono(a) &oacute; entidad de trabajo:</th>
        </tr>        
        <tr id="tr_experiencia1">
        <td><div align="right">RIF:</div></td>
        <td><input name="rif" type="text" class="tablaborde_shadow" id="rif" value="<?=$aDefaultForm['rif']?>" size="20" maxlength="10" title="RIF - Ingrese J, V, G, E en mayuscula seguido de nueve digitos numericos, Ejm: J123456789, V123456789, E123456789, G123456789 "/>
        <span class="requerido">
        <button type="submit" name="btRif"  id="btRif" class="button"  onclick="javascript:send('btRif');" title="Buscar en el Registro Nacional de Entidades de Trabajo">Buscar en Rnee</button>

        </span></td>
        </tr>
        
        <tr id="tr_experiencia3">
        <td width="38%"><div align="right">Patrono(a) &oacute; entidad de trabajo:</div></td>
        <td width="62%"><input name="patrono" type="text" class="tablaborde_shadow" id="patrono" value="<?=$aDefaultForm['patrono']?>" size="50" maxlength="100"  title="Nombre del (de la) patrono(a) o entidad de trabajo - Ingrese solo letras y/o numeros" />
        <span class="requerido"> *</span></td>
        </tr>
        
        <tr id="tr_experiencia4">
        <td><div align="right">Sector empleador: </div></td>
        <td><span class="links-menu-izq">
        <select name="cbSector_empleo" class="tablaborde_shadow" id="cbSector_empleo" title="Sector empleador - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <?/* LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo'];?>
        </select>
        <span class="requerido"> *</span></span></td>
        </tr>
        
        <tr id="tr_experiencia5">
        <td><div align="right">Actividad econ&oacute;mica sub específica: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica4" id="cbAct_economica4" class="tablaborde_shadow" title="Actividad economica Sub Especifica - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadAct_economica4($conn) ; print $GLOBALS['sHtml_cb_Act_economica4']; ?> 
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia6">
        <td><div align="right">Actividad econ&oacute;mica específica: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica3" id="cbAct_economica3" class="tablaborde_shadow" title="Actividad economica Especifica - Seleccione solo una opcion del listado">
        <option value="">Seleccionar</option>
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia7">
        <td><div align="right">Actividad econ&oacute;mica general: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica2" id="cbAct_economica2" class="tablaborde_shadow" title="Actividad economica General - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia8">
        <td><div align="right">Actividad econ&oacute;mica: </div></td>
        <td><span class="links-menu-izq"><span class="requerido">
        <select name="cbAct_economica1" id="cbAct_economica1" class="tablaborde_shadow" title="Actividad economica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>*</span></span></td>
        </tr>
        
        <tr id="tr_experiencia9">
        <td><div align="right">Tel&eacute;fono:</div></td>
        <td><input name="Telf_patrono" type="text" class="tablaborde_shadow" id="Telf_patrono" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['Telf_patrono']?>" size="15" maxlength="11"  title="Telefono - Ingrese solo numeros"/></td>
        </tr>
        <tr id="tr_experiencia0">
        <th colspan="2" class="sub_titulo" align="left">Datos del empleo:</th>
        </tr>
        
        <tr id="tr_experiencia10">
        <td><div align="right">Fecha de ingreso:</div></td>
        <td>
        <input name="f_ingreso" type="text" class="tablaborde_shadow" id="f_ingreso" value="<?=$aDefaultForm['f_ingreso']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_ingreso",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>	<span class="requerido">*</span>  </td>
        </tr>
        
        <tr id="tr_experiencia11">
        <td><div align="right">Fecha de egreso:</div></td>
        <td>
        <input name="f_egreso" type="text" class="tablaborde_shadow" id="f_egreso" value="<?=$aDefaultForm['f_egreso']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger_1"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_egreso",
        trigger    : "f_rangeStart_trigger_1",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>		  </td>
        </tr>
        
        <tr id="tr_experiencia12">
        <td><div align="right">Ocupación detalle:</div></td>
        <td width="62%"><select name="cbOcupacion5_experiencia" id="cbOcupacion5_experiencia" class="tablaborde_shadow" title="Ocupacion detalle - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadOcupacion5_experiencia ($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_experiencia']; ?>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia13">
        <td><div align="right">Ocupaci&oacute;n sub especifica: </div></td>
        <td><select name="cbOcupacion4_experiencia" id="cbOcupacion4_experiencia" class="tablaborde_shadow" title="Ocupacion sub especifica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia14">
        <td><div align="right">Ocupaci&oacute;n específica: </div></td>
        <td><select name="cbOcupacion3_experiencia" id="cbOcupacion3_experiencia" class="tablaborde_shadow" title="Ocupacion especifica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia15">
        <td><div align="right">Ocupaci&oacute;n general: </div></td>
        <td><select name="cbOcupacionE_experiencia" id="cbOcupacionE_experiencia" class="tablaborde_shadow" title="Ocupacion general - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia16">
        <td><div align="right">Ocupación:</div></td>
        <td><select name="cbOcupacionG_experiencia" id="cbOcupacionG_experiencia" class="tablaborde_shadow" title="Ocupacion - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia17">
        <td><div align="right">Tipo de relaci&oacute;n de trabajo: </div></td>
        <td><select name="cbRelacion_trabajo" class="tablaborde_shadow" id="cbRelacion_trabajo" title="Tipo de relacion de trabajo - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <option value="2" <? if (($aDefaultForm['cbRelacion_trabajo'])=='2') print 'selected="selected"';?>>Cuenta propia</option>
        <option value="3" <? if (($aDefaultForm['cbRelacion_trabajo'])=='3') print 'selected="selected"';?>>Cuenta ajena</option>
        </select>
        <span class="requerido"> *</span></td>
        </tr>
        
        <tr id="tr_experiencia18">
        <td><div align="right">Causales de terminaci&oacute;n de la relaci&oacute;n de trabajo:</div></td>
        <td><span class="links-menu-izq">
        <select name="cbMotivo_retiro" class="tablaborde_shadow" title="Causales de terminaci&oacute;n de la relaci&oacute;n de trabajo - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadMotivo_retiro($conn); print $GLOBALS['sHtml_cb_Motivo_retiro'];?>
        </select>
        </span></td>
        </tr>
        
        <tr id="tr_experiencia19">
        <td><div align="right">Salario mensual final &oacute; actual (Bsf.):</div></td>
        <td><input name="sueldo" type="text" class="tablaborde_shadow" id="sueldo" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['sueldo']?>" size="10" maxlength="6" title="Salario mensual final &oacute; actual - Ingrese solo numeros"/>
        <span class="requerido"> *</span></td>
        </tr>
        
        <tr id="tr_experiencia20">
        <td><div align="right">Personal supervisado:</div></td>
        <td><select name="cbPersonal_supervisado" class="tablaborde_shadow" id="cbPersonal_supervisado" title="Personal supervisado - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <option value="1" <? if (($aDefaultForm['cbPersonal_supervisado'])=='1') print 'selected="selected"';?>>0</option>
        <option value="2" <? if (($aDefaultForm['cbPersonal_supervisado'])=='2') print 'selected="selected"';?>>1 a 5</option>
        <option value="3" <? if (($aDefaultForm['cbPersonal_supervisado'])=='3') print 'selected="selected"';?>>6 a 10</option>
        <option value="4" <? if (($aDefaultForm['cbPersonal_supervisado'])=='4') print 'selected="selected"';?>>Más de 10</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>
        
        <tr id="tr_experiencia21">
        <td><div align="right">Equipos/herramientas que manej&oacute; en este empleo:</div></td>
        <td><textarea name="herramienta_trabajo" cols="28" class="tablaborde_shadow" id="herramienta_trabajo" title="Equipos/herramientas que manej&oacute; en este empleo - Ingrese solo letras y/o numeros" ><?=$aDefaultForm['herramienta_trabajo']?></textarea></td>
        </tr>
        
        <tr id="tr_experiencia22">
        <td><div align="right">Breve descripci&oacute;n del trabajo desempe&ntilde;ado: </div></td>
        <td><textarea name="observaciones_experiencia" cols="28" class="tablaborde_shadow" id="observaciones_experiencia" title="Breve descripci&oacute;n del trabajo desempe&ntilde;ado - Ingrese solo letras y/o numeros"><?=$aDefaultForm['observaciones_experiencia']?></textarea></td>
        </tr>
        
        <tr id="tr_experiencia23">
          <td>&nbsp;</td>
          <td><span class="requerido">
            <? if($_POST['edit']==""){ ?>
            <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Agregar</button>
            <? }
             else{ ?>
            <button type="button" name="Actualizar"  id="Actualizar" class="button"  onClick="javascript:send('Agregar');">Actualizar</button>
          </span>
            <? }?>
            <span class="requerido">
            <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
         </span></td>
        </tr>
        <tr id="tr_experiencia25">
        <td height="50" colspan="2">
          
          
              <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
              <tr>
              <th width="35%" class="labelListColumn">Ocupación</th>
              <th width="35%" class="labelListColumn">Patrono/Empleador</th>
              <th width="10%" class="labelListColumn">Rif</th>
              <th width="10%" class="labelListColumn">Fecha de Ingreso</th>
              <th width="10%" class="labelListColumn">Acciones</th>
              </tr>
              <?
              $aTabla=$_SESSION['aTabla'];
              $aDefaultForm = $GLOBALS['aDefaultForm'];
              for( $i=0; $i<count($aTabla); $i++){
              if (($i%2) == 0) $class_name = "dataListColumn2";
              else $class_name = "dataListColumn";
              ?>
              <tr class="<?=$class_name?>">
              <td class="texto-normal"><div align="left">
              <?=$aTabla[$i]['ocupacione']?>
              </div></td>
              <td class="texto-normal"><div align="left">
              <?=$aTabla[$i]['patrono']?>
              </div></td>
              <td class="texto-normal"><div align="left">
              <?=$aTabla[$i]['rif']?>
              </div></td>
              <td class="texto-normal"><div align="left">
              <? if ($aTabla[$i]['f_ingreso']=='0000-00-00'){ print '0000-00-00';}
              else { print strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_ingreso']));}
              ?>
              </div></td>
              <td class="texto-normal"><a href="1_8agen_trab_experiencia.php?id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="../imagenes/pencil_16.png"  border="0" title="Editar" /></a> <a href="1_8agen_trab_experiencia.php?id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="../imagenes/delete_16.png"  border="0" title="Eliminar" /></a> </td>
              </tr>
              <? } ?>
              </table>	
		  
      </td>
      </tr>
     
      <tr id="tr_experiencia26">
      <td colspan="2" align="center">
      <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
      </td>
      </tr>
     
      
      </table-->
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
*/?> 

<?php include('footer.php'); ?>

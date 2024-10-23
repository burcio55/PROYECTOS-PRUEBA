<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');

include('Trazas.class.php');
$conn = getConnDB('sire');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname_recibos,$username_recibos,$password_recibos,$db4);
$conn1->debug = false;


//CONEXION CON LA TABLA ENTES
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db5);
$conn2->debug = false;
/*var_dump($conn1);
var_dump($conn2);*/
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug =false;



doAction($conn,$conn1,$conn2);
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
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn,$conn1,$conn2){
	if (isset($_POST['action'])){
		switch($_POST['action']){		
		 			
			case 'btRif':
			$bValidateSuccess= true;	
					 	
			if ($_POST['rif']!="" and !ereg ("([J?V?G?E]{1}[0-9]{9})", $_POST['rif'])) { 
			   $GLOBALS['aPageErrors'][]= "- El Rif: debe ser Comenzar con J, V, G, E seguido de Nueve digitos numericos.";
			   $bValidateSuccess=false;
			  // echo "es false";
			   }else{
					$SQL="SELECT * FROM seniat 	WHERE srif='".$_POST['rif']."' ";				
					$rs2 = $conn2->Execute($SQL);		
				 
				    if ($rs2->RecordCount()>0){ 
						$_POST['rif']=$rs2->fields['srif'];
						$_POST['patrono']=htmlspecialchars($rs2->fields['srazon_social'], ENT_QUOTES);
						$_POST['patrono2']=htmlspecialchars($rs2->fields['sdenominacion_comercial'], ENT_QUOTES);	
					  }
     				else{				
					$GLOBALS['aPageErrors'][]= "Esta empresa no se encuentra inscrita en el SENIAT.";
					?><script>alert("Esta empresa no se encuentra inscrita en el SENIAT.");</script>
                    <?
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
			?><script> 
				    document.location='?menu=18'</script><?
			    /*unset($_POST['id_po']);
				unset($_POST['accion']);
				LoadData($conn,$conn1,false);*/	
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
			 
			/*if ($_POST['cbOcupacionG_experiencia']=="-1"){  
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
					 }*/
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
		
			if ($_POST['cbPersonal_supervisado']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Personal supervisado: es requerido.";
					$bValidateSuccess=false;
					 }
				}
					//echo "aquiii boton";
			if ($bValidateSuccess){	
					
				ProcessForm($conn,$conn1);
				}
			
			LoadData($conn,$conn1,true);	
			break;	
			

						
			case 'Continuar': 
			$bValidateSuccess=true;	
			$sfecha=date('Y-m-d');
			
			if ($_POST['cbpais_ext']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Trabajo en otro pais: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbpais_ext']=="1"){
				
				if ($_POST['cbpais_donde_laboro']=="-1"){
					$GLOBALS['aPageErrors'][]= "- En que pais?: es requerido.";
					$bValidateSuccess=false;
					 }
				if ($_POST['nombre_ultimo_trab_ext']==""){
					$GLOBALS['aPageErrors'][]= "- Nombre del ultimo sitio de trabajo: es requerido.";
					$bValidateSuccess=false;
					 }
				if ($_POST['cargo_trab_ext']==""){
					$GLOBALS['aPageErrors'][]= "- Cargo desempeñado?: es requerido.";
					$bValidateSuccess=false;
					 }
				if ($_POST['f_egreso_ext']==""){
					$GLOBALS['aPageErrors'][]= "- Fecha de egreso: es requerida.";
					$bValidateSuccess=false;
					 }
				else{
					if($_POST['f_egreso_ext']> $sfecha){		
					$GLOBALS['aPageErrors'][]= "- Fecha de egreso: no puede ser mayor a la fecha actual.";
					$bValidateSuccess=false;
				 	}
				}
				if ($_POST['duracion_rel_laboral_ext']==""){
					$GLOBALS['aPageErrors'][]= "- Duracion en el cargo: es requerido.";
					$bValidateSuccess=false;
					 }
			}
			if ($_POST['cbExperiencia']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Tiene experiencia laboral?: es requerido.";
					$bValidateSuccess=false;
					 }
			
			LoadData($conn,$conn1,true);
			
			if ($bValidateSuccess){	
					
				if ($_POST['cbExperiencia']=='0'){				 	
					$sfecha=date('Y-m-d');
					$sql="delete  from persona_experiencia_laboral 
					where persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs= $conn->Execute($sql);
//Trazas------------------------------------------------------------------------------------------------------------			
					$id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='8';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);	
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
			if ($_POST['cbpais_ext']=='0'){
				$f_egreso='';
				$_POST['duracion_rel_laboral_ext']='0';
				$_POST['cbpais_donde_laboro']='-1';
				$_POST['nombre_ultimo_trab_ext']='';
				$_POST['duracion_rel_laboral_ext']='0';
				$_POST['cargo_trab_ext']='';
			}
			else{
				$f_egreso="f_egreso_ext = '".$_POST['f_egreso_ext']."',";
				}
			
			$sql="update personas set 
				  experiencia_laboral = '".$_POST['cbExperiencia']."',
				  pais_ext = '".$_POST['cbpais_ext']."',
				  pais_donde_laboro = '".$_POST['cbpais_donde_laboro']."',
				  nombre_ultimo_trab_ext = '".$_POST['nombre_ultimo_trab_ext']."',				  
				  duracion_rel_laboral_ext = '".$_POST['duracion_rel_laboral_ext']."',
				  cargo_trab_ext = '".$_POST['cargo_trab_ext']."',
				  ".$f_egreso."
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'				  
				  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
			  	  $conn->Execute($sql);	 
				?><script>document.location='?menu=19'</script><?
				}
					
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
		$aDefaultForm['patrono2']='';
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
		$aDefaultForm['cbPersonal_supervisado']='-1';
		$aDefaultForm['herramienta_trabajo']='';
		$aDefaultForm['observaciones_experiencia']=''; 
		$aDefaultForm['act_eco']=''; 
		$aDefaultForm['ocupacion']=''; 
		$aDefaultForm['cbExperiencia']='-1';
		
		$aDefaultForm['cbpais_ext']='-1';
		$aDefaultForm['cbpais_donde_laboro']='-1';
		$aDefaultForm['nombre_ultimo_trab_ext']='';
		$aDefaultForm['cargo_trab_ext']='';
		$aDefaultForm['f_egreso_ext']='';
		$aDefaultForm['duracion_rel_laboral_ext']='';
	
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
						$aDefaultForm['patrono2']=$rs->fields['sdenominacion_comercial'];
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
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['act_economica3']; ?>" }, 
					function(data){  $("#cbAct_economica3").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['act_economica3']; ?>";
					combo="Actividad";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['act_economica2']; ?>" },
					function(data){  $("#cbAct_economica2").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['act_economica2']; ?>";
					combo="Actividad";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['act_economica1']; ?>" },                    function(data){  $("#cbAct_economica1").html(data);
					});            
					});
					
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacion5']; ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupacion4']; ?>" }, 
					function(data){  $("#cbOcupacion4_experiencia").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacion4']; ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupacion3']; ?>" }, 
					function(data){  $("#cbOcupacion3_experiencia").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacion3']; ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupacione_id']; ?>" }, 
					function(data){  $("#cbOcupacionE_experiencia").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs->fields['ocupacione_id'] ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs->fields['ocupaciong_id']; ?>"}, 
					function(data){  $("#cbOcupacionG_experiencia").html(data);
					});            
					});
					</script>
					<?php
			
					//	$aDefaultForm['cbRelacion_trabajo']=$rs->fields['relacion_trabajo'];
						$aDefaultForm['cbMotivo_retiro']=$rs->fields['motivo_retiro_id'];
					//	$aDefaultForm['sueldo']=$rs->fields['sueldo_final'];
						$aDefaultForm['cbPersonal_supervisado']=$rs->fields['personal_supervisado'];
						$aDefaultForm['herramienta_trabajo']=$rs->fields['equipos_herramientas'];
						$aDefaultForm['observaciones_experiencia']=$rs->fields['descripcion_empleo'];
						$_SESSION['sesiones']=$rs->fields['sesiones'];
				}
			}	
			
			if ($_POST['accion']=='2'){
			$sql="delete  from persona_experiencia_laboral 
					where id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs= $conn->Execute($sql);	
					//Trazas---------------------------------------------------------------------------------------------
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='8';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
					
				$_POST['id_po']='';
				$_POST['accion']='';	
				?><script>alert("- Se elimino el registro correctamente"); 
				document.location='?menu=18'</script><?
                    
			}
			
//-----------------------------query general que muestra los valores de la tabla personas
		$SQL="select personas.experiencia_laboral, pais_ext, pais_donde_laboro, nombre_ultimo_trab_ext, f_egreso_ext, duracion_rel_laboral_ext, cargo_trab_ext 
					from personas where id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
		 $rs = $conn->Execute($SQL);
		 if ($rs->RecordCount()>0){	
		 		 $aDefaultForm['cbpais_ext']=$rs->fields['pais_ext'];
				 $aDefaultForm['cbpais_donde_laboro']=$rs->fields['pais_donde_laboro'];
				 $aDefaultForm['nombre_ultimo_trab_ext']=$rs->fields['nombre_ultimo_trab_ext'];
				 $aDefaultForm['cargo_trab_ext']=$rs->fields['cargo_trab_ext'];
				 $aDefaultForm['f_egreso_ext']=$rs->fields['f_egreso_ext'];
				 $aDefaultForm['duracion_rel_laboral_ext']=$rs->fields['duracion_rel_laboral_ext'];				 
		 		 $aDefaultForm['cbExperiencia']=$rs->fields['experiencia_laboral'];
				  
				 if($aDefaultForm['cbExperiencia']=='1'){
				 $SQL1="select persona_experiencia_laboral.id, persona_experiencia_laboral.patrono, persona_experiencia_laboral.f_ingreso,
					persona_experiencia_laboral.f_egreso, ocupacion.nombre as ocupacione, rif			
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
}	
			
				
else{   
		$aDefaultForm['rif']=$_POST['rif'];
		$aDefaultForm['patrono']=$_POST['patrono'];		
		$aDefaultForm['patrono2']=$_POST['patrono2'];	
		$aDefaultForm['cbSector_empleo']=$_POST['cbSector_empleo'];
		$aDefaultForm['Telf_patrono']=$_POST['Telf_patrono']; 
		$aDefaultForm['f_ingreso']=$_POST['f_ingreso'];
		$aDefaultForm['f_egreso']=$_POST['f_egreso']; 
		//$aDefaultForm['cbRelacion_trabajo']=$_POST['cbRelacion_trabajo']; 
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
		
		$aDefaultForm['cbpais_ext']=$_POST['cbpais_ext'];
		$aDefaultForm['cbpais_donde_laboro']=$_POST['cbpais_donde_laboro'];
		$aDefaultForm['nombre_ultimo_trab_ext']=$_POST['nombre_ultimo_trab_ext'];
		$aDefaultForm['cargo_trab_ext']=$_POST['cargo_trab_ext'];
		$aDefaultForm['f_egreso_ext']=$_POST['f_egreso_ext'];
		$aDefaultForm['duracion_rel_laboral_ext']=$_POST['duracion_rel_laboral_ext'];
		?>	
		<script language="javascript" src="../js/jquery.js"></script>
		<script>
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbAct_economica4']; ?>";
		combo="Actividad";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbAct_economica3']; ?>" }, 
		function(data){  $("#cbAct_economica3").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbAct_economica3']; ?>";
		combo="Actividad";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbAct_economica2']; ?>" },
		function(data){  $("#cbAct_economica2").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbAct_economica2']; ?>";
		combo="Actividad";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbAct_economica1']; ?>" },        function(data){  $("#cbAct_economica1").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacion5_experiencia']; ?>";
		combo="Ocupacion";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion4_experiencia']; ?>" }, 
		function(data){  $("#cbOcupacion4_experiencia").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacion4_experiencia']; ?>";
		combo="Ocupacion";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion3_experiencia']; ?>" }, 
		function(data){  $("#cbOcupacion3_experiencia").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacion3_experiencia']; ?>";
		combo="Ocupacion";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionE_experiencia']; ?>" }, 
		function(data){  $("#cbOcupacionE_experiencia").html(data);
		});            
		});
		
		$(document).ready(function(){
		elegido="<?php echo $_POST['cbOcupacionE_experiencia'] ?>";
		combo="Ocupacion";
		$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionG_experiencia']; ?>"}, 
		function(data){  $("#cbOcupacionG_experiencia").html(data);
		});            
		});
		</script>
		<?php
		
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
				  sdenominacion_comercial='".$_POST['patrono2']."',			 
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
				 
				  motivo_retiro_id='".$_POST['cbMotivo_retiro']."',						
				  personal_supervisado='".$_POST['cbPersonal_supervisado']."',
				  equipos_herramientas='".$_POST['herramienta_trabajo']."',
				  descripcion_empleo='".$_POST['observaciones_experiencia']."',
					updated_at='".$sfecha."',
					status='A',
					id_update='".$_SESSION['sUsuario']."'
					WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' "; 	
					$conn->Execute($sql);	
					$_POST['id_po']='';
					$_POST['accion']='';	
					?><script>alert("- Se actualizo el registro correctamente"); 
				    document.location='?menu=18'</script><?
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
		 		 (persona_id, rif, patrono,sdenominacion_comercial, sector_empleo_id, act_economica4, act_economica3, act_economica2, act_economica1,telefono,
				  f_ingreso, f_egreso,ocupacion5,ocupacion4,motivo_retiro_id, personal_supervisado, equipos_herramientas,
				  descripcion_empleo,created_at, status, id_update) 
				  values
			  	('".$_SESSION['id_afiliado']."',
				 '".$_POST['rif']."',
				 '".$_POST['patrono']."',
				  '".$_POST['patrono2']."',
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
				 '".$_POST['cbMotivo_retiro']."', 							
				 '".$_POST['cbPersonal_supervisado']."',	
				 '".$_POST['herramienta_trabajo']."',
				 '".$_POST['observaciones_experiencia']."', 			 
			  	 '$sfecha',
			   	 'A',
			   	 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql);
				 
				 $sql="update personas set 
				  experiencia_laboral = '".$_POST['cbExperiencia']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
			  	  $conn->Execute($sql);	
				  	
				$_POST['id_po']='';
				$_POST['accion']='';	
				?><script>alert("- Se agrego el registro correctamente"); 
				document.location='?menu=18'</script><?		 	
	    }
  }
 			 
  
  
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
include('menu_trabajador.php'); 
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<style type="text/css">
<!--
.Estilo12 {color: #030303}
-->
</style>
<form name="frm_experiencia" method="post" action="" >
<script language="javascript">
//Actividad economica 
$(document).ready(function(){
   $("#cbAct_economica4").change(function () {
           $("#cbAct_economica4 option:selected").each(function () {
            elegido=$(this).val();
			combo='Actividad';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
	function send2(saction){
	       if(saction=='Continuar'){
		   			if(validar_experiencia_extranjero()==true){
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
</script>

      <input name="action" type="hidden" value=""/>
      <input name="edit" type="hidden" value="<?=$_POST['edit']?>" /> 
      <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
      <input name="accion" type="hidden" value="<?=$_POST['accion']?>" />  

	<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
        <td></td>
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr>
          <th colspan="2" class="titulo">EXPERIENCIA LABORAL</th>
        </tr>
        <tr>
        <th colspan="2" class="sub_titulo" align="left">Informaci&oacute;n de experiencia laboral en el Extranjero:</th>
        </tr>
        <tr>
        <td><div align="right">Trabaj&oacute; en otro pa&iacute;s?: </div></td>
        <td>        
        <select name="cbpais_ext" class="tablaborde_shadow" id="cbpais_ext" title="Tiene experiencia laboral en el extranjero - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccionar</option>
              <option value="1" <? if (($aDefaultForm['cbpais_ext'])=='1') print 'selected="selected"';?>>Si</option>
              <option value="0" <? if (($aDefaultForm['cbpais_ext'])=='0') print 'selected="selected"';?>>No</option>
            </select>
        <span class="requerido">*</span></td>        
        </tr>
        <tr id="tr_experiencia00">
        <td><div align="right">En qu&eacute; pa&iacute;s?: </div></td>
        <td><span class="links-menu-izq">
             <select name="cbpais_donde_laboro" id="cbpais_donde_laboro" class="" title="Pais donde laboro - Seleccione solo una opcion del listado">
	          <option value="-1" selected="selected">Seleccione...</option>
	          <? Loadcbpais_donde_laboro ($conn) ; print $GLOBALS['sHtml_cbpais_donde_laboro']; ?>
	          </select>
        <span class="requerido"> *</span></span></td>
        </tr>
        <tr id="tr_experiencia01">
        <td width="38%"><div align="right">Nombre del &uacute;ltimo sitio de trabajo:</div></td>
        <td width="62%"><input name="nombre_ultimo_trab_ext" type="text" class="tablaborde_shadow" id="nombre_ultimo_trab_ext" value="<?=$aDefaultForm['nombre_ultimo_trab_ext']?>" size="50" maxlength="100"  title="Nombre del ultimo sitio de trabajo - Ingrese solo letras y/o numeros"  />
        <span class="requerido"> *</span></td>       
        </tr>
        <tr id="tr_experiencia02">
        <td width="38%"><div align="right">Cargo desempe&ntilde;ado?:</div></td>
        <td width="62%"><input name="cargo_trab_ext" type="text" class="tablaborde_shadow" id="cargo_trab_ext" value="<?=$aDefaultForm['cargo_trab_ext']?>" size="50" maxlength="100"  title="Nombre del cargo - Ingrese solo letras y/o numeros"  />
        <span class="requerido"> *</span></td>       
        </tr>
        <tr id="tr_experiencia03">
        <td><div align="right">Fecha de egreso:</div></td>
        <td>
        <input name="f_egreso_ext" type="text" class="tablaborde_shadow" id="f_egreso_ext" value="<?=$aDefaultForm['f_egreso_ext']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger_3"><img src="imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_egreso_ext",
        trigger    : "f_rangeStart_trigger_3",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>		 
         </td>
        </tr>
        </tr>
        <tr id="tr_experiencia04">
        <td width="38%"><div align="right">Duraci&oacute;n en el cargo:</div></td>
        <td width="62%">        
        <input name="duracion_rel_laboral_ext" type="text" class="duracion_rel_laboral_ext" id="duracion_rel_laboral_ext" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['duracion_rel_laboral_ext']?>" size="15" maxlength="11"  title="Duracion en el cargo - Ingrese solo numeros"/> meses
        <span class="requerido"> *</span></td>       
        </tr>
        
        
        
        
        
        <tr>
        <th colspan="2" class="sub_titulo" align="left">Informaci&oacute;n de experiencia laboral en Venezuela:</th>
        </tr>
        <tr>
        <td><div align="right">Tiene experiencia laboral?: </div></td>
        <td>        
        <select name="cbExperiencia" class="tablaborde_shadow" id="cbExperiencia" title="Tiene experiencia laboral - Seleccione solo una opcion del listado">
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
        <button type="submit" name="btRif"  id="btRif" class="button"  onclick="javascript:send('btRif');" title="Buscar en el Registro Nacional de Entidades de Trabajo">Buscar SENIAT</button></span></td>
        </tr>
        
        <tr id="tr_experiencia3">
        <td width="38%"><div align="right">Raz&oacute;n Social de la  Entidad de Trabajo:</div></td>
        <td width="62%"><input name="patrono" type="text" class="tablaborde_shadow" id="patrono" value="<?=$aDefaultForm['patrono']?>" size="50" maxlength="100"  title="Nombre o razon social de entidad de trabajo - Ingrese solo letras y/o numeros"  />
        <span class="requerido"> *</span></td>        
        </tr>
         <tr id="tr_experiencia31" ><td width="38%"><div align="right">Denominaci&oacute;n Comercial de la Entidad de Trabajo:</div></td>
        <td width="62%"><input name="patrono2" type="text" class="tablaborde_shadow" id="patrono2" value="<?=$aDefaultForm['patrono2']?>" size="50" maxlength="100"  title="Denominacion Comercial de la entidad de trabajo - Ingrese solo letras y/o numeros" />
        <span class="requerido"> *</span></td>
         </tr>
        
        <tr id="tr_experiencia4">
        <td><div align="right">Sector empleador: </div></td>
        <td><span class="links-menu-izq">
        <select name="cbSector_empleo" class="tablaborde_shadow" id="cbSector_empleo" title="Sector empleador - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo'];?>
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
        <td><input name="Telf_patrono" type="text" class="tablaborde_shadow" id="Telf_patrono" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['Telf_patrono']?>" size="15" maxlength="11"  title="Telefono - Ingrese solo numeros"/>*</span></span></td>
        </tr>
        <tr id="tr_experiencia0">
        <th colspan="2" class="sub_titulo" align="left">Datos del Empleo:</th>
        </tr>
        
        <tr id="tr_experiencia10">
        <td><div align="right">Fecha de ingreso:</div></td>
        <td>
        <input name="f_ingreso" type="text" class="tablaborde_shadow" id="f_ingreso" value="<?=$aDefaultForm['f_ingreso']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
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
        <a href="#" id="f_rangeStart_trigger_1"><img src="imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_egreso",
        trigger    : "f_rangeStart_trigger_1",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>		 
         </td>
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
        
        <!--<tr id="tr_experiencia14">
        <td><div align="right">Ocupaci&oacute;n específica: </div></td>
        <td><select name="cbOcupacion3_experiencia" id="cbOcupacion3_experiencia" class="tablaborde_shadow" title="Ocupacion especifica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select>
        <span class="requerido">*</span></td>
        </tr>-->
        
<!--        <tr id="tr_experiencia15">
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
        </tr>-->
          <tr id="tr_experiencia18">
        <td><div align="right">Causales de terminaci&oacute;n de la relaci&oacute;n de trabajo:</div></td>
        <td><span class="links-menu-izq">
        <select name="cbMotivo_retiro" id="cbMotivo_retiro" class="tablaborde_shadow" title="Causales de terminaci&oacute;n de la relaci&oacute;n de trabajo - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadMotivo_retiro($conn); print $GLOBALS['sHtml_cb_Motivo_retiro'];?>
        </select>
        </span></td>
        </tr>
        
        <!--<tr id="tr_experiencia19">
        <td><div align="right">Salario mensual final &oacute; actual (Bsf.):</div></td>
        <td><input name ="sueldo" type="text" class="tablaborde_shadow" id="sueldo" onkeypress="return permite(event, 'num')" value="<?//=$aDefaultForm['sueldo']?>" size="10" maxlength="6" title="Salario mensual final &oacute; actual - Ingrese solo numeros"/>
        <span class="requerido"> *</span></td>
        </tr>-->
        
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
        <tr>  <td>&nbsp;</td></tr>
        <tr id="tr_experiencia23" >
         
           <td colspan="3" align="center"><span class="requerido">
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

       
        <tr>  <td>&nbsp;</td></tr>
         <tr id="tr_experiencia25">
        <td height="50" colspan="2">
          
          
              <table  border="0"  align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
              <tr align="center">
              <th width="35%" class="labelListColumn">Ocupación</th>
              <th width="35%" class="labelListColumn">P<span class="requerido">
             <?  /*  }
             else{ */?>
              </span>atrono/Empleador</th>
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
              <td class="texto-normal" align="center"><a href="?menu=18&id_po=<?=$aTabla[$i]['id']?>&accion=1"><img src="imagenes/pencil_16.png"  border="0" title="Editar" /></a> <a href="?menu=18&id_po=<?=$aTabla[$i]['id']?>&accion=2"><img src="imagenes/delete_16.png"  border="0" title="Eliminar" /></a> </td>
              </tr>
              <? } ?>
              </table>	
		  
      </td>
      </tr>
     
      <tr id="tr_experiencia26">
      <td colspan="2" align="center">
      <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send2('Continuar');">Continuar</button>
      </td>
      </tr>
     
      
      </table>
      <p>
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

<?php //include('../footer.php'); ?>

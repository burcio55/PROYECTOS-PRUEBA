<?php
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
//debug($settings['debug']=false);*/
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
		var_dump($_SESSION['migra_bloq']); 
		var_dump($_SESSION['disc_bloq']);
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
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
				
			case 'Cancelar': 
				LoadData($conn,false);	
			break;
			
			case 'Continuar': 
			$bValidateSuccess=true;		
			if ($_POST['cbSituacion_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Situación ocupacional: es requerido.";
				$bValidateSuccess=false;
				 }
				if ($_POST['cbTipo_situacion_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El Tipo de situación ocupacional: es requerido.";
				$bValidateSuccess=false;
				 }
				
				if ($_POST['cbSituacion_afiliado']=="1"){
				if ($_POST['f_situacion']==""){
					$GLOBALS['aPageErrors'][]= "- La fecha de situación ocupacional: es requerida.";
					$bValidateSuccess=false;
					 }					 
			if  ($_POST['f_situacion']!=''){	
				$fecha1=$_POST['f_situacion'];
					if (preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$fecha1))
						list($año1,$mes1,$dia1)=split("-",$fecha1);				
				$fecha2=date('Y-m-d');		
						preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$fecha2);
						list($año2,$mes2,$dia2)=split("-",$fecha2);		
					if ($fecha1 > $fecha2){
						$GLOBALS['aPageErrors'][]= "- La fecha de situación ocupacional: es incorrecta.";
						$bValidateSuccess=false;
						}					 
				     }	 
				 }
				 if ($_POST['cbOcupacion5_interes_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación Detalle primera opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacion4_interes_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación Sub Específica primera opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacion3_interes_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación Específica primera opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacionE_interes_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación General primera opción: es requerida.";
				$bValidateSuccess=false;
				 }			 
				 if ($_POST['cbOcupacionG_interes_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación primera opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbExperiencia_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- La experiencia de la primera opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacion5_interes2']=="-1"){ 
				$GLOBALS['aPageErrors'][]= "- Ocupación Detalle segunda opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacion4_interes2']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación Sub Específica segunda opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacion3_interes2']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación Específica segunda opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacionE_interes2']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación General segunda opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbOcupacionG_interes2']=="-1"){  
				$GLOBALS['aPageErrors'][]= "- Ocupación segunda opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbExperiencia_2']=="-1"){
				$GLOBALS['aPageErrors'][]= "- La experiencia de la segunda opción: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['cbJornada_interes']=="-1"){
				$GLOBALS['aPageErrors'][]= "- La jornada: es requerida.";
				$bValidateSuccess=false;
				 }
				 
				 if ($_POST['cbTipo_situacion_afiliado']=="14"){
						 if ($_POST['cbLugar_trabajo']=="0"){
								$GLOBALS['aPageErrors'][]= "- El lugar de trabajo donde realiza su actividad: es requerido.";
								$bValidateSuccess=false;
								 }
							if ($_POST['cbFrecuencia_actividad']=="0"){
								$GLOBALS['aPageErrors'][]= "- La frecuencia de la actividad: es requerida.";
								$bValidateSuccess=false;
								 }
				 }else{
					 $_POST['cbLugar_trabajo']="0";
					 $_POST['cbFrecuencia_actividad']="0";
					 }
				 
				 if ($_POST['cbTrabajar_fuera']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Trabajaría fuera de la ciudad: es requerida.";
				$bValidateSuccess=false;
				 }
				 if ($_POST['salario_interes']=="0" or $_POST['salario_interes']==""){
				$GLOBALS['aPageErrors'][]= "- Salario mínimo mensual que aspira: es requerido.";
				$bValidateSuccess=false;
				 }
													  				
			if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;
	        }
		}		
		else{
		LoadData($conn,false);
		}
}
//------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	
		$aDefaultForm['cbSituacion_afiliado']='-1';
		$aDefaultForm['cbTipo_situacion_afiliado']='-1';
		$aDefaultForm['f_situacion']='';
		$aDefaultForm['cbOcupacion5_interes_1']='-1';
		$aDefaultForm['cbOcupacion4_interes_1']='-1';
		$aDefaultForm['cbOcupacion3_interes_1']='-1';
		$aDefaultForm['cbOcupacionE_interes_1']='-1';
		$aDefaultForm['cbOcupacionG_interes_1']='-1';
		$aDefaultForm['cbExperiencia_1']='-1';		
		$aDefaultForm['cbOcupacion5_interes2']='-1';
		$aDefaultForm['cbOcupacion4_interes2']='-1';
		$aDefaultForm['cbOcupacion3_interes2']='-1';
		$aDefaultForm['cbOcupacionE_interes2']='-1';
		$aDefaultForm['cbOcupacionG_interes2']='-1';
		$aDefaultForm['cbExperiencia_2']='-1';
		$aDefaultForm['cbJornada_interes']='-1';
		$aDefaultForm['cbTrabajar_fuera']='-1'; 
		$aDefaultForm['cbFrecuencia_actividad']='-1';  
		$aDefaultForm['cbLugar_trabajo']='-1';  
		$aDefaultForm['salario_interes']='';
		$aDefaultForm['observaciones_ocupacion']='';	 
		
        if (!$bPostBack){
					
					$SQL="select persona_pref_ocupacion.id as persona_ocupacion_id, persona_pref_ocupacion.*,
					      personas.id, personas.sesiones, ocupacion.nombre as prfe_ocup1
						  from persona_pref_ocupacion 
						  INNER JOIN personas ON personas.id=persona_pref_ocupacion.persona_id 
						  INNER JOIN ocupacion ON persona_pref_ocupacion.ocupacione1=ocupacion.cod 
						  where personas.id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
						  $rs1 = $conn->Execute($SQL);
						  $_SESSION['EOF']=$rs1->RecordCount();
				 		 if ($rs1->RecordCount()>0){ 				
							$aDefaultForm['f_situacion']=$rs1->fields['fsituacion'];
							$aDefaultForm['cbSituacion_afiliado']=$rs1->fields['situacion_actual'];
							$aDefaultForm['cbOcupacion5_interes_1']=$rs1->fields['ocupacion5_1'];
							$aDefaultForm['cbOcupacion5_interes2']=$rs1->fields['ocupacion5_2'];
							?>
					<script language="javascript" src="../js/jquery.js"></script>
					<script>
					$(document).ready(function(){
					elegido=<?php echo $rs1->fields['situacion_actual'] ?>;
					combo="condicion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:<?php echo $rs1->fields['tipo_situacion_actual']; ?> }, 
					function(data){  $("#cbTipo_situacion_afiliado").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion5_1'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion4_1']; ?>" }, 
					function(data){  $("#cbOcupacion4_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion4_1'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion3_1']; ?>" }, 
					function(data){  $("#cbOcupacion3_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion3_1'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacione1']; ?>" }, 
					function(data){  $("#cbOcupacionE_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacione1'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupaciong1']; ?>" }, 
					function(data){  $("#cbOcupacionG_interes_1").html(data);
				   });            
				});
				
				$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion5_2'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion4_2']; ?>" }, 
					function(data){  $("#cbOcupacion4_interes2").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion4_2'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion3_2']; ?>" }, 
					function(data){  $("#cbOcupacion3_interes2").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion3_2'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacione2']; ?>" }, 
					function(data){  $("#cbOcupacionE_interes2").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacione2'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupaciong2']; ?>" }, 
					function(data){  $("#cbOcupacionG_interes2").html(data);
				   });            
				});
				</script>
				<?php
							
							$aDefaultForm['cbExperiencia_1']=$rs1->fields['experiencia1'];
							$aDefaultForm['cbExperiencia_2']=$rs1->fields['experiencia2'];
							$aDefaultForm['cbJornada_interes']=$rs1->fields['turno_jornada_id'];
							$aDefaultForm['cbTrabajar_fuera']=$rs1->fields['trabajar_fuera']; 
							$aDefaultForm['cbFrecuencia_actividad']=$rs1->fields['frecuencia_trabajo_cuenta_propia'];
							$aDefaultForm['cbLugar_trabajo']=$rs1->fields['lugar_trabajo_cuenta_propia'];
							$aDefaultForm['salario_interes']=$rs1->fields['pref_salario'];
							$aDefaultForm['observaciones_ocupacion']=$rs1->fields['observaciones_ocupacion'];
							$_SESSION['sesiones']=$rs1->fields['sesiones'];
						}
		}		
else{   
      
		$aDefaultForm['cbSituacion_afiliado']=$_POST['cbSituacion_afiliado'];
		$aDefaultForm['f_situacion']=$_POST['f_situacion'];
		$aDefaultForm['cbOcupacion5_interes_1']=$_POST['cbOcupacion5_interes_1'];		
		$aDefaultForm['cbExperiencia_1']=$_POST['cbExperiencia_1'];
		$aDefaultForm['cbOcupacion5_interes2']=$_POST['cbOcupacion5_interes2'];
		$aDefaultForm['cbExperiencia_2']=$_POST['cbExperiencia_2']; 
		$aDefaultForm['cbJornada_interes']=$_POST['cbJornada_interes']; 
		$aDefaultForm['cbTrabajar_fuera']=$_POST['cbTrabajar_fuera']; 
		$aDefaultForm['cbFrecuencia_actividad']=$_POST['cbFrecuencia_actividad']; 
		$aDefaultForm['cbLugar_trabajo']=$_POST['cbLugar_trabajo']; 
		$aDefaultForm['salario_interes']=$_POST['salario_interes'];
		$aDefaultForm['observaciones_ocupacion']=$_POST['observaciones_ocupacion'];
		
		?>
		<script language="javascript" src="../js/jquery.js"></script>>
		<script>
		$(document).ready(function(){
			elegido=<?php echo $_POST['cbSituacion_afiliado']?>;
			combo="condicion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:<?php echo $_POST['cbTipo_situacion_afiliado']; ?> }, 
			function(data){  $("#cbTipo_situacion_afiliado").html(data);
		   });            
		});
		
		$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacion5_interes_1'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion4_interes_1']; ?>" }, 
			function(data){  $("#cbOcupacion4_interes_1").html(data);
		   });            
		});
		
			$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacion4_interes_1'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion3_interes_1']; ?>" }, 
			function(data){  $("#cbOcupacion3_interes_1").html(data);
		   });            
		});
		
			$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacion3_interes_1'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionE_interes_1']; ?>" }, 
			function(data){  $("#cbOcupacionE_interes_1").html(data);
		   });            
		});
		
			$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacionE_interes_1'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionG_interes_1']; ?>" }, 
			function(data){  $("#cbOcupacionG_interes_1").html(data);
		   });            
		});
		
		$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacion5_interes2'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion4_interes2']; ?>" }, 
			function(data){  $("#cbOcupacion4_interes2").html(data);
		   });            
		});
		
			$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacion4_interes2'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacion3_interes2']; ?>" }, 
			function(data){  $("#cbOcupacion3_interes2").html(data);
		   });            
		});
		
			$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacion3_interes2'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionE_interes2']; ?>" }, 
			function(data){  $("#cbOcupacionE_interes2").html(data);
		   });            
		});
		
			$(document).ready(function(){
			elegido="<?php echo $_POST['cbOcupacionE_interes2'] ?>";
			combo="Ocupacion";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbOcupacionG_interes2']; ?>" }, 
			function(data){  $("#cbOcupacionG_interes2").html(data);
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
//update personas
 		$sql="update personas set 
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update = '".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
			  	  $conn->Execute($sql);
				  
//sesiones curriculum
				$nNumSeccion = 2;
				$sSQL = "SELECT sesiones FROM personas where id = ".$_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);
				
				if ($rs){
				if ($rs->RecordCount() > 0){
				$rs->fields['sesiones'][$nNumSeccion-1] = 1;
				$sSQL = "update personas set sesiones = '".$rs->fields['sesiones']."' where id = ".$_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);			
					}
				}

//update insert persona_ocupacion                           				  
		if ((isset($_SESSION['EOF']))){	
					$SQL="select persona_pref_ocupacion.id as persona_ocupacion_id, personas.id from persona_pref_ocupacion 
						  INNER JOIN personas ON personas.id=persona_pref_ocupacion.persona_id 
						  where personas.id ='".$_SESSION['id_afiliado']."'";
						  $rs1 = $conn->Execute($SQL);
				 		  if ($rs1->RecordCount()>0){ 
						  $aDefaultForm['persona_ocupacion_id']=$rs1->fields['persona_ocupacion_id'];
						  $aDefaultForm['id_persona']=$rs1->fields['id'];
						//  print $aDefaultForm['persona_ocupacion_id'];	
						  
						  			  
				  $sql="update persona_pref_ocupacion set 
				  		  situacion_actual = '".$_POST['cbSituacion_afiliado']."',
						  tipo_situacion_actual = '".$_POST['cbTipo_situacion_afiliado']."',
						  fsituacion = '".$_POST['f_situacion']."',
						  ocupaciong1 = '".$_POST['cbOcupacionG_interes_1']."',
						  ocupacione1 = '".$_POST['cbOcupacionE_interes_1']."',
						  ocupacion3_1 = '".$_POST['cbOcupacion3_interes_1']."',
						  ocupacion4_1 = '".$_POST['cbOcupacion4_interes_1']."',
						  ocupacion5_1 = '".$_POST['cbOcupacion5_interes_1']."',						  
						  experiencia1 = '".$_POST['cbExperiencia_1']."',
						  ocupaciong2 = '".$_POST['cbOcupacionG_interes2']."',
						  ocupacione2 = '".$_POST['cbOcupacionE_interes2']."',
						  ocupacion3_2 = '".$_POST['cbOcupacion3_interes2']."',
						  ocupacion4_2 = '".$_POST['cbOcupacion4_interes2']."',
						  ocupacion5_2 = '".$_POST['cbOcupacion5_interes2']."',
						  experiencia2 = '".$_POST['cbExperiencia_2']."',
						  turno_jornada_id = '".$_POST['cbJornada_interes']."',
						  trabajar_fuera = '".$_POST['cbTrabajar_fuera']."',   
							frecuencia_trabajo_cuenta_propia = '".$_POST['cbFrecuencia_actividad']."', 
							lugar_trabajo_cuenta_propia = '".$_POST['cbLugar_trabajo']."',  
						  pref_salario = '".$_POST['salario_interes']."',
						  observaciones_ocupacion = '".$_POST['observaciones_ocupacion']."',
						  updated_at = '$sfecha',
						  status = 'A',
						  id_update = '".$_SESSION['sUsuario']."'
						  WHERE id = '".$aDefaultForm['persona_ocupacion_id']."' and persona_id= '".$_SESSION['id_afiliado']."'"; 	
						  $conn->Execute($sql);
						  }
					  
						  else{		
				 $sql="insert into public.persona_pref_ocupacion
						(persona_id, situacion_actual, tipo_situacion_actual, fsituacion, ocupaciong1, ocupacione1,ocupacion3_1,
						ocupacion4_1, ocupacion5_1, experiencia1, ocupaciong2, ocupacione2, ocupacion3_2, ocupacion4_2, 
						ocupacion5_2, experiencia2, turno_jornada_id, trabajar_fuera, frecuencia_trabajo_cuenta_propia, 
						lugar_trabajo_cuenta_propia, pref_salario, observaciones_ocupacion, 
						created_at, status,
						id_update) values
						('".$_SESSION['id_afiliado']."',
						 '".$_POST['cbSituacion_afiliado']."',
						 '".$_POST['cbTipo_situacion_afiliado']."',
						 '".$_POST['f_situacion']."',
						 '".$_POST['cbOcupacionG_interes_1']."',
						 '".$_POST['cbOcupacionE_interes_1']."',
						 '".$_POST['cbOcupacion3_interes_1']."',
						 '".$_POST['cbOcupacion4_interes_1']."',
						 '".$_POST['cbOcupacion5_interes_1']."',
						 '".$_POST['cbExperiencia_1']."',
						 '".$_POST['cbOcupacionG_interes2']."',
						 '".$_POST['cbOcupacionE_interes2']."',
						 '".$_POST['cbOcupacion3_interes2']."',
						 '".$_POST['cbOcupacion4_interes2']."',
						 '".$_POST['cbOcupacion5_interes2']."',
						 '".$_POST['cbExperiencia_2']."',
						 '".$_POST['cbJornada_interes']."',
						 '".$_POST['cbTrabajar_fuera']."',
						 '".$_POST['cbFrecuencia_actividad']."', 
						 '".$_POST['cbLugar_trabajo']."',
						 '".$_POST['salario_interes']."',
						 '".$_POST['observaciones_ocupacion']."',
						 '$sfecha',
						 'A',
						 '".$_SESSION['sUsuario']."')";
					   $conn->Execute($sql);
			   }			   //Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='4';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
//--------------------------------------------------------------------------------------------------------------------------------------				
		}	   
		 ?><script>document.location='1_8agen_trab_experiencia.php'</script><? 
}
//--------------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
// echo '<br>';
//include('menu_trabajador.php');
 }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<style type="text/css">
<!--
.Estilo12 {color: #030303}
-->
</style>
<form name="frm_ocupacion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script language="javascript">
//condicion
$(document).ready(function(){
   $("#cbSituacion_afiliado").change(function () {
           $("#cbSituacion_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='condicion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbTipo_situacion_afiliado").html(data);
            });            
        });
   })
});
//Ocupacion 1
$(document).ready(function(){
   $("#cbOcupacion5_interes_1").change(function () {
           $("#cbOcupacion5_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbOcupacion4_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion4_interes_1").change(function () {
           $("#cbOcupacion4_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacion3_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion3_interes_1").change(function () {
           $("#cbOcupacion3_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionE_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacionE_interes_1").change(function () {
           $("#cbOcupacionE_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionG_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion5_interes2").change(function () {
           $("#cbOcupacion5_interes2 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbOcupacion4_interes2").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion4_interes2").change(function () {
           $("#cbOcupacion4_interes2 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacion3_interes2").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion3_interes2").change(function () {
           $("#cbOcupacion3_interes2 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionE_interes2").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacionE_interes2").change(function () {
           $("#cbOcupacionE_interes2 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionG_interes2").html(data);
            });            
        });
   })
});

</script>

<script>
	function send(saction){
	       if(saction=='Continuar'){
		   			if(validar_frm_ocupacion()==true){
					var form = document.frm_ocupacion;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_ocupacion;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>
    <input name="action" type="hidden" value=""/>

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
      <tr>
	      <th colspan="4" height="20" class="sub_titulo" align="left">SITUACI&Oacute;N OCUPACIONAL ACTUAL</th>
</tr>
 <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
       
        <tr>
          <th colspan="4"  class="sub_titulo_2" align="left">Situaci&oacute;n actual </th>
         
        </tr>
        
        <tr align="center">
          <th colspan="2" class="sub_titulo">Situaci&oacute;n ocupacional </th>
           <th  colspan="2" class="sub_titulo">Fecha desde la cual está en dicha situaci&oacute;n</th>
            <tr align="center">
          <td colspan="2" style="background-color:#F0F0F0;"><select name="cbSituacion_afiliado"   style="width:25%"id="cbSituacion_afiliado" class="tablaborde_shadow" title="Situación ocupacional - Seleccione solo una opción del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbSituacion_afiliado'])=='1') print 'selected="selected"';?>>Buscando trabajo</option>
            <option value="2" <? if (($aDefaultForm['cbSituacion_afiliado'])=='2') print 'selected="selected"';?>>No busca trabajo</option>
          </select>
            <span class="requerido"> *
         
		  <select name="cbTipo_situacion_afiliado"   style="width:25%"id="cbTipo_situacion_afiliado" class="tablaborde_shadow" title="Situación ocupacional detallada - Seleccione solo una opcin del listado">
            <option value="-1" selected="selected">Seleccione...</option>
          </select>
          *</span></td>     
       
          <td colspan="2" style="background-color:#F0F0F0;">
		  <input name="f_situacion" type="text"   class="tablaborde_shadow" id="f_situacion"  title="Fecha desde la cual está en dicha situación - Seleccione del calendario la fecha"value="<?=$aDefaultForm['f_situacion']?>" placeholder="00-00-0000" size="10" readonly/>
                <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                <script type="text/javascript">//<![CDATA[
                             Calendar.setup({
                               inputField : "f_situacion",
                               trigger    : "f_rangeStart_trigger",
                               onSelect   : function() { this.hide() },
                               showTime   : false,
                               dateFormat : "%Y-%m-%d"
                             });
                           </script>		</td>
        </tr>
         <tr>
	      <th colspan="4"  align="left"></th>
</tr>
        <tr>
          <th colspan="4"  class="sub_titulo_2" align="left">Clasificación ocupacional primera opci&oacute;n</th>
        </tr>
        <tr align="left">
          <th width="25%" class="sub_titulo">Ocupación detalle</th>
          <th width="25%" class="sub_titulo">Ocupaci&oacute;n sub especifica</th>
          <th width="25%" class="sub_titulo">Ocupaci&oacute;n específica</th>
          <th width="25%" class="sub_titulo">Ocupaci&oacute;n general</th>  
         </tr>
        <tr>
          <td style="background-color:#F0F0F0;"><select name="cbOcupacion5_interes_1"   style="width:95%"id="cbOcupacion5_interes_1" class="tablaborde_shadow" title="Ocupación detalle - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadOcupacion5_interes_1($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_interes_1']; ?>
            </select>
          <span class="requerido">*</span></td>

         
          <td style="background-color:#F0F0F0;"><select name="cbOcupacion4_interes_1"  style="width:95%" id="cbOcupacion4_interes_1" class="tablaborde_shadow" title="Ocupación sub especifica - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>

          <td style="background-color:#F0F0F0;"><select name="cbOcupacion3_interes_1"  style="width:95%" id="cbOcupacion3_interes_1" class="tablaborde_shadow" title="Ocupación especifica - Seleccione solo una opción del listado">
             <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>

          <td style="background-color:#F0F0F0;"><select name="cbOcupacionE_interes_1"  style="width:95%" id="cbOcupacionE_interes_1" class="tablaborde_shadow" title="Ocupación general - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <th  colspan="2" class="sub_titulo" >Ocupación</th>
          <th  colspan="2" class="sub_titulo" >Experiencia</th>
          </tr>
          <tr>
          <td style="background-color:#F0F0F0;" colspan="2"><select name="cbOcupacionG_interes_1"  style="width:95%" id="cbOcupacionG_interes_1" class="tablaborde_shadow" title="Ocupación - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>

 
          <td style="background-color:#F0F0F0;" colspan="2"><select name="cbExperiencia_1"   style="width:95%" class="tablaborde_shadow" id="cbExperiencia_1" title="Experiencia - Seleccione solo una opción del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbExperiencia_1'])=='1') print $aDefaultForm['cbExperiencia_1']="selected";?>>Con Experiencia</option>
            <option value="0" <? if (($aDefaultForm['cbExperiencia_1'])=='0') print $aDefaultForm['cbExperiencia_1']="selected";?>>Sin Experiencia</option>
          </select>
          <span class="requerido">* </span></td>
          <tr>
         
        <tr>
          <th colspan="4"  class="sub_titulo_2">Clasificación ocupacional  segunda opci&oacute;n</th>
        </tr>
        <tr>
            <th class="sub_titulo">Ocupación detalle</th>
            <th class="sub_titulo">Ocupaci&oacute;n sub especifica</th>
            <th class="sub_titulo">Ocupaci&oacute;n especifica</th>
            <th class="sub_titulo">Ocupaci&oacute;n general</th>
        </tr>
          <td style="background-color:#F0F0F0;" ><select name="cbOcupacion5_interes2"  style="width:95%" id="cbOcupacion5_interes2" class="tablaborde_shadow" title="Ocupación detalle - Seleccione solo una opción del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <? //LoadOcupacion5_interes2($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_interes2']; ?>
          </select>
          <span class="requerido">*</span></td>
      
          <td style="background-color:#F0F0F0;"><select name="cbOcupacion4_interes2"  style="width:95%" id="cbOcupacion4_interes2" class="tablaborde_shadow" title="Ocupación sub específica - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>

          <td style="background-color:#F0F0F0;"><select name="cbOcupacion3_interes2"  style="width:95%" id="cbOcupacion3_interes2" class="tablaborde_shadow" title="Ocupación especifíca - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>     
          <td style="background-color:#F0F0F0;"><select name="cbOcupacionE_interes2"  style="width:95%"id="cbOcupacionE_interes2" class="tablaborde_shadow" title="Ocupación general - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <th class="sub_titulo" >Ocupación</th>
          <th class="sub_titulo">Experiencia</th>
          <th  colspan="2"class="sub_titulo">Lugar de trabajo donde realiza su actividad </th>       
          </tr>
          <tr>
          <td><select name="cbOcupacionG_interes2"  style="width:95%" id="cbOcupacionG_interes2" class="tablaborde_shadow" title="Ocupación - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
              <td><select name="cbExperiencia_2"  style="width:95%" class="tablaborde_shadow" id="cbExperiencia_2" title="Experiencia - Seleccione solo una opción del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbExperiencia_2'])=='1') print $aDefaultForm['cbExperiencia_2']="selected";?>>Con Experiencia</option>
            <option value="0" <? if (($aDefaultForm['cbExperiencia_2'])=='0') print $aDefaultForm['cbExperiencia_2']="selected";?>>Sin Experiencia</option>
          </select>
          <span class="requerido">*</span></td>
          <td style="background-color:#F0F0F0;" colspan="2"><select name="cbLugar_trabajo"  style="width:95%" id="cbLugar_trabajo" class="tablaborde_shadow" title="Lugar de trabajo donde realiza su actividad - Seleccione solo una opción del listado">
            <option value="0" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbLugar_trabajo'])=='1') print 'selected="selected"';?>>Lugar fijo </option>
            <option value="2" <? if (($aDefaultForm['cbLugar_trabajo'])=='2') print 'selected="selected"';?>>Sin Lugar fijo </option>
          </select></td>
        </tr>
        <tr>
          <th colspan="4" class="sub_titulo_2" align="left">Otra informaci&oacute;n</th>
        </tr>
        <tr >
          <th class="sub_titulo">Frecuencia de la actividad</th>
           <th class="sub_titulo">Jornada en la que le gustar&iacute;a trabajar</th> 
           <th  colspan="2" class="sub_titulo">Trabajar&iacute;a fuera de la ciudad?</th>       
         </tr>  
          <tr >
          <td style="background-color:#F0F0F0;"><select name="cbFrecuencia_actividad"  style="width:95%" id="cbFrecuencia_actividad" class="tablaborde_shadow" title="Frecuencia de las actividad - Seleccione solo una opción del listado">
            <option value="0" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbFrecuencia_actividad'])=='1') print 'selected="selected"';?>>Estacional </option>
            <option value="2" <? if (($aDefaultForm['cbFrecuencia_actividad'])=='2') print 'selected="selected"';?>>Ocasional  </option>
            <option value="3" <? if (($aDefaultForm['cbFrecuencia_actividad'])=='3') print 'selected="selected"';?>>Permanente  </option>
          </select></td>
               
          <td style="background-color:#F0F0F0;"><span class="requerido">
            <select name="cbJornada_interes"  style="width:95%" class="tablaborde_shadow" id="cbJornada_interes" title="Jornadaen la que le gustaría trabajar - Seleccione solo una opción del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? if (isset($GLOBALS['aDefaultForm']['cbJornada_interes'])){
			//LoadJornada_interes($conn); print $GLOBALS['sHtml_cb_Jornada_interes']; 
			}?>
            </select>
          </span><span class="requerido"> *</span></td>
        
          <td style="background-color:#F0F0F0;" colspan="2"><select name="cbTrabajar_fuera"  style="width:95%" class="tablaborde_shadow" id="cbTrabajar_fuera" title="Le gustaría trabajar fuera de la ciudad - Seleccione solo una opción del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <option value="0" <? if (($aDefaultForm['cbTrabajar_fuera'])=='0') print $aDefaultForm['cbTrabajar_fuera']="selected";?>>No</option>
            <option value="1" <? if (($aDefaultForm['cbTrabajar_fuera'])=='1') print $aDefaultForm['cbTrabajar_fuera']="selected";?>>Si</option>
          </select>
          <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <th colspan="4" class="sub_titulo">Observaciones generales</th>
         <tr>
          <td style="background-color:#F0F0F0;" colspan="4" ><input name="observaciones_ocupacion"  style="width:95%" type="text" class="tablaborde_shadow" id="observaciones_ocupacion" value="<?=$aDefaultForm['observaciones_ocupacion']?>" size="50" maxlength="100"  placeholder="Observaciones" title="Observaciones de la persona que ingresa la información - Ingrese letras y/o números" />
                  </td>
        </tr>
        <tr>
          <td colspan="4">
		   <div align="center"><span class="requerido">
		   <button type="button" name="Continuar"  id="Continuar" class="button_personal btn_aceptar"  onclick="javascript:send('Continuar');">Continuar</button>
		   <button type="button" name="Cancelar"  id="Cancelar" class="button_personal btn_cancelar"  onclick="javascript:send('Cancelar');">Cancelar</button>
	      </span></div></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
      </div>
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


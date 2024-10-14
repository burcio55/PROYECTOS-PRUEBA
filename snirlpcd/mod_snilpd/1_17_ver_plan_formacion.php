
<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
session_start();
//include('../include/security_chain.php');
/*include('1_LoadCombos.php');
include('1_Validador.php');*/
include('Trazas.class.php');
$conn = getConnDB($db1);
$conn3 = &ADONewConnection($target);
$conn3->PConnect($hostname,$username,$password,$db6);

$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
$conn3->debug = false;

doAction($conn,$conn3);
debug($settings['debug']=false);
showHeader();
showForm($conn,$conn3,$aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** GET: ****<br>";
		var_dump($_GET);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION); 		
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
function doAction($conn,$conn3){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
				
			case 'Cancelar': 
				LoadData($conn,$conn3,false);	
			break;
			
			case 'Continuar': 
			$bValidateSuccess=true;		
			
				/* if ($_POST['cbTrabajar_fuera']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Trabajaría fuera de la ciudad: es requerida.";
				$bValidateSuccess=false;
				 }*/
				
													  				
			if ($bValidateSuccess){				
				ProcessForm($conn,$conn3);
				}
			
			LoadData($conn,$conn3,false);	
			break;
	        }
		}		
		else{
		LoadData($conn,$conn3,false);
		}
}
//------------------------------------------------------------------------------
function LoadData($conn,$conn3,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	
		$aDefaultForm['nombre_plan']='';	
		$aDefaultForm['ssinopsis']=''; 
		$aDefaultForm['nduracion_horas']='';  
 		$aDefaultForm['imagen']='';	
		if(isset($_GET['id']) or $_GET['id']<>'' ){
			$_SESSION['id_plan_formacion']=$_GET['id'];	
		}//else{
//			$_SESSION['id_plan_formacion']=$aDefaultForm['id_plan_formacion'];
//		}
        if (!$bPostBack){
			$SQL="SELECT ceet.ceet_acciones_formativas_plan.id_ceet_planes_formacion,
			ceet.ceet_planes_formacion.ssinopsis,ceet.ceet_planes_formacion.simagen,
			ceet.ceet_planes_formacion.sdescripcion as nombre_plan,
			ceet.ceet_acciones_formativas_plan.id_ceet_accion_formativa,
			ceet.ceet_acciones_formativas.sdescripcion as nombre_accion_formativa,
			ceet.ceet_planes_formacion.id_ceet_horario, ceet.ceet_horarios.nduracion_horas
			FROM ceet.ceet_acciones_formativas_plan 
			inner join ceet.ceet_acciones_formativas on ceet_acciones_formativas.id  =ceet.ceet_acciones_formativas_plan.id_ceet_accion_formativa
			inner join ceet.ceet_planes_formacion on ceet_planes_formacion.id =ceet.ceet_acciones_formativas_plan.id_ceet_planes_formacion
			inner join ceet.ceet_horarios on ceet_horarios.id =ceet.ceet_acciones_formativas_plan.id_ceet_planes_formacion
			where ceet.ceet_acciones_formativas_plan.id_ceet_planes_formacion=".$_SESSION['id_plan_formacion']." and ceet.ceet_acciones_formativas_plan.nenabled=1 and ceet.ceet_horarios.nenabled=1 LIMIT 1 ;";
$rs1 = $conn3->Execute($SQL);
$_SESSION['EOF']=$rs1->RecordCount();
if ($rs1->RecordCount()>0){ 				
	$aDefaultForm['nombre_plan']=$rs1->fields['nombre_plan'];							
	$aDefaultForm['ssinopsis']=$rs1->fields['ssinopsis'];
	$aDefaultForm['nduracion_horas']=$rs1->fields['nduracion_horas'];
	$aDefaultForm['imagen']=$rs1->fields['simagen'];
	$aDefaultForm['id_accion_formativa']=$rs1->fields['id_ceet_accion_formativa'];
	$aDefaultForm['id_plan_formacion']=$rs1->fields['id_ceet_planes_formacion'];
	$aDefaultForm['nombre_accion_formativa']=$rs1->fields['nombre_accion_formativa'];
}
						 
$SQL="SELECT ceet.ceet_acciones_formativas_plan.id,
id_ceet_accion_formativa,
id_ceet_niveles, ceet.ceet_niveles.sdescripcion,
id_ceet_modulo,ceet.ceet_modulos.id as id_modulo, ceet.ceet_modulos.sdescripcion as modulos,
id_ceet_planes_formacion, 
ceet.ceet_acciones_formativas_plan.nenabled
FROM ceet.ceet_acciones_formativas_plan 
inner join ceet.ceet_planes_formacion on ceet_planes_formacion.id =ceet.ceet_acciones_formativas_plan.id_ceet_planes_formacion
inner join ceet.ceet_acciones_formativas on ceet_acciones_formativas.id =ceet.ceet_acciones_formativas_plan.id_ceet_accion_formativa
inner join ceet.ceet_niveles on ceet.ceet_niveles.id =ceet.ceet_acciones_formativas_plan.id_ceet_niveles
inner join ceet.ceet_modulos on ceet.ceet_modulos.id =ceet.ceet_acciones_formativas_plan.id_ceet_modulo
where ceet.ceet_acciones_formativas_plan.id_ceet_planes_formacion=".$_SESSION['id_plan_formacion']." and
ceet.ceet_acciones_formativas_plan.nenabled=1 and ceet.ceet_planes_formacion.nenabled=1 and ceet.ceet_niveles.nenabled=1 and ceet.ceet_modulos.nenabled=1 order by id_modulo;";
$rs1 = $conn3->Execute($SQL);
$_SESSION['EOF']=$rs1->RecordCount();
if ($rs1->RecordCount()>0){ 
$aTabla=array();
$i=1;
while(!$rs1->EOF){					 				
$aTabla[$i]['modulo']=$rs1->fields['modulos'];	
$i++;
$rs1->MoveNext();						
}
$aDefaultForm['total_modulos']=count($aTabla);

$_SESSION['aTabla']=$aTabla;

$_POST['id_accion_formativa']=$aDefaultForm['id_accion_formativa'];
$_POST['nombre_accion_formativa']=$aDefaultForm['nombre_accion_formativa'];
$_POST['id_plan_formacion']=$aDefaultForm['id_plan_formacion'];
$_POST['nombre_plan']= $aDefaultForm['nombre_plan'];							
$_POST['ssinopsis']=$aDefaultForm['ssinopsis'];
$_POST['nduracion_horas']=$aDefaultForm['nduracion_horas'];
$_POST['imagen']=$aDefaultForm['imagen'];
}else{   
    


		}
	}
}
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn,$conn3){
$sfecha=date('Y-m-d');	

$existe='';		
			//----------------------------------------------verifica si existe-----------------------------			
$SQL2="SELECT id, ncedula, id_accion_formativa, nestatus, dfecha_inscripcion, 
dcreacion, nusuario_creacion, dactualizacion, nusuario_actualizacion, 
nenabled
FROM ceet.ceet_persona_accion_formativa WHERE ncedula=".$_SESSION['usuario_id']." AND id_accion_formativa= ".$_POST['id_accion_formativa']." and nenabled=1 ;";
		 
$rs = $conn3->Execute($SQL2);
if ($rs->RecordCount()>0){	
		$existe='1';
		?><script>alert("- Ya existe un registro con el referido Plan de Formación");</script><?	
}
else{
	$existe='';
	//Quitar la letra a la cedula
/*			$ced_sin_letra=substr($_SESSION['ced_afiliado'], 1);	*/
			$fecha=date('Y-m-d');
			$sql="INSERT INTO ceet.ceet_persona_accion_formativa(
            ncedula,
			id_accion_formativa,
			nestatus,
			dfecha_inscripcion, 
            dcreacion,
			nusuario_creacion, 
            nenabled)
    VALUES ('".$_SESSION['usuario_id']."',
			'".$_POST['id_accion_formativa']."',
			1,
			'".$fecha."', 
			'".$fecha."', 
			'".$_SESSION['usuario_id']."',
			1);";				
			 $rs=$conn3->Execute($sql); 
			 if($rs){
				 $_SESSION['FINAL']=2;
				 $_SESSION['nombre_plan']=$_POST['nombre_plan'];
	
				?><script>document.location='inicio.php'</script><?
		
			 }
	
	}

 	
}
//--------------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 

 }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$conn3,&$aDefaultForm){
?>
<style type="text/css">
<!--
.Estilo12 {color: #030303}
-->

</style>
<form name="frm_ver_plan_formacion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >


<script>
	function send(saction){
	       if(saction=='regresar'){		   			
					var url ="1_16_plan_formacion.php";
					 window.open(url);					
		  	}else{
					var form = document.frm_ver_plan_formacion;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>
    <input name="action" type="hidden" value=""/>
    <input name="id_accion_formativa" type="hidden" value="<?=$aDefaultForm['id_accion_formativa']?>"/>
    <input name="id_plan_formacion" type="hidden" value="<?=$aDefaultForm['id_plan_formacion']?>"/>
    <input name="nombre_plan" id="nombre_plan" type="hidden" value="<?=$aDefaultForm['nombre_plan']?>"/>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
     <tr>
        <th height="20" class="sub_titulo" align="left">PLANES DE FORMACION Y AUTOFORMACION</th>
     </tr>   
     </table>      

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
<tr>
<th colspan="4"  class="sub_titulo_2" align="center"><div align="center"><? print $aDefaultForm['nombre_plan']?></div></th>
</tr>            
        <tr>
          <td width="34%" align="center" style= "background-color:#F0F0F0; color:#666 " ><img src="planes_logos/<?=$aDefaultForm['imagen']?>" width="301" height="50" alt="plan1" /><p>
          <table border="0" cellspacing="0" cellpadding="0" class="formulario" align="center" width="80%" >
        <tr>
        <td  align="justify" style= "background-color:#F0F0F0; color:#666 "  >
          <b>Sinopsis:</b>  -"<? print $aDefaultForm['ssinopsis']?>." </td>
</tr>  
</table>      
  <td width="44%"   align="center" style="background-color:#F0F0F0; color:#666"><b><? print ucwords(strtolower($aDefaultForm['nombre_accion_formativa']));?> </b>
        
          <table border="0" cellspacing="0" cellpadding="0" class="formulario" align="center" width="90%" >
        <tr>
        <td width="324"  align="center"></td>
        </tr>
        <tr>
          <td width="324" align="center" style= "background-color:#F0F0F0; color:#06C "  ><b>MODULO(S): <? print $aDefaultForm['total_modulos']?></b></td>
        </tr>
           <?  $aTabla=$_SESSION['aTabla'];
              $aDefaultForm = $GLOBALS['aDefaultForm'];
              for( $i=1; $i<=count($aTabla); $i++){
              //if (($i%2) == 0) $class_name = "dataListColumn2";
              //else $class_name = "dataListColumn";
              ?>
            <tr>
              	<td style= "background-color:#F0F0F0; color:#666 "  align="center">
	              	<div align="left">
	              		<? print $i.'.-' .$aTabla[$i]['modulo'];?>
	              	</div>
          		</td>
            </tr>
            <? } ?>
          </table></td>
               
           <td width="22%" align="center" style= "background-color:#F0F0F0; color:#06C "><b>Duración Total:  <? print $aDefaultForm['nduracion_horas'];?> hora(s)</b></td>
    </tr> 
    <tr>
     </table>
    <p> <p>
     <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
          <td colspan="4">
		   <div align="center"><span class="requerido">
		   <button type="button" name="Continuar"  id="Continuar" class="button_personal btn_aceptar"  onclick="javascript:send('Continuar');">Inscr&iacute;bete</button>
            <button type="button" name="regresar"  id="regresar" class="button_personal btn_regresar"  onclick="window.location.href = '1_16_plan_formacion.php'" target="_self">Regresar</button>
	      </span></div></td>
        </tr>
        <tr>
          <td width="26%">&nbsp;</td>
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


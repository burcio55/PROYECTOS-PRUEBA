
<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');

$conn = getConnDB($db1);
$conn3 = &ADONewConnection($target);
$conn3->PConnect($hostname,$username,$password,$db6);
session_start();
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
			
													  				
			if ($bValidateSuccess){				
				ProcessForm($conn,$conn3);
				}
			
			LoadData($conn,$conn3,true);	
			break;
	        }
		}		
		else{
			$sSQL = "SELECT sesiones FROM personas where cedula = '".$_SESSION['nusuario']."'";
			$rs = $conn->Execute($sSQL);
			if ($rs){
				
				if ($rs->RecordCount() > 0){
				  
					if( substr($rs->fields['sesiones'], 0, 3)=='111'){
							LoadData($conn,$conn3,false);
					}else{?>
						<script>
						if (confirm("NOTA IMPORTANTE:- Por favor debe completar su proceso de registro en el\nCentro de Encuentro para la Educación y Trabajo (CEET),\npara poder visualizar los Planes de Formación y Autoformación que le ofrecemos."))
				document.location="inicio.php?";</script>
						<?
					}
				}
			}
	}
}
//------------------------------------------------------------------------------
function LoadData($conn,$conn3,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	$aDefaultForm['total_planes']=0;		
        if (!$bPostBack){

$SQL="SELECT ceet.ceet_planes_formacion.id, ceet.ceet_planes_formacion.simagen
 FROM ceet.ceet_planes_formacion where ceet.ceet_planes_formacion.nenabled=1 order by id ;";
$rs1 = $conn3->Execute($SQL);
$_SESSION['EOF']=$rs1->RecordCount();
if ($rs1->RecordCount()>0){
		$aTabla=array();
		$i=1;
		while(!$rs1->EOF){	
			$aTabla[$i]['id']=$rs1->fields['id']; 				
			$aTabla[$i]['imagen']=$rs1->fields['simagen'];
			$i++;
		$rs1->MoveNext();
		}
		$aDefaultForm['total_planes']=count($aTabla);
		$_SESSION['aTabla']=$aTabla;
	}
}else{   
		}
	}
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn,$conn3){
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
<form name="frm_plan_formacion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >


<script>
	function send(saction){
	       /*if(saction=='Continuar'){
		   			if(validar_frm_ocupacion()==true){
					var form = document.frm_plan_formacion;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{*/
					var form = document.frm_ocupacion;
					form.action.value=saction;
					form.submit();				
		//	}		
	}
</script>
    <input name="action" type="hidden" value=""/>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
 
        <tr>
        	      <th colspan="4" height="20" class="sub_titulo" align="left">PLANES DE FORMACION Y AUTOFORMACION</th>
        
     </tr>   
      <tr>
       <th colspan="4" width="49%" height="20" align="center"  ></th>
   </tr>
 <tr>
    
          <th colspan="4" width="49%"  align="center"  class="sub_titulo_2">Plan(es) de Formación Disponibles: -<? print $aDefaultForm['total_planes']?>-</th>
   </tr>
   </table>      
 <p>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
   
<tr>
  <?  $aTabla=$_SESSION['aTabla'];
              $aDefaultForm = $GLOBALS['aDefaultForm'];
              for( $i=1; $i<=count($aTabla); $i++){
              //if (($i%2) == 0) $class_name = "dataListColumn2";
              //else $class_name = "dataListColumn";
              ?>
            <tr>
              	<td style= "background-color:#F0F0F0; color:#666 "  align="center" height="400">
	              	 <button type="button" name="Continuar"  id="Continuar" class="button_personal"   onclick="window.location.href = '1_17_ver_plan_formacion.php?id=<?=$aTabla[$i]['id']?>'"><img src="planes_logos/<?=$aTabla[$i]['imagen']?>" width="301" height="50" alt="plan1" /></button>          		</td>
            </tr>
            <? } ?>
 
  
  <!--<button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Inscr&iacute;bete</button>-->
  </th>
  
  <!-- <th  width="27%"  align="center" "background-color:#F0F0F0; " ><p><img src="../imagenes/planes_logos/enlace-2.jpg" width="227" height="196" alt="plan2" /></p></th>   -->            
</tr> 
    <tr>
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


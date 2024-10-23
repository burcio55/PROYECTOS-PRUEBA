<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include("../LoadCombos.php");
$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug=false;
//----------------------------------------

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();


doAction($conn1);
debug();
showHeader();
showForm($conn1,$aDefaultForm);
showFooter();

function debug(){
	 if($settings['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function trace($msg){
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}

function doAction($conn1){
	if (isset($_POST['action'])){ 
				switch($_POST["action"]){  
				case 'guardar':
						$bValidateSuccess=true;
						if ($_POST['cbo_rif1']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar la letra del campo Rif.";
								$GLOBALS['ids_elementos_validar'][]='cbo_rif1';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_rif2']=="" or !preg_match("/^[[:digit:]]{9,9}$/", trim($_POST['txt_rif2']))){
								$GLOBALS['aPageErrors'][]= "- El campo Rif:debe contener de 2 a 9 digitos.";
								$GLOBALS['ids_elementos_validar'][]='txt_rif2';
								$bValidateSuccess=false;
						}
						if($_POST['cbo_rif1']!="" and $_POST['txt_rif2']!=""){
			
								$SQL="SELECT srif FROM entes.seniat WHERE srif='".$_POST['cbo_rif1'].$_POST['txt_rif2']."' AND status='1'";
								$rs=$conn->Execute($SQL);
								if($rs->RecordCount()>0){
									$GLOBALS['aPageErrors'][]= "- El Rif se encuentra Registrado";
									$GLOBALS['ids_elementos_validar'][]='cbo_rif1';
									$GLOBALS['ids_elementos_validar'][]='txt_rif2';
									$bValidateSuccess=false;
								}
						}
						if ($_POST['txt_razonsocial']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Raz&oacute;n Social:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_razonsocial';
								$bValidateSuccess=false;
						}
						if ($_POST['txt_denominacion']==""){
								$GLOBALS['aPageErrors'][]= "- El campo Denominaci&oacute;n Comercial:es requerido.";
								$GLOBALS['ids_elementos_validar'][]='txt_denominacion2';
								$bValidateSuccess=false;
						}
						if($bValidateSuccess){
							ProcessForm($conn1);
						}
					LoadData($conn,true);
				break;
				}
		}else{
		LoadData($conn1,false);
	}
 }

//-----------------------------------------------------------------------------//
function LoadData($conn1,$bPostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
					$aDefaultForm['cbo_rif1'] ='';
					$aDefaultForm['txt_rif2'] ='';
					$aDefaultForm['txt_razonsocial'] ='';
					$aDefaultForm['txt_denominacion'] ='';

		if (!$bPostBack){
			
		}else{
					$aDefaultForm['cbo_rif1'] =$_POST["cbo_rif1"];
					$aDefaultForm['txt_rif2'] =$_POST["txt_rif2"];
					$aDefaultForm['txt_razonsocial'] =$_POST["txt_razonsocial"];
					$aDefaultForm['txt_denominacion'] =$_POST["txt_denominacion"];
		}
	}
}




function ProcessForm($conn1){

$alerta='';

$SQL="SELECT srif FROM seniat WHERE srif='".$_POST['cbo_rif1'].$_POST['txt_rif2']."' AND status='1'" ;								
$rs=$conn1->Execute($SQL);				
if($rs->RecordCount()>0){
		$alerta='1';
}else{

	echo $SQL1= "INSERT INTO seniat
		 (srif, srazon_social, sdenominacion_comercial,status,dfecha_creacion,usuario_idcreacion)
		 VALUES('".$_POST['cbo_rif1'].$_POST['txt_rif2']."',
				'".$_POST['txt_razonsocial2']."',
				'".$_POST['txt_denominacion2']."',
				'1',
				'".date('Y-m-d H:i:s')."',
				'".$_SESSION['usuario_id']."')";
	$rs1=$conn1->Execute($SQL1);
		$alerta='2';
	
	}
		
		if($alerta=='1'){
		?><script>if (alert("- EL RIF SE ENCUENTRA REGISTRADO"));</script><?
		}
		if($alerta=='2'){
		?><script>if (alert("- EL RIF FUE REGISTRADO EXITOSAMENTE"));</script><?
		}
	LoadData($conn1,false);
}



function doReport($conn){
	
}

function showHeader(){
 include('../header.php'); 
}

function showForm($conn,$aDefaultForm){
?>
<form name="frm_registro" id="frm_registro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<script type="text/javascript" src="../mod_registro/funciones_admnistrar_rif.js"></script>		
<script>
	function send(saction){
		if(validar_campos()==true){
			var form = document.frm_registro;
			form.action.value=saction;
			form.submit();
		}		
	}
</script>
<table width="80%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
    <th width="2%" class="separacion_10"></th>
  </tr>
  <tr>
  	<th colspan="4" class="sub_titulo_2"><div align="left">REGISTRO DE RIF</div></th>
  </tr>

  <tr>
    <th width="30%" align="right" class="sub_titulo_3">RIF  </th>
    <td width="50%"  align="left">
	  <select id="cbo_rif1" name="cbo_rif1" >
      <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>></option>
      <option value="J"<?php if (!(strcmp('J',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>J</option>
      <option value="E"<?php if (!(strcmp('E',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>E</option>
      <option value="G"<?php if (!(strcmp('G',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>G</option>
      <option value="V"<?php if (!(strcmp('V',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>V</option>
      <option value="C"<?php if (!(strcmp('C',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>C</option>
      <option value="R"<?php if (!(strcmp('R',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>R</option>
      </select>
      <input name="txt_rif2" id="txt_rif2" type="text"  value="<?= $aDefaultForm['txt_rif2'];?>" maxlength="9" onkeypress="return isNumberKey(event);"   title="RIF - Ingrese s&oacute;lo N&uacute;meros. Acepta m&aacute;ximo 9 d&iacute;gitos." onBlur="javascript:consulta_rif();"/>
     <span>*</span>      
    </td>
  </tr>
  
  
      <tr>
        <th colspan="4" class="sub_titulo">Nombre o Raz&oacute;n Social</th>

   </tr>
  
  <tr>
<!--    <th class="sub_titulo">NOMBRE O RAZ&Oacute;N SOCIAL:</th>-->
    <td colspan="4" align="center">
    <textarea name="txt_razonsocial" id="txt_razonsocial" cols="100" rows="1"><?= $aDefaultForm['txt_razonsocial'];?></textarea>
    <span>*</span>    
    </td>
  </tr>
 
    <tr>
        <th colspan="4" class="sub_titulo">Denominaci&oacute;n Comercial</th>
   </tr>
  
  <tr>
<!--    <th class="sub_titulo">DENOMINACI&Oacute;N COMERCIAL:</th>-->
    <td colspan="4" align="center">
    <textarea name="txt_denominacion" id="txt_denominacion" cols="100" rows="1" maxlength="70"><?= $aDefaultForm['txt_denominacion'];?></textarea>
    <span>*</span>    
    </td>
  </tr>
  <tr>
    <th class="separacion_20"></th>
  </tr>
   <tr>
      <th colspan="4" align="center">
      <button type="button" name="cmd_guardar"  id="cmd_guardar" class="button" title="Guardar Registro -  Haga Click para Guardar" onclick="javascript:send('guardar');">Guardar
      <img src="../imagenes/save_16.png" />           
      </button>
      </th>
    </tr>
    <tr>
      <th class="separacion_20"></th>
    </tr>
</table>
</form>
<?php
}
//funcion que imprime con alert todos los errores
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 
<?php  include('../footer.php'); ?>


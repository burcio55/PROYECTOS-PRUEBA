<?php
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../include/header.php');
include("../LoadCombos.php");
$conn= getConnDB($db1);
$conn->debug = false;
//-------------------------------------------------------------

$aDefaultForm = array();

include("../evita_injection.php");
include("../verificar_session_url.php");

doAction($conn);
showHeader();
showForm($conn,$aDefaultForm);

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

function doAction($conn){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'guardar':
						$bValidateSuccess=true;
						if($bValidateSuccess){
							ProcessForm($conn);
							LoadData($conn,true);
						}else{
							
						}
				break;
			}
		}else{
		LoadData($conn,false);
	}
 }

//-----------------------------------------------------------------------------//
function LoadData($conn,$bPostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];

		if (!$bPostBack){
		
				
		}else{
					
		}
	}
}

function ProcessForm($conn){

}

function doReport($conn){	
}
function showHeader(){
 include('../header.php'); 
}

function showForm($conn,$aDefaultForm){
?>
<script type="text/javascript" src="funciones_cambiar_clave.js"></script>		
<form name="frm_rnet_plantilla" id="frm_rnet_plantilla" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<table width="50%" border="0" align="center" class="formulario cuerpo" cellpadding="0" cellspacing="0">
  <tr>
  	<th colspan="4" class="sub_titulo_2"><div align="left">CAMBIAR CLAVE</div></th>
  </tr>

<!--  <tr>
    <th colspan="4" class="sub_titulo">INDIQUE SU NUEVA CLAVE PARA EL ACCESO AL SISTEMA</th>
  </tr>-->
  <tr>
    <th colspan="4" align="center" height="40" class="sub_titulo_3">Clave Nueva</th>
    
  </tr>
    <tr>
  <td colspan="4" align="center">
    <input name="txt_clave1" align='center' type="password" id="txt_clave1"  title="CLAVE NUEVA - Indique su nueva clave " value="" maxlength="30" onpaste="return false"/>
    <span>*</span>  
    </td>
    </tr>
  
  
  <tr>
  <th colspan="4" align="center" height="40" class="sub_titulo_3">Repetir Clave</th>
</tr>
<tr>
    <td colspan="4" align="center">
    <input name="txt_clave2" type="password" align='center' id="txt_clave2"  title="CLAVE NUEVA - Indique su nueva clave " value="" maxlength="30" onpaste="return false"/>
    <span>*</span>  
    </td>
  </tr>
  <tr>
      <th class="separacion_20"></th>
  </tr>
  <tr>
    <th colspan="2" height="40" align="center">
    <button type="button" name="guardar"  id="guardar" class="button" title="Guardar Registro -  Haga Click para Guardar">GUARDAR
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
?> 
<?php include('../footer.php'); ?>

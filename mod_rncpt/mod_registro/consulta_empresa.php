<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include("../LoadCombos.php");
$conn= getConnDB($db1);
$conn->debug = false;
//-------------------------------------------------------------


$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();


doAction($conn);

showHeader();
showForm($conn,$aDefaultForm);
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

function doAction($conn){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'guardar':
						$bValidateSuccess=true;
						
						if($bValidateSuccess){
							ProcessForm($conn);
						}
					LoadData($conn,true);
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
<form name="frm_registro" id="frm_registro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<script type="text/javascript" src="../mod_registro/funciones_registro.js"></script>
<script>
	function send(saction){
			var form = document.frm_registro;
			form.action.value=saction;
			form.submit();
	}
</script>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
    <th class="separacion_20"></th>
  </tr>

  <tr>
  	<th colspan="4" class="sub_titulo_2"><div align="left">CONSULTA ENTIDADES DE TRABAJO</div></th>
  </tr>
  <tr>
      <th class="separacion_10"></th>
  </tr>
</table>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4" align="center">
        <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
        <div id="empresa_tabla" style=" height:200px;" ></div>
      </td>
    </tr>
</table>
</form>
<?php
}
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}
$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
include('../footer.php'); 
?>


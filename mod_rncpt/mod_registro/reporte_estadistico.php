<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include("../LoadCombos.php");
$conn= getConnDB($db1);
$conn->debug =true;
//----------------------------------------

unset($_SESSION['empresa_id']);	
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();


doAction($conn);
debug();
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
			
					$aDefaultForm['cbo_entidad'] ='';
					$aDefaultForm['valor'] =1;

				

		if (!$bPostBack){
			

		
			
		}else{
					$aDefaultForm['cbo_entidad'] =$_POST["cbo_entidad"];
					$aDefaultForm['valor'] =$_POST["valor"];

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
<input name="valor" id="valor" type="hidden" value="<?=$aDefaultForm['valor']?>" />
<script type="text/javascript" src="../mod_registro/funciones_reporte.js"></script>		
<script>
	function send(saction){
		if(validar_campos()==true){
			var form = document.frm_registro;
			form.action.value=saction;
			form.submit();
		}		
	}
</script>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
    <th width="10%" class="separacion_20"></th>
  </tr>
</table>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
      <th colspan="4" class="sub_titulo_2"><div align="left">TABLA DE ESTADISTICA PRELIMINARES A NIVEL NACIONAL</div></th>
    </tr>
    <tr>
      <th class="separacion_20"></th>
    </tr>
      <tr>
        <td colspan="4" align="center">
          <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
          <div id="nacional_tabla" style=" height:200px;" ></div>
        </td>
      </tr>
  </table>
	<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
        <th colspan="4" class="sub_titulo_2"><div align="left">TABLA DE ESTADISTICA PRELIMINARES POR REGION Y ESTADO</div></th>
  </tr>
  <tr>
    <th class="separacion_10"></th>
  </tr>
  <tr>
    <th width="50%" class="sub_titulo_3" align="center">REGI&Oacute;N:</th>
    <th width="50%" class="sub_titulo_3" align="center">ESTADO:</th>
   
  </tr>
  <tr>
     <td width="50%"  align="center">
    <select id="cbo_region2" name="cbo_region2" onChange="javascript:estado_reporte();" >
	<option value="">Seleccione</option>
    <? LoadRegion2 ($conn) ; print $GLOBALS['sHtml_cb_Region2']; ?>
    </select>
		<span>*</span>	
    </td>
    
    <td width="50%"   align="center">
    <select id="cbo_entidad2" name="cbo_entidad2">
		<option value="">Seleccione</option>
    </select>
		<span>*</span>	
    </td>
  </tr>
  <tr>
  	<td colspan="4" align="center">
    <button type="button" name="cmd_buscar"  id="cmd_buscar" class="button" title="Buscar Registro -  Haga Click para Buscar" onclick="javascript:reporte_empresa_es_re();">
    <img src="../imagenes/search_16.png" />  Buscar          
    </button>
    </td> 
  </tr>
  </table>
  <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="center">
      <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
      <div id="region_estado_tabla" style=" height:200px;" ></div>
    </td>
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


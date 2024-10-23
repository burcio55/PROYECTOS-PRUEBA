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

function trace($msg){//para hacer traza y no estar escribiendo echo o print cada vez
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

					$aDefaultForm['cbo_rif1'] ='';
					$aDefaultForm['txt_rif2'] ='';
					$aDefaultForm['valor'] ='1';
					

		if (!$bPostBack){
			
		}else{
					$aDefaultForm['cbo_rif1'] =$_POST["cbo_rif1"];
					$aDefaultForm['txt_rif2'] =$_POST["txt_rif2"];					
					$aDefaultForm['valor'] =$_POST["valor"];					
		}
	}
}




function ProcessForm($conn){	
}


//funcion que se coloca en caso que se necesite generar un reporte o elusuario agregue valores a la tabla
function doReport($conn){
	
}

//funcion que dibuja el encabezado de la pagina 
function showHeader(){
 include('../header.php'); 
}

//funcion que dibuja el cuerpo de la pagina 
function showForm($conn,$aDefaultForm){
?>
<form name="frm_rnet_plantilla" id="frm_rnet_plantilla" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<input name="id" id="id" type="hidden" value="<?=$aDefaultForm['id']?>"/>
<input name="valor" id="valor" type="hidden" value="<?=$aDefaultForm['valor']?>"/>
<script type="text/javascript" src="../mod_rnet/funciones.js"></script>		
<script>
	function send(saction){
		if(validar_formulario()==true){
			var form = document.frm_rnet_plantilla;
			form.action.value=saction;
			form.submit();
		}		
	}
</script>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
  	<th colspan="4" class="titulo">REPORTE</th>
  </tr>
  <tr>
  	<th colspan="4" class="sub_titulo"><div align="left">CONSULTA ENTIDADES DE TRABAJO</div></th>
  </tr>
  <tr>
      <th class="separacion_5"></th>
  </tr>
  <tr>
    <td>RIF:</td>
    <td>
			<select id="cbo_rif1" name="cbo_rif1" >
      <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>></option>
      <option value="J"<?php if (!(strcmp('J',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>J</option>
      <option value="E"<?php if (!(strcmp('E',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>E</option>
      <option value="G"<?php if (!(strcmp('G',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>G</option>
      <option value="V"<?php if (!(strcmp('V',$aDefaultForm['cbo_rif1']))) {echo " selected=\"selected\"";}?>>V</option>
      </select>
      <input name="txt_rif2" id="txt_rif2" type="text"  value="<?= $aDefaultForm['txt_rif2'];?>" maxlength="9" onkeypress="return isNumberKey(event);"   title="RIF - Ingrese s&oacute;lo N&uacute;meros. Acepta m&aacute;ximo 9 d&iacute;gitos."/>
     <span>*</span>      
      <button type="button" name="cmd_buscar"  id="cmd_buscar" class="button" title="Buscar Registro -  Haga Click para Buscar" onclick="javascript:mostrar_formulario_empresa();">
      <img src="../imagenes/search_16.png" />           
      </button> 
    </td>
  </tr>
  <tr>
      <th class="separacion_5"></th>
  </tr>
</table>
<div id="formulario_empresa">

</div>
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
<tbody id="sucursal">
    <tr>
      <td colspan="4" align="center">
        <input type="hidden" id="cant_campos_su" name="cant_campos_su" value="<?php echo $aDefaultForm['cant_campos_su'];  ?>" />
        <div id="sucursal_tabla" style=" height:200px;" ></div>
      </td>
    </tr>
 </tbody>
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


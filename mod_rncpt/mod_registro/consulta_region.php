<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include("../LoadCombos.php");
$conn= getConnDB($db1);
$conn->debug =false;
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
			
					$aDefaultForm['cbo_entidad'] ='';
					$aDefaultForm['tipo'] =$_SESSION['ntipo'];
					$aDefaultForm['valor'] =2;
					

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
<input name="id" id="id" type="hidden" value="<?=$_REQUEST['id']?>" />
<input name="valor" id="valor" type="hidden" value="<?=$aDefaultForm['valor']?>" />
<script type="text/javascript" src="../mod_registro/funciones_regiones.js"></script>		
<script>
	function send(saction){
		if(validar_campos()==true){
			var form = document.frm_registro;
			form.action.value=saction;
			form.submit();
		}		
	}
</script>
<table width="100%" border="0" align="right" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
    <th width="10%" class="separacion_20"></th>
  </tr>

  <tr>
  	<th colspan="4" class="sub_titulo_2"><div align="left">CONSULTA DEL REGISTRO DE LAS ENTIDADES DE TRABAJO</div></th>
  </tr>
  <tr>
    <th class="separacion_10"></th>
  </tr>
  
  	<tr>
	  <th width="40%" align="right" class="sub_titulo_3">ESTADO</th>

	  	<td width="60%" align="left">
		    <select id="cbo_estado_consulta2" name="cbo_estado_consulta2" >
				<option value="">Seleccione</option>
		    	<? LoadEstado2 ($conn) ; print $GLOBALS['sHtml_cb_Estado2']; ?>
		    </select>
			<span>*</span>	
	    
		    <button type="button" name="cmd_buscar"  id="cmd_buscar" class="button" title="Buscar Registro -  Haga Click para Buscar" onclick="javascript:buscar_estado();"> 
		    <img src="../imagenes/buscar.png" alt="16" width='16' height='16' />  BUSCAR          
		    </button> 
		</td>
    </tr>
  
  
  <tr>
    <th class="separacion_20"></th>
  </tr>	
    
	 <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="4" align="center">
            <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
            <div id="estado_tabla" style=" height:200px;" ></div>
          </td>
        </tr>
    </table>
    
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


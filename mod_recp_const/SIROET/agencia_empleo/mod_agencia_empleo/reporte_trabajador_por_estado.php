<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
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
		var_dump($_SESSION);
	}
}

//----------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'buscar_trabajador_por_estado':
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
//----------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	if (!$bPostBack){
	        
		}else{   
								
		}
	}
}
//---------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
include('menu_trabajador.php'); 
 ?>

<div class="container">
 <? }

//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>

<script type="text/javascript" src="mod_agencia_empleo/valida_busqueda.js"></script>
<form name="form" method="post" action="" >
	
    <input name="action" type="hidden" value=""/>

    	<table width="100%" border="0" align="center" class="formulario" cellpadding="3" cellspacing="0">
			<tr>
		    	<td></td>
		  	</tr>
		  	<tr>
		    	<th colspan="4"  class="titulo" align="center">CONSULTA DE TRABAJADOR POR ESTADO</th>
		  	</tr>
		  	<tr style="background-color:#ebebeb;">
		     	<th colspan="4" class="separacion_10"></th>
		  	</tr>
		  
      		<tr class="identificacion_seccion">
			    <td colspan="2" align="center">SELECCIONE EL ESTADO: 
			    	<select name="cbEstado_empresa" id="cbEstado_empresa" class="tablaborde_shadow" title="Estado - Seleccione solo una opcion del listado">
		        		<option value="-1" selected="selected">Seleccionar</option>
	        		<? LoadEstado_empresa($conn) ; print $GLOBALS['sHtml_cb_Estado_empresa']; ?> 
	        		</select><span class="requerido">* </span>
	        		<button type="button" name="buscar_trabajador_por_estado" id="buscar_trabajador_por_estado" class="button btn_buscar" title="Haga Click para Buscar"> Buscar</button>
	        	</td>
		  	</tr>
		  
		  	<tr  style="background-color:#ebebeb;">
		         <th colspan="4" class="separacion_10"></th>
		  	</tr>
		</table>

	    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
       		<td>
				<figure class="highcharts-figure">
				    <div id="reporte_por_estado"></div>
				</figure>	
           </td>
         </tr>
       </table>
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


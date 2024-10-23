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
				case 'buscar_entidad_por_parroquia':
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
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >

<script>
$(document).ready(function(){
			elegido="<?php echo $rs1->fields['pais_residencia_id']; ?>";
			combo="Estado";
			$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_residencia']; ?>" }, 
			function(data){ $("#cbEstado_afiliado").html(data);
				 });            
			});
				
			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['estado_residencia']; ?>";
			combo="Municipio";
			$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['municipio_id']; ?>" }, 
			function(data){ $("#cbMunicipio_afiliado").html(data);
				 });            
			});

			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['municipio_id']; ?>";
			combo="Parroquia";
			$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['parroquia_id']; ?>" },
			function(data){  $("#cbParroquia_afiliado").html(data);
				 });            
			});
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

//Estado Residencia entidad trabajo
$(document).ready(function(){
   $("#cbEstado_afiliado").change(function () {
           $("#cbEstado_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Municipio';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbMunicipio_afiliado").html(data);
            });            
        });
   })
});

//Municipio---Municipio residencia de la entidad de trabajo
$(document).ready(function(){
   $("#cbMunicipio_afiliado").change(function () {
           $("#cbMunicipio_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Parroquia';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbParroquia_afiliado").html(data);
            });            
        });
   })
});
</script>
	
    <input name="action" type="hidden" value=""/>

    	<table width="100%" border="0" align="center" class="formulario" cellpadding="3" cellspacing="0">
			<tr>
		    	<td></td>
		  	</tr>
		  	<tr>
		    	<th colspan="4"  class="titulo" align="center">CONSULTA DE ENTIDADES DE TRABAJO POR PARROQUIA</th>
		  	</tr>
		  	<tr style="background-color:#ebebeb;">
		     	<th colspan="4" class="separacion_10"></th>
		  	</tr>
		  
      		<tr class="identificacion_seccion">
			    <td colspan="1" align="center">ESTADO: 
			    	<select name="cbEstado_afiliado" id="cbEstado_afiliado" class="" title="Estado - Seleccione solo una opcion del listado">
	          			<option value="">Seleccionar</option>
	          		</select><span class="requerido">* </span>
</td>
	          	<td colspan="1" align="center">MUNICIPIO: 
	          		<select name="cbMunicipio_afiliado" id="cbMunicipio_afiliado" class="" title="Municipio - Seleccione solo una opcion del listado">
			          <option value="">Seleccionar</option>
			        </select></span><span class="requerido">*</span>
			        </td>
			    <td colspan="1" align="center">PARROQUIA:
			        <select name="cbParroquia_afiliado" id="cbParroquia_afiliado" class="" title="Parroquia - Seleccione solo una opcion del listado">
			          <option value="">Seleccionar</option>
			          </select></span><span class="requerido"> *</span>
			    </td>
		  	</tr>
		  	<tr>
		  		<td colspan="3" align="center"><button type="button" name="buscar_entidad_por_parroquia" id="buscar_entidad_por_parroquia" class="button btn_buscar" title="Haga Click para Buscar"> Buscar</button></td>
		  	</tr>
		  
		  	<tr  style="background-color:#ebebeb;">
		         <th colspan="4" class="separacion_10"></th>
		  	</tr>
		</table>

	    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
       		<td>
				<figure class="highcharts-figure">
				    <div id="reporte_por_parroquia"></div>
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


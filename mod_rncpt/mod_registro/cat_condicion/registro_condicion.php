<?php 
include("../../../header.php"); 
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
debug();

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();
doAction($conn);

function doAction($conn){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
			case 'redirecciona':
				$bValidateSuccess=true;
				//header('location:consulta_cheque.php'); 
			break;
			}
		}else{
		LoadData($conn,false);
	}
 }
 
 
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
?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
    <form id="form_registro_condicion" name="form_registro_condicion" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" >
    <input name="action" type="hidden" value=""/>
    <script type="text/javascript" src="funciones_condicion.js"></script>    
    <script>
    function send(saction){
          var form = document.form_registro_condicion;
          form.action.value=saction;
          form.submit();
    }
    </script>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th colspan="4" class="titulo">&nbsp;</th>
        </tr>
        <tr>
            <th width="16%" class="separacion_10"></th>
        </tr>
		</table>
    <div id="formulario_condicion">
    
    </div>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
      
        <tr>
            <th width="18%" class="separacion_10"></th>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
            <div id="tabla_condicion"></div>
          </td>
        </tr>
        <tr>
            <th width="18%" class="separacion_20"></th>
        </tr>    
        <tr>
            <th width="18%" class="separacion_20"></th>
        </tr>
    </table>
    </form>
    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../../../footer.php"); ?>
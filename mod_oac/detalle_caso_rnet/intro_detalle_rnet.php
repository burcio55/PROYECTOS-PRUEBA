<?php 
include("../../header.php"); 
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
    <form id="form_detalle_rnet" name="form_intro_detalle_rnet" method="post" action="<?=$_SERVER['../detalle_rnet/PHP_SELF'] ?>" >
    <input name="action" type="hidden" value=""/>
    <script type="text/javascript" src="../detalle_caso_rnet/funciones_detalle_rnet.js"></script>    
    <script>
    function send(saction){
          var form = document.form_intro_detalle_rnet;
          form.action.value=saction;
          form.submit();
    }
    </script>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
            <tr>
<th colspan="4"  class="sub_titulo"><div align="left">MANTENIMIENTO --> CATALOGOS --> RNET-Detalle del Caso</div></th>

        <!-- <tr>
          <th colspan="4" class="titulo"><div align="left">TIPO DE ASISTENCIA (ASESORIA) - DETALLE DE GESTION (RNET) -  TIPO DE CASO RNET (REGSTRO DE ENTIDAD DE TRABAJO)</div></th>
        </tr>-->
        
        <tr>
            <th width="16%" class="separacion_10"></th>
        </tr>
		</table>
    <div id="formulario_detalle_rnet">
    
    </div>
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
      
        <tr>
            <th width="18%" class="separacion_10"></th>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
            <div id="tabla_gestion"></div>
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
	
<?php include("../../footer.php"); ?>
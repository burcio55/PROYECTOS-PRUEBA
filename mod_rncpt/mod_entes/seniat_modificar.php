<?php

// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include("../../header.php"); 
//include("../../LoadCombos.php");
$settings['debug'] = true;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

//debug();

$aDefaultForm = array();



doAction($conn);

$aDefaultForm = array();





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


?>
<div id="Contenido" align="center" style="overflow:auto">
	<br>
    <table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
<script type="text/javascript" src="funciones_seniat_modificar.js"></script>		
<form name="frm_rnet_plantilla" id="frm_rnet_plantilla" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<table width="100%" border="0" align="center" class="formulario cuerpo" cellpadding="0" cellspacing="0">
  <tr>
    <th align="left" colspan="4" height="20" class="titulo">SENIAT</th>
  </tr>
  <tr>
    <th colspan="4" class="sub_titulo">DATOS A MODIFICAR</th>
  </tr>
  <tr>
  	<td colspan="4" class="alerta_roja titulo"> <img src="../imagenes/warning_16.png"  /> POR FAVOR VERIFICAR EL DOCUMENTO SUMINISTRADO POR SENIAT.</td>
  </tr>

  <tr>
    <td align="right" height="20">Rif:</td>
    <td>
    	<input name="txt_rif" type="text" id="txt_rif"  title="RIF - Formato:J00012345 " value=""  maxlength="10" />
    	<span>*</span>  
    </td>
  </tr>
  <tr>
    <td align="right" height="20">Razon social:</td>
    <td>
    	<textarea id="txt_razon_social" name="txt_razon_social" cols="50" rows="4" maxlength="200"></textarea> 
    	<span>*</span>

    </td>
  </tr>
  <tr>
    <td align="right" height="20">Denominacion comercial:</td>
    <td>
    	<textarea id="txt_denominacion_comercial" name="txt_denominacion_comercial" cols="50" rows="4" maxlength="200"></textarea>
    	<span>*</span>  
    </td>
  </tr>
  <tr>
    <td align="right" height="20">Direccion fiscal:</td>
    <td>
    	<textarea id="txt_direccion_fiscal" name="txt_direccion_fiscal" cols="50" rows="5" maxlength="255"></textarea>
    	<span>*</span>  
    </td>
  </tr>
  <tr>
    <td align="right" height="20">Estado:</td>
    <td>
    	<input name="txt_estado" type="text" id="txt_estado"  title="Estado " value="" size="40" maxlength="50" />
    	<span>*</span>  
    </td>
  </tr>
<tr>
    <td align="right" height="20">Municipio:</td>
    <td>
    	<input name="txt_municipio" type="text" id="txt_municipio"  title="Municipio " value="" size="40" maxlength="50" />
    	
    </td>
  </tr>
  <tr>
    <td align="right" height="20">Parroquia:</td>
    <td>
    	<input name="txt_parroquia" type="text" id="txt_parroquia"  title="Parroquia " value="" size="40" maxlength="50" />
    	 
    </td>
  </tr>
   <tr>
    <td align="right" height="20">Email:</td>
    <td>
    	<input name="txt_email" type="text" id="txt_email"  title="Email " value="" size="30" maxlength="50" />
    	<span>*</span>  
    </td>
  </tr>



  <tr>
    <th colspan="2" height="40" align="center">
    <button type="button" name="modificar"  id="modificar" class="button" title="Modificar Registro -  Haga Click para Modificar">MODIFICAR
    <img src="../imagenes/tick_16.png" />             
    </button>            
    </th>
  </tr>

</table>
</form>
</td>
	</tr>
	</tbody>
	</table>
<?php include('../../footer.php'); ?>

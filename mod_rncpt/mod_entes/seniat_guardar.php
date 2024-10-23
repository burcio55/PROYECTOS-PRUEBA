<?php
// al descomentar el diplay_errors se visualizan los errores de php
include("../../header.php"); 

$settings['debug'] = true;
$conn= getConnDB($db2);
$conn->debug = $settings['debug'];
$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug = true;

//-------------------------------------------------------------

$aDefaultForm = array();



//doAction($conn);

showForm($conn,$aDefaultForm);


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


function showForm($conn,$aDefaultForm){
?>
<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
<style type="text/css">

	.loaders {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;	
		background: url('../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255,255,255);
		opacity: 0.6;
    	filter: alpha(opacity=60);
	}
	
	</style>
<script type="text/javascript" src="funciones_seniat_guardar.js"></script>	

<script>
	function mayusculas(e) {
    e.value = e.value.toUpperCase();
}</script>		
<form name="frm_rnet_plantilla" id="frm_rnet_plantilla" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
   <tr>
      <th colspan="4"  class="sub_titulo"><div align="left">MANTENIMIENTO --> Registrar R.I.F </div></th>
    </tr>

    <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
     </tr>

<tr>
     <th width="50%" colspan="2" align="right"><div align="right">Registro de Informaci&oacute;n Fiscal (R.I.F) &nbsp;</div></th>	
     <td width="50%" colspan="2" align="left">
    	<input name="txt_rif" type="text" id="txt_rif" placeholder="Ej. J000012345" onkeyup="mayusculas(this);" title="RIF - Formato:J000012345 (E,V,J,G,C)" value=""  maxlength="10" />
    	<span>*</span>  
    </td>    
</tr>
<tr>
    <th width="23%" class="separacion_20"></th>
  </tr>

<tr>
    <th colspan="4"   class="sub_titulo"style="background-color:#F0F0F0;"><div align="right"><a href="http://contribuyente.seniat.gob.ve/BuscaRif/BuscaRif.jsp" title="Página SENIAT" target="_new">P&aacute;gina SENIAT</a>
</div></th>
</tr>

  <tr>
        <th colspan="2" class="sub_titulo"><div align="center">Nombre o Raz&oacute;n Social</div></th>
        <th colspan="2" class="sub_titulo"><div align="center">Denominaci&oacute;n Comercial</div></th>
   </tr>
   
<tr>
    <td colspan="2"  align="center">
    	<textarea id="txt_razon_social" name="txt_razon_social" cols="60" onkeyup="mayusculas(this);"></textarea><span>*</span></td>
     
     <td colspan="2"  align="center">
    	<textarea id="txt_denominacion_comercial" name="txt_denominacion_comercial" cols="60" onkeyup="mayusculas(this);"></textarea><span>*</span></td>
</tr>
  
<tr>
    <th colspan="4" class="sub_titulo"><div align="center">Direcci&oacute;n Fiscal</div></th>
</tr>

<tr>
    <td colspan="4" align="center">
    	<textarea id="txt_direccion_fiscal" name="txt_direccion_fiscal" onkeyup="mayusculas(this);"cols="130" rows="1"  title="Dirección Fiscal: Indique  la dirección fiscal de la entidad de trabajo según su documento R.I.F."></textarea><span>*</span>  
    </td>
</tr>

<tr>
    <th colspan="2" class="sub_titulo"><div align="center">Estado</div></td>
    <th colspan="2" class="sub_titulo"><div align="center">Municipio</div></td>
    
</tr>

<tr>
    <td colspan="2" align='center'>
    	<input name="txt_estado" type="text" id="txt_estado" onkeyup="mayusculas(this);" title="Estado: Indique el Estado donde se ubica la Entidad de Trabajo." value="" size="30" maxlength="50"style="width:90%" /><span>*</span></td>
    <td colspan="2" align='center'>
    	<input name="txt_municipio" type="text" id="txt_municipio" onkeyup="mayusculas(this);" title="Municipio: Indique el Municipio donde se ubica la Entidad de Trabajo." value="" size="30" maxlength="50" style="width:90%"/><span>*</span>    	 
    </td>
</tr>

<tr>
  <th colspan="2" class="sub_titulo"><div align="center">Parroquia</div></th>
  <th colspan="2" class="sub_titulo"><div align="center">Correo Electr&oacute;nico de la Entidad de Trabajo</div></th>
</tr>

<tr>
    <td colspan="2" align='center'>
    	<input name="txt_parroquia" type="text" id="txt_parroquia"  title="Parroquia: Indique el Municipio donde se ubica la Entidad de Trabajo. " value="" size="30" maxlength="50"style="width:90%" onkeyup="mayusculas(this);" /> <span>*</span> 	
    </td>
        <td colspan="2" align='center'>
    	<input name="txt_email" type="text" id="txt_email"  placeholder="Ej: miempresa@gmail.com,miempresa@hotmail.com" title="Email: Indique el correo electronico utilizado por la entidad de trabajo para Inscribirse ante el SENIAT " value="" size="30" maxlength="50"style="width:90%" />
    	<span>*</span>  
    </td>
  </tr>
  
 <tr>
    <th width="23%" class="separacion_20"></th>
  </tr> 
<tr>
    <td colspan="4" height="40" align="center">
    <button type="button" name="guardar"  id="guardar" class="button_personal btn_guardar" title="Guardar Registro -  Haga Click para Guardar">Guardar              
    </button>            
    </td>
 </tr>   
<tr>
   <th class="separacion_20"></th>
</tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>
</form>

    		
	</td>
	</tr>
	</tbody>
	</table>
	<?php
 }
?> 
<?php include('../../footer.php'); ?>

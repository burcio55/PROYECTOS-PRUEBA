<?php
header("Content-type: text/html; charset=UTF-8");
require_once("include/header.php");
include("LoadCombos.php");

ini_set("display_errors", 0);
error_reporting(-1);

$conn= getConnDB($db1);
$conn->debug = $settings['debug'] = false;
$conn->debug = false;

debug();
showHeader();
showForm($conn);
showFooter();

function debug(){
	if($GLOBALS['settings']['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function showHeader(){
	include("header.php"); 
}

function showForm($conn){
?>
<form enctype="multipart/form-data" action="" method="post" id="formularioOAC" name="formularioOAC">
<br />

<!--<script language="JavaScript" type="text/javascript" src="js/jquery_1.12.1.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="Validacion_AOC_Participacion_ciudadana.js"></script>
<script language="JavaScript" type="text/javascript" src="funciones.js"></script>
<script language="JavaScript" type="text/javascript" src="funcion_identifica_ciudadano.js"></script>



<table width="80%" align="center" class="formulario" border="0">
  
  <tr>
    <td colspan="3">Fecha: <?=date('d/m/Y')?> </td>
  </tr>
  
  <tr>
    <td width="30%"><label>Estado:
		<select id="cbo_entidad" name="cbo_entidad" onChange="estado_combo();">
			<option value="">Seleccione</option>
			<? LoadEstado ($conn) ; print $GLOBALS['sHtml_cb_Estado']; ?>
		</select>
    </label><span class="requerido"> * </span></td>
    <td width="35%"><label>Municipio:
 		<select id="cbo_municipio" name="cbo_municipio" onChange="municipio_combo();">
        	<option value="">Seleccione</option>
        </select>
    </label><span class="requerido"> * </span></td>
    <td width="35%"><label>Parroquia:
        <select id="cbo_parroquia" name="cbo_parroquia">
        <option value="">Seleccione</option>
        <option <? if($aDefaultForm['cbo_parroquia_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_parroquia']; ?>"><?= $aDefaultForm['cbo_parroquia_descripcion'];?></option>
      </select>
    </label><span class="requerido"> * </span></td>
  </tr>
  
  <tr>
    <td colspan="3"><label>Cedula Identidad
        <select name="nacionalidad" id="nacionalidad">
          <option value="1">V</option>
          <option value="2">E</option>
        </select>
		<label> </label> 
		<input name="cedulaconsulta" id="cedulaconsulta" type="text" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." maxlength="8" onkeypress="return isNumberKey(event);" onblur="identificaciudadano()"> <span class="requerido"> * </span>
    </label></td>
  </tr>
  
  <tr>
    <td colspan="3"><label>Apellidos y Nombres:
	<input name="apellidonombre" type="text" id="apellidonombre" value="" size="50" disabled="disabled">
 	</label></td>
    </tr>
  
  <tr>
    <td><label>Telefono:
      <input name="codigo" type="text" id="codigo" onkeypress="return isNumberKey(event);" onblur="" size="5" maxlength="4" autocomplete="off"/> 
      <label> - </label> 
	  <input name="telefono" type="text" id="telefono"onblur=""  onkeypress="return isNumberKey(event);" size="8" maxlength="7" autocomplete="off"/> 
	  <span class="requerido"> * </span>
      </label></td>
    <td colspan="2"><label>Correo:
      <input name="email" type="text" id="email" onblur="validarEmail()" size="50" autocomplete="off" value=""/> <span class="requerido">*</span>
      </label></td>
    </tr>
  
  <tr>
    <td colspan="3"> 
      <label>Exposici&oacute;n de Motivos:
      <select name="motivo" id="motivo">
        <option value="">Seleccione</option>
        <option value="1">Salud</option>
		<option value="1">Trabajo</option>
      </select> <span class="requerido"> * </span>
      </label></td>
  </tr>
   
  <tr>
    <td colspan="3" align="center"><label>
      <textarea id="comentario" name="comentario" cols="150%" rows="7%" class="areatexto"></textarea>
    </label></td>
  </tr>
  
  <tr>
    <td colspan="3" align="center"><p>&quot;El objetivo de la OAC es promover la particcipaci&oacute;n ciudadana y apoyar, orientar, recibir y tramitar denuncias, quejas, reclamos, sugerencias y peticiones&quot;</p>
      <p>(Art. 12 de la Resoluci&oacute;n No. 0100000225 de la Contraloria General de la Rep&uacute;blica)</p>
      <p><strong>CHAVEZ VIVE</strong></p></td>
  </tr>
  <tr>
    <td colspan="3"><table id="entesmin" width="100%" border="0">
  <tr>
    <td width="16%" align="center"><label>
        <input type="image" name="tss" src="imagenes/entes_adscritos/tss.jpg" width="95%" height="95%" disabled="disabled" />
    </label></td>
    <td width="17%" align="center"><label>
      <input type="image" name="imageField" src="imagenes/entes_adscritos/inces.jpg" width="95%" height="95%" disabled="disabled"/>
    </label></td>
    <td width="17%" align="center"><label>
      <input type="image" name="imageField2" src="imagenes/entes_adscritos/inpsasel.jpg" width="95%" height="95%" disabled="disabled"/>
    </label></td>
    <td width="17%" align="center"><label>
      <input type="image" name="imageField3" src="imagenes/entes_adscritos/farmapatria.jpg" width="95%" height="95%" disabled="disabled"/>
    </label></td>
    <td width="17%" align="center"><label>
      <input type="image" name="imageField4" src="imagenes/entes_adscritos/incret.jpg" width="95%" height="95%" disabled="disabled"/>
    </label></td>
    <td width="16%" align="center"><label>
      <input type="image" name="imageField5" src="imagenes/entes_adscritos/ivss.jpg" width="95%" height="95%" disabled="disabled"/>
    </label></td>
  </tr>
    <tr>
    <td align="center"><input type="radio" name="entes" id="entes" value="Tesorería de Seguridad Social"></td>
    <td align="center"><input type="radio" name="entes" id="entes" value="Instituto Nacional de Capacitación y Educación Socialista"></td>
    <td align="center"><input type="radio" name="entes" id="entes" value="El Instituto Nacional de Prevención, Salud y Seguridad Laborales"></td>
    <td align="center"><input type="radio" name="entes" id="entes" value="Farmapatria"></td>
    <td align="center"><input type="radio" name="entes" id="entes" value="Instituto Nacional de Capacitacion y Recreación de los Trabajadores"></td>
    <td align="center"><input type="radio" name="entes" id="entes" value="Instituto Venezolano de los Seguros Sociales"></td>
  </tr>
  
  
</table></td>
  </tr>
    <tr>
    <td colspan="3" align="center"><input class="botonenviar" id="enviar" name="enviar" type="button" value="Enviar" /></td>
  </tr>
  
</table>
<br />
</form>
<?
}

function showFooter(){
	$aPageErrors = $GLOBALS['aPageErrors'];
	print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script> alert('".join('\n',$aPageErrors)."') </script>":"";
	include("footer.php");
} 
?>


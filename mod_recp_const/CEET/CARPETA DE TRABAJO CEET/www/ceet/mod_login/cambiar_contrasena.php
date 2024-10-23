<?php 
include("../header.php"); 
include("funciones_cambiar_contrasena.php"); 

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

$settings['debug'] = false;
//$conn= getConnDB($db1);
//$conn->debug = $settings['debug'];

//debug();
//doAction();

?>
<link rel="stylesheet" type="text/css" media="all" href="../css/styles_cambiaclave.css" />
<script src="funciones_cambiar_contrasena.js"></script>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody><tr valign="top">
	<td>

	<h1>Establecer Una Contrase&ntilde;a Nueva</h1>
		<p>&nbsp;</p>
		<table width="60	%" border="0" align="center">
		  <tr>
			<td width="50%"><form name="form" id="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
			<input name="action" type="hidden" value="" />
				<ul>
					<li>
						<label for="pswd">Nueva contrase&ntilde;a:</label>
						<span><input class="form-control" id="pswd" type="password" name="pswd" onkeyup="muestra_seguridad_clave(this.value, this.form)" /></span>
					</li>
					<li>
						<label for="pswd2">Confirmar nueva contrase&ntilde;a:</label>
						<span><input class="form-control" id="pswd2" type="password" name="pswd2" /></span>
					</li>
					<li>
						<button type="button" class="button_personal btn_guardar" onclick="javascript:aceptar('guardar');" title="Haga Click para guardar la contraseña">Guardar</button>  
						
						<!--<button type="button" class="button_personal btn_regresar" onclick="javascript:regresar('regresar');" title="Haga Click para Regresar al Men&uacute; Principal">Regresar</button>--> 
						
						<button type="button" class="button_personal btn_limpiar" onclick="javascript:limpiar();" title="Haga Click para Limpiar">Limpiar</button>
					</li>
				</ul>	
			</form></td>
			<td width="50%"><div id="pswd_info">
			  <h4>Defina una contrase&ntilde;a que cumpla las siguientes Caracteristicas:</h4>
				<h4 id="seguridad">Nivel de Seguridad: 0%</h4>
				<ul>
					<li id="letter" class="invalid">Al Menos <strong>Una Letra Min&uacute;scula</strong></li>
					<li id="capital" class="invalid">Al Menos <strong>Una Letra May&uacute;scula</strong></li>
					<li id="number" class="invalid">Al Menos <strong>Un N&uacute;mero</strong></li>
					<li id="character" class="invalid">Al Menos <strong>Un Caracter  @ # % & </li>
					<li id="length" class="invalid">Debe Contener mas de <strong>8 Caracteres</strong></li>
					<li id="letter2" class="invalid">La Contrase&ntilde;a <strong>No Coinciden</strong></li>
				</ul>
			</div></td>
		  </tr>
		</table>
    		
	</td>
	</tr>
	</tbody></table>

<div id="loader" class="loaders" style="display: none;"></div>
	
<?php include("../footer.php"); ?>
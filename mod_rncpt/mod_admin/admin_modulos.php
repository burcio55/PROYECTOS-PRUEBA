<?php 
include("../header.php");
include("general_LoadCombo.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

debug();

?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>

		<form method="post" enctype="multipart/form-data" name="modulos" id="modulos">
		<script type="text/javascript" src="funciones_admin_modulos.js"></script>
			<table width="90%" border="0" align="center" class="formulario">
			
		
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr> 
				
				<tr>
					<th width="100%" colspan="2" class="titulo">ADMINISTRAR M&Oacute;DULOS</th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 1.- AGREGAR MODULO</th>
				</tr>
										
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<td width="20%"><div align="right">Descripci&oacute;n Modulo: </div></td>
					<td width="80%"><input id="modulo" name="modulo" type="text" size="95" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"/></td>
				</tr>
				
				<tr>
					<td width="20%"><div align="right">URL del Modulo: </div></td>
					<td width="80%"><input id="url_modulo" name="url_modulo" type="text" size="95" /></td>
				</tr>
				
				<tr>
					<td width="100%" colspan="2">
						<table width="100%" border="0">
						<input type="hidden" name="imagen1" id="imagen1" />
						<input type="hidden" name="imagen2" id="imagen2" />
						<input type="hidden" name="modulo_id" id="modulo_id" />
						<input type="hidden" name="opcion_id" id="opcion_id" />
						  <tr>
							<td width="50%"><div align="center"><input type="file" name="logo1" id="logo1" /></div></td>
							<td width="50%"><div align="center"><input type="file" name="logo2" id="logo2" /></div></td>
						  </tr>
						  <tr>
							<td width="50%"><div align="center"><img id="logo1_muestra" src="/minpptrassi/logos/imagen1.jpg" /></div></td>
							<td width="50%"><div align="center"><img id="logo2_muestra" src="/minpptrassi/logos/imagen2.jpg" /></div></td>
						  </tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td width="100%" colspan="2">
					<div align="center" id="agregar">
						<button type="button" class="button_personal btn_agregar" onclick="javascript:agregar()" title="Haga Click para Agregar" >Agregar</button>
						<button type="button" class="button_personal btn_limpiar" onclick="javascript:limpiar()" title="Haga Click para Limpiar" >Limpiar</button>
					</div>
					<div align="center" id="editar">
						<button type="button" class="button_personal btn_editar" onclick="javascript:actualizar()" title="Haga Click para Editar" >Editar</button> 
						<button type="button" class="button_personal btn_cancelar" onclick="javascript:limpiar()" title="Haga Click para Cancelar" >Cancelar</button>
					</div></td>
				</tr>
								
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
						
				<tr>
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 2.- EDITAR M&Oacute;DULO</th>
				</tr>		
				 
				<tr>
					<td colspan="2">
			
						<div class='outer_div'></div>
			
					</td>
				</tr>
			</table>
		</form>
    		
	</td>
	</tr>
	</tbody>
	</table>

<?php include("../footer.php"); ?>
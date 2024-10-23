<?php 
include("../header.php");
include("general_LoadCombo.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

debug(); 

$modulo = decrypt($_GET['M']);
$opcion = decrypt($_GET['O']);

$SQL1="SELECT sdescripcion FROM modulo WHERE id = '".$modulo."';";	
$rs1 = $conn->Execute($SQL1);
$describemodulo = $rs1->fields['sdescripcion'];
?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>

		<form method="post" enctype="multipart/form-data" name="opciones" id="opciones">
		<script type="text/javascript" src="funciones_admin_opciones.js"></script>
		<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
			<table width="90%" border="0" align="center" class="formulario">
				<input type="hidden" name="modulo" id="modulo" value="<? echo $modulo; ?>" />
				<input type="hidden" name="opcion" id="opcion" value="<? echo $opcion; ?>"/>
				<input type="hidden" name="id_opcion_menu" id="id_opcion_menu" value=""/>
			
		
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr> 
				
				<tr>
					<th width="100%" colspan="2" class="titulo">ADMINISTRAR OPCIONES ROL</th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 1.- AGREGAR OPCIONES</th>
				</tr>
										
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<td width="20%"><div align="right">Modulo: </div></td>
					<td width="80%"><input id="decripcionmodulo" name="decripcionmodulo" type="text" size="95" value="<? echo $describemodulo; ?>" readonly/></td>
				</tr>

				<tr>
					<td width="20%"><div align="right">Detalles Opci&oacute;n: </div></td>
					<td width="80%">
						<div style="float:left">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tipo: </strong>
							<select name="tipooption" id="tipooption" onChange="menutipo();">
								<option value="">Seleccione</option>
								<option value="1">MEN&Uacute; - # </option>
								<option value="2">SUB MEN&Uacute; - # </option>
								<option value="3">OPCI&Oacute;N</option>
							</select>
						</div>
						<div id="combomenu" style="float:left">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Opci&oacute;n Men&uacute;: </strong> 
							<select id="cbo_menu" name="cbo_menu" onChange="menuoptionivel();">
								<option value="">Seleccione</option>
							</select>
						</div>	
						<div id="combonivel" style="float:left">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nivel: </strong> 
							<select id="nivel" name="nivel">
								<? 
								for ($i = 0; $i <= 9; $i++) {
									$ii = $i+1; 
									echo "<option value=".$i.">".$ii."</option>";
								}
								?>
							</select>
						</div>
						<div id="comboorden" style="float:left">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Orden: </strong> 
							<select id="Orden" name="Orden">
								<? 
								for ($i = 1; $i <= 10; $i++) {
									echo "<option value=".$i.">".$i."</option>";
								}
								?>
							</select>
						</div>				  
					</td>
				</tr>
				
				<tr id="descripcion">
					<td width="20%"><div align="right">Descripci&oacute;n Opci&oacute;n: </div></td>
					<td width="80%"><input id="descripcion_opcion" name="descripcion_opcion" type="text" size="95" /></td>
				</tr>
				
				<tr id="urlopcion">
					<td width="20%"><div align="right">URL Opci&oacute;n: </div></td>
					<td width="80%"><input id="url" name="url" type="text" size="95"/></td>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="separacion_20"></th>
				</tr>
				
				<tr>
					<td width="100%" colspan="2">
					<div align="center" id="agregar">
						<button type="button" class="button_personal btn_agregar" onclick="javascript:agregar()" title="Haga Click para Agregar" >Agregar</button>
						<button type="button" class="button_personal btn_limpiar" onclick="javascript:limpiar()" title="Haga Click para Limpiar" >Limpiar</button>
						<button type="button" class="button_personal btn_regresar" onclick="javascript:regresar()" title="Haga Click para Regresar" >Regresar</button>
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
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 2.- EDITAR OPCIONES</th>
				</tr>		
				 
				<tr>
					<td colspan="2">
			
						<div id="forma" class="limpiaforma"></div>
			
					</td>
				</tr>
			</table>
		</form>
    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../footer.php"); ?>
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

		<form method="post" enctype="multipart/form-data" name="roles" id="roles">
		<script type="text/javascript" src="funciones_admin_roles.js"></script>
			<table width="90%" border="0" align="center" class="formulario">
				<input type="hidden" name="modulo" id="modulo" value="<? echo $modulo; ?>" />
				<input type="hidden" name="opcion" id="opcion" value="<? echo $opcion; ?>"/>
				<input type="hidden" name="rol_id" id="rol_id" value=""/>
		
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr> 
				
				<tr>
					<th width="100%" colspan="2" class="titulo">ADMINISTRAR ROLES</th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 1.- AGREGAR ROL</th>
				</tr>
										
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<td width="20%"><div align="right">Modulo: </div></td>
					<td width="80%"><input id="decripcionmodulo" name="decripcionmodulo" type="text" size="95" value="<? echo $describemodulo; ?>" readonly/></td>
				</tr>
				
				<tr>
					<td width="20%"><div align="right">Descripci&oacute;n Rol: </div></td>
					<td width="80%"><input id="rol" name="rol" type="text" size="95" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"/></td>
				</tr>
				
				<tr>
					<td width="20%"><div align="right">Visto Por: </div></td>
					<td width="80%">
					  <select id="cbo_administrador" name="cbo_administrador">
						<option value="">Seleccione</option>
						<option value="1">PROGRAMADORES</option>
						<option value="0">USUARIOS</option>
					  </select>			
						<!--<span>*</span>-->				
					</td>
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
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 2.- EDITAR ROL</th>
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
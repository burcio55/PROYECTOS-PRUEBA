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

		<form name="usuarios" id="usuarios" method="post">
		<script type="text/javascript" src="funciones_admin_usuario.js"></script>
		<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
			<table width="90%" border="0" align="center" class="formulario">
			
		
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr> 
                <tr>
             <th colspan="4"  class="sub_titulo"><div align="left">MANTENIMIENTO --> Usuarios</div></th>
        </tr>
				
				<tr>
					<th width="100%" colspan="2" class="titulo">ADMINISTRAR ROL DE USUARIOS</th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 1.- MODULOS Y ROLES </th>
				</tr>
										
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				<?php if($_SESSION['moduloid'] == 3){ ?>
				<tr>
					<td width="20%"><div align="right">Módulos: </div></td>
					<td width="80%">
						<select id="cbo_sistema" name="cbo_sistema">
						<option value="">Seleccione</option>
						<?  LoadSistema ($conn) ; print $GLOBALS['sHtml_cb_Sistemas']; ?>
						</select>			
						<!--<span>*</span>-->				
					</td>
				</tr>
				
				<tr>
				<td width="20%"><div align="right">Roles: </div></td>
					<td width="80%">
						<select id="cbo_roles" name="cbo_roles" onChange="load();">
						<option value="">Seleccione</option>
					  </select>			
						<!--<span>*</span>-->				
					</td>
				</tr>
				<?php }else{ ?>
				<tr>
					<td width="20%"><div align="right">Módulos: </div></td>
					<td width="80%">
						<select id="cbo_sistema" name="cbo_sistema">
						<option value="<?=$_SESSION['moduloid']?>"><?= $_SESSION['modulodescriocion']?></option>
						</select>			
						<!--<span>*</span>-->				
					</td>
				</tr>
				
				<tr>
				<td width="20%"><div align="right">Roles: </div></td>
					<td width="80%">
						<select id="cbo_roles" name="cbo_roles" onChange="load();">
						<option value="">Seleccione</option>
						<?  LoadRoles ($conn) ; print $GLOBALS['sHtml_cb_roles']; ?>
					  </select>			
						<!--<span>*</span>-->				
					</td>
				</tr>				
				<?php } ?>
						
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2">
						<div id="botones" align="right">MARCAR TODOS: 
							<button type="button" class="btn btn-default btn-sm" onclick="javascript:checkedtodo()">
         						<span class="glyphicon glyphicon-check"></span> SI
       						</button>
							<button type="button" class="btn btn-default btn-sm" onclick="javascript:nocheckedtodo()">
         						<span class="glyphicon glyphicon-unchecked"></span> NO 
       						</button>
						</div>
					</th>
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
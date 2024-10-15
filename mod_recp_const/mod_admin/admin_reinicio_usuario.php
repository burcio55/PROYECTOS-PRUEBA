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
		<script type="text/javascript" src="funciones_admin_reinicio_usuario.js"></script>
		<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
			<table width="90%" border="0" align="center" class="formulario">
			
		
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr> 
				
				<tr>
					<th width="100%" colspan="2" class="titulo">USUARIOS REGISTRADOS</th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>
				
				<tr>
					<th width="100%" colspan="2" class="sub_titulo" align="left"> 1.- REINICIO ACCESO USUARIOS</th>
				</tr>
										
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
				</tr>

						
				<tr>
					<th width="100%" colspan="2" class="separacion_10"></th>
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
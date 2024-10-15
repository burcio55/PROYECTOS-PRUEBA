<?php 
include("../header.php"); 

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
	<center style="height: 100%; margin: 0; display: flex; justify-content: center; align-items: center;">
		<div style="width: 80%; height: auto;">
			<form method="POST" action="">
				<div style="border-radius: 30px 30px 0 0; padding: 30px 0 10px 20px; background-color: #fff; text-align: center;">
					<!-- Parte superior del formulario -->
					<img src="imagenes/logo.png" alt="Logo" style="width: 100%; height: auto;">
					<!-- Título del logo -->
				</div>
			</form>
		</div>
	</center>	
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../footer.php"); ?>
<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

$aDefaultForm = array();
$aPageErrors = array();

debug($settings['debug']);
doAction($conn);
showForm($conn,$aDefaultForm);

function doAction($conn)
{
	if (isset($_POST['action'])){
		switch($_POST['action']){
			case 'btnCrear_clicked':
			$bValidateSuccess=true;
			$susuario= str_replace("'","\'",$_POST['susuario']);
			if (!ctype_digit($susuario)) {
				$GLOBALS['aPageErrors'][]="- N° de la C&eacute;dula de Identidad no es válido.";
				$bValidateSuccess=false;
			}
												
			if ($bValidateSuccess){
				ProcessForm($conn, $registro);
			}				
			loadData($conn, $registro, true);
			break;
		}
	}
	else{
		loadData($conn, $registro, false);
	}
}



function loadData($conn, $registro, $bPostBack){

} 

function ProcessForm($conn, $registro) {
$sSQL = "SELECT * FROM personales WHERE cedula IN ('".$_POST['susuario']."')";


			$rs = $conn->Execute($sSQL);
			if ($rs->RecordCount()>0){
				$_SESSION['consulta_susuario']=$_POST['susuario'];
				header('location: rec_pago_usu_recibo_jubilados.php');
			}
			else {
				print "<script>alert ('El usuario no esta registrado en el sistema, debe verificar el Nro. de la C&eacute;dula ingresada.');</script>";
			}

	
}
?>


<?php function showForm($conn,$aDefaultForm){ // en esta funcion siempre va el formulario ?>


	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
    
    
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
<script>
function send(saction){
var form=document.form;
form.action.value=saction;
form.submit();
}
</script>
<input name="action" type="hidden" value="">
<TABLE cellSpacing=1 cellPadding=2 width="100%" border=1 bordercolor="silver">
<TBODY>
	<TR align=left>
  			<TD colspan="6" class="titular"><strong>CONSULTAR FUNCIONARIO</strong></TD>
	</TR>
	<TR>
    	<TD class="dataListColumn" align="right" style="color:#4B4646"><b>Nro. C&eacute;dula de Identidad:</b></TD>
	    <TD class="dataListColumn"><input name="susuario" type="text" class="textbox" style="color:#323030" id="susuario" size="20" maxlength="20" value="<?= $_POST['susuario'] ?>"> 
	    <span class="requerido">Ej. 12345678 - Usted no debe rellenar con ceros (0) a la izquierda</span></TD>
	</TR>	
<TR >
  <TD colspan="6" class="texto-normal"><div align="center"><input name="btnAceptar" type="submit" class="button" id="btnAceptar" value="Consultar" onclick="javascript:send('btnCrear_clicked')" /></div></TD>
</TR>

    
</TBODY>
</TABLE>
</form>
    	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>
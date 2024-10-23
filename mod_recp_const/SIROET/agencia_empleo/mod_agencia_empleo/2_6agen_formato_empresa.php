<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug']=false);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION['bloq']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
}
//------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){

}
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){	}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
include('menu_empresa.php'); 
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
  <p>
    <script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
          </script>
    <input name="action" type="hidden" value=""/>
</p>
 
       <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
		    <tr>
          	<td></td>
          </tr>
          <tr>
          	<td></td>
          </tr>
             <tr>
          	<td></td>
          </tr>
          <tr>
          	<td></td>
          </tr>
           <tr>
          	<th colspan="4" class="titulo" align="center">FORMATO </th>
          </tr>
          <tr>
          	<th colspan="4" class="sub_titulo" align="left">Formatos: </th>
          </tr>
          
        <tr>
          <td colspan="4" class="link-clave-ruee">&nbsp;</td>
        </tr>
        <tr>
          <td width="33%" class="link-clave-ruee">&nbsp;</td>
          <td width="17%" class="link-clave-ruee"><div align="center"><img src="imagenes/client_account_template.png" width="36" height="38" border="0" /></div></td>
          <!--<td width="17%" class="link-clave-ruee"><div align="center"><img src="../imagenes/client_account_template.png" width="36" height="38" border="0" /></div></td>-->
          <td width="33%" class="link-clave-ruee">&nbsp;</td>
        </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td class="link-clave-ruee"><div align="center"><a href="?formato=3" class="links-menu-izq">Constancia de Afiliaci&oacute;n </a></div></td>
          <!--<td class="link-clave-ruee"><div align="center"><a href="2_7agen_constancia_migrante_emp.php" class="links-menu-izq">Constancia de Migración </a></div></td>
          <td class="link-clave-ruee">&nbsp;</td>-->
        </tr>
        <tr>
          <td colspan="4" class="link-clave-ruee">&nbsp;</td>
        </tr>
      </table>
      <p>
</p>

</form> 
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php include('../footer.php'); ?>
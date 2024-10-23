<?php
session_start();
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
$conn = getConnDB('sire');
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug =false;
doAction($conn);
LoadData($conn,$bPostBack);
debug($settings['debug']= false);
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
		var_dump($_SESSION);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
if (isset($_POST['action'])){
		switch($_POST['action']){
				
		 }
		}		
		else{
		LoadData($conn,false);
		}
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
	  }
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
header ("Cache-Control: no-cache, must-revalidate");  
header ("Pragma: no-cache");  
header ("Content-type: application/x-msexcel");  
header ("Content-Disposition: attachment; filename=\"consulta_de_trabajadores.xls\"" );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

<title>Agencia Empleo</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../js/datetimepicker.js"></script>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
//header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
//header ("Cache-Control: no-cache, must-revalidate");  
//header ("Pragma: no-cache");  
//header ("Content-type: application/x-msexcel");  
//header ("Content-Disposition: attachment; filename=\"consulta_de_trabajadores.xls\"" );
?>
<style type="text/css">
<!--
.Estilo12 {font-weight: bold}
-->
</style>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>
          <input name="action" type="hidden" value=""/>
	      <!-- aqui coloca los valores ocultos de la página -->
		  <? if(isset($_SESSION['aTabla'])){ ?> 	  
	       <table  border="0" align="center" class="listado formulario">	
		     
           <tr>
             <td colspan="15"><b>Consulta de Trabajadores(as) por: <? print $_SESSION['criterio']?></b></td>
           </tr>
           <tr>
            <th class="labelListColumn">Nro.</th>
            <th class="labelListColumn">C&eacute;dula</th>
            <th class="labelListColumn">Nombres y Apellidos</th>
            <th class="labelListColumn">Sexo</th>
            <th class="labelListColumn">Edad</th>
            <th class="labelListColumn">Migrante</th>
            <th class="labelListColumn">Discap.</th>
            <th class="labelListColumn">Part/Com</th>
            <th class="labelListColumn">Situación Ocupacional</th>
            <th class="labelListColumn">Ocupaci&oacute;n</th>
            <th class="labelListColumn">Nivel Educativo</th>
            <th class="labelListColumn">Estado</th>
            <th class="labelListColumn">Municipio</th>
            <th class="labelListColumn">Parroquia</th>
            <th class="labelListColumn">Fecha Afiliaci&oacute;n</th>
          </tr>
          <?
	$aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $i=0; $i<count($aTabla); $i++){
		?>
          <tr>
            <td><?=$aTabla[$i]['id']?></td>
            <td><?=$aTabla[$i]['cedula']?></td>
            <td><?=$aTabla[$i]['nombres']?> <?=$aTabla[$i]['apellidos']?></td>
            <td><?=$aTabla[$i]['sexo']?></td>
            <td><?=$aTabla[$i]['edad']?></td>
            <td><?=$aTabla[$i]['migrante']?></td>
            <td><?=$aTabla[$i]['discapacidad']?></td>
            <td><?=$aTabla[$i]['consejo_com']?></td> 
            <td><?=$aTabla[$i]['situacion_actual']?> - <?=$aTabla[$i]['situacion']?></td> 
            <td><?=$aTabla[$i]['ocupacion1']?></td> 
            <td><?=$aTabla[$i]['nivel_instruccion']?></td>
            <td><?=$aTabla[$i]['estado']?></td>
            <td><?=$aTabla[$i]['municipio']?></td>
            <td><?=$aTabla[$i]['parroquia']?></td>
            <td><?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['created_at']))?></td>
          </tr>          
          <? } ?>
        </table>
  <? } ?>
</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>alert('".join('\n',$aPageErrors)."')</script>":""; 
?> 
</body>
</html>
<?php
}
?>

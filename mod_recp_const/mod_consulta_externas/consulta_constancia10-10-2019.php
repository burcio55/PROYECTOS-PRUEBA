<? 
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../../include/header.php');
include("LoadCombos.php");
$settings['debug']=false;  
$conn= getConnDB($db4);
$conn->debug = $settings['debug'];
//----------------------------------
$aPageErrors = array();
doAction($conn);

function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST["action"]){
		case'buscar':
		$bValidateSuccess=true;
		$patrRango = "/[0-9]|[A-Z]/"; // Rango de la 'a' hasta la 'z' mayúsculas y minúsculas. 

		if ($_POST['txt_codigo_cod']=="" or !preg_match($patrRango,trim($_POST['txt_codigo_cod'])))	{
			$GLOBALS['aPageErrors'][]= "- El campo Código de Constancia debe contener solo caracteres alfanumericos.";
			$bValidateSuccess=false;
		}
		
		if ($bValidateSuccess){
		
			$SQL="SELECT scodigo_constancia, fecha_caducidad_const
				  FROM recibos_pagos_constancias.constancias_trabajo
				  where scodigo_constancia like '%".$_POST['txt_codigo_cod']."%' AND nenabled='1'" ;
				$rs=$conn->Execute($SQL);
				
				//$aDefaultForm['fecha_caducidad_const']		=$rs->fields['fecha_caducidad_const'];
				   // si existe llena el formulario pasando los datos que tiene en la bd al campo del formulario
			
			if($rs->RecordCount()==0){
				 $GLOBALS['aPageErrors'][]= "- El c\u00F3digo suministrado no existe en la base de datos";	
				 
			}
			else{
				$_SESSION['txt_codigo_cod'] =$_POST['txt_codigo_cod'];
				header('location:/minpptrassi/mod_recp_const/mod_consulta_externas/consulta_constancia_certificada.php');
			}			
		}
		break;

		}
	}
		else{
		//LoadData($conn,false);
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONSULTAS MPPPST</title>
<link rel="stylesheet" type="text/css" href="../../css/formularios.css"/>
<link rel="stylesheet" type="text/css" href="../../css/ventana.css"/>
<link rel="stylesheet" type="text/css" href="../../css/botones_IZ.css"/>
<style type="text/css">
</style>


</head>
<body>
<form id="consulta_constancia" name="consulta_constancia" method="post">

<script>  
function send(saction){
	//	alert ("ENTRO1");
		var form = document.consulta_constancia;
		form.action.value=saction;
		//form.id.value=id;
		form.submit();	
	}

var pagina="http://www.mpppst.gob.ve"
function redirecciona(saction){ 
	if(saction=='regresar'){
		location.href=pagina
	}
	setTimeout ("redirecciona()", 20000);
}
</script>
<input name="action" type="hidden" value="" />
 

  <div id="contenedor">
    <div id="separador_superior"></div>
    <div id="mensaje_ancho">
    </div>
    <!--<div id="candado">
     <img src="../../imagenes/verific.jpeg" width="137" height="137" /></div>
    <div id="formulario">-->
<table class="formulario" width="550" height="253" border="0" align="center">
<br />
 <tr>
    <th class="titulo" colspan="4" align="center">CERTIFICACI&Oacute;N DE CONSTANCIA ELECTR&Oacute;NICA </th>
 </tr>

  <tr>
	   
     <td height="5" colspan="4" bgcolor="#FBF0D2"></td>
     
  </tr>
  
  <tr class="identificacion_seccion2">
    <td colspan="1" rowspan="2" width="140" height="47" bgcolor="#FFFFFF" align="left"><div align="center"><img src="../../imagenes/verific.jpeg" width="90" height="90"></div></td>
    
   <td colspan="2" height="42"  width="405" align="center">C&oacute;digo: <input class="input_em" name="txt_codigo_cod" id="txt_codigo_cod" type="text"  value="<?= $aDefaultForm['txt_codigo_cod'];?>" title="C&oacute;digo de Certificaci&oacute;n - Ingrese s&oacute;lo N&uacute;meros. Acepta 10 Digitos." size="29" maxlength="10"/>
      <span>*</span></td>
      <td colspan="1" rowspan="2" width="140" height="47" bgcolor="#FFFFFF" align="left">&nbsp;</td>         
    </tr>
    
    
    <tr>
     <td colspan="1" align="center">
     
	 <!-- <button type="button" name="btnguardar"  id="btnguardar" class="button" onclick="javascript:send('guardar');" title="Consulta Constancia -  Haga Click para Consultar">CONSULTAR <img src="../../imagenes/consultar.png" width="16" height="16" /></button >-->
    <button type="button" class="buttonj btn_buscar" onclick="javascript:send('buscar');" title="Consulta Constancia -  Haga Click para Consultar">Buscar</button>
   
    <!--<button type="button" name="btnRegresar"  id="btnRegresar" class="button" onclick="javascript:redirecciona('regresar');" title="Regresar -  Haga Click para Regresar a la Pantalla Principal">REGRESAR<img src="../../imagenes/regresar.png" width="16" height="16" /></button></td> -->
    <button type="button" class="buttonj btn_regresar" onclick="javascript:redirecciona('regresar');" title="Regresar -  Haga Click para Regresar a la Pantalla Principal">Regresar</button>
    
  </tr>
  

  <tr>
      
      <td height="5" colspan="4" bgcolor="#FBF0D2"></td>
  </tr>
    <tr class="identificacion_seccion3">
      
      <td colspan="4" align="center"><a><img src="../../imagenes/warning_48.png"  width="20" height="20" border="0"></a>  <span> Nota: </span>El c&oacute;digo de certificaci&oacute;n esta ubicado  en la parte inferior derecha del documento.</td>
      
    </tr>
    

 <tr>
  		<th colspan="4" class="separacion_10"></th>
  </tr>
</table>
    </div>
  </div>
</form>
</body>
</html>
<?php 
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert(' ' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; 
?>

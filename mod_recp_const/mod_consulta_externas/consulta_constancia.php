<?php 
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../../include/header.php');
include("LoadCombos.php");

$settings['debug'] = false;  
$conn = getConnDB($db4);
$conn->debug = $settings['debug'];

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
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CONSULTAS MPPPST</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="logo"></div>
        </div>
    </nav>
</header>
<!-- <div class="sep-header"></div> -->
<div class="ajustador">
    <div class="row">    
        <form id="consulta_constancia" name="consulta_constancia" method="post">
            <script>  
                function send(saction) {
                    var form = document.consulta_constancia;
                    form.action.value = saction;
                    form.submit();    
                }
                var pagina = "http://www.mpppst.gob.ve";
                function redirecciona(saction) { 
                    if (saction == 'regresar') {
                        location.href = pagina;
                    }
                    setTimeout("redirecciona()", 20000);
                }
            </script>    
            <input name="action" type="hidden" value="">
            <div id="contenedor">
                <div class="titulo">
                    <h5>CERTIFICACIÓN DE CONSTANCIA DE TRABAJO ELECTRÓNICA</h5>
                </div>
                <div id="separador_superior"></div>
                <div id="mensaje_ancho"></div>
                <table class="formulario" width="600" height="253" border="0" align="center">
                    <tr>
                        <td colspan="4" align="right">
                            <div class="col-sm-4">
                                <h6>Datos obligatorios (*)</h6>
                            </div>
                            <hr>
                        </td>
                    </tr>
                    <tr class="identificacion_seccion2" style="text-align: center;">
                        <td colspan="2" height="42" width="405" align="center">
                            <div class="row justify-content-center">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-12">
                                    <div class="input-group"> 
                                        <label for="txt_codigo_cod" class="form-label">Código <span>*</span></label>
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="control-de-calidad.png" class="icon">
                                        </span>
                                        <input class="form-control" name="txt_codigo_cod" id="txt_codigo_cod" type="text" value="<?= $aDefaultForm['txt_codigo_cod'];?>" title="Código de Certificación - Ingrese sólo Números. Acepta 10 Dígitos." size="29" maxlength="10"/>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
					<td colspan="1" align="center">
                        <button type="button" class="buttonj btn_buscar" onclick="javascript:send('buscar');" title="Consulta Constancia - Haga Click para Consultar" style="margin-top: 25px; margin-right: 10px;">Buscar</button>
                        <button type="button" class="buttonj btn_regresar" onclick="javascript:redirecciona('regresar');" title="Regresar - Haga Click para Regresar a la Pantalla Principal" style="margin-top: 25px;">Regresar</button>
                    </td>
                    </tr>
                    <tr class="identificacion_seccion3">
                        <td colspan="4" align="center" style="margin: top 35px;">
                            <hr>
                            <a><img src="../../imagenes/warning_48.png" width="20" height="20" border="0"></a>
                            <span> NOTA: </span>El código de certificación está ubicado en la parte inferior derecha del documento de la Constancia de Trabajo.
                        </td>
                    </tr>
  <!--                   <tr>
                        <th colspan="4" class="separacion_10"></th>
                    </tr> -->
                </table>
            </div>
        </form>
    </div>
</div>
</body>
 <footer>
    <div class="mg-pub2">
        <div class="cent">
            <h3 tabindex="8" class="text-footer">
                Centro Simón Bolívar. Torre Sur. Caracas, Distrito Capital. Ministerio del Poder Popular para el Proceso Social de Trabajo. RIF G-20000012-0 <br>
                Oficina de Tecnología de la Información y la Comunicación (OTIC) - División de Análisis y Desarrollo de Sistemas.<br>
                © 2023 Todos los Derechos Reservados.
            </h3>
        </div>
    </div>
</footer> 
</html>
<?php 
if (isset($aPageErrors) && count($aPageErrors) > 0) {
    echo "<script>alert('" . implode("\\n", $aPageErrors) . "');</script>";
}
?>

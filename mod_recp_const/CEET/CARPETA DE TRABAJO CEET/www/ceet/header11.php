<?php
session_start();
//include("verificar_session_url.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CEET </title>
<link href='../css/plantilla.css' type=text/css rel=stylesheet>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<!--<link href="../styles/style.css" rel="stylesheet" type="text/css" />
-->


<script type="text/javascript" src="../js/validacion_general.js"></script>	


<!--CALENDARIO-->
<script src="../js/src/js/jscal2.js"></script>
<script src="../js/src/js/lang/es.js"></script>
<link rel="stylesheet" type="text/css" href="../js/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="../js/src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="../js/src/css/win2k/win2k.css" />
<link type="text/css" rel="stylesheet" href="../js/src/css/reduce-spacing.css" />

<!--FIN CALENDARIO-->



<!--<script type="text/javascript" src="../js/jquery.js"></script>-->





<!--LIBRERIA JQUERY Y UI JQUERY (BUSCADOR COMBO)-->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css" />

<!--MENU-->
<link rel="stylesheet" type="text/css" href="../css/ddsmoothmenu.css" />

<!--
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
-->
<script type="text/javascript" src="../js/ddsmoothmenu.js"></script>



<script type="text/javascript">
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1",
	orientation: 'h', 
	classname: 'ddsmoothmenu', 
	contentsource: "markup" 
})
</script>
<!--FIN MENU-->


<!--LIBRERIA PARA FORMATO DE NUMEROS 100.00,00-->
<script type="text/javascript" src="../js/jquery-number-master/jquery.number.js"></script>

<!--LIBRERIA TOOLTIP-->
<!--TOOL TIP-->
<!--LIBRERIA TOOLTIP-->
<script src="../js/jquery.tooltip.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	// modify global settings
	$.extend($.fn.Tooltip.defaults, {
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - "
	});
	$('a, input, img , button,textarea,select').Tooltip();
});
</script>
<!--FIN TOOL TIP-->


<script src="../js/jquery.dataTables.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="../js/demo_table.css" />


<script type="text/javascript" src="../mod_agencia_empleo/validar_trabajador.js"></script>
<script type="text/javascript" src="../mod_agencia_empleo/funciones_trabajador.js"></script>

</head>
<body>
  <div id="content">
    <div id="separador_superior"></div>
    <div id="cabecera_superior"></div>
    <div id="cabecera_inferior">
    <?php
	$_SESSION['usuario']='Yomaira Colmenares';
		if(isset($_SESSION['usuario'])){
		?>
    <table  width="100%" class="formulario" border="0" style="padding-top:0px;" align="right" >
      <tr>
        <td>&nbsp;</td>
      </tr>
    	<!--<tr>
      	<td width="65%" align="left" style="font-weight:bold;">
        	<span  style="color:#1060C8;">USUARIO:</span>&nbsp;<?php echo $_SESSION['usuario']; ?>
        </td>
  </tr>-->
    	<tr>
            <td  align="center" width="65%" style="font-weight:bold;" > Centros de Encuentro para la
            Educación y el Trabajo (CEET) 
            </td>
     	</tr>
    </table>
    <?php
		}
		?>
    </div>
    <div id="contenido_menu">
			<?php 
				include("../menu.php");
				
				//_injection

      ?>
    </div>
    <div id="contenido" >
		
<?
ini_set("display_errors",1);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../../include/header.php');
include("LoadCombos.php");
$settings['debug']=true;  
$conn= getConnDB($db4);
$conn->debug = $settings['debug'];
//----------------------------------
$aPageErrors = array();

$total_asigna					= $_SESSION['montos']['total_asigna'];

		$SQL="SELECT personales.cedula as cedula, 
			personales.nacionalidad, 
			personales.primer_apellido as apellido1, 
			personales.segundo_apellido as apellido2, 
			personales.primer_nombre as nombre1, 
			personales.segundo_nombre as nombre2, 
			personales.fecha_ingreso, 
			recibos_pagos_constancias.constancias_trabajo.fecha_solicitud_const, 
			recibos_pagos_constancias.constancias_trabajo.fecha_caducidad_const, 
			trim(both ' ' from public.tipo_trabajador.sdescripcion as tipo_trabajador, 
			public.ubicacion_administrativa.sdescripcion as ubicacion_adm
			FROM recibos_pagos_constancias.recibo_pago
			INNER JOIN public.personales on personales.cedula = recibo_pago.personales_cedula 
			INNER JOIN recibos_pagos_constancias.constancias_trabajo on constancias_trabajo.personales_cedula =personales.cedula
			INNER JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
			INNER JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
			INNER JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
			INNER JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo  where constancias_trabajo.scodigo_constancia like '%".$_SESSION['txt_codigo_cod']."%' order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1" ;
			$rs=$conn->Execute($SQL);
				$_POST['txt_cedula']						=$rs->fields['cedula'];
				$_POST['nacionalidad']				      =$rs->fields['nacionalidad'];
				$_POST['txt_apellido1']						=$rs->fields['apellido1'];
				$_POST['txt_apellido2']						=$rs->fields['apellido2'];
				$_POST['txt_nombre1']						=$rs->fields['nombre1'];
				$_POST['txt_nombre2']						=$rs->fields['nombre2'];
				$_POST['fecha_ingreso']						=$rs->fields['fecha_ingreso'];
				$_POST['fecha_solicitud_const']				=$rs->fields['fecha_solicitud_const'];
				$_POST['fecha_caducidad_const']				=$rs->fields['fecha_caducidad_const'];				
				$_POST['ubicacion_adm']						=$rs->fields['ubicacion_adm'];
			//	$_POST['tipo_trabajador']					=$rs->fields['tipo_trabajador'];
			
			if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS FIJOS'){
					$_SESSION['figura']  = 'FUNCIONARIO';
			      }

				if($rs_1->fields['tipo_trabajador'] == 'EMPLEADO FIJO ENCARGADURIA'){
			      	$_SESSION['figura']  = 'EMPLEADO';
			      }
				  
			     if($rs_1->fields['tipo_trabajador'] == 'OBREROS SEMANALES'){
					$_SESSION['figura']  = 'OBRERO';
			      }
				  
				 if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS CONTRATADOS'){
			      	$_SESSION['figura']  = 'CONTRATADO';
			      }
				
				if($rs_1->fields['tipo_trabajador'] == 'OBRERO CONTRATADO'){
			      	$_SESSION['figura']  = 'CONTRATADO';
			      }	
					
				if($rs_1->fields['tipo_trabajador'] == 'EMPLEADO JUBILADO'){
			      	$_SESSION['figura']  = 'JUBILADO';
			      }	
				  
				if($rs_1->fields['tipo_trabajador'] == 'OBRERO JUBILADO'){
			      	$_SESSION['figura']  = 'JUBILADO';
			      }	
				  
				 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADO POR INCAPACIDAD-EMPLEADO'){
			      	$_SESSION['figura']  = 'PENSIONADO';
			      }		
				  
				 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADO SOBREVIVIENTE-EMPLEADO-OBRERO'){
			      	$_SESSION['figura']  = 'PENSIONADO';
			      }			
				  
				 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADO POR INCAPACIDAD-OBRERO'){
			      	$_SESSION['figura']  = 'PENSIONADO';
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
</head>
<body>
<form id="consulta_constancia" name="consulta_constancia" method="post">
<script>  

function redirecciona(saction){ 
	if(saction=='regresar'){
		location.href="/minpptrassi/mod_recp_const/mod_consulta_externas/consulta_constancia.php"; 
	}
}
</script>

   <div id="contenedor2">
    <div id="separador_superior"></div>
    <div id="mensaje_ancho"></div>
  
<table class="formulario" width="500" border="0" align="center">
  <tr>
    <th colspan="2" class="titulo" align="center">CERTIFICACI&Oacute;N DE CONSTANCIA ELECTR&Oacute;NICA</th>
  </tr>
  <tr>
     <td height="5" colspan="2" bgcolor="#FBF0D2"></td>
  </tr>
  <tr>
    <th colspan="2" class="titulo" >DETALLE DEL C&Oacute;DIGO DE VERIFICACI&Oacute;N </th>
  </tr>
</table>

<table class="formulario" width="500" border="0" align="center">
  <tr>
    <th width="25%" align="center" class="sub_titulo">C.I.</th>
    <th width="25%" align="center" class="sub_titulo">C&oacute;d. Verificaci&oacute;n</th>
    <th width="25%" align="center" class="sub_titulo">Fecha Solicitud</th>
    <th width="25%" align="center" class="sub_titulo">Fecha Caducidad</th>
  </tr>
  <tr>
    <th style="background-color:#F0F0F0;" align="center"><? if (!(strcmp(1, $_POST['nacionalidad']))) echo "V.- "; else echo "E.-"; echo $_POST['txt_cedula'];?></th>
    <th style="background-color:#F0F0F0;" align="center"><?= $_SESSION['txt_codigo_cod'];?></th>
    <th style="background-color:#F0F0F0;" align="center"><?= strftime("%d/%m/%Y", strtotime($_POST['fecha_solicitud_const']));?></th>
    <th style="background-color:#F0F0F0;" align="center"><?= strftime("%d/%m/%Y", strtotime($_POST['fecha_caducidad_const']));?></th>
  </tr>
</table>
<br />
<table class="formulario" width="500" border="0" align="center">
  <tr class="identificacion_seccion2">
    <td colspan="2" align="center" style="background-color:#FBF0D2;">Verificaci&oacute;n de Datos</td>
    </tr>
  <tr class="identificacion_seccion2">
    <th width="160" class="sub_titulo" align="right">Nombres y Apellidos:</th>
    <td width="340" style="background-color:#F0F0F0;"><?= $_POST['txt_nombre1'].' '.$_POST['txt_nombre2'].' '.$_POST['txt_apellido1'].' '.$_POST['txt_apellido2'];?></td>
  </tr>
<!--  <tr class="identificacion_seccion2">
    <th class="sub_titulo" align="right">C&eacute;dula de Identidad:</th>
    <td style="background-color:#F0F0F0;"><? // $_POST['txt_apellido2'];?></td>
  </tr>-->
  <tr class="identificacion_seccion2">
    <th class="sub_titulo" align="right">Tipo de Trabajador:</th>
    <td style="background-color:#F0F0F0;"><?= trim($_SESSION['figura']);?></td>
  </tr>
  <tr class="identificacion_seccion2">
    <th class="sub_titulo" align="right">Fecha de Ingreso:</th>
    <td style="background-color:#F0F0F0;"><?= strftime("%d/%m/%Y", strtotime($_POST['fecha_ingreso']));?></td>
  </tr>
  <tr class="identificacion_seccion2">
    <th class="sub_titulo" align="right">Ubicaci&oacute;n Administrativa:</th>
    <td style="background-color:#F0F0F0;"><?= $_POST['ubicacion_adm'];?></td>
  </tr>
<!-- <tr class="identificacion_seccion2">
    <th class="sub_titulo" align="right">Total Ingreso Mensual:</th>
    <td style="background-color:#F0F0F0;"><?=$total_asigna?></td>
  </tr>
  <tr class="identificacion_seccion2">
    <th class="sub_titulo" align="right" >Ticket Alimentaci&oacute;n:</th>
    <td style="background-color:#F0F0F0;">&nbsp;</td>
  </tr>-->
</table>

<br /> 

<table class="formulario" width="500" border="0" align="center">
  <tr>
<td colspan="1" align="center">
	<!--	<button type="button" name="btnRegresar"  id="btnRegresar" class="button" onclick="javascript:redirecciona('regresar');" title="Regresar -  Haga Click para Regresar a la Pantalla Principal">REGRESAR<img src="../../imagenes/regresar.png" width="16" height="16" /></button>-->
        <button type="button" class="buttonj btn_regresar" onclick="javascript:redirecciona('regresar');" title="Regresar -  Haga Click para Regresar a la Pantalla Principal">Regresar</button>
    </td>
  </tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>
</div>
</form>
</body>
</html>

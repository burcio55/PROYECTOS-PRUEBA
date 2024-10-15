<?
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../../include/header.php');
include("LoadCombos.php");
$settings['debug']=false;  
$conn= getConnDB($db4);
$conn->debug = $settings['debug'];

$conn2 = &ADONewConnection($target);
//$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh_produccion2');
$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
$conn2->debug = false;

//----------------------------------
$aPageErrors = array();

$total_asigna			= $_SESSION['montos']['total_asigna'];


/*  REVISAR 28112018 CONEXION A SIGEFIRRHHH CASO DE EDUARDO 16863466 --
SELECT personal.id_personal,
	personal.primer_apellido as apellido1,
	personal.segundo_apellido as apellido2,
	personal.primer_nombre as nombre1,
	personal.segundo_nombre as nombre2, 
	personal.nacionalidad,
	personal.cedula as cedula, 
	trabajador.fecha_ingreso,
	recibos_pagos_constancias.constancias_trabajo.fecha_solicitud_const, 
	recibos_pagos_constancias.constancias_trabajo.fecha_caducidad_const, 		
	recibos_pagos_constancias.constancias_trabajo.nmonto,
	recibos_pagos_constancias.constancias_trabajo.tickets_alimentacion_nmonto,
tipopersonal.nombre,
dependencia.nombre as nombre_dep,
trim(both ' ' from tipopersonal.nombre) as tipo_trabajador
FROM trabajador
INNER JOIN personal on personal.id_personal = trabajador.id_personal
INNER JOIN tipopersonal on tipopersonal.cod_tipo_personal = trabajador.cod_tipo_personal
inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
WHERE personal.cedula='16863466'  and estatus='A'

*/





	$SQL="SELECT personales.cedula as cedula, 
personales.nacionalidad, 
personales.primer_apellido as apellido1, 
personales.segundo_apellido as apellido2, 
personales.primer_nombre as nombre1, 
personales.segundo_nombre as nombre2, 
personales.fecha_ingreso, 
recibos_pagos_constancias.constancias_trabajo.fecha_solicitud_const, 
recibos_pagos_constancias.constancias_trabajo.fecha_caducidad_const, 		
recibos_pagos_constancias.constancias_trabajo.nmonto,
recibos_pagos_constancias.constancias_trabajo.tickets_alimentacion_nmonto,
public.tipo_trabajador.sdescripcion as tipo_trabajador, 
public.ubicacion_administrativa.sdescripcion as ubicacion_adm
FROM recibos_pagos_constancias.recibo_pago
INNER JOIN public.personales on personales.cedula = recibo_pago.personales_cedula 
INNER JOIN recibos_pagos_constancias.constancias_trabajo on constancias_trabajo.personales_cedula =personales.cedula	
INNER JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
INNER JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
INNER JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
INNER JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo  
				where constancias_trabajo.scodigo_constancia like '%".$_SESSION['txt_codigo_cod']."%' order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1" ;
			$rs=$conn->Execute($SQL);
				$_POST['txt_cedula']						=$rs->fields['cedula'];
				$_POST['nacionalidad']				        =$rs->fields['nacionalidad'];
				$_POST['txt_apellido1']						=$rs->fields['apellido1'];
				$_POST['txt_apellido2']						=$rs->fields['apellido2'];
				$_POST['txt_nombre1']						=$rs->fields['nombre1'];
				$_POST['txt_nombre2']						=$rs->fields['nombre2'];
				$_POST['fecha_ingreso']						=$rs->fields['fecha_ingreso'];
				$_POST['fecha_solicitud_const']				=$rs->fields['fecha_solicitud_const'];
				$_POST['fecha_caducidad_const']				=$rs->fields['fecha_caducidad_const'];
				$_POST['tipo_trabajador']					=$rs->fields['tipo_trabajador'];
				$_POST['ubicacion_adm']						=$rs->fields['ubicacion_adm'];
				$_POST['ingresos_mensuales']				=$rs->fields['nmonto'];
				$_POST['monto_tickets']						=$rs->fields['tickets_alimentacion_nmonto'];
				

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONSULTAS MPPPST</title>
<!-- <link rel="stylesheet" type="text/css" href="../../css/formularios.css"/>
<link rel="stylesheet" type="text/css" href="../../css/ventana.css"/>
<link rel="stylesheet" type="text/css" href="../../css/botones_IZ.css"/> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="estilos2.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="logo"></div>
        </div>
    </nav>
</header>
<div class="ajustador"></div>
      <form id="consulta_constancia" name="consulta_constancia" method="post">
          <script>  
            function redirecciona(saction){ 
              if(saction=='regresar'){
                  location.href="/minpptrassi/mod_recp_const/mod_consulta_externas/consulta_constancia.php"; 
                }
              }
            </script>
        <div id="contenedor2">
            <table class="formulario" border="0">
                <div class="titulo_principal">
                    <h5>CERTIFICACIÓN DE CONSTANCIA DE TRABAJO</h5>
                </div>
                <!-- <tr>
                  <th colspan="2" class="titulo">DETALLE DEL CÓDIGO DE VERIFICACIÓN</th>
                </tr> -->
                  <td colspan="2"><hr class="separador"></td>
                </tr>
            </table>
            <br>
            <table class="formulario" border="0">
                  <tr>
                    <th class="sub_titulo">C.I.</th>
                    <th class="sub_titulo">Cód. Verificación</th>
                    <th class="sub_titulo">Fecha Solicitud</th>
                    <th class="sub_titulo">Fecha Caducidad</th>
                  </tr>
                  <tr class="borde-solido">
    <td><? if (!(strcmp(1, $_POST['nacionalidad']))) echo "V.- "; else echo "E.-"; echo number_format( $_POST['txt_cedula'], 0, '', '.');?></td>
    <td><?= $_SESSION['txt_codigo_cod'];?></td>
    <td><?= strftime("%d/%m/%Y", strtotime($_POST['fecha_solicitud_const']));?></td>
    <td><?= strftime("%d/%m/%Y", strtotime($_POST['fecha_caducidad_const']));?></td>
</tr>
            </table>
            <br/>
            <table class="formulario" border="0" style="margin-top: 10px;">
                <tr class="identificacion_seccion2_primary">
                  <td colspan="2">Verificación de Datos</td>
                  <td colspan="2"><hr class="separador"></td>
                </tr>
                <td colspan="2"><hr class="separador"></td>
                <tr class="identificacion_seccion2">
                  <th class="sub_titulo" align="left" style="padding: 1px 9px;">Nombres y Apellidos:</th>
                  <td><?= $_POST['txt_nombre1'].' '.$_POST['txt_nombre2'].' '.$_POST['txt_apellido1'].' '.$_POST['txt_apellido2'];?></td>
                </tr>
                <tr class="identificacion_seccion2">
                  <th class="sub_titulo" align="left" style="padding: 1px 9px;">Tipo de Trabajador:</th>
                  <td><?= $_POST['tipo_trabajador'];?></td>
                </tr>
                <tr class="identificacion_seccion2">
                  <th class="sub_titulo" align="left" style="padding: 1px 9px;">Fecha de Ingreso:</th>
                  <td><?= strftime("%d/%m/%Y", strtotime($_POST['fecha_ingreso']));?></td>
                </tr>
                <tr class="identificacion_seccion2">
                  <th class="sub_titulo" align="left" style="padding: 1px 9px;">Ubicación Administrativa:</th>
                  <td><?= $_POST['ubicacion_adm'];?></td>
                </tr>
                <tr class="identificacion_seccion2">
                    <th class="sub_titulo" align="left" style="padding: 1px 9px;">Total Ingreso Mensual:</th>
                    <td><?=number_format($_POST['ingresos_mensuales'], 2, ',', '.')?></td>
                </tr>
                <tr class="identificacion_seccion2">
                  <th class="sub_titulo" align="left" style="padding: 1px 9px;">Ticket Alimentación:</th>
                  <td><?=number_format($_POST['monto_tickets'], 2, ',', '.')?></td>
                </tr>
            </table>
            <br/>
            <table class="formulario" border="0">
              <tr>
                <td align="center">
                  <button type="button" class="buttonj btn_regresar" onclick="javascript:redirecciona('regresar');" title="Regresar - Haga Click para Regresar a la Pantalla Principal">Regresar</button>
                </td>
              </tr>
            </table>
            <div id="loader" class="loaders" style="display: none;"></div>
        </div>
      </form>
</div>
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
</body>
</html>

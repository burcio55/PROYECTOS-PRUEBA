<?php
/*include('include/adodb/adodb.inc.php');
$conn = &ADONewConnection("postgres");
$conn->PConnect("10.46.1.91","jpalacios","03198611","sigefirrhh");
$conn->debug = true;
*/
$conexion->debug = true;
//$conexion = pg_pconnect("host=servidor.domain.es port=5432 dbname=prueba");
//$dbm= pg_connect('10.46.1.91','areadesarrollo','areadesarrollopasswd');
//$dbm=pg_connect("host=10.46.1.91 port=5432 dbname=mary");
//pg_select_db('sigefirrhh',$dbm);

ini_set('max_execution_time','3000000000');


if(isset($_POST['action']))
{

    if($_POST['usuario']=="")
    {
            $aErrors[] = "- El Usuario: Es requerida.";
            $valido=false;
    }
    if($_POST['db']=="")
    {
            $aErrors[] = "- La Base de Datos: Es requerido.";
            $valido=false;
    }
    if($_POST['host']=="")
    {
            $aErrors[] = "- El Host: Es requerido.";
            $valido=false;
    }
    if($_POST['password']=="")
    {
            $aErrors[] = "- El Password: Es requerido.";
            $valido=false;
    }
    if($_POST['anio']=="")
    {
            $aErrors[] = "- El Año: Es requerido.";
            $valido=false;
    }
    if($_POST['mes']=="0")
    {
            $aErrors[] = "- El Mes: Es requerido.";
            $valido=false;
    }


    $usuario= $_POST['usuario'];
    $db= $_POST['db'];
    $host= $_POST['host'];
    $password= $_POST['password'];
    $anio= $_POST['anio'];
    $mes= $_POST['mes'];
    $quincena= $_POST['quincena'];
    $semana= $_POST['semana'];
    $fecha_carga= date("Y-m-d H:i:s");
    print $fecha_carga;
	
$conexion = pg_connect("user=$usuario dbname=$db host=$host password=$password");


if(isset($_POST['quincena']) <> 0)
{

	  $sql= "select trabajador.cedula, trabajador.cod_tipo_personal, trabajador.estatus, trabajador.forma_pago,trabajador.cuenta_nomina, trabajador.codigo_nomina,
	  		personal.primer_apellido, personal.primer_nombre,trabajador.sueldo_basico, dependencia.nombre, cargo.descripcion_cargo,
			historicoquincena.mes, historicoquincena.semana_quincena,historicoquincena.id_concepto_tipo_personal,concepto.cod_concepto,
	        historicoquincena.numero_nomina,concepto.descripcion,historicoquincena.monto_asigna,historicoquincena.monto_deduce,
            tipopersonal.nombre as tipopersonal,trabajador.cod_tipo_personal as cod_tipo_trabajador,dependencia.cod_dependencia as cod_ubicacion_adm,
            trabajador.id_cargo as id_cargo
			from historicoquincena
			inner join trabajador on historicoquincena.id_trabajador= trabajador.id_trabajador
			inner join personal on trabajador.id_personal= personal.id_personal
			inner join dependencia on trabajador.id_dependencia= dependencia.id_dependencia
			inner join cargo on trabajador.id_cargo= cargo.id_cargo
			inner join conceptotipopersonal on trabajador.id_tipo_personal= conceptotipopersonal.id_tipo_personal
			inner join tipopersonal on trabajador.id_tipo_personal= tipopersonal.id_tipo_personal
			inner join concepto on conceptotipopersonal.id_concepto= concepto.id_concepto
			where historicoquincena.id_trabajador = trabajador.id_trabajador  and historicoquincena.anio = '".$anio."' and  historicoquincena.mes ='".$mes."'
			and  historicoquincena.semana_quincena = '".$quincena."'
			and trabajador.id_dependencia = dependencia.id_dependencia and trabajador.id_cargo = cargo.id_cargo
			and historicoquincena.id_concepto_tipo_personal = conceptotipopersonal.id_concepto_tipo_personal
			and concepto.id_concepto = conceptotipopersonal.id_concepto
			and  personal.id_personal = trabajador.id_personal
			order by  concepto.cod_concepto";
			
/*    $sql= "select trabajador.cedula, trabajador.cod_tipo_personal, trabajador.estatus, trabajador.forma_pago,trabajador.cuenta_nomina,
            personal.primer_apellido, personal.primer_nombre,trabajador.sueldo_basico, dependencia.nombre, cargo.descripcion_cargo,
            historicoquincena.mes, historicoquincena.semana_quincena,historicoquincena.id_concepto_tipo_personal,concepto.cod_concepto,
            concepto.descripcion,historicoquincena.monto_asigna,historicoquincena.monto_deduce,tipopersonal.nombre as tipopersonal
            from historicoquincena, personal, trabajador, concepto, conceptotipopersonal, dependencia, cargo,tipopersonal
            where historicoquincena.id_trabajador = trabajador.id_trabajador  and historicoquincena.anio = '".$anio."' and  historicoquincena.mes ='".$mes."'
            and  historicoquincena.semana_quincena = '".$quincena."'
            and trabajador.id_dependencia = dependencia.id_dependencia and trabajador.id_cargo = cargo.id_cargo
            and historicoquincena.id_concepto_tipo_personal = conceptotipopersonal.id_concepto_tipo_personal
            and concepto.id_concepto = conceptotipopersonal.id_concepto
            and  personal.id_personal = trabajador.id_personal
            order by  concepto.cod_concepto limit 3";*/
}
/*
if(!$_POST['semana']=0)
{
    $sql= "select trabajador.cedula,trabajador.cod_tipo_personal, trabajador.estatus, trabajador.forma_pago, trabajador.cuenta_nomina,personal.primer_apellido, 
			personal.primer_nombre,trabajador.sueldo_basico, dependencia.nombre, cargo.descripcion_cargo,historicosemana.mes, historicosemana.semana_quincena,
			historicosemana.id_concepto_tipo_personal,concepto.cod_concepto,concepto.descripcion,historicosemana.monto_asigna,historicosemana.monto_deduce,
			tipopersonal.nombre as tipopersonal
            from historicosemana, personal, trabajador, concepto, conceptotipopersonal, dependencia, cargo, tipopersonal
            where historicosemana.id_trabajador = trabajador.id_trabajador  and historicosemana.anio = '".$anio."'  and  historicosemana.mes ='".$mes."'
            and  historicosemana.semana_quincena = '".$semana."'
            and trabajador.id_dependencia = dependencia.id_dependencia and trabajador.id_cargo = cargo.id_cargo
            and historicosemana.id_concepto_tipo_personal = conceptotipopersonal.id_concepto_tipo_personal
            and concepto.id_concepto = conceptotipopersonal.id_concepto
            and  personal.id_personal = trabajador.id_personal
            order by  concepto.cod_concepto limit 3";
}
*/
$resultado_set = pg_Exec ($conexion, $sql);

$filas = pg_NumRows($resultado_set);
for ($j=0; $j < $filas; $j++) {

   $cedula= pg_result($resultado_set, $j, 0);
   $cod_tipo_personal= pg_result($resultado_set, $j, 1);
   $estatus= pg_result($resultado_set, $j, 2);
   $forma_pago= pg_result($resultado_set, $j, 3);
   $cuenta_nomina= pg_result($resultado_set, $j, 4);
   $cod_nomina=pg_result($resultado_set, $j, 5);
   $primer_apellido= pg_result($resultado_set, $j, 6);
   $primer_nombre= pg_result($resultado_set, $j, 7);
   $sueldo_basico= pg_result($resultado_set, $j, 8);
   $nombre= pg_result($resultado_set, $j, 9);
   $descripcion_cargo= pg_result($resultado_set, $j, 10);
   $mes= pg_result($resultado_set, $j, 11);
   $semana_quincena= pg_result($resultado_set, $j, 12);
   $id_concepto_tipo_personal= pg_result($resultado_set, $j, 13);
   $cod_concepto= pg_result($resultado_set, $j, 14);
   $nro_nomina=pg_result($resultado_set, $j, 15);
   $descripcion= pg_result($resultado_set, $j, 16);
   $monto_asigna= pg_result($resultado_set, $j, 17);
   $monto_deduce= pg_result($resultado_set, $j, 18);
   $tipopersonal= pg_result($resultado_set, $j, 19);
   $cod_tipo_trabajador= pg_result($resultado_set, $j, 20);
   $cod_ubicacion_adm= pg_result($resultado_set, $j, 21);
   $id_cargo= pg_result($resultado_set, $j, 22);


$conexion1 = pg_connect("user=jpalacios dbname=recibos_pagos host=10.46.1.23 password='12345'");
  $sql1="INSERT INTO recibos_pagos(cedula,cod_tipo_personal,estatus,forma_pago,cuenta_nomina,primer_apellido, primer_nombre,sueldo_basico, nombre,descripcion_cargo,mes, semana_quincena, id_concepto_tipo_personal, cod_concepto,descripcion, monto_asigna, monto_deduce,tipo_personal,anio,fecha_carga,cod_nom,
   nro_nomina,cod_tipo_trabajador, cod_ubicacion_adm,id_cargo)
   VALUES ('".$cedula."','".$cod_tipo_personal."','".$estatus."','".$forma_pago."','".$cuenta_nomina."','".$primer_apellido."','".$primer_nombre."','".$sueldo_basico."','".$nombre."','".$descripcion_cargo."','".$mes."','".$semana_quincena."','".$id_concepto_tipo_personal."','".$cod_concepto."','".$descripcion."','".$monto_asigna."','".$monto_deduce."','".$tipopersonal."', '".$anio."', '".$fecha_carga."','".$cod_nomina."','".$nro_nomina."','".$cod_tipo_trabajador."','".$cod_ubicacion_adm."','".$id_cargo."')";
		 
$resultado_set1 = pg_Exec ($conexion1, $sql1);
$filas1 = pg_NumRows($resultado_set1);

pg_close($conexion1);



print $cedula."<br>";


}
pg_close($conexion);
}else{
     if (isset($aErrors) && count($aErrors) > 0)
 print "<script>alert('".join('\n',$aErrors)."')</script>";

}

?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<style>
        body {
	FONT-WEIGHT: normal;
	FONT-SIZE: 10px! important;
	MARGIN: 8px 0px 5px;
	FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif! important;
	BACKGROUND-COLOR: #ffffff;
        }
        .texto-normal {
                PADDING-RIGHT: 8px! important; PADDING-LEFT: 8px! important; FONT-WEIGHT: normal; FONT-SIZE: 10px! important; PADDING-BOTTOM: 4px! important; COLOR: #4b4b4b; PADDING-TOP: 4px! important; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif! important; TEXT-ALIGN: justify! important; TEXT-DECORATION: none
        }
        .button {
                border: 1px solid #000066;
                background: #1060c8;
                color: #FFFFFF;
                font-size: 10px;
                font-family: Verdana, Arial, Helvetica, sans-serif;
        }
        .titular {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 12px;
                color: #FFFFFF;
                background-color: #1060c8;
        }
 </style>
<body>

<form name="form" method="post" action="recibos_pago_empleados.php" >
<script>
    function send(saction){
            var form = document.form;
            form.action.value=saction;
            form.submit()
    }
</script>
        <input name="action" type="hidden" value=""/>
        <table cellspacing=0 cellpadding=2 width="75%" align=center border=0>
            <tr>
                <td><img  align="center" src="http://10.46.1.45/gestion/images/banner_solvencia_b.gif"></td>
            </tr>
        </table>
        <table cellspacing=0 cellpadding=2 width="100%" align=center border=1>
       <tr>
           <td colspan="2" class="titular" align="center">Generar Nomina para recibos de Empleados </td>
       </tr>
       <tr>
            <td class="texto-normal" align="right" width="21%">Nombre de Usuario:</td>
            <td class="texto-normal" align="right" width="79%">
                <INPUT name="usuario" type="text" id="usuario" value="postgres">         </td>
        </tr>
       <tr>
            <td class="texto-normal" align="right" width="21%">
                Base de Dato:            </td>
            <td class="texto-normal" align="right" width="79%">
                <INPUT name="db" type="text" id="db" value="sigefirrhh">         </td>
        </tr>
       <tr>
            <td class="texto-normal" align="right" width="21%">
                Host:            </td>
            <td class="texto-normal" align="right" width="79%">
                <INPUT  name="host" type="text" id="host" value="10.46.1.9">         </td>
        </tr>
       <tr>
            <td class="texto-normal" align="right" width="21%">
                Password:            </td>
            <td class="texto-normal" align="right" width="79%">
                <INPUT type="text"  name="password" id="password">         </td>
        </tr>
       <tr>
            <td class="texto-normal" align="right" width="21%">
                A&ntilde;o:            </td>
            <td class="texto-normal" align="right" width="79%">
                <INPUT type="text"  name="anio" id="anio">         </td>
        </tr>
       <tr>
            <td class="texto-normal" align="right" width="21%">
                <LABEL for="mes">Mes: </LABEL>         </td >
            <td class="texto-normal" align="right" width="79%">
				<select name="mes" id="mes">
					<option value="0">Selecciona una opcion</option>
					<option value="1">Enero</option>
					<option value="2">Febrero</option>
					<option value="3">Marzo</option>
					<option value="4">Abril</option>
					<option value="5">Mayo</option>
					<option value="6">Junio</option>
					<option value="7">Julio</option>
					<option value="8">Agosto</option>
					<option value="9">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				 </select>			 </td>
        </tr><tr>
            <td class="texto-normal" align="right" width="21%">
                Quincena:			</td>
            <td class="texto-normal" align="right" width="79%">
				<select name="quincena" id="quincena">
					<option value="0">Selecciona una opcion</option>
					<option value="1">Primera Quincena</option>
					<option value="2">Segunda Quincena</option>
				</select>			</td>
        </tr>
        <tr>
            <td colspan="2" class="texto-normal"  align="right"><input  align="center" type="button" class="button" name="Generar" value="Generar" onClick="send('btnAceptar')"/>			</td>
        </tr>
  </table>
</form>

<?
 if (isset($aErrors) && count($aErrors) > 0)
 print "<script>alert('".join('\n',$aErrors)."')</script>";
?>

</body>
</html>

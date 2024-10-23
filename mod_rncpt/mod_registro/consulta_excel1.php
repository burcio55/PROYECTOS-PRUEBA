<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
ini_set('max_execution_time', 300); 
error_reporting(E_ALL | E_STRICT);
include('../../include/header.php');
$conn= getConnDB($db1);
$conn->debug =false;
 
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=REPORTE.xls");

//$SQL1="SELECT empresa.id, srazon_social, srif, entidad.sdescripcion as estado
//FROM scpt.empresa
//LEFT JOIN public.entidad ON public.entidad.nentidad=empresa.entidad_nentidad
//WHERE empresa.nenabled='1' ".$condicion." ".$condicion1." ORDER BY estado";

$SQL1="SELECT
rncpt.empresa.id,
rncpt.empresa.srazon_social,
rncpt.empresa.sdenominacion_comercial,
rncpt.empresa.srif,
rncpt.empresa.nro_boleta,
CASE 
WHEN rncpt.empresa.tipo_registro='1' THEN 'Público' 
WHEN rncpt.empresa.tipo_registro='2' THEN 'Privado' 
ELSE 'Mixto' END AS tipo_registro,
entidad.sdescripcion AS estado,
rncpt.motor.sdescripcion AS motor,
rncpt.empresa.dfecha_creacion,
rncpt.empresa.dfecha_actualizacion
FROM
rncpt.empresa
Left Join public.entidad ON public.entidad.nentidad = rncpt.empresa.entidad_nentidad
Inner Join rncpt.empresa_motor ON rncpt.empresa.id = rncpt.empresa_motor.empresa_id
Inner Join rncpt.motor ON rncpt.empresa_motor.motor_id = rncpt.motor.id
WHERE rncpt.empresa.nenabled='1' ".$condicion." ".$condicion1." ORDER BY estado";

$rs1=$conn->Execute($SQL1);								
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <thead>
<!--  <tr>
  	<th colspan="6" class="">REGISTRO NACIONAL DE CONSEJOS PRODUCTIVOS DE TRABAJADORES (RNCPT)</th>
  </tr>-->
  <tr>
  	<th colspan="6" class="">CONSULTA GENERAL DE CONSEJOS PRODUCTIVOS DE TRABAJADORAS Y TRABAJADORES REGISTRADOS EN EL RNCPTT</th>
  </tr>
   <tr>
       <td>&nbsp;</td>		
  </tr>
   <tr align="left" >
      <th width="10%">RIF</th>
      <th width="10%">NRO. BOLETA CPT</th>
      <th width="20%">RAZON SOCIAL</th>
      <th width="20%">DENOMINACION COMERCIAL</th>
      <th width="15%">ESTADO</th>
      <th width="15%">MOTOR</th>
      <th width="15%">SECTOR</th>
      <!--<th width="15%">PRODUCTO</th>
      <th width="15%">ACTIVIDAD ECONOMICA</th>-->
      <th width="15%">FECHA DE REGISTRO</th>
      <th width="15%">FECHA DE ACTUALIZACION</th>
      <th width="65%">VOCEROS DEL CPTT</th>
    </tr>
       <tr>
       <td>&nbsp;</td>		
  </tr>
  </thead>
<tbody>
<?
while (!$rs1->EOF ){
															
/*$SQL2= "SELECT miembros_empresa.id, 
		miembros.ncedula,
		miembros.sprimer_nombre,
		miembros.sprimer_apellido,
		CASE WHEN miembros.nsexo='1' THEN 'M' ELSE 'F' END AS sexo,
		miembros.stelefono1,
		CASE WHEN miembros.miliciano='1' THEN 'Si' ELSE 'No' END AS miliciano,
		tipo_comite.sdescripcion as tipo
	FROM scpt.miembros_empresa
	INNER JOIN scpt.miembros ON miembros.id = miembros_empresa.miembros_id
	INNER JOIN scpt.tipo_comite ON miembros_empresa.tipo_comite_id = tipo_comite.id
	WHERE miembros_empresa.empresa_id='".$rs1->fields['id']."' 
	AND miembros_empresa.nenabled='1'";
$rs2=$conn->Execute($SQL2);		*/

															
$SQL2= "SELECT miembros_empresa.id, 
miembros.ncedula,
miembros.sprimer_nombre,
miembros.ssegundo_nombre,
miembros.sprimer_nombre,
miembros.ssegundo_apellido,
CASE WHEN miembros.nsexo='1' THEN 'M' ELSE 'F' END AS sexo,
miembros.stelefono1,
miembros.stelefono2,
rncpt.condicion_act.sdescripcion as condicion_act,
rncpt.condicion_laboral.sdescripcion as condicion_laboral,
miembros.semail
FROM rncpt.miembros_empresa
INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
inner join rncpt.condicion_act on rncpt.miembros_empresa.condicion_act_id = rncpt.condicion_act.id
inner join rncpt.condicion_laboral on rncpt.miembros_empresa.condicion_laboral_id = rncpt.condicion_laboral.id
	WHERE miembros_empresa.empresa_id='".$rs1->fields['id']."' 
	AND miembros_empresa.nenabled='1'";
$rs2=$conn->Execute($SQL2);		

											
$tabla1='';	
$tabla1.='<table id="" align="center" style="width:100%; ">
<thead>
<tr>
<th width="10%">C.I.</th>
<th width="10%">Primer Apellido</th>
<th width="10%">Segundo Apellido</th>
<th width="10%">Primer Nombre</th>
<th width="10%">Segundo Nombre</th>
<th width="8%">Sexo</th>
<th width="12%">Tel&eacute;fono Personal</th>
<th width="10%">Tel&eacute;fono de Habitaci&oacute;n</th>
<th width="8%">Condici&oacute;n Actual</th>
<th width="10%">Condici&oacute;n Laboral</th>
<th width="12%">Correo Electr&oacute;nico</th>
</tr>
<tbody>';
while (!$rs2->EOF ){ 
$tabla1.='<tr align="center" >
<td>'.$rs2->fields['ncedula'].'</td>
<td>'.strtoupper($rs2->fields['sprimer_apellido']).'</td>
<td>'.strtoupper($rs2->fields['ssegundo_apellido']).'</td>
<td>'.strtoupper($rs2->fields['sprimer_nombre']).'</td>
<td>'.strtoupper($rs2->fields['ssegundo_nombre']).'</td>
<td>'.strtoupper($rs2->fields['sexo']).'</td>
<td>'.$rs2->fields['stelefono1'].'</td>
<td>'.$rs2->fields['stelefono2'].'</td>
<td>'.$rs2->fields['condicion_act'].'</td>
<td>'.$rs2->fields['condicion_laboral'].'</td>
<td>'.strtoupper($rs2->fields['semail']).'</td>
</tr>';
$rs2->MoveNext();									
}
$tabla1.='
</tbody>
</thead>
</table>';
?>
<tr align='center'>
<td><?=$rs1->fields['srif']?></td>
<td align="left" ><?=strtoupper($rs1->fields['nro_boleta'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['srazon_social'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['sdenominacion_comercial'])?></td>
<td align="center" ><?=strtoupper($rs1->fields['estado'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['motor'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['tipo_registro'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['dfecha_creacion'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['dfecha_actualizacion'])?></td>

<td align="left" ><?=$tabla1?></td>
</tr>		
<? $rs1->MoveNext(); }?>													
</tbody>
</table>


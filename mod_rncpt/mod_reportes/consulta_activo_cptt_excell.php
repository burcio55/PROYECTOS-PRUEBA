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

header("content-disposition: attachment;filename=CPTT_ACTIVOS.xls");

echo $_SESSION['aDefaults'];
//$SQL1="SELECT empresa.id, srazon_social, srif, entidad.sdescripcion as estado
//FROM scpt.empresa
//LEFT JOIN public.entidad ON public.entidad.nentidad=empresa.entidad_nentidad
//WHERE empresa.nenabled='1' ".$condicion." ".$condicion1." ORDER BY estado";

/*$SQL1="SELECT
rncpt.empresa.id,
rncpt.empresa.nro_boleta,
rncpt.empresa.srif,
rncpt.empresa.srazon_social,
rncpt.empresa.sdenominacion_comercial,
rncpt.empresa.sdireccion_fiscal,
rncpt.empresa.sucursales,
region.sdescripcion as region,
entidad.sdescripcion AS estado,
municipio.sdescripcion as municipio,
parroquia.sdescripcion as parroquia,
CASE 
WHEN rncpt.empresa.tipo_registro='1' THEN 'Público' 
WHEN rncpt.empresa.tipo_registro='2' THEN 'Privado' 
ELSE 'Mixto' END AS tipo_registro,
rncpt.motor.sdescripcion AS motor,
rncpt.empresa.sdecripcion_aporte AS aporte,
rncpt.empresa.sdescripcion_inventiva AS inventiva,
rncpt.empresa.srequisitos_inventiva AS requisitos,
rncpt.empresa.dfecha_creacion,
rncpt.empresa.dfecha_actualizacion
FROM
rncpt.empresa
LEFT JOIN public.region ON public.region.id=rncpt.empresa.region_id
LEFT JOIN public.entidad ON public.entidad.nentidad=rncpt.empresa.entidad_nentidad
LEFT JOIN public.municipio ON public.municipio.nmunicipio=rncpt.empresa.municipio_nmunicipio
LEFT JOIN public.parroquia ON public.parroquia.nparroquia=rncpt.empresa.parroquia_nparroquia
Inner Join rncpt.empresa_motor ON rncpt.empresa.id = rncpt.empresa_motor.empresa_id
Inner Join rncpt.motor ON rncpt.empresa_motor.motor_id = rncpt.motor.id
WHERE rncpt.empresa.nenabled='1' ".$condicion." ".$condicion1." ORDER BY estado";

$rs1=$conn->Execute($SQL1);								
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <thead>
  <tr>
  	<th colspan="10" class="">CONSULTA GENERAL DE CONSEJOS PRODUCTIVOS DE TRABAJADORAS Y TRABAJADORES REGISTRADOS EN EL RNCPTT</th>
  </tr>
   <tr>
       <td>&nbsp;</td>		
  </tr>
   <tr align="left" >
      <th width="3%">NRO. BOLETA</th>
      <th width="3%">RIF</th>      
      <th width="4%" align="left" >RAZON SOCIAL</th>
      <th width="4%" align="left" >DENOMINACION COMERCIAL</th>
      <th width="5%" align="left" >DIRECCION FISCAL</th>
      <th width="5%" align="left" >SUCURSALES</th>
      <th width="5%" align="left" >REDI</th>
      <th width="3%">ESTADO</th>
      <th width="3%">MUNICIPIO</th>
      <th width="3%">PARROQUIA</th>
      <th width="3%">SECTOR</th>
      <th width="2%">MOTOR</th>
      <th width="3%" align="left">APORTE</th>
      <th width="3%" align="left">INVENTIVA</th>
      <th width="3%" align="left">REQUISITOS</th>    
      <th width="2%">FECHA DE CONSTITUCION</th>
      <th width="2%">FECHA DE VENCIMIENTO</th>
      <th width="2%">FECHA DE ACTUALIZACION</th>
	  <th width="2%">N&deg; DE VOTOS EL CUAL FUE ELECTO</th>
	  <th width="2%">TOTAL DE TRABAJADORES DE LA ENTIDAD DE TRABAJO</th>
	  <th width="2%">FECHA DE LA NUEVA ELECCION</th>
      <th width="3%">C.I. del Vocero</th>
      <th width="4%">Primer Nombre</th>
      <th width="3%">Segundo Nombre</th>
      <th width="3%">Primer Apellido</th>
      <th width="3%">Segundo Apellido</th>
      <th width="3%">Sexo</th>
	  <th width="3%">Fecha Nacimiento</th>
      <th width="3%">Edad</th>
      <th width="3%">Tel&eacute;f. Personal</th>
      <th width="3%">Tel&eacute;f. de Habitaci&oacute;n</th>
      <th width="5%" align="left">Correo Electr&oacute;nico</th>
      <th width="3%">Condici&oacute;n Actual</th>
	    <th width="3%">Condici&oacute;n Laboral</th>
      <th width="3%" align="left">Cargo</th>
    </tr>
       <tr>
       <td>&nbsp;</td>		
  </tr>
  </thead>
<tbody>
<?
while (!$rs1->EOF ){
															
$SQL2= "SELECT miembros_empresa.id, 
miembros.ncedula,
miembros.sprimer_nombre,
miembros.ssegundo_nombre,
miembros.sprimer_apellido,
miembros.ssegundo_apellido,
CASE WHEN miembros.nsexo='1' THEN 'M' ELSE 'F' END AS sexo,
miembros.fecha_nacimiento,
extract (YEAR FROM (age(miembros.fecha_nacimiento)))::integer as edad,
miembros.stelefono1,
miembros.stelefono2,
rncpt.condicion_act.sdescripcion as condicion_act,
rncpt.condicion_laboral.sdescripcion as condicion_laboral,
rncpt.cargos.descripcion_cargo as cargo,
rncpt.miembros_empresa.dfecha_const_comite,
rncpt.miembros_empresa.dfecha_vencimiento,
rncpt.miembros_empresa.nro_votos,
rncpt.miembros_empresa.total_trabajadores,
rncpt.miembros_empresa.dfecha_nueva_eleccion,
miembros.semail
FROM rncpt.miembros_empresa
INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
INNER JOIN rncpt.cargos ON rncpt.cargos.id = miembros_empresa.cargos_id
inner join rncpt.condicion_act on rncpt.miembros_empresa.condicion_act_id = rncpt.condicion_act.id
inner join rncpt.condicion_laboral on rncpt.miembros_empresa.condicion_laboral_id = rncpt.condicion_laboral.id
	WHERE miembros_empresa.empresa_id='".$rs1->fields['id']."' 
	AND miembros_empresa.nenabled='1'";
$rs2=$conn->Execute($SQL2);		

while (!$rs2->EOF ){ 

?>
<tr align='center'>
<td align="left" ><?=strtoupper($rs1->fields['nro_boleta'])?></td>
<td><?=$rs1->fields['srif']?></td>
<td align="left" ><?=strtoupper($rs1->fields['srazon_social'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['sdenominacion_comercial'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['sdireccion_fiscal'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['sucursales'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['region'])?></td>
<td align="left"><?=strtoupper($rs1->fields['estado'])?></td>
<td align="left"><?=strtoupper($rs1->fields['municipio'])?></td>
<td align="left"><?=strtoupper($rs1->fields['parroquia'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['tipo_registro'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['motor'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['aporte'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['inventiva'])?></td>
<td align="left" ><?=strtoupper($rs1->fields['requisitos'])?></td>
<td align="center" ><?=strtoupper($rs2->fields['dfecha_const_comite'])?></td>
<td align="center" ><?=strtoupper($rs2->fields['dfecha_vencimiento'])?></td>
<td align="center" ><?=date("d/m/Y", strtotime($rs1->fields['dfecha_actualizacion']))?></td>
<td align="center" ><?=strtoupper($rs2->fields['nro_votos'])?></td>
<td align="center" ><?=strtoupper($rs2->fields['total_trabajadores'])?></td>
<td align="center" ><?=strtoupper($rs2->fields['dfecha_nueva_eleccion'])?></td>
<td><?=$rs2->fields['ncedula']?></td>
<td align="left" ><?=strtoupper($rs2->fields['sprimer_nombre'])?></td>
<td align="left" ><?=strtoupper($rs2->fields['ssegundo_nombre'])?></td>
<td align="left" ><?=strtoupper($rs2->fields['sprimer_apellido'])?></td>
<td align="left" ><?=strtoupper($rs2->fields['ssegundo_apellido'])?></td>
<td align="center" ><?=strtoupper($rs2->fields['sexo'])?></td>
<td align="center" ><?=strtoupper($rs2->fields['fecha_nacimiento'])?></td>
<td align="center" ><?=strtoupper($rs2->fields['edad'])?></td>
<td align="center" ><?=$rs2->fields['stelefono1']?></td>
<td align="center" ><?=$rs2->fields['stelefono2']?></td>
<td align="left" ><?=strtoupper($rs2->fields['semail'])?></td>
<td align="center" ><?=$rs2->fields['condicion_act']?></td>
<td align="center" ><?=$rs2->fields['condicion_laboral']?></td>
<td align="left" ><?=$rs2->fields['cargo']?></td>
</tr>		
  <? $rs2->MoveNext();
}               
$rs1->MoveNext(); }?> 											
</tbody>
</table>*/


<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
ini_set('max_execution_time', 300); 
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug =false;
 
header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=REPORTE.xls");

$SQL1="SELECT empresa.id, srazon_social, srif, entidad.sdescripcion as estado
FROM scpt.empresa
LEFT JOIN public.entidad ON public.entidad.nentidad=empresa.entidad_nentidad
WHERE empresa.nenabled='1' ".$condicion." ".$condicion1." ORDER BY estado";
$rs1=$conn->Execute($SQL1);								
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <thead>
  <tr>
  	<th colspan="4" class="">SISTEMA CONSEJO PRODUCTIVO DE TRABAJADORES</th>
  </tr>
  <tr>
  	<th colspan="4" class="">REPORTE DE LAS EMPRESAS POR ESTADO</th>
  </tr>
    <tr align="center">
      <th width="10%">RIF</th>
      <th width="15%">NOMBRE DE LA EMPRESA</th>
      <th width="15%">ESTADO</th>
      <th width="60%">MIEMBROS DE NUCLEOS DE TRABAJADORES</th>
    </tr>
  </thead>
<tbody>
<?
while (!$rs1->EOF ){
															
$SQL2= "SELECT miembros_empresa.id, 
		miembros.ncedula,
		miembros.sprimer_nombre,
		miembros.sprimer_apellido,
		CASE WHEN miembros.nsexo='1' THEN 'M' ELSE 'F' END AS sexo,
		miembros.stelefono1,
		miembros.stelefono2,
		tipo_comite.sdescripcion as tipo
	FROM scpt.miembros_empresa
	INNER JOIN scpt.miembros ON miembros.id = miembros_empresa.miembros_id
	INNER JOIN scpt.tipo_comite ON miembros_empresa.tipo_comite_id = tipo_comite.id
	WHERE miembros_empresa.empresa_id='".$rs1->fields['id']."' 
	AND miembros_empresa.nenabled='1'";
$rs2=$conn->Execute($SQL2);		
											
$tabla1='';	
$tabla1.='<table id="" align="center" style="width:100%; ">
<thead>
<tr>
<th width="10%">CI</th>
<th width="20%">Apellido</th>
<th width="20%">Nombre</th>
<th width="8%">Sexo</th>
<th width="12%">Telefono 1</th>
<th width="12%">Telefono 2</th>
<th width="18%">Tipo de Trabajador</th>
</tr>
<tbody>';
while (!$rs2->EOF ){ 
$tabla1.='<tr align="center" >
<td>'.$rs2->fields['ncedula'].'</td>
<td>'.strtoupper($rs2->fields['sprimer_apellido']).'</td>
<td>'.strtoupper($rs2->fields['sprimer_nombre']).'</td>
<td>'.strtoupper($rs2->fields['sexo']).'</td>
<td>'.$rs2->fields['stelefono1'].'</td>
<td>'.$rs2->fields['stelefono2'].'</td>
<td>'.strtoupper($rs2->fields['tipo']).'</td>
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
<td><?=strtoupper($rs1->fields['srazon_social'])?></td>
<td><?=strtoupper($rs1->fields['estado'])?></td>
<td><?=$tabla1?></td>
</tr>		
<? $rs1->MoveNext(); }?>													
</tbody>
</table>


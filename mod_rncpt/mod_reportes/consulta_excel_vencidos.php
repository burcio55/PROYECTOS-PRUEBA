<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1 " />
<head>
<?php
//----------------------------------------
session_start();
ini_set("display_errors",1);
ini_set('max_execution_time', 300); 
error_reporting(E_ALL | E_STRICT);
include('../../include/header.php');
$conn= getConnDB($db1);
$conn->debug =false;

header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");

header("content-disposition: attachment;filename=REPORTE_CPTT_VENCIDOS.xls");

$_SESSION['aDefaults'] ='';   //Tabla de Voceros (ahorita todos)
$_SESSION['aDefaults_']=''; //Empresas activas

$class_name = "dataListColumn2";
$class_name1='bgcolor="#F7F7F7"';

$SQL= "SELECT ";
$SQL.="DISTINCT(rncpt.empresa. srif) AS srif";
$SQL.=",rncpt.empresa.id";
$SQL.=",rncpt.empresa.nro_boleta as boleta";
$SQL.=",rncpt.empresa.srazon_social";
$SQL.=",rncpt.empresa.sdenominacion_comercial";
$SQL.=",rncpt.empresa.sucursales";
$SQL.=",entidad.sdescripcion as estado";
$SQL.=",municipio.sdescripcion as municipio";
//$SQL.=",rncpt.empresa.dfecha_creacion";
$SQL.=",to_char(rncpt.miembros_empresa.dfecha_const_comite,'dd/mm/yyyy') as dfecha_const_comite";
$SQL.=",to_char(rncpt.miembros_empresa.dfecha_vencimiento,'dd/mm/yyyy') as dfecha_vencimiento";
$SQL.=",to_char(rncpt.miembros_empresa.dfecha_nueva_eleccion,'dd/mm/yyyy') as dfecha_nueva_eleccion";
$SQL.=",CASE WHEN rncpt.miembros_empresa.nestatus_vocero='1' THEN 'Activo' WHEN rncpt.miembros_empresa.nestatus_vocero='2' THEN 'Vencido' end as estatus ";
$SQL.="FROM rncpt.miembros_empresa ";
$SQL.="inner join rncpt.empresa on miembros_empresa.empresa_id=empresa.id ";
$SQL.="join public.entidad ON empresa.entidad_nentidad=entidad.nentidad ";
$SQL.="join public.municipio ON empresa.municipio_nmunicipio=municipio.nmunicipio ";
$SQL.="WHERE miembros_empresa.nestatus_vocero='2' AND rncpt.empresa.nro_boleta IS NOT NULL";
$SQL.=" AND miembros_empresa.nenabled='1'";

$rs1 = $conn->Execute($SQL);
//Si hay registros coincidentes agrego en el arreglo aTabla1[] los datos de cada empresa//
$c=0; //Contador de Empresas
$v=0; //Contador de Voceros

if ($rs1->RecordCount()>0)
{
	//$c=0;
	$aTabla1[]=array(); //Arreglo de Empresas
	$aTabla[]=array();  //Arreglo de Voceros
	while(!$rs1->EOF)
	{
		$c = $c+1;
		$aTabla1[$c]['srif']= $rs1->fields['srif'];
		$aTabla1[$c]['id']=$rs1->fields['id'];				
		$aTabla1[$c]['boleta']= $rs1->fields['boleta'];
		$aTabla1[$c]['razon_empresa']= $rs1->fields['srazon_social'];
		$aTabla1[$c]['sdenominacion_comercial']= $rs1->fields['sdenominacion_comercial'];
		$aTabla1[$c]['sucursales']= $rs1->fields['sucursales'];	
		$aTabla1[$c]['estado']= $rs1->fields['estado'];	
		$aTabla1[$c]['municipio']= $rs1->fields['municipio'];	
		//$aTabla1[$c]['fecha_creacion']= $rs1->fields['dfecha_creacion'];	
		$aTabla1[$c]['fecha_creacion']= $rs1->fields['dfecha_const_comite'];	
		$aTabla1[$c]['fecha_vencimiento']= $rs1->fields['dfecha_vencimiento'];	
		$aTabla1[$c]['fecha_nueva_eleccion']= $rs1->fields['dfecha_nueva_eleccion'];	
		$aTabla1[$c]['estatus']= $rs1->fields['estatus'];	
		//Busco los voceros del id por el que va el ciclo//
		$SQL = "SELECT miembros_empresa.id, 
		miembros_empresa.nenabled,
		miembros_empresa.empresa_id,
		miembros_empresa.dfecha_actualizacion,
		miembros_empresa.dfecha_vencimiento,
		miembros_empresa.dfecha_creacion,
		miembros_empresa.nestatus_vocero,
		miembros.ncedula,
		miembros.sprimer_nombre,
		miembros.ssegundo_nombre,
		miembros.sprimer_apellido,
		miembros.ssegundo_apellido,
		miembros.stelefono1,
		miembros.stelefono2,
		miembros.nsexo,
		miembros.semail,
		miembros.fecha_nacimiento,
		condicion_act.sdescripcion as condicion_act,
		condicion_laboral.sdescripcion as condicion_lab,
		cargos.descripcion_cargo as cargos			
		FROM rncpt.miembros_empresa
		INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
		inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
		inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
		inner join rncpt.condicion_laboral on miembros_empresa.condicion_laboral_id=condicion_laboral.id
		inner join rncpt.empresa on miembros_empresa.empresa_id=empresa.id
		inner join rncpt.empresa_motor on empresa.id=empresa_motor.empresa_id
		inner join rncpt.motor on empresa_motor.motor_id =motor.id
		WHERE  miembros_empresa.nestatus_vocero='2' AND miembros_empresa.nenabled='1' AND miembros_empresa.empresa_id=". $aTabla1[$c]['id']." ORDER BY miembros_empresa.empresa_id;";
		$rs = $conn->Execute($SQL);
		//$v=0;
		if ($rs->RecordCount()>0)
		{
			while(!$rs->EOF)
			{
				$v=$v+1;
				$apellidonombre = ucwords(strtolower($rs->fields['sprimer_nombre']." ".$rs->fields['ssegundo_nombre'].' '.$rs->fields['sprimer_apellido']." ".$rs->fields['ssegundo_apellido']));			
				$aTabla[$v]['empresa_id']=$rs->fields['empresa_id'];
				$aTabla[$v]['apellidonombre']=$apellidonombre;
				$aTabla[$v]['sdescripcion']=$rs->fields['condicion_act'];
				$aTabla[$v]['ncedula']=$rs->fields['ncedula'];
				//$aTabla[$v]['apellidonombre_']=$apellidonombre_;
				$aTabla[$v]['stelefono1']=$rs->fields['stelefono1'];
				$aTabla[$v]['stelefono2']=$rs->fields['stelefono2'];
				$aTabla[$v]['semail']=$rs->fields['semail'];
				$sexo=$rs->fields['nsexo'];
				if($sexo=='1') $aTabla[$c]['sexo']='Masculino';
				if($sexo=='2') $aTabla[$c]['sexo']='Femenino';
				$aTabla[$v]['condicion_act']=$rs->fields['condicion_act'];
				$aTabla[$v]['condicion_lab']=$rs->fields['condicion_lab'];
				$aTabla[$v]['id']=$rs->fields['id'];						
				$aTabla[$v]['fecha_nacimiento']=$rs->fields['fecha_nacimiento'];	
				$aTabla[$v]['edad']=edad_($aTabla[$c]['fecha_nacimiento'])	;					
				$aTabla[$v]['cargos']=$rs->fields['cargos'];			
				$aTabla[$v]['fecha_actualizacion']=$rs->fields['dfecha_actualizacion'];
				$aTabla[$v]['fecha_creacion']=$rs->fields['dfecha_creacion'];
				$aTabla[$v]['fecha_vencimiento']=$rs->fields['dfecha_vencimiento'];
				$aTabla[$v]['fecha_nueva_eleccion']=$rs->fields['dfecha_nueva_eleccion'];
				$aTabla[$v]['estatus_vocero']=$rs->fields['nestatus_vocero'];
				$rs->MoveNext();
			}
		}
		$rs1->MoveNext();
	}
	//$_SESSION['aDefaults']=$aTabla;   //Tabla de Voceros (ahorita todos)
	//$_SESSION['aDefaults_']=$aTabla1; //Empresas activas
	$aEmpresa=$aTabla1;  //Empresas
	$aVocero =$aTabla_;   //Voceros
	$pdf_imprimir1='';
	$pdfEncabezadoDetalle.='
	<table width="100%" align="center" class="formulario"  border="0"  cellPadding="5" cellSpacing="1" >  
	<tr  bgcolor="#999999" color="#FFFFFF" >
	<th  colspan="11" class="sub_titulo_2"><div align="left"><b>Datos B&aacute;sicos de la Entidad de Trabajo</b></div></th>
	</tr>
	<tr bgcolor="#D0E0F4" color="#1060C8">
	   <th width="10%" class="sub_titulo" ><div align="center"> Nro de Boleta			</div></th>
	   <th width="10%" class="sub_titulo" ><div align="center"> R.I.F   		</div></th>
	   <th width="15%" class="sub_titulo" ><div align="center"> Raz&oacute;n Social			</div></th>
	   <th width="15%" class="sub_titulo" ><div align="center"> Denominaci&oacute;n Comercial	</div></th>
	   <th width="25%" class="sub_titulo" ><div align="center"> Sucursales		</div></th>
	   <th width="25%" class="sub_titulo" ><div align="center"> Estado		</div></th>
	   <th width="25%" class="sub_titulo" ><div align="center"> Municipio		</div></th>
	   <th width="25%" class="sub_titulo" ><div align="center"> Fecha Constituci&oacute;n		</div></th>
	   <th width="25%" class="sub_titulo" ><div align="center"> Fecha Vencimiento		</div></th>
	   <th width="25%" class="sub_titulo" ><div align="center"> Fecha Nueva Elecci&oacute;n	</div></th>
	   <th width="25%" class="sub_titulo" ><div align="center"> Estatus		</div></th>
	 </tr>	
	</table>';
	for( $i=1; $i<count($aEmpresa); $i++)
	{
					//Espacios://
					$espaciosCedula='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosNombre='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					//$espaciosNombre.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					//$espaciosNombre.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					//$espaciosNombre.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosFechaCreacion='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosFechaCreacion.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosFechaCreacion.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosFechaVencimiento='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosFechaVencimiento.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosFechaVencimiento.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosFechaVencimiento.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					//$espaciosFechaVencimiento.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosEstatusVocero='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosEstatusVocero.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosEstatusVocero.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosEstatusVocero.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$espaciosEstatusVocero.='&nbsp;&nbsp;';
					$pdfEncabezadoDetalle.='
					<table>
					   <tr bgcolor="#F0F0F0">
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['boleta'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['srif'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['razon_empresa'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['sdenominacion_comercial'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['sucursales'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['estado'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['municipio'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['fecha_creacion'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['fecha_vencimiento'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['fecha_nueva_eleccion'].'	</div></td>
						 <td class="texto-normal"><div align="center">'.' '.$aEmpresa[$i]['estatus'].'	</div></td>
					   </tr>
					</table>';
	}
	$pdf_imprimir1=$pdfEncabezadoDetalle;
}
else
{
	$pdf_imprimir1='No hay registros coincidentes ...';
}
echo($pdf_imprimir1);
//$aTabla_=$_SESSION['aDefaults_'];  //Empresas
//$aTabla1=$_SESSION['aDefaults'];   //Voceros

//var_dump($aTabla_);
//die();
// Esta es la parte de la impresión //
// Rebautizo los arreglos para legibilidad //
function edad_($fecha){
	$fechanac_=date("Y-m-d",strtotime($fecha));
	
	list($Y,$m,$d) = explode("-",$fechanac_);
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

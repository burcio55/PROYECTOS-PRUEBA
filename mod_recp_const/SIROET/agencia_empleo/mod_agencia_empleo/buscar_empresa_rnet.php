<?
session_start();
function buscar_datos_empresa_rnet($conn1,$sRif)
{
	//global $conn1;

	$sql = "SELECT rnee.usuario.id as id_usuario,rnee.usuario.snacionalidad,rnee.usuario.nusuario as nusuario, 
rnee.usuario.sprimer_nombre as nombre, rnee.usuario.sprimer_apellido as apellido,
rnee.usuario.ntelefono_personal, rnee.usuario.semail,rnee_empresa.srif as rif,
rnee_empresa.snil as nil,
rnee.rnee_empresa.parroquia_id ,public.parroquia.sdescripcion as parroquia_des,
rnee.rnee_empresa.municipio_id,public.municipio.sdescripcion as municipio_des,
rnee.rnee_empresa.estado_id, public.entidad.sdescripcion as entidad_des,
rnee.rnee_empresa.srazon_social as empresa_razon_social, rnee.rnee_empresa.sdenominacion_comercial,
rnee.rnee_empresa.semail as empresa_email, rnee.rnee_empresa.sdireccion_fiscal, 
rnee.rnee_empresa.ntelefono_local,rnee_empresa.snil,rnee_empresa.act_economica4,rnee_empresa.act_economica3,
rnee_empresa.id,rnee_empresa.nplantas_sucursales,
rnee_empresa.nince
FROM rnee.usuario 
INNER JOIN rnee.sesion ON rnee.sesion.usuario_id=rnee.usuario.id 
INNER JOIN rnee.rnee_empresa ON rnee.sesion.rnee_empresa_id=rnee.rnee_empresa.id 
INNER JOIN public.parroquia on public.parroquia.nparroquia =rnee.rnee_empresa.parroquia_id
INNER JOIN public.municipio on public.municipio.nmunicipio =rnee.rnee_empresa.municipio_id
INNER JOIN public.entidad on public.entidad.nentidad =rnee.rnee_empresa.estado_id
WHERE rnee.sesion.ntipo='2' AND rnee.rnee_empresa.srif='".$sRif."' and  rnee_empresa.snil!=''
ORDER BY rnee.sesion.id DESC
LIMIT 1";	
	$rs_emp = $conn1->Execute($sql);
	$valor='';
	if($rs_emp->RecordCount()>0){
	$_SESSION['nombre_empresa']=htmlspecialchars($rs_emp->fields['empresa_razon_social'], ENT_QUOTES);
	$_SESSION['sdenominacion_comercial']=htmlspecialchars($rs_emp->fields['sdenominacion_comercial'], ENT_QUOTES);
 	 $tel_emp =trim($rs_emp->fields['ntelefono_local']);	
	 $dir_emp = trim($rs_emp->fields['sdireccion_fiscal']);	
	 $empresa_email = $rs_emp->fields['empresa_email'];	
	 $deno_comer=htmlspecialchars($rs_emp->fields['sdenominacion_comercial'], ENT_QUOTES);
	
	 $nil = trim($rs_emp->fields['nil']);
	 $inc= trim($rs_emp->fields['nince']);
	 $ivs = buscar_ivss($conn1,$sRif);
	 $act4=trim($rs_emp->fields['act_economica4']);
	 $act3=trim($rs_emp->fields['act_economica3']);
//
	 $parroquia = strtoupper($rs_emp->fields['parroquia_id']);
	 $municipio = strtoupper($rs_emp->fields['municipio_id']);
	 $entidad = strtoupper($rs_emp->fields['estado_id']);
//	//representante legal
//	$nacionalidad=$rs_emp->fields['snacionalidad'];
//	if($nacionalidad=='1')$nacionalidad='V-';
//	if($nacionalidad=='2')$nacionalidad='E-';
//	$aDatos['solicitante']['sCedula'] = $nacionalidad.$rs_emp->fields['nusuario'] ;
	 $snombre_cont = trim(ucfirst($rs_emp->fields['nombre']))." ".trim(ucfirst($rs_emp->fields['apellido'])) ;
//	$aDatos['solicitante']['sApellido'] = ucfirst($rs_emp->fields['apellido']);	
//	$correo_cont = $rs_emp->fields['semail'];			
	 $sTelefono_cont = $rs_emp->fields['ntelefono_personal'];
	 $sucursales = $rs_emp->fields['nplantas_sucursales'];
	$valor=
	$nil."|".
	$inc."|".
	$ivs."|".
	$act4."|".
	$act3."|".
	$parroquia."|".
	$municipio."|".
	$entidad."|".
	$empresa_email."|".
	$tel_emp."|".
	$dir_emp."|".
	$snombre_cont."|".
	$sTelefono_cont."|".
	$deno_comer."|".
	$sucursales
	;
	// $_SESSION['valor']=$valor;
	}
	return $valor;	
}
function buscar_ivss($conn1,$sRif){
$sql_ivss="select rnee.rnee_ivss.numero_patronal,rnee.rnee_empresa.srif,rnee.rnee_ivss.bloqueado
 from rnee.rnee_empresa 
inner join rnee.rnee_ivss on rnee.rnee_ivss.rnee_empresa_id= rnee.rnee_empresa.id
where rnee.rnee_empresa.srif= '".$sRif."' limit 1";
$rs_ivss = $conn1->Execute($sql_ivss);
$sIvss=' ';
if($rs_ivss->RecordCount()>0){		
$sIvss= trim( $rs_ivss->fields['numero_patronal']);	
					
}
	return $sIvss;
}
function buscar_sucursales($conn1,$sRif){
$sql_surc="SELECT rnee_empresa_id,rnee.rnee_empresa.srif,rnee.rnee_sucursales.sdenominacion_comercial, sdireccion, 
			stelefono_local, stelefono_otro, rnee.rnee_sucursales.sivss
			FROM rnee.rnee_sucursales
			INNER JOIN rnee.rnee_empresa ON rnee.rnee_empresa.id=rnee.rnee_sucursales.rnee_empresa_id 
			where rnee.rnee_empresa.srif= '".$sRif."' limit 1";
$rs_surc = $conn1->Execute($sql_surc);
$sIvss=' ';

if($rs_surc->RecordCount()>0){	
	while ( !$rs_surc->EOF ){	
		
		$cant_surc++;
		$nombre_sucur=$cant_surc."- ".$rs_surc->fields['sdenominacion_comercial']."<br>";
		
		$rs_surc->MoveNext();	
	}
	$sucur=$cant_surc."|".$nombre_sucur;
	return $sucur;
}
	
}
?>
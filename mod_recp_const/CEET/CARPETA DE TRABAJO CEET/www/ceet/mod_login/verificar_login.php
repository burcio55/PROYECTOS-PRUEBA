<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug=false;

$_REQUEST['nacionalidad']=base64_decode($_REQUEST['nacionalidad']);
$_REQUEST['usuario']=base64_decode($_REQUEST['usuario']);
$_REQUEST['clave']=base64_decode($_REQUEST['clave']);
$_REQUEST['captcha']=base64_decode($_REQUEST['captcha']);

if(isset($_REQUEST['nacionalidad'])){
$nacionalidad=str_replace("'","",$_REQUEST['nacionalidad']);
$nacionalidad=str_replace(",","",$nacionalidad);
$nacionalidad=str_replace("INSERT","",$nacionalidad);
$nacionalidad=str_replace("UNION","",$nacionalidad);
$nacionalidad=str_replace("SELECT","",$nacionalidad);
$nacionalidad=str_replace("UPDATE","",$nacionalidad);
$nacionalidad=str_replace("AND","",$nacionalidad);
$nacionalidad=str_replace("IF","",$nacionalidad);
$nacionalidad=str_replace(";","",$nacionalidad);
$nacionalidad=htmlentities(strtoupper(trim($nacionalidad)));
}
if(isset($_REQUEST['usuario'])){
$usuario=str_replace("'","",$_REQUEST['usuario']);
$usuario=str_replace(",","",$usuario);
$usuario=str_replace("INSERT","",$usuario);
$usuario=str_replace("UNION","",$usuario);
$usuario=str_replace("SELECT","",$usuario);
$usuario=str_replace("UPDATE","",$usuario);
$usuario=str_replace("AND","",$usuario);
$usuario=str_replace("IF","",$usuario);
$usuario=str_replace(";","",$usuario);
$usuario=htmlentities(strtoupper(trim($usuario)));
}
if(isset($_REQUEST['clave'])){
$clave=str_replace("'","",$_REQUEST['clave']);
$clave=str_replace(",","",$clave);
$clave=str_replace("-","",$clave);
$clave=htmlentities((trim($clave)));
}
if(isset($_REQUEST['captcha'])){
$captcha=str_replace("'","",$_REQUEST['captcha']);
$captcha=str_replace(",","",$captcha);
$captcha=str_replace("INSERT","",$captcha);
$captcha=str_replace("UNION","",$captcha);
$captcha=str_replace("SELECT","",$captcha);
$captcha=str_replace("UPDATE","",$captcha);
$captcha=str_replace("AND","",$captcha);
$captcha=str_replace("IF","",$captcha);
$captcha=str_replace(";","",$captcha);
$captcha=htmlentities(strtoupper(trim($captcha)));
}

$SQL="SELECT registrador.id as usuario_id,
				registrador.snacionalidad as nacionalidad,
				registrador.ncedula as ncedula,
				registrador.sprimer_apellido as apellido,
				registrador.sprimer_nombre as nombre,
				sesion.sclave,
				sesion.region_id nregion,
				entidad.nentidad as nentidad_id ,
				entidad.sdescripcion as estado,
				region.id as region_id,
				region.sdescripcion as region,
				sesion.ntipo
				FROM scpt.sesion
				INNER JOIN scpt.registrador ON scpt.registrador.id=scpt.sesion.registrador_id
				LEFT JOIN public.entidad ON public.entidad.nentidad=scpt.sesion.entidad_nentidad
				LEFT JOIN public.region ON public.region.id=scpt.sesion.region_id
				WHERE registrador.ncedula='".$usuario."'
				AND registrador.snacionalidad='".$nacionalidad."' 
				AND sesion.sclave='".trim(md5($clave))."' 
				AND registrador.nenabled='1' 
				AND sesion.nenabled='1'
				LIMIT 1 ";
$rs=$conn->Execute($SQL);

	if($_SESSION["captcha"]){
		if($_SESSION["captcha"]==$captcha){
			if($rs->RecordCount()>0){
				//USUARIO
				$_SESSION['usuario_id']=$rs->fields['usuario_id'];
				$_SESSION['nacionalidad']=$rs->fields['nacionalidad'];
				$_SESSION['nusuario']=$rs->fields['ncedula'];
				$_SESSION['nombre']=strtoupper($rs->fields['nombre']);
				$_SESSION['apellido']=strtoupper($rs->fields['apellido']);
				if($rs->fields['ntipo']=='2'){
				$_SESSION['ubicacion']=strtoupper($rs->fields['region']);
				$_SESSION['nregion']=strtoupper($rs->fields['region_id']);
				}else if($rs->fields['ntipo']=='3' or $rs->fields['ntipo']=='5' or $rs->fields['ntipo']=='6' ){
				$_SESSION['ubicacion']=strtoupper($rs->fields['estado']);
				$_SESSION['nentidad']=strtoupper($rs->fields['nentidad_id']);
				$_SESSION['nregion']=strtoupper($rs->fields['region_id']);
				}else{
				$_SESSION['ubicacion']=strtoupper($rs->fields['estado']);
				}
				
				$_SESSION['ntipo']=$rs->fields['ntipo'];
								
				$retorno=1;
			}else{
				$retorno=0;	
			}
		}else{
			$retorno=2;
		}
	}else{
		$retorno=0;	
	}
	
echo $retorno;


?>

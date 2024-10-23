<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

/*
 echo 
 "RIF:".."<br>".
 "RAZON:".$_REQUEST['txt_razon_social']."<br>".
 "DENOMINACION:".$_REQUEST['txt_denominacion_comercial']."<br>".
 "DIRECCION:".$_REQUEST['txt_direccion_fiscal']."<br>".
 "ESTADO:".$_REQUEST['txt_estado']."<br>".
 "MUNICIPIO:".$_REQUEST['txt_municipio']."<br>".
 "PARROQUIA:".$_REQUEST['txt_parroquia']."<br>";
*/


include('../include/header.php');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db_settings[1]);
$conn1->debug = false;

$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db1);
$conn2->debug = false;

include("../evita_injection.php");
include("../verificar_session_url.php");

if(isset($_REQUEST['passwd'])){
$clave=str_replace("'","",$_REQUEST['passwd']);
$clave=str_replace(",","",$clave);
$clave=str_replace("-","",$clave);
$clave=htmlentities((trim($clave)));
}
if(isset($_SESSION['nusuario'])){
$usuario=str_replace("'","",$_SESSION['nusuario']);
$usuario=str_replace(",","",$usuario);
$usuario=str_replace("-","",$usuario);
$usuario=htmlentities((trim($usuario)));
}

$SQL= "select max(id_seniat) as ultimo_id_seniat FROM seniat";

$rs= $conn1->Execute($SQL);
if($rs->RecordCount()>0){
	$id_seniat_ultimo=$rs->fields['ultimo_id_seniat'];
	$id_seniat_ultimo=$id_seniat_ultimo + 1;
}

/*
$SQL= "INSERT INTO seniat(
             id_seniat,srif, srazon_social, sdenominacion_comercial, sdireccion_fiscal, 
            estado, municipio, parroquia, semail)
    VALUES ('".$id_seniat_ultimo."',, ,, , , , , );";
*/

$SQL= " UPDATE seniat
   SET srazon_social='".$_REQUEST['txt_razon_social']."', sdenominacion_comercial='".$_REQUEST['txt_denominacion_comercial']."', 
       sdireccion_fiscal='".$_REQUEST['txt_direccion_fiscal']."', estado='".$_REQUEST['txt_estado']."', municipio='".$_REQUEST['txt_municipio']."', parroquia='".$_REQUEST['txt_parroquia']."', semail='".$_REQUEST['txt_email']."'
 	WHERE srif='".$_REQUEST['txt_rif']."';";

$SQL2= " update rnee.rnee_empresa SET
	srazon_social='".$_REQUEST['txt_razon_social']."',sdenominacion_comercial='".$_REQUEST['txt_denominacion_comercial']."',
	sdireccion_fiscal='".$_REQUEST['txt_direccion_fiscal']."'
 	WHERE srif='".$_REQUEST['txt_rif']."';";

if($rs = $conn1->Execute($SQL)){
	$valor="modificado";
	$conn2->Execute($SQL2);
}else{
	$valor="error_registrar";
}
echo $valor;

?>

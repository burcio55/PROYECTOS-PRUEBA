<?php
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
session_start();
/*include('../include/header.php');*/
global $conn;
global $conn2;
global $rif;
/*
$conn= getConnDB($db1);
$conn->debug = true;
print("minpptrasse".$db1);
//CONEXION CON LA TABLA ENTES
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db2);
$conn2->debug = true;
print("entes".$db2);*/

$condition_question_1 = array(true, false);
shuffle($condition_question_1);
/*$condition_question_2 = array(true, false);
shuffle($condition_question_2);*/
$condition_question_3 = array(true, false);
shuffle($condition_question_3);

/*if($_REQUEST['y']){
	$y=decrypt($_REQUEST['y']);
	
	$valorx=explode('-', $y);
	//var_dump( $valorx);
	$valorxx=explode('|', $valorx[1]);
	//var_dump( $valorxx);
	$_SESSION['rif']=$valorxx[0];
}*/

if($condition_question_1[1] == true){ // numero patronal IVSS
$_SESSION['condition_question_1']=true;
$query_1 ='0414-1065142';
$condicion1='SI ';
	/*$sql="SELECT numero_patronal
	 FROM rnee.rnee_ivss 
	 inner join rnee.rnee_empresa on rnee.rnee_empresa.id = rnee.rnee_ivss.rnee_empresa_id
	where rnee.rnee_ivss.bloqueado='1' and rnee.rnee_empresa.srif='".$rif."'  LIMIT 1";
	 $rs= $conn->Execute($sql);
	 if($rs->RecordCount()>0){
		 $query_1 = $rs->fields[0];
			$condicion1='SI ';
		 }else{
			$query_1 ='XXX123X';
			$condicion1='NO ';
		 }*/
}else{
	$_SESSION['condition_question_1']=false;
	$query_1 ='0416-236987X';
	$condicion1='NO ';
	/*$sql="SELECT 
	  numero_patronal
	 FROM rnee.rnee_ivss 
	 inner join rnee.rnee_empresa on rnee.rnee_empresa.id = rnee.rnee_ivss.rnee_empresa_id
	where rnee.rnee_ivss.bloqueado='1'  and rnee.rnee_empresa.srif != '".$rif."' ORDER BY RANDOM () LIMIT 1";
	if($rs= $conn->Execute($sql))	
	$query_1 = $rs->fields[0];	
	$respuesta1=2;*/
}
/*
////////////////////////////////////////////////////////////
if($condition_question_2[1] == true){ // estado
$_SESSION['condition_question_2']=true;
	$sql="SELECT estado FROM seniat where srif='".$rif."' LIMIT 1";
	if($rs1= $conn2->Execute($sql))
		 if($rs1->RecordCount()>0){
		 $query_2 = $rs1->fields[0];
			$condicion2='SI ';
		 }else{
			$query_2 ='EL MOJAN DE BARINAS SUITE';
			$condicion2='NO ';
		 }
}else{
	$_SESSION['condition_question_2']=false;
	$sql = "SELECT estado FROM seniat WHERE srif != '".$rif."' ORDER BY RANDOM () LIMIT 1";
	if($rs1= $conn2->Execute($sql))
	$query_2 =  $rs1->fields[0];
}
///////////////////////////////////////////////////////////////////
*/
if($condition_question_3[1] == true){// direccion fiscal
	$_SESSION['condition_question_3']=true;
	$condicion3='SI ';
	 $query_3 ='13-01-2000';
	/*$sql="SELECT sdireccion_fiscal FROM seniat where srif='".$rif."' LIMIT 1";	
	 if($rs2= $conn2->Execute($sql))
	 if($rs2->RecordCount()>0){
		 $query_3 = $rs2->fields[0];
			$condicion3='SI ';
		 }else{
			$query_3 ='SEBUCAN OLD';
			$condicion3='NO ';
		 }*/
	
}else{
		$condicion3='NO ';
	 $query_3 ='28-02-2035';
	/*$_SESSION['condition_question_3']=false;
	$sql="SELECT sdireccion_fiscal FROM seniat where srif != '".$rif."' ORDER BY RANDOM () LIMIT 1";
	 if($rs2= $conn2->Execute($sql))	
	$query_3 = $rs2->fields[0];*/
}


/*echo $query_1.'<br>';
echo $query_2.'<br>';
echo $query_3.'<br>';
var_dump($_SESSION['condition_question_1']);
var_dump($_SESSION['condition_question_2']);
var_dump($_SESSION['condition_question_3']);*/
?>
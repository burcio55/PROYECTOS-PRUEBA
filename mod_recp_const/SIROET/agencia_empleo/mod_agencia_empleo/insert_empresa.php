<?php
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);
include('include/header.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
$conn->debug =false;
session_start();

//echo $_SESSION['valor'];
//echo $_GET['rnee'];
$str='';
if($_GET['nil'])$str[0]=$_GET['nil'];
if($_GET['ivs'])$str[2]=$_GET['ivs'];
if($_GET['inc'])$str[1]=$_GET['inc'];
if($_GET['dir'])$str[10]=$_GET['dir'];
if($_GET['sema'])$str[12]=$_GET['sema'];
if($_GET['deno'])$str[13]=$_GET['deno'];
if($_SESSION['valor']){
	//echo "en el inserttttttt".$valor;
	
$str=$_SESSION['valor'];
$str = explode("|", $str);
//echo"primera pos....". $str[0];
//	$valor=  REFERENCIA DE POSICIONES DE LA CADENA
//	$nil."|". cero
//	$inc."|". uno
//	$ivs."|". dos
//	$act4."|". tres
//	$act3."|". cuatro
//	$parroquia."|". cinco LOS VALORES SON DISTINTOS EN RNET
//	$municipio."|". seis
//	$entidad."|". siete
//	$empresa_email."|". ocho
//	$tel_emp."|". nueve
//	$dir_emp."|". diez
//	$snombre_cont."|". once
//	$sTelefono_cont;  doce
// 	$deno_comer."|". trece
//	$sucursales catorce

}


	  $sfecha=date('Y-m-d');
	  $sql="insert into empresa_instituto (rif, nombre, nil, ivss, rnee, inces,act_economica4,act_economica3,direccion,telefono,persona_contacto,cargo_persona,correo,sdenominacion_comercial,sucursales,
	  telefono_persona_contacto,created_at, status, id_update,
		   sunidadsustantiva) values
			('".$_SESSION['rif']."',
			'".$_SESSION['nombre_empresa']."',
			'".$str[0]."',
			'".$str[2]."',
			'".$_GET['rnee']."',
			'".$str[1]."',
			'".$str[3]."',
			'".$str[4]."', 			
			'".$str[10]."',
			'".$str[9]."',
			'".$str[11]."',
			'REPRESENTANTE LEGAL',
			'".$str[15]."',
			'".$str[13]."',
			'".$str[14]."',
			'".$str[12]."',
	   '$sfecha',
	   'A',
	   '".$_SESSION['sUsuario']."',
	   '1')";
	   $conn->Execute($sql);
	   
		$SQL="select id, nombre From empresa_instituto where rif='".$_SESSION['rif']."'";
	  $rs1 = $conn->Execute($SQL);
	  if ($rs1->RecordCount()>0){ 				
		 $_SESSION['id_empresa']=$rs1->fields['id'];
		 $_SESSION['nombre_empresa']=$rs1->fields['nombre'];
					 
//Trazas-------------------------------------------------------------------------------------------------------------------			
				$id=$_SESSION['id_empresa'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='13';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod); 
				
				unset($_SESSION['rnee']);
				
				?><script>document.location='?menu=21'</script><? 
				}		   	   

        

?>
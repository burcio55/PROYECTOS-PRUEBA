<?php
// al descomentar el diplay_errors se visualizan los errores de php
ini_set("display_errors",1);
error_reporting(E_ALL | E_STRICT);


include('../include/header.php');
$conn= getConnDB($db1); //SIRE
$conn->debug = true;

//CONEXION CON LA TABLA ENTES
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db5);
$conn2->debug = false;

global $conn;
global $conn2;

//debug();
$condition_question_1 = array(true, false);
shuffle($condition_question_1);

$condition_question_3 = array(true, false);
shuffle($condition_question_3);


//print($_POST['cedula']);
$cedula=$_SESSION['cedula'];
$letra=$_SESSION['nacionalidad'];

if($letra=='1'){
	
		$letra1='V';
}else{
	$letra1='E';
	
	}

if($condition_question_1[1] == true){ // numero telefono
$_SESSION['condition_question_1']=true;

$condicion1='SI ';
$sql="select telefono from usuarios where cedula='".$cedula."' and nacionalidad='".$letra."'  LIMIT 1";
	 $rs= $conn2->Execute($sql);
	 if($rs->RecordCount()>0){
		 $query_1 = $rs->fields[0];
			$condicion1='SI ';
		 }else{
			$query_1 ='0412-629-X1-21';
			$condicion1='NO ';
		 }
}else{
	$_SESSION['condition_question_1']=false;
	$condicion1='NO ';
	$sql="SELECT telefono	FROM usuarios	
	where  cedula!='".$cedula."' and nacionalidad='".$letra."'  ORDER BY RANDOM () LIMIT 1";
	if($rs= $conn->Execute($sql))	
	$query_1 = $rs->fields[0];	
	$respuesta1=2;
}

if($condition_question_3[1] == true){// fecha de nacimiento
	$_SESSION['condition_question_3']=true;
	$condicion3='SI ';
	$sql="select fechanac from saime where numcedula=".$cedula." and letra='".$letra1."'  LIMIT 1";	
	 if($rs2= $conn2->Execute($sql))
	 if($rs2->RecordCount()>0){
		 $query_3 = $rs2->fields[0];
			$condicion3='SI ';
		 }else{
			$query_3 ='28-02-2035';
			$condicion3='NO ';
		 }
	
}else{
		$condicion3='NO ';
	
	$_SESSION['condition_question_3']=false;
	$sql="SELECT fechanac FROM saime where numcedula != ".$cedula." and letra='".$letra1."' ORDER BY RANDOM () LIMIT 1";
	 if($rs2= $conn2->Execute($sql))	
	$query_3 = $rs2->fields[0];
}

$array1 = array(
	'<tr>
	  <tr>
	  <td align="lefth" class=""><font color="#585858"><b>- INDIQUE SI SU NUMERO TELEFONICO '.$condicion1.'ES EL SIGUIENTE: </b>			</font>
	</td>
	</tr>
			<tr>
		  <td align="lefth" class=""><font color="#585858">NUMERO TELEFONICO REGISTRADO:  '.$query_1.'</font>
	</td>
	</tr
	<tr>
	<td align="lefth"  id="td_respuesta1" width="30%"><b> 
	
		  &nbsp;&nbsp;
		  SI
		  <input type="radio" name="respuesta1" id="valor1"  value="1"/>
		  &nbsp;&nbsp;
		  NO
		   <input type="radio" name="respuesta1" id="valor2"  value="2"/>
		  &nbsp;&nbsp;     
		  <span>*</span></b>
		  </td>
	</tr>
	', 
	
	'<tr>
	  <td align="lefth" class=""><font color="#585858"><b>- INDIQUE SI SU FECHA DE NACIMIENTO  '.$condicion3.'ES LA SIGUIENTE: </b></font>
	</td>
	</tr>
	
	<tr>
	  <td align="justify" class=""><font color="#585858">"'.$query_3.'"</font>
	</td>
	</tr>
	<tr>
	<td align="lefth" id="td_respuesta2" width="30%"> <b>
		  &nbsp;&nbsp;
		  SI
		   <input type="radio" name="respuesta2" id="valor1"  value="1"/>
		  &nbsp;&nbsp;
		  NO
		   <input type="radio" name="respuesta2" id="valor2" value="2"/>
		  &nbsp;&nbsp;     
		  <span>*</span></b></td>
	</tr>'); 
	shuffle($array1); //Para Efectos de Desordenar el Array
?>
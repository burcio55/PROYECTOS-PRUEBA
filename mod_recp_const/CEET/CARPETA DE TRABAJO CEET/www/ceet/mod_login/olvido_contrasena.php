<?php
// al descomentar el diplay_errors se visualizan los errores de php
include('../include/header.php');
include("../evita_injection.php");
include("encripta_descencripta.php");
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors",0);
$GLOBALS['settings']['debug']=$settings['debug'] =false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];



//-------------------------------------------------------------
//CONEXION CON LA TABLA ENTES
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db2);
$conn2->debug = $settings['debug'];

/*print("entes".$db2);
print("minpptrasse".$db1);*/

$condition_question_1=$_SESSION['condition_question_1'];
$condition_question_2=$_SESSION['condition_question_2'];
$condition_question_3=$_SESSION['condition_question_3'];
$i=0;



if($_REQUEST['x']){
	$x=$_REQUEST['x'];	
	$valor_encriptado_cod=$x;	
}

if($_REQUEST['y']){
	$y=decrypt($_REQUEST['y']);
	
	$valorx=explode('-', $y);
	//var_dump( $valorx);
	$valorxx=explode('|', $valorx[1]);
	//var_dump( $valorxx);
	$rif=$valorxx[0];
}

if($_SESSION['intentos']==""){
	$_SESSION['intentos']=0;
}
debug();
doAction($conn,$conn2,$valor_encriptado_cod,$condition_question_1,$condition_question_2,$condition_question_3,$rif);
showHeader();
showForm($conn,$conn2,$valor_encriptado_cod,$rif);


function debug(){
	 if($GLOBALS['settings']['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		var_dump($_GET);
		var_dump($_REQUEST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function trace($msg){//para hacer traza y no estar escribiendo echo o print cada vez
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
function doAction($conn,$conn2,$valor_encriptado_cod,$condition_question_1,$condition_question_2,$condition_question_3,$rif){

	if (isset($_POST['action'])){
		
		switch($_POST["action"]){
			case 'validar':
			
			$bValidateSuccess=true;	
					
					if($bValidateSuccess){
						//var_dump($condition_question_1);
						//var_dump($condition_question_2);
						//var_dump($condition_question_3);						
				
						
						if($_POST['respuesta1']==1 && $condition_question_1)$valida++;
							
						if($_POST['respuesta1']==2 && !$condition_question_1)$valida++;
						
							
					
						if($_POST['respuesta2']==1 && $condition_question_2)$valida++;
							
						if($_POST['respuesta2']==2 && !$condition_question_2)$valida++;
							
							
					
						if($_POST['respuesta3']==1 && $condition_question_3)$valida++;
						
						if($_POST['respuesta3']==2 && !$condition_question_3)$valida++;
							
						//	echo "Valida ....".$valida;
						
						
						if ($valida==3){
								header('location: notificacion_envio_correo_verificacion2.php?x='.$valor_encriptado_cod);
											
						}else{
								$_SESSION['intentos']=$_SESSION['intentos'] + 1;
								if($_SESSION['intentos']>3){	
							
									header('location: notificacion_error_intentos.php');      
							                    
								}
							?>
							<script>
							alert("Respuestas Incorrectas, por favor verifique e intente de nuevo. Recuerde que al ingresar las respuesta erradas en tres (3) intentos consecutivos, su acceso será bloqueado por medidas de seguridad. ");							
							</script>
                            <?
								
							}				
						
						//echo "INTENTOS....".$_SESSION['intentos'];

					}
			
			break;
			}
	
	}else{
		// echo "PRIMERA VEZ";
		 if(!isset($_SESSION)){
		header("location: rnet_login.php");
		} else {
		session_unset();
		session_destroy();
		}
	}
	
}
function showHeader(){
 include('../header.php');  
}
function showForm($conn,$conn2,$conn,$valor_encriptado_cod,$rif){
?>

<!--<link href="../css/formularios.css" rel="stylesheet" type="text/css" />-->
<body oncontextmenu="return false" onkeydown="return false"> 



<form name="frm_rnet_" id="frm_rnet_" method="post" action="<? //=$_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value=""/>
<input name="rif" type="hidden" value="<?=$rif?>"/>
<script type="text/javascript" src="validar_preguntas.js"></script>
<script>
	function send(saction){	
	 if(saction=='validar'){
						 if(saction=='validar'){
						if (confirm("Su nueva contrase\u00F1a de acceso es: 123456789 \n y por medida de seguridad debe cambiarla al ingresar al sistema  ")){
							var form = document.frm_rnet_;
							form.action.value=saction;
							form.submit();
				}
			}
		}
					if(validar_formulario()==true){
						if (confirm("¿REALMENTE ESTA SEGURO DE REALIZAR ESTA OPERACION? - SI ESTA SEGURO PRESIONE ACEPTAR. ")){
							var form = document.frm_rnet_;
							form.action.value=saction;
							form.submit();
						}
					}
				
	}
	
</script>
<? 

require_once("preguntas.php");

?>
<table class="formulario" width="60%" align="center">
<tr>
	<td height="5"></td>
</tr>

<tr>
<th align="center" class="sub_titulo">VERIFICACION DE INFORMACION</th>
</tr>
<tr>
	<td height="5"></td>
</tr>

<tr>
  <td align="lefth" class=""><font color="#585858">Para continuar con el proceso de Olvido Contraseña, por favor responda las siguientes preguntas:</font>
</td>
</tr>
<tr>
	<td height="3"></td>
</tr>
     <tr> <td width="10%">
     <table width="100%" border="0">
        <? echo $array1[0]."<br>"; ?>
      </table></td></tr>
      
      <tr>  <td width="20%"><table width="100%" border="0">
		<? echo $array1[1]."<br>"; ?>
      </table></td></tr>
      </table>
      </td>
      </tr>
    
    </tr>
  </table>




<table class="formulario" width="70%" align="center">
<tr>
<td align="center" class=""><font color="#585858">Haz clic en <img src="../imagenes/right_16.png" width="35" height="35" title="Haz clic en esta imagen para continuar con su verificaci&oacute;n"  style="cursor:pointer" onClick="javascript:send('validar');" /> para continuar </font></td>
</tr>

<!--<tr>
<td align="center" class=""><font color="#585858">Haz clic en <img src="../imagenes/right_16.png" width="35" height="35" title="Haz clic en esta imagen para continuar con su verificaci&oacute;n"  style="cursor:pointer" onClick="javascript:send('validar');" /> para continuar </font></td>
</tr>-->

<!--<tr>  
<th align="justify" ><img src="../imagenes/warning_16.png"/><font color="#8E0303"><b>   NOTA: </b></font><font color="#585858">La contraseña debe ser cambiada una vez que ha ingresado al sistema de Centro de Encuentro para la Educación y el trabajo a través de su  login.</font></tr>
<tr>-->
<td height="25"></th>
</tr>

</table>




<?
}
 include('../footer.php'); 
 ?>
 


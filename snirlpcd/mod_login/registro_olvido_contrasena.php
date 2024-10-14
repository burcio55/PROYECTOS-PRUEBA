<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

//-------------------------------------------------------------
include('../include/header.php');

include('1_Validador.php');
$conn= getConnDB($db1);
$conn->debug = false;
//-------------------------------------------------------------
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

include("../evita_injection.php");
doAction($conn);
debug();
showHeader();
showForm($conn,$aDefaultForm);
showFooter();



function debug(){
	 if($settings['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
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

function doAction($conn){

	if (isset($_POST['action'])){
		switch($_POST['action']){
		   
			/*case 'validar':
			
                  ?><script>if (confirm("-  El Usuario se encuentra registrado."))
                    document.location="olvido_contrasena.php?";
                    </script><?
			break;*/
			case 'buscar': 
			$bValidateSuccess=true;	
					
		if ($_POST['cbCed_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La cédula: es requerido.";
				$bValidateSuccess=false;
		 }
		 
		if ($_POST['ced_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La cédula: es requerido.";
				$bValidateSuccess=false;
		 }	   
		
					  				
			if ($bValidateSuccess){				
				 if($_POST['cbCed_afiliado']!="" and $_POST['ced_afiliado']!=""){
					$cedula=$_POST['cbCed_afiliado'].$_POST['ced_afiliado'];
					$cedula=trim($cedula);
                    $SQL = "select * from usuarios
                    where cedula ='".$cedula."'";

                    $rs = $conn->Execute($SQL);
            		if ($rs->RecordCount()>0){

                  $_SESSION['cedula']=$aDefaultForm['ced_afiliado']=$_POST['ced_afiliado'];				  
				 $_SESSION['nacionalidad']= $_POST['txt_nacionalidad']=$rs->fields['nacionalidad'];
                  $_POST['txt_apellido1']=$rs->fields['apellidos']; 
				  $_POST['txt_nombre1']=$rs->fields['nombres'];
					
                           $bValidateSuccess=false;

                  ?><script>//if (confirm("-  El Usuario se encuentra registrado."))
                   // document.location="olvido_contrasena.php?";
                    </script><?

            }else{  ?>
			<script>
				alert("-  El Usuario no esta registrado. ")
                document.location="/ceet/mod_login/login.php?";
            </script>
                    <? }

        }
				}
			
			LoadData($conn,true);	
			break;
	        }
		}		
		else{
		LoadData($conn,false);
		}
}
 
 
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
//datos personales
					$aDefaultForm['cbCed_afiliado']='';
					$aDefaultForm['txt_nombre1']='';
					$aDefaultForm['txt_apellido1']='';
					$aDefaultForm['txt_nacionalidad']='';
					$aDefaultForm['ced_afiliado']='';
					
					
				
        
	if (!$bPostBack){
		/*AQUI SI TRAE DE BASE DE DATOS*/
		}else{   
					$aDefaultForm['cbCed_afiliado']=$_POST['cbCed_afiliado'];
					$aDefaultForm['ced_afiliado']=$_POST['ced_afiliado'];
					$aDefaultForm['txt_nombre1']=$_POST['txt_nombre1'];
					$aDefaultForm['txt_apellido1']=$_POST['txt_apellido1'];
					$aDefaultForm['txt_nacionalidad']=$_POST['txt_nacionalidad'];				
					
		}
	}
} 


function ProcessForm($conn){

}


//funcion que dibuja el encabezado de la pagina 
function showHeader(){
 include('../header.php'); 
}


function showForm($conn,$aDefaultForm){
?>
<form name="frm_olvido_contrasena" id="frm_olvido_contrasena" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
    <input id="action" name="action" type="hidden" value=""/>

    <input name="txt_nombre1" type="hidden" value="<?=$aDefaultForm['txt_nombre1']?>"/>
    <input name="txt_apellido1" type="hidden" value="<?=$aDefaultForm['txt_apellido1']?>"/>
   <input name="ced_afiliado2" type="hidden" value="<?=$aDefaultForm['ced_afiliado']?>"/>
   <input name="txt_nacionalidad" type="hidden" value="<?=$aDefaultForm['txt_nacionalidad']?>"/>
<script type="text/javascript" src="../mod_registro/validar_trabajador_registro.js"></script>
<script type="text/javascript" src="../mod_registro/funciones_registro.js"></script>
<script>

	
	function send(saction){
		var form = document.frm_olvido_contrasena;
		form.action.value=saction;
		form.submit();				
					
	}
	function send(saction){
		 if(saction=='validar'){
			if(validar_frm_olvido_contrasena()==true){
				//	if (confirm("Por favor, antes de aceptar verifique minuciosamente los datos ingresados, ya que no podrán ser modificados posteriormente.")){
						if (confirm("El Usuario se encuentra registrado.¿REALMENTE ESTA SEGURO DE REALIZAR ESTA OPERACION - SI ESTA SEGURO PRESIONE ACEPTAR ")){
						   document.location="olvido_contrasena.php";
						}
				//	}
				}
		 }else{
			 var form = document.frm_olvido_contrasena;
		form.action.value=saction;
		form.submit();	
	}
	}
</script>




<table width="95%" border="0" align="center" class="formulario">
    <tr>
		<th colspan="4" class="titulo">OLVIDO CONTRASE&Ntilde;A</th>
	</tr>
        
	<tr class="identificacion_seccion">
		<th colspan="4" class="sub_titulo_2"><div align="left">INDIQUE LOS DATOS DE ACCESO AL SISTEMA</div></th>
	</tr>
           <tr>
          <th colspan="2" style="background-color:#F0F0F0; color:#666"  align="right">C&eacute;dula de Identidad:</th>
          
          <td colspan="2">
         <select name="cbCed_afiliado"  id="cbCed_afiliado">
         <option value="V" <? if (($aDefaultForm['cbCed_afiliado'])=='V') print 'selected="selected"';?>>V</option>
         <option value="E" <? if (($aDefaultForm['cbCed_afiliado'])=='E') print 'selected="selected"';?>>E</option>
         </select>
         <input name="ced_afiliado" type="text" id="ced_afiliado"  onkeypress="return permite(event, 'num')" value="<? print $aDefaultForm['ced_afiliado']?>" size="20" maxlength="20" onBlur="javascript:send('buscar');" />
         						<span class="requerido"> *</span>
          </td>
        </tr>
                      <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
        
        <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2" align="left">DATOS PERSONALES</th>
        </tr>	
            <tr>
            <td style="background-color:#F0F0F0; color:#666" align="center"><strong>C&eacute;dula de Identidad</strong></td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?=number_format( $aDefaultForm['ced_afiliado'], 0, '', '.')?></font></td>
            <td style="background-color:#F0F0F0; color:#666"" align="center"><strong>Nacionalidad </strong></td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['txt_nacionalidad']==1){
            echo 'VENEZOLANO';
            }
            if($aDefaultForm['txt_nacionalidad']==2){
            echo 'EXTRANJERA';
            }
            ?>
            </font></td>
        </tr>
    
        <tr>
            <th width="50%"  colspan="2"class="sub_titulo" align="center"> Apellido(s)</th>		
            
            <th width="50%" colspan="2" class="sub_titulo" align="center"> Nombre(s)</th>
 
        </tr>
        
     <tr>
       <td colspan="2" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_apellido1'];?></font></td>

      <td colspan="2" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_nombre1'];?></font></td>

        </tr>
        <tr>
     <td align="center"  colspan="4"><font color="#585858">Haz clic en <img src="../imagenes/right_16.png" width="35" height="35" title="Haz clic en esta imagen para continuar con su verificaci&oacute;n"  style="cursor:pointer" onClick="javascript:send('validar');" /> para continuar </font></td>
</tr>
             <tr>
            <th colspan="4">&nbsp;</th>		
        </tr>
    
    
    
</table>

</form>
<?php
}
//funcion que imprime con alert todos los errores
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php include('../footer.php'); ?>

<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('1_LoadCombos.php');
//include('1_Validador.php');
//include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug']=false);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
			case 'Culminar':
					unset($_SESSION['id_persona']);
					unset($_SESSION['ced_afiliado']);
					unset($_SESSION['apellidos_afiliado']);
					unset($_SESSION['nombre_afiliado']);
					unset($_SESSION['actualiza']);
					unset($_SESSION['registro']);
					unset($_SESSION['migra_bloq']);
					unset($_SESSION['disc_bloq']);	
					unset($_SESSION['tipo_persona']);
			//		unset($_SESSION['usuario']);
			    LoadData($conn,false);
			break;
			
		/*	case 'Buscar':
			   ?><script>document.location='1_1agen_trabajador.php'</script><?
			break;*/
			
			case 'Buscar':
			$bValidateSuccess= true;
			
			if ($_POST['cbCed_afiliado']=="V" or $_POST['cbCed_afiliado']=="E"){
				if (!ereg("^[0-9]{8}$", $_POST['ced_afiliado'])){ 
					$GLOBALS['aPageErrors'][]= "- La Cedula del afiliado: debe tener ocho digitos numericos.";
					$bValidateSuccess=false;
					}	
			      }
			 
			if ($_POST['cbCed_afiliado']=="P"){
				if (!ereg("^[0-9]{10}$", $_POST['ced_afiliado'])){ 
					$GLOBALS['aPageErrors'][]= "- La Cedula del afiliado: debe tener diez digitos numericos.";
					$bValidateSuccess=false;
					}	
			      } 
	      if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;
	        }
		}		
		else{
		LoadData($conn,false);
		}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
    if (!$bPostBack){
  	unset($_SESSION['id_persona']);
		unset($_SESSION['ced_afiliado']);
		unset($_SESSION['apellidos_afiliado']);
		unset($_SESSION['nombre_afiliado']);
		unset($_SESSION['actualiza']);
		unset($_SESSION['registro']);
		unset($_SESSION['migra_bloq']);
		unset($_SESSION['disc_bloq']);
		unset($_SESSION['tipo_persona']);	
//		unset($_SESSION['usuario']);
		$aDefaultForm['ced_afiliado']='';
		}		
else{   
    $_SESSION['tipo_usuario']=2;
		$aDefaultForm['ced_afiliado']=$_POST['ced_afiliado']; 
		$aDefaultForm['cbCed_afiliado']=$_POST['cbCed_afiliado'];
		
		}
	}
} 
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');

					$_POST['cedula']=$_POST['cbCed_afiliado'].$_POST['ced_afiliado'];
				//	print $_POST['cedula'].' cedula';
					
					$SQL = "select *  from personas  
					where cedula ='".$_POST['cedula']."'"; 
					$rs = $conn->Execute($SQL);
					$_SESSION['id_afiliado']=$rs->fields['id'];
					$_SESSION['ced_afiliado']=$rs->fields['cedula']; 
					$sunidadsustantiva=$rs->fields['sunidadsustantiva']; 
					$apellidos_afiliado=$rs->fields['apellidos']; 
					$nombre_afiliado=$rs->fields['nombres']; 
					$_SESSION['afiliado']=($nombre_afiliado.' '.$apellidos_afiliado.'   '.'CI: '.$_SESSION['ced_afiliado']);
					
					if ($rs->RecordCount()>0){
						//	if ($sunidadsustantiva==$_SESSION['sUnidadSustantiva']){
							$_SESSION['actualiza'];
							$_SESSION['tipo_persona']=$_POST['cbCed_afiliado'];
							?><script>if (confirm("- El(La) trabajador(a) ya se encuentra registrado. Desea actualizar los datos?"))
							document.location="1_1agen_trab_datos.php?";</script><?
							}
				   else{	
				   //  $_SESSION['usuario']=$_SESSION['ced_afiliado']=$_POST['cedula'];
					   $_SESSION['tipo_persona']=$_POST['cbCed_afiliado'];	
					   $_SESSION['registro']=1;		      
?><script>if (confirm("- El(La) trabajador(a) No se encuentra registrado(a). Desea registrarlo(a) con el nro. de cedula <?=$_SESSION['ced_afiliado']?>"))
		  if (confirm("- Por favor verifique con el(la) Trabajador(a) si el nro. de cedula <?=$_SESSION['ced_afiliado']?> es correcto antes de registrarlo."))document.location="1_1agen_trab_datos.php?";</script><?
						}
				   
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
}
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>

          <input name="action" type="hidden" value=""/>
          <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
            <tr>
            	<th colspan="2" class="titulo">REGISTRO / ACTUALIZACI&Oacute;N DE TRABAJADORES </th>
            </tr>
            <tr>
            	<th colspan="2" height="25" class="sub_titulo" align="left">Datos Principales: </th>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
            	<td width="45%" height="25"><div align="right" class="">C&eacute;dula de  Identidad:</div></td>
              <td>
                    <select name="cbCed_afiliado" class="tablaborde_shadow">
                        <option value="V" <? if (($aDefaultForm['cbCed_afiliado'])=='V') print 'selected="selected"';?>>V</option>
                        <option value="E" <? if (($aDefaultForm['cbCed_afiliado'])=='E') print 'selected="selected"';?>>E</option>
                    </select>
         <input name="ced_afiliado" type="text" class="tablaborde_shadow" id="ced_afiliado"  onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['ced_afiliado']?>" size="20" maxlength="20" />
               </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><div align="center">
                  <button type="button" name="Buscar"  id="Continuar" class="button"  onClick="javascript:send('Buscar')" value="Aceptar">Aceptar</button>
                  <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
              </div></td>
            </tr>
          </table>
</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":"";
}
?> 

<?php include('../footer.php'); ?>
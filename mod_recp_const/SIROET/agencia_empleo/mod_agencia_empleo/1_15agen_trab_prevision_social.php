<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
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
		    case 'Continuar': 
			$bValidateSuccess=true;	
			
			if ($_POST['cbCotiza']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Esta cotizando actualmente: es requerido.";
					$bValidateSuccess=false;
					 }
					 
		/*	if ($_POST['cbCotiza']=="1"){
					if ($_POST['Numero_cotizaciones']==""){
							$GLOBALS['aPageErrors'][]= "- Numero de cotizaciones: es requerido.";
							$bValidateSuccess=false;
							 }
			}else{
				$_POST['Numero_cotizaciones']="0";
				}*/
				
					if ($_POST['Numero_cotizaciones']==""){
							$_POST['Numero_cotizaciones']="0";
				}
			
			if ($_POST['cbCotiza']=="2"){
					if ($_POST['cbNo_cotiza']=="-1"){
							$GLOBALS['aPageErrors'][]= "- Motivo por el cual no cotiza: es requerido.";
							$bValidateSuccess=false;
							 }
			}else{
				$_POST['cbNo_cotiza']="-1";
				}
				
			if ($_POST['cbCotiza_anterior']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Ha cotizado alguna vez: es requerido.";
					$bValidateSuccess=false;
					 }	
					 
			if ($_POST['cbCotiza_anterior']=="2"){
					if ($_POST['cbNo_cotiza_anterior']=="-1"){
							$GLOBALS['aPageErrors'][]= "- Motivo por el cual no ha cotizado: es requerido.";
							$bValidateSuccess=false;
							 }
			}else{
				$_POST['cbNo_cotiza_anterior']="-1";
				}
			
			if ($_POST['cbSeguir_cotizando']=="2"){   
					if ($_POST['cbNo_seguir_cotiza']=="-1"){
							$GLOBALS['aPageErrors'][]= "- Motivo por el cual no le interesa seguir cotizando: es requerido.";
							$bValidateSuccess=false;
							 }
			}else{
				$_POST['cbNo_seguir_cotiza']="-1";
				}	
				
				
				
			if ($_POST['cbPensionado']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Se encuentra pensionado: es requerido.";
					$bValidateSuccess=false;
					 }	
			
			if ($_POST['cbPensionado']=="1"){
					if ($_POST['cbTipo_pension']=="-1"){
							$GLOBALS['aPageErrors'][]= "- Tipo de pension: es requerido.";
							$bValidateSuccess=false;
							 }
			}else{
				$_POST['cbTipo_pension']="-1";
				}	
		
			if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;	

			case 'Cancelar':
				LoadData($conn,false);	
			break;
		
	        }
		}		
		else{
		LoadData($conn,false);
		}
}		
//------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
	
				$aDefaultForm['cbCotiza']='-1';
				$aDefaultForm['Numero_cotizaciones']='';				
				$aDefaultForm['cbNo_cotiza']='-1';
				$aDefaultForm['cbCotiza_anterior']='-1';
				$aDefaultForm['cbNo_cotiza_anterior']='-1';
				$aDefaultForm['cbSeguir_cotizando']='-1';
				$aDefaultForm['cbNo_seguir_cotiza']='-1';
				$aDefaultForm['cbPensionado']='-1';   
				$aDefaultForm['cbTipo_pension']='-1';  
						        
		if (!$bPostBack){	
		
				$SQL2="select * 
				      from persona_prevision_social
							INNER JOIN personas ON personas.id=persona_prevision_social.persona_id 
							where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
							$rs = $conn->Execute($SQL2);
							$_SESSION['EOF']=$rs->RecordCount();
				 		 if ($rs->RecordCount()>0){ 
							$aDefaultForm['cbCotiza']=$rs->fields['cotiza'];
							$aDefaultForm['Numero_cotizaciones']=$rs->fields['nro_cotizaciones'];
							$aDefaultForm['cbNo_cotiza']=$rs->fields['no_cotiza_id'];
							$aDefaultForm['cbCotiza_anterior']=$rs->fields['cotiza_anterior'];
							$aDefaultForm['cbNo_cotiza_anterior']=$rs->fields['no_cotiza_anterior_id']; 
							$aDefaultForm['cbSeguir_cotizando']=$rs->fields['seguir_cotiza'];
							$aDefaultForm['cbNo_seguir_cotiza']=$rs->fields['no_seguir_cotiza_id']; 
							$aDefaultForm['cbTipo_pension']=$rs->fields['tipo_pension_id'];  
							$aDefaultForm['cbPensionado']=$rs->fields['pension_ivss'];
							}
			}	
		  else{   
		$aDefaultForm['cbCotiza']=$_POST['cbCotiza'];
		$aDefaultForm['Numero_cotizaciones']=$_POST['Numero_cotizaciones'];
		$aDefaultForm['cbNo_cotiza']=$_POST['cbNo_cotiza'];
		$aDefaultForm['cbCotiza_anterior']=$_POST['cbCotiza_anterior'];
		$aDefaultForm['cbNo_cotiza_anterior']=$_POST['cbNo_cotiza_anterior'];
		$aDefaultForm['cbSeguir_cotizando']=$_POST['cbSeguir_cotizando'];
		$aDefaultForm['cbNo_seguir_cotiza']=$_POST['cbNo_seguir_cotiza'];
		$aDefaultForm['cbPensionado']=$_POST['cbPensionado'];  
		$aDefaultForm['cbTipo_pension']=$_POST['cbTipo_pension']; 
		}
	} 
}

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	

//-----------------------------------------------------actualizar------------------------------------------	
	if ((isset($_SESSION['EOF']))){	
			$SQL="select persona_prevision_social.id as persona_prevision_social_id, personas.id 
							from persona_prevision_social 
						  INNER JOIN personas ON personas.id=persona_prevision_social.persona_id 
						  where personas.id ='".$_SESSION['id_afiliado']."'";
						  $rs1 = $conn->Execute($SQL);
				 		  if ($rs1->RecordCount()>0){ 
						  $aDefaultForm['persona_prevision_social_id']=$rs1->fields['persona_prevision_social_id'];
						  $aDefaultForm['id_persona']=$rs1->fields['id'];		
			
			$sql="update persona_prevision_social set 
						cotiza='".$_POST['cbCotiza']."',
						nro_cotizaciones='".$_POST['Numero_cotizaciones']."', 
						no_cotiza_id='".$_POST['cbNo_cotiza']."',			 
						cotiza_anterior='".$_POST['cbCotiza_anterior']."',
						no_cotiza_anterior_id='".$_POST['cbNo_cotiza_anterior']."', 
						seguir_cotiza='".$_POST['cbSeguir_cotizando']."',
						no_seguir_cotiza_id='".$_POST['cbNo_seguir_cotiza']."',
						pension_ivss='".$_POST['cbPensionado']."',  
						tipo_pension_id='".$_POST['cbTipo_pension']."',
			  	  updated_at='".$sfecha."',
			   	  status='A',
			   	  id_update='".$_SESSION['sUsuario']."'
				    WHERE id = '".$aDefaultForm['persona_prevision_social_id']."' and persona_id= '".$_SESSION['id_afiliado']."'";
			  	  $conn->Execute($sql);	
				  }	
//-------------------------------------------------------------------agregar---------------------------------------								
	else{			 		
			 $sql="insert into public.persona_prevision_social
		 		( persona_id, cotiza, nro_cotizaciones, no_cotiza_id, cotiza_anterior, no_cotiza_anterior_id, pension_ivss,
				  tipo_pension_id, seguir_cotiza, no_seguir_cotiza_id, created_at, status, id_update) values
			  	('".$_SESSION['id_afiliado']."',
				 '".$_POST['cbCotiza']."',
				 '".$_POST['Numero_cotizaciones']."',
				 '".$_POST['cbNo_cotiza']."',
				 '".$_POST['cbCotiza_anterior']."',			 
				 '".$_POST['cbNo_cotiza_anterior']."', 
				 '".$_POST['cbPensionado']."',
				 '".$_POST['cbTipo_pension']."',    
				 '".$_POST['cbSeguir_cotizando']."',			 
				 '".$_POST['cbNo_seguir_cotiza']."',
				 '$sfecha',
				 'A',
				 '".$_SESSION['sUsuario']."')";
			$conn->Execute($sql);	
			}
					//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='15';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
//--------------------------------------------------------------------------------------------------------------------------------------				
		}	   
		 ?><script>document.location='1_12agen_trab_foto.php'</script><? 
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="frm_prevision" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
	function send(saction){
	       if(saction=='Continuar'){
		   			if(validar_frm_prevision()==true){
					var form = document.frm_prevision;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_prevision;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>

    <input name="action" type="hidden" value=""/>
    <input name="accion" type="hidden" value="<?=$_POST['accion']?>" />  
   
<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
      <tr>
        <th colspan="3" class="titulo">PREVISI&Oacute;N SOCIAL</th>
      </tr>
      <tr>
      	<th colspan="3" height="25" class="sub_titulo" align="left">Datos de previsi&oacute;n social: </th>
      </tr>
      
      <tr>
        <td width="44%" align="right" >¿Est&aacute; cotizando actualmente a la seguridad social?: </td>
        <td width="56%" colspan="2"><select name="cbCotiza" class="" id="cbCotiza" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbCotiza'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbCotiza'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
        </tr>
         <tr id="tr_si_cotiza">
        <td align="right" >N&uacute;mero de cotizaciones: </td>
        <td colspan="2"><input name="Numero_cotizaciones" type="text" class="tablaborde_shadow" id="Numero_cotizaciones" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['Numero_cotizaciones']?>" size="20" maxlength="20" title="Número de cotizaciones - Ingrese letras y/o numeros"></td>
      </tr>
      	<tr id="tr_no_cotiza">  
        <td align="right" >¿Motivo por el cual no cotiza?: </td>
        <td>
        <select name="cbNo_cotiza" class="tablaborde_shadow" id="cbNo_cotiza" title="No cotiza - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadNo_cotiza($conn); print $GLOBALS['sHtml_cb_No_cotiza'];?>
          </select><span class="requerido"> * </span>
          </td>
      </tr>
      <tr>
        <td align="right" >¿Ha cotizado alguna vez?: </td>
        <td colspan="2"><select name="cbCotiza_anterior" class="" id="cbCotiza_anterior" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbCotiza_anterior'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbCotiza_anterior'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
        </tr>
      	<tr id="tr_no_cotiza_anterior">  
        <td align="right" >¿Motivo por el cual no ha cotizado?: </td>
        <td>
        <select name="cbNo_cotiza_anterior" class="tablaborde_shadow" id="cbNo_cotiza_anterior" title="No ha cotizado - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadNo_cotiza_anterior($conn); print $GLOBALS['sHtml_cb_No_cotiza_anterior'];?>
          </select><span class="requerido"> * </span>
          </td>
      </tr>
      <tr>
      	<td align="right" >¿Est&aacute; usted interesado en seguir cotizando? </td>
        <td colspan="2"><select name="cbSeguir_cotizando" class="" id="cbSeguir_cotizando" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbSeguir_cotizando'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbSeguir_cotizando'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
      </tr>
      <tr id="tr_no_seguir_cotiza">  
        <td align="right" >¿Motivo por el cual no est&aacute; interesado en seguir cotizando?: </td>
        <td>
        <select name="cbNo_seguir_cotiza" class="tablaborde_shadow" id="cbNo_seguir_cotiza" title="No seguir cotizando - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadNo_seguir_cotiza($conn); print $GLOBALS['sHtml_cb_No_seguir_cotiza'];?>
          </select><span class="requerido"> * </span>
          </td>
      </tr>
       <tr>
        <td align="right" >¿Se encuentra usted pensionado (a) por el I.V.S.S?: </td>
        <td colspan="2"><select name="cbPensionado" class="" id="cbPensionado" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbPensionado'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="2" <? if (($aDefaultForm['cbPensionado'])=='2') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> * </span></td>
        </tr>
      	<tr id="tr_tipo_pension">  
        <td align="right" >Tipo de pensi&oacute;n: </td>
        <td>
        <select name="cbTipo_pension" class="tablaborde_shadow" id="cbTipo_pension" title="Tipo de pensión - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadTipo_pension($conn); print $GLOBALS['sHtml_cb_Tipo_pension'];?>
          </select><span class="requerido"> * </span>
          </td>
      </tr>
      <tr>  
        <td height="23" align="right" >&nbsp;</td>
        <td></td>
      </tr>
      <tr>
          <td colspan="2">
		   <div align="center"><span class="requerido">
		   <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
		   <button type="button" name="Cancelar"  id="Cancelar" class="button"  onclick="javascript:send('Cancelar');">Cancelar</button>
	      </span></div></td>
        </tr>
      </table>
        
    <p></div>
</p>
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
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php include('../footer.php'); ?>
<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = true;
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
		print $_SESSION['rif'];
		print $_SESSION['ivss'];
		print $_SESSION['nil'];
		print $_SESSION['nombre_empresa'];
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
				
			case 'Cancelar':
			    LoadData($conn,false);
			break;
					
			case 'Buscar':			     
			LoadData($conn,true);
			break;
			
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['obj_general']==""){
					$GLOBALS['aPageErrors'][]= "- El Objetivo General: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['contenido_1']==""){
					$GLOBALS['aPageErrors'][]= "- El contenido: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['conocimientos']==""){
					$GLOBALS['aPageErrors'][]= "- Los Conocimientos previos: son requeridos.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbColectivo']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Oferta de empleo dirigida a Colectivo de Trabajadores: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbColectivo']=="1"){  
					
			if ($_POST['cbTipo_colectivo']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Tipo de Colectivo: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['direccion']==""){  
					$GLOBALS['aPageErrors'][]= "- La Dirección: son requerida.";
					$bValidateSuccess=false;
					 }
			 if ($_POST['telefono']==""){  
					$GLOBALS['aPageErrors'][]= "- El Teléfono: es requerido.";
					$bValidateSuccess=false;
					 }
				}
			if (!$bValidateSuccess){	
			LoadData($conn,true);	
			}	
			if ($bValidateSuccess){	
			$sfecha=date('Y-m-d');	
			if (isset($_POST["chk_orientacion"])){ $orientacion='1'; }
			else{
				$orientacion='0'; }
			   
			if (isset($_POST["chk_pasantias"])){ $pasantias='1'; }
			else{
				$pasantias='0'; }
				
			if (isset($_POST["chk_colocacion"])){ $colocacion='1'; }
			else{
				$colocacion='0'; }
						
					 
			$sql="update oferta_capacitacion set 
				  obj_general = '".$_POST['obj_general']."',
				  contenido = '".$_POST['contenido_1']."',
				  conocimientos_pre = '".$_POST['conocimientos']."',
				  observaciones = '".$_POST['observaciones']."',
				  colectivo = '".$_POST['cbColectivo']."',
				  colectivos_id = '".$_POST['cbTipo_colectivo']."',
				  direccion = '".$_POST['direccion']."',
				  telefono = '".$_POST['telefono']."',
				  orientacion= '$orientacion',
				  pasantias= '$pasantias',
				  colocacion= '$colocacion',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'"; 	
			  	  $conn->Execute($sql);
				  				  //Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_oferta'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='20';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
				?><script>document.location='?formato=6'</script><?  
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

					$aDefaultForm['obj_general']='';
					$aDefaultForm['contenido_1']='';
					$aDefaultForm['conocimientos']='';
					$aDefaultForm['observaciones']='';
					$aDefaultForm['cbColectivo']='-1';
					$aDefaultForm['cbTipo_colectivo']='-1';
					$aDefaultForm['direccion']='';
					$aDefaultForm['telefono']='';
					$aDefaultForm['chk_orientacion']='';
					$aDefaultForm['chk_pasantias']='';
					$aDefaultForm['chk_colocacion']='';
	if (!$bPostBack){		
		    $SQL="select * From public.oferta_capacitacion where id ='".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 				
					$aDefaultForm['obj_general']=$rs1->fields['obj_general'];
					$aDefaultForm['contenido_1']=$rs1->fields['contenido'];
					$aDefaultForm['conocimientos']=$rs1->fields['conocimientos_pre'];
					$aDefaultForm['observaciones']=$rs1->fields['observaciones'];
					$aDefaultForm['cbColectivo']=$rs1->fields['colectivo'];
					$aDefaultForm['cbTipo_colectivo']=$rs1->fields['colectivos_id'];
					$aDefaultForm['direccion']=$rs1->fields['direccion'];
					$aDefaultForm['telefono']=$rs1->fields['telefono'];
					
					$orientacion=$rs1->fields['orientacion'];
					if ($orientacion=='1'){ $aDefaultForm['chk_orientacion']='checked';}
					else{ $aDefaultForm['chk_orientacion']=''; }
					
					$pasantias=$rs1->fields['pasantias'];
					if ($pasantias=='1'){$aDefaultForm['chk_pasantias']='checked';}
					else{ $aDefaultForm['chk_pasantias']=''; }
					
					$colocacion=$rs1->fields['colocacion'];
					if ($colocacion=='1'){$aDefaultForm['chk_colocacion']='checked';}
					else{ $aDefaultForm['chk_colocacion']=''; }
					} 
				}	
		else{   
					$aDefaultForm['obj_general']=$_POST['obj_general'];
					$aDefaultForm['contenido_1']=$_POST['contenido_1'];
					$aDefaultForm['conocimientos']=$_POST['conocimientos'];
					$aDefaultForm['observaciones']=$_POST['observaciones'];
					$aDefaultForm['cbColectivo']=$_POST['cbColectivo'];
					$aDefaultForm['cbTipo_colectivo']=$_POST['cbTipo_colectivo'];
					$aDefaultForm['direccion']=$_POST['direccion'];
					$aDefaultForm['telefono']=$_POST['telefono']; 
					if (isset($_POST['chk_orientacion'])){$aDefaultForm['chk_orientacion']='checked';}
					else{ $aDefaultForm['chk_orientacion']=''; }
					if (isset($_POST['chk_pasantias'])){$aDefaultForm['chk_pasantias']='checked';}
					else{ $aDefaultForm['chk_pasantias']=''; }
					if (isset($_POST['chk_colocacion'])){$aDefaultForm['chk_colocacion']='checked';}
					else{ $aDefaultForm['chk_colocacion']=''; } 
					}
			}
} 
//------------------------------------------------------------------------------------------------------------------------------
 
function showHeader(){
 include('menu_oferta_cap.php');
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------ 
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="" >
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
          	<td></td>
          </tr>
          <tr>
          	<td></td>
          </tr>
             <tr>
          	<td></td>
          </tr>
          <tr>
          	<td></td>
          </tr>
          <tr>
              <td colspan="2"></td>
          </tr>
          <tr>
          		<th colspan="2" class="sub_titulo" align="left">Otros datos:</th>
          </tr> 
          <tr>
              <td width="44%" align="right">Objetivo General de la actividad: </td>
              <td width="56%"><textarea name="obj_general" cols="28" class="tablaborde_shadow" id="obj_general"><?=$aDefaultForm['obj_general']?></textarea><span class="requerido">*</span></td>
          </tr>
          <tr>
              <td align="right">Contenido de la actividad: </td>
              <td><textarea name="contenido_1" cols="28" class="tablaborde_shadow" id="contenido_1"><?=$aDefaultForm['contenido_1']?></textarea><span class="requerido">*</span></td>
          </tr>          
        <tr>
              <td align="right">Conocimientos previos requeridos: </td>
              <td><textarea name="conocimientos" cols="28" class="tablaborde_shadow" id="conocimientos"><?=$aDefaultForm['conocimientos']?></textarea><span class="requerido">*</span></td>
          </tr>
          <tr>
              <td align="right">Dirigida a Colectivo de Trabajadores: </td>
              <td><a href="javascript:NewCal('dFechaOrden','yyyymmdd')"></a>
              <select name="cbColectivo" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione</option>
              <option value="1" <? if (($aDefaultForm['cbColectivo'])=='1') print 'selected="selected"';?>>Si</option>
              <option value="0" <? if (($aDefaultForm['cbColectivo'])=='0') print 'selected="selected"';?>>No</option>
              </select><span class="requerido">* </span> </td>
          </tr>
          <tr>
              <td align="right">Tipo de Colectivo: </td>
              <td><span class="links-menu-izq">
              <select name="cbTipo_colectivo" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadTipo_colectivo($conn); print $GLOBALS['sHtml_cb_Tipo_colectivo'];?>
              </select></span></td>
          </tr>
          <tr>
              <td align="right">Direcci&oacute;n donde se impartir&aacute; la actividad:</td>
              <td><textarea name="direccion" cols="28" class="tablaborde_shadow" id="direccion"><?=$aDefaultForm['direccion']?>
              </textarea><span class="requerido">* </span></td>
          </tr>
          <tr>
              <td align="right">Tel&eacute;fono de contacto: </td>
              <td><input name="telefono" type="text" class="tablaborde_shadow" id="telefono" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono']?>" size="30" maxlength="11"><span class="requerido">*</span></td>
          </tr>
          <tr>
              <td align="right">La Actividad de Capacitaci&oacute;n incluye servicios de:</td>
              <td> Orientaci&oacute;n               
              <input name="chk_orientacion" type="checkbox" id="chk_orientacion" <?=$aDefaultForm['chk_orientacion']?>>
              Pasant&iacute;as 
              <input type="checkbox" name="chk_pasantias" id="chk_pasantias" <?=$aDefaultForm['chk_pasantias']?>>
              Colocaci&oacute;n
              <input type="checkbox" name="chk_colocacion" id="chk_colocacion" <?=$aDefaultForm['chk_colocacion']?>>          
              </td>
          </tr>
          
          <tr>
              <td align="right">Observaciones:</td>
              <td><textarea name="observaciones" cols="28" class="tablaborde_shadow" id="observaciones"><?=$aDefaultForm['observaciones']?> </textarea></td>
          </tr>
          <tr>
              <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
              <td colspan="2"></td>
          </tr>
          <tr>
              <td colspan="2">
              <div align="center">
          <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button></div></td>
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
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php include('../footer.php'); ?>
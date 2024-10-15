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
		print $_SESSION['rif'];
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
			$sfecha=date('Y-m-d');
			
			if ($_POST['oferta_valida']==""){
					$GLOBALS['aPageErrors'][]= "- Oferta válida hasta: es requerida.";
					$bValidateSuccess=false;
					 }
			 if($_POST['oferta_valida']!=''){
			    list($a,$m,$d)=explode("-", $_POST['oferta_valida']);
				$_POST['oferta_valida']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
					   
				if ($_POST['oferta_valida'] < $sfecha){
					$GLOBALS['aPageErrors'][]= "- Oferta válida hasta: es incorrectas.";
					$bValidateSuccess=false;
				}
			}
					 
			if ($_POST['direccion']==""){
					$GLOBALS['aPageErrors'][]= "- La dirección: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['telefono']==""){
					$GLOBALS['aPageErrors'][]= "- Teléfono de contacto: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['documentos']==""){
					$GLOBALS['aPageErrors'][]= "- Los Documentos requeridos para la entrevista: son requeridos.";
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
				}
			if (!$bValidateSuccess){	
			LoadData($conn,true);	
			}	
			if ($bValidateSuccess){	
			$sfecha=date('Y-m-d');			 
			$sql="update oferta_empleo set 
				  fecha_max = '".$_POST['oferta_valida']."',
				  direccion = '".$_POST['direccion']."',
				  telefono = '".$_POST['telefono']."',
				  documentos = '".$_POST['documentos']."',
				  observaciones = '".$_POST['observaciones']."',
				  colectivo = '".$_POST['cbColectivo']."',
				  colectivo_id = '".$_POST['cbTipo_colectivo']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'"; 	
			  	  $conn->Execute($sql);
			//Trazas-------------------------------------------------------------------------------------------------------------------------------				
					$id=$_SESSION['id_oferta'];
					$identi=$_SESSION['rif'];
					$us=$_SESSION['sUsuario'];
					$mod='18';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);
			  
				 ?><script>document.location='3agen_formato_oferta.php'</script><?  
					
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

					$aDefaultForm['oferta_valida']='';
					$aDefaultForm['direccion']='';
					$aDefaultForm['telefono']='';
					$aDefaultForm['documentos']='';
					$aDefaultForm['observaciones']='';
					$aDefaultForm['cbColectivo']='-1';
					$aDefaultForm['cbTipo_colectivo']='-1';
	if (!$bPostBack){		
		    $SQL="select * From public.oferta_empleo where id ='".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 				
					$aDefaultForm['oferta_valida']=$rs1->fields['fecha_max'];
					$aDefaultForm['direccion']=$rs1->fields['direccion'];
					$aDefaultForm['telefono']=$rs1->fields['telefono'];
					$aDefaultForm['documentos']=$rs1->fields['documentos'];
					$aDefaultForm['observaciones']=$rs1->fields['observaciones'];
					$aDefaultForm['cbColectivo']=$rs1->fields['colectivo'];
					$aDefaultForm['cbTipo_colectivo']=$rs1->fields['colectivo_id'];
					} 
				}	
		else{   
					$aDefaultForm['oferta_valida']=$_POST['oferta_valida'];
					$aDefaultForm['direccion']=$_POST['direccion'];
					$aDefaultForm['telefono']=$_POST['telefono'];
					$aDefaultForm['documentos']=$_POST['documentos']; 
					$aDefaultForm['observaciones']=$_POST['observaciones'];
					$aDefaultForm['cbColectivo']=$_POST['cbColectivo'];
					$aDefaultForm['cbTipo_colectivo']=$_POST['cbTipo_colectivo']; 
					}
			}
} 
//------------------------------------------------------------------------------------------------------------------------------
 
function showHeader(){
 include('menu_oferta_empleo.php');
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
   		 <td colspan="4"></td>
       </tr>
        <tr>
    		<th colspan="4" class="sub_titulo" align="left">Otros datos:</th>
        </tr> 
        <tr>
          <td width="44%"><div align="right"> Oportunidad v&aacute;lida hasta:
           </div></td>
          <td colspan="2">
          <input name="oferta_valida" type="text" class="tablaborde_shadow" id="oferta_valida" value="<?=$aDefaultForm['oferta_valida']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "oferta_valida",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>
          <span class="requerido">* </span></td>
        </tr>
        <tr>
          <td><div align="right"> Direcci&oacute;n de la entrevista: </div></td>
          <td colspan="2"><textarea name="direccion" cols="28" class="tablaborde_shadow" id="direccion"><?=$aDefaultForm['direccion']?></textarea>
          <span class="requerido">* </span></td>
        </tr>
        <tr>
          <td><div align="right"> Tel&eacute;fono de contacto:  </div></td>
          <td colspan="2"><span class="requerido">
            <input name="telefono" type="text" class="tablaborde_shadow" id="telefono" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono']?>" size="30" maxlength="11" />
            * 
          
          </span></td>
        </tr>
        <tr>
          <td><div align="right"> Documentos requeridos para la entrevista:  </div></td>
          <td colspan="2"><textarea name="documentos" cols="28" class="tablaborde_shadow" id="documentos"><?=$aDefaultForm['documentos']?></textarea>
          <span class="requerido">* </span></td>
        </tr>
        <tr>
          <td><div align="right"> Observaciones: </div></td>
          <td colspan="2"><textarea name="observaciones" cols="28" class="tablaborde_shadow" id="observaciones"><?=$aDefaultForm['observaciones']?></textarea></td>
        </tr>
        <tr>
          <td><div align="right"> Oportunidad de trabajo dirigida a Colectivo de Trabajadores:  </div></td>
          <td colspan="2"><a href="javascript:NewCal('dFechaOrden','yyyymmdd')"></a>
            <select name="cbColectivo" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione</option>
              <option value="1" <? if (($aDefaultForm['cbColectivo'])=='1') print 'selected="selected"';?>>Si</option>
              <option value="0" <? if (($aDefaultForm['cbColectivo'])=='0') print 'selected="selected"';?>>No</option>
            </select>
            <span class="requerido">* </span> </td>
        </tr>
        <tr>
          <td><div align="right"> Tipo de colectivo:  </div></td>
          <td colspan="2"><span class="links-menu-izq">
            <select name="cbTipo_colectivo" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadTipo_colectivo($conn); print $GLOBALS['sHtml_cb_Tipo_colectivo'];?>
            </select>
          </span></td>
        </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="4" class="requerido"></td>
        </tr>
        <tr>
          <td colspan="5" class="link-clave-ruee"><div align="center">
          <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button></div></td>
        </tr>
        
        <tr>
          <td class="link-clave-ruee"><div align="right"><a target="new" href="3agen_formato_oferta.php?id_po=<?=$aTabla[$i]['id']?>"></a></div></td>
          <td width="46%" class="link-clave-ruee">&nbsp;</td>
          <td width="10%" class="link-clave-ruee"><div align="center"><a target="new" href="3agen_formato_oferta.php?id_po=<?=$aTabla[$i]['id']?>"><img src="../imagenes/eye.png" width="15" height="16" border="0" title="Ver Oferta"/></a></div></td>
        </tr>
        <tr>
          <td class="link-clave-ruee"><div align="right"><a target="new" href="3agen_formato_oferta.php?id_po=<?=$aTabla[$i]['id']?>"></a><a href="3agen_formato_oferta.php" target="new" class="link-info"></a></div></td>
          <td class="link-clave-ruee">&nbsp;</td>
          <td class="link-clave-ruee"><div align="center"><a href="3agen_formato_oferta.php" target="new" class="links-menu-izq">Ver Oportunidad</a></div></td>
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

<?php //include('../footer.php'); ?>
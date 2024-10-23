<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname_recibos,$username_recibos,$password_recibos,$db4);
$conn1->debug = false;

$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug =false;
$conn1->debug =false;


doAction($conn,$conn1);
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
		var_dump($_SESSION['sesiones']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn,$conn1){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
				
			case 'Culminar':
					unset($_SESSION['nombre_empresa']);
					unset($_SESSION['nil']);
					unset($_SESSION['ivss']);
					unset($_SESSION['rnee']);
					unset($_SESSION['registro']);
					unset($_SESSION['rif']);
					unset($_SESSION['id_empresa']);		
			    LoadData($conn,$conn1,false);
			break;
			

			case 'btRif':
			$bValidateSuccess= true;
			$_SESSION['rif']='';
			$_SESSION['nombre_empresa']='';
			$_SESSION['nil']='';
			$_SESSION['ivss']='';
			$_SESSION['rnee']='';
			unset($_SESSION['registro']);
			$_SESSION['id_empresa']='';
			
			
		   if (!ereg("^[0-9]{8}$", $_POST['Rif'])){ 
					 $GLOBALS['aPageErrors'][]= "- El Rif: debe tener nueve digitos numericos.";
					 $bValidateSuccess=false;
					 }
			 else{
				    $_POST['rif']=$_POST['cbRif'].$_POST['Rif'].$_POST['cbRif1'];
						$_SESSION['rif']=$_POST['rif'];
						$SQL = "select *  from empresa_instituto 
										where rif ='".$_SESSION['rif']."'"; 
										$rs = $conn->Execute($SQL);	
										if ($rs->RecordCount()>0){						        
										$_SESSION['id_empresa']=$rs->fields['id'];
										$_SESSION['nombre_empresa']=$rs->fields['nombre'];  					
					           ?><script>if (confirm("- La empresa ya se encuentra registrada. Desea actualizar los datos?"))
					           document.location="2_1agen_empresa.php?";</script><?
							    }
				          else{
									$SQL = "SELECT srazon_social, srazon_social, snil, sivss, nince
									FROM rnee.rnee_empresa 
									WHERE srif ='".$_SESSION['rif']."'";				
									$rs3 = $conn1->Execute($SQL);										
									if ($rs3->RecordCount()>0){ 
										 $_SESSION['nombre_empresa']=htmlspecialchars($rs3->fields['srazon_social'], ENT_QUOTES);
										 $nil=$rs3->fields['snil'];
										 $ivs=$rs3->fields['sivss'];
										 $inc=$rs3->fields['nince'];
										 $rnee=1;	
										 ?><script>if (confirm("- La empresa se encuentra registrada en el RNET, pero no en SIROET. Desea continuar con el registro?")) document.location="insert_empresa.php?nil=<?=$nil?>&ivs=<?=$ivs?>&rnee=<?=$rnee?>&inc=<?=$inc?>";</script><?	
									 }
								 	 else{
									 $_SESSION['rif']=$_POST['rif'];
									 $_SESSION['nombre_empresa']='';
									 $nil='';
									 $ivs='';
									 $inc='';
									 $rnee=0;
									  ?><script>if (confirm("- Esta empresa no se encuentra registrada ni en SIROET ni en RNET. Desea continuar con el registro?")) document.location="insert_empresa.php?nil=<?=$nil?>&ivs=<?=$ivs?>&rnee=<?=$rnee?>&inc=<?=$inc?>";</script><? 
									 }	
									}
								}
				
			LoadData($conn,$conn1,true);
			break;		
	        }
		}	
		else{
			LoadData($conn,$conn1,false);
		}
}

//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$conn1,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
    if (!$bPostBack){
		unset($_SESSION['nombre_empresa']);
		unset($_SESSION['nil']);
		unset($_SESSION['ivss']);
		unset($_SESSION['rnee']);
		unset($_SESSION['registro']);
		unset($_SESSION['rif']);
		unset($_SESSION['id_empresa']);			
		$aDefaultForm['Rif']='';
		}		
else{   
		$aDefaultForm['Rif']=$_POST['Rif'];
		}
	}
} 
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php');  }
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
          <!-- aqui coloca los valores ocultos de la página --> 
		      
        <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
          <tr>
          	<th class="titulo">REGISTRO ENTIDADES DE TRABAJO</th>
          </tr>
          <tr>
          	<th class="sub_titulo" align="left">Datos del registro: </th>
          </tr> 
            <tr>
              <td>
              <br>
              <br>
              <div align="center"><b>RIF:</b>
                  <select name="cbRif" class="tablaborde_shadow">
                      <option value="J" <? if (($aDefaultForm['cbRif'])=='J') print 'selected="selected"';?>>J</option>
                      <option value="V" <? if (($aDefaultForm['cbRif'])=='V') print 'selected="selected"';?>>V</option>
                      <option value="E" <? if (($aDefaultForm['cbRif'])=='E') print 'selected="selected"';?>>E</option>
                      <option value="G" <? if (($aDefaultForm['cbRif'])=='G') print 'selected="selected"';?>>G</option>
                    </select>
              -
           <input name="Rif" type="text" class="tablaborde_shadow" id="Rif" value="<?=$aDefaultForm['Rif']?>" onKeyPress="return permite(event, 'num')" size="12" maxlength="8" />
              -              
              <select name="cbRif1" class="tablaborde_shadow">
                <option value="0" <? if (($aDefaultForm['cbRif1'])=='0') print 'selected="selected"';?>>0</option>
                <option value="1" <? if (($aDefaultForm['cbRif1'])=='1') print 'selected="selected"';?>>1</option>
                <option value="2" <? if (($aDefaultForm['cbRif1'])=='2') print 'selected="selected"';?>>2</option>
                <option value="3" <? if (($aDefaultForm['cbRif1'])=='3') print 'selected="selected"';?>>3</option>
				<option value="4" <? if (($aDefaultForm['cbRif1'])=='4') print 'selected="selected"';?>>4</option>
                <option value="5" <? if (($aDefaultForm['cbRif1'])=='5') print 'selected="selected"';?>>5</option>
                <option value="6" <? if (($aDefaultForm['cbRif1'])=='6') print 'selected="selected"';?>>6</option>
                <option value="7" <? if (($aDefaultForm['cbRif1'])=='7') print 'selected="selected"';?>>7</option>
				<option value="8" <? if (($aDefaultForm['cbRif1'])=='8') print 'selected="selected"';?>>8</option>
                <option value="9" <? if (($aDefaultForm['cbRif1'])=='9') print 'selected="selected"';?>>9</option>
              </select>
              </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
            
            <tr>
              <td>
                <div align="center">  
                  
    <button type="button" name="btRif"  id="btRif" class="button" onClick="javascript:send('btRif');">Continuar</button>    
    <button type="button" name="Culminar"  id="Culminar" class="button"  onClick="javascript:send('Culminar');">Cancelar</button>
                  
                  
                             
                </div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
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
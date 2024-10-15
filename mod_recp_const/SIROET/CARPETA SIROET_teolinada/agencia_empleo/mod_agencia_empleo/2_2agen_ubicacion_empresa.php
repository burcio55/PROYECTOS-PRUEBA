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
		var_dump( $_SESSION);

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
				
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['cbEstado_empresa']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Actividad Económica: es requerida.";
					$bValidateSuccess=false;
					 }					 
			if ($_POST['cbMunicipio_empresa']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Municipio: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbParroquia_empresa']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Parroquia: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['sector_empresa']==""){
					$GLOBALS['aPageErrors'][]= "- El Sector: es requerido.";
					$bValidateSuccess=false;
					 }		
			if ($_POST['direccion_empresa']==""){
					$GLOBALS['aPageErrors'][]= "- La Dirección: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['telefono_empresa']==""){  
					$GLOBALS['aPageErrors'][]= "- El Teléfono: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['contacto_empresa']==""){  
					$GLOBALS['aPageErrors'][]= "- La Persona de contacto: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cargo_contacto_empresa']==""){  
					$GLOBALS['aPageErrors'][]= "- El Cargo de la Persona de contacto: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['telefono_persona_contacto']==""){  
					$GLOBALS['aPageErrors'][]= "- El Numero de Telefono de la Persona de contacto: es requerido.";
					$bValidateSuccess=false;
			}		 
			if ($_POST['email_empresa']!=""){
		    if(!ereg("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$_POST['email_empresa'])){
				$GLOBALS['aPageErrors'][]= "- El formato de Correo electrónico : es incorrecto.";
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

					$aDefaultForm['cbEstado_empresa']='-1';
					$aDefaultForm['cbMunicipio_empresa']='-1';
					$aDefaultForm['cbParroquia_empresa']='-1';
					$aDefaultForm['sector_empresa']='';
					$aDefaultForm['direccion_empresa']='';
					$aDefaultForm['telefono_empresa']='';
					$aDefaultForm['otro_telefono_empresa']=''; 
					$aDefaultForm['email_empresa']='';
					$aDefaultForm['pag_empresa']='';
					$aDefaultForm['contacto_empresa']='';
					$aDefaultForm['cargo_contacto_empresa']='';
					$aDefaultForm['telefono_persona_contacto']='';
					$aDefaultForm['redes_sociales']='';
										        
	if (!$bPostBack){	

		    $SQL="select * From public.empresa_instituto where id ='".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 				
					$aDefaultForm['cbEstado_empresa']=$rs1->fields['estado_id'];
					$aDefaultForm['sector_empresa']=$rs1->fields['sector'];
					$aDefaultForm['direccion_empresa']=$rs1->fields['direccion'];
					$aDefaultForm['telefono_empresa']=$rs1->fields['telefono'];
					$aDefaultForm['otro_telefono_empresa']=$rs1->fields['otro_telefono'];
					$aDefaultForm['email_empresa']=$rs1->fields['correo'];
					$aDefaultForm['pag_empresa']=$rs1->fields['pag_web'];
					$aDefaultForm['contacto_empresa']=$rs1->fields['persona_contacto'];
					$aDefaultForm['cargo_contacto_empresa']=$rs1->fields['cargo_persona'];
					$aDefaultForm['redes_sociales']=$rs1->fields['redes_sociales'];
					$aDefaultForm['telefono_persona_contacto']=$rs1->fields['telefono_persona_contacto'];
					?>	
					<script language="javascript" src="../js/jquery.js"></script>
					<script>
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['estado_id']; ?>";
					combo="Municipio";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['municipio_id']; ?>" }, 
					function(data){  $("#cbMunicipio_empresa").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['municipio_id']; ?>";
					combo="Parroquia";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['parroquia_id']; ?>" },
					function(data){  $("#cbParroquia_empresa").html(data);
					});            
					});
					
					</script> <?php
					
					}
				}	
		else{   
					$aDefaultForm['cbEstado_empresa']=$_POST['cbEstado_empresa'];
					$aDefaultForm['cbMunicipio_empresa']=$_POST['cbMunicipio_empresa'];
					$aDefaultForm['cbParroquia_empresa']=$_POST['cbParroquia_empresa'];
					$aDefaultForm['sector_empresa']=$_POST['sector_empresa']; 
					$aDefaultForm['direccion_empresa']=$_POST['direccion_empresa'];
					$aDefaultForm['telefono_empresa']=$_POST['telefono_empresa'];
					$aDefaultForm['otro_telefono_empresa']=$_POST['otro_telefono_empresa']; 
					$aDefaultForm['email_empresa']=$_POST['email_empresa']; 
					$aDefaultForm['pag_empresa']=$_POST['pag_empresa'];
					$aDefaultForm['contacto_empresa']=$_POST['contacto_empresa'];
					$aDefaultForm['cargo_contacto_empresa']=$_POST['cargo_contacto_empresa'];
					$aDefaultForm['redes_sociales']=$_POST['redes_sociales'];
					$aDefaultForm['telefono_persona_contacto']=$_POST['telefono_persona_contacto'];
					}
			}
} 
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	
			 
			$sql="update empresa_instituto set 
				  estado_id = '".$_POST['cbEstado_empresa']."',
				  municipio_id = '".$_POST['cbMunicipio_empresa']."',
				  parroquia_id = '".$_POST['cbParroquia_empresa']."',
				  sector = '".$_POST['sector_empresa']."',
				  direccion = '".$_POST['direccion_empresa']."',
				  telefono = '".$_POST['telefono_empresa']."',
				  otro_telefono = '".$_POST['otro_telefono_empresa']."',
				  correo = '".$_POST['email_empresa']."',
				  pag_web = '".$_POST['pag_empresa']."',
				  persona_contacto = '".$_POST['contacto_empresa']."',
				  cargo_persona = '".$_POST['cargo_contacto_empresa']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  redes_sociales= '".$_POST['redes_sociales']."',
				  telefono_persona_contacto= '".$_POST['telefono_persona_contacto']."',
				  status = 'A',
				  WHERE id= '".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'"; 	
			  	  $conn->Execute($sql);
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_empresa'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='14';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
			  ?><script>document.location='2_3agen_otrosdatos_empresa.php'</script><? 
	

}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_empresa.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
  <p>
    <script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}

//Municipio---Parroquia residencia
$(document).ready(function(){
   $("#cbEstado_empresa").change(function () {
           $("#cbEstado_empresa option:selected").each(function () {
            elegido=$(this).val();
			combo='Municipio';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbMunicipio_empresa").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbMunicipio_empresa").change(function () {
           $("#cbMunicipio_empresa option:selected").each(function () {
            elegido=$(this).val();
			combo='Parroquia';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbParroquia_empresa").html(data);
            });            
        });
   })
});
          </script>
    <input name="action" type="hidden" value=""/>

      <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
          <tr>
          	<th colspan="2" class="sub_titulo" align="left">Ubicaci&oacute;n: </th>
          </tr>
        <tr>
	      <td width="41%" height="25"><div align="right" class="">Estado:</div></td>
	      <td width="59%">
        <select name="cbEstado_empresa" id="cbEstado_empresa" class="tablaborde_shadow" title="Estado - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadEstado_empresa($conn) ; print $GLOBALS['sHtml_cb_Estado_empresa']; ?> 
        </select><span class="requerido">*</span></td>
	      </tr>
	    <tr>
	      <td width="41%" height="25"><div align="right" class="">Municipio:</div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbMunicipio_empresa" id="cbMunicipio_empresa" class="" title="Municipio - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
	          </select>
	        </span><span class="requerido"> *</span></td>
	      </tr>
	    <tr>
	      <td width="41%" height="25"><div align="right" class="">Parroquia:</div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbParroquia_empresa" id="cbParroquia_empresa" class="" title="Parroquia - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
	          </select>
	        </span><span class="requerido"> *</span></td>
	      </tr>
        <tr>
          <td><div align="right"> Sector: </div></td>
          <td><textarea name="sector_empresa" cols="28" class="tablaborde_shadow" id="textarea"><?=$aDefaultForm['sector_empresa']?>   </textarea><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Direcci&oacute;n:  </div></td>
          <td><textarea name="direccion_empresa" cols="28" class="tablaborde_shadow" id="textarea"><?=$aDefaultForm['direccion_empresa']?></textarea></td>
        </tr>
        <tr>
          <td><div align="right"> Tel&eacute;fono: </div></td>
          <td><input name="telefono_empresa" type="text" class="tablaborde_shadow" id="telefono_empresa" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_empresa']?>" size="30" maxlength="11" />
              <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Otro tel&eacute;fono: </div></td>
          <td><input name="otro_telefono_empresa" type="text" class="tablaborde_shadow" id="otro_telefono_empresa" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_empresa']?>" size="30" maxlength="11" /></td>
        </tr>
        <tr>
          <td><div align="right"> Correo electr&oacute;nico: </div></td>
          <td><input name="email_empresa" type="text" class="tablaborde_shadow" id="email_empresa" value="<?=$aDefaultForm['email_empresa']?>" size="30" maxlength="30" /></td>
        </tr>
        <tr>
          <td><div align="right"> P&aacute;gina web: </div></td>
          <td><input name="pag_empresa" type="text" class="tablaborde_shadow" id="pag_empresa" value="<?=$aDefaultForm['pag_empresa']?>" size="30" maxlength="30" /></td>
        </tr>
        <tr>
          <td><div align="right"> Persona de contacto: </div></td>
          <td><input name="contacto_empresa" type="text" class="tablaborde_shadow" id="contacto_empresa" onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['contacto_empresa']?>" size="30" maxlength="30" />
              <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Cargo de la persona de contacto: </div></td>
          <td><input name="cargo_contacto_empresa" type="text" class="tablaborde_shadow" id="cargo_contacto_empresa" onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['cargo_contacto_empresa']?>" size="30" maxlength="30" />
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> N&uacute;mero de Telefono de la persona contacto: </div></td>
          <td><input name="telefono_persona_contacto" type="text" class="tablaborde_shadow" id="telefono_persona_contacto" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_persona_contacto']?>" size="30" maxlength="11" />
              <span class="requerido"> *</span></td>
        </tr>
        <tr>
        
          <td><div align="right"> Redes Sociales: </div></td>
          <td><input name="redes_sociales" type="text" class="tablaborde_shadow" id="redes_sociales" onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['redes_sociales']?>" size="30" maxlength="30" />
          
        </tr>
        <tr>
          <td colspan="4" class="requerido"></td>
        </tr>
        <tr>
          <td colspan="4" class="link-clave-ruee"><div align="center"><span class="requerido">
           <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button> 
          </span></div></td>
        </tr>
        
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3" class="link-clave-ruee">&nbsp;</td>
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
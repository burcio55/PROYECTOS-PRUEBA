<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
include('buscar_empresa_rnet.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');

//valor fijo que debe quitarse debe traer el rif del login
$_SESSION['rif']='J401537251';
//$_SESSION['id_empresa']=858;
$_SESSION['sUsuario']= '7512182';
//var_dump($_SESSION);
$conn= getConnDB($db1);
$conn->debug = false;


$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db4); // BD.minpptrasse
$conn1->debug = false;
//var_dump($conn1);
$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname,$username,$password,$db5); // BD.entess
$conn2->debug = false;
//var_dump($conn2);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$aDatos = array();	
$valor=array();
doAction($conn,$conn1,$conn2);
debug();
showHeader();
showForm($conn,$aDefaultForm);
showFooter();
//-------------------------------------------------------------------------------------------------------------------------
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
		var_dump($_SESSION['id_empresa']);
		
	}
}
/*//-------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//---------------------------------------------------------------------------------------------------------------------
function doAction($conn,$conn1,$conn2){
	if (isset($_POST['action'])){
		switch($_POST['action']){
				
			case 'Cancelar':
			    LoadData($conn,$conn1,$conn2,false);
			break;											
			case 'Buscar':			     
			LoadData($conn,$conn1,$conn2,true);
			break;			
			case 'Agregar': 
			$bValidateSuccess=true;	
			if ($_POST['nombre_empresa']==""){
					$GLOBALS['aPageErrors'][]= "- El Nombre de la Empresa o Institución: es requerido.";
					$bValidateSuccess=false;
			 }
					 
		/*	if ($_POST['nil']=="") { 
			   $GLOBALS['aPageErrors'][]= "- El Nil: es requerido.";
			   $bValidateSuccess=false;
			   }
			   
			if ($_POST['ivss']==""){
					$GLOBALS['aPageErrors'][]= "- El Nro. Patronal IVSS: es requerido.";
					$bValidateSuccess=false;
					 }*/
		/*	if ($_POST['inces']==""){
					$GLOBALS['aPageErrors'][]= "- El Nro. de Registro de empresas INCES: es requerido.";
					$bValidateSuccess=false;
					 }*/
		
			if ($_POST['cbAct_economica4']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Actividad Económica: es requerida.";
					$bValidateSuccess=false;
					 }
					 if ($_POST['cbAct_economica3']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Actividad Económica: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbSector_empleo']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Sector empleador: es requerido.";
					$bValidateSuccess=false;
					 }
			
		/*	if ($_POST['capital']==""){  
					$GLOBALS['aPageErrors'][]= "- El Capital accionario: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbCapital']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Capital accionario: es requerido.";
					$bValidateSuccess=false;
					 }*/
			/*if ($_POST['bien_producido']==""){  
					$GLOBALS['aPageErrors'][]= "- Principal bien producido o servicio prestado: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbImparte_capacitacion']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Imparte programa de capacitación a los trabajadores?.";
					$bValidateSuccess=false;
					 }
		     if ($_POST['cbContrata_migrante']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Contrata personal migrante calificado?: es requerido.";
					$bValidateSuccess=false;
					 }
				*/	 
					 
			if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,$conn1,$conn2,true);	
			break;
	        }
		}		
		else{
		LoadData($conn,$conn1,$conn2,false);
		}
			
	}
	
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$conn1,$conn2,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];

					$aDefaultForm['nombre_empresa']='';
					$aDefaultForm['sdenominacion_comercial']='';
					$aDefaultForm['nil']='';
					$aDefaultForm['rif']='';
					$aDefaultForm['ivss']='';
					$aDefaultForm['inces']='';
					$aDefaultForm['cbAct_economica1']='-1';
					$aDefaultForm['cbAct_economica2']='-1';
					$aDefaultForm['cbAct_economica3']='-1';
					$aDefaultForm['cbAct_economica4']='-1';
					$aDefaultForm['act_eco']=''; 
					$aDefaultForm['cbSector_empleo']='-1';
					/*$aDefaultForm['cbPersonalidad_juridica']='-1';
					$aDefaultForm['capital']=''; 
					$aDefaultForm['cbCapital']='-1';
					$aDefaultForm['bien_producido']='';
					$aDefaultForm['cbImparte_capacitacion']='-1';
					$aDefaultForm['cbContrata_migrante']='-1';*/
					
       
	if (!$bPostBack){
			if ($_GET['id_po']!='') $_SESSION['id_empresa']=$_GET['id_po'];	
			if ($_GET['rif']!='') $_SESSION['rif']=$_GET['rif'];
			
			$SQL="select id, nombre,sdenominacion_comercial From public.empresa_instituto where rif='".$_SESSION['rif']."'";
			  $rs1 = $conn->Execute($SQL);
			 
			  if ($rs1->RecordCount()>0){ 
						
				 $_SESSION['id_empresa']=$rs1->fields['id'];
				 $_SESSION['nombre_empresa']=$rs1->fields['nombre'];
			   $_SESSION['sdenominacion_comercial']=$rs1->fields['sdenominacion_comercial'];
			
		    $SQL="select * From public.empresa_instituto where id ='".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 				
					$aDefaultForm['sdenominacion_comercial']=$rs1->fields['sdenominacion_comercial'];
					$aDefaultForm['nombre_empresa']=$rs1->fields['nombre'];
					$aDefaultForm['nil']=$rs1->fields['nil'];
					$aDefaultForm['rif']=$rs1->fields['rif'];
					$aDefaultForm['ivss']=$rs1->fields['ivss'];
					$aDefaultForm['inces']=$rs1->fields['inces'];
					$aDefaultForm['cbAct_economica4']=$rs1->fields['act_economica4'];
					$aDefaultForm['cbSector_empleo']=$rs1->fields['sector_empleo_id'];
					/*$aDefaultForm['capital']=$rs1->fields['capital'];
					$aDefaultForm['cbCapital']=$rs1->fields['tipo_capital'];
					$aDefaultForm['bien_producido']=$rs1->fields['bien_producido'];
					$aDefaultForm['cbImparte_capacitacion']=$rs1->fields['capacitacion'];
					$aDefaultForm['cbContrata_migrante']=$rs1->fields['pers_migrante'];*/
					?>	
					<script language="javascript" src="../js/jquery.js"></script>
					<script>
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['act_economica4']; ?>";
					combo="Actividad";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['act_economica3']; ?>" }, 
					function(data){  $("#cbAct_economica3").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['act_economica3']; ?>";
					combo="Actividad";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['act_economica2']; ?>" },
					function(data){  $("#cbAct_economica2").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['act_economica2']; ?>";
					combo="Actividad";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['act_economica1']; ?>" },                    function(data){  $("#cbAct_economica1").html(data);
					});            
					});
					
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['sector_empleo_id']; ?>";
					combo="Per_juridica";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['p_juridica_id']; ?>" },                    function(data){  $("#cbPersonalidad_juridica").html(data);
					});            
					});					
					</script> <?php					
			}
	}else{// no esta en siroet registrada
	    //echo "estoy aqui";	
				$_SESSION['valor']='';
				$_SESSION['valor']= buscar_datos_empresa_rnet($conn1,$_SESSION['rif']);	
				//var_dump($_SESSION['valor']);
				if($_SESSION['valor']!=''){	
				echo
				$rnee=1;	
				?><script>if (confirm("-  La empresa se encuentra registrada en el RNET, pero no en SIROET. Desea continuar con el registro?")) document.location="?menu=211&rnee=<?=$rnee?>";</script><? 					
				}else{
					$SQL="SELECT * FROM seniat WHERE srif='".$_SESSION['rif']."' AND status='1'";
							$rs = &$conn2->Execute($SQL);
							if ($rs->RecordCount()>0){	
							//echo "es seniat";						
								//$aDefaultForm['rif']=$rs->fields['srif'];
								$_SESSION['nombre_empresa']=htmlspecialchars($rs->fields['srazon_social'], ENT_QUOTES);
								$_SESSION['sdenominacion_comercial']=htmlspecialchars($rs->fields['sdenominacion_comercial'], ENT_QUOTES);
								$nil='NO ESTA INSCRITA EN RNET';
								$ivs='';
								$inc='';
								$dir=$rs->fields['sdireccion_fiscal'];
								$sema=$rs->fields['semail'];
								$deno=htmlspecialchars($rs->fields['sdenominacion_comercial'], ENT_QUOTES);
								$rnee=0;		
					
				?><script>if (confirm("- Esta empresa no se encuentra registrada ni en SIROET ni en RNET. Desea continuar con el registro con los datos del SENIAT?")) document.location="?menu=211&nil=<?=$nil?>&ivs=<?=$ivs?>&rnee=<?=$rnee?>&inc=<?=$inc?>&dir=<?=$dir?>&sema=<?=$sema?>&deno=<?=$deno?>";</script><? 
					}else{
						?><script>alert("- Esta empresa no se encuentra registrada ni en SIROET ni en RNET ni en el SENIAT."); </script><? }
			}			
		}//fin de  
		
	}else{ // si el postback es true  
			$aDefaultForm['nombre_empresa']=$_POST['nombre_empresa'];
			$aDefaultForm['nil']=$_POST['nil'];
			$aDefaultForm['rif']=$_POST['rif'];
			$aDefaultForm['ivss']=$_POST['ivss']; 
			$aDefaultForm['inces']=$_POST['inces'];
			$aDefaultForm['cbAct_economica1']=$_POST['cbAct_economica1'];
			$aDefaultForm['cbAct_economica2']=$_POST['cbAct_economica2'];
			$aDefaultForm['cbAct_economica3']=$_POST['cbAct_economica3'];
			$aDefaultForm['cbAct_economica4']=$_POST['cbAct_economica4'];
			$aDefaultForm['cbSector_empleo']=$_POST['cbSector_empleo']; 
			$aDefaultForm['sdenominacion_comercial']=$_POST['sdenominacion_comercial']; 
	}
	}
} 


//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	

			unset($_SESSION['nombre_empresa']);			 
			$sql="update empresa_instituto set 
				  nombre = '".$_POST['nombre_empresa']."',
				  sdenominacion_comercial = '".$_POST['sdenominacion_comercial']."',
				  rif = '".$_SESSION['rif']."',
				  nil = '".$_POST['nil']."',
				  ivss = '".$_POST['ivss']."',
				  inces = '".$_POST['inces']."',
				  act_economica4 = '".$_POST['cbAct_economica4']."',
				  act_economica3 = '".$_POST['cbAct_economica3']."',
				  sector_empleo_id = '".$_POST['cbSector_empleo']."',				 
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'"; 	

				 
				 /* $sql="update empresa_instituto set 
				  nombre = '".$_POST['nombre_empresa']."',
				  rif = '".$_SESSION['rif']."',
				  nil = '".$_POST['nil']."',
				  ivss = '".$_POST['ivss']."',
				  inces = '".$_POST['inces']."',
				  act_economica1 = '".$_POST['cbAct_economica1']."',
				  act_economica2 = '".$_POST['cbAct_economica2']."',
				  act_economica3 = '".$_POST['cbAct_economica3']."',
				  act_economica4 = '".$_POST['cbAct_economica4']."',
				  sector_empleo_id = '".$_POST['cbSector_empleo']."',
				  p_juridica_id = '".$_POST['cbPersonalidad_juridica']."',
				  capital = '".$_POST['capital']."',
				  tipo_capital = '".$_POST['cbCapital']."',
				  bien_producido = '".$_POST['bien_producido']."',
				  capacitacion = '".$_POST['cbImparte_capacitacion']."',
				  pers_migrante = '".$_POST['cbContrata_migrante']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'"; 	*/
			  	  $conn->Execute($sql);
				  $_SESSION['nombre_empresa']=$_POST['nombre_empresa'];	
				   $_SESSION['sdenominacion_comercial']=$_POST['sdenominacion_comercial'];	
				  
				  
//Trazas--------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_empresa'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='13';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
				?><script>document.location='?menu=22'</script><? 
				
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
include('menu_empresa.php'); 
 ?>

<div class="container" >
 <? }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="" >
  <p>
    <script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}

$(document).ready(function(){
   $("#cbAct_economica4").change(function () {
           $("#cbAct_economica4 option:selected").each(function () {
            elegido=$(this).val();
			combo='Actividad';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbAct_economica3").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbAct_economica3").change(function () {
           $("#cbAct_economica3 option:selected").each(function () {
            elegido=$(this).val();
			combo='Actividad';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbAct_economica2").html(data);
            });            
        });
   })
});  

$(document).ready(function(){
   $("#cbAct_economica2").change(function () {
           $("#cbAct_economica2 option:selected").each(function () {
            elegido=$(this).val();
			combo='Actividad';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbAct_economica1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbSector_empleo").change(function () {
           $("#cbSector_empleo option:selected").each(function () {
            elegido=$(this).val();
			combo='Per_juridica';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbPersonalidad_juridica").html(data);
            });            
        });
   })
}); 

   </script>
    <input name="action" type="hidden" value=""/>
    <input name="nombre_empresa" type="hidden" value="<?=$aDefaultForm['nombre_empresa']?>"/>
      <input name="sdenominacion_comercial" type="hidden" value="<?=$aDefaultForm['sdenominacion_comercial']?>"/>
 
    <input name="nil" type="hidden" value="<?=$aDefaultForm['nil']?>"/>
    <input name="ivss" type="hidden" value="<?=$aDefaultForm['ivss']?>"/>
    <input name="inces" type="hidden" value="<?=$aDefaultForm['inces']?>"/>
 	<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
          
           <tr>
          	<td></td>
          </tr>
          <tr>
          	<td></td>
          </tr>
          <tr>
          	<th colspan="2" class="sub_titulo" align="left">DATOS PRINCIPALES: </th>
          </tr> 
        <tr>
          <td width="41%"><div align="right">Nombre o raz&oacute;n social:</div></td>
          <td width="59%"><input name="nombre_empresa" type="text" class="tablaborde_shadow" id="nombre_empresa" value="<?=$aDefaultForm['nombre_empresa']?>" size="50" maxlength="200" />
          <span class="requerido"> *</span></td>
        </tr>
         <tr>
          <td width="41%"><div align="right">Denominaci&oacute;n Comercial:</div></td>
          <td width="59%"><input name="nombre_empresa" type="text" class="tablaborde_shadow" id="nombre_empresa" value="<?=$aDefaultForm['sdenominacion_comercial']?>" size="50" maxlength="200" />
          <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td width="41%"><div align="right">Nil:</div></td>
          <td><input name="nil" type="text" class="tablaborde_shadow" id="nil" value="<?=$aDefaultForm['nil']?>" size="20" maxlength="20" /></td>
        </tr>
        <tr>
          <td><div align="right">Nro. patronal IVSS: </div></td>
          <td><input name="ivss" type="text" class="tablaborde_shadow" id="ivss" value="<?=$aDefaultForm['ivss']?>" size="20" maxlength="20" />
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right">  Nro.  de aportante INCES:   </div></td>
          <td><input name="inces" type="text" class="tablaborde_shadow" id="inces" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['inces']?>" size="20" maxlength="20" /></td>
        </tr>
        
        
        <tr>
        <td><div align="right">Actividad econ&oacute;mica sub espec&iacute;fica: </div></td>
        <td><select name="cbAct_economica4" id="cbAct_economica4" class="tablaborde_shadow" title="Actividad economica Sub Especifica - Seleccione solo una opcion del listado">
        <option value="-1" selected="selected">Seleccionar</option>
        <? LoadAct_economica4($conn) ; print $GLOBALS['sHtml_cb_Act_economica4']; ?> 
        </select><span class="requerido">*</span></td>
        </tr>
        <tr>
        <td><div align="right">Actividad econ&oacute;mica espec&iacute;fica: </div></td>
        <td><select name="cbAct_economica3" id="cbAct_economica3" class="tablaborde_shadow" title="Actividad economica Especifica - Seleccione solo una opcion del listado">
        <option value="">Seleccionar</option>
        </select><span class="requerido">*</span></td>
        </tr>
      <!--  <tr>
        <td><div align="right">Actividad econ&oacute;mica general: </div></td>
        <td><select name="cbAct_economica2" id="cbAct_economica2" class="tablaborde_shadow" title="Actividad economica General - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select><span class="requerido">*</span></td>
        </tr>
        <tr>
        <td><div align="right">Actividad econ&oacute;mica: </div></td>
        <td><select name="cbAct_economica1" id="cbAct_economica1" class="tablaborde_shadow" title="Actividad economica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select><span class="requerido">*</span></td>
        </tr>
        <tr>-->
          <td><div align="right">  Sector empleador:  </div></td>
          <td><select name="cbSector_empleo" id="cbSector_empleo" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo'];?>
            </select><span class="requerido"> *</span></td>
        </tr>
        <!--
        <tr>
        <td><div align="right">Personalidad jur&iacute;dica: </div></td>
        <td><select name="cbPersonalidad_juridica" id="cbPersonalidad_juridica" class="tablaborde_shadow" title="Personalidad Juridica - Seleccione solo una opcion del listado">
        <option value="-1">Seleccionar</option>
        </select><span class="requerido">*</span></td>
               
        </tr>
        <tr>
          <td><div align="right">  Capital accionario:   </div></td>
          <td><input name="capital" type="text" class="tablaborde_shadow" id="capital" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['capital']?>" size="20" maxlength="15" /> <span class="links-menu-izq">
            <select name="cbCapital" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadCapital($conn); print $GLOBALS['sHtml_cb_Capital'];?>
            </select>
          </span></td>
        </tr>
        <tr>
          <td><div align="right">  Principal bien producido o servicio prestado:   </div></td>
          <td><input name="bien_producido" type="text" class="tablaborde_shadow" id="bien_producido" onkeypress="return permite(event, 'car')" value="<?=$aDefaultForm['bien_producido']?>" size="30" maxlength="30" />
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right">  Imparte programa de capacitaci&oacute;n?:   </div></td>
          <td><select name="cbImparte_capacitacion" class="tablaborde_shadow">
		  <option value="-1" <? if (($aDefaultForm['cbImparte_capacitacion'])=='-1') print 'selected="selected"';?>>Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbImparte_capacitacion'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbImparte_capacitacion'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right">  Contrata personal migrante calificado?:   </div></td>
          <td><select name="cbContrata_migrante" class="tablaborde_shadow">
		  <option value="-1" <? if (($aDefaultForm['cbContrata_migrante'])=='-1') print 'selected="selected"';?>>Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbContrata_migrante'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbContrata_migrante'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">*</span></td>
        </tr>-->
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3" class="requerido"></td>
        </tr>
        <tr>
          <td colspan="4"><div align="center">
          <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button></div></td>
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

<?php // include('../footer.php'); ?>
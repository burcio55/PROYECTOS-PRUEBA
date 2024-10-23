<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
session_start();
include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
include('buscar_empresa_rnet.php');

$conn= getConnDB($db1);

$conn1 = &ADONewConnection($target);
$conn1->PConnect($hostname,$username,$password,$db4); // BD.minpptrasse
$conn1->debug = false;


$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn,$conn1);
debug($settings['debug']=false);
showHeader();
showForm($conn,$conn1,$aDefaultForm);
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
		print $_SESSION['id_proveedor'];
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
function doAction($conn,$conn1){
	if (isset($_POST['action'])){
		switch($_POST['action']){		
				
			case 'Cancelar': 
				LoadData($conn,$conn1,false);	
			break;
				
			case 'Agregar': 
			$bValidateSuccess=true;	
							 
			/*if ($_POST['obreros']==""){
					$GLOBALS['aPageErrors'][]= "- Nro. de Trabajadores: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['empleados']==""){
					$GLOBALS['aPageErrors'][]= "- Nro. de Trabajadoras: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbContratacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Tiene Contratación Colectiva?: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbDelegados_sin']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Tiene Delegados Sindicales?: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbDelegados_pre']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Tiene Delegados de Prevención?: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbConsejo']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Tiene Consejo de Trabajadores?: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbProg_cap']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Presentó Programa de Capacitación?: es requerido.";
					$bValidateSuccess=false;
					 } 	
					 
			if ($_POST['cbProg_cap']=="1"){							 
			if ($_POST['f_prog_cap']!=""){
				$sfecha=date('Y-m-d');	
					if ($_POST['f_prog_cap']>$sfecha){
					$GLOBALS['aPageErrors'][]= "- La Fecha en que Presentó Programa de Capacitación: es incorrecta.";
					$bValidateSuccess=false;
					}
				}
			else{	
				 $GLOBALS['aPageErrors'][]= "- La fecha en que presentó el programa de capacitación?: es requerida.";
				 $bValidateSuccess=false;
					 }
				}	*/	
				if ($_POST['cbsucursales']=="1"){							 
					if ($_POST['cantidad_sucursales']==""){			
					
					$GLOBALS['aPageErrors'][]= "- La cantidad de sucursales: es incorrecta.";
					$bValidateSuccess=false;
				
					}
			/*else{	
				 $GLOBALS['aPageErrors'][]= "- La fecha en que presentó el programa de capacitación?: es requerida.";
				 $bValidateSuccess=false;
					 }*/
			}
		if ($bValidateSuccess){				
				ProcessForm($conn,$conn1);
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

					$aDefaultForm['cbsucursales']='0';
					$aDefaultForm['observaciones']='';
					$aDefaultForm['cantidad_sucursales']="0";

					/*$aDefaultForm['cbsucursales']='0';
					$aDefaultForm['empleados']='';
					$aDefaultForm['obreros']='';
					$aDefaultForm['venezolanos']='';
					$aDefaultForm['extranjeros']='';
					$aDefaultForm['aprendices']=''; 
					$aDefaultForm['discapacitados']='';
					$aDefaultForm['cbContratacion']='-1';
					$aDefaultForm['cbDelegados_sin']='-1';
					$aDefaultForm['cbDelegados_pre']='-1';
					$aDefaultForm['cbConsejo']='-1';	*/	
					$aDefaultForm['cbProg_cap']='-1'; 
					//$aDefaultForm['f_prog_cap']='';		
					//$aDefaultForm['observaciones']='';
					//$aDefaultForm['total']="0";
										        
	if (!$bPostBack){		
		    $SQL="select * From public.empresa_instituto where id ='".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 				
					$aDefaultForm['cbsucursales']=$rs1->fields['sucursales'];
					if($aDefaultForm['cbsucursales']=1){
						$aDefaultForm['cantidad_sucursales']=$rs1->fields['cantidad_sucursales'];
						if($aDefaultForm['cantidad_sucursales']=='1')
							$sucur=buscar_sucursales($conn1,$_SESSION['rif']);
							$str=$sucur;
							$str = explode("|", $str);
							
							$aDefaultForm['cantidad_sucursales']=$str[0];
							$_SESSION['sucursales']=$str[1];
							//var_dump($_SESSION['sucursales']);
						}
					$aDefaultForm['observaciones']=$rs1->fields['observaciones'];
					
					/*$aDefaultForm['empleados']=$rs1->fields['n_empleados'];
					$aDefaultForm['obreros']=$rs1->fields['n_obreros'];
					$aDefaultForm['venezolanos']=$rs1->fields['n_vzln'];
					$aDefaultForm['extranjeros']=$rs1->fields['n_extranjeros'];
					$aDefaultForm['aprendices']=$rs1->fields['n_aprendices'];
					$aDefaultForm['discapacitados']=$rs1->fields['n_discapacitados'];
					$aDefaultForm['cbContratacion']=$rs1->fields['contratacion_col'];
					$aDefaultForm['cbDelegados_sin']=$rs1->fields['delegado_sin'];
					$aDefaultForm['cbDelegados_pre']=$rs1->fields['delegado_pre'];
					$aDefaultForm['cbConsejo']=$rs1->fields['consejo_trab'];*/	
					$aDefaultForm['cbProg_cap']=$rs1->fields['prog_cap']; 
					//$aDefaultForm['f_prog_cap']=$rs1->fields['f_prog_cap'];
					//$aDefaultForm['observaciones']=$rs1->fields['observaciones'];
					//$aDefaultForm['total']=$rs1->fields['n_trabajadores'];
					}
				}	
		else{   
					$aDefaultForm['cbsucursales']=$_POST['cbsucursales'];
					$aDefaultForm['cantidad_sucursales']=$_POST['cantidad_sucursales'];
					$aDefaultForm['observaciones']=$_POST['observaciones'];
					/*$aDefaultForm['empleados']=$_POST['empleados'];
					$aDefaultForm['obreros']=$_POST['obreros']; 
					$aDefaultForm['venezolanos']=$_POST['venezolanos'];
					$aDefaultForm['extranjeros']=$_POST['extranjeros'];
					$aDefaultForm['aprendices']=$_POST['aprendices']; 
					$aDefaultForm['discapacitados']=$_POST['discapacitados']; 
					$aDefaultForm['cbContratacion']=$_POST['cbContratacion'];
					$aDefaultForm['cbDelegados_sin']=$_POST['cbDelegados_sin'];
					$aDefaultForm['cbDelegados_pre']=$_POST['cbDelegados_pre'];
					$aDefaultForm['cbConsejo']=$_POST['cbConsejo']; */
					$aDefaultForm['cbProg_cap']=$_POST['cbProg_cap'];  
					//$aDefaultForm['f_prog_cap']=$_POST['f_prog_cap'];
					//$aDefaultForm['observaciones']=$_POST['observaciones'];
					//$aDefaultForm['total']=$_POST['total'];
					}
			}
}  

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn,$conn1){
$sfecha=date('Y-m-d');

			$_POST['total']=$_POST['empleados']+$_POST['obreros'];
			if($_POST['f_prog_cap']=='') $_POST['f_prog_cap']='0000-00-00';	

//se sustituye empleado=trabajadores obreros=trabajadoras
		 
			$sql="update empresa_instituto set 
				  sucursales = '".$_POST['cbsucursales']."',
				 
				  observaciones = '".$_POST['observaciones']."',
				  cantidad_sucursales = '".$_POST['cantidad_sucursales']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  prog_cap = '".$_POST['cbProg_cap']."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'"; 	

				  /*$sql="update empresa_instituto set 
				  sucursales = '".$_POST['cbsucursales']."',
				  n_empleados = '".$_POST['empleados']."',
				  n_obreros = '".$_POST['obreros']."',
				  n_vzln = '".$_POST['venezolanos']."',
				  n_extranjeros = '".$_POST['extranjeros']."',
				  n_aprendices = '".$_POST['aprendices']."',
				  n_discapacitados = '".$_POST['discapacitados']."',
				  contratacion_col = '".$_POST['cbContratacion']."',
				  delegado_sin = '".$_POST['cbDelegados_sin']."',
				  delegado_pre = '".$_POST['cbDelegados_pre']."',
				  consejo_trab = '".$_POST['cbConsejo']."',
				  prog_cap = '".$_POST['cbProg_cap']."',
				  f_prog_cap= '".$_POST['f_prog_cap']."',
				  observaciones = '".$_POST['observaciones']."',
				  n_trabajadores = '".$_POST['total']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'"; 	*/

			  	  $conn->Execute($sql);
				  
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_empresa'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='15';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
	    	?><script>document.location='?menu=24'</script><?  
}

//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
include('menu_empresa.php'); 
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$conn1,&$aDefaultForm){
?>
<form name="form_otros_datos" method="post" action="" >
<script>
function send(saction){
	var form = document.form_otros_datos;
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
          	<th colspan="2" class="sub_titulo" align="left">OTROS DATOS: </th>
          </tr>
        <tr>
          <td width="44%"><div align="right"> Tiene sucursales?:  </div></td>
          <td width="56%"><select name="cbsucursales" class="tablaborde_shadow">
            <option value="1" <? if (($aDefaultForm['cbsucursales'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbsucursales'])=='2') print 'selected="selected"';?>>No</option>
          </select></td>
        </tr>       
        <tr id="tr_sucursales">      
          <td><div align="right">Cantidad de Sucursales: </div></td>
          <td><input name="cantidad_sucursales" type="text" class="tablaborde_shadow" id="cantidad_sucursales" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['cantidad_sucursales']?>" size="10" maxlength="10" />
            <span class="requerido">*</span></td>
        </tr>
         <tr id="tr_sucursales1">
       
          <td colspan="2">
                <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:50%; ">
                <tr align="center">
                <th width="20%" class="labelListColumn">SUCURSALES</th>
                </tr>
                <tr >
                <td class="texto-normal"><div align="center">
                <? print $_SESSION['sucursales'];?>
                </div></td>               
                </tr>         
                </table>    
     	 </td> 
     	</tr> 
             
         <!--
        <tr>
          <td><div align="right"> N&deg; de trabajadores: </div></td>
          <td><input name="empleados" type="text" class="tablaborde_shadow" id="empleados" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['empleados']?>" size="10" maxlength="10" />
            <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> N&deg; de trabajadoras: </div></td>
          <td><div align="left"> 
            <input name="obreros" type="text" class="tablaborde_shadow" id="obreros" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['obreros']?>" size="10" maxlength="10" />
            <span class="requerido"> *</span>
            Total de Trabajadores(as):
              <?=$aDefaultForm['total']?>
             </div></td>
        </tr>
        <tr>
          <td><div align="right"> N&deg; de venezolanos(as): </div></td>
          <td><input name="venezolanos" type="text" class="tablaborde_shadow" id="venezolanos" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['venezolanos']?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td><div align="right"> N&deg; de extranjeros(as): </div></td>
          <td><input name="extranjeros" type="text" class="tablaborde_shadow" id="extranjeros" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['extranjeros']?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td><div align="right"> N&deg; de aprendices: </div></td>
          <td><input name="aprendices" type="text" class="tablaborde_shadow" id="aprendices" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['aprendices']?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td><div align="right"> N&deg; de trabajadores con discapacidad:  </div></td>
          <td><input name="discapacitados" type="text" class="tablaborde_shadow" id="discapacitados" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['discapacitados']?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td><div align="right"> Tiene contrataci&oacute;n colectiva?: </div></td>
          <td><select name="cbContratacion" class="tablaborde_shadow">
		    <option value="-1" <? if (($aDefaultForm['cbContratacion'])=='-1') print 'selected="selected"';?>>Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbContratacion'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbContratacion'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Tiene delegados sindicales?: </div></td>
          <td><select name="cbDelegados_sin" class="tablaborde_shadow">
		  <option value="-1" <? if (($aDefaultForm['cbDelegados_sin'])=='-1') print 'selected="selected"';?>>Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbDelegados_sin'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbDelegados_sin'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Tiene delegados de prevenci&oacute;n?: </div></td>
          <td><select name="cbDelegados_pre" class="tablaborde_shadow">
		  <option value="-1" <? if (($aDefaultForm['cbDelegados_pre'])=='-1') print 'selected="selected"';?>>Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbDelegados_pre'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbDelegados_pre'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Tiene consejo de trabajadores?: </div></td>
          <td><select name="cbConsejo" class="tablaborde_shadow">
		   <option value="-1" <? if (($aDefaultForm['cbConsejo'])=='-1') print 'selected="selected"';?>>Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbConsejo'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbConsejo'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">*</span></td>
        </tr> -->
        <tr>
          <td><div align="right"> Present&oacute; programa de capacitaci&oacute;n?:  </div></td>
          <td><select name="cbProg_cap" class="tablaborde_shadow">
		  <option value="-1" <? if (($aDefaultForm['cbProg_cap'])=='-1') print 'selected="selected"';?>>Seleccione...</option>
            <option value="1" <? if (($aDefaultForm['cbProg_cap'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbProg_cap'])=='0') print 'selected="selected"';?>>No</option>
          </select>
          <span class="requerido">*</span> 
          <!--
           Fecha:    
          <input name="f_prog_cap" type="text" class="tablaborde_shadow" id="f_prog_cap" value="<?=$aDefaultForm['f_prog_cap']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_prog_cap",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>	<span class="requerido">*</span>  
         </td>
        </tr>
        -->
        <tr>
          <td><div align="right"> Observaciones:  </div></td>
          <td><textarea name="observaciones" cols="28" class="tablaborde_shadow" id="observaciones"><?=$aDefaultForm['observaciones']?></textarea></td>
        </tr>
        <tr>
          <td colspan="4" class="requerido"></td>
        </tr>
        <tr>
          <td colspan="4"><div align="center"><button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
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

<?php //include('../footer.php'); ?>
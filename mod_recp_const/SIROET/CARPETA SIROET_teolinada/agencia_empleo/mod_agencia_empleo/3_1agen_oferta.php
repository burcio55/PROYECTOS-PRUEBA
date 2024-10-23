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
		var_dump($_SESSION['registro']);
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
					
			case 'cbOcupacion5_interes_1_changed':			    
				$SQL="select * From public.persona_oferta_empleo where oferta_id='".$_SESSION['id_oferta']."'";
				$rs1 = $conn->Execute($SQL);
				if ($rs1->RecordCount()>0){ 	
				    $GLOBALS['aPageErrors'][]= "- La Ocupación no se puede actualizar, ya que esta Oportunidad de Empleo tiene Trabajadores postulados.";
					 $bValidateSuccess=false;
					 LoadData($conn,false);
					 }	
				else{
				  LoadData($conn,true);
				 }
			break;
				
			case 'Agregar': 
			$bValidateSuccess=true;	
			
			if ($_POST['cbOcupacion5_interes_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación Detalle: es requerida.";
				$bValidateSuccess=false;
				}
			if ($_POST['plazas']==""){
				$GLOBALS['aPageErrors'][]= "- El Nro. vacantes: es requerido.";
				$bValidateSuccess=false;
				}
			else{
				if($_POST['plazas'] < $_POST['plazas_disponibles']){
				    $GLOBALS['aPageErrors'][]= "- El Nro. vacantes: debe ser mayor al nro. de vacantes disponibles.";
					$bValidateSuccess=false;
					 }
				 }
					 
	/*		if ($_POST['plazas_disponibles']==""){
					$GLOBALS['aPageErrors'][]= "- El Nro. vacantes disponibles: es requerido.";
					$bValidateSuccess=false;
					 }*/
		
			if ($_POST['cbTipo_salario']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Tipo de salario: es requerido.";
					$bValidateSuccess=false;
					 }
			/*if ($_POST['salario']==""){  
					$GLOBALS['aPageErrors'][]= "- El Salario simple: es requerido.";
					$bValidateSuccess=false;
					 }*/
			if ($_POST['cbTipo_contrato']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Tipo de contrato: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbTipo_jornada']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Tipo de jornada: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['duracion']==""){  
					$GLOBALS['aPageErrors'][]= "- La Duración: es requerida";
					$bValidateSuccess=false;
					 }
		     if ($_POST['funciones']==""){  
					$GLOBALS['aPageErrors'][]= "- Las Funciones: son requeridas.";
					$bValidateSuccess=false;
					 }
					 
			if (!$bValidateSuccess){	
			LoadData($conn,true);	
			}	
			if ($bValidateSuccess){	
			$sfecha=date('Y-m-d');	
			
			if($_POST['plazas_disponibles']=='')$_POST['plazas_disponibles']=$_POST['plazas'];	 
			$sql="update oferta_empleo set 
				  ocupacion1 = '".$_POST['cbOcupacionG_interes_1']."',
				  ocupacion2 = '".$_POST['cbOcupacionE_interes_1']."',
				  ocupacion3 = '".$_POST['cbOcupacion3_interes_1']."',
				  ocupacion4 = '".$_POST['cbOcupacion4_interes_1']."',
				  ocupacion5 = '".$_POST['cbOcupacion5_interes_1']."',
				  plazas = '".$_POST['plazas']."',
				  plazas_disponibles = '".$_POST['plazas_disponibles']."',
				  tipo_salario_id = '".$_POST['cbTipo_salario']."',
				  tipo_contratacion_id = '".$_POST['cbTipo_contrato']."',
				  turno_jornada_id = '".$_POST['cbTipo_jornada']."',
				  duracion = '".$_POST['duracion']."',
				  funciones = '".$_POST['funciones']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'"; 	
				  
				  
				  /*$sql="update oferta_empleo set 
				  ocupacion1 = '".$_POST['cbOcupacionG_interes_1']."',
				  ocupacion2 = '".$_POST['cbOcupacionE_interes_1']."',
				  ocupacion3 = '".$_POST['cbOcupacion3_interes_1']."',
				  ocupacion4 = '".$_POST['cbOcupacion4_interes_1']."',
				  ocupacion5 = '".$_POST['cbOcupacion5_interes_1']."',
				  plazas = '".$_POST['plazas']."',
				  plazas_disponibles = '".$_POST['plazas_disponibles']."',
				  tipo_salario_id = '".$_POST['cbTipo_salario']."',
				  salario = '".$_POST['salario']."',
				  tipo_contratacion_id = '".$_POST['cbTipo_contrato']."',
				  turno_jornada_id = '".$_POST['cbTipo_jornada']."',
				  duracion = '".$_POST['duracion']."',
				  funciones = '".$_POST['funciones']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'"; */	
			  	  $conn->Execute($sql);
				 //Trazas--------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_oferta'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='16';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				  
			   ?><script>document.location='3_2agen_condicion_oferta.php'</script><?  
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

					$aDefaultForm['cbOcupacionG_interes_1']='-1';
					$aDefaultForm['cbOcupacionE_interes_1']='-1';
					$aDefaultForm['cbOcupacion3_interes_1']='-1';
					$aDefaultForm['cbOcupacion4_interes_1']='-1';
					$aDefaultForm['cbOcupacion5_interes_1']='-1';
					$aDefaultForm['plazas']='';
					$aDefaultForm['plazas_disponibles']='';
					$aDefaultForm['cbAct_economica']='-1';
					$aDefaultForm['cbTipo_salario']='-1';
					$aDefaultForm['salario']='';
					$aDefaultForm['cbTipo_contrato']='-1';
					$aDefaultForm['cbTipo_jornada']='-1'; 
					$aDefaultForm['duracion']='';
					$aDefaultForm['funciones']='';
					
					
					if ($_SESSION['registro']!=''){
					  $sfecha=date('Y-m-d');
					  $sql="insert into oferta_empleo (empresa_id, created_at, status, id_update) values
					  ('".$_SESSION['id_empresa']."',
					   '$sfecha',
					   'A',
					   '".$_SESSION['sUsuario']."')";
					   $conn->Execute($sql);
					   
					   $SQL="select max(id) from oferta_empleo 
					  where empresa_id='".$_SESSION['id_empresa']."' and created_at ='$sfecha'";
					  $rs1 = $conn->Execute($SQL);
					  if ($rs1->RecordCount()>0){ 				
					  $_SESSION['id_oferta']=$rs1->fields['max']; 					   
					   //Trazas---------------------------------------------------------------------------------------------------------------------------				
						
						$id=$_SESSION['id_oferta'];
						$identi=$_SESSION['rif'];
						$us=$_SESSION['sUsuario'];
						$mod='16';			    
						$auditoria= new Trazas; 
						$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
					   unset($_SESSION['registro']);
			   
					  }				   	   
			      }
        
	if (!$bPostBack){	
	
	    if ($_GET['id_po']!='') $_SESSION['id_oferta']=$_GET['id_po'];
			if ($_GET['id_emp']!='') $_SESSION['id_empresa']=$_GET['id_emp'];
		    
				$SQL="select * From public.oferta_empleo where id ='".$_SESSION['id_oferta']."' 
			      and empresa_id='".$_SESSION['id_empresa']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 			
					$aDefaultForm['cbOcupacion5_interes_1']=$rs1->fields['ocupacion5'];
					?>
				<script language="javascript" src="../js/jquery-1.2.6.min.js"></script>
				<script>
				$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion5'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion4']; ?>" }, 
					function(data){  $("#cbOcupacion4_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion4'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion3']; ?>" }, 
					function(data){  $("#cbOcupacion3_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion3'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion2']; ?>" }, 
					function(data){  $("#cbOcupacionE_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion2'] ?>";
					combo="Ocupacion";
					$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion1']; ?>" }, 
					function(data){  $("#cbOcupacionG_interes_1").html(data);
				   });            
				});
				</script>
				<?php
					$aDefaultForm['plazas']=$rs1->fields['plazas'];
					$aDefaultForm['plazas_disponibles']=$_POST['plazas_disponibles']=$rs1->fields['plazas_disponibles'];
					$aDefaultForm['cbTipo_salario']=$rs1->fields['tipo_salario_id'];
					$aDefaultForm['salario']=$rs1->fields['salario'];
					$aDefaultForm['cbTipo_contrato']=$rs1->fields['tipo_contratacion_id'];
					$aDefaultForm['cbTipo_jornada']=$rs1->fields['turno_jornada_id'];
					$aDefaultForm['duracion']=$rs1->fields['duracion'];
					$aDefaultForm['funciones']=$rs1->fields['funciones'];
									
					} 
				}	
		else{   
					$aDefaultForm['cbOcupacionG_interes_1']=$_POST['cbOcupacionG_interes_1']; 
					$aDefaultForm['cbOcupacionE_interes_1']=$_POST['cbOcupacionE_interes_1']; 
					$aDefaultForm['cbOcupacion3_interes_1']=$_POST['cbOcupacion3_interes_1'];
					$aDefaultForm['cbOcupacion4_interes_1']=$_POST['cbOcupacion4_interes_1'];
					$aDefaultForm['cbOcupacion5_interes_1']=$_POST['cbOcupacion5_interes_1'];
					$aDefaultForm['plazas']=$_POST['plazas'];
					$aDefaultForm['plazas_disponibles']=$_POST['plazas_disponibles'];
					$aDefaultForm['cbTipo_salario']=$_POST['cbTipo_salario'];
					$aDefaultForm['salario']=$_POST['salario'];
					$aDefaultForm['cbTipo_contrato']=$_POST['cbTipo_contrato']; 
					$aDefaultForm['cbTipo_jornada']=$_POST['cbTipo_jornada']; 
					$aDefaultForm['duracion']=$_POST['duracion'];
					$aDefaultForm['funciones']=$_POST['funciones'];
					}
			}
} 
//------------------------------------------------------------------------------------------------------------------------------
 
 function showHeader(){
 include('../header.php'); 
 include('menu_oferta_empleo.php');
}
//------------------------------------------------------------------------------------------------------------------------------ 
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>

<script language="javascript">
//Ocupacion 1
$(document).ready(function(){
   $("#cbOcupacion5_interes_1").change(function () {
           $("#cbOcupacion5_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbOcupacion4_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion4_interes_1").change(function () {
           $("#cbOcupacion4_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacion3_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion3_interes_1").change(function () {
           $("#cbOcupacion3_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionE_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacionE_interes_1").change(function () {
           $("#cbOcupacionE_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionG_interes_1").html(data);
            });            
        });
   })
});
</script>

  <input name="action" type="hidden" value=""/>
	<input name="plazas_disponibles" type="hidden" value="<?=$_POST['plazas_disponibles']?>"/>


        <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
   		 <td colspan="2"></td>
       </tr>
        <tr>
    		<th colspan="2" class="sub_titulo" align="left">Datos principales:</th>
        </tr> 
        <tr>
          <td><div align="right"> Ocupación Detalle: </div></td>
          <td width="59%"><select name="cbOcupacion5_interes_1" id="cbOcupacion5_interes_1" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadOcupacion5_interes_1($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_interes_1']; ?>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Ocupaci&oacute;n Sub Especifica:  </div></td>
          <td><select name="cbOcupacion4_interes_1" id="cbOcupacion4_interes_1" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
       <!-- <tr>
          <td><div align="right"> Ocupaci&oacute;n Específica:  </div></td>
          <td><select name="cbOcupacion3_interes_1" id="cbOcupacion3_interes_1" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Ocupaci&oacute;n General:  </div></td>
          <td><select name="cbOcupacionE_interes_1" id="cbOcupacionE_interes_1" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Ocupación: </div></td>
          <td><select name="cbOcupacionG_interes_1" id="cbOcupacionG_interes_1" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>-->
        <tr>
          <td width="41%"><div align="right"> N&uacute;m. de vacantes: </div></td>
          <td width="59%"><input name="plazas" type="text" class="tablaborde_shadow" id="plazas" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['plazas']?>" size="10" maxlength="5" />
          <span class="requerido"> * </span>  Disponibles: <?=$aDefaultForm['plazas_disponibles']?>  </td>
        </tr>
        <tr>
          <td><div align="right"> Tipo de salario:  </div></td>
          <td><span class="links-menu-izq">
            <select name="cbTipo_salario" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadTipo_salario($conn); print $GLOBALS['sHtml_cb_Tipo_salario'];?>
            </select>
          </span></td>
        </tr>
        <!--<tr>
          <td><div align="right"> Salario normal: </div></td>
          <td><span class="links-menu-izq">
            <input name="salario" type="text" class="tablaborde_shadow" id="salario" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['salario']?>" size="10" maxlength="6" />
          <span class="requerido"> *</span></span></td>
        </tr>-->
        <tr>
          <td><div align="right"> Tipo de contrataci&oacute;n:  </div></td>
          <td><span class="links-menu-izq">
            <select name="cbTipo_contrato" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadTipo_contrato($conn); print $GLOBALS['sHtml_cb_Tipo_contrato'];?>
            </select>
          </span></td>
          </tr>
        <tr>
          <td><div align="right"> Duración de  Contratación (Meses):  </div></td>
          <td><span class="links-menu-izq"><span class="requerido"> 
            <input name="duracion" type="text" class="tablaborde_shadow" id="duracion" value="<?=$aDefaultForm['duracion']?>" size="30" maxlength="30" />
          *</span></span></td>
        </tr>
        <tr>
          <td><div align="right"> Tipo de jornada:  </div></td>
          <td><span class="links-menu-izq">
            <select name="cbTipo_jornada" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadTipo_jornada($conn); print $GLOBALS['sHtml_cb_Tipo_jornada'];?>
            </select>
          </span><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Indique las funciones, tareas y manejo de herramientas necesarias para este trabajo:  </div></td>
          <td><span class="requerido"><textarea name="funciones" cols="45" class="tablaborde_shadow" id="funciones"><?=$aDefaultForm['funciones']?></textarea></span><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3" class="requerido"></td>
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
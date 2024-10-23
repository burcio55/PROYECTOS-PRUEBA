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
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
	case 'Culminar':
			unset($_SESSION['rif']);
			unset($_SESSION['nombre_empresa']);
			unset($_SESSION['registro']);
			unset($_SESSION['id_oferta']);
			unset($_SESSION['aTabla']);
		LoadData($conn,false);
	break;
	
	case 'Agregar':
	if (isset($_SESSION['id_empresa'])){
		$_SESSION['registro']='1';
		?><script>document.location='4_1agen_capacitacion.php'</script><? 
		} 
		else{
		 $GLOBALS['aPageErrors'][]= "- Debe colocar el núm. de Rif y presionar Aceptar.";
		}
	break;
			
	case 'btRif':
	$bValidateSuccess= true;
			unset($_SESSION['rif']);
			unset($_SESSION['id_empresa']);
			unset($_SESSION['nombre_empresa']);
			unset($_SESSION['registro']);
			unset($_SESSION['id_oferta']);
			unset($_SESSION['aTabla']);
			
			
	   if (!ereg("^[0-9]{8}$", $_POST['Rif'])){ 
			   $GLOBALS['aPageErrors'][]= "- El Rif: debe tener nueve digitos numericos.";
			   $bValidateSuccess=false;
			   }
	    else{
		    $_POST['rif']=$_POST['cbRif'].$_POST['Rif'].$_POST['cbRif1'];
			$SQL = "select *  from empresa_instituto 
					where rif ='".$_POST['rif']."'"; 
					$rs = $conn->Execute($SQL);							        
					if ($rs->RecordCount()>0){
					   $capacitacion=$rs->fields['capacitacion'];
					   if ($capacitacion=='1'){
					   $_SESSION['id_empresa']=$rs->fields['id'];
					   $_SESSION['rif']=$rs->fields['rif'];
					   $_SESSION['nombre_empresa']=$rs->fields['nombre'];			   					
			 
			$SQL1="select ocupacion.nombre as ocupacion, 
					turno_jornada.nombre as turno,
					curso.nombre as curso, categoria_curso.nombre as categoria,
					colectivos.nombre as colectivos,
					oferta_capacitacion.id as id_oferta, oferta_capacitacion.f_inicio,
					oferta_capacitacion.f_culminacion, oferta_capacitacion.horario_desde,
					oferta_capacitacion.horario_hasta, oferta_capacitacion.cupos, oferta_capacitacion.cupos_disponibles,
					oferta_capacitacion.status
					From public.oferta_capacitacion 
					inner join empresa_instituto on empresa_instituto.id=oferta_capacitacion.empresa_id
					left JOIN ocupacion ON ocupacion.cod=oferta_capacitacion.ocupacion2
					left JOIN turno_jornada ON turno_jornada.id=oferta_capacitacion.turno_jornada_id
					left JOIN curso ON curso.id=oferta_capacitacion.curso_id
					left JOIN categoria_curso ON categoria_curso.id=oferta_capacitacion.curso_categoria_id
					left JOIN colectivos ON colectivos.id=oferta_capacitacion.colectivos_id
					where empresa_id ='".$_SESSION['id_empresa']."' and empresa_instituto.rif='".$_SESSION['rif']."'  
					order by oferta_capacitacion.id";
				$rs1 = $conn->Execute($SQL1);			
				if ($rs1->RecordCount()>0){	
					$aTabla=array();
					while(!$rs1->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['id']=$rs1->fields['id_oferta']; 
						if ($rs1->fields['ocupacion']=='No tiene'){
						   $aTabla[$c]['ocupacion']='Todas';
							}
						else{
						$aTabla[$c]['ocupacion']=$rs1->fields['ocupacion'];
						 }
						$aTabla[$c]['turno']=$rs1->fields['turno']; 
						$aTabla[$c]['curso']=$rs1->fields['curso'];
						$aTabla[$c]['categoria']=$rs1->fields['categoria'];
						$aTabla[$c]['colectivos']=$rs1->fields['colectivos'];	
						$aTabla[$c]['duracion']=$rs1->fields['duracion']; 
						$aTabla[$c]['f_inicio']=$rs1->fields['f_inicio'];
						$aTabla[$c]['f_culminacion']=$rs1->fields['f_culminacion'];
						$aTabla[$c]['horario_desde']=$rs1->fields['horario_desde'];
						$aTabla[$c]['horario_hasta']=$rs1->fields['horario_hasta'];
						$aTabla[$c]['cupos']=$rs1->fields['cupos'];	
						$aTabla[$c]['cupos_disponibles']=$rs1->fields['cupos_disponibles'];
						$aTabla[$c]['status']=$rs1->fields['status'];
						$rs1->MoveNext();
						}
			            $_SESSION['aTabla'] = $aTabla;	
			            }
			     else{
			       $_SESSION['registro']='1';
				   ?><script>if (confirm("- Esta empresa no tiene Oportunidades de Capacitación asociadas. Desea agregar una?"))
					document.location="4_1agen_capacitacion.php?";
					else document.location="4_0agen_registro_capacitacion.php?"
					</script><?
				   }
				   }  
		    	else{
					$GLOBALS['aPageErrors'][]= "- Esta empresa no imparte programa de capacitación.";
					$bValidateSuccess=false;
					}	  
			   	  
				}
					else{
					$GLOBALS['aPageErrors'][]= "- Esta empresa no se encuentra registrada.";
					$bValidateSuccess=false;
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
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
$aDefaultForm = &$GLOBALS['aDefaultForm'];
$aDefaultForm['rif']='';
if (!$bPostBack){
			unset($_SESSION['rif']);
			unset($_SESSION['id_empresa']);
			unset($_SESSION['nombre_empresa']);
			unset($_SESSION['registro']);
			unset($_SESSION['id_oferta']);
			unset($_SESSION['aTabla']);
			$aDefaultForm['Rif']='';
	  }
	else{
	$aDefaultForm['Rif']=$_POST['Rif']; 
	$aDefaultForm['cbRif']=$_POST['cbRif']; 
	$aDefaultForm['cbRif1']=$_POST['cbRif1']; 	
	}
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

  <!-- aqui coloca los valores ocultos de la página -->
 <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
    		<th colspan="2" class="titulo">REGISTRO DE OPORTUNIDADES DE CAPACITACI&Oacute;N</th>
    </tr>
    <tr>
    		<th colspan="2" class="sub_titulo" align="left">Datos de la entidades de trabajo: </th>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center"><b>RIF:</b>
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
      <td><div align="center">
          <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('btRif');">Aceptar</button>
	          <button type="button" name="Culminar"  id="Culminar" class="button"  onClick="javascript:send('Culminar');">Cancelar</button></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
    <tr>
      <td colspan="13"><div align="right"><button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Registrar oportunidad de capacitaci&oacute;n</button></div></td>
    </tr>
    <tr>
      <th width="4%" class="labelListColumn">Nro.</th>
      <th width="14%" class="labelListColumn">Categoria </th>
      <th width="15%" class="labelListColumn">Oportunidad de capacitaci&oacute;n </th>
      <th width="15%" class="labelListColumn">Ocupaci&oacute;n</th>
      <th width="4%" class="labelListColumn">Cupos</th>
      <th width="6%" class="labelListColumn">Cupos disponibles</th>
      <th width="6%" class="labelListColumn">Inicia </th>
      <th width="7%" class="labelListColumn">Culmina </th>
      <th width="6%" class="labelListColumn">Horario</th>
      <th width="6%" class="labelListColumn">Jornada</th>
      <th width="8%" class="labelListColumn">Colectivos</th>
      <th width="4%" class="labelListColumn">Status</th>
      <th width="5%" class="labelListColumn"></th>
    </tr>
    <?
	$aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $i=0; $i<count($aTabla); $i++){
		if (($i%2) == 0) $class_name = "dataListColumn2";
		else $class_name = "dataListColumn";
		?>
    <tr class="<?=$class_name?>">
      <td class="texto-normal"><div align="left"><b>
          <?=$aTabla[$i]['id']?>
      </b> </div></td>
      <td class="texto-normal"><div align="left">
          <?=$aTabla[$i]['categoria']?>
      </div></td>
      <td class="texto-normal"><div align="left">
          <?=$aTabla[$i]['curso']?>
      </div></td>
      <td class="texto-normal"><div align="left">
        <?=$aTabla[$i]['ocupacion']?>
      </div></td>
      <td class="texto-normal"><div align="left">
          <?=$aTabla[$i]['cupos']?>
      </div></td>
      <td class="texto-normal"><div align="left">
          <?=$aTabla[$i]['cupos_disponibles']?>
      </div></td>
      <td class="texto-normal"><div align="left">
        <?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_inicio']))?>
      </div></td>
      <td class="texto-normal"><div align="left">
        <?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_culminacion']))?>
      </div></td>
      <td class="texto-normal"><div align="left">
          <?=$aTabla[$i]['horario_desde']?> <?=$aTabla[$i]['horario_hasta']?>
      </div></td>
      <td class="texto-normal"><div align="left">
        <?=$aTabla[$i]['turno']?>
      </div></td>
      <td class="texto-normal"><div align="left">
          <?=$aTabla[$i]['colectivos']?>
            </div></td>
      <td class="texto-normal"><div align="left">
          <?=$aTabla[$i]['status']?>
      </div></td>
      <td class="texto-normal"><a target="new" href="4agen_formato_capacitacion.php?id_po=<?=$aTabla[$i]['id']?>"><img src="../imagenes/eye.png" width="12" height="12" border="0" title="Ver Oferta"/></a><a href="4_1agen_capacitacion.php?id_po=<?=$aTabla[$i]['id']?>"><img src="../imagenes/b_edit.png" width="12" height="12" border="0" title="Editar" /></a></td>
    </tr>
    <? } ?>
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
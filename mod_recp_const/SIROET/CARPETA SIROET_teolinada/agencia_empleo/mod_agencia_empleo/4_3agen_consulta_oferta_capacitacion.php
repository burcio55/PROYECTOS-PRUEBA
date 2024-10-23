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
		//	unset($_SESSION['rif']);
		//	unset($_SESSION['nombre_empresa']);
			unset($_SESSION['aTabla']);
		LoadData($conn,false);
	break;
			
				case 'btRif':
				unset($_SESSION['where']);
				$bValidateSuccess= true;
			//	unset($_SESSION['rif']);
			//	unset($_SESSION['nombre_empresa']);		
					
			 	
			   if ($_POST['Rif']!="" ){
				   if (!ereg("^[0-9]{8}$", $_POST['Rif'])){ 
				   $GLOBALS['aPageErrors'][]= "- El Rif: debe tener nueve digitos numericos.";
				   $bValidateSuccess=false;
			       }
			   		else{
					$_POST['rif']=$_POST['cbRif'].$_POST['Rif'].$_POST['cbRif1'];
					$_SESSION['where'].= " and empresa_instituto.rif = '".$_POST['rif']."'";   
					$bValidateSuccess=true;
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

if (!$bPostBack){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
		unset($_SESSION['aTabla']);
		unset($_SESSION['where']);	
		$aDefaultForm['rif']='';
	  }
	else{
	$aDefaultForm['rif']=$_POST['rif']; 
	
	}
  }
} 
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$SQL1="select 
					oferta_capacitacion.id as id_oferta_cap, cupos, horario_desde, horario_hasta, duracion, 
					f_inicio, f_culminacion,
					curso.nombre as curso,
					ocupacion.nombre as ocupe,
					colectivos.nombre as tcolectivo,
					turno_jornada.nombre as jornada,
					empresa_instituto.nombre as empresa,
					empresa_instituto.rif,
					empresa_instituto.id as id_empresa
					From oferta_capacitacion
					left JOIN empresa_instituto ON empresa_instituto.id=oferta_capacitacion.empresa_id
					left JOIN curso ON curso.id=oferta_capacitacion.curso_id
					left JOIN ocupacion ON ocupacion.cod=oferta_capacitacion.ocupacion2
					left JOIN colectivos ON colectivos.id=oferta_capacitacion.colectivos_id 
					left JOIN turno_jornada ON turno_jornada.id=oferta_capacitacion.turno_jornada_id
					where empresa_instituto.status='A' ".$_SESSION['where'] ."";
				$rs1 = $conn->Execute($SQL1);			
				if ($rs1->RecordCount()>0){	
					$aTabla=array();
					while(!$rs1->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['id']=$rs1->fields['id_oferta_cap']; 
						$aTabla[$c]['cupos']=$rs1->fields['cupos'];
						$aTabla[$c]['horario_desde']=$rs1->fields['horario_desde'];
						$aTabla[$c]['horario_hasta']=$rs1->fields['horario_hasta'];	
						$aTabla[$c]['duracion']=$rs1->fields['duracion']; 
						$aTabla[$c]['f_inicio']=$rs1->fields['f_inicio'];
						$aTabla[$c]['f_culminacion']=$rs1->fields['f_culminacion'];
						$aTabla[$c]['curso']=$rs1->fields['curso'];
						$aTabla[$c]['ocupe']=$rs1->fields['ocupe'];
						$aTabla[$c]['tcolectivo']=$rs1->fields['tcolectivo'];
						$aTabla[$c]['jornada']=$rs1->fields['jornada'];
						$aTabla[$c]['empresa']=$rs1->fields['empresa'];
						$aTabla[$c]['id_empresa']=$rs1->fields['id_empresa'];						
						$aTabla[$c]['rif']=$rs1->fields['rif'];
						$rs1->MoveNext();
						 }
			$_SESSION['aTabla'] = $aTabla;	
			}
			else{
			unset($_SESSION['aTabla']);
			?><script>alert("- No existen registros asociados");</script><?			
			}
}

//------------------------------------------------------------------------------------------------------------------------------
 
 function showHeader(){
 include('../header.php'); 
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
    <input name="action" type="hidden" value=""/>
</p>
         <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
          <tr>
          <th class="titulo">CONSULTA DE OPORTUNIDAD DE CAPACITACI&Oacute;N</th>
          </tr>
          <tr>
            <td height="14">&nbsp;</td>
          </tr>
          <tr>
            <td height="21"><div align="center">RIF:
              <select name="cbRif">
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
            </b></div></td>
          </tr>
          <tr>
            <td class="dataListColumn2">&nbsp;</td>
          </tr>
          
          <tr>
            <td height="14" class="dataListColumn2"><div align="center">
            <button type="button" name="btRif"  id="btRif" class="button"  onClick="javascript:send('btRif');">Aceptar</button>
	          <button type="button" name="Culminar"  id="Culminar" class="button"  onClick="javascript:send('Culminar');">Cancelar</button></div></td>
          </tr>
          <tr>
            <td height="14" class="dataListColumn2"><div align="center"></div></td>
          </tr>        
      </table>
      
       <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
          <tr>
            <th width="4%" class="labelListColumn">Nro.  </th>
            <th width="18%" class="labelListColumn">Entidad  de capacitaci&oacute;n </th>
            <th width="13%" class="labelListColumn">Nombre de la actividad </th>
            <th width="14%" class="labelListColumn">Oficio</th>
            <th width="6%" class="labelListColumn">Colectivo</th>
            <th width="5%" class="labelListColumn">Cupos</th>
            <th width="8%" class="labelListColumn">Horario</th>
            <th width="8%" class="labelListColumn">Duración</th>
            <th width="7%" class="labelListColumn">Tipo de jornada </th>
            <th width="9%" class="labelListColumn">Fecha inicio </th>
            <th width="8%" class="labelListColumn">Fecha fin </th>
            <!--<th width="4%" class="labelListColumn">Acciones</th>-->
          </tr>
          <?
	$aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $i=0; $i<count($aTabla); $i++){
		if (($i%2) == 0) $class_name = "dataListColumn2";
		else $class_name = "dataListColumn";
		?>
          <tr class="<?=$class_name?>">
            <td class="texto-normal"><div align="left"><b><?=$aTabla[$i]['id']?></b></div></td>
            <td class="texto-normal"><div align="left">
              <?=$aTabla[$i]['empresa']?> <?=$aTabla[$i]['rif']?>
            </div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['curso']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['ocupe']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['tcolectivo']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['cupos']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['horario_desde']?> <?=$aTabla[$i]['horario_hasta']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['duracion']?> Horas</div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['jornada']?></div></td>
            <td class="texto-normal"><div align="left"><?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_inicio']))?></div></td>
            <td class="texto-normal"><div align="left"><?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['f_culminacion']))?></div></td>
            <!--<td class="texto-normal">
			<a href="4_1agen_capacitacion.php?id_po=<?=$aTabla[$i]['id']?>&id_emp=<?=$aTabla[$i]['id_empresa']?>"><img src="../images/b_edit.png" width="12" height="12" border="0" title="Editar" /></a> 
			<a target="new" href="4agen_formato_capacitacion.php?id_po=<?=$aTabla[$i]['id']?>&id_emp=<?=$aTabla[$i]['id_empresa']?>"> <img src="../images/eye.png" width="15" height="16" border="0" title="Ver Oportunidad"/></a></td>-->
          </tr>
          <? } ?>
		  <tr class="<?=$class_name?>">
            <td colspan="10" class="labelListGlobal"><div align="right">Total 
            <?=$i?>
            </div>              
            <div align="right"></div></td>
            <td colspan="1" class="labelListGlobal">&nbsp;</td>
		  </tr>
        </table>
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
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
		    
			case 'cbEstado_empresa_changed':
			    LoadData($conn,true);
			break;
			
			
			
			case 'Buscar':			     
			LoadData($conn,true);
			break;
				
			case 'Culminar':
			unset($_SESSION['where']);
			unset($_SESSION['criterio']);
			unset($_SESSION['aTabla']);
			LoadData($conn,false);
			break;
		
			case 'Agregar': 
			unset($_SESSION['where']);
			unset($_SESSION['criterio']);		
			$bValidateSuccess = true;
						
			 if ($_POST['Rif']!="" ){
			   if (!ereg("^[0-9]{8}$", $_POST['Rif'])){ 
			   $GLOBALS['aPageErrors'][]= "- El Rif: debe tener nueve digitos numericos.";
			   $bValidateSuccess=false;
					 }	
		 			else{
					$_SESSION['criterio']=$_SESSION['criterio'].' '.'Rif';
					$_POST['rif']=$_POST['cbRif'].$_POST['Rif'].$_POST['cbRif1'];
					$_SESSION['where'].= " and empresa_instituto.rif = '".$_POST['rif']."'";   
					$bValidateSuccess=true;
					 }
			     }
					 
			 if  ($_POST['fafiliado_desde']!='' or $_POST['fafiliado_hasta']!='' ){		
		   		  if ($_POST['fafiliado_desde']=='' or $_POST['fafiliado_hasta']=='' ){
		      	     $GLOBALS['aPageErrors'][]= "- Debe seleccionar ambas fechas de afiliación.";
				     $bValidateSuccess=false;
				  }
		          else{
				       list($a,$m,$d)=explode("-", $_POST['fafiliado_desde']);
				       $_POST['fafiliado_desde']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
				
				       list($a,$m,$d)=explode("-", $_POST['fafiliado_hasta']);
				       $_POST['fafiliado_hasta']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
				
				       $_SESSION['criterio']=$_SESSION['criterio'].' '.'Fecha de Afiliación';
			           $_SESSION['where'].= " and  (empresa_instituto.created_at between '".$_POST['fafiliado_desde']."' and  '".$_POST['fafiliado_hasta']."') ";
				       $bValidateSuccess=true;
			          }
			   }
					 			
			if ($_POST['cbEstado_empresa']!="-1"){
					$_SESSION['criterio']=$_SESSION['criterio'].' '.'Estado';
					$_SESSION['where'].= " and empresa_instituto.estado_id= '".$_POST['cbEstado_empresa']."'";   
					$bValidateSuccess=true;
				 	}
			
			if ($_POST['cbSector_empleo']!="-1"){
					$_SESSION['criterio']=$_SESSION['criterio'].' '.'Sector Empleo';
					$_SESSION['where'].= " and empresa_instituto.sector_empleo_id= '".$_POST['cbSector_empleo']."'";   
					$bValidateSuccess=true;
				 	}
					
			if ($_POST['cbImparte_capacitacion']!="-1"){
					$_SESSION['criterio']=$_SESSION['criterio'].' '.'Imparte Programa de Capacitación a Trabajadores';
					$_SESSION['where'].= " and empresa_instituto.capacitacion= '".$_POST['cbImparte_capacitacion']."'";   
					$bValidateSuccess=true;
				 	}
			
			if ($_POST['cbContrata_migrante']!="-1"){
					$_SESSION['criterio']=$_SESSION['criterio'].' '.'Contrata Personal Migrante Calificado';
					$_SESSION['where'].= " and empresa_instituto.pers_migrante= '".$_POST['cbContrata_migrante']."'";   
					$bValidateSuccess=true;
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
	if (!$bPostBack){
	    			unset($_SESSION['aTabla']);
					unset($_SESSION['where']);	
					$aDefaultForm['rif']='';
					$aDefaultForm['fafiliado_desde']='';
					$aDefaultForm['fafiliado_hasta']='';
					$aDefaultForm['cbEstado_empresa']='-1';
					$aDefaultForm['cbSector_empleo']='-1';
					$aDefaultForm['cbImparte_capacitacion']='-1';
					$aDefaultForm['cbContrata_migrante']='-1';					
					}	
		else{   
					$aDefaultForm['rif']=$_POST['rif'];
					$aDefaultForm['fafiliado_desde']=$_POST['fafiliado_desde'];
					$aDefaultForm['fafiliado_hasta']=$_POST['fafiliado_hasta'];
					$aDefaultForm['cbEstado_empresa']=$_POST['cbEstado_empresa'];
					$aDefaultForm['cbSector_empleo']=$_POST['cbSector_empleo'];
					$aDefaultForm['cbImparte_capacitacion']=$_POST['cbImparte_capacitacion'];
					$aDefaultForm['cbContrata_migrante']=$_POST['cbContrata_migrante'];
					
			}
		}
} 
//---------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){

	  $SQL="select empresa_instituto.*, empresa_instituto.id as empresa_id, 
	  		estado.nombre as estado, sector_empleo.nombre as sector, p_juridica.nombre as p_juridica
			from empresa_instituto 
			left JOIN estado ON empresa_instituto.estado_id=estado.id
			left JOIN sector_empleo ON empresa_instituto.sector_empleo_id=sector_empleo.id
			left JOIN p_juridica ON empresa_instituto.p_juridica_id=p_juridica.id
			where empresa_instituto.status='A'  ".$_SESSION['where'] .  " order by  empresa_instituto.id";   
		    $rs = $conn->Execute($SQL);
			$_SESSION['EOF1']=$rs->RecordCount();
			if ($rs->RecordCount()>0){	
				while(!$rs->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;
					
					$aTabla[$c]['id']=$rs->fields['empresa_id'];
					$aTabla[$c]['nombre']=$rs->fields['nombre'];
					$aTabla[$c]['rif']=$rs->fields['rif'];
					$aTabla[$c]['act_eco']=$rs->fields['act_eco'];
					$aTabla[$c]['sector']=$rs->fields['sector'];
					$aTabla[$c]['p_juridica']=$rs->fields['p_juridica'];
					$capacitacion=$rs->fields['capacitacion'];	 
					if($capacitacion=='0') $_POST['capacitacion']='No';
					if($capacitacion=='1') $_POST['capacitacion']='Si';
					$aTabla[$c]['capacitacion']=$_POST['capacitacion'];
					$pers_migrante=$rs->fields['pers_migrante'];	 
					if($pers_migrante=='0') $_POST['pers_migrante']='No';
					if($pers_migrante=='1') $_POST['pers_migrante']='Si';	
					$aTabla[$c]['pers_migrante']=$_POST['pers_migrante'];				
					$aTabla[$c]['estado']=$rs->fields['estado'];
					$aTabla[$c]['created_at']=$rs->fields['created_at'];
					$rs->MoveNext();
		            }
	           }
			    $_SESSION['aTabla'] = $aTabla;
			//	print 'tabla '.$rs;
		}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
}
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
  <p>
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
            <th colspan="2" class="titulo">CONSULTA DE ENTIDADES DE TRABAJO</th>
            </tr>
            <tr class="dataListColumn2">
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr class="dataListColumn2">
              <td width="44%"><div align="right">RIF:</div></td>
              <td><select name="cbRif" class="tablaborde_shadow">
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
</select></td>
            </tr>
            <tr>
              <td height="14" class="dataListColumn2"><div align="right">Fecha de Afiliaci&oacute;n: </div></td>
              <td width="56%" height="14" class="dataListColumn2"><div align="left"> Desde:
                <input name="fafiliado_desde" type="text" class="tablaborde_shadow" id="fafiliado_desde" value="<?=$aDefaultForm['fafiliado_desde']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "fafiliado_desde",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>
        Hasta: 
        <input name="fafiliado_hasta" type="text" class="tablaborde_shadow" id="fafiliado_hasta" value="<?=$aDefaultForm['fafiliado_hasta']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger1"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "fafiliado_hasta",
        trigger    : "f_rangeStart_trigger1",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script></div></td>
            </tr>
            <tr>
              <td height="14" class="dataListColumn2"><div align="right">Estado: </div></td>
              <td height="14" class="dataListColumn2">
                <select name="cbEstado_empresa" class="tablaborde_shadow">
                  <option value="-1" selected="selected">Seleccione...</option>
                  <? LoadEstado_empresa($conn); print $GLOBALS['sHtml_cb_Estado_empresa'];?>
                </select>
              </td>
            </tr>
            <tr>
              <td height="14" class="dataListColumn2"><div align="right">Sector empleador:</div></td>
              <td height="14" class="dataListColumn2">
                <select name="cbSector_empleo" class="tablaborde_shadow">
                  <option value="-1" selected="selected">Seleccione...</option>
                  <? LoadSector_empleo($conn); print $GLOBALS['sHtml_cb_Sector_empleo'];?>
                </select>
                </td>
            </tr>
            <tr>
              <td height="14" class="dataListColumn2"><div align="right">Programa de capacitaci&oacute;n a trabajadores?: </div></td>
              <td height="14" class="dataListColumn2"><select name="cbImparte_capacitacion" class="tablaborde_shadow">
                <option value="-1" selected="selected">Seleccione</option>
                <option value="1" <? if (($aDefaultForm['cbImparte_capacitacion'])=='1') print 'selected="selected"';?>>Si</option>
                <option value="0" <? if (($aDefaultForm['cbImparte_capacitacion'])=='0') print 'selected="selected"';?>>No</option>
              </select>
              </td>
            </tr>
            <tr class="dataListColumn2">
              <td height="14" class="dataListColumn2"><div align="right">Contrata personal migrante calificado?: </div></td>
              <td><select name="cbContrata_migrante" class="tablaborde_shadow">
                <option value="-1" selected="selected">Seleccione</option>
                <option value="1" <? if (($aDefaultForm['cbContrata_migrante'])=='1') print 'selected="selected"';?>>Si</option>
                <option value="0" <? if (($aDefaultForm['cbContrata_migrante'])=='0') print 'selected="selected"';?>>No</option>
              </select></td>
            </tr>
            
            <tr>
              <td height="14" class="dataListColumn2">&nbsp;</td>
              <td height="14" class="dataListColumn2">&nbsp;</td>
            </tr>
            <tr>
              <td height="14" colspan="2" class="dataListColumn2"><div align="center">
              <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Aceptar</button>
	          <button type="button" name="Culminar"  id="Culminar" class="button"  onClick="javascript:send('Culminar');">Cancelar</button>
              </div></td>
            </tr>
            
            <tr>
              <td colspan="2" class="labelListGlobal">Consulta por:  <b><? print $_SESSION['criterio']?></b></td>
            </tr>
          </table>
          
          <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:99%; ">
          <tr>
            <th width="4%" class="labelListColumn"><div align="left">Nro.</div></th>
            <th width="29%" class="labelListColumn"><div align="left">Patrono(a)</div></th>
            <th width="13%" class="labelListColumn"><div align="left">Rif</div></th>
            <th width="8%" class="labelListColumn"><div align="left">Estado Ubicaci&oacute;n </div></th>
            <th width="8%" class="labelListColumn"><div align="left">Sector Empleador </div></th>
            <th width="9%" class="labelListColumn"><div align="left">Personalidad Jur&iacute;dica </div></th>
            <th width="8%" class="labelListColumn"><div align="left">Capacitaci&oacute;n</div></th>
            <th width="8%" class="labelListColumn"><div align="left">Contrata Migrantes </div></th>
            <th width="7%" class="labelListColumn"><div align="left">Fecha Afiliaci&oacute;n </div></th>
            <th width="6%" class="labelListColumn"><div align="left"></div></th>
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
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['nombre']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['rif']?></div></td>            
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['estado']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['sector']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['p_juridica']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['capacitacion']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['pers_migrante']?></div></td>
            <td class="texto-normal"><div align="left"><?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['created_at']))?></div></td>
            <td class="texto-normal"><div align="center">
			<a href="2_1agen_empresa.php?id_po=<?=$aTabla[$i]['id']?>&rif=<?=$aTabla[$i]['rif']?>"><img src="../imagenes/b_edit.png" width="12" height="12" border="0" title="Editar" /></a> 
			<a target="new" href="2_4agen_constancia_emp.php?id_po=<?=$aTabla[$i]['id']?>&rif=<?=$aTabla[$i]['rif']?>"><img src="../imagenes/document_16.png" width="12" height="12" border="0" title="Imprimir Constancia"/></a></div></td>
          </tr>         
          <? } ?>
		   <tr class="<?=$class_name?>">
            <td colspan="8" class="labelListGlobal"><div align="right">Total</div></td>
            <td colspan="2" class="labelListGlobal"><span class="labelListGlobal">
              <?=$i?>
            </span></td>
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
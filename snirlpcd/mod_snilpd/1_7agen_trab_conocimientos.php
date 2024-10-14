<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
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
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
			
			case 'Cancelar': 
				unset($_POST['id_po']);
				unset($_POST['accionI']);
				unset($_POST['accionC']);
				unset($_POST['bloq1']);
				unset($_POST['bloq2']);
				unset($_POST['bloq3']);
				$_POST['Nuevo_herramienta']='';
				LoadData($conn,false);	
			break;
			
			case 'Herramienta':
			   $_POST['Nuevo_herramienta']='1';
		     LoadData($conn,true);
			break;	

//-----------------AGREGAR OTRA HERRAMIENTA DE COMPUTACION A LA LISTA--------------------------------------------------------
			case 'btCompu':
			$bValidateSuccess= true;
			
			if ($_POST['otra_herramienta']!='' ){
					$sSQL = "select *  from computacion 
					where nombre ='".$_POST['otra_herramienta']."'"; 
					$rs = $conn->Execute($sSQL);
				  if ($rs->RecordCount()>0){
					$_POST['Nuevo_herramienta']='';
					$GLOBALS['aPageErrors'][]= "La Herramienta de computación: ".$_POST['otra_herramienta']." ya existe.";
					$bValidateSuccess=false;
					}
     				else{				
						$sql="insert into public.computacion
						  (nombre, status) values
						  ('".(ucwords(strtolower($_POST["otra_herramienta"])))."',
						   'A')";
						   $conn->Execute($sql);
							 $_POST['Nuevo_herramienta']='';
						}
						}
					else{
					$GLOBALS['aPageErrors'][]="- Especifique la descripción de la Herramienta de coputación";
					$GLOBALS['ids_elementos_validar'][]='otra_herramienta';
					 $bValidateSuccess=false;
					}
			LoadData($conn,false);
			break;
			
//-----------------AGREGAR COMPUTACION PERSONA--------------------------------------------------------------			
			case 'Agrega_compu': 
			$bValidateSuccess=true;	
										 
			if ($_POST['cbComputacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Herramienta de Computación: es requerida.";
					$GLOBALS['ids_elementos_validar'][]='cbComputacion';
					$bValidateSuccess=false;
					 }
			else{
			    if ($_POST['cbComputacion']!='1' and $_POST['cbNivel_compu']=='-1'){
					$GLOBALS['aPageErrors'][]= "- El Nivel de Computación: es requerido.";
					$GLOBALS['ids_elementos_validar'][]='cbNivel_compu';
					$bValidateSuccess=false;
					LoadData($conn,true);
				   }
				  }
				   
		    if ($bValidateSuccess){	
				if($_POST['accionC']=='') $_POST['accionC']='3';		
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;				   
			
//-----------------AGREGAR OTRA HABILIDAD PERSONA-----------------------------------------------------------------		
			case 'Agregar_Habil': 
			$bValidateSuccess=true;	
			if ($_POST['Otra_habilidad']==""){
					$GLOBALS['aPageErrors'][]= "- Otra habilidad: es requerido.";
					$GLOBALS['ids_elementos_validar'][]='Otra_habilidad';
					$bValidateSuccess=false;
					 }
			if ($bValidateSuccess){		
				 $_POST['accionI']='4';		
				 ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;

			
			case 'Continuar': 
					//sesiones curriculum
					$nNumSeccion = 5;
					$sSQL = "SELECT sesiones FROM personas where id = ".$_SESSION['id_afiliado'];
					$rs = $conn->Execute($sSQL);
					
					if ($rs){
					if ($rs->RecordCount() > 0){
					$rs->fields['sesiones'][$nNumSeccion-1] = 1;
					$sSQL = "update personas set sesiones = '".$rs->fields['sesiones']."' where id = ".$_SESSION['id_afiliado'];
					$rs = $conn->Execute($sSQL);			
						}
					}			
					unset($_POST['id_po']);
					unset($_POST['accionC']); 
					?><script>document.location='1_8agen_trab_experiencia.php'</script><?
			break;
	        }
		}		
		else{	
		LoadData($conn,false);
		}
}
//------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
    
		$aDefaultForm['cbComputacion']='-1';
		$aDefaultForm['cbNivel_compu']='-1';
		$aDefaultForm['Otra_habilidad']=''; 
		$aDefaultForm['otra_herramienta']=''; 
				
		if (!$bPostBack){
			
			if ($_GET['accionC']!='') $_POST['accionC']=$_GET['accionC'];
			if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];
//----------------COMPUTACION EDIT ----------------------------------------------------------------------------------------------		
		if ($_POST['accionC']=='1'){	
				$_POST['Nuevo_herramienta']='';
				$SQL="SELECT persona_computacion.*
				from persona_computacion 
				INNER JOIN personas ON personas.id=persona_computacion.persona_id 
				INNER JOIN computacion ON computacion.id=persona_computacion.computacion_id 
				where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' and persona_computacion.id ='".$_POST['id_po']."'";
				$rs = $conn->Execute($SQL);
				if ($rs->RecordCount()>0){	
				$aDefaultForm['cbComputacion']=$rs->fields['computacion_id'];
				$aDefaultForm['cbNivel_compu']=$rs->fields['nivel'];
				}
			}	
//----------------COMPUTACION  DELETE----------------------------------------------------------------------------------------------				
			if ($_POST['accionC']=='2'){
				$sql="delete  from persona_computacion 
				where id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
				$rs= $conn->Execute($sql);	
				unset($_POST['id_po']);	 
				unset($_POST['accionC']);	 
				
			 //Trazas-------------------------------------------
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='7';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
			}

		}
		
else{   
    $aDefaultForm['cbComputacion']=$_POST['cbComputacion'];
		$aDefaultForm['cbNivel_compu']=$_POST['cbNivel_compu'];
		$aDefaultForm['Otra_habilidad']=$_POST['Otra_habilidad']; 
		$aDefaultForm['otra_herramienta']=$_POST['otra_herramienta']; 
		}
//--------------------TABLA COMPUTACION------------------------------------------------------------------------------------		
		unset($_SESSION['aTabla']);
			$SQL1="select persona_computacion.id, nivel, computacion.nombre, personas.sesiones
					from persona_computacion 
					INNER JOIN personas ON personas.id=persona_computacion.persona_id 
					INNER JOIN computacion ON computacion.id=persona_computacion.computacion_id 
					where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				
				if ($rs1->RecordCount()>0){	
					$aTabla=array();
					while(!$rs1->EOF){
						$c = count($aTabla);  
						$nivel=$rs1->fields['nivel'];	
						if($nivel=='-1') $_POST['nivel']='No Tiene'; 
						if($nivel==1) $_POST['nivel']='Regular';
						if($nivel==2) $_POST['nivel']='Bueno';	
						if($nivel==3) $_POST['nivel']='Excelente';	
						$aTabla[$c]['id']=$rs1->fields['id']; 
						$aTabla[$c]['computacion']=$rs1->fields['nombre'];	
						$aTabla[$c]['nivel']=$_POST['nivel'];
						$_SESSION['sesiones']=$rs1->fields['sesiones'];
						$rs1->MoveNext();
						 }
			$_SESSION['aTabla'] = $aTabla;								
		}

//--------------------OTRA HABILIDAD--------------------------------------------------------------------------------------------
$SQL3="SELECT personas.otra_habilidad
			from personas 
			where id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
			$rs3 = $conn->Execute($SQL3);
			if ($rs3->RecordCount()>0){	
			$aDefaultForm['Otra_habilidad']=$rs3->fields['otra_habilidad'];
		}
			
	}
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');

//------------------------------------------------actualizar herramienta de computacion--------------------------------				
	
	if ($_POST['accionC']=='1'){		
			$sql="update persona_computacion set 
			computacion_id='".$_POST['cbComputacion']."',
			nivel='".$_POST['cbNivel_compu']."', 
			updated_at='".$sfecha."',
			status='A',
			id_update='".$_SESSION['sUsuario']."'
			WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' "; 	
			$conn->Execute($sql);	
			}
	//------------------------------------------------agregar herramienta de computacion--------------------------------
	if ($_POST['accionC']=='3'){	
	 //----------------------------------------------verifica si existe-----------------------------
	 $SQL2="SELECT id from persona_computacion
			  where persona_id  ='".$_SESSION['id_afiliado']."'
		    and computacion_id ='".$_POST['cbComputacion']."'";
			$rs = $conn->Execute($SQL2);
			if ($rs->RecordCount()>0){	
					$existe='1';
					?><script>alert("- Ya existe un registro con esta Herramienta");</script><?	
			}
			else{					
				$sql="insert into public.persona_computacion
				( persona_id, computacion_id, nivel, created_at, status, id_update) values
				('".$_SESSION['id_afiliado']."',
				 '".$_POST['cbComputacion']."',
				 '".$_POST['cbNivel_compu']."', 
				 '$sfecha',
				 'A',
				 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql);
			}
	}
			
   //------------------------------------------------agregar otra habilidad------------------------------------
			if ($_POST['accionI']=='4'){						 
				  $sql="update personas set 
					  status = 'A',
					  otra_habilidad = '".$_POST['Otra_habilidad']."',
					  updated_at = '".$sfecha."',
					  id_update = '".$_SESSION['sUsuario']."'
					  WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'"; 	
					  $conn->Execute($sql);	
			}
				
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='7';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
//--------------------------------------------------------------------------------------------------------------------------------------

	unset($_POST['id_po']);
	unset($_POST['accionC']);
	LoadData($conn,false);	
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<style type="text/css">
<!--
.Estilo12 {color: #030303}
.Estilo13 {
	color: #666666;
	font-weight: bold;
}
-->
</style>
<form name="frm_conocimientos" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
	function send(saction){
		
		if(saction=='Agrega_compu'){
	       if(saction=='Agrega_compu'){
					 	var boton = 'Agrega_compu';
		   			if(validar_frm_conocimientos(boton)==true){
						var form = document.frm_conocimientos;
						form.action.value=saction;
						form.submit();	
						}		   
				}	
			
				}else{
					var form = document.frm_conocimientos;
					form.action.value=saction;
					form.submit();				
			}	
		  		
	}
</script>
      <input name="action" type="hidden" value=""/>
      <input name="Nuevo_herramienta" type="hidden" value="<?=$_POST['Nuevo_herramienta']?>" />
      <input name="cbComputacion" type="hidden" value="<?=$aDefaultForm['cbComputacion']?>" />
      <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
      <input name="accionC" type="hidden" value="<?=$_POST['accionC']?>" />

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
           <tr>
          <th colspan="4" class="sub_titulo"  >OTROS CONOCIMIENTOS, HABILIDADES Y DESTREZAS</th>
        </tr>
       <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
        <tr>
        <th colspan="4" class="sub_titulo_2" align="left">Dominio de computación</th>
        </tr>
        
     
          <tr>
          <th width="40%" style="background-color:#F0F0F0;" class="sub_titulo"><div align="right">Herramienta de Computaci&oacute;n:</div></th>
          <td width="60%" colspan="2">
          <select name="cbComputacion" class="texto-normal" id="cbComputacion" <? if($_POST['accionC']=="1"){ ?> disabled <? }?>>
          <option value="-1" selected="selected">Seleccione...</option>
          <? LoadComputacion($conn); print $GLOBALS['sHtml_cb_Computacion'];?>
          </select>
          <span class="requerido">*</span></span></td>
          </tr>
					<? if ($_POST['Nuevo_herramienta']=='' and $_POST['edit']!="1"){ ?>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><button type="button" name="Nuevo_herramienta"  id="Nuevo_herramienta" class="button" onClick="javascript:send('Herramienta');" title="Agregar herramienta de computacion">Nueva Herramienta</button></td>
          </tr>
          <? }?>          
          
          <? if ($_POST['Nuevo_herramienta']=='1'){ ?>
          
          <tr>
          <th style="background-color:#F0F0F0;" class="sub_titulo"><div align="right" >Agregar otra herramienta de computación: </div></th>
          <td colspan="2">
          <input name="otra_herramienta" type="text" class="texto-normal" id="otra_herramienta" value="<?=$aDefaultForm['otra_herramienta']?>"size="20" maxlength="50" />
          <span class="requerido">
          <input name="btCompu" type="submit" class="link-info" onClick="javascript:send('btCompu')" value="+"/>
         </td>
          </tr>
          <? } ?>
          <tr>
          <th style="background-color:#F0F0F0;" class="sub_titulo"><div align="right">Nivel: </div></th>
          <td colspan="2"><select name="cbNivel_compu" class="texto-normal" id="cbNivel_compu">
          <option value="-1" selected="selected">Seleccione</option>
          <option value="1" <? if (($aDefaultForm['cbNivel_compu'])=='1') print 'selected="selected"';?>>Regular</option>
          <option value="2" <? if (($aDefaultForm['cbNivel_compu'])=='2') print 'selected="selected"';?>>Bueno</option>
          <option value="3" <? if (($aDefaultForm['cbNivel_compu'])=='3') print 'selected="selected"';?>>Excelente</option>
          </select></td>
          </tr>
          <tr>
          <td>&nbsp;</td>
          <td colspan="2"><span class="requerido">
          <? if($_POST['accionC']=="1"){ ?>
          <button type="button" name="Actualizar"  id="Actualizar" class="button_personal btn_editar"  onClick="javascript:send('Agrega_compu');">Actualizar</button>
          <? }
          else{ ?>
          <button type="button" name="Agregar"  id="Agregar" class="button_personal btn_agregar"  onClick="javascript:send('Agrega_compu');">Agregar</button>
          </span>
          <? }?>
          <span class="requerido">
          <button type="button" name="Cancelar2"  id="Cancelar2" class="button_personal btn_cancelar"  onclick="javascript:send('Cancelar');">Cancelar</button>
          </span>
          </td>
          </tr>  
          <tr>
          <td colspan="3">
                 <table class="formulario" border="0" align="center" id="tblDetalle" width="100%"> <!--258-->
              
              <thead> 
              <tr>
                <th width="60%" class="sub_titulo">Herramientas de Computación </th>
                <th width="33%" class="sub_titulo">Nivel</th>
                <th width="7%" class="sub_titulo">Acciones</th>
                </tr>
                <tbody>
                <?
                $aTabla=$_SESSION['aTabla'];
                $aDefaultForm = $GLOBALS['aDefaultForm'];
                for( $i=0; $i<count($aTabla); $i++){
               /* if (($i%2) == 0) $class_name = "dataListColumn2";
                else $class_name = "dataListColumn";*/
                ?>
                <tr >
                <td style="background-color:#F0F0F0;" class="texto-normal"><div align="left">
                <?=$aTabla[$i]['computacion']?>
                </div></td>
                <td style="background-color:#F0F0F0;" class="texto-normal"><div align="left">
                <?=$aTabla[$i]['nivel']?>
                </div></td>
                <td style="background-color:#F0F0F0;" class="texto-normal"><a href="1_7agen_trab_conocimientos.php?id_po=<?=$aTabla[$i]['id']?>&accionC=1"><img src="../imagenes/pencil_16.png"  border="0" title="Editar" /></a> <a href="1_7agen_trab_conocimientos.php?id_po=<?=$aTabla[$i]['id']?>&accionC=2"><img src="../imagenes/delete_16.png"  border="0" title="Eliminar" /></a> </td>
                </tr>
                <? } ?>
                  </tbody>
               </thead>
                
                </table>  
                  
              
      </td>
      </tr> 
      <tr>
      <td colspan="3">&nbsp;</td>
      </tr>
        <tr>
        	<th colspan="4" class="sub_titulo_2" align="left">Otras habilidades y destrezas</th>
        </tr>
     
      <tr>
      <tr>
      <th width="40%" style="background-color:#F0F0F0;" class="sub_titulo"><div align="right">Descripci&oacute;n de competencias, habilidades y destrezas para el trabajo:</div></th>
      <td width="60%" colspan="2"><textarea name="Otra_habilidad" cols="60" class="texto-normal" id="Otra_habilidad"><?=$aDefaultForm['Otra_habilidad']?></textarea>
      </td>
      </tr>
      
      
      <tr>
      <td colspan="3" align="center">
         <button type="button" name="Agregar_Habil"  id="Agregar_Habil" class="button_personal btn_aceptar"  onclick="javascript:send('Agregar_Habil')">Aceptar</button>
         <button type="button" name="Cancelar"  id="Cancelar_Habil" class="button_personal btn_cancelar"  onclick="javascript:send('Cancelar_Habil');">Cancelar</button>

      </td>
      </tr>
      
      <tr>
        <td colspan="3" align="center">&nbsp;</td>
      </tr>
      <tr>
      <td colspan="3" align="center">
         <button type="button" name="Continuar"  id="Continuar" class="button_personal btn_aceptar"  onclick="javascript:send('Continuar');">Continuar</button>

      </td>
      </tr>
      <tr>
      <td colspan="3">&nbsp;</td>
      </tr>
      </table>
      <p></div>
</p>
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

<?
header("Content-type: text/html; charset=UTF-8");
require_once("include/header.php");
ini_set("display_errors", 0);
error_reporting(-1);
//print "BD---->".$db4."</br>";
$conn= getConnDB($db4);/// minpptrassi
$conn->debug = $settings['debug'];
include("LoadCombos.php");
include ('consulta_entes.php');
include ('consulta_empresa.php');


$aPageErrors = array();
$aDefaultForm = array();


showHeader();
doAction($conn);
debug();
showForm($conn,$aDefaultForm);
showFooter();
debug();
function debug(){
	//if($GLOBALS['settings']['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
				print "<br>**** GET: ****<br>";
		var_dump($_GET);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
		print "<br>**** ERRORES: *****<br>";
		var_dump($aPageErrors);
	//}
}
function doAction($conn){
if (isset($_POST['action'])){
		$bValidateSuccess=false;
		switch($_POST['action']){
			case 'Actualizar_combos':
				LoadData($conn,false);
			break;
				case 'cmd_buscar_empresa':
				$bValidateSuccess=true;
				if($_POST['srif']==''){
					$GLOBALS['aPageErrors'][]= "- El RIF de la Entidad de Trabajo es requerida.";
				$bValidateSuccess=false;
					}
				if ($bValidateSuccess){
					$srif=$_POST['srif'];
					$datos_empresa= buscar_entidad_trabajo_rnet($srif);
					$_POST['nombre_empresa']=$datos_empresa['sEmpresa'];
				}
					LoadData($conn,false);
				break;
			case 'guardar':
			$bValidateSuccess=true;
			LoadData($conn,false);
		
			if($_POST['planteamiento_caso']==''){
			//	$GLOBALS['aPageErrors'][]= "- El planteamiento del caso es requerida.";
				$bValidateSuccess=false;
				}
			if($_POST['cbo_asistencia']==''){
			//	$GLOBALS['aPageErrors'][]= "- El tipo de Asistencia es requerida.";
				$bValidateSuccess=false;
				}
			if($_POST['cbo_detalle_gestion']==''){
			//	$GLOBALS['aPageErrors'][]= "- El detalle de la gestion es requerido.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_detalle_gestion']=='2' and $_POST['cbo_tipo_caso_rnet']==''){
			//	$GLOBALS['aPageErrors'][]= "- El Tipo de Caso del RNET es requerida.";
				$bValidateSuccess=false;
			}
				if($_POST['cbo_tipo_caso_rnet']=='1' and $_POST['cbo_detalle_caso_rnet']==''){
			//	$GLOBALS['aPageErrors'][]= "- El detalle del Caso del RNET es requerida.";
				$bValidateSuccess=false;
			}
		if($_POST['cbo_detalle_caso_rnet']=='2' and $_POST['cbo_dato_corregir_rnet']==''){
			//	$GLOBALS['aPageErrors'][]= "- El dato a corregir es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['srif']==''){
			//	$GLOBALS['aPageErrors'][]= "- El RIF de la Entidad de Trabajo es requerido.";
				$bValidateSuccess=false;
			}
		 if($_POST['nombre_empresa']==''){
			//	$GLOBALS['aPageErrors'][]= "- El Nombre o razon Social de la Entidad de Trabjo es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['cbo_sector']==''){
			//	$GLOBALS['aPageErrors'][]= "- El Sector de la Entidad de Trabjo es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['nombre_sindicato']==''){
		//		$GLOBALS['aPageErrors'][]= "- El Nombre de la Organizaciòn Sindical es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['telefono_sindicato1']=='' or $_POST['telefono_sindicato2'] ){
			//	$GLOBALS['aPageErrors'][]= "- El N&uacute;mero Telefònico Contacto de la Organizaciòn Sindical es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['email_contacto']==''){
			//	$GLOBALS['aPageErrors'][]= "- El Correo Electrònico de  Contacto de la Organizaciòn Sindical es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['persona_remite_caso']==''){
				//$GLOBALS['aPageErrors'][]= "- La Persona que remite el caso Atendido es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['f_remision']==''){
				//$GLOBALS['aPageErrors'][]= "- La Fecha de remisiòn del caso Atendido es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['cbo_organismo']==''){
		//		$GLOBALS['aPageErrors'][]= "- El Organismo a quien fue remitido el caso Atendido es requerido.";
				$bValidateSuccess=false;
			}
			if($_POST['numero_memo']==''){
			//	$GLOBALS['aPageErrors'][]= "- El Nùmero de memo como fue remitido el caso Atendido es requerido.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_resultado']==''){
		//		$GLOBALS['aPageErrors'][]= "- La Respuesta o estatus del caso Atendido es requerido.";
				$bValidateSuccess=false;
			}
				if($bValidateSuccess){
			
				ProcessForm($conn);	
				}
			break;
	  }
}else{
	if($_SESSION['cedulaconsulta'] != '' and $_SESSION['nacionalidad'] ){
$bValidateSuccess=true;
			$cedula=$_SESSION['cedulaconsulta'];
			$letra=$_SESSION['nacionalidad'];
			$dataSaime=consultando_saime($cedula,$letra);						
			if (count($dataSaime)>0){
				$_POST['nombre1']=htmlentities($dataSaime['nombre1'],ENT_QUOTES);
				$_POST['nombre2']=htmlentities(trim($dataSaime['nombre2'],ENT_QUOTES));
				$_POST['apellido1']=htmlentities($dataSaime['apellido1'],ENT_QUOTES);
				$_POST['apellido2']=htmlentities(trim($dataSaime['apellido2']),ENT_QUOTES);
				$_SESSION['apellidonombre']=$_POST['nombre1']." ".$_POST['nombre2']." ".$_POST['apellido1']." ".$_POST['apellido2'];						
				if($_POST['nacionalidad']=='1')$_POST['checked_nacionalidad_V']="selected='selected'";
				if($_POST['nacionalidad']=='2')$_POST['checked_nacionalidad_E']="selected='selected'";
						    
				
				}				
	}
	LoadData($conn,false);
	}
}
function LoadData($conn,$PostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
				if (!$bPostBack){	
			 		$aDefaultForm['cedulaconsulta'] = $_SESSION['cedulaconsulta'];
					$aDefaultForm['nacionalidad'] = $_SESSION['nacionalidad'];
					$aDefaultForm['apellidonombre'] = $_SESSION['apellidonombre'];
					$aDefaultForm['planteamiento_caso']=$_POST['planteamiento_caso'];		
					$aDefaultForm['cbo_asistencia']=$_POST['cbo_asistencia'];		
					$aDefaultForm['cbo_detalle_gestion']=$_POST['cbo_detalle_gestion'];					
					$aDefaultForm['srif']=$_POST['srif'];
					$aDefaultForm['nombre_empresa']=$_POST['nombre_empresa'];
					$aDefaultForm['cbo_tipo_caso_rnet']=$_POST['cbo_tipo_caso_rnet'];
					$aDefaultForm['cbo_detalle_caso_rnet']=$_POST['cbo_detalle_caso_rnet'];
					$aDefaultForm['cbo_dato_corregir_rnet']=$_POST['cbo_dato_corregir_rnet'];	
					$aDefaultForm['cbo_sector']=$_POST['cbo_sector'];		
					$aDefaultForm['nombre_sindicato']=$_POST['nombre_sindicato'];	
					
					$aDefaultForm['telefono_sindicato1']=$_POST['telefono_sindicato1'];	
					$aDefaultForm['telefono_sindicato2']=$_POST['telefono_sindicato2'];		
					$aDefaultForm['email_contacto']=$_POST['email_contacto'];		
					$aDefaultForm['persona_remite_caso']=$_POST['persona_remite_caso'];	
					$aDefaultForm['f_remision']=$_POST['f_remision'];	
					$aDefaultForm['cbo_organismo']=$_POST['cbo_organismo'];	
					$aDefaultForm['numero_memo']=$_POST['numero_memo'];	
					$aDefaultForm['cbo_resultado']=$_POST['cbo_resultado'];	
					$aDefaultForm['observaciones']=$_POST['observaciones'];	
				}
	}
}
function	ProcessForm($conn){
	$fecha_hoy=date('c');
	$_SESSION['nusuario']='13885175';
	$sql="INSERT INTO oac.detalle_oac(
            id_datos_personales, snro_caso, dfecha_recepcion, 
            id_via_recepcion, id_tipo_asistencia, splanteamiento_caso, id_tipo_caso, 
            id_detalle_caso, id_dato, srif, snombre_empresa, ssector, snombre_sindicato, 
            stelefono_contacto, semail_contacto,  snombre_contacto, 
            id_organismo_remitido, dfecha_remision, id_status, nenabled, 
            nusuario_creacion, dfecha_creacion, nusuario_actualizacion, dfecha_actualizacion, 
            sobservaciones, id_gestion, snro_memo)
    VALUES ('".$_SESSION['id_datos_personales']."','".$_SESSION['snro_caso']."',date('Y-m-d'), 
           '".$_SESSION['des_recepcion']."' , '".$_POST['cbo_asistencia']."', '".$_POST['planteamiento_caso']."', '".$_POST['cbo_tipo_caso_rnet']."', 
           '".$_POST['cbo_detalle_gestion']."', '".$_POST['cbo_dato_corregir_rnet']."', '".$_POST['srif']."', '".$_POST['nombre_empresa']."','".$_POST['cbo_sector']."','".$_POST['nombre_sindicato']."', 
            '".$_POST['nombre_sindicato']."','".$_POST['telefono_sindicato1']."', '".$_POST['semail_contacto']."','".$_POST['persona_remite_caso']."', 
            '".$_POST['cbo_organismo']."',  '".$_POST['f_remision']."',  '".$_POST['cbo_resultado']."' '".$_SESSION['nusuario']."', 
            '".$fecha_hoy."');";

/*	$sql="INSERT INTO oac.datos_personales_oac(
            numcedula, primer_apellido, segundo_apellido, 
            primer_nombre, segundo_nombre, fechanac, nacionalidad, sexo, 
            stlf_hab, semail, nentidad, nmunicipio, 
            nparroquia, nenabled, nusuario_creacion, dfecha_creacion)
    VALUES ('".$_POST['cedulaconsulta']."', '".$_POST['apellido1']."','".$_POST['apellido2']."', 
            '".$_POST['nombre1']."', '".$_POST['nombre2']."', '".	$_POST['fecha_nac']."','".	$_POST['nacionalidad']."','".	$_POST['sexo']."', '".$_POST['telefono']."', 
            '".$_POST['email']."', '".$_POST['cbo_entidad']."','".$_POST['cbo_municipio']."', '".$_POST['cbo_parroquia']."','1', '".$_SESSION['nusuario']."', 
            '".$fecha_hoy."');";
	$rs=$conn->Execute($sql);*/
}

function showHeader(){
	include("header.php"); ?>
	
<?
}
function showForm($conn,$aDefaultForm){
var_dump($aDefaultForm);
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="form" id="form">
 <p>
   <input name="action" type="hidden" value="">
<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="Validacion_oac_asistencia_caso.js"></script>
<script language="JavaScript" type="text/javascript" src="funciones.js"></script>
<link href='../css/plantilla.css' type=text/css rel=stylesheet>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/botones_IZ.css">
<script>
function send(saction){
var form=document.form;
		form.action.value=saction;
		form.submit();	
}

$(document).ready(function() {
	$('#tblDetalle').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
					"sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
			} );
	$('#tblDetalle').css('width','100%');
});
</script>
</p>
<div>
<table width="33%" align="right" class="formulario" border="1">
<tr>
<th  class="sub_titulo" width="34%">Fecha:</th>
<td width="66%"><?=date('d/m/Y')?></td>
</tr>
<tr>
<th class="sub_titulo" width="34%">Recepci&oacute;n:</th>
<td width="66%"><?=date('d/m/Y')?></td>
</tr>
<tr>
<th class="sub_titulo" width="34%">Nro Caso:</th>
<td width="66%">xxxxx</td>
</tr>
<tr>
<th class="sub_titulo" width="34%">Recibido por:</th> 
<td width="66%" ><b><? $sSQL="SELECT id_via_recepcion, sdecripcion_via_recepcion, nenabled
  FROM oac.via_recepcion where nenabled='1' and id_via_recepcion=".$_SESSION['cbo_recepcion']."";		
		$rs = &$conn->Execute($sSQL); 
		if( $rs->RecordCount()>0 ){
		print	$_SESSION['des_recepcion']=$rs->fields['sdecripcion_via_recepcion'];
		}
			?></b></td>
</tr>

</table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>


 <table width="98%" align="center" class="formulario" border="0">
    <th class="sub_titulo" colspan="5" align="left">ASISTENCIA BRINDADA AL CASO</th>
<tr>
  <td height="29" colspan="2" >C&eacute;dula Identidad
    <select name="nacionalidad" disabled="disabled" id="nacionalidad" >
      <option value="1"  <?=$_POST['checked_nacionalidad_V']?>>V</option >
      <option value="2" <?=$_POST['checked_nacionalidad_E']?>>E</option>
      </select>
    <input name="cedulaconsulta" type="text" disabled="disabled" id="cedulaconsulta" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." value="<?=$aDefaultForm['cedulaconsulta'];?>" maxlength="8" ></td>
  <td height="29" colspan="3" >Apellidos y Nombres: <strong> <input name="apellidonombre" type="text" disabled="disabled" id="apellidonombre" value="<?=$aDefaultForm['apellidonombre'];?>" size="70"></strong></td>
  </tr>
     <tr>
       <td height="61" colspan="2">Planteamineto del Caso:
        </textarea><textarea id="planteamiento_caso" name="planteamiento_caso" cols="50%" rows="3%" class="areatexto"><? print $aDefaultForm['planteamiento_caso'];?></textarea>
       <span class="requerido">*</span></td>
       <td height="61">Tipo de Asistencia;
         <select id="cbo_asistencia" name="cbo_asistencia">
           <option value="">Seleccione</option>
           <? LoadAsistencia ($conn) ; print $GLOBALS['sHtml_cb_asistencia']; ?>
         </select>
         <span class="requerido">*</span></td>
       <td colspan="2">Detalle de Gest&oacute;n:
         <select id="cbo_detalle_gestion" name="cbo_detalle_gestion" onChange="JavaScript:send('Actualizar_combos')">
           <option value="">Seleccione</option>
           <? LoadDetalleGestion ($conn) ; print $GLOBALS['sHtml_cb_detalle_gestion']; ?>
         </select>
         <span class="requerido">*</span></td>
     </tr>
     <tr>
         <? if($_POST['cbo_detalle_gestion']=='2') {?>
         <td height="61" colspan="2">Tipo de Caso RNET:
           <select id="cbo_tipo_caso_rnet" name="cbo_tipo_caso_rnet" onChange="JavaScript:send('Actualizar_combos')">
             <option value="">Seleccione</option>
             <? LoadTipoCasoRnet ($conn) ; print $GLOBALS['sHtml_cb_tipo_caso_rnet']; ?>
         </select>
         <span class="requerido">*</span></td>
         <? }?>
          <? if($_POST['cbo_tipo_caso_rnet']=='1' && $_POST['cbo_detalle_gestion']=='2'){ ?>
         <td width="32%">Detalle del Caso:
           <select id="cbo_detalle_caso_rnet" name="cbo_detalle_caso_rnet" onChange="JavaScript:send('Actualizar_combos')">
             <option value="">Seleccione</option>
             <? LoadDetalleCasoRnet ($conn) ; print $GLOBALS['sHtml_cb_detalle_caso_rnet']; ?>
         </select>
         <span class="requerido">*</span></td>
             <? }?>
           <? if($_POST['cbo_detalle_gestion']=='2' && $_POST['cbo_tipo_caso_rnet']=='1' && $_POST['cbo_detalle_caso_rnet']=='2'){ ?>
         <td colspan="2">Dato a Corregir:
           <select id="cbo_dato_corregir_rnet" name="cbo_dato_corregir_rnet" onChange="JavaScript:send('Actualizar_combos')">
             <option value="">Seleccione</option>
             <? LoaddatoCorregirRnet ($conn) ; print $GLOBALS['sHtml_cb_dato_corregir_rnet']; ?>
         </select>
         <span class="requerido">*</span></td>
               <? }?>
    </tr>
     <tr>
    <th colspan="5"  class="sub_titulo">Datos de la Entidad de Trabajo</th>
    </tr>
    <tr>
       <td width="16%">Rif<strong>
         <input name="srif" type="text"  id="srif" value="<?=$aDefaultForm['srif'];?>" > 
       <span class="requerido">*</span>       </strong></td>
       <td width="15%"><button type="button" class="button btn_buscar"onClick="JavaScript:send('cmd_buscar_empresa')"  >Buscar</button></td>
       
      <td>Nombre de la Entidad de Trabajo:<strong>
        <input name="nombre_empresa" type="text"  id="nombre_empresa" value="<?=$aDefaultForm['nombre_empresa'];?>" size="50">
      <span class="requerido">*</span>      </strong></td>
      <td colspan="2">Sector:
        <select id="cbo_sector" name="cbo_sector" >
<? if($aDefaultForm['cbo_sector']=='') $selected='selected="selected"';
   if($aDefaultForm['cbo_sector']=='1') $selected1='selected="selected"';
	 if($aDefaultForm['cbo_sector']=='2') $selected2='selected="selected"';
	 if($aDefaultForm['cbo_sector']=='3') $selected2='selected="selected"'; ?>
          <option value=""  '".$selected."'>Seleccione</option>
          <option value="1" '".$selected1."'>P&uacute;blica </option>
          <option value="2" '".$selected2."'>Privada</option>
          <option value="3" '".$selected3."'>Empresa de Propiedad Social</option> 
        </select>
      <span class="requerido"> * </span></td>
    </tr>
    <tr>
      <th colspan="5"  class="sub_titulo">Datos del Sindicato</th>
    </tr>
    <tr>
      <td colspan="2">Nombre<strong>
        <input name="nombre_sindicato" type="text"  id="nombre_sindicato" value="<?=$aDefaultForm['nombre_sindicato'];?>">
      <span class="requerido">*</span></strong></td>
      <td><label>
        Telefono Contacto:
        <input name="telefono_sindicato1" type="text" id="telefono_sindicato1" onkeypress="return isNumberKey(event);" value="<?=$aDefaultForm['telefono_sindicato1'];?>" onblur="" size="5" maxlength="4" />
          <label> - </label>
        <input name="telefono_sindicato2" type="text" id="telefono_sindicato2" onblur=""  onkeypress="return isNumberKey(event);"  value="<?=$aDefaultForm['telefono_sindicato2'];?>" size="8" maxlength="7" />
          <span class="requerido"> * </span>
      </label></td>
      <td colspan="2">Correo:
        <input name="email_contacto" type="text" id="email_contacto" onblur="validarEmail()" value="<?=$aDefaultForm['email_contacto'];?>" size="50" />
      <span class="requerido"> * </span></td>
      
    </tr>
    <tr>
      <th colspan="5"  class="sub_titulo">Remision del Caso</th>
    </tr>
    <tr>
      <td colspan="2">Persona que remite el caso:
        <input name="persona_remite_caso" type="text"  id="persona_remite_caso" value="<?=$aDefaultForm['persona_remite_caso'];?>"></td>
                <td align="left">Remitido a:
               <select id="cbo_organismo" name="cbo_organismo">
                 <option value="">Seleccione</option>
                 <? LoadOrganismo ($conn) ; print $GLOBALS['sHtml_cb_organismo']; ?>
             </select>
            <span class="requerido">*</span></td>
      <td width="21%" align="left">Fecha de Remisi&oacute;n:
        <input  name="f_remision" id="f_remision" type="text"  title="Fecha de Remisi&oacute; - Seleccione en el Calendario" size="10"  value="<?= $aDefaultForm['f_remision'];?>" readonly/>
        <a  id="f_btn1"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
        <script type="text/javascript">
        Calendar.setup({
        inputField : "f_remision",
        trigger    : "f_btn1",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%d-%m-%Y" 
        });
        </script>
      <span class="requerido">*</span></strong></td>
      <td width="16%" align="left">N&uacute;mero de Memo:
      <input name="numero_memo" type="text"  id="numero_memo" value="<?=$aDefaultForm['numero_memo'];?>"><span class="requerido">*</span></strong></td>
    </tr>
    <tr>
      <th colspan="5"  class="sub_titulo">Estatus del Caso</th>
    </tr>
    <tr>
      <td colspan="2"><label>Resultado.:
          <select id="cbo_resultado" name="cbo_resultado" >
          <option value="">Seleccione</option>
            <? LoadResultado ($conn) ; print $GLOBALS['sHtml_cb_resultado']; ?>
         </select>
        </select>
      </label>
      <span class="requerido"> * </span></td>
      <td>Observaciones:
        <textarea name="observaciones" id="observaciones"></textarea></td>
    </tr>
   
    <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="2"><span class="requerido">* Datos Requeridos</span></td>
  </tr>
    
    <tr><!-- onClick="JavaScript:send('guardar')" -->
     <td align="center" class="formulario"><button type="button" id="enviar" name="enviar" class="button btn_guardar"onClick="JavaScript:send('guardar')"  >Guardar</button></td>
    <td colspan="3">&nbsp;</td>
    </tr>   
 </table>
</form> 
<p>&nbsp;</p>

<?
}


function showFooter(){
	$aPageErrors = $GLOBALS['aPageErrors'];
	print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script> alert('".join('\n',$aPageErrors)."') </script>":"";
	include("footer.php");
} 
?>
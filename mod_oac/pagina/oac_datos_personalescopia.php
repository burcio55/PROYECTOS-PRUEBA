<?
header("Content-type: text/html; charset=UTF-8");
include("LoadCombos.php");
include ('consulta_entes.php');
ini_set("display_errors",0);
error_reporting(-1);
//print "BD---->".$db4;
$conn= getConnDB($db4);
//$conn->debug = $settings['debug'];


$aPageErrors = array();
$aDefaultForm = array();



doAction($conn);
debug();
showForm($conn,$aDefaultForm);

//debug();
function debug(){
	//if($GLOBALS['settings']['debug']){
		print "<br>**** GET: ****<br>";
		var_dump($_GET);
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
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
			case 'cmd_buscar_cedula': //Buscar cedula
			$bValidateSuccess=true;
		//	echo"los datos1";
			if($_POST['cedulaconsulta']==''){
				$GLOBALS['aPageErrors'][]= "- La cedula del ciudadno es requerida.";
				$bValidateSuccess=false;
			}
			if ($_POST['nacionalidad']==''){
					$GLOBALS['aPageErrors'][]= "- La nacionalidad es requerida.";
				$bValidateSuccess=false;
			}
			if ($bValidateSuccess){
					//		echo"los datos1";
				$bValidateSuccess=false;				
				LoadData($conn,false);							
			}		
			break;
			
			case 'guardar':
			$bValidateSuccess=true;
			//LoadData($conn,false);
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			if($_POST['cbo_recepcion']==''){
				$GLOBALS['aPageErrors'][]= "- Favor indicar por cual vía de Recepciòn se emite el Caso.";
				$bValidateSuccess=false;
				}
			if($_POST['cedulaconsulta']==''){
				$GLOBALS['aPageErrors'][]= "- La cedula del ciudadno es requerida.";
				$bValidateSuccess=false;
				}
			/*if($_POST['apellidonombre']==''){
				$GLOBALS['aPageErrors'][]= "- El apellido y nombre del ciudadano es requerida.";
				$bValidateSuccess=false;
			}*/
		/*	if($_POST['edad']==''){
				$GLOBALS['aPageErrors'][]= "- La edad del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['sexo']==''){
				$GLOBALS['aPageErrors'][]= "- El sexo del ciudadano es requerida.";
				$bValidateSuccess=false;
				}*/
			if($_POST['telefono1']=='' or $_POST['telefono2']==''){
				$GLOBALS['aPageErrors'][]= "- El Telefono del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['email']==''){
				$GLOBALS['aPageErrors'][]= "- El correo electronico del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_entidad']==''){
				$GLOBALS['aPageErrors'][]= "- La Entidad donde esta ubicado el domicilio del ciudadano es 							
				requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_municipio']==''){
				$GLOBALS['aPageErrors'][]= "- El municipio donde esta ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}	else{
					$_POST['cbo_municipio_descripcion'] = LoadMunicipio($conn,$_POST['cbo_municipio']);
				}
			if($_POST['cbo_parroquia']==''){
			 	$GLOBALS['aPageErrors'][]= "- La Parroquia donde esta ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}	else{
				$_POST['cbo_parroquia_descripcion'] = LoadParroquia($conn,$_POST['cbo_parroquia']);
			}
		//	LoadData($conn,false);
			if($bValidateSuccess){
					if($_POST['cedulaconsulta']!='' and $_POST['nacionalidad']!='' ){
							echo"entreeee";
						//$cedula=$_POST['cedulaconsulta'];
						//$letra=$_POST['nacionalidad'];
						/*$sql="Select * from oac.datos_personales_oac where numcedula='".$cedula."' and nacionalidad='".$letra."'";
						$rs1= $conn->Execute($sql);
					if ($rs1->RecordCount()>0){						
							$_SESSION['id_datos_personales']=$rs1->fields['id_datos_personales'];
							$_SESSION['boton']=true;
						}else{ */
							ProcessForm($conn);	
							$_SESSION['boton']=true;
							$aDefaultForm['mensaje_usuario']='DATOS GUARDADOS SASTIFACTORIAMENTE.';				
					//	}
						//print'<script>//document.location="oac_asistencia_caso.php"</script>';
					  }
				
			}else{
					$aDefaultForm['mensaje_usuario']='LOS DATOS NO DEBEN ESTAR VACIOS.';
				}
			break;
			}		
	  }
//			$_SESSION['boton']=false;
}

function LoadData($conn,$PostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
				if (!$bPostBack){
					echo "loaddata";
						$cedula=$_SESSION['cedulaconsulta']=$_POST['cedulaconsulta'];
						$letra=$_SESSION['nacionalidad']=$_POST['nacionalidad'];
						$dataSaime=consultando_saime($cedula,$letra);
						$sql="Select * from oac.datos_personales_oac
						 where numcedula='".$cedula."' and nacionalidad='".$letra."';";
						$rs= $conn->Execute($sql);
						if ($rs->RecordCount()>0){
								echo "hay reg";
$_POST['nombre1']=htmlentities($rs->fields['primer_nombre'],ENT_QUOTES);
						$_POST['nombre2']=htmlentities(trim($rs->fields['segundo_nombre'],ENT_QUOTES));
						$_POST['apellido1']=htmlentities(trim($rs->fields['primer_apellido'],ENT_QUOTES));
						$_POST['apellido2']=htmlentities(trim($rs->fields['segundo_apellido']),ENT_QUOTES);
						$_POST['apellidonombre']=$_POST['nombre1']." ".$_POST['nombre2']." ".$_POST['apellido1']." ".$_POST['apellido2'];
						$aDefaultForm['cedulaconsulta'] = trim($rs->fields['numcedula']);
						$aDefaultForm['apellidonombre'] = $_POST['apellidonombre'];		
						$aDefaultForm['edad'] =edad(trim($rs->fields['fechanac']));
						$aDefaultForm['sexo'] =trim($rs->fields['sexo']);
						$aDefaultForm['fecha_nac'] =$rs->fields['fechanac'];						
						if($rs->fields['nacionalidad']=='1')$_POST['checked_nacionalidad_V']="selected='selected'";
						if($rs->fields['nacionalidad']=='2')$_POST['checked_nacionalidad_E']="selected='selected'";
						$aDefaultForm['nacionalidad'] =$rs->fields['nacionalidad'];
						$aDefaultForm['telefono1'] = $_POST['telefono1'];
						$aDefaultForm['telefono2'] = $_POST['telefono2'];	
						$_POST['telefono']=$aDefaultForm['telefono1'].'-'.$aDefaultForm['telefono2'];
						$aDefaultForm['telefono'] =$_POST['telefono'];
						$aDefaultForm['email'] = $rs->fields['email'];
						$aDefaultForm['cbo_entidad'] = $rs->fields['nentidad'];
						$aDefaultForm['cbo_municipio'] = $rs->fields['nmunicipio'];
						$aDefaultForm['cbo_parroquia'] = $rs->fields['nparroquia'];
						$_POST['cbo_municipio_descripcion'] = LoadMunicipio($conn,$aDefaultForm['cbo_municipio']);
						$aDefaultForm['cbo_municipio_descripcion'] = $_POST['cbo_municipio_descripcion'];
						$_POST['cbo_parroquia_descripcion'] = LoadParroquia($conn,$aDefaultForm['cbo_parroquia']);
						$aDefaultForm['cbo_parroquia_descripcion'] = $_POST['cbo_parroquia_descripcion'];
						$aDefaultForm['cbo_recepcion']=$SESSION['cbo_recepcion']=$rs->fields['cbo_recepcion'];
						
						}else{
								echo "no hay datosa";
							$_POST['nombre1']=htmlentities(trim($dataSaime['nombre1'],ENT_QUOTES));
						$_POST['nombre2']=htmlentities(trim($dataSaime['nombre2'],ENT_QUOTES));
						$_POST['apellido1']=htmlentities(trim($dataSaime['apellido1'],ENT_QUOTES));
						$_POST['apellido2']=htmlentities(trim($dataSaime['apellido2'],ENT_QUOTES));
						$_POST['apellidonombre']=$_POST['nombre1']." ".$_POST['nombre2']." ".$_POST['apellido1']." ".$_POST['apellido2'];
						$_POST['fecha_nac']=$dataSaime['fecha_nac'];
						$_POST['edad']=edad($dataSaime['fecha_nac']);
						$_POST['sexo']=$dataSaime['sexo'];
					//	$_POST['telefono']= $_POST['telefono1']."-". $_POST['telefono2'];
				////////////
						$aDefaultForm['cedulaconsulta'] = $_POST['cedulaconsulta'];
						$aDefaultForm['apellidonombre'] = $_POST['apellidonombre'];
						$aDefaultForm['edad'] = $_POST['edad'];
						$aDefaultForm['fecha_nac'] = $_POST['fecha_nac'];
						
						if($_POST['nacionalidad']=='1')$_POST['checked_nacionalidad_V']="selected='selected'";
						if($_POST['nacionalidad']=='2')$_POST['checked_nacionalidad_E']="selected='selected'";
						$aDefaultForm['nacionalidad'] =$_POST['nacionalidad'];
						$aDefaultForm['sexo'] = $_POST['sexo'];
						 $aDefaultForm['mensaje_usuario']= "LA CEDULA DE IDENTIDAD NO ESTA REGISTRADA OAC.CONTINUE CARGANDO LOS DATOS..";
						$aDefaultForm['telefono1'] = $_POST['telefono1'];
						$aDefaultForm['telefono2'] = $_POST['telefono2'];		
						$_POST['telefono']=$aDefaultForm['telefono1'].'-'.$aDefaultForm['telefono2'];
						$aDefaultForm['telefono'] =$_POST['telefono'];
						$aDefaultForm['email'] = $_POST['email'];
						$aDefaultForm['cbo_entidad'] = $_POST['cbo_entidad'];
						$aDefaultForm['cbo_municipio'] = $_POST['cbo_municipio'];
						$aDefaultForm['cbo_parroquia'] = $_POST['cbo_parroquia'];
						$aDefaultForm['cbo_municipio_descripcion'] = $_POST['cbo_municipio_descripcion'];
						$aDefaultForm['cbo_parroquia_descripcion'] = $_POST['cbo_parroquia_descripcion'];
						$aDefaultForm['cbo_recepcion']=$_SESSION['cbo_recepcion']=$_POST['cbo_recepcion'];
						}
			}
			//mostrar el listado de casos
			 listar($conn,$cedula,$letra);
			
	}
}
function listar($conn,$cedula,$letra){
$sqli1="SELECT id_detalle_atencion,  snro_caso, dfecha_recepcion, 
       id_via_recepcion, id_tipo_asistencia, splanteamiento_caso, id_tipo_caso, 
       id_detalle_caso, id_dato, srif, snombre_empresa, ssector, snombre_sindicato, 
       snombre_contacto, stelefono_contacto, semail_contacto, id_organismo_remite, 
       id_organismo_remitido, dfecha_remision, id_status, 
       sobservaciones, id_gestion, snro_memo
  FROM oac.detalle_oac 
  inner join oac.datos_personales_oac on oac.datos_personales_oac.id_datos_personales=oac.detalle_oac.id_datos_personales
  where numcedula='".$cedula."' and nacionalidad='".$letra."'; "; 
$rs11= $conn->Execute($sqli1);
if($rs11->RecordCount()>0 ){
			$aTabla1[]=array();
			$i=0;
			
			$aTabla1 = &$GLOBALS['aTabla1'];
			// cargo todos los dispensas de las solvencia
			while(!$rs11->EOF){
				//$aTabla1[$i]['id']=$j;
				$aTabla1[$i]['caso']=$rs11->fields['snro_caso'];
				$aTabla1[$i]['dfecha_recepcion']=$rs11->fields['dfecha_recepcion'];
				$aTabla1[$i]['id_via_recepcion']=$rs11->fields['id_via_recepcion'];
				$aTabla1[$i]['id_status']=$rs11->fields['id_status'];	
				$aTabla1[$i]['sobservaciones']=$rs11->fields['sobservaciones'];				
				$i++;						
			$rs11->MoveNext();
			}
	}
}
function	ProcessForm($conn){
	$fecha_hoy=date('c');
	$_SESSION['nusuario']='13885175';
	$sql="INSERT INTO oac.datos_personales_oac(
            numcedula, primer_apellido, segundo_apellido, 
            primer_nombre, segundo_nombre, fechanac, nacionalidad, sexo, 
            stlf_hab, semail, nentidad, nmunicipio, 
            nparroquia, nenabled, nusuario_creacion, dfecha_creacion)
    VALUES ('".$_POST['cedulaconsulta']."', '".$_POST['apellido1']."','".$_POST['apellido2']."', 
            '".$_POST['nombre1']."', '".$_POST['nombre2']."', '".	$_POST['fecha_nac']."','".	$_POST['nacionalidad']."','".	$_POST['sexo']."', '".$_POST['telefono']."', 
            '".$_POST['email']."', '".$_POST['cbo_entidad']."','".$_POST['cbo_municipio']."', '".$_POST['cbo_parroquia']."','1', '".$_SESSION['nusuario']."', 
            '".$fecha_hoy."');";
	$rs=$conn->Execute($sql);
	$rs=$conn->Execute("select max(id_datos_personales) from oac.datos_personales_oac");
	$_SESSION['id_datos_personales']=$rs->fields[0];
}
function edad($fecha){
    $fecha = str_replace("/","-",$fecha);
    $fecha = date('Y/m/d',strtotime($fecha));
    $hoy = date('Y/m/d');
    $edad = $hoy - $fecha;
    return $edad;
}
function showHeader(){
	include("header.php"); ?>
	
<?
}
function showForm($conn,$aDefaultForm){
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="form" id="form">
 <p>
   <input name="action" type="hidden" value="">
<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="Validacion_oac_datos_personales.js"></script>
<script language="JavaScript" type="text/javascript" src="funciones.js"></script>
<link href='../css/plantilla.css' type=text/css rel=stylesheet>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/botones_IZ.css">
<script src="../js/jquery.dataTables.js" type="text/javascript"> </script>
<link type="text/css" rel="stylesheet" href="../js/demo_table.css" />
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
<td width="66%"><select id="cbo_recepcion" name="cbo_recepcion">
  <option value="">Seleccione</option>
  <? LoadViaRecepcion ($conn) ; print $GLOBALS['sHtml_cb_recepcion']; ?>
</select><span class="requerido"> * </span></td>
</tr>

</table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>


 <table width="96%" align="center" class="formulario" border="0">
 
  <th class="sub_titulo" colspan="5" align="left">DATOS PERSONALES.- Persona que requiere del caso </th>
<tr>
  <td colspan="2" >C&eacute;dula Identidad
        <select name="nacionalidad" id="nacionalidad" >
          <option value="1"  <?=$_POST['checked_nacionalidad_V']?>>V</option >
          <option value="2" <?=$_POST['checked_nacionalidad_E']?>>E</option>
        </select>
		<input name="cedulaconsulta" id="cedulaconsulta" type="text" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." maxlength="8" onkeypress="return isNumberKey(event);" value="<?=$aDefaultForm['cedulaconsulta'];?>" ></td>
  <td >   <button type="button" class="button btn_buscar"onClick="JavaScript:send('cmd_buscar_cedula')"  >Buscar</button></td>
   <td width="45%"  >Apellidos y Nombres: <strong> <input name="apellidonombre" type="text" disabled="disabled" id="apellidonombre" value="<?=$aDefaultForm['apellidonombre'];?>" size="50"></strong></td>
  </tr>
    <tr>
      <td colspan="3">Edad:<strong><input name="edad" type="text" disabled="disabled" id="edad" value="<?=$aDefaultForm['edad'];?>" size="4" maxlength="3">a&ntilde;os</strong></td>
      <td>Sexo:
        <select name="sexo" id="sexo" disabled>
        <option value="0" selected="selected" >Seleccione</option>
        <option value="1" <? if (($aDefaultForm['sexo'])=='1') print "selected=\"selected\"";?>>Masculino</option>
        <option value="2" <? if (($aDefaultForm['sexo'])=='2') print "selected=\"selected\"";?>>Femenino</option>
        </select></td>  
      </tr>
       <tr>
    <td colspan="3"><label>Telefono:
      <input name="telefono1" type="text" id="telefono1" onkeypress="return isNumberKey(event);" value="<?=$aDefaultForm['telefono1'];?>" onblur="" size="5" maxlength="4" autocomplete="ON"/> 
      <label> - </label> 
	  <input name="telefono2" type="text" id="telefono2" onblur=""  onkeypress="return isNumberKey(event);"  value="<?=$aDefaultForm['telefono2'];?>" size="8" maxlength="7" autocomplete="ON"/> 
	 
      </label></td>
    <td colspan="3"><label>Correo:
      <input name="email" type="text" id="email"  size="50" onblur="validarEmail()" value=""/> 
    </label></td>
    </tr>
     <tr>
    <td colspan="3">Ubicaci&oacute;n Geogr&aacute;fica <label>Estado:
		<select id="cbo_entidad" name="cbo_entidad" onChange="estado_combo();">
			<option value="">Seleccione</option>
			<? LoadEstado ($conn) ; print $GLOBALS['sHtml_cb_Estado']; ?>
		</select>
    </label></td>
    <td width="45%"><label>Municipio:
      <select id="cbo_municipio" name="cbo_municipio" onChange="municipio_combo();">
        <option value="">Seleccione</option>
       
			<option <? if($aDefaultForm['cbo_municipio']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_municipio']; ?>"><?= $aDefaultForm['cbo_municipio_descripcion'];?></option>
		</select>      
      </label>
     </td>
      </tr>
    <tr>
    <td colspan="3"><label>Parroquia:
        <select id="cbo_parroquia" name="cbo_parroquia">
        <option value="">Seleccione</option>
        <option <? if($aDefaultForm['cbo_parroquia']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_parroquia']; ?>"><?= $aDefaultForm['cbo_parroquia_descripcion'];?></option>
      </select>
    </label>
  </tr>       
 </table>
 <table width="50%" border="0" class="listado formulario" align="center">
   <tr>
   <th colspan="2" align="center" class="sub_titulo"><img src="../imagenes/warning_32.png" width="16" height="16"/><? print $aDefaultForm['mensaje_usuario']; ?></th>
   </tr>
    </table>
    <table width="29%" border="0" align="center"> 
   <tr>
     <td align="center" class="formulario"><button type="button" id="enviar" name="enviar" class="button btn_guardar"onClick="JavaScript:send('guardar')"  >Guardar</button></td>
    
    </tr>
 </table>
 <p>&nbsp;</p>
 <p>
   <? ///listado de caso?>
   
 </p>
 <div  style=" font-size:11px; width:60%; margin-left:auto; margin-right:auto;  ">     
   <table  border="0" align="center" class="listado formulario" id="tblDetalle" style=" ">
<thead>
<tr>
  <th colspan="5" class="titulo"align="center">LISTADO DE SOLICITUDES REALIZADAS POR EL CIUDADANO</th>
</tr>
 <tr>
 			<th class="sub_titulo" align="center" width="10%">N&deg; Caso</th>
      <th class="sub_titulo" align="center" width="10%">Fecha de Recepci&oacute;n</th> 
      <th class="sub_titulo" align="center" width="10%">V&iacute;  de Recepci&oacute;n</th>
      <th class="sub_titulo" align="center" width="10%">Estatus del Caso</th>
      <th class="sub_titulo" align="center" width="10%">Observaciones</th>
   </tr>
  <tbody> 
<? $aTabla1 = &$GLOBALS['aTabla1'];
	$c = count($aTabla1)-1;

	//echo $c;
	for( $i=0; $i <= $c; $i++){		
?> 
		
    <tr>
   		<td ><div align="center"><strong><?=$aTabla1[$i]['caso'];?></strong></div> </td>
      <td ><div align="center"><strong><?=$aTabla1[$i]['dfecha_recepcion'];?></strong></div> </td>
      <td ><div align="center"><strong><?=$aTabla1[$i]['id_via_recepcion'];?></strong></div> </td>
      <td ><div align="center"><strong><?=$aTabla1[$i]['id_status'];?></strong></div> </td>
      <td ><div align="center"><strong><?=$aTabla1[$i]['sobservaciones'];?></strong></div> </td>
    </tr>     
	<? }?>
</tbody>
</thead>
</table>
</div>
 </form> <p>&nbsp;</p>

<?
}


function showFooter(){
	$aPageErrors = $GLOBALS['aPageErrors'];
	print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script> alert('".join('\n',$aPageErrors)."') </script>":"";
	include("footer.php");
} 
?>
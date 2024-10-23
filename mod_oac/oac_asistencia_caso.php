<?
include("../header.php"); 
session_start();

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

include ('consulta_entes.php');
//include("LoadCombos.php");
require_once ('consulta_empresa.php');

doAction($conn);
debug();
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
			case 'siguiente':		
			$pase=$_POST['cedulaconsulta'].'/'.$_POST['nacionalidad'].'/'.$_POST['edad'].'/'.$_POST['sexo'].'/'.$_POST['nombre1'].'/'.$_POST['nombre2'].'/'.$_POST['apellido1'].'/'.$_POST['apellido2'].'/'.$_POST['fecha_nac'].'/'.$_POST['beneficiario'];
			$pase=base64_encode($pase);	
			$_SESSION['mostrar']=0;	
				$_SESSION['nun_caso']='';
			?><script>
				if (confirm("¿Est&aacute; seguro de generar un nuevo caso?")){
				document.location='oac_asistencia_caso.php?pas=<?=$pase?>';}
			</script><?
				LoadData($conn,false);		
				unset($_SESSION['mostrar']);				
				unset($_SESSION['nun_caso']);
			break;
			case 'regresar':		
				unset($_SESSION['mostrar']);	
				unset($_SESSION['nun_caso'])
			?><script>			
				document.location='datos_personales.php';
			</script><?
			
			break;
			case 'guardar':
			$bValidateSuccess=true;
			LoadData($conn,false);
		
			if($_POST['cbo_recepcion']==''){
				$GLOBALS['aPageErrors'][]= "- Medios de Recepción es requerido.";
				$bValidateSuccess=false;
				}	
			if($_POST['cbo_asistencia']=='0'){
				$GLOBALS['aPageErrors'][]= "- El Tipo de Solicitud es requerida.";
				$bValidateSuccess=false;
				}	
			if($_POST['cbo_detalle_gestion']=='0'){
				$GLOBALS['aPageErrors'][]= "- La Gestión de la Solicitud es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_detalle_gestion']=='2' and $_POST['cbo_tipo_caso_rnet']=='0'){
				$GLOBALS['aPageErrors'][]= "- El Tipo de Caso del RNET es requerido.";
				$bValidateSuccess=false;
			}else{$_POST['cbo_tipo_caso_rnet']=0;}
			if($_POST['cbo_tipo_caso_rnet']=='1' and $_POST['cbo_detalle_caso_rnet']=='0'){
				$GLOBALS['aPageErrors'][]= "- El Detalle del Caso es requerido.";
				$bValidateSuccess=false;
			}else{$_POST['cbo_detalle_caso_rnet']=0;}
			
			if($_POST['cbo_detalle_caso_rnet']=='2' and $_POST['cbo_dato_corregir_rnet']=='0'){
				$GLOBALS['aPageErrors'][]= "- El dato a corregir es requerido.";
				$bValidateSuccess=false;
			}else{$_POST['cbo_dato_corregir_rnet']=0;}
			if($_POST['planteamiento_caso']==''){
				$GLOBALS['aPageErrors'][]= "- Debe Especificar detalladamente la Solicitud.";
				$bValidateSuccess=false;
			}
			//if($_POST['srif']==''){
//				$GLOBALS['aPageErrors'][]= "- El RIF de la entidad de erabajo es requerido.";
//				$bValidateSuccess=false;
//			}
//		   /* if($_POST['nombre_empresa']==''){
//				$GLOBALS['aPageErrors'][]= "- El nombre o razon Social de la entidad de trabjo es requerido.";
//				$bValidateSuccess=false;
//			}*/
//			 if($_POST['cbo_sector']==''){
//				$GLOBALS['aPageErrors'][]= "- El sector de la entidad de trabjo es requerido.";
//				$bValidateSuccess=false;
//			}
//			 if($_POST['nombre_sindicato']==''){
//				$GLOBALS['aPageErrors'][]= "- El nombre de la organizacion sindical es requerido.";
//				$bValidateSuccess=false;
//			}
//			 if($_POST['telefono_sindicato1']=='' or $_POST['telefono_sindicato2']='' ){
//				$GLOBALS['aPageErrors'][]= "- El telefono de contacto de la organizacion sindical es requerido.";
//				$bValidateSuccess=false;
//			}
//			 if($_POST['email_contacto']==''){
//				$GLOBALS['aPageErrors'][]= "- El correo de la organizacion sindical es requerido.";
//				$bValidateSuccess=false;
//			}

			/* $_POST['email_contacto']= trim($_POST['email_contacto1'])."@".trim($_POST['email_contacto2']);
			 //echo  $_POST['email_contacto'];
             if($_POST['email_contacto']!=''){		
			 if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $_POST['email_contacto'])) 
					{
						$GLOBALS['aPageErrors'][]= "- El correo electronico del ciudadano es Invalido.";
						$bValidateSuccess=false;
					}								
			}*/
			/* if($_POST['persona_remite_caso']==''){
				$GLOBALS['aPageErrors'][]= "- La persona que remite el caso es requerido.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_organismo']==''){
				$GLOBALS['aPageErrors'][]= "- El organismo a quien fue remitido el caso es requerido.";
				$bValidateSuccess=false;
			}
			 if($_POST['f_remision']==''){
				$GLOBALS['aPageErrors'][]= "- La fecha de remision del caso es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['numero_memo']==''){
				$GLOBALS['aPageErrors'][]= "- El numero de memo es requerido.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_resultado']==''){
				$GLOBALS['aPageErrors'][]= "- El resultado del caso es requerido.";
				$bValidateSuccess=false;
			}
			if($_POST['observaciones']==''){
				$_POST['observaciones']='SIN OBSERVACIONES';
			}
			if (strlen($_POST['persona_remite_caso'])<10){
				$GLOBALS['aPageErrors'][]= "- La persona que remite el caso debe contener al menos 10 caracteres Nombre y Apellido.";
				$bValidateSuccess=false;
				 }
			if (strlen($_POST['planteamiento_caso'])<10){
				$GLOBALS['aPageErrors'][]= "- El planteamiento del caso debe contener al menos 10 caracteres.";
				$bValidateSuccess=false;
				 }	 
				 if (strlen($_POST['observaciones'])<10){
				$GLOBALS['aPageErrors'][]= "- La Observación(es) debe contener al menos 10 caracteres.";
				$bValidateSuccess=false;
				 }	*/ 
		
			if($bValidateSuccess){				
				ProcessForm($conn);
				LoadData($conn,false);
				//$_SESSION['mostrar']=1;
				$bValidateSuccess=false;
			}
			break;
	  }
}else{
	LoadData($conn,false);
	unset($_SESSION['mostrar']);
	//$_SESSION['mostrar']=0;
	unset($_SESSION['nun_caso']);
	}
}
function edad($fecha){
	$fechanacimiento=$fecha;
	list($ano,$mes,$dia) = explode("-",$fechanacimiento);
	$ano_diferencia  = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia   = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0)
	$ano_diferencia--;
	return $ano_diferencia;
    /*$fecha = str_replace("/","-",$fecha);
    $fecha = date('Y/m/d',strtotime($fecha));
    $hoy = date('Y/m/d');
    $edad = $hoy - $fecha;
    return $edad;*/
}
function LoadData($conn,$PostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
					$aDefaultForm['cbo_recepcion']=$_POST['cbo_recepcion'];
					$aDefaultForm['cbo_asistencia']='';
					$aDefaultForm['cbo_detalle_gestion']='';					
					$aDefaultForm['cbo_tipo_caso_rnet']='';
					$aDefaultForm['cbo_detalle_caso_rnet']='';
					$aDefaultForm['cbo_dato_corregir_rnet']='';
					$aDefaultForm['planteamiento_caso']='';
					$aDefaultForm['srif']='';
					$aDefaultForm['nombre_empresa']=$_POST['nombre_empresa'];			
					$aDefaultForm['cbo_sector']='0';
						
					$aDefaultForm['nombre_sindicato']='';						
					$aDefaultForm['telefono_sindicato1']='';
					$aDefaultForm['telefono_sindicato2']='';		
					$aDefaultForm['email_contacto']='';
						
					$aDefaultForm['persona_remite_caso']='';
					$aDefaultForm['cbo_organismo']='0';
					$aDefaultForm['f_remision']='0000-00-00';			
					$aDefaultForm['numero_memo']='';
					$aDefaultForm['cbo_resultado']='';
					$aDefaultForm['observaciones']='';
		
				if (!$bPostBack){
					
					if ($_GET['pas']!='')	{
					//echo 'geeeeet';
					 $pase=base64_decode($_GET['pas']);	  
					$pase_nuevo= explode("/",$pase);
					$_POST['cedulaconsulta']=$aDefaultForm['cedulaconsulta']=$pase_nuevo[0]; //CEDULA
					$_POST['nacionalidad']=$aDefaultForm['nacionalidad']=$pase_nuevo[1]; //NACIONALIDAD
					$_POST['edad']=$aDefaultForm['edad']=$pase_nuevo[2]; //EDAD
					$_POST['sexo']=$aDefaultForm['sexo']=$pase_nuevo[3];  //SEXO
					$_POST['nombre1']=$aDefaultForm['nombre1']=$pase_nuevo[4];  //NOMBRE1
					$_POST['nombre2']=$aDefaultForm['nombre2']=$pase_nuevo[5];  //NOMBRE2
					$_POST['apellido1']=$aDefaultForm['apellido1']=$pase_nuevo[6];  //APELLIDO1
					$_POST['apellido2']=$aDefaultForm['apellido2']=$pase_nuevo[7];  //APELLIDO2
					$_POST['fecha_nac']=$aDefaultForm['fecha_nac']=$pase_nuevo[8];  //FECHA DE NACIMIENTO
					$_POST['beneficiario']=$aDefaultForm['beneficiario']=$pase_nuevo[9];  //beneficiARIO
					$_POST['apellidonombre']=$aDefaultForm['apellidonombre']=$_POST['nombre1']." ".$_POST['nombre2']." ".$_POST['apellido1']." ".$_POST['apellido2'];
					}	
										
					$aDefaultForm['cbo_recepcion']=$_POST['cbo_recepcion'];
					$aDefaultForm['cbo_asistencia']=$_POST['cbo_asistencia'];
					$aDefaultForm['cbo_detalle_gestion']=$_POST['cbo_detalle_gestion'];
					
					$aDefaultForm['cbo_tipo_caso_rnet']=$_POST['cbo_tipo_caso_rnet'];
					$aDefaultForm['cbo_detalle_caso_rnet']=$_POST['cbo_detalle_caso_rnet'];
					$aDefaultForm['cbo_dato_corregir_rnet']=$_POST['cbo_dato_corregir_rnet'];
					$aDefaultForm['planteamiento_caso']=$_POST['planteamiento_caso'];		
							
					$aDefaultForm['srif']=$_POST['srif'];
					$aDefaultForm['nombre_empresa']=$_POST['nombre_empresa'];	
					//$_POST['nombre_empresa']=$aDefaultForm['nombre_empresa'];					
					$aDefaultForm['cbo_sector']=$_POST['cbo_sector'];
						
					$aDefaultForm['nombre_sindicato']=$_POST['nombre_sindicato'];						
					$aDefaultForm['telefono_sindicato1']=$_POST['telefono_sindicato1'];	
					$aDefaultForm['telefono_sindicato2']=$_POST['telefono_sindicato2'];		
					$aDefaultForm['email_contacto']=$_POST['email_contacto1']+"@"+$_POST['email_contacto2'];	
					$aDefaultForm['email_contacto1']=$_POST['email_contacto1'];		
					$aDefaultForm['email_contacto2']=$_POST['email_contacto2'];	
					$aDefaultForm['persona_remite_caso']=$_POST['persona_remite_caso'];	
					$aDefaultForm['cbo_organismo']=$_POST['cbo_organismo'];	
					$aDefaultForm['f_remision']=$_POST['f_remision'];				
					$aDefaultForm['numero_memo']=$_POST['numero_memo'];	
					$aDefaultForm['cbo_resultado']=$_POST['cbo_resultado'];	
					$aDefaultForm['observaciones']=$_POST['observaciones'];				
					//unset($_SESSION['nun_caso']);
		}
		
	}
}
function ProcessForm($conn){

	$fecha_hoy=date("Y-m-d H:m:s");
	$fecha_corta=date("Y-m-d");
	//$fecha_hoy=date('c');
	//$snro_caso='12345678';
	//$_SESSION['nusuario']='13885175';


/*	if($_SESSION['existe']=='1'){
	//$_SESSION['id_datos_personales']='';
		$_SESSION['nun_caso']='';
	}*/
	
	$Sql="select * from oac.detalle_oac where snro_caso='".$_SESSION['nun_caso']."'";
	$rs2=$conn->Execute($Sql);
	if($rs2->RecordCount()>0){ 
					
					$_SESSION['mostrar']=1;
					unset($_SESSION['nun_caso']);
					echo "<script>alert('El caso ya se encuentra registrado. Por favor verificar sus datos e intente nuevamente');</script>";	
	}else{
		if($_SESSION['nun_caso']=='')	{
			$SQL="INSERT INTO oac.detalle_oac(
             id_datos_personales,  snro_caso, dfecha_recepcion, 
            id_via_recepcion, id_tipo_asistencia, splanteamiento_caso, id_tipo_caso, 
            id_detalle_caso, id_dato, srif, snombre_empresa, ssector, snombre_sindicato, 
            snombre_contacto, stelefono_contacto, semail_contacto, id_organismo_remite, 
            id_status, nenabled, 
            nusuario_creacion, dfecha_creacion,  
            sobservaciones,  snro_memo,ntipo_beneficiario)
    VALUES (".$_SESSION['id_datos_personales'].",
		    '".$snro_caso."',
			'".$fecha_hoy."',
            '".$_POST['cbo_recepcion']."' ,
			'".$_POST['cbo_asistencia']."',
			'".$_POST['planteamiento_caso']."',
			'".$_POST['cbo_tipo_caso_rnet']."', 
			'".$_POST['cbo_detalle_gestion']."',
			'".$_POST['cbo_dato_corregir_rnet']."', 
			'".$_POST['srif']."',
			'".$_POST['nombre_empresa']."',
			'".$_POST['cbo_sector']."',
			'".$_POST['nombre_sindicato']."', 
			'".$_POST['persona_remite_caso']."',
			'".$_POST['telefono_sindicato1'].$_POST['telefono_sindicato2']."',
			'".$_POST['email_contacto']."',
			'1',	
			
			'2',
			'1',
			'".$_SESSION['id_usuario']."', 
			 '".$fecha_hoy."',
			'".$_POST['observaciones']."',
			
			'".$_POST['numero_memo']."', 
			'".$_POST['beneficiario']."'	)";
			$rs3=$conn->Execute($SQL);
	
		    if($rs3){
				$Sql="select max(id_detalle_atencion)as numero from oac.detalle_oac";
				$rs4=$conn->Execute($Sql);
				$input=$rs4->fields['numero'];
				$salida= str_pad($input,6, "0", STR_PAD_LEFT);
				$_SESSION['nun_caso']='C-'.$salida;
					
				$sq="UPDATE oac.detalle_oac
				SET snro_caso='".$_SESSION['nun_caso']."'
				WHERE id_detalle_atencion=".$rs4->fields['numero']."";
				$rs5=$conn->Execute($sq);
			}
			 if($rs2 and $rs3 and $rs4 and $rs5){
				echo "<script>alert('El caso se registro EXITOSAMENTE bajo el número  ".$_SESSION['nun_caso']."');</script>";
				$_SESSION['mostrar']=1;
				?><script>document.location="vista.php"; </script><?
			 }else{
				 echo "<script>alert('El caso NO pudo ser registrado. Por favor verificar sus datos');</script>";
				 	$_SESSION['mostrar']=0;
			 }
	}
	}
}
?>

<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>

<form action="<? //= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="form" id="form">
 <p>
<input name="action" type="hidden" value="">
<input name="cedulaconsulta" type="hidden" value="<?=$aDefaultForm["cedulaconsulta"]?>" />
<input name="nacionalidad" type="hidden" value="<?=$aDefaultForm["nacionalidad"]?>" />
<input name="apellidonombre" type="hidden" value="<?=$aDefaultForm["apellidonombre"]?>" />
<input name="nombre1" type="hidden" value="<?=$aDefaultForm["nombre1"]?>" />
<input name="nombre2" type="hidden" value="<?=$aDefaultForm["nombre2"]?>" />
<input name="apellido1" type="hidden" value="<?=$aDefaultForm["apellido1"]?>" />
<input name="apellido2" type="hidden" value="<?=$aDefaultForm["apellido2"]?>" />
<input name="edad" type="hidden" value="<?=$aDefaultForm["edad"]?>" />
<input name="sexo" type="hidden" value="<?=$aDefaultForm["sexo"]?>" />
<input name="fecha_nac" type="hidden" value="<?=$aDefaultForm["fecha_nac"]?>" />
<input name="beneficiario" type="hidden" value="<?=$aDefaultForm["beneficiario"]?>" />
<input name="email_contacto" type="hidden" value="<?=$aDefaultForm["email_contacto"]?>" />
<input name="nombre_empresa" type="hidden" value="<?=$aDefaultForm["nombre_empresa"]?>" />
<script language="JavaScript" type="text/javascript" src="Validacion_oac_asistencia_caso.js"></script>
<script language="JavaScript" type="text/javascript" src="funciones.js"></script>
<script src="/minpptrassi/datatables/funcion_paginador.js"></script>
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
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>

</p>
<div>
<table width="95%" align="center" class="formulario" border="0">
 	<tr>
		<th colspan="4"  class="sub_titulo"><div align="left">AC --> Generar Caso</div></th>
	</tr>
	
	<tr>
		<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
	</tr>
</table>

<table width="70%" align="center" class="formulario" bordercolor="#CCCCCC" border="0">
	<tr>
		<td colspan="4" align="right" height="20"></td>
	</tr>
	
<!--	<tr>
		<th width="15%"  class="sub_titulo">Fecha</th>
		<td style="border-radius: 30px; background-color:#F0F0F0; width:15%" align="center" ><font color="#666666"><?=date('d/m/Y')?></font></td>
		<th width="15%" class="sub_titulo" >Recepci&oacute;n</th>
		<td style="border-radius: 30px; background-color:#F0F0F0; width:15%" align="center" ><font color="#666666"><?=date('d/m/Y')?></font></td>
	</tr>-->
	
	<tr>
		<!-- <th width="20%" class="sub_titulo" style="font-size: 12px; text-align: center;">
			<div align="center">Fecha Recepción</div>
		</th> -->
		<!-- <td width="18%" align="center" style="border-radius: 30px; background-color:#F0F0F0; width:15%; font-size: 12px;">
			 <font color="#666666"><?php /* date('d/m/Y') */?></font> 
		</td> -->
		<!-- <th width="20%" class="sub_titulo"><div align="center">Recibido por</div></th>  
		<td width="42%" align="center"><font color="#666666">
		  <select style="border-radius: 30px; background-color:#F0F0F0; width:85%" id="cbo_recepcion"   name="cbo_recepcion">
		  <option value="">Seleccione</option>
		  <? /* LoadViaRecepcion ($conn) ; print $GLOBALS['sHtml_cb_recepcion']; */ ?>
		</select></font><span class="requerido"> * </span></td> -->
	</tr>

<!--       <tr>
            <th colspan="4" height="8"></th>
      </tr>  -->
		
<!--	<tr>
		<th class="sub_titulo" >Nro Caso</th>
		<td style="border-radius: 30px; background-color:#F0F0F0; width:15%" align="center"><b><font color="#666666"><?=$_SESSION['nun_caso'];?></font></b></td>
		<th class="sub_titulo">Recibido por</th> 
		<td align="center" ><font color="#666666"><select style="border-radius: 30px; background-color:#F0F0F0; width:85%" id="cbo_recepcion"   name="cbo_recepcion">
		  <option value="">Seleccione</option>
		  <? /* LoadViaRecepcion ($conn) ; print $GLOBALS['sHtml_cb_recepcion']; */ ?>
		</select></font><span class="requerido"> * </span></td>
	</tr>	-->
</table>
<!-- </div>
	<p>&nbsp;</p>
<div> -->
<table width="95%" align="center" class="formulario" border="0" style="margin-top: -5px;">
	<tr class="identificacion_seccion" >
		<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="5" class="sub_titulo"  align="left">DATOS B&Aacute;SICOS DEL CIUDADANO BENEFICIARIO</th>
	</tr>
	
	<tr>
		<th colspan="5" height="10"></th>
	</tr> 
	
	<tr>
		<th width="19%" style="color:#666666"><div align="left">C&eacute;dula de Identidad</div></th>
	 	<th width="26%" style="color:#666666"><div align="left">Nombre(s) y Apellido(s)</div> </th>
	 	<th width="16%" style="color:#666666"><div align="left">Edad</div></th>
	 	<th width="13%" style="color:#666666"><div align="left">Sexo</div></th>  
	 	<th width="26%" style="color:#666666"><div align="left">Clase</div></th>  
	</tr>

	<tr>
		<th colspan="5" height="10"></th>
	</tr> 
 
	<tr align="center">  
		<td align="left"><font color="#666666" >  <? if($aDefaultForm['nacionalidad']=="1")print"V-"; else print"E-";?></font><font color="#666666"><? print $aDefaultForm['cedulaconsulta'];?></font></td>    
		<td align="left"><font color="#666666"><? print $aDefaultForm['apellidonombre'];?></font></td>
        <td align="left">
  	<font color="#666666"><? print $aDefaultForm['edad'];?> a&ntilde;os </font></td>
	    <td align="left"><font color="#666666">
			<? if ($aDefaultForm['sexo']=='1') print "Masculino";
			if ($aDefaultForm['sexo']=='2') print "Femenino";?>   </font></td>  
	    <td align="left"><font color="#666666">
			  <? if ($aDefaultForm['beneficiario']=='1') print "Trabajador MPPPST";
			if ($aDefaultForm['beneficiario']=='2') print "Beneficiario Externo";?>
			</font></td>  
	</tr>

  <tr>
   <td colspan="5" height="10"></td> 
  </tr>
		
<tr class="identificacion_seccion" >
<th style="border-radius: 30px; border-color:#999999; width:85%" class="sub_titulo" colspan="5" align="left">DATOS DE LA SOLICITUD</th>
</tr>
   
	<tr>
		<th colspan="6" height="8"></th>
	</tr> 
	
    <tr>
	<th style="color:#666666" colspan="1" align="left"> Medios de Recepción</th>
       <th style="color:#666666" colspan="2" align="left">Tipo</th>
       <th style="color:#666666" colspan="3" align="left"> Gesti&oacute;n</th>
     </tr>
	 
	 <tr>
		<th colspan="5" height="6"></th>
	</tr> 
	
     <tr>

	 <td colspan="1"><font color="#666666">
		  <select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_recepcion"   name="cbo_recepcion">
		  <option value="">Seleccione</option>
		  <? LoadViaRecepcion ($conn) ; print $GLOBALS['sHtml_cb_recepcion']; ?>
		</select></font><span class="requerido"> * </span></td>

		<!-- <td colspan="2"><font color="#666666">
		  <select style="border-radius: 30px; border-color:#999999; width:90%" id=""   name="">
		  <option value="0">Seleccione</option>
		  <? /* LoadViaRecepcion ($conn) ; print $GLOBALS['sHtml_cb_asistencia'];  */?>
		</select></font><span class="requerido"> * </span></td> -->

        <td colspan="2"><font color="#666666" >
         <select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_asistencia" name="cbo_asistencia"  title="Tipo de Asistencia - Seleccione s&oacute;lo una opci&oacute;n del listado.">
           <option value="0">Seleccione</option>
           <?  LoadAsistencia ($conn) ; print $GLOBALS['sHtml_cb_asistencia'];  ?>
         </select>
         <span class="requerido">*</span></font></td> 
			
       <td colspan="3"><font color="#666666" >
            <select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_detalle_gestion" name="cbo_detalle_gestion" title="Detalle de Gesti&oacute;n - Seleccione s&oacute;lo una opci&oacute;n del listado."onChange="JavaScript:send('Actualizar_combos')">
            <option value="0">Seleccione</option>
            <? LoadDetalleGestion ($conn,$_POST['cbo_asistencia']) ; print $GLOBALS['sHtml_cb_detalle_gestion']; ?>
            </select>
         	<span class="requerido">*</span></font></td>
     </tr>
     
	<tr>
		<th colspan="5" height="8"></th>
	</tr> 
	
     <tr>
     <? if($_POST['cbo_detalle_gestion']=='2'&& $_POST['cbo_asistencia']=='1') {?>
     		<th class="sub_titulo">Tipo de Caso RNET</th><? }
        if($_POST['cbo_asistencia']=='1' && $_POST['cbo_tipo_caso_rnet']=='1' && $_POST['cbo_detalle_gestion']=='2'){ ?>
     		<th  class="sub_titulo">Detalle del Caso RNET</th>
     		<? }
        if($_POST['cbo_asistencia']=='1' && $_POST['cbo_detalle_gestion']=='2' && $_POST['cbo_tipo_caso_rnet']=='1' && $_POST['cbo_detalle_caso_rnet']=='2'){ ?>
     		<th   colspan="3" class="sub_titulo">Dato a Corregir RNET</th>
            <? } ?>
     </tr>
     
     <tr>
     <? if($_POST['cbo_detalle_gestion']=='2' && $_POST['cbo_asistencia']=='1') {?>
     <td>
            <select style="border-radius: 30px; border-color:#999999; width:95%" id="cbo_tipo_caso_rnet" name="cbo_tipo_caso_rnet" title="Tipo de Caso RNET - Seleccione s&oacute;lo una opci&oacute;n del listado" onChange="JavaScript:send('Actualizar_combos')">
            <option value="0">Seleccione</option>
            <? LoadTipoCasoRnet ($conn) ; print $GLOBALS['sHtml_cb_tipo_caso_rnet']; ?>
            </select>
         	<span class="requerido">*</span></td><? }
	 if($_POST['cbo_asistencia']=='1' && $_POST['cbo_tipo_caso_rnet']=='1' && $_POST['cbo_detalle_gestion']=='2'){ ?>
     <td>
           <select style="border-radius: 30px; border-color:#999999; width:95%" id="cbo_detalle_caso_rnet" name="cbo_detalle_caso_rnet" title="Detalle del Caso RNET - Seleccione s&oacute;lo una opci&oacute;n del listado"onChange="JavaScript:send('Actualizar_combos')">
            <option value="0">Seleccione</option>
            <? LoadDetalleCasoRnet ($conn) ; print $GLOBALS['sHtml_cb_detalle_caso_rnet']; ?>
            </select>
         	<span class="requerido">*</span></td><? }
			if($_POST['cbo_asistencia']=='1' && $_POST['cbo_detalle_gestion']=='2' && $_POST['cbo_tipo_caso_rnet']=='1' && $_POST['cbo_detalle_caso_rnet']=='2'){ ?>
     <td colspan="3">
     		<select style="border-radius: 30px; border-color:#999999; width:95%" id="cbo_dato_corregir_rnet" name="cbo_dato_corregir_rnet" title="Dato a Corregir - Seleccione s&oacute;lo una opci&oacute;n del listado"onChange="JavaScript:send('Actualizar_combos')">
             <option value="0">Seleccione</option>
             <? LoaddatoCorregirRnet ($conn) ; print $GLOBALS['sHtml_cb_dato_corregir_rnet']; ?>
         </select>
         <span class="requerido">*</span></td><? } ?>
     </tr>
     
     <tr>
       <th style="color:#666666" colspan="5" align="left">Especificaciones de la Solicitud</th>
     </tr>
	 
  <tr>
   <td colspan="4" height="5"></td>
  </tr>
 
   <tr>
     <td colspan="5"><font color="#666666"></textarea><textarea  style="border-radius: 15px; border-color:#999999; width:98%" id="planteamiento_caso" name="planteamiento_caso" cols="125%" rows="3%"  title="Planteamiento del Caso - Ingrese letras y/o n&uacute;meros" onkeyup="mayusculas(this);" class="areatexto" placeholder="Especificaciones de la Solicitud"><? print $aDefaultForm['planteamiento_caso'];?></textarea>
       <span class="requerido">*</span></font></td>
   </tr>
   
  <tr>
   <td  height="10"></td>
  </tr>
   
          <?  if($_POST['cbo_asistencia']=='1' or $_POST['cbo_asistencia']>2) {?>
<!-- <div id='seccion1'>-->
  <tr class="identificacion_seccion" >
	<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="5" class="sub_titulo_2" id="seccBasicos" align="left">Datos de la Entidad de Trabajo</th>
  </tr>

  <tr>
   <td  colspan="5" height="10"></td>
  </tr>
  
    <tr>
       <th colspan="3" style="color:#666" align="left">Número de Información Fiscal (RIF) <span class="requerido"> Ej. J123456789</span> </th>
       <th colspan="2" style="color:#666" align="left">Sector</th>
    </tr>
	
     <tr>
       <td colspan="2"><font color="#666666">
         <input style="border-radius: 50px; border-color:#999999; width:30%" name="srif" type="text"  id="srif"   onkeyup="mayusculas(this);" placeholder="RIF" value="<?=$aDefaultForm['srif'];?>" maxlength="20" />
         </font></td>
		 
	  <td><button type="button" class="button_personal btn_buscar"onClick="JavaScript:send('cmd_buscar_empresa')">Buscar</button></td>
		 
      <td colspan="2"><font color="#666666" >
         <select style="border-radius: 30px; border-color:#999999; width:95%" name="cbo_sector" class=""  <? //print $bloqueado_boton ?> title="Sector - Seleccione una opción del listado" id="cbo_sector">
	        <option value="0" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbo_sector'])=='1') print 'selected="selected"';?>>Empresa de Propiedad Social</option>
	        <option value="2" <? if (($aDefaultForm['cbo_sector'])=='2') print 'selected="selected"';?>>Privada</option>
            <option value="3" <? if (($aDefaultForm['cbo_sector'])=='3') print 'selected="selected"';?>>P&uacute;blica</option>
	        </select></font></td>   
     </tr>
     
	<tr> 
      <th colspan="5" style="color:#666" align="left">Raz&oacute;n Social de la Entidad de Trabajo</th>
    </tr>
	
    <tr> 
		<td colspan="5" align="left"><font color="#666666" >  <? print $aDefaultForm['nombre_empresa'];?></font>    </td> 
    </tr>
	
  <tr>
   <td colspan="4"  height="10"></td>
  </tr>
  
    <tr class="identificacion_seccion" >
	  <th style="border-radius: 30px; border-color:#999999; width:85%" colspan="5" class="sub_titulo_2" id="seccBasicos" align="left">Datos de la Organizaci&oacute;n Sindical</th>
	</tr>
	
  <tr>
  	 <td  height="5"></td>
  </tr>
  	
  <tr>
      <th colspan="5" style="color:#666" align="left">Nombre de la Organización Sindical</th>
  </tr>
  
  <tr>
      <td colspan="5"><font color="#666666"><input style="border-radius: 30px; border-color:#999999; width:90%" name="nombre_sindicato" type="text"  id="nombre_sindicato"  placeholder="Nombre de la Organización Sindical" onkeyup="mayusculas(this);" size="90" value="<?=$aDefaultForm['nombre_sindicato'];?>" /></font></td>
  </tr>
	 
	 <tr>
         <th colspan="5" height="9"></th>
     </tr> 
	  
    <tr>
      <th colspan="3" style="color:#666" align="left">Correo Electr&oacute;nico</th>      
      <th colspan="2" style="color:#666" align="left">Teléfono Contacto <span class="requerido">"Ej. 0212-1234567"</span></th>
    </tr>
    <tr>
      <td colspan="3" ><font color="#666666">
        <input style="border-radius: 30px; border-color:#999999; width:50%" name="email_contacto1" type="text" id="email_contacto1"   value="<?=$aDefaultForm['email_contacto1'];?>" size="50" placeholder="micorreo" title="Correo Electr&oacute;nico -  Ejemplo: micorreo,jperez,inv123.ca,otros" /> @ <input style="border-radius: 30px; border-color:#999999; width:30%" name="email_contacto2" type="text" id="email_contacto2" onblur="validarEmail()"  value="<?=$aDefaultForm['email_contacto2'];?>" size="50" placeholder="gmail.com" title="Correo Electr&oacute;nico -  Ejemplo: gmail.com,hotmail.com,otros"/></font></td>      
	   <td colspan="2" ><font color="#666666"><input style="border-radius: 30px; border-color:#999999; width:20%" name="telefono_sindicato1" type="text" id="telefono_sindicato1" onkeypress="return isNumberKey(event);" value="<?=$aDefaultForm['telefono_sindicato1'];?>" placeholder="Cód."  title="C&oacute;digo de &Aacute;rea - Ingrese s&oacute;lo n&uacute;meros. Acepta cuatro (4) d&iacute;gitos. Ejemplo: 0212" onblur="" size="5" maxlength="4" /></font>
        <font color="#666666"><label> - </label></font>
        <font color="#666666"><input style="border-radius: 30px; border-color:#999999; width:40%" name="telefono_sindicato2" type="text" id="telefono_sindicato2"    onkeypress="return isNumberKey(event);"  value="<?=$aDefaultForm['telefono_sindicato2'];?>" title="Tel&eacute;fono Habitaci&oacute;n - Ingrese s&oacute;lo n&uacute;meros. Acepta siete (7) d&iacute;gitos. Ejemplo: 1234567" placeholder="N° teléfono" size="8" maxlength="7" /></font>
        </label> </font></td>	
    </tr>
	  <tr>
   <td colspan="5"  height="10"></td>
  </tr>
   <!-- </div>-->
<? }?>
  <!--   <tr class="identificacion_seccion" >
<th class="sub_titulo_2" colspan="5" align="left">REMISIÓN DEL CASO</th>
</tr>
    <tr>
      <th colspan="2"  class="sub_titulo" >Persona que remite el caso</th>
      <th colspan="3"  class="sub_titulo" >Remitido a</th>
    </tr>
    <tr>
      <td colspan="2">
        <input name="persona_remite_caso" type="text"  id="persona_remite_caso" size="70" placeholder="Nombre(s) y Apellido(s)" onkeyup="mayusculas(this);" value="<?=$aDefaultForm['persona_remite_caso'];?>"><span class="requerido">*</span></td>
      <td colspan="3" align="center">
        <select id="cbo_organismo" name="cbo_organismo" style="width:95%">
        <option value="0">Seleccione</option>
         <? //LoadOrganismo ($conn) ; print $GLOBALS['sHtml_cb_organismo']; ?>
	      </select>
  	    <span class="requerido">*</span></td>
    </tr>
    <tr>
      <th colspan="2"  class="sub_titulo" >Fecha de Remisi&oacute;n</th>    
      <th colspan="3"  class="sub_titulo" >N&uacute;mero de Memo </th>
    </tr>
    <tr>
      <td colspan="2" align="left">
        <input  name="f_remision" id="f_remision" type="text"  title="Fecha de Remisi&oacute; - Seleccione en el Calendario" size="10"  value="<?//= $aDefaultForm['f_remision'];?>" readonly/>
        <a  id="f_btn1"><img src="../imagenes/calendar_16.png"  width="16" height="16" /></a>
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
    
      <td colspan="3">
      <input name="numero_memo" type="text"  id="numero_memo" placeholder="Ej.123-A" value="<?=$aDefaultForm['numero_memo'];?>"><span class="requerido">*</span></strong></td>
    </tr>
       <tr class="identificacion_seccion" >
<th class="sub_titulo_2" colspan="5" align="left">ESTATUS DEL CASO</th>
</tr>
   
    <tr>
      <th colspan="2" class="sub_titulo">Resultado</th>
      <th colspan="3" class="sub_titulo">Observaciones</th>
    </tr>
    <tr>
      <td colspan="2">
          <select id="cbo_resultado" name="cbo_resultado" style="width:95%" title="Resultado - Seleccione una opción del listado" >
          <option value="">Seleccione</option>
            <?// LoadResultado ($conn) ; print $GLOBALS['sHtml_cb_resultado']; ?>
         </select>
      <span class="requerido"> * </span></td>
      <td colspan="3">
        <input name="observaciones" type="text" class="" id="observaciones"   onkeyup="mayusculas(this);" value="<?//=$aDefaultForm['observaciones']?>" size="50"  placeholder="Observación(es)"maxlength="120"/>        
        </td>
    </tr>-->
     <tr >
     <td colspan="5" align="center" class="formulario"> <? //if($_SESSION['mostrar']==0){ ?> 
     <button type="button" id="enviar" name="enviar" class="button_personal btn_guardar" onClick="send('guardar')"  >Guardar</button>
     <? // }else{?>
      <button type="button" id="enviar2" name="enviar2" class="button_personal btn_regresar" onClick="send('regresar')"  >Regresar</button>
      <? // }?>      </td>
    </tr>   
 </table>
</div>
 </form>   		
	</td>
	</tr>
	</tbody>
	</table>
<?php include("../footer.php"); ?>
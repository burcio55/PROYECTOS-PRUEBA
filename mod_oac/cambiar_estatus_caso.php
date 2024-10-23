<?php 
include("../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
include ('consulta_entes.php');

unset($GLOBALS['aTabla1']);
unset($_SESSION['aTabla']);
doAction($conn);
debug();
function doAction($conn){
if (isset($_POST['action'])){
		$bValidateSuccess=false;
		switch($_POST['action']){
			case 'cmd_buscar_cedula': //Buscar cedula
			$bValidateSuccess=true;
		//	echo"los datos1";
			if($_POST['cedulaconsulta']==''){
				$GLOBALS['aPageErrors'][]= "- El número de Cédula de Identidad del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if ($_POST['nacionalidad']==''){
				$GLOBALS['aPageErrors'][]= "- La Nacionalidad es requerida.";
				$bValidateSuccess=false;
			}
			if ($bValidateSuccess){
				//echo"los datos1";
				$bValidateSuccess=false;				
				LoadData($conn,false);														
			}
			break;
			case 'siguiente':
			//echo "aquiiii ";
			 $accion=2;
			
			  $pase=$_POST['cedulaconsulta'].'/'.$_POST['nacionalidad'].'/'.$_POST['edad'].'/'.$_POST['sexo'].'/'.$_POST['nombre1'].'/'.$_POST['nombre2'].'/'.$_POST['apellido1'].'/'.$_POST['apellido2'].'/'.$_POST['fecha_nac'].'/'.$_POST['beneficiario'].'/'.$_POST['id_caso'];
			$pase=base64_encode($pase);	
			?><script>
				if (confirm("¿Está seguro de cambiar el Estatus del Caso?")){
				document.location='oac_asistencia_caso1.php?pas=<?=$pase?>';}
			</script><?
					
					
			break;
					
			}		
	  }else{
		$_SESSION['boton']=0;
		$_SESSION['existe']=0;
		$_SESSION['mensaje_usuario']='';
		$_SESSION['mostrar']=0;
		unset($_SESSION['aTabla']);
		}
}
function LoadData($conn,$PostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
		$aDefaultForm['cedulaconsulta']='';
		$aDefaultForm['nacionalidad']='';
		$aDefaultForm['apellidonombre']='';
		$aDefaultForm['edad']='';
		$aDefaultForm['sexo']='';
		$_SESSION['boton']=0;
		$_SESSION['existe']=0;
		unset($_SESSION['aTabla']);
		$_SESSION['mensaje_usuario']='';
		$_SESSION['mostrar']=0;
			if (!$bPostBack){			    
				$cedula=$_POST['cedulaconsulta'];
				$letra=$_POST['nacionalidad'];
				$_SESSION['id_datos_personales']='';
				$sql="Select oac.datos_personales_oac.* from oac.datos_personales_oac
					where numcedula='".$cedula."' and nacionalidad='".$letra."';";
					$rs= $conn->Execute($sql);
					if ($rs->RecordCount()>0){
						 // echo "hay reg";
						$aDefaultForm['nombre1']=$_POST['nombre1']=trim(htmlentities($rs->fields['primer_nombre'],ENT_QUOTES));
						$aDefaultForm['nombre2']=$_POST['nombre2']=trim(htmlentities(trim($rs->fields['segundo_nombre'],ENT_QUOTES)));
						$aDefaultForm['apellido1']=$_POST['apellido1']=trim(htmlentities(trim($rs->fields['primer_apellido'],ENT_QUOTES)));
						$aDefaultForm['apellido2']=$_POST['apellido2']=trim(htmlentities(trim($rs->fields['segundo_apellido']),ENT_QUOTES));
						$aDefaultForm['apellidonombre']=$_POST['apellidonombre']=$_POST['nombre1']." ".$_POST['nombre2']." ".$_POST['apellido1']." ".$_POST['apellido2'];
						$aDefaultForm['cedulaconsulta'] = trim($rs->fields['numcedula']);
						$aDefaultForm['apellidonombre'] = $_POST['apellidonombre'];		
						$aDefaultForm['edad'] =edad(trim($rs->fields['fechanac']));
						$aDefaultForm['sexo'] =trim($rs->fields['sexo']);
						$aDefaultForm['fecha_nac'] =$rs->fields['fechanac'];						
						if($rs->fields['nacionalidad']=='1')$_POST['checked_nacionalidad_V']="selected='selected'";
						if($rs->fields['nacionalidad']=='2')$_POST['checked_nacionalidad_E']="selected='selected'";
						$aDefaultForm['nacionalidad'] =$rs->fields['nacionalidad'];	
						$aDefaultForm['beneficiario'] =$rs->fields['ntipo_beneficiario'];
						$_SESSION['id_datos_personales']=$rs->fields['id_datos_personales'];	
					
							$str=explode('-',  $rs->fields['stlf_hab']);
							if(count($str)>1){								
								$_POST['telefono1']=$str[0];
								$_POST['telefono2']=$str[1];
							}		
						$aDefaultForm['telefono1'] = $_POST['telefono1'];			
						$aDefaultForm['telefono2'] =$_POST['telefono2'];		
						$aDefaultForm['telefono'] =$rs->fields['stlf_hab'];
						$aDefaultForm['email'] =$rs->fields['semail'];
						listar($conn,$cedula,$letra);
					
					}else{
					   // echo "no hay datos EN OACa";
						$dataSaime=consultando_saime($cedula,$letra);
						if ($dataSaime!=''){							
							$_POST['cedulaconsulta']=$aDefaultForm['cedulaconsulta'] = $cedula;
							$_POST['nombre1']=$aDefaultForm['nombre1']=htmlentities(trim($dataSaime['nombre1'],ENT_QUOTES));
							$_POST['nombre2']=$aDefaultForm['nombre2']=htmlentities(trim($dataSaime['nombre2'],ENT_QUOTES));
							$_POST['apellido1']=$aDefaultForm['apellido1']=htmlentities(trim($dataSaime['apellido1'],ENT_QUOTES));
							$_POST['apellido2']=$aDefaultForm['apellido2']=htmlentities(trim($dataSaime['apellido2'],ENT_QUOTES));
							$_POST['apellidonombre']=$aDefaultForm['apellidonombre']=$aDefaultForm['apellidonombre']=$_POST['nombre1']." ".$_POST['nombre2']." ".$_POST['apellido1']." ".$_POST['apellido2'];
							$_POST['fecha_nac']=$aDefaultForm['fecha_nac']=$dataSaime['fecha_nac'];
							$_POST['edad']=$aDefaultForm['edad']=edad($dataSaime['fecha_nac']);
							$_POST['sexo']=$aDefaultForm['sexo']=$dataSaime['sexo'];
							$_POST['beneficiario']=$aDefaultForm['beneficiario'];
							$_SESSION['mensaje_usuario']= " <b>NO</b> tiene casos registrados en el M&oacute;dulo de Atenci&oacute;n al Ciudadano. Por favor registre sus datos. ";
							$_SESSION['mostrar']=1;		
							$_SESSION['boton']=1;	
							unset($_SESSION['aTabla']);					
						}else{//NO ESTA EN EL SAIME
							$_SESSION['mensaje_usuario']= " La C&eacute;dula de Identidad <b>NO<b/> est&aacute; registrada en nuestra base de datos SAIME";
							$_SESSION['mostrar']=1;	
							$_SESSION['existe']=1;
							unset($_SESSION['aTabla']);	
							$aDefaultForm['cedulaconsulta']='';
							$aDefaultForm['nacionalidad']='';
							$str=explode(' ', $aDefaultForm['apellidonombre']);
							$_POST['nombre1']=$str[0];
							if(count($str)>2){								
								$_POST['nombre2']=$str[1];
								$_POST['apellido1']=$str[2];
								$_POST['apellido2']=$str[3];
							}else{
								$_POST['nombre2']=$str[2];
							}									
					}						 				
			}
		}			
	}
}
function listar($conn,$cedula,$letra){

$sqli1="SELECT id_detalle_atencion, snro_caso, dfecha_recepcion, oac.detalle_oac.id_via_recepcion, 
oac.detalle_oac.id_tipo_asistencia, splanteamiento_caso, id_tipo_caso,
 oac.detalle_oac.id_detalle_caso, id_dato, srif,
  snombre_empresa, ssector, snombre_sindicato, snombre_contacto, stelefono_contacto, semail_contacto,
   id_organismo_remite, id_organismo_remitido, dfecha_remision, oac.detalle_oac.id_status, 
   sdescripcion_status,sdecripcion_via_recepcion, sobservaciones, snro_memo ,sgestion_detalle,stipo_asistencia,oac.detalle_oac.ntipo_beneficiario
   FROM oac.detalle_oac 
   inner join oac.datos_personales_oac on oac.datos_personales_oac.id_datos_personales=oac.detalle_oac.id_datos_personales 
   inner join oac.via_recepcion on oac.via_recepcion.id_via_recepcion =oac.detalle_oac.id_via_recepcion 
   inner join oac.tipo_asistencia on oac.tipo_asistencia.id_tipo_asistencia =oac.detalle_oac.id_tipo_asistencia
   inner join oac.gestion_detalle on oac.gestion_detalle.id_gestion =oac.detalle_oac.id_detalle_caso 
   inner join oac.status_caso on oac.status_caso.id_status =oac.detalle_oac.id_status 

  where numcedula='".$cedula."' and nacionalidad='".$letra."' order by id_detalle_atencion,oac.detalle_oac.id_status desc"; 
$rs11= $conn->Execute($sqli1);
		
if($rs11->RecordCount()>0 ){
			$aTabla1[]=array();
			$i=0;
			
			$aTabla1 = &$GLOBALS['aTabla1'];

			while(!$rs11->EOF){
				//$aTabla1[$i]['id']=$j;
				$aTabla1[$i]['caso']=$rs11->fields['snro_caso'];
				$aTabla1[$i]['id_detalle_atencion']=$rs11->fields['id_detalle_atencion'];
				$aTabla1[$i]['dfecha_recepcion']=date($rs11->fields['dfecha_recepcion']);  
				if($rs11->fields['ntipo_beneficiario']==1){$aTabla1[$i]['beneficiario']="Trabajador del MPPPST";}	
				if($rs11->fields['ntipo_beneficiario']==2){$aTabla1[$i]['beneficiario']="Beneficiario Externo";}
				$aTabla1[$i]['id_via_recepcion']=$rs11->fields['id_via_recepcion'];
				$aTabla1[$i]['sdecripcion_via_recepcion']=$rs11->fields['sdecripcion_via_recepcion'];
				$aTabla1[$i]['tipo_asistencia']=$rs11->fields['stipo_asistencia'];
				$aTabla1[$i]['detalle_gestion']=$rs11->fields['sgestion_detalle'];
				$aTabla1[$i]['id_status']=$rs11->fields['id_status'];	
				$aTabla1[$i]['sdescripcion_status']=$rs11->fields['sdescripcion_status'];
				$aTabla1[$i]['sobservaciones']=$rs11->fields['sobservaciones'];				
				$i++;						
			$rs11->MoveNext();
			$_SESSION['aTabla'] = $aTabla1;	
		}
			$_SESSION['mostrar']=1;	
			$_SESSION['boton']=1;	
			$_SESSION['existe']=0;
			
			/* $_SESSION['mensaje_usuario']= "<b>Usuario registrado en el M&oacute;dulo de Atenci&oacute;n al Ciudadano</b>.";	 */
			
	}else{
		$_SESSION['boton']=1;
		$_SESSION['mostrar']=1;	
		$_SESSION['existe']=0;
		unset($_SESSION['aTabla']);
		$_SESSION['mensaje_usuario']= " <b>NO</b> posee casos registrados.";	
		}
}
function edad($fecha){

	
	  list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
 
}
/*function edad($fecha){
	$fechanacimiento=$fecha;
	list($ano,$mes,$dia) = explode("-",$fechanacimiento);
	$ano_diferencia  = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia   = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0)
	$ano_diferencia--;
	return $ano_diferencia;
   /* $fecha = str_replace("/","-",$fecha);
    $fecha = date('Y/m/d',strtotime($fecha));
    $hoy = date('Y/m/d');
    $edad = $hoy - $fecha;
    return $edad;
}*/
?>	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="98%" height="95%">
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
     <input name="id_caso" id="id_caso" type="hidden" value="" />
<script language="JavaScript" type="text/javascript" src="Validacion_cambiar_estatus_caso.js"></script>
<script language="JavaScript" type="text/javascript" src="funciones.js"></script>
<script>
function send(saction){
var form=document.form;
		form.action.value=saction;
		form.submit();	
}
function seleccionar(saction,id){
	
		if(saction=='siguiente'){
			var form=document.form;
			form.action.value=saction;
			document.getElementById("id_caso").value=id;
			form.submit();	
		}
}
</script>


</p>
<div>
<table width="98%" align="center" class="formulario" border="0">
<tr>
<th colspan="4"  class="sub_titulo"><div align="left">ACTUALIZACI&Oacute;N --> Procesar Caso </div></th>
</tr>
<tr>
<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
</tr>
</table>
<table width="50%" align="center">
<tr class="identificacion_seccion"  a>
        <td  class="sub_titulo_3" align="right">C&eacute;dula de Identidad </td>
		<td class="sub_titulo_3" align="right" >&nbsp; </td>
        <td class="sub_titulo_3" align="left" colspan="2">
         <select style="border-radius: 30px; border-color:#999999; width:10%" name="nacionalidad" id="nacionalidad" >
          <option value="1"  <? if ($_POST['nacionalidad']=='1') print 'selected="selected"';?>>V</option>
          <option value="2" <? if ($_POST['nacionalidad']=='2') print 'selected="selected"';?>>E</option>    
    </select>
        <input style="border-radius: 30px; border-color:#999999; width:40%" name="cedulaconsulta" id="cedulaconsulta" type="text" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta ocho (8) D&iacute;gitos." maxlength="8" onkeypress="return isNumberKey(event);" value="<?=$aDefaultForm['cedulaconsulta'];?>" >
        <span class="requerido">*</span>
   <button type="button" name="Buscar" class="button_personal btn_buscar" onClick="send('cmd_buscar_cedula')"  >Buscar</button>
  </td>	
  </tr>
  <tr>
<td  height="20"></td>
</tr>
</table>
<table width="98%" align="center" class="formulario" border="0">


<tr class="identificacion_seccion">
        <th style="border-radius: 30px; border-color:#999999; width:85%" colspan="6" class="sub_titulo" align="left">DATOS DEL CIUDADANO </th>
 </tr>
  
   <tr>
       <th colspan="6" height="8"></th>
   </tr> 
   
	<tr class="identificacion_seccion">
        <th style="border-radius: 30px; border-color:#999999; width:85%" colspan="6" class="sub_titulo_2" align="left">Datos B&aacute;sicos</th>
	 </tr>
         
	 <tr>
        <th colspan="6" height="8"></th>
     </tr> 

	<tr>  
		<th style="color:#666"><div align="left">Nombre(s) y Apellido(s)</div> </th>
		<th style="color:#666"><div align="left">Edad</div></th>
		<th style="color:#666"><div align="left">Sexo</div></th> 
		<th style="color:#666"><div align="left">Beneficiario</div></th>  
		<th style="color:#666"><div align="left">N&uacute;mero de Teléfono </div></th>
 	    <th style="color:#666"><div align="left">Correo Electr&oacute;nico</div></th>
	</tr>

	<tr align="center">  
	   <td align="left"><font color="#666666"> <? print $aDefaultForm['apellidonombre'];?> </font></td>
	   <td align="left"><font color="#666666"><? print $aDefaultForm['edad'];?>  a&ntilde;os </font></td>
	   <td align="left"><font color="#666666"> <? if ($aDefaultForm['sexo']=='1') print "Masculino";
			if ($aDefaultForm['sexo']=='2') print "Femenino";?>   </font></td>  
	   <td align="left"><font color="#666666">
		 <? if ($aDefaultForm['beneficiario']=='1') print "Trabajador MPPPST";
		if ($aDefaultForm['beneficiario']=='2') print "Beneficiario Externo";?></font></td>  
		<td align="left"><font color="#666666">
	   <?=$aDefaultForm['telefono1'];?>-<?=$aDefaultForm['telefono2'];?></font></td>
	  </td>
	  <td align="left"><font color="#666666">
		<?=$aDefaultForm['email'];?></font> </td>
	</tr>

	<tr>
		<td colspan="4"> </td> 
	</tr>
	
	<!--<tr>
	   <th style="color:#666" colspan="2"><div align="center">N&uacute;mero de Teléfono </div></th>
 	   <th style="color:#666" colspan="2"><div align="center">Correo Electr&oacute;nico</div></th>
    </tr>
	
	<tr align="center">
		<td colspan="2"><font color="#666666">
	   <?=$aDefaultForm['telefono1'];?>-<?=$aDefaultForm['telefono2'];?></font></td>
	  </td>
	  <td colspan="2"><font color="#666666">
		<?=$aDefaultForm['email'];?></font> </td>
	</tr>  -->
    </table>  
	
 <table width="50%" align="center" class="formulario" border="0" >  
 
<tr>
 <td  height="25"></td>   
</tr>

<tr align="center" >  
 <td style="border-radius: 30px; background-color:#F0F0F0; width:65%"  colspan="2"><font color="#666666">
  <?=$_SESSION['mensaje_usuario'];?></font> </td>
</tr>  
    </table>
<br />	
<table class="display formulario" border="0" align="center" id="tblDetalle" width="98%">
					<thead>
                    <tr>
                  <th style="border-radius: 30px; border-color:#999999; width:80%" colspan="8" class="sub_titulo_2" height="20" align="left">SOLICITUDES REALIZADAS POR EL CIUDADANO </th></tr>  
					
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				 
				  <tr>
						<th width="5%" align="left" class="sub_titulo"><div align="center">Nro. Caso</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">Fecha de Recepci&oacute;n</div></th>
                        <th width="15%" align="left" class="sub_titulo"><div align="center">Beneficiario</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">V&iacute;a de Recepci&oacute;n</div></th>
                         <th width="10%" align="left" class="sub_titulo"><div align="center">Tipo</div></th>
                       <th width="10%" align="left" class="sub_titulo"><div align="center">Gestión</div></th>
						<th width="15%" align="left" class="sub_titulo"><div align="center">Estatus</div></th>
<!-- 						<th width="30%" align="left" class="sub_titulo"><div align="center">Observaciones</div></th> -->
				
					</tr>
						<tbody>
						<?
						$aTabla=$_SESSION['aTabla'];
						$aDefaultForm = $GLOBALS['aDefaultForm'];
						for( $c=0; $c < count($aTabla); $c++){
							//$aTabla1[$i]['id_detalle_atencion']
						?>
							<tr>
                                 <td  class="texto-normal" align="center"><?=$aTabla[$c]['caso']?></td>
								
								<td class="texto-normal" align="center"><?=$aTabla[$c]['dfecha_recepcion']?></td>
                              
                                 <td class="texto-normal" align="center"><?=$aTabla[$c]['beneficiario'];?></td>
								
								
								<td class="texto-normal" align="center"><?=$aTabla[$c]['sdecripcion_via_recepcion'];?></td>
                                <td class="texto-normal" align="center"><?=$aTabla[$c]['tipo_asistencia'];?></td>
								<td class="texto-normal" align="center"><?=$aTabla[$c]['detalle_gestion'];?></td>
								<td class="texto-normal" align="center"><?= $aTabla[$c]['sdescripcion_status'];?>
                                
                           <?  $id=$aTabla[$c]['id_detalle_atencion'];
                            if($aTabla[$c]['id_status'] =='1'){?><img src="../imagenes/alerta.png" width="15" height="15" title=""/><? }
                              if($aTabla[$c]['id_status'] =='2'){?><a align="center" onclick=" seleccionar('siguiente',<? echo $id; ?>);"> <img src="../imagenes/search_16.png" width="15" height="15" title="Cambiar Estatus"/></a><? }?>  
                                </td> 
								
						<!-- 		<td class="texto-normal" align="center"><?php /* $aTabla[$c]['sobservaciones'] */?></td>	 -->		
							</tr>
						<? 
						} 
						?>	
						</tbody>
					</thead>
				</table>
</div>
 </form>    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../footer.php"); ?>
<?php 
include("../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
include ('consulta_entes.php');
include ('consulta_sigefirrhh.php');
unset($_SESSION['aTabla']);
unset($GLOBALS['aTabla1']);
doAction($conn);
debug();
function doAction($conn){
if (isset($_POST['action'])){
		$bValidateSuccess=false;
		$aDefaultForm['mensaje_usuario']='';
		switch($_POST['action']){
			case 'cmd_buscar_cedula': //Buscar cedula
			$bValidateSuccess=true;
		//	echo"los datos1";
			if($_POST['cedulaconsulta']==''){
				$GLOBALS['aPageErrors'][]= "- La C&eacute;dula de Identidad del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if ($_POST['nacionalidad']==''){
				$GLOBALS['aPageErrors'][]= "- La Nacionalidad del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if ($bValidateSuccess){
				//echo"los datos1";
				$bValidateSuccess=false;				
				LoadData($conn,false);														
			}
			break;
			
			
			case 'guardar':
			$bValidateSuccess=true;
			
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			if($_POST['cedulaconsulta']==''){
				$GLOBALS['aPageErrors'][]= "- El n&uacute;mero de C&eacute;dula de Identidad del ciudadano es requerida.";
				$bValidateSuccess=false;
				}
			if($_POST['apellidonombre']==''){
				$GLOBALS['aPageErrors'][]= "- El Apellido(s) y Nombre(s) del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['edad']==''){
				$GLOBALS['aPageErrors'][]= "- La edad del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['sexo']==''){
				$GLOBALS['aPageErrors'][]= "- El sexo del ciudadano es requerida.";
				$bValidateSuccess=false;
				}
			if($_POST['telefono1']=='' or $_POST['telefono2']==''){
				$GLOBALS['aPageErrors'][]= "- El Número de Teléfono del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['email']==''){
				$GLOBALS['aPageErrors'][]= "- El Correo Electr&oacute;nico Personal del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			/*$_POST['email']= $_POST['email1']+"@"+$_POST['email2'];
			if($_POST['email']!=''){
				if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $_POST['email'])) 
					{
						$GLOBALS['aPageErrors'][]= "- El correo electronico del ciudadano es Invalido.";
						$bValidateSuccess=false;
					}				
			}*/
			if($_POST['cbo_entidad']==''){
				$GLOBALS['aPageErrors'][]= "- La Entidad donde está ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_municipio']==''){
				$GLOBALS['aPageErrors'][]= "- El Municipio donde está ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}	//else{
//					$_POST['cbo_municipio_descripcion'] = LoadMunicipio($conn,$_POST['cbo_municipio']);
//				}
			if($_POST['cbo_parroquia']==''){
			 	$GLOBALS['aPageErrors'][]= "- La Parroquia donde está ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}	//else{
//				$_POST['cbo_parroquia_descripcion'] = LoadParroquia($conn,$_POST['cbo_parroquia']);
//			}
		//	
			if($bValidateSuccess){	
			$accion=1;	
					 	
			ProcessForm($conn,$accion);	
			
			$_SESSION['mostrar']=1;	
			$_SESSION['boton']='1';
			$_SESSION['existe']='';		
			
			LoadData($conn,false);
			}else{
				$_SESSION['mensaje_usuario1']='Los datos <b>NO</b> deben estar vacios.';
				$_SESSION['mostrar']='';
				$_SESSION['boton']='';
				$_SESSION['existe']='';

			}
			
			break;
			
			case 'siguiente':
			$bValidateSuccess=true;
			
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			if($_POST['cedulaconsulta']==''){
				$GLOBALS['aPageErrors'][]= "- El n&uacute;mero de C&euro;dula de Identidad del ciudadano es requerida.";
				$bValidateSuccess=false;
				}
			if($_POST['apellidonombre']==''){
				$GLOBALS['aPageErrors'][]= "- El Apellido(s) y Nombre(s) del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['edad']==''){
				$GLOBALS['aPageErrors'][]= "- La Edad del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['sexo']==''){
				$GLOBALS['aPageErrors'][]= "- El Sexo del ciudadano es requerida.";
				$bValidateSuccess=false;
				}
			if($_POST['telefono1']=='' or $_POST['telefono2']==''){
				$GLOBALS['aPageErrors'][]= "- El n&uacute;mero de Tel&eacute;fono del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['email']==''){
				$GLOBALS['aPageErrors'][]= "- El Correo Electr&oacute;nico Personal del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			/*$_POST['email']= $_POST['email1']+"@"+$_POST['email2'];
			if($_POST['email']!=''){
				if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $_POST['email'])) 
					{
						$GLOBALS['aPageErrors'][]= "- El correo electronico del ciudadano es Invalido.";
						$bValidateSuccess=false;
					}				
			}*/
			if($_POST['cbo_entidad']==''){
				$GLOBALS['aPageErrors'][]= "- La Entidad donde est&aacute; ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}
			if($_POST['cbo_municipio']==''){
				$GLOBALS['aPageErrors'][]= "- El Municipio donde est&aacute; ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}	//else{
//					$_POST['cbo_municipio_descripcion'] = LoadMunicipio($conn,$_POST['cbo_municipio']);
//				}
			if($_POST['cbo_parroquia']==''){
			 	$GLOBALS['aPageErrors'][]= "- La Parroquia donde est&aacute; ubicado el domicilio del ciudadano es requerida.";
				$bValidateSuccess=false;
			}	//else{
//				$_POST['cbo_parroquia_descripcion'] = LoadParroquia($conn,$_POST['cbo_parroquia']);
//			}
		//	
			if($bValidateSuccess){	
			 $accion=2;
			 //ProcessForm($conn,$accion);
			 $pase=$_POST['cedulaconsulta'].'/'.$_POST['nacionalidad'].'/'.$_POST['edad'].'/'.$_POST['sexo'].'/'.$_POST['nombre1'].'/'.$_POST['nombre2'].'/'.$_POST['apellido1'].'/'.$_POST['apellido2'].'/'.$_POST['fecha_nac'].'/'.$_POST['valor_beneficiario'];
			 $pase=base64_encode($pase);	
			?><script>
				//if (confirm("ESTA SEGURO DE GENERAR UN NUEVO CASO?")){
				document.location='oac_asistencia_caso.php?pas=<?=$pase?>';
				//}
			</script><?
					//LoadData($conn,false);		
			}else{
				$_SESSION['mensaje_usuario1']='Los datos <b>NO</b> deben estar vacios.';
				$_SESSION['mostrar']='';
				$_SESSION['boton']='';
				$_SESSION['existe']='';
				}

			break;
			case 'saime':
				?>
				<script>				
					document.location='../mod_entes/saime_guardar.php';			
				</script><?
			
					
			break;
			
			}		
	  }else{
	 		
					
		$_SESSION['boton']=0;
		$_SESSION['existe']='';
		$_SESSION['mensaje_usuario']='';
		$_SESSION['mensaje_usuario1']='';
		$_SESSION['mostrar']=0;
		}
}
function LoadData($conn,$PostBack){
	//echo "estoy en loaddata";
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
/*		$aDefaultForm['cedulaconsulta']=$_POST['cedulaconsulta'];
		$aDefaultForm['nacionalidad']=$_POST['nacionalidad'];
		$aDefaultForm['apellidonombre']='';
		$aDefaultForm['edad']='';
		$aDefaultForm['sexo']='';*/
		$_SESSION['boton']=0;
		$_SESSION['existe']='';
		$_SESSION['mensaje_usuario']='';
		//$_SESSION['mensaje_usuario1']='';
		//$_SESSION['mostrar']=0;
		unset($_SESSION['aTabla']);
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
						$fecha_nac=$rs->fields['fechanac'];
						$aDefaultForm['edad'] =edad($fecha_nac);
						$aDefaultForm['sexo'] =trim($rs->fields['sexo']);
						$aDefaultForm['fecha_nac'] =$rs->fields['fechanac'];						
				
						$aDefaultForm['nacionalidad'] =$rs->fields['nacionalidad'];	
				
						$_SESSION['id_datos_personales']=$rs->fields['id_datos_personales'];	
						
					//telefono celular
						$str=explode('-',  $rs->fields['stlf_cel']);
						if(count($str)>1){								
							$_POST['codigo1']=$str[0];
							$_POST['telefono12']=trim($str[1]);
						}		
					

						$aDefaultForm['codigo1'] = $_POST['codigo1'];			
						$aDefaultForm['telefono12'] =$_POST['telefono12'];		
						$aDefaultForm['telefono21'] =$rs->fields['stlf_cel'];//completo el numero
						
						//telefono habitacion otro telefono
						$str=explode('-',  $rs->fields['stlf_hab']);
						if(count($str)>1){								
							$_POST['telefono1']=$str[0];
							$_POST['telefono2']=trim($str[1]);
						}		
						$aDefaultForm['telefono1'] = $_POST['telefono1'];			
						$aDefaultForm['telefono2'] =$_POST['telefono2'];		
						$aDefaultForm['telefono'] =$rs->fields['stlf_hab'];
						
						/* //correo
						$email_= trim($rs->fields['semail']);
						$email_ = explode('@',  $rs->fields['semail']);
						if(count($email_)>1){								
							$_POST['email1']=$email_[0];
							$_POST['email2']=trim($email_[1]);
						} */		
						
						
					/* 	$aDefaultForm['email1'] =$_POST['email1'];
						$aDefaultForm['email2'] =$_POST['email2']; */
						$aDefaultForm['email'] =$rs->fields['semail'];	
						$aDefaultForm['cbo_entidad'] =$rs->fields['nentidad'];
						$aDefaultForm['cbo_municipio'] = $rs->fields['nmunicipio'];
						$aDefaultForm['cbo_parroquia'] = $rs->fields['nparroquia'];
						$_SESSION['mostrar']=1;
						listar($conn,$cedula,$letra);
						//consulta si es funcionario
						
						$_POST['valor_beneficiario']=$aDefaultForm['valor_beneficiario']=consulta_sigefirrhh($cedula);	
						if($_POST['valor_beneficiario']==1){
							$valor= "Trabajador MPPPST";					
						}else{					
							$valor= "Beneficiario Externo";	
						}
						$_POST['beneficiario']=$aDefaultForm['beneficiario']=$valor;
						//termina consulta si es funcionario
					}else{
					   // echo "no hay datos EN OACa";
						$dataSaime=consultando_saime($cedula,$letra);
						if ($dataSaime!=''){							
							$_POST['cedulaconsulta']=$aDefaultForm['cedulaconsulta'] = $cedula;
							$_POST['nacionalidad']=$aDefaultForm['nacionalidad'] = $letra;
							$_POST['nombre1']=$aDefaultForm['nombre1']=htmlentities(trim($dataSaime['nombre1'],ENT_QUOTES));
							$_POST['nombre2']=$aDefaultForm['nombre2']=htmlentities(trim($dataSaime['nombre2'],ENT_QUOTES));
							$_POST['apellido1']=$aDefaultForm['apellido1']=htmlentities(trim($dataSaime['apellido1'],ENT_QUOTES));
							$_POST['apellido2']=$aDefaultForm['apellido2']=htmlentities(trim($dataSaime['apellido2'],ENT_QUOTES));
							$_POST['apellidonombre']=$aDefaultForm['apellidonombre']=$aDefaultForm['apellidonombre']=$_POST['nombre1']." ".$_POST['nombre2']." ".$_POST['apellido1']." ".$_POST['apellido2'];
							$_POST['fecha_nac']=$aDefaultForm['fecha_nac']=$dataSaime['fecha_nac'];
							$_POST['edad']=$aDefaultForm['edad']=edad($dataSaime['fecha_nac']);
							$_POST['sexo']=$aDefaultForm['sexo']=$dataSaime['sexo'];
							$_SESSION['mensaje_usuario']= "  El ciudadano <b>NO</b> tiene casos registrados en el M&oacute;dulo de Atenci&oacute;n al Ciudadano. <b>Por Favor registre sus datos</b>. ";
						//consulta si es funcionario
						$_POST['valor_beneficiario']=$aDefaultForm['valor_beneficiario']=consulta_sigefirrhh($cedula);	
						if($_POST['valor_beneficiario']==1){
							$valor= "Trabajador MPPPST";					
						}else{					
							$valor= "Beneficiario Externo";	
						}
						$_POST['beneficiario']=$aDefaultForm['beneficiario']=$valor;
						//termina consulta si es funcionario
						$_SESSION['mostrar']=1;							
						$_SESSION['existe']=1;						
						}else{//NO ESTA EN EL SAIME
							$_SESSION['mensaje_usuario']= " El n&uacute;mero de la C&eacute;dula de Identidad <b>NO</b> est&aacute; registrada en nuestra base de datos SAIME";
							$_SESSION['mostrar']=1;	
							$_SESSION['existe']=2;	
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
		}else{
			
			
			}			
	}
}
function listar($conn,$cedula,$letra){
unset($_SESSION['aTabla']);
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
			$_SESSION['mensaje_usuario']= " El ciudadano se encuentra registrado en el M&oacute;dulo de Atenci&oacute;n al Ciudadano. <b>S&iacute; desea crear un caso haga Clic Aqu&iacute;</b>.";	
			
	}else{
		$_SESSION['mostrar']=1;		
		$_SESSION['boton']=1;	
		$_SESSION['mensaje_usuario']= " El ciudadano <b>NO</b> tiene casos registrados en el M&oacute;dulo de Atenci&oacute;n al Ciudadano. <b>S&iacute; desea generar un caso haga Clic Aqu&iacute;</b>.";	
		}
}
function ProcessForm($conn,$accion){
	//$conn->debug = true;
	$fecha_hoy=date('c');
	//$_SESSION['id_usuario']='13885175';
	$_POST['telefono']=$_POST['telefono1'].'-'.$_POST['telefono2'];
	$_POST['telefono21']=$_POST['codigo1'].'-'.$_POST['telefono12'];
	$_POST['email'] = $_POST['email'];
/*		echo "nacionalidad;";
	echo $_POST['nacionalidad'];*/
	$_SESSION['mensaje_usuario1']='';
	if($accion==1){
		$sql="INSERT INTO oac.datos_personales_oac(
				numcedula, primer_apellido, segundo_apellido, 
				primer_nombre, segundo_nombre, fechanac, nacionalidad, sexo, ntipo_beneficiario,
				stlf_hab,stlf_cel, semail, nentidad, nmunicipio, 
				nparroquia, nenabled, nusuario_creacion, dfecha_creacion)
		VALUES ('".$_POST['cedulaconsulta']."', '".$_POST['apellido1']."','".$_POST['apellido2']."', 
				'".$_POST['nombre1']."', '".$_POST['nombre2']."', '".$_POST['fecha_nac']."','".$_POST['nacionalidad']."','".	$_POST['sexo']."','".$_POST['valor_beneficiario']."', '".$_POST['telefono']."','".$_POST['telefono21']."', '".$_POST['email']."', '".$_POST['cbo_entidad']."','".$_POST['cbo_municipio']."', '".$_POST['cbo_parroquia']."','1', '".$_SESSION['id_usuario']."',     '".$fecha_hoy."');";
		$rs=$conn->Execute($sql);
		if (!$rs){
			$_SESSION['mensaje_usuario1']='<b>¡Error al Cargar los Datos!</b>.';				
				
		}else{
			$rs=$conn->Execute("select max(id_datos_personales) from oac.datos_personales_oac");
			$_SESSION['id_datos_personales']=$rs->fields[0];	
			$_SESSION['mensaje_usuario1']='<b>Datos Guardados Satisfactoriamente</b>.';
			$_SESSION['mostrar']=1;				
		}
	}
	
	if($accion==2){
			$sqlu="UPDATE oac.datos_personales_oac
					   SET numcedula='".$_POST['cedulaconsulta']."',
					   primer_apellido='".$_POST['apellido1']."', 
					   segundo_apellido='".$_POST['apellido2']."', 
					   primer_nombre='".$_POST['nombre1']."',
					   segundo_nombre='".$_POST['nombre2']."',
					   fechanac='".$_POST['fecha_nac']."', 
					   nacionalidad='".$_POST['nacionalidad']."', 
					   sexo='".	$_POST['sexo']."',
					   ntipo_beneficiario='".$_POST['valor_beneficiario']."',
					   stlf_hab='".$_POST['telefono']."',
					    stlf_cel='".$_POST['telefono21']."',
					   semail='".$_POST['email']."', 
					   nentidad='".$_POST['cbo_entidad']."', 
					   nmunicipio='".$_POST['cbo_municipio']."',
					   nparroquia= '".$_POST['cbo_parroquia']."',
					   nenabled='1',
					   nusuario_actualizacion= '".$_SESSION['id_usuario']."', 
					   dfecha_actualizacion= '".$fecha_hoy."'
					 WHERE id_datos_personales='".$_SESSION['id_datos_personales']."';";
				$rsu=$conn->Execute($sqlu);
					if (!$rsu){
						$_SESSION['mensaje_usuario1']='<b>¡Error al Cargar los Datos!</b>.';	
						
					}

		}
}
function edad($fecha){

	
	  list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
 
}
?>	<div id="Contenido" align="center" style="overflow:auto">

<form action="" method="post" enctype="multipart/form-data" name="form" id="form">
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
     <input name="valor_beneficiario" type="hidden" value="<?=$aDefaultForm["valor_beneficiario"]?>" />
   <input name="telefono" type="hidden" value="<?=$aDefaultForm["telefono1"].'-'.$aDefaultForm["telefono2"]?>   "/>
   <input name="email" type="hidden" value="<?=$aDefaultForm['email'];?>"/>
  	<input name="telefono21" type="hidden" value="<?=$aDefaultForm['codigo1']?>.'-'.<?=$aDefaultForm['telefono1']?>"/>
	
   
<script language="JavaScript" type="text/javascript" src="Validacion_oac_datos_personales.js"></script>
<script language="JavaScript" type="text/javascript" src="funciones.js"></script>

<script>
function send(saction){
var form=document.form;
		form.action.value=saction;
		form.submit();	
}
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}
</script>

</p>
<div>
<table width="90%" align="center" class="formulario" border="0">
<tr>
<th colspan="3"  class="sub_titulo"><div align="left">AC --> Registrar Caso</div></th>
</tr>

<tr>
<td colspan="3" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
</tr>

  <tr>
   <td  height="10"></td>
</tr>
</table>


<table width="50%">
<tr class="identificacion_seccion">
        <td class="sub_titulo_3" align="right">C&eacute;dula de Identidad</td>
		<td class="sub_titulo_3" align="right" >&nbsp; </td>
        <td class="sub_titulo_3" align="left"  colspan="2">
         <select style="border-radius: 30px; border-color:#999999; width:10%" name="nacionalidad" id="nacionalidad" >
          <option value="1"  <? if ($_POST['nacionalidad']=='1') print 'selected="selected"';?>>V</option>
          <option value="2" <? if ($_POST['nacionalidad']=='2') print 'selected="selected"';?>>E</option>
    
    </select>
        <input style="border-radius: 30px; border-color:#999999; width:35%" name="cedulaconsulta" id="cedulaconsulta" type="text" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo n&uacute;meros. Acepta ocho (8) d&iacute;gitos." maxlength="8" onkeypress="return isNumberKey(event);" value="<?=$aDefaultForm['cedulaconsulta'];?>" >
        <span class="requerido">*</span>
   <button type="button" name="Buscar" class="button_personal btn_buscar" onClick="send('cmd_buscar_cedula')" >Buscar</button>
  </td>	
  </tr>
  <tr>
   <td  height="10"></td>
</tr>
  <tr>
   <td  height="10"></td>
</tr>
</table>
<table width="90%" align="center" class="formulario" border="0">
<tr class="identificacion_seccion">
        <th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" align="left">DATOS DEL CIUDADANO </th>
 </tr>
 
	<tr>
	<th colspan="4" height="8"></th>
	</tr>
	 
	<tr class="identificacion_seccion">
			<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo_2" align="left">Datos B&aacute;sicos</th>
	 </tr>
	
	<tr>
		<th colspan="4" height="8"></th>
	</tr> 
	
	<tr>  
		<th width="25%" align="left" style="color:#666">Nombre(s) y Apellido(s)</th> 
		<th width="23%" align="left" style="color:#666">Fecha de Nacimiento</th>
		<th style="color:#666" align="left" >Edad</th>
		<th style="color:#666" align="left" >Sexo</th>
	</tr>
 
  <tr>  
     <td align="left"><font color="#666666"> <? if($aDefaultForm['apellidonombre']=='')print" "; else print $aDefaultForm['apellidonombre'];?></font></td>
     <td align="left"><font color="#666666"> <?php if($aDefaultForm['fecha_nac']!=""){echo strftime("%d/%m/%Y", strtotime($aDefaultForm['fecha_nac']));} ?></font></td>
	 <td align="left"><font color="#666666"> <? if($aDefaultForm['edad']=='')print" "; else print $aDefaultForm['edad'];?> a&ntilde;os</font></td>
     <td align="left"><font color="#666666"> <? 
	if ($aDefaultForm['sexo']=='1'){ 
		$sexo='Masculino';
	} else {
		if ($aDefaultForm['sexo']=='2'){
			$sexo='Femenino';			
		}
	}
	print $sexo;?>
   </font> <font color="#666666"> </font> </td>  
     </tr>
	   	<tr>
		<td colspan="4"> </td> 
	</tr>
 <tr>  
     <th style="color:#666" align="left">Teléfono Personal</th>
     <th style="color:#666" align="left">Otro Teléfono</th>
     <th style="color:#666" align="left" width="27%" >Correo Electrónico Personal </th>
     <!-- <th style="color:#666" align="left" width="25%" >Tipo de Beneficiario</th> -->
</tr>

<tr>
	
     <td><font style="color:#666666">
     <select style="border-radius: 30px; border-color:#999999; width:25%" name="codigo1" id="codigo1" title="C&oacute;digo de Telefon&iacute;a - Seleccione s&oacute;lo una opci&oacute;n del listado" >
		<option value="">----</option>
		<option value="0416"  <? if ($_POST['codigo1']=='0416') print 'selected="selected"';?>>0416</option>
		<option value="0426"  <? if ($_POST['codigo1']=='0426') print 'selected="selected"';?>>0426</option>
		<option value="0414"  <? if ($_POST['codigo1']=='0414') print 'selected="selected"';?>>0414</option>
		<option value="0424"  <? if ($_POST['codigo1']=='0424') print 'selected="selected"';?>>0424</option>
		<option value="0412"  <? if ($_POST['codigo1']=='0412') print 'selected="selected"';?>>0412</option>       
	</font></select>
						 -  
	<font style="color:#666666"><input style="border-radius: 30px; border-color:#999999; width:55%; color:#666666" name="telefono12" type="text" id="telefono12" onblur=""  onkeypress="return isNumberKey(event);"  value="<?=$aDefaultForm['telefono12'];?>" title="Tel&eacute;fono Personal- Ingrese s&oacute;lo n&uacute;meros. Acepta siete (7) d&iacute;gitos. Ejemplo: 1234567" placeholder="N° teléfono" size="8" maxlength="7" autocomplete="ON"/></font></td>
    
	 <td><font color="#666666">
     <input style="border-radius: 30px; border-color:#999999; width:25%; color:#666666" name="telefono1" type="text" id="telefono1" onkeypress="return isNumberKey(event);" value="<?=$aDefaultForm['telefono1'];?>" title="C&oacute;digo de &Aacute;rea - Ingrese s&oacute;lo n&uacute;meros. Acepta cuatro (4) d&iacute;gitos. Ejemplo: 0212"placeholder="Cód." size="5" maxlength="4" autocomplete="ON"/></font>
     -
<input style="border-radius: 30px; border-color:#999999; width:55%; color:#666666" name="telefono2" type="text" id="telefono2" onblur=""  onkeypress="return isNumberKey(event);"  value="<?=$aDefaultForm['telefono2'];?>" title="Otro Tel&eacute;fono - Ingrese s&oacute;lo n&uacute;meros. Acepta siete (7) d&iacute;gitos. Ejemplo: 1234567" placeholder="N° teléfono" size="8" maxlength="7" autocomplete="ON"/><span class="requerido">*</span></td>
   
   <td align="left"><font color="#666666">
   <input style="border-radius: 30px; border-color:#999999; color:#666666; width:100%;" name="email" type="text" id="email" size="30" title="Correo Electrónico - Ejemplo: micorreo@dominio.com" placeholder="micorreo@gmail.com" value="<?=$aDefaultForm['email'];?>"/>
    </font></td>
    <!-- <td align="left"><font color="#666666"> <? /* print $aDefaultForm['beneficiario']; */?></font>    </td> -->
</tr>
        <tr>
            <th colspan="4" height="20"></th>
        </tr> 
		
<tr class="identificacion_seccion">
        <th style="border-radius: 30px; border-color:#999999; width:85%"  colspan="4" class="sub_titulo_2" align="left">Direcci&oacute;n de Habitaci&oacute;n</th>
</tr>
           <tr>
            <th colspan="4" height="8"></th>
        </tr> 
<tr>   
    <th style="color:#666"> Estado </th>
    <th style="color:#666"><div align="left"> Municipio </div></th>
    <th colspan="2"  style="color:#666" >Parroquia </th>
      <!--<th class="sub_titulo"> </th>-->
</tr>
    <tr>
    <td><font color="#666666">
      <select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_entidad" name="cbo_entidad"  title="Estado de residencia - Seleccione s&oacute;lo una opci&oacute;n del listado" onchange="estado_combo();">
        <option value="">Seleccione</option>
        <? LoadEstado ($conn) ; print $GLOBALS['sHtml_cb_Estado']; ?>
      </select>
      <span class="requerido">*</span>
    </font></td>
    <td align="lrft"><font color="#666666">
      <select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_municipio" name="cbo_municipio" title="Municipio de residencia - Seleccione s&oacute;lo una opci&oacute;n del listado" onChange="municipio_combo();">
       <option value="">Seleccione</option>
       <option <? if($aDefaultForm['cbo_municipio']!=""){ echo "selected='selected'"; $cbo_municipio_descripcion=LoadMunicipio($conn, $aDefaultForm['cbo_municipio']);} ?> value="<?=$aDefaultForm['cbo_municipio']?>" > <? print $cbo_municipio_descripcion; ?> </option>
		  </select>  <span class="requerido">*</span>          
    </font></td>
    <td colspan="2"><font color="#666666">
        <select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_parroquia" title="Parroquia de residencia - Seleccione s&oacute;lo una opci&oacute;n del listado" name="cbo_parroquia">
        <option value="">Seleccione</option>
        <option <? if($aDefaultForm['cbo_parroquia']!=""){ echo "selected='selected'"; $cbo_parroquia_descripcion=LoadParroquia($conn, $aDefaultForm['cbo_parroquia']);} ?> value="<?=$aDefaultForm['cbo_parroquia']?>" > <? print $cbo_parroquia_descripcion; ?> </option>
      </select> <span class="requerido">*</span>
    </font></td>
<!--    <td>
        
    </td>-->
    </tr>    
	<tr>
        <th colspan="4" height="8"></th>
    </tr> 

	<tr>
        <th colspan="4" height="8"></th>
    </tr> 

	<tr class="identificacion_seccion" style="margin-top: 20px;">
	<th style="border-radius: 30px; border-color:#999999; width:85%; background-color: #D0E0F4; color: #1060C8; padding: 5px; height: 25px; font-size: 10px;" colspan="4" class="sub_titulo_2" align="left">Datos Adicionales</th>
	</tr>
           <tr>
            <th colspan="4" height="8"></th>
        </tr> 

		<tr>
			<th style="color:#666" align="left" width="25%" >Clase de Beneficiario</th>
			<td align="left"><font color="#666666"> <?  print $aDefaultForm['beneficiario']; ?></font>  </td>
		</tr>
 </table>
 
 <? if($_SESSION['mostrar']==1){
?>


<table>
	
   <?   print $_SESSION['mensaje_usuario1'];
   if($_SESSION['boton']==1 ){?>

    <tr>
            <th colspan="4" height="15"></th>
    </tr> 
	
	
	
<tr>
   <th style="border-radius: 30px; border-color:#999999; width:90%; background-color: #FFEE93; font-color: dark;" height="44" colspan="3" align="center" class="dataListColumn"><font color="#666666"><div align="center"><img src="../imagenes/warning_16.png" width="16" height="16"/><? print $_SESSION['mensaje_usuario']; 
  ?> <button type="button" id="enviar2" name="enviar2" class="button_personal btn_siguiente" onClick="send('siguiente')"  >Generar caso</button></div><font></th>
  </tr><? }?>
            <tr>
            <th colspan="4" height="15"></th>
        </tr> 
  <?  if($_SESSION['existe']==1){?>
<tr>
   <th style="border-radius: 30px; border-color:#999999; width:90%; background-color: #FFEE93; font-color: dark;" height="44" colspan="3" align="center" class="dataListColumn"><font color="#666666"><div align="center"><img src="../imagenes/warning_16.png" width="16" height="16"/><? print $_SESSION['mensaje_usuario']; 
  ?> <button type="button" id="enviar" name="enviar" class="button_personal btn_agregar" onClick="send('guardar')"  >Guardar</button></div></font></th>
  </tr><? }else{
	  if($_SESSION['existe']==2){?>
	            <tr>
            <th colspan="4" height="15"></th>
        </tr> 
  <tr>
	   <th style="border-radius: 30px; border-color:#999999; width:90%; background-color: #FFEE93; font-color: dark;" height="44" colspan="3" align="center" class="dataListColumn"><font color="#666666"><div align="center"><img src="../imagenes/warning_16.png" width="16" height="16"/><? print $_SESSION['mensaje_usuario']; ?><button type="button" id="enviar_saime" name="enviar_saime" class="button_personal btn_agregar" onClick="send('saime')"  >Registrar Ciudadano</button>
   </div></font></th>
  </tr>
	  <? }
	  }?>

</table>

<table class="display formulario" border="0" align="center" id="tblDetalle" width="98%">
        <thead>      
		<tr>
		<th style="border-radius: 30px; border-color:#999999; width:80%; ;" colspan="7" height="20" class="sub_titulo_2" align="left">SOLICITUDES REALIZADAS POR EL CIUDADANO</th>
        </tr> 
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
						<th width="15%" align="left" class="sub_titulo"><div align="center">V&iacute;a de Recepci&oacute;n</div></th>
                        <th width="10%" align="left" class="sub_titulo"><div align="center">Tipo de Asistencia</div></th>
                        <th width="15%" align="left" class="sub_titulo"><div align="center">Detalle de Gesti&oacute;n</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">Estatus</div></th>
						<!-- <th width="20%" align="left" class="sub_titulo"><div align="center">Observaciones</div></th> -->
				
		  </tr>
	  </thead>
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
                            if($aTabla[$c]['id_status'] =='1'){?><? }
                              if($aTabla[$c]['id_status'] =='2'){?> </a><? }?>  
                                </td> 
								
								<!-- <td class="texto-normal" align="center"><?php /* $aTabla[$c]['sobservaciones'] */?></td>	 -->		
							</tr>
						<? 
						} 
						?>	
						</tbody>
					
	</table>
	
<br></br>
 <? } ?>  
</div>
 </form>    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../footer.php"); ?>
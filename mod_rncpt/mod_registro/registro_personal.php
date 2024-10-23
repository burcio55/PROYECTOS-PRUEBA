<?php
session_start();
error_reporting(E_ALL | E_STRICT);
include("../../header.php"); 
ini_set("display_errors",0);
$conn= getConnDB($db1);





$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug =false;

//$conn->debug = $settings['debug'];

$aDefaultForm = array();

debug();
doAction($conn);




//-------------------- Función doAction --------------------//
function doAction($conn){ 
	if (isset($_POST['action'])){
		switch($_POST['action']){ 
		
 			case 'Redireccionar':
			$_SESSION['disabled']='';
				
				$SQL="SELECT * FROM rncpt.empresa WHERE id = '".$_SESSION["empresa_id"]."' AND   nenabled ='1' and nro_boleta <>'';"; 
				$rs=$conn->Execute($SQL); 
				if($rs->RecordCount()>0){
					$boleta_gen=$rs->fields['nro_boleta'];
					 $GLOBALS['aPageErrors'][] = "El Nª Boleta del CPTT ya fue generado con lo siguiente ".$boleta_gen;
					 	$_SESSION['disabled']='disabled="disabled"';
				}else{
					$SQL="SELECT miembros_id FROM rncpt.miembros_empresa WHERE empresa_id = '".$_SESSION["empresa_id"]."' AND   nenabled ='1' ;"; 
					$rs=$conn->Execute($SQL); 
					if($rs->RecordCount()>=3){
						if($rs->RecordCount()<=7){ 
							$bValidateSuccess=true;
							$boleta=getboleta($conn);
							$sql_="select * from rncpt.empresa  where  nro_boleta='".$boleta."' ;";
							$rs_a=$conn->Execute($sql_); 
							if($rs_a->RecordCount()==0){							
								
							$sql_boleta="UPDATE rncpt.empresa   SET  nro_boleta='".$boleta."' WHERE  id=".$_SESSION['empresa_id'].";";
							$rs_boleta=$conn->Execute($sql_boleta); 
							
						//	$GLOBALS['aPageErrors'][] ="Boleta Nª ".$boleta;
							$pase=$boleta;
							//header('Location: boleta.php?boleta='.$pase);	
							$_SESSION['disabled']='disabled="disabled"';
							?>	
							<script>    	
								window.open('boleta_QR.php?boleta=<?=$pase?>', '_blank');
							  </script>
							<?
							}else{
								
								$GLOBALS['aPageErrors'][] = "El Nª Boleta ".$boleta." ya fue generado";
								$_SESSION['disabled']='disabled="disabled"';	
								//$pase=$boleta;
								//header('Location: boleta.php?boleta='.$pase);	
								?>	
							<script>    	
								//window.open('boleta.php?boleta=<?=$pase?>', '_blank');
								 </script>
							<?
								}
						}else{
						$GLOBALS['aPageErrors'][] = "El Maximo de Voceros es siete(7)";
						
						} 
					}else{
					$GLOBALS['aPageErrors'][] = "Debe agregar al menos tres (3) Voceros";
					}
				}
				loadData($conn, true); 
            break;
			case 'Regresar': 
			unset($_SESSION['empresa_id']);
			unset($_SESSION['entidad']);
			unset($_SESSION['aDefaults1']);
			unset($_SESSION['aDefaults']);

			
			?>	
						<script>    	
							document.location='registro_empresa.php';
						  </script>
						<?
									
				
		
				break;
							
//----------CASE_ELIMINAR----------//
			case 'Eliminar': 

				if($_POST['id'] != NULL){
					$SQL="UPDATE rncpt.miembros_empresa
						  SET nenabled = 0,
							  usuario_idactualizacion = '".$_SESSION["id_usuario"]."',
							  dfecha_actualizacion = '".date('Y-m-d H:i:s')."'
					      WHERE miembros_empresa.id = '".$_POST['id']."' 
						  AND miembros_empresa.empresa_id = '".$_SESSION["empresa_id"]."';";
					$success= $conn->Execute($SQL);
					
					$GLOBALS['aPageErrors'][] = "El Vocero Fue Eliminado Exitosamente";	
				}						
				
			loadData($conn, true);
				break;
//----------CASE_GUARDAR----------//				
			case 'Guardar'://agregar voceross cptt
				$bValidateSuccess=true;	
				$SQL3="SELECT count(*) AS voceros from rncpt.miembros_empresa 
				where miembros_empresa.empresa_id = '".$_SESSION["empresa_id"]."' and miembros_empresa.nenabled = '1';";	
				$rs3 = $conn->Execute($SQL3);
				$voceros = $rs3->fields['voceros'];
				if($voceros==7 ){
					$GLOBALS['aPageErrors'][]= "- La cantidad de Voceros debe ser mínimo tres (3) máximo (7).";
					$bValidateSuccess=false;	
				}
				if($_POST['nro_votos']>$_POST['total_trabajadores'] ){
					$GLOBALS['aPageErrors'][]= "- El N° de Votos por el cuál fue electo	no puede ser mayor al Total de Trabajadores de la Entidad de Trabajo.";
					$bValidateSuccess=false;	
				}
				if($_POST['total_trabajadores']<$_POST['nro_votos']){
					$GLOBALS['aPageErrors'][]= "- El Total de Trabajadores de la Entidad de Trabajo no puede ser menor al N° de Votos por el cuál fue electo.";
					$bValidateSuccess=false;	
				}
				
				
				if ($bValidateSuccess){
				
				
				$date = strtotime($_POST['fechaconst']);
				$fechaconst =date('Y-m-d',$date);
				
				$date__ = strtotime($_POST['fechavencimiento_']);
				$fechavencimiento =date('Y-m-d',$date__);
				
				
					
				if($_POST['nro_votos']==''){
					
					$_POST['nro_votos']=0;
				}
					
				if($_POST['total_trabajadores']==''){
					
					$_POST['total_trabajadores']=0;
				}													
					
				if($_POST['codigo2'] == "" || $_POST['telefono2'] == ""){
					$ntelefono1 = $_POST['codigo1'].$_POST['telefono1'];
					$ntelefono2 = "";
				}else{
					$ntelefono1 = $_POST['codigo1'].$_POST['telefono1'];
					$ntelefono2 = $_POST['codigo2'].$_POST['telefono2'];
				} 
				
					if($_POST['cedulaconsulta'] != NULL){ 						
					$SQL="SELECT miembros_empresa.miembros_id,
								   miembros_empresa.nenabled,
								   miembros.ncedula
							  FROM rncpt.miembros_empresa
							  INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
							  WHERE miembros_empresa.nenabled = '1'
							  AND miembros.ncedula = '".$_POST['cedulaconsulta']."' and miembros_empresa.condicion_laboral_id=1 ";
				
						$rs=$conn->Execute($SQL);
					}
				
				if($rs->RecordCount()>0){
					$GLOBALS['aPageErrors'][] = "El Vocero ya se encuentra registrado y activo en otro CPTT";
				}else{

			

					if($_POST['cedulaconsulta'] != NULL){ 
								$SQL="SELECT miembros_empresa.miembros_id,
								   miembros_empresa.nenabled,
								   miembros.ncedula
							  FROM rncpt.miembros_empresa
							  INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
							  WHERE miembros_empresa.nenabled = '1'
							  AND miembros.ncedula = '".$_POST['cedulaconsulta']."'and miembros_empresa.condicion_laboral_id=1 ";			  
							  
						$rs=$conn->Execute($SQL);
					}
					
					if($rs->RecordCount()>0){ //---SI MIENBRO ESTA YA REGISTRADO...
						$GLOBALS['aPageErrors'][] = "El Vocero ya se encuentra registrado y activo en otro CPTT";
					}else{ //---SI MIENBRO NO ESTA REGISTRADO PARA LA EMPRESA...
						$SQL2="SELECT id,  
									stelefono1, 
									stelefono2, 
									semail
							  FROM rncpt.miembros
							  WHERE ncedula ='".$_POST['cedulaconsulta']."';"; 
						$rs2=$conn->Execute($SQL2);
					
							if($rs2->RecordCount()>0){ //---SI MIENBRO NO ESTA REGISTRADO PARA LA EMPRESA PERO SI FUE REGISTRADO EN EL PASADO...
			
								$SQL="UPDATE rncpt.miembros
									  SET stelefono1 = '".$ntelefono1."', 
										  stelefono2 = '".$ntelefono2."', 
										  semail = '".$_POST['email']."', 
										   sdireccion_habitacion = '".$_POST['txt_direccion_hab']."', 
										  usuario_idactualizacion = '".$_SESSION["id_usuario"]."', 
										  dfecha_actualizacion = '".date('Y-m-d H:i:s')."'
									  WHERE id = '".$rs2->fields['id']."';";
								$success= $conn->Execute($SQL);	
								
								$SQL="SELECT id FROM rncpt.miembros WHERE ncedula = '".$_POST['cedulaconsulta']."'";	
								$select = $conn->Execute($SQL);
				
									if ($select->RecordCount()>0){ //---PARA ENCONTRAR AL MIENBRO...
									
										$SQL="INSERT INTO rncpt.miembros_empresa(
															empresa_id, 
															miembros_id, 
															nenabled, 
															usuario_idcreacion,
															dfecha_creacion,
															condicion_act_id,	
															cargos_id,														
															comentarios,
															nro_votos,
															total_trabajadores,
															dfecha_vencimiento,
															dfecha_const_comite,
															condicion_laboral_id
															)
															VALUES ('".$_SESSION["empresa_id"]."',     
																	'".$select->fields['id']."',
																
																	'1',
																	'".$_SESSION["id_usuario"]."',
																	'".date('Y-m-d H:i:s')."',
																	'".$_POST['condicion']."',
																	'".$_POST['cbo_cargos']."',															
																	'".$_POST['txt_comentarios']."',
																	".$_POST['nro_votos'].",
																	".$_POST['total_trabajadores'].",
																	'".$fechavencimiento."',
																	'".$fechaconst."',
																	1
																	);";  
										$success = $conn->Execute($SQL);
			
									$GLOBALS['aPageErrors'][] = "El Vocero Fue Agregado Exitosamente";
									}			
						
							}else{ //---SI EL MIEMBRO NUCA SE HA REGISTRADO...
								
								if ($_POST['sexo'] == 'M'){
								$nsexo = 1;
								}
								if ($_POST['sexo'] == 'F'){
								$nsexo = 2;
								}
								
								$date_ = strtotime($_POST['fecha_nacimiento']);
								$fechanac =date('Y-m-d',$date_);
								
								$SQL="INSERT INTO rncpt.miembros(
												ncedula,
												sprimer_nombre,
												ssegundo_nombre,
												sprimer_apellido,
												ssegundo_apellido,
												stelefono1,
												stelefono2,
												semail,
												usuario_idcreacion,
												dfecha_creacion,
												nsexo,
												fecha_nacimiento,
												sdireccion_habitacion
												
											)
												VALUES (".$_POST['cedulaconsulta'].", 
														'".$_POST['primer_nombre']."',
														'".$_POST['segundo_nombre']."',
														'".$_POST['primer_apellido']."',
														'".$_POST['segundo_apellido']."',
														'".$ntelefono1."',
														'".$ntelefono2."',
														'".$_POST['email']."',
														".$_SESSION["id_usuario"].",
														'".date('Y-m-d H:i:s')."',
														'".$nsexo."',
														'".$fechanac."',
														'".$_POST['txt_direccion_hab']."'												
														);";
								$success = $conn->Execute($SQL);
								
									$SQL="SELECT id FROM rncpt.miembros WHERE ncedula = '".$_POST['cedulaconsulta']."'";	
									$select = $conn->Execute($SQL);
					
										if ($select->RecordCount()>0){
										
											$SQL="INSERT INTO rncpt.miembros_empresa(
															empresa_id, 
															miembros_id, 
															nenabled, 
															usuario_idcreacion,
															dfecha_creacion,
															condicion_act_id,	
															cargos_id,														
															comentarios,
															nro_votos,
															total_trabajadores,
															dfecha_vencimiento,
															dfecha_const_comite,
															condicion_laboral_id
															)
															VALUES ('".$_SESSION["empresa_id"]."',     
																	'".$select->fields['id']."',
																
																	'1',
																	'".$_SESSION["id_usuario"]."',
																	'".date('Y-m-d H:i:s')."',
																	'".$_POST['condicion']."',
																	'".$_POST['cbo_cargos']."',															
																	'".$_POST['txt_comentarios']."',
																	".$_POST['nro_votos'].",
																	".$_POST['total_trabajadores'].",
																	'".$fechavencimiento."',
																	'".$fechaconst."',
																	1);"; 
											$success = $conn->Execute($SQL);
				
										$GLOBALS['aPageErrors'][] = "El Vocero Fue Agregado Exitosamente";
										}
							}
							

					}
				}
				}
			loadData($conn, true);
			break;
			
		}
	}else{
		unset($_SESSION['aTabla_nomina']);
		LoadData($conn, false);
	}
}

//-------------------- Función LoadData --------------------//
function LoadData($conn,$bPostBack){

	if($_GET['id']){
		$_SESSION['empresa_id']=$_GET['id'];		
	}else{
		//$_SESSION['empresa_id']=$_SESSION['empresa_id'];
	}
		if($_GET['entidad']){
		$_SESSION['entidad']=$_GET['entidad'];		
	}else{
		//$_SESSION['entidad']=$_SESSION['entidad'];
	}

	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];

		if (!$bPostBack){
			$SQL = "SELECT miembros_empresa.id as id_miembro_empresa, 
						miembros_empresa.nenabled,
						miembros.id,
						miembros.ncedula,
						miembros.sprimer_nombre,
						miembros.ssegundo_nombre,
						miembros.sprimer_apellido,
						miembros.ssegundo_apellido,
						miembros.stelefono1,
						miembros.stelefono2,
						miembros.nsexo,
						miembros.semail,
						miembros.fecha_nacimiento,
						condicion_act.sdescripcion as condicion_act,
						cargos.descripcion_cargo	as cargos					
				FROM rncpt.miembros_empresa
				INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
				inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
				inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
				WHERE miembros_empresa.empresa_id = '".$_SESSION["empresa_id"]."' 
				AND miembros_empresa.nenabled = '1' and miembros_empresa.condicion_laboral_id=1;";
		//echo "<br>".$SQL;
		
		$rs = $conn->Execute($SQL);
		
		$_SESSION['EOF']=$rs->RecordCount();
			if ($rs->RecordCount()>0){
				while(!$rs->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;
					$apellidonombre = ucwords(strtolower($rs->fields['sprimer_apellido']." ".$rs->fields['ssegundo_apellido']." ".$rs->fields['sprimer_nombre']." ".$rs->fields['ssegundo_nombre']));
						$apellidonombre_ = ucwords(strtolower($rs->fields['sprimer_apellido']." ".$rs->fields['sprimer_nombre']));
						
					$aTabla[$c]['ncedula']=$rs->fields['ncedula'];
					$aTabla[$c]['apellidonombre']=$apellidonombre;
					$aTabla[$c]['apellidonombre_']=$apellidonombre_;
					$aTabla[$c]['stelefono1']=$rs->fields['stelefono1'];
					$aTabla[$c]['stelefono2']=$rs->fields['stelefono2'];
					$aTabla[$c]['semail']=$rs->fields['semail'];
					$sexo=$rs->fields['nsexo'];
					if($sexo=='1') $aTabla[$c]['sexo']='M';
					if($sexo=='2') $aTabla[$c]['sexo']='F';
					
					$aTabla[$c]['condicion_act']=$rs->fields['condicion_act'];
					
					$aTabla[$c]['id']=$rs->fields['id'];	
					$aTabla[$c]['id_miembro_empresa']=$rs->fields['id_miembro_empresa'];
					
					
					$aTabla[$c]['fecha_nacimiento']=$rs->fields['fecha_nacimiento'];
					
					
								
						$aTabla[$c]['cargos']=$rs->fields['cargos'];	
		
					$rs->MoveNext();
				}
				$_SESSION['aTabla_nomina'] = $aTabla;
				$_SESSION['aDefaults']	=$_SESSION['aTabla_nomina'];
			
			}else{
				unset($_SESSION['aTabla_nomina']);
				unset($_SESSION['aDefaults']);
			}

			$sql="Select srif, 
					srazon_social,
					sdenominacion_comercial,
					sucursales
				 from rncpt.empresa where empresa.id = '".$_SESSION["empresa_id"]."' ";
				 $rs = $conn->Execute($sql);
				 if ($rs->Recordcount()>0){
			$_SESSION['aDefaults1']['razon_empresa']= $rs->fields['srazon_social'];
			$_SESSION['aDefaults1']['sdenominacion_comercial']= $rs->fields['sdenominacion_comercial'];
			$_SESSION['aDefaults1']['srif']= $rs->fields['srif'];
			$_SESSION['aDefaults1']['sucursales']= $rs->fields['sucursales'];
			
				 }
		$aDefaultForm['fechaconst']='';
		$aDefaultForm['fechavencimiento']='';
		$aDefaultForm['total_trabajadores']='';
		$aDefaultForm['fechavencimiento_']='';
		$aDefaultForm['total_trabajadores_']='';
		//$aDefaultForm['fecha_nacimiento']='';
		
		
//------------------------------------------------------------------		
		
//------------------------------------------------------------------
	}else{
	$aDefaultForm['fechaconst']=$_POST['fechaconst'];
	$aDefaultForm['fechavencimiento']=$_POST['fechavencimiento_'];
	$aDefaultForm['fechavencimiento_']=$aDefaultForm['fechavencimiento'];
	$aDefaultForm['total_trabajadores']=$_POST['total_trabajadores'];
	$aDefaultForm['total_trabajadores_']=$aDefaultForm['total_trabajadores'];
	//$aDefaultForm['fecha_nacimiento']=$_POST['fechanac'];
		
	$SQL = "SELECT miembros_empresa.id, 
						miembros_empresa.nenabled,
						miembros.ncedula,
						miembros.sprimer_nombre,
						miembros.ssegundo_nombre,
						miembros.sprimer_apellido,
						miembros.ssegundo_apellido,
						miembros.stelefono1,
						miembros.stelefono2,
						miembros.nsexo,
						miembros.semail,
						miembros.fecha_nacimiento,
						condicion_act.sdescripcion as condicion_act,
						cargos.descripcion_cargo	as cargos					
				FROM rncpt.miembros_empresa
				INNER JOIN rncpt.miembros ON miembros.id = miembros_empresa.miembros_id
				inner join rncpt.cargos on miembros_empresa.cargos_id=cargos.id
				inner join rncpt.condicion_act on miembros_empresa.condicion_act_id=condicion_act.id
				WHERE miembros_empresa.empresa_id = '".$_SESSION["empresa_id"]."' 
				AND miembros_empresa.nenabled = '1';";
		//echo "<br>".$SQL;
		
		$rs = $conn->Execute($SQL);
		
		$_SESSION['EOF']=$rs->RecordCount();
			if ($rs->RecordCount()>0){
				while(!$rs->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;
					$apellidonombre = ucwords(strtolower($rs->fields['sprimer_apellido']." ".$rs->fields['ssegundo_apellido']." ".$rs->fields['sprimer_nombre']." ".$rs->fields['ssegundo_nombre']));
						$apellidonombre_ = ucwords(strtolower($rs->fields['sprimer_apellido']." ".$rs->fields['sprimer_nombre']));
					$aTabla[$c]['sdescripcion']=$rs->fields['condicion_act'];
					$aTabla[$c]['ncedula']=$rs->fields['ncedula'];
					$aTabla[$c]['apellidonombre']=$apellidonombre;
					$aTabla[$c]['apellidonombre_']=$apellidonombre_;
					$aTabla[$c]['stelefono1']=$rs->fields['stelefono1'];
					$aTabla[$c]['stelefono2']=$rs->fields['stelefono2'];
					$aTabla[$c]['semail']=$rs->fields['semail'];
					$sexo=$rs->fields['nsexo'];
					if($sexo=='1') $aTabla[$c]['sexo']='M';
					if($sexo=='2') $aTabla[$c]['sexo']='F';
				 $aTabla[$c]['condicion_act']=$rs->fields['condicion_act'];
					
					$aTabla[$c]['id']=$rs->fields['id'];	
					
					$aTabla[$c]['fecha_nacimiento']=$rs->fields['fecha_nacimiento'];		
								
					$aTabla[$c]['cargos']=$rs->fields['cargos'];			
		
					$rs->MoveNext();
				}
				$_SESSION['aTabla_nomina'] = $aTabla;
				$_SESSION['aDefaults']=$_SESSION['aTabla_nomina'];
			}else{
				unset($_SESSION['aTabla_nomina']);
			}	
		
	}
		}
}

function Loadcondicion_act($conn){  
	$sHtml_Var = "sHtml_cb_condicion";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, sdescripcion FROM rncpt.condicion_act where nenabled='1' order by sdescripcion ";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_cargos']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}

function LoadCargos($conn){  
	$sHtml_Var = "sHtml_cb_Cargos";
	if (!isset($GLOBALS[$sHtml_Var])){
		$GLOBALS[$sHtml_Var] = '';
	}	
	if ($GLOBALS[$sHtml_Var] == ''){
		$sSQL="SELECT id, descripcion_cargo FROM rncpt.cargos where nenabled='1' order by descripcion_cargo ";
		echo $sSQL;		
		$rs = &$conn->Execute($sSQL); 
		while ( !$rs->EOF ){
			$GLOBALS[$sHtml_Var] .= "<option value='".$rs->fields['0']."'";
			if ($rs->fields['0'] == $GLOBALS['aDefaultForm']['cbo_cargos']) {
				$GLOBALS[$sHtml_Var].= " selected='selected'";
			}
			$GLOBALS[$sHtml_Var] .= ">".$rs->fields['1']." </option>\n";
			$rs->MoveNext();
		}		
	}
}
function getboleta($conn,$estado){
	
$rs1= &$conn->Execute("	SELECT rncpt.control_boleta.id_entidad as entidad,ncorrelativo,sanno,  public.entidad.id ,public.entidad.nentidad 
FROM rncpt.control_boleta
inner join public.entidad on rncpt.control_boleta.id_entidad=public.entidad.id 

WHERE public.entidad.nentidad ='".$_SESSION['entidad']."' and rncpt.control_boleta.nenabled=1");
		if ( $rs1->RecordCount()>0 ){
			$estado = strtoupper($rs1->fields['entidad']);
			$anno=$rs1->fields['sanno'];
			$correlativo =$rs1->fields['ncorrelativo']+1;
		}
		
		$boleta =$anno."-".str_pad( $estado,2,'0',STR_PAD_LEFT )."-".str_pad( $correlativo,5,'0',STR_PAD_LEFT );
	
	$rs1= &$conn->Execute("UPDATE rncpt.control_boleta
   SET  ncorrelativo=".$correlativo."
 WHERE rncpt.control_boleta.id_entidad='".$estado."' and sanno='".$anno."' ");
		
		return $boleta;
}
function ProcessForm($conn){

}

?>
<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
	<style type="text/css">

	.loaders {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;	
		background: url('../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255,255,255);
		opacity: 0.6;
    	filter: alpha(opacity=60);
	}
	
	</style>

<form method="post" id="formularioCPT" name="formularioCPT" action="<?=$_SERVER['PHP_SELF'] ?>" >
	<!--Datos Ocultos Información para sumit-->
	<input name="action" type="hidden" value=""/>
	<input name="id" type="hidden" value=""/>
	<!--Datos Ocultos Información para Guardar Trabajador-->
	<input name="cedulaidentida" id="cedulaidentida" type="hidden" value=""/>
	<input name="primer_nombre" id="primer_nombre" type="hidden" value=""/>
	<input name="segundo_nombre" id="segundo_nombre" type="hidden" value=""/>
	<input name="primer_apellido" id="primer_apellido" type="hidden" value=""/>
	<input name="segundo_apellido" id="segundo_apellido" type="hidden" value=""/>
	<input name="sexo" id="sexo" type="hidden" value=""/>
    <input name="condicion_laboral" id="condicion_laboral" type="hidden" value=""/>
    <input name="fecha_nacimiento" id="fecha_nacimiento" type="hidden" value=""/>
    <input name="fechavencimiento_" id="fechavencimiento_" type="hidden" value="<?=$aDefaultForm['fechavencimiento']?>"/>
     <input name="total_trabajadores_" id="total_trabajadores_" type="hidden" value="<?=$aDefaultForm['total_trabajadores']?>"/>
    

    

<script language="JavaScript" type="text/javascript" src="funcion_registro_personal.js"></script>
<script language="JavaScript" type="text/javascript" src="funcion_identifica_ciudadano.js"></script>


<script>
	function send(saction){
	
			$("#loader").show();
			var form = document.formularioCPT;
			form.action.value=saction;
			form.submit();
	
	}
</script>

<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">

     <tr>
		  <th colspan="4"  class="sub_titulo"><div align="left">RNCPTT --> Registrar Entidades de Trabajo</div></th>
     </tr>
	 
    <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
    </tr>
	  
    <tr>
	 	<th colspan="4"  class="titulo" align="center"></th>
	</tr>
	
   <tr class="identificacion_seccion">
		<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS DE CONSTITUCI&Oacute;N DEL CPTT</th>
    </tr> 
	  
	<tr>
		<td colspan="4"> </td> 
	</tr>
	
	
        <tr>
           <!-- <th width="24%" align="center" class="sub_titulo">N&deg; de Boleta o Nomenclatura</th>		
            <th width="22%" align="center"  class="sub_titulo">Estatus o Car&aacute;cter</th>-->
            <th style="color:#666" width="22%"><div align="center">Fecha de Constituci&oacute;n</div></th>
			<th style="color:#666" width="22%"><div align="center">Fecha de Vencimiento</div></th>            
            <th style="color:#666" width="32%"><div align="center">Total de Trabajadores de la Entidad de Trabajo</div></th>  
            <th style="color:#666" width="24%"><div align="center">N&deg; de Votos el cuál fue electo</div></th>	
        </tr>
		
	 <tr>
		<td colspan="4"> </td> 
	 </tr>	
	 
		
   <tr>      
     <td align="center"><input style="border-radius: 30px; border-color:#999999; width:55%" name="fechaconst" id="fechaconst" type="text"  size="10"   title="Fecha de Constitución del CPTT - Indique en el calendario la Fecha de Constitución del CPTT." value="<?=$aDefaultForm['fechaconst']?>"  />
<a  id="f_btn1"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
<script type="text/javascript">
              Calendar.setup({
              inputField : "fechaconst",
              trigger    : "f_btn1",
              onSelect   : function() { vecimiento(); this.hide() },
              showTime   : false,
             
			  dateFormat : "%Y-%m-%d",
			  disabled: function(date) {
						var today = new Date();
						return (
						date.getDate() == 0 || (date.getTime() > today.getTime()-(1*24*60*60*1000) )
						) ? true : false; }
			  
              });
</script>
<span>*</span></td>

	<td align="center">       
            <div align="center"><input style="border-radius: 30px; border-color:#999999; width:55%" name="fechavencimiento" id="fechavencimiento" type="text"  size="20"   disabled="disabled" title="Fecha de Vencimiento - El vencimiento del CPTT es dos (2) años " value="<? print $aDefaultForm['fechavencimiento']?>" />  <span> * </span> </div>                    
    </td>
	
	<td width="22%" align="center">
 <input style="border-radius: 30px; border-color:#999999; width:55%" name="total_trabajadores" id="total_trabajadores" type="text" title="Total de Trabajadores de la Entidad de Trabajo - Ingrese s&oacute;lo N&uacute;meros. Acepta ocho (8) dígitos." maxlength="8" onkeypress="return isNumberKey(event);" value="<? print $aDefaultForm['total_trabajadores']?>" ><span>*</span>
</td>

      <td  align="center">
      <input style="border-radius: 30px; border-color:#999999; width:55%" name="nro_votos" id="nro_votos" type="text" title="Número de Votos el cual fue electo - Ingrese s&oacute;lo N&uacute;meros. Acepta ocho (8) dígitos." maxlength="8" onkeypress="return isNumberKey(event);"value="" ><span>*</span>
      </td>
   </tr>       
           
	<tr>
		<td colspan="4"> </td> 
	</tr>	
		   
   <tr>
      <th style="color:#666" colspan="4"><div  align="left">Comentarios u Observaciones</div></th>	              
   </tr>
   
   	 <tr>
		<td colspan="4"> </td> 
	 </tr>	
	 
	<tr>
	  <td colspan="4" align="left">
        <textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_comentarios" id="txt_comentarios" cols="140"  title="Comentario u  Observaci&oacute;n - Agregue un comentario u observaci&oacute;n de ser necesario para este registro." rows="1" onkeyup="mayusculas(this);"><?= $aDefaultForm['txt_comentarios'];?></textarea>
     </td>
    </tr>
	
	<tr>
		<td colspan="4"> </td> 
	</tr>		
	  
    <tr class="identificacion_seccion">
		<th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS DE VOCEROS DEL CPTT</th>
    </tr>
	
	<tr>
		<td colspan="4"> </td> 
	</tr>
		
    <tr>
        <th style="color:#666" align="left">C&eacute;dula de Identidad</th>		
        <th style="color:#666" align="left">Apellidos y Nombres</th>
        <th style="color:#666" align="left">Fecha de Nacimiento</th>
        <th style="color:#666" align="left">Edad</th>	
     </tr>    
	 
	<tr>
	  <td colspan="4"> </td> 
	</tr>
	
	    <tr> 
    <td>
    <select style="border-radius: 30px; border-color:#999999; width:20%" name="nacionalidad" id="nacionalidad">
              <option value="1">V</option>
              <option value="2">E</option>
            </select>   
    <input style="border-radius: 30px; border-color:#999999; width:55%" name="cedulaconsulta" id="cedulaconsulta" type="text" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta ocho (8) D&iacute;gitos." maxlength="8" onkeypress="return isNumberKey(event);" onblur="identificaciudadano()">          
            <span> * </span>
        </label></td>  
	
   <td><div align="left"><input style="border-radius: 30px; border-color:#999999; width:85%" name="apellidonombre" type="text" id="apellidonombre" value="" size="35" disabled="disabled"></div></td>   
           
   <td> <div align="left"><input style="border-radius: 30px; border-color:#999999; width:75%"name="fechanac" id="fechanac" type="text"  size="30"  title="Fecha de Nacimiento - Indique en el calendario la fecha de Fecha de Nacimiento del Vocero del CPTT" value="" disabled="disabled" /></div>                       
   </td>
           
	 <td><div align="left"><input style="border-radius: 30px; border-color:#999999; width:85%" name="edad" type="text" id="edad" value="" size="30" onblur=""disabled="disabled"></div></td>           
  </tr>  
    
  	<tr>
		<td colspan="4"> </td> 
	</tr>
	
      <tr>
       	<th style="color:#666" align="center">Sexo</th>
        <th style="color:#666" align="center">Tel&eacute;fono Personal</div></th>
        <th style="color:#666" align="center">Tel&eacute;fono de Habitación</th>
        <th style="color:#666" align="center">Correo Electr&oacute;nico Personal</th>
     </tr>
	 
	<tr>
		<td colspan="4"> </td> 
	</tr>
	
   <tr>
	<td align="left"><input style="border-radius: 30px; border-color:#999999; width:80%" name="sexo2"  type="text" id="sexo2"  size="30" maxlength="8" disabled="disabled"/></td>
	</td>
    <td align="left">
      <input style="border-radius: 30px; border-color:#999999; width:25%" name="codigo1" type="text" id="codigo1"  onkeypress="return isNumberKey(event);" onblur="" size="6" maxlength="4" autocomplete="off" placeholder="Ej. 0000"/> 
      <label> - </label> 
	  <input style="border-radius: 30px; border-color:#999999; width:55%" name="telefono1" type="text" id="telefono1" onblur="" onkeypress="return isNumberKey(event);" title="Tel&eacute;fono Personal - Ingrese s&oacute;lo n&uacute;meros. Acepta  once (11) d&iacute;gitos. Ejemplo: 0212 -1234567" size="10" maxlength="7" autocomplete="off" placeholder="Ej. 1234567"/>
	  </label></td>
	  
	  <td align="left">
        <input style="border-radius: 30px; border-color:#999999; width:25%" name="codigo2" type="text" id="codigo2" onkeypress="return isNumberKey(event);" onblur="" size="6" maxlength="4" autocomplete="off" placeholder="Ej. 0000"/> 
      <label> - </label> 
	  <input style="border-radius: 30px; border-color:#999999; width:45%" name="telefono2" type="text" id="telefono2"onblur=""  onkeypress="return isNumberKey(event);" title="Tel&eacute;fono de Habitaci&oacute;n - Ingrese s&oacute;lo n&uacute;meros. Acepta  once (11) d&iacute;gitos. Ejemplo: 0212 -1234567" size="10" maxlength="7" autocomplete="off" placeholder="Ej. 1234567"/> 
      </label></td>
	  
      <td align="left" ><input style="border-radius: 30px; border-color:#999999; width:85%" name="email" type="text" id="email" onBlur="validarEmail()" size="20" autocomplete="off" title="Correo Electr&oacute;nico Personal - Ingrese un Correo Electr&oacute;nico V&aacute;lido. Acepta un m&iacute;nimo de diez (10) y m&aacute;ximo de treinta (30) caracteres. Ejemplo: juancito@gmail.com" value="" placeholder="Ej. juancito@gmail.com"/>
        <span class="requerido"> * </span></td>
    </tr>    
        
	<tr>
		<td colspan="4"> </td> 
	</tr>
	
     <tr>
      <th style="color:#666" colspan="4"><div  align="left">Direcci&oacute;n de Habitaci&oacute;n</div></th>	              
   </tr>
   
   	<tr>
		<td colspan="4"> </td> 
	</tr>
	
	<tr>
	  <td colspan="4" align="left">
        <textarea style="border-radius: 30px; border-color:#999999; width:95%" name="txt_direccion_hab" id="txt_direccion_hab" cols="140"  size="100" title="Dirección de Habitación - Ingrese la Dirección de Habitación del vocero del CPTT." onkeyup="mayusculas(this);" rows="1"><?= $aDefaultForm['txt_direccion_hab'];?></textarea>
     </td>
    </tr>
    
	<tr>
		<td colspan="4"> </td> 
	</tr>
    
     <tr>
        <th style="color:#666"><div align="left">Condici&oacute;n Actual</div></th>		
        <th style="color:#666" colspan="3"><div align="left">Cargo</div></th>      
     </tr>  
	 
	 <tr>
		<td colspan="4"> </td> 
	</tr>
	 	
    <tr>
	  <td align="left"> 
              <select style="border-radius: 30px; border-color:#999999; width:65%" name="condicion" id="condicion">
              <option value="">Seleccione</option>
               <? Loadcondicion_act ($conn) ; print $GLOBALS['sHtml_cb_condicion']; ?>
            </select>
            </select> 
            <span>*</span>
      </td>   
	  
     <td align="left" id="td_condicion_laboral" colspan="3"> <select style="border-radius: 30px; border-color:#999999; width:95%" id="cbo_cargos" name="cbo_cargos" >
            <option value="">Seleccione</option>
            <? LoadCargos ($conn) ; print $GLOBALS['sHtml_cb_Cargos']; ?>
            </select>
			<span>*</span>	
     
     </td>   
     </tr>
     
  
        <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
	  	<td colspan="4" align="center">
			<button type="button" name="guardar"  id="guardar" class="button_personal button_guardar" onclick="javascript:guardarT('Guardar');" <? echo $_SESSION['disabled']?> title="Guardar - Haga Click para Continuar"/> Agregar
			<img src="../imagenes/add.png" /></button>         
          </td>
    </tr>
</table>

 <table class="display formulario" border="0" align="center" id="tblDetalle" width="98%">
  		<thead>
        <tr class="identificacion_seccion">
        <th colspan="5" class="sub_titulo_2" align="left">VOCEROS DEL CPTT</th>
    </tr>  
			<tr>
<!--				 <th width="10%" align="left" class="sub_titulo"  ><div align="center">TIPO</div></th>-->
				 <th width="10%" align="left" class="sub_titulo"><div align="center">Cédula de Identidad</div></th>
				 <th width="25%" align="left" class="sub_titulo" ><div align="center">Apellidos y Nombres</div></th>
	<!--			 <th width="5%" align="left" class="sub_titulo" ><div align="center">SEXO/GENERO</div></th>-->
				 <th width="10%" align="left" class="sub_titulo"><div align="center">Teléfono Personal</div></th>
<!--				 <th width="10%" align="left" class="sub_titulo"><div align="center">TELEF. 2.</div></th>-->
				 <th width="20%" align="left" class="sub_titulo"><div align="center">Correo Electrónico Personal</div></th>
				 <th width="5%" align="left" class="sub_titulo">Eliminar</th>
		   </tr>
	  <tbody>
			   <?
				$aTabla=$_SESSION['aTabla_nomina'];
				$aDefaultForm = $GLOBALS['aDefaultForm'];
				for( $c=0; $c<count($aTabla); $c++){
				       if (($c%2) == 0) $class_name = "dataListColumn";
				         else $class_name = "dataListColumn";
				?>
				<tr  class="<?=$class_name?>">
					<td align="center"><?=$aTabla[$c]['ncedula']?></td>
					<td class="texto-normal" align="center"><?=$aTabla[$c]['apellidonombre']?></td>
					<td class="texto-normal" align="center"><?=$aTabla[$c]['stelefono1']?></td>
					<td class="texto-normal" align="center"><?=$aTabla[$c]['semail']?></td>
					<td class="texto-normal" align="center"><a id="elimina_trabajador" align="center" onclick="javascript:eliminarT('Eliminar','<? echo $aTabla[$c]['id']; ?>');" ><img src="../imagenes/delete_16.png" width="12" height="12" title="Eliminar Vocero - Haga clic para eliminar al Vocero"/></a></td>
				</tr>
				<? 
				} 
				?>
	  </tbody>
		</thead>
  </table>
<br />

<table width="100%" border="0">
  <tr>
      <td colspan="4" align="center">
      <button type="button" name="cmd_guardar"  id="cmd_guardar" class="button_personal btn_aceptar" onclick="javascript:send('Redireccionar');"title="Guardar - Haga Click para Continuar">Generar Boleta</button>
<!--      <button type="button" name="regresar"  id="regresar" class="button_personal btn_regresar" onclick="javascript:send('Regresar');"title="Regresar - Haga Click para Ir a la pantalla anterior">Regresar</button>-->
      </td>
  </tr>
   
        <tr>
      <td  width="20"colspan="4">&nbsp;</td>
    </tr>
</table>

<div id="loader" class="loaders" style="display: none;"></div>
</form>
    		
	</td>
	</tr>
	</tbody>
	</table>
<? include('../../footer.php'); ?>
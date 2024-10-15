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
		var_dump($_SESSION);
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn,$acceso1){
if (isset($_POST['action'])){
		switch($_POST['action']){
		
		case 'Cancelar':
				unset($_SESSION['criterio']);
		        unset($_SESSION['funcionario']);
				unset($_SESSION['aTabla']); unset($_SESSION['aTabla1']); unset($_SESSION['aTabla2']); unset($_SESSION['aTabla3']);
				unset($_SESSION['where']); unset($_SESSION['where1']); unset($_SESSION['where2']);	
				unset($_SESSION['q1']);	unset($_SESSION['q2']);	unset($_SESSION['q3']);
				unset($_SESSION['q4']); unset($_SESSION['q5']); unset($_SESSION['q6']);
				unset($_SESSION['q7']); unset($_SESSION['q8']); unset($_SESSION['q9']);
				unset($_SESSION['q10']); unset($_SESSION['q11']); unset($_SESSION['q12']);
				LoadData($conn,false);
		break;
		
		case 'Aceptar':
				unset($_SESSION['criterio']);
			    unset($_SESSION['funcionario']);
				unset($_SESSION['aTabla']); unset($_SESSION['aTabla1']); unset($_SESSION['aTabla2']); unset($_SESSION['aTabla3']);
				unset($_SESSION['where']); unset($_SESSION['where1']); unset($_SESSION['where2']);	
				unset($_SESSION['q1']);	unset($_SESSION['q2']);	unset($_SESSION['q3']);
				unset($_SESSION['q4']); unset($_SESSION['q5']); unset($_SESSION['q6']);
				unset($_SESSION['q7']); unset($_SESSION['q8']); unset($_SESSION['q9']);
				unset($_SESSION['q10']); unset($_SESSION['q11']); unset($_SESSION['q12']);	
			$bValidateSuccess = true;
				
			if ($_POST['fdesde']!='' and $_POST['fhasta']!=''){
				list($a,$m,$d)=explode("-", $_POST['fdesde']);
				$_POST['fdesde']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
				list($a,$m,$d)=explode("-", $_POST['fhasta']);
				$_POST['fhasta']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;	
					
			    $_SESSION['where'].= " and fecha between '".$_POST['fdesde']." 00:00:00' and  '".$_POST['fhasta']." 23:59:59'";
			      }
			else{
			    $GLOBALS['aPageErrors'][]= "- El rango de Fechas: es requerido.";
			    $bValidateSuccess=false;
			}
			
			if ($_POST['Ced_funcionario']!=''){
			    $sql="select snombre, sapellido 
						from usuario where susuario='".$_POST['Ced_funcionario']."'";
						$rs= $acceso1->Execute($sql);
						if ($rs->RecordCount()>0){
					    $_SESSION['funcionario']=$rs->fields['snombre'].' '.$rs->fields['sapellido'].' CI: '.$_POST['Ced_funcionario'];
				        $_SESSION['where'].= " and usuario_id='".$_POST['Ced_funcionario']."'";
						}
						else{
						$GLOBALS['aPageErrors'][]= "- El(La) funcionario(a): no se encuentra registrado(a).";
						$bValidateSuccess=false;
						}
					}
									
			if($_POST['cbAgencia']!='-1'){
			   $_SESSION['where1'].=" and personas.sunidadsustantiva='".$_POST['cbAgencia']."'";
			   $_SESSION['where2'].=" and empresa_instituto.sunidadsustantiva='".$_POST['cbAgencia']."'";
			  }
			  
		    if ($bValidateSuccess){
				ProcessForm($conn,$acceso1);
				}
	            LoadData($conn,true);	
		break;
			
		
		case 'cbAgencia_changed':
			  LoadData($acceso1,true);
		break;
		
		case 'trabajadores_reg':
			$SQL="select fecha, consulta, personas.nombres, personas.apellidos, modulo.nombre as modulo, personas.cedula, usuario_id
			      from trazas ".$_SESSION['q1']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['trabajador']=$rs->fields['nombres'].' '.$rs->fields['apellidos'];
						$aTabla[$c]['cedula']=$rs->fields['cedula'];					
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó'; 
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido'];	
					   $aTabla[$c]['susuario']=$usuario_id;				  
				   $rs->MoveNext();
				   }	
				 $_SESSION['criterio']="Detalle: Registro de Trabajadores";				 	
			     $_SESSION['aTabla'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><? 
		break; 
		
		case 'trabajadores_act':
		      $SQL="select fecha, consulta, personas.nombres, personas.apellidos, modulo.nombre as modulo, personas.cedula, usuario_id
			      from trazas ".$_SESSION['q2']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['trabajador']=$rs->fields['nombres'].' '.$rs->fields['apellidos'];
						$aTabla[$c]['cedula']=$rs->fields['cedula'];					
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó'; 
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido'];	
					   $aTabla[$c]['susuario']=$usuario_id;						
				   $rs->MoveNext();
				   }
				 $_SESSION['criterio']="Detalle: Actualización de Trabajadores";					 	
			     $_SESSION['aTabla'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break;
		
		case 'empresa_reg':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, usuario_id
			      from trazas ".$_SESSION['q3']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];					
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó'; 	
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido'];
					   $aTabla[$c]['susuario']=$usuario_id;						
				   $rs->MoveNext();
				   }
				 $_SESSION['criterio']="Detalle: Registro de Entidades de Trabajo";						 	
			     $_SESSION['aTabla1'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break;
		
		case 'empresa_act':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, usuario_id
			      from trazas ".$_SESSION['q4']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];					
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó';
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido']; 
					   $aTabla[$c]['susuario']=$usuario_id;							
				   $rs->MoveNext();
				   }
				 $_SESSION['criterio']="Detalle: Actualización de Entidades de Trabajo";					 	
			     $_SESSION['aTabla1'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break;
		
		case 'empleo_reg':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, 
			      ocupacion.nombre as ocupacion, usuario_id, oferta_empleo.id as oferta 
				  from trazas ".$_SESSION['q5']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];
						$aTabla[$c]['ocupacion']=$rs->fields['ocupacion'];					
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó';
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido'];
					   $aTabla[$c]['susuario']=$usuario_id;	 						
				   $rs->MoveNext();
				   }
				 $_SESSION['criterio']="Detalle: Registro de Oportunidades de Trabajo";					 	
			     $_SESSION['aTabla2'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break;   
		
		case 'empleo_act':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, 
			      ocupacion.nombre as ocupacion, usuario_id, oferta_empleo.id as oferta 
				  from trazas ".$_SESSION['q6']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];
						$aTabla[$c]['ocupacion']=$rs->fields['ocupacion'];					
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó'; 	
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido'];
					   $aTabla[$c]['susuario']=$usuario_id;						
				   $rs->MoveNext();
				   }
				 $_SESSION['criterio']="Detalle: Actualización de Oportunidades de Trabajo";					 	
			     $_SESSION['aTabla2'] = $aTabla;		          
		      } 
		      ?><script>document.location="9_2rep_interno_funcionario.php?";</script><? 
		break;   
		
		case 'capacitacion_reg':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, 
			   ocupacion.nombre as ocupacion, ocupacion.id as ocup_id, usuario_id, oferta_capacitacion.id as oferta 
			   from trazas ".$_SESSION['q7']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];						
						$ocup_id=$rs->fields['ocup_id'];
						if ($ocup_id=='-1'){$aTabla[$c]['ocupacion']='Todas las Ocupaciones';}
						else{$aTabla[$c]['ocupacion']=$rs->fields['ocupacion'];}									
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó';
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido'];
					   $aTabla[$c]['susuario']=$usuario_id;	 						
				   $rs->MoveNext();
				   }
				 $_SESSION['criterio']="Detalle: Registro de Oportunidades de Capacitación";						 	
			     $_SESSION['aTabla2'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><? 
		break;   
		
		case 'capacitacion_act':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, 
			   ocupacion.nombre as ocupacion, ocupacion.id as ocup_id, usuario_id, oferta_capacitacion.id as oferta
			   from trazas ".$_SESSION['q8']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];	
						$ocup_id=$rs->fields['ocup_id'];
						if ($ocup_id=='-1'){$aTabla[$c]['ocupacion']='Todas las Ocupaciones';}
						else{$aTabla[$c]['ocupacion']=$rs->fields['ocupacion'];}					
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó'; 	
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido'];	
					   $aTabla[$c]['susuario']=$usuario_id;					
				   $rs->MoveNext();
				   }	
				 $_SESSION['criterio']="Detalle: Actualización de Oportunidades de Capacitación";					 	
			     $_SESSION['aTabla2'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break;
		
		case 'envio_empleo_reg':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, usuario_id, personas.nombres,
				  personas.apellidos, personas.cedula, oferta_empleo.id  as oferta
			      from trazas ".$_SESSION['q9']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['nombres']=$rs->fields['nombres'];	
						$aTabla[$c]['apellidos']=$rs->fields['apellidos'];	
						$aTabla[$c]['cedula']=$rs->fields['cedula'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];						
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó';
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido']; 
					   $aTabla[$c]['susuario']=$usuario_id;							
				   $rs->MoveNext();
				   }	
				 $_SESSION['criterio']="Detalle: Registro de Postulación Oportunidades de Trabajo";					 	
			     $_SESSION['aTabla3'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break;   
		
		case 'envio_empleo_act':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, usuario_id, personas.nombres,
				  personas.apellidos, personas.cedula, oferta_empleo.id  as oferta
			      from trazas ".$_SESSION['q10']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['nombres']=$rs->fields['nombres'];	
						$aTabla[$c]['apellidos']=$rs->fields['apellidos'];	
						$aTabla[$c]['cedula']=$rs->fields['cedula'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];						
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó';
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido']; 
					   $aTabla[$c]['susuario']=$usuario_id;							
				   $rs->MoveNext();
				   }	
				 $_SESSION['criterio']="Detalle: Actualización de Postulación Oportunidades de Trabajo";				 	
			     $_SESSION['aTabla3'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break; 
		
		case 'envio_capacitacion_reg':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, usuario_id, personas.nombres,
			      personas.apellidos, personas.cedula, oferta_capacitacion.id as oferta
			      from trazas ".$_SESSION['q11']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['nombres']=$rs->fields['nombres'];	
						$aTabla[$c]['apellidos']=$rs->fields['apellidos'];	
						$aTabla[$c]['cedula']=$rs->fields['cedula'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];						
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó';
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido']; 
					   $aTabla[$c]['susuario']=$usuario_id;							
				   $rs->MoveNext();
				   }	
				 $_SESSION['criterio']="Detalle: Registro de Postulación Oportunidades de Capacitación";				 	
			     $_SESSION['aTabla3'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
		break;   
		
		case 'envio_capacitacion_act':
			$SQL="select fecha, consulta, empresa_instituto.nombre as empresa, rif, modulo.nombre as modulo, usuario_id, personas.nombres, 
			      personas.apellidos, personas.cedula, oferta_capacitacion.id as oferta
				  from trazas ".$_SESSION['q12']." ".$_SESSION['where']." ";
				 $rs = $conn->Execute($SQL);
				 if ($rs->RecordCount()>0){ 
					$aTabla=array();
					while(!$rs->EOF){
						$c = count($aTabla); 
						$aTabla[$c]['empresa']=$rs->fields['empresa'];
						$aTabla[$c]['rif']=$rs->fields['rif'];	
						$aTabla[$c]['id']=$rs->fields['id'];	
						$aTabla[$c]['nombres']=$rs->fields['nombres'];	
						$aTabla[$c]['apellidos']=$rs->fields['apellidos'];	
						$aTabla[$c]['cedula']=$rs->fields['cedula'];	
						$aTabla[$c]['oferta']=$rs->fields['oferta'];						
						$aTabla[$c]['modulo']=$rs->fields['modulo']; 
						$aTabla[$c]['fecha']=$rs->fields['fecha'];						
					    if (preg_match('/(update)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Actualizó'; 						
						if (preg_match('/(insert)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Agregó'; 	
						if (preg_match('/(delete)/', $rs->fields['consulta'])) $aTabla[$c]['consulta']='Eliminó';
						$usuario_id=$rs->fields['usuario_id'];		
					$sql="select snombre, sapellido 
				      from usuario where susuario='".$usuario_id."'";
					   $rs1= $acceso1->Execute($sql);
					   $aTabla[$c]['nombre']=$rs1->fields['snombre'];
					   $aTabla[$c]['apellido']=$rs1->fields['sapellido']; 
					   $aTabla[$c]['susuario']=$usuario_id;							
				  
					 $rs->MoveNext();
				   }	
				   $_SESSION['criterio']="Detalle: Actualización de Postulación Oportunidades de Capacitación";				 	
			     $_SESSION['aTabla3'] = $aTabla;		          
		      } 
			  ?><script>document.location="9_2rep_interno_funcionario.php?";</script><?
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
	//		unset($_SESSION['criterio']);
			unset($_SESSION['funcionario']);
	//		unset($_SESSION['aTabla']); unset($_SESSION['aTabla1']); unset($_SESSION['aTabla2']); unset($_SESSION['aTabla3']);
			unset($_SESSION['where']); unset($_SESSION['where1']); unset($_SESSION['where2']);
			unset($_SESSION['q1']);	unset($_SESSION['q2']);	unset($_SESSION['q3']);
			unset($_SESSION['q4']); unset($_SESSION['q5']); unset($_SESSION['q6']);
			unset($_SESSION['q7']); unset($_SESSION['q8']); unset($_SESSION['q9']);
			unset($_SESSION['q10']); unset($_SESSION['q11']); unset($_SESSION['q12']);	
			$_POST['Ced_funcionario']='';
			$_POST['fdesde']='';
			$_POST['fhasta']='';	
		    }	
		else{   
			$aDefaultForm['Ced_funcionario']=$_POST['Ced_funcionario'];
			$aDefaultForm['fdesde']=$_POST['fdesde'];
			$aDefaultForm['fhasta']=$_POST['fhasta'];
			$aDefaultForm['cbAgencia']=$_POST['cbAgencia'];
			unset($_SESSION['aTabla']); unset($_SESSION['aTabla1']); unset($_SESSION['aTabla2']); unset($_SESSION['aTabla3']);
			unset($_SESSION['criterio']);
					
			}
		}
}
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn,$acceso1){           
		    
			$_SESSION['q1']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN personas ON personas.id=trazas.tabla_id 
							   where consulta like 'insert into public.personas%' ".$_SESSION['where1'].""; 
							
			$_SESSION['q2']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN personas ON personas.id=trazas.tabla_id 
			                   where consulta like 'update personas set%' ".$_SESSION['where1']."";
							
			$_SESSION['q3']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN empresa_instituto ON empresa_instituto.id=trazas.tabla_id 
			                   where consulta like 'insert into empresa_instituto%' ".$_SESSION['where2']."";
							
			$_SESSION['q4']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN empresa_instituto ON empresa_instituto.id=trazas.tabla_id 
							   where consulta like 'update empresa_instituto set%' ".$_SESSION['where2']."";
							
			$_SESSION['q5']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN oferta_empleo ON oferta_empleo.id=trazas.tabla_id 
							   INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_empleo.empresa_id 							   
							   inner join ocupacion on ocupacion.cod=oferta_empleo.ocupacion5
							   where consulta like 'insert into oferta_empleo%' ".$_SESSION['where2']."";
			
			$_SESSION['q6']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN oferta_empleo ON oferta_empleo.id=trazas.tabla_id
							   INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_empleo.empresa_id 
							   inner join ocupacion on ocupacion.cod=oferta_empleo.ocupacion5
							   where consulta like 'update oferta_empleo set%' ".$_SESSION['where2']."";
							
			$_SESSION['q7']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN oferta_capacitacion ON oferta_capacitacion.id=trazas.tabla_id
							   INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_capacitacion.empresa_id 
							   inner join ocupacion on ocupacion.cod=oferta_capacitacion.ocupacion5
							   where consulta like 'insert into oferta_capacitacion%' ".$_SESSION['where2']."";
							
			$_SESSION['q8']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN oferta_capacitacion ON oferta_capacitacion.id=trazas.tabla_id
							   INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_capacitacion.empresa_id 
							   inner join ocupacion on ocupacion.cod=oferta_capacitacion.ocupacion5
							   where consulta like 'update oferta_capacitacion set%' ".$_SESSION['where2']."";
							
			$_SESSION['q9']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
							   INNER JOIN persona_oferta_empleo ON persona_oferta_empleo.id=trazas.tabla_id 
							   INNER JOIN personas ON personas.id=persona_oferta_empleo.persona_id 
							   INNER JOIN oferta_empleo ON oferta_empleo.id=persona_oferta_empleo.oferta_id
							   INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_empleo.empresa_id 
							   where consulta like 'insert into public.persona_oferta_empleo%' ".$_SESSION['where1']."";
							
			$_SESSION['q10']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
								INNER JOIN persona_oferta_empleo ON persona_oferta_empleo.id=trazas.tabla_id 
								INNER JOIN personas ON personas.id=persona_oferta_empleo.persona_id 
								INNER JOIN oferta_empleo ON oferta_empleo.id=persona_oferta_empleo.oferta_id
								INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_empleo.empresa_id 
							    where consulta like 'update persona_oferta_empleo set%' ".$_SESSION['where1']."";
							
			$_SESSION['q11']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
								INNER JOIN persona_oferta_capacitacion ON persona_oferta_capacitacion.id=trazas.tabla_id 
								INNER JOIN personas ON personas.id=persona_oferta_capacitacion.persona_id 
								INNER JOIN oferta_capacitacion ON oferta_capacitacion.id=persona_oferta_capacitacion.oferta_id
								INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_capacitacion.empresa_id
							    where consulta like 'insert into public.persona_oferta_capacitacion%' ".$_SESSION['where1']."";
							 
			$_SESSION['q12']= " INNER JOIN modulo ON modulo.id=trazas.modulo 
								INNER JOIN persona_oferta_capacitacion ON persona_oferta_capacitacion.id=trazas.tabla_id 
								INNER JOIN personas ON personas.id=persona_oferta_capacitacion.persona_id 
								INNER JOIN oferta_capacitacion ON oferta_capacitacion.id=persona_oferta_capacitacion.oferta_id
								INNER JOIN empresa_instituto ON empresa_instituto.id=oferta_capacitacion.empresa_id
							    where consulta like 'update persona_oferta_capacitacion set%' ".$_SESSION['where1']."";

//---------------------------------------------------------------------------------------------------------------------------- q1		
 $SQL="select COUNT(*) as trabajadores_reg from trazas ".$_SESSION['q1']." ".$_SESSION['where']." ";
		$rs = $conn->Execute($SQL);			
		if ($rs->RecordCount()>0){	
			$_POST['trabajadores_reg']=$rs->fields['trabajadores_reg'];	}
	  else {$_POST['trabajadores_reg']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q2 
$SQL1="select COUNT(*) as trabajadores_act from trazas ".$_SESSION['q2']." ".$_SESSION['where']."";
		$rs1 = $conn->Execute($SQL1);			
		if ($rs1->RecordCount()>0){	
			$_POST['trabajadores_act']=$rs1->fields['trabajadores_act'];}
	  else {$_POST['trabajadores_act']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q3	  
 $SQL2="select COUNT(*) as empresa_reg from trazas ".$_SESSION['q3']." ".$_SESSION['where']."";
		$rs2 = $conn->Execute($SQL2);			
		if ($rs2->RecordCount()>0){	
			$_POST['empresa_reg']=$rs2->fields['empresa_reg'];}
	  else {$_POST['empresa_reg']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q4	  
 $SQL3="select COUNT(*) as empresa_act from trazas ".$_SESSION['q4']." ".$_SESSION['where']."";
		$rs3 = $conn->Execute($SQL3);			
		if ($rs3->RecordCount()>0){	
			$_POST['empresa_act']=$rs3->fields['empresa_act'];}
	  else {$_POST['empresa_act']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q5
 $SQL4="select COUNT(*) as empleo_reg from trazas ".$_SESSION['q5']." ".$_SESSION['where']."";
		$rs4 = $conn->Execute($SQL4);			
		if ($rs4->RecordCount()>0){	
			$_POST['empleo_reg']=$rs4->fields['empleo_reg'];}
	  else {$_POST['empleo_reg']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q6	  
 $SQL5="select COUNT(*) as empleo_act from trazas ".$_SESSION['q6']." ".$_SESSION['where']."";
		$rs5 = $conn->Execute($SQL5);			
		if ($rs5->RecordCount()>0){	
			$_POST['empleo_act']=$rs5->fields['empleo_act'];}
	  else {$_POST['empleo_act']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q7
 $SQL6="select COUNT(*) as capacitacion_reg from trazas ".$_SESSION['q7']." ".$_SESSION['where']."";
		$rs6 = $conn->Execute($SQL6);			
		if ($rs6->RecordCount()>0){	
			$_POST['capacitacion_reg']=$rs6->fields['capacitacion_reg'];}
	  else {$_POST['capacitacion_reg']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q8	  
 $SQL7="select COUNT(*) as capacitacion_act from trazas ".$_SESSION['q8']." ".$_SESSION['where']."";
		$rs7 = $conn->Execute($SQL7);			
		if ($rs7->RecordCount()>0){	
			$_POST['capacitacion_act']=$rs7->fields['capacitacion_act'];}
	  else {$_POST['capacitacion_act']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q9 
 $SQL8="select COUNT(*) as envio_empleo_reg from trazas ".$_SESSION['q9']." ".$_SESSION['where']."";
		$rs8 = $conn->Execute($SQL8);			
		if ($rs8->RecordCount()>0){	
			$_POST['envio_empleo_reg']=$rs8->fields['envio_empleo_reg'];}
	  else {$_POST['envio_empleo_reg']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q10	  
 $SQL9="select COUNT(*) as envio_empleo_act from trazas ".$_SESSION['q10']." ".$_SESSION['where']."";
		$rs9 = $conn->Execute($SQL9);			
		if ($rs9->RecordCount()>0){	
			$_POST['envio_empleo_act']=$rs9->fields['envio_empleo_act'];}
	  else {$_POST['envio_empleo_act']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q11	  
 $SQL10="select COUNT(*) as envio_capacitacion_reg from trazas ".$_SESSION['q11']." ".$_SESSION['where']."";
		$rs10 = $conn->Execute($SQL10);			
		if ($rs10->RecordCount()>0){	
			$_POST['envio_capacitacion_reg']=$rs10->fields['envio_capacitacion_reg'];}
	  else {$_POST['envio_capacitacion_reg']='0';}
//---------------------------------------------------------------------------------------------------------------------------- q12	  
 $SQL11="select COUNT(*) as envio_capacitacion_act from trazas ".$_SESSION['q12']." ".$_SESSION['where']."";
		$rs11 = $conn->Execute($SQL11);			
		if ($rs11->RecordCount()>0){	
			$_POST['envio_capacitacion_act']=$rs11->fields['envio_capacitacion_act'];}
	  else {$_POST['envio_capacitacion_act']='0';}
//-------------------------------------------------------------------------------------------------------------------------TOTALES	  
$_POST['total_registros']=$_POST['trabajadores_reg']+$_POST['empresa_reg']+$_POST['empleo_reg']+$_POST['capacitacion_reg']+$_POST['envio_empleo_reg']+$_POST['envio_capacitacion_reg'];

$_POST['total_actualizaciones']=$_POST['trabajadores_act']+$_POST['empresa_act']+$_POST['empleo_ract']+$_POST['capacitacion_act']+$_POST['envio_empleo_act']+$_POST['envio_capacitacion_act'];
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 

}
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn, $acceso1, $aDefaultForm){
?>
<style type="text/css">
<!--
.Estilo12 {font-weight: bold}
-->
</style>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">


<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>
          <input name="action" type="hidden" value=""/>
	      <!-- aqui coloca los valores ocultos de la página --> 
	  <tr><td><p>&nbsp;</p>
        <table width="100%" border="0" align="center" class="tablaborde_shadow">
          <tr>
            <td colspan="2" class="titular"><div align="center"><b class="titular">Reporte Interno </b></div></td>
          </tr>
          <tr>
            <td colspan="2" class="dataListColumn2"><div align="center">
              <p class="sub-links-izq">- Detalla el Total de registros y actualizaciones que ha realizado un Funcionario.</p>
              <p class="sub-links-izq">- Para visualizar el detalle  haga click en la Acción Detalle. </p>
            </div></td>
          </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td width="34%"><div align="right"><b>Desde:</b></div></td>
                <td width="66%"><input name="fdesde" type="text" class="tablaborde_shadow" id="fdesde" value="<?=$aDefaultForm['fdesde'];?>" size="12" maxlength="12" readonly />
                <a href="javascript:NewCal('fdesde','yyyymmdd')"><img src="../images/cal.gif" border="0" title="Selecciona la Fecha" /></a> <span class="requerido">*</span></td>
              </tr>
              <tr>
                <td><div align="right"><b>Hasta:</b></div></td>
                <td>
                  <input name="fhasta" type="text" class="tablaborde_shadow" id="fhasta" value="<?=$aDefaultForm['fhasta'];?>" size="12" maxlength="12" readonly />
                    <a href="javascript:NewCal('fhasta','yyyymmdd')"><img src="../images/cal.gif" border="0" title="Selecciona la Fecha" /></a><span class="requerido"> *</span></td>
              </tr>
              <tr>
                <td><div align="right"><b>C&eacute;dula de  Identidad Funcionario(a) Responsable: </b></div></td>
                <td><input name="Ced_funcionario" type="text" class="tablaborde_shadow" id="Ced_funcionario"  onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['Ced_funcionario']?>" size="20" maxlength="20" /></td>
              </tr>
              <tr>
                <td><div align="right"><b>Agencia de Empleo:</b> </div></td>
                <td><select name="cbAgencia" class="tablaborde_shadow" onChange="javascript:send('cbAgencia_changed');">
                  <option value="-1" selected="selected">Seleccione...</option>
                  <? LoadAgencia($acceso1) ; print $GLOBALS['sHtml_cb_Agencia']; ?>
                </select></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><div align="center">
                 <input name="Aceptar" type="submit" class="link-info" id="Aceptar" onClick="javascript:send('Aceptar')" value="Aceptar"/>
                 <input name="Cancelar" type="submit" class="link-info" id="Cancelar" onClick="javascript:send('Cancelar')" value="Cancelar"/>
                </div></td>
              </tr>
              
          <tr>
          <td height="16" colspan="2" class="labelListGlobal">&nbsp;</td></tr>
      </table>
        <table width="58%" border="0" align="center" class="tablaborde_info">
          <tr>
            <td width="57%" class="labelListColumn">Funcionario(a): <?=$_SESSION['funcionario']?></td>
            <td width="11%" class="labelListColumn">Registros</td>
            <td width="14%" class="labelListColumn">Actualizaciones</td>
            <td width="9%" class="labelListColumn">Detalle Registros </td>
            <td width="9%" class="labelListColumn">Detalle Actualizaciones </td>
          </tr>
     <tr>
	 <td class="dataListColumn2"><div align="left">Trabajadores(as) </div></td>
	 <td class=ct_link-clave_activo><?=$_POST['trabajadores_reg']?></td>
	 <td class=ct_link-clave_activo><?=$_POST['trabajadores_act']?></td>
	 <td class="ct_link-clave_activo"><div align="center">
	  <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_reg" onClick="javascript:send('trabajadores_reg')" title="Ver Detalle de Registros de Trabajadores"/>
	 </div></td>	 
	 <td class=ct_link-clave_activo><div align="center">
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_act" onClick="javascript:send('trabajadores_act')" title="Ver Detalle de Actualizaciones de Trabajadores"/>
	 </div></td>
     </tr> 
     <tr>
     <td class="dataListColumn2"><div align="left">Entidades de Trabajo </div></td>
	 <td class=ct_link-clave_activo><?=$_POST['empresa_reg']?></td>
	 <td class=ct_link-clave_activo><?=$_POST['empresa_act']?></td>
     <td class="ct_link-clave_activo"><div align="center">
	  <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_reg" onClick="javascript:send('empresa_reg')" title="Ver Detalle de Registros de Entidades de Trabajo"/>
	 </div></td>	 
	 <td class=ct_link-clave_activo><div align="center">
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_act" onClick="javascript:send('empresa_act')" title="Ver Detalle de Actualizaciones de Entidades de Trabajo"/>
	 </div></td>
     </tr>
	 <tr>
	 <td class="dataListColumn2"><div align="left">Oportunidades de Trabajo </div></td>
	 <td class="ct_link-clave_activo"><?=$_POST['empleo_reg']?></td>
	 <td class="ct_link-clave_activo"><?=$_POST['empleo_act']?></td>
	 <td class="ct_link-clave_activo"><div align="center">
     <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_reg" onClick="javascript:send('empleo_reg')" title="Ver Detalle de Registros de Entidades de Oportunidades de Empleo"/>
	 </div></td> 
	 <td class=ct_link-clave_activo><div align="center">
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_act" onClick="javascript:send('empleo_act')" title="Ver Detalle de Actualizaciones de Oportunidades de Empleo"/>
	 </div></td>
     </tr>
	 <tr>
     <td class="dataListColumn2"><div align="left">Oprotunidades de Capacitación </div></td>
	 <td class="ct_link-clave_activo"><?=$_POST['capacitacion_reg']?></td>
	 <td class="ct_link-clave_activo"><?=$_POST['capacitacion_act']?></td>
	 <td class="ct_link-clave_activo"><div align="center"> 
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_reg" onClick="javascript:send('capacitacion_reg')" title="Ver Detalle de Registros de Entidades de Oportunidades de Capacitación"/> 
	 </div></td>
	 <td class=ct_link-clave_activo><div align="center"> 
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_act" onClick="javascript:send('capacitacion_act')" title="Ver Detalle de Actualizaciones de Oportunidades de Capacitación"/> </div></td>
     </tr>
	 <tr>
	 <td class="dataListColumn2"><div align="left">Postulaciones de Oportunidad de Trabajo </div></td>
	 <td class="ct_link-clave_activo"><?=$_POST['envio_empleo_reg']?></td>
	 <td class="ct_link-clave_activo"><?=$_POST['envio_empleo_act']?></td>
	 <td class="ct_link-clave_activo"><div align="center"> 
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_reg" onClick="javascript:send('envio_empleo_reg')" title="Ver Detalle de Registros de Postulaciones de Oportunidad de Trabajo"/> 
	 </div></td>
	 <td class=ct_link-clave_activo><div align="center"> 
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_act" onClick="javascript:send('envio_empleo_act')" title="Ver Detalle de Actualizaciones de Postulaciones de Oportunidad de Trabajo"/> </div></td>
     </tr>
	 <tr>
	 <td class="dataListColumn2"><div align="left">Postulaciones de Oportunidad de Capacitación </div></td>
	 <td class="ct_link-clave_activo"><?=$_POST['envio_capacitacion_reg']?></td>
	 <td class="ct_link-clave_activo"><?=$_POST['envio_capacitacion_act']?></td>
	 <td class="ct_link-clave_activo"><div align="center">
	<img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_reg" onClick="javascript:send('envio_capacitacion_reg')" title="Ver Detalle de Registros de Postulaciones de Oportunidad de Capacitación"/> 
	 </div></td>
	 <td class=ct_link-clave_activo><div align="center"> 
	 <img src="../images/page_white_magnify.png" width="15" height="16" border="0" id="trabajadores_act" onClick="javascript:send('envio_capacitacion_act')" title="Ver Detalle de Actualizaciones de Postulaciones de Oportunidad de Capacitación"/> </div></td>
     </tr>
           <tr>
             <td class=labelListColumn><div align="left">Totales: </div></td>
             <td class=labelListColumn><div align="left">
               <?=$_POST['total_registros']?>
             </div></td>
             <td class=labelListColumn><?=$_POST['total_actualizaciones']?></td>
             <td class=labelListColumn>&nbsp;</td>
             <td class=labelListColumn>&nbsp;</td>
           </tr>
  </table>
        <p>&nbsp;</p>
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
<?/*
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
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		   
	
		   case 'cbPais_nac_afiliado_changed':
		        LoadData($conn,true);
			break;
			
			case 'cbEstado_nac_afiliado_changed':
			    LoadData($conn,true);
			break;  
			
			case 'cbPais_afiliado_changed':
			    LoadData($conn,true);
			break;
			
			case 'cbEstado_afiliado_changed':
			    LoadData($conn,true);
			break;  
 
			
			case 'Cancelar': 
				LoadData($conn,false);	
			break;
			
			case 'Continuar': 
			$bValidateSuccess=true;	
					
		if ($_POST['nombre_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Nombre: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("([a-z, A-Z])", trim($_POST['nombre_afiliado']))){
				$GLOBALS['aPageErrors'][]= "- El Nombre: es incorrecto.";
				$bValidateSuccess=false;
			    }
			 } 
				 
		if ($_POST['apellido_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Apellido: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("([a-z, A-Z])", trim($_POST['apellido_afiliado']))){
				$GLOBALS['aPageErrors'][]= "- El Apellido: es incorrecto.";
				$bValidateSuccess=false;
			    }
			 }
			  
		if ($_POST['cbSexo_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El Sexo: es requerido.";
				$bValidateSuccess=false;
				 }
				 		if ($_POST['fnacimiento_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La Fecha de naciemiento: es requerida.";
				$bValidateSuccess=false;
				 }
		if  ($_POST['fnacimiento_afiliado']!=''){		
		   		       list($a,$m,$d)=explode("-", $_POST['fnacimiento_afiliado']);
				       $_POST['fnacimiento_afiliado']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
						
						if ($_POST['fnacimiento_afiliado']>="2002-01-01"){
						$GLOBALS['aPageErrors'][]= "- La edad: es incorrecta.";
						$bValidateSuccess=false;
						 }
			   } 
				 		if ($_POST['cbNacionalidad_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- La Nacionalidad: es requerido.";
				$bValidateSuccess=false;
				 }
				 
				 
				 
				 
		if ($_POST['cbEstado_Civil_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Estado Civil: es requerido.";
				$bValidateSuccess=false;
				 }

	   
				 
		if ($_POST['cbPais_nac_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El País de nacimiento: es requerido.";
				$bValidateSuccess=false;
				 }
				 
		if ($_SESSION['tipo_persona']!='P'){
		if ($_POST['cbPais_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El País de residencia: es requerido.";
				$bValidateSuccess=false;
				 }
		if ($_POST['cbEstado_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El Estado de residencia: es requerido.";
				$bValidateSuccess=false;
				 }
		if ($_POST['cbMunicipio_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Municipio de residencia: es requerido.";
				$bValidateSuccess=false;
				 }
		if ($_POST['cbParroquia_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La Parroquia de residencia: es requerida.";
				$bValidateSuccess=false;
				 }
		if ($_POST['sector_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Sector: es requerido.";
				$bValidateSuccess=false;
				 }
		if ($_POST['direccion_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- La Dirección: es requerida.";
				$bValidateSuccess=false;
				 }
			   }
			   				 		
		if ($_POST['telefono_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Teléfono: es requerido.";
				$bValidateSuccess=false;
				 }	   
		if ($_POST['email_afiliado']==""){
				$GLOBALS['aPageErrors'][]= "- El Correo Electrónico: es requerido.";
				$bValidateSuccess=false;
				 }
		else {
				if(!ereg("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$_POST['email_afiliado'])){
				$GLOBALS['aPageErrors'][]= "- El formato de Correo electrónico : es incorrecto.";
				$bValidateSuccess=false;
			    }
			 }
			 
	     if ($_POST['cbDiscapacidad_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Posee discapacidad: es requerido.";
				$bValidateSuccess=false;
				 }
		 if ($_POST['cbJefe_familia']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Es Jefe de Hogar: es requerido.";
				$bValidateSuccess=false;
				 }
		if ($_POST['cbHijos']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Tiene hijos: es requerido.";
				$bValidateSuccess=false;
				 } 
		if ($_POST['cbHijos']=="1"){
				if ($_POST['hijos_menores']=="" and $_POST['hijos_mayores']==""){
				$GLOBALS['aPageErrors'][]= "- Cantidad de hijos: es requerido."; 
				$bValidateSuccess=false;
				 }
				if ($_POST['hijos_menores']==0 and $_POST['hijos_mayores']==0){
				$GLOBALS['aPageErrors'][]= "- Cantidad de hijos: es requerido."; 
				$bValidateSuccess=false;
				 }	
			} 
				 
		if ($_POST['ingreso_familiar']==""){
				$GLOBALS['aPageErrors'][]= "- Ingreso Familiar Mensual: es requerido."; 
				$bValidateSuccess=false;
				 }
		if ($_POST['cbVehiculo_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Posee Vehiculo: es requerido."; 
				$bValidateSuccess=false;
				 }	
				 
			if ($_POST['cbmision_beneficio_educacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Ha sido beneficiario de las misiones de educacion?: es requerido.";
					$bValidateSuccess=false;
					 }	 	 
			if ($_POST['cbmision_beneficio_educacion']=="1"){
					if ($_POST['cbMisiones_Educacion']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La mision educacion: es requerida.";
					$bValidateSuccess=false;
					 }
				}
			else{
				if ($_POST['cbMisiones_Educacion']="-1"){
					 }
				}
				
			if ($_POST['cbmision_beneficio_social']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Ha sido beneficiario de las misiones sociales?: es requerido.";
					$bValidateSuccess=false;
					 }	 	 
			if ($_POST['cbmision_beneficio_social']=="1"){
					if ($_POST['cbMisiones_social']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La mision social: es requerida.";
					$bValidateSuccess=false;
					 }
				}
			else{
				if ($_POST['cbMisiones_social']="-1"){
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

//------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
//datos personales
			  	$aDefaultForm['nombre_afiliado']='';
					$aDefaultForm['apellido_afiliado']='';
					$aDefaultForm['cbSexo_afiliado']='-1';
					$aDefaultForm['fnacimiento_afiliado']='';
					$aDefaultForm['edad']='';
					$aDefaultForm['cbPais_nac_afiliado']='-1';
					$aDefaultForm['cbEstado_nac_afiliado']='-1';
					$aDefaultForm['cbNacionalidad_afiliado']='-1';
					$aDefaultForm['cbEstado_Civil_afiliado']='-1';
					$aDefaultForm['cbPais_afiliado']='-1';
					$aDefaultForm['cbEstado_afiliado']='-1';
					$aDefaultForm['cbMunicipio_afiliado']='-1';
					$aDefaultForm['cbParroquia_afiliado']='-1';
					$aDefaultForm['sector_afiliado']='';
					$aDefaultForm['direccion_afiliado']='';
					$aDefaultForm['telefono_afiliado']='';
					$aDefaultForm['otro_telefono_afiliado']='';
					$aDefaultForm['email_afiliado']='';
					$aDefaultForm['cbVehiculo_afiliado']='-1';
					$aDefaultForm['observacion_datos_per']=''; 
					$aDefaultForm['cbDiscapacidad_afiliado']='-1';
					$aDefaultForm['cbJefe_familia']='-1';  
					$aDefaultForm['cbHijos']='-1'; 
					$aDefaultForm['ingreso_familiar']=''; 
					$aDefaultForm['hijos_menores']='';
					$aDefaultForm['hijos_mayores']='';
					$aDefaultForm['cbMisiones_Educacion']='-1'; 
					$aDefaultForm['cbmision_beneficio_educacion']='-1'; 
					$aDefaultForm['cbMisiones_social']='-1'; 
					$aDefaultForm['cbmision_beneficio_social']='-1'; 
				
		 ///REVISARRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
				 if (isset($_SESSION['registro'])){
						 unset($_SESSION['registro']);
			   
			  		$SQL="select * From public.personas where cedula='".$_SESSION['ced_afiliado']."'";
					  $rs1 = $conn->Execute($SQL);
					  if ($rs1->RecordCount()>0){ 				
						 $_SESSION['id_afiliado']=$rs1->fields['id']; 
					  }	
   }
        
	if (!$bPostBack){
			/// AQUI VALIDA EL ID TRABAJADOR CUANDO VIENE DE CONSULTA
	      if ($_GET['id_po']!='') $_SESSION['id_afiliado']=$_GET['id_po'];	
			  if ($_GET['ced']!='') $_SESSION['ced_afiliado']=$_GET['ced'];
					
	$SQL="select * From public.personas where id='".$_SESSION['id_afiliado']."'";
		 $rs1 = $conn->Execute($SQL);
		 if ($rs1->RecordCount()>0){ 	
			 $_SESSION['id_afiliado']=$rs1->fields['id'];
			 $_SESSION['ced_afiliado']=$rs1->fields['cedula'];	
			$aDefaultForm['nombre_afiliado']=$rs1->fields['nombres'];
			$aDefaultForm['apellido_afiliado']=$rs1->fields['apellidos'];
			$aDefaultForm['cbSexo_afiliado']=$rs1->fields['sexo'];
			$aDefaultForm['fnacimiento_afiliado']=strftime("%d-%m-%Y", strtotime($rs1->fields['f_nacimiento']));
			$fnacimiento_afiliado=$rs1->fields['f_nacimiento'];
			$dia=date(j); $mes=date(n); $ano=date(Y);
				//fecha de nacimiento	y edad
				list($anonaz,$mesnaz,$dianaz)=explode("-", $fnacimiento_afiliado);				
				if (($mesnaz == $mes) && ($dianaz > $dia)) {
				    $ano=($ano-1); 
				    }
				if ($mesnaz > $mes) {
				    $ano=($ano-1);
				    }
 			$aDefaultForm['edad']=($ano-$anonaz);					
			$aDefaultForm['cbPais_nac_afiliado']=$rs1->fields['pais_nacimiento_id'];	
			$Nacionalidad=$rs1->fields['nacionalidad'];	
			if($Nacionalidad==1) $aDefaultForm['cbNacionalidad_afiliado']='Venezolano';	
			if($Nacionalidad==2) $aDefaultForm['cbNacionalidad_afiliado']='Extranjero';	
			$aDefaultForm['cbEstado_Civil_afiliado']=$rs1->fields['estado_civil_id'];
			$aDefaultForm['cbPais_afiliado']=$rs1->fields['pais_residencia_id'];
			$aDefaultForm['sector_afiliado']=$rs1->fields['sector'];
			$aDefaultForm['direccion_afiliado']=$rs1->fields['direccion'];
			$aDefaultForm['telefono_afiliado']=$rs1->fields['telefono'];
			$aDefaultForm['otro_telefono_afiliado']=$rs1->fields['otro_telefono'];
			$aDefaultForm['email_afiliado']=$rs1->fields['correo'];
			$aDefaultForm['cbVehiculo_afiliado']=$rs1->fields['tipo_vehiculo_id'];
			$aDefaultForm['observacion_datos_per']=$rs1->fields['observaciones']; 
			$aDefaultForm['cbDiscapacidad_afiliado']=$rs1->fields['discapacidad'];
			$aDefaultForm['cbJefe_familia']=$rs1->fields['jefe_fam']; 
			$aDefaultForm['cbHijos']=$rs1->fields['hijos'];
			$aDefaultForm['ingreso_familiar']=$rs1->fields['ingreso_fam'];
			$aDefaultForm['hijos_menores']=$rs1->fields['hijos_menores'];
			$aDefaultForm['hijos_mayores']=$rs1->fields['hijos_mayores'];	
			$aDefaultForm['cbmision_beneficio_educacion']=$rs1->fields['mision_educacion_beneficio'];
			$aDefaultForm['cbMisiones_Educacion']=$rs1->fields['mision_educacion_id'];		
			$aDefaultForm['cbmision_beneficio_social']=$rs1->fields['mision_social_beneficio'];
			$aDefaultForm['cbMisiones_social']=$rs1->fields['mision_social_id'];
			$_SESSION['sesiones']=$rs1->fields['sesiones'];
			//$_SESSION['usuario']=($aDefaultForm['nombre_afiliado'].' '.$aDefaultForm['apellido_afiliado'].'  '.'CI: '.$_SESSION['ced_afiliado']);   
			//bloqueo modulo migracion
			if($rs1->fields['estado_nacimiento_id']==$rs1->fields['estado_residencia']){ $_SESSION['migra_bloq']=1; }
			else{ unset($_SESSION['migra_bloq']);}
			if ($_SESSION['tipo_persona']=='P' or $_SESSION['tipo_persona']=='E'){ unset($_SESSION['migra_bloq']); }
				
			//bloqueo modulo dicapacidad
			if($rs1->fields['discapacidad']==0){ $_SESSION['disc_bloq']=1; }
			else{ unset($_SESSION['disc_bloq']);}	
			
			?>	
			<script language="javascript" src="../js/jquery.js"></script>
			<script>
		    $(document).ready(function(){
			elegido="<?php echo $rs1->fields['pais_nacimiento_id']; ?>";
			combo="Estado_nac";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_nacimiento_id']; ?>" }, 
			function(data){ $("#cbEstado_nac_afiliado").html(data);
				 });            
			});
			
			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['pais_residencia_id']; ?>";
			combo="Estado";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_residencia']; ?>" }, 
			function(data){ $("#cbEstado_afiliado").html(data);
				 });            
			});
				
			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['estado_residencia']; ?>";
			combo="Municipio";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['municipio_id']; ?>" }, 
			function(data){ $("#cbMunicipio_afiliado").html(data);
				 });            
			});
				
			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['municipio_id']; ?>";
			combo="Parroquia";
			$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['parroquia_id']; ?>" },
			function(data){  $("#cbParroquia_afiliado").html(data);
				 });            
			});
			</script>
			<?php
							
		   //verifica la ultima actualizacion del registro	 
	       $sql1="select modulo.nombre  as modulo, trazas.fecha
					  from trazas  
					  INNER JOIN modulo ON modulo.id=trazas.modulo
					  where tabla_id='".$_SESSION['id_afiliado']."' 
					  and identi='".$_SESSION['ced_afiliado']."' order by fecha desc  limit 1";
			   $rs1= $conn->Execute($sql1);
			   if ($rs1->RecordCount()>0){
					$_POST['fecha']=strftime("%d/%m/%Y", strtotime($rs1->fields['fecha']));
					$_POST['modulo']=$rs1->fields['modulo'];	 
					} 
				  }
				}	
		else{   
					$aDefaultForm['nombre_afiliado']=$_POST['nombre_afiliado'];
					$aDefaultForm['apellido_afiliado']=$_POST['apellido_afiliado'];
					$aDefaultForm['cbSexo_afiliado']=$_POST['cbSexo_afiliado'];
					$aDefaultForm['fnacimiento_afiliado']=$_POST['fnacimiento_afiliado']; 
					$aDefaultForm['edad']=$_POST['edad']; 
					$aDefaultForm['cbPais_nac_afiliado']=$_POST['cbPais_nac_afiliado'];
					$aDefaultForm['cbNacionalidad_afiliado']=$_POST['cbNacionalidad_afiliado']; 
					$aDefaultForm['cbEstado_Civil_afiliado']=$_POST['cbEstado_Civil_afiliado']; 
					$aDefaultForm['cbPais_afiliado']=$_POST['cbPais_afiliado'];
					$aDefaultForm['sector_afiliado']=$_POST['sector_afiliado'];
					$aDefaultForm['direccion_afiliado']=$_POST['direccion_afiliado'];
					$aDefaultForm['telefono_afiliado']=$_POST['telefono_afiliado'];
					$aDefaultForm['otro_telefono_afiliado']=$_POST['otro_telefono_afiliado'];
					$aDefaultForm['email_afiliado']=$_POST['email_afiliado'];
					$aDefaultForm['cbVehiculo_afiliado']=$_POST['cbVehiculo_afiliado'];
					$aDefaultForm['observacion_datos_per']=$_POST['observacion_datos_per']; 
					$aDefaultForm['cbDiscapacidad_afiliado']=$_POST['cbDiscapacidad_afiliado'];
					$aDefaultForm['cbJefe_familia']=$_POST['cbJefe_familia']; 
					$aDefaultForm['cbHijos']=$_POST['cbHijos'];
					$aDefaultForm['ingreso_familiar']=$_POST['ingreso_familiar'];
					$aDefaultForm['hijos_menores']=$_POST['hijos_menores'];
					$aDefaultForm['hijos_mayores']=$_POST['hijos_mayores'];
					$aDefaultForm['cbmision_beneficio_educacion']=$_POST['cbmision_beneficio_educacion']; 
					$aDefaultForm['cbMisiones_Educacion']=$_POST['cbMisiones_Educacion'];
					$aDefaultForm['cbmision_beneficio_social']=$_POST['cbmision_beneficio_social']; 
					$aDefaultForm['cbMisiones_social']=$_POST['cbMisiones_social'];
					
				?>	
				<script language="javascript" src="../js/jquery.js">
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbPais_nac_afiliado']; ?>";
				combo="Estado_nac";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbEstado_nac_afiliado']; ?>" }, 
				function(data){ $("#cbEstado_nac_afiliado").html(data);
				});            
				});
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbPais_afiliado']; ?>";
				combo="Estado";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbEstado_afiliado']; ?>" }, 
				function(data){ $("#cbEstado_afiliado").html(data);
				});            
				});
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbEstado_afiliado']; ?>";
				combo="Municipio";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbMunicipio_afiliado']; ?>" }, 
				function(data){ $("#cbMunicipio_afiliado").html(data);
				});            
				});
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbMunicipio_afiliado']; ?>";
				combo="Parroquia";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbParroquia_afiliado']; ?>" },
				function(data){  $("#cbParroquia_afiliado").html(data);
				});            
				});
				</script>
				<?php
					
		}
	}
} 
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');
			if($_POST['cbEstado_nac_afiliado']==$_POST['cbEstado_afiliado']){
			   $migrante=0;
	   		}
			else{
				$migrante=1;
			}

		if ($_SESSION['tipo_persona']=='P'){
		$_POST['cbPais_afiliado']='-1';
		$_POST['cbEstado_afiliado']='-1';
		$_POST['cbMunicipio_afiliado']='-1';
		$_POST['cbParroquia_afiliado']='-1';
		$_POST['sector_afiliado']='NO POSEE';
		$_POST['direccion_afiliado']='NO POSEE';
		}
		
		if($_POST['cbHijos']=='0'){
			 $_POST['hijos_menores']=0;
			 $_POST['hijos_mayores']=0;			
			}
		
		$sql="update personas set   
				  pais_nacimiento_id = '".$_POST['cbPais_nac_afiliado']."',
				  estado_nacimiento_id = '".$_POST['cbEstado_nac_afiliado']."',						  
				  estado_civil_id = '".$_POST['cbEstado_Civil_afiliado']."',
				  pais_residencia_id = '".$_POST['cbPais_afiliado']."',
				  estado_residencia = '".$_POST['cbEstado_afiliado']."',
				  municipio_id = '".$_POST['cbMunicipio_afiliado']."',
				  parroquia_id = '".$_POST['cbParroquia_afiliado']."',
				  sector = '".$_POST['sector_afiliado']."',
				  direccion = '".$_POST['direccion_afiliado']."',				  
				  telefono = '".$_POST['telefono_afiliado']."',
				  otro_telefono = '".$_POST['otro_telefono_afiliado']."',
				  correo = '".$_POST['email_afiliado']."',
				  tipo_vehiculo_id = '".$_POST['cbVehiculo_afiliado']."',
				  discapacidad = '".$_POST['cbDiscapacidad_afiliado']."',
				  jefe_fam = '".$_POST['cbJefe_familia']."',
					hijos= '".$_POST['cbHijos']."',
					hijos_menores = '".$_POST['hijos_menores']."', 
					hijos_mayores = '".$_POST['hijos_mayores']."', 
				  ingreso_fam = '".$_POST['ingreso_familiar']."', 
				  migrante =  '".$migrante."',
					mision_educacion_beneficio='".$_POST['cbmision_beneficio_educacion']."', 
					mision_educacion_id='".$_POST['cbMisiones_Educacion']."',
					mision_social_beneficio='".$_POST['cbmision_beneficio_social']."', 
					mision_social_id='".$_POST['cbMisiones_social']."',
				  observaciones = '".$_POST['observacion_datos_per']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update = '".$_SESSION['sUsuario']."'
				  WHERE cedula='".$_SESSION['ced_afiliado']."'"; 	
			  	$conn->Execute($sql);				  
				 // $_SESSION['usuario']=($_POST['nombre_afiliado'].' '.$_POST['apellido_afiliado'].'  '.'CI: '.$_SESSION['ced_afiliado']);
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='1';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
//------------------------------------------------------------------------------------------------------------------				

			//sesiones curriculum
				$nNumSeccion = 1;
				$sSQL = "SELECT sesiones FROM personas where id = ".$_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);
				if ($rs){
				if ($rs->RecordCount() > 0){
				$rs->fields['sesiones'][$nNumSeccion-1] = 1;
				$sSQL = "update personas set sesiones = '".$rs->fields['sesiones']."' where id = ".$_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);			
					}
				}
						 
			//mod_migrante
			if($_POST['cbEstado_nac_afiliado']==$_POST['cbEstado_afiliado']){
			    $id_migrante='';			   
                $sSQL = "SELECT id FROM persona_migrante where persona_id = ".$_SESSION['id_afiliado'];
				$rs = $conn->Execute($sSQL);
				if ($rs->RecordCount() > 0){
				    $id_migrante=$rs->fields['id']; 
			   	    }		 
				if ($id_migrante!=''){	
					$sql="delete  from persona_migrante 
					where id='".$id_migrante."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
					$rs1= $conn->Execute($sql);	
					//Trazas---			
					$id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='1';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);
				   }
			       $_SESSION['migra_bloq']=1; 
			    }			   
			else{
			    unset($_SESSION['migra_bloq']);
				}
		    if ($_SESSION['tipo_persona']=='P' or $_SESSION['tipo_persona']=='E'){
				unset($_SESSION['migra_bloq']);
			}
				
			//mod_dicapacidad
			if($_POST['cbDiscapacidad_afiliado']==0){
			   $_SESSION['disc_bloq']=1;
			   }
			else{
			    unset($_SESSION['disc_bloq']);
				}	
				
			if($_SESSION['tipo_usuario']==2){
						
   		if($_SESSION['migra_bloq']==1){
			   if ($_SESSION['disc_bloq']==1){
			   	  ?><script>document.location='1_4agen_trab_ocupacion.php'</script><? 
				   }
				else{
			       ?><script>document.location='1_3agen_trab_discapacidad.php'</script><? 
				   }
	   		}
			else{
				?><script>document.location='1_2agen_trab_migrante.php'</script><? 
				}			
			
			
			}
			else{
				?><script>document.location='1_4agen_trab_ocupacion.php'</script><? 
				}
				
				
				
	}

//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('header.php'); 
 ?>
 <!-- Select2 -->
  <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../AdminLTE-3.1.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <?php
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){*/
?>
<!--form name="frm_trabajador" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >

<script>

//Estado nacimiento
$(document).ready(function(){
   $("#cbPais_nac_afiliado").change(function () {
           $("#cbPais_nac_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Estado_nac';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbEstado_nac_afiliado").html(data);
            });            
        });
   })
});

//Estado Residencia
$(document).ready(function(){
   $("#cbPais_afiliado").change(function () {
           $("#cbPais_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Estado';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbEstado_afiliado").html(data);
            });            
        });
   })
});
//Municipio---Parroquia residencia
$(document).ready(function(){
   $("#cbEstado_afiliado").change(function () {
           $("#cbEstado_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Municipio';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbMunicipio_afiliado").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbMunicipio_afiliado").change(function () {
           $("#cbMunicipio_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Parroquia';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbParroquia_afiliado").html(data);
            });            
        });
   })
});

function send(saction){
	       if(saction=='Continuar'){
		   			if(validar_frm_trabajador()==true){
					var form = document.frm_trabajador;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_trabajador;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script-->

<?php
	include("header.php");
?>
	<!-- Content Wrapper. Contains page content -->
	<!--<div class="content-wrapper">-->
		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<!-- Horizontal Form -->
				<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Datos Personales</h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form class="form-horizontal">
					<!--<div class="card-body">
						<div class="form-group row" >
						  <div class="col-sm-6">
							<label class="text-secondary" >Nombre(s) y Apellido(s)</label>
						  </div>	
						  <div class="col-sm-4">
							<label class="text-secondary" >Cédula de Identidad</label>
						  </div>
						</div>							
                    </div>-->
					<!--
					<div class="form-group row" >					
							<div class="col-sm-6">
							<input class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?=$aDefaultForm['nombre_afiliado'].' '.$aDefaultForm['apellido_afiliado']?>" disabled>
							</div>
						 	<div class="col-sm-4">
							<input class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?=$_SESSION['ced_afiliado']?>" disabled>
							</div>	
					   </div>	-->
					
					<div class="card-body">
						<div class="form-group row" >

							<!-- Columna 1 Izquierda -->

							<div class="col-sm-6 ">
								<div class="col-sm-12">
									<label class="text-secondary">Nacionalidad</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<input style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3" value="<?=$aDefaultForm['cbNacionalidad_afiliado']?>" disabled>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Fecha de Nacimiento</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fa fa-calendar"></samp>
										</div>
										<input style="border-radius: 0 15px 15px 0"" class="form-control  form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?=$aDefaultForm['fnacimiento_afiliado']?>" disabled>
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Sexo</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<select style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3">
										<option>Seleccione...</option>
										<option value="<? if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';?>"> Femenino</option>
										<option value="<? if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';?>">masculino</option>	
									</select>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Teléfono Personal *</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fas fa-phone-alt"></samp>
										</div>
										<input name="telefono_afiliado" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_afiliado']?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="number">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Correo Electrónico *</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fas fa-envelope"></samp>
										</div>
										<input name="email_afiliado" id="email_afiliado" value="<?=$aDefaultForm['email_afiliado']?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="email"></div>
									</div>
									<div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px">¿Posee Redes Sociales?</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<select style="border-radius: 15px" class=" form-control form-control-sm select2">
											<option></option>
											<option value="">Si</option>
											<option value="">No</option>
										</select>
									</div>
									<div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px">Twitter</label>
										<div class="input-group">
											<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
												<samp class="icon-twitter"></samp>
											</div>
											<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
										</div>
									</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Telegram</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Otro</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">¿Tiene Hijos? *</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<select name="cbHijos" id="cbHijos" style="border-radius: 15px;" class=" form-control form-control-sm select2">
											<option value="-1" selected="selected">Seleccione</option>
											<option value="1" <? if (($aDefaultForm['cbHijos'])=='1') print 'selected="selected"';?>>Si</option>
											<option value="0" <? if (($aDefaultForm['cbHijos'])=='0') print 'selected="selected"';?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">¿Cuantos Mayores de 18?</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<input name="hijos_mayores" type="text" class=" form-control form-control-sm select2" style="border-radius: 15px;" id="hijos_mayores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_mayores']?>" size="5" maxlength="2">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">¿Posee Carnet de la patria? *</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<select class=" form-control form-control-sm select2" style="border-radius: 15px;">
											<option></option>
											<option value="">Si</option>
											<option value="">No</option>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Serial del Carnet de la Patria</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fas fa-barcode"></samp>
										</div>
										<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
							</div>

						<!-- Columna 2 Derecha -->

							<div class="col-sm-6">
								<div class="col-sm-12">
									<label class="text-secondary" >Estado de Nacimiento *</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<select style="border-radius: 15px;" name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" class=" form-control form-control-sm select2" title="Estado de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado" disabled>
										<option value="-1">Seleccionar</option>
									</select>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">País de Nacimiento *</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<select style="border-radius: 15px;" name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" class=" form-control form-control-sm select2" title="Estado de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado" disabled>
										<option value="-1">Seleccionar</option>
									</select>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Edad</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<input style="border-radius: 15px;" class="form-control form-control-sm" type="number" id="inputEmail3" placeholder="Nombre y Apellido" value="<?=$aDefaultForm['edad']?>">	
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Estado Civil</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<select style="border-radius: 15px;" name="cbEstado_Civil_afiliado" class=" form-control form-control-sm select2" id="cbEstado_Civil_afiliado" title="Estado Civil - Seleccione s&oacute;lo una opci&oacute;n del listado">
										<option value="-1" selected="selected">Seleccione...</option>
										<? /*LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; */?>
									</select>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Teléfono de Habitación</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fas fa-phone-alt"></samp>
										</div>
										<input name="otro_telefono_afiliado" id="otro_telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_afiliado']?>" style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="number">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Facebook</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fab fa-facebook-f"></samp>
										</div>
										<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Instagram</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fab fa-instagram"></samp>
										</div>
										<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Tik Tok</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">¿Es Jefe de Hogar? *</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<select name="cbJefe_familia" id="cbJefe_familia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
											<option value="-1" selected="selected">Seleccione</option>
											<option value="1" <? if (($aDefaultForm['cbJefe_familia'])=='1') print 'selected="selected"';?>>Si</option>
											<option value="0" <? if (($aDefaultForm['cbJefe_familia'])=='0') print 'selected="selected"';?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">¿Cuantos Menores de 18? *</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<input name="hijos_menores" type="number" style="border-radius: 15px;" class=" form-control form-control-sm select2" id="hijos_menores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_menores']?>" size="5" maxlength="2">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">¿Tiene Vehículos?</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
										<select name="cbVehiculo_afiliado" id="cbVehiculo_afiliado" style="border-radius: 15px;" class=" form-control form-control-sm select2">
											<option value="-1" selected="selected">Seleccione...</option>
											<? /*LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];*/?>
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<label class="text-secondary" style="margin-top: 10px">Código del Carnet de la Patria</label>
									<div class="input-group">
										<div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
											<samp class="fas fa-barcode"></samp>
										</div>
										<input style="border-radius: 0 15px 15px 0;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
							</div>
						<!-- Tabla bootstrap 4
							div class="col-sm-2">
							<center><label class="text-secondary" >Nacionalidad</label></center>
						  </div>	
						  <div class="col-sm-4">
							<input style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?=$aDefaultForm['cbNacionalidad_afiliado']?>" disabled>
						  </div>
						  <div class="col-sm-2">
							<center><label class="text-secondary" >Estado de Nacimiento</label></center>
						  </div>	
						  <div class="col-sm-4">
							<select style="border-radius: 15px;" name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" class=" form-control form-control-sm select2" title="Estado de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado" disabled>
							<option value="-1">Seleccionar</option>
							</select>
						  </div>
						  <div class="col-sm-2">
							<center><label class="text-secondary" >Sexo</label></center>
						  </div>
						  <div class="col-sm-4">
							<select style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3">
								<option>Seleccione...</option>
								<option value="<?/* if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';?>"> Femenino</option>
								<option value="<? if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';*/?>">masculino</option>	
							</select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Fecha de Nacimiento</label></center>
						   </div>
						   <div class="col-sm-4">
							<input style="border-radius: 15px;" class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<?=$aDefaultForm['fnacimiento_afiliado']?>" disabled>				
							</div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Edad</label></center>
						   </div>
						   <div class="col-sm-4">
							<input style="border-radius: 15px;" class="form-control form-control-sm" type="number" id="inputEmail3" placeholder="Nombre y Apellido" value="<?=$aDefaultForm['edad']?>">				
							</div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Estado Civil</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<select style="border-radius: 15px;" name="cbEstado_Civil_afiliado" class=" form-control form-control-sm select2" id="cbEstado_Civil_afiliado" title="Estado Civil - Seleccione s&oacute;lo una opci&oacute;n del listado">
							<option value="-1" selected="selected">Seleccione...</option>
							<?/* LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; */?>
							</select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Teléfono Personal</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input name="telefono_afiliado" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?/*=$aDefaultForm['telefono_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="number">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Teléfono de Habitación</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input name="otro_telefono_afiliado" id="otro_telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="number">
						   </div>
						   <div class="col-sm-2">
							<center><label class="text-secondary">Correo Electrónico</label></center>
						   </div>
						   <div class="col-sm-4">
						   <input name="email_afiliado" id="email_afiliado" value="<?/*=$aDefaultForm['email_afiliado']*/?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="email"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Posee Redes Sociales?</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<select style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option></option>
								<option value="">Si</option>
								<option value="">No</option>
							</select>
						   </div>
						   <div class="col-sm-4">
						   	<center><label class="text-secondary">Facebook</label></center>
						   </div>
						   <div class="col-sm-8" style="height:20px"></div>
						   <div class="col-dm-1" style="width: 30px"></div>
						   <div style="whidth: 50px; height:31px; border: 1px solid #CCCCCC; padding: 5px 10px; left:20px; border-radius: 3px 0 0 3px; position: absolute; top: 374px; z-index:1" class="col-dm-1">
						   	<div class="fab fa-facebook-f"></div>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 3px;%" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Instagram</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Twitter</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Es Jefe de Familia?</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<select name="cbJefe_familia" id="cbJefe_familia" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option value="-1" selected="selected">Seleccione</option>
								<option value="1" <?/* if (($aDefaultForm['cbJefe_familia'])=='1') print 'selected="selected"';?>>Si</option>
								<option value="0" <? if (($aDefaultForm['cbJefe_familia'])=='0') print 'selected="selected"';?>>No</option>
							</select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Tiene Hijos?</label></center>
						   </div>
						   <div class="col-sm-4">
						    <select name="cbHijos" id="cbHijos" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option value="-1" selected="selected">Seleccione</option>
				<option value="1" <? if (($aDefaultForm['cbHijos'])=='1') print 'selected="selected"';?>>Si</option>
				<option value="0" <? if (($aDefaultForm['cbHijos'])=='0') print 'selected="selected"';?>>No</option>
							 </select>
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Tiene Vehículos?</label></center>
						   </div>
						   <div class="col-sm-4">
						    <select name="cbVehiculo_afiliado" id="cbVehiculo_afiliado" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option value="-1" selected="selected">Seleccione...</option>
								<? LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];*/?>
							 </select>
						   </div>
						   <div style="height:20px" class="col-sm-12"></div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Ingreso Familiar Mensual(Bs.)</label></center>
						   </div>
						   <div class="col-sm-4">
						    <input name="ingreso_familiar" type="number" class=" form-control form-control-sm select2" style="border-radius: 15px;" id="ingreso_familiar" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['ingreso_familiar']?>" size="20" maxlength="8">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">¿Posee Carnert de la Patria?</label></center>
						   </div>
						   <div class="col-sm-4">
						    <select style="border-radius: 15px;" class=" form-control form-control-sm select2">
								<option></option>
								<option value="">Si</option>
								<option value="">No</option>
							 </select>
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Código del Carnet de la Patria</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>
						   <div class="col-sm-2">
						   	<center><label class="text-secondary">Serial del Carnet de la Patria</label></center>
						   </div>
						   <div class="col-sm-4">
						   	<input style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
						   </div>-->	
						</div>						
                    </div>
					
					<!--<div class="form-group row" >					
							
						 		
					   </div>
					
					
					
					
					-->
				<!--<div class="card-body">   
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Cédula de Identidad</label>
						   <label class="text-secondary">Sexo</label>							
							<div class="col-sm-10">
							<input class="form-control form-control-sm" type="text" id="inputEmail3" placeholder="Nombre y Apellido" value="<? /*if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';
				if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';*/?>" disabled>				
							</div>
						</div>-->
						
                    <!--div class="form-group row">
											<label for="inputEmail3" class="col-sm-2 col-form-label">Cédula de Identidad</label>-->
						   							
							
						<!--/div>
						
						<div class="form-group row">
													<label for="inputEmail3" class="col-sm-2 col-form-label">Cédula de Identidad</label>-->
						   							
							
						<!--</div>
						
						
						<div class="form-group row">
									<label for="inputEmail3" class="col-sm-2 col-form-label">Estado Civil</label>-->
									
									<!--<div class="col-sm-10">
										<select name="cbEstado_Civil_afiliado" class=" form-control form-control-sm select2" id="cbEstado_Civil_afiliado" title="Estado Civil - Seleccione s&oacute;lo una opci&oacute;n del listado">
										<option value="-1" selected="selected">Seleccione...</option>
										<?/* LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; */?>
										</select>
									</div>
						</div>-->
						<!-- /.form-group -->

						<!--<div class="form-group row">
							<div class="offset-sm-2 col-sm-10">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="exampleCheck2">
									<label class="form-check-label" for="exampleCheck2">Remember me</label>
								</div>
							</div>
					 /.card-body -->
					<!--<div class="card-footer">
					<button type="submit" class="btn btn-info">Sign in</button>
					<button type="submit" class="btn btn-default float-right">Cancel</button>
					</div>-->
					<!-- /.card-footer -->
				</form>
				</div>
				<!-- /.card -->
			</div>
    	<!-- /.content -->
		<!-- Main content -->
		<section class="content">
				<div class="container-fluid">
					

					<!-- Sección 2 -->
					<div class="card card-info">
						<!-- Card Header -->
						<div class="card-header">
							<h3 class="card-title">Direccion de Habitación</h3>
						</div>
						<!-- /.card-Body -->
						<div class="card-body">
							<div class="form-group row" >

								<!-- Columna 1 Izquierda -->

								<div class="col-sm-6 ">
									<div class="col-sm-12">
										<label class="text-secondary">País de Residencia *</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbPais_afiliado" id="cbPais_afiliado">
											<option value="-1" selected="selected">Seleccione...</option>
											<? /*LoadPais_nac_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_nac_afiliado']; */?>
										</select>
									</div>
									<div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;">Municipio *</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbMunicipio_afiliado" id="cbMunicipio_afiliado">
											<option value="-1">Seleccionar</option>
										</select>
									</div>
									<div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;">Sector</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<input name="sector_afiliado" id="sector_afiliado" value="<?=$aDefaultForm['sector_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2">
									</div>
								</div>

								<!-- Columna 2 Derecha -->

								<div class="col-sm-6 ">
									<div class="col-sm-12">
										<label class="text-secondary">Estado *</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbEstado_afiliado" id="cbEstado_afiliado">
											<option value="-1">Seleccionar</option>
										</select>
									</div>
									<div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;">Parroquia *</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbParroquia_afiliado" id="cbParroquia_afiliado">
											<option value="-1">Seleccionar</option>
										</select>
									</div>
									<div class="col-sm-12">
										<label class="text-secondary" style="margin-top: 10px;">Dirección</label>
										<div class="input-group">
											<div class="input-group-addon">
												<samp></samp>
											</div>
										</div>
										<input name="direccion_afiliado" id="direccion_afiliado" value="<?=$aDefaultForm['direccion_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
									</div>
								</div>
								<div class="col-sm-12 ">
									<label class="text-secondary" style="margin-top: 10px;">Punto de Referencia</label>
									<div class="input-group">
										<div class="input-group-addon">
											<samp></samp>
										</div>
									</div>
									<textarea class="form-control" id="observacion_datos_per" value="<?=$aDefaultForm['observacion_datos_per']?>"></textarea>
								</div>
								<!--div class="col-sm-2">
								<div class="col-sm-2">
								 <center><label class="text-secondary">País de Residencia</label></center>
								</div>
								<div class="col-sm-4">
								<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbPais_afiliado" id="cbPais_afiliado">
								<option value="-1" selected="selected">Seleccione...</option>
								<? /*LoadPais_nac_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_nac_afiliado']; */?>
								</select>
								</div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Estado</label></center>
								</div>
								<div class="col-sm-4">
								<select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbEstado_afiliado" id="cbEstado_afiliado">
									<option value="-1">Seleccionar</option>
								</select>
								</div>
								<div style="height:20px" class="col-sm-12"></div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Municipio</label></center>
								</div>
								<div class="col-sm-4">
								 <select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbMunicipio_afiliado" id="cbMunicipio_afiliado">
									<option value="-1">Seleccionar</option>
								 </select>
								</div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Parroquia</label></center>
								</div>
								<div class="col-sm-4">
								 <select style="border-radius: 15px;" class=" form-control form-control-sm select2" name="cbParroquia_afiliado" id="cbParroquia_afiliado">
									<option value="-1">Seleccionar</option>
								 </select>
								</div>
								<div style="height:20px" class="col-sm-12"></div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Sector</label></center>
								</div>
								<div class="col-sm-4">
								 <input name="sector_afiliado" id="sector_afiliado" value="<?/*=$aDefaultForm['sector_afiliado']?>" style="border-radius: 15px;" class=" form-control form-control-sm select2">
								</div>
								<div class="col-sm-2">
								 <center><label class="text-secondary">Dirección</label></center>
								</div> 
								<div class="col-sm-4">
								 <input name="direccion_afiliado" id="direccion_afiliado" value="<?=$aDefaultForm['direccion_afiliado']*/?>" style="border-radius: 15px;" class=" form-control form-control-sm select2" type="text">
								</div>
								<div class="col-sm-2"></div>
								<div class="col-sm-4"></div>
								<div class="col-sm-2"></div>
								<div class="col-sm-4"></div>
							</div-->
							<!-- /.row -->
						</div>
					</div>
					<!-- /.card -->

					<!--<div class="card card-default">-->
						<!--<div class="card-header">
							<h3 class="card-title">Bootstrap Duallistbox</h3>

							<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
							</div>
						</div>-->
						<!-- /.card-header -->
						<!--<div class="card-body">
							<div class="row">
							<div class="col-12">
								<div class="form-group">
								<label>Multiple</label>
								<select class="duallistbox" multiple="multiple">
									<option selected>Alabama</option>
									<option>Alaska</option>
									<option>California</option>
									<option>Delaware</option>
									<option>Tennessee</option>
									<option>Texas</option>
									<option>Washington</option>
								</select>
								</div>-->
								<!-- /.form-group -->
							<!--</div>-->
							<!-- /.col -->
							<!--</div>-->
							<!-- /.row -->
						<!--</div>-->
						<!-- /.card-body -->
						<!--<div class="card-footer">
							Visit <a href="https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox#readme">Bootstrap Duallistbox</a> for more examples and information about
							the plugin.
						</div>-->
					<!--</div>-->
					<!-- /.card -->

					
					
					
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
		</section>
		<div class="content">
			<div class="container-fluid">
				<div class="card card-default">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Otra Información</h3>
					</div>
				</div>
					<div class="card-body">
						<div class="form-group row" >
							<div class="col-sm-12 ">
								<label class="text-secondary">Observaciones Generales</label>
								<div class="input-group">
									<div class="input-group-addon">
										<samp></samp>
									</div>
								</div>
								<textarea class="form-control" id="observacion_datos_per" value="<?=$aDefaultForm['observacion_datos_per']?>"></textarea>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<center>
									<a href="discapacidad.php"><button type="button" name="Continuar"  id="Continuar" class="btn btn-outline-primary"  onClick="javascript:send('Continuar');">Continuar</button></a>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</section>
		</div>
		</div></div>
		
		<!-- /.content -->

	<!--</div>-->
  	<!-- /.content-wrapper -->
<!-- ./wrapper -->
<!--/body>

	<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
				<tr >
				<td width="55%" ><table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
				  <tr>
				<td height="20" colspan="4" class=""><p align="right"><span class="link-clave-ruee"><b>Última actualización:
				<?/*=$_POST['fecha']?>
				</b></span>	      </p>	      </td>
				</tr>
				<tr>
				<td height="14" colspan="4" class=""><div align="right"><span class="link-clave-ruee"><b> </b> <b>Módulo:
				<?=$_POST['modulo']?>
				</b></span></div></td>
				</tr>

				<tr>
				<th colspan="3" class="titulo">DATOS PERSONALES </th>
				</tr>
				<tr>
				<th colspan="3" height="25" class="sub_titulo" align="left">Informaci&oacute;n Personalfffff: </th>
				</tr>
				<tr >
				<th colspan="3" class="titulo"><strong>Nombre(s) y Apellido(s): <?=$aDefaultForm['nombre_afiliado'].' '.$aDefaultForm['apellido_afiliado']?></strong></th>
				</tr>
				<tr >
				<th colspan="3" class="titulo"><strong>C&eacute;dula de Identidad: <?=$_SESSION['ced_afiliado']?></strong></th>
				</tr>
				<tr>
				<th colspan="3" class="titulo"><strong>Nacionalidad: <?=$aDefaultForm['cbNacionalidad_afiliado']?></strong></th>
				</tr>
				<tr >
				<th colspan="3" class="titulo"><strong> Sexo: <? if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';
				if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';?></strong></th>
				</tr>
				<tr >
				<th colspan="3" class="titulo"><strong>Fecha Nacimiento: <?=$aDefaultForm['fnacimiento_afiliado']?></strong></th>
				</tr>
				<tr>
				<tr >
				<th colspan="3" class="titulo"><strong>Edad: <?=$aDefaultForm['edad']?></strong></th>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Estado Civil: </div></td>
				<td><select style="border-radius: 20px; padding: 6px; font-family: arial; color: rgba(83, 83, 83, 0.74);" name="cbEstado_Civil_afiliado" class="" id="cbEstado_Civil_afiliado" title="Estado Civil - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1" selected="selected">Seleccione...</option>
				<? LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; ?>
				</select>
				<span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Pa&iacute;s de Nacimiento: </div></td>
				<td><span class="links-menu-izq">
				<select name="cbPais_nac_afiliado" id="cbPais_nac_afiliado" class="" title="Pa&iacute;s de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1" selected="selected">Seleccione...</option>
				<? LoadPais_nac_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_nac_afiliado']; ?>
				</select>
				</span><span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Estado de Nacimiento: </div></td>
				<td><select name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" class="" title="Estado de Nacimiento - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1">Seleccionar</option>
				</select></td>
				</tr>
				<? if ($_SESSION['tipo_persona']!='P'){ ?>
				<tr>
				<th colspan="3" height="25" class="sub_titulo" align="left">Direcci&oacute;n de Habitaci&oacute;n: </th>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Pa&iacute;s de Residencia:</div></td>
				<td><select name="cbPais_afiliado" id="cbPais_afiliado" class="" title="Pais de Residencia - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1" selected="selected">Seleccione...</option>
				<? LoadPais_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_afiliado']; ?>
				</select>
				<span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Estado:</div></td>
				<td><span class="links-menu-izq">
				<select name="cbEstado_afiliado" id="cbEstado_afiliado" class="" title="Estado - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1">Seleccionar</option>
				</select>
				</span><span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Municipio:</div></td>
				<td><span class="links-menu-izq">
				<select name="cbMunicipio_afiliado" id="cbMunicipio_afiliado" class="" title="Municipio - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="">Seleccionar</option>
				</select>
				</span><span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Parroquia:</div></td>
				<td><span class="links-menu-izq">
				<select name="cbParroquia_afiliado" id="cbParroquia_afiliado" class="" title="Parroquia - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="">Seleccionar</option>
				</select>
				</span><span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Sector:</div></td>
				<td><input name="sector_afiliado" type="text" class="" id="sector_afiliado" value="<?=$aDefaultForm['sector_afiliado']?>" size="50" maxlength="50" title="Sector - Ingrese letras y/o n&uacute;meros" />
				<span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Direcci&oacute;n: </div></td>
				<td><input name="direccion_afiliado" type="text" class="" id="direccion_afiliado" value="<?=$aDefaultForm['direccion_afiliado']?>" size="50" maxlength="100" title="Direccion - Ingrese letras y/o n&uacute;meros" />
				<span class="requerido"> *</span></td>
				</tr>
				<? } ?>
				<tr>
				<th colspan="3" height="25" class="sub_titulo" align="left"><div align="left">Ubicaci&oacute;n:</div></th>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Tel&eacute;fono Personal:</div></td>
				<td><input name="telefono_afiliado" type="text" class="" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_afiliado']?>" size="20" maxlength="11" title="Tel&eacute;fono Personal - Ingrese s&oacute;lo once (11) n&uacute;meros" />
				<span class="requerido"> * </span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Tel&eacute;fono de Habitaci&oacute;n:</div></td>
				<td><input name="otro_telefono_afiliado" type="text" class="" id="otro_telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_afiliado']?>" size="20" maxlength="11" title="Tel&eacute;fono de Habitaci&oacute;n - Ingrese s&oacute;lo once (11) n&uacute;meros" /></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Correo Electr&oacute;nico:</div></td>
				<td><input name="email_afiliado" type="text" class="" id="email_afiliado" value="<?=$aDefaultForm['email_afiliado']?>" size="30" maxlength="30" title="Correo Electr&oacute;nico - Ejemplo: persona@servicio.com"/></td>
				</tr>
				<tr>
				<th colspan="3" height="25" class="sub_titulo" align="left">Otra informaci&oacute;n:</th>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">¿Posee discapacidad?:</div></td>
				<td><select name="cbDiscapacidad_afiliado" class="" id="cbDiscapacidad_afiliado" title="¿Posee discapacidad? - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1" selected="selected">Seleccione</option>
				<option value="1" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='1') print 'selected="selected"';?>>Si</option>
				<option value="0" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='0') print 'selected="selected"';?>>No</option>
				</select>
				<span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">¿Es jefe de hogar?:</div></td>
				<td><select name="cbJefe_familia" class="" id="cbJefe_familia" title="¿Es jefe de hogar? - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1" selected="selected">Seleccione</option>
				<option value="1" <? if (($aDefaultForm['cbJefe_familia'])=='1') print 'selected="selected"';?>>Si</option>
				<option value="0" <? if (($aDefaultForm['cbJefe_familia'])=='0') print 'selected="selected"';?>>No</option>
				</select>
				<span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td height="25"><div align="right" class="">¿Tiene hijos?:</div></td>
				<td><select name="cbHijos" class="" id="cbHijos" title="¿Tiene hijos? - Seleccione s&oacute;lo una opci&oacute;n del listado">
				<option value="-1" selected="selected">Seleccione</option>
				<option value="1" <? if (($aDefaultForm['cbHijos'])=='1') print 'selected="selected"';?>>Si</option>
				<option value="0" <? if (($aDefaultForm['cbHijos'])=='0') print 'selected="selected"';?>>No</option>
				</select>
				<span class="requerido"> *</span></td>
				</tr>
				<tr id="cantidad_hijos">
				<td height="25"><div align="right" class="">¿Cu&aacute;ntos menores de 18 a&ntilde;os?</div></td>
				<td><input name="hijos_menores" type="text" class="" id="hijos_menores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_menores']?>" size="5" maxlength="2" title="¿Cu&aacute;ntos menores de 18 a&ntilde;os? - Ingrese s&oacute;lo n&uacute;meros "/></td>
				</tr>
				<tr id="cantidad_hijos1">
				<td height="25"><div align="right" class="">¿Cu&aacute;ntos mayores de 18 a&ntilde;os?</div></td>
				<td><input name="hijos_mayores" type="text" class="" id="hijos_mayores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_mayores']?>" size="5" maxlength="2" title="¿Cu&aacute;ntos mayores de 18 a&ntilde;os? - Ingrese s&oacute;lo n&uacute;meros "/></td>
				</tr>
				<tr>
				<td width="45%" height="22"><div align="right" class="">Ingreso  familiar mensual (Bs.):</div></td>
				<td><input name="ingreso_familiar" type="text" class="" id="ingreso_familiar" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['ingreso_familiar']?>" size="20" maxlength="8" title="Ingreso familiar mensual - Ingrese solo numeros "/>
				<span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Tipo de veh&iacute;culo que posee: </div></td>
				<td><select name="cbVehiculo_afiliado" class="" id="cbVehiculo_afiliado" title="Tipo de vehiculo que posee- Seleccione solo una opcion del listado">
				<option value="-1" selected="selected">Seleccione...</option>
				<? LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];?>
				</select>
				<span class="requerido"> *</span></td>
				</tr>
				<tr>
				<td height="25"><div align="right" class="">¿Usted ha sido beneficiario de las Misiones Educativas del Estado?:</div></td>
				<td><select name="cbmision_beneficio_educacion" class="" id="cbmision_beneficio_educacion" title="Beneficiario de misiones - Seleccione solo una opcion del listado">
				<option value="-1" selected="selected">Seleccione</option>
				<option value="1" <? if (($aDefaultForm['cbmision_beneficio_educacion'])=='1') print 'selected="selected"';?>>Si</option>
				<option value="0" <? if (($aDefaultForm['cbmision_beneficio_educacion'])=='0') print 'selected="selected"';?>>No</option>
				</select></td>
				</tr>
				<tr id="tr_mision_edu">
				<td height="25"><div align="right" class="">¿C&uacute;al Misi&oacute;n?:</div></td>
				<td><select name="cbMisiones_Educacion" class="" id="cbMisiones_Educacion" title="Mision - Seleccione solo una opcion del listado">
				<option value="-1" selected="selected">Seleccione...</option>
				<? LoadMisiones_Educacion($conn) ; print $GLOBALS['sHtml_cb_Misiones_Educacion']; ?>
				</select></td>
				</tr>
				<tr>
				<td><div align="right" class="">¿Usted ha sido beneficiario  de las Misiones Sociales del Estado?:</div></td>
				<td><select name="cbmision_beneficio_social" class="" id="cbmision_beneficio_social" title="Beneficiario de misiones - Seleccione solo una opcion del listado">
				<option value="-1" selected="selected">Seleccione</option>
				<option value="1" <? if (($aDefaultForm['cbmision_beneficio_social'])=='1') print 'selected="selected"';?>>Si</option>
				<option value="0" <? if (($aDefaultForm['cbmision_beneficio_social'])=='0') print 'selected="selected"';?>>No</option>
				</select>
				<span class="requerido"> *</span></td>
				</tr>
				<tr id="tr_mision_soc">
				<td><div align="right" class="">¿C&uacute;al Misi&oacute;n?:</div></td>
				<td><select name="cbMisiones_social" class="" id="cbMisiones_social" title="Mision - Seleccione solo una opcion del listado">
				<option value="-1" selected="selected">Seleccione...</option>
				<? LoadMisiones_social($conn) ; print $GLOBALS['sHtml_cb_Misiones_social']; ?>
				</select></td>
				</tr>
				<tr>
				<td width="45%" height="25"><div align="right" class="">Observaciones generales: </div></td>
				<td><input name="observacion_datos_per" type="text" class="" id="observacion_datos_per" value="<?=$aDefaultForm['observacion_datos_per']?>" size="50" maxlength="100" title="Observaciones del funcionario que ingresa la informacion - Ingrese letras y/o numeros" /></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td colspan="3"><div align="center">
				<div align="center"><span class="requerido">
				<button type="button" name="Continuar"  id="Continuar" class="button"  onClick="javascript:send('Continuar');">Continuar</button>
				<button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
				</span></div>
				</div></td>
				</tr>
				<tr>
				<td colspan="3">&nbsp;</td>
				</tr>
	    </table>	    <strong></strong></td>
	  </tr>
	</table-->
</form>
<?s/*
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
*/?> 

<?php include('footer.php'); ?>
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
//debug($settings['debug']=false);*/
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
					
	/*	if ($_POST['nombre_afiliado']==""){
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
				 
				 */
				 
				 
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
			
			//LoadData($conn,true);	
			break;
	        }
		}		
		else{
		//LoadData($conn,false);
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
				
		/* ///REVISARRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
				 if (isset($_SESSION['registro'])){
						 unset($_SESSION['registro']);
			   
			  		$SQL="select * From public.personas where cedula='".$_SESSION['ced_afiliado']."'";
					  $rs1 = $conn->Execute($SQL);
					  if ($rs1->RecordCount()>0){ 				
						 $_SESSION['id_afiliado']=$rs1->fields['id']; 
					  }	
   }*/
        
	if (!$bPostBack){
	/*		/// AQUI VALIDA EL ID TRABAJADOR CUANDO VIENE DE CONSULTA
	      if ($_GET['id_po']!='') $_SESSION['id_afiliado']=$_GET['id_po'];	
			  if ($_GET['ced']!='') $_SESSION['ced_afiliado']=$_GET['ced'];*/
					
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
							
	/*	   //verifica la ultima actualizacion del registro	 
	       $sql1="select modulo.nombre  as modulo, trazas.fecha
					  from trazas  
					  INNER JOIN modulo ON modulo.id=trazas.modulo
					  where tabla_id='".$_SESSION['id_afiliado']."' 
					  and identi='".$_SESSION['ced_afiliado']."' order by fecha desc  limit 1";
			   $rs1= $conn->Execute($sql1);
			   if ($rs1->RecordCount()>0){
					$_POST['fecha']=strftime("%d/%m/%Y", strtotime($rs1->fields['fecha']));
					$_POST['modulo']=$rs1->fields['modulo'];	 
					} */
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
 include('../header.php'); 
 //echo '<br>';
//include('menu_trabajador.php'); 
}
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="frm_trabajador" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >

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
</script>
  <input name="action" type="hidden" value=""/>
  <input name="nombre_afiliado" type="hidden" value="<?=$aDefaultForm['nombre_afiliado']?>"/>
  <input name="apellido_afiliado" type="hidden" value="<?=$aDefaultForm['apellido_afiliado']?>"/>
  <input name="cbSexo_afiliado" type="hidden" value="<?=$aDefaultForm['cbSexo_afiliado']?>"/>
  <input name="fnacimiento_afiliado" type="hidden" value="<?=$aDefaultForm['fnacimiento_afiliado']?>"/>
  <input name="edad" type="hidden" value="<?=$aDefaultForm['edad']?>"/>
  <input name="cbNacionalidad_afiliado" type="hidden" value="<?=$aDefaultForm['cbNacionalidad_afiliado']?>"/>
	<input name="tipo_persona"  id="tipo_persona" type="hidden" value="<?=$_SESSION['tipo_persona']?>"/>
	<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
	
 <tr>
	      <th colspan="4" height="20" class="sub_titulo" align="left">DATOS PERSONALES</th>
</tr>
 <tr>
          <td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
	      <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2" align="left">Informaci&oacute;n Personal</th>
        </tr>		   
          <tr>
            <td width="238" style="background-color:#F0F0F0; color:#666" align="center"><strong>C&eacute;dula de Identidad</strong></td>
            <td  width="224" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?=number_format( $_SESSION['ced_afiliado'], 0, '', '.')?></font></td>
            <td  width="226" style="background-color:#F0F0F0; color:#666"" align="center"><strong>Nacionalidad </strong></td>
            <td  width="221" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['cbNacionalidad_afiliado']==1){
            echo 'VENEZOLANO';
            }else{
            echo 'EXTRANJERA';
            }
            ?>
            </font></td>
        </tr>
        <tr>
        	<th colspan="4">&nbsp;</th>		
        </tr>
         <tr>
            <th  width="238" class="sub_titulo" align="center">Nombre(s) y Apellido(s)</th>		
            <th  width="224" class="sub_titulo" align="center">Sexo</th>		
            <th  width="226" class="sub_titulo" align="center">Fecha de Nacimiento</th>		
            <th  width="221" class="sub_titulo" align="center">Edad</th>		
        </tr>        
        <tr>
            <td  width="238" style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['nombre_afiliado'];?></font></td>
             <td width="224" style="background-color:#F0F0F0;" align="left"><font color="#666666"><? if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';												 if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';?></font></td>    
              <td  width="226"style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['fnacimiento_afiliado'];?></font></td>   
               <td  width="221" style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['edad'];?></font></td>    
        </tr>
	 <tr>
        	<th colspan="4" >&nbsp;</th>		
        </tr>
         <tr>
<th  class="sub_titulo" align="left">Estado civil</th>		
<th class="sub_titulo" align="left">Pa&iacute;s de nacimiento</th>		
<th class="sub_titulo" align="left">Estado de nacimiento</th>		
<th class="sub_titulo" align="left">Pais de Residencia</th>	
        </tr>       
        
	    <tr align="center">
	    
	      <td style="background-color:#F0F0F0;"><select name="cbEstado_Civil_afiliado"  style="width:95%" id="cbEstado_Civil_afiliado" title="Estado civil - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <? LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; ?>
	        </select>
	        <span class="requerido"> *</span></td>
	  
	    
	      <td style="background-color:#F0F0F0;"><span class="links-menu-izq">
	        <select name="cbPais_nac_afiliado" id="cbPais_nac_afiliado" style="width:95%" title="Pais de nacimiento - Seleccione solo una opcion del listado">
	          <option value="-1" selected="selected">Seleccione...</option>
	          <? LoadPais_nac_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_nac_afiliado']; ?>
	          </select>
	        </span><span class="requerido"> *</span></td>
	  
	    
	      <td  style="background-color:#F0F0F0;"><select name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" style="width:95%" title="Estado de nacimiento - Seleccione solo una opcion del listado">
	        <option value="-1">Seleccionar</option>
	        </select></td>
              <td style="background-color:#F0F0F0;" ><select name="cbPais_afiliado" id="cbPais_afiliado" style="width:95%" title="Pais de residencia - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <?  LoadPais_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_afiliado']; ?>
	        </select>
	        <span class="requerido"> *</span></td>
	      </tr>
	   <tr class="identificacion_seccion" >
            <th colspan="4" class="sub_titulo_2" align="left">Dirección de Habitación</th>
        </tr> 
        
        	 <tr>
   		<th  width="238" class="sub_titulo" align="left">Estado</th> 
		<th  width="224" class="sub_titulo" align="left">Municipio</th>
       <th colspan="2" class="sub_titulo"  align="left">Parroquia</th>
       
	 </tr>
    
     <tr>
 	    <td  style="background-color:#F0F0F0;" align="left" width="238">
            <select name="cbEstado_afiliado" id="cbEstado_afiliado" class="" title="Estado - Seleccione solo una opcion del listado">
	          <option value="-1">Seleccionar</option>
	          </select><span class="requerido"> * </span>
        </td>
       
        <td style="background-color:#F0F0F0;" align="left"  width="224" >
            <select name="cbMunicipio_afiliado" id="cbMunicipio_afiliado" class="" title="Municipio - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
	          </select><span class="requerido"> * </span>
        </td>    
        <td style="background-color:#F0F0F0;" align="left" colspan="2" >
            <select name="cbParroquia_afiliado" id="cbParroquia_afiliado" class="" title="Parroquia - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
	          </select><span class="requerido"> * </span>
         </td>  

     </tr>
<tr>
        	<th colspan="4" >&nbsp;</th>		
        </tr>
        <tr>
            <th  class="sub_titulo" colspan="2" id="td_direccion1" title="Dirección de Habitación - Seleccione solo una opcion">
              <input name="direccion1" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion1'] == 1) ?  'checked="checked"' : '' ?>/> 
              Avenida
              <input name="direccion1" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion1'] == 2) ?  'checked="checked"' : '' ?>/> 
              Calle
              <input name="direccion1" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion1'] == 3) ?  'checked="checked"' : '' ?>/> 
              Carrera
              <input name="direccion1" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion1'] == 4) ?  'checked="checked"' : '' ?>/> 
              Carretera 
              <input name="direccion1" type="radio" class="texto-normal" value="5" <?= ($aDefaultForm['direccion1'] == 5) ?  'checked="checked"' : '' ?>/> 
              Esquina
              <input name="direccion1" type="radio" class="texto-normal" value="6" <?= ($aDefaultForm['direccion1'] == 6) ?  'checked="checked"' : '' ?>/> 
              Vereda
        	  <span class="requerido"> * </span>
  		   </th>
           
          <th class="sub_titulo" colspan="2" id="td_direccion1"  title="Dirección de Habitación - Seleccione solo una opcion">
            <input name="direccion2" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion2'] == 1) ?  'checked="checked"' : '' ?>/> 
            Casa
           <!-- <input name="direccion2" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion2'] == 2) ?  'checked="checked"' : '' ?>/> 
            Centro Comercial-->
            <input name="direccion2" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion2'] == 3) ?  'checked="checked"' : '' ?>/> 
            Edificio
<!--            <input name="direccion2" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion2'] == 4) ?  'checked="checked"' : '' ?>/> 
            Local-->
            <input name="direccion2" type="radio" class="texto-normal" value="5" <?= ($aDefaultForm['direccion2'] == 5) ?  'checked="checked"' : '' ?>/> 
            Quinta
            <span class="requerido"> * </span>
           </th>
	   </tr>
      
      <tr>
           <td style="background-color:#F0F0F0;" colspan="2"> 
                 <?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                    }
                  ?> 
          <input style="width: 95%" name="txt_direccion1_2" type="text" id="txt_direccion1_2" placeholder="Detalle de Direcci&oacute;n de Habitación" title="Detalle de Direcci&oacute;n de Habitacón- Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." value="<?= $aDefaultForm['txt_direccion1_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
          <span class="requerido"> * </span>
           </td>
      
           <td style="background-color:#F0F0F0;" colspan="2">
                <?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                    }
                ?> 
         <input style="width: 95%" name="txt_direccion2_2" type="text" id="txt_direccion2_2" placeholder="Detalle de Direcci&oacute;n de Habitación" title="Detalle de Direcci&oacute;n de Habitacón- Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." value="<?= $aDefaultForm['txt_direccion2_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
          <span class="requerido"> * </span>
          </td>
	  </tr>
     
      <tr>
         <th colspan="4">&nbsp;</th>		
      </tr>
         
	  <tr>
         <th align ="left" colspan="2" class="sub_titulo" id="td_direccion3"  title="Dirección de Habitación - Seleccione solo una opcion">
            <input name="direccion3" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion3'] == 1) ?  'checked="checked"' : '' ?>/> 
            Apartamento
            <input name="direccion3" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion3'] == 2) ?  'checked="checked"' : '' ?>/> 
            Local
            <input name="direccion3" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion3'] == 3) ?  'checked="checked"' : '' ?>/> 
            Oficina
            <span class="requerido"> * </span>    
         </th>     
         <th colspan="2" class="sub_titulo" id="td_direccion4"  title="Dirección de Habitación - Seleccione solo una opcion">
            <input name="direccion4" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion4'] == 1) ?  'checked="checked"' : '' ?>/> 
            Barrio
            <input name="direccion4" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion4'] == 2) ?  'checked="checked"' : '' ?>/> 
            Caserio
            <input name="direccion4" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion4'] == 3) ?  'checked="checked"' : '' ?>/> 
            Conjunto Residencial
            <input name="direccion4" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion4'] == 4) ?  'checked="checked"' : '' ?>/> 
            Sector   
             <input name="direccion4" type="radio" class="texto-normal" value="5" <?= ($aDefaultForm['direccion4'] == 5) ?  'checked="checked"' : '' ?>/> 
            Urbanizaci&oacute;n
            <input name="direccion4" type="radio" class="texto-normal" value="6" <?= ($aDefaultForm['direccion4'] == 6) ?  'checked="checked"' : '' ?>/> 
            Zona
            <span class="requerido"> * </span>
        </th>
     </tr>
    
	 <tr>
   		<td style="background-color:#F0F0F0;" colspan="2"> 
		  <?php 
              $disab="";
              if($aDefaultForm['txt_visible']==2){ 
              $disab="disabled";
              }
          ?> 
      <input style="width: 95%" name="txt_direccion3_2" type="text" id="txt_direccion3_2" placeholder="Detalle de Direcci&oacute;n de Habitación" title="Detalle de Direcci&oacute;n de Habitación- Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." value="<?= $aDefaultForm['txt_direccion3_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
    	</td>
    
        <td style="background-color:#F0F0F0;" colspan="2"> 
                    <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                $disab="disabled";
                }
            ?> 
         <input style="width: 95%" name="txt_direccion4_2" type="text" id="txt_direccion4_2" title="Detalle de Direcci&oacute;n de Habitación - Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." placeholder="Detalle de Direcci&oacute;n de Habitación" value="<?= $aDefaultForm['txt_direccion4_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
          <span class="requerido"> * </span>
        </td>
	 </tr>
       <tr>
         <th colspan="4">&nbsp;</th>		
      </tr>
     <tr>
          <th colspan="4" class="sub_titulo" align="center">Punto de Referencia</th>
     </tr>

     <tr>
          <td style="background-color:#F0F0F0;" colspan="4" align="center">
			 <?php 
				  $disab="";
				  if($aDefaultForm['txt_visible']==2){    
				  $disab="disabled";
				  }
             ?>
            <input style="width: 98%" name="txt_punto_referencia" type="text" class="textbox" id="txt_punto_referencia"  title="Punto de Referencia - Ingrese un punto de referencia de su direcci&oacute;n de Habitaci&oacute;n. Acepta un m&iacute;nimo de 10 y m&aacute;ximo 30 caracteres"  placeholder="Punto de Referencia" value="<?= $aDefaultForm['txt_punto_referencia'];?>" maxlength="150" 
            <?php echo $disab; ?> autocomplete="off"/> 
          <span class="requerido"> * </span>
          </td>
	  </tr>
<tr class="identificacion_seccion" >
            <th colspan="4" class="sub_titulo_2" align="left">Ubicaci&oacute;n</th>
        </tr> 
        
        	 <tr >
   		<th   width="238" align="left" class="sub_titulo" >Tel&eacute;fono Personal</th> 
		<th   width="224" align="left"class="sub_titulo" >Otro tel&eacute;fono</th>
      <th align="left" colspan="2"  class="sub_titulo" >Correo electr&oacute;nico</th>
	 </tr>
	    
	    <tr align="center">
	    
	      <td style="background-color:#F0F0F0;" align="center" ><select name="codigo1" placeholder="Cód." title="Código de Telefonía - Seleccione solo una opción del listado" style="width: 25%" id="codigo1" >
                        	<option value="">----</option>
							<option value="0416">0416</option>
							<option value="0426">0426</option>
							<option value="0414">0414</option>
							<option value="0424">0424</option>
							<option value="0412">0412</option>          
						</select>-
                        <input name="telefono_afiliado" type="text" class="" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_afiliado']?>" title="Tel&eacute;fono Personal - Ingrese s&oacute;lo N&uacute;meros. Acepta 7 d&iacute;gitos. Ejemplo: 1234567" placeholder="N° teléfono" size="20" maxlength="11" />
	        <span class="requerido"> * </span></td>
	  
	     
	      <td style="background-color:#F0F0F0;" align="center">
          <input name="otro_telefono_afiliado1" type="text" id="otro_telefono_afiliado1" onkeypress="return isNumberKey(event);" title="C&oacute;digo de &Aacute;rea - Ingrese s&oacute;lo N&uacute;meros. Acepta 4 d&iacute;gitos. Ejemplo: 0212" size="4" maxlength="4" value="" autocomplete="off"  placeholder="Cód."/>-<input name="otro_telefono_afiliado"  placeholder="N° teléfono"type="text" class="" id="otro_telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_afiliado']?>" size="20" maxlength="11" title="Otro Telefono - Ingrese s&oacute;lo N&uacute;meros. Acepta 7 d&iacute;gitos. Ejemplo: 1234567" /></td>
	    
	   
	      <td colspan="2" style="background-color:#F0F0F0;" ><input name="email_afiliado"  style="width:45%"type="text" class="" id="email_afiliado" value="<?=$aDefaultForm['email_afiliado']?>"  placeholder="micorreo"size="15" maxlength="30" title="Correo electronico -  Ejemplo: micorreo,jperez,inv123.ca, otros"/>@<input name="email_afiliado1"  style="width:50%"type="text" class="" id="email_afiliado" value="<?=$aDefaultForm['email_afiliado1']?>"  placeholder="dominio.com"size="15" maxlength="30" title="Correo electronico -  Ejemplo: gmail.com,hotmail.com,otros"/></td>
	      </tr>

	    <tr class="identificacion_seccion" >
            <th colspan="4" class="sub_titulo_2" align="left">Otra informaci&oacute;n</th>
        </tr> 
        
        	 <tr>
   		<th width="238"  class="sub_titulo" align="left">¿Posee discapacidad?</th> 
		<th width="224"  class="sub_titulo" align="left">¿Es jefe de hogar?</th>
      <th colspan="2" class="sub_titulo" align="left">¿Tiene hijos?</th>
	 </tr>
       
	    <tr>
	    
	      <td style="background-color:#F0F0F0;"><select name="cbDiscapacidad_afiliado"  style="width:95%" id="cbDiscapacidad_afiliado" title="Posee discapacidad - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>

	    
	      <td style="background-color:#F0F0F0;"><select name="cbJefe_familia" style="width:95%" id="cbJefe_familia" title="Es jefe de hogar - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbJefe_familia'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbJefe_familia'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>

	     
	      <td colspan="2" style="background-color:#F0F0F0;"><select name="cbHijos" style="width:95%" id="cbHijos" title="Tiene hijos - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbHijos'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbHijos'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>
	      </tr>
          
   	 <tr align="center" >
   		<th   class="sub_titulo" align="left">¿Cu&aacute;ntos menores de 18?</th> 
		<th   class="sub_titulo" align="left">¿Cu&aacute;ntos mayores de 18?</th>
      <th  colspan="2" class="sub_titulo" align="left"> ¿Qué Tipo de veh&iacute;culo posee?</th>
	 </tr>        
	    <tr  align="center">
	     
	      <td style="background-color:#F0F0F0;"><input name="hijos_menores" type="text"style="width:95%" id="hijos_menores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_menores']?>" size="5" maxlength="2" title="Cantidad de hijos menores - Ingrese solo numeros " placeholder="Cantidad de hijos menores"/></td>	      
	      <td style="background-color:#F0F0F0;"><input name="hijos_mayores" type="text" style="width:95%" id="hijos_mayores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_mayores']?>" size="5" maxlength="2" title="Cantidad de hijos mayores - Ingrese solo numeros " placeholder="Cantidad de hijos mayores"/></td>	          
	      <td style="background-color:#F0F0F0;"  colspan="2"><select name="cbVehiculo_afiliado" style="width:95%" id="cbVehiculo_afiliado" title="Tipo de vehiculo que posee - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected" style="width:95%">Seleccione...</option>
	        <? //LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];?>
	        </select>
	        <span class="requerido"> *</span></td>
	      </tr>
           <tr align="center">
   		<th   class="sub_titulo" align="left">¿Usted ha sido beneficiario de las Misiones Educativas del Estado?</th> 
		<th   class="sub_titulo" align="left">¿C&uacute;al Misi&oacute;n?</th>
      <th   class="sub_titulo" align="left">¿Usted ha sido beneficiario  de las Misiones Sociales del Estado?</th>
      <th   class="sub_titulo" align="left">¿C&uacute;al Misi&oacute;n?</th>
	 </tr>    
	    <tr>
	     
	      <td style="background-color:#F0F0F0;"><select name="cbmision_beneficio_educacion" style="width:95%" id="cbmision_beneficio_educacion" title="Beneficiario de misiones educativas - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbmision_beneficio_educacion'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbmision_beneficio_educacion'])=='0') print 'selected="selected"';?>>No</option>
	        </select></td>
	  
	    
	      <td style="background-color:#F0F0F0;"><select name="cbMisiones_Educacion" style="width:95%" id="cbMisiones_Educacion" title="Misión Educativa - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <? //LoadMisiones_Educacion($conn) ; print $GLOBALS['sHtml_cb_Misiones_Educacion']; ?>
	        </select></td>
	    
	    
	      <td style="background-color:#F0F0F0;"><select name="cbmision_beneficio_social" style="width:95%" id="cbmision_beneficio_social" title="Beneficiario de misiones sociales - Seleccione solo una opción del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbmision_beneficio_social'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbmision_beneficio_social'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>
	    
	   
	      <td style="background-color:#F0F0F0;"><select name="cbMisiones_social" style="width:95%" id="cbMisiones_social" title="Mision Social - Seleccione solo una opción del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <? //LoadMisiones_social($conn) ; print $GLOBALS['sHtml_cb_Misiones_social']; ?>
	        </select></td>
	      </tr>
            <tr align="center">
   		      <th  colspan="4"  class="sub_titulo" align="left">Observaciones generales</th>
	 		</tr>    
	    <tr>
	     
	      <td style="background-color:#F0F0F0;" colspan="4"><input name="observacion_datos_per" type="text" style="width:95%" id="observacion_datos_per"  value="<?=$aDefaultForm['observacion_datos_per']?>" size="100" placeholder="Observaciones" maxlength="100" title="Observaciones Generales de la persona que ingresa la información - Ingrese letras y/o numeros" /></td>
	      </tr>
	    <tr>
	      <td colspan="4">&nbsp;</td>
	  
	      </tr>
	    <tr>
	      <td colspan="4"><div align="center">
	        <div align="center"><span class="requerido">
	          <button type="button" name="Continuar"  id="Continuar" class="button_personal btn_aceptar"  onClick="javascript:send('Continuar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button_personal btn_cancelar"  onClick="javascript:send('Cancelar');">Cancelar</button>
	          </span></div>
	        </div></td>
	      </tr>
	    <tr>
	      <td colspan="3">&nbsp;</td>
	      </tr>
	    </table>
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

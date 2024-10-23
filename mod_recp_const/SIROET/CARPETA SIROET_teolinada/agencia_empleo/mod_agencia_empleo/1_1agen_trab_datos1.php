<?php
//session_start();
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');

include('1_Validador.php');

include('Trazas.class.php');

$_SESSION['captcha']='1912';
$_SESSION[ 'id_afiliado']='3'; 
$_SESSION[  'ced_afiliado']= 'V17059762';
$_SESSION[  'nombre_afiliado']=  'SHIRA NAYESKA' ;
$_SESSION[  'apellido_afiliado']='MENDOZA ZERPA'  ;
$_SESSION[ 'tipo_usuario']= '2'  ;
$_SESSION[ 'usuario']= 'SHIRA NAYESKA MENDOZA ZERPA CI: V17059762' ;
$_SESSION[  'sUnidadSustantiva' ]= '0'  ;
$_SESSION[   'tipo_persona' ]= 'V'  ;
$_SESSION[  'sUsuario']= '17059762'  ;
$_SESSION[  'sesiones']= '1111110'  ;


debug($settings['debug']=false);
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

		if ($_POST['redes_sociales']==""){
				$GLOBALS['aPageErrors'][]= "- La Red Social: es requerido.";
				$bValidateSuccess=false;
				 }	
			 
	     if ($_POST['cbDiscapacidad_afiliado']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Posee discapacidad: es requerido.";
				$bValidateSuccess=false;
				 }

		if ($_POST['cbDiscapacidad_afiliado']=="1"){  
			if ($_POST['cbTipo_discapacidad']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El tipo de discapacidad: es requerido.";
				$bValidateSuccess=false;
			}
		}else{
			$_POST['cbTipo_discapacidad']='-1';
		}
				
		if ($_POST['cbDiscapacidad_afiliado']=="1"){  
			if ($_POST['cbDiscapacidad_nivel']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Grado de discapacidad: es requerido.";
				$bValidateSuccess=false;
			}
		}else{
			$_POST['cbDiscapacidad_nivel']='-1';
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
			//echo "action";
		LoadData($conn,false);
		}
}

//------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
	//echo "LoadData";
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
					$aDefaultForm['redes_sociales']='';
					$aDefaultForm['cbVehiculo_afiliado']='-1';
					$aDefaultForm['observacion_datos_per']=''; 
					$aDefaultForm['cbDiscapacidad_afiliado']='-1';
					$aDefaultForm['cbTipo_discapacidad']='-1';
					$aDefaultForm['cbDiscapacidad_nivel']='-1';
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
			$aDefaultForm['redes_sociales']=$rs1->fields['redes_sociales'];
			$aDefaultForm['cbVehiculo_afiliado']=$rs1->fields['tipo_vehiculo_id'];
			$aDefaultForm['observacion_datos_per']=$rs1->fields['observaciones']; 
			$aDefaultForm['cbDiscapacidad_afiliado']=$rs1->fields['discapacidad'];
			$aDefaultForm['cbTipo_discapacidad']=$rs1->fields['nombre'];
			$aDefaultForm['nivel_discapacidad']=$rs1->fields['nombre'];
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
					$aDefaultForm['redes_sociales']=$_POST['redes_sociales'];
					$aDefaultForm['cbVehiculo_afiliado']=$_POST['cbVehiculo_afiliado'];
					$aDefaultForm['observacion_datos_per']=$_POST['observacion_datos_per']; 
					$aDefaultForm['cbDiscapacidad_afiliado']=$_POST['cbDiscapacidad_afiliado'];
					$aDefaultForm['cbTipo_discapacidad']=$_POST['cbTipo_discapacidad'];
					$aDefaultForm['nivel_discapacidad']=$_POST['nivel_discapacidad'];
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
				  redes_sociales = '".$_POST['redes_sociales']."',
				  tipo_vehiculo_id = '".$_POST['cbVehiculo_afiliado']."',
				  discapacidad = '".$_POST['cbDiscapacidad_afiliado']."',
				  tipo_discapacidad='".$_POST['cbTipo_discapacidad']."',
				  nivel_discapacidad='".$_POST['cbDiscapacidad_nivel']."',
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
				   
			   	
			 if ($_SESSION['disc_bloq']==1){
			?><script>document.location='1_3agen_trab_discapacidad.php'</script><? 
			}else{
			   ?><script>document.location='1_4agen_trab_ocupacion.php.php'</script><? 
			}
		}			
				
	}

//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
//echo 'showHeader';
 //include('../header.php'); // se debe adaptar el header con la neva plantilla
 //echo '<br>';
 include('menu_trabajador.php'); 
 ?>

<div class="container">
 <?

}
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
	//echo 'showForm';
?>

<form name="frm_trabajador" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<!--<head> esto debe copiarse en el header carpeta layoouts y colar la ruta coorect par ubicar los script
<script src="../js/js/jquery-3.2.1.js"></script>
<script src="validar_trabajador.js"></script>
<script src="funciones_trabajador.js"></script>
</head>
-->

<script>

function send(saction){
	//alert(saction);
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
    
    
	<table width="100%" border="0" align="center"  cellpadding="0" cellspacing="0">
	    <tr >
	     <th colspan="2"><div align="center">DATOS PERSONALES</div></th>
	
	    </tr>
	    <tr >
	      <th  ><div align="right">Informaci&oacute;n Personal: </div></th>
	      <td>&nbsp;</td>
	      </tr>
	    <tr>
	      <th ><div align="right"><strong>Nombre y Apellido:</strong></div></th>
          <td><strong><?=$aDefaultForm['nombre_afiliado'].' '.$aDefaultForm['apellido_afiliado']?></strong></td>         
	    </tr>
      <tr >
	      <th><div align="right"><strong>C&eacute;dula:</th>
          <td><strong><?=$_SESSION['ced_afiliado']?></strong></td> 
	  </tr>
      <tr>
      	 <th><div align="right"><strong>Nacionalidad:</strong></div></th> 
		 <td><strong><?=$_SESSION['cbNacionalidad_afiliado']?></strong></td>
	   </tr>
      <tr>
	      <th><div align="right"><strong> Sexo: </strong></div></th>
           <td><strong><? if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';
			 if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';?></strong></td>
	      </tr>
      <tr >
	      <th><div align="right"><strong> Fecha nacimiento: </strong></div></th>
          <td><strong><?=$_SESSION['fnacimiento_afiliado']?></strong></td>
	      </tr>
	      <th><div align="right"><strong> Edad:</strong></div></th>
          <td><strong><?=$_SESSION['edad']?></strong></td>
	   </tr>	  
	   
	    <? if ($_SESSION['tipo_persona']!='P'){ ?>
 <tr >
	      <th  ><div align="right">Ubicaci&oacute;n:</div></th>
	      <td>&nbsp;</td>
	      </tr>
	    <tr>
	    <tr>
	      <td ><div align="right" class="">Tel&eacute;fono:</div></td>
	      <td><input name="telefono_afiliado" type="text" class="" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_afiliado']?>" size="20" maxlength="11" title="Telefono - Ingrese solo 11 numeros" />
	        <span class="requerido"> * </span></td>
	      </tr>
	    <tr>
	      <td><div align="right" class="">Otro tel&eacute;fono:</div></td>
	      <td><input name="otro_telefono_afiliado" type="text" class="" id="otro_telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['otro_telefono_afiliado']?>" size="20" maxlength="11" title="Telefono - Ingrese solo 11 numeros" /></td>
	      </tr>
	    <tr>
	      <td><div align="right" class="">Correo electr&oacute;nico:</div></td>
	      <td><input name="email_afiliado" type="text" class="" id="email_afiliado" value="<?=$aDefaultForm['email_afiliado']?>" size="30" maxlength="30" title="Correo electronico - Ejemplo: persona@servicio.com"/></td>
	      </tr>
	    <tr>
	      <td ><div align="right" >Redes Sociales:</div></td>
	      <td><input name="redes_sociales" type="text" class="" id="redes_sociales" value="<?=$aDefaultForm['redes_sociales']?>" size="30" maxlength="30" title="Redes Sociales - Ejemplo:  Facebook, Instagram, Twitter, Snapchat, Tumblr, Flickr, Meetic, Spotify, YouTube, Telegram"/></td>
	      </tr>
         <tr >
	      <th  ><div align="right">Otra informaci&oacute;n:</div></th>
	      <td>&nbsp;</td>
	      </tr>
	    <tr>
	      <td ><div align="right" class="">¿Posee discapacidad?:</div></td>
	      <td><select name="cbDiscapacidad_afiliado" class="" id="cbDiscapacidad_afiliado" title="Posee discapacidad - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>
	      </tr>
	    <tr id="tr_Tipo_discapacidad">
        <td  align="right" >Tipo de discapacidad: </td>
        <td >
          <select name="cbTipo_discapacidad" class="tablaborde_shadow" id="cbTipo_discapacidad" title="Tipo de discapacidad - Seleccione solo una opcion del listado" <? if($_POST['edit']=="1"){ $disabled='disabled';} echo $disabled;?>>
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadTipo_discapacidad($conn); print $GLOBALS['sHtml_cb_Tipo_discapacidad'];?>
          </select>
          <span class="requerido">* </span></td>
      </tr>
	    <tr id="tr_Grado_discapacidad">
        <td align="right">Grado de discapacidad: </td>
        <td >
          <select name="cbDiscapacidad_nivel" class="tablaborde_shadow" id="cbDiscapacidad_nivel" title="Grado de discapacidad - Seleccione solo una opcion del listado">
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadDiscapacidad_nivel($conn); print $GLOBALS['sHtml_cb_Discapacidad_nivel'];?>
          </select>
          <span class="requerido">* </span></td>
      </tr>
	    <tr>
	      <td ><div align="right">¿Es jefe de hogar?:</div></td>
	      <td><select name="cbJefe_familia" class="" id="cbJefe_familia" title="Es jefe de hogar - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbJefe_familia'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbJefe_familia'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>
	      </tr>
	    <tr>
	      <td><div align="right">¿Tiene hijos?:</div></td>
	      <td><select name="cbHijos" class="" id="cbHijos" title="Tiene hijos - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbHijos'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbHijos'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>
	      </tr>
	    <tr id="cantidad_hijos">
	      <td ><div align="right" >¿Cu&aacute;ntos menores de 18?</div></td>
	      <td><input name="hijos_menores" type="text" class="" id="hijos_menores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_menores']?>" size="5" maxlength="2" title="Cantidad de hijos menores - Ingrese solo numeros "/></td>
	      </tr>
	    <tr id="cantidad_hijos1">
	      <td><div align="right" >¿Cu&aacute;ntos mayores de 18?</div></td>
	      <td><input name="hijos_mayores" type="text" class="" id="hijos_mayores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_mayores']?>" size="5" maxlength="2" title="Cantidad de hijos mayores - Ingrese solo numeros "/></td>
	      </tr>
	      <td ><div align="right">Tipo de veh&iacute;culo que posee: </div></td>
	      <td><select name="cbVehiculo_afiliado" class="" id="cbVehiculo_afiliado" title="Tipo de vehiculo que posee- Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <? LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];?>
	        </select>
	        <span class="requerido"> *</span></td>
	      </tr>	  	      
	    <tr>
	      <td  colspan="2" ><div align="center">
	        <div align="center"><span class="requerido">
	          <button type="button" name="Continuar"  id="Continuar" class="button"  onClick="javascript:send('Continuar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
	          </span></div>
	        </div>
            </td>
             <? } ?>
	      <td>&nbsp;</td>
    </table>
</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
	//echo 'showFooter';
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }

?> 
</div>
<?php // include('../footer.php'); ?>

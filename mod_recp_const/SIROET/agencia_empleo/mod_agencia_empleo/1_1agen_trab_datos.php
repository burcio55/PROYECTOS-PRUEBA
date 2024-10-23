<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
session_start();
include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
unset($_SESSION['disc_bloq']);
//echo "RUTA FISICA ARCHIVO_".$_SERVER['PHP_SELF'];
/*CABLE TEMPORAL*/
//$_SESSION['captcha']='1912';
//$_SESSION['id_afiliado']='3';
//$_SESSION['ced_afiliado']= 'V17059762';
//$_SESSION['nombre_afiliado']=  'SHIRA NAYESKA';
//$_SESSION['apellido_afiliado']='MENDOZA ZERPA';
//$_SESSION['tipo_usuario']= '2'  ;
//$_SESSION['usuario']= 'SHIRA NAYESKA MENDOZA ZERPA CI: V17059762' ;
//$_SESSION['sUnidadSustantiva' ]= '0';
//$_SESSION['tipo_persona' ]= 'V';
//$_SESSION['sUsuario']= '17059762' ;
//$_SESSION['sesiones']= '1111110';
var_dump($_SESSION);


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
			
			case 'Cancelar_red': 
				LoadData($conn,false);
			break;
			
			case 'Continuar': 
			$bValidateSuccess=true;	
				 
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
				 
			if ($_POST['cbredes_sociales']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Posee redes sociales: es requerido.";
					$bValidateSuccess=false;
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
					 
			
			if ($_POST['cbVehiculo_afiliado']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Posee Vehiculo: es requerido."; 
					$bValidateSuccess=false;
					 }	
					 
			if ($_POST['cbredes_sociales']=='0' and $_SESSION['existe_redes']=='1'){  
				$GLOBALS['aPageErrors'][]= "- Usted a indicado que no posee Redes Sociales debe eliminar las ya agregadas o indicar que si posee.";
				$bValidateSuccess=false;
			}

			if ($_POST['cbredes_sociales']=='1' and $_SESSION['existe_redes']=='2'){  
				$GLOBALS['aPageErrors'][]= "- Usted a indicado que si posee Redes Sociales debe agregarlas o indicar que no posee.";
				$bValidateSuccess=false;
			}
									
				if ($bValidateSuccess){		
				$_POST['accionI']='4';				
					ProcessForm($conn);
					}
			
			LoadData($conn,true);	
			break;
			
			case 'Agrega_red': 
			$bValidateSuccess=true;	
										 
			if ($_POST['cbred_social']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Red social: es requerida.";
					$GLOBALS['ids_elementos_validar'][]='cbred_social';
					$bValidateSuccess=false;
					 }
			else{
			    if ($_POST['redes_sociales']==''){
					$GLOBALS['aPageErrors'][]= "- La direccion de la Red Social: es requerido.";
					$GLOBALS['ids_elementos_validar'][]='redes_sociales';
					$bValidateSuccess=false;
				   }
				  }
				   
		    if ($bValidateSuccess){	
			var_dump($_POST['accionC']);
				if($_POST['accionC']=='') $_POST['accionC']='3';		
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
					$aDefaultForm['redes_sociales']='';
					$aDefaultForm['cbred_social']='-1';
					$aDefaultForm['cbredes_sociales']='-1';
					$aDefaultForm['cbVehiculo_afiliado']='-1';
					$aDefaultForm['observacion_datos_per']=''; 
					$aDefaultForm['cbDiscapacidad_afiliado']='-1';
					$aDefaultForm['cbJefe_familia']='-1';  
					$aDefaultForm['cbHijos']='-1'; 
					$aDefaultForm['ingreso_familiar']=''; 
					$aDefaultForm['hijos_menores']='';
					$aDefaultForm['hijos_mayores']='';
					
				
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
		if ($_GET['accionC']!='') $_POST['accionC']=$_GET['accionC'];
		if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];
		if ($_POST['accionC']=='1'){	
				//$_POST['Nuevo_herramienta']='';
				$SQL="SELECT persona_redes_sociales.id,persona_redes_sociales.redes_sociales_id,persona_redes_sociales.nombre
				from persona_redes_sociales 
				INNER JOIN personas ON personas.id=persona_redes_sociales.persona_id 
				INNER JOIN redes_sociales ON redes_sociales.id=persona_redes_sociales.redes_sociales_id 
				where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' and persona_redes_sociales.id ='".$_POST['id_po']."'";
				$rs = $conn->Execute($SQL);
				if ($rs->RecordCount()>0){	
				$aDefaultForm['cbred_social']=$rs->fields['redes_sociales_id'];
				$aDefaultForm['redes_sociales']=$rs->fields['nombre'];
				}
			}	
//----------------redes sociales  DELETE------------------------------------------------				
			if ($_POST['accionC']=='2'){
				$sql="delete  from persona_redes_sociales 
				where id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' ";  
				$rs= $conn->Execute($sql);	
				unset($_POST['id_po']);	 
				unset($_POST['accionC']);	 
				
			 //Trazas-------------------------------------------
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='7';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
			}

		
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
			$aDefaultForm['cbredes_sociales']=$rs1->fields['posee_red_social'];
			$aDefaultForm['cbVehiculo_afiliado']=$rs1->fields['tipo_vehiculo_id'];
			$aDefaultForm['observacion_datos_per']=$rs1->fields['observaciones']; 
			$aDefaultForm['cbDiscapacidad_afiliado']=$rs1->fields['discapacidad'];
			$aDefaultForm['cbJefe_familia']=$rs1->fields['jefe_fam']; 
			$aDefaultForm['cbHijos']=$rs1->fields['hijos'];
			//$aDefaultForm['ingreso_familiar']=$rs1->fields['ingreso_fam'];
			$aDefaultForm['hijos_menores']=$rs1->fields['hijos_menores'];
			$aDefaultForm['hijos_mayores']=$rs1->fields['hijos_mayores'];	
			//$aDefaultForm['cbmision_beneficio_educacion']=$rs1->fields['mision_educacion_beneficio'];
			/*$aDefaultForm['cbMisiones_Educacion']=$rs1->fields['mision_educacion_id'];		
			$aDefaultForm['cbmision_beneficio_social']=$rs1->fields['mision_social_beneficio'];
			$aDefaultForm['cbMisiones_social']=$rs1->fields['mision_social_id'];*/
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
			$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_nacimiento_id']; ?>" }, 
			function(data){ $("#cbEstado_nac_afiliado").html(data);
				 });            
			});
			
			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['pais_residencia_id']; ?>";
			combo="Estado";
			$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_residencia']; ?>" }, 
			function(data){ $("#cbEstado_afiliado").html(data);
				 });            
			});
				
			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['estado_residencia']; ?>";
			combo="Municipio";
			$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['municipio_id']; ?>" }, 
			function(data){ $("#cbMunicipio_afiliado").html(data);
				 });            
			});
				
			$(document).ready(function(){
			elegido="<?php echo $rs1->fields['municipio_id']; ?>";
			combo="Parroquia";
			$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['parroquia_id']; ?>" },
			function(data){  $("#cbParroquia_afiliado").html(data);
				 });            
			});
			</script>
			<?php
					//--------------------TABLA COMPUTACION------------------------------------------------------------------------------------		
		unset($_SESSION['aTabla']);
			$SQL1="select persona_redes_sociales.id,redes_sociales.nombre, persona_redes_sociales.nombre as direccion, personas.sesiones
					from persona_redes_sociales 
					INNER JOIN personas ON personas.id=persona_redes_sociales.persona_id 
					INNER JOIN redes_sociales ON redes_sociales.id=persona_redes_sociales.redes_sociales_id 
					where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				
				if ($rs1->RecordCount()>0){	
				//$_POST['cbredes_sociales']="1";
					$aTabla=array();
					while(!$rs1->EOF){
						$c = count($aTabla);  
						$aTabla[$c]['id']=$rs1->fields['id']; 
						$aTabla[$c]['red_social']=$rs1->fields['nombre'];	
						$aTabla[$c]['direccion']=$rs1->fields['direccion'];
						$_SESSION['sesiones']=$rs1->fields['sesiones'];
						$rs1->MoveNext();
						 }
			$_SESSION['aTabla'] = $aTabla;	
			$_SESSION['existe_redes']= 1;		
				}else{
			$_SESSION['existe_redes']= 2;										
		}
					
							
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
					$aDefaultForm['cbredes_sociales']=$_POST['cbredes_sociales'];
					$aDefaultForm['cbVehiculo_afiliado']=$_POST['cbVehiculo_afiliado'];
					$aDefaultForm['observacion_datos_per']=$_POST['observacion_datos_per']; 
					$aDefaultForm['cbDiscapacidad_afiliado']=$_POST['cbDiscapacidad_afiliado'];
					$aDefaultForm['cbTipo_discapacidad']=$_POST['cbTipo_discapacidad'];					
					$aDefaultForm['cbJefe_familia']=$_POST['cbJefe_familia'];
					$aDefaultForm['cbHijos']=$_POST['cbHijos'];
					$aDefaultForm['hijos_menores']=$_POST['hijos_menores'];
					$aDefaultForm['hijos_mayores']=$_POST['hijos_mayores'];
					
					
				?>	
				<script language="javascript" src="../js/jquery.js">
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbPais_nac_afiliado']; ?>";
				combo="Estado_nac";
				$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbEstado_nac_afiliado']; ?>" }, 
				function(data){ $("#cbEstado_nac_afiliado").html(data);
				});            
				});
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbPais_afiliado']; ?>";
				combo="Estado";
				$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbEstado_afiliado']; ?>" }, 
				function(data){ $("#cbEstado_afiliado").html(data);
				});            
				});
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbEstado_afiliado']; ?>";
				combo="Municipio";
				$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbMunicipio_afiliado']; ?>" }, 
				function(data){ $("#cbMunicipio_afiliado").html(data);
				});            
				});
				
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbMunicipio_afiliado']; ?>";
				combo="Parroquia";
				$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbParroquia_afiliado']; ?>" },
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
		////agregar red social
		if ($_POST['accionC']=='1'){		
			$sql="update persona_redes_sociales set 
			redes_sociales_id='".$_POST['cbred_social']."',
			nombre='".$_POST['redes_sociales']."', 
			updated_at='".$sfecha."',
			status='A',
			id_update='".$_SESSION['sUsuario']."'
			WHERE id='".$_POST['id_po']."' and persona_id= '".$_SESSION['id_afiliado']."' "; 	
			$conn->Execute($sql);	
			?><script>alert("- Se actualizo el registro de Red Social correctamente"); 
				    document.location='?menu=11'</script><?
			}
		if ($_POST['accionC']=='3'){	
	 //----------------------------------------------verifica si existe-----------------------------
	 $SQL2="
	 SELECT id, persona_id, redes_sociales_id,
	  nombre
	  FROM persona_redes_sociales
	  where persona_id  ='".$_SESSION['id_afiliado']."'
	  and redes_sociales_id = '".$_POST['cbred_social']."'";
	   
	$rs = $conn->Execute($SQL2);
			if ($rs->RecordCount()>0){	
					$existe='1';
					?><script>alert("- Ya existe un registro con esta Red Social"); 
				    document.location='?menu=11'</script><?
			}
			else{	
				$sql="update personas set 
				posee_red_social='".$_POST['cbredes_sociales']."',
				updated_at='".$sfecha."',
				status='A',
				id_update='".$_SESSION['sUsuario']."'
				WHERE id= '".$_SESSION['id_afiliado']."' "; 	
				$conn->Execute($sql);	
								
				$sql1="insert into public.persona_redes_sociales
				( persona_id, redes_sociales_id, nombre, created_at, status, id_update) values
				('".$_SESSION['id_afiliado']."',
				 '".$_POST['cbred_social']."',
				 '".$_POST['redes_sociales']."', 
				 '$sfecha',
				 'A',
				 '".$_SESSION['sUsuario']."')";	
				 $conn->Execute($sql1);
				?><script>alert("- Se agrego el registro de Red Social correctamente"); 
				    document.location='?menu=11'</script><?
			}
	}
		 $_POST['accionI']='4';		
		 if ($_POST['accionI']=='4'){	
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
				  posee_red_social='".$_POST['cbredes_sociales']."',
				  jefe_fam = '".$_POST['cbJefe_familia']."',
				  hijos= '".$_POST['cbHijos']."',
				  hijos_menores = '".$_POST['hijos_menores']."', 
				  hijos_mayores = '".$_POST['hijos_mayores']."', 				
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
			/*if($_POST['cbEstado_nac_afiliado']==$_POST['cbEstado_afiliado']){
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
				   }*/
			//mod_dicapacidad
			//echo $_POST['cbDiscapacidad_afiliado'];
			if($_POST['cbDiscapacidad_afiliado']==0){
			   $_SESSION['disc_bloq']=1;
			   }
			else{
			    unset($_SESSION['disc_bloq']);
				}	
			
		//	}
			if($_SESSION['tipo_usuario']==2){						
   				//echo "<h1>AQUIIII 1</h1>";
			  /* if ($_SESSION['disc_bloq']==1){
			   	  ?><script>
					//document.location='1_3agen_trab_discapacidad.php'
					document.location='index.php?menu=12'
					
					</script>
			   
			   <? 
				   }
				else{
					//echo "<h1>AQUIIII 2</h1>";
			       ?><script>
				   //document.location='1_16agen_trab_datos_interes.php'
				  // document.location='index.php?menu=12'
					 document.location='index.php?menu=13'
					</script><? 
				   }
	  			
			
			
			}
			else{*/
				//echo "<h1>AQUIIII 3</h1>";
			if($_POST['cbDiscapacidad_afiliado']==1){
			   ?>
				<script>
					//1_16agen_trab_discapacidad.php
					 document.location='index.php?menu=13'
				</script>
				<? 
			   }
			   else{				
				?>
				<script>
					//1_16agen_trab_datos_interes.php
					 document.location='index.php?menu=12'
				</script>
				<? 
			   }
			}
	}
	LoadData($conn,false);	
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
//include('menu_trabajador.php'); 
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="frm_trabajador" method="post" action="" >

<script>

//Estado nacimiento
$(document).ready(function(){
   $("#cbPais_nac_afiliado").change(function () {
           $("#cbPais_nac_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Estado_nac';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
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
	function send2(saction){
	      	if(saction=='Agrega_red'){
		   			if(validar_redes()==true){
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
     <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
      <input name="accionC" type="hidden" value="<?=$_POST['accionC']?>" />
  <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
	  <tr>
       	<td height="25"></td>
      </tr>
		
        	<th colspan="3" class="titulo">DATOS PERSONALES</th>
        </tr>
	    <tr>
	      <th colspan="2" height="19" class="sub_titulo" align="left">Informaci&oacute;n Personal </th>
      </tr>
      <tr align="center" >
	      <th colspan="2"  ><strong>Nombre y Apellido: <?=$aDefaultForm['nombre_afiliado'].' '.$aDefaultForm['apellido_afiliado']?></strong></th>
	      </tr>
      <tr align="center">
	      <th colspan="2"><strong>C&eacute;dula: <?=$_SESSION['ced_afiliado']?></strong></th>
	      </tr>
      <tr align="center">
      	 <th colspan="2" ><strong>Nacionalidad: <?=$aDefaultForm['cbNacionalidad_afiliado']?></strong></th>
	    </tr>
      <tr align="center" >
	      <th colspan="2"><strong> Sexo: <? if (($aDefaultForm['cbSexo_afiliado'])=='1') echo 'Femenino';
												 if (($aDefaultForm['cbSexo_afiliado'])=='2') echo 'Masculino';?></strong></th>
	      </tr>
      <tr align="center" >
	      <th colspan="2" ><strong>Fecha nacimiento: <?=$aDefaultForm['fnacimiento_afiliado']?></strong></th>
	      </tr>
      <tr align="center">
   
        <th colspan="2" ><strong>Edad: <?=$aDefaultForm['edad']?></strong></th>
	      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Estado civil: </div></td>
	      <td width="61%"><select name="cbEstado_Civil_afiliado" class="" id="cbEstado_Civil_afiliado" title="Estado civil - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <? LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; ?>
	        </select>
	        <span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Pa&iacute;s de nacimiento: </div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbPais_nac_afiliado" id="cbPais_nac_afiliado" class="" title="Pais de nacimiento - Seleccione solo una opcion del listado">
	          <option value="-1" selected="selected">Seleccione...</option>
	          <? LoadPais_nac_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_nac_afiliado']; ?>
          </select>
	        </span><span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td ><div align="right" class="">Estado de nacimiento: </div></td>
	      <td><select name="cbEstado_nac_afiliado" id="cbEstado_nac_afiliado" title="Estado de nacimiento - Seleccione solo una opcion del listado" >
	        <option value="-1">Seleccionar</option>
	        </select><span class="requerido"> *</span></td>
      </tr>	  
	    <tr>
	      <th colspan="3" height="25" class="sub_titulo" align="left">Direcci&oacute;n de Habitaci&oacute;n </th>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Pa&iacute;s de residencia:</div></td>
	      <td><select name="cbPais_afiliado" id="cbPais_afiliado" class="" title="Pais de residencia - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <? LoadPais_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Pais_afiliado']; ?>
	        </select>
	        <span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Estado:</div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbEstado_afiliado" id="cbEstado_afiliado" class="" title="Estado - Seleccione solo una opcion del listado">
	          <option value="-1">Seleccionar</option>
          </select>
	        </span><span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Municipio:</div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbMunicipio_afiliado" id="cbMunicipio_afiliado" class="" title="Municipio - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
          </select>
	        </span><span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Parroquia:</div></td>
	      <td><span class="links-menu-izq">
	        <select name="cbParroquia_afiliado" id="cbParroquia_afiliado" class="" title="Parroquia - Seleccione solo una opcion del listado">
	          <option value="">Seleccionar</option>
          </select>
	        </span><span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Sector:</div></td>
	      <td><input name="sector_afiliado" type="text" class="" id="sector_afiliado" value="<?=$aDefaultForm['sector_afiliado']?>" size="50" maxlength="50" title="Sector - Ingrese letras y/o numeros" />
	        <span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Direcci&oacute;n: </div></td>
	      <td><input name="direccion_afiliado" type="text" class="" id="direccion_afiliado" value="<?=$aDefaultForm['direccion_afiliado']?>" onkeyup="mayusculas(this);" size="50" maxlength="100" title="Direccion - Ingrese letras y/o numeros" />
	        <span class="requerido"> *</span></td>
      </tr>
	
	    <tr>
	      <th colspan="3" height="25" class="sub_titulo" align="left">Otra Ubicaci&oacute;n</th>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Tel&eacute;fono:</div></td>
	      <td><input name="telefono_afiliado" type="text" class="" id="telefono_afiliado" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['telefono_afiliado']?>" size="20" maxlength="11" title="Telefono - Ingrese solo 11 numeros" placeholder="Ej. 02121234567" />
	        <span class="requerido"> * </span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">Otro tel&eacute;fono:</div></td>
	      <td><input name="otro_telefono_afiliado" type="text" class="" id="otro_telefono" onKeyPress="return permite(event, 'num')"  value="<?=$aDefaultForm['otro_telefono_afiliado']?>" size="20" maxlength="11" title="Telefono - Ingrese solo 11 numeros" placeholder="Ej. 02121237890"/></td>
      </tr>
	    <tr>
	      <td height="25"><div align="right" class="">Correo electr&oacute;nico:</div></td>
	      <td><input name="email_afiliado" type="text" class="" id="email_afiliado" value="<?=$aDefaultForm['email_afiliado']?>" size="30" maxlength="30"  placeholder="Ej. juancito@gmail.com" title="Correo electronico - Ejemplo: juancito@gmail.com"/>  <span class="requerido"> * </span></td>
      </tr>
	    <tr>
	      <td width="39%" height="25"><div align="right" class="">¿Posee Redes Sociales:?</div></td>
	      <td><select name="cbredes_sociales" class="" id="cbredes_sociales" title="Tiene Redes Sociales - Ejemplo:  Facebook, Instagram, Twitter, Snapchat, Tumblr, Flickr, Meetic, Spotify, YouTube, Telegram">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbredes_sociales'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbredes_sociales'])=='0') print 'selected="selected"';?>>No</option>
	        </select><span class="requerido"> *</span></td>
      </tr> 
           <tr id="tr_redes_sociales">
                <td ><div align="right" >Redes Sociales:</div></td>
             <td>
          <select name="cbred_social" class="tablaborde_shadow" id="cbred_social" title="Redes Sociales - Seleccione solo una opcion del listado e indique el nombre de la red Social">
            <option value="-1" selected="selected">Seleccione</option>
            <? LoadRedes_Sociales($conn); print $GLOBALS['sHtml_cbred_social'];?>
          </select> <span class="requerido">* </span ><input name="redes_sociales" type="text" class="" id="redes_sociales" value="<?=$aDefaultForm['redes_sociales']?>" size="30" maxlength="30" /><img src="imagenes/redes.png" width="125" height="24" title="Redes Sociales - Ejemplo:  Facebook, Instagram, Twitter, Snapchat, Tumblr, Flickr, Meetic, Spotify, YouTube, Telegram" /></td> 
           <tr id="tr_redes_sociales1">
          <td colspan="2" align="center"><span class="requerido">
          <? if($_POST['accionC']=="1"){ ?>
          <button type="button" name="Actualizar"  id="Actualizar" class="button"  onClick="javascript:send2('Agrega_red');">Actualizar</button>
          <? }
          else{ ?>
          <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send2('Agrega_red');">Agregar</button>
          </span>
          <? }?>
          <span class="requerido">
          <button type="button" name="Cancelar2"  id="Cancelar2" class="button"  onclick="javascript:send('Cancelar_red');">Cancelar</button>
          </span>
          </td>
          </tr>  
          <tr > 
          <td colspan="2">
                <table  border="0" align="center" class="listado formulario" id="tblDetalle" style="width:60%; ">
                <tr align="center">
                <th class="labelListColumn">Red Social</th>
                <th class="labelListColumn">Dirección</th>
                <th class="labelListColumn">Acciones</th>
                </tr>
                <?
                $aTabla=$_SESSION['aTabla'];
                $aDefaultForm = $GLOBALS['aDefaultForm'];
                for( $i=0; $i<count($aTabla); $i++){
                if (($i%2) == 0) $class_name = "dataListColumn2";
                else $class_name = "dataListColumn";
                ?>
                <tr class="<?=$class_name?>">
                <td class="texto-normal"><div align="left">
                <?=$aTabla[$i]['red_social']?>
                </div></td>
                <td class="texto-normal"><div align="left">
                <?=$aTabla[$i]['direccion']?>
                </div></td>
                <td class="texto-normal" align="center"><a href="?menu=11&id_po=<?=$aTabla[$i]['id']?>&accionC=1"><img src="imagenes/pencil_16.png"  border="0" title="Editar" /></a> <a href="?menu=11&id_po=<?=$aTabla[$i]['id']?>&accionC=2"><img src="imagenes/delete_16.png"  border="0" title="Eliminar" /></a> </td>
                </tr>                
                <? } ?>
                </table>    
      </td> 
      </tr> 
      <tr>
	      <th colspan="2" height="25" class="sub_titulo" align="left">Otra informaci&oacute;n</th>
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
	    <tr>
	      <td ><div align="right" class="">¿Es jefe de hogar?:</div></td>
	      <td><select name="cbJefe_familia" class="" id="cbJefe_familia" title="Es jefe de hogar - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbJefe_familia'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbJefe_familia'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>
      </tr>
	    <tr>
	      <td ><div align="right" class="">¿Tiene hijos?:</div></td>
	      <td><select name="cbHijos" class="" id="cbHijos" title="Tiene hijos - Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbHijos'])=='1') print 'selected="selected"';?>>Si</option>
	        <option value="0" <? if (($aDefaultForm['cbHijos'])=='0') print 'selected="selected"';?>>No</option>
	        </select>
	        <span class="requerido"> *</span></td>
      </tr>
	    <tr id="cantidad_hijos">
	      <td ><div align="right" class="">¿Cu&aacute;ntos menores de 18?</div></td>
	      <td><input name="hijos_menores" type="text" class="" id="hijos_menores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_menores']?>" size="5" maxlength="2" title="Cantidad de hijos menores - Ingrese solo numeros "/></td>
      </tr>
	    <tr id="cantidad_hijos1">
	      <td ><div align="right" class="">¿Cu&aacute;ntos mayores de 18?</div></td>
	      <td><input name="hijos_mayores" type="text" class="" id="hijos_mayores" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['hijos_mayores']?>" size="5" maxlength="2" title="Cantidad de hijos mayores - Ingrese solo numeros "/></td>
      </tr>	    
	    <tr>
	      <td ><div align="right" class="">Tipo de veh&iacute;culo que posee: </div></td>
	      <td><select name="cbVehiculo_afiliado" class="" id="cbVehiculo_afiliado" title="Tipo de vehiculo que posee- Seleccione solo una opcion del listado">
	        <option value="-1" selected="selected">Seleccione...</option>
	        <? LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];?>
	        </select>
	        <span class="requerido"> *</span></td>
      </tr>	    
	      <td ><div align="right" class="">Observaciones generales: </div></td>
	      <td><input name="observacion_datos_per" type="text" class="" id="observacion_datos_per" value="<?=$aDefaultForm['observacion_datos_per']?>" size="50" onkeyup="mayusculas(this);"  maxlength="100" title="Observaciones- Ingrese letras y/o numeros" /></td>
	      </tr>
	    <tr>
	    </tr>
	    <tr>
	      <td colspan="2" align="center">
	        <div align="center"><span class="requerido">
	          <button type="button" name="Continuar"  id="Continuar" class="button"  onClick="javascript:send('Continuar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
	          </span></div>
          </td>
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

<?php //include('../footer.php'); ?>

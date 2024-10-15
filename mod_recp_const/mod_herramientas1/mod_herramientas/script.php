<?php 
ini_set('max_execution_time','30000000000000');
ini_set("display_errors",1);
ini_set("error_reporting","E_ALL");

		
		include("../../include/header.php");
		$settings['debug'] = true;
		$conn= getConnDB($db4);
		$conn->debug = $settings['debug'];
		
		$conn2 = &ADONewConnection($target);
		$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
		$conn2->debug = $settings['debug'];

		$SQLsigefirrhh =   "SELECT personal.id_personal,
								personal.cedula,
								personal.primer_apellido,
								personal.segundo_apellido,
								personal.primer_nombre,
								personal.segundo_nombre,
								personal.fecha_nacimiento, 
								personal.nacionalidad,
								personal.sexo,
								trabajador.fecha_ingreso,
								trabajador.cod_tipo_personal
								FROM personal
								INNER JOIN  trabajador on trabajador.id_personal = personal.id_personal
						        WHERE trabajador.estatus ='A';";
		$resultado_set=$conn2->Execute($SQLsigefirrhh);	

while(!$resultado_set->EOF){
		$sql= "SELECT cedula
 			 FROM public.personales
			 where cedula='".$resultado_set->fields["cedula"]."'";
			$resultado_2=$conn->Execute($sql);	

if($resultado_2->RecordCount()==0){
	   $cedula					= $resultado_set->fields["cedula"];
	   $estatus 				= 1;
	   $primer_apellido			= $resultado_set->fields["primer_apellido"];
	   $segundo_apellido		= $resultado_set->fields["segundo_apellido"];
	   $primer_nombre			= $resultado_set->fields["primer_nombre"];
	   $segundo_nombre			= $resultado_set->fields["segundo_nombre"];
	   $fecha_nacimiento		= $resultado_set->fields["fecha_nacimiento"];
	   $nacionalidad			= ($resultado_set->fields["nacionalidad"]=='V')?'1':'2';
	   $sexo				    = ($resultado_set->fields["sexo"]=='F')?'1':'2'; 
	   $fecha_ingreso			= $resultado_set->fields["fecha_ingreso"];
	   $cod_tipo_personal		= $resultado_set->fields["cod_tipo_personal"];
	 
echo $SQL= "INSERT INTO personales(
				nacionalidad,
				cedula, 
				primer_apellido,
				segundo_apellido, 
				primer_nombre, 
				segundo_nombre, 
				fecha_nacimiento, 
				fecha_ingreso,
				sexo,
				usuario_idcreacion,
				dfecha_creacion,
				nenabled)
			VALUES (
				'".$nacionalidad."',
				'".$cedula."',
				$$".$primer_apellido."$$,
				$$".$segundo_apellido."$$,
				$$".$primer_nombre."$$,
				$$".$segundo_nombre."$$,
				'".$fecha_nacimiento."',
				'".$fecha_ingreso."',
				'".$sexo."',
				'".$_SESSION['id_usuario']."',
				'".date("Y-m-d H:i:s")."',
				'1');";
	$rs= $conn->Execute($SQL);
	
	$tiportrabajadores = array(20, 25, 28, 29, 32, 33);

			$rolacceso =(in_array($cod_tipo_personal, $tiportrabajadores)) ? 28:11;

		$SQL1= "INSERT INTO public.personales_rol (personales_cedula, rol_id,dfecha_caducidad, nenabled,nusuario_creacion,dfecha_creacion) VALUES(".$cedula.", ".$rolacceso.",'2021-12-31','1','".$_SESSION['id_usuario']."','".date('Y-m-d H:i:s')."')";
		$rs1= $conn->Execute($SQL1);
			
		$SQL11= "INSERT INTO public.sesion (personales_cedula, clave, dfecha_creacion, nusuario_creacion, nenabled, nestatus) VALUES(".$cedula.", '".md5($cedula)."', '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."','1','1')";
	$rs11= $conn->Execute($SQL11);
	}
	$resultado_set->MoveNext();
   
    }
	

?>



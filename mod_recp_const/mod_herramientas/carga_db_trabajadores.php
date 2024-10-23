<?php 
ini_set('max_execution_time','30000000000000');
include("../../header.php"); 
ini_set("display_errors",0);
ini_set("error_reporting","E_ALL");

/*$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
echo $db1;*/
//Variables Globales Array 

// Llamar funciones


    if(isset($_POST['action'])){
		
		include("../header.php");
		$settings['debug'] = true;
		$conn= getConnDB($db4);
		$conn->debug = $settings['debug'];
		pg_set_client_encoding($conn, "UNICODE");
		
		$conn2 = &ADONewConnection($target);
		$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
		$conn2->debug = $settings['debug'];
		pg_set_client_encoding($conn2, "UNICODE");

		$SQLsigefirrhh =   "SELECT personal.id_personal,
personal.cedula,
personal.primer_apellido,
personal.segundo_apellido,
personal.primer_nombre,
personal.segundo_nombre,
personal.fecha_nacimiento, 
personal.nacionalidad,
personal.id_ciudad_nacimiento,
ciudad.nombre,
personal.numero_rif,
personal.sexo,
trabajador.fecha_ingreso,
trabajador.fecha_ingreso_apn,
trabajador.cod_tipo_personal
FROM personal
INNER JOIN  trabajador on trabajador.id_personal = personal.id_personal
inner join  ciudad on ciudad.id_ciudad = personal.id_ciudad_nacimiento
						        WHERE trabajador.estatus  in ('A','E') order by trabajador.id_trabajador ;";// order by trabajador.fecha_ingreso DESC AND personal.cedula NOT IN ('".$resultado_set->fields['cedula']."'
		$resultado_set=$conn2->Execute($SQLsigefirrhh);	
			
$i=0;
while(!$resultado_set->EOF){
		$sql= "SELECT cedula
 			 FROM public.personales
			 where cedula='".$resultado_set->fields["cedula"]."' and nenabled='1'";
			$resultado_2=$conn->Execute($sql);	
	//if ($resultado_set->RecordCount()>0){
	//	echo "fsdfsd".$resultado_2->RecordCount();

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
	   $fecha_ingreso_adm		= $resultado_set->fields["fecha_ingreso_apn"];
	   $numero_rif		        = $resultado_set->fields["numero_rif"];
	   $id_ciudad_nacimiento	= $resultado_set->fields["id_ciudad_nacimiento"];	   
	   $cod_tipo_personal		= $resultado_set->fields["cod_tipo_personal"];
	   $tiportrabajadores = array(20, 25, 28, 29, 32, 33);
	   	$rolacceso =(in_array($cod_tipo_personal, $tiportrabajadores)) ? 28:11:86;
	   
if($resultado_2->RecordCount()==0){
 $SQL= "INSERT INTO personales(
				nacionalidad,
				cedula, 
				primer_apellido,
				segundo_apellido, 
				primer_nombre, 
				segundo_nombre, 
				fecha_nacimiento, 
				fecha_ingreso,
				sexo,
				fecha_ingreso_adm,
				srif,
				id_ciudad
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
				'".$fecha_ingreso_adm."',
				'".$numero_rif."',
				'".$id_ciudad_nacimiento."',
				'".$_SESSION['id_usuario']."',
				'".date("Y-m-d H:i:s")."',
				'1');";
	$rs= $conn->Execute($SQL);
	

		

		$SQL1= "INSERT INTO public.personales_rol (personales_cedula, rol_id,dfecha_caducidad, nenabled,nusuario_creacion,dfecha_creacion) VALUES(".$cedula.", ".$rolacceso.",'2023-12-31','1','".$_SESSION['id_usuario']."','".date('Y-m-d H:i:s')."')";
		$rs1= $conn->Execute($SQL1);
			
		$SQL11= "INSERT INTO public.sesion (personales_cedula, clave, dfecha_creacion, nusuario_creacion, nenabled, nestatus) VALUES(".$cedula.", '".md5($cedula)."', '".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."','1','1')";
	$rs11= $conn->Execute($SQL11);
	}
	else {
		///////////////////////////////////////////////////////////////////
	
		
		$SQL1= "UPDATE personales_rol
  		 SET rol_id=".$rolacceso.", 
      	 dfecha_actualizacion='".date('Y-m-d H:i:s')."', 
         nusuario_actualizacion='".$_SESSION['id_usuario']."'
 		 WHERE personales_cedula=".$cedula."
		";
		$rs= $conn->Execute($SQL1);
		}
		
		$i++;
$resultado_set->MoveNext();
}
	
   			?>
				<script>
//					alert("Usted ya se encuentra registrado en la base de datos de Recibo de Pago,\n Si desea una nueva contrase\u00F1a haga uso de la opci\u00F3n “Olvido Su Contrase\u00F1a”."); 
					alert("Data de Personales Actualizada."); 
				</script>
			<?php

	
	
	
//echo $filas."<br>";
	//for ($j=0; $j < $filas; $j++) { 
	//echo $j."==";
//	echo $filas;
//	echo $estatus.'<br>';
//	$cedula = pg_fetch_result($resultado_set, $j, 0);
//echo $cedula;
	  /* $cedula= pg_result($resultado_set, $j, 0);
	   $mes= pg_result($resultado_set, $j, 1);
	   $semana_quincena= pg_result($resultado_set, $j, 2);
	   $estatus= pg_result($resultado_set, $j, 3);
	   if($estatus == "A"){
	   		$estatus = 1;
        }
	  if($estatus == "E"){
	   $estatus = 2;
      }
  if($estatus == "C"){
	   $estatus = 3;
	      }
  if($estatus == "S"){
		   $estatus = 4;
	      }
		 
	
	   $id_cargo= pg_result($resultado_set, $j, 4);
	   $cod_ubicacion_adm= pg_result($resultado_set, $j, 5);
	   $cod_nomina=pg_result($resultado_set, $j, 6);
	   $cuenta_nomina= pg_result($resultado_set, $j, 7);
	   $cod_concepto= pg_result($resultado_set, $j, 8);
	   $monto= pg_result($resultado_set, $j, 9);
	   $nro_nomina=pg_result($resultado_set, $j, 10); 
	   $cod_ubicacion_adm= pg_result($resultado_set, $j, 11);
	   $cod_tipo_trabajador= pg_result($resultado_set, $j, 12);
	   $forma_pago= pg_result($resultado_set, $j, 13);*/
	   
	 /*  $SQLbuscar = "SELECT *  FROM recibos_pagos_constancias.recibo_pago 
					 WHERE personales_cedula = '".$cedula."'
					 AND nmes = '".$mes."'
					 AND nsemana_quincena = '".$semana_quincena."'
					 AND conceptos_scodigo = '".$cod_concepto."'
					 AND nanio = '".$anio."';";
	   $rsbuscar = $conn->Execute($SQLbuscar);
	   $id_rec_pag = $rsbuscar->fields['id'];
	   echo $SQLbuscar;
	   if($rsbuscar->RecordCount()>0){
			echo "ACTUALIZADO <br>";
			$sql1="UPDATE recibos_pagos_constancias.recibo_pago
					SET	personales_cedula 						= '".$cedula."', 
						nmes 									= '".$mes."', 
						nsemana_quincena 						= '".$semana_quincena."', 
						nestatus 								= '".$estatus."', 
						cargos_id 								= '".$id_cargo."', 
						ubicacion_administrativa_scodigo 		= '".$cod_ubicacion_adm."', 
						ncodigo_nomina							= '".$cod_nomina."', 
						scuenta_nomina							= '".$cuenta_nomina."', 
						conceptos_scodigo 						= '".$cod_concepto."', 
						nmonto									= '".$monto."', 
						tickets_alimentacion_ncodigo			= '".$ticket_alimentacion."',
						nnro_nomina								= '".$nro_nomina."', 
						filtro									= '".$filtro."', 
						nenabled								= '".$nenabled."', 
						dfecha_actualizacion					= '".$fecha_carga."', 
						nusuario_actualizacion					= '".$_SESSION['id_usuario']."', 
						ubicacion_fisica_scodigo				= '".$cod_ubicacion_adm."', 
						tipo_trabajador_ncodigo					= '".$cod_tipo_trabajador."', 
						nforma_pago  							= '".$forma_pago."', 
						nanio									= '".$anio."'
					WHERE id = '".$id_rec_pag."'";
			$resultado_set1 = $conn->Execute($sql1);
			$filas1 = $resultado_set1->RecordCount();
			
	    }else{*/
		/*	echo "AGREGADO <br>";
			echo $sql2="INSERT INTO recibos_pagos_constancias.recibo_pago(
							personales_cedula, 
							nmes, 
							nsemana_quincena, 
							nestatus, 
							cargos_id, 
							ubicacion_administrativa_scodigo, 
							ncodigo_nomina, 
							scuenta_nomina, 
							conceptos_scodigo, 
							nmonto, 
							tickets_alimentacion_ncodigo,
							nnro_nomina, 
							filtro, 
							nenabled, 
							dfecha_creacion, 
							nusuario_creacion, 
							ubicacion_fisica_scodigo, 
							tipo_trabajador_ncodigo, 
							nforma_pago, 
							nanio)
					VALUES ('".$cedula."',
							 '".$mes."',
							 '".$semana_quincena."',
							 '".$estatus."',
							 '".$id_cargo."',
							 '".$cod_ubicacion_adm."',
							 '".$cod_nomina."',
							 '".$cuenta_nomina."',
							 '".$cod_concepto."',
							 '".$monto."',
							 '".$ticket_alimentacion."',
							 '".$nro_nomina."',
							 '".$filtro."',
							 '".$nenabled."',
							 '".$fecha_carga."',
							 '".$_SESSION['id_usuario']."',
							 '".$cod_ubicacion_adm."',
							 '".$cod_tipo_trabajador."',
							 '".$forma_pago."',
							 '".$anio."')";*/
				 
			//$resultado_set1 = pg_Exec ($conexion1, $sql1);
		//	$resultado_set2 = $conn->Execute($sql2);
			//$filas1 = pg_NumRows($resultado_set1);
			//$filas2 = $resultado_set2->RecordCount();
			//print ($cedula."<br>");
		//}
	//}
	
	//pg_close($conexion1);
	//pg_close($conexion);
	
}
//echo $i;
?>


	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>

    
<form name="form" method="post" action="carga_db_trabajadores.php" >
	<input name="action" type="hidden" value=""/>
    <input name="usuario" type="hidden" id="usuario" value="postgres">
    <input name="db" type="hidden" id="db" value="sigefirrhh"> 
    <input name="host" type="hidden" id="host" value="10.46.1.9">
    <input name="password" type="hidden" id="password" value="" >

    <table class="formulario" width="50%" border="0" align="center">

        <tr>
        	<td colspan="2">&nbsp;</td>		
        </tr>

        <tr class="identificacion_seccion2">
            <th colspan="2" align="center" class="sub_titulo"><div align="center">CARGA DE PERSONALES_10032023</div></th>
        </tr>
        
        <tr>
        	<th colspan="2">&nbsp;</th>		
        </tr>
    
        <tr>
            <td colspan="3" class="texto-normal"  align="center"><button type="submit" class="button_personal btn_cargar"  title="Haga Click para cargar nomina">Cargar Datos</button></td>
        </tr>
    
    </table> 

<div id="loader" class="loaders" style="display: none;"></div>

</form>
	</td>
	</tr>
	</tbody>
	</table>
    


<?php include("../../footer.php"); ?>
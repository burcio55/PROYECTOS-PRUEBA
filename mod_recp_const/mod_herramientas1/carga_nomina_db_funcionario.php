<?php 
ini_set('max_execution_time','30000000000000');
include("../../header.php"); 

/*$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
echo $db1;*/
//Variables Globales Array 

debug();
showForm($conn,$aDefaultForm);
// Llamar funciones

function LoadListyear($cantidad){
	
	for($i=date("Y");$i<=date("Y")+$cantidad;$i++){
		echo "<option value='".$i."'>".$i."</option>";
	}
	
}

    if(isset($_POST['action'])){
		
		include("../header.php");
		$settings['debug'] = true;
		$conn= getConnDB($db4);
		$conn->debug = $settings['debug'];
		
		$conn2 = &ADONewConnection($target);
		//$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh_produccion2');
		$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
		$conn2->debug = $settings['debug'];
		
		
//		$usuario					= 'postgres';
//					//$db							= 'sigefirrhh_produccion2';
//		$db							= 'sigefirrhh';
//		$host						= '10.46.1.9';
//		$password					= 'postgres';
		
		
	//	$usuario					= 'recibos.pagos';
//		//$db							= 'sigefirrhh_produccion2';
//		$db							= 'sigefirrhh';
//		$host						= '10.46.1.102';
//		$password					= 'recibos*2018';
//
//
//
//		$usuario2					= 'areadesarrollo';
//		//$db						= 'sigefirrhh_produccion2';
//		$db2						= 'minpptrassi';
//		$host2						= '10.46.1.91';
//		$password2					= 'areadesarrollopasswd';
		

		
		//$anio						= $_POST['anio'];
		$anio						= '2016';
		$mes						= $_POST['mes'];
		$quincena					= $_POST['quincena'];
		$ticket_alimentacion		= $_POST['ticket'];
		
		$fecha_carga				= date("Y-m-d H:i:s");
		
		$nenabled					= 1; 
		$filtro						= 0;
	
	
	
	
	
		//$conexion2 = pg_connect("user=$usuario2 dbname=$db2 host=$host2 password=$password2");
	
	$sql= "SELECT count(*) as total
 			 FROM recibos_pagos_constancias.recibo_pago
			where nanio= '".$anio."' and nmes ='".$mes."' and nsemana_quincena= '".$quincena."'";
			$resultado_set=$conn->Execute($sql);	
					var_dump ($resultado_set->fields);	
	//$resultado_set = pg_Exec ($conexion2, $sql);	
	//print $resultado_set;
	//$filas = pg_num_rows($resultado_set);
//	var_dump ($filas);
	if ($resultado_set->fields['total']==0){
		
		
	//$conexion = pg_connect("user=$usuario dbname=$db host=$host password=$password");
	
	$sql= "select 
			trabajador.cedula, 
			historicoquincena.mes, 
			historicoquincena.semana_quincena,
			trabajador.estatus,
			trabajador.id_cargo as id_cargo,
			dependencia.cod_dependencia as cod_ubicacion_adm,
			trabajador.codigo_nomina,
			trabajador.cuenta_nomina, 
			concepto.cod_concepto,
			(CASE WHEN historicoquincena.monto_asigna = 0 THEN historicoquincena.monto_deduce ELSE historicoquincena.monto_asigna END) AS monto,
			historicoquincena.numero_nomina,
			dependencia.cod_dependencia as cod_ubicacion_fisica,
			trabajador.cod_tipo_personal,
			trabajador.forma_pago
			from historicoquincena
			inner join trabajador on historicoquincena.id_trabajador= trabajador.id_trabajador
			inner join personal on trabajador.id_personal= personal.id_personal
			inner join dependencia on trabajador.id_dependencia= dependencia.id_dependencia
			inner join cargo on trabajador.id_cargo= cargo.id_cargo
			inner join conceptotipopersonal on trabajador.id_tipo_personal= conceptotipopersonal.id_tipo_personal
			inner join tipopersonal on trabajador.id_tipo_personal= tipopersonal.id_tipo_personal
			inner join concepto on conceptotipopersonal.id_concepto= concepto.id_concepto
			where historicoquincena.id_trabajador = trabajador.id_trabajador and historicoquincena.anio = '".$anio."' and  historicoquincena.mes ='".$mes."'
			and  historicoquincena.semana_quincena = '".$quincena."'
			and trabajador.id_dependencia = dependencia.id_dependencia and trabajador.id_cargo = cargo.id_cargo
			and historicoquincena.id_concepto_tipo_personal = conceptotipopersonal.id_concepto_tipo_personal
			and concepto.id_concepto = conceptotipopersonal.id_concepto
			and  personal.id_personal = trabajador.id_personal
			order by concepto.cod_concepto";
			$resultado_set=$conn2->Execute($sql);	
	//$resultado_set = pg_Exec ($conexion, $sql);	
	//print $resultado_set;
//	$filas = pg_num_rows($resultado_set);
	
	
	
	
//	$filas = pg_NumRows($resultado_set);
//	echo $filas;

while(!$resultado_set->EOF){
	//while ($filas = pg_fetch_array($resultado_set)) {
		//$i++;
   //  var_dump($filas);
	// echo "<br>".$filas["cedula"].'-'.$i;
	 
	   $cedula					= $resultado_set->fields["cedula"];
	   $mes						= $resultado_set->fields["mes"];
	   $semana_quincena			= $resultado_set->fields["semana_quincena"];
	   $estatus					= $resultado_set->fields["estatus"];
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
	   $id_cargo				= $resultado_set->fields["id_cargo"];
	   $cod_ubicacion_adm		= $resultado_set->fields["cod_ubicacion_adm"];
	   $cod_nomina				= $resultado_set->fields["codigo_nomina"];
	   $cuenta_nomina			= $resultado_set->fields["cuenta_nomina"];
	   $cod_concepto			= $resultado_set->fields["cod_concepto"];
	   $monto					= $resultado_set->fields["monto"];
	   $nro_nomina				= $resultado_set->fields["numero_nomina"]; 
	   $cod_ubicacion_fisica	= $resultado_set->fields["cod_ubicacion_fisica"];
	   $cod_tipo_trabajador		= $resultado_set->fields["cod_tipo_personal"];
	   $forma_pago  			= $resultado_set->fields["forma_pago"];
 
//echo "AGREGADO <br>";
 // echo $sql2="INSERT INTO recibos_pagos_constancias.recibo_pago(
			 $sql2="INSERT INTO recibos_pagos_constancias.historico_recibo_pago(
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
							 '".$cod_ubicacion_fisica."',
							 '".$cod_tipo_trabajador."',
							 '".$forma_pago."',
							 '".$anio."')";
				 
			//$resultado_set1 = pg_Exec ($conexion1, $sql1);
			$resultado_set1 = $conn->Execute($sql2);
				$resultado_set->MoveNext();
   }

   			?>
				<script>
//					alert("Usted ya se encuentra registrado en la base de datos de Recibo de Pago,\n Si desea una nueva contrase\u00F1a haga uso de la opci\u00F3n “Olvido Su Contrase\u00F1a”."); 
					alert("La carga de la N\u00F3mina se ha completado exitosamente."); 
				</script>
			<?php
	}
	else {   		
	        ?>
				<script>
//					alert("Usted ya se encuentra registrado en la base de datos de Recibo de Pago,\n Si desea una nueva contrase\u00F1a haga uso de la opci\u00F3n “Olvido Su Contrase\u00F1a”."); 
					alert("La N\u00F3mina se encuentra registrada."); 
				</script>
			<?php
          }  
	
	
	
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
?>



<?php function showForm($conn,$aDefaultForm){ 
	$sqlticket = "SELECT ncodigo, nmonto FROM recibos_pagos_constancias.tickets_alimentacion WHERE nenabled = 1;";
	$rsticket = $conn->Execute($sqlticket);
	$codigo = $rsticket->fields['ncodigo'];
	$monto = $rsticket->fields['nmonto'];
?>


	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>

    <script type="text/javascript" src="validar_carga_nomina_db.js"></script>
    
<form name="form" method="post" action="carga_nomina_db_funcionario.php" >
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
            <th colspan="2" align="center" class="sub_titulo"><div align="center">CARGAR NOMINA EMPLEADOS</div></th>
        </tr>
        
        <tr>
        	<th colspan="2">&nbsp;</th>		
        </tr>
        
        <tr class="identificacion_seccion2">
            <th width="20%" class="sub_titulo"><div align="right">Año:</div></th>
            <td width="80%" style="background-color:#F0F0F0;" align="center">
                <select style="width: 95%" name="anio" class="textbox" id="anio">
                    <option value="" selected="selected" >Seleccione</option>
                    <? LoadListyear('2');?>
                </select>  
            </td>
        </tr>
    
        <tr class="identificacion_seccion2">
            <th class="sub_titulo"><div align="right">Mes:</div></th>
            <td style="background-color:#F0F0F0;" align="center">
                <select style="width: 95%" name="mes" id="mes">
                    <option value="">Seleccione</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </td>
        </tr>
      
        <tr class="identificacion_seccion2">
            <th class="sub_titulo"><div align="right">Quincena:</div></th>
            <td style="background-color:#F0F0F0;" align="center">
                <select style="width: 95%" name="quincena" id="quincena">
                    <option value="">Seleccione</option>
                    <option value="1">Primera Quincena</option>
                    <option value="2">Segunda Quincena</option>
                </select>
            </td>
        </tr>
        
        <tr class="identificacion_seccion2">
            <th class="sub_titulo"><div align="right">Ticket:</div></th>
            <td style="background-color:#F0F0F0;" align="center">
            	<input name="ticket" type="hidden" id="ticket" value="<?= $codigo?>" >
                <input type="text" style="width: 95%" name="descripcionticket" id="descripcionticket" value="<?= $monto ?>" readonly />

            </td>
        </tr>

        <tr>
        	<th colspan="2">&nbsp;</th>		
        </tr>
    
        <tr>
            <td colspan="3" class="texto-normal"  align="center"><button type="button" class="button_personal btn_cargar" onclick="javascript:send('cargar');" title="Haga Click para cargar nomina">Cargar N&oacute;mina</button></td>
        </tr>
    
    </table> 

<div id="loader" class="loaders" style="display: none;"></div>

</form>
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>
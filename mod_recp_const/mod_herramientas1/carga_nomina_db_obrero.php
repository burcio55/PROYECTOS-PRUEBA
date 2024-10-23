<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

ini_set('max_execution_time','30000000000000');

debug();
showForm($conn,$aDefaultForm);

function LoadListyear($cantidad){
	
	for($i=date("Y");$i<=date("Y")+$cantidad;$i++){
		echo "<option value='".$i."'>".$i."</option>";
	}
	
}

    if(isset($_POST['action'])){
		$usuario					= 'postgres';
		$db							= 'sigefirrhh';
		$host						= '10.46.1.9';
		$password					= 'postgres';
		
		$anio						= $_POST['anio'];
		//$anio						= '2017';
		$mes						= $_POST['mes'];
		$semana				     	= $_POST['semana'];
		$ticket_alimentacion		= $_POST['ticket'];
		
		$fecha_carga				= date("Y-m-d H:i:s");
		
		$nenabled					= 1; 
		$filtro						= 0;
	
	$conexion = pg_connect("user=$usuario dbname=$db host=$host password=$password");
	$sql= "	select trabajador.cedula,
	historicosemana.mes, 
	historicosemana.semana_quincena,
	trabajador.estatus,
	trabajador.id_cargo as id_cargo,
	dependencia.cod_dependencia as cod_ubicacion_adm,
	trabajador.codigo_nomina,
	trabajador.cuenta_nomina,
	concepto.cod_concepto,
	(CASE WHEN historicosemana.monto_asigna = 0 THEN historicosemana.monto_deduce ELSE historicosemana.monto_asigna END) AS monto,
	historicosemana.numero_nomina,
	dependencia.cod_dependencia as cod_ubicacion_fisica1,
	trabajador.cod_tipo_personal, 
	trabajador.forma_pago	
	from historicosemana
	inner join trabajador on historicosemana.id_trabajador= trabajador.id_trabajador
	inner join personal on trabajador.id_personal= personal.id_personal
	inner join dependencia on trabajador.id_dependencia= dependencia.id_dependencia
	inner join cargo on trabajador.id_cargo= cargo.id_cargo
	inner join conceptotipopersonal on 
	trabajador.id_tipo_personal=conceptotipopersonal.id_tipo_personal
	inner join tipopersonal on trabajador.id_tipo_personal= tipopersonal.id_tipo_personal
	inner join concepto on conceptotipopersonal.id_concepto= concepto.id_concepto
	where historicosemana.id_trabajador = trabajador.id_trabajador 
	and historicosemana.anio = '".$anio."'  and  historicosemana.mes ='".$mes."'
	and  historicosemana.semana_quincena = '".$semana."'
	and trabajador.id_dependencia = dependencia.id_dependencia
	and trabajador.id_cargo = cargo.id_cargo
	and  
	historicosemana.id_concepto_tipo_personal=conceptotipopersonal.id_concepto_tipo_personal
	and concepto.id_concepto = conceptotipopersonal.id_concepto
	and personal.id_personal = trabajador.id_personal
	order by  concepto.cod_concepto";
	
	$resultado_set = pg_Exec ($conexion, $sql);	
	$filas = pg_num_rows($resultado_set);
	

	echo $filas;
	echo 'no entro';
	while ($filas = pg_fetch_array($resultado_set)) {
		$i++;

	echo 'entro';
	 echo "<br>".$filas["cedula"].'-'.$i;
	 
	   $cedula					= $filas["cedula"];
	   $mes						= $filas["mes"];
	   $semana_quincena			= $filas["semana_quincena"];
	   $estatus= $filas["estatus"];
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
       $id_cargo				= $filas["id_cargo"];
	   $cod_ubicacion_adm		= $filas["cod_ubicacion_adm"];
	   $cod_nomina				= $filas["codigo_nomina"];
	   $cuenta_nomina			= $filas["cuenta_nomina"];
	   $cod_concepto			= $filas["cod_concepto"];
	   $monto					= $filas["monto"];
	   $nro_nomina				= $filas["numero_nomina"]; 
	   $cod_ubicacion_fisica1	= $filas["cod_ubicacion_fisica1"];
	   $cod_tipo_trabajador		= $filas["cod_tipo_personal"];
	   $forma_pago  			= $filas["forma_pago"];
	   
echo "AGREGADO <br>";
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
							 '".$cod_ubicacion_fisica1."',
							 '".$cod_tipo_trabajador."',
							 '".$forma_pago."',
							 '".$anio."')";
			$resultado_set1 = $conn->Execute($sql2);
			   }
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
  
 <script type="text/javascript" src="validar_carga_nomina_db_obrero.js"></script>
    
<form name="form" method="post" action="carga_nomina_db_obrero.php" >
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
            <th colspan="2" align="center" class="sub_titulo"><div align="center">CARGAR NOMINA OBREROS</div></th>
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
            <th class="sub_titulo"><div align="right">Semana:</div></th>
            <td style="background-color:#F0F0F0;" align="center">
                 <select style="width: 95%" name="semana" id="semana">
				    <option value="">Selecciona una opcion</option>
					   <?php
						$check="";
							for($i=1 ; $i<=52 ; $i++)
							{
								$check="";
								if($aDefaultForm['diadesde']==$i)
									  {
									$check="selected='selected'";
									  }
							   print "<option value='$i' '$check'>$i</option>";
							}
					   ?>
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


</form>
    
    	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>
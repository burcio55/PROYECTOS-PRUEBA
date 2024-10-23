<?php 
include("../../header.php"); 


$settings['debug'] = false;
$conn2 = &ADONewConnection($target);
//$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh_produccion2');
$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
$conn2->debug = false;

//echo $hostname_sigefirrhh;

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();


debug();
LoadData(true);

showForm($conn2,$aDefaultForm);


function LoadData($bPostBack){  
global $conn2;
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			//echo 'ñlmñlmñlm'.$_SESSION['id_usuario'];
					if(isset($_SESSION['id_usuario'])){
			        			$SQL="SELECT personal.id_personal,
									personal.primer_apellido as apellido1,
									personal.segundo_apellido as apellido2,
									personal.primer_nombre as nombre1,
									personal.segundo_nombre as nombre2, 
									personal.nacionalidad,
									personal.cedula as cedula, 
									trabajador.fecha_ingreso as fecha_ingreso,
									trabajador.estatus as estatus,
									trabajador.codigo_nomina as cod_nom,
									trabajador.cuenta_nomina as cuenta_nom,
									cargo.descripcion_cargo as cargo,
									dependencia.nombre as  ubicacion_adm,
									tipopersonal.nombre as tipo_trabajador
									FROM trabajador
									INNER JOIN personal on personal.id_personal = trabajador.id_personal
									INNER JOIN tipopersonal on tipopersonal.cod_tipo_personal = trabajador.cod_tipo_personal
									inner join cargo on trabajador.id_cargo = cargo.id_cargo
									inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
									WHERE personal.cedula= '".$_SESSION['id_usuario']."' and trabajador.fecha_egreso is null";
					$rs_1=$conn2->Execute($SQL);
					if($rs_1->RecordCount()>0){
						
					    $aDefaultForm['txt_apellido1']					  = $rs_1->fields['apellido1'];
						$aDefaultForm['txt_apellido2']					  = $rs_1->fields['apellido2'];
						$aDefaultForm['txt_nombre1']					  = $rs_1->fields['nombre1'];
						$aDefaultForm['txt_nombre2']					  = $rs_1->fields['nombre2'];
						$aDefaultForm['txt_nacionalidad']				  = $rs_1->fields['nacionalidad'];
						$aDefaultForm['txt_fecha_ingreso']				  = $rs_1->fields['fecha_ingreso'];
						$aDefaultForm['txt_estatus']					  = $rs_1->fields['estatus'];
						$aDefaultForm['txt_codigo_nom']					  = $rs_1->fields['cod_nom'];
						$aDefaultForm['txt_cuenta_nom']					  = $rs_1->fields['cuenta_nom'];																		
						$aDefaultForm['txt_cargo']						  = $rs_1->fields['cargo'];
						$aDefaultForm['txt_ubicacion_adm']				  = $rs_1->fields['ubicacion_adm'];		
						$aDefaultForm['txt_tipo_trabajador']			  = $rs_1->fields['tipo_trabajador'];				
						}
					}
     }
}
?>


<?php function showForm($conn2,$aDefaultForm){ // en esta funcion siempre va el formulario ?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
    
<table width="95%" class="tabla" height="95%">
	<tbody>
	<tr valign="top">
	<td>
	
	<form name="frm_rec_pago_consulta_ano_act" id="frm_rec_pago_consulta_ano_act" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
		<input name="action" type="hidden" value="" />
		<input name="txt_tipo_trabajador"  id="txt_tipo_trabajador" type="hidden" value="<?= $aDefaultForm['txt_tipo_trabajador']; ?>" />
		<input name="txt_codigo_tipos_trabajadores"  id="txt_codigo_tipos_trabajadores" type="hidden" value="<?= $aDefaultForm['txt_codigo_tipos_trabajadores']; ?>" />
		<input name="txt_apellido1"  id="txt_apellido1" type="hidden" value="<?= $aDefaultForm['txt_apellido1']; ?>" />
		<input name="txt_apellido2"  id="txt_apellido2" type="hidden" value="<?= $aDefaultForm['txt_apellido2']; ?>" />
		<input name="txt_nombre1"  id="txt_nombre1" type="hidden" value="<?= $aDefaultForm['txt_nombre1']; ?>" />
		<input name="txt_nombre2"  id="txt_nombre2" type="hidden" value="<?= $aDefaultForm['txt_nombre2']; ?>" />
		<input name="txt_nacionalidad"  id="txt_nacionalidad" type="hidden" value="<?= $aDefaultForm['txt_nacionalidad']; ?>" />
		<input name="txt_estatus"  id="txt_estatus" type="hidden" value="<?= $aDefaultForm['txt_estatus']; ?>" />
		<script type="text/javascript" src="validar_rec_pago_registro.js"></script>
		<script>
			function send(saction){
					var form = document.frm_vacaciones_trabajador;
					form.action.value=saction;
					form.submit();
					$("#loader").show();}
		</script>
<table width="95%" border="0" align="center" class="formulario">
			<tr>
				<th class="titulo"  colspan="4" align="center">CONSULTA DE VACACIONES</th>
			</tr>

			<tr class="identificacion_seccion">
				<th colspan="4" class="sub_titulo_3" align="left">PERFIL LABORAL</th>
			</tr> 
		
			<tr>
				<th colspan="4">&nbsp;</th>		
			</tr>
		
			<tr>
				<th width="25%"  class="sub_titulo"><div align="center">Estatus</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Fecha de Ingreso</div></th>
				<th width="25%" class="sub_titulo"><div align="center">Tipo de Trabajador</div></th>
				<th width="25%" class="sub_titulo"><div align="center">C&oacute;digo de N&oacute;mina</div></th>
			</tr> 
		
			<tr>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['txt_estatus']=='A'){echo 'ACTIVO';}else{echo 'EGRESADO';}?></font></td>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?></font></td> 
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_tipo_trabajador'];?></font></td>
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_codigo_nom'];?></font></td>
			</tr>
		
			<tr>
			<td colspan="4"> </td> 
			</tr>
		
			<tr>
				<th class="sub_titulo"><div align="center">Cuenta N&oacute;mina</div></th>
				<th colspan="3" class="sub_titulo"><div align="center">Cargo</div></th>
			</tr> 
			
			<tr>    
				<td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_cuenta_nom'];?></font></td>
				<td colspan="3" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_cargo'];?></font></td>
			</tr> 
			
			<tr>
				<td colspan="4"> </td>
			</tr>
			
			<tr>
				<th colspan="4" class="sub_titulo" align="center"><div align="center">Ubicaci&oacute;n Administrativa</div></th>
			</tr>
		
			<tr>
				<td colspan="4" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['txt_ubicacion_adm'];?></font></td>
			</tr>
			
			<tr>
				<td colspan="4"> </td>
			</tr>
			

			
			<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
			
			<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
</table>

<table width="95%" border="0" align="center" class="formulario">

			<tr>
				<th colspan="7" class="sub_titulo_3" align="center"><div align="center">DISFRUTE DE VACACIONES</div></th>
			</tr>
            
            <tr>
				<td colspan="7" style="background-color:#F0F0F0;" align="center"> </td>	
			</tr>

			<tr>
				<th width="10%"  class="sub_titulo"><div align="center">Per&iacute;odo</div></th>
                <th width="10%" class="sub_titulo"><div align="center">Fecha Inicio</div></th>
				<th width="10%" class="sub_titulo"><div align="center">Fecha Fin</div></th>
				<th width="15%" class="sub_titulo"><div align="center">D&iacute;as Disfrute</div></th>
                <th width="15%" class="sub_titulo"><div align="center">D&iacute;as Pendientes del Per&iacute;odo</div></th>
                <th width="10%" class="sub_titulo"><div align="center">Fecha de Reintegro</div></th>
                <th width="30%" class="sub_titulo"><div align="center">Observaciones</div></th>
			</tr> 
					<?php 
                   
					 $SQL2="SELECT
							personal.cedula,
							vacacion.anio as anio,
							vacacion.fecha_inicio as fec_inicio,
							vacacion.fecha_fin as fec_fin,							
							vacacion.dias_disfrute as dias_disf,
							vacacion.dias_pendientes as dias_pend,
							vacacion.fecha_reintegro as fec_reintegro,
						    vacacion.observaciones as observacion
							FROM personal
							Inner Join vacacion ON personal.id_personal = vacacion.id_personal
							WHERE  personal.cedula = '".$_SESSION['id_usuario']."' order by anio";
                    
                   $rs2=$conn2->Execute($SQL2);

                  if($rs2->RecordCount()>0){
					  $inter=0;
				   while(!$rs2->EOF){ 
  		                  if (($inter%2) == 0) $class_name="dataListColumn2";
                 			else $class_name="dataListColumn";
					    $aDefaultForm['anio']						  = $rs2->fields['anio'];
						$aDefaultForm['fec_inicio']				  	  = $rs2->fields['fec_inicio'];
						$aDefaultForm['fec_fin']				  	  = $rs2->fields['fec_fin'];						
						$aDefaultForm['dias_disf']					  = $rs2->fields['dias_disf'];
						$aDefaultForm['dias_pend']					  = $rs2->fields['dias_pend'];
						$aDefaultForm['fec_reintegro']				  = $rs2->fields['fec_reintegro'];
						$aDefaultForm['observacion']				  = $rs2->fields['observacion'];
                 
				 ?>
			<tr class="'.$class_name.'">     
			   <td width="10%"><div align="center"><?= $aDefaultForm['anio'];?></div></td>
                <td width="10%"><div align="center"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['fec_inicio']));?></div></td>   
				<td width="10%"><div align="center"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['fec_fin']));?></div></td>
				<td width="15%"><div align="center"><?= $aDefaultForm['dias_disf'];?></div></td>
                <td width="15%"><div align="center"><?= $aDefaultForm['dias_pend'];?></div></td>
                <td width="10%"><div align="center"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['fec_reintegro']));?></div></td>
                <td width="30%" ><div align="center"><?= $aDefaultForm['observacion'];?></div></td>
			</tr>  
				<?php
                    $rs2->MoveNext();
                    $inter++;
                    }
                  }
                    ?>
</table>



<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_vacaciones_trabajador.php" formtarget="_blank" title="Haga Click para Imprimir la Relaci&oacute;n de Disfrute de Vacaciones">Imprimir</button>
		</td>
	</tr>
   
</table>
<br />
<?php } ?>

<div id="loader" class="loaders" style="display: none;"></div>

</form>

</td>
</tr>
</tbody>
</table>

<?php include("../../footer.php"); ?>
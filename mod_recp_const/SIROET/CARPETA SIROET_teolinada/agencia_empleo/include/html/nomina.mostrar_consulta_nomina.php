<?php
/**
 * html que muestra los trabajadores de la nomina de la tabla establecimiento_nomina
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param array $data 	conjunto de datos de la nomina
 */
function mostrar_consulta_nomina($data)
{
	?>
	<table width="95%" border="0" cellpadding="2" cellspacing="2" class="List" align="center">
	  <tr>
		<td><div align="left" class="texto-normal">(1) E = Empleado, O = Obrero<br/>(2) I = Ingresado, E = Egresado</div></td>
	  </tr>
	</table>
	<br/>
	<table width="95%" border="0" cellpadding="2" cellspacing="2" class="List" align="center">
	  <tr>
		<td colspan="8" class="ct_labelListColumn"><div align="left">
		<input id='btnEliminar' type='submit' class="button" value='Eliminar' onClick="javascript:send('btnEliminar_clicked')"></div>
		</td>
	  </tr>
	  <tr>
		<td colspan="8" class="labelListColumn"><div align="center">Datos de la N&oacute;mina </div></td>
	  </tr>
	  <tr class="ct_labelListColumn">
		<td colspan="2"><div align="center"><b>C&eacute;dula</b></div></td>
		<td width="29%"><div align="center">Nombre y Apellido </div></td>
		<td width="25%"><div align="center">Cargo</div></td>
		<td width="3%"><div align="center">(1)</div></td>	
		<td width="3%"><div align="center">(2)</div></td>	
		<td width="10%"><div align="center">Fecha Ingreso </div></td>
		<td width="15%"><div align="center">Salario </div></td>
	  </tr>
	<?php 
		for ($i=0;$i<count($data);$i++)
		{
			if ($i%2) {
				$class = "dataListColumn2"; 
			}
			else{
				$class = "dataListColumn";			
			}
	?>
	  <tr class="<?=$class?>">
		<td width="2%" class="texto-normal"><div align="left"><input type='checkbox' name='id[]' value="<?=$data[$i]['nEstablecimiento_nomina']?>"></div></td>
		<td width="8%"><div align="left"><?=($data[$i]['nacionalidad'] == 1) ? "V-":"E-"?><?= $data[$i]['cedula']?></div></td>
		<td><div align="left">&nbsp;<?=$data[$i]['apellido'].", ".$data[$i]['nombre']?></div></td>
		<td><div align="left">&nbsp;<?=$data[$i]['cargo']?></div></td>
		<td><div align="center"><?=($data[$i]['tipo_trabajador'] == 1)? "E":"O"?></div></td>
		<td><div align="center"><?=($data[$i]['estado_trabajador'] == 1)? "I":"E"?></div></td>	
		<td><div align="center"><?=$data[$i]['fecha_ingreso']?></div></td>
		<td><div align="right"><?=number_format( $data[$i]['salario'], 2,",",".")?>&nbsp;</div></td>
	  </tr>
	<?php 
		}
	?>  
	</table>
	<?
}
?>
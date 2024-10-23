<?php
/**
 * valida el trabajador de la n�mina
 * usa el objeto de conexion global definido en la pagina que incluye y
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param array $trabajador	conjunto de datos del trabajador
 * @param string $modulo    	valida los datos del trabajador dependiendo del modulo,
				los valores de este variable pueden ser rnee, rnee_sucur, ct.
				Su valor por defecto es rnee. Opcional
 * @param boolean $agregar	indica si el trabajador va a ser agregado a la base de datos o
				si es para actualizarlo. Por defecto true. Optional.
 * @param array $validar 	resultado de la validaci�n, conjunto de errores. Si hubo errores en la validacion
				indica que el trabajador es invalido
 * @depends  			adodb
 				existe_trabajador_nomina_ct.php
 */
function validar_trabajador_nomina( $trabajador,$modulo='rnee',$agregar=true )
{
	global $conn;

	//limpia las claves quitando los subfijos colocados
	//cuando se solicitan los datos con un formulario
	foreach ($trabajador as $key => $value)
	{
		$key = str_replace("_txt","",$key);
		$key = str_replace("_cb","",$key);
		$trabajador[$key] = $value;
	}

	$validar = array();
	$cedula_txt = trim(($trabajador['cedula']));
	$nombre_txt = trim(($trabajador['nombre']));
	$apellido_txt = trim(($trabajador['apellido']));
	$cargo_txt = trim(($trabajador['cargo']));
	$tipo_trabajador_cb = trim(($trabajador['tipo_trabajador']));
	$salario_entero_txt = trim(($trabajador['salario_entero']));
	$salario_decimal_txt = trim(($trabajador['salario_decimal']));
	$salario = $salario_entero_txt.".".$salario_decimal_txt;
	$cedula_valida = true;

	if (strlen($cedula_txt) != 0)
	{
		if ($cedula_txt != strval(intval($cedula_txt)))
		{
			$validar[] = "- La C�dula debe ser un n�mero.";
			$cedula_valida = false;
		}
		else
		{
			if(strval(floatval($cedula_txt)) < 9999)
			{
				$validar[]  = "- La c�dula: No es v�lida.";
				$cedula_valida = false;
			}
		}
	}else{
		$validar[] = "- La C�dula es requerida.";
		$cedula_valida = false;
	}

	if (strlen($nombre_txt) == 0){
		$validar[] = "- El Nombre es requerido.";
	}
	if (strlen($apellido_txt) == 0){
		$validar[] = "- El Apellido es requerido.";
	}
	if (strlen($cargo_txt) == 0){
		$validar[] = "- El Cargo es requerido.";
	}
	if (strlen($salario) != 0){
		if ($salario != strval(floatval($salario))){
			$validar[] = "- El Salario debe ser un n�mero.";
		}
	}else{
		$validar[] = "- El Salario es requerido.";
	}
	if (intval($salario_entero_txt) == 0)
	{
		$validar[] = "- El Salario no puede ser cero.";
	}
	if (intval($salario_entero_txt) < 0)
	{
		$validar[] = "- El Salario no puede ser negativo.";
	}
	if (intval($salario_decimal_txt) < 0)
	{
		$validar[] = "- El Salario no puede ser negativo.";
	}
	if (strlen($trabajador['fecha_nacimiento_txt']) == 0){
		$validar[] = "- La Fecha de Nacimiento es requerida.";
	}
	if (strlen($trabajador['fecha_ingreso_txt']) == 0){
		$validar[] = "- La Fecha de Ingreso es requerida.";
	}
	if ($agregar)
	{
		if ($cedula_valida)
		{
			if ( $modulo == 'ct' )
			{
				if ( existe_trabajador_nomina_ct( $cedula_txt ) )
				{
					$validar = array();
					$validar[] = "- Ud. ya agrego informaci�n sobre este trabajador en esta declaraci�n.";
				}
			}
		}
	}
	return $validar;
}
?>

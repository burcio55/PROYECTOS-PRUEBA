<?php
//VERSION 1.3
/*
IGNORAR CUALQUIER VERSION ANTERIOR Y SUBIR ESTA
-- ERRORES CORREGIDOS:
- No se habian incluido los valores de jornada rotativa 2 turnos, 3 turnos y trabajo continuo estaba como continua
*/
include('consulta_entes.php');
/*
 * valida la linea del archivo que contiene los datos de la nomina
 * @author Alexander Cabezas <alexcabezas1@gmail.com>
 * @version 1.0
 * @param string $linea	contiene los datos de un trabajador.
 						Datos: 1ER_NOMBRE;2DO_NOMBRE;1ER_APELLIDO;2DO_APELLIDO;NACIONALIDAD;
						CEDULA;SEXO;FECHA_NACIMIENTO;CARGO;TIPO_TRABAJADOR;
						FECHA_INGRESO;ESTADO_EMPLEADO;SALARIO
 * @param array $datos 	arreglo pasado por referencia donde se almacenan los datos una vez validados.
						El arreglo contendra los siguientes:
						nombre,apellido,
						nacionalidad,cedula,sexo,
						fecha_nac,cargo,tipo_trabajador,
						fecha_ingreso,estado_trabajador,salario.
						Opcional
 * @return array $valida contiene los errores encontrados en la linea, el n�mero de
 						la linea y el dato donde surgio el error
 * @depends  			postgres api
 */
//header("Content-type: text/html;charset=UTF-8");

// ELIMINO CARACTERES Y PALABRAS CLAVES PARA EVITAR SQL INJECTION POR USUARIOS AVANZADOS
function limpiarCadena($valor){
    $valor = str_ireplace(
        array (
                '*',
                ' UPDATE ',
                ' DELETE ',
                ' INSERT ',
                ' INTO ',
                ' VALUES ',
                ' JOIN ',
                ' WHERE ',
                ' ORDER BY ',
                ' DESC ',
                ' DATABASE ',
                ' TRUNCATE ',
                ' DUMP ',
                '%',
                '(',
                ')',
                '>',
                '<',
                '#',
                '--',
                '^',
                '[',
                ']',
                '!',
                '?',
                '$',
                '=',
                '"',
                "'", //APOSTROFO
                "`"  //
              ),
            '', //TODAS LAS COINCIDENCIAS DEL ARRAY SON REEMPLAZADAS CON ''
            $valor
          );
    return ($valor!='') ? trim(strtoupper(addslashes(utf8_decode($valor)))) : NULL;
}

function formatearCedula($valor){
    $valor = str_ireplace(
        array (
                '.',
                ','
              ),
            '', //TODAS LAS COINCIDENCIAS DEL ARRAY SON REEMPLAZADAS CON ''
            $valor
          );
    return $valor;
}

function formatearDecimal($valor){
        if (preg_match("/^(\d|,)*\.\d*$/",$valor)){
                    $valor = str_ireplace(",","",$valor);
        }
        if (preg_match("/^(\d|.)*\,\d*$/",$valor)){
                    $valor = str_ireplace(".","",$valor);
                    $valor = str_ireplace(",",".",$valor);
        }
 	return $valor;
}

function longitudCadena($cadena,$longitudMin,$longitudMax){
	if ( strlen($cadena)<$longitudMin || strlen($cadena)>$longitudMax )
	return true;
	else return false;
}

function validar_linea_archivo_trabajador($linea,$num_linea,&$datos=NULL)
{
	$valida = array();
	$column_required = 11;
	$cols = explode( ";", $linea );
        $dataSaime = NULL;

	if ( count($cols) == $column_required )
	{
            $letra = strtoupper( $cols[0] );
            $cedula = formatearCedula( $cols[1] );
            $enfermedad = limpiarCadena( $cols[2] );
            $indigena = limpiarCadena( $cols[3] );
            $discap_auditiva = limpiarCadena( $cols[4] );
            $discap_visual = limpiarCadena( $cols[5] );
            $discap_intelectual = limpiarCadena( $cols[6] );
            $discap_mental = limpiarCadena( $cols[7] );
            $discap_musculo = limpiarCadena( $cols[8] );
            $discap_otra = limpiarCadena( $cols[9] );
            $accidente = limpiarCadena( $cols[10] );

            if (strlen($cedula)>0) $dataSaime = consultando_saime( $cedula, $letra );
            if (!preg_match('/(V|E)/', $letra))
            {
                    $error['contenido'] = "<b>".$letra."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "NACIONALIDAD";
                    $error['mensaje'] = "La nacionalidad s&oacute;lo puede tener el valor V &oacute; E. Recuerde: V->Venezolano, E->Extranjero";
                    $error['linea_original'] = $linea; $valida[] = $error;
            }
            //strlen($cedula) == 0 && !ctype_digit($cedula))
            if ( !$dataSaime )
            {
                    $error['contenido'] = "<b>".$cedula."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "CEDULA";
                    $error['mensaje'] = "El n&uacute;mero no est&aacute; registrado en el SAIME";
                    $error['linea_original'] = $linea; $valida[] = $error;
            }
            else $datos['saime'] = true;

            if (!preg_match('/(S|N|)/', $discap_visual))
            {
                    $error['contenido'] = "<b>".$discap_visual."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "DISCAPACIDADVISUAL";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";

            }

            if (!preg_match('/(S|N|)/', $discap_auditiva))
            {
                    $error['contenido'] = "<b>".$discap_auditiva."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "DISCAPAUDITIVA";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";

            }

            if (!preg_match('/(S|N|)/', $discap_intelectual))
            {
                    $error['contenido'] = "<b>".$discap_intelectual."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "DISCAPINTELECTUAL";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";

            }

            if (!preg_match('/(S|N|)/', $discap_mental))
            {
                    $error['contenido'] = "<b>".$discap_mental."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "DISCAPMENTAL";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: 0->No, 1->Si.";

            }

            if (!preg_match('/(S|N|)/', $discap_musculo))
            {
                    $error['contenido'] = "<b>".$discap_musculo."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "DISCAPMUSCULO";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";
            }

            $noValid = array("NINGUNA", "N", "NO", "NO TIENE", "NO POSEE");
            if (!in_array($discap_otra, $noValid))
            {
                if (longitudCadena($discap_otra, 2, 25))
                {
                    $error['contenido'] = "<b>".$discap_otra."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "DISCAPOTRA";
                    $error['mensaje'] = "Debe contener entre 2 y 25 caracteres no num&eacute;ricos.";
                }
            }
            else{
                $discap_otra='';
            }
            
            if (!preg_match('/(S|N|)/', $accidente))
            {
                    $error['contenido'] = "<b>".$accidente."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "ACCIDENTETRABAJO";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";
                    $error['linea_original'] = $linea; $valida[] = $error;
            }

            if (!preg_match('/(S|N|)/', $enfermedad))
            {
                    $error['contenido'] = "<b>".$enfermedad."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "ENFERMEDADOCUPACIONAL";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, s->Si.";
                    $error['linea_original'] = $linea; $valida[] = $error;
            }

            if (!preg_match('/(S|N|)/', $indigena))
            {
                    $error['contenido'] = "<b>".$indigena."</b>";
                    $error['linea'] = $num_linea;
                    $error['columna'] = "INDIGENA";
                    $error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";
                    $error['linea_original'] = $linea; $valida[] = $error;
            }
	}
	else{
		if ( count($cols) != $column_required )
		{
			$error['linea'] = $num_linea;
			$error['columna'] = "COLUMNAS REQUERIDAS: ".$column_required;
			$error['mensaje'] = "La cantidad de columnas es ".count($cols);
			$error['linea_original'] = $linea; $valida[] = $error;
		}
	}

	//coloca los datos validados en el arreglo pasado por referencia
        $datos['cedula'] = formatearCedula($cedula);
        if(trim($letra)=='V') $datos['letra'] = 1;
        if(trim($letra)=='E') $datos['letra'] = 2;
	//$datos['letra'] = $datos['letra'];
	$datos['apellido1'] = $dataSaime['apellido1'];
	$datos['apellido2'] = $dataSaime['apellido2'];
	$datos['nombre1'] = $dataSaime['nombre1'];
	$datos['nombre2'] = $dataSaime['nombre2'];
	$datos['sexo'] = $dataSaime['sexo'];
	$datos['fecha_nac'] = $dataSaime['fecha_nac'];

	$datos['discap_visual'] = ($discap_visual=='S') ? 1 : 0;
        $datos['discap_auditiva'] = ($discap_auditiva=='S') ? 1 : 0;
        $datos['discap_intelectual'] = ($discap_intelectual=='S') ? 1 : 0;
        $datos['discap_mental'] = ($discap_mental=='S') ? 1 : 0;
        $datos['discap_musculo'] = ($discap_musculo=='S') ? 1 : 0;
	$datos['discap_otra'] = $discap_otra;
        
        $datos['enfermedad'] = ($enfermedad=='S') ? 1 : 2;
        $datos['indigena'] = ($indigena=='S') ? 1 : 2;
        $datos['accidente'] = ($accidente=='S') ? 1 : 2;

	return $valida;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function validar_linea_archivo_nomina($linea,$num_linea,&$datos=NULL)
{
	$valida = array();
	$column_required =20;
	$cols = explode( ";",$linea );
        $pos=0;
//        $dataRnet = NULL;
        $dataSaime = NULL;
	if ( count($cols) == $column_required )
	{
                $cedula = trim ( (int)$cols[$pos++] ); //item 0
		$rneetipotrabajadorid = trim( $cols[$pos++] );
		$rneetiempotrabajadorid = trim( $cols[$pos++] );
		$dfechaingreso = trim ( $cols[$pos++] );
                $dfechaingreso = (str_ireplace('/','-', $dfechaingreso)) ? str_ireplace('/','-', $dfechaingreso) : $dfechaingreso;
		$cargo = limpiarCadena( $cols[$pos++] );
                $ocupacion = trim( $cols[$pos++] );
                $especializacion = limpiarCadena( $cols[$pos++] );
                $subproceso = trim( $cols[$pos++] );
		$nsueldo = formatearDecimal( $cols[$pos++] );
		$njornada = trim( $cols[$pos++] );
		$nsindicalizado = trim ( $cols[$pos++] );
		$nlaboradomingo = trim ( $cols[$pos++] );
		$nhoraslaboradasmes = trim ( $cols[$pos++] );
		$nhorasextrasmes = trim ( $cols[$pos++] );
		$nhorasnocturnasmes = trim ( $cols[$pos++] );
		$cargafamiliar = trim ( $cols[$pos++] );
		$familiar_disc = trim ( $cols[$pos++] );
		$nhijosguarderia = trim ( $cols[$pos++] );
		$monto_guarderia = formatearDecimal( $cols[$pos++] );
		$embarazada = limpiarCadena ( $cols[$pos++] ); //item 19
//		$statustrabajador = trim ( $cols[16] );

                if (strlen($cedula)>0){
//                    $dataSaime = consultando_saime( $cedula, $letra );
                    $dataSaime = existe_trabajador_ct( $cedula );
                }

                //strlen($cedula) == 0 && !ctype_digit($cedula))
		if ( !$dataSaime )
		{
			$error['contenido'] = "<b>".$cedula."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "CEDULA";
			$error['mensaje'] = "Debe ingresar los Datos del Trabajador (Datos Fijos)";
			$error['linea_original'] = $linea; $valida[] = $error;
		}
                else $datos['saime'] = true;

                if ( !$dataSaime )
		{
			$error['contenido'] = "<b>".$cedula."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "CEDULA";
			$error['mensaje'] = "Debe ingresar los Datos del Trabajador (Datos Fijos)";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if (!preg_match('/(TD|TI|OD)/', strtoupper($rneetiempotrabajadorid)))
		{
			$error['contenido'] = "<b>".$rneetiempotrabajadorid."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "TIPOCONTRATO";
			$error['mensaje'] = "Recuerde: TD->Tiempo Determinado, TI->Tiempo Indeterminado, OD->Obra Determinada";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if (!preg_match('/(1|2|3|4|5|6)/', $rneetipotrabajadorid))
		{
			$error['contenido'] = "<b>".$rneetipotrabajadorid."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "RNEETIPOTRABAJADOR";
			$error['mensaje'] = "Recuerde: 1->De Direcci&oacute;n, 2->De Inspecci&oacute;n o Vigilancia, 3->Aprendiz INCES, 4->Pasante, 5->Trabajador Calificado, 6->Trabajador no Calificado";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if (!preg_match('/(D|N|M|R2|R3|TC)/', strtoupper($njornada)))
		{
			$error['contenido'] = "<b>".$njornada."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "JORNADA";
			$error['mensaje'] = "Recuerde: D->Diurna, N->Nocturna, M->Mixta, TC->Trabajo Continuo, R2->Rotativa 2 Turnos, R3->Rotativa 3 Turnos";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		$dfechaingreso = strftime("%d-%m-%Y", strtotime($dfechaingreso));
		if (!preg_match("/[0-9]{2}-[0-9]{2}-[0-9]{4}/",$dfechaingreso))
		{
			$error['contenido'] = "<b>".$dfechaingreso."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "FECHAINGRESO";
			$error['mensaje'] = "La fecha de ingreso debe contener 10 caracteres en formato dia-mes-año. Recuerde: ej. 02-03-2007";
			$error['linea_original'] = $linea; $valida[] = $error;
		}
		if (strlen($monto_guarderia)>1 && !(double)($monto_guarderia))

		{
			$error['contenido'] = "<b>".$monto_guarderia."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "MONTO_GUARDERIA";
			$error['mensaje'] = "Debe ser un valor num&eacute;rico. Recuerde: ej. 1234.56. Escriba 0 (cero) si no aplica";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if (!preg_match('/(S|N|)/', $familiar_disc))
		{
			$error['contenido'] = "<b>".$familiar_disc."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "FAMILIARCONDISCAPACIDAD";
			$error['mensaje'] = "Debe ser un valor num&eacute;rico. Escriba 0 (cero) si no aplica.";
			$error['linea_original'] = $linea; $valida[] = $error;
		}
		if (!is_numeric($nsueldo))
		{
			$error['contenido'] = "<b>".$nsueldo."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "SALARIO";
			$error['mensaje'] = "El salario puede contener hasta 2 (dos) d&iacute;gitos decimales delimitados por una coma sin separador de miles. Recuerde: ej. 123456,78 &oacute; 4999";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if (strlen($cargo)<3)
		{
			$error['contenido'] = "<b>".$cargo."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "OCUPACION";
			$error['mensaje'] = "La ocupaci&oacute;n debe contener al menos tres caracteres";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if ( !ctype_digit($nhoraslaboradasmes))
		{
			$error['contenido'] = "<b>".$nhoraslaboradasmes."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "HORASLABORADASMES";
			$error['mensaje'] = "Horas laboradas debe ser un valor num&eacute;rico.)";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if ( !ctype_digit($nhorasextrasmes)) //2XDIA 10XSEMANA 100XA�O  || (int)($nhorasextrasmes/30)>10
		{
			$error['contenido'] = "<b>".$nhorasextrasmes."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "HORASEXTRASMES";
			$error['mensaje'] = "Horas extras debe ser un valor num&eacute;rico.)";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if ( !ctype_digit($nhorasnocturnasmes)) // || (int)($nhorasnocturnasmes/30*7) >35
		{
			$error['contenido'] = "<b>".$nhorasnocturnasmes."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "HORASNOCTURNASMES";
			$error['mensaje'] = "Horas nocturnas debe ser un valor num&eacute;rico.)";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if (!preg_match('/(S|N|)/', $nlaboradomingo))
		{
			$error['contenido'] = "<b>".$nlaboradomingo."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "LABORADOMINGO";
			$error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, 1->Si.";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if ( !ctype_digit($nhijosguarderia))
		{
			$error['contenido'] = "<b>".$nhijosguarderia."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "HIJOSGUARDERIA";
			$error['mensaje'] = "Debe ser un valor num&eacute;rico. Escriba 0 (cero) si no aplica.";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if (!preg_match('/(S|N|)/', $nsindicalizado))
		{
			$error['contenido'] = "<b>".$nsindicalizado."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "SINDICALIZADO";
			$error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if ( !ctype_digit($cargafamiliar) )
		{
			$error['contenido'] = "<b>".$cargafamiliar."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "CARGAFAMILIAR";
			$error['mensaje'] = "Debe ser un valor num&eacute;rico. Escriba 0 (cero) si no aplica.";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

                if (!preg_match('/(S|N|)/', $embarazada))
		{
			$error['contenido'] = "<b>".$embarazada."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "EMBARAZADA";
			$error['mensaje'] = "Contiene caracteres no v&aacute;lidos. Recuerde: N->No, S->Si.";
			$error['linea_original'] = $linea; $valida[] = $error;
		}

		if ( strlen($ocupacion) == 0 && !ctype_digit($ocupacion) )
		{
			$error['contenido'] = "<b>".$ocupacion."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "OCUPACION";
			$error['mensaje'] = "El n&uacute;mero de ocupaci&oacute;n no est&aacute; registrado";
			$error['linea_original'] = $linea; $valida[] = $error;
		}
		if ( strlen($especializacion) >25 )
		{
			$error['contenido'] = "<b>".$especializacion."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "ESPECIALIZACION";
			$error['mensaje'] = "La especializaci&oacute;n excede los 25 caracteres";
			$error['linea_original'] = $linea; $valida[] = $error;
		}
                if  ( !is_numeric($subproceso) )
		{
			$error['contenido'] = "<b>".$subproceso."</b>";
			$error['linea'] = $num_linea;
			$error['columna'] = "SUBPROCESO";
			$error['mensaje'] = "El n&uacute;mero de subproceso es incorrecto";
			$error['linea_original'] = $linea; $valida[] = $error;
		}
		else{
			global $conn;
			$SQL = "select id from trimestral.ocupacion_especializacion WHERE id ='".$subproceso."'";
			$rs9 = $conn->Execute($SQL);
			$id = $rs9->fields['id'];
	                if ( !$id )
        	        {
                	        $error['contenido'] = "<b>".$subproceso."</b>";
	                        $error['linea'] = $num_linea;
        	                $error['columna'] = "SUBPROCESO";
                	        $error['mensaje'] = "El n&uacute;mero de subproceso no est&aacute; registrado";
	                        $error['linea_original'] = $linea; $valida[] = $error;
        	        }
		}
	}
	else{
		if ( count($cols) != $column_required )
		{
			$error['linea'] = $num_linea;
			$error['columna'] = "COLUMNAS REQUERIDAS: ".$column_required;
			$error['mensaje'] = "La cantidad de columnas es ".count($cols);
			$error['linea_original'] = $linea; $valida[] = $error;
		}
	}

	//coloca los datos validados en el arreglo pasado por referencia
	$datos['cedula'] = intval(trim($cedula));
	if (trim(strtoupper($rneetiempotrabajadorid))=='TD') $rneetiempotrabajadorid=1;
	if (trim(strtoupper($rneetiempotrabajadorid))=='TI') $rneetiempotrabajadorid=2;
	if (trim(strtoupper($rneetiempotrabajadorid))=='OD') $rneetiempotrabajadorid=3;
	$datos['rneetiempotrabajadorid'] = $rneetiempotrabajadorid;
	$datos['rneetipotrabajadorid'] = $rneetipotrabajadorid;
	if (strtoupper($njornada)=='D') $njornada=1;
	if (strtoupper($njornada)=='N') $njornada=2;
	if (strtoupper($njornada)=='M') $njornada=3;
	if (strtoupper($njornada)=='R2') $njornada=4;
	if (strtoupper($njornada)=='R3') $njornada=5;
        if (strtoupper($njornada)=='TC') $njornada=6;
	$datos['njornada'] = $njornada;
	$dfechaingreso = strftime("%Y-%m-%d", strtotime($dfechaingreso));
	$datos['dfechaingreso'] = $dfechaingreso;
	$datos['nsueldo'] = $nsueldo;
	$datos['cargo'] = $cargo;
        $datos['ocupacion'] = $ocupacion;
        $datos['especializacion'] = limpiarCadena( $especializacion );
        $datos['subproceso'] = $subproceso;
	$datos['nhoraslaboradasmes'] = $nhoraslaboradasmes;
	$datos['nhorasextrasmes'] = $nhorasextrasmes;
	$datos['nhorasnocturnasmes'] = $nhorasnocturnasmes;
	$datos['nlaboradomingo'] = ($nlaboradomingo=='S') ? 1 : 2;
	$datos['nhijosguarderia'] = $nhijosguarderia;
	$datos['nsindicalizado'] = ($nsindicalizado=='S') ? 1 : 2;
        $datos['embarazada'] = ($embarazada=='S') ? 1 : 2;
	/*
	if (trim($statustrabajador)=='A') $statustrabajador=1;
	if (trim($statustrabajador)=='I') $statustrabajador=2;
	if (trim($statustrabajador)=='E') $statustrabajador=3;
	*/
//-----------------VALIDAR ESTATUS DEL TRABAJADOR INGRESO Y ACTIVO----------------------------------------------------------------------------------

	$status_trabajador='0';

	if ($_SESSION['ntrimestre']=='1'){
		$finicio=$_SESSION['nano_trimestre'].'-01-01';
		$ffin=$_SESSION['nano_trimestre'].'-03-31';
	}

	if ($_SESSION['ntrimestre']=='2'){
		$finicio=$_SESSION['nano_trimestre'].'-04-01';
		$ffin=$_SESSION['nano_trimestre'].'-06-30';
	}

	if ($_SESSION['ntrimestre']=='3'){
		$finicio=$_SESSION['nano_trimestre'].'-07-01';
		$ffin=$_SESSION['nano_trimestre'].'-09-30';
	}

	if ($_SESSION['ntrimestre']=='4'){
		$finicio=$_SESSION['nano_trimestre'].'-10-01';
		$ffin=$_SESSION['nano_trimestre'].'-12-31';
	}

	preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$finicio);
	list($añoI,$mesI,$diaI)=explode("-",$finicio);

	preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$ffin);
	list($añoF,$mesF,$diaF)=explode("-",$ffin);

	$fingreso=$datos['dfechaingreso'];
	preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$fingreso);
	list($añoIng,$mesIng,$diaIng)=explode("-",$fingreso);

	if ($fingreso >= $finicio and $fingreso <= $ffin){
		$statustrabajador='2';}

	if ($fingreso < $finicio or $fingreso > $ffin){
		$statustrabajador='1';}


	//	echo 'inicio:'.$finicio.' fin:'.$ffin.' ingreso:'.$fingreso.' egreso:'.$fegreso.' status:'.$status_trabajador;

//------------------------Insert o update Nomina-----------------------------------------------------------------------------------------------
	$datos['statustrabajador'] = intval(trim($statustrabajador));
	$datos['cargafamiliar'] = intval(trim($cargafamiliar));
	$datos['monto_guarderia'] = $monto_guarderia;
	$datos['familiar_disc'] = intval(trim($familiar_disc));

	return $valida;
}
?>
<!--VERSION 1.3-->

<?php
/*
 * valida la linea del archivo que contiene los datos de la nomina
 * @author Héctor Mata <hectord.mata@gmail.com>
 * @version 1.0
 * @param string 
 * @param 
 * @return
 * @depends postgres api
 */
function parse_file_nomina($path)
{
        $tipo_archivo = (int)$_POST['tipo_archivo'];
	$trace = array();
	$trace['errors'] = array();
	$trace['sqls'] = array();
//	$column_required = 15;
	$archivo = file( $path );
	$k = count($archivo);
	$texto = '';
# CREAMOS UN ARCHIVO DONDE SE VACIARAN LOS ERRORES GENERADOS DURANTE LA CARGA
	$sPathFile = 'nominas/' . 
                        $_SESSION['empresa_id'] . 
                        $_POST["sucursal_cb"] . 
                        $_SESSION['nano_trimestre'] . 
                        $_SESSION['ntrimestre'] . 
                    '.csv';
	# OPEN FILE EN MODO ESCRITURA
	$sFile = fopen($sPathFile, "w");

	if ($tipo_archivo===1)
	{
		$texto =
		'DEBE SUBSANAR_LOS_SIGUIENTES_ERRORES; Cedula; Tipo Trabajador; Tipo Contrato; Fecha Ingreso; Cargo; Ocupacion; Especializacion; Subproceso; Salario; Jornada; Esta Sindicalizado?; Labora dia Domingo?; Promedio horas laboradas mes; Promedio horas extras mes; Promedio horas nocturnas mes; Carga familiar; Posee familiar con discapacidad?; Hijos beneficio guarderia; Monto beneficio guarderia; Es Una Mujer Embarazada?' . "\r\n";
	}
	if ($tipo_archivo===2)
	{
		$texto =
		'DEBE SUBSANAR_LOS_SIGUIENTES_ERRORES; CEDULA; ENFERMEDAD_OCUPACIONAL; ETNIA_INDIGENA; DISCAPAUDITIVA; DISCAPACIDADVISUAL; DISCAPINTELECTUAL; DISCAPMENTAL; DISCAPMUSCULO; DISCAPOTRA; ACCIDENTENacionalidad; Cedula; Presenta Enfermedad Ocupacional?; Pertenece a etnia Indigena?; Posee Discap auditiva?; Posee Discap visual?; Posee Discap intelectual; Posee Discap mental?; Posee Discap musculo-esq?; Posee otra Discap?; Discap Causada Por Accidente Laboral?' . "\r\n";
	}
        # ESCRIBIMOS EL CONTENIDO EN EL ARCHIVO
	fwrite($sFile, $texto);
        # CERRAMOS EL ARCHIVO
	fclose($sFile);

	//no tomar en cuenta la primera linea arrancando desde la # 2 (elemento 1 del arreglo)
        $valor_cb_nomina = array(1, 2);
        if (in_array($tipo_archivo, $valor_cb_nomina)){

                $update=0;
                $insert=0;
                for ($i=1; $i<$k; $i++)
                {
                        $errors = array();
                        $linea = $archivo[$i];
                        $datos = array();

                        if ($tipo_archivo==1)//LA NOMINA
                        {
                            $num_linea = $i+1;
                            $errors = validar_linea_archivo_nomina($linea,$num_linea,$datos); //retorna $datos por referencia
                            if ( $datos['cedula']!=0 and $datos['saime']) {
                                $existe = existe_nomina_ct($datos['cedula']);
                                if ( $existe ){
                                    $sql = sql_actualizar_nomina($datos, $existe);
                                    if ($sql) $update++;
                                }
                                else{
                                    $sql = sql_agregar_nomina($datos);
                                    if ($sql) $insert++;
                                }
                            }
                        }

                        if ($tipo_archivo==2)//LOS TRABAJADORES
                        {
                            $num_linea = $i+1;
                            $errors = validar_linea_archivo_trabajador($linea,$num_linea,$datos); //retorna $datos por referencia
                            if ( $datos['cedula']!=0 and $datos['saime']) {
                                $existe = existe_trabajador_ct($datos['cedula']);

                                if ( $existe ){
                                    $sql = sql_actualizar_trabajador($datos, $existe);
                                    if ($sql) $update++;
                                }
                                else{
                                    $sql = sql_agregar_trabajador($datos);
                                    if ($sql) $insert++;
                                }
                            }
                        }

                        if ( !empty( $errors ) )
                        {
                                $sFile = fopen($sPathFile, "a");
                                $trace['errors'][] = $errors;

                                # REPLACE THE CONTENTS OF FILE
                                $texto =$errors[0]['mensaje'].';'.$errors[0]['linea_original'].'';
                                fwrite($sFile, $texto);
                                fclose($sFile);
                        }
                        $aSQL = array();
                        $aSQL['query'] = $sql;
                        $trace['sqls'][] = $aSQL;
                }//end-for XX
                $total = $insert + $update;
                if ($insert!=0){
                    $GLOBALS["aPageErrors"][]="- Se agregaron: $insert Trabajadores.";
                }
                if ($update!=0){
                    $GLOBALS["aPageErrors"][]="- Se actualizaron: $update Trabajadores.";
                }
                if ($total!=0){
                    $GLOBALS["aPageErrors"][]="- Total: $total Trabajadores.";
                }
        }
        else{
                $GLOBALS["aPageErrors"][]="{$tipo_archivo}: You shall not pass!!!.";

        }
	return $trace;
}
?>
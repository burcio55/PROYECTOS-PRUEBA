<?php

include("BD.php");

$fecha_hora = date("Y-m-d H:i:s");
$fecha_actual = date("Y-m-d");

$grande1 = 0;
$grande2 = 0;

$type1 = 0;
$type2 = 0;

$fecha1 = 0;
$fecha2 = 0;

$sacotacion_supervisor = $_REQUEST["sacotacion_supervisor"];

$sprimer_curso_nombre = $_REQUEST["sprimer_curso_nombre"];
$sprimer_curso_fecha = $_REQUEST["sprimer_curso_fecha"];

$ssegundo_curso_nombre = $_REQUEST["ssegundo_curso_nombre"];
$ssegundo_curso_fecha = $_REQUEST["ssegundo_curso_fecha"];

if ($sprimer_curso_fecha > $fecha_actual) {
    $fecha1 = 1;
}

if ($ssegundo_curso_fecha > $fecha_actual) {
    $fecha2 = 1;
}

// Primer Archivo
if (isset($_FILES["sprimer_curso"])) {
    $nombre1 = $_FILES["sprimer_curso"]["name"];
    $tipo1 = $_FILES["sprimer_curso"]["type"];
    $temporal1 = $_FILES["sprimer_curso"]["tmp_name"];

    if (!in_array($tipo1, ["application/pdf"])) {
        $type1++;
    }
    $fecha_hora = date("Y-m-d H:i:s");
    $nombre_unico1 = $fecha_hora . " - " . $nombre1;
    $ruta1 = "pdf/" . $nombre_unico1;
    move_uploaded_file($temporal1, $ruta1);
}

// Segundo Archivo
if (isset($_FILES["ssegundo_curso"])) {
    $nombre2 = $_FILES["ssegundo_curso"]["name"];
    $tipo2 = $_FILES["ssegundo_curso"]["type"];
    $temporal2 = $_FILES["ssegundo_curso"]["tmp_name"];
    if (!in_array($tipo2, ["application/pdf"])) {
        $type2++;
    }
    $nombre_unico2 = $fecha_hora . " - " . $nombre2;
    $ruta2 = "pdf/" . $nombre_unico2;
    move_uploaded_file($temporal2, $ruta2);
}

$archivo1 = $ruta1;
$archivo2 = $ruta2;

if ($ruta1 == '') {
    $archivo = "No subió nada";
}

if ($ruta2 == '') {
    $archivo = "No subió nada";
}
/* if ($fecha1 > 0 || $fecha2 > 0) {
    include("../header.php");
    include("../mod_hcm/general_LoadCombo.php");
    $mostrar = '
            <div style="background-color: white; width: 40%; padding: 20px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; display:none; margin-top: 10%" id="alerta">
                <p id="mensaje" style="text-align: justify;"></p>
                <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" onclick="cerrar()">Cerrar</button>
            </div>
            <div id="Contenido" align="center" style="overflow:auto">
                <br>
                <table class="tabla" width="95%" height="95%">
                    <tbody>
                        <tr valign="top">
                            <td>
                                <br />
                                <table width="95%" border="0" align="center" class="formulario">
                                    <tr class="identificacion_seccion" width="100%">
                                        <th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
                                            MÓDULO IV: ACOTACIONES DEL SUPERVISOR
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="4"> </td>
                                    </tr>
                                    <tr style="width: 100%;">
                                        <th colspan="4" style="color: gray; width: 100%;">
                                            Las fechas deben tener formatos válidos.<br>
    ';
    if ($fecha1 > 0) {
        $mostrar .= '
                    La fecha del 1er curso no puede ser superior a la actual <br>
        ';
    }
    if ($fecha2 > 0) {
        $mostrar .= '
                    La fecha del 2do curso no puede ser superior a la actual <br>
        ';
    }
    $mostrar .= '
                </th>
            </tr>
            <tr width="100%">
                <td colspan="4">
                    <center>
                        <a href="files.php">
                            <input type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" value="REGRESAR">
                        </a>
                        <a href="evaluar.php">
                            <input type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" value="SALIR">
                        </a>
                    </center>
                </td>
            </tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
    ';

    echo $mostrar;
} else
if ($type1 > 0 || $type2 > 0) {
    include("../header.php");
    include("../mod_hcm/general_LoadCombo.php");
    $mostrar = '
            <div style="background-color: white; width: 40%; padding: 20px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; display:none; margin-top: 10%" id="alerta">
                <p id="mensaje" style="text-align: justify;"></p>
                <button type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" onclick="cerrar()">Cerrar</button>
            </div>
            <div id="Contenido" align="center" style="overflow:auto">
                <br>
                <table class="tabla" width="95%" height="95%">
                    <tbody>
                        <tr valign="top">
                            <td>
                                <br />
                                <table width="95%" border="0" align="center" class="formulario">
                                    <tr class="identificacion_seccion" width="100%">
                                        <th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
                                            MÓDULO IV: ACOTACIONES DEL SUPERVISOR
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="4"> </td>
                                    </tr>
                                    <tr style="width: 100%;">
                                        <th colspan="4" style="color: gray; width: 100%;">
                                            El formato correcto para subir archivos es la etiqueta ".pdf" <br>
    ';
    if ($type1 > 0) {
        $mostrar .= '
            El formato del Primer Curso es incorrecto <br>
        ';
    }
    if ($type2 > 0) {
        $mostrar .= '
            El formato del Segundo Curso es incorrecto <br>
        ';
    }
    $mostrar .= '
                </th>
            </tr>
            <tr width="100%">
                <td colspan="4">
                    <center>
                        <a href="files.php">
                            <input type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" value="REGRESAR">
                        </a>
                        <a href="evaluar.php">
                            <input type="button" style="padding: 5px 10px; border-radius: 20px; border: 1px grey solid" value="SALIR">
                        </a>
                    </center>
                </td>
            </tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
    ';

    echo $mostrar;
} */ else {

    $evaluacion_id = $_SESSION["evaluacion_id"];

    $SQL = "UPDATE";
    $SQL .= " evaluacion_desemp.evaluacion";
    $SQL .= " SET";
    $SQL .= " sacotacion_supervisor = '$sacotacion_supervisor',";
    $SQL .= " sprimer_curso = '$archivo1',";
    $SQL .= " sprimer_curso_nombre = '$sprimer_curso_nombre',";
    $SQL .= " sprimer_curso_fecha = '$sprimer_curso_fecha',";
    $SQL .= " ssegundo_curso = '$archivo2',";
    $SQL .= " ssegundo_curso_nombre = '$ssegundo_curso_nombre',";
    $SQL .= " ssegundo_curso_fecha = '$ssegundo_curso_fecha'";
    $SQL .= " WHERE";
    $SQL .= " id = '$evaluacion_id'";

    if ($resultado = pg_query($conn, $SQL)) {
        $msj = 1;
        $_SESSION["msj"] = $msj;
        header('location: evaluar.php');
    } else {
        echo $SQL;
    }
}
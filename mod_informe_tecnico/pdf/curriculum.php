<?

require 'fpdf/fpdf.php';

/* Ejemplo 1 */

/* $pdf = new FPDF('L', 'mm', array(100,50));
    $pdf -> AddPage();
    $pdf -> SetFont('Arial', 'B', 16);

    $pdf -> SetXY(50,60);
    $pdf -> Cell(100, 10, 'Hola Mundo', 1, 1, 'C');
    $y = $pdf -> GetY();
    $pdf -> SetY($y-30);
    $pdf -> Cell(100, 10, 'Hola Mundo2', 1, 1, 'R');

    $pdf -> MultiCell(100, 5, 'Hola Como Estan Ustedes asdasdasdasdadadasdscvdcd', 0, 'L', 0);

    $pdf -> Output(); */

/* Ejemplo 2 */

class PDF extends FPDF
{
    function Header()
    {
        // DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

        $host = "10.46.1.93";
        $dbname = "minpptrasse";
        $user = "postgres";
        $pass = "postgres";

        //OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
        //CONEXION CON SIRE

        session_start();
        /* include('../include/BD.php');
        $conn2 = Conexion::ConexionBD(); */

        //CONEXION CON SNIRLPCD

        try {
            $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
        } catch (PDOException $error) {
            $conn = $error;
            echo ("Error al conectar en la Base de Datos " . $error);
        }

        if (isset($_SESSION['cedula'])) {

            $cedula = substr($_SESSION["cedula"], 1);

            $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "' and benabled='true';");
            $row = pg_query($conn, $consulta);
            $persona = pg_fetch_assoc($row);

            $persona_id = $persona["id"];

            $name = strtoupper($persona["sprimer_nombre"]) . " ";
            $name .= strtoupper($persona["ssegundo_nombre"]) . " ";
            $name .= strtoupper($persona["sprimer_apellido"]) . " ";
            $name .= strtoupper($persona["ssegundo_apellido"]);
            $cedula = number_format($persona["ncedula"], 0, ",", ".");
            $nacionalidad = strtoupper($persona["snacionalidad"]);
            $estado_civil_id = $persona["estado_civil_id"];
            $dfecha_nacimiento = $persona["dfecha_nacimiento"];
            $semail = strtoupper($persona["semail"]);

            $nacimiento = new DateTime($dfecha_nacimiento);
            $ahora = new DateTime(date("Y-m-d"));
            $year = $ahora->diff($nacimiento);
            $edad = $year->format("%y");

            $query = ("SELECT * FROM snirlpcd.persona_fotos WHERE persona_id = '" . $persona_id . "';");
            $row2 = pg_query($conn, $query);
            $persona2 = pg_fetch_assoc($row2);

            /* if ($persona2 = pg_fetch_assoc($row2)) {
                echo "Si";
                die();
            } else {
                echo "No";
                die();
            } */

            $simagen = $persona2["nombre_foto"];

            $sql = "SELECT";
            $sql .= " persona.snacionalidad as nacionalidad,";
            $sql .= " persona.ncedula as cedula,";
            $sql .= " persona.sprimer_apellido as apellido1,";
            $sql .= " persona.ssegundo_apellido as apellido2,";
            $sql .= " persona.sprimer_nombre as nombre1,";
            $sql .= " persona.ssegundo_nombre as nombre2,";
            $sql .= " persona.stelefono_personal,";
            $sql .= " persona.stelefono_habitacion,";
            $sql .= " persona.semail,";
            $sql .= " persona.ssexo,";
            $sql .= " persona.ncertificado,";
            $sql .= " public.estado_civil.sdescripcion,";
            $sql .= " public.entidad.scapital as ciudad_descripcion,";
            $sql .= " public.municipio.sdescripcion as municipio_descripcion,";
            $sql .= " public.parroquia.sdescripcion as parroquia_descripcion";
            $sql .= " FROM snirlpcd.persona";
            $sql .= " LEFT JOIN public.entidad ON entidad.nentidad=persona.nentidad_residencia_id";
            $sql .= " LEFT JOIN public.municipio ON municipio.nmunicipio=persona.nmunicipio_residencia_id";
            $sql .= " LEFT JOIN public.parroquia ON parroquia.nparroquia=persona.nparroquia_residencia_id";
            $sql .= " LEFT JOIN public.estado_civil ON estado_civil.id=persona.estado_civil_id";
            $sql .= " where persona.id =$persona_id";

            $row3 = pg_query($conn, $sql);
            $persona3 = pg_fetch_assoc($row3);

            /* if ($persona2 = pg_fetch_assoc($row2)) {
                echo "Sí";
                die();
            } else {
                echo "No";
                die();
            } */

            $ciudad_descripcion = strtoupper($persona3["ciudad_descripcion"]);
            $municipio_descripcion = strtoupper($persona3["municipio_descripcion"]);
            $parroquia_descripcion = strtoupper($persona3["parroquia_descripcion"]);

            $ncertificado = $persona3["ncertificado"];

            if ($ncertificado == "1") {
                $certificado = "CERTIFICADO POR CONAPDIS: SI";
                $cert = 1;
            } else {
                $certificado = "CERTIFICADO POR CONAPDIS: NO";
                $cert = 2;
            }

            $stelefono_personal = $persona3["stelefono_personal"];
            $stelefono_habitacion = $persona3["stelefono_habitacion"];
            $ssexo = $persona3["ssexo"];

            if ($ssexo == 1) {
                $ssexo = "FEMENINO";
                if ($estado_civil_id == -1) {
                    $estado_civil_id = "INDIFERENTE";
                } else
                if ($estado_civil_id == 1) {
                    $estado_civil_id = "CASADA";
                } else
                if ($estado_civil_id == 2) {
                    $estado_civil_id = "DIVORSIADA";
                } else
                if ($estado_civil_id == 3) {
                    $estado_civil_id = "SOLTERA";
                } else
                if ($estado_civil_id == 4) {
                    $estado_civil_id = "UNIÓN ESTABLE DE HECHOS";
                } else {
                    $estado_civil_id = "VIUDA";
                }
            } else {
                $ssexo = "MASCULINO";
                if ($estado_civil_id == -1) {
                    $estado_civil_id = "INDIFERENTE";
                } else
                if ($estado_civil_id == 1) {
                    $estado_civil_id = "CASADO";
                } else
                if ($estado_civil_id == 2) {
                    $estado_civil_id = "DIVORSIADO";
                } else
                if ($estado_civil_id == 3) {
                    $estado_civil_id = "SOLTERO";
                } else
                if ($estado_civil_id == 4) {
                    $estado_civil_id = "UNIÓN ESTABLE DE HECHOS";
                } else {
                    $estado_civil_id = "VIUDO";
                }
            }
        }

        // Estudios Realizados
        /*
            $sql2 = "SELECT";
            $sql2 .= " snirlpcd.persona_nivel_educativo.stitulo_obtenido,";
            $sql2 .= " snirlpcd.persona_nivel_educativo.snombre_inst_educativa,";
            $sql2 .= " snirlpcd.persona_nivel_educativo.dfecha_graduacion";
            $sql2 .= " FROM snirlpcd.persona";
            $sql2 .= " left JOIN snirlpcd.persona_nivel_educativo ON persona_nivel_educativo.persona_id =persona.id";
            $sql2 .= " where persona.id ='$persona_id' and persona_nivel_educativo.benabled='t'";
            $row4 = pg_query($conn, $sql2);
            $persona4 = pg_fetch_assoc($row4); */
        /* for ($i = 0; $i <= $row4; $i++) {
                echo $per[$i] = $persona4["stitulo_obtenido"] . "<br>";
            }
            die();
        */

        /* $img_prueba = '../imagenes/foto-ejemplo2.jpg'; */

        $discp = " SELECT";
        $discp .= " snirlpcd.persona_discapacidad.id,";
        $discp .= " snirlpcd.persona_discapacidad.tipo_discapacidad_id,";
        $discp .= " snirlpcd.persona_discapacidad.ngrado_discapacidad,";
        $discp .= " snirlpcd.persona_discapacidad.sdiscapacidad_especifica,";
        $discp .= " snirlpcd.persona_discapacidad.benabled,";
        $discp .= " snirlpcd.tipo_discapacidad.sdescripcion";
        $discp .= " FROM";
        $discp .= " snirlpcd.persona_discapacidad";
        $discp .= " INNER JOIN";
        $discp .= " snirlpcd.tipo_discapacidad";
        $discp .= " ON";
        $discp .= " snirlpcd.persona_discapacidad.tipo_discapacidad_id = snirlpcd.tipo_discapacidad.id";
        $discp .= " WHERE";
        $discp .= " snirlpcd.persona_discapacidad.persona_id = '" . $persona_id . "' and snirlpcd.tipo_discapacidad.benabled='true';";
        $row_d = pg_query($conn, $discp);
        $discapacidad = pg_fetch_assoc($row_d);

        if ($discapacidad["ngrado_discapacidad"] == '1') {
            $grado_discapacidad = " LEVE";
        } else
        if ($discapacidad["ngrado_discapacidad"] == '2') {
            $grado_discapacidad = " MODERADO";
        } else
        if ($discapacidad["ngrado_discapacidad"] == '3') {
            $grado_discapacidad = " GRAVE";
        } else
        if ($discapacidad["ngrado_discapacidad"] == '4') {
            $grado_discapacidad = " DEVERO";
        } else
        if ($discapacidad["ngrado_discapacidad"] == '5') {
            $grado_discapacidad = " COMPLETO";
        }

        $this->Image($simagen, 15, 15, 61, 70);
        $this->SetFont('Arial', 'B', '12');
        $this->Cell(30);
        $this->SetY(10);
        $this->SetX(85);
        $text = utf8_decode($name);
        $this->Cell(220, 20, $text, 0, 1, 'l');
        $this->Line(88, 25, 150, 25);
        $this->SetFont('Arial', 'B', '10');
        $this->Cell(79);
        $this->Cell(150, 7, $nacionalidad . '_' . $cedula, 0, 1, 'l');
        $this->Cell(79);
        $dir = utf8_decode($ciudad_descripcion . " - " . $municipio_descripcion . " - " . $parroquia_descripcion);
        $this->Cell(190, 7, $dir, 0, 1, 'l');
        $this->Cell(79);
        $this->Cell(190, 7, $stelefono_personal . ' / ' . $stelefono_habitacion, 0, 1, 'l');
        $this->Cell(79);
        $this->Cell(190, 7, $semail, 0, 1, 'l');
        $this->Cell(79);
        $ayo = utf8_decode($edad . ' AÑOS');
        $estado_civil = utf8_decode($estado_civil_id);
        $discap1 = utf8_decode(strtoupper($discapacidad["sdescripcion"]));
        $discap2 = utf8_decode(strtoupper($discapacidad["sdiscapacidad_especifica"]));
        if ($cert == 1) {
            $especifica = utf8_decode('ESPECÍFICA: ');
            $this->Cell(190, 7, $ayo . " / " . $ssexo . " / " . $estado_civil, 0, 1, 'l');
            $todo_discapacidad = "DISCAPACIDAD: " . $discap1;
            $todo_discapacidad2 = $especifica . $discap2;
            $todo_discapacidad3 = "GRADO: " . $grado_discapacidad;
            $this->Cell(79);
            $this->Cell(190, 7, $todo_discapacidad, 0, 1, 'l');
            $this->Cell(79);
            $this->Cell(190, 7, $todo_discapacidad2, 0, 1, 'l');
            $this->Cell(79);
            $this->Cell(190, 7, $todo_discapacidad3, 0, 1, 'l');
            $this->Cell(79);
        }
        $this->Cell(190, 7, $certificado, 0, 1, 'l');
        if ($cert == 2) {
            $this->Ln(25);
        } else {
            $this->Ln(5);
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();

// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

/* session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD(); */

//CONEXION CON SNIRLPCD

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $cedula = substr($_SESSION["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $persona_id = $persona["id"];
}

$edu = ("SELECT * FROM snirlpcd.persona_nivel_educativo WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
$row97 = pg_query($conn, $edu);
$persona97 = pg_fetch_assoc($row97);
$id_eduacion = $persona97["id"];

$PG = "SELECT";
$PG .= " snirlpcd.persona_nivel_educativo.nivel_educativo_id,";
$PG .= " snirlpcd.persona_nivel_educativo.stitulo_obtenido,";
$PG .= " snirlpcd.persona_nivel_educativo.snombre_inst_educativa,";
$PG .= " snirlpcd.persona_nivel_educativo.dfecha_graduacion";
$PG .= " FROM";
$PG .= " snirlpcd.persona";
$PG .= " left JOIN";
$PG .= " snirlpcd.persona_nivel_educativo";
$PG .= " ON";
$PG .= " persona_nivel_educativo.persona_id =persona.id";
$PG .= " where";
$PG .= " persona.id ='$persona_id'";
$PG .= " and ";
$PG .= " persona_nivel_educativo.benabled='t'";
$PG .= " limit 4";
$row5 = pg_query($conn, $PG);
$row4 = pg_fetch_assoc($row5);

if ($id_eduacion != '') {
    $tit_edu = utf8_decode("NIVEL EDUCATIVO");
    $tit = utf8_decode("TÍTULO OBTENIDO");
    $name_inst = utf8_decode("NOMBRE DE LA INSTITUCIÓN");
    $fgrad = utf8_decode("AÑO DE GRADUACIÓN");
    $pdf->SetX(8);
    $pdf->SetFont('Arial', 'B', '12');
    $pdf->Cell(0, 7, $tit_edu, 0, 1, 'l');
    $pdf->SetX(8);
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->Cell(85, 7, $tit, 0, 0, 'l');
    $pdf->Cell(65, 7, $name_inst, 0, 0, 'l');
    $pdf->Cell(0, 7, $fgrad, 0, 1, 'l');

    $pdf->SetFont('Arial', '', '10');
    do {
        $nivel_educativo_id = $row4['nivel_educativo_id'];
        $titulo = $row4['stitulo_obtenido'];
        $instituto = $row4['snombre_inst_educativa'];
        $graduacion = $row4['dfecha_graduacion'];
        if ($nivel_educativo_id == 1) {
            $pdf->SetX(8);
            $pdf->Cell(85, 7, 'Analfabeta', 0, 0, 'l');
            $pdf->Cell(65, 7, 'No posee', 0, 0, 'l');
            $pdf->Cell(0, 7, 'No posee', 0, 1, 'l');
        } else
        if ($nivel_educativo_id == 2) {
            $pdf->SetX(8);
            $pdf->Cell(85, 7, 'Lee y Escribe', 0, 0, 'l');
            $pdf->Cell(65, 7, 'No posee', 0, 0, 'l');
            $pdf->Cell(0, 7, 'No posee', 0, 1, 'l');
        } else {
            $tit2 =  utf8_decode($titulo);
            $name_inst2 = utf8_decode($instituto);
            $fgrad2 = utf8_decode($graduacion);
            $pdf->SetX(8);
            $pdf->Cell(85, 7, $tit2, 0, 0, 'l');
            $pdf->Cell(65, 7, $name_inst2, 0, 0, 'l');
            $pdf->Cell(0, 7, $fgrad2, 0, 1, 'l');
        }
    } while ($row4 = pg_fetch_assoc($row5));

    $pdf->Ln(10);
}

$capa = ("SELECT * FROM snirlpcd.persona_capacitacion WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
$row98 = pg_query($conn, $capa);
$persona98 = pg_fetch_assoc($row98);
$id_capacitacion = $persona98["id"];

$PG2 = "SELECT";
$PG2 .= " snirlpcd.persona_capacitacion.snombre_activ_capacitacion,";
$PG2 .= " snirlpcd.persona_capacitacion.snombre_entidad_capacitadora,";
$PG2 .= " snirlpcd.persona_capacitacion.sduracion_capacitacion";
$PG2 .= " FROM";
$PG2 .= " snirlpcd.persona";
$PG2 .= " left JOIN";
$PG2 .= " snirlpcd.persona_capacitacion";
$PG2 .= " ON";
$PG2 .= " snirlpcd.persona_capacitacion.persona_id =persona.id";
$PG2 .= " where";
$PG2 .= " persona.id ='$persona_id'";
$PG2 .= " and ";
$PG2 .= " persona_capacitacion.benabled='t'";
$PG2 .= " limit 4";
$row7 = pg_query($conn, $PG2);
$row6 = pg_fetch_assoc($row7);

if ($id_capacitacion != '') {

    $pdf->SetX(8);
    $pdf->SetFont('Arial', 'B', '12');
    $tit_edu = utf8_decode("ACTIVIDADES DE CAPACITACIÓN");
    $pdf->Cell(0, 7, $tit_edu, 0, 1, 'l');
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetX(8);
    $cap = utf8_decode("NOMBRE DE LA ACTIVIDAD");
    $int_cap = utf8_decode("NOMBRE DE LA INSTITUCIÓN");
    $dur = utf8_decode("DURACIÓN");
    $pdf->Cell(85, 7, $cap, 0, 0, 'l');
    $pdf->Cell(65, 7, $int_cap, 0, 0, 'l');
    $pdf->Cell(0, 7, $dur, 0, 1, 'l');

    $pdf->SetFont('Arial', '', '10');

    do {
        $cap2 =  utf8_decode($row6['snombre_activ_capacitacion']);
        $int_cap2 = utf8_decode($row6['snombre_entidad_capacitadora']);
        $dur2 = utf8_decode($row6['sduracion_capacitacion']);
        $pdf->SetX(8);
        $pdf->Cell(85, 7, $cap2, 0, 0, 'l');
        $pdf->Cell(65, 7, $int_cap2, 0, 0, 'l');
        if ($dur2 > 1) {
            $pdf->Cell(0, 7, $dur2 . " HORAS", 0, 1, 'l');
        } else
    if ($dur == 1) {
            $pdf->Cell(0, 7, 'UNA HORA', 0, 1, 'l');
        } else {
            $pdf->Cell(0, 7, 'NO CULMINADO', 0, 1, 'l');
        }
    } while ($row6 = pg_fetch_assoc($row7));
    $pdf->Ln(10);
}

$discp = ("SELECT * FROM snirlpcd.persona_exp_laboral WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
$row99 = pg_query($conn, $discp);
$persona99 = pg_fetch_assoc($row99);
$id_experiencia = $persona99["id"];

$PG3 = "SELECT";
$PG3 .= " snirlpcd.persona_exp_laboral.snombre_entidad_trabajo,";
$PG3 .= " snirlpcd.persona_exp_laboral.dfecha_ingreso,";
$PG3 .= " snirlpcd.persona_exp_laboral.dfecha_egreso,";
$PG3 .= " snirlpcd.persona_exp_laboral.scargo";
$PG3 .= " FROM";
$PG3 .= " snirlpcd.persona";
$PG3 .= " left JOIN";
$PG3 .= " snirlpcd.persona_exp_laboral";
$PG3 .= " ON";
$PG3 .= " snirlpcd.persona_exp_laboral.persona_id =persona.id";
$PG3 .= " where";
$PG3 .= " persona.id ='$persona_id'";
$PG3 .= " and ";
$PG3 .= " snirlpcd.persona_exp_laboral.benabled='t'";
$PG3 .= " limit 4";
$row9 = pg_query($conn, $PG3);
$row8 = pg_fetch_assoc($row9);

if ($id_experiencia != '') {
    $pdf->SetX(8);
    $pdf->SetFont('Arial', 'B', '12');
    $pdf->Cell(0, 7, "EXPERIENCIA LABORAL", 0, 1, 'l');
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetX(8);
    $name_tra = utf8_decode("NOMBRE DE LA EMPRESA");
    $cargo = utf8_decode("CARGO");
    $pdf->Cell(90, 7, $name_tra, 0, 0, 'l');
    $pdf->Cell(50, 7, $cargo, 0, 1, 'l');

    $pdf->SetFont('Arial', '', '10');

    do {
        $name_tra2 =  utf8_decode($row8['snombre_entidad_trabajo']);
        $cargo2 = utf8_decode($row8['scargo']);
        $fingreso = utf8_decode($row8['dfecha_ingreso']);
        $fegreso = utf8_decode($row8['dfecha_egreso']);
        $pdf->SetX(8);
        $pdf->Cell(90, 7, $name_tra2, 0, 0, 'l');
        $pdf->Cell(0, 7, $cargo2, 0, 1, 'l');
        $pdf->SetX(8);
        $pdf->Cell(90, 7, 'INGRESO: ' . $fingreso, 0, 0, 'l');
        if ($fegreso != '') {
            $pdf->Cell(0, 7, 'EGRESO: ' . $fegreso, 0, 1, 'l');
        } else {
            $pdf->Ln(3);
        }
        $pdf->Ln(3);
    } while ($row8 = pg_fetch_assoc($row9));

    $pdf->Ln(7);
}

$hab = ("SELECT * FROM snirlpcd.persona_habilidad_destreza WHERE persona_id = '" . $persona_id . "' and benabled = 'true';");
$row100 = pg_query($conn, $hab);
$persona100 = pg_fetch_assoc($row100);
$id_hab_des = $persona100["id"];

$PG4 = "SELECT";
$PG4 .= " snirlpcd.persona_habilidad_destreza.snombre_otros_conocimientos,";
$PG4 .= " snirlpcd.persona_habilidad_destreza.sdominio_conocimiento";
$PG4 .= " FROM";
$PG4 .= " snirlpcd.persona";
$PG4 .= " left JOIN";
$PG4 .= " snirlpcd.persona_habilidad_destreza";
$PG4 .= " ON";
$PG4 .= " snirlpcd.persona_habilidad_destreza.persona_id =persona.id";
$PG4 .= " where";
$PG4 .= " persona.id ='$persona_id'";
$PG4 .= " and ";
$PG4 .= " snirlpcd.persona_habilidad_destreza.benabled='true'";
$PG4 .= " limit 4";
$row11 = pg_query($conn, $PG4);
$row10 = pg_fetch_assoc($row11);

if ($id_hab_des != '') {
    $pdf->SetX(8);
    $pdf->SetFont('Arial', 'B', '12');
    $tit_edu = utf8_decode("HABILIDADES Y DESTREZAS");
    $pdf->Cell(0, 7, $tit_edu, 0, 1, 'l');
    $pdf->SetFont('Arial', 'B', '10');
    $pdf->SetX(8);
    $conocimiento = utf8_decode("NOMBRE DEL CONOCIMIENTO");
    $nivel_con = utf8_decode("NIVEL DE DOMINIO");
    $pdf->Cell(90, 7, $conocimiento, 0, 0, 'l');
    $pdf->Cell(0, 7, $nivel_con, 0, 1, 'l');

    $pdf->SetFont('Arial', '', '10');

    do {
        $conocimiento2 =  utf8_decode($row10['snombre_otros_conocimientos']);
        $nivel_con2 = utf8_decode($row10['sdominio_conocimiento']);
        $pdf->SetX(8);
        $pdf->Cell(90, 7, $conocimiento2, 0, 0, 'l');
        if ($nivel_con2 == 1) {
            $pdf->Cell(0, 7, 'BAJO', 0, 1, 'l');
        } else
    if ($nivel_con2 == 2) {
            $pdf->Cell(0, 7, 'MEDIO', 0, 1, 'l');
        } else
    if ($nivel_con2 == 3) {
            $pdf->Cell(0, 7, 'ALTO', 0, 1, 'l');
        } else {
            $pdf->Cell(0, 7, 'NO ESPECIFICADO', 0, 1, 'l');
        }
    } while ($row10 = pg_fetch_assoc($row11));
}
/* 
$cap = utf8_decode("ACTIVIDADES DE CAPACITACIÓN");
$pdf->Cell(95, 7, $cap, 0, 1, 'l');
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetX(15);
$pdf->Cell(95, 7, 'Nombre de la Actividad', 0, 1, 'l');

$pdf->SetX(15);
$pdf->Cell(95, 7, $name_inst, 0, 1, 'l');

$pdf->SetX(15);
$ayo2 = utf8_decode("Año de Graduado");
$pdf->Cell(95, 7, $ayo2, 0, 0, 'l');
$dur = utf8_decode("Duración");
$pdf->Cell(95, 7, $dur, 0, 1, 'l'); */

/* $pdf->Ln(5);

$pdf->SetX(15);
$pdf->SetFont('Arial', 'B', '12');
$pdf->Cell(95, 7, 'EXPERIENCIA LABORAL', 0, 1, 'l');
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetX(15);
$pdf->Cell(95, 7, 'Nombre de la Entidad de Trabajo', 0, 1, 'l');
$pdf->SetX(15);
$pdf->Cell(95, 7, 'Fecha Ingreso', 0, 1, 'l');
$pdf->SetX(15);
$pdf->Cell(95, 7, 'Fecha Egreso', 0, 1, 'l');
$pdf->SetX(15);
$ocup = utf8_decode("Cargo");
$pdf->Cell(95, 7, $ocup, 0, 1, 'l');

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', '12');
$pdf->SetX(15);
$pdf->Cell(180, 7, 'HABILIDADES Y DESTREZAS', 0, 1, 'l');
$pdf->SetFont('Arial', 'B', '10');
$pdf->SetX(15);
$pdf->Cell(180, 7, 'Habilidades y Destrezas que manifiesta el usuario en su registro anterior', 0, 0, 'l'); */


$pdf->Output('Curriculum_Vitae.pdf', 'I');

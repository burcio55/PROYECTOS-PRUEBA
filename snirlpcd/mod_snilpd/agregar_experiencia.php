<?php

// DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

//OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
//CONEXION CON SIRE

session_start();
include('../include/BD.php');
$conn2 = Conexion::ConexionBD();

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
    $fecha_nac = $persona["dfecha_nacimiento"];
}

//VARIABLES

$valor = $_REQUEST['valor'];
$experiencia = $_REQUEST['experiencia'];
$rif = "V".$_REQUEST['rif'];
$patrono = $_REQUEST['patrono'];
$sector = $_REQUEST['sector'];
$economia = $_REQUEST['economia'];
$telefono = $_REQUEST['telefono'];
$ocupacion = $_REQUEST['ocupacion'];
$ingreso = $_REQUEST['ingreso'];
$relacion = $_REQUEST['relacion'];
$egreso = $_REQUEST['egreso'];
$otro = $_REQUEST['otro'];

/* echo "2 / $valor";
die();
 */
//VALIDACIONES
if ($experiencia == '') {
    echo "1 / Debe responder a la pregunta: ¿Tiene Experiencia Laboral? / #cbExperiencia";
    die();
}

if ($experiencia == '1') {
    //VALIDACION PARA INGRESAR DATOS

    /* if ($rif != '') {
        if (!ereg("^[JGVE][0-9]{9}$", $_REQUEST['rif'])) {
            echo "1 / El RIF: " . $_REQUEST['rif'] . " No posse un formato válido, ejemplo: V00000021 / #rif";
            die();
        }
    } */
    if ($patrono == '') {
        echo "1 / Debe llenar el campo \"Nombre o Razón de la Entidad de Trabajo\" / #patrono";
        die();
    }
    if ($ocupacion == '') {
        echo "1 / Debe llenar el campo \"Ocupación\" / #ocupacion";
        die();
    }
    if ($relacion == '-1') {
        echo "1 / Debe seleccionar una opción en el campo \"Tipo de Relación de Trabajo\" / #cbRelacion_trabajo";
        die();
    }
    $fecha_actual = date('Y-m-d');
    if ($egreso > '01') {
        if ($egreso < $ingreso) {
            echo "1 / La fecha de Egreso no puede ser menor a la de Ingreso / #f_egreso";
            die();
        } else
    if ($egreso == $ingreso) {
            echo "1 / La fecha de Egreso y la fecha de Ingreso no puden ser iguales / #f_egreso";
            die();
        }
        if ($ingreso < $fecha_nac) {
            echo "1 /  La Fecha de Ingreso no puede ser inferior a su año de Nacimiento / #f_ingreso";
            die();
        }
        if ($ingreso > $fecha_actual) {
            echo "1 / La fecha de Ingreso no puede ser superior a la fecha actual / #f_ingreso";
            die();
        }
        if ($egreso > $fecha_actual) {
            echo "1 / La fecha de Egreso no puede ser superior a la fecha actual / #f_egreso";
            die();
        }
    } else {
        if ($ingreso > 0) {
            if ($ingreso > $fecha_actual) {
                echo "1 / La fecha de Ingreso no puede ser superior a la fecha actual / #f_ingreso";
                die();
            }
            if ($ingreso < $fecha_nac) {
                echo '1 / La Fecha de Ingreso no puede ser inferior a su año de Nacimiento / #f_ingreso';
                die();
            }
        } else {
            echo "1 / Debe registrar una Fecha de Ingreso / #f_ingreso";
            die();
        }
    }

    if ($valor != '') {

        $PG = "UPDATE";
        $PG .= " snirlpcd.persona_exp_laboral";
        $PG .= " SET";
        $PG .= " srif = '$rif',";
        $PG .= " snombre_entidad_trabajo = '$patrono',";
        $PG .= " sector_empleo_id = '$sector',";
        $PG .= " actividad_eco_cod = '$economia',";
        $PG .= " stelefono_contacto = '$telefono',";
        $PG .= " scargo = '$ocupacion',";
        $PG .= " dfecha_ingreso = '$ingreso',";
        if ($egreso != '') {
            $PG .= " dfecha_egreso = '$egreso',";
        }
        $PG .= " stipo_relacion = '$relacion',";
        $PG .= " sotra_habilidades = '$otro',";
        $PG .= " nusuario_actualizacion = '$persona_id'";
        $PG .= " WHERE";
        $PG .= " id='$valor';";

        /* echo "1 / modificar: $PG";
        die(); */

        $valor2 = pg_query($conn, $PG);

        $PG2 = "UPDATE";
        $PG2 .= " snirlpcd.persona";
        $PG2 .= " SET";
        $PG2 .= " nexperiencia_laboral = '$experiencia'";
        $PG2 .= " WHERE";
        $PG2 .= " id='$persona_id';";

        $valor3 = pg_query($conn, $PG2);
    } else {
        $PG = "UPDATE";
        $PG .= " snirlpcd.persona";
        $PG .= " SET";
        $PG .= " nexperiencia_laboral = '$experiencia'";
        $PG .= " WHERE";
        $PG .= " id='$persona_id';";

        /* echo "1 / insertar:  $PG";
        die(); */

        $valor2 = pg_query($conn, $PG);

        if ($egreso == '') {
            $PG = "INSERT INTO snirlpcd.persona_exp_laboral ";
            $PG .= "(";
            $PG .= "persona_id";
            $PG .= ", srif";
            $PG .= ", snombre_entidad_trabajo";
            $PG .= ", sector_empleo_id";
            $PG .= ", actividad_eco_cod";
            $PG .= ", stelefono_contacto";
            $PG .= ", scargo";
            $PG .= ", dfecha_ingreso";
            $PG .= ", stipo_relacion";
            $PG .= ", sotra_habilidades";
            $PG .= ", nusuario_creacion";
            $PG .= ")";
            $PG .= " VALUES ";
            $PG .= "(";
            $PG .= "'$persona_id'";
            $PG .= ", '$rif'";
            $PG .= ", '$patrono'";
            $PG .= ", '$sector'";
            $PG .= ", '$economia'";
            $PG .= ", '$telefono'";
            $PG .= ", '$ocupacion'";
            $PG .= ", '$ingreso'";
            $PG .= ", '$relacion'";
            $PG .= ", '$otro'";
            $PG .= ", '$persona_id'";
            $PG .= ")";
        } else {

            $PG = "INSERT INTO snirlpcd.persona_exp_laboral ";
            $PG .= "(";
            $PG .= "persona_id";
            $PG .= ", srif";
            $PG .= ", snombre_entidad_trabajo";
            $PG .= ", sector_empleo_id";
            $PG .= ", actividad_eco_cod";
            $PG .= ", stelefono_contacto";
            $PG .= ", scargo";
            $PG .= ", dfecha_ingreso";
            $PG .= ", stipo_relacion";
            $PG .= ", dfecha_egreso";
            $PG .= ", sotra_habilidades";
            $PG .= ", nusuario_creacion";
            $PG .= ")";
            $PG .= " VALUES ";
            $PG .= "(";
            $PG .= "'$persona_id'";
            $PG .= ", '$rif'";
            $PG .= ", '$patrono'";
            $PG .= ", '$sector'";
            $PG .= ", '$economia'";
            $PG .= ", '$telefono'";
            $PG .= ", '$ocupacion'";
            $PG .= ", '$ingreso'";
            $PG .= ", '$relacion'";
            $PG .= ", '$egreso'";
            $PG .= ", '$otro'";
            $PG .= ", '$persona_id'";
            $PG .= ")";
        }
        $valor = pg_query($conn, $PG);
    }
} else {

    $PG = "UPDATE";
    $PG .= " snirlpcd.persona";
    $PG .= " SET";
    $PG .= " nexperiencia_laboral = '$experiencia'";
    $PG .= " WHERE";
    $PG .= " id='$persona_id';";

    $valor2 = pg_query($conn, $PG);
    echo "3 / Se ha guardado sus datos exitosamente";
    die();
}
/* } else {

    if ($experiencia == '1') {

        //VALIDACION PARA INGRESAR DATOS

        if ($rif != '') {
            if (!ereg("^[JGVE][0-9]{9}$", $_REQUEST['rif'])) {
                echo "1 / El RIF: " . $_REQUEST['rif'] . " No posse un formato válido, ejemplo: V00000021 / #rif";
            }
        }
        if ($patrono == '') {
            echo "1 / Debe llenar el campo \"Nombre o Razón de la Entidad de Trabajo\" / #patrono";
            die();
        }
        if ($ocupacion == '') {
            echo "1 / Debe llenar el campo \"Ocupación\" / #ocupacion";
            die();
        }
        if ($relacion == '-1') {
            echo "1 / Debe seleccionar una opción en el campo \"Tipo de Relación de Trabajo\" / #cbRelacion_trabajo";
            die();
        }
        $fecha_actual = date('Y-m-d');
        if ($egreso > '01') {
            if ($egreso < $ingreso) {
                echo "1 / La fecha de Egreso no puede ser menor a la de Ingreso / #f_egreso";
                die();
            } else
        if ($egreso == $ingreso) {
                echo "1 / La fecha de Egreso y la fecha de Ingreso no puden ser iguales / #f_egreso";
                die();
            }
            if ($ingreso < '1920-01-01') {
                echo "1 / La fecha de Ingreso no puede ser inferior al año 1920 / #f_ingreso";
                die();
            }
            if ($ingreso > $fecha_actual) {
                echo "1 / La fecha de Ingreso no puede ser superior a la fecha actual / #f_ingreso";
                die();
            }
            if ($egreso > $fecha_actual) {
                echo "1 / La fecha de Egreso no puede ser superior a la fecha actual / #f_egreso";
                die();
            }
        } else {
            if ($ingreso > 0) {
                if ($ingreso < '1920-01-01') {
                    echo "1 / La fecha de Ingreso no puede ser inferior al año 1920 / #f_ingreso";
                    die();
                }
                if ($ingreso > $fecha_actual) {
                    echo "1 / La fecha de Ingreso no puede ser superior a la fecha actual / #f_ingreso";
                    die();
                }
            } else {
                echo "1 / Debe registrar una Fecha de Ingreso / #f_ingreso";
                die();
            }
        }

       //ACTUALIZAR DATOS EN LA TABLA PERSONA

       $PG = "UPDATE";
       $PG .= " snirlpcd.persona";
       $PG .= " SET";
       $PG .= " bexperiencia_laboral = 'true'";
       $PG .= " WHERE";
       $PG .= " id='$persona_id';";

       $valor2 = pg_query($conn, $PG);

       //INSERTAR DATOS EN LA TABLA

       if ($egreso == '') {
           $PG = "INSERT INTO snirlpcd.persona_exp_laboral ";
           $PG .= "(";
           $PG .= "persona_id";
           $PG .= ", srif";
           $PG .= ", snombre_entidad_trabajo";
           $PG .= ", sector_empleo_id";
           $PG .= ", actividad_eco_cod";
           $PG .= ", stelefono_contacto";
           $PG .= ", scargo";
           $PG .= ", dfecha_ingreso";
           $PG .= ", stipo_relacion";
           $PG .= ", sotra_habilidades";
           $PG .= ", nusuario_creacion";
           $PG .= ")";
           $PG .= " VALUES ";
           $PG .= "(";
           $PG .= "'$persona_id'";
           $PG .= ", '$rif'";
           $PG .= ", '$patrono'";
           $PG .= ", '$sector'";
           $PG .= ", '$economia'";
           $PG .= ", '$telefono'";
           $PG .= ", '$ocupacion'";
           $PG .= ", '$ingreso'";
           $PG .= ", '$relacion'";
           $PG .= ", '$otro'";
           $PG .= ", '$persona_id'";
           $PG .= ")";
       } else {

           $PG = "INSERT INTO snirlpcd.persona_exp_laboral ";
           $PG .= "(";
           $PG .= "persona_id";
           $PG .= ", srif";
           $PG .= ", snombre_entidad_trabajo";
           $PG .= ", sector_empleo_id";
           $PG .= ", actividad_eco_cod";
           $PG .= ", stelefono_contacto";
           $PG .= ", scargo";
           $PG .= ", dfecha_ingreso";
           $PG .= ", stipo_relacion";
           $PG .= ", dfecha_egreso";
           $PG .= ", sotra_habilidades";
           $PG .= ", nusuario_creacion";
           $PG .= ")";
           $PG .= " VALUES ";
           $PG .= "(";
           $PG .= "'$persona_id'";
           $PG .= ", '$rif'";
           $PG .= ", '$patrono'";
           $PG .= ", '$sector'";
           $PG .= ", '$economia'";
           $PG .= ", '$telefono'";
           $PG .= ", '$ocupacion'";
           $PG .= ", '$ingreso'";
           $PG .= ", '$relacion'";
           $PG .= ", '$egreso'";
           $PG .= ", '$otro'";
           $PG .= ", '$persona_id'";
           $PG .= ")";
       }
       $valor = pg_query($conn, $PG);

    }else{

        //ACTUALIZAR DATOS EN LA TABLA PERSONA

        $PG = "UPDATE";
        $PG .= " snirlpcd.persona";
        $PG .= " SET";
        $PG .= " bexperiencia_laboral = 'false'";
        $PG .= " WHERE";
        $PG .= " id='$persona_id';";

        $valor2 = pg_query($conn, $PG);

    }
    
} */

/* if ($experiencia != '1') {
    echo "3 / Se ha guardado tus datos exitosamente";
    die();
} */

//CONSULTA LOS DATOS PARA QUE TE APARESCA EN LA TABLA

$PG2 = "SELECT";
$PG2 .= " *";
$PG2 .= " FROM";
$PG2 .= " snirlpcd.persona_exp_laboral";
$PG2 .= " WHERE";
$PG2 .= " persona_id =";
$PG2 .= " '$persona_id'";
$PG2 .= " AND";
$PG2 .= " benabled =";
$PG2 .= " 'true'";
$row2 = pg_query($conn, $PG2);
$vuelta = pg_num_rows($row);

while ($row = pg_fetch_assoc($row2)) {
    echo ('<tr><td>' . $row['scargo'] . '</td><td>' . $row['snombre_entidad_trabajo'] . '</td><td>' . $row['srif'] . '</td><td>' . $row['dfecha_ingreso'] . '</td><td><input type="button" class="btn btn-secondary" style="border-radius: 30px; display: inline-flex;" value="Editar" onclick="editar_experiencia(' . $row['id'] . ');"><input type="button" class="btn btn-danger" style="border-radius: 30px;display: inline-flex;" value="Borrar" onclick="eliminar_experiencia(' . $row['id'] . ');"></td></tr>');
}

if ($experiencia == '1') {
    echo " / Se ha guardado tus datos exitosamente ";
}

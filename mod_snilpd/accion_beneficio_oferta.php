<?php
$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

session_start();
include('../include/BD.php');
$conex = Conexion::ConexionBD();

try {
    $conex = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conex = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$accion = $_REQUEST['accion'];

if ($accion == 1) {
    $id_oferta = $_SESSION["id_oferta"];

    $tipo_beneficio = $_REQUEST["tipo_beneficio"];
    $beneficio_descrip = $_REQUEST["beneficio_descrip"];

    $SQL = "INSERT INTO";
    $SQL .= " snirlpcd.beneficios_oferta_empleo";
    $SQL .= " (";
    $SQL .= " oferta_empleo_id,";
    $SQL .= " sdescripcion,";
    $SQL .= " tipo_beneficio_id";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$id_oferta',";
    $SQL .= " '$beneficio_descrip',";
    $SQL .= " '$tipo_beneficio'";
    $SQL .= ");";

    if ($row = pg_query($conex, $SQL)) {
        echo "2 / Se guardó con éxito el registro";
        die();
    } else {
        echo "1 / No se permiten Caracteres Especiales en la Descripción";
        die();
    }
} else
if ($accion == 2) {

    $id_oferta = $_SESSION["id_oferta"];

    $PG6 = "SELECT";
    $PG6 .= " snirlpcd.beneficios_oferta_empleo.sdescripcion,";
    $PG6 .= " snirlpcd.beneficios_oferta_empleo.id,";
    $PG6 .= " public.tipo_beneficio.sdescripcion AS tipo_beneficio";
    $PG6 .= " FROM";
    $PG6 .= " snirlpcd.beneficios_oferta_empleo";
    $PG6 .= " INNER JOIN";
    $PG6 .= " public.tipo_beneficio";
    $PG6 .= " ON";
    $PG6 .= " public.tipo_beneficio.id=snirlpcd.beneficios_oferta_empleo.tipo_beneficio_id";
    $PG6 .= " WHERE";
    $PG6 .= " snirlpcd.beneficios_oferta_empleo.benabled='TRUE'";
    $PG6 .= " AND";
    $PG6 .= " snirlpcd.beneficios_oferta_empleo.oferta_empleo_id='$id_oferta'";
    $PG6 .= " ORDER BY";
    $PG6 .= " snirlpcd.beneficios_oferta_empleo.id ASC";

    $beneficio = pg_query($conex, $PG6);
    while ($row5 = pg_fetch_assoc($beneficio)) {
        $i2++;
        echo '
        <tr>
            <td>' . $i2 . '</td>
            <td>' . $row5['tipo_beneficio'] . '</td>
            <td>' . $row5['sdescripcion'] . '</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="modificarRegistro(' . $row5['id'] . ')" style="background-color: #e99002; border-radius: 30px;">Modificar</button>
                <button type="button" class="btn btn-danger" onclick="eliminarRegistro(' . $row5['id'] . ')" style="background-color: #f04124; border-radius: 30px;">Eliminar</button>
            </td>
        </tr>
    ';
    }
} else
if ($accion == 3) {
    $id = $_REQUEST['id'];

    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.beneficios_oferta_empleo";
    $SQL .= " WHERE";
    $SQL .= " id='$id'";
    $SQL .= " AND";
    $SQL .= " benabled ='true'";

    $valor = pg_query($conex, $SQL);
    $row = pg_fetch_assoc($valor);

    echo $row['id'] . " / " . $row['tipo_beneficio_id'] . " / " . $row['sdescripcion'];
} else
if ($accion == 4) {
    $id_oferta = $_REQUEST["id"];

    $tipo_beneficio = $_REQUEST["tipo_beneficio"];
    $beneficio_descrip = $_REQUEST["beneficio_descrip"];

    if ($tipo_beneficio == '-1') {
        echo "1 / Error, el campo \"Tipo de Beneficio\" es obligatorio";
        die();
    }
    if ($beneficio_descrip == '') {
        echo "1 / Error, el campo \"Descripción\" del apartado \"Beneficios\"es obligatorio";
        die();
    }

    $SQL = "UPDATE";
    $SQL .= " snirlpcd.beneficios_oferta_empleo";
    $SQL .= " SET";
    $SQL .= " sdescripcion = '$beneficio_descrip',";
    $SQL .= " tipo_beneficio_id = '$tipo_beneficio'";
    $SQL .= " WHERE";
    $SQL .= " id = '$id_oferta'";

    if ($row = pg_query($conex, $SQL)) {
        echo "2 / Se Modificó con éxito el registro";
        die();
    } else {
        echo "1 / No se permiten Caracteres Especiales en la Descripción";
        die();
    }
} else
if ($accion == 5) {
    $id = $_REQUEST['id'];

    $SQL = "UPDATE";
    $SQL .= " snirlpcd.beneficios_oferta_empleo";
    $SQL .= " SET";
    $SQL .= " benabled = 'false'";
    $SQL .= " WHERE";
    $SQL .= " id = '$id'";

    if ($row = pg_query($conex, $SQL)) {
        echo "Se Eliminó con éxito el registro";
        die();
    } else {
        echo "Ocurrió un error inesperado, por favor intentar más tarde";
        die();
    }
} else
if ($accion == 6) {
    $id_oferta = $_SESSION["id_oferta"];

    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.beneficios_oferta_empleo";
    $SQL .= " WHERE";
    $SQL .= " oferta_empleo_id='$id_oferta'";
    $SQL .= " AND";
    $SQL .= " benabled ='true'";
    $valor = pg_query($conex, $SQL);
    $row = pg_fetch_assoc($valor);

    if ($row == '') {
        echo "1 / Debe llenar al menos un requisito para continuar";
        die();
    }
}

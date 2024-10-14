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

    $nivel_requisito = $_REQUEST["nivel_requisito"];
    $descrip_nivel = $_REQUEST["descrip_nivel"];

    if ($nivel_requisito == '-1') {
        echo "Error, el campo \"Nivel de Requerimiento\" es obligatorio";
        die();
    }
    if ($descrip_nivel == '') {
        echo "Error, el campo \"Descripción\" del apartado \"Requisitos\"es obligatorio";
        die();
    }

    $SQL = "INSERT INTO";
    $SQL .= " snirlpcd.requisitos_oferta_empleo";
    $SQL .= " (";
    $SQL .= " oferta_empleo_id,";
    $SQL .= " sdescripcion,";
    $SQL .= " nivel_requisito_id";
    $SQL .= ")";
    $SQL .= " VALUES";
    $SQL .= " (";
    $SQL .= "'$id_oferta',";
    $SQL .= " '$descrip_nivel',";
    $SQL .= " '$nivel_requisito'";
    $SQL .= ");";

    if ($row = pg_query($conex, $SQL)) {
        echo "Se guardó con éxito el requisito";
    } else {
        echo $SQL;
    }
} else
if ($accion == 2) {
    $id_oferta = $_SESSION["id_oferta"];

    $PG5 = "SELECT";
    $PG5 .= " snirlpcd.requisitos_oferta_empleo.id,";
    $PG5 .= " snirlpcd.requisitos_oferta_empleo.sdescripcion,";
    $PG5 .= " public.nivel_requisito.sdescripcion AS nivel_requisito";
    $PG5 .= " FROM";
    $PG5 .= " snirlpcd.requisitos_oferta_empleo";
    $PG5 .= " INNER JOIN";
    $PG5 .= " public.nivel_requisito";
    $PG5 .= " ON";
    $PG5 .= " public.nivel_requisito.id";
    $PG5 .= " =";
    $PG5 .= " snirlpcd.requisitos_oferta_empleo.nivel_requisito_id";
    $PG5 .= " WHERE";
    $PG5 .= " snirlpcd.requisitos_oferta_empleo.oferta_empleo_id='$id_oferta'";
    $PG5 .= " AND";
    $PG5 .= " snirlpcd.requisitos_oferta_empleo.benabled ='TRUE'";
    $PG5 .= " ORDER BY";
    $PG5 .= " snirlpcd.requisitos_oferta_empleo.nivel_requisito_id ASC ";

    $requisito = pg_query($conex, $PG5);
    while ($row = pg_fetch_assoc($requisito)) {
        $i++;
        echo ('<tr>
        <td>' . $i . '</td>
        <td>' . $row['nivel_requisito'] . '</td>
        <td>' . $row['sdescripcion'] . '</td>
        <td>
            <button type="button" class="btn btn-warning" onclick="modificarRegistro(' . $row['id'] . ')" style="background-color: #e99002; border-radius: 30px;">Modificar</button>
            <button type="button" class="btn btn-danger" onclick="eliminarRegistro(' . $row['id'] . ')" style="background-color: #f04124; border-radius: 30px;">Eliminar</button>
        </td>
        </tr>');
    }
} else
if ($accion == 3) {
    $id = $_REQUEST['id_oferta'];

    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.requisitos_oferta_empleo";
    $SQL .= " WHERE";
    $SQL .= " id='$id'";
    $SQL .= " AND";
    $SQL .= " benabled ='true'";

    $valor = pg_query($conex, $SQL);
    $row = pg_fetch_assoc($valor);

    echo $row['id'] . " / " . $row['nivel_requisito_id'] . " / " . $row['sdescripcion'];
} else
if ($accion == 4) {
    $id = $_REQUEST['id'];
    $nivel_requisito = $_REQUEST["nivel_requisito"];
    $descrip_nivel = $_REQUEST["descrip_nivel"];

    if ($nivel_requisito == '-1') {
        echo "Error, el campo \"Nivel de Requerimiento\" es obligatorio";
        die();
    }
    if ($descrip_nivel == '') {
        echo "Error, el campo \"Descripción\" del apartado \"Requisitos\"es obligatorio";
        die();
    }

    $SQL = "UPDATE";
    $SQL .= " snirlpcd.requisitos_oferta_empleo";
    $SQL .= " SET";
    $SQL .= " sdescripcion = '$descrip_nivel',";
    $SQL .= " nivel_requisito_id = '$nivel_requisito'";
    $SQL .= " WHERE";
    $SQL .= " id = '$id'";

    if ($row = pg_query($conex, $SQL)) {
        echo "Se actualizó con éxito el requisito";
    } else {
        echo "Ocurrió un error inesperado, por favor intentar más tarde";
    }
} else
if ($accion == 5) {
    $id = $_REQUEST['id'];

    $SQL = "UPDATE";
    $SQL .= " snirlpcd.requisitos_oferta_empleo";
    $SQL .= " SET";
    $SQL .= " benabled = 'false'";
    $SQL .= " WHERE";
    $SQL .= " id = '$id'";

    if ($row = pg_query($conex, $SQL)) {
        echo "Se Eliminó con éxito el requisito";
    } else {
        echo "Ocurrió un error inesperado, por favor intentar más tarde";
    }
} else
if ($accion == 6) {
    $id_oferta = $_SESSION["id_oferta"];

    $SQL = "SELECT";
    $SQL .= " *";
    $SQL .= " FROM";
    $SQL .= " snirlpcd.requisitos_oferta_empleo";
    $SQL .= " WHERE";
    $SQL .= " oferta_empleo_id='$id_oferta'";
    $SQL .= " AND";
    $SQL .= " benabled ='true'";
    $valor = pg_query($conex, $SQL);
    $row = pg_fetch_assoc($valor);

    if ($row == '') {
        echo "1 / Debe llenar al menos un requisito para continuar";
    }
}

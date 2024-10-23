<?

include('based.php');
$accion = $_REQUEST['accion'];

if ($accion == 1) {

    $personales = $_SESSION["id_persona"];

    $num_informe = $_REQUEST['num_informe'];
    $name = $_REQUEST['name'];
    $identification_card = $_REQUEST['cedula'];
    $last_name = $_REQUEST['last_name'];
    $ubicacion_adm = $_REQUEST['ubicacion_adm'];
    $ubicacion_fisica = $_REQUEST['ubicacion_fisica'];
    $cargo_titular = $_REQUEST['cargo_titular'];
    $cargo_actual = $_REQUEST['cargo_actual'];

    $resalt = " SELECT personales.cedula as cedula,";
    $resalt .= " personales.id as id,";
    $resalt .= " personales.primer_apellido as apellido1,";
    $resalt .= " personales.segundo_apellido as apellido2,";
    $resalt .= " personales.primer_nombre as nombre1,";
    $resalt .= " personales.segundo_nombre as nombre2,";
    $resalt .= " personales.subicacion_fisica as ubicacion_fisica_actual,";
    $resalt .= " personales.scargo_actual_ejerce as cargo_actual_ejerce,";
    $resalt .= " public.cargos.sdescripcion as cargo,";
    $resalt .= " reportes_fallas.snro_reporte  as reporte,";
    $resalt .= " public.ubicacion_administrativa.sdescripcion as ubicacion_adm";
    $resalt .= " FROM public.personales";
    $resalt .= " LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula";
    $resalt .= " LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id";
    $resalt .= " LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo";
    $resalt .= " LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo";
    $resalt .= " LEFT JOIN reporte_tecnico.reportes_fallas ON reportes_fallas.personales_id = personales.id";
    $resalt .= " WHERE reportes_fallas.snro_reporte = '$num_informe' AND benabled = 'TRUE' AND reportes_fallas.personales_id = '$personales' LIMIT 1";

    /* echo "0 / " . $resalt;
    die(); */

    $SQL = pg_query($conn, $resalt);

    if ($row = pg_fetch_array($SQL, NULL, PGSQL_ASSOC)) {

        $identification_card = $row['cedula'];
        $_SESSION["id_persona"] = $row['id'];
        $_SESSION["nusuario_creacion"] = $cedula;

        $star = $row['nombre1'];
        $echo = $row['nombre2'];
        $name = $row['nombre1'] . " " . $row['nombre2'];

        $apellido1 = $row['apellido1'];
        $apellido2 = $row['apellido2'];
        $last_name = $row['apellido1'] . " " . $row['apellido2'];

        $ubicacion_adm = $row['ubicacion_adm'];

        $ubicacion_fisica = $row['ubicacion_fisica_actual'];

        $cargo_titular = $row['cargo'];

        $cargo_actual = $row['cargo_actual_ejerce'];
    } else {
        echo "0 / No se encontró éste número de reporte, por favor verifique sí es correcto";
        die();
    }

    $resalt2 = " SELECT * FROM
                reporte_tecnico.reportes_fallas
                WHERE
                snro_reporte = '$num_informe'
                AND
                benabled = 'TRUE'
    ";

    /* echo "0 / " . $resalt;
    die(); */

    $SQL2 = pg_query($conn, $resalt2);
    $persona = pg_fetch_assoc($SQL2);

    $id_reporte = $persona["id"];
    $snro_reporte = $persona["snro_reporte"];
    $nnumero_requer_glpi = $persona["nnumero_requer_glpi"];
    $ubicacion_administrativa_scodigo = $persona["ubicacion_administrativa_scodigo"];

    $_SESSION['snro_reporte2'] = $snro_reporte;

    $todo = "1 / " . $identification_card . " / " . $name . " / " . $last_name . " / " . $ubicacion_adm . " / " . $ubicacion_fisica . " / " . $cargo_titular . " / " . $cargo_actual . " / " . $id_reporte . " / " . $snro_reporte . " / " . $nnumero_requer_glpi . " / " . $ubicacion_administrativa_scodigo;

    $date = date('Ymd');

    $personales = $_SESSION["id_persona"];

    $information = " SELECT";
    $information .= " reporte_tecnico.reportes_fallas.id AS id_reporte,";
    $information .= " personales_id,";
    $information .= " dispositivos_id,";
    $information .= " snombre_dispositivo,";
    $information .= " sdisco_duro,";
    $information .= " smemoria_ram,";
    $information .= " dispositivos.sdescripcion AS tipo_disp,";
    $information .= " nnumero_requer_glpi,";
    $information .= " ubicacion_administrativa_scodigo,";
    $information .= " marca_id,";
    $information .= " marca.sdescripcion As marca,";
    $information .= " smodelo,";
    $information .= " nbien_publico,";
    $information .= " reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,";
    $information .= " sobservaciones_tecnico,";
    $information .= " srecomendaciones_tecnico,";
    $information .= " sserial,";
    $information .= " estatus_id,";
    $information .= " estatus.sdescripcion As estatus,";
    $information .= " estatus_final,";
    $information .= " reporte_tecnico.reportes_fallas.nusuario_creacion,";
    $information .= " motivo_desincorporacion,";
    $information .= " reporte_tecnico.reportes_fallas.snro_reporte,";
    $information .= " reporte_tecnico.reportes_fallas.dfecha_creacion";
    $information .= " FROM";
    $information .= " reporte_tecnico.reportes_fallas";
    $information .= " inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id";
    $information .= " inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id";
    $information .= " inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id";
    $information .= " where reportes_fallas.benabled='TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' ";
    $information .= " AND";
    $information .= " dispositivos.benabled = 'TRUE'";
    $information .= " AND";
    $information .= " reportes_fallas.snro_reporte is not null";
    $information .= " AND";
    $information .= " reportes_fallas.snro_reporte != 'No se ha generado un numero de reporte.'";
    $information .= " AND";
    $information .= " cod_estatus = '1'";
    $information .= " AND";
    $information .= " reportes_fallas.benabled = 'TRUE'";
    $information .= " AND";
    $information .= " reportes_fallas.snro_reporte = '$num_informe'";
    $information .= " AND";
    $information .= " reportes_fallas.personales_id = '$personales'";
    $information .= " ORDER BY snro_reporte desc";

    $row = pg_query($conn, $information);
    $info = pg_fetch_all($row);

    $element = " / ";

    while ($info =  pg_fetch_assoc($row)) {
        $i++;
        $element .= "
                    <tr>
                        <td>" . $i . "</td>
                        <td>" . $info['tipo_disp'] . "</td>
                        <td>" . $info['marca'] . "</td>
                        <td>" . $info['smodelo'] . "</td>
                        <td>" . $info['nbien_publico'] . "</td> 
                        <td>" . $info['sserial'] . "</td>
                        <td>" . $info['estatus'] . "</td>
                        <td> <div class=\"button-grid\" style=\"display: flex; justify-content: center; gap: 10px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; text-align: center;\">
                            <button type=\"button\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 15px; border-radius: 20px; width: auto; max-width: 90px; text-align: center;\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#46A2FD'; this.style.border='1px Solid #46A2FD''\" onmouseover=\"'this.style.color='#46A2FD'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"accion_editar_registro('" . $info['snro_reporte'] . "','" . $info['id_reporte'] . "','" . $info['nnumero_requer_glpi'] . "','" . $info['ubicacion_administrativa_scodigo'] . "','" . $info['nbien_publico'] . "','" . $info['snombre_dispositivo'] . "','" . $info['dispositivos_id'] . "','" . $info['estatus_id'] . "','" . $info['marca_id'] . "','" . $info['smodelo'] . "','" . $info['sserial'] . "','" . $info['sdisco_duro'] . "','" . $info['smemoria_ram'] . "','" . $info['sobservaciones_tecnico'] . "','" . $info['srecomendaciones_tecnico'] . "','" . $info['estatus_final'] . "','" . $info['motivo_desincorporacion'] . "','" . $info['marca'] . "','" . $info['tipo_disp'] . "','" . $info['estatus'] . "','" . $info['usuario'] . "')\"><center>Modificar </center></button>
                            <button type=\"button\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 20px; width: auto; max-width: 90px;\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#dc3545'; this.style.border='1px Solid #dc3545''\" onmouseover=\"'this.style.color='#dc3545'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"borrar('" . $info['id_reporte'] . "')\">Eliminar </button>
                            </div>
                        </td>
                    </tr>
        ";
    }
    if ($element == " / ") {
        /* $element = " / " . $information; */
        $element = " / No hay ningún dato en la Tabla";
    }

    $_SESSION["IMG"] = $i - 1;
    $todo .= $element;
    echo $todo;
} else
if ($accion == 2) {
    $snro_reporte = $_SESSION['snro_reporte2'];
    $cant_img = $_SESSION["IMG"] + 1;

    if ($snro_reporte != '') {
        /*
            $SQL3 = "UPDATE reporte_tecnico.reportes_fallas SET cod_estatus = 2 WHERE snro_reporte = '$snro_reporte' AND benabled = 'TRUE'";

            if ($resultado3 = pg_query($conn, $SQL3)) {
                echo "1 / Su número de reporte es: " . $snro_reporte;
                die();
            } else {
                echo "1 / Falló la actualización por: " . $SQL3;
                die();
            }
        */


        $information2 = " SELECT * FROM";
        $information2 .= " reporte_tecnico.reportes_fallas";
        $information2 .= " WHERE";
        $information2 .= " cod_estatus = '1'";
        $information2 .= " AND";
        $information2 .= " snro_reporte = '$snro_reporte'";
        $information2 .= " AND";
        $information2 .= " estatus_final is not null";
        $information2 .= " AND";
        $information2 .= " sobservaciones_tecnico != ''";
        $information2 .= " AND";
        $information2 .= " srecomendaciones_tecnico != ''";
        $information2 .= " AND";
        $information2 .= " benabled = 'TRUE'";

        $row2 = pg_query($conn, $information2);
        $info2 = pg_fetch_all($row2);

        $i = 0;

        while ($info2 = pg_fetch_assoc($row2)) {
            $i++;
        }
        if ($i == $cant_img) {
            /* echo "0 / Son iguales - " . $i . " - " . $cant_img; */

            /* $SQL3 = "UPDATE reporte_tecnico.reportes_fallas SET cod_estatus = 1 WHERE snro_reporte = '$snro_reporte' AND benabled = 'TRUE'";

            if ($resultado3 = pg_query($conn, $SQL3)) {
                echo "1 / Su número de reporte es: " . $snro_reporte;
                die();
            } else {
                echo "1 / Falló la actualización por: " . $SQL3;
                die();
            } */
            echo "1 / Se modifico el registro  correctamente";
            die();
        } else {
            echo "0 / Para poder continuar, debe asegurarse de haber editado a todos los dispositivos del formulario";
            /* echo "0 / Culpa de: " . $information2; */
            die();
        }

        /* echo "0 / Éste es su número de Reporte: " . $snro_reporte;
        die(); */
    } else {
        echo "0 / Antes de continuar debe terminar con el proceso de actualización del informe";
        die();
    }
}setTimeout(function() {
    window.location.reload(); // Recargar la página después de 4 segundos (4000 milisegundos)
}, 4000);

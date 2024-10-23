<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros del Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos6.css">
    <link rel="stylesheet" href="css/alerta.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<body>
    <input type="text" value="" style="display: none" id="validador">
    <div class="logo"></div>
    <br>
    <div class="container">
        <?php include('menuprincipal.php'); ?>  
        <div class="container2">
            <div class="row">
                <div class="col-sm-12">
                    <h2>CONSULTA - Listado del Registro por Número del Informe Técnico</h2>
                </div>
                <div class="col-sm-4"></div>
                <div class="sep"></div>
                <hr>
                <br>
                <div class="table-responsive">
                <table id="miTabla2" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Dispositivos</th>
                            <th>Marca</th>
                            <th>Nro.Bien Público</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            <th>Disco Duro</th>
                            <th>Memoria Ram</th>
                            <th>Ubicación Administrativa</th>
                            <th>Nro. de Requerimiento</th>
                            <th>Observaciones</th>
                            <th>Recomendaciones</th>
                            <th>Estatus</th>
                            <th>Fecha de Creación</th>
                            <th>Número Reporte</th>
                        </tr>
                    </thead>
                    <tbody id="mostrar_listado">
    <!-- Aquí se mostrarán los resultados -->
    <?php
    include('based.php');

    // Verifica si los parámetros 'reporte' y 'cedula' están presentes en la URL
    if (isset($_GET['reporte']) && isset($_GET['cedula'])) {
        // Obtén los valores de los parámetros
        $snro_reporte = htmlspecialchars($_GET['reporte']);
        $cedula = htmlspecialchars($_GET['cedula']);

        // Consulta preparada
        $sql = "SELECT reporte_tecnico.reportes_fallas.id AS id_reporte, personales_id, dispositivos_id, snombre_dispositivo,
                sdisco_duro, smemoria_ram, dispositivos.sdescripcion AS tipo_disp, nnumero_requer_glpi, ubicacion_administrativa_scodigo,
                marca_id, marca.sdescripcion AS marca, smodelo, nbien_publico, reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,
                sobservaciones_tecnico, srecomendaciones_tecnico, sserial, estatus_id, estatus.sdescripcion AS estatus, estatus_final,
                motivo_desincorporacion, reporte_tecnico.reportes_fallas.snro_reporte,
                reporte_tecnico.reportes_fallas.dfecha_creacion
                FROM reporte_tecnico.reportes_fallas
                INNER JOIN reporte_tecnico.dispositivos ON dispositivos.id = reportes_fallas.dispositivos_id
                INNER JOIN reporte_tecnico.marca ON marca.id = reportes_fallas.marca_id INNER JOIN reporte_tecnico.estatus ON estatus.id = reportes_fallas.estatus_id
                WHERE reportes_fallas.benabled = 'TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' 
                AND dispositivos.benabled = 'TRUE' AND reportes_fallas.snro_reporte IS NOT NULL 
                AND reportes_fallas.snro_reporte = $1  AND reportes_fallas.nusuario_creacion = $2 
                ORDER BY reporte_tecnico.reportes_fallas.snro_reporte DESC";

        // Prepara la consulta
        $result = pg_prepare($conn, "my_query", $sql);
        if (!$result) {
            $error_message = "Error en la preparación de la consulta: " . pg_last_error($conn);
            echo "<tr><td colspan='15'>$error_message</td></tr>";
        } else {
            // Ejecuta la consulta
            $result = pg_execute($conn, "my_query", array($snro_reporte, $cedula));
            if (!$result) {
                $error_message = "Error en la ejecución de la consulta: " . pg_last_error($conn);
                echo "<tr><td colspan='15'>$error_message</td></tr>";
            } else {
                $element = "";
                $i = 0;
                while ($persona2 = pg_fetch_assoc($result)) {
                    $i++;
                    $sobservaciones_tecnico = !empty($persona2['sobservaciones_tecnico']) ? htmlspecialchars($persona2['sobservaciones_tecnico']) : "(N/P)";
                    $srecomendaciones_tecnico = !empty($persona2['srecomendaciones_tecnico']) ? htmlspecialchars($persona2['srecomendaciones_tecnico']) : "(N/P)";

                    $element .= "
                        <tr>
                            <td>" . strtoupper($i) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['tipo_disp'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['marca'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['nbien_publico'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['smodelo'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['sserial'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['sdisco_duro'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['smemoria_ram'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['ubicacion_administrativa_scodigo'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['nnumero_requer_glpi'])) . "</td>
                            <td>" . strtoupper($sobservaciones_tecnico) . "</td>
                            <td>" . strtoupper($srecomendaciones_tecnico) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['estatus'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['dfecha_creacion'])) . "</td>
                            <td>" . strtoupper(htmlspecialchars($persona2['snro_reporte'])) . "</td>
                        </tr>
                    ";
                }

                if ($element == '') {
                    $element = "
                        <tr>
                            <td colspan='15'>Este Usuario no ha registrado nada</td>
                        </tr>
                    ";
                }

                echo $element;
            }
        }
        pg_close($conn);
    } else {
        echo "
            <tr>
                <td colspan='15'>No se proporcionaron todos los parámetros necesarios.</td>
            </tr>
        ";
    }
    ?>
</tbody>
</table>
</div>
</div>
<div class="col-12" style="text-align:center;">
    <a href="vista.php"><button class="btn" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>            
</div>
</div>
</div>
<footer>
    <div class="container3">
        <div class="row" style="--bs-gutter-x: 0;">
            <div class="col-md-6" style="border-right: 1px solid white;">
                <h3 class="sep-3" style="font-size: 16px;">División de Soporte Técnico</h3>
            </div>
            <div class="col-md-6" style="padding-left: 10px">
                <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
            </div>
        </div>
    </div>
</footer>
</html>
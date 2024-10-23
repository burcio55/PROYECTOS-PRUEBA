<?php 
 include('based.php');
 // Verifica si los parámetros 'reporte' y 'cedula' están presentes en la URL
 if (isset($_GET['reporte'])) {
    $snro_reporte = htmlspecialchars($_GET['reporte']);
}
?>
<!DOCTYPE html>
<html lang="Es-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos5.css">
    <link rel="stylesheet" href="css/alerta.css">
    <script src="code.jquery.com_jquery-3.7.0.js"></script>
</head>

<body>
    <div id="observacion" class="fondo_alerta" style="display: none;">
        <div class="alerta">
            <h4 id="titulo">Atención</h4>
            <p id="texto"></p>
            <div class="sep"></div>
            <center><button type="button" onclick="cerrar()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button></center>
            <div class="sep"></div>
        </div>
    </div>
    <div class="logo"></div>
    <br>
    <div class="container">
        <?
        include('menuprincipal.php');
        ?>
        <div class="container2">
            <h2>CONSULTA - Por Nro. de Informe Técnico</h2>
            <br>
            <h6 class="obligatorio" style="text-align:right">Datos Obligatorios (*)</h6>
            <hr>
            <h6 style="text-align: left;">NOTA:</h6>
            <h6 style="color: #212529; text-align: left; font-weight: normal;">Usted podrá realizar esta consulta a través del Número del Informe Técnico, registrado con anterioridad.</h6>
            <br>
            <div class="row">
                <div class="col-sm-6" style="margin-left: 10%">
                    <div class="input-group">
                        <label for="basic-url" class="form-label" style="margin-top:10px">Nro. de Informe Técnico <span></span><span>*</span> </label> <span class="mma"></span>
                        <span class="input-group-text" style="border-radius: 30px 0 0 30px" id="addon-wrapping"><img src="img/bandera.png" class="icon"></span>
                        <input type="text" class="form-control" placeholder="Ej.20240701-001" id="num_tecnico" value="<?php print $snro_reporte;?>">
                    </div>
                </div>

                <div class="sep"></div>
                <div class="col-sm-5"></div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <button onclick="buscar()" class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Buscar</button>
                    </div>
                </div>
                <div class="sep"></div>
                <hr>
                <div class="col-sm-12"></div>
                <div class="col-sm-4">
                    <label for="basic-url" class="form-label">Cédula de Identidad</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="cedula" placeholder="Ej. 30556894" disabled>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="basic-url" class="form-label">Nombre(s)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nombres" placeholder="Ej. Natalia" disabled>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="basic-url" class="form-label">Apellido(s)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="apellidos" placeholder="Ej. Gomez" disabled>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="col-sm-4">
                    <label for="basic-url" class="form-label">Nro. de Informe Técnico</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="reporte" placeholder="Ej. 230224-001" disabled>
                    </div>
                </div>
                <div class="col-sm-8">
                    <label for="basic-url" class="form-label">Ubicación Administrativa de Adscripción</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="ubicacion_adm" placeholder="Ej. Despacho del Ministro" disabled>
                    </div>
                </div>
                <div class="col-sm-4" style="display: none;">
                    <label for="basic-url" class="form-label">ID del dispositivo</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="dispositivos_id" placeholder="Ej. 8" disabled>
                    </div>
                </div>
                <div class="sep"></div>
                <br>
                <div class="col-12" style="text-align:center;">
                    <a href="actualizar.php">
                        <button class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button>
                    </a>
                    <button onclick="imprimir()" class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
</body>
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
<script src="buscar.js"></script>

</html>
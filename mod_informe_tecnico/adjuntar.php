<?
include('based.php');
?>
<!DOCTYPE html>
<html lang="Es-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Informe Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos4.css">
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
    <div id="observacion2" class="fondo_alerta" style="display: none;">
        <div class="alerta">
            <h4 id="titulo2">Atención</h4>
            <p id="texto2"></p>
            <div class="sep"></div>
            <center><button type="button" onclick="cerrar2()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button></center>
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
            <h2>INFORME TÉCNICO - Adjuntar Imágenes</h2>
            <br>
            <div class="row">
                <h6 class="obligatorio" style="text-align: right">Datos Obligatorios (*)</h6>
                <h4 style="color: #0d6efd; font-weight: normal; margin-top: -30px">Adjuntar Imágenes</h4>
                <hr>
                <h6 class="obligatorio" style="text-align: center">Los formatos permitidos son "png", "jpg" y "jpeg"</h6>
                <form action="foto.php" method="POST" enctype="multipart/form-data">
                    <div class=" mb-5 epa" style="margin-bottom: 0;">
                        <?
                        $cant_img = $_SESSION["IMG"] + 1;

                        for ($i = 0; $i < $cant_img; $i++) {
                            if ($i == 0) {
                                $tit = "1er";
                            } else
                        if ($i == 1) {
                                $tit = "2d";
                            } else
                        if ($i == 2) {
                                $tit = "3er";
                            } else
                        if ($i == 3) {
                                $tit = "4t";
                            } else
                        if ($i == 4) {
                                $tit = "5t";
                            }
                        ?>
                            <div class="col-md-12">
                                <label for="inputmodelo" class="form-label"> Adjuntar la imagen del <? echo $tit; ?> dispositivo <span>*</span></label>
                                <div class="input-group" style="max-width: 95%;">
                                    <span class="input-group-text" id="basic-addon1"> <img src="img/mr.png" class="icon"> </span>
                                    <input type="file" name="foto<? echo $i; ?>" id="foto<? echo $i; ?>" class="form-control" style="display: block; border-radius: 0 30px 30px 0" required>
                                </div>
                            </div>
                            <br>
                        <?
                        }
                        ?>
                        <div class="col-12" style="text-align:center;">
                            <a href="actualizar.php">
                                <button type="button" class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button>
                            </a>
                            <button type="submit" class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Guardar</button>
                        </div>
                    </div>
                </form>
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
</body>

</html>
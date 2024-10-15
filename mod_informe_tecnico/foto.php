<?php
include('based.php');
?>


<!DOCTYPE html>
<html lang="Es-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/validar.css">
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
            <div class="row">
                <div class="col-sm-12">
                    <h2>INFORME TÉCNICO - Actualizar</h2>
                    <hr>
                </div>
                <?

                // Código de imágenes

                $cant = 0;
                $type1 = 0;
                $type2 = 0;
                $type3 = 0;
                $type4 = 0;
                $type5 = 0;

                // Primer Archivo
                if (isset($_FILES["foto0"])) {
                    $nombre1 = $_FILES["foto0"]["name"];
                    $tipo1 = $_FILES["foto0"]["type"];
                    $temporal1 = $_FILES["foto0"]["tmp_name"];

                    if (!in_array($tipo1, ["image/png", "image/jpg", "image/jpeg"])) {
                        $type1++;
                    }
                    $fecha_hora = date("Y-m-d H:i:s");
                    $nombre_unico1 = $fecha_hora . " - " . $nombre1;
                    $ruta1 = "img/" . $nombre1;
                    $cant++;
                }

                // Segundo Archivo
                if (isset($_FILES["foto1"])) {
                    $nombre2 = $_FILES["foto1"]["name"];
                    $tipo2 = $_FILES["foto1"]["type"];
                    $temporal2 = $_FILES["foto1"]["tmp_name"];

                    if (!in_array($tipo2, ["image/png", "image/jpg", "image/jpeg"])) {
                        $type2++;
                    }
                    $fecha_hora = date("Y-m-d H:i:s");
                    $nombre_unico2 = $fecha_hora . " - " . $nombre2;
                    $ruta2 = "img/" . $nombre2;
                    $cant++;
                }

                // Tercer Archivo
                if (isset($_FILES["foto2"])) {
                    $nombre3 = $_FILES["foto2"]["name"];
                    $tipo3 = $_FILES["foto2"]["type"];
                    $temporal3 = $_FILES["foto2"]["tmp_name"];

                    if (!in_array($tipo3, ["image/png", "image/jpg", "image/jpeg"])) {
                        $type3++;
                    }
                    $fecha_hora = date("Y-m-d H:i:s");
                    $nombre_unico3 = $fecha_hora . " - " . $nombre3;
                    $ruta3 = "img/" . $nombre3;
                    $cant++;
                }

                // Cuarto Archivo
                if (isset($_FILES["foto3"])) {
                    $nombre4 = $_FILES["foto3"]["name"];
                    $tipo4 = $_FILES["foto3"]["type"];
                    $temporal4 = $_FILES["foto3"]["tmp_name"];

                    if (!in_array($tipo4, ["image/png", "image/jpg", "image/jpeg"])) {
                        $type4++;
                    }
                    $fecha_hora = date("Y-m-d H:i:s");
                    $nombre_unico4 = $fecha_hora . " - " . $nombre4;
                    $ruta4 = "img/" . $nombre4;
                    $cant++;
                }

                // Quinto Archivo
                if (isset($_FILES["foto4"])) {
                    $nombre5 = $_FILES["foto4"]["name"];
                    $tipo5 = $_FILES["foto4"]["type"];
                    $temporal5 = $_FILES["foto4"]["tmp_name"];

                    if (!in_array($tipo5, ["image/png", "image/jpg", "image/jpeg"])) {
                        $type5++;
                    }
                    $fecha_hora = date("Y-m-d H:i:s");
                    $nombre_unico5 = $fecha_hora . " - " . $nombre5;
                    $ruta5 = "img/" . $nombre5;
                    $cant++;
                }

                if ($type1 > 0 || $type2 > 0 || $type3 > 0 || $type4 > 0 || $type5 > 0) {
                ?>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <script>
                        document.getElementById("texto2").innerText = "Ocurrió un problema, asegurece de que las imágnes subidas cumplan con los formatos permitidas (\"png\", \"jpg\" y \"jpeg\")";
                        document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
                        document.getElementById("titulo2").style.color = "white";
                        document.getElementById("observacion2").style.display = "block";
                    </script>
                <?
                }
                if ($cant == 0) {
                ?>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <script>
                        document.getElementById("texto2").innerText = "Ocurrió un error inesperado, por favor volver a intentar";
                        document.getElementById("titulo2").style.backgroundColor = "#DC3831"; //Rojo
                        document.getElementById("titulo2").style.color = "white";
                        document.getElementById("observacion2").style.display = "block";
                    </script>
                    <?
                } else {

                    $snro_reporte = $_SESSION['snro_reporte2'];

                    $information = " SELECT * FROM";
                    $information .= " reporte_tecnico.reportes_fallas";
                    $information .= " WHERE";
                    $information .= " snro_reporte = '$snro_reporte'";
                    $information .= " AND";
                    $information .= " benabled = 'TRUE'";

                    $row = pg_query($conn, $information);

                    $j = 0;

                    while ($info = pg_fetch_assoc($row)) {
                        if ($j == 0) {
                            $id1 = $info["id"];
                        } else
                        if ($j == 1) {
                            $id2 = $info["id"];
                        } else
                        if ($j == 2) {
                            $id3 = $info["id"];
                        } else
                        if ($j == 3) {
                            $id4 = $info["id"];
                        } else
                        if ($j == 4) {
                            $id5 = $info["id"];
                        }
                        $j++;
                    }

                    for ($i = 0; $i < $cant; $i++) {
                        if ($i == 0) {
                            $tit = "1er";
                            $img = $ruta1;
                            move_uploaded_file($temporal1, $ruta1);

                            $SQL1 = "UPDATE";
                            $SQL1 .= " reporte_tecnico.reportes_fallas";
                            $SQL1 .= " SET";
                            $SQL1 .= " simagen = '$ruta1'";
                            $SQL1 .= " WHERE";
                            $SQL1 .= " id = '$id1'";

                            $resultado1 = pg_query($conn, $SQL1);

                            $SQL = $SQL1;
                        } else
                            if ($i == 1) {
                            $tit = "2d";
                            $img = $ruta2;
                            move_uploaded_file($temporal2, $ruta2);

                            $SQL2 = "UPDATE";
                            $SQL2 .= " reporte_tecnico.reportes_fallas";
                            $SQL2 .= " SET";
                            $SQL2 .= " simagen = '$ruta2'";
                            $SQL2 .= " WHERE";
                            $SQL2 .= " id = '$id2'";

                            $resultado2 = pg_query($conn, $SQL2);

                            $SQL = $SQL2;
                        } else
                            if ($i == 2) {
                            $tit = "3er";
                            $img = $ruta3;
                            move_uploaded_file($temporal3, $ruta3);

                            $SQL3 = "UPDATE";
                            $SQL3 .= " reporte_tecnico.reportes_fallas";
                            $SQL3 .= " SET";
                            $SQL3 .= " simagen = '$ruta3'";
                            $SQL3 .= " WHERE";
                            $SQL3 .= " id = '$id3'";

                            $resultado3 = pg_query($conn, $SQL3);

                            $SQL = $SQL3;
                        } else
                            if ($i == 3) {
                            $tit = "4t";
                            $img = $ruta4;
                            move_uploaded_file($temporal4, $ruta4);

                            $SQL4 = "UPDATE";
                            $SQL4 .= " reporte_tecnico.reportes_fallas";
                            $SQL4 .= " SET";
                            $SQL4 .= " simagen = '$ruta4'";
                            $SQL4 .= " WHERE";
                            $SQL4 .= " id = '$id4'";

                            $resultado4 = pg_query($conn, $SQL4);

                            $SQL = $SQL4;
                        } else
                            if ($i == 4) {
                            $tit = "5t";
                            $img = $ruta5;
                            move_uploaded_file($temporal5, $ruta5);

                            $SQL5 = "UPDATE";
                            $SQL5 .= " reporte_tecnico.reportes_fallas";
                            $SQL5 .= " SET";
                            $SQL5 .= " simagen = '$ruta5'";
                            $SQL5 .= " WHERE";
                            $SQL5 .= " id = '$id5'";

                            $resultado5 = pg_query($conn, $SQL5);

                            $SQL = $SQL5;
                        }
                    ?>
                        <div class="col-md-1" style="margin-bottom: 20px;"></div>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <label> <? echo $tit; ?>a imagen </label>
                            <br><br>
                            <img src="<? echo $img; ?>" style="width: 100%; height: auto; max-height: 300px">
                        </div>
                        <div class="col-md-1" style="margin-bottom: 20px;"></div>
                <?
                    }
                }
                ?>
                <div class="col-12" style="text-align:center;">
                    <a href="adjuntar.php">
                        <button type="button" class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button>
                    </a>
                    <a href="actualizar.php">
                        <button type="button" class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function cerrar() {
            document.getElementById("observacion").style.display = "none";
        }

        function cerrar2() {
            document.getElementById("observacion2").style.display = "none";
            $(location).attr("href", "adjuntar.php");
        }
    </script>
</body>

</html>
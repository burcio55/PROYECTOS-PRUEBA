<?php
include "conexion.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIENES PUBLICOS</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/alerta.css">
    <link rel="stylesheet" href="css/datatables.css" />
    <link rel="stylesheet" href="css/cdn.datatables.net_1.13.6_css_jquery.dataTables.min.css" />
    <!-- Bootstrap V5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<div id="observacion" class="fondo_alerta" style="display: none;">
    <div class="alerta">
        <h4 id="titulo">Atención</h4>
        <p id="texto">Datos guardados exitosamente</p>
        <div class="sep"></div>
        <center><button type="button" onclick="cerrar_alert()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Cerrar</button></center>
        <div class="sep"></div>
    </div>
</div>
<div id="observacion3" class="fondo_alerta" style="display: none;">
    <div class="alerta" style="text-align: center;">
        <h4 id="titulo3">Atención</h4>
        <p id="texto3">Datos guardados exitosamente</p>
        <i id="vv">Datos guardados exitosamente</i>
        <div class="sep"></div>
        <input type="text" id="pass" style="display:none;">
        <center><button type="button" onclick="cerrar_alert3()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Cerrar</button>
            <button type="button" onclick="accion_eliminar(pass.value)" style="display:none;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' id="eli" data-bs-toggle="tooltip">Eliminar</button>
        </center>
        <div class="sep"></div>
    </div>
</div>

<body>
    <!-- Cabezera -->
    <header>
        <img src="imagenes/cintillo_institucional.jpg">
    </header>
    <!-- Contenido -->
    <main>
        <div class="content-3d">
            <div class="col-sm-12">
                <?
                include "menu.php";
                ?>
            </div>
            <div class="content-login">
                <!-- -->

                <div class="content">
                    <!--primer contenedor -->
                    <div class="row">

                        <!--Titulo -->
                        <div class="col-sm-8">
                            <h1 style="font-size:32px; font-weight: normal;">MANTENIMIENTO-Catálogos-Origen</h1>
                        </div>
                        <div class="col-sm-2" style="text-align: center; "></div>
                        <div class="col-sm-2" style="margin-top:auto;">
                            <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                        </div>

                    </div>
                    <br>
                    <hr> <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="col-sm-3"></div>

                                <label for="basic-url" class="form-label" style="font-size: 20px;margin-top:auto;">Origen</label><span style="margin-right:10px;"> *</span>


                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic2">
                                    <img src="imagenes/producto.png" class="input-imagen">
                                </span>

                                <input type="text" class="form-control" id="or2" aria-describedby="basic-addon3 basic-addon4" placeholder="Ingrese el nuevo Origen">
                                <input type="text" class="form-control" style="display: none;" id="id_mantenimiento1" aria-describedby="basic-addon3 basic-addon4" placeholder="Ingrese el nuevo Origen">


                                <button onclick="agg_origen(or2.value)" id="bt1" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; border-radius: 0 30px 30px 0; " onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Agregar</button>
                                <button onclick="accion_modificar_mod1(id_mantenimiento1.value,or2.value)" id="bt2" type="button" style=" display:none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; border-radius: 0 30px 30px 0; " onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Actualizar</button>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="sep"></div>

                        </div>





                        <br>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">

                            <table id="myTable" style="border-radius: 30px;">
                                <thead>

                                    <tr>
                                        <th class="centro">Nro.</th>
                                        <th class="centro">Origen</th>

                                        <th class="centro" style="width: 40%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="fe">
                                    <?php
                                    $i = 0;
                                    $sql = "SELECT id, sdescripcion FROM bienes_publicos.origen WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row = pg_query($conn, $sql);
                                    $or = pg_fetch_all($row);
                                    while ($or = pg_fetch_assoc($row)) {

                                        $i++;
                                        $cosa .= "<tr>
                                               <td class=\"td center\">" . $i . "</td>
                                               <td class=\"td center\" style=\"width: 68%;\">" . $or['sdescripcion'] . "</td>
                                               <td class=\"td center\" id=\"botones\">
                                                   <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD;  border-radius: 30px; width: auto;\" onclick=\"accion_modificar('" . $or['id'] . "','" . $or['sdescripcion'] . "')\">Modificar</button>";
                                        if ($_SESSION['bienes_publicos_rol'] == 80) {
                                            $cosa .= "<button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or['id'] . ")\">Eliminar </button>";
                                        }
                                        $cosa .= "</td>
                                           </tr>
                                               ";
                                    }
                                    echo $cosa;
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-1"></div>


                    </div>

                    <hr color="#46A2FD">
                    <br>

                    <div class="row">
                        <div class="col-sm-4"></div>

                        <div class="col-sm-4" style="text-align: center;">
                            <button type="button" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'><a href="mantenimiento0.php">Regresar</a></button>
                            <!-- <button type="submit" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip"  id="motivo_agr"><a href="mantenimiento2.php">Siguiente</a></button> -->
                            <br><br>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </div>
            </div>
    </main>
    <script>
        document.getElementById('or2').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
    <script src="js/login.js"></script>
    <script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
    <script>
        new DataTable("#myTable");
    </script>
    <!-- Pie de página -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="border-right: 1px solid white;">
                    <h3 class="sep-3" style="font-size: 16px; margin-left: 100px">Bienes Públicos</h3>
                </div>
                <div class="col-md-6">
                    <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                    <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                    <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
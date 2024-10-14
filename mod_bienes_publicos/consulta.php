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

                <div class="content">
                    <div class="row">


                        <div class="col-sm-6">
                            <h1 style="font-size:32px; font-weight: normal;">CONSULTA-Reporte</h1>
                        </div>
                        <div class="col-sm-3" style="text-align: center;"></div>
                        <div class="col-sm-3"></div>

                    </div>


                    <div class="content">
                        <div class="row">
                            <div class="sep"></div>
                            <div class="sep"></div>
                            <div class="col-sm-6">
                                <h2 style="color: rgb(35, 96, 249); font-size:22px;">Responsable Patrimonial</h2>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                                <br>

                            </div>

                            <hr>
                            <div class="sep"></div>
                            <div class="input-group">
                                <div class="col-sm-3"></div>
                                <label for="inputPassword2" class="form-label" style="margin-top:auto;">Cédula de Identidad </label><span> * </span>

                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/ci.png" class="input-imagen"></span>

                                <select class="input-group-text" id="nacionalidad3" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> - </option>
                                    <option value="1"> V- </option>
                                    <option value="2"> E- </option>

                                </select>

                                <input type="text" class="form-control" id="ci3" placeholder="Ingrese una cédula de identidad" maxlength="8">
                                <input type="text" class="form-control" id="id_c3" placeholder="Ingrese una cédula de identidad" style="display:none;">
                                <button type="button" class="input-group-text" style="margin-top:0;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 0 30px 30px 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="consulta_1(nacionalidad3.value,ci3.value)">Buscar</button>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="sep"></div>



                            <br>
                            <div class="sep"></div>
                            <div class="col-sm-4"><label for="" class="form-label" style="margin-top:auto;">Cédula de Identidad</label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/verificar.png" class="input-imagen"></span>
                                    <input type="text" id="bci3" class="form-control" placeholder="Ej. 16585991" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled value="">
                                </div>

                            </div>

                            <div class="col-sm-4"><label for="" class="form-label" style="margin-top:auto;">Nombre(s)</label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/verificar.png" class="input-imagen"></span>
                                    <input type="text" id="bn3" class="form-control" placeholder="Ej. David" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4"> <label for="" class="form-label" style="margin-top:auto;">Apellido(s)</label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/verificar.png" class="input-imagen"></span>
                                    <input type="text" id="ba3" class="form-control" placeholder="Ej. Ortega" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                </div>
                            </div>
                            <div class="sep"></div>
                            <div class="col-sm-6"><label for="" class="form-label" style="margin-top:auto;">Cargo o Puesto de Trabajo Titular</label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/verificar.png" class="input-imagen"></span>
                                    <input type="text" id="bct3" class="form-control" placeholder="Ej. Coordinador" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6"><label for="" class="form-label" style="margin-top:auto;">Cargo o Puesto de Trabajo que Ejerce</label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/verificar.png" class="input-imagen"></span>
                                    <input type="text" id="bce3" class="form-control" placeholder="Ej. Jefe" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                </div>
                            </div>
                            <div class="sep"></div>
                            <div class="col-sm-6"><label for="" class="form-label" style="margin-top:auto;">Ubicación Administrativa</label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/verificar.png" class="input-imagen"></span>
                                    <input type="text" id="bua3" class="form-control" placeholder="Ej. Oficina Central" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6"><label for="" class="form-label" style="margin-top:auto;">Ubicación Física</label>
                                <div class="input-group">

                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3"> <img src="imagenes/verificar.png" class="input-imagen"></span>
                                    <input type="text" id="buf3" class="form-control" placeholder="Ej. Recursos Humanos" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                </div>
                            </div>

                        </div>
                    </div>

                    <br>




                </div>



                <div class="row">


                    <div class="col-sm-12">
                        <table id="tabla_motivo" class="table table-striped"><br><br>
                            <thead id="bienp">
                                <tr>
                                    <hr>
                                    <th>Nro.</th>
                                    <th scope="col">Bien Público</th>

                                    <th>Marca</th>
                                    <th>Modelo</th>

                                    <th>Serial</th>
                                    <th> Color</th>
                                    <th>Estado</th>

                                </tr>
                            </thead>
                            <tbody id="fe">


                                <!-- Puedes agregar más filas aquí -->
                            </tbody>
                        </table>
                    </div>
                    <br><br>

                    <br>


                    <hr>
                    <div class="sep"></div>
                    <div class="col-sm-4"></div>

                    <div class="col-sm-4" style="text-align: center;">
                        <button type="button" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'><a href="vista.php">Regresar</a></button>
                        <button onclick="imprimir(id_c3.value)" type="submit" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" id="motivo_agr">Imprimir</button>
                        <br><br>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('ci1');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('ci2');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('ci3');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('cbp2');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('cbp');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('vbp');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('oc');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        });
        document.getElementById('model').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
        document.getElementById('serl').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
        document.getElementById('obs').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
    <script src="js/login.js"></script>
    <script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
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
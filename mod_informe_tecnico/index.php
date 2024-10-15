<?
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
    <!-- CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JS de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        $_SESSION['snro_reporte'] = "";
        ?>
        <div class="container2">
            <div class="row">
                <div class="col-sm-12">
                    <h2>INFORME TÉCNICO - Registrar</h2>
                </div>

                <div class="col-sm-4"></div>
                <div class="sep"></div>
                <div class="col-sm-8">
                    <h4 style="color:#0d6efd; font-weight:normal;">Datos del Solicitante</h4>
                </div>

                <div class="col-sm-4">
                    <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                </div>
                <hr>
                <br>

                <div class="col-sm-12">
                    <div class="input-group mb-3 epa">
                        <label for="basic-url" class="form-label" style="margin-top:10px">Cédula de Identidad <span>*</span> </label> <span class="mma"></span>
                        <span class="input-group-text" style="border-radius: 30px 0 0 30px" id="addon-wrapping"><img src="img/bandera.png" class="icon"></span>
                        <select id="nacionalidad" class="input-group-text">
                            <option  value= "" selected></option>
                            <option  value="1">V-</option>
                            <option value="2">E-</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Ej. 10564238" id="cedula" name="cedula" value="<? echo $_REQUEST['id'] ?>">
                        <button onclick="buscar()" type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-left: -15px;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD&quot;"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Buscar</button>
                    </div>
                </div>
                <script>
                    function soloNumeros(e) {
                        const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                        if (!permitidos.includes(e.keyCode)) {
                            e.preventDefault();
                        }
                    }
                    document.getElementById("cedula").addEventListener("keydown", soloNumeros);
                    const input = document.getElementById('cedula');
                    const maxLength = 8;
                    input.addEventListener('input', function() {
                        const currentValue = input.value;
                        input.value = currentValue.slice(0, maxLength);
                    });
                </script>
                <div class="sep"></div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Nombre(s)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2; color: #313131;" id="nombre" placeholder="Ej. Natalia" value="<? echo $_REQUEST['nombre'] ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Apellido(s)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="apellido" placeholder="Ej. Gomez" value="<? echo $_REQUEST['apellido'] ?>" disabled>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Ubicación Administrativa de Adscripción</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="ubicacion_adm" name="ubicacion_adm" placeholder="Ej. Despacho del Ministro" value="<? echo $_REQUEST['ubicacion_adm'] ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Ubicación Física</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="ubicacion_fisica_actual" name="ubicacion_fisica_actual" placeholder="Ej. Recursos Humanos" value="<? echo $_REQUEST['ubicacion_fisica_actual'] ?>" disabled>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo Titular</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="cargo" name="cargo" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. Coordinador" value="<? echo $_REQUEST['cargo'] ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo que Ejerce</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="scargo_actual_ejerce" name="scargo_actual_ejerce" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. Jefe" value="<? echo $_REQUEST['scargo_actual_ejerce'] ?>" disabled>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <form class="row g-3">
                <h4 style="color:#0d6efd; font-weight:normal;">Datos de GLPI</h4>
                <hr>
                <form action="interaccion.php" method="post" class="input-group">
                    <div class="col-md-6" style="display:none">
                        <label for="inputmodelo" class="form-label">Reporte</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/requerido.png" class="icon"> </span>
                            <input type="text" class="form-control" placeholder="Ej. 39985" id="id_reporte" name="id_reporte" value="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group" style="display: flex; align-items: center;">
                            <label for="inputmodelo" class="form-label" style="margin-right: 15px; ">Nro. de Requerimiento</label>
                            <span class="input-group-text" id="basic-addon1" style="margin-left: 10px; border-top-left-radius: 30px; border-bottom-left-radius: 30px; height: 38px;">
                                <img src="img/requerido.png" class="icon">
                            </span>
                            <input type="num" class="form-control" onkeydown="return Numeros(event);" placeholder="Ej. 399" id="nnumero_requer_glpi" maxlength="3" name="nnumero_requer_glpi" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                    <script>
                        function Numeros(event) {
                            const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                            if (!permitidos.includes(event.keyCode)) {
                                event.preventDefault();
                            }
                            document.getElementById("nnumero_requer_glpi").addEventListener("keydown", Numeros);
                            const input = document.getElementById("nnumero_requer_glpi");
                            const maxLength = 10;
                            input.addEventListener('input', function() {
                                const currentValue = input.value;
                                input.value = currentValue.slice(0, maxLength);
                            });
                        };
                    </script>
                    <div class="col-md-12">
                        <label for="inputmodelo" class="form-label">Unidad Administrativa <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/personas.png" class="icon"> </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Buscar...">
                            <select class="form-select" id="ubicacion_administrativa_scodigo" name="ubicacion_administrativa_scodigo" style="width: 50%;">
                                <option value="0"></option>
                                    <?php
                                    $sql5 = "SELECT * FROM public.ubicacion_administrativa WHERE nenabled = '1' Order By sdescripcion";
                                    $sega = pg_query($conn, $sql5);
                                    $li = pg_fetch_all($sega);
                                    foreach ($li as $n) {
                                    ?>
                                        <option value="<?php echo $n['scodigo']; ?>"><?php echo $n['sdescripcion']; ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <script>
                    document.getElementById('searchInput').addEventListener('keyup', function() {
                        var filter = this.value.toUpperCase();
                        var select = document.getElementById('ubicacion_administrativa_scodigo');
                        var options = select.getElementsByTagName('option');
                        var found = false;

                        for (var i = 0; i < options.length; i++) {
                            var txtValue = options[i].textContent || options[i].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                options[i].style.display = "";
                                if (!found) {
                                    select.selectedIndex = i;
                                    found = true;
                                }
                            } else {
                                options[i].style.display = "none";
                            }
                        }
                    });
                </script>
                </form>
                <br>
                <br>
                <h4 style="color:#0d6efd; font-weight:normal;">Especificaciones del Equipo</h4>
                <hr>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Nro. Bien Público</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/bp.png" class="icon"> </span>
                            <input type="num" class="form-control" onkeydown="return Num(event);" placeholder="Ej. 39985" required id="nbien_publico" name="nbien_publico">
                        </div>
                    </div>
                    <script>
                        function Num(event) {
                            const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                            if (!permitidos.includes(event.keyCode)) {
                                event.preventDefault();
                            }
                            document.getElementById("nbien_publico").addEventListener("keydown", Num);
                            const input = document.getElementById("nbien_publico");
                            const maxLength = 8;
                            input.addEventListener('input', function() {
                                const currentValue = input.value;
                                input.value = currentValue.slice(0, maxLength);
                            });
                        };
                    </script>
                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Nombre <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/equipo.png" class="icon"> </span>
                            <input type="text" id="snombre_dispositivo" maxlength="15" onkeyup="this.value = this.value.toUpperCase()" class="form-control" placeholder="Ej. OTICADS-007" required name="snombre_dispositivo">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Tipo de Dispositivo <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"> <img src="img/tipo.png" class="icon"> </span>
                            <select id="dispositivos_id" class="form-select" name="dispositivos_id">
                                <option value="0">Seleccione </option>
                                <?
                                $sql = "SELECT * FROM reporte_tecnico.dispositivos WHERE benabled = 'TRUE' Order By sdescripcion";
                                $row = pg_query($conn, $sql);
                                $persona = pg_fetch_all($row);
                                foreach ($persona as $u) {
                                ?>
                                    <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
                <br>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Estatus Inicial <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"> <img src="img/estatus.png" class="icon"> </span>
                            <select id="estatus_id" class="form-select" name="estatus_id">
                                <option selected value="0">Seleccione</option>
                                <?
                                $estated = "SELECT * FROM reporte_tecnico.estatus WHERE benabled = 'TRUE' Order By sdescripcion";
                                $object = pg_query($conn, $estated);
                                $estatus = pg_fetch_all($object);
                                foreach ($estatus as $m) {
                                ?>
                                    <option value="<? echo $m['id']; ?>"><? echo $m['sdescripcion']; ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputmarca" class="form-label">Marca <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/marca.png" class="icon"> </span>
                            <select id="marca_id" class="form-select" name="marca_id">
                                <option selected value="0">Seleccione</option>
                                <?
                                $adidas = "SELECT * FROM reporte_tecnico.marca WHERE benabled = 'TRUE' Order By sdescripcion";
                                $sony = pg_query($conn, $adidas);
                                $linux = pg_fetch_all($sony);
                                foreach ($linux as $a) {
                                ?>
                                    <option value="<? echo $a['id']; ?>"><? echo $a['sdescripcion']; ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Modelo <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/equipo.png" class="icon"> </span>
                            <input type="text" id="smodelo" class="form-control" maxlength="10" onkeyup="this.value = this.value.toUpperCase()" placeholder="Ej. VIT 2710-01" required name="smodelo">
                        </div>
                    </div>
                    <script>
                    </script>
                </form>
                <br>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputserial" class="form-label">Serial <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/serial.png" class="icon"> </span>
                            <input type="text" id="sserial" class="form-control" maxlength="14" onkeyup="this.value = this.value.toUpperCase()" placeholder="Ej. A000183569" required name="sserial">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Disco Duro <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/dd.png" class="icon"> </span>
                            <input type="text" id="sdisco_duro" class="form-control" maxlength="12" onkeyup="this.value = this.value.toUpperCase()" placeholder="Ej. 320GB SATA" required name="sdisco_duro">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Memoria RAM <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/mr.png" class="icon"> </span>
                            <input type="text" id="smemoria_ram" class="form-control" onkeyup="this.value = this.value.toUpperCase()" maxlength="5" placeholder="Ej. 4GB" required name="smemoria_ram">
                        </div>
                    </div>
                </form>
                <br>
                <br>
                <div class="col-12" style="text-align:center;">
                    <button id="" type="submit" onclick="insertar()" class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Agregar dispositivo</button>
                </div>
                <div class="sep"></div>
                <br>
                <br>

                <table class="table" style="text-align: center; margin:auto;">
                    <thead>
                        <tr>
                            <th scope="col">Nro.</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Bien Público</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Estatus</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="loco">
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <br>
                <div class="col-12" style="text-align:center;">
                    <button class="btn btn-primary" onclick="" type="button" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>
                    <button class="btn btn-secondary" onclick="showAlert()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Guardar</button>
                </div>
        </div>
    </div>

    <script src="registrar.js"></script>

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

</html>
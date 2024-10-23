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

    <div id="observacion_especial" class="fondo_alerta" style="display: none;">
        <div class="alerta">
            <h4 id="titulo4">Atención</h4>
            <p id="texto4"></p>
            <div class="sep"></div>
            <center><button type="button" onclick="cerrar3()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Aceptar</button></center>
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
    <div id="borrar_registro" class="fondo_alerta" style="display: none;">
        <div class="alerta">
            <h4 id="titulo3">Advertencia</h4>
            <p id="texto3"></p>
            <div class="sep"></div>
            <center>
                <button type="button" onclick="cerrarAlerta()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">NO</button>
                <button type="button" onclick="accion_eliminar_registro(id_reporte.value)" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip2">SI</button>
            </center>
            <div class="sep"></div>
        </div>
    </div>

    <div class="logo"></div>
    <br>
    <div class="container">
        <?
        include('menuprincipal.php');

        $_SESSION['snro_reporte2'] = "";
        ?>
        <div class="container2">
            <h2>INFORME TÉCNICO - Actualizar</h2>
            <br>
            <h6 class="obligatorio" style="text-align:right">Datos Obligatorios (*)</h6>
            <hr>
            <br>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="col-sm-3"></div>
                    <div class="input-group mb-6">
                        <label for="basic-url" class="form-label" style="margin-top:10px">Nro. de Informe <span>*</span> </label> <span class="mma"></span>
                        <span class="input-group-text" style="border-radius: 30px 0 0 30px" id="addon-wrapping"><img src="img/bandera.png" class="icon"></span>
                        <input type="text" class="form-control" placeholder="Ej. 23042024-006" id="num_informe" value="<? echo $_SESSION["snro_reporte"]; ?>" name="num_informe" maxlength="12">
                        <button onclick="busqueda3()" type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-left: -15px;" onmouseout="this.style.color=&quot;#fff&quot;; this.style.backgroundColor=&quot;#46A2FD&quot;; this.style.border=&quot;1px Solid #46A2FD&quot;" onmouseover="this.style.color=&quot;#46A2FD&quot;; this.style.backgroundColor=&quot;#fff&quot;;" data-bs-toggle="tooltip">Buscar</button>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>

                <h4 style="color:#0d6efd; font-weight:normal;">Datos del Solicitante</h4>

                <hr>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Cédula de Identidad</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="cedula" name="cedula" placeholder="Ej. 30899564" value="<? echo $_REQUEST['cedula'] ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Nombre(s)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="name" name="name" placeholder="Ej. Natalia" value="<? echo $_REQUEST['name'] ?>" disabled>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Apellido(s)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="last_name" id="last_name" placeholder="Ej. Gomez" value="<? echo $_REQUEST['last_name'] ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Ubicación Administrativa de Adscripción</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="ubicacion_adcripcion" name="ubicacion_adcripcion" placeholder="Ej. Despacho del Ministro" value="<? echo $_REQUEST['ubicacion_adcripcion'] ?>" disabled>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Ubicación Física</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="subicacion_fisica" name="subicacion_fisica" placeholder="Ej. Recursos Humanos" value="" disabled>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo Titular</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="cargo_titular" name="cargo_titular" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. Coordinador" value="" disabled>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="col-sm-12">
                    <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo que Ejerce</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="scargo_actual_ejerce" name="scargo_actual_ejerce" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. Jefe" value="" disabled>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <h4 style="color:#0d6efd; font-weight:normal;">Datos del Sistema GLPI</h4>
            <hr>

            <form action="interaccion.php" class="input-group" method="POST" id="form_modificar_reporte">
                <form class="row g-3">
                    <div class="col-md-6" style="display: none">
                        <label for="inputmodelo" class="form-label">Reporte</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/requerido.png" class="icon"> </span>
                            <input type="text" class="form-control" placeholder="Ej. 39985" id="id_reporte" name="id_reporte" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: none">
                        <label for="inputmodelo" class="form-label">Nro. Reporte</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/requerido.png" class="icon"> </span>
                            <input type="text" class="form-control" placeholder="Ej. 39985" id="snro_reporte" name="snro_reporte" value="" disabled>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <label for="inputmodelo" class="form-label">Nro. de Requerimiento</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/requerido.png" class="icon"> </span>
                            <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. 39985" id="nnumero_requer_glpi" name="nnumero_requer_glpi" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputmodelo" class="form-label">Unidad Administrativa <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/personas.png" class="icon"> </span>
                            <select class="form-select" style="background: #b6b4b4b2;" id="ubicacion_administrativa_scodigo" name="ubicacion_administrativa_scodigo" disabled>
                                <option value="0">Seleccione</option>
                                <?
                                $sql5 = "SELECT * FROM public.ubicacion_administrativa WHERE nenabled = '1' Order By sdescripcion";
                                $sega = pg_query($conn, $sql5);
                                $li = pg_fetch_all($sega);
                                foreach ($li as $n) {
                                ?>
                                    <option value="<? echo $n['scodigo']; ?>"><? echo $n['sdescripcion']; ?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
                <br>
                <br>
                <h4 style="color:#0d6efd; font-weight:normal;">Especificaciones del Equipo</h4>
                <hr>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Bien Público</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/bp.png" class="icon"> </span>
                            <input type="text" class="form-control" onkeydown="return Num(event);" placeholder="Ej. 39985" required id="nbien_publico" name="nbien_publico">
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
                            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" maxlength="15" placeholder="Ej. OTICADS-007" required id="snombre_dispositivo" name="snombre_dispositivo">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Tipo de Dispositivo <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"> <img src="img/tipo.png" class="icon"> </span>
                            <select class="form-select" id="dispositivos_id" name="dispositivos_id">
                                <option selected value="0">Seleccione</option>
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
                        <label for="inputState" class="form-label">Estatus <span>*</span></label>
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
                            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase()" maxlength="10" placeholder="Ej. VIT 2710-01" required id="smodelo" name="smodelo">
                        </div>
                    </div>

                </form>
                <br>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputserial" class="form-label">Serial <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/serial.png" class="icon"> </span>
                            <input type="text" class="form-control" maxlength="14" onkeyup="this.value = this.value.toUpperCase()" placeholder="Ej. A000183569" required id="sserial" name="sserial">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Disco Duro <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/dd.png" class="icon"> </span>
                            <input type="text" class="form-control" maxlength="12" onkeyup="this.value = this.value.toUpperCase()" placeholder="Ej. 320GB SATA" required id="sdisco_duro" name="sdisco_duro">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Memoria RAM <span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/mr.png" class="icon"> </span>
                            <input type="text" class="form-control" maxlength="5" onkeyup="this.value = this.value.toUpperCase()" placeholder="Ej. 4GB" required id="smemoria_ram" name="smemoria_ram">
                        </div>
                    </div>
                </form>
                <br>
                <br>
                <div class="col-sm-8">
                    <h4 style="color:#0d6efd; font-weight:normal;">Análisis del Técnico</h4>
                </div>
                <hr>
                <br>

                <div class="form-floating mb-3">Observación(es) <span>*</span>
                    <input class="form-control" onkeyup="this.value = this.value.toUpperCase()" style="height: 72px" required name="sobservaciones_tecnico" id="sobservaciones_tecnico" maxlength="500"></input>
                </div>
                <br>
                <div class="form-floating mb-3">Recomendación(es)<span>*</span>
                    <input class="form-control" onkeyup="this.value = this.value.toUpperCase()" style="height: 72px" required name="srecomendaciones_tecnico" id="srecomendaciones_tecnico" maxlength="500"></input>
                </div>
                <br>
                <div class="col-md-12">
                    <label for="inputState" class="form-label">Estatus Final <span>*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" id="addon-wrapping"> <img src="img/estatus.png" class="icon"> </span>
                        <select id="final_id" class="form-select" onchange="mostrarOcultarElemento()" name="final_id">
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
                <br>
                <div id="elemento-oculto" class="form-floating mb-3" style="display:none">Motivo de Desincoporación<span>*</span>
                    <input class="form-control" onkeyup="this.value = this.value.toUpperCase()" id="motivo_desincorporacion" style="height: 72px" required name="motivo_desincorporacion"></input>
                </div>
                <script>
                    function mostrarOcultarElemento() {
                        const elemento = document.getElementById('elemento-oculto');
                        let final_id = document.getElementById('final_id').value;
                        if (final_id !== '117') {
                            elemento.style.display = 'none';
                        } else {
                            elemento.style.display = 'block';
                        }
                    }
                </script>
            </form>
            <div class="col-12" style="text-align:center; display: none;" id="actualizar">
                <button type="button" onclick="accion_reporte_modificar()" class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Actualizar Dispositivo</button>
            </div>
            <br>
            <table class="table" style="text-align: center; margin:auto; font-size: 12px">
                <thead>
                    <tr>
                        <th scope="col" style="width: auto; max-width: 30px;">Nro.</th>
                        <th scope="col" style="width: auto; max-width: 30px;">Tipo</th>
                        <th scope="col" style="width: auto; max-width: 30px;">Marca</th>
                        <th scope="col" style="width: auto; max-width: 70px;">Modelo</th>
                        <th scope="col" style="width: auto; max-width: 180px;">Bien Público</th>
                        <th scope="col" style="width: auto; max-width: 40px;">Serial</th>
                        <th scope="col" style="width: auto; max-width: 30px;">Estatus</th>
                        <th scope="col" style="width: auto; max-width: 30px;">Acción</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="loco1" sytle="max-width: 90px;">
                </tbody>
            </table>
            <br>
            <br>
            <div class="col-12" style="text-align:center;" id="imagis">
                <a href="index.php">
                    <button type="button" class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button>
                </a>
                <button type="button" class="btn btn-secondary" onclick="accion_guardar()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Guardar</button>
            </div>
            <br>
            <br>
            <div style="display: none;">
                <h4 style="color:#0d6efd; font-weight:normal;">Adjuntar Imágenes</h4>
                <hr>

                <form action="foto.php" method="POST" enctype="multipart/form-data">
                    <div class=" mb-5 epa" style="margin-bottom: 0;">
                        <?
                        $cant_img = $_SESSION["IMG"] + 1;

                        for ($i = 0; $i < $cant_img; $i++) {
                            if ($i == 0) {
                                $tit = "1era imagen";
                            } else
                        if ($i == 1) {
                                $tit = "2da imagen";
                            } else
                        if ($i == 2) {
                                $tit = "3era imagen";
                            } else
                        if ($i == 3) {
                                $tit = "4ta imagen";
                            } else
                        if ($i == 4) {
                                $tit = "5ta imagen";
                            }
                        ?>
                            <div class="col-md-12">
                                <label for="inputmodelo" class="form-label"> Adjuntar <? echo $tit; ?> <span>*</span></label>
                                <div class="input-group" style="max-width: 95%;">
                                    <span class="input-group-text" id="basic-addon1"> <img src="img/mr.png" class="icon"> </span>
                                    <input type="file" name="foto<? echo $i; ?>" id="foto<? echo $i; ?>" class="form-control" style="display: block; border-radius: 0 30px 30px 0" required>
                                </div>
                            </div>
                            <br>
                        <?
                        }
                        ?>
                    </div>
                </form>
            </div>

            <!-- <table class="table" style="text-align: center; margin:auto; font-size: 12px">
                <thead>
                    <tr>
                        <th scope="col">Nro.</th>
                        <th scope="col">Imagen(es)</th>
                        <th colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="loco">
                    <?php
                    $j = 0;
                    $imago = "SELECT id, reportes_fallas_id, nombre_foto, archivo, benabled, nusuario_creacion, 
                                    dfecha_creacion, nusuario_actualizacion, ruta_imagen
                                    FROM reporte_tecnico.adjuntos Where adjuntos.benabled = 'TRUE' ";

                    $res = pg_query($conn, $imago);
                    $im = pg_fetch_all($res);

                    while ($data = pg_fetch_assoc($res)) :
                        $j++;
                    ?>
                        <tr>
                            <td><?php echo $j; ?></td>
                            <td><img src="<?php echo $data['ruta_imagen']; ?>" width="120px" height="120px" ?></td>
                            <td>

                                <input type="text" value="<?php echo $data['id']; ?>" name="elimi_foto" id="eliminar_id" class="form-control" style="display: none">
                                <button type="submit" name="" onclick="eliminar_imagen(<?php echo $data['id']; ?>)" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto">Eliminar</button>

                            </td>
                        </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
            <br>
            <br>
            <div class="col-12" style="text-align:center;">
                <a href="menu.php"><button class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>
                <button type="button" class="btn btn-secondary" onclick="accion_reporte_modificar()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Guardar</button>
            </div> -->
        </div>
    </div>
    <script src="mod.js"></script>

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
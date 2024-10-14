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
        <center><i id="a"></i></center>
        <div class="sep"></div>
        <center><button type="button" onclick="cerrar_alert()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Cerrar</button>
            <a href="asignar.php"> <button type="button" style="display:none;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' id="asig1" data-bs-toggle="tooltip">Asignar</button></a>
        </center>
        <div class="sep"></div>
    </div>
</div>
<div id="observacion2" class="fondo_alerta" style="display: none;">
    <div class="alerta">
        <h4 id="titulo2">Atención</h4>
        <p id="texto2">Datos guardados exitosamente</p>
        <div class="sep"></div>
        <center><button type="button" onclick="cerrar_alert2()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Cerrar</button>
        </center>
        <div class="sep"></div>
    </div>
</div>
<div id="observacion3" class="fondo_alerta" style="display: none;">
    <div class="alerta">
        <h4 id="titulo3">Atención</h4>
        <p id="texto3">Datos guardados exitosamente</p>
        <i id="vv" style="display:none;">Datos guardados exitosamente</i>
        <div class="sep"></div>
        <input type="text" id="pass" style="display:none;">
        <center><button type="button" onclick="cerrar_alert3()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Cerrar</button>
            <button type="button" onclick="accion_eliminar_regis(pass.value)" style="display:none;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' id="eli" data-bs-toggle="tooltip">Eliminar</button>
        </center>
        <div class="sep"></div>
    </div>
</div>

<body>
    <!-- Cabezera -->
    <header>
        <img src="imagenes/cintillo_institucional.jpg">
    </header>
    <!-- <div id="observacion" class="fondo_alerta" style="display: none;">
    <div class="alerta">
        <h4 id="titulo">Atención</h4>
        <p id="texto">Su registro de derecho al voto ha sido guardado exitosamente</p>
        <div class="sep"></div>
       <a href=""> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip"  id="motivo_agr">Cerra</button></a>
        <div class="sep"></div>
    </div>
</div> -->
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
                            <h1 style="font-size:32px; font-weight: normal;">BIENES PÚBLICOS-Registrar</h1>
                        </div>
                        <div class="col-sm-3" style="text-align: center;"></div>
                        <div class="col-sm-3"> </div>

                    </div>


                    <div class="content">
                        <div class="row">
                            <div class="sep"></div>
                            <div class="sep"></div>
                            <div class="col-sm-6">
                                <h2 style="color: rgb(35, 96, 249); font-size:22px;">Bien(es) Público(s)</h2>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                                <br>

                            </div>

                            <hr>

                            <div class="row">

                                <div class="sep"></div>
                                <div class="col-sm-2">
                                    <label for="basic-url" class="form-label">Nro del B.P </label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                            <img src="imagenes/co.png" class="input-imagen">
                                        </span>
                                        <input type="text" class="form-control" maxlength="8" style="border-radius: 0 30px 30px 0;" id="cbp" aria-describedby="basic-addon3 basic-addon4" placeholder="Nro B.P">
                                        <input type="number" class="form-control" maxlength="8" style="display: none;border-radius: 0 30px 30px 0;" id="id_regis" aria-describedby="basic-addon3 basic-addon4" placeholder="Nro B.P">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <label for="basic-url" class="form-label">Descripción del Bien</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/producto.png" class="input-imagen">
                                        </span>
                                        <select class="form-select" style="border-radius: 0 30px 30px 0;" id="dbp" aria-describedby="basic-addon3 basic-addon4">
                                            <option value="-1"> Seleccione... </option>
                                            <?php
                                            $sql = "SELECT * FROM bienes_publicos.productos WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                            $row = pg_query($conn, $sql);
                                            $persona = pg_fetch_all($row);
                                            foreach ($persona as $a) {
                                            ?>
                                                <option value="<? echo $a['id']; ?>"><? echo $a['sdescripcion']; ?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label">Origen</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/producto.png" class="input-imagen">
                                        </span>
                                        <select class="form-select" style="border-radius: 0 30px 30px 0;" id="or" aria-describedby="basic-addon3 basic-addon4">
                                            <option value="-1"> Seleccione... </option>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM bienes_publicos.origen WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
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



                                <div class="a"><br></div>
                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label">Marca</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/identidad.png" class="input-imagen">
                                        </span>
                                        <select class="form-select" style="border-radius: 0 30px 30px 0;" id="marc" aria-describedby="basic-addon3 basic-addon4">
                                            <option value="-1"> Seleccione... </option>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM bienes_publicos.marca WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                            $row = pg_query($conn, $sql);
                                            $persona = pg_fetch_all($row);
                                            foreach ($persona as $m) {
                                            ?>
                                                <option value="<? echo $m['id']; ?>"><? echo $m['sdescripcion']; ?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label">Modelo</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/bosquejo.png" class="input-imagen">
                                        </span>
                                        <input type="text" id="model" class="form-control" maxlength="20" style="border-radius: 0 30px 30px 0;" aria-describedby="basic-addon3 basic-addon4" placeholder="Modelo">
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label">Serial</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/contrasena.png" class="input-imagen">
                                        </span>
                                        <input type="text" id="serl" class="form-control" maxlength="20" style="border-radius: 0 30px 30px 0;" aria-describedby="basic-addon3 basic-addon4" placeholder="Serial" min="20">
                                    </div>

                                </div>
                                <div class="a"><br></div>
                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label">Color</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/paleta.png" class="input-imagen">
                                        </span>
                                        <select class="form-select" style="border-radius: 0 30px 30px 0;" id="colr" aria-describedby="basic-addon3 basic-addon4">
                                            <option value="-1"> Seleccione... </option>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM bienes_publicos.color WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                            $row = pg_query($conn, $sql);
                                            $persona = pg_fetch_all($row);
                                            foreach ($persona as $c) {
                                            ?>
                                                <option value="<? echo $c['id']; ?>"><? echo $c['sdescripcion']; ?></option>
                                            <?
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label">Condición Física</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/ciudad.png" class="input-imagen">
                                        </span>
                                        <select class="form-select" style="border-radius: 0 30px 30px 0;" id="cf" aria-describedby="basic-addon3 basic-addon4">
                                            <option value="-1"> Seleccione... </option>

                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM bienes_publicos.condicion_fisica WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                            $row = pg_query($conn, $sql);
                                            $persona = pg_fetch_all($row);
                                            foreach ($persona as $a) {
                                            ?>
                                                <option value="<? echo $a['id']; ?>"><? echo $a['sdescripcion']; ?></option>
                                            <?
                                            }
                                            ?>


                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label">Estado</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/ciudad.png" class="input-imagen">
                                        </span>
                                        <select class="form-select" style="border-radius: 0 30px 30px 0;" id="est" aria-describedby="basic-addon3 basic-addon4">
                                            <option value="-1"> Seleccione... </option>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM bienes_publicos.estado WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                            $row = pg_query($conn, $sql);
                                            $persona = pg_fetch_all($row);
                                            foreach ($persona as $e) {
                                            ?>
                                                <option value="<? echo $e['id']; ?>"><? echo $e['sdescripcion']; ?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="a"><br></div>

                                <div class="col-sm-3">
                                    <label for="basic-url" class="form-label">Valor</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/vbp.png" class="input-imagen">
                                        </span>
                                        <input type="text" maxlength="15" class="form-control" style="border-radius: 0 30px 30px 0;" id="vbp" oninput="formatearNumero()" aria-describedby="basic-addon3 basic-addon4" placeholder="Ingrese el valor en Bs">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="basic-url" class="form-label">Nro. Orden de Compra</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/oc.png" class="input-imagen">
                                        </span>
                                        <input type="text" class="form-control" maxlength="18" style="border-radius: 0 30px 30px 0;" id="oc" aria-describedby="basic-addon3 basic-addon4" placeholder="Nro. Orden de Compra">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="basic-url" class="form-label">Fecha de Orden de Compra</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/re.png" class="input-imagen">
                                        </span>
                                        <input type="date" class="form-control" style="border-radius: 0 30px 30px 0;" id="foc" aria-describedby="basic-addon3 basic-addon4">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="basic-url" class="form-label">Cuenta Contable</label><span> *</span>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/cc.png" class="input-imagen">
                                        </span>
                                        <select class="form-select" style="border-radius: 0 30px 30px 0;" id="cc" aria-describedby="basic-addon3 basic-addon4">
                                            <option value="-1"> Seleccione... </option>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM bienes_publicos.cuenta_contable WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                            $row = pg_query($conn, $sql);
                                            $persona = pg_fetch_all($row);
                                            foreach ($persona as $cc) {
                                            ?>
                                                <option value="<? echo $cc['id']; ?>"><? echo $cc['sdescripcion']; ?></option>
                                            <?
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="a"><br></div>
                                <div class="col-sm-12">
                                    <label for="basic-url" class="form-label">Observación(es)</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                            <img src="imagenes/ob.png" class="input-imagen">
                                        </span>
                                        <input type="text" id="obs" class="form-control" style="border-radius: 0 30px 30px 0;" aria-describedby="basic-addon3 basic-addon4" placeholder="Escriba cualquier observación(es)">
                                    </div>
                                </div>
                                <div class="col-sm-5"></div>
                                <div class="col-sm-2" style="text-align: center;"><br>

                                    <button onclick="accion_motivo(cbp.value,dbp.value,or.value,marc.value,model.value,serl.value,colr.value,cf.value,est.value,vbp.value,oc.value,foc.value,cc.value,obs.value)" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" id="motivo_agr">Guardar</button>
                                    <button onclick="accion_modificar_regis(id_regis.value,cbp.value,dbp.value,or.value,marc.value,model.value,serl.value,colr.value,cf.value,est.value,vbp.value,oc.value,foc.value,cc.value,obs.value)" type="button" style="display:none;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" id="motivo_agr2">Actualizar</button>

                                    <br><br>
                                </div>
                                <div class="col-sm-5"></div>


                                <!--  <div class="sep"></div>
                        <div class="col-sm-5"></div>
                        <div class="col-sm-2" style="text-align: center;">
                        <a href=""><button type="button" style="display:none;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip"  id="regre">Regresar</button></a>

                        </div>
                        <div class="col-sm-5">                                
                        </div> -->

                                <div class="col-sm-12">
                                    <table id="myTable"><br><br>
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
                                                <th style="text-align:center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="fe">
                                            <?php
                                            $id_usuario = $_SESSION["id_usuario"];

                                            $SQL0 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $id_usuario . "' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
                                            $row0 = pg_query($conn, $SQL0);
                                            $cont2 = pg_num_rows($row0);
                                            if ($cont2 > 0) {
                                                $valor2 = pg_fetch_assoc($row0);
                                                //$valor2['rol_id']=98;
                                                $i = 0;
                                                $sql2 = "SELECT bienes_publicos.bienes_publicos. id,
                                        nnro_bien_publico,
                                        productos.sdescripcion as producto,
                                        productos.id as producto_id,
                                        origen.sdescripcion as origen,
                                        origen.id as origen_id,
                                        marca.sdescripcion as marca,
                                        marca.id as marca_id,
                                        smodelo,sserial,
                                        color.sdescripcion as color,
                                        color.id as color_id,
                                        condicion_fisica.sdescripcion as condicion_fisica,
                                        condicion_fisica.id as condicion_fisica_id,
                                        estado.sdescripcion as estado,
                                        estado.id as estado_id,
                                        nvalor,nnro_valor_compra,dfecha_orden_compra,
                                        cuenta_contable.sdescripcion as cuenta_contable,
                                        cuenta_contable.id as cuenta_contable_id,
                                        sobservaciones
                                        FROM
                                        bienes_publicos.bienes_publicos inner join bienes_publicos.color on
                                        color.id = bienes_publicos.color_id
                                        inner join bienes_publicos.marca on
                                        marca.id = bienes_publicos.marca_id
                                        inner join bienes_publicos.origen on
                                        origen.id = bienes_publicos.origen_id
                                        inner join bienes_publicos.estado on
                                        estado.id = bienes_publicos.estado_id
                                        inner join bienes_publicos.productos on
                                        productos.id = bienes_publicos.productos_id
                                        inner join bienes_publicos.condicion_fisica on
                                        condicion_fisica.id = bienes_publicos.condicion_fisica_id
                                        inner join bienes_publicos.cuenta_contable on
                                        cuenta_contable.id = bienes_publicos.cuenta_contable_id
                                        where bienes_publicos.benabled='TRUE' ORDER BY nnro_bien_publico ASC";
                                                $row2 = pg_query($conn, $sql2);
                                                $or = pg_fetch_all($row2);
                                                while ($or = pg_fetch_assoc($row2)) {
                                                    if ($valor2['rol_id'] == 80) {
                                                        $i++;
                                                        $cosa .= "
                                     <tr>
                                        <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
                                        <td class=\"td center\">" . $or['producto'] . "</td>
                                        <td class=\"td center\">" . $or['marca'] . "</td>
                                        <td class=\"td center\">" . $or['smodelo'] . "</td>
                                        <td class=\"td center\">" . $or['sserial'] . "</td>
                                        <td class=\"td center\">" . $or['color'] . "</td>
                                        <td class=\"td center\">" . $or['estado'] . "</td>
                                        <td class=\"td center\" id=\"botones\">
                                            <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                                            <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"asegurar(" . $or['id'] . ")\">Eliminar </button>
                                        </td>
                                        </tr>
                                     ";
                                                    } else if ($valor2['rol_id'] == 81) {
                                                        $cosa .= "
                                        <tr>
                                           <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
                                           <td class=\"td center\">" . $or['producto'] . "</td>
                                           <td class=\"td center\">" . $or['marca'] . "</td>
                                           <td class=\"td center\">" . $or['smodelo'] . "</td>
                                           <td class=\"td center\">" . $or['sserial'] . "</td>
                                           <td class=\"td center\">" . $or['color'] . "</td>
                                           <td class=\"td center\">" . $or['estado'] . "</td>
                                           <td class=\"td center\" id=\"botones\">
                                               <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                                           </td>
                                           </tr>
                                        ";
                                                    }
                                                }
                                                echo $cosa;
                                            ?>

                                                <!-- Puedes agregar más filas aquí -->
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                            </div>
                            <br>


                            <hr>
                            <div class="sep"></div>
                            <div class="col-sm-4"></div>

                            <div class="col-sm-4" style="text-align: center;">
                                <button type="button" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'><a href="vista.php">Regresar</a></button>
                                <!-- <button type="submit" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip"  id="motivo_agr">Guardar</button> -->
                                <br><br>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script>
        /* import DataTable from 'datatables.net-dt';
import 'datatables.net-responsive-dt';
 
let table = new DataTable('#myTable', {
    responsive: true
}); */


        function formatearNumero() {
            const input = document.getElementById('vbp');
            let numero = input.value.replace(/\D/g, ''); // Elimina cualquier carácter que no sea un dígito
            numero = parseInt(numero, 10); // Convierte a número entero

            // Formatea con puntos cada tres dígitos
            const numeroFormateado = numero.toLocaleString('es-VE');
            input.value = numeroFormateado;
        }



        function validarEntrada(event) {
            const teclaPresionada = event.key;
            const caracteresPermitidos = /^[0-9a-zA-Z/-]$/;

            if (!caracteresPermitidos.test(teclaPresionada)) {
                event.preventDefault(); // Evita que se ingrese el carácter no permitido
            }
        }

        // Ejemplo de uso:

        const miInput = document.getElementById('model'); // Cambia 'miInput' por el ID de tu input
        model.addEventListener('keypress', validarEntrada);



        // Ejemplo de uso:

        const miInput2 = document.getElementById('serl'); // Cambia 'miInput' por el ID de tu input
        serl.addEventListener('keypress', validarEntrada);


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
        /* document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('vbp');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        }); */
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
        document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('barra');

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

    <!-- <script src="js/datatables.js"></script>
        <script src="js/datatables.min.js"></script> -->

    <script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
    <script src="js/login.js"></script>
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
<?php
                                            } else {
                                                die();
                                                echo " :(";
                                            }
?>

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
    <script src="code.jquery.com_jquery-3.7.0.js"></script>
</head>
<body> 

<div class="logo"></div>
<br>
<div class="container">
    <?
    include('menuprincipal.php');
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
                        <input type="text" class="form-control" placeholder="Ej. 23042024-006" id="informe_id" name="informe_id">
                        <button onclick="busqueda()" type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-left: -15px;" onmouseout="this.style.color=&quot;#fff&quot;; this.style.backgroundColor=&quot;#46A2FD&quot;; this.style.border=&quot;1px Solid #46A2FD&quot;" onmouseover="this.style.color=&quot;#46A2FD&quot;; this.style.backgroundColor=&quot;#fff&quot;;" data-bs-toggle="tooltip">Buscar</button>
                    </div>
                </div>
  <br>
  <br>
  <br>
  <br>
        <br>
        <br>
        <h4 style="color:#0d6efd; font-weight:normal;">Datos del Sistema GLPI</h4>
        <hr>
        <form action="interaccion2.php" method="POST" class="input-group">
                <form class="row g-3">
                    <div class="col-md-6" style="display:none">
                            <label for="inputmodelo" class="form-label">Reporte</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"> <img src="img/requerido.png" class="icon"> </span>
                                    <input type="text" class="form-control" placeholder="Ej. 39985" id="id_reporte" name="id_reporte" value="">
                                </div> 
                        </div>
                    <div class="col-md-6" >
                        <label for="inputmodelo" class="form-label">N° de Requerimiento</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/requerido.png" class="icon"> </span>
                            <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. 39985" id="nnumero_requer_glpi" name="nnumero_requer_glpi" disabled>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <label for="inputmodelo" class="form-label">Unidad Administrativa</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"> <img src="img/personas.png" class="icon"> </span>
                                <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. OTICADS-007" id="ubicacion_administrativa_scodigo" name="ubicacion_administrativa_scodigo" disabled> 
                            </div>
                    </div>
                </form>
                <br>
                <br>
                <h4 style="color:#0d6efd; font-weight:normal;">Especificaciones del Equipo</h4>
                <hr>
                <form class="row g-3">
                        <div class="col-md-4" >
                        <label for="inputmodelo" class="form-label">Bien Público</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"> <img src="img/bp.png" class="icon"> </span>
                                <input type="text" class="form-control" placeholder="Ej. 39985" required id="nbien_publico"  name="nbien_publico">
                            </div> 
                        </div>
                        <div class="col-md-4">
                        <label for="inputmodelo" class="form-label">Nombre<span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"> <img src="img/equipo.png" class="icon"> </span>
                                    <input type="text" class="form-control" placeholder="Ej. OTICADS-007" required id="snombre_dispositivo" name="snombre_dispositivo"> 
                                </div>
                        </div>
                        <div class="col-md-4">
                        <label for="inputState" class="form-label">Tipo de Dispositivo<span>*</span></label>
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
                            <select  id="marca_id" class="form-select" name="marca_id">
                                <option selected value="0" >Seleccione</option>
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
                            <input type="text" class="form-control"  maxlength="10" placeholder="Ej. VIT 2710-01" required id="smodelo" name ="smodelo">  
                        </div>           
                    </div>

                </form>
                <br>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputserial" class="form-label">Serial <span>*</span></label>
                        <div class="input-group">  
                            <span class="input-group-text" id="basic-addon1"> <img src="img/serial.png" class="icon"> </span>
                            <input type="text" class="form-control" maxlength="14" placeholder="Ej. A000183569" required id="sserial" name="sserial">
                        </div> 
                    </div>
                    <div class="col-md-4">
                       <label for="inputmodelo" class="form-label">Disco Duro <span>*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"> <img src="img/dd.png" class="icon"> </span>
                                <input type="text" class="form-control" placeholder="Ej. 320GB SATA" required id="sdisco_duro"  name="sdisco_duro" > 
                            </div>
                    </div>

                   <div class="col-md-4">
                       <label for="inputmodelo" class="form-label">Memoria RAM <span>*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"> <img src="img/mr.png" class="icon"> </span>
                                <input type="text" class="form-control" placeholder="Ej. 4GB" required  id="smemoria_ram"  name="smemoria_ram"> 
                            </div>
                   </div> 
               </form>
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
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="loco">
                    <?php

                        $i = 0;

                        $information = "SELECT 
                  reporte_tecnico.reportes_fallas.id AS id_reporte,
                                           dispositivos_id,
                                           snombre_dispositivo,
                                           sdisco_duro,
                                           smemoria_ram,
                                           dispositivos.sdescripcion AS tipo_disp,
                                           nnumero_requer_glpi,
                                           ubicacion_administrativa_scodigo,
                                           marca_id,
                                           marca.sdescripcion As marca,
                                           smodelo,
                                           nbien_publico,
                                           reporte_tecnico.reportes_fallas.nusuario_creacion AS usuario,
					sobservaciones_tecnico,
					srecomendaciones_tecnico,
                                           sserial,
                                           estatus_id,
                                           estatus.sdescripcion As estatus,
                                           estatus_final,
                                           motivo_desincorporacion
                                           FROM reporte_tecnico.reportes_fallas
                                           inner join reporte_tecnico.dispositivos on dispositivos.id = reportes_fallas.dispositivos_id
                                           inner join reporte_tecnico.marca on marca.id = reportes_fallas.marca_id
                                           inner join reporte_tecnico.estatus on estatus.id = reportes_fallas.estatus_id
                                           where reportes_fallas.benabled='TRUE' AND estatus.benabled = 'TRUE' AND marca.benabled = 'TRUE' 
                                           AND dispositivos.benabled = 'TRUE'
                                               ";

                        $row = pg_query($conn, $information);
                        $info = pg_fetch_all($row);

                        while ($info =  pg_fetch_assoc($row)){
                            $i++;
                            $element .="
                            <tr>
                                <td>" . $i . "</td>
                                <td>" . $info['tipo_disp']."</td>
                                <td>" . $info['marca']."</td>
                                <td>" . $info['smodelo']."</td>
                                <td>" . $info['nbien_publico']."</td> 
                                <td>" . $info['sserial'] . "</td>
                                <td>" . $info['estatus'] . "</td>
                                <td>
                                    <button type=\"button\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#46A2FD'; this.style.border='1px Solid #46A2FD''\" onmouseover=\"'this.style.color='#46A2FD'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"accion_editar_registro('" . $info['id_reporte'] . "','" . $info['nnumero_requer_glpi'] . "','" . $info['ubicacion_administrativa_scodigo'] . "','" . $info['nbien_publico'] . "','" . $info['snombre_dispositivo'] . "','" . $info['dispositivos_id'] . "','" . $info['estatus_id'] . "','" . $info['marca_id'] . "','" . $info['smodelo'] . "','" . $info['sserial'] . "','" . $info['sdisco_duro'] . "','" . $info['smemoria_ram'] . "','" . $info['sobservaciones_tecnico'] . "','" . $info['srecomendaciones_tecnico'] . "','" . $info['estatus_final'] . "','" . $info['motivo_desincorporacion'] . "','" . $info['marca'] . "','" . $info['tipo_disp'] . "','" . $info['estatus'] . "','" . $info['usuario'] . "')\">Editar</button>
                                    <button type=\"button\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto\" onmouseout=\"'this.style.color='#fff'; this.style.backgroundColor='#dc3545'; this.style.border='1px Solid #dc3545''\" onmouseover=\"'this.style.color='#dc3545'; this.style.backgroundColor='#fff'; data-bs-toggle='tooltip'\" onclick=\"accion_eliminar_registro('" . $info['id_reporte']."')\">Eliminar </button>
                                </td>
                            </tr>
                            ";
                        }
                        echo $element;
                    ?>
                    </tbody>
                </table>
            <br>
            <br>
            <div class="col-12" style="text-align:center;">
                <button id="" type="submit" onclick="accion_reporte_modificar()" class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar dispositivo</button>
             </div>
             <br>
            <div class="col-sm-8"><h4 style="color:#0d6efd; font-weight:normal;">Análisis del Técnico</h4></div>
            <hr>
            <br>

            <div class="form-floating mb-3">Observación(es)<span>*</span>
                <input class="form-control" style="height: 80px" required name ="sobservaciones_tecnico" id="sobservaciones_tecnico" ></input>
            </div>
            <br>
            <div class="form-floating mb-3">Recomendación(es)<span>*</span>
                <input class="form-control" style="height: 80px" required name="srecomendaciones_tecnico" id="srecomendaciones_tecnico"></input>
            </div>
            <br>
               <div class="col-md-12">
                       <label for="inputState" class="form-label">Estatus Final <span>*</span></label>
                       <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"> <img src="img/estatus.png" class="icon"> </span>
                            <select id="final_id" class="form-select" onchange="mostrarOcultarElemento()" name="final_id" >
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
                   <input class="form-control" id="motivo_desincorporacion" style="height: 80px" required name="motivo_desincorporacion"></input>
               </div> 
               <script>
                    function mostrarOcultarElemento() {
                        const elemento = document.getElementById('elemento-oculto');
                        let final_id = document.getElementById('final_id').value;
                        if (final_id !== '113') {
                            elemento.style.display = 'none';
                        } else {
                            elemento.style.display = 'block';
                        }
                    }
            </script>
        </form>
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
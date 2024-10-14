<?
include("header.php");
$id_oferta = $_REQUEST["id"];
$id_sucursal = $_REQUEST["id_sucursal"];
$id_empresa = $_REQUEST["id_empresa"];
?>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary" style="border-radius: 30px">
                <div class="card-header" style="border-radius:30px 30px 0 0">
                    <h2 class="card-title"> Detalles de la Vacante del Empleo</h2>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <!-- <h4> ID de la oferta: <?php echo $id_oferta; ?> </h4> -->
                        <?php

                        /* $select = ("SELECT * FROM snirlpcd.oferta_empleo WHERE id='$id_oferta' AND benabled = 'true'");
                        $row7 = pg_query($conn, $select); */

                        // DECLARACION DE VARIABLES PARA CONECTAR A LA BASE DE DATOS

                        $host = "10.46.1.93";
                        $dbname = "minpptrasse";
                        $user = "postgres";
                        $pass = "postgres";

                        //OBTENER DATOS DE LA SESION Y HACER UNA CONSULTA DE LOS DATOS DEL REGUISTRO
                        //CONEXION CON SIRE

                        session_start();
                        include('../include/BD.php');
                        $conn2 = Conexion::ConexionBD();

                        //CONEXION CON SNIRLPCD

                        try {
                            $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
                        } catch (PDOException $error) {
                            $conn = $error;
                            echo ("Error al conectar en la Base de Datos " . $error);
                        }

                        if ($id_sucursal != '0') {
                            $sql = "SELECT";
                            $sql .= " rnee.rnee_empresa.srif,";
                            $sql .= " rnee.rnee_empresa.srazon_social,";
                            $sql .= " rnee.rnee_empresa.sdenominacion_comercial,";
                            $sql .= " public.entidad.sdescripcion AS estado,";
                            $sql .= " public.municipio.sdescripcion AS municipio,";
                            $sql .= " public.parroquia.sdescripcion AS parroquia,";
                            $sql .= " rnee.rnee_empresa.sdireccion_fiscal AS direccion,";
                            $sql .= " snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id,";
                            $sql .= " snirlpcd.oferta_empleo.snombre_cargo,";
                            $sql .= " snirlpcd.oferta_empleo.sdias_laborales,";
                            $sql .= " snirlpcd.oferta_empleo.dfecha_creacion AS fecha_publicacion,";
                            $sql .= " snirlpcd.oferta_empleo.shora_entrada_trab,";
                            $sql .= " snirlpcd.oferta_empleo.shora_salida_trab,";
                            $sql .= " snirlpcd.oferta_empleo.benabled,";
                            $sql .= " rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id AS empresa,";
                            $sql .= " rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id AS sucursal,";
                            $sql .= " rnee.rnee_sucursales.sdenominacion_comercial AS nombre_sucursal,";
                            $sql .= " rnee.rnee_sucursales.sdireccion AS dir_sucursal,";
                            $sql .= " public.tipo_contrato_lab.sdescripcion AS tipo_contrato,";
                            $sql .= " public.frecuencia_pago.sdescripcion AS frecuencia";
                            $sql .= " FROM";
                            $sql .= " snirlpcd.oferta_empleo";
                            $sql .= " INNER JOIN";
                            $sql .= " public.tipo_contrato_lab";
                            $sql .= " ON public.tipo_contrato_lab.id = snirlpcd.oferta_empleo.tipo_contrato_lab_id";
                            $sql .= " INNER JOIN";
                            $sql .= " public.frecuencia_pago";
                            $sql .= " ON public.frecuencia_pago.id = snirlpcd.oferta_empleo.frecuencia_pago_id";
                            $sql .= " INNER JOIN";
                            $sql .= " rnee.rnee_condicion_actividad_movimiento";
                            $sql .= " ON rnee.rnee_condicion_actividad_movimiento.id = snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id";
                            $sql .= " INNER JOIN";
                            $sql .= " rnee.rnee_empresa on rnee.rnee_empresa.id = rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id";
                            $sql .= " INNER JOIN";
                            $sql .= " rnee.rnee_sucursales on rnee.rnee_sucursales.id = rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id";
                            $sql .= " INNER JOIN";
                            $sql .= " public.parroquia on public.parroquia.nparroquia = rnee.rnee_empresa.parroquia_id";
                            $sql .= " INNER JOIN";
                            $sql .= " public.municipio on public.municipio.nmunicipio = parroquia.nmunicipio";
                            $sql .= " INNER JOIN";
                            $sql .= " public.entidad on public.entidad.nentidad = parroquia.nentidad";
                            $sql .= " WHERE";
                            $sql .= " snirlpcd.oferta_empleo.id='$id_oferta'";
                            $sql .= " AND";
                            $sql .= " rnee.rnee_condicion_actividad_movimiento.nenabled='1'";
                            $sql .= " AND";
                            $sql .= " snirlpcd.oferta_empleo.benabled='TRUE'";
                            $row = pg_query($conn, $sql);
                            $oferta = pg_fetch_assoc($row);

                            $estado = mb_strtoupper($oferta["estado"]);
                            $municipio = mb_strtoupper($oferta["municipio"]);
                            $parroquia = mb_strtoupper($oferta["parroquia"]);
                            $direccion = mb_strtoupper($oferta["direccion"]);
                            $fecha_publicacion = mb_strtoupper($oferta["fecha_publicacion"]);

                            $srif = $oferta["srif"];
                            $srazon_social = mb_strtoupper($oferta["srazon_social"]);
                            $sdenominacion_comercial = mb_strtoupper($oferta["nombre_sucursal"]);

                            $snombre_cargo = mb_strtoupper($oferta["snombre_cargo"]);
                            $tipo_contrato = mb_strtoupper($oferta["tipo_contrato"]);
                            $frecuencia = mb_strtoupper($oferta["frecuencia"]);

                            $shora_entrada_trab = mb_strtoupper($oferta["shora_entrada_trab"]);
                            $shora_salida_trab = mb_strtoupper($oferta["shora_salida_trab"]);
                            /* $horario = $shora_entrada_trab . " - " . $shora_salida_trab; */
                            $sdias_laborales = mb_strtoupper($oferta["sdias_laborales"]);
                        } else {
                            /* $sql = "SELECT * FROM rnee.rnee_empresa";
                            $sql .= " WHERE id = '" . $id_empresa . "'"; */
                            $sql = "SELECT rnee.rnee_empresa.srif, rnee.rnee_empresa.id, public.municipio.sdescripcion AS municipio,";
                            $sql .= " public.parroquia.sdescripcion AS parroquia, rnee.rnee_empresa.sdireccion_fiscal AS direccion,";
                            $sql .= " rnee.rnee_empresa.srazon_social, public.entidad.sdescripcion AS estado,";
                            $sql .= " snirlpcd.oferta_empleo.id AS oferta_empleo_id,";
                            $sql .= " snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id,";
                            $sql .= " snirlpcd.oferta_empleo.snombre_cargo,";
                            $sql .= " snirlpcd.oferta_empleo.dfecha_creacion AS fecha_publicacion,";
                            $sql .= " snirlpcd.oferta_empleo.benabled, snirlpcd.oferta_empleo.nvacante,";
                            $sql .= " snirlpcd.oferta_empleo.nhora_salida,";
                            $sql .= " snirlpcd.oferta_empleo.nminutos_salida,";
                            $sql .= " snirlpcd.oferta_empleo.shorario_salida,";
                            $sql .= " snirlpcd.oferta_empleo.sdias_laborales,";
                            $sql .= " snirlpcd.oferta_empleo.nhora_entrada,";
                            $sql .= " snirlpcd.oferta_empleo.nminutos_entrada,";
                            $sql .= " snirlpcd.oferta_empleo.shorario_entrada,";
                            $sql .= " rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id AS empresa,";
                            $sql .= " rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id AS sucursal,";
                            $sql .= " public.tipo_contrato_lab.sdescripcion AS tipo_contrato,";
                            $sql .= " public.frecuencia_pago.sdescripcion AS frecuencia,";
                            $sql .= " rnee.rnee_sucursales.sdenominacion_comercial AS nombre_sucursal";
                            $sql .= " FROM rnee.rnee_condicion_actividad_movimiento";
                            $sql .= " INNER JOIN snirlpcd.oferta_empleo ON snirlpcd.oferta_empleo.rnee_condicion_actividad_movimiento_id = rnee.rnee_condicion_actividad_movimiento.id";
                            $sql .= " inner join public.tipo_contrato_lab on tipo_contrato_lab.id= snirlpcd.oferta_empleo.tipo_contrato_lab_id";
                            $sql .= " inner join public.frecuencia_pago on frecuencia_pago.id=snirlpcd.oferta_empleo.frecuencia_pago_id";
                            $sql .= " INNER JOIN rnee.rnee_empresa ON rnee.rnee_empresa.id = rnee.rnee_condicion_actividad_movimiento.rnee_empresa_id";
                            $sql .= " INNER JOIN rnee.rnee_sucursales ON rnee.rnee_sucursales.id = rnee.rnee_condicion_actividad_movimiento.rnee_sucursal_id";
                            $sql .= " INNER JOIN public.parroquia ON public.parroquia.nparroquia = rnee.rnee_empresa.parroquia_id";
                            $sql .= " INNER JOIN public.municipio ON public.municipio.nmunicipio = parroquia.nmunicipio";
                            $sql .= " INNER JOIN public.entidad ON public.entidad.nentidad = parroquia.nentidad";
                            $sql .= " WHERE rnee.rnee_empresa.id = '$id_empresa'";
                            $sql .= " AND snirlpcd.oferta_empleo.id='$id_oferta'";
                            $sql .= " AND snirlpcd.oferta_empleo.benabled='TRUE'";
                            $row = pg_query($conn, $sql);
                            $oferta = pg_fetch_assoc($row);

                            $estado = mb_strtoupper($oferta["estado"]);
                            $municipio = mb_strtoupper($oferta["municipio"]);
                            $parroquia = mb_strtoupper($oferta["parroquia"]);
                            $direccion = mb_strtoupper($oferta["direccion"]);
                            $fecha_publicacion = mb_strtoupper($oferta["fecha_publicacion"]);

                            $srif = $oferta["srif"];
                            $srazon_social = mb_strtoupper($oferta["srazon_social"]);
                            $sdenominacion_comercial = mb_strtoupper($oferta["nombre_sucursal"]);

                            $snombre_cargo = mb_strtoupper($oferta["snombre_cargo"]);
                            $tipo_contrato = mb_strtoupper($oferta["tipo_contrato"]);
                            $frecuencia = mb_strtoupper($oferta["frecuencia"]);

                            $shora_entrada_trab = $oferta["nhora_entrada"].":".$oferta["nminutos_entrada"]." ".$oferta["shorario_entrada"];
                            $shora_salida_trab = $oferta["nhora_salida"].":".$oferta["nminutos_salida"]." ".$oferta["shorario_salida"];
                            /* $horario = $shora_entrada_trab . " - " . $shora_salida_trab; */
                            $sdias_laborales = mb_strtoupper($oferta["sdias_laborales"]);
                        }

                        ?>
                        <div class="col-sm-12">
                            <!-- <center> -->
                            <h5><b>Datos de la Entidad de Trabajo </b></h5>
                            <!-- </center> -->
                        </div>
                        <hr>
                        <div class="col-sm-3">
                            <h6><b>Registro de Información Fiscal (RIF):</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $srif; ?> </h6>
                        </div>
                        <div class="col-sm-3">
                            <h6><b>Nombre o Razón Social:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $srazon_social; ?> </h6>
                        </div>
                        <div class="col-sm-3">
                            <h6><b>Denominación Comercial:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $sdenominacion_comercial; ?> </h6>
                        </div>
                        <br><br>
                        <div class="col-sm-12">
                            <!-- <center> -->
                            <h5><b>Dirección de la Entidad de Trabajo </b></h5>
                            <!-- </center> -->
                        </div>
                        <hr>
                        <div class="col-sm-3">
                            <h6><b>Estado:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $estado; ?> </h6>
                        </div>
                        <div class="col-sm-3">
                            <h6><b>Municipio:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $municipio; ?> </h6>
                        </div>
                        <div class="col-sm-3">
                            <h6><b>Parroquia:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $parroquia; ?> </h6>
                        </div>
                        <div class="col-sm-3">
                            <h6><b>Dirección Fiscal:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $direccion; ?> </h6>
                        </div>
                        <div class="col-sm-3">
                            <h6><b>Fecha de Publicación:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $fecha_publicacion; ?> </h6>
                        </div>
                        <br><br>
                        <div class="col-sm-12">
                            <!-- <center> -->
                            <h5><b>Datos Básicos de la Oferta</b></h5>
                            <!-- </center> -->
                        </div>
                        <hr>
                        <div class="col-sm-3" style="float: left;">
                            <h6><b>Cargo:</b></h6>
                        </div>
                        <div class="col-sm-9" style="float: right;">
                            <h6> <? echo $snombre_cargo; ?> </h6>
                        </div>
                        <div class="col-sm-3" style="float: left;">
                            <h6><b>Tipo de Contrato:</b></h6>
                        </div>
                        <div class="col-sm-9" style="float: right;">
                            <h6> <? echo $tipo_contrato; ?> </h6>
                        </div>
                        <div class="col-sm-3" style="float: left;">
                            <h6><b>Frecuencia de pago:</b></h6>
                        </div>
                        <div class="col-sm-9" style="float: right;">
                            <h6> <? echo $frecuencia; ?> </h6>
                        </div>
                        <div class="col-sm-3" style="float: left;">
                            <h6><b>Hora de Entrada:</b></h6>
                        </div>
                        <div class="col-sm-9" style="float: right;">
                            <h6> <? echo $shora_entrada_trab; ?> </h6>
                        </div>
                        <div class="col-sm-3" style="float: left;">
                            <h6><b>Hora de Salida:</b></h6>
                        </div>
                        <div class="col-sm-9" style="float: right;">
                            <h6> <? echo $shora_salida_trab; ?> </h6>
                        </div>
                        <div class="col-sm-3" style="float: left;">
                            <h6><b>Días Laborales:</b></h6>
                        </div>
                        <div class="col-sm-9">
                            <h6> <? echo $sdias_laborales; ?> </h6>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <?php
                        $query = "SELECT";
                        $query .= " snirlpcd.requisitos_oferta_empleo.sdescripcion,";
                        $query .= " public.nivel_requisito.sdescripcion AS nivel_requisito";
                        $query .= " FROM";
                        $query .= " snirlpcd.requisitos_oferta_empleo";
                        $query .= " INNER JOIN";
                        $query .= " public.nivel_requisito";
                        $query .= " ON";
                        $query .= " public.nivel_requisito.id";
                        $query .= " =";
                        $query .= " snirlpcd.requisitos_oferta_empleo.nivel_requisito_id";
                        $query .= " WHERE";
                        $query .= " snirlpcd.requisitos_oferta_empleo.oferta_empleo_id='$id_oferta'";
                        $query .= " AND";
                        $query .= " snirlpcd.requisitos_oferta_empleo.benabled ='TRUE'";
                        $query .= " ORDER BY";
                        $query .= " snirlpcd.requisitos_oferta_empleo.nivel_requisito_id ASC ";
                        ?>
                        <div class="col-sm-12">
                            <h5><b>Requisitos: </b></h5>
                            <div style="margin: 20px">
                                <h6>
                                    <b> # 1 </b> <br>
                                    <b> Nivel de Requerimiento: </b> Alto <br>
                                    <b> Descripción: </b> Para poder ser aceptado debe si o sí presentar su Carnet de Certificación de CONAPDIS a la hora de ir a la posible entrevista
                                </h6>
                            </div>
                            <?
                            $requisito = pg_query($conn, $query);
                            while ($row2 = pg_fetch_assoc($requisito)) {
                                $i++;
                                $j = $i + 1;
                                echo '
                                    <div style="margin: 20px">
                                        <h6>
                                            <b> # ' . $j . '</b> <br>
                                            <b> Nivel de Requerimiento: </b> ' . $row2['nivel_requisito'] . ' <br>
                                            <b> Descripción: </b> ' . $row2['sdescripcion'] . '
                                        </h6>
                                    </div>
                                ';
                            }
                            ?>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                        </div>

                        <?php

                        $sentencia = "SELECT";
                        $sentencia .= " snirlpcd.beneficios_oferta_empleo.sdescripcion,";
                        $sentencia .= " public.tipo_beneficio.sdescripcion AS tipo_beneficio";
                        $sentencia .= " FROM";
                        $sentencia .= " snirlpcd.beneficios_oferta_empleo";
                        $sentencia .= " INNER JOIN";
                        $sentencia .= " public.tipo_beneficio";
                        $sentencia .= " ON";
                        $sentencia .= " public.tipo_beneficio.id=snirlpcd.beneficios_oferta_empleo.tipo_beneficio_id";
                        $sentencia .= " WHERE";
                        $sentencia .= " snirlpcd.beneficios_oferta_empleo.benabled='TRUE'";
                        $sentencia .= " AND";
                        $sentencia .= " snirlpcd.beneficios_oferta_empleo.oferta_empleo_id='$id_oferta'";
                        $sentencia .= " ORDER BY";
                        $sentencia .= " snirlpcd.beneficios_oferta_empleo.tipo_beneficio_id ASC";

                        ?>
                        <div class="col-sm-12">
                            <h5><b>Beneficios: </b></h5>
                            <?
                            $beneficio = pg_query($conn, $sentencia);
                            while ($row3 = pg_fetch_assoc($beneficio)) {
                                $i2++;
                                echo '
                                    <div style="margin: 20px">
                                        <h6>
                                            <b> # ' . $i2 . '</b> <br>
                                            <b> Tipo de Beneficio: </b> ' . $row3['tipo_beneficio'] . ' <br>
                                            <b> Descripción: </b> ' . $row3['sdescripcion'] . '
                                        </h6>
                                    </div>
                                ';
                            }
                            ?>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <center>
                            <div class="col-sm-4">
                                <a href="oportunidad_trabajo.php">
                                    <input style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' type="submit" value="Regresar">
                                </a>
                                <a href="postulacion.php?id=<?php echo $id_oferta ?>">
                                    <button style="background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";' class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Postularse</button>
                                </a>
                            </div>
                        </center>
                        <div class="col-sm-7">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- <script src="postularse.js"></script> -->
<? include("footer.php"); ?>
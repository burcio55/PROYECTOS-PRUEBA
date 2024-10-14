<div style=" display:none; " class="fondo_alerta" id="alerta">
    <div class="alerta">
        <h4 id="titulo">Atención</h4>
        <p id="mensaje"></p>
        <center>

            <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="cerrar()">Cerrar</button>
        </center>
    </div>
</div>


<?php
include("header.php");
include("BD.php");
/* $fecha_hora = date("Y-m-d H:i:s");

$grande1 = 0;
$grande2 = 0;

$type1 = 0;
$type2 = 0;

$sacotacion_supervisor = $_REQUEST["sacotacion_supervisor"];

// Primer Archivo
if (isset($_FILES["sprimer_curso"])) {
    $nombre1 = $_FILES["sprimer_curso"]["name"];
    $tipo1 = $_FILES["sprimer_curso"]["type"];
    $temporal1 = $_FILES["sprimer_curso"]["tmp_name"];

    if (!in_array($tipo1, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type1++;
    }
    $fecha_hora = date("Y-m-d H:i:s");
    $nombre_unico1 = $fecha_hora . " - " . $nombre1;
    $ruta1 = "imagenes/" . $nombre_unico1;
    move_uploaded_file($temporal1, $ruta1);
}

// Segundo Archivo
if (isset($_FILES["ssegundo_curso"])) {
    $nombre2 = $_FILES["ssegundo_curso"]["name"];
    $tipo2 = $_FILES["ssegundo_curso"]["type"];
    $temporal2 = $_FILES["ssegundo_curso"]["tmp_name"];
    if (!in_array($tipo2, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type2++;
    }
    $nombre_unico2 = $fecha_hora . " - " . $nombre2;
    $ruta2 = "imagenes/" . $nombre_unico2;
    move_uploaded_file($temporal2, $ruta2);
} */

$peso_total1 = $_SESSION["peso_total1"];
$peso_total2 = $_SESSION["peso_total2"];
$peso_total = $peso_total1 + $peso_total2;

$total = $peso_total;

$id = $_SESSION['id_evaluacion'];
$observacion = "";

if($id!=""){
    $SQL = "SELECT * FROM evaluacion_desemp.evaluacion WHERE personales_id = '$id' AND benabled = 'TRUE' AND nestatus = '2'";
    $row = pg_query($conn, $SQL);
    $persona = pg_fetch_assoc($row);
    $observacion = $persona['sacotacion_supervisor'];
    $_SESSION["evaluacion_id"] = $id;
}

?>

<div style="background-color: white; width: 30%; padding: 0px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; display:none; margin-top: 10%" id="alerta">
    <div class="presion" style="margin-top: -11px;">
    <h4 id="titulo" style="padding: 7px 20px; border-radius: 30px 30px 0 0; background-color: rgb(8, 150, 197); color: white;">Atención</h4>
        <p id="mensaje" style="text-align: justify; padding: 5px 20px; font-size: 20px; text-align: center;"></p>
        <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="cerrar2()">Cerrar</button>
    </div>
</div>
<?

if ($peso_total > 374 && $peso_total < 500) {
?>
    <div style="background-color: white; width: 30%; padding: 0px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; margin-top: 10%" id="alerta2">
        <div class="presion" style="margin-top: -11px;">
        <h4 id="titulo" style="padding: 7px 20px; border-radius: 30px 30px 0 0; background-color: rgb(8, 150, 197); color: white;">Atención</h4>
            <p id="mensaje" style="text-align: justify; padding: 5px 20px; font-size: 20px; text-align: center;">Debe justificar el rango de actuación con el objetivo adicional más los dos (2) cursos del trimestre</p>
            <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="cerrar()">Cerrar</button>
        </div>
    </div>
<?
} else
if ($peso_total == 500) {
?>
    <div style="background-color: white; width: 30%; padding: 0px; border-radius: 30px; border: grey 1px solid; position:absolute; margin-left: 30%; margin-top: 10%" id="alerta2">
        <div class="presion" style="margin-top: -11px;">
        <h4 id="titulo" style="padding: 7px 20px; border-radius: 30px 30px 0 0; background-color: rgb(8, 150, 197); color: white;">Atención</h4>
            <p id="mensaje" style="text-align: justify; padding: 5px 20px; font-size: 20px; text-align: center;">Debe justificar el rango de actuación con el objetivo adicional extraordinario más los dos (2) cursos del trimestre</p>
            <button type="button" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="cerrar()">Cerrar</button>
        </div>
    </div>
<?
}

?>
<script>
    function cerrar() {
        document.getElementById("alerta2").style.display = "none";
    }
</script>

<main>
    <div class="content-3d">
        <div class="container">
            <?
            include('menu2.php');
            ?>
            <div class="content-login">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 style="font-size:32px; font-weight: normal; color: #1060C8;">MÓDULO III: EN ESTE MÓDULO SE OBTENDRÁ EL RANGO DE ACTUACIÓN DEL EVALUADO --> TOTAL MÓDULO I + TOTAL MÓDULO II</h2>
                    </div>
                    <div class="col-sm-3"></div>
                    <table style="width: 100%" id="modulo3" class="table">
                            <tbody>

                                <tr>
                                    <th style="text-align: center; border-bottom: solid 1px grey" colspan="2">CALIFICACIÓN FINAL </th>
                                    <th style="text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> ESCALA CUANTITATIVA</th>
                                    <th style="text-align: center; border-bottom: solid 1px grey; border-left: solid 1px grey;"> RANGO DE ACTUACIÓN</th>
                                </tr>
                                <tr>
                                    <th style=" border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; ">"I"</span></th>
                                    <td align="center">
                                        <div class="input-group">
                                            <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="total_modulo1" id="total_modulo1" type="text" value="<? echo $peso_total1; ?>" disabled placeholder="" />
                                        </div>

                                    </td>

                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 100 - 124 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700;"> No Cumplió </span></th>
                                </tr>
                                <tr>
                                    <th style=" border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; ">"II"</span></th>
                                    <td align="center" style="border-radius: 30px; border-bottom: solid 1px grey">
                                        <div class="input-group">
                                            <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="total_modulo2" id="total_modulo2" type="text" value="<? echo $peso_total2; ?>" disabled placeholder="" />
                                        </div>

                                    </td>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 125 - 249 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#FF801C;"> Cumplimiento Ordinario </span></th>
                                </tr>
                                <tr>
                                    <th style=" border-bottom: solid 1px grey; text-align:center; font-weight: normal">Total Módulo <span style="font-weight: 700; ">"I"</span> + Total Módulo <span style="font-weight: 700; ">"II"</span></th>
                                    <td align="center" style="border-radius: 30px; border-bottom: solid 1px grey">

                                        <div class="input-group">
                                            <input style="border-radius: 30px; border-color:#999999; width:75%; float:left;" class="form-control" name="total_modulo3" id="total_modulo3" type="text" value="<? echo $peso_total; ?>" disabled placeholder="" />
                                        </div>

                                    </td>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 250 - 374 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#FFD617; "> Bueno</span> - Cumplimiento de Proceso de Mejora </th>
                                </tr>
                                <tr>
                                    <th colspan="2" style=" border-bottom: solid 1px grey; text-align:center; padding: 8px; font-weight: 700">Rango de Actuación</th>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 375 - 499 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#90DB0F "> Muy Bueno</span> - Cumplimiento Destacable </th>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" style="border-radius: 30px; border-bottom: solid 1px grey; padding: 8px; font-weight: normal;">
                                        <span style="font-weight: 700; ">
                                        <?
                                        if ($peso_total >= '100 ' && $peso_total <= '124') {
                                            echo "No cumplió";
                                        } else
                                        if ($peso_total >= '125' && $peso_total <= '249') {
                                            echo "Cumplimiento Ordinario";
                                        } else
                                        if ($peso_total >= '250 ' && $peso_total <= '374') {
                                            echo "Bueno - Cumplimiento de Proceso de Mejora";
                                        } else
                                        if ($peso_total >= '375' && $peso_total <= '499') {
                                            echo "Muy Bueno - Cumplimiento Destacable";
                                        } else
                                        if ($peso_total == '500') {
                                            echo "Excelente - Cumplimiento Emulable";
                                        }
                                        ?>
                                        </span>
                                    </td>
                                    <th style=" text-align: center; border-left: solid 1px grey; border-bottom: solid 1px grey"> 500 </th>
                                    <th style=" text-align: left; border-left: solid 1px grey; border-bottom: solid 1px grey; padding: 0 15px; font-weight: normal;"><span style="font-weight: 700; color:#3BDB0F "> Excelente</span> - Cumplimiento Emulable </th>
                                </tr>
                                <!-- <tr id="op1" style="display: none; width: 100%;">
									<th colspan="4" style="color: gray; width: 100%;"> Justifique el Rango de Actuación más los Cursos de Trimestre </th>
								</tr>
								<tr id="op2" style="display: none; width: 100%;">
									<td colspan="4" align="center" style="border-radius: 30px;">
					                	<font color="#666666">
											<textarea style="border-radius: 30px; border-color:#999999; width:99%; float:left; height: 70px; padding: 10px"></textarea>
					                	</font>
					                </td>
								</tr> -->
                            </tbody>
                        </table>

                        <div class="col-sm-8">
                            <h2 style="color: rgb(35, 96, 249); font-size:22px;">MÓDULO IV: ACOTACIONES DEL SUPERVISOR</h2>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                        <div class="sep"></div>
                        <hr>
                        <form id="miFormulario" class="col-md-8 fondo" action="subir_foto.php" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="row">

                                <div class="col-sm-12"><label for="basic-url" class="form-label" style="margin-top:10px">Observaciones y acotaciones <span>*</span> </label>
                                    <textarea name="sacotacion_supervisor" id="sacotacion_supervisor" cols="30" rows="10" style="width: 100%; border-radius: 30px;  min-width: 99%; max-width: 99%; float:left; height: 70px; padding: 10px;"><? echo $observacion; ?></textarea>
                                </div>

                                <div class="sep"></div>

                                <div class="col-sm-2"></div>
                                <div class="col-sm-8" style="text-align: center;">
                                    <span class="requerido">Los certificados deben tener formato ".PDF"</span>
                                </div>
                                <div class="col-sm-2"></div>

                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label" style="margin-top:10px">Nombre del 1er Curso <span>*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                            <img src="img/co.png" class="input-imagen">
                                        </span>
                                        <input type="text" style="border-radius: 0 30px 30px 0;" class="form-control" name="sprimer_curso_nombre" id="sprimer_curso_nombre" placeholder="Ej. Curso de Repostería">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <label for="basic-url" class="form-label" style="margin-top:10px">Fecha de Realización <span>*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                            <img src="img/co.png" class="input-imagen">
                                        </span>
                                        <input type="date" style="border-radius: 0 30px 30px 0;" class="form-control"  name="sprimer_curso_fecha" id="sprimer_curso_fecha">
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <label for="basic-url" class="form-label" style="margin-top:10px">Adjunte el Certificado<span>*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                            <img src="img/co.png" class="input-imagen">
                                        </span>
                                        <input type="file" style="border-radius: 0 30px 30px 0;" class="form-control" name="sprimer_curso" id="sprimer_curso">
                                    </div>
                                </div>

                                <div class="sep"></div>

                                <div class="col-sm-4">
                                    <label for="basic-url" class="form-label" style="margin-top:10px">Nombre del 2do Curso<span>*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                            <img src="img/co.png" class="input-imagen">
                                        </span>
                                        <input type="text" style="border-radius: 0 30px 30px 0;"  class="form-control" name="ssegundo_curso_nombre" id="ssegundo_curso_nombre" placeholder="Ej. Curso de Dibujo">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <label for="basic-url" class="form-label" style="margin-top:10px">Fecha de Realización <span>*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                            <img src="img/co.png" class="input-imagen">
                                        </span>
                                        <input type="date" style="border-radius: 0 30px 30px 0;" class="form-control" name="ssegundo_curso_fecha" id="ssegundo_curso_fecha">
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <label for="basic-url" class="form-label" style="margin-top:10px">Adjunte el Certificado<span>*</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                            <img src="img/co.png" class="input-imagen">
                                        </span>
                                        <input type="file"  style="border-radius: 0 30px 30px 0;" class="form-control"  name="ssegundo_curso" id="ssegundo_curso">
                                    </div>
                                </div>

                                <div class="sep"></div>

                                <center>
                                        <button type="submit" style="margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">GUARDAR</button>
                                </center>
                            </div>
                        </form>


                </div>
            </div>
        </div>
    </div>
</main>
<?php 
include("footer.php")
?>


<div id="Contenido" align="center" style="overflow:auto">
    <br>
    <table class="tabla" width="95%" height="95%">
        <tbody>
            <!-- <table width="95%" border="0" align="center" class="formulario">
                            <tr class="identificacion_seccion" width="100%">
                                <th colspan="4" class="sub_titulo_2" width="100%" align="center" style="background-color: #D0E0F4; padding: 5px; border-radius: 30px; color: #1060C8;">
                                    MÓDULO IV: ACOTACIONES DEL SUPERVISOR
                                </th>
                            </tr>
                            <tr>
                                <td colspan="4"> </td>
                            </tr>
                            <tr width="100%">
                                <th colspan="4" style="color: grey;">Observaciones y acotaciones</th>
                            </tr>
                            <tr width="100%">
                                <td align="center" style="border-radius: 30px;" colspan="4">
                                    <font color="#666666">
                                        <input type="text" name="sacotacion_supervisor" id="sacotacion_supervisor" style="border-radius: 30px; border-color:#999999; width:99%; float:left; height: 70px; padding: 10px" value="<? echo $sacotacion_supervisor; ?>">
                                    </font>
                                </td>
                            </tr>
                            <tr style="display: none; width: 100%;">
                                <th colspan="4" style="color: gray; width: 100%;"> Adjuntar Certificados de los Cursos </th>
                            </tr>
                            <tr style="display: none; width: 100%;">
                                <td colspan="2" align="center" style="border-radius: 30px;">
                                    <font color="#666666">
                                        <input type="text" style="border-radius: 30px; border-color:#999999; width:90%; padding: 10px" name="sprimer_curso" id="sprimer_curso" value="<? echo $ruta1; ?>">
                                    </font>
                                </td>
                                <td colspan="2" align="center" style="border-radius: 30px;">
                                    <font color="#666666">
                                        <input type="text" style="border-radius: 30px; border-color:#999999; width:90%; padding: 10px" name="ssegundo_curso" id="ssegundo_curso" value="<? echo $ruta2; ?>">
                                    </font>
                                </td>
                            </tr>
                        </table> -->
            </td>
            </tr>
        </tbody>
    </table>
</div>
<script src="subir_foto.js"></script>

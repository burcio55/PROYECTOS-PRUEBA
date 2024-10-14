<? include("header.php"); ?>

<div class="wrapper">
    <section class="content">
        <!-- Contenido Principal -->
        <div class="container-fluid">
            <div class="card card-primary" style="border-radius: 30px">
                <div class="card-header" style="border-radius:30px 30px 0 0">
                    <h2 class="card-title"> Dirección de la Entidad de Trabajo </h2>
                </div>
                <form class="form-horizontal">
                    <div class="card-body">
                        <!-- Dirección de la Entidad de Trabajo -->
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="text-secondary">Estado</label>
                                <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-secondary">Municipio</label>
                                <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-secondary">Parroquia</label>
                                <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-secondary">Dirección Fiscal</label>
                                <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                                <input type="text" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-secondary">Fecha de Publicación (Actual)</label>
                                <p class="text-secondary">
                                    <?php
                                    echo $fecha = date("d-m-Y");
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Opciones Básicas -->
            <div class="card card-primary" style="border-radius: 30px">
                <div class="card-header" style="border-radius:30px 30px 0 0">
                    <h2 class="card-title"> Datos Básicos </h2>
                </div>
                <form class="form-horizontal" style="padding: 20px">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="text-secondary">Cargo</label>
                            <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                            <input type="text" placeholder="Ej. Guardián de Seguridad" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                        </div>
                        <!-- <div class="col-sm-3">
                            <label class="text-secondary">Edad mínima</label>
                            <input type="number" placeholder="Ej. 18" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                        </div>
                        <div class="col-sm-3" style="margin: 0 0 0 -17px">
                            <label class="text-secondary">Edad máxima</label>
                            <input type="number" placeholder="Ej. 35" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                        </div> -->
                        <div class="col-sm-6">
                            <label class="text-secondary">Número de Vacantes</label>
                            <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                            <input type="number" placeholder="Ej. 20" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                        </div>
                        <div class="col-sm-6">
                            <label class="text-secondary">Tipo de Contrato</label><span style="color: red;"> *</span>
                            <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                            <select name="cbGraduado" style="border-radius: 30px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                                <option value="-1" selected="selected">Seleccione</option>
                                <option value="1">Determinado</option>
                                <option value="2">Indeterminado</option>
                            </select>
                        </div>
                        <!-- <div class="col-sm-6">
                            <label class="text-secondary">Salario Base en Bolivares</label>
                            <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div>
                            <input type="number" placeholder="Ej. 900" class="form-control" style="border-radius: 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                        </div> -->
                        <div class="col-sm-6">
                            <label class="text-secondary">Frecuencia de Pago</label><span style="color: red;"> *</span>
                            <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                            <select name="cbGraduado" style="border-radius: 30px; width: 94%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                                <option value="-1" selected="selected">Seleccione</option>
                                <option value="1">Semanal</option>
                                <option value="2">Quincenal</option>
                                <option value="3">Mensual</option>
                                <option value="4">Variado</option>
                            </select>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        <!-- Horarios -->
        <div class="card card-primary" style="border-radius: 30px">
            <div class="card-header" style="border-radius:30px 30px 0 0">
                <h2 class="card-title"> Horarios </h2>
            </div>
            <form class="form-horizontal" style="padding: 20px">
                <!-- Formulario -->
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="text-secondary">Hora de entrada</label>
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                        <input type="text" placeholder="Ej. 8:30" class="form-control" style="border-radius: 30px 0 0 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                    </div>
                    <div class="col-sm-2">
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                        <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 48px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                            <option value="-1" selected="selected">am. / pm.</option>
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="text-secondary">Hora de salida</label>
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                        <input type="text" placeholder="Ej. 8:30" class="form-control" style="border-radius: 30px 0 0 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                    </div>
                    <div class="col-sm-2">
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                        <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 48px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                            <option value="-1" selected="selected">am. / pm.</option>
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="text-secondary">Inicio del descanso</label>
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                        <input type="text" placeholder="Ej. 8:30" class="form-control" style="border-radius: 30px 0 0 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                    </div>
                    <div class="col-sm-2">
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                        <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 48px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                            <option value="-1" selected="selected">am. / pm.</option>
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="text-secondary">Final del descanso</label>
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto; margin: -10px 0 0 0" src="../imagenes/birrete.png"></samp>
                                    </div>
                                </div> -->
                        <input type="text" placeholder="Ej. 8:30" class="form-control" style="border-radius: 30px 0 0 30px; width: 94%; height: 31px; border: 1px solid #ccc; color: gray" class=" form-control form-control-sm" id="titulo" value="" size="50" maxlength="100">
                    </div>
                    <div class="col-sm-2">
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                        <select name="" style="border-radius: 0 30px 30px 0; width: 95%; border: 1px solid #ccc; color: gray; margin: 48px 0 0 -25px" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                            <option value="-1" selected="selected">am. / pm.</option>
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <center>
                            <br>
                            <h5 class="text-secondary" style="margin: 10px 0 0 0">Días Laborales</h5>
                            <hr>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="lunes" value="lunes">
                                <label class="form-check-label" for="lunes" style="margin: 0">Lunes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="martes" value="martes">
                                <label class="form-check-label" for="martes" style="margin: 0">Martes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="miercoles" value="miercoles">
                                <label class="form-check-label" for="miercoles" style="margin: 0">Miércoles</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="jueves" value="jueves">
                                <label class="form-check-label" for="jueves" style="margin: 0">Jueves</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="viernes" value="viernes">
                                <label class="form-check-label" for="viernes" style="margin: 0">Viernes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="sabado" value="sabado">
                                <label class="form-check-label" for="sabado" style="margin: 0">Sábado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="domingo" value="domingo">
                                <label class="form-check-label" for="domingo" style="margin: 0">Domingo</label>
                            </div>
                            <br><br>
                            <input type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' value="Agregar">
                        </center>
                    </div>
                    <table class="table table-bordered table-striped table-sm" style="background-color: white; margin: 30px 0 0 0">
                        <thead>
                            <tr class="text-secondary">
                                <th class="text-center">#</th>
                                <th class="text-center">Entrada</th>
                                <th class="text-center">Salida</th>
                                <th class="text-center">Inicio del Descanso</th>
                                <th class="text-center">Final del Descanso</th>
                                <th class="text-center">Días</th>
                                <th class="text-center" style="width: 155px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
        </div>
        <!-- Requisitos -->
        <div class="card card-primary" style="border-radius: 30px">
            <div class="card-header" style="border-radius:30px 30px 0 0">
                <h2 class="card-title"> Requisitos </h2>
            </div>
            <form class="form-horizontal" style="padding: 20px">
                <!-- Formulario -->
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="text-secondary" style="margin-top: 10px;">Descripción</label>
                        <textarea class="form-control" name="Observaciones_educacion" type="text" id="Observaciones_educacion" value="<?= $aDefaultForm['Observaciones_educacion'] ?>" size="50" maxlength="100" style="border-radius: 30px; margin: 0 0 30px 0" onkeyup="mayus(this);"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-secondary">Nivel de Requerimiento</label>
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                        <select name="" style="border-radius: 30px; width: 95%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                            <option value="-1" selected="selected">Seleccione</option>
                            <option value="1">Fundamental</option>
                            <option value="2">Normal</option>
                            <option value="3">No tan Requerido</option>
                            <option value="4">opcional</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <center>
                            <input type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' value="Agregar">
                        </center>
                    </div>
                    <table class="table table-bordered table-striped table-sm" style="background-color: white; margin: 30px 0 0 0">
                        <thead>
                            <tr class="text-secondary">
                                <th class="text-center">#</th>
                                <th class="text-center" style="width: 55%">Descripción</th>
                                <th class="text-center">Nivel de Requerimiento</th>
                                <th class="text-center" style="width: 155px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
        </div>
        <!-- Beneficios -->
        <div class="card card-primary" style="border-radius: 30px">
            <div class="card-header" style="border-radius:30px 30px 0 0">
                <h2 class="card-title"> Beneficios </h2>
            </div>
            <form class="form-horizontal" style="padding: 20px">
                <!-- Formulario -->
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="text-secondary">Tipo de Beneficio</label>
                        <!-- <div>
                                    <div class="input-group-addon" style="width:31px; height:31px; padding:7px 0 7px 10px; border: 1px solid #cccccc; background-color: #E6E6E6; border-radius: 15px 0 0 15px">
                                        <samp><img style="width: 12px; height: auto;" src="../imagenes/birrete_2.png"></samp>
                                    </div>
                                </div> -->
                        <select name="" style="border-radius: 30px; width: 95%; border: 1px solid #ccc; color: gray" onchange="javascript:set()" class=" form-control-sm select2" id="cbGraduado">
                            <option value="-1" selected="selected">Seleccione</option>
                            <option value="1">Transporte</option>
                            <option value="2">Ayuda Nutricional</option>
                            <option value="3">Ayuda Económica</option>
                            <option value="4">Seguro</option>
                            <option value="4">Jubilación</option>
                            <option value="4">Licencias</option>
                            <option value="4">Bono de Rendimiento</option>
                            <option value="4">Vacaciones</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-secondary" style="margin-top: 10px;">Descripción</label>
                        <textarea class="form-control" name="Observaciones_educacion" type="text" id="Observaciones_educacion" value="<?= $aDefaultForm['Observaciones_educacion'] ?>" size="50" maxlength="100" style="border-radius: 30px; margin: 0 0 30px 0" onkeyup="mayus(this);"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <center>
                            <input type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' value="Agregar">
                        </center>
                    </div>
                    <table class="table table-bordered table-striped table-sm" style="background-color: white; margin: 30px 0 0 0">
                        <thead>
                            <tr class="text-secondary">
                                <th class="text-center">#</th>
                                <th class="text-center">Tipo de Beneficio</th>
                                <th class="text-center" style="width: 55%">Descripción</th>
                                <th class="text-center" style="width: 155px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <center>

                        <input style="background-color: #46A2FD; color: #fff; width: auto;border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; font-size:16px; margin: 30px 0 0 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" type="submit" value="Continuar">
                    </center>
                </div>
            </form>
        </div>
</div>
</section>
</div>
<? include("footer.php"); ?>
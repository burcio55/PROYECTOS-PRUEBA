<?php
    include("header.php");
?>
<div class="col-md-12">
    <!--<div class="card card-primary"> Original-->
    <div class="card">
        <!-- card-header alert-primary  text-white bg-primary -->
        <div class="card-header text-center alert-primary">
            <h3 class="card-title">DISCAPACIDAD</h3>
        </div>
        
        <!--<div class="card-body">-->
        <form action="../../../agencia_empleo_VIEJO/mod_agencia_empleo/1_5agen_trab_educacion.php">
            <div class="card-body">
                <!--inicio card-body Información de Experiencia Laboral-->
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div>
                                <label class="text-secondary">Posee discapacidad?</label>
                            </div>
                            <div class="icheck-gray d-inline">
                                <input type="radio" id="radioPrimary13" name="r7" checked="">
                                <label for="radioPrimary13" class="text-secondary">SI
                                </label>
                            </div>
                            <div class="icheck-gray d-inline">
                                <input type="radio" id="radioPrimary14" name="r7">
                                <label for="radioPrimary14" class="text-secondary">NO
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label class="text-secondary">Número de Certificado</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Certificado xxxx" disabled  >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label class="text-secondary">Dicapacidad General</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-wheelchair"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Visual"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label class="text-secondary">Discapacidad Específica</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-eye-slash"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ceguera Total"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- radio -->
                            <div class="form-group">
                                <label class="text-secondary">Afectación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-accessible-icon"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Por ausencia de la función visual"  disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="text-secondary">Localización</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Ambos ojos"  disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="text-secondary">Origen de Discapacidad</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dna"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Genética"  disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="text-secondary">Nivel de Dependencia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-blind"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Poca dependencia"  disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="text-secondary">Grado de Discapacidad</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dot-circle"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Severo"  disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">		
                            <div class="col-sm-12">
                                <label class="text-secondary">Observaciones</label>
                                <textarea class="form-control" id="validationTextarea" placeholder="Observaciones" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div align="right">
                                <label for="situacion_actual" class="text-secondary">¿Es beneficiario de la Misión José Gregorio Hernández?</label>
                            </div>
                        </div>
                    </div>
                        <div align="left" class="col-md-3">
                            <div align="left"  class="icheck-gray d-inline">
                                <input type="radio" id="radioPrimary7" name="r4" checked="">
                                <label for="radioPrimary7" class="text-secondary">SI
                                </label>
                            </div>
                        <div align="left"  class="icheck-gray d-inline">
                            <input type="radio" id="radioPrimary8" name="r4">
                            <label for="radioPrimary8" class="text-secondary">NO
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-3"> </div>
                        <div class="col-md-3">
                            <a href="1_5agen_trab_educacion.php">
                                <input class="btn btn-outline-primary" value="Continuar">
                            </a>  
                        </div>
                        <div class="col-md-2">
                            <a href="1_1agen_trab_datos.php">
                                <input class="btn btn-outline-danger" value="Regresar">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!----</div>-->
    </div>
    <!-- /.card-body -->
</div>
<?php
    include("footer.php");
?>
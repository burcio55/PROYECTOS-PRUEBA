<?php 
    session_start();
    unset($_SESSION['usuario']);
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>SIROET - Sistema de Información y Registro de Oportunidades de Educación y Trabajo| MPPPST</title>
        <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
        <meta content="Themesdesign" name="author" />
        <!--link rel="shortcut icon" href="assets/images/favicon.ico"-->

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
          
    </head>

    <body>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="home-btn d-none d-sm-block">
                <a href="pagina-inicio-sesion.php" class="text-white"><i class="fas fa-home h2"></i></a>
            </div>

            
        <div class="wrapper-page">
                <div class="card card-pages shadow-none">
                   
                    <div class="card-body">
                        <!--div class="text-center m-t-0 m-b-15">
                                <a href="index.html" class="logo logo-admin"><img src="assets/images/logo-dark.png" alt="" height="24"></a>
                        </div-->
                     <img style="float: left; margin: -20px 300px 200px -350px; object-position: 20%  20%;" src="assets/images/logo_siroet-03.png" width="250" height="200" /> 
                     <h5 class="font-25 text-white" style="float: left; margin: -180px 400px 50px -450px;">"EDUCAR Y TRABAJAR PARA EL FUTURO"</h5>
                     <h5 class="font-25 text-white" style="float: left; margin: -140px 600px 50px -300px;">"MPPPST"</h5>
                 
                     <h5 class="font-18 text-center" style="float: left; margin: -370px 800px 300px 150px;"> REGISTRO DE EMPRESA</h5>
    
                        <form class="form-horizontal m-t-30" action="index.html">


                            <div class="form-group">
                                    <div class="form-group row m-b-15">
                                        <div class="col-7" style="left:-200px;top:55px;">
                                            <label>Documento</label>
                                        </div>
                                        <div class="col-12" style="position:absolute;left:120px;top:98px;width:90px;"> 
                                            <select class="form-control" id="cond" >
                                                <option selected value="V" id="V">V</option>
                                                <option value="J" id="J">J</option>
                                                <option value="G" id="G">G</option>
                                            </select>  
                                        </div>
                                        <div class="col-12" style="position:absolute;left:185px;top:98px;width:215px;">
                                            <input class="form-control" type="text" id="doc" required=""maxlength="9" placeholder= "Rif" >
                                        </div>
                                    </div>    
                               
                        <!-- INICIO DE DIV DE EMPRESA-->
    
                            <div class="form-group row m-b-15"  >
                                <div class="col-sm-5" style="left:-200px;top:55px;width:280px;">
                                        <label>Razón Social </label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:145px;width:280px;">       
                                    <input class="form-control" type="text" required="" placeholder="Razón Comercial">
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:40px;">
                                        <label>Denominación Comercial</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:190px;width:280px;">       
                                    <input class="form-control" type="text" required="" placeholder="Denominación Comercial">
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:35px;">
                                        <label>Teléfono</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:240px;width:280px;">       
                                    <input class="form-control" type="text" required="" placeholder="Teléfono">
                                </div>
                            </div>   
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:30px;">
                                        <label for="inputHorizontalSuccess">Correo</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:280px;width:280px;">       
                                    <input type="email" class="form-control form-control-success" id="inputHorizontalSuccess" placeholder="name@example.com">
                                                <div class="form-control-feedback"></div>
                                                <small class="form-text text-muted"></small>
                                </div>
                            </div>  

                             <br><br>  
    
                            <div class="form-group">
                                <div class="col-12" style="position:absolute;left:20px;top:320px;width:280px;">
                                       <!-- <div class="custom-control custom-checkbox" >
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label font-weight-normal" for="customCheck1">Acepto <a href="#" class="text-primary">Terminos y Condiciones</a></label>
                                            </div>-->
                                </div>
                            </div>
    
                            <div class="form-group text-center m-t-20">
                                <div class="col-12" style="position:absolute;left:80px;top:330px;width:280px;">
                                    <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Registrar</button>
                                </div>
                            </div>
                            <div class="form-group mb-0 row">
                                    <div class="col-12 m-t-12 text-center">
                                        <a href="pagina-inicio-sesion.php" class="text-muted" style="position:absolute;left:-150px;top:33px;width:280px;">Ya tengo cuenta?</a>
                                    </div>
                                </div>
                            </div>
                </div>

                      
            
                        </form>
                    </div>
    
                </div>
            </div>
        <!-- END wrapper -->
        <footer  class="footer2">
                    © 2020 SIROET<span class="d-none d-sm-inline-block"> - Sistema Desarrollado por la Dirección de Informatica - Análisis y Desarrollo de Sistemas || MPPPST </span>
        </footer>  

        <!-- jQuery  -->
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
    </body>

</html>
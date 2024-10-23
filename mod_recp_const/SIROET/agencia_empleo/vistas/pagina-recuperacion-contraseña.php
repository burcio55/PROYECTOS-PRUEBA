
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
                        <img style="float: left; margin: -20px 100px 200px -350px; object-position: 20%  20%;" src="assets/images/logo_siroet-03.png" width="250" height="200" /> 
                     <h5 class="font-25 text-white" style="float: left; margin: 190px 80px 50px -450px;">"EDUCAR Y TRABAJAR PARA EL FUTURO"</h5>
                     <h5 class="font-25 text-white" style="float: left; margin: 230px 60px 50px -330px;">"MPPPST"</h5>
                        <h5 class="font-18 text-center" style="float: left; margin: 20px 40px 100px 0px;">Recuperar Contraseña</h5>
    
                        <form class="form-horizontal m-t-30" action="index.html">

                               <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible" style="position:absolute;left:10px;top:25px;width:380px;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            ¡Ingrese su Correo Electrónico y el número de contacto para el envio de  las instrucciones!
                                        </div>
                               </div>

                                <div class="form-group" style="position:absolute;left:0px;top:170px;width:400px;" >
                                        <div class="col-12" >
                                                <label>Correo Electronico</label>
                                            <input class="form-control" type="text" required="" placeholder="Correo">
                                        </div>
                                        <div class="col-12">
                                            <label>Número de contacto</label>
                                        <input class="form-control" type="text" required="" placeholder="Telefono">
                                    </div>
                                    </div>
    
                            <div class="form-group text-center m-t-20">
                                <div class="col-12" style="position:absolute;left:0px;top:320px;width:400px;">
                                    <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Enviar Correo</button>
                                </div>
                            </div>
                           
                            </div>
                            <div class="form-group text-center m-t-24">
                                <div class="col-12 m-t-8 text-center" style="position:absolute;left:0px;top:390px;width:400px;">
                                    <a href="pagina-inicio-sesion.php" class="text-muted">Ya tengo cuenta?</a>
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
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
    </body>

</html>
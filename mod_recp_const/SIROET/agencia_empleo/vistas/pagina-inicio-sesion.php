<?php 
    session_start();
    //unset($_SESSION['usuario']);

    ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
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
        <div class="accountbg">
		<!--div <div class="card-body1"> -->
            <div class="card-body"> 
           <img style="float: left; margin: 75px 300px 150px 135px; object-position: 20%  20%;" src="assets/images/logo_siroet-03.png" width="250" height="200" /> 
           <h5 class="font-25 text-white" style="float: left; margin: -170px 600px 30px 30px;">"EDUCAR Y TRABAJAR PARA EL FUTURO"</h5>
           <h5 class="font-25 text-white" style="float: left; margin: -140px 600px 50px 190px;">"MPPPST"</h5>
         
        </div>
		</div>
        <!--div class="home-btn d-none d-sm-block">
                <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a>
		</div>-->
        <div class="wrapper-page">
                <div class="card card-pages shadow-none">
					
    
                    <div class="card-body">
                      <!--  <div class="text-center m-t-0 m-b-15">
                                <a href="index.html" class="logo logo-admin"><img src="assets/images/logo-dark.png" alt="" height="24"></a>
                        </div-->
                      <h5 class="font-18 text-center">SISTEMA SIROET</h5>
    
                        <form class="form-horizontal  m-t-30" method="post">
                            
                         
                             <div class="form-group">
                                    <div class="form-group row m-b-15">
                                        <div class="col-12" style="left:19px;top:22px;">
                                          <label>Documento</label>
                                        </div>
                                        <div class="col-12" style="position:absolute;left:120px;top:98px;width:90px;"> 
                                            <select class="form-control" name="nac" id="nac">
                                                <option selected value="V">V</option>
                                                <option value="E">E</option>
                                                <option value="J">J</option>
												<option value="G">G</option>
                                            </select>  
                                        </div>
                                        <div class="col-12" style="position:absolute;left:185px;top:98px;width:215px;">
                                          <input class="form-control" type="text" required placeholder="Cédula o RIF" id="doc" name="doc">
                                        </div>
                                    </div>    
                               
                            </div>

                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:19px;top:25px;">
                                        <label>Contraseña</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:145px;width:280px;"> 

                                    <input class="form-control" type="password" required placeholder="Contraseña" id="clave"  name="clave">
                                </div>
                            </div>

                            <!-- <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:19px;top:40px;">
                                        <label><img src="captcha/captcha.php"></label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:200px;width:280px;">       
                                    <input class="form-control" type="text" required placeholder="Captcha" name="captcha">
                                   
                                </div>
                            </div>-->
    
                            <div class="form-group">
                                <div class="col-12">
                                    <div class="checkbox checkbox-primary">
                                            <div class="custom-control custom-checkbox" style="top:38px;">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1"> Recordarme</label>
                                                  </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group text-center m-t-20">
                                <div class="col-12" style="top:30px;">
                                 <input type="hidden" name="entrar" value="entrar">
                                    <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" id="pasar" name="pasar" type="button">Entrar</button>
                                </div>
                            </div>
    
                            <div class="form-group row m-t-30 m-b-0">
                                <div class="col-sm-7"style="top:20px;">
                                   <!-- <a href="pagina-recuperacion-contraseña.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Recuperar Contraseña?</a>-->
                                </div>
                                <!--div class="col-sm-5 text-right">
                                    <a href="pages-register.html" class="text-muted">Create an account</a>
                                </div-->
                            </div>
                        </form>
                    </div>
                
            </div>
            <div class="col-sm-5 text-right">
                <a href="pagina-registro.php" class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit" style="position:absolute;left:-180px;top:60px;width:200px;">Registrate</a> </div>
                <div class="col-sm-12" >
                <a href="pagina-recuperacion-contraseña.php" class="btn btn-primary btn-block btn-lg waves-effect waves-light" style="position:absolute;left:100px;top:60px;width:220px;" type="submit">Recuperar Contraseña</a>
                </div>
                 <div class="col-sm-12" >
                <a href="pagina-registro-empresa.php" class="btn btn-primary btn-block btn-lg waves-effect waves-light" style="position:absolute;left:390px;top:60px;width:220px;" type="submit">Registro Empresa</a>
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
 <script type="text/javascript">
$("#pasar").click(function(e) {
    e.preventDefault();
    var nac = $("#nac").val(),
    doc = $("#doc").val(),
    clave = $("#clave").val(),

    //"nombre del parámetro POST":valor (el cual es el objeto guardado en las variables de arriba)
    datos = {"nac":nac, "doc":doc,"clave":clave};
    $.ajax({
        url: "controller_login.php",
        type: "POST",
        data: datos,
		dataType: 'json',
    }).done(function( data, textStatus, jqXHR ) {
     if ( console && console.log ) {
         //console.log( data );
		 if(data.datos==='ENTRO'){
			 window.location.href = 'index-vista.php';
		 }else{
			// window.location.href = ' pagina-error404.html?mensaje=Tus nombre de usuario o clave son incorrectos';
		 }
		 
		 
     }
 })
    
});
</script>


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

     <style type="text/css">
     #pswd_info {
    background: #dfdfdf none repeat scroll 0 0;
    color: #fff;
    left: 420px;
    position: absolute;
    top: 250px;
}
#pswd_info h4{
    background: #6495ED none repeat scroll 0 0;
    display: block;
    font-size: 10px;
    letter-spacing: 0;
    padding: 17px 0;
    text-align: center;
    text-transform: uppercase;
}
#pswd_info ul {
    list-style: outside none none;
}
#pswd_info ul li {
   padding: 10px 45px;
}



.valid {
    background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/vq43s2wib/valid.png") no-repeat scroll 2px 6px;
    color: green;
    line-height: 21px;
    padding-left: 22px;
}

.invalid {
    background: rgba(0, 0, 0, 0) url("https://s19.postimg.org/olmaj1p8z/invalid.png") no-repeat scroll 2px 6px;
    color: red;
    line-height: 21px;
    padding-left: 22px;
}


#pswd_info::before {
    background: #dfdfdf none repeat scroll 0 0;
    content: "";
    height: 25px;
    left: -13px;
    margin-top: -12.5px;
    position: absolute;
    top: 50%;
    transform: rotate(45deg);
    width: 25px;
}
#pswd_info {
    display:none;
}

     </style>

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
                     <h5 class="font-25 text-white" style="float: left; margin:-200px 300px 50px -450px;">"EDUCAR Y TRABAJAR PARA EL FUTURO"</h5>
                     <h5 class="font-25 text-white" style="float: left; margin: -160px 700px 70px -300px;">"MPPPST"</h5>
                 
                     <h5 class="font-18 text-center" style="float: left; margin: -370px 400px 100px 150px;"> REGISTRO</h5>
    
                        <form class="form-horizontal m-t-30" method="POST">


                            <div class="form-group">
                                    <div class="form-group row m-b-15">
                                        <div class="col-7" style="left:-200px;top:55px;">
                                            <label>Documento</label>
                                        </div>
                                        <div class="col-12" style="position:absolute;left:120px;top:98px;width:90px;"> 
                                            <select  name="nac" id="nac"class="form-control">
                                                <option selected value="V">V</option>
                                                <option value="E">E</option>
                                            </select>  
                                        </div>
                                        <div class="col-12" style="position:absolute;left:185px;top:98px;width:215px;">
                                            <input class="form-control" type="text" required="" placeholder="Cédula"  name="doc" id="doc"data-mask="00.000.000">
                                        </div>
                                    </div>    
                               
                            </div>

                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:55px;">
                                        <label>Nombres</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:145px;width:280px;">       
                                    <input class="form-control" name="nombres" id="nombres" type="text" required="" placeholder="Nombres">
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:60px;">
                                        <label>Apellidos</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:190px;width:280px;">       
                                    <input class="form-control" type="text" required="" name="apellidos" id="apellidos" placeholder="Apellidos">
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:60px;">
                                        <label>Sexo</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:232px;width:280px;"> 
                                            <select  name="sexo" id="sexo" class="form-control">
                                                <option selected value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>  
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:60px;">
                                        <label>Nacimiento</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:106px;top:275px;width:365px;"> 
                                            <div class="col-sm-10">
                                                <input class="form-control" type="date"  name="nacimiento" id="nacimiento" value="2011-08-19" id="example-date-input" >
                                            </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:60px;">
                                        <label>Teléfono</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:318px;width:280px;">       
                                    <input class="form-control" type="text" required="" name="telefono" id="telefono" placeholder="Teléfono" data-mask="0000-000-00-00">
                                </div>
                            </div>   
                            <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:60px;">
                                        <label for="inputHorizontalSuccess">Correo</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:360px;width:280px;">       
                                    <input type="email"  name="correo" id="correo"class="form-control form-control-success"  placeholder="name@example.com" required="">
                                                <div class="form-control-feedback"></div>
                                                <small class="form-text text-muted"></small>
                                </div>
                            </div>  

                              <div class="form-group row m-b-15">
                                <div class="col-sm-5" style="left:-200px;top:60px;">
                                        <label >Contraseña</label>
                                </div> 
                                <div class="col-12" style="position:absolute;left:120px;top:400px;width:280px;">       
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                                </div>
                                </div>
                            
                <div class="col-18">
            <div class="aro-pswd_info">
                <div id="pswd_info">
                    <h4>Requerimientos para la contraseña</h4>
                    <ul>
                        <li id="letter" class="invalid">Al menos <strong>una letra</strong></li>
                        <li id="capital" class="invalid">Al menos  <strong>una letra mayuscula</strong></li>
                        <li id="number" class="invalid">Al menos <strong>un  número</strong></li>
                        <li id="length" class="invalid">El minimo permitido es de: <strong> 8 caracteres</strong></li>
                        <li id="space" class="invalid">Puedes<strong> usar [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>
                    </ul>
                </div>
                 </div>
                    </div>

                             <br><br>  
    
    
                            <div class="form-group text-center m-t-20">
                                <div class="col-12">
                                   <!-- <input type="hidden" name="registrarse" value="registrarse">-->
                                    <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit" name="registrarse" id="registrarse">Registrar</button>
                                </div>
                            </div>
    
                            <div class="form-group mb-0 row">
                                    <div class="col-12 m-t-10 text-center">
                                        <a href="pagina-inicio-sesion.php" class="text-muted">Ya tengo cuenta?</a>
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
       <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>
        <!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <!-- Queyy para enmascarar los inputs --> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        


        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
    </body>

</html>

<script type="text/javascript">

    $(document).ready(function(){
    
    $('input[type=password]').keyup(function() {
        var password = $(this).val();
        
        //validate the length
        if ( password.length < 8 ) {
            $('#length').removeClass('valid').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid');
        }
        
        //validate letter
        if ( password.match(/[A-z]/) ) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
        }

        //validate capital letter
        if ( password.match(/[A-Z]/) ) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
        }

        //validate number
        if ( password.match(/\d/) ) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
        }
        
        //validate space
        if ( password.match(/[^a-zA-Z0-9\-\/]/) ) {
            $('#space').removeClass('invalid').addClass('valid');
        } else {
            $('#space').removeClass('valid').addClass('invalid');
        }
        
    }).focus(function() {
        $('#pswd_info').show();
    }).blur(function() {
        $('#pswd_info').hide();
    });
    
});
</script>
    <script type="text/javascript">

$("#registrarse").click(function(e) {
    e.preventDefault();
    var nac = $("#nac").val(),
    doc = $("#doc").val(),
    nombres = $("#nombres").val(),
    apellidos = $("#apellidos").val(),
    sexo = $("#sexo").val(),
    nacimiento = $("#nacimiento").val(),
    telefono = $("#telefono").val(),
    mail = $('input[type=email]').val();
    password = $('input[type=password]').val();

    
    //"nombre del parámetro POST":valor (el cual es el objeto guardado en las variables de arriba)
    datos = {"nac":nac, "doc":doc,"nombres":nombres, "apellidos":apellidos,"sexo":sexo,"nacimiento":nacimiento,"telefono":telefono,"correo":correo, "password":password};
      console.log(datos);
    $.ajax({
        url: "controller_registro.php",
        type: "POST",
        dataType: 'json',
        data: datos
    }).done(function(respuesta){
        if (respuesta.estado === "ok") {
             $('#nac').text(respuesta.nac);
             $('#doc').text(respuesta.doc);
             $('#nombres').text(respuesta.nombres);
             $('#apellidos').text(respuesta.apellidos);
             $('#sexo').text(respuesta.sexo);
             $('#nacimiento').text(respuesta.nacimiento);
             $('#telefono').text(respuesta.telefono);
             $('#correo').text(respuesta.correo);
             $('#password').text(respuesta.password);
        }
        
    });
});
</script>

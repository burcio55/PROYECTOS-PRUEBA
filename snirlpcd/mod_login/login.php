<?php
session_start(); //- Iniciar una nueva sesión o reanudar la existente
//var_dump($_SESSION);
//var_dump($_SESSION["condition_question_2"][1]);
include_once('modal.php');

// Validación del reCAPTCHA

if (isset($_POST['submit'])) {

    $ip = $_SERVER['REMOTE_ADDR'];

    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = "6LdCiuMmAAAAAGYqnMY4fn3ohOE1KKEbusZqk7lH";

    $resp_captcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

    $atributos = json_decode($resp_captcha, TRUE);

    if (!$atributos['success']) {
?>
        <script>
            alert("Verificar captcha");
        </script>
<?php
    }
}

?>

<!doctype html>
<html lang="Es-es">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SNIRLPCD</title>
    <!-- Bootstrap CSS  v5.1 CDN    -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->

    <!-- Bootstrap CSS  v5.1.3
        Maquetado de Header y el Menu con las opciones
        LIBRERIA COMPLETA Y LOS JS-->
    <link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font/fontello.css">
    <link rel="stylesheet" href="fontello/css/fontello.css">
    <link rel="stylesheet" href="../css/fontelo.css">
    <!-- Bootstrap CSS  v5.1.3
        Maquetado de Header y el Menu con las opciones
        https://getbootstrap.com/docs/5.1/getting-started/introduction/
    -->
    <!--<link rel="stylesheet" href="../css/bootstrap.css">-->
    <!-- Indispensable Maquetado del Login y el efecto de transición-->
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/todo-login2.css">
    <!-- trabaja con main.js CSS -->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">




    <!--<link rel="stylesheet" href="../css/estilos.css">-->

    <!--<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
    <link href="../css/login.css" rel="stylesheet" type="text/css" />
    <link href="../css/font/fontello.css" rel="stylesheet" type="text/css" />
    
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/validacion_general.js"></script>	
    <script type="text/javascript" src="validar_login.js"></script>	
    <script type="text/javascript" src="funciones.js"></script>	
    <script type="text/javascript" src="base64.js"></script>-->
</head>

<body>

    <header>
        <?php
        //require_once('shuffle.php');
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-color bg-color-white">
            <div class="container-fluid ">
                <div class="logo" style="margin-left: 3%">
                    <img tabindex="1" alt="Gobierno bolivariano de Venezuela Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width:100%;" src="../imagenes/cintillo_institucional.jpg">
                </div>
                <div class="collapse navbar-collapse" id="navbarColor02" style="margin-left:30%">
                    <div>
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item mglr-20" style="margin-right: 20px">
                                <a tabindex="2" class="nav-link active" style="color: black; font-size: 17px;" href="../index.php">Inicio</a>
                            </li>
                            <li class="nav-item" style="margin-right: 20px">
                                <a tabindex="3" style="color: black; font-size: 16px" class="nav-link" href="../nosotros.php">Nosotros</a>
                            </li>
                            <!--<li class="nav-item">
                            <a href="login.php">
                                <button type="button" class="btn btn-outline-primary">Iniciar Sesión</button>
                        </a>-->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div id="alerta" class="alerta">
        <h4 id="titulo"></h4>
        <p id="texto"></p>
        <center><input type="button" id='btncerrar' name='btncerrar' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: center; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="cerrar_alert()" data-bs-toggle="tooltip" value="Cerrar"></center>
    </div>
    <input type="text" id="link" value="" style="display: none;">
    <script>
        function cerrar_alert(){
            document.getElementById("alerta").style.display = "none";
            let link = document.getElementById("link").value;
            if(link != ""){
                document.getElementById("link").value = "";
                $(location).attr('href',link);
            }
        }
    </script>
    <main>
        <div class="contenedor_todo">
            <div class="caja_trasera">
                <div class="caja_trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia Sesión para Entrar en el Sistema</p>
                    <button id="btn_iniciar-sesion" style="font-size: 16px; background-color: #fff; color: #46A2FD; font-weight: bold;" onmouseover='this.style.color="#fff"; this.style.backgroundColor="#46A2FD";' onmouseout='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>Iniciar Sesión</button>
                </div>
                <div class="caja_trasera-register">
                    <h3 tabindex="14">¿Aún no Tienes una Cuenta?</h3>
                    <p tabindex="15">Regístrate para que Puedas Iniciar Sesión</p>
                    <button tabindex="16" id="btn_registrarse" style="font-size: 16px; background-color: #fff; color: #46A2FD; font-weight: bold;" onmouseover='this.style.color="#fff"; this.style.backgroundColor="rgba(0, 128, 255, 0.5)";' onmouseout='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>Registrarse</button>
                </div>
            </div>
            <!--Formulario de Login y registro  row g-3 was-validated  needs-validation" novalidate -->
            <div class="contenedor_login-register">

                <!--Login-->
                <form id="frm" name="frm" action="" method="POST" class="formulario_login needs-validation">
                    <center>
                        <img tabindex="4" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2 tabindex="5">Iniciar Sesión</h2>
                    <center><label style="color: #BF1F13; font-size: 15px"> Datos Obligatorios (*) </label><br></center>
                    <div class="input-group" style="margin-bottom: 30px">
                        <select tabindex="6" aria-label="Es obligatorio indicar su nacionalidad" style="width: 15%" data-bs-toggle="tooltip" data-bs-placement="left" title="Nacionalidad" id="cbCed_afiliado" name="cbCed_afiliado" required>
                            <option value="">***</option>
                            <option value="V">V </option>
                            <option value="E">E </option>
                        </select>
                        <!-- 
                            Intento de Añadir ↓ en el Select

                            <span class="dir-domm">
                                <img src="../imagenes/Flecha Abajo 1.png" alt="">
                            </span>
                        -->
                        <span><i class="" style="padding:5px; color: gray"></i></span>
                        <input tabindex="7" aria-label="Es obligatorio indicar su cédula de Indentidad" class="form-control" type="text" style="width: 75%;" placeholder="Cédula de Identidad *" id="txt_usuario" name="txt_usuario" value="" required>
                    </div>


                    <!--<span><i class="icon-cedula" style="padding:5px; color: gray"></i></span><input type="number" style="width: 71.5%;" id="txt_usuario" name="txt_usuario" placeholder="Cédula de Identidad *" maxlength="10"-->
                    <!--<input type="password" placeholder="Contraseña *" name="txt_clave">-->
                    <!--<div class="input-group">
                        <samp style="font-size: 15px;" class="icon-cerradura"></samp>
                        <input class="form-control" type="password" placeholder="Contraseña *" id="txt_clave" name="txt_clave" value="" required>
                    </div>-->
                    <div style="margin-top: 20px;">
                        <input tabindex="8" aria-label="Es obligatorio indicar su contraseña en caso de que se halla registrado" class="form-control" type="password" style="width: 90%; margin: -10px 0 0 0; position:relative;" placeholder="Contraseña *" id="txt_clave" name="txt_clave" value="" required>
                        <i tabindex="9" aria-label="boton para ocultar y mostrar contraseña" class="bx icon-eye-2" id="ojo" onclick="javascript: icon();" style="font-size: 30px; cursor: pointer; margin-top: -38px; margin-bottom: 12px; margin-left: 90%; display: flex; position: relative;"></i>
                    </div>
                    <!-- reCAPTCHA 
                    <center>
                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="6LdCiuMmAAAAAB4yYqFXUzrsbKDs6x-EyYHMi7Az" style="margin-top: 30px; margin-bottom: -10px" name="captcha"></div>
                        </div>
                    </center>-->
                    <?php

                    $permitididos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $codigo = substr(str_shuffle($permitididos), 0, 6);

                    ?>
                    <div class="input-group" style="margin-top: 10px;">
                        <div class="col-sm-6">
                            <input tabindex="10" aria-label=" El recapcha es el siguiente <?php echo $codigo; ?>" class="form-control" type="text" style="width: 96%; height: 45px; border-radius: 30px 0 0 30px" id="txt_codigo" name="txt_codigo" value="<?php echo $codigo; ?>" readonly>
                        </div>
                        <div class="col-sm-6">
                            <input tabindex="11" aria-label="Es obligario copiar el recapcha tal cual lo escucho" class="form-control" type="text" style="width: 96%; height: 45px; border-radius: 0 30px 30px 0" placeholder="Introducir Código" id="txt_codigo2" name="txt_codigo2" value="" maxlength="6" onkeypress="mayus(this);" required>
                        </div>
                    </div>
                    <!--<a href="../usuario/index.php"><button type='button' class='btn_Entrar'>Entrar</button></a>-->
                    <div class="input-group">
                        <button tabindex="12" type='button' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onclick="ingresar(cbCed_afiliado.value,txt_usuario.value,txt_clave.value,txt_codigo.value,txt_codigo2.value)">Entrar</button>
                        <span><i class="icon-cedula" style="padding:5px; color: gray"></i></span>
                        <input tabindex="13" aria-label="olvidó contraseña" type="button" style="width: 63%; font-size: 16px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; font-weight: bold;" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' id="btn_olvido_clave" value="¿Olvidó Contraseña?">
                    </div>
                </form>

                <!--olvidó Contreaseña-->
                <form id="frm_olvido" name="frm_olvido" action="" method="POST" class="formulario_clave needs-validation novalidate">
                    <center>
                        <img tabindex="29" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2 tabindex="30">¿Olvidó Contraseña?</h2>
                    <center><label style="color: #BF1F13; font-size: 15px"> Datos Obligatorios (*) </label><br></center>

                    <div class="input-group">
                        <select tabindex="31" alt="es obligatorio llenar su nacionalidad" style="width: 20%;" name="nacionalidad" id="nacionalidad" data-bs-toggle="tooltip" data-bs-placement="left" title="Nacionalidad" required>
                            <option value="">***</option>
                            <option value="V">V</option>
                            <option value="E">E</option>
                        </select>
                        <span><i class="" style="padding:5px; color: gray"></i></span>
                        <input tabindex="32" alt="es obligatorio indicar su cédula de identidad" type="text" style="width: 45%;" class="form-control" placeholder="Cédula de Identidad" name="ced_afiliado" id="ced_afiliado" maxlength="11" required pattern="[0-9]{7,11}" data-bs-toggle="tooltip" data-bs-placement="right" title="Cédula">
                        <!--<button type="button" class="btn btn_consultar_saime2 btn-secondary float-right" data-bs-toggle="tooltip" data-bs-placement="right" title="Buscar">B</button-->
                    </div>
                    <!--input type="text" class="form-control" name="nombre" id="nombre" style="width:100%" required placeholder="Nombre" disabled>
                    <input type="text" class="form-control" name="apellido" id="apellido" style="width:100%" required placeholder="Apellido" disabled  id="btn_validacion"-->
                    <input tabindex="33" type="button" onclick="olvido(nacionalidad.value,ced_afiliado.value)" class="btn_siguiente1" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' value="Validar" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Validar Cuenta" class="btn-outline-p">
                </form>

                <!--<<<<<<<<<<<<<<<<<<<<<<<<VALIDAR PREGUNTAS>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
                <form id="frm_olvido2" name="frm_olvido2" action="" method="POST" class="formulario_validacion needs-validation">
                    <center>
                        <img tabindex="34" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2>¿Olvidó Contraseña?</h2><br>
                    <h6 tabindex="35" id="nombress" style="color: grey;"><!-- Nombre(s): --></h6>
                    <h6 tabindex="36" id="apellidoss" style="color: grey;"><!-- Apellido(s): --></h6>
                    <h6 tabindex="37" style="color: grey; text-align: justify">Para continuar con el proceso de "Olvidó Contraseña", por favor responda las siguientes preguntas:</h6>
                    <h6 tabindex="38" id="Pregunta1" style="color: grey; margin-top: 25px"></h6>
                    <div class="form-check">
                        <input tabindex="39" alt="En caso de que la respuesta sea Si" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault1" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            SI
                        </label>
                    </div>
                    <div class="form-check">
                        <input tabindex="40" alt="En caso de que la respuesta sea No" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault1" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            NO
                        </label>
                    </div>
                    <h6 tabindex="41" id="Pregunta2" style="color: grey; margin-top: 25px"></h6>
                    <div class="form-check2">
                        <input tabindex="42" alt="En caso de que la respuesta sea Si" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault2" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault1">
                            SI
                        </label>
                    </div>
                    <div class="form-check2">
                        <input tabindex="43" alt="En caso de que la respuesta sea No" class="form-check-input" type="radio" style="width: 20px; border: 1px solid black" name="flexRadioDefault2" id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault2">
                            NO
                        </label>
                    </div>

                    <!--<br><h6 style="color: grey;">INDIQUE SU FECHA DE NACIMIENTO:</h6>
                    <div style="width: 50%;margin: 0 80px">
                        <input type="radio" id="radioPrimary13" style="width: 10%;" onclick="javascript:seleccion()" name="r7">
                        <span class="text-secondary">SI</span>
                    </div>
                    <div style="width: 50%;margin: -33px 0px 0 190px; position:relative;">
                        <input type="radio" id="radioPrimary14" style="width: 10%;" onclick="javascript:deselecion()" name="r7">
                        <span class="text-secondary">NO</span>
                    </div-->

                    <? //echo $array1[0]."<br>"; 
                    ?>
                    <? //echo $array1[1]."<br>"; 
                    ?>
                    <input tabindex="44" type="button" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onclick="validar()" id="btn_iniciar" value="Siguiente">
                    <!--btn_iniciar = valor de un atributo que es usado en js/main el cual alista un evento y llama a la funcion iniciar
                        para mostrar y ocultar formularios-->
                    <!--button id="btn_iniciar-sesion">Siguiente</button-->
                </form>

                <!--Register-->
                <!-- El Archivo "Enviar.php" se encarga de enviar los datos al correo del usuario -->
                <form id="frmRegistro" name="frmRegistro" action="enviar.php" method="POST" class="formulario_register needs-validation">
                    <center>
                        <img tabindex="15" alt="logo del Ministerio del Poder Popular para el Proceso Social de Trabajo" style="width: 30%; margin: -10px 0 10px 0" src="../imagenes/logo.png">
                    </center>
                    <h2>Registrarse</h2>
                    <center>
                        <label style="color: #BF1F13; font-size: 15px"> Datos Obligatorios (*) </label><br>
                        <div class="input-group">
                            <select tabindex="15" aria-label="Es obligatorio indicar su nacionalidad" style="width: 20%" name="nacionalidad" id="nacionalidad" data-bs-toggle="tooltip" data-bs-placement="left" title="Nacionalidad" required>
                                <option value="">***</option>
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                            <span><i class="" style="padding:5px; color: gray"></i></span>
                            <input tabindex="16" aria-label="Es obligatorio indicar su Cédula de Identidad" type="text" style="width: 20%; max-width: 200px" class="form-control" placeholder="Cédula de Identidad" name="ced_afiliado" id="ced_afiliado" maxlength="11" required pattern="[0-9]{6,11}">
                            <span style="width: 10px; background-color: #fff"></span>
                            <button tabindex="17" type="button" class="btn btn-secondary float-right btn-outline-p" data-bs-toggle="tooltip" data-bs-placement="right" onclick="buscar(nacionalidad.value,ced_afiliado.value);" title="Buscar" style="font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff" onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"'>Buscar</button>
                        </div>

                        <div class="input-group" style="margin-top: -10px">
                            <input tabindex="18" style="width:40%;margin-bottom:-10px;" type="text" class="form-control" placeholder="Primer Nombre *" name="nombre_afiliado1" id="nombre_afiliado1" maxlength="15" required pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                            <span><i class="" style="padding:5px; color: gray"></i></span>
                            <input tabindex="19" style="width:40%;margin-bottom:-10px;" type="text" class="form-control" placeholder="Segundo Nombre" name="nombre_afiliado2" id="nombre_afiliado2" maxlength="15" pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                        </div>
                        <!--
                        <select style="width: 20%;" name="cbCed_afiliado">
						    <option value="">*</option>
						    <option value="V">V-.</option>
						    <option value="E">E.-</option>
                        </select>
                        <span><i class="icon-cedula" style="padding:5px; color: gray"></i></span><input type="number" style="width: 70%;" placeholder="Cédula de Identidad*" name="ced_afiliado" min="3000000" max="50000000">
                        <span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:40%;margin-bottom:-10px;" type="text" placeholder="Primer Nombre*" name="name">
                        <span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:42.5%;margin-bottom:-10px;" type="text" placeholder="Segundo Nombre" name="name2">-->

                    </center>
                    <center>
                        <!--<span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:40%;margin-bottom:-10px;" type="text" placeholder="Primer Apellido*" name="name3">
                    <span><i class="icon-at" style="padding:5px; color: gray"></i></span><input style="width:42.5%;margin-bottom:-10px;" type="text" placeholder="Segundo Apellido" name="name4"-->
                        <div class="input-group">
                            <input tabindex="20" style="width:40%;margin-bottom:-10px;" class="form-control" type="text" placeholder="Primer Apellido *" name="apellido_afiliado1" id="apellido_afiliado1" maxlength="15" required pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                            <span><i class="" style="padding:5px; color: gray"></i></span>
                            <input tabindex="21" style="width:40%;margin-bottom:-10px;" class="form-control" type="text" placeholder="Segundo Apellido" name="apellido_afiliado2" id="apellido_afiliado2" maxlength="15" pattern="[A-Za-zÑ-ñÁ-Éó-úÍ ]{3,15}">
                        </div>
                    </center>
                    <!--<label>Sexo *:</label-->
                    <select tabindex="22" name="cbSexo_afiliado" id="cbSexo_afiliado" style="width: 48.75%; height: 45px; display: inline; border-top-right-radius: 0; border-bottom-right-radius: 0; margin-right: 4px" required>
                        <option value="0" selected="selected">Sexo *</option>
                        <option value="1">Femenino</option>
                        <option value="2">Masculino</option>
                    </select>
                    <!--<label> Fecha de Nacimiento *: </label><br-->
                    <input tabindex="23" alt="Es obligatorio indicar su fecha de nacimineto" type="DATE" style="text-align: center; color: rgb(104, 103, 103); width: 48.75%; height: 45px; display: inline; border-top-left-radius: 0; border-bottom-left-radius: 0" class="form-control" data-bs-toggle="tooltip" data-bs-placement="left" title="Fecha de Nacimiento" name="fnacimiento_afiliado" id="fnacimiento_afiliado" required>
                    <!--<input type="DATE" style="color: gray;">
                    <label style="color: grey;"> Fecha de Nacimiento: </label><br>
                    <input style="text-align: center; color: rgb(104, 103, 103); width: 90%" type="date" name="fnacimiento_afiliado" min="1" max="31"><span><i class="icon-calendario" style="padding:5px; color: gray"></i></span-->
                    <input tabindex="24" alt="Es obligatorio indicar su número telefónico" type="text" class="form-control" name="telefono_afiliado" id="telefono_afiliado" data-bs-toggle="tooltip" data-bs-placement="left" title="Teléfono Personal" placeholder="04143778578 *" maxlength="11" style="margin: 5px 0; width: 48.75%; height: 45px; display: inline; border-top-right-radius: 0; border-bottom-right-radius: 0; margin-right: 4px" required pattern="[0-9]{11,11}" />
                    <input tabindex="25" alt="Es opcional indicar un número telefónico secundario" type="text" class="form-control" name="telefono_afiliado2" id="telefono_afiliado2" data-bs-toggle="tooltip" data-bs-placement="left" title="Teléfono Secundario" placeholder="02128586620" maxlength="11" style="margin: 5px 0; text-align: center; color: rgb(104, 103, 103); width: 48.75%; height: 45px; display: inline; border-top-left-radius: 0; border-bottom-left-radius: 0" pattern="[0-9]{11,11}" />
                    <input tabindex="26" alt="Es obligatorio indicar correo electrónico" type="email" class="form-control" data-bs-toggle="tooltip" data-bs-placement="left" title="Correo Electrónico" placeholder="Correo. Ejm: xxx@gmail.com *" name="email_afiliado" id="email_afiliado" style="margin: 0 0 5px 0" required>
                    <input tabindex="27" alt="debe repetir el correo electrónico" type="email" class="form-control" data-bs-toggle="tooltip" data-bs-placement="left" title="Confirmar Correo Electrónico" placeholder="Verificar Correo. Ejm: xxx@gmail.com *" name="email_afiliado_V" id="email_afiliado_V" style="margin: 5px 0" required>
                    <input tabindex="28" type="button" value="Registrarse" class="btn btn-outline-primary btn_registrar" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="registrar(nacionalidad.value,ced_afiliado.value,nombre_afiliado1.value,nombre_afiliado2.value,apellido_afiliado1.value,apellido_afiliado2.value,cbSexo_afiliado.value,fnacimiento_afiliado.value,telefono_afiliado.value,telefono_afiliado2.value,email_afiliado.value,email_afiliado_V.value)" data-bs-toggle="tooltip" data-bs-placement="right" title="Registrar Usuario">
                    <!-- <button type='button' class="btn btn-outline-primary btn_registrar" style="width: 100%; font-size: 16px; background-color: #46A2FD; border: 1px Solid #46A2FD; color: #fff; font-weight: bold;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' onclick="registrar(nacionalidad.value,ced_afiliado.value,nombre_afiliado1.value,nombre_afiliado2.value,apellido_afiliado1.value,apellido_afiliado2.value,cbSexo_afiliado.value,fnacimiento_afiliado.value,telefono_afiliado.value,email_afiliado.value,email_afiliado2.value)" data-bs-toggle="tooltip" data-bs-placement="right" title="Registrar Usuario" class="btn-outline-p">Registrarse</button> -->
                    <!--<a href="../usuario/index.php"><button type='button' class='btn_registrar' title="Guardar Registro -  Haga Click para Guardar la Informaci&oacute;n">Registrarse</button></a-->
                </form>
            </div>
        </div>
    </main>
    <br><br><br><br><br>
    <footer>
        <!--div class="pub-1">
			<center>
				<h3><b>Logo empleado</b></h3>
				<img src="favicon/favicon.png"><br>
				<a href="https://www.freepik.es/vectores/logo">Vector de Logo creado por freepik - www.freepik.es</a>
			</center>
		</div>
		<div class="line"></div-->
        <br>
        <!-- <div class="pub-2" style="float: left; margin: -15px 0 0 0">
            <center>
                <div class="circle">
					<span class="icon-user"></span>
				</div>
                <div class="cent">
                    <h3 style="font-size: 20px; color: white; margin: 15px 0 0 0">
                        Despacho del Viceministro o Viceministra de Previsión Social.<br>
                    </h3>
                </div>
            </center>
        </div> -->
        <div class="pub-2" style="margin: -98px auto 0 auto">
            <center>
                <!--div class="circle">
					<span class="icon-user"></span>
				</div-->
                <div class="cent"><br><br><br>
                    <h5 tabindex="45" style="color: white; font-size: 15px"> Ministerio del Poder Popular para el Proceso Social del Trabajo <br> Oficina de Tecnología de la Información y la Comunicación (OTIC). <br> División de Análisis y Desarrollo de Sistemas. <br> © 2023 Todos los Derechos Reservados.</h5>
                </div>
            </center>
        </div>
        <!--div class="sepa"></div>
		<div class="pub-3">
			<center>
				<div class="circle">
					<span class="icon-user"></span>
				</div>
				<h3><b>Carlos Aguiar</b></h3>
				<div class="cent">
					<a href="https://www.facebook.com"> Facebook </a><br>
					<a href="https://www.gmail.com"> Gmail </a><br>
					<a href="https://www.instagram.com"> Instagram </a><br>
					<a href="https://www.twitter.com"> Twttier </a>
				</div>
			</center>
		</div>
		<div class="sepa"></div>
		<div class="pub-4">
			<center>
				<div class="circle">
					<span class="icon-user"></span>
				</div>
				<h3><b>Roberto Contreras</b></h3>
				<div class="cent">
					<a href="https://www.facebook.com"> Facebook </a><br>
					<a href="https://www.gmail.com"> Gmail </a><br>
					<a href="https://www.instagram.com"> Instagram </a><br>
					<a href="https://www.twitter.com"> Twttier </a>
				</div>
			</center>
		</div-->
    </footer>
    <!-- Script's -->
    <!-- CDN -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->

    <script type="text/javascript" src="../css/bootstrap5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../css/bootstrap5.1.3/js/popper.min.js"></script>
    <!-- popper es indispensable para el manejo de los Tooltips Editados con bootstrap.bundle -->

    <!--<script type="text/javascript" src="../css/bootstrap5.1.3/js/bootstrap.js"></script> -->


    <!-- //Libreria principal jquery-3.6.0-->
    <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
    <!--<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>-->

    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript" src="js/bloq.js"></script>
    <script type="text/javascript" src="js/olvido_pass.js"></script>
    <script type="text/javascript" src="js/pass-eje.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script src="js/main.js"></script>
    <!--<script src="js/pass-eje.js"></script>-->
</body>

</html>
<?php

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
    $echo = ("Se conectó la Base de Datos ");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['cedula'])) {

    $cedula = substr($_SESSION["cedula"], 1);

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $cedula . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);

    $persona_id = $persona["id"];

    /* $nombre_arc = $persona["id"];
    $nombre_arc .= $persona["sprimer_nombre"];
    $nombre_arc .= $persona["sprimer_apellido"];
    $nombre_arc .= $cedula;
    $nombre_arc .= rand(1, 10000000);

    $nombre_arc_new = str_replace(" ", "_", $nombre_arc); */


    $sql = ("SELECT * FROM snirlpcd.persona_fotos WHERE persona_id = '" . $persona_id . "';");
    $row2 = pg_query($conn, $sql);
    if ($persona2 = pg_fetch_assoc($row2)) {
        $user = 1;
    }/*  else {
        echo '
            <script>
                alert ("Error, ha ocurrido algo inesperado, intente más tarde");
                window.location="foto.php";
            </script>
        ';
    } */

    $factual = date("d-m-Y h:i:s");

    $sql2 = "DELETE";
    $sql2 .= " FROM";
    $sql2 .= " snirlpcd.persona_fotos";
    $sql2 .= " WHERE";
    $sql2 .= " persona_id=";
    $sql2 .= " '$persona_id'";
    $resultado = pg_query($conn, $sql2);

    $PG = ("SELECT * FROM snirlpcd.persona_foto_empresa WHERE persona_id = '" . $persona_id . "';");
    $row3 = pg_query($conn, $PG);
    if ($persona2 = pg_fetch_assoc($row3)) {
        $user = 1;
    }/*  else {
        echo '
            <script>
                alert ("Error, ha ocurrido algo inesperado, intente más tarde");
                window.location="foto.php";
            </script>
        ';
    } */

    $PG2 = "DELETE";
    $PG2 .= " FROM";
    $PG2 .= " snirlpcd.persona_foto_empresa";
    $PG2 .= " WHERE";
    $PG2 .= " persona_id=";
    $PG2 .= " '$persona_id'";
    $resultado = pg_query($conn, $PG2);

    /* echo $sql2;
    die(); */
}

if ($_FILES["archivo_img"]) {
    $name_arc = basename($_FILES["archivo_img"]["name"]);
    $name_final = date("d-m-y") . "-" . date("H-i-s") . "-" . $name_arc;
    $ruta = "../imagenes/fotos/" . $name_final;
    $ruta2 = "../../../snirlpcd/imagenes/fotos/" . $name_final;
    $tipo = $_FILES["archivo_img"]["type"];
    $limite_kb = 2000;

    $subirarchivo = move_uploaded_file($_FILES["archivo_img"]["tmp_name"], $ruta);

    if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
        echo '
            <script>
                document.getElementById("texto").innerText = ("Error, el archivo no es una imagen o no tiene un formato permitido");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
                document.getElementById("link").value = "foto.php";
            </script>
        ';
    } else
    if ($_FILES["archivo_img"]["size"] >= $limite_kb * 1024) {
        echo '
            <script>
                document.getElementById("texto").innerText = ("Error, el archivo es superior al máximo peso permitido");
                document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
                document.getElementById("link").value = "foto.php";
            </script>
        ';
        die();
    } else
    if ($subirarchivo) {
        // Insertar imagen en la Base de Datos
        /* echo "Entra en la sentencia SQL";
        die(); */
        $query = "INSERT INTO";
        $query .= " snirlpcd.persona_fotos";
        $query .= " (";
        $query .= " persona_id,";
        $query .= " nombre_foto,";
        $query .= " usuario_creacion";
        $query .= " )";
        $query .= " VALUES";
        $query .= " (";
        $query .= " '$persona_id',";
        $query .= " '$ruta',";
        $query .= " '$persona_id'";
        $query .= " )";
        if ($resultado = pg_query($conn, $query)) {
            $query2 = "INSERT INTO";
            $query2 .= " snirlpcd.persona_foto_empresa";
            $query2 .= " (";
            $query2 .= " persona_id,";
            $query2 .= " nombre_foto,";
            $query2 .= " nusuario_creacion";
            $query2 .= " )";
            $query2 .= " VALUES";
            $query2 .= " (";
            $query2 .= " '$persona_id',";
            $query2 .= " '$ruta2',";
            $query2 .= " '$persona_id'";
            $query2 .= " )";
            $resultado2 = pg_query($conn, $query2);
            echo '
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        <title>SNIRLPCD </title>
                        <!--<link rel="stylesheet" href="../css/bootstrap5.1.3/css/bootstrap.min.css">-->
                        <!--<link rel="stylesheet" href="../css/bootstrap.css">-->
                        <link rel="stylesheet" href="../css/bootstrap.min.css">
                        <link rel="stylesheet" href="../css/bootstrap.css">
                        <!-- Indispensable Maquetado del Login y el efecto de transición-->
                        <link rel="stylesheet" href="../css/inicio.css">
                        <link rel="stylesheet" href="../css/footer.css">
                        <link rel="stylesheet" href="../css/font/fontello.css">
                        <link rel="stylesheet" href="../css/fontelo.css">
                        <link rel="stylesheet" href="fontello/css/fontello.css">
                        <!--<link rel="stylesheet" href="../css/nuevo.css">-->
                        <link rel="stylesheet" href="../css/font/fontello.css">
                        <link href="../css/p.css" rel=stylesheet>
                        <link href=":./css/f.css" rel="stylesheet">
                        <!-- //Libreria principal jquery-3.6.0-->
                        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
                        <!-- Google Font: Source Sans Pro -->
                        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
                        <!-- Font Awesome -->
                        <link rel="stylesheet" href="../css/all.min.css">
                        <!-- Theme style -->
                        <link rel="stylesheet" href="../css/adminlte.min.css">
                        <!-- Ionicons -->
                        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
                    </head>
                    <div id="alerta" class="alerta">
                        <h4 id="titulo"></h4>
                        <p id="texto"></p>
                        <center><input type="button" id=\'btncerrar\' name=\'btncerrar\' style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: center; border-radius: 30px; font-size:16px" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' onclick="cerrar_alert()" data-bs-toggle="tooltip" value="Cerrar"></center>
                    </div>
                    <input type="text" id="link" value="" style="display: none;">
                    <script>
                        function cerrar_alert(){
                            document.getElementById("alerta").style.display = "none";
                            let link = document.getElementById("link").value;
                            if(link != ""){
                                document.getElementById("link").value = "";
                                $(location).attr(\'href\',link);
                            }
                        }
                    ';
            if ($user == 1) {
                echo '
                    document.getElementById("texto").innerText = ("Se actualizó la foto correctamente");
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "formatos.php";
                ';
            } else {
                echo '
                    document.getElementById("texto").innerText = ("Se actualizó la foto correctamente");
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "formatos.php";
                ';
            }
            echo '
                </script>
                    <body class="capa-fondo">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div style="width: 600px; height: 50px; position: absolute; margin: -10px 0 -25px 0sd;">
                                <img src="../imagenes/cintillo_institucional.jpg" style="width: 100%; height: 100%;">
                            </div>
                            <div class="nav navbar-nav" style="margin-left:57%; font-size: 14px">
                                <a class="nav-link active" href="../mod_snilpd/index.php">Menú Principal</a>
                                <div class="nav-item dropdown" id="tabla">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SNIRLPCD</a>
                                    <div class="dropdown-menu" id="submenu" style="display: none; margin-top: -5px">
                                        <a class="dropdown-item" href="../mod_snilpd/datos_personales.php">DATOS PERSONALES</a>
                                        <a class="dropdown-item" href="../mod_snilpd/discapacidad.php">DISCAPACIDAD</a>
                                        <a class="dropdown-item" href="../mod_snilpd/educacion.php">EDUCACIÓN</a>
                                        <a class="dropdown-item" href="../mod_snilpd/capacitacion.php">CAPACITACIÓN</a>
                                        <a class="dropdown-item" href="../mod_snilpd/situacion_ocupacional.php">SITUACIÓN OCUPACIONAL</a>
                                        <a class="dropdown-item" href="../mod_snilpd/experiencia_laboral.php">EXPERIENCIA LABORAL</a>
                                        <a class="dropdown-item" href="../mod_snilpd/foto.php">FOTO</a>
                                        <a class="dropdown-item" href="../mod_snilpd/formatos.php">FORMATOS</a>
                                        <a class="dropdown-item" href="../mod_snilpd/oportunidad_trabajo.php">OPORTUNIDAD DE TRABAJO</a>
                                        <!--a class="dropdown-item" href="#"></a>
                                        <a class="dropdown-item" href="#"></a>
                                        <a class="dropdown-item" href="#"></a>
                                        <a class="dropdown-item" href="#"></a-->
                                    </div>
                                    <script>
                                        let tabla = document.getElementById("tabla");
                                        let recibir = document.getElementById("submenu");
                                        let retrazo = "";

                                        tabla.addEventListener("mouseover", (event) => {
                                            recibir.style.display = "block";
                                        });

                                        tabla.addEventListener("mouseout", (event) => {
                                            recibir.style.display = "none"
                                        });
                                    </script>
                                </div>
                                <div class="nav-item dropdown" id="tabla2">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configuración</a>
                                    <div class="dropdown-menu" id="submenu2" style="display: none; margin-top: -5px">
                                        <a class="dropdown-item" href="../mod_login/olvido_contra.php">CAMBIAR CONTRASEÑA</a>
                                    </div>
                                    <script>
                                        let tabla2 = document.getElementById("tabla2");
                                        let recibir2 = document.getElementById("submenu2");

                                        tabla2.addEventListener("mouseover", (event) => {
                                            recibir2.style.display = "block";
                                        });

                                        tabla2.addEventListener("mouseout", (event) => {
                                            recibir2.style.display = "none";
                                        });
                                    </script>
                                </div>
                                <a class="nav-link active" href="#">Ayuda</a>
                                <a class="nav-link active" href="../mod_login/cerrar_sesion.php">Cerrar Sesión</a>
                            </div>
                        </nav>
                    </body>';
            /* if ($user == 1) {
                echo 'Está es la foto que usted actualizó';
            } else {
                echo 'Está es la foto que usted agregó';
            } */
            $PG = ("SELECT * FROM snirlpcd.persona_fotos WHERE persona_id = '" . $persona_id . "'");
            $row2 = pg_query($conn, $PG);
            $persona2 = pg_fetch_assoc($row2);
            /* echo $PG;
            die(); */
            /* echo '
                                                                        </p>
                                                                    </div>
                                                                    <center>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <img src=' . $ruta  $persona2["nombre_foto"] . ' style="width: 100%; height: auto">
                                                                            </div>
                                                                        </div>
                                                                    </center>

                                                                    <div class="col-sm-7">
                                                                        <a href="formatos.php">
                                                                            <input style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px; margin:5px" onmouseout="this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"" onmouseover="this.style.color="#46A2FD"; this.style.backgroundColor="#fff";" type="submit" id="archivo" name="archivo_img" value="Continuar">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer style="width: 100vw">
                            <br>
                            <div class="pub-2" style="float: left;">
                                <center>
                                    <div class="cent">
                                        <h3 style="font-size: 20px; color: white; margin: 0">
                                            Despacho del Viceministro o Viceministra de Previsión Social.<br>
                                        </h3>
                                        <h3 style="font-size: 20px; color: white; margin: 15px 0 0 0">
                                            <img src="../imagenes/Telf2.png" style="width: 18px; height: auto; margin: -5px 0 0 0"> +58 0212 4082371.
                                            <span style="width: 20px; height: 20px; margin: 0 50px"></span>
                                            <img src="../imagenes/Gmail2.png" style="width: 18px; height: auto"> snirlpdmpppst@gmail.com <br>
                                            <img src="../imagenes/Twitter2.png" style="width: 18px; height: auto; margin: -5px 0 0 0"> Viceprevisionsocial.mpppst
                                            <span style="width: 20px; height: 20px; margin: 0 12px"></span>
                                            <img src="../imagenes/Instagram2.png" style="width: 18px; height: auto; margin: -5px 0 0 0"> Viceprevisionsocial.mpppst
                                        </h3>
                                    </div>
                                </center>
                            </div>
                            <div class="line"></div>
                            <div class="pub-2" style="float: right; top: -100px; margin: -176.5px 0 0 0">
                                <center>
                                    <div class="cent"><br><br><br>
                                        <h3 style="color: white;">Oficina de Tecnología de la Información y la Comunicación (OTIC). <br> Análisis y Desarrollo de Sistemas. <br> © 2023 Todos los Derechos Reservados.</h3>
                                    </div>
                                </center>
                            </div>
                        </footer>
                    </body>
                ';
            die();
        } */
    } else {
        if ($user == 1) {
            echo '
                        <script>
                            document.getElementById("texto").innerText = ("Error, no se pudo agregar la foto");
                            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                            document.getElementById("titulo").style.color = "white";
                            document.getElementById("titulo").innerText = ("Atención");
                            document.getElementById("alerta").style.display = "Block";
                            document.getElementById("link").value = "foto.php";
                        </script>
                    ';
            die();
        } else {
            echo '
                        <script>
                            document.getElementById("texto").innerText = ("Error, no se pudo agregar la foto");
                            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                            document.getElementById("titulo").style.color = "white";
                            document.getElementById("titulo").innerText = ("Atención");
                            document.getElementById("alerta").style.display = "Block";
                            document.getElementById("link").value = "foto.php";
                        </script>
                    ';
            die();
        }
    }

    /* echo $query;
        die(); */
} else {
    echo '
        <script>
            document.getElementById("texto").innerText = ("Error, no se pudo mover la foto a la carpeta correspondiente");
            document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
            document.getElementById("link").value = "foto.php";
        </script>
    ';
}
/* echo '
    <script>
        document.getElementById("texto").innerText = ("No seleccionó ninguna imagen");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
        document.getElementById("link").value = "foto.php";
    </script>
'; */

// Extrayendo la imagen
/* if (isset($_FILES["foto"])) { */
/* echo $files = $_FILES["foto"] . "<br>";
echo $name = $files["name"] . "<br>";
echo $tipo = $files["type"] . "<br>";
echo $ruta_tmp = $files["tmp_name"] . "<br>";
echo $size = $files["size"] . "<br>";
echo $dimensiones = getimagesize($ruta_tmp) . "<br>";
echo $width = $dimensiones[0] . "<br>";
echo $height = $dimensiones[1] . "<br>";
echo $carpeta = "../imagenes/fotos/" . "<br>";
die();
if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif') {
    echo " Error, el archivo no es una imagen)";
    die();
} else
if ($size > 3 * 1024 * 1024) {
    echo "Error, el tamaño máximo de imagen permitido son 1.5MB";
    die();
} else {
    $src = $carpeta . $name;
    move_uploaded_file($ruta_tmp, $src);
    $imagen = "../imagenes/fotos/" . $name . $tipo;
} */
/* } else {
    $query = "INSERT INTO";
    $query .= " snirlpcd.persona_foto";
    $query .= " (";
    $query .= " persona_id,";
    $query .= " simagen,";
    $query .= " nusuario_creacion,";
    $query .= " )";
    $query .= " VALUES";
    $query .= " (";
    $query .= " '$persona_id',";
    $query .= " '$name',";
    $query .= " '$persona_id'";
    $query .= " )";

    if ($resultado = pg_query($conn, $query)) {
        echo "Se subió la foto correctamente";
        /* header('location: foto.php'); 
        die();
    } else {
        echo "Error, no se pudo subir la foto";
        /* header('location: foto.php'); 
        die();
    }*/
} 
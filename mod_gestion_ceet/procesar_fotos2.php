<?php
$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();

try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$bambiente_formacion2 = $_SESSION["bambiente_formacion2"];
$bexp_productiva_detec2 = $_SESSION["bexp_productiva_detec2"];

$nombres2 = $_SESSION["nombres2"];
$apellidos2 = $_SESSION["apellidos2"];

$fecha_hora = date("Y-m-d H:i:s");

$grande1 = 0;
$grande2 = 0;
$grande3 = 0;
$grande4 = 0;
$grande5 = 0;
$grande6 = 0;
$grande7 = 0;

$type1 = 0;
$type2 = 0;
$type3 = 0;
$type4 = 0;
$type5 = 0;
$type6 = 0;
$type7 = 0;

/* $error = 0; */

// Primera Foto
if (isset($_FILES["acta_file"])) {
    $nombre1 = $_FILES["acta_file"]["name"];
    $tipo1 = $_FILES["acta_file"]["type"];
    $temporal1 = $_FILES["acta_file"]["tmp_name"];

    if (!in_array($tipo1, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type1++;
    }
    $fecha_hora = date("Y-m-d H:i:s");
    $nombre_unico1 = $fecha_hora . " - " . $nombre1;
    $ruta1 = "imagenes/" . $nombre_unico1;
    move_uploaded_file($temporal1, $ruta1);
}

// Segunda Foto
if ($bexp_productiva_detec2 == "t") {
    if (isset($_FILES["experiencia_file"])) {
        $nombre2 = $_FILES["experiencia_file"]["name"];
        $tipo2 = $_FILES["experiencia_file"]["type"];
        $temporal2 = $_FILES["experiencia_file"]["tmp_name"];
        if (!in_array($tipo2, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
            $type2++;
        }
        $nombre_unico2 = $fecha_hora . " - " . $nombre2;
        $ruta2 = "imagenes/" . $nombre_unico2;
        move_uploaded_file($temporal2, $ruta2);
    }
}

// Tercera Foto
if (isset($_FILES["minuta_file"])) {
    $nombre3 = $_FILES["minuta_file"]["name"];
    $tipo3 = $_FILES["minuta_file"]["type"];
    $temporal3 = $_FILES["minuta_file"]["tmp_name"];
    if (!in_array($tipo3, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type3++;
    }
    $nombre_unico3 = $fecha_hora . " - " . $nombre3;
    $ruta3 = "imagenes/" . $nombre_unico3;
    move_uploaded_file($temporal3, $ruta3);
}

// Cuarta Foto
if (isset($_FILES["trabajador_file"])) {
    $nombre4 = $_FILES["trabajador_file"]["name"];
    $tipo4 = $_FILES["trabajador_file"]["type"];
    $temporal4 = $_FILES["trabajador_file"]["tmp_name"];
    if (!in_array($tipo4, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type4++;
    }
    $nombre_unico4 = $fecha_hora . " - " . $nombre4;
    $ruta4 = "imagenes/" . $nombre_unico4;
    move_uploaded_file($temporal4, $ruta4);
}
// Quinta Foto
if (isset($_FILES["lista_file"])) {
    $nombre5 = $_FILES["lista_file"]["name"];
    $tipo5 = $_FILES["lista_file"]["type"];
    $temporal5 = $_FILES["lista_file"]["tmp_name"];
    if (!in_array($tipo5, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type5++;
    }
    $nombre_unico5 = $fecha_hora . " - " . $nombre5;
    $ruta5 = "imagenes/" . $nombre_unico5;
    move_uploaded_file($temporal5, $ruta5);
}

// Sexta Foto
if (isset($_FILES["pla_especi"])) {
    $nombre6 = $_FILES["pla_especi"]["name"];
    $tipo6 = $_FILES["pla_especi"]["type"];
    $temporal6 = $_FILES["pla_especi"]["tmp_name"];
    if (!in_array($tipo6, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type6++;
    }
    $nombre_unico6 = $fecha_hora . " - " . $nombre6;
    $ruta6 = "imagenes/" . $nombre_unico6;
    move_uploaded_file($temporal6, $ruta6);
}

// Septima Foto
if (isset($_FILES["pla_cptt"])) {
    $nombre7 = $_FILES["pla_cptt"]["name"];
    $tipo7 = $_FILES["pla_cptt"]["type"];
    $temporal7 = $_FILES["pla_cptt"]["tmp_name"];
    if (!in_array($tipo7, ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.spreadsheet", "application/vnd.ms-excel", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword"])) {
        $type7++;
    }
    $nombre_unico7 = $fecha_hora . " - " . $nombre7;
    $ruta7 = "imagenes/" . $nombre_unico7;
}

$archivo1 = $ruta1;
$archivo2 = $ruta2;
$archivo3 = $ruta3;
$archivo4 = $ruta4;
$archivo5 = $ruta5;
$archivo6 = $ruta6;
$archivo7 = $ruta7;

if ($ruta1 == '') {
    $archivo = "No subió nada";
}
if ($ruta2 == '') {
    $archivo = "No subió nada";
}
if ($ruta3 == '') {
    $archivo = "No subió nada";
}
if ($ruta4 == '') {
    $archivo = "No subió nada";
}
if ($ruta5 == '') {
    $archivo = "No subió nada";
}
if ($ruta6 == '') {
    $archivo = "No subió nada";
}
if ($ruta7 == '') {
    $archivo = "No subió nada";
}

/* if ($grande1 > 0 || $grande2 > 0 || $grande3 > 0 || $grande4 > 0 || $grande5 > 0) {
    $mostrar = '
        <!DOCTYPE html>
        <html lang="Es-es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CEET</title>
            <!-- Bootstrap V5.1.3 -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <!-- Link CSS -->
            <link rel="stylesheet" href="css/estilos.css">
        </head>
        <body>
            <script>
                alert("Falló la actualización de los archivos");
            </script>
            <header>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid ">
                        <div class="logo">
                            <img src="imagenes/cintillo_institucional.jpg">
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="sep-header"></div>
                <div class="container">
                    <div class="row">
                    <!-- Parte 1 -->
                    <div class="col-md-12 sep-y">
                        <div class="jumbotron">
                            <form class="col-md-8 fondo" action="procesar_fotos.php" method="post" enctype="multipart/form-data">
                                <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> ARCHIVOS ADJUNTADOS </h3>
                                </div>
                                <div class="card-body">
    ';
    if ($grande1 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Acta de Apertura" sobrepasa el límte de 7MB
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($grande2 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Experiencia Productiva Detectada" sobrepasa el límte de 7MB
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($grande3 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Minuta de los Abordajes de las Entidades de trabajo" sobrepasa el límte de 7MB
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($grande4 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                El "Registro Trabajador" sobrepasa el límte de 7MB
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($grande5 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Lista de Asistencia del Personal CEET" sobrepasa el límte de 7MB
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    $mostrar .= '
                                    <center>
                                        <a href="files.php">
                                            <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip">Regresar</button>
                                        </a>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="color: white;">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6" style="border-right: 1px solid white;">
                                            <h3 class="sep-3" style="font-size: 16px; margin-left: 100px">Viceministerio para la Educación y el Trabajo para la Liberación</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                                            <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                                            <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <body>
        </html>
    ';

    echo $mostrar;
    die();
} */

if ($type1 > 0 || $type2 > 0 || $type3 > 0 || $type5 > 0  || $type6 > 0 || $type4 > 0) {
    $mostrar = '
        <!DOCTYPE html>
        <html lang="Es-es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CEET</title>
            <!-- Bootstrap V5.1.3 -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <!-- Link CSS -->
            <link rel="stylesheet" href="css/estilos.css">
            <link rel="stylesheet" href="css/estilos2.css">
        </head>
        <body>
            <script>
                alert("Falló la actualización de los archivos");
            </script>
            <header>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid ">
                        <div class="logo">
                            <img src="imagenes/cintillo_institucional.jpg">
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="sep-header"></div>
                <div class="container">
                    <div class="row">
                    <!-- Parte 1 -->
                    <div class="col-md-12 sep-y">
                        <div class="jumbotron">
                            <form class="col-md-8 fondo" action="procesar_fotos.php" method="post" enctype="multipart/form-data">
                                /* <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> ARCHIVOS ADJUNTADOS </h3>
                                </div> */                                        <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px"> ARCHIVOS ADJUNTADOS  </h2>

                                <div class="card-body">
    ';
    if ($type1 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Acta de Apertura" no tiene un formato acorde.
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($type2 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Experiencia Productiva Detectada" no tiene un formato acorde.
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($type4 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                El "Registro Trabajador" no tiene un formato acorde.
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($type6 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                El "Planilla de Formación Especializada" no tiene un formato acorde.
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    /*   if ($type7 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                El "Planilla del CPTT" no tiene un formato acorde.
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    } */
    if ($type5 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Lista de Asistencia del Personal CEET" no tiene un formato acorde.
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    if ($type3 > 0) {
        $mostrar .= '
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <center>
                                            <p>
                                                La "Minuta de los Abordajes de las Entidades de trabajo" no tiene un formato acorde. ' . $tipo3 . '
                                            </p>
                                        </center>
                                    </div>
                                    <div class="col-md-2"></div>
        ';
    }
    $mostrar .= '
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <footer style="margin-top:15%">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="color: white;">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6" style="border-right: 1px solid white;">
                                            <h3 class="sep-3" style="font-size: 16px; margin-left: 100px">Viceministerio para la Educación y el Trabajo para la Liberación</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                                            <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                                            <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <body>
        </html>
    ';

    echo $mostrar;
    die();
}

$SQL = "UPDATE";
$SQL .= " reporte_ceet.abordaje_rnee_empresa";
$SQL .= " SET";
$SQL .= " sacta_apertura = '$archivo1',";
$SQL .= " sarchivo_formacion = '$archivo2',";
$SQL .= " sminuta_formacion = '$archivo3',";
$SQL .= " sregistro_trabajador = '$archivo4',";
$SQL .= " slista_ceet = '$archivo5',";
$SQL .= " splanilla_formacion_esp = '$archivo6',";
$SQL .= " splanilla_cptt = '$archivo7'";
$SQL .= " WHERE";
$SQL .= " rnee_empresa_id = '" . $_SESSION["empresa_id"]  . "'";
$SQL .= " AND";
$SQL .= " snombres_resp_form = '$nombres2'";
$SQL .= " AND";
$SQL .= " sapellidos_resp_form = '$apellidos2'";
$SQL .= " AND";
$SQL .= " bexp_productiva_detec = '$bexp_productiva_detec2'";
$SQL .= " AND";
$SQL .= " benabled = 'TRUE'";

if ($resultado = pg_query($conn, $SQL)) {
    $mostrar = '
        <!DOCTYPE html>
        <html lang="Es-es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CEET</title>
            <!-- Bootstrap V5.1.3 -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <!-- Link CSS -->
            <link rel="stylesheet" href="css/estilos.css">
            <link rel="stylesheet" href="css/estilos2.css">
        </head>
        <body>
            <script>
                alert("Se subieron correctamente los archivos");
            </script>
            <header>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid ">
                        <div class="logo">
                            <img src="imagenes/cintillo_institucional.jpg">
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="sep-header"></div>
                <div class="container">
                    <div class="row">
                    <!-- Parte 1 -->
                    <div class="col-md-12 sep-y">
                        <div class="jumbotron">
                            <form class="col-md-8 fondo" action="procesar_fotos.php" method="post" enctype="multipart/form-data">
                                                                        <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">ARCHIVOS ADJUNTADOS </h2>

                                <div class="card-body">
                                    <br>
                                    <center>
                                        <h7 style="color: #BF1F13"> Archivos adjuntados correctamente </h7>
                                    </center>
                                    <br>
                                    <div class="container">
                                        <div class="row justify-content-start">
    ';

    if ($bambiente_formacion2 == "t") {
        $mostrar .= '
                                            <div class="col-sm-12">
                                                <h6> AUTOFORMACIÓN </h6>
                                                <hr>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Acta de Apertura </label>
                                                <div class="input-group mb-3">
        ';
        if ($tipo1 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $tipo1 == "application/msword") {
            $mostrar .= '
                                                    <img src="imagenes/Word.png" style="max-height: 100px; margin: auto">
            ';
        } else
        if ($tipo1 == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipo1 == "application/vnd.ms-excel") {
            $mostrar .= '
                                                    <img src="imagenes/Excel.png" style="max-height: 100px; margin: auto">
            ';
        } else
        if ($tipo1 == "application/vnd.oasis.opendocument.spreadsheet") {
            $mostrar .= '
                                                    <img src="imagenes/LibreOffice.png" style="max-height: 100px; margin: auto">
            ';
        } else
        if ($tipo1 == "application/pdf") {
            $mostrar .= '
                                                    <img src="imagenes/PDF.png" style="max-height: 100px; margin: auto">
            ';
        } else {
            $mostrar .= '
                                                    <img src="imagenes/' . $nombre_unico1 . '" style="max-width: 100%">
            ';
        }
        $mostrar .= '
                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div>
        ';
    }
    $mostrar .= '
                                            <div class="col-sm-12">
                                                <h6> FORMACIÓN </h6>
                                                <hr>
                                            </div>
    ';
    if ($bexp_productiva_detec2 == "t") {
        $mostrar .= '
            <div class="col-sm-6" id="op6">
                <label class="form-label"> Experiencia Productiva Detectada</label>
                <div class="input-group mb-3">
        ';
        if ($tipo2 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $tipo2 == "application/msword") {
            $mostrar .= '
                                                    <img src="imagenes/Word.png" style="max-height: 100px; margin: auto">
            ';
        } else
        if ($tipo2 == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipo2 == "application/vnd.ms-excel") {
            $mostrar .= '
                                                    <img src="imagenes/Excel.png" style="max-height: 100px; margin: auto">
            ';
        } else
        if ($tipo2 == "application/vnd.oasis.opendocument.spreadsheet") {
            $mostrar .= '
                                                    <img src="imagenes/LibreOffice.png" style="max-height: 100px; margin: auto">
            ';
        } else
        if ($tipo2 == "application/pdf") {
            $mostrar .= '
                                                    <img src="imagenes/PDF.png" style="max-height: 100px; margin: auto">
            ';
        } else {
            $mostrar .= '
                                                    <img src="imagenes/' . $nombre_unico2 . '" style="max-width: 100%">
            ';
        }
        $mostrar .= '
                </div>
            </div>
        ';
    }
    $mostrar .= '
            <div class="col-sm-6" id="op8">
                <label class="form-label"> Inserción Laboral</label>
                <div class="input-group mb-3">
        ';
    if ($tipo4 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $tipo4 == "application/msword") {
        $mostrar .= '
                    <img src="imagenes/Word.png" style="max-height: 100px; margin: auto">
            ';
    } else
        if ($tipo4 == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipo4 == "application/vnd.ms-excel") {
        $mostrar .= '
                    <img src="imagenes/Excel.png" style="max-height: 100px; margin: auto">
            ';
    } else
        if ($tipo4 == "application/vnd.oasis.opendocument.spreadsheet") {
        $mostrar .= '
                    <img src="imagenes/LibreOffice.png" style="max-height: 100px; margin: auto">
            ';
    } else
        if ($tipo4 == "application/pdf") {
        $mostrar .= '
                                                    <img src="imagenes/PDF.png" style="max-height: 100px; margin: auto">
            ';
    } else {
        $mostrar .= '
                    <img src="imagenes/' . $nombre_unico4 . '" style="max-width: 100%">
            ';
    }
    $mostrar .= '
                    </div>
                </div>
                <div class="col-sm-6" id="op8">
                    <label class="form-label"> Planilla de Formación Especializada </label>
                    <div class="input-group mb-3">
            ';
    if ($tipo6 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $tipo6 == "application/msword") {
        $mostrar .= '
                        <img src="imagenes/Word.png" style="max-height: 100px; margin: auto">
                ';
    } else
            if ($tipo6 == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipo6 == "application/vnd.ms-excel") {
        $mostrar .= '
                        <img src="imagenes/Excel.png" style="max-height: 100px; margin: auto">
                ';
    } else
            if ($tipo6 == "application/vnd.oasis.opendocument.spreadsheet") {
        $mostrar .= '
                        <img src="imagenes/LibreOffice.png" style="max-height: 100px; margin: auto">
                ';
    } else
            if ($tipo6 == "application/pdf") {
        $mostrar .= '
                        <img src="imagenes/PDF.png" style="max-height: 100px; margin: auto">
                ';
    } else {
        $mostrar .= '
                        <img src="imagenes/' . $nombre_unico6 . '" style="max-width: 100%">
                ';
    }
    $mostrar .= '
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label"> Planilla del CPTT </label>
                    <div class="input-group mb-3">
    ';
    if ($tipo7 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $tipo7 == "application/msword") {
        $mostrar .= '
                <img src="imagenes/Word.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo7 == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipo7 == "application/vnd.ms-excel") {
        $mostrar .= '
                <img src="imagenes/Excel.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo7 == "application/vnd.oasis.opendocument.spreadsheet") {
        $mostrar .= '
                <img src="imagenes/LibreOffice.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo7 == "application/pdf") {
        $mostrar .= '
                                            <img src="imagenes/PDF.png" style="max-height: 100px; margin: auto">
        ';
    } else {
        $mostrar .= '
                <img src="imagenes/' . $nombre_unico7 . '" style="max-width: 100%">
        ';
    }
    $mostrar .= '
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <h6> CEET </h6>
                                        <hr>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label"> Lista de Asistencia del Personal CEET</label>
                                        <div class="input-group mb-3">
    ';
    if ($tipo5 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $tipo5 == "application/msword") {
        $mostrar .= '
                                                    <img src="imagenes/Word.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo5 == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipo5 == "application/vnd.ms-excel") {
        $mostrar .= '
                                                    <img src="imagenes/Excel.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo5 == "application/vnd.oasis.opendocument.spreadsheet") {
        $mostrar .= '
                                                    <img src="imagenes/LibreOffice.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo5 == "application/pdf") {
        $mostrar .= '
                                                <img src="imagenes/PDF.png" style="max-height: 100px; margin: auto">
        ';
    } else {
        $mostrar .= '
                                                    <img src="imagenes/' . $nombre_unico5 . '" style="max-width: 100%">
        ';
    }
    $mostrar .= '
                                                </div>
                                            </div>';
    $mostrar .= '
        <div class="col-sm-6">
            <label class="form-label"> Minuta de los Abordajes a las Entidades de Trabajo </label>
            <div class="input-group mb-3">
    ';
    if ($tipo3 == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $tipo3 == "application/msword") {
        $mostrar .= '
                <img src="imagenes/Word.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo3 == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipo3 == "application/vnd.ms-excel") {
        $mostrar .= '
                <img src="imagenes/Excel.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo3 == "application/pdf") {
        $mostrar .= '
                <img src="imagenes/PDF.png" style="max-height: 100px; margin: auto">
        ';
    } else
    if ($tipo3 == "application/vnd.oasis.opendocument.spreadsheet") {
        $mostrar .= '
                <img src="imagenes/LibreOffice.png" style="max-height: 100px; margin: auto">
        ';
    } else {
        $mostrar .= '
                <img src="imagenes/' . $nombre_unico3 . '" style="max-width: 100%">
        ';
    }
    $mostrar .= '           
                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div>
                                            <center>
                                                <a href="index.php">
                                                    <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip" onclick=\'finalizar()\'>Finalizar</button>
                                                </a>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <footer style="margin-top:15%">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="color: white;">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6" style="border-right: 1px solid white;">
                                            <h3 class="sep-3" style="font-size: 16px; margin-left: 100px">Viceministerio para la Educación y el Trabajo para la Liberación</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                                            <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                                            <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- JS -->
            <script>
                function finalizar(){
                    alert ("Se realizó el registro correctamente");
                }
            </script>
        </body>
        </html>
    ';
    echo $mostrar;
} else {
    echo '
        <!DOCTYPE html>
        <html lang="Es-es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CEET</title>
            <!-- Bootstrap V5.1.3 -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <!-- Link CSS -->
            <link rel="stylesheet" href="css/estilos.css">
            <link rel="stylesheet" href="css/estilos2.css">
        </head>
        <body>
            <script>
                alert("Falló la actualización de los archivos");
            </script>
            <header>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid ">
                        <div class="logo">
                            <img src="imagenes/cintillo_institucional.jpg">
                        </div>
                    </div>
                </nav>
            </header>
            <main>
                <div class="sep-header"></div>
                <div class="container">
                    <div class="row">
                    <!-- Parte 1 -->
                    <div class="col-md-12 sep-y">
                        <div class="jumbotron">
                            <form class="col-md-8 fondo" action="procesar_fotos.php" method="post" enctype="multipart/form-data">
                                <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> ARCHIVOS ADJUNTADOS </h3>
                                </div>
                                <div class="card-body">
                                    <center>
                                        <p> ' . $SQL . ' </p><br>
                                        <a href="files2.php">
                                            <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip">Regresar</button>
                                        </a>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            <footer style="margin-top:15%">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" style="color: white;">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6" style="border-right: 1px solid white;">
                                            <h3 class="sep-3" style="font-size: 16px; margin-left: 100px">Viceministerio para la Educación y el Trabajo para la Liberación</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                                            <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                                            <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <body>
        </html>
    ';
}

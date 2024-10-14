<?

$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();
/* include('../include/BD.php');
$conn = Conexion::ConexionBD();
 */
try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

$Ambiente_Formacion2 = $_REQUEST["Ambiente_Formacion2"];
$Experiencia_Productiva2 = $_REQUEST["Experiencia_Productiva2"];
$Formacion_CPTT2 = $_REQUEST["Formacion_CPTT2"];
$Insercion_Laboral2 = $_REQUEST["Insercion_Laboral2"];
$srif = $_REQUEST["srif"];

$r = "SELECT empresa.id, srif,srazon_social,sdenominacion_comercial,tipo_capital_id as ca,
tipo_capital.sdescripcion as capital,estado_id,municipio_id,parroquia_id,
entidad.sdescripcion as estado,
municipio.sdescripcion as minicipio,
parroquia.sdescripcion as parroquia,
act_economica4 as nombre,sdireccion_fiscal 
FROM reporte_ceet.empresa
inner join reporte_ceet.tipo_capital on tipo_capital.id = reporte_ceet.empresa.tipo_capital_id 

LEFT JOIN public.entidad ON entidad.nentidad=empresa.estado_id 
LEFT JOIN public.municipio ON municipio.nmunicipio=empresa.municipio_id 
LEFT JOIN public.parroquia ON parroquia.nparroquia=empresa.parroquia_id 
WHERE srif = '" . $srif . "'  LIMIT 1";
$ra = pg_query($conn, $r);
$persona = pg_fetch_assoc($ra);

/* echo " 1 / " . $r; */

$rnee_empresa_id = $persona["id"];

?>
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
    <!-- Header -->
    <header>
        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid ">
                <div class="logo">
                    <img src="imagenes/cintillo_institucional.jpg">
                </div>
            </div>
        </nav>
    </header>
    <!-- Main -->
    <main>
        <div class="sep-header"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-2"></div>

                <?

                $apellido1 = $_SESSION["apellido1"];
                $apellido2 = $_SESSION["apellido2"];
                $nombre1 = $_SESSION["nombre1"];
                $nombre2 = $_SESSION["nombre2"];

                $select = "SELECT * FROM public.personales WHERE nenabled = 1 AND primer_apellido = '$apellido1' AND segundo_apellido = '$apellido2' AND primer_nombre = '$nombre1' AND segundo_nombre = '$nombre2'";
                $row = pg_query($conn, $select);
                $persona = pg_fetch_assoc($row);

                $nentidad = $persona["nentidad_entidad"];

                $correo = $persona["semail"];
                if (empty($correo)) {
                    $correo = $select;
                }
                ?>
                <div style="display:none">
                    <div class="col-md-12 sep-y">
                        <div class="jumbotron">
                            <form method="POST" action="" class="col-md-8 fondo">
                                <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> DATOS DEL (LA) JEFE(A) CEET </h3>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row justify-content-start">
                                            <div class="col-6">
                                                <label class="form-label"> Nombre(s) </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <input disabled type="text" class="form-control" placeholder="Nombre(s)" value="<?php echo $_SESSION['nombre1'] . " " . $_SESSION['nombre2']; ?>" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Apellido(s) </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <input disabled type="text" class="form-control" placeholder="Apellido(s)" value="<?php echo $_SESSION['apellido1'] . " " . $_SESSION['apellido2']; ?>" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Correo Electrónico Personal </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/correo1.png" alt="" style="max-height: 40px;"></span>
                                                    <input disabled type="email" class="form-control" placeholder="Correo Electrónico Personal" value="<? echo $correo; ?>" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Estado </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 47.5px"><img src="imagenes/educacion.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="estado0" disabled>
                                                        <?
                                                        $sql0 = "SELECT * FROM public.entidad WHERE nenabled = 1";
                                                        $row0 = pg_query($conn, $sql0);
                                                        $persona0 = pg_fetch_all($row0);
                                                        foreach ($persona0 as $u) {
                                                            if ($nentidad = $u["nentidad"]) {
                                                        ?>
                                                                <option value="<? echo $u['id']; ?>" selected><? echo $u['sdescripcion']; ?></option>
                                                        <?
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <?
                                                $nombres2 = $_SESSION["nombres2"];
                                                $apellidos2 = $_SESSION["apellidos2"];

                                                $sql = "SELECT * FROM";
                                                $sql .= " reporte_ceet.abordaje_rnee_empresa";
                                                $sql .= " WHERE";
                                                $sql .= " rnee_empresa_id = '" . $rnee_empresa_id  . "'";
                                                $sql .= " AND";
                                                $sql .= " snombres_resp_form = '$nombres2'";
                                                $sql .= " AND";
                                                $sql .= " sapellidos_resp_form = '$apellidos2'";
                                                $sql .= " AND";
                                                $sql .= " benabled = 'TRUE'";
                                                $row = pg_query($conn, $sql);
                                                $persona = pg_fetch_assoc($row);

                                                $bexp_productiva_detec2 = $persona["bexp_productiva_detec"];
                                                $binsercion_laboral2 = $persona["binsercion_laboral"];
                                                $bambiente_formacion2 = $persona["bambiente_formacion"];

                                                $_SESSION["bambiente_formacion2"] = $bambiente_formacion2;
                                                $_SESSION["bexp_productiva_detec2"] = $bexp_productiva_detec2;
                                                $_SESSION["binsercion_laboral2"] = $binsercion_laboral2;

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Parte 1 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form class="col-md-8 fondo" action="procesar_fotos2.php" method="post" enctype="multipart/form-data">
                            <!-- <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> ADJUNTAR ARCHIVOS</h3>
                            </div> -->
                            <div class="card-body">
                                <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">ADJUNTAR ARCHIVOS </h2>

                                <h4> Campos Obligatorios (*) </h4>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <br>
                                        <center>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10" style="margin: 10px auto;">
                                                <h7 style="color: #BF1F13">
                                                    Los formatos permitidos son: pdf, jpg, jpeg, png, xlsx, xls, docx, doc y ods.
                                                    <!-- <br><br><br>
                                                    <?
                                                    /*
                                                        $inf = $nombres2 . " " . $apellidos2 . " " . $bambiente_formacion2 . " " . $bexp_productiva_detec2 . " " . $binsercion_laboral2;
                                                        echo $inf;
                                                    */
                                                    ?>
                                                    <br><br><br> -->
                                                </h7>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </center>
                                        <br>
                                        <?
                                        if ($bambiente_formacion2 == "t") {
                                        ?>
                                            <div class="col-sm-12">
                                                <h6> AUTOFORMACIÓN </h6>
                                                <hr>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Acta de Apertura <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="file" id="acta_file" name="acta_file" style="border-radius: 30px" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div>
                                        <?
                                        }
                                        ?>
                                        <div class="col-sm-12" style="margin-top: 15px;">
                                            <h6> FORMACIÓN </h6>
                                            <hr>
                                        </div>
                                        <?
                                        if ($bexp_productiva_detec2 == "t") {
                                        ?>
                                            <div class="col-sm-6" id="op6">
                                                <label class="form-label"> Experiencia Productiva Detectada <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="file" id="experiencia_file" name="experiencia_file" style="border-radius: 30px" required>
                                                </div>
                                            </div>
                                        <?
                                        }
                                        ?>
                                        <div class="col-sm-6" id="op8">
                                            <label class="form-label"> Inserción Laboral <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="file" id="trabajador_file" name="trabajador_file" style="border-radius: 30px" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"> Planilla de Formación Especializada <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="file" id="pla_especi" name="pla_especi" style="border-radius: 30px" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="op8">
                                            <label class="form-label"> Planilla del CPTT </label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="file" id="pla_cptt" name="pla_cptt" style="border-radius: 30px">
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 15px;">
                                            <h6> CEET </h6>
                                            <hr>
                                        </div>
                                        <div class="col-sm-6"> <label class="form-label"> Lista de Asistencia del Personal CEET <span class="requid"> * </span></label>

                                            <div class="input-group mb-3" style="margin-top: 30px;">
                                                <input class="form-control" type="file" id="lista_file" name="lista_file" style="border-radius: 30px" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"> Minuta de los Abordajes a las Entidades de Trabajo <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <input class="form-control" type="file" id="minuta_file" name="minuta_file" style="border-radius: 30px" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"></div>
                                        <br>
                                        <hr>
                                        <center>
                                            <a href="index.php?rnee_empresa_id=<?php echo $rnee_empresa_id; ?>&bexp_productiva_detec2=<?php echo $bexp_productiva_detec2; ?>">
                                                <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button>
                                            </a>
                                            <button type="submit" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Enviar</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer style="margin-top:15%;">
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
</body>

</html>
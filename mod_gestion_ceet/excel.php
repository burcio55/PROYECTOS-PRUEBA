<?php
/* include("../header.php");
include("general_LoadCombo.php");

$settings['debug'] = false;
$conn = getConnDB($db1);
$conn->debug = $settings['debug'];
debug(); */


$host = "10.46.1.93";
$dbname = "minpptrassi";
$user = "postgres";
$pass = "postgres";

session_start();

/* session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD();
 */
try {
    $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conn = $error;
    echo ("Error al conectar en la Base de Datos " . $error);
}

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
    <link rel="stylesheet" href="css/jquery.dataTables.min.css" />
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

                <!-- Parte 1 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-8 fondo">
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

                            include "menu2.php";
                            ?>
                            <div class="row justify-content-start" style="display:none;">
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
                            </div>
                            <!-- <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> IMPRESIÓN DE REPORTES EXCEL </h3>
                            </div> -->
                            <div class="card-body">
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">TIPOS DE ABORDAJES </h2>

                                        <h4> Campo Obligatorio (*) </h4><br>
                                        <div class="sep"></div>
                                        <div class="col-sm-4">
                                            <label class="form-label"> ¿Qué tipo de abordaje requiere consultar? <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Experiencia.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" id="tipo_trb" aria-label="Default select example" style="border-radius: 0 30px 30px 0" onchange="javascript:sel7()">
                                                    <option value="-1" selected> Seleccione </option>
                                                    <option value="2"> Entidad de Trabajo </option>
                                                    <option value="1"> Trabajador Independiente </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4" style="display: none" id="user">
                                            <label class=" form-label"> ¿Cuál Trabajador requiere consultar? <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Experiencia.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" id="trab" aria-label="Default select example" style="border-radius: 0 30px 30px 0" onchange="javascript:sel7()">
                                                    <option value="-1" selected> Seleccione </option>
                                                    <?
                                                    $sql = "SELECT * FROM reporte_ceet.trabajador_indep WHERE benabled = 'TRUE'";
                                                    $row = pg_query($conn, $sql);
                                                    $persona = pg_fetch_all($row);
                                                    foreach ($persona as $u) {
                                                    ?>
                                                        <option value="<? echo $u['id']; ?>"><? echo $u['sprimer_nombre'] . " " . $u['ssegundo_nombre'] . " " . $u['sprimer_apellido'] . " " . $u['ssegundo_apellido']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5" style="display: none" id="ent">
                                            <label class=" form-label" style="font-size:19px; margin-top:30px;"> ¿Cuál Entidad requiere consultar? <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Experiencia.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" id="ente" aria-label="Default select example" style="border-radius: 0 30px 30px 0" onchange="javascript:sel7()">
                                                    <option value="-1" selected> Seleccione </option>
                                                    <?
                                                    $fecha = date("d-m-Y");
                                                    $sql = "SELECT abordaje_rnee_empresa.benabled,
                                                    	abordaje_rnee_empresa.rnee_empresa_id,
                                                    	empresa.sdenominacion_comercial as empresa_id,
                                                    	abordaje_rnee_empresa.fecha,
                                                    	abordaje_rnee_empresa.rnee_empresa_id,
                                                    	abordaje_rnee_empresa.snombres_resp_form,
                                                    	abordaje_rnee_empresa.sapellidos_resp_form,
                                                    	abordaje_rnee_empresa.stelefono_personal_resp_form,
                                                    	motor.sdescripcion as motor_id,

                                                    	abordaje_rnee_empresa.sinsercion_laboral
                                                        FROM reporte_ceet.abordaje_rnee_empresa 
                                                        INNER JOIN reporte_ceet.motor ON abordaje_rnee_empresa.motor_id = motor.id
                                                        INNER JOIN reporte_ceet.empresa ON abordaje_rnee_empresa.rnee_empresa_id = rnee_empresa_id
                                                     WHERE abordaje_rnee_empresa.benabled = 'TRUE'";
                                                    $row = pg_query($conn, $sql);
                                                    $persona = pg_fetch_all($row);
                                                    foreach ($persona as $u) {
                                                    ?>
                                                        <option value="<? echo $u['rnee_empresa_id']; ?>"><? echo $u['empresa_id']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Excel de Trabajador Independiente -->
                                        <div class="col-sm-2" style="margin-top: 37px; display: none" id="bot_excel1">
                                            <a href="excel_ti.php">
                                                <input type="button" class="form-control" style="width: auto; font-size: 16px; background-color: #46A2FD; color: #fff; border-radius: 30px; border: none; cursor: pointer; padding: 6px 10px; margin-top: 32px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="none";' onmouseover='this.style.color="rgba(0, 128, 255, 0.5)"; this.style.backgroundColor="#fff"; this.style.border="#46A2FD 2px Solid"; this.style.padding="5px 10px";' onclick="excel_ti(trab.value)" value="Descargar Excel">
                                            </a>
                                        </div>
                                        <!-- Excel de Entidad de Trabajo -->
                                        <div class="col-sm-2" style="margin-top: 37px; display: none" id="bot_excel2">
                                            <a href="excel_et.php">
                                                <input type="button" class="form-control" style="width: auto; font-size: 16px; background-color: #46A2FD; color: #fff; border-radius: 30px; border: none; cursor: pointer; padding: 6px 10px; margin-top: 32px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="none";' onmouseover='this.style.color="rgba(0, 128, 255, 0.5)"; this.style.backgroundColor="#fff"; this.style.border="#46A2FD 2px Solid"; this.style.padding="5px 10px";' onclick="excel_et(ente.value)" value="Descargar Excel">
                                            </a>
                                        </div>
                                        <center>
                                            <div class="col-sm-2">
                                                <a href="vista.php">
                                                    <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px; margin-left: 18px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button>
                                                </a>
                                            </div>
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


    <!-- JavaScript Link's -->
    <script src="javascript/b_cedula.js"></script>
    <script src="javascript/trabajador.js"></script>
    <script src="javascript/interaccion.js"></script>
    <script src="javascript/rol_id.js"></script>

    <script src="javascript/mayus.js"></script>

    <script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
    <!-- <script src="javascript/interaccion.js"></script> -->
</body>
<footer style="margin-top:15%;">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="color: white;">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6" style="border-right: 1px solid white;">
                                <h3 class="sep-3" style="font-size: 16px; margin-left: 140px; width: 100%">Viceministerio para la Educación y el Trabajo para la Liberación</h3>
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

</html>
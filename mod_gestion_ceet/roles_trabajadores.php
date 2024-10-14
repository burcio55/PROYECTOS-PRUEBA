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
                        <form method="POST" action="" class="col-md-8 fondo"> <?


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
                            <!--  <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> ADMINISTRAR ROL DE USUARIOS </h3>
                            </div> -->
                            <div class="card-body">
                                <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">ADMINISTRAR ROL DE USUARIOS</h2>

                                <h4> Campos Obligatorios (*) </h4>
                                <br>
                                <hr><br>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-sm-4">
                                            <label class="form-label">Cédula de Identidad <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 45px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input style="font-size: 15px; z-index:1 " type=" text" class="form-control" id="ced" name="ced" maxlength="10" size="28" />
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="margin-left: -46px; z-index:2">
                                            <input type="button" class="form-control" style="z-index:2;width: 125px;    height: 36.5px; font-size: 16px; background-color: #46A2FD; color: #fff; border-radius: 0 30px 30px 0; border: none; cursor: pointer; padding: 6px 10px; margin-top: 38px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="none";' onmouseover='this.style.color="rgba(0, 128, 255, 0.5)"; this.style.backgroundColor="#fff"; this.style.border="#46A2FD 2px Solid"; this.style.padding="5px 10px";' onclick="consulta(ced.value)" value="Buscar">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label"> Apellido(s) y Nombre(s) </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="nombre" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"> Nuevo Rol <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 55px"><img src="imagenes/Experiencia.png" alt="" style="max-width: 30px"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="rol_id" onchange="javascript:sel9()">
                                                    <option value='-1'>Seleccione</option>
                                                    <option value='82'>Administrador</option>
                                                    <option value='83'>Registrador</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="espacio" style="display: none"></div>
                                        <div class="col-sm-6" id="estado">
                                            <label class="form-label"> Estado donde Labora <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 55px"><img src="imagenes/Experiencia.png" alt="" style="max-width: 30px"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="entidad_id">
                                                    <option value='-1'>Seleccione</option>
                                                    <?
                                                    $sql = "SELECT * FROM public.entidad WHERE nenabled = 1 ORDER BY nentidad ASC";
                                                    $row = pg_query($conn, $sql);
                                                    $persona = pg_fetch_all($row);
                                                    foreach ($persona as $u) {
                                                    ?>
                                                        <option value="<? echo $u['nentidad']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-2" id="btn_register">
                                            <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_rol(ced.value,entidad_id.value,rol_id.value)">Asignar</button>
                                        </div>
                                        <div class="col-sm-2" id="btn_admin" style="display: none">
                                            <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_rol2(ced.value,rol_id.value)">Asignar</button>
                                        </div>
                                        <div class="col-sm-2" id="btn_del">
                                            <button type="button" style="background-color: #DC3831; color: #fff; border: 1px Solid #DC3831; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#DC3831"; this.style.border="1px Solid #DC3831"' onmouseover='this.style.color="#DC3831"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_rol3(ced.value,rol_id.value)">Inhabilitar</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="vista.php">
                                                <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px; margin-left: 18px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button>
                                            </a>
                                        </div>
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
<footer style="margin-top:15%">
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
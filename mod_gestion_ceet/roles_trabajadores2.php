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
                <div class="col-sm-2"></div>
                <div class="content-title col-sm-8">
                    <div class="favicon">
                        <img src="imagenes/logo.png" class="img-favicon">
                    </div>
                    <h1 class="card-h1"> Centro de Encuentro para la Educación y Trabajo (CEET) </h1>
                </div>
                <!-- Parte 1 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-8 fondo">
                            <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> ADMINISTRAR ROL DE USUARIOS </h3>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-6">
                                            <label class="form-label"> Cédula </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="cedula" onkeyup="mayus(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label"> Nombre </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" aria-describedby="basic-addon1" id="name" onkeyup="mayus(this);" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"> Módulos <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 55px"><img src="imagenes/Experiencia.png" alt="" style="max-width: 30px"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="modulos" onchange="javascript:sel5()" readonly>
                                                    <?
                                                    $sql = "SELECT * FROM public.modulo WHERE senabled = 1 AND id=44";
                                                    $row = pg_query($conn, $sql);
                                                    $persona = pg_fetch_all($row);
                                                    foreach ($persona as $u) {
                                                    ?>
                                                        <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label"> Estado <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 55px"><img src="imagenes/Experiencia.png" alt="" style="max-width: 30px"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="estado" onchange="javascript:sel5()">
                                                    <?
                                                    $sql = "SELECT * FROM public.entidad WHERE nenabled = 1 ORDER BY nentidad ASC";
                                                    $row = pg_query($conn, $sql);
                                                    $persona = pg_fetch_all($row);
                                                    foreach ($persona as $u) {
                                                    ?>
                                                        <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <label class="form-label"> Nuevo Rol <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 55px"><img src="imagenes/Experiencia.png" alt="" style="max-width: 30px"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="rol" onchange="javascript:sel5()">
                                                    <?
                                                    $sql = "SELECT * FROM public.rol WHERE nenabled = 1 AND id=82 OR id=83";
                                                    $row = pg_query($conn, $sql);
                                                    $persona = pg_fetch_all($row);
                                                    foreach ($persona as $u) {
                                                    ?>
                                                        <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="btn_act">
                                            <input type="text" class="form-control" aria-describedby="basic-addon1" id="trabajador_id" style="display: none">
                                            <button type="submit" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_trabajador_act(cedula.value,modulos.value,estado.value,rol.value)">Modificar</button>
                                        </div>
                                        <?
                                        $sql2 = "SELECT id, cedula, (primer_apellido||' '||segundo_apellido||' '||primer_nombre||' '||segundo_nombre) AS descripcion FROM personales WHERE nenabled = 1 ORDER BY primer_apellido LIMIT 500";
                                        $row2 = pg_query($conn, $sql2);
                                        ?>
                                        <div class="col-sm-12">
                                            <table id="example" class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Cédula</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <? $i = 0;
                                                    while ($persona2 = pg_fetch_assoc($row2)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><? echo $i; ?></td>
                                                            <td><? echo $persona2['cedula']; ?></td>
                                                            <td><? echo $persona2['descripcion'] ?></td>
                                                            <td id="botones">
                                                                <button type="button" class="btn btn-warning" style="background-color: #e99002; border-radius: 30px;" onclick="accion_trabajador_mod('<? echo $persona2['id']; ?>','<? echo $persona2['cedula']; ?>','<? echo $persona2['descripcion']; ?>')">Seleccionar</button>
                                                            </td>
                                                        </tr>
                                                    <? } ?>
                                                </tbody>
                                            </table>
                                            <center>
                                                <a href="../mod_gestion_ceet/vista.php">
                                                    <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button>
                                                </a>
                                            </center>
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
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color: white;">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6" style="border-right: 1px solid white;">
                                    <h3 class="sep-3" style="font-size: 16px">Viceministerio para la Educación y el Trabajo para la Liberación</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                                    <h3 style="font-size: 16px">Análisis y Desarrollo de Sistemas.</h3>
                                    <h3 style="font-size: 16px">© 2023 Todos los Derechos Reservados.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Link's -->
    <script src="javascript/trabajador.js"></script>

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

</html>
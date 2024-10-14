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
                    <h1 class="card-h1" style="font-size: 26px"> Reporte de Gestión del Centro de Encuentro para la Educación y Trabajo (CEET) </h1>
                </div>
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
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Parte 1 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-8 fondo">
                            <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> DATOS DE LA ENTIDAD DE TRABAJO </h3>
                            </div>
                            <div class="card-body">
                                <h4> Campos Obligatorios (*) </h4>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-9">
                                            <label class="form-label"> Motivo </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" placeholder="Ej. Aborda Viejo" aria-describedby="basic-addon1" id="motivo" onkeyup="mayus(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="boton_reportar">
                                            <button onclick="accion_motivo(motivo.value)" id="motivo_agr" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                Agregar
                                            </button>
                                            <button type="button" style="display: none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_motivo_act(motivo_id.value,motivo.value)" id="motivo_act">
                                                Actualizar
                                            </button>
                                            <input type="button" type="text" class="form-control" aria-describedby="basic-addon1" id="motivo_id" style="display: none">
                                        </div>
                                        <?
                                        $sql = "SELECT * FROM reporte_ceet.motivo_visita WHERE benabled = 'TRUE' ORDER BY sdescripcion";
                                        $row = pg_query($conn, $sql);
                                        ?>
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nombre del Motivo</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fe">
                                                    <? $i = 0;
                                                    while ($persona = pg_fetch_assoc($row)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><? echo $i; ?></td>
                                                            <td><? echo $persona['sdescripcion']; ?></td>
                                                            <td id="botones">
                                                                <button type="button" class="btn btn-warning" style="background-color: #e99002; border-radius: 30px;" onclick="accion_motivo_modificar('<? echo $persona['id']; ?>','<? echo $persona['sdescripcion']; ?>')">Modificar</button>
                                                                <button type="button" class="btn btn-danger" style="background-color: #f04124; border-radius: 30px;" onclick="accion_motivo_eliminar(<? echo $persona['id']; ?>)">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    <? } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Parte 2 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-8 fondo">
                            <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> PLAN FORMACIÓN </h3>
                            </div>
                            <div class="card-body">
                                <h4> Campos Obligatorios (*) </h4>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-9">
                                            <label class="form-label"> Plan Formación </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" placeholder="Ej. Aborda Viejo" aria-describedby="basic-addon1" id="plan" onkeyup="mayus(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="boton_reportar">
                                            <button onclick="accion_plan(plan.value)" id="plan_agr" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                Agregar
                                            </button>
                                            <button type="button" style="display: none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_plan_act(plan_id.value,plan.value)" id="plan_act">
                                                Actualizar
                                            </button>
                                            <input type="button" type="text" class="form-control" aria-describedby="basic-addon1" id="plan_id" style="display: none">
                                        </div>
                                        <?
                                        $sql = "SELECT * FROM reporte_ceet.plan_formacion WHERE benabled = 'TRUE' ORDER BY sdescripcion";
                                        $row = pg_query($conn, $sql);
                                        ?>
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col" style="width: 67.5%;">Nombre del Plan</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fe2">
                                                    <? $i = 0;
                                                    while ($persona = pg_fetch_assoc($row)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><? echo $i; ?></td>
                                                            <td><? echo $persona['sdescripcion']; ?></td>
                                                            <td id="botones">
                                                                <button type="button" class="btn btn-warning" style="background-color: #e99002; border-radius: 30px;" onclick="accion_plan_modificar('<? echo $persona['id']; ?>','<? echo $persona['sdescripcion']; ?>')">Modificar</button>
                                                                <button type="button" class="btn btn-danger" style="background-color: #f04124; border-radius: 30px;" onclick="accion_plan_eliminar(<? echo $persona['id']; ?>)">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    <? } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Parte 3 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-8 fondo">
                            <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> NOVEDADES </h3>
                            </div>
                            <div class="card-body">
                                <h4> Campos Obligatorios (*) </h4>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-9">
                                            <label class="form-label"> Novedades </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" placeholder="Ej. Aborda Viejo" aria-describedby="basic-addon1" id="novedad" onkeyup="mayus(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="boton_reportar">
                                            <button onclick="accion_novedad(novedad.value)" id="novedad_agr" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                Agregar
                                            </button>
                                            <button type="button" style="display: none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_novedad_act(novedad_id.value,novedad.value)" id="novedad_act">
                                                Actualizar
                                            </button>
                                            <input type="button" type="text" class="form-control" aria-describedby="basic-addon1" id="novedad_id" style="display: none">
                                        </div>
                                        <?
                                        $sql = "SELECT * FROM reporte_ceet.novedades WHERE benabled = 'TRUE' ORDER BY sdescripcion";
                                        $row = pg_query($conn, $sql);
                                        ?>
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col" style="width: 67.5%;">Nombre de la Novedad</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fe3">
                                                    <? $i = 0;
                                                    while ($persona = pg_fetch_assoc($row)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><? echo $i; ?></td>
                                                            <td><? echo $persona['sdescripcion']; ?></td>
                                                            <td id="botones">
                                                                <button type="button" class="btn btn-warning" style="background-color: #e99002; border-radius: 30px;" onclick="accion_novedad_modificar('<? echo $persona['id']; ?>','<? echo $persona['sdescripcion']; ?>')">Modificar</button>
                                                                <button type="button" class="btn btn-danger" style="background-color: #f04124; border-radius: 30px;" onclick="accion_novedad_eliminar(<? echo $persona['id']; ?>)">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    <? } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Parte 4 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-8 fondo">
                            <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> MOTORES </h3>
                            </div>
                            <div class="card-body">
                                <h4> Campos Obligatorios (*) </h4>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-9">
                                            <label class="form-label"> Motores </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" placeholder="Ej. Aborda Viejo" aria-describedby="basic-addon1" id="motor" onkeyup="mayus(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="boton_reportar">
                                            <button onclick="accion_motor(motor.value)" id="motor_agr" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                Agregar
                                            </button>
                                            <button type="button" style="display: none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_motor_act(motor_id.value,motor.value)" id="motor_act">
                                                Actualizar
                                            </button>
                                            <input type="button" type="text" class="form-control" aria-describedby="basic-addon1" id="motor_id" style="display: none">
                                        </div>
                                        <?
                                        $sql = "SELECT * FROM reporte_ceet.motor WHERE benabled = 'TRUE' ORDER BY sdescripcion";
                                        $row = pg_query($conn, $sql);
                                        ?>
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col" style="width: 67.5%;">Nombre del Motor</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fe4">
                                                    <? $i = 0;
                                                    while ($persona = pg_fetch_assoc($row)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><? echo $i; ?></td>
                                                            <td><? echo $persona['sdescripcion']; ?></td>
                                                            <td id="botones">
                                                                <button type="button" class="btn btn-warning" style="background-color: #e99002; border-radius: 30px;" onclick="accion_motor_modificar('<? echo $persona['id']; ?>','<? echo $persona['sdescripcion']; ?>')">Modificar</button>
                                                                <button type="button" class="btn btn-danger" style="background-color: #f04124; border-radius: 30px;" onclick="accion_motor_eliminar(<? echo $persona['id']; ?>)">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    <? } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Parte 5 -->
                <div class="col-md-12 sep-y">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-8 fondo">
                            <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> AMBIENTE APRENDIZAJE </h3>
                            </div>
                            <div class="card-body">
                                <h4> Campos Obligatorios (*) </h4>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-9">
                                            <label class="form-label"> Ambiente Aprendizaje </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="max-width: 47.5px"><img src="imagenes/Hombre.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                <input type="text" class="form-control" placeholder="Ej. Aborda Viejo" aria-describedby="basic-addon1" id="ambiente" onkeyup="mayus(this);">
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="boton_reportar">
                                            <button onclick="accion_ambiente(ambiente.value)" id="ambiente_agr" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                Agregar
                                            </button>
                                            <button type="button" style="display: none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_ambiente_act(ambiente_id.value,ambiente.value)" id="ambiente_act">
                                                Actualizar
                                            </button>
                                            <input type="button" type="text" class="form-control" aria-describedby="basic-addon1" id="ambiente_id" style="display: none">
                                        </div>
                                        <?
                                        $sql = "SELECT * FROM reporte_ceet.ambiente_aprendizaje WHERE benabled = 'TRUE' ORDER BY sdescripcion";
                                        $row = pg_query($conn, $sql);
                                        ?>
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col" style="width: 67.5%;">Nombre del Ambiente de Aprendizaje</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="fe5">
                                                    <? $i = 0;
                                                    while ($persona = pg_fetch_assoc($row)) {
                                                        $i++;
                                                    ?>
                                                        <tr>
                                                            <td><? echo $i; ?></td>
                                                            <td><? echo $persona['sdescripcion']; ?></td>
                                                            <td id="botones">
                                                                <button type="button" class="btn btn-warning" style="background-color: #e99002; border-radius: 30px;" onclick="accion_ambiente_modificar('<? echo $persona['id']; ?>','<? echo $persona['sdescripcion']; ?>')">Modificar</button>
                                                                <button type="button" class="btn btn-danger" style="background-color: #f04124; border-radius: 30px;" onclick="accion_ambiente_eliminar(<? echo $persona['id']; ?>)">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    <? } ?>
                                                </tbody>
                                            </table>
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
                                    <h3 class="sep-3" style="font-size: 16px; margin-left: 140px; width: 100%">Viceministerio para la Educación y el Trabajo para la Liberación</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                                    <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
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
    <script src="javascript/motivo_visita.js"></script>
    <script src="javascript/plan_formacion.js"></script>
    <script src="javascript/novedades.js"></script>
    <script src="javascript/motores.js"></script>
    <script src="javascript/ambiente_aprendizaje.js"></script>

    <script src="javascript/mayus.js"></script>

    <script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
</body>

</html>
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
                <!--  <div class="col-sm-2"></div>
                <div class="content-title col-sm-8">
                    <div class="favicon">
                        <img src="imagenes/logo.png" class="img-favicon">
                    </div>
                    <h1 class="card-h1" style="font-size: 26px"> Reporte de Gestión del Centro de Encuentro para la Educación y Trabajo (CEET) </h1>
                </div>
 -->
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
                            <!-- <div class="card-header" style=" border-radius:0 0 0 0; padding: 20px 0 10px 20px">
                                <h3 class="card-title"> DATOS DE LA ENTIDAD DE TRABAJO </h3>
                            </div> -->

                            <div class="card-body">
                                <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">DATOS DE LA ENTIDAD DE TRABAJO</h2>
                                <h4> Campos Obligatorios (*) </h4>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div class="col-sm-6">
                                            <label class="form-label"> Abordaje <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Experiencia.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" id="Trabajador" aria-label="Default select example" style="border-radius: 0 30px 30px 0" onchange="javascript:sel6()">
                                                    <option value="-1" selected> Seleccione </option>
                                                    <option value="2"> Entidad de Trabajo </option>
                                                    <option value="1"> Trabajador Independiente </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="inv" style="display: none;"></div>
                                        <div class="col-6" id="nacionalidad" style="display: none;">
                                            <label class="form-label"> Nacionalidad <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/ci.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="n_nacionalidad">
                                                    <option value="-1" selected> Seleccione </option>
                                                    <option value="V">Venezolano(a)</option>
                                                    <option value="E">Extranjero(a)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4" id="cedula" style="display: none;">
                                            <label class="form-label"> Cédula de Identidad <span class="requid"> * </span></label>
                                            <div class="input-group mb-3" style="border-radius: 0; width:318px;">
                                                <span class="input-group-text" id="basic-addon1" style="width: 40px;"><img src="imagenes/ci.png" alt="" style="height: 20px;"></span>
                                                <input type="text" class="form-control" placeholder="Cédula de Identidad" aria-label="Cédula de Identidad" aria-describedby="basic-addon1" id="personales_cedula" maxlength="8" style="border-radius:0;z-index:2;">
                                            </div>
                                        </div>
                                        <div class="col-sm-2" id="buscar_saime" style="z-index:2;display: none;">
                                            <!-- <input type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 30px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_buscar(n_nacionalidad.value,personales_cedula.value)" id="buscar"> -->
                                            <button onclick="accion_buscar(n_nacionalidad.value,personales_cedula.value)" id="buscar" type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-top: 38px;height:38px;z-index:3;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-6" id="nombre1" style="display: none;">
                                            <label class="form-label"> Primer Nombre <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                <input type="text" class="form-control" placeholder="Primer Nombre" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="p_nombre" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6" id="nombre2" style="display: none;">
                                            <label class="form-label"> Segundo Nombre </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                <input type="text" class="form-control" placeholder="Segundo Nombre" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="s_nombre" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6" id="apellido1" style="display: none;">
                                            <label class="form-label"> Primer Apellido <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                <input type="text" class="form-control" placeholder="Primer Apellido" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="p_apellido" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6" id="apellido2" style="display: none;">
                                            <label class="form-label"> Segundo Apellido </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                <input type="text" class="form-control" placeholder="Segundo Apellido" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="s_apellido" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6" id="sexo2" style="display: none;">
                                            <label class="form-label"> Sexo <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/ci.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="sexo">
                                                    <option value="-1" selected> Seleccione </option>
                                                    <option value="M"> Hombre </option>
                                                    <option value="F"> Mujer </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6" id="contacto" style="display: none;">
                                            <label class="form-label"> Teléfono Personal <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/telefono-inteligente.png" alt="" style="max-height: 40px;"></span>
                                                <input type="text" class="form-control" placeholder="Nro. Contacto" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="stelefono_personal" maxlength="11">
                                            </div>
                                        </div>
                                        <div class="col-6" id="rif" style="display: none;">
                                            <label class="form-label"> Registro de Información Fiscal (RIF) <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1" style="height: 40px;"><img src="imagenes/Rif.png" alt="" style="max-height: 40px;"></span>
                                                <input type="text" class="form-control" style="height: 40px;" placeholder="J123456789" id="srif" onkeyup="convertirAMayusculas()" minlength="8" maxlength="10" oninput="contarCaracteres()"><span style="display:none;" id="contador">0</span>

                                                <button onclick="accion_buscar_empresa(srif.value)" id="buscar_empresa" type="button" class="btn btn-outline-primary" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 0 30px 30px 0; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";'>
                                                    Buscar
                                                </button>
                                            </div>
                                            <script>
                                          function validarEntrada(event) {
            const teclaPresionada = event.key;
            const caracteresPermitidos = /^[a-zA-Z0-9]$/;

            if (!caracteresPermitidos.test(teclaPresionada)) {
                event.preventDefault(); // Evita que se ingrese el carácter no permitido
            }
        }
const miInput = document.getElementById('srif'); // Cambia 'miInput' por el ID de tu input
srif.addEventListener('keypress', validarEntrada);

</script>
                                        </div>
                                        <div class="col-sm-6" id="nombre_razon_social" style="display: none;">
                                            <label class="form-label"> Nombre o Razón Social <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/i.png" alt="" style="max-height: 40px;"></span>
                                                <input disabled type="text" class="form-control" placeholder="Nombre o Razón Social" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="srazon_social">
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="denominacion_comercial" style="display: none;">
                                            <label class="form-label"> Denominación Comercial <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Comercio.png" alt="" style="max-height: 40px;"></span>
                                                <input disabled type="text" class="form-control" placeholder="Denominación Comercial" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="sdenominacion_comercial">
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="tipo_capital" style="display: none;">
                                            <label class="form-label"> Tipo de Capital <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Capital.png" alt="" style="max-height: 40px;"></span>

                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="stipo_capital">
                                                    <option value="-1" selected> </option>
                                                    <?
                                                    $sql_e = "SELECT * FROM reporte_ceet.tipo_capital WHERE nenabled = 1 ORDER BY sdescripcion ASC";
                                                    $row_e = pg_query($conn, $sql_e);
                                                    $estado = pg_fetch_all($row_e);
                                                    foreach ($estado as $u) {
                                                    ?>
                                                        <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="estado" style="display: none;">
                                            <label class="form-label"> Estado <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/ciudadania1.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="entidad_nentidad" onchange="accion_estado(entidad_nentidad.value)">
                                                    <option value="-1" selected> Seleccione </option>
                                                    <?
                                                    $sql_e = "SELECT * FROM public.entidad WHERE nenabled = 1 ORDER BY sdescripcion ASC";
                                                    $row_e = pg_query($conn, $sql_e);
                                                    $estado = pg_fetch_all($row_e);
                                                    foreach ($estado as $u) {
                                                    ?>
                                                        <option value="<? echo $u['nentidad']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="municipio" style="display: none;">
                                            <label class="form-label"> Municipio <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Municipio.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="municipio_nmunicipio" onchange="accion_municipio(municipio_nmunicipio.value)">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" id="parroquia" style="display: none;">
                                            <label class="form-label"> Parroquia <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/parroquia.png" alt="" style="max-height: 30px;margin-left: 15px;max-width: 30px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="parroquia_nparroquia">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="estado2" style="display: none;">
                                            <label class="form-label"> Estado <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/ciudadania1.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="entidad_nentidad2" onchange="accion_estado2(entidad_nentidad2.value)">
                                                    <option value="-1" selected> </option>
                                                    <?
                                                    $sql_e = "SELECT * FROM public.entidad WHERE nenabled = 1 ORDER BY sdescripcion ASC";
                                                    $row_e = pg_query($conn, $sql_e);
                                                    $estado = pg_fetch_all($row_e);
                                                    foreach ($estado as $u) {
                                                    ?>
                                                        <option value="<? echo $u['nentidad']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="municipio2" style="display: none;">
                                            <label class="form-label"> Municipio <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/Municipio.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="municipio_nmunicipio2" onchange="accion_municipio2(municipio_nmunicipio2.value)">
                                                    <option value="-1" selected> </option>
                                                    <?
                                                    $sql_e = "SELECT * FROM public.municipio WHERE nenabled = 1 ORDER BY sdescripcion ASC";
                                                    $row_e = pg_query($conn, $sql_e);
                                                    $estado = pg_fetch_all($row_e);
                                                    foreach ($estado as $u) {
                                                    ?>
                                                        <option value="<? echo $u['nmunicipio']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" id="parroquia2" style="display: none;">
                                            <label class="form-label"> Parroquia <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/parroquia.png" alt="" style="max-height: 40px;"></span>
                                                <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="parroquia_nparroquia2">
                                                    <option value="-1" selected> </option>
                                                    <?
                                                    $sql_e = "SELECT * FROM public.parroquia WHERE nenabled = 1 ORDER BY sdescripcion ASC";
                                                    $row_e = pg_query($conn, $sql_e);
                                                    $estado = pg_fetch_all($row_e);
                                                    foreach ($estado as $u) {
                                                    ?>
                                                        <option value="<? echo $u['nparroquia']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                    <?
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12" id="NIL" style="display: none;">
                                            <label class="form-label"> Número de Información Laboral (NIL) </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><img src="imagenes/puesto2.png" alt="" style="max-height: 40px;"></span>
                                                <input disabled type="text" class="form-control" placeholder="Número de Información Laboral" aria-label="Nombre de usuario" aria-describedby="basic-addon1" id="snil">
                                            </div>
                                        </div>

                                        <div class="col-12" id="actividad_desempeño" style="display: none;">
                                            <label class="form-label"> Actividad Económica que Desempeña <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" style="border-radius: 30px;" id="actividad_economica" onkeyup="convertirAMayusculas()"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12" id="actividad_desempeño2" style="display: none;">
                                            <label class="form-label"> Actividad Económica que Desempeña <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <textarea disabled class="form-control" style="border-radius: 30px;" id="actividad_economica2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" id="direccion_fiscal" style="display: none;">
                                            <label class="form-label"> Dirección Fiscal <span class="requid"> * </span></label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" style="border-radius: 30px;" disabled id="sdireccion_fiscal"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12" id="motor25" style="display: none;">
                                            <div class="sasa" id="motor" style="display: none;">
                                                <label class="form-label"> Motor <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/puesto3.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="motor_id">
                                                        <option value="-1" selected>Seleccione</option>
                                                        <option value="0" style="display:none;" selected></option>
                                                        <?
                                                        $sql4 = "SELECT * FROM reporte_ceet.motor WHERE benabled = 'true'";
                                                        $row4 = pg_query($conn, $sql4);
                                                        $persona4 = pg_fetch_all($row4);
                                                        foreach ($persona4 as $u) {
                                                        ?>
                                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                        <?
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <center>
                                            <div class="col-sm-3" id="guard_btn" style="display: none;">
                                                <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_guardar(n_nacionalidad.value,personales_cedula.value,p_nombre.value,s_nombre.value,p_apellido.value,s_apellido.value,stelefono_personal.value,sexo.value,entidad_nentidad.value,municipio_nmunicipio.value,parroquia_nparroquia.value,motor_id.value,actividad_economica.value)" id="guardar">Guardar</button>
                                            </div>
                                        </center>
                                        <center>
                                            <div class="col-sm-3" id="guard_btn2" style="display: none;">
                                                <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_guardar3(srif.value,srazon_social.value,sdenominacion_comercial.value,stipo_capital.value,entidad_nentidad2.value,municipio_nmunicipio2.value,parroquia_nparroquia2.value,snil.value,motor_id.value,actividad_economica2.value,sdireccion_fiscal.value)" id="guardar">Guardar</button>
                                            </div>
                                        </center>
                                        <center>
                                            <div class="col-sm-3" id="guard_btn3" style="display: none;">
                                                <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="agg(srif.value,srazon_social.value,sdenominacion_comercial.value,stipo_capital.value,entidad_nentidad2.value,municipio_nmunicipio2.value,parroquia_nparroquia2.value,snil.value,actividad_economica2.value,sdireccion_fiscal.value)" id="guardar1">Registrar</button>
                                            </div>
                                        </center>
                                        <div class="col-sm-12" id="regla" style="display: none;">
                                            <hr>
                                        </div>
                                        <br>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-12" id="asa" style="display:none;">
                                            <div class="col-sm-12" style="display:flex;   ">
                                                <div class="col-sm-7" id="motivo_visita" style="display: none;">
                                                    <label class="form-label"> Motivo de Visita <span class="requid"> * </span></label>
                                                    <div class="input-group mb-3" style="height: 46px;">
                                                        <span class="input-group-text" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="max-height: 40px; max-width: 40px"></span>
                                                        <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="motivo" onchange="javascript:sel6()">
                                                            <option value="-1" selected> Seleccione </option>
                                                            <?
                                                            $sql = "SELECT * FROM reporte_ceet.motivo_visita WHERE benabled = 'TRUE'";
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
                                                <div class="col-sm-8" id="motivo_visita2" style="display: none;">
                                                    <label class="form-label"> Motivo de Visita <span class="requid"> * </span></label>
                                                    <div class="input-group mb-3" style="height: 46px;">
                                                        <span class="input-group-text" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="max-height: 40px; max-width: 40px"></span>
                                                        <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="motivo2" onchange="javascript:sel6()">
                                                            <option value="-1" selected> Seleccione </option>
                                                            <?
                                                            $sql = "SELECT * FROM reporte_ceet.motivo_visita WHERE benabled = 'TRUE'";
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
                                                <div class="col-sm-3" id="boton_reportar" style="display: none;  padding-top: 36px;">
                                                    <button onclick="accion_motivo(motivo.value,n_nacionalidad.value,personales_cedula.value)" id="motivo_agr" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                        Agregar Motivo
                                                    </button>
                                                </div>
                                                <div class="col-sm-4" id="boton_reportar2" style="display: none;  padding-top: 36px;">
                                                    <button onclick="accion_motivo_empresa(motivo2.value,srif.value)" id="motivo_agr2" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; " onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                        Agregar Motivo
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-12" id="tabla_motivo" style="display: none">
                                                <table class="table table-striped table-hover" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Descripción</th>
                                                            <th scope="col">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="fe">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12" id="tabla_motivo2" style="display: none">
                                                <table class="table table-striped table-hover" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Descripción</th>
                                                            <th scope="col">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="fe01">
                                                    </tbody>
                                                </table>
                                            </div>

                                            <center>
                                                <a href="../mod_gestion_ceet/vista.php" id="btn_regre">
                                                    <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button>
                                                </a>
                                            </center>
                                        </div>

                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- Parte visible tras buscar al Usuario -->
                <div id="todo" style="display: none">
                    <!-- Parte 2 -->
                    <div class="col-md-12 sep-y">
                        <div class="jumbotron">
                            <form method="POST" action="" class="col-md-8 fondo">

                                <div class="card-body">
                                    <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">AUTOFORMACIÓN</h2>
                                    <div class="container">
                                        <div class="row justify-content-start">
                                            <div class="col-sm-12">
                                                <center>
                                                    <label class="form-label"> Responsable de Formación de la Entidad de Trabajo </label>
                                                </center>
                                            </div>
                                            <hr style="margin: 15px 0">
                                            <div class="col-6">
                                                <label class="form-label"> Nombre(s) <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <input type="text" class="form-control" placeholder="Ej. Omar Agudelo" aria-describedby="basic-addon1" id="nombres" onkeyup="convertirAMayusculas()">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label"> Apellido(s) <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <input type="text" class="form-control" placeholder="Ej. Omar Agudelo" aria-describedby="basic-addon1" id="apellidos" onkeyup="convertirAMayusculas()">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Teléfono Personal <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Móvil.png" alt="" style="max-height: 40px;"></span>
                                                    <input type="text" class="form-control" placeholder="Ej. 414-5555555" aria-describedby="basic-addon1" id="telf" maxlength="11">
                                                </div>
                                            </div>
                                            <hr style="margin: 10px 0 20px 0">
                                            <div class="col-sm-5">
                                                <label class="form-label" style="  font-size: 20px;"> Ambiente de Formación Aperturado <span class="requid"> * </span></label>
                                                <div class="input-group mb-3" style="height: 46px;">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Ambiente_Formacion" onchange="javascript:sel()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Si </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-5" id="ambiente_aprendizaje" style="display: none;">
                                                <label class="form-label" style="  font-size: 20px;"> Ambiente de Aprendizaje <span class="requid"> * </span></label>
                                                <div class="input-group mb-3" style="margin-top:30px; height:46px">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="max-height: 40px; max-width: 40px"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="aprendizaje">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <?
                                                        $SqL = "SELECT * FROM reporte_ceet.ambiente_aprendizaje WHERE benabled = 'TRUE'";
                                                        $RoW = pg_query($conn, $SqL);
                                                        $PersonA = pg_fetch_all($RoW);
                                                        foreach ($PersonA as $u) {
                                                        ?>
                                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                        <?
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2" id="boton_aprendizaje" style="display: none;">
                                                <button onclick="accion_aprendizaje(aprendizaje.value,n_nacionalidad.value,personales_cedula.value)" id="aprendizaje_agr" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-top: 66px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                    Agregar
                                                </button>
                                            </div>
                                            <div class="col-sm-12" id="op1" style="margin-bottom: 10px; display: none">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Ambiente Aprendizaje</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="fe4">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br><br><br>
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
                                <!-- <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> FORMACIÓN </h3>
                                </div> -->
                                <div class="card-body">
                                    <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">FORMACIÓN</h2><br>
                                    <hr><br>
                                    <div class="container-fluid">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="form-label"> Experiencia Productiva Detectadas <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Experiencia.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Experiencia_Productiva" onchange="javascript:sel2()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Si </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Formación Especializada <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Formacion_CPTT" onchange="javascript:sel3()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Si </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="op7" style="display: none;">
                                                <div class="col-sm-12">
                                                    <label class="form-label"> Plan Formación <span class="requid"> * </span></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1" style="width: 47.5px; max-height: 46px"><img src="imagenes/educacion.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                        <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0; max-height: 46px; width: 45%" id="plan_formacion" onchange="javascript:sel6()">
                                                            <option value="-1" selected> Seleccione </option>
                                                            <?
                                                            $sql2 = "SELECT * FROM reporte_ceet.plan_formacion WHERE benabled = 'TRUE'";
                                                            $row2 = pg_query($conn, $sql2);
                                                            $persona2 = pg_fetch_all($row2);
                                                            foreach ($persona2 as $u) {
                                                            ?>
                                                                <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                            <?
                                                            }
                                                            ?>
                                                        </select>
                                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_plan(plan_formacion.value,n_nacionalidad.value,personales_cedula.value)" id="guardar3">Agregar</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Plan Formación</th>
                                                                <th scope="col">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="fe2">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Inserción Laboral <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Insercion_Laboral" onchange="javascript:sel4()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Inserción </option>
                                                        <option value="2"> Postulación </option>
                                                        <option value="3"> Oferta </option>
                                                        <option value="4"> Ninguna de las anteriores </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-6" id="op8" style="display: none;">
                                                <label class="form-label"> Registro Trabajador </label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control" type="file" id="trabajador_file" name="archivo" style="border-radius: 30px">
                                                </div>
                                            </div> -->
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
                                <!-- <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> CEET </h3>
                                </div> -->
                                <div class="card-body">
                                    <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">CEET</h2><br>
                                    <hr><br>

                                    <div class="container">
                                        <div class="row justify-content-start">
                                            <div class="col-sm-12">
                                                <label class="form-label"> Novedades </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 47.5px; height: 46px"><img src="imagenes/educacion.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0; height: 46px" id="novedades">
                                                        <option selected value="-1"> Seleccione </option>
                                                        <?
                                                        $sql3 = "SELECT * FROM reporte_ceet.novedades WHERE benabled = 'TRUE'";
                                                        $row3 = pg_query($conn, $sql3);
                                                        $persona3 = pg_fetch_all($row3);
                                                        foreach ($persona3 as $u) {
                                                        ?>
                                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                        <?
                                                        }
                                                        ?>
                                                    </select>
                                                    <div id="op5-2">
                                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_novedad(novedades.value,n_nacionalidad.value,personales_cedula.value)" id="guardar4">Agregar Novedad</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" id="op9" style="margin-bottom: 10px; display: none">
                                                <label class="form-label"> Lista de Asistencia del Personal CEET <span class="requid"> * </span></label>
                                                <textarea name="Otra_Novedad" cols="60" class="form-control" id="Otra_Novedad" style="border-radius: 30px"></textarea>
                                            </div>
                                            <div class="col-sm-12" id="op5-1" style="margin-bottom: 10px; display: none">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Novedad</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="fe3">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-6"></div>
                                            <center>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-3">
                                                        <a href="../mod_gestion_ceet/vista.php">
                                                            <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_guardar2(nombres.value,apellidos.value,telf.value,Ambiente_Formacion.value,Experiencia_Productiva.value,Formacion_CPTT.value,Insercion_Laboral.value)" id="guardar">Continuar</button>
                                                    </div>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Parte visible tras buscar a la Empresa -->
                <div id="todo2" style="display: none">
                    <!-- Parte 2 -->
                    <div class="col-md-12 sep-y">
                        <div class="jumbotron">
                            <form method="POST" action="" class="col-md-8 fondo">
                                <!-- <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> AUTOFORMACIÓN </h3>
                                </div> -->
                                <div class="card-body">
                                    <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">AUTOFORMACIÓN</h2>

                                    <div class="container">
                                        <div class="row justify-content-start">
                                            <div class="col-sm-12">
                                                <center>
                                                    <label class="form-label"> Responsable de Formación de la Entidad de Trabajo </label>
                                                </center>
                                            </div>
                                            <hr style="margin: 15px 0">
                                            <div class="col-6">
                                                <label class="form-label"> Nombre(s) <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <input type="text" class="form-control" placeholder="Ej. Omar Agudelo" aria-describedby="basic-addon1" id="nombres2" onkeyup="convertirAMayusculas()">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label"> Apellido(s) <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <input type="text" class="form-control" placeholder="Ej. Omar Agudelo" aria-describedby="basic-addon1" id="apellidos2" onkeyup="convertirAMayusculas()">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Teléfono Personal <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Móvil.png" alt="" style="max-height: 40px;"></span>
                                                    <input type="text" class="form-control" placeholder="Ej. 414-5555555" aria-describedby="basic-addon1" id="telf2" maxlength="11">
                                                </div>
                                            </div>
                                            <hr style="margin: 10px 0 20px 0">
                                            <div class="col-sm-5">
                                                <label class="form-label" style="  font-size: 18px;"> Ambiente de Formación Aperturado <span class="requid"> * </span></label>
                                                <div class="input-group mb-3" style="margin-top:17px;height: 46px;">
                                                    <span class="input-group-text" style="width:54px;" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="height: 22px; width: 22px"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Ambiente_Formacion2" onchange="javascript:emp()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Si </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-7" id="ambiente_aprendizaje2" style="display: none;">
                                                <label class="form-label" style="  font-size: 18px;"> Ambiente de Aprendizaje <span class="requid"> * </span></label>
                                                <div class="input-group mb-3" style="margin-top:17px">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="height: 22px; width: 22px"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="aprendizaje2">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <?
                                                        $SqL = "SELECT * FROM reporte_ceet.ambiente_aprendizaje WHERE benabled = 'TRUE'";
                                                        $RoW = pg_query($conn, $SqL);
                                                        $PersonA = pg_fetch_all($RoW);
                                                        foreach ($PersonA as $u) {
                                                        ?>
                                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                        <?
                                                        }
                                                        ?>
                                                    </select>
                                                    <button onclick="accion_aprendizaje_empresa(aprendizaje2.value,srif.value)" id="aprendizaje_agr2" type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                                                        Agregar
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-2" id="boton_aprendizaje2" style="display: none;">
                                                
                                            </div> -->
                                            <div class="col-sm-12" id="op1-2" style="margin-bottom: 10px; display: none">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Ambiente Aprendizaje</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="fe04">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br><br><br>
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
                                <!-- <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> FORMACIÓN </h3>
                                </div> -->
                                <div class="card-body">
                                    <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">FORMACIÓN</h2>

                                    <div class="container-fluid">
                                        <hr><br>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="form-label"> Experiencia Productiva Detectadas <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Experiencia.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Experiencia_Productiva2" onchange="javascript:sel2()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Si </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Formación Especializada <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/educacion.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Formacion_CPTT2" onchange="javascript:emp2()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Si </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="op7-2" style="display: none;">
                                                <div class="col-sm-12">
                                                    <label class="form-label"> Plan Formación <span class="requid"> * </span></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1" style="width: 47.5px; max-height: 46px"><img src="imagenes/educacion.png" alt="" style="max-height: 20px; max-width: 20px"></span>
                                                        <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0; max-height: 46px; width: 45%" id="plan_formacion2">
                                                            <option value="-1" selected> Seleccione </option>
                                                            <?
                                                            $sql2 = "SELECT * FROM reporte_ceet.plan_formacion WHERE benabled = 'TRUE'";
                                                            $row2 = pg_query($conn, $sql2);
                                                            $persona2 = pg_fetch_all($row2);
                                                            foreach ($persona2 as $u) {
                                                            ?>
                                                                <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                            <?
                                                            }
                                                            ?>
                                                        </select>
                                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_plan_empresa(plan_formacion2.value,srif.value)" id="guardar3">Agregar</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Plan Formación</th>
                                                                <th scope="col">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="fe02">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label"> Inserción Laboral <span class="requid"> * </span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><img src="imagenes/Hombre.png" alt="" style="max-height: 40px;"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0" id="Insercion_Laboral2" onchange="javascript:sel4()">
                                                        <option value="-1" selected> Seleccione </option>
                                                        <option value="1"> Inserción </option>
                                                        <option value="2"> Postulación </option>
                                                        <option value="3"> Oferta </option>
                                                        <option value="4"> Ninguna de las anteriores </option>
                                                    </select>
                                                </div>
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
                                <!--  <div class="card-header bg-primary" style="border-radius: 30px 30px 0 0; padding: 20px 0 10px 20px">
                                    <h3 class="card-title"> CEET </h3>
                                </div> -->
                                <div class="card-body">
                                    <h2 style="color: rgb(35, 96, 249); font-size:22px;padding: 20px 0 10px 20px">CEET</h2>

                                    <div class="container">
                                        <hr><br>
                                        <div class="row justify-content-start">
                                            <div class="col-sm-12">
                                                <label class="form-label"> Novedades </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1" style="width: 47.5px; height: 46px"><img src="imagenes/educacion.png" alt="" style="max-height: 46px; max-width: 20px"></span>
                                                    <select class="form-select" aria-label="Default select example" style="border-radius: 0 30px 30px 0; height: 46px" id="novedades2">
                                                        <option selected value="-1"> Seleccione </option>
                                                        <?
                                                        $sql3 = "SELECT * FROM reporte_ceet.novedades WHERE benabled = 'TRUE'";
                                                        $row3 = pg_query($conn, $sql3);
                                                        $persona3 = pg_fetch_all($row3);
                                                        foreach ($persona3 as $u) {
                                                        ?>
                                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                                        <?
                                                        }
                                                        ?>
                                                    </select>
                                                    <div id="op5-2">
                                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_novedad_empresa(novedades2.value,srif.value)" id="guardar4">Agregar Novedad</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" id="op9" style="margin-bottom: 10px; display: none">
                                                <label class="form-label"> Lista de Asistencia del Personal CEET <span class="requid"> * </span></label>
                                                <textarea name="Otra_Novedad" cols="60" class="form-control" id="Otra_Novedad" style="border-radius: 30px"></textarea>
                                            </div>
                                            <div class="col-sm-12" style="margin-bottom: 10px;">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Novedad</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="fe03">
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-6"></div>
                                            <center>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-3">
                                                        <a href="../mod_gestion_ceet/vista.php">
                                                            <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto; margin-bottom: 20px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" onclick="accion_guardar4(nombres2.value,apellidos2.value,telf2.value,Ambiente_Formacion2.value,Experiencia_Productiva2.value,Formacion_CPTT2.value,Insercion_Laboral2.value,srif.value)" id="guardar2">Continuar</button>
                                                    </div>
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
        </div>
    </main>
    <!-- Footer -->


    <script>
        /*   document.addEventListener("DOMContentLoaded", function() {
            var input = document.getElementById('srif');

            input.addEventListener('keypress', function(e) {
                // Verifica si el evento es un número (del 0 al 9)
                var char = String.fromCharCode(e.which);
                if (!(/[0-9]/.test(char))) {
                    e.preventDefault();
                }
            });
        }); */
        document.getElementById('srif').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
        document.getElementById('srazon_social').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
        document.getElementById('sdenominacion_comercial').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
        document.getElementById('actividad_economica2').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
        document.getElementById('sdireccion_fiscal').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>

    <!-- JavaScript Link's -->

    <script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>

    <script src="javascript/interaccion.js"></script>

    <script src="javascript/motivo4.js"></script>
    <script src="javascript/motivo5.js"></script>
    <script src="javascript/motivo_empresa.js"></script>
    <script src="javascript/motivo_empresa2.js"></script>

    <script src="javascript/guardar1.js"></script>
    <script src="javascript/guardar2.js"></script>
    <script src="javascript/guardar3.js"></script>
    <script src="javascript/guardar4.js"></script>
    <script src="javascript/agg.js"></script>

    <script src="javascript/plan4.js"></script>
    <script src="javascript/plan5.js"></script>
    <script src="javascript/plan_empresa.js"></script>
    <script src="javascript/plan_empresa2.js"></script>

    <script src="javascript/novedad4.js"></script>
    <script src="javascript/novedad5.js"></script>
    <script src="javascript/novedad_empresa.js"></script>
    <script src="javascript/novedad_empresa2.js"></script>

    <script src="javascript/aprendizaje4.js"></script>
    <script src="javascript/aprendizaje5.js"></script>
    <script src="javascript/aprendizaje_empresa.js"></script>
    <script src="javascript/aprendizaje_empresa2.js"></script>

    <script src="javascript/buscar.js"></script>
    <script src="javascript/buscar_empresa.js"></script>
    <script src="javascript/busqueda.js"></script>

    <script src="javascript/mayus.js"></script>
    <script src="javascript/numbers.js"></script>

    <script>
        const input = document.querySelector("#personales_cedula");

        input.addEventListener("input", () => {
            // Verifica si el valor del input es un número
            const valor = input.value;
            const esNumero = /^\d+$/.test(valor);

            // Si el valor no es un número, lo borra
            if (!esNumero) {
                input.value = "";
            }
        });
        const input2 = document.querySelector("#stelefono_personal");

        input.addEventListener("input", () => {
            // Verifica si el valor del input es un número
            const valor2 = input.value;
            const esNumero2 = /^\d+$/.test(valor2);

            // Si el valor no es un número, lo borra
            if (!esNumero2) {
                input.value = "";
            }
        });
    </script>

    <!-- <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script> -->
</body>
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

</html>
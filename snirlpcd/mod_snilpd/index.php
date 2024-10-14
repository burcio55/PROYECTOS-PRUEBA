<?
session_start();
include('../include/BD.php');
$conn = Conexion::ConexionBD();

$host = "10.46.1.93";
$dbname = "minpptrasse";
$user = "postgres";
$pass = "postgres";

try {
    $conex = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
} catch (PDOException $error) {
    $conex = $error;
    echo ("1 / Error al conectar en la Base de Datos " . $error);
}

if (isset($_SESSION['ncedula'])) {

    $id = $_SESSION['ncedula'];

    $consulta = ("SELECT * FROM snirlpcd.persona WHERE ncedula = '" . $id . "';");
    $row = pg_query($conex, $consulta);
    $persona = pg_fetch_assoc($row);
    /*$persona = $conn->Execute($sentencia);*/
    $persona_id = $persona["id"];
}
include('header.php');


$select = ("SELECT * FROM snirlpcd.persona_fotos WHERE persona_id = '" . $persona_id . "' and beneabled = 'true';");
$row2 = pg_query($conn, $select);
$persona2 = pg_fetch_assoc($row2);
$img = 0;
if ($persona2 != '') {
    $img = 1;
    $direccion = $persona2["nombre_foto"];
}
$nombre = strtoupper($persona['sprimer_nombre']) . " ";
$nombre .= strtoupper($persona['sprimer_apellido']);
?>
<!-- Video -->
<div class="content-video2 video">
    <video src="../videos/video_portada.mp4" class="video" controls>
        <!-- <source src="videos/video_prueba.mp4" type="video/mp4"> -->
    </video>
</div>
<div class="col-sm-12">
    <div class="jumbotron bienvenida" style="border-radius: 30px;">
        <? if ($persona['ssexo'] == '2' || $persona['ssexo'] == 'M') { ?>
            <h1 tabindex="7" class="display-5 h1-titulo"><?php echo "BIENVENIDO " . $nombre; ?> </h1>
            <? if ($img == 1) { ?>
                <img src="<? echo $direccion; ?>" class="img-titulo">
            <? } else { ?>
                <img src="../imagenes/hombre.png" class="img-titulo">
            <? } ?>
        <? } else  if ($persona['ssexo'] == '1' || $persona['ssexo'] == 'F') { ?>
            <h1 tabindex="7" class="display-5 h1-titulo"><?php echo "BIENVENIDA " . $nombre; ?> </h1>
            <? if ($img == 1) { ?>
                <img src="<? echo $direccion; ?>" class="img-titulo">
            <? } else { ?>
                <img src="../imagenes/mujer.png" class="img-titulo">
            <? } ?>
        <? } else if ($persona == NULL) { ?>
            <h1 tabindex="7" class="display-5 h1-titulo"><?php echo "BIENVENIDO USUARIO" ?> </h1>
            <img src="../imagenes/avatar.png" class="img-titulo">
        <? } ?>
        <hr class="my-2">
        <!--h6 style="text-align: left;"> Fecha 05-12-2022 / Hora 12:15 pm</h6-->
        <h6 tabindex="8" style="text-align: center;"> Hoy es: <span id="dia"></span>-<span id="mes"></span>-<span id="year"></span> / Hora: <span id="horas"></span>:<span id="minutos"></span> <span id="segundos"></span> <span id="ap"></span> / C.I: <? echo $id; ?></h6>
        <!--h6 style="text-align: right;"> Fecha 05-12-2022 / Hora 12:15 pm</h6-->
    </div>
</div>

<div class="col-md-4 animado4" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="9" aria-label="imagen datos personales" class="card-img-top" src="../FOTOS/c.png" style="height: 275px"><!-- decimo datos personales(1) -->
        <div class="card-body">
            <h4 tabindex="10" class="card-header" style="color: #312E33;">Datos Personales</h4>
            <br>
            <a href="datos_personales.php">
                <button tabindex="11" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado5" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="12" aria-label="imagen discapacidad" class="card-img-top" src="../FOTOS/e.png" style="height: 275px"><!-- decimo segundo discapaciad -->
        <div class="card-body">
            <h4 tabindex="13" class="card-header" style="color: #312E33;">Discapacidad</h4>
            <br>
            <a href="discapacidad.php">
                <button tabindex="14" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado3" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="15" aria-label="imagen educación" class="card-img-top" src="../FOTOS/a.png" style="height: 275px"><!-- decimo primero educacion -->
        <div class="card-body">
            <h4 tabindex="16" class="card-header" style="color: #312E33;">Educación</h4>
            <br>
            <a href="educacion.php">
                <button tabindex="17" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado4" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="18" aria-label="imagen capacitación" class="card-img-top" src="../FOTOS/f.png" style="height: 275px">
        <div class="card-body">
            <h4 tabindex="19" class="card-header" style="color: #312E33;">Capacitación</h4>
            <br>
            <a href="capacitacion.php">
                <button tabindex="20" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado5" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="21" aria-label="imagen situación ocupacional" class="card-img-top" src="../FOTOS/g.png" style="height: 275px">
        <div class="card-body">
            <h4 tabindex="22" class="card-header" style="color: #312E33;">Situación Ocupacional</h4>
            <br>
            <a href="situacion_ocupacional.php">
                <button tabindex="23" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado3" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="24" aria-label="imagen experiencia laboral" class="card-img-top" src="../FOTOS/b.png" style="height: 275px">
        <div class="card-body">
            <h4 tabindex="25" class="card-header" style="color: #312E33;">Experiencia Laboral</h4>
            <br>
            <a href="experiencia_laboral.php">
                <button tabindex="26" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado4" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="27" aria-label="imagen foto" class="card-img-top" src="../FOTOS/foto.png" style="height: 275px">
        <div class="card-body">
            <h4 tabindex="28" class="card-header" style="color: #312E33;">Foto</h4>
            <br>
            <a href="foto.php">
                <button tabindex="29" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado5" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img class="card-img-top" aria-label="imagen formatos" src="../FOTOS/h.png" style="height: 275px">
        <div tabindex="30" class="card-body">
            <h4 tabindex="31" class="card-header" style="color: #312E33;">Formatos</h4>
            <br>
            <a href="formatos.php">
                <button tabindex="32" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>

<div class="col-md-4 animado3" style="margin-bottom: 40px;">
    <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px">
        <img tabindex="33" aria-label="imagen oportunidad de trabajo" class="card-img-top" src="../FOTOS/j.png" style="height: 275px">
        <div class="card-body">
            <h4 tabindex="34" class="card-header" style="color: #312E33;">Oportunidad de Empleo</h4>
            <br>
            <a href="oportunidad.php">
                <button tabindex="35" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; float: right; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip" title="Registrar Usuario" type="submit">Ingresar</button>
            </a>
        </div>
    </div>
</div>
<script src="reloj.js"></script>

<!--div class="col-md-6 animado3" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado4" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <br>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado3" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado4" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <br>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado3" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado4" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <br>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado3" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado4" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <br>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 animado3" style="margin-bottom: 40px">
                <div class="card" style="height: 430px; overflow: hidden; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
                    <img class="card-img-top" src="" style="height: 275px">
                    <div class="card-body">
                        <h4 class="card-title">Título Inspirador</h4>
                        <a href="#">
                            <div type="submit" class="btn btn-outline-primary b-radius-5">Ingresar</div>
                        </a>
                    </div>
                </div>
            </div-->
<?
include('footer.php');
?>
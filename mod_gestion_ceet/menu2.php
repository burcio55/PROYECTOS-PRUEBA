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

$id_usuario = $_SESSION["id_usuario"];


$apellido1 = $_SESSION["apellido1"];
$apellido2 = $_SESSION["apellido2"];
$nombre1 = $_SESSION["nombre1"];
$nombre2 = $_SESSION["nombre2"];

/* $select = "SELECT * FROM public.personales WHERE nenabled = 1 AND primer_apellido = '$apellido1' AND segundo_apellido = '$apellido2' AND primer_nombre = '$nombre1' AND segundo_nombre = '$nombre2'";
$row = pg_query($conn, $select);
$persona = pg_fetch_assoc($row);

echo " 1 / " . $select;
die(); */

$SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $id_usuario . "' AND rol_id >= '82' AND rol_id <= '83' AND nenabled = '1'";
//echo $SQL2;
$row2 = pg_query($conn, $SQL2);
$cont2 = pg_num_rows($row2);
if ($cont2 > 0) {
    $valor2 = pg_fetch_assoc($row2);
    /* var_dump($valor2);
              die(); */
    //echo $valor2['rol_id'];
    $_SESSION['gestion_rol'] = $valor2['rol_id'];
    if ($valor2['rol_id'] == 82) { //Administrador
?>


        <div class="menu">
            <ul class="menu-horizontal">
                <li>
                    <a href="../vista.php">MENÚ PRINCIPAL</a>
                </li>
                <li>
                    <a href="#">REPORTE</a>
                    <ul class="menu-vertical">
                        <li>
                            <a href="index.php">Registro Diario</a>

                        </li>
                        <li>
                            <a href="excel.php">Tipos de Abordajes</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#">MANTENIMIENTO</a>
                    <ul class="menu-vertical">
                        <li class="submenu-origen">
                            <a href="registro_admin_ceet.php">Catálogos</a>
                            <!-- 
                    <ul class="menu-vertical submenu-origen-content" style="z-index:9998; display:none;">
                        <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                        <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                        <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                        <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                        <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                    </ul>

                </li>
                <li id="li0" style="  background-color: #575757;margin-left:25px;z-index:9998; "><a href="mantenimiento0.php">Bien(es) </a></li>
                <li id="li1" style="  background-color: #575757;margin-left:25px;z-index:9998; "><a href="mantenimiento.php">Origen</a></li>
                <li id="li2" style="  background-color: #575757;margin-left:25px;z-index:9998; "><a href="mantenimiento2.php">Marca</a></li>
                <li id="li3" style="  background-color: #575757;margin-left:25px;z-index:9998; "><a href="mantenimiento3.php">Color</a></li>
                <li id="li4" style="  background-color: #575757;margin-left:25px;z-index:9998; "><a href="mantenimiento4.php">Estado del B.P</a></li>
                <li id="li5" style="  background-color: #575757;margin-left:25px;z-index:9998; "><a href="mantenimiento5.php">Condición Física</a></li>
                <li id="li6" style="  background-color: #575757;margin-left:25px;z-index:9998; "><a href="mantenimiento6.php">Cuenta Contable</a></li>

 -->

                        <li>
                            <a href="roles_trabajadores.php" style="z-index:9999;">Usuarios</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">AYUDA</a>
                    <ul class="menu-vertical">
                        <li class="submenu-origen">
                            <a href="manual/guia_gestion_ceet_administrador.pdf" target="_blank" style="padding: 15px 0 15px 10px">Guía de Usuario</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div> <?
            } else if ($valor2['rol_id'] == 83) { //Registrador
                ?>
        <div class="menu">
            <ul class="menu-horizontal">
                <li>
                    <a href="../vista.php">MENÚ PRINCIPAL</a>
                </li>
                <li>
                    <a href="#">REPORTE</a>
                    <ul class="menu-vertical">
                        <li>
                            <a href="index.php">Registro Diario</a>

                        </li>
                        <li>
                            <a href="excel.php">Tipos de Abordajes</a>
                        </li>

                    </ul>
                </li>


                <li>
                    <a href="#">AYUDA</a>
                    <ul class="menu-vertical">
                        <li class="submenu-origen">
                            <a href="manual/guia_gestion_ceet_registrador.pdf" target="_blank" style="padding: 15px 0 15px 10px">Guía de Usuario</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    <?php
            }
    ?>

    <script>
        let isSubmenuOpen = false;
        const submenuOrigen = document.querySelector('.submenu-origen');
        const submenuContent = document.querySelector('.submenu-origen-content');
        document.getElementById("li0").style.display = 'none';
        document.getElementById("li1").style.display = 'none';
        document.getElementById("li2").style.display = 'none';
        document.getElementById("li3").style.display = 'none';
        document.getElementById("li4").style.display = 'none';
        document.getElementById("li5").style.display = 'none';
        document.getElementById("li6").style.display = 'none';


        submenuOrigen.addEventListener('click', (event) => {
            event.preventDefault();

            if (isSubmenuOpen) {
                submenuContent.style.display = 'none';
                document.getElementById("li0").style.display = 'none';

                document.getElementById("li1").style.display = 'none';
                document.getElementById("li2").style.display = 'none';
                document.getElementById("li3").style.display = 'none';
                document.getElementById("li4").style.display = 'none';
                document.getElementById("li5").style.display = 'none';
                document.getElementById("li6").style.display = 'none';

                isSubmenuOpen = false;
            } else {
                submenuContent.style.display = 'block';
                document.getElementById("li0").style.display = 'block';

                document.getElementById("li1").style.display = 'block';
                document.getElementById("li2").style.display = 'block';
                document.getElementById("li3").style.display = 'block';
                document.getElementById("li4").style.display = 'block';
                document.getElementById("li5").style.display = 'block';
                document.getElementById("li6").style.display = 'block';

                isSubmenuOpen = true;
            }
        });
    </script><?php
            } else {
                die();
                echo " :(";
            }
                ?>
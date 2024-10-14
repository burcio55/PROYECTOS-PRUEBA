<?

include('conexion.php');

$id_usuario = $_SESSION["id_usuario"];

$SQL2 = "SELECT * FROM public.personales_rol WHERE personales_cedula = '" . $id_usuario . "' AND rol_id >= '80' AND rol_id <= '81' AND nenabled = '1'";
//echo $SQL2;
$row2 = pg_query($conn, $SQL2);
$cont2 = pg_num_rows($row2);
if ($cont2 > 0) {
    $valor2 = pg_fetch_assoc($row2);
    /* var_dump($valor2);
              die(); */
    //echo $valor2['rol_id'];
    $_SESSION['bienes_publicos_rol'] = $valor2['rol_id'];
    if ($valor2['rol_id'] == 80) { //Administrador
?>
        <div class="menu">
            <ul class="menu-horizontal">
                <li>
                    <a href="../vista.php">MENÚ PRINCIPAL</a>
                </li>
                <li>
                    <a href="#">BIENES PÚBLICOS</a>
                    <ul class="menu-vertical">
                        <li>
                            <a href="registro.php">Registrar</a>

                        </li>
                        <li>
                            <a href="asignar.php">Asignar</a>
                        </li>
                        <li>
                            <a href="actualizar.php">Actualizar Asignación</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">CONSULTA</a>
                    <ul class="menu-vertical">
                        <li>
                            <a href="consulta.php">Reporte</a>
                        </li>
                        <li>
                            <a href="consulta_rol.php">Tipos de Roles</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#">MANTENIMIENTO</a>
                    <ul class="menu-vertical">
                        <li class="submenu-origen">
                            <a href="#">Catálogos</a>

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



                        <li>
                            <a href="usuario.php" style="z-index:9999;">Usuarios</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">AYUDA</a>
                    <ul class="menu-vertical">
                        <li class="submenu-origen">
                            <a href="manual/guia_bienes_publicos_administrador.pdf" target="_blank" style="padding: 15px 0 15px 10px">Guía de Usuario</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    <?
    } else if ($valor2['rol_id'] == 81) { //Registrador
    ?>



        <div class="menu">
            <ul class="menu-horizontal">
                <li>
                    <a href="../vista.php">MENÚ PRINCIPAL</a>
                </li>
                <li>
                    <a href="#">BIENES PÚBLICOS</a>
                    <ul class="menu-vertical">
                        <li>
                            <a href="registro.php">Registrar</a>

                        </li>
                        <li>
                            <a href="asignar.php">Asignar</a>
                        </li>
                        <li>
                            <a href="actualizar.php">Actualizar Asignación</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="consulta.php">CONSULTA</a>
                </li>
                <!--  <li>
                       <a href="#">MANTENIMIENTO</a>
                       <ul class="menu-vertical">
                           <li class="submenu-origen">
                               <a href="#">Catálogos</a>
        
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
        
        
        
                       </ul>
                   </li> -->
                <li>
                    <a href="#">AYUDA</a>
                    <ul class="menu-vertical">
                        <li class="submenu-origen">
                            <a href="manual/guia_bienes_publicos_registrador.pdf" target="_blank" style="padding: 15px 0 15px 10px">Guía de Usuario</a>
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
    </script>
<?php
} else {
    die();
    echo " :(";
}
?>
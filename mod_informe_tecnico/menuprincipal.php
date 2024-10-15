<?php
include('based.php');

$query = "SELECT * FROM public.personales_rol WHERE personales_cedula = '".$_SESSION['id_usuario']."' AND rol_id >= '77' AND rol_id <= '79' AND nenabled = '1';";

$SQL = pg_query($conn, $query);
$busqueda = pg_fetch_assoc($SQL);
$rol_usuario = $busqueda["rol_id"];

$ruta_pdf = " ";
if ($rol_usuario == '77') {
    $ruta_pdf = "manual/guia_Informe tecnico_Administrador.pdf";
} 
if ($rol_usuario == '79') {
    $ruta_pdf = "manual/guia_Informe tecnico_con rol_Consulta.pdf";
} 
if ($rol_usuario == '78') {
    $ruta_pdf = "manual/guia_Informe tecnico_con rol_registrador.pdf";
}

/*  echo $rol_usuario;  */
?>
<div class="menu" id="content-1">
    <ul class="menu-horizontal">
        <li>
            <a href="../vista.php">MENÚ PRINCIPAL</a>
        </li>
        <li>
            <a href="#">INFORME TÉCNICO</a>
            <ul class="menu-vertical">
                <?php if ($rol_usuario == '77' || $rol_usuario == '78'): ?>
                    <li><a href="index.php">Registrar</a></li>
                    <li><a href="actualizar.php">Actualizar</a></li>
                <?php endif; ?>
            </ul>
        </li>
        <li>
            <a href="#">CONSULTA</a>
            <ul class="menu-vertical">
                <?php if ($rol_usuario == '77' || $rol_usuario == '79'): ?>
                    <li><a href="bp.php">Por Nro. de Informe Técnico</a></li>
                    <li><a href="consulta_especifica.php">Por Nro. de Serial/Nro. de Bien Público</a></li>
                <?php endif; ?>
                <?php if ($rol_usuario == '77'): ?>
                <li><a href="consulta_roles.php">Roles Activos</a></li>
                <li><a href="consulta_tecnico_registros.php">Informes por Técnicos</a></li>
                <?php endif; ?>
            </ul>
        </li>
        <li>
            <a href="#">MANTENIMIENTO</a>
            <ul class="menu-vertical">
                <?php if ($rol_usuario == '77'): ?>
                    <li class="submenu-origen">
                        <a href="#">Catálogos</a>
                        <ul class="menu-vertical submenu-origen-content" style="z-index:9998; display:none;">
                            <li style="background-color: #575757; margin-left:25px; z-index:9998;"></li>
                            <li style="background-color: #575757; margin-left:25px; z-index:9998;"></li>
                            <li style="background-color: #575757; margin-left:25px; z-index:9998;"></li>
                        </ul>
                    </li>
                    <li id="li0" style="background-color: #575757; margin-left:25px; z-index:9998;"><a href="estatus.php">Estatus</a></li>
                    <li id="li1" style="background-color: #575757; margin-left:25px; z-index:9998;"><a href="marca.php">Marca</a></li>
                    <li id="li2" style="background-color: #575757; margin-left:25px; z-index:9998;"><a href="tipo.php">Tipo de Dispositivo</a></li>
                    <li><a href="usuario.php" style="z-index:9999;">Usuarios</a></li>
                <?php endif; ?>
            </ul>
        </li>
        <li style="margin-right: 20px;">
            <a href="#">AYUDA</a>
            <ul class="menu-vertical" style="margin-right: 20px;">
                <?php if ($rol_usuario == '77' || $rol_usuario == '79' || $rol_usuario == '78'): ?>
                    <li style="display: flex; align-items: center;">
                        <a href="<?php echo $ruta_pdf; ?>" style="margin-right: 20px;" target="_blank">Guía de Usuario</a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
</div>
        
            <div id="content-2" style="display: none">
                    <nav class="navbar navbar-light" style="width: 100%; background-color: white">
                        <div class="container-fluid" style="margin-left: 80%;">
                            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">MENÚ PRINCIPAL</h5>
                                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                <ul class="menu-horizontal">
                                <li>
                                        <a href="#">INFORME TÉCNICO</a>
                                        <ul class="menu-vertical">
                                            <li>
                                                <a href="#">Registro</a>
                                            </li>
                                            <li>
                                                <a href="#">Actualizar</a>
                                            </li>
                                            <li>
                                                <a href="#">Imprimir</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">CONSULTA</a>
                                        <ul class="menu-vertical">
                                            <li>
                                                <a href="#">Por Serial o Bien Público</a>
                                            </li>
                                            <li>
                                                <a href="#">Por Numero de Informe</a>
                                            </li>
                                        
                                        </ul>
                                    </li>
                                    <li>
                                        <a>MANTENIMIENTO</a>
                                        <ul class="menu-vertical">
                                            <li>
                                                <a href="catalogo.php">Catalogos</a>
                                            </li>
                                            <li>
                                                <a href="#">Usuarios</a>
                                            </li>
                                        
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">GUÍA DE USUARIO</a>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
            </div>
    <script>
        let isSubmenuOpen = false;
        const submenuOrigen = document.querySelector('.submenu-origen');
        const submenuContent = document.querySelector('.submenu-origen-content');
        document.getElementById("li0").style.display = 'none';
        document.getElementById("li1").style.display = 'none';
        document.getElementById("li2").style.display = 'none';
        submenuOrigen.addEventListener('click', (event) => {
        event.preventDefault();
        if (isSubmenuOpen) {
            submenuContent.style.display = 'none';
            document.getElementById("li0").style.display = 'none';

            document.getElementById("li1").style.display = 'none';
        document.getElementById("li2").style.display = 'none';


            isSubmenuOpen = false;
        } else {
            submenuContent.style.display = 'block';
            document.getElementById("li0").style.display = 'block';

            document.getElementById("li1").style.display = 'block';
        document.getElementById("li2").style.display = 'block';


            isSubmenuOpen = true;
        }
        });
  
    </script>
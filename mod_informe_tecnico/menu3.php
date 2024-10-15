<div class="menu" id="content-1">
            <ul class="menu-horizontal">
                    <li>
                        <a href="../vista.php">MENÚ PRINCIPAL</a>
                    </li>
                    <li>
                        <a href="#">INFORME TÉCNICO</a>
                        <ul class="menu-vertical">
                            <li>
                                <a href=".php">Registrar</a>
                            </li>
                            <li>
                                <a href=".php">Actualizar</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">CONSULTA</a>
                        <ul class="menu-vertical">
                            <li>
                                <a href="bp.php">Por Nro. de Informe Técnico</a>
                            </li>
                            <li>
                                <a href="consulta_especifica.php">Por Nro. de Serial/Nro. de Bien Público</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">MANTENIMIENTO</a>
                            <ul class="menu-vertical">
                                <li class="submenu-origen">
                                    <a href="#">Catálogos</a>
                                        <ul class="menu-vertical submenu-origen-content"  style="z-index:9998; display:none;">
                                            <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                                            <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                                            <li style="  background-color: #575757;margin-left:25px;z-index:9998; "></li>
                                        </ul>
                                </li>
                                    <li id="li0"style="  background-color: #575757;margin-left:25px;z-index:9998; " ><a href=".php">Estatus</a></li>
                                    <li id="li1"style="  background-color: #575757;margin-left:25px;z-index:9998; " ><a href=".php">Marca</a></li>
                                    <li id="li2"style="  background-color: #575757;margin-left:25px;z-index:9998; " ><a href=".php">Tipo de Dispositivo</a></li>
                    <!--      <li id="li6"style="  background-color: #575757;margin-left:25px;z-index:9998; " ><a href="mantenimiento6.php">Cuenta Contable</a></li> -->

                                <li>
                                    <a href=".php" style="z-index:9999;">Usuarios</a>
                                </li>
                            </ul>
                    </li>
                    <li style="margin-right: 20px;">
                        <a href="#">AYUDA </a>
                        <ul class="menu-vertical" style="margin-right: 20px;">
                            <li style="display: flex; align-items: center;">
                                <a href="" style="margin-right: 20px;">Guía de Usuario</a>
                            </li>
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
                                                <a href=".php">Catalogos</a>
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
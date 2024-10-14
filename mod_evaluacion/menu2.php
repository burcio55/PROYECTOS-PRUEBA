<?
include("BD.php");

$query = "SELECT * FROM public.personales_rol WHERE personales_cedula = '".$_SESSION['id_usuario']."' AND rol_id >= '84' AND rol_id <= '87' AND nenabled = '1';";

$SQL = pg_query($conn, $query);
$busqueda = pg_fetch_assoc($SQL);
$rol_usuario = $busqueda["rol_id"];
?>


<div class="menu">
    <ul class="menu-horizontal">
        <li>
            <a href="../vista.php">MENÚ PRINCIPAL</a>
        </li>
        <li>
            <a href="#">ODI</a>
            <ul class="menu-vertical">
            <?php if ($rol_usuario == '84' || $rol_usuario == '86'): ?>
                <li>
                    <a href="evaluar.php">Evaluar</a>

                </li>
                <li>
                    <a href="evaluador_tabla.php">Evaluación por Revisar</a>
                </li>
            <?php endif; ?>
            <?php if ($rol_usuario == '84' || $rol_usuario == '85' || $rol_usuario == '86' || $rol_usuario == '87'): ?>
                <li>
                    <a href="evaluado.php">Evaluado</a>
                </li>
            <?php endif; ?>
            </ul>
        </li>

        <li>
            <a href="#">REPORTES</a>
            <ul class="menu-vertical">
            <?php if ($rol_usuario == '84' || $rol_usuario == '85'): ?>
                <li>
                    <a href="reporte.php">Varios</a>

                </li>
            <?php endif; ?>
            </ul>
        </li>

        <li>
            <a href="#">MANTENIMIENTO</a>
            <ul class="menu-vertical">
            <?php if ($rol_usuario == '84' || $rol_usuario == '85'): ?>
                <li>
                    <a href="analista_tabla.php" style="z-index:9999;">Evaluación por Analizar</a>
                </li>
                <li>
                    <a href="incidencias.php" style="z-index:9999;">Incidencias</a>
                </li>
            <?php endif; ?>
            <?php if ($rol_usuario == '84'): ?>
                <li>
                    <a href="usuario.php" style="z-index:9999;">Usuarios</a>
                </li>
            <?php endif; ?>
            </ul>
        </li>
        <li>
            <a href="#">AYUDA</a>
            <ul class="menu-vertical">
            <?php if ($rol_usuario == '84' || $rol_usuario == '85' || $rol_usuario == '86' || $rol_usuario == '87'): ?>
                <li class="submenu-origen">
                    <a href="manual/guia_evaluacion_administrador.pdf" target="_blank" style="padding: 15px 0 15px 10px">Guía de Usuario</a>
                </li>
            <?php endif; ?>
            </ul>
        </li>
    </ul>
</div>

<?
/*  } else*/ if ($valor2['rol_id'] == 83) {  //Registrador
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
            /*  } else {
                die();
                echo " :(";
            } */
            ?>
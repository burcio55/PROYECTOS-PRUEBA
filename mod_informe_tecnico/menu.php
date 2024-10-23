<!DOCTYPE html>
<html lang="Es-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <!-- Bootstrap V5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/estilos2.css">
</head>

<body>
    <!-- Header -->
    <header>
        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid ">
                <div class="logo"> </div>
            </div>
        </nav>
    </header>
    <div class="sep-header"></div>
    <!-- Main -->
    <main>
        <div class="content-todo">
            <?
                include('menu2.php');
            ?>
            <br>
            <br>
            <div class="sep"></div>
            <center>
                <div class="col-md-12">
                    <div class="jumbotron">
                        <form method="POST" action="" class="col-md-10">
                            <div class="card-header" style="border-radius: 30px 30px 0 0; padding: 30px 0 10px 20px; background-color: #fff">
                                <!-- Parte superior del formulario -->
                                <img src="img/logo.png" style="width: 80%; height: auto; margin: auto">
                                <!-- Título del logo -->
                       <hr>
                            </div>
                        </form>
                    </div>
                </div>
            </center>
        </div>
    </main>
    <div class="sep-footer"></div>
    <br>
    <!-- Footer -->
    <footer>
        <div class="container3">
            <div class="row" style="--bs-gutter-x: 0;">
                <div class="col-md-6" style="border-right: 1px solid white;">
                    <h3 class="sep-3" style="font-size: 16px;">División de Soporte Técnico</h3>
                </div>
                <div class="col-md-6" style="padding-left: 10px">
                    <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                    <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                    <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
                </div>
            </div>
        </div>
    </footer>
    <script>
        const mediaQuery = window.matchMedia("(max-width: 1000px)");

        if (mediaQuery.matches) {
            // El dispositivo es menor a 1000px de ancho
            document.getElementById("content-1").style.display = "none";
            document.getElementById("content-2").style.display = "";
        }
    </script>

    <!-- JavaScript Link's -->

    <script src="js/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="js/cdn.tailwindcss.com_3.3.3"></script>
    <script src="js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>

    <script src="js/main.js"></script>
</html>
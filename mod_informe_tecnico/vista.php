<?
include('based.php');
?>
<!DOCTYPE html>
<html lang="Es-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Técnico</title>
    <!-- Bootstrap V5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/estilos2.css">
</head>

<body>
    <!-- Header -->
    <header>
        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid ">
                <div class="logo">
                </div>
            </div>
        </nav>
    </header>
    <div class="sep-header"></div>
    <!-- Main -->
    <main>
        <div class="content-todo">
            <?
             include('menuprincipal.php');
            ?>
            <div class="sep"></div>
            <center>
                <div class="col-md-12">
                        <form method="POST" action="" class="col-md-12">
                            <div class="card-header" style="border-radius: 30px 30px 0 0; padding: 30px 0 10px 20px; background-color: #fff">
                                <!-- Parte superior del formulario -->
                                <img src="img/logo.png" style="width: 80%; height: auto; margin: auto">
                                <!-- Título del logo -->
                       
                            </div>
                        </form>
                </div>
            </center>
        </div>
    </main>
    <div class="sep-footer"></div>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color: white;">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                            <div class="col-md-6" style="border-right: 1px solid white;">
                                    <h3 class="sep-3" style="font-size: 16px; margin-left: 100px">División de Soporte Técnico</h3>
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

    <!-- JavaScript Link's -->

    <script src="js/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="js/cdn.tailwindcss.com_3.3.3"></script>
    <script src="js/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="js/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>

    <script src="js/main.js"></script>
    <script src="js/login.js"></script>

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

</html>
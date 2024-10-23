<?php
/* include('based.php'); */
?>
<!DOCTYPE html>
<html lang="Es-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos5.css">
    <link rel="stylesheet" href="css/validar.css">
    <link rel="stylesheet" href="css/alerta.css">
    <script src="code.jquery.com_jquery-3.7.0.js"></script>
</head>

<body>

    <div id="observacion" class="fondo_alerta" style="display: none;">
        <div class="alerta">
            <h4 id="titulo">Atención</h4>
            <p id="texto"></p>
            <div class="sep"></div>
            <center><button type="button" onclick="cerrar()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button></center>
            <div class="sep"></div>
        </div>
    </div>
    <div id="observacion2" class="fondo_alerta" style="display: none;">
        <div class="alerta">
            <h4 id="titulo2">Atención</h4>
            <p id="texto2"></p>
            <div class="sep"></div>
            <center><button type="button" onclick="cerrar2()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button></center>
            <div class="sep"></div>
        </div>
    </div>

    <div class="logo"></div>
    <br>
    <div class="container">
        <?
            include('menuprincipal.php');;
        ?>
        <div class="container2">
            <h2>CONSULTA - Roles Activos</h2>
            <hr>
            <br>

            <form id="miFormulario" onsubmit="validarFormulario(event)" method="POST">
                <?php
                // 1. Verify database connection (optional, but recommended)
                /* if (!pg_connect($conn_string)) { // Replace $conn_string with your database connection string
                    echo "Error: Could not connect to the database.";
                    exit; // Stop execution if there is no connection
                } */
                ?>

                <div class="container3" style="display: flex; justify-content: center; align-items: center; height: 10vh;">
                    <div class="col-sm-12" style="max-width: 600px;">
                        <div class="input-group mb-3 epa">
                            <label for="basic-url" class="form-label" style="margin-top:10px">Rol <span>*</span></label>
                            <span class="mma"></span>
                            <span class="input-group-text" style="border-radius: 30px 0 0 30px" id="addon-wrapping">
                                <img src="img/rol_logo.png" class="icon">
                            </span>
                            <select id="rol" name="rol" class="form-select">
                                <option value="-1" selected>Seleccione</option>
                                <option value="78">Técnico</option>
                                <option value="79">Consulta</option>
                                </select>
                            <button type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 5px 15px; border-radius: 0px 30px 30px 0px; width: 120px; margin-left: -15px; margin: 0" onmouseout="this.color='#fff'; this.backgroundColor='#46A2FD'; this.border='1px Solid #46A2FD'" onmouseover="this.color='#46A2FD'; this.backgroundColor='#fff'; this.innerHTML='Buscar';" data-bs-toggle="tooltip" id="buscar">Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <table id="miTabla2" class="table table-striped" style="border-radius: 30px; text-align: center; width: 800px;">
                    <thead style="background-color: #46A2FD;">
                        <tr>
                            <th colspan="3"></th>
                        </tr>
                        <tr>
                            <th style="text-align: center; width: 50px; padding: 10px;">Nro.</th>
                            <th style="text-align: center; width: 50px; padding: 10px;">Cédula de Identidad</th>
                            <th style="text-align: center; width: 150px; padding: 15px;">Nombre(s) y Apellido(s)</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="mostrar_roles">
                        <!-- Aquí se mostrarán los resultados -->
                    </tbody>
                </table>
                    </div>   
                </form>

                <div class="col-12" style="text-align:center;">
                    <a href="vista.php"><button class="btn" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>            
                </div>

        </div>
    </div>

<script src="rol_consultas.js"></script>

</body>
<br>
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
</html>
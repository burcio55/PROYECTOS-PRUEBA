<!DOCTYPE html> 
<html lang="Es-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes por Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos6.css">
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
<input type="text" value="" style="display: none" id="validador">
<div class="logo"></div>
<br>
<div class="container">
    <?
    include('menuprincipal.php');
    ?>  
    <div class="container2">
        <div class="row">
            <div class="col-sm-12">
                <h2>CONSULTA - Informes por Técnicos</h2>
            </div>
            
            <div class="col-sm-4"></div>
            <div class="sep"></div>
        <div class="col-sm-12"><h6 class="obligatorio">Datos Obligatorios (*)</h6></div>
<hr>
    <br>
        
            <div class="col-sm-12">
                <div class="input-group mb-3 epa"> 
                    <label for="basic-url" class="form-label" style="margin-top:10px">Cédula de Identidad <span>*</span> </label> <span class="mma"></span>
                    <span class="input-group-text" style="border-radius: 30px 0 0 30px" id="addon-wrapping"><img src="img/bandera.png" class="icon"></span>
                    <select id="nacionalidad" class="input-group-text">
                    <option value="" selected>...</option>
                    <option value="1">V-</option>
                    <option value="2">E-</option>
                </select>
<input type="text" class="form-control" placeholder="Ej. 10564238" id="cedula">
<button onclick="buscar()" type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-left: -15px;margin: 0" onmouseout="this.style.color=&quot;#fff&quot;; this.style.backgroundColor=&quot;#46A2FD&quot;; this.style.border=&quot;1px Solid #46A2FD&quot;" onmouseover="this.style.color=&quot;#46A2FD&quot;; this.style.backgroundColor=&quot;#fff&quot;;" data-bs-toggle="tooltip">Buscar</button>
                </div>
            </div>
            <script>
                function soloNumeros(e) {
                    const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                    if (!permitidos.includes(e.keyCode)) {
                    e.preventDefault();
                    }
                }
                document.getElementById("cedula").addEventListener("keydown", soloNumeros);
                const input = document.getElementById('cedula');
                const maxLength = 8; 
                input.addEventListener('input', function() {
                const currentValue = input.value;
                input.value = currentValue.slice(0, maxLength);
                });
            </script>
            <div class="col-sm-10" style="width: 120%">
                <table id="miTabla2" class="table table-striped" style="border-radius: 30px; text-align: center; width: 810px;">
                    <thead style="background-color: #46A2FD;">
                        <tr>
                            <th colspan="4"></th>
                        </tr>
                        <tr style="width: auto;">
                            <th style="text-align: center; width: 50px; padding: 15px;">Nro.</th>
                            <th style="text-align: center; width: 150px; padding: 15px;">Nombre(s) y Apellido(s)</th>
                            <th style="text-align: center; width: 50px; padding: 15px;">Fecha de Creación</th>
                            <th style="text-align: center; width: 150px; padding: 15px;">Número de Informe Técnico</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="mostrar">
                        <!-- Aquí se mostrarán los resultados -->
                    </tbody>
                </table>
            </div>

            <div class="col-12" style="text-align:center;">
                    <a href="vista.php"><button class="btn" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>            
            </div>
                        
                     
            
        </div>
    </div>
</div>

<script src="tecnicos_registros.js"></script>
</body> 
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
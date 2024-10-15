<?
    include("bd.php");
?>

<!DOCTYPE html>
<html lang="Es-es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Solicitud de Permiso</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/alerta.css">
        <script src="code.jquery.com_jquery-3.7.0.js"></script>
    </head>
    <body>
    <div id="observacion" class="fondo_alerta" style="display: none;">
            <div class="alerta">
                <h4 id="titulo">Atención</h4>
                <p id="texto"></p>
                <div class="sep"></div>
                <center><button type="button" onclick="cerrar()" style=" margin-bottom: 20px; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button></center>
                <div class="sep"></div>
                <div class="sep"></div>
            </div>
        </div> 
        <div class="logo"></div>
        <br>
        <div class="container">
            <?
                include('menu.php');
            ?>
            <div class="contenedor">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 style="color: #0d6efd">Formato - Solicitud de Permiso</h2>
                    </div>

                    <form action="interaccion.php" method="post"class="row g-3" id="funcionario">
                        <div class="container2">
                            <h4 style="color:#0d6efd; font-weight:normal;">Datos del Funcionario</h4>
                            <h6 class="obligatorio" style="text-align:right; color: #BF1F13;">Campos Obligatorios (*)</h6>
                        </div><hr>
                 

                            <div class="col-md-6">
                                <label for="inputmodelo" class="form-label">Nombres y Apellidos</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/requerido.png" class="icon"></span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Jesus Hernesto Contreraz Lopes" id="nombre_apellido" name="nombre_apellido" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Cédula de Identidad</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="cedula" name="cedula" placeholder="Ej. 30899564" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo Titular <span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" maxlength="50" id="cargo_titular" name="cargo_titular" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. Coordinador" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Código de Nómina</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="codigo_nomina" name="codigo_nomina" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. 07717" value="" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Ubicación Administrativa de Adscripción</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="ubicacion_adcripcion" name="ubicacion_adcripcion" placeholder="Ej. Despacho del Ministro" value="<? echo $_REQUEST['ubicacion_adcripcion'] ?>" disabled>
                                    </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Adscrita a: <span>*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" style="text-transform: uppercase;" class="form-control" id="adscrito" name="adscrito" placeholder="Ej. Recursos Humanos" value="" maxlength="100">
                                </div>
                            </div>
                            <script>
                                document.getElementById('adscrito').addEventListener('keypress', function (event) {
                                    var charCode = event.charCode;
                                    if (charCode >= 48 && charCode <= 57) {
                                        event.preventDefault();
                                    }
                                });
                            </script>
                        <br>
                        <br> 
                    </form>
                    <br>
                    <br>
                    <h4 style="margin-top: 25px;">Especificaciones del Permiso</h4>
                    <hr>
                    <br>

                    <div class="form-floating mb-3"><b>Motivo</b><span>*</span>
                        <input type="text" onkeypress="return /[a-zA-Z ]/i.test(event.key);"  style="margin: 0; padding: 0; box-sizing: border-box; padding: 10px 20px; font-size: 16px; height: 72px; text-transform: uppercase" class="form-control"  required name="motivo" id="motivo" maxlength="200">
                    </div>

                    <div class="form-floating mb-3"><b>Fecha de Solicitud</b><span>*</span></div>
                    <div class="container-box">
                        <div class="box" style="text-align: center;">Inicio
                            <hr>
                            <input type="date" class="form-control" id="fecha_inicio">
                        </div>
                        <div class="box" style="text-align: center;">Fin
                            <hr>
                            <input type="date" class="form-control" id="fecha_final">
                        </div>
                        <div class="box" style="text-align: center;">Duración
                            <hr>
                            <input type="text" class="form-control" id="duracion" disabled style="background: #b6b4b4b2;">
                        </div>
                    </div>
                   <!--  <script>
                        const fechaInicio = document.getElementById('fecha_inicio');
                        const fechaFinal = document.getElementById('fecha_final');
                        const duracion = document.getElementById('duracion');
                        function calcularDuracion() {
                        const inicio = new Date(fechaInicio.value);
                        const fin = new Date(fechaFinal.value);

                        // Validar si ambas fechas están ingresadas
                        if (!inicio.getTime() || !fin.getTime()) {
                            alert("Por favor, ingresa ambas fechas.");
                            return;
                        }
                        // Calcular la diferencia en milisegundos y convertir a días
                        const diferenciaMilisegundos = fin - inicio;
                        const diferenciaDias = Math.round(diferenciaMilisegundos / (1000 * 60 * 60 * 24));
                        // Validar si la diferencia es negativa
                        if (diferenciaDias < 0) {
                            alert("La fecha final debe ser posterior a la fecha inicial.");
                            return;
                        }
                        // Mostrar la duración si las validaciones pasan
                        duracion.value = diferenciaDias + " días";
                        }
                        fechaInicio.addEventListener('input', calcularDuracion);
                        fechaFinal.addEventListener('input', calcularDuracion);
                    </script> -->
                    <div class="col-12">
                        <div class="sep"></div>
                    </div>
                    <div class="form-floating mb-3" style="margin-top: 20px;"><b>Soporte Legal</b><span>*</span>
                        <input class="form-control" onkeypress="return /[a-zA-Z ]/i.test(event.key);" style="margin: 0; padding: 0; box-sizing: border-box; padding: 10px 20px; font-size: 16px; height: 72px; text-transform: uppercase;"  required name="soporte_legal" id="soporte_legal" maxlength="100">
                    </div>
                    <div class="col-md-6">
                        <label for="inputmodelo" class="form-label">Jefe(a) Inmediato (Nombre y Apellido)<span>*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/requerido.png" class="icon"></span>
                                <input class="form-control"  onkeypress="return /[a-zA-Z ]/i.test(event.key);" required name="jefe_inmediato" id="jefe_inmediato" maxlength="25" oninput="this.value = this.value.toUpperCase();">
                            </div>
                    </div>

                    <div class="col-md-6">
                        <label for="inputmodelo" class="form-label">Director(a) (Nombre y Apellido)<span>*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/requerido.png" class="icon"></span>
                                <input class="form-control"  onkeypress="return /[a-zA-Z ]/i.test(event.key);" required name="director" id="director" maxlength="25" oninput="this.value = this.value.toUpperCase();">
                            </div>
                    </div>
                    <br><br>
                    <br><br>
                    <div class="col-12" style="text-align:center; margin-top: 20px;">
                        <a href="vista.php"><button id="generarPDF" type="submit" class="btn btn-secondary" style="background-color: #3B99DC; color: #fff; border: 1px solid #3B99DC; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#3B99DC"; this.style.border="1px solid #3B99DC"' onmouseover='this.style.color="#3B99DC"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Regresar</button></a>
                        <button id="generarPDF" type="submit" onclick="imprimir2()" class="btn btn-secondary" style="background-color: #3B99DC; color: #fff; border: 1px solid #3B99DC; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#3B99DC"; this.style.border="1px solid #3B99DC"' onmouseover='this.style.color="#3B99DC"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Imprimir</button>
                    </div>
                    <script>
                        $(document).ready(function()   
                            {
                                $('#generarPDF').click(function() {
                                    var cargo_titular = $('#cargo_titular').val();
                                    var adscrito = $('#adscrito').val();
                                    var motivo = $("#motivo").val();
                                    var soporte_legal = $("#soporte_legal").val();
                                    var fecha_inicio = $("#fecha_inicio").val();
                                    var fecha_final = $("#fecha_final").val();
                                    var duracion = $("#duracion").val();
                                    $.ajax({
                                        url: 'imprimir.php2?cargo_titular='+cargo_titular.value+'&adscrito='+adscrito.value+"&motivo="+
                                            motivo.value+"&soporte_legal="+soporte_legal.value+"&fecha_inicio="+fecha_inicio.value+"&fecha_final="+fecha_final.value
                                            +"&duracion="+duracion.value,
                                        type: 'POST',
                                        data: { cargo_titular: cargo_titular,
                                                adscrito: adscrito,
                                                motivo: motivo,
                                                soporte_legal: soporte_legal,
                                                fecha_inicio: fecha_inicio,
                                                fecha_final: fecha_final,
                                                duracion: duracion
                                        },
                                        success: function(response) {
                                            // Manejar la respuesta del servidor, por ejemplo, mostrar un mensaje de éxito o descargar el PDF
                                        }
                                    });
                                });
                            });
                    </script>

                </div>
            </div>
        </div>

        <script src="registrar.js"></script>
    </body>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color: white;">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                            <div class="col-md-6" style="border-right: 1px solid white;">
                            <h3 class="sep-3" style="font-size: 16px; margin-left: 320px;">Modulo de Formatos</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="font-size: 16px; white-space: nowrap;">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                                    <h3 style="font-size: 16px; white-space: nowrap;">División de Análisis y Desarrollo de Sistemas.</h3>
                                    <h3 style="font-size: 16px; white-space: nowrap;">© 2024 Todos los Derechos Reservados.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</html>
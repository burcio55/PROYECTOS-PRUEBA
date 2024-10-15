<?
    include("bd.php");
?>

<!DOCTYPE html>
<html lang="Es-es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prueba</title>
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
                <center><button type="button" onclick="cerrar()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button></center>
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
                        <h2 style="color: #0d6efd">Prueba</h2>
                    </div>

                <form action="interaccion2.php" method="post"class="row g-3" id="funcionario" >

                            <div class="container2">
                                    <h4 style="color:#0d6efd; font-weight:normal;">Datos del Funcionario</h4>
                                    <h6 class="obligatorio" style="text-align:right; color: #BF1F13;">Datos Obligatorios (*)</h6>
                            </div><hr>

                            <div class="col-md-6">
                                <label for="inputmodelo" class="form-label">Apellidos y Nombres</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"> <img src="img/requerido.png" class="icon"> </span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Jesus Hernesto Contreraz Lopes" id="nombre_apellido" name="nombre_apellido" disabled>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="basic-url" class="form-label">Cédula de Identidad</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="cedula" name="cedula" placeholder="Ej. 30899564" disabled>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="basic-url" class="form-label">Código de Nómina</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="codigo_nomina" name="codigo_nomina" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. 07717" value="" disabled>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Correo Electrónico<span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="email" class="form-control" id="gmail" pattern=".+@gmail\.com" name="gmail" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. luis@gmail.com" value="" require maxlength="50">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo Titular<span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control"  id="cargo_titular"  name="cargo_titular" aria-describedby="basic-addon3 basic-addon4" placeholder="Ej. Coordinador" value="">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="basic-url" class="form-label">Ubicación Administrativa </label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                        <input type="text" class="form-control" style="background: #b6b4b4b2;" id="ubicacion_adcripcion" name="ubicacion_adcripcion" placeholder="Ej. Despacho del Ministro" value="<? echo $_REQUEST['ubicacion_adcripcion'] ?>" disabled>
                                    </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="basic-url" class="form-label">Adscrito a:<span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" id="subicacion_fisica" name="subicacion_fisica" placeholder="Ej. Recursos Humanos" value="" maxlength="100">
                                </div>
                            </div>
                            <script>
                                document.getElementById('subicacion_fisica').addEventListener('keypress', function (event) {
                                    var charCode = event.charCode;
                                    if (charCode >= 48 && charCode <= 57) {
                                        event.preventDefault();
                                    }
                                });
                            </script>

                            <div class="col-sm-4">
                                <label for="basic-url" class="form-label">Fecha de Ingreso al Ministerio</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="date" class="form-control" style="background: #b6b4b4b2;" id="ingreso_ministerio" name="ingreso_ministerio" placeholder="Ej. 18/08/48" value="" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">Años en la Institución</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="antiguedad" name="antiguedad" placeholder="Ej. 2 años" value="" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">Años de Servicio en la APN<span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" onkeydown="return Numeros(event);" id="antiguedad_apn" name="antiguedad_apn" placeholder="Ej. 2 años" value="" oninput="calcularSuma()" maxlength="2">
                                </div>
                            </div>
                            <script>
                                function Numeros(event) {
                                    const permitidos = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                                    if (!permitidos.includes(event.keyCode)) {
                                    event.preventDefault();
                                    }
                                    document.getElementById("antiguedad_apn").addEventListener("keydown", Numeros);
                                    const input = document.getElementById("antiguedad_apn");
                                    const maxLength = 10;
                                    input.addEventListener('input', function() {
                                    const currentValue = input.value;
                                    input.value = currentValue.slice(0, maxLength);
                                    });
                                };
                            </script>
                            <div class="col-md-3">
                                <label for="basic-url" class="form-label">Total de Años en la APN</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="antiguedad_apn_final" name="antiguedad_apn_final" placeholder="Ej. 2 años" value="" disabled>
                                </div>
                            </div>
                            <script>
                                function calcularSuma() {
                                    var antiguedad = parseFloat(document.getElementById('antiguedad').value) || 0;
                                    var antiguedad_apn = parseFloat(document.getElementById('antiguedad_apn').value) || 0;
                                    var antiguedad_apn_final = antiguedad + antiguedad_apn;
                                    document.getElementById('antiguedad_apn_final').value = antiguedad_apn_final;
                                }
                            </script>
                            <div class="col-md-5">
                                <label for="basic-url" class="form-label">Lapso Vacacional Solicitado<span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="text"  class="form-control" id="lapso_vacacional" name="lapso_vacacional" placeholder="Ej. 2012-2013" maxlength="10" value="">
                                </div>
                            </div>
                            <script>
                                const input = document.getElementById('lapso_vacacional');

                                input.addEventListener('input', (event) => {
                                    const valor = event.target.value;
                                    const regex = /[^0-9-,\s]/g; // Agregamos la coma y un espacio en blanco para permitir espacios

                                    if (regex.test(valor)) {
                                        event.target.value = valor.slice(0, -1);
                                    }
                                });
                            </script>

                            <div class="col-md-4">
                                <label for="basic-url" class="form-label">Fecha Deseada<span>*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                                    <input type="date" class="form-control"  id="fecha_deseada" name="fecha_deseada" value="" >
                                </div>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <label for="inputmodelo" class="form-label">Jefe Inmediato (Nombre y Apellido)<span>*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/requerido.png" class="icon"></span>
                                    <input class="form-control"  required name="jefe_inmediato" id="jefe_inmediato" onkeypress="return /[a-zA-Z ]/i.test(event.key);" maxlength="25" oninput="this.value = this.value.toUpperCase();">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="inputmodelo" class="form-label">Director (Nombre y Apellido)<span>*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;">
                                        <img src="img/requerido.png" class="icon">
                                        </span>
                                        <input class="form-control" required name="director" id="director" maxlength="25" onkeypress="return /[a-zA-Z ]/i.test(event.key);" oninput="this.value = this.value.toUpperCase();">
                                    </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var dateInput = document.getElementById('fecha_deseada');
                                    var placeholder = '16/08/2024';

                                    dateInput.addEventListener('focus', function() {
                                        if (dateInput.value === '') {
                                            dateInput.type = 'date';
                                        }
                                    });

                                    dateInput.addEventListener('blur', function() {
                                        if (dateInput.value === '') {
                                            dateInput.type = 'text';
                                            dateInput.placeholder = placeholder;
                                        }
                                    });

                                    // Inicializar el placeholder
                                    if (dateInput.value === '') {
                                        dateInput.type = 'text';
                                        dateInput.placeholder = placeholder;
                                    }
                                });
                            </script>
                            <br>
                            <br> 
                            <br>
                    </form>
                    <br>
                    <!-- <div class="col-12" style="text-align:center; margin-top: 10px;">
                        <button id="" type="submit" onclick="imprimir2()" class="btn btn-secondary" style="background-color: #3B99DC; color: #fff; border: 1px Solid #3B99DC; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#3B99DC"; this.style.border="1px Solid #3B99DC"' onmouseover='this.style.color="#3B99DC"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Imprimir</button>
                    </div> -->
                </div>
            </div>
        </div>
 <!--        <script src="registrar2.js"></script> -->
    </body>
<footer>
<!--     <div class="container3">
        <div class="row" style="--bs-gutter-x: 0;">
            <div class="col-md-6" style="border-right: 1px solid white;">
                <h3 class="sep-3" style="font-size: 16px;"></h3>
            </div>
            <div class="col-md-6" style="padding-left: 10px">
                <h3 style="font-size: 16px"></h3>
                <h3 style="font-size: 16px"></h3>
                <h3 style="font-size: 16px"></h3>
            </div>
        </div>
    </div> -->
</footer>
    
</html>
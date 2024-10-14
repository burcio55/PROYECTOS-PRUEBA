<?php
include("header.php");
?>

<br>
<main>
    <div class="content-3d">

        <div class="container">
            <?
            include('menu2.php');
            ?>

            <div class="content-login">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 style="font-size:32px; font-weight: normal;">MANTENIMIENTO - Usuarios</h1>
                    </div>
                    <div class="col-sm-6"></div>

                    <div class="col-sm-4"></div>
                    <div class="sep"></div>
                    <div class="col-sm-4">
                        <h2 style="color: rgb(35, 96, 249); font-size:22px;">Rol(es) de Usuario</h2>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                    </div>
                    <hr>


                    <div class="col-sm-6"> <label for="basic-url" class="form-label" style="margin-top:10px">Cédula de Identidad <span>*</span> </label> <span></span>
                        <div class="input-group">

                            <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                <img src="img/co.png" class="input-imagen">
                            </span>
                            <select id="nacionalidad" class="input-group-text">
                                <option value="-1">-</option>
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
                    <div class="sep"></div>
                    <div class="col-sm-6">
                        <label for="basic-url" class="form-label">Nombre(s) y Apellido(s) </label>
                        <div class="input-group">
                            <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                <img src="img/co.png" class="input-imagen">
                            </span>
                            <input type="text" class="form-control" style="background: #b6b4b4b2; color: #313131;border-radius: 0 30px 30px 0;" id="nombres" value="Ej. Natalia" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="basic-url" class="form-label">Nuevo Rol<span>*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="addon-wrapping"> <img src="img/co.png" class="input-imagen"> </span>
                            <select id="rol" class="form-select" style="border-radius: 0 30px  30px 0;">
                                <option value="-1" selected>Seleccione</option>
                                <option value="84">Administrador</option>
                                <option value="85">Analista</option>
                                <option value="86">Evaluador</option>
                                <option value="87">Evaluado</option>
                            </select>
                        </div>
                    </div>
                    <div class="sep"></div>
                    <hr>

                    <br>

                    <div class="col-12" style="text-align:center;">
                        <a href="menu.php"><button class="btn" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>
                        <button class="btn" onclick="asignar()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Asignar</button>
                        <button type="button" onclick="inhabilitar()" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Inhabilitar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/usu.js"></script>
<!-- <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script> -->
<? include("footer.php"); ?>
</body>

</html>
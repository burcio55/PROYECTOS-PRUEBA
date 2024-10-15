<?php
    include('bd.php');
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marca</title>
    <link rel="stylesheet" href="css/estilos3.css">
    <link rel="stylesheet" href="css/alerta.css">
    <!-- Bootstrap V5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="code.jquery.com_jquery-3.7.0.js"></script>
</head>
<div id="observacion" class="fondo_alerta" style="display: none;">
    <div class="alerta">
        <h4 id="titulo">Atención</h4>
        <p id="texto">Datos guardados exitosamente</p>
        <div class="sep"></div>
        <center><button type="button" onclick="finalizar()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Finalizar</button></center>
        <div class="sep"></div>
    </div>
</div>

<input type="text" style="display: none;" id="id_marca">

<div id="borrar_marca" class="fondo_alerta" style="display: none;">
        <div class="alerta">
            <h4 id="titulo3">Advertencia</h4>
            <p id="texto3"></p>
            <div class="sep"></div>
            <center>
                <button type="button" onclick="cerrarAlerta()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Cancelar</button>
                <button type="button" onclick="eliminar_marca()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip2">Continuar</button>
            </center>
            <div class="sep"></div>
        </div>
</div>

<input type="text" value="" style="display: none" id="validador">
<body>
    <!-- Cabezera -->
    <header>
        <div class="logo"></div>
    </header>
    <!-- Contenido -->
<main>
    <div class="content-3d">
        <div class="col-sm-12-h">
        <?
       include('menuprincipal.php');
        ?>  
    </div>
    <div class="content-login">            
        <div class="content">
         <!--primer contenedor -->
            <div class="row">
            <!--Titulo -->
                <div>
                    <h2>MANTENIMIENTO - Catálogos - Marca</h2>
                    <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                </div>
            </div>
<hr> 
            <div class="col-sm-9" style=" align-items: center;">
                <div class="input-group">
                    <label for="basic-url" class="form-label" style="margin-top:10px">Marca: <span> *</span><span class="mma"></span></label>
                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                        <img src="img/marca.png" class="input-imagen">
                    </span>
                    <input type="text" class="form-control" aria-describedby="basic-addon3 basic-addon4" onKeyUp="mayusculas(this);" placeholder="Ingrese la nueva Marca" id="marc2" name="marc2" required>
                    <input type="text" id="id_proceso" name="id_proceso" value="marc2" style="display: none">
                    <button  type="button" onclick="agregar_marca()" id="bt1" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; border-radius: 0 30px 30px 0; " onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Agregar</button>
                    <button onclick="editar_marca2(id_proceso.value,marc2.value)" id="bt2" type="button" style=" display:none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; " onmouseout="this.style.color=&quot;#fff&quot;; this.style.backgroundColor=&quot;#46A2FD&quot;; this.style.border=&quot;1px Solid #46A2FD&quot;" onmouseover="this.style.color=&quot;#46A2FD&quot;; this.style.backgroundColor=&quot;#fff&quot;;" data-bs-toggle="tooltip">Actualizar</button>
                    <a href=""><button type="button" id="bt4" style="display: none; margin-top:0; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 8px 22px; border-radius: 0 30px 30px 0; font-size:16px " onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Nuevo</button></a>
                    <div class="col-sm-3"></div>
                </div>    
            </div>  
<br>
                <div class="col-sm-10">
                    <table id="miTabla2"class="table table-striped" style="border-radius: 30px; text-align: center;">
                        <thead style="background-color: #46A2FD;">
                            <tr>
                                <th>Nro.</th>
                                <th style="text-align: left;">Marca</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla">
                            <?
                                $consulta = "SELECT *  FROM reporte_tecnico.marca WHERE benabled = 'true'";
                                $row = pg_query($conn, $consulta);
                                $i = 0;
                                //$valor = pg_fetch_assoc($row);

                                while ($valor = pg_fetch_assoc($row)) {
                                    $i++;
                                    echo ('
                                    <tr>
                                        <td>'.$i.'</td>
                                        <td style="text-align: left;">'.$valor['sdescripcion'].'</td>
                                        <td style="width: 10%;">
                                            <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"\' onmouseover=\'this.style.color="#46A2FD"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip" onclick="editar_marca(' . $valor['id'] . ',\'' . $valor['sdescripcion'] . '\')">Modificar</button>
                                        </td>
                                        <td style="width: 10%;">
                                            <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout=\'this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"\' onmouseover=\'this.style.color="#dc3545"; this.style.backgroundColor="#fff";\' data-bs-toggle="tooltip" onclick="borrar_marca('.$valor['id'].')">Eliminar</button>
                                        </td>
                                    </tr>');
                                }
                            ?>
                            <!-- Puedes agregar más filas aquí -->
                        </tbody> 
                    </table>
                    <br>
                </div>
        </div> 
    
                <div class="col-12">
                    <a href="menu.php"><button class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>
                </div>

           <br>
    </div>
</main>
     <script src="tablas2.js"></script>
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
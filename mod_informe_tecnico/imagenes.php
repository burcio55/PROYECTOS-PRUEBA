<?
    include('based.php'); 
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Técnico: Adjuntar Imagenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="code.jquery.com_jquery-3.7.0.js"></script>
</head>
<body>
<div class="logo"></div>
<br>
<div class="container">
    <?
    include('menuprincipal.php');
    ?>  
    <div class="container2"> 
    <br>
    <br>
    <h4 style="color:#0d6efd; font-weight:normal;">Adjuntar Imagen(es)</h4>
            <hr>
            <br>
            <div class="input-group">
                    <form action="cargar.php"  method="POST" enctype="multipart/form-data"> 
                        <input type="file" class="form-control" id="imagen" name="imagen" width="80%">
                        <input type="submit" value="Agregar Imagen" class="form-control btn btn-success" name ="registrar_imagen" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; border-radius: 0 30px 30px 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">
                    </form>
            </div>
            <br>
            <table class="table" style="text-align: center; ">
                <thead>
                    <tr>
                        <th scope="col">Nro.</th>
                        <th scope="col">Imagen(es)</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <td>1</td>
                        <td><div class="input-group" >
                                <img src="img/img3.jpg">
                            </div>
                        </td>
                        <td><button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>                        
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><div class="input-group">
                                <img src="img/img2.jpg">
                            </div>
                        </td>
                        <td><button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>                        
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><div class="input-group">
                                <img src="img/img1.jpg">
                            </div>
                        </td>
                        <td><button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>                        
                    </tr>                                            
                    </tbody>
                </table>
                <br>
                <br>
                <br>
            <form action="cargar.php" method="" class="input-group">
                <div class="col-12" style="text-align:center;">
                    <button class="btn btn-primary" onclick="regresar()" type="button" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>
                    <button class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Guardar</button>
                </div>
            </form>
    </div>
</div>
<script src="registrar.js"></script>
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



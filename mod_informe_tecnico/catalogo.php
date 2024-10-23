<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="css/estilos3.css">
    <!-- Bootstrap V5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<div id="observacion" class="fondo_alerta" style="display: none;">
    <div class="alerta">
        <h4 id="titulo">Atención</h4>
        <p id="texto">Datos guardados exitosamente</p>
        <div class="sep"></div>
        <center><button type="button" onclick="cerrar_alert()" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Cerrar</button></center>
        <div class="sep"></div>
    </div>
</div>
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
              <!-- -->
             
                <div class="content">
                       <!--primer contenedor -->
                    <div class="row">
                       <!--Titulo -->
                       <div class="col-sm-4"><h1>Catálogos</h1></div>
                        <div class="col-sm-5"></div>
                        <div class="col-sm-3">
                            <h6 class="obligatorio">Datos Obligatorios (*)</h6>
                        </div>
                    </div>
             <hr> 
                
                    <div class="col-sm-8"> <label for="basic-url" class="form-label"  >Estatus:</label><span> *</span>
                        <div class="input-group">                                      
                            <span class="input-group-text"style="border-radius: 30px 0 0 30px;" id="basic2">
                                <img src="img/estatus.png" class="input-imagen">
                            </span>
                                    <input type="text" class="form-control"  style="" id="or2" aria-describedby="basic-addon3 basic-addon4" placeholder="Ingrese el nuevo Estatus">
                                <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; border-radius: 0 30px 30px 0; " onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Agregar</button>
                                <div class="col-sm-3"></div>
                        </div>      
                    </div>
                    <br>
                        <table id="miTabla2"class="table table-striped table1" style="border-radius: 30px;width: auto;align-items: center;">
                            <thead>
                                
                                <tr>
                                    <th>Número</th>
                                    <th>Estaus</th>
                                    <th>Acciones</th>
                                 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Operativo</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>2</td>
                                    <td>No Operativo</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>3</td>
                                    <td>Desincorporado</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                  
                                
                                <!-- Puedes agregar más filas aquí -->
                            </tbody>
                        </table>
                        <br>
                    </div>
<hr color="#46A2FD">
<br>
                        <div class="col-sm-12" style=" align-items: center;">
                           <label for="basic-url" class="form-label" >Marca:</label><span> *</span>
                            <div class="input-group">
                            
                             

                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="img/marca.png" class="input-imagen">
                                </span>
                                <input type="text" class="form-control"  style="" id="marc2" aria-describedby="basic-addon3 basic-addon4" placeholder="Ingrese la nueva Marca">
                                <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; border-radius: 0 30px 30px 0; " onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Agregar</button>
                                 <div class="col-sm-3"></div>
                            </div>
                           
                        <br>
                        <table id="miTabla2"class="table table-striped" style="border-radius: 30px;width: auto;align-items: center;">
                            <thead style="background-color: #46A2FD;">
                            
                                <tr >
                                    <th>Número</th>
                                    <th>Marca</th>
                                    <th>Acciones</th>
                                 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>VIT</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>2</td>
                                    <td>DELL</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>3</td>
                                    <td>DAEWOO</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>4</td>
                                    <td>ESGLE</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>5</td>
                                    <td>IMEXX</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>6</td>
                                    <td>APLEE</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>7</td>
                                    <td>TPLINK</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>8</td>
                                    <td>PEAKE</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>9</td>
                                    <td>HAIER</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                
                                <!-- Puedes agregar más filas aquí -->
                            </tbody>
                           
                        </table>

                </div>       <hr>   

<br>
                <div class="col-sm-12" style=" align-items: center;">
                    <label for="basic-url" class="form-label" >Tipo de Equipo:</label><span> *</span>
                        <div class="input-group">
                           

                            
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="img/tipo.png" class="input-imagen">
                                </span>
                                <input type="text" class="form-control"  style="" id="colr2" aria-describedby="basic-addon3 basic-addon4" placeholder="Ingrese el nuevo Equipo">

                                <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px;margin-top:0; border-radius: 0 30px 30px 0; " onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Agregar</button>
                                <div class="col-sm-3"></div>
                            </div>
                           
                        <br>
                        <table id="miTabla2"class="table table-striped" style="border-radius: 30px;width: auto;align-items: center;">
                            <thead>
                            
                                <tr>
                                    <th>Número</th>
                                    <th>Tipo de Equipo</th>
                                    <th>Acciones</th>
                                 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Teclado</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>2</td>
                                    <td>Disco duro</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>3</td>
                                    <td>CPU</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>4</td>
                                    <td>Monitor</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <tr>
                                <td>5</td>
                                    <td>Memoria RAM</td>
                                  
                                    <td> <button  type="button" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Editar</button>
                                <button  type="button" style="background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#dc3545"; this.style.border="1px Solid #dc3545"' onmouseover='this.style.color="#dc3545"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Eliminar</button></td>
                                </tr>
                                <!-- Puedes agregar más filas aquí -->
                            </tbody>
                           
                        </table>

                </div>
                            
    
                        <hr>
                        <div class="row">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-2">
                        <a href="menu.php"><button class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>
                        </div>
                        <div class="col-sm-5"></div>
                        </div>
                    </div>         
                
            </div>
        </div>
    </main>
        <script src="js/login.js"></script>
        <script src="javascript/code.jquery.com_jquery-3.7.0.js"></script>
    <script src="javascript/cdn.tailwindcss.com_3.3.3"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_dataTables.tailwindcss.min.js"></script>
    <script src="javascript/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
    <!-- Pie de página -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="border-right: 1px solid white;">
                    <h3 class="sep-3" style="font-size: 16px;">División de Soporte Técnico</h3>
                </div>
                <div class="col-md-6">
                    <h3 style="font-size: 16px">Oficina de Tecnología de la Información y la Comunicación (OTIC).</h3>
                    <h3 style="font-size: 16px">División de Análisis y Desarrollo de Sistemas.</h3>
                    <h3 style="font-size: 16px">© 2024 Todos los Derechos Reservados.</h3>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
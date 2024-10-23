<!DOCTYPE html>
<html lang="Es-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos5.css">
</head>
<body> 

<div class="logo"></div>
<br>
<div class="container">
    <?
    include('menuprincipal.php');
    ?>  
    <div class="container2">
        <h1>CONSULTA - Serial</h1>
        <br>
        <h6 class="obligatorio" style="text-align:right">Datos Obligatorios (*)</h6>  
        <hr>  
        <br>
        <div class="row"> 
            <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="col-sm-3"></div>
                    <div class="input-group mb-6">
                        <label for="basic-url" class="form-label" style="margin-top:10px">Nro. de Serial <span> *</span> </label> <span class="mma"></span>
                        <span class="input-group-text" style="border-radius: 30px 0 0 30px" id="addon-wrapping"><img src="img/bandera.png" class="icon"></span>
                        <input type="text" class="form-control" placeholder="Ej. A000092393" id="cedula">
                        <button onclick="buscar()" type="button" style="background-color: rgb(70, 162, 253); color: rgb(255, 255, 255); border: 1px solid rgb(70, 162, 253); padding: 7px 22px; border-radius: 0px 30px 30px 0px; width: auto; margin-left: -15px;" onmouseout="this.style.color=&quot;#fff&quot;; this.style.backgroundColor=&quot;#46A2FD&quot;; this.style.border=&quot;1px Solid #46A2FD&quot;" onmouseover="this.style.color=&quot;#46A2FD&quot;; this.style.backgroundColor=&quot;#fff&quot;;" data-bs-toggle="tooltip">Buscar</button>
                    </div>
                </div>
  <br>
  <br>
  <br>
  <br>
        
        <h3 style="color:#0d6efd;">Datos del Solicitante</h3>
        
        <hr>
    <br>
        
            <div class="col-sm-4"></div>
            <div class="col-sm-4" style="align-items:center;">
                <label for="basic-url" class="form-label">Cédula de Identidad</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nacionalidad" value="Ej. 12.896.523" disabled>
                </div>
            </div>
            <div class="col-sm-4"></div>
            <div class="sep"></div>
            <div class="col-sm-6">
                <label for="basic-url" class="form-label">Nombre(s)</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nacionalidad" value="Ej. Natalia" disabled>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="basic-url" class="form-label">Apellido(s)</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nacionalidad" value="Ej. Gomez" disabled>
                </div>
            </div>
            <div class="sep"></div>
            <div class="col-sm-6">
                <label for="basic-url" class="form-label">Ubicación Administrativa de Adscripción</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nacionalidad" value="Ej. Despacho del Ministro" disabled>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="basic-url" class="form-label">Ubicación Física</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nacionalidad" value="Ej. Recursos Humanos" disabled>
                </div>
            </div>
            <div class="sep"></div>
            <div class="col-sm-6">
                <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo Titular</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nacionalidad" aria-describedby="basic-addon3 basic-addon4" value="Ej. Coordinador" disabled>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="basic-url" class="form-label">Cargo o Puesto de Trabajo que Ejerce</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style="border-radius: 30px 0 0 30px;"><img src="img/nombre.png" class="icon"></span>
                    <input type="text" class="form-control" style="background: #b6b4b4b2;" id="nacionalidad" aria-describedby="basic-addon3 basic-addon4" value="Ej. Jefe" disabled>
                </div>
            </div>
        </div>
        <br>
        <br>

            <h3 style="color:#0d6efd;">Especificaciones del Equipo</h3>
            <hr>
            <form class="row g-3">
                    <div class="col-md-4" >
                       <label for="inputmodelo" class="form-label">Bien Público</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/bp.png" class="icon"> </span>
                            <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. 39985" disabled>
                        </div> 
                    </div>
                    <div class="col-md-4">
                       <label for="inputmodelo" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"> <img src="img/equipo.png" class="icon"> </span>
                                <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. OTICADS-007"> 
                            </div>
                    </div>
                    <div class="col-md-4">
                       <label for="inputState" class="form-label">Tipo de Dispositivo</label>
                       <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"> <img src="img/tipo.png" class="icon"> </span>
                            <input id="inputState" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. Disco Duro">
                        </div>
                    </div>
                </form>
                <br>
                <form class="row g-3">
                    <div class="col-md-4">
                       <label for="inputState" class="form-label">Estatus </label>
                       <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"> <img src="img/estatus.png" class="icon"> </span>
                            <input id="inputState" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. Operativo" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <label for="inputmarca" class="form-label">Marca </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/marca.png" class="icon"> </span>
                            <input id="inputState" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. VIT" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                       <label for="inputmodelo" class="form-label">Modelo </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"> <img src="img/equipo.png" class="icon"> </span>
                            <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. VIT 2710-01" disabled>  
                        </div>           
                    </div>

                </form>
                <br>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="inputserial" class="form-label">Serial </label>
                        <div class="input-group">  
                            <span class="input-group-text" id="basic-addon1"> <img src="img/serial.png" class="icon"> </span>
                            <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. A000183569" disabled>
                        </div> 
                    </div>
                    <div class="col-md-4">
                       <label for="inputmodelo" class="form-label">Disco Duro </label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"> <img src="img/dd.png" class="icon"> </span>
                                <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. 320GB SATA" disabled> 
                            </div>
                    </div>

                   <div class="col-md-4">
                       <label for="inputmodelo" class="form-label">Memoria RAM </label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"> <img src="img/mr.png" class="icon"> </span>
                                <input type="text" class="form-control" style="background: #b6b4b4b2;" placeholder="Ej. 4GB disabled"> 
                            </div>
                   </div> 
               </form>
        <br>

               <div class="form-floating mb-3">Observación(es)
                   <input class="form-control" id="floatingTextarea2" style="height: 80px; background: #b6b4b4b2;" disabled></input>
               </div>
<br>
               <div class="form-floating mb-3">Recomendación(es) del Técnico
                   <input class="form-control" id="floatingTextarea2" style="height: 80px; background: #b6b4b4b2;" disabled></input>
               </div>
             <br>
             <br>
                <table class="table" style="text-align: center; margin:auto;">
                    <thead>
                        <tr>
                            <th scope="col">Tipo</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Bien Público</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Estatus</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>CPU</td>
                            <td>Dell</td>
                            <td>DCSM</td>
                            <td>0046434</td>
                            <td>49HHXFI</td>
                            <td>No Operativo</td>
                        </tr>
                        <tr>
                            <td>CPU</td>
                            <td>Dell</td>
                            <td>DCSM</td>
                            <td>0025357</td>
                            <td>6GHHXFI</td>
                            <td>No Operativo</td>
                        </tr>
                        <tr>
                            <td>CPU</td>
                            <td>VIT</td>
                            <td>VIT 2600</td>
                            <td>0034273</td>
                            <td>A000018260</td>
                            <td>No Operativo</td>
                        </tr>
                    </tbody>
                </table>
            <br>
            <br>
                <h3 style="color:#0d6efd;">Adjuntar Imagen(es)</h3>
            <hr>
                <table class="table" style="text-align: center; margin:auto;">
                    <thead>
                        <tr>
                            <th scope="col">Nro.</th>
                            <th scope="col">Imagen(es)</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>1</td>
                            <td><div class="input-group">
                                    <img src="img/img3.jpg">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><div class="input-group">
                                    <img src="img/img2.jpg">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><div class="input-group">
                                    <img src="img/img1.jpg">
                                </div>
                            </td>
                        </tr>                                          
                    </tbody>
                </table>
                <br>
    
                <br>
                <div class="col-12" style="text-align:center;">
               <a href="menu.php"><button class="btn btn-primary" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'>Regresar</button></a>
               <button class="btn btn-secondary" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Imprimir</button>
             </div>
    </div>
</div>

</body> 
<footer>
        <div class="container3">
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
</html>
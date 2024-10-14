<?php
      include "conexion.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIENES PUBLICOS</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/alerta.css">
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
        <img src="imagenes/cintillo_institucional.jpg">
    </header>
    <!-- Contenido -->
    <main>
        <div class="content-3d">
            <div class="col-sm-12">
            <?
                        include "menu.php";
                    ?>
                    </div>
            <div class="content-login">
              
                <div class="content">
                    <div class="row">
                   
                    
                    <div class="col-sm-6"><h1 style="font-size:32px; font-weight: normal;">BIENES PÚBLICOS-Asignar</h1></div>
                    <div class="col-sm-3" style="text-align: center;"></div>
                    <div class="col-sm-3">        </div>
                  
                     </div>


                    <div class="content">
                     <div class="row">
                     <div class="sep"></div>
                    <div class="sep"></div>
                    <div class="col-sm-6">
                    <h2 style="color: rgb(35, 96, 249); font-size:22px;">Responsable Patrimonial</h2>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"><h6 class="obligatorio">Datos Obligatorios (*)</h6>
                        <br>
                      
                    </div>
                    
                    <hr>
                        <div class="sep"></div>
                            <div class="input-group">
                                <div class="col-sm-3"></div>
                                 <label for="inputPassword2" class="form-label" style="margin-top:auto;">Cédula de Identidad </label><span  style="margin-right:10px;"> * </span>
                                
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/ci.png" class="input-imagen"></span>
                                                       
                                <select  class="input-group-text" style="" id="nacionalidad" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> - </option>
                                    <option value="1"> V- </option>
                                    <option value="2"> E </option>
                                    
                                </select>

                                <input type="text" class="form-control" id="ci1" placeholder="Ingrese una cédula de indentidad" >
                                <input type="text" style="display:none;" class="form-control" id="id_c1" placeholder="Ingrese una cédula de indentidad" >
                                <button onclick="busq_cedula1(nacionalidad.value,ci1.value,)" type="button"class="input-group-text" style="margin-top:0;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 0 30px 30px 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Buscar</button>
                                <div class="col-sm-3"></div>
                                
                            </div>
                            
                            <div class="sep"></div>
                                <div class="col-sm-4"><label for="" class="form-label"style="margin-top:auto;">Cédula de Identidad</label>
                                      <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bci1"class="form-control" placeholder="Ej. 16585991" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled value=""> 
                                    </div>
                                    
                                 </div>
                            
                                <div class="col-sm-4"><label for="" class="form-label"style="margin-top:auto;">Nombre(s)</label>
                                    <div class="input-group">                                    
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bn1" class="form-control" placeholder="Ej. David" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                
                                </div>
                                <div class="col-sm-4"> <label for="" class="form-label"style="margin-top:auto;">Apellido(s)</label>
                                    <div class="input-group">
                                   
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="ba1" class="form-control" placeholder="Ej. Ortega" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="sep"></div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Cargo o Puesto de Trabajo Titular</label>
                                    <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bct1" class="form-control" placeholder="Ej. Coordinador" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Cargo o Puesto de Trabajo que Ejerce</label>
                                    <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bce1" class="form-control" placeholder="Ej. Jefe" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="sep"></div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Ubicación Administrativa</label>
                                    <div class="input-group">                                   
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bua1" class="form-control" placeholder="Ej. Oficina Central" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                                                      
                                </div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Ubicación Física</label>
                                    <div class="input-group">                                   
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="buf1" class="form-control" placeholder="Ej. Recursos Humanos" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                                                      
                                </div>
                              
                       


                    </div>
                </div>
                
                <br>
              
                <div class="content">
                   <div class="row">
                    <div class="sep"></div>
                    <div class="col-sm-6">
                    <h2 style="color: rgb(35, 96, 249); font-size:22px;">Jefe de  Dependencia</h2>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <br>
                       
                    </div>
                    <hr>
                    <div class="sep"></div>
                            <div class="input-group">
                                <div class="col-sm-3"></div>
                                 <label for="inputPassword2" class="form-label" style="margin-top:auto;">Cédula de Identidad </label><span  style="margin-right:10px;"> * </span>
                                
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/ci.png" class="input-imagen"></span>
                                                       
                                <select  class="input-group-text" style="" id="nacionalidad2" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> - </option>
                                    <option value="1"> V- </option>
                                    <option value="2"> E </option>
                                    
                                </select>

                                <input type="text" class="form-control" id="ci2" placeholder="Ingrese una cédula de indentidad" >
                                <input type="text" style="display:none;" class="form-control" id="id_c2" placeholder="Ingrese una cédula de indentidad" >
                                <button onclick="busq_cedula2(nacionalidad2.value,ci2.value,)" type="button"class="input-group-text" style="margin-top:0;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 0 30px 30px 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Buscar</button>
                                <div class="col-sm-3"></div>
                                
                            </div>
                            
                            <div class="sep"></div>
                                <div class="col-sm-4"><label for="" class="form-label"style="margin-top:auto;">Cédula de Identidad</label>
                                      <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bci2"class="form-control" placeholder="Ej. 16585991" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled value=""> 
                                    </div>
                                    
                                 </div>
                            
                                <div class="col-sm-4"><label for="" class="form-label"style="margin-top:auto;">Nombre(s)</label>
                                    <div class="input-group">                                    
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bn2" class="form-control" placeholder="Ej. David" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                
                                </div>
                                <div class="col-sm-4"> <label for="" class="form-label"style="margin-top:auto;">Apellido(s)</label>
                                    <div class="input-group">
                                   
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="ba2" class="form-control" placeholder="Ej. Ortega" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="sep"></div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Cargo o Puesto de Trabajo Titular</label>
                                    <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bct2" class="form-control" placeholder="Ej. Coordinador" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Cargo o Puesto de Trabajo que Ejerce</label>
                                    <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bce2" class="form-control" placeholder="Ej. Jefe" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="sep"></div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Ubicación Administrativa</label>
                                    <div class="input-group">                                   
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bua2" class="form-control" placeholder="Ej. Oficina Central" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                                                      
                                </div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Ubicación Física</label>
                                    <div class="input-group">                                   
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="buf2" class="form-control" placeholder="Ej. Recursos Humanos" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                                                      
                                </div>
                              
                       


                    </div>
                
                <div class="content">
                <div class="row">
                    <div class="sep"></div>
                    <div class="sep"></div>
                    <div class="col-sm-6">
                    <h2 style="color: rgb(35, 96, 249); font-size:22px;">Responsable de Uso</h2>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <br>
                      
                    </div>
                    
                    <hr>
                    <div class="sep"></div>
                            <div class="input-group">
                                <div class="col-sm-3"></div>
                                 <label for="inputPassword2" class="form-label" style="margin-top:auto;">Cédula de Identidad </label><span  style="margin-right:10px;"> * </span>
                                
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/ci.png" class="input-imagen"></span>
                                                       
                                <select  class="input-group-text" style="" id="nacionalidad3" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> - </option>
                                    <option value="1"> V- </option>
                                    <option value="2"> E </option>
                                    
                                </select>

                                <input type="text" class="form-control" id="ci3" placeholder="Ingrese una cédula de indentidad" >
                                <input type="text" style="display:none;" class="form-control" id="id_c3" placeholder="Ingrese una cédula de indentidad" >
                                <button onclick="busq_cedula3(nacionalidad3.value,ci3.value,)" type="button"class="input-group-text" style="margin-top:0;background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 0 30px 30px 0;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip">Buscar</button>
                                <div class="col-sm-3"></div>
                                
                            </div>
                            
                            <div class="sep"></div>
                                <div class="col-sm-4"><label for="" class="form-label"style="margin-top:auto;">Cédula de Identidad</label>
                                      <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bci3"class="form-control" placeholder="Ej. 16585991" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled value=""> 
                                    </div>
                                    
                                 </div>
                            
                                <div class="col-sm-4"><label for="" class="form-label"style="margin-top:auto;">Nombre(s)</label>
                                    <div class="input-group">                                    
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bn3" class="form-control" placeholder="Ej. David" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                
                                </div>
                                <div class="col-sm-4"> <label for="" class="form-label"style="margin-top:auto;">Apellido(s)</label>
                                    <div class="input-group">
                                   
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="ba3" class="form-control" placeholder="Ej. Ortega" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="sep"></div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Cargo o Puesto de Trabajo Titular</label>
                                    <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bct3" class="form-control" placeholder="Ej. Coordinador" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Cargo o Puesto de Trabajo que Ejerce</label>
                                    <div class="input-group">
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bce3" class="form-control" placeholder="Ej. Jefe" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>
                                </div>
                                <div class="sep"></div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Ubicación Administrativa</label>
                                    <div class="input-group">                                   
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="bua3" class="form-control" placeholder="Ej. Oficina Central" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                                                      
                                </div>
                                <div class="col-sm-6"><label for="" class="form-label"style="margin-top:auto;">Ubicación Física</label>
                                    <div class="input-group">                                   
                                    
                                      <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">  <img src="imagenes/verificar.png" class="input-imagen"></span>
                                      <input type="text" id="buf3" class="form-control" placeholder="Ej. Recursos Humanos" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" disabled>
                                    </div>                                                                      
                                </div>
                              
                       


                    </div>
                    
                       
                      
                    <div class="row">
                    <div class="sep"></div>
                    <div class="sep"></div>
                        <div class="col-sm-4">
                        <h2 style="color: rgb(35, 96, 249); font-size:22px;">Bien(es) Público(s)</h2>
                        </div>
                        <div class="col-sm-5"></div>
                        <div class="col-sm-3">
                        <br>
            
                     </div>
                    <hr>
                    <div class="sep"></div>
                    <div class="col-sm-2">
                                <label for="basic-url" class="form-label">Nro del B.P </label><span> *</span>
                                <div class="input-group">
                                    <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic1">
                                        <img src="imagenes/co.png" class="input-imagen">
                                    </span>
                                    <input type="text" class="form-control" maxlength="8" style="border-radius: 0 30px 30px 0;" id="cbp2" aria-describedby="basic-addon3 basic-addon4" placeholder="Nro B.P">
                                    <input type="text"  class="form-control" maxlength="8" style="display:none;border-radius: 0 30px 30px 0;" id="id_cbp2" aria-describedby="basic-addon3 basic-addon4" placeholder="Nro B.P">
                                </div>
                            
                        </div>
                    <div class="col-sm-6">
                            <label for="basic-url" class="form-label">Descripción </label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/producto.png" class="input-imagen">
                                </span>
                                <select class="form-select" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" id="dbp2" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    <option value="-1"> Seleccione... </option>
                                    <?php
                                    $sql="SELECT * FROM bienes_publicos.productos WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row=pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);
                                    foreach ($persona as $a) {
                                        ?>
                                            <option value="<? echo $a['id']; ?>"><? echo $a['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="basic-url" class="form-label">Origen</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/producto.png" class="input-imagen">
                                </span>
                                <select class="form-select" style="border-radius: 0 30px 30px 0;background: #b6b4b4b2;" id="or2" aria-describedby="basic-addon3 basic-addon4" disabled>
                                    <option value="-1"> Seleccione... </option>
                                    <?php
                                    $i=0;
                                    $sql="SELECT * FROM bienes_publicos.origen WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row=pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);
                                    foreach ($persona as $u) {
                                        ?>
                                            <option value="<? echo $u['id']; ?>"><? echo $u['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                
                                </select>
                            </div>
                        </div>
                        
                        
                        
                        <div class="a"><br></div>
                        <div class="col-sm-4">
                            <label for="basic-url" class="form-label">Marca</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/identidad.png" class="input-imagen">
                                </span>
                                <select class="form-select" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled id="marc2" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> Seleccione... </option>
                                    <?php
                                    $i=0;
                                    $sql="SELECT * FROM bienes_publicos.marca WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row=pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);
                                    foreach ($persona as $m) {
                                        ?>
                                            <option value="<? echo $m['id']; ?>"><? echo $m['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                </select>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label for="basic-url" class="form-label">Modelo</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/bosquejo.png" class="input-imagen">
                                </span>
                                <input type="text" id="model2" class="form-control"  style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled  aria-describedby="basic-addon3 basic-addon4" placeholder="Modelo">
                            </div>
                        
                    </div>
                    <div class="col-sm-4">
                            <label for="basic-url" class="form-label">Serial</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/contrasena.png" class="input-imagen">
                                </span>
                                <input type="text" id="serl2" class="form-control"  style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled  aria-describedby="basic-addon3 basic-addon4" placeholder="Serial" min="20">
                            </div>
                        
                    </div>
                    <div class="a"><br></div>
                    <div class="col-sm-4">
                            <label for="basic-url" class="form-label">Color</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/paleta.png" class="input-imagen">
                                </span>
                                <select class="form-select" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled id="colr2" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> Seleccione... </option>
                                    <?php
                                    $i=0;
                                    $sql="SELECT * FROM bienes_publicos.color WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row=pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);
                                    foreach ($persona as $c) {
                                        ?>
                                            <option value="<? echo $c['id']; ?>"><? echo $c['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                  
                                  
                                </select>
                            </div>
                        </div>
                          <div class="col-sm-4">
                            <label for="basic-url" class="form-label">Condición Física</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/ciudad.png" class="input-imagen">
                                </span>
                                <select class="form-select" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled id="cf2" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> Seleccione... </option>
                                   
                                    <?php
                                    $i=0;
                                    $sql="SELECT * FROM bienes_publicos.condicion_fisica WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row=pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);
                                    foreach ($persona as $a) {
                                        ?>
                                            <option value="<? echo $a['id']; ?>"><? echo $a['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                   
                              
                                   
                                </select>
                            </div>                        
                        </div>
                    <div class="col-sm-4">
                            <label for="basic-url" class="form-label">Estado</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/ciudad.png" class="input-imagen">
                                </span>
                                <select class="form-select" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled id="est2" aria-describedby="basic-addon3 basic-addon4">
                                <option value="-1"> Seleccione... </option>
                                <?php
                                    $i=0;
                                    $sql="SELECT * FROM bienes_publicos.estado WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row=pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);
                                    foreach ($persona as $e) {
                                        ?>
                                            <option value="<? echo $e['id']; ?>"><? echo $e['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                </select>
                            </div>                        
                        </div>
                      
                        <div class="a"><br></div>
                        
                        <div class="col-sm-3">
                            <label for="basic-url" class="form-label">Valor</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/vbp.png" class="input-imagen">
                                </span>
                                <input type="number"  class="form-control" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled id="vbp2" aria-describedby="basic-addon3 basic-addon4" placeholder="Ingrese el valor en Bs">
                            </div>                        
                        </div>
                        <div class="col-sm-3">
                            <label for="basic-url" class="form-label">Nro. Orden de Compra</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/oc.png" class="input-imagen">
                                </span>
                                <input type="number"  class="form-control" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled id="oc2" aria-describedby="basic-addon3 basic-addon4" placeholder="Nro. Orden de Compra">
                            </div>                        
                        </div>
                        <div class="col-sm-3">
                            <label for="basic-url" class="form-label">Fecha de Orden de Compra</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px; background: #b6b4b4b2;"  id="basic-addon3">
                                    <img src="imagenes/re.png" class="input-imagen">
                                </span>
                                <input type="date" class="form-control" style="border-radius: 0 30px 30px 0;" id="foc2" aria-describedby="basic-addon3 basic-addon4" disabled>
                            </div>                        
                        </div>
                        <div class="col-sm-3">
                            <label for="basic-url" class="form-label">Cuenta Contable</label><span> *</span>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/cc.png" class="input-imagen">
                                </span>
                                <select class="form-select" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled id="cc2" aria-describedby="basic-addon3 basic-addon4">
                                    <option value="-1"> Seleccione... </option>
                                    <?php
                                    $i=0;
                                    $sql="SELECT * FROM bienes_publicos.cuenta_contable WHERE benabled='TRUE' ORDER BY sdescripcion ASC";
                                    $row=pg_query($conn, $sql);
                                    $persona = pg_fetch_all($row);
                                    foreach ($persona as $cc) {
                                        ?>
                                            <option value="<? echo $cc['id']; ?>"><? echo $cc['sdescripcion']; ?></option>
                                        <?
                                        }
                                        ?>
                                   
                                </select>
                            </div>                        
                        </div>
                        <div class="a"><br></div>
                        <div class="col-sm-9">
                            <label for="basic-url" class="form-label">Observación(es)</label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/ob.png" class="input-imagen">
                                </span>
                                <input type="text" id="obs2" class="form-control" style="border-radius: 0 30px 30px 0; background: #b6b4b4b2;" disabled aria-describedby="basic-addon3 basic-addon4" placeholder="Escriba cualquier observación(es)">
                            </div>                        
                        </div>
                        <div class="col-sm-3">
                            <label for="basic-url" class="form-label">Fecha de Asignación</label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 30px 0 0 30px;" id="basic-addon3">
                                    <img src="imagenes/ob.png" class="input-imagen">
                                </span>
                                <input type="date" id="fa" class="form-control" style="border-radius: 0 30px 30px 0; "  aria-describedby="basic-addon3 basic-addon4" placeholder="Escriba cualquier observación(es)">
                            </div>                        
                        </div>
                        <div class="col-sm-5"></div>
                        <div class="col-sm-2" style="text-align: center;"><br>
                        
                        <button onclick="accion_buscar_bp(cbp2.value)" type="submit" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip"  id="motivo_agr">Buscar</button>
                        <button onclick="accion_motivo(cbp.value,dbp.value,or.value,marc.value,model.value,serl.value,colr.value,est.value,cf.value,obs.value,vbp.value,oc.value,foc.value,cc.value)" type="submit" style="display:none; background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip"  id="motivo_agr">Agregar</button>
                       
                        <br><br></div>   <div class="col-sm-5"></div> 
                        
                        
                     <div class="col-sm-12">
                    <table id="tabla_motivo"class="table table-striped"><br><br>
                        <thead id="bienp">
                            <tr> <hr>
                                <th >Nro.</th>
                                <th scope="col">Bien Público</th>
                        
                                <th>Marca</th>
                                <th>Modelo</th>
                        
                                <th>Serial</th>
                                <th> Color</th>
                                <th>Estado</th>
                                <th style="text-align:center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="fe">
                         <?php
                            $sql2="SELECT * FROM bienes_publicos.bienes_publicos_personas;"; 
                            $row2 = pg_query($conn, $sql2);
                            $aux = pg_num_rows($row2);
                            $or1 = pg_fetch_assoc($row2);
                            $cantidad = $or1['id'] + $aux;
                            //echo $or1['id'];
                            for ($i=$or1['id']; $i < $cantidad; $i++) {
                                $sql4="SELECT * FROM bienes_publicos.bienes_publicos_personas WHERE personales_id = '75372' and id = '".$i."';"; 
                                $row4 = pg_query($conn, $sql4);
                                $aux2 = pg_num_rows($row4);
                                $or2 = pg_fetch_assoc($row4);
                                echo $aux2;
                                //die();

                                if($aux2 > 0){
                                    $sql3="SELECT bienes_publicos.bienes_publicos. id,
                                        nnro_bien_publico,
                                        productos.sdescripcion as producto,
                                        productos.id as producto_id,
                                        origen.sdescripcion as origen,
                                        origen.id as origen_id,
                                        marca.sdescripcion as marca,
                                        marca.id as marca_id,
                                        smodelo,sserial,
                                        color.sdescripcion as color,
                                        color.id as color_id,
                                        condicion_fisica.sdescripcion as condicion_fisica,
                                        condicion_fisica.id as condicion_fisica_id,
                                        estado.sdescripcion as estado,
                                        estado.id as estado_id,
                                        nvalor,nnro_valor_compra,dfecha_orden_compra,
                                        cuenta_contable.sdescripcion as cuenta_contable,
                                        cuenta_contable.id as cuenta_contable_id,
                                        sobservaciones
                                        FROM
                                        bienes_publicos.bienes_publicos inner join bienes_publicos.color on
                                        color.id = bienes_publicos.color_id
                                        inner join bienes_publicos.marca on
                                        marca.id = bienes_publicos.marca_id
                                        inner join bienes_publicos.origen on
                                        origen.id = bienes_publicos.origen_id
                                        inner join bienes_publicos.estado on
                                        estado.id = bienes_publicos.estado_id
                                        inner join bienes_publicos.productos on
                                        productos.id = bienes_publicos.productos_id
                                        inner join bienes_publicos.condicion_fisica on
                                        condicion_fisica.id = bienes_publicos.condicion_fisica_id
                                        inner join bienes_publicos.cuenta_contable on
                                        cuenta_contable.id = bienes_publicos.cuenta_contable_id
                                        where bienes_publicos.benabled='TRUE' and bienes_publicos.id = '" . $or2['bienes_publicos_id'] . "' ORDER BY nnro_bien_publico ASC"; 
                                    //$cosa.= $sql3." //////////////// ";
                                    $row3 = pg_query($conn, $sql3);
                                    $or = pg_fetch_assoc($row3);
                             
                                        $i++;
                                        $cosa .= "
                                            <tr>
                                            <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
                                            <td class=\"td center\">" . $or['producto'] . "</td>
                                            <td class=\"td center\">" . $or['marca'] . "</td>
                                            <td class=\"td center\">" . $or['smodelo'] . "</td>
                                            <td class=\"td center\">" . $or['sserial'] . "</td>
                                            <td class=\"td center\">" . $or['color'] . "</td>
                                            <td class=\"td center\">" . $or['estado'] . "</td>
                                            <td class=\"td center\" id=\"botones\">
                                                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                                                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"accion_eliminar_regis(" . $or['id'] . ")\">Eliminar </button>
                                            </td>
                                            </tr>
                                        ";
                                }

                                //$cosa.= $sql4." //////////////// ";
                            } 
                            echo $cosa;
                            //echo $sql2;
                                 /* $i = 0;
                                 $sql2="SELECT * FROM bienes_publicos.bienes_publicos_personas"; 
                                 echo $sql2;
                                 die(); 
                                 $row2 = pg_query($conn, $sql2);
                                 $aux = pg_num_rows($row2);
                                 $or1 = pg_fetch_assoc($row2);
                                 echo $sql2;
                                 die();
                                 for ($i=$or1['id']; $i < $aux; $i++) { 

                                    $sql2="SELECT * FROM bienes_publicos.bienes_publicos_personas WHERE personales_id = '75372' and id = '.$or1['id'].'"; 
                                    $row2 = pg_query($conn, $sql2);
                                    $aux2 = pg_num_rows($row2);
                                    $or2 = pg_fetch_assoc($row2);

                                    $cosa.= $sql2." //////////////// ";

                                    if($aux2 > 0){ */
                                        /* $sql3="SELECT bienes_publicos.bienes_publicos. id,
                                        nnro_bien_publico,
                                        productos.sdescripcion as producto,
                                        productos.id as producto_id,
                                        origen.sdescripcion as origen,
                                        origen.id as origen_id,
                                        marca.sdescripcion as marca,
                                        marca.id as marca_id,
                                        smodelo,sserial,
                                        color.sdescripcion as color,
                                        color.id as color_id,
                                        condicion_fisica.sdescripcion as condicion_fisica,
                                        condicion_fisica.id as condicion_fisica_id,
                                        estado.sdescripcion as estado,
                                        estado.id as estado_id,
                                        nvalor,nnro_valor_compra,dfecha_orden_compra,
                                        cuenta_contable.sdescripcion as cuenta_contable,
                                        cuenta_contable.id as cuenta_contable_id,
                                        sobservaciones
                                        FROM
                                        bienes_publicos.bienes_publicos inner join bienes_publicos.color on
                                        color.id = bienes_publicos.color_id
                                        inner join bienes_publicos.marca on
                                        marca.id = bienes_publicos.marca_id
                                        inner join bienes_publicos.origen on
                                        origen.id = bienes_publicos.origen_id
                                        inner join bienes_publicos.estado on
                                        estado.id = bienes_publicos.estado_id
                                        inner join bienes_publicos.productos on
                                        productos.id = bienes_publicos.productos_id
                                        inner join bienes_publicos.condicion_fisica on
                                        condicion_fisica.id = bienes_publicos.condicion_fisica_id
                                        inner join bienes_publicos.cuenta_contable on
                                        cuenta_contable.id = bienes_publicos.cuenta_contable_id
                                        where bienes_publicos.benabled='TRUE' and bienes_publicos.id = '" . $or2['bienes_publicos_id'] . "' ORDER BY nnro_bien_publico ASC"; 
                                        $cosa.= $sql3." //////////////// "; */
                                        /* $row3 = pg_query($conn, $sql3);
                                        $or = pg_fetch_assoc($row3)
                             
                                         $i++;
                                         $cosa .= "
                                         <tr>
                                            <td class=\"td center\">" . $or['nnro_bien_publico'] . "</td>
                                            <td class=\"td center\">" . $or['producto'] . "</td>
                                            <td class=\"td center\">" . $or['marca'] . "</td>
                                            <td class=\"td center\">" . $or['smodelo'] . "</td>
                                            <td class=\"td center\">" . $or['sserial'] . "</td>
                                            <td class=\"td center\">" . $or['color'] . "</td>
                                            <td class=\"td center\">" . $or['estado'] . "</td>
                                            <td class=\"td center\" id=\"botones\">
                                                <button type=\"button\" class=\"btn btn-warning\" style=\"background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;                  \" onclick=\"accion_modificarregis('" . $or['id'] . "','" . $or['nnro_bien_publico'] . "','" . $or['producto_id'] . "','" . $or['origen_id'] . "','" . $or['marca_id'] . "','" . $or['smodelo'] . "','" . $or['sserial'] . "','" . $or['color_id'] . "','" . $or['condicion_fisica_id'] . "','" . $or['estado_id'] . "','" . $or['nvalor'] . "','" . $or['nnro_valor_compra'] . "','" . $or['dfecha_orden_compra'] . "','" . $or['cuenta_contable_id'] . "','" . $or['sobservaciones'] . "')\">Modificar</button>
                                                <button type=\"button\" class=\"btn btn-danger\" style=\"background-color: #dc3545; color: #fff; border: 1px Solid #dc3545; padding: 7px 22px;border-radius: 30px; width: auto;\" onclick=\"accion_eliminar_regis(" . $or['id'] . ")\">Eliminar </button>
                                            </td>
                                            </tr>
                                         "; */
                                    /* }
                                 }
                                 echo $cosa; */
                           ?> 
                            <!-- Puedes agregar más filas aquí -->
                        </tbody>
                    </table>
                    </div>
<br><br>
                </div>
                <br>
              
                
                    <hr>
                    <div class="sep"></div>
                    <div class="col-sm-4"></div>
                    
                    <div class="col-sm-4" style="text-align: center;">
                        <button  type="button" style="width: 120px; background-color: darkgray; color: #fff; border: 1px Solid darkgray; padding: 7px 22px; border-radius: 30px; font-size:16px" onmouseout='this.style.color="#fff"; this.style.backgroundColor="darkgray"; this.style.border="1px Solid darkgray"' onmouseover='this.style.color="darkgray"; this.style.backgroundColor="#fff";'><a href="vista.php">Regresar</a></button>
                        <button onclick="asignar_bp(id_c1.value,id_c1.value,id_c3.value,cbp2.value,id_cbp2.value,fa.value)" type="submit" style="background-color: #46A2FD; color: #fff; border: 1px Solid #46A2FD; padding: 7px 22px; border-radius: 30px; width: auto;" onmouseout='this.style.color="#fff"; this.style.backgroundColor="#46A2FD"; this.style.border="1px Solid #46A2FD"' onmouseover='this.style.color="#46A2FD"; this.style.backgroundColor="#fff";' data-bs-toggle="tooltip"  id="motivo_agr">Agregar</button>
                        <br><br></div>  
                    <div class="col-sm-4"></div>
                </div>    
                </div>
                </div>
            </div>
        </div>
        
</main>
<script>
                document.addEventListener("DOMContentLoaded", function() {
    var input = document.getElementById('ci1');

    input.addEventListener('keypress', function(e) {
        // Verifica si el evento es un número (del 0 al 9)
        var char = String.fromCharCode(e.which);
        if (!(/[0-9]/.test(char))) {
            e.preventDefault();
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var input = document.getElementById('ci2');

    input.addEventListener('keypress', function(e) {
        // Verifica si el evento es un número (del 0 al 9)
        var char = String.fromCharCode(e.which);
        if (!(/[0-9]/.test(char))) {
            e.preventDefault();
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var input = document.getElementById('ci3');

    input.addEventListener('keypress', function(e) {
        // Verifica si el evento es un número (del 0 al 9)
        var char = String.fromCharCode(e.which);
        if (!(/[0-9]/.test(char))) {
            e.preventDefault();
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var input = document.getElementById('cbp2');

    input.addEventListener('keypress', function(e) {
        // Verifica si el evento es un número (del 0 al 9)
        var char = String.fromCharCode(e.which);
        if (!(/[0-9]/.test(char))) {
            e.preventDefault();
        }
    });
});
            </script>
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
                <h3 class="sep-3" style="font-size: 16px; margin-left: 100px">Bienes Nacionales y Seguros Patrimoniales</h3>
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
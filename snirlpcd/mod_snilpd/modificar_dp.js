/*
    data: snacionalidad,
    data: ssexo,
    data: fecha_nac,
    data: cbpais_nac_afiliado1,
    data: cbEstado_nac_afiliado,
    data: cbEstado_Civil_afiliado,
    data: telefono_afiliado,
    data: otro_telefono_afiliado,
    data: redes_sociales,
    data: facebook,
    data: email_afiliado,
    data: twitter,
    data: telegram,
    data: instagram,
    data: tik_tok,
    data: otro,
    data: otro_user,
    data: cbPais_afiliado,
    data: cbEstado_afiliado,
    data: cbMunicipio_afiliado,
    data: cbParroquia_afiliado,
    data: sector_afiliado,
    data: direccion_afiliado,
    data: observacion_datos_per,
    data: cbJefe_familia,
    data: cbHijos,
    data: hijos_menores,
    data: hijos_mayores,
    data: cbVehiculo_afiliado,
    data: carnet_patria,
    data: codigo,
    data: serial,
    data: observacion_datos_per_2,
*/
/*
    $id = $_SESSION['cedula'];
    $consulta = ("SELECT * FROM public.personas WHERE cedula = '" . $id . "';");
    $row = pg_query($conn, $consulta);
    $persona = pg_fetch_assoc($row);
*/
$('#btnContinuar').on('click', function()
{
    agregar_datos_personas();
});
//function agregar_datos_personas(snacionalidad, ssexo, fecha_nac, cbpais_nac_afiliado1, cbEstado_nac_afiliado, cbEstado_Civil_afiliado, telefono_afiliado, otro_telefono_afiliado, redes_sociales, facebook, email_afiliado, twitter, telegram, instagram, tik_tok, otro, otro_user, cbPais_afiliado, cbEstado_afiliado, cbMunicipio_afiliado, cbParroquia_afiliado, sector_afiliado, direccion_afiliado, referencia, cbJefe_familia, cbHijos, hijos_menores, hijos_mayores, cbVehiculo_afiliado, carnet_patria, codigo, serial, observacion_datos_per) 
function agregar_datos_personas(snacionalidad) 
{
    //let url='validar_dpersonales.php?snacionalidad='+snacionalidad+'&ssexo='+ssexo+'&fecha_nac='+fecha_nac+'&cbpais_nac_afiliado1='+cbpais_nac_afiliado1+'&cbEstado_nac_afiliado='+cbEstado_nac_afiliado+'&cbEstado_Civil_afiliado='+cbEstado_Civil_afiliado+'&telefono_afiliado='+telefono_afiliado+'&otro_telefono_afiliado='+otro_telefono_afiliado+'&redes_sociales='+redes_sociales+'&facebook='+facebook+'&email_afiliado='+email_afiliado+'&twitter='+twitter+'&telegram='+telegram+'&instagram='+instagram+'&tik_tok='+tik_tok+'&otro='+otro+'&otro_user='+otro_user+'&cbPais_afiliado='+cbPais_afiliado+'&cbEstado_afiliado='+cbEstado_afiliado+'&cbMunicipio_afiliado='+cbMunicipio_afiliado+'&cbParroquia_afiliado='+cbParroquia_afiliado+'&sector_afiliado='+sector_afiliado+'&direccion_afiliado='+direccion_afiliado+'&referencia='+referencia+'&cbJefe_familia='+cbJefe_familia+'&cbHijos='+cbHijos+'&hijos_menores='+hijos_menores+'&hijos_mayores='+hijos_mayores+'&cbVehiculo_afiliado='+cbVehiculo_afiliado+'&carnet_patria='+carnet_patria+'&codigo='+codigo+'&serial='+serial+'&observacion_datos_per='+observacion_datos_per
    let url='validar_dpersonales.php';
    let valor = 0;
    //alert($('#snacionalidad').val());
    //alert($('#ssexo').val());
    //alert($('#fecha_nac').val());
    //let data=$('#frm_datos_personales').serialize();
    //console.log(data);
    
    let npais_nac_id = $('#cbpais_nac_afiliado1').val();
    let entidad_nac_id = $('#cbEstado_nac_afiliado').val();
    let estado_civil_id = $('#cbEstado_Civil_afiliado').val();
    let stelefono_personal = $('#telefono_afiliado').val();
    let stelefono_habitacion = $('#otro_telefono_afiliado').val();

    let npais_residencia_id = $('#pais_residencia').val();
    let nentidad_residencia_id = $('#estado_residencia').val();
    let residencia_extranjera_id = $('#cbEstado_nac_extranjero').val();
    let nmunicipio_residencia_id = $('#municipio_residencia').val();
    let nparroquia_residencia_id = $('#parroquia_residencia').val();
    let ssector_residencia = $('#sector_afiliado').val();
    let sdireccion_residencia = $('#direccion_afiliado').val();
    let spunto_ref_residencia = $('#observacion_datos_per').val();

    let bjefe_familia = $('#cbJefe_familia').val();
    let btiene_hijo = $('#cbHijos').val();
    let nhijo_menores18 = $('#hijos_menores').val();
    let nhijo_mayores18 = $('#hijos_mayores').val();

    let vehiculo_id = $('#cbVehiculo_afiliado').val();
    let bcarnet_patria = $('#carnet_patria').val();
    let scodigo_carnet_patria = $('#codigo').val();
    let sserial_carnet_patria = $('#serial').val();
    let sobservaciones = $('#observacion_datos_per_2').val();
    /*
        alert(data.nacionalidad);
        alert(data.sexo);
        alert(data.fecha_nacimiento);
    */
    if(npais_nac_id == '-1' || npais_nac_id == null){
        document.getElementById('cbpais_nac_afiliado1').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('cbpais_nac_afiliado1').style.border = "";
        if(npais_nac_id == '245'){
            if(entidad_nac_id == '-1' || entidad_nac_id == null){
                document.getElementById('cbEstado_nac_afiliado').style.border = "1px solid red";
                valor++;
            }else{
                document.getElementById('cbEstado_nac_afiliado').style.border = "";
            }
        }else{
            if(residencia_extranjera_id == ''){
                document.getElementById('cbEstado_nac_extranjero').style.border = "1px solid red";
                valor++;
            }else{
                document.getElementById('cbEstado_nac_extranjero').style.border = "";
            }
        }
    }
    if(stelefono_personal == ''){
        document.getElementById('telefono_afiliado').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('telefono_afiliado').style.border = "";
    }
    if(npais_residencia_id == '-1' || npais_residencia_id == null){
        document.getElementById('pais_residencia').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('pais_residencia').style.border = "";
    }
    if(nentidad_residencia_id == '-1' || nentidad_residencia_id == null){
        document.getElementById('estado_residencia').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('estado_residencia').style.border = "";
    }
    if(nmunicipio_residencia_id == '-1' || nmunicipio_residencia_id == null){
        document.getElementById('municipio_residencia').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('municipio_residencia').style.border = "";
    }
    if(nparroquia_residencia_id == '-1' || nparroquia_residencia_id == null){
        document.getElementById('parroquia_residencia').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('parroquia_residencia').style.border = "";
    }
    if(bjefe_familia == '-1' || bjefe_familia == null){
        document.getElementById('cbJefe_familia').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('cbJefe_familia').style.border = "";
    }
    if(btiene_hijo == '-1' || btiene_hijo == null){
        document.getElementById('cbHijos').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('cbHijos').style.border = "";
        if(btiene_hijo == '1'){
            if(nhijo_menores18 == '0' && nhijo_mayores18 == '0'){
                document.getElementById('hijos_menores').style.border = "1px solid red";
                document.getElementById('hijos_mayores').style.border = "1px solid red";
                valor++;
            }else{
                document.getElementById('hijos_menores').style.border = "";
                document.getElementById('hijos_mayores').style.border = "";
            }
        }
    }
    if(bcarnet_patria == '-1' || bcarnet_patria == null){
        document.getElementById('carnet_patria').style.border = "1px solid red";
        valor++;
    }else{
        document.getElementById('carnet_patria').style.border = "";
    }
    if(valor > 0){
        document.getElementById("texto").innerText = ("Debe completar los \"Campos Obligatorios (*)\"");
        document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
        //document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
        document.getElementById("titulo").style.color = "white";
        document.getElementById("titulo").innerText = ("Atención");
        document.getElementById("alerta").style.display = "Block";
    }else{    
        $.ajax
        ({
            url: 'validar_dpersonales.php?npais_nac_id='+npais_nac_id+'&entidad_nac_id='+entidad_nac_id+'&estado_civil_id='+estado_civil_id+'&stelefono_personal='+stelefono_personal+'&stelefono_habitacion='+stelefono_habitacion+'&npais_residencia_id='+npais_residencia_id+'&nentidad_residencia_id='+nentidad_residencia_id+'&nmunicipio_residencia_id='+nmunicipio_residencia_id+'&nparroquia_residencia_id='+nparroquia_residencia_id+'&ssector_residencia='+ssector_residencia+'&sdireccion_residencia='+sdireccion_residencia+'&spunto_ref_residencia='+spunto_ref_residencia+'&bjefe_familia='+bjefe_familia+'&btiene_hijo='+btiene_hijo+'&nhijo_menores18='+nhijo_menores18+'&nhijo_mayores18='+nhijo_mayores18+'&vehiculo_id='+vehiculo_id+'&bcarnet_patria='+bcarnet_patria+'&scodigo_carnet_patria='+scodigo_carnet_patria+'&sserial_carnet_patria='+sserial_carnet_patria+'&sobservaciones='+sobservaciones+'&residencia_extranjera_id='+residencia_extranjera_id,
            type: 'GET',
            success: function(resp) {
                //let resultado = JSON.parse(resp);
                //console.log(resp);
                //alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                if(v0 == 1){
                    document.getElementById("texto").innerText = v1;
                    document.getElementById("titulo").style.backgroundColor = "#DC3831"; //Rojo
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    $(v2).focus(); // Para quitar focus = .blur()
                    $(v2).css({'border':'2px solid #F50101dd'});
                    if(v2 == '#cbEstado_nac_afiliado'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#telefono_afiliado'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#otro_telefono_afiliado'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#pais_residencia'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#estado_residencia'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#municipio_residencia'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                        $('#estado_residencia').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#parroquia_residencia'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                        $('#estado_residencia').css({'border':'2px solid #312E33'});
                        $('#municipio_residencia').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#cbJefe_familia'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                        $('#estado_residencia').css({'border':'2px solid #312E33'});
                        $('#municipio_residencia').css({'border':'2px solid #312E33'});
                        $('#parroquia_residencia').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#cbHijos'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                        $('#estado_residencia').css({'border':'2px solid #312E33'});
                        $('#municipio_residencia').css({'border':'2px solid #312E33'});
                        $('#parroquia_residencia').css({'border':'2px solid #312E33'});
                        $('#cbJefe_familia').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#hijos_menores'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                        $('#estado_residencia').css({'border':'2px solid #312E33'});
                        $('#municipio_residencia').css({'border':'2px solid #312E33'});
                        $('#parroquia_residencia').css({'border':'2px solid #312E33'});
                        $('#cbJefe_familia').css({'border':'2px solid #312E33'});
                        $('#cbHijos').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#hijos_mayores'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                        $('#estado_residencia').css({'border':'2px solid #312E33'});
                        $('#municipio_residencia').css({'border':'2px solid #312E33'});
                        $('#parroquia_residencia').css({'border':'2px solid #312E33'});
                        $('#cbJefe_familia').css({'border':'2px solid #312E33'});
                        $('#cbHijos').css({'border':'2px solid #312E33'});
                        $('#hijos_menores').css({'border':'2px solid #312E33'});
                    }else
                    if(v2 == '#carnet_patria'){
                        $('#cbpais_nac_afiliado1').css({'border':'2px solid #312E33'});
                        $('#cbEstado_nac_afiliado').css({'border':'2px solid #312E33'});
                        $('#telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#otro_telefono_afiliado').css({'border':'2px solid #312E33'});
                        $('#pais_residencia').css({'border':'2px solid #312E33'});
                        $('#estado_residencia').css({'border':'2px solid #312E33'});
                        $('#municipio_residencia').css({'border':'2px solid #312E33'});
                        $('#parroquia_residencia').css({'border':'2px solid #312E33'});
                        $('#cbJefe_familia').css({'border':'2px solid #312E33'});
                        $('#cbHijos').css({'border':'2px solid #312E33'});
                        $('#hijos_menores').css({'border':'2px solid #312E33'});
                        $('#hijos_mayores').css({'border':'2px solid #312E33'});
                    }
                }else{
                    document.getElementById("texto").innerText = v0;
                    document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
                    document.getElementById("titulo").style.color = "white";
                    document.getElementById("titulo").innerText = ("Atención");
                    document.getElementById("alerta").style.display = "Block";
                    document.getElementById("link").value = "discapacidad.php";
                    //$(location).attr('href','discapacidad.php');
                }
                
                /* $(v1).focusin(function(){
                    var wrapper = $(this).parent().find(v1);
                    $(v1).css({'border':'none'});
                    wrapper.css({'border':'1px solid red'});
                }); */
            }
            /* success: function(resp) {
                let resultado = JSON.parse(resp);
                //alert("ARRAYRESULTADO="+resultado.primer_nombre);
                //1  Funciona
                // console.log(resp);
                //var resultado=resp.split("|");
                //console.log(resultado[0]+"="+resultado[1]);
                $( "#nombre" ).val(resultado.nombres.toUpperCase());
                $('#apellido').val(resultado.apellidos.toUpperCase());
                $('#sexo').val(resultado_sexo); 
                //setTimeout( function() { window.location.href = "/Imp_Teletrabajo/"; }, 5000 );
            }*/
        });
    }
}
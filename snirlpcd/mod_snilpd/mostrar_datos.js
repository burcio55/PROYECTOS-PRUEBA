/*
    $(document).ready(function(){
        //alert('Hola Mundo');
        $.ajax({
            url: 'mostrar_datos.php',
            type: 'GET',
            success: function(resp) {
                alert(resp);
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                let v3 = resp.split(" / ")[3];
                let v4 = resp.split(" / ")[4];
                let v5 = resp.split(" / ")[5];
                let v6 = resp.split(" / ")[6];
                let v7 = resp.split(" / ")[7];
                let v8 = resp.split(" / ")[8];
                let v9 = resp.split(" / ")[9];
                let v10 = resp.split(" / ")[10];
                let v11 = resp.split(" / ")[11];
                let v12 = resp.split(" / ")[12];
                let v13 = resp.split(" / ")[13];
                let v14 = resp.split(" / ")[14];
                let v15 = resp.split(" / ")[15];
                let v16 = resp.split(" / ")[16];
                let v17 = resp.split(" / ")[17];
                let v18 = resp.split(" / ")[18];
                let v19 = resp.split(" / ")[19];
                let v20 = resp.split(" / ")[20];
                let v21 = resp.split(" / ")[21];
                let v22 = resp.split(" / ")[22];
                let v23 = resp.split(" / ")[23];
                let v24 = resp.split(" / ")[24];
                let v25 = resp.split(" / ")[25];
                let v26 = resp.split(" / ")[26];
                let v27 = resp.split(" / ")[27];
                let v28 = resp.split(" / ")[28];
                let v29 = resp.split(" / ")[29];
                let v30 = resp.split(" / ")[30];
                let v31 = resp.split(" / ")[31];
                let v32 = resp.split(" / ")[32];
                if(v7 == ''){
                    v7 = '-1';
                }
                if(v8 == ''){
                    v8 = '-1';
                }
                if(v9 == ''){
                    v9 = '-1';
                }
                if(v12 == ''){
                    v12 = '-1';
                }
                if(v13 == ''){
                    v13 = '-1';
                }
                if(v14 == ''){
                    v14 = '-1';
                }
                if(v15 == ''){
                    v15 = '-1';
                }
                if(v19 == ''){
                    v19 = '-1';
                }
                if(v20 == ''){
                    v20 = '-1';
                }
                if(v23 == ''){
                    v23 = '-1';
                }
                if(v24 == ''){
                    v24 = '-1';
                }
                $('#cbpais_nac_afiliado1').html(v0);
                $('#cbEstado_nac_afiliado').html(v1);
                $('#estado_residencia').html(v1);
                $('#municipio_residencia').html(v2);
                $('#parroquia_residencia').html(v3);
                $('#cbVehiculo_afiliado').html(v30);
                $('#cbEstado_Civil_afiliado').html(v31);
                $('#redes_sociales').html(v32);
                $('#inputEmail3').val(v4);
                $('#ssexo').val(v5);
                $('#fecha_nac').val(v6);
                $('#cbpais_nac_afiliado1').val(v7);
                $('#cbEstado_nac_afiliado').val(v8);
                $('#cbEstado_Civil_afiliado').val(v9);
                $('#telefono_afiliado').val(v10);
                $('#otro_telefono_afiliado').val(v11);
                $('#Correo').val(v29);
                $('#pais_residencia').val(v12);
                $('#estado_residencia').val(v13);
                $('#municipio_residencia').val(v14);
                $('#parroquia_residencia').val(v15);
                $('#sector_afiliado').val(v16);
                $('#direccion_afiliado').val(v17);
                $('#observacion_datos_per').val(v18);
                $('#cbJefe_familia').val(v19);
                $('#cbHijos').val(v20);
                $('#hijos_menores').val(v21);
                $('#hijos_mayores').val(v22);
                $('#cbVehiculo_afiliado').val(v23);
                $('#carnet_patria').val(v24);
                $('#codigo').val(v25);
                $('#serial').val(v26);
                $('#observacion_datos_per_2').val(v27);
                $('#edad').val(v28);
                if(v12 != '-1'){
                    cambios_pais(v12);
                }
                if(v13 != '13'){
                    cambio_estado(v13);
                }
                if(v14 != '13'){
                    cambio_municipio(v14);
                }
            }
        });
    })
*/
function cambio_pais(pais){
    if(pais != '245'){
        document.getElementById("cbEstado_nac_afiliado").style.display = "none";
        document.getElementById("cbEstado_nac_extranjero").style.display = "";
    }else{
        //alert(pais);
        document.getElementById("cbEstado_nac_afiliado").style.display = "";
        document.getElementById("cbEstado_nac_extranjero").style.display = "none";
        $.ajax({
            url: 'validar_select.php?pais='+pais+'&accion=1',
            type: 'GET',
            success: function(resp){
                $('#cbEstado_nac_afiliado').html(resp);
            }
        });
    }
}
function cambios_pais(pais){
    //alert(pais);
    $.ajax({
        url: 'validar_select.php?pais='+pais+'&accion=1',
        type: 'GET',
        success: function(resp){
            $('#estado_residencia').html(resp);
        }
    });
}
function cambio_estado(estado){
    //alert(pais);
    $.ajax({
        url: 'validar_select.php?estado='+estado+'&accion=2',
        type: 'GET',
        success: function(resp){
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            $('#municipio_residencia').html(v0);
            $('#parroquia_residencia').html(v1);
        }
    });
}
function cambio_municipio(municipio){
    //alert(pais);
    $.ajax({
        url: 'validar_select.php?municipio='+municipio+'&accion=3',
        type: 'GET',
        success: function(resp){
            $('#parroquia_residencia').html(resp);
        }
    });
}
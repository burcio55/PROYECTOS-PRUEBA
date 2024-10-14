$(document).ready(function()
{
    $.ajax({
        url: 'mostrar_datos.php',
        type: 'GET',
        success: function(resp) {
            let v = 0;
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
            let v33 = resp.split(" / ")[33];
            if(v5 == ''){
                v5 = '-1';
            }
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
                v++;
            }
            if(v13 == ''){
                v13 = '-1';
                v++
            }
            if(v14 == ''){
                v14 = '-1';
                v++;
            }
            if(v15 == ''){
                v15 = '-1';
                v++
            }
            if(v > 0){
                v19 = '-1';
                v20 = '-1';
                v24 = '-1';
            }else{
                if(v19 == 't'){
                    v19 = '1';
                }else{
                    v19 = '0';
                }
                if(v20 == 't'){
                    v20 = '1';
                }else{
                    v20 = '0';
                }
                if(v24 == 't'){
                    v24 = '1';
                }else{
                    v24 = '0';
                }
            }
            
            if(v23 == ''){
                v23 = '-1';
            }
            $('#cbpais_nac_afiliado1').html(v0);
            if(v7 != '245'){
                document.getElementById("cbEstado_nac_afiliado").style.display = "none";
                document.getElementById("cbEstado_nac_extranjero").style.display = "";
            }else{
                document.getElementById("cbEstado_nac_afiliado").style.display = "";
                document.getElementById("cbEstado_nac_extranjero").style.display = "none";
            }
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
            $('#cbEstado_nac_extranjero').val(v33);
            $('#cbEstado_Civil_afiliado').val(v9);
            $('#telefono_afiliado').val(v10);
            $('#otro_telefono_afiliado').val(v11);
            $('#Correo').val(v29);
            $('#pais_residencia').val(v12);
            if(v13 == ""){
                cambios_pais('245');
            }else{
                $('#estado_residencia').val(v13);
            }
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
            hijos();
            carnet();
            /*
                if(v12 != '-1'){
                    cambios_pais(v12);
                }
                if(v13 != '13'){
                    cambio_estado(v13);
                }
                if(v14 != '13'){
                    cambio_municipio(v14);
                }
            */
        }
    });
    /*
        $.post("modelo.php", {
            elegido: elegido,
            combo: combo,
            seleccionado: "<?php echo $_POST['cbEstado_nac_afiliado1']; ?>"
        },
        function(data) {
            //alert(data);
            $("#cbEstado_nac_afiliado").html(data);
        });
    */
    let data=
    {
        'combo':'Estado_nac_al_cargar',
    }
    $.ajax(
    {
        url:'modelo.php',
        type:'GET',
        data:data,
        success:function(respuesta)
        {
            //alert(respuesta);
            $("#cbEstado_nac_afiliado_2").html(respuesta);            
        }
    });
})
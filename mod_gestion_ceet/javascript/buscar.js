function accion_buscar(n_nacionalidad,personales_cedula){
    /* let cedula_2 = personales_cedula; */
    let valor = 0;
    if(document.getElementById("n_nacionalidad").value == -1){
        document.getElementById("n_nacionalidad").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("n_nacionalidad").style.borderColor = '';
    }
    if(document.getElementById("personales_cedula").value == ''){
        document.getElementById("personales_cedula").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("personales_cedula").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax({
            url: '/minpptrassi/mod_gestion_ceet/buscador.php',
            type: 'POST',
            data: {
                n_nacionalidad: n_nacionalidad,
                personales_cedula: personales_cedula
            },
            success: function(resp) {
                /* var resultado = JSON.parse(resp); */
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                let v3 =  resp.split(" / ")[3];
                let v4 =  resp.split(" / ")[4];
                let v5 =  resp.split(" / ")[5];
                let v6 =  resp.split(" / ")[6];
                let v7 =  resp.split(" / ")[7];
                let v8 =  resp.split(" / ")[8];
                let v9 =  resp.split(" / ")[9];
               /*  let v10 =  resp.split(" / ")[10];
                let v11 =  resp.split(" / ")[11];
                let v12 =  resp.split(" / ")[12];
                let v13 =  resp.split(" / ")[13];
                let v14 =  resp.split(" / ")[14];
                let v15 =  resp.split(" / ")[15];
                let v16 =  resp.split(" / ")[16]; */
               /*  if(v7 == "7"){ */
                /* }else{ */
                /* let v8 =  resp.split(" / ")[8];
                let v9 =  resp.split(" / ")[9];
                let v10 =  resp.split(" / ")[10];
                let v11 =  resp.split(" / ")[11]; */
                /* } */
                if (v0 == '0'){
                    alert(v1);
                }else{
                    $( "#p_nombre" ).val(v1.toUpperCase());
                    $( "#s_nombre" ).val(v2.toUpperCase());
                    $('#p_apellido').val(v3.toUpperCase());
                    $('#s_apellido').val(v4.toUpperCase());
                    
                    document.getElementById("p_nombre").style.borderColor = '';
                    document.getElementById("s_nombre").style.borderColor = '';
                    document.getElementById("p_apellido").style.borderColor = '';
                    document.getElementById("s_apellido").style.borderColor = '';
                    document.getElementById("sexo").style.borderColor = '';
                    document.getElementById("todo").style.display='block';
                    document.getElementById("todo2").style.display='none';
                    document.getElementById("btn_regre").style.display='none';

                    document.querySelector("select[id='sexo']").value = v5;
                    
                    /*
                        $('#stelefono_personal').html(v6);
                        $('#entidad_nentidad').html(v7);
                        $('#municipio_nmunicipio').html(v8);
                        $('#parroquia_nparroquia').html(v9);
                        $('#motor_id').html(v10);
                        $('#actividad_economica').html(v11);
                        $('#fe').html(v12);
                        $('#fe2').html(v13);
                        $('#fe3').html(v14);
                        $('#fe4').html(v15);
                    */

                    $('#fe').html(v6);
                    $('#fe2').html(v7);
                    $('#fe3').html(v8);
                    $('#fe4').html(v9);

                    /* if(v7 == "7"){ */
                    /* }else{ */
                        /* $('#fe').html(v8);
                        $('#fe2').html(v9);
                        $('#fe3').html(v10);
                        $('#fe4').html(v11); */
                    /* } */
             
                }
            }
        });
    }
}
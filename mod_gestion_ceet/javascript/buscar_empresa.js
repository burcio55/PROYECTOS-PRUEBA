function accion_buscar_empresa(srif){
    /* let cedula_2 = personales_cedula; */
    /* alert(srif); */
    let valor = 0;
    if(document.getElementById("srif").value == ''){
        document.getElementById("srif").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("srif").style.borderColor = '';
    }

    if(valor > 0){
      
        alert('Debe llenar los Campos Obligatorios *');
        
    }else{
        let error = 0;
        const letra = $("#srif").val().charAt(0);
        const num1 = $("#srif").val().charAt(1);
        const num2 = $("#srif").val().charAt(2);
        const num3 = $("#srif").val().charAt(3);
        const num4 = $("#srif").val().charAt(4);
        const num5 = $("#srif").val().charAt(5);
        const num6 = $("#srif").val().charAt(6);
        const num7 = $("#srif").val().charAt(7);
        const num8 = $("#srif").val().charAt(8);
        const num9 = $("#srif").val().charAt(9);

        if (letra != "C" && letra != "D" && letra != "E" && letra != "G" && letra != "J" && letra != "P" && letra != "V"){
            error++;
        }

       
            // Obtenemos el elemento input donde se ingresará el texto
            const inputTexto = document.getElementById('srif');

            // Obtenemos el elemento donde se mostrará el conteo de caracteres
            const contador = document.getElementById('contador');

            // Contamos los caracteres y actualizamos el contador
            contador.textContent = inputTexto.value.length;
            if (inputTexto.value.length < 8) {
                alert('Tiene que tener un minimo de 7 digitos');
                error++;
            }
        

        if (num1 < 1 || num1 > 9){
            error++;
        }
        if (num2 < 0 || num2 > 9){
            error++;
        }
        if (num3 < 0 || num3 > 9){
            error++;
        }
        if (num4 < 0 || num4 > 9){
            error++;
        }
        if (num5 < 0 || num5 > 9){
            error++;
        }
        if (num6 < 0 || num6 > 9){
            error++;
        }
        if (num7 < 0 || num7 > 9){
            error++;
        }
        if (num8 < 0 || num8 > 9){
            error++;
        }if (num9 < 0 || num8 > 9){
            error++;
        }
   
        if (error > 0){
            document.getElementById("srif").style.borderColor = 'Red';
            alert ("El formato del Rif es incorrecto, asegurece de seguir el ejemplo: J123456789");
        }else{
            document.getElementById("srif").style.borderColor = '';
            $.ajax({
                url: 'buscador_empresa.php?srif='+srif,
                type: 'GET',
                success: function(resp) {
    
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
                    let v10 =  resp.split(" / ")[10];
                    let v11 =  resp.split(" / ")[11];
                    let v12 =  resp.split(" / ")[12];
                    let v13 =  resp.split(" / ")[13];
                    let v14 =  resp.split(" / ")[14];
                    
                    if (v0 == '0'){
                        alert(v1);   document.getElementById("guard_btn3").style.display = "block";
                    document.getElementById("guard_btn2").style.display = "none";
                    document.getElementById("motor25").style.display = "none";document.getElementById("asa").style.display = "none"; 
                      
                     document.getElementById("actividad_economica2").value = ' ';
                    document.getElementById("sdireccion_fiscal").value = ' ';
                  
                    document.getElementById("srazon_social").value = '';
                    document.getElementById("sdenominacion_comercial").value = ' ';
                    document.getElementById("stipo_capital").value = -1;
                    document.getElementById("entidad_nentidad2").value = -1;
                    document.getElementById("municipio_nmunicipio2").value = -1;
                    document.getElementById("parroquia_nparroquia2").value = -1;
                    document.getElementById("motor_id").value = -1;
                    document.getElementById("NIL").style.display = "none";
                        document.getElementById("srazon_social").disabled = false;
                        document.getElementById("sdenominacion_comercial").disabled = false;
                        document.getElementById("stipo_capital").disabled = false;
                        document.getElementById("actividad_economica2").disabled = false;
                        document.getElementById("sdireccion_fiscal").disabled = false;
                        
                        document.getElementById("todo2").style.display='none';
                     
                        document.getElementById("motor25").style.display = "none";
                      

                    }else{
                       

                    
                        $('#srazon_social').val(v1.toUpperCase());
                        $('#sdenominacion_comercial').val(v2.toUpperCase());
                        $('#stipo_capital').val(v3.toUpperCase()); 
                        $('#entidad_nentidad2').val(v4.toUpperCase()); 
                        $('#municipio_nmunicipio2').val(v5.toUpperCase()); 
                        $('#parroquia_nparroquia2').val(v6.toUpperCase()); 
                        $('#snil').val(v7.toUpperCase()); 
                        
                        
                        $('#actividad_economica2').val(v8.toUpperCase());
                        $('#sdireccion_fiscal').val(v9.toUpperCase());

                        document.getElementById("srazon_social").style.borderColor = '';
                        document.getElementById("sdenominacion_comercial").style.borderColor = '';
                        document.getElementById("stipo_capital").style.borderColor = '';
                        document.getElementById("entidad_nentidad2").style.borderColor = '';
                        document.getElementById("municipio_nmunicipio2").style.borderColor = '';
                        document.getElementById("parroquia_nparroquia2").style.borderColor = '';
                        document.getElementById("snil").style.borderColor = '';
                        document.getElementById("actividad_economica2").style.borderColor = '';
                        document.getElementById("sdireccion_fiscal").style.borderColor = '';
                        
                        document.getElementById("todo").style.display='none';
                        document.getElementById("todo2").style.display='block';
                        document.getElementById("guard_btn2").style.display = "block";
                        document.getElementById("motor25").style.display = "block";
                        document.getElementById("guard_btn3").style.display = "none";
                        document.getElementById("asa").style.display = ""; 
                        document.getElementById("srazon_social").disabled = true;
                        document.getElementById("sdenominacion_comercial").disabled = true;
                        document.getElementById("stipo_capital").disabled = true;
                        document.getElementById("actividad_economica2").disabled = true;
                        document.getElementById("sdireccion_fiscal").disabled = true;

                        $('#fe01').html(v10);
                        $('#fe02').html(v11);
                        $('#fe03').html(v12);
                        $('#fe04').html(v13);
                    }
                }
            
            });
        }
    }
}
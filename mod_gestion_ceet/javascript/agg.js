function agg(srif,srazon_social,sdenominacion_comercial,stipo_capital,entidad_nentidad2,municipio_nmunicipio2,parroquia_nparroquia2,snil,actividad_economica2,sdireccion_fiscal) {
/*     alert(srif+" "+srazon_social+" "+sdenominacion_comercial+" "+stipo_capital+" "+entidad_nentidad2+" "+municipio_nmunicipio2+" "+parroquia_nparroquia2+" "+snil+" "+motor_id+" "+actividad_economica2+" "+sdireccion_fiscal);
 */         
   
    let valor = 0;
    if(document.getElementById("srif").value == ''){
        document.getElementById("srif").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("srif").style.borderColor = '';
    }
    if(document.getElementById("srazon_social").value == ''){
        document.getElementById("srazon_social").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("srazon_social").style.borderColor = '';
    }
    if(document.getElementById("sdenominacion_comercial").value == ''){
        document.getElementById("sdenominacion_comercial").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("sdenominacion_comercial").style.borderColor = '';
    }
    if(document.getElementById("stipo_capital").value < '1'){
        document.getElementById("stipo_capital").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("stipo_capital").style.borderColor = '';
    }
    if(document.getElementById("entidad_nentidad2").value < '1'){
        document.getElementById("entidad_nentidad2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("entidad_nentidad2").style.borderColor = '';
    }
    if(document.getElementById("municipio_nmunicipio2").value < '1'){
        document.getElementById("municipio_nmunicipio2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("municipio_nmunicipio2").style.borderColor = '';
    }
    if(document.querySelector("#parroquia_nparroquia2").value < '1'){
        document.getElementById("parroquia_nparroquia2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("parroquia_nparroquia2").style.borderColor = '';
    }
   
   /*  if(document.getElementById("motor_id").value == -1){
        document.getElementById("motor_id").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("motor_id").style.borderColor = '';
    } */
        motor_id=1;

    if(document.getElementById("actividad_economica2").value == ''){
        document.getElementById("actividad_economica2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("actividad_economica2").style.borderColor = '';
    }
    if(document.getElementById("sdireccion_fiscal").value == ''){
        document.getElementById("sdireccion_fiscal").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("sdireccion_fiscal").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'agg.php?srif='+srif+'&srazon_social='+srazon_social+'&sdenominacion_comercial='+sdenominacion_comercial+'&stipo_capital='+stipo_capital+'&entidad_nentidad2='+entidad_nentidad2+'&parroquia_nparroquia2='+parroquia_nparroquia2+'&municipio_nmunicipio2='+municipio_nmunicipio2+'&motor_id='+motor_id+'&actividad_economica2='+actividad_economica2+'&sdireccion_fiscal='+sdireccion_fiscal,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    alert(v1);
                   
                    document.getElementById("guard_btn2").style.display = "block";
                    document.getElementById("guard_btn3").style.display = "none";
                   
                    document.getElementById("motor25").style.display = "";

                   /*  document.getElementById("actividad_economica2").value = ' ';
                    document.getElementById("sdireccion_fiscal").value = ' ';
                    /* document.getElementById("srif").value = '';*/
                   /*  document.getElementById("srazon_social").value = '';
                    document.getElementById("sdenominacion_comercial").value = ' ';
                    document.getElementById("stipo_capital").value = -1;
                    document.getElementById("entidad_nentidad2").value = -1;
                    document.getElementById("municipio_nmunicipio2").value = -1;
                    document.getElementById("parroquia_nparroquia2").value = -1;  */
                    
                    document.getElementById("srazon_social").disabled = true;
                    document.getElementById("sdenominacion_comercial").disabled = true;
                    document.getElementById("stipo_capital").disabled = true;
                    document.getElementById("actividad_economica2").disabled = true;
                    document.getElementById("sdireccion_fiscal").disabled = true;
                    

                }else{
                  
                    alert(v1);
                  
                                                
                }
            }
        });
    }

}
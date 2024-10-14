function accion_guardar(n_nacionalidad,personales_cedula,p_nombre,s_nombre,p_apellido,s_apellido,stelefono_personal,sexo,entidad_nentidad,municipio_nmunicipio,parroquia_nparroquia,motor_id,actividad_economica)
{
    /* alert (n_nacionalidad + " " + personales_cedula + " " + p_nombre + " " + s_nombre + " " + p_apellido + " " + s_apellido + " " + stelefono_personal + " " + entidad_nentidad + " " + municipio_nmunicipio + " " + parroquia_nparroquia + " " + motor_id + " " + actividad_economica); */
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
    if(document.getElementById("p_nombre").value == ''){
        document.getElementById("p_nombre").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("p_nombre").style.borderColor = '';
    }
    /* if(document.getElementById("s_nombre").value == ''){
        document.getElementById("s_nombre").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("s_nombre").style.borderColor = '';
    } */
    if(document.getElementById("p_apellido").value == ''){
        document.getElementById("p_apellido").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("p_apellido").style.borderColor = '';
    }
    /* if(document.getElementById("s_apellido").value == ''){
        document.getElementById("s_apellido").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("s_apellido").style.borderColor = '';
    } */
    if(document.getElementById("stelefono_personal").value == ''){
        document.getElementById("stelefono_personal").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("stelefono_personal").style.borderColor = '';
    }
    if(document.querySelector("#sexo").value == -1){
        document.getElementById("sexo").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("sexo").style.borderColor = '';
    }
    if(document.getElementById("entidad_nentidad").value == -1){
        document.getElementById("entidad_nentidad").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("entidad_nentidad").style.borderColor = '';
    }
    if(document.getElementById("municipio_nmunicipio").value == -1 || document.getElementById("municipio_nmunicipio").value == ''){
        document.getElementById("municipio_nmunicipio").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("municipio_nmunicipio").style.borderColor = '';
    }
    if(document.getElementById("parroquia_nparroquia").value == -1 || document.getElementById("municipio_nmunicipio").value == ''){
        document.getElementById("parroquia_nparroquia").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("parroquia_nparroquia").style.borderColor = '';
    }
    if(document.getElementById("motor_id").value == -1){
        document.getElementById("motor_id").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("motor_id").style.borderColor = '';
    }
    if(document.getElementById("actividad_economica").value == ''){
        document.getElementById("actividad_economica").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("actividad_economica").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_guardar.php?n_nacionalidad='+n_nacionalidad+'&personales_cedula='+personales_cedula+'&p_nombre='+p_nombre+'&s_nombre='+s_nombre+'&p_apellido='+p_apellido+'&s_apellido='+s_apellido+'&stelefono_personal='+stelefono_personal+'&sexo='+sexo+'&entidad_nentidad='+entidad_nentidad+'&municipio_nmunicipio='+municipio_nmunicipio+'&parroquia_nparroquia='+parroquia_nparroquia+'&motor_id='+motor_id+'&actividad_economica='+actividad_economica,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    alert(v1);
                }else{
                    alert(v1);
                }
            }
        });
    }
}
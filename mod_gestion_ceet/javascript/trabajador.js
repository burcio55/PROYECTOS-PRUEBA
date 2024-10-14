/* function accion_trabajador_mod(trabajador_id, ced, nombre) {


    $("#trabajador_id").val(trabajador_id);
    $("#ced").val(ced);
    $("#name").val(nombre);
}
function accion_trabajador_act(ced, modulos, entidad_id, rol_id){

    $.ajax
    ({
        url: 'accion_rol_id.php?ced='+ced+'&modulos='+modulos+'&entidad_id='+entidad_id+'&rol_id='+rol_id,
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
} */
function accion_rol(ced,entidad_id,rol_id)
{
/*     alert(ced + ' ' + entidad_id + ' ' + rol_id);
 */    let valor = 0;
    if(document.getElementById("ced").value == ''){
        document.getElementById("ced").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ced").style.borderColor = '';
    }
    if(document.getElementById("entidad_id").value == '-1'){
        document.getElementById("entidad_id").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("entidad_id").style.borderColor = '';
    }
    if(document.getElementById("rol_id").value == '-1'){
        document.getElementById("rol_id").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("rol_id").style.borderColor = '';
    }
    if(document.getElementById("nombre").value == ''){
        document.getElementById("nombre").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("nombre").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_rol.php?ced='+ced+'&entidad_id='+entidad_id+'&rol_id='+rol_id,
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
function accion_rol2(ced,rol_id)
{
    /* alert(ced + ' ' + rol_id); */
    let valor = 0;
    if(document.getElementById("ced").value == ''){
        document.getElementById("ced").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ced").style.borderColor = '';
    }
    if(document.getElementById("rol_id").value == '-1'){
        document.getElementById("rol_id").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("rol_id").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_rol2.php?ced='+ced+'&rol_id='+rol_id,
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
function accion_rol3(ced)
{
    /* alert(ced); */
    let valor = 0;
    if(document.getElementById("ced").value == ''){
        document.getElementById("ced").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("ced").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_rol3.php?ced='+ced,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    alert(v1);
                    document.getElementById("ced").value = ' ';
                    document.getElementById("nombre").value = ' ';
                    document.getElementById("rol_id").value = -1;
                    document.getElementById("entidad_id").value = -1;

                }else{
                    alert(v1);
                }
            }
        });
    }
}


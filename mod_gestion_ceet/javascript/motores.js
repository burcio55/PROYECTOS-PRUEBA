function accion_motor(motor)
{
    let valor = 0;
    if(document.getElementById("motor").value == ''){
        document.getElementById("motor").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("motor").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        $.ajax
        ({
            url: 'accion_motores.php?motor='+motor+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe4').html(v2);
                    document.getElementById("motor").value==" ";
                    location.reload();
                }else{
                    alert(v1);
                }
            }
        });
    }
}
function accion_motor_eliminar(motor)
{
    $.ajax
    ({
        url: 'accion_motores.php?motor='+motor+'&accion=2',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe4').html(v2);
            }else{
                alert(v1);
            }
        }
    });
}
function accion_motor_modificar(id, sdescripcion) {

    /* alert(id); */

    $("#motor_id").val(id);
    $("#motor").val(sdescripcion);

    $('#motor_agr').css('display','none');
    $('#motor_act').css('display','block');
}
function accion_motor_act(id_motor, motor){

    /* alert(id_motor + ' ' + motor); */

    $('#motor_agr').css('display','block');
    $('#motor_act').css('display','none');

    $.ajax
    ({
        url: 'accion_motores.php?id_motor='+id_motor+'&motor='+motor+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if(v0 == 1){
                alert(v1);
                $('#fe4').html(v2);
                document.getElementById("motor").value==" ";
                location.reload();
            }else{
                alert(v1);
            }
        }
    });
}

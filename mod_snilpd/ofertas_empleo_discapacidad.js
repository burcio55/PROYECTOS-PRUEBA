function modificar(id){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&accion=1',
        type: 'GET',
        success: function(resp) {
            $(location).attr('href','oferta_empleo.php'); 
        }
    });
}
function agregar(){
    $.ajax({
        url: 'alterar_oferta_empleo.php?accion=9',
        type: 'GET',
        success: function(resp) {
            $(location).attr('href','oferta_empleo.php'); 
        }
    });
}
function eliminarRegistro(id){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&accion=2',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            location.reload();
        }
    });
}
function postulaciones(id){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&accion=3',
        type: 'GET',
        success: function(resp) {
            $(location).attr('href','ofertas_postulaciones.php'); 
        }
    });
}
function revisar(id_persona,id_postulacion){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id_persona='+id_persona+'&id_postulacion='+id_postulacion+'&accion=4',
        type: 'GET',
        success: function(resp) {
            $(location).attr('href','ofertas_postulaciones2.php'); 
        }
    });
}
function rechazar_postulacion(){
    $.ajax({
        url: 'alterar_oferta_empleo.php?accion=5',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            $(location).attr('href','ofertas_postulaciones.php'); 
        }
    });
}
function aceptar_postulacion(){
    $.ajax({
        url: 'alterar_oferta_empleo.php?accion=6',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
            }else
            if(v0 == 2){
                $(location).attr('href','programar_entrevista.php'); 
            }else
            if(v0 == 3){
                alert(v1);
                $(location).attr('href','programar_entrevista.php');
            }
        }
    });
}
function programar(fecha,hora,hora2,ampm,texto){
    let contador = 0;
    if($('#Fecha').val()==''){
        contador++;
        $('#Fecha').css('border-color', 'red');
    }else{
        $('#Fecha').css('border-color', '');
    }
    if($('#Hora').val()=='-1'){
        contador++;
        $('#Hora').css('border-color', 'red');
    }else{
        $('#Hora').css('border-color', '');
    }
    if($('#Hora2').val()=='-1'){
        contador++;
        $('#Hora2').css('border-color', 'red');
    }else{
        $('#Hora2').css('border-color', '');
    }
    if($('#AmPm').val()=='-1'){
        contador++;
        $('#AmPm').css('border-color', 'red');
    }else{
        $('#AmPm').css('border-color', '');
    }
    if($('#texto').val()==''){
        contador++;
        $('#texto').css('border-color', 'red');
    }else{
        $('#texto').css('border-color', '');
    }
    if(contador == 0){
        $.ajax({
            url: 'alterar_oferta_empleo.php?fecha='+fecha+'&hora='+hora+'&hora2='+hora2+'&ampm='+ampm+'&texto='+texto+'&accion=7',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    alert(v1);
                }else{
                    $(location).attr('href','ofertas_empleo.php'); 
                }
            }
        });
    }else{
        alert('Debe Completar los campos obligatorios (*)');
    }
}
function rechazar_postulacion2(id){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&accion=8',
        type: 'GET',
        success: function(resp) {
            location.reload(); 
        }
    });
}
function rechazar_postulacion3(id){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&accion=8',
        type: 'GET',
        success: function(resp) {
            $(location).attr('href','ofertas_postulaciones.php');
        }
    });
}
function ver_motivo_rechazo(id){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&accion=10',
        type: 'GET',
        success: function(resp) {
            $(location).attr('href','motivo_rechazo.php');
        }
    });
}
function contratar(id,id_oferta){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&id_oferta='+id_oferta+'&accion=11',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            location.reload(); 
        }
    });
}
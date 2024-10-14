function modificar(id){
    $.ajax({
        url: 'alterar_oferta_empleo.php?id='+id+'&accion=1',
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
function programar(fecha,hora,ampm){
    $.ajax({
        url: 'alterar_oferta_empleo.php?fecha='+fecha+'&hora='+hora+'&ampm='+ampm+'&accion=7',
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
document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
        url: 'accion_beneficio_oferta.php?accion=2',
        type: 'GET',
        success: function(resp) {
            $('#tabla').html(resp);
        }
    });
});
function agregar_beneficios(tipo_beneficio, beneficio_descrip){
    $.ajax({
        url: 'accion_beneficio_oferta.php?tipo_beneficio='+tipo_beneficio+'&beneficio_descrip='+beneficio_descrip+'&accion=1',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            location.reload();
        }
    });
}
function modificarRegistro(id){
    $.ajax({
        url: 'accion_beneficio_oferta.php?id='+id+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            $('#id_beneficio').val(v0);
            $('#tipo_beneficio').val(v1);
            $('#beneficio_descrip').val(v2);
            document.getElementById("btn").style.display = 'None';
            document.getElementById("btn2").style.display = 'Block';
        }
    });
}
function modificar_beneficios(tipo_beneficio, beneficio_descrip,id){
    $.ajax({
        url: 'accion_beneficio_oferta.php?tipo_beneficio='+tipo_beneficio+'&beneficio_descrip='+beneficio_descrip+'&id='+id+'&accion=4',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            location.reload();
        }
    });
}
function eliminarRegistro(id){
    $.ajax({
        url: 'accion_beneficio_oferta.php?id='+id+'&accion=5',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            location.reload();
        }
    });
}
function finalizar(){
    $.ajax({
        url: 'accion_beneficio_oferta.php?accion=6',
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
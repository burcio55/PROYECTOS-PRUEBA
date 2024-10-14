document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
        url: 'accion_requisito_oferta.php?accion=2',
        type: 'GET',
        success: function(resp) {
            $('#tabla').html(resp);
        }
    });
});
function agregar_requisitos(nivel_requisito, descrip_nivel){
    let contador = 0;
    if($('#nivel_requisito').val()=='-1'){
        contador++;
        $('#nivel_requisito').css('border-color', 'red');
    }else{
        $('#nivel_requisito').css('border-color', '');
    }
    if($('#descrip_nivel').val()==''){
        contador++;
        $('#descrip_nivel').css('border-color', 'red');
    }else{
        $('#descrip_nivel').css('border-color', '');
    }
    if(contador == 0){
        $.ajax({
            url: 'accion_requisito_oferta.php?nivel_requisito='+nivel_requisito+'&descrip_nivel='+descrip_nivel+'&accion=1',
            type: 'GET',
            success: function(resp) {
                alert(resp);
                location.reload();
            }
        });
    }else{
        alert('Debe Completar los campos obligatorios (*)');
    }
}
function modificarRegistro(id){
    $.ajax({
        url: 'accion_requisito_oferta.php?id_oferta='+id+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            $('#id_requerimineto').val(v0);
            $('#nivel_requisito').val(v1);
            $('#descrip_nivel').val(v2);
            document.getElementById("btn").style.display = 'None';
            document.getElementById("btn2").style.display = 'Block';
        }
    });
}
function actualizar_requisitos(nivel_requisito, descrip_nivel,id){
    $.ajax({
        url: 'accion_requisito_oferta.php?nivel_requisito='+nivel_requisito+'&descrip_nivel='+descrip_nivel+'&id='+id+'&accion=4',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            location.reload();
        }
    });
}
function eliminarRegistro(id){
    $.ajax({
        url: 'accion_requisito_oferta.php?id='+id+'&accion=5',
        type: 'GET',
        success: function(resp) {
            alert(resp);
            location.reload();
        }
    });
}
function continuar(){
    $.ajax({
        url: 'accion_requisito_oferta.php?accion=6',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
            }else{
                $(location).attr('href','oferta_empleo3.php');
            }
        }
    });
}
function accion_eliminar4(id_aprendizaje)
{
    /* alert(id_aprendizaje); */
    $.ajax
    ({
        url: 'accion_aprendizaje5.php?id_aprendizaje='+id_aprendizaje,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe4').html(v0);
            /* alert(v0) */
        }
    });
}
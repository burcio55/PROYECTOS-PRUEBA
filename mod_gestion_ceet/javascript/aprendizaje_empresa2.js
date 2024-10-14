function accion_aprendizaje_empresa_del(id_aprendizaje,empresa_id)
{
   /*  alert(id_aprendizaje+" "+empresa_id); */
    $.ajax
    ({
        url: 'accion_aprendizaje_empresa2.php?id_aprendizaje='+id_aprendizaje+'&empresa_id='+empresa_id,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe04').html(v0);
            /* alert(v0) */
        }
    });
}
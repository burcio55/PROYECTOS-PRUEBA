function accion_novedades_empresa_del(novedades2,empresa_id)
{
    alert(novedades2+" "+ empresa_id)
    /* alert("Todo bien") */
    $.ajax
    ({
        url: 'accion_novedad_empresa2.php?novedades2='+novedades2+'&empresa_id='+empresa_id,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe03').html(v0);
            /* alert(v1) */
        }
    });
}

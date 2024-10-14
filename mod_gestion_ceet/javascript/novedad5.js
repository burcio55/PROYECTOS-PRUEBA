function accion_eliminar3(id_novedad)
{
    /* alert(id_novedad); */
    $.ajax
    ({
        url: 'accion_novedad5.php?id_novedad='+id_novedad,
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            $('#fe3').html(v0);
            /* alert(v0) */
        }
    });
}
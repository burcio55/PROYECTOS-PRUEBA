function oferta_trabajo(id_oferta){
    $.ajax({
        url: 'Detalles_oferta.php?id_oferta='+id_oferta,
        type: 'GET',
        success: function(resp) {
            /* alert(resp); */
        }
    });
}
function accion_estado(entidad_nentidad){
    /* alert(entidad_nentidad); */
    $.ajax({
        url: 'accion_busqueda.php?entidad_nentidad='+entidad_nentidad+'&accion=1',
        type: 'POST',
        success: function(resp) {
            $("#municipio_nmunicipio").html(resp);
        }
    });
}
function accion_municipio(municipio_nmunicipio){
    /* alert(municipio_nmunicipio); */
    $.ajax({
        url: 'accion_busqueda.php?municipio_nmunicipio='+municipio_nmunicipio+'&accion=2',
        type: 'POST',
        success: function(resp) {
            $("#parroquia_nparroquia").html(resp);
        }
    });
}
function accion_estado2(entidad_nentidad2){
    /* alert(entidad_nentidad2); */
    $.ajax({
        url: 'accion_busqueda.php?entidad_nentidad2='+entidad_nentidad2+'&accion=3',
        type: 'POST',
        success: function(resp) {
            $("#municipio_nmunicipio2").html(resp);
        }
    });
}
function accion_municipio2(municipio_nmunicipio2){
    /* alert(municipio_nmunicipio2); */
    $.ajax({
        url: 'accion_busqueda.php?municipio_nmunicipio2='+municipio_nmunicipio2+'&accion=4',
        type: 'POST',
        success: function(resp) {
            $("#parroquia_nparroquia2").html(resp);
        }
    });
}
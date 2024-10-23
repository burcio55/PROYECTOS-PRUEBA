
function agregar_estudios(nacademico,graduado,titulo,anio_graduacion,instituto,estatus,ultimo_anio,observaciones){
    $.ajax({
        url: 'v_educacion.php?nacademico='+nacademico+'&graduado='+graduado+'&titulo='+titulo+'&anio_graduacion='+anio_graduacion+'&instituto='+instituto+'&estatus='+estatus+'&ultimo_anio='+ultimo_anio+'&observaciones='+observaciones,
        type: 'GET',
        data: nacademico,
        data: graduado,
        data: titulo,
        data: anio_graduacion,
        data: instituto,
        data: estatus,
        data: ultimo_anio,
        data: observaciones,
        success: function(resp) {
            $('#estudios').html(resp);
        }
    });
}
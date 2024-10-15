$(document).ready(function(){
    //alert('Hola Mundo');
    $.ajax({
        url: 'tabla_educacion.php',
        type: 'GET',
        success: function(resp) {
            $('#estudios').html(resp);
            //alert(resp);
        }
    });
})
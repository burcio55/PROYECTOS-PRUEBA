function aceptar_entrevista(postuacion_id,entrevista_id){
    $.ajax({
        url: 'entrevista_aceptar.php?postuacion_id='+postuacion_id+'&entrevista_id='+entrevista_id,
        type: 'GET',
        success: function(resp) {
            document.getElementById("texto").innerText = resp;
            document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
            document.getElementById("link").value = 'postulaciones.php?postuacion_id='+postuacion_id;
        }
    });
}
function rechazar_entrevista(postuacion_id,entrevista_id){
    $.ajax({
        url: 'rechazar_entrevista.php?postuacion_id='+postuacion_id+'&entrevista_id='+entrevista_id,
        type: 'GET',
        success: function(resp) {
            /* alert(resp); */
            $(location).attr('href','rechazar_entrevista.php?postuacion_id='+postuacion_id);
        }
    });
}
function enviar_razon(postuacion_id,entrevista_id,razon){
    $.ajax({
        url: 'entrevista_rechazar.php?postuacion_id='+postuacion_id+'&entrevista_id='+entrevista_id+'&razon='+razon,
        type: 'GET',
        success: function(resp) {
            /* alert(resp); */
            $(location).attr('href','postulaciones.php?postuacion_id='+postuacion_id);
        }
    });
}
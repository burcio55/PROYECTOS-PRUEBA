function accion_aprendizaje_empresa(aprendizaje2,srif)
{
    /* alert(aprendizaje2 + " " + srif + " " + personales_cedula) */
    let valor = 0;
    if(document.getElementById("aprendizaje2").value == -1){
        document.getElementById("aprendizaje2").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("aprendizaje2").style.borderColor = '';
    }
    if(document.getElementById("srif").value == ''){
        document.getElementById("srif").style.borderColor = 'Red';
        valor++;
    }else{
        document.getElementById("srif").style.borderColor = '';
    }
    if(valor > 0){
        alert('Debe llenar los Campos Obligatorios *');
    }else{
        /* alert("Todo bien") */
        $.ajax
        ({
            url: 'accion_aprendizaje_empresa.php?aprendizaje2='+aprendizaje2+'&srif='+srif,
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if(v0 == 1){
                    alert(v1);
                    $('#fe04').html(v2);
                }else{
                    alert(v1);
                }
            }
        });
    }
}

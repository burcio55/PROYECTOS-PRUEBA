function editar_recomendaciones(final_id)
{
    
    const element = document.getElementById("motivo_desincorporacion2")
    let colum2 =  document.getElementById("final_id").value;
    if (colum2 == "113"){
        $('#motivo_desincorporacion2').css('display','none');
    } else {
        $('#motivo_desincorporacion2').css('display','block');
    }
}

function buscar2(){
    let contador = 0;
    let informe = document.getElementById("informe");

    if(informe.value == ""){
        informe.style.border = "1px solid red";
        contador++;
    }else{
        informe.style.border = "";
    }

    if(contador > 0){
        alert("Debe llenar los datos obligatorios");
    }else{
        $.ajax({
            url: 'interaccion2.php?informe='+informe.value+'&accion=5',
            type: 'GET',
            success: function(resp){
                let v0 = resp.split(" / ")[0];
                let v1 = resp.split(" / ")[1];
                let v2 = resp.split(" / ")[2];
                let v3 = resp.split(" / ")[3];
                let v4 = resp.split(" / ")[4];
                let v5 = resp.split(" / ")[5];
                let v6 = resp.split(" / ")[6];
                if(v0 == '1')
                {
                    document.getElementById("cedula").value = v1; 
                    document.getElementById("nombres").value = v2; 
                    document.getElementById("apellidos").value = v3; 
                    document.getElementById("adcripcion").value = v4;
                    document.getElementById("subicacion_fisica").value = v5;
                    document.getElementById("cargotitular").value = v6; 
                    document.getElementById("scargo_actual_ejerce").value = v7;
                }
            }
        });
    } 
}


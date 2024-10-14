$(document).ready(function(){
    //alert('Hola Mundo');
    $.ajax({
        url: 'tabla_educacion.php',
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            $('#estudios').html(v0);
            $('#Nivel_academico').html(v1);
            $('#continuar').prop("tabindex",v2+2);
            $('#regresar').prop("tabindex",v2+1);
            //alert(resp);
        }
    });
})

function modificar_educacion(id){
    //alert(id);
    $.ajax({
        url: 'modificar_educacion.php?id='+id,
        type: 'GET',
        success: function(resp) {
            //separa el areglo y guardarlo en diferentes variables
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2];
            let v3 = resp.split(" / ")[3];
            let v4 = resp.split(" / ")[4];
            let v5 = resp.split(" / ")[5];
            let v6 = resp.split(" / ")[6];
            let v7 = resp.split(" / ")[7];
            let v8 = resp.split(" / ")[8];
            let valor = document.getElementById("cbNivel_academico").tabIndex;
            let valor1 = valor+1;
            let valor2 = valor+2;
            let valor3 = valor+3;
            let valor4 = valor+4;
            let valor5 = valor+5;
            let valor6 = valor+6;
            //validar todos los procesos
            if(v8 == 'ninguna'){
                v8 = '';
            }
            if(v2 == 't'){
                v2 = '1';
            }else{
                v2 = '2';
            }
            document.getElementById("texto").innerText = ('Se extrajo sus datos con exito');
            document.getElementById("titulo").style.backgroundColor = "#46A2FD"; //Azul
            document.getElementById("titulo").style.color = "white";
            document.getElementById("titulo").innerText = ("Atención");
            document.getElementById("alerta").style.display = "Block";
            document.getElementById("usuario").value = v0;
            document.getElementById("cbNivel_academico").value = v1;
            document.getElementById("cbNivel_academico").focus();
            document.getElementById("cbGraduado").value = v2;
            document.getElementById("titulo").value = v3;
            document.getElementById("anio_graduacion").value = v4;
            document.getElementById("instituto").value = v5;
            document.getElementById("Estatus_academico").value = v6;
            document.getElementById("ultimo_anio").value = v7;
            document.getElementById("Observaciones_educacion").value = v8;
            document.getElementById("btn2").style.display = 'block';
            document.getElementById("btn").style.display = 'none';
            if(v1 > '2'){
                document.getElementById("Graduado").style.display = 'block';
                document.getElementById("cbGraduado").tabIndex = valor1;
                document.getElementById("titulo").value = v3;
                if(v2 == '1'){
                    document.getElementById("tr_titulo").style.display = 'block';
                    document.getElementById("tr_titulo").tabIndex = valor2;
                    document.getElementById("titulo").tabIndex = valor2;
                    document.getElementById("titulo").value = v3;
                    document.getElementById("tr_anio").style.display = 'block';
                    document.getElementById("tr_anio").tabIndex = valor3;
                    document.getElementById("anio_graduacion").tabIndex = valor3;
                    document.getElementById("tr_instituto").style.display = 'block';
                    document.getElementById("tr_instituto").tabIndex = valor4;
                    document.getElementById("instituto").tabIndex = valor4;
                    document.getElementById("obe").tabIndex = valor5;
                    document.getElementById("Observaciones_educacion").tabIndex = valor5;
                    document.getElementById("ult_anio").style.display = 'none';
                    document.getElementById("tr_status").style.display = 'none';
                    document.getElementById("Esp").style.display = 'none';
                    document.getElementById("btn2").tabIndex = valor6;
                }else{
                    document.getElementById("tr_titulo").style.display = 'none';
                    document.getElementById("tr_anio").style.display = 'none';
                    document.getElementById("tr_instituto").style.display = 'block';
                    document.getElementById("tr_instituto").tabIndex = valor2;
                    document.getElementById("instituto").tabIndex = valor2;
                    document.getElementById("ult_anio").style.display = 'block';
                    document.getElementById("ult_anio").tabIndex = valor4;
                    document.getElementById("ultimo_anio").tabIndex = valor4;
                    document.getElementById("tr_status").style.display = 'block';
                    document.getElementById("Estatus_academico").tabIndex = valor3;
                    document.getElementById("obe").tabIndex = valor5;
                    document.getElementById("Observaciones_educacion").tabIndex = valor5;
                    document.getElementById("btn2").tabIndex = valor6;
                }
            }else{
                document.getElementById("Graduado").style.display = 'none';
                document.getElementById("tr_titulo").style.display = 'none';
                document.getElementById("tr_anio").style.display = 'none';
                document.getElementById("tr_instituto").style.display = 'none';
                document.getElementById("ult_anio").style.display = 'none';
                document.getElementById("tr_status").style.display = 'none';
                document.getElementById("Esp").style.display = 'none';
            } 
        }
    });
}

function eliminar_educacion(id){
    //alert(id);
    $.ajax({
        url: 'eliminar_educacion.php?id='+id,
        type: 'GET',
        success: function(resp) {
            $('#estudios').html(resp);
            //alert(resp);
        }
    });
}
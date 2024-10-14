 $(document).ready(function(){
    //alert('Hola Mundo');
    $.ajax({
        url: 'mostrar_rs.php',
        type: 'GET',
        success: function(resp) {
            //alert(resp);
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            $('#tabla_red_social').html(v0);
            $('#Datos_Familiares').prop("tabindex",v1+1);
            $('#cbJefe_familia').prop("tabindex",v1+2);
            $('#cbHijos').prop("tabindex",v1+3);
            $('#informacion_id').prop("tabindex",v1+4);
        }
    });
})  
function agregar_red(redes_sociales,twitter,facebook,telegram,instagram,tik_tok,id_redes_sociales,){
    $.ajax({
        url: 'redes_sociales.php?redes_sociales='+redes_sociales+'&twitter='+twitter+'&facebook='+facebook+'&telegram='+telegram+'&instagram='+instagram+'&tik_tok='+tik_tok+'&id='+id_redes_sociales,
        type: 'GET',
        success: function(resp) {
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            if(v0 == 1){
                document.getElementById("texto").innerText = v1;
                document.getElementById("titulo").style.backgroundColor = "#DC3831";
                document.getElementById("titulo").style.color = "white";
                document.getElementById("titulo").innerText = ("Atención");
                document.getElementById("alerta").style.display = "Block";
            }else
            if(v0 == 2){
                $('#tabla_red_social').html(v1);
                $('#redes_sociales').val('-1');
                $('#twitter').val('');
                $('#facebook').val('');
                $('#telegram').val('');
                $('#instagram').val('');
                $('#tik_tok').val('');
                $('#name_red').val('');
                $('#name_user').val('');
                sel();
            }else{
                $('#tabla_red_social').html(resp);
                $('#redes_sociales').val('-1');
                $('#twitter').val('');
                $('#facebook').val('');
                $('#telegram').val('');
                $('#instagram').val('');
                $('#tik_tok').val('');
                $('#name_red').val('');
                $('#name_user').val('');
                sel();
            }
        }
    });
}
function editar_red_social(id){
    //alert(id);
    $.ajax({
        url: 'editar_red_social.php?id='+id,
        type: 'GET',
        success: function(resp) {
            //alert(resp);
            let v0 = resp.split(" / ")[0];
            let v1 = resp.split(" / ")[1];
            let v2 = resp.split(" / ")[2]; 
            $("#id_redes_sociales").val(v0);
            $("#redes_sociales").val(v1);
            $("#twitter").val(v2);
            $("#facebook").val(v2);
            $("#telegram").val(v2);
            $("#instagram").val(v2);
            $("#tik_tok").val(v2);
            let valor = document.getElementById("redes_sociales").tabIndex;
            tab = valor + 1;
            if(v1 == '10'){
                document.getElementById("red2").style.display = 'block';
                document.getElementById("red2").focus();
                document.getElementById("red2").tabIndex = tab;
                document.getElementById("twitter").tabIndex = tab;
                document.getElementById("red3").style.display = 'none';
                document.getElementById("red4").style.display = 'none';
                document.getElementById("red5").style.display = 'none';
                document.getElementById("red6").style.display = 'none';
                document.getElementById("red7").style.display = 'none';
                document.getElementById("red8").style.display = 'none';
            } else if (v1 == '2') {
                document.getElementById("red2").style.display = 'none';
                document.getElementById("red3").style.display = 'block';
                document.getElementById("red3").focus();
                document.getElementById("red3").tabIndex = tab;
                document.getElementById("facebook").tabIndex = tab;
                document.getElementById("red4").style.display = 'none';
                document.getElementById("red5").style.display = 'none';
                document.getElementById("red6").style.display = 'none';
                document.getElementById("red7").style.display = 'none';
                document.getElementById("red8").style.display = 'none';
            } else if (v1 == '8') {
                document.getElementById("red2").style.display = 'none';
                document.getElementById("red3").style.display = 'none';
                document.getElementById("red4").style.display = 'block';
                document.getElementById("red4").focus();
                document.getElementById("red4").tabIndex = tab;
                document.getElementById("telegram").tabIndex = tab;
                document.getElementById("red5").style.display = 'none';
                document.getElementById("red6").style.display = 'none';
                document.getElementById("red7").style.display = 'none';
                document.getElementById("red8").style.display = 'none';
            } else if (v1 == '4') {
                document.getElementById("red2").style.display = 'none';
                document.getElementById("red3").style.display = 'none';
                document.getElementById("red4").style.display = 'none';
                document.getElementById("red5").style.display = 'block';
                document.getElementById("red5").focus();
                document.getElementById("red5").tabIndex = tab;
                document.getElementById("instagram").tabIndex = tab;
                document.getElementById("red6").style.display = 'none';
                document.getElementById("red7").style.display = 'none';
                document.getElementById("red8").style.display = 'none';
            } else if (v1 == '15') {
                document.getElementById("red2").style.display = 'none';
                document.getElementById("red3").style.display = 'none';
                document.getElementById("red4").style.display = 'none';
                document.getElementById("red5").style.display = 'none';
                document.getElementById("red6").style.display = 'block';
                document.getElementById("red6").focus();
                document.getElementById("red6").tabIndex = tab;
                document.getElementById("tik_tok").tabIndex = tab;
                document.getElementById("red7").style.display = 'none';
                document.getElementById("red8").style.display = 'none';
            } else if (v1 == '5') {
                document.getElementById("red2").style.display = 'none';
                document.getElementById("red3").style.display = 'none';
                document.getElementById("red4").style.display = 'none';
                document.getElementById("red5").style.display = 'none';
                document.getElementById("red6").style.display = 'none';
                document.getElementById("redes_sociales").focus();
                document.getElementById("red7").style.display = 'none';
                document.getElementById("red8").style.display = 'none';
            }
            document.getElementById("btn").style.display = 'block';
            document.getElementById("red_social").style.display = 'none';
        }
    });
}
function eliminar_red_social(id){
    $.ajax({
        url: 'eliminar_red_social.php?id='+id,
        type: 'GET',
        success: function(resp) {
            //alert(resp);
            $('#tabla_red_social').html(resp);
        }
    });
}
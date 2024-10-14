function buscar(value) {
    document.getElementById("idSucursal").value = value;
    $.ajax
    ({
        url: 'accion_empleo_oferta.php?value='+value+'&accion=3',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            let v3 =  resp.split(" / ")[3];
            let v4 =  resp.split(" / ")[4];
            $("#nombre_comercial").text(v0);
            $("#sdirecion").text(v1);
            $("#estado").text(v2);
            $("#municipio").text(v3);
            $("#parroquia").text(v4);
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    $.ajax({
        url: 'accion_empleo_oferta.php?accion=2',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            let v3 =  resp.split(" / ")[3];
            let v4 =  resp.split(" / ")[4];
            let v5 =  resp.split(" / ")[5];
            let v6 =  resp.split(" / ")[6];
            let v7 =  resp.split(" / ")[7];
            let v8 =  resp.split(" / ")[8];
            if (v8 == "AM"){
                v8 = 1;
            }else{
                v8 = 2;
            }
            let v9 =  resp.split(" / ")[9];
            let v10 =  resp.split(" / ")[10];
            let v11 =  resp.split(" / ")[11];
            if (v11 == "AM"){
                v11 = 1;
            }else{
                v11 = 2;
            }
            let v12 =  resp.split(" / ")[12];
            if(v0 == ''){
                /* if(v10 == '0'){
                    $("#selector").val('1');
                }else{
                    $("#selector").val('2');
                    document.getElementById("sucursales").style.display = 'block';
                } */
            }else{
                $("#valor_id").val(v0);
                /* if(v1 == '0'){
                    $("#selector").val('1');
                }else{
                    $("#selector").val('2');
                    document.getElementById("sucursales").style.display = 'block';
                } */
                document.getElementById("parte1").style.display = 'none';
                $("#selector2").val(v1);
                $("#idSucursal").val(v1);
                buscar(v1);
                $("#cargo").val(v2);
                $("#tipo_contrato").val(v3);
                $("#frecuencia_pago").val(v4);
                $("#laborales").val(v5);
                $("#Hora_Entrada").val(v6);
                $("#Hora_Entrada2").val(v7);
                $("#AmPm1").val(v8);
                $("#Hora_Salida2").val(v9);
                $("#Hora_Salida").val(v10);
                $("#AmPm2").val(v11);
                $("#vacantes").val(v12);
            }
        }
    });
});
function agregar_oferta_empleo(selector,selector2,nombre_comercial,estado,municipio,parroquia,sdirecion,cargo,vacantes,tipo_contrato,frecuencia_pago,Hora_Entrada,Hora_Entrada2,AmPm1,Hora_Salida,Hora_Salida2,AmPm2,laborales) 
{
    var contador = 0;
    if($('#selector').val()=='-1'){
        contador++;
        $('#selector').css('border-color', 'red');
    }else{
        $('#selector').css('border-color', '');
        if($('#selector').val()=='2' && $('#selector2').val()=='-1'){
            contador++;
            $('#selector2').css('border-color', 'red');
        }else
        if($('#selector').val()=='2' && $('#selector2').val()!='-1'){
            $('#selector2').css('border-color', '');
        }
    }
    if($('#cargo').val()==''){
        contador++;
        $('#cargo').css('border-color', 'red');
    }else{
        $('#cargo').css('border-color', '');
    }
    if($('#vacantes').val()==''){
        contador++;
        $('#vacantes').css('border-color', 'red');
    }else{
        $('#vacantes').css('border-color', '');
    }
    if($('#tipo_contrato').val()=='-1'){
        contador++;
        $('#tipo_contrato').css('border-color', 'red');
    }else{
        $('#tipo_contrato').css('border-color', '');
    }
    if($('#frecuencia_pago').val()=='-1'){
        contador++;
        $('#frecuencia_pago').css('border-color', 'red');
    }else{
        $('#frecuencia_pago').css('border-color', '');
    }
    if($('#Hora_Entrada').val()=='-1'){
        contador++;
        $('#Hora_Entrada').css('border-color', 'red');
    }else{
        $('#Hora_Entrada').css('border-color', '');
    }
    if($('#Hora_Entrada2').val()=='-1'){
        contador++;
        $('#Hora_Entrada2').css('border-color', 'red');
    }else{
        $('#Hora_Entrada2').css('border-color', '');
    }
    if($('#AmPm1').val()=='-1'){
        contador++;
        $('#AmPm1').css('border-color', 'red');
    }else{
        $('#AmPm1').css('border-color', '');
    }
    if($('#Hora_Salida').val()=='-1'){
        contador++;
        $('#Hora_Salida').css('border-color', 'red');
    }else{
        $('#Hora_Salida').css('border-color', '');
        /* let hora_s = $('#Hora_Salida').val(); 
        let valid_hora_s = /^[0-9]{2}[:][0-9]{2}$/.test(hora_s);
        if (!valid_hora_s) {
            contador++;
            alert("Formato de la Hora no es Válido Ej: 90:30");
            $('#Hora_Salida').css('border-color', 'red');
        } */
    }
    if($('#Hora_Salida2').val()=='-1'){
        contador++;
        $('#Hora_Salida2').css('border-color', 'red');
    }else{
        $('#Hora_Salida2').css('border-color', '');
    }
    if($('#AmPm2').val()=='-1'){
        contador++;
        $('#AmPm2').css('border-color', 'red');
    }else{
        $('#AmPm2').css('border-color', '');
    }
    if($('#laborales').val()==''){
        contador++;
        $('#laborales').css('border-color', 'red');
    }else{
        $('#laborales').css('border-color', '');
    }
    if(contador == 0){
        /* alert (cargo + ' ' + vacantes + ' ' + tipo_contrato + ' ' + frecuencia_pago + ' ' + Hora_Entrada + ' ' + Hora_Entrada2 + ' ' + AmPm1 + ' ' + Hora_Salida + ' ' + Hora_Salida2 + ' ' + AmPm2 + ' ' + laborales) */
        $.ajax
        ({
            url: 'accion_empleo_oferta.php?selector='+selector+'&selector2='+selector2+'&nombre_comercial='+nombre_comercial+'&estado='+estado+'&municipio='+municipio+'&parroquia='+parroquia+'&sdirecion='+sdirecion+'&cargo='+cargo+'&vacantes='+vacantes+'&tipo_contrato='+tipo_contrato+'&frecuencia_pago='+frecuencia_pago+'&Hora_Entrada='+Hora_Entrada+'&Hora_Entrada2='+Hora_Entrada2+'&AmPm1='+AmPm1+'&Hora_Salida='+Hora_Salida+'&Hora_Salida2='+Hora_Salida2+'&AmPm2='+AmPm2+'&laborales='+laborales+'&accion=1',
            type: 'GET',
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if(v0 == 1){
                    let mensaje1 =  v1.split(" - ")[0];
                    let mensaje2 =  v1.split(" - ")[1];
                    alert(mensaje1);
                    $(mensaje2).css('border-color', 'red');
                }else{
                    alert(v1);
                    $(location).attr('href','oferta_empleo2.php'); 
                }
            }
        });
    }else{
        alert('Debe Completar los campos obligatorios (*)');
    }
}
function modificar_oferta(selector,selector2,nombre_comercial,estado,municipio,parroquia,sdirecion,cargo,vacantes,tipo_contrato,frecuencia_pago,Hora_Entrada,Hora_Entrada2,AmPm1,Hora_Salida,Hora_Salida2,AmPm2,valor_id,laborales) 
{
    var contador = 0;
    if($('#selector').val()=='-1'){
        contador++;
        $('#selector').css('border-color', 'red');
    }else{
        $('#selector').css('border-color', '');
        if($('#selector').val()=='2' && $('#selector2').val()=='-1'){
            contador++;
            $('#selector2').css('border-color', 'red');
        }else
        if($('#selector').val()=='2' && $('#selector2').val()!='-1'){
            $('#selector2').css('border-color', '');
        }
    }
    if($('#cargo').val()==''){
        contador++;
        $('#cargo').css('border-color', 'red');
    }else{
        $('#cargo').css('border-color', '');
    }
    if($('#vacantes').val()==''){
        contador++;
        $('#vacantes').css('border-color', 'red');
    }else{
        $('#vacantes').css('border-color', '');
    }
    if($('#tipo_contrato').val()=='-1'){
        contador++;
        $('#tipo_contrato').css('border-color', 'red');
    }else{
        $('#tipo_contrato').css('border-color', '');
    }
    if($('#frecuencia_pago').val()=='-1'){
        contador++;
        $('#frecuencia_pago').css('border-color', 'red');
    }else{
        $('#frecuencia_pago').css('border-color', '');
    }
    if($('#Hora_Entrada').val()=='-1'){
        contador++;
        $('#Hora_Entrada').css('border-color', 'red');
    }else{
        $('#Hora_Entrada').css('border-color', '');
    }
    if($('#Hora_Entrada2').val()=='-1'){
        contador++;
        $('#Hora_Entrada2').css('border-color', 'red');
    }else{
        $('#Hora_Entrada2').css('border-color', '');
    }
    if($('#AmPm1').val()=='-1'){
        contador++;
        $('#AmPm1').css('border-color', 'red');
    }else{
        $('#AmPm1').css('border-color', '');
    }
    if($('#Hora_Salida').val()=='-1'){
        contador++;
        $('#Hora_Salida').css('border-color', 'red');
    }else{
        $('#Hora_Salida').css('border-color', '');
        /* let hora_s = $('#Hora_Salida').val(); 
        let valid_hora_s = /^[0-9]{2}[:][0-9]{2}$/.test(hora_s);
        if (!valid_hora_s) {
            contador++;
            alert("Formato de la Hora no es Válido Ej: 90:30");
            $('#Hora_Salida').css('border-color', 'red');
        } */
    }
    if($('#Hora_Salida2').val()=='-1'){
        contador++;
        $('#Hora_Salida2').css('border-color', 'red');
    }else{
        $('#Hora_Salida2').css('border-color', '');
    }
    if($('#AmPm2').val()=='-1'){
        contador++;
        $('#AmPm2').css('border-color', 'red');
    }else{
        $('#AmPm2').css('border-color', '');
    }
    if($('#laborales').val()==''){
        contador++;
        $('#laborales').css('border-color', 'red');
    }else{
        $('#laborales').css('border-color', '');
    }
    $.ajax
    ({
        url: 'accion_empleo_oferta.php?selector='+selector+'&selector2='+selector2+'&nombre_comercial='+nombre_comercial+'&estado='+estado+'&municipio='+municipio+'&parroquia='+parroquia+'&sdirecion='+sdirecion+'&cargo='+cargo+'&vacantes='+vacantes+'&tipo_contrato='+tipo_contrato+'&frecuencia_pago='+frecuencia_pago+'&Hora_Entrada='+Hora_Entrada+'&Hora_Entrada2='+Hora_Entrada2+'&AmPm1='+AmPm1+'&Hora_Salida='+Hora_Salida+'&Hora_Salida2='+Hora_Salida2+'&AmPm2='+AmPm2+'&laborales='+laborales+'&valor_id='+valor_id+'&accion=4',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);
            }else{
                alert(v1);
                $(location).attr('href','oferta_empleo2.php'); 
            }
        }
    });
}

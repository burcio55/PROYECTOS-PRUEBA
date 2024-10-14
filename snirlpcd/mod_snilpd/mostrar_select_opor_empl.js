function buscar(value) {
    document.getElementById("idSucursal").innerText = value;
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
            $("#nombre_comercial").val(v0);
            $("#estado").val(v1);
            $("#municipio").val(v2);
            $("#parroquia").val(v3);
            $("#sdirecion").val(v4);
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
            let v9 =  resp.split(" / ")[9];
            if(v0 == -1){
            }else{
                $("#valor_id").val(v0);
                if(v1 == '0'){
                    $("#selector").val('1');
                }else{
                    $("#selector").val('2');
                }
                document.getElementById("parte1").style.display = 'none';
                $("#selector2").val(v1);
                $("#idSucursal").text(v1);
                buscar(v1);
                $("#cargo").val(v2);
                $("#tipo_contrato").val(v3);
                $("#frecuencia_pago").val(v4);
                $("#laborales").val(v5);
                $("#Hora_Entrada").val(v6);
                if(v7 == 'AM'){
                    $("#AmPm1").val('1');
                }else{
                    $("#AmPm1").val('2');
                }
                $("#Hora_Salida").val(v8);
                if(v9 == 'AM'){
                    $("#AmPm2").val('1');
                }else{
                    $("#AmPm2").val('2');
                } 
            }
        }
    });
});
function agregar_oferta_empleo(selector,selector2,nombre_comercial,estado,municipio,parroquia,sdirecion,cargo,tipo_contrato,frecuencia_pago,Hora_Entrada,AmPm1,Hora_Salida,AmPm2,laborales) 
{
/*    alert(Hora_Entrada+" "+AmPm1+" "+Hora_Salida+" "+AmPm2+" "+laborales);
 */
    $.ajax
    ({
        url: 'accion_empleo_oferta.php?selector='+selector+'&selector2='+selector2+'&nombre_comercial='+nombre_comercial+'&estado='+estado+'&municipio='+municipio+'&parroquia='+parroquia+'&sdirecion='+sdirecion+'&cargo='+cargo+'&tipo_contrato='+tipo_contrato+'&frecuencia_pago='+frecuencia_pago+'&Hora_Entrada='+Hora_Entrada+'&AmPm1='+AmPm1+'&Hora_Salida='+Hora_Salida+'&AmPm2='+AmPm2+'&laborales='+laborales+'&accion=1',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(v1);                $(location).attr('href','oferta_empleo2.php'); 

            }else{
                alert(v1);
            }
        }
    });
}
function modificar_oferta(selector,selector2,nombre_comercial,estado,municipio,parroquia,sdirecion,cargo,tipo_contrato,frecuencia_pago,Hora_Entrada,AmPm1,Hora_Salida,AmPm2,laborales,valor_id) 
{
    $.ajax
    ({
        url: 'accion_empleo_oferta.php?selector='+selector+'&selector2='+selector2+'&nombre_comercial='+nombre_comercial+'&estado='+estado+'&municipio='+municipio+'&parroquia='+parroquia+'&sdirecion='+sdirecion+'&cargo='+cargo+'&tipo_contrato='+tipo_contrato+'&frecuencia_pago='+frecuencia_pago+'&Hora_Entrada='+Hora_Entrada+'&AmPm1='+AmPm1+'&Hora_Salida='+Hora_Salida+'&AmPm2='+AmPm2+'&laborales='+laborales+'&valor_id='+valor_id+'&accion=4',
        type: 'GET',
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            if(v0 == 1){
                alert(resp);
            }else{
                alert(v1);
                $(location).attr('href','oferta_empleo2.php'); 
            }
        }
    });
}

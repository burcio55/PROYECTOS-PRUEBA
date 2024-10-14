function cerrar(){
    document.getElementById("alerta").style.display = "none";
}
function cerrar2(){
    document.getElementById("alerta2").style.display = "none";
    location.reload()
}
function accion_agregar_entes(){
    let valor = 0;
    let mensaje_p = "";
    let mensaje_m = "";
    let mensaje1 = "";
    let mensaje2 = "";

    let nentes = document.getElementById("nentes").value;
    
    let alto_nivel = document.getElementById("alto_nivel").value;
    let alto_nivel_no = document.getElementById("alto_nivel_no").value;
    let alto_nivel_exc = document.getElementById("alto_nivel_exc").value;
    let alto_nivel_m_bueno = document.getElementById("alto_nivel_m_bueno").value;
    let alto_nivel_bueno = document.getElementById("alto_nivel_bueno").value;
    let alto_nivel_ordinario = document.getElementById("alto_nivel_ordinario").value;
    let alto_nivel_no_cump = document.getElementById("alto_nivel_no_cump").value;
    let alto_nivel_sobservaciones = document.getElementById("alto_nivel_sobservaciones").value;

    let designado = document.getElementById("designado").value;
    let designado_no = document.getElementById("designado_no").value;
    let designado_exc = document.getElementById("designado_exc").value;
    let designado_m_bueno = document.getElementById("designado_m_bueno").value;
    let designado_bueno = document.getElementById("designado_bueno").value;
    let designado_ordinario = document.getElementById("designado_ordinario").value;
    let designado_no_cump = document.getElementById("designado_no_cump").value;
    let designado_sobservaciones = document.getElementById("designado_sobservaciones").value;

    let empleado = document.getElementById("empleado").value;
    let empleado_no = document.getElementById("empleado_no").value;
    let empleado_exc = document.getElementById("empleado_exc").value;
    let empleado_m_bueno = document.getElementById("empleado_m_bueno").value;
    let empleado_bueno = document.getElementById("empleado_bueno").value;
    let empleado_ordinario = document.getElementById("empleado_ordinario").value;
    let empleado_no_cump = document.getElementById("empleado_no_cump").value;
    let empleado_sobservaciones = document.getElementById("empleado_sobservaciones").value;

    let obreros = document.getElementById("obreros").value;
    let obreros_no = document.getElementById("obreros_no").value;
    let obreros_exc = document.getElementById("obreros_exc").value;
    let obreros_m_bueno = document.getElementById("obreros_m_bueno").value;
    let obreros_bueno = document.getElementById("obreros_bueno").value;
    let obreros_ordinario = document.getElementById("obreros_ordinario").value;
    let obreros_no_cump = document.getElementById("obreros_no_cump").value;
    let obreros_sobservaciones = document.getElementById("obreros_sobservaciones").value;

    let c_servicios = document.getElementById("c_servicios").value;
    let c_servicios_no = document.getElementById("c_servicios_no").value;
    let c_servicios_exc = document.getElementById("c_servicios_exc").value;
    let c_servicios_m_bueno = document.getElementById("c_servicios_m_bueno").value;
    let c_servicios_bueno = document.getElementById("c_servicios_bueno").value;
    let c_servicios_ordinario = document.getElementById("c_servicios_ordinario").value;
    let c_servicios_no_cump = document.getElementById("c_servicios_no_cump").value;
    let c_servicios_sobservaciones = document.getElementById("c_servicios_sobservaciones").value;

    if(document.getElementById("nentes").value == "-1"){
        document.getElementById("nentes").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("nentes").style.borderColor = "";
    }

    if(document.getElementById("alto_nivel").value == ""){
        document.getElementById("alto_nivel").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_no").value == ""){
        document.getElementById("alto_nivel_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_no").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_exc").value == ""){
        document.getElementById("alto_nivel_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_exc").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_m_bueno").value == ""){
        document.getElementById("alto_nivel_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_bueno").value == ""){
        document.getElementById("alto_nivel_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_bueno").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_ordinario").value == ""){
        document.getElementById("alto_nivel_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_ordinario").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_no_cump").value == ""){
        document.getElementById("alto_nivel_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_no_cump").style.borderColor = "";
    }

    if(document.getElementById("designado").value == ""){
        document.getElementById("designado").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado").style.borderColor = "";
    }
    if(document.getElementById("designado_no").value == ""){
        document.getElementById("designado_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_no").style.borderColor = "";
    }
    if(document.getElementById("designado_exc").value == ""){
        document.getElementById("designado_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_exc").style.borderColor = "";
    }
    if(document.getElementById("designado_m_bueno").value == ""){
        document.getElementById("designado_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("designado_bueno").value == ""){
        document.getElementById("designado_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_bueno").style.borderColor = "";
    }
    if(document.getElementById("designado_ordinario").value == ""){
        document.getElementById("designado_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_ordinario").style.borderColor = "";
    }
    if(document.getElementById("designado_no_cump").value == ""){
        document.getElementById("designado_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_no_cump").style.borderColor = "";
    }

    if(document.getElementById("empleado").value == ""){
        document.getElementById("empleado").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado").style.borderColor = "";
    }
    if(document.getElementById("empleado_no").value == ""){
        document.getElementById("empleado_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_no").style.borderColor = "";
    }
    if(document.getElementById("empleado_exc").value == ""){
        document.getElementById("empleado_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_exc").style.borderColor = "";
    }
    if(document.getElementById("empleado_m_bueno").value == ""){
        document.getElementById("empleado_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("empleado_bueno").value == ""){
        document.getElementById("empleado_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_bueno").style.borderColor = "";
    }
    if(document.getElementById("empleado_ordinario").value == ""){
        document.getElementById("empleado_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_ordinario").style.borderColor = "";
    }
    if(document.getElementById("empleado_no_cump").value == ""){
        document.getElementById("empleado_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_no_cump").style.borderColor = "";
    }

    if(document.getElementById("obreros").value == ""){
        document.getElementById("obreros").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros").style.borderColor = "";
    }
    if(document.getElementById("obreros_no").value == ""){
        document.getElementById("obreros_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_no").style.borderColor = "";
    }
    if(document.getElementById("obreros_exc").value == ""){
        document.getElementById("obreros_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_exc").style.borderColor = "";
    }
    if(document.getElementById("obreros_m_bueno").value == ""){
        document.getElementById("obreros_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("obreros_bueno").value == ""){
        document.getElementById("obreros_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_bueno").style.borderColor = "";
    }
    if(document.getElementById("obreros_ordinario").value == ""){
        document.getElementById("obreros_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_ordinario").style.borderColor = "";
    }
    if(document.getElementById("obreros_no_cump").value == ""){
        document.getElementById("obreros_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_no_cump").style.borderColor = "";
    }

    if(document.getElementById("c_servicios").value == ""){
        document.getElementById("c_servicios").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_no").value == ""){
        document.getElementById("c_servicios_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_no").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_exc").value == ""){
        document.getElementById("c_servicios_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_exc").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_m_bueno").value == ""){
        document.getElementById("c_servicios_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_bueno").value == ""){
        document.getElementById("c_servicios_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_bueno").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_ordinario").value == ""){
        document.getElementById("c_servicios_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_ordinario").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_no_cump").value == ""){
        document.getElementById("c_servicios_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_no_cump").style.borderColor = "";
    }
    if(valor > 0){
        mensaje_m = "Debe llenar los Campos Obligatorios (*)";
    }
    if(mensaje_p != "" && mensaje_m != ""){
        mensaje1 = mensaje_m+" y "+mensaje_p;
    }else
    if(mensaje_p != "" || mensaje_m != ""){
        mensaje1 = mensaje_m+" "+mensaje_p;
        /* document.getElementById("mensaje").textContent = mensaje_m+mensaje_p; */
        /* document.getElementById("alerta").style.display = "block"; */
    }
    if(mensaje1 != "" || mensaje2 != ""){
        document.getElementById("mensaje").textContent = mensaje1+" "+mensaje2;
        document.getElementById("alerta").style.display = "block";
        document.getElementById("mensaje").style.textAlign = "center";
    }else{
        $.ajax({
            url: '/minpptrassi/mod_evaluacion/accion_entes.php',
            type: 'POST',
            data: {
                nentes: nentes,
                alto_nivel: alto_nivel,
                alto_nivel_no: alto_nivel_no,
                alto_nivel_exc: alto_nivel_exc,
                alto_nivel_m_bueno: alto_nivel_m_bueno,
                alto_nivel_bueno: alto_nivel_bueno,
                alto_nivel_ordinario: alto_nivel_ordinario,
                alto_nivel_no_cump: alto_nivel_no_cump,
                alto_nivel_sobservaciones: alto_nivel_sobservaciones,
                designado: designado,
                designado_no: designado_no,
                designado_exc: designado_exc,
                designado_m_bueno: designado_m_bueno,
                designado_bueno: designado_bueno,
                designado_ordinario: designado_ordinario,
                designado_no_cump: designado_no_cump,
                designado_sobservaciones: designado_sobservaciones,
                empleado: empleado,
                empleado_no: empleado_no,
                empleado_exc: empleado_exc,
                empleado_m_bueno: empleado_m_bueno,
                empleado_bueno: empleado_bueno,
                empleado_ordinario: empleado_ordinario,
                empleado_no_cump: empleado_no_cump,
                empleado_sobservaciones: empleado_sobservaciones,
                obreros: obreros,
                obreros_no: obreros_no,
                obreros_exc: obreros_exc,
                obreros_m_bueno: obreros_m_bueno,
                obreros_bueno: obreros_bueno,
                obreros_ordinario: obreros_ordinario,
                obreros_no_cump: obreros_no_cump,
                obreros_sobservaciones: obreros_sobservaciones,
                c_servicios: c_servicios,
                c_servicios_no: c_servicios_no,
                c_servicios_exc: c_servicios_exc,
                c_servicios_m_bueno: c_servicios_m_bueno,
                c_servicios_bueno: c_servicios_bueno,
                c_servicios_ordinario: c_servicios_ordinario,
                c_servicios_no_cump: c_servicios_no_cump,
                c_servicios_sobservaciones: c_servicios_sobservaciones,
                accion: 1
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                if (v0 == '0'){
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = v1;
                    document.getElementById("alerta").style.display = "block";
                }else{
                    document.getElementById("mensaje2").style.textAlign = "center";
                    document.getElementById("mensaje2").textContent = v1;
                    document.getElementById("alerta2").style.display = "block";
                }
            }
        })
    }
}

function accion_eliminar_entes(id, fe){
    /* alert (id + ' ' + fe); */
    $.ajax({
        url: '/minpptrassi/mod_evaluacion/accion_entes.php',
        type: 'POST',
        data: {
            id: id,
            accion: 2
        },
        success: function(resp) {
            let v0 =  resp.split(" / ")[0];
            let v1 =  resp.split(" / ")[1];
            let v2 =  resp.split(" / ")[2];
            if (v0 == '0'){
                document.getElementById("mensaje").style.textAlign = "center";
                document.getElementById("mensaje").textContent = "Falló el Sistema";
                document.getElementById("alerta").style.display = "block";
            }else{
                document.getElementById("mensaje2").style.textAlign = "center";
                document.getElementById("mensaje2").textContent = "Se eliminó correctamente";
                document.getElementById("alerta2").style.display = "block";
            }
        }
    })
}
function accion_modificar_entes(id, nalto_nivel_evalu, nalto_nivel_no_evalu, nalto_nivel_exc, nalto_nivel_muy_bueno, nalto_nivel_bueno, nalto_nivel_cump_ord, nalto_nivel_no_cump, salto_nivel_observaciones, ndesignado_evalu, ndesignado_no_evalu, ndesignado_excelente, ndesignado_muy_bueno, ndesignado_bueno, ndesignado_cump_ord, ndesignado_no_cump, ndesignado_observaciones, nempleado_evalu, nempleado_no_evalu, nempleado_excelente, nempleado_muy_bueno, nempleado_bueno, nempleado_cump_ord, nempleado_no_cump, nempleado_observaciones, nobrero_evalu, nobrero_no_evalu, nobrero_excelente, nobrero_muy_bueno, nobrero_bueno, nobrero_cump_ord, nobrero_no_cump, nobrero_observaciones, ncom_servicio_evalu, ncom_servicio_no_evalu, ncom_servicio_excelente, ncom_servicio_muy_bueno, ncom_servicio_bueno, ncom_servicio_cump_ord, ncom_servicio_no_cump, ncom_servicio_observaciones, fe) {

    /* alert(id + " " + nalto_nivel_evalu + " " + nalto_nivel_no_evalu + " " + nalto_nivel_exc  + " " + nalto_nivel_muy_bueno  + " " + nalto_nivel_bueno  + " " + nalto_nivel_cump_ord  + " " + nalto_nivel_no_cump + " " + salto_nivel_observaciones + " " + ndesignado_evalu + " " + ndesignado_no_evalu + " " + ndesignado_excelente + " " + ndesignado_muy_bueno + " " + ndesignado_bueno + " " + ndesignado_cump_ord + " " + ndesignado_no_cump + " " + ndesignado_observaciones + " " + nempleado_evalu + " " + nempleado_no_evalu + " " + nempleado_excelente + " " + nempleado_muy_bueno + " " + nempleado_bueno + " " + nempleado_cump_ord + " " + nempleado_no_cump + " " + nempleado_observaciones + " " + nobrero_evalu + " " + nobrero_no_evalu + " " + nobrero_excelente + " " + nobrero_muy_bueno + " " + nobrero_bueno + " " + nobrero_cump_ord + " " + nobrero_no_cump + " " + nobrero_observaciones + " " + ncom_servicio_evalu + " " + ncom_servicio_no_evalu + " " + ncom_servicio_excelente + " " + ncom_servicio_muy_bueno + " " + ncom_servicio_bueno + " " + ncom_servicio_cump_ord + " " + ncom_servicio_no_cump + " " + ncom_servicio_observaciones + " " + fe); */

    $("#id_entes").val(id);

    $("#alto_nivel").val(nalto_nivel_evalu);
    $("#alto_nivel_no").val(nalto_nivel_no_evalu);
    $("#alto_nivel_exc").val(nalto_nivel_exc);
    $("#alto_nivel_m_bueno").val(nalto_nivel_muy_bueno);
    $("#alto_nivel_bueno").val(nalto_nivel_bueno);
    $("#alto_nivel_ordinario").val(nalto_nivel_cump_ord);
    $("#alto_nivel_no_cump").val(nalto_nivel_no_cump);
    $("#alto_nivel_sobservaciones").val(salto_nivel_observaciones);

    $("#designado").val(ndesignado_evalu);
    $("#designado_no").val(ndesignado_no_evalu);
    $("#designado_exc").val(ndesignado_excelente);
    $("#designado_m_bueno").val(ndesignado_muy_bueno);
    $("#designado_bueno").val(ndesignado_bueno);
    $("#designado_ordinario").val(ndesignado_cump_ord);
    $("#designado_no_cump").val(ndesignado_no_cump);
    $("#designado_sobservaciones").val(ndesignado_observaciones);

    $("#empleado").val(nempleado_evalu);
    $("#empleado_no").val(nempleado_no_evalu);
    $("#empleado_exc").val(nempleado_excelente);
    $("#empleado_m_bueno").val(nempleado_muy_bueno);
    $("#empleado_bueno").val(nempleado_bueno);
    $("#empleado_ordinario").val(nempleado_cump_ord);
    $("#empleado_no_cump").val(nempleado_no_cump);
    $("#empleado_sobservaciones").val(nempleado_observaciones);

    $("#obreros").val(nobrero_evalu);
    $("#obreros_no").val(nobrero_no_evalu);
    $("#obreros_exc").val(nobrero_excelente);
    $("#obreros_m_bueno").val(nobrero_muy_bueno);
    $("#obreros_bueno").val(nobrero_bueno);
    $("#obreros_ordinario").val(nobrero_cump_ord);
    $("#obreros_no_cump").val(nobrero_no_cump);
    $("#obreros_sobservaciones").val(nobrero_observaciones);

    $("#c_servicios").val(ncom_servicio_evalu);
    $("#c_servicios_no").val(ncom_servicio_no_evalu);
    $("#c_servicios_exc").val(ncom_servicio_excelente);
    $("#c_servicios_m_bueno").val(ncom_servicio_muy_bueno);
    $("#c_servicios_bueno").val(ncom_servicio_bueno);
    $("#c_servicios_ordinario").val(ncom_servicio_cump_ord);
    $("#c_servicios_no_cump").val(ncom_servicio_no_cump);
    $("#c_servicios_sobservaciones").val(ncom_servicio_observaciones);

    $("#nentes2").val(fe);

    $('#guard').css('display','none');
    $('#nentes').css('display','none');

    $('#modi').css('display','block');
    $('#nentes2').css('display','block');

    document.getElementById("mensaje").style.textAlign = "center";
    document.getElementById("mensaje").textContent = "Se extrajeron los datos correctamente";
    document.getElementById("alerta").style.display = "block";
}

function accion_entes_mod(id_entes, nentes, nalto_nivel_evalu, nalto_nivel_no_evalu, nalto_nivel_exc, nalto_nivel_muy_bueno, nalto_nivel_bueno, nalto_nivel_cump_ord, nalto_nivel_no_cump, salto_nivel_observaciones, ndesignado_evalu, ndesignado_no_evalu, ndesignado_excelente, ndesignado_muy_bueno, ndesignado_bueno, ndesignado_cump_ord, ndesignado_no_cump, ndesignado_observaciones, nempleado_evalu, nempleado_no_evalu, nempleado_excelente, nempleado_muy_bueno, nempleado_bueno, nempleado_cump_ord, nempleado_no_cump, nempleado_observaciones, nobrero_evalu, nobrero_no_evalu, nobrero_excelente, nobrero_muy_bueno, nobrero_bueno, nobrero_cump_ord, nobrero_no_cump, nobrero_observaciones, ncom_servicio_evalu, ncom_servicio_no_evalu, ncom_servicio_excelente, ncom_servicio_muy_bueno, ncom_servicio_bueno, ncom_servicio_cump_ord, ncom_servicio_no_cump, ncom_servicio_observaciones){

    /* alert(id_entes + " " + nentes + " " + nalto_nivel_evalu + " " + nalto_nivel_no_evalu + " " + nalto_nivel_exc  + " " + nalto_nivel_muy_bueno  + " " + nalto_nivel_bueno  + " " + nalto_nivel_cump_ord  + " " + nalto_nivel_no_cump + " " + salto_nivel_observaciones + " " + ndesignado_evalu + " " + ndesignado_no_evalu + " " + ndesignado_excelente + " " + ndesignado_muy_bueno + " " + ndesignado_bueno + " " + ndesignado_cump_ord + " " + ndesignado_no_cump + " " + ndesignado_observaciones + " " + nempleado_evalu + " " + nempleado_no_evalu + " " + nempleado_excelente + " " + nempleado_muy_bueno + " " + nempleado_bueno + " " + nempleado_cump_ord + " " + nempleado_no_cump + " " + nempleado_observaciones + " " + nobrero_evalu + " " + nobrero_no_evalu + " " + nobrero_excelente + " " + nobrero_muy_bueno + " " + nobrero_bueno + " " + nobrero_cump_ord + " " + nobrero_no_cump + " " + nobrero_observaciones + " " + ncom_servicio_evalu + " " + ncom_servicio_no_evalu + " " + ncom_servicio_excelente + " " + ncom_servicio_muy_bueno + " " + ncom_servicio_bueno + " " + ncom_servicio_cump_ord + " " + ncom_servicio_no_cump + " " + ncom_servicio_observaciones); */

    let valor = 0;

    if(document.getElementById("nentes2").value == "-1"){
        document.getElementById("nentes").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("nentes").style.borderColor = "";
    }

    if(document.getElementById("alto_nivel").value == ""){
        document.getElementById("alto_nivel").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_no").value == ""){
        document.getElementById("alto_nivel_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_no").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_exc").value == ""){
        document.getElementById("alto_nivel_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_exc").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_m_bueno").value == ""){
        document.getElementById("alto_nivel_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_bueno").value == ""){
        document.getElementById("alto_nivel_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_bueno").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_ordinario").value == ""){
        document.getElementById("alto_nivel_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_ordinario").style.borderColor = "";
    }
    if(document.getElementById("alto_nivel_no_cump").value == ""){
        document.getElementById("alto_nivel_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("alto_nivel_no_cump").style.borderColor = "";
    }

    if(document.getElementById("designado").value == ""){
        document.getElementById("designado").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado").style.borderColor = "";
    }
    if(document.getElementById("designado_no").value == ""){
        document.getElementById("designado_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_no").style.borderColor = "";
    }
    if(document.getElementById("designado_exc").value == ""){
        document.getElementById("designado_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_exc").style.borderColor = "";
    }
    if(document.getElementById("designado_m_bueno").value == ""){
        document.getElementById("designado_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("designado_bueno").value == ""){
        document.getElementById("designado_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_bueno").style.borderColor = "";
    }
    if(document.getElementById("designado_ordinario").value == ""){
        document.getElementById("designado_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_ordinario").style.borderColor = "";
    }
    if(document.getElementById("designado_no_cump").value == ""){
        document.getElementById("designado_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("designado_no_cump").style.borderColor = "";
    }

    if(document.getElementById("empleado").value == ""){
        document.getElementById("empleado").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado").style.borderColor = "";
    }
    if(document.getElementById("empleado_no").value == ""){
        document.getElementById("empleado_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_no").style.borderColor = "";
    }
    if(document.getElementById("empleado_exc").value == ""){
        document.getElementById("empleado_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_exc").style.borderColor = "";
    }
    if(document.getElementById("empleado_m_bueno").value == ""){
        document.getElementById("empleado_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("empleado_bueno").value == ""){
        document.getElementById("empleado_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_bueno").style.borderColor = "";
    }
    if(document.getElementById("empleado_ordinario").value == ""){
        document.getElementById("empleado_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_ordinario").style.borderColor = "";
    }
    if(document.getElementById("empleado_no_cump").value == ""){
        document.getElementById("empleado_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("empleado_no_cump").style.borderColor = "";
    }

    if(document.getElementById("obreros").value == ""){
        document.getElementById("obreros").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros").style.borderColor = "";
    }
    if(document.getElementById("obreros_no").value == ""){
        document.getElementById("obreros_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_no").style.borderColor = "";
    }
    if(document.getElementById("obreros_exc").value == ""){
        document.getElementById("obreros_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_exc").style.borderColor = "";
    }
    if(document.getElementById("obreros_m_bueno").value == ""){
        document.getElementById("obreros_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("obreros_bueno").value == ""){
        document.getElementById("obreros_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_bueno").style.borderColor = "";
    }
    if(document.getElementById("obreros_ordinario").value == ""){
        document.getElementById("obreros_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_ordinario").style.borderColor = "";
    }
    if(document.getElementById("obreros_no_cump").value == ""){
        document.getElementById("obreros_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("obreros_no_cump").style.borderColor = "";
    }

    if(document.getElementById("c_servicios").value == ""){
        document.getElementById("c_servicios").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_no").value == ""){
        document.getElementById("c_servicios_no").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_no").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_exc").value == ""){
        document.getElementById("c_servicios_exc").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_exc").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_m_bueno").value == ""){
        document.getElementById("c_servicios_m_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_m_bueno").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_bueno").value == ""){
        document.getElementById("c_servicios_bueno").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_bueno").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_ordinario").value == ""){
        document.getElementById("c_servicios_ordinario").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_ordinario").style.borderColor = "";
    }
    if(document.getElementById("c_servicios_no_cump").value == ""){
        document.getElementById("c_servicios_no_cump").style.borderColor = "Red";
        valor++;
    }else{
        document.getElementById("c_servicios_no_cump").style.borderColor = "";
    }

    if(valor > 0){
        document.getElementById("mensaje").textContent = "Debe llenar los Campos Obligatorios (*)";
        document.getElementById("alerta").style.display = "block";
        document.getElementById("mensaje").style.textAlign = "center";
    }else{
        $.ajax({
            url: '/minpptrassi/mod_evaluacion/accion_entes.php',
            type: 'POST',
            data: {
                id_nentes: id_entes,
                nentes: nentes,
                alto_nivel: nalto_nivel_evalu,
                alto_nivel_no: nalto_nivel_no_evalu,
                alto_nivel_exc: nalto_nivel_exc,
                alto_nivel_m_bueno: nalto_nivel_muy_bueno,
                alto_nivel_bueno: nalto_nivel_bueno,
                alto_nivel_ordinario: nalto_nivel_cump_ord,
                alto_nivel_no_cump: nalto_nivel_no_cump,
                alto_nivel_sobservaciones: salto_nivel_observaciones,
                designado: ndesignado_evalu,
                designado_no: ndesignado_no_evalu,
                designado_exc: ndesignado_excelente,
                designado_m_bueno: ndesignado_muy_bueno,
                designado_bueno: ndesignado_bueno,
                designado_ordinario: ndesignado_cump_ord,
                designado_no_cump: ndesignado_no_cump,
                designado_sobservaciones: ndesignado_observaciones,
                empleado: nempleado_evalu,
                empleado_no: nempleado_no_evalu,
                empleado_exc: nempleado_excelente,
                empleado_m_bueno: nempleado_muy_bueno,
                empleado_bueno: nempleado_bueno,
                empleado_ordinario: nempleado_cump_ord,
                empleado_no_cump: nempleado_no_cump,
                empleado_sobservaciones: nempleado_observaciones,
                obreros: nobrero_evalu,
                obreros_no: nobrero_no_evalu,
                obreros_exc: nobrero_excelente,
                obreros_m_bueno: nobrero_muy_bueno,
                obreros_bueno: nobrero_bueno,
                obreros_ordinario: nobrero_cump_ord,
                obreros_no_cump: nobrero_no_cump,
                obreros_sobservaciones: nobrero_observaciones,
                c_servicios: ncom_servicio_evalu,
                c_servicios_no: ncom_servicio_no_evalu,
                c_servicios_exc: ncom_servicio_excelente,
                c_servicios_m_bueno: ncom_servicio_muy_bueno,
                c_servicios_bueno: ncom_servicio_bueno,
                c_servicios_ordinario: ncom_servicio_cump_ord,
                c_servicios_no_cump: ncom_servicio_no_cump,
                c_servicios_sobservaciones: ncom_servicio_observaciones,
                accion: 3
            },
            success: function(resp) {
                let v0 =  resp.split(" / ")[0];
                let v1 =  resp.split(" / ")[1];
                let v2 =  resp.split(" / ")[2];
                if (v0 == '0'){
                    document.getElementById("mensaje").style.textAlign = "center";
                    document.getElementById("mensaje").textContent = v1;
                    document.getElementById("alerta").style.display = "block";
                }else{
                    document.getElementById("mensaje2").style.textAlign = "center";
                    document.getElementById("mensaje2").textContent = v1;
                    document.getElementById("alerta2").style.display = "block";

                    $('#guard').css('display','block');
                    $('#modi').css('display','none');
                    /* $('#fe').html(v2); */
                }
            }
        })
    }
}
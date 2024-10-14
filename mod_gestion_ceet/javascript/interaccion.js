function sel(){
    let opcion = document.getElementById("Ambiente_Formacion").value;
    if (opcion == 1){
        document.getElementById("op1").style.display='block';
        document.getElementById("ambiente_aprendizaje").style.display='block';
        document.getElementById("boton_aprendizaje").style.display='block';
    }else{
        document.getElementById("op1").style.display='none';
        document.getElementById("ambiente_aprendizaje").style.display='none';
        document.getElementById("boton_aprendizaje").style.display='none';
    }
}
function emp(){
    let opcion = document.getElementById("Ambiente_Formacion2").value;
    if (opcion == 1){
        document.getElementById("op1-2").style.display='block';
        document.getElementById("ambiente_aprendizaje2").style.display='block';
        document.getElementById("boton_aprendizaje2").style.display='block';
    }else{
        document.getElementById("op1-2").style.display='none';
        document.getElementById("ambiente_aprendizaje2").style.display='none';
        document.getElementById("boton_aprendizaje2").style.display='none';
    }
}
function sel3(){
    let opcion = document.getElementById("Formacion_CPTT").value;
    if (opcion == 1){
        document.getElementById("op7").style.display='block';
    }else{
        document.getElementById("op7").style.display='none';
    }
}
function emp2(){
    let opcion = document.getElementById("Formacion_CPTT2").value;
    if (opcion == 1){
        document.getElementById("op7-2").style.display='block';
    }else{
        document.getElementById("op7-2").style.display='none';
    }
}

document.getElementById("op5-1").style.display='block';
document.getElementById("op5-2").style.display='block';
function sel6(){
    let opcion = document.getElementById("Trabajador").value;
    if (opcion == 1){
        document.getElementById("nacionalidad").style.display='block';
        document.getElementById("cedula").style.display='block';
        document.getElementById("buscar_saime").style.display='block';
        document.getElementById("nombre1").style.display='block';
        document.getElementById("nombre2").style.display='block';
        document.getElementById("apellido1").style.display='block';
        document.getElementById("apellido2").style.display='block';
        document.getElementById("contacto").style.display='block';
        document.getElementById("sexo2").style.display='block';
        document.getElementById("estado").style.display='block';
        document.getElementById("municipio").style.display='block';
        document.getElementById("parroquia").style.display='block';
        document.getElementById("actividad_desempeño").style.display='block';
         document.getElementById("asa").style.display = "block"; 
        document.getElementById("motivo_visita").style.display='block';
        document.getElementById("regla").style.display='block';
        document.getElementById("motor25").style.display='block';
        document.getElementById("motor").style.display='block';
        document.getElementById("tabla_motivo").style.display='block';
        document.getElementById("boton_reportar").style.display='block';
        document.getElementById("guard_btn").style.display='block';
        document.getElementById("inv").style.display='block';
        document.getElementById("btn_regre").style.display='block';
        /* ----------------------------------------------------------------------- */
        document.getElementById("rif").style.display='none';
        document.getElementById("NIL").style.display='none';
        document.getElementById("estado2").style.display='none';
        document.getElementById("municipio2").style.display='none';
        document.getElementById("parroquia2").style.display='none';
        document.getElementById("actividad_desempeño2").style.display='none';
        document.getElementById("motivo_visita2").style.display='none';
        document.getElementById("nombre_razon_social").style.display='none';
        document.getElementById("denominacion_comercial").style.display='none';
        document.getElementById("tipo_capital").style.display='none';
        document.getElementById("direccion_fiscal").style.display='none';
        document.getElementById("boton_reportar2").style.display='none';
        document.getElementById("guard_btn2").style.display='none';
        document.getElementById("tabla_motivo2").style.display='none';

       
        document.getElementById("todo2").style.display='none';
        document.getElementById("guard_btn2").style.display = "none";
       
    }else if(opcion == 2){
        document.getElementById("nacionalidad").style.display='none';
        document.getElementById("cedula").style.display='none';
        document.getElementById("buscar_saime").style.display='none';
        document.getElementById("nombre1").style.display='none';
        document.getElementById("nombre2").style.display='none';
        document.getElementById("apellido1").style.display='none';
        document.getElementById("apellido2").style.display='none';
        document.getElementById("contacto").style.display='none';
        document.getElementById("sexo2").style.display='none';
        document.getElementById("actividad_desempeño").style.display='none';
        document.getElementById("motivo_visita").style.display='none';
        document.getElementById("parroquia").style.display='none';
        document.getElementById("municipio").style.display='none';
        document.getElementById("estado").style.display='none';
        document.getElementById("guard_btn").style.display='none';
        document.getElementById("inv").style.display='none';
        document.getElementById("btn_regre").style.display='none';
        document.getElementById("boton_reportar").style.display='none';
        document.getElementById("tabla_motivo").style.display='none';
        document.getElementById("todo").style.display='none';
       /*  document.getElementById("asa").style.display='none'; */


        document.getElementById("btn_regre").style.display='block';
        /* ----------------------------------------------------------------------- */
        document.getElementById("rif").style.display='block';
        document.getElementById("actividad_desempeño2").style.display='block';
        document.getElementById("NIL").style.display='block';
        document.getElementById("motivo_visita2").style.display='block';
        document.getElementById("regla").style.display='block';
        document.getElementById("estado2").style.display='block';
        document.getElementById("municipio2").style.display='block';
        document.getElementById("parroquia2").style.display='block';
        document.getElementById("motor").style.display='block';
        document.getElementById("nombre_razon_social").style.display='block';
        document.getElementById("denominacion_comercial").style.display='block';
        document.getElementById("tipo_capital").style.display='block';
        document.getElementById("direccion_fiscal").style.display='block';
        document.getElementById("tabla_motivo2").style.display='block';
        document.getElementById("guard_btn2").style.display='block';
        document.getElementById("boton_reportar2").style.display='block';
    }else if (opcion == -1){
        document.getElementById("btn_regre").style.display='block';
        document.getElementById("nacionalidad").style.display='none';
        document.getElementById("cedula").style.display='none';
        document.getElementById("buscar_saime").style.display='none';
        document.getElementById("nombre1").style.display='none';
        document.getElementById("nombre2").style.display='none';
        document.getElementById("apellido1").style.display='none';
        document.getElementById("apellido2").style.display='none';
        document.getElementById("sexo2").style.display='none';
        document.getElementById("parroquia2").style.display='none';
        document.getElementById("municipio2").style.display='none';
        document.getElementById("actividad_desempeño2").style.display='none';
        document.getElementById("estado2").style.display='none';
        document.getElementById("apellido").style.display='none';
        document.getElementById("contacto").style.display='none';
        document.getElementById("estado").style.display='none';
        document.getElementById("municipio").style.display='none';
        document.getElementById("parroquia").style.display='none';
        document.getElementById("actividad_desempeño").style.display='none';
        document.getElementById("rif").style.display='none';
        document.getElementById("regla").style.display='none';
        document.getElementById("motor").style.display='none';
        document.getElementById("NIL").style.display='none';
        document.getElementById("nombre_razon_social").style.display='none';
        document.getElementById("denominacion_comercial").style.display='none';
        document.getElementById("tipo_capital").style.display='none';
        document.getElementById("direccion_fiscal").style.display='none';
        document.getElementById("guard_btn").style.display='none';
        document.getElementById("guard_btn2").style.display='none';
        document.getElementById("tabla_motivo").style.display='none';
        document.getElementById("tabla_motivo2").style.display='none';
        document.getElementById("motivo_visita").style.display='none';
        document.getElementById("motivo_visita2").style.display='none';
        document.getElementById("boton_reportar").style.display='none';
        document.getElementById("boton_reportar2").style.display='none';
        document.getElementById("inv").style.display='none';
        document.getElementById("btn_regre").style.display='none';
    }
}
let otro = document.getElementById('otro');
let op5 = document.getElementById('op5');

otro.addEventListener('click', function() {
    if(otro.checked) {
        op5.style.display = 'block';
    } else {
        op5.style.display = 'none';
    }
});


function sel7(){
    let opcion = document.getElementById("tipo_trb").value;
    if (opcion == 1){ // Trabajador Independiente
        document.getElementById("bot_excel1").style.display='block';
        document.getElementById("user").style.display='block';
        document.getElementById("bot_excel2").style.display='none';
        document.getElementById("ent").style.display='none';
    } else
    if (opcion == 2){ // Entidad de Trabajo Excel
        document.getElementById("bot_excel1").style.display='none';
        document.getElementById("user").style.display='none';
        document.getElementById("bot_excel2").style.display='block';
        document.getElementById("ent").style.display='block';
    }else{
        document.getElementById("bot_excel1").style.display='none';
        document.getElementById("bot_excel2").style.display='none';
    }
}

function excel_ti(trab){
    let valor = 0;
    if(trab == "-1"){
        document.getElementById("trab").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("trab").style.borderColor = "";
    }
    if(valor > 0){
        alert("Debe llenar los Datos obligatorios (*) para continuar");
    }else{
        $.ajax
        ({
            url: 'ex_p1.php?trab='+trab,
            type: 'GET',
            success: function(resp) {
                /* alert(resp); */
                alert(v1);
                $(location).attr("href","excel_ti.php");
            }
        });
    }
}

function excel_et(ente){
    let valor = 0;
    if(ente == "-1"){
        document.getElementById("ente").style.borderColor = "red";
        valor++;
    }else{
        document.getElementById("ente").style.borderColor = "";
    }
    if(valor > 0){
        alert("Debe llenar los Datos obligatorios (*) para continuar");
    }else{
        $.ajax
        ({
            url: 'ex_p2.php?ente='+ente,
            type: 'GET',
            success: function(resp) {
                /* alert(resp); */
                alert(v1);
                $(location).attr("href","excel_et.php");
            }
        });
    }
}
$(document).ready(function(){
    llenar_estado();
    /*llenar_municipio();
    llenar_parroquia();*/
});
function llenar_estado(){
    url = window.location.origin;
    var data = {id:'1'};
    $.ajax({
        url: url+'/snilpd/mod_snilpd/controlador_estado.php',
        type: 'POST',
        data: data,
        success: function(resp) {
            /*var resultado=resp.split("|");
            console.log(resultado[0]+"="+resultado[1]);

            if(resultado[0] == 0){//NO EXISTE EL USUARIO

                $( "#div_header" ).removeClass("alert-success");//Se elimina primero la clase ya que luego se concatena y prevalece la ultima q se agrego
                $( "#div_header" ).addClass( "alert-danger" );
                $('#msj_respuesta').find('.modal-title').text("ALERTA!");
                $('#msj_respuesta').find('.modal-body').text(resultado[1]);
                $('#msj_respuesta').modal('show');//Aqui habilito el modal para que lo muestre

            }else{

                window.location.href = "../mod_snilpd/index.php";//mod_snilpd
            // setTimeout( function() { window.location.href = "https://professor-falken.com"; }, 5000 );

            }
            
            //$.fn.resp_ingresar(e);*/
            //alert(resp);
            $("#estado").html(resp);           
        }
    });
}
function llenar_municipio(cambio){
    url = window.location.origin;
    var data = {id:cambio};
    $.ajax({
        url: url+'/snilpd/mod_snilpd/controlador_municipio.php',
        type: 'POST',
        data: data,
        success: function(resp) {
            $("#municipio").html(resp);
        }
    });
}
function llenar_parroquia(cambio2){
    url = window.location.origin;
    var data = {id:cambio2};
    $.ajax({
        url: url+'/snilpd/mod_snilpd/controlador_parroquia.php',
        type: 'POST',
        data: data,
        success: function(resp) {
            $("#parroquia").html(resp);
        }
    });
}
function modificar(dato){
    url = window.location.origin;
    var data = {datos:dato};
    $.ajax({
        url: url+'/snilpd/mod_snilpd/modificar_datos.php',
        type: 'POST',
        data: data,
        success: function(resp) {
            $("#parroquia").html(resp);
        }
    });
}
$("#estado").on("change",function(){
    cambio = $("#estado").val();
    llenar_municipio(cambio);
});
$("#municipio").on("change",function(){
    cambio2 = $("#municipio").val();
    llenar_parroquia(cambio2);
});
$("#boton").on("click",function(){
    /*dato = $("#pais_nacimiento").val();
    dato += (" | ") + $("#estado_nacimiento").val();
    dato += (" | ") + $("#estado_civil").val();
    dato += (" | ") + $("#telefono_personal").val();
    dato += (" | ") + $("#otro_telefono_afiliado").val();
    dato += (" | ") + $("#correo").val();
    dato += (" | ") + $("#jefe_familia").val();
    dato += (" | ") + $("#hijos").val();
    dato += (" | ") + $("#menores").val();
    dato += (" | ") + $("#hijos_mayores").val();
    dato += (" | ") + $("#Vehiculo").val();
    dato += (" | ") + $("#codigo").val();
    dato += (" | ") + $("#serial").val();
    dato += (" | ") + $("#pais_recidencia").val();
    dato += (" | ") + $("#estado").val();
    dato += (" | ") + $("#municipio").val();
    dato += (" | ") + $("#parroquia").val();
    dato += (" | ") + $("#sector_afiliado").val();
    dato += (" | ") + $("#direccion_afiliado").val();
    alert(dato);*/
    var data_for = $('#formulario').serialize();//Se utiliza serialize en vez de serializeArray porque este permite organizar bien cada imagen como un arreglo independiente debido a la manera en que se creo la imagen en la vista. A diferencia de serializeArray que lo concatenaba todo y no permitia separarlo haciendo el include dentro del mismo arreglo

    $.fn.guardar(data_for);//Llama a la funcion Ingresar
});
$.fn.guardar = function(data_for){

    
    alert("Guardar");
	//var url		= url+'/login_Controlador';

    var data 	= data_for+'&action='+'continuar';
	$.ajax({
		url: url+'/snilpd/mod_snilpd/modificar_datos.php',
		type: 'POST',
		data: data,
		success: function(resp) {

            alert(resp);
            var resultado=resp.split("|");
            
            console.log(resultado[0]+"="+resultado[1]);


        if(resultado[0] == 0){//NO EXISTE EL USUARIO

            $( "#div_header" ).removeClass("alert-success");//Se elimina primero la clase ya que luego se concatena y prevalece la ultima q se agrego
		    $( "#div_header" ).addClass( "alert-danger" );
		    $('#msj_respuesta').find('.modal-title').text("ALERTA!");
		    $('#msj_respuesta').find('.modal-body').text(resultado[1]);
		    $('#msj_respuesta').modal('show');//Aqui habilito el modal para que lo muestre
        }else{

            $( "#div_header" ).removeClass("alert-success");//Se elimina primero la clase ya que luego se concatena y prevalece la ultima q se agrego
		    $( "#div_header" ).addClass( "alert-danger" );
		    $('#msj_respuesta').find('.modal-title').text("ALERTA!");
		    $('#msj_respuesta').find('.modal-body').text(resultado[1]);
		    $('#msj_respuesta').modal('show');//Aqui habilito el modal para que lo muestre
           // setTimeout( function() { window.location.href = "https://professor-falken.com"; }, 5000 );

        }
          
			//$.fn.resp_ingresar(resultado);
		}
	});
}
$(document).ready(function(){					   						   
	load();
});
//--------------------------------------------------------------------------------------------------------------------------
function load(){
	$.ajax({
		url:'ajax_admin_reinicio_usuario.php?proceso=1',
		 beforeSend: function(data){
	  },
		success:function(data){
			//$(".outer_div").html(data).fadeIn('slow');
			$(".outer_div").html(data).show();
				
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
function reiniciar(cedula){
	$.ajax({
		url:'ajax_admin_reinicio_usuario.php?cedula='+cedula+'&proceso=2',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			alert('REINICIO SATISFACTORIO');
			load();			
		}
	})	
}
//--------------------------------------------------------------------------------------------------------------------------
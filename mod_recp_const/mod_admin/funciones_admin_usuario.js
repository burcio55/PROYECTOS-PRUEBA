$(document).ready(function(){					   						   
	$('#botones').hide();//-----OCULTO-----
		$("#cbo_sistema").change(function () {
			//$(".outer_div").fadeOut("slow");
			$('#botones').hide();//-----OCULTO-----
			$(".outer_div").hide();//-----OCULTO-----
			document.getElementById("cbo_roles").value = '';
			   $("#cbo_sistema option:selected").each(function () {
				elegido=$(this).val();
				combo='Roles';
				if(elegido != ''){
					$.post("/minpptrassi/mod_rncpt/mod_admin/general_combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
						$("#cbo_roles").html(data);
					});
				}else{
					$('#cbo_roles').find('option').remove().end().append('<option value="">Seleccione</option>').val('');
				}          
		});
	})
});
//--------------------------------------------------------------------------------------------------------------------------
function load(){
	var cbo_sistema= $("#cbo_sistema").val();
	var cbo_roles= $("#cbo_roles").val();
	$("#loader").show();
	$(".limpiaforma").empty();
	if(cbo_roles != ''){
		$.ajax({
			url:'ajax_admin_usuario.php?cbo_sistema='+cbo_sistema+'&cbo_roles='+cbo_roles+'&proceso=1',
			 beforeSend: function(data){
				 
		  },
			success:function(data){
				//$(".outer_div").html(data).fadeIn('slow');
				$('#botones').show();//-----MUESTRO-----
				$(".outer_div").html(data).show();
				$("#loader").hide();		
			}
		})
	}else{
		$("#loader").hide();
		$('#botones').hide();//-----OCULTO-----
		$(".outer_div").hide();//-----OCULTO-----	
	}
}
//--------------------------------------------------------------------------------------------------------------------------
function procesaroption(cedula, rolopcion){
	var rol = $("#cbo_roles").val();
	var sistema = $("#cbo_sistema").val();
	var estado=$("#cbo_estado").val();
	//alert('#user'+cedula+' - '+rolopcion+' -'+rol);
	
	var marcado = $('#user'+cedula+':checked').val()?true:false;
		if (!marcado) { //alert('No checked');
			$.ajax({
				url:'ajax_admin_usuario.php?cedula='+cedula+'&rolopcion='+rolopcion+'&estado='+estado+'&rol='+rol+'&proceso=2',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					//load();			
				}
			})
        }else{ //alert('Si checked');
			$.ajax({
				url:'ajax_admin_usuario.php?cedula='+cedula+'&sistema='+sistema+'&estado='+estado+'&rol='+rol+'&proceso=3',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					//load();			
				}
			})
		}
		
}
//--------------------------------------------------------------------------------------------------------------------------
function checkedtodo(){
	var rol = $("#cbo_roles").val();
	var sistema = $("#cbo_sistema").val();
	
	//alert("checkedtodo");
	
	$.ajax({
		url:'ajax_admin_usuario.php?sistema='+sistema+'&rol='+rol+'&proceso=4',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			load();			
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
function nocheckedtodo(){
	var rol = $("#cbo_roles").val();
	var sistema = $("#cbo_sistema").val();
	
	//alert("nocheckedtodo");
	
	$.ajax({
		url:'ajax_admin_usuario.php?sistema='+sistema+'&rol='+rol+'&proceso=5',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			load();			
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------MUNICIPIO-PARROQUIA-CIUDAD---------------------------------------------
$(document).ready(function(){
   $("#cbo_entidad").change(function () {
           $("#cbo_entidad option:selected").each(function () {
            elegido=$(this).val();
            combo='Municipio';
            $.post("/minpptrassi/include/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
				$("#cbo_municipio").html(data);
			});            
		});
	})
});

$(document).ready(function(){
	$("#cbo_municipio").change(function () {
		$("#cbo_municipio option:selected").each(function () {
			elegido=$(this).val();
			combo='Parroquia';
			$.post("/minpptrassi/include/combo_hijo.php", { elegido: elegido, combo:combo }, function(data){
				$("#cbo_parroquia").html(data);
			});            
		});
	})
});

$(document).ready(function(){
	$("#cbo_parroquia").change(function () {
		$("#cbo_entidad option:selected").each(function () {
			elegido=$(this).val();
			combo='Ciudad';
			$.post("/minpptrassi/include/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
				$("#cbo_ciudad").html(data);
			});            
		});	
	});
});
//-------------------------------------------------------MUNICIPIO-PARROQUIA-CIUDAD---------------------------------------------


function estado_combo(){
    $("#cbo_entidad option:selected").each(function () {
            elegido=$(this).val();
            combo='Municipio';
            $.post("/minpptrassi/include/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_municipio").html(data);
						});            
        });					
}

function municipio_combo(){
$("#cbo_municipio option:selected").each(function () {
            elegido=$(this).val();
            combo='Parroquia';
            $.post("/minpptrassi/include/combo_hijo.php", { elegido: elegido, combo:combo }, function(data){
						$("#cbo_parroquia").html(data);
            });            
        });	
}

function cambiar_estatus(id){
	//alert("Hola");	
	
	if(confirm("ESTA SEGURO, REQUIERE CAMBIAR EL ESTATUS AL CASO?")){	
	var form=document.form;
		$.ajax({
			type: 'POST',
			url: 'ajax_cambiar_estatus.php',
	  	data:'id='+id,
			success: function(data) {				
				//alert(data);		
				alert("El Estatus del Caso Fue cambiado");
				form.submit();		
			}
	});
	}
}


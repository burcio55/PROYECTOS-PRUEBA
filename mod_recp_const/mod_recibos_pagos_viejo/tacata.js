//window.onload=(event)=>{alert(' ... Preparando la prueba ...');}
		
function estado_combo()
{
    //$("#cbo_entidad option:selected").each(function () {
    $("#cbo_estado option:selected").each(function () {
            elegido=$(this).val();
            combo='Municipio';
            $.post("/minpptrassi/include/combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_municipio").html(data);
						});            
        });					
}

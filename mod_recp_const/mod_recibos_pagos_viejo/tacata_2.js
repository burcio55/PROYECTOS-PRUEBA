window.onload=(event)=>{alert(' ... Preparando la prueba ...');}
$.post("/minpptrassi/include/opciones_estudio.php", { elegido: 'elegido', combo:'opciones_de_estudio'  }, function(data){
								alert(data);
								$("#cb_opciones_est").html(data);
						});            
		
/*
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
*/

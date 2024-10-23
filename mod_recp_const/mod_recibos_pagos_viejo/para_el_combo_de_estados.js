//window.onload=(event)=>{alert(' ... Preparando la prueba ...');}
function estado_combo()
{
     $("#cbo_estado option:selected").each(function () 
     {
	  elegido=$(this).val();
	  //combo se utiliza para decirle al php que metodo se va a utilizar segun el combo seleccionado
	  combo='Municipio';
	  $.post("/minpptrassi/include/combo_hijo.php"
		    ,{ elegido: elegido, combo:combo  }
		    ,function(data){$("#cbo_municipio").html(data);});            
     });					
}

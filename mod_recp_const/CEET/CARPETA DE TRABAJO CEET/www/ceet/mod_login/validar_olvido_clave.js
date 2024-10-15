//version 1.0
function validar_frm_contrasena(){
var valor=1 ;

		if($("#rif").val()==''){
		 document.getElementById("rif").style.borderColor= 'Red';
		 valor=0;
		}
		else{
		  document.getElementById("rif").style.borderColor= '';
			}
			
		if($("#usuario").val()==''){
		 document.getElementById("usuario").style.borderColor= 'Red';
		 valor=0;	
		}
		else{
		  document.getElementById("usuario").style.borderColor= '';
			}
			
		if($("#correo").val()==''){
		 document.getElementById("correo").style.borderColor= 'Red';
		 valor=0;	
		}
		else{
		  document.getElementById("correo").style.borderColor= '';
			}
			
		if($("#correo2").val()==''){
		 document.getElementById("correo2").style.borderColor= 'Red';
		 valor=0;	
		}
		else{
		  document.getElementById("correo2").style.borderColor= '';
			}
			

	    if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	    }else{
		 return true;
	    }	
}
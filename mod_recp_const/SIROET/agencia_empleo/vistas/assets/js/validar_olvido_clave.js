//version 1.0
function validar_frm_contrasena(){
var valor=1 ;

		if($("#cbCed_afiliado").val()==''){
		 document.getElementById("cbCed_afiliado").style.borderColor= 'Red';
		 valor=0;
		}
		else{
		  document.getElementById("cbCed_afiliado").style.borderColor= '';
			}
			
		if($("#ced_afiliado").val()==''){
		 document.getElementById("ced_afiliado").style.borderColor= 'Red';
		 valor=0;
		}
		else{
		  document.getElementById("ced_afiliado").style.borderColor= '';
			}

		if($("#email_afiliado").val()==''){
		 document.getElementById("email_afiliado").style.borderColor= 'Red';
		 valor=0;	
		}
		else{
		  document.getElementById("email_afiliado").style.borderColor= '';
			}

	    if(valor==0){
		alert("LOS CAMPOS EN ROJO SON REQUERIDOS");
		return false;
	    }else{
		 return true;
	    }	
}
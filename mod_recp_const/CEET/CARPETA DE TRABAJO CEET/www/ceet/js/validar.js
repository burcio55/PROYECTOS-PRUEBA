function validarBotonRadio() {
  var s = "no";
  with (document.formulario){
    for ( var i = 0; i < sexo.length; i++ ) {
      if ( sexo.checked ) {
      s= "si";
      window.alert("Ha seleccionado: \n" + sexo.value);
      break;
      }
    }
    if ( s == "no" ){
      window.alert("Debe seleccionar hombre o mujer" ) ;
    }
  }
}



function validaSelect(formInput,campo){  /*Valida ComboBox   */
    var resultado = true;
    var ofrmcampo = formInput;
    if(ofrmcampo.selectedIndex == 0 ){
        resultado = false;
    }
    if (!resultado ){
        alert('Por Favor seleccione una opcion para el campo ' + campo +'.');
        ofrmcampo.style.borderColor= 'Red';
        ofrmcampo.focus();
    }
    return resultado;
}

function campoRequerido(formInput,campo){ /*Valida text box  */
    var resultado = true;
    var ofrmcampo = formInput;
    if ((ofrmcampo.value == "") || (ofrmcampo.value.length == 0)){
        alert('Por favor introduzca un valor en ' + campo +'.');
        ofrmcampo.style.border= '1px #FF0000 solid';
        ofrmcampo.focus();
        resultado = false;
    }
    return resultado;
}

function acceptNum(evt){   /*Valida text box numero  */
    var nav4 = window.Event ? true : false;
    var key = nav4 ? evt.which : evt.keyCode;
    return (key <= 13 || (key >= 48 && key <= 57));
}

function validarletra(e){ /*Valida text box letra  */
    var key;
    var keychar;
    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    // control keys
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) || (key==32) )
        return true;  
    else if ((("abcdefghijklmnopqrstuvwxyz").indexOf(keychar) > -1))
        return true;
    else
        return false;
}
function validarChec(formInput){
var cantidad = document.getElementsByName('txt_asociacion').length  
           for(i=1;i<=cantidad;i++){
               if($('seleccion_'+i).checked==true){                           
                   return true;                            
               }                         
           }
           alert('Debe Seleccionar una Opcion');
           return false;
}
//$('nombre_boton').onclick='true';
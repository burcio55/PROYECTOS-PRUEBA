
function sel9(){
    let opcion = document.getElementById("rol_id").value;
    if (opcion == 89){
        document.getElementById("estado").style.display='none';
        document.getElementById("espacio").style.display='block';
        document.getElementById("btn_admin").style.display='block';
        document.getElementById("btn_register").style.display='none';
    }else {
        document.getElementById("estado").style.display='block';
        document.getElementById("espacio").style.display='none';
        document.getElementById("btn_admin").style.display='none';
        document.getElementById("btn_register").style.display='block';
    }
}
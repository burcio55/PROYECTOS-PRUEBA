// Obtener el valor del input
let input1 = $("#pswd").val();

// Escuchar el evento keyup
input1.addEventListener("keydown", function() {
    if (input1.isUpperCase()) {
        $("#mayusculas").css("color", "green");
    }
  
});
/* function contra1(){
    let input1 = $("#pswd").val();
    if (input1.isUpperCase()) {
        $("#mayusculas").css("color", "green");
    }
    $("#mayusculas").css("color", "green");
} */
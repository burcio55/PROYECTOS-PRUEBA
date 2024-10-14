$(document).ready(function(){
    $("#txt_codigo").on('paste', function(e){
        e.preventDefault();
    })
    
    $("#txt_codigo").on('copy', function(e){
        e.preventDefault();
    })
})
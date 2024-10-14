$('#archivo_img').on('click', function()
{
    archivo();
});

function archivo(snacionalidad) 
{

let url='subir_foto.php';
let data=
{
    'nacionalidad':$('#archivo_img').val(),
$.ajax
({
    url: url,
    type: 'POST',
    data:data,
    success: function(resp) {
        alert(resp);
    }
});
}
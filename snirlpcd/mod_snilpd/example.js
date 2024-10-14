//$('#btnEditar').on('click', function()
$(document).on('click','#btnEditar',function()
{
    //alert($(this).attr("data-id"));
    let id=$(this).attr("data-id");
    let url='example.php';
    data=
    {
        id:id
    }
    /*
    alert('ahi vamos');
    alert(data.id);
    */
    $.ajax
    ({
        url:url,
        type:'GET',
        data:data,
        success:function(dataResult)
        {
            alert(dataResult);
        },
        error:function()
        {
            alert('Error');
        }
    });
})

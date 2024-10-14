/* General */
function convertirAMayusculas() {
  
  var u_medida = document.getElementById("u_medida").value;
  u_medida = u_medida.toUpperCase();
  u_medida = u_medida.replace(/[0-9]/g, "");
  document.getElementById("u_medida").value = u_medida;

  var descripcion = document.getElementById("descripcion").value;
  descripcion = descripcion.toUpperCase();
  document.getElementById("descripcion").value = descripcion;
}

function soloNumeros(e) {
  // Permitir solo teclas numéricas, retroceso, tabulación y guion
  const permitidos = [42, 45, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 9, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];
  if (!permitidos.includes(e.keyCode)) {
    e.preventDefault();
  }
}

document.getElementById("cod_contable").addEventListener("keydown", soloNumeros);
document.getElementById("cod_catalogo").addEventListener("keydown", soloNumeros);
document.getElementById("cant_inicial").addEventListener("keydown", soloNumeros);

/* Medidas */
function accion_medida(u_medida)
{
  /* alert(u_medida) */
  let valor = 0;
  if(document.getElementById("u_medida").value == ''){
    document.getElementById("u_medida").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("u_medida").style.borderColor = '';
  }
  if(valor > 0){
      alert('Debe llenar los Campos Obligatorios *');
  }else{
    /* alert(u_medida) */
    $.ajax
    ({
      url: 'accion_medida.php?u_medida='+u_medida+'&accion='+1,
      type: 'GET',
      success: function(resp) {
        let v0 =  resp.split(" / ")[0];
        let v1 =  resp.split(" / ")[1];
        let v2 =  resp.split(" / ")[2];
        if(v0 == 1){
          alert(v1);
          $('#fe').html(v2);
        }else{
          alert(v1);
        }
      }
    });
  }
}

function accion_medida_mod(medida_id, u_medida) {

  /* alert(medida_id); */

  $("#medida_id").val(medida_id);
  $("#u_medida").val(u_medida);

  $('#medida_agr').css('display','none');
  $('#medida_act').css('display','block');
}

function accion_medida_act(medida_id, u_medida){

  /* alert(medida_id + ' ' + u_medida); */
  let valor = 0;
  if(document.getElementById("u_medida").value == ''){
    document.getElementById("u_medida").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("u_medida").style.borderColor = '';
  }
  if(valor > 0){
    alert('Debe llenar los Campos Obligatorios *');
  }else{
    $('#medida_agr').css('display','block');
    $('#medida_act').css('display','none');
    $.ajax
    ({
      url: 'accion_medida.php?medida_id='+medida_id+'&u_medida='+u_medida+'&accion='+2,
      type: 'GET',
      success: function(resp) {
        let v0 =  resp.split(" / ")[0];
        let v1 =  resp.split(" / ")[1];
        let v2 =  resp.split(" / ")[2];
        if(v0 == 1){
          alert(v1);
          $('#fe').html(v2);
        }else{
          alert(v1);
        }
      }
    });
  }
}

function accion_medida_del(medida_id)
{
  /* alert(medida_id); */
  $.ajax
  ({
    url: 'accion_medida.php?medida_id='+medida_id+'&accion='+3,
    type: 'GET',
    success: function(resp) {
      let v0 =  resp.split(" / ")[0];
      let v1 =  resp.split(" / ")[1];
      let v2 =  resp.split(" / ")[2];
      if(v0 == 1){
        alert(v1);
        $('#fe').html(v2);
      }else{
        alert(v1);
      }
    }
  });
}

/* Productos */
function accion_producto(cod_contable,cod_catalogo,descripcion,u_medida2,cant_inicial)
{
  /* alert(cod_contable + ' ' + cod_catalogo + ' ' + descripcion + ' ' + u_medida2 + ' ' + cant_inicial) */
  let valor = 0;
  if(document.getElementById("cod_contable").value == ''){
    document.getElementById("cod_contable").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("cod_contable").style.borderColor = '';
  }
  if(document.getElementById("cod_catalogo").value == ''){
    document.getElementById("cod_catalogo").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("cod_catalogo").style.borderColor = '';
  }
  if(document.getElementById("descripcion").value == ''){
    document.getElementById("descripcion").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("descripcion").style.borderColor = '';
  }
  if(document.getElementById("u_medida2").value == '-1'){
    document.getElementById("u_medida2").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("u_medida2").style.borderColor = '';
  }
  if(document.getElementById("cant_inicial").value == ''){
    document.getElementById("cant_inicial").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("cant_inicial").style.borderColor = '';
  }
  if(valor > 0){
      alert('Debe llenar los Campos Obligatorios *');
  }else{
    /* alert(cod_contable + ' ' + cod_catalogo + ' ' + descripcion + ' ' + u_medida2 + ' ' + cant_inicial) */
    $.ajax
    ({
      url: 'accion_producto.php?cod_contable='+cod_contable+'&cod_catalogo='+cod_catalogo+'&descripcion='+descripcion+'&u_medida2='+u_medida2+'&cant_inicial='+cant_inicial+'&accion='+1,
      type: 'GET',
      success: function(resp) {
        let v0 =  resp.split(" / ")[0];
        let v1 =  resp.split(" / ")[1];
        let v2 =  resp.split(" / ")[2];
        if(v0 == 1){
          alert(v1);
          $('#fe2').html(v2);
        }else{
          alert(v1);
        }
      }
    });
  }
}

function accion_producto_mod(producto_id, cod_contable,cod_catalogo,descripcion,u_medida2,cant_inicial) {

  $("#producto_id").val(producto_id);
  $("#cod_contable").val(cod_contable);
  $("#cod_catalogo").val(cod_catalogo);
  $("#descripcion").val(descripcion);
  $("#u_medida2").val(u_medida2);
  $("#cant_inicial").val(cant_inicial);

  $('#producto_agr').css('display','none');
  $('#producto_act').css('display','block');
}

function accion_producto_act(producto_id, cod_contable,cod_catalogo,descripcion,u_medida2,cant_inicial){  
  let valor = 0;
  if(document.getElementById("cod_contable").value == ''){
    document.getElementById("cod_contable").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("cod_contable").style.borderColor = '';
  }
  if(document.getElementById("cod_catalogo").value == ''){
    document.getElementById("cod_catalogo").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("cod_catalogo").style.borderColor = '';
  }
  if(document.getElementById("descripcion").value == ''){
    document.getElementById("descripcion").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("descripcion").style.borderColor = '';
  }
  if(document.getElementById("u_medida2").value == '-1'){
    document.getElementById("u_medida2").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("u_medida2").style.borderColor = '';
  }
  if(document.getElementById("cant_inicial").value == ''){
    document.getElementById("cant_inicial").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("cant_inicial").style.borderColor = '';
  }
  if(valor > 0){
    alert('Debe llenar los Campos Obligatorios *');
  }else{
    $('#producto_agr').css('display','block');
    $('#producto_act').css('display','none');
    $.ajax
    ({
      url: 'accion_producto.php?producto_id='+producto_id+'&cod_contable='+cod_contable+'&cod_catalogo='+cod_catalogo+'&descripcion='+descripcion+'&u_medida2='+u_medida2+'&cant_inicial='+cant_inicial+'&accion='+2,
      type: 'GET',
      success: function(resp) {
        let v0 =  resp.split(" / ")[0];
        let v1 =  resp.split(" / ")[1];
        let v2 =  resp.split(" / ")[2];
        if(v0 == 1){
          alert(v1);
          $('#fe2').html(v2);
        }else{
          alert(v1);
        }
      }
    });
  }
}

function accion_producto_del(producto_id)
{
  $.ajax
  ({
    url: 'accion_producto.php?producto_id='+producto_id+'&accion='+3,
    type: 'GET',
    success: function(resp) {
      let v0 =  resp.split(" / ")[0];
      let v1 =  resp.split(" / ")[1];
      let v2 =  resp.split(" / ")[2];
      if(v0 == 1){
        alert(v1);
        $('#fe2').html(v2);
      }else{
        alert(v1);
      }
    }
  });
}
/* Entradas */

function accion_seleccionar_entrada(id_producto, id_entradas, ncantidad_inicial, ncantidad_entrada, ncantidad_final) {

  $("#id_producto").val(id_producto);
  $("#id_entradas").val(id_entradas);
  $("#ncantidad_inicial").val(ncantidad_inicial);
  $("#ncantidad_entrada").val(ncantidad_entrada);
  $("#ncantidad_final").val(ncantidad_final);

  $('#entrada_tod').css('display','block');
}

function accion_aumentar_entrada(id_producto, id_entradas, ncantidad_inicial, ncantidad_entrada, ncantidad_final, entradas) {
  
  /* alert (id_producto + ' - ' + id_entradas + ' - ' + ncantidad_inicial + ' - ' + ncantidad_entrada + ' - ' + ncantidad_final + ' - ' + entradas); */

  let valor = 0;
  if(document.getElementById("entradas").value == ''){
    document.getElementById("entradas").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("entradas").style.borderColor = '';
  }if(valor > 0){
    alert('Debe llenar los Campos Obligatorios *');
  }else{
    $.ajax
    ({
      url: 'accion_entrada.php?id_producto='+id_producto+'&id_entradas='+id_entradas+'&ncantidad_inicial='+ncantidad_inicial+'&ncantidad_entrada='+ncantidad_entrada+'&ncantidad_final='+ncantidad_final+'&entradas='+entradas,
      type: 'GET',
      success: function(resp) {
        let v0 =  resp.split(" / ")[0];
        let v1 =  resp.split(" / ")[1];
        let v2 =  resp.split(" / ")[2];
        if(v0 == 1){
          alert(v1);
          $('#entrada_tod').css('display','none');
          $('#fe3').html(v2);
        }else{
          alert(v1);
        }
      }
    });
  }
}

/* Salidas */

function accion_seleccionar_salida(id_producto, id_salida, ncantidad_inicial, ncantidad_salida, ncantidad_final) {

  $("#id_producto2").val(id_producto);
  $("#id_salida2").val(id_salida);
  $("#ncantidad_inicial2").val(ncantidad_inicial);
  $("#ncantidad_salida2").val(ncantidad_salida);
  $("#ncantidad_final2").val(ncantidad_final);

  $('#salida_tod').css('display','block');
}

function accion_disminuir_salida(id_producto, id_salida, ncantidad_inicial, ncantidad_salida, ncantidad_final, salidas) {
  
  /* alert (id_producto + ' - ' + id_salida + ' - ' + ncantidad_inicial + ' - ' + ncantidad_salida + ' - ' + ncantidad_final + ' - ' + salidas); */

  let valor = 0;
  if(document.getElementById("salidas").value == ''){
    document.getElementById("salidas").style.borderColor = 'Red';
    valor++;
  }else{
    document.getElementById("salidas").style.borderColor = '';
  }if(valor > 0){
    alert('Debe llenar los Campos Obligatorios *');
  }else{
    $.ajax
    ({
      url: 'accion_salida.php?id_producto='+id_producto+'&id_salida='+id_salida+'&ncantidad_inicial='+ncantidad_inicial+'&ncantidad_salida='+ncantidad_salida+'&ncantidad_final='+ncantidad_final+'&salidas='+salidas,
      type: 'GET',
      success: function(resp) {
        let v0 =  resp.split(" / ")[0];
        let v1 =  resp.split(" / ")[1];
        let v2 =  resp.split(" / ")[2];
        if(v0 == 1){
          alert(v1);
          $('#salida_tod').css('display','none');
          $('#fe4').html(v2);
        }else{
          alert(v1);
        }
      }
    });
  }
}

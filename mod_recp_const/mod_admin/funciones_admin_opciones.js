$(document).ready(function(){
	$(".limpiaforma").empty();
	$('#agregar').show();//-----MUESTRO-----
	$('#editar').hide();//-----OCULTO-----
	$('#combomenu').hide();//-----OCULTO-----
	$('#descripcion').hide();//-----OCULTO-----
	$('#urlopcion').hide();//-----OCULTO-----
	$('#combonivel').hide();//-----OCULTO-----
	$('#comboorden').hide();//-----OCULTO-----
	
	$("#tipooption option:selected").each(function () {
		elegido=$("#opcion").val();
		combo='Opciones';
		$.post("general_combo_hijo.php", { elegido: elegido, combo:combo }, function(data){
			$("#cbo_menu").html(data);
		});           
	});

   $("#tipooption").change(function () {
		$(".outer_div").fadeOut("slow");							  
           $("#tipooption option:selected").each(function () {
            elegido=$("#opcion").val();
            combo='Opciones';
			resetelegido=$(this).val();
			$.post("general_combo_hijo.php", { elegido: elegido, combo:combo }, function(data){
				$("#cbo_menu").html(data);
			});
			if(resetelegido == ''){
				$('#agregar').show();//-----MUESTRO-----
				$('#editar').hide();//-----OCULTO-----
				$('#combomenu').hide();//-----OCULTO-----
				$('#descripcion').hide();//-----OCULTO-----
				$('#urlopcion').hide();//-----OCULTO-----
				$('#combonivel').hide();//-----OCULTO-----
				$('#comboorden').hide();//-----OCULTO-----	
				document.getElementById("id_opcion_menu").value = "";
				document.getElementById("descripcion_opcion").value = "";
				document.getElementById("url").value = "";
				document.getElementById("tipooption").value = "";
				document.getElementById("cbo_menu").value = "";
				document.getElementById("nivel").value = 0;
				document.getElementById("Orden").value = 1;				
			}
        });
   })
   
   load();
});
//--------------------------------------------------------------------------------------------------------------------------
function load(){
	$(".limpiaforma").empty();
	var modulo= $("#modulo").val();	
	$.ajax({
		url:'ajax_admin_opciones.php?modulo='+modulo+'&proceso=1',
		dataType:'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			
//INICIO---Elaborado por <a href="https://rafagomez.neocities.org">Rafa Gómez---			
  datostabla = JSON.stringify(data); //alert(datostabla.toString());
  let MenuTabla = JSON.parse(datostabla);
  
  if(MenuTabla == null){

		function formDatos(nbTabla) {
			function creaTitulos() {
               function creaTitulo(ancho,titulo) {
                   let th = document.createElement("TH");
                   let div = document.createElement("DIV");
                   
                   th.width = ancho +"%";
                   th.align = "left";
                   th.className = "sub_titulo";
                   
                   div.align = "center";
                   div.appendChild(document.createTextNode(titulo));
                   
                   th.appendChild(div);
                   return th;
               }

               let tr = document.createElement("TR");
               [[25, "OPCIONES"], [40,"URL"], [5,"ACCESO"], [30,"ACCIONES"]].forEach(x => {tr.appendChild(creaTitulo(x[0],x[1]))});
               thead.appendChild(tr);
           }
            
            let div = document.createElement("DIV");
            let tabla = document.createElement("TABLE");
            
            tabla.className = "display";
            tabla.baorder = "0";
            tabla.align = "center";
            tabla.id = nbTabla;
            tabla.width = "100%";
            
            let thead = document.createElement("THEAD");
            creaTitulos();

            let tBody = document.createElement("TBODY");

            tabla.appendChild(thead);
            tabla.appendChild(tBody);
            div.appendChild(tabla);
            
            return tabla;
		}

            document.getElementById("forma").appendChild(formDatos("tblDetalle"));
	
			$('#tblDetalle').dataTable({
				"sPaginationType": "full_numbers",
				"ordering": false
			});
			$('#tblDetalle').css('width','100%');

  }else{
        
        function formDatos(menu, nbTabla) {
            
            function creaTitulos() {
               function creaTitulo(ancho,titulo) {
                   let th = document.createElement("TH");
                   let div = document.createElement("DIV");
                   
                   th.width = ancho +"%";
                   th.align = "left";
                   th.className = "sub_titulo";
                   
                   div.align = "center";
                   div.appendChild(document.createTextNode(titulo));
                   
                   th.appendChild(div);
                   return th;
               }

               let tr = document.createElement("TR");
               [[25, "OPCIONES"], [40,"URL"], [5,"ACCESO"], [30,"ACCIONES"]].forEach(x => {tr.appendChild(creaTitulo(x[0],x[1]))});
               thead.appendChild(tr);
           }
            
            let div = document.createElement("DIV");
            let tabla = document.createElement("TABLE");
            
            tabla.className = "display";
            tabla.baorder = "0";
            tabla.align = "center";
            tabla.id = nbTabla;
            tabla.width = "100%";
            
            let thead = document.createElement("THEAD");
            creaTitulos();

            let tBody = document.createElement("TBODY");
			
            menu.forEach(x => {
				if(x.nivelpinta == 0 && x.url == '#'){
				    style = "background-color: 	#669999;";
				}else{
				    if(x.nivelpinta == 1 && x.url == '#'){ 
				        style = "background-color: 	#669988";
				    }else{
				        if(x.nivelpinta == 2 && x.url == '#'){
				           style = "background-color: #669977;";
				        }else{
				            if(x.nivelpinta == 3 && x.url == '#'){
								style = "background-color: #669966;";
				            }else{
								style = "";
				            }
				        }
				    }
				}
            
                let tr = document.createElement("TR");
                tr.style = style;
				niveles = parseInt(x.nivelpinta)+parseInt(1);
				tr.innerHTML = '<td width="25%" class="texto-normal" align="left">' + niveles +" - "+ x.orden + " - " + x.opciones +"</td>" +
						'<td width="40%" class="texto-normal" align="left">' + x.url +"</td>" +
						'<td width="5%" class="texto-normal" align="center"><input id="opt' +x.id +'" name="opt' +x.id +'" type="checkbox" value="' +x.id +'" ' + x.checkbox +' onclick="javascript:procesaroption(' +x.id +')"/></td>' +
						'<td width="30%" class="texto-normal" align="center">'
                +'<button type="button" class="button_personal btn_editar" onclick="javascript:editar(' + x.id +', ' + x.modulo_id +')" title="Haga Click para Editar">Editar</button>'
                +'<button type="button" class="button_personal btn_eliminar" onclick="javascript:eliminar(' +x.id +')" title="Haga Click para Eliminar">Eliminar</button></td>';
                
                tBody.appendChild(tr);
            });
                                 
            tabla.appendChild(thead);
            tabla.appendChild(tBody);
            div.appendChild(tabla);
            
            return tabla;
        }

            document.getElementById("forma").appendChild(formDatos(ordenaMenu(MenuTabla),"tblDetalle"));
	
			$('#tblDetalle').dataTable({
				"sPaginationType": "full_numbers",
				"ordering": false
			});
			$('#tblDetalle').css('width','100%');
   }
//FIN---Elaborado por <a href="https://rafagomez.neocities.org">Rafa Gómez---
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
function menutipo(){
	
	var opcion = $("#opcion").val();
	var tipooption= $("#tipooption").val();
	
	//document.getElementById("id_opcion_menu").value = "";
	document.getElementById("descripcion_opcion").value = "";
	document.getElementById("url").value = "";
	document.getElementById("cbo_menu").value = "";
	document.getElementById("nivel").value = 0;
	document.getElementById("Orden").value = 1;

	$.ajax({
		url:'ajax_admin_opciones.php?opcion='+opcion+'&proceso=2',
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){ // Si tiene MENU - #

				if(tipooption == 1){ //--- MENU - #
					$('#combomenu').hide();//-----OCULTO-----
					$('#descripcion').show();//-----MUESTRO-----
					$('#urlopcion').hide();//-----OCULTO-----
					$('#combonivel').show();//-----MUESTRO-----
					$('#comboorden').show();//-----MUESTRO-----

					document.getElementById("nivel").value = 0;
					$('#nivel').attr('disabled',true);

				}
				
				if(tipooption == 2){ //--- SUB MENU - #
					$('#combomenu').show();//-----MUESTRO-----
					$('#descripcion').show();//-----MUESTRO-----
					$('#urlopcion').hide();//-----OCULTO-----
					$('#combonivel').show();//-----MUESTRO-----
					$('#comboorden').show();//-----MUESTRO-----

				}
				
				if(tipooption == 3){ //--- OPCION
					$('#combomenu').show();//-----MUESTRO-----
					$('#descripcion').show();//-----MUESTRO-----
					$('#urlopcion').show();//-----MUESTRO-----
					$('#combonivel').show();//-----MUESTRO-----
					$('#comboorden').show();//-----MUESTRO-----

				}

			}else{ // Si no tiene ningun MENU - #
				if(tipooption == 2){
					alert(data.mensaje);
				}
				$('#combomenu').hide();//-----OCULTO-----
				$('#descripcion').show();//-----MUESTRO-----
				$('#urlopcion').hide();//-----OCULTO-----
				$('#combonivel').show();//-----MUESTRO-----
				$('#comboorden').show();//-----MUESTRO-----
				document.getElementById("tipooption").value = 1;
				document.getElementById("nivel").value = 0;
				document.getElementById("nivel").disabled = true;
				
			}
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
function menuoptionivel(){
	
	var opcion = $("#cbo_menu").val();
	//alert(opcion);
	$.ajax({
		url:'ajax_admin_opciones.php?opcion='+opcion+'&proceso=6',
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){ // Si tiene MENU - #
			
				document.getElementById("nivel").value = data.nnivel;
				$('#nivel').attr('disabled',true);

			}
		}
	})
		
}
//--------------------------------------------------------------------------------------------------------------------------
function limpiar(){
	$('#agregar').show();//-----MUESTRO-----
	$('#editar').hide();//-----OCULTO-----
	$('#combomenu').hide();//-----OCULTO-----
	$('#descripcion').hide();//-----OCULTO-----
	$('#urlopcion').hide();//-----OCULTO-----
	$('#combonivel').hide();//-----OCULTO-----
	$('#comboorden').hide();//-----OCULTO-----		
	document.getElementById("opciones").reset();	
}
//--------------------------------------------------------------------------------------------------------------------------
function regresar(){
	location.href ='admin_modulos.php';
}
//--------------------------------------------------------------------------------------------------------------------------
function editar(id){
	$('#agregar').hide();//-----OCULTO-----
	$('#editar').show();//-----MUESTRO-----
	$('#combonivel').show();//-----MUESTRO-----
	$('#comboorden').show();//-----MUESTRO-----
	//document.getElementById("opciones").reset();
	
//		$(".outer_div").fadeOut("slow");							  
//           $("#tipooption option:selected").each(function () {
//            elegido=$("#opcion").val();
//            combo='Opciones';
//			$.post("general_combo_hijo.php", { elegido: elegido, combo:combo }, function(data){
//				$("#cbo_menu").html(data);
//			});           
//        });
	
	
	$.ajax({
		url:'ajax_admin_opciones.php?id='+id+'&proceso=5',
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			
			if(data.nnivel == 0){  //--- MENU - #
			document.getElementById("id_opcion_menu").value = data.id;
			document.getElementById("descripcion_opcion").value = data.sdescripcion;  
			$('#combomenu').hide();//-----OCULTO-----
			$('#descripcion').show();//-----MUESTRO-----
			$('#urlopcion').hide();//-----OCULTO-----
			document.getElementById("tipooption").value = 1; 
			//document.getElementById("cbo_menu").value = data.nsalida;
			document.getElementById("nivel").value = data.nnivel;
			document.getElementById("Orden").value = data.norden_salida;
			$('#nivel').attr('disabled',true);
			//salert('ENTRO EN MENU');

			}else{
				if((data.nnivel == 1 && data.surl == '#')||(data.nnivel == 2 && data.surl == '#')||(data.nnivel == 3 && data.surl == '#')){ //--- SUB MENU - #
					document.getElementById("id_opcion_menu").value = data.id;
					document.getElementById("descripcion_opcion").value = data.sdescripcion;
					document.getElementById("url").value = data.surl;
					$('#combomenu').show();//-----MUESTRO-----
					$('#descripcion').show();//-----MUESTRO-----
					$('#urlopcion').hide();//-----OCULTO-----
					document.getElementById("tipooption").value = 2;
					document.getElementById("cbo_menu").value = data.nsalida;
					document.getElementById("nivel").value = data.nnivelmuestra;
					document.getElementById("Orden").value = data.norden_salida;
					$('#nivel').attr('disabled',true);
					//alert('ENTRO EN SUB MENU');
					
				}else{ //--- OPCION
					document.getElementById("id_opcion_menu").value = data.id;
					document.getElementById("descripcion_opcion").value = data.sdescripcion;
					document.getElementById("url").value = data.surl;	
					$('#combomenu').show();//-----OCULTO-----
					$('#descripcion').show();//-----MUESTRO-----
					$('#urlopcion').show();//-----MUESTRO-----
					document.getElementById("tipooption").value = 3;
					document.getElementById("cbo_menu").value = data.nsalida;
					document.getElementById("nivel").value = data.nnivelmuestra;
					document.getElementById("Orden").value = data.norden_salida;
					$('#nivel').attr('disabled',true);
					//alert('ENTRO EN OPCIONES');
					
				}
			}
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
function procesaroption(opt){

	$('#agregar').show();//-----MUESTRO-----
	$('#editar').hide();//-----OCULTO-----
	$('#combomenu').hide();//-----OCULTO-----
	$('#descripcion').hide();//-----OCULTO-----
	$('#urlopcion').hide();//-----OCULTO-----
	$('#combonivel').hide();//-----OCULTO-----
	$('#comboorden').hide();//-----OCULTO-----
	
	document.getElementById("id_opcion_menu").value = "";
	document.getElementById("descripcion_opcion").value = "";
	document.getElementById("url").value = "";
	document.getElementById("tipooption").value = "";
	document.getElementById("cbo_menu").value = "";
	document.getElementById("nivel").value = 0;
	document.getElementById("Orden").value = 1;

	var marcado = $('#opt'+opt+':checked').val()?true:false;
		if (!marcado) { //alert('No checked');
			$.ajax({
				url:'ajax_admin_opciones.php?opt='+opt+'&proceso=3',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					load();
				}
			})
        }else{ //alert('Si checked');
			$.ajax({
				url:'ajax_admin_opciones.php?opt='+opt+'&proceso=4',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					load();
				}
			})
		}
}
//--------------------------------------------------------------------------------------------------------------------------
function actualizar(){
		
	var msg = '';
	
	if ($('#tipooption').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("tipooption").style.border = "1px solid red";
	}else{
		document.getElementById("tipooption").style.border = "";
		if($('#tipooption').val().trim() != 1){
			if ($('#cbo_menu').val().trim() == ''){
				msg=msg+'-Bad';
				document.getElementById("cbo_menu").style.border = "1px solid red";
			}else{
				document.getElementById("cbo_menu").style.border = "";
			}
			if ($('#url').val().trim() == ''){
				msg=msg+'-Bad';
				document.getElementById("url").style.border = "1px solid red";
			}else{
				document.getElementById("url").style.border = "";
			}
		}else{
			
		}
	}
	if ($('#Orden').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("Orden").style.border = "1px solid red";
	}else{
		document.getElementById("Orden").style.border = "";
	}
	if ($('#descripcion_opcion').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("descripcion_opcion").style.border = "1px solid red";
	}else{
		document.getElementById("descripcion_opcion").style.border = "";
	}
	
	if (msg != '') { 
		alert ('DEBE SELECCIONAR LOS CAMPOS REQUERIDOS');
		msg = '';
		return false;
	}else{ 	
		var id_opcion_menu= $("#id_opcion_menu").val();
		var tipooption= $("#tipooption").val();
		var cbo_menu= $("#cbo_menu").val();
		var nivel= $("#nivel").val();
		var Orden= $("#Orden").val();
		var descripcion_opcion= $("#descripcion_opcion").val();
		var url= $("#url").val();
		
		if(tipooption == 1 || tipooption == 2){
			$.ajax({
				 url:'ajax_admin_opciones.php?id_opcion_menu='+id_opcion_menu+'&tipooption='+tipooption+'&cbo_menu='+cbo_menu+'&nivel='+nivel+'&Orden='+Orden+'&descripcion_opcion='+descripcion_opcion+'&proceso=7',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					document.getElementById("opciones").reset();
					//alert('LISTO SIN URL');
					$('#agregar').show();//-----MUESTRO-----
					$('#editar').hide();//-----OCULTO-----
					$('#combomenu').hide();//-----OCULTO-----
					$('#descripcion').hide();//-----OCULTO-----
					$('#urlopcion').hide();//-----OCULTO-----
					$('#combonivel').hide();//-----OCULTO-----
					$('#comboorden').hide();//-----OCULTO-----
					$('#nivel').attr('disabled',false);
					load();
				}
			})
		}else{
			$.ajax({
				 url:'ajax_admin_opciones.php?id_opcion_menu='+id_opcion_menu+'&tipooption='+tipooption+'&cbo_menu='+cbo_menu+'&nivel='+nivel+'&Orden='+Orden+'&descripcion_opcion='+descripcion_opcion+'&url='+url+'&proceso=8',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					document.getElementById("opciones").reset();
					//alert('LISTO CON URL');
					$('#agregar').show();//-----MUESTRO-----
					$('#editar').hide();//-----OCULTO-----
					$('#combomenu').hide();//-----OCULTO-----
					$('#descripcion').hide();//-----OCULTO-----
					$('#urlopcion').hide();//-----OCULTO-----
					$('#combonivel').hide();//-----OCULTO-----
					$('#comboorden').hide();//-----OCULTO-----
					$('#nivel').attr('disabled',false);
					load();
				}
			})
		}
	}
}
//--------------------------------------------------------------------------------------------------------------------------
function agregar(){
	
	var msg = '';
	
	if ($('#tipooption').val().trim() == ''){ 
		msg=msg+'-Bad';
		document.getElementById("tipooption").style.border = "1px solid red";
	}else{
		document.getElementById("tipooption").style.border = "";
		if($('#tipooption').val().trim() == 3){
			if ($('#cbo_menu').val().trim() == ''){
				msg=msg+'-Bad';
				document.getElementById("cbo_menu").style.border = "1px solid red";
			}else{
				document.getElementById("cbo_menu").style.border = "";
			}
			if ($('#url').val().trim() == ''){
				msg=msg+'-Bad';
				document.getElementById("url").style.border = "1px solid red";
			}else{
				document.getElementById("url").style.border = "";
			}
		}else{
			
		}
	}
	if ($('#Orden').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("Orden").style.border = "1px solid red";
	}else{
		document.getElementById("Orden").style.border = "";
	}
	if ($('#descripcion_opcion').val().trim() == ''){
		msg=msg+'-Bad';
		document.getElementById("descripcion_opcion").style.border = "1px solid red";
	}else{
		document.getElementById("descripcion_opcion").style.border = "";
	}
	
	if (msg != '') { 
		alert ('DEBE SELECCIONAR LOS CAMPOS REQUERIDOS');
		msg = '';
		return false;
	}else{ 		
		var opcion= $("#opcion").val();
		var tipooption= $("#tipooption").val();
		var cbo_menu= $("#cbo_menu").val();
		var nivel= $("#nivel").val();
		var Orden= $("#Orden").val();
		var descripcion_opcion= $("#descripcion_opcion").val();
		var url= $("#url").val();
		
		if(tipooption == 1 || tipooption == 2){
			$.ajax({
				 url:'ajax_admin_opciones.php?opcion='+opcion+'&tipooption='+tipooption+'&cbo_menu='+cbo_menu+'&nivel='+nivel+'&Orden='+Orden+'&descripcion_opcion='+descripcion_opcion+'&proceso=9',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					document.getElementById("opciones").reset();
					//alert('LISTO SIN URL');
					$('#agregar').show();//-----MUESTRO-----
					$('#editar').hide();//-----OCULTO-----
					$('#combomenu').hide();//-----OCULTO-----
					$('#descripcion').hide();//-----OCULTO-----
					$('#urlopcion').hide();//-----OCULTO-----
					$('#combonivel').hide();//-----OCULTO-----
					$('#comboorden').hide();//-----OCULTO-----
					$('#nivel').attr('disabled',false);
					load();
				}
			})
		}else{
			$.ajax({
				 url:'ajax_admin_opciones.php?opcion='+opcion+'&tipooption='+tipooption+'&cbo_menu='+cbo_menu+'&nivel='+nivel+'&Orden='+Orden+'&descripcion_opcion='+descripcion_opcion+'&url='+url+'&proceso=10',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					document.getElementById("opciones").reset();
					//alert('LISTO CON URL');
						$('#agregar').show();//-----MUESTRO-----
						$('#editar').hide();//-----OCULTO-----
						$('#combomenu').hide();//-----OCULTO-----
						$('#descripcion').hide();//-----OCULTO-----
						$('#urlopcion').hide();//-----OCULTO-----
						$('#combonivel').hide();//-----OCULTO-----
						$('#comboorden').hide();//-----OCULTO-----
					$('#nivel').attr('disabled',false);
					load();
				}
			})
		}
	}
}
//--------------------------------------------------------------------------------------------------------------------------
function eliminar(id){

	$.ajax({
		url:'ajax_admin_opciones.php?id='+id+'&proceso=11',
		dataType: 'json',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			if(data.response == 'success'){
				$('#agregar').show();//-----MUESTRO-----
				$('#editar').hide();//-----OCULTO-----
				$('#combomenu').hide();//-----OCULTO-----
				$('#descripcion').hide();//-----OCULTO-----
				$('#urlopcion').hide();//-----OCULTO-----
				$('#combonivel').hide();//-----OCULTO-----
				$('#comboorden').hide();//-----OCULTO-----
				load();			
			}else{
				alert(data.mensaje);
			}

		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
//INICIO---Elaborado por <a href="https://rafagomez.neocities.org">Rafa Gómez---	
function codigo(MenuTabla,padreId,Id,nivel,orden) {
    return (padreId === "0" ? "" : codigoPadre(MenuTabla,padreId)) + orden +Id;
}

function codigoPadre(MenuTabla,Id) {
    let x = MenuTabla.find((x) => x.id === Id);
    return codigo(MenuTabla,x.salida,Id,x.nivel,x.orden);
}

function ordenaMenu(MenuTabla) {
    MenuTabla.map((x) => {
        x.codigo = codigo(MenuTabla,x.salida,x.id,x.nivel,x.orden);
    });
    return MenuTabla.sort((a,b) => (a.codigo < b.codigo) ? -1 : (a.codigo > b.codigo) ? 1 : 0);
}
//FIN---Elaborado por <a href="https://rafagomez.neocities.org">Rafa Gómez---
//--------------------------------------------------------------------------------------------------------------------------
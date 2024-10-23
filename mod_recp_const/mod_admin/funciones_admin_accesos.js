$(document).ready(function(){	
   $('#botones').hide();//-----OCULTO-----
   $("#cbo_sistema").change(function () {
		$(".limpiaforma").empty();
		$('#botones').hide();//-----OCULTO-----
           $("#cbo_sistema option:selected").each(function () {
            elegido=$(this).val();
            combo='Roles';
            $.post("general_combo_hijo.php", { elegido: elegido, combo:combo  }, function(data){
								$("#cbo_roles").html(data);
						});            
        });
   })
});
//--------------------------------------------------------------------------------------------------------------------------
function load(){
	var cbo_sistema= $("#cbo_sistema").val();
	var cbo_roles= $("#cbo_roles").val();
	$(".limpiaforma").empty();
	$.ajax({
		url:'ajax_admin_accesos.php?cbo_sistema='+cbo_sistema+'&cbo_roles='+cbo_roles+'&proceso=1',
		dataType:'json',
		 beforeSend: function(data){
	  },
		success:function(data){
		$('#botones').show();//-----MUESTRO-----
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
               [[40, "OPCIONES"], [60,"URL"], [10,"ACCESO"]].forEach(x => {tr.appendChild(creaTitulo(x[0],x[1]))});
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
               [[40, "OPCIONES"], [60,"URL"], [10,"ACCESO"]].forEach(x => {tr.appendChild(creaTitulo(x[0],x[1]))});
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
				if(x.nivel == 0 && x.url == '#'){
				    style = "background-color: 	#669999;";
				}else{
				    if(x.nivel == 1 && x.url == '#'){
				        style = "background-color: 	#669988";
				    }else{
				        if(x.nivel == 2 && x.url == '#'){
				           style = "background-color: #669977;";
				        }else{
				            if(x.nivel == 3 && x.url == '#'){
								style = "background-color: #669966;";
				            }else{
								if(x.nivel == 0 && x.url != '#'){
								style = "background-color: #996666;";
								}else{
									style = "";
								}
				            }
				        }
				    }
				}
            
                let tr = document.createElement("TR");
                tr.style = style;				
				niveles = parseInt(x.nivel)+parseInt(1);
				tr.innerHTML ='<td width="40%" class="texto-normal" align="left">' + niveles +" - "+ x.orden + " - " + x.opciones +'</td>'+
						'<td width="60%" class="texto-normal" align="left">'+ x.url +'</td>'+
						'<td width="10%" class="texto-normal" align="center"><input id="rol'+x.id+'" name="rol'+x.id+'" type="checkbox" value="rol'+x.id+'" ' + x.checkbox +' onclick="javascript:procesaroption('+x.id+', '+x.id_opcion+')"/></td>';
                
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
function procesaroption(opcion, rolopcion){
	var rol = $("#cbo_roles").val();
	
	//alert('#rol'+opcion);
	
	var marcado = $('#rol'+opcion+':checked').val()?true:false;
		if (!marcado) { //alert('No checked');
			$.ajax({
				url:'ajax_admin_accesos.php?opcion='+opcion+'&rolopcion='+rolopcion+'&rol='+rol+'&proceso=2',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					//load();			
				}
			})
        }else{ //alert('Si checked');
			$.ajax({
				url:'ajax_admin_accesos.php?opcion='+opcion+'&rolopcion='+rolopcion+'&rol='+rol+'&proceso=3',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					//load();			
				}
			})
		}
		
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
function checkedtodo(){
	var rol = $("#cbo_roles").val();
	var sistema = $("#cbo_sistema").val();
	
	//alert("checkedtodo");
	
	$.ajax({
		url:'ajax_admin_accesos.php?sistema='+sistema+'&rol='+rol+'&proceso=4',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			load();			
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
function nocheckedtodo(){
	var rol = $("#cbo_roles").val();
	var sistema = $("#cbo_sistema").val();
	
	//alert("nocheckedtodo");
	
	$.ajax({
		url:'ajax_admin_accesos.php?sistema='+sistema+'&rol='+rol+'&proceso=5',
		 beforeSend: function(objeto){
	  },
		success:function(data){
			load();			
		}
	})
}
//--------------------------------------------------------------------------------------------------------------------------
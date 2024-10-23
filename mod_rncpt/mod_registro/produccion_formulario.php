<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
session_start();
//-------------------------------------------------------------
include('../include/header.php');
include("../LoadCombos.php");
$conn= getConnDB($db1);
$conn->debug = false;
//-------------------------------------------------------------



$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

include("../evita_injection.php");
//include("../verificar_session_url_inicio_registro.php");
//include("verificar_correo.php");
/*
session_start();
if(!isset($_SESSION)){
header("location:rnet_login.php");
} else {
session_unset();
session_destroy();
//header("location:rnet_login.php");
}
*/

doAction($conn);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();

debug();


function debug(){
	 if($settings['debug']=false){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function trace($msg){//para hacer traza y no estar escribiendo echo o print cada vez
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}

function doAction($conn){

	if (isset($_POST['action'])){
		switch($_POST['action']){
		   
			
			case 'guardar': 
			$bValidateSuccess=true;	
					
		if ($_POST['cbo_motor']==""){
				$GLOBALS['aPageErrors'][]= "- El motor: es requerido.";
				$bValidateSuccess=false;
		 }
		 
		if ($_POST['cbo_sector']==""){
				$GLOBALS['aPageErrors'][]= "- EL Sector: es requerido.";
				$bValidateSuccess=false;
		 }	 
		if ($_POST['cbo_sector']=="60"){
				$GLOBALS['aPageErrors'][]= "- No Registra Sector: Debe Comunicarse con el Administrador del Sistema";
				$bValidateSuccess=false;
		 }	
		 if ($_POST['cbo_actividadEco']==""){
				$GLOBALS['aPageErrors'][]= "- La Actividad Economica: es requerido.";
				$bValidateSuccess=false;
		 }	  
					  				
			if ($bValidateSuccess){				
				ProcessForm($conn);
			}			
			LoadData($conn,false);	
			break;
			
			
			case 'modificar': 
				if($_POST['accion']=='1'){
					LoadData($conn,false);
				}
			break;
			
			case 'eliminar': 
				if($_POST['accion']=='2'){
					LoadData($conn,false);
				}
			break;
			case 'reset': 
					unset($_POST['id_po']);
					unset($_POST['idmotor']);
					unset($_POST['accion']);
					LoadData($conn,false);
			break;
			case 'recargar_producto': 
				//if($_POST['accion']=='2'){
				LoadData($conn,true);
				//}
			break;
	        }
		}		
		else{
		LoadData($conn,false);
		}
}
 
 
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
		//datos personales
		$aDefaultForm['cbo_motor']='';
		$aDefaultForm['cbo_sector']='';
		$aDefaultForm['cbo_actividadEco']='';
		$aDefaultForm['cbo_producto']='';
		$aDefaultForm['cbo_medida']='';
		$aDefaultForm['nueva_medida']='';
		$aDefaultForm['nuevo_producto']='';
		$aDefaultForm['valor']='';
		$aDefaultForm['valorproducto']='';
		$aDefaultForm['produccion_anual']='';
		$aDefaultForm['produccion_mensual']='';		
		$aDefaultForm['capacidad_produccion_anual']='';
		$aDefaultForm['comentario']='';		
		$aDefaultForm['opt_tiporeg']='';	
        
	if (!$bPostBack){
		/*AQUI SI TRAE DE BASE DE DATOS*/
			//if ($_GET['accion']!='') $_POST['accion']=$_GET['accion'];	
			//if ($_GET['id_po']!='') $_POST['id_po']=$_GET['id_po'];	
					
						if ($_POST['accion']=='1' or $_POST['accion']=='2'){	
						
						$SQL2=" SELECT 
						 scpt.motor.id as motor_id,
						 scpt.sector.id as sector_id,
						 scpt.produccion.productos_id as productos_id,
						 scpt.produccion.medida_id as medida_id,
						 
						 scpt.motor.sdescripcion as motor_descripcion,
						 scpt.sector.sdescripcion as sector_descripcion,
						 public.productos.sdescripcion as productos_descripcion,
						
						 public.medida.sdescripcion as medida_descripcion,
						 scpt.produccion.ncant_produc_actual_anual as ncant_produc_actual_anual,
						 scpt.produccion.capacidad_ncant_produc_actual_anual as capacidad_ncant_produc_actual_anual,
						 scpt.produccion.scomentario as scomentario,
						 scpt.produccion.id as id,
						 scpt.produccion.ncant_produc_actual_mensual as ncant_produc_actual_mensual,
						 scpt.produccion.dfecha_producto as fecha, 
						 scpt.produccion.act_economica, 						  		
						 public.actividad_eco.nombre as actividad_eco_nombre,
						 scpt.produccion.tipo_sector						 
						FROM scpt.produccion 
						INNER JOIN scpt.empresa_motor ON empresa_motor.id= empresa_motor_id
						INNER JOIN scpt.motor ON motor.id= empresa_motor.motor_id
						INNER JOIN scpt.sector ON sector.id=empresa_motor.sector_id
						INNER JOIN public.productos ON productos.id=produccion.productos_id 
						INNER JOIN public.medida ON medida.id=produccion.medida_id
						INNER JOIN public.actividad_eco ON actividad_eco.id=produccion.act_economica 
						where scpt.produccion.id  ='".$_POST['id_po']."'";
						
						$date = strtotime($rs->fields['fecha']);
						$fechaconst = date_format($date, 'd-m-Y');									
						$rs = $conn->Execute($SQL2);
						if ($rs->RecordCount()>0){								
							$aDefaultForm['cbo_motor']=$rs->fields['motor_id'];
							$aDefaultForm['cbo_sector']=$rs->fields['sector_id'];
							$aDefaultForm['opt_tiporeg']=$rs->fields['tipo_sector'];
							$aDefaultForm['cbo_actividadEco']=$rs->fields['act_economica'];										
							$aDefaultForm['cbo_sector_descripcion']=$rs->fields['sector_descripcion'];
							$aDefaultForm['cbo_producto']=$rs->fields['productos_id'];
							$aDefaultForm['cbo_medida']=$rs->fields['medida_id'];
							$aDefaultForm['produccion_anual']=$rs->fields['ncant_produc_actual_anual'];
							$aDefaultForm['produccion_mensual']=$rs->fields['ncant_produc_actual_mensual'];							
							$aDefaultForm['capacidad_produccion_anual']=$rs->fields['capacidad_ncant_produc_actual_anual'];
							$aDefaultForm['comentario']=$rs->fields['scomentario'];
							$aDefaultForm['fecha']=$rs->fields['fecha'];

						}
			
						}
		/*
					if($_POST['accion']==2){
							//DELETE	 DESHABILITAR
							
							$SQL="	UPDATE scpt.produccion
							SET nenabled='0'
							WHERE id='".$_POST['id_po']."';
							";
							$rs= $conn->Execute($SQL);
							
							echo '<script> alert("Eliminado Exitosamente."); </script>';
					
					}
		*/
		}else{   
			$aDefaultForm['cbo_motor']=$_POST['cbo_motor'];					
			$aDefaultForm['cbo_sector']=$_POST['cbo_sector'];
			$aDefaultForm['cbo_sector_descripcion']=$rs->fields['sector_descripcion'];					
			$aDefaultForm['cbo_actividadEco']=$_POST['cbo_actividadEco'];					
			$aDefaultForm['cbo_producto']=$_POST['cbo_producto'];
			$aDefaultForm['cbo_medida']=$_POST['cbo_medida'];
			$aDefaultForm['nueva_medida']=$_POST['nueva_medida'];
			$aDefaultForm['nuevo_producto']=$_POST['nuevo_producto'];
			$aDefaultForm['valor']=$_POST['valor'];
			$aDefaultForm['valorproducto']=$_POST['valorproducto'];
			$aDefaultForm['produccion_anual']=$_POST['produccion_anual'];
			$aDefaultForm['produccion_mensual']=$_POST['produccion_mensual'];
			$aDefaultForm['capacidad_produccion_anual']=$_POST['capacidad_produccion_anual']; 
			$aDefaultForm['comentario']=$_POST['comentario'];
			$aDefaultForm['fecha']=$rs->fields['fecha'];	
			$aDefaultForm['opt_tiporeg']=$_POST['opt_tiporeg'];				
		}
	}
} 


function ProcessForm($conn){

//$_SESSION["empresa_id"]=1;	
//$_SESSION["usuario_id,"]=1;

$date = strtotime($_POST['fecha_production']);
$fecha_production =date('Y-m-d',$date);	



if($_POST['accion']==1){
//UPDATE	
$SQL="SELECT empresa_motor_id
FROM scpt.produccion
WHERE id='".$_POST['id_po']."'";
$rs= $conn->Execute($SQL);
$id_empresa_motor=$rs->fields['0'];
	
	
	
$SQL="	UPDATE scpt.empresa_motor
   		SET motor_id='".$_POST['cbo_motor']."', 
			sector_id='".$_POST['cbo_sector']."', 
      		usuario_idactualizacion = '".$_SESSION["usuario_id"]."', 
			dfecha_actualizacion = '".date('Y-m-d H:i:s')."'
		WHERE id='".$id_empresa_motor."';";
$rs= $conn->Execute($SQL);


	
//TOCAR	
$SQL="	UPDATE scpt.produccion
   		SET productos_id='".$_POST['cbo_producto']."', 
			ncant_produc_actual_anual='".$_POST['produccion_anual']."', 
			ncant_produc_actual_mensual='".$_POST['produccion_mensual']."', 
			act_economica='".$_POST['cbo_actividadEco']."', 
       		medida_id='".$_POST['cbo_medida']."', 
			scomentario='".$_POST['comentario']."', 
			capacidad_ncant_produc_actual_anual='".$_POST['capacidad_produccion_anual']."', 
      		usuario_idactualizacion = '".$_SESSION["usuario_id"]."', 
			dfecha_actualizacion = '".date('Y-m-d H:i:s')."', 
			dfecha_producto='".$fecha_production."',
			tipo_sector='".$_POST['opt_tiporeg']."'
		 WHERE id='".$_POST['id_po']."';";
$rs= $conn->Execute($SQL);

unset($_POST['id_po']);
unset($_POST['idmotor']);
unset($_POST['accion']);
LoadData($conn,false);	


echo '<script> alert("Editado Exitosamente."); </script>';
	
}else if($_POST['accion']==2){
//DELETE	 DESHABILITAR
		

//SE COLOCO ESTA FUNCION EN EL LOAD DATA
$SQL="UPDATE scpt.produccion SET nenabled='0' WHERE id='".$_POST['id_po']."';";
$rs= $conn->Execute($SQL);

$SQL2="UPDATE scpt.empresa_motor SET nenabled='0' WHERE id='".$_POST['idmotor']."';";
$rs2= $conn->Execute($SQL2);

unset($_POST['id_po']);
unset($_POST['idmotor']);
unset($_POST['accion']);
LoadData($conn,false);	

echo '<script> alert("Eliminado Exitosamente."); </script>';



}else{

	if($_POST['cbo_producto']=="" or $_POST['cbo_medida']==""){

	$SQL= "INSERT INTO scpt.empresa_motor(
							 empresa_id, motor_id, sector_id, usuario_idcreacion, dfecha_creacion)
			VALUES ( '".$_SESSION["empresa_id"]."', '".$_POST['cbo_motor']."', '".$_POST['cbo_sector']."','".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."')";
	
					if($rs= $conn->Execute($SQL)){
					$SQL="SELECT max(id)
					FROM scpt.empresa_motor
					WHERE empresa_id='".$_SESSION["empresa_id"]."'";
							$rs= $conn->Execute($SQL);
							if($rs->RecordCount()>0){
								//SI EXISTE OBTENGO EL ID
								$id_empresa_motor=$rs->fields['0'];
							}
							
					}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
				if($_POST['valor']==1){ 
				
					$SQL1= "SELECT id FROM medida WHERE sdescripcion='".ucwords($_POST['nueva_medida'])."' AND nenabled='1'";
					$rs1= $conn->Execute($SQL1);
					if($rs1->RecordCount()>0){
						
						
						
						?><script>if (alert("- La Unidad de Medida se encuentra Registrada"));</script><?
					 
					}else{
						
						$SQL2= "INSERT INTO public.medida(
											sdescripcion, usuario_idcreacion, dfecha_creacion, nenabled)
							VALUES ( '".ucwords($_POST['nueva_medida'])."','".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."','1')";
						$rs2= $conn->Execute($SQL2);
						
							$SQL1= "SELECT id FROM medida WHERE sdescripcion='".ucwords($_POST['nueva_medida'])."' AND nenabled='1'";
							$rs1= $conn->Execute($SQL1);
							$medida=$rs1->fields['0'];
							
//									if($rs1->RecordCount()>0){
//										
//										$SQL= "INSERT INTO scpt.produccion(
//																empresa_motor_id, productos_id, ncant_produc_actual_anual, capacidad_ncant_produc_actual_anual,
//																medida_id, scomentario, nenabled, dfecha_producto, usuario_idcreacion, dfecha_creacion)
//												VALUES ( '".$id_empresa_motor."','".$_POST['cbo_producto']."', '".$_POST['produccion_anual']."', 
//																'".$_POST['capacidad_produccion_anual']."', '".$rs1->fields['0']."','".$_POST['comentario']."','1','".$fecha_production."', '".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."')";
//											$rs= $conn->Execute($SQL);
//											LoadData($conn,false);
//													 
//										}
						}
				}


					if($_POST['valorproducto']==1){ 
					//echo "ENTRANDOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO";
					
						$SQL1= "SELECT id FROM productos WHERE sdescripcion='".ucwords($_POST['nuevo_producto'])."' AND nenabled='1'";
						$rs1= $conn->Execute($SQL1);
						if($rs1->RecordCount()>0){
							
							
							
							?><script>if (alert("- El Producto se encuentra Registrado"));</script><?
						 
							}else{
							
							$SQL2= "INSERT INTO public.productos(
												sdescripcion, usuario_idcreacion, dfecha_creacion, nenabled)
								VALUES ( '".ucwords($_POST['nuevo_producto'])."','".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."','1')";
							$rs2= $conn->Execute($SQL2);
							
								$SQL1= "SELECT id FROM productos WHERE sdescripcion='".ucwords($_POST['nuevo_producto'])."' AND nenabled='1'";
								$rs1= $conn->Execute($SQL1);
								$producto=$rs1->fields['0'];
//										if($rs1->RecordCount()>0){
//											
//											$SQL= "INSERT INTO scpt.produccion(
//																	empresa_motor_id, productos_id, ncant_produc_actual_anual, capacidad_ncant_produc_actual_anual,
//																	medida_id, scomentario, nenabled, dfecha_producto, usuario_idcreacion, dfecha_creacion)
//													VALUES ( '".$id_empresa_motor."','".$rs1->fields['0']."', '".$_POST['produccion_anual']."', 
//																	'".$_POST['capacidad_produccion_anual']."', '".$_POST['cbo_medida']."','".$_POST['comentario']."','1','".$fecha_production."', '".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."')";
//												$rs= $conn->Execute($SQL);
//												LoadData($conn,false);
//														 
											}
					}

					if($_POST['cbo_producto']==''){ $_POST['cbo_producto']=$producto;}

					if($_POST['cbo_medida']==''){ $_POST['cbo_medida']=$medida;}
					
					$SQL= "INSERT INTO scpt.produccion(
							empresa_motor_id, productos_id, ncant_produc_actual_anual,ncant_produc_actual_mensual, capacidad_ncant_produc_actual_anual,
							medida_id, scomentario, nenabled, dfecha_producto, usuario_idcreacion, dfecha_creacion,act_economica,	tipo_sector)
							VALUES ( '".$id_empresa_motor."','".$_POST['cbo_producto']."', '".$_POST['produccion_anual']."','".$_POST['produccion_mensual']."', 
							'".$_POST['capacidad_produccion_anual']."', '".$_POST['cbo_medida']."','".$_POST['comentario']."','1','".$fecha_production."', '".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."','".$_POST['cbo_actividadEco']."','".$_POST['opt_tiporeg']."')";
						
						$rs= $conn->Execute($SQL);
						$_POST['valor']=NULL;
						$_POST['valorproducto']=NULL;
						echo '<script> alert("Registrado Exitosamente."); </script>';	
					
					//}
	
	}else{ 
		$SQLverifica = "SELECT 	empresa_motor.empresa_id, 
			empresa_motor.motor_id, 
			empresa_motor.sector_id,
			produccion.productos_id,
			produccion.medida_id
			FROM scpt.empresa_motor
			INNER JOIN scpt.produccion ON produccion.empresa_motor_id = empresa_motor.id
			WHERE empresa_motor.empresa_id = '".$_SESSION["empresa_id"]."'
			AND empresa_motor.motor_id = '".$_POST['cbo_motor']."'
			AND empresa_motor.sector_id = '".$_POST['cbo_sector']."'
			AND produccion.productos_id = '".$_POST['cbo_producto']."'
			AND produccion.medida_id = '".$_POST['cbo_medida']."'
			AND empresa_motor.nenabled='1' ;";
		$rsVerifica= $conn->Execute($SQLverifica);

		if($rsVerifica->RecordCount()>0){
			?><script>if (alert("- El Producto Se Encuentra Registrado"));</script><?
		}else{
			$SQL= "INSERT INTO scpt.empresa_motor(empresa_id, motor_id, sector_id, usuario_idcreacion, dfecha_creacion)
			VALUES ( '".$_SESSION["empresa_id"]."', '".$_POST['cbo_motor']."', '".$_POST['cbo_sector']."','".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."')";
	
					if($rs= $conn->Execute($SQL)){
					$SQL="SELECT max(id)
					FROM scpt.empresa_motor
					WHERE empresa_id='".$_SESSION["empresa_id"]."'";
							$rs= $conn->Execute($SQL);
							if($rs->RecordCount()>0){
								//SI EXISTE OBTENGO EL ID
								$id_empresa_motor=$rs->fields['0'];
							}	
					}
		}
		
		if($rsVerifica->RecordCount()>0){
				
		}else{	
			if($_POST['cbo_producto']==''){ $_POST['cbo_producto']=$producto;}
			if($_POST['cbo_medida']==''){ $_POST['cbo_medida']=$medida;}
					
			$SQL= "INSERT INTO scpt.produccion(empresa_motor_id, productos_id, ncant_produc_actual_anual,ncant_produc_actual_mensual, capacidad_ncant_produc_actual_anual,medida_id, scomentario, nenabled, dfecha_producto, usuario_idcreacion, dfecha_creacion,act_economica,tipo_sector)
			VALUES ( '".$id_empresa_motor."','".$_POST['cbo_producto']."', '".$_POST['produccion_anual']."','".$_POST['produccion_mensual']."', '".$_POST['capacidad_produccion_anual']."', '".$_POST['cbo_medida']."','".$_POST['comentario']."','1','".$fecha_production."', '".$_SESSION["usuario_id"]."', '".date('Y-m-d H:i:s')."','".$_POST['cbo_actividadEco']."','".$_POST['opt_tiporeg']."')";
						
			$rs= $conn->Execute($SQL);
			$_POST['valor']=NULL;
			$_POST['valorproducto']=NULL;
			echo '<script> alert("Registrado Exitosamente."); </script>';
		}	
	}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------				

			}
}

function doReport($conn){
	
}

//funcion que dibuja el encabezado de la pagina 
function showHeader(){
 include('../header.php'); 
}


function showForm($conn,$aDefaultForm){
?>

<script>
//FUNCIONES PARA EL BUSCADOR EN COMBO
//PRIMER COMBO
(function( $ ) {
$.widget( "custom.combobox", {
_create: function() {
this.wrapper = $( "<span>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );

this.element.hide();

this._createAutocomplete();
this._createShowAllButton();



},
_createAutocomplete: function() {



var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";


this.input = $( "<input>" )
.appendTo( this.wrapper )
.val( value )

//.attr( "title", "Indique su valor a Buscar" )
.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
.autocomplete({
	
delay: 0,
minLength: 0,
source: $.proxy( this, "_source" )
})
.tooltip({
tooltipClass: "ui-state-highlight"
});
this._on( this.input, {
autocompleteselect: function( event, ui ) {
ui.item.option.selected = true;
this._trigger( "select", event, {
item: ui.item.option
});



},
autocompletechange: "_removeIfInvalid"


});


},
_createShowAllButton: function() {
var input = this.input,
wasOpen = false;
$( "<a>" )
.attr( "tabIndex", -1 )
.attr( "title", "Seleccionar todos" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.addClass( "custom-combobox-toggle ui-corner-right" )
.mousedown(function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.click(function() {
input.focus();

// Close if already visible
if ( wasOpen ) {
return;
}
// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},
_source: function( request, response ) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
	
var text = $( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
label: text,
value: text,
option: this
};


}) );

},
_removeIfInvalid: function( event, ui ) {
// Selected an item, nothing to do
if ( ui.item ) {
return;
}
// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;
this.element.children( "option" ).each(function() {
if ( $( this ).text().toLowerCase() === valueLowerCase ) {
this.selected = valid = true;
return false;
}

});
// Found a match, nothing to do
if ( valid ) {
return;
}
// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " no existe" )
.tooltip( "open" );
this.element.val( "" );
this._delay(function() {
this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.data( "ui-autocomplete" ).term = "";
},
_destroy: function() {
this.wrapper.remove();
this.element.show();
}
});
})( jQuery );


$(function() {
	$( "#cbo_producto" ).combobox();
	$( "#cbo_actividadEco" ).combobox();
	$( "#cbo_medida" ).combobox();
	
});
</script>
<style>
.custom-combobox-input{
	width:600px !important;
	
}

</style>
	<style type="text/css">

	.loaders {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;	
		background: url('../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255,255,255);
		opacity: 0.6;
    	filter: alpha(opacity=60);
	}
	
	</style>


<script type="text/javascript" src="validar_produccion.js"></script>
<script type="text/javascript" src="funciones_produccion.js"></script>
<script>	
	
		function send(saction){
	       if(saction=='guardar'){
		   			if(validar_produccion()==true){
							var form = document.frm_produccion;
							frm_produccion.action.value=saction;
							frm_produccion.submit();	
								$("#loader").show();
						}		   
					}
	       if(saction=='reset'){
							var form = document.frm_produccion;
							frm_produccion.action.value=saction;
							frm_produccion.submit();	
							$("#loader").show();
					}
				}

		function send_2(saction,id,idmotor,accion){
					if(saction=='modificar'){
							var form = document.frm_produccion;
							frm_produccion.action.value=saction;
							frm_produccion.id_po.value=id;
							frm_produccion.accion.value=accion;
							frm_produccion.submit();
							$("#loader").show();	
					}
					if(saction=='eliminar'){
							var form = document.frm_produccion;
							frm_produccion.action.value=saction;
							frm_produccion.id_po.value=id;
							frm_produccion.idmotor.value=idmotor;
							frm_produccion.accion.value=accion;
							frm_produccion.submit();
							$("#loader").show();	
					}
				}
		
</script>

<link rel="stylesheet" type="text/css" href="../include/calendar/tcal.css" />
<script language="JavaScript" type="text/javascript" src="../include/calendar/tcal.js"></script>

<form name="frm_produccion" id="frm_produccion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
  <input id="action" name="action" type="hidden" value=""/>
  <input name="id_po" type="hidden" value="<?=$_POST['id_po']?>" /> 
  <input name="idmotor" type="hidden" value="<?=$_POST['idmotor']?>" /> 
  <input name="accion" type="hidden" value="<?=$_POST['accion']?>" />  
  <input name="valor" id="valor" type="hidden" value="<?=$_POST['valor']?>" />  
  <input name="valorproducto" id="valorproducto" type="hidden" value="<?=$_POST['valorproducto']?>" />
  <input name="valorunidadmedida" id="valorunidadmedida" type="hidden" value="<?=$_POST['valorunidadmedida']?>" />

<table width="90%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr class="identificacion_seccion">
      <th colspan="4" class="sub_titulo_2" align="left">RESUMEN PRODUCTIVO DE LA ENTIDAD DE TRABAJO</th>
  </tr>
    
     <tr align="center">
            <th colspan="4" class="sub_titulo"><strong>Tipo Sector</strong></th>
     </tr> 
     <tr align="center">      
            <td colspan="4" id="td_empresatipo5"> 
      &nbsp;&nbsp;
      P&uacute;blico:
      <input type="radio" name="opt_tiporeg" id="opt_tiporeg1" title="Tipo Sector - Indique el Tipo Sector de la Entidad de Trabajo." value="1"<?=($aDefaultForm['opt_tiporeg'] == 1) ? 'checked="checked"' :''?> />
      &nbsp;&nbsp;
      Privado:
      <input type="radio" name="opt_tiporeg" id="opt_tiporeg2" title="Tipo Sector - Indique el Tipo Sector de la Entidad de Trabajo." value="2"<?=($aDefaultForm['opt_tiporeg'] == 2) ? 'checked="checked"' :''?> />
      &nbsp;&nbsp;
      Mixto:
      <input type="radio" name="opt_tiporeg" id="opt_tiporeg3" title="Tipo Sector - Indique el Tipo Sector de la Entidad de Trabajo." value="3"<?=($aDefaultForm['opt_tiporeg'] == 3) ? 'checked="checked"' :''?> />
      <span>*</span></td>
        </tr>
        <tr>
           <th colspan="2" class="sub_titulo" align="center">Motor</th>		
           <th colspan="2" class="sub_titulo" align="center">Sector Productivo</th>
        </tr>    
<tr>
          <td colspan="2" align="center">
          <select id="cbo_motor" name="cbo_motor" onChange="javascript:sector();">
		 <option value="">Seleccione</option>
			<? LoadMotor ($conn); print $GLOBALS['sHtml_cb_Motor']; ?>
		  </select>
			<span>*</span>	
          </td>
          <td colspan="2" align="center">
          <select id="cbo_sector" name="cbo_sector" onchange="javascript:sector_validar()" >
		  	<option value="">Seleccione</option>
            <? LoadSector ($conn); print $GLOBALS['sHtml_cb_Sector']; ?>            
            <option <? if($aDefaultForm['cbo_sector_descripcion']!=""){
			echo "selected='selected'"; } ?> value="<?=$aDefaultForm['cbo_sector'];?>"><?= $aDefaultForm['cbo_sector_descripcion'];?></option>
          </select>
          	<span>*</span>	
          	</td>
 </tr>    
   
<!--ACTIVIDA ECONOMICA-->
<tr>
    <th colspan="4" class="sub_titulo" align="center">Actividad Econ&oacute;mica CIU</th>	
</tr>
<!--INICIO ACTIVIDAD ECONOMICA-->  
  <tr>
          <td colspan="4" align="center">           
           <select id="cbo_actividadEco" name="cbo_actividadEco">
	          <option value="">Seleccione</option>
	          <? LoadActividad ($conn) ; print $GLOBALS['sHtml_cb_actividadEco']; ?>
	          </select>
	          &nbsp; &nbsp;   &nbsp; 
		      <span>*</span>
		  </td>
  </tr>          
          
       
      
<!--FIN ACTIVIDAD ECONOMICA-->       
     
         <tr>
            <th colspan="4" class="sub_titulo" align="center">Producto</th>
          </tr>
         

           <tbody id="producto1" align="center">
        <tr>
          <td colspan="4">           
           <select id="cbo_producto" name="cbo_producto">
	          <option value="">Seleccione</option>
	          <? LoadProducto ($conn) ; print $GLOBALS['sHtml_cb_Producto']; ?>
	          </select>
	          &nbsp; &nbsp;   &nbsp;  &nbsp;  
		 <button type="button" name="cmd_agregar"  id="cmd_agregar" value="1" class="button" title="Agregar Registro -  Haga Click para Agregar Unidad de Medida" onClick="javascript:agregar_producto();">
            <img src="../imagenes/add.png" width="12" height="12"/>           
            </button> 
            &nbsp; &nbsp; &nbsp;   &nbsp;  
              <span>*</span>
		  </td>
          </tr>
	</tbody>
        
	<tbody id="producto2" align="center">     
    <tr>
        <th colspan="4">
            Nuevo Producto:
            <input name="nuevo_producto" type="text" id="nuevo_producto" value="<?=$aDefaultForm['nuevo_producto']?>" size="30" maxlength="80" />
            <span> *</span>&nbsp;
           
            <button type="button" name="cmd_agregar_producto"  id="cmd_agregar_producto" class="button" title="Registrar producto " onClick="javascript:guardar_producto_produccion();">
            <img src="../imagenes/add.png" width="12" height="12"/>   
            </button>             
            <button type="button" name="cmd_agregar2"  id="cmd_agregar2" class="button" title="Restaurar Registro -  Haga Click para Restaurar el Registro " onClick="javascript:limpiar_producto();">
            <img src="../imagenes/reset.png" width="12" height="12"/>   
            </button>   
        </th>    
     </tr>
	</tbody>    
    
    <tr>
         <th colspan="4" class="sub_titulo" align="center">Unidad de  Medida</th>		
    </tr>  
     <tbody id="medida1" align="center">   
    <tr>
	        <td colspan="4">
            <select id="cbo_medida" name="cbo_medida">
	          <option value="">Seleccione</option>
	          <? LoadMedida ($conn) ; print $GLOBALS['sHtml_cb_Medida']; ?>
	          </select>
              &nbsp; &nbsp; &nbsp;  &nbsp;
	    
            <button type="button" name="cmd_agregar1"  id="cmd_agregar1" value="1" class="button" title="Agregar Registro -  Haga Click para Agregar Unidad de Medida" onClick="javascript:agregar_medida();">
            <img src="../imagenes/add.png" width="12" height="12"/>           
            </button> 
              &nbsp; &nbsp; &nbsp;  &nbsp;
                  <span>*</span>  
           </td>

       </tr>
</tbody>

    <tbody id="medida2" align="center">
    
    <tr>
     <th colspan="4">
     Nueva unidad medida:
     <input name="nueva_medida" type="text" id="nueva_medida" value="<?=$aDefaultForm['nueva_medida']?>" size="30" maxlength="30" />
     <span class="requerido"> *</span>
     
    <button type="button" name="cmd_agregar_unidad_medida"  id="cmd_agregar_unidad_medida" class="button" title="Registrar unidad medida " onClick="javascript:guardar_unidad_medida_produccion();">
    <img src="../imagenes/add.png" width="12" height="12"/>   
    </button>             
     
    <button type="button" name="cmd_agregar2"  id="cmd_agregar2" class="button" title="Restaurar Registro -  Haga Click para Restaurar el Registro " onClick="javascript:limpiar_unidad_medida();">
    <img src="../imagenes/reset.png" width="12" height="12"/>           
    </button>   
     </th>           
  </tr>    
    </tbody>
 
    <tr>
    	<th colspan="4" class="sub_titulo" align="center">Capacidad de Producci&oacute;n Anual</th>
    </tr>
    <tr align="center">
        <td colspan="4">
      	<input name="capacidad_produccion_anual" type="text" id="capacidad_produccion_anual"   value="<?=$aDefaultForm['capacidad_produccion_anual']?>" size="30" maxlength="8" title="Capacidad de Producci&oacute;n Anual - Registre la Capacidad de Producci&oacute;n Anual de la entidad de trabajo." onkeypress="return isNumberKey(event);"/>
        <span class="requerido"> *</span>
        </td> 
    </tr>
    
        <tr>
            <th  colspan="2" class="sub_titulo" align="center">Producci&oacute;n Anual</th>	            
            <th colspan="2" class="sub_titulo" align="center">Producci&oacute;n del Mes</th>           
        </tr>
    
	  <tr>
               <td  align="center"><input name="produccion_anual" type="text" id="produccion_anual"   value="<?=$aDefaultForm['produccion_anual']?>" size="10" maxlength="8" title="Producci&oacute;n Anual - Registre el total de la Producci&oacute;n Anual de la entidad de trabajo." onkeypress="return isNumberKey(event);" onchange="javascript:valores_anuales();" />
                <span class="requerido"> *</span></td> 
                
                 <td   align="center" ><input name= "anual" type="text"  readonly="readonly" id="anual"  maxlength="150"  size="40" disabled="disabled" /><b> ANUAL</b> </td>	  
                  
                <td align="center"><input name="produccion_mensual" type="text" id="produccion_mensual"   value="<?=$aDefaultForm['produccion_mensual']?>" size="10" maxlength="8" title="Producci&oacute;n del Mes - Registre el total de la Producci&oacute;n del Mes de la entidad de trabajo." onkeypress="return isNumberKey(event);" onchange="javascript:valores_mensuales();"  />
                    <span class="requerido"> *</span></td>          
                               
                     <td  align="center"><input name= "mensual" type="text" id="mensual" readonly="readonly"   maxlength="150"  size="40"  disabled="disabled"  /><b> MENSUAL</b></td>
    </tr>	 

        <tr>
            <th colspan="4" class="sub_titulo">Problemas que Impactan la Producci&oacute;n</th>		
        </tr>

        <tr>
        <td colspan="4" align="center">
            <textarea name="ta_problemas" id="ta_problemas" cols="140" rows="2" title="Problemas que Impactan la Producci&oacute;n - Registre la problem&aacute;tica que impacta la producci&oacute;n en la entidad de trabajo."><?= $aDefaultForm['problemas'];?></textarea></td>    
    </tr>	

        <tr>
            <th colspan="4" class="sub_titulo" align="center">Comentarios u Observaciones</th>		
        </tr>

<tr>
    <tr>

      <td colspan="4" align="center">
        <textarea name="comentario" id="comentario" cols="140" rows="2" title="Comentario u  Observaci&oacute;n - Agregue un comentario u observaci&oacute;n de ser necesario para este registro."><?= $aDefaultForm['comentario'];?>
    </textarea></td>
    </tr>
<!--    <tr>
      <td align="left">Fecha: </td>
                <td>
              <input type="text" id="fecha_production" name="fecha_production" class="tcal" value="<?=$aDefaultForm['fecha']?>" /> <span class="requerido"> * </span> 
			  </td>   
    </tr> -->  

 

  
 </table>
 
<table width="88%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
      <td align="left">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>

			<th colspan="4" align="center">
					<button type="button" name="Continuar"  id="Continuar" class="button" onclick="javascript:send('guardar');" >				          
          <? if($_POST['accion']==1){?>
          	Editar
						<img src="../imagenes/pencil_16.png" />		
          <? }elseif($_POST['accion']==2){?>
          	Eliminar
						<img src="../imagenes/delete_16.png" />					
          <? }else{ ?>
          	Guardar
						<img src="../imagenes/save_16.png" />					
          <? } ?>

          </button>			
          
					<button type="button" name="recargar"  id="recargar" class="button" onclick="javascript:send('reset');" >				          
          	Limpiar
						<img src="../imagenes/reset.png" width="16" height="16" />		

          </button>			
          </th>
	</tr>
    
</table>
<div id="loader" class="loaders" style="display: none;"></div>
</form>

<?php
$SQL1="
			 
			 SELECT scpt.motor.sdescripcion as motor_descripcion,
       scpt.sector.sdescripcion as sector_descripcion,
       public.productos.sdescripcion as productos_descripcion,
       public.medida.sdescripcion as medida_descripcion,
       scpt.produccion.ncant_produc_actual_anual as ncant_produc_actual_anual,
       scpt.produccion.capacidad_ncant_produc_actual_anual as capacidad_ncant_produc_actual_anual,
       scpt.produccion.id as id,
	   scpt.empresa_motor.id as idmotor
       
			FROM scpt.produccion 
			INNER JOIN scpt.empresa_motor ON empresa_motor.id= empresa_motor_id
			INNER JOIN scpt.motor ON motor.id= empresa_motor.motor_id
			INNER JOIN scpt.sector ON sector.id=empresa_motor.sector_id
			INNER JOIN public.productos ON productos.id=produccion.productos_id 
			INNER JOIN public.medida ON medida.id=produccion.medida_id
			
			WHERE produccion.nenabled='1' AND scpt.empresa_motor.empresa_id='".$_SESSION["empresa_id"]."'
			
";							

$rs1=$conn->Execute($SQL1);
		
		if($rs1->RecordCount()>0){
		$numero_registros=$rs1->RecordCount();
		}else{
		$numero_registros=0;	
		}

?>
<div>

 <table  id="tblDetalle" class="listado"  style="width:90%; " align="center" >
 <thead>
            <tr>
            	<th></th>
            	<th align="left">MOTOR</th>
              <th align="left">SECTOR</th>
              <th align="left">PRODUCTO</th>
              <th align="left">UNIDAD MEDIDA</th>
              <th align="left">PRODUCCION ANUAL</th>
              <th align="left">CAPACIDAD PRODUCCION ANUAL</th>
              <th>ACCIONES</th>
            </tr>
						<tbody>
<?php					
while (!$rs1->EOF ){


	?>

  <tr>

                <td></td>
				<td><?php	echo $rs1->fields['motor_descripcion']; ?></td>
                <td><?php	echo $rs1->fields['sector_descripcion']; ?></td>
                <td><?php	echo utf8_decode($rs1->fields['productos_descripcion']); ?></td>
                <td><?php	echo $rs1->fields['medida_descripcion']; ?></td>
                <td><?php	echo $rs1->fields['ncant_produc_actual_anual']; ?></td>
                <td><?php	echo $rs1->fields['capacidad_ncant_produc_actual_anual']; ?></td>
                <td><a onClick="send_2('modificar',<?=$rs1->fields['id']?>,0,1);"><img src="../imagenes/pencil_16.png" border="0" title="Editar" /></a> 
					<a onClick="send_2('eliminar',<?=$rs1->fields['id']?>,<?=$rs1->fields['idmotor']?>,2);" title="ELiminar - Haga click para eliminar este registro."><img src="../imagenes/delete_16.png" border="0" title="Eliminar" /></a> </td>

            	</tr>
<?php
$rs1->MoveNext();									
}
?>
							</tbody>
						</thead>
        	</table>
          <br />
          <br />
          <br />
          
					</div>
<?php
}
//funcion que imprime con alert todos los errores
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php include('../footer.php'); ?>

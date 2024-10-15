<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug']=false);
showHeader();
showForm($conn,$aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		print $_SESSION['rif'];
		print $_SESSION['ivss'];
		print $_SESSION['nil'];
		print $_SESSION['nombre_empresa'];
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
				
			case 'Cancelar':
			    LoadData($conn,false);
			break;
			
			 case 'cbNivel_academico_changed':
			    LoadData($conn,true);
				LoadCarrera($conn); 
			break;
			
			case 'cbCarrera_changed':
			    LoadData($conn,true);
				LoadCarrera1($conn);
			break;
			
			case 'cbCarrera1_changed':
			    LoadData($conn,true);
				LoadCarrera2($conn);
			break;
			
			case 'cbCarrera2_changed':
			    LoadData($conn,true);
				LoadCarrera3($conn);
			break;
			
			case 'cbCarrera3_changed':
			    LoadData($conn,true);
			break;		
			
			case 'Buscar':			     
			LoadData($conn,true);
			break;
			
			case 'Agregar': 
			$bValidateSuccess=true;	
			/*if ($_POST['cbNacionalidad_afiliado']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Nacinalidad: es requerida.";
					$bValidateSuccess=false;
					 }
					 
			if ($_POST['cbEstado_Civil_afiliado']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Estado Civil: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbSexo']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Sexo: es requerido.";
					$bValidateSuccess=false;
					 }*/
			if ($_POST['edad1']==""){
					$GLOBALS['aPageErrors'][]= "- Edad mínima: es requerida.";
					$bValidateSuccess=false;
					 }
		
			if ($_POST['edad2']==""){
					$GLOBALS['aPageErrors'][]= "- Edad máxima: es requerida.";
					$bValidateSuccess=false;
					 }
			/*if ($_POST['cbVehiculo_afiliado']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Tipo de vehículo que debe poseer: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbNivel_academico']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Nivel mínimo de instrucción: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbCarrera']==""){  
					$GLOBALS['aPageErrors'][]= "- Area o mención: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbGraduado']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Graduado: es requerido";
					$bValidateSuccess=false;
					 } */
		     if ($_POST['cbIdioma']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Dominio de idioma: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbLee']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Lee: es requerido.";
					$bValidateSuccess=false;
					 }
		
			if ($_POST['cbHabla']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Habla: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbEscribe']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Escribe: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbNivel_Lee']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Nivel-Lee: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbNivel_Habla']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Nivel-Habla: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbNivel_Escribe']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Nivel-Escribe: es requerido.";
					$bValidateSuccess=false;
					 }
		    /* if ($_POST['cbComputacion']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Contrata personal migrante calificado?: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbNivel_compu']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Dominio de computacion: es requerido.";
					$bValidateSuccess=false;
					 }*/
			if ($_POST['cbExperiencia']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- Experiencia mínima requerida: es requerido.";
					$bValidateSuccess=false;
					 } 
			if ($_POST['f_opor_valida']==""){
					$GLOBALS['aPageErrors'][]= "- Oportunidad Válida Hasta: es requerida.";
					$bValidateSuccess=false;
					 }			
			if (!$bValidateSuccess){	
			LoadData($conn,true);	
			}	
			if ($bValidateSuccess){	
			$sfecha=date('Y-m-d');			 
			$sql="update oferta_empleo set 
				
				  estado_civil_id = '".$_POST['cbEstado_Civil_afiliado']."',
				  sexo = '".$_POST['cbSexo']."',
				  edad_min = '".$_POST['edad1']."',
				  edad_max = '".$_POST['edad2']."',
				  tipo_vehiculo_id = '".$_POST['cbVehiculo_afiliado']."',
				  nivel_instruccion_id=	'".$_POST['cbNivel_academico']."',
				 
				  graduado = '".$_POST['cbGraduado']."',
				  idioma_id = '".$_POST['cbIdioma']."',
				  lee = '".$_POST['cbLee']."',
				  habla = '".$_POST['cbHabla']."',
				  escribe = '".$_POST['cbEscribe']."',
				  nivel_lee = '".$_POST['cbNivel_Lee']."',
				  nivel_habla = '".$_POST['cbNivel_Habla']."',
				  nivel_escribe = '".$_POST['cbNivel_Escribe']."',
				  computacion_id = '".$_POST['cbComputacion']."',
				  nivel_computacion = '".$_POST['cbNivel_compu']."',
				  experiencia = '".$_POST['cbExperiencia']."',
				  fecha_max= '".$_POST['f_opor_valida']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'"; 	
				  /*
				  $sql="update oferta_empleo set 
				  nacionalidad = '".$_POST['cbNacionalidad_afiliado']."',
				  estado_civil_id = '".$_POST['cbEstado_Civil_afiliado']."',
				  sexo = '".$_POST['cbSexo']."',
				  edad_min = '".$_POST['edad1']."',
				  edad_max = '".$_POST['edad2']."',
				  tipo_vehiculo_id = '".$_POST['cbVehiculo_afiliado']."',
				  nivel_instruccion_id=	'".$_POST['cbNivel_academico']."',
				  area_mencion_id='".$_POST['cbCarrera']."',
				  carrera1='".$_POST['cbCarrera1']."',
				  carrera2='".$_POST['cbCarrera2']."',
				  carrera3='".$_POST['cbCarrera3']."',
				  graduado = '".$_POST['cbGraduado']."',
				  idioma_id = '".$_POST['cbIdioma']."',
				  lee = '".$_POST['cbLee']."',
				  habla = '".$_POST['cbHabla']."',
				  escribe = '".$_POST['cbEscribe']."',
				  nivel_lee = '".$_POST['cbNivel_Lee']."',
				  nivel_habla = '".$_POST['cbNivel_Habla']."',
				  nivel_escribe = '".$_POST['cbNivel_Escribe']."',
				  computacion_id = '".$_POST['cbComputacion']."',
				  nivel_computacion = '".$_POST['cbNivel_compu']."',
				  experiencia = '".$_POST['cbExperiencia']."',
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'"; */	
			  	  $conn->Execute($sql);
	//Trazas-------------------------------------------------------------------------------------------------------------------------------				
						$id=$_SESSION['id_oferta'];
						$identi=$_SESSION['rif'];
						$us=$_SESSION['sUsuario'];
						$mod='17';			    
						$auditoria= new Trazas; 
						$auditoria->auditor($id,$identi,$sql,$us,$mod);
				  
				 ?><script>document.location='?formato=5'</script><?  
				  }			
				LoadData($conn,true);	
			break;
			
			}
		}	
		else{
			LoadData($conn,false);
		}
	}

//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];

					//$aDefaultForm['cbNacionalidad_afiliado']='-1';
					$aDefaultForm['cbEstado_Civil_afiliado']='-1';
					$aDefaultForm['cbSexo']='-1';
					$aDefaultForm['edad1']='';
					$aDefaultForm['edad2']='';
					$aDefaultForm['cbVehiculo_afiliado']='-1';
					$aDefaultForm['cbNivel_academico']='-1';
					/*$aDefaultForm['cbCarrera']='-1';
					$aDefaultForm['cbCarrera1']='-1';
					$aDefaultForm['cbCarrera2']='-1';
					$aDefaultForm['cbCarrera3']='-1';*/
					$aDefaultForm['cbGraduado']='-1';
					$aDefaultForm['cbIdioma']='-1'; 
					$aDefaultForm['cbLee']='-1';
					$aDefaultForm['cbHabla']='-1';
					$aDefaultForm['cbEscribe']='-1'; 
					$aDefaultForm['cbNivel_Lee']='-1';
					$aDefaultForm['cbNivel_Habla']='-1';
					$aDefaultForm['cbNivel_Escribe']='-1'; 
					$aDefaultForm['cbComputacion']='-1';
					$aDefaultForm['cbNivel_compu']='-1';
					$aDefaultForm['cbExperiencia']='-1';
					$aDefaultForm['fecha_max']='';
        
	if (!$bPostBack){		
		    $SQL="select * From public.oferta_empleo where id ='".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 				
					//$aDefaultForm['cbNacionalidad_afiliado']=$rs1->fields['nacionalidad'];
					$aDefaultForm['cbEstado_Civil_afiliado']=$rs1->fields['estado_civil_id'];
					$aDefaultForm['cbSexo']=$rs1->fields['sexo'];
					$aDefaultForm['edad1']=$rs1->fields['edad_min'];
					$aDefaultForm['edad2']=$rs1->fields['edad_max'];
					$aDefaultForm['cbVehiculo_afiliado']=$rs1->fields['tipo_vehiculo_id'];
					$aDefaultForm['cbNivel_academico']=$rs1->fields['nivel_instruccion_id'];
					//$aDefaultForm['cbCarrera']=$rs1->fields['area_mencion_id'];
					//$aDefaultForm['cbCarrera1']=$rs1->fields['carrera1'];
					//$aDefaultForm['cbCarrera2']=$rs1->fields['carrera2'];
					//$aDefaultForm['cbCarrera3']=$rs1->fields['carrera3'];
					
					?>
				<script language="javascript" src="../js/jquery-1.2.6.min.js"></script>
				<script>
				$(document).ready(function(){
					elegido=<?php echo $rs1->fields['nivel_instruccion_id'] ?>;
					combo="Carrera";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:<?php echo $rs1->fields['area_mencion_id']; ?> }, 		
					function(data){
					cadenaTexto = data;
					parte_ = cadenaTexto.split('|');
					$("#cbCarrera").html(parte_[0]);
					//$("#cbRegimen").html(parte_[1]);
					});            
				});
				
					$(document).ready(function(){
					elegido=<?php echo $rs1->fields['area_mencion_id'] ?>;
					combo="Carrera1";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:<?php echo $rs1->fields['carrera1']; ?> }, 
					function(data){  $("#cbCarrera1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido=<?php echo $rs1->fields['carrera1'] ?>;
					combo="Carrera2";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:<?php echo $rs1->fields['carrera2']; ?> }, 
					function(data){  $("#cbCarrera2").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido=<?php echo $rs1->fields['carrera2'] ?>;
					combo="Carrera3";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:<?php echo $rs1->fields['carrera3']; ?> }, 
					function(data){  $("#cbCarrera3").html(data);
				   });            
				});
				</script>
				<?php
					
					$aDefaultForm['cbGraduado']=$rs1->fields['graduado'];
					$aDefaultForm['cbIdioma']=$rs1->fields['idioma_id'];
					$aDefaultForm['cbLee']=$rs1->fields['lee'];
					$aDefaultForm['cbHabla']=$rs1->fields['habla'];
					$aDefaultForm['cbEscribe']=$rs1->fields['escribe'];
					$aDefaultForm['cbNivel_Lee']=$rs1->fields['nivel_lee'];
					$aDefaultForm['cbNivel_Habla']=$rs1->fields['nivel_habla'];
					$aDefaultForm['cbNivel_Escribe']=$rs1->fields['nivel_escribe'];
					$aDefaultForm['cbComputacion']=$rs1->fields['computacion_id'];
					$aDefaultForm['cbNivel_compu']=$rs1->fields['nivel_computacion'];
					$aDefaultForm['cbExperiencia']=$rs1->fields['experiencia'];
					$aDefaultForm['f_opor_valida']=$rs1->fields['fecha_max'];				
					} 
				}	
		else{   
					//$aDefaultForm['cbNacionalidad_afiliado']=$_POST['cbNacionalidad_afiliado'];
					$aDefaultForm['cbEstado_Civil_afiliado']=$_POST['cbEstado_Civil_afiliado'];
					$aDefaultForm['cbSexo']=$_POST['cbSexo'];
					$aDefaultForm['edad1']=$_POST['edad1']; 
					$aDefaultForm['edad2']=$_POST['edad2'];
					$aDefaultForm['cbVehiculo_afiliado']=$_POST['cbVehiculo_afiliado'];
					$aDefaultForm['cbNivel_academico']=$_POST['cbNivel_academico'];
					/*$aDefaultForm['cbCarrera']=$_POST['cbCarrera'];
					$aDefaultForm['cbCarrera1']=$_POST['cbCarrera1'];
					$aDefaultForm['cbCarrera2']=$_POST['cbCarrera2'];
					$aDefaultForm['cbCarrera3']=$_POST['cbCarrera3'];*/
					$aDefaultForm['cbGraduado']=$_POST['cbGraduado'];
					$aDefaultForm['cbIdioma']=$_POST['cbIdioma'];
					$aDefaultForm['cbLee']=$_POST['cbLee'];
					$aDefaultForm['cbHabla']=$_POST['cbHabla'];
					$aDefaultForm['cbEscribe']=$_POST['cbEscribe'];
					$aDefaultForm['cbNivel_Lee']=$_POST['cbNivel_Lee']; 
					$aDefaultForm['cbNivel_Habla']=$_POST['cbNivel_Habla'];
					$aDefaultForm['cbNivel_Escribe']=$_POST['cbNivel_Escribe'];
					$aDefaultForm['cbComputacion']=$_POST['cbComputacion']; 
					$aDefaultForm['cbNivel_compu']=$_POST['cbNivel_compu']; 
					$aDefaultForm['cbExperiencia']=$_POST['cbExperiencia'];
					$aDefaultForm['f_opor_valida']=$_POST['fecha_max'];
					}
			}
} 
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('menu_oferta_empleo.php');
 ?>

<div class="container">
 <? }

//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action=" ">
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>

<script language="javascript">
$(document).ready(function(){
   $("#cbNivel_academico").change(function () {
           $("#cbNivel_academico option:selected").each(function () {
            elegido=$(this).val();
			combo='Carrera';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
			cadenaTexto = data;
			parte_ = cadenaTexto.split('|');
            $("#cbCarrera").html(parte_[0]);
		//	$("#cbRegimen").html(parte_[1]);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbCarrera").change(function () {
           $("#cbCarrera option:selected").each(function () {
            elegido=$(this).val();
			combo='Carrera1';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbCarrera1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbCarrera1").change(function () {
           $("#cbCarrera1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Carrera2';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbCarrera2").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbCarrera2").change(function () {
           $("#cbCarrera2 option:selected").each(function () {
            elegido=$(this).val();
			combo='Carrera3';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbCarrera3").html(data);
            });            
        });
   })
});

</script>

    <input name="action" type="hidden" value=""/>

        <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
   		 <td colspan="4"></td>
       </tr>
        <tr>
    		<th colspan="4" class="sub_titulo" align="left">Condiciones del Perfil:</th>
        </tr> 
       <!-- <tr>
          <td width="44%"><div align="right"> Nacionalidad: <br>
           </div></td>
          <td width="56%"><select name="cbNacionalidad_afiliado" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbNacionalidad_afiliado'])=='1') print "selected=\"selected\"";?>>Venezolana</option>
            <option value="2" <? if (($aDefaultForm['cbNacionalidad_afiliado'])=='2') print "selected=\"selected\"";?>>Extranjera</option>
          </select></td>
        </tr>-->
        <tr>
          <td><div align="right"> Estado civil: </div></td>
          <td><select name="cbEstado_Civil_afiliado" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadEstado_Civil_afiliado($conn) ; print $GLOBALS['sHtml_cb_Estado_Civil_afiliado']; ?>
          </select></td>
        </tr>
        <tr>
          <td><div align="right"> Sexo: </div></td>
          <td><select name="cbSexo" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbSexo'])=='1') print "selected=\"selected\"";?>>Femenino</option>
            <option value="2" <? if (($aDefaultForm['cbSexo'])=='2') print "selected=\"selected\"";?>>Masculino</option>
          </select></td>
        </tr>
        <tr>
          <td><div align="right"> Edad: 	entre  </div></td>
          <td><input name="edad1" type="text" class="tablaborde_shadow" id="edad1" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['edad1']?>" size="5" maxlength="2" />
            y
            <input name="edad2" type="text" class="tablaborde_shadow" id="edad2" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['edad2']?>" size="5" maxlength="2" />
            a&ntilde;os 
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Tipo de veh&iacute;culo que debe poseer: </div></td>
          <td><select name="cbVehiculo_afiliado" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadVehiculo_afiliado($conn); print $GLOBALS['sHtml_cb_Vehiculo_afiliado'];?>
          </select></td>
        </tr>
        <tr>
          <td width="44%"><div align="right"> Nivel educativo: </div></td>
          <td width="56%"><select name="cbNivel_academico" id="cbNivel_academico" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadNivel_academico($conn) ; print $GLOBALS['sHtml_cb_Nivel_academico']; ?>
            </select>
              <span class="requerido">*</span></td>
        </tr>
      <!--  <tr>
          <td><div align="right"> Carrera o Especialidad General:  </div></td>
          <td><select name="cbCarrera" id="cbCarrera" class="tablaborde_shadow">
              <option value="-1">Seleccionar</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Carrera o Especialidad Específica:  </div></td>
          <td><select name="cbCarrera1" id="cbCarrera1" class="tablaborde_shadow">
              <option value="-1">Seleccionar</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Carrera o Especialidad Sub Específica:  </div></td>
          <td><select name="cbCarrera2" id="cbCarrera2" class="tablaborde_shadow">
              <option value="-1">Seleccionar</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        <tr>
          <td><div align="right"> Carrera o Especialidad Detalle:  </div></td>
          <td><select name="cbCarrera3" id="cbCarrera3" class="tablaborde_shadow">
              <option value="-1">Seleccionar</option>
            </select>
              <span class="requerido">*</span></td>
        </tr>
        -->
        <tr>
          <td><div align="right"> Graduado: </div></td>
          <td><select name="cbGraduado" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbGraduado'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbGraduado'])=='0') print 'selected="selected"';?>>No</option>
            <option value="2" <? if (($aDefaultForm['cbGraduado'])=='2') print 'selected="selected"';?>>No Aplica</option>
          </select></td>
        </tr>
        <tr>
          <td><div align="right"> Dominio de idioma: </div></td>
          <td><span class="links-menu-izq">
            <select name="cbIdioma" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadIdioma($conn); print $GLOBALS['sHtml_cb_Idioma'];?>
            </select>
          <span class="requerido"> *</span></span></td>
        </tr>
        <tr>
          <td><div align="right"> Lee: </div></td>
          <td><select name="cbLee" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbLee'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbLee'])=='0') print 'selected="selected"';?>>No</option>
          </select>
            <span class="requerido"> *</span>             Nivel: 
            <select name="cbNivel_Lee" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione</option>
              <option value="1" <? if (($aDefaultForm['cbNivel_Lee'])=='1') print 'selected="selected"';?>>Bien</option>
              <option value="2" <? if (($aDefaultForm['cbNivel_Lee'])=='2') print 'selected="selected"';?>>Regular</option>
              <option value="3" <? if (($aDefaultForm['cbNivel_Lee'])=='3') print 'selected="selected"';?>>Excelente</option>
            </select>
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right">   Habla: </div></td>
          <td><select name="cbHabla" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbHabla'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbHabla'])=='0') print 'selected="selected"';?>>No</option>
          </select>
            <span class="requerido"> *</span>             Nivel: 
            <select name="cbNivel_Habla" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione</option>
              <option value="1" <? if (($aDefaultForm['cbNivel_Habla'])=='1') print 'selected="selected"';?>>Bien</option>
              <option value="2" <? if (($aDefaultForm['cbNivel_Habla'])=='2') print 'selected="selected"';?>>Regular</option>
              <option value="3" <? if (($aDefaultForm['cbNivel_Habla'])=='3') print 'selected="selected"';?>>Excelente</option>
            </select>
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right">  Escribe: </div></td>
          <td><select name="cbEscribe" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbEscribe'])=='1') print 'selected="selected"';?>>Si</option>
            <option value="0" <? if (($aDefaultForm['cbEscribe'])=='0') print 'selected="selected"';?>>No</option>
          </select>
            <span class="requerido"> *</span> Nivel: 
            <select name="cbNivel_Escribe" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione</option>
              <option value="1" <? if (($aDefaultForm['cbNivel_Escribe'])=='1') print 'selected="selected"';?>>Bien</option>
              <option value="2" <? if (($aDefaultForm['cbNivel_Escribe'])=='2') print 'selected="selected"';?>>Regular</option>
              <option value="3" <? if (($aDefaultForm['cbNivel_Escribe'])=='3') print 'selected="selected"';?>>Excelente</option>
            </select>
            <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Dominio de computacion:  </div></td>
          <td><span class="links-menu-izq">
            <select name="cbComputacion" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadComputacion($conn); print $GLOBALS['sHtml_cb_Computacion'];?>
            </select>
          </span> 
          Nivel:           
          <select name="cbNivel_compu" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
            <option value="1" <? if (($aDefaultForm['cbNivel_compu'])=='1') print 'selected="selected"';?>>Bien</option>
            <option value="2" <? if (($aDefaultForm['cbNivel_compu'])=='2') print 'selected="selected"';?>>Regular</option>
            <option value="3" <? if (($aDefaultForm['cbNivel_compu'])=='3') print 'selected="selected"';?>>Excelente</option>
          </select>
          <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Experiencia m&iacute;nima requerida: </div></td>
          <td><select name="cbExperiencia" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione</option>
			<option value="0" <? if (($aDefaultForm['cbExperiencia'])=='0') print 'selected="selected"';?>>No requiere</option>
            <option value="1" <? if (($aDefaultForm['cbExperiencia'])=='1') print 'selected="selected"';?>>1</option>
            <option value="2" <? if (($aDefaultForm['cbExperiencia'])=='2') print 'selected="selected"';?>>2</option>
            <option value="3" <? if (($aDefaultForm['cbExperiencia'])=='3') print 'selected="selected"';?>>3</option>
			<option value="4" <? if (($aDefaultForm['cbExperiencia'])=='4') print 'selected="selected"';?>>4</option>
            <option value="5" <? if (($aDefaultForm['cbExperiencia'])=='5') print 'selected="selected"';?>>5</option>
            <option value="6" <? if (($aDefaultForm['cbExperiencia'])=='6') print 'selected="selected"';?>>Más</option>
          </select>
          a&ntilde;os 
          <span class="requerido"> *</span></td>
        </tr>
        <tr>
         <td><div align="right">Oportunidad V&aacute;lida Hasta:</div></td>
        <td>
        <input name="f_opor_valida" type="text" class="tablaborde_shadow" id="f_opor_valida" value="<?=$aDefaultForm['f_opor_valida']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "f_opor_valida",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script>	<span class="requerido">*</span>  </td>
        </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3" class="requerido"></td>
        </tr>
        <tr>
          <td colspan="4" class="link-clave-ruee"><div align="center">   
          
           <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button></div>
          
          </td>
        </tr>
        
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3" class="link-clave-ruee">&nbsp;</td>
        </tr>
      </table>
</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php // include('../footer.php'); ?>
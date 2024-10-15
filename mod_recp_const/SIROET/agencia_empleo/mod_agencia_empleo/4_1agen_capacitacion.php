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
			
						
			case 'Buscar':			     
			LoadData($conn,true);
			break; 
			
			case 'cbCurso_categoria_changed':
			    LoadData($conn,true);
			break;
						
			case 'btCurso':
			$bValidateSuccess= true;
			
			if ($_POST['otro_curso']!='' ){		
					$sSQL = "select *  from curso 
					where nombre ='".$_POST['otro_curso']."'"; 
					$rs = $conn->Execute($sSQL);
				    if ($rs->RecordCount()>0){ 					
					$GLOBALS['aPageErrors'][]= "El curso: ".$_POST['otro_curso']." ya existe.";
					$bValidateSuccess=false;
					}
     				else{				
						$sql="insert into public.curso
						  (nombre, categoria_curso_id, status) values
						  ('".(ucwords(strtolower($_POST["otro_curso"])))."',
						   '".$_POST['cbCurso_categoria']."',
						   'A')";
						   $conn->Execute($sql);
						}
						}
					else{
					$GLOBALS['aPageErrors'][]="- Especifique la descripción del Otro curso";
					 $bValidateSuccess=false;
					}
			LoadData($conn,true);
			break;
						
			case 'cbOcupacion5_interes_1_changed':			    
				$SQL="select * From public.persona_oferta_capacitacion where oferta_id='".$_SESSION['id_oferta']."'";
				$rs1 = $conn->Execute($SQL);
				if ($rs1->RecordCount()>0){ 	
				    $GLOBALS['aPageErrors'][]= "- La Ocupación no se puede actualizar, ya que esta Oportunidad de Capacitación tiene Trabajadores postulados.";
					 $bValidateSuccess=false;
					 LoadData($conn,false);
					 }	
				else{
				  LoadData($conn,true);
				  $param = '';
				  if  ($_POST['ocupacion']!='')
				  $param= " and nombre ilike '%".$_POST['ocupacion']."%' ";
				  LoadOcupacion5_interes_1($conn, $param);
				 }
			break;
			
			case 'Agregar': 
			$bValidateSuccess=true;	
			
			if ($_POST['cbCurso_categoria']=="-1"){
					$GLOBALS['aPageErrors'][]= "- La Categoría de la actividad de capacitación: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['cbCurso']=="-1"){
					$GLOBALS['aPageErrors'][]= "- El Nombre de la actividad de capacitación: es requerido.";
					$bValidateSuccess=false;
					 }
		/*	if ($_POST['cbOcupacion5_interes_1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Ocupación Detalle primera opción: es requerida.";
				$bValidateSuccess=false;
				 }		*/	

			if ($_POST['cupos']==""){
				$GLOBALS['aPageErrors'][]= "- El Nro. cupos: es requerido.";
				$bValidateSuccess=false;
				}
			else{
				if($_POST['cupos'] < $_POST['cupos_disponibles']){
				    $GLOBALS['aPageErrors'][]= "- El Nro. de participantes: debe ser mayor al nro. de cupos disponibles.";
					$bValidateSuccess=false;
					 }
				 }		 
			
			if ($_POST['duracion']==""){  
					$GLOBALS['aPageErrors'][]= "- La Duración: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['costo']==""){  
					$GLOBALS['aPageErrors'][]= "- El Costo: es requerido.";
					$bValidateSuccess=false;
					 }
			if ($_POST['fecha_inicio']==""){  
					$GLOBALS['aPageErrors'][]= "- La fecha de inicio: es requerida.";
					$bValidateSuccess=false;
					 }
			if ($_POST['fecha_fin']==""){  
					$GLOBALS['aPageErrors'][]= "- La fecha de culminación: es requerida";
					$bValidateSuccess=false;
					 }
			if($_POST['fecha_inicio']!='' and $_POST['fecha_fin']!=''){
				if ($_POST['fecha_inicio'] > $_POST['fecha_fin']){
					$GLOBALS['aPageErrors'][]= "- Fecha de inicio y culminación: son incorrectas.";
					$bValidateSuccess=false;
				}
			 }
			 
		     if ($_POST['cbTipo_jornada']=="-1"){  
					$GLOBALS['aPageErrors'][]= "- El Tipo de jornada: son requerida.";
					$bValidateSuccess=false;
					 }
					 
					 		 
			if (!$bValidateSuccess){	
			LoadData($conn,true);	
			}	
			if ($bValidateSuccess){	
			$sfecha=date('Y-m-d');	
			if ($_POST['tiempo1']=='0')$_POST['tiempo1']='PM';
			if ($_POST['tiempo2']=='0')$_POST['tiempo2']='PM';    
			if ($_POST['tiempo1']=='1')$_POST['tiempo1']='AM';
			if ($_POST['tiempo2']=='1')$_POST['tiempo2']='AM';	
			
			$hora_desde=($_POST['hora1'].':'.$_POST['min1'].':'.$_POST['tiempo1']);
			$hora_hasta=($_POST['hora2'].':'.$_POST['min2'].':'.$_POST['tiempo2']);
			
			if($_POST['cupos_disponibles']=='')$_POST['cupos_disponibles']=$_POST['cupos'];						 
			$sql="update oferta_capacitacion set 
				  curso_categoria_id = '".$_POST['cbCurso_categoria']."',
				  curso_id = '".$_POST['cbCurso']."',
				  certificado = '".$_POST['cbCertificado']."',
				  ocupacion1= '".$_POST['cbOcupacion5_interes_1']."',
				  ocupacion2 = '".$_POST['cbOcupacion4_interes_1']."',
				  ocupacion3 = '".$_POST['cbOcupacion3_interes_1']."',
				  ocupacion4 = '".$_POST['cbOcupacionG_interes_1']."',
				  ocupacion5 = '".$_POST['cbOcupacionE_interes_1']."',
				  cupos = '".$_POST['cupos']."',
				  cupos_disponibles = '".$_POST['cupos_disponibles']."',
				  duracion = '".$_POST['duracion']."',
				  costo = '".$_POST['costo']."',
				  f_inicio = '".$_POST['fecha_inicio']."',
				  f_culminacion = '".$_POST['fecha_fin']."',
				  turno_jornada_id = '".$_POST['cbTipo_jornada']."',
				  horario_desde = '".$hora_desde."',
				  horario_hasta = '".$hora_hasta."',				  
				  status = 'A',
				  updated_at = '".$sfecha."',
				  id_update ='".$_SESSION['sUsuario']."'
				  WHERE id= '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'"; 	
			  	  $conn->Execute($sql);
				  
				  //Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_oferta'];
				$identi=$_SESSION['rif'];
				$us=$_SESSION['sUsuario'];
				$mod='19';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);
				  
			    ?><script>document.location='?menu=42'</script><?  
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
	
					$aDefaultForm['cbCurso_categoria']='-1'; 
					$aDefaultForm['cbCurso']='-1'; 
					$aDefaultForm['cbCertificado']='1';
					$aDefaultForm['cbOcupacion5_interes_1']='-1';
					$aDefaultForm['cbOcupacion4_interes_1']='-1';
					$aDefaultForm['cbOcupacion3_interes_1']='-1';
					$aDefaultForm['cbOcupacionG_interes_1']='-1';
					$aDefaultForm['cbOcupacionE_interes_1']='-1';
					$aDefaultForm['cupos']='';
					$aDefaultForm['cupos_disponibles']='';
					$aDefaultForm['duracion']='';
					$aDefaultForm['costo']='';
					$aDefaultForm['fecha_inicio']='';
					$aDefaultForm['fecha_fin']='';
					$aDefaultForm['cbTipo_jornada']='-1'; 
					$aDefaultForm['hora1']='';
					$aDefaultForm['min1']='';
					$aDefaultForm['tiempo1']='';
					$aDefaultForm['hora2']='';
					$aDefaultForm['min2']='';
					$aDefaultForm['tiempo2']='';
										
					if ($_SESSION['registro']!=''){
					  $sfecha=date('Y-m-d');
					  $sql="insert into oferta_capacitacion (empresa_id, created_at, status, id_update) values
					  ('".$_SESSION['id_empresa']."',
					   '$sfecha',
					   'A',
					   '".$_SESSION['sUsuario']."')";
					   $conn->Execute($sql);
					   unset($_SESSION['registro']);
			   
			  		  $SQL="select max(id) from oferta_capacitacion 
					  where empresa_id='".$_SESSION['id_empresa']."' and created_at ='$sfecha'";
					  $rs1 = $conn->Execute($SQL);
					  if ($rs1->RecordCount()>0){ 				
						 $_SESSION['id_oferta']=$rs1->fields['max']; 
						 //Trazas-------------------------------------------------------------------------------------------------------------------------------				
						$id=$_SESSION['id_oferta'];
						$identi=$_SESSION['rif'];
						$us=$_SESSION['sUsuario'];
						$mod='19';			    
						$auditoria= new Trazas; 
						$auditoria->auditor($id,$identi,$sql,$us,$mod);
				
					   unset($_SESSION['registro']);
					  }				   	   
			      }
				  
        
	if (!$bPostBack){	
	
	        if ($_GET['id_po']!='') $_SESSION['id_oferta']=$_GET['id_po'];
			if ($_GET['id_emp']!='') $_SESSION['id_empresa']=$_GET['id_emp'];
		    $SQL="select * From public.oferta_capacitacion where id ='".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 
				 	$aDefaultForm['cbCurso_categoria']=$rs1->fields['curso_categoria_id'];
					$aDefaultForm['cbOcupacion5_interes_1']=$rs1->fields['ocupacion1'];
					?>	
				<script language="javascript" src="../js/jquery-1.2.6.min.js"></script>
				<script>
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['curso_categoria_id']; ?>";
					combo="Curso";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['curso_id']; ?>" },
					function(data){ $("#cbCurso").html(data);
					 });            
				});
				$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion1'] ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion2']; ?>" }, 
					function(data){  $("#cbOcupacion4_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion2'] ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion3']; ?>" }, 
					function(data){  $("#cbOcupacion3_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion3'] ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion4']; ?>" }, 
					function(data){  $("#cbOcupacionG_interes_1").html(data);
				   });            
				});
				
					$(document).ready(function(){
					elegido="<?php echo $rs1->fields['ocupacion4'] ?>";
					combo="Ocupacion";
					$.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['ocupacion5']; ?>" }, 
					function(data){  $("#cbOcupacionE_interes_1").html(data);
				   });            
				});
				</script>
				<?php
					$aDefaultForm['cbCertificado']=$rs1->fields['certificado'];					
					$aDefaultForm['cupos']=$rs1->fields['cupos'];
					$aDefaultForm['cupos_disponibles']=$_POST['cupos_disponibles']=$rs1->fields['cupos_disponibles'];
					$aDefaultForm['duracion']=$rs1->fields['duracion'];
					$aDefaultForm['costo']=$rs1->fields['costo'];
					$aDefaultForm['fecha_inicio']=$rs1->fields['f_inicio'];
					$aDefaultForm['fecha_fin']=$rs1->fields['f_culminacion'];
					$aDefaultForm['cbTipo_jornada']=$rs1->fields['turno_jornada_id'];
					
					$hora=explode(":",$rs1->fields['horario_desde']); 
					$aDefaultForm['hora1']=$hora[0];			
					$aDefaultForm['min1']=$hora[1];					
					$tiempo1=$hora[2];
					
					$hora2=explode(":",$rs1->fields['horario_hasta']); 
					$aDefaultForm['hora2']=$hora2[0];			
					$aDefaultForm['min2']=$hora2[1];					
					$tiempo2=$hora2[2];
					
					if ($tiempo1=='PM')$aDefaultForm['tiempo1']='0';
					if ($tiempo2=='PM')$aDefaultForm['tiempo2']='0';    
					if ($tiempo1=='AM')$aDefaultForm['tiempo1']='1';
					if ($tiempo2=='AM')$aDefaultForm['tiempo2']='1';
					
					//$aDefaultForm['horario_desde']=$rs1->fields['horario_desde'];
					//$aDefaultForm['horario_hasta']=$rs1->fields['horario_hasta'];
					
					} 
				}	
		else{   
					$aDefaultForm['cbCurso_categoria']=$_POST['cbCurso_categoria'];
					$aDefaultForm['cbCurso']=$_POST['cbCurso'];
					$aDefaultForm['cbCertificado']=$_POST['cbCertificado'];
					$aDefaultForm['cbOcupacion5_interes_1']=$_POST['cbOcupacion5_interes_1']; 
					$aDefaultForm['cbOcupacion4_interes_1']=$_POST['cbOcupacion4_interes_1']; 
					$aDefaultForm['cbOcupacion3_interes_1']=$_POST['cbOcupacion3_interes_1'];
					$aDefaultForm['cbOcupacionG_interes_1']=$_POST['cbOcupacionG_interes_1'];
					$aDefaultForm['cbOcupacionE_interes_1']=$_POST['cbOcupacionE_interes_1'];					
					$aDefaultForm['cupos']=$_POST['cupos'];
					$aDefaultForm['cupos_disponibles']=$_POST['cupos_disponibles'];
					$aDefaultForm['duracion']=$_POST['duracion']; 
					$aDefaultForm['costo']=$_POST['costo'];
					$aDefaultForm['fecha_inicio']=$_POST['fecha_inicio'];
					$aDefaultForm['fecha_fin']=$_POST['fecha_fin']; 
					$aDefaultForm['cbTipo_jornada']=$_POST['cbTipo_jornada']; 
					$aDefaultForm['hora1']=$_POST['hora1'];
					$aDefaultForm['min1']=$_POST['min1'];
					$aDefaultForm['tiempo1']=$_POST['tiempo1'];
					$aDefaultForm['hora2']=$_POST['hora2'];
					$aDefaultForm['min2']=$_POST['min2'];
					$aDefaultForm['tiempo2']=$_POST['tiempo2'];
					}
			}
} 
//------------------------------------------------------------------------------------------------------------------------------
 

function showHeader(){
 include('menu_oferta_cap.php');
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------ 
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="" >
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>
<script>
//Categoria capacitacion
$(document).ready(function(){
   $("#cbCurso_categoria").change(function () {
           $("#cbCurso_categoria option:selected").each(function () {
            elegido=$(this).val();
			combo='Curso';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbCurso").html(data);
            });            
        });
   })
});
//Ocupacion 1
$(document).ready(function(){
   $("#cbOcupacion5_interes_1").change(function () {
           $("#cbOcupacion5_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbOcupacion4_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion4_interes_1").change(function () {
           $("#cbOcupacion4_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacion3_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacion3_interes_1").change(function () {
           $("#cbOcupacion3_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionG_interes_1").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbOcupacionG_interes_1").change(function () {
           $("#cbOcupacionG_interes_1 option:selected").each(function () {
            elegido=$(this).val();
			combo='Ocupacion';
            $.post("mod_agencia_empleo/modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbOcupacionE_interes_1").html(data);
            });            
        });
   })
});


</script>

   <input name="action" type="hidden" value=""/>
	 <input name="cupos_disponibles" type="hidden" value="<?=$_POST['cupos_disponibles']?>"/>

        <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
   		 <td colspan="2"></td>
       </tr>
        <tr>
    		<th colspan="2" class="sub_titulo" align="left">Datos principales:</th>
        </tr> 
        <tr>
          <td height="24"><div align="right">Categoria de oportunidad capacitaci&oacute;n: </div></td>
          <td width="57%"><span class="links-menu-izq">
            <select name="cbCurso_categoria" id="cbCurso_categoria" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccionar</option>
              <? LoadCurso_categoria ($conn) ; print $GLOBALS['sHtml_cb_Curso_categoria']; ?>
            </select>
          <span class="requerido">*</span></span></td>
        </tr>
        <tr>
          <td height="24"><div align="right">Nombre de la oportunidad de capacitaci&oacute;n:</div></td>
          <td class="links-menu-izq"><span class="requerido">
            <select name="cbCurso" id="cbCurso" class="tablaborde_shadow">
              <option value="-1">Seleccionar</option>
            </select>
          </span><span class="requerido">* </span></td>
          </tr>
        <tr>
          <td><div align="right"><span class="links-menu-izq"><i> Otra Oportunidad de Capacitaci&oacute;n:</i></span></div></td>
          <td><span class="links-menu-izq"><span class="requerido">
          <input name="otro_curso" type="text" class="tablaborde_shadow" id="otro_curso" value="<?=$aDefaultForm['otro_curso']?>"size="25" maxlength="100" />
          <input name="btCurso" type="submit" class="tablaborde_info" onClick="javascript:send('btCurso')" value="+"/>
          </span></span></td>
        </tr>
        <tr>
          <td><div align="right">Ocupaci&oacute;n detalle:</div></td>
          <td><select name="cbOcupacion5_interes_1" id="cbOcupacion5_interes_1" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione...</option>
            <? LoadOcupacion5_interes_1($conn, $param) ; print $GLOBALS['sHtml_cb_Ocupacion5_interes_1']; ?>
          </select></td>
          </tr>
        <tr>
          <td><div align="right">Ocupaci&oacute;n sub especifica: </div></td>
          <td><select name="cbOcupacion4_interes_1" id="cbOcupacion4_interes_1" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione...</option>
          </select></td>
          </tr>
        <tr>
          <td><div align="right">Ocupaci&oacute;n Espec&iacute;fica: </div></td>
          <td><select name="cbOcupacion3_interes_1" id="cbOcupacion3_interes_1" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione...</option>
          </select></td>
          </tr>
        <tr>
          <td><div align="right">Ocupaci&oacute;n general: </div></td>
          <td><select name="cbOcupacionG_interes_1" id="cbOcupacionG_interes_1" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione...</option>
          </select></td>
          </tr>
        <tr>
          <td><div align="right">Ocupaci&oacute;n:</div></td>
          <td><select name="cbOcupacionE_interes_1" id="cbOcupacionE_interes_1" class="tablaborde_shadow">
            <option value="-1" selected="selected">Seleccione...</option>
          </select></td>
          </tr>
        <tr>
          <td><div align="right">Otorga certificado?:</div></td>
          <td><select name="cbCertificado" class="tablaborde_shadow">
              <option value="1" <? if (($aDefaultForm['cbCertificado'])=='1') print 'selected="selected"';?>>Si</option>
              <option value="0" <? if (($aDefaultForm['cbCertificado'])=='0') print 'selected="selected"';?>>No</option>
            </select>
              <span class="requerido">*</span></td>
          </tr>
        <tr>
          <td width="43%"><div align="right">Nro. de participantes:</div></td>
          <td><input name="cupos" type="text" class="tablaborde_shadow" id="cupos" onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['cupos']?>" size="5" maxlength="5" />
          <span class="requerido"> *</span> Cupos Disponibles: 
          <?=$aDefaultForm['cupos_disponibles']?></td>
        </tr>
        <tr>
          <td><div align="right">Duraci&oacute;n: </div></td>
          <td><input name="duracion" type="text" class="tablaborde_shadow" id="duracion" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['duracion']?>" size="5" maxlength="5" />
            Horas
          <span class="requerido"> *</span></td>
          </tr>
        <tr>
          <td><div align="right">Precio: </div></td>
          <td><input name="costo" type="text" class="tablaborde_shadow" id="costo" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['costo']?>" size="10" maxlength="10" />
          <span class="requerido">*</span></td>
          </tr>
        <tr>
          <td><div align="right">Fecha de inicio:</div></td>
          <td><input name="fecha_inicio" type="text" class="tablaborde_shadow" id="fecha_inicio" value="<?=$aDefaultForm['fecha_inicio']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger"><img src="imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "fecha_inicio",
        trigger    : "f_rangeStart_trigger",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script><span class="requerido">*</span></td>
          </tr>
        <tr>
          <td><div align="right">Fecha de culminaci&oacute;n </div></td>
          <td><input name="fecha_fin" type="text" class="tablaborde_shadow" id="fecha_fin" value="<?=$aDefaultForm['fecha_fin']?>" size="10" readonly/>
        <a href="#" id="f_rangeStart_trigger1"><img src="imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
        <script type="text/javascript">//<![CDATA[
        Calendar.setup({
        inputField : "fecha_fin",
        trigger    : "f_rangeStart_trigger1",
				
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d"
        });
        </script><span class="requerido">*</span></td>
          </tr>
        <tr>
          <td><div align="right">Tipo de jornada: </div></td>
          <td><span class="links-menu-izq">
            <select name="cbTipo_jornada" class="tablaborde_shadow">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadTipo_jornada($conn); print $GLOBALS['sHtml_cb_Tipo_jornada'];?>
            </select>
          </span><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right">Horario: </div></td>
          <td>Desde
              
            <select name="hora1" class="tablaborde_shadow">
			 <? for( $i='01'; $i<'13'; $i++){ ?>
              <option value=<?=$i?> <? if (($aDefaultForm['hora1'])==$i) print "selected=\"selected\"";?>><?=str_pad($i,2,'0', STR_PAD_LEFT)?></option>
			  <? } ?>
            </select>
            :
            <select name="min1" class="tablaborde_shadow">
			 <? for( $i='00'; $i<'60'; $i++){ ?>
              <option value=<?=$i?> <? if (($aDefaultForm['min1'])==$i) print "selected=\"selected\"";?>><?=str_pad($i,2,'0', STR_PAD_LEFT)?></option>
			  <? } ?>
            </select>
            <select name="tiempo1" class="tablaborde_shadow">
              <option value="1" <? if (($aDefaultForm['tiempo1'])=='1') print "selected=\"selected\"";?>>AM</option>
              <option value="0" <? if (($aDefaultForm['tiempo1'])=='0') print "selected=\"selected\"";?>>PM</option>
            </select>
          <span class="requerido">*</span></td>
          </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3">Hasta  
            <select name="hora2" class="tablaborde_shadow">
              <? for( $i='01'; $i<'13'; $i++){ ?>
              <option value=<?=$i?> <? if (($aDefaultForm['hora2'])==$i) print 'selected="selected"';?>>
                <?=str_pad($i,2,'0', STR_PAD_LEFT)?>
              </option>
              <? } ?>
            </select>
            :
            
            <select name="min2" class="tablaborde_shadow">
              <? for( $i='00'; $i<'60'; $i++){ ?>
              <option value=<?=$i?> <? if (($aDefaultForm['min2'])==$i) print 'selected="selected"';?>>
              <?=str_pad($i,2,'0', STR_PAD_LEFT)?>
              </option>
              <? } ?>
            </select>
            <select name="tiempo2" class="tablaborde_shadow">
              <option value="1" <? if (($aDefaultForm['tiempo2'])=='1') print 'selected="selected"';?>>AM</option>
              <option value="0" <? if (($aDefaultForm['tiempo2'])=='0') print 'selected="selected"';?>>PM</option>
            </select>
            <span class="requerido">*</span>            </td>
        </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
          <td colspan="3" class="requerido"></td>
        </tr>
        <tr>
          <td colspan="4" class="link-clave-ruee">
          <div align="center">
          <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button></div></td>
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

<?php //include('../footer.php'); ?>
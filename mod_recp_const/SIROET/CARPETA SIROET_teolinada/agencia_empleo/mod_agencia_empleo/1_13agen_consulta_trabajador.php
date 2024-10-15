<?php
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
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
		var_dump($_SESSION);
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		    
			case 'cbEstado_afiliado_changed':
			    LoadData($conn,true);
			break;
			
			case 'cbNivel_academico_changed':
		   		LoadData($conn,true);
			break;
			
			 case 'cbSituacion_afiliado_changed':
			    LoadData($conn,true);
			break;
			
			case 'cbCarreraCon_changed':
			    LoadData($conn,true);
				$param = '';
				  if  ($_POST['carrera']!='')
				  $param= " and nombre ilike '%".$_POST['carrera']."%' "; 
				  LoadCarreraCon($conn,$param);
			break;
			
			case 'cbOcupacion5_interes_1_changed':
			    LoadData($conn,true);
				$param = '';
				  if  ($_POST['ocupacion']!='')
				  $param= " and nombre ilike '%".$_POST['ocupacion']."%' ";
				LoadOcupacion5_interes_1($conn, $param);
			break;
			
		
			case 'Buscar':			     
			LoadData($conn,true);
			break;
				
			case 'Culminar':
			unset($_SESSION['where']);
			unset($_SESSION['where1']);
			unset($_SESSION['where2']);
			unset($_SESSION['criterio']);
			unset($_SESSION['aTabla']);
			LoadData($conn,false);
			break;
		
			case 'Agregar': 
			unset($_SESSION['criterio']);
			unset($_SESSION['where']);
			unset($_SESSION['where1']);
			unset($_SESSION['where2']);		
			$bValidateSuccess = true;
						
		
						
			 if ($_POST['Ced_afiliado']!=''){
			    if ($_POST['cbCed_afiliado']=="V" or $_POST['cbCed_afiliado']=="E"){
				if (!ereg("^[0-9]{8}$", $_POST['Ced_afiliado'])){ 
					$GLOBALS['aPageErrors'][]= "- La Cedula del afiliado: debe tener ocho digitos numericos.";
					$bValidateSuccess=false;
					}
				else{
				    $_POST['ced_afiliado']=$_POST['cbCed_afiliado'].$_POST['Ced_afiliado'];
				    $_SESSION['where'].= " and personas.cedula='".$_POST['ced_afiliado']."'"; 
					$_SESSION['criterio'].=' Cedula -';	
				    }
			      }
			 
			if ($_POST['cbCed_afiliado']=="P"){
				if (!ereg("^[0-9]{10}$", $_POST['Ced_afiliado'])){ 
					$GLOBALS['aPageErrors'][]= "- La Cedula del afiliado: debe tener diez digitos numericos.";
					$bValidateSuccess=false;
					}	
				else{
				    $_POST['ced_afiliado']=$_POST['cbCed_afiliado'].$_POST['Ced_afiliado'];
				    $_SESSION['where'].= " and personas.cedula='".$_POST['ced_afiliado']."'"; 	
					$_SESSION['criterio'].=' Cedula -';	
				    }
			      }
				}
				 				 
			 if  ($_POST['fafiliado_desde']!='' or $_POST['fafiliado_hasta']!='' ){		
		   		  if ($_POST['fafiliado_desde']=='' or $_POST['fafiliado_hasta']=='' ){
		      	     $GLOBALS['aPageErrors'][]= "- Debe seleccionar ambas fechas de afiliación.";
				     $bValidateSuccess=false;
				  }
		          else{
				       list($a,$m,$d)=explode("-", $_POST['fafiliado_desde']);
				       $_POST['fafiliado_desde']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
				
				       list($a,$m,$d)=explode("-", $_POST['fafiliado_hasta']);
				       $_POST['fafiliado_hasta']= $a.'-'.str_pad($m,2,'0',STR_PAD_LEFT ).'-'.$d;
				
				       $_SESSION['criterio'].=' Fecha de Afiliación -';
			           $_SESSION['where'].= " and  (personas.created_at between '".$_POST['fafiliado_desde']."' and  '".$_POST['fafiliado_hasta']."') ";
				       $bValidateSuccess=true;
			          }
			   }
					 			
			if ($_POST['cbNacionalidad_afiliado']!="-1"){
					$_SESSION['criterio'].=' Nacionalidad -';
					$_SESSION['where'].= " and personas.nacionalidad= '".$_POST['cbNacionalidad_afiliado']."'";   
					$bValidateSuccess=true;
				 	}
					
			if ($_POST['cbSexo_afiliado']!="-1"){
					$_SESSION['criterio'].=' Sexo -';
					$_SESSION['where'].= " and personas.sexo= '".$_POST['cbSexo_afiliado']."'";   
					$bValidateSuccess=true;
				 	}
					
			if ($_POST['cbMigrante_afiliado']!="-1"){
					$_SESSION['criterio'].=' Migrante -';
					$_SESSION['where'].= " and personas.migrante= '".$_POST['cbMigrante_afiliado']."'";   
					$bValidateSuccess=true;
				 	}  
			
			if ($_POST['cbDiscapacidad_afiliado']!="-1"){
					$_SESSION['criterio'].=' Discapacidad -';
					$_SESSION['where'].= " and personas.discapacidad= '".$_POST['cbDiscapacidad_afiliado']."'";   
					$bValidateSuccess=true;
				 	}
			
			if ($_POST['cbParticipacion']!="-1"){
					$_SESSION['criterio'].=' Participación en Consejos Comunales -';
					$_SESSION['where'].= " and personas.consejo_com= '".$_POST['cbParticipacion']."'";   
					$bValidateSuccess=true;
				 	} 
					
			if  ($_POST['Edad_desde']!='' or $_POST['Edad_hasta']!='' ){		
		   		  if ($_POST['Edad_desde']=='' or $_POST['Edad_hasta']=='' ){
		      	     $GLOBALS['aPageErrors'][]= "- Debe seleccionar ambas Edades.";
				     $bValidateSuccess=false;
				  }
		          else{				
				       $_SESSION['criterio'].=' Edad -';
			           $_SESSION['where'].= " and  (personas.edad between '".$_POST['Edad_desde']."' and  '".$_POST['Edad_hasta']."') ";
				       $bValidateSuccess=true;
			          }
			   }
			   // OJO FALTA VALIDAR
			 if  ($_POST['cbSituacion_afiliado']!='' or $_POST['cbTipo_situacion_afiliado']!='' ){		
		   		  if ($_POST['cbSituacion_afiliado']=='-1' or $_POST['cbTipo_situacion_afiliado']=='-1' ){
		      	     $GLOBALS['aPageErrors'][]= "- Debe seleccionar ambos campos de Situación ocupacional.";
				     $bValidateSuccess=false;
				  }
		          else{				
				       $_SESSION['criterio'].=' Situación Ocupacional -';
			           $_SESSION['where'].= " and persona_pref_ocupacion.situacion_actual='".$_POST['cbSituacion_afiliado']."' and persona_pref_ocupacion.tipo_situacion_actual='".$_POST['cbTipo_situacion_afiliado']."'";
				       $bValidateSuccess=true;
			          }
			   }
			   
			    if  ($_POST['cbOcupacion5_interes_1']!='-1'){		
		   		  	   $_SESSION['criterio'].=' Ocupación -';
			           $_SESSION['where'].= " and persona_pref_ocupacion.ocupacion5_1='".$_POST['cbOcupacion5_interes_1']."' ";
				       $bValidateSuccess=true;
			     }
				 
				 if  ($_POST['cbEstado_afiliado']!='-1'){		
		   		  	   $_SESSION['criterio'].=' Estado -';
			           $_SESSION['where'].= " and personas.estado_residencia='".$_POST['cbEstado_afiliado']."' ";
				       $bValidateSuccess=true;
			     }
				 if  ($_POST['cbMunicipio_afiliado']!=''){		
		   		  	   $_SESSION['criterio'].=' Municipio -';
			           $_SESSION['where'].= " and personas.municipio_id='".$_POST['cbMunicipio_afiliado']."' ";
				       $bValidateSuccess=true;
			     }
				 if  ($_POST['cbParroquia_afiliado']!=''){		
		   		  	   $_SESSION['criterio'].=' Parroquia -';
			           $_SESSION['where'].= " and personas.parroquia_id='".$_POST['cbParroquia_afiliado']."' ";
				       $bValidateSuccess=true;
			     }
					 
					if ($_POST['cbPasantias']!="-1"){
					 $_SESSION['criterio'].=' Pasantias -';
					 $_SESSION['where'].= " and persona_nivel_instruccion.pasantias='".$_POST['cbPasantias']."' ";
					
					
					
					 $_SESSION['where1'].= ", persona_nivel_instruccion.pasantias as pasantias ";
					 $_SESSION['where2'].= " left JOIN persona_nivel_instruccion ON persona_nivel_instruccion.persona_id=personas.id ".
					   						 " left JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id ";   
					$bValidateSuccess=true;
				 	}
					
				 if  ($_POST['cbNivel_academico']!='-1'){			   		  	
				     $_SESSION['criterio'].=' Nivel Educativo -';
			       $_SESSION['where'].= " and persona_nivel_instruccion.nivel_instruccion_id='".$_POST['cbNivel_academico']."' ";
					 
					 
					   $_SESSION['where1'].= ", nivel_instruccion.nombre as nivel_instruccion ";
					   $_SESSION['where2'].= " left JOIN persona_nivel_instruccion ON persona_nivel_instruccion.persona_id=personas.id ".
					   						 " left JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id ";  
				       $bValidateSuccess=true;
			     }		
					  
						
			if ($bValidateSuccess){
				ProcessForm($conn);
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
	if (!$bPostBack){
	        unset($_SESSION['aTabla'] );
					unset($_SESSION['where']);
					unset($_SESSION['where1']);
					unset($_SESSION['where2']);	
					$aDefaultForm['ced_afiliado']='';
					$aDefaultForm['fafiliado_desde']='';
					$aDefaultForm['fafiliado_hasta']='';
					$aDefaultForm['cbNacionalidad_afiliado']='-1';					
					$aDefaultForm['cbSexo_afiliado']='-1';
					$aDefaultForm['Edad_desde']='';
					$aDefaultForm['Edad_hasta']='';
					$aDefaultForm['cbMigrante_afiliado']='-1';
					$aDefaultForm['cbDiscapacidad_afiliado']='-1'; 
					$aDefaultForm['cbPasantias']='-1';
					$aDefaultForm['cbNivel_academico']='-1';
					$aDefaultForm['cbCarreraCon']='-1';
					$aDefaultForm['cbParticipacion']='-1';
					$aDefaultForm['cbSituacion_afiliado']='-1';		
					$aDefaultForm['cbTipo_situacion_afiliado']='';			 	
					$aDefaultForm['cbOcupacion5_interes_1']='-1'; 
					$aDefaultForm['cbEstado_afiliado']='-1';
					$aDefaultForm['cbMunicipio_afiliado']='';
					$aDefaultForm['cbParroquia_afiliado']=''; 
					}	
		else{   
					$aDefaultForm['ced_afiliado']=$_POST['ced_afiliado'];
					$aDefaultForm['fafiliado_desde']=$_POST['fafiliado_desde'];
					$aDefaultForm['fafiliado_hasta']=$_POST['fafiliado_hasta'];
					$aDefaultForm['cbNacionalidad_afiliado']=$_POST['cbNacionalidad_afiliado'];
					$aDefaultForm['cbSexo_afiliado']=$_POST['cbSexo_afiliado'];
					$aDefaultForm['Edad_desde']=$_POST['Edad_desde'];
					$aDefaultForm['Edad_hasta']=$_POST['Edad_hasta'];
					$aDefaultForm['cbMigrante_afiliado']=$_POST['cbMigrante_afiliado'];
					$aDefaultForm['cbDiscapacidad_afiliado']=$_POST['cbDiscapacidad_afiliado']; 
					$aDefaultForm['cbPasantias']=$_POST['cbPasantias'];
					$aDefaultForm['cbNivel_academico']=$_POST['cbNivel_academico'];
					$aDefaultForm['cbCarreraCon']=$_POST['cbCarreraCon'];
					$aDefaultForm['cbParticipacion']=$_POST['cbParticipacion'];
					$aDefaultForm['cbSituacion_afiliado']=$_POST['cbSituacion_afiliado'];
					$aDefaultForm['cbTipo_situacion_afiliado']=$_POST['cbTipo_situacion_afiliado'];
					$aDefaultForm['cbOcupacion5_interes_1']=$_POST['cbOcupacion5_interes_1'];
					$aDefaultForm['cbEstado_afiliado']=$_POST['cbEstado_afiliado']; 
					?>	
				<script language="javascript" src="../js/jquery-1.2.6.min.js"></script>
				<script>
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbSituacion_afiliado']; ?>";
				combo="condicion";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbTipo_situacion_afiliado']; ?>" }, 
				function(data){ $("#cbTipo_situacion_afiliado").html(data);
				});            
				});
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbEstado_afiliado']; ?>";
				combo="Municipio";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbMunicipio_afiliado']; ?>" }, 
				function(data){ $("#cbMunicipio_afiliado").html(data);
				});            
				});
				$(document).ready(function(){
				elegido="<?php echo $_POST['cbMunicipio_afiliado']; ?>";
				combo="Parroquia";
				$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['cbParroquia_afiliado']; ?>" },
				function(data){  $("#cbParroquia_afiliado").html(data);
				});            
				});
				</script>
				<?php
					
			}
		}
} 
//---------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){

	  $SQL= "select 
				personas.id as id_afiliado, 
				personas.nombres, 
				personas.apellidos, 
				personas.cedula, 
				personas.nacionalidad, 
				personas.sexo, 
				personas.edad, 
				personas.f_nacimiento, 
				personas.created_at, 
				personas.migrante, 
				personas.discapacidad, 
				personas.consejo_com,
				persona_pref_ocupacion.situacion_actual,
				persona_pref_ocupacion.experiencia1, 
				situacion_laboral.nombre as situacion, 
				ocupacion.nombre as ocupacion1, 
				estado.nombre as estado,
				municipio.nombre as municipio,
				parroquia.nombre as parroquia,
				nivel_instruccion.nombre as nivel_instruccion,
				persona_nivel_instruccion.pasantias as pasantias
				From public.personas 
				left JOIN estado ON estado.id=personas.estado_residencia 
				left JOIN municipio ON municipio.id=personas.municipio_id 
				left JOIN parroquia ON parroquia.id=personas.parroquia_id 
				left JOIN persona_pref_ocupacion ON persona_pref_ocupacion.persona_id=personas.id 
				left JOIN situacion_laboral ON situacion_laboral.id=persona_pref_ocupacion.tipo_situacion_actual 
				left JOIN ocupacion ON ocupacion.cod=persona_pref_ocupacion.ocupacion5_1 
				left JOIN persona_nivel_instruccion ON persona_nivel_instruccion.persona_id=personas.id 
				left JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id   
			where personas.status='A' ".$_SESSION['where']." order by  personas.id";   
		    $rs = $conn->Execute($SQL);
			if ($rs->RecordCount()>0){	
				while(!$rs->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;					
					$aTabla[$c]['id']=$_POST['id_persona']=$rs->fields['id_afiliado'];
					$aTabla[$c]['nombres']=$rs->fields['nombres'];
					$aTabla[$c]['apellidos']=$rs->fields['apellidos'];
					$aTabla[$c]['cedula']=$rs->fields['cedula'];
					$sexo=$rs->fields['sexo'];	 
					if($sexo=='2') $aTabla[$c]['sexo']='M';
					if($sexo=='1') $aTabla[$c]['sexo']='F';	
					$aTabla[$c]['edad']=$rs->fields['edad'];
					$aTabla[$c]['estado']=$rs->fields['estado'];
					$discapacidad=$rs->fields['discapacidad'];	 
					if($discapacidad=='0') $aTabla[$c]['discapacidad']='No';
					if($discapacidad=='1') $aTabla[$c]['discapacidad']='Si';
					$aTabla[$c]['estado']=$rs->fields['estado']; 
					$aTabla[$c]['municipio']=$rs->fields['municipio'];
					$aTabla[$c]['parroquia']=$rs->fields['parroquia'];
					$discapacidad=$rs->fields['discapacidad'];	 
					if($discapacidad=='0') $aTabla[$c]['discapacidad']='No';
					if($discapacidad=='1') $aTabla[$c]['discapacidad']='Si';
					$migrante=$rs->fields['migrante'];	 
					if($migrante=='0') $aTabla[$c]['migrante']='No';
					if($migrante=='1') $aTabla[$c]['migrante']='Si';
					$consejo_com=$rs->fields['consejo_com'];	 
					if($consejo_com=='0') $aTabla[$c]['consejo_com']='No';
					if($consejo_com=='1') $aTabla[$c]['consejo_com']='Si';
					$pdpie=$rs->fields['pdpie'];	 
					if($pdpie=='0') $aTabla[$c]['pdpie']='No';
					if($pdpie=='1') $aTabla[$c]['pdpie']='Si';
					$aTabla[$c]['created_at']=$rs->fields['created_at'];
					$situacion_actual=$rs->fields['situacion_actual'];	 
					if($situacion_actual=='1') $aTabla[$c]['situacion_actual']='Buscando trabajo';
					if($situacion_actual=='2') $aTabla[$c]['situacion_actual']='No Busca trabajo';
					$aTabla[$c]['situacion']=$rs->fields['situacion'];
					$aTabla[$c]['ocupacion1']=$rs->fields['ocupacion1'];
					$experiencia1=$rs->fields['experiencia1'];	 
					if($experiencia1=='0') $aTabla[$c]['experiencia1']='No';
					if($experiencia1=='1') $aTabla[$c]['experiencia1']='Si'; 
					$pasantias=$rs->fields['pasantias'];	 
					if($pasantias=='0') $aTabla[$c]['pasantias']='No';
					if($pasantias=='1') $aTabla[$c]['pasantias']='Si'; 
					$aTabla[$c]['nivel_instruccion']=$rs->fields['nivel_instruccion'];
					$rs->MoveNext();
		           }
					$_SESSION['aTabla'] = $aTabla;		 
	           
						  }
			else{
			unset($_SESSION['aTabla']);
			?><script>alert("- No existen registros asociados");</script><?			
			}
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php');
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=es-utf-8" >
<link href="../styles/style.css" rel="stylesheet" type="text/css" />
<title>Agencia Empleo</title>
<script type="text/javascript" src="validar_trabajador.js"></script>
<script src="../js/JSCal2-1.9/src/js/jscal2.js"></script>
<script src="../js/JSCal2-1.9/src/js/lang/es.js"></script>
<link href="../js/JSCal2-1.9/src/css/steel/steel.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../js/JSCal2-1.9/src/css/jscal2.css" />
<link type="text/css" rel="stylesheet" href="../js/JSCal2-1.9/src/css/border-radius.css" />
<link type="text/css" rel="stylesheet" href="../js/JSCal2-1.9/src/css/reduce-spacing.css" /> 
<script src="../js/JSCal2-1.9/src/js/unicode-letter.js"></script>
<!--esto es combos dependientes con jq-->
<script language="javascript" src="../js/jquery-1.2.6.min.js"></script>
<script language="javascript"></script>  
</head>
<body>
<?php
}

//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>

<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >

<script>
//Situacion Ocupacion
$(document).ready(function(){
   $("#cbSituacion_afiliado").change(function () {
           $("#cbSituacion_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='condicion';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbTipo_situacion_afiliado").html(data);
            });            
        });
   })
});

//Estado Residencia
$(document).ready(function(){
   $("#cbPais_afiliado").change(function () {
           $("#cbPais_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Estado';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbEstado_afiliado").html(data);
            });            
        });
   })
});
//Municipio---Parroquia residencia
$(document).ready(function(){
   $("#cbEstado_afiliado").change(function () {
           $("#cbEstado_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Municipio';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbMunicipio_afiliado").html(data);
            });            
        });
   })
});

$(document).ready(function(){
   $("#cbMunicipio_afiliado").change(function () {
           $("#cbMunicipio_afiliado option:selected").each(function () {
            elegido=$(this).val();
			combo='Parroquia';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
            $("#cbParroquia_afiliado").html(data);
            });            
        });
   })
});

function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>

    <input name="action" type="hidden" value=""/>
	       <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
             <tr>
             <th colspan="3" class="titulo">CONSULTA DE TRABAJADORES(AS)</th>
             </tr>
             <tr >
               <td colspan="2">&nbsp;</td>
             </tr>
             <tr >
               <td><div align="right">C&eacute;dula de  identidad: </div></td>
               <td><select name="cbCed_afiliado" class="tablaborde_shadow">
                   <option value="V" <? if (($aDefaultForm['cbCed_afiliado'])=='V') print 'selected="selected"';?>>V</option>
                   <option value="E" <? if (($aDefaultForm['cbCed_afiliado'])=='E') print 'selected="selected"';?>>E</option>
                 </select>
                   <input name="Ced_afiliado" type="text" class="tablaborde_shadow" id="Ced_afiliado"  onKeyPress="return permite(event, 'num')" value="<?=$aDefaultForm['Ced_afiliado']?>" size="20" maxlength="20" /></td>
             </tr>
             <tr>
               <td width="33%" height="14" ><div align="right">Fecha de afiliación: </div></td>
               <td width="67%" height="14" ><div align="left" class="links-menu-izq"><em> Desde:
		  <input name="fafiliado_desde" type="text" class="tablaborde_shadow" id="fafiliado_desde" value="<?=$aDefaultForm['fafiliado_desde']?>" size="10" readonly/>
                <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                <script type="text/javascript">//<![CDATA[
                             Calendar.setup({
                               inputField : "fafiliado_desde",
                               trigger    : "f_rangeStart_trigger",
                               onSelect   : function() { this.hide() },
                               showTime   : false,
                               dateFormat : "%Y-%m-%d"
                             });
                           </script>
                           	
             <input name="fafiliado_hasta" type="text" class="tablaborde_shadow" id="fafiliado_hasta" value="<?=$aDefaultForm['fafiliado_hasta']?>" size="10" readonly/>
                <a href="#" id="f_rangeStart_trigger1"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                <script type="text/javascript">//<![CDATA[
                             Calendar.setup({
                               inputField : "fafiliado_hasta",
                               trigger    : "f_rangeStart_trigger1",
                               onSelect   : function() { this.hide() },
                               showTime   : false,
                               dateFormat : "%Y-%m-%d"
                             });
                           </script>	
                           
                           </td>
             </tr>
             <tr >
               <td><div align="right">Nacionalidad:</div></td>
               <td><select name="cbNacionalidad_afiliado" class="tablaborde_shadow">
                   <option value="-1" selected="selected">Seleccione</option>
                   <option value="1" <? if (($aDefaultForm['cbNacionalidad_afiliado'])=='1') print "selected=\"selected\"";?>>Venezolana</option>
                   <option value="2" <? if (($aDefaultForm['cbNacionalidad_afiliado'])=='2') print "selected=\"selected\"";?>>Extranjera</option>
               </select></td>
             </tr>
             <tr >
               <td height="26"><div align="right">Sexo:</div></td>
               <td><select name="cbSexo_afiliado" class="tablaborde_shadow">
                   <option value="-1" selected="selected">Seleccione</option>
                   <option value="1" <? if (($aDefaultForm['cbSexo_afiliado'])=='1') print "selected=\"selected\"";?>>Femenino</option>
                   <option value="2" <? if (($aDefaultForm['cbSexo_afiliado'])=='2') print "selected=\"selected\"";?>>Masculino</option>
               </select></td>
             </tr>
             <tr>
               <td height="14" ><div align="right">Edad:</div></td>
               <td height="14" ><span class="links-menu-izq">Entre </span><span class="links-menu-izq">
                 <input name="Edad_desde" type="text" class="tablaborde_shadow" id="Edad_desde" value="<?=$aDefaultForm['Edad_desde']?>"size="5" maxlength="2" />
                 </span><span class="links-menu-izq"> y </span><span class="links-menu-izq">
                 <input name="Edad_hasta" type="text" class="tablaborde_shadow" id="Edad_hasta" value="<?=$aDefaultForm['Edad_hasta']?>"size="5" maxlength="2" />
               </span><span class="links-menu-izq">Años </span></td>
             </tr>
             <tr >
               <td><div align="right">Migrante:</div></td>
               <td><select name="cbMigrante_afiliado" class="tablaborde_shadow">
                   <option value="-1" selected="selected">Seleccione</option>
                   <option value="1" <? if (($aDefaultForm['cbMigrante_afiliado'])=='1') print 'selected="selected"';?>>Si</option>
                   <option value="0" <? if (($aDefaultForm['cbMigrante_afiliado'])=='0') print 'selected="selected"';?>>No</option>
               </select></td>
             </tr>
             <tr >
               <td><div align="right">Posea discapacidad:</div></td>
               <td><select name="cbDiscapacidad_afiliado" class="tablaborde_shadow">
                   <option value="-1" selected="selected">Seleccione</option>
                   <option value="1" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='1') print 'selected="selected"';?>>Si</option>
                   <option value="0" <? if (($aDefaultForm['cbDiscapacidad_afiliado'])=='0') print 'selected="selected"';?>>No</option>
               </select></td>
             </tr>
             <tr >
               <td><div align="right">Participación comunitaria?:</div></td>
               <td><select name="cbParticipacion" class="tablaborde_shadow">
                   <option value="-1" selected="selected">Seleccione</option>
                   <option value="1" <? if ($aDefaultForm['cbParticipacion']=='1') print 'selected="selected"';?>>Si</option>
                   <option value="0" <? if ($aDefaultForm['cbParticipacion']=='0') print 'selected="selected"';?>>No</option>
               </select></td>
             </tr>
             <tr >
               <td><div align="right">Situaci&oacute;n ocupacional:</div></td>
               <td><select name="cbSituacion_afiliado" id="cbSituacion_afiliado" class="tablaborde_shadow">
                   <option value="" selected="selected">Seleccione</option>
                   <option value="1" <? if (($aDefaultForm['cbSituacion_afiliado'])=='1') print 'selected="selected"';?>>Buscando trabajo</option>
                   <option value="2" <? if (($aDefaultForm['cbSituacion_afiliado'])=='2') print 'selected="selected"';?>>No busca trabajo</option>
                 </select>
                   <span class="requerido">
                   <select name="cbTipo_situacion_afiliado" id="cbTipo_situacion_afiliado" class="tablaborde_shadow">
                     <option value="" selected="selected">Seleccione...</option>
                   </select>
                 </span></td>
             </tr>
             <tr>
               <td ><div align="right"><span class="links-menu-izq"><i>Buscar Ocupación Primera Opción:</i></span></div></td>
               <td ><input name= "ocupacion" type="text" class="tablaborde_shadow" id="ocupacion" value="<?=$aDefaultForm['ocupacion'];?>" size="15" maxlength="20" autocomplete="on" onChange="javascript:send('cbOcupacion5_interes_1_changed');"/></td>
             </tr>
             <tr>
               <td ><div align="right">Ocupación detalle:</div></td>
               <td ><span class="requerido">
                 <select name="cbOcupacion5_interes_1" class="tablaborde_shadow" onChange="javascript:send('cbOcupacion5_interes_1_changed');">
                   <option value="-1" selected="selected">Seleccione...</option>
                   <? LoadOcupacion5_interes_1($conn, $param); print $GLOBALS['sHtml_cb_Ocupacion5_interes_1'];?>
                 </select>
               </span></td>
             </tr>
             <tr>
               <td ><div align="right">Nivel educativo:</div></td>
               <td ><select name="cbNivel_academico" id="cbNivel_academico" class="tablaborde_shadow">
                   <option value="-1" selected="selected">Seleccione...</option>
                   <? LoadNivel_academico($conn) ; print $GLOBALS['sHtml_cb_Nivel_academico']; ?>
               </select></td>
             </tr>
             <tr>
               <td ><div align="right">¿Requiere pasant&iacute;as?:</div></td>
               <td ><select name="cbPasantias" class="tablaborde_shadow">
                 <option value="-1" selected="selected">Seleccione</option>
                 <option value="1" <? if (($aDefaultForm['cbPasantias'])=='1') print 'selected="selected"';?>>Si</option>
                 <option value="0" <? if (($aDefaultForm['cbPasantias'])=='0') print 'selected="selected"';?>>No</option>
               </select></td>
             </tr>
             <tr>
               <td ><div align="right">Estado de residencia:</div></td>
               <td ><span class="links-menu-izq">
                 <select name="cbEstado_afiliado" id="cbEstado_afiliado" class="tablaborde_shadow">
                   <option value="-1" selected="selected">Seleccione...</option>
                   <? LoadEstado_afiliado ($conn) ; print $GLOBALS['sHtml_cb_Estado_afiliado']; ?>
                 </select>
               </span></td>
             </tr>
             <tr>
               <td height="22" ><div align="right">Municipio de residencia:</div></td>
               <td ><span class="links-menu-izq">
                 <select name="cbMunicipio_afiliado" id="cbMunicipio_afiliado" class="tablaborde_shadow">
                   <option value="">Seleccionar</option>
                 </select>
               </span></td>
             </tr>
             <tr>
               <td ><div align="right">Parroquia de residencia:</div></td>
               <td ><span class="links-menu-izq">
                 <select name="cbParroquia_afiliado" id="cbParroquia_afiliado" class="tablaborde_shadow">
                   <option value="">Seleccionar</option>
                 </select>
               </span></td>
             </tr>
             <tr>
               <td height="14" >&nbsp;</td>
               <td height="14" >&nbsp;</td>
             </tr>
             <tr>
               <td height="14" colspan="2" ><div align="center"><em class="link-info"><span class="requerido">
          <button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Aceptar</button>
          <button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Culminar');">Cancelar</button>
                  
               </span></em></div>
			   <? if(isset($_SESSION['aTabla'])){ ?><div align="right"><span class="links-menu-izq">Exportar</span><a href="xls_agen_consulta_trabajador.php" target="_blank"><img src="../imagenes/file_extension_xls.png" width="22" height="20" border="0" title="Exportar a Excel"/></a></div><? }?></td>  
			   
             </tr>
             <tr>
               <td colspan="2" ><div align="right"><span class="links-menu-izq"><i>Consulta de Trabajadores(as) por: <? print $_SESSION['criterio']?></i></span></div></td>
             </tr>
           </table>
           
	       <table  border="0" align="center" class="listado formulario">
          <tr>
            <th class="labelListColumn">Nro.</th>
            <th class="labelListColumn">C&eacute;dula</th>
            <th class="labelListColumn">Nombres y Apellidos</th>
            <th class="labelListColumn">Sexo</th>
            <th class="labelListColumn">Edad</th>
            <th class="labelListColumn">Migrante</th>
            <th class="labelListColumn">Discap.</th>
            <th class="labelListColumn">Part/Com</th>
            <th class="labelListColumn">Situación Ocupacional</th>
            <th class="labelListColumn">Ocupaci&oacute;n</th>
            <th class="labelListColumn">Nivel Educativo</th>
            <th class="labelListColumn">Pasant&iacute;as</th>
            <th class="labelListColumn">Estado</th>
            <th class="labelListColumn">Municipio</th>
            <th class="labelListColumn">Parroquia</th>
            <th class="labelListColumn">Fecha Afiliaci&oacute;n</th>
          </tr>
          <?
	$aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $i=0; $i<count($aTabla); $i++){
		if (($i%2) == 0) $class_name = "dataListColumn2";
		else $class_name = "dataListColumn";
		?>
          <tr class="<?=$class_name?>">
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['id']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['cedula']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['nombres']?> <?=$aTabla[$i]['apellidos']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['sexo']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['edad']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['migrante']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['discapacidad']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['consejo_com']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['situacion_actual']?> - <?=$aTabla[$i]['situacion']?></div></td> 
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['ocupacion1']?></div></td> 
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['nivel_instruccion']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['pasantias']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['estado']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['municipio']?></div></td>
            <td class="texto-normal"><div align="left"><?=$aTabla[$i]['parroquia']?></div></td>
            <td class="texto-normal"><div align="left"><?=strftime("%d-%m-%Y", strtotime($aTabla[$i]['created_at']))?></div></td>
          </tr>          
          <? } ?>
		  <tr class="dataListColumn2">
            <td colspan="15" ><div align="right">Total</div></td>
            <td colspan="1" ><?=$i?></td>
           </tr>
        </table>
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

<?php include('../footer.php'); ?>


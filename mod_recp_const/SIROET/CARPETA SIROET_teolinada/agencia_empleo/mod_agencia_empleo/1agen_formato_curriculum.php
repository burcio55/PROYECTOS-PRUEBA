<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
$conn = getConnDB('sire');
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
		var_dump( $_SESSION['rs11']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
    LoadData($conn,true);
   }

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn)
{
		
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
			unset($_SESSION['aTabla1']);
			unset($_SESSION['aTabla2']);
			unset($_SESSION['rs3']);
			unset($_SESSION['aTabla4']);
			unset($_SESSION['aTabla5']);
			unset($_SESSION['aTabla6']);
			unset($_SESSION['aTabla7']);
			unset($_SESSION['aTabla8']);
			
	/*		if ($_GET['ced']!='') $_SESSION['ced_afiliado']=$_GET['ced'];
			if ($_GET['id_ced']!='') $_SESSION['id_afiliado']=$_GET['id_ced'];
			//PENDIENTE SESSIONUSUARIOOOOOOOOOOOOO
			if ($_GET['nom']!='' and $_GET['ape']!='') $_SESSION['usuario']=$_GET['nom'].' '.$_GET['ape'];*/
			
		    $SQL="select 
				  personas.nombres,
					personas.apellidos,
					personas.nacionalidad, 
					personas.sexo,
					personas.f_nacimiento,
					personas.sector,
					personas.direccion,
					personas.telefono,
					personas.otro_telefono,
					personas.correo,
					personas.sesiones,
					pais.nombre as pais, 
					estado.nombre as estado, 
					municipio.nombre as municipio,
					parroquia.nombre as parroquia, 
					estado_civil.nombre as estado_civil,
					tipo_vehiculo.nombre as vehiculo        
				From public.personas  
					INNER JOIN pais ON pais.id=personas.pais_nacimiento_id
					INNER JOIN estado_civil ON estado_civil.id=personas.estado_civil_id 
					LEFT JOIN estado ON estado.id=personas.estado_nacimiento_id 
					INNER JOIN municipio ON municipio.id=personas.municipio_id 
					INNER JOIN parroquia ON parroquia.id=personas.parroquia_id 
					INNER JOIN tipo_vehiculo ON tipo_vehiculo.id=personas.tipo_vehiculo_id 
				  where cedula='".$_SESSION['ced_afiliado']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 
				 $aTabla1=array();
						
					$nacionalidad=$rs1->fields['nacionalidad'];	 
							if($nacionalidad==1) $_POST['nacionalidad']='Venezolana';
							if($nacionalidad==2) $_POST['nacionalidad']='Extranjera';		
					$sexo=$rs1->fields['sexo'];	 
							if($sexo==1) $_POST['sexo']='Femenino';
							if($sexo==2) $_POST['sexo']='Masculino';
							
					list($a,$m,$d)=explode("-", $rs1->fields['f_nacimiento']);
				 		$a_nac= $a;
						$a_act= date('Y');
					$_POST['edad']= $a_act-$a_nac;
					$aTabla1['sexo']=$_POST['sexo'];
					$aTabla1['edad']=$_POST['edad'];
					$aTabla1['nombres']=$rs1->fields['nombres'];
					$aTabla1['apellidos']=$rs1->fields['apellidos'];
					$aTabla1['nacionalidad']=$_POST['nacionalidad'];
					$aTabla1['f_nacimiento']=$rs1->fields['f_nacimiento'];
					$aTabla1['pais_nac']=$rs1->fields['pais'];
					$aTabla1['estado_nac']=$rs1->fields['estado'];
					$aTabla1['municipio_nac']=$rs1->fields['municipio'];
					$aTabla1['parroquia_nac']=$rs1->fields['parroquia'];
					$aTabla1['sector']=$rs1->fields['sector'];
					$aTabla1['direccion']=$rs1->fields['direccion'];
					$aTabla1['telefono']=$rs1->fields['telefono'];
					$aTabla1['otro_telefono']=$rs1->fields['otro_telefono'];
					$aTabla1['correo']=$rs1->fields['correo'];
					$aTabla1['estado_civil']=$rs1->fields['estado_civil'];
					$aTabla1['vehiculo']=$rs1->fields['vehiculo'];	
					$_SESSION['sesiones']=$rs1->fields['sesiones'];
				  
			$_SESSION['aTabla1'] = $aTabla1;								
		}
				
		$SQL2="select situacion_laboral.nombre as situacion, 
				turno_jornada.nombre as jornada,
				persona_pref_ocupacion.fsituacion,
				persona_pref_ocupacion.trabajar_fuera,  
				persona_pref_ocupacion.pref_salario,
				persona_pref_ocupacion.experiencia1, persona_pref_ocupacion.experiencia2,
				ocupacion.nombre as ocupacion1	 
			from persona_pref_ocupacion 
			INNER JOIN personas ON personas.id=persona_pref_ocupacion.persona_id 
			INNER JOIN situacion_laboral ON situacion_laboral.id=persona_pref_ocupacion.tipo_situacion_actual
			INNER JOIN turno_jornada ON turno_jornada.id=persona_pref_ocupacion.turno_jornada_id
			INNER JOIN ocupacion ON ocupacion.cod=persona_pref_ocupacion.ocupacion5_1
				  where cedula='".$_SESSION['ced_afiliado']."'";
				 $rs2 = $conn->Execute($SQL2);
				 if ($rs2->RecordCount()>0){ 
				 $aTabla2=array();
						
				 	$trabajar_fuera=$rs2->fields['trabajar_fuera'];	 
							if($trabajar_fuera==1) $_POST['trabajar_fuera']='Si';
							if($trabajar_fuera==0) $_POST['trabajar_fuera']='No';
					$experiencia1=$rs2->fields['experiencia1'];	 
							if($experiencia1==1) $_POST['experiencia1']='Con Experiencia';
							if($experiencia1==0) $_POST['experiencia1']='Sin Experiencia';
					$experiencia2=$rs2->fields['experiencia2'];	 
							if($experiencia2==1) $_POST['experiencia2']='Con Experiencia';
							if($experiencia2==0) $_POST['experiencia2']='Sin Experiencia';	
					$aTabla2['trabajar_fuera']=$_POST['trabajar_fuera'];
					$aTabla2['experiencia1']=$_POST['experiencia1'];
					$aTabla2['experiencia2']=$_POST['experiencia2'];
				 	$aTabla2['situacion']=$rs2->fields['situacion'];
					$aTabla2['jornada']=$rs2->fields['jornada'];
					$aTabla2['fsituacion']=$rs2->fields['fsituacion'];
					$aTabla2['pref_salario']=$rs2->fields['pref_salario'];
					$aTabla2['ocupacion1']=$rs2->fields['ocupacion1'];	
			$_SESSION['aTabla2'] = $aTabla2;								
		}
		
		 $SQL3="select  pais.nombre as pais,
				estado.nombre as estado,
				ocupacion.nombre as ocupacion2
				from personas 
				INNER JOIN pais ON pais.id=personas.pais_residencia_id
				INNER JOIN estado ON estado.id=personas.estado_residencia
				INNER JOIN persona_pref_ocupacion ON persona_pref_ocupacion.persona_id=personas.id
				INNER JOIN ocupacion ON ocupacion.cod=persona_pref_ocupacion.ocupacion5_2
				  where cedula='".$_SESSION['ced_afiliado']."'";
				 $rs3 = $conn->Execute($SQL3);
				 if ($rs3->RecordCount()>0){ 
				 	$_POST['pais_residencia']=$rs3->fields['pais'];
					$_POST['estado_residencia']=$rs3->fields['estado'];
					$_POST['ocupacion2']=$rs3->fields['ocupacion2'];
					$_SESSION['rs3'] = $rs3;
				}
				
				
			$SQL4="select persona_nivel_instruccion.id, graduado, titulo, ultimo_periodo,total_periodo, 
						f_aprobacion,instituto_uni, persona_nivel_instruccion.observaciones, nivel_instruccion.nombre as nivel,
						area_mencion.nombre as carrera, regimen_estudio.nombre as regimen
						from persona_nivel_instruccion
						INNER JOIN personas ON personas.id=persona_nivel_instruccion.persona_id 
						INNER JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id 
						left JOIN area_mencion ON area_mencion.cod=persona_nivel_instruccion.carrera3 
						INNER JOIN regimen_estudio ON regimen_estudio.id=persona_nivel_instruccion.regimen_id 
					    where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' 
						order by nivel_instruccion.id desc";
					$rs4 = $conn->Execute($SQL4);
			   	$_SESSION['aTabla4'] = 	NULL;
					if ($rs4->RecordCount()>0){	
						$aTabla4=array();
						while(!$rs4->EOF){
							$c = count($aTabla4);  
							$graduado=$rs4->fields['graduado'];	 
							if($graduado==1) $_POST['graduado']='Si';
							if($graduado==0) $_POST['graduado']='No';							
							$aTabla4[$c]['id']=$rs4->fields['id']; 
							$aTabla4[$c]['graduado']=$_POST['graduado'];	
							$aTabla4[$c]['titulo']=$rs4->fields['titulo'];
							$aTabla4[$c]['ultimo_periodo']=$rs4->fields['ultimo_periodo'];
							$aTabla4[$c]['total_periodo']=$rs4->fields['total_periodo'];				
							$aTabla4[$c]['f_aprobacion']=$rs4->fields['f_aprobacion'];
							$aTabla4[$c]['instituto_uni']=$rs4->fields['instituto_uni'];
							$aTabla4[$c]['observaciones_estudio']=$rs4->fields['observaciones'];
							$aTabla4[$c]['nivel']=$rs4->fields['nivel'];
							$aTabla4[$c]['carrera']=$rs4->fields['carrera'];
							$aTabla4[$c]['regimen']=$rs4->fields['regimen'];
							$rs4->MoveNext();
		           			 }
			   	$_SESSION['aTabla4'] = $aTabla4;								
			}
			$SQL5="select persona_curso_formacion.id, instituto, f_realizacion, duracion,  relacion_oficio, prog_social, 
					nombre_prog, curso.nombre as curso, centro_capacitacion.nombre as centro
					from persona_curso_formacion 
					INNER JOIN personas ON personas.id=persona_curso_formacion.persona_id 
					INNER JOIN curso ON curso.id=persona_curso_formacion.curso_formacion_id 
					INNER JOIN centro_capacitacion ON centro_capacitacion.id=persona_curso_formacion.centro_capacitacion_id 
					where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' 
					order by f_realizacion desc";
				$rs5 = $conn->Execute($SQL5);
				$_SESSION['aTabla5'] = 	NULL;
				if ($rs5->RecordCount()>0){	
					$aTabla5=array();
					while(!$rs5->EOF){
						$c = count($aTabla5);  
						$relacion=$rs5->fields['relacion_oficio'];	 
						if($relacion==1) $_POST['relacion']='Si';
						if($relacion==0) $_POST['relacion']='No';	
						$programa=$rs5->fields['prog_social'];	 
						if($programa==1) $_POST['programa']='Si';
						if($programa==0) $_POST['programa']='No';	
						$aTabla5[$c]['id']=$rs5->fields['id']; 
						$aTabla5[$c]['instituto']=$rs5->fields['instituto'];
						if ($rs5->fields['f_realizacion']=='0000-00-00'){ $aTabla5[$c]['f_realizacion']='0000-00-00';}
				        else {$aTabla5[$c]['f_realizacion']=strftime("%d-%m-%Y", strtotime($rs5->fields['f_realizacion']));}
						//$aTabla5[$c]['f_realizacion']=$rs5->fields['f_realizacion'];
						$aTabla5[$c]['duracion']=$rs5->fields['duracion'];	
						$aTabla5[$c]['relacion']=$_POST['relacion'];
						$aTabla5[$c]['curso']=$rs5->fields['curso'];
						$aTabla5[$c]['centro']=$rs5->fields['centro'];	
						$rs5->MoveNext();
						 }
			$_SESSION['aTabla5'] = $aTabla5;								
		}
		$SQL6="select persona_computacion.id, nivel, computacion.nombre
					from persona_computacion 
					INNER JOIN personas ON personas.id=persona_computacion.persona_id 
					INNER JOIN computacion ON computacion.id=persona_computacion.computacion_id 
					where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
				$rs6 = $conn->Execute($SQL6);
				$_SESSION['aTabla6'] = 	NULL;
				if ($rs6->RecordCount()>0){	
					$aTabla6=array();
					while(!$rs6->EOF){
						$c = count($aTabla6);  
						$nivel=$rs6->fields['nivel'];	 
						if($nivel==1) $_POST['nivel']='Bien';
						if($nivel==2) $_POST['nivel']='Regular';	
						if($nivel==3) $_POST['nivel']='Excelente';	
						$aTabla6[$c]['id']=$rs6->fields['id']; 
						$aTabla6[$c]['computacion']=$rs6->fields['nombre'];	
						$aTabla6[$c]['nivel']=$_POST['nivel'];
						$rs6->MoveNext();
						 }
			$_SESSION['aTabla6'] = $aTabla6;								
		}

		$SQL8="select persona_experiencia_laboral.id, persona_experiencia_laboral.patrono, persona_experiencia_laboral.f_ingreso,
					persona_experiencia_laboral.f_egreso, persona_experiencia_laboral.ocupaciong_id,ocupacion.nombre as ocupacione,
					persona_experiencia_laboral.ocupacione_id					
					from persona_experiencia_laboral  
					INNER JOIN personas ON personas.id=persona_experiencia_laboral.persona_id 
					INNER JOIN ocupacion ON ocupacion.cod=persona_experiencia_laboral.ocupacion5 
					INNER JOIN motivo_retiro ON motivo_retiro.id=persona_experiencia_laboral.motivo_retiro_id 
					INNER JOIN sector_empleo ON sector_empleo.id=persona_experiencia_laboral.sector_empleo_id 
					where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'
					order by f_egreso desc";
				$rs8 = $conn->Execute($SQL8);
				$ocupacione_id=$rs8->fields['ocupacione_id'];
			  $_SESSION['aTabla8'] = 	NULL;
				if ($rs8->RecordCount()>0){	
					$aTabla8=array();
					while(!$rs8->EOF){
						$c = count($aTabla8); 
						$aTabla8[$c]['id']=$rs8->fields['id']; 
						$aTabla8[$c]['ocupacione']=$rs8->fields['ocupacione'];
						$aTabla8[$c]['patrono']=$rs8->fields['patrono'];
					//	$aTabla8[$c]['f_ingreso']=$rs8->fields['f_ingreso'];
					    if ($rs8->fields['f_ingreso']=='0000-00-00'){ $aTabla8[$c]['f_ingreso']='0000-00-00';}
				        else {$aTabla8[$c]['f_ingreso']=strftime("%d-%m-%Y", strtotime($rs8->fields['f_ingreso']));}
				        
						if ($rs8->fields['f_egreso']=='0000-00-00'){ $aTabla8[$c]['f_egreso']='0000-00-00';}
				        else {$aTabla8[$c]['f_egreso']=strftime("%d-%m-%Y", strtotime($rs8->fields['f_egreso']));}
						
					/*	if ($rs8->fields['f_egreso']==''){
						    $aTabla8[$c]['f_egreso']='Actualidad';}
						else{
							$aTabla8[$c]['f_egreso']=strftime('%d-%m-%Y', strtotime($rs8->fields['f_egreso']));}*/
						$rs8->MoveNext();
						 }
			$_SESSION['aTabla8'] = $aTabla8;								
			}
		
		$SQL9= "select *  from imagen 
					where persona_id ='".$_SESSION['id_afiliado']."'"; 
					$rs9 = $conn->Execute($SQL9);
					$_POST['foto']=$rs9->fields['imagen'];
						
						if ($rs9->RecordCount()>0){
						$_POST['imagen']='<img src="imagenes/'.$_POST['foto'].'" width="87" height="116" border="0"/>';
						
						}
					else{	
						$_POST['imagen']='FOTO';				
						
					}
					
		}
//------------------------------------------------------------------------------------------------------------------------------
function doReport($conn)
{
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>
  <p align="center">&nbsp;</p>
  <table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <?
	$aTabla1=$_SESSION['aTabla1'];
		?>
    <tr>
      <th height="25" colspan="4" class="titulo">
        <?=$aTabla1['nombres'].' '.$_POST['apellidos'].' '.$_SESSION['ced_afiliado']?>
      </th>
      <th width="11%" style="background-color:#E6E6E6;" rowspan="2" class="titulo" align="center"><?=$_POST['imagen']?></th>
    </tr>
    <tr>
      <th height="72" colspan="4" class="titulo">
        <?=$_POST['pais_residencia']?><br> 
          Nacionalidad: 
          <span class="links-menu-izq">
          <?=$aTabla1['nacionalidad']?> <br>
          </span>Estado:
<?=$_POST['estado_residencia']?> 
          Municipio: <?=$aTabla1['municipio_nac']?>
          Parroquia: <?=$aTabla1['parroquia_nac']?>
          <br>
          Direcci&oacute;n: <?=$aTabla1['direccion']?>
          Sector: <?=$aTabla1['sector']?>
          Tel&eacute;fono(s): <?=$aTabla1['telefono'].' '.$aTabla1['otro_telefono']?><br>
          Correo: <?=$aTabla1['correo']?>      
       </th>
    </tr>
    <tr>
      <th colspan="5" class="sub_titulo" align="left"><div align="left" class="labelListGlobal"><b>DATOS PERSONALES:</b></div></th>
    </tr>
	  <tr>
	    <td width="27%" align="right" class="dataListColumn">Sexo: </td>
	    <td width="24%" class="links-menu-izq"><?=$aTabla1['sexo']?></td>
	    <td class="dataListColumn" align="right">Edad:</td>
	    <td colspan="2" class="links-menu-izq"><?=$aTabla1['edad']?></td>
    </tr>
	  <tr>
      <td class="dataListColumn" align="right">Fecha de nacimiento:</td>
      <td class="links-menu-izq"><?=strftime('%d-%m-%Y', strtotime($aTabla1['f_nacimiento']))?></td>
      <td class="dataListColumn" align="right">Lugar de nacimiento:</td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla1['pais_nac'].' - '.$aTabla1['estado_nac']?></td>
    </tr>
    <tr>
      <td class="dataListColumn" align="right">Estado civil:</div></td>
      <td class="links-menu-izq"><?=$aTabla1['estado_civil']?></td>
      <td class="links-menu-izq">&nbsp;</td>
      <td colspan="2" class="links-menu-izq">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="5" class="sub_titulo" align="left">SITUACI&Oacute;N LABORAL </th>
    </tr>
	<?
	$aTabla2=$_SESSION['aTabla2'];
		?>
    <tr>
      <td align="right" class="dataListColumn">Situaci&oacute;n ocupacional: </td>
      <td class="dataListColumn"  ><span class="links-menu-izq">
        <?=$aTabla2['situacion']?>
      </span></td>
      <td align="right" class="dataListColumn">Fecha de esta situaci&oacute;n:</td>
      <td colspan="2" class="links-menu-izq"><?=strftime('%d-%m-%Y', strtotime($aTabla2['fsituacion']))?></td>
    </tr>
    <tr>
      <td align="right" class="dataListColumn">Primera opci&oacute;n ocupacional:</td>
      <td class="links-menu-izq"><?=$aTabla2['ocupacion1']?> - <?=$aTabla2['experiencia1']?></td>
      <td align="right" class="dataListColumn">Segunda opci&oacute;n ocupacional:</td>
      <td colspan="2" class="links-menu-izq"><?=$_POST['ocupacion2']?> - <?=$aTabla2['experiencia2']?></td>
    </tr>
   <? if($_SESSION['aTabla4']!=''){?>
    <tr>
      <th colspan="5" class="sub_titulo" align="left">EDUCACI&Oacute;N</th>
    </tr>
	<?
	$aTabla4=$_SESSION['aTabla4'];
	for( $i=0; $i<count($aTabla4); $i++){
		?>
    <tr>
      <td class="dataListColumn" align="right">Nivel educativo:</td>
      <td class="links-menu-izq"><?=$aTabla4[$i]['nivel']?></td>
      <td width="26%" class="dataListColumn" align="right">Area o menci&oacute;n:</td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla4[$i]['carrera']?>
        Graduado:
        <?=$aTabla4[$i]['graduado']?></td>
    </tr>
    <tr>
      <td class="dataListColumn" align="right">Instituto/Universidad:</td>
      <td class="links-menu-izq"><?=$aTabla4[$i]['instituto_uni']?></td>
      <td width="26%" class="dataListColumn" align="right">T&iacute;tulo obtenido:</td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla4[$i]['titulo']?>
        -
      <?=$aTabla4[$i]['f_aprobacion']?></td>
    </tr>
    <tr>
      <th colspan="5" class="ddsmoothmenu">&nbsp;</th>
    </tr>
	<? }
	
	 }
	 
	 if($_SESSION['aTabla5']!=''){?>
    <tr>
      <th colspan="5" class="sub_titulo" align="left">CAPACITACI&Oacute;N</th>
    </tr>
	<?
	$aTabla5=$_SESSION['aTabla5'];
	for( $i=0; $i<count($aTabla5); $i++){
		?>
     <tr>
      <td class="dataListColumn" align="right">Actividad de capacitaci&oacute;n:</td>
      <td class="links-menu-izq"><?=$aTabla5[$i]['curso']?></td>
      <td width="26%" class="dataListColumn" align="right">Instituci&oacute;n/Empresa: </td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla5[$i]['instituto']?></td>
    </tr>
    <tr>
      <td class="dataListColumn" align="right">Duraci&oacute;n: </td>
      <td class="links-menu-izq"><?=$aTabla5[$i]['duracion']?> horas</td>
      <td width="26%" class="dataListColumn" align="right"> Fecha de culminaci&oacute;n:</td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla5[$i]['f_realizacion']?></td>
    </tr>
    <tr>
      <th colspan="5" class="ddsmoothmenu">&nbsp;</th>
    </tr>
	<? }
	 
	 }
	 
	 if($_SESSION['aTabla6']!=''){?>
	<tr>
      <th colspan="5" class="sub_titulo" align="left">OTROS CONCIMIENTOS </th>
    </tr>
	<?
	$aTabla6=$_SESSION['aTabla6'];
	for( $i=0; $i<count($aTabla6); $i++){
		?>
     <tr>
      <td class="dataListColumn" align="right">Herramienta de Computacion:</td>
      <td class="links-menu-izq"><?=$aTabla6[$i]['computacion']?></td>
      <td width="26%" class="dataListColumn" align="right">Nivel: </td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla6[$i]['nivel']?></td>
    </tr>
    <tr>
      <th colspan="5" class="ddsmoothmenu">&nbsp;</th>
    </tr>
	<? } 
	 }
	 if($_SESSION['aTabla8']!=''){
	 ?>
	<tr>
      <th colspan="5" class="sub_titulo" align="left">EXPERIENCIA LABORAL </th>
    </tr>
	<?
	$aTabla8=$_SESSION['aTabla8'];
	for( $i=0; $i<count($aTabla8); $i++){
		?>
      <tr>
      <td class="dataListColumn" align="right">Empresa u organismo:</td>
      <td class="links-menu-izq"><?=$aTabla8[$i]['patrono']?></td>
      <td width="26%" class="dataListColumn" align="right">Ocupaci&oacute;n:</td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla8[$i]['ocupacione']?></td>
    </tr>
    <tr>
      <td class="dataListColumn" align="right">Desde:</td>
      <td class="links-menu-izq"><?=$aTabla8[$i]['f_ingreso']?></td>
      <td width="26%" class="dataListColumn" align="right">Hasta:</td>
      <td colspan="2" class="links-menu-izq"><?=$aTabla8[$i]['f_egreso']?></td>
    </tr>
    	<tr>
      <th colspan="5" class="ddsmoothmenu">&nbsp;</th>
    </tr>
	<? } 
	
	 }?>	
  </table>
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="2"><div align="center">
      
        <p>  <a target="new" href="pdf_curriculum.php?pr=<?=$_POST['pais_residencia']?>&er=<?=$_POST['estado_residencia']?>&o2=<?=$_POST['ocupacion2']?>&ex=<?=$_POST['experiencia2']?>&ft=<?=$_POST['foto']?>"><img src="../imagenes/print_32.png" border="0" /></a></p>
      </div></td>
    </tr>
  </table>
  <p align="right"></p>
      </label>
<p>&nbsp;</p>
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

<?php include('../footer.php'); ?>
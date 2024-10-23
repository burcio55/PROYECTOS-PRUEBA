<?php 

include("../../header.php"); 

ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

$conn2 = &ADONewConnection($target);
//$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh_produccion2');
$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
$conn2->debug = false;

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

debug();
doAction();
showForm($conn,$aDefaultForm);

function LoadListyear($anio)
{
	while($anio <= date('Y'))
	{
		print '<option value='.$anio.' selected="selected">'.$anio.'</option>';
		$anio++;
	}
}

function LoadListMonth($month)
{
	while($month <= date('m'))
	{
		print '<option value='.$month.' selected="selected">'.$month.'</option>';
		$month++;
	}
}

function loadMes_cb(){
        $GLOBALS[$sHtml_Var] = '';
        $sHtml_Var = "sHtml_mes_cb";

        for ($i=1; $i<=12; $i++) {
                $GLOBALS[$sHtml_Var] .= "<option value={$i}";
                if ($i == $GLOBALS['aDefaultForm']['mes_cb']) {
                        $GLOBALS[$sHtml_Var].= " selected='selected'";
                }
                $GLOBALS[$sHtml_Var] .= ">".nombremes($i)." </option>\n";
        }
}

function nombremes($mes){
        $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
        return $nombre;
}


/*function doAction(){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'consultar':
						$bValidateSuccess=true;
					
							if ($_POST['mes']==""){
								//	echo "AQUI MES".$_POST['mes'];
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Mes.";
								$GLOBALS['ids_elementos_validar'][]='mes';
								$bValidateSuccess=false;
							}
							
						if ($_POST['txt_codigo_tipos_trabajadores']!='05')	  $query = $_POST['quincena'];
									else $query = $_POST['semana'];		
																					
							if ($query==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar Semana o quincena.";
								$GLOBALS['ids_elementos_validar'][]=$query;
								$bValidateSuccess=false;
							}
						if($bValidateSuccess){
							ProcessForm();
						}
					LoadData(true);					
				break;
			}
		}else{
		LoadData(false);
	}
 }*/

function doAction($conn, $conn2){
	$GLOBALS['mostrar'] = '';
//------------------------------------------------------------------------------------------
		if (isset($_POST['action'])){
			switch($_POST['action']){ 						
//------------------------------------------------------------------------------------------				
				case 'buscar_persona':
					echo "cargando buscar";
					$GLOBALS['aDefaultForm'] = '';
					$bValidateSuccess=true;
					if ($_POST['cbo_cedulatrabajador']==""){
						$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Nacionalidad.";
						$GLOBALS['ids_elementos_validar'][]='cbo_cedulatrabajador';
						$bValidateSuccess=false;
					}
					if (!preg_match("/^[[:digit:]]{4,8}+$/", trim($_POST['txt_cedula'])) ){ 
						$GLOBALS['aPageErrors'][]= "- El campo Cédula de Identidad debe contener de 4 a 8 d\u00EDgitos";
						$GLOBALS['ids_elementos_validar'][]='txt_cedula';
						$bValidateSuccess=false;
					}
					
					if($bValidateSuccess){
						$aDefaultForm = &$GLOBALS['aDefaultForm'];
						global $conn2;
						echo "cargando buscar";
						$SQL="SELECT personal.id_personal,
									personal.primer_apellido as apellido1,
									personal.segundo_apellido as apellido2,
									personal.primer_nombre as nombre1,
									personal.segundo_nombre as nombre2, 
									personal.nacionalidad,
									personal.sexo,
									personal.cedula as cedula, 
									trabajador.fecha_ingreso,
									trabajador.fecha_egreso,
									trabajador.estatus,
									trabajador.codigo_nomina as cod_nom,
									cargo.descripcion_cargo,
									dependencia.nombre as nombre_dep,
									trim(both ' ' from tipopersonal.nombre) as tipo_trabajador,
									tipopersonal.cod_tipo_personal as cod_trabajador
									FROM trabajador
									INNER JOIN personal on personal.id_personal = trabajador.id_personal
									INNER JOIN tipopersonal on tipopersonal.id_tipo_personal = trabajador.id_tipo_personal
									inner join cargo on trabajador.id_cargo = cargo.id_cargo
									inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
									WHERE personal.cedula='".$_POST['txt_cedula']."'  order by id_trabajador desc limit 1";
									//and trabajador.estatus='E'
						$rs_1=$conn2->Execute($SQL);
						echo "cargando buscar";
						if($rs_1->fields['estatus']=='A'){
							$aDefaultForm['txt_cedula']					=$rs_1->fields['cedula'];
							$aDefaultForm['txt_apellido1']				=$rs_1->fields['apellido1'];
							$aDefaultForm['txt_apellido2']				=$rs_1->fields['apellido2'];
							$aDefaultForm['txt_nombre1']				=$rs_1->fields['nombre1'];
							$aDefaultForm['txt_nombre2']				=$rs_1->fields['nombre2'];
							$aDefaultForm['txt_nacionalidad']			=$rs_1->fields['nacionalidad'];
							$aDefaultForm['txt_fecha_ingreso']			=$rs_1->fields['fecha_ingreso'];
							$aDefaultForm['txt_fecha_egreso']			=$rs_1->fields['fecha_egreso'];						
							$aDefaultForm['txt_cod_nom']		   		=$rs_1->fields['cod_nom'];
							$aDefaultForm['txt_descripcion_cargo']		=trim($rs_1->fields['descripcion_cargo']);
							$aDefaultForm['txt_nombre_dep']				=$rs_1->fields['nombre_dep'];
							$aDefaultForm['cbo_cedulatrabajador']       =$_POST['cbo_cedulatrabajador'];
							//$aDefaultForm['estatus']					=$rs_1->fields['estatus'];
						
						if ($rs_1->fields['sexo'] == 'M'){
							$_SESSION['ciudadano'] 		   = 'el ciudadano ';
							$_SESSION['adscrito']  		   = 'adscrito a ';
							if ($rs_1->fields['cod_trabajador'] == '20' ){
								$_SESSION['jubilado']  		   = 'JUBILADO';
								$_SESSION['tipo_asignacion']   = 'Jubilaci&oacute;n ';
							}	
							if ($rs_1->fields['cod_trabajador'] == '28' || $rs_1->fields['cod_trabajador'] == '29' ){
								$_SESSION['jubilado']          = 'PENSIONADO';
								$_SESSION['tipo_asignacion']   = 'Pensi&oacute;n ';
							}
						}			 
						
						
						if ($rs_1->fields['sexo'] == 'F' ){
							$_SESSION['ciudadano']         = 'la ciudadana ';
							$_SESSION['adscrito']          = 'adscrita a ';
							if ($rs_1->fields['cod_trabajador'] == '20' ){
								$_SESSION['jubilado']  		   = 'JUBILADA';
								$_SESSION['tipo_asignacion']   = 'Jubilaci&oacute;n ';
							}						
							if ($rs_1->fields['cod_trabajador'] == '28' || $rs_1->fields['cod_trabajador'] == '29' ){
								$_SESSION['jubilado']   	   = 'PENSIONADA';
								$_SESSION['tipo_asignacion']   = 'Pensi&oacute;n ';
							}
						
					}		
							$_SESSION['recibo_act']=$aDefaultForm;
							$GLOBALS['mostrar'] = 1;
							
						}else{
							?>
							<script>
							alert("El trabajador no tiene estatus egresado, de ser egresado favor dirigirse a la Oficina de Gesti\u00F3n Humana, Dpto. Registro y Control."); 
							</script>
							<?php
							$aDefaultForm['txt_cedula']					="";
							$aDefaultForm['txt_apellido1']				=""; //ESTO SIGNIFICA QUE BLANQUEA LOS CAMPOS DEL FORMULARIO
							$aDefaultForm['txt_apellido2']				="";
							$aDefaultForm['txt_nombre1']				="";
							$aDefaultForm['txt_nombre2']				="";
							$aDefaultForm['txt_nacionalidad']			="";
							$aDefaultForm['txt_fecha_ingreso']			="";
							$aDefaultForm['txt_cod_nom']				="";
							$aDefaultForm['txt_descripcion_cargo']		="";	
							$aDefaultForm['txt_nombre_dep']				="";
							$aDefaultForm['cbo_cedulatrabajador']       ="";	
							$aDefaultForm['txt_tipo_trabajador']		="";				
						}						
					}
					loadData($conn, $conn2, true);
				break;
//------------------------------------------------------------------------------------------				
				case 'Actualiza': 			
					
			
				loadData($conn, $conn2, true);
				break;
//------------------------------------------------------------------------------------------	
			}
		}else{
			LoadData($conn, $conn2, true);
		}
//------------------------------------------------------------------------------------------
}





//-----------------------------------------------------------------------------//
function LoadData($conn, $conn2,$bPostBack){  //en esta funcion se colocan todos los campos que voy a trabajar en el formulario
global $conn;
global $conn2;
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
					/*if(isset($_SESSION['id_usuario'])){
echo "cargando load";
				      $SQL="SELECT personal.id_personal,
								personal.primer_apellido as apellido1,
								personal.segundo_apellido as apellido2,
								personal.primer_nombre as nombre1,
								personal.segundo_nombre as nombre2, 
								personal.nacionalidad,
								personal.sexo,
								personal.cedula as cedula, 
								trabajador.fecha_ingreso,
								trabajador.fecha_egreso,
								trabajador.codigo_nomina as cod_nom,
								trabajador.estatus,
								cargo.descripcion_cargo,
								dependencia.nombre as nombre_dep,
								tipopersonal.nombre as tipo_trabajador,
								tipopersonal.cod_tipo_personal as cod_trabajador
								FROM trabajador
								INNER JOIN personal on personal.id_personal = trabajador.id_personal
								INNER JOIN tipopersonal on tipopersonal.cod_tipo_personal = trabajador.cod_tipo_personal
								inner join cargo on trabajador.id_cargo = cargo.id_cargo
								inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
								WHERE personal.cedula='".$_POST['txt_cedula']."' and trabajador.estatus='A' order by trabajador.id_trabajador DESC LIMIT 1";
							
					$rs_1=$conn2->Execute($SQL);
					if($rs_1->RecordCount()>0){
								$aDefaultForm['txt_apellido1']						=$rs_1->fields['apellido1'];
								$aDefaultForm['txt_apellido2']						=$rs_1->fields['apellido2'];
								$aDefaultForm['txt_nombre1']						=$rs_1->fields['nombre1'];
								$aDefaultForm['txt_nombre2']						=$rs_1->fields['nombre2'];
								$aDefaultForm['txt_nacionalidad']				    =$rs_1->fields['nacionalidad'];
								$aDefaultForm['txt_fecha_ingreso']					=$rs_1->fields['fecha_ingreso'];
								$aDefaultForm['txt_fecha_egreso']					=$rs_1->fields['fecha_egreso'];											
								$aDefaultForm['txt_cod_nom']						=$rs_1->fields['cod_nom'];
								$aDefaultForm['txt_descripcion_cargo']				=$rs_1->fields['descripcion_cargo'];
								$aDefaultForm['txt_nombre_dep']					    =$rs_1->fields['nombre_dep'];
								$aDefaultForm['txt_tipo_trabajador']				=$rs_1->fields['tipo_trabajador'];
								$aDefaultForm['txt_cod_trabajador']					=$rs_1->fields['cod_trabajador'];
		///////
		//echo $rs_1->fields['sexo'] .$rs_1->fields['cod_trabajador'] ;
		if ($rs_1->fields['sexo'] == 'M'){
		$_SESSION['ciudadano'] 		   = 'el ciudadano ';
		$_SESSION['adscrito']  		   = 'adscrito a ';
		if ($rs_1->fields['cod_trabajador'] == '20' ){
					$_SESSION['jubilado']  		   = 'JUBILADO';
					$_SESSION['tipo_asignacion']   = 'Jubilaci&oacute;n ';
    	}	
		if ($rs_1->fields['cod_trabajador'] == '28' || $rs_1->fields['cod_trabajador'] == '29' ){
					$_SESSION['jubilado']          = 'PENSIONADO';
					$_SESSION['tipo_asignacion']   = 'Pensi&oacute;n ';
			 }//3
		}			 


if ($rs_1->fields['sexo'] == 'F' ){
					$_SESSION['ciudadano']         = 'la ciudadana ';
					$_SESSION['adscrito']          = 'adscrita a ';
			if ($rs_1->fields['cod_trabajador'] == '20' ){
					$_SESSION['jubilado']  		   = 'JUBILADA';
					$_SESSION['tipo_asignacion']   = 'Jubilaci&oacute;n ';
    	     }
				 
			if ($rs_1->fields['cod_trabajador'] == '28' || $rs_1->fields['cod_trabajador'] == '29' ){
					$_SESSION['jubilado']   	   = 'PENSIONADA';
					$_SESSION['tipo_asignacion']   = 'Pensi&oacute;n ';
			 }
	 }
		  }		
		}*/
		if (!$bPostBack){
			if(isset($_SESSION['id_usuario'])){
						$SQL="SELECT personal.id_personal,
								personal.primer_apellido as apellido1,
								personal.segundo_apellido as apellido2,
								personal.primer_nombre as nombre1,
								personal.segundo_nombre as nombre2, 
								personal.nacionalidad,
								personal.sexo,
								personal.cedula as cedula, 
								trabajador.fecha_ingreso,
								trabajador.fecha_egreso,
								trabajador.codigo_nomina as cod_nom,
								trabajador.sueldo_basico,
								trabajador.estatus,
								cargo.descripcion_cargo,
								dependencia.nombre as nombre_dep,
								tipopersonal.nombre as tipo_trabajador,
								tipopersonal.cod_tipo_personal as cod_trabajador
								FROM trabajador
								INNER JOIN personal on personal.id_personal = trabajador.id_personal
								INNER JOIN tipopersonal on tipopersonal.cod_tipo_personal = trabajador.cod_tipo_personal
								inner join cargo on trabajador.id_cargo = cargo.id_cargo
								inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
								WHERE personal.cedula='".$_POST['txt_cedula']."'  and trabajador.estatus='A' order by trabajador.id_trabajador  DESC LIMIT 1";	
						
					$rs_1=$conn2->Execute($SQL);
  				if($rs_1->RecordCount()>0){
					
					    $aDefaultForm['txt_apellido1']							 =$rs_1->fields['apellido1'];
						$aDefaultForm['txt_apellido2']							 =$rs_1->fields['apellido2'];
						$aDefaultForm['txt_nombre1']							 =$rs_1->fields['nombre1'];
						$aDefaultForm['txt_nombre2']							 =$rs_1->fields['nombre2'];
						$aDefaultForm['txt_nacionalidad']				   		 =$rs_1->fields['nacionalidad'];
						$aDefaultForm['txt_fecha_ingreso']						 =$rs_1->fields['fecha_ingreso'];	
						$aDefaultForm['txt_fecha_egreso']						 =$rs_1->fields['fecha_egreso'];					
						$aDefaultForm['txt_cod_nom']							 =$rs_1->fields['cod_nom'];
						$aDefaultForm['txt_sueldo_basico']						 =$rs_1->fields['sueldo_basico'];
						$aDefaultForm['txt_descripcion_cargo']					 =$rs_1->fields['descripcion_cargo'];
						$aDefaultForm['txt_nombre_dep']							 =$rs_1->fields['nombre_dep'];
						$aDefaultForm['txt_tipo_trabajador']					 =$rs_1->fields['tipo_trabajador'];
						
						if ($rs_1->fields['sexo'] == 'M'){
							$_SESSION['ciudadano'] 		   = 'el ciudadano ';
							$_SESSION['adscrito']  		   = 'adscrito a ';
							if ($rs_1->fields['cod_trabajador'] == '20' ){
								$_SESSION['jubilado']  		   = 'JUBILADO';
								$_SESSION['tipo_asignacion']   = 'Jubilaci&oacute;n ';
							}	
							if ($rs_1->fields['cod_trabajador'] == '28' || $rs_1->fields['cod_trabajador'] == '29' ){
								$_SESSION['jubilado']          = 'PENSIONADO';
								$_SESSION['tipo_asignacion']   = 'Pensi&oacute;n ';
							}
						}			 
						
						
						if ($rs_1->fields['sexo'] == 'F' ){
							$_SESSION['ciudadano']         = 'la ciudadana ';
							$_SESSION['adscrito']          = 'adscrita a ';
							if ($rs_1->fields['cod_trabajador'] == '20' ){
								$_SESSION['jubilado']  		   = 'JUBILADA';
								$_SESSION['tipo_asignacion']   = 'Jubilaci&oacute;n ';
							}						
							if ($rs_1->fields['cod_trabajador'] == '28' || $rs_1->fields['cod_trabajador'] == '29' ){
								$_SESSION['jubilado']   	   = 'PENSIONADA';
								$_SESSION['tipo_asignacion']   = 'Pensi&oacute;n ';
							}
						
					}			
				}
			}
		   }
	}
	$_SESSION['recibo_act']=$aDefaultForm;
}

function showForm($conn,$aDefaultForm){ 
global $conn;
global $conn2;
 /*if(isset($_SESSION['id_usuario'])){
			  $SQL="SELECT concepto.cod_concepto as codigoconcep,
					conceptofijo.monto as montoconcepto,
					frecuenciapago.cod_frecuencia_pago as codigofrecuencia,
					concepto.descripcion as nombreconcep
					FROM trabajador
					INNER JOIN personal on personal.id_personal = trabajador.id_personal
					inner join conceptofijo on conceptofijo.id_trabajador = trabajador.id_trabajador 
					inner join conceptotipopersonal on conceptotipopersonal.id_concepto_tipo_personal = conceptofijo.id_concepto_tipo_personal 
					inner join frecuenciapago on frecuenciapago.cod_frecuencia_pago = conceptotipopersonal.cod_frecuencia_pago 
					inner join concepto on concepto.id_concepto = conceptotipopersonal.id_concepto 
					inner join tipopersonal on tipopersonal.id_tipo_personal = trabajador.id_tipo_personal 
					WHERE personal.cedula='".$_POST['txt_cedula']."' AND concepto.cod_concepto in ('0010','0026','0011','3415') order by concepto.cod_concepto desc ";		
					$rs1=$conn2->Execute($SQL);
				}
	$sql="SELECT personales_cedula, scodigo_constancia
           FROM recibos_pagos_constancias.constancias_trabajo
	       where personales_cedula='".$_POST['txt_cedula']."' and tipo_constancias_id=8 and nenabled=1";//COLOCAR VARIABLE OOOOJOOOOOOOOOOOOOOOOOOOOOOOOOOOO  and dfecha_creacion>'2018-06-01'
	$rs3 = $conn->Execute($sql);
	
	$_SESSION['ncontador']=0;
	if ($rs3->RecordCount()>0){
		$_SESSION['ncontador']=$rs3->RecordCount();
			//$fec = date('d-m-Y',strtotime($rs1->fields['fecha_caducidad_const']));
		}	
	echo '<script>alert("Usted sólo puede solicitar tres (03) Constancias de Trabajo en el mes.");</script>'; 
	?>*/

?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
    
    
<form name="frm_constancia_trabajo_pens_jub_301020" id="frm_constancia_trabajo_pens_jub_301020" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<!---*
PARA COLOCAR FUNCIONES O VALIDACIONES JAVASCRIPT
<script type="text/javascript" src=".js"></script>		
<script type="text/javascript" src=".js"></script>
-->
<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../../css/botones_IZ.css"/>
<link rel="stylesheet" type="text/css" href="../../css/formularios.css"/>
<style type="text/css">
	.loaders {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;	
		background: url('../../imagenes/page-loader.gif') 50% 50% no-repeat rgb(255,255,255);
		opacity: 0.6;
    	filter: alpha(opacity=60);
	}

	</style>
<script type="text/javascript" src="validar_rec_pago_registro.js"></script>


<script>
function send(saction, txt_cedula){	

	if(saction=='buscar_persona'){
		var msg = '';
			if ($('#cbo_cedulatrabajador').val().trim() == ''){
			msg=msg+'-Bad';
				document.getElementById("cbo_cedulatrabajador").style.border = "1px solid red";
			}else{
				document.getElementById("cbo_cedulatrabajador").style.border = "";
			}
			
			if ($('#txt_cedula').val().trim() == ''){
			msg=msg+'-Bad';
				document.getElementById("txt_cedula").style.border = "1px solid red";
			}else{
				document.getElementById("txt_cedula").style.border = "";
			}
		if (msg != '') { 
			alert ('Debe seleccionar los campos requeridos');
			msg = '';
			return false;
		}else{
			$("#loader").show();
			var form = document.frm_constancia_trabajo_pens_jub_301020;
			form.action.value=saction;
			form.submit();	
			$("#tablacontenido").show();
		}
	}
} 
</script>
<table class="formulario" width="60%" align="center">
  <tr>
    <th class="titulo" align="center">CONSULTA CONSTANCIA DE  JUBILADO/PENSIONADO</th>    
  </tr>
  
      <tr>
   	 <td> </td>		
    </tr>
  
  
    <tr class="identificacion_seccion" >
    <td align="center">C&Eacute;DULA DE IDENTIDAD: 
      <select id="cbo_cedulatrabajador" name="cbo_cedulatrabajador" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>></option>
        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>V-.</option>
        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>E.-</option>
        </select>
      <input name="txt_cedula" id="txt_cedula" type="text"  value="<?= $aDefaultForm['txt_cedula'];?>" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." size="19" maxlength="8" onKeyPress="return isNumberKey(event);" />
      <span>*</span>   
       <button type="button" class="button_personal btn_buscar" onclick="javascript:send('buscar_persona');" title="Haga Click para Buscar">Buscar</button></td>
      

  </tr>
  
  
  
 	   <tr>
      <td width="60%" height="200%"><font color="#666666"><p align="justify">Quien suscribe, la <b>Directora General</b> de la <b>Oficina de Gesti&oacute;n Humana del Ministerio del Poder Popular para el Proceso Social de Trabajo</b>, hace constar  por medio de la presente que <?php echo $_SESSION['ciudadano'];?> <b><?php print trim($aDefaultForm['txt_apellido1']." ".$aDefaultForm['txt_apellido2']).",  ".trim($aDefaultForm['txt_nombre1']." ".$aDefaultForm['txt_nombre2']);?></b>, titular de la c&eacute;dula de identidad Nro. <b><?php echo $aDefaultForm['txt_nacionalidad']; echo '-'.number_format( $aDefaultForm['txt_cedula'], 0, '', '.');?></b>, en su condici&oacute;n de <b><?php echo $_SESSION['jubilado'];?></b>, de &eacute;ste Organismo a partir del <b><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?></b>, devengando un: <? 
					$total_asigna = 0;

//////////////////////////////////////////////////////////
//  estructurando fecha para el reporte
//////////////////////////////////////////////////////////
$fecha_solicitud = date('Y-m-d');
$fecha_nueva= split ("-",$fecha_solicitud);

$dia = $fecha_nueva[2];
$mes= $fecha_nueva[1];
$ano= $fecha_nueva[0];

/* *****************************************************************************
   Dando formato del mes
/* *****************************************************************************/
	if 	(($mes == 1))
	 $nombremes = "Enero";
	if 	(($mes == 2))
	 $nombremes = "Febrero";
	if 	(($mes == 3))
	 $nombremes = "Marzo";
	if 	(($mes == 4))
	 $nombremes = "Abril";
	if 	(($mes == 5))
	 $nombremes = "Mayo";
	if 	(($mes == 6))
	 $nombremes = "Junio";
	if 	(($mes == 7))
	 $nombremes = "Julio";
	if 	(($mes == 8))
	 $nombremes = "Agosto";
	if 	(($mes == 9))
	 $nombremes = "Septiembre";
	if 	(($mes == 10))
	 $nombremes = "Octubre";
	if 	(($mes == 11))
	 $nombremes = "Noviembre";
	if 	(($mes == 12))
	 $nombremes = "Diciembre";
	 $_SESSION['fecha_solicitud_const']['dia']= $dia;
 	 $_SESSION['fecha_solicitud_const']['mes']= $nombremes ;
	 $_SESSION['fecha_solicitud_const']['ano']= $ano ;
?>
		</b></p>
</font></td>
</tr>
</table>

<?php
$inter=0;
 $SQL="SELECT concepto.cod_concepto as codigoconcep,
					conceptofijo.monto as montoconcepto,
					frecuenciapago.cod_frecuencia_pago as codigofrecuencia,
					concepto.descripcion as nombreconcep
					FROM trabajador
					INNER JOIN personal on personal.id_personal = trabajador.id_personal
					inner join conceptofijo on conceptofijo.id_trabajador = trabajador.id_trabajador 
					inner join conceptotipopersonal on conceptotipopersonal.id_concepto_tipo_personal = conceptofijo.id_concepto_tipo_personal 
					inner join frecuenciapago on frecuenciapago.cod_frecuencia_pago = conceptotipopersonal.cod_frecuencia_pago 
					inner join concepto on concepto.id_concepto = conceptotipopersonal.id_concepto 
					inner join tipopersonal on tipopersonal.id_tipo_personal = trabajador.id_tipo_personal 
					WHERE personal.cedula='".$_POST['txt_cedula']."' AND concepto.cod_concepto in ('0010','0026','0011','3415') order by concepto.cod_concepto desc ";		
					$rs1=$conn2->Execute($SQL);
				
	$sql="SELECT personales_cedula, scodigo_constancia
           FROM recibos_pagos_constancias.constancias_trabajo
	       where personales_cedula='".$_POST['txt_cedula']."' and tipo_constancias_id=8 and nenabled=1";//COLOCAR VARIABLE OOOOJOOOOOOOOOOOOOOOOOOOOOOOOOOOO  and dfecha_creacion>'2018-06-01'
	$rs3 = $conn->Execute($sql);
	
	$_SESSION['ncontador']=0;
	if ($rs3->RecordCount()>0){
		$_SESSION['ncontador']=$rs3->RecordCount();
			//$fec = date('d-m-Y',strtotime($rs1->fields['fecha_caducidad_const']));
		}	
	echo '<script>alert("Usted sólo puede solicitar tres (03) Constancias de Trabajo en el mes.");</script>'; 
	
if($rs1->RecordCount()>0){
	while (!$rs1->EOF){
		if (($inter%2) == 0) $class_name="dataListColumn2";
		else $class_name="dataListColumn";
		
		$txt_monto_bd				=$rs1->fields['montoconcepto'];
		$nombre_concep				=$rs1->fields['nombreconcep'];
		$cod_frecuencia_pago		=$rs1->fields['codigofrecuencia'];
		$codigoconcep		        =$rs1->fields['codigoconcep'];

		if ($codigoconcep=='0010'){//CONCEPTO JUBILACION
			if ($cod_frecuencia_pago == '4')  $txt_monto1 =$txt_monto_bd/7*30;
			if ($cod_frecuencia_pago == '3')  $txt_monto1 =$txt_monto_bd*2;
			if ($cod_frecuencia_pago == '2')  $txt_monto1 =$txt_monto_bd*1;	
		}
		
		if ($codigoconcep=='0026'){ //CONCEPTO BONO DE SUBSISTENCIA
			if ($cod_frecuencia_pago == '4')  $txt_monto2 =$txt_monto_bd/7*30;
			if ($cod_frecuencia_pago == '3')  $txt_monto2 =$txt_monto_bd*2;
			if ($cod_frecuencia_pago == '2')  $txt_monto2 =$txt_monto_bd*1;									
		}
		
		if ($codigoconcep=='0011'){ //CONCEPTO PENSION
			if ($cod_frecuencia_pago == '4')  $txt_monto3 =$txt_monto_bd/7*30;
			if ($cod_frecuencia_pago == '3')  $txt_monto3 =$txt_monto_bd*2;
			if ($cod_frecuencia_pago == '2')  $txt_monto3 =$txt_monto_bd*1;	
		}
		
		if ($codigoconcep=='3415'){ //CONCEPTO JUBILACION DE TESORERIA 
			if ($cod_frecuencia_pago == '14') $txt_monto4 =$txt_monto_bd;
		}

		//$total_asigna = $txt_monto1 + $txt_monto2 + $txt_monto3 + $txt_monto4;
		  $total_asigna = $txt_monto1 + $txt_monto3 + $txt_monto4;
		
		$aTabla['jubilacion']			=$txt_monto1;
		$aTabla['bono_subsistemcia']	=$txt_monto2;
		$aTabla['pension']				=$txt_monto3;
		$aTabla['jubilacion_tss']		=$txt_monto4;
		$aTabla['total']				=$total_asigna;
		
		$rs1->MoveNext();
		$inter++;
	}
	$_SESSION['jubilados'] = $aTabla;
}else{
unset($_SESSION['jubilados']);
}
//print_r($_SESSION['jubilados']);

?>

<table width="40%" border="1" bordercolor="#FFFFFF" align="center" class="formulario" cellpadding="5" cellspacing="0">
    <tr>
    	<th colspan="3" align="center" class="sub_titulo">&nbsp;</th>
    </tr>
    
    <tr>
    	<td colspan="3"> </td>		
    </tr>
         
<!--    <tr>
        <th width="70%" align="left" class="data_Table1">Bono de Subsistencia</th>
        <th width="10%" align="right" class="data_Table1">Bs.</th>
        <th width="20%" align="right" class="data_Table1"><?=$montos['total_asigna']=number_format($txt_monto2, 2, ",", ".");?></th>
    </tr>-->
    <? if($txt_monto1>0){?>
    <tr>
        <th align="left" class="data_Table2">Jubilaci&oacute;n</th>
        <th align="right" class="data_Table2">Bs.</th>
        <th align="right" class="data_Table2"><?=$montos['bono_vacacional']=number_format($txt_monto1, 2, ",", ".");?></th>
    </tr>
    <? } ?>
    
    <? if($txt_monto3>0){?>
    <tr>
        <th align="left" class="data_Table2">Pensi&oacute;n</th>
        <th align="right" class="data_Table2">Bs.</th>
        <th align="right" class="data_Table2"><?=$montos['bono_vacacional2']=number_format($txt_monto3, 2, ",", ".");?></th>
    </tr>
    <? } ?>
    
    <? if($txt_monto4>0){?>
    <tr>
        <th width="70%" align="left" class="data_Table1">Jubilaci&oacute;n Tesorer&iacute;a de Seguridad Social</th>
        <th width="10%" align="right" class="data_Table1">Bs.</th>
        <th width="20%" align="right" class="data_Table1"><?=$montos['total_asigna_TSS']=number_format($txt_monto4, 2, ",", ".");?></th>
    </tr>
      <? } ?>
    
    
    <tr>
    	<th colspan="3" align="center" class="sub_titulo">&nbsp;</th>
    </tr>
    
    <tr>
   	 <td colspan="3"> </td>		
    </tr>
    
    <tr>
        <th align="right" class="data_Table2"><div align="right"><b>TOTAL:</b></div></th>
        <th align="right" class="data_Table2"><b>  Bs.</b></th> 
        <th align="right" class="data_Table2"><b><?=$montos['monto_total']=number_format($total_asigna, 2, ",", ".");?></b></th>
    </tr>
</table>



<br>

    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">

<?php 
//echo 'dfdsfdfdf'.$_SESSION['ncontador'];
if ($_SESSION['ncontador']<3){ ?>
  <tr>
     <td colspan="5" align="center">
         <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_constancia_trabajo_pens_jub.php" formtarget="_blank" title="Haga Click para Imprimir la Constancia de Trabajo">Imprimir</button></td>
   </tr>


<?php }else{?>
	
   <tr>
     <th colspan="5"class="titulo" align="center"> Usted alcanzó el máximo de solicitudes de Constancia de Trabajo por mes.</th>
   </tr>

	<?php }?>
 </table>  
<div id="loader" class="loaders" style="display: none;"></div>
</form>
    
    	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>
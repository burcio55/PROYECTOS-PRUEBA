<?php 
include("../../header.php"); 

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
showForm($conn,$conn2,$aDefaultForm);

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
function doAction(){
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
 }
//-----------------------------------------------------------------------------//
function LoadData($bPostBack){  //en esta funcion se colocan todos los campos que voy a trabajar en el formulario
global $conn;
global $conn2;
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
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
								trabajador.codigo_nomina as cod_nom,
								cargo.descripcion_cargo,
								dependencia.nombre as nombre_dep
								FROM trabajador
								INNER JOIN personal on personal.id_personal = trabajador.id_personal
								inner join cargo on trabajador.id_cargo = cargo.id_cargo
								inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
								WHERE personal.cedula='".$_SESSION['id_usuario']."' and estatus='A'";
					$rs_1=$conn2->Execute($SQL);
					if($rs_1->RecordCount()>0){
					  $aDefaultForm['txt_apellido1']										=$rs_1->fields['apellido1'];
						$aDefaultForm['txt_apellido2']										=$rs_1->fields['apellido2'];
						$aDefaultForm['txt_nombre1']										=$rs_1->fields['nombre1'];
						$aDefaultForm['txt_nombre2']										=$rs_1->fields['nombre2'];
						$aDefaultForm['txt_nacionalidad']				   					=$rs_1->fields['nacionalidad'];
						$aDefaultForm['txt_fecha_ingreso']									=$rs_1->fields['fecha_ingreso'];						
						$aDefaultForm['txt_cod_nom']							      		=$rs_1->fields['cod_nom'];
						$aDefaultForm['txt_descripcion_cargo']								=$rs_1->fields['descripcion_cargo'];
						$aDefaultForm['txt_nombre_dep']					    				=$rs_1->fields['nombre_dep'];
		if ($rs_1->fields['sexo'] == 'M'){
					$_SESSION['ciudadano']  = 'el ciudadano ';
					$_SESSION['adscrito']   = 'adscrito a ';
				}else{
				   $_SESSION['ciudadano']  =  'la ciudadana ';
					 $_SESSION['adscrito']   = 'adscrita a ';
				}
					}			
				}
		if (!$bPostBack){
			if(isset($_SESSION['id_usuario'])){
						$SQL="SELECT personal.id_personal,
								personal.primer_apellido as apellido1,
								personal.segundo_apellido as apellido2,
								personal.primer_nombre as nombre1,
								personal.segundo_nombre as nombre2, 
								personal.nacionalidad,
								personal.cedula as cedula, 
								trabajador.fecha_ingreso,
								trabajador.codigo_nomina as cod_nom,
								cargo.descripcion_cargo,
								dependencia.nombre as nombre_dep
								FROM trabajador
								INNER JOIN personal on personal.id_personal = trabajador.id_personal
								inner join cargo on trabajador.id_cargo = cargo.id_cargo
								inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
								WHERE personal.cedula='".$_SESSION['id_usuario']."' and estatus='A'";				
					$rs_1=$conn2->Execute($SQL);
  				if($rs_1->RecordCount()>0){
					  $aDefaultForm['txt_apellido1']									=$rs_1->fields['apellido1'];
						$aDefaultForm['txt_apellido2']									=$rs_1->fields['apellido2'];
						$aDefaultForm['txt_nombre1']									=$rs_1->fields['nombre1'];
						$aDefaultForm['txt_nombre2']									=$rs_1->fields['nombre2'];
						$aDefaultForm['txt_nacionalidad']				   				=$rs_1->fields['nacionalidad'];
						$aDefaultForm['txt_fecha_ingreso']								=$rs_1->fields['fecha_ingreso'];						
						$aDefaultForm['txt_cod_nom']							      	=$rs_1->fields['cod_nom'];
						$aDefaultForm['txt_descripcion_cargo']							=$rs_1->fields['descripcion_cargo'];
						$aDefaultForm['txt_nombre_dep']							    	=$rs_1->fields['nombre_dep'];
				
						if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS FIJOS'){
							$_SESSION['figura']  = 'FUNCIONARIO';
						  }
		
						if($rs_1->fields['tipo_trabajador'] == 'EMPLEADO FIJO ENCARGADURIA'){
							$_SESSION['figura']  = 'EMPLEADO';
						  }
						  
						 if($rs_1->fields['tipo_trabajador'] == 'OBREROS SEMANALES'){
							$_SESSION['figura']  = 'OBRERO';
						  }
						  
						 if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS CONTRATADOS'){
							$_SESSION['figura']  = 'CONTRATADO';
						  }
						
						if($rs_1->fields['tipo_trabajador'] == 'OBRERO CONTRATADO'){
							$_SESSION['figura']  = 'CONTRATADO';
						  }	
							
						if($rs_1->fields['tipo_trabajador'] == 'EMPLEADO JUBILADO'){
							$_SESSION['figura']  = 'JUBILADO';
						  }	
						  
						if($rs_1->fields['tipo_trabajador'] == 'OBRERO JUBILADO'){
							$_SESSION['figura']  = 'JUBILADO';
						  }	
						  
						 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADO POR INCAPACIDAD-EMPLEADO'){
							$_SESSION['figura']  = 'PENSIONADO';
						  }		
						  
						 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADO SOBREVIVIENTE-EMPLEADO-OBRERO'){
							$_SESSION['figura']  = 'PENSIONADO';
						  }			
						  
						 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADO POR INCAPACIDAD-OBRERO'){
							$_SESSION['figura']  = 'PENSIONADO';
						  }	  				 
					}			
				}
		   }
	}
	$_SESSION['recibo_act']=$aDefaultForm;
}

/*function generar_codigo($conn){
	$fecha_hoy=	date('Y-m-d');
	//$segundos = strtotime($sFechas) -  strtotime('0000-00-00');
	//$Total    = $dias + intval($segundos/86400);
	$can_dias_days= 30;  
	$fec_caducidad= date('Y-m-d', strtotime($fecha_hoy) + intval($can_dias_days*24*60*60)); 
	$sql="SELECT recibo_pago.dfecha_creacion,
	personales.cedula, personales.fecha_caducidad_const,scodigo_constancia
	FROM recibos_pagos_constancias.recibo_pago
	inner join personales on personales.cedula= recibos_pagos_constancias.recibo_pago.personales_cedula
	where cedula='".$_SESSION['id_usuario']."' and nestatus='1' and fecha_caducidad_const is not null
	order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1";
	$rs1 = $conn->Execute($sql);
	//echo $rs1->fields['scodigo_constancia'] .'=='. $codigo_const; 
	//and scodigo_constancia <> '".$codigo_const."'
	//if ($rs1->fields['scodigo_constancia'] == $codigo_const) generar_codigo($conn);
	if ($rs1->RecordCount()>0){
			$fec = date('d-m-Y',strtotime($rs1->fields['fecha_caducidad_const']));
			echo '<script>alert("Usted sólo puede solicitar tres (03) Constancias de Trabajo Completa en el mes.")</script>';		
		}	
	}

?>


<?php */
function showForm($conn,$conn2,$aDefaultForm){ 
include('funciones_generales.php');
global $conn;
global $conn2;
if(isset($_SESSION['id_usuario'])){
						$SQL="SELECT conceptofijo.monto, frecuenciapago.cod_frecuencia_pago, concepto.descripcion as nombre_concep
							FROM trabajador
							INNER JOIN personal on personal.id_personal = trabajador.id_personal
							inner join conceptofijo on conceptofijo.id_trabajador = trabajador.id_trabajador 
							inner join conceptotipopersonal on conceptotipopersonal.id_concepto_tipo_personal = conceptofijo.id_concepto_tipo_personal 
							inner join frecuenciapago on frecuenciapago.cod_frecuencia_pago = conceptotipopersonal.cod_frecuencia_pago 
							inner join concepto on concepto.id_concepto = conceptotipopersonal.id_concepto 
							inner join tipopersonal on tipopersonal.id_tipo_personal = trabajador.id_tipo_personal 
							WHERE personal.cedula='".$_SESSION['id_usuario']."' AND concepto.cod_concepto < '5000'  And frecuenciapago.cod_frecuencia_pago <='4'";	
							$rs1=$conn2->Execute($SQL);
				}
/*$rs2 = $conn->Execute("SELECT tickets_alimentacion.nmonto as monto_tickets
FROM recibos_pagos_constancias.recibo_pago
inner join recibos_pagos_constancias.tickets_alimentacion on recibos_pagos_constancias.tickets_alimentacion.ncodigo = recibos_pagos_constancias.recibo_pago.tickets_alimentacion_ncodigo 
where personales_cedula='".$_SESSION['id_usuario']."' and nanio='2015' and nmes ='2' order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1");
$aDefaultForm['txt_monto_tickets']	= $rs2->fields['monto_tickets'];*/
	//////	//////	//////	//////	//////	//////	//////	//////	//////	//////	//////
	//generar_codigo($conn)	;		
	
	$rs2 = $conn->Execute("SELECT tickets_alimentacion.nmonto as monto_tickets, tickets_alimentacion.nenabled
FROM recibos_pagos_constancias.tickets_alimentacion
where tickets_alimentacion.nenabled='1'");
	$_SESSION['monto_tickets']	= $rs2->fields['monto_tickets'];
	
	$sql="SELECT personales_cedula, scodigo_constancia
           FROM recibos_pagos_constancias.constancias_trabajo
	       where personales_cedula='".$_SESSION['id_usuario']."' and tipo_constancias_id=2 and nenabled=1";//COLOCAR VARIABLE OOOOJOOOOOOOOOOOOOOOOOOOOOOOOOOOO  and dfecha_creacion>'2018-06-01'
	$rs3 = $conn->Execute($sql);
	
	$_SESSION['ncontador']=0;
	if ($rs3->RecordCount()>0){
		$_SESSION['ncontador']=$rs3->RecordCount();
			//$fec = date('d-m-Y',strtotime($rs1->fields['fecha_caducidad_const']));
		}	
	echo '<script>alert("Usted sólo puede solicitar tres (03) Constancias de Trabajo Completa en el mes.");</script>';
	
?>


	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
    
    
<form name="frm_constancia_trabajo_simple" id="frm_constancia_trabajo_simple" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />

<script type="text/javascript" src="validar_rec_pago_registro.js"></script>


<script>
	function send(saction){
		if(saction=='consultar'){
			if(validar_recibo_pago_ano_actual()==true){ 
        var form = document.frm_rec_pago_consulta_ano_act;
			form.action.value=saction;
			form.submit();
			$("#loader").show();  }
     }	
	 $("#loader").show();  
		  }
</script>

<table class="formulario" width="62%" align="center">
<tr>
       <td></td>
 </tr>
 
       <tr>
        <th colspan="4"  class="sub_titulo"><div align="left">CONSTANCIAS DE TRABAJO--> Simple sin Sueldo</div></th>        
      </tr>
 
 
 
<!--  <tr>
    <th colspan="2" class="titulo" align="center">CONSTANCIA DE TRABAJO SIMPLE SIN SUELDO</th>    
  </tr>-->
  <tr>
      <td colspan="2" width="50%" height="200%"><font color="#666666"><p align="justify">Quien suscribe, la <b>Directora General</b> de la <b>Oficina de Gesti&oacute;n Humana del Ministerio del Poder Popular para el Proceso Social de Trabajo</b>, por medio de la presente hace constar que <?php echo $_SESSION['ciudadano'];?> <b><? print trim($aDefaultForm['txt_apellido1']." ".$aDefaultForm['txt_apellido2']).",  ".trim($aDefaultForm['txt_nombre1']." ".$aDefaultForm['txt_nombre2']);?></b>,  titular de la c&eacute;dula de identidad nro.  <b><?php echo $aDefaultForm['txt_nacionalidad']; echo '-'.number_format($_SESSION['id_usuario'], 0, '', '.');?></b>, presta sus servicios en &eacute;ste ministerio desde el  <b><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?></b>, desempe&ntilde;ando en la actualidad el cargo de <b><?= $aDefaultForm['txt_descripcion_cargo'];?></b>,  <? echo $_SESSION['adscrito'];?><b><?= $aDefaultForm['txt_nombre_dep'].'</b>';
		 
		    	$b = str_replace(".",",",$monto);//replace para cambiar puntos a coma
					list($pe, $pd) = explode(",",$b);//explode para quitar las comas. pe=parte entera , pd== parte dicimal.
					$BS = ' BOLIVARES SOBERANOS CON ';// creando variable  bs para bolivares
					$CN = ' CENTIMOS';// creando variable cn para centimos
		?></b>.<? 
		 		//	$DESC_MONTOS = array();
					//$recibo= 0;
					$total_asigna = 0;
//					$DESC_MONTOS = '';

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

    <p>&nbsp;</p>


<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
     <td colspan="5" align="center">

       
          <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_constancia_trabajo_simpleF.php" formtarget="_blank" title="Haga Click para Imprimir la Constancia de Trabajo">Imprimir</button></td>
    
   </tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>
</form>
    
    	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>
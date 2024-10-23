<?php 
include("../../header.php"); 

$settings['debug'] = true;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

$conn2 = &ADONewConnection($target);
//$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh_produccion2');
$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
$conn2->debug = true;


//Variables Globales Array 
$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

debug();
doAction();
showForm($conn,$conn2,$aDefaultForm);

// Funciones  
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
function LoadData($bPostBack){  
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
								WHERE personal.cedula='".$_SESSION['id_usuario']."'";
							
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
						$aDefaultForm['txt_nombre_dep']					    			=$rs_1->fields['nombre_dep'];
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
								trabajador.sueldo_basico,
								cargo.descripcion_cargo,
								dependencia.nombre as nombre_dep,
								tipopersonal.nombre as tipo_trabajador
								FROM trabajador
								INNER JOIN personal on personal.id_personal = trabajador.id_personal
								INNER JOIN tipopersonal on tipopersonal.cod_tipo_personal = trabajador.cod_tipo_personal
								inner join cargo on trabajador.id_cargo = cargo.id_cargo
								inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
								WHERE personal.cedula='".$_SESSION['id_usuario']."'";				
						
					$rs_1=$conn2->Execute($SQL);
  				if($rs_1->RecordCount()>0){
					  $aDefaultForm['txt_apellido1']							 =$rs_1->fields['apellido1'];
						$aDefaultForm['txt_apellido2']							 =$rs_1->fields['apellido2'];
						$aDefaultForm['txt_nombre1']							 =$rs_1->fields['nombre1'];
						$aDefaultForm['txt_nombre2']							 =$rs_1->fields['nombre2'];
						$aDefaultForm['txt_nacionalidad']				   		 =$rs_1->fields['nacionalidad'];
						$aDefaultForm['txt_fecha_ingreso']						 =$rs_1->fields['fecha_ingreso'];						
						$aDefaultForm['txt_cod_nom']							 =$rs_1->fields['cod_nom'];
						$aDefaultForm['txt_sueldo_basico']						 =$rs_1->fields['sueldo_basico'];
						$aDefaultForm['txt_descripcion_cargo']					 =$rs_1->fields['descripcion_cargo'];
						$aDefaultForm['txt_nombre_dep']							 =$rs_1->fields['nombre_dep'];
						$aDefaultForm['txt_tipo_trabajador']					 =$rs_1->fields['tipo_trabajador'];
					}			
				}
		   }
	}
	$_SESSION['recibo_act']=$aDefaultForm;
}

function generar_codigo($conn){
	
	$fecha_hoy=	date('Y-m-d');
	$can_dias_days= 90;  
	$fec_caducidad= date('Y-m-d', strtotime($fecha_hoy) + intval($can_dias_days*24*60*60)); 
	
	$sql="SELECT recibo_pago.dfecha_creacion,
	personales.cedula, personales.fecha_caducidad_const,scodigo_constancia
	FROM recibos_pagos_constancias.recibo_pago
	inner join personales on personales.cedula= recibos_pagos_constancias.recibo_pago.personales_cedula
	where cedula='".$_SESSION['id_usuario']."' and nestatus='1' and fecha_caducidad_const is not null
	order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1";
	$rs1 = $conn->Execute($sql);
	if ($rs1->RecordCount()>0){

			$fec = date('d-m-Y',strtotime($rs1->fields['fecha_caducidad_const']));
			echo '<script>alert("Actualmente usted tiene una Constancia de Trabajo Vigente hasta el '.$fec.', por lo que s\u00F3lo puede reimprimir la actual.")</script>';		
		}	
	}


?>


<?php function showForm($conn,$conn2,$aDefaultForm){ 
include('funciones_generales.php');

global $conn;
global $conn2;
if(isset($_SESSION['id_usuario'])){
						$SQL="SELECT
								conceptofijo.monto,
								frecuenciapago.cod_frecuencia_pago,
								concepto.descripcion as nombre_concep
								FROM trabajador
								INNER JOIN personal on personal.id_personal = trabajador.id_personal
								inner join conceptofijo on conceptofijo.id_trabajador = trabajador.id_trabajador 
								inner join conceptotipopersonal on conceptotipopersonal.id_concepto_tipo_personal = conceptofijo.id_concepto_tipo_personal 
								inner join frecuenciapago on frecuenciapago.cod_frecuencia_pago = conceptotipopersonal.cod_frecuencia_pago 
								inner join concepto on concepto.id_concepto = conceptotipopersonal.id_concepto 
								inner join tipopersonal on tipopersonal.id_tipo_personal = trabajador.id_tipo_personal 
								WHERE personal.cedula='".$_SESSION['id_usuario']."' AND concepto.cod_concepto < '5000' And frecuenciapago.cod_frecuencia_pago <='4'";	
								$rs1=$conn2->Execute($SQL);
				}
				      
$rs2 = $conn->Execute("SELECT tickets_alimentacion.nmonto as monto_tickets, tickets_alimentacion.nenabled
FROM recibos_pagos_constancias.recibo_pago
inner join recibos_pagos_constancias.tickets_alimentacion on recibos_pagos_constancias.tickets_alimentacion.ncodigo = recibos_pagos_constancias.recibo_pago.tickets_alimentacion_ncodigo 
where personales_cedula='".$_SESSION['id_usuario']."' and nanio='".date('Y')."' and nmes ='".date('m')."' and tickets_alimentacion.nenabled='1' order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1");
	$_SESSION['monto_tickets']	= $rs2->fields['monto_tickets'];
	generar_codigo($conn)	;


 ?>


	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
    
    
<form name="frm_constancia_trabajo_personal_activo" id="frm_constancia_trabajo_personal_activo" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" > 
    <input name="action" type="hidden" value="" />
    
    <script type="text/javascript" src="validar_rec_pago_registro.js"></script>

	<script>
        function send(saction){
            
            if(saction=='consultar'){
                $("#loader").show();
             if(validar_recibo_pago_ano_actual()==true){   
             $("#loader").show();
            var form = document.frm_rec_pago_consulta_ano_act;
                form.action.value=saction;
                form.submit();}
         }	
              }
    </script>

    <table class="formulario" width="58%" align="center">
        <tr>
            <td></td>
        </tr>
        
<!--        <tr>
         <th colspan="2" class="titulo" align="center">CONSTANCIA DE TRABAJO DETALLADA</th>    
        </tr>-->
        
      <tr>
        <th colspan="4"  class="sub_titulo"><div align="left">CONSTANCIAS DE TRABAJO--> Detallada</div></th>        
      </tr>
        
          
    		<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
        
        <tr>
            <td colspan="2" width="50%" height="200%"><font color="#666666"><p align="justify">Quien suscribe, la <b>Directora General(E)</b> de la <b>Oficina de Gesti&oacute;n Humana del Ministerio del Poder Popular para el Proceso Social de Trabajo</b>, hace constar  por medio de la presente
            <?php echo $_SESSION['ciudadano'];?> <b><? print trim($aDefaultForm['txt_apellido1']." ".$aDefaultForm['txt_apellido2']).",  ".trim($aDefaultForm['txt_nombre1']." ".$aDefaultForm['txt_nombre2']);?></b>,  titular de la c&eacute;dula de identidad Nro. <b><?php echo $aDefaultForm['txt_nacionalidad']; echo '-'.number_format($_SESSION['id_usuario'], 0, '', '.');?></b>, presta sus servicios en &eacute;ste Organismo bajo la figura de <b><?= $aDefaultForm['txt_tipo_trabajador'];?></b>, desde el  <b><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?></b>, <? echo $_SESSION['adscrito'];?><b><?= $aDefaultForm['txt_nombre_dep'].'</b>';
            
            ?></b>, devengando un: <? 
            $total_asigna = 0;
            
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
    <table class="formulario" width="62%" align="center">
  <?php
				$inter=0;
				$tabla_asignaciones=NULL;
					if($rs1->RecordCount()>0){
						while (!$rs1->EOF){
							if (($inter%2) == 0) $class_name="dataListColumn2";
							else $class_name="dataListColumn";
					    $txt_monto						=$rs1->fields['monto'];
						$nombre_concep					=$rs1->fields['nombre_concep'];
						$cod_frecuencia_pago			=$rs1->fields['cod_frecuencia_pago'];
						
						$ACUM_CONCEP = " ".$rs1->fields['nombre_concep']." ";

		   if($rs1->fields['cod_frecuencia_pago']==3){
			   $txt_monto= $txt_monto*2;
		   }else if($rs1->fields['cod_frecuencia_pago']==4){
				$txt_monto=$txt_monto/7*30;
		   }

			$total_asigna = $txt_monto  + $total_asigna;
					$rs1->MoveNext();
					$inter++;
		 }
		 $b = str_replace(".",",",$total_asigna);//replace para cambiar puntos a coma
		 list($pe, $pd) = explode(",",$b);//explode para quitar las comas. pe=parte entera , pd== parte dicimal.
		 $BS = ' BOLIVARES CON ';// creando variable  bs para bolivares
		 $CN = ' CENTIMOS';// creando variable cn para centimos
		 $totalasigna="<b>".strtoupper(num2letras($pe).$BS.num2letras(str_pad($pd, 2,'0', STR_PAD_RIGHT)).$CN.' (Bs. '.number_format($total_asigna, 2, ",", ".").')')."."."</b>";	
		/* $bono_vacacional=((((($total_asigna/30)*90)/12)/30)*150)+(($total_asigna/30)*90);
		 $bono_fin_ano1=(((((((($total_asigna/30)*150)/12)/30)*90)+$totalasigna)/30)*150);
 		 $bono_fin_ano = $bono_fin_ano1-($bono_fin_ano1*5/1000);
		 $ayuda_econ  =($total_asigna/30)*35;*/
		 
		 $monto_total= $total_asigna + $bono_vacacional+ $bono_fin_ano+$ayuda_econ+$_SESSION['monto_tickets'];
}	
$tabla_asignaciones;
$_SESSION['tabla_asignaciones']=$tabla_asignaciones;
?>
<?php /*?>     <tr class="<?=($inter%2 == 0) ? "dataListColumn2" : "dataListColumn";?>">
       <th align="right" class="titulo1">TOTAL SALARIO NORMAL:</th>
       <td class="sub_titulo" align="right" width="10%">Bs.</td >
       <th align="right"><b><?=number_format($total_asigna, 2, ",", ".");?></b></th>
     </tr><?php */?>
<? 
$inter++;

?>
  </table>
    <table width="60%" border="0" align="center" cellpadding="5" cellspacing="1" class="formulario">
      <?php
				$inter=0;
					if($rs1->RecordCount()>0){
						while (!$rs1->EOF){
							if (($inter%2) == 0) $class_name="dataListColumn2";
							else $class_name="dataListColumn";
					    $txt_monto					=$rs1->fields['monto'];
						$nombre_concep				=$rs1->fields['nombre_concep'];
						$cod_frecuencia_pago		=$rs1->fields['cod_frecuencia_pago'];
						
						$ACUM_CONCEP = " ".$rs1->fields['nombre_concep']." ";
							if ($cod_frecuencia_pago == '4')  $txt_monto =$txt_monto/7*30;
								if ($cod_frecuencia_pago == '3')  $txt_monto =$txt_monto*2;
									if ($cod_frecuencia_pago == '2')  $txt_monto =$txt_monto*1;
	?>
      <?php
			$total_asigna = $txt_monto + $total_asigna;
			
									$rs1->MoveNext();
									$inter++;
		 }
}	
?>
  </table>
  
  <table width="60%" border="0" align="center" class="formulario" >
    <tr>
         <th class="titulo" colspan="5" align="center"><?=$quincenaE;?></th>
    </tr>
    <tr>
         <th colspan="2" class="sub_titulo" width="50%"><div align="left">CONCEPTOS SALARIALES</div></th>
         <th class="sub_titulo" width="25%"><div align="center">ASIGNACIONES</div></th>
        
    </tr>
<?php
 $total_asigna = $inter = 0;
while(!$rs->EOF){ 
	if (($inter%2) == 0) $class_name="dataListColumn2";
	else $class_name="dataListColumn";
	if ($rs1->fields['categoria']=='1'){ // asignaciones salariales
	     $monto_asigna = $rs1->fields['monto'];
		 $monto_asigna_formato = number_format($monto_asigna, 2, ",", ".");
			print
			//<td align="center">'.$rs->fields['cod_concepto'].'</td>
			'<tr class="'.$class_name.'">					
					<td colspan="3">'.cambiarMayusculas($rs->fields['descripcion_concepto']).'</td>
					<td><div align="center">'.$monto_asigna_formato.'</div></td>
					<td><div align="center">&nbsp;</div></td>
			</tr>';
					$total_asigna = $monto_asigna + $total_asigna;
				 }
	$rs1->MoveNext();
	$inter++;
}
	$total_neto =  $total_asigna ;

?>
	<tr>
		<th colspan="3" class="titulo1"><div align="right" >TOTALES CONCEPTOS SALARIALES:</div></th>
		<th class="dataListColumn"><div align="center"><b><?=number_format($total_asigna, 2, ",", ".");?></b></div></th>
	</tr>
	
	<tr color="#1060C8">
		<th colspan="3" ><div align="right" >NETO N&Oacute;MINA:</div></th>
		<th class="dataListColumn2" align="center"><b>&nbsp;</b></th>		
	</tr>
	
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>

<? 
	$_quincena =($aDefaultForm['txt_tipo_trabajador']=='OBRERO')? $_POST['semana'] : $_POST['quincena'];
?>
</table>

  
 
    <table width="45%" border="0" bordercolor="#FFFFFF" align="center" class="formulario" cellpadding="5" cellspacing="0">
        <tr>
   			<th colspan="3" align="center" class="sub_titulo">&nbsp;</th>
        </tr>
        
          <tr>
              <td colspan="3"> </td>		
         </tr>
        
     <tr>
        <th width="60%" align="left" class="data_Table1">Ingreso Mensual</th>
        <th width="13%" align="right" class="data_Table1">Bs.</th>
        <th width="27%" align="right" class="data_Table1"><?=$montos['total_asigna']=number_format($total_asigna, 2, ",", ".");?></th>
      </tr>

      <tr>
           <td colspan="3"> </td>		
      </tr>
       <tr>
   		 <th colspan="3" align="center" class="sub_titulo">&nbsp;</th>
       </tr>

    </table>
    <p>&nbsp;</p>


<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
     <td colspan="5" align="center">
         <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_constancia_trabajo_completa.php" formtarget="_blank" title="Haga Click para Imprimir la Constancia de Trabajo">Imprimir</button></td>
   </tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>
</form>
    
    	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php 
$_SESSION['montos']=$montos;
} ?>	


<?php include("../../footer.php"); ?>
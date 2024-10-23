<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

$conn2 = &ADONewConnection($target);

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
				
					
					case 'buscar_persona':
						//SESSION['mostrar'] = 0;
					//GLOBALS['aDefaultForm'] = '';
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
					if ($_POST['txt_cedula']==""){ 
						$GLOBALS['aPageErrors'][]= "- Debe indicar la Cédula de Identidad del trabajador.";
						$GLOBALS['ids_elementos_validar'][]='txt_cedula';
						$bValidateSuccess=false;
					}
						if($bValidateSuccess){							
		 					
							LoadData($conn,$conn2,false);		
						}
								
				break;
			}
		}else{
			$_SESSION['mostrar'] = 0;
		//unset($_SESSION['id_usuario1']);
		LoadData($conn,$conn2,true);
	}
 }

//-----------------------------------------------------------------------------//
//-----------------------------------------------------------------------------//
function LoadData($conn,$conn2,$bPostBack){  //en esta funcion se colocan todos los campos que voy a trabajar en el formulario
global $conn;
global $conn2;
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
					if(isset($_POST['txt_cedula'])){

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
								WHERE personal.cedula='".$_POST['txt_cedula']."' and estatus='A'";
							
					$rs_1=$conn2->Execute($SQL);
					if($rs_1->RecordCount()>0){
					  $aDefaultForm['cedula']						=$rs_1->fields['cedula'];
					  if($rs_1->fields['nacionalidad']=='V') $aDefaultForm['cbo_cedulatrabajador']=1;
					  if($rs_1->fields['nacionalidad']=='E') $aDefaultForm['cbo_cedulatrabajador']=2;
					 //$aDefaultForm['nacionalidad']						=$rs_1->fields['nacionalidad'];
					  $aDefaultForm['txt_apellido1']						=$rs_1->fields['apellido1'];
						$aDefaultForm['txt_apellido2']						=$rs_1->fields['apellido2'];
						$aDefaultForm['txt_nombre1']						=$rs_1->fields['nombre1'];
						$aDefaultForm['txt_nombre2']						=$rs_1->fields['nombre2'];
						$aDefaultForm['txt_nacionalidad']				    =$rs_1->fields['nacionalidad'];
						$aDefaultForm['txt_fecha_ingreso']					=$rs_1->fields['fecha_ingreso'];						
						$aDefaultForm['txt_cod_nom']						=$rs_1->fields['cod_nom'];
						$aDefaultForm['txt_descripcion_cargo']				=$rs_1->fields['descripcion_cargo'];
						$aDefaultForm['txt_nombre_dep']					    =$rs_1->fields['nombre_dep'];
		if ($rs_1->fields['sexo'] == 'M'){
					$_SESSION['ciudadano']  = 'el ciudadano ';
					$_SESSION['adscrito']   = 'adscrito a ';
				}else{
				   $_SESSION['ciudadano']  =  'la ciudadana ';
					 $_SESSION['adscrito'] = 'adscrita a ';
				}
					}			
				}
		if (!$bPostBack){
			if(isset($_POST['txt_cedula'])){
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
								trim(both ' ' from tipopersonal.nombre) as tipo_trabajador
								FROM trabajador
								INNER JOIN personal on personal.id_personal = trabajador.id_personal
								INNER JOIN tipopersonal on tipopersonal.cod_tipo_personal = trabajador.cod_tipo_personal
								inner join cargo on trabajador.id_cargo = cargo.id_cargo
								inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia 
								WHERE personal.cedula='".$_POST['txt_cedula']."'  and estatus='A'";				
						
					$rs_1=$conn2->Execute($SQL);
  				if($rs_1->RecordCount()>0){
  						$aDefaultForm['txt_cedula']						=$rs_1->fields['cedula'];
					    $aDefaultForm['txt_apellido1']					=$rs_1->fields['apellido1'];
						$aDefaultForm['txt_apellido2']					=$rs_1->fields['apellido2'];
						$aDefaultForm['txt_nombre1']					=$rs_1->fields['nombre1'];
						$aDefaultForm['txt_nombre2']					=$rs_1->fields['nombre2'];
						$aDefaultForm['txt_nacionalidad']				=$rs_1->fields['nacionalidad'];
						$aDefaultForm['txt_fecha_ingreso']				=$rs_1->fields['fecha_ingreso'];						
						$aDefaultForm['txt_cod_nom']					=$rs_1->fields['cod_nom'];
						$aDefaultForm['txt_sueldo_basico']				=$rs_1->fields['sueldo_basico'];
						$aDefaultForm['txt_descripcion_cargo']			=$rs_1->fields['descripcion_cargo'];
						$aDefaultForm['txt_nombre_dep']					=$rs_1->fields['nombre_dep'];

	
						//$aDefaultForm['txt_tipo_trabajador']			=$rs_1->fields['tipo_trabajador'];
				if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS FIJOS'){
					$_SESSION['figura']  = 'FUNCIONARIO';
			      }
				  
				if($rs_1->fields['tipo_trabajador'] == 'OBREROS FIJOS'){
					$_SESSION['figura']  = 'OBREROS FIJOS';
			      }
				   
				if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS CONTRATADOS'){
			      	$_SESSION['figura']  = 'CONTRATADO';
			      } 
				  
				if($rs_1->fields['tipo_trabajador'] == 'OBREROS CONTRATADOS'){
			      	$_SESSION['figura']  = 'CONTRATADO';
			    }	 
				  				  
				 if($rs_1->fields['tipo_trabajador'] == 'DESIGNACION 99'){
					$_SESSION['figura']  = 'DESIGNACION 99';
			      }
 
				if($rs_1->fields['tipo_trabajador'] == 'EMPLEADO FIJO ENCARGADURIA'){
			      	$_SESSION['figura']  = 'EMPLEADO';
			      }
				  
			     if($rs_1->fields['tipo_trabajador'] == 'OBREROS SEMANALES'){
					$_SESSION['figura']  = 'OBRERO';
			      }
				  
				 if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS Y OBREROS JUBILADOS'){
			      	$_SESSION['figura']  = 'JUBILADO';
			      }	  
				  			  
				 if($rs_1->fields['tipo_trabajador'] == 'OBREROS JUBILADOS'){
			      	$_SESSION['figura']  = 'JUBILADO';
			      }	
				  
				 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADOS POR DISCAPACIDAD-EMPLEADOS Y OBREROS'){
			      	$_SESSION['figura']  = 'PENSIONADO';
			      }	
				  
				 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADOS SOBREVIVIENTE-EMPLEADOS-OBREROS'){
			      	$_SESSION['figura']  = 'PENSIONADO';
			      }	
				  
				 if($rs_1->fields['tipo_trabajador'] == 'PENSIONADOS POR DISCAPACIDAD-OBREROS'){
			      	$_SESSION['figura']  = 'PENSIONADO';
			      }	
				  
				  if($rs_1->fields['tipo_trabajador'] == 'PENSIONADOS SOBREVIVIENTE-OBREROS'){
			      	$_SESSION['figura']  = 'PENSIONADO';
			      }	
				  
				 if($rs_1->fields['tipo_trabajador'] == 'EMPLEADOS CONTRATADOS QUINCENALES'){
			      	$_SESSION['figura']  = 'CONTRATADO';
			      } 
				  
				 if($rs_1->fields['tipo_trabajador'] == 'HONORARIOS PROFESIONALES'){
			      	$_SESSION['figura']  = 'HONORARIOS PROFESIONALES';
			      } 
				  		
				  if($rs_1->fields['tipo_trabajador'] == 'DESIGNACION 99'){
			      	$_SESSION['figura']  = 'DESIGNACION 99';
			      } 
				  			
				  if($rs_1->fields['tipo_trabajador'] == 'ALTO NIVEL'){
			      	$_SESSION['figura']  = 'ALTO NIVEL';
			      } 
				  	
				 if($rs_1->fields['tipo_trabajador'] == 'EMPLEADO JUBILADO'){
			      	$_SESSION['figura']  = 'JUBILADO';
			      }	
				  
				if($rs_1->fields['tipo_trabajador'] == 'COMISION DE SERVICIO'){
			      	$_SESSION['figura']  = 'COMISION DE SERVICIO';
			      }	
				 	
				  if($rs_1->fields['tipo_trabajador'] == 'CHAMBA JUVENIL'){
			      	$_SESSION['figura']  = 'CHAMBA JUVENIL';
			      }	
					
				  if($rs_1->fields['tipo_trabajador'] == 'COMISION DE SERVICIO OBREROS'){
			      	$_SESSION['figura']  = 'COMISION DE SERVICIO OBREROS';
			      }		
				  	  
					}			
				}
		   }
	}
	$_SESSION['recibo_act']=$aDefaultForm;
}

function showForm($conn,$conn2,$aDefaultForm){
	include ('funciones_generales.php'); 
global $conn;
global $conn2;
if($_POST['txt_cedula']){
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
WHERE personal.cedula = '".$_POST['txt_cedula']."'AND trabajador.estatus='A' AND concepto.cod_concepto < '5000' 
And frecuenciapago.cod_frecuencia_pago <='4' AND concepto.cod_concepto <> '0318'  
and concepto.cod_concepto <> '0312' and concepto.cod_concepto <> '4006' and concepto.cod_concepto <> '1500'";	
								$rs1=$conn2->Execute($SQL);
				
				      
$rs2 = $conn->Execute("SELECT tickets_alimentacion.nmonto as monto_tickets, tickets_alimentacion.nenabled
FROM recibos_pagos_constancias.tickets_alimentacion
where tickets_alimentacion.nenabled='1'");
	$_SESSION['monto_tickets']	= $rs2->fields['monto_tickets'];
	
	$sql="SELECT personales_cedula, scodigo_constancia
           FROM recibos_pagos_constancias.constancias_trabajo
	       where personales_cedula='".$_POST['txt_cedula']."' and tipo_constancias_id=10 and nenabled=1";//COLOCAR VARIABLE OOOOJOOOOOOOOOOOOOOOOOOOOOOOOOOOO  and dfecha_creacion>'2018-06-01'
	$rs3 = $conn->Execute($sql);
	
	$_SESSION['ncontador']=0;
	if ($rs3->RecordCount()>0){
		$_SESSION['ncontador']=$rs3->RecordCount();
			//$fec = date('d-m-Y',strtotime($rs1->fields['fecha_caducidad_const']));
		}	
/*	echo '<script>alert("Usted sólo puede solicitar tres (03) Constancias de Trabajo Simple con Sueldo en el mes.");</script>';*/


	 
				$inter=0;
					if($rs1->RecordCount()>0){
						while (!$rs1->EOF){
							if (($inter%2) == 0) $class_name="dataListColumn2";
							else $class_name="dataListColumn";
					    $txt_monto					=$rs1->fields['monto'];
						$nombre_concep				=$rs1->fields['nombre_concep'];
						$cod_frecuencia_pago		=$rs1->fields['cod_frecuencia_pago'];
						
		 $ACUM_CONCEP = " ".$rs1->fields['nombre_concep']." ";

		   if($rs1->fields['cod_frecuencia_pago']==3){
			   $txt_monto= $txt_monto*2;
		   }else if($rs1->fields['cod_frecuencia_pago']==4){
				$txt_monto=$txt_monto/7*30;
					$txt_monto=round($txt_monto,2);
		   }
		   			$total_asigna = $txt_monto  + $total_asigna;
		   			//echo $total_asigna;
					$rs1->MoveNext();
					$inter++;
		 }

 
		 	$b = str_replace(".",",",$total_asigna);//replace para cambiar puntos a coma
			list($pe, $pd) = explode(",",$b);//explode para quitar las comas. pe=parte entera , pd== parte dicimal.
			$BS = ' BOLIVARES CON ';// creando variable  bs para bolivares
			$CN = ' CENTIMOS';// creando variable cn para centimos
		 $totalasigna="<b>".strtoupper(num2letras($pe).$BS.num2letras(str_pad($pd, 2,'0', STR_PAD_RIGHT)).$CN.' (Bs. '.number_format($total_asigna, 2, ",", ".").')')."."."</b>";		 
		 
		    $b = str_replace(".",",",$_SESSION['monto_tickets']);//replace para cambiar puntos a coma
			list($pe, $pd) = explode(",",$b);//explode para quitar las comas. pe=parte entera , pd== parte dicimal.
			$BS = ' BOLIVARES CON ';// creando variable  bs para bolivares
			$CN = ' CENTIMOS';// creando variable cn para centimos
		 $totaltickets="<b>".strtoupper(num2letras($pe).$BS.num2letras(str_pad($pd, 2,'0', STR_PAD_RIGHT)).$CN.' (Bs. '.number_format($_SESSION['monto_tickets'], 2, ",", ".").')')."</b>";
		 }
		 $_SESSION['mostrar'] = 1;
		
}	

?>

<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
    
    
<form name="frm_constancia_trabajo_trabajador" id="frm_constancia_trabajo_trabajador" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
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
<!--//<script type="text/javascript" src="validar_rec_pago_registro.js"></script>-->


<script>
	function send(saction){	
		
        var form = document.frm_constancia_trabajo_trabajador;
			form.action.value=saction;
			form.submit();
   //  }	
		  }
</script>
<table class="formulario" width="62%" align="center">
      <tr>
      <td></td>
       <!-- <td colspan="2"><img src="../../imagenes/banner_solvencia_b.gif" width="100%" height="77"></td>-->
      </tr>
      <tr>
        <th colspan="4"  class="sub_titulo"><div align="left">CONSTANCIAS DE TRABAJO--> Simple con Sueldo por Trabajador</div></th>        
      </tr>
      		<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>

  		<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
  <tr class="identificacion_seccion" >
    <td colspan="2" align="right">C&Eacute;DULA DE IDENTIDAD: 
      <select style="border-radius: 30px; border-color:#999999" id="cbo_cedulatrabajador" name="cbo_cedulatrabajador" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>></option>
        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>V-.</option>
        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>E.-</option>
        </select>
      <input style="border-radius: 20px; border-color:#999999" name="txt_cedula" id="txt_cedula" type="text"  value="<?= $aDefaultForm['txt_cedula'];?>" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." size="20" maxlength="8" onKeyPress="return isNumberKey(event);" />
      <span>*</span></td>
    <td colspan="2" align="left">
        <button type="button" class="button_personal btn_buscar" onclick="javascript:send('buscar_persona');" title="Haga Click para Buscar">Buscar</button>
    </td>
  </tr>
<tr >
         <th colspan="4" class="separacion_10"></th>
  </tr>
  <? if($_SESSION['mostrar'] == 1){ ?>
 	   <tr>
      <td colspan="4" width="50%" height="200%"><font color="#666666"><p align="justify">Quien suscribe, la <b>Directora General</b> de la <b>Oficina de Gesti&oacute;n Humana del Ministerio del Poder Popular para el Proceso Social de Trabajo</b>, hace constar  por medio de la presente que 
<?php echo $_SESSION['ciudadano'];?> <b><? print trim($aDefaultForm['txt_apellido1']." ".$aDefaultForm['txt_apellido2']).",  ".trim($aDefaultForm['txt_nombre1']." ".$aDefaultForm['txt_nombre2']);?></b>,  titular de la c&eacute;dula de identidad Nro. <b><?php echo $aDefaultForm['txt_nacionalidad']; echo '-'.number_format($aDefaultForm['txt_cedula'], 0, '', '.');?></b>, presta sus servicios en &eacute;ste Organismo bajo la figura de <b><?php echo trim($_SESSION['figura']);?></b>, desde el  <b><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?></b>, desempe&ntilde;ando en la actualidad el cargo de <b><?= $aDefaultForm['txt_descripcion_cargo'];?></b>,  <? echo $_SESSION['adscrito'];?><b><?= $aDefaultForm['txt_nombre_dep'].'</b>';
		?></b>, percibiendo un total de ingresos mensuales de  <?=$totalasigna;?><? 
//					$total_asigna = 0;

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

?>
		</b></p>
</font></td>
</tr>
	<tr>
		<td colspan="4" width="50%" height="200%"><font color="#666666"><p align="justify">Adicionalmente, percibe por concepto de Cestaticket Socialista, <b><? print $totaltickets;?> </b>mensual.</font></td>
	</tr>
</table>
  

    <table width="60%" border="0" align="center" cellpadding="5" cellspacing="1" class="formulario">
    
<!--      <tr>
        <td colspan="4" align="justify">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="justify">Constancia que se expide a petici&oacute;n de la parte interesada, en Caracas a los
          <?= ucfirst(strtolower(num2letras($dia)))?>
          (<?=$dia?>) d&iacute;as del mes  de <?=$nombremes?> del  a&ntilde;o <?= ucfirst(strtolower(num2letras($ano)))?>
          (<?=$ano?>).</td>
      </tr>-->
  </table>
<!--      <p>&nbsp;</p>-->
    <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">

<?php 
$montos['total_asigna']=$total_asigna;
//echo 'dfdsfdfdf'.$_SESSION['ncontador'];
?>
 </table> 
 <? 
 	 $_SESSION['fecha_solicitud_const']['dia']= $dia;
 	 $_SESSION['fecha_solicitud_const']['mes']= $nombremes ;
	 $_SESSION['fecha_solicitud_const']['ano']= $ano ;
$_SESSION['total_asigna']=str_replace(",",".",$total_asigna);//replace para cambiar puntos a coma

$_SESSION['totalasigna']=$totalasigna;
$_SESSION['tickets']=str_replace(",",".",$totaltickets);//replace para cambiar puntos a coma

//$_SESSION['tickets'] =$totaltickets;
// var_dump($_SESSION['total_asigna']);

 } ?> 
</tr>
     <td colspan="5" align="center">
          <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_constancia_trabajo_cedula.php" formtarget="_blank" title="Haga Click para Imprimir la Constancia de Trabajo">Imprimir</button></td>
 </tr>
</table>
  
<!--<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
     <td colspan="5" align="center">
          <button type="submit"  class="button_personal btn_imprimir"  formaction="pdf_constancia_trabajo_cedula.php" formtarget="_blank" title="Haga Click para Imprimir la Constancia de Trabajo">Imprimir</button></td>
 </tr>
</table>-->

</br>
<div id="loader" class="loaders" style="display: none;"></div>
</form>
    
    	
	</td>
	</tr>
	</tbody>
	</table>
    
    
<?php } ?>	


<?php include("../../footer.php"); ?>
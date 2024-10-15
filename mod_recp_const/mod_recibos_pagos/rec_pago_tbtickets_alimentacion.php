<?php
include('../../header.php');
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

//include("LoadCombos.php");  
$conn= getConnDB($db1);
$conn->debug = false;

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();
debug();
doAction($conn);
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

function doAction($conn){
					 if (isset($_POST['action'])){
								switch($_POST["action"]){
 							  case 'guardar':
						 		 $bValidateSuccess=true;																 
						if ($_POST['mes_vigencia']==""){
									//	echo "AQUI MES".$_POST['mes'];
									$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Mes.";
									$GLOBALS['ids_elementos_validar'][]='mes_vigencia';
									$bValidateSuccess=false;
								}
				
								if ($_POST['txt_monto_unidad']=="" or !preg_match("/^[0123456789,.]{1,30}$/i", trim($_POST['txt_monto_unidad']))){
										$GLOBALS['aPageErrors'][]= "- El campo Monto Unidad Tributaria debe contener de 1 a 10 D&iacute;gitos.";
										$GLOBALS['ids_elementos_validar'][]='txt_monto_unidad';
										$bValidateSuccess=false;
								}
							
																	
									if ($_POST['txt_porcentaje']=="" or !preg_match("/^[0123456789,.]{1,30}$/i", trim($_POST['txt_porcentaje']))){
										$GLOBALS['aPageErrors'][]= "- El campo Porcentaje debe contener de 1 a 5 D&iacute;gitos.";
										$GLOBALS['ids_elementos_validar'][]='txt_porcentaje';
										$bValidateSuccess=false;
								}				
								LoadData($conn,true);
									 					 
               if($bValidateSuccess){
                  ProcessForm($conn);
                  }	
									break;					
								 case 'calcular':
							  $bValidateSuccess=true;	
												 if ($_POST['txt_porcentaje']=="" or $_POST['txt_monto_unidad']==""){
									//	echo "AQUI MES".$_POST['mes'];
									$GLOBALS['aPageErrors'][]= "- Debe registrar el valor del monto de la unidad tribuetaria y el porcentaje a cancelar.";
									$GLOBALS['ids_elementos_validar'][]='txt_monto_cancelar';
									$bValidateSuccess=false;
								}else{
                 $_POST['txt_monto_cancelar']=(($_POST["txt_monto_unidad"]*$_POST["txt_porcentaje"])*30);	
								 //echo .$aDefaultForm['txt_monto_cancelar'];		
                  }
											 if($bValidateSuccess){
                    }

									 LoadData($conn,true);
									 break;
               case'btnMenu':
                       if($_POST['url']){
                               print "<script>document.location='".$_POST['url']."';</script>";
                       }
               break;
							 
               }
       }else{
               LoadData($conn,false);
							 
       }
} //AQUI TERMINA LA FUNCION DO ACTION

function LoadData($conn,$bPostBack){
 //en esta funcion se colocan todos los campos que voy a trabajar en el formulario
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
		//	$aDefaultForm['txt_visible']						=2;
	if (!$bPostBack){                                      //funcion propia del load data
			}else{
						$aDefaultForm['mes_vigencia']				  =$_POST["mes_vigencia"];
						$aDefaultForm['txt_monto_unidad']		      =$_POST["txt_monto_unidad"];
						$aDefaultForm['txt_porcentaje']			      =$_POST["txt_porcentaje"];	
						$aDefaultForm['txt_monto_cancelar']			  =$_POST["txt_monto_cancelar"];	
						$aDefaultForm['txt_codigo']			  		  =$_POST["txt_codigo"];	
									
				}
	}
}


function ProcessForm($conn){	//aqui se hacen todos los insert update delete del formulario

		
		if($_POST ['saction']=='guardar'){
			$SQL="UPDATE recibos_pagos_constancias.tickets_alimentacion SET    
				 usuario_actualizacion   ='".$_SESSION['id_usuario']."',
				 fecha_actualizacion      ='".date('Y-m-d H:i:s')."',
				 nenabled ='0'
				 where nenabled='1'";
				$rs= $conn->Execute($SQL);
						
			$SQL1="INSERT INTO recibos_pagos_constancias.tickets_alimentacion(nunidad_tributaria, nmonto, dfecha_creacion, nusuario_creacion, 
			nenabled, nanio_vigencia, nporcentaje, smes)  
			VALUES ('".$_POST["txt_monto_unidad"]."', '".$_POST["txt_monto_cancelar"]."','".date('Y-m-d H:i:s')."', '".$_SESSION['id_usuario']."',			
			'1','".date('Y')."', '".$_POST["txt_porcentaje"]."', '".$_POST["mes_vigencia"]."')";			
			
			$rs1= $conn->Execute($SQL1);		
			?>
			<script>
			alert("SUS DATOS HAN SIDO INGRESADOS CORRECTAMENTE"); document.location='rec_pago_tbtickets_alimentacion.php';
			</script>
			<?php
		}
		else{
    		$SQL="UPDATE recibos_pagos_constancias.tickets_alimentacion
  				SET nunidad_tributaria='".$_POST["txt_monto_unidad"]."', 
				nmonto='".$_POST["txt_monto_cancelar"]."', 
				dfecha_actualizacion='".$_SESSION['id_usuario']."',
				nusuario_actualizacion='".date('Y-m-d H:i:s')."', 
                nenabled=nenabled='1',
				nporcentaje='".$_POST["txt_porcentaje"]."',
				smes='".$_POST["mes_vigencia"]."'
			    where nenabled='1' and Ncodigo ='".$_POST["txt_codigo"]."'";	
				$rs= $conn->Execute($SQL);		
				
		}
}

//funcion que dibuja el encabezado de la pagina, para el menu
function showHeader(){
include_once('../../mod_menu/header.php'); 
}

//funcion que dibuja el cuerpo de la pagina, para que muestre el formulario
function showForm($conn,$aDefaultForm){ // en esta funcion siempre va el formulario
include('funciones_generales.php'); ?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
    
	<table width="95%" class="tabla" height="95%">
	<tbody>
	<tr valign="top">
	<td>
	
<form name="frm_rec_pago_tbtickets_alimentacion" id="frm_rec_pago_tbtickets_alimentacion" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" >
<script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="validar_rec_pago_registro.js"></script>
<script type="text/javascript" src="../../js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../../js/demo_table.css" />
<link rel="stylesheet" type="text/css" href="../../css/botones_IZ.css"/>

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
<script>     
function menu(saction,url){
		var form = document.frm_rec_pago_tbtickets_alimentacion;
		form.action.value=saction;
		document.frm_rec_pago_tbtickets_alimentacion.url.value=url;
	form.submit();
}
function send(saction){
		if(saction=='guardar'){
			if(validar_tbtickets_alimentacion()==true){  
			$("#loader").show();
			var form = document.frm_rec_pago_tbtickets_alimentacion;
		form.action.value=saction;
		form.submit();}
	}else {	// alert ('ENTRO');
	$("#loader").show();
		var form = document.frm_rec_pago_tbtickets_alimentacion;
		form.action.value=saction;
		form.submit();
}
}
function llamar_datatable(){
$('#tblDetalle').dataTable( { 
     "sPaginationType": "full_numbers"
    } );
$('#tblDetalle').css('width','100%');
}		
</script>
<!--aqui estan los campos que estan bloqueado siempre -->
<input name="action" type="hidden" value="" />
<input name="url" type="hidden" value="" />
<input name="txt_visible" type="hidden" value="<?= $aDefaultForm['txt_visible']; ?>" />
<input name="txt_monto_cancelar" type="hidden" value="<?= $aDefaultForm['txt_monto_cancelar']; ?>" />
<input name="txt_codigo" id="txt_codigo" type="hidden" value="<?= $aDefaultForm['txt_codigo']; ?>" />

<table width="95%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">

		 <tr>
		  <th colspan="5"  class="sub_titulo"><div align="left">MANTENIMIENTO --> Tickets Alimentaci&oacute;n </div></th>
        </tr>
		<tr>
       		  <th colspan="5"  class="titulo" align="center"> </th>
        </tr>
		<tr>
          <td colspan="5" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
      </tr>
	     <tr>
       		  <th colspan="5"  class="titulo" align="center"> </th>
        </tr>

			<tr class="identificacion_seccion">
				<th colspan="5" class="sub_titulo_2" align="left"> </th>
			</tr> 
			<tr class="identificacion_seccion">
				<th colspan="5" class="sub_titulo_2" align="left"> </th>
			</tr> 
		
			<tr>
				<th colspan="5">&nbsp;</th>		
			</tr>
		
<tr> 
	<th class="sub_titulo"><div align="center">A&ntilde;o Vigencia</div></th> 
    <th class="sub_titulo"><div align="center">Mes de Vigencia</div></th>
    <th class="sub_titulo"><div align="center">Monto Unidad Tributaria</div></th>
	<th class="sub_titulo"><div align="center">Porcentaje</div></th> 
    <th width="18%" class="sub_titulo"><div align="center">Monto a Cancelar</div></th> 
    </tr>

<tr>
	<td class="dataListColumn3" align="center">
      <?= date('Y');?>
    </td>
      
  	<td class="dataListColumn3" align="center">
      <select name="mes_vigencia" class="textbox" id="mes_vigencia">
      <option value="" selected="selected" >Seleccione</option>
      <? //$mes[date('m')]='selected="selected"';?>
          <option value="1" <?=($_POST['mes_vigencia']==1) ? 'selected="selected"' : ''; ?>>Enero</option>
          <option value="2" <?=($_POST['mes_vigencia']==2) ? 'selected="selected"' : ''; ?>>Febrero</option>
          <option value="3" <?=($_POST['mes_vigencia']==3) ? 'selected="selected"' : ''; ?>>Marzo</option>
          <option value="4" <?=($_POST['mes_vigencia']==4) ? 'selected="selected"' : ''; ?>>Abril</option>
          <option value="5" <?=($_POST['mes_vigencia']==5) ? 'selected="selected"' : ''; ?>>Mayo</option>
          <option value="6" <?=($_POST['mes_vigencia']==6) ? 'selected="selected"' : ''; ?>>Junio</option>
          <option value="7" <?=($_POST['mes_vigencia']==7) ? 'selected="selected"' : ''; ?>>Julio</option>
          <option value="8" <?=($_POST['mes_vigencia']==8) ? 'selected="selected"' : ''; ?>>Agosto</option>
          <option value="9" <?=($_POST['mes_vigencia']==9) ? 'selected="selected"' : ''; ?>>Septiembre</option>
          <option value="10" <?=($_POST['mes_vigencia']==10) ? 'selected="selected"' : ''; ?>>Octubre</option>
          <option value="11" <?=($_POST['mes_vigencia']==11) ? 'selected="selected"' : ''; ?>>Noviembre</option>
          <option value="12" <?=($_POST['mes_vigencia']==12) ? 'selected="selected"' : ''; ?>>Diciembre</option>
        </select>
      <span class="requerido"> * </span>
    </td>
   
    <td style="background-color:#F0F0F0;" align="center">
      <input name="txt_monto_unidad" id="txt_monto_unidad" type="text"  value="<?= $aDefaultForm['txt_monto_unidad'];?>" title="Monto Unidad Tributaria - Ingrese s&oacute;lo N&uacute;meros. Acepta m&iacute;nimo 3 y m&aacute;ximo 10 d&iacute;gitos. Ejemplo: 150" onkeypress="return isNumberKey(event);"  size="20"  maxlength="10" onBlur="javascript:send('calcular');"/>
       <span class="requerido"> * </span>  
   </td> 
     
    <td style="background-color:#F0F0F0;" align="center">
      <input name="txt_porcentaje" type="text" id="txt_porcentaje"  title="Porcentaje a Cancelar - Ingrese en n&uacute;meros el porcentaje a cancelar. Acepta un m&iacute;nimo de 1 y m&aacute;ximo 5 caracteres. Ejemplo: 1,50"  value="<?= $aDefaultForm['txt_porcentaje'];?>" size="20" maxlength="10" onBlur="javascript:send('calcular');"/> 			      
      <span class="requerido"> * </span>
    </td>
    
    <td style="background-color:#F0F0F0;" align="center">
      <input name="txt_monto_cancelar" type="text" id="txt_monto_cancelar"   value="<?= number_format($aDefaultForm['txt_monto_cancelar'], 2, ",", ".");?>" size="20" maxlength="10"/>
	  
	  
    </td>
    </tr> 

  <tr>
     <th colspan="5" class="separacion_20"></th>
  </tr>

 <tr>
     <td colspan="5" align="center">
     
          <!-- javier-->
          <button type="button" class="buttonj btn_guardar" onclick="javascript:send('guardar');" title="Haga Click para Guardar el Registro">Guardar</button> 
<!--	   <img src="../../imagenes/guardar.png" width="135" height="45" border="0" title="Guardar" onclick="javascript:send('guardar');"/> 
-->  
</td>
</tr>

  <tr>
     <th colspan="5" class="separacion_20"></th>
  </tr>

</table>
<div style="font-size:12px;">

<table width="100%" id="tblDetalle" align="center" class="formulario" border="0" cellpadding="0" cellspacing="0"> 
<thead>
      <tr>
        <th class="sub_titulo"><div align="center">A&ntilde;o Vigencia</div></th>
        <th class="sub_titulo"><div align="center">Mes de Vigencia</div></th>
        <th class="sub_titulo"><div align="center">Monto Unidad Tributaria</div></th>
        <th class="sub_titulo"><div align="center">Porcentaje</div></th>
        <th class="sub_titulo"><div align="center">Monto a Cancelar</div></th>   
        <th class="sub_titulo"><div align="center">Estatus</div></th>
        <th class="sub_titulo"><div align="center"></div></th>
        <th class="sub_titulo"><div align="center"></div></th>
      </tr>
<tbody>

<? 
$SQL="SELECT ncodigo, nunidad_tributaria, nmonto, dfecha_creacion, nusuario_creacion, dfecha_actualizacion, nusuario_actualizacion, nenabled, nanio_vigencia, 
      nporcentaje, smes
      FROM recibos_pagos_constancias.tickets_alimentacion order by nanio_vigencia";		
		
$rs=$conn->Execute($SQL);
while (!$rs->EOF ){  
	if (($inter%2) == 0) $class_name="dataListColumn2";
	else $class_name="dataListColumn";
	if ($rs->fields['nenabled']=='1'){
		
			$imagen="<img src='../../imagenes/eliminar.png' width='16' height='16' alt='Inhabilitar' />";	
  $accion="<a title='Inhabilitar Registro - Haga click para Inhabilitar el Registro' onclick='javascript:inhabilitar_editar_tick(1,".$rs->fields['ncodigo'].")'>".$imagen."</a>";
		}else{
			$imagen="<img src='../../imagenes/tick_16.png' width='16' height='16' alt='Habilitar' />";	
  $accion="<a title='Habilitar Registro - Haga click para Habilitar el Registro' onclick='javascript:inhabilitar_editar_tick(3,".$rs->fields['ncodigo'].")'>".$imagen."</a>";
			}

$imagen2="<img src='../../imagenes/pencil_16.png' width='16' height='16' alt='editar' />";	
$accion2="<a title='Editar Registro - Haga click para Editar este Registro' onclick='javascript:inhabilitar_editar_tick(2,".$rs->fields['ncodigo'].",".$rs->fields['nenabled'].")'>".$imagen2."</a>";

?>
<tr class="<?=$class_name; ?>">
        <td align='center'><font color="#666666"><?=$rs->fields['nanio_vigencia']; ?></font></td>
        <td align='center'><font color="#666666"><?=$rs->fields['smes']; ?></font></td>
        <td align='center'><font color="#666666"><?=$rs->fields['nunidad_tributaria'];?></font></td>	      
        <td align='center'><font color="#666666"><?=$rs->fields['nporcentaje'];?></font></td>
        <td align='right'><font color="#666666"><?=number_format($rs->fields['nmonto'], 2, ",", ".");?></font></td>
        <td align='center'>
        <?php if($rs->fields['nenabled']==1){
				echo 'Habilitado';
				}else{
				echo 'Inhabilitado';
				}
				?></td>  
        <td><?= $accion ?></td>
        <td><?= $accion2 ?></td>
    </tr>
<? $rs->MoveNext();
		$inter++;
}

?>
    </tbody>
  </thead>
</table>


</div>
<!--<div style="font-size:12px;">

<table width="100%" id="tblDetalle" align="center" class="formulario"border="0" cellpadding="5" cellspacing="1">
<thead>
  <tr>   
    <th width="33%" class="sub_titulo" align="center">Monto Unidad Tributaria</th>
    <th width="30%" class="sub_titulo" align="center">Porcentaje</th>
    <th width="37%" class="sub_titulo" align="center">Monto a Cancelar</th>
  </tr>
<tbody>

<? 
$SQL="SELECT ncodigo, nunidad_tributaria, nmonto, dfecha_creacion, nusuario_creacion, dfecha_actualizacion, nusuario_actualizacion, nenabled, nanio_vigencia, 
      nporcentaje, smes
	  FROM recibos_pagos_constancias.tickets_alimentacion
	  where nanio_vigencia=date('Y') and nenabled='1'";							
$rs=$conn->Execute($SQL);
while (!$rs->EOF ){

?>

<tr>
<td  align='center'><?=$rs->fields['unidad_tributaria']?></td>
<td  align='center'><?=number_format($rs->fields['porcentaje'], 2, ",", ".")?></td>
<td  align='center'><?=number_format($rs->fields['monto'], 2, ",", ".")?></td>
</tr>

<? $rs->MoveNext();}?>

    </tbody>
  </thead>
</table> 
</div>-->

<script>llamar_datatable();</script>
<div id="loader" class="loaders" style="display: none;"></div>
</form>
	</td>
	</tr>
	</tbody>
	</table>
<?php
}


include('../../footer.php'); 
?>


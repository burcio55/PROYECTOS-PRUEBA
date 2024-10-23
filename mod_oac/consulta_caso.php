<?php 
include("../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];
include ('consulta_entes.php');


doAction($conn);
debug();
function doAction($conn){
if (isset($_POST['action'])){
		$bValidateSuccess=false;
		switch($_POST['action']){
			case 'buscar': //Buscar cedula
			$bValidateSuccess=true;
		//	echo"los datos1";
			if($_POST['fecha_inicio']==''){
				$GLOBALS['aPageErrors'][]= "- La Fecha de Inicio es requerida.";
				$bValidateSuccess=false;
			}
			if ($_POST['fecha_fin']==''){
				$GLOBALS['aPageErrors'][]= "- La Fecha Fin es requerida.";
				$bValidateSuccess=false;
			}
			if ($bValidateSuccess){
				//echo"los datos1";
				$bValidateSuccess=false;				
				LoadData($conn,false);														
			}
			break;		
			case 'limpiar': 
						
			$_SESSION['boton']=1;
			$_SESSION['mostrar']=1;	
			$_SESSION['existe']=0;
			$_SESSION['mensaje_usuario']= " <b>NO POSEE CASOS REGISTRADOS PARA EL PERIODO INDICADO</b>";	
			LoadData($conn,false);
		break;
			
			}		
	  }else{
		$_SESSION['boton']=0;
		$_SESSION['existe']=0;
		$_SESSION['mensaje_usuario']='<b>Por Favor indicar Fecha Desde y Hasta de Recepción</b>';
		$_SESSION['mostrar']=0;
		unset($_SESSION['aTabla']);
		}
}
function LoadData($conn,$PostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
		$aDefaultForm = &$GLOBALS['aDefaultForm'];
		$aDefaultForm['fecha_inicio']='';
		$aDefaultForm['fecha_fin']='';		
			if (!$bPostBack){			    
					listar($conn,$inicio,$fin);
					
			}
	}
}
function listar($conn,$cedula,$letra){
$_SESSION['aTabla']='';
$sqli1="SELECT id_detalle_atencion, snro_caso, dfecha_recepcion,  oac.detalle_oac.id_via_recepcion,oac.datos_personales_oac.numcedula, oac.datos_personales_oac.nacionalidad,
oac.detalle_oac.id_tipo_asistencia, splanteamiento_caso, id_tipo_caso,
 oac.detalle_oac.id_detalle_caso, id_dato, srif,
  snombre_empresa, ssector, snombre_sindicato, snombre_contacto, stelefono_contacto, semail_contacto,
   id_organismo_remite, id_organismo_remitido, dfecha_remision, oac.detalle_oac.id_status, 
   sdescripcion_status,sdecripcion_via_recepcion, sobservaciones, snro_memo ,sgestion_detalle,stipo_asistencia,oac.detalle_oac.ntipo_beneficiario
   FROM oac.detalle_oac 
   inner join oac.datos_personales_oac on oac.datos_personales_oac.id_datos_personales=oac.detalle_oac.id_datos_personales 
   inner join oac.via_recepcion on oac.via_recepcion.id_via_recepcion =oac.detalle_oac.id_via_recepcion 
   inner join oac.tipo_asistencia on oac.tipo_asistencia.id_tipo_asistencia =oac.detalle_oac.id_tipo_asistencia
   inner join oac.gestion_detalle on oac.gestion_detalle.id_gestion =oac.detalle_oac.id_detalle_caso 
   inner join oac.status_caso on oac.status_caso.id_status =oac.detalle_oac.id_status  
  where date(dfecha_recepcion) between '".$_POST['fecha_inicio']."' and '".$_POST['fecha_fin']."' ORDER BY dfecha_recepcion "; 
$rs11= $conn->Execute($sqli1);

if($rs11->RecordCount()>0 ){
			$aTabla1[]=array();
			$i=0;
			
			$aTabla1 = &$GLOBALS['aTabla1'];
			$_SESSION['condicion']="DESDE: ".$_POST['fecha_inicio']." HASTA: ".$_POST['fecha_fin']."";
			while(!$rs11->EOF){
				//$aTabla1[$i]['id']=$j;
				$aTabla1[$i]['caso']=$rs11->fields['snro_caso'];
				if(trim($rs11->fields['nacionalidad'])=="1")$nacio='V';
				if(trim($rs11->fields['nacionalidad'])=="2")$nacio='E';
				$aTabla1[$i]['cedula']=$nacio.'-'.$rs11->fields['numcedula'];
				$aTabla1[$i]['id_detalle_atencion']=$rs11->fields['id_detalle_atencion'];
				$aTabla1[$i]['dfecha_recepcion']=$rs11->fields['dfecha_recepcion'];   
				$aTabla1[$i]['id_via_recepcion']=$rs11->fields['id_via_recepcion'];
				$aTabla1[$i]['tipo_asistencia']=$rs11->fields['stipo_asistencia'];
				$aTabla1[$i]['sdecripcion_via_recepcion']=$rs11->fields['sdecripcion_via_recepcion'];
				$aTabla1[$i]['detalle_gestion']=$rs11->fields['sgestion_detalle'];
				$aTabla1[$i]['id_status']=$rs11->fields['id_status'];	
				$aTabla1[$i]['sdescripcion_status']=$rs11->fields['sdescripcion_status'];
				$aTabla1[$i]['sobservaciones']=$rs11->fields['sobservaciones'];		
				if($rs11->fields['ntipo_beneficiario']==1){$aTabla1[$i]['beneficiario']="Trabajador del MPPPST";}	
				if($rs11->fields['ntipo_beneficiario']==2){$aTabla1[$i]['beneficiario']="Beneficiario Externo";}							
				$i++;						
			$rs11->MoveNext();
			$_SESSION['aTabla'] = $aTabla1;	
			
		}
			$_SESSION['mostrar']=1;	
			$_SESSION['boton']=1;	
			$_SESSION['existe']=0;
			/* $_SESSION['mensaje_usuario']= " <b>SE ENCONTRARON CASOS REGISTRADO EN EL M&Oacute;DULO DE ATENCI&Oacute;N AL CIUDADANO</b>";	 */
			
	}else{
		$_SESSION['boton']=1;
		$_SESSION['mostrar']=1;	
		$_SESSION['existe']=0;
		$_SESSION['mensaje_usuario']= " <b>NO POSEE CASOS REGISTRADOS PARA EL PER&Iacute;ODO INDICADO</b>";	
		}
}



?>	
<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>
<form action="<? //= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="form" id="form">

 <p>
    <input name="action" type="hidden" value="">

<script>
function send(saction){
var form=document.form;
		form.action.value=saction;
		form.submit();	
}

	

</script>
</p>
<div>
<table width="96%" align="center"  class="formulario" border="0">
  <tr>
<th colspan="6"  class="sub_titulo"><div align="left">CONSULTAS --> Casos Registrados</div></th>
</tr>
<tr>
<td colspan="6" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
</tr>
  <tr>
   <td  height="20"></td>
</tr>


</table>
 <table width="60%"  align="center" class="formulario" border="0" >
       <tr>
             <th colspan="4"  class="sub_titulo"><div align="center">FECHAS</div></th>
        </tr>

      
       <tr>
        <th width="15%"  class="sub_titulo_3"><div align="center">  <font color="#666666">Desde:  </font></div></th>
        <td width="15%"  align="center" >
      
 <input style="border-radius: 30px; border-color:#999999; width:60%" name="fecha_inicio" id="fecha_inicio" type="text"  maxlength="9"  value="<?=$aDefaultForm['fecha_inicio'];?>"  readonly/>
        <a  id="f_btn1"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
        <script type="text/javascript">
        Calendar.setup({
        inputField : "fecha_inicio",
        trigger    : "f_btn1",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d" 
        });
        </script> <span class="requerido">*</span></td>
        <th width="15%"  class="sub_titulo_3"><div align="center">   <font color="#666666">Hasta:   </font></div></th>
        <td width="15%"   align="center" > 
         <input style="border-radius: 30px; border-color:#999999; width:60%" name="fecha_fin" id="fecha_fin" type="text"  maxlength="9"  value="<?=$aDefaultForm['fecha_fin'];?>"  readonly/> 
        <a  id="f_btn2"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
        <script type="text/javascript">
        Calendar.setup({
        inputField : "fecha_fin",
        trigger    : "f_btn2",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%Y-%m-%d" 
        });
        </script> <span class="requerido">*</span></td>
        </tr>

	    <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2"> </th>
        </tr>
    <tr>
   		<td  height="15"></td>
    </tr>
      
      <tr>                        
        <td colspan="4" align="center"><font color="#666666">
          <img src="../imagenes/warning_16.png" width="16" height="16"/><? print $_SESSION['mensaje_usuario'];   ?> 
          </font></td>
          </tr>
 
      <tr>
         <th colspan="4" height="20">&nbsp;</th>		
      </tr>
      <tr>
      <td colspan="4" height="20" align="center">
      <button type="button" id="enviar2"  name="enviar2" class="button_personal btn_buscar" onClick="send('buscar')"  >Buscar</button>
          <button name="Limpiar" type=  "button" class="button_personal  btn_limpiar" onClick="javascript:send('limpiar')" >Limpiar</button>
        </td>
      </tr>
      
      <tr>
         <td colspan="4" >&nbsp;</td>
      </tr>
    </table>

<table class="display formulario" border="0" align="center" id="tblDetalle" width="96%">
					<thead>
					
                    <tr>
                  <th style="border-radius: 30px; border-color:#999999; width:80%" colspan="9" class="sub_titulo_2" align="left">SOLICITUDES REGISTRADAS  DESDE: <?=$_POST['fecha_inicio']?> HASTA: <?=$_POST['fecha_fin']?> </th></tr>  
				  <tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th width="5%" align="left" class="sub_titulo"><div align="center">Nro. Caso</div></th>
                        
						<th width="10%" align="left" class="sub_titulo"><div align="center">Fecha de Recepci&oacute;n</div></th>
                        <th width="5%" align="left" class="sub_titulo"><div align="center">C.I. del Beneficiario</div></th>
                        <th width="10%" align="left" class="sub_titulo"><div align="center">Clase de Beneficiario</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">V&iacute;a de Recepci&oacute;n</div></th>
                        <th width="10%" align="left" class="sub_titulo"><div align="center">Tipo</div></th>
                     
                        <th width="20%" align="left" class="sub_titulo"><div align="center">Gestión</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">Estatus</div></th>
						<th width="20%" align="left" class="sub_titulo"><div align="center">Detalles de la Entrega</div></th>
				
					</tr>
						<tbody>
						<?
						$aTabla=$_SESSION['aTabla'];
						$aDefaultForm = $GLOBALS['aDefaultForm'];
						for( $c=0; $c < count($aTabla); $c++){
						?>
							<tr>
                                 <td  class="texto-normal" align="center"><?=$aTabla[$c]['caso']?></td>
								
								<td class="texto-normal" align="center"><?=$aTabla[$c]['dfecha_recepcion']?></td>
                                
                                 <td  class="texto-normal" align="center"><?=$aTabla[$c]['cedula']?></td>
                             
                                <td class="texto-normal" align="center"><?=$aTabla[$c]['beneficiario'];?></td>
								
								<td class="texto-normal" align="center"><?=$aTabla[$c]['sdecripcion_via_recepcion'];?></td>
								<td class="texto-normal" align="center"><?=$aTabla[$c]['tipo_asistencia'];?></td>
                                								<td class="texto-normal" align="center"><?=$aTabla[$c]['detalle_gestion'];?></td>
								<td class="texto-normal" align="center"><?= $aTabla[$c]['sdescripcion_status'];?>
                                
                           <? if($aTabla[$c]['id_status'] =='1'){?><? }
                              if($aTabla[$c]['id_status'] =='2'){?><? }?>  
                                </td> 
								
								<td class="texto-normal" align="center"><?=$aTabla[$c]['sobservaciones']?></td>					
									
		</div>
							</tr>
						<? 
						} 
						?>	
						</tbody>
					</thead>
				</table>
      <table width="98%" border="0" align="center">
        <tr>
        	<td colspan="3">&nbsp;</td>
        </tr>
        <? //var_dump($_SESSION['aTabla']);?>
        <tr>
        	<td colspan="3" align="right"><div align="center">
             <button type="submit" name="imprimir" class="button_personal btn_imprimir"  formaction="reporte001_PDF.php" formtarget="_blank" >Imprimir</button>
          </div></td>		
        </tr>
         <tr>
        	<td colspan="3" height="20">&nbsp;</td>
        </tr> 	 
    </table>

</div>
 </form>    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../footer.php"); ?>
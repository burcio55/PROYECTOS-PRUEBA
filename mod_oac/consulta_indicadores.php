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

			
			}		
	  }else{
		$_SESSION['boton']=0;
		$_SESSION['existe']=0;
		$_SESSION['mensaje_usuario']='Por Favor Indicar Fecha Incio y Fin de Recepción';
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
$sqli1="SELECT id_detalle_atencion,  snro_caso, dfecha_recepcion, 
       oac.detalle_oac.id_via_recepcion, id_tipo_asistencia, splanteamiento_caso, id_tipo_caso, 
       id_detalle_caso, id_dato, srif, snombre_empresa, ssector, snombre_sindicato, 
       snombre_contacto, stelefono_contacto, semail_contacto, id_organismo_remite, 
       id_organismo_remitido, dfecha_remision, oac.detalle_oac.id_status, sdescripcion_status,sdecripcion_via_recepcion,
       sobservaciones, id_gestion, snro_memo
  FROM oac.detalle_oac 
  inner join oac.datos_personales_oac on oac.datos_personales_oac.id_datos_personales=oac.detalle_oac.id_datos_personales
  inner join oac.via_recepcion on oac.via_recepcion.id_via_recepcion =oac.detalle_oac.id_via_recepcion
  inner join oac.status_caso on   oac.status_caso.id_status  =oac.detalle_oac.id_status
  where dfecha_recepcion between '".$_POST['fecha_inicio']."' and '".$_POST['fecha_fin']."'"; 
$rs11= $conn->Execute($sqli1);
		
if($rs11->RecordCount()>0 ){
			$aTabla1[]=array();
			$i=0;
			
			$aTabla1 = &$GLOBALS['aTabla1'];

			while(!$rs11->EOF){
				//$aTabla1[$i]['id']=$j;
				$aTabla1[$i]['caso']=$rs11->fields['snro_caso'];
				$aTabla1[$i]['id_detalle_atencion']=$rs11->fields['id_detalle_atencion'];
				$aTabla1[$i]['dfecha_recepcion']=date('Y/m/d',$rs11->fields['dfecha_recepcion']);   
				$aTabla1[$i]['id_via_recepcion']=$rs11->fields['id_via_recepcion'];
				$aTabla1[$i]['sdecripcion_via_recepcion']=$rs11->fields['sdecripcion_via_recepcion'];
				$aTabla1[$i]['id_status']=$rs11->fields['id_status'];	
				$aTabla1[$i]['sdescripcion_status']=$rs11->fields['sdescripcion_status'];
				$aTabla1[$i]['sobservaciones']=$rs11->fields['sobservaciones'];				
				$i++;						
			$rs11->MoveNext();
			$_SESSION['aTabla'] = $aTabla1;	
		}
			$_SESSION['mostrar']=1;	
			$_SESSION['boton']=1;	
			$_SESSION['existe']=0;
			$_SESSION['mensaje_usuario']= " CASOS REGISTRADO EN OAC...";	
			
	}else{
		$_SESSION['boton']=1;
		$_SESSION['mostrar']=1;	
		$_SESSION['existe']=0;
		$_SESSION['mensaje_usuario']= " NO POSEE CASOS REGISTRADOS PARA EL PERIODO INDICADO..";	
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
 
<th class="sub_titulo" align="left"  width="96%" colspan="2" >CONSULTAS.- Verificaci&oacute;n de Casos</th>
<tr>
 <td width="49%">Fecha Inicio:
 <input name="fecha_inicio" id="fecha_inicio" type="text"  maxlength="10"  value="<?=$aDefaultForm['fecha_inicio'];?>"  readonly/>
        <a  id="f_btn1"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
        <script type="text/javascript">
        Calendar.setup({
        inputField : "fecha_inicio",
        trigger    : "f_btn1",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%d-%m-%Y" 
        });
        </script>
</td>
 <td width="49%">Fecha Fin:
 <input name="fecha_fin" id="fecha_fin" type="text"  maxlength="10"  value="<?=$aDefaultForm['fecha_fin'];?>"  readonly/>
        <a  id="f_btn2"><img src="../imagenes/calendar_16.png" alt="" width="16" height="16" align="top"/></a>
        <script type="text/javascript">
        Calendar.setup({
        inputField : "fecha_fin",
        trigger    : "f_btn2",
        onSelect   : function() { this.hide() },
        showTime   : false,
        dateFormat : "%d-%m-%Y" 
        });
        </script>
</td>
</tr>
</table>
<br />
<table width="96%" align="center">
<tr>
   <th  height="16" align="center" class="dataListColumn"><img src="../imagenes/warning_16.png" width="16" height="16"/><? print $_SESSION['mensaje_usuario']; 
  ?> <button type="button" id="enviar2"  name="enviar2" class="button_personal btn_buscar" onClick="send('buscar')"  >Buscar</button></th>
  </tr>
</table>
<br />
<tr>
<td>
<br />	
<table class="display" border="0" align="center" id="tblDetalle" width="100%">
					<thead>
					<tr>
						<th width="5%" align="left" class="sub_titulo"><div align="center">Nro. Caso</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">Fecha de recepci&oacute;n</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">V&iacute;a de recepci&oacute;n</div></th>
						<th width="10%" align="left" class="sub_titulo"><div align="center">Estatus</div></th>
						<th width="30%" align="left" class="sub_titulo"><div align="center">Observaciones</div></th>
				
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
								
								<td class="texto-normal" align="center"><?=$aTabla[$c]['sdecripcion_via_recepcion'];?></td>
								
								<td class="texto-normal" align="center"><?= $aTabla[$c]['sdescripcion_status'];?>
                                
                           <? if($aTabla[$c]['id_status'] =='1'){?><img src="../imagenes/alerta.png" width="15" height="15" title=""/><? }
                              if($aTabla[$c]['id_status'] =='2'){?><img src="../imagenes/search_16.png" width="15" height="15" /><? }?>  
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
	
	
		
			</td>
		</tr>
	

</div>
 </form>    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php include("../footer.php"); ?>
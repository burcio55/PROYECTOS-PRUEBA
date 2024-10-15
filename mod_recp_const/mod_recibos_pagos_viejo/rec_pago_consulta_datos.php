<?php 
include("../../header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);
$conn->debug = $settings['debug'];

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
              case 'buscar_persona':
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
		 					
							LoadData($conn,false);		
						}
              break;
             
             
               }
       		}else{
       			$_SESSION['mostrar'] = 0;		
				LoadData($conn,true);
      		 }
} //AQUI TERMINA LA FUNCION DO ACTION

function LoadData($conn,$bPostBack){  //en esta funcion se colocan todos los campos que voy a trabajar en el formulario
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			$aDefaultForm['txt_visible']						=2;
	if (!$bPostBack){                                      //funcion propia del load data
			if(isset($_POST['txt_cedula'])){               // este select es cuando necesito los datos por primera vez
			//echo  'ENTRANDO 1';
			$SQL="SELECT personales.cedula as cedula,
					personales.nacionalidad as nacionalidad,
					personales.primer_apellido as apellido1,
					personales.segundo_apellido as apellido2,
					personales.primer_nombre as nombre1,
					personales.segundo_nombre as nombre2,
					personales.fecha_nacimiento as fecha_nac,
					personales.sexo as sexo,	
					personales.slateralidad as lateralidad,
					personales.sdiscapacidad as discapacidad,		
					personales.sinscripcion_militar as inscripcion_militar,	
					personales.ntelefono_personal as telefono_personal,
					personales.ntelefono_hab as telefono_hab,		
					personales.semail as correoelectronico,	
					personales.nentidad_entidad as entidad,
					personales.nmunicipio_municipio as municipio,										
					personales.nparroquia_parroquia as parroquia,	
					personales.ndireccion1 as direccion1,
					personales.sdireccion1_2 as direccion1_2,
					personales.ndireccion2 as direccion2,
					personales.sdireccion2_2 as direccion2_2,
					personales.ndireccion3 as direccion3,
					personales.sdireccion3_2 as direccion3_2,				
					personales.ndireccion4 as direccion4,				
   			    	personales.sdireccion4_2 as direccion4_2,			
					personales.spunto_referencia as punto_referencia, 					
					personales.subicacion_fisica as ubicacion_fisica,
					personales.ntelefono_oficina as telefono_oficina,						
					public.entidad.scapital as ciudad_descripcion,
					public.municipio.sdescripcion as municipio_descripcion,
					public.parroquia.sdescripcion as parroquia_descripcion,
					personales.srif		
					FROM public.personales
					LEFT JOIN public.entidad ON entidad.nentidad=personales.nentidad_entidad
					LEFT JOIN public.municipio ON municipio.nmunicipio=personales.nmunicipio_municipio
					LEFT JOIN public.parroquia ON parroquia.nparroquia=personales.nparroquia_parroquia
					where personales.cedula ='".$_POST['txt_cedula']."'" ;	
				$rs=$conn->Execute($SQL);
				if($rs->RecordCount()>0){
					$_SESSION['mostrar'] = 1;
					$aDefaultForm['cedula']							=$rs->fields['cedula'];
      				    $aDefaultForm['txt_nacionalidad']				=$rs->fields['nacionalidad'];
						$aDefaultForm['txt_apellido1']					=$rs->fields['apellido1'];
						$aDefaultForm['txt_apellido2']					=$rs->fields['apellido2'];
						$aDefaultForm['txt_nombre1']					=$rs->fields['nombre1'];
						$aDefaultForm['txt_nombre2']					=$rs->fields['nombre2'];
						$aDefaultForm['txt_fecha_nac']					=$rs->fields['fecha_nac'];
						$aDefaultForm['txt_sexo']						=$rs->fields['sexo'];
						$aDefaultForm['cbo_lateralidad']				=$rs->fields['lateralidad'];
						$aDefaultForm['cbo_discapacidad']				=$rs->fields['discapacidad'];
						$aDefaultForm['cbo_inscripcion_militar']		=$rs->fields['inscripcion_militar'];
						$aDefaultForm['txt_telefono_personal']			=$rs->fields['telefono_personal'];
						$aDefaultForm['txt_telefono_hab']				=$rs->fields['telefono_hab'];
						$aDefaultForm['txt_correoelectronico']			=$rs->fields['correoelectronico'];
						$aDefaultForm['cbo_entidad']					=$rs->fields['entidad'];
						$aDefaultForm['cbo_municipio']					=$rs->fields['municipio'];
						$aDefaultForm['cbo_parroquia']					=$rs->fields['parroquia'];
						$aDefaultForm['direccion1']						=$rs->fields['direccion1'];
						$aDefaultForm['txt_direccion1_2']				=$rs->fields['direccion1_2'];
						$aDefaultForm['direccion2']						=$rs->fields['direccion2'];
						$aDefaultForm['txt_direccion2_2']				=$rs->fields['direccion2_2'];
						$aDefaultForm['direccion3']						=$rs->fields['direccion3'];
						$aDefaultForm['txt_direccion3_2']				=$rs->fields['direccion3_2'];
						$aDefaultForm['direccion4']						=$rs->fields['direccion4'];
						$aDefaultForm['txt_direccion4_2']				=$rs->fields['direccion4_2'];
						$aDefaultForm['txt_punto_referencia']			=$rs->fields['punto_referencia'];	
						$aDefaultForm['txt_ubicacion_fisica']			=$rs->fields['ubicacion_fisica'];	
						$aDefaultForm['txt_telefono_oficina']			=$rs->fields['telefono_oficina'];
						$aDefaultForm['srif']							=$rs->fields['srif'];
						$aDefaultForm['txt_visible']					=2;
					
					if($aDefaultForm['cbo_municipio']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.municipio WHERE nmunicipio='".$aDefaultForm['cbo_municipio']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_municipio_descripcion']=$rs->fields['sdescripcion'];
                    }
					
					if($aDefaultForm['cbo_parroquia']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.parroquia WHERE nparroquia='".$aDefaultForm['cbo_parroquia']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_parroquia_descripcion']=$rs->fields['sdescripcion'];
                    }
					

					}//fin recorset			
				}

		}
	}
}
function ProcessForm($conn){
	
}
//funcion que dibuja el cuerpo de la pagina, para que muestre el formulario
function showForm($conn,$aDefaultForm){ // en esta funcion siempre va el formulario
?>
<script type="text/javascript">
	function send(saction){
		if(saction=='buscar_persona'){
			//if(validar_formulario()==true){
				$("#loader").show();
				var form = document.frm_rec_consulta_datos;
				form.action.value=saction;
				form.submit();
			//}
		}
		
}


</script>
	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
    <tbody>
    <tr valign="top">
    <td>

<form name="frm_rec_consulta_datos" id="frm_rec_consulta_datos" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" >

<input name="action" type="hidden" value="" />
<input name="url" type="hidden" value="" />
<input name="txt_visible" type="hidden" value="<?= $aDefaultForm['txt_visible']; ?>" />
	
<table width="95%" border="0" align="center" class="formulario">
        <tr>
		  <th colspan="4"  class="sub_titulo"><div align="left">PROCESOS --> Consultar Datos</div></th>
        </tr>
<!--        <tr>
       		  <th colspan="4"  class="titulo" align="center">CONSULTA DATOS DEL TRABAJADOR</th>
        </tr>-->
        
			<tr>
				<th colspan="4" class="separacion_10"></th>
			</tr>
</table>
<table width="60%" border="0" align="center" class="formulario">		
  <tr class="identificacion_seccion" >
    <td colspan="2" align="right">C&Eacute;DULA DE IDENTIDAD: 
      <select id="cbo_cedulatrabajador" name="cbo_cedulatrabajador" >
        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>></option>
        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>V-.</option>
        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_cedulatrabajador']))) {echo " selected=\"selected\"";}?>>E.-</option>
        </select>
      <input name="txt_cedula" id="txt_cedula" type="text"  value="<?= $aDefaultForm['txt_cedula'];?>" title="C&eacute;dula de Identidad - Ingrese s&oacute;lo N&uacute;meros. Acepta 8 Digitos." size="29" maxlength="8" onKeyPress="return isNumberKey(event);" />
      <span>*</span></td>
    <td colspan="2" align="left">
        <button type="button" class="button_personal btn_buscar" onclick="javascript:send('buscar_persona');" title="Haga Click para Buscar">Buscar</button>
    </td>
  </tr>
 
	</table>

     <table width="95%" border="0" align="center" class="formulario"> 
      <tr  style="background-color:#FBF0D2;">
         <th colspan="4" class="separacion_10"></th>
  </tr> 
   <tr  >
            <th colspan="4" height="20"></th>
        </tr>  
  <? if($_SESSION['mostrar'] == 1){ ?>
        <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2" align="left">DATOS BASICOS</th>
        </tr>
        
        <tr>
            <td style="background-color:#F0F0F0; color:#666" align="center"><strong>C&eacute;dula de Identidad</strong></td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?=number_format( $aDefaultForm['cedula'], 0, '', '.')?></font></td>
            <td style="background-color:#F0F0F0; color:#666"" align="center"><strong>Nacionalidad </strong></td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?php if($aDefaultForm['txt_nacionalidad']==1){
            echo 'VENEZOLANO';
            }else{
            echo 'EXTRANJERA';
            }
            ?>
            </font></td>
        </tr>
        
        <tr>
            <th colspan="4">&nbsp;</th>		
        </tr>
    
        <tr>
            <th width="25%" class="sub_titulo" align="center">Primer Apellido</th>		
            <th width="25%" class="sub_titulo" align="center">Segundo Apellido</th>
            <th width="25%" class="sub_titulo" align="center">Primer Nombre</th>
            <th width="25%" class="sub_titulo" align="center">Segundo Nombre</th>  
        </tr>
        
        <tr>
            <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_apellido1'];?></font></td>
            <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_apellido2'];?></font></td>
            <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_nombre1'];?></font></td>
            <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_nombre2'];?></font></td>
        </tr>
        
        <tr>
        	<th colspan="4">&nbsp;</th>		
        </tr>
        
        <tr>  
            <th width="25%" class="sub_titulo" align="center">Fecha de Nacimiento</th>
            <th width="25%" class="sub_titulo" align="center">Sexo</th> 
            <th width="25%" class="sub_titulo" align="center">Lateralidad</th>
            <th width="25%" class="sub_titulo" align="center">Discapacidad</th>
        </tr>
    
        <tr>
	    	<td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?php if($aDefaultForm['txt_fecha_nac']!=""){echo strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_nac']));} ?></font></td>
		    <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?php if($aDefaultForm['txt_sexo']==2){echo 'MASCULINO';}else  if ($aDefaultForm['txt_sexo']==1){echo 'FEMENINO';}else{echo ' ';}?></font></td>
            <td align="center" style="background-color:#F0F0F0;"><font color="#666666">
					<?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                        $disab="disabled";
                    }
                    ?> 
                    <select style="width: 80%" id="cbo_lateralidad" name="cbo_lateralidad" <?php echo $disab; ?> >
                        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Seleccione</option>
                        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Ambidiestra</option>
                        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Derecho(a)</option>
                        <option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Zurdo(a)</option>
                    </select>   	
              </font></td>
            <td align="center" style="background-color:#F0F0F0;"><font color="#666666">
					<?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                        $disab="disabled";
                    }
                    ?> 
                    <select style="width: 80%" id="cbo_discapacidad" name="cbo_discapacidad" <?php echo $disab; ?>>
                        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>Seleccione</option>
                        <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>F&iacute;sica</option>
                        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>Ps&iacute;quica</option>
                        <option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>Sensorial</option>
                        <option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>Intelectual o Mental</option>
                        <option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>Ninguna</option>
                    </select>   
            </font></td>
       </tr> 

        <tr>
            <th colspan="4">&nbsp;</th>		
        </tr>
          
        <tr> 
            <th width="25%" class="sub_titulo" align="center">Inscripci&oacute;n Militar</th> 
            <th width="25%" class="sub_titulo" align="center">Tel&eacute;fono Personal</th>
            <th width="25%" class="sub_titulo" align="center">Tel&eacute;fono Habitaci&oacute;n</th>
            <th width="25%" class="sub_titulo" align="center">Correo Electr&oacute;nico Personal</th> 
        </tr>
    
        <tr>
            <td align="center" style="background-color:#F0F0F0;"><font color="#666666">
                <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                }
                ?> 
                <select style="width: 80%" id="cbo_inscripcion_militar" name="cbo_inscripcion_militar" <?php echo $disab; ?> >
                    <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_inscripcion_militar']))) {echo " selected=\"selected\"";}?>>Seleccione</option>
                    <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_inscripcion_militar']))) {echo " selected=\"selected\"";}?>>S&iacute;</option>
                    <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_inscripcion_militar']))) {echo " selected=\"selected\"";}?>>No</option>
                </select><span> *</span>    	
            </font></td>
          <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_telefono_personal'];?></font></td>
            <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_telefono_hab'];?></font></td>
        
          <td style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_correoelectronico'];?></font></td>
            

         
		</tr> 
		 <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
         <tr> 
            <th class="sub_titulo" align="center" colspan="2">N° del Registro de Informaci&oacute;n Fiscal Personal(R.I.F)</th> 
           <td colspan="2" style="background-color:#F0F0F0;" align="center"><font color="#666666"><?= $aDefaultForm['srif'];?></font></td>
        </tr>
 		<tr>
            
        </tr>
         <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
          
        <tr class="identificacion_seccion" >
            <th colspan="4" class="sub_titulo_2" align="left">DIRECCION DE HABITACION</th>
        </tr> 
        
        	 <tr>
   		<th width="50%" colspan="2" class="sub_titulo" align="center">Estado</th> 
		<th width="50%" colspan="2" class="sub_titulo" align="center">Municipio</th>
	 </tr>
    
     <tr>
 	    <td align="center" colspan="2" style="background-color:#F0F0F0;"><font color="#666666">
            <select style="width: 80%" id="cbo_entidad" name="cbo_entidad" onChange="estado_combo();"  disabled="disabled"  >
            <option value="">Seleccione</option>
            <? LoadEstado ($conn) ; print $GLOBALS['sHtml_cb_Estado']; ?>
            </select></font>
        </td>
       
        <td align="center" colspan="2" style="background-color:#F0F0F0;"><font color="#666666">
            <select style="width: 80%" id="cbo_municipio" name="cbo_municipio" onChange="municipio_combo();"  disabled="disabled"  >
            <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_municipio_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_municipio']; ?>"><?= $aDefaultForm['cbo_municipio_descripcion'];?></option>
            </select></font>
        </td>
     </tr>
       <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
     <tr>
		 <th width="50%" class="sub_titulo" colspan="4" align="center">Parroquia</th>
		<!-- <th width="50%" class="sub_titulo_3" colspan="2" align="center">Ciudad</th> -->
     </tr>
    
     <tr>
         <td align="center" colspan="4"style="background-color:#F0F0F0;"><font color="#666666">
            <select style="width: 80%"  id="cbo_parroquia" name="cbo_parroquia"  disabled="disabled" >
            <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_parroquia_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_parroquia']; ?>"><?= $aDefaultForm['cbo_parroquia_descripcion'];?></option>
           </select></font>
         </td> 
     
     </tr>
 <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
        <tr>
            <th class="sub_titulo" colspan="2" id="td_direccion1">
              <input name="direccion1" id="direccion1" type="radio"   disabled="disabled"  class="texto-normal" value="1" <?= ($aDefaultForm['direccion1'] == 1) ?  'checked="checked"' : '' ?>/> 
              Avenida
              <input name="direccion1"  id="direccion1" type="radio"  disabled="disabled" class="texto-normal" value="2" <?= ($aDefaultForm['direccion1'] == 2) ?  'checked="checked"' : '' ?>/> 
              Calle
              <input name="direccion1"  id="direccion1" type="radio" disabled="disabled" class="texto-normal" value="3" <?= ($aDefaultForm['direccion1'] == 3) ?  'checked="checked"' : '' ?>/> 
              Carrera
              <input name="direccion1"  id="direccion1" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion1'] == 4) ?  'checked="checked"' : '' ?>/> 
              Carretera
              <input name="direccion1"  id="direccion1" type="radio"   disabled="disabled"class="texto-normal" value="5" <?= ($aDefaultForm['direccion1'] == 5) ?  'checked="checked"' : '' ?>/> 
              Esquina
              <input name="direccion1"  id="direccion1" type="radio"  disabled="disabled" class="texto-normal" value="6" <?= ($aDefaultForm['direccion1'] == 6) ?  'checked="checked"' : '' ?>/> 
              Vereda
        	 
  		   </th>
           
          <th class="sub_titulo" colspan="2" id="td_direccion1">
            <input name="direccion2" type="radio" class="texto-normal"  disabled="disabled" value="1" <?= ($aDefaultForm['direccion2'] == 1) ?  'checked="checked"' : '' ?>/> 
            Casa

            <input name="direccion2" type="radio" class="texto-normal" disabled="disabled" value="3" <?= ($aDefaultForm['direccion2'] == 3) ?  'checked="checked"' : '' ?>/> 
            Edificio
<!--            <input name="direccion2" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion2'] == 4) ?  'checked="checked"' : '' ?>/> 
            Local-->
            <input name="direccion2" type="radio" class="texto-normal"  disabled="disabled" value="5" <?= ($aDefaultForm['direccion2'] == 5) ?  'checked="checked"' : '' ?>/> 
            Quinta
           
           </th>
	   </tr>
      
      <tr>
      
       <td  colspan="2" style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_direccion1_2'];?></font></td>
        <td  colspan="2"  style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_direccion2_2'];?></font></td>
       
        
	  </tr>
      <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
     
         
	  <tr>
         <th align ="left" colspan="2" class="sub_titulo" id="td_direccion3">
            <input name="direccion3" type="radio" class="texto-normal"  disabled="disabled" value="1" <?= ($aDefaultForm['direccion3'] == 1) ?  'checked="checked"' : '' ?>/> 
            Apartamento
            <input name="direccion3" type="radio" class="texto-normal"  disabled="disabled" value="2" <?= ($aDefaultForm['direccion3'] == 2) ?  'checked="checked"' : '' ?>/> 
            Local
            <input name="direccion3" type="radio" class="texto-normal"  disabled="disabled" value="3" <?= ($aDefaultForm['direccion3'] == 3) ?  'checked="checked"' : '' ?>/> 
            Oficina
               
         </th>
     
         <th colspan="2" class="sub_titulo" id="td_direccion4">
            <input name="direccion4" type="radio" class="texto-normal"  disabled="disabled" value="1" <?= ($aDefaultForm['direccion4'] == 1) ?  'checked="checked"' : '' ?>/> 
            Barrio
            <input name="direccion4" type="radio" class="texto-normal"  disabled="disabled" value="2" <?= ($aDefaultForm['direccion4'] == 2) ?  'checked="checked"' : '' ?>/> 
            Caserio
            <input name="direccion4" type="radio" class="texto-normal"  disabled="disabled" value="3" <?= ($aDefaultForm['direccion4'] == 3) ?  'checked="checked"' : '' ?>/> 
            Conjunto Residencial
            <input name="direccion4" type="radio" class="texto-normal"  disabled="disabled" value="4" <?= ($aDefaultForm['direccion4'] == 4) ?  'checked="checked"' : '' ?>/> 
            Sector
            <input name="direccion4" type="radio" class="texto-normal"  disabled="disabled" value="5" <?= ($aDefaultForm['direccion4'] == 5) ?  'checked="checked"' : '' ?>/> 
            Urbanizaci&oacute;n
            <input name="direccion4" type="radio" class="texto-normal"  disabled="disabled" value="6" <?= ($aDefaultForm['direccion4'] == 6) ?  'checked="checked"' : '' ?>/> 
            Zona
           
        </th>
     </tr>
    
	 <tr>
   		  <td  colspan="2" style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_direccion3_2'];?></font></td>
       
		<td  colspan="2" style="background-color:#F0F0F0;" align="left"><font color="#666666"><?= $aDefaultForm['txt_direccion4_2'];?></font></td>
    
       
	 </tr>
    <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
     

     <tr>
          <th colspan="4" class="sub_titulo" align="center">Punto de Referencia</th>
     </tr>

     <tr>

          <td colspan="4" align="center" style="background-color:#F0F0F0;" ><font color="#666666"><?= $aDefaultForm['txt_punto_referencia'];?></font></td>	
	  </tr>
      <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
     
       <tr class="identificacion_seccion" >
		<th colspan="4" class="sub_titulo_2" align="left">DATOS LABORALES</th>
	</tr> 
    
    <tr>
		<th colspan="3" class="sub_titulo" align="left">Ubicaci&oacute;n F&iacute;sica</th>
        <th colspan="1" class="sub_titulo" align="left">Tel&eacute;fono Oficina</th>
	</tr>
	
	<tr>
		<td colspan="3" align="left"style="background-color:#F0F0F0;" ><font color="#666666"><?= $aDefaultForm['txt_ubicacion_fisica'];?></font></td>
		
		
        
        <td align="left"style="background-color:#F0F0F0;" ><font color="#666666"><?= $aDefaultForm['txt_telefono_oficina'];?></font></td>
		
	</tr>
      
     <tr  >
            <th colspan="4" height="20"></th>
        </tr> 
   
<? } ?>

</table>

<div id="loader" class="loaders" style="display: none;"></div>
</form>

	</td>
	</tr>
	</tbody>
	</table>
<?php
}
?>
    		
<?php include("../../footer.php"); ?>
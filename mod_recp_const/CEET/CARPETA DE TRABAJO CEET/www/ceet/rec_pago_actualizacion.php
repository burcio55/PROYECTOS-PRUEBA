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
               case 'guardar':
                       $bValidateSuccess=true;
											 
				if ($_POST['cbo_lateralidad']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Lateralidad";
								$GLOBALS['ids_elementos_validar'][]='cbo_lateralidad';
								$bValidateSuccess=false;
				}
				
				if ($_POST['cbo_discapacidad']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Discapacidad";
								$GLOBALS['ids_elementos_validar'][]='cbo_discapacidad';
								$bValidateSuccess=false;
				}
				
				if ($_POST['cbo_inscripcion_militar']==""){
								$GLOBALS['aPageErrors'][]= "- Debe seleccionar un valor de la lista";
								$GLOBALS['ids_elementos_validar'][]='cbo_inscripcion_militar';
								$bValidateSuccess=false;
				}
				
				if ($_POST['txt_telefono_personal']=="" or !preg_match("/^[[:digit:]]{11,15}+$/",trim($_POST['txt_telefono_personal'])))
				{
								$GLOBALS['aPageErrors'][]= "- El campo Telefono Personal:  debe contener solo numeros y acepta de 11 a 15 digitos.";
								$GLOBALS['ids_elementos_validar'][]='txt_telefono_personal';
								$bValidateSuccess=false;
				}
				
				if ($_POST['txt_telefono_hab']=="" or !preg_match("/^[[:digit:]]{11,15}+$/",trim($_POST['txt_telefono_hab'])))
				{
								$GLOBALS['aPageErrors'][]= "- El campo Telefono de habitaci&oacute;n: debe contener solo numeros y acepta de 11 a 15 digitos.";
								$GLOBALS['ids_elementos_validar'][]='txt_telefono_hab';
								$bValidateSuccess=false;
				}
				
				if($_POST['txt_correoelectronico']=="" or !preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",$_POST['txt_correoelectronico']))
				{
						$GLOBALS['aPageErrors'][]= "- El campo Correo Electr&oacute;nico Personal: No tiene el formato correcto.";
						$GLOBALS['ids_elementos_validar'][]='txt_correoelectronico';
						$bValidateSuccess=false;
				} 	
				
				if ($_POST['txt_direccion1_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion1_2']))
				{
						$GLOBALS['aPageErrors'][]= "- El campo Direccion: debe contener de 1 a 100 caracteres.";
						$GLOBALS['ids_elementos_validar'][]='txt_direccion1_2';
						$bValidateSuccess=false;
				}
				
				if ($_POST['txt_direccion2_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion2_2']))
				{
						$GLOBALS['aPageErrors'][]= "- El campo Direccion: debe contener de 1 a 100 caracteres.";
						$GLOBALS['ids_elementos_validar'][]='txt_direccion2_2';
						$bValidateSuccess=false;
				}
				
/*				if ($_POST['txt_direccion3_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion3_2']))
				{
						$GLOBALS['aPageErrors'][]= "- El campo Direccion: debe contener de 1 a 100 caracteres.";
						$GLOBALS['ids_elementos_validar'][]='txt_direccion3_2';
						$bValidateSuccess=false;
				}*/
				
				if ($_POST['txt_direccion4_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion4_2']))
				{
						$GLOBALS['aPageErrors'][]= "- El campo Direccion: debe contener de 1 a 100 caracteres.";
						$GLOBALS['ids_elementos_validar'][]='txt_direccion4_2';
						$bValidateSuccess=false;
				}
				
				if ($_POST['cbo_entidad']==""){
						$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Entidad Federal.";
						$GLOBALS['ids_elementos_validar'][]='cbo_entidad';
						$bValidateSuccess=false;
				}
				
				if ($_POST['cbo_municipio']==""){
						$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Municipio.";
						$GLOBALS['ids_elementos_validar'][]='cbo_municipio';
						$bValidateSuccess=false;
				}
				
				if ($_POST['cbo_parroquia']==""){
						$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Parroquia.";
						$GLOBALS['ids_elementos_validar'][]='cbo_parroquia';
						$bValidateSuccess=false;
				}
				
/*				if ($_POST['cbo_ciudad']==""){
						$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Ciudad.";
						$GLOBALS['ids_elementos_validar'][]='cbo_ciudad';
						$bValidateSuccess=false;
				}*/
				
			if ($_POST["txt_punto_referencia"]=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_punto_referencia']))
				{
						$GLOBALS['aPageErrors'][]= "- El campo Punto de Referencia: debe contener de 1 a 100 caracteres.";
						$GLOBALS['ids_elementos_validar'][]='txt_punto_referencia';
						$bValidateSuccess=false;
				}
				
				
				
			if ($_POST['txt_ubicacion_fisica']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_ubicacion_fisica']))
			{
				$GLOBALS['aPageErrors'][]= "- El campo Ubicaci&oacute;n F&iacute;sica: debe contener de 1 a 100 caracteres.";
				$GLOBALS['ids_elementos_validar'][]='txt_ubicacion_fisica';
				$bValidateSuccess=false;
			}
			
			if ($_POST['txt_telefono_oficina']=="" or !preg_match("/^[[:digit:]]{11,15}+$/",trim($_POST['txt_telefono_oficina'])))
			{
					$GLOBALS['aPageErrors'][]= "- El campo Telef\u00F3no Personal debe contener de 11 a 15 d\u00EDgitos.";
					$GLOBALS['ids_elementos_validar'][]='txt_telefono_oficina';
					$bValidateSuccess=false;
			}
				
               if($bValidateSuccess){
                  ProcessForm($conn);
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

function LoadData($conn,$bPostBack){  //en esta funcion se colocan todos los campos que voy a trabajar en el formulario
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			$aDefaultForm['txt_visible']						=2;
	if (!$bPostBack){                                      //funcion propia del load data
			if(isset($_SESSION['id_usuario'])){               // este select es cuando necesito los datos por primera vez
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
					public.parroquia.sdescripcion as parroquia_descripcion
					FROM public.personales
					LEFT JOIN public.entidad ON entidad.nentidad=personales.nentidad_entidad
					LEFT JOIN public.municipio ON municipio.nmunicipio=personales.nmunicipio_municipio
					LEFT JOIN public.parroquia ON parroquia.nparroquia=personales.nparroquia_parroquia
					where personales.cedula ='".$_SESSION['id_usuario']."'" ;	
				$rs=$conn->Execute($SQL);
				if($rs->RecordCount()>0){
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
						$aDefaultForm['txt_visible']					=1;
					
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
					
/*					if($aDefaultForm['cbo_ciudad']!=""){
						$SQL="SELECT nentidad, scapital 
												  FROM public.entidad where nentidad='".$aDefaultForm['cbo_ciudad']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_ciudad_descripcion']=$rs->fields['scapital'];
                    }*/
					}			
				}
		}else{
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
					public.parroquia.sdescripcion as parroquia_descripcion
					FROM public.personales
					LEFT JOIN public.entidad ON entidad.nentidad=personales.nentidad_entidad
					LEFT JOIN public.municipio ON municipio.nmunicipio=personales.nmunicipio_municipio
					LEFT JOIN public.parroquia ON parroquia.nparroquia=personales.nparroquia_parroquia
					where personales.cedula ='".$_SESSION['id_usuario']."'" ;	
				$rs=$conn->Execute($SQL);
				if($rs->RecordCount()>0){
			    		$aDefaultForm['txt_nacionalidad']				    =$rs->fields['nacionalidad'];
						$aDefaultForm['txt_apellido1']						=$rs->fields['apellido1'];
						$aDefaultForm['txt_apellido2']						=$rs->fields['apellido2'];
						$aDefaultForm['txt_nombre1']						=$rs->fields['nombre1'];
						$aDefaultForm['txt_nombre2']						=$rs->fields['nombre2'];
						$aDefaultForm['txt_fecha_nac']						=$rs->fields['fecha_nac'];
						$aDefaultForm['txt_sexo']							=$rs->fields['sexo'];
				}
						$aDefaultForm['cbo_lateralidad']					=$_POST["cbo_lateralidad"];
						$aDefaultForm['cbo_discapacidad']					=$_POST["cbo_discapacidad"];
						$aDefaultForm['cbo_inscripcion_militar']			=$_POST["cbo_inscripcion_militar"];
						$aDefaultForm['txt_telefono_personal']				=$_POST["txt_telefono_personal"];
						$aDefaultForm['txt_telefono_hab']					=$_POST["txt_telefono_hab"];
						$aDefaultForm['txt_correoelectronico']				=$_POST["txt_correoelectronico"];
						$aDefaultForm['cbo_entidad']						=$_POST["cbo_entidad"];
						$aDefaultForm['cbo_municipio']						=$_POST["cbo_municipio"];
						$aDefaultForm['cbo_parroquia']						=$_POST["cbo_parroquia"];
						//$aDefaultForm['cbo_ciudad']							=$_POST["cbo_ciudad"];
						$aDefaultForm['direccion1']							=$_POST["direccion1"];
						$aDefaultForm['txt_direccion1_2']					=$_POST["txt_direccion1_2"];
						$aDefaultForm['direccion2']							=$_POST["direccion2"];
						$aDefaultForm['txt_direccion2_2']					=$_POST["txt_direccion2_2"];
						$aDefaultForm['direccion3']							=$_POST["direccion3"];
						$aDefaultForm['txt_direccion3_2']					=$_POST["txt_direccion3_2"];
						$aDefaultForm['direccion4']							=$_POST["direccion4"];
						$aDefaultForm['txt_direccion4_2']					=$_POST["txt_direccion4_2"];
						$aDefaultForm['txt_punto_referencia']				=$_POST["txt_punto_referencia"];
						$aDefaultForm['txt_ubicacion_fisica']			    =$_POST['txt_ubicacion_fisica'];	
						$aDefaultForm['txt_telefono_oficina']		    	=$_POST['txt_telefono_oficina'];
						$aDefaultForm['txt_visible']						=$_POST["txt_visible"];
						
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
							
					/*if($aDefaultForm['cbo_ciudad']!=""){
						$SQL="SELECT scapital 
						FROM public.entidad WHERE nentidad='".$aDefaultForm['cbo_ciudad']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_ciudad_descripcion']=$rs->fields['scapital'];
                    }*/
				}
	}
}
function ProcessForm($conn){
		//aqui se hacen todos los insert update delete del formulario
	if(!$_POST["direccion3"] or $_POST["txt_direccion3_2"] == ''){
		$_POST["direccion3"] = '0';
	}
			$SQL="UPDATE public.personales SET    
						slateralidad							='".$_POST["cbo_lateralidad"]."',
						sdiscapacidad							='".$_POST["cbo_discapacidad"]."',
						sinscripcion_militar		        	='".$_POST["cbo_inscripcion_militar"]."',
						ntelefono_personal			        	='".$_POST["txt_telefono_personal"]."',    
						ntelefono_hab							='".$_POST["txt_telefono_hab"]."',   
						semail									='".$_POST["txt_correoelectronico"]."',
						ndireccion1								='".$_POST['direccion1']."',
						sdireccion1_2							='".$_POST['txt_direccion1_2']."',
						ndireccion2								='".$_POST['direccion2']."',
						sdireccion2_2							='".trim(strtoupper($_POST['txt_direccion2_2']))."',
						ndireccion3								='".$_POST['direccion3']."',
						sdireccion3_2							='".trim(strtoupper($_POST['txt_direccion3_2']))."',
						ndireccion4								='".$_POST['direccion4']."',
						sdireccion4_2							='".$_POST['txt_direccion4_2']."',
						nentidad_entidad						='".$_POST["cbo_entidad"]."',
						nmunicipio_municipio					='".$_POST["cbo_municipio"]."',
						nparroquia_parroquia					='".$_POST["cbo_parroquia"]."',
						spunto_referencia						='".$_POST['txt_punto_referencia']."',	
						usuario_idactualizacion   				='".$_SESSION['id_usuario']."',
						dfecha_actualizacion     				='".date('Y-m-d H:i:s')."',
						nenabled 								='1',
						subicacion_fisica						='".$_POST['txt_ubicacion_fisica']."',	
						ntelefono_oficina						='".$_POST["txt_telefono_oficina"]."'
						where personales.cedula ='".$_SESSION['id_usuario']."'";
						$rs= $conn->Execute($SQL);
						?>
					<script>
						alert("SUS DATOS HAN SIDO ACTUALIZADOS CORRECTAMENTE"); 
				        document.location='../vista.php';
						</script>
						<?php
}
//funcion que dibuja el cuerpo de la pagina, para que muestre el formulario
function showForm($conn,$aDefaultForm){ // en esta funcion siempre va el formulario
?>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
    <tbody>
    <tr valign="top">
    <td>

<form name="frm_rec_pago_actualizacion" id="frm_rec_pago_actualizacion" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" >
<script type="text/javascript" src="validar_rec_pago_actualizacion.js"></script>
<input name="action" type="hidden" value="" />
<input name="url" type="hidden" value="" />
<input name="txt_visible" type="hidden" value="<?= $aDefaultForm['txt_visible']; ?>" />
	
<table width="95%" border="0" align="center" class="formulario">
        <tr>
       		<th colspan="4"  class="titulo" align="center">ACTUALIZACI&Oacute;N DE DATOS DEL TRABAJADOR</th>
        </tr>
        
        <tr class="identificacion_seccion">
       		 <th colspan="4" class="sub_titulo_2" align="left">DATOS B&Aacute;SICOS</th>
        </tr>
        
        <tr>
            <td style="background-color:#F0F0F0; color:#666" align="center"><strong>C&eacute;dula de Identidad</strong></td>
            <td style="background-color:#F0F0F0;" align="center"><font color="#666666"><?=number_format( $_SESSION['id_usuario'], 0, '', '.')?></font></td>
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
            <td align="center"><font color="#666666">
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
                    </select><span>*</span>    	
              </font></td>
            <td align="center"><font color="#666666">
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
                    </select><span>*</span>    
            </font></td>
       </tr> 

        <tr>
            <th colspan="4">&nbsp;</th>		
        </tr>
          
        <tr> 
            <th width="25%" class="sub_titulo_3" align="center">Inscripci&oacute;n Militar</th> 
            <th width="25%" class="sub_titulo_3" align="center">Tel&eacute;fono Personal</th>
            <th width="25%" class="sub_titulo_3" align="center">Tel&eacute;fono Habitaci&oacute;n</th>
            <th width="25%" class="sub_titulo_3" align="center">Correo Electr&oacute;nico Personal</th> 
        </tr>
    
        <tr>
            <td align="center"><font color="#666666">
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
          
            <td align="center"><font color="#666666">
                <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                }
                ?> 
                <input style="width: 95%" name="txt_telefono_personal" id="txt_telefono_personal" type="text"  value="<?= $aDefaultForm['txt_telefono_personal'];?>" title="Tel&eacute;fono Personal - Ingrese s&oacute;lo N&uacute;meros. Acepta 11 d&iacute;gitos. Ejemplo: 02121234567" onkeypress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. 02121234567"/>  
                <span class="requerido"> * </span>	
            </font></td>
      
            <td align="center"><font color="#666666">
                <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                }
                ?> 
                <input style="width: 95%" name="txt_telefono_hab" id="txt_telefono_hab" type="text"  value="<?= $aDefaultForm['txt_telefono_hab'];?>" title="Tel&eacute;fono Habitaci&oacute;n - Ingrese s&oacute;lo N&uacute;meros. Acepta 11 d&iacute;gitos. Ejemplo: 02121234567" onkeypress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. 02121234567"/> <span class="requerido"> * </span>
            </font></td> 

            <td align="center"><font color="#666666">
				<?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                }
                ?>
                <input style="width: 95%" name="txt_correoelectronico" type="text" id="txt_correoelectronico"  title="Correo Electr&oacute;nico Personal - Ingrese un Correo Electr&oacute;nico V&aacute;lido. Acepta un m&iacute;nimo de 10 y m&aacute;ximo 30 caracteres. Ejemplo: juancito@gmail.com"  value="<?= $aDefaultForm['txt_correoelectronico'];?>" maxlength="40" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. juancito@gmail.com" /> <span class="requerido"> * </span>
            </font></td>
		</tr> 

        <tr>
            <th colspan="4">&nbsp;</th>		
        </tr>
          
        <tr class="identificacion_seccion" >
            <th colspan="4" class="sub_titulo_2" align="left">DIRECCI&Oacute;N DE HABITACI&Oacute;N</th>
        </tr> 
        
        	 <tr>
   		<th width="50%" colspan="2" class="sub_titulo_3" align="center">Estado</th> 
		<th width="50%" colspan="2" class="sub_titulo_3" align="center">Municipio</th>
	 </tr>
    
     <tr>
 	    <td align="center" colspan="2">
            <select style="width: 80%" id="cbo_entidad" name="cbo_entidad" onChange="estado_combo();"   >
            <option value="">Seleccione</option>
            <? LoadEstado ($conn) ; print $GLOBALS['sHtml_cb_Estado']; ?>
            </select><span class="requerido"> * </span>
        </td>
       
        <td align="center" colspan="2">
            <select style="width: 80%" id="cbo_municipio" name="cbo_municipio" onChange="municipio_combo();" >
            <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_municipio_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_municipio']; ?>"><?= $aDefaultForm['cbo_municipio_descripcion'];?></option>
            </select><span class="requerido"> * </span>
        </td>
     </tr>
      
     <tr>
		 <th width="50%" class="sub_titulo_3" colspan="4" align="center">Parroquia</th>
		<!-- <th width="50%" class="sub_titulo_3" colspan="2" align="center">Ciudad</th> -->
     </tr>
    
     <tr>
         <td align="center" colspan="4">
            <select style="width: 80%"  id="cbo_parroquia" name="cbo_parroquia">
            <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_parroquia_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_parroquia']; ?>"><?= $aDefaultForm['cbo_parroquia_descripcion'];?></option>
           </select><span class="requerido"> * </span>
         </td> 
        
         <!--<td align="center" colspan="2">
            <select style="width: 80%"  id="cbo_ciudad" name="cbo_ciudad">
            <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_ciudad_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_ciudad']; ?>"><?= $aDefaultForm['cbo_ciudad_descripcion'];?></option>
            </select><span class="requerido"> * </span>
         </td>-->
     </tr>

        <tr>
            <th class="sub_titulo_3" colspan="2" id="td_direccion1">
              <input name="direccion1" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion1'] == 1) ?  'checked="checked"' : '' ?>/> 
              Avenida
              <input name="direccion1" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion1'] == 2) ?  'checked="checked"' : '' ?>/> 
              Calle
              <input name="direccion1" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion1'] == 3) ?  'checked="checked"' : '' ?>/> 
              Carrera
              <input name="direccion1" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion1'] == 4) ?  'checked="checked"' : '' ?>/> 
              Carretera
              <input name="direccion1" type="radio" class="texto-normal" value="5" <?= ($aDefaultForm['direccion1'] == 5) ?  'checked="checked"' : '' ?>/> 
              Esquina
              <input name="direccion1" type="radio" class="texto-normal" value="6" <?= ($aDefaultForm['direccion1'] == 6) ?  'checked="checked"' : '' ?>/> 
              Vereda
        	  <span class="requerido"> * </span>
  		   </th>
           
          <th class="sub_titulo_3" colspan="2" id="td_direccion1">
            <input name="direccion2" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion2'] == 1) ?  'checked="checked"' : '' ?>/> 
            Casa
           <!-- <input name="direccion2" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion2'] == 2) ?  'checked="checked"' : '' ?>/> 
            Centro Comercial-->
            <input name="direccion2" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion2'] == 3) ?  'checked="checked"' : '' ?>/> 
            Edificio
<!--            <input name="direccion2" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion2'] == 4) ?  'checked="checked"' : '' ?>/> 
            Local-->
            <input name="direccion2" type="radio" class="texto-normal" value="5" <?= ($aDefaultForm['direccion2'] == 5) ?  'checked="checked"' : '' ?>/> 
            Quinta
            <span class="requerido"> * </span>
           </th>
	   </tr>
      
      <tr>
           <td width="50%" colspan="2"> 
                 <?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                    }
                  ?> 
          <input style="width: 95%" name="txt_direccion1_2" type="text" id="txt_direccion1_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." value="<?= $aDefaultForm['txt_direccion1_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
          <span class="requerido"> * </span>
           </td>
      
           <td width="50%" colspan="2">
                <?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                    }
                ?> 
         <input style="width: 95%" name="txt_direccion2_2" type="text" id="txt_direccion2_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." value="<?= $aDefaultForm['txt_direccion2_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
          <span class="requerido"> * </span>
          </td>
	  </tr>
     
      <tr>
         <th colspan="4">&nbsp;</th>		
      </tr>
         
	  <tr>
         <th align ="left" colspan="2" class="sub_titulo_3" id="td_direccion3">
            <input name="direccion3" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion3'] == 1) ?  'checked="checked"' : '' ?>/> 
            Apartamento
            <input name="direccion3" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion3'] == 2) ?  'checked="checked"' : '' ?>/> 
            Local
            <input name="direccion3" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion3'] == 3) ?  'checked="checked"' : '' ?>/> 
            Oficina
            <span class="requerido"> * </span>    
         </th>
     
         <th colspan="2" class="sub_titulo_3" id="td_direccion4">
            <input name="direccion4" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion4'] == 1) ?  'checked="checked"' : '' ?>/> 
            Barrio
            <input name="direccion4" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion4'] == 2) ?  'checked="checked"' : '' ?>/> 
            Caserio
            <input name="direccion4" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion4'] == 3) ?  'checked="checked"' : '' ?>/> 
            Conjunto Residencial
            <input name="direccion4" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion4'] == 4) ?  'checked="checked"' : '' ?>/> 
            Sector
            <input name="direccion4" type="radio" class="texto-normal" value="5" <?= ($aDefaultForm['direccion4'] == 5) ?  'checked="checked"' : '' ?>/> 
            Urbanizaci&oacute;n
            <input name="direccion4" type="radio" class="texto-normal" value="6" <?= ($aDefaultForm['direccion4'] == 6) ?  'checked="checked"' : '' ?>/> 
            Zona
            <span class="requerido"> * </span>
        </th>
     </tr>
    
	 <tr>
   		<td width="50%" colspan="2"> 
		  <?php 
              $disab="";
              if($aDefaultForm['txt_visible']==2){ 
              $disab="disabled";
              }
          ?> 
      <input style="width: 95%" name="txt_direccion3_2" type="text" id="txt_direccion3_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." value="<?= $aDefaultForm['txt_direccion3_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
    	</td>
    
        <td width="50%" colspan="2"> 
                    <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                $disab="disabled";
                }
            ?> 
         <input style="width: 95%" name="txt_direccion4_2" type="text" id="txt_direccion4_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de 10 y m&aacute;ximo 80 caracteres." value="<?= $aDefaultForm['txt_direccion4_2'];?>" maxlength="80" <?php echo $disab; ?> autocomplete="off" />
          <span class="requerido"> * </span>
        </td>
	 </tr>
    
<!--     <tr>
        <th colspan="4">&nbsp;</th>		
     </tr>
          


     <tr>
          <th colspan="4">&nbsp;</th>		
     </tr>
          -->
     <tr>
          <th colspan="4" class="sub_titulo_3" align="center">Punto de Referencia</th>
     </tr>

     <tr>
          <td colspan="4" align="center">
			 <?php 
				  $disab="";
				  if($aDefaultForm['txt_visible']==2){    
				  $disab="disabled";
				  }
             ?>
            <input style="width: 95%" name="txt_punto_referencia" type="text" class="textbox" id="txt_punto_referencia"  title="Punto de Referencia - Ingrese un punto de referencia de su direcci&oacute;n de Habitaci&oacute;n. Acepta un m&iacute;nimo de 10 y m&aacute;ximo 30 caracteres"  value="<?= $aDefaultForm['txt_punto_referencia'];?>" maxlength="150" 
            <?php echo $disab; ?> autocomplete="off"/> 
          <span class="requerido"> * </span>
          </td>
	  </tr>
      
       <tr class="identificacion_seccion" >
		<th colspan="4" class="sub_titulo_2" align="left">DATOS LABORALES</th>
	</tr> 
    
    <tr>
		<th colspan="3" class="sub_titulo_3" align="left">Ubicaci&oacute;n F&iacute;sica</th>
        <th colspan="1" class="sub_titulo_3" align="left">Tel&eacute;fono Oficina</th>
	</tr>
	
	<tr>
		<td colspan="3" align="center">
		<?php 
		$disab="";
		if($aDefaultForm['txt_visible']==2){    
			$disab="disabled";
		}
		?>
		<input style="width: 95%" name="txt_ubicacion_fisica" type="text" class="textbox" id="txt_ubicacion_fisica"  title="Ubicaci&oacute;n F&iacute;sica - Acepta un m&aacute;ximo de 100 caracteres"  value="<?= $aDefaultForm['txt_ubicacion_fisica'];?>" maxlength="150" 
		<?php echo $disab; ?> autocomplete="off" /> 
		<span class="requerido"> * </span>
		</td>
        
        <td colspan="1" align="center">
			<?php 
		$disab="";
		if($aDefaultForm['txt_visible']==2){ 
			$disab="disabled";
		}
		?> 
		<input style="width: 90%" name="txt_telefono_oficina" id="txt_telefono_oficina" type="text"  value="<?= $aDefaultForm['txt_telefono_oficina'];?>" title="Tel&eacute;fono Oficina - Ingrese s&oacute;lo N&uacute;meros. Acepta m&iacute;nimo 11 d&iacute;gitos. Ejemplo: 02121234567" onkeypress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. 02121234567"/> <span class="requerido"> * </span>
		</td>        
	</tr>
      
        
      <!--<tr>
         <th colspan="4">&nbsp;</th>		
      </tr>
          
          
      <tr class="identificacion_seccion3" >
    	  <td colspan="4" style="background-color:#f2c4c4;" align="left"><font color="#666666">NRO. DE CONTACTO EN EL AREA DE TRABAJO (Extensi&oacute;n)
        				<?php 
										$disab="";
										if($aDefaultForm['txt_visible']==2){ 
										$disab="disabled";
										}
								?> 
      <input style="width: 10%" name="txt_telefono_ext" id="txt_telefono_ext" type="text"  value="<?= $aDefaultForm['txt_telefono_ext'];?>" title="Tel&eacute;fono Extensi&oacute;n - Ingrese s&oacute;lo N&uacute;meros. Acepta m&iacute;nimo 4 d&iacute;gitos. Ejemplo: 1234" onkeypress="return isNumberKey(event);" maxlength="5" <?php echo $disab; ?> autocomplete="off" /> <span class="requerido"> * </span>	
     </font></td>
     </tr> 
-->
     <tr>
         <td colspan="4" align="center">
       <button type="button" class="button_personal btn_guardar" onclick="javascript:send('guardar');" title="Guardar Registro -  Haga Click para Guardar la Informaci&oacute;n">Guardar</button>
          </td>
     </tr>

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
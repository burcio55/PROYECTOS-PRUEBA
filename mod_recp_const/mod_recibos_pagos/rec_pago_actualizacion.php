<!-- http://10.46.4.17/minpptrassi/mod_recp_const/mod_recibos_pagos/rec_pago_actualizacion.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../../public/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  
  
<?php 
include("../../header.php"); 
include("../mod_recibos_pagos/general_LoadCombo.php"); 
/*var_dump $GLOBALS['sHtml_cb_tipo_Discapacidad'];
die();*/

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
	if (isset($_POST['action']))
	{
	    switch($_POST["action"]){
            case 'guardar':
                $bValidateSuccess=true;
												
				if ($_POST['cbo_estado_civil']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Estado Civil";
					$GLOBALS['ids_elementos_validar'][]='cbo_estado_civil';
					$bValidateSuccess=false;
				}
					
				if ($_POST['txt_telefono_personal']=="" or !preg_match("/^[[:digit:]]{11,15}+$/",trim($_POST['txt_telefono_personal']))){
					$GLOBALS['aPageErrors'][]= "- El campo Tel&eacute;fono Personal:  debe contener s&oacute;lo n&uacute;meros y acepta de once (11) a quince (15) d&iacute;gitos.";
					$GLOBALS['ids_elementos_validar'][]='txt_telefono_personal';
					$bValidateSuccess=false;
				}
					
				if ($_POST['txt_telefono_hab']=="" or !preg_match("/^[[:digit:]]{11,15}+$/",trim($_POST['txt_telefono_hab']))){
					$GLOBALS['aPageErrors'][]= "- El campo Tel&eacute;fono de habitaci&oacute;n: debe contener s&oacute;lo n&uacute;meros y acepta de once (11) a quince (15) d&iacute;gitos.";
					$GLOBALS['ids_elementos_validar'][]='txt_telefono_hab';
					$bValidateSuccess=false;
				}
					
				if($_POST['txt_correoelectronico']=="" or !preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",$_POST['txt_correoelectronico'])){
					$GLOBALS['aPageErrors'][]= "- El campo Correo Electr&oacute;nico Personal: No tiene el formato correcto.";
					$GLOBALS['ids_elementos_validar'][]='txt_correoelectronico';
					$bValidateSuccess=false;
				}
					
				/*
				if ($_POST['txt_rif']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_rif'])){
					$GLOBALS['aPageErrors'][]= "- Debe indicar su Número de RIF.";
					$GLOBALS['ids_elementos_validar'][]='txt_rif';
					$bValidateSuccess=false;
				}
				 */
									
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
					
				if ($_POST['direccion1']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar una de las siguientes opciones: (Avenida, Calle, Carrera, Carretera, Esquina, Vereda).";
					$GLOBALS['ids_elementos_validar'][]='direccion1';
					$bValidateSuccess=false;
				}
				if ($_POST['txt_direccion1_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion1_2'])){
					$GLOBALS['aPageErrors'][]= "- El campo Direcci&oacute;n: debe contener de uno (1) a cien (100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_direccion1_2';
					$bValidateSuccess=false;
				}
				if ($_POST['direccion2']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar una de las siguientes opciones: (Casa, Edificio, Quinta).";
					$GLOBALS['ids_elementos_validar'][]='direccion2';
					$bValidateSuccess=false;
				}
					
				if ($_POST['txt_direccion2_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion2_2'])){
					$GLOBALS['aPageErrors'][]= "- El campo Direcci&oacute;n: debe contener de uno(1) a cien (100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_direccion2_2';
					$bValidateSuccess=false;
				}
					/*
				if ($_POST['direccion3']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar una de las siguientes opciones: (Apartamento, Local, Oficina).";
					$GLOBALS['ids_elementos_validar'][]='direccion3';
					$bValidateSuccess=false;
				}
					 */
					
			/*				if ($_POST['txt_direccion3_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion3_2']))
					{
							$GLOBALS['aPageErrors'][]= "- El campo Direccion: debe contener de 1 a 100 caracteres.";
							$GLOBALS['ids_elementos_validar'][]='txt_direccion3_2';
							$bValidateSuccess=false;
					}*/
					
				if ($_POST['direccion4']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar una de las siguientes opciones: (Barrio, Caserio, Conjunto Residencial, Sector, Urbanizaci&oacute;n, Zona).";
					$GLOBALS['ids_elementos_validar'][]='direccion4';
					$bValidateSuccess=false;
				}
					
				if ($_POST['txt_direccion4_2']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_direccion4_2']))				{
					$GLOBALS['aPageErrors'][]= "- El campo Direcci&oacute;n: debe contener de uno(1) a cien (100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_direccion4_2';
					$bValidateSuccess=false;
				}
					
				/*				if ($_POST['cbo_ciudad']==""){
							$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Ciudad.";
							$GLOBALS['ids_elementos_validar'][]='cbo_ciudad';
							$bValidateSuccess=false;
					}*/
						
				if ($_POST["txt_punto_referencia"]=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_punto_referencia'])){
					$GLOBALS['aPageErrors'][]= "- El campo Punto de Referencia: debe contener de uno(1) a cien(100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_punto_referencia';
					$bValidateSuccess=false;
				}
						
				if ($_POST['txt_nombre_emerg_fam']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_nombre_emerg_fam'])){
					$GLOBALS['aPageErrors'][]= "- El campo Nombre del Familiar en Caso de Emergencia: debe contener de uno(1) a cien(100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_nombre_emerg_fam';
					$bValidateSuccess=false;
				}
						
				if ($_POST['txt_apellido_emerg_fam']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_apellido_emerg_fam'])){
					$GLOBALS['aPageErrors'][]= "- El campo Apellido del Familiar en Caso de Emergencia: debe contener de uno(1) a cien(100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_apellido_emerg_fam';
					$bValidateSuccess=false;
				}
						
				if ($_POST['txt_telefono_emerg_fam']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_telefono_emerg_fam'])){
					$GLOBALS['aPageErrors'][]= "- El campo N&deg; de Tel&eacute;fono del Familiar en Caso de Emergencia:  debe contener s&oacute;lo n&uacute;meros y acepta de once(11) a quince(15) d&iacute;gitos.";
					$GLOBALS['ids_elementos_validar'][]='txt_telefono_emerg_fam';
					$bValidateSuccess=false;
				}
						
				if ($_POST['cbo_parentesco_emerg_fam']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Parentesco.";
					$GLOBALS['ids_elementos_validar'][]='cbo_parentesco_emerg_fam';
					$bValidateSuccess=false;
				}
						
				if ($_POST['txt_nombre_emerg_cont']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_nombre_emerg_cont'])){
					$GLOBALS['aPageErrors'][]= "- El campo Nombre del Contacto en Caso de Emergencia: debe contener uno(1) a cien(100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_nombre_emerg_cont';
					$bValidateSuccess=false;
				}
						
				if ($_POST['txt_apellido_emerg_cont']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_apellido_emerg_cont'])){
					$GLOBALS['aPageErrors'][]= "- El campo Apellido del Contacto en Caso de Emergencia: debe contener uno(1) a cien(100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_apellido_emerg_cont';
					$bValidateSuccess=false;
				}
						
				if ($_POST['txt_telefono_emerg_cont']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_telefono_emerg_cont'])){
					$GLOBALS['aPageErrors'][]= "- El campo N&deg; de Tel&eacute;fono del Contacto en Caso de Emergencia:  debe contener s&oacute;lo n&uacute;meros y acepta de once(11) a quince(15) d&iacute;gitos.";
					$GLOBALS['ids_elementos_validar'][]='txt_telefono_emerg_cont';
					$bValidateSuccess=false;
				}
			
				if ($_POST['cbo_parentesco_emerg_cont']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Parentesco.";
					$GLOBALS['ids_elementos_validar'][]='cbo_parentesco_emerg_cont';
					$bValidateSuccess=false;
				}	
						
				if ($_POST['cbo_discapacidad']==""){
					$GLOBALS['aPageErrors'][]= "- Debe indicar si tiene alguna Discapacidad.";
					$GLOBALS['ids_elementos_validar'][]='cbo_discapacidad';
					$bValidateSuccess=false;
				}
												
				if ($_POST['cbo_lateralidad']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar la Lateralidad.";
					$GLOBALS['ids_elementos_validar'][]='cbo_lateralidad';
					$bValidateSuccess=false;
				}
					
				if ($_POST['cbo_grupo_sanguineo']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar el Tipo de Sangre que tiene.";
					$GLOBALS['ids_elementos_validar'][]='cbo_grupo_sanguineo';
					$bValidateSuccess=false;
				}	
						
				if ($_POST['cbo_inscripcion_militar']==""){
					$GLOBALS['aPageErrors'][]= "- Debe seleccionar un valor de la lista.";
					$GLOBALS['ids_elementos_validar'][]='cbo_inscripcion_militar';
					$bValidateSuccess=false;
				}

				if ($_POST['cbo_cant_hijos']==""){
					$GLOBALS['aPageErrors'][]= "- ¿Cuántos Hijos tiene?";
					$GLOBALS['ids_elementos_validar'][]='cbo_cant_hijos';
					$bValidateSuccess=false;
				}

				if ($_POST['txt_ubicacion_fisica_actual']=="" and !preg_match("/^[a-zA-ZñÑáéíóúàèìòù.,\d_\s]{1,200}/i",$_POST['txt_ubicacion_fisica_actual'])){
					$GLOBALS['aPageErrors'][]= "- El campo Ubicación Física: debe contener de uno (1) a cien (100) caracteres.";
					$GLOBALS['ids_elementos_validar'][]='txt_ubicacion_fisica_actual';
					$bValidateSuccess=false;
				}
				
				if ($_POST['txt_telefono_oficina']=="" or !preg_match("/^[[:digit:]]{11,15}+$/",trim($_POST['txt_telefono_oficina']))){
					$GLOBALS['aPageErrors'][]= "- El campo Telef\u00F3no Personal debe contener de once (11) a quince (15) d\u00EDgitos.";
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
	}
	else
	{
		LoadData($conn,false);
	}
} //AQUI TERMINA LA FUNCION DO ACTION

function LoadData($conn,$bPostBack) {  //en esta funcion se colocan todos los campos que voy a trabajar en el formulario
	if (count($GLOBALS['aDefaultForm']) == 0){
		//Las dos variables hacen referencia al mismo contenido $a=&$b:
		//La variable de la derecha asume el valor de la variable de la izquierda
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			$aDefaultForm['txt_visible'] =2;
		if (!$bPostBack){                                      //funcion propia del load data
			if(isset($_SESSION['id_usuario'])){               // este select es cuando necesito los datos por primera vez
				//echo  'ENTRANDO 1';
				?>
				<script>
					// Una flor del Ramillete de la Piratería Universal
					const id_trabajador = "<?= $_SESSION['id_usuario'] ?>";
				</script>
				<?
				$SQL="SELECT personales.cedula as cedula,
personales.nacionalidad as nacionalidad, 
personales.ncont_estudios, 
personales.id_opc_educativas, 
personales.nparticipar_facilitador, 
personales.primer_apellido as apellido1, 
personales.segundo_apellido as apellido2, 
personales.primer_nombre as nombre1, 
personales.segundo_nombre as nombre2, 
personales.id_ciudad as ciudad_nacimiento,
personales.fecha_nacimiento as fecha_nac,
personales.sexo as sexo,	
personales.estado_civil as estado_civil,
personales.ntelefono_personal as telefono_personal,
personales.ntelefono_hab as telefono_hab,		
personales.semail as correoelectronico,	
personales.srif as rif,	
personales.nentidad_entidad as entidad,
personales.nmunicipio_municipio as municipio,										
personales.nparroquia_parroquia as parroquia,	
personales.nentidad_trab as entidad_trab,
personales.ndireccion1 as direccion1,
personales.sdireccion1_2 as direccion1_2,
personales.ndireccion2 as direccion2,
personales.sdireccion2_2 as direccion2_2,
personales.ndireccion3 as direccion3,
personales.sdireccion3_2 as direccion3_2,				
personales.ndireccion4 as direccion4,				
personales.sdireccion4_2 as direccion4_2,			
personales.spunto_referencia as punto_referencia, 
personales.snombre_emerg_familiar as nombre_emerg_fam,
personales.sapellido_emerg_familiar as apellido_emerg_fam,	
personales.ntelefono_emerg_familiar as telefono_emerg_fam,
personales.sparentesco_emerg_familiar as parentesco_emerg_fam,
personales.snombre_emerg_contacto as nombre_emerg_cont,
personales.sapellido_emerg_contacto as apellido_emerg_cont,
personales.ntelefono_emerg_contacto as telefono_emerg_cont,
personales.sparentesco_emerg_contacto as parentesco_emerg_cont,	
personales.sdiscapacidad as discapacidad,	
personales.id_tipo_discapacidad as tipo_discapacidad,
personales.id_grado_discapacidad as grado_discapacidad,
personales.scodigo_conapdis	as conapdis,	
personales.slateralidad as lateralidad,
personales.id_grupo_sanguineo as grupo_sanguineo,
personales.sinscripcion_militar as inscripcion_militar,	
personales.ncodigo_inscripcion_militar as cod_inscripcion_militar,
personales.ncant_hijos as cant_hijos,
personales.sconyuge_trabajo as conyuge_trabajo,	
personales.stalla_camisa as talla_camisa,
personales.stalla_pantalon as talla_pantalon,
personales.ntalla_zapato as talla_zapato,
personales.stalla_chaqueta as talla_chaqueta,
personales.subicacion_fisica as ubicacion_fisica_actual,
personales.ntelefono_oficina as telefono_oficina,
personales.scargo_actual_ejerce as cargo_actual_ejerce,
personales.fecha_ingreso as fecha_ingreso, 
personales.fecha_ingreso_adm as fecha_ingreso_adm,					
personales.sobservacion as observacion, 									
public.ciudad.sdescripcion as ciudad_sdescripcion,
public.municipio.sdescripcion as municipio_descripcion,
public.parroquia.sdescripcion as parroquia_descripcion,
public.grupo_sanguineo.sdescripcion as gupo_sanguineo_descripcion,
public.tipo_discapacidad.sdescripcion as tipo_discapacidad_sdescripcion,
public.grado_discapacidad.sdescripcion as grado_discapacidad_sdescripcion,
recibo_pago.tipo_trabajador_ncodigo, 
recibo_pago.ncodigo_nomina as codigo_nom, 
public.tipo_trabajador.ncodigo as codigo_tipos_trabajadores,
public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador, 
public.cargos.sdescripcion as cargo, 
public.ubicacion_administrativa.sdescripcion as ubicacion_adm					
FROM public.personales
LEFT JOIN public.entidad ON entidad.nentidad=personales.nentidad_entidad AND entidad.nentidad=personales.nentidad_trab   
LEFT JOIN public.municipio ON municipio.nmunicipio=personales.nmunicipio_municipio
LEFT JOIN public.parroquia ON parroquia.nparroquia=personales.nparroquia_parroquia
LEFT JOIN public.ciudad ON ciudad.id=personales.id_ciudad
LEFT JOIN public.grupo_sanguineo ON grupo_sanguineo.id=personales.id_grupo_sanguineo
LEFT JOIN public.tipo_discapacidad ON tipo_discapacidad.id=personales.id_tipo_discapacidad
LEFT JOIN public.grado_discapacidad ON grado_discapacidad.id=personales.id_grado_discapacidad
LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula
LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo 
					where personales.cedula ='".$_SESSION['id_usuario']."' --and recibo_pago.nestatus='1'
					order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1" ;	
				//echo($SQL);
				//die();
				$rs=$conn->Execute($SQL);
				if($rs->RecordCount()>0) 
				{
					//Esta variable es para saber a donde si ya el usuario
					//hizo el update inicial y según esto, redireccion
					$aDefaultForm['swValorInicialEntidad']=$rs->fields['entidad'];

      				    $aDefaultForm['cbo_continuar_est']			=$rs->fields['ncont_estudios'];
      				    $aDefaultForm['cbo_opciones_est']			=$rs->fields['id_opc_educativas'];
      				    $aDefaultForm['cbo_facilitador']		=$rs->fields['nparticipar_facilitador'];
      				    $aDefaultForm['txt_nacionalidad']			=$rs->fields['nacionalidad'];
					$aDefaultForm['txt_apellido1']		=$rs->fields['apellido1'];
					$aDefaultForm['txt_apellido2']					=$rs->fields['apellido2'];
					$aDefaultForm['txt_nombre1']					=$rs->fields['nombre1'];
					$aDefaultForm['txt_nombre2']					=$rs->fields['nombre2'];
					$aDefaultForm['txt_ciudad_sdescripcion']		=$rs->fields['ciudad_sdescripcion'];	
					$aDefaultForm['txt_fecha_nac']					=$rs->fields['fecha_nac'];
					$aDefaultForm['txt_sexo']						=$rs->fields['sexo'];
					$aDefaultForm['cbo_estado_civil']				=$rs->fields['estado_civil'];
						$aDefaultForm['txt_telefono_personal']			=$rs->fields['telefono_personal'];
						$aDefaultForm['txt_telefono_hab']				=$rs->fields['telefono_hab'];
						$aDefaultForm['txt_correoelectronico']			=$rs->fields['correoelectronico'];
						$aDefaultForm['txt_rif']						=$rs->fields['rif'];
						$aDefaultForm['cbo_entidad']					=$rs->fields['entidad'];
						$aDefaultForm['cbo_municipio']					=$rs->fields['municipio'];
						$aDefaultForm['cbo_parroquia']					=$rs->fields['parroquia'];
						$aDefaultForm['cbo_entidad_trab']					=$rs->fields['entidad_trab'];
						$aDefaultForm['direccion1']						=$rs->fields['direccion1'];
						$aDefaultForm['txt_direccion1_2']				=$rs->fields['direccion1_2'];
						$aDefaultForm['direccion2']						=$rs->fields['direccion2'];
						$aDefaultForm['txt_direccion2_2']				=$rs->fields['direccion2_2'];
						$aDefaultForm['direccion3']						=$rs->fields['direccion3'];
						$aDefaultForm['txt_direccion3_2']				=$rs->fields['direccion3_2'];
						$aDefaultForm['direccion4']						=$rs->fields['direccion4'];
						$aDefaultForm['txt_direccion4_2']				=$rs->fields['direccion4_2'];
						$aDefaultForm['txt_punto_referencia']			=$rs->fields['punto_referencia'];	
						$aDefaultForm['txt_nombre_emerg_fam']			=$rs->fields['nombre_emerg_fam'];                    
						$aDefaultForm['txt_apellido_emerg_fam']			=$rs->fields['apellido_emerg_fam'];
						$aDefaultForm['txt_telefono_emerg_fam']			=$rs->fields['telefono_emerg_fam'];
						$aDefaultForm['cbo_parentesco_emerg_fam']		=$rs->fields['parentesco_emerg_fam'];
						$aDefaultForm['txt_nombre_emerg_cont']			=$rs->fields['nombre_emerg_cont'];
						$aDefaultForm['txt_apellido_emerg_cont']		=$rs->fields['apellido_emerg_cont'];
						$aDefaultForm['txt_telefono_emerg_cont']		=$rs->fields['telefono_emerg_cont'];
						$aDefaultForm['cbo_parentesco_emerg_cont']		=$rs->fields['parentesco_emerg_cont'];	
						$aDefaultForm['cbo_discapacidad']				=$rs->fields['discapacidad'];
						$aDefaultForm['cbo_tipo_discapacidad']			=$rs->fields['tipo_discapacidad'];
						$aDefaultForm['cbo_grado_discapacidad']			=$rs->fields['grado_discapacidad'];
						$aDefaultForm['txt_conapdis']			    	=$rs->fields['conapdis'];    
						$aDefaultForm['cbo_lateralidad']				=$rs->fields['lateralidad'];
						$aDefaultForm['cbo_grupo_sanguineo']			=$rs->fields['grupo_sanguineo'];
						$aDefaultForm['cbo_inscripcion_militar']		=$rs->fields['inscripcion_militar'];
						$aDefaultForm['txt_cod_inscripcion_militar']	=$rs->fields['cod_inscripcion_militar'];
						$aDefaultForm['cbo_cant_hijos']					=$rs->fields['cant_hijos'];
						$aDefaultForm['txt_conyuge_trabajo']			=$rs->fields['conyuge_trabajo'];
						$aDefaultForm['cbo_talla_camisa']		    	=$rs->fields['talla_camisa'];
						$aDefaultForm['cbo_talla_pantalon']		    	=$rs->fields['talla_pantalon'];
						$aDefaultForm['cbo_talla_zapato']		    	=$rs->fields['talla_zapato'];
						$aDefaultForm['cbo_talla_chaqueta']		    	=$rs->fields['talla_chaqueta'];
						$aDefaultForm['txt_ubicacion_adm']				= $rs->fields['ubicacion_adm'];				
						$aDefaultForm['txt_ubicacion_fisica_actual']	=$rs->fields['ubicacion_fisica_actual'];
						$aDefaultForm['txt_telefono_oficina']			=$rs->fields['telefono_oficina'];	
						$aDefaultForm['txt_cargo']						= $rs->fields['cargo'];				
						$aDefaultForm['txt_cargo_actual_ejerce']	    =$rs->fields['cargo_actual_ejerce'];
						$aDefaultForm['txt_tipo_trabajador']			= $rs->fields['tipo_trabajador'];
						$aDefaultForm['txt_codigo_nom']					= $rs->fields['codigo_nom'];						
						$aDefaultForm['txt_fecha_ingreso']				=$rs->fields['fecha_ingreso'];
						$aDefaultForm['txt_fecha_ingreso_adm']			=$rs->fields['fecha_ingreso_adm'];	
						$aDefaultForm['txt_observacion']				= $rs->fields['observacion'];					
						
						//$aDefaultForm['txt_ubicacion_fisica']			=$rs->fields['ubicacion_fisica'];	

						
						$aDefaultForm['txt_codigo_tipos_trabajadores']  = $rs->fields['codigo_tipos_trabajadores'];
					
						$aDefaultForm['txt_visible'] = 1;  
						if($aDefaultForm['cbo_municipio']!="")
						{
						$SQL="SELECT sdescripcion 
						FROM public.municipio WHERE nmunicipio='".$aDefaultForm['cbo_municipio']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_municipio_descripcion']=$rs->fields['sdescripcion'];
						//var_dump($aDefaultForm);
						//die();
                    }
					
					if($aDefaultForm['cbo_parroquia']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.parroquia WHERE nparroquia='".$aDefaultForm['cbo_parroquia']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_parroquia_descripcion']=$rs->fields['sdescripcion'];
                    }
					
				   if($aDefaultForm['cbo_tipo_discapacidad']!=""){
					   $SQL ="SELECT sdescripcion ";
					   $SQL.="FROM public.tipo_discapacidad ";
					   $SQL.="WHERE id='".$aDefaultForm['cbo_tipo_discapacidad']."'";         
					   $rs=$conn->Execute($SQL);
					   $aDefaultForm['cbo_tipo_discapacidad_descripcion']=$rs->fields['sdescripcion'];
                    }
					
					if($aDefaultForm['cbo_grado_discapacidad']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.grado_discapacidad WHERE id='".$aDefaultForm['cbo_grado_discapacidad']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_grado_discapacidad_descripcion']=$rs->fields['sdescripcion'];
                    }
					
					
					if($aDefaultForm['cbo_grupo_sanguineo']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.grupo_sanguineo WHERE id='".$aDefaultForm['cbo_grupo_sanguineo']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_grupo_sanguineo_descripcion']=$rs->fields['sdescripcion'];
                    }
					
					if($aDefaultForm['cbo_nivel_academico']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.nivel_academico WHERE id='".$aDefaultForm['cbo_nivel_academico']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_nivel_academico_descripcion']=$rs->fields['sdescripcion'];
                    }
				}
			}			
		} else {
			$SQL="SELECT personales.cedula as cedula,
personales.nacionalidad as nacionalidad, 
personales.primer_apellido as apellido1, 
personales.segundo_apellido as apellido2, 
personales.primer_nombre as nombre1, 
personales.segundo_nombre as nombre2, 
personales.id_ciudad as ciudad_nacimiento,
personales.fecha_nacimiento as fecha_nac,
personales.sexo as sexo,	
personales.estado_civil as estado_civil,
personales.ntelefono_personal as telefono_personal,
personales.ntelefono_hab as telefono_hab,		
personales.semail as correoelectronico,	
personales.srif as rif,	
personales.nentidad_entidad as entidad,
personales.nmunicipio_municipio as municipio,										
personales.nparroquia_parroquia as parroquia,	
personales.nentidad_trab as entidad_trab,
personales.ndireccion1 as direccion1,
personales.sdireccion1_2 as direccion1_2,
personales.ndireccion2 as direccion2,
personales.sdireccion2_2 as direccion2_2,
personales.ndireccion3 as direccion3,
personales.sdireccion3_2 as direccion3_2,				
personales.ndireccion4 as direccion4,				
personales.sdireccion4_2 as direccion4_2,			
personales.spunto_referencia as punto_referencia, 
personales.snombre_emerg_familiar as nombre_emerg_fam,
personales.sapellido_emerg_familiar as apellido_emerg_fam,	
personales.ntelefono_emerg_familiar as telefono_emerg_fam,
personales.sparentesco_emerg_familiar as parentesco_emerg_fam,
personales.snombre_emerg_contacto as nombre_emerg_cont,
personales.sapellido_emerg_contacto as apellido_emerg_cont,
personales.ntelefono_emerg_contacto as telefono_emerg_cont,
personales.sparentesco_emerg_contacto as parentesco_emerg_cont,	
personales.sdiscapacidad as discapacidad,	
personales.id_tipo_discapacidad as tipo_discapacidad,
personales.id_grado_discapacidad as grado_discapacidad,
personales.scodigo_conapdis	as conapdis,	
personales.slateralidad as lateralidad,
personales.id_grupo_sanguineo as grupo_sanguineo,
personales.sinscripcion_militar as inscripcion_militar,	
personales.ncodigo_inscripcion_militar as cod_inscripcion_militar,
personales.ncant_hijos as cant_hijos,
personales.sconyuge_trabajo as conyuge_trabajo,	
personales.stalla_camisa as talla_camisa,
personales.stalla_pantalon as talla_pantalon,
personales.ntalla_zapato as talla_zapato,
personales.stalla_chaqueta as talla_chaqueta,
personales.subicacion_fisica as ubicacion_fisica_actual,
personales.ntelefono_oficina as telefono_oficina,
personales.scargo_actual_ejerce as cargo_actual_ejerce,
personales.fecha_ingreso as fecha_ingreso, 
personales.fecha_ingreso_adm as fecha_ingreso_adm,					
personales.sobservacion as observacion, 									
public.ciudad.sdescripcion as ciudad_sdescripcion,
--public.entidad.scapital as ciudad_descripcion,
public.municipio.sdescripcion as municipio_descripcion,
public.parroquia.sdescripcion as parroquia_descripcion,
public.grupo_sanguineo.sdescripcion as gupo_sanguineo_descripcion,
public.tipo_discapacidad.sdescripcion as tipo_discapacidad_sdescripcion,
public.grado_discapacidad.sdescripcion as grado_discapacidad_sdescripcion,
recibo_pago.tipo_trabajador_ncodigo, 
public.tipo_trabajador.ncodigo as codigo_tipos_trabajadores,
public.tipo_trabajador.sdescripcion_anterior_al10102013 as tipo_trabajador, 
recibo_pago.ncodigo_nomina as codigo_nom, 
public.cargos.sdescripcion as cargo, 
public.ubicacion_administrativa.sdescripcion as ubicacion_adm,
public.personales.ncont_estudios,
public.personales.id_opc_educativas,
public.personales.nparticipar_facilitador
--FROM recibos_pagos_constancias.recibo_pago
FROM public.personales
--LEFT JOIN public.entidad ON entidad.nentidad=personales.nentidad_entidad
LEFT JOIN public.entidad ON entidad.nentidad=personales.nentidad_entidad AND entidad.nentidad=personales.nentidad_trab   
LEFT JOIN public.municipio ON municipio.nmunicipio=personales.nmunicipio_municipio
LEFT JOIN public.parroquia ON parroquia.nparroquia=personales.nparroquia_parroquia
LEFT JOIN public.ciudad ON ciudad.id=personales.id_ciudad
LEFT JOIN public.grupo_sanguineo ON grupo_sanguineo.id=personales.id_grupo_sanguineo
LEFT JOIN public.tipo_discapacidad ON tipo_discapacidad.id=personales.id_tipo_discapacidad
LEFT JOIN public.grado_discapacidad ON grado_discapacidad.id=personales.id_grado_discapacidad
--LEFT JOIN public.personales on personales.cedula = recibo_pago.personales_cedula 
LEFT JOIN recibos_pagos_constancias.recibo_pago on recibo_pago.personales_cedula=personales.cedula
LEFT JOIN public.cargos on recibo_pago.cargos_id = cargos.id 
LEFT JOIN public.tipo_trabajador on recibo_pago.tipo_trabajador_ncodigo = tipo_trabajador.ncodigo 
LEFT JOIN public.ubicacion_administrativa on recibo_pago.ubicacion_administrativa_scodigo = ubicacion_administrativa.scodigo 
LEFT JOIN public.ubicacion_fisica on recibo_pago.ubicacion_fisica_scodigo = ubicacion_fisica.scodigo 
					where personales.cedula ='".$_SESSION['id_usuario']."' --and recibo_pago.nestatus='1'
					order by recibos_pagos_constancias.recibo_pago.dfecha_creacion DESC LIMIT 1" ;	
				//echo($SQL);
				//die();
					
				$rs=$conn->Execute($SQL);
				if($rs->RecordCount()>0){
					$aDefaultForm['swValorInicialEntidad']=$rs->fields['entidad'];
      				    $aDefaultForm['cbo_continuar_est']			=$rs->fields['ncont_estudios'];
      				    $aDefaultForm['cbo_opciones_est']			=$rs->fields['id_opc_estudios'];
      				    $aDefaultForm['cbo_facilitador']		=$rs->fields['nparticipar_facilitador'];
			    		$aDefaultForm['txt_nacionalidad']				    =$rs->fields['nacionalidad'];
						$aDefaultForm['txt_apellido1']						=$rs->fields['apellido1'];
						$aDefaultForm['txt_apellido2']						=$rs->fields['apellido2'];
						$aDefaultForm['txt_nombre1']						=$rs->fields['nombre1'];
						$aDefaultForm['txt_nombre2']						=$rs->fields['nombre2'];
						$aDefaultForm['txt_ciudad_sdescripcion']			=$rs->fields['ciudad_sdescripcion'];
						$aDefaultForm['txt_fecha_nac']						=$rs->fields['fecha_nac'];
						$aDefaultForm['txt_sexo']							=$rs->fields['sexo'];						
						$aDefaultForm['txt_ubicacion_adm']					= $rs->fields['ubicacion_adm'];		
						$aDefaultForm['txt_cargo']							= $rs->fields['cargo'];
						$aDefaultForm['txt_tipo_trabajador']				= $rs->fields['tipo_trabajador'];
						$aDefaultForm['txt_codigo_nom']						= $rs->fields['codigo_nom'];
						$aDefaultForm['txt_fecha_ingreso']					=$rs->fields['fecha_ingreso'];
						$aDefaultForm['txt_fecha_ingreso_adm']				=$rs->fields['fecha_ingreso_adm'];					
//$aDefaultForm['txt_codigo_tipos_trabajadores']  	= $rs->fields['codigo_tipos_trabajadores'];													
//$aDefaultForm['txt_ubicacion_fisica']				= $rs->fields['ubicacion_fisica'];												
				}
				
		
				
						$aDefaultForm['cbo_estado_civil']					=$_POST["cbo_estado_civil"];
						$aDefaultForm['txt_telefono_personal']				=$_POST["txt_telefono_personal"];						
						$aDefaultForm['txt_telefono_hab']					=$_POST["txt_telefono_hab"];
						$aDefaultForm['txt_correoelectronico']				=$_POST["txt_correoelectronico"];
						$aDefaultForm['txt_rif']			            	=$_POST["txt_rif"];
						
						$aDefaultForm['cbo_entidad']						=$_POST["cbo_entidad"];
						$aDefaultForm['cbo_municipio']						=$_POST["cbo_municipio"];
						$aDefaultForm['cbo_parroquia']						=$_POST["cbo_parroquia"];
						$aDefaultForm['cbo_entidad_trab']					=$rs->fields['entidad_trab'];
						$aDefaultForm['direccion1']							=$_POST["direccion1"];
						$aDefaultForm['txt_direccion1_2']					=$_POST["txt_direccion1_2"];
						$aDefaultForm['direccion2']							=$_POST["direccion2"];
						$aDefaultForm['txt_direccion2_2']					=$_POST["txt_direccion2_2"];
						$aDefaultForm['direccion3']							=$_POST["direccion3"];
						$aDefaultForm['txt_direccion3_2']					=$_POST["txt_direccion3_2"];
						$aDefaultForm['direccion4']							=$_POST["direccion4"];
						$aDefaultForm['txt_direccion4_2']					=$_POST["txt_direccion4_2"];
						$aDefaultForm['txt_punto_referencia']				=$_POST["txt_punto_referencia"];
						
						$aDefaultForm['txt_nombre_emerg_fam']				=$_POST["txt_nombre_emerg_fam"];
						$aDefaultForm['txt_apellido_emerg_fam']				=$_POST["txt_apellido_emerg_fam"];
						$aDefaultForm['txt_telefono_emerg_fam']			    =$_POST["txt_telefono_emerg_fam"];	
						$aDefaultForm['cbo_parentesco_emerg_fam']		    =$_POST["cbo_parentesco_emerg_fam"];
						$aDefaultForm['txt_nombre_emerg_cont']				=$_POST["txt_nombre_emerg_cont"];
						$aDefaultForm['txt_apellido_emerg_cont']			=$_POST["txt_apellido_emerg_cont"];
						$aDefaultForm['txt_telefono_emerg_cont']			=$_POST["txt_telefono_emerg_cont"];	
						$aDefaultForm['cbo_parentesco_emerg_cont']		    =$_POST["cbo_parentesco_emerg_cont"];
						
						$aDefaultForm['cbo_discapacidad']					=$_POST["cbo_discapacidad"];
						$aDefaultForm['cbo_tipo_discapacidad']				=$_POST["cbo_tipo_discapacidad"];
						$aDefaultForm['cbo_grado_discapacidad']				=$_POST["cbo_grado_discapacidad"];						
						$aDefaultForm['txt_conapdis']			    	    =$_POST["txt_conapdis"];  
						
						$aDefaultForm['cbo_lateralidad']					=$_POST["cbo_lateralidad"];
						$aDefaultForm['cbo_grupo_sanguineo']				=$_POST["cbo_grupo_sanguineo"];						  
						$aDefaultForm['cbo_inscripcion_militar']			=$_POST["cbo_inscripcion_militar"];					
						$aDefaultForm['txt_cod_inscripcion_militar']=$_POST["txt_cod_inscripcion_militar"];
						$aDefaultForm['cbo_cant_hijos']	   					=$_POST["cbo_cant_hijos"];	
						$aDefaultForm['txt_conyuge_trabajo']				=$_POST["txt_conyuge_trabajo"];		
						
						$aDefaultForm['cbo_talla_camisa']			     	=$_POST["cbo_talla_camisa"];	
						$aDefaultForm['cbo_talla_pantalon']			     	=$_POST["cbo_talla_pantalon"];
						$aDefaultForm['cbo_talla_zapato']			     	=$_POST["cbo_talla_zapato"];
						$aDefaultForm['cbo_talla_chaqueta']			     	=$_POST["cbo_talla_chaqueta"];			
						
						$aDefaultForm['txt_ubicacion_fisica_actual']       =$_POST["txt_ubicacion_fisica_actual"];	
						$aDefaultForm['txt_telefono_oficina']		       =$_POST['txt_telefono_oficina'];	
						$aDefaultForm['txt_cargo_actual_ejerce']            =$_POST["txt_cargo_actual_ejerce"];	
						$aDefaultForm['txt_observacion']		        	=$_POST['txt_observacion'];											
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
							
			       if($aDefaultForm['cbo_tipo_discapacidad']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.tipo_discapacidad WHERE id='".$aDefaultForm['cbo_tipo_discapacidad']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_tipo_discapacidad_descripcion']=$rs->fields['sdescripcion'];
                    }
					
					if($aDefaultForm['cbo_grado_discapacidad']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.grado_discapacidad WHERE id='".$aDefaultForm['cbo_grado_discapacidad']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_grado_discapacidad_descripcion']=$rs->fields['sdescripcion'];
                    }
					
					if($aDefaultForm['cbo_grupo_sanguineo']!=""){
						$SQL="SELECT sdescripcion 
						FROM public.grupo_sanguineo WHERE id='".$aDefaultForm['cbo_grupo_sanguineo']."'";                                 
						$rs=$conn->Execute($SQL);
						$aDefaultForm['cbo_grupo_sanguineo_descripcion']=$rs->fields['sdescripcion'];
                    }
				}
	}
}
function ProcessForm($conn){
     if($_POST["txt_cod_inscripcion_militar"]==='')
     {
	  $_POST["txt_cod_inscripcion_militar"]='0';
     }
     //aqui se hacen todos los insert update delete del formulario
	if(!$_POST["direccion3"] or $_POST["txt_direccion3_2"] == ''){
		$_POST["direccion3"] = '0';
	}
	if(!isset($_POST['cbo_opciones_est']))
	{
	  $_POST['cbo_opciones_est']='0';
	}
	elseif($_POST['cbo_opciones_est']==='')
	{
	  $_POST['cbo_opciones_est']='0';
	}
	$cbo_tipo_discapacidad=isset($_POST["cbo_tipo_discapacidad"])?$_POST["cbo_tipo_discapacidad"]:"9";
	//echo('cbo_tipo_discapacidad=' . $cbo_tipo_discapacidad . '<br>');
	$cbo_grado_discapacidad=isset($_POST["cbo_grado_discapacidad"])?$_POST["cbo_grado_discapacidad"]:"0";
	//echo('cbo_grado_discapacidad=' . $cbo_grado_discapacidad . '<br>');
	//die();
			$SQL="UPDATE public.personales SET 
						estado_civil							='".$_POST['cbo_estado_civil']."',
						ntelefono_personal			        	='".$_POST["txt_telefono_personal"]."', 
						ntelefono_hab							='".$_POST["txt_telefono_hab"]."',  
						semail									='".$_POST["txt_correoelectronico"]."',						
						srif									='".$_POST['txt_rif']."',
						nentidad_entidad						='".$_POST["cbo_estado"]."',
						nmunicipio_municipio					='".$_POST["cbo_municipio"]."',
						nparroquia_parroquia					='".$_POST["cbo_parroquia"]."',
						ndireccion1								='".$_POST['direccion1']."',
						sdireccion1_2							='".$_POST['txt_direccion1_2']."',
						ndireccion2								='".$_POST['direccion2']."',
						sdireccion2_2							='".trim(strtoupper($_POST['txt_direccion2_2']))."',
						ndireccion3								='".$_POST['direccion3']."',
						sdireccion3_2							='".trim(strtoupper($_POST['txt_direccion3_2']))."',
						ndireccion4								='".$_POST['direccion4']."',
						sdireccion4_2							='".$_POST['txt_direccion4_2']."',
						spunto_referencia						='".$_POST['txt_punto_referencia']."',
						snombre_emerg_familiar				    ='".$_POST['txt_nombre_emerg_fam']."',
						sapellido_emerg_familiar				='".$_POST["txt_apellido_emerg_fam"]."',
						ntelefono_emerg_familiar			    ='".$_POST['txt_telefono_emerg_fam']."',	
						sparentesco_emerg_familiar		        ='".$_POST["cbo_parentesco_emerg_fam"]."',
						snombre_emerg_contacto				    ='".$_POST["txt_nombre_emerg_cont"]."',
						sapellido_emerg_contacto			    ='".$_POST["txt_apellido_emerg_cont"]."',
						ntelefono_emerg_contacto			    ='".$_POST['txt_telefono_emerg_cont']."',	
						sparentesco_emerg_contacto		        ='".$_POST['cbo_parentesco_emerg_cont']."',
						sdiscapacidad							='".$_POST["cbo_discapacidad"]."',
						id_tipo_discapacidad                    ='" . $cbo_tipo_discapacidad . "',
						id_grado_discapacidad                   ='" . $cbo_grado_discapacidad . "',
						scodigo_conapdis						='".$_POST["txt_conapdis"]."',						                   
						slateralidad							='".$_POST["cbo_lateralidad"]."',
						id_grupo_sanguineo                      ='".$_POST["cbo_grupo_sanguineo"]."',
						sinscripcion_militar		        	='".$_POST["cbo_inscripcion_militar"]."',
						ncodigo_inscripcion_militar             ='".$_POST["txt_cod_inscripcion_militar"]."',
						ncant_hijos								='".$_POST["cbo_cant_hijos"]."',
						sconyuge_trabajo						='".$_POST["txt_conyuge_trabajo"]."',
						stalla_camisa                           ='".$_POST["cbo_talla_camisa"]."',	
						stalla_pantalon                         ='".$_POST["cbo_talla_pantalon"]."',
						ntalla_zapato                           ='".$_POST["cbo_talla_zapato"]."',
						stalla_chaqueta                         ='".$_POST["cbo_talla_chaqueta"]."',
						subicacion_fisica						='".$_POST['txt_ubicacion_fisica_actual']."',	
						ntelefono_oficina						='".$_POST["txt_telefono_oficina"]."',
						scargo_actual_ejerce                    ='".$_POST["txt_cargo_actual_ejerce"]."',
						sobservacion							='".$_POST["txt_observacion"]."',		
						usuario_idactualizacion   				='".$_SESSION['id_usuario']."',
						dfecha_actualizacion     				='".date('Y-m-d H:i:s')."',
						nenabled 								='1',
					ncont_estudios='" . $_POST['cbo_continuar_est'] . "',id_opc_educativas='" . $_POST['cbo_opciones_est'] . "',nparticipar_facilitador='" . $_POST['cbo_facilitador'] . "', nentidad_trab='" . $_POST['cbo_entidad'] ."'	
						where personales.cedula ='".$_SESSION['id_usuario']."'";
						$rs= $conn->Execute($SQL);                 
	//echo($SQL);
     if($_POST['entidad_inicial']==="")
     {
	  $swValorInicialEntidad='false';
     }
     else
     {
	  $swValorInicialEntidad='true';
     }
?>
<script>
     alert("SUS DATOS HAN SIDO ACTUALIZADOS CORRECTAMENTE"); 
</script>
<?php
if($swValorInicialEntidad=="true")
{
?>
<script>
	document.location='../vista.php';
</script>
<?php
}
else
{
?>
<script>
	//Esto de abajo se está haciendo así porque no
	//Se refrescan los permisos del usuario hasta
	//que se vuelve a autenticar
	document.location='../../mod_login/login.php';
</script>
<?php
}
}
//funcion que dibuja el cuerpo de la pagina, para que muestre el formulario
function showForm($conn,$aDefaultForm){ // en esta funcion siempre va el formulario
?>

	<div id="Contenido" align="center" style="overflow:scroll">
	<br>
	<table class="tabla" width="95%" height="95%">
    <tbody>
    <tr valign="top">
    <td>

<form name="frm_rec_pago_actualizacion" id="frm_rec_pago_actualizacion" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" >
<script type="text/javascript" src="validar_rec_pago_actualizacion.js"></script>
<div id='nentidad'>
</div>
<input name="action" type="hidden" value="" />
<input name="url" type="hidden" value="" />
<input name="txt_visible" type="hidden" value="<?= $aDefaultForm['txt_visible']; ?>" />
<input type="hidden" id="opcion_estudio_elegida" name="opcion_estudio_elegida" value="<?= $aDefaultForm['cbo_opciones_est'];?>">
<input type="hidden" id="entidad_inicial" name="entidad_inicial" value="<?= $aDefaultForm['swValorInicialEntidad'];?>">
	
<table width="95%" border="0" align="center" class="formulario">
    <tr>
		  <th style="border-radius: 30px; border-color:#999999" colspan="4"  class="sub_titulo"><div align="left">TRABAJADOR(A) --> Actualizar Datos</div></th>
	</tr>
	
	<tr>
	 	<th colspan="4"  class="titulo" align="center"></th>
	</tr>
		
	<tr>	
		<td colspan="4" align="right"><span class="requerido">Campos obligatorios (*)</span>&nbsp;</td>
    </tr>
		
	<tr class="identificacion_seccion">
		 <th style="border-radius: 30px; border-color:#999999; width:85%" colspan="4" class="sub_titulo" id="seccBasicos" align="left">DATOS B&Aacute;SICOS</th>
	</tr>
          <tr>
            <th colspan="4" height="8"></th>
        </tr> 
	<tr>
		<td style="color:#666"  align="letf"><strong>C&eacute;dula de Identidad</strong></td>
		<td align="left"><font color="#666666"><?=number_format( $_SESSION['id_usuario'], 0, '', '.')?></font></td>
		<td style="color:#666"  align="left"><strong>Nacionalidad </strong></td>
		<td align="left"><font color="#666666"><?php if($aDefaultForm['txt_nacionalidad']==1){
		echo 'VENEZOLANO';
		}else{
		echo 'EXTRANJERA';
		}
		?>
		</font></td>
	</tr>
        
    <tr>
		<td colspan="4"> </td> 
	</tr>
    
	<tr>
		<th style="color:#666" width="21%" align="center">Primer Apellido</th>		
		<th style="color:#666" width="24%" align="center">Segundo Apellido</th>
		<th style="color:#666"  width="26%" align="center">Primer Nombre</th>
		<th style="color:#666"  width="29%" align="center">Segundo Nombre</th>  
	</tr>
	
	<tr>
		<td align="left"><font color="#666666"><?= $aDefaultForm['txt_apellido1'];?></font></td>
		<td align="left"><font color="#666666"><?= $aDefaultForm['txt_apellido2'];?></font></td>
		<td align="left"><font color="#666666"><?= $aDefaultForm['txt_nombre1'];?></font></td>
		<td align="left"><font color="#666666"><?= $aDefaultForm['txt_nombre2'];?></font></td>
	</tr>
  	<tr>
		<td colspan="4"> </td> 
	</tr>
		
   <tr>  
		<th style="color:#666"  width="21%" align="center">Lugar de Nacimiento</th>
		<th style="color:#666"  width="24%" align="center">Fecha de Nacimiento</th> 
		<th style="color:#666"  width="26%" align="center">Sexo</th>
		<th style="color:#666"  width="29%" align="center">Estado Civil</th>
	</tr>

	<tr>
		<td align="left"><font color="#666666"><?= $aDefaultForm['txt_ciudad_sdescripcion'];?></font></td>
		
		<td align="left"><font color="#666666"><?php if($aDefaultForm['txt_fecha_nac']!=""){echo strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_nac']));} ?></font></td>
		  
		<td align="left"><font color="#666666"><?php if($aDefaultForm['txt_sexo']==2){echo 'MASCULINO';}else  if ($aDefaultForm['txt_sexo']==1){echo 'FEMENINO';}else{echo ' ';}?></font>		 </td><?php ?>
					
			
			
		<td align="left"><font color="#666666">
		<?php $disab = $aDefaultForm['txt_visible']==2 ? "" : "disabled";?>
	<!--			<select style="width: 80%" id="cbo_estado_civil" name="cbo_estado_civil" <?php //echo $disab; ?> >-->
				<select style="border-radius: 30px; border-color:#999999; width:87%" id="cbo_estado_civil" name="cbo_estado_civil">
					<option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_estado_civil']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="C"<?php if (!(strcmp('C',$aDefaultForm['cbo_estado_civil']))) {echo " selected=\"selected\"";}?>>Casado(a)</option>
					<option value="D"<?php if (!(strcmp('D',$aDefaultForm['cbo_estado_civil']))) {echo " selected=\"selected\"";}?>>Divorciado(a)</option>
					<option value="S"<?php if (!(strcmp('S',$aDefaultForm['cbo_estado_civil']))) {echo " selected=\"selected\"";}?>>Soltero(a)</option>
					<option value="V"<?php if (!(strcmp('V',$aDefaultForm['cbo_estado_civil']))) {echo " selected=\"selected\"";}?>>Viudo(a)</option>
				</select>
				<span>*</span>    	
		  </font>		  </td>
		  <?php ?>
       </tr> 

        <tr>
			<td colspan="4"> </td> 
		</tr>

        <tr> 
            <th style="color:#666"  width="21%" align="center">Tel&eacute;fono Personal</th>
            <th style="color:#666"  width="24%" align="center">Tel&eacute;fono de Habitaci&oacute;n</th>
            <th style="color:#666"  width="26%" align="center">Correo Electr&oacute;nico Personal</th> 
			<th style="color:#666"  width="29%" align="center">N° del Registro de Informaci&oacute;n Fiscal Personal(R.I.F)</th> 			
        </tr>
    
        <tr>
            <td align="center" style="border-radius: 30px;" >
                <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                }
                ?> 
				
				<font color="#666666">
				<i class="fa-solid fa-mobile"></i>
                <input style="border-radius: 30px; border-color:#999999; width:75%" name="txt_telefono_personal" id="txt_telefono_personal" type="text"  value="<?= $aDefaultForm['txt_telefono_personal'];?>" title="Tel&eacute;fono Personal - Ingrese s&oacute;lo n&uacute;meros. Acepta once (11) d&iacute;gitos. Ejemplo: 04260102302" onKeyPress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. 04260102302"/>  
              <span class="requerido"> * </span>            </font>			</td>   
			
            <td align="center"><font color="#666666">
                <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                }
                ?> 
				<i class="fas fa-phone"></i>
                <input style="border-radius: 30px; border-color:#999999; width:75%"" name="txt_telefono_hab" id="txt_telefono_hab" type="text"  value="<?= $aDefaultForm['txt_telefono_hab'];?>" title="Tel&eacute;fono Habitaci&oacute;n - Ingrese s&oacute;lo n&uacute;meros. Acepta  once (11) d&iacute;gitos. Ejemplo: 02121234567" onKeyPress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. 02121234567"/> <span class="requerido"> * </span>
            </font>			</td> 

		<td align="center"><font color="#666666">
			<?php 
			$disab="";
			if($aDefaultForm['txt_visible']==2){ 
				$disab="disabled";
			}
			?>
			<i class="fa-solid fa-envelope"></i>
			<input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_correoelectronico" type="text" id="txt_correoelectronico"  title="Correo Electr&oacute;nico Personal - Ingrese un Correo Electr&oacute;nico V&aacute;lido. Acepta un m&iacute;nimo de diez (10) y un m&aacute;ximo de treinta (30) caracteres. Ejemplo: juancito@gmail.com"  value="<?= $aDefaultForm['txt_correoelectronico'];?>" maxlength="40" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. juancito@gmail.com" /> <span class="requerido"> * </span>
			</font>		</td>
			
		<td>      
         	<input style="border-radius: 30px; border-color:#999999; width:87%" name="txt_rif" type="text" id="txt_rif" title="Registro de Informaci&oacute;n Fiscal Personal(R.I.F) - Ingrese el n&uacute;mero del Registro de Informaci&oacute;n Fiscal Personal(R.I.F)." onKeyUp="mayusculas(this);" placeholder="Ej. V132587970"value="<?= $aDefaultForm['txt_rif'];?>" maxlength="10" />		</td>	
		</tr> 
        
        <tr>
            <th colspan="4" height="20"></th>
        </tr> 

        <tr class="identificacion_seccion" >
            <th style="border-radius: 30px; border-color:#999999" colspan="4" class="sub_titulo" id="seccHabitacion" align="left">DIRECCI&Oacute;N DE HABITACI&Oacute;N</th>
        </tr> 
          <tr>
            <th colspan="4" height="9"></th>
        </tr> 
		<tr>
			<th style="color:#666"  width="21%" align="center">Estado</th> 
			<th style="color:#666" width="24%" align="center">Municipio</th> 
			<th style="color:#666" colspan="2" align="center">Parroquia</th>
		</tr>
    
				<?
?>
		<tr>
			<td align="left"><font color="#666666">
			<i class="fa-solid fa-house"></i>
			<!--select style="width: 80%" id="select" name="select" onchange="estado_combo();"  -->
			<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_estado" name="cbo_estado" onchange="estado_combo();"   >
              <option value="">Seleccione </option>
              <? LoadEstado ($conn) ; print $GLOBALS['sHtml_cb_Estado']; ?>
            </select>
			<span class="requerido"> * </span> </font></td>
		
			<td align="left"><font color="#666666">
			<i class="fa-solid fa-house"></i>
			<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_municipio" name="cbo_municipio" onchange="municipio_combo();" >
              <option value="">Seleccione </option>
              <option <? if($aDefaultForm['cbo_municipio_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_municipio']; ?>">
                <?= $aDefaultForm['cbo_municipio_descripcion'];?>
                </option>
            </select>
			<span class="requerido"> * </span>			
				</font></td>
		
			
			<td align="left" colspan="2"><font color="#666666">
			<i class="fa-solid fa-house"></i>
				<select style="border-radius: 30px; border-color:#999999; width:90%""  id="cbo_parroquia" name="cbo_parroquia">
				<option value="">Seleccione </option>
				<option <? if($aDefaultForm['cbo_parroquia_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_parroquia']; ?>"><?= $aDefaultForm['cbo_parroquia_descripcion'];?></option>
			</select><span class="requerido"> * </span>			
			</font></td> 
		</tr>
		
      <tr>
			<td colspan="4"> </td> 
	  </tr>
   <?php /*?>  <tr>
		 <th width="50%" class="sub_titulo" colspan="4" align="center">Parroquia</th>
		<!-- <th width="50%" class="sub_titulo_3" colspan="2" align="center">Ciudad</th> -->
     </tr>
    
     <tr>
         <td align="left" colspan="4">
            <select style="width: 80%"  id="cbo_parroquia" name="cbo_parroquia">
            <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_parroquia_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_parroquia']; ?>"><?= $aDefaultForm['cbo_parroquia_descripcion'];?></option>
           </select><span class="requerido"> * </span>         </td> 
        
         <!--<td align="center" colspan="2">
            <select style="width: 80%"  id="cbo_ciudad" name="cbo_ciudad">
            <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_ciudad_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_ciudad']; ?>"><?= $aDefaultForm['cbo_ciudad_descripcion'];?></option>
            </select><span class="requerido"> * </span>
         </td>-->
     </tr><?php */?>

        <tr>
            <th style="color:#666"  colspan="2" id="td_direccion1">
				  <input name="direccion1" id="direccion1" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion1'] == 1) ?  'checked="checked"' : '' ?>/> 
				  Avenida
				  <input name="direccion1"  id="direccion1" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion1'] == 2) ?  'checked="checked"' : '' ?>/> 
				  Calle
				  <input name="direccion1"  id="direccion1" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion1'] == 3) ?  'checked="checked"' : '' ?>/> 
				  Carrera
				  <input name="direccion1"  id="direccion1" type="radio" class="texto-normal" value="4" <?= ($aDefaultForm['direccion1'] == 4) ?  'checked="checked"' : '' ?>/> 
				  Carretera
				  <input name="direccion1"  id="direccion1" type="radio" class="texto-normal" value="5" <?= ($aDefaultForm['direccion1'] == 5) ?  'checked="checked"' : '' ?>/> 
				  Esquina
				  <input name="direccion1"  id="direccion1" type="radio" class="texto-normal" value="6" <?= ($aDefaultForm['direccion1'] == 6) ?  'checked="checked"' : '' ?>/> 
				  Vereda
				  <span class="requerido"> * </span>			 </th>
           
          <th style="color:#666" colspan="2" id="td_direccion1">
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
				<span class="requerido"> * </span>			</th>
	   </tr>
      
      <tr>
           <td align="left" colspan="2"><font color="#666666">
		   
                 <?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                    }
                  ?> 
				  <i class="fa-solid fa-house"></i>
				  <input style="border-radius: 30px; border-color:#999999; width:88%" name="txt_direccion1_2" type="text" id="txt_direccion1_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de diez (10) y un m&aacute;ximo de ochenta (80) caracteres." value="<?= $aDefaultForm['txt_direccion1_2'];?>" maxlength="80" onkeyup="mayusculas(this);" <?php echo $disab; ?> autocomplete="off" />
				  <span class="requerido"> * </span>		   
		  </font></td>
      
           <td align="left" colspan="2"><font color="#666666">
                <?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                    }
                ?> 
				<i class="fa-solid fa-house"></i>
              <input style="border-radius: 30px; border-color:#999999; width:90%" name="txt_direccion2_2" type="text" id="txt_direccion2_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de diez (10) y un m&aacute;ximo de ochenta (80) caracteres." value="<?= $aDefaultForm['txt_direccion2_2'];?>" maxlength="80" onkeyup="mayusculas(this);" <?php echo $disab; ?> autocomplete="off" />
          <span class="requerido"> * </span>          
		  </font></td>
	  </tr>
     
       <tr>
			<td colspan="4"> </td> 
	   </tr>
         
	  <tr>
         <th align ="left" colspan="2" style="color:#666"   id="td_direccion3">
            <input name="direccion3" type="radio" class="texto-normal" value="1" <?= ($aDefaultForm['direccion3'] == 1) ?  'checked="checked"' : '' ?>/> 
            Apartamento
            <input name="direccion3" type="radio" class="texto-normal" value="2" <?= ($aDefaultForm['direccion3'] == 2) ?  'checked="checked"' : '' ?>/> 
            Local
            <input name="direccion3" type="radio" class="texto-normal" value="3" <?= ($aDefaultForm['direccion3'] == 3) ?  'checked="checked"' : '' ?>/> 
            Oficina</th>
     
         <th colspan="2" style="color:#666"  id="td_direccion4">
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
            <span class="requerido"> * </span>		</th>
     </tr>
    
	 <tr>
   		<td colspan="2"><font color="#666666"> 
			  <?php 
				  $disab="";
				  if($aDefaultForm['txt_visible']==2){ 
				  $disab="disabled";
				  }
			  ?> 
			  <i class="fa-solid fa-house"></i>
		  <input style="border-radius: 30px; border-color:#999999; width:88%"  name="txt_direccion3_2" type="text" id="txt_direccion3_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de diez (10) y un m&aacute;ximo de ochenta (80) caracteres." value="<?= $aDefaultForm['txt_direccion3_2'];?>" maxlength="80" onkeyup="mayusculas(this);" <?php echo $disab; ?> autocomplete="off" />	   </font></td>
    
        <td colspan="2"><font color="#666666"> 
			   <?php 
					$disab="";
					if($aDefaultForm['txt_visible']==2){ 
					$disab="disabled";
					}
				?> 
				<i class="fa-solid fa-house"></i>
			 <input style="border-radius: 30px; border-color:#999999; width:90%" name="txt_direccion4_2" type="text" id="txt_direccion4_2" title="Detalle de Direcci&oacute;n - Acepta un m&iacute;nimo de diez (10) y un m&aacute;ximo de ochenta (80) caracteres." value="<?= $aDefaultForm['txt_direccion4_2'];?>" maxlength="80" onkeyup="mayusculas(this);" <?php echo $disab; ?> autocomplete="off" />
			  <span class="requerido"> * </span>		  </font></td>
	 </tr>
    
      <tr>
			<td colspan="4"> </td> 
	  </tr>
	  
    <tr>
  	  <th colspan="4" style="color:#666" align="left">Punto de Referencia</th>
    </tr>

    <tr>
        <td colspan="4" align="left"><font color="#666666">
        <?php 
        $disab="";
        if($aDefaultForm['txt_visible']==2){    
        $disab="disabled";
        }
        ?>
		<i class="fa-solid fa-house"></i>
        <input style="border-radius: 30px; border-color:#999999; width:94%" name="txt_punto_referencia" type="text" class="textbox" id="txt_punto_referencia"  title="Punto de Referencia - Ingrese un punto de referencia de su direcci&oacute;n de Habitaci&oacute;n. Acepta un m&iacute;nimo de diez (10) y un m&aacute;ximo de treinta (30) caracteres"  value="<?= $aDefaultForm['txt_punto_referencia'];?>" maxlength="150" onkeyup="mayusculas(this);"
        <?php echo $disab; ?> autocomplete="off"/> 
        <!--<span class="requerido"> * </span>-->        </font></td>
    </tr>

    <tr>    </tr>
    
    <tr>
    	<th colspan="4" height="20"></th>
    </tr> 

    <tr class="identificacion_seccion" >
   		<th style="border-radius: 30px; border-color:#999999" colspan="4" class="sub_titulo" id="seccEmergencia" align="left">EN CASO DE EMERGENCIA</th>
    </tr> 
          <tr>
            <th colspan="4" height="8"></th>
        </tr> 
      <tr>
            <th width="21%" style="color:#666"  align="center">Nombre</th>		
            <th width="24%" style="color:#666"  align="center">Apellido</th>
            <th width="26%" style="color:#666"  align="center">N&deg;. de Tel&eacute;fono</th>
            <th width="29%" style="color:#666"  align="center">Parentesco</th>  
        </tr>
        
		        <tr>      
		   <td><font color="#666666"><i class="fa-solid fa-user"></i>
		     <input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_nombre_emerg_fam" type="text" id="txt_nombre_emerg_fam" placeholder="Nombre(s) del Familiar" title="Nombre(s) del Familiar - Ingrese el o los Nombre(s) del Familiar. Acepta un m&iacute;nimo de once (11) caracteres.  "  value="<?= $aDefaultForm['txt_nombre_emerg_fam'];?>" size="15" maxlength="11"  autocomplete="off" onkeyup="mayusculas(this);"/>
		     <span>*</span>		  </font></td>	
			 	
		     <td><font color="#666666"><i class="fa-solid fa-user"></i> <input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_apellido_emerg_fam" type="text" id="txt_apellido_emerg_fam" placeholder="Apellido(s) del Familiar" title="Apellido(s) del Familiar - Ingrese el o los Apellido(s) del Familiar. Acepta un m&iacute;nimo de once (11) caracteres.  "  value="<?= $aDefaultForm['txt_apellido_emerg_fam'];?>" size="15" maxlength="11"  autocomplete="off" onkeyup="mayusculas(this);" />
		    <span>*</span>		  
			</font></td>
					
		   <td><font color="#666666">
		   <i class="fa-solid fa-mobile"></i>
           <input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_telefono_emerg_fam" type="text" id="txt_telefono_emerg_fam" placeholder="N&deg;. de Tel&eacute;fono  del Familiar" title="N&deg;. de Tel&eacute;fono  del Familiar - Ingrese el n&uacute;mero de Tel&eacute;fono del Familiar. Acepta un m&iacute;nimo de once (11) d&iacute;gitos.  "  value="<?= $aDefaultForm['txt_telefono_emerg_fam'];?>" size="15" maxlength="11"  autocomplete="off" onkeyup="mayusculas(this);" />
		   <span>*</span>        	  
		   </font></td>	
		    <td align="left"><font color="#666666">
					<?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                        $disab="disabled";
                    }
                    ?>  
					<i class="fa-solid fa-people-group"></i>                       
                    <select style="border-radius: 30px; border-color:#999999; width:85%" id="cbo_parentesco_emerg_fam" name="cbo_parentesco_emerg_fam" <?php echo $disab; ?>>
                        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
						<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Abuelo(a)</option>
                        <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>C&oacute;nyuge</option>
						<option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Hermano(a)</option>
                        <option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Hijo(a)</option>
						<option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Madre/Padre</option>
                        <option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Nieto</option>
<?php /*?>              <option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Padre</option><?php */?>
						<option value="7"<?php if (!(strcmp('7',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Primo(a)</option>
						<option value="8"<?php if (!(strcmp('8',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>Sobrino(a)</option>
						<option value="9"<?php if (!(strcmp('9',$aDefaultForm['cbo_parentesco_emerg_fam']))) {echo " selected=\"selected\"";}?>>T&iacute;o(a)</option>
                </select>
					 <span>*</span>    
            </font></td>	
        </tr>


 <tr>
		   <td><font color="#666666">
		   <i class="fa-solid fa-user"></i> 
           <input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_nombre_emerg_cont" type="text" id="txt_nombre_emerg_cont" placeholder="Nombre(s) del Contacto" title="Nombre(s) del Contacto - Ingrese el o los Nombre(s) del Contacto. Acepta un m&iacute;nimo de once (11) caracteres.  "  value="<?= $aDefaultForm['txt_nombre_emerg_cont'];?>" size="15" maxlength="11"  autocomplete="off" onkeyup="mayusculas(this);"/>
		   <span>*</span>		   
		   </font></td>		
		  <td><font color="#666666">
		  <i class="fa-solid fa-user"></i> 
           <input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_apellido_emerg_cont" type="text" id="txt_apellido_emerg_cont" placeholder="Apellido(s) del Contacto" title="Apellido(s) del Contacto - Ingrese el o los Apellido(s) del Contacto. Acepta un m&iacute;nimo de once (11) caracteres.  "  value="<?= $aDefaultForm['txt_apellido_emerg_cont'];?>" size="15" maxlength="11"  autocomplete="off" onkeyup="mayusculas(this);"/>
		   <span>*</span>		  
		   </font></td>
		   <td><font color="#666666">
		   <i class="fa-solid fa-mobile"></i>
           <input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_telefono_emerg_cont" type="text" id="txt_telefono_emerg_cont" placeholder="N&deg;. de Tel&eacute;fono  del Contacto" title="N&deg;. de Tel&eacute;fono  del Contacto - Ingrese el n&uacute;mero de Tel&eacute;fono del Contacto. Acepta un m&iacute;nimo de once (11) d&iacute;gitos.  "  value="<?= $aDefaultForm['txt_telefono_emerg_cont'];?>" size="15" maxlength="11" onkeyup="mayusculas(this);"  autocomplete="off"/>
		   <span>*</span>      	  
		   </font></td>	
		    <td align="left"><font color="#666666">
					<?php 
                    $disab="";
                    if($aDefaultForm['txt_visible']==2){ 
                        $disab="disabled";
                    }
                    ?> 
					<i class="fa-solid fa-people-group"></i>
                    <select style="border-radius: 30px; border-color:#999999; width:85%" id="cbo_parentesco_emerg_cont" name="cbo_parentesco_emerg_cont" <?php echo $disab; ?>>
                        <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
						<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Abuelo(a)</option>
						<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Amigo(a)</option>
                        <option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>C&oacute;nyuge </option>
                        <option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Hijo(a)</option>
						<option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Madre/Padre</option>
                        <option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Nieto(a)</option>
<?php /*?>                        <option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Padre</option><?php */?>
						<option value="7"<?php if (!(strcmp('7',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Primo(a)</option>
						<option value="8"<?php if (!(strcmp('8',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>Sobrino(a)</option>
						<option value="9"<?php if (!(strcmp('9',$aDefaultForm['cbo_parentesco_emerg_cont']))) {echo " selected=\"selected\"";}?>>T&iacute;o(a)</option>
                </select>
				<span>*</span>    
            </font></td>	
        </tr>




   <?php /*?> <tr>
        <th colspan="3" class="sub_titulo" align="left">Nombre y Apellido de un Familiar</th>
        <th colspan="1" class="sub_titulo" align="left">Tel&eacute;fono del Familiar</th>
    </tr>
    
    <tr>
        <td colspan="3" align="center">
			<?php 
            $disab="";
            if($aDefaultForm['txt_visible']==2){    
            $disab="disabled";
            }
            ?>
            <input style="width: 95%" name="txt_nombre_familiar" type="text" class="textbox" id="txt_nombre_familiar"  title="Nombre y Apellido de Familiar - Acepta un m&aacute;ximo de 100 caracteres"  value="<?= $aDefaultForm['txt_nombre_familiar'];?>" maxlength="150" 
            <?php echo $disab; ?> autocomplete="off" /> 
            <span class="requerido"> * </span>        </td>
    
        <td colspan="1" align="center">
			<?php 
            $disab="";
            if($aDefaultForm['txt_visible']==2){ 
            $disab="disabled";
            }
            ?> 
            <input style="width: 90%" name="txt_telefono_familiar" id="txt_telefono_familiar" type="text"  value="<?= $aDefaultForm['txt_telefono_familiar'];?>" title="Tel&eacute;fono d un Familiar - Ingrese s&oacute;lo N&uacute;meros. Acepta m&iacute;nimo 11 d&iacute;gitos. Ejemplo: 02121234567" onkeypress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. 02121234567"/> <span class="requerido"> * </span>        </td>        
    </tr>
    
    <tr>
        <th colspan="3" class="sub_titulo" align="left">Nombre y Apellido de un Contacto</th>
        <th colspan="1" class="sub_titulo" align="left">Tel&eacute;fono de un Contacto</th>
    </tr>
    
    <tr>
        <td colspan="3" align="center">
        <?php 
        $disab="";
        if($aDefaultForm['txt_visible']==2){    
        $disab="disabled";
        }
        ?>
        <input style="width: 95%" name="txt_nombre_contacto" type="text" class="textbox" id="txt_nombre_contacto"  title="Nombre y Apellido dl Contacto - Acepta un m&aacute;ximo de 100 caracteres"  value="<?= $aDefaultForm['txt_nombre_contacto'];?>" maxlength="150" 
        <?php echo $disab; ?> autocomplete="off" /> 
        <span class="requerido"> * </span>        </td>
    
        <td colspan="1" align="center">
        <?php 
        $disab="";
        if($aDefaultForm['txt_visible']==2){ 
        $disab="disabled";
        }
        ?> 
        <input style="width: 90%" name="txt_telefono_contacto" id="txt_telefono_contacto" type="text"  value="<?= $aDefaultForm['txt_telefono_contacto'];?>" title="Tel&eacute;fono de un Contacto - Ingrese s&oacute;lo N&uacute;meros. Acepta m&iacute;nimo 11 d&iacute;gitos. Ejemplo: 02121234567" onkeypress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" placeholder="Ej. 02121234567"/> <span class="requerido"> * </span>        </td>        
    </tr><?php */?>
    
    <tr>    </tr>
    
    <tr>
   		<th colspan="4" height="20"></th>
    </tr> 

    <tr class="identificacion_seccion" >
    	<th style="border-radius: 30px; border-color:#999999" colspan="4" class="sub_titulo" id="seccAdicionales" align="left">DATOS ADICIONALES<font color="#666666"></th>
    </tr> 
	          <tr>
            <th colspan="4" height="8"></th>
        </tr> 
	 <tr>  
            <th width="21%" style="color:#666" align="left">¿Tiene alguna Discapacidad?</th>
            <th width="24%" style="color:#666" align="left">Tipo de Discapacidad</th> 
            <th width="26%" style="color:#666" align="left">Grado de Discapacidad</th>
            <th width="29%" style="color:#666" align="left">C&oacute;digo CONAPDIS</th>
        </tr>
		
        <tr> 		
			<td align="left"><font color="#666666">
				<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_discapacidad" name="cbo_discapacidad" onchange="javascript:tienediscapacidad()">
					<option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>S&iacute;</option>
					<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_discapacidad']))) {echo " selected=\"selected\"";}?>>No</option>
				</select>
				<span>*</span> 
			    </font>			</td>		
							
		   <td align="left"><font color="#666666">
           		 <select style="border-radius: 30px; border-color:#999999; width:80%"  id="cbo_tipo_discapacidad" name="cbo_tipo_discapacidad">
           			 <option value="">Seleccione </option>
				<? LoadDiscapacidad ($conn) ; print $GLOBALS['sHtml_cb_tipo_Discapacidad']; ?>
           </select>	   
		   </font></td> 
		   
		    <td align="left"><font color="#666666">
           		 <select style="border-radius: 30px; border-color:#999999; width:80%"  id="cbo_grado_discapacidad" name="cbo_grado_discapacidad">
           			 <option value="">Seleccione </option>
				<? LoadGradoDiscapacidad_d ($conn) ; print $GLOBALS['sHtml_cb_grado_discapacidad']; ?>
           </select>	   
		   </font></td> 
		   
		   
		   
<!--            <td align="left"><font color="#666666">
           		 <select style="width: 80%"  id="cbo_grado_discapacidad" name="cbo_grado_discapacidad">
           			 <option value="">Seleccione</option>
            <option <? if($aDefaultForm['cbo_grado_discapacidad_descripcion']!=""){ echo "selected='selected'"; } ?> value="<?= $aDefaultForm['cbo_grado_discapacidad']; ?>"><?= $aDefaultForm['cbo_grado_discapacidad_descripcion'];?></option>
           </select><span class="requerido"> * </span>		   
		   </font></td> 
		   -->
		   
		   
            <td align="left"><font color="#666666">
			<i class="fa-sharp fa-solid fa-barcode"></i>
				<input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_conapdis" type="text" id="txt_conapdis" placeholder="C&oacute;digo CONAPDIS" title="C&oacute;digo CONAPDIS - Ingrese el c&oacute;digo del carnet de CONAPDIS.. Acepta un m&iacute;nimo de once (11) caracteres.  "  value="<?= $aDefaultForm['txt_conapdis'];?>" size="15" maxlength="11"  autocomplete="off" onkeyup="mayusculas(this);"/>
					
				</font></td>
       </tr> 

       <tr>
			<td colspan="4"> </td> 
	   </tr>
       
	   <tr>  
           <th width="21%" style="color:#666" align="left">Lateralidad</th>
           <th width="24%" style="color:#666" align="left">Tipo de Sangre </th>
           <th width="26%" style="color:#666" align="left">Inscripci&oacute;n Militar</th> 
           <th width="29%" style="color:#666" align="left">N&uacute;mero de Inscripci&oacute;n Militar </th> 
       </tr>

       <tr>
			<td align="left"><font color="#666666">
				<?php 
				$disab="";
				if($aDefaultForm['txt_visible']==2){ 
				$disab="disabled";
				}
				?>
				<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_lateralidad" name="cbo_lateralidad" <?php echo $disab; ?> >
				<option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
				<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Ambidiestro(a)</option>
				<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Derecho(a)</option>
				<option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_lateralidad']))) {echo " selected=\"selected\"";}?>>Zurdo(a)</option>
				</select>
				<span>*</span> </font>				</td>
			  
			  <td align="left"><font color="#666666">
			  <i class="fa-solid fa-syringe"></i>
				<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_grupo_sanguineo" name="cbo_grupo_sanguineo" onChange="grupo_sanguineo_combo();" >
				<option value="">Seleccione</option>
				<? LoadGrupoSanguineo ($conn) ; print $GLOBALS['sHtml_cb_grupo_sanguineo']; ?>
				</select><span class="requerido"> * </span>			
				</font> </td>
			  
			  
       <td align="left"><font color="#666666">
                <?php 
                $disab="";
                if($aDefaultForm['txt_visible']==2){ 
                    $disab="disabled";
                }
                ?> 
				<i class="fa-solid fa-person-military-rifle"></i>
                <select style="border-radius: 30px; border-color:#999999; width:85%" id="cbo_inscripcion_militar" name="cbo_inscripcion_militar" <?php echo $disab; ?> >
                    <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_inscripcion_militar']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
                    <option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_inscripcion_militar']))) {echo " selected=\"selected\"";}?>>S&iacute;</option>
                    <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_inscripcion_militar']))) {echo " selected=\"selected\"";}?>>No</option>
                </select><span> *</span>    	
            </font>			</td>
		      
			  <td align="left"><font color="#666666">
			  <i class="fa-solid fa-person-military-rifle"></i>
				   <input style="border-radius: 30px; border-color:#999999; width:85%" name="txt_cod_inscripcion_militar" type="text" id="txt_cod_inscripcion_militar" placeholder="N&uacute;mero de Inscripci&oacute;n Militar" title="N&uacute;mero de Inscripci&oacute;n - Ingrese el n&uacute;mero de Inscripci&oacute;n Militar Acepta un m&iacute;nimo de diez (10) caracteres.  "  value="<?= $aDefaultForm['txt_cod_inscripcion_militar'];?>" size="10" maxlength="10"  autocomplete="off" onkeyup="mayusculas(this);"/>			 
				   </font></td>       
          </tr> 
		  
           <tr>
        	<th colspan="4">&nbsp;</th>		
           </tr>

			<tr> 
				<!--<th width="21%" class="sub_titulo" align="left">¿Tiene Hijos?</th>-->
			    <th width="21%" style="color:#666"  align="left">Cantidad de Hijos</th> 
				<th colspan="3" style="color:#666"  align="left">Si su Cónyuge trabaja en el MPPPST, espec&iacute;fique en que dependencia labora</th> 
			</tr>

    <tr>
		
         <td align="left"><font color="#666666">
			<?php 
			$disab="";
			if($aDefaultForm['txt_visible']==2){ 
				$disab="disabled";
			}
			?>
				<i class="fa-solid fa-children"></i>
                <select style="border-radius: 30px; border-color:#999999; width:75%" id="cbo_cant_hijos" name="cbo_cant_hijos">
                    <option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>0</option>		
                    <option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>1</option>
                    <option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>2</option>
					<option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>3</option>
                    <option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>4</option>
					<option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>5</option>
                    <option value="7"<?php if (!(strcmp('7',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>6</option>
					<option value="8"<?php if (!(strcmp('8',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>7</option>
                    <option value="9"<?php if (!(strcmp('9',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>8</option>
					<option value="10"<?php if (!(strcmp('10',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>9</option>
                    <option value="11"<?php if (!(strcmp('11',$aDefaultForm['cbo_cant_hijos']))) {echo " selected=\"selected\"";}?>>10</option>					
                </select><span> *</span>    	
            </font></td>
			
		<td colspan="3" align="left">
        <?php 
        $disab="";
        if($aDefaultForm['txt_visible']==2){    
        $disab="disabled";
        }
        ?>
        <input style="border-radius: 30px; border-color:#999999; width:96%" name="txt_conyuge_trabajo" type="text" class="textbox" id="txt_conyuge_trabajo"  title="Dependencia donde trabaja el C&oacute;nyuge - Ingrese el nombre de la Dependencia donde trabaja su C&oacute;nyuge. Acepta un m&iacute;nimo de diez (10) y m&aacute;ximo de treinta (30) caracteres"  value="<?= $aDefaultForm['txt_conyuge_trabajo'];?>" maxlength="150" onkeyup="mayusculas(this);"
        <?php echo $disab; ?> autocomplete="off"/> 
        <!--<span class="requerido"> * </span>-->        </td>	
    </tr>
	 <tr>
        	<th colspan="4">&nbsp;</th>		
        </tr>
    
    <tr class="identificacion_seccion" >
    	<th style="border-radius: 30px; border-color:#999999" colspan="4" class="sub_titulo_2" id="seccTallas" align="left">Tallas</th>
    </tr>
	          <tr>
            <th colspan="4" height="8"></th>
        </tr> 
   <tr>
        <th width="21%" style="color:#666" align="center">Blusa o Camisa</th>		
        <th width="24%" style="color:#666" align="center">Pantal&oacute;n</th>
        <th width="26%" style="color:#666" align="center">Zapato</th>
        <th width="29%" style="color:#666" align="center">Chaqueta</th>  
    </tr>
    
    <tr>
<?php /*?>        <td>
           <input name="txt_talla_camisa" type="text" id="txt_talla_camisa" placeholder="Talla de la Blusa o Camisa" title="Talla de la Blusa o Camisa - Ingrese la talla de la Blusa o Camisa. Acepta un m&iacute;nimo 11 caracteres.  "  value="<?= $aDefaultForm['txt_talla_camisa'];?>" size="15" maxlength="11"  autocomplete="off" style="width: 85%"/>
		   <span>*</span>		
		 </td><?php */?>
		 
		 <td align="left"><font color="#666666">
				<?php 
				$disab="";
				if($aDefaultForm['txt_visible']==2){ 
				$disab="disabled";
				}
				?>
				<i class="fa-solid fa-shirt"></i>
				<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_talla_camisa" name="cbo_talla_camisa" <?php echo $disab; ?> >
					<option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>XS</option>
					<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>S</option>
					<option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>M</option>
					<option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>L</option>
					<option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>XL</option>
					<option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>XXL</option>
					<option value="7"<?php if (!(strcmp('7',$aDefaultForm['cbo_talla_camisa']))) {echo " selected=\"selected\"";}?>>XXXL</option>
				</select>
				<span>*</span> 
			    </font>			</td>	
		 		 
		 
        <td align="left"><font color="#666666">
		<span><img src="pantalones.png" style="width: 15px; background-color: none; margin: 3px;"/>
		</span>
		<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_talla_pantalon" name="cbo_talla_pantalon" <?php echo $disab; ?> >
					<option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>26</option>
					<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>28</option>
					<option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>30</option>
					<option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>32</option>
					<option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>34</option>
					<option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>36</option>
					<option value="7"<?php if (!(strcmp('7',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>38</option>
					<option value="8"<?php if (!(strcmp('8',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>40</option>
					<option value="9"<?php if (!(strcmp('9',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>42</option>
					<option value="10"<?php if (!(strcmp('10',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>44</option>
					<option value="11"<?php if (!(strcmp('11',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>46</option>
					<option value="12"<?php if (!(strcmp('12',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>48</option>
					<option value="13"<?php if (!(strcmp('13',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>50</option>
					<option value="14"<?php if (!(strcmp('14',$aDefaultForm['cbo_talla_pantalon']))) {echo " selected=\"selected\"";}?>>54</option>
				</select>
		<span>*</span>		
		</font></td>
		
        <td align="left"><font color="#666666">
		<i class="fa-sharp fa-solid fa-shoe-prints"></i>
		<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_talla_zapato" name="cbo_talla_zapato" <?php echo $disab; ?> >
					<option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>35</option>
					<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>36</option>
					<option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>37</option>
					<option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>38</option>
					<option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>39</option>
					<option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>40</option>
					<option value="7"<?php if (!(strcmp('7',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>42</option>
					<option value="8"<?php if (!(strcmp('8',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>43</option>
					<option value="9"<?php if (!(strcmp('9',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>44</option>
					<option value="10"<?php if (!(strcmp('10',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>45</option>
					<option value="11"<?php if (!(strcmp('11',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>46</option>
					<option value="12"<?php if (!(strcmp('12',$aDefaultForm['cbo_talla_zapato']))) {echo " selected=\"selected\"";}?>>48</option>
				</select>
		<span>*</span>		
		</font></td>
		
     <td align="left"><font color="#666666">
	<i class="fa-sharp fa-solid fa-vest"></i>
		<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_talla_chaqueta" name="cbo_talla_chaqueta" <?php echo $disab; ?> >
					<option value=""<?php if (!(strcmp('',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>S</option>
					<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>SS</option>
					<option value="3"<?php if (!(strcmp('3',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>L</option>
					<option value="4"<?php if (!(strcmp('4',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>M</option>
					<option value="5"<?php if (!(strcmp('5',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>XL</option>
					<option value="6"<?php if (!(strcmp('6',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>XXL</option>
					<option value="7"<?php if (!(strcmp('7',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>XXXL</option>
					<option value="8"<?php if (!(strcmp('8',$aDefaultForm['cbo_talla_chaqueta']))) {echo " selected=\"selected\"";}?>>XXXXL</option>
				</select>
		<span>*</span>		
		</font></td>		
   </tr>
   
    <tr>
      	<th colspan="4">&nbsp;</th>		
    </tr>
	
	<tr>
		<td id="seccPatologias" class="rogAuxiliar" colspan="4"></td>
	</tr>
        
    <tr>    </tr>
    
    <tr>
    	<th colspan="4" height="20"></th>
    </tr> 
    
	
	
			<tr class="identificacion_seccion">
				<th style="border-radius: 30px; border-color:#999999" colspan="4" class="sub_titulo" id="seccLaboral" align="left">DATOS LABORALES</th>
			</tr>	
	
			<tr>
            	<th colspan="4" height="8"></th>
           </tr> 
		
			<tr>
	    		<th colspan="3" style="color:#666" align="left"><div align="left">Ubicaci&oacute;n Administrativa de Adscripci&oacute;n</div></th>
				<th style="color:#666"><div align="left">Estado</div></th>
			</tr>
		
			<tr>
			<td colspan="3"><font color="#666666"><?= $aDefaultForm['txt_ubicacion_adm'];?></font></td>
			
			<td align="left"><font color="#666666">
			
            <!--select style="width: 80%" id="cbo_entidad" name="cbo_entidad" onChange="estado_combo();"   -->
            <select style="border-radius: 30px; border-color:#999999; width:90%" id="cbo_entidad" name="cbo_entidad" onChange="">
            <option value="">Seleccione</option>
            <? LoadEstadoAdscripcion ($conn) ; print $GLOBALS['sHtml_cb_Estado_trab']; ?>
            </select><span class="requerido"> * </span>       
			</font> </td>
			</tr>
			          <tr>
            <th colspan="4" height="6"></th>
        </tr> 
			
	<tr>
        <th colspan="3" style="color:#666" align="left">Ubicaci&oacute;n F&iacute;sica</th>
        <th colspan="1" style="color:#666" align="left">Tel&eacute;fono de Oficina</th>
    </tr>
	
	<tr>
		<td colspan="3" align="left"><font color="#666666">
		<?php 
		$disab="";
		if($aDefaultForm['txt_visible']==2){    
			$disab="disabled";
		}
		?>
		<i class="fa-solid fa-building"></i>
		<input style="border-radius: 20px; border-color:#999999; width:85%" name="txt_ubicacion_fisica_actual" type="text" class="textbox" id="txt_ubicacion_fisica_actual"  title="Ubicaci&oacute;n F&iacute;sica - Acepta un m&aacute;ximo de cien (100) caracteres"  value="<?= $aDefaultForm['txt_ubicacion_fisica_actual'];?>" maxlength="150"  onkeyup="mayusculas(this);"
		<?php echo $disab; ?> autocomplete="off" /> 
		<span class="requerido"> * </span>		
		</font></td>   
		     
        <td colspan="1" align="center"><font color="#666666">
			<?php 
		$disab="";
		if($aDefaultForm['txt_visible']==2){ 
			$disab="disabled";
		}
		?> 
		<i class="fas fa-phone"></i>
		<input style="border-radius: 30px; border-color:#999999; width:82%" name="txt_telefono_oficina" id="txt_telefono_oficina" type="text"  value="<?= $aDefaultForm['txt_telefono_oficina'];?>" title="Tel&eacute;fono Oficina - Ingrese s&oacute;lo n&uacute;meros. Acepta m&iacute;nimo once (11) d&iacute;gitos. Ejemplo: 02121234567" onKeyPress="return isNumberKey(event);" maxlength="11" <?php echo $disab; ?> autocomplete="off" onkeyup="mayusculas(this);"  placeholder="Ej. 02121234567"/> <span class="requerido"> * </span>		
		</font></td>        
	</tr>
	          <tr>
            <th colspan="4" height="6"></th>
        </tr> 
			<tr>
				<th colspan="2" style="color:#666" ><div align="left">Cargo o Puesto de Trabajo Titular</div></th>
				<th colspan="2" style="color:#666" ><div align="left">Cargo o Puesto de Trabajo que ejerce</div></th>
			</tr> 
			
	<tr>  
		<td colspan="2" align="left"><font color="#666666"><?= $aDefaultForm['txt_cargo'];?></font></td>
		
		<td colspan="2" align="left"><font color="#666666">
		<?php 
		$disab="";
		if($aDefaultForm['txt_visible']==2){    
			$disab="disabled";
		}
		?>
		<i class="fa-sharp fa-solid fa-user-tie"></i>
		<input style="border-radius: 30px; border-color:#999999; width:92%" name="txt_cargo_actual_ejerce" type="text" class="textbox" id="txt_cargo_actual_ejerce"  title="Cargo o Puesto de Trabajo que ejerce - Acepta un m&aacute;ximo de cien (100) caracteres"  value="<?= $aDefaultForm['txt_cargo_actual_ejerce'];?>" maxlength="150" onkeyup="mayusculas(this);"
		<?php echo $disab; ?> autocomplete="off" /> 
		<span class="requerido"> * </span>		
		</font></td>   
			</tr> 
						
		          <tr>
            <th colspan="4" height="6"></th>
        </tr> 
			<tr>
			 <th width="21%" style="color:#666"><div align="left">Tipo de Trabajador</div></th>
			 <th width="24%" style="color:#666"><div align="left">C&oacute;digo de N&oacute;mina</div></th>
			  <th width="26%" style="color:#666"><div align="left">Fecha de Ingreso al MPPPST</div></th>
			  <th width="29%" style="color:#666"><div align="left">Fecha de Ingreso a la Adm. P&uacute;blica</div></th>
			</tr> 
		
			<tr>
			    <td align="left"><font color="#666666"><?= $aDefaultForm['txt_tipo_trabajador'];?></font></td>
				<td  align="left"><font color="#666666"><?= $aDefaultForm['txt_codigo_nom'];?></font></td>
				<td align="left"><font color="#666666"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso']));?></font></td> 
				<td align="left"><font color="#666666"><?= strftime("%d/%m/%Y", strtotime($aDefaultForm['txt_fecha_ingreso_adm']));?></font></td> 
			</tr>
          <tr>
            <th colspan="4" height="6"></th>
        </tr> 
			<tr>
  	  <th colspan="4" style="color:#666" align="left">Observaci&oacute;n(es)</th>
    </tr>

    <tr>
        <td colspan="4" align="left"><font color="#666666">
        <?php 
        $disab="";
        if($aDefaultForm['txt_visible']==2){    
        $disab="disabled";
        }
        ?>
		<i class="fa-solid fa-pen-to-square"></i>
		
        <input style="border-radius: 30px; border-color:#999999; width:95%" name="txt_observacion" type="text" class="textbox" id="txt_observacion"  title="Observaci&oacute;n - Ingrese la observaci&oacute;n u observaciones que tiene con respecto a sus datos laborales. Acepta un m&iacute;nimo de diez (10) y un m&aacute;ximo de treinta (30) caracteres"  value="<?= $aDefaultForm['txt_observacion'];?>" maxlength="160" onkeyup="mayusculas(this);"
        <?php echo $disab; ?> autocomplete="off"/> 
        <!--<span class="requerido"> * </span>-->        </font></td>
    </tr>

	<tr>
    	<th colspan="4" height="20"></th>
    </tr> 
	
	<tr>
		<td id="seccAcademicos" class="rogAuxiliar" colspan="4"></td>
	</tr>
	
	<tr>
	  <th colspan="4" align="left"><font color="#1a5276" size="-4">DATOS ACAD&Eacute;MICOS ADICIONALES </font></th>
    </tr>
		<tr>
            	<th colspan="4" height="8"></th>
           </tr> 
		
	<tr>
 		<th align="left" style="color:#666" >
	<i class="fa-solid fa-pen-to-square"></i>¿Desea continuar sus estudios?</th>
		<th colspan="2" align="left" style="color:#666" ><i class="fa-solid fa-pen-to-square"></i>Opciones de Estudio </th>
	   <th align="left" style="color:#666" >¿Le gustar&iacute;a participar como Facilitador?</th>		
	</tr>
	
	<tr>
	   <td align="left" ><font color="#666666">
				<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_continuar_est" name="cbo_continuar_est" onchange="chx_continuar_est__(event)">
					<option value="0"<?php if (!(strcmp('',$aDefaultForm['cbo_continuar_est']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_continuar_est']))) {echo " selected=\"selected\"";}?>>S&iacute;</option>
					<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_continuar_est']))) {echo " selected=\"selected\"";}?>>No</option>
				</select>
				<span>*</span> 
			    </font>       </td>
	
			
	<td colspan="2"  align="left" ><font color="#666666">
				<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_opciones_est" name="cbo_opciones_est" onchange="chx_continuar_est_falcone(event)">
				</select>
				<span>*</span> 
			    </font>	  </td>
	  
	  	<td align="left" ><font color="#666666">
				<select style="border-radius: 30px; border-color:#999999; width:80%" id="cbo_facilitador" name="cbo_facilitador">
					<option value="0"<?php if (!(strcmp('',$aDefaultForm['cbo_facilitador']))) {echo " selected=\"selected\"";}?>>Seleccione </option>
					<option value="1"<?php if (!(strcmp('1',$aDefaultForm['cbo_facilitador']))) {echo " selected=\"selected\"";}?>>S&iacute;</option>
					<option value="2"<?php if (!(strcmp('2',$aDefaultForm['cbo_facilitador']))) {echo " selected=\"selected\"";}?>>No</option>
				</select>
				<span>*</span> 
			    </font>	  </td>
	</tr>
	 
	<tr>
    	<th colspan="4" height="20"></th>
    </tr> 
     <tr>
         <td colspan="4" align="center">
       <button type="button" class="button_personal btn_guardar" onClick="javascript:send('guardar');" title="Guardar Registro -  Haga Clic para Guardar la Informaci&oacute;n">Guardar</button>     </td>
     </tr>
</table>
<div id="loader" class="loaders" style="display: none;"></div>
</form>

	</td>
	</tr>
	</tbody>
	</table>
	<script type="text/javascript" src="rec_pago_actualizacion.js"></script>
	<script type="text/javascript" src="para_el_combo_de_estados.js"></script>
	<script type="text/javascript" src="para_el_combo_de_opciones_de_estudio.js"></script>
<?php
}

?>
<!-- RAFA GOMEZ ult. 14/02/2023
<script>
	document.getElementById("cmbSecc").innerHTML = Array.from(document.getElementsByClassName("sub_titulo_2")).map(
		x => `<option><a href="#${x.id}">${x.textContent}</a></option>`
	).join("");
</script>
-->
<script src='../../../src/rogLib/rogLib.js'></script>
<script src='../../../src/rogLib/rogCSS.js'></script>
<script src='../../../src/rogLib/rogMnuFlotante.js'></script>
<script type="module" src='../../Auxiliares/preparaAuxiliarTrabajador.js'></script>

<style>
		svg {
			height: 1.5em;
		}

		.auxiliar tr {
			line-height: 2em;
			border-bottom: 1px solid currentColor;
		}
		
		.titulos th {
			color: #666;
		}

		.col_graduado {
			text-align: center;
		}

		.col_eliminar {
			color: red !important;
			text-align: center;
		}

		.btnEspecial {
			color: #464646;
			margin: .2em;
		}

		.btnEspecial svg {
			height: 1.35em;
		}

		.btnEspecial:hover {
			color: olive;
		}

		.trEscogida {
			background-color: pink;
			color: red;
		}
		
		.invalid {
			border: 2px solid red !important;
		}
	</style>

<?php include("../../footer.php"); ?>

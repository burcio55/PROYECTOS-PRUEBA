<?php
//----------------------------------------
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
include("../LoadCombos.php");
$conn= getConnDB($db1);
$conn->debug =false;
//----------------------------------------

$aDefaultForm = array();
$aPageErrors = array();
$ids_elementos_validar= array();

doAction($conn);
debug();
showHeader();
showForm($conn,$aDefaultForm);
showFooter();

function debug(){
	 if($settings['debug']){
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION);	
	}
}

function trace($msg){
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}

function doAction($conn){
	if (isset($_POST['action'])){
				switch($_POST["action"]){
				case 'ir':
						//$bValidateSuccess=true;
						header('Location:consulta_region.php');
				break;			
				}
		}else{
		LoadData($conn,false);
	}
 }

//-----------------------------------------------------------------------------//
function LoadData($conn,$bPostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
			$aDefaultForm = &$GLOBALS['aDefaultForm'];
			

		if (!$bPostBack){
		
								
								$SQL="SELECT empresa.id, 
													sdenominacion_comercial, 
													srazon_social, 
													sdireccion_fiscal, 
													nro_boleta,
													sucursales,
													entidad.sdescripcion as entidad, 
													municipio.sdescripcion as municipio, 
													region.sdescripcion as region, 
													srif
											FROM scpt.empresa
											INNER JOIN public.region ON public.region.id=scpt.empresa.region_id
											INNER JOIN public.entidad ON public.entidad.nentidad=scpt.empresa.entidad_nentidad
											INNER JOIN public.municipio ON public.municipio.nmunicipio=scpt.empresa.municipio_nmunicipio
											WHERE empresa.id='".$_REQUEST['id']."' AND empresa.nenabled='1'";
								$rs=$conn->Execute($SQL);	
								
									if ($rs->RecordCount()>0){
										$aDefaultForm['txt_razonsocial']=$rs->fields['srazon_social'];
										$aDefaultForm['txt_denominacion']=$rs->fields['sdenominacion_comercial'];
										$aDefaultForm['txt_boleta']=$rs->fields['nro_boleta'];
										$aDefaultForm['txt_sucursales']=$rs->fields['sucursales'];
										$aDefaultForm['txt_direccion']=$rs->fields['sdireccion_fiscal'];	
										$aDefaultForm['txt_rif']=$rs->fields['srif'];
										$aDefaultForm['cbo_region']=strtoupper($rs->fields['region']);
										$aDefaultForm['cbo_entidad']=strtoupper($rs->fields['entidad']);
										$aDefaultForm['cbo_municipio']=strtoupper($rs->fields['municipio']);
							}

		}else{
		}
	}
}




function ProcessForm($conn){	
}


function doReport($conn){
	
}

function showHeader(){
 include('../header.php'); 
}

function showForm($conn,$aDefaultForm){
?>
<form name="frm_registro" id="frm_registro" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<input name="action" type="hidden" value="" />
<input name="id" id="id" type="hidden" value="<?=$_REQUEST['id']?>" />
<script type="text/javascript" src="../mod_registro/funciones_regiones.js"></script>		
<script>
	function send(saction){
			var form = document.frm_registro;
			form.action.value=saction;
			form.submit();
	}
</script>


<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">

  <tr>
  	<th colspan="3" class="sub_titulo_2"><div align="left">DATOS DE LA ENTIDAD DE TRABAJO</div></th>
  </tr>

  <tr>
    <th class="sub_titulo"><div align="center">REGI&Oacute;N</div></th>
    <th class="sub_titulo"><div align="center">ESTADO</div></th>
    <th class="sub_titulo"><div align="center">MUNICIPIO</div></th>
       
  </tr>
  
  <tr>
     <td align="center">
		<input style="text-align:center" name="cbo_region"  size="40"  id="cbo_region" type="text"  value="<?= $aDefaultForm['cbo_region'];?>" maxlength="9" disabled/>  
    </td>
    <td >
		<input style="text-align:center" name="cbo_entidad" size="40"  id="cbo_entidad" type="text"  value="<?= $aDefaultForm['cbo_entidad'];?>" maxlength="9" disabled/>   
    </td>
    <td >
		<input style="text-align:center" name="cbo_municipio" size="40" id="cbo_municipio" type="text"  value="<?= $aDefaultForm['cbo_municipio'];?>" maxlength="9" disabled/>   
    </td>
  </tr>
  

  <tr>
    <th  class="sub_titulo"><div align="center">RIF</div></th>
    <th  colspan="2" class="sub_titulo" ><div align="center">NOMBRE O RAZ&Oacute;N SOCIAL</div></th>
    
  </tr>
  
  <tr>
    <td align="center">
      <input style="text-align:center" name="txt_rif" size="40"  id="txt_rif" type="text"  value="<?= $aDefaultForm['txt_rif'];?>" maxlength="9" disabled/>
    </td>
    <td align="center" colspan="2">
    <textarea style="text-align:center" name="txt_razonsocial" id="txt_razonsocial" cols="70" rows="1" disabled><?= $aDefaultForm['txt_razonsocial'];?></textarea>
    </td>
  </tr>
  
  <tr>
    <th class="sub_titulo"><div align="center">DENOMINACI&Oacute;N COMERCIAL</div></th>
    <th colspan="2" class="sub_titulo"><div align="center">DIRECCI&Oacute;N FISCAL</div></th> 
  </tr>
  
  <tr>
    <td align="center">
    <textarea style="text-align:center" name="txt_denominacion" id="txt_denominacion" cols="50" rows="1" maxlength="70" disabled><?= $aDefaultForm['txt_denominacion'];?></textarea>
    </td>
    <td align="center"colspan="2">
    <textarea style="text-align:center" name="txt_direccion" id="txt_direccion" cols="70" rows="1" disabled><?= $aDefaultForm['txt_direccion'];?></textarea>
    </td>    
  </tr>
  <tr>
    <th colspan="1" align="center" class="sub_titulo"><div align="center">N&uacute;mero de Boleta del CPT</th>      
    <th colspan="2" align="center" class="sub_titulo"><div align="center">Sucursales</th>      
  </tr>
 
   <tr>
       <td align="center" colspan="1">
    <textarea style="text-align:center" name="txt_boleta" id="txt_boleta" cols="60" rows="1" maxlength="30" align="center" disabled><?= $aDefaultForm['txt_boleta'];?></textarea>
    </td> 
       <td align="center" colspan="2">
    <textarea style="text-align:center" name="txt_sucursales" id="txt_sucursales" cols="80" rows="1" maxlength="100" align="center" disabled><?= $aDefaultForm['txt_sucursales'];?></textarea>
    </td> 
  </tr>
  
  <tr>
    <th class="separacion_10"></th>
  </tr>
  <tr>
  	<th colspan="3" class="sub_titulo_2"><div align="left">DATOS DE LOS INTEGRANTES DEL CPT</div></th>
  </tr>
</table>

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4" align="center">
        <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
        <div id="miembros_tabla" style=" height:200px;" ></div>
      </td>
    </tr>
</table>




<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
  <tr>
  	<th colspan="4" class="sub_titulo_2"><div align="left">DATOS DEL RESUMEN PRODUCTIVO DE LA ENTIDAD DE TRABAJO</div></th>
  </tr>

    <tr>
      <td colspan="4" align="center">
        <input type="hidden" id="cant_campos" name="cant_campos" value="<?php echo $aDefaultForm['cant_campos'];  ?>" />
        <div id="productos_tabla" style=" height:200px;" ></div>
      </td>
    </tr>
</table>

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
      <th colspan="4" align="center">
      <button type="button" name="cmd_guardar"  id="cmd_guardar" class="button" title="Regresar - Haga Click para Regresar" onclick="javascript:send('ir');">
      <img src="../imagenes/left_16.png" />   Regresar           
      </button>
      </th>
    </tr>
</table>

</form>
<?php
}
//funcion que imprime con alert todos los errores
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 
<?php  include('../footer.php'); ?>


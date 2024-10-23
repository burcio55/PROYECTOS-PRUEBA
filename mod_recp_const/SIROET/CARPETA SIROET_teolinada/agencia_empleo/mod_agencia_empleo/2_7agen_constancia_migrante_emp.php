<?php
include('../include/header.php');
include('../include/security_chain.php');
$conn = getConnDB('sire');
$acceso1 = getConnDB('acceso1');
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn,$acceso1);
debug($settings['debug']);
showHeader();
showForm($conn,$acceso1,$aDefaultForm);
showFooter();
//------------------------------------------------------------------------------------------------------------------------------
function debug()
{
	if ($GLOBALS['settings']['debug']) { 
		print "<br>**** POST: ****<br>";
		var_dump($_POST);
		print "<br>**** DEFAULTS FORM: *****<br>";
		var_dump($GLOBALS['aDefaultForm']);
		print "<br>**** SESSION: *****<br>";
		var_dump($_SESSION['bloq']);
	}
}
//------------------------------------------------------------------------------------------------------------------------------
/*function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}*/
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn,$acceso1){
    LoadData($conn,$acceso1,true);
   }

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn,$acceso1)
{
	
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$acceso1,$bPostBack){
	
        $_POST['fechahoy']=strftime("%e de %B de %Y");
		if ($_GET['id_po']!='') $_SESSION['id_empresa']=$_GET['id_po'];	
		if ($_GET['rif']!='') $_SESSION['rif']=$_GET['rif'];
		
		unset($_SESSION['n_trabajadores_t']);
		unset($_SESSION['localidad']);
 
	$SQL="select empresa_instituto.pers_migrante, empresa_instituto.persona_contacto, empresa_instituto.nombre, 
	      empresa_instituto.n_trabajadores, empresa_instituto.n_extranjeros, 
		  estado.nombre as estado, municipio.nombre as municipio, parroquia.nombre as parroquia 
		  from empresa_instituto 
		  INNER JOIN estado ON estado.id=empresa_instituto.estado_id
		  INNER JOIN municipio ON municipio.id=empresa_instituto.municipio_id
		  INNER JOIN parroquia ON parroquia.id=empresa_instituto.parroquia_id
		  where empresa_instituto.id ='".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'";
		  $rs1 = $conn->Execute($SQL);	
		    $_POST['pers_migrante']=$rs1->fields['pers_migrante'];
		    $_POST['n_trabajadores']=$rs1->fields['n_trabajadores'];
			$_POST['n_extranjeros']=$rs1->fields['n_extranjeros'];	
			$_SESSION['n_trabajadores_t']=$_POST['n_trabajadores'].'*'.$_POST['n_extranjeros'];	
			$_SESSION['nombre_empresa']=htmlspecialchars($rs1->fields['nombre'], ENT_QUOTES);			
			$_POST['estado']=htmlspecialchars($rs1->fields['estado'], ENT_QUOTES);
			$_POST['municipio']=htmlspecialchars($rs1->fields['municipio'], ENT_QUOTES);
			$_POST['parroquia']=htmlspecialchars($rs1->fields['parroquia'], ENT_QUOTES);	
			$_SESSION['localidad']=$_POST['estado'].'*'.$_POST['municipio'].'*'.$_POST['parroquia'];
//--------------------------------------------------------------------------------------------------------------JEFES DE AGENCIA		  
$SQL2="SELECT jefes_agencia.cedula, jefes_agencia.nombre, jefes_agencia.apellido,
              unidadsustantiva.sdenominacion, unidadsustantiva.cod_nombre, unidadsustantiva.ciudad,
              unidadsustantiva.direccion,unidadsustantiva.telefonos, unidadsustantiva.correo
			  FROM jefes_agencia 
			  inner join unidadsustantiva on unidadsustantiva.sunidadsustantiva=jefes_agencia.sunidadsustantiva
			  where unidadsustantiva.vigente='S' 
			  and jefes_agencia.status='A' 
			  and unidadsustantiva.sunidadsustantiva='".$_SESSION['sUnidadSustantiva']."'";
			  $rs2 = $acceso1->Execute($SQL2);		
			  $aTabla=array();
				while(!$rs2->EOF){  
			  $c = count($aTabla);		
		      $aTabla[$c]['nombre']=htmlentities($rs2->fields['nombre'], ENT_QUOTES);
			  $aTabla[$c]['apellido']=htmlentities($rs2->fields['apellido'], ENT_QUOTES);
			  $aTabla[$c]['sdenominacion']=htmlentities($rs2->fields['sdenominacion'], ENT_QUOTES);
			  $aTabla[$c]['cod_nombre']=$rs2->fields['cod_nombre'];
			  $aTabla[$c]['ciudad']=htmlentities($rs2->fields['ciudad'], ENT_QUOTES);
			  $aTabla[$c]['direccion']=htmlentities($rs2->fields['direccion'], ENT_QUOTES);
			  $aTabla[$c]['telefonos']=$rs2->fields['telefonos'];
			  $aTabla[$c]['correo']=$rs2->fields['correo'];
			  $rs2->MoveNext();
			 }
			$_SESSION['aTabla'] = $aTabla;	
						
}
//------------------------------------------------------------------------------------------------------------------------------
function doReport($conn)	
{
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<title>Agencia Empleo</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo14 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo18 {font-size: 12px}
.Estilo19 {font-size: 14px}
-->
</style>
</head>
<body>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>
  <p align="center"><b>
    <? if ($_POST['pers_migrante']=='1'){?>
  </b></p>
  <table width="82%" border="0" align="center" class="tablaborde_shadow">
  <? $aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $c=0; $c<count($aTabla); $c++){ ?>
    <tr>
      <td colspan="4" ><img src="../images/cintillo.jpg" width="100%" height="61" /></td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td width="3" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><span class="Estilo14"><strong>DIRECCI&Oacute;N GENERAL DE EMPLEO </strong></span></td>
      <td width="19" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td ><div align="right"></div></td>
      <td >&nbsp;</td>
      <td ><div align="right"><b>Nº de Oficio:
        <?=$aTabla[$c]['cod_nombre']?>
                <?=$_SESSION['id_afiliado']?>
      </b></div></td>
      <td >&nbsp;</td>
    </tr>
    
    <tr>
      <td >&nbsp;</td>
      <td width="21" >&nbsp;</td>
      <td width="734" ><div align="right" class="links-menu-izq">
          <div align="left">
            <?=$aTabla[$c]['sdenominacion']?>
          </div>
      </div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="right" class="links-menu-izq"><b>
          <?=$aTabla[$c]['ciudad']?>
        ,
        <?=$_POST['fechahoy']?>
      </b></div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td height="18" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="center">
        <h5 class="Estilo19">CONTANCIA DE ACTUALIZACIÓN</h5>
      </div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="justify" class="Estilo14">
        <p>Por medio de la presente se hace constar que la empresa<b>
          <?=$_SESSION['nombre_empresa']?>
        </b>,identificada 
        con el RIF N°<b>
        <?=$_SESSION['rif']?>
        </b>; ubicada en el estado <b>
        <?=$_POST['estado']?>
        </b>, municipio <b>
        <?=$_POST['municipio']?>
        , </b>parroquia  <b>
        <?=$_POST['parroquia']?>
        </b>; y registrada en el Servicio Público de Empleo con el código Nº <b>
        <?=$_SESSION['id_empresa']?>
        </b>,         acudió en esta fecha a fin de hacer uso del servicio de intermediación laboral para el 
        trámite de Permiso Laboral ante la Dirección de Migraciones Laborales de este 
        Ministerio. Actualizando su data de registro y dejando constancia que para el momento 
        mantiene en nómina un total de <b>
        <?=$_POST['n_trabajadores']?>
        </b> trabajadores y trabajadoras, de los (las) 
        cuales <b>
        <?=$_POST['n_extranjeros']?>
        </b>son de nacionalidad extranjera.</p>
        </div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="center"><span class="Estilo14">Atentamente,</span></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">____________________________________________________</div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center" class="Estilo18"><span class="Estilo19">
          <?=$aTabla[$c]['nombre']?>
          </span><span class="Estilo19">
          <?=$aTabla[$c]['apellido']?>
      </span></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><i>Jefe de Agencia</i></div></td>
    </tr>
    
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="links-menu-izq"><div align="center">Nota: Todos los servicios ofrecidos son absolutamente gratuitos, tanto para los trabajadores y trabajadoras, como 
        para las empresas, y solo obliga a informar a la Agencia de Empleo los resultados del proceso de selección de las 
      personas para cubrir los puestos de trabajo vacantes ofertados. </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="center" class="links-menu-izq">
        <p class="links-menu-izq">
          <?=$aTabla[$c]['sdenominacion']?>
          <?=$aTabla[$c]['direccion']?>
        </p>
        <p class="links-menu-izq">Teléfonos:
          <?=$aTabla[$c]['telefonos']?>
          e-mail:
  <?=$aTabla[$c]['correo']?>
        </p>
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
        <table width="200" border="0" align="center">
          <tr>
            <td><div align="center"><a href="pdf_constancia_migrante_empresa.php"><img src="../images/imprimir.gif" width="23" height="20" border="0" /></a></div></td>
          </tr>
		  <? } ?>
        </table>


        <p><b>
          <? }
		     else{
			 ?><script>if (confirm("- Esta empresa indicó que No contrata personal migrante calificado"))
			              document.location="2_6agen_formato_empresa.php?";</script><?
			 }			 
			 ?>
        </b></p>
</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>alert('".join('\n',$aPageErrors)."')</script>":""; 
?> 
</body>
</html>
<?php
}
?>
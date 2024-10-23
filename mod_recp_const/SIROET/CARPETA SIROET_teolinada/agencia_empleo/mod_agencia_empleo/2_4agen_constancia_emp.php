<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = false;
doAction($conn);
debug($settings['debug']=false);
showHeader();
showForm($conn,$aDefaultForm);
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
		
 	unset($_SESSION['localidad']);
	$SQL="select empresa_instituto.persona_contacto, empresa_instituto.nombre, created_at,
		  estado.nombre as estado, municipio.nombre as municipio, parroquia.nombre as parroquia 
		  from empresa_instituto 
		  INNER JOIN estado ON estado.id=empresa_instituto.estado_id
		  INNER JOIN municipio ON municipio.id=empresa_instituto.municipio_id
		  INNER JOIN parroquia ON parroquia.id=empresa_instituto.parroquia_id
		  where empresa_instituto.id ='".$_SESSION['id_empresa']."' and rif='".$_SESSION['rif']."'";
		  $rs1 = $conn->Execute($SQL);	
				 if ($rs1->RecordCount()>0){ 		
		  $_SESSION['nombre_empresa']=htmlspecialchars($rs1->fields['nombre'], ENT_QUOTES);			
			$_POST['estado']=htmlspecialchars($rs1->fields['estado'], ENT_QUOTES);
			$_POST['municipio']=htmlspecialchars($rs1->fields['municipio'], ENT_QUOTES);
			$_POST['parroquia']=htmlspecialchars($rs1->fields['parroquia'], ENT_QUOTES);	
			$_POST['fecha_inscripcion']=strftime("%d-%m-%Y", strtotime($rs1->fields['created_at']));			
			$_SESSION['localidad']=$_POST['estado'].'*'.$_POST['municipio'].'*'.$_POST['parroquia'].'*'.$_POST['fecha_inscripcion'];
			}
			else{
				
				}
//------------------------------------------------------------------------------------------------------------JEFES DE AGENCIA		  
/*$SQL2="SELECT jefes_agencia.cedula, jefes_agencia.nombre, jefes_agencia.apellido,
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
			$_SESSION['aTabla'] = $aTabla;*/	
}
//------------------------------------------------------------------------------------------------------------------------------
function doReport($conn)	
{
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_empresa.php'); }
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
  <p align="center">&nbsp;</p>

  <table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4" ><img src="../imagenes/cintillo.jpg" width="100%" height="61" /></td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td width="11" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><strong>DIRECCI&Oacute;N GENERAL DE EMPLEO </strong></td>
      <td width="27" >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="right"><b>N&deg; de Oficio:
         <?=$_SESSION['id_empresa']?>
      </b></div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td width="11" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><b>Fecha: <?=$_POST['fecha_inscripcion']?></b></td>
      <td ></td>
    </tr>
    
    <tr>
      <td >&nbsp;</td>
      <td width="40" >&nbsp;</td>
      <td width="734" ><div align="right" class="links-menu-izq">
          <div align="left">
          </div>
      </div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="right" class="links-menu-izq"><b>
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
      <strong>CONSTANCIA DE REGISTRO DE ENTIDAD DE TRABAJO</strong></div></td>
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
        <p>Por medio de la presente se hace constar que la entidad de trabajo <b><?=$_SESSION['nombre_empresa']?></b>, identificada 
        con el RIF N°<b><?=$_SESSION['rif']?></b>; ubicada en el Estado <b><?=$_POST['estado']?></b>, Municipio <b><?=$_POST['municipio']?></b>, Parroquia  <b><?=$_POST['parroquia']?></b>; ha sido registrada en el Servicio P&uacute;blico de Empleo con el c&oacute;digo N&deg; <b><?=$_SESSION['id_empresa']?></b>, a fin de hacer uso del Servicio de Intermediaci&oacute;n Laboral.</p>
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
      <td><div align="center">Atentamente,</div></td>
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
      <td colspan="4"></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><i>Coordinador/a de Previsi&oacute;n Social</i></div></td>
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
      <td class="links-menu-izq"><div align="center"><p>Nota: Constancia solo de uso interno que  no certifica la condici&oacute;n de desocupado (a) de la persona registrada en la base  de datos Sistema de Informaci&oacute;n y Registro   de Previsi&oacute;n Social.</p>
        <p>Todos los servicios ofrecidos son gratuitos, tanto para los  trabajadores y trabajadoras, como para las Entidades de Trabajo.</p></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>
        <table width="200" border="0" align="center">
          <tr>
            <td><div align="center"><a href="pdf_constancia_empresa.php"><img src="../imagenes/print_32.png" width="23" height="20" border="0" /></a></div></td>
          </tr>
        </table>
          <p>&nbsp;</p>  
          <p>&nbsp;</p>


</form>
<?php
}
//------------------------------------------------------------------------------------------------------------------------------
function showFooter(){
$ids_elementos_validar = $GLOBALS['ids_elementos_validar'];
//var_dump($ids_elementos_validar);

for($i=0; $i<count($ids_elementos_validar);$i++){
echo "<script> document.getElementById('".$ids_elementos_validar[$i]."').style.border='1px solid Red'; </script>";
}

$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>  alert('DEBE VERIFICAR LAS SIGUIENTES CONDICIONES:' +  '".'\n'.join('\n',$aPageErrors)."')</script>":""; }
?> 

<?php include('../footer.php'); ?>
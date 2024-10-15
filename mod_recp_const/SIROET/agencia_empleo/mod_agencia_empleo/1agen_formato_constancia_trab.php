<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
$conn = getConnDB('sire');
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
		var_dump( $_SESSION['rs11']);
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
function doAction($conn){
    LoadData($conn,true);
   }

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn)
{
		
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$acceso1,$bPostBack){

	      //$_SESSION['usuario']= htmlspecialchars($_SESSION['usuario'], ENT_QUOTES);	
		
		$_POST['fechahoy']=strftime("%e de %B de %Y");	
		
				$SQL1="SELECT id, nombres, apellidos
				from personas where id='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				if ($rs1->RecordCount()>0){	
				$aTabla=array();
				$c = count($aTabla); 
						//trabajador	
						$_POST['oficio']=$aTabla[$c]['oficio']=$rs1->fields['id'];
						$_POST['nombres']=$aTabla[$c]['nombres']=$rs1->fields['nombres'];
						$_POST['apellidos']=$aTabla[$c]['apellidos']=$rs1->fields['apellidos'];			
				}	
			$_SESSION['aTabla'] = $aTabla;
//-------------------------------------------------------------------------------------------------------------JEFES DE AGENCIA		
/*
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
			$_SESSION['aTabla'] = $aTabla;	*/
		  
//------------------------------------------------------------------------------------------------------------------------------
/*$unidad=$_SESSION['sUnidadSustantiva'];		    
$jefes_agen=new Jefes_Agencia();
$rs1=$jefes_agen->jefes($unidad);

$sUnidadSustantiva = Context::Get('sUnidadSustantiva');

UnidadSustantiva::getDenominacion($sUnidadSustantiva, $conn);*/

/*$_POST['cedula_jefe']=$rs1->fields['cedula'];
print $_POST['cedula_jefe'].'cedulajefe';*/						
								
}
//------------------------------------------------------------------------------------------------------------------------------
function doReport($conn,$acceso1)
{
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$acceso1,$aDefaultForm){
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
  	<? /* $aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $c=0; $c<count($aTabla); $c++){ */ ?>
  <table width="82%" border="0" align="center" class="tablaborde_shadow">
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="right">FORMA: SIPRESOC 004</div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td width="11" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><strong>MINISTERIO DEL PODER POPULAR </strong></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td width="11" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><strong>PARA EL PROCESO SOCIAL DE TRABAJO</strong></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td width="11" >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="right"><b>Nro. de Oficio: <?=$_POST['oficio']?></b></div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td align="right"><b><?=$sfecha=date('d-m-Y');?></b></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td height="20" >&nbsp;</td>
      <td height="20" >&nbsp;</td>
      <td height="20" align="center"><strong>CONSTANCIA DE REGISTRO</strong></td>
      <td width="27" height="20" colspan="-5" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="justify" class="Estilo14">Por medio de la presente se hace constar que 
        el (la) ciudadano (a) <b><?=$_POST['nombres'].' '.$_POST['apellidos']?></b>, c&eacute;dula <b><?=$_SESSION['ced_afiliado']?></b>, ha sido registrado (a) en  el  Sistema de Informaci&oacute;n y  Registro  de Previsi&oacute;n Social con el c&oacute;digo Nro. <strong><?=$_POST['oficio']?></strong>, como  usuario (a)  demandante de los servicios  de informaci&oacute;n y  orientaci&oacute;n   en materia de previsi&oacute;n social.</div></td>
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
      <td class="links-menu-izq"><div align="center">
        <p>Nota: Constancia solo de uso interno que  no certifica la condici&oacute;n de desocupado (a) de la persona registrada en la base  de datos Sistema de Informaci&oacute;n y Registro   de Previsi&oacute;n Social.</p>
        <p>Todos los servicios ofrecidos son gratuitos, tanto para los  trabajadores y trabajadoras, como para las Entidades de Trabajo.</p></div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
	<? // } ?>
  <p>&nbsp;</p>
        <table width="200" border="0" align="center">
          <tr>
            <td>
                <div align="center"><a target="new" href="pdf_constancia_trabajador.php"><img src="../imagenes/print_32.png" border="0" /></a></div></td>
          </tr>
        </table>
      <p align="right"></p>
      </label>
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
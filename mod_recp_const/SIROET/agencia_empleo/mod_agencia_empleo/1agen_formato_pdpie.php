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
function LoadData($conn,$bPostBack){
		
		$_POST['fechahoy']=strftime("%e de %B de %Y");
		$_POST['oficio']=$_GET['id_po'];
	
		
				$SQL1="SELECT persona_pdpie.empresa, persona_pdpie.rif, 
				  motivo_retiro.nombre as motivo_retiro,
				  ocupacion.nombre as ocupacion1,
					personas.cedula,
				  personas.nombres,
					personas.apellidos
				from persona_pdpie 
				LEFT JOIN personas ON personas.id=persona_pdpie.persona_id 
				LEFT JOIN persona_pref_ocupacion ON persona_pref_ocupacion.persona_id=personas.id
			  LEFT JOIN ocupacion ON ocupacion.cod=persona_pref_ocupacion.ocupacion5_1
				LEFT JOIN motivo_retiro ON motivo_retiro.id=persona_pdpie.motivo_retiro_id			
				
				where persona_pdpie.id='".$_POST['oficio']."' and personas.id='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				if ($rs1->RecordCount()>0){	
				$aTabla=array();
				$c = count($aTabla); 
						//trabajador	
						$_POST['oficio']=$aTabla[$c]['oficio']=$_POST['oficio'];
						$_POST['cedula']=$aTabla[$c]['cedula']=$rs1->fields['cedula'];
						$_POST['nombres']=$aTabla[$c]['nombres']=$rs1->fields['nombres'];
						$_POST['apellidos']=$aTabla[$c]['apellidos']=$rs1->fields['apellidos'];		
						$_POST['ocupacion']=$aTabla[$c]['ocupacion']=$rs1->fields['ocupacion1'];
						$_POST['motivo_retiro']=$aTabla[$c]['motivo_retiro']=$rs1->fields['motivo_retiro'];
												
						//empresa
						$_POST['empresa']=$aTabla[$c]['empresa']=$rs1->fields['empresa'];
						$_POST['rif']=$aTabla[$c]['rif']=$rs1->fields['rif'];	
				}	
			$_SESSION['aTabla'] = $aTabla;
//-------------------------------------------------------------------------------------------------------------JEFES DE AGENCIA		  
/*	$SQL2="SELECT jefes_agencia.cedula, jefes_agencia.nombre, jefes_agencia.apellido,
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
 
		}	
//------------------------------------------------------------------------------------------------------------------------------
function doReport($conn)
{
}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
?>
</p>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
</script>
  <p align="center">&nbsp;</p>
  <table width="82%" border="0" align="center" class="tablaborde_shadow">
    <? /* $aTabla=$_SESSION['aTabla'];
	$aDefaultForm = $GLOBALS['aDefaultForm'];
	for( $c=0; $c<count($aTabla); $c++){*/ ?>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="right"><b>Nro. de Oficio: <?=$_POST['oficio']?></b></div></td>
      <td >&nbsp;</td>
    </tr>
    
    <tr>
      <td width="9" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><strong>Viceministerio de Previsi&oacute;n Social </strong></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td width="9" >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><strong>Divisi&oacute;n de Previsi&oacute;n Social </strong></td>
      <td >&nbsp;</td>
    </tr>    
    <tr>
      <td >&nbsp;</td>
      <td width="10" >&nbsp;</td>
      <td width="734" ></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="right" class="links-menu-izq"><b><?=$_POST['fechahoy']?></b></div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td height="16" >&nbsp;</td>
      <td height="16" >&nbsp;</td>
      <td height="16">Se&ntilde;ores</td>
      <td width="9" height="16" colspan="-5" >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >Instituto Venezolano de los Seguros Sociales (IVSS)</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td class="Estilo21" >Direcci&oacute;n General de Prestaci&oacute;n por P&eacute;rdida Involuntaria del Empleo </td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td class="Estilo21" >Presente.-</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td ><div align="center" class="Estilo21">CONSTANCIA DE INSCRIPCI&Oacute;N</div></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td align="justify">
          <p>Mediante la presente se hace constar que al ciudadano(a) <b><?=$_POST['nombres'].' '.$_POST['apellidos']?></b>  c&eacute;dula de identidad <b><?=$_POST['cedula']?></b>, de ocupaci&oacute;n <b><?=$_POST['ocupacion']?></b> se le otorg&oacute; la Constancia de Inscripci&oacute;n en la Divisi&oacute;n de Previsi&oacute;n Social, aceptando cumplir con las obligaciones de este Servicio de Atenci&oacute;n Integral por Perdida Involuntaria de Empleo en concordancia con los Art&iacute;culos 32 y 36 de la Ley del R&eacute;gimen Prestacional de Empleo.</p>
          <p>Una vez verificado que existe la cesaci&oacute;n de la relaci&oacute;n de trabajo, con la entidad de trabajo: <b><?=$_POST['empresa']?></b>, Nro. de Rif: <b><?=$_POST['rif']?></b>, por la causal: <b><?=$_POST['motivo_retiro']?></b>; el/la ciudadano/a queda registrado/a como usuario/a cesante, demandante de los servicios de asesor&iacute;a, informaci&oacute;n, orientaci&oacute;n laboral, formaci&oacute;n e inclusi&oacute;n sociolaborla y socioproductiva.</p>
          <p>Constancia que se expide a los efectos de dar cumplimiento a los derechos sociales contemplados en la normativa legal referida a la Seguridad Social.</p>
			
     </td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
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
      <td class="links-menu-izq"><div align="center">NOTA: Todos los servicios ofrecidos por las Divisiones de Previsi&oacute;n Social son absolutamente gratuitos.</div></td>
      <td>&nbsp;</td>
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
	<?  //} ?>
  </table>
  <p>&nbsp;</p>  
        <table width="200" border="0" align="center">
          <tr>
            <td>
                <div align="center"><a target="new" href="pdf_certificado_pdpie.php"><img src="../imagenes/print_32.png" border="0" /></a></div></td>
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

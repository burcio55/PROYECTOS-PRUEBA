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
		unset($_SESSION['pdpie']);
		
		$_POST['fechahoy']=strftime("%e de %B de %Y");
		$_POST['oficio']=$_GET['id_po'];
	
		
				$SQL1="SELECT personas.nombres,	personas.apellidos
				from persona_pdpie 
				INNER JOIN personas ON personas.id=persona_pdpie.persona_id 
				where persona_pdpie.id='".$_POST['oficio']."' and personas.id='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				if ($rs1->RecordCount()>0){	
				$aTabla=array();
				$c = count($aTabla); 
						//trabajador	
						$_POST['oficio']=$aTabla[$c]['oficio']=$_POST['oficio'];
						$_POST['nombres']=$aTabla[$c]['nombres']=$rs1->fields['nombres'];
						$_POST['apellidos']=$aTabla[$c]['apellidos']=$rs1->fields['apellidos'];			
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
    <input name="action" type="hidden" value=""/>
    <input name="oficio" type="hidden" value="<?=$_POST['oficio']?>" /> 
  <table width="82%" border="0" align="center" class="tablaborde_shadow">
    <tr>
      <td width="825"><div align="right"><b>Nro. de Oficio: <?=$_POST['oficio']?></b></div></td>
    </tr>
    
    <tr>
      <td><b>Viceministerio de Previsi&oacute;n Social </b></td>
    </tr>
    <tr>
      <td><b>Divisi&oacute;n de Previsi&oacute;n Social </b></td>
    </tr> 
    <tr>
      <td><b>Servicio de P&eacute;rdida Involuntaria de Empleo </b></td>
    </tr>   
    <tr>
      <td><div align="right" class="links-menu-izq"><b><?=$_POST['fechahoy']?></b></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center" class="Estilo21"><b>CONSTANCIA</b></div></td>
    </tr>
    <tr>
      <td height="16">&nbsp;</td>
    </tr>
    <tr>
      <td align="justify"><p>Yo, <b><?=$_POST['nombres'].' '.$_POST['apellidos']?></b>, c&eacute;dula <b><?=$_SESSION['ced_afiliado']?></b>, por medio de la presente hago contar que he recibido informaci&oacute;n y orientaci&oacute;n a trav&eacute;s del Servicio de P&eacute;rdida Involuntaria de Empleo y he decidido de manera voluntaria iniciar los tr&aacute;mites administrativos para el cobro de la prestaci&oacute;n dineraria por p&eacute;rdida involuntaria del empleo, ante las oficinas administrativas del IVSS, no aceptando las acciones para el reenganche por inamovilidad o estabilidad laboral, de acuerdo a lo establecido en la Ley Org&aacute;nica del Trabajo Los Trabajadores y Trabajadoras.</p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Firma  del Usuario/a: _______________________</td>
    </tr>
     <tr>
      <td>C&eacute;dula: ________________________________</td>
    </tr>
    <tr>
      <td>Fecha: _________________________________</td>
    </tr>
    <tr>
      <td></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="links-menu-izq"><div align="center">NOTA: Todos los servicios ofrecidos por las Divisiones de Previsi&oacute;n Social son absolutamente gratuitos.</div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>  
        <table width="200" border="0" align="center">
          <tr>
            <td>
                <div align="center"><a target="new" href="pdf_noreferido_pdpie.php?id_po=<?=$_POST['oficio']?>"><img src="../imagenes/print_32.png" border="0" /></a></div></td>
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

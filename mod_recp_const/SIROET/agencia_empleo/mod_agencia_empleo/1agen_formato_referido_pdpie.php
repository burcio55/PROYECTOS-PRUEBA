<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
//include('../include/security_chain.php');
$conn = getConnDB('sire');
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = FALSE;
doAction($conn);
debug($settings['debug']=FALSE);
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
		
	
		
				$SQL1="SELECT persona_pdpie.*, motivo_referido_ppie.nombre as motivo, sector_empleo.nombre as sector,
				  ocupacion.nombre as ocupacion1,
				  personas.nombres,
					personas.cedula,
					personas.apellidos, 
				  personas.nacionalidad, 
					personas.f_nacimiento,
					personas.direccion,
					personas.telefono,
					personas.correo,
					estado.nombre as estado 
				from persona_pdpie 
				LEFT JOIN personas ON personas.id=persona_pdpie.persona_id 
				LEFT JOIN persona_pref_ocupacion ON persona_pref_ocupacion.persona_id=personas.id
			  LEFT JOIN ocupacion ON ocupacion.cod=persona_pref_ocupacion.ocupacion5_1
				LEFT JOIN motivo_referido_ppie ON motivo_referido_ppie.id=persona_pdpie.motivo_referido_ppie_id
				LEFT JOIN sector_empleo ON sector_empleo.id=persona_pdpie.sector_empleo_id
				LEFT JOIN estado ON estado.id=personas.estado_nacimiento_id 
				where persona_pdpie.id='".$_POST['oficio']."' and personas.id='".$_SESSION['id_afiliado']."' and personas.cedula='".$_SESSION['ced_afiliado']."'";
				$rs1 = $conn->Execute($SQL1);
				if ($rs1->RecordCount()>0){	
				$aTabla=array();
				$c = count($aTabla); 
						//trabajador	
						if($rs1->fields['nacionalidad']==1)$aTabla[$c]['nacionalidad']=$_POST['nacionalidad']='Venezolana';
						if($rs1->fields['nacionalidad']==2)$aTabla[$c]['nacionalidad']=$_POST['nacionalidad']='Extranjera';
						$_POST['f_nacimiento']=$aTabla[$c]['f_nacimiento']=strftime("%d-%m-%Y", strtotime($rs1->fields['f_nacimiento']));
						$_POST['cedula']=$aTabla[$c]['cedula']=$rs1->fields['cedula'];
						$_POST['nombres']=$aTabla[$c]['nombres']=$rs1->fields['nombres'];
						$_POST['apellidos']=$aTabla[$c]['apellidos']=$rs1->fields['apellidos'];
						$_POST['estado']=$aTabla[$c]['estado']=$rs1->fields['estado'];					
						$_POST['cargo']=$aTabla[$c]['cargo']=$rs1->fields['cargo'];
						$_POST['salario']=$aTabla[$c]['salario']=$rs1->fields['salario'];
						$_POST['direccion']=$aTabla[$c]['direccion']=$rs1->fields['direccion'];
						$_POST['telefono']=$aTabla[$c]['telefono']=$rs1->fields['telefono'];
						$_POST['correo']=$aTabla[$c]['correo']=$rs1->fields['correo'];	
						$_POST['motivo']=$aTabla[$c]['motivo']=$rs1->fields['motivo'];
						$_POST['ocupacion']=$aTabla[$c]['ocupacion']=$rs1->fields['ocupacion1'];
						$aTabla[$c]['oficio']=$_POST['oficio'];
						
						//empresa
						$_POST['empresa']=$aTabla[$c]['empresa']=$rs1->fields['empresa'];
						$_POST['rif']=$aTabla[$c]['rif']=$rs1->fields['rif'];	
						$_POST['snil']=$aTabla[$c]['snil']=$rs1->fields['snil'];	
						$_POST['sector']=$aTabla[$c]['sector']=$rs1->fields['sector'];
						$_POST['ntelefono_local']=$aTabla[$c]['ntelefono_local']=$rs1->fields['ntelefono_local'];	
						$_POST['sdireccion_fiscal']=$aTabla[$c]['sdireccion_fiscal']=$rs1->fields['sdireccion_fiscal'];	
						$_POST['semail']=$aTabla[$c]['semail']=$rs1->fields['semail'];
				}

		
			$SQL4="select  nivel_instruccion.nombre as nivel
						from persona_nivel_instruccion
						INNER JOIN personas ON personas.id=persona_nivel_instruccion.persona_id 
						INNER JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id 
					    where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' 
						order by nivel_instruccion.id desc limit 1";
					$rs4 = $conn->Execute($SQL4);
					if ($rs4->RecordCount()>0){	
							$_POST['nivel']=$aTabla[$c]['nivel']=$rs4->fields['nivel'];
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
      <td width="49" >&nbsp;</td>
      <td colspan="2" ><div align="right"><b>Nro. de Oficio: <?=$_POST['oficio']?></b></div></td>
    </tr>
    
    <tr>
      <td width="13" >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="2" ><b>Viceministerio de Previsi&oacute;n Social </b></td>
    </tr>
    <tr>
      <td width="13" >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="2" ><b>Divisi&oacute;n de Previsi&oacute;n Social </b></td>
    </tr> 
    <tr>
      <td width="13" >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="2" ><b>Servicio de P&eacute;rdida Involuntaria de Empleo </b></td>
    </tr>   
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="2" ><div align="right" class="links-menu-izq"><b><?=$_POST['fechahoy']?></b></div></td>
    </tr>
    <tr>
      <td colspan="4" >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="2" ><div align="center" class="Estilo21"><b>REFERENCIA</b></div></td>
    </tr>
    <tr>
      <td height="16" >&nbsp;</td>
      <td height="16" >&nbsp;</td>
      <td height="16" colspan="2">Para:</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="2" >De:</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td colspan="2" ><div align="center" class="Estilo21"><b>DATOS DE IDENTIFICACI&Oacute;N DEL USUARIO</b></div></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td width="313" >&nbsp;</td>
      <td width="546" >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >NOMBRES Y APELLIDOS: </td>
      <td ><?=$_POST['nombres'].' '.$_POST['apellidos']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >C&Eacute;DULA: </td>
      <td ><?=$_POST['cedula']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >NACIONALIDAD: </td>
      <td ><?=$_POST['nacionalidad']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >LUGAR Y FECHA DE NACIMIENTO: </td>
      <td ><?=$_POST['estado'].' '.$_POST['f_nacimiento']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >NIVEL EDUCATIVO: </td>
      <td ><?=$_POST['nivel']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >OCUPACI&Oacute;N: </td>
      <td ><?=$_POST['ocupacion']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >CARGO QUE DESEMPE&Ntilde;ABA: </td>
      <td ><?=$_POST['cargo']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >SALARIO MENSUAL: </td>
      <td ><?=$_POST['salario']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >DIRECCI&Oacute;N DE HABITACI&Oacute;N: </td>
      <td ><?=$_POST['direccion']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >TEL&Eacute;FONOS: </td>
      <td ><?=$_POST['telefono']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >CORREO: </td>
      <td ><?=$_POST['correo']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >MOTIVO DE REFERENCIA: </td>
      <td ><?=$_POST['motivo']?></td>
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
      <td colspan="2" ><div align="center" class="Estilo21"><b>DATOS DE IDENTIFICACI&Oacute;N DE LA ENTIDAD DE TRABAJO</b></div></td>
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
      <td >ENTIDAD DE TRABAJO: </td>
      <td ><?=$_POST['empresa']?></td>
    </tr>
        <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >RIF: </td>
      <td ><?=$_POST['rif']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >NIL: </td>
      <td ><?=$_POST['snil']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >SECTOR EMPLEADOR: </td>
      <td ><?=$_POST['sector']?></td>
    </tr>
     <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >DIRECCI&Oacute;N:</td>
      <td ><?=$_POST['sdireccion_fiscal']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >TEL&Eacute;FONOS: </td>
      <td ><?=$_POST['ntelefono_local']?></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >CORREO: </td>
      <td ><?=$_POST['semail']?></td>
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
      <td colspan="4"><div align="center" class="Estilo18"><span class="Estilo19">
          <?=$aTabla[$c]['nombre']?>
          </span><span class="Estilo19">
          <?=$aTabla[$c]['apellido']?>
      </span></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><i>Firma y Sello del Funcionario/a </i></div></td>
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
      <td colspan="2" class="links-menu-izq"><div align="center">NOTA: Todos los servicios ofrecidos por las Divisiones de Previsi&oacute;n Social son absolutamente gratuitos.</div></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>  
        <table width="200" border="0" align="center">
          <tr>
            <td>
                <div align="center"><a target="new" href="pdf_referido_pdpie.php"><img src="../imagenes/print_32.png" border="0" /></a></div></td>
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

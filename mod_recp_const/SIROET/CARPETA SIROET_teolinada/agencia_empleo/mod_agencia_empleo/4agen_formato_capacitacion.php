<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');
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
function debug(){
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
function doAction($conn){
    LoadData($conn,true);
   }

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn)
{
	
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
              if ($_GET['id_po']!='') $_SESSION['id_oferta']=$_GET['id_po'];
			  if ($_GET['id_emp']!='') $_SESSION['id_empresa']=$_GET['id_emp'];
			  
			  $SQL="select oferta_capacitacion.*, oferta_capacitacion.id as id_oferta_cap,
					curso.nombre as curso,
					ocupacion.nombre as ocupe,
					colectivos.nombre as tcolectivo,
					turno_jornada.nombre as jornada
					From oferta_capacitacion
					left JOIN curso ON curso.id=oferta_capacitacion.curso_id
					left JOIN ocupacion ON ocupacion.cod=oferta_capacitacion.ocupacion2
					left JOIN colectivos ON colectivos.id=oferta_capacitacion.colectivos_id 
					left JOIN turno_jornada ON turno_jornada.id=oferta_capacitacion.turno_jornada_id
					where oferta_capacitacion.id = '".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 
				    $_POST['curso']=$rs1->fields['curso'];
					$_POST['ocupe']=$rs1->fields['ocupe'];
					$_POST['tcolectivo']=$rs1->fields['tcolectivo'];
					$_POST['jornada']=$rs1->fields['jornada']; 
					$_POST['obj_general']=$rs1->fields['obj_general'];
					$certificado=$rs1->fields['certificado'];
					if($certificado==0) $_POST['certificado']='No';
					if($certificado==1) $_POST['certificado']='Si';
					$_POST['duracion']=$rs1->fields['duracion'];
					$_POST['costo']=$rs1->fields['costo'];
					$_POST['cupos']=$rs1->fields['cupos'];
					$_POST['f_inicio']=$rs1->fields['f_inicio'];
					$_POST['f_culminacion']=$rs1->fields['f_culminacion'];
					$_POST['horario_desde']=$rs1->fields['horario_desde'];
					$_POST['horario_hasta']=$rs1->fields['horario_hasta'];	 			
					$_POST['direccion']=$rs1->fields['direccion'];
					$colectivo=$rs1->fields['colectivo'];
					if($colectivo==0) $_POST['colectivo']='No';
					if($colectivo==1) $_POST['colectivo']='Si';
					$_POST['contenido']=$rs1->fields['contenido'];
					$_POST['conocimientos_pre']=$rs1->fields['conocimientos_pre'];
					$_POST['observaciones']=$rs1->fields['observaciones'];
					$_POST['telefono']=$rs1->fields['telefono'];
					$orientacion=$rs1->fields['orientacion'];
					if($orientacion==0) $_POST['orientacion']='No';
					if($orientacion==1) $_POST['orientacion']='Si';
					$pasantias=$rs1->fields['pasantias'];
					if($pasantias==0) $_POST['pasantias']='No';
					if($pasantias==1) $_POST['pasantias']='Si';
					$colocacion=$rs1->fields['colocacion'];
					if($colocacion==0) $_POST['colocacion']='No';
					if($colocacion==1) $_POST['colocacion']='Si';
					} 
						  
			  $SQL2= "select empresa_instituto.nombre,rif,direccion, sector, telefono as tele_empresa, correo, 
			          estado.nombre as estado, municipio.nombre as municipio, 
					  parroquia.nombre as parroquia 
					  from empresa_instituto
					  INNER JOIN estado ON estado.id=empresa_instituto.estado_id
					  INNER JOIN municipio ON municipio.id=empresa_instituto.municipio_id
					  INNER JOIN parroquia ON parroquia.id=empresa_instituto.parroquia_id
					  where empresa_instituto.id='".$_SESSION['id_empresa']."'"; 
					  $rs2 = $conn->Execute($SQL2);
					  if ($rs2->RecordCount()>0){ 
					  $_POST['nombre']=$rs2->fields['nombre'];
					  $_POST['rif']=$rs2->fields['rif'];
					  $_POST['direccion']=$rs2->fields['direccion'];
					  $_POST['sector']=$rs2->fields['sector'];
					  $_POST['tele_empresa']=$rs2->fields['tele_empresa'];
					  $_POST['correo']=$rs2->fields['correo'];
					  $_POST['estado']=$rs2->fields['estado'];
					  $_POST['municipio']=$rs2->fields['municipio'];
					  $_POST['parroquia']=$rs2->fields['parroquia'];
 			         }
		}	
		

//------------------------------------------------------------------------------------------------------------------------------
function doReport($conn)
{
}
//------------------------------------------------------------------------------------------------------------------------------
 
 function showHeader(){
 include('../header.php'); 
 include('menu_oferta_cap.php');
}
//------------------------------------------------------------------------------------------------------------------------------ 
function showForm($conn,&$aDefaultForm){
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
      <td colspan="2" class="tablaborde_shadow"><h3 align="center" class="labelListGlobal">
        <?=$_POST['nombre']?>
      </h3></td>
    </tr>
    <tr>
      <td colspan="2" class="tablaborde_shadow"><p align="center" class="links-menu-izq">Rif:
        <?=$_POST['rif']?>
       </p>
        <p align="center" class="links-menu-izq">Actividad Econ&oacute;mica: <?=$_POST['act']?> </p>
        <p align="center" class="links-menu-izq">
          <?=$_POST['direccion']?> - <?=$_POST['sector']?><br/>
        
        Estado: <?=$_POST['estado']?>- Municipio: <?=$_POST['municipio']?> - Parroquia: <?=$_POST['parroquia']?>
		<br/>
        Tel&eacute;fono: <?=$_POST['tele_empresa']?>  - Correo: <?=$_POST['correo']?>
        </p></td>
    </tr>    
    <tr>
      <td colspan="2"><div align="right" class="labelListGlobal"> Oportunidad de capacitaci&oacute;n Nro.  
        <?=$_SESSION['id_oferta']?>
      </div></td>
    </tr>
    <tr>
      <td width="45%" class="dataListColumn" ><div align="right">Nombre de la actividad:<br />
      </div></td>
      <td width="43%" class="links-menu-izq"><?=$_POST['curso']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Objetivo General: </div></td>
      <td class="links-menu-izq"><?=$_POST['obj_general']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Certificado otorgado:</div></td>
      <td class="links-menu-izq"><?=$_POST['certificado']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Area de capacitaci&oacute;n:</div></td>
      <td class="links-menu-izq"><?=$_POST['ocupe']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Costo:</div></td>
      <td class="links-menu-izq"><?=$_POST['costo']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Nro. de Cupos: </div></td>
      <td class="links-menu-izq"><?=$_POST['cupos']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Duraci&oacute;n:</div></td>
      <td class="links-menu-izq"><?=$_POST['duracion']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Fecha de inicio:</div></td>
      <td class="links-menu-izq"><?=strftime("%d-%m-%Y", strtotime($_POST['f_inicio']))?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Fecha de finalizaci&oacute;n: </div></td>
      <td class="links-menu-izq"><?=strftime("%d-%m-%Y", strtotime($_POST['f_culminacion']))?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Turno:</div></td>
      <td class="links-menu-izq"><?=$_POST['jornada']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Horario:</div></td>
      <td class="links-menu-izq">
        <?=$_POST['horario_desde']?> - <?=$_POST['horario_hasta']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Contenido de la actividad: </div></td>
      <td class="links-menu-izq"><?=$_POST['contenido']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Conocimientos previos: </div></td>
      <td class="links-menu-izq"><?=$_POST['conocimientos_pre']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Observaciones:</div></td>
      <td class="links-menu-izq"><?=$_POST['observaciones']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Orientado a colectivos:</div></td>
      <td class="links-menu-izq"><?=$_POST['colectivo']?> - <?=$_POST['tcolectivo']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Direcci&oacute;n donde se impartir&aacute; el curso: </div></td>
      <td class="links-menu-izq"><?=$_POST['direccion']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">Tel&eacute;fono:</div></td>
      <td class="links-menu-izq"><?=$_POST['telefono']?></td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right">La Actividad de capacitaci&oacute;n incluye servicios de:</div></td>
      <td class="links-menu-izq">Orientación: 
        <?=$_POST['orientacion']?>
-      Pasant&iacute;as:
      <?=$_POST['pasantias']?> - 
      Colocaci&oacute;n:
      <?=$_POST['colocacion']?>
      </td>
    </tr>
  </table>
  <table width="100%" border="0" align="center">
    <tr>
      <td width="1003">&nbsp;</td>
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
$aPageErrors = $GLOBALS['aPageErrors'];
print (isset($aPageErrors) && count($aPageErrors) > 0)? "<script>alert('".join('\n',$aPageErrors)."')</script>":""; 
?> 
</body>
</html>
<?php
}
?>
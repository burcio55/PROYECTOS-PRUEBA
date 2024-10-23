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
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
			case 'Culminar':  
			header('location: 3_0agen_registro_oferta.php'); 
			break;
		}
		}	
		else{
			LoadData($conn,false);
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn)
{
	
}
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
              if ($_GET['id_po']!='') $_SESSION['id_oferta']=$_GET['id_po'];
			  if ($_GET['id_emp']!='') $_SESSION['id_empresa']=$_GET['id_emp'];
			  
			  $SQL="select oferta_empleo.*, ocupacion.nombre as ocupe, tipo_salario.nombre as tsalario, 
					tipo_contrato.nombre as tcontrato, estado_civil.nombre as estado_civil, 
					tipo_vehiculo.nombre as vehiculo, nivel_instruccion.nombre as nivel, 
					area_mencion.nombre as area, idioma.nombre as idioma, computacion.nombre as computacion, 
					colectivos.nombre as tcolectivo, turno_jornada.nombre as jornada
					From oferta_empleo 
					INNER JOIN ocupacion ON ocupacion.cod=oferta_empleo.ocupacion5 
					INNER JOIN tipo_salario ON tipo_salario.id=oferta_empleo.tipo_salario_id 
					left JOIN tipo_contrato ON tipo_contrato.id=oferta_empleo.tipo_contratacion_id 
					left JOIN estado_civil ON estado_civil.id=oferta_empleo.estado_civil_id 
					left JOIN tipo_vehiculo ON tipo_vehiculo.id=oferta_empleo.tipo_vehiculo_id 
					left JOIN nivel_instruccion ON nivel_instruccion.id=oferta_empleo.nivel_instruccion_id 
					left JOIN area_mencion ON area_mencion.cod=oferta_empleo.carrera3 
					left JOIN idioma ON idioma.id=oferta_empleo.idioma_id 
					left JOIN computacion ON computacion.id=oferta_empleo.computacion_id 
					left JOIN colectivos ON colectivos.id=oferta_empleo.colectivo_id 
					left JOIN turno_jornada ON turno_jornada.id=oferta_empleo.turno_jornada_id 
					where oferta_empleo.id ='".$_SESSION['id_oferta']."' and empresa_id='".$_SESSION['id_empresa']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 
				 	$_POST['plazas']=$rs1->fields['plazas'];
					$_POST['plazas_disponibles']=$rs1->fields['plazas_disponibles'];
					$_POST['salario']=$rs1->fields['salario'];
					$_POST['duracion']=$rs1->fields['duracion'];
					$_POST['funciones']=$rs1->fields['funciones'];
					$nacionalidad=$rs1->fields['nacionalidad'];
					if($nacionalidad==-1) $_POST['nacionalidad']='Indiferente';
					if($nacionalidad==1) $_POST['nacionalidad']='Venezolana';
					if($nacionalidad==2) $_POST['nacionalidad']='Extranjera';
					$sexo=$rs1->fields['sexo'];
					if($sexo==-1) $_POST['sexo']='Indiferente';
					if($sexo==1) $_POST['sexo']='Femenino';
					if($sexo==2) $_POST['sexo']='Masculino';
					$_POST['edad_min']=$rs1->fields['edad_min'];
					$_POST['edad_max']=$rs1->fields['edad_max'];
					$graduado=$rs1->fields['graduado'];
					if($graduado==-1) $_POST['graduado']='Indiferente';
					if($graduado==0) $_POST['graduado']='No';	
					if($graduado==1) $_POST['graduado']='Si';
					$_POST['experiencia']=$rs1->fields['experiencia'];
					$_POST['fecha_max']=$rs1->fields['fecha_max'];
					$_POST['direccion']=$rs1->fields['direccion'];
					$_POST['telefono']=$rs1->fields['telefono'];
					$_POST['documentos']=$rs1->fields['documentos'];
					$_POST['observaciones']=$rs1->fields['observaciones'];
					$colectivo=$rs1->fields['colectivo'];
					if($colectivo==-1) $_POST['colectivo']='Indiferente';
					if($colectivo==0) $_POST['colectivo']='No';	
					if($colectivo==1) $_POST['colectivo']='Si';	
					$_POST['fecha_creacion']=$rs1->fields['created_at'];	 			
					$_POST['ocupe']=$rs1->fields['ocupe'];
					$_POST['act']=$rs1->fields['act'];
					$_POST['tsalario']=$rs1->fields['tsalario'];
					$_POST['tcontrato']=$rs1->fields['tcontrato'];
					$_POST['estado_civil']=$rs1->fields['estado_civil'];									
					$_POST['vehiculo']=$rs1->fields['vehiculo'];
					$_POST['nivel']=$rs1->fields['nivel'];
					$area=$rs1->fields['area'];
					if($area=='No aplica') $_POST['area']='Indiferente';
					$_POST['idioma']=$rs1->fields['idioma'];
					$_POST['computacion']=$rs1->fields['computacion'];
					$_POST['tcolectivo']=$rs1->fields['tcolectivo'];
					$_POST['jornada']=$rs1->fields['jornada'];
					} 
						  
			  $SQL2= "select empresa_instituto.nombre,rif,direccion, sector, telefono, correo, estado.nombre as estado, 
						municipio.nombre as municipio, parroquia.nombre as parroquia,actividad_eco.nombre as act
						from empresa_instituto
						INNER JOIN actividad_eco ON actividad_eco.cod=empresa_instituto.act_economica4  
						INNER JOIN estado ON estado.id=empresa_instituto.estado_id 
						INNER JOIN municipio ON municipio.id=empresa_instituto.municipio_id 
						INNER JOIN parroquia ON parroquia.id=empresa_instituto.parroquia_id 
						where empresa_instituto.id='".$_SESSION['id_empresa']."'"; 
					  $rs2 = $conn->Execute($SQL2);
					  if ($rs2->RecordCount()>0){ 
					  
					  $_POST['nombre_empresa']=$rs2->fields['nombre'];
					  $_POST['rif']=$rs2->fields['rif'];
					  $_POST['act']=$rs2->fields['act'];
					  $_POST['direccion']=$rs2->fields['direccion'];
					  $_POST['sector']=$rs2->fields['sector'];
					  $_POST['telefono']=$rs2->fields['telefono'];
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
 include('menu_oferta_empleo.php');
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
      <td colspan="2" class="tablaborde_shadow"><h3 align="center" class="labelListGlobal"><b>
        <?=$_POST['nombre_empresa']?>
      </b></h3></td>
    </tr>
    <tr>
      <td colspan="2" class="tablaborde_shadow"><p align="center" class="links-menu-izq"><b>Rif:
        <?=$_POST['rif']?>
      </b> </p>
        <p align="center" class="links-menu-izq">Actividad Económica: <?=$_POST['act']?> </p>
        <p align="center" class="links-menu-izq"><b>
          <?=$_POST['direccion']?></b> - <b><?=$_POST['sector']?></b><br/>
        <b>
        Estado: <?=$_POST['estado']?></b>- Municipio: <b><?=$_POST['municipio']?></b> - Parroquia: <b><?=$_POST['parroquia']?>
		</b><br/>
        <b>Teléfono: <?=$_POST['telefono']?> </b> - Correo: <b><?=$_POST['correo']?>
        </b></p></td>
    </tr>
    <tr>
      <td colspan="2"><div align="right" class="labelListGlobal"> Oportunidad de empleo Nro. </b> 
        <?=$_SESSION['id_oferta']?>
      </b></div></td>
    </tr>
    <tr>
      <td width="45%" class="dataListColumn" ><div align="right"> Oficio:  </div></td>
      <td width="43%" class="links-menu-izq"> <?=$_POST['ocupe']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Vacantes: </div></td>
      <td class="links-menu-izq"> <?=$_POST['plazas']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Vacantes disponibles:  </div></td>
      <td class="links-menu-izq"> <?=$_POST['plazas_disponibles']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Salario: </div></td>
      <td class="links-menu-izq"> <?=$_POST['salario']?> - <?=$_POST['tsalario']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Tipo de contrataci&oacute;n:  </div></td>
      <td class="links-menu-izq"> <?=$_POST['tcontrato']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Tipo de Jornada:  </div></td>
      <td class="links-menu-izq"> <?=$_POST['jornada']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Nacionalidad: </div></td>
      <td class="links-menu-izq"> <?=$_POST['nacionalidad']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Estado civil:  </div></td>
      <td class="links-menu-izq"> <?=$_POST['estado_civil']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"><div align="right"> Sexo:  </div></td>
      <td class="links-menu-izq"> <?=$_POST['sexo']?> </td>
    </tr>
    
    <tr>
      <td class="dataListColumn"  ><div align="right"> Edad comprendida entre:  </div></td>
      <td class="links-menu-izq"  > <?=$_POST['edad_min']?> - <?=$_POST['edad_max']?> años  </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Tipo de Vehiculo: </div></td>
      <td class="links-menu-izq"  > <?=$_POST['vehiculo']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Graduado: </div></td>
      <td class="links-menu-izq"  > <?=$_POST['graduado']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Nivel de instrucci&oacute;n:  </div></td>
      <td class="links-menu-izq"  > <?=$_POST['nivel']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Dominio de idioma extranjero:  </div></td>
      <td class="links-menu-izq"  > <?=$_POST['idioma']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Dominio de computaci&oacute;n:  </div></td>
      <td class="links-menu-izq"  > 
        <?=$_POST['computacion']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Experiencia m&iacute;nima: </div></td>
      <td class="links-menu-izq"  > <?=$_POST['experiencia']?> años  </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Direcci&oacute;n y tel&eacute;fono para la entrevista: </div></td>
      <td class="links-menu-izq"  > <?=$_POST['direccion']?> - <?=$_POST['telefono']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Documentos necesarios para la entrevista: </div></td>
      <td class="links-menu-izq"  > <?=$_POST['documentos']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Observaciones: </div></td>
      <td class="links-menu-izq"  > <?=$_POST['observaciones']?> </td>
    </tr>
    <tr>
      <td class="dataListColumn"  ><div align="right"> Oferta valida desde:  </div></td>
      <td class="links-menu-izq"  > <?=strftime("%d-%m-%Y", strtotime($_POST['fecha_creacion']))?> - hasta  
        <?=strftime("%d-%m-%Y", strtotime($_POST['fecha_max']))?>
        </td>
    </tr>
    <tr>
      <td colspan="2" align="center"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"></td>
    </tr>
  </table>
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
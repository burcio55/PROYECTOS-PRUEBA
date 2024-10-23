<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('Trazas.class.php');
$conn = getConnDB('sire');
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$conn->debug = FALSE;
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
		var_dump($_SESSION['sesiones']);
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
		
		 
			case 'upload': 
			$bValidateSuccess=true;			
						
			if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			LoadData($conn,true);	
			break;
			
			case 'Continuar': 
			$bValidateSuccess=true;	
			?><script>document.location='1_14agen_trab_formatos.php'</script><?
			if ($bValidateSuccess){				
				ProcessForm($conn);
				}
			
			LoadData($conn,true);	
			break;
	        }
		}		
		else{
		LoadData($conn,false);
		}
}
//------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
        $aDefaultForm = &$GLOBALS['aDefaultForm'];
				$aDefaultForm['foto']='';
				$SQL9= "select *  from imagen 
						where persona_id ='".$_SESSION['id_afiliado']."'"; 
						$rs9 = $conn->Execute($SQL9);
						$_POST['foto']=$rs9->fields['imagen'];
						
						if ($rs9->RecordCount()>0){
						$_POST['imagen']='<img src="imagenes/'.$_POST['foto'].'" width="100" height="116" border="0"/>';
						
						}
						else{	
						$_POST['imagen']='FOTO';				
						
						}
  
	   } 
}
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){

$max=9500000; 
$filename='';
$ced_afiliado=$_SESSION['ced_afiliado'];
$filesize = $_FILES['archivo']['size'];
$type = strtolower($_FILES['archivo']['type']);
$filename = trim($_FILES['archivo']['name']);// (trim elimina los posibles espacios al final y al principio del nombre del archivo)
$filename = substr($filename, -10); //(con substr le decimos que coja los últimos 10 caracteres por si el nombre fuera muy largo)
$filename = ereg_replace(" ", "", $filename); //(con esta función eliminamos posibles espacios entre los caracteres del nombre)
$filename = $ced_afiliado.$filename;
//Ahora creamos las condiciones que debe cumplir el archivo antes de ser almacenado en el servidor. Restringimos a .jpg ó .gif (tanto en mayusculas como en minúsculas) y finalmente cambiamos el archivo de la carpeta temporal a la final elegida.

$status = "";
		if ($_POST["action"] == "upload") {		
		if ($filename != "") {
			if((int)$filesize < (int)$max){
			   if($filesize!=''){
				if (preg_match('/(jpg|gif|jpeg|zip)/', $type)){			   
				   	
					$destino =  'imagenes/'.$filename;
					if (copy($_FILES['archivo']['tmp_name'],$destino)) {					    			
						$sfecha=date('Y-m-d');
						$SQL = "SELECT id FROM imagen where persona_id= ".$_SESSION['id_afiliado'];
						$rs = $conn->Execute($SQL);
						$imagen_id=$rs->fields['id'];
						
						if ($imagen_id!=''){							
						$sql = "update imagen set 
								 persona_id='".$_SESSION['id_afiliado']."',
								 imagen='".$filename."',
								 status='A',
								 updated_at='".$sfecha."',
								 id_update='".$_SESSION['sUsuario']."'
								 where id='".$imagen_id."' and persona_id=".$_SESSION['id_afiliado'];
						$rs = $conn->Execute($sql);
						}
						else{	
						$sql="insert into public.imagen
						     (persona_id, imagen, status, created_at, id_update) 
					          values 			
							 ('".$_SESSION['id_afiliado']."',
							  '".$filename."',
							  'A',
							  '".$sfecha."',
							  '".$_SESSION['sUsuario']."')";
				          $conn->Execute($sql);
						  }
						//Trazas-------------------------------------------------------------------------------------------------------------------------------				
					$id=$_SESSION['id_afiliado'];
					$identi=$_SESSION['ced_afiliado'];
					$us=$_SESSION['sUsuario'];
					$mod='12';			    
					$auditoria= new Trazas; 
					$auditoria->auditor($id,$identi,$sql,$us,$mod);
//--------------------------------------------------------------------------------------------------------------------------------------
						
						//sesiones curriculum
						$nNumSeccion = 7;
						$sSQL = "SELECT sesiones FROM personas where id = ".$_SESSION['id_afiliado'];
						$rs = $conn->Execute($sSQL);
						
						if ($rs){
						if ($rs->RecordCount() > 0){
						$rs->fields['sesiones'][$nNumSeccion-1] = 1;
						$sSQL = "update personas set sesiones = '".$rs->fields['sesiones']."' where id = ".$_SESSION['id_afiliado'];
						$rs = $conn->Execute($sSQL);			
							}
						}
						
						$GLOBALS['aPageErrors'][]="- El Archivo subio correctamente";
						$bValidateSuccess=false;
						
					 }
					 else {
						  $GLOBALS['aPageErrors'][]="- Error de al subir el archivo";
						  $bValidateSuccess=false;
				     }
					}
				else {
						$GLOBALS['aPageErrors'][]="- Sólo se permiten imágenes en formato .jpg y .gif, no se ha podido adjuntar";
						$bValidateSuccess=false;
			     }
			    }
			   }
		else {
		$GLOBALS['aPageErrors'][]="- La imagen que ha intentado adjuntar es mayor de 1.5 Mb";
		$bValidateSuccess=false;
        }	
	   }
	   else {
			$GLOBALS['aPageErrors'][]="- Debe seleccionar alguna imagen";
		    $bValidateSuccess=false;
	 	 }
	}

	}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('../header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    <script>
function send(saction){
	var form = document.form;
	form.action.value=saction;
	form.submit();
}
          </script>
    <input name="action" type="hidden" value=""/>

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        
        <tr>
          <th class="titulo">Foto del (de la) Trabajador(a) </th>
        </tr>
        <tr>
          <th class="sub_titulo">Agregar imagen: </th>
        </tr>
        <tr>
          <td align="center"><?=$_POST['imagen'];?></td>
        </tr>
        <tr>
          <td><div align="center">
              <input name="archivo" type="file" class="link-info" size="35" />
              <button type="button" name="upload"  id="upload" class="button"  onClick="javascript:send('upload');">Subir Imagen</button>
          </div></td>
        </tr>
        <tr>
          <td align="center" class="link-clave-ruee Estilo12">Las imagenes que desee adjuntar deben ser menor a 1.5 MB y deben tener un formato .jpg .gif </td>
        </tr>
        <tr>
          <td align="center" class="link-clave-ruee Estilo12">de lo contrario deberá cambiar el formato de la imagen para poder subirla. </td>
        </tr>
        
        <tr>
          <td class="link-clave-ruee"><div align="right"></div> <div align="right"></div></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center"><span class="requerido">
              <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
              
          </span></div></td>
        </tr>
      </table>
</form> 
<?php
}
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

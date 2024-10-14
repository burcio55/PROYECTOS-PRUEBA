<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('../include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
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
		
		 
			case 'Agregar': 
			$bValidateSuccess=true;			
							 

													  				
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
  } 
				$formatos='';
				$_POST['formatos']='';
				
		    $SQL="select 
					personas.sesiones From public.personas  
				  where cedula='".$_SESSION['ced_afiliado']."'";
				 $rs1 = $conn->Execute($SQL);
				 if ($rs1->RecordCount()>0){ 
				 $formatos=$rs1->fields['sesiones'];								
				 }
			   if ($formatos=='1111111' or $formatos=='1111110'){
					   $_POST['formatos']='1';
				 }
				else{
            ?><script>alert('No ha completado toda informacion, por lo tanto no podra imprimir los formatos')</script><? 
						} 
			
}
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){


	}
//------------------------------------------------------------------------------------------------------------------------------
function showHeader(){
 include('header.php'); 
 echo '<br>';
include('menu_trabajador.php'); }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,&$aDefaultForm){
?>
<form name="form" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
<input name="action" type="hidden" value=""/>
<script>
function send(saction){
var form = document.form;
form.action.value=saction;
form.submit();
}
</script>

<!-- Diseño Nuevo Bootstrap 4 -->

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<section class="content">
			<div class="container-fluid">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title"> Formatos </h3>
					</div>
					<form class="form-horizontal">
						<div class="card-body">
							<div class="form-group row" >
									<div class="col-sm-6">
										<div class="card border-primary mb-3" style="height: 400px; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
											<img class="card-img-top" src="../imagenes/curriculum.png" style="height: 280px;">
											<div class="card-body">
												<h4 class="card-title">Curriculum Vitae</h4><br><br>
												<a href="">
													<div type="submit" class="btn btn-outline-primary">Adelante</div>
												</a>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card border-primary mb-3" style="height: 400px; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
											<img class="card-img-top" src="../imagenes/constancia_registro.png" style="height: 280px;">
											<div class="card-body">
												<h4 class="card-title">Constancia de Registro</h4><br><br>
												<a href="">
													<div type="submit" class="btn btn-outline-primary">Adelante</div>
												</a>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<center>
											<a href="1_12agen_trab_foto.php"><button type="button" name="Cancelar"  id="Cancelar" class="btn btn-outline-danger"  onclick="javascript:send('Cancelar');">Regresar</button></a>
										</center>
									</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
</body>

<!-- Diseño Viejo -->
    
<!--table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
          <th class="titulo">Formatos</th>
        </tr>
        <tr>
          <th  class="sub_titulo" align="left"> Formatos: </th>
        </tr>
        <tr>
          <td  class="link-clave-ruee"><div align="center"></div></td>
        </tr>
        <tr>
          <td>
          <? if ($_POST['formatos']=='1'){?>
                  <table width="50%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
                  <tr>
                  <td width="50%" class="link-clave-ruee" align="center"><a href="1agen_formato_curriculum.php" class="links-menu-izq"><img src="../imagenes/client_account_template.png" width="36" height="36" border="0" /><br>Curriculum Vitae</a></td>
                  
                  <td width="50%" class="link-clave-ruee" align="center"><a href="1agen_formato_constancia_trab.php" class="links-menu-izq"><img src="../imagenes/blue-document-text.png" width="36" height="38" border="0" /><br>
                  Constancia de Registro</a></td>
                  </tr>
                  </table>
                  
             <? } else{?>   
                  <table width="50%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
                  <tr>
                  <th width="50%" class="titulo" align="center"><img src="../imagenes/client_account_template.png" width="36" height="36" border="0" /><br>Curriculum Vitae</th>
                  <th width="50%" class="titulo" align="center"><img src="../imagenes/blue-document-text.png" width="36" height="38" border="0" /><br>Constancia de Registro</th>
                  </tr>
                  </table>
               <? }?>
                  
        </td>
        </tr>
        <tr>
          <td class="link-clave-ruee">&nbsp;</td>
        </tr>
      </table-->
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

<?php include('footer.php'); ?>

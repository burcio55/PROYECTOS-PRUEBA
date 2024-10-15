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
		var_dump($_SESSION);
	}
}

//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){

			case 'cbPais_migrante_changed':
			    LoadData($conn,true);
			break;
				
			case 'Cancelar': 
				LoadData($conn,false);	
			break;
				
			case 'Continuar': 
			$bValidateSuccess=true;			
						
				if ($_POST['cbPais_migrante']=="-1"){
				$GLOBALS['aPageErrors'][]= "- País de procedencia: es requerido.";
				$bValidateSuccess=false;
				 }
				 
				if ($_POST['cbPais_migrante']=="239"){
					if ($_POST['cbEstado_migrante']=="-1"){
					$GLOBALS['aPageErrors'][]= "- Estado de procedencia: es requerido.";
					$bValidateSuccess=false;
				    }
				 }
				 
				if ($_POST['cbTipo_migrante']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Tipo de Migración: es requerido.";
				$bValidateSuccess=false;
				 }
				 
				if ($_POST['cbCausa_migrante1']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Causa de la migración: es requerida.";
				$bValidateSuccess=false;
				 }
				 
				if ($_POST['cbvia_ingreso']=="-1"){
				$GLOBALS['aPageErrors'][]= "- Causa de la migración: es requerida.";
				$bValidateSuccess=false;
				 }
				 
				 if ($_POST['cbstatus_migratorio']=="-1"){
				$GLOBALS['aPageErrors'][]= "- El estatus migratorio: es requerido.";
				$bValidateSuccess=false;
				 }
				 		
				if ($_POST['fmigrante']==""){
					$GLOBALS['aPageErrors'][]= "- La vía de ingreso al país:: es requerida.";
					$bValidateSuccess=false;
					 }					 
			    if  ($_POST['fmigrante']!=''){	
				$fecha1=$_POST['fmigrante'];
					if (preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$fecha1))
						list($año1,$mes1,$dia1)=split("-",$fecha1);				
				$fecha2=date('Y-m-d');		
						preg_match("/([0-9][0-9]){1,2}\/[0-9]{1,2}\/[0-9]{1,2}/",$fecha2);
						list($año2,$mes2,$dia2)=split("-",$fecha2);		
					if ($fecha1 > $fecha2){
						$GLOBALS['aPageErrors'][]= "- La Fecha de migración: es incorrecta.";
						$bValidateSuccess=false;
						}					 
				     }	 
				 
				 
																				  				
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
//------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
if (count($GLOBALS['aDefaultForm']) == 0){
    $aDefaultForm = &$GLOBALS['aDefaultForm'];
//migrante
				$aDefaultForm['cbMigrante_afiliado']='-1';
				$aDefaultForm['cbPais_migrante']='-1';
				$aDefaultForm['cbEstado_migrante']='-1';
				$aDefaultForm['cbTipo_migrante']='-1';
				$aDefaultForm['cbCausa_migrante']='-1';
				$aDefaultForm['cbCausa_migrante1']='-1';
				$aDefaultForm['fmigrante']='';
				$aDefaultForm['cbvia_ingreso']='-1';
				$aDefaultForm['cbstatus_migratorio']='-1'; 
				
				
        if (!$bPostBack){
		    $SQL="select nacionalidad, estado_nacimiento_id, pais_nacimiento_id 		
		       	  From public.personas where cedula='".$_SESSION['ced_afiliado']."'";
				  $rs1 = $conn->Execute($SQL);
				  if ($rs1->RecordCount()>0){ 				
					$aDefaultForm['cbPais_migrante']=$rs1->fields['pais_nacimiento_id'];
						
						?>	
						<script language="javascript" src="../js/jquery.js">
						
						$(document).ready(function(){
						alert('paisssss');
						elegido="<?php echo $rs1->fields['pais_nacimiento_id']; ?>";
						combo="Estado_nac";
						$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_nacimiento_id']; ?>" }, 
						function(data){ $("#cbEstado_migrante").html(data);
						});            
						});
						</script>
						<?php
				  }	
				  		
			unset($_SESSION['id_migrante']);
				$SQL="select persona_migrante.*, persona_migrante.id as id_migrante from persona_migrante 
              INNER JOIN personas ON personas.id=persona_migrante.persona_id 
					    where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
						  $rs1 = $conn->Execute($SQL);
						  $_SESSION['EOF']=$rs1->RecordCount();
				 		 if ($rs1->RecordCount()>0){ 				
					//		$aDefaultForm['cbMigrante_afiliado']=$rs1->fields['migrante'];
					//		$aDefaultForm['cbPais_migrante']=$rs1->fields['pais_migrante_id'];
							$aDefaultForm['cbTipo_migrante']=$rs1->fields['tipo_migrante_id'];
							$aDefaultForm['cbCausa_migrante']=$rs1->fields['causa_id'];
					//		$aDefaultForm['cbCausa_migrante1']=$rs1->fields['causa_e'];
							$aDefaultForm['fmigrante']=$rs1->fields['f_migracion'];
							$_SESSION['id_migrante']=$rs1->fields['id_migrante'];
							$aDefaultForm['cbvia_ingreso']=$rs1->fields['via_ingreso'];
				      $aDefaultForm['cbstatus_migratorio']=$rs1->fields['estatus_migratorio']; 
						//	var_dump($_SESSION['id_migrante']);
						?>	
							<script language="javascript" src="../js/jquery.js"></script>
							<script>
							$(document).ready(function(){
							elegido="<?php echo $rs1->fields['pais_migrante_id']; ?>";
							combo="Estado_nac";
							$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['estado_migrante_id']; ?>" }, 
							function(data){ $("#cbEstado_migrante").html(data);
								 });            
							});
							
							$(document).ready(function(){
							elegido="<?php echo $rs1->fields['causa_id']; ?>";
							combo="Causa_mig";
							$.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $rs1->fields['causa_e']; ?>" }, 
							function(data){ $("#cbCausa_migrante1").html(data);
							
								 });            
							});
							</script>
						<?php	
						}
		            }
		else{  
			//	$aDefaultForm['cbMigrante_afiliado']=$_POST['cbMigrante_afiliado'];
				$aDefaultForm['cbPais_migrante']=$_POST['cbPais_migrante'];
				$aDefaultForm['cbEstado_migrante']=$_POST['cbEstado_migrante'];
				$aDefaultForm['cbTipo_migrante']=$_POST['cbTipo_migrante'];
				$aDefaultForm['cbCausa_migrante']=$_POST['cbCausa_migrante'];
				$aDefaultForm['cbCausa_migrante1']=$_POST['cbCausa_migrante1'];
				$aDefaultForm['fmigrante']=$_POST['fmigrante'];
				$aDefaultForm['cbvia_ingreso']=$_POST['cbvia_ingreso'];
				$aDefaultForm['cbstatus_migratorio']=$_POST['cbstatus_migratorio']; 
				?>	
					<script language="javascript" src="../js/jquery.js"></script>
          <script>
          $(document).ready(function(){
          elegido="<?php echo $_POST['pais_migrante_id']; ?>";
          combo="Estado_nac";
          $.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['estado_migrante_id']; ?>" }, 
          function(data){ $("#cbEstado_migrante").html(data);
             });            
          });
          
          $(document).ready(function(){
          elegido="<?php echo $_POST['causa_id']; ?>";
          combo="Causa_mig";
          $.post("modelo.php", { elegido: elegido, combo:combo ,seleccionado:"<?php echo $_POST['causa_e']; ?>" }, 
          function(data){ $("#cbCausa_migrante1").html(data);
          
             });            
          });
          </script>
        <?php	
		}
	}
} 

//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	
	
//update insert persona_migrante				  
		if ($_SESSION['id_migrante']!=''){				
				  $sql="update persona_migrante set 
						  causa_id = '".$_POST['cbCausa_migrante']."',
						  causa_e= '".$_POST['cbCausa_migrante1']."',
						  tipo_migrante_id = '".$_POST['cbTipo_migrante']."',
						  pais_migrante_id = '".$_POST['cbPais_migrante']."',
						  estado_migrante_id = '".$_POST['cbEstado_migrante']."',
						  f_migracion = '".$_POST['fmigrante']."',
							via_ingreso='".$_POST['cbvia_ingreso']."',
							estatus_migratorio='".$_POST['cbstatus_migratorio']."', 
						  updated_at = '$sfecha',
						  status = 'A',
						  id_update = '".$_SESSION['sUsuario']."'
						  WHERE id = '".$_SESSION['id_migrante']."' and persona_id= '".$_SESSION['id_afiliado']."'"; 	
						  $conn->Execute($sql);
					}
						  						  
				else{
				 $sql="insert into public.persona_migrante
						(persona_id, causa_id, causa_e, tipo_migrante_id, pais_migrante_id, estado_migrante_id, 	
						f_migracion, via_ingreso, estatus_migratorio, created_at, status, id_update) values
						('".$_SESSION['id_afiliado']."',
						 '".$_POST['cbCausa_migrante']."',
						 '".$_POST['cbCausa_migrante1']."',
						 '".$_POST['cbTipo_migrante']."',
						 '".$_POST['cbPais_migrante']."',
						 '".$_POST['cbEstado_migrante']."',
						 '".$_POST['fmigrante']."',
						 '".$_POST['cbvia_ingreso']."',
						 '".$_POST['cbstatus_migratorio']."',  
						 '$sfecha',
						 'A',
						 '".$_SESSION['sUsuario']."')";
					   $conn->Execute($sql);
			  }
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
			  $id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='2';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
//--------------------------------------------------------------------------------------------------------------------------------------				
		   if ($_SESSION['disc_bloq']==1){
			   	   ?><script>document.location='1_4agen_trab_ocupacion.php'</script><? 
				   }
				else{
			       ?><script>document.location='1_3agen_trab_discapacidad.php'</script><? 
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
<form name="frm_migracion" method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
<script>
	function send(saction){
	       if(saction=='Continuar'){
		   			if(validar_frm_migracion()==true){
					var form = document.frm_migracion;
					form.action.value=saction;
					form.submit();	
				}		   
					
		  	}else{
					var form = document.frm_migracion;
					form.action.value=saction;
					form.submit();				
			}		
	}
</script>
<script language="javascript"> 
//Estado nacimiento
$(document).ready(function(){
   $("#cbPais_migrante").change(function () {
           $("#cbPais_migrante option:selected").each(function () {
            elegido=$(this).val();
			combo='Estado_nac';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbEstado_migrante").html(data);
            });            
        });
   })
});
//Causa migrante
$(document).ready(function(){
   $("#cbCausa_migrante").change(function () {
           $("#cbCausa_migrante option:selected").each(function () {
            elegido=$(this).val();
			combo='Causa_mig';
            $.post("modelo.php", { elegido: elegido, combo:combo  }, function(data){
			//alert(data);
            $("#cbCausa_migrante1").html(data);
            });            
        });
   })
});

</script>
    <input name="action" type="hidden" value=""/>
	<input name="fmigrante" type="hidden" value="<?=$_POST['fmigrante']?>"/>  

<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
        <tr>
	      <th colspan="3" class="titulo">MIGRACIONES </th>
	      </tr>
        <tr>
	      <th colspan="3" height="25" class="sub_titulo" align="left">Datos migratorios: </th>
	      </tr>
        <tr>
          <td width="44%" align="right">Pa&iacute;s de procedencia:</td>
          <td width="56%"><span class="links-menu-izq">
          <select name="cbPais_migrante" id="cbPais_migrante" class="tablaborde_shadow" title="Pais de procedencia - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadPais_migrante ($conn) ; print $GLOBALS['sHtml_cb_Pais_migrante']; ?>
          </select>
          </span>          <span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td align="right">Estado de procedencia:</td>
          <td><span class="links-menu-izq">
            <select name="cbEstado_migrante" id="cbEstado_migrante" class="tablaborde_shadow" title="Estado de procedencia - Seleccione solo una opcion del listado - Este campo es requerido solo si el pais de procedencia es Venezuela">
              <option value="-1">Seleccionar</option>
            </select>
          </span><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td align="right">Categoría migratoria:</td>
          <td><span class="links-menu-izq">
            <select name="cbTipo_migrante" class="tablaborde_shadow" id="cbTipo_migrante" title="Categoria migratoria - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? $ced = substr($_SESSION['ced_afiliado'], 0,1); 
			     LoadTipo_migrante($conn, $ced); 
				 print $GLOBALS['sHtml_cb_Tipo_migrante'];?>
            </select>
            <span class="requerido">* </span></span></td>
        </tr>
        <tr>
          <td align="right">Causa de la migraci&oacute;n</td>
          <td><span class="links-menu-izq">
            <select name="cbCausa_migrante" id="cbCausa_migrante" class="tablaborde_shadow" title="Causa de la migracion - Seleccione solo una opcion del listado">
              <option value="-1" selected="selected">Seleccione...</option>
              <? LoadCausa_migrante ($conn) ; print $GLOBALS['sHtml_cb_Causa_migrante']; ?>
            </select>
          </span><span class="links-menu-izq">
          <select name="cbCausa_migrante1" id="cbCausa_migrante1" class="tablaborde_shadow" title="Causa especifica de la migracion - Seleccione solo una opcion del listado">
            <option value="-1">Seleccionar</option>
          </select>
          <span class="requerido">*</span></span></td>
        </tr>
        <tr>
          <td align="right">Fecha migraci&oacute;n:</td>
          <td>
          <input name="fmigrante" type="text" class="tablaborde_shadow" id="fmigrante" value="<?=$aDefaultForm['fmigrante']?>" size="10" readonly/>
                <a href="#" id="f_rangeStart_trigger"><img src="../imagenes/calendar_16.png" border="0" title="Selecciona la Fecha" /></a>
                <script type="text/javascript">//<![CDATA[
                             Calendar.setup({
                               inputField : "fmigrante",
                               trigger    : "f_rangeStart_trigger",
                               onSelect   : function() { this.hide() },
                               showTime   : false,
                               dateFormat : "%Y-%m-%d"
                             });
                           </script></td>
        </tr>
        <tr>
          <td align="right">Estatus migratorio:</td>
          <td><select name="cbstatus_migratorio" class="" id="cbstatus_migratorio" >
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbstatus_migratorio'])=='1') print 'selected="selected"';?>>Regularizado</option>
	        <option value="2" <? if (($aDefaultForm['cbstatus_migratorio'])=='2') print 'selected="selected"';?>>Irregular</option>
	        </select> <span class="requerido">* </span></td>
        </tr>
         <tr>
          <td align="right">V&iacute;a de ingreso al pa&iacute;s:</td>
          <td><select name="cbvia_ingreso" class="" id="cbvia_ingreso">
	        <option value="-1" selected="selected">Seleccione</option>
	        <option value="1" <? if (($aDefaultForm['cbvia_ingreso'])=='1') print 'selected="selected"';?>>A&eacute;rea</option>
	        <option value="2" <? if (($aDefaultForm['cbvia_ingreso'])=='2') print 'selected="selected"';?>>Mar&iacute;tima</option>
          <option value="3" <? if (($aDefaultForm['cbvia_ingreso'])=='3') print 'selected="selected"';?>>Terrestre</option>
	        </select> <span class="requerido">* </span></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><div align="center"><span class="requerido">
		   <button type="button" name="Continuar"  id="Continuar" class="button"  onclick="javascript:send('Continuar');">Continuar</button>
		   <button type="button" name="Cancelar"  id="Cancelar" class="button"  onclick="javascript:send('Cancelar');">Cancelar</button>
	      </span></div></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
  </table>
      <p></div>
</p>
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
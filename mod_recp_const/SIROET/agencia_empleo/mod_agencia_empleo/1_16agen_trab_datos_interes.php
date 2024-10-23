<?php
ini_set("display_errors", 0);
error_reporting(E_ALL | E_STRICT);

include('include/header.php');
//include('../include/security_chain.php');
include('1_LoadCombos.php');
include('1_Validador.php');	
include('Trazas.class.php');
$conn= getConnDB($db1);
$aPageErrors = array();
$aDefaultForm = array();
$aTabla = array();
$aTablaInteresConocimiento= array();
$aTablaInteresLaboral= array();

LoadInteresConocimiento($conn);
LoadInteresLaboral($conn);

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
		print $_SESSION['rif'];
		var_dump( $_SESSION);
		var_dump($_SESSION['id_empresa']);

		var_dump($GLOBALS['aTablaInteresConocimiento']);
		var_dump($GLOBALS['aTablaInteresLaboral']);

	}
}
//------------------------------------------------------------------------------------------------------------------------------
function trace($msg)
{
	if ($GLOBALS['settings']['debug']) {
		print "<br>***** TRACE *****<br>";
		print $msg;
	}
}
//------------------------------------------------------------------------------------------------------------------------------
function doAction($conn){
	if (isset($_POST['action'])){
		switch($_POST['action']){
		
			
			case 'Cancelar': 
				LoadData($conn,false);	
			break;
				
			case 'Agregar': 
			$bValidateSuccess=true;	
			if(empty($_POST['chk_interes_conocimiento'])){
				$GLOBALS['aPageErrors'][]= "- Mínimo un interes de conocimiento: es requerido.";
				$bValidateSuccess=false;
			}

			if(empty($_POST['chk_interes_laboral'])){
				$GLOBALS['aPageErrors'][]= "- Mínimo un interes laboral: es requerido.";
				$bValidateSuccess=false;
			}	

			if ($_POST['srial_carnet_patria']==""){
				$GLOBALS['aPageErrors'][]= "- El serial del carnet de la patria: es requerido.";
				$bValidateSuccess=false;
			}

			if ($_POST['codigo_carnet_patria']==""){
				$GLOBALS['aPageErrors'][]= "-El código del carnet de la patria: es requerido.";
				$bValidateSuccess=false;
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
//------------------------------------------------------------------------------------------------------------------------------
function LoadData($conn,$bPostBack){
	if (count($GLOBALS['aDefaultForm']) == 0){
	    $aDefaultForm = &$GLOBALS['aDefaultForm'];

						$aDefaultForm['srial_carnet_patria']='';
						$aDefaultForm['codigo_carnet_patria']='';

		if (!$bPostBack){	


				
			
				//____________________________

				$SQL2="select * from personas where id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."'";
					 $rs2 = $conn->Execute($SQL2);
					 if ($rs2->RecordCount()>0){ 			

						$aDefaultForm['srial_carnet_patria']=$rs2->fields['srial_carnet_patria'];
						$aDefaultForm['codigo_carnet_patria']=$rs2->fields['codigo_carnet_patria'];
						}
		}else{   
						$aDefaultForm['srial_carnet_patria']=$_POST['srial_carnet_patria'];
						$aDefaultForm['codigo_carnet_patria']=$_POST['codigo_carnet_patria'];
						
			  }
	}
} 
//------------------------------------------------------------------------------------------------------------------------------
function ProcessForm($conn){
$sfecha=date('Y-m-d');	
 
		 $SQL5="select * 
			From persona_interes_conocimiento 
			inner join personas on personas.id=persona_interes_conocimiento.persona_id
			inner join interes_conocimiento on 
			persona_interes_conocimiento.interes_conocimiento_id=interes_conocimiento.id
			where persona_id='".$_SESSION['id_afiliado']."'";
				 $rs5 = $conn->Execute($SQL5);
				 if ($rs5->RecordCount()>0){
				 	$existe_interes_c=1;
				 }else{
				 	$existe_interes_c=2;
				 }			
		//si es por primera vez has un insert
		if($existe_interes_c==2){

			 	$id_create=substr($_SESSION['ced_afiliado'], 1);
			 	foreach ($_POST['chk_interes_conocimiento'] as $intereses_a) {
				 	//guardar en tabla de interes de conocimiento
				 	$SQL4="INSERT INTO public.persona_interes_conocimiento
				 		(persona_id,
				 	 	interes_conocimiento_id,
				 	 	id_update,
				 	 	id_create,
				 	 	create_at)
						VALUES 
						('".$_SESSION['id_afiliado']."',
						'".$intereses_a."',
						'".$_SESSION['sUsuario']."',
					    '".$_SESSION['sUsuario']."',
						'$sfecha')";
                       
						
                	   $rs4= $conn->Execute($SQL4);
                	}
                	
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

                	foreach ($_POST['chk_interes_laboral'] as $intereses_b) {
				 	//guardar en tabla de interes de conocimiento
				 	$SQL6="INSERT INTO personas_interes_laboral(
				 	    persona_id,
				 	    interes_laboral_id,
				 	    id_update,
				 	    created_at,
				 	    created_id)
						VALUES ('".$_SESSION['id_afiliado']."',
						'".$intereses_b."',
						'".$_SESSION['sUsuario']."',
						'$sfecha',
						'".$_SESSION['sUsuario']."')";
                       
                	   $rs6= $conn->Execute($SQL6);
                	}
        //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

				$SQL7="update personas set 
				  srial_carnet_patria='".$_POST['srial_carnet_patria']."',
				  codigo_carnet_patria='".$_POST['codigo_carnet_patria']."'
					WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' "; 
                       
                	   $rs7= $conn->Execute($SQL7);
        //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

               $id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='7';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
				
			  ?><script>//document.location='index.php?menu=12'</script><?
				
			}else{ //De lo contrario si ya existe datos de interes de conocimiento/laboral registrados
				
/*==============================================================================================
				CONSULTA LAS OPCIONES DE INTERES DE CONOCIMIENTO YA REGISTRADAS
================================================================================================*/
				$SQL9="select * 
				From persona_interes_conocimiento 
				inner join personas on personas.id=persona_interes_conocimiento.persona_id
				inner join interes_conocimiento on 
				persona_interes_conocimiento.interes_conocimiento_id=interes_conocimiento.id
				where persona_id='".$_SESSION['id_afiliado']."'";

				 $rs9 = $conn->Execute($SQL9);
				 if ($rs9->RecordCount()>0){
				 	while(!$rs9->EOF){
						$val9[]=array();
						$c9 = count($val9);
						$val9[$c9] = $rs9->fields['interes_conocimiento_id']; 
						$listar_interes_1.=$val9[$c9];

						$rs9->MoveNext();
					}	
				 }
/*==============================================================================================
		  VERIFICA SI LAS OPCIONES DE INTERES CONOCIMIENTO MARCADAS EXISTEN EN LA BD
================================================================================================*/
					for ($m=0;$m<count($_POST['chk_interes_conocimiento']);$m++){
						$cc=$rs9->RecordCount();
						$i=0;
						while($i!=$cc){
							if($_POST['chk_interes_conocimiento'][$m]==$listar_interes_1[$i]){
								$existe[$m]=1;
							}
							$i++;
						}
					}

					for ($m=0;$m<count($_POST['chk_interes_conocimiento']);$m++){

						if($existe[$m]==1){
							//YA QUE EXISTE, NO LO REGISTRES
							
						}else{

							if($existe[$m]!=1){
								//SI NO EXISTE, REGISTRALO
								$SQL="INSERT INTO public.persona_interes_conocimiento
						 		(persona_id,
						 	 	interes_conocimiento_id,
						 	 	id_update,
						 	 	id_create,
						 	 	create_at)
								VALUES 
								('".$_SESSION['id_afiliado']."',
								'".$_POST['chk_interes_conocimiento'][$m]."',
								'".$_SESSION['sUsuario']."',
							    '".$_SESSION['sUsuario']."',
							    '$sfecha')";
								
		                	   $rs= $conn->Execute($SQL);
								
							   
							}
						}
					}
/*============================================================================*/


					
/*===================================================================================================
		VERIFICA SI LAS OPCIONES DE INTERES CONOCIMIENTO YA EXISTENTES FUERON DESMARCADAS 
====================================================================================================*/


				/*OBTIENE LOS CHECKBOX QUE NO ESTAN MARCADOS*/
				$con=1;
				$t=0;
				$no_marcadas=array();			 
				for ($x=0; $x < $_SESSION['num_interes_c'];$x++){
						 $b=$n[$x]=$con;

						 if(in_array($b, $_POST['chk_interes_conocimiento'])){
						 	
						 }else{
						 	 $no_marcadas[$t]=$b;
						 	 $t++;
						 }
					$con++;
				}

				/*COMPARA LAS CASILLAS DESMARCADAS CON LAS OPCIONES DE LA BD*/
				for ($m=0;$m<count($no_marcadas);$m++){
					$cc=$rs9->RecordCount();
					$i=0;
					while($i!=$cc){
						if($no_marcadas[$m]==$listar_interes_1[$i]){
							$no_existe[$m]=1;
						}
						$i++;
					}
				}

				/* DIVIDE LAS CASILLAS QUE ESTAN DESMARCADAS QUE EXISTEN EN LA BD Y LAS QUE NO EXISTEN EN LA BD*/
				for ($m=0;$m<count($no_marcadas);$m++){

					if($no_existe[$m]==1){
						//Eliminala porque esta en la BD, pero fue desmarcada por el usuario
						$SQL="DELETE FROM persona_interes_conocimiento
							WHERE persona_id='".$_SESSION['id_afiliado']."' AND interes_conocimiento_id='".$no_marcadas[$m]."' ";
							 	$rs= $conn->Execute($SQL);
					}else{
						//no la elimines, xq esta en la bd, pero no fe desmarcada por el usuario
					}
				}

///__________________________________________________________________________________________
//___________________________________________________________________________________________

/*==============================================================================================
				CONSULTA LAS OPCIONES DE INTERES LABORAL YA REGISTRADAS
================================================================================================*/
				$SQL10="select * 
				From personas_interes_laboral 
				inner join personas on personas.id=personas_interes_laboral.persona_id
				inner join interes_laboral on 
				personas_interes_laboral.interes_laboral_id=interes_laboral.id
				where persona_id='".$_SESSION['id_afiliado']."'";

				 $rs10 = $conn->Execute($SQL10);
				 if ($rs10->RecordCount()>0){
				 	while(!$rs10->EOF){
						$val10[]=array();
						$c10 = count($val10);
						$val10[$c10] = $rs10->fields['interes_laboral_id']; 
						$listar_interes_2.=$val10[$c10];

						$rs10->MoveNext();
					}	
				 }
/*==============================================================================================
		  VERIFICA SI LAS OPCIONES DE INTERES LABORAL MARCADAS EXISTEN EN LA BD
================================================================================================*/
					for ($n=0;$n<count($_POST['chk_interes_laboral']);$n++){
						$ct=$rs10->RecordCount();
						$i=0;
						while($i!=$ct){
							if($_POST['chk_interes_laboral'][$n]==$listar_interes_2[$i]){
								$existe2[$n]=1;
							}
							$i++;
						}
					}

					for ($n=0;$n<count($_POST['chk_interes_laboral']);$n++){

						if($existe2[$n]==1){
							//YA QUE EXISTE, NO LO REGISTRES	
						}else{

							if($existe2[$n]!=1){
								//SI NO EXISTE, REGISTRALO
		                	   $SQL="INSERT INTO personas_interes_laboral(
						 	    persona_id,
						 	    interes_laboral_id,
						 	    id_update,
						 	    created_at,
						 	    created_id)
								VALUES ('".$_SESSION['id_afiliado']."',
								'".$_POST['chk_interes_laboral'][$n]."',
								'".$_SESSION['sUsuario']."',
								'$sfecha',
								'".$_SESSION['sUsuario']."')";
		                       
		                	   $rs= $conn->Execute($SQL);
								
							   
							}
						}
					}
/*============================================================================*/

/*===================================================================================================
		VERIFICA SI LAS OPCIONES DE INTERES LABORAL YA EXISTENTES FUERON DESMARCADAS 
====================================================================================================*/


				/*OBTIENE LOS CHECKBOX QUE NO ESTAN MARCADOS*/
				$con=1;
				$t=0;
				$no_marcadas=array();			 
				for ($x=0; $x < $_SESSION['num_interes_l'];$x++){
						 $b=$p[$x]=$con;

						 if(in_array($b, $_POST['chk_interes_laboral'])){	
						 
						 }else{
						 	//dame el id de las que estan desmarcada
						 	$no_marcadas[$t]=$b;
						 	$t++;
						 }
					$con++;
				}

				/*COMPARA LAS CASILLAS DESMARCADAS CON LAS OPCIONES DE LA BD*/
				for ($n=0;$n<count($no_marcadas);$n++){
					$ct=$rs10->RecordCount();
					$i=0;
					while($i!=$ct){
						//compara el id de las desmarcadas con la de las bd
						if($no_marcadas[$n]==$listar_interes_2[$i]){
							//si esta desmarcado y existe en la bd
							$no_existee[$n]=1;
						}
						$i++;
					}
				}

				/* DIVIDE LAS CASILLAS QUE ESTAN DESMARCADAS QUE EXISTEN EN LA BD Y LAS QUE NO EXISTEN EN LA BD*/
				for ($n=0;$n<count($no_marcadas);$n++){

					if($no_existee[$n]==1){
						//Eliminala porque esta en la BD, pero fue desmarcada por el usuario
						$SQL="DELETE FROM personas_interes_laboral
							WHERE persona_id='".$_SESSION['id_afiliado']."' AND interes_laboral_id='".$no_marcadas[$n]."' ";
							 	$rs= $conn->Execute($SQL);
					}else{
						//no la elimines, xq esta en la bd, pero no fe desmarcada por el usuario
					}
				}




/*============================================================================
				ACTUALIZA DATOS DEL CARNET Y EL CODIGO DE LA PATRIA
==============================================================================*/
				$SQL7="update personas set 
				srial_carnet_patria='".$_POST['srial_carnet_patria']."',
				codigo_carnet_patria='".$_POST['codigo_carnet_patria']."'
				WHERE id= '".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' "; 
				   
				$rs7= $conn->Execute($SQL7);
/*===========================================================================*/

					
//Trazas-------------------------------------------------------------------------------------------------------------------------------				
				$id=$_SESSION['id_afiliado'];
				$identi=$_SESSION['ced_afiliado'];
				$us=$_SESSION['sUsuario'];
				$mod='22';			    
				$auditoria= new Trazas; 
				$auditoria->auditor($id,$identi,$sql,$us,$mod);	
				
				
			  ?><script>//document.location='index.php?menu=12'</script><?
		

			}	
									
   				//echo "<h1>AQUIIII 1</h1>";
				//echo $_SESSION['disc_bloq'];
			  /* if ($_SESSION['disc_bloq']==1){
			   	  ?><script>
					//document.location='1_3agen_trab_discapacidad.php'
					document.location='index.php?menu=13'
					
					</script>
			   
			   <? 
				   }
				else{*/
					//echo "<h1>AQUIIII 2</h1>";
			       ?><script>
				   //document.location='1_16agen_trab_datos_interes.php'
				  // document.location='index.php?menu=12'
					 document.location='index.php?menu=14'
					</script><? 
				 //  }
	  			
			
		

}

/*================================================================================================
								CONSULTA LISTADO DE INTERESES DE CONOCIMIENTO
==================================================================================================*/
function LoadInteresConocimiento($conn) {
$sSQL="SELECT id,nombre FROM public.interes_conocimiento where status='1'";
$rs = $conn->Execute($sSQL);
		if($rs->RecordCount()>0){
			$_SESSION['num_interes_c']=$rs->RecordCount();
			$aTablaInteresConocimiento = array();
			$aTablaInteresConocimiento = &$GLOBALS['aTablaInteresConocimiento'];
					while(!$rs->EOF){
					$c = count($aTablaInteresConocimiento);
						$aTablaInteresConocimiento[$c]['id']=$rs->fields['id'];
						$sSQL="SELECT interes_conocimiento.id,interes_conocimiento.nombre  FROM interes_conocimiento left join persona_interes_conocimiento on persona_interes_conocimiento.interes_conocimiento_id=interes_conocimiento.id where interes_conocimiento.status='1' and persona_interes_conocimiento.interes_conocimiento_id  = ".$rs->fields['id']." ";
						$rs1 = $conn->Execute($sSQL);
						if ($aTablaInteresConocimiento[$c]['id']==$rs1->fields['id']){
							$_POST['interes_conocimiento_chk'][$c]= "checked='checked'";
						}
						$aTablaInteresConocimiento[$c]['nombre']=$rs->fields['nombre'];

					$rs->MoveNext();
				}
		}
}
/*================================================================================================
								CONSULTA LISTADO DE INTERESES LABORALES
==================================================================================================*/
function LoadInteresLaboral($conn) {
	$sSQL="SELECT id,nombre FROM public.interes_laboral where status='1'";
	$rs = $conn->Execute($sSQL);
	if($rs->RecordCount()>0){
		$_SESSION['num_interes_l']=$rs->RecordCount();
		$aTablaInteresLaboral = array();
		$aTablaInteresLaboral = &$GLOBALS['aTablaInteresLaboral'];
				while(!$rs->EOF){
				$c = count($aTablaInteresLaboral);
					$aTablaInteresLaboral[$c]['id']=$rs->fields['id'];
					$sSQL="SELECT interes_laboral.id,interes_laboral.nombre  FROM interes_laboral left join personas_interes_laboral on personas_interes_laboral.interes_laboral_id=interes_laboral.id where interes_laboral.status='1' and personas_interes_laboral.interes_laboral_id  = ".$rs->fields['id']." ";
					$rs1 = $conn->Execute($sSQL);
					if ($aTablaInteresLaboral[$c]['id']==$rs1->fields['id']){
						$_POST['interes_laboral_chk'][$c]= "checked='checked'";
					}
					$aTablaInteresLaboral[$c]['nombre']=$rs->fields['nombre'];

				$rs->MoveNext();
			}
	}
}
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function showHeader(){
include('menu_trabajador.php'); 
 ?>

<div class="container">
 <? }
//------------------------------------------------------------------------------------------------------------------------------
function showForm($conn,$aDefaultForm){
?>
<form name="form" method="post" action="" >
  <p>
    <script>	
//_________________________
function send(saction){

	if(saction=='Agregar'){
		if(validar_intereses()==true){
			var form = document.form;
			form.action.value=saction;
			form.submit();
		}		   				
	}

	if(saction=='Cancelar'){
		var form = document.form;
		form.action.value=saction;
		form.submit();
	}
}
</script>

    <input name="action" type="hidden" value=""/>
	<table width="100%" border="0" align="center" class="formulario" cellpadding="0" cellspacing="0">
             <tr>
          	<td height="25"></td>
          </tr>
          
          <tr>
	      <th colspan="3" class="titulo">DATOS DE INTERES </th>
	      </tr>

          <tr>
              <td colspan="2"></td>
          </tr>
          
          <tr>
          		<th colspan="2" class="sub_titulo" align="left">Inter&eacute;s de Conocimiento</th>
          </tr>      

		  <?
			$aTablaInteresConocimiento = &$GLOBALS['aTablaInteresConocimiento'];
			$c = count($aTablaInteresConocimiento);
			$inter=0;
			for( $i=0; $i < $c; $i++){
			if (($inter%2) == 0) $class_name="dataListColumn2";
				else $class_name="dataListColumn";
				$inter++;
		  ?>
		   

		   	<tr>
		      	<td width="41%" height="25">
		      		<div align="right" class="$class_name"><?=$aTablaInteresConocimiento[$i]['nombre']?></div></td>
			      	<td><input type="checkbox" name="chk_interes_conocimiento[]" id="<?=$aTablaInteresConocimiento[$i]['id'];?>" title="Interés de Conocimiento - Debe seleccionar al menos un items" value="<?=$aTablaInteresConocimiento[$i]['id'];?>" <?=$_POST['interes_conocimiento_chk'][$i]?>>
			    </td> 
			</tr>
          
		   <?  } ?>
          
         
      <tr>
      		<th colspan="2" class="sub_titulo" align="left">Inter&eacute;s laboral</th>
      </tr> 


      
	   		<?
				$aTablaInteresLaboral = &$GLOBALS['aTablaInteresLaboral'];
				$d = count($aTablaInteresLaboral);
				$interr=0;
				for( $x=0; $x < $d; $x++){
				if (($interr%2) == 0) $class_name="dataListColumn3";
					else $class_name="dataListColumnn";
					$interr++;
			?>

		   	<tr>
		      	<td width="41%" height="25"class= "<?=$class_name?>">
		      		<div align="right" ><?=$aTablaInteresLaboral[$x]['nombre']?> </div></td>
			      	<td><input type="checkbox" name="chk_interes_laboral[]" id="<?=$aTablaInteresLaboral[$x]['id'];?>" title="Interés Laboral - Debe seleccionar al menos un items" value="<?=$aTablaInteresLaboral[$x]['id'];?>" <?=$_POST['interes_laboral_chk'][$x]?>>
			   </td> 
			</tr>
		   <? } ?>
     
	  <tr>
	  		<th colspan="2" class="sub_titulo" align="left">Carnet de la Patria</th>
	  </tr> 

	  <tr>
	  	<td><div align="right"> Serial del Carnet de la Patria: </div></td>
          <td><input name="srial_carnet_patria" type="text" class="tablaborde_shadow" id="srial_carnet_patria" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['srial_carnet_patria']?>" size="30" maxlength="11" autocomplete="off" title="Serial del Carnet de la Patria - Sólo se permite números"/><span class="requerido"> *</span></td>
        </tr>
        <tr>
          <td><div align="right"> Código del Carnet de la Patria: </div></td>
          <td><input name="codigo_carnet_patria" type="text" class="tablaborde_shadow" id="codigo_carnet_patria" onkeypress="return permite(event, 'num')" value="<?=$aDefaultForm['codigo_carnet_patria']?>" size="30" maxlength="11" autocomplete="off" title="Código del Carnet de la Patria - Sólo se permite números"/> <span class="requerido"> *</span></td>
	  </tr>	 
           <tr>
        	<td colspan="2">
            	<div align="center">
          			<button type="button" name="Agregar"  id="Agregar" class="button"  onClick="javascript:send('Agregar');">Continuar</button>
	          		<button type="button" name="Cancelar"  id="Cancelar" class="button"  onClick="javascript:send('Cancelar');">Cancelar</button>
	          	</div>
	        </td>
      
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

<?php // include('../footer.php'); ?>
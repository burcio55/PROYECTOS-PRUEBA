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
				<div class="card card-primary" style="border-radius: 30px">
					<div class="card-header" style="border-radius: 30px 30px 0 0">
						<h3 class="card-title"> Curriculum </h3>
					</div>
                    <div class="card">
                        <div style="width: 90%; margin: 50px auto; border-radius: 30px; overflow: hidden">
                            <div style="float: left; width: 50%; height: 310px; background-color: #111">
                                <div style="width: 70%; height: 100%; margin: auto; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                                    <img src="
                                    <?php
                                        $num_ale = rand(1,6);
                                        if ($num_ale == 1){
                                            echo "../imagenes/hombre1.jpg";
                                        }else
                                        if ($num_ale == 2){
                                            echo "../imagenes/hombre2.jpg";
                                        }else
                                        if ($num_ale == 3){
                                            echo "../imagenes/hombre3.png";
                                        }else
                                        if ($num_ale == 4){
                                            echo "../imagenes/Chica1.jpg";
                                        }else
                                        if ($num_ale == 5){
                                            echo "../imagenes/Chica2.jpg";
                                        }else{
                                            echo "../imagenes/Chica3.jpg";
                                        }
                                    ?>
                                    " alt="Tu Foto Personal" style="width: auto; height: 100%">
                                </div>
                            </div>
                            <div style="float: left; width: 50%; height: 310px; background-color: #111">
                                <h5 style="text-align: justify; color: white; margin: 50px auto 20px 50px;">
                                    <?php
                                        if ($num_ale >= 1 && $num_ale <= 3){
                                            $num_aleM = rand(1,3);
                                            if ($num_aleM == 1){
                                                echo "CARLOS VALENTINO <br> AGUIAR PÉREZ";
                                            }else
                                            if ($num_aleM == 2){
                                                echo "ROBERTO DANIEL <br> CONTRERAS BETANCOURT";
                                            }else{
                                                echo "BRAYAN RENE <br> GÓNZALEZ FITCHER";
                                            }
                                        }else
                                        if ($num_ale >= 4 && $num_ale <= 6){
                                            $num_aleF = rand(1,3);
                                            if ($num_aleF == 1){
                                                echo "YULINGER SINAI <br> NUÑES MOLINA";
                                            }else
                                            if ($num_aleF == 2){
                                                echo "ANNIE LYA <br> FLINK'S ROLIVA";
                                            }else{
                                                echo "VALENTINA NOEYLING <br> AGUIAR PÉREZ";
                                            }
                                        }
                                    ?>
                                </h5>
                                <hr style="background-color: white; width: 65%; margin: 0 0 20px 40px">
                                <p>
                                    <!-- Cédula Identidad -->
                                    <span style="color: white; margin: auto auto 10px 50px; font-size: 16px">
                                        <?php echo $ci_ale = rand(5000000,33000000); ?><br>
                                    </span>
                                    <!-- Dirección -->
                                    <span style="color: white; margin: auto auto 10px 50px; font-size: 16px">
                                        <?php
                                            $dir_ale = rand(1,3);
                                            if ($dir_ale == 1){
                                                echo "23 de Enero - Av Sierra Maestra";
                                            }else
                                            if ($dir_ale == 2){
                                                echo "23 de Enero - Av Sucre";
                                            }else{
                                                echo "23 de Enero - Municipio Libertador";
                                            }
                                        ?><br>
                                    </span>
                                    <!-- Dirección II -->
                                    <span style="color: white; margin: auto auto 10px 50px; font-size: 16px">
                                        <?php
                                            $dir_ale = rand(1,3);
                                            if ($dir_ale == 1){
                                                echo "Sector de los Campos - Barrio Santa Rosa";
                                            }else
                                            if ($dir_ale == 2){
                                                echo "Estación Agua Salud";
                                            }else{
                                                echo "El Mirador";
                                            }
                                        ?><br>
                                    </span>
                                    <!-- Teléfono -->
                                    <span style="color: white; margin: auto auto 10px 50px; font-size: 16px">
                                        <?php
                                            echo "+58 ".$telf_ale = rand(1000000000,9999999999);
                                        ?><br>
                                    </span>
                                    <!-- Correo -->
                                    <span style="color: white; margin: auto auto 10px 50px; font-size: 16px">
                                        <?php
                                            if ($num_ale >= 1 && $num_ale <= 3){
                                                $correoM = rand(1,3);
                                                if ($correoM == 1){
                                                    echo "carlosvalentinoaguiarperez.ml@gmail.com";
                                                }else
                                                if ($correoM == 2){
                                                    echo "rdbcroberto@gmail.com";
                                                }else{
                                                    echo "luffyace1909@gmail.com";
                                                }
                                            }else
                                            if ($num_ale >= 4 && $num_ale <= 6){
                                                $correoF = rand(1,3);
                                                if ($correoF == 1){
                                                    echo "yuli.nuñes@gmail.com";
                                                }else
                                                if ($correoF == 2){
                                                    echo "annielya.flinksroliva@gmail.com";
                                                }else{
                                                    echo "valentinaaguiar.ml@gmail.com";
                                                }
                                            }
                                        ?><br>
                                    </span>
                                </p>
                            </div>
                            <div style="float: left; width: 50%; height: 650px; background-color: #333">
                                <h5 style="text-align: justify; color: white; margin: 30px auto 20px 50px;">
                                    OTRAS ACTIVIDADES DE<br> CAPACITACIÓN
                                </h5>
                                <hr style="background-color: white; width: 65%; margin: 0 0 20px 40px">
                                <p>
                                    <?php
                                            $cant_trab = rand(1,3);
                                            for ($i = 0; $i <= $cant_trab; $i++){
                                    ?>
                                    <!-- Nombre de la Actividad -->
                                    <span style="color: white; margin: 10px auto 10px 50px; font-size: 16px">
                                        <?php
                                                $activ_ale = rand(1,4);
                                                if ($activ_ale == 1){
                                                    echo "Curso de Programación HTML5.2 AVANZADO";
                                                }else
                                                if ($activ_ale == 2){
                                                    echo "Curso de Reparación de Electrodomésticos";
                                                }else
                                                if ($activ_ale == 3){
                                                    echo "Trabajo de Albañilería";
                                                }else{
                                                    if ($num_ale >= 1 && $num_ale <= 3){
                                                        echo "Trabajo de Actor";
                                                    }else{
                                                        echo "Trabajo de Actris";
                                                    }
                                                }
                                        ?><br>
                                    </span>
                                    <!-- Nombre del Instituo -->
                                    <span style="color: white; margin: auto auto 10px 50px; font-size: 16px">
                                        <?php
                                                $ints_ale = rand(1,3);
                                                if ($ints_ale == 1){
                                                    echo "UNFA";
                                                }else
                                                if ($ints_ale == 2){
                                                    echo "IUJO";
                                                }else{
                                                    echo "USBA";
                                                }
                                        ?><br>
                                    </span>
                                    <!-- Duración -->
                                    <span style="color: white; margin: auto auto 30px 50px; font-size: 16px">
                                        <?php
                                                $temp_ale = rand(1,3);
                                                if ($temp_ale == 1){
                                                    $ayo_ale = rand(1,10);
                                                    $mes_ale = rand(1,12);
                                                    if ($mes_ale == 1 || $mes_ale == 3 || $mes_ale == 5 || $mes_ale == 7 || $mes_ale == 8 || $mes_ale == 10 || $mes_ale == 12){
                                                        $dia_ale = rand(1,31);
                                                    }else
                                                    if ($mes_ale == 4 || $mes_ale == 6 || $mes_ale == 9 || $mes_ale == 11){
                                                        $dia_ale = rand(1,30);
                                                    }else{
                                                        $feb_ale = rand(1,2);
                                                        if ($feb_ale == 1){
                                                            $dia_ale = rand(1,28);
                                                        }else{
                                                            $dia_ale = rand(1,29);
                                                        }
                                                    }
                                                    if ($dia_ale > 1){
                                                        echo "Duración: ".$ayo_ale." Año(s), ".$mes_ale." Mes(es) y ".$dia_ale." Días<br>";
                                                    }else{
                                                        echo "Duración: ".$ayo_ale." Año(s), ".$mes_ale." Mes(es) y un Día<br>";
                                                    }
                                                }else
                                                if ($temp_ale == 2){
                                                    $dia_ale = rand(1,100);
                                                    $horas_ale = rand (2,23);
                                                    if ($dia_ale > 1){
                                                        echo "Duración: ".$dia_ale." Días con ".$horas_ale." Horas<br>";
                                                    }else{
                                                        echo "Duración: Un Día con ".$horas_ale." Horas<br>";
                                                    }
                                                }else{
                                                    $horas_ale = rand (1,100);
                                                    if ($horas_ale > 1){
                                                        echo "Duración: ".$horas_ale." Horas<br>";
                                                    }else{
                                                        echo "Duración: Una Hora<br>";
                                                    }
                                                }
                                            }
                                        ?><br>
                                    </span>
                                </p>
                            </div>
                            <div style="float: left; width: 50%; height: 650px; background-color: #555"></div>
                            <div style="float: left; width: 100%; height: 250px; background-color: #909090"></div>
                        </div>
                    </div>
					<form class="form-horizontal">
						<div class="card-body">
							<div class="form-group row" >
                                <!-- Creación del Curriculum -->
                                <!-- <div class="col-sm-6">
                                    <div class="card border-primary mb-3" style="height: 400px; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px; overflow: hidden">
                                        <img class="card-img-top" src="../imagenes/curriculum.png" style="height: 280px;">
                                        <div class="card-body">
                                            <h4 class="card-title">Curriculum Vitae</h4><br><br>
                                            <a href="">
                                                <a href="curriculum.php"><buttom type="submit" class="btn btn-outline-primary" style="border-radius: 30px">Adelante</buttom></a>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card border-primary mb-3" style="height: 400px; background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; border-radius: 30px; overflow: hidden">
                                        <img class="card-img-top" src="../imagenes/constancia_registro.png" style="height: 280px;">
                                        <div class="card-body">
                                            <h4 class="card-title">Constancia de Registro</h4><br><br>
                                            <a href="">
                                                <a href="#"><buttom type="submit" class="btn btn-outline-primary" style="border-radius: 30px">Adelante</buttom></a>
                                            </a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-sm-12">
                                    <center>
                                    <a href="formato.php"><button type="button" name="Cancelar"  id="Cancelar" class="btn btn-outline-secondary"  onclick="javascript:send('Cancelar');" style="border-radius: 30px">Regresar</button></a>
                                    <a href="#"><button type="button" name="continuar"  id="continuar" class="btn btn-outline-primary"  onclick="javascript:send('continuar');" style="border-radius: 30px">Imprimir</button></a>
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

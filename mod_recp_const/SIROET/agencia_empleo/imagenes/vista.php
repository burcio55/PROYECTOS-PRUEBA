<?php 
session_start();
$vista = 1;

unset($_SESSION['id_modulo']);
unset($_SESSION['sistema']);
unset($_SESSION['centror']);

include("header.php"); 

$settings['debug'] = false;
$conn= getConnDB($db1);/////////////
$conn->debug = $settings['debug'];

$SQL="SELECT 1 as resultado
		FROM sesion
		WHERE personales_cedula = '".$_SESSION['id_usuario']."' and nenabled=1 and  clave ='".md5($_SESSION['id_usuario'])."'" ;
	$rs=$conn->Execute($SQL);
//echo $rs->fields['resultado'];
//var_dump ($_SESSION);
if( $rs->fields['resultado']== 1){

	print '<script> alert("Por medidas de seguridad Usted debe cambiar su contrase\u00F1a"); 
    document.location="mod_login/cambiar_contrasena.php";</script>';	
	}
debug();

if (isset($_POST['action'])){
	switch($_POST["action"]){
		case'btnMenu':
                    if($_POST['url']){
                        print "<script>document.location='".$_POST['url']."';</script>";
                        //print "<script>document.location='cerrar_sesion.php'<script>";
                    }
                break;
                
		case'btnModulo':
		//echo "ID de MODULO".$_POST['id'];
                    if($_POST['url']){
                        $_SESSION['id_modulo'] = $_POST['id'];//Debe eliminarse al entrar en esta pantalla
                        $_SESSION['sistema'] = $_POST['sistema'];
                        print "<script>document.location='".$_POST['url']."';</script>";
                        //print "<script>document.location='cerrar_sesion.php'<script>";
                    }
		break;
	}
}
?>
<script>
function menu(saction,url){
    var form = document.form1;
    form.action.value=saction;
    document.form1.url.value=url;
    form.submit();
}
function send(saction,url,idmodulo,sistema){
    var form = document.form1;
    form.action.value=saction;
    document.form1.url.value=url;
    document.form1.id.value=idmodulo;
    document.form1.sistema.value=sistema;
    form.submit();
}
</script>

	<div id="Contenido" align="center" style="overflow:auto">
	<br>
	<table class="tabla" width="95%" height="95%">
	<tbody>
	<tr valign="top">
	<td>


		<div style="height:80%">
			<form name="form1" id="form1" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" >
			<input name="action" type="hidden" value=""/>
			<input name="url" type="hidden" value="" />
			<input name="id" type="hidden" value="" />
			<input name="sistema" type="hidden" value="" />
				<div id="contenedor">
					<div>
						<ul id="menu_H">
						<?
						$modulos = $_SESSION['modulos'];
						$logos = $_SESSION['logos'];
						//var_dump($logos);
							for ($i = 0; $i < count($logos); $i++){
								for($a = 0; $a < count($i); $a++){
								?>
									<li>
										<a><img src="	logos/<?=$logos[$i]['slogo'];?>" onmouseover="this.src = 'logos/<?=$logos[$i]['slogo2'];?>';" onmouseout="this.src = 'logos/<?=$logos[$i]['slogo'];?>';" onclick="javascript:send('btnModulo', '<?=$modulos[$i]['surl'];?>', '<?=$logos[$i]['opcion_id'];?>', '<?=$logos[$i]['sdescripcion']?>')" title="<?=$logos[$i]['sdescripcion']?>" /></a>
									</li>
								<?	
								/*if($logos[$i]['opcion_id'] == 20){
									$_SESSION['desarrollador'] = 1;
								}*/
								}
							}
						?>
						</ul>
					</div>
				</div>
			</form>
		</div>

    		
	</td>
	</tr>
	</tbody>
	</table>
	
<?php 
$SQL="SELECT nentidad_entidad
FROM personales
where cedula='".$_SESSION['id_usuario']."' and nentidad_entidad is null";

$rs=$conn->Execute($SQL);
if($rs->RecordCount()>0){
	
	 $_SESSION["tmp_opciones"]=$_SESSION["total_opciones"];
	 $_SESSION["total_opciones"]='27,28,29';
	 

		print '<script> document.location="mod_recp_const/mod_recibos_pagos/rec_pago_actualizacion.php";</script>';
	}

include("footer.php"); ?>
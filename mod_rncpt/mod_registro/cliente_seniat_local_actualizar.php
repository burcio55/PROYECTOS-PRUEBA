<?php
ini_set('display_errors',0); 
error_reporting(E_ALL | E_STRICT | E_DEPRECATED);

require_once 'cliente_seniat_remoto_actualizar.php';

//$rif = new Rif('G200000120');

$rif = new Rif($_REQUEST['rif']);
$datosFiscales = json_decode($rif->getInfo());

switch ($datosFiscales->code_result) {
//	
//  case 1:
//		$texto  =$datosFiscales->seniat->nombre;		
//		
//		echo $texto;
//		break;

		
								case 1:
									$cadena  =trim($datosFiscales->seniat->nombre);		
									if($cadena==NULL or $cadena==null or $cadena=='null' or $cadena=='NULL' or $cadena==""){
										//VIENE VACIO 
										$resultado_['ESTATUS_WEBSERVER']="-2";
									}else{
										$parte1=explode('(',$cadena);
										$parte2=explode(')',$parte1[1]);
										$parentesis= $parte2[0];
										$denominacion=$parentesis;
										$razon=$parte1[0];
										$texto=$razon."|".$denominacion;
												
										
									echo $texto;	
										
									}
					 	break;
}

?>


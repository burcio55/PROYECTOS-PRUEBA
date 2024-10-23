<?php

//include('../header.php');
/*echo $hostname_sigefirrhh;
echo $username_sigefirrhh;
echo $password_sigefirrhh;*/

$conn2 = &ADONewConnection($target);
$conn2->PConnect($hostname_sigefirrhh,$username_sigefirrhh,$password_sigefirrhh,'sigefirrhh');
$conn2->debug = false;
//var_dump($conn2);
function consulta_sigefirrhh($cedula){		
global $conn2;	
 $sql_sigefirrh="SELECT personal.id_personal,
				personal.primer_apellido as apellido1,
				personal.segundo_apellido as apellido2,
				personal.primer_nombre as nombre1,
				personal.segundo_nombre as nombre2,
				personal.nacionalidad,
				personal.sexo,
				personal.cedula as cedula,
				trabajador.fecha_ingreso,
				trabajador.codigo_nomina as cod_nom,
				cargo.descripcion_cargo,
				dependencia.nombre as nombre_dep
				FROM trabajador
				INNER JOIN personal on personal.id_personal = trabajador.id_personal
				inner join cargo on trabajador.id_cargo = cargo.id_cargo
				inner join dependencia on dependencia.id_dependencia = trabajador.id_dependencia
				WHERE personal.cedula='".$cedula."' and estatus='A'";

				$rs_si=$conn2->Execute($sql_sigefirrh);
				
				if($rs_si->RecordCount()>0){
					$tipo_beneficiario=1; 
					$valor= "Trabajador MPPPST";
					
				}else{
					$tipo_beneficiario=2;
					$valor= "Beneficiario Externo";
				}
//echo $tipo_beneficiario;
return $tipo_beneficiario;
}
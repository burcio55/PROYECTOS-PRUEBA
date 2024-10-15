<?php
include('../include/header.php');
$conn = getConnDB('sire');
//------------------------------------------------------------------------------------------------------------------------------
		
			if ($_GET['id_po']!=''){	
						
				$SQL1="select persona_nivel_instruccion.id, graduado, titulo, ultimo_periodo,total_periodo, 
				f_aprobacion,instituto_uni, persona_nivel_instruccion.observaciones, nivel_instruccion.nombre as nivel,
				area_mencion.nombre as carrera, regimen_estudio.nombre as regimen
				from persona_nivel_instruccion
				INNER JOIN personas ON personas.id=persona_nivel_instruccion.persona_id 
				INNER JOIN nivel_instruccion ON nivel_instruccion.id=persona_nivel_instruccion.nivel_instruccion_id 
				INNER JOIN area_mencion ON area_mencion.id=persona_nivel_instruccion.area_mencion_id 
				INNER JOIN regimen_estudio ON regimen_estudio.id=persona_nivel_instruccion.regimen_id 
where persona_id ='".$_SESSION['id_afiliado']."' and cedula='".$_SESSION['ced_afiliado']."' and persona_nivel_instruccion.id ='".$_GET['id_po']."'";
				$rs1 = $conn->Execute($SQL1);
				if ($rs1->RecordCount()>0){	
				$aDefaultForm['cbNivel_academico']=$rs1->fields['nivel'];
				$aDefaultForm['cbCarrera']=$rs1->fields['carrera'];
				$aDefaultForm['cbGraduado']=$_POST['graduado'];
				$aDefaultForm['titulo']=$rs1->fields['titulo'];
				$aDefaultForm['cbRegimen']=$rs1->fields['regimen'];
				$aDefaultForm['cbUltimo_aprobado']=$rs1->fields['ultimo_periodo'];
				$aDefaultForm['cbTotal']=$rs1->fields['total_periodo'];
				$aDefaultForm['f_finalizacion']=$rs1->fields['f_aprobacion'];
				$aDefaultForm['instituto']=$rs1->fields['instituto_uni'];
				$aDefaultForm['Observaciones_educacion']=$rs1->fields['observaciones'];
				}
			}

?>
		 <script>document.location="1_5agen_trab_educacion.php";</script>
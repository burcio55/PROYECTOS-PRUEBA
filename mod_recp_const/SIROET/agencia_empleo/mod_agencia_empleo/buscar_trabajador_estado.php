<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug = false;
//var_dump($conn);
//include("../evita_injection.php");
//include("../verificar_session_url.php");

if(isset($_REQUEST['estado'])){
$estado=str_replace("'","",$_REQUEST['estado']);
$estado=str_replace(",","",$estado);
$estado=str_replace("-","",$estado);
$estado=htmlentities((trim($estado)));
}
//CUENTA TOTAL DE REGISTROS ENCONTRADOS
$SQLL= "select personas.*
				From personas
				left JOIN estado ON estado.id=personas.estado_residencia 
		where personas.status='A' and personas.estado_residencia = '".$_POST['estado']."' order by personas.id";
		$rs1 = $conn->Execute($SQLL);
			
			if ($rs1->RecordCount()>0){ 
				while(!$rs1->EOF){
					$aTablaa[]=array();
					$dd= count($aTablaa);

					$rs1->MoveNext();
				}
			}
			$totl= $dd;
			
		$SQL= "select 
				personas.id as id_afiliado, 
				personas.nombres, 
				personas.apellidos, 
				personas.cedula, 
				personas.nacionalidad, 
				personas.sexo, 
				personas.edad, 
				personas.f_nacimiento, 
				personas.created_at, 
				personas.migrante, 
				personas.discapacidad, 
				personas.consejo_com,
				ocupacion.nombre as ocupacion1, 
				estado.nombre as estado,
				municipio.nombre as municipio,
				parroquia.nombre as parroquia
				From public.personas 
				left JOIN estado ON estado.id=personas.estado_residencia 
				left JOIN municipio ON municipio.id=personas.municipio_id 
				left JOIN parroquia ON parroquia.id=personas.parroquia_id
				left JOIN persona_pref_ocupacion ON persona_pref_ocupacion.persona_id=personas.id
				left JOIN ocupacion ON ocupacion.cod=persona_pref_ocupacion.ocupacion5_1
		where personas.status='A' and personas.estado_residencia = '".$_POST['estado']."' order by personas.id";
		
			$rs = $conn->Execute($SQL);
			$_SESSION['EOF1']=$rs->RecordCount();	
			if ($rs->RecordCount()>0){	
				while(!$rs->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;
					
					$aTabla[$c]['id']=$rs->fields['id_afiliado'];
					$aTabla[$c]['nombres']=$rs->fields['nombres'];
					$aTabla[$c]['apellidos']=$rs->fields['apellidos'];
					$aTabla[$c]['cedula']=$rs->fields['cedula'];
					$sexo=$rs->fields['sexo'];	 
					if($sexo=='2') $aTabla[$c]['sexo']='M';
					if($sexo=='1') $aTabla[$c]['sexo']='F';	
					$aTabla[$c]['edad']=$rs->fields['edad'];
					$aTabla[$c]['ocupacion1']=$rs->fields['ocupacion1'];	
					$rs->MoveNext();
		            }
	           }
			    $_SESSION['aTabla'] = $aTabla;


if ($rs->RecordCount()>0){	
?>


<script type="text/javascript">
				// Create the chart
				Highcharts.chart('reporte_por_estado', {
				    chart: {
				        type: 'column'
				    },
				    lang: {
				        downloadCSV:"Descarga CSV Imagen Vector",  
				        downloadJPEG:"Descargar JPEG",
				        downloadPDF:"Descargar Documento PDF",
				        downloadPNG:"Descargar Imagen PNG",
				        downloadSVG:"Descargar SVG",
				        downloadXLS:"Descargar XLS",
				        printChart:"Imprimir Gráfico",
				        viewData:"Ver Tabla de Datos",
				        viewFullscreen:"Ver en Pantalla Completa",
				        drillUpText:"◁ Regresar a {series.name}"
				    },
				    title: {
				        text: 'Reporte de Trabajadores'
				    },
				    subtitle: {
				        text: 'Haga Click en la Gráfica para ver Detalles <br>(Total:</br> <?php echo $totl;?> Trabajadores)'
				    },
				    accessibility: {
				        announceNewData: {
				            enabled: true
				        }
				    },
				    xAxis: {
				        type: 'category',
				        labels: {
				                rotation: -45,
				                style: {
				                    fontSize: '13px',
				                    fontFamily: 'Verdana, sans-serif'
				                }
				            }
				    },
				    yAxis: {
				        title: {
				            text: 'Trabajadores'
				        }

				    },
				    legend: {
				        enabled: false
				    },
				    plotOptions: {
				        series: {
				            borderWidth: 0,
				            dataLabels: {
				                enabled: true,
				                format: '{point.y:1f}%'
				            }
				        }
				    },

				    tooltip: {
				         headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            			 pointFormat: '<span style="color:{point.color}">{point.name}</span>'
				    },

				   
				      series: [{
				            name: "TRABAJADOR",
				            colorByPoint: true,
				            data: [ <?php for($r=0;$r<($totl);$r++){ ?>{
				                name: "<?php echo $aTabla[$r]['nombres']?>",
				                y: <?php echo 1 ?>,
				                drilldown: "<?php if($totl>0){echo $aTabla[$r]['nombres']; }else{null;} ?>"
				            }, <?php }?> ]
				      
				        }],
				    drilldown: {
				        series: [
				            <?php for($x=0;$x<($totl);$x++){ ?>{ 
				                name: "<?php echo 'Cedula: '.$aTabla[$x]['cedula'].' Nombre: '.$aTabla[$x]['nombres'].' '.$aTabla[$x]['apellidos'].' Sexo: '.$aTabla[$x]['sexo'].' Edad: '.$aTabla[$x]['edad'].' Cargo: '.$aTabla[$x]['ocupacion1']?>",
				                id: "<?php echo $aTabla[$x]['nombres']?>",
				                data: [

				                    [
				                        "<?php echo $aTabla[$x]['nombres']; ?>",
				                         1,
				                    ],
				                ]
				            }, <?php }?>
				            
				        ]
				    }
				});
				</script>
<?php
}else{
	$valor="no_encontrado";
	echo $valor;
}
?>
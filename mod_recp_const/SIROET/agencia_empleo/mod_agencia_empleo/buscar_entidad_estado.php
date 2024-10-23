<?php
session_start();
ini_set("display_errors",0);
error_reporting(E_ALL | E_STRICT);
include('../include/header.php');
$conn= getConnDB($db1);
$conn->debug = false;

include("../evita_injection.php");
include("../verificar_session_url.php");

if(isset($_REQUEST['estado'])){
$estado=str_replace("'","",$_REQUEST['estado']);
$estado=str_replace(",","",$estado);
$estado=str_replace("-","",$estado);
$estado=htmlentities((trim($estado)));
}
//CONTADOR TOTAL DE REGISTROS POR CADA MUNICIPIO
$SQLL="select empresa_instituto.* 
	  		from empresa_instituto
			left JOIN municipio ON empresa_instituto.municipio_id=municipio.id
			where empresa_instituto.status='A'  and empresa_instituto.estado_id = '".$_POST['estado']."' order by  empresa_instituto.id";
			$rs1 = $conn->Execute($SQLL);
			
			if ($rs1->RecordCount()>0){ 
				while(!$rs1->EOF){
					$aTablaa[]=array();
					$dd= count($aTablaa);

					$rs1->MoveNext();
				}
			}
			$totl= $dd;
			
$SQL="select distinct empresa_instituto.*, empresa_instituto.id as empresa_id, 
	  		estado.nombre as estado, sector_empleo.nombre as sector, p_juridica.nombre as p_juridica
			from empresa_instituto 
			left JOIN estado ON empresa_instituto.estado_id=estado.id
			left JOIN sector_empleo ON empresa_instituto.sector_empleo_id=sector_empleo.id
			left JOIN p_juridica ON empresa_instituto.p_juridica_id=p_juridica.id
			where empresa_instituto.status='A'  and empresa_instituto.estado_id = '".$_POST['estado']."' order by  empresa_instituto.id";
			$rs = $conn->Execute($SQL);
			$_SESSION['EOF1']=$rs->RecordCount();
			if ($rs->RecordCount()>0){	
				while(!$rs->EOF){
					$aTabla[]=array();
					$c = count($aTabla)-1;
					
					$aTabla[$c]['id']=$rs->fields['empresa_id'];
					$aTabla[$c]['nombre']=$rs->fields['nombre'];
					$aTabla[$c]['rif']=$rs->fields['rif'];
					$aTabla[$c]['act_eco']=$rs->fields['act_eco'];
					$aTabla[$c]['sector']=$rs->fields['sector'];
					$aTabla[$c]['p_juridica']=$rs->fields['p_juridica'];	
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
				        text: 'Reporte de Entidades de Trabajo'
				    },
				    subtitle: {
				        text: 'Haga Click en la Grafica para ver Detalles <br>(Total:</br> <?php echo $totl;?> Entidades de Trabajo)'
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
				            text: 'Entidades de Trabajo'
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
				            name: "ENTIDAD DE TRABAJO",
				            colorByPoint: true,
				            data: [ <?php for($r=0;$r<($totl);$r++){ ?>{
				                name: "<?php echo $aTabla[$r]['nombre']?>",
				                y: <?php echo 1 ?>,
				                drilldown: "<?php if($totl>0){echo $aTabla[$r]['nombre']; }else{null;} ?>"
				            }, <?php }?> ]
				      
				        }],
				    drilldown: {
				        series: [
				            <?php for($x=0;$x<($totl);$x++){ ?>{ 
				                name: "<?php echo 'Rif:'.$aTabla[$x]['rif'].' Razon Social:'.$aTabla[$x]['nombre']. '('.$aTabla[$x]['p_juridica'].')'.' Sector:'.$aTabla[$x]['sector']?>",
				                id: "<?php echo $aTabla[$x]['nombre']?>",
				                data: [

				                    [
				                        "<?php echo $aTabla[$x]['nombre']; ?>",
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
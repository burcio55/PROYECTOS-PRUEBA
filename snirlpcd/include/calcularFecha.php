<?php
class calcularFecha
{
	function sumarDias($numdias, $date) 
	{
		list($hora, $min, $seg, $dia, $mes, $anno) =explode( " ",date( "H i s d m Y"));
		$d = $dia + $numdias;
		$fecha = date("d-m-Y", mktime($hora, $min, $seg, $mes, $d, $anno));
		
		return $fecha;
	} 
	
	function calcula_numero_dia_semana($dia,$mes,$ano)
	{ 
		$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano)); 
		if ($numerodiasemana == 0) $numerodiasemana = 6; 
		else $numerodiasemana--; 
	
		return $numerodiasemana; 
	}
	
	function calcular_feriado($feriado) 
	{
		$arreglo_fecha[0] = "01-01";
		$arreglo_fecha[1] = "27-02";
		$arreglo_fecha[2] = "13-04";
		$arreglo_fecha[3] = "14-04";
		$arreglo_fecha[4] = "19-04";	
		$arreglo_fecha[5] = "01-05";	
		$arreglo_fecha[6] = "24-06";
		$arreglo_fecha[7] = "05-07";	
		$arreglo_fecha[8] = "24-07";		
		$arreglo_fecha[9] = "12-10";		
		$arreglo_fecha[10] = "25-12";
	
		$verificar = 0;
	
		for ($j=0;$j<3;$j++)
		{
			if  (($arreglo_fecha[$j]) == $feriado) $verificar = 1;
		}
	
		return $verificar;                       
	}
	
	function Calcular()
	{
		$fecha_actual= time();
		$fecha_hoy = date("d-m-Y");
		$k = 0;
		$i = 0;
		
		while ($i <= 14)
		{
			$fecha_actual= $this->SumarDias ($k,$fecha_actual);
			$fecha_nueva= split ("-",$fecha_actual);
			$dia = $fecha_nueva[0];
			$mes= $fecha_nueva[1];
			$ano= $fecha_nueva[2];
			$fecha_actual= $this->SumarDias ($k,$fecha_actual);
			$fecha_nueva= split ("-",$fecha_actual);
			$dia = $fecha_nueva[0];
			$mes= $fecha_nueva[1];
			$ano= $fecha_nueva[2];
			$dia_semana = $this->calcula_numero_dia_semana ($dia,$mes,$ano);
		
			if  ($dia_semana == 5) $k = $k + 2;
		
			if  ($dia_semana == 6) $k = $k + 1; 
		
			if  (($dia_semana !=5) and ($dia_semana !=6))
			{           
			   $verificador = $this->calcular_feriado($dia."-".$mes);
		
			   if ($verificador == 1) $k = $k + 1;
			   else
			   {
				   $k = $k + 1;
				   $i =$i +1; 
			   }           
			}
		}
		return $fecha_actual;
	}	
}
?>

<?php
include("Control.php");
if (!defined("ControlSolvencia.php"))
{
	define("ControlSolvencia.php","1",true);
	
	class ControlSolvencia extends Control
	{
		function getCodigoSolicitud($sDpt, &$conn)
		{
			
			$dFecha = getdate( date('U') );
			/*print "<script> alert ('Fecha= .$dFecha')</script>";*/
			$sCodigoSolicitud = '';
			
			$sql = "SELECT dptunidadsustantiva.sUnidadSustantiva, unidadsustantiva.nUnidadSustantiva FROM dptunidadsustantiva,unidadsustantiva 
			WHERE dptunidadsustantiva.sunidadsustantiva = unidadsustantiva.sUnidadSustantiva AND dptunidadsustantiva.sdpt = '$sDpt'";
			
			
			$rs = &$conn->Execute( $sql );
			if ( $rs->RecordCount() > 0 )
			{
				$sUnidadSustantiva = $rs->fields['sUnidadSustantiva'];
			
				/*print "<script> alert ('unidadsustantiva= $sUnidadSustantiva')</script>";*/
				$nUnidadSustantiva = $rs->fields['nUnidadSustantiva'];
/*
			//si retorna 1000 esta deshabilitado en la tabla control por alguna caida del servidor web asi que pregunto por el numero de control para esa unidad
			$nControl = parent::IsExist( $sUnidadSustantiva,'sSolicitudSolvencia',$dFecha['year'],$conn ); 
			//si senabled es 0 lo llevo a 1 -----> hector mata 2012-08-29
			$enabled = parent::setEnabled('1',$nControl,$conn);			 
*/
			$nControlValue = parent::getControlByYear( 'sSolicitudSolvencia',$sUnidadSustantiva,$conn );
			/*print "<script> alert ('valor control= .$nControlValue')</script>";*/
			
			if ($nControlValue==1000)
				{
				print "<script> alert ('Comuniquese con el centro de control de solvencias e informe este codigo de error: $sUnidadSustantiva')</script>"; 
				print "<script>document.location='../vista.php'</script>";
				}
			$sCodigoSolicitud = str_pad( $nUnidadSustantiva,3,'0',STR_PAD_LEFT )."-".$dFecha['year']."-10-".str_pad( $nControlValue,5,'0',STR_PAD_LEFT );
			//print "<script> alert ('$sCodigoSolicitud')</script>";
			}
			/*if ($sCodigoSolicitud = '')
				
				{
				print "esta vacio";
				}*/
				//$sCodigoSolicitud= '100';
			return $sCodigoSolicitud;
		}
	}
}
?>

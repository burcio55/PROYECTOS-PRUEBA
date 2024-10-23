<?php
if (!defined("RNEE_COMMON"))
{
	function getEstablecimiento($nRnee,$conn)
	{
		$sSQL = "select nEstablecimiento from rnee where nRnee=".$nRnee;
		$rs = &$conn->Execute($sSQL);	
		$nEmpresa = $rs->fields['nEstablecimiento'];
		$sSQL = "select nEstablecimiento from pre_relestabempresa where nEmpresa = ".$nEmpresa;
		$rs = &$conn->Execute($sSQL);	
		return 	$rs->fields['nEstablecimiento'];
	}
	
	function InAlphabet($sLetter)
	{
		$aAlphabet = array();
		$aAlphabet['A'] = 'A';
		$aAlphabet['B'] = 'B';
		$aAlphabet['C'] = 'C';
		$aAlphabet['D'] = 'D';
		$aAlphabet['E'] = 'E';
		$aAlphabet['F'] = 'F';
		$aAlphabet['G'] = 'G';
		$aAlphabet['H'] = 'H';
		$aAlphabet['I'] = 'I';
		$aAlphabet['J'] = 'J';
		$aAlphabet['K'] = 'K';
		$aAlphabet['L'] = 'L';
		$aAlphabet['LL'] = 'LL';		
		$aAlphabet['M'] = 'M';
		$aAlphabet['N'] = 'N';
		$aAlphabet['Ñ'] = 'Ñ';
		$aAlphabet['O'] = 'O';
		$aAlphabet['P'] = 'P';		
		$aAlphabet['Q'] = 'Q';
		$aAlphabet['S'] = 'S';
		$aAlphabet['R'] = 'R';
		$aAlphabet['T'] = 'T';
		$aAlphabet['U'] = 'U';
		$aAlphabet['V'] = 'V';
		$aAlphabet['W'] = 'W';
		$aAlphabet['X'] = 'X';
		$aAlphabet['Y'] = 'Y';
		$aAlphabet['Z'] = 'Z';
		/*
		for ($i=0;$i < count($aAlphabet); $i++)
		{
			if (strtoupper($sLetter) == $aAlphabet[$i]){
				return true;
			}
		}*/
		if (isset($aAlphabet[strtoupper($sLetter)])){
			return true;
		}else{
			return false;
		}
	}
	/**********************************************************************************/
	/*************RESGITRO DE EMPRESA**************************************************/
	/********inserta en: rnee_empresa, rnee_establecimiento,pre_relestaempresa********************/
	/**********************************************************************************/
	function crear_empresa($sNombre,$sRif,$conn)//RETORNA nEmpresa [0] y nEstablecimiento [1] True o false [2]
	{
		/*validar si ya existe*/
		$valores= array();
		$valores[2]=true;
		$valores['success']=true;
		$sNombre=str_replace("'","",$sNombre);
		$sSQL = "select nEmpresa from pre_relestabempresa where UCASE(sRif)='".$sRif."'";
		$rs = &$conn->Execute($sSQL);
		if($rs->RecordCount()>0)
		{
			$valores[2] = false;
			$valores['success'] = false;
			return $valores;
		}
		/*Es valido se puede crear*/
		if($valores[2])
		{
			$conn->Execute("begin");
			$sSQL = "insert into rnee_empresa (sEmpresa) values (ucase('".$sNombre."'))";
			$rs = &$conn->Execute($sSQL);
			if ($conn->Affected_Rows()>0)
			{
				$nEmpresa=$conn->Insert_ID();
	
				$sql = "insert into rnee_establecimiento (nEmpresa,sEstablecimiento)
				values(".$nEmpresa.",'".$sNombre."')";
				$conn->Execute($sql);
				if($conn->Affected_Rows()>0)
				{
					$nEstablecimiento=$conn->Insert_ID();					
					$sql = "INSERT INTO pre_relestabempresa (nEstablecimiento,nEmpresa,sRif)
					VALUES(".$nEstablecimiento.",".$nEmpresa.",'".$sRif."')";
					$conn->Execute($sql) ;		
					if($conn->Affected_Rows()>0)
					{
						$valores[0]=$nEmpresa;
						$valores['empresa']=$nEmpresa;						
						$valores[1]=$nEstablecimiento;
						$valores['establecimiento']=$nEstablecimiento;						
						$conn->Execute("commit");
					}else
					{
						$valores[2]=false;
						$valores['success']=false;					
						$conn->Execute("rollback");
					}
				}else
				{
					$valores[2]=false;
					$valores['success']=false;				
					$conn->Execute("rollback");
				}
	
			}
		}
		return $valores;
	}
	/*************ELIMINA  EMPRESA**************************************************/
	function elimina_empresa($nEmpresa,$conn)
	//si pudo eliminar si=true, no=false
	{
		/*VALIDA*/
		$valido=true;
		$sSQL = "select nEstablecimiento from rnee where nEstablecimiento=".$nEmpresa;
		$rs = &$conn->Execute($sSQL);
		if($rs->RecordCount()>0)
		{
			$valido=false;
		}
		$sSQL = "select nEmpresa from sin_empresa where nEmpresa=".$nEmpresa;
		$rs = &$conn->Execute($sSQL);
		if($rs->RecordCount()>0)
		{
			$valido=false;
		}
		if($valido)
		{
			$conn->Execute("begin");
			$sSQL="delete from rnee_login where nEmpresa =".$nEmpresa;
			$rs = &$conn->Execute($sSQL);
			if ($conn->Affected_Rows()>0)
			{
				$sSQL = "delete from rnee_empresa where nEmpresa=".$nEmpresa;
				$rs = &$conn->Execute($sSQL);
				if ($conn->Affected_Rows()>0)
				{
					$sql = "delete from rnee_establecimiento where nEmpresa=".$nEmpresa;
					$conn->Execute($sql);
					if($conn->Affected_Rows()>0)
					{
						$sql = "delete from  pre_relestabempresa where nEmpresa=".$nEmpresa;
						$conn->Execute($sql) ;	
						$conn->Execute("commit");	
					}else
					{
						$conn->Execute("rollback");
					}
		
				}else
				{
					$conn->Execute("rollback");
				}
			}
		}
		return $valido;

	}
	define('RNEE_COMMON',1);
}
?>
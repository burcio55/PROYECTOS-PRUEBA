<?php
if (!defined("../Control.php"))
{
	define("Control.php","1",true);
	
	class Control{
		var $sColumnName;
		var $sUnidadSustantiva;
		var $sAno = '';
		var $nValue;
		var $sEnabled = 0;
		var $nTimeLimit = 1000;
		//DATABASE-MANAGMENT
		var $db; 	//DATABASE-CONNECTION-REFERENCE
		var $sql;		//QUERY-STORAGE
		var $rowAffected; //ROW-AFFECTED
		
		function Control( &$db,$sColumnName,$sUnidadSustantiva,$nValue,$sAno ='' )
		{
			$this->sColumnName = $sColumnName;
			$this->sUnidadSustantiva = $sUnidadSustantiva;
			$this->nValue = $nValue;
			$this->sAno = $sAno;
			$this->sEnabled = '1';
			$this->db	= $db;
		}
		
		function Add()
		{
			$this->sql	= "insert into control(sColumnName, sUnidadSustantiva, nValue, sAno, sEnabled) values ("
						  ."'".$this->sColumnName."','".$this->sUnidadSustantiva."',".$this->nValue.",'"
						  .$this->sAno."','".$this->sEnabled."')";
			$this->Query();
		}
		
		function IsExist( $sUnidadSustantiva, $sColumnName, $sAno = '',&$db = null )
		{
			$nControl = 0;
			$self->sql = "select nControl from control "
						 ."where sColumnName = '".$sColumnName."' AND sUnidadSustantiva = '".$sUnidadSustantiva."'";
			if ( $sAno != '' ) 
			{
				$self->sql .= " AND sAno = '".$sAno."'";
			}
			
			if ( $db==null ) 
			{
				$rs = &$this->db->Execute( $self->sql );
			}else{
				$rs = &$db->Execute( $self->sql );
			}			
			
			if ( $rs->RecordCount() > 0 )
			{
				$nControl = $rs->fields['nControl'];
			}
			/*print "<script> alert ('Numero de control $nControl')</script>";*/
			return $nControl;
		}
		
		function getEnabled( $nControl,&$db = null )
		{
			$sEnabled = '0';
			$self->sql = "select sEnabled from control "
						 ."where nControl = ".$nControl;
			if ( $db==null ) 
			{
				$rs = &$this->db->Execute( $self->sql );
			}else{
				$rs = &$db->Execute($self->sql);
			}
			
			if ( $rs->RecordCount() > 0 )
			{			
				$sEnabled = $rs->fields['sEnabled'];
			}		
			/*print "<script> alert ('enabled $sEnabled')</script>";*/
			if ( $sEnabled != '0' ) 
					{
					/*print "<script> alert ('true')</script>";*/
					return true;
					}
			else
					{
						/*print "<script> alert ('false')</script>";*/
						return false;
					}
		}
		
		function setEnabled( $sEnabled='1', $nControl,&$db = null )
		{
			$self->sql = "update control set sEnabled = '".$sEnabled."' where nControl = ".$nControl;
			if ( $db==null ) {
				return $this->Query($self->sql);
			}else{
				$db->Execute($self->sql);
				if ( $db->Affected_Rows() > 0 )
				{
					return true;
				}else{
					return false;
				}
			}
		}
		
		function setValue( $nValue, $nControl,&$db = null )
		{
			$self->sql = "update control set nValue = '".$nValue."' where nControl = ".$nControl;
			if ($db==null) {
				return $this->Query($self->sql);
			}else{
				$db->Execute($self->sql);
				if ( $db->Affected_Rows() > 0 )
				{
					return true;
				}else{
					return false;
				}
			}
		}
		
		function getValue( $nControl,&$db = null )
		{
			$nValue = 0;
			$self->sql = "select nValue from control "
						 ."where nControl = ".$nControl;
			if ($db==null) {
				$rs = &$this->db->Execute( $self->sql );
			}else{
				$rs = &$db->Execute( $self->sql );
			}
			if ( $rs->RecordCount() > 0 )
			{
				$nValue = $rs->fields['nValue'];	
			}			
			return $nValue;		
		}
		
		function getTimeLimit()
		{
			return 1000;
		}
		
		function getControlByYear( $sColumnName,$sUnidadSustantiva,&$db )
		{
			$dFecha = getdate( date('U') );
			$nControlValue = 0;
			$nControl = Control::IsExist( $sUnidadSustantiva,$sColumnName,$dFecha['year'],$db );
			/*print "<script> alert ('ncomtrol si existe $nControl')</script>";*/
			if ( $nControl == 0 ) {
				$oControl = new Control( $db,$sColumnName,$sUnidadSustantiva,1,$dFecha['year'] );
				$oControl->Add();
				$nControlValue = 1;
			}else{
				if ( Control::getEnabled( $nControl,$db ) ) {
					Control::setEnabled( '0',$nControl,$db );
					$nControlValue = Control::getValue( $nControl,$db )+1;
					Control::setValue( $nControlValue,$nControl,$db );
					Control::setEnabled( '1',$nControl,$db );
				}else{
					$nTime = control::getTimeLimit();
					$nTimePassed = 0;
					while($nTimePassed <= $nTime){
						if (Control::getEnabled($nControl,$db)) 
							{
								Control::setEnabled('0',$nControl,$db);
								$nControlValue = Control::getValue($nControl,$db)+1;
								/*print "<script> alert ('valor del numero de control $nControlValue')</script>";*/
								Control::setValue($nControlValue,$nControl,$db);
								Control::setEnabled('1',$nControl,$db);
							}
						else 
							{
							return 1000;
							
							}
						$nTimePassed++;
					} 
				}
			}
			return $nControlValue;
			
		}
		function Query()
		{
			$this->db->Execute($this->sql);
			$this->rowAffected = $this->db->Affected_Rows();
			if ($this->rowAffected != 0) {
				return true;
			}else{
				return false;
			}			
		}	
	}
}
?>
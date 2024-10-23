<?php
include('../include/header.php');

class Trazas{

function auditor($id,$identi,$sql,$us,$mod){ 
$this->id=$id;
$this->identi=$identi;
$this->sql=str_replace("'","",$sql);
$this->us=$us;
$this->mod=$mod;
$this->fecha=date('Y-m-d H:i:s');
$this->ip = $_SERVER['REMOTE_ADDR']; 
$this->conn = getConnDB('sire');

$this->sqlau="insert into public.trazas 
		   (tabla_id, 
		    consulta, 
			fecha,
			usuario_id,
			modulo,
			ip,
			identi) values
		   ('".$this->id."',
		    '".$this->sql."',
		    '".$this->fecha."',
			'".$this->us."',
		    '".$this->mod."',
		    '".$this->ip."',
		    '".$this->identi."')";
			$this->conn->Execute($this->sqlau);
		  // $this->Query($sqlau);  
		  //return $this->sqlau;
		   }
}
?>
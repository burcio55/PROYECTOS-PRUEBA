<?php
class DB
{
	var $host;
	var $user;
	var $pass;
	var $db;
	var $cn;
	var $rs;
	var $value;
	var $rows = array();
	// Se conecta a la base de datos	
	function connect($database,$host,$user,$pass)
	{
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->cn = mysql_connect($host,$user,$pass) or die("Error: DB.connect() > No pudo conectarse : ".mysql_error()." Llamada: ".basename($_SERVER['PHP_SELF']));
		
		$this->db = $database;
		mysql_select_db($database) or die("Error: DB.connect() > No pudo seleccionarse la BD. Llamada: ".basename($_SERVER['PHP_SELF']));
	}
	
	// Genera el conjunto de registros segun la sentencia sql
	function result($consulta)
	{	
		$this->connect($this->db,$this->host,$this->user,$this->pass);
		
		$this->rs = mysql_query($consulta,$this->cn) or die("Error: DB.result() > La consulta fall&oacute;: " . mysql_error()." Llamada: ".basename($_SERVER['PHP_SELF']));
		return $this->rs;
	}
	
	//Ejecuta una consulta de accion en la BD y devuelve los registros afectados
	function query($consulta)
	{	
		$this->connect($this->db,$this->host,$this->user,$this->pass);

		$this->rs = mysql_query($consulta) or die("Error: DB.query() > La consulta fall&oacute;: " . mysql_error()." Llamada: ".basename($_SERVER['PHP_SELF']));
		return mysql_affected_rows();
	}
	
	// Genera un valor(Numerico...) segun la sentencia sql, 
	// diseñado para las sentencias con funciones escalares como MAX, COUNT, ETC..
	function resultScalar($consulta,$scalar='',$table='')
	{
		$nValue = 0;
		$this->connect($this->db,$this->host,$this->user,$this->pass);
	
		$this->rs = mysql_query($consulta) or die("Error: DB.resultScalar() > La consulta fall&oacute;: " . mysql_error()." Llamada: ".basename($_SERVER['PHP_SELF']));		
		while ($row = mysql_fetch_array($this->rs))
		{   
			$this->value = $row[0];
			$nValue = $this->value;
		}
		return $nValue;
	}
	
	// Genera un arreglo de registros segun la sentencia sql
	function getCatalog($sCatalog)
	{
		$this->connect($this->db,$this->host,$this->user,$this->pass);
	
		$this->rs = mysql_query('select * from '.$sCatalog) or die("Error: DB.getCatalog() > La consulta fall&oacute;: " . mysql_error()." Llamada: ".basename($_SERVER['PHP_SELF']));
		while ($row = mysql_fetch_array($this->rs))
		{   
			$rows[$row[0]] = $row[1];
		}
		return $rows;
	}
	
	// Elimina el objeto de registros
	function closeResult()
	{
		mysql_free_result($this->rs);
	}
	
	// Cierra la conexion
	function disconnect()
	{
		mysql_close($this->cn);
	}
}
?>
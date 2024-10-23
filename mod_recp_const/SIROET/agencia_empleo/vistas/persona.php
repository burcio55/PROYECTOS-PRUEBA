<?php 
	/*
	*
	*/
	class Persona{
		
		private $nac;
		private $doc;
		private $nombres;
		private $apellidos; 
		private $sexo;
		private $nacimiento;
		private $telefono;
		private $mail;

		public function getNac(){
			return $this->nac;
		}

		public function setNac($nac){
			$this->nac = $nac;
		}

		public function getDoc(){
			 return $this->doc;
		}

		public function setDoc($doc){
			$this->doc = $doc;
		}

		public function getNombres(){
			return $this->nombres;
		}

		public function setNac($nombres){
			$this->nombres = $nombres;
		}

		public function getApellidos(){
			return $this->apellidos;
		}

		public function setApellidos($apellidos){
			$this->apellidos = $apellidos;
		}

		public function getSexo(){
			return $this->sexo;
		}

		public function setSexo($sexo){
			$this->sexo = $sexo;
		}
		public function getNacimiento(){
			return $this->nacimiento;
		}

		public function setNacimiento($nacimiento){
			$this->nacimiento = $nacimiento;
		}
		public function getTelefono(){
			return $this->telefono;
		}

		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function getMail(){
			return $this->mail;
		}

		public function setMail($mail){
			$this->mail = $mail;
		}
	
	}
?>
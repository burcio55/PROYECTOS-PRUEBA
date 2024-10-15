<?php 
	/*
	*
	*
	*/
	class Usuario{
		private $id;
		private $nac;
		private $doc;
		private $clave;
		private $nombre; 
		private $apellido;
		private $tipousuario;

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function setNac($nac){
			$this->id = $nac;
		}

		public function getNac(){
			return $this->nac;
		}

		public function setDoc($doc){
			$this->doc = $doc;
		}

		public function getDoc(){
			return $this->doc;
		}

		public function getClave(){
			return $this->clave;
		}

		public function setClave($clave){
			$this->clave = $clave;
		}


		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getApellido(){
			return $this->apellido;
		}

		public function setApellido($apellido){
			$this->apellido = $apellido;
		}

		public function getTipoUsuario(){
			return $this->tipousuario;
		}
        public function setTipoUsuario($tipousuario){
			$this->tipousuario = $tipousuario;
		}
	
	}
?>
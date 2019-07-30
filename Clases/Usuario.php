<?php 

	class registro{
		private $idusuario;
		private $nombre;
		private $apellido;
		private $correo;
		private $password;

		public function __construct($idusuario,$nombre,$apellido,$correo,$password){
			$this->idusuario=$idusuario;
			$this->nombre=$nombre;
			$this->apellido=$apellido;
			$this->correo=$correo;
			$this->password=$password;
		}

		public function getIduser(){
			return $this->$idusuario;
		}
		public function setIduser($idusuario){
			$this->idusuario=$idusuario;
		}

		public function getNombreuser(){
			return $this->$nombre;
		}
		public function setNombreuser($nombre){
			$this->nombre=$nombre;
		}
		public function getApellidoUser(){
			return $this->$apellido;
		}
		public function setApellidouser($apellido){
			$this->apellido=$apellido;
		}
		public function getCorreouser(){
			return $this->$correo;
		}
		public function setCorreouser($correo){
			$this->correo=$correo;
		}
		public function getPassuser(){
			return $this->$password;
		}
		public function setPassuser($password){
			$this->password=$password;
		}
		
		public function __toString(){
			return "idusuario".$this->idusuario.
			"nombre".$this->nombre.
			"apellido".$this->apellido.
			"correo".$this->correo.
			"password".$this->password;
		}

		public function registrar($conexion){

			$consulta = sprintf("INSERT INTO tbl_usuario(nombre,apellido,correo,password,tipousuario) VALUES ('%s','%s','%s','%s','%s')",
				$conexion->antiInyeccion($this->nombre),
				$conexion->antiInyeccion($this->apellido),
				$conexion->antiInyeccion($this->correo),
				$conexion->antiInyeccion($this->password),
				$conexion->antiInyeccion("1")
				);
			$resultado=$conexion->ejecutarconsulta($consulta);
		}


	}
 ?>
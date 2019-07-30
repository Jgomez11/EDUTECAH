
<?php
	class Conexion{
		private $host = "localhost";
		private $usuario = "root";
		private $password = "";
		private $baseDatos = "emprendefacil";
		private $puerto = 3306;
		private $link;

		public function __construct(){
			$this->link = mysqli_connect(
				$this->host,
				$this->usuario,
				$this->password,
				$this->baseDatos,
				$this->puerto
			);
		}

		public function ejecutarConsulta($sql){
			return mysqli_query($this->link, $sql);
		}

		public function mysql_set_charset($charset){
			return mysqli_set_charset($this->link, $charset); 
		}

		public function ip(){
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
				return $_SERVER['HTTP_CLIENT_IP'];
	
			}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
				return $_SERVER['REMOTE_ADDR'];
			}
		}


		public function obtenerFila($resultado){
			return mysqli_fetch_array($resultado);
		}

		public function cerrarConexion(){
			mysqli_close($this->link);
		}

		public function getLink(){
			return $this->link;
		}

		public function antiInyeccion($texto){
			return mysqli_real_escape_string($this->link, $texto);
		}

		public function ultimoId(){
			return mysqli_insert_id($this->link);
		}

		public function cantidadRegistros($resultado){
			return mysqli_num_rows($resultado);
		}
	}


?>
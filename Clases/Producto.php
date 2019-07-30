<?php
 class Producto{
		private $idProducto;
		private $nombreProducto;
		private $descripcion;
		private $precioActual;
		private $precioAnterior;
		private $valoracion;
		private $imagenPrincipal;
		private $cantidad;
		private $idEstado;
		private $idColor;
		private $idCategoria;
		private $idProveedor;
		private $idMoneda;

		public function __construct($idProducto,$nombreProducto,$descripcion,$precioActual,$precioAnterior,$valoracion,$imagenPrincipal,$cantidad,$idEstado,$idColor,$idCategoria,$idProveedor,$idMoneda){
			$this->idProducto=$idProducto;
			$this->nombreProducto=$nombreProducto;
			$this->descripcion=$descripcion;
			$this->precioActual=$precioActual;
			$this->precioAnterior=$precioAnterior;
			$this->valoracion=$valoracion;
			$this->cantidad=$cantidad;
			$this->imagenPrincipal=$imagenPrincipal;
			$this->idEstado=$idEstado;
			$this->idColor=$idColor;
			$this->idCategoria=$idCategoria;
			$this->idProveedor=$idProveedor;
			$this->idMoneda=$idMoneda;
		}

		
		public function __toString(){
			return "idProducto".$this->idProducto.
			"nombreProducto".$this->nombreProducto.
			"descripcion".$this->descripcion.
			"precioActual".$this->precioActual.
			"precioAnterior".$this->precioAnterior.
			"valoracion".$this->valoracion.
			"imagenPrincipal".$this->imagenPrincipal.
			"cantidad".$this->cantidad.
			"idEstado".$this->idEstado.
			"idColor".$this->idColor.
			"idCategoria".$this->idCategoria.
			"idProveedor".$this->idProveedor.
			"idMoneda".$this->idMoneda;
		}

		public function agregar($conexion){
			$consulta=sprintf("INSERT INTO tbl_producto(NombreProducto, Descripcion, PrecioActual, PrecioAnterior, Valoracion, ImagenPrincipal, Cantidad,IDEstado, IDColor, IDCategoria, IDProveedor,IDMoneda) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
					$conexion->antiInyeccion($this->nombreProducto),
					$conexion->antiInyeccion($this->descripcion),
					$conexion->antiInyeccion($this->precioActual),
					$conexion->antiInyeccion("0"),
					$conexion->antiInyeccion("0"),
					$conexion->antiInyeccion($this->imagenPrincipal),
					$conexion->antiInyeccion($this->cantidad),
					$conexion->antiInyeccion("1"),
					$conexion->antiInyeccion($this->idColor),
					$conexion->antiInyeccion($this->idCategoria),
					$conexion->antiInyeccion($this->idProveedor),
					$conexion->antiInyeccion("HNL"));

			$resultado=$conexion->ejecutarconsulta($consulta);
		}


	}
 ?>
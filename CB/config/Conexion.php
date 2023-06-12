<?php 
require_once "global.php";

class Conexion{

	protected $conexion;
	protected $query;
	protected $tabla;

	public function __construct(){
		$this->conexion();
	}

	public function conexion(){
		$this->conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

		if ($this->conexion->connect_error) {
			die('error de conexión: '.$this->conexion->connect_error);
		}
	}
}
?>
<?php
require_once "../config/Conexion.php";

class Modelo extends Conexion{

	public function query($sql){
		$this->query = $this->conexion->query($sql);
		return $this;
	}

	public function get(){
		return $this->query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function primero(){
		return $this->query->fetch_assoc();
	}

	/******** CONSULTAS ********/

	public function todo(){
		$sql = "SELECT * FROM {$this->tabla}";
		return $this->query($sql)->get();
	}

	public function busqueda($id){
		$sql = "SELECT * FROM {$this->tabla} WHERE id = {$id}";
		return $this->query($sql)->primero();
	}
	public function busquedaFiltro($campos){
		$sql = "SELECT * FROM {$this->tabla} WHERE {$campos}";
		return $this->query($sql)->primero();
	}

	public function guardar($columna, $valores){
		$sql = "INSERT INTO {$this->tabla} ({$columna}) VALUES ({$valores})";
		$this->query($sql);
		return $this->conexion->insert_id;
	}

	public function eliminar($id){
		$sql = "DELETE FROM {$this->tabla} WHERE id = {$id}";
		$this->query($sql);
	}

	public function actualizar($id, $campos){
		$sql = "UPDATE {$this->tabla} SET {$campos} WHERE id = {$id}";
		$this->query($sql);
	}
}
?>
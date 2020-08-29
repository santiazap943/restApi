<?php
class ClienteDAO{
	private $idCliente;
	private $nombre;
	private $correo;

	function ClienteDAO($pIdCliente = "", $pNombre = "", $pCorreo = ""){
		$this -> idCliente = $pIdCliente;
		$this -> nombre = $pNombre;
		$this -> correo = $pCorreo;
	}

	function insert(){
		return "insert into Cliente(nombre, correo)
				values('" . $this -> nombre . "', '" . $this -> correo . "')";
	}

	function update(){
		return "update Cliente set 
				nombre = '" . $this -> nombre . "',
				correo = '" . $this -> correo . "'	
				where idCliente = '" . $this -> idCliente . "'";
	}

	function select() {
		return "select idCliente, nombre, correo
				from Cliente
				where idCliente = '" . $this -> idCliente . "'";
	}

	function selectAll() {
		return "select idCliente, nombre, correo
				from Cliente order by idCliente desc";
	}
}
?>

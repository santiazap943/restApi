<?php
require_once ("../persistence/ClienteDAO.php");
require_once ("../persistence/Connection.php");

class Cliente {
	private $idCliente;
	private $nombre;
	private $correo;
	private $clienteDAO;
	private $connection;

	function getIdCliente() {
		return $this -> idCliente;
	}

	function setIdCliente($pIdCliente) {
		$this -> idCliente = $pIdCliente;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getCorreo() {
		return $this -> correo;
	}

	function setCorreo($pCorreo) {
		$this -> correo = $pCorreo;
	}

	function Cliente($pIdCliente = "", $pNombre = "", $pCorreo = ""){
		$this -> idCliente = $pIdCliente;
		$this -> nombre = $pNombre;
		$this -> correo = $pCorreo;
		$this -> clienteDAO = new ClienteDAO($this -> idCliente, $this -> nombre, $this -> correo);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCliente = $result[0];
		$this -> nombre = $result[1];
		$this -> correo = $result[2];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> clienteDAO -> selectAll());
		$clientes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($clientes, new Cliente($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $clientes;
	}
}
?>

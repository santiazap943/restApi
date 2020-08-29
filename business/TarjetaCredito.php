<?php
require_once ("../persistence/TarjetaCreditoDAO.php");
require_once ("../persistence/Connection.php");

class TarjetaCredito {
	private $idTarjetaCredito;
	private $cvc;
	private $fechaVencimiento;
	private $cliente;
	private $tarjetaCreditoDAO;
	private $connection;

	function getIdTarjetaCredito() {
		return $this -> idTarjetaCredito;
	}

	function setIdTarjetaCredito($pIdTarjetaCredito) {
		$this -> idTarjetaCredito = $pIdTarjetaCredito;
	}

	function getCvc() {
		return $this -> cvc;
	}

	function setCvc($pCvc) {
		$this -> cvc = $pCvc;
	}

	function getFechaVencimiento() {
		return $this -> fechaVencimiento;
	}

	function setFechaVencimiento($pFechaVencimiento) {
		$this -> fechaVencimiento = $pFechaVencimiento;
	}

	function getCliente() {
		return $this -> cliente;
	}

	function setCliente($pCliente) {
		$this -> cliente = $pCliente;
	}

	function TarjetaCredito($pIdTarjetaCredito = "", $pCvc = "", $pFechaVencimiento = "", $pCliente = ""){
		$this -> idTarjetaCredito = $pIdTarjetaCredito;
		$this -> cvc = $pCvc;
		$this -> fechaVencimiento = $pFechaVencimiento;
		$this -> cliente = $pCliente;
		$this -> tarjetaCreditoDAO = new TarjetaCreditoDAO($this -> idTarjetaCredito, $this -> cvc, $this -> fechaVencimiento, $this -> cliente);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> tarjetaCreditoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> tarjetaCreditoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> tarjetaCreditoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idTarjetaCredito = $result[0];
		$this -> cvc = $result[1];
		$this -> fechaVencimiento = $result[2];
		$cliente = new Cliente($result[3]);
		$cliente -> select();
		$this -> cliente = $cliente;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> tarjetaCreditoDAO -> selectAll());
		$tarjetaCreditos = array();
		while ($result = $this -> connection -> fetchRow()){
			$cliente = new Cliente($result[3]);
			$cliente -> select();
			array_push($tarjetaCreditos, new TarjetaCredito($result[0], $result[1], $result[2], $cliente));
		}
		$this -> connection -> close();
		return $tarjetaCreditos;
	}

	function selectAllByCliente(){
		$this -> connection -> open();
		$this -> connection -> run($this -> tarjetaCreditoDAO -> selectAllByCliente());
		$tarjetaCreditos = array();
		while ($result = $this -> connection -> fetchRow()){
			$cliente = new Cliente($result[3]);
			$cliente -> select();
			array_push($tarjetaCreditos, new TarjetaCredito($result[0], $result[1], $result[2], $cliente));
		}
		$this -> connection -> close();
		return $tarjetaCreditos;
	}
}
?>

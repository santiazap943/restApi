<?php
class TarjetaCreditoDAO{
	private $idTarjetaCredito;
	private $cvc;
	private $fechaVencimiento;
	private $cliente;

	function TarjetaCreditoDAO($pIdTarjetaCredito = "", $pCvc = "", $pFechaVencimiento = "", $pCliente = ""){
		$this -> idTarjetaCredito = $pIdTarjetaCredito;
		$this -> cvc = $pCvc;
		$this -> fechaVencimiento = $pFechaVencimiento;
		$this -> cliente = $pCliente;
	}

	function insert(){
		return "insert into TarjetaCredito(idTarjetaCredito,cvc, fechaVencimiento, cliente_idCliente)
				values('" . $this -> idTarjetaCredito . "','" . $this -> cvc . "', '" . $this -> fechaVencimiento . "', '" . $this -> cliente . "')";
	}

	function update(){
		return "update TarjetaCredito set 
				cvc = '" . $this -> cvc . "',
				fechaVencimiento = '" . $this -> fechaVencimiento . "',
				cliente_idCliente = '" . $this -> cliente . "'	
				where idTarjetaCredito = '" . $this -> idTarjetaCredito . "'";
	}

	function select() {
		return "select idTarjetaCredito, cvc, fechaVencimiento, cliente_idCliente
				from TarjetaCredito
				where idTarjetaCredito = '" . $this -> idTarjetaCredito . "'";
	}

	function selectAll() {
		return "select idTarjetaCredito, cvc, fechaVencimiento, cliente_idCliente
				from TarjetaCredito";
	}

	function selectAllByCliente() {
		return "select idTarjetaCredito, cvc, fechaVencimiento, cliente_idCliente
				from TarjetaCredito
				where cliente_idCliente = '" . $this -> cliente . "'";
	}
}
?>

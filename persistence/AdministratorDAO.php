<?php
class AdministratorDAO{
	private $idAdministrator;
	private $email;
	private $password;
	
	function AdministratorDAO($pIdAdministrator = "", $pEmail = "", $pPassword = ""){
		$this -> idAdministrator = $pIdAdministrator;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		}

	function logIn($email, $password){
		return "select idAdministrator, email, password
				from Administrator
				where email = '" . $email . "' and password = '" . md5($password) . "'";
	}

	function insert(){
		return "insert into Administrator(email, password)
				values('" . $this -> email . "', md5('" . $this -> password . "'))";
	}

	function update(){
		return "update Administrator set 
				email = '" . $this -> email . "'
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	
	function existEmail($email){
		return "select idAdministrator, email, password
				from Administrator
				where email = '" . $email . "'";
	}

	function select() {
		return "select idAdministrator, email, password
				from Administrator
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function selectAll() {
		return "select idAdministrator, email, password
				from Administrator";
	}
}
?>

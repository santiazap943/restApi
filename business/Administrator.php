<?php
require_once ("../persistence/AdministratorDAO.php");
require_once ("../persistence/Connection.php");

class Administrator {
	private $idAdministrator;
	private $email;
	private $password;
	private $administratorDAO;
	private $connection;

	function getIdAdministrator() {
		return $this -> idAdministrator;
	}

	function setIdAdministrator($pIdAdministrator) {
		$this -> idAdministrator = $pIdAdministrator;
	}

	function getName() {
		return $this -> name;
	}

	function setName($pName) {
		$this -> name = $pName;
	}

	function getEmail() {
		return $this -> email;
	}

	function setEmail($pEmail) {
		$this -> email = $pEmail;
	}

	function getPassword() {
		return $this -> password;
	}

	function setPassword($pPassword) {
		$this -> password = $pPassword;
	}

	
	function Administrator($pIdAdministrator = "", $pEmail = "", $pPassword = ""){
		$this -> idAdministrator = $pIdAdministrator;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> administratorDAO = new AdministratorDAO($this -> idAdministrator, $this -> email );
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idAdministrator = $result[0];
			$this -> email = $result[1];
			$this -> password = $result[2];
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> update());
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> existEmail($email));
		if($this -> connection -> numRows()==1){
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	
	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idAdministrator = $result[0];
		$this -> email = $result[1];
		$this -> password = $result[2];
		}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> administratorDAO -> selectAll());
		$administrators = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($administrators, new Administrator($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $administrators;
	}

	
}
?>

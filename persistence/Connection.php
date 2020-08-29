<?php
class Connection {
	private $mysqli;
	private $result;

	/**
	 * Open the conection 
	 */ 
	function open(){
		//$this -> mysqli = new mysqli("localhost", "root", "", "pb");
		$this -> mysqli = new mysqli("nwhazdrp7hdpd4a4.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "rvzh6jhfykv8vgdo", "l3oc0qfo7mj7t8pv", "lu70uro51km05blq");
		$this -> mysqli -> set_charset("utf8");
	}

	function lastId(){
		return $this -> mysqli -> insert_id;
	}

	function run($query){
		$this -> result = $this -> mysqli -> query($query);
	}

	function close(){
		$this -> mysqli -> close();
	}

	function numRows(){
		return ($this -> result != null)?$this -> result -> num_rows : 0;
	}

	function fetchRow(){
		return $this -> result -> fetch_row();
	}

	function querySuccess(){
		return $this -> result === TRUE;
	}
}
?>

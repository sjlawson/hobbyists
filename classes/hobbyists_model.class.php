<?php
include_once("db_connect.php");

class HobbyistModel extends DatabaseConnect {
	private $dbConn; 
	
	public function __construct() {
		$this->dbConn = $this->dbConnect();
	}

	public function editHobbyist($data) {

	}

	public function createHobbyist($data) {

	}

	public function getHobbyist($id) {

	}

}
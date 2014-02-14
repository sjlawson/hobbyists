<?php

class DatabaseConnect {
	private $host = 'localhost';
	private $username = 'root';
	private $database = 'sjlawson';
	private $password = 'lawson2112';
	private $mysqliUtil;
	
	public function __construct() {
		try {
			$this->mysqliUtil = mysqli_connect($this->host, $this->username, $this->password, $this->database);
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		} 
	}
	
	public function doGetQuery($sql) {
		try {
			$result = $this->mysqliUtil->query($sql);
			return mysqli_fetch_assoc($result);
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}
	
}
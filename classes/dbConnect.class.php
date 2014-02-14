<?php

class DatabaseConnect {
	private static $host = 'localhost';
	private static $username = 'root';
	private static $database = 'sjlawson';
	private static $password = 'lawson2112';
	
	public static function dbConnect() {
		$conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
	}
}
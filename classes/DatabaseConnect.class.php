<?php
/**
 * Creates utility for accessing database and doint common activities
 * @author samuel
 *
 */
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
	
	/**
	 * 
	 * @param string $sql
	 * @return array
	 * @throws Exception
	 */
	public function doGetQuery($sql) {
		try {
			$result = $this->mysqliUtil->query($sql);
			return mysqli_fetch_assoc($result);
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}
	
	/**
	 * 
	 * @param string $sql
	 * @throws Exception
	 * @return boolean
	 */
	public function doUpdateQuery($sql) {
		try {
			$result = $this->mysqliUtil->query($sql);
			if(!mysqli_error($this->mysqliUtil))
				return true;
			else 
				return false;
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}
	
	/**
	 * 
	 * @param string $sql
	 * @throws Exception
	 * @return int
	 */
	public function doInsertQuery($sql) {
		try {
			$result = $this->mysqliUtil->query($sql);
			$return_id = mysqli_insert_id($this->mysqliUtil);
			
			return $return_id;
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}
	
}
<?php
spl_autoload_register(function($className) {
	@require_once ("classes/$className.class.php");
});

define("HOBBYISTTABLE","hobbyists");
define("PAGELIMIT", 20);

class HobbyistModel extends HobbyistFields {
	private $dbConn;
	
	private $required_fields = array('firstname',
									'lastname',
									'email',
									'sex',
									'city',
									'state'); 
	
	public function __construct() {
		try {
			$this->dbConn = new DatabaseConnect();
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}
	
	/**
	 * After data validation, assign to inherited class properties (fields)
	 * @param array $data
	 * @return multitype:string |boolean
	 */
	public function setProperties($data) {
		foreach ($data as $property => $value) {
			if(property_exists($this, $property)) {
				if(in_array($property, $this->required_fields) && empty($value) ) {
					return array("errmsg"=>"$property is required");
				}
				$this->$property = $value;
			} else {
				return array("errmsg"=>"$property does not exist");
			}
		}
		return true;
	}
	
	/**
	 * 
	 * @throws Exception
	 * @return boolean
	 */
	public function editHobbyist() {
		try {
			$sql = "UPDATE `".HOBBYISTTABLE."` SET ";
			$hobbyistFields = get_class_vars('HobbyistFields');
			foreach ($hobbyistFields as $property => $emptyvalue) {
				if (!empty($property) && $property != 'id')
					$sql .= "`$property`='{$this->$property}',";
			}
			$sql = rtrim($sql, ",");
			$sql .= " WHERE `id`={$this->id}";
			
			return $this->dbConn->doUpdateQuery($sql);
			
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}

	/**
	 * 
	 * @throws Exception
	 * @return number
	 */
	public function createHobbyist() {
		try {
			$sql = "INSERT INTO `".HOBBYISTTABLE."` ";
			$hobbyistFields = get_class_vars('HobbyistFields');
			$columns = "(";
			$values = ") VALUES (";
			foreach ($hobbyistFields as $property => $emptyvalue) {
				if (!empty($property) && $property != 'id') {
					$columns .= "`$property`,";
					$values .= "'{$this->$property}',";
				}
			}

			$sql .= rtrim($columns, ",") . rtrim($values, ",") .')';
		
			return $this->dbConn->doInsertQuery($sql);
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}

	/**
	 * 
	 * @param int $id
	 * @throws Exception
	 * @return array
	 */
	public function getHobbyist($id) {
		$sql = "SELECT * FROM `".HOBBYISTTABLE."` WHERE `id`='$id'"; 
		try {
			$assoc_result = $this->dbConn->doGetQuery($sql);
			return $assoc_result;
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}
	
	/**
	 * 
	 * @param int $page
	 * @throws Exception
	 * @return array
	 */
	public function getAllHobbyistsPaged($page = 1) {
			$offset = ($page-1) * PAGELIMIT;
			$sql = "SELECT `id`,`firstname`,`lastname` FROM `".HOBBYISTTABLE."` LIMIT $offset,".PAGELIMIT;
			try {
				$result_array= $this->dbConn->doMultiRowGetQuery($sql);
				return $result_array;
			} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
			}
		}

}
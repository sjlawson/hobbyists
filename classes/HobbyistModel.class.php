<?php
spl_autoload_register(function($className) {
	@require_once ("classes/$className.class.php");
});

define("HOBBYISTTABLE","hobbyists");

class HobbyistModel {
	private $dbConn;
	private $_table = "hobbyists"; 
	
	//model properties
	private $id;
	private $firstname;
	private $lastname;
	private $email;
	private $sex;
	private $city;
	private $state;
	private $comments; 
	private $hobby_cycling;
	private $hobby_frisbee;
	private $hobby_skiing;
	private $reqd_fields = array('firstname',
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
	
	public function setParams($data) {
		foreach ($data as $property => $value) {
			if(property_exists($this, $property)) {
				if(in_array($property, $this->reqd_fields) && empty($value) ) {
					return array("errmsg"=>"$property is required");
				}
				$this->$property = $value;
			} else {
				return array("errmsg"=>"$property does not exist");
			}
		}
		return true;
	}
	
	public function editHobbyist() {
		try {
			
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function createHobbyist() {
		try {
			
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function getHobbyist($id) {
		$sql = "SELECT * FROM `".HOBBYISTTABLE."` WHERE `id`='$id'"; 
		try {
			$assoc_result = $this->dbConn->doGetQuery($sql);
			return $assoc_result;
		} catch (Exception $ex) {
			throw new Exception($ex->getMessage(), $ex->getCode());
		}
	}

	public function validateInput($save_data) {
		
		
		
	}
	
}
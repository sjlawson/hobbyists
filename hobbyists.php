<?php
/* For this small application, this proceedural script contains some controller and view behaviours 
 * 
 */
session_start();

//TODO: move all authentication functionalities to a User class. 
// (authentication was added after learning the apache server was not setup to allow for htpassword directory-based authentication) 
if(@$_GET['logout']) {
	unset($_SESSION['auth']);
	setcookie("username", "", time()-(60*60*24), "/");
	header("Location: hobbyists.php");
}

$user_auth = (@$_SESSION['auth'] == 12345) ? true : false;

/**
 * using autoload register is overkill, but an app like this might be part of a larger whole in which using 
 * spl_autoload_register might be preferable
 * 
 */
spl_autoload_register(function($className) {
	@require_once ("classes/$className.class.php");
	@require_once ("IHobbyistModel.php");
});

//TODO: use factory design pattern
$hobbyistModel = HobbyistModelFactory::Create();
$hobbyist_id = isset($_GET['id']) ? filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) : null;
$hobbyist_data = $hobbyist_id ? $hobbyistModel->getHobbyist($hobbyist_id) : null;

if( !empty( $_POST['login_username']) && !empty( $_POST['login_password'])) {
	$username = filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
	$pass_hash = hash('sha256', filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING));
	
	if( $username == "demo" && $pass_hash == 'fc2a9ae6fe8d2050df755f1738b783de2a3ac399e718530a44458f8274699e01'  )
	{
		$_SESSION['auth'] = 12345;
		setcookie("username", $username, time()+(84600*30));
		$user_auth = true;
	}
	else {
		$validation_error = "ERROR: Incorrect username or password!";
	}
} elseif( !empty( $_POST ) ) {
	//sanitize input
	$save_data = array();
	$save_data['id'] = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	$save_data['firstname'] = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
	$save_data['lastname'] = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
	$save_data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$save_data['sex'] = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING);
	$save_data['city'] = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
	$save_data['state'] = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
	$save_data['comments'] = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
	$save_data['hobby_cycling'] = isset($_POST['hobby_cycling']) ? filter_input(INPUT_POST, 'hobby_cycling', FILTER_VALIDATE_INT) : 0;
	$save_data['hobby_frisbee'] = isset($_POST['hobby_frisbee']) ? filter_input(INPUT_POST, 'hobby_frisbee', FILTER_VALIDATE_INT) : 0;
	$save_data['hobby_skiing'] = isset($_POST['hobby_skiing']) ? filter_input(INPUT_POST, 'hobby_skiing', FILTER_VALIDATE_INT) : 0;
	
	if(empty($save_data['id'] )) unset($save_data['id']);
	$validationResult = $hobbyistModel->setProperties($save_data);
	
	if($validationResult !== true) {
		// set validation error message
		$validation_error = $validationResult["errmsg"];
	} else {
		$url = "http://".$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'], '?'));
		if(empty($save_data['id'])) {
			$new_id = $hobbyistModel->createHobbyist();
			if($new_id)
				header("Location: hobbyists.php?id=$new_id&msg=savesuccess");
		} else {
			if($hobbyistModel->editHobbyist())
				header("Location: $url?id=$hobbyist_id&msg=savesuccess");
		}
	}
	$hobbyist_data = $save_data;
}

function editHobbyistCtl($hobbyistModel) {
	$list = $hobbyistModel->getAllHobbyistsPaged();
	$selectCtl = '<select id="select_hobbyist" size="20" style="width: 150px; margin-left: 10px;">';
	foreach ($list as $row) {
		$selected = @$_GET['id'] == $row['id'] ? 'selected' : '';
	$selectCtl .= '<option onclick="loadHobbyist('.$row['id'].')" '.$selected.' >'.$row['lastname'].', '. $row['firstname'].'</option>';
	
	}
	$selectCtl .= '</select>';
	return $selectCtl;
}


/**
 * Utility to create a state code selection control
 * @param unknown_type $selected_state
 * @return string
 */
function getStateSelect($selected_state = "") {
	$stateOn = 'selected="selected"';
	$state_list = ARRAY(
			'AL'=>"Alabama",
			'AK'=>"Alaska",
			'AZ'=>"Arizona",
			'AR'=>"Arkansas",
			'CA'=>"California",
			'CO'=>"Colorado",
			'CT'=>"Connecticut",
			'DE'=>"Delaware",
			'DC'=>"District Of Columbia",
			'FL'=>"Florida",
			'GA'=>"Georgia",
			'HI'=>"Hawaii",
			'ID'=>"Idaho",
			'IL'=>"Illinois",
			'IN'=>"Indiana",
			'IA'=>"Iowa",
			'KS'=>"Kansas",
			'KY'=>"Kentucky",
			'LA'=>"Louisiana",
			'ME'=>"Maine",
			'MD'=>"Maryland",
			'MA'=>"Massachusetts",
			'MI'=>"Michigan",
			'MN'=>"Minnesota",
			'MS'=>"Mississippi",
			'MO'=>"Missouri",
			'MT'=>"Montana",
			'NE'=>"Nebraska",
			'NV'=>"Nevada",
			'NH'=>"New Hampshire",
			'NJ'=>"New Jersey",
			'NM'=>"New Mexico",
			'NY'=>"New York",
			'NC'=>"North Carolina",
			'ND'=>"North Dakota",
			'OH'=>"Ohio",
			'OK'=>"Oklahoma",
			'OR'=>"Oregon",
			'PA'=>"Pennsylvania",
			'RI'=>"Rhode Island",
			'SC'=>"South Carolina",
			'SD'=>"South Dakota",
			'TN'=>"Tennessee",
			'TX'=>"Texas",
			'UT'=>"Utah",
			'VT'=>"Vermont",
			'VA'=>"Virginia",
			'WA'=>"Washington",
			'WV'=>"West Virginia",
			'WI'=>"Wisconsin",
			'WY'=>"Wyoming");
	$state_selection = '
	<select name="state">
	<option value="" '. (!$selected_state ? $stateOn : '') .' >Select a State</option>';
	foreach ($state_list as $state_code => $state_name) {
		$state_selection .= "<option value='$state_code' ". ($state_code == $selected_state ? $stateOn : '') ." >$state_name</option>";
	}
	$state_selection .= "</select>";
	return $state_selection;
}

$successmsg = "";
if(strcmp(filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING),'savesuccess') === 0 ) {
	$successmsg = "Save successful!";
}

include "hobbyists.tpl.php";
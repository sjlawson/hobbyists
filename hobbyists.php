<?php
/* For this small application, this proceedural script will act as a controller as well as view
 * 
 */

/**
 * using autoload register is overkill, but an app like this might normally be parter of a larger whole in which using 
 * spl_autoload_register might be preferable
 * 
 */
spl_autoload_register(function($className) {
	@require_once ("classes/$className.class.php");
});

$hobbyistModel = new HobbyistModel();

$hobbyist_id = isset($_GET['id']) ? filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) : null;
$hobbyist_data = $hobbyist_id ? $hobbyistModel->getHobbyist($hobbyist_id) : null;

if( !empty( $_POST )) {
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
	$validationResult = $hobbyistModel->setParams($save_data);
	
	if($validationResult !== true) {
		// set validation error message
		$validation_error = $validationResult["errmsg"];
	} else {
		if(empty($save_data['id'])) {
			$hobbyistModel->createHobbyist();
		} else {
			$hobbyistModel->editHobbyist();
		}
	}
	$hobbyist_data = $save_data;
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


include "hobbyists.tpl.php";
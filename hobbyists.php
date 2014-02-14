<?php 
function getStateSelect($selected_state = "IN") {
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
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Hobbyist Manager</title> 
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="wrapper">
<div class="left-gap1"><img src="images/spacer.gif" alt="#" border="0" height="1" width="6"></div>
<div class="main">
<div class="header">
<div class="banner-area" >
<h1 class="header-title">Power Your Hobbies!</h1>
</div>
</div>
<div class="mid">
<div class="mid-left"><br>
</div>
<div class="mid-right">
<h1>Manage Hobbyists</h1>
<form>
<fieldset>
<table >
<tbody>
<tr><td>First name:</td> <td><input name="firstname" size="50"></tr>
<tr><td>Last name:</td> <td><input name="lastname" size="50"> </tr>
<tr><td>Email:</td> <td><input name="email" size="50"> </tr>
<tr><td>City:</td> <td><input name="city" size="50"> </tr>
<tr><td>State: </td><td> <?php echo getStateSelect(); ?> </td></tr>
</tbody>
</table>
</fieldset>
</form>
</div>
</div>
<div class="footer">
<p class="copyright-text">Copyright 2010. Designed by <a target="_blank" href="http://www.htmltemplates.net/">htmltemplates.net</a></p>
</div>
</div>
<div class="right-gap1"><img src="images/spacer.gif" alt="#" border="0" height="1" width="6"></div>
</div>

&nbsp;<a href="http://www.htmltemplates.net">
<img src="images/footnote.gif" class="copyright" alt="html templates"></a>&nbsp;<a href="http://websitetemplates.net">
<img src="images/footnote.gif" class="copyright" alt="websitetemplates.net"></a>&nbsp;
</body></html>
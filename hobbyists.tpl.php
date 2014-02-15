<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>Hobbyist Manager</title> 
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript">
	function loadHobbyist(id) {
	document.location.href = "hobbyists.php?id="+id+"#manage";
	}
  </script>
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
<div class="mid-left">
View/Edit Hobbyists <br />

<?php echo editHobbyistCtl($hobbyistModel); ?>

</div>
<div class="mid-right">
<h1 id="manage">Manage Hobbyists</h1>
<form method="post" />
<input type="hidden" name='id' value="<?php echo $hobbyist_id; ?>" />
<fieldset>
<div class='errormsg' <?php echo isset($validation_error) ? 'style="display: block !important;"' : 'style="display: none !important;"' ?>>
<?php echo @$validation_error; ?>
</div>
<div class="successmsg" <?php echo !empty($successmsg) ? 'style="display: block !important;"' : 'style="display: none !important;"' ?>>
<?php echo $successmsg; ?>
</div>
<table >
<tbody>
<tr><td>First name:</td> <td><input name="firstname" size="50"
	value="<?php echo $hobbyist_data ? $hobbyist_data['firstname'] : '';?>"></tr>
<tr><td>Last name:</td> <td><input name="lastname" size="50"
	value="<?php echo $hobbyist_data ? $hobbyist_data['lastname'] : '';?>"> </tr>
<tr><td>Email:</td> <td><input name="email" size="50"
	value="<?php echo $hobbyist_data ? $hobbyist_data['email'] : '';?>"> </tr>
<tr><td>City:</td> <td><input name="city" size="50"
	value="<?php echo $hobbyist_data ? $hobbyist_data['city'] : '';?>"> </tr>
<?php $selected_state = $hobbyist_data ? $hobbyist_data['state'] : ''; ?>
<tr><td>State: </td><td> <?php echo getStateSelect($selected_state); ?> </td></tr>
<tr><td>Sex: </td><td> Male <input name='sex' type="radio" value='M' 
	<?php echo strcmp(strtoupper(@$hobbyist_data['sex']),'M') === 0 ? 'checked' : ''; ?>/> 
	&nbsp;Female <input name='sex' type="radio" value='F' 
	<?php echo strcmp(strtoupper(@$hobbyist_data['sex']),'F') === 0 ? 'checked' : ''; ?>/>
</td></tr>
<tr><td>Hobbies: </td>
<td><table>
	<tr><td>Cycling</td><td> <input type="checkbox" name="hobby_cycling" value='1'
		<?php echo @$hobbyist_data['hobby_cycling'] ? 'checked' : ''; ?> /></td></tr>
	<tr><td>Frisbee</td><td> <input type="checkbox" name="hobby_frisbee" value='1'
		<?php echo @$hobbyist_data['hobby_frisbee'] ? 'checked' : ''; ?>/></td></tr>
	<tr><td>Skiing</td><td> <input type="checkbox" name="hobby_skiing" value='1'
		<?php echo @$hobbyist_data['hobby_skiing'] ? 'checked' : ''; ?>/></td></tr>
	</table>
	</td></tr> 
<tr><td>Comments:</td>
<td><textarea rows="3" cols="50" name="comments">
<?php echo @$hobbyist_data['comments']; ?>
</textarea>

</tbody>
</table>
<input type="submit" value="Save" /> &nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="Reset" onclick="document.location.href='hobbyists.php';" />
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
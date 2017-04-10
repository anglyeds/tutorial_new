
<?php
	include 'connectDB.php';	
	
	$rid = mysql_real_escape_string($_POST["rid"]);
	$loginid = mysql_real_escape_string($_POST["loginid"]);
	$password = mysql_real_escape_string($_POST["password"]);
	$name = mysql_real_escape_string($_POST["name"]);
	$company = mysql_real_escape_string($_POST["company"]);
	$remarks = mysql_real_escape_string($_POST["remarks"]);					
	
	//$sql = "DELETE FROM user WHERE login_id='$loginid' and name='$name' and company='$company'";
	$sql = "DELETE FROM user WHERE id='$rid'";
	
	$result = mysql_query($sql);
	if ($result == true) {
		echo json_encode('success');
	}else {
		echo json_encode('fail');
	}
?>
		
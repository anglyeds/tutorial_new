
<?php
	include 'connectDB.php';	
	
	$loginid = mysql_real_escape_string($_POST["loginid"]);
	$password = mysql_real_escape_string($_POST["password"]);
	$name = mysql_real_escape_string($_POST["name"]);
	$company = mysql_real_escape_string($_POST["company"]);
	$identity = mysql_real_escape_string($_POST["identity"]);
	$remarks = mysql_real_escape_string($_POST["remarks"]);					

	$sql ='';
	
	if ($loginid =='' || $password=='' || $name=='' || $identity=='') {
		echo json_encode('empty');
		
	} else {
		
		$result = mysql_query("SELECT * FROM user WHERE name='$name'");
		if(mysql_num_rows($result) != 0) {
			echo json_encode('duplicateName');
			exit();
		}
		
		$result = mysql_query("SELECT * FROM user WHERE login_id='$loginid'");
		if(mysql_num_rows($result) != 0) {
			echo json_encode('duplicateId');
			exit();
		}
	
		if ($remarks == '') {
			$sql = " INSERT INTO user (login_id, password, name, company, identity, remarks) VALUES ('$loginid','$password','$name', '$company', '$identity', NULL) ";			
		}
		else {
			$sql = " INSERT INTO user (login_id, password, name, company, identity, remarks) VALUES ('$loginid','$password','$name', '$company', '$identity','$remarks') ";	
		}
		
		$result = mysql_query($sql);
		if ($result == true) {
			echo json_encode('success');
		}else {
			echo json_encode('fail');
		}
		
		
	}
?>
		
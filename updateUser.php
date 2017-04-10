
<?php
	include 'connectDB.php';	
	
	$rid = mysql_real_escape_string($_POST["rid"]);
	$loginid = mysql_real_escape_string($_POST["loginid"]);
	$password = mysql_real_escape_string($_POST["password"]);
	$name = mysql_real_escape_string($_POST["name"]);
	$company = mysql_real_escape_string($_POST["company"]);
	$identity = mysql_real_escape_string($_POST["identity"]);
	$remarks = mysql_real_escape_string($_POST["remarks"]);	
	$sql ='';
	$isNull = 'NULL';
	
	//if ($remarks =='') $remarks = $isNull;
	//if ($compnay =='') $company = $isNull;
	
	if ($loginid =='' || $password=='' || $name=='' || $identity=='') {
		echo json_encode('empty');
		
	} else {
		
		$result = mysql_query("SELECT * FROM user WHERE name='$name' ");
		//if(mysql_num_rows($result) != 0) {
		$row = mysql_fetch_assoc($result);
		//if ($row['id'] != $rid) {
		if(mysql_num_rows($result) != 0 && $row['id'] != $rid) {
			echo json_encode('duplicateName');
			exit();
		}	
		
		$result = mysql_query("SELECT * FROM user WHERE login_id='$loginid' ");
		$row = mysql_fetch_assoc($result);
		if(mysql_num_rows($result) != 0 && $row['id'] != $rid) {
			echo json_encode('duplicateId');
			exit();
		}	
		
		if ($remarks =='') {
			//$sql = " UPDATE user SET password='$password', name='$name', company='$company', remarks = NULL WHERE login_id='$loginid' ";
			$sql = " UPDATE user SET login_id='$loginid', password='$password', name='$name', company='$company', identity ='$identity', remarks = NULL WHERE id='$rid' ";			
		}
		else {
		
			//$sql = " UPDATE user SET password='$password', name='$name', company='$company', remarks='$remarks' WHERE login_id='$loginid' ";
			$sql = " UPDATE user SET login_id='$loginid', password='$password', name='$name', company='$company', identity ='$identity', remarks='$remarks' WHERE id='$rid' ";
		}
		
		//$sql = " UPDATE user SET password='$password', name='$name', company='$company', remarks='$remarks' WHERE login_id='$loginid' ";
		
		$result = mysql_query($sql);
		if ($result == true) {
			echo json_encode('success');
		}else {
			echo json_encode('fail');
		}
	}
?>
		
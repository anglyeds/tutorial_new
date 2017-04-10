<?php 

	include 'connectDB.php';
	
	$loginid = mysql_real_escape_string($_POST["mobile"]);
	$token = mysql_real_escape_string($_POST["token"]);
	
	$sql = "UPDATE user SET token='NULL' WHERE login_id='$loginid' and token='$token'";
	
	
	
	if(mysql_query($sql)){	
		$data['status'] = '1';
		$data['note'] = '成功登出!';
		echo json_encode($data);		
	}
	
	mysql_close($con);
?>
<?php
	
	include 'tokenMaker.php';
	include 'connectDB.php';
	
	$loginid = mysql_real_escape_string($_POST["loginId"]);
	$pwd = mysql_real_escape_string($_POST["password"]);
	
	$sql="SELECT * FROM user WHERE BINARY login_id='$loginid' and password='$pwd'";
	$result=mysql_query($sql);
	$data = array();
	
	$count=mysql_num_rows($result);
	$row = mysql_fetch_assoc($result); 	
	
	if (!isset($_SESSION)) {
		session_start();
		// stored values in session, in other page write session_start() at the top
		// and retrieve session variables
		$_SESSION['name'] = $row['name']; 
		$_SESSION['identity'] = $row['identity']; 
	} 
	
	// If result matched $username and $password, table row must be 1 row
	if($count==1){	
	
		if ($row['identity'] == admin || $row['identity'] == sma) {
			
			
	
			$token = getToken(40);
			mysql_query("UPDATE user SET token = '$token' WHERE login_id = '$loginid'");
			
			$data['uid'] = $row['id'];
			$data['login_id'] = $row['login_id'];
			$data['name'] = $row['name'];
			
			$data['token'] = $token;
			$data['status'] = "success";
			echo json_encode($data);
		}
		else {
			$data['status'] = "unauthroized";
			echo json_encode($data);
		}
				
	}
	else{
		$data['token']='';
		$data['status'] = "invalid";
		echo json_encode($data);
		//echo json_encode("invalid");		
	};

	mysql_close($con);
	
?>


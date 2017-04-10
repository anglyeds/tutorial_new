
<?php
	include 'tokenMaker.php';
	include '../connectDB.php';

	$loginid = mysql_real_escape_string($_POST["loginid"]);
	$pwd = mysql_real_escape_string($_POST["password"]);
	
	//check_uppercase($loginid);
	
	$sql="SELECT * FROM user WHERE BINARY login_id='$loginid' and password='$pwd'";
	$result=mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$data = array();
	
	if (!isset($_SESSION)) {
		session_start();
		// stored values in session, in other page write session_start() at the top
		// and retrieve session variables
		$_SESSION['name'] = $row['name']; 
	} 
	
	$count=mysql_num_rows($result);
	
	if($count==1){	
	
		if ($row['identity'] == admin || $row['identity'] == client) {
			$token = getToken(40);
			mysql_query("UPDATE user SET token = '$token' WHERE login_id = '$loginid'");
			header('Location: status.php'); 
			
		}else {
			header('Location: unauthorized.php');
		}
		
	}
	else{
		header('Location: fail.php'); 
		
	};

	mysql_close($con);
	die;
	 
	function check_uppercase($str) {
		// check if the 1st char of login id is uppercase
		$chr = mb_substr ($str, 0, 1, "UTF-8");
		if (mb_strtolower($chr, "UTF-8") == $chr) {
			header('Location: fail.php');
			die();
		}
		
	}
  
 ?>
  
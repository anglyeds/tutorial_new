
<?php
	include 'connectDB.php';	
	
	$identity = mysql_real_escape_string($_POST["identity"]);

	$data = array();
	$user = array();

	$sql = "SELECT * FROM user WHERE identity='$identity' ORDER BY name";
	
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {				
		$user[] = $row;
	}
	
	if ($result) {
		$data['result']='success';
		$data['data']=$user;		
		echo json_encode($data);
	}	
	else {
		$data['result']= 'fail';
		echo json_encode($data);
	}
	
	mysql_close($con);
?>
	
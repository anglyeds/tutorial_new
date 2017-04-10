
<?php 

/*$data['name'] = $_GET["mobile"]; 
$data['pw'] = $_GET['password'];
$data['status'] = '1';
echo json_encode($data);*/

	include 'tokenMaker.php';
	include 'connectDB.php';
	
	$loginid = mysql_real_escape_string($_POST["mobile"]);
	$pwd = mysql_real_escape_string($_POST["password"]);

	$sql="SELECT * FROM user WHERE BINARY login_id='$loginid' and password='$pwd'";
	$result=mysql_query($sql);	
	$row = mysql_fetch_assoc($result); 
	
	$count=mysql_num_rows($result);
	// If result matched $username and $password, table row must be 1 row
	if($count==1){	
	
		if ($row['identity'] == 'merch') {
	
			//$row = mysql_fetch_assoc($result); 
				 
			$data['user']['uid'] = $row['id'];
			$data['user']['login_id'] = $row['login_id'];
			$data['user']['name'] = $row['name'];	
		
			$token = getToken(40);
			mysql_query("UPDATE user SET token = '$token' WHERE name = '$loginid'");
				
			$data['user']['token'] = $token;
			$data['note'] = '成功登錄!';
			$data['status'] = '1';
			echo json_encode($data);
		} else{
			$data['status'] = '0';
			$data['note'] = "你未獲受權使用這手機程式!";
			echo json_encode($data);
		}		
	}
	else{
		$data['note']='登錄ID或密碼不對!';
		echo json_encode($data);
	};

	mysql_close($con);
?>


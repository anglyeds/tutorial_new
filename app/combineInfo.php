

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Joint the tables</title>
</head>
<body>
    <?php
		/*
		define('HOSTNAME', 'localhost');
		define('USERNAME', 'smadmin');
		define('PASSWORD', 'sma123!');
		define('DATABASE', 'sma');

		$dbLink = mysql_connect(HOSTNAME, USERNAME, PASSWORD)or die(mysql_error());
		mysql_query("SET character_set_results=utf8", $dbLink)or die(mysql_error());
		mb_language('uni'); 
		mb_internal_encoding('UTF-8');
		mysql_select_db(DATABASE, $dbLink)or die(mysql_error());
		mysql_query("set names 'utf8'",$dbLink)or die(mysql_error());
		*/
		
		include 'connectDB.php';
		
		$result = mysql_query (" SELECT * FROM job_sheet,user WHERE job_sheet.done_by = user.name LIMIT 1, 15");
		
		while ($row = mysql_fetch_array($result)) {  
			echo $row['name'].", ".$row['login_id'].", ".$row['store_name_c'].", ".$row['job_name'].'<br />';  
		}  
		mysql_close($con);

	?>
</body>
</html>
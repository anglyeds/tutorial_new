
<?php
	include 'connectDB.php';	
	
	$code = mysql_real_escape_string($_POST["code"]);
	$merchandizer = mysql_real_escape_string($_POST["merchandizer"]);	
	$period = mysql_real_escape_string($_POST["period"]);			
	$batch = mysql_real_escape_string($_POST["batch"]);		
	
	$data = array();
	
	if ($batch=='All') {
		
		$sql_jobsheet = "UPDATE job_sheet SET merchandizer='$merchandizer',merchandizer_all='$merchandizer' where store_code ='$code' and period='$period'";	
		$sql_deployment = "UPDATE deployment SET merchandizer='$merchandizer',merchandizer_all='$merchandizer' where store_code ='$code'";
	} else {
		// the data for wages, allowance, merchandizer will be overrided 
		$sql_jobsheet = "UPDATE job_sheet SET merchandizer='$merchandizer' where store_code ='$code' and period='$period' and batch='$batch' ";	
		$sql_deployment = "UPDATE deployment SET merchandizer='$merchandizer' where store_code ='$code' and batch='$batch'";	
	}
	
	$result_jobsheet = mysql_query($sql_jobsheet);
	$result_deployment = mysql_query($sql_deployment);
	
	if ($result_jobsheet && $result_deployment ) {
		echo json_encode('success');		
	}	
	else {
		echo json_encode('fail');	
	}
	
	mysql_close($con);
	
?>
	
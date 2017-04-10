
<?php
	include 'connectDB.php';	
	$creator = mysql_real_escape_string($_POST["creator"]);
	$jobid = mysql_real_escape_string($_POST["jobId"]);
	$subid = mysql_real_escape_string($_POST["subId"]);		
	$period = mysql_real_escape_string($_POST["period"]);
	$date_from = mysql_real_escape_string($_POST["dateFrom"]);
	$date_to = mysql_real_escape_string($_POST["dateTo"]);
	$batch = mysql_real_escape_string($_POST["batch"]);
	$client = mysql_real_escape_string($_POST["client"]);
	$brand = mysql_real_escape_string($_POST["brand"]);
	$code = mysql_real_escape_string($_POST["code"]);	
	$jobname = mysql_real_escape_string($_POST["jobName"]);
	$msg = mysql_real_escape_string($_POST["msg"]);	
	
	// check if the same job id exists in the database
	/*$result = mysql_query("SELECT * FROM job_sheet WHERE job_id='$jobid' ");
	if (mysql_num_rows($result) != 0) {
		echo json_encode('duplicate');
		die();
	}*/

	// get the data about the store
	$result = mysql_query("SELECT * FROM store WHERE store_code='$code' ");
	if ($row = mysql_fetch_assoc($result)) {
		$retailer = $row['retailer'];
		$format = $row['format'];
		$region = $row['region'];
		$area = $row['area'];
		$name_c = $row['store_name_c'];
		$name_e = $row['store_name_e'];
		$address = $row['store_address'];
		$phone = $row['store_phone'];	
	}

	$sql = " INSERT INTO job_sheet (job_id,sub_id,creator,period,start_date,end_date,batch,store_code,client,brand,job_name,key_msg,retailer,format,region,area,store_name_c,store_name_e,store_address,store_phone) VALUES ('$jobid','$subid','$creator','$period','$date_from','$date_to','$batch','$code','$client','$brand','$jobname','$msg','$retailer','$format','$region','$area','$name_c','$name_e','$address','$phone') ";	
	$result = mysql_query($sql);
	if ($result == true) {
		echo json_encode('success');
	}else {
		echo json_encode('fail');
	}
	
	
?>
		
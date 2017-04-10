<?php
 
include 'connectDB.php';
 
//$target_path = "images/";  //where you want the uploaded images to go
//$target_path = $target_path . basename( $_FILES['userfile']['name'] );
//$image = addslashes(file_get_contents($_FILES['userfile']['tmp_name'])); 


$store = mysql_real_escape_string($_POST["storeName"]);
$job = mysql_real_escape_string($_POST["job"]);
$period = mysql_real_escape_string($_POST["period"]);
$reason = mysql_real_escape_string($_POST["reason"]);
$storeCode = mysql_real_escape_string($_POST["storecode"]);

$sql = ("UPDATE job_sheet SET failure_reason='$reason', status='fail', updated_on=now() WHERE store_name_c = '$store' and job_name ='$job' and period ='$period'");


if (mysql_query($sql)){
	$data['update'] = 'Success';
	$data['parameters'] = 'store='.$store.', storecode='.$storeCode.', job='.$job.', period='.$period.', failure reason='.$reason;
	echo json_encode($data);
} else {
	$data['update'] = 'Fail';
	$data['parameters'] = 'store='.$store.', storecode='.$storeCode.', job='.$job.', period='.$period.', failure reason='.$reason;
	echo json_encode($data);	
}
?>
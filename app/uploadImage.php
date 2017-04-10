<?php

include 'connectDB.php';

$root = '/var/www/html/images/';
$year = date("Y").'/'; 

$target_path = $root.$year.$_POST["client"].'/'.$_POST["brand"].'/'.$_POST["retailer"].'/'.$_POST["period"].'/'.$_POST["batch"].'/';

// check if the folder exists, else create it
if (!is_dir($target_path)) {
    mkdir($target_path, 0777, true);
}

if( chmod($target_path, 0755) ) {
    // allow app to create a folder on server's drive
    chmod($target_path, 0777);
}

$target_path = $target_path . basename( $_FILES['userfile']['name'] );



// move the image file from temp buffer to destination
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
	$data['save'] = 'Success';
	
} else {
	$data['save'] = 'Fail';
		
}

if( chmod($target_path, 0777) ) {
    // Everything for owner, read and execute for everybody else
    chmod($target_path, 0755);
}

$store = mysql_real_escape_string($_POST["storeName"]);
$job = mysql_real_escape_string($_POST["job"]);
$period = mysql_real_escape_string($_POST["period"]);
$merchandizer = mysql_real_escape_string($_POST["merchandizer"]);
$storeCode = mysql_real_escape_string($_POST["storeCode"]);
$status = mysql_real_escape_string($_POST["status"]);

$client = mysql_real_escape_string($_POST["client"]);
$brand = mysql_real_escape_string($_POST["brand"]);
$retailer = mysql_real_escape_string($_POST["retailer"]);
$batch = mysql_real_escape_string($_POST["batch"]);

$target_path = substr($target_path,13);

// insert the filepath to album table
$sql = " INSERT INTO album (merchandizer,period,store_code,store_name_c,job_name,status,filepath,client,brand,retailer,batch) VALUES ('$merchandizer','$period','$storeCode','$store','$job','$status','$target_path','$client','$brand','$retailer','$batch') ";

// update job status (success or fail) in job_sheet
if ($status == 'success') {
	$query = "UPDATE job_sheet SET status='$status', photo_uploaded='Y' WHERE period='$period' and merchandizer='$merchandizer' and job_name='$job' and store_name_C='$store' and store_code='$storeCode' "; 
} else {
	$query = "UPDATE job_sheet SET status='$status', photo_uploaded='Y' WHERE period='$period' and merchandizer='$merchandizer' and job_name='$job' and store_name_C='$store' and store_code='$storeCode' "; 	
}

if (mysql_query($sql) && mysql_query($query)){
	$data['update'] = 'Success';
	echo json_encode($data);
} else {
	$data['update'] = 'Fail';
	echo json_encode($data);	
}


/*
function make_path($path)
{
    $dir = pathinfo($path , PATHINFO_DIRNAME);
     
    if( is_dir($dir) )
    {
        return true;
    }
    else
    {
        if( make_path($dir) )
        {
            if( mkdir($dir) )
            {
                chmod($dir , 0777);
                return true;
            }
        }
    }
     
    return false;
}
*/


?>
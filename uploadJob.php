
<?php

	include 'connectDB.php';
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
	
    if ($_FILES[csv][size] > 0) { 

	/*
    //get the csv file 
    $file = $_FILES[csv][tmp_name];
	//open the csv file for reading	
    $handle = fopen($file,"r"); 
	// read the first line and ignore it
	fgets($handle);
	*/
	
	//get the csv file 
	$file = $_FILES[csv][tmp_name];		
	
	//check file extension
	$ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
	if( $ext !== 'csv') {
		header('Location: uploadJob.php?fail=2');
		die();
	}
	
	//open the csv file for reading	
	$handle = fopen($file,"r"); 
	// read the first line and ignore it
	fgets($handle);
	
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
		
			mysql_query("SET character_set_client=utf8", $dbLink)or die(mysql_error());
			mysql_query("SET character_set_connection=utf8", $dbLink)or die(mysql_error());
            mysql_query("INSERT INTO job_sheet (job_id,sub_id,period,start_date, end_date,retailer,store_code,store_name_c,store_address,client,brand,job_name,merchandizer,key_msg,batch) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."',
                    '".addslashes($data[4])."', 
                    '".addslashes($data[5])."', 
                    '".addslashes($data[6])."',
                    '".addslashes($data[7])."',
                    '".addslashes($data[8])."', 
                    '".addslashes($data[9])."', 
                    '".addslashes($data[10])."',
                    '".addslashes($data[11])."',
					'".addslashes($data[12])."',
					'".addslashes($data[13])."',
					'".addslashes($data[14])."'
                ) 
            "); 				
        } 		
    } while ($data = fgetcsv($handle,1000,",","'"));  

    //redirect 
    header('Location: uploadJob.php?success=1');  
	//echo "Uploading csv file is succeeded.</b><br><br>";
	die();
} 

?>



<!DOCTYPE html>
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>Import CSV File to server</title> 
</head> 

<body> 

<?php //if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?>


<h3>Import CSV file to server</h3> 
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Submit" /> 
</form> 

<?php 
	if ($_GET[success]=='1') { 
		echo "<br><br><p class='success center'><b>Job List has been uploaded successfully.</b></p>"; 
	} 
	if ($_GET[fail]=='1'){
		echo "<br><br><p class='fail center'><b>The same store code exists in the database.</b></p>"; 
	}
	if ($_GET[fail]=='2'){
		echo "<br><br><p class='fail center'><b>The selected file is not csv file.</b></p>"; 
	}
?>


</body> 
</html> 

<?php
	
	include 'connectDB.php';	
    
	if ($_FILES[csv][size] > 0) { 

		//get the csv file 
		$file = $_FILES[csv][tmp_name];		
		
		//check file extension
		$ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
		if( $ext !== 'csv') {
			header('Location: uploadStoreList.php?fail=2');
			die();
		}
		
		//open the csv file for reading	
		$csvfile = fopen($file,"r"); 
		// read the first line and ignore it
		fgets($csvfile);
		
		// check delimiter in csv file
		$separator = detect_delimiter($file);
		//echo $separator;
		
		$os = array(";", ",", "\t");
		if (!in_array("$separator", $os)) {
			header('Location: uploadStoreList.php?fail=3'); 
			die();
		}
		else {		
			while ( ($data = fgetcsv($csvfile,0,"$separator"))!==false  ) { 
				if ($data[0]) { 
				
					mysql_query("SET character_set_client=utf8", $con)or die(mysql_error());
					mysql_query("SET character_set_connection=utf8", $con)or die(mysql_error());
					
					$result = mysql_query("SELECT * FROM store WHERE store_code='$data[0]' ");
					if(mysql_num_rows($result) != 0) {
						header('Location: uploadStoreList.php?fail=1'); 
						die();
					}
					else {
						mysql_query("INSERT INTO store (store_code,retailer,format,region,area,store_name_c,store_name_e,store_address,store_phone) VALUES 
							( 
								'".addslashes($data[0])."', 
								'".addslashes($data[1])."', 
								'".addslashes($data[2])."',
								'".addslashes($data[3])."',
								'".addslashes($data[4])."', 
								'".addslashes($data[5])."', 
								'".addslashes($data[6])."',
								'".addslashes($data[7])."',
								'".addslashes($data[8])."'
							) 
						"); 
					}			
				} 			
			}
		}
		
		
		/*
		if ($separator===',') {
		
			//loop through the csv file and insert into database 
			while ( ($data = fgetcsv($csvfile,0,","))!==false  ) { 
				if ($data[0]) { 
				
					mysql_query("SET character_set_client=utf8", $con)or die(mysql_error());
					mysql_query("SET character_set_connection=utf8", $con)or die(mysql_error());
					
					$result = mysql_query("SELECT * FROM store WHERE store_code='$data[0]' ");
					if(mysql_num_rows($result) != 0) {
						header('Location: uploadStoreList.php?fail=1'); 
						die();
					}
					else {
						mysql_query("INSERT INTO store (store_code,retailer,format,region,area,store_name_c,store_name_e,store_address,store_phone) VALUES 
							( 
								'".addslashes($data[0])."', 
								'".addslashes($data[1])."', 
								'".addslashes($data[2])."',
								'".addslashes($data[3])."',
								'".addslashes($data[4])."', 
								'".addslashes($data[5])."', 
								'".addslashes($data[6])."',
								'".addslashes($data[7])."',
								'".addslashes($data[8])."'
							) 
						"); 
					}			
				} 			
			}
		}else if ($separator==="\t") {
		
			//loop through the csv file and insert into database 
			while ( ($data = fgetcsv($csvfile,0,"\t"))!==false  ) { 
				if ($data[0]) { 
				
					mysql_query("SET character_set_client=utf8", $con)or die(mysql_error());
					mysql_query("SET character_set_connection=utf8", $con)or die(mysql_error());
					
					$result = mysql_query("SELECT * FROM store WHERE store_code='$data[0]' ");
					if(mysql_num_rows($result) != 0) {
						header('Location: uploadStoreList.php?fail=1'); 
						die();
					}
					else {
						mysql_query("INSERT INTO store (store_code,retailer,format,region,area,store_name_c,store_name_e,store_address,store_phone) VALUES 
							( 
								'".addslashes($data[0])."', 
								'".addslashes($data[1])."', 
								'".addslashes($data[2])."',
								'".addslashes($data[3])."',
								'".addslashes($data[4])."', 
								'".addslashes($data[5])."', 
								'".addslashes($data[6])."',
								'".addslashes($data[7])."',
								'".addslashes($data[8])."'
							) 
						"); 
					}			
				} 				
			}
		}else if ($separator===';') {
		
			//loop through the csv file and insert into database 
			while ( ($data = fgetcsv($csvfile,0,";"))!==false  ) { 
				if ($data[0]) { 
				
					mysql_query("SET character_set_client=utf8", $con)or die(mysql_error());
					mysql_query("SET character_set_connection=utf8", $con)or die(mysql_error());
					
					$result = mysql_query("SELECT * FROM store WHERE store_code='$data[0]' ");
					if(mysql_num_rows($result) != 0) {
						header('Location: uploadStoreList.php?fail=1'); 
						die();
					}
					else {
						mysql_query("INSERT INTO store (store_code,retailer,format,region,area,store_name_c,store_name_e,store_address,store_phone) VALUES 
							( 
								'".addslashes($data[0])."', 
								'".addslashes($data[1])."', 
								'".addslashes($data[2])."',
								'".addslashes($data[3])."',
								'".addslashes($data[4])."', 
								'".addslashes($data[5])."', 
								'".addslashes($data[6])."',
								'".addslashes($data[7])."',
								'".addslashes($data[8])."'
							) 
						"); 
					}			
				} 			
			}
		}
		*/
		
		mysql_close($con);
		fclose($csvfile);
		//echo "Uploading csv file is succeeded.</b><br><br>";
		header('Location: uploadStoreList.php?success=1'); 
		die(); 
	} 
	
	function detect_delimiter($name) {
		$delimiters = array(
			'semicolon' => ";",
			'tab'       => "\t",
			'comma'     => ",",
			'pipe'		=> "|"
		);

		//Load the csv file into a string
		$csv = file_get_contents($name);
		foreach ($delimiters as $key => $delim) {
			$res[$key] = substr_count($csv, $delim);
		}

		//reverse sort the values, so the [0] element has the most occured delimiter
		arsort($res);

		reset($res);
		$first_key = key($res);

		return $delimiters[$first_key]; 
	}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Upload Store List</title> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="lib/json2.js" type="text/javascript"></script>

	<style>
	.batchWindowBG {
		width:60%; 
		height: 200px; 
		text-align:center; 
		background-color:#dedede;	//#4CAF50; 
		border:1px solid grey;
		margin-left:auto;
		margin-right:auto;
		margin-top: 10px;
	}
	.center {
		text-align: center;
	}
	.success{ 
		margin-top:20px; 
		font-size: 20px;		
	}
	.fail{ 
		margin-top:20px; 
		font-size: 20px;	
		color: red;
	}
	</style>
	
</head> 

<body oncontextmenu="return false">

	<a id="main" href="storeManagement.php">Return to Store Management</a>
	<h1 class="center">Upload Store List</h1>
	<!--
	<h3>Import Store List to server</h3> 
	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
	  Choose store list in .csv file: <br /> 
	  <input name="csv" type="file" id="csv" /> 
	  <br>
	  <br>
	  <input type="submit" name="Submit" value="Send" /> 
	</form> 
	-->

	<div id="batchWindow" class='batchWindowBG'>
		<h3>Choose store list in .csv file and upload to server</h3> 
		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 		
		<input type="file" id="browse" name="csv" style="display: none" onChange="csvfilechange();"/>
		<input type="text" id="filename" readonly="true" style="text-align:left" size="50"/>
		<input type="button" value="Select a file" id="fakeBrowse" onclick="csvfileBrowseClick();" style="padding:5px"/>
		<br><br>
		<input type="submit" name="Submit" value="Upload a file" style="padding:5px"/>
		
		</form> 
		<br>		
	<div>
	
	<?php 
	if ($_GET[success]=='1') { 
		echo "<br><br><p class='success center'><b>Store List has been uploaded successfully.</b></p>"; 
	} 
	if ($_GET[fail]=='1'){
		echo "<br><br><p class='fail center'><b>Some store code in csv file exists in the database.</b></p>"; 
	}
	if ($_GET[fail]=='2'){
		echo "<br><br><p class='fail center'><b>The selected file is not csv file.</b></p>"; 
	}
	if ($_GET[fail]=='3'){
		echo "<br><br><p class='fail center'><b>Only the delimiter such as comma, semicolon or tab is allowed in csv file.</b></p>"; 
	}
	?>

<script>
	function csvfileBrowseClick()
	{
		var browseFile = document.getElementById("browse");
		browseFile.click();
	}

	function csvfilechange()
	{
		var fileChosen = document.getElementById("browse");
		var filename = document.getElementById("filename");
		filename.value = fileChosen.value;
	}
</script>
	
</body> 
</html>

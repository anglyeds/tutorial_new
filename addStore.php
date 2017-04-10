
<?php
	include 'connectDB.php';	
	
	$code = mysql_real_escape_string($_POST["code"]);
	$retailer = mysql_real_escape_string($_POST["retailer"]);
	$format = mysql_real_escape_string($_POST["format"]);
	$region = mysql_real_escape_string($_POST["region"]);
	$area = mysql_real_escape_string($_POST["area"]);
	$name_c = mysql_real_escape_string($_POST["name_c"]);
	$name_e = mysql_real_escape_string($_POST["name_e"]);
	$address = mysql_real_escape_string($_POST["address"]);
	$phone = mysql_real_escape_string($_POST["phone"]);	

	$sql ='';
	
	if ($retailer=='' || $code =='' || $name_c=='' || $name_e=='' || $address=='') {
		echo json_encode('empty');
		
	} else {
		
		$result = mysql_query("SELECT * FROM store WHERE store_code='$code' ");
		if(mysql_num_rows($result) != 0) {
			echo json_encode('duplicate');
			exit();
		}
	
		$sql = " INSERT INTO store (store_code, retailer, format, region, area, store_name_e, store_name_c, store_address, store_phone) VALUES ('$code','$retailer','$format', '$region', '$area', '$name_e', '$name_c', '$address', '$phone') ";	
		
		
		$result = mysql_query($sql);
		if ($result == true) {
			echo json_encode('success');
		}else {
			echo json_encode('fail');
		}
	}
?>
		
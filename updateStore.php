
<?php
	include 'connectDB.php';	
	
	$rid = mysql_real_escape_string($_POST["rid"]);
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
	
	
	if ($retailer=='' || $name_c=='' || $name_e=='' || $address=='' || $code=='')  {
		echo json_encode('empty');
		
	} else {
		
		$result = mysql_query("SELECT * FROM store WHERE store_code='$code' ");
		$row = mysql_fetch_assoc($result);
		if(mysql_num_rows($result) != 0 && $row['id'] != $rid) {
			echo json_encode('duplicate');
			exit();
		}
		
		$sql = " UPDATE store SET retailer='$retailer', format='$format', region='$region', area='$area', store_code='$code', store_name_c='$name_c', store_name_e='$name_e', store_address='$address', store_phone='$phone' WHERE id='$rid' ";
		
		$result = mysql_query($sql);
		if ($result == true) {
			echo json_encode('success');
		}else {
			echo json_encode('fail');
		}
	}
?>
		
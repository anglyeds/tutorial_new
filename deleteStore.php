
<?php
	include 'connectDB.php';	
	
	$rid = mysql_real_escape_string($_POST["rid"]);
	$code = mysql_real_escape_string($_POST["code"]);
	$retailer = mysql_real_escape_string($_POST["retailer"]);
	$format = mysql_real_escape_string($_POST["format"]);
	$region = mysql_real_escape_string($_POST["region"]);
	$area = mysql_real_escape_string($_POST["area"]);
	$name_e = mysql_real_escape_string($_POST["name_e"]);
				
	
	//$sql = "DELETE FROM store WHERE store_code='$code' and retailer='$retailer' and region='$region' and area ='$area'and store_name_e='$name_e'";
	$sql = "DELETE FROM store WHERE id = '$rid'";
	$result = mysql_query($sql);
	if ($result == true) {
		echo json_encode('success');
	}else {
		echo json_encode('fail');
	}
?>
		
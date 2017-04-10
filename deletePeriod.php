
<?php
	include 'connectDB.php';	
	
	$rid = mysql_real_escape_string($_POST["rid"]);
	$period = mysql_real_escape_string($_POST["period"]);
	$start = mysql_real_escape_string($_POST["start"]);
	$end = mysql_real_escape_string($_POST["end"]);				
	
	//$sql = "DELETE FROM define_period WHERE period='$period' and start_date='$start' and end_date='$end'";
	$sql = "DELETE FROM define_period WHERE id ='$rid'";
	
	$result = mysql_query($sql);
	
	if ($result == true) {
		echo json_encode('success');
	}else {
		echo json_encode('fail');
	}
?>
		
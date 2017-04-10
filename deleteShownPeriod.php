
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);		
	
	$sql = "DELETE FROM show_period WHERE period='$period'";

	$result = mysql_query($sql);
	
	if ($result == true) {
		echo json_encode('success');
	}else {
		echo json_encode('fail');
	}
?>
		
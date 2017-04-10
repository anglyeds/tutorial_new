
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);
	
	if ($period=='') {
		echo json_encode('empty');
		
	} else {
		$sql = " UPDATE show_period SET period='$period' WHERE period='$period' ";		
		
		$result = mysql_query($sql);
		
		if ($result == true) {
			echo json_encode('success');
		}else {
			echo json_encode('fail');
		}
	}
?>
		
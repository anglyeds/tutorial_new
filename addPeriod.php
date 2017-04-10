
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);
	$start = mysql_real_escape_string($_POST["start"]);
	$end = mysql_real_escape_string($_POST["end"]);	

	if ($period =='' || $start=='' || $end=='') {
		echo json_encode('empty');
		
	} else {
		
		$result = mysql_query("SELECT * FROM define_period WHERE period='$period' ");
		if(mysql_num_rows($result) != 0) {
			echo json_encode('duplicatePeriod');
			exit();
		}
		
		$result = mysql_query("SELECT * FROM define_period WHERE start_date='$start' ");
		if(mysql_num_rows($result) != 0) {
			echo json_encode('duplicateStartDate');
			exit();
		}	
		
		$result = mysql_query("SELECT * FROM define_period WHERE end_date='$end' ");
		if(mysql_num_rows($result) != 0) {
			echo json_encode('duplicateEndDate');
			exit();
		}	
		
		$start_date = new DateTime($start);
		$end_date = new DateTime($end);
		
		//if ($start_date->format("Y-m-d") < $end_date->format("Y-m-d") ) {
		if ($start_date < $end_date ) {
	
			$sql = " INSERT INTO define_period (period, start_date, end_date) VALUES ('$period','$start','$end') ";
			$result = mysql_query($sql);
			
			if ($result == true) {
				echo json_encode('success');
			}else {
				echo json_encode('fail');
			}
		}
		else {
			echo json_encode('invalid');
		}
	}
?>
		
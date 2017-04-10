
<?php
	include 'connectDB.php';	
	
	$rid = mysql_real_escape_string($_POST["rid"]);
	$period = mysql_real_escape_string($_POST["period"]);
	$start = mysql_real_escape_string($_POST["start"]);
	$end = mysql_real_escape_string($_POST["end"]);	
	
	
	if ($start=='' || $end=='' || $period=='') {
		echo json_encode('empty');
		
	} else {
		
		$result = mysql_query("SELECT * FROM define_period WHERE period='$period' ");
		$row = mysql_fetch_assoc($result);
		if(mysql_num_rows($result) != 0 && $row['id'] != $rid) {
			echo json_encode('duplicatePeriod');
			exit();
		}

		$result = mysql_query("SELECT * FROM define_period WHERE start_date='$start' ");
		$row = mysql_fetch_assoc($result);
		if(mysql_num_rows($result) != 0 && $row['id'] != $rid) {
			echo json_encode('duplicateStartDate');
			exit();
		}	
		
		$result = mysql_query("SELECT * FROM define_period WHERE end_date='$end' ");
		$row = mysql_fetch_assoc($result);
		if(mysql_num_rows($result) != 0 && $row['id'] != $rid) {
			echo json_encode('duplicateEndDate');
			exit();
		}	
		
		$start_date = new DateTime($start);
		$end_date = new DateTime($end);
		
		if ($start_date < $end_date ) {
		
			$sql = " UPDATE define_period SET start_date='$start', end_date='$end', period='$period' WHERE id='$rid' ";	
			$result = mysql_query($sql);
			
			if ($result == true) {
				echo json_encode('success');
			}else {
				echo json_encode('fail');
			}
		} else {
			
			echo json_encode('invalid');
		}
	}
?>
		
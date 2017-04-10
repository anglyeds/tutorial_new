
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);			
	$data = array();
	
	if ($period != 'All') {	
		$result = mysql_query("SELECT * FROM define_period WHERE period='$period'");	
		$row = mysql_fetch_array($result);
		if ($result) {
			$data['start_date'] = $row['start_date'];
			$data['end_date'] = $row['end_date'];
			$data['result'] = 'success';
			echo json_encode($data);
		}
	}	
		
	mysql_close($con);
?>
	
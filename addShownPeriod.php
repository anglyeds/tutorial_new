
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);

	if ($period =='') {
		echo json_encode('empty');
		
	} else {
		// check if the period is defined in the define_period table
		$result = mysql_query("SELECT period FROM define_period WHERE period ='$period'");
		
		if(mysql_num_rows($result) == 0) {
			
			echo json_encode('not_existed');
			
		} else {
			// check if the period is duplicated
			$result = mysql_query("SELECT period FROM show_period WHERE period ='$period'");
			
			if(mysql_num_rows($result) == 0) {
				
				$sql = " INSERT INTO show_period (period) VALUES ('$period') ";			
				$result = mysql_query($sql);			
				if ($result == true) {
					echo json_encode('success');
				}else {
					echo json_encode('fail');
				}
				
			}else {
				echo json_encode('duplicated');
			}
			
		} 
	}
?>
		
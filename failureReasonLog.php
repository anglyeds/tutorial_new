<?php

	include 'connectDB.php'; 


	$sql = "SELECT * FROM job_sheet where status = 'fail' order by updated_on DESC";
	$result = mysql_query($sql);	
	
	echo '<table border="1"><tr><th>Period</th><th>Retailer</th><th>Store code</th><th>Store name</th><th>Job</th><th>Failure reason</th><th>Updated on</th></tr>';
	
	while ($row = mysql_fetch_array($result)) {

		echo '<tr><td>'.$row["period"].'</td><td>'.$row["retailer"].'</td><td>'.$row["store_code"].'</td><td>'.$row["store_name_c"].'</td><td>'.$row["job_name"].'</td><td>'.$row["failure_reason"].'</td><td>'.$row["updated_on"].'</td></tr>';
		
	}
	echo '</table>';
	
?>

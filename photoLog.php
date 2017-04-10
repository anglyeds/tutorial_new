<?php

	include 'connectDB.php'; 


	$sql = "SELECT * FROM album order by upload_time DESC";
	$result = mysql_query($sql);	
	
	echo '<table border="1"><tr><th>Store name Chinese</th><th>Job</th><th>Image path</th><th>Upload time</th></tr>';
	
	while ($row = mysql_fetch_array($result)) {

		echo '<tr><td>'.$row["store_name_c"].'</td><td>'.$row["job_name"].'</td><td>'.$row["filepath"].'</td><td>'.$row["upload_time"].'</td></tr>';
		
	}
	echo '</table>';
	
?>

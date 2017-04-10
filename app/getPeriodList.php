<?php

	include 'connectDB.php';
	
	//$sql="SELECT period FROM show_period order by period ASC";
	$sql ="SELECT show_period.period,define_period.start_date
		FROM show_period INNER JOIN define_period 
		ON show_period.period=define_period.period ORDER BY define_period.start_date ASC";
	$result=mysql_query($sql);
	
	//declare array
	$storeArray = array();
	while ($row = mysql_fetch_array($result)) {  
		 
		$storeArray[]=$row['period'];
		
	} 
	//echo json_encode($storeArray);
	
	//$data['list'] = $storeArray;
	//echo json_encode($data);
	
	$storeArray = array_filter($storeArray);
	if (!empty($storeArray)) {
		$data['list'] = $storeArray;
		echo json_encode($data);
	} else {
		$data['note'] = 'No data in server';
		echo json_encode($data);
	}
	
	mysql_close($con);
	
?>
	
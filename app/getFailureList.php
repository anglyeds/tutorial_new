<?php

	include 'connectDB.php';
	
	$sql="SELECT reason FROM failure_reason";
	$result=mysql_query($sql);
	
	//declare array
	$storeArray = array();
	while ($row = mysql_fetch_array($result)) {  
		 
		$storeArray[]=$row['reason'];
		
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
	
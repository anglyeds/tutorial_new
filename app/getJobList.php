<?php

	include 'connectDB.php';
	
	$period = mysql_real_escape_string($_POST["period"]);
	$merchandizer = mysql_real_escape_string($_POST["merchandizer"]);
	$result = mysql_query (" SELECT brand,retailer,store_code,store_name_c,store_address,batch,client,job_name,status,key_msg FROM job_sheet WHERE period = '$period' && merchandizer = '$merchandizer' ");
	
	$i = 0;
	$count=mysql_num_rows($result);
	$temp = array();
	$arr = array();
	while ($row = mysql_fetch_assoc($result)) {
			
		$temp['brand'] = $row['brand'];		
		$temp['retailer'] = $row['retailer'];
		$temp['storeCode'] = $row['store_code'];		
		$temp['storeName'] = $row['store_name_c'];
		$temp['address'] = $row['store_address'];		
		$temp['period'] = $period;
		$temp['batch'] = $row['batch'];
		$temp['client'] = $row['client'];
		$temp['job'] = $row['job_name'];
		$temp['status'] = $row['status'];
		$temp['msg'] = $row['key_msg'];
		$temp['merchandizer'] = $merchandizer;	
		$arr[$i] = $temp;
		unset($temp);
		$i++;
	}
	
	$arr = array_filter($arr);
	if (!empty($arr)) {
		$data['count'] = $count;
		$data['list'] = $arr;
		echo json_encode($data);
	} else {
		$data['note'] = '沒有工作!';
		echo json_encode($data);
	}
 	
	mysql_close($con);


?>

	
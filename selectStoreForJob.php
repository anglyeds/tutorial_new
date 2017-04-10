
<?php
	include 'connectDB.php';	
	
	$retailer = mysql_real_escape_string($_POST["retailer"]);
	$format = mysql_real_escape_string($_POST["format"]);			
	$region = mysql_real_escape_string($_POST["region"]);			
	$area = mysql_real_escape_string($_POST["area"]);	
	$job_id = mysql_real_escape_string($_POST["jobid"]);	
	$data = array();
	$store = array();
	
	$retailer_rtn = array();
	$format_rtn = array();
	$region_rtn = array();
	$area_rtn = array();
	
	if ($retailer!='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($retailer!='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer' and format='$format' and region='$region' ORDER BY retailer,format,region,area");	
	}
	else if ($retailer!='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer' and format='$format' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($retailer!='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer' and format='$format' ORDER BY retailer,format,region,area");	
	}
	else if ($retailer!='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer'  and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($retailer!='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($retailer!='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($retailer!='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and retailer='$retailer' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and format='$format' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and format='$format' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and format='$format' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($retailer=='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store_per_job WHERE job_id='$job_id' ORDER BY retailer,format,region,area");
	}
	
	$result = mysql_query($sql);
	$num_stores = mysql_num_rows($result);
	while ($row = mysql_fetch_assoc($result)) {				
		$store[] = $row;
		

		if (!in_array($row['retailer'], $retailer_rtn)) {
			$retailer_rtn[] = $row['retailer'];
			sort($retailer_rtn);
		}
		if (!in_array($row['format'], $format_rtn)) {		
			$format_rtn[] = $row['format'];
			sort($format_rtn);
		}		
		if (!in_array($row['region'], $region_rtn)) {
			$region_rtn[] = $row['region'];
			sort($region_rtn);
		}
		if (!in_array($row['area'], $area_rtn)) {
			$area_rtn[] = $row['area'];
			sort($area_rtn);
		}
	}
	

	if ($result) {
		$data['result']='success';
		$data['data']=$store;
		$data['count']=$num_stores;
		
		$data['retailer']=$retailer_rtn;
		$data['format']=$format_rtn;
		$data['region']=$region_rtn;
		$data['area']=$area_rtn;
		
		echo json_encode($data);
	}	
	else {
		$data['result']= 'fail';
		echo json_encode($data);
	}
	
	mysql_close($con);
?>
	
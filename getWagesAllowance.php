
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);
	$batch = mysql_real_escape_string($_POST["batch"]);		
	
	$data = array();
	$wages_rtn = array();
	$allowance_rtn = array();

	if ($batch=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' ";	
	}else {
		$sql = "SELECT * FROM deployment WHERE period='$period' and batch='$batch' ";	
	}
		
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {				
		
		if ($batch=='All') {
			if (!in_array($row['wages_all'], $wages_rtn)) {
				$wages_rtn[] = $row['wages_all'];
				sort($wages_rtn);
			}			
		} else {
			if (!in_array($row['wages'], $wages_rtn)) {
				$wages_rtn[] = $row['wages'];
				sort($wages_rtn);
			}
		}		
		if ($batch=='All') {
			if (!in_array($row['allowance_all'], $allowance_rtn)) {
				$allowance_rtn[] = $row['allowance_all'];
				sort($allowance_rtn);
			}
		} else {			
			if (!in_array($row['allowance'], $allowance_rtn)) {
				$allowance_rtn[] = $row['allowance'];
				sort($allowance_rtn);
			}
		}
	}
	
	if ($result) {
		$data['result']='success';		
		$data['wages']=$wages_rtn;
		$data['allowance']=$allowance_rtn;		
		echo json_encode($data);
	}	
	else {
		$data['result']= 'fail';
		echo json_encode($data);
	}
	
	mysql_close($con);
	
	
?>
	
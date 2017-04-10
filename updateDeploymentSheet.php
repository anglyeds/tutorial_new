
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);
	$batch = mysql_real_escape_string($_POST["batch"]);	
	$name_e = mysql_real_escape_string($_POST["name_e"]);	
	$name_c = mysql_real_escape_string($_POST["name_c"]);
	$wages = mysql_real_escape_string($_POST["wages"]);			
	$allowance = mysql_real_escape_string($_POST["allowance"]);		
	//$code = mysql_real_escape_string($_POST["code"]);	
	
	$data = array();
	$job = array();
	$id_array = array();
	
	$job_rtn = array();
	$period_rtn = array();
	$batch_rtn = array();
	$name_c_rtn = array();
	$name_e_rtn = array();
	$wages_rtn = array();
	$allowance_rtn = array();
	//$code_rtn = array();
	
	// by default, period must be one of key for where clause
	if ($allowance!='All' && $wages!='All' && $batch!='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and wages='$wages' and batch='$batch' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages!='All' && $batch!='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and wages='$wages' and batch='$batch' and store_name_e='$name_e' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages!='All' && $batch!='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and wages='$wages' and batch='$batch' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages!='All' && $batch!='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and wages='$wages' and batch='$batch' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages!='All' && $batch=='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' and wages_all='$wages' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages!='All' && $batch=='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' and wages_all='$wages' and store_name_e='$name_e' ORDER BY area,region,store_name_e";
	} else if ($allowance!='All' && $wages!='All' && $batch=='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' and wages_all='$wages' and store_name_c='$name_c' ORDER BY area,region,store_name_e";
	} else if ($allowance!='All' && $wages!='All' && $batch=='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' and wages_all='$wages' ORDER BY area,region,store_name_e";
	} else if ($allowance!='All' && $wages=='All' && $batch!='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and batch='$batch' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages=='All' && $batch!='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and batch='$batch' and store_name_e='$name_e' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages=='All' && $batch!='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and batch='$batch' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages=='All' && $batch!='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance='$allowance' and batch='$batch' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages=='All' && $batch=='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance!='All' && $wages=='All' && $batch=='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' and store_name_e='$name_e' ORDER BY area,region,store_name_e";
	} else if ($allowance!='All' && $wages=='All' && $batch=='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' and store_name_c='$name_c' ORDER BY area,region,store_name_e";
	} else if ($allowance!='All' && $wages=='All' && $batch=='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and allowance_all='$allowance' ORDER BY area,region,store_name_e";
	}else if ($allowance=='All' && $wages!='All' && $batch!='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages='$wages' and batch='$batch' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages!='All' && $batch!='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages='$wages' and batch='$batch' and store_name_e='$name_e' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages!='All' && $batch!='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages='$wages' and batch='$batch' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages!='All' && $batch!='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages='$wages' and batch='$batch' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages!='All' && $batch=='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages_all='$wages' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages!='All' && $batch=='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages_all='$wages' and store_name_e='$name_e' ORDER BY area,region,store_name_e";
	} else if ($allowance=='All' && $wages!='All' && $batch=='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages_all='$wages' and store_name_c='$name_c' ORDER BY area,region,store_name_e";
	} else if ($allowance=='All' && $wages!='All' && $batch=='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and wages_all='$wages' ORDER BY area,region,store_name_e";
	} else if ($allowance=='All' && $wages=='All' && $batch!='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and batch='$batch' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages=='All' && $batch!='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and batch='$batch' and store_name_e='$name_e' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages=='All' && $batch!='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and batch='$batch' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages=='All' && $batch!='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and batch='$batch' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages=='All' && $batch=='All' && $name_e!='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period'  and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY area,region,store_name_e";	
	} else if ($allowance=='All' && $wages=='All' && $batch=='All' && $name_e!='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and store_name_e='$name_e' ORDER BY area,region,store_name_e";
	} else if ($allowance=='All' && $wages=='All' && $batch=='All' && $name_e=='All' && $name_c!='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' and store_name_c='$name_c' ORDER BY area,region,store_name_e";
	} else if ($allowance=='All' && $wages=='All' && $batch=='All' && $name_e=='All' && $name_c=='All') {	
		$sql = "SELECT * FROM deployment WHERE period='$period' ORDER BY area,region,store_name_e";
	}
	
	
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {				
		$job[] = $row;
		$id_array[] = $row['jobsheet_id'];

		
		for ($i=0; $i<10; $i++) {
			$column = 'job'.$i;
			if ($row[$column] != "") {
				if (!in_array($row[$column], $job_rtn)) {
					$job_rtn[] = $row[$column];
					sort($job_rtn);
				}
			}
		}
		
		if (!in_array($row['period'], $period_rtn)) {
			$period_rtn[] = $row['period'];
			sort($period_rtn);
		}
		if (!in_array($row['batch'], $batch_rtn)) {		
			$batch_rtn[] = $row['batch'];
			sort($batch_rtn);
		}
		/*		
		if (!in_array($row['wages'], $wages_rtn)) {
			$wages_rtn[] = $row['wages'];
			sort($wages_rtn);
		}
		if (!in_array($row['allowance'], $allowance_rtn)) {
			$allowance_rtn[] = $row['allowance'];
			sort($allowance_rtn);
		}
		*/
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
		if (!in_array($row['store_name_e'], $name_e_rtn)) {
			$name_e_rtn[] = $row['store_name_e'];
			sort($name_e_rtn);
		}
		if (!in_array($row['store_name_c'], $name_c_rtn)) {
			$name_c_rtn[] = $row['store_name_c'];
			sort($name_c_rtn);
		}
		/*if (!in_array($row['store_code'], $code_rtn)) {
			$code_rtn[] = $row['store_code'];
			sort($code_rtn);
		}*/
	}
	
	if ($result) {
		$data['result']='success';
		$data['data']=$job;
		$data['rid']=$id_array;
		$data['job']=$job_rtn;
		//$data['period']=$period_rtn;
		$data['batch']=$batch_rtn;
		$data['wages']=$wages_rtn;
		$data['allowance']=$allowance_rtn;
		$data['name_e']=$name_e_rtn;
		$data['name_c']=$name_c_rtn;
		//$data['code']=$code_rtn;
		
		echo json_encode($data);
	}	
	else {
		$data['result']= 'fail';
		echo json_encode($data);
	}
	
	mysql_close($con);
	
	/*
	// $code=='All' &&
	if ($code=='All' && $batch!='All' && $name_e!='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period' and batch='$batch' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY store_name_e");	
	}
	else if ($code=='All' && $batch!='All' && $name_e!='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period' and batch='$batch' and store_name_e='$name_e' ORDER BY store_name_e");	
	}
	else if ($code=='All' && $batch!='All' && $name_e=='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period' and batch='$batch' and store_name_c='$name_c' ORDER BY store_name_e");	
	}
	else if ($code=='All' && $batch!='All' && $name_e=='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period' and batch='$batch' ORDER BY store_name_e");	
	}
	else if ($code=='All' && $batch=='All' && $name_e!='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period'  and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY store_name_e");	
	}
	else if ($code=='All' && $batch=='All' && $name_e!='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period' and store_name_e='$name_e' ORDER BY store_name_e");
	}
	else if ($code=='All' && $batch=='All' && $name_e=='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period' and store_name_c='$name_c' ORDER BY store_name_e");
	}
	else if ($code=='All' && $batch=='All' && $name_e=='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE period='$period' ORDER BY store_name_e");
	}
	// $code!='All' && 
	else if ($code!='All' && $batch!='All' && $name_e!='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period' and batch='$batch' and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY store_name_e");	
	}
	else if ($code!='All' && $batch!='All' && $name_e!='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period' and batch='$batch' and store_name_e='$name_e' ORDER BY store_name_e");	
	}
	else if ($code!='All' && $batch!='All' && $name_e=='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period' and batch='$batch' and store_name_c='$name_c' ORDER BY store_name_e");	
	}
	else if ($code!='All' && $batch!='All' && $name_e=='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period' and batch='$batch' ORDER BY store_name_e");	
	}
	else if ($code!='All' && $batch=='All' && $name_e!='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period'  and store_name_e='$name_e' and store_name_c='$name_c' ORDER BY store_name_e");	
	}
	else if ($code!='All' && $batch=='All' && $name_e!='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period' and store_name_e='$name_e' ORDER BY store_name_e");
	}
	else if ($code!='All' && $batch=='All' && $name_e=='All' && $name_c!='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period' and store_name_c='$name_c' ORDER BY store_name_e");
	}
	else if ($code!='All' && $batch=='All' && $name_e=='All' && $name_c=='All') {	
		$sql = ("SELECT * FROM deployment WHERE store_code='$code' and period='$period' ORDER BY store_name_e");
	}
	*/
?>
	
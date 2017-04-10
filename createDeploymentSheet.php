
<?php
	include 'connectDB.php';	
	
	$period = mysql_real_escape_string($_POST["period"]);
	$batch = mysql_real_escape_string($_POST["batch"]);
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
	
	$batchArray = array();
	
	mysql_query('DROP TABLE IF EXISTS deployment') or die(mysql_error());
		 
		 
		 		
	//$tablename = 'deployment_'.$period;
	//$create = "CREATE TABLE IF NOT EXISTS ".$tablename." (
	$create = "CREATE TABLE IF NOT EXISTS deployment (
		id int NOT NULL auto_increment PRIMARY KEY,
		store_code varchar (60) NOT NULL, 
		period varchar (20) NOT NULL,
		batch int(11) NOT NULL,
		jobsheet_id int(11) NOT NULL,
		wages varchar (10) NOT NULL,
		allowance varchar (10) NOT NULL,
		merchandizer varchar (255) NOT NULL,
		merchandizer_all varchar (255) NOT NULL,
		store_name_e varchar (255) NOT NULL,
		store_name_c varchar (255) NOT NULL,
		wages_all varchar(10) NOT NULL,
		allowance_all varchar(10) NOT NULL,
		job0 varchar (255) NOT NULL,
		job1 varchar (255) NOT NULL,
		job2 varchar (255) NOT NULL,
		job3 varchar (255) NOT NULL,
		job4 varchar (255) NOT NULL,
		job5 varchar (255) NOT NULL,
		job6 varchar (255) NOT NULL,
		job7 varchar (255) NOT NULL,
		job8 varchar (255) NOT NULL,
		job9 varchar (255) NOT NULL,
		store_address varchar (255) NOT NULL,
		region varchar (255) NOT NULL,
		area varchar (255) NOT NULL
		)ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci;";
	$result_table = mysql_query($create) or die (mysql_error());

	// find all store codes with the selected period and batch
	if ($batch=='All') {
		$sql = "SELECT distinct store_code FROM job_sheet WHERE period='$period'";
	} else  {
		$sql = "SELECT distinct store_code FROM job_sheet WHERE period='$period' and batch='$batch'";
	}
	$result_store = mysql_query($sql) or die (mysql_error());
	while ($row = mysql_fetch_array($result_store)) {
		$store = $row['store_code'];
		// find all jobs with same store code
		if ($batch=='All') {
			$sql = ("SELECT * FROM job_sheet WHERE period='$period' and store_code='$store' ");	
		} else {
			$sql = ("SELECT * FROM job_sheet WHERE period='$period' and batch='$batch' and store_code='$store' ");	
		}
		$result_job = mysql_query($sql) or die (mysql_error());
		$i=0;
		while ($row = mysql_fetch_array($result_job)){
			if ($i==0) {
				$jobname = $row['job_name'];
				$batchnum = $row['batch'];
				
				if (!in_array($row['batch'], $batchArray)) {
					$batchArray[] = $row['batch'];
					sort($batchArray);
				}
				$jid = $row['id'];
				$namec = $row['store_name_c'];
				$namee = $row['store_name_e'];	
				$address = $row['store_address'];
				$region = $row['region'];
				$area = $row['area'];
				$wages = $row['wages'];
				$allowance = $row['allowance'];
				$merchandizer = $row['merchandizer'];
				$wages_all = $row['wages_all'];
				$allowance_all = $row['allowance_all'];
				$merchandizer_all = $row['merchandizer_all'];
				$sql = "insert deployment (store_code,period,batch,jobsheet_id,store_name_e,store_name_c,job0,store_address,region,area,wages,allowance,merchandizer,wages_all,allowance_all,merchandizer_all) values ('$store','$period','$batchnum','$jid','$namee','$namec','$jobname','$address','$region','$area','$wages','$allowance','$merchandizer','$wages_all','$allowance_all','$merchandizer_all') ";
				//$sql = "insert deployment (store_code,period,batch,jobsheet_id,store_name_e,store_name_c,job0,store_address,region,area,wages,allowance,merchandizer) values ('$store','$period','$batchnum','$jid','$namee','$namec','$jobname','$address','$region','$area','$wages','$allowance','$merchandizer') ";
				mysql_query($sql);
				$i++;
			} else {
				$jobname = $row['job_name'];				
				$batchnum = $row['batch'];	
				if (!in_array($row['batch'], $batchArray)) {
					$batchArray[] = $row['batch'];
					sort($batchArray);
				}
				$namec = $row['store_name_c'];
				$namee = $row['store_name_e'];
				$column = 'job'.$i;
				$sql = "update deployment set ".$column."='$jobname',period='$period',batch='$batchnum',jobsheet_id='$jid',store_name_e='$namee',store_name_c='$namec',store_address='$address',region='$region',area='$area',wages='$wages',allowance='$allowance',merchandizer='$merchandizer',wages_all='$wages_all',allowance_all='$allowance_all',merchandizer_all='$merchandizer_all' where store_code ='$store' ";
				//$sql = "update deployment set ".$column."='$jobname',period='$period',batch='$batchnum',jobsheet_id='$jid',store_name_e='$namee',store_name_c='$namec',store_address='$address',region='$region',area='$area',wages='$wages',allowance='$allowance',merchandizer='$merchandizer' where store_code ='$store' ";
				mysql_query($sql);
				$i++;
			}			
		}
	}
	
	// create an array to store the keys for drop down menu
	//$sql = ("SELECT * FROM deployment WHERE period='$period' ORDER BY store_name_e");
	$sql = ("SELECT * FROM deployment ORDER BY region,area,store_name_e");
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
		/*if (!in_array($row['batch'], $batch_rtn)) {		
			$batch_rtn[] = $row['batch'];
			sort($batch_rtn);
		}*/
		
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
		$data['period']=$period_rtn;
		$data['batch']=$batchArray;
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
	

<?php

	include '../connectDB.php';

	if (!isset($_SESSION)) {
		session_start();
	}

	$user = $_SESSION['name'];
	
	
	if ($user == 'Admin') {
		$sql = "SELECT distinct job_id,client,brand,retailer,job_name,period FROM job_sheet order by job_id DESC";
	} else{
		$sql = "SELECT distinct job_id,client,brand,retailer,job_name,period FROM job_sheet WHERE client = '$user' order by job_id DESC";
	}
	$result = mysql_query($sql);
	$total_result = mysql_num_rows($result);
	/*
	while ($rows = mysql_fetch_array($result))
	{
		echo $rows['job_id']."<br>";
	}
	*/
	
	/*
	// add variable to array
	$i = 1;
	while ($rows = mysql_fetch_array($result2))
	{  
		$filename[$i] = $rows['filename'];
		$job_nos[$i]  = $rows['job_no']; 
		$i++;
	}
	*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="/lib/json2.js" type="text/javascript"></script>

	<title>Job Details</title>
</head>

<body>
	<a href='login.php'><img src='index.png'></a>
    <h1>Job Details</h1>
 
	<br>
	<table style='white-space: nowrap;' width="900" height="94" border="1">
	<thead>
		<tr><th width="31" bgcolor="#00CCCC">No</strong></th><th width="72" bgcolor="#00CCCC">Job No</strong></th><th width="82" bgcolor="#00CCCC">Supplier</strong></th><th width="62" bgcolor="#00CCCC">Brand</strong></th>
		<th width="55" bgcolor="#00CCCC">Store</strong></th>
		<th width="101" bgcolor="#00CCCC">Job Name</strong></th>
		<th width="60" bgcolor="#00CCCC">Week</strong></th>
		<?php
			if ($user == 'Admin') {
				echo '<th width="110" bgcolor="#00CCCC">Report Download</th>';
			} 
		?>
		<th width="60" bgcolor="#00CCCC">Photos</th></tr></thead>
		<tbody>
		<tr>
		<?php 
			$i=0;	
			while ($row = mysql_fetch_array($result)) { 
		?>
			<td><?php $i++; echo $i; ?></td>
			<td><?php echo $row['job_id']; ?></td>
			<td><?php echo $row['client']; ?></td>
			<td><?php echo $row['brand']; ?></td>
			<td><?php echo $row['retailer']; ?></td>
			<td><?php echo $row['job_name']; ?></td>
			<td><?php echo $row['period']; ?></td>
			<?php
				if ($user == 'Admin') {
					$fname = "summary.php";
					$filename = $row['job_name'].'_'.$row['retailer'].'_'.$row['period'].'_report';
					/*echo '<td>
					<a href="'.$fname.'?filename='.urlencode($filename).'">Summary Report</a><br>*/
					echo '<td>
					<a href="'.$fname.'?filename='.urlencode($filename).'&jobname='.$row['job_name'].'&retailer='.$row['retailer'].'&period='.$row['period'].'">Summary Report</a><br>
					<a href="notdone_fail.php?filename='.urlencode($filename).'&jobname='.$row['job_name'].'&retailer='.$row['retailer'].'&period='.$row['period'].'">Not Done & Fail Report</a><br>
					<a href="failure.php?filename='.urlencode($filename).'&jobname='.$row['job_name'].'&retailer='.$row['retailer'].'&period='.$row['period'].'">Failure Report</a><br>
					<a href="info_report.php?filename='.urlencode($filename).'&jobname='.$row['job_name'].'&retailer='.$row['retailer'].'&period='.$row['period'].'">Info Report</a></td>';
				} 
			?>
		<td><form action='photo.php' method='post'>
		<?php //$_SESSION['period']=$row['period']; $_SESSION['brand']=$row['brand']; $_SESSION['retailer']=$row['retailer']; ?>
		
		<button type='submit' name='submit' value=''>Photos</button>
		<input type='hidden' name='brand' value='<?php echo $row['brand'];?>'>
		<input type='hidden' name='period' value='<?php echo $row['period'];?>'>
		<input type='hidden' name='retailer' value='<?php echo $row['retailer'];?>'>
		<input type='hidden' name='jobname' value='<?php echo $row['job_name'];?>'>
		</form></td>
		<?php 
			echo "</tr>"; 
			$current_week = $row['period'];
			} 
		?>
		</tbody>
	</table>

</body>
</html>

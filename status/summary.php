<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Summary Report</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="/lib/json2.js" type="text/javascript"></script>
	
</head>

<?php
/*
	$filename = $_GET['filename']; 
	$out_file =$filename.".xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$out_file); 
*/	
?>

<?php 

include '../connectDB.php';

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['name']))
{
	$route_name=$_SESSION['name'];
}

$jobName = $_GET['jobname'];
$retailer = $_GET['retailer'];
$period = $_GET['period'];
//echo $jobName.', '.$retailer.', '.$period.'<br>';

$sql = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' ";
$result = mysql_query($sql);
$total_job = mysql_num_rows($result);
//echo 'numbers of jobs = '.$total_job.'<br>';
/*while ($rows = mysql_fetch_array($result))
{
	echo $rows['store_name_c']."<br>";
}
*/	
$sql_success = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
$result_success = mysql_query($sql_success);
$success = mysql_num_rows($result_success);

$sql_fail = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
$result_fail = mysql_query($sql_fail);
$fail = mysql_num_rows($result_fail);

$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status IS NULL or status ='')";
$result_not_complete = mysql_query($sql_not_complete);
$not_complete = mysql_num_rows($result_not_complete); 

/*
$i = 1;
while ($rows = mysql_fetch_array($result_fail))
{  $fail_reason[$i] = ($rows['fail_reason01']=='N'?'':$rows['fail_reason01']).
                      ($rows['fail_reason02']=='N'?'':$rows['fail_reason02']).
					  ($rows['fail_reason03']=='N'?'':$rows['fail_reason03']).
					  ($rows['fail_reason04']=='N'?'':$rows['fail_reason04']).
					  ($rows['fail_reason05']=='N'?'':$rows['fail_reason05']).
					  ($rows['fail_reason06']=='N'?'':$rows['fail_reason06']).
					  ($rows['fail_reason07']=='N'?'':$rows['fail_reason07']).
					  ($rows['fail_reason08']=='N'?'':$rows['fail_reason08']).
					  ($rows['fail_reason09']=='N'?'':$rows['fail_reason09']).
					  ($rows['fail_reason10']=='N'?'':$rows['fail_reason10']).
					  ($rows['fail_reason11']=='N'?'':$rows['fail_reason11']).
					  ($rows['fail_reason12']=='N'?'':$rows['fail_reason12']).
					  ($rows['fail_reason13']=='N'?'':$rows['fail_reason13']);
   // echo 'fail='.$fail_reason[$i];
   $other_reason[$i] = $rows['other_reason'];
   // echo "reason=".$other_reason[$i];
   $i++;
}
*/

?>
<body>
<!--
<span class="headline"><?php echo $filename; ?>
</span>
-->
<table width="364" height="27" border="0" cellpadding="5" cellspacing="3">
  <tr>
    <?php //echo $_GET['filename'] . '<br>'; ?>
    <?php //echo $filename . '<br>' ?>
    <?php //echo $sql . '<br>'; ?>
    <td width=75 align="right" bgcolor="#FFFF00">共 : <?php echo $total_job; ?></td>
    <td width=96 align="right" bgcolor="#33FF33">未完成 : <?php echo $not_complete; ?></td>
    <td width=65 align="right" bgcolor="#0066FF">成功 : <?php echo $success; ?></td>
    <td width=73 align="right" bgcolor="#FF0000">失敗 : <?php echo $fail; ?></td>
</tr></table>
</form>
    
<table border=1 width=1314>
<tr>
<td width="70" bgcolor="#FF9900">編號</td>
<td width="100" bgcolor="#FF9900">店舖編號</td>
<td width="109" bgcolor="#FF9900">店舖名</td>
<td width="180" bgcolor="#FF9900">地址</td>
<?php 
	if($route_name=='Admin'){
		echo '<td width="80" bgcolor="#FF9900">Merch</td>
		<td align=center bgcolor="#FF9900" width=65>層數</td>
		<td width="55" align=center bgcolor="#FF9900">堆頭(Y/N)</td>
		<td width="54" align=center bgcolor="#FF9900">有沒紅架回</td>';
		}
?>
<td width="72" align=center bgcolor="#FF9900">狀態</td>
<td width="151" align=center bgcolor="#FF9900">失敗原因</td>
<td width="151" align=center bgcolor="#FF9900">其他原因</td>
<td width="151" align=center bgcolor="#FF9900">備註</td></tr>
<?php 
	$i=0; 
?>
<?php 
	while ($row = mysql_fetch_array($result)) { 
?>
	<td>
<?php 
	$i=$i+1; 
	echo $i;
?>
	</td>
<?php 
	if ($route_name=='Admin') { 
		echo "<td>$row[store_code]</td>
			<td>$row[store_name_c]</td>
			<td>$row[store_address]</td>
			<td>$row[merchandizer]</td>".
			"<td>".$row['layer01']."</td>".
			"<td align=right>".$row['layer02']."</td>".
			"<td align=right>".$row['layer03']."</td>"; 
		}
	else{
		echo "<td>$row[store_code]</td><td>$row[store_name_c]</td><td>$row[store_address]</td>";
	};
?>
	<td align=center valign="middle">
<?php     
	if ($row['status'] == 'success') {
        echo "S"; echo "<td>&nbsp;</td><td>&nbsp;</td><td>".$row['remarks']."</td>"; 
?></tr>
<?php 
	} 
    elseif ($row['status'] == 'fail') {
		echo "F"; 
		/*echo "<td>".$fail_reason[$i]."</td>".
			 "<td>".$other_reason[$i]."</td>".
			 "<td>".$row['remarks']."</td>";*/
			 
		$reason = $row['failure_reason'];
		$check_result = mysql_query("SELECT * FROM failure_reason WHERE reason='$reason' LIMIT 1");
		$num_rows = mysql_num_rows($check_result);

		if ($num_rows != 0) {		
			// failure reason is a default reason
			echo "<td>".$row['failure_reason']."</td>".
				 "<td>"." "."</td>".
				 "<td>".$row['remarks']."</td>";
		} else {
			echo "<td>"." "."</td>".
			 "<td>".$row['failure_reason']."</td>".
			 "<td>".$row['remarks']."</td>";			
		}
?></tr>
<?php 
	} 
    elseif ($row['status'] != 'success' && $row['status'] != 'fail') {
		echo "Not Done"; 
?>
<?php 
	echo "<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>".$row['remarks']."</td>
		</tr>"; 
	}
	} 
?>

</table></body>
</html>

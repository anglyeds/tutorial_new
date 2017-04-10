<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Failure Report</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="/lib/json2.js" type="text/javascript"></script>
	
</head>

<?php 
/*
$out_file =$filename."(failure).xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$out_file); 
*/
?>

<?php 
include '../connectDB.php'; 

if (!isset($_SESSION)) {session_start();}

$filename = $_GET['filename'];
$jobName = $_GET['jobname'];
$retailer = $_GET['retailer'];
$period = $_GET['period'];
//echo $jobName.', '.$retailer.', '.$period.'<br>';

$sql = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' order by status";
$result = mysql_query($sql);

$sql_total_job = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period'";
$total_job = mysql_num_rows(mysql_query($sql_total_job));

$sql_success = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
$success = mysql_num_rows(mysql_query($sql_success));

$sql_fail = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
$result_fail = mysql_query($sql_fail);
$fail = mysql_num_rows(mysql_query($sql_fail));

$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status IS NULL or status ='')";
$not_complete = mysql_num_rows(mysql_query($sql_not_complete)); 

$reason01 = '經理不准做';
$reason02 = '該店無此貨售賣';
$reason03 = '全部缺貨';
$reason04 = '經理沒有收到 memo，故不能做';
$reason05 = '店舖關門';
$reason06 = '店舖裝修';
$reason07 = '上牌位置太窄，經理不准做';
$reason08 = '沒有上牌位置，經理不准做';
$reason09 = '沒有 End 架提供';
$reason10 = '沒有豎架提供';
$reason11 = '牌已拆及不能補牌，因為該店無此貨售賣';
$reason12 = '牌已拆及不能補牌，因為推廣到期';
$reason13 = '牌已拆及不能補牌，因為沒牌可以補';

$sql_fail_reason01 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason = '$reason01'";
$fail_reason01 =  mysql_num_rows(mysql_query($sql_fail_reason01));

$sql_fail_reason02 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason = '$reason02'";
$fail_reason02 =  mysql_num_rows(mysql_query($sql_fail_reason02));

$sql_fail_reason03 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason = '$reason03'";
$fail_reason03 =  mysql_num_rows(mysql_query($sql_fail_reason03));

$sql_fail_reason04 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason04'";
$fail_reason04 =  mysql_num_rows(mysql_query($sql_fail_reason04));

$sql_fail_reason05 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason05'";
$fail_reason05 =  mysql_num_rows(mysql_query($sql_fail_reason05));

$sql_fail_reason06 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason06'";
$fail_reason06 =  mysql_num_rows(mysql_query($sql_fail_reason06));

$sql_fail_reason07 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason07'";
$fail_reason07 =  mysql_num_rows(mysql_query($sql_fail_reason07));

$sql_fail_reason08 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason08'";
$fail_reason08 =  mysql_num_rows(mysql_query($sql_fail_reason08));

$sql_fail_reason09 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason09'";
$fail_reason09 =  mysql_num_rows(mysql_query($sql_fail_reason09));

$sql_fail_reason10 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason10'";
$fail_reason10 =  mysql_num_rows(mysql_query($sql_fail_reason10));

$sql_fail_reason11 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason11'";
$fail_reason11 =  mysql_num_rows(mysql_query($sql_fail_reason11));

$sql_fail_reason12 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason12'";
$fail_reason12 =  mysql_num_rows(mysql_query($sql_fail_reason12));

$sql_fail_reason13 = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail' and failure_reason =  '$reason13'";
$fail_reason13 =  mysql_num_rows(mysql_query($sql_fail_reason13));

$other_reason = $fail-$fail_reason01-$fail_reason02-$fail_reason03-$fail_reason04-$fail_reason05-$fail_reason06-$fail_reason07-$fail_reason08-$fail_reason09-$fail_reason10-$fail_reason11-$fail_reason12-$fail_reason13;

/*
echo '1. '.$fail_reason01.'<br>';
echo '2. '.$fail_reason02.'<br>';
echo '3. '.$fail_reason03.'<br>';
echo '4. '.$fail_reason04.'<br>';
echo '5. '.$fail_reason05.'<br>';
echo '6. '.$fail_reason06.'<br>';
echo '7. '.$fail_reason07.'<br>';
echo '8. '.$fail_reason08.'<br>';
echo '9. '.$fail_reason09.'<br>';
echo '10. '.$fail_reason10.'<br>';
echo '11. '.$fail_reason11.'<br>';
echo '12. '.$fail_reason12.'<br>';
echo '13. '.$fail_reason13.'<br>';
echo 'other. '.$other_reason.'<br>';
*/

?>
<body>
<!--
<span class="headline"><?php echo $filename."(failure)"; ?>
</span>
-->
<table width="364" height="27" border="0" cellpadding="5" cellspacing="3">
  <tr>
    
    <td width=75 align="right" bgcolor="#FFFF00">共 : <?php echo $total_job; ?></td>
    <td width=96 align="right" bgcolor="#33FF33">未完成 : <?php echo $not_complete; ?></td>
    <td width=65 align="right" bgcolor="#0066FF">成功 : <?php echo $success; ?></td>
    <td width=73 align="right" bgcolor="#FF0000">失敗 : <?php echo $fail; ?></td>
</tr></table></form>
    
<table width=448 height="177" border=1>
<tr>
  <td width="239" bgcolor="#FF9900">失敗原因</td>
  <td width="107" align="right" bgcolor="#FF9900">數量</td>
  <td width="80" align="right" bgcolor="#FF9900">百份比</td></tr>
<tr>
  <td><?php echo $reason01; ?></td>
  <td align=right><?php echo $fail_reason01; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason01/$fail)*100,2).'%';} ?></td>
</tr>
<tr>
  <td><?php echo $reason02; ?></td>
  <td align=right><?php echo $fail_reason02; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason02/$fail)*100,2).'%';} ?></td>
</tr>
<tr>
  <td><?php echo $reason03; ?></td>
  <td align=right><?php echo $fail_reason03; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason03/$fail)*100,2).'%';} ?></td>
</tr>
<tr>
  <td><?php echo $reason04; ?></td>
  <td align=right><?php echo $fail_reason04; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason04/$fail)*100,2).'%';} ?></td>
</tr>
<tr>
  <td><?php echo $reason05; ?></td>
  <td align=right><?php echo $fail_reason05; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason05/$fail)*100,2).'%';} ?></td>
</tr>
<tr>
  <td><?php echo $reason06; ?></td>
  <td align=right><?php echo $fail_reason06; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason06/$fail)*100,2).'%';} ?></td>
</tr>
<tr>
  <td><?php echo $reason07; ?></td>
  <td align=right><?php echo $fail_reason07; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason07/$fail)*100,2).'%';} ?></td>
</tr> 

<tr>
  <td><?php echo $reason08; ?></td>
  <td align=right><?php echo $fail_reason08; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason08/$fail)*100,2).'%';} ?></td>
</tr> 

<tr>
  <td><?php echo $reason09; ?></td>
  <td align=right><?php echo $fail_reason09; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason09/$fail)*100,2).'%';} ?></td>
</tr> 

<tr>
  <td><?php echo $reason10; ?></td>
  <td align=right><?php echo $fail_reason10; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason10/$fail)*100,2).'%';} ?></td>
</tr> 

<tr>
  <td><?php echo $reason11; ?></td>
  <td align=right><?php echo $fail_reason11; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason11/$fail)*100,2).'%';} ?></td>
</tr> 

<tr>
  <td><?php echo $reason12; ?></td>
  <td align=right><?php echo $fail_reason12; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason12/$fail)*100,2).'%';} ?></td>
</tr> 

<tr>
  <td><?php echo $reason13; ?></td>
  <td align=right><?php echo $fail_reason13; ?></td>
  <td align=right><?php if ($fail==0) {echo '0%';} else {echo number_format(($fail_reason13/$fail)*100,2).'%';} ?></td>
</tr> 

<?php
	if ($other_reason > 0) {
	$percent = number_format(($other_reason/$fail)*100,2).'%';
	echo '<tr><td>其它原因</td><td align=right>'.$other_reason.'</td><td align=right>'.$percent.'</td></tr>';	
	
	}
?>
</table>
</body>

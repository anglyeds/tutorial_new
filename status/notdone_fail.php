<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Not Done or Fail Report</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="/lib/json2.js" type="text/javascript"></script>
	
</head>

<?php
/*
$out_file =$filename."(not done & fail).xls";
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


$filename = $_GET['filename'];
$jobName = $_GET['jobname'];
$retailer = $_GET['retailer'];
$period = $_GET['period'];
//echo $jobName.', '.$retailer.', '.$period.'<br>';

$sql = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status IS NULL or status='' or status='fail')";
//$sql = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' order by status";
$result = mysql_query($sql);
/*
while ($rows = mysql_fetch_array($result))
{
	echo $rows['store_name_c']."<br>";
}
*/
$sql_total_job = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period'";
$total_job = mysql_num_rows(mysql_query($sql_total_job));

$sql_success = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
$success = mysql_num_rows(mysql_query($sql_success));

$sql_fail = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
$result_fail = mysql_query($sql_fail);
$fail = mysql_num_rows(mysql_query($sql_fail));

$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status IS NULL or status='')";
$not_complete = mysql_num_rows(mysql_query($sql_not_complete)); 

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
   $i++;
}

?>
<body>
<!--
<span class="headline"><?php echo $filename."(not done & fail)"; ?>
</span>
-->
<table width="364" height="27" border="0" cellpadding="5" cellspacing="3">
  <tr>
    
    <td width=75 align="right" bgcolor="#FFFF00">共 : <?php echo $total_job; ?></td>
    <td width=96 align="right" bgcolor="#33FF33">未完成 : <?php echo $not_complete; ?></td>
    <td width=65 align="right" bgcolor="#0066FF">成功 : <?php echo $success; ?></td>
    <td width=73 align="right" bgcolor="#FF0000">失敗 : <?php echo $fail; ?></td>
</tr></table></form>
    
<table border=1 width=900>
<tr><td bgcolor="#FF9900">編號</td><td bgcolor="#FF9900">店舖編號</td><td bgcolor="#FF9900">店舖名</td><td bgcolor="#FF9900">地址</td>
<?php if($route_name=='Admin'){	echo '<td bgcolor="#FF9900">Merch</td>';}?><td align=center bgcolor="#FF9900">狀態</td><td bgcolor="#FF9900">備註</td></tr>
<?php $i=0; ?>
<?php while ($row = mysql_fetch_array($result)) { ?>
  <td><?php $i=$i+1; echo $i; ?></td>
  <?php if($route_name=='Admin'){
	  //echo "<td>$row[store_code]</td><td>$row[store_name_c]</td><td>$row[store_address]</td><td>$row[merchandizer]</td>";
	  echo "<td>".$row['store_code']."</td><td>".$row['store_name_c']."</td><td>".$row['store_address']."</td><td>".$row['merchandizer']."</td>";
	  }
  else{
	  echo "<td>".$row[store_code]."</td><td>".$row[store_name_c]."</td><td>".$row[store_address]."</td>";
	  }
  ?>
  <td align=center valign="middle">
  <?php  if ($row['status'] == 'success') 
         { echo "Y"; echo "<td>&nbsp;</td>"; ?></tr>
		 <?php }
         elseif ($row[status] == 'fail') 
		{ echo "N"; echo "<td>$fail_reason[$i]</td>"; ?></tr>
         <?php } 
         elseif ($row['status'] != 'success' && $row['status'] != 'fail') 
		 { echo "Not Done"; ?>
  <?php echo "<td>&nbsp;</td></td></tr>"; }} ?>
  
</table>
</body>
</html>

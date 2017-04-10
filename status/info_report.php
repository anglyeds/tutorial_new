<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Info Report</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="/lib/json2.js" type="text/javascript"></script>
	
</head>

<?php
/*
$filename = $_GET['filename']; 
$out_file =$filename."_Info.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$out_file); 
*/
?>

<?php 
include '../connectDB.php';

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['name'])){
	$route_name=$_SESSION['name'];
}

$jobName = $_GET['jobname'];
$retailer = $_GET['retailer'];
$period = $_GET['period'];
//echo $jobName.', '.$retailer.', '.$period.'<br>';

/*$sql              = "SELECT * FROM tbl_job 
                     inner join tbl_item_info 
                     on tbl_job.job_no=tbl_item_info.job_no  
                     WHERE tbl_job.filename='$filename' order by tbl_job.complete, tbl_job.name";
					 */
$sql = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' ";					 
$result           = mysql_query($sql);

$sql_total_job    = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period'";
$total_job        = mysql_num_rows(mysql_query($sql_total_job));

$sql_success      = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
$success          = mysql_num_rows(mysql_query($sql_success));

//$sql_fail         = "SELECT * FROM tbl_job WHERE filename='$filename' and complete = 'F'";
$sql_fail         = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
$result_fail      = mysql_query($sql_fail);
$fail             = mysql_num_rows(mysql_query($sql_fail));


$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status IS NULL or status ='')";
$not_complete     = mysql_num_rows(mysql_query($sql_not_complete)); 

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



?>
<body>

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
	<td bgcolor="#FF9900" colspan="5"></td><td colspan="3" align="center" bgcolor="#FF9900">Chococino</td><td colspan="3" align="center" bgcolor="#FF0099">Mocha</td><td colspan="3" align="center" bgcolor="#FFFF99">Cappuccino</td><td colspan="3" align="center" bgcolor="#99FFFF">Latte macchiato</td><td colspan="3" align="center" bgcolor="#9900FF">Cafe au lait</td><td colspan="3" align="center" bgcolor="#990000">Tea latte</td><td colspan="3" align="center" bgcolor="#99FF00">Lungo</td><td colspan="3" align="center" bgcolor="#10FF99">Grande Intenso</td><td colspan="3" align="center" bgcolor="#FF0099">Espresso</td><td colspan="3" align="center" bgcolor="#FFFF99">Espresso Intenso</td><td colspan="3" align="center" bgcolor="#99FFFF">Skinny Cappuccino</td><td colspan="3" align="center" bgcolor="#9900FF">Cappuccino Ice</td><td colspan="3" align="center" bgcolor="#990000">Nestea Peach</td><td colspan="3" align="center" bgcolor="#99FF00">Chai Tea</td><td bgcolor="#FF9900" colspan="5"></td>
</tr>
<tr><td width="70" bgcolor="#FF9900">編號</td><td width="100" bgcolor="#FF9900">店舖編號</td><td width="109" bgcolor="#FF9900">店舖名</td><td width="180" bgcolor="#FF9900">地址</td><?php if($route_name=='Admin'){echo '<td width="80" bgcolor="#FF9900">Merch</td><td align=center bgcolor="#FF9900">價錢牌($)</td><td align=center bgcolor="#FF9900">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FF9900">存貨(盒數)</td><td align=center bgcolor="#FF0099">價錢牌($)</td><td align=center bgcolor="#FF0099">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FF0099">存貨(盒數)</td><td align=center bgcolor="#FFFF99">價錢牌($)</td><td align=center bgcolor="#FFFF99">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FFFF99">存貨(盒數)</td><td align=center bgcolor="#99FFFF">價錢牌($)</td><td align=center bgcolor="#99FFFF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FFFF">存貨(盒數)</td><td align=center bgcolor="#9900FF">價錢牌($)</td><td align=center bgcolor="#9900FF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#9900FF">存貨(盒數)</td><td align=center bgcolor="#990000">價錢牌($)</td><td align=center bgcolor="#990000">此貨有否陳列(Y/N)</td><td align=center bgcolor="#990000">存貨(盒數)</td><td align=center bgcolor="#99FF00">價錢牌($)</td><td align=center bgcolor="#99FF00">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FF00">存貨(盒數)</td><td align=center bgcolor="#10FF99">價錢牌($)</td><td align=center bgcolor="#10FF99">此貨有否陳列(Y/N)</td><td align=center bgcolor="#10FF99">存貨(盒數)</td><td align=center bgcolor="#FF0099">價錢牌($)</td><td align=center bgcolor="#FF0099">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FF0099">存貨(盒數)</td><td align=center bgcolor="#FFFF99">價錢牌($)</td><td align=center bgcolor="#FFFF99">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FFFF99">存貨(盒數)</td><td align=center bgcolor="#99FFFF">價錢牌($)</td><td align=center bgcolor="#99FFFF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FFFF">存貨(盒數)</td><td align=center bgcolor="#9900FF">價錢牌($)</td><td align=center bgcolor="#9900FF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#9900FF">存貨(盒數)</td><td align=center bgcolor="#990000">價錢牌($)</td><td align=center bgcolor="#990000">此貨有否陳列(Y/N)</td><td align=center bgcolor="#990000">存貨(盒數)</td><td align=center bgcolor="#99FF00">價錢牌($)</td><td align=center bgcolor="#99FF00">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FF00">存貨(盒數)</td><td align=center bgcolor="#FF9900">--</td><td align=center bgcolor="#FF9900">--</td><td align=center bgcolor="#FF9900" width=65>層數</td><td width="55" align=center bgcolor="#FF9900">堆頭(Y/N)</td><td width="54" align=center bgcolor="#FF9900">有沒紅架回</td>';}
else{echo '<td align=center bgcolor="#FF9900">價錢牌($)</td><td align=center bgcolor="#FF9900">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FF9900">存貨(盒數)</td><td align=center bgcolor="#FF0099">價錢牌($)</td><td align=center bgcolor="#FF0099">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FF0099">存貨(盒數)</td><td align=center bgcolor="#FFFF99">價錢牌($)</td><td align=center bgcolor="#FFFF99">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FFFF99">存貨(盒數)</td><td align=center bgcolor="#99FFFF">價錢牌($)</td><td align=center bgcolor="#99FFFF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FFFF">存貨(盒數)</td><td align=center bgcolor="#9900FF">價錢牌($)</td><td align=center bgcolor="#9900FF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#9900FF">存貨(盒數)</td><td align=center bgcolor="#990000">價錢牌($)</td><td align=center bgcolor="#990000">此貨有否陳列(Y/N)</td><td align=center bgcolor="#990000">存貨(盒數)</td><td align=center bgcolor="#99FF00">價錢牌($)</td><td align=center bgcolor="#99FF00">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FF00">存貨(盒數)</td><td align=center bgcolor="#10FF99">價錢牌($)</td><td align=center bgcolor="#10FF99">此貨有否陳列(Y/N)</td><td align=center bgcolor="#10FF99">存貨(盒數)</td><td align=center bgcolor="#FF0099">價錢牌($)</td><td align=center bgcolor="#FF0099">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FF0099">存貨(盒數)</td><td align=center bgcolor="#FFFF99">價錢牌($)</td><td align=center bgcolor="#FFFF99">此貨有否陳列(Y/N)</td><td align=center bgcolor="#FFFF99">存貨(盒數)</td><td align=center bgcolor="#99FFFF">價錢牌($)</td><td align=center bgcolor="#99FFFF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FFFF">存貨(盒數)</td><td align=center bgcolor="#9900FF">價錢牌($)</td><td align=center bgcolor="#9900FF">此貨有否陳列(Y/N)</td><td align=center bgcolor="#9900FF">存貨(盒數)</td><td align=center bgcolor="#990000">價錢牌($)</td><td align=center bgcolor="#990000">此貨有否陳列(Y/N)</td><td align=center bgcolor="#990000">存貨(盒數)</td><td align=center bgcolor="#99FF00">價錢牌($)</td><td align=center bgcolor="#99FF00">此貨有否陳列(Y/N)</td><td align=center bgcolor="#99FF00">存貨(盒數)</td><td align=center bgcolor="#FF9900">--</td><td align=center bgcolor="#FF9900">--</td>';}?>
</tr>
<?php $i=0; ?>
<?php while ($row = mysql_fetch_array($result)) { ?>
  <td><?php $i=$i+1; echo $i; ?></td>
<?php if ($route_name=='Admin') { 
echo "<td>$row[store_code]</td><td>$row[store_name_c]</td><td>$row[store_address]</td><td>$row[merchandizer]</td><td>$row[price_04]</td><td>$row[qty_04]</td><td>$row[price_01]</td><td>$row[price_05]</td><td>$row[qty_05]</td><td>$row[qty_01]</td><td>$row[price_06]</td><td>$row[qty_06]</td><td>$row[open_01]</td><td>$row[price_07]</td><td>$row[qty_07]</td><td>$row[close_01]</td><td>$row[price_08]</td><td>$row[qty_08]</td><td>$row[prices_01]</td><td>$row[price_09]</td><td>$row[qty_09]</td><td>$row[item_no_02]</td><td>$row[price_10]</td><td>$row[qty_10]</td><td>$row[item_name_02]</td><td>$row[price_11]</td><td>$row[qty_11]</td><td>$row[price_02]</td><td>$row[qty_02]</td><td>$row[open_02]</td><td>$row[close_02]</td><td>$row[prices_02]</td><td>$row[item_no_03]</td><td>$row[item_name_03]</td><td>$row[price_03]</td><td>$row[qty_03]</td><td>$row[open_03]</td><td>$row[close_03]</td><td>$row[prices_03]</td><td>$row[item_no_04]</td><td>$row[item_name_04]</td><td>$row[open_04]</td><td>$row[close_04]</td><td>$row[prices_04]</td><td>$row[item_no_05]</td><td>$row[item_name_05]</td><td></td><td></td><td>$row[layer01]</td><td align=right>$row[layer02]</td><td align=right>$row[layer03]</td>"; }
else{
echo "<td>$row[store_code]</td><td>$row[store_name_c]</td><td>$row[store_address]</td><td>$row[price_04]</td><td>$row[qty_04]</td><td>$row[price_05]</td><td>$row[qty_05]</td><td>$row[price_06]</td><td>$row[qty_06]</td><td>$row[price_07]</td><td>$row[qty_07]</td><td>$row[price_08]</td><td>$row[qty_08]</td><td>$row[price_09]</td><td>$row[qty_09]</td><td>$row[price_10]</td><td>$row[qty_10]</td><td>$row[price_11]</td><td>$row[qty_11]</td>";
}echo "</tr>";} ?>

</table></body>

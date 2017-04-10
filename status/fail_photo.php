<?php

include '../connectDB.php'; 

$b = $_POST['brand'];
$r = $_POST['retailer'];
$p = $_POST['period'];
$j = $_POST['jobname'];
//echo $p.', '.$r.', '.$b.', '.$j.'<br>';

if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['name'])){
	
	if($_POST['period']==''){
		$period = $_SESSION['period']; 
		$brand = $_SESSION['brand']; 
		$retailer = $_SESSION['retailer'];
		$jobName = $_SESSION['jobname'];
	} else {
		$period = $_SESSION['period'] = $_POST['period'];  
		$brand = $_SESSION['brand'] = $_POST['brand']; 
		$retailer = $_SESSION['retailer'] = $_POST['retailer'];
		$jobName = $_SESSION['jobname'] = $_POST['jobname'];
	}
	$route_name = $_SESSION['name'];
	$_SESSION['login_name'] = $_SESSION['name'];
}

//echo $route_name.', '.$period.', '.$retailer.', '.$brand.', '.$jobName.'<br>';

if ($route_name == 'Admin') {

	$date = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' ";
	$date_result = mysql_query($date);
	
	$sql = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' ";
	$result = mysql_query($sql);
	$total = mysql_num_rows(mysql_query($sql));

	$sql_success = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
	$success = mysql_num_rows(mysql_query($sql_success));

	$sql_fail = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
	$fail = mysql_num_rows(mysql_query($sql_fail));

	$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status IS NULL or status ='')";
	//$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status!='success' and status!='fail')";
	$not_complete = mysql_num_rows(mysql_query($sql_not_complete));  
	
	$sql_success_photo = "SELECT * FROM album WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
	$result_success_photo = mysql_query($sql_success_photo);
	
	$sql_fail_photo = "SELECT * FROM album WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
	$result_fail_photo = mysql_query($sql_fail_photo);
	
} else {
	$date = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' ";
	$date_result = mysql_query($date);
	
	$sql = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' ";
	$result = mysql_query($sql);
	$total = mysql_num_rows(mysql_query($sql));

	$sql_success = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
	$success = mysql_num_rows(mysql_query($sql_success));

	$sql_fail = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
	$fail = mysql_num_rows(mysql_query($sql_fail));

	$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status IS NULL or status ='')";
	//$sql_not_complete = "SELECT * FROM job_sheet WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and (status!='success' and status!='fail')";
	$not_complete = mysql_num_rows(mysql_query($sql_not_complete)); 
	
	$sql_success_photo = "SELECT * FROM album WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'success'";
	$result_success_photo = mysql_query($sql_success_photo);
	
	$sql_fail_photo = "SELECT * FROM album WHERE job_name='$jobName' and retailer='$retailer' and period='$period' and status = 'fail'";
	$result_fail_photo = mysql_query($sql_fail_photo);
	
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Photo</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="/lib/json2.js" type="text/javascript"></script>
	
<style type="text/css">
.rotate90 {
	/*
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
	*/
} 
.not_complete {
	background-color: #0F0;
	color: #F00;
	text-decoration: none;
}
.success {
	background-color: #36F;
	color: #FF0;
	text-decoration: none;
}
.fail {
	background-color: #F00;
	color: #FF0;
	text-decoration: none;
}
.button01 {background-color: #090;}
.button02 {background-color: #C69;}

a:visited {
    color: blue;
}
.frame {
	padding:10px;
	margin:15px; 
	text-align:center; 
	color:red;
	float:left; 
	font-size:13px; 
	border:1px solid #c0c0c0; 
	-webkit-box-shadow: 3px 3px 3px #777; 
	-moz-box-shadow: 3px 3px 3px #777; 
	box-shadow: 3px 3px 3px #777;

}
img {
	padding:5px; 
	padding-bottom:25px;
	//border:1px solid red; 
	
	//object-fit: contain;	//set image in the same aspect ratio
}

</style>
</head>

<body>
<div align=left>
<form id="form1" name="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table style='white-space: nowrap;' height="27" border="0" cellpadding="5" cellspacing="3">
<tr>
<a id='top'></a>
<td><a href='login.php'><img src='index.png'></a>
<a href='status.php'><img src='job.png'></a>
</td>
</tr>
<tr>
    <td>登入姓名 : <?php echo $_SESSION['name']; ?></td>
	<td style='color:red'><?php echo $period;?></td>
    <td align="right" bgcolor="#FFFF00">共 : <?php echo $total;?></td>
    <td align="right" bgcolor="#33FF33">未完成 : <?php echo $not_complete; ?></td>
    <td align="right" bgcolor="#0066FF">成功 : <?php echo $success; ?></td>
    <td align="right" bgcolor="#FF0000">失敗 : <?php echo $fail; ?></td>
</tr>
<tr>
<?php
if($row = mysql_fetch_array($date_result)) { ?>
<td><?php echo $row['start_date']." 至 ".$row['end_date'];?></td>
<?php }?>
</tr>
</table>
</form>

<div style='margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px; text-align: center; float:left;'><a href= <?php echo '/images/'.$_SESSION['name'].'_'.$_SESSION['period'].'_fail.zip';  ?>>下載相片</a>
<a href= 'photo.php'>成功相片</a></div><br>
<div style='clear:both;'></div>

<?php 

//$root = 'http://143.89.131.173';
$dir = '/var/www/html';
$zip_filepath = $dir.'/images/'.$_SESSION['name'].'_'.$_SESSION['period'].'_fail.zip';
$zip=new ZipArchive;
if ($zip->open($zip_filepath, ZipArchive::OVERWRITE)!==TRUE) {
    exit("cannot open <$zip_filepath>\n");
}

while ($row = mysql_fetch_array($result_fail_photo)) {
	
	//$str = $row['filepath'];
	//if (strpos($str, '_Fail.jpg') !== false) {
    
		//$filename = $root.$row['filepath'];
		$filename = $row['filepath'];
		$pos = strrpos($row['filepath'], '/', 1);

		echo '<div class="frame"><a href="'.$filename.'" target="_blank"><img src="'.$filename.'" class="rotate90" height="400px" width="400px" alt="image"/></a><br>'.substr($row['filepath'],$pos+1).'<br><br></div>';
		
		//Add image to zip
		$zip->addFile('../'.$row['filepath'],iconv("UTF-8","Big-5",substr($row['filepath'],$pos+1)));
	//}	
}

echo "<div style='clear:both;'></div><div style='margin:5px; text-align: center; float:left;'><a href='#top'>返回頂部</a></div><br><br>";
$zip->close();

?>
<div style='clear:both;'></div>
<br>

</div>
</body>

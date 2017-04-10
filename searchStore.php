
<?php
	include 'connectDB.php';	
	
	$keyword = mysql_real_escape_string($_POST["keyword"]);
	
	$data = array();
	$store = array();
	$id_array = array();
	
	if ($keyword=='')  {
		echo json_encode('empty input');
	} else {
		
		$result = mysql_query("SELECT * FROM store WHERE retailer LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			$store[] = $row;
			$id_array[] = $row['id'];
		}
		$result = mysql_query("SELECT * FROM store WHERE format LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		$result = mysql_query("SELECT * FROM store WHERE region LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			//if (!in_array($row,$store)) $store[] = $row;
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		$result = mysql_query("SELECT * FROM store WHERE area LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			//if (!in_array($row,$store)) $store[] = $row;
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		
		$result = mysql_query("SELECT * FROM store WHERE store_name_e LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			//if (!in_array($row,$store)) $store[] = $row;
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		$result = mysql_query("SELECT * FROM store WHERE store_name_c LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			//if (!in_array($row,$store)) $store[] = $row;
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		$result = mysql_query("SELECT * FROM store WHERE store_address LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			//if (!in_array($row,$store))	$store[] = $row;
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		$result = mysql_query("SELECT * FROM store WHERE store_phone LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			//if (!in_array($row,$store))	$store[] = $row;
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		$result = mysql_query("SELECT * FROM store WHERE store_code LIKE '%$keyword%' ");
		while ($row = mysql_fetch_assoc($result)){
			//if (!in_array($row,$store))	$store[] = $row;
			if (!in_array($row,$store))	{
				$store[] = $row;
				$id_array[] = $row['id'];
			}
		}
		
		$store = array_filter($store);

		if (!empty($store)) {		
			$data['result']='success';
			$data['data']=$store;
			$data['rid']=$id_array;
			echo json_encode($data);
		}else {
			$data['result']='not_found';
			echo json_encode('$data');
		}
	}
	
	mysql_close($con);
?>
		
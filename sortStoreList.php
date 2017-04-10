
<?php
	include 'connectDB.php';	
	
	$retailer = mysql_real_escape_string($_POST["retailer"]);
	$format = mysql_real_escape_string($_POST["format"]);			
	$region = mysql_real_escape_string($_POST["region"]);			
	$area = mysql_real_escape_string($_POST["area"]);	
	$name_e = mysql_real_escape_string($_POST["name_e"]);	
	$name_c = mysql_real_escape_string($_POST["name_c"]);	
	
	$data = array();
	$store = array();
	$id_array = array();
	
	$retailer_rtn = array();
	$format_rtn = array();
	$region_rtn = array();
	$area_rtn = array();
	$name_c_rtn = array();
	$name_e_rtn = array();
	
	/*
	// ignore both name_e and name_c
	if ($retailer!='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format");	
	}
	else if ($retailer!='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' and region='$region' ORDER BY retailer,format");	
	}
	else if ($retailer!='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' and area='$area' ORDER BY retailer,format");	
	}
	else if ($retailer!='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' ORDER BY retailer,format");	
	}
	else if ($retailer!='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer'  and region='$region' and area='$area' ORDER BY retailer,format");	
	}
	else if ($retailer!='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and region='$region' ORDER BY retailer,format");
	}
	else if ($retailer!='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and area='$area' ORDER BY retailer,format");
	}
	else if ($retailer!='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' and region='$region' and area='$area' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' and region='$region' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' and area='$area' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE region='$region' and area='$area' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE region='$region' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE area='$area' ORDER BY retailer,format");
	}
	else if ($retailer=='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store ORDER BY retailer,format");
	}
	*/
	
	//$name_c == 'All' && $name_e == 'All'
	if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' and region='$region' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and format='$format' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer'  and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE retailer='$retailer' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE format='$format' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store ORDER BY retailer,format,region,area");
	}
	
	//$name_c == 'All' && $name_e != 'All'
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' retailer='$retailer' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and retailer='$retailer' and format='$format' and region='$region' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE  store_name_e='$name_e' and retailer='$retailer' and format='$format' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and retailer='$retailer' and format='$format' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and retailer='$retailer'  and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and retailer='$retailer' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and retailer='$retailer' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and retailer='$retailer' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and format='$format' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and format='$format' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and format='$format' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c == 'All' && $name_e != 'All' && $retailer=='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c=='All' && $name_e!='All' && $retailer=='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_e='$name_e' ORDER BY retailer,format,region,area");
	}
	
	//$name_c != 'All' && $name_e == 'All'
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer' and format='$format' and region='$region' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer' and format='$format' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer' and format='$format' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer'  and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and retailer='$retailer' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and format='$format' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and format='$format' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and format='$format' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e == 'All' && $retailer=='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' ORDER BY retailer,format,region,area");
	}
	
	//$name_c != 'All' && $name_e != 'All' 
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer' and format='$format' and region='$region' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer' and format='$format' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer' and format='$format' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer'  and region='$region' and area='$area' ORDER BY retailer,format,region,area");	
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer!='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and retailer='$retailer' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and format='$format' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and format='$format' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and format='$format' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format!='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and format='$format' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and region='$region' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format=='All' && $region!='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and region='$region' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format=='All' && $region=='All' && $area!='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' and area='$area' ORDER BY retailer,format,region,area");
	}
	else if ($name_c != 'All' && $name_e != 'All' && $retailer=='All' && $format=='All' && $region=='All' && $area=='All') {	
		$sql = ("SELECT * FROM store WHERE store_name_c='$name_c' and store_name_e='$name_e' ORDER BY retailer,format,region,area");
	}
	
	
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {				
		$store[] = $row;
		$id_array[] = $row['id'];
		
		if (!in_array($row['retailer'], $retailer_rtn)) {
			$retailer_rtn[] = $row['retailer'];
			sort($retailer_rtn);
		}
		if (!in_array($row['format'], $format_rtn)) {		
			$format_rtn[] = $row['format'];
			sort($format_rtn);
		}		
		if (!in_array($row['region'], $region_rtn)) {
			$region_rtn[] = $row['region'];
			sort($region_rtn);
		}
		if (!in_array($row['area'], $area_rtn)) {
			$area_rtn[] = $row['area'];
			sort($area_rtn);
		}
		if (!in_array($row['store_name_e'], $name_e_rtn)) {
			$name_e_rtn[] = $row['store_name_e'];
			sort($name_e_rtn);
		}
		if (!in_array($row['store_name_c'], $name_c_rtn)) {
			$name_c_rtn[] = $row['store_name_c'];
			sort($name_c_rtn);
		}
	}
	
	if ($result) {
		$data['result']='success';
		$data['data']=$store;
		$data['rid']=$id_array;
		$data['retailer']=$retailer_rtn;
		$data['format']=$format_rtn;
		$data['region']=$region_rtn;
		$data['area']=$area_rtn;
		$data['name_e']=$name_e_rtn;
		$data['name_c']=$name_c_rtn;
		
		echo json_encode($data);
	}	
	else {
		$data['result']= 'fail';
		echo json_encode($data);
	}
	
	mysql_close($con);
?>
	
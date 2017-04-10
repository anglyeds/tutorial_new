<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Planning/Deployment Sheet </title> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="lib/json2.js" type="text/javascript"></script>
	<script src="lib/jquery.blockUI.js" type="text/javascript"></script>

<style>

#deployment {
    width: 98%;
    border-collapse: collapse;	
	margin-left: auto;
    margin-right: auto;
	table-layout: fixed;
}

#deployment td {
    border: 1px solid #dedede;
    //padding: 2px;
	margin: 5px 0;
	//border-bottom: 1px solid #ddd;
	text-align: center;
	overflow: hidden;
}

#deployment th {
    background-color: #dedede; //#4CAF50;
	border: 1px solid #c0c0c0;
    color: black;
	height: 30px;
	text-overflow:ellipsis;	
    font-family: "Times New Roman", Georgia, Serif;
	font-weight: normal;
}

#deployment tr:nth-child(even) {background-color: #f2f2f2}

#deployment tr:hover{background-color:#99ccff}

select {
	background-color: #dedede; //#4CAF50;
    color: black;
	height: 30px;
	font-size: 14px;
	border:none;	
	font-family: "Times New Roman", Georgia, Serif;
	font-weight: normal;
}

option {
	background-color: white;
	color:black;
}

.center {
	text-align: center;
}

input[type=text] {
	text-align: right;
    padding: 5px 0px;
    margin: 2px 0;
    box-sizing: border-box;	
}

.w100 input[type=text] {
	text-align: center;
    padding: 5px 0px;
    margin: 2px 0;
    box-sizing: border-box;	
}

button {
	width: 80px;
	padding:5px;
	cursor: pointer;
}
.sortingButton {
	background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
	margin-left:2px;
	margin-right:2px;
}

.button_example{
	border:1px solid #d7dada; -webkit-border-radius: 3px; -moz-border-radius: 3px;border-radius: 3px;font-size:14px;font-family:arial, helvetica, sans-serif; padding: 10px 10px 10px 10px; text-decoration:none; display:inline-block;text-shadow: 0px 0px 0 rgba(0,0,0,0.3);font-weight:bold; color: #000000;
	background-color: #f4f5f5; background-image: -webkit-gradient(linear, left top, left bottom, from(#f4f5f5), to(#dfdddd));
	background-image: -webkit-linear-gradient(top, #f4f5f5, #dfdddd);
	background-image: -moz-linear-gradient(top, #f4f5f5, #dfdddd);
	background-image: -ms-linear-gradient(top, #f4f5f5, #dfdddd);
	background-image: -o-linear-gradient(top, #f4f5f5, #dfdddd);
	background-image: linear-gradient(to bottom, #f4f5f5, #dfdddd);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#f4f5f5, endColorstr=#dfdddd);
}

.button_example:hover{
	border:1px solid #bfc4c4;
	background-color: #d9dddd; background-image: -webkit-gradient(linear, left top, left bottom, from(#d9dddd), to(#c6c3c3));
	background-image: -webkit-linear-gradient(top, #d9dddd, #c6c3c3);
	background-image: -moz-linear-gradient(top, #d9dddd, #c6c3c3);
	background-image: -ms-linear-gradient(top, #d9dddd, #c6c3c3);
	background-image: -o-linear-gradient(top, #d9dddd, #c6c3c3);
	background-image: linear-gradient(to bottom, #d9dddd, #c6c3c3);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#d9dddd, endColorstr=#c6c3c3);
}

.excel_btn {
	border-radius: 5px;
	background-color: #dedede;	//#4CAF50;
	height: 50px;
	width: 300px;
    border: solid 1px grey;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 20px 2px 5px;
    cursor: pointer;	
}

.excel_btn:hover{
     background: #45a999;
}


body { 
	min-width:1024px; 		/* suppose you want minimun width of 1024px */
	width: auto !important;  /* Firefox will set width as auto */
	width:1024px;             /* As IE ignores !important it will set width as 1024px; */
}
.w30 {
	width: 30px;
}
.w50 {
	width: 50px;
}
.w80 {
	width: 80px;
}
.w100 {
	width: 100px;
}
.W130 {
	width: 130px;
}	
.w150 {
	width: 150px;
}
.w200 {
	width: 200px;
}
.w300 {
	width: 300px;
}
.w400 {
	width: 400px;
}
.hide {
	display:none;
}

.img-valign {
  vertical-align: middle;
  margin-bottom: 0.75em;
}

.head {
  font-size: 44px;
  margin-left: 600px;
}

#spinner-loading {
	display: block;		  
	visibility:visible;
	margin-left: auto;
	margin-right: auto;
	width: 100px;
	height: auto;
	position: absolute;
	top: 60%;
	left: 47%;
}

#spinner-uploading {
	display: block;		  
	visibility:hidden;
	margin-left: auto;
	margin-right: auto;
	width: 100px;
	height: 100px
	//position: absolute;
	margin-top: 20px;
}

#t1 {
	width:700px;
	border-collapse: collapse;	
	float:right;
}
#t1 td { border:none; text-align: center; }
#t1 .c1 {background-color:transparent; }
#t1 .c2 {background-color:transparent; }
#t1 .c3 {background-color:transparent;  }
.blank_row
{
    height: 10px !important; /* Overwrite any previous rules */
    background-color: #FFFFFF;
}

#excel_file {
    border-collapse: collapse;	
	background-color: none;
}
#excel_file td, th {
    border: 1px solid #dedede;
    text-align: center;
    
}
.hidden {
	visibility:hidden;
}

</style>

</head> 

<body  min-width:1024px oncontextmenu="return false">
	<?php 
		include 'connectDB.php'; 		
	?>
	
	<!--<a id="main" href="menu.html">Return to Main Menu</a>-->
	<button style="width:200px" class="button_example" onclick="location.href='menu.php'">Return to Main Menu</button>
	<button id="logoutBtn" class="button_example" style="width:100px" >Logout</button>
	<h1 class="center">Planning/Deployment Sheet</h1></span>
	<!--
	<div>	
	<a id="main" href="main.html"><img src="home-icon.png" alt="home" class="img-valign" style="width:60px;height:auto;"></a>
	<span class="head">Job Sheet Creation</span>
	</div>
	-->
	<div id="top_container"  style="margin:auto; width:95%">
	
	<div style="margin:10px">
	Period: <select id="period_header" style="margin-right:50px; width:70px !important; min-width:70px; max-width:70px;" onchange="createDeploymentSheet('period')">
			<?php				
				$result = mysql_query (" SELECT distinct period FROM job_sheet order by start_date DESC");
				
				$periods = array();
				while ($row = mysql_fetch_array($result)) {
					$periods[] = $row['period'];
					echo '<option value='.$row['period'].'>'.$row['period'].'</option>';  
				}
			?> 
			</select>
	Batch: <select id="batch_header" style='margin-right:500px; width:50px !important; min-width:50px; max-width:50px;' onchange="createDeploymentSheet('batch')">
			<option value="all">All</option>
			<?php
				$result = mysql_query (" SELECT distinct batch FROM job_sheet where batch IS NOT NULL order by batch");				
				while ($row = mysql_fetch_array($result)) { 
					echo '<option value='.$row['batch'].'>'.$row['batch'].'</option>'; 
				}  
			?>
		</select><br><br>
	
	<table id="t1" >
	<col class="c1" />
    <col class="c2" />
    <col class="c3" />
	
	<tr>
	<td class="w200">Wages: <input type="text" size="9" maxlength="10" id="input_wages" name="input_wages" placeholder="Pls type here  "  style="margin-left:45px;" onchange="typeWagesOrAllowance('wages')" ></td>
	<td ><button id='clearAll_wages' style="width:210px;  " >Clear selection for wages</button>
	<td ><button id='selectAll_wages' style="width:200px;  " >Select all for wages</button></td>
	</tr>
	<tr>
	<td class="w200">Allowance: <input type="text" size="9" maxlength="10" id="input_allowance" name="input_allowance" placeholder="Pls type here  " style="margin-left:20px" onchange="typeWagesOrAllowance('allowance')"></td>
	<td><button id='clearAll_allowance' style=" width:210px;  " >Clear selection for allowance</button></td>
	<td ><button id='selectAll_allowance' style="width:200px;  " >Select all for allowance</button></td>
	</tr>
	<tr>
	<td class="w200">Merchandizer: <select id="merch_header" style='width:100px !important; min-width:100px; max-width:100px;' onchange="chooseMerchandizer()">
			<option value="" selected >Please select</option>
			<?php	
				$result = mysql_query (" SELECT distinct name FROM user where identity='merch' order by name");				
				while ($row = mysql_fetch_array($result)) {  
					echo '<option value='.$row['name'].'>'.$row['name'].'</option>';
				}
			?>
		</select>
	</td>
	<td ><button id='clearAll_merch' style="width:210px;" >Clear selection for merchandizer</button></td>
	<td ><button id='selectAll_merch' style="width:200px;" >Select all for merchandizer</button></td>
	</tr>
	<tr class="blank_row">
		<td colspan="3"></td>
	</tr>
	</table>
	
	</div>
	</div><!-- end of top_contianer	//-->
	
	<div id="table_contianer">
	<table id="deployment">
	
	<thead>
	<tr>
	<th class='w50'>No.</th>
	<th class='w100'>Store Code</th>
	<!-- for development //-->
	<!--
	<th class='w100'>Store Code<select id="storecode_header" class='w100' onchange="updateDeploymentSheet('code')">
			<option value="all">All</option>
			<?php	
				$result = mysql_query (" SELECT distinct store_code FROM job_sheet where store_code IS NOT NULL order by store_name_e");				
				while ($row = mysql_fetch_array($result)) { 					
					echo '<option value='.$row['store_code'].'>'.$row['store_code'].'</option>';  
				}  
			?>
		</select></th>
	-->	
	<th class='w200'>Store Name<select id="storename_e_header" class='w200' style='width: 200px !important; min-width: 200px; max-width: 200px;' onchange="updateDeploymentSheet('name_e')">
			<option value="all">All</option>
			<?php	
				$result = mysql_query (" SELECT distinct store_name_e FROM job_sheet where store_name_e IS NOT NULL order by store_name_e");				
				while ($row = mysql_fetch_array($result)) { 
					if ($row['store_name_e']!='') {
						echo '<option value='.$row['store_name_e'].'>'.$row['store_name_e'].'</option>';  
					}
				}  
			?>
		</select></th>
	<th class='w100'>舖名<select id="storename_c_header" class='w100' style='width: 100px !important; min-width: 100px; max-width: 100px;' onchange="updateDeploymentSheet('name_c')">
			<option value="all">All</option>
			<?php
				$result = mysql_query (" SELECT distinct store_name_c FROM job_sheet where store_name_c IS NOT NULL order by store_name_c");				
				while ($row = mysql_fetch_array($result)) { 
					if ($row['store_name_c']!='') {				
						echo '<option value='.$row['store_name_c'].'>'.$row['store_name_c'].'</option>'; 
					}						
				}  
			?>
		</select></th>
	<th class='w300'>Store Address</th>
	
	<th class='w100'>Region</th>
	
	<th class='w100'>Area</th>
	<!--
	<th class='w100'>Region<br><input type="image" id="regionAscendingSort" src="pic/ascendingIcon.png" alt="ascendingIcon" class="sortingButton" width="25" height="30"><input type="image" id="regionDescendingSort" src="pic/descendingIcon.png" alt="descending" class="sortingButton" width="25" height="30"></th>
	
	<th class='w100'>Area<br><input type="image" id="areaAscendingSort" src="pic/ascendingIcon.png" alt="ascendingIcon" class="sortingButton" width="25" height="30"><input type="image" id="areaDescendingSort" src="pic/descendingIcon.png" alt="descending" class="sortingButton" width="25" height="30"></th>
	-->
	
	
	<?php 
		/*
		$period = $periods[0];
		$result = mysql_query (" SELECT distinct job_name FROM job_sheet where job_name IS NOT NULL and period = '$period'");	
		$jobArray = array();		
		*/
	?>
	<th class='w30' style="border-right: none"></button></th>
	<th class='w100' style="border-left: none">工資<select id="wages_header" class='w100' onchange="updateDeploymentSheet('wages')">
			<option value="all">All</option>
			<?php	
				$result = mysql_query (" SELECT distinct wages FROM deployment where wages IS NOT NULL");				
				while ($row = mysql_fetch_array($result)) { 
					if ($row['wages']!='') {
						echo '<option value='.$row['wages'].'>'.$row['wages'].'</option>';  
					}
				} 
			?>
		</select></th>
	<th class='w30' style="border-right: none"></button></th>
	<th class='w100' style="border-left: none">津貼<select id="allowance_header" class='w100' onchange="updateDeploymentSheet('allowance')">
			<option value="all">All</option>
			<?php
				$result = mysql_query (" SELECT distinct allowance FROM job_sheet where allowance IS NOT NULL");				
				while ($row = mysql_fetch_array($result)) { 
					if ($row['allowance']!='') {
						echo '<option value='.$row['allowance'].'>'.$row['allowance'].'</option>'; 
					}					
				}  
			?>
		</select></th>
	
	<th class='w30' style="border-right: none"></button></th>
	<th class='w100' style="border-left: none">Merchandizer</button></th>
	</tr></thead>
	
	<tbody id="table">	
	</tbody>
	</table>
	</div> <!-- table container //-->	

	<img id="spinner-loading" src="spinner_200.gif"/>
	
	<div id="msg" class="center" style="font-size:18;font-weight:bold;margin-top:20px">Click below button to save deployment sheet</div>
	
	<div class='center'>
	<button id="excelBtn" class="button_example" style="width:300px;height:50px;font-size:18px" >Export to Excel File</button>
	<img id="spinner-uploading" src="spinner_200.gif"/>
	</div>
	
	<!-- to be shown in the overlay view -->
	<div id="domMessage" style="display:none;"> 
    <h3 style="padding:5px">Deployment Sheet is updated.</h3> 
	<button id="yes" style="width:50px">OK</button> 
	<br>
	</div>
	
	
	<!-- table for exporting to excel file -->
	<table id='excel_file' class="hidden" >
	<thead><tr>
		<th class='w50'>No.</th>
		<th class='w100'>Store Code</th>
		<th class='w200'>Store Name</th>
		<th class='w100'>舖名</th>
		<th class='w300'>Store Address</th>
		<th class='w100'>Region</th>
		<th class='w100'>Area</th>
		<th class='w100'>工資</th>
		<th class='w100'>津貼</th>
		<th class='w100'>Merchandizer</th>
	</tr></thead>
	<tbody id='excel_table'>
	</tbody>
	</table>

	
<script type="text/javascript">

	var jobArray = [];
	var jobCount = '';
	var lastNumOfJob = '';	
	var storeArray = [];
	//jobArray = <?php echo json_encode($jobArray ); ?>;	//get variable created by php
	var wagesArray = [];
	var allowanceArray = [];
	var storeSelected=0;
	var s_code_merch = [];
	var s_code_wages = [];
	var s_code_allowance = [];
	
	var regx = /^[0-9\.]+$/;  
	var excel_header ='';
	var excel_content = '';

	$(window).load(function() {
		
		if (sessionStorage.getItem("isLogin") !== "success") {
			alert('Login is not done, back to login');
			window.location.replace('main.html');		
		}else {
			createDeploymentSheet('All');
		}
		
		// for development only
		//createDeploymentSheet('All');
	});	
	
	$('#logoutBtn').click(function() {
	
		sessionStorage.removeItem("isLogin");
		sessionStorage.removeItem("userName");
		window.location.replace("main.html");
		
	});
	
	$( document ).ready(function() {
        //createDeploymentSheet('All');
    });

/*	
	$('#areaAscendingSort').click(function() {
		
		//console.log(storeArray);
		refreshTable('areaAscending');
	});
	
	$('#areaDescendingSort').click(function() {
		//console.log(storeArray);
		refreshTable('areaDescending');	
	});
	$('#regionAscendingSort').click(function() {
	
	
	});
	
	$('#regionDescendingSort').click(function() {
	
	
	});
	
function refreshTable(str) {
	
	if (str == 'areaAscending') {
		sortResults('area', true);	
	}else if (str == 'areaDescending') {
		sortResults('area', false);	
	}
}

function sortResults(prop, asc) {
    storeArray = storeArray.sort(function(a, b) {
        if (asc) {
            return (a[prop] > b[prop]) ? 1 : ((a[prop] < b[prop]) ? -1 : 0);
        } else {
            return (b[prop] > a[prop]) ? 1 : ((b[prop] < a[prop]) ? -1 : 0);
        }
    });
	console.log(storeArray);
}
*/
	
function createDeploymentSheet(src) {	

	s_code_merch = [];	//empty the array
	s_code_wages = [];
	s_code_allowance = [];

	$('#spinner-loading').css('visibility','visible');	// show spinner	
	$('#msg').text('');
	$('#merch_header option').removeAttr("selected");
	$('#input_wages').val('');
	$('#input_allowance').val('');
	
	// read the value of keys
	var period_h = $("#period_header").find(':selected').text();
	var batch_h = $("#batch_header").find(':selected').text();
	
	var data= {};
	
	// empty the table
	$("#table").empty();
	$("#excel_table").empty();
	
	var sortedBy = src;
	console.log("called by "+sortedBy);
	if (sortedBy=='All') {
		// reset the sorting keys
		sessionStorage.setItem('period', period_h);	// hard code for development only
		sessionStorage.setItem('batch', 'All');	
		sessionStorage.setItem('name_e', 'All');	
		sessionStorage.setItem('name_c', 'All');	
		sessionStorage.setItem('wages', 'All');
		sessionStorage.setItem('allowance', 'All');
		data = {"period":period_h,"batch":'All',"name_e":'All',"name_c":'All',"wages":'All',"allowance":'All'};
		console.log(data);
		
	}else if (sortedBy=='period') {
		sessionStorage.setItem('period', period_h);
		sessionStorage.setItem('batch', 'All');	
		sessionStorage.setItem('name_e', 'All');	
		sessionStorage.setItem('name_c', 'All');	
		sessionStorage.setItem('wages', 'All');
		sessionStorage.setItem('allowance', 'All');
		
		//reset all option selected when changes the period
		data = {"period":period_h,"batch":'All',"name_e":'All',"name_c":'All',"wages":'All',"allowance":'All'};
		console.log(data);
		
	}else if (sortedBy=='batch') {
		sessionStorage.setItem('period', period_h);
		sessionStorage.setItem('batch', batch_h);	
		sessionStorage.setItem('name_e', 'All');	
		sessionStorage.setItem('name_c', 'All');	
		sessionStorage.setItem('wages', 'All');
		sessionStorage.setItem('allowance', 'All');
		
		//reset all option selected when changes the period
		data = {"period":period_h,"batch":batch_h,"name_e":'All',"name_c":'All',"wages":'All',"allowance":'All'};
		console.log(data);
	}
	
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "createDeploymentSheet.php",
		data:data,
		success: function(response) {
			
			console.log(response);	
						 
			if (response['result'] === "success") {	
			
				$('#spinner-loading').css('visibility','hidden');	// hide spinner
				
				// update the data to global array for usage by other function
				storeArray = response.data;
				//console.log(storeArray);
				
				// empty jobArray
				jobArray =[];	
				// empty the previous num of jobs
				if (sortedBy=='All') {
					// do nothing;
				} else {
					//console.log("last num of jobs: "+lastNumOfJob);
					for (var i=0; i<lastNumOfJob; i++) {
						var p = 7;	//7 is the number of first job's column, 0 is the number of first column
						//$('#deployment').find('td:eq(6),th:eq(6)').remove();
						$('#deployment').find('td:eq('+p+'),th:eq('+p+')').remove();
						
						//for exporting to excel file
						$('#excel_file').find('td:eq('+p+'),th:eq('+p+')').remove();
					}
				}
				
				// update the num of jobs in the header row
				$.each(response.job, function(key,v) {	
					jobArray.push(response.job[key]);	//response.job is not an object, so using job[key]
						
					$('#deployment').find('tr').each(function(){ 
						var pos = key + 6;	//6 is the number of area's column, 0 is the number of first column
						$(this).find('th').eq(pos).after('<th class="w100">'+response.job[key]+'<br><select id="job_header_'+key+'" onchange="filterDeploymentSheet()" ><option value="all">All</option><option value="Y">Y</option></select></th>');
					});
					
					//for exporting to excel file
					$('#excel_file').find('tr').each(function(){ 
						var pos = key + 6;	//6 is the number of area's column, 0 is the number of first column
						$(this).find('th').eq(pos).after('<th class="w100">'+response.job[key]+'</th>');
					});
				});
				jobCount = jobArray.length;
				lastNumOfJob = jobCount;
				console.log('num of jobs: '+jobCount+', ['+jobArray+']');
				//console.log('data length: '+response.data.length);
				
				// build the table of jobs
				$.each(response.data, function(key,v) {
					
					var count = key + 1;
					
					var row = $('<tr><td class="w50">'+count+'<td class="w100" id="code_'+count+'">'+v.store_code+'</td><td class="w200" id="name_e">'+v.store_name_e+'</td><td class="w100" id="name_c">'+v.store_name_c+'</td><td class="w300" id="address">'+v.store_address+'</td><td class="w100" id="region">'+v.region+'</td><td class="w100" id="area">'+v.area+'</td>');
					
					//for exporting to excel file
					var excel_row = $('<tr><td class="w50">'+count+'<td class="w100" id="code_'+count+'">'+v.store_code+'</td><td class="w200" id="name_e">'+v.store_name_e+'</td><td class="w100" id="name_c">'+v.store_name_c+'</td><td class="w300" id="address">'+v.store_address+'</td><td class="w100" id="region">'+v.region+'</td><td class="w100" id="area">'+v.area+'</td>');	
					
					// add all jobs in deployment DB to array for comparison 
					var arr = [];
					arr.push(v.job0);
					arr.push(v.job1);
					arr.push(v.job2);
					arr.push(v.job3);
					arr.push(v.job4);
					arr.push(v.job5);
					arr.push(v.job6);
					arr.push(v.job7);
					arr.push(v.job8);
					arr.push(v.job9);
					//console.log(arr);
					
					// append 'Y' if a store contains same job as shown in header row
					for (var i=0; i<jobArray.length; i++) {
						
						var found = $.inArray(jobArray[i], arr);	// check if an array contains specific string
						if (found > -1 ) {	// string is found
							var job = $('<td class="w100" id="code" style="font-weight:bold">Y</td>');
							var excel_job = $('<td class="w100" id="code" style="font-weight:bold">Y</td>');
							job.appendTo(row);
							//for exporting to excel
							excel_job.appendTo(excel_row);
						}else {
							var job = $('<td class="w100" id="code" style="color:red">N</td>');
							var excel_job = $('<td class="w100" id="code" style="color:red">N</td>');
							job.appendTo(row);
							//for exporting to excel
							excel_job.appendTo(excel_row);
						}						
					}
					
					//append input field for wages, allowance, checkbox and merchandizer based on selected batch
					if (batch_h=='All') {
						var input =  $('<td class="w30"><input type="checkbox" name="checkbox_wages" id="checkbox_wages_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="wages_'+count+'" type="text" maxlength="10" class="w100" value="'+v.wages_all+'" name="wages"></td><td class="w30"><input type="checkbox" name="checkbox_allowance" id="checkbox_allowance_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="allowance_'+count+'" type="text" maxlength="10"  class="w100" value="'+v.allowance_all+'" name="allowance"></td>');
						input.appendTo(row);

						var mer =$('<td class="w30"><input type="checkbox" name="checkbox_merch" id="checkbox_merch_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100" id="merch_'+count+'" name="merch" >'+v.merchandizer_all+'</td></tr>');
						mer.appendTo(row);
						
						// for exporting to excel						
						var para = $('<td class="w100">'+v.wages_all+'</td><td class="w100">'+v.allowance_all+'</td><td class="w100">'+v.merchandizer_all+'</td></tr>');
						para.appendTo(excel_row);
					
					} else {
						var input =  $('<td class="w30"><input type="checkbox" name="checkbox_wages" id="checkbox_wages_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="wages_'+count+'" type="text" maxlength="10" class="w100" value="'+v.wages+'" name="wages"></td><td class="w30"><input type="checkbox" name="checkbox_allowance" id="checkbox_allowance_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="allowance_'+count+'" type="text" maxlength="10" class="w100" value="'+v.allowance+'" name="allowance"></td>');
						input.appendTo(row);

						var mer =$('<td class="w30"><input type="checkbox" name="checkbox_merch" id="checkbox_merch_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100" id="merch_'+count+'" name="merch">'+v.merchandizer+'</td></tr>');
						mer.appendTo(row);
						
						// for exporting to excel
						var para = $('<td class="w100">'+v.wages+'</td><td class="w100">'+v.allowance+'</td><td class="w100">'+v.merchandizer+'</td></tr>');
						para.appendTo(excel_row);
					}
					
					//append key message and merchandizer
					//var msg =$('<td class="w200" id="message">'+v.key_msg+'</td>
					//var mer =$('<td class="w100"><input id="merch_'+count+'" name="merch" type="text" class="w100" value="'+v.merchandizer+'"></td></tr>');
					//mer.appendTo(row);
					
					row.appendTo('#table');						
					
					// create table for exporting excel file					
					excel_row.appendTo('#excel_table');
				});
				
				
				
				// refresh the option in store name select
				$("#storename_e_header").empty();
				var row_name_e = $('<option value=All>All</option>');
				row_name_e.appendTo('#storename_e_header');				
				$.each(response.name_e, function(key,v) {					
					// update the store name keys in option	
					if (response.name_e[key]!="") {
						if (response.name_e[key] == sessionStorage.getItem('name_e')) {					
							row_name_e = $('<option value='+response.name_e[key]+' selected>'+response.name_e[key]+'</option>');
						} else {
							row_name_e = $('<option value='+response.name_e[key]+'>'+response.name_e[key]+'</option>');
						}
					}
					row_name_e.appendTo('#storename_e_header');					
				});
				
				// refresh the option in 舖名 select
				$("#storename_c_header").empty();
				var row_name_c = $('<option value=All>All</option>');
				row_name_c.appendTo('#storename_c_header');				
				$.each(response.name_c, function(key,v) {					
					// update the 舖名 keys in option
					if (response.name_c[key]!="") {
						if (response.name_c[key] == sessionStorage.getItem('name_c')) {					
							row_name_c = $('<option value='+response.name_c[key]+' selected>'+response.name_c[key]+'</option>');
						} else {
							row_name_c = $('<option value='+response.name_c[key]+'>'+response.name_c[key]+'</option>');
						}
					}
					row_name_c.appendTo('#storename_c_header');					
				});
				
				// refresh the option in batch select
				if (sortedBy!='batch') {
					$("#batch_header").empty();
					var row_batch = $('<option value=All>All</option>');
					row_batch.appendTo('#batch_header');				
					$.each(response.batch, function(key,v) {					
						// update the batch keys in option	
						if (response.batch[key] == sessionStorage.getItem('batch')) {					
							row_batch = $('<option value='+response.batch[key]+' selected>'+response.batch[key]+'</option>');
						} else {
							row_batch = $('<option value='+response.batch[key]+'>'+response.batch[key]+'</option>');
						}
						row_batch.appendTo('#batch_header');					
					});	
				}				
				
				// refresh the option in wages select
				$("#wages_header").empty();
				var row_wages = $('<option value=All>All</option>');
				row_wages.appendTo('#wages_header');				
				$.each(response.wages, function(key,v) {					
					// update the wages keys in option	
					if (response.wages[key]!="") {
						if (response.wages[key] == sessionStorage.getItem('wages')) {					
							row_wages = $('<option value='+response.wages[key]+' selected>'+response.wages[key]+'</option>');
						} else {
							row_wages = $('<option value='+response.wages[key]+'>'+response.wages[key]+'</option>');
						}
					}
					row_wages.appendTo('#wages_header');					
				});	
				
				// refresh the option in allowance select
				$("#allowance_header").empty();
				var row_allowance = $('<option value=All>All</option>');
				row_allowance.appendTo('#allowance_header');				
				$.each(response.allowance, function(key,v) {					
					// update the allowance keys in option	
					if (response.allowance[key]!="") {
						if (response.allowance[key] == sessionStorage.getItem('allowance')) {					
							row_allowance = $('<option value='+response.allowance[key]+' selected>'+response.allowance[key]+'</option>');
						} else {
							row_allowance = $('<option value='+response.allowance[key]+'>'+response.allowance[key]+'</option>');
						}
					}
					row_allowance.appendTo('#allowance_header');					
				});
				
				inputValidation();
				selectStores();
			} 
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
};


function updateDeploymentSheet(src) {
	
	s_code_merch = [];	//empty the array
	s_code_wages = [];
	s_code_allowance = [];
	
	$('#spinner-loading').css('visibility','visible');	// show spinner	
	$('#msg').text('');
	$('#merch_header option').removeAttr("selected");
	$('#input_wages').val('');
	$('#input_allowance').val('');
	
	// read the value of keys
	var period_h = $("#period_header").find(':selected').text();
	var batch_h = $("#batch_header").find(':selected').text();
	var name_e_h = $("#storename_e_header").find(':selected').text();
	var name_c_h = $("#storename_c_header").find(':selected').text();
	var wages_h = $("#wages_header").find(':selected').text();
	var allowance_h = $("#allowance_header").find(':selected').text();
	//var code_h = $("#storecode_header").find(':selected').text();
	
	var data = {"period":period_h,"batch":batch_h,"name_e":name_e_h,"name_c":name_c_h,"wages":wages_h,"allowance":allowance_h};
	console.log(data);
	
	// empty the table
	$("#table").empty();
	$("#excel_table").empty();
	
	var sortedBy = src;
	console.log("called by "+sortedBy);
	
	if (sortedBy=='name_e') {
		sessionStorage.setItem('name_e', name_e_h);
	}
	else if (sortedBy=='name_c') {
		sessionStorage.setItem('name_c', name_c_h);
	}						
	else if (sortedBy=='wages') {
		sessionStorage.setItem('wages', wages_h);
	} 
	else if (sortedBy=='allowance') {
		sessionStorage.setItem('allowance', allowance_h);
	}
	
	
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "updateDeploymentSheet.php",
		data:data,
		success: function(response) {
			
			console.log(response);	
						 
			if (response['result'] === "success") {	
			
				$('#spinner-loading').css('visibility','hidden');	// hide spinner
				
				// update the data to global array for usage by other function
				storeArray = response.data;	
			
				// refresh the number of jobs in header row
				// empty jobArray
				jobArray =[];
				
				// empty the previous num of jobs
				if (sortedBy=='All') {
					// do nothing;
				} else {
					//console.log("last num of jobs: "+lastNumOfJob);
					for (var i=0; i<lastNumOfJob; i++) {
						var p = 7;	//7 is the number of first job's column, 0 is the number of first column
						//$('#deployment').find('td:eq(6),th:eq(6)').remove();
						$('#deployment').find('td:eq('+p+'),th:eq('+p+')').remove();
						
						//for exporting to excel file
						$('#excel_file').find('td:eq('+p+'),th:eq('+p+')').remove();
					}
				}
				
				// update the num of jobs in the header row
				$.each(response.job, function(key,v) {	
					jobArray.push(response.job[key]);	//response.job is not an object, so using job[key]

					$('#deployment').find('tr').each(function(){ 
						var pos = key + 6;	//6 is the number of area's column, 0 is the number of first column
						$(this).find('th').eq(pos).after('<th class="w100">'+response.job[key]+'<br><select id="job_header_'+key+'" onchange="filterDeploymentSheet()" ><option value="all">All</option><option value="Y">Y</option></select></th>');
					});
					//for exporting to excel file
					$('#excel_file').find('tr').each(function(){ 
						var pos = key + 6;	//6 is the number of area's column, 0 is the number of first column
						$(this).find('th').eq(pos).after('<th class="w100">'+response.job[key]+'</th>');
					});
				});
				jobCount = jobArray.length;
				lastNumOfJob = jobCount;
				console.log('num of jobs: '+jobCount+', ['+jobArray+']');
				//console.log('data length: '+response.data.length);
				
				// build the table of jobs
				$.each(response.data, function(key,v) {
					
					var count = key + 1;
					
					var row = $('<tr><td class="w50">'+count+'<td class="w100" id="code_'+count+'">'+v.store_code+'</td><td class="w200" id="name_e">'+v.store_name_e+'</td><td class="w100" id="name_c">'+v.store_name_c+'</td><td class="w300" id="address">'+v.store_address+'</td><td class="w100" id="region">'+v.region+'</td><td class="w100" id="area">'+v.area+'</td>');
					
					//for exporting to excel file
					var excel_row = $('<tr><td class="w50">'+count+'<td class="w100" id="code_'+count+'">'+v.store_code+'</td><td class="w200" id="name_e">'+v.store_name_e+'</td><td class="w100" id="name_c">'+v.store_name_c+'</td><td class="w300" id="address">'+v.store_address+'</td><td class="w100" id="region">'+v.region+'</td><td class="w100" id="area">'+v.area+'</td>');	
					
					// add all jobs in deployment DB to array for comparison 
					var arr = [];
					arr.push(v.job0);
					arr.push(v.job1);
					arr.push(v.job2);
					arr.push(v.job3);
					arr.push(v.job4);
					arr.push(v.job5);
					arr.push(v.job6);
					arr.push(v.job7);
					arr.push(v.job8);
					arr.push(v.job9);
					//console.log(arr);
					
					// append 'Y' if a store contains same job as shown in header row
					for (var i=0; i<jobArray.length; i++) {
						
						var found = $.inArray(jobArray[i], arr);	// check if an array contains specific string
						if (found > -1 ) {
							var job = $('<td class="w100" id="code" style="font-weight:bold">Y</td>');
							var excel_job = $('<td class="w100" id="code" style="font-weight:bold">Y</td>');
							job.appendTo(row);
							excel_job.appendTo(excel_row);
						}else {
							var job = $('<td class="w100" id="code" style="color:red">N</td>');
							var excel_job = $('<td class="w100" id="code" style="color:red">N</td>');
							job.appendTo(row);
							excel_job.appendTo(excel_row);
						}						
					}
					
					//append input field for wages and allowance, merchandizer based on selected batch
					if (batch_h=='All') {
						var input =  $('<td class="w30"><input type="checkbox" name="checkbox_wages" id="checkbox_wages_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="wages_'+count+'" type="text" maxlength="10" class="w100" value="'+v.wages_all+'" name="wages"></td><td class="w30"><input type="checkbox" name="checkbox_allowance" id="checkbox_allowance_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="allowance_'+count+'" type="text" maxlength="10"  class="w100" value="'+v.allowance_all+'" name="allowance"></td>');
						input.appendTo(row);

						var mer =$('<td class="w30"><input type="checkbox" name="checkbox_merch" id="checkbox_merch_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100" id="merch_'+count+'" name="merch" >'+v.merchandizer_all+'</td></tr>');
						mer.appendTo(row);
						
						// for exporting to excel						
						var para = $('<td class="w100">'+v.wages_all+'</td><td class="w100">'+v.allowance_all+'</td><td class="w100">'+v.merchandizer_all+'</td></tr>');
						para.appendTo(excel_row);
					
					} else {
						var input =  $('<td class="w30"><input type="checkbox" name="checkbox_wages" id="checkbox_wages_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="wages_'+count+'" type="text" maxlength="10" class="w100" value="'+v.wages+'" name="wages"></td><td class="w30"><input type="checkbox" name="checkbox_allowance" id="checkbox_allowance_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="allowance_'+count+'" type="text" maxlength="10" class="w100" value="'+v.allowance+'" name="allowance"></td>');
						input.appendTo(row);

						var mer =$('<td class="w30"><input type="checkbox" name="checkbox_merch" id="checkbox_merch_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100" id="merch_'+count+'" name="merch">'+v.merchandizer+'</td></tr>');
						mer.appendTo(row);
						
						// for exporting to excel
						var para = $('<td class="w100">'+v.wages+'</td><td class="w100">'+v.allowance+'</td><td class="w100">'+v.merchandizer+'</td></tr>');
						para.appendTo(excel_row);
					}
					
					//append key message and merchandizer
					//var msg =$('<td class="w200" id="message">'+v.key_msg+'</td>
					//var mer =$('<td class="w100"><input id="merch_'+count+'" name="merch" type="text" class="w100" value="'+v.merchandizer+'"></td></tr>');
					//mer.appendTo(row);
					
					row.appendTo('#table');

					// create table for exporting excel file					
					excel_row.appendTo('#excel_table');
				});
				
				
				// refresh the option in store name select
				if (sortedBy!='name_e') {
					$("#storename_e_header").empty();
					//var row_name_e;
					var row_name_e = $('<option value=All>All</option>');
					row_name_e.appendTo('#storename_e_header');				
					$.each(response.name_e, function(key,v) {					
						// update the store name keys in option	
						if (response.name_e[key]!="") {
							if (response.name_e[key] == sessionStorage.getItem('name_e')) {					
								row_name_e = $('<option value='+response.name_e[key]+' selected>'+response.name_e[key]+'</option>');
							} else {
								row_name_e = $('<option value='+response.name_e[key]+'>'+response.name_e[key]+'</option>');
							}
						}
						row_name_e.appendTo('#storename_e_header');					
					});
				}
				
				// refresh the option in 舖名 select
				if (sortedBy!='name_c') {
					$("#storename_c_header").empty();
					//var row_name_c;
					var row_name_c = $('<option value=All>All</option>');
					row_name_c.appendTo('#storename_c_header');				
					$.each(response.name_c, function(key,v) {					
						// update the 舖名 keys in option	
						if (response.name_c[key]!="") {
							if (response.name_c[key] == sessionStorage.getItem('name_c')) {					
								row_name_c = $('<option value='+response.name_c[key]+' selected>'+response.name_c[key]+'</option>');
							} else {
								row_name_c = $('<option value='+response.name_c[key]+'>'+response.name_c[key]+'</option>');
							}
						}
						row_name_c.appendTo('#storename_c_header');					
					});
				}
				
				// refresh the option in wages select
				//if (sortedBy!='wages') {
					$("#wages_header").empty();
					//var row_wages;
					var row_wages = $('<option value=All>All</option>');
					row_wages.appendTo('#wages_header');				
					$.each(response.wages, function(key,v) {					
						// update the wages keys in option	
						if (response.wages[key]!="") {
							if (response.wages[key] == sessionStorage.getItem('wages')) {					
								row_wages = $('<option value='+response.wages[key]+' selected>'+response.wages[key]+'</option>');
							} else {
								row_wages = $('<option value='+response.wages[key]+'>'+response.wages[key]+'</option>');
							}
						}
						row_wages.appendTo('#wages_header');					
					});	
				//}
				
				// refresh the option in allowance select
				//if (sortedBy!='allowance') {
					$("#allowance_header").empty();
					//var row_allowance;
					var row_allowance = $('<option value=All>All</option>');
					row_allowance.appendTo('#allowance_header');				
					$.each(response.allowance, function(key,v) {					
						// update the allowance keys in option	
						if (response.allowance[key]!="") {
							if (response.allowance[key] == sessionStorage.getItem('allowance')) {					
								row_allowance = $('<option value='+response.allowance[key]+' selected>'+response.allowance[key]+'</option>');
							} else {
								row_allowance = $('<option value='+response.allowance[key]+'>'+response.allowance[key]+'</option>');
							}
						}
						row_allowance.appendTo('#allowance_header');					
					});
				//}
				
				inputValidation();
				selectStores();
			}	
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
}	

function filterDeploymentSheet() {
	
	s_code_merch = [];	//empty the array
	s_code_wages = [];
	s_code_allowance = [];
	
	$('#spinner-loading').css('visibility','visible');	// show spinner
	$('#msg').text('');
	$('#merch_header option').removeAttr("selected");
	$('#input_wages').val('');
	$('#input_allowance').val('');
	
	if ($("#job_header_0").find(':selected').text()=='Y') var job0 = jobArray[0];
	else job0 = 'All';	
	if ($("#job_header_1").find(':selected').text()=='Y') var job1 = jobArray[1];
	else job1 = 'All';
	if ($("#job_header_2").find(':selected').text()=='Y') var job2 = jobArray[2];
	else job2 = 'All';
	if ($("#job_header_3").find(':selected').text()=='Y') var job3 = jobArray[3];
	else job3 = 'All';
	if ($("#job_header_4").find(':selected').text()=='Y') var job4 = jobArray[4];
	else job4 = 'All';
	if ($("#job_header_5").find(':selected').text()=='Y') var job5 = jobArray[5];
	else job5 = 'All';
	if ($("#job_header_6").find(':selected').text()=='Y') var job6 = jobArray[6];
	else job6 = 'All';
	if ($("#job_header_7").find(':selected').text()=='Y') var job7 = jobArray[7];
	else job7 = 'All';
	if ($("#job_header_8").find(':selected').text()=='Y') var job8 = jobArray[8];
	else job8 = 'All';
	if ($("#job_header_9").find(':selected').text()=='Y') var job9 = jobArray[9];
	else job9 = 'All';
	
	var period_h = $("#period_header").find(':selected').text();
	var batch_h = $("#batch_header").find(':selected').text();
	
	var data = {"job0":job0,"job1":job1,"job2":job2,"job3":job3,"job4":job4,"job5":job5,"job6":job6,"job7":job7,"job8":job8,"job9":job9,"batch":batch_h,"period":period_h};
	console.log(data);
	
	// empty the table
	$("#table").empty();
	$("#excel_table").empty();
	
	
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "filterDeploymentSheet.php",
		data:data,
		success: function(response) {
			
			console.log(response);	
						 
			if (response['result'] === "success") {	
			
				$('#spinner-loading').css('visibility','hidden');	// hide spinner
				
				// update the data to global array for usage by other function
				storeArray = response.data;	
				
				// build the table of jobs
				$.each(response.data, function(key,v) {
					
					var count = key + 1;
					
					var row = $('<tr><td class="w50">'+count+'<td class="w100" id="code_'+count+'">'+v.store_code+'</td><td class="w200" id="name_e">'+v.store_name_e+'</td><td class="w100" id="name_c">'+v.store_name_c+'</td><td class="w300" id="address">'+v.store_address+'</td><td class="w100" id="region">'+v.region+'</td><td class="w100" id="area">'+v.area+'</td>');
					
					//for exporting to excel file
					var excel_row = $('<tr><td class="w50">'+count+'<td class="w100" id="code_'+count+'">'+v.store_code+'</td><td class="w200" id="name_e">'+v.store_name_e+'</td><td class="w100" id="name_c">'+v.store_name_c+'</td><td class="w300" id="address">'+v.store_address+'</td><td class="w100" id="region">'+v.region+'</td><td class="w100" id="area">'+v.area+'</td>');	
					
					// add all jobs in deployment DB to array for comparison 
					var arr = [];
					arr.push(v.job0);
					arr.push(v.job1);
					arr.push(v.job2);
					arr.push(v.job3);
					arr.push(v.job4);
					arr.push(v.job5);
					arr.push(v.job6);
					arr.push(v.job7);
					arr.push(v.job8);
					arr.push(v.job9);
					//console.log(arr);
					
					// append 'Y' if a store contains same job as shown in header row
					for (var i=0; i<jobArray.length; i++) {
						
						var found = $.inArray(jobArray[i], arr);	// check if an array contains specific string
						if (found > -1 ) {
							var job = $('<td class="w100" id="code" style="font-weight:bold">Y</td>');
							var excel_job = $('<td class="w100" id="code" style="font-weight:bold">Y</td>');
							job.appendTo(row);
							excel_job.appendTo(excel_row);
						}else {
							var job = $('<td class="w100" id="code" style="color:red">N</td>');
							var excel_job = $('<td class="w100" id="code" style="color:red">N</td>');
							job.appendTo(row);
							excel_job.appendTo(excel_row);
						}						
					}
					
					//append input field for wages and allowance, merchandizer based on selected batch
					if (batch_h=='All') {
						var input =  $('<td class="w30"><input type="checkbox" name="checkbox_wages" id="checkbox_wages_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="wages_'+count+'" type="text" maxlength="10" class="w100" value="'+v.wages_all+'" name="wages"></td><td class="w30"><input type="checkbox" name="checkbox_allowance" id="checkbox_allowance_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="allowance_'+count+'" type="text" maxlength="10"  class="w100" value="'+v.allowance_all+'" name="allowance"></td>');
						input.appendTo(row);

						var mer =$('<td class="w30"><input type="checkbox" name="checkbox_merch" id="checkbox_merch_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100" id="merch_'+count+'" name="merch" >'+v.merchandizer_all+'</td></tr>');
						mer.appendTo(row);
						
						// for exporting to excel						
						var para = $('<td class="w100">'+v.wages_all+'</td><td class="w100">'+v.allowance_all+'</td><td class="w100">'+v.merchandizer_all+'</td></tr>');
						para.appendTo(excel_row);
					
					} else {
						var input =  $('<td class="w30"><input type="checkbox" name="checkbox_wages" id="checkbox_wages_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="wages_'+count+'" type="text" maxlength="10" class="w100" value="'+v.wages+'" name="wages"></td><td class="w30"><input type="checkbox" name="checkbox_allowance" id="checkbox_allowance_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100"><input id="allowance_'+count+'" type="text" maxlength="10" class="w100" value="'+v.allowance+'" name="allowance"></td>');
						input.appendTo(row);

						var mer =$('<td class="w30"><input type="checkbox" name="checkbox_merch" id="checkbox_merch_'+count+'" style="margin: 5px 0" value="'+count+'"></td><td class="w100" id="merch_'+count+'" name="merch">'+v.merchandizer+'</td></tr>');
						mer.appendTo(row);
						
						// for exporting to excel
						var para = $('<td class="w100">'+v.wages+'</td><td class="w100">'+v.allowance+'</td><td class="w100">'+v.merchandizer+'</td></tr>');
						para.appendTo(excel_row);
					}				 
					//append merchandizer					
					//var mer =$('<td class="w100"><input id="merch_'+count+'" name="merch" type="text" class="w100" value="'+v.merchandizer+'"></td></tr>');
					//mer.appendTo(row);
					
					row.appendTo('#table');	

					// create table for exporting excel file					
					excel_row.appendTo('#excel_table');
				});
				
				
				// refresh the option in store name select
				$("#storename_e_header").empty();
				var row_name_e = $('<option value=All>All</option>');
				row_name_e.appendTo('#storename_e_header');				
				$.each(response.name_e, function(key,v) {	
					
					// update the store name keys in option	
					if (response.name_e[key]!="") {
						if (response.name_e[key] == sessionStorage.getItem('name_e')) {					
							row_name_e = $('<option value='+response.name_e[key]+' selected>'+response.name_e[key]+'</option>');
						} else {
							row_name_e = $('<option value='+response.name_e[key]+'>'+response.name_e[key]+'</option>');
						}
					}
					row_name_e.appendTo('#storename_e_header');					
				});
				
				// refresh the option in 舖名 select
				$("#storename_c_header").empty();
				var row_name_c = $('<option value=All>All</option>');
				row_name_c.appendTo('#storename_c_header');				
				$.each(response.name_c, function(key,v) {					
					// update the 舖名 keys in option	
					if (response.name_c[key]!="") {
						if (response.name_c[key] == sessionStorage.getItem('name_c')) {					
							row_name_c = $('<option value='+response.name_c[key]+' selected>'+response.name_c[key]+'</option>');
						} else {
							row_name_c = $('<option value='+response.name_c[key]+'>'+response.name_c[key]+'</option>');
						}
					}
					row_name_c.appendTo('#storename_c_header');					
				});
				
				// refresh the option in wages select
				$("#wages_header").empty();
				var row_wages = $('<option value=All>All</option>');
				row_wages.appendTo('#wages_header');				
				$.each(response.wages, function(key,v) {					
					// update the wages keys in option
					if (response.wages[key]!="") {					
						if (response.wages[key] == sessionStorage.getItem('wages')) {					
							row_wages = $('<option value='+response.wages[key]+' selected>'+response.wages[key]+'</option>');
						} else {
							row_wages = $('<option value='+response.wages[key]+'>'+response.wages[key]+'</option>');
						}
					}
					row_wages.appendTo('#wages_header');					
				});	
				
				// refresh the option in allowance select
				$("#allowance_header").empty();
				var row_allowance = $('<option value=All>All</option>');
				row_allowance.appendTo('#allowance_header');				
				$.each(response.allowance, function(key,v) {					
					// update the allowance keys in option	
					if (response.allowance[key]!="") {
						if (response.allowance[key] == sessionStorage.getItem('allowance')) {					
							row_allowance = $('<option value='+response.allowance[key]+' selected>'+response.allowance[key]+'</option>');
						} else {
							row_allowance = $('<option value='+response.allowance[key]+'>'+response.allowance[key]+'</option>');
						}
					}
					row_allowance.appendTo('#allowance_header');					
				});	
				
				inputValidation();
				selectStores();
			}
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
	
}





$("#clearAll_wages").click(function(){
	console.log("Clear wages selection...");
	$('[id^=checkbox_wages_]').prop("checked", false);
	//storeSelected = 0;
	s_code_wages.length = 0;	//empty an array
	$('#input_wages').val('');
	console.log("s_code_wages has "+s_code_wages.length+" data == "+s_code_wages);
	//$('#storeSelected').text('0');
});

$("#selectAll_wages").click(function(){
	console.log("select "+$('[id^=checkbox_wages]').length+" stores...");
	$('[id^=checkbox_wages_]').prop("checked", true);
	//storeSelected = $('[id^=checkbox_]').length;
	s_code_wages.length = 0;	//firstly empty an array	
	getCheckedBoxes('wages');
	console.log("s_code_wages has "+s_code_wages.length+" data == "+s_code_wages);
	//$('#storeSelected').text($('[id^=checkbox_]').length);	
});

$("#clearAll_allowance").click(function(){
	console.log("Clear allowance selection...");
	$('[id^=checkbox_allowance_]').prop("checked", false);
	//storeSelected = 0;
	s_code_allowance.length = 0;	//empty an array
	$('#input_allowance').val('');
	console.log("s_code_allowance has "+s_code_allowance.length+" data == "+s_code_allowance);
	//$('#storeSelected').text('0');
});

$("#selectAll_allowance").click(function(){
	console.log("select "+$('[id^=checkbox_allowance]').length+" stores...");
	$('[id^=checkbox_allowance_]').prop("checked", true);
	//storeSelected = $('[id^=checkbox_]').length;
	s_code_allowance.length = 0;	//firstly empty an array	
	getCheckedBoxes('allowance');
	console.log("s_code_allowance has "+s_code_allowance.length+" data == "+s_code_allowance);
	//$('#storeSelected').text($('[id^=checkbox_]').length);	
});

$("#clearAll_merch").click(function(){
	console.log("Clear merch selection...");
	$('[id^=checkbox_merch_]').prop("checked", false);
	//storeSelected = 0;
	s_code_merch.length = 0;	//empty an array
	console.log("s_code_merch has "+s_code_merch.length+" data == "+s_code_merch);
	//$('#storeSelected').text('0');
});

$("#selectAll_merch").click(function(){
	console.log("select "+$('[id^=checkbox_merch_]').length+" stores...");
	$('[id^=checkbox_merch_]').prop("checked", true);
	//storeSelected = $('[id^=checkbox_]').length;
	s_code_merch.length = 0;	//firstly empty an array	
	getCheckedBoxes('merch');
	console.log("s_code_merch has "+s_code_merch.length+" data == "+s_code_merch);
	//$('#storeSelected').text($('[id^=checkbox_]').length);	
});


function getCheckedBoxes(type) {
	
	if (type=='merch') {
		var checkboxes = document.getElementsByName("checkbox_merch");
		// loop over them all
		for (var i=0; i<checkboxes.length; i++) {
			// And stick the checked ones onto an array...
			if (checkboxes[i].checked) {
			s_code_merch.push(checkboxes[i].value);
			}
		}
	}
	else if (type=='wages') {
		var checkboxes = document.getElementsByName("checkbox_wages");
		for (var i=0; i<checkboxes.length; i++) {
			// And stick the checked ones onto an array...
			if (checkboxes[i].checked) {
			s_code_wages.push(checkboxes[i].value);
			}
		}
	}
	else if (type=='allowance') {
		var checkboxes = document.getElementsByName("checkbox_allowance");
		for (var i=0; i<checkboxes.length; i++) {
			// And stick the checked ones onto an array...
			if (checkboxes[i].checked) {
			s_code_allowance.push(checkboxes[i].value);
			}
		}
	}
	
	//console.log(s_code.length > 0 ? s_code : null);
	//return(s_code.length > 0 ? s_code : null);
}

function selectStores() {
	
	$('input[type="checkbox"]').change(function(){	
	
		var cbId = this.id;
		var cbValue = this.value;	//checkbox value is store code 
		
		if (cbId.search('checkbox_merch_') != -1) {
		
			if ($('#'+cbId).is(':checked')) {
				console.log(cbId+" is checked.");
				s_code_merch.push(cbValue);
				console.log("s_code_merch has "+s_code_merch.length+" data == "+s_code_merch);
				var status = 'checked';
				//updateNumStoreSelected(cbId, cbValue, status);
			}else {
				console.log(cbId+" is unchecked.");
				var index = s_code_merch.indexOf(cbValue);
				if (index > -1) {
					s_code_merch.splice(index, 1);
				}
				console.log("s_code_merch has "+s_code_merch.length+" data == "+s_code_merch);
				var status = 'unchecked';
				//updateNumStoreSelected(cbId, cbValue, status);
			}
		} else if (cbId.search('checkbox_wages_') != -1) {
		
			if ($('#'+cbId).is(':checked')) {
				console.log(cbId+" is checked.");
				s_code_wages.push(cbValue);
				console.log("s_code_wages has "+s_code_wages.length+" data == "+s_code_wages);
				var status = 'checked';
				//updateNumStoreSelected(cbId, cbValue, status);
			}else {
				console.log(cbId+" is unchecked.");
				var index = s_code_wages.indexOf(cbValue);
				if (index > -1) {
					s_code_wages.splice(index, 1);
				}
				console.log("s_code_wages has "+s_code_wages.length+" data == "+s_code_wages);
				var status = 'unchecked';
				//updateNumStoreSelected(cbId, cbValue, status);
			}
		} else if (cbId.search('checkbox_allowance_') != -1) {
		
			if ($('#'+cbId).is(':checked')) {
				console.log(cbId+" is checked.");
				s_code_allowance.push(cbValue);
				console.log("s_code_allowance has "+s_code_allowance.length+" data == "+s_code_allowance);
				var status = 'checked';
				//updateNumStoreSelected(cbId, cbValue, status);
			}else {
				console.log(cbId+" is unchecked.");
				var index = s_code_allowance.indexOf(cbValue);
				if (index > -1) {
					s_code_allowance.splice(index, 1);
				}
				console.log("s_code_allowance has "+s_code_allowance.length+" data == "+s_code_allowance);
				var status = 'unchecked';
				//updateNumStoreSelected(cbId, cbValue, status);
			}
		} 
	});
	
}

function inputValidation() {
	
	// update database if the value in wages/allowance is changed
	/*
	$('input[type="text"]').change(function() {	
		// it must update database immediately, else the sorting function does not work
		var btnId = $(this).attr('id');						
		updateJobSheet(btnId);						
	});
	*/

	$('input[type="text"]').bind("change paste keyup", function() {
	   //console.log($(this).val()); 
	});
	
	// to validate if the input is digit only
	//$('input[type="text"]').keyup(function(e){  
	$('input[type="text"]').change(function() {	 	
		var str = $.trim( $(this).val() );
		if( str != "" ) {			  
			var fieldId = $(this).attr('id');
			if ((fieldId.search('wages_') != -1)||(fieldId.search('allowance_') != -1)) { 
				if (!$.isNumeric(str)) {
					//$("#msg").html("Only number allowed !").css("color","red");
					alert("Only number allowed !");
				}else{
					$("#msg").html("");	
					updateJobSheet(fieldId);		
				}
			}		  
			else{
				$("#msg").html("");					
			}
		}
		else {
			$("#msg").html("");
		}
	});
}

function updateJobSheet(fieldId) {
	
	var btnId = fieldId;	
	var n = btnId.indexOf("_");
	btnNum = btnId.substr(n+1,btnId.length);	
	console.log(btnId+" is changed, store code="+storeArray[btnNum-1].store_code);
	
	if (btnId.search('allowance_') != -1) {
		sessionStorage.setItem('selectedType', 'allowance');
		sessionStorage.setItem("allowance", $("#allowance_"+btnNum).val());
		sessionStorage.setItem("wages", "All");
	} else {		
		sessionStorage.setItem('selectedType', 'wages');
		sessionStorage.setItem("wages", $("#wages_"+btnNum).val());
		sessionStorage.setItem("allowance", "All");
	}
	//console.log('select type: '+sessionStorage.getItem('selectedType'));
	
	var obj={
		"code":$("#code_"+btnNum).text(),
		"wages":$("#wages_"+btnNum).val(),
		"allowance":$("#allowance_"+btnNum).val(),
		//"merchandizer":$("#merch_"+btnNum).val(),		
		"period":$("#period_header").find(':selected').text(),
		"batch":$("#batch_header").find(':selected').text()
	}
	
	console.log("obj = "+ JSON.stringify(obj));
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "updateJobSheet.php",
		data:obj,
		success: function(response) {
			console.log('response == '+response);							
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});	
	
	setTimeout(refreshWagesAndAllowanceOption, 1000);	
}

function refreshWagesAndAllowanceOption() {
	
	var period_h = $("#period_header").find(':selected').text();
	var batch_h = $("#batch_header").find(':selected').text();
	var data = {"batch":batch_h,"period":period_h};
	console.log(data);
	
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "getWagesAllowance.php",
		data:data,
		success: function(response) {
			
			console.log(response);							 
			if (response['result'] === "success") {	
			
				// refresh the option in wages select
				$("#wages_header").empty();
				var row_wages = $('<option value=All>All</option>');
				row_wages.appendTo('#wages_header');				
				$.each(response.wages, function(key,v) {					
					// update the wages keys in option
					if (response.wages[key]!="") {					
						if (response.wages[key] == sessionStorage.getItem('wages')) {	
							if (sessionStorage.getItem('selectedType') == 'wages') {
								row_wages = $('<option value='+response.wages[key]+' selected>'+response.wages[key]+'</option>');								
							}else {
								row_wages = $('<option value='+response.wages[key]+'>'+response.wages[key]+'</option>');
							}							
						} else {
							row_wages = $('<option value='+response.wages[key]+'>'+response.wages[key]+'</option>');
						}
					}
					row_wages.appendTo('#wages_header');					
				});	
				
				// refresh the option in allowance select
				$("#allowance_header").empty();
				var row_allowance = $('<option value=All>All</option>');
				row_allowance.appendTo('#allowance_header');				
				$.each(response.allowance, function(key,v) {					
					// update the allowance keys in option	
					if (response.allowance[key]!="") {
						if (response.allowance[key] == sessionStorage.getItem('allowance')) {	
							if (sessionStorage.getItem('selectedType') == 'allowance') {	
								row_allowance = $('<option value='+response.allowance[key]+' selected>'+response.allowance[key]+'</option>');
								
							}else {
								row_allowance = $('<option value='+response.allowance[key]+'>'+response.allowance[key]+'</option>');
							}								
						}else {
							row_allowance = $('<option value='+response.allowance[key]+'>'+response.allowance[key]+'</option>');
						}
					}
					row_allowance.appendTo('#allowance_header');					
				});	
			}
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
}

function chooseMerchandizer() {

	var merch = $("#merch_header").find(':selected').text();
	/*if (merch != 'Please select') {
		var merchandizers = document.getElementsByName("merch");
		//console.log("num of text input for merchandizer: "+merchandizers.length);
		for (var i=0; i<merchandizers.length; i++) {
			var uid = merchandizers[i].id;
			//console.log(uid);
			$('#'+uid).val(merch);
			updateJobSheet(uid);
		}
	}*/
	if (merch != 'Please select') {
		for (var i=0; i<s_code_merch.length; i++) {
			var merchId = 'merch_'+s_code_merch[i];
			console.log(merchId);
			$('#'+merchId).text(merch);
		}
		uploadMerchandizers();	
	}
	//s_code_merch = [];	// if empty array here, user cannot change another merchandizer with same checkboxes checked.
	$('#merch_header option').removeAttr("selected");
}

function uploadMerchandizers() {
	
	var merchandizers = [];	//reset array
	merchandizers = document.getElementsByName("merch");
	console.log("num of merchandizer: "+merchandizers.length);
	
	for (var i=0; i<merchandizers.length; i++) {
		var merchId = merchandizers[i].id;			
		var obj={
			"code":storeArray[i].store_code,				
			"merchandizer":$("#"+merchId).text(),		
			"period":$("#period_header").find(':selected').text(),
			"batch":$("#batch_header").find(':selected').text()
		}
		
		console.log("obj = "+ JSON.stringify(obj));
		
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "updateJobSheet_merch.php",
			data:obj,
			success: function(response) {
				console.log('response == '+response);							
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	}
}

function typeWagesOrAllowance(type){
	
	if (type=='wages') {
		$('#input_wages').change(function() {	 	
			var str = $.trim( $(this).val() );
			if( str != "" ) {			  
				
				if (!$.isNumeric(str)) {
					//$("#msg").html("Only number allowed !").css("color","red");
					alert("Only number allowed !");
				}else{
					$("#msg").html("");	
					for (var i=0; i<s_code_wages.length; i++) {
						var wagesId = 'wages_'+s_code_wages[i];
						//console.log(wagesId);
						$('#'+wagesId).val(str);
					}
					sessionStorage.setItem('selectedType', 'wages');
					sessionStorage.setItem("wages", str);
					sessionStorage.setItem("allowance", "All");
					uploadWagesAndAllowance('wages');
				}		
			}
			else {
				$("#msg").html("");
			}
		});
	} else {
		$('#input_allowance').change(function() {	 	
			var str = $.trim( $(this).val() );
			if( str != "" ) {			  
				
				if (!$.isNumeric(str)) {
					//$("#msg").html("Only number allowed !").css("color","red");
					alert("Only number allowed !");
				}else{
					$("#msg").html("");
					for (var i=0; i<s_code_allowance.length; i++) {
						var allowanceId = 'allowance_'+s_code_allowance[i];
						//console.log(allowanceId);
						$('#'+allowanceId).val(str);
					}
					sessionStorage.setItem('selectedType', 'allowance');
					sessionStorage.setItem("allowance", str);
					sessionStorage.setItem("wages", "All");
					uploadWagesAndAllowance('allowance');
				}		
			}
			else {
				$("#msg").html("");
			}
		});	
	}
}

function uploadWagesAndAllowance(type) {
	
	var wagesArray = [];	//reset array
	var allowanceArray = [];
	wagesArray = document.getElementsByName("wages");
	allowanceArray = document.getElementsByName("allowance");
	//console.log("num of wages: "+wagesArray.length);
	console.log(wagesArray);
	console.log(allowanceArray);
	
	for (var i=0; i<wagesArray.length; i++) {
		
		var wagesId = wagesArray[i].id;	
		var allowanceId = allowanceArray[i].id;
		var obj={
			"code":storeArray[i].store_code,				
			"wages":$("#"+wagesId).val(),
			"allowance":$("#"+allowanceId).val(),
			"period":$("#period_header").find(':selected').text(),
			"batch":$("#batch_header").find(':selected').text()
		}
		
		console.log("obj = "+ JSON.stringify(obj));
		
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "updateJobSheet.php",
			data:obj,
			success: function(response) {
				console.log('response == '+response);							
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	
		setTimeout(refreshWagesAndAllowanceOption, 1000);	
	}
}

$("#excelBtn").click(function(){
	
	//getting values of current time for generating the file name
	var dt = new Date();
	var day = dt.getDate();
	var month = dt.getMonth() + 1;
	var year = dt.getFullYear();
	var hour = dt.getHours();
	var mins = dt.getMinutes();
	var timestamp = year + "." + month + "." + day + "_" + hour + "." + mins;
	
	//creating a temporary HTML link element (they support setting file names)
	var a = document.createElement('a');
	
	//getting data from our div that contains the HTML table
	var data_type = 'data:application/vnd.ms-excel';
	var table_div = document.getElementById('excel_file');
	var table_html = table_div.outerHTML.replace(/ /g, '%20');
	a.href = data_type + ', ' + table_html;
	
	//setting the file name
	var period = $("#period_header").find(':selected').text();
	a.download = 'deploymentSheet_' +period + '_' + timestamp + '.xls';
	
	//triggering the function
	a.click();
	//just in case, prevent default behaviour
	e.preventDefault();
	
});
	
	
$("#saveBtn").click(function(){
	
	var invalid='no';
	
	// check all wages and allowance fields if any contains non-numeric input
	var regx = /^[0-9\.\s]*$/;
	$('input[type="text"]').each(function(){  
		var str = $.trim( $(this).val() );
		console.log("["+str+"]");		
		var fieldId = $(this).attr('id');
		if ((fieldId.search('wages_') != -1)||(fieldId.search('allowance_') != -1)) { 
			if (!regx.test(str)) {
			//if ( !$.isNumeric(str) ) { //the empty field also trigger alert message
				//$("#msg").html("Only number allowed in 工資 or 津貼 field !").css("color","red");
				alert("Only number allowed in 工資 or 津貼 field !");
				invalid = 'yes';
			}
		}
	});
	
	if (invalid=='no') {
		// add overlay dialog box
		$.blockUI(); 	
		// reset merchandizer select
		$('#merch_header option').removeAttr("selected");
		$('#spinner-uploading').css('visibility','visible');
		
		// empty s_code_merch array and uncheck all checkboxes
		$('[id^=checkbox_merch_]').prop("checked", false);
		s_code_merch.length = 0;	//empty an array
		
		//upload merchandizer to the server
		/*var cnt = 0;
		$('input[type="text"]').each(function(){ 			
			
			var fieldId = $(this).attr('id');
			if (fieldId.search('merch_') != -1) { 
				var obj={
					"code":storeArray[cnt].store_code,				
					"merchandizer":$(this).val(),		
					"period":$("#period_header").find(':selected').text(),
					"batch":$("#batch_header").find(':selected').text()
				}
				
				console.log("obj = "+ JSON.stringify(obj));
				
				$.ajax({
					type:"POST",
					dataType: "json",
					url: "updateJobSheet_merch.php",
					data:obj,
					success: function(response) {
						console.log('response == '+response);							
					},
					error:function (jqXHR, textStatus, errorThrown) {
						console.log('Error! textStatus' + ': ' + errorThrown);            
					}
				});
				
				cnt++;
			}
			
		});*/
		
		uploadMerchandizers();		
		setTimeout(showMsg, 2000);
		
	}
});

function showMsg() {	
	
	$('#msg').text('Update succeeded').css("color", "black");
	$('#spinner-uploading').css('visibility','hidden');
	
	// add overlay dialog box
	$.blockUI({ message: $('#domMessage'), css: { cursor:'default', height: '130px'} }); 
	
	// dismiss the overlay dialog box
	$('#yes').click(function() { 
		$.unblockUI(); 
		window.location.reload(); 
	});
}

$( window ).load(function() {
	//console.log( "window loaded" );
});	
	
	
	
</script>
</body>
</html>	
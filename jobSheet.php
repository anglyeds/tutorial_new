<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Job Sheet Creation</title> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="lib/json2.js" type="text/javascript"></script>
	<script src="lib/jquery.blockUI.js" type="text/javascript"></script>
	

<style>

table {
    width: 98%;
    border-collapse: collapse;	
	margin-left: auto;
    margin-right: auto;
	table-layout: fixed;	
}

td {
    border: 1px solid #dedede;
    //padding: 2px;
	height:30px;
	margin: 5px 0;
	//border-bottom: 1px solid #ddd;
	text-align: center;
	overflow: hidden;
}

th {
    background-color: #dedede; //#4CAF50;
	border: 1px solid #c0c0c0;
    color: black;
	height: 30px;
	text-overflow:ellipsis;	
    font-family: "Times New Roman", Georgia, Serif;
	font-weight: normal;
}

tr:nth-child(even) {background-color: #f2f2f2}

tr:hover{background-color:#99ccff}


select {
	background-color: #dedede; //#4CAF50;
    color: black;
	height: 30px;
	font-size: 16px;
	border:none;	
	font-family: "Times New Roman", Georgia, Serif;
	font-weight: normal;
}

option {
	background-color: white;
	color:black;
	width:200px;
}

.center {
	text-align: center;
}

input[type=text] {
	text-align: left;
    padding: 5px 0px;
    margin: 2px 0;
    box-sizing: border-box;	
}

input[type=checkbox] {
	
	padding: 10px;
	transform: scale(1.0);
}

button {
	width: 80px;
	padding:5px;
	cursor: pointer;
}

.create_btn {
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

.create_btn:hover{
    background: #45a999;
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

body { 
	min-width:1024px; 		/* suppose you want minimun width of 1024px */
	width: auto !important;  /* Firefox will set width as auto */
	width:1024px;             /* As IE ignores !important it will set width as 1024px; */
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

#buttonBar table {
	border-collapse: collapse;	
	min-width: 1024px;
	table-layout: fixed;	
}
#buttonBar td {
    //border: 1px solid red; 
	border:none;
	width: 200px;
	height:30px;
	float: left;
	text-align:left;
	vertical-align:middle;
	//overflow: hidden;
}
#buttonBar tr:hover {
	background-color:transparent
}
.blank_row
{
    height: 10px !important; /* Overwrite any previous rules */
    background-color: #FFFFFF;
}

</style>

</head> 
<body oncontextmenu="return false">

	<?php include 'connectDB.php'; 	?>
	
	<?php
	
		if (!isset($_SESSION)) {
			session_start();
		}
		$user = $_SESSION['name'];	
		
	?>
	
	<!--<a id="main" href="menu.html">Return to Main Menu</a>-->
	<button id="returnBtn" class="button_example" style="width:200px" onclick="location.href='menu.php'">Return to Main Menu</button>
	<button id="logoutBtn" class="button_example" style="width:100px" >Logout</button>
	<h1 class="center">Job Sheet Creation</h1></span>
	<!--
	<div>	
	<a id="main" href="main.html"><img src="home-icon.png" alt="home" class="img-valign" style="width:60px;height:auto;"></a>
	<span class="head">Job Sheet Creation</span>
	</div>
	-->
	
	<div id="top_container"  style="margin:auto; width:95%">
	<!--<div style="margin:10px">Job ID: <span id="jobId" style="margin-right:20px; font-weight: bold">-->
	<div style="margin:3px 0px 3px 15px">Job ID: <!--<input type="text" id="jobId" size="20" value="M12345678"></div>-->
	<?php 
		$result = mysql_query (" SELECT * FROM job_sheet order by job_id DESC limit 1");				
		$row = mysql_fetch_array($result);
		if (mysql_num_rows($result) > 0) {
			if (substr($row['job_id'],3,2) != date('m')) {
				$jid = '001';
			}
			else {
				$jid = substr($row['job_id'],5)+1;
				$jid = sprintf("%03s", $jid);
			}
		}
		else {
			$jid = '001';
		}	
		$prefix = 'M'.substr(date("Y"),2).date('m');
		$val = $prefix.$jid;
		echo '<input type="text" id="jobId" size="10" style="margin-left:22px" value="'.$val.'" disabled><span id="id_msg">' 
	?></span></div>
	<div style="margin:3px 0px 3px 15px">Job Name: <input type="text" id="jobName" size="100"></div>	
	<!--<div style="margin:10px">Client: <input type="text" id="client" size="150" style="margin-left:25px" ></div>-->
	
	<div style="margin:3px 0px 3px 15px">Client: <select id="client_header" style="margin-left:24px; width:150px !important; min-width:150px; max-width:150px;">
	<option value="" selected disabled>Please select</option>
	<?php
		$result = mysql_query (" SELECT name FROM user where identity='client' order by name");	
		while ($row = mysql_fetch_array($result)) {			
				echo '<option value='.$row['name'].' >'.$row['name'].'</option>';
		}	
	?>
	</select></div>
	
	<div style="margin:3px 0px 3px 15px">Brand: <input type="text" id="brand" size="100" style="margin-left:25px"></div>
	
	<div style="margin:3px 0px 3px 15px"><span>
	Period: <select id="period_header" style="margin-right:50px; margin-left:22px">
			<?php				
				/*
				// show the first week of the year
				$result = mysql_query (" SELECT * FROM define_period order by start_date ASC");				
				while ($row = mysql_fetch_array($result)) {
					echo '<option value='.$row['period'].'>'.$row['period'].'</option>';  
				}
				$date = mysql_fetch_array(mysql_query ("SELECT * FROM define_period order by start_date ASC limit 1"));
				echo"</select></span>From: <span id='date_from' style='margin-right:50px'>".$date['start_date']."</span>To: <span id='date_to' style='margin-right:100px'>".$date['end_date']."</span>Batch: <span><input type='text' id='batch' value='1' size = '1' style='text-align:center'></span><br>";	
				*/
				
				// show the current period automatically
				$result = mysql_query ("SELECT * FROM define_period order by start_date ASC");		
				$today = date("Y-m-d"); 
				$thisPeriod = '';
				$cnt = 0;
				while ($row = mysql_fetch_array($result)) {
					if ($today > $row['end_date']) {
						// if the period is earlier than today, do not show it
						//echo '<option value='.$row['period'].' disabled>'.$row['period'].'</option>';
						//echo '<option value='.$row['period'].' >'.$row['period'].'</option>';
					} else if ($today>=$row['start_date'] && $today<=$row['end_date']) {
						$thisPeriod = $row['period'];
						echo '<option value='.$row['period'].' selected>'.$row['period'].'</option>';
					} else {
						//if ($cnt < 3) {
							echo '<option value='.$row['period'].' >'.$row['period'].'</option>'; 
							//$cnt++;
						//}						
					}
				}
				$date = mysql_fetch_array(mysql_query ("SELECT * FROM define_period where period='$thisPeriod' "));
				echo"</select></span>From: <span id='date_from' style='margin-right:50px'>".$date['start_date']."</span>To: <span id='date_to' style='margin-right:100px'>".$date['end_date']."</span>Batch: <span><input type='text' id='batch' value='1' size = '1' style='text-align:center'></span><span id='batch_msg'></span><br>";
				
			?> 
	</div>
	
	<!--<div style="margin:10px">-->	
	<table id="buttonBar"><tr>
	<td>Retailer:<select id="retailer_header" style="margin-right:0px; margin-left:12px; width:100px !important; min-width:100px; max-width:100px;" onchange="updateStoreList('retailer')">
			<option value="all" selected>All</option>
			<?php
				$result = mysql_query (" SELECT distinct retailer FROM store ");				
				while ($row = mysql_fetch_array($result)) { 
					echo '<option value='.$row['retailer'].' >'.$row['retailer'].'</option>'; 
				}  
			?>
		</select></td>
	<td >Format: <select id="format_header" style='margin-right:0px; width: 100px !important; min-width: 100px; max-width: 100px;' onchange="updateStoreList('format')">
			<option value="all" selected>All</option>
			<?php		
				$result = mysql_query (" SELECT distinct format FROM store ");				
				while ($row = mysql_fetch_array($result)) {  
					echo '<option value='.$row['format'].'>'.$row['format'].'</option>';
				}
			?>
		</select></td>	
	<td >Region: <select id="region_header" style='margin-right:0px; width: 100px !important; min-width: 100px; max-width: 100px;' onchange="updateStoreList('region')">
			<option value="all" selected>All</option>
			<?php	
				$result = mysql_query (" SELECT distinct region FROM store ");
				while ($row = mysql_fetch_array($result)) { 
					echo '<option value='.$row['region'].'>'.$row['region'].'</option>'; 
				}  
			?>
		</select></td>
	<td >Area: <select id="area_header" style='margin-right:0px; width: 100px !important; min-width: 100px; max-width: 100px;' onchange="updateStoreList('area')">
			<option value="all" selected>All</option>
			<?php
				$result = mysql_query (" SELECT distinct area FROM store ");				
				while ($row = mysql_fetch_array($result)) { 
					echo '<option value='.$row['area'].'>'.$row['area'].'</option>';
				}  
			?>
		</select></td>
	<!--<td ><button id="uploadStoreList" style="width:150px" onclick="window.location.href='uploadStoreListForJob.php'">Upload store list</button></td>-->
	<td ><button id="uploadStoreList" class="button_example" style="width:150px; height:30px; padding: 1px 10px">Upload Store List</button></td>
	<td >No. of stores selected: <span id='storeSelected' style="font-weight:bold" size='3';>0</span></td>
	</tr></table>
	
	<div style="margin:3px 0px 3px 12px">Key Message: <input type="text" id="keyMsg" size="120"></div><br>
	<!--
	<table id="buttonBar"><tr>
	<td style="width:120px; height:50px">Key Message:</td>
	<td style="width:900px; height:50px"><input type="text" id="keyMsg" size="90"></td>
	</tr></table>
	-->
	<br>	
	</div> <!--top container //-->	
	
	
	<div id="table_contianer">
	<table >
	<thead><tr>
		<th class='w50'>Suffix</th>
		<th class='w100'>Retailer</th>
		<th class='w100'>Format</th>
		<th class='w100'>Region</th>
		<th class='w100'>Area</th>
		<th class='w150'>Store Code</th>
		<th class='w150'>Store Name</th>
		<th class='w150'>舖名</th>
		<th class='w400'>Store Address</th>
		<!--<th class='w80'><button id='selectAll' >Select All</button></th>
		<th class='w80'><button id='clearAllCheckboxes' >Clear All</button></th>-->
	</tr></thead>
	<?php	mysql_close($con);	?>
	<tbody id="table">
	</tbody></table>
	</div> <!-- table container //-->

	<div id="msg" class="center" style="font-size:18;font-weight:bold;margin-top:20px">Click button to create a job sheet</div>
	<br>
	<div class='center'>
	<button id="createBtn" class="button_example" style="width:300px; height:50px; font-size:18px" >Create</button>
	</div>
	
	<!-- to be shown in the overlay view -->
	<div id="domMessage" style="display:none;"> 
    <h3>Job Sheet is created.</h3> 
	<!--<input type="button" class='button' id="yes" value="OK" /> -->
	<button id="yes" style="width:50px">OK</button>
	<br>
	</div>


<script type="text/javascript">

	var storeSelected=0;
	var s_code = [];
	var jid = <?php echo json_encode($val); ?>;
	var initialPeriod = <?php echo json_encode($thisPeriod); ?>;
	console.log("initial period = "+ initialPeriod);
	
	// regular express includes 0-9, a-z, A-Z, chinese chars, space between two words, apostrophe, hypen, slash, underscore
	var regx = /(['\-\/\_]|[^\x00-\x7F]|\w)+( ['\-\/\_]|[^\x00-\x7F]|\w)*$/;
	
	$(window).load(function() {
	
		if (sessionStorage.getItem("isLogin") !== "success") {
			alert('Login is not done, back to login');
			window.location.replace('main.html');		
		}
		else {
			//
		}
	});
	
	$('#logoutBtn').click(function() {
	
		sessionStorage.removeItem("isLogin");
		sessionStorage.removeItem("userName");
		
		//clear the items in sessionStorage
		clearSessionItems();
		
		window.location.replace("main.html");	
	});
	
	$(document).ready(function() {
		
		$('#jobName').val(sessionStorage.getItem("jobname"));
		$('#client_header').val(sessionStorage.getItem("client"));
		$('#brand').val(sessionStorage.getItem("brand"));
		if (sessionStorage.getItem("periodForJob")===null) {
			$("#period_header").val(initialPeriod).prop('selected',true);
		} else {
			$("#period_header").val(sessionStorage.getItem("periodForJob")).prop('selected',true);
		}
		if (sessionStorage.getItem("batch")===null) {
			$('#batch').val("1");
		}else {
			$('#batch').val(sessionStorage.getItem("batch"));	
		}		
		$('#keyMsg').val(sessionStorage.getItem("keyMsg"));
		
		getNumOfStores();
        updateStoreList('All');
    });
	
	// validate the format of job ID entered
	$("#jobId").change(function(){ 
		var jid = $(this).val();
		var prefix = <?php echo json_encode($prefix); ?>;	//get variable created by php
		//console.log(jid.substr(0,5)+', '+prefix);
		//console.log(jid.length-5);
		if (jid.substr(0,5)!=prefix || jid.length-5!=3) {
			$("#id_msg").text("  The Job ID is not right!").css("color", "red");
		} else {
			$("#id_msg").text("");
		}		
	});
	
	// validate the value of batch entered
	$("#batch").change(function(){ 
		var batchNum = $(this).val();
		console.log(batchNum);
		if (batchNum<=0 || batchNum>2) {
			$("#batch_msg").text("  The batch number is either 1 or 2").css("color", "red");
		} else {
			$("#batch_msg").text("");
		}		
	});
	
	$("#period_header").change(function(){
		
		//console.log(this.value);//it get the first word of selected option's text if there is space betweenn two words
		
		sessionStorage.setItem("periodForJob", $('#period_header').val());
		
		console.log($(this).find(':selected').text());//this get all words of selected option's text 
		var period = $(this).find(':selected').text();
		var data = {"period":period};
		
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "selectPeriod.php",
			data:data,
			success: function(response) {
				
				 //console.log(response);	
								 
				 if (response['result'] === "success") {	
					//location.reload();
					$("#date_from").text(response['start_date']);
					$("#date_to").text(response['end_date']);
				 } 
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
		
	});
	
	$('#jobName').change(function(){
		//console.log('Changed! ' + $('#jobName').val())
		sessionStorage.setItem("jobname", $('#jobName').val());
    });
	
	$('#brand').change(function(){
		//console.log('Changed! ' + $('#brand').val())
		sessionStorage.setItem("brand", $('#brand').val());
    });
	
	$('#batch').change(function(){
		sessionStorage.setItem("batch", $('#batch').val());
    });
	
	$('#keyMsg').change(function(){
		//console.log('Changed! ' + $('#keyMsg').val())
		sessionStorage.setItem("keyMsg", $('#keyMsg').val());
    });
	
	$('#client_header').change(function(){

		var client = $(this).find(':selected').val();
		sessionStorage.setItem("client", client);
    });
	
	$("#returnBtn").click(function() {
		//clear the items in sessionStorage
		clearSessionItems();
	});
	
	$("#clearAllCheckboxes").click(function(){
		console.log("Clear all checkbox...");
		
		// firstly delete the number of stores which are checked from storeSelected
		var checkboxes = document.getElementsByName("checkbox");		
		for (var i=0; i<checkboxes.length; i++) {			
			if (checkboxes[i].checked) {
				storeSelected-=1;
			}
		}
	
		// loop over them and store the store code to s_code[]
		for (var i=0; i<checkboxes.length; i++) {
			
			if (checkboxes[i].checked) {
				
				var found = $.inArray(checkboxes[i].value, s_code);
				// if store code exist in s_code[], remove it
				if (found !== -1) 	
					s_code.splice($.inArray(checkboxes[i].value, s_code),1); 
			}
		}
		console.log("s_code has "+s_code.length+" data == "+s_code);
		
		// update the store selected
		$('#storeSelected').text(storeSelected);
		// unchecked all checkboxes
		$('[id^=checkbox_]').prop("checked", false);
	});

	$("#selectAll").click(function(){
		/*
		console.log("select "+$('[id^=checkbox_]').length+" stores...");
		$('[id^=checkbox_]').prop("checked", true);
		
		//reset the storeSelected and empty s_code[]'s content
		storeSelected = $('[id^=checkbox_]').length;
		s_code.length = 0;	//firstly empty an array	
		getCheckedBoxes();
		console.log("s_code has "+s_code.length+" data == "+s_code);
		$('#storeSelected').text($('[id^=checkbox_]').length);
		*/
		
		
		// in order to avoid double count, firstly delete the number of stores which are checked from storeSelected
		var checkboxes = document.getElementsByName("checkbox");		
		for (var i=0; i<checkboxes.length; i++) {			
			if (checkboxes[i].checked) {
				storeSelected-=1;
			}
		}
		console.log("select "+$('[id^=checkbox_]').length+" stores...");
		$('[id^=checkbox_]').prop("checked", true);
		//add the number of all checked stores to storeSelected and append store code to s_code[]
		storeSelected += $('[id^=checkbox_]').length;
		getCheckedBoxes();	//store the store code into s_code[]
		console.log("s_code has "+s_code.length+" data == "+s_code);
		$('#storeSelected').text(storeSelected);
	});
	
	$("#clearAll").click(function(){
		console.log("Clear all selected store...");
		$('[id^=checkbox_]').prop("checked", false);
		storeSelected = 0;
		s_code.length = 0;	//empty an array
		console.log("s_code has "+s_code.length+" data == "+s_code);
		$('#storeSelected').text('0');
	});
	
	$("#uploadStoreList").click(function() {
		//console.log("upload store list....");
		
		window.location.replace('uploadStoreListForJob.php?jobid='+jid)
		
	});
	
	$("#createBtn").click(function(){
		
		//var str = $("#jobId").text();
		//var jid = $.trim($("#jobId").text());	//Remove the whitespace from the beginning and end of a string
		var jid = $("#jobId").val();
		var jName = $("#jobName").val();
		//var client = $("#client").val();
		var client = $("#client_header").find(':selected').text();
		var brand = $("#brand").val();		
		var periodValue = $("#period_header").val();
		var dateFrom = $("#date_from").text();
		var dateTo = $("#date_to").text();
		var batch = $("#batch").val();
		var msg = $("#keyMsg").val();
		//var creator = <?php echo json_encode($user); ?>;
		var creator = sessionStorage.getItem("userName");
		var data = [];
		//alert(creator+', '+jid+', '+jName+', '+client+', '+brand+', '+periodValue+', '+dateFrom+', '+dateTo+', '+batch+', '+msg+', '+storeSelected);
		
		//to validate the input is empty or white space
		if ( $.trim(jName)==""||$.trim(brand)=="" ) {
			$("#msg").html("Warning: No empty in Job Name and Brand !").css("color","red");
			return;
		} 
		if ( $.trim(client)=="Please select"){
			$("#msg").html("Warning: No Client is selected!").css("color","red");
			return;
		}
		if ( batch <=0 || batch> 2 ) {
			$("#msg").html("Warning: The batch number is either 1 or 2!").css("color","red");
			return;
		} 
		if ( $.trim(msg)==""){
			msg = "n/a";
		}
/*		
		// to validate if the input contains characters other than 0-9, a-z, A-Z, ', /, _ 
		if ( !regx.test(jName)) {
			$("#msg").html("Warning: The job Name contains non-alphanumeric character !").css("color","red");
			return;			
		}
		if ( !regx.test(client)) {
			$("#msg").html("Warning: The Client contains non-alphanumeric character !").css("color","red");
			return;			
		}
		if ( !regx.test(brand) ) {
			$("#msg").html("Warning: The Brand contains non-alphanumeric character !").css("color","red");
			return;			
		}
		
		var regx_empty = /^(['\-\/\_\s]|[^\x00-\x7F]|\w)+( ['\-\/\_\s]|[^\x00-\x7F]|\w)*$/;	// allow chinese char, space between two words but empty
		//var regx_empty = /^( ['\-\/\_\s]|[^\x00-\x7F]|\w)*$/;	//allow chinese char, empty but space between two words
		if ( !regx_empty.test(msg)) {
			$("#msg").html("Warning: The Key Message contains non-alphanumeric character !").css("color","red");
			return;			
		}
*/			
		if (s_code.length==0){
			//$('#msg').removeClass('hide');
			$('#msg').text('No store is selected!').css("color", "red");
		}else {
			
			// add overlay dialog box (default message: please waits)
			$.blockUI(); 
			// clear warning message
			$('#msg').text('')
			for (var i=0; i< s_code.length; i++) {
				
				var subid = i+1;
				// create the suffix of jobId
				var s1 = "0";
				var s2 = "00";
				var st = subid.toString();
				//console.log("num length: "+st.length);
				if (st.length==1) st = s2.concat(st);
				else if (st.length==2) st = s1.concat(st);			
				
				var arr={"creator":creator,"jobId":jid,"jobName":jName,"client":client,"brand":brand,"period":periodValue,"dateFrom":dateFrom,"dateTo":dateTo,"batch":batch,"msg":msg,"subId":st,"code":s_code[i]};
				data.push(arr);
				//console.log(data);
			
				$.ajax({
					type:"POST",
					dataType: "json",
					url: "addJob.php",
					data:arr,
					success: function(response) {
						
						//console.log(response);
						if (response == 'duplicate') {
							$('#msg').text('Same Job ID exists in database.').css("color", "red");
						}else if (response == 'fail') {
							$('#msg').text('Fail to add job in database.').css("color", "red");
						} else {						
							//window.location.reload();
						}
						
					},
					error:function (jqXHR, textStatus, errorThrown) {
						console.log('Error! textStatus' + ': ' + errorThrown);            
					}
				});
			}
			// add overlay dialog box
			$.blockUI({ message: $('#domMessage'), css: { cursor:'default', height: '120px'} });
			
			// dismiss the overlay dialog box
			$('#yes').click(function() { 
			
				//clear the items in sessionStorage
				clearSessionItems()
		
				$.unblockUI(); 
				window.location.reload(); 
			});
		}	
});

function clearSessionItems() {
	
	sessionStorage.removeItem("jobname");
	sessionStorage.removeItem("brand");
	sessionStorage.removeItem("keyMsg");
	sessionStorage.removeItem("client");
	sessionStorage.removeItem("batch");
	sessionStorage.setItem("periodForJob", initialPeriod);
	//batch default value is 1
	//sessionStorage.setItem("batch", "1");
}

function getCheckedBoxes() {
	
	var checkboxes = document.getElementsByName("checkbox");
	// loop over them and store the store code to s_code[]
	for (var i=0; i<checkboxes.length; i++) {
		
		if (checkboxes[i].checked) {
			
			var found = $.inArray(checkboxes[i].value, s_code);
			// if store code does not exist in s_code[], store it
			if (found === -1) s_code.push(checkboxes[i].value);	//checkbox's value is store_code
		}
	}
	//console.log(s_code.length > 0 ? s_code : null);
	//return(s_code.length > 0 ? s_code : null);
}

function getNumOfStores() {

	data = {"jobid":jid,"retailer":"All","format":"All","region":"All","area":"All"};

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "selectStoreForJob.php",
		data:data,
		success: function(response) {		 
			
			if (response['result'] === "success") {				
				
				$.each(response.data, function(key,v) {
					// by default, store the store code into array
					s_code.push(v.store_code);
					//update the number of store selected
					storeSelected += 1;
					//console.log('num of stores selected: '+storeSelected);
					$('#storeSelected').text(storeSelected);
				});
			}
		}
	});

}	
	
function updateStoreList(src) {
	
	//reset num of stored selected every change of sorting keys
	//storeSelected = 0; 

	$('#storeSelected').text(storeSelected);
	
	// read the value of keys
	var retailer = $("#retailer_header").find(':selected').text();
	var format = $("#format_header").find(':selected').text();
	var region = $("#region_header").find(':selected').text();
	var area = $("#area_header").find(':selected').text();
	var data = {"jobid":jid,"retailer":retailer,"format":format,"region":region,"area":area};
	console.log(data);
	
	// empty the table
	$("#table").empty();
	
	var sortedBy = src;
	console.log("called by "+sortedBy);
	if (sortedBy=='All') {
		// reset the sorting keys
		sessionStorage.setItem('retailer', 'All');	
		sessionStorage.setItem('format', 'All');	
		sessionStorage.setItem('region', 'All');
		sessionStorage.setItem('area', 'All');
		data = {"jobid":jid,"retailer":"All","format":"All","region":"All","area":"All"};	// to workaround Google chrome's bug
	}
	else if (sortedBy=='retailer') {
		sessionStorage.setItem('retailer', retailer);
	}
	else if (sortedBy=='format') {
		sessionStorage.setItem('format', format);
	}						
	else if (sortedBy=='region') {
		sessionStorage.setItem('region', region);
	} 
	else if (sortedBy=='area') {
		sessionStorage.setItem('area', area);
	}
	
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "selectStoreForJob.php",
		data:data,
		success: function(response) {
			
			//console.log(response);	
						 
			if (response['result'] === "success") {	
			
				//clear the number of stores selected
				//storeSelected = 0;
				
				$.each(response.data, function(key,v) {
					
					//console.log(v.store_code+', '+v.store_name_c+', '+v.store_address);
					
					/*
					// for development and testing
					var checkboxId = key+1;
					var row = $('<tr><td class="w150" id="code_$count">'+v.store_code+'</td><td class="w150" id="name_e_$count">'+v.store_name_e+'</td><td class="w150" id="name_c_$count">'+v.store_name_c+'</td><td class="w400" id="address_$count">'+v.store_address+'</td><td class="w80"><input type="checkbox" id="checkbox_'+checkboxId+'" style="margin: 5px 0" value="row_'+checkboxId+'"></td><td class="w80"><button id="btn_'+checkboxId+'">加入收藏</button></td></tr>');
					*/
					
					/*
					// code does not show retailer,format,region and area on the screen
					var row = $('<tr><td class="w150" id="code_$count">'+v.store_code+'</td></tr>');
					var store = $('<td class="w150" id="name_e_$count">'+v.store_name_e+'</td><td class="w150" id="name_c_$count">'+v.store_name_c+'</td><td class="w400" id="address_$count">'+v.store_address+'</td>');
					store.appendTo(row);
					var checkboxId = key+1;
					var selection = $('<td class="w80"><input type="checkbox" id="checkbox_'+checkboxId+'" style="margin: 5px 0" value="row_'+checkboxId+'"></td>');
					selection.appendTo(row);					
					row.appendTo('#table');	
					*/
					
					// create the suffix of job id
					var num = key+1;
					var s1 = "0";
					var s2 = "00";
					var st = num.toString();
					//console.log("num length: "+st.length);
					if (st.length==1) st = s2.concat(st);
					else if (st.length==2) st = s1.concat(st);
					
					var row = $('<tr><td class="w50">'+st+'</td><td class="w100" id="retailer_$count">'+v.retailer+'</td><td class="w100" id="format_$count">'+v.format+'</td><td class="w100" id="region_$count">'+v.region+'</td><td class="w100" id="area_$count">'+v.area+'</td><td class="w150" id="code_$count">'+v.store_code+'</td></tr>');
					var store = $('<td class="w150" id="name_e_$count">'+v.store_name_e+'</td><td class="w150" id="name_c_$count">'+v.store_name_c+'</td><td class="w400" id="address_$count">'+v.store_address+'</td>');
					store.appendTo(row);
					var checkboxId = key+1;
					
					row.appendTo('#table');
					/*
					// to check if a store is selected and saved in array
					var found = $.inArray(v.store_code, s_code);	// check if an array contains specific string
					//console.log('found = ' + found);
					
					if (found !== -1 ) {	// string is found
						var selection = $('<td class="w80"><input type="checkbox" name="checkbox" id="checkbox_'+checkboxId+'" style="margin: 5px 0" checked value="'+v.store_code+'"></td>');
						selection.appendTo(row);					
						row.appendTo('#table');	
					}else {	// if not found
						var selection = $('<td class="w80"><input type="checkbox" name="checkbox" id="checkbox_'+checkboxId+'" style="margin: 5px 0" value="'+v.store_code+'"></td>');
						selection.appendTo(row);					
						row.appendTo('#table');	
					}						
					*/
					
				});
				console.log("s_code has "+s_code.length+" data == "+s_code);
				
				//if (sortedBy!='retailer') {
					$("#retailer_header").empty();
					var row_retailer = $('<option value=All>All</option>');
					row_retailer.appendTo('#retailer_header');				
					$.each(response.retailer, function(key,v) {					
						// update the retailer keys in option	
						//console.log("response retailer: "+response.retailer[key]);

						if (response.retailer[key] == sessionStorage.getItem('retailer')) {
							row_retailer = $('<option value='+response.retailer[key]+' selected>'+response.retailer[key]+'</option>');
						} else {
							row_retailer = $('<option value='+response.retailer[key]+'>'+response.retailer[key]+'</option>');
						}					
						row_retailer.appendTo('#retailer_header');					
					});
				//}
				
				//if (sortedBy!='format') {
					$("#format_header").empty();
					var row_format = $('<option value=All>All</option>');
					row_format.appendTo('#format_header');				
					$.each(response.format, function(key,v) {					
						// update the format keys in option		
						if (response.format[key] == sessionStorage.getItem('format')) {
							row_format = $('<option value='+response.format[key]+' selected>'+response.format[key]+'</option>');
						} else {
							row_format = $('<option value='+response.format[key]+'>'+response.format[key]+'</option>');
						}
						row_format.appendTo('#format_header');					
					});
				//}
				
				//if (sortedBy!='region') {
					$("#region_header").empty();
					var row_region = $('<option value=All>All</option>');
					row_region.appendTo('#region_header');				
					$.each(response.region, function(key,v) {					
						// update the region keys in option	
						if (response.region[key] == sessionStorage.getItem('region')) {
							row_region = $('<option value='+response.region[key]+' selected>'+response.region[key]+'</option>');
						} else  {
							row_region = $('<option value='+response.region[key]+'>'+response.region[key]+'</option>');
						}
						row_region.appendTo('#region_header');					
					});
				//}
				
				//if (sortedBy!='area') {
					$("#area_header").empty();
					var row_area = $('<option value=All>All</option>');
					row_area.appendTo('#area_header');				
					$.each(response.area, function(key,v) {					
						// update the area keys in option	
						if (response.area[key] == sessionStorage.getItem('area')) {					
							row_area = $('<option value='+response.area[key]+' selected>'+response.area[key]+'</option>');
						} else {
							row_area = $('<option value='+response.area[key]+'>'+response.area[key]+'</option>');
						}
						row_area.appendTo('#area_header');					
					});
				//}
				
				$('input[type="checkbox"]').change(function(){	
					
					var cbId = this.id;
					var cbValue = this.value;	//checkbox's value is store code 
					
					if ($('#'+cbId).is(':checked')) {
						console.log(cbId+" is checked.");
						s_code.push(cbValue);
						console.log("s_code has "+s_code.length+" data == "+s_code);
						var status = 'checked';
						updateNumStoreSelected(cbId, cbValue, status);
					}else {
						console.log(cbId+" is unchecked.");
						var index = s_code.indexOf(cbValue);
						if (index > -1) {
							s_code.splice(index, 1);
						}
						console.log("s_code has "+s_code.length+" data == "+s_code);
						var status = 'unchecked';
						updateNumStoreSelected(cbId, cbValue, status);
					}	
				});
				
				/*
				// to validate if the input is allowed character/symbol
				$('input[type="text"]').keyup(function(e){   	
					var str = $.trim( $(this).val() );
					if( str != "" ) {
					  
					  if (!regx.test(str)) {
						$("#msg").html("Alphanumeric is only allowed !").css("color","red");
					  }
					  else{
						$("#msg").html("");
					  }
					}
					else {
						$("#msg").html("");
					}
				});
				*/
			} 
			 
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
	
};	

function updateNumStoreSelected(cbId,cbValue,status){	
	
	cbNumber = cbId.substr(9,cbId.length);	
	if(status === 'checked') {	
		storeSelected += 1;
		//console.log('num of stores selected: '+storeSelected);
		$('#storeSelected').text(storeSelected);
	}
	else {
		if (storeSelected > 0) {
			storeSelected-=1;
			//console.log('num of stores selected: '+storeSelected);
			$('#storeSelected').text(storeSelected);
		} else {
			storeSelected = 0;
			//console.log('num of stores selected is 0');
			$('#storeSelected').text('0');
		}
	}
}
	
</script>

</body>
</html>	
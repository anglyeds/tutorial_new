<?php
	/*
	$filename = "Filename".date("YmdHis").".xls"; 
	header("Content-type:application/vnd.ms-excel"); 
    header("Content-Disposition:filename=$filename"); 
	readfile('$filename');
	*/
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Set Period Shown in Apps</title> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="lib/json2.js" type="text/javascript"></script>


<style>
table {
    //width: 80%;
    border-collapse: collapse;
	margin-left: auto;
    margin-right: auto;
}

table, td, th {
    //border: 1px solid black;
    padding: 2px;
	//border-bottom: 1px solid #ddd;
	text-align: center;
}

th {
    background-color: #dedede;	//#4CAF50;
	border: 1px solid #c0c0c0;
    color: black;
	height: 30px;
}

tr:nth-child(even) {background-color: #f2f2f2}

tr:hover{background-color:#99ccff}

.center {
	text-align: center;
}

input[type=text] {
	text-align: center;
    padding: 5px 0px;
    //margin: 8px 0;
    box-sizing: border-box;
}

button {
	width: 80px;
	padding: 5px;
	cursor: pointer;
}
.w50 {
	width: 50px;
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

</style>

</head>

<body oncontextmenu="return false">
	
	<!--<a id="main" href="menu.html">Return to Main Menu</a>-->
	<button style="width:200px" class="button_example" onclick="location.href='menu.php'">Return to Main Menu</button>
	<button id="logoutBtn" class="button_example" style="width:100px" class="button" >Logout</button>
	<h1 class="center">Set Period Shown in Apps</h1>
	
	<table>
	<tr>
		<th class="w50">No.</th>
		<th>Period</th>
		<th>Action</th>
	</tr>
	<?php
		include 'connectDB.php';	
		
		//$sql="SELECT * FROM show_period ORDER BY period ASC";
		$sql ="SELECT show_period.period,define_period.start_date
		FROM show_period INNER JOIN define_period 
		ON show_period.period=define_period.period ORDER BY define_period.start_date ASC";
		$result=mysql_query($sql);		
		$count=1;
		
		while ($row = mysql_fetch_assoc($result)) {   
			$period = $row['period'];			
			echo "<tr>
			<td class='w50'>$count</td>
			<td><input id='period_$count' type='text' maxlength='4' value='$period'></td>
			<!--<td><button id='updateBtn_$count'>Update</button></td>-->
			<td><button id='deleteBtn_$count'>Delete</button></td>			
			</tr>";
			
			$count += 1;
		} 
		/*
		// new row to add period
		echo "<tr>
		<td class='w50'></td>
		<td><input id='period_new' type='text' maxlength='4' ></td>
		<td><button id='addBtn'>Add</button></td></tr>
		</table>";
		*/
		
		// using select to add period
		echo "<tr>
		<td class='w50'></td>
		<td><select id='period_new' style='height:30px; width:170px !important; min-width:170px; max-width:170px;'><option value='' selected disabled>Please select</option>";				
		$result = mysql_query (" SELECT distinct period FROM define_period order by period ASC");				
		while ($row = mysql_fetch_array($result)) { 
			echo '<option value='.$row['period'].'>'.$row['period'].'</option>';  
		}
		echo "<td><button id='addBtn'>Add</button></td></tr>
		</select></td></tr>
		</table>";
	
		mysql_close($con);
		
	?>
	
	<br>
	<div id="msg" class="center"></div>

	<script type="text/javascript">
	
	var period = '';
	var btnNumber ='';
	var regx = /^[A-Za-z0-9]+$/;
	
	$(window).load(function() {
	
		if (sessionStorage.getItem("isLogin") !== "success") {
			alert('Login is not done, back to login');
			window.location.replace('main.html');		
		}
	});
	
	$('#logoutBtn').click(function() {
	
		sessionStorage.removeItem("isLogin");
		sessionStorage.removeItem("userName");
		window.location.replace("main.html");
		
	});
	
	$('input[type="text"]').keyup(function(e){   
		//alert($(this).attr('id'));
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
	
	$("button").click(function(){			
					
		var btnId = $(this).attr('id');
		if (btnId.search('deleteBtn_') != -1) {		
			console.log(btnId+" is clicked.");
			btnNumber = btnId.substr(10,btnId.length);			
			period = $("#period_"+btnNumber).val();			
			if(confirm('delete this period?')) {
				deletePeriod();
			}			
		}
		/*
		else if (btnId.search('updateBtn_') != -1) {		
			console.log(btnId+" is clicked.");
			btnNumber = btnId.substr(10,btnId.length);			
			period = $("#period_"+btnNumber).val();			
			updatePeriod();
		}
		*/
		else if (btnId==='addBtn') {		
			console.log(btnId+" is clicked.");
			period = $("#period_new").val();			
			addPeriod();
		}
		
	});
	
	function addPeriod() {
		
		//to validate if the input is empty
		if ( $.trim(period)=="") {
			$("#msg").html("Warning: No empty or white space for Period !").css("color","red");
			return false;
		} 	
		// to validate if the input contains non-alphanumeric
		if ( !regx.test(period) ) {
			$("#msg").html("Warning: The Period contains non-alphanumeric character !").css("color","red");
			return false;			
		}
	
		var data = {"period":period};
		console.log(data);
	
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "addShownPeriod.php",
			data:data,
			success: function(response) {
				
				 console.log(response);				 
				 if (response === "success") {	
					location.reload();
				 } else if (response === "empty"){
					$("#msg").text('It is blank.').css("color", "red");
				 } else if (response === "not_existed"){
					$("#msg").text('The period is not defined yet, please check Period Management.').css("color", "red");
				 } else if (response === "duplicated"){
					$("#msg").text('The period exists in the system !').css("color", "red");
				 }else {
					 
				 }
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	}
	
	function deletePeriod() {
		
		var data = {"period":period};
		console.log(data);
	
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "deleteShownPeriod.php",
			data:data,
			success: function(response) {
				
				 console.log(response);				 
				 if (response === "success") {								
					location.reload();
				 } else {
					
				 }
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	}
	
	function updatePeriod() {
	
		//to validate if the input is empty
		if ( $.trim(period)=="") {
			$("#msg").html("Warning: No empty or white space for Period !").css("color","red");
			return false;
		} 	
		// to validate if the input contains non-alphanumeric
		if ( !regx.test(period) ) {
			$("#msg").html("Warning: The Period contains non-alphanumeric character !").css("color","red");
			return false;			
		}
		
		var data = {"period":period};
		console.log(data);
	
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "updateShownPeriod.php",
			data:data,
			success: function(response) {
				
				 console.log(response);				 
				 if (response === "success") {								
					location.reload();
				 } else if (response === "empty"){
					$("#msg").text('It is blank.').css("color", "red");
				 } else {
					
				 }
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	}
	
	</script>

</body>
</html> 
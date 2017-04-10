<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Users Management</title> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="lib/json2.js" type="text/javascript"></script>
	<script src="lib/jquery.blockUI.js" type="text/javascript"></script>
	
	

<style>
#userTable {
    //width: 90%;
    border-collapse: collapse;
	margin-left: auto;
    margin-right: auto;
	
}

#userTable td {
    //border: 1px solid black;
    padding: 2px;
	//border-bottom: 1px solid #ddd;
	text-align: center;
}

#userTable th {
    background-color: #dedede;	//#4CAF50;
	border: 1px solid #c0c0c0;
    color: black;
	height: 30px;
}

#userTable tr:nth-child(even) {background-color: #f2f2f2}

#userTable tr:hover{background-color:#99ccff}

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
select {
	background-color: #dedede;	//#4CAF50;
    color: black;
	height: 30px;
	font-size: 16px;
	border:none;	
	font-family: "Times New Roman", Georgia, Serif;
	font-weight: normal;
	text-align:center;
}

option {
	background-color: white;
	color:black;
}

.w50 {
	width: 50px;
}
.w100 {
	width: 100px;
}
.w200 {
	width: 200px;
}
.addButton {
	border-radius: 5px;
	background-color: #dedede;	//#4CAF50;
	height: 50px;
	width: 200px;
    border:1px solid grey;
    color: black;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.addButton:hover{
     background: #45a999;
}
input[type=image].close {
	width:auto; 
	height:30px; 
	outline:none; 
	right:0; top:0;
	position: absolute;	
}
input[type=image].close:hover{
	-webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
	-webkit-box-shadow: 0px 0px 30px 0px rgba(0, 51, 0, 0.7);
	-moz-box-shadow:    0px 0px 30px 0px rgba(0, 51, 0, 0.7);
	box-shadow:         0px 0px 30px 0px rgba(0, 51, 0, 0.7);
}
#addUserTable {
    border-collapse: collapse;
	margin-left: auto;
    margin-right: auto;	
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

	<?php include 'connectDB.php';	?>
	
	<!--<a id="main" href="menu.html">Return to Main Menu</a>-->
	<button style="width:200px" class="button_example" onclick="location.href='menu.php'">Return to Main Menu</button>
	<button id="logoutBtn" class="button_example" style="width:100px" >Logout</button>
	<h1 class="center">Users Management</h1>
	
	
	<table id="userTable">
	<tr>
		<th class="w50">No.</th>
		<th class="w100">Login ID</th>
		<th class="w100">Password</th> 
		<th class="w100">Name</th>
		<th class="w100">Company</th> 
		<th class="w100">Identity<br>
			<select id="identity_header" style="width:100px !important; min-width:100px; max-width:100px;" onchange="refreshTable()">
			<!--<option selected disabled>Please select</option>-->
			<option value="all" selected >All</option>
			<?php
				/*$result = mysql_query (" SELECT distinct identity FROM user ORDER BY identity");	
				while ($row = mysql_fetch_array($result)) {			
					echo '<option value='.$row['identity'].' >'.$row['identity'].'</option>';
				}
				*/
				$identity_selected = mysql_real_escape_string($_GET["identity_selected"]);
				$result = mysql_query (" SELECT distinct identity FROM user ORDER BY identity ");				
				while ($row = mysql_fetch_array($result)) { 
					if ($identity_selected == $row['identity']) {
						echo '<option value='.$row['identity'].' selected>'.$row['identity'].'</option>';
					} else {
						echo '<option value='.$row['identity'].'>'.$row['identity'].'</option>';  
					}
				}  
				
			?>
			</select>
		</th>
		<th class="w100">Remarks</th>
		<th colspan="2">Action</th>
	</tr>
	<tbody id="table">

	<?php
		/*
		if (!isset($_SESSION)) {
			session_start();
		}
		$user = $_SESSION['name'];
		$user_identity = $_SESSION['identity'];
		*/
		
		//if ($user_identity == 'admin') {
	
			if ($identity_selected=='' || $identity_selected=='All')
				$sql="SELECT * FROM user ORDER BY identity, name ";	
			else
				$sql="SELECT * FROM user where identity = '$identity_selected' ORDER BY name ";
			$result=mysql_query($sql);	
			$count=1;
			$array = array();
			
			while ($row = mysql_fetch_assoc($result)) {  
			
				$array[] = $row['id'];			
				$loginid = $row['login_id'];
				$password = $row['password'];
				$name = $row['name'];
				$company = $row['company'];
				$identity = $row['identity'];
				$remarks=$row['remarks'];
				
				echo "<tr>	
				<td class='w50'>$count</td>
				<td class='w100'><input id='loginid_$count' type='text' maxlength='10' value='$loginid' ></td>
				<td class='w100'><input id='password_$count' type='text' maxlength='10' value='$password'></td>
				<td class='w100'><input id='name_$count' type='text' maxlength='20' value='$name'></td>
				<td class='w100'><input id='company_$count' type='text' maxlength='50' value='$company'></td>
				<td class='w100'><input id='identity_$count' type='text' maxlength='6' value='$identity'></td>
				<td class='w100'><input id='remarks_$count' type='text' maxlength='50' value='$remarks'></td>			
				<td ><button id='updateBtn_$count'>Update</button></td>
				<td ><button id='deleteBtn_$count'>Delete</button></td>
				</tr>";
				
				$count=$count+1;
			} 
		//}
		
		
		// new row to add user
		/*
		echo "<tr>	
		<td class='w50'></td>		
		<td><input id='loginid_new' type='text' ></td>
		<td><input id='password_new' type='text' ></td>
		<td><input id='name_new' type='text' ></td>
		<td><input id='company_new' type='text' ></td>
		<td><select id='identity_new' class='w200' style='height:30px; width:175px'>
			<option value='' selected disabled>Please select</option>
			<option value='admin'>admin</option>
			<option value='client'>client</option>
			<option value='merch'>merch</option>
			<option value='sma'>sma</option>
		</select></td>		
		<td><input id='remarks_new' type='text' ></td>
		<td><button id='addBtn'>Add</button></td>
		</tr>";
		*/
		
		mysql_close($con);
	?>
	</tbody></table>
	<br>
	<div id="msg" class="center"></div>
	
	<div class ="center">
	<button id="addBtn" class="button_example" style="width:300px;height:50px;font-size:18px" >Add New User</button>
	<!--<p style="color:#404040; font-size:18px">Identity field: to select 'admin' for administrator, 'sma' for SMA staff, 'merch' for merchandizer, 'client' for client</p>-->
	</div>

	<div id="msg1" class="center"></div>
	
	
	<!-- to show add-user-form in the overlay view -->
	<div id="domMessage" style="display:none;">
	<!--<div><input type="image" src="close.png" id="closeBtn" alt='close' style="width:auto; height:30px; outline:none; right:0; top:0; position: absolute;"></div>-->
	<div><input type="image" src="close.png" id="closeBtn" alt='close' class="close"></div>
	<h3>New User's Information</h3>
	<table id="addUserTable">	
		<tr><td class='w50'>Login ID</td><td class='w200'><input type="text" id="loginid_new" maxlength="20" class='w200'/></td></tr>
		<tr><td class='w50'>Password</td><td class='w200'> <input type="text" id="password_new" maxlength="10" class='w200'/></td></tr> 
		<tr><td class='w50'>Name</td><td class='w200'><input type="text" style='left-margin:10px' id="name_new" maxlength="20" class='w200'/></td></tr> 
		<tr><td class='w50'>Company</td><td class='w200'> <input type="text" id="company_new" maxlength="50" class='w200'/></td></tr> 
		<tr><td class='w50'>Identity</td><td class='w200'> <select id='identity_new' class='w200' style='height:30px;'>
				<option selected disabled>Please select</option>
				<option value='admin'>admin</option>
				<option value='client'>client</option>
				<option value='merch'>merch</option>
				<option value='sma'>sma</option>
			</select></td></tr> 
		<tr><td class='w50'>Remarks</td><td class='w200'> <input type="text" id="remarks_new" maxlength="50" class='w200'/></td></tr> 
		<tr style='height:20px !important; background-color: #FFFFFF;'><td colspan='2'></td></tr>
		<tr><td colspan='2'><input type="button" class="addButton" style="width:200px;" id="yesBtn" value="Click to add" /></td></tr>
	</table>
	<p style="padding:0 10px">Identity: to select 'admin' for administrator, 'sma' for SMA staff, 'merch' for merchandizer, 'client' for client.</p>
	<div id="msg2" class="center"></div>
	</div>
	
	
<script type="text/javascript">

	var ridArray= <?php echo json_encode($array ); ?>;
	//console.log(ridArray);
	
	var id = '';
	var pwd = '';
	var name = '';
	var company = '';
	var identity = '';
	var remarks = '';
	var btnNumber ='';
	var rid ='';
	
	// The asterisk indicates zero or more occurrences of the preceding element. 
	// For example, ab*c matches "ac", "abc", "abbc", "abbbc", and so on.
	// The plus sign indicates one or more occurrences of the preceding element. 
	// For example, ab+c matches "abc", "abbc", "abbbc", and so on, but not "ac".
		
	//var regx = /^[A-Za-z0-9\_\/\-]+( [A-Za-z0-9\_\/\-]+)*$/;	// allow space between two words
	/**************
	/^ 					- start of string
	[a-zA-Z0-9\_\/\-] 	- lowercase letter, uppercase letter, digit, underscore, slash, or hyphen
	+ 					- one or more of the previous character class
	$/					- end of the string
	**************/
	var regx = /^[A-Za-z0-9]+$/;
	
	$(window).load(function() {
	
		if (sessionStorage.getItem("isLogin") !== "success") {
			alert('Login is not done, back to login');
			window.location.replace('main.html');		
		}
	});
	
	$('#logoutBtn').click(function() {
	
		sessionStorage.removeItem("isLogin");
		window.location.replace("main.html");
		
	});
	
	$("button").click(function(){	
					
		var btnId = $(this).attr('id');
		if (btnId.search('deleteBtn_') != -1) {		
			console.log(btnId+" is clicked.");
			btnNumber = btnId.substr(10,btnId.length);			
			id = $("#loginid_"+btnNumber).val();			
			name = $("#name_"+btnNumber).val();
			company = $("#company_"+btnNumber).val();		
			console.log(btnNumber+', '+id+', '+name+', '+company);
			
			if (confirm("Delete this user: "+id+" ?")){
				deleteUser(ridArray[btnNumber-1]);
			}
		}
		else if (btnId.search('updateBtn_') != -1) {		
			console.log(btnId+" is clicked.");
			btnNumber = btnId.substr(10,btnId.length);			
			id = $("#loginid_"+btnNumber).val();
			pwd = $("#password_"+btnNumber).val();
			name = $("#name_"+btnNumber).val();
			company = $("#company_"+btnNumber).val();
			identity = $("#identity_"+btnNumber).val();
			remarks = $("#remarks_"+btnNumber).val();
			console.log(btnNumber+', '+id+', '+name+', '+company);
			updateUser(ridArray[btnNumber-1]);
		}
		else if (btnId==='addBtn') {		
			console.log(btnId+" is clicked.");
			
			// add overlay dialog box
			$.blockUI({ message: $('#domMessage'), css: { cursor:'default', top:'200px', width:'350px', height:'500px'} }); 
			
			// dismiss the overlay dialog box
			$('#yesBtn').click(function() {
	 
				id = $("#loginid_new").val();
				pwd = $("#password_new").val();
				name = $("#name_new").val();
				company = $("#company_new").val();
				identity = $("#identity_new").val();
				remarks = $("#remarks_new").val();
				//console.log(id+', '+pwd+', '+name+', '+identity);
				addUser();	
				//window.location.reload(); 
			});
			$('#closeBtn').click(function() { 
				$.unblockUI();  
				window.location.reload();
			}); 
			
		}
		
	});
	
	$('input[type="text"]').keyup(function(e){   
		//alert($(this).attr('id'));
		var str = $.trim( $(this).val() );
		if( str != "" ) {
		  if (!regx.test(str)) {
			//$("#msg").html("Alphanumeric is only allowed !").css("color","red");
		  }
		  else{
		    $("#msg").html("");
			$("#msg2").html("");
		  }
		}
		else {
			$("#msg").html("");
			$("#msg2").html("");
		}
	});
	
	function addUser() {
		
		//to validate if the input is empty
		if ( $.trim(id)==""||$.trim(pwd)==""||$.trim(name)=="" ) {
			$("#msg2").html("Warning: No empty or white space for Login ID, Password and Name !").css("color","red");
			//alert("No empty or white space for Login ID, Password and Name !");
			return false;
		} 	

		// to validate if the input contains non-alphanumeric
		if ( !regx.test(id.substring(0,1)) ) {
			$("#msg2").html("Warning: The Login ID contains non-alphanumeric character !").css("color","red");
			//alert("The Login ID contains non-alphanumeric character !");
			return false;			
		}
		if ( !regx.test(pwd.substring(0,1)) ) {
			$("#msg2").html("Warning: The Password contains non-alphanumeric character !").css("color","red");
			//alert("The Password contains non-alphanumeric character !");
			return false;			
		}
		if ( !regx.test(name.substring(0,1)) ) {
			$("#msg2").html("Warning: The Name contains non-alphanumeric character !").css("color","red");
			//alert("The Name contains non-alphanumeric character !");
			return false;			
		}
/*		
		//var regx_empty = /^[A-Za-z0-9\_\/\-\s]*$/;
		if ( !regx.test(company.substring(0,1)) ) {
			$("#msg").html("Warning: The Company contains non-alphanumeric character !").css("color","red");
			return false;			
		}
		if ( !regx.test(remarks.substring(0,1)) ) {
			$("#msg").html("Warning: The Remarks contains non-alphanumeric character !").css("color","red");
			return false;			
		}
*/		
		// to validate the identity entered
		if (identity!="admin"&&identity!="sma"&&identity!="merch"&&identity!="client"){
			$("#msg2").text('Warning: The identity is not selected !').css("color", "red");
			//alert("The identity is not selected !");
			return false;
		} 

		var data = {"loginid":id,"password":pwd,"name":name,"company":company,"identity":identity,"remarks":remarks};
		console.log(data);
	
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "addUser.php",
			data:data,
			success: function(response) {
				
				 console.log(response);				 
				 if (response === "success") {
					$.unblockUI();
					//window.location.reload();
					window.location = "userManagement.php?identity_selected=" + identity;
				 } else if (response === "empty"){
					$("#msg").text('No blank Login ID, Password and Name is allowed.').css("color", "red");
				 } else if (response === "duplicateName"){
					$("#msg").text('The Name exists in system. Please type another name').css("color", "red");
				 } else if (response === "duplicateId"){
					$("#msg").text('The Login ID exists in system. Please type another Login ID').css("color", "red");
				 }
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	}
	
	function updateUser(rid) {
		
		//to validate if the input is empty		
		if ( $.trim(id)==""||$.trim(pwd)==""||$.trim(name)=="" ) {
			$("#msg").html("Warning: No empty or white space for Login ID, Password and Name !").css("color","red");
			return false;
		} 	

		// to validate if the input contains non-alphanumeric
		if ( !regx.test(id.substring(0,1)) ) {
			$("#msg").html("Warning: The Login ID contains non-alphanumeric character !").css("color","red");
			return false;			
		}
		if ( !regx.test(pwd.substring(0,1)) ) {
			$("#msg").html("Warning: The Password contains non-alphanumeric character !").css("color","red");
			return false;			
		}
		if ( !regx.test(name.substring(0,1)) ) {
			$("#msg").html("Warning: The Name contains non-alphanumeric character !").css("color","red");
			return false;			
		}
		
/*		//var regx_empty = /^[\s]*$/;		//empty field
		var regx = /^[A-Za-z0-9\_\/\-\s]*$/;
		if ( !regx.test(company.substring(0,1)) ) {
			$("#msg").html("Warning: The Company contains non-alphanumeric character !").css("color","red");
			return false;			
		}
		if ( !regx.test(remarks.substring(0,1)) ) {
			$("#msg").html("Warning: The Remarks contains non-alphanumeric character !").css("color","red");
			return false;			
		}
*/	
		// to validate the identity entered
		if (identity!="admin"&&identity!="sma"&&identity!="merch"&&identity!="client"){
			$("#msg").text('Warning: Only admin, client, merch or sma in Identity field allowed !').css("color", "red");
			return false;
		} 
	
		var data = {"rid":rid,"loginid":id,"password":pwd,"name":name,"company":$.trim(company),"identity":identity,"remarks":$.trim(remarks)};
		console.log(data);
	
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "updateUser.php",
			data:data,
			success: function(response) {
				
				 console.log(response);				 
				 if (response === "success") {								
					window.location.reload();
				 } else if (response === "empty"){
					$("#msg").text('Warning: No blank Login ID, Password, Name and Identity is allowed.').css("color", "red");
				 } else if (response === "duplicateName"){
					$("#msg").text('Warning: The name exists in system. Please type another name.').css("color", "red");
				 } else if (response === "duplicateId"){
					$("#msg").text('Warning: The Login ID exists in system. Please type another Login ID.').css("color", "red");
				 } else {
					
				 }
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	}
	
	function deleteUser(rid) {
		
		var data = {"rid":rid,"loginid":id,"name":name,"company":company};
		console.log(data);
	
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "deleteUser.php",
			data:data,
			success: function(response) {
				
				 console.log(response);				 
				 if (response === "success") {								
					window.location.reload();
				 } else {
					
				 }
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
	}
	
	function refreshTable() {
		var identity_selected = $("#identity_header").find(':selected').text();
		//alert(identity_selected+' is selected !!!');
		// to call itself to refresh the table
		window.location = "userManagement.php?identity_selected=" + identity_selected;
		
		/*
		$("#table").empty();
		var data = {"identity":identity_selected};
		console.log(data);
	
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "refreshUserTable.php",
			data:data,
			success: function(response) {
				
				 console.log(response);				 
				 if (response === "success") {
					$.each(response.data, function(key,v) {
						var index = key+1;
						var row = $('<tr><td>'+index+'</td><td>'+v.loginid+'</td><td>'+v.password+'</td><td>'+v.name+'</td><td>'+v.company+'</td><td>'+v.identity+'</td><td>'+remarks+'</td></tr>');
						row.appendTo('#table');	
					});
				 } 
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log('Error! textStatus' + ': ' + errorThrown);            
			}
		});
		*/
	}
	
	
</script>

</body>
</html> 
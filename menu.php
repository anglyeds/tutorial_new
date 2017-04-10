<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">		
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />	 
	
	
	<title>Login</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="lib/json2.js" type="text/javascript"></script>
	
	
<style>

.center {	
    text-align: center; 
	padding: 1em
}

/*
.button {
	border-radius: 5px;
	background-color: #dedede;	//#4CAF50;
	height: 100px;
	//width: 200px;
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

.button:hover{
     background: #45a999;
}
*/

input[type=text] {
    width: 60%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 60%;
    background-color: #4CAF50;
    color: white;
	font-size: 16px;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a999;
}

#loginBG {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.hide{display:none;}

.loadingLogo{
	background: url(Logo.png) no-repeat center;
	background-size: contain;
	-webkit-background-size: contain;
	height: 100px; 
	margin: 50px auto 50px;	
	width: auto;
}

table {
    //width: 80%;
    border-collapse: collapse;
	margin-left: auto;
    margin-right: auto;
}

.others {
	height: 100px;
    padding: 15px 32px;
    margin: 4px 2px;
}

.button_example{
	border:1px solid #d7dada; -webkit-border-radius: 3px; -moz-border-radius: 3px;border-radius: 3px;font-size:16px;font-family:arial, helvetica, sans-serif; /*padding: 10px 10px 10px 10px;*/ text-decoration:none; display:inline-block;text-shadow: 0px 0px 0 rgba(0,0,0,0.3);font-weight:bold; color: #000000;
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

<?php
	
	if (!isset($_SESSION)) {
		session_start();
	}
	//$user = $_SESSION['name'];
	$user_identity = $_SESSION['identity'];	
	
	
?>

<div class="loadingLogo"> </div>

<div class ="center">
	<table>
		<tr>
		<th><button id="user" class="button_example others" >User Management</button></th>
		<th><button id="store" class="button_example others " >Store Management</button></th>
		<th><button id="jobsheet" class="button_example others " >Job Sheet Creation</button></th>
		<th><button id="deployment" class="button_example others " >Planning/Deployment Sheet</button></th>
		<th><button id="period" class="button_example others " >Period Management</button></th>
		<th><button id="showPeriod" class="button_example others " >Set Period Shown in App</button></th>
		</tr>
	</table>
</div>


<div id="msg" class="center">
<br>
<br>
<button id="logoutBtn" class="button_example others" style="height:50px">Logout</button>
</div>




<script type="text/javascript">

var identity= <?php echo json_encode($user_identity ); ?>;


$(window).load(function() {
	
	if (sessionStorage.getItem("isLogin") !== "success") {
		alert('Login is not done, back to login');
		window.location.replace('main.html');		
	}
});


$(document).ready(function() {
	
	if (identity != 'admin') {
		$("#user").addClass('disabled');
		$('#user').attr("disabled", "true");
		/*$("#period").addClass('disabled');
		$('#period').attr("disabled", "true");
		$("#showPeriod").addClass('disabled');
		$('#showPeriod').attr("disabled", "true");*/
	}
});


$('#logoutBtn').click(function() {
	
	sessionStorage.removeItem("isLogin");
	sessionStorage.removeItem("userName");
	//$("#logoutBtn").addClass('disabled');
	//$('#logoutBtn').attr("disabled", "true");
	window.location.replace('main.html');
	
});

$('#user').click(function() {
	console.log("click user");
	window.location.replace('userManagement.php');
});

$('#store').click(function() {
	console.log("click store");
	window.location.replace('storeManagement.php');
});

$('#jobsheet').click(function() {
	console.log("click jobsheet");
	window.location.replace('jobSheet.php');
});

$('#deployment').click(function() {
	console.log("click deployment");
	window.location.replace('deploymentSheet.php');
});

$('#period').click(function() {
	console.log("click period");
	window.location.replace('periodManagement.php');
});

$('#showPeriod').click(function() {
	console.log("click showPeriod");
	window.location.replace('showPeriodInApps.php');
});

</script>


</body>
</html> 

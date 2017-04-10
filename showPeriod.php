<!DOCTYPE html>
<html>

<head>
<!--<meta charset="UTF-8">-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>Period</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<style>
.upper_center {
    text-align: center; 
	border-color: green;
	border-width: 3px;
	border-top-style: solid ;
    border-right-style: solid;
    border-left-style: solid;
	padding: 1em;
}
.lower_center {
    text-align: center;
	border-color: green;	
	border-width: 3px;	
	border-bottom-style: solid;
    border-right-style: solid;
    border-left-style: solid;
	padding: 1em;
}
</style>
</head> 

<body>

<?php
	echo '<div class="upper_center">';
	echo "Merchandizer = " . $_COOKIE['userlogin'];
	echo '</div>';
?>


<form action="getStore.php" class="lower_center"method="POST">

  <label>Period:</label>
  <select name="period" id="periodSelect">
	<option value="xyz" selected disabled>Please select</option>
    
	<option value="wd21">wd21</option>
    <option value="we21">we21</option>
	<option value="wd22">wd22</option>
    <option value="we22">we22</option>
	<option value="wd23">wd23</option>
    <option value="we23">we23</option>
	<option value="wd24">wd24</option>
    <option value="we24">we24</option>
	<option value="wd25">wd25</option>
    <option value="we25">we25</option>
	
  </select> <br><br>
  <button type="submit" id="btn" disabled >Search Store List</button>
 
  <br>
  
</form> 

<script>

	var e = document.getElementById("periodSelect");
	var selectedOption = e.options[e.selectedIndex].value;
	console.log(selectedOption);
	
	if (selectedOption == "xyz") {
		waitForSelection();
	}
	else {
		
		document.getElementById('btn').disabled = false;
	}
	
function waitForSelection(){

	var x = e.options[e.selectedIndex].value;
	
    if(x != "xyz"){
		console.log(selectedOption);
        document.getElementById('btn').disabled = false;
    }
    else{
        setTimeout(function(){
            waitForSelection();
        },100);
    }
}
</script>




<!--
<form action="joinTable.php" method="get">
Select the user:
<select name="name" onchange="this.form.submit()">
  <option value="Coco">Coco</option>
  <option value="Wai">Wai</option>
  <option value="Vicky">Vicky</option>
  <option value="Ping">Ping</option>
</select>
</form>
-->



</body>
</html> 
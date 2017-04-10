
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>Store Management</title> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="lib/json2.js" type="text/javascript"></script>


<style>

table {
    width: 85%;
    border-collapse: collapse;	
	margin-left: auto;
    margin-right: auto;
	table-layout: fixed;
}

td {
    //border: 1px solid black;
    padding: 2px;
	//border-bottom: 1px solid #ddd;
	text-align: center;
	overflow: hidden;
}

th {
    background-color: #dedede;	//#4CAF50;
    color: black;
	height: 30px;
	text-overflow:ellipsis;	
    font-family: "Times New Roman", Georgia, Serif;
	font-weight: normal;
	border:1px solid #c0c0c0;
}

tr:nth-child(even) {background-color: #f2f2f2}

tr:hover{background-color:#99ccff}

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

.center {
	text-align: center;
}

input[type=text] {
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

.batch_btn {
	border-radius: 5px;
	background-color: #dedede;	//#4CAF50;
	height: 50px;
	width: 300px;
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

.batch_btn:hover{
     background: #45a999;
}
.w50 {
	width: 50px;
}
.w100 {
	width: 100px;
}
.w170 {
	width: 170px;
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
.w500 {
	width: 500px;
}
.hide {
	display:none;
}

.batchWindowBG {
	width:40%; 
	height: 170px; 
	text-align:center; 
	background-color:#dedede;	//#4CAF50; 
	border:1px solid grey;
	margin-left:auto;
	margin-right:auto;
}



.tftextinput{
	margin: 0;
	padding: 5px 15px;
	font-family: Arial, Helvetica, sans-serif;
	font-size:14px;
	border:1px solid #0076a3; border-right:0px;
	border-top-left-radius: 5px 5px;
	border-bottom-left-radius: 5px 5px;
}
.tfbutton {
	margin: 0;
	padding: 5px 15px;
	font-family: Arial, Helvetica, sans-serif;
	font-size:14px;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	color: #ffffff;
	border: solid 1px #0076a3; border-right:0px;
	background: #0095cd;
	background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
	background: -moz-linear-gradient(top,  #00adee,  #0078a5);
	border-top-right-radius: 5px 5px;
	border-bottom-right-radius: 5px 5px;
}
.tfbutton:hover {
	text-decoration: none;
	background: #007ead;
	background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
	background: -moz-linear-gradient(top,  #0095cc,  #00678e);
}
/* Fixes submit button height problem in Firefox */
.tfbutton::-moz-focus-inner {
  border: 0;
}

</style>

</head> 
<body>

	<?php include 'connectDB.php';	?>
	
	<button style="width:250px" onclick="location.href='storeManagement.php'">Return to Store Management</button>
	<h1 class="center">Store Rearch Result</h1>
	
	
	<div id="table_contianer" style="margin:auto; width:95%">
	<table>	
		<thead>	
		<tr>	
			<th class="w50">No.</th>
			<th class='w100'>Retailer</th>
			<th class='w100'>Store Code</th> 
			<th class='w100'>Format</th>
			<th class='w100'>Region</th> 
			<th class='w100'>Area</th>
			<th class='w200'>Store Name</th>
			<th class='w100'>舖名</th> 
			<th class='w400'>Store Address</th>
			<th class='w100'id="phone">Telephone</th> 
			<th class='w170'colspan="2" id="action">Action</th>
		</tr>
		</thead>
		
		<tbody id="table">
		</tbody>
	</table>
	</div>
	
	<br>
	<div id="msg" class="center"></div>
	
	
	
<script type="text/javascript">
	
	var ridArray = [];
	var retailer = '';
	var code = '';
	var format = '';
	var region = '';
	var area = '';
	var name_e ='';
	var name_c ='';
	var address ='';
	var phone ='';
	var rid ='';
	
	var regx = /^[A-Za-z0-9]+$/;  
	/**************
	/^ 			- start of string
	[a-zA-Z0-9] - lowercase letter, uppercase letter, or digit
	+ 			- 1 or more of the previous character class
	$/ 			- end of the string
	**************/
	
	// The asterisk indicates zero or more occurrences of the preceding element. 
	// For example, ab*c matches "ac", "abc", "abbc", "abbbc", and so on.
	// The plus sign indicates one or more occurrences of the preceding element. 
	// For example, ab+c matches "abc", "abbc", "abbbc", and so on, but not "ac".
	
	//var regx = /^[A-Za-z0-9'\-]+( [A-Za-z0-9]+)*$/;	//allow a space between two words
	/**************
	/^					-beginning of string
	[A-Za-z0-9'\-]+     -first word: one or more uppercase letters, lowercase letters, digit, hypen(-) or apostrophe(')
	( [A-Za-z0-9]+)*  	-second word: zero or more instances of (a single space followed by one or more letters)
	$/                  -end of string
	**************/
	
	
	//var regxutf8 = /([^\x00-\x7F]|\w)+$/;
	// allow chinese chars, space between two words, apostrophe, hypen slash
	//var regx = /(['\-\/]|[^\x00-\x7F]|\w)+( ['\-\/]|[^\x00-\x7F]|\w)*$/;

$(window).load(function() {

	search();

});

function search() {
	
	var keyword = sessionStorage.getItem('searchStore', keyword);	
	console.log('search word = ' + keyword);
	var data = {"keyword":keyword};
	
	if (keyword==='')
	{
		//$("#msg").text("Nothing in search bar.").css("color", "red");
		alert("Nothing in search bar.");
		return false;
	}
	
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "searchStore.php",
		data:data,
		success: function(response) {
			
			console.log(response);	
						 
			if (response['result'] === "success") {	
				
				$.each(response.data, function(key,v) {
					
					var count = key + 1;
					
					var row =  $('<tr><td class="w50">'+count+'</td><td class="w100"><input id="retailer_'+count+'" type="text" maxlength="50" class="w100" value="'+v.retailer+'"></td><td class="w100"><input id="code_'+count+'" type="text" maxlength="50" class="w100" value="'+v.store_code+'"></td><td class="w100"><input id="format_'+count+'" type="text" maxlength="50" class="w100" value="'+v.format+'"></td><td class="w100"><input id="region_'+count+'" type="text" maxlength="50" class="w100" value="'+v.region+'"></td><td class="w100"><input id="area_'+count+'" type="text" maxlength="50" class="w100" value="'+v.area+'"></td><td class="w200"><input id="name_e_'+count+'" type="text" maxlength="50" class="w200" value="'+v.store_name_e+'"></td><td class="w100"><input id="name_c_'+count+'" type="text" maxlength="50" class="w100" value="'+v.store_name_c+'"></td><td class="w400"><input id="address_'+count+'" type="text" maxlength="100" class="w400" value="'+v.store_address+'"></td><td class="w100"><input id="phone_'+count+'" type="text" maxlength="20" class="w100" value="'+v.store_phone+'"></td><td ><button id="updateBtn_'+count+'" >Update</button></td><td ><button id="deleteBtn_'+count+'" >Delete</button></td></tr>');
					
					row.appendTo('#table');	
					
					$.each(response.rid, function(key,val) {
						ridArray.push(val);
					});
					
					$("button").click(function(){			
								
						var btnId = $(this).attr('id');
						if (btnId.search('deleteBtn_') != -1) {		
							console.log(btnId+" is clicked.");
							btnNumber = btnId.substr(10,btnId.length);			
							retailer = $("#retailer_"+btnNumber).val();			
							code = $("#code_"+btnNumber).val();
							format = $("#format_"+btnNumber).val();
							region = $("#region_"+btnNumber).val();			
							area = $("#area_"+btnNumber).val();
							name_e = $("#name_e_"+btnNumber).val();	
							
							if (confirm("delete this store?")){
								deleteStore(ridArray[btnNumber-1]);
							}
						}
						else if (btnId.search('updateBtn_') != -1) {		
							console.log(btnId+" is clicked.");
							btnNumber = btnId.substr(10,btnId.length);			
							retailer = $("#retailer_"+btnNumber).val();			
							code = $("#code_"+btnNumber).val();
							format = $("#format_"+btnNumber).val();
							region = $("#region_"+btnNumber).val();			
							area = $("#area_"+btnNumber).val();
							name_e = $("#name_e_"+btnNumber).val();
							name_c = $("#name_c_"+btnNumber).val();			
							address = $("#address_"+btnNumber).val();
							phone = $("#phone_"+btnNumber).val();
							console.log(btnNumber+', '+retailer+', '+name_c+', '+address);
							updateStore(ridArray[btnNumber-1]);
						}
						
					});
						
						
					// to validate if the input is allowed character/symbol
					$('input[type="text"]').keyup(function(e){   	
						var str = $.trim( $(this).val() );
						if( str != "" ) {
						  
						  if (!regx.test(str)) {
							//$("#msg").html("Alphanumeric is only allowed !").css("color","red");
						  }
						  else{
							$("#msg").html("");
						  }
						}
						else {
							$("#msg").html("");
						}
					});
						
				});
				
			}else if (response['result'] === "not_found"){
				
				//$("#msg").text("Nothing found in store database.").css("color", "red");
				alert("Nothing found in store database.");
			}
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
	
}

function updateStore(rid) {
	
	//to validate the input
	if ( $.trim(retailer)==""||$.trim(code)==""||$.trim(format)==""||$.trim(name_e)==""||$.trim(name_c)==""||$.trim(address)==""||$.trim(region)==""||$.trim(area)==""||$.trim(phone)=="" ) {
		//$("#msg").html("Warning: No empty in all fields except Format !").css("color","red");
		alert("No empty in all fields !");
		return ;
	} 
/*
	if ( !regx.test(retailer.substring(0,1)) ) {
		$("#msg").html("Warning: The retailer contains non-alphanumeric character !").css("color","red");
		return false;			
	}
	if ( !regx.test(code.substring(0,1)) ) {
		$("#msg").html("Warning: The store code contains non-alphanumeric character !").css("color","red");
		return false;			
	}
	if ( !regx.test(name_e.substring(0,1)) ) {
		$("#msg").html("Warning: The store name contains non-alphanumeric character !").css("color","red");
		return false;			
	}
	if ( !regx.test(format.substring(0,1)) ) {
		$("#msg").html("Warning: The format contains non-alphanumeric character !").css("color","red");
		return false;			
	}
	if ( !regx.test(region.substring(0,1)) ) {
		$("#msg").html("Warning: The region contains non-alphanumeric character !").css("color","red");
		return false;			
	}
	if ( !regx.test(area.substring(0,1)) ) {
		$("#msg").html("Warning: The area contains non-alphanumeric character !").css("color","red");
		return false;			
	}
*/

/*	
	//var regxutf8 = /([^\x00-\x7F]|\w)+$/;
	// to validate if input is not other than 0-9, a-z, A-Z, ', /, _ and Chinese characters
	if(!regx.test(name_c)){
		$("#msg").html("Warning: The 舖名 contains non-alphanumeric character !").css("color","red");
		return false;	   
	}	
	if ( !regx.test(address) ) {
		$("#msg").html("Warning: The address contains non-alphanumeric character !").css("color","red");
		return false;			
	}
*/	
	// to validate if the phone number contains digit only
	if (!$.isNumeric(phone)) {
		$("#msg").html("Warning: Only digit in Telepone !").css("color","red");
		alert("Only digit in Telepone !");
		return false;			
	}

	// to validate if the region is same as pre-defined words
	if ( $.trim(region)!="KLN"&&$.trim(region)!="HK"&&$.trim(region)!="NT") {
		$("#msg").html("Warning: Only 'KLN', 'NT', 'HK in region !").css("color","red");
		alert("Only 'KLN', 'NT', 'HK in region !");
		return false;
	} 	
	
	
	var data = {"rid":rid,"code":code,"retailer":retailer,"format":format,"region":region,"area":area,"name_e":name_e,"name_c":name_c,"address":address,"phone":phone};
	console.log(data);

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "updateStore.php",
		data:data,
		success: function(response) {
			
			 console.log(response);				 
			 if (response === "success") {								
				location.reload();
			 } else if (response === "empty"){
				$("#msg").text('No blank Retailer, Store Name, Store Code and Address is allowed.').css("color", "red");
			 } else if (response === "duplicate"){
				$("#msg").text('The Store Code exists in system.').css("color", "red");
			 } else {
				
			 }
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
	
}

function deleteStore(rid) {
	
	var data = {"rid":rid,"retailer":retailer,"code":code,"format":format,"region":region,"area":area,"name_e":name_e};
	console.log(data);

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "deleteStore.php",
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



/*	
function updateStoreList(src) {
	
	// read the value of keys
	var retailer_h = $("#retailer_header").find(':selected').text();
	var format_h = $("#format_header").find(':selected').text();
	var region_h = $("#region_header").find(':selected').text();
	var area_h = $("#area_header").find(':selected').text();
	var name_e_h = $("#storename_e_header").find(':selected').text();
	var name_c_h = $("#storename_c_header").find(':selected').text();
	
	var data = {"retailer":retailer_h,"format":format_h,"region":region_h,"area":area_h,"name_e":name_e_h,"name_c":name_c_h};
	console.log(data);
	
	// empty the table
	$("#table").empty();
	// emtyp array to store id
	ridArray = [];
	
	var sortedBy = src;
	console.log("called by "+sortedBy);
	if (sortedBy=='All') {
		// reset the sorting keys
		sessionStorage.setItem('retailer', 'All');	
		sessionStorage.setItem('format', 'All');	
		sessionStorage.setItem('region', 'All');
		sessionStorage.setItem('area', 'All');
		sessionStorage.setItem('name_e', 'All');
		sessionStorage.setItem('name_c', 'All');
		data = {"retailer":"All","format":"All","region":"All","area":"All","name_e":"All","name_c":"All"};	//workaround Google Chrome's bug
	}
	else if (sortedBy=='retailer') {
		sessionStorage.setItem('retailer', retailer_h);
	}
	else if (sortedBy=='format') {
		sessionStorage.setItem('format', format_h);
	}						
	else if (sortedBy=='region') {
		sessionStorage.setItem('region', region_h);
	} 
	else if (sortedBy=='area') {
		sessionStorage.setItem('area', area_h);
	}
	else if (sortedBy=='name_e') {
		sessionStorage.setItem('name_e', name_e_h);
	} 
	else if (sortedBy=='name_c') {
		sessionStorage.setItem('name_c', name_c_h);
	}
	
	$.ajax({
		type:"POST",
		dataType: "json",
		url: "sortStoreList.php",
		data:data,
		success: function(response) {
			
			console.log(response);	
						 
			if (response['result'] === "success") {	
				
				$.each(response.data, function(key,v) {
					
					//console.log(v.store_code+', '+v.store_name_c+', '+v.store_address);
					
					var count = key + 1;
					
					var row =  $('<tr><td class="w50">'+count+'</td><td class="w100"><input id="retailer_'+count+'" type="text" maxlength="50" class="w100" value="'+v.retailer+'"></td><td class="w100"><input id="code_'+count+'" type="text" maxlength="50" class="w100" value="'+v.store_code+'"></td><td class="w100"><input id="format_'+count+'" type="text" maxlength="50" class="w100" value="'+v.format+'"></td><td class="w100"><input id="region_'+count+'" type="text" maxlength="50" class="w100" value="'+v.region+'"></td><td class="w100"><input id="area_'+count+'" type="text" maxlength="50" class="w100" value="'+v.area+'"></td><td class="w200"><input id="name_e_'+count+'" type="text" maxlength="50" class="w200" value="'+v.store_name_e+'"></td><td class="w100"><input id="name_c_'+count+'" type="text" maxlength="50" class="w100" value="'+v.store_name_c+'"></td><td class="w400"><input id="address_'+count+'" type="text" maxlength="100" class="w400" value="'+v.store_address+'"></td><td class="w100"><input id="phone_'+count+'" type="text" maxlength="20" class="w100" value="'+v.store_phone+'"></td><td ><button id="updateBtn_'+count+'" >Update</button></td><td ><button id="deleteBtn_'+count+'" >Delete</button></td></tr>');
					
					row.appendTo('#table');				
					
				});
				
				// append a row to add new store
				var row =  $('<tr><td class="w50"></td><td class="w100"><input id="retailer_new" type="text" maxlength="50" class="w100" value=""></td><td class="w100"><input id="code_new" type="text" maxlength="50" class="w100" value=""></td><td class="w100"><input id="format_new" type="text" maxlength="50" class="w100" value=""></td><td class="w100"><input id="region_new" type="text" maxlength="50" class="w100" value=""></td><td class="w100"><input id="area_new" type="text" maxlength="50" class="w100" value=""></td><td class="w200"><input id="name_e_new" type="text" maxlength="50" class="w200" value=""></td><td class="w100"><input id="name_c_new" type="text" maxlength="50" class="w100" value=""></td><td class="w400"><input id="address_new" type="text" maxlength="100" class="w400" value=""></td><td class="w100"><input id="phone_new" type="text" maxlength="20" class="w100" value=""></td><td ><button id="addBtn" >Add</button></td><td></tr>');
				row.appendTo('#table');	
				
				$.each(response.rid, function(key,val) {
					ridArray.push(val);
				});
				//console.log(ridArray);
				
				// refresh the option in retailer select
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
				
				// refresh the option in format select
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
				
				// refresh the option in region select
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
				
				// refresh the option in area select
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
				
				// refresh the option in store name select
				$("#storename_e_header").empty();
				var row_name_e = $('<option value=All>All</option>');
				row_name_e.appendTo('#storename_e_header');				
				$.each(response.name_e, function(key,v) {					
					// update the area keys in option	
					if (response.name_e[key] == sessionStorage.getItem('name_e')) {					
						row_name_e = $('<option value='+response.name_e[key]+' selected>'+response.name_e[key]+'</option>');
					} else {
						row_name_e = $('<option value='+response.name_e[key]+'>'+response.name_e[key]+'</option>');
					}
					row_name_e.appendTo('#storename_e_header');					
				});
				
				// refresh the option in 舖名 select
				$("#storename_c_header").empty();
				var row_name_c = $('<option value=All>All</option>');
				row_name_c.appendTo('#storename_c_header');				
				$.each(response.name_c, function(key,v) {					
					// update the area keys in option	
					if (response.name_c[key] == sessionStorage.getItem('name_c')) {					
						row_name_c = $('<option value='+response.name_c[key]+' selected>'+response.name_c[key]+'</option>');
					} else {
						row_name_c = $('<option value='+response.name_c[key]+'>'+response.name_c[key]+'</option>');
					}
					row_name_c.appendTo('#storename_c_header');					
				});
				
				$("button").click(function(){			
								
					var btnId = $(this).attr('id');
					if (btnId.search('deleteBtn_') != -1) {		
						console.log(btnId+" is clicked.");
						btnNumber = btnId.substr(10,btnId.length);			
						retailer = $("#retailer_"+btnNumber).val();			
						code = $("#code_"+btnNumber).val();
						format = $("#format_"+btnNumber).val();
						region = $("#region_"+btnNumber).val();			
						area = $("#area_"+btnNumber).val();
						name_e = $("#name_e_"+btnNumber).val();	
						
						if (confirm("delete this store?")){
							deleteStore(ridArray[btnNumber-1]);
						}
					}
					else if (btnId.search('updateBtn_') != -1) {		
						console.log(btnId+" is clicked.");
						btnNumber = btnId.substr(10,btnId.length);			
						retailer = $("#retailer_"+btnNumber).val();			
						code = $("#code_"+btnNumber).val();
						format = $("#format_"+btnNumber).val();
						region = $("#region_"+btnNumber).val();			
						area = $("#area_"+btnNumber).val();
						name_e = $("#name_e_"+btnNumber).val();
						name_c = $("#name_c_"+btnNumber).val();			
						address = $("#address_"+btnNumber).val();
						phone = $("#phone_"+btnNumber).val();
						console.log(btnNumber+', '+retailer+', '+name_c+', '+address);
						updateStore(ridArray[btnNumber-1]);
					}
					else if (btnId==='addBtn') {		
						console.log(btnId+" is clicked.");
						retailer = $("#retailer_new").val();
						code = $("#code_new").val();
						format = $("#format_new").val();
						region = $("#region_new").val();
						area = $("#area_new").val();
						name_e = $("#name_e_new").val();
						name_c = $("#name_c_new").val();
						address = $("#address_new").val();
						phone = $("#phone_new").val();
						addStore();
					}
				});
				
				
				// to validate if the input is allowed character/symbol
				$('input[type="text"]').keyup(function(e){   	
					var str = $.trim( $(this).val() );
					if( str != "" ) {
					  
					  if (!regx.test(str)) {
						//$("#msg").html("Alphanumeric is only allowed !").css("color","red");
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
			 
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
	
};	

*/


/*
function addStore() {
	
	//to validate the input is empty or white space
	if ( $.trim(retailer)==""||$.trim(code)==""||$.trim(name_e)==""||$.trim(name_c)==""||$.trim(address)==""||$.trim(region)==""||$.trim(area)==""||$.trim(phone)=="" ) {
		$("#msg").html("Warning: No empty in all fields except Format!").css("color","red");
		return;
	} 

	// to validate if the input is not other than 0-9, a-z, A-Z, ', /, _ 
	if ( !regx.test(retailer.substring(0,1))) {
		$("#msg").html("Warning: The retailer contains non-alphanumeric character !").css("color","red");
		return;			
	}
	if ( !regx.test(code.substring(0,1))) {
		$("#msg").html("Warning: The store code contains non-alphanumeric character !").css("color","red");
		return;			
	}
	if ( !regx.test(name_e.substring(0,1)) ) {
		$("#msg").html("Warning: The store name contains non-alphanumeric character !").css("color","red");
		return;			
	}
	if ( !regx.test(format.substring(0,1))) {
		$("#msg").html("Warning: The format contains non-alphanumeric character !").css("color","red");
		return;			
	}
	if ( !regx.test(region.substring(0,1)) ) {
		$("#msg").html("Warning: The region contains non-alphanumeric character !").css("color","red");
		return;			
	}
	if ( !regx.test(area.substring(0,1)) ) {
		$("#msg").html("Warning: The area contains non-alphanumeric character !").css("color","red");
		return;			
	}
	


	// to validate if phone number only contains digit only
	if (!$.isNumeric(phone)) {
		$("#msg").html("Warning: Only digit in Telepone !").css("color","red");
		return false;			
	}
	
	
	// to validate if the region is same as pre-defined words
	if ( $.trim(region)!="KLN"&&$.trim(region)!="HK"&&$.trim(region)!="NT") {
		$("#msg").html("Warning: Only 'KLN', 'NT', 'HK in region !").css("color","red");
		return false;
	} 

	var data = {"retailer":retailer,"code":code,"format":format,"region":region,"area":area,"name_e":name_e,"name_c":name_c,"address":address,"phone":phone};
	console.log(data);

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "addStore.php",
		data:data,
		success: function(response) {
			
			 console.log(response);				 
			 if (response === "success") {	
				location.reload();
			 } else if (response === "empty"){
				$("#msg").text('No blank Retailer, Store Code, Store Name, 舖名 and Address is allowed.').css("color", "red");
			 } else if (response === "duplicate"){
				$("#msg").text('The store code exists in system.').css("color", "red");
			 } else {
				
			 }
		},
		error:function (jqXHR, textStatus, errorThrown) {
			console.log('Error! textStatus' + ': ' + errorThrown);            
		}
	});
}
*/

	
</script>

</body>
</html> 
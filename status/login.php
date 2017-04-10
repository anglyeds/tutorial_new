
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>卓思 (Client report web)</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/lib/jquery-1.11.3.js" type="text/javascript"></script>
	<script src="/lib/json2.js" type="text/javascript"></script>
	
	<style>
		a:link {
			text-decoration: none;
		}

		a:visited {
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}

		a:active {
			text-decoration: underline;
		}
	</style>

</head> 

<body>
	<p>卓思市務 Client Report Web</p>
	<form id="form1" name="form1" method="POST" action="getLogin.php">
	<table width="243" border="0">
		<tr><td width="52">賬戶</td>
			<td width="175"><input name="loginid" type="text" id="name"/></td></tr>		
		<tr><td>密碼</td>
			<td><input name="password" type="password" id="password" /></td></tr>
		<tr><td>&nbsp;</td>
		<td><input type="submit" name="submit" id="submit" value="送出" />        
			<input type="reset" name="reset" id="reset" value="重設" /></td></tr>
		<tr>
			<td colspan=2 align="right">
			<a href="version.php" style="font-size:14px; color:#009900">Version:0.001</a></td></tr>
	</table>
	</form>
	
	
</body>
</html>


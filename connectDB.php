<?php

	define('HOSTNAME', 'localhost');
    define('USERNAME', 'smadmin');
    define('PASSWORD', 'sma123!');
    define('DATABASE', 'sma_project');

	//$dbLink = mysql_connect(HOSTNAME, USERNAME, PASSWORD)or die(mysql_error());
    $con = mysql_connect(HOSTNAME, USERNAME, PASSWORD)or die(mysql_error());
    mysql_query("SET character_set_results=utf8", $con)or die(mysql_error());
    mb_language('uni'); 
    mb_internal_encoding('UTF-8');
    mysql_select_db(DATABASE, $con)or die(mysql_error());
	mysql_query("set names 'utf8'",$con)or die(mysql_error());


?>
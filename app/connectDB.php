<?php

	define('HOSTNAME', 'localhost');
    define('USERNAME', 'smadmin');
    define('PASSWORD', 'sma123!');
    define('DATABASE', 'sma_project');

    $dbLink = mysql_connect(HOSTNAME, USERNAME, PASSWORD)or die(mysql_error());
    mysql_query("SET character_set_results=utf8", $dbLink)or die(mysql_error());
    mb_language('uni'); 
    mb_internal_encoding('UTF-8');
    mysql_select_db(DATABASE, $dbLink)or die(mysql_error());
	mysql_query("set names 'utf8'",$dbLink)or die(mysql_error());



?>
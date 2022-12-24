<?php
	if(!isset($_GET['cron_key']) || $_GET['cron_key'] != "dsgasd8gvsedir2fdf"){
		header('Location: /error');
		exit();
	}
	
	$require_functions_allow = true;
	require('../php/set.php');
	require('../php/functions.php');

	$temp = intable_search_items("SELECT `id` FROM `forget_pass` WHERE `time`-".(time() - 300), -1);
	foreach($temp as $value)
		mysql_query("DELETE FROM `forget_pass` WHERE `id`=".$value['id']);
				
?>
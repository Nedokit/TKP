<?php
	if(!isset($_GET['cron_key']) || $_GET['cron_key'] != "dsgasd8gvsedir2fdf"){
		header('Location: /error');
		exit();
	}
	
	$require_functions_allow = true;
	require('../php/set.php');
	mysql_query("UPDATE `shop_items` SET `adv`=0 WHERE `adv_time`-".time()."<0");
?>
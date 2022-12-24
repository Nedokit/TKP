<?php
	if(!$require_functions_allow){
		header('Location: /error');
		exit();
	}

	$bd_settings = array(
		"ip_link" => "localhost",
		"user_name" => "u0538_realto",
		"user_pass" => "v8732rgggF",
		"bd_name" => "u0538747_realto"
	);

	$link = mysql_connect($bd_settings['ip_link'], $bd_settings['user_name'], $bd_settings['user_pass']);
	$db_selected = mysql_select_db($bd_settings['bd_name'], $link);
	mysql_query("SET NAMES utf8");
?>
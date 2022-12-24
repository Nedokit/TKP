<?php
	if(!$require_functions_allow){
		header('Location: /error');
		exit();
	}

	$bd_settings = array(
		"ip_link" => "localhost",
		"user_name" => "k90217zc_base",
		"user_pass" => "t0pSecret",
		"bd_name" => "k90217zc_base"
	);

	$link = mysql_connect($bd_settings['ip_link'], $bd_settings['user_name'], $bd_settings['user_pass']);
	$db_selected = mysql_select_db($bd_settings['bd_name'], $link);
	mysql_query("SET NAMES utf8");
?>
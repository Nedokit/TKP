<?php
	//ini_set('display_errors', 0); error_reporting(E_ALL ^E_NOTICE);

	$require_functions_allow = true;
	require("php/set.php");
	require("php/functions.php");

	$temp = intable_search_item("SELECT `keywords`, `description`, `contact_mail`, `contact_phone`, `soc_1`, `soc_2`, `soc_3` FROM `base_settings`");
	$settings['description'] = $temp['description'];
	$settings['keywords'] = $temp['keywords'];
	$settings['contact_mail'] = $temp['contact_mail'];
	$settings['contact_phone'] = $temp['contact_phone'];
	$settings['soc_1'] = $temp['soc_1'];
	$settings['soc_2'] = $temp['soc_2'];
	$settings['soc_3'] = $temp['soc_3'];

	$exodus = array();

	session_start();

	if(isset($_SESSION['name']) && ($_SESSION['name'] == "user_loged") && check_user_loged($_SESSION['user_info'])){
		$settings['auth'] = true;
		$_SESSION['user_info'] = intable_search_item("SELECT * FROM `user` WHERE `id`=".$_SESSION['user_info']['id']);
	}
	else $settings['auth'] = false;

	if(!isset($_GET['page'])) $page = "main";
	else $page = $_GET['page'];
	
	if(!file_exists($page.".php")) header('Location: /error');
	else{
		$require_page_allow = true;
		require("page_settings.php");
		require("base_page.php");
	}
	exit();
?>
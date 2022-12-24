<?php
	if(!$require_page_allow){
		require("error.php");
		exit();
	}

	if($settings['auth']) $page = "cabinet";
	else $page = "lending";
	require($page.".php");
?>
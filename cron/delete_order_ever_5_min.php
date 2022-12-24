<?php
	if(!isset($_GET['cron_key']) || $_GET['cron_key'] != "dsgasd8gvsedir2fdf"){
		header('Location: /error');
		exit();
	}
	
	$require_functions_allow = true;
	require('../php/set.php');
	require('../php/functions.php');

	$temp = intable_search_items("SELECT * FROM `orders` WHERE `out_time`-".time()."<0 AND `exe_id`=-1", -1);
	foreach($temp as $value)
		if(mysql_query("INSERT INTO `history_orders`(`id`, `categories`, `towns`, `date`, `description`, `set_time`, `out_time`, `user_id`, `exe_id`, `viewes`) VALUES (".$value['id'].", ".$value['categories'].", ".$value['towns'].", '".$value['date']."', '".$value['description']."', ".$value['set_time'].", ".$value['out_time'].", ".$value['user_id'].", ".$value['exe_id'].", ".$value['viewes'].")") && mysql_query("DELETE FROM `orders` WHERE `id`=".$value['id'])){
			echo 'ok<br>';
			mysql_query("INSERT INTO `notifications`(`user_id`, `text`) VALUES (".$value['user_id'].", 'За время тендера на ваш заказ никто не откликнулся, и он был автоматически завершён.')");
		}
				
?>
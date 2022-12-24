<?php
	if(!$require_page_allow || !isset($_GET['order_id'])){
		header('Location: /error');
		exit();
	}

	require('exe.php');

	$temp = intable_search_item("SELECT * FROM `orders` WHERE `id`=".$_GET['order_id']);

	$owner_flag = false;
	if($temp['user_id'] == $_SESSION['user_info']['id']) $owner_flag = true;

	$set_info = intable_search_item("SELECT `categories`,`towns` FROM `base_settings`");

	$cat = split(";", $set_info['categories'])[$temp['categories']-1];
	$towns = split(";", $set_info['towns'])[$temp['towns']-1];

	$temp_time = $temp['out_time'] - time();
	if($temp_time < 3600) $time_out = int_div($temp_time, 60)." минут";
	else if($temp_time < 86400) $time_out = int_div($temp_time, 3600)." часов";
	else $time_out = int_div($temp_time, 86400)." дней";
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/order.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<div style="padding-top: 30px; padding-bottom: 30px;" class="conteiner">
					<div class="order_block">
						<a class="type"><?php echo $towns; ?></a>
						<a class="title"><?php echo $cat; ?></a>
						<a class="text">
							<?php echo $temp['description']; ?>
						</a>
						<div class="share_line">Прикреплённые файлы</div>
						<a href="<?php echo $temp['file']; ?>" class="file" download><?php echo split("/", $temp['file'])[1]; ?></a>
					</div>
					<div class="timer">
						<?php
							if($temp_time > 0)
								echo '<div class="last_time"><a>Осталось времени:</a> '.$time_out.'</div>';
							else echo '<div class="last_time"><a>Тендр закончился</a></div>';				
						?>
					</div>
					<?php
						if($_SESSION['user_info']['id'] != $temp['exe_id'] && intable_count_items("SELECT `id` FROM `orders` WHERE `id`=".$_GET['order_id']." AND `user_id`=".$_SESSION['user_info']['id']." AND `exe_id`<>-1") == 0)
							if($temp_time > 0)
								echo('
									<div class="timer_back">
										<div class="last_time">Скрыто <a>'.intable_count_items("SELECT `id` FROM `back_order` WHERE `order_id`=".$temp['id']).'</a> откликов<br>(отклики откроются по завершению времени тендера)</div>
									</div>
								');
							else {
								echo('
									<div class="timer_back">
										<div class="last_time">Открыто <a>'.intable_count_items("SELECT `id` FROM `back_order` WHERE `order_id`=".$temp['id']).'</a> откликов</div>
									</div>
								');

								echo '<ul class="order_back_block">';

								$temp = intable_search_items("SELECT * FROM `back_order` WHERE `order_id`=".$_GET['order_id'], -1);

								foreach($temp as $value){
									$user_info_temp = intable_search_item("SELECT `profile_photo`, `fio` FROM `user` WHERE `id`=".$value['user_id']);
									if($user_info_temp['profile_photo'] == null) $user_info_temp['profile_photo'] = "uploads/none.jpg";
									echo('<li>');
									if($owner_flag) echo '<form class="select_exe" action="/?page=order&order_id='.$_GET['order_id'].'" method="POST"><input type="hidden" name="operation_type" value="select_exe"><input type="hidden" name="exe_id" value="'.$value['user_id'].'"><input type="hidden" name="order_id" value="'.$_GET['order_id'].'"><button>Выбрать</button></form>';
									echo('	<img src="'.$user_info_temp['profile_photo'].'" />
											<div class="title">'.$user_info_temp['fio'].' готов иготовить за <a>'.number_format($value['price'], 0, ',', ' ').' руб.</a></div>
											<a class="text">
												'.$value['back_info'].'
											</a>
											<div class="clear"></div>
										</li>
									');
								}

								echo '</ul>';
							}
						else {
							echo '
								<div class="message_block">
									<a class="title">Чат</a>
									<ul id="down_scroll" class="messages">
										<li class="system">Обговорите заказ и установите контакт (Системное сообщение)</li>';
							foreach (intable_search_items("SELECT * FROM `messages` WHERE `order_id`=".$_GET['order_id'], -1) as $value) {
								if($value['user_id'] == $_SESSION['user_info']['id']) echo '<li class="right">'.$value['text'].'</li>';
								else echo '<li class="left">'.$value['text'].'</li>';
							}
							echo '</ul>
									<div class="new_message">
										<form enctype="multipart/form-data" action="/?page=order&order_id='.$_GET['order_id'].'" method="POST">
											<input type="hidden" name="operation_type" value="new_message">
											<textarea name="text" placeholder="Текст сообщения" required ></textarea>
											<input type="file" name="file" accept="image/jpeg,image/png,image/gif">
											<button>Отправить</button>
										</form> 
									</div>
								</div>
								<a onclick="if(confirm(\'Завершить заказ?\')){window.location.href=\'/?del_order&order_id='.$_GET['order_id'].'\'}" class="close_order">Завершить заказ</a>
							';
						}

						if($_SESSION['user_info']['id'] != $temp['user_id'] && $settings['auth'] && $temp_time > 0)
							if(intable_count_items("SELECT `id` FROM `back_order` WHERE `user_id`=".$_SESSION['user_info']['id']." AND `order_id`=".$_GET['order_id']) == 0)
								echo('
									<div class="form">
										<a class="title">Оставьте отклик</a>
										<form action="/?page=order&order_id='.$_GET['order_id'].'" method="POST">
											<input type="hidden" name="operation_type" value="back_order" />
											<textarea name="message" placeholder="Сообщение для покупателя...(не менее 60 символов)" required></textarea>
											<input type="text" name="price" required placeholder="Предложите цену"></input>
											<button>Отправить</button>
										</form>
									</div>
								');
							else echo('
									<div class="timer_back">
										<div class="last_time"><a>Вы уже отправили отклик</a></div>
									</div>
								');
					?>
				</div>
<!--Контент-->
<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "search_user")
		if(isset($_POST['login_mail'])){
			$temp_user = intable_search_item("SELECT * FROM `user` WHERE `login`='".$_POST['login_mail']."' OR `mail`='".$_POST['login_mail']."'");

			if(strlen($temp_user['fio']) == 0){
				$exodus['type'] = "bad";
				$exodus['text'] = "Пользователь не найден";
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Укажите логин или почту";
		}

	require('exe.php');

	$temp = intable_search_items("SELECT * FROM `call_back`", -1);
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/admin_panel.css" rel="stylesheet" type="text/css">
				<link href="resourse/css/dark_wrap.css" rel="stylesheet" type="text/css">
				<script type="text/javascript" src="resourse/js/open_admin_panel.js"></script>
<!--Контент-->
				<div style="padding-bottom: 10px;" class="conteiner">
					<?php
						if($_SESSION['user_info']['user_type'] == 3){
							echo('
								<div class="user_conteiner">
									<div class="search_user">
										<a class="title_search">Поиск пользователя</a>
										<form action="/?page=admin_panel" method="POST">
											<input type="hidden" name="operation_type" value="search_user">
											<input type="text" name="login_mail" placeholder="Логин или почта" required>
											<button>Поиск</button>
										</form>
										<div class="clear"></div>
									</div>');
							if(strlen($temp_user['fio']) != 0){
								$info = "Информация обо мне.";
								if($temp_user['user_info'] != null) $info = $temp_user['user_info'];

								switch($temp_user['reputation']){
									case 3:
										$rep = "Отличная";
										break;

									case 2:
										$rep = "Хорошая";
										break;

									case 1:
										$rep = "Плохая";
										break;
								}

								switch($temp_user['user_type']){
									case 3:
										$cat = "Aдмин";
										break;

									case 2:
										$cat = "Модератор";
										break;

									case 1:
										$cat = "Продавец";
										break;

									case 0:
										$cat = "Покупатель";
										break;
								}
								echo('
										<div class="user">
											<div style="float: left;">
												<a class="user_name">'.$temp_user['fio'].'</a>
												<a class="more_info">'.$info.'</a>
												</div>
											<div class="info_more">
												<a class="rep">Репутация: '.$rep.'</a>
												<a class="op">Категория: '.$cat.'</a>
												<a class="ballance">Балланс: '.$temp_user['ballance'].' руб.</a>
											</div>
											<div class="clear"></div>
											<form class="change_info" action="/?page=admin_panel" method="POST">
												<input type="hidden" name="operation_type" value="change_info">
												<input type="hidden" name="user_id" value="'.$temp_user['id'].'">
												<input type="text" name="pass" placeholder="Смена пароля">
												<input type="text" name="mail" placeholder="Смена почты" value="'.$temp_user['mail'].'">
												<input type="text" name="login" placeholder="Смена логина"  value="'.$temp_user['login'].'">
												<select name="rep">
													<option value="0">Репутация</option>
													<option value="1">Плохая</option>
													<option value="2">Хорошая</option>
													<option value="3">Отличная</option>
												</select>
												<select name="op">
													<option value="0">Права</option>
													<option value="1">Покупатель</option>
													<option value="2">Продавец</option>
													<option value="3">Модератор</option>
													<option value="4">Администратор</option>
												</select>
												<input type="text" name="ballance" placeholder="Пополнить баланс">
												<button>Изменить</button>
											</form>
										</div>
									');
							}

							echo('		
								</div>
							');
						}
					?>
					<div class="call_backs">Заявки на обратные звонки (<?php echo count($temp); ?>)</div>
					<?php
						if(count($temp) > 0){
							echo '<div class="call_backs_cont"><ul class="call_backs_block">';

							foreach($temp as $value){
								$comment = "Комментария нет.";
								if(strlen($value['comment']) > 0) $comment = $value['comment'];
								echo('
									<li>
										<a class="delete" onclick="if(confirm(\'Подтвердите удаление\')){window.location.href=\'/?page=admin_panel&delete_back='.$value['id'].'\'}">Удалить</a>
										<a class="fio">'.$value['name'].' - '.$value['phone'].'</a>
										<a class="comment">'.$comment.'</a>
									</li>
								');
							}

							echo '</ul></div>';
						}

						$temp = intable_search_items("SELECT * FROM `new_reviewes`", -1);

						echo '<div class="reviewes" style="margin-top: 10px;">Новые отзывы ('.count($temp).')</div>';

						if(count($temp) > 0){
							echo '<div class="reviewes_cont"><ul class="reviewes_block">';

							foreach($temp as $value){
								$name = intable_search_item("SELECT `fio` FROM `user` WHERE `id`=".$value['user_id'])['fio'];
								echo('
									<li>
										<div class="buttons">
											<a onclick="if(confirm(\'Одобрить отзыв?\')){window.location.href=\'/?page=admin_panel&add_review='.$value['id'].'\'}" class="add_review">Одобрить</a>
											<a onclick="if(confirm(\'Подтвердите удаление\')){window.location.href=\'/?page=admin_panel&delete_review='.$value['id'].'\'}" class="ignore">Игнорировать</a>
										</div>
										<a class="fio">'.$name.' - '.$value['points'].'</a>
										<a class="comment">'.$value['text'].'</a>
									</li>
								');
							}

							echo '</ul></div>';
						}
					?>
				</div>
<!--Контент-->
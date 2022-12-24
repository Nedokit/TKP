<?php
	if(!$require_functions_allow){
		header('Location: /error');
		exit();
	}

//Деаунтитификация

	if($settings['auth'] && isset($_GET['logout'])){
		unset($_SESSION);
		session_destroy();
		$settings['auth'] = false;
	}

//Активация правил

	if($settings['auth'] && isset($_GET['accept'])){
		mysql_query("UPDATE `user` SET `rule_accept`=true WHERE `id`=".$_SESSION['user_info']['id']);
		$_SESSION['user_info'] = intable_search_item("SELECT * FROM `user` WHERE `id`=".$_SESSION['user_info']['id']);
	}

//Авторизация

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "login")
		if(isset($_POST['login'], $_POST['pass'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			if($temp_flag){
				$temp = intable_search_item("SELECT * FROM `user` WHERE `login`='".$_POST['login']."' OR `mail`='".$_POST['login']."'");
				if($temp['pass'] == md5($_POST['pass'].":pass")){
					session_start();

					$_SESSION['name'] = "user_loged";
					$_SESSION['user_info'] = $temp;

					header('Location: /');
				} else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Неправильный логин или пароль";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Вы ввели не все данные";
		}

//Регистрация

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "singup")
		if(isset($_POST['fio'], $_POST['login'], $_POST['mail'], $_POST['phone'], $_POST['pass'], $_POST['add_pass'], $_POST['user_type'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			if($temp_flag){
				if(!strripos($_POST['mail'], "@")){
					$exodus['type'] = "bad";
					$exodus['text'] = "Введите коректную почту";
				} else if($_POST['pass'] != $_POST['add_pass']){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пароли не совпадают";
				} else if(intable_count_items("SELECT `id` FROM `user` WHERE `mail`='".$_POST['mail']."'") != 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пользователь с такой почтой уже был зарегистрирован";
				} else if(intable_count_items("SELECT `id` FROM `user` WHERE `phone`='".$_POST['phone']."'") != 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пользователь с таким номером телефона уже был зарегистрирован";
				} else if(intable_count_items("SELECT `id` FROM `user` WHERE `login`='".$_POST['login']."'") != 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пользователь с логином уже был зарегистрирован";
				} else if(strlen($_POST['pass']) < 6){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пароли слишком короткий. Минимальная длина 6 символов";
				} else if(!ctype_digit($_POST['phone'])){
					$exodus['type'] = "bad";
					$exodus['text'] = "Невероный формат телефона";
				} else {
					$user_type = 0;
					if($_POST['user_type'] == "true") $user_type = 1;

					$pass = md5($_POST['pass'].":pass");

					mysql_query("INSERT INTO `user` (`fio`, `mail`, `phone`, `login`, `pass`, `user_type`) VALUES ('".$_POST['fio']."', '".$_POST['mail']."', '".$_POST['phone']."', '".$_POST['login']."', '".$pass."', ".$user_type.")");

					$temp = intable_search_item("SELECT * FROM `user` WHERE `login`='".$_POST['login']."'");

					if(count($temp) == 0){
						$exodus['type'] = "bad";
						$exodus['text'] = "Произошла ошибка. Сожалеем :(";
					} else {
						session_start();

						$_SESSION['name'] = "user_loged";
						$_SESSION['user_info'] = $temp;

						header('Location: /');
					}
				}
			} else {
				$exodus['type'] = "bad";
				$exodus['text'] = "Вы ввели неверные данные";
			}
		}

//Обратный звонок

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "call_back")
		if(isset($_POST['phone'], $_POST['name'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			if($temp_flag){
				if(intable_count_items("SELECT `id` FROM `call_back` WHERE `phone`='".$_POST['phone']."'") != 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Вы уже отправляли запрос. Ожидайте, мы вам перезвоним.";
				} else {
					mysql_query("INSERT INTO `call_back` (`name`, `phone`, `comment`) VALUES ('".$_POST['name']."', '".$_POST['phone']."', '".$_POST['comment']."')");
					$exodus['type'] = "good";
					$exodus['text'] = "Ваш запрос отправлен, мы вам перезвоним.";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Вы ввели неверные данные";
		}

//Изменение настроек

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "change_settings")
		if(isset($_POST['login'], $_POST['mail'], $_POST['phone'], $_POST['fio'])){
			$neces = array($_POST['login'], $_POST['mail'], $_POST['phone'], $_POST['fio']);

			$temp_flag = true;

			foreach($neces as $value)
				if(strlen($value) == 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Заполните все поля";
					$temp_flag = false;
					break;
				}

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Попытка взлома прервана";
					break;
				}

			if($temp_flag){
				if(!strripos($_POST['mail'], "@")){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Неверная почта";
				}
				if(intable_count_items("SELECT `id` FROM `user` WHERE `mail`='".$_POST['mail']."' AND `id`<>".$_SESSION['user_info']['id']) != 0){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Пользователь с такой почтой уже был зарегистрирован";
				}
			}

			if($temp_flag && intable_count_items("SELECT `id` FROM `user` WHERE `phone`='".$_POST['phone']."' AND `id`<>".$_SESSION['user_info']['id']) != 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Пользователь с таким номером телефона уже был зарегистрирован";
			}

			if($temp_flag && intable_count_items("SELECT `id` FROM `user` WHERE `login`='".$_POST['login']."' AND `id`<>".$_SESSION['user_info']['id']) != 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Пользователь с таким логином уже был зарегистрирован";
			}

			if($temp_flag){
				$pass = "`pass`";
				if(isset($_POST['pass'], $_POST['try_pass']) && strlen($_POST['pass']) > 0)
					if($_POST['pass'] == $_POST['try_pass'] && strlen($_POST['pass']) >= 6) {
						$pass = "'".md5($_POST['pass'].":pass")."'";
					} else {
						$exodus['type'] = "bad";
						$exodus['text'] = "Пароли не совпадают";
						$temp_flag = false;
					}
			}
			
			if($temp_flag){
				$user_info = "null";
				if(isset($_POST['user_info']) && strlen($_POST['user_info']) > 0) $user_info = "'".$_POST['user_info']."'";

				$profile_photo = "`profile_photo`";
				if(isset($_FILES['profile_photo']['name']) && strlen($_FILES['profile_photo']['name']) != 0){
					$temp_line = upload_file($_FILES['profile_photo'], 3 * 1024 * 1024, array("image/jpeg", "image/png", "image/gif"), $_SESSION['user_info']['id']);
					if($temp_line != null){
						$profile_photo = "'".$temp_line."'";
					} else {
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Что-то не так с картинкой";
					}
				}
			}

			if($temp_flag){
				if(mysql_query("UPDATE `user` SET `login`='".$_POST['login']."', `mail`='".$_POST['mail']."', `phone`='".$_POST['phone']."', `fio`='".$_POST['fio']."', `pass`=".$pass.", `user_info`=".$user_info.", `profile_photo`=".$profile_photo." WHERE `id`=".$_SESSION['user_info']['id'])){
					$_SESSION['user_info'] = intable_search_item("SELECT * FROM `user` WHERE `id`=".$_SESSION['user_info']['id']);
					$exodus['type'] = "good";
					$exodus['text'] = "Информация успешно сохранена";
				} else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Заполните все поля";
		}

//Новый заказ

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "new_order")
		if($_SESSION['user_info']['rule_accept'] == 1 && $_SESSION['user_info']['user_type'] == 0){
			if(isset($_POST['cat'], $_POST['towns'], $_POST['description'], $_POST['time'])){
				$temp_flag = true;

				foreach($_POST as $value)
					if(!require_filter($value)){
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Попытка взлома прервана";
						break;
					}

				$required = array($_POST['cat'], $_POST['towns'], $_POST['time']);

				foreach($required as $value)
					if($value == 0){
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Заполните все поля";
					}

				if($temp_flag && time() - intable_search_item("SELECT `time_last_move` FROM `user` WHERE `id`=".$_SESSION['user_info']['id'])['time_last_move'] < 60){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Подождите 60 секунд после последних изменений";
				}

				if($temp_flag && strlen($_POST['description']) < 60){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "В описании заказа должно быть больше 60 символов";
				}

				$file = "''";
				if($temp_flag)
					if(isset($_FILES['file']['name']) && strlen($_FILES['file']['name']) != 0){
						$temp_line = upload_file($_FILES['file'], 3 * 1024 * 1024, array("image/jpeg", "image/png", "image/gif"), $_SESSION['user_info']['id']);
						if($temp_line != null){
							$file = "'".$temp_line."'";
						} else {
							$temp_flag = false;
							$exodus['type'] = "bad";
							$exodus['text'] = "Что-то не так с файлом";
						}
					}

				if($temp_flag){
					switch ($_POST['time']) {
						case 1:
							$dop = 43200;
							break;

						case 2:
							$dop = 86400;
							break;

						case 3:
							$dop = 129600;
							break;

						case 4:
							$dop = 172800;
							break;

						case 5:
							$dop = 604800;
							break;

						case 6:
							$dop = 1209600;
							break;
					}
					$time_now = time();
					$time_end = time() + $dop;

					$date = date('d.m.Y в H:i');

					if(mysql_query("INSERT INTO `orders` (`categories`, `towns`, `date`, `description`, `set_time`, `out_time`, `user_id`, `file`) VALUES (".$_POST['cat'].", ".$_POST['towns'].", '".$date."', '".$_POST['description']."', ".$time_now.", ".$time_end.", ".$_SESSION['user_info']['id'].", ".$file.")")){
						$exodus['type'] = "good";
						$exodus['text'] = "Ваш заказ успешно добавлен";
						mysql_query("UPDATE `user` SET `time_last_move`=".time()." WHERE `id`=".$_SESSION['user_info']['id']);
					} else {
						$exodus['type'] = "bad";
						$exodus['text'] = "Что-то пошло не так";
					}
				}
			} else {
				$exodus['type'] = "bad";
				$exodus['text'] = "Не все данные указаны";
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Ошибка профиля";
		}

//Новый товар в магазин

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "new_shop")
		if($_SESSION['user_info']['rule_accept'] == 1 && $_SESSION['user_info']['user_type'] == 1){
			if(isset($_POST['item_name'], $_POST['cat'], $_POST['towns'], $_POST['description'], $_FILES['preview_photo'], $_FILES['photos'], $_POST['price'])){
				$temp_flag = true;

				foreach($_POST as $value)
					if(!require_filter($value)){
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Попытка взлома прервана";
						break;
					}

				$required = array($_POST['cat'], $_POST['towns']);

				foreach($required as $value)
					if($value == 0){
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Заполните все поля";
					}

				if($temp_flag && $_SESSION['user_info']['active'] != 1){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Ваш аккаунт ещё не активирован";
				}

				if($temp_flag && time() - intable_search_item("SELECT `time_last_move` FROM `user` WHERE `id`=".$_SESSION['user_info']['id'])['time_last_move'] < 60){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Подождите 60 секунд после последних изменений";
				}

				if($temp_flag && strlen($_POST['description']) < 60){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "В описании заказа должно быть больше 60 символов";
				}

				if($temp_flag && !ctype_digit($_POST['price'])){
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Поле 'цена товара' может содержать только число";
				}

				if($temp_flag)
					if(isset($_FILES['preview_photo']['name']) && strlen($_FILES['preview_photo']['name']) != 0){
						$temp_line = upload_file($_FILES['preview_photo'], 3 * 1024 * 1024, array("image/jpeg", "image/png", "image/gif"), $_SESSION['user_info']['id']);
						if($temp_line != null){
							$preview_photo = "'".$temp_line."'";
						} else {
							$temp_flag = false;
							$exodus['type'] = "bad";
							$exodus['text'] = "Что-то не так с фото-превью";
						}
					} else {
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Вы не прикрепили фото-превью";
					}

				if($temp_flag)
					if(count($_FILES['photos']['name']) != 0){
						$temp_line = upload_files($_FILES['photos'], 3 * 1024 * 1024, array("image/jpeg", "image/png", "image/gif"), $_SESSION['user_info']['id']);
						if($temp_line != null){
							$photos = "'".$temp_line."'";
						} else {
							$temp_flag = false;
							$exodus['type'] = "bad";
							$exodus['text'] = "Что-то не так с подробными фотографиями";
						}
					} else {
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Вы не прикрепили подробные фотографии";
					}

				if($temp_flag){
					$date = date('Размещено d.m.Y в H:i');

					if(echo("INSERT INTO `shop_items` (`item_name`, `price`, `preview_photo`, `photos`, `description`, `user_id`, `date`, `categories`, `towns`) VALUES ('".$_POST['item_name']."', ".$_POST['price'].", '".$preview_photo."', '".$photos."', '".$_POST['description']."', '".$date."', ".$_POST['cat'].", ".$_POST['towns'].")")){
						$exodus['type'] = "good";
						$exodus['text'] = "Ваш товар успешно добавлен";
						mysql_query("UPDATE `user` SET `time_last_move`=".time()." WHERE `id`=".$_SESSION['user_info']['id']);
					} else {
						$exodus['type'] = "bad";
						$exodus['text'] = "Что-то пошло не так";
					}
				}
			} else {
				$exodus['type'] = "bad";
				$exodus['text'] = "Не все данные указаны";
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Ошибка профиля";
		}
?>
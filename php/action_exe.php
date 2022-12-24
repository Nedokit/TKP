<?php
	if(!$require_functions_allow){
		header('Location: /error');
		exit();
	}

//Действия админа

	if(isset($_GET['page'], $_GET['delete_back']) && $_GET['page'] == "admin_panel" && require_filter($_GET['delete_back']))
		if(mysql_query("DELETE FROM `call_back` WHERE `id`=".$_GET['delete_back'])){
			$exodus['type'] = "good";
			$exodus['text'] = "Запрос был очищен";
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Что-то пошло не так :(";
		}
	
	if(isset($_GET['page'], $_GET['add_review']) && $_GET['page'] == "admin_panel" && require_filter($_GET['add_review'])){
		$temp = intable_search_item("SELECT * FROM `new_reviewes` WHERE `id`=".$_GET['add_review']);
		if(mysql_query("INSERT INTO `reviews`(`user_id`, `text`, `points`, `time`) VALUES (".$temp['user_id'].", '".$temp['text']."', ".$temp['points'].", ".$temp['time'].")") && mysql_query("DELETE FROM `new_reviewes` WHERE `id`=".$_GET['add_review'])){
			$exodus['type'] = "good";
			$exodus['text'] = "Отзыв был добавлен";
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Что-то пошло не так :(";
		}
	}

	if(isset($_GET['page'], $_GET['delete_review']) && $_GET['page'] == "admin_panel" && require_filter($_GET['delete_review'])){
		if(mysql_query("DELETE FROM `new_reviewes` WHERE `id`=".$_GET['add_review'])){
			$exodus['type'] = "good";
			$exodus['text'] = "Отзыв был очищен";
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Что-то пошло не так :(";
		}
	}

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "change_info"){
		$temp_flag = true;

		if(intable_count_items("SELECT `id` FROM `user` WHERE `login`='".$_POST['login']."'") > 0 && intable_search_item("SELECT `id` FROM `user` WHERE `login`='".$_POST['login']."'")['id'] != $_POST['user_id']){
			$temp_flag = false;
			$exodus['type'] = "bad";
			$exodus['text'] = "Такой логин уже занят";
		}

		if(intable_count_items("SELECT `id` FROM `user` WHERE `mail`='".$_POST['mail']."'") > 0 && intable_search_item("SELECT `id` FROM `user` WHERE `mail`='".$_POST['mail']."'")['id'] != $_POST['user_id']){
			$temp_flag = false;
			$exodus['type'] = "bad";
			$exodus['text'] = "Такая почта уже занята";
		}

		if($temp_flag){
			$pass = "`pass`";
			if(isset($_POST['pass']) && strlen($_POST['pass']) > 0) $pass = "'".md5($_POST['pass'].":pass")."'";

			$mail = "`mail`";
			if(isset($_POST['mail'])) $mail = "'".$_POST['mail']."'";

			$login = "`login`";
			if(isset($_POST['login'])) $login = "'".$_POST['login']."'";

			$rep = "`reputation`";
			if(isset($_POST['rep']) && $_POST['rep'] != 0) $rep = $_POST['rep'];

			$op = "`user_type`";
			if(isset($_POST['op']) && $_POST['op'] != 0) $op = ($_POST['op']-1);

			$ballance = "`ballance`";
			if(isset($_POST['ballance']) && $_POST['ballance'] != 0) $ballance = "`ballance`+".$_POST['ballance'];

			if(mysql_query("UPDATE `user` SET `pass`=".$pass.", `mail`=".$mail.", `login`=".$login.", `reputation`=".$rep.", `user_type`=".$op.", `ballance`=".$ballance." WHERE `id`=".$_POST['user_id'])){
				$exodus['type'] = "good";
				$exodus['text'] = "Информация успешно изменена";
			} else {
				$exodus['type'] = "bad";
				$exodus['text'] = "Что-то пошло не так :(";
			}
		}
	}


//Восстановление пароля

	if(isset($_POST['operation_type'], $_GET['type']) && $_POST['operation_type'] == "forget_message" && $_GET['type'] == "mail")
		if(isset($_POST['mail'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			$temp = intable_search_item("SELECT * FROM `user` WHERE `mail`='".$_POST['mail']."'");

			if($temp_flag && intable_count_items("SELECT * FROM `user` WHERE `mail`='".$_POST['mail']."'") == 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Неверная почта";
			}

			if(intable_count_items("SELECT `id` FROM `forget_pass` WHERE `user_id`=".$temp['id']) > 0){
				header('Location: /?page=forget&type=code');
				exit();
			}

			if($temp_flag){
				while(true){
				    $code = name_generate(8);
				    if(intable_count_items("SELECT `id` FROM `forget_pass` WHERE `hash`='".$code."'") == 0) break;
				}
				if(mysql_query("INSERT INTO `forget_pass`(`user_id`, `hash`, `time`) VALUES (".$temp['id'].", '".$code."', ".time().")") && mail($temp['mail'], "Восстановление пароля на сайте Mebel-Realto.ru", "Здравствуйте, ".$temp['fio'].", вы запросили оперцию по смене пароля на сайте Mebel-Realto.ru\n\nКод: ".$code."\n---\nС уважением, команда поддержки Mebel-Realto.ru\n\n(Сообщения приходит автоматически и не требует ответа)", "From: order@zuizberg.ru \r\n"."X-Mailer: PHP/".phpversion()))
					header('Location: /?page=forget&type=code');
				else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так :(";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Заполните все поля";
		}

	if(isset($_POST['operation_type'], $_GET['type']) && $_POST['operation_type'] == "forget_message" && $_GET['type'] == "code")
		if(isset($_POST['code'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			if($temp_flag && intable_count_items("SELECT `id` FROM `forget_pass` WHERE `hash`='".$_POST['code']."'") == 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Неверный код";
			}

			if($temp_flag){
				header('Location: /?page=forget&type=new_pass&code='.$_POST['code']);
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Заполните все поля";
		}

	if(isset($_POST['operation_type'], $_GET['type']) && $_POST['operation_type'] == "forget_message" && $_GET['type'] == "new_pass")
		if(isset($_GET['code'], $_POST['pass'], $_POST['try_pass'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			$temp = intable_search_item("SELECT `user_id` FROM `forget_pass` WHERE `hash`='".$_GET['code']."'");
			if($temp_flag && count($temp) == 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Неверный код";
			}

			if($temp_flag && strlen($_POST['pass']) < 6){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Длина пароля должна быть не менее 6 символов";
			}

			if($temp_flag && $_POST['pass'] != $_POST['try_pass']){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Пароли не совпадают";
			}

			if($temp_flag){
				$mail = intable_search_item("SELECT `mail` FROM `user` WHERE `id`=".$temp['user_id'])['mail'];
				if(mysql_query("UPDATE `user` SET `pass`='".md5($_POST['pass'].":pass")."' WHERE `id`=".$temp['user_id']) && mail($mail, "Восстановление пароля на сайте Mebel-Realto.ru", "Здравствуйте, ".intable_search_item("SELECT `fio` FROM `user` WHERE `id`=".$temp['user_id'])['fio'].", вы запросили оперцию по смене пароля на сайте Mebel-Realto.ru\n\nНовый пароль: ".$_POST['pass']."\n---\nС уважением, команда поддержки Mebel-Realto.ru\n\n(Сообщения приходит автоматически и не требует ответа)", "From: order@zuizberg.ru \r\n"."X-Mailer: PHP/".phpversion())){
					header('Location: /?page=auth');
					mysql_query("DELETE FROM `forget_pass` WHERE `hash`='".$_GET['code']."'");
				}
				else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так :(";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Заполните все поля";
		}

//Завершение заказа

	if(isset($_GET['del_order'], $_GET['order_id'])){
		$temp_flag = true;

		foreach($_POST as $value)
			if(!require_filter($value)){
				$temp_flag = false;
				break;
			}

		if($temp_flag && intable_count_items("SELECT `id` FROM `orders` WHERE `id`=".$_GET['order_id']." AND (`user_id`=".$_SESSION['user_info']['id']." OR `exe_id`=".$_SESSION['user_info']['id'].")") == 0){
			$temp_flag = false;
			$exodus['type'] = "bad";
			$exodus['text'] = "Произошла ошибка";
		}

		if($temp_flag){
			$temp = intable_search_item("SELECT * FROM `orders` WHERE `id`=".$_GET['order_id']." AND (`user_id`=".$_SESSION['user_info']['id']." OR `exe_id`=".$_SESSION['user_info']['id'].")");

			if(mysql_query("INSERT INTO `history_orders`(`id`, `categories`, `towns`, `date`, `description`, `set_time`, `out_time`, `user_id`, `exe_id`, `viewes`) VALUES (".$temp['id'].", ".$temp['categories'].", ".$temp['towns'].", '".$temp['date']."', '".$temp['description']."', ".$temp['set_time'].", ".$temp['out_time'].", ".$temp['user_id'].", ".$temp['exe_id'].", ".$temp['viewes'].")") && mysql_query("DELETE FROM `orders` WHERE `id`=".$temp['id']))
				header('Location: /');
			else {
				$exodus['type'] = "bad";
				$exodus['text'] = "Что-то пошло не так :(";
			}
		}
	}

//Отправка сообщения

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "new_message")
		if(isset($_POST['text'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			if($temp_flag && intable_count_items("SELECT `id` FROM `orders` WHERE `id`=".$_GET['order_id']." AND (`user_id`=".$_SESSION['user_info']['id']." OR `exe_id`=".$_SESSION['user_info']['id'].")") == 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Произошла ошибка";
			}

			$text = $_POST['text'];

			if($temp_flag && isset($_FILES['file']) && strlen($_FILES['file']['name']) > 0){
				$temp_line = upload_file($_FILES['file'], 3 * 1024 * 1024, array("image/jpeg", "image/png", "image/gif"), $_SESSION['user_info']['id']);
				if($temp_line != null){
					if(!in_array($_FILES['file']['type'], array("image/jpeg", "image/png", "image/gif")))
						$text = $text.'<br><a style="color: #FF0B85;" download href="'.$temp_line.'">[FILE]</a>';
					else $text = $text.'<br><img style="width: 100%; border-radius: 10px; margin: 10px 0;" src="'.$temp_line.'"/><br><a style="color: #FF0B85;" download href="'.$temp_line.'">[FILE]</a>';
				} else {
					$temp_flag = false;
					$exodus['type'] = "bad";
					$exodus['text'] = "Произошла ошибка при загрузке файла";
				}
			}

			if($temp_flag){
				if(mysql_query("INSERT INTO `messages`(`order_id`, `user_id`, `text`) VALUES (".$_GET['order_id'].", ".$_SESSION['user_info']['id'].", '".$text."')"))
					header('Location: /?page=order&order_id='.$_GET['order_id']);
				else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так :(";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Заполните все поля";
		}

//Выбор исполнителя

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "select_exe")
		if(isset($_POST['exe_id'], $_POST['order_id'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			if($temp_flag && intable_count_items("SELECT `id` FROM `orders` WHERE `id`=".$_POST['order_id']." AND `user_id`=".$_SESSION['user_info']['id']) == 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Вы не владелец заказа";
			}

			if($temp_flag){
				$exe_info = intable_search_item("SELECT `mail`, `fio` FROM `user` WHERE `id`=".$_POST['exe_id']);
				if(mysql_query("UPDATE `orders` SET `exe_id`=".$_POST['exe_id']." WHERE `id`=".$_POST['order_id']) && mysql_query("INSERT INTO `notifications`(`user_id`, `text`) VALUES (".$_POST['exe_id'].", '".intable_search_item("SELECT `select_note` FROM `base_settings`")['select_note']."')") && mail($exe_info['mail'], "Вас выбрали исполнителем на сайте Mebel-Realto.ru", "Здравствуйте, ".$exe_info['fio'].", вы были выбраны исполнителем на сайте Mebel-Realto.ru\nНачните чат с покупателем, чтобы обсудить заказ.\n---\nС уважением, команда поддержки Mebel-Realto.ru\n\n(Сообщения приходит автоматически и не требует ответа)", "From: order@zuizberg.ru \r\n"."X-Mailer: PHP/".phpversion())){
					$exodus['type'] = "good";
					$exodus['text'] = "Исполнитель выбран, ему придёт уведомление, чтобы начать с вами чат";
				} else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так :(";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Заполните все поля";
		}

//Добавление отклика

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "back_order")
		if(isset($_POST['message'], $_POST['price'])){
			$temp_flag = true;

			foreach($_POST as $value)
				if(!require_filter($value)){
					$temp_flag = false;
					break;
				}

			if($temp_flag && intable_search_item("SELECT `active` FROM `user` WHERE `id`=".$_SESSION['user_info']['id'])['active'] - time() < 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Ваш аккаунт ещё не активирован";
			}

			if($temp_flag && !ctype_digit($_POST['price'])){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Поле 'цена' должна содержать только цифры";
			}

			if($temp_flag && strlen($_POST['message']) < 60){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Сообщение покупателю должно содержать не менее 60 символов.";
			}

			if($temp_flag && intable_count_items("SELECT `id` FROM `back_order` WHERE `user_id`=".$_SESSION['user_info']['id']." AND `order_id`=".$_GET['order_id'])){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Вы уже отправили отклик";
			}

			if($temp_flag){
				if(mysql_query("INSERT INTO `back_order`(`order_id`, `user_id`, `price`, `back_info`) VALUES (".$_GET['order_id'].", ".$_SESSION['user_info']['id'].", ".$_POST['price'].", '".$_POST['message']."')")){
					$exodus['type'] = "good";
					$exodus['text'] = "Ваше сообщение отправлено. Если вы будете выбраны исполнителем, вам придёт сообщение.";
				} else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так :(";
				}
			}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Заполните все поля";
		}

//Продвижение обьявления

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "item_prod")
		if($_SESSION['user_info']['id'] == intable_search_item("SELECT `user_id` FROM `shop_items` WHERE `id`=".$_GET['item_id'])['user_id']){
			$price = split(";", intable_search_item("SELECT `shop_price` FROM `base_settings`")['shop_price'])[0];

			$temp_flag = true;

			if(intable_search_item("SELECT `adv` FROM `shop_items` WHERE `id`=".$_GET['item_id'])['adv']){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Ваше обьявление уже было поднято. Дождитесь окончания действия.";
			}

			if($temp_flag && $_SESSION['user_info']['ballance'] < $price){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Недостаточно средств. Не хватает - ".($price - $_SESSION['user_info']['ballance']);
			}

			if($temp_flag){
				if(mysql_query("UPDATE `user` SET `ballance`=`ballance`-".$price." WHERE `id`=".$_SESSION['user_info']['id']) && mysql_query("UPDATE `shop_items` SET `adv_time`=".(time()+604800)." WHERE `id`=".$_GET['item_id']) && mysql_query("UPDATE `shop_items` SET `adv`=1 WHERE `id`=".$_GET['item_id'])){
					$exodus['type'] = "good";
					$exodus['text'] = "Ваше обьявление успешно поднято!";
				} else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так :(";
				}
			}
		}

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "item_up")
		if($_SESSION['user_info']['id'] == intable_search_item("SELECT `user_id` FROM `shop_items` WHERE `id`=".$_GET['item_id'])['user_id']){
			$price = split(";", intable_search_item("SELECT `shop_price` FROM `base_settings`")['shop_price'])[1];

			if($_SESSION['user_info']['ballance'] >= $price){
				if(mysql_query("UPDATE `user` SET `ballance`=`ballance`-".$price." WHERE `id`=".$_SESSION['user_info']['id']) && mysql_query("UPDATE `shop_items` SET `time`=".time()." WHERE `id`=".$_GET['item_id'])){
					$exodus['type'] = "good";
					$exodus['text'] = "Ваше обьявление успешно поднято!";
				} else {
					$exodus['type'] = "bad";
					$exodus['text'] = "Что-то пошло не так :(";
				}
			} else {
				$exodus['type'] = "bad";
				$exodus['text'] = "Недостаточно средств. Не хватает - ".($price - $_SESSION['user_info']['ballance']);
			}
		}

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "item_del")
		if($_SESSION['user_info']['id'] == intable_search_item("SELECT `user_id` FROM `shop_items` WHERE `id`=".$_GET['item_id'])['user_id'])
			if(mysql_query("DELETE FROM `shop_items` WHERE `id`=".$_GET['item_id'])){
				header('Location: /');
				exit();
			}
			else {
				$exodus['type'] = "bad";
				$exodus['text'] = "Что-то пошло не так :(";
			}

//Ошибки

	if(isset($_GET['page'], $_GET['item_id']) && $_GET['page'] == "item" && intable_count_items("SELECT `id` FROM `shop_items` WHERE `id`=".$_GET['item_id']) == 0){
		header('Location: /error');
		exit();
	}

	if(isset($_GET['page'], $_GET['order_id']) && $_GET['page'] == "order" && intable_count_items("SELECT `id` FROM `orders` WHERE `id`=".$_GET['order_id']) == 0){
		header('Location: /error');
		exit();
	}

	if(isset($_GET['page'], $_GET['order_id']) && $_GET['page'] == "history_order" && intable_count_items("SELECT `id` FROM `history_orders` WHERE `id`=".$_GET['order_id']) == 0){
		header('Location: /error');
		exit();
	}

	if(isset($_GET['page'], $_GET['type']) && $_GET['page'] == "forget" && !in_array($_GET['type'], array("mail", "code", "new_pass"))){
		header('Location: /error');
		exit();
	}

	if(isset($_GET['page'], $_SESSION['user_info']['user_type']) && $_GET['page'] == "admin_panel" && $_SESSION['user_info']['user_type'] < 2){
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
				} else if(intable_count_items("SELECT `id` FROM `user` WHERE `mail`='".mb_strtolower($_POST['mail'])."'") != 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пользователь с такой почтой уже был зарегистрирован";
				} else if(intable_count_items("SELECT `id` FROM `user` WHERE `phone`='".$_POST['phone']."'") != 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пользователь с таким номером телефона уже был зарегистрирован";
				} else if(intable_count_items("SELECT `id` FROM `user` WHERE `login`='".mb_strtolower($_POST['login'])."'") != 0){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пользователь с логином уже был зарегистрирован";
				} else if(strlen($_POST['pass']) < 6){
					$exodus['type'] = "bad";
					$exodus['text'] = "Пароли слишком короткий. Минимальная длина 6 символов";
				} else {
					$user_type = 0;
					if($_POST['user_type'] == "true") $user_type = 1;

					$pass = md5($_POST['pass'].":pass");

					if(mysql_query("INSERT INTO `user` (`fio`, `mail`, `phone`, `login`, `pass`, `user_type`) VALUES ('".$_POST['fio']."', '".$_POST['mail']."', '".$_POST['phone']."', '".$_POST['login']."', '".$pass."', ".$user_type.")") /* && mail($_POST['mail'], "Регистрация на сайте Mebel-Realto.ru", "Здравствуйте, ".$_POST['fio'].", вы были успешно зарегистрированы на сайте Mebel-Realto.ru\nДанные для входа:\nЛогин: ".$_POST['login']."\nПароль: ".$_POST['pass']."\n---\nС уважением, команда поддержки Mebel-Realto.ru\n\n(Сообщения приходит автоматически и не требует ответа)", "From: order@zuizberg.ru \r\n"."X-Mailer: PHP/".phpversion()) */){
						session_start();

						$temp = intable_search_item("SELECT * FROM `user` WHERE `login`='".$_POST['login']."'");

						$_SESSION['name'] = "user_loged";
						$_SESSION['user_info'] = $temp;

						header('Location: /');
					} else {
						$exodus['type'] = "bad";
						$exodus['text'] = "Произошла ошибка. Сожалеем :(";
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
					$admin_mail = intable_search_item("SELECT `admin_mail` FROM `base_settings`")['admin_mail'];
					if(mysql_query("INSERT INTO `call_back` (`name`, `phone`, `comment`) VALUES ('".$_POST['name']."', '".$_POST['phone']."', '".$_POST['comment']."')") && mail($admin_mail, "Новая заявка", "Поступила новая заявка обратной связи.\nЗагляните в личный кабинет.\n---\nС уважением, команда поддержки Mebel-Realto.ru\n\n(Сообщения приходит автоматически и не требует ответа)", "From: order@zuizberg.ru \r\n"."X-Mailer: PHP/".phpversion())){
						$exodus['type'] = "good";
						$exodus['text'] = "Ваш запрос отправлен, мы вам перезвоним.";
					} else {
						$exodus['type'] = "bad";
						$exodus['text'] = "Что-то пошло не так :(";
					}
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
				if(intable_count_items("SELECT `id` FROM `user` WHERE `mail`='".mb_strtolower($_POST['mail'])."' AND `id`<>".$_SESSION['user_info']['id']) != 0){
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

			if($temp_flag && intable_count_items("SELECT `id` FROM `user` WHERE `login`='".mb_strtolower($_POST['login'])."' AND `id`<>".$_SESSION['user_info']['id']) != 0){
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
						if($_SESSION['user_info']['profile_photo'] != null) unlink($_SESSION['user_info']['profile_photo']);
					} else {
						$temp_flag = false;
						$exodus['type'] = "bad";
						$exodus['text'] = "Что-то не так с картинкой";
					}
				}
			}

			if($temp_flag){
				$last_mail = intable_search_item("SELECT `mail` FROM `user` WHERE `id`=".$_SESSION['user_info']['id'])['mail'];
				if(mysql_query("UPDATE `user` SET `login`='".$_POST['login']."', `mail`='".$_POST['mail']."', `phone`='".$_POST['phone']."', `fio`='".$_POST['fio']."', `pass`=".$pass.", `user_info`=".$user_info.", `profile_photo`=".$profile_photo." WHERE `id`=".$_SESSION['user_info']['id']) && mail($last_mail, " Смена почты на сайте Mebel-Realto.ru", "Здравствуйте, ".$_POST['fio'].", ваши настройки были успешно изменены.\nНовая почта: ".$_POST['mail']."\n---\nС уважением, команда поддержки Mebel-Realto.ru\n\n(Сообщения приходит автоматически и не требует ответа)", "From: order@zuizberg.ru \r\n"."X-Mailer: PHP/".phpversion())){
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

				if($temp_flag && $_SESSION['user_info']['active'] == 0){
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

					if(mysql_query("INSERT INTO `shop_items` (`item_name`, `price`, `preview_photo`, `photos`, `description`, `user_id`, `date`, `categories`, `towns`, `time`) VALUES ('".$_POST['item_name']."', ".$_POST['price'].", ".$preview_photo.", ".$photos.", '".$_POST['description']."', ".$_SESSION['user_info']['id'].", '".$date."', ".$_POST['cat'].", ".$_POST['towns'].", ".time().")")){
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

//Активация аккаунта

	if(isset($_POST['operation_type']) && $_POST['operation_type'] == "activate_account")
		if(isset($_POST['time_activate']) && $_POST['time_activate'] != 0){
			$temp_flag = true;

			if(!require_filter($_POST['time_activate'])){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Попытка влома прервана";
			}

			if($temp_flag && $_SESSION['user_info']['active'] - time() > 0){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Ваш аккаунт уже активирован";
			}

			$temp_price = split("/", split(";", intable_search_item("SELECT `price_list` FROM `base_settings`")['price_list'])[$_POST['time_activate']-1]);
			$time_activate = time() + $temp_price[2];
			$price = $temp_price[1];

			if($temp_flag && $_SESSION['user_info']['ballance'] < $price){
				$temp_flag = false;
				$exodus['type'] = "bad";
				$exodus['text'] = "Недостаточно средств. Не хватает - ".($price - $_SESSION['user_info']['ballance'])." руб.";
			}

			if($temp_flag)
				if(mysql_query("UPDATE `user` SET `active`=".$time_activate.", `ballance`=`ballance`-".$price." WHERE `id`=".$_SESSION['user_info']['id'])){
					$exodus['type'] = "good";
					$exodus['text'] = "Аккаунт успешно активирован";
					$_SESSION['user_info'] = intable_search_item("SELECT * FROM `user` WHERE `id`=".$_SESSION['user_info']['id']);
				} else {
					$exodus['type'] = "good";
					$exodus['text'] = "Что-то пошло не так";
				}
		} else {
			$exodus['type'] = "bad";
			$exodus['text'] = "Укажите период активации";
		}

?>
<?php
	if(!$require_functions_allow){
		header('Location: /error');
		exit();
	}

	if(!$settings['auth'])
		$settings['menu'] = array(
			["main" ,"Главная", "/", 0],
			["shop", "Магазин", "/?page=shop", 0],
			["garant", "Гарантии", "/?page=garant", 0],
			["constructor", "3D Конструктор", "/?page=constructor", 0]
		);
	else 
		$settings['menu'] = array(
			["main" ,"Кабинет", "/", 0],
			["shop" ,"Магазин", "/?page=shop", 0],
			["orders" ,"Все заказы", "/?page=orders", 0],
			["constructor", "3D Конструктор", "/?page=constructor", 0],
			["admin_panel", "Админ-панель", "/?page=admin_panel", 3]
		);

	switch ($page) {
		case 'main':
			$settings['page_name'] = "Mebel-Realto - Единая мебельная биржа";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'shop':
			$settings['page_name'] = "Mebel-Realto - Магазин";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'item':
			if(isset($_GET['page']) && isset($_GET['item_id']) && $_GET['page'] == "item")
				$item_name = intable_search_item("SELECT `item_name` FROM `shop_items` WHERE `id`=".$_GET['item_id'])['item_name'];
			$settings['page_name'] = "Mebel-Realto - ".$item_name;
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'garant':
			$settings['page_name'] = "Mebel-Realto - Гарантии";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'constructor':
			$settings['page_name'] = "Mebel-Realto - 3D Конструктор";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'rules':
			$settings['page_name'] = "Mebel-Realto - Правила сайта";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'reviewes':
			$settings['page_name'] = "Mebel-Realto - Отзывы";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'orders':
			$settings['page_name'] = "Mebel-Realto - Все заказы";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'order':
			$settings['page_name'] = "Mebel-Realto - Все заказы";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'history_order':
			$settings['page_name'] = "Mebel-Realto - Все заказы";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth'];
			break;

		case 'admin_panel':
			$settings['page_name'] = "Mebel-Realto - Админ-панель";
			$settings['page_hud'] = true;
			$settings['auth_type'] = true;
			break;

		case 'forget':
			$settings['page_name'] = "Mebel-Realto - Восстановление пароля";
			$settings['page_hud'] = false;
			$settings['auth_type'] = false;
			break;

		case 'auth':
			$settings['page_name'] = "Mebel-Realto - Авторизация";
			$settings['page_hud'] = false;
			$settings['auth_type'] = false;
			break;

		case 'singup':
			$settings['page_name'] = "Mebel-Realto - Регистрация";
			$settings['page_hud'] = false;
			$settings['auth_type'] = false;
			break;

		case 'error':
			$settings['page_name'] = "Кажется, произошла ошибка";
			$settings['page_hud'] = true;
			$settings['auth_type'] = $settings['auth']; //если не важна авторизация
			break;
	}
?>
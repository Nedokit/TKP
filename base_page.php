<?php
	if(!$require_page_allow || ($settings['auth'] != $settings['auth_type'])){
		header('Location: /error');
		exit();
	}

	require("php/action_exe.php");

	$temp = $settings['menu'];
	for($i = 0; $i < count($temp); $i++)
		if($_SESSION['user_info']['user_type'] >= $temp[$i][3]) {
			$menu = $menu.'<a href="'.$temp[$i][2].'"><li';
			if($page == $temp[$i][0])
				$menu = $menu.' id="checked"';
			$menu = $menu.'>'.$temp[$i][1].'</li></a>';
		}

	if($settings['page_hud'])
		if(!$settings['auth']){
			$top_head_buttons = '
				<a href="/?page=singup" class="reg_but">Регистрация</a>
				<a href="/?page=auth" class="log_but"><img src="resourse/img/login.png"/>Войти</a>
			';
		} else {
			$top_head_buttons = '
				<a href="/?logout" class="log_but">Выйти<img src="resourse/img/login.png"/></a>
				<a style="margin-right: 30px;" class="reg_but">'.$_SESSION['user_info']['fio'].', добро пожаловать!</a>
			';
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $settings['page_name']; ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=0, maximum-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<!--Включить сюда PHP-->
		<meta name="description" content="<?php echo $settings['description']; ?>">
		<meta name="Keywords" content="<?php echo $settings['keywords']; ?>">
		<!--Включить сюда PHP-->
		
		<!--Временно-->
		<meta http-equiv="Cache-Control" content="no-cache">
		<!--Временно-->
		
		<!--Библиотеки и настройки-->
		<link href="resourse/css/pre_loader.css" rel="stylesheet" type="text/css">
		<link href="resourse/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link href="resourse/css/settings.css" rel="stylesheet" type="text/css">
		<link href="resourse/css/base_elements.css" rel="stylesheet" type="text/css">
		<link href="resourse/css/fonts.css" rel="stylesheet" type="text/css">
		<link href="resourse/css/scrollBar.css" rel="stylesheet" type="text/css">
		<!--Библиотеки и настройки-->
	</head>
	<body>
		<div class="wrap" style="background: url(resourse/img/background.png);">
			<!--Скрипты-->
			<script type="text/javascript" src="resourse/js/jquery.js"></script>
			<link href="resourse/css/animate.css" rel="stylesheet" type="text/css">
			<!--Прелоэдер-->
			<script type="text/javascript" src="resourse/js/preloader.js"></script>
			<div class="pre_wrap">
				<div class="pre_cube c1"></div>
				<div class="pre_cube c2"></div>
			</div>
			<?php
				if($settings['page_hud']) echo('
					<div class="head">
						<div class="top_head">
							<div class="conteiner">
								<a class="contacts"><img src="resourse/img/phone.png"/>'.$settings['contact_phone'].'</a>
								'.$top_head_buttons.'
								<div class="clear"></div>
							</div>
						</div>
						<div class="bottom_head">
							<div class="conteiner">
								<a href="/"><img src="resourse/img/logo.png"/></a>
								<a href="/" class="logo">Mebel-Rialto</a>
								<ul class="menu">
									'.$menu.'
								</ul>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				');

				echo('<div id="content_conteiner" class="content_conteiner">');

				$temp = intable_search_items("SELECT * FROM `notifications` WHERE `user_id`=".$_SESSION['user_info']['id'], -1);
				if(count($temp) != 0){
					echo '
						<link rel="stylesheet" type="text/css" href="resourse/css/dark_wrap.css">
						<div class="dark_wrap">
							<div class="conteiner active">
								<div style="width: 80%;" class="info_block_wrap active">
									<a class="close_wrap" onclick="$(\'.dark_wrap\').fadeOut(300);">закрыть <b>x</b></a>
									<a class="title">Новые уведомления</a>';
									foreach ($temp as $value) {
										echo $value['text'].'<br><br>';
										mysql_query("DELETE FROM `notifications` WHERE `id`=".$value['id']);
									}
									echo '</div>
							</div>
						</div>
					';
				}

				if($settings['auth'] && $_SESSION['user_info']['rule_accept'] == 0) echo '
					<link rel="stylesheet" type="text/css" href="resourse/css/dark_wrap.css">
					<div class="dark_wrap">
						<div class="conteiner active">
							<div style="width: 80%;" class="info_block_wrap active">
								<a class="title">Пользовательское соглашение</a>
								'.intable_search_item("SELECT `rules` FROM `base_settings`")['rules'].'
								<div style="width: 100%; text-align: center;">
									<a href="/?accept" style="
										display: inline-block;
										padding: 15px 20px;
										border-radius: 10px;
										background-color: #00A2DA;
										box-shadow: 1px 1px 2px 0 #333;
										margin: auto;
										color: #FFF;
										font-family: AgoraSansProBold;
										cursor: pointer;
										margin-top: 20px;
									" class="button">Принять</a>
								</div>
							</div>
							<script type="text/javascript">
								$(document).ready(function() {
									$(".info_block_wrap").css("margin-top", (document.getElementsByClassName("conteiner active")[0].offsetHeight - document.getElementsByClassName("info_block_wrap active")[0].offsetHeight)/2 + 100);
								});
								$(window).resize(function() {
									$(".info_block_wrap").css("margin-top", (document.getElementsByClassName("conteiner active")[0].offsetHeight - document.getElementsByClassName("info_block_wrap active")[0].offsetHeight)/2 + 100);
								});
							</script>
						</div>
					</div>
				';

			 	require($page.".php");

			 	echo('</div>');

			 	if($settings['page_hud']) echo('
					<div class="footer">
						<div class="top_footer">
							<div class="conteiner">
								<div class="line">
									<img src="resourse/img/logo.png"/>
									<a class="text">
										Mebel-Realto - уникальный сервис, обеспечивающий заказчику прямой контакт с производителями и поставщиками мебели. Принцип "мебельной биржи" - это наиболее эффективный способ найти мебель онлайн напрямую от производителя без розничной наценки.
									</a>
									<div class="foot_contacts">
										<a class="phone">'.$settings['contact_phone'].'</a>
										<a class="mail">'.$settings['contact_mail'].'</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="columns_block">
									<div id="social" class="column">
										<a class="title">Мы в соцсетях</a>
										<ul>
											<a href="'.$settings['soc_1'].'"><li><img src="resourse/img/vk.png"/></li></a>
											<a href="'.$settings['soc_2'].'"><li><img src="resourse/img/gmail.png"/></li></a>
											<a href="'.$settings['soc_3'].'"><li><img src="resourse/img/facebook.png"/></li></a>
											<a style="padding-top: 55px; display: block;" href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/16.png"></a>
										</ul>
									</div>
									<div class="column">
										<a class="title">Продавцу</a>
										<ul>
											<a href="/?page=singup"><li>Регистрация</li></a>
											<a href="/?page=auth"><li>Авторизация</li></a>
											<a href="/?page=rules"><li>Правила</li></a>
										</ul>
									</div>
									<div class="column">
										<a class="title">Покупателю</a>
										<ul>
											<a href="/?page=shop"><li>Магазин</li></a>
											<a href="/?page=constructor"><li>3D конструкторы</li></a>
											<a href="/?page=shop"><li>Мебель</li></a>
											<a href="/?page=auth"><li>Свободная заявка</li></a>
											<a href="/?page=garant"><li>Сервис</li></a>
											<a href="/?page=rules"><li>Правила</li></a>
										</ul>
									</div>
									<div class="column">
										<a class="title">О сайте</a>
										<ul>
											<a href="/"><li>Главная страница</li></a>
											<a href="/"><li>Как это работает</li></a>
											<a href="/?page=garant"><li>Безопасность</li></a>
											<a href="/?page=rules"><li>Правила оплаты</li></a>
											<a href="/"><li>Контакты</li></a>
											<a href="/?page=reviewes"><li>Отзывы</li></a>
										</ul>
									</div>
									<div class="column" style="padding-right: 0;">
										<a class="title">Личный кабинет</a>
										<ul>
											<a href="/?page=singup"><li>Регистрация</li></a>
											<a href="/?page=auth"><li>Авторизация</li></a>
										</ul>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						<div class="bottom_footer">
							<div class="conteiner">
								<div class="copyright">All rights reserved - Mebel-Realto.ru © 2022</div>
							</div>
						</div>
					</div>
				');
			 ?>
		</div>
	</body>
</html>
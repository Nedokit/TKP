<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}

	require("exe.php");
?>
<!--PAGE-->
<!--Большие скрипты и стили-->
				<link href="resourse/css/lending.css" rel="stylesheet" type="text/css">
				<script type="text/javascript" src="resourse/js/vertical_slider.js"></script>
<!--Контент-->
				<div  class="full_block">
					<div class="conteiner">
						<h1 class="slogan">Мебельная биржа</h1>
						<a href="/?page=singup" class="login_button">Попробовать</a>
						<div class="clear"></div>
					</div>
				</div>
				<div class="conteiner">
					<div class="cont_block">
						<h2 class="title">Мы обьединяем Покупателей и Производителей мебели!</h2>
						<h3 class="text">Заполните простую форму заявки, выберите производителя и сэкономьте до 40%!</h3>
						<h4 class="text">Или пройдите регистрацию и подберите своего клиента.</h4>
						<div class="buttons_block">
							<a href="/?page=singup&type=false">
								<div class="button" id="b1">
									<div class="b_text">Хочу заказать</div>
								</div>
							</a>
							<a href="/?page=singup&type=true">
								<div class="button" id="b2">
									<div class="b_text">Готов изготовить</div>
								</div>
							</a>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<div class="full_block">
					<div class="conteiner">
						<div class="half" style="border-right: 1px solid #BBB"  id="items_left">
							<script>$(window).load(function (){vertical_slider("left");});</script>
							<div class="title" style="margin-right: 15%;">Последние заявки<span><a href="/?page=orders">все заявки</a></span></div>
							<div class="slider_button" id="up" style="margin-right: 15%;">
								<div class="into_button"></div>
							</div>
							<div class="slider_block" style="margin-right: 15%;">
								<ul class="mini_items">
									<?php
										$temp = intable_search_items("SELECT * FROM `orders` WHERE `out_time`-".time().">0 ORDER BY `orders`.`id` DESC", 10);
										for($i = 0; $i < count($temp); $i++){
											$user_info = intable_search_item("SELECT `fio`, `profile_photo` FROM `user` WHERE `id`=".$temp[$i]['user_id']);
											$logo = "/uploads/none.jpg";
											if($user_info['profile_photo'] != null) $logo = $user_info['profile_photo'];
											echo('
												<li>
													<img src="'.$logo.'"/>
													<a class="text"><b>'.$user_info['fio'].'</b><br><br>Хочет заказать "'.split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories'])[$temp[$i]['categories'] - 1].'".<br><br>'.$temp[$i]['date'].'</a>
													<a href="/?page=order&order_id='.$temp[$i]['id'].'" class="more_info">Более подробно...</a>
													<div class="clear"></div>
												</li>
											');
										}

										for($i = 0; $i < (3 - count($temp)); $i++)
											echo('
												<li style="text-align: center;"><a style="line-height: 100%; font-weight: bold; color: #333; margin-top: 45px; display: inline-block;">Активного заказа пока нет.</a></li>
											');
									?>
								</ul>
							</div>
							<div class="slider_button" id="down" style="margin-right: 15%;">
								<div class="into_button"></div>
							</div>
						</div>
						<div class="half" id="items_right">
							<script>$(window).load(function (){vertical_slider("right");});</script>
							<div class="title" style="margin-left: 15%;">Магазин<span><a href="/?page=shop">перейти в магазин</a></span></div>
							<div class="slider_button" id="up" style="margin-left: 15%;">
								<div class="into_button"></div>
							</div>
							<div class="slider_block" style="margin-left: 15%;">
								<ul class="mini_items">
									<?php
										$temp = intable_search_items("SELECT * FROM `shop_items` ORDER BY `shop_items`.`id` DESC", 10);
										for($i = 0; $i < count($temp); $i++)
											echo('
												<li>
													<img src="'.$temp[$i]['preview_photo'].'"/>
													<a class="text"><b>'.split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories'])[$temp[$i]['categories']-1].'</b><br><br>'.number_format($temp[$i]['price'], 0, ',', ' ').' руб.</a>
													<a href="/?page=item&item_id='.$temp[$i]['id'].'" class="more_info">Посмотреть</a>
													<div class="clear"></div>
												</li>
											');

										for($i = 0; $i < (3 - count($temp)); $i++)
											echo('
												<li style="text-align: center;"><a style="line-height: 100%; font-weight: bold; color: #333; margin-top: 45px; display: inline-block;">Товара пока нет.</a></li>
											');
									?>
							</div>
							<div class="slider_button" id="down" style="margin-left: 15%;">
								<div class="into_button"></div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="conteiner">
					<div class="cont_block">
						<h5 class="title">С нами надёжно и Безопасно!</h5>
						<a class="text"><p>Мы берём на себя полную ответственность за сделку, которую Покупатель заключает с Производителем мебели.</p><p>Если по какой-то причине Покупатель не получит заказанную мебель, то мы вернём Вам полную сумму предоплаты, а так же предоставим Вам другого Производителя, который сделает мебель на 10% дешевле от договорённой стоимости.</p></a>
						<a class="text">
							<img src="resourse/img/left_foto.png"/>
							<img src="resourse/img/middle_foto.png"/>
						</a>
					</div>
				</div>
				<div class="full_block">
					<div class="conteiner">
						<a class="title_block">Как это работает?</a>
						<div id="right" class="about_text">
							<img src="resourse/img/kakpab1.png"/>
						</div>
						<div id="left" class="about_text">
							<img src="resourse/img/kakpab2.png"/>
						</div>
						<div id="right" class="about_text">
							<img src="resourse/img/kakpab3.png"/>
						</div>
						<div class="frame">
							<div class="right">
								<iframe style="opacity: 1;" src="https://www.youtube.com/embed/FC3WIxjiqnI?rel=0" frameborder="0" allowfullscreen="y"></iframe>
							</div>
							<div class="left">
								<a class="title">Закажите обратный звонок</a>
								<form action="/" method="POST">
									<input style="width: 48%; float: left; margin-right: 4%;" type="text" name="name" placeholder="Ваше имя" required />
									<input style="width: 48%; float: left;" class="half_input" type="text" name="phone" placeholder="Телефон*" required />
									<input type="hidden" name="operation_type" value="call_back"/>
									<div class="clear"></div>
									<textarea style="width: 100%;"type="text" name="comment" placeholder="Комментарий"></textarea>
									<button>Отправить</button>
								</form>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<div class="comments">
					<div class="conteiner">
						<div class="title">Отзывы о нашей бирже <span><a href="/?page=reviewes">больше отзывов</a></span></div>
						<ul class="com_block">
							<?php
								$temp = intable_search_items("SELECT * FROM `reviews` ORDER BY `reviews`.`time` DESC", 3);
								for($i = 0; $i < count($temp); $i++){
									$user_info = intable_search_item("SELECT * FROM `user` WHERE `id`=".$temp[$i]['user_id']);
									$logo = $user_info['profile_photo'];
									if($logo == null) $logo = "/uploads/none.jpg";
									echo('
										<li>
											<img class="logo" src="'.$logo.'"/>
											<a class="com_name">'.$user_info['fio'].'</a>
											<a class="com_text">
												'.$temp[$i]['text'].'
											</a>
											<div class="clear"></div>
											<div class="stars"><img style="background-position: -'.((5 - $temp[$i]['points']) * 36).'px, top;" src="resourse/img/stars.png"/>('.$temp[$i]['points'].')</div>
										</li>
									');
								}
								for($i = 0; $i < (3 - count($temp)); $i++)
								echo('
									<li>
										<img class="logo" src="/uploads/none.jpg"/>
										<a class="com_name">Отзыва пока нет</a>
										<div class="clear"></div>
										<div class="stars"><img style="background-position: -180px, top;" src="resourse/img/stars.png"/>(0.0)</div>
									</li>
								');
							?>
						</ul>
					</div>
				</div>
<!--Контент-->
<!--PAGE-->
<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}

	require('exe.php');
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/cabinet.css" rel="stylesheet" type="text/css">
				<link href="resourse/css/dark_wrap.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<script>$(document).ready(function (){$('#transaction').hide();$('#reduct').hide();$('#new_order').hide();$('#new_shop').hide();$('#activate_block').hide()});</script>
				<div id="transaction" class="dark_wrap">
					<div class="conteiner active">
						<div class="info_block_wrap active" style="margin: auto; width: 60%;">
							<a class="close_wrap" onclick="$('.dark_wrap').fadeOut(300);">закрыть <b>x</b></a>
							<a class="title">Пополнение баланса</a>
							<form style="text-align: center;" action="/transaction.php" method="GET">
								<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_info']['id']; ?>">
								<a style="display: inline-block; width: 300px;" class="input">
									<input style="width: 150px; margin-right: 5px;" type="text" name="value" placeholder="Сумма"> руб.
								</a><br>
								<button>Пополнить</button>
							</form>
						</div>
					</div>
				</div>
				<div id="reduct" class="dark_wrap">
					<div class="conteiner active">
						<div class="info_block_wrap active">
							<a class="close_wrap" onclick="$('.dark_wrap').fadeOut(300);">закрыть <b>x</b></a>
							<a class="title">Настройки профиля</a>
							<form enctype="multipart/form-data" action="/" method="POST">
								<input type="hidden" name="operation_type" value="change_settings">
								<a class="share_form">Основные настройки</a>
								<p>Сменить логин<br><input type="text" name="login" value="<?php echo $_SESSION['user_info']['login']; ?>" required></p>
								<p>Сменить почту<br><input type="text" name="mail" value="<?php echo $_SESSION['user_info']['mail']; ?>" required></p>
								<p>Сменить пароль<br><input type="password" name="pass" placeholder="*******"></p>
								<p>Повторите пароль<br><input type="password" name="try_pass" placeholder="*******"></p>
								<p>Сменить телефон<br><input type="text" name="phone" value="<?php echo $_SESSION['user_info']['phone']; ?>" required></p>
								<div class="clear"></div>

								<a class="share_form">Настройки профиля</a>
								<p>Изменить имя<br><input type="text" name="fio" value="<?php echo $_SESSION['user_info']['fio']; ?>" required></p>
								<p>Сменить фотографию<br><input style="padding: 1px 15px;" type="file" name="profile_photo" accept="image/jpeg,image/png,image/gif"></p>
								<p>Изменить информацию о себе<br><textarea name="user_info"><?php echo $_SESSION['user_info']['user_info']; ?></textarea></p>	
								<div class="clear"></div>

								<a class="share_form"></a>
								<div class="center_text"><button>Сохранить</button></div>
							</form>
						</div>
					</div>
				</div>
				<?php
					if($_SESSION['user_info']['user_type'] == 0) {
						echo('
							<div id="new_order" class="dark_wrap">
								<div class="conteiner active">
									<div style="width: 80%;" id="act" class="info_block_wrap active">
										<a class="close_wrap" onclick="$(\'.dark_wrap\').fadeOut(300);">закрыть <b>x</b></a>
										<a class="title">Добавить новый заказ</a>
										<form enctype="multipart/form-data" action="/" method="POST">
											<input type="hidden" name="operation_type" value="new_order">
											<select name="cat" class="shared" required>
												<option value="0" selected >Выберите категорию</option>');
													$temp = split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories']);
													for($i = 0; $i < count($temp); $i++)
														echo '<option '.$temp_select.' value="'.($i+1).'">'.$temp[$i].'</option>';	
											echo('</select>
											<select name="towns" class="shared" required>
												<option value="0" selected >Выберите город</option>');
													$temp = split(";", intable_search_item("SELECT `towns` FROM `base_settings`")['towns']);
													for($i = 0; $i < count($temp); $i++)
														echo '<option '.$temp_select.' value="'.($i+1).'">'.$temp[$i].'</option>';
											echo('
											</select>
											<p style="width: 100%; float: none;">Прикрепите свой эскиз или модель из 3D конструктора (не обязательно)<br>Максимальный размер файла - 3МБ<br><input style="padding: 1px 15px; width: 100%;" type="file" name="file"/></p>
											<textarea name="description" placeholder="Опишите ваш заказ (минимум 60 символов)" required></textarea>
											<select name="time" required>
												<option value="0" selected >Выберите время тендера</option>
												<option value="1">12 часов</option>
												<option value="2">24 часа</option>
												<option value="3">36 часов</option>
												<option value="4">48 часов</option>
												<option value="5">неделя</option>
												<option value="6">две недели</option>
											</select>
											<div class="center_text"><button>Отправить</button></div>
										</form>
									</div>
								</div>
							</div>
						');
					}
				?>
				<?php 
					if($_SESSION['user_info']['user_type'] > 0){
						echo('
							<div id="new_shop" class="dark_wrap">
								<div class="conteiner active">
									<div style="width: 80%;" id="act" class="info_block_wrap active">
										<a class="close_wrap" onclick="$(\'.dark_wrap\').fadeOut(300);">закрыть <b>x</b></a>
										<a class="title">Добавить новый товар в магазин</a>
										<form enctype="multipart/form-data" action="/" method="POST">
											<input type="hidden" name="operation_type" value="new_shop">
											<input type="text" name="item_name" placeholder="Наименование товара" required>
											<select name="cat" class="shared" required>
												<option value="0" selected >Выберите категорию</option>');
													$temp = split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories']);
													for($i = 0; $i < count($temp); $i++)
														echo '<option '.$temp_select.' value="'.($i+1).'">'.$temp[$i].'</option>';	
											echo('</select>
											<select name="towns" class="shared" required>
												<option value="0" selected >Выберите город</option>');
													$temp = split(";", intable_search_item("SELECT `towns` FROM `base_settings`")['towns']);
													for($i = 0; $i < count($temp); $i++)
														echo '<option '.$temp_select.' value="'.($i+1).'">'.$temp[$i].'</option>';
											echo('
											</select>
											<p style="width: 100%; float: none;">Прикрепите фото-превью<br>Максимальный размер файла - 3МБ<br><input style="padding: 1px 15px; width: 100%;" type="file" name="preview_photo" required/></p>
											<p style="width: 100%; float: none;">Прикрепите одну или несколько подробных фотографий<br>Максимальный размер файлов - 3МБ<br><input style="padding: 1px 15px; width: 100%;" type="file" multiple="multiple" name="photos[]" required/></p>
											<textarea name="description" placeholder="Опишите ваш товар (минимум 60 символов)" required></textarea>
											<input type="text" name="price" placeholder="Цена товара в российских рублях" required>
											<div class="center_text"><button>Отправить</button></div>
										</form>
									</div>
								</div>
							</div>
							<div id="activate_block" class="dark_wrap">
								<div class="conteiner active">
									<div style="width: 80%;" id="act" class="info_block_wrap active">
										<a class="close_wrap" onclick="$(\'.dark_wrap\').fadeOut(300);">закрыть <b>x</b></a>
										<a class="title">Активация аккаунта</a>
										<a class="activate_text">
											После активации аккаунта Вы сможете отвечать на заявки, так же будет доступна возможность публиковать свои товары в разделе "Магазин".
										</a>
										<a class="share_form" style="padding-top: 20px; margin-bottom: 5px;">Цены</a>
										<a class="activate_text">');
										$price_list = split(";", intable_search_item("SELECT `price_list` FROM `base_settings`")['price_list']);
										foreach($price_list as $value){
											$temp_price = split("/", $value);
											echo $temp_price[0]." - ".$temp_price[1]." руб.<br>";
										}
										echo('
										<a class="share_form" style="padding-top: 5px;"></a>
										<form action="/" method="POST">
											<input type="hidden" name="operation_type" value="activate_account"/>
											<select style="flaot: left; width: calc(100% - 90px);" name="time_activate" class="shared" required>
												<option value="0" selected >Выберите категорию</option>');
													$temp = split(";", intable_search_item("SELECT `price_list` FROM `base_settings`")['price_list']);
													for($i = 0; $i < count($temp); $i++)
														echo '<option value="'.($i+1).'">'.split("/", $temp[$i])[0].'</option>';	
											echo('</select>
											<div style="width: 90px; float: right; text-align: right;" class="center_text"><button style="margin: 0; padding: 6px 10px; font-size: 16px;">Купить</button></div>
											<div class="clear"></div>
										</form>
									</div>
								</div>
							</div>
						');
					}
				?>
				<div class="conteiner">
					<div class="left_conteiner">
						<div class="white_block">
							<img class="profile_foto" <?php if($_SESSION['user_info']['user_type'] == 0) echo 'style="border: 3px solid #FF0B85;"'; ?> src="<?php if($_SESSION['user_info']['profile_photo'] != null) echo $_SESSION['user_info']['profile_photo']; else echo 'uploads/none.jpg'; ?>"/>
							<div class="info_block">
								<a class="profile_name"><?php echo $_SESSION['user_info']['fio']; ?><span><?php
									switch ($_SESSION['user_info']['user_type']) {
										case 0:
											echo "покупатель";
											break;
										case 1:
											echo "продавец";
											break;
										case 2:
											echo "модератор";
											break;
										case 3:
											echo "админ";
											break;
									}
								?></span></a>
								<a class="profile_info"><?php
									if($_SESSION['user_info']['user_info'] == null) echo "Информация обо мне.";
									else echo $_SESSION['user_info']['user_info'];
								?></a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="right_conteiner">
						<div class="white_block">
							<?php
								switch ($_SESSION['user_info']['reputation']) {
									case 3:
										$class_text = "отличная";
										$class = "_good";
										break;
									case 2:
										$class_text = "хорошая";
										$class = "_normal";
										break;
									case 1:
										$class_text = "плохая";
										$class = "_bad";
										break;
								}
							?>
							<a class="reputation">репутация: <b class="<?php echo $class; ?>"><?php echo $class_text; ?></b></a>
							<a class="reputation">заказов завершено: <b class="black">(<?php echo intable_count_items("SELECT `id` FROM `history_orders` WHERE `user_id`=".$_SESSION['user_info']['id']." OR `exe_id`=".$_SESSION['user_info']['id']); ?>)</b></a>
							<?php
								if($_SESSION['user_info']['user_type'] > 0){
									echo '<a class="reputation">Активирован: ';

									$active_time = 0;
									if($_SESSION['user_info']['active'] - time() >= 0) $active_time = $_SESSION['user_info']['active'] - time();

									if($active_time == 0) echo '-';
									else echo int_div($active_time, 86400)." дней";
								}
							?>
							</a>
							<a class="reduct_button_" onclick="$('#reduct').fadeIn(300);">Редактировать профиль</a>
							<?php
								if($_SESSION['user_info']['user_type'] > 0)
									echo '<div class="reputation">Баланс: '.$_SESSION['user_info']['ballance'].' руб.<a class="plus_ballance" onclick="$(\'#transaction\').fadeIn(300);">+</a></div>';
							?>
						</div>
					</div>
					<div class="clear"></div>
					<?php 
						if($active_time == 0 && $_SESSION['user_info']['user_type'] > 0) echo('
							<div class="active_acc">
								<a class="text_acc">Ваш аккаунт ещё не активирован</a>
								<a class="acc_active_button" onclick="$(\'#activate_block\').fadeIn(300);">Активировать</a>
							</div>
						');

						$temp = intable_search_items("SELECT * FROM `orders` WHERE `user_id`=".$_SESSION['user_info']['id']." OR `exe_id`=".$_SESSION['user_info']['id'], -1);

						if($_SESSION['user_info']['user_type'] == 0) echo '<div class="kwork_head">Ваши активные заказы ('.count($temp).')</div>';
						else echo '<div class="kwork_head">Ваши активные заказы ('.count($temp).')</div>';

						echo '<ul class="kwork">';

						for($i = 0; $i < count($temp); $i++)
							echo('
								<li>
									<a class="ttl">'.split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories'])[$temp[$i]['categories']-1].'</a>
									<a class="text_name">"'.$temp[$i]['description'].'"</a>
									<a class="info"><img src="resourse/img/eye.svg"/>'.$temp[$i]['viewes'].'<h>откликнулось '.intable_count_items("SELECT `id` FROM `back_order` WHERE `order_id`=".$temp[$i]['id']).' человек</h></a>
									<a href="/?page=order&order_id='.$temp[$i]['id'].'" class="order_button">Посмотреть</a>
								</li>
							');

						if($_SESSION['user_info']['user_type'] == 0)
							echo('
								<li class="add_new" onclick="$(\'#new_order\').fadeIn(300);">
									<img src="resourse/img/plus.png"/>
								</li>
							');

						echo '</ul>';

						$temp = intable_search_items("SELECT * FROM `history_orders` WHERE `user_id`=".$_SESSION['user_info']['id']." OR `exe_id`=".$_SESSION['user_info']['id'], -1);
						
						if(count($temp) != 0){
							echo '<div class="kwork_head">История заказов ('.count($temp).')</div><ul class="kwork">';

							for($i = 0; $i < count($temp); $i++){
								$exe_bandage = "";
								if($_SESSION['user_info']['id'] == $temp[$i]['exe_id']) $exe_bandage = '<div class="bandage"><a>исполнитель</a></div>';
								echo('
									<li>
										'.$exe_bandage.'
										<a class="ttl">'.split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories'])[$temp[$i]['categories']-1].'</a>
										<a class="text_name">"'.$temp[$i]['description'].'"</a>
										<a href="/?page=history_order&order_id='.$temp[$i]['id'].'" class="order_button">Посмотреть</a>
									</li>
								');
							}
							
							echo '</ul>';
						}
					?>
					<?php
						if($_SESSION['user_info']['user_type'] > 0){
							$temp = intable_search_items("SELECT * FROM `shop_items` WHERE `user_id`=".$_SESSION['user_info']['id'], -1);

							echo '<div class="kwork_head">Ваши товары в магазине ('.count($temp).')</div><ul class="kwork">';

							foreach($temp as $value)
									echo('
										<li>
											<img src="'.$value['preview_photo'].'" class="shop_photo"/>
											<a style="width: calc(100% - 140px); margin-left: 140px;" class="ttl">'.split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories'])[$value['categories']-1].'</a>
											<a style="width: calc(100% - 140px); margin-left: 140px;" class="text_name">"'.$value['description'].'"</a>
											<a href="/?page=item&item_id='.$value['id'].'" class="order_button">Посмотреть</a>
										</li>
									');

							echo('
								<li class="add_new" onclick="$(\'#new_shop\').fadeIn(300);">
									<img src="resourse/img/plus.png"/>
								</li>
								</ul>
							');
						}
					?>
				</div>
<!--Контент-->
<?php
	if(!$require_page_allow || !isset($_GET['item_id'])){
		header('Location: /error');
		exit();
	}

	require('exe.php');

	mysql_query("UPDATE `shop_items` SET `viewes`=`viewes`+1 WHERE `id`=".$_GET['item_id']);

	$temp = intable_search_item("SELECT * FROM `shop_items` WHERE `id`=".$_GET['item_id']);
?>
<!--Большие скрипты и стили-->
				<script type="text/javascript" src="resourse/js/copy.js"></script>
				<script type="text/javascript" src="resourse/js/photo_slider.js"></script>
				<link href="resourse/css/item.css" rel="stylesheet" type="text/css">
				<link href="resourse/css/dark_wrap.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<?php
					if($temp['user_id'] == $_SESSION['user_info']['id'])
						echo('
							<script>$(document).ready(function (){$(\'#item_panel\').hide();});</script>
							<div id="item_panel" class="dark_wrap">
								<div class="conteiner active">
									<div class="info_block_wrap active" style="width: 80%; margin: auto;">
										<a class="close_wrap" onclick="$(\'.dark_wrap\').fadeOut(300);">закрыть <b>x</b></a>
										<a class="title">Управление товаром</a>
										<a class="share_form">Продвижение</a>
										<form action="/?page=item&item_id='.$_GET['item_id'].'" method="POST">
											Вы можете выставить ваше обьявление на первые строчки магазина, чтобы оно стало заметней.<br>
											-Стоимость услуги '.split(";", intable_search_item("SELECT `shop_price` FROM `base_settings`")['shop_price'])[0].' руб. за одну неделю.
											<input type="hidden" name="operation_type" value="item_prod" />
											<div class="center_text"><button>Продвинуть обьявление</button></div>
										</form>
										<a class="share_form">Выход в топ</a>
										<form action="/?page=item&item_id='.$_GET['item_id'].'" method="POST">
											Со временем ваше обьявление может опускаться. Данная услуга позволяет поднять ваше обьявление в списке.<br>
											-Стоимость услуги '.split(";", intable_search_item("SELECT `shop_price` FROM `base_settings`")['shop_price'])[1].' руб.
											<input type="hidden" name="operation_type" value="item_up" />
											<div class="center_text"><button>Поднять обьявление</button></div>
										</form>
										<a class="share_form">Удалить обьявление</a>
										<form style="text-align: center;" action="/?page=item&item_id='.$_GET['item_id'].'" method="POST">
											Вы можете удалить своё обьявление.<br>
											<input type="hidden" name="operation_type" value="item_del" />
											<button style="background-color: #FF0B85;background: linear-gradient(to top, #FF0B85, #FF5CAE); border: 0;">Удалить обьявление</button>
										</form>
									</div>
								</div>
							</div>
						');
				?>
				<div class="conteiner">
					<?php
						if($temp['user_id'] == $_SESSION['user_info']['id'])
							echo '<a class="reduct_conteiner" onclick="$(\'#item_panel\').fadeIn(300);">Открыть панель управления</a>';
					?>
					<div class="item_content">
						<a class="item_title"><?php echo $temp['item_name']; ?></a>
						<a class="price"><?php echo number_format($temp['price'], 0, ',', ' '); ?> руб.</a>
						<a class="info">№ <?php echo $_GET['item_id']; ?>, <?php echo $temp['date']; ?><span><img src="resourse/img/eye.svg"/><?php echo $temp['viewes']; ?></span> просмотров</a>
						<div class="share_line"></div>
						<div class="photo">
							<ul class="photos">
								<?php
									foreach (split(" ", $temp['photos']) as $value)
										echo '<li><img src="'.$value.'"/></li>';
								?>
							</ul>
							<div class="mini">
								<ul class="mini_photos">
									<div class="overlay"></div>
									<?php
										$i = 0;
										foreach (split(" ", $temp['photos']) as $value){
											echo '<li><img data-id="'.$i.'" src="'.$value.'"/></li>';
											$i++;
										}
									?>
									<div class="clear"></div>
								</ul>
							</div>
						</div>
						<div class="contact_info">
							<a onclick="copy_line(this);" class="info_button">
							<?php
								$user_info_now = intable_search_item("SELECT * FROM `user` WHERE `id`=".$temp['user_id']);
								echo $user_info_now['phone'];
							?>
							</a>
							<a class="info_">
								<p><?php echo $user_info_now['fio']; ?></p>
								<?php echo $user_info_now['user_info']; ?>
							</a>
						</div>
						<div class="clear"></div>
					</div>
					<div class="description">
						<a class="dscrptn">Описание</a>
						<a class="text_">
							<?php echo $temp['description']; ?>
						</a>
					</div>
				</div>
<!--Контент-->
<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/orders.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<div class="conteiner">
					<?php
						$temp = intable_search_items("SELECT `id` FROM `orders` WHERE `out_time`-".time().">0 ORDER BY `orders`.`id` DESC", -1);

						echo('
							<div class="kwork_head">Активные заказы ('.count($temp).')</div>
							<ul class="kwork">
						');

						$num = 0;
						if(isset($_GET['num'])) $num = $_GET['num'];

						$a = $num * 20;
						$b = $a + 20;
						if($b > count($temp)) $b = count($temp);

						for($i = $a; $i < $b; $i++){
							$temp_flag = true;
							$info = intable_search_item("SELECT * FROM `orders` WHERE `id`=".$temp[$i]['id']);
							$categories = split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories']);
							$towns = split(";", intable_search_item("SELECT `towns` FROM `base_settings`")['towns']);
							echo('
								<li>
									<a class="ttl">'.$categories[$info['categories']-1].' <t>'.$towns[$info['towns']-1].'</t></a>
									<a class="text_name">"'.$info['description'].'"</a>
									<a class="info"><img src="resourse/img/eye.svg"/>'.$info['viewes'].'<h>откликнулось '.intable_count_items("SELECT `id` FROM `back_order` WHERE `order_id`=".$info['id']).' человек</h></a>
									<a href="/?page=order&order_id='.$info['id'].'" class="order_button">Посмотреть</a>
								</li>
							');
						}

						if(!$temp_flag) echo('<div class="none_items">Здесь пока ничего нет :(</div>');	
					?>
					</ul>
					<?php
						$count_pages = int_div(count($temp), 20);
						if(count($temp) % 20 != 0) $count_pages++;

						if($count_pages > 1){
							echo '<div class="frames"><ul>';

							for($i = 0; $i < $count_pages; $i++){
								$style = "";
								if($_GET['num'] == $i) $style = 'style="background-color: #999;"';
								echo '<a href="/?page=orders&num='.$i.'"><li '.$style.'>'.($i + 1).'</li></a>';
							}

							echo '<div class="frames"></div></ul></div>';
						}
					?>
				</div>
<!--Контент-->
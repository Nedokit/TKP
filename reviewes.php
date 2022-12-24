<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/reviewes.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<div class="conteiner">
					<div class="comments">
						<div class="conteiner">
							<div class="title">Отзывы о нашей бирже</div>
							<ul class="com_block">
								<?php
									$temp = intable_search_items("SELECT * FROM `reviews` ORDER BY `reviews`.`time` DESC", -1);

									$curent_review = 0;
									if(isset($_GET['num'])) $curent_review = $_GET['num'] * 10;
									
									$last_review = $curent_review + 10;
									if($last_review > count($temp)) $last_review = count($temp);

									for($i = $curent_review; $i < $last_review; $i++){
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
									if(count($temp) == 0) echo('
										<li style="border-radius: 50px;"><a class="title" style="padding-bottom: 20px; padding-left: 0; width: 100%; text-align: center; display: block; font-size: 18px;">По вашему запросу ничего не найдено :(</a></li>
									');
								?>
							</ul>
						</div>
					</div>
					<?php
						$count_pages = int_div(count($temp), 10);
						if(count($temp) % 10 != 0) $count_pages++;

						if($count_pages > 1){
							echo '<div class="frames"><ul>';

							for($i = 0; $i < $count_pages; $i++){
								$style = "";
								if($_GET['num'] == $i) $style = 'style="background-color: #999;"';
								echo '<a href="/?page=reviewes&num='.$i.'"><li '.$style.'>'.($i + 1).'</li></a>';
							}

							echo '<div class="frames"></div></ul></div>';
						}
					?>
				</div>
<!--Контент-->
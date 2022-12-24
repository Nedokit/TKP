<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/shop.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<div class="conteiner">
					<div class="top_search">
						<form action="/" method="GET">
							<div class="search">
								<input type="hidden" name="page" value="shop">
								<input type="text" name="search_line" value="<?php if(isset($_GET['search_line'])) echo $_GET['search_line']; ?>" placeholder="Что вы ищите...">
								<button>Поиск</button>
								<div class="clear"></div>
							</div>
							<div class="filter">
								<a class="shared">Параметры поиска:</a>
								<select name="cat" class="shared">
									<option value="0" selected >Выберите категорию</option>
									<?php
										$temp = split(";", intable_search_item("SELECT `categories` FROM `base_settings`")['categories']);
										for($i = 0; $i < count($temp); $i++){
											$temp_select = "";
											if(isset($_GET['cat']) && $i+1 == $_GET['cat']) $temp_select = "selected";
											echo '<option '.$temp_select.' value="'.($i+1).'">'.$temp[$i].'</option>';
										}
									?>
								</select>
								<select name="place" class="shared">
									<option value="0" selected >Выберите город</option>
									<?php
										$temp = split(";", intable_search_item("SELECT `towns` FROM `base_settings`")['towns']);
										for($i = 0; $i < count($temp); $i++){
											$temp_select = "";
											if(isset($_GET['place']) && $i+1 == $_GET['place']) $temp_select = "selected";
											echo '<option '.$temp_select.' value="'.($i+1).'">'.$temp[$i].'</option>';
										}
									?>
								</select>
								<button class="shared">Применить</button>
								<div class="clear"></div>
							</div>
						</form>
					</div>
					<ul class="items">
						<?php
							$keys = array(0 => array("adv", 1));
							if($_GET['cat'] > 0) array_push($keys, array("categories", $_GET['cat']));
							if($_GET['place'] > 0) array_push($keys, array("towns", $_GET['place']));
							$temp = intable_search_item_id($_GET['search_line'], "shop_items", $keys);

							$count = 2;
							if(count($temp) < 2)$count = count($temp);

							$random_item = rand_mass(0, count($temp) - 1);

							for($i = 0; $i < $count; $i++){
								$temp_item = intable_search_item("SELECT * FROM `shop_items` WHERE `id`=".$temp[$random_item[$i]]);
								echo('
									<li id="top">
										<img src="'.$temp_item['preview_photo'].'"/>
										<a class="price">'.number_format($temp_item['price'], 0, ',', ' ').' руб.</a>
										<a class="title">'.$temp_item['item_name'].'</a>
										<a class="about">
											'.$temp_item['description'].'
										</a>
										<div class="clear"></div>
										<a href="/?page=item&item_id='.$temp_item['id'].'" class="button_more">Посмотреть</a>
									</li>
								');
							}

							$keys = array(0 => array("adv", 0));
							if($_GET['cat'] > 0) array_push($keys, array("categories", $_GET['cat']));
							if($_GET['place'] > 0) array_push($keys, array("towns", $_GET['place']));
							$temp = intable_search_item_id($_GET['search_line'], "shop_items", $keys);

							if(count($temp) == 0) echo '<li style="border-radius: 50px;"><a class="title" style="padding-left: 0; width: 100%; text-align: center; display: block; font-size: 18px;">По вашему запросу ничего не найдено :(</a></li>';
							else {
								$page_num = 0;
								if(isset($_GET['num'])) $page_num = $_GET['num']*10;

								$page_num_ = $page_num + 10;
								if(count($temp) < $page_num_) $page_num_ = count($temp);

								for($i = $page_num; $i < $page_num_; $i++){
									$temp_item = intable_search_item("SELECT * FROM `shop_items` WHERE `id`=".$temp[$i]);
									echo('
										<li>
											<img src="'.$temp_item['preview_photo'].'"/>
											<a class="price">'.number_format($temp_item['price'], 0, ',', ' ').' руб.</a>
											<a class="title">'.$temp_item['item_name'].'</a>
											<a class="about">
												'.$temp_item['description'].'
											</a>
											<div class="clear"></div>
											<a href="/?page=item&item_id='.$temp_item['id'].'" class="button_more">Посмотреть</a>
										</li>
									');
								}
							}
						?>
					</ul>
					<?php
						$count_pages = int_div(count($temp), 10);
						if(count($temp) % 10 != 0) $count_pages++;

						if($count_pages > 1){
							echo '<div class="frames"><ul>';

							for($i = 0; $i < $count_pages; $i++){
								$style = "";
								if($_GET['num'] == $i) $style = 'style="background-color: #999;"';
								echo '<a href="/?page=shop&num='.$i.'&search_line='.$_GET['search_line'].'&cat='.$_GET['cat'].'&place='.$_GET['place'].'"><li '.$style.'>'.($i + 1).'</li></a>';
							}

							echo '<div class="frames"></div></ul></div>';
						}
					?>
				</div>
<!--Контент-->
<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/rules.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<div class="conteiner">
					<div class="rules_block">
						<a class="title">Правила</a>
						<?php echo intable_search_item("SELECT `rules` FROM `base_settings`")['rules']; ?>
					</div>
				</div>
<!--Контент-->
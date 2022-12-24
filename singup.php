<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}

	require("exe.php"); //подключение обработчика ошибок пользователя

	if(isset($_POST['fio'], $_POST['login'], $_POST['mail'], $_POST['phone'])) $insert_flag = true;
?>
<!--Большие скрипты и стили-->
				<script type="text/javascript" src="resourse/js/change_user_type.js"></script>
				<link href="resourse/css/singup.css" rel="stylesheet" type="text/css">
<!--Контент-->
				<script>
					$(document).ready(function (){
						$(".conteiner").css("padding-top", ((document.getElementById("content_conteiner").offsetHeight - document.getElementById("script_2").offsetHeight) / 2));
					});
					$(window).resize(function (){
						$(".conteiner").css("padding-top", ((document.getElementById("script_1").offsetHeight - document.getElementById("script_2").offsetHeight) / 2));
					});
				</script>
				<div class="conteiner">
					<div class="login_block" id="script_2">
						<div class="half">
							<div class="user_type">
								<?php if(!isset($_GET['type']))
									echo '
										<div id="user" class="block" style="border-radius: 5px 0 0 0;">Покупатель</div>
										<div id="executor" class="block" style="border-radius: 0 5px 0 0;">Продавец</div>
									';
									else {
										if($_GET['type'] == "true") {
											$_U_TYPE = "executor";
											$_U_TEXT = "Продавец";
										} else {
											$_U_TYPE = "user";
											$_U_TEXT = "Покупатель";
										}

										echo '<div id="'.$_U_TYPE.'" class="block" style="border-radius: 5px 5px 0 0; width: 100%;">'.$_U_TEXT.'</div>';
									}
								?>
								
								<div class="clear"></div>
							</div>
							<form action="/?page=singup<?php if(isset($_GET['type'])) echo "&type=".$_GET['type']; ?>" method="POST">
								<a class="title">Регистрация</a>
								<p class="error">* поля обязательные к заполнению</p>
								<input type="text" name="fio" placeholder="Имя*" value="<?php if($insert_flag) echo $_POST['fio']; ?>" required />
								<input type="text" name="login" placeholder="Логин*" value="<?php if($insert_flag) echo $_POST['login']; ?>" required />
								<input type="text" name="mail" placeholder="example@mail.ru*" value="<?php if($insert_flag) echo $_POST['mail']; ?>" required />
								<input type="tel" name="phone" placeholder="Телефон*" value="<?php if($insert_flag) echo $_POST['phone']; ?>" required />
								<input type="password" name="pass" placeholder="Пароль*" required />
								<input type="password" name="add_pass" placeholder="Повторите пароль*" required /><br>
								<button>Далее</button>
								<input id="hidden_input" type="hidden" name="user_type" value="<?php 
									if(isset($_GET['type']) && require_filter($_GET['type'])) echo $_GET['type'];
									else if(isset($_POST['user_type'])) echo $_POST['user_type'];
								?>"/>
								<input type="hidden" name="operation_type" value="singup"/>
							</form>
						</div>
					</div>
				</div>
<!--Контент-->
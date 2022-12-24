<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}

	require("exe.php");
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/auth.css" rel="stylesheet" type="text/css">
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
							<form action="/?page=auth" method="POST">
								<a class="title">Авторизация</a>
								<input type="text" name="login" placeholder="Логин" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>" required />
								<input type="password" name="pass" placeholder="Пароль" required />
								<input type="hidden" name="operation_type" value="login"/>
								<button>Войти</button>
								<a href="/?page=forget" class="forget">Забыли пароль?</a>
								<a class="share">или</a>
								<a href="/?page=singup" class="forget">Регистрация</a>
							</form>
						</div>
						<!--
						<div class="half">
							<div class="buttons_block">
								<a class="title">Войти через соцсети</a>
								<a href="#"><div style="background-color: #FFF" class="social_button">
									<img src="resourse/img/google_auth.png"/>
									<div class="text">Войти через <b>Google</b></div>
									<div class="clear"></div>
								</div></a>
								<a href="#"><div style="background-color: #4070A7; color: #FFF" class="social_button">
									<img src="resourse/img/vk.png"/>
									<div class="text">Войти через <b>VK</b></div>
									<div class="clear"></div>
								</div></a>
								<a href="#"><div style="background-color: #3B5998; color: #FFF" class="social_button">
									<img src="resourse/img/facebook.png"/>
									<div class="text">Войти через <b>facebook</b></div>
									<div class="clear"></div>
								</div></a>
								<a class="share">или</a>
								<a href="#" class="forget">Регистрация</a>
							</div>
						</div>
						<div class="clear"></div>
						-->
					</div>
				</div>
<!--Контент-->
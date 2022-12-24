<?php
	if(!$require_page_allow){
		header('Location: /error');
		exit();
	}

	require('exe.php');
?>
<!--Большие скрипты и стили-->
				<link href="resourse/css/forget.css" rel="stylesheet" type="text/css">
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
							<?php
								if((isset($_GET['type']) && $_GET['type'] == "mail") || !isset($_GET['type']))
									echo('
										<form action="/?page=forget&type=mail" method="POST">
											<a class="title">Восстановление</a>
											<input type="hidden" name="operation_type" value="forget_message">
											<input type="text" name="mail" placeholder="Ваша почта..." required />
											<button>Далее</button>
										</form>
									');	

								else if(isset($_GET['type']) && $_GET['type'] == "code")
									echo('
										<form action="/?page=forget&type=code" method="POST">
											<a class="title">Восстановление</a>
											Впишите код из письма, которое<br> было выслано на вашу почту.<br>
											<input type="hidden" name="operation_type" value="forget_message">
											<input style="text-align: center;" type="text" name="code" placeholder="Код" required />
											<button>Далее</button>
										</form>
									');

								else if(isset($_GET['type']) && $_GET['type'] == "new_pass")
									echo('
										<form action="/?page=forget&type=new_pass&code='.$_GET['code'].'" method="POST">
											<a class="title">Новый пароль</a>
											<input type="hidden" name="operation_type" value="forget_message">
											<input type="password" name="pass" placeholder="Пароль" required />
											<input type="password" name="try_pass" placeholder="Повторите пароль" required />
											<button>Изменить</button>
										</form>
									');
							?>
						</div>
					</div>
				</div>
<!--Контент-->
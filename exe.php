<?php
	if(!$require_functions_allow){
		header('Location: /error');
		exit();
	}

	if(isset($exodus['type'], $exodus['text']))
		echo('
			<div class="exe_block '.$exodus['type'].'">'.$exodus['text'].'</div>
			<style type="text/css">
				.exe_block{
					position: fixed;
					bottom: 10%;
					right: 20px;
					border-radius: 40px;
					padding: 15px;
					box-shadow: 1px 1px 2px 0 #777;
					z-index: 5;
					color: #FFF;
					opacity: 0;
					transition-duration: 0.3s;
					cursor: pointer;
				}

				.good{
					background-color: #00A2DA;
                    background: linear-gradient(to top, #00A2DA, #0AACE4);
				}

				.bad{
					background-color: #F78F9A;
                    background: linear-gradient(to top, #F76D7B, #F7848F);
				}
			</style>
			<script type="text/javascript">
				$(document).ready(function (){
					setTimeout(function (){
						$(".exe_block").css("opacity", 1);
						setTimeout(function (){
							$(".exe_block").css("opacity", 0);
						}, 5000);
						$(".exe_block").click(function() {
							$(".exe_block").css("opacity", 0);
						});
					}, 800);
				});
			</script>
		');
?>

<?php 
	include "assets/funcao.php";
?>
<!DOCTYPE html>
	<html lang="pt-br">
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
			<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

			<!-- Ícone -->
			<link rel="icon" type="image/png" href="assets/img/icon.png">
			
			<!-- Fontes -->
			<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

			<!-- Ícones -->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

			<!-- CSS Files -->
			<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
			<link href="assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
			<!-- CSS Just for demo purpose, don't include it in your project -->
			<link href="assets/demo/demo.css" rel="stylesheet" />

			<!-- Título -->
			<title>Conselho Online</title>
		</head>

		<body class="index-page">
			 <!-- Navbar -->
			<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent">
				<div class="container">
					<div class="navbar-translate">
						<a class="navbar-brand" href="examples/sobre.html" rel="tooltip" title="Desenvolvido para auxílio do Instituto Federal Catarinense - Campus Rio do Sul - Unidade Urbana" data-placement="bottom" target="_blank" style="background: rgba(0, 0, 0, 0.3); padding: 0 1em 0 1em">
							CONSELHO <strong>ONLINE</strong>
						</a>
					</div>
				</div>
			</nav>
			<div class="section-signup " style="background-image: url('assets/img/login.jpg'); background-size: cover; background-position: top center;">
				<div class="container">
					<div class="row">
						<div class="card card-signup" data-background-color="" style="margin-top: -10em">
							<form class="form" action="assets/acaoLogin.php" method="post">
								<div class="card-header text-center">
									<div class="logo-container">
										<img src="assets/img/icon.png" width="130em" alt="">
									</div>
								</div>
								<div class="card-body">
									<div class="input-group no-border">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons" style="color: #FFF">person</i>
											</span>
										</div>
										<input type="text" class="form-control" placeholder="Usuário" name="usuario" id="usuario" />
									</div>
									<div class="input-group no-border">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="material-icons" style="color: #FFF">lock</i>
											</span>
										</div>
										<input type="password" class="form-control" placeholder="Senha" name="senha" id="senha" />
									</div>
									<!-- If you want to add a checkbox to this form, uncomment this code -->
									<!-- <div class="checkbox">
																	<input id="checkboxSignup" type="checkbox">
																		<label for="checkboxSignup">
																		Unchecked
																		</label>
																	</div> -->
								</div>
								<input type="hidden" name="acao" value="login">
								<div class="card-footer text-center">
									<input type="submit" name="login" value="Entrar" class="btn btn-success btn-round btn-lg">
								</div>
							</form>
						</div>
					</div>
				</div>
				<footer class="footer" style="background-color: rgba(0, 0, 0, 0.8); margin: 17em 0 -10.5em 0; padding: 1em;">
					<div class="container">
						<div class="copyright" id="copyright" style="color: #FFF">
						&copy;
						<script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>, Desenvolvido para <a href="http://www.ifc-riodosul.edu.br/site/">Instituto Federal Catarinense - Campus Rio do Sul</a>
						</div>
					</div>
				</footer>
			</div>
			
			<!--Core JS Files-->
			<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
			<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
			<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
			<!--Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
			<script src="assets/js/plugins/bootstrap-switch.js"></script>
			<!--Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
			<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
			<!--Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
			<script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
			<!--Google Maps Plugin-->
			<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
			<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
			<script src="assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
			<script>
				$(document).ready(function() {
					// the body of this function is in assets/js/now-ui-kit.js
					nowuiKit.initSliders();
				});

				function scrollToDownload() {
					if ($('.section-download').length != 0) {
						$("html, body").animate({
							scrollTop: $('.section-download').offset().top
						}, 1000);
					}
				}
			</script>
		</body>

	</html>
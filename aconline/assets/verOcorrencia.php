<?php
	include('funcoes.php');
	include('autoload.php');
	include('funcaoBanco.php');
?>
<!DOCTYPE html>
	<html lang="pt-BR">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />

			<!-- Ícone -->
			<link rel="shortcut icon" type="imagem/x-icon" href="../assets/img/icon.png">
			
			<!-- CSS  -->
			<link href="../assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
			<link href="../assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
			<link href="../assets/css/css.css" type="text/css" rel="stylesheet" media="screen,projection">

			<!-- Fontes -->
			<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

			<!-- Ícones -->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

			<!-- Título -->
			<title>ADM | Ocorrência</title>
		</head>
		<body>
			<header>
				<nav class="verdeIF">
					<div class="nav-wrapper black-text">
						<?php 
							if ($_SESSION['ocupacao'] == 1) {
						?>
						<ul id="menu" class="sidenav">
							<li class="center" style="margin-bottom: 1rem"><a href="../assets/admin.php" style="color: #349A47">CONSELHO ONLINE</a></li>
							<li><a href="../assets/admin.php"><i class="material-icons">dashboard</i>Painel de Controle</a></li>
							<li><a href="../assets/administradores.php"><i class="material-icons">create</i>Administradores</a></li>
							<li><a href="../assets/professores.php"><i class="material-icons">format_align_justify</i>Professores</a></li>
							<li><a href="../assets/alunos.php"><i class="material-icons">check_circle</i>Alunos</a></li>
							<li><a href="../assets/tecsAdm.php"><i class="material-icons">folder</i>Técnico Administrativo</a></li>
							<li><a href="../assets/turmas.php"><i class="material-icons">people</i>Turmas</a></li>
							<li><a href="../assets/disciplinas.php"><i class="material-icons">class</i>Disciplinas</a></li>
							<li><a href="../assets/ocorrencia.php"><i class="material-icons">gavel</i>Ocorrências</a></li>
							<li><a href="../assets/tpOcorrencias.php"><i class="material-icons">list</i>Tipo de Ocorrência</a></li>

							<div>
								<li><div class="divider" style="width: 100%"></div></li>
								<li><a href="acaoLogin.php?acao=logout"><i class="material-icons" class="grey-text">power_settings_new</i>Sair</a></li>
							</div>
						</ul>

						<ul class="left">
							<div class="btn-floating" style="background-color: #FFF; margin-left: 2vw">
								<li><i class="material-icons sidenav-trigger" style="color: #349A47; top: -.5em; left: -.42em;" data-target="menu">menu</i></li>
							</div>
						</ul>
						<ul class="brand-logo center hide-on-small-only">
							<li style="padding-right: 50em"><a href="../assets/admin.php" class="link-logo brand-logo center">Conselho Online</a></li>
						</ul>
						<ul class="brand-logo right hide-on-small-only">
							<li><a href="ocorrencia.php" class="center">Ocorrências</a></li>
						</ul>
						<ul class="brand-logo hide-on-med-and-up">
							<li><a href="../assets/admin.php" class="texto link-logo">CONSELHO ONLINE</a></li>
						</ul>
						<?php 
							}
							else{
						?>
						<ul id="menu" class="sidenav">
							<li class="center" style="margin-bottom: 1rem"><a href="professor.php" style="color: #349A47">CONSELHO ONLINE</a></li>
							<li><a href="professor.php"><i class="material-icons">dashboard</i>Perfil</a></li>
							<li><a href="ocorrencia.php"><i class="material-icons">create</i>Ocorrências</a></li>

							<div>
								<li><div class="divider" style="width: 100%"></div></li>
								<li><a href="editarPerfil.php"><i class="material-icons" class="grey-text">brightness_5</i>Editar Perfil</a></li>
								<li><a href="acaoLogin.php?acao=logout"><i class="material-icons" class="grey-text">power_settings_new</i>Sair</a></li>
							</div>
						</ul>

						<ul class="left">
							<div class="btn-floating" style="background-color: #FFF; margin-left: 2vw">
								<li><i class="material-icons sidenav-trigger" style="color: #349A47; top: -.5em; left: -.42em;" data-target="menu">menu</i></li>
							</div>
						</ul>
						<ul class="brand-logo right hide-on-small-only">
							<li><a href="ocorrencia.php" class="center">Ocorrências</a></li>
						</ul>
						<ul class="brand-logo center hide-on-small-only">
							<li><a href="professor.php" class="link-logo brand-logo center">ConselhoOnline</a></li>
						</ul>
						<ul class="brand-logo hide-on-med-and-up">
							<li><a href="professor.php" class="texto link-logo">CONSELHO ONLINE</a></li>
						</ul>
						<?php	
							}
						?>
					</div>
				</nav>
			</header>
			<form action="acaoLogin.php" method="post">
				<fieldset style="border: none;">
					<div class="col s12 l4">
						<div class="valign-wrapper" style="width:100%; padding-bottom:1em">
							<div class="row" style="width:100%; padding-bottom: 2em">
								<?php 
									VerOcorrencia(isset($_GET['codigoAluno']) ? $_GET['codigoAluno'] : 0,isset($_GET['codigoProfessor']) ? $_GET['codigoProfessor'] : 0,isset($_GET['codigoOcorrencia']) ? $_GET['codigoOcorrencia'] : 0);
								?>
							</div>
						</div>
					</div>
				</fieldset>
			</form>

			<!--  Scripts-->
			<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			<script src="../assets/js/materialize.js"></script>
			<script src="../assets/js/init.js"></script>
			<script type="text/javascript">
				function goBack() {
					window.history.back();
				}
				$(document).ready(function() {
					$(".modal").modal();
					$("select").formSelect();
					$(".sidenav").sidenav();
					$(".datepicker").datepicker({
						format: "dd/mm/yyyy",
						yearRange: 100,
						i18n: {
							months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
							monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
							weekdays: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sabádo"],
							weekdaysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
							weekdaysAbbrev: ["D", "S", "T", "Q", "Q", "S", "S"],
							today: "Hoje",
							clear: "Limpar",
							close: "Pronto",
							labelMonthNext: "Próximo mês",
							labelMonthPrev: "Mês anterior",
							labelMonthSelect: "Selecione um mês",
							labelYearSelect: "Selecione um ano",
							selectMonths: true,
							cancel: "Cancelar",
							clear: "Limpar"
						}
					});
					$(".chips").chips();
					  $(".chips-placeholder").chips({
						placeholder: "Enter a tag",
					    secondaryPlaceholder: "+Tag",
					  });
					  $(".chips-autocomplete").chips({
					    autocompleteOptions: {
					      data: {
							"Apple": null,
							"Microsoft": null,
							"Google": null
					      },
					      limit: Infinity,
					      minLength: 1
					    }
					  });
				});
			</script>
		</body>
	</html>
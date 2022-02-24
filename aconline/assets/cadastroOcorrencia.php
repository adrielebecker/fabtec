<?php
	include('funcoes.php');
	include('autoload.php');

	$codigoAluno = isset($_GET['codigoAluno']) ? $_GET['codigoAluno'] : 0;
	$codigoProfessor = $_SESSION['codigo'];
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
			<title>Professor | Ocorrência</title>
		</head>
		<body>
			<header>
				<nav class="verdeIF">
					<ul id="menu" class="sidenav">
							<li class="center" style="margin-bottom: 1rem"><a href="#!" style="color: #349A47">CONSELHO ONLINE</a></li>
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
						<ul class="brand-logo center hide-on-small-only">
							<li style="padding-right: 50em"><a href="professor.php" class="link-logo brand-logo center">Conselho Online</a></li>
						</ul>
						<ul class="brand-logo right hide-on-small-only">
							<li><a href="professor.php" class="center">Perfil</a></li>
						</ul>
						<ul class="brand-logo hide-on-med-and-up">
							<li><a href="professor.php" class="texto link-logo">CONSELHO ONLINE</a></li>
						</ul>
					</div>
				</nav>
			</header>
			<br style="padding-top: 1em">
			<div class="container center">
				<h3 class="texto verdeIFtexto">Ocorrência</h3>
				<form action="acao.php" method="post">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">assignment</i>
							<textarea id="descricao" class="validate materialize-textarea" name="descricao" required></textarea>
							<label for="descricao">Descrição</label>
						</div>
						<div class="input-field col l4 m6 s12">
							<i class="material-icons prefix">date_range</i>
							<input type="text" class="datepicker grey-text text-darken-3" placeholder="Data da Ocorrência" id="dtOcorrencia" name="dtOcorrencia" data-mask="00/00/0000" value="<?php echo date('d/m/Y') ?>" required readonly>
						</div>
						<div class="input-field col l4 m6 s12">
							<?php 
								geraSelect('Tipo de Ocorrência', 'tpOcorrencia', 0, 0, 'descricao', 'tpOcorrencia');
							?>
						</div>
						<div class="input-field col l4 m6 s12">
							<?php 
								geraSelect('Criticidade', 'urgencia', 0, 0, 'urgencia', 'urgencia');
							?>
						</div>
						<div class="input-field col l6 offset-l3 m6 s12" style="margin-top: 5em">
							<button class="waves-effect waves-light btn verdeIF">
								<input type="submit" value="Cadastrar" name="Cadastrar" class="white-text">
							</button>

							<input type="hidden" name="acao" value="cadastrarOcorrencia">
							<input type="hidden" name="codigoAluno" value="<?php echo $codigoAluno ?>">
							<input type="hidden" name="codigoProfessor" value="<?php echo $codigoProfessor ?>">
							<input type="hidden" name="pagina" value="professor.php">
							<input type="hidden" name="tabela" value="ocorrencia">
						</div>
					</div>
				</form>
			</div>

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
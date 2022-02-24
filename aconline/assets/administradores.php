<?php 
	include('funcoes.php');
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
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

			<!-- Título -->
			<title>ADM | Administradores</title>

			<!-- Style -->
			<style type="text/css">
				.icone {font-size: 3rem;}
				.icone2 {font-size: 1.6rem;padding: 0rem 0rem;}
				a {text-decoration: none;color: #349A47;}
				body {background-image: url(img/.png);background-size: 100%;}
				main {min-height: 100vh;}
				.card-panel {padding-bottom: 3em;height: 35vh;margin-top: 3em;}
			</style>
		</head>

		<body>

			<header>
				<nav class="verdeIF">
					<div class="nav-wrapper black-text">
						<ul id="menu" class="sidenav">
							<li class="center" style="margin-bottom: 1rem"><a href="../assets/admin.php" style="color: #349A47">CONSELHO ONLINE</a></li>
							<li><a href="../assets/admin.php"><i class="material-icons">dashboard</i>Painel de Controle</a></li>
							<li style="background-color: rgba(0, 0, 0, 0.1);"><a href="../assets/administradores.php" style="color: #349A47"><i class="material-icons" style="color: #349A47">create</i>Administradores</a></li>
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
						<ul class="brand-logo right">
							<li><a href="cadastroADM.php" class="center"><i class="material-icons icone center">add_circle</i></a></li>
						</ul>
						<ul class="brand-logo hide-on-med-and-up">
							<li><a href="../assets/admin.php" class="texto link-logo">CONSELHO ONLINE</a></li>
						</ul>
					</div>
				</nav>
			</header>

			<main>
				<div class="container center">
				<h4 class="texto center" style="color: #349A47">Administradores</h4>
					<div class="row black-text center" style="margin-top: 5vh">
						<?php 
							Administradores();
						?>
						<div class="col s12 l4">
							<a href="cadastroADM.php" class="modal-trigger center">
								<div class="card-panel hoverable valign-wrapper center" style="width:100%; background: #349A47">
									<div class="row center" style="width:100%">
										<div class="col s12 center" style="color: #FFF">
											<i class="material-icons icone center">add_circle</i>
											<h5>Adicionar Administrador</h5>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>

				<div id="add" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<form action="acao.php" method="post">
								<h4 class="verdeIFtexto">Adicionar Administrador</h4>
								<div class="row">
									<div class="input-field col  m6 s12">
										<i class="material-icons prefix">person</i>
										<input id="icon_prefix" name="nome" type="text" class="validate" required>
										<label for="icon_prefix">Nome Completo</label>
									</div>
									<div class="input-field col  m6 s12">
										<i class="material-icons prefix">person_outline</i>
										<input id="user" type="text" class="validate" name="usuario" required>
										<label for="user">Usuário</label>
									</div>
									<div class="input-field col col  m6 s12">
										<i class="material-icons prefix">assignment</i>
										<input id="email" type="number" class="validate" name="email" required>
										<label for="email">Email</label>
									</div>
									<div class="input-field col  m6 s12">
										<i class="material-icons prefix">date_range</i>
										<input type="text" class="datepicker grey-text text-darken-3" placeholder="Data de Nascimento" id="data_nascimento" name="data_nascimento" data-mask="00/00/0000" required>
									</div>
									<div class="input-field col  m6 s12">
										<i class="material-icons prefix">lock</i>
										<input id="password" type="password" class="validate" name="senha" required>
										<label for="password">Senha</label>
									</div>
									<div class="input-field col  m6 s12">
										<i class="material-icons prefix">lock_outline</i>
										<input id="password2" type="password" class="validate" name="confirmacao" required>
										<label for="password2">Confirmar Senha</label>
									</div>
									<div class="file-field input-field">
										<div class="btn verdeIF">
											<span>Foto</span>
											<input type="file">
										</div>
										<div class="file-path-wrapper">
											<input class="file-path validate" type="text" placeholder="Upload de foto">
										</div>
									</div>
								</div>
								<div class="col s8 offset-s2 white-text">
									<input type="hidden" name="acao" value="adicionar_usuario">
									<button class="waves-effect waves-light btn verdeIF"><input type="submit" value="adicionar" class="white-text"></button>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</main>

			
			<footer class="page-footer black">
				<div class="container">
					<div class="right" style="padding-bottom: 1em">
						&copy;
						<script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>, Desenvolvido para <a href="http://www.ifc-riodosul.edu.br/site/">Instituto Federal Catarinense - Campus Rio do Sul</a>
					</div>
				</div>
			</footer>

			<!--  Scripts-->
			<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			<script src="../assets/js/materialize.js"></script>
			<script src="../assets/js/init.js"></script>
			<script type="text/javascript">
				function excluirRegistro(url){
					if (confirm("Confirmar Exclusão?"))
						location.href = url;
				}
			</script>
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
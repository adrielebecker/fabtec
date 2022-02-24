<?php
	include('funcoes.php');
	include('autoload.php');
	include('funcaoBanco.php');

	if ($_SESSION['ocupacao']==1)  $titulo="ADM";
	else $titulo="Professor";
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
			<title><?php echo $titulo ?> | Ocorrências</title>

			<!-- Style -->
			<style type="text/css">
				a {
					text-decoration: none;
					color: #349A47;
					background-color: transparent;
				}

				.pastas {
					background: #FFF;
				}
			</style>
		</head>

		<body>
			<header>
				<nav class="verdeIF">
					<div class="nav-wrapper black-text">
						<?php 
							if ($_SESSION['ocupacao']==1) {
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
						<ul class="right">
							<li><a href="#pesquisa" class="modal-trigger"><i class="material-icons">search</i></a></li>
						</ul>
						<ul class="brand-logo center hide-on-small-only">
							<li style="padding-right: 50em"><a href="../assets/admin.php" class="link-logo brand-logo center">Conselho Online</a></li>
						</ul>
						<ul class="brand-logo hide-on-med-and-up">
							<li><a href="../assets/admin.php" class="texto link-logo">CONSELHO ONLINE</a></li>
						</ul>
						<?php 
							}
							else{
						?>
						<ul id="menu" class="sidenav">
							<li class="center" style="margin-bottom: 1rem"><a href="#!" style="color: #349A47">CONSELHO ONLINE</a></li>
							<li><a href="professor.php"><i class="material-icons">dashboard</i>Perfil</a></li>
							<li style="background-color: rgba(0, 0, 0, 0.1);"><a href="" style="color: #349A47"><i class="material-icons" style="color: #349A47">gavel</i>Ocorrências</a></li>

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
						<ul class="right">
							<li><a href="#pesquisa" class="modal-trigger"><i class="material-icons">search</i></a></li>
						</ul>
						<ul class="brand-logo center hide-on-small-only">
							<li><a href="professor.php" class="link-logo brand-logo center">ConselhoOnline</a></li>
						</ul>
						<ul class="brand-logo hide-on-med-and-up">
							<li><a href="index.php" class="texto link-logo">CONSELHO ONLINE</a></li>
						</ul>
						<?php	
							}
						?>
					</div>
				</nav>
			</header>
			<?php 
				Ocorrencia($_SESSION['codigo'], $_SESSION['ocupacao'], isset($_POST['pesquisa'])?$_POST['pesquisa']:'', isset($_POST['radio'])?$_POST['radio']:'');
			?>
			<div id="pesquisa" class="modal center">
				<div class="modal-content">
					<fieldset style="border: none;">
						<form action="ocorrencia.php" method="post">
							<h4 class="verdeIFtexto"></h4>
							<div class="col s12 l4">
								<div class="valign-wrapper" style="width:100%; padding-bottom:1em">
									<div class="row" style="width:100%; padding-bottom: 2em">
										<div class="row" style="margin-top: 2em">
											<div class="container">
												<input type="text" name="pesquisa" id="pesquisa" placeholder="Pesquisa">
											</div>
										</div>
										<div class="input-field col s12" style="margin-top: 2em">
											<p>
												<div class="col s4">
													<label>
														<input class="with-gap" name="radio" id="radio" value="professor" type="radio"/>
														<span>Professor</span>
													</label>
												</div>
												<div class="col s4">
													<label>
														<input class="with-gap" name="radio" id="radio" value="aluno" type="radio"/>
														<span>Aluno</span>
													</label>
												</div>
												<div class="col s4">
													<label>
														<input class="with-gap" name="radio" id="radio" value="o.dtOcorrencia" type="radio"/>
														<span>Data da Ocorrência</span>
													</label>
												</div>
											</p>
										</div>
										<div class="input-field col l6 offset-l3 m6 s12">
											<button class="waves-effect waves-light btn verdeIF white-text" type="submit" value="<?php echo $acao ?>" name="<?php echo $acao ?>">
												Pesquisar
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</fieldset>
				</div>
			</div>

			<footer class="page-footer grey lighten-3 black-text">
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
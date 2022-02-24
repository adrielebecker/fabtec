<?php
	include('funcoes.php');
	include('autoload.php');
	include('funcaoBanco.php');

	$vetor=explode(':', Cadastro(isset($_GET['codigo']) ? $_GET['codigo'] : 0));
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
			<title>ADM | <?php echo $vetor[8]; ?> Técnico Administrativo</title>
		</head>
		<body>
			<header>
				<nav class="verdeIF">
					<div class="nav-wrapper black-text">
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
							<li><a href="tecsAdm.php" class="center">Técnicos Administrativos</a></li>
						</ul>
						<ul class="brand-logo hide-on-med-and-up">
							<li><a href="../assets/admin.php" class="texto link-logo">CONSELHO ONLINE</a></li>
						</ul>
					</div>
				</nav>
			</header>
			<br style="padding-top: 1em">
			<div class="container center">
				<h3 class="texto verdeIFtexto"><?php echo $vetor[8]; ?> Técnico Administrativo</h3>
				<?php 
					Erro(isset($_GET['erro'])?$_GET['erro']:0);
				?>
				<form action="acao.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="input-field col l4 m6 s12">
							<i class="material-icons prefix">assignment</i>
							<input id="matricula" type="number" class="validate" name="matricula" value="<?php echo $vetor[0] ?>" required>
							<label for="matricula">Matrícula</label>
						</div>
						<div class="input-field col l4 m6 s12">
							<i class="material-icons prefix">person</i>
							<input id="icon_prefix" name="nome" type="text" class="validate" value="<?php echo $vetor[1] ?>" required>
							<label for="icon_prefix">Nome Completo</label>
						</div>
						<div class="input-field col l4 m6 s12">
							<i class="material-icons prefix">person_outline</i>
							<input id="user" type="text" class="validate" name="usuario" value="<?php echo $vetor[2] ?>" required>
							<label for="user">Usuário</label>
						</div>
						<div class="input-field col col l4 m6 s12">
							<i class="material-icons prefix">mail</i>
							<input id="email" type="email" class="validate" name="email" value="<?php echo $vetor[3] ?>" required>
							<label for="email">Email</label>
						</div>
						<div class="input-field col l4 m6 s12">
							<i class="material-icons prefix">date_range</i>
							<input type="text" class="datepicker grey-text text-darken-3" placeholder="Data de Nascimento" id="dtNascimento" name="dtNascimento" data-mask="00/00/0000"  value="<?php echo $vetor[4] ?>" required>
						</div>
						<div class="input-field col l4 m6 s12">
							<i class="material-icons prefix">lock</i>
							<input id="password" type="password" class="validate" name="senha" value="" minlength="6" <?php if($vetor[7] == 'cadastrar') echo "required"; ?>>
							<label for="password">Senha (mínimo 6 carácteres)</label>
						</div>
						<div class="input-field col l4 m6 s12 offset-l2">
							<i class="material-icons prefix">lock_outline</i>
							<input id="password2" type="password" class="validate" name="confirmacao" value="" <?php if($vetor[7] == 'cadastrar') echo "required"; ?>>
							<label for="password2">Confirmar Senha</label>
						</div>
						<div class="input-field col s12 l4">
							<?php 
								if ($vetor[7] == 'cadastrar') {
									geraSelect("Profissão", "profissao", 0, 0, "nome", "profissao");
								}
								else{
									geraSelect("Profissão", "profissao", $vetor[10], 0, "nome", "profissao");
								}
							?>
						</div>
						<div class="file-field input-field col m6 s12 offset-l3">
							<div class="btn verdeIF">
								<span>Foto</span>
								<input name="foto" id="foto" type="file" value="<?php echo $vetor[5] ?>">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate"  type="text" placeholder="Upload de foto" value="">
							</div>
						</div>
						<div class="input-field col l6 offset-l3 m6 s12">
							<button class="waves-effect waves-light btn verdeIF white-text" type="submit" value="<?php echo $vetor[7] ?>" name="<?php echo $vetor[7] ?>">
								<?php echo $vetor[7]; ?>
							</button>

							<input type="hidden" name="acao" value="<?php echo $vetor[7] ?>">
							<input type="hidden" name="codigo" value="<?php echo $vetor[9] ?>">
							<input type="hidden" name="pagina" value="tecsAdm.php">
							<input type="hidden" name="tabela" value="usuario">
							<input type="hidden" name="ocupacao" value=4>
						</div>
					</div>
				</form>
			</div>

			<!--  Scripts-->
			<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			<script src="../assets/js/materialize.js"></script>
			<script src="../assets/js/init.js"></script>
			<script src="../assets/js/jquery.mask.min.js"></script>
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
	</hmtl>
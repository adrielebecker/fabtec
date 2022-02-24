<!DOCTYPE html>
	<?php
	?>
	<html lang="pt-BR">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />

		<link rel="shortcut icon" type="imagem/x-icon" href="img/icon.png">


		<!-- CSS  -->
		<link href="../../assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="../../assets/css/css.css" type="text/css" rel="stylesheet" media="screen,projection">

		<!-- Fontes -->
		<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<title>Cadastro | ADMIN</title>
	</head>
	<body>
		<header>
			<nav>
				<div class="nav-wrapper white black-text">
					<div class="container">
						<ul id="nav-mobile" class="sidenav">
							<li><a href="#login" class="modal-trigger"><i class="material-icons cyan-text">person</i> Entrar</a></li>
							<li><a href="sobre.php"><i class="material-icons cyan-text">info</i> Sobre</a></li>
						</ul>
						<a href="#" data-target="nav-mobile" class="sidenav-trigger cyan-text"><i class="material-icons">menu</i></a>

						<ul class="left">
							<li><a href="index.php" class="texto cyan-text brand-logo">APPROUVER</a></li>
						</ul>
						<ul class="right hide-on-med-and-down">
							<li><a href="#login" class="modal-trigger cyan-text">Entrar</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<br style="padding-top: 1em">
		<div class="container center">
			<h3 class="texto cyan-text">Cadastro</h3>
			<form action="acao.php" method="post">
				<div class="row">
					<div class="input-field col col l4 m6 s12">
						<i class="material-icons prefix">assignment</i>
						<input id="matricula" type="number" class="validate" name="matricula" required>
						<label for="matricula">Matrícula</label>
					</div>
					<div class="input-field col l4 m6 s12">
						<i class="material-icons prefix">person</i>
						<input id="icon_prefix" name="nome" type="text" class="validate" required>
						<label for="icon_prefix">Nome Completo</label>
					</div>
					<div class="input-field col l4 m6 s12">
						<i class="material-icons prefix">person_outline</i>
						<input id="user" type="text" class="validate" name="usuario" required>
						<label for="user">Usuário</label>
					</div>
					<div class="input-field col l4 m6 s12">
						<i class="material-icons prefix">date_range</i>
						<input type="text" class="datepicker grey-text text-darken-3" placeholder="Data de Nascimento" id="data_nascimento" name="data_nascimento" data-mask="00/00/0000" required>
					</div>
					<div class="input-field col l4 m6 s12">
						<i class="material-icons prefix">lock</i>
						<input id="password" type="password" class="validate" name="senha" required>
						<label for="password">Senha</label>
					</div>
					<div class="input-field col l4 m6 s12">
						<i class="material-icons prefix">lock_outline</i>
						<input id="password2" type="password" class="validate" name="confirmacao" required>
						<label for="password2">Confirmar Senha</label>
					</div>
					<div class="input-field col l6 m6 s12 offset-l3">
						<div class="left">
							<label>
								<input type="radio" name="ocupacao" id="ocupacao" value="1" class="with-gap" required>
								<span>Professor</span>
							</label>
						</div>
						<div>
							<label class="right">
								<input type="radio" name="ocupacao" id="ocupacao" value="0" class="with-gap" required>
								<span>Aluno</span>
							</label>
						</div>
					</div>
					<div class="input-field col l6 offset-l3 m6 s12">
						<button class="waves-effect waves-light btn cyan">
							<input type="submit" value="cadastrar" name="cadastrar" class="white-text">
						</button>
						<input type="hidden" name="acao" value="cadastrar">
						<input type="hidden" name="pagina" value="cadastro.php">
						<input type="hidden" name="tabela" value="alunos">
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
<?php
	include('autoload.php');

	function Administradores(){
		$banco = new banco;

		$vetor = $banco->select("select u.* from usuario u, ocupacao o where u.ocupacao = 1 group by u.codigo order by u.nome");
		if (isset($vetor)) {
			for ($i=0; $i < count($vetor); $i++) {
				$location1 = "'acaoLogin.php?acao=excluir_adm&codigo=" .$vetor[$i]['codigo']. "'";
				echo '
					<div class="col s12 l4">
						<div class="card-panel hoverable valign-wrapper" style="width:100%;">
							<div class="row" style="width:100%; padding-bottom: 2em">
								<div class="col s12">
									<div class="col s6 offset-s3">';
										if ($vetor[$i]['foto'] != '') {
											echo '<img class="responsive-img circle" src="upload/' .$vetor[$i]['foto']. '">';
										}
										else{
											echo '<img class="responsive-img circle" src="upload/default.png">';
										}
									echo '</div>
									<div class="col s12" style="margin-top: -1em">
										<h5 class="flow-text verdeIFtexto">' .$vetor[$i]['nome']. '</h5>
									</div>
									<h6 class="flow-text grey-text" style="font-size: 0.9em">' .$vetor[$i]['email']. '</h6>
									<p>
										<a href="cadastroADM.php?codigo='.$vetor[$i]['codigo'].'" class=""><i class="material-icons icone2">create</i></a>
										<a href="javascript:excluirRegistro('.$location1.')"><i class="material-icons icone2">delete</i></a>
									</p>
								</div>
							</div>
						</div>
					</div>';

				echo '<div id="editar-'.$vetor[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<form action="acaoLogin.php" method="post">
								<h4 class="blue-text">Alterar Turma</h4>
								<div class="row center">
									<div class="col s8 offset-s2">
										<input type="text" value="'.$vetor[$i]['nome'].'" name="nome">
									</div>			
									<div class="col s8 offset-s2 white-text input-field">
										<input type="hidden" name="tabela" value="turma">
										<input type="hidden" name="codigo" value="'.$vetor[$i]['codigo'].'">
										<input type="hidden" name="acao" value="alterar_turma">
										<button class="waves-effect waves-light btn blue"><input type="submit" value="salvar" class="white-text"><i class="material-icons right">send</i></button>
									</div>		
								</div>
							</form>
						</fieldset>
					</div>
				</div>';
			}
		}
	}

	function Professores(){
		$banco = new banco;
		
		$vetor = $banco->select("select u.* from usuario u, ocupacao o where u.ocupacao = 2 group by u.codigo order by u.nome");
		if (isset($vetor)) {
			for ($i=0; $i < count($vetor); $i++) {
				$location1 = "'acaoLogin.php?acao=excluir_professor&codigo=" .$vetor[$i]['codigo']. "'";
				echo '
					<div class="col s12 l4">
						
							<div class="card-panel hoverable valign-wrapper" style="width:100%;">
								<div class="row" style="width:100%">
									<div class="col s12">
										<div class="row">
											<div class="col s6 offset-s3">';
												if ($vetor[$i]['foto'] != '') {
													echo '<img class="responsive-img circle" src="upload/' .$vetor[$i]['foto']. '">';
												}
												else{
													echo '<img class="responsive-img circle" src="upload/default.png">';
												}
											echo '</div>
										</div>
										<h5 class="flow-text verdeIFtexto">' .$vetor[$i]['nome']. '</h5>
										<h6 class="flow-text grey-text" style="font-size: 0.9em">' .$vetor[$i]['email']. '</h6>
										<p>
											<a href="#disciplinas-'.$vetor[$i]['codigo'].$vetor[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">class</i></a>
											<a href="#professor-'.$vetor[$i]['codigo'].$vetor[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">people</i></a>
											<a href="cadastroProfessor.php?codigo='.$vetor[$i][0].'" class=""><i class="material-icons icone2">create</i></a>
											<a href="javascript:excluirRegistro('.$location1.')"><i class="material-icons icone2">delete</i></a>
										</p>
									</div>
								</div>
							</div>
					</div>';

				echo '<div id="disciplinas-'.$vetor[$i]['codigo'].$vetor[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<h4 class="verdeIFtexto">Disciplinas de '.$vetor[$i]['nome'].'</h4>';
							$vetor_pd = $banco->select("select d.* from usuario u, disciplina d, professor_has_disciplina pd where d.codigo = pd.codigoDisciplina and pd.codigoUsuario = ".$vetor[$i]['0']." group by d.codigo order by d.nome");
							if (isset($vetor_pd)) {
								for ($j=0; $j < count($vetor_pd); $j++) {
									echo '<div class="col s12 l4">
										<div>
											<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
												<div class="row" style="width:100%; padding-bottom: 2em">
													<div class="col s12">
														<div class="col s6">
															<h4 class="verdeIFtexto center" style="font-style: normal; font-size: 5vh">'.$vetor_pd[$j]['nome'].'</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="professor-'.$vetor[$i]['codigo'].$vetor[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<h4 class="verdeIFtexto">Turmas de '.$vetor[$i]['nome'].'</h4>';
							$vetor_tp = $banco->select("select t.*, c.* from usuario u, turma t, curso c, turma_has_professor tp where tp.codigoUsuario = ".$vetor[$i]['0']." and tp.codigoTurma = t.codigo group by t.codigo order by t.ano");
							if (isset($vetor_tp)) {
								for ($j=0; $j < count($vetor_tp); $j++) {
									echo '<div class="col s12 l4 verdeIFtexto">
										<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
											<div class="row" style="width:100%; padding-bottom: 2em">
												<div class="col s12">
													<div class="col s6 offset-s3">
														<i class="center icone" style="font-style: normal">'.$vetor_tp[$j]['ano'].'º</i>
													</div>
													<div class="col s12" style="margin-top: -1em">
														<h5 class="flow-text">' .$vetor_tp[$j]['abreviacao']. '</h5>
													</div>
												</div>
											</div>
										</div>
									</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="editar-'.$vetor[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<form action="acaoLogin.php" method="post">
								<h4 class="blue-text">Alterar Turma</h4>
								<div class="row center">
									<div class="col s8 offset-s2">
										<input type="text" value="'.$vetor[$i]['nome'].'" name="nome">
									</div>			
									<div class="col s8 offset-s2 white-text input-field">
										<input type="hidden" name="tabela" value="turma">
										<input type="hidden" name="codigo" value="'.$vetor[$i]['codigo'].'">
										<input type="hidden" name="acao" value="alterar_turma">
										<button class="waves-effect waves-light btn blue"><input type="submit" value="salvar" class="white-text"><i class="material-icons right">send</i></button>
									</div>		
								</div>
							</form>
						</fieldset>
					</div>
				</div>';
			}
		}
	}

	function Alunos(){
		$banco = new banco;
		
		$vetor_aluno = $banco->select("select u.* from usuario u, ocupacao o where u.ocupacao = 3 group by u.codigo order by u.nome");
		if (isset($vetor_aluno)) {
			for ($i=0; $i < count($vetor_aluno); $i++) {
				$location1 = "'acaoLogin.php?acao=excluir_aluno&codigo=" .$vetor_aluno[$i]['codigo']. "'";
				echo '
					<div class="col s12 l4">
					
						<div class="card-panel hoverable valign-wrapper" style="width:100%;">
							<div class="row" style="width:100%">
								<div class="col s12">
									<div class="row">
										<div class="col s6 offset-s3">';
											if ($vetor_aluno[$i]['foto'] != '') {
												echo '<img class="responsive-img circle" src="upload/' .$vetor_aluno[$i]['foto']. '">';
											}
											else{
												echo '<img class="responsive-img circle" src="upload/default.png">';
											}
										echo '</div>
									</div>
									<h5 class="flow-text verdeIFtexto">' .$vetor_aluno[$i]['nome']. '</h5>
									<h6 class="flow-text grey-text" style="font-size: 0.9em">' .$vetor_aluno[$i]['email']. '</h6>
									<p>
										<a href="cadastroAluno.php?codigo='.$vetor_aluno[$i][0].'" class="modal-trigger"><i class="material-icons icone2">create</i></a>
										<a href="javascript:excluirRegistro('.$location1.')"><i class="material-icons icone2">delete</i></a>
									</p>
								</div>
							</div>
						</div>
				</div>';
			}
		}
	}

	function TecsAdm(){
		$banco = new banco;
		
		$vetor_servidor = $banco->select("select u.*, p.* from usuario u, profissao p, usuario_has_profissao up where u.ocupacao = 4 and u.codigo = up.codigoUsuario and up.codigoProfissao = p.codigo group by u.codigo order by u.nome");
		if (isset($vetor_servidor)) {
			for ($i=0; $i < count($vetor_servidor); $i++) {
				$location1 = "'acaoLogin.php?acao=excluir_servidor&codigo=" .$vetor_servidor[$i]['codigo']. "'";
				echo '
					<div class="col s12 l4">
							<div class="card-panel hoverable valign-wrapper" style="width:100%;">
								<div class="row" style="width:100%">
									<div class="col s12">
										<div class="row">
											<div class="col s6 offset-s3">';
												if ($vetor_servidor[$i]['foto'] != '') {
													echo '<img class="responsive-img circle" src="upload/' .$vetor_servidor[$i]['foto']. '">';
												}
												else{
													echo '<img class="responsive-img circle" src="upload/default.png">';
												}
											echo '</div>
										</div>
										<h5 class="flow-text verdeIFtexto">' .$vetor_servidor[$i]['1']. '</h5>
										<h6 class="flow-text grey-text" style="font-size: 0.9em">' .$vetor_servidor[$i]['email']. '</h6>
										<h6 class="flow-text grey-text" style="font-size: 0.9em">' .$vetor_servidor[$i]['10']. '</h6>
										<p>
											<a href="cadastroTecAdm.php?codigo='.$vetor_servidor[$i][0].'" class="modal-trigger"><i class="material-icons icone2">create</i></a>
											<a href="javascript:excluirRegistro('.$location1.')"><i class="material-icons icone2">delete</i></a>
										</p>
									</div>
								</div>
							</div>
					</div>';

				echo '<div id="disciplinas-'.$vetor_servidor[$i]['codigo'].$vetor_servidor[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<h4 class="verdeIFtexto">Disciplinas de '.$vetor_servidor[$i]['nome'].'</h4>';
							$vetor_pd = $banco->select("select d.* from usuario u, disciplina d, professor_has_disciplina pd where d.codigo = pd.codigoDisciplina and pd.codigoUsuario = ".$vetor_servidor[$i]['0']." group by d.codigo order by d.nome");
							if (isset($vetor_pd)) {
								for ($j=0; $j < count($vetor_pd); $j++) {
									echo '<div class="col s12 l4">
										<a href="'.$vetor_pd[$j][0].'.php">
											<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
												<div class="row" style="width:100%; padding-bottom: 2em">
													<div class="col s12">
														<div class="col s6 offset-s3">
															<h4 class="verdeIFtexto">'.$vetor_pd[$j]['nome'].'</h4>
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="professor-'.$vetor_servidor[$i]['codigo'].$vetor_servidor[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<h4 class="verdeIFtexto">Turmas de '.$vetor_servidor[$i]['nome'].'</h4>';
							$vetor_tp = $banco->select("select t.*, c.* from usuario u, turma t, curso c, turma_has_servidor tp where u.codigo = tp.codigoUsuario and tp.codigoUsuario = ".$vetor_servidor[$i]['0']." group by t.codigo order by t.ano");
							if (isset($vetor_tp)) {
								for ($j=0; $j < count($vetor_tp); $j++) {
									echo '<div class="col s12 l4">
										<a href="'.$vetor_tp[$j][0].'.php">
											<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
												<div class="row" style="width:100%; padding-bottom: 2em">
													<div class="col s12">
														<div class="col s6 offset-s3">
															<i class="center icone" style="font-style: normal">'.$vetor_tp[$j]['ano'].'º</i>
														</div>
														<div class="col s12" style="margin-top: -1em">
															<h5 class="flow-text">' .$vetor_tp[$j]['abreviacao']. '</h5>
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="editar-'.$vetor_servidor[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<form action="acaoLogin.php" method="post">
								<h4 class="blue-text">Alterar Turma</h4>
								<div class="row center">
									<div class="col s8 offset-s2">
										<input type="text" value="'.$vetor_servidor[$i]['nome'].'" name="nome">
									</div>			
									<div class="col s8 offset-s2 white-text input-field">
										<input type="hidden" name="tabela" value="turma">
										<input type="hidden" name="codigo" value="'.$vetor_servidor[$i]['codigo'].'">
										<input type="hidden" name="acao" value="alterar_turma">
										<button class="waves-effect waves-light btn blue"><input type="submit" value="salvar" class="white-text"><i class="material-icons right">send</i></button>
									</div>		
								</div>
							</form>
						</fieldset>
					</div>
				</div>';
			}
		}
	}

	function Turmas(){
		$banco = new banco;
		
		$vetor_turmas = $banco->select("select t.*, c.* from turma t, curso c where t.curso = c.codigo order by t.codigo");
		if (isset($vetor_turmas)) {
			for ($i=0; $i < count($vetor_turmas); $i++) {
				$location1 = "'acaoLogin.php?acao=excluir_turma&codigo=" .$vetor_turmas[$i]['0']. "'";
				echo '
					<div class="col s12 l4 verdeIFtexto">
						<div class="card-panel hoverable valign-wrapper" style="width:100%">
							<div class="row" style="width:100%">
								<div class="col s12">
									<i class="center icone" style="font-style: normal">'.$vetor_turmas[$i]['ano'].'º</i>
									<h5 class="flow-text">' .$vetor_turmas[$i]['abreviacao']. '</h5>
									<p>
										<!--<a href="#disciplinas-'.$vetor_turmas[$i]['ano'].$vetor_turmas[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">folder</i></a>-->
										<a href="#alunos-'.$vetor_turmas[$i]['ano'].$vetor_turmas[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">people</i></a>
										<!-- <a href="#editar-'.$vetor_turmas[$i]['ano'].$vetor_turmas[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">create</i></a> -->
										<a href="javascript:excluirRegistro('.$location1.')"><i class="material-icons icone2">delete</i></a>
									</p>
								</div>
							</div>
						</div>
					</div>';

				echo '<div id="alunos-'.$vetor_turmas[$i]['ano'].$vetor_turmas[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<h4 class="verdeIFtexto">Alunos do '.$vetor_turmas[$i]['ano'].'º '.$vetor_turmas[$i]['abreviacao'].'</h4>';
							$vetor_ta = $banco->select("select u.* from usuario u, turma t, turma_has_aluno ta where u.codigo = ta.codigoUsuario and ta.codigoTurma = ".$vetor_turmas[$i]['0']." group by u.codigo order by u.nome");
							if (isset($vetor_ta)) {
								for ($j=0; $j < count($vetor_ta); $j++) {
									echo '<div class="col s12 l4 verdeIFtexto">
											<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
												<div class="row" style="width:100%; padding-bottom: 2em">
													<div class="col s12">
														<div class="col s6 offset-s3">
															<img class="responsive-img circle" src="upload/' .$vetor_ta[$j]['foto']. '">
														</div>
														<div class="col s12" style="margin-top: -1em">
															<h5 class="flow-text">' .$vetor_ta[$j]['nome']. '</h5>
														</div>
														<div class="center">
															<h6 class="flow-text grey-text" style="font-size: 0.9em">' .$vetor_ta[$j]['email']. '</h6>
														</div>
													</div>
												</div>
											</div>
										</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="disciplinas-'.$vetor_turmas[$i]['ano'].$vetor_turmas[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<h4 class="verdeIFtexto">Disciplinas do '.$vetor_turmas[$i]['ano'].'º '.$vetor_turmas[$i]['abreviacao'].'</h4>';
							$vetor_td = $banco->select("select d.* from disciplina d, turma t, turma_has_disciplina td where td.codigoTurma = ".$vetor_turmas[$i]['0']." and d.codigo = td.codigoDisciplina group by d.codigo order by d.nome");
							if (isset($vetor_td)) {
								for ($j=0; $j < count($vetor_td); $j++) {
									echo '<div class="col s12 l4 verdeIFtexto">
											<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
												<div class="row" style="width:100%; padding-bottom: 2em">
													<div class="col s12">
														<div class="col s12" style="margin-top: -1em">
															<h5 class="flow-text">' .$vetor_td[$j]['nome']. '</h5>
														</div>
													</div>
												</div>
											</div>
										</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="editar-'.$vetor_turmas[$i]['ano'].$vetor_turmas[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<form action="acaoLogin.php" method="post">
								<h4 class="verdeIFtexto">Alterar Turma</h4>
								<div class="row center">
									<div class="input-field col s6 offset-s3">
										<select name="ano" id="ano">
											<option value="" disabled>Ano</option>
											<option class="verdeIFtexto" value="1"';
											if ($vetor_turmas[$i]['ano'] == 1) {
												echo " selected ";
											}
											echo '>1º</option>
											<option class="verdeIFtexto" value="2"';
											if ($vetor_turmas[$i]['ano'] == 2) {
												echo " selected ";
											}
											echo '>2º</option>
											<option class="verdeIFtexto" value="3"';
											if ($vetor_turmas[$i]['ano'] == 3) {
												echo " selected ";
											}
											echo '>3º</option>
										</select>
									</div>
									<div class="input-field col s6 offset-s3">';
										geraSelect('Curso', 'curso', $vetor_turmas[$i]['3'], 0, 'nome', 'curso');
									echo '</div>	
									<div class="col s8 offset-s2 white-text input-field">
										<input type="hidden" name="tabela" value="turma">
										<input type="hidden" name="codigo" value="'.$vetor_turmas[$i]['0'].'">
										<input type="hidden" name="acao" value="alterar_turma">
										<button class="waves-effect waves-light btn verdeIF"><input type="submit" value="alterar" class="white-text"></button>
									</div>		
								</div>
							</form>
						</fieldset>
					</div>
				</div>';
			}
		}
	}

	function Disciplinas(){
		$banco = new banco;
		
		$vetor_disciplinas = $banco->select("select * from disciplina order by nome");
		if (isset($vetor_disciplinas)) {
			for ($i=0; $i < count($vetor_disciplinas); $i++) {
				$location1 = "'acaoLogin.php?acao=excluir_disciplina&codigo=" .$vetor_disciplinas[$i]['0']. "'";
				echo '
					<div class="col s12 l4 verdeIFtexto">
					<div class="card-panel hoverable valign-wrapper" style="width:100%">
						<div class="row" style="width:100%">
							<div class="col s12">
								<h1 class="center icone">'.$vetor_disciplinas[$i]['nome'].'</h1>
								<p>
									<a href="#professores-'.$vetor_disciplinas[$i]['codigo'].$vetor_disciplinas[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">person</i></a>
									<a href="#disciplinas-'.$vetor_disciplinas[$i]['codigo'].$vetor_disciplinas[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">people</i></a>
									<!-- <a href="#editar-'.$vetor_disciplinas[$i]['codigo'].$vetor_disciplinas[$i]['nome'].'" class="modal-trigger"><i class="material-icons icone2">create</i></a> -->
									<a href="javascript:excluirRegistro('.$location1.')"><i class="material-icons icone2">delete</i></a>
								</p>
							</div>
						</div>
					</div>
				</div>';

				echo '<div id="professores-'.$vetor_disciplinas[$i]['codigo'].$vetor_disciplinas[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">';
							$vetor_pd = $banco->select("select u.* from usuario u, disciplina d, professor_has_disciplina pd where u.codigo = pd.codigoUsuario and pd.codigoDisciplina = ".$vetor_disciplinas[$i]['0']." group by u.codigo order by u.nome");
							if (isset($vetor_pd)) {
								for ($j=0; $j < count($vetor_pd); $j++) {
									echo '<div class="col s12 l4">
										<a href="'.$vetor_pd[$j][0].'.php">
											<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
												<div class="row" style="width:100%; padding-bottom: 2em">
													<div class="col s12">
														<div class="col s6 offset-s3">
															<img class="responsive-img circle" src="upload/' .$vetor_pd[$j]['foto']. '">
														</div>
														<div class="col s12" style="margin-top: -1em">
															<h5 class="flow-text">' .$vetor_pd[$j]['nome']. '</h5>
														</div>
														<div class="center">
															<h6 class="flow-text grey-text" style="font-size: 0.9em">' .$vetor_pd[$j]['email']. '</h6>
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="disciplinas-'.$vetor_disciplinas[$i]['codigo'].$vetor_disciplinas[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<h4 class="verdeIFtexto">Disciplinas de '.$vetor_disciplinas[$i]['nome'].'</h4>';
							$banco3 = new banco;
							$vetor_td = $banco3->select("select t.*, c.* from turma t, curso c, turma_has_disciplina td where t.codigo = td.codigoTurma and td.codigoDisciplina = ".$vetor_disciplinas[$i]['0']." group by t.codigo order by t.ano");
							if (isset($vetor_td)) {
								for ($j=0; $j < count($vetor_td); $j++) {
									echo '<div class="col s12 l4">
										<a href="'.$vetor_td[$j][0].'.php">
											<div class="card-panel hoverable valign-wrapper" style="width:100%; padding-bottom:1em">
												<div class="row" style="width:100%; padding-bottom: 2em">
													<div class="col s12">
														<div class="col s6 offset-s3">
															<i class="center icone" style="font-style: normal">'.$vetor_td[$j]['ano'].'º</i>
														</div>
														<div class="col s12" style="margin-top: -1em">
															<h5 class="flow-text">' .$vetor_td[$j]['nome']. '</h5>
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>';
								}
							}
				echo '
						</fieldset>
					</div>
				</div>';

				echo '<div id="editar-'.$vetor_disciplinas[$i]['codigo'].$vetor_disciplinas[$i]['nome'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<form action="acaoLogin.php" method="post">
								<h4 class="verdeIFtexto">Alterar Disciplina</h4>
								<div class="row center">
									<div class="input-field col s6 offset-s3">
										<input type="text" name="nome" id="nome" value="'.$vetor_disciplinas[$i]['nome'].'">
										<label for="nome">Nome</label>
									</div>
									<div class="col s8 offset-s2 white-text input-field">
										<input type="hidden" name="tabela" value="disciplina">
										<input type="hidden" name="codigo" value="'.$vetor_disciplinas[$i]['0'].'">
										<input type="hidden" name="acao" value="alterar_disciplina">
										<button class="waves-effect waves-light btn verdeIF"><input type="submit" value="alterar" class="white-text"></button>
									</div>		
								</div>
							</form>
						</fieldset>
					</div>
				</div>';
			}
		}
	}

	function tpOcorrencias(){
		$banco = new banco;
		
		$vetor_tpOcorrencia = $banco->select("select tpo.* from tpOcorrencia tpo order by descricao");
		if (isset($vetor_tpOcorrencia)) {
			for ($i=0; $i < count($vetor_tpOcorrencia); $i++) {
				$location1 = "'acaoLogin.php?acao=excluir_tpOcorrencia&codigo=" .$vetor_tpOcorrencia[$i]['0']. "'";
				echo '
					<div class="col s12 l4">
					<a href="'.$vetor_tpOcorrencia[$i][0].'.php">
						<div class="card-panel hoverable valign-wrapper" style="width:100%">
							<div class="row" style="width:100%">
								<div class="col s12">
									<h5 class="flow-text">' .$vetor_tpOcorrencia[$i]['descricao']. '</h5>
									<p>
										<!--<a href="#editar-'.$vetor_tpOcorrencia[$i]['codigo'].'" class="modal-trigger"><i class="material-icons icone2">create</i></a>-->
										<a href="javascript:excluirRegistro('.$location1.')"><i class="material-icons icone2">delete</i></a>
									</p>
								</div>
							</div>
						</div>
					</a>
				</div>';

				echo '<div id="editar-'.$vetor_tpOcorrencia[$i]['codigo'].'" class="modal center">
					<div class="modal-content">
						<fieldset style="border: none;">
							<form action="acaoLogin.php" method="post">
								<h4 class="verdeIFtexto">Alterar Tipo de Ocorrência</h4>
								<div class="row center">
									<div class="input-field col s6 offset-s3">
										<textarea class="materialize-textarea" name="descricao" id="descricao">'.$vetor_tpOcorrencia[$i]['descricao'].'</textarea>
										<label for="descricao">Descrição</label>
									</div>	
									<div class="col s8 offset-s2 white-text input-field">
										<input type="hidden" name="tabela" value="tpOcorrencia">
										<input type="hidden" name="codigo" value="'.$vetor_tpOcorrencia[$i]['0'].'">
										<input type="hidden" name="acao" value="alterar_tpOcorrencia">
										<button class="waves-effect waves-light btn verdeIF">
											<input type="submit" value="alterar" class="white-text">
										</button>
									</div>		
								</div>
							</form>
						</fieldset>
					</div>
				</div>';
			}
		}
	}
	
	function PerfilAluno($codigo){
		echo '<div class="page-header clear-filter page-header-small" filter-color="">
          <div class="page-header-image" data-parallax="true" style="background-image:url(../assets/img/login.jpg);">
          </div>
          <div class="container">';
              $banco = new banco;
              $vetor_aluno = $banco->select("select u.* from usuario u where u.codigo = ".$codigo);
              if (isset($vetor_aluno)) {
				for ($i=0; $i < count($vetor_aluno); $i++) {
            echo '<div class="photo-container">';
				if($vetor_aluno[$i]['foto']!=''){
					echo '<img src="../assets/upload/'.$vetor_aluno[$i]['foto'].'" alt="">';
				}
				else{
					echo '<img src="../assets/upload/default.png" alt="">';
				}
            echo '</div>
            <h3 class="title" style="margin-top: -1em">'.$vetor_aluno[$i]['nome'].'</h3>
            <p style="font-weight: bold; color: #CCC; margin-top: -1em">';
              $vetor_turma = $banco->select("select t.*, c.* from turma t, curso c, turma_has_aluno ta where t.curso = c.codigo and ta.codigoTurma = t.codigo and ta.codigoUsuario = ".$codigo);
              if (isset($vetor_turma)) {
                for ($j=0; $j < count($vetor_turma); $j++) {
                  echo $vetor_turma[$j]['ano']."º ".$vetor_turma[$j]['abreviacao'];
                  $turma[$j]=$vetor_turma[$j]['codigo'];
                }
              }
            echo '</p>
            <div class="content">';
                $vetor_nota = $banco->select("select avg(o.nota), count(o.codigo) from ocorrencia o where o.codigoAluno = ".$codigo);
                if (isset($vetor_nota)) {
                  for ($k=0; $k < count($vetor_nota); $k++) {
              echo '<div class="social-description">
                <h2>'.$vetor_nota[$k][1].'</h2>
                <p>';
                    if ($vetor_nota[$k][1] == 1) echo "Ocorrência atribuída";
                    else echo "Ocorrências atribuídas";
                echo '</p>
              </div>
            </div>
          </div>';
              }
            }
        echo '</div>
            <div class="section section-tabs" id="professores">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 ml-auto col-xl-12">
                    <p class="category">Meus Professores</p>
                    <div class="card">
                      <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content text-center">
                          <div class="tab-pane active" id="turma'.$turma[$i].'" role="tabpanel">
                              <div class="col-sm-12">
                                <div class="row collections">';
                                	$sql = "
                                      select u.codigo, u.nome, u.email, u.matricula, u.usuario, u.senha, u.dtNascimento, u.foto, u.ocupacao 
                                        from usuario u, 
                                             disciplina d, 
                                             professor_has_disciplina pd, 
                                             aluno_has_disciplina ad 
                                       where ad.codigoUsuario = ".$codigo." 
                                         and ad.codigoDisciplina = d.codigo 
                                         and pd.codigoDisciplina = d.codigo 
                                         and pd.codigoUsuario = u.codigo 
                                    group by u.codigo 
                                    order by u.nome";

                                    $vetor_professor = $banco->select($sql);
                                    if (isset($vetor_professor)) {
                                      for ($j=0; $j < count($vetor_professor); $j++) {
                                  echo '<div class="col-sm-6 col-md-2" style="margin-top: 3vh"><!--começo-->
                                    <div class="col-sm-12">
                                        <a href="cadastroNota.php?codigoProfessor='.$vetor_professor[$j][0].'" class="team">
                                        <div class="team-player">';
                                            if ($vetor_professor[$j]['foto']!='') {
                                              echo "<img src='upload/".$vetor_professor[$j]['foto']."' alt='".$vetor_professor[$j]['nome']."' class='rounded-circle img-fluid img-raised'>";
                                            }
                                            else{
                                              echo "<img src='upload/default.png' alt='".$vetor_professor[$j]['nome']."' class='rounded-circle img-fluid img-raised'>";
                                            }
                                            echo "<h4 class='title' style='margin-top: -2em'>".$vetor_professor[$j]['nome']."</h4>";
                                        echo '</div>
                                      </a>
                                    </div>
                                  </div>'; 
                                      }
                                    }
                                echo '</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
				}
			  }
                echo '</div>
              </div>';
	}
	
	function PerfilProfessor($codigo){
		echo '<div class="page-header clear-filter page-header-small" filter-color="">
          <div class="page-header-image" data-parallax="true" style="background-image:url(../assets/img/login.jpg);">
          </div>
          <div class="container">';
              $banco = new banco;
              $vetor_professores = $banco->select("select u.* from usuario u where u.codigo = ".$codigo);
              if (isset($vetor_professores)) {
                for ($i=0; $i < count($vetor_professores); $i++) {
            echo '<div class="photo-container">';
					if($vetor_professores[$i]['foto']!=''){
						echo '<img src="../assets/upload/'.$vetor_professores[$i]['foto'].'" alt="">';
					}
					else{
						echo '<img src="../assets/upload/default.png" alt="">';
					}
            echo '</div>
            <h3 class="title" style="margin-top: -1em">'.$vetor_professores[$i]["nome"].'</h3>
            <p style="font-weight: bold; color: #CCC; margin-top: -1em">';
              $vetor_disciplina = $banco->select("select d.* from disciplina d, professor_has_disciplina pd where pd.codigoDisciplina = d.codigo and pd.codigoUsuario = ".$codigo);
              if (isset($vetor_disciplina)) {
                for ($j=0; $j < count($vetor_disciplina); $j++) {
                  if (count($vetor_disciplina) == 2) {
                    if ($j == 1) {
                      echo " e ";
                    }
                  }
                  elseif (count($vetor_disciplina) > 2) {
                    if ($j == count($vetor_disciplina)-1) {
                      echo " e ";
                    }
                    elseif($j > 0){
                      echo ", ";
                    }
                  }
                  echo $vetor_disciplina[$j]['nome'];
                }
              }
            echo '</p>
            <div class="content">';
                $vetor_nota = $banco->select("select avg(n.nota), count(n.codigo) from nota n where n.codigoProfessor = ".$codigo);
                if (isset($vetor_nota)) {
                  for ($k=0; $k < count($vetor_nota); $k++) {
              echo '<div class="social-description">
                <h2>'.$vetor_nota[$k][1].'</h2>
                <p>';
                    if ($vetor_nota[$k][1] == 1) echo "Nota atribuída";
                    else echo "Notas atribuídas";
                echo '</p>
              </div>
            </div>
          </div>
        </div>
        <div class="section">
          <div class="container center">
            <div class="estrelas text-center" style="margin-top: -3em">
              <input type="radio" id="cm_star-empty" name="fb" value="" checked/>
              <label for="cm_star-1"><i class="fa"></i></label>
              <input type="radio" id="cm_star-1" name="fb" value="1"'; if(floor($vetor_nota[$k][0]) == 1) echo " checked "; echo ' disabled/>
              <label for="cm_star-2"><i class="fa"></i></label>
              <input type="radio" id="cm_star-2" name="fb" value="2"'; if(floor($vetor_nota[$k][0]) == 2) echo " checked "; echo ' disabled/>
              <label for="cm_star-3"><i class="fa"></i></label>
              <input type="radio" id="cm_star-3" name="fb" value="3"'; if(floor($vetor_nota[$k][0]) == 3) echo " checked "; echo ' disabled/>
              <label for="cm_star-4"><i class="fa"></i></label>
              <input type="radio" id="cm_star-4" name="fb" value="4"'; if(floor($vetor_nota[$k][0]) == 4) echo " checked "; echo ' disabled/>
              <label for="cm_star-5"><i class="fa"></i></label>
              <input type="radio" id="cm_star-5" name="fb" value="5"'; if(floor($vetor_nota[$k][0]) == 5) echo " checked "; echo ' disabled/>'; 
                  }
                }
            echo '</div>
          </div>
        </div>
            <div class="section section-tabs">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 ml-auto col-xl-12">
                    <p class="category">Minhas Turmas</p>
                    <!-- Nav tabs -->
                    <div class="card">
                      <div class="card-header">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">';
                            $vetor_turma = $banco->select("select t.*, c.* from turma t, curso c, turma_has_professor tp where t.curso = c.codigo and tp.codigoTurma = t.codigo and tp.codigoUsuario = ".$codigo." group by t.codigo order by c.abreviacao");
                            if (isset($vetor_turma)) {
                              for ($k=0; $k < count($vetor_turma); $k++) {
                                $turma[$k] = $vetor_turma[$k][0];
                          echo '<li class="nav-item">';
                                if ($k == 0) {
                                  echo '<a class="nav-link active" data-toggle="tab" href="#turma'.$turma[$k].'" role="tab">';
                                }
                                else{
                                  echo '<a class="nav-link" data-toggle="tab" href="#turma'.$turma[$k].'" role="tab">';
                                }
                                echo $vetor_turma[$k]['ano']."º ".$vetor_turma[$k]['abreviacao']."</a>";
                              }
                            }
                          echo '</li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content text-center">';
                            for ($i=0; $i < count($turma); $i++) {
                              if ($i==0) {
                                 echo "<div class='tab-pane active' id='turma".$turma[$i]."' role='tabpanel'>"; 
                              }
                              else{
                                 echo "<div class='tab-pane' id='turma".$turma[$i]."' role='tabpanel'>";
                              }
                              echo '<div class="col-sm-12">
                                <div class="row collections">';
                                    $vetor_aluno = $banco->select("select u.* from usuario u, turma_has_aluno ta where ta.codigoTurma = ".$turma[$i]." and ta.codigoUsuario = u.codigo group by u.codigo order by u.nome");
                                    if (isset($vetor_aluno)) {
                                      for ($j=0; $j < count($vetor_aluno); $j++) {
                                  echo '<div class="col-sm-6 col-md-2" style="margin-top: 3vh">
                                    <div class="col-sm-12">
										<a href="cadastroOcorrencia.php?codigoAluno='.$vetor_aluno[$j][0].'" class="team">
                                        <div class="team-player">';
                                            if ($vetor_aluno[$j]['foto']!='') {
                                              echo "<img src='upload/".$vetor_aluno[$j]['foto']."' alt='".$vetor_aluno[$j]['nome']."' class='rounded-circle img-fluid img-raised'>";
                                            }
                                            else{
                                              echo "<img src='upload/default.png' alt='".$vetor_aluno[$j]['nome']."' class='rounded-circle img-fluid img-raised'>";
                                            }
                                            echo "<h4 class='title' style='margin-top: -2em'>".$vetor_aluno[$j]['nome']."</h4>";
                                        echo '</div>
                                      </a>
                                    </div>
                                  </div>'; 
                                      }
                                    }
                                echo '</div>
                              </div>
                            </div>';
                            }
                          echo '</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>';
				}
			  }
              echo '</div>
            </div>';
	}

	function PerfilTecAdm($codigo){
		echo '<div class="page-header-image" data-parallax="true" style="background-image:url(../assets/img/login.jpg);"></div>
				<div class="container">';
				$banco = new banco;
				$vetor_tecAdm = $banco->select("select u.* from usuario u where u.codigo = ".$codigo);
				if (isset($vetor_tecAdm)) {
				for ($i=0; $i < count($vetor_tecAdm); $i++) {
				echo '<div class="photo-container">';
				if($vetor_tecAdm[$i]['foto']!=''){
					echo '<img src="../assets/upload/'.$vetor_tecAdm[$i]['foto'].'" alt="">';
				}
				else{
					echo '<img src="../assets/upload/default.png" alt="">';
				}
			echo '</div>
			<h3 class="title" style="margin-top: -1em">'.$vetor_tecAdm[$i]['nome'].'</h3>
			<p style="font-weight: bold; color: #CCC; margin-top: -1em">';
			$vetor_profissao = $banco->select("select p.* from profissao p, usuario_has_profissao up where up.codigoProfissao = p.codigo and up.codigoUsuario = ".$codigo);
			if (isset($vetor_profissao)) {
				for ($j=0; $j < count($vetor_profissao); $j++) {
					echo $vetor_profissao[$j][1];
				}
			}
            echo '</p>
				</div>';
              }
            }
	}

	function Cadastro($codigo){
		if ($codigo != 0) {
			$acao = 'alterar';
			$titulo = 'Alterar';

			$banco = new banco;
			$vetor = $banco->select("select u.* from usuario u where u.codigo = ".$codigo);
			if (isset($vetor)) {
				for ($i=0; $i < count($vetor); $i++) {
					$return = $vetor[$i]['matricula'].':'.$vetor[$i]['nome'].':'.$vetor[$i]['usuario'].':'.$vetor[$i]['email'].':'.date('d/m/Y', strtotime(str_replace('-','/', $vetor[$i]['dtNascimento']))).':'.$vetor[$i]['foto'].':'.$vetor[$i]['ocupacao'].':'.$acao.':'.$titulo.':'.$codigo;
					if ($vetor[$i]['ocupacao']==3) {
						$vetor_turma = $banco->select("select tp.* from turma_has_aluno tp where tp.codigoUsuario = ".$codigo);
						if (isset($vetor_turma)) {
							for ($j=0; $j < count($vetor_turma); $j++) {
								$return.=':'.$vetor_turma[$j]['codigoTurma'];
							}
						}
					}
					elseif ($vetor[$i]['ocupacao']==4) {
						$vetor_profissao = $banco->select("select p.* from profissao p, usuario_has_profissao up where up.codigoUsuario = ".$codigo." and up.codigoProfissao = p.codigo group by p.codigo");
						if (isset($vetor_profissao)) {
							for ($j=0; $j < count($vetor_profissao); $j++) {
								$return.=':'.$vetor_profissao[$j][0];
							}
						}
					}
				}
			}
		}
		else{
			$acao = 'cadastrar';
			$titulo = 'Cadastro de';

			$return = ':::::::'.$acao.':'.$titulo.':'.$codigo;
		}
		return $return;
	}

	function TurmaP($codigo){
		$banco = new banco;
		$vetor_turma = $banco->select("select tp.* from turma_has_professor tp where tp.codigoUsuario = ".$codigo);
		if (isset($vetor_turma)) {
			for ($j=0; $j < count($vetor_turma); $j++) {
				$turma[] = $vetor_turma[$j]['codigoTurma'];
			}
			return $turma;
		}
	}

	function DisciplinaP($codigo){
		$banco = new banco;
		$vetor_disciplina = $banco->select("select pd.* from professor_has_disciplina pd where pd.codigoUsuario = ".$codigo);
		if (isset($vetor_disciplina)) {
			for ($j=0; $j < count($vetor_disciplina); $j++) {
				$disciplina[] = $vetor_disciplina[$j]['codigoDisciplina'];
			}
			return $disciplina;
		}
	}

	function EditarPerfil($codigo){
		$banco = new banco;
		$vetor = $banco->select("select u.* from usuario u where u.codigo = ".$codigo);
		if (isset($vetor)) {
			for ($i=0; $i < count($vetor); $i++) {
				$return = $vetor[$i]['matricula'].':'.$vetor[$i]['nome'].':'.$vetor[$i]['usuario'].':'.$vetor[$i]['email'].':'.$dtNascimento = date('d/m/Y', strtotime($vetor[$i]['dtNascimento'])).':'.$vetor[$i]['foto'].':'.$vetor[$i]['ocupacao'];
				if ($vetor[$i]['ocupacao'] == 2) {
					$return.=':Professor:professor';
				}
				elseif ($vetor[$i]['ocupacao'] == 3) {
					$return.=':Aluno:aluno';
				}
				elseif ($vetor[$i]['ocupacao'] == 4) {
					$return.=':Técnico Administrativo:tecAdm';
				}
			}
		}
		return $return;
	}

	function Notas(){
		$banco = new banco;
		$vetor_notas = $banco->select("select n.* from nota n, usuario u where n.codigoProfessor = u.codigo order by n.nota desc");
		if (isset($vetor_notas)) {
			for ($i=0; $i < count($vetor_notas); $i++) {
				$vetor_professor = $banco->select("select u.* from nota n, usuario u where ".$vetor_notas[$i]['codigoProfessor']." = u.codigo");
				$codigoO[$i] = $vetor_notas[$i][0];
				$descricao[$i] = $vetor_notas[$i][1];
				$nota[$i] = $vetor_notas[$i]['nota'];
				if (isset($vetor_professor)) {
					for ($j=0; $j < count($vetor_professor); $j++) {
						$codigoP[$i] = $vetor_professor[$j]['codigo'];
						$nomeP[$i] = $vetor_professor[$j]['nome'];
						if ($vetor_professor[$j]['foto']!=='') {
							$fotoP[$i] = $vetor_professor[$j]['foto'];
						}
						else{
							$fotoP[$i] = "default.png";
						}
					}
				}if ($vetor_notas[$i]['codigoAluno']!='') {
					$vetor_aluno = $banco->select("select u.* from nota n, usuario u where ".$vetor_notas[$i]['codigoAluno']." = u.codigo");
					if (isset($vetor_aluno)) {
						for ($j=0; $j < count($vetor_aluno); $j++) {
							$codigoA[$i] = $vetor_aluno[$j]['codigo'];
							$nomeA[$i] = $vetor_aluno[$j]['nome'];
							if ($vetor_aluno[$j]['foto']!=='') {
								$fotoA[$i] = $vetor_aluno[$j]['foto'];
							}
							else{
								$fotoA[$i] = "default.png";
							}
						}
					}
				}
				else{
					$nomeA[$i] = "Anônimo";
					$fotoA[$i] = "anonimo.png";
				}
		echo "<tbody>
		<td>".$nomeA[$i]."</td>
			<td>".$nomeP[$i]."</td>
			<td>
				<div class='estrelas text-center'>";
					for($k=0;$k<$nota[$i];$k++){
						echo "<label for='cm_star'><i class='fa'></i></label>
							<input type='radio' id='cm_star' name='fb' checked disabled/>";
					}
				echo "</div>
			</td>";
			}
		}
		echo "</tbody>";
	}

	function Ocorrencia($codigo, $ocupacao, $pesquisa, $radio){
		echo '<div class="container center painel-de-controle">
				<div class="row" style="margin-top: 5vh;">
					<h4 class="verdeIFtexto">Ocorrências</h4>
					<table class="responsive-table centered highlight">
						<thead>
							<tr class="verdeIFtexto">
								<th>Situação</th>
								<th>Professor</th>
								<th>Aluno</th>
								<th>Data</th>
							</tr>
						</thead>
						<tbody>';
		$banco = new banco;
		$subst='Professor';
		if($pesquisa==''){
			$pesquisa='';
		}
		else{
			if($radio=='dtOcorrencia'){
				$pesquisa= date('Y-m-d', strtotime(str_replace('/', '-', $pesquisa)));
			}
			elseif($radio=='aluno') {
				$subst='Aluno';
				$radio='u.nome';
			}
			else{
				$radio='u.nome';
			}
			$pesquisa=" and ".$radio." like '".$pesquisa."%'";
		}
		$vetor_ocorrencia = $banco->select("select o.*, s.* from ocorrencia o, usuario u, situacao s where o.codigo".$subst." = u.codigo and o.situacao = s.codigo ".$pesquisa." order by o.situacao");
		if (isset($vetor_ocorrencia)) {
			for ($i=0; $i < count($vetor_ocorrencia); $i++) {
				$vetor_professor = $banco->select("select u.* from ocorrencia o, usuario u where ".$vetor_ocorrencia[$i]['codigoProfessor']." = u.codigo");
				$codigoO[$i] = $vetor_ocorrencia[$i][0];
				$descricao[$i] = $vetor_ocorrencia[$i][1];
				$nota[$i] = $vetor_ocorrencia[$i]['nota'];
				$urgencia[$i] = $vetor_ocorrencia[$i]['urgencia'];
				if (isset($vetor_professor)) {
					for ($j=0; $j < count($vetor_professor); $j++) {
						$codigoP = $vetor_professor[$j]['codigo'];
						$nomeP[$i] = $vetor_professor[$j]['nome'];
						$fotoP[$i] = $vetor_professor[$j]['foto'];
					}
				}
				$vetor_aluno = $banco->select("select u.* from ocorrencia o, usuario u where ".$vetor_ocorrencia[$i]['codigoAluno']." = u.codigo");
				if (isset($vetor_aluno)) {
					for ($j=0; $j < count($vetor_aluno); $j++) {
						$codigoA = $vetor_aluno[$j]['codigo'];
						$nomeA[$i] = $vetor_aluno[$j]['nome'];
						$fotoA[$i] = $vetor_aluno[$j]['foto'];
					}
				}
		echo '<tr>';
			if ($codigoP == $codigo or $ocupacao == 1) {
				if ($vetor_ocorrencia[$i]['situacao'] == 3) {
					$link= '#ocorrencia'.$codigoO[$i];
				}
				else{
					$link= 'acaoLogin.php?acao=alterar_situacao&codigo='.$codigoO[$i].'&situacao='.$vetor_ocorrencia[$i]['situacao'].'&codigoProfessor='.$codigoP.'&codigoAluno='.$codigoA;
				}
			}
			else{
				$link= '#ocorrencia'.$codigoO[$i];
			}
			$situacao = $vetor_ocorrencia[$i]['situacao'];
			
			if ($situacao == 2) {
				$class='red-text';
			}
			elseif ($situacao == 1) {
				$class='orange-text';
			}
			else{
				$class='green-text';
			}
			echo '<td class="center"><a href="'.$link.'" class="modal-trigger '.$class.'">'.$vetor_ocorrencia[$i]['descricao'].'</a></td>
				<td>'.$nomeP[$i].'</td>
				<td>'.$nomeA[$i].'</td>
				<td>'.date('d/m/Y', strtotime($vetor_ocorrencia[$i]['dtOcorrencia'])).'</td>
			</tr>';
				}
			}
		echo "</tbody>
		</table>			
				</div>
			</div>";
		for ($i=0; $i < count($vetor_ocorrencia); $i++) {
			echo '<div id="ocorrencia'.$codigoO[$i].'" class="modal center">
				<div class="modal-content">
					<fieldset style="border: none;">
						<h4 class="verdeIFtexto"></h4>
						<div class="col s12 l4">
							<div class="valign-wrapper" style="width:100%; padding-bottom:1em">
								<div class="row" style="width:100%; padding-bottom: 2em">
									<div class="col s12">
										<div class="col s3 offset-s3"><img class="responsive-img circle" src="upload/'.$fotoP[$i].'">
										</div>
										<div class="col s3"><img class="responsive-img circle" src="upload/'.$fotoA[$i].'"></div>
									</div>
									<h5 class="verdeIFtexto" style="margin-top: 2em">'.$nomeP[$i].' e '.$nomeA[$i].'</h5>
									<div class="row" style="margin-top: 2em">
										<textarea class="materialize-textarea center col s8 offset-s2" name="descricao" id="descricao" readonly>'.$descricao[$i].'</textarea>
										<div class="col s12 center">
											<label for="descricao">Descrição</label>
										</div>
									</div>
									<div class="input-field col l4 m6 s12 offset-l4 offset-m2" style="margin-top: 2em">';
											$vetor_urgencia = $banco->select("select u.* from ocorrencia o, urgencia u where ".$urgencia[$i]." = u.codigo group by u.codigo");
											if (isset($vetor_urgencia)) {
												for ($k=0; $k < count($vetor_urgencia); $k++) {
										echo '<input id="urgencia" name="urgencia" type="text" class="validate center" readonly value="'.$vetor_urgencia[$k]['urgencia'].'">
										<label for="urgencia">Criticidade</label>';
												}
											}
									echo '</div>
									<div class="input-field col l4 m6 s12 offset-l4 offset-m2" style="margin-top: 2em">';
											$vetor_resolucao = $banco->select("select r.* from ocorrencia o, resolucao r where ".$codigoO[$i]." = r.ocorrencia group by r.codigo");
											if (isset($vetor_resolucao)) {
												for ($k=0; $k < count($vetor_resolucao); $k++) {
										echo '<input id="resolucao" name="resolucao" type="text" class="validate center" readonly value="'.$vetor_resolucao[$k]['resolucao'].'">
										<label for="resolucao">Resolução</label>';
												}
											}
									echo "</div>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
			</div>";
		}
	}

	function VerOcorrencia($codigoAluno, $codigoProfessor, $codigoOcorrencia){
			$banco = new banco;
			$vetor_ocorrencia = $banco->select("select o.*, s.* from ocorrencia o, usuario u, situacao s where o.codigo = ".$codigoOcorrencia." and o.situacao = s.codigo group by o.codigo");
			if (isset($vetor_ocorrencia)) {
				for ($i=0; $i < count($vetor_ocorrencia); $i++) {
					$vetor_professor = $banco->select("select u.* from usuario u where u.codigo = ".$vetor_ocorrencia[$i]['codigoProfessor']);
					if (isset($vetor_professor)) {
						for ($j=0; $j < count($vetor_professor); $j++) {
							$fotoP = $vetor_professor[$j]['foto'];
							$nomeP = $vetor_professor[$j]['nome'];
						}
					}
					$vetor_aluno = $banco->select("select u.* from usuario u where u.codigo = ".$vetor_ocorrencia[$i]['codigoAluno']);
					if (isset($vetor_aluno)) {
						for ($j=0; $j < count($vetor_aluno); $j++) {
							$fotoA = $vetor_aluno[$j]['foto'];
							$nomeA = $vetor_aluno[$j]['nome'];
						}
					}
					$codigocorrencia = $vetor_ocorrencia[$i]['0'];
					$situacao = $vetor_ocorrencia[$i]['situacao'];
					$nota = $vetor_ocorrencia[$i]['nota'];
					$dtOcorrencia = $vetor_ocorrencia[$i]['dtOcorrencia'];
					$descricao = $vetor_ocorrencia[$i]['1'];
					$urgencia = $vetor_ocorrencia[$i]['urgencia'];
				}
			}
		echo '<div class="col s12">
			<div class="col s2 offset-s4">
				<img class="responsive-img circle" src="upload/'.$fotoP.'">
			</div>
			<div class="col s2">
				<img class="responsive-img circle" src="upload/'.$fotoA.'">
			</div>
		</div>
		<h5 class="verdeIFtexto center" style="margin-top: 2em">'.$nomeP.' e '.$nomeA.'</h5>
		<div class="row" style="margin-top: 2em">
			<textarea class="materialize-textarea center col s8 offset-s2" name="descricao" readonly>'.$descricao.'</textarea>
		</div>
		<div class="input-field col l2 s12 offset-l4" style="margin-top: 2em">';
				$banco = new banco;
				$vetor_urgencia = $banco->select("select u.* from ocorrencia o, urgencia u where ".$urgencia." = u.codigo group by codigo");
				if (isset($vetor_urgencia)) {
					for ($k=0; $k < count($vetor_urgencia); $k++) {
			echo '<input id="urgencia" name="urgencia" type="text" class="center" readonly value="'.$vetor_urgencia[$k]['urgencia'].'">';
					}
				}
			echo '</div>
		<div class="input-field col l2 s12" style="margin-top: 2em">
			<input id="dtOcorrencia" name="dtOcorrencia" type="text" class="center" readonly value="'.date('d/m/Y', strtotime($dtOcorrencia)).'">
		</div>
		<div class="input-field col l6 s12 offset-l3" style="margin-top: 2em">
			<div>
				<textarea class="materialize-textarea" name="resolucao" id="resolucao" data-length="428" placeholder="Resolução" required=""></textarea>
			</div>
			<div class="center">
				<input type="submit" name="resolver" id="resolver" value="Resolver" class="btn verdeIF">
				<input type="hidden" name="codigo" id="codigo" value="'.$codigocorrencia.'">
				<input type="hidden" name="situacao" id="situacao" value="'.$situacao.'">
				<input type="hidden" name="acao" id="acao" value="alterar_situacao">
				<input type="hidden" name="resolver" id="resolver" value=1>
			</div>
		</div>';
	}
?>
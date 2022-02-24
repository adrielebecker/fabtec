<?php 
    $acao=explode('.', isset($_POST['acao'])?$_POST['acao']:$_GET['acao']);
    echo $acao[0];

    require_once "autoload.php";

    if($acao[0]=="cadastrar") {
        $matricula=isset($_POST['matricula']) ? $_POST['matricula']: $_GET['matricula'];
        $nome=isset($_POST['nome']) ? $_POST['nome']: $_GET['nome'];
        $email=isset($_POST['email']) ? $_POST['email']: $_GET['email'];
        $usuario=isset($_POST['usuario']) ? $_POST['usuario']: $_GET['usuario'];
        $dtNascimento=isset($_POST['dtNascimento']) ? $_POST['dtNascimento']: $_GET['dtNascimento'];
        $senha=isset($_POST['senha']) ? $_POST['senha']: $_GET['senha'];
        $confirmacao=isset($_POST['confirmacao']) ? $_POST['confirmacao']: $_GET['confirmacao'];
        $ocupacao=isset($_POST['ocupacao']) ? $_POST['ocupacao']: $_GET['ocupacao'];
        
        $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];
        $tabela=isset($_POST['tabela']) ? $_POST['tabela']: $_GET['tabela'];

   
        if (isset($_FILES['foto'])) {
            var_dump($_FILES['foto']);
            if ($_FILES['foto']['name']!='') {
                $extensao = strtolower(substr($_FILES['foto']['name'], -4));
                $fotoNV = md5(time()).$extensao;
                $diretorio = "upload/";

                move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$fotoNV);
            }
			else{
    			$fotoNV='default.png';
    			$diretorio = "upload/";

    			move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$fotoNV);
			}
        }

        $erro = 0;

        if ($ocupacao == 1) {
            $location = 'ADM';
        }
        elseif ($ocupacao == 2) {
            $location = 'Professor';
        }
        elseif ($ocupacao == 3) {
            $location = 'Aluno';
        }
        else{
            $location = 'TecAdm';
        }

        $banco = new banco;

        if ($senha != $confirmacao) {
            $erro = 1;
        }

        $vetor_usuario = $banco->select("select * from usuario u, ocupacao o group by u.codigo");        
        if (isset($vetor_usuario)) {
            for ($i=0; $i < count($vetor_usuario); $i++) {
                if ($usuario == $vetor_usuario[$i]['usuario']) {
                    $erro = 2;
                }
                if ($email == $vetor_usuario[$i]['email']) {
                    $erro = 3;
                }
            }
        }

        echo $erro;

        if ($erro == 0) {
            $senha=sha1(hash('sha512', isset($_POST['senha']) ? $_POST['senha'] : $_GET['senha']));
            echo $usuario.$vetor_usuario[$i][0];
            $banco->setTabela($tabela);
            $inserir=[null,
                        $nome,
                        $email,
                        $matricula,
                        $usuario,
                        $senha,
                        $dtNascimento,
                        $fotoNV,
                        $ocupacao
                    ];
            $banco->inserir($inserir);

            $vetor_usuario = $banco->select("select max(codigo) from usuario");
            if (isset($vetor_usuario)) {
                for ($i=0; $i < count($vetor_usuario); $i++) {
                    $codigoUsuario = $vetor_usuario[$i][0];
                }
            }

            if ($ocupacao == 2) {
				$disciplina=isset($_POST['disciplina']) ? $_POST['disciplina']: 0;
				$turma=isset($_POST['turma']) ? $_POST['turma']: 0;
				
                $banco->setTabela('professor_has_disciplina');
                $count = count($disciplina);
                for ($i=0; $i < $count; $i++) {
                    $inserir=[null,
                                $codigoUsuario,
                                $disciplina[$i]
                            ];
                    $banco->inserir($inserir);
                }
                $banco->setTabela('turma_has_professor');
                $count = count($turma);
                for ($i=0; $i < $count; $i++) {
                    $inserir=[null,
                                $turma[$i],
                                $codigoUsuario
                            ];
                    $banco->inserir($inserir);
                }
            }

            elseif ($ocupacao == 3) {
				$turma=isset($_POST['turma']) ? $_POST['turma']: 0;
				
                $banco->setTabela('turma_has_aluno');
                $count = count($turma);
                for ($i=0; $i < $count; $i++) {
                    $inserir=[null,
                                $turma[$i],
                                $codigoUsuario
                            ];
                    $banco->inserir($inserir);
                }
            }

            elseif ($ocupacao == 4) {
				$profissao=isset($_POST['profissao']) ? $_POST['profissao']: $_GET['profissao'];
		
                $banco->setTabela('usuario_has_profissao');
                $inserir=[null,
                            $codigoUsuario,
                            $profissao
                        ];
                $banco->inserir($inserir);
            }
                
        }
        elseif ($erro!=0) {
            $pagina = 'cadastro'.$location.'.php?erro='.$erro;
        }
        echo $pagina;
        header('location:'.$pagina);
    }

    if($acao[0]=="alterar") {
        $codigo=isset($_POST['codigo']) ? $_POST['codigo']: $_GET['codigo'];
        $matricula=isset($_POST['matricula']) ? $_POST['matricula']: $_GET['matricula'];
        $nome=isset($_POST['nome']) ? $_POST['nome']: $_GET['nome'];
        $email=isset($_POST['email']) ? $_POST['email']: $_GET['email'];
        $usuario=isset($_POST['usuario']) ? $_POST['usuario']: $_GET['usuario'];
        $dtNascimento=date('Y-m-d', strtotime(str_replace('/','-', isset($_POST['dtNascimento']) ? $_POST['dtNascimento']: $_GET['dtNascimento'])));
        $senha=isset($_POST['senha']) ? $_POST['senha']: $_GET['senha'];
        $confirmacao=isset($_POST['confirmacao']) ? $_POST['confirmacao']: $_GET['confirmacao'];
        $ocupacao=isset($_POST['ocupacao']) ? $_POST['ocupacao']: $_GET['ocupacao'];
        
        $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];
        $tabela=isset($_POST['tabela']) ? $_POST['tabela']: $_GET['tabela'];

        if (isset($_FILES['foto'])) {
            var_dump($_FILES['foto']);
            if ($_FILES['foto']['name']!='') {
                $extensao = strtolower(substr($_FILES['foto']['name'], -4));
                $fotoNV = md5(time()).$extensao;
                $diretorio = "upload/";

                move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$fotoNV);
            }
			else{
			$fotoNV='default.png';
			$diretorio = "upload/";

			move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$fotoNV);
			}   
        }

        $erro=0;

        $banco=new banco;

        if ($senha != $confirmacao) {
            $pagina = $pagina.'?erro=1';
            $erro++;
        }
        
        $vetor_usuario1 = $banco->select("select u.* from usuario u, ocupacao o where u.codigo = ".$codigo." group by u.codigo");
        if (isset($vetor_usuario1)) {
            echo "aaaa";
            for ($i=0; $i < count($vetor_usuario1); $i++) {
                $email1 = $vetor_usuario1[$i]['email'];
                $usuario1 = $vetor_usuario1[$i]['usuario'];
            }
        }
        $vetor_usuario = $banco->select("select u.* from usuario u, ocupacao o group by u.codigo");        
        if (isset($vetor_usuario)) {
            for ($i=0; $i < count($vetor_usuario); $i++) {
                if ($usuario == $usuario1) {
                    echo "<br>".$usuario.$usuario1."<br>";
                    echo $i.'aa';
                }
                elseif($usuario == $vetor_usuario[$i]['usuario']){
                    $pagina = $pagina.'?erro=2';
                    $erro++;
                }
                if ($email == $email1) {
                    echo $i;
                }
                elseif ($email == $vetor_usuario[$i]['email']) {
                    $pagina = $pagina.'?erro=3';
                    $erro++;
                }
            }
        }

        echo $erro;

        if ($erro==0) {
            $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];

            $banco->setTabela($tabela);
            $update=[$codigo,
						$nome,
                        $email,
                        $matricula,
                        $usuario,
                        $senha,
                        $dtNascimento,
                        $fotoNV
                    ];
					echo $dtNascimento;
            if ($banco->update($update)) {
                $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];
            }

            if ($acao[1]!=1) {
                echo $acao[0];
                if ($ocupacao == 2) {
                    $turma=isset($_POST['turma']) ? $_POST['turma']: $_GET['turma'];
                    $disciplina=isset($_POST['disciplina']) ? $_POST['disciplina']: $_GET['disciplina'];

                    $banco->setTabela('turma_has_professor');
                    $banco->delete($codigo.'.codigoUsuario');

                    $banco->setTabela('professor_has_disciplina');
                    $banco->delete($codigo.'.codigoUsuario');

                    $banco->setTabela('turma_has_professor');
                    $count = count($turma);
                    for ($i=0; $i < $count; $i++) {
                        $inserir=[null,
                                $turma[$i],
                                $codigo
                                ];
                        $banco->inserir($inserir);
                    }

                    $banco->setTabela('professor_has_disciplina');
                    $count = count($disciplina);
                    for ($i=0; $i < $count; $i++) {
                        $inserir=[null,
                                    $codigo,
                                    $disciplina[$i]
                                ];
                        $banco->inserir($inserir);
                    }
                }

                elseif ($ocupacao == 3) {
                    $turma=isset($_POST['turma']) ? $_POST['turma']: $_GET['turma'];

                    $banco->setTabela('turma_has_aluno');
                    $banco->delete($codigo.'.codigoUsuario');

                    $banco->setTabela('turma_has_aluno');
                    $count = count($turma);
                    for ($i=0; $i < $count; $i++) {
                        $inserir=[null,
                                $turma,
                                $codigo
                                ];
                        $banco->inserir($inserir);
                    }
                }
                elseif ($ocupacao == 4) {
                    $profissao=isset($_POST['profissao']) ? $_POST['profissao']: $_GET['profissao'];

                    $banco->setTabela('usuario_has_profissao');
                    $banco->delete($codigo.'.codigoUsuario');

                    $banco->setTabela('usuario_has_profissao');
                    $inserir=[null,
                                $codigo,
                                $profissao
                            ];
                    $banco->inserir($inserir);
                }
            }    
        }
        print_r($_POST);
        header('location:'.$pagina);
    }

    if($acao[0]=="alterarOcupacao") {
        $codigo=isset($_POST['codigo']) ? $_POST['codigo']: $_GET['codigo'];
        $ocupacao=$acao[1];
        $acao = $acao[1];

        $tabela=isset($_POST['tabela']) ? $_POST['tabela']: $_GET['tabela'];

        $banco=new banco;
        $banco->setTabela($tabela);

        echo $ocupacao."a";

        switch ($ocupacao) {
            case 1:
                $pagina = 'administradores.php';
            break;
            case 2:
                $pagina = 'professores.php';
            break;
            default:
                $pagina = 'tecAdm.php';
            break;
        }

        $update=[$codigo,$ocupacao];
        $campos=['codigo','ocupacao'];
        if ($banco->updateC($update, $campos)) {
            $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];
        }
        header('location:'.$pagina);
    }

    if($acao[0]=="cadastrarOcorrencia") {
        $descricao=isset($_POST['descricao']) ? $_POST['descricao']: $_GET['descricao'];
        $nota=isset($_POST['nota']) ? $_POST['nota']: $_GET['nota'];
        $dtOcorrencia=isset($_POST['dtOcorrencia']) ? $_POST['dtOcorrencia']: $_GET['dtOcorrencia'];
        $tpOcorrencia=isset($_POST['tpOcorrencia']) ? $_POST['tpOcorrencia']: $_GET['tpOcorrencia'];
        $codigoProfessor=isset($_POST['codigoProfessor']) ? $_POST['codigoProfessor']: $_GET['codigoProfessor'];
        $codigoAluno=isset($_POST['codigoAluno']) ? $_POST['codigoAluno']: $_GET['codigoAluno'];
        $urgencia=isset($_POST['urgencia']) ? $_POST['urgencia']: $_GET['urgencia'];

        $tabela=isset($_POST['tabela']) ? $_POST['tabela']: $_GET['tabela'];
        $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];

        $banco=new banco;
        $banco->setTabela($tabela);
        $inserir=[null,
                    $descricao,
                    $nota,
                    $dtOcorrencia,
                    $tpOcorrencia,
                    $codigoProfessor,
                    $codigoAluno,
                    $urgencia,
                    2
                ];
        $banco->inserir($inserir);
        //echo $banco->inserir($inserir);
        header('location:'.$pagina);
    }

    if($acao[0]=="cadastrarNota") {
        $nota=isset($_POST['nota']) ? $_POST['nota']: $_GET['nota'];
        $codigoProfessor=isset($_POST['codigoProfessor']) ? $_POST['codigoProfessor']: $_GET['codigoProfessor'];
        $codigoAluno=isset($_POST['codigoAluno']) ? $_POST['codigoAluno']: $_GET['codigoAluno'];
        $anonimo=isset($_POST['anonimo']) ? $_POST['anonimo']: $_GET['anonimo'];

        $tabela=isset($_POST['tabela']) ? $_POST['tabela']: $_GET['tabela'];
        $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];

        if ($nota == '') {
            $nota = 0;
        }

        $banco=new banco;
        $banco->setTabela($tabela);

        if ($anonimo == 1) {
            $inserir=[null,
                        $nota,
                        null,
                        $codigoProfessor
                    ];
        }
        else{
            $inserir=[null,
                        $nota,
                        $codigoAluno,
                        $codigoProfessor
                    ];
        }

        $banco->inserir($inserir);
        //echo $banco->inserir($inserir);
        header('location:'.$pagina);
    }

    if($acao[0]==" 	Perfil") {
        $codigo=isset($_POST['codigo']) ? $_POST['codigo']: $_GET['codigo'];
        $matricula=isset($_POST['matricula']) ? $_POST['matricula']: $_GET['matricula'];
        $nome=isset($_POST['nome']) ? $_POST['nome']: $_GET['nome'];
        $email=isset($_POST['email']) ? $_POST['email']: $_GET['email'];
        $usuario=isset($_POST['usuario']) ? $_POST['usuario']: $_GET['usuario'];
        $dtNascimento=isset($_POST['dtNascimento']) ? $_POST['dtNascimento']: $_GET['dtNascimento'];
        $senha=sha1(hash('sha512', isset($_POST['senha']) ? $_POST['senha'] : $_GET['senha']));
        $confirmacao=sha1(hash('sha512', isset($_POST['confirmacao']) ? $_POST['confirmacao'] : $_GET['confirmacao']));
        $foto=isset($_POST['foto']) ? $_POST['foto']: $_GET['foto'];
        $pagina=isset($_POST['pagina']) ? $_POST['pagina']: $_GET['pagina'];
        $tabela=isset($_POST['tabela']) ? $_POST['tabela']: $_GET['tabela'];

        $banco=new banco;
        $banco->setTabela($tabela);
        if ($senha != '') {
            if ($senha == $confirmacao) {
                echo "aaaaaaa";
                $update=[null,
                            $nome,
                            $email,
                            $matricula,
                            $usuario,
                            $senha,
                            $dtNascimento,
                            $foto
                        ];
            }
            else{
                header('location:editarPerfil.php?codigo='.$codigo);
            }
        }
        else{
            $update=[null,
                        $nome,
                        $email,
                        $matricula,
                        $usuario,
                        $dtNascimento,
                        $foto,
                        $ocupacao
                    ];
        }
        $banco->editarPerfilcSenha($update);
        //header('location:'.$pagina);
    }

?>
<?php 
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('location:../');   
    }

    function geraSelect($default, $tabela, $selecao, $value, $descricao, $select) {
        $sql = 'select * from ' .$tabela. ' order by ' .$descricao;
        echo '<select name="'.$select.'" id="'.$select.'">';
        echo '<option value="default" class="disabled" disabled selected>'.$default.'</option>';
        $banco = new banco;
        $row = $banco->select($sql);
        $cont = 0;
        while ($cont < count($row)) {
            $birobiro = "";
            if ($row[$cont][$value] == $selecao) {
                $birobiro = ' selected';
            }
            echo '<option value="'.$row[$cont][$value].'"' .$birobiro. '>' .$row[$cont][$descricao]. '</option>';
            $cont++;
        }
        echo '</select>';
    }

    function geraSelectMultiple($default, $tabela, $selecao, $value, $descricao, $select) {
        $sql = 'select * from ' .$tabela. ' order by ' .$descricao;
        echo '<select multiple name="'.$select.'[]" id="'.$select.'" required>';
        echo '<option value="default" class="disabled" disabled selected>'.$default.'</option>';
        $banco = new banco;
        $row = $banco->select($sql);
        $cont = 0;
        while ($cont < count($row)) {
            $birobiro[] = "";
			for($i=0;$i<count($selecao);$i++){
				if ($row[$cont][$value] == $selecao[$i][0]) {
					$birobiro[$cont] = ' selected';
				}
			}
            echo '<option value="'.$row[$cont][$value].'"' .$birobiro[$cont]. '>' .$row[$cont][$descricao]. '</option>';
            $cont++;
        }
        echo '</select>';
    }

    function geraSelectTurma($default, $tabela, $selecao, $value, $descricao, $select) {
        $sql = 'select t.*, c.* from turma t, curso c where t.curso = c.codigo order by t.codigo';
        echo '<select name="'.$select.'" id="'.$select.'" required>';
        echo '<option value="default" class="disabled" disabled selected>'.$default.'</option>';
        $banco = new banco;
        $row = $banco->select($sql);
        $cont = 0;
        while ($cont < count($row)) {
            $birobiro = "";
            if ($row[$cont][$value] == $selecao) {
                $birobiro = ' selected';
            }
            echo '<option value="'.$row[$cont][$value].'"' .$birobiro. '>' .$row[$cont][$descricao]. 'º '.$row[$cont]['abreviacao'].'</option>';
            $cont++;
        }
        echo '</select>';
    }

    function geraSelectMultipleTurma($default, $tabela, $selecao, $value, $descricao, $select) {
        $sql = 'select t.*, c.* from turma t, curso c where t.curso = c.codigo order by curso';
        echo '<select multiple name="'.$select.'[]" id="'.$select.'" required>';
        echo '<option value="default" class="disabled" disabled selected>'.$default.'</option>';
        $banco = new banco;
        $row = $banco->select($sql);
        $cont = 0;
        while ($cont < count($row)) {
            $birobiro[] = "";
			for($i=0;$i<count($selecao);$i++){
				if ($row[$cont][$value] == $selecao[$i][0]) {
					$birobiro[$cont] = ' selected';
				}
			}
            echo '<option value="'.$row[$cont][$value].'"' .$birobiro[$cont]. '>' .$row[$cont][$descricao]. 'º '.$row[$cont]['abreviacao'].'</option>';
            $cont++;
        }
        echo '</select>';
    }

    function geraSelectOcorrencia($default, $tabela, $selecao, $value, $descricao, $select, $order) {
        $sql = 'select * from ' .$tabela. ' order by ' .$order;
        echo '<select name="'.$select.'" id="'.$select.'" required>';
        echo '<option value="default" class="disabled" disabled selected>'.$default.'</option>';
        $banco = new banco;
        $row = $banco->select($sql);
        $cont = 0;
        while ($cont < count($row)) {
            $birobiro = "";
            if ($row[$cont][$value] == $selecao) {
                $birobiro = ' selected';
            }
            echo '<option value="'.$row[$cont][$value].'"' .$birobiro. '>' .$row[$cont][$descricao]. '</option>';
            $cont++;
        }
        echo '</select>';
    }

    function Erro($erro){
        if ($erro!=0) {       
            echo "<div class=><div class='row'><div class='red lighten-2 white-text col s4 offset-s4'><p>";
            
            if ($erro == 1) {
                echo "Senha e Confirmação de senha não são iguais.";
            }
            elseif($erro == 2){
                echo "Esse nome de usuário já existe.";
            }
            elseif ($erro == 3) {
                echo "Esse email já está em uso.";
            }
            echo "</p></div></div>";
        }   
    }
?>
<?php

require_once 'autoload.php';

class aluno extends pessoa{
    // tabelas que aluno vai armazenar como objetos
    private $disciplina, $turma;
    
    function getDisciplina() {
        return $this->disciplina;
    }

    function getTurma() {
        return $this->turma;
    }

    function setDisciplina($disciplina) {
         if($marca instanceof disciplina){
            $this->disciplina[] = $disciplina;
        }
    }

    function setTurma($turma) {
        if($turma instanceof turma){
            $this->turma[] = $turma;
        }
    }


}

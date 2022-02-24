<?php

require_once 'autoload.php';

class banco {

    public $pdo, $tabela;

    public function conexao() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=aconline', "aconline", '$aConline#123');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function obterCampos() {
        $consulta = $this->pdo->query("desc " . $this->tabela);

        while ($lista = $consulta->fetch()) {
            $campos [] = $lista[0];
        }
        return $campos;
    }

    public function validarData($campo) {
        $data = DateTime::createfromFormat('d/m/Y', $campo);
        if ($data && $data->format('d/m/Y')) {
            return true;
        } else {
            return false;
        }
    }
    
    public function geraStmt($sql, $vetor, $campos){
        $stmt = $this->pdo->prepare($sql);       
            for ($j = 1; $j <= count($vetor)-1; $j++) {
                if (is_numeric($vetor[$j])) {
                    $stmt->bindParam (':' . $campos[$j], $vetor[$j], PDO::PARAM_INT);
                    } elseif ($this->validarData($vetor[$j])) {
                    $stmt->bindParam(':' . $campos[$j], date("Y-m-d", strtotime(str_replace("/", "-", $vetor[$j]))), PDO::PARAM_STR);
                } else {
                    $stmt->bindParam(':' . $campos[$j], $vetor[$j], PDO::PARAM_STR);
                }
            }
            return $stmt;
    }

    public function select($sql) {
        $this->conexao();
        try {
            $consulta = $this->pdo->query($sql);
            $vetor = null;
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                $vetor[] = $linha;

            }
            return $vetor;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function inserir($vetor) {
        $this->conexao();
        try {
            $campos = $this->obterCampos();
            $sql = "INSERT INTO " . $this->tabela . "(";
            $i = 0;
            foreach ($campos as $v) {
                if ($i == 1) {
                    $sql .= $v;
                } elseif ($i > 1) {
                    $sql .= ", " . $v;
                }
                $i++;
            }
            $sql .= ") VALUES(";
            $i = 0;
            foreach ($campos as $v) {
                if ($i == 1) {
                    $sql .= ":" . $v;
                } elseif ($i > 1) {
                    $sql .= ", :" . $v;
                }
                $i++;
            }
            $sql .= ")";
            $stmt = $this->geraStmt($sql, $vetor, $campos);
            echo $sql;
            echo "<pre>";
            print_r($vetor);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function inserirFK($vetor) {
        $this->conexao();
        try {
            $campos = $this->obterCampos();
            $sql = "INSERT INTO " . $this->tabela . "(";
            $i = 0;
            foreach ($campos as $v) {
                if ($i == 0) {
                    $sql .= $v;
                } elseif ($i > 0) {
                    $sql .= ", " . $v;
                }
                $i++;
            }
            $sql .= ") VALUES(";
            $i = 0;
            foreach ($campos as $v) {
                if ($i == 0) {
                    $sql .= ":" . $v;
                } elseif ($i > 0) {
                    $sql .= ", :" . $v;
                }
                $i++;
            }
            $sql .= ")";
            $stmt = $this->geraStmt($sql, $vetor, $campos);
            echo $sql;
            echo "<pre>";
            print_r($vetor);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public  function delete($string) {
        $array=explode(".", $string);
        $id = $array[0];
        $parametro = $array[1];
        echo $id."<- ->".$parametro;
        $this->conexao();
        try {
            $sql = 'DELETE FROM ' . $this->tabela . ' WHERE '. $parametro . ' = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            echo $id.$sql;
            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    function updateSituacao($vetor) {
        $this->conexao();
        try {
            $sql = "UPDATE {$this->getTabela()} SET situacao = :sit WHERE codigo = :cod";
            $stmt = $this->pdo->prepare($sql);       
      
         // $stmt = $this->geraStmt($sql, $vetor, ['codigo', 'situacao']);
            $stmt->bindParam (':sit', $vetor[1], PDO::PARAM_INT);
            $stmt->bindParam (':cod', $vetor[0], PDO::PARAM_INT);
            $stmt->execute();
            print_r($vetor);
            return true;
        }catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    function updateC($vetor, $campos) {
        $this->conexao();
        try {
            $sql = "UPDATE {$this->getTabela()} SET {$campos[1]} = :{$campos[1]} WHERE codigo = :codigo";
            $stmt = $this->pdo->prepare($sql);       
      
            //$stmt = $this->geraStmt($sql, $vetor, $campos);
            $stmt->bindParam (':'.$campos[1], $vetor[1], PDO::PARAM_INT);
            $stmt->bindParam (':codigo', $vetor[0], PDO::PARAM_INT);
            $stmt->execute();
            var_dump($vetor);
            print_r($campos);
            print_r($vetor);
            return true;
        }catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    function updateTp($vetor, $campos) {
        $this->conexao();
        try {
            $sql = "UPDATE {$this->getTabela()} SET {$campos[1]} = :{$campos[1]} WHERE codigo = :codigo";
            $stmt = $this->pdo->prepare($sql);       
      
            //$stmt = $this->geraStmt($sql, $vetor, $campos);
            $stmt->bindParam (':'.$campos[2], $vetor[2], PDO::PARAM_INT);
            $stmt->bindParam (':'.$campos[1], $vetor[1], PDO::PARAM_INT);
            $stmt->bindParam (':codigo', $vetor[0], PDO::PARAM_INT);
            $stmt->execute();
            var_dump($vetor);
            print_r($campos);
            print_r($vetor);
            return true;
        }catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    function update($vetor) {
        $this->conexao();
        try {
            if ($vetor[5] != '') {
                $vetor[5]=sha1(hash('sha512', $vetor[5]));

                $sql = "UPDATE {$this->getTabela()} SET nome = :nome, email = :email, matricula = :matricula, usuario = :usuario, senha = :senha, dtNascimento = :dtNascimento, foto = :foto WHERE codigo = :codigo";

                $stmt = $this->pdo->prepare($sql);

                $stmt->bindParam (':codigo', $vetor[0], PDO::PARAM_INT);
                $stmt->bindParam (':nome', $vetor[1], PDO::PARAM_STR);
                $stmt->bindParam (':email', $vetor[2], PDO::PARAM_STR);
                $stmt->bindParam (':matricula', $vetor[3], PDO::PARAM_INT);
                $stmt->bindParam (':usuario', $vetor[4], PDO::PARAM_STR);
                $stmt->bindParam (':senha', $vetor[5], PDO::PARAM_STR);
                $stmt->bindParam (':dtNascimento', $vetor[6], PDO::PARAM_STR);
                $stmt->bindParam (':foto', $vetor[7], PDO::PARAM_STR);
                $stmt->execute();
            }
            else{
                $sql = "UPDATE {$this->getTabela()} SET nome = :nome, email = :email, matricula = :matricula, usuario = :usuario, dtNascimento = :dtNascimento, foto = :foto WHERE codigo = :codigo";

                $stmt = $this->pdo->prepare($sql);

                $stmt->bindParam (':codigo', $vetor[0], PDO::PARAM_INT);
                $stmt->bindParam (':nome', $vetor[1], PDO::PARAM_STR);
                $stmt->bindParam (':email', $vetor[2], PDO::PARAM_STR);
                $stmt->bindParam (':matricula', $vetor[3], PDO::PARAM_INT);
                $stmt->bindParam (':usuario', $vetor[4], PDO::PARAM_STR);
                $stmt->bindParam (':dtNascimento', $vetor[6], PDO::PARAM_STR);
                $stmt->bindParam (':foto', $vetor[7], PDO::PARAM_STR);
                $stmt->execute();
            }
            echo $sql;
            return true;
        }catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    function updateProfessorsSenha($vetor) {
        $this->conexao();
        try {
            echo $sql;
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam (':codigo', $vetor[0], PDO::PARAM_INT);
            $stmt->bindParam (':nome', $vetor[1], PDO::PARAM_STR);
            $stmt->bindParam (':email', $vetor[2], PDO::PARAM_STR);
            $stmt->bindParam (':matricula', $vetor[3], PDO::PARAM_INT);
            $stmt->bindParam (':usuario', $vetor[4], PDO::PARAM_STR);
            $stmt->bindParam (':dtNascimento', $vetor[6], PDO::PARAM_STR);
            $stmt->bindParam (':foto', $vetor[7], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    function getPdo() {
        return $this->pdo;
    }

    function getTabela() {
        return $this->tabela;
    }

 function setPdo($pdo) {
        $this->pdo = $pdo;
    }

 function setTabela($tabela) {
        $this->tabela = $tabela;
    }


}

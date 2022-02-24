<?php 
	session_start();
    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['ocupacao']==1) {
           	header('location:assets/admin.php');
        }
        elseif ($_SESSION['ocupacao']==2) {
           	header('location:assets/professor.php');
        }
        elseif ($_SESSION['ocupacao']==3) {
           	header('location:assets/aluno.php');
        }
        elseif ($_SESSION['ocupacao']==4) {
           	header('location:assets/tecAdm.php');
        }
    }
?>
<?php
  include('funcoes.php');
  include('autoload.php');
  include('funcaoBanco.php');
?>
<!DOCTYPE html>
  <html lang="pt-br">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

      <!-- Ícone -->
      <link rel="shortcut icon" type="imagem/x-icon" href="../assets/img/icon.png">
      
      <!-- CSS  -->
      <link href="../assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
      <link href="../assets/css/css.css" type="text/css" rel="stylesheet" media="screen,projection">
      <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
      <link href="../assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />

      <!-- Fontes -->
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

      <!-- Ícones -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

      <!-- Título -->
      <title>Aluno | Perfil</title>
    </head>

    <body class="profile-page sidebar-collapse">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg bg-success fixed-top navbar-transparent " color-on-scroll="300">
        <div class="container">
          <div class="dropdown button-dropdown">
            <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
              <span class="button-bar"></span>
              <span class="button-bar"></span>
              <span class="button-bar"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-header">Atalhos</a>
              <a class="dropdown-item" href="#professores">Professores</a>
            </div>
          </div>
          <div class="navbar-translate">
            <a class="navbar-brand" href="" rel="tooltip" title="Desenvolvido para auxílio do Instituto Federal Catarinense - Campus Rio do Sul - Unidade Urbana" data-placement="bottom">
              Conselho <strong>Online</strong> 
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar top-bar"></span>
              <span class="navbar-toggler-bar middle-bar"></span>
              <span class="navbar-toggler-bar bottom-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../assets/img/blurred-image-1.jpg">
            <ul class="navbar-nav">
              <li class="nav-item">
                <?php 
                  echo '<a class="nav-link" rel="tooltip" title="Editar Perfil" data-placement="bottom" href="editarPerfil.php">';
                ?>
                  <i class="material-icons">brightness_5</i>
                  <p class="d-lg-none d-xl-none">Editar Perfil</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" rel="tooltip" title="Sair" data-placement="bottom" href="acaoLogin.php?acao=logout">
                  <i class="material-icons">power_settings_new</i>
                  <p class="d-lg-none d-xl-none">Sair</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="wrapper">
        <div class="page-header clear-filter page-header-small" filter-color="">
          <?php TecAdm($_SESSION['codigo']) ?>
        </div>
      </div>
      
        <footer class="footer footer-default">
          <div class=" container ">
            <nav>
              <ul>
                <li>
                  <a href="../examples/sobre.html">
                    Sobre
                  </a>
                </li>
              </ul>
            </nav>
            <div class="copyright" id="copyright">
              &copy;
              <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
              </script>, Desenvolvido para <a href="http://www.ifc-riodosul.edu.br/site/">Instituto Federal Catarinense - Campus Rio do Sul</a>.
            </div>
          </div>
        </footer>
      </div>
      <!--   Core JS Files   -->
      <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
      <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
      <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
      <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
      <script src="../assets/js/plugins/bootstrap-switch.js"></script>
      <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
      <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
      <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
      <script src="../assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
      <!--  Google Maps Plugin    -->
      <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
      <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
      <script src="../assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
    </body>
  </html>